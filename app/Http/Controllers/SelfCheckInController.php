<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\{User,Customer,BookingCheckinDetails,CustomerNotes,StripePaymentMethod,Recurring,Announcement,CustomersDocuments,BusinessActivityScheduler,Transaction,BusinessTerms,BusinessSubscriptionPlan,BusinessPriceDetails,UserBookingStatus,SGMailService,BusinessServices,UserBookingDetail,BusinessCheckinSettings};
use App\BusinessPriceDetailsAges;
use Auth,DateTime,Carbon\Carbon,Storage;
use App\Repositories\{BookingRepository};
use App\Services\CartService;
use Stripe\StripeClient;
use App\BusinessStaff;

class SelfCheckInController extends Controller {
	public function __construct(BookingRepository $booking_repo) {
        $this->middleware('auth');
        $this->booking_repo = $booking_repo;
    }

    public function index(){
    	$business = Auth::user()->current_company;
        $settings = BusinessCheckinSettings::where('business_id', $business->id)->first();
        $imageUrl =  $settings ?  $settings->welcome_cover : '../dashboard-design/images/check-in-bg.jpg';
        $logoUrl =  $settings ?  $settings->logo_image : '/images/fitnessity_logo1_black.png';
        $allSessionData = session()->all();
        if (session()->has('self_checkin_customer_id')) {
            session()->forget('self_checkin_customer_id');
         }
         if(session()->has('schedule')) {
            session()->forget('schedule');
        }

    	return view('checkin.index',compact('business','imageUrl','logoUrl', 'settings'));
	}


	public function quickCheckin(){
        $business = Auth::user()->current_company;
        $settings = BusinessCheckinSettings::where('business_id', $business->id)->first();
        $imageUrl =  $settings ?  $settings->passcode_cover : '/dashboard-design/images/check-in-bg.jpg';
        $logoUrl =  $settings ?  $settings->logo_image : '/images/fitnessity_logo1_black.png';
		return view('checkin.quick_checkin',compact('business','imageUrl','logoUrl','settings'));
	}

	public function loginForCheckin(Request $request){
        ini_set('memory_limit', '-1'); ini_set('max_execution_time', -1);
		$validator = Validator::make($request->all(), [
	        'code' => 'required', 
	    ]);
	    if ($validator->fails()) {
	        return response()->json([
	            'success' => false,
	            'message' => $validator->errors()->first(), 

	        ]);
	    }

	    $user = User::where('unique_code', $request->code)->first();
	    if (!$user) {
	        return response()->json([
	            'success' => false,
	            'message' => 'Invalid check-in code. Please try again.', 
	        ]);
	    }else{
	    	$business = Auth::user()->current_company;
        	$customer = $user->customers()->where('business_id',$business->id)->first();
            if($customer){
                session()->put('self_checkin_customer_id', $customer->id);
        		return response()->json([
    	            'success' => true,
    	            'message' => 'Login successful!',
    	            'url' => '/check-in-portal',
    		   ]);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid check-in code. Please try again.', 
                ]);
            }
	    	
	    }
	}

    public function autopayList(Request $request){
        $customer = Customer::find($request->customer_id);
        $missedPayments = Recurring::where(['user_id'=> @$customer->id, 'user_type' => 'Customer'])->where('status' ,'!=','Completed')->whereDate('payment_date' ,'<' ,date('Y-m-d'))->orderBy('payment_date','desc')->get();
        return view('checkin.autopay_list',compact('missedPayments','customer'));
    }

    public function cardList(Request $request){
        $customer = Customer::find($request->customer_id);
        $cards = StripePaymentMethod::where(['user_id'=> @$customer->id, 'user_type' => 'Customer'])->get();
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $customer->create_stripe_customer_id();
        $intent = $stripe->setupIntents->create(
          [
            'customer' => @$customer->stripe_customer_id,
            'payment_method_types' => ['card'],
          ]
        );

        $request->customer_id = $customer->id;
        $request->business_id = $customer->business_id;

        return view('checkin.card_list',compact('cards','customer','intent'));
    }

	public function portal(Request $request){
        $request->customer_id = session()->get('self_checkin_customer_id');
        if($request->customer_id){
            $business = Auth::user()->current_company;
            $businessId = $business->id;
            $settings =  BusinessCheckinSettings::where('business_id', $businessId)->first();
            $customer = $business->customers()->where('id' , $request->customer_id)->first();
            $name = @$customer->full_name;

            $activeMembershipCnt = count($this->booking_repo->currentTab($request->serviceType,$business->id,@$customer));
            $activeMembershipCntNew = $business->UserBookingDetails()->where('user_id' ,@$customer->id)->whereDate('created_at', date('Y-m-d'))->count();

            $notesCnt = CustomerNotes::where(['customer_id'=> @$customer->id ,'display_chk' => 1])->orderby('due_date','desc')->whereDate('due_date', '=', now())->whereTime('time', '<=', now()->format('H:i'))
                    ->orWhere(function ($query) use($customer) {
                        $query->whereDate('due_date', '<=', now())->where('customer_id', @$customer->id )->where('display_chk' ,1);
                    })->where('business_id', $business->id)->count();

            $notesCntNew = CustomerNotes::where(['customer_id'=> @$customer->id ,'display_chk' => 1])->orderby('due_date','desc')->whereDate('due_date', '=', now())->whereTime('time', now()->format('H:i'))
                    ->orWhere(function ($query) use($customer) {
                        $query->whereDate('due_date', now())->where('customer_id', @$customer->id )->where('display_chk' ,1);
                    })->where('business_id', $business->id)->count();

            $expiredCards = StripePaymentMethod::where(['user_id'=> @$customer->id, 'user_type' => 'Customer'])->where('exp_year','<=', date('Y'))->where('exp_month','<', date('m'))->get();

            $missedPayments = Recurring::where(['user_id'=> @$customer->id, 'user_type' => 'Customer'])->where('status' ,'!=','Completed')->whereDate('payment_date' ,'<' ,date('Y-m-d'))->orderBy('payment_date','desc')->get();


            $notesCnt += count($expiredCards);
            $notesCnt += count($missedPayments);

            $announcemetCnt = Announcement::where(['business_id' => $business->id, 'status' => 'active'])
                    ->where(function ($query) {
                        $query->whereDate('announcement_date', '<=', date('Y-m-d'))->whereTime('announcement_time', '<=', date('H:i'));
                        })->orWhere(function ($query) {
                            $query->whereDate('announcement_date', '<=', date('Y-m-d'))->whereNull('announcement_time');
                    })->count();

            $announcemetCntNew = Announcement::where(['business_id' => $business->id, 'status' => 'active'])->whereDate('announcement_date', date('Y-m-d'))->count();

            $docCnt =  $documents = CustomersDocuments::where('customer_id',  @$customer->id)->where('business_id', $business->id)->count();

            $docCntNew =  $documents = CustomersDocuments::where('customer_id',  @$customer->id)->where('business_id', $business->id)->whereDate('created_at',date('Y-m-d'))->count();
            $classes = BookingCheckinDetails::where('customer_id' ,$request->customer_id)->whereDate('checkin_date' , '>=' , date('Y-m-d'))->orderby('checkin_date','asc')->get()->filter(function ($bd){
                return $bd->booking_detail_id;
            });
            $bookingDetails = $currentBooking =  [];
            $bookingDetails =  $this->booking_repo->otherTab($request->serviceType, $request->business_id,@$customer);
          
            $currentBookingData = $this->booking_repo->currentTab($request->serviceType,$request->business_id,@$customer);
            foreach($currentBookingData as $i=>$book_details){
                $currentBooking[@$book_details->business_services_with_trashed->id .'!~!'.@$book_details->business_services_with_trashed->program_name] [] = $book_details;
            }

            $tabval = $request->tab; 

            $serviceType = $request->serviceType ?? 'all';
            $chkScheduleSession = '';

            $business_services = $business->service()->where('is_active',1)->orderBy('created_at','desc');
            if($request->stype && $request->business_service_id == ''){
                $serviceType = $request->stype;
                if($request->stype != 'all'){
                    $business_services = $business->service()->where(['is_active'=>1, 'service_type' => $serviceType])->orderBy('created_at','desc');
                }else{
                    $business_services = $business->service()->where('is_active',1)->orderBy('created_at','desc');
                }
            }

            if(session()->has('schedule')) {
                session()->forget('schedule');
            }
      
            $memberships = @$customer->active_memberships()->pluck('sport')->unique();

            if($request->business_service_id){
                $business_services = $business_services->where(['id'=>$request->business_service_id,'is_active'=>1, 'service_type' =>  $request->stype]); 
            }

            $filter_date = new DateTime();
            $shift = 1;
            if($request->date && (new DateTime($request->date)) > $filter_date){
                $filter_date = new DateTime($request->date); 
                $shift = 0;
            }
            $days = [];
            $days[] = new DateTime(date('Y-m-d'));
            for($i = 0; $i<=100; $i++){
                $d = clone($filter_date);
                $days[] = $d->modify('+'.($i+$shift).' day');
            }

            $bookschedulers = BusinessActivityScheduler::getallscheduler($filter_date)->whereIn('serviceid', $business_services->pluck('id'))->orderBy('shift_start', 'asc')->get();
            $services = [];
            foreach($bookschedulers as $bs){
                $services [] = $bs->business_service;
            }

            $services = array_unique($services);
            $priceid = $request->priceid;


            $documents = CustomersDocuments::where('customer_id', $customer->id)->when($customer->business_id, function ($query) use ($customer) {
                return $query->where('business_id', $customer->business_id);
            })->get();

            $terms = BusinessTerms::where('cid' ,$customer->business_id)->first();
            $lastBooking = $customer->bookingDetail()->orderby('created_at','desc')->first();

            $notes = CustomerNotes::where(['customer_id'=> $customer->id ,'display_chk' => 1])->orderby('due_date','desc')->whereDate('due_date', '=', now())->whereTime('time', '<=', now()->format('H:i'))
                ->orWhere(function ($query) use($customer) {
                    $query->whereDate('due_date', '<=', now())->where('customer_id', $customer->id )->where('display_chk' ,1);
                })
                ->when($customer->business_id, function ($query) use ($customer) {
                    return $query->where('business_id', $customer->business_id);
                })->get();


            $alertCount = count($expiredCards) +  count($missedPayments);

            $announcements = Announcement::where(['business_id' => $customer->business_id,'status' => 'active'])->whereDate('announcement_date', '<=', date('Y-m-d'))->get();

            $announcement = $announcements->sortByDesc(function($announcement) {
                return $announcement->announcement_date.' '.$announcement->announcement_time;
            });


            $announcement = $announcement->values()->all();
            
            return view('checkin.checkin_portal',compact('customer','name','notesCnt','activeMembershipCnt','docCnt','docCntNew','announcemetCnt','announcemetCntNew','notesCntNew','activeMembershipCntNew','classes','missedPayments','bookingDetails','currentBooking','tabval','businessId','serviceType','days','filter_date','services','priceid','lastBooking','terms','documents','notes','expiredCards','alertCount','announcement','settings'));
        }else{
            return redirect()->route('quick-checkin');
        }	
	}

    public function checkOut(Request $request){
        session()->forget('self_checkin_customer_id');

        if($request->type == 1){
            return redirect()->route('business_dashboard');
        }else{
            return redirect()->route('quick-checkin');
        }
    }
    public function clearSessionAndRedirect()
    {
        session()->forget('self_checkin_customer_id');    
        return redirect()->route('check-in-welcome');
    }
    
    public function checkInStaff(Request $request)   
    {
        $user = Auth::user();
        $company = $user->current_company;
        $code = $request->input('code');        
        if ($company) {
            $staff = BusinessStaff::where('business_id', $company->id)->where('unique_code', $code)->first();    
            if ($staff) {
                return response()->json(['status' => 'success', 'message' => 'Code is valid']);
            } else {
                return response()->json(['status' => 'fail', 'message' => 'Invalid code']);
            }
        } else {
            return response()->json(['status' => 'fail', 'message' => 'No company associated with the user']);
        }
    }
	public function checkin(Request $request){
		$checkInDetails = BookingCheckinDetails::find($request->checkinId);

		$chk = $checkInDetails->update([
			'checked_at' => date('Y-m-d H:i:s'),
		]);

		$activityName = $checkInDetails->UserBookingDetail->business_services_with_trashed->program_name .' ('. $checkInDetails->UserBookingDetail->businessPriceDetailsAgesTrashed->category_title.')';
		
		if($chk){
			return response()->json([
	            'success' => true,
	            'message' => "You're Checked In for <br>". $activityName, 
                'message1' => "You're Checked In for ". $activityName, 
	        ]);
		}else{
			return response()->json([
	            'success' => false,
	            'message' => 'There is a issue in checkin. Try again.', 
	        ]);
		}
	}

    public function getAnnoucementModal($id){
        $an = Announcement::find($id);
        return view('checkin.annoucement_modal',compact('an'));
    }

    public function cardEditingForm(Request $request){
        $customer = Customer::find($request->customer_id);
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $customer->create_stripe_customer_id();
        $intent = $stripe->setupIntents->create(
          [
            'customer' => @$customer->stripe_customer_id,
            'payment_method_types' => ['card'],
          ]
        );
      
        $cardInfo = $customer->stripePaymentMethods()->get();
        return view('checkin.autopay_payment', compact('intent','cardInfo'));
    }

    public function cardEditingFormAll(Request $request)
    {
        $customerId = $request->input('customer_id');
        $totalAmount = $request->input('total_amount');
        $paymentIds = $request->input('rids');

        $customer = Customer::find($customerId);
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $customer->create_stripe_customer_id();
        try {
            $intent = $stripe->paymentIntents->create([
                'amount' => $totalAmount * 100, // Amount in cents
                'currency' => 'usd',
                'customer' => $customer->stripe_customer_id,
                'payment_method_types' => ['card'],
            ]);
            $cardInfo = $customer->stripePaymentMethods()->get();
            return view('checkin.payment_n', compact('intent', 'cardInfo'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }

    
    public function showAutopayPayment(Request $request)
    {
        $intent = json_decode($request->input('intent'), true);
        $cardInfo = json_decode($request->input('cardInfo'), true);
        $totalAmount = $request->input('totalAmount');
        $customerId = $request->input('customerId');
        $paymentIds = explode(',', $request->input('paymentIds'));
    
        return view('checkin.autopay_payment', compact('intent', 'cardInfo', 'totalAmount', 'customerId', 'paymentIds'));
    }
    public function autopayPayment(Request $request){
        \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $customer =  Customer::find($request->customerId);
        $stripe_customer_id = $customer->stripe_customer_id;
        $errorMsg = '';
        if($request->has('cardinfo')){
            $onFilePaymentMethodId = $request->cardinfo;
            try {
                $onFilePaymentIntent = $stripe->paymentIntents->create([
                    'amount' =>  round($request->price *100),
                    'currency' => 'usd',
                    'customer' => $stripe_customer_id,
                    'payment_method' => $onFilePaymentMethodId ,
                    'off_session' => true,
                    'confirm' => true,
                    'metadata' => [],
                ]);

                if($onFilePaymentIntent['status']=='succeeded'){
                    $recDetail = Recurring::findOrFail($request->id);
                    $charged_amt =  $recDetail->amount + $recDetail->tax;
                    $recDetail->update(['charged_amount'=>$charged_amt, 'payment_method' =>'card' ,'stripe_payment_id' => $onFilePaymentIntent->id ,'status' => 'Completed','payment_on' => date('Y-m-d')]);

                    $transactiondata = array( 
                        'user_type' =>$recDetail->user_type,
                        'user_id' => $recDetail->user_id,
                        'item_type' =>'Recurring',
                        'item_id' => $recDetail->id,
                        'channel' =>'stripe',
                        'kind' => 'card',
                        'transaction_id' =>$onFilePaymentIntent->id,
                        'amount' => $charged_amt ,
                        'qty' =>'1',
                        'status' =>'complete',
                        'refund_amount' =>0,
                        'payload' =>json_encode($onFilePaymentIntent,true),
                    );
                
                    $transactionstatus = Transaction::create($transactiondata);
                    $recDetail->charged();
                    return response()->json(['message' => 'success']);
                }
            }catch(\Stripe\Exception\CardException $e ) {
                $errorMsg = $e->getError()->message;
            }catch(\Stripe\Exception\ApiErrorException  $e ) {
                $errorMsg = $e->getMessage();
            }catch(\Stripe\Exception\AuthenticationException  $e ) {
                $errorMsg = "Stripe can’t authenticate you with the information provided";
            }catch(\Stripe\Exception\InvalidRequestException $e ) {
                $errorMsg = 'An invalid request occurred in stripe';
                if (isset($e->getError()->param)) {
                    $errorMsg =  "The parameter {$e->getError()->param} is invalid or missing.";
                }
            }catch(\Stripe\Exception\RateLimitException $e ) {
                $errorMsg = "Our system is currently experiencing a high volume of requests, and as a result, we've received too many API calls in a short period of time. We will try again later. We apologize for any inconvenience";
            }catch(\Stripe\Exception\StripeApiException $e ) {
                $errorMsg = $e->getError()->message;
            }catch(\Stripe\Exception\NetworkException $e ) {
                $errorMsg = $e->getError()->message;
            }catch(\Stripe\Exception\InvalidResponseException  $e ) {
                $errorMsg = "We're sorry, but there was a problem processing your payment due to a network error. Please try again later";
            }catch(\Stripe\Exception\StripeServerException   $e ) {
                $errorMsg = $e->getError()->message;
            }catch (Exception $e) {
                $errorMsg = 'Another problem occurred, maybe unrelated to Stripe';
            }

            if($errorMsg){
                return response()->json(['error' => $errorMsg], 400);
            }
        }else{
            $newCardPaymentMethodId = $request->new_card_payment_method_id;
            try {
                $newCardPaymentIntent = $stripe->paymentIntents->create([
                    'amount' =>  round($request->price *100),
                    'currency' => 'usd',
                    'customer' => $stripe_customer_id,
                    'payment_method' => $newCardPaymentMethodId,
                    'off_session' => true,
                    'confirm' => true,
                    'metadata' => [],
                ]);
              
                if($newCardPaymentIntent['status'] == 'succeeded'){
                
                    $recDetail = Recurring::findOrFail($id);
                    $charged_amt =  $recDetail->amount + $recDetail->tax;
                    $recDetail->update(['charged_amount'=>$charged_amt, 'payment_method' =>'card' ,'stripe_payment_id' => $newCardPaymentIntent->id ,'status' => 'Completed','payment_on' => date('Y-m-d')]);

                    $transactiondata = array( 
                        'user_type' =>$recDetail->user_type,
                        'user_id' => $recDetail->user_id,
                        'item_type' =>'Recurring',
                        'item_id' => $recDetail->id,
                        'channel' =>'stripe',
                        'kind' => 'card',
                        'transaction_id' =>$newCardPaymentIntent->id,
                        'amount' => $charged_amt ,
                        'qty' =>'1',
                        'status' =>'complete',
                        'refund_amount' =>0,
                        'payload' =>json_encode($newCardPaymentIntent,true),
                    );
                
                    $transactionstatus = Transaction::create($transactiondata);
                    $recDetail->charged();

                    return response()->json(['message' => 'success']);
                }
            }catch(\Stripe\Exception\CardException $e ) {
                $errorMsg = $e->getError()->message;
            }catch(\Stripe\Exception\ApiErrorException  $e ) {
                $errorMsg = $e->getMessage();
            }catch(\Stripe\Exception\AuthenticationException  $e ) {
                $errorMsg = "Stripe can’t authenticate you with the information provided";
            }catch(\Stripe\Exception\InvalidRequestException $e ) {
                $errorMsg = 'An invalid request occurred in stripe';
                if (isset($e->getError()->param)) {
                    $errorMsg =  "The parameter {$e->getError()->param} is invalid or missing.";
                }
            }catch(\Stripe\Exception\RateLimitException $e ) {
                $errorMsg = "Our system is currently experiencing a high volume of requests, and as a result, we've received too many API calls in a short period of time. We will try again later. We apologize for any inconvenience";
            }catch(\Stripe\Exception\StripeApiException $e ) {
                $errorMsg = $e->getError()->message;
            }catch(\Stripe\Exception\NetworkException $e ) {
                $errorMsg = $e->getError()->message;
            }catch(\Stripe\Exception\InvalidResponseException  $e ) {
                $errorMsg = "We're sorry, but there was a problem processing your payment due to a network error. Please try again later";
            }catch(\Stripe\Exception\StripeServerException   $e ) {
                $errorMsg = $e->getError()->message;
            }catch (Exception $e) {
                $errorMsg = 'Another problem occurred, maybe unrelated to Stripe';
            }

            if($errorMsg){
                return response()->json(['error' => $errorMsg], 400);
            }
        }
    }

   
    public function autopayPaymentMultiple(Request $request){
        
        \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $customer =  Customer::find($request->customerId);
        $stripe_customer_id = $customer->stripe_customer_id;
        $errorMsg = '';
        if($request->has('cardinfo')){
            $onFilePaymentMethodId = $request->cardinfo;
            try {
                $ids= explode(",",implode(',', $request->id));
                foreach ($ids as $id) {
                $onFilePaymentIntent = $stripe->paymentIntents->create([
                    'amount' =>  round($request->price *100),
                    'currency' => 'usd',
                    'customer' => $stripe_customer_id,
                    'payment_method' => $onFilePaymentMethodId ,
                    'off_session' => true,
                    'confirm' => true,
                    'metadata' => [],
                ]);

                if($onFilePaymentIntent['status']=='succeeded'){
                    $recDetail = Recurring::findOrFail($id);
                    $charged_amt =  $recDetail->amount + $recDetail->tax;
                    $recDetail->update(['charged_amount'=>$charged_amt, 'payment_method' =>'card' ,'stripe_payment_id' => $onFilePaymentIntent->id ,'status' => 'Completed','payment_on' => date('Y-m-d')]);

                    $transactiondata = array( 
                        'user_type' =>$recDetail->user_type,
                        'user_id' => $recDetail->user_id,
                        'item_type' =>'Recurring',
                        'item_id' => $recDetail->id,
                        'channel' =>'stripe',
                        'kind' => 'card',
                        'transaction_id' =>$onFilePaymentIntent->id,
                        'amount' => $charged_amt ,
                        'qty' =>'1',
                        'status' =>'complete',
                        'refund_amount' =>0,
                        'payload' =>json_encode($onFilePaymentIntent,true),
                    );
                
                    $transactionstatus = Transaction::create($transactiondata);
                    $recDetail->charged();
                }
            }
            return response()->json(['message' => 'success']);

            }catch(\Stripe\Exception\CardException $e ) {
                $errorMsg = $e->getError()->message;
            }catch(\Stripe\Exception\ApiErrorException  $e ) {
                $errorMsg = $e->getMessage();
            }catch(\Stripe\Exception\AuthenticationException  $e ) {
                $errorMsg = "Stripe can’t authenticate you with the information provided";
            }catch(\Stripe\Exception\InvalidRequestException $e ) {
                $errorMsg = 'An invalid request occurred in stripe';
                if (isset($e->getError()->param)) {
                    $errorMsg =  "The parameter {$e->getError()->param} is invalid or missing.";
                }
            }catch(\Stripe\Exception\RateLimitException $e ) {
                $errorMsg = "Our system is currently experiencing a high volume of requests, and as a result, we've received too many API calls in a short period of time. We will try again later. We apologize for any inconvenience";
            }catch(\Stripe\Exception\StripeApiException $e ) {
                $errorMsg = $e->getError()->message;
            }catch(\Stripe\Exception\NetworkException $e ) {
                $errorMsg = $e->getError()->message;
            }catch(\Stripe\Exception\InvalidResponseException  $e ) {
                $errorMsg = "We're sorry, but there was a problem processing your payment due to a network error. Please try again later";
            }catch(\Stripe\Exception\StripeServerException   $e ) {
                $errorMsg = $e->getError()->message;
            }catch (Exception $e) {
                $errorMsg = 'Another problem occurred, maybe unrelated to Stripe';
            }

            if($errorMsg){
                return response()->json(['error' => $errorMsg], 400);
            }
        }else{
            $newCardPaymentMethodId = $request->new_card_payment_method_id;
            try {
                $ids= explode(",",implode(',', $request->id));
 
                foreach ($ids as $id) 
                {
                    $newCardPaymentIntent = $stripe->paymentIntents->create([
                        'amount' =>  round($request->price *100),
                        'currency' => 'usd',
                        'customer' => $stripe_customer_id,
                        'payment_method' => $newCardPaymentMethodId,
                        'off_session' => true,
                        'confirm' => true,
                        'metadata' => [],
                    ]);
                
                    if($newCardPaymentIntent['status'] == 'succeeded'){
                    
                        $recDetail = Recurring::findOrFail($id);
                        $charged_amt =  $recDetail->amount + $recDetail->tax;
                        $recDetail->update(['charged_amount'=>$charged_amt, 'payment_method' =>'card' ,'stripe_payment_id' => $newCardPaymentIntent->id ,'status' => 'Completed','payment_on' => date('Y-m-d')]);

                        $transactiondata = array( 
                            'user_type' =>$recDetail->user_type,
                            'user_id' => $recDetail->user_id,
                            'item_type' =>'Recurring',
                            'item_id' => $recDetail->id,
                            'channel' =>'stripe',
                            'kind' => 'card',
                            'transaction_id' =>$newCardPaymentIntent->id,
                            'amount' => $charged_amt ,
                            'qty' =>'1',
                            'status' =>'complete',
                            'refund_amount' =>0,
                            'payload' =>json_encode($newCardPaymentIntent,true),
                        );
                    
                        $transactionstatus = Transaction::create($transactiondata);
                        $recDetail->charged();

                    }
                }
                return response()->json(['message' => 'success']);

            }catch(\Stripe\Exception\CardException $e ) {
                $errorMsg = $e->getError()->message;
            }catch(\Stripe\Exception\ApiErrorException  $e ) {
                $errorMsg = $e->getMessage();
            }catch(\Stripe\Exception\AuthenticationException  $e ) {
                $errorMsg = "Stripe can’t authenticate you with the information provided";
            }catch(\Stripe\Exception\InvalidRequestException $e ) {
                $errorMsg = 'An invalid request occurred in stripe';
                if (isset($e->getError()->param)) {
                    $errorMsg =  "The parameter {$e->getError()->param} is invalid or missing.";
                }
            }catch(\Stripe\Exception\RateLimitException $e ) {
                $errorMsg = "Our system is currently experiencing a high volume of requests, and as a result, we've received too many API calls in a short period of time. We will try again later. We apologize for any inconvenience";
            }catch(\Stripe\Exception\StripeApiException $e ) {
                $errorMsg = $e->getError()->message;
            }catch(\Stripe\Exception\NetworkException $e ) {
                $errorMsg = $e->getError()->message;
            }catch(\Stripe\Exception\InvalidResponseException  $e ) {
                $errorMsg = "We're sorry, but there was a problem processing your payment due to a network error. Please try again later";
            }catch(\Stripe\Exception\StripeServerException   $e ) {
                $errorMsg = $e->getError()->message;
            }catch (Exception $e) {
                $errorMsg = 'Another problem occurred, maybe unrelated to Stripe';
            }

            if($errorMsg){
                return response()->json(['error' => $errorMsg], 400);
            }
        }
    }
    public function bookingHtml(Request $request){
        $business = Auth::user()->current_company;
        $companyId = $business->id; 
        $customerId =  session()->get('self_checkin_customer_id');
        $services = $business->business_services()->where('is_active' ,1)->whereHas('schedulers', function ($query) {
            $query->where('end_activity_date', '>', now())->orWhereNull('end_activity_date');
        })->get();
        $services = $business->business_services()
        ->where('is_active', 1)
        ->whereHas('schedulers', function ($query) {
            $query->where('end_activity_date', '>', now())->orWhereNull('end_activity_date');
        })
        ->whereHas('priceDetailsAges', function ($query) {
            $query->where('stype', 1)->orWhere('serviceid', 0);
        })
        ->get();
        $userId = Auth::id();       
        $PriceAgesDetail = BusinessPriceDetailsAges::where('userid', $userId )->where('cid', $business->id)->where('serviceid', 0)->get();
        return view('checkin.booking_html_modal', compact('companyId','services','customerId','PriceAgesDetail'));
    }

    public function getActivityDates(Request $request)
    {
        $sid = $request->input('sid');
        $next_available_date = null;
        $activities = BusinessActivityScheduler::where('serviceid', $sid)->get();
        $result = [];
        foreach($activities as $local_activity){
            $activity_next_available_date = $local_activity->next_available_date();
            if($activity_next_available_date != ''){
                if ($next_available_date === null || $activity_next_available_date < $next_available_date) {
                    $next_available_date = $activity_next_available_date;
                }
            }
            array_push($result, [$local_activity->starting, $local_activity->end_activity_date, $local_activity->activity_days]);
        }

        if($next_available_date == null){
            $next_available_date = new \DateTime();
        }

        return response()->json([
            'next_available_date' => $next_available_date->format('M-d-Y'),
            'active_days' => $result
        ]);
    }

    public function getMembershipPayment(Request $request){
        $cart = $request->session()->has('cart_item') ? $request->session()->get('cart_item') : [];
        $fees = BusinessSubscriptionPlan::where('id',1)->first();
        $cartCount = 1; $totalquantity =  $discount = 0;

        $item = array_values($cart['cart_item']);
        $item = $item[0];
        $serprice =  BusinessPriceDetails::where('id', $item['priceid'])->first();

        if(!empty($item['adult'])){
            $totalquantity += $item['adult']['quantity'];
            $discount += $item['adult']['quantity'] * ($item['adult']['price'] * is_int(@$serprice['adult_discount']))/100; 
        }
        if(!empty($item['child'])){
            $totalquantity += $item['child']['quantity'];
            $discount += $item['child']['quantity'] *  ($item['child']['price'] * is_int(@$serprice['child_discount']))/100;
        }
        if(!empty($item['infant'])){
            $totalquantity += $item['infant']['quantity'];
            $discount += $item['infant']['quantity'] *  ($item['infant']['price'] *  is_int(@$serprice['infant_discount']))/100;
        }

        $item_price = $item['totalprice'];
        $service_fee= ($item_price * $fees->service_fee)/100;
        $tax= ($item_price * $fees->site_tax)/100;
        $total_amount =  number_format(($item_price + $service_fee + $tax - $discount),2,'.','');
        $subTotal = ($discount) ? number_format($item_price - $discount, 2) : number_format($item_price, 2);                                               
        $taxDisplay = number_format(($tax + $service_fee),2); 
    
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $customer = Customer::find($request->customer_id);
        $customer->create_stripe_customer_id();
        $intent = $stripe->setupIntents->create(
          [
            'customer' => @$customer->stripe_customer_id,
            'payment_method_types' => ['card'],
          ]
        );
        $user=Auth::user();
        $cardInfo = StripePaymentMethod::where('user_type', 'User')->where('user_id',  $customer->user_id)->get(); 
        $request->businessId = $customer->business_id;      
        return view('checkin.membership_payment', compact('intent','cardInfo' ,'cartCount' ,'discount' ,'taxDisplay' ,'total_amount' ,'subTotal'));
    }

    public function chkCheckinCode(Request $request){

        $validator = Validator::make($request->all(), [
            'code' => 'required', 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(), 

            ]);
        }
        $customer = Customer::find(session()->get('self_checkin_customer_id'));
        $user = $customer->user()->where('unique_code', $request->code)->first();
       
        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Check out successfuls!',
                'url' => route('check-in-welcome'),
            ]);
        }        
        $user = Auth::user();
        $company = $user->current_company;

        $businessStaff = BusinessStaff::where('unique_code', $request->code)->where('business_id',$company->id)->first();
        if ($businessStaff) {
            return response()->json([
                'success' => true,
                'message' => 'Check out successful!.',
                'url' => route('business_dashboard'),
            ]);
        }    
        return response()->json([
            'success' => false,
            'message' => 'Invalid 4 digit code. Please try again.',
        ]);

            
    }

    public function chkCheckinCodeExit(Request $request){

        $validator = Validator::make($request->all(), [
            'code' => 'required', 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(), 

            ]);
        }
        $customer = Customer::find(session()->get('self_checkin_customer_id'));
        $user = User::where('unique_code', $request->code)->first();
       
        if ($user) {
            return response()->json([
                'success' => true,
                'message' => 'Check out successfuls!',
                'url' => route('checkin.check_out', ['type' => 1]),
            ]);
        }        
        $user = Auth::user();
        $company = $user->current_company;

        $businessStaff = BusinessStaff::where('unique_code', $request->code)->where('business_id',$company->id)->first();
        if ($businessStaff) {
            return response()->json([
                'success' => true,
                'message' => 'Check out successful!.',
                'url' => route('business_dashboard'),
            ]);
        }    
        return response()->json([
            'success' => false,
            'message' => 'Invalid 4 digit code. Please try again.',
        ]);
            
    }
    
    public function chkChekouStaffExit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required', 
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(), 

            ]);
        }

        $user = Auth::user();
        $company = $user->current_company;

        $businessStaff = BusinessStaff::where('unique_code', $request->code)->where('business_id',$company->id)->first();
        if ($businessStaff) {
            return response()->json([
                'success' => true,
                'message' => 'Check out successful!.',
                'url' => route('dashboard'),
            ]);
        }    
        return response()->json([
            'success' => false,
            'message' => 'Invalid 4 digit code. Please try again.',
        ]);
    }

    public function memberhsipPay(Request $request){
        $loggedinUser = Customer::find($request->customer_id);

        $cartService = new CartService();

        \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));

        if($loggedinUser->stripe_customer_id != '') {
            $stripe_customer_id = $loggedinUser->stripe_customer_id;
        }else{
            $stripe_customer_id = $loggedinUser->create_stripe_customer_id();
        }
        $totalprice =  $priceWithDiscount = 0;
        $totalprice = $request->grand_total;

        if($request->has('cardinfo')){
            $onFilePaymentMethodId = $request->cardinfo;
            try {
                $onFilePaymentIntent = $stripe->paymentIntents->create([
                    'amount' =>  round($totalprice *100),
                    'currency' => 'usd',
                    'customer' => $stripe_customer_id,
                    'payment_method' => $onFilePaymentMethodId ,
                    'off_session' => true,
                    'confirm' => true,
                    'metadata' => [],
                ]);

                if($onFilePaymentIntent['status']=='succeeded'){

                    $orderdata = array(
                        'user_id' => Auth::user()->id,
                        'customer_id' => $request->customer_id,
                        'user_type' => 'customer',
                        'status' => 'active',
                        'currency_code' => 'usd',
                        'amount' => $totalprice,
                        'bookedtime' => Carbon::now()->format('Y-m-d'),
                    ); 

                    $userBookingStatus = UserBookingStatus::create($orderdata);

                    $transactiondata = array( 
                        'user_type' => 'customer',
                        'user_id' => $request->customer_id,
                        'item_type' =>'UserBookingStatus',
                        'item_id' => $userBookingStatus->id,
                        'channel' =>'stripe',
                        'kind' => 'card',
                        'transaction_id' => $onFilePaymentIntent["id"],
                        'stripe_payment_method_id' => $onFilePaymentMethodId,
                        'amount' => $totalprice,
                        'qty' =>'1',
                        'status' =>'complete',
                        'refund_amount' =>0,
                        'payload' =>json_encode($onFilePaymentIntent,true),
                    );

                    $transactionstatus = Transaction::create($transactiondata);
                }
            }catch(\Stripe\Exception\CardException | \Stripe\Exception\InvalidRequestException $e) {
                return "Error: " . $e->getError()->message;
    
            }catch( \Exception $e) {
                $errormsg = $e->getError()->message;
                return $errormsg;
            }
        }
        else{
            $newCardPaymentMethodId = $request->new_card_payment_method_id;
            try {
                $newCardPaymentIntent = $stripe->paymentIntents->create([
                    'amount' =>  round($totalprice *100),
                    'currency' => 'usd',
                    'customer' => $stripe_customer_id,
                    'payment_method' => $newCardPaymentMethodId,
                    'off_session' => true,
                    'confirm' => true,
                    'metadata' => [],
                ]);
                if($request->save_card != 1){
                    $stripePaymentMethod = \App\StripePaymentMethod::where('payment_id', $newCardPaymentMethodId)->firstOrFail();
                    $stripePaymentMethod->delete();
                }

                if($newCardPaymentIntent['status'] == 'succeeded'){
                    $orderdata = array(
                        'user_id' => Auth::user()->id,
                        'customer_id' => $request->customer_id,
                        'status' => 'active',
                        'currency_code' => 'usd',
                        'amount' => $totalprice,
                        'user_type' => 'customer',
                        'bookedtime' => Carbon::now()->format('Y-m-d'),
                    ); 
                    $userBookingStatus = UserBookingStatus::create($orderdata);

                    $transactiondata = array( 
                        'user_type' => 'customer',
                        'user_id' => $loggedinUser->id,
                        'item_type' =>'UserBookingStatus',
                        'item_id' => $userBookingStatus->id,
                        'channel' =>'stripe',
                        'kind' => 'card',
                        'transaction_id' => $newCardPaymentIntent["id"],
                        'stripe_payment_method_id' => $newCardPaymentMethodId,
                        'amount' => $totalprice,
                        'qty' =>'1',
                        'status' =>'complete',
                        'refund_amount' =>0,
                        'payload' =>json_encode($newCardPaymentIntent,true),
                    );

                    $transactionstatus = Transaction::create($transactiondata);
                }
            }catch(\Stripe\Exception\CardException  $e) {
                return $e->getError()->message;
            }catch(\Stripe\Exception\InvalidRequestException $e) {
                return "Your card is not connected with your account. Please add your card again.";
            }catch( \Exception $e) {
                return  $e->getError()->message;
            }
        }

        $bspdata = BusinessSubscriptionPlan::where('id',1)->first();
        $tax = $bspdata->site_tax;

        foreach($cartService->items() as $item){
            $activityScheduler = BusinessActivityScheduler::find($item['actscheduleid']);
            $businessServices = BusinessServices::find($item['code']);
            $user = $businessServices->user;
            $price_detail = $cartService->getPriceDetail($item['priceid']);
            $participateLoop =  $cartService->participateLoop($item,$businessServices->cid);
            foreach($participateLoop as $d){
                $participateAry = $qtyAry = $qtyPrice = [];
                foreach(['adult', 'child', 'infant'] as $role){
                    if($d['type'] == $role){
                        $qtyAry[$role] = 1;
                        $qtyPrice[$role] = $d['price'];
                    }else{
                        $qtyAry[$role] = 0;
                        $qtyPrice[$role] = 0;
                    }
                }
                $participateAry['from'] ='customer';
                $participateAry['id'] = $d['id'];

                $discount = $cartService->getDiscount($item['priceid'],$d['type'],$d['price']);

                $addOnServicePrice = @$item['addOnServicesTotalPrice'] ?? 0 ;
                $priceWithDiscount = $d['price'] - $discount + $addOnServicePrice;
                $expiredate = $price_detail->getExpirationDate($item['sesdate']);
                $expired_duration   = $price_detail->pay_setnum.' '.$price_detail->pay_setduration;

                $booking_detail = UserBookingDetail::create([                 
                    'booking_id' => $userBookingStatus->id,
                    'user_id'=> $d['id'],
                    'user_type'=> 'customer',
                    'sport' => $item['code'],
                    'bookedtime' => $item['sesdate'],
                    'business_id'=> $businessServices->cid,
                    'price' => json_encode($qtyPrice),
                    'qty' => json_encode($qtyAry),
                    'priceid' => $item['priceid'],
                    'category_id' => $item['categoryid'],
                    'pay_session' => $price_detail->pay_session,
                    'act_schedule_id' => $activityScheduler->id,
                    'expired_at' => $expiredate,
                    'expired_duration' => $expired_duration,
                    'contract_date' => $item['sesdate'],
                    'subtotal' => $cartService->getSubTotal($item['priceid'],$d['type'],$d['price'], $addOnServicePrice),
                    'discount' => $discount,
                    'tax' =>  $cartService->getTax($priceWithDiscount),
                    'fitnessity_fee' => $cartService->getFitnessFee($priceWithDiscount, $user),
                    'service_fee' => $cartService->getServiceFee($priceWithDiscount),
                    'membershipTotalPrices' => $cartService->getMembershipTotal($item['priceid'],$d['type'],$d['price']) ,
                    'membershipTotalTax' =>$cartService->getMembershipTax($item['priceid'],$d['type'],$d['price']),
                    'productTotalTax' => 0 ,
                    'tip' => 0,
                    'participate' =>'['.json_encode($participateAry).']',
                    'transfer_provider_status' =>'unpaid',
                    'payment_number' => '{}',
                    'order_from' => "Check In Portal",
                    'addOnservice_ids' =>@$item['addOnServicesId'],
                    'addOnservice_qty' => @$item['addOnServicesQty'],
                    'addOnservice_total' =>  $addOnServicePrice,
                    'order_type' => 'Membership',
                ]);

                $price_detail = $cartService->getPriceDetail($item['priceid']);

                $re_i = 0;
                $date = Carbon::now();
                $stripe_id = $stripe_charged_amount = $payment_method= '';
                $amount = $re_i = $reCharge = ''; 

                $amount = $cartService->getMembershipTotal($item['priceid'],$d['type'],$d['price']) ;
                $tax_recurring = $cartService->getMembershipTax($item['priceid'],$d['type'],$d['price']);

                if($d['type'] == 'adult'){
                    $re_i = $price_detail->recurring_nuberofautopays_adult; 
                    $reCharge  = $price_detail->recurring_customer_chage_by_adult;
                }else if($d['type'] == 'child'){
                    $re_i = $price_detail->recurring_nuberofautopays_child; 
                    $reCharge  = $price_detail->recurring_customer_chage_by_child;
                }else if($d['type'] == 'infant'){
                    $re_i = $price_detail->recurring_nuberofautopays_infant;
                    $reCharge  = $price_detail->recurring_customer_chage_by_infant;
                }

                if($re_i != '' && $re_i != 0 && $amount != ''){ 
                    for ($num = $re_i; $num >0 ; $num--) { 
                        $payment_method = $transactionstatus->stripe_payment_method_id;
                        if($num==1){
                            $stripe_id =  $transactionstatus->transaction_id;
                            $stripe_charged_amount = number_format($transactionstatus->amount,2);
                            $paymentDate = $date->format('Y-m-d');
                            $status = 'Completed';
                             $payment_number = '1';
                             $payment_on = date('Y-m-d');
                        }else{
                            $Chk = explode(" ",$reCharge);
                            $timeChk = @$Chk[1];
                            $afterHowmanytime = @$Chk[0];
                            $addTime  = $afterHowmanytime * ($num - 1);

                             if($timeChk == 'Month'){
                                $paymentDate = (Carbon::now()->addMonths($addTime))->format('Y-m-d');
                                $additionalPaymentDate = Carbon::parse($paymentDate)->addMonths($afterHowmanytime)->format('Y-m-d');
                            }else if($timeChk == 'Week'){
                                $paymentDate = (Carbon::now()->addWeeks($addTime))->format('Y-m-d');
                                $additionalPaymentDate = Carbon::parse($paymentDate)->addWeeks($afterHowmanytime)->format('Y-m-d');
                            }else if($timeChk == 'Year'){
                                $paymentDate = (Carbon::now()->addYears($addTime))->format('Y-m-d');
                                $additionalPaymentDate = Carbon::parse($paymentDate)->addYears($afterHowmanytime)->format('Y-m-d');
                            }

                            if($num == $re_i && $additionalPaymentDate){
                                $booking_detail->expired_at = $additionalPaymentDate;
                                $booking_detail->expired_duration = ($re_i * $afterHowmanytime).' '.$timeChk.'s';
                                $booking_detail->save();
                            }

                            $status = 'Scheduled';
                            $payment_number = NULL;
                            $payment_on = NULL;
                        } 

                        $recurring = array(
                            "booking_detail_id" => $booking_detail->id,
                            "user_id" =>  $d['id'],
                            "user_type" => 'customer',
                            "business_id" => $booking_detail->business_id ,
                            "payment_date" => $paymentDate,
                            "amount" => $amount,
                            'charged_amount'=> $stripe_charged_amount,
                            'payment_method'=> $payment_method,
                            'stripe_payment_id'=> $stripe_id,
                            "tax" => $tax_recurring ,
                            "payment_number" => $payment_number,
                            "payment_on" => $payment_on,
                            "status" => $status,
                        );
                        Recurring::create($recurring);
                    }
                }

                try {
                    $checkinDetails = BookingCheckinDetails::create([
                        'business_activity_scheduler_id' => @$activityScheduler->id,
                        'instructor_id' => @$activityScheduler->instructure_ids,
                        'customer_id' => $d['id'],
                        'booking_detail_id' => $booking_detail->id,
                        'checkin_date' => date('Y-m-d', strtotime($item['sesdate'])),
                        'use_session_amount' => 0,
                        'source_type' => 'marketplace',
                    ]);
                
                } catch (\Exception $e) {
                    return redirect()->back();
                }

                $getreceipemailtbody = $this->booking_repo->getreceipemailtbody($booking_detail->booking_id, $booking_detail->id);
                $MailCustomer = Customer::find($d['id']);
                $email_detail = array(
                    'getreceipemailtbody' => $getreceipemailtbody,
                    'email' => @$MailCustomer->email);
                SGMailService::sendBookingReceipt($email_detail);
                
                $email_detail2 = $this->generateEmailDetails(
                    @$businessServices->company_information->business_email,
                    $businessServices,
                    $cartService,
                    $participateAry,
                    $item,
                    $activityScheduler,
                    $price_detail
                );

                SGMailService::confirmationMail($email_detail2);
                $company = @$cartService->getCompany($businessServices->cid);
                $businessTerms = @$company->businessterms; 
                $email_detail1 = array(
                    "CustomerName" =>  @$MailCustomer->full_name, 
                    "CompanyName" =>  @$company->company_name, 
                    "RepName" =>  @$company->full_name, 
                    "CompanyAddress" => @$company->company_address(), 
                    "phone" => @$company->business_phone, 
                    "email" => @$MailCustomer->email, 
                    "website" => @$company->business_website, 
                    "MapImage" => 'https://maps.googleapis.com/maps/api/staticmap?center='.@$company->latitude.','.@$company->longitude.'&zoom=15&size=600x300&maptype=roadmap&markers=color:red|'.@$company->latitude.','.@$company->longitude.'&key='.env('GOOGLE_MAP_KEY'),
                    "thingsToKnow" => @$businessTerms->houserules, 
                    "CancellationText" => @$businessTerms->cancelation, 
                    "RefundText" => @$businessTerms->refundpolicytext);

                SGMailService::confirmationMailForCustomer(array_merge($email_detail2,$email_detail1));
            }
        }

        session()->forget('cart_item');
        return response()->json(['message' => 'success']);
    }


    public function generateEmailDetails($email, $businessServices, $cartService, $participateAry, $item, $activityScheduler, $price_detail){
        return array(
            "email" => $email,  
            "Url" => env('APP_URL').'/personal/orders?business_id='.$businessServices->cid, 
            "BusinessName"=> @$cartService->getCompany($businessServices->cid)->dba_business_name,
            "BookedPerson"=> Auth::user()->full_name,
            "ParticipantsName"=> @$cartService->getParticipateByComa( json_encode($participateAry)),
            "date"=> Carbon::parse($item['sesdate'])->format('m/d/Y'),
            "Age"=> @$cartService->getParticipateAge(json_encode($participateAry)),
            "logo"=> @$cartService->getCompany($businessServices->cid)->logo,
            "time"=> $activityScheduler->activity_time(),
            "duration"=> $activityScheduler->get_clean_duration(),
            "ActivitiyType"=> $businessServices->service_type,
            "ProgramName"=> $businessServices->program_name,
            "CategoryName"=> $price_detail->business_price_details_ages_with_trashed->category_title
        );
    }	 
    public function getParticipateData(Request $request){
    	$cusId = $request->cus_id ?? '';
    	$family = getFamilyMember($cusId,$request->cid);
    	$priceid = $request->priceid;  $type = $request->type; 
    	$customer = ( $cusId ) ? Customer::find($cusId) : '';
		return view('checkin.participate_data' ,compact('priceid','type','family','customer'));
    }
}