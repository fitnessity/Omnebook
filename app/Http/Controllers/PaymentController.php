<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Libraries\Stripes\StripePay;
use App\Http\Controllers\Controller;
use App\Repositories\{UserRepository,PlanRepository,ProfessionalRepository,BookingRepository,SportsRepository};
use Illuminate\Support\Facades\Log;
use Auth;
use Session;
use File;
use Config;
use Redirect;
use View;
use DB;
use Response;
use Validator;
use App\{UserBookingStatus,User,Evidents,UserProfessionalDetail,UserService,CompanyInformation,BusinessServices,BusinessService,BusinessPriceDetails,UserBookingDetail,BusinessCompanyDetail,Fit_Cart,Sports,Customer,Payment,Miscellaneous,Jobpostquestions,UserFamilyDetail,MailService,Zip_code,BookingCheckinDetails,UserFavourite,BusinessServicesFavorite,Quote,BusinessServiceReview,BusinessActivityScheduler,BusinessSubscriptionPlan,Transaction,BusinessPriceDetailsAges,SGMailService,Recurring,StripePaymentMethod};
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DateTime;
use DateTimeZone;
use App\Services\CartService;

class PaymentController extends Controller {
	protected $sports;

    public function __construct(UserRepository $users, PlanRepository $planRepository, ProfessionalRepository $professionals, SportsRepository $sports, BookingRepository $bookings) {
        
        $this->middleware('auth', ['except' => ['getBladeDetail1','profileDetail', 'SendVerificationlinkCall', 'SendVerificationlinkMsg', 'makeCall', 'generateVoiceMessage', 'sendCustomMessage', 'getBladeDetail', 'newFUn', 'getBusinessClaim', 'getStateList', 'getCityList', 'familyProfileUpdate', 'submitFamilyForm', 'submitFamilyFormWithSkip', 'check', 'deleteCompany', 'submitFamilyForm1', 'skipFamilyForm1', 'getBusinessClaimDetaill', 'businessClaim', 'getLocationBusinessClaimDetaill', 'VerifySendVerificationlink', 'searchResultLocation', 'searchResultLocation1','profileView','sendmail','mailtemplate','about','postDetail']]);

        $this->bookings = $bookings;
        $this->planRepository = $planRepository;
        $this->users = $users;
        $this->professionals = $professionals;
        $this->sports = $sports;
        $this->arr = [];        
    }

    public function createCheckoutSession(Request $request) {
        //print_r($request->all());exit;
        $loggedinUser = Auth::user();
        $customer='';

        $cartService = new CartService();

        if($request->grand_total == 0){
            $orderdata = array(
                'user_id' => $loggedinUser->id,
                'status' => 'active',
                'currency_code' => 'usd',
                'amount' => $request->grand_total,
                'order_type' => 'simpleorder',
                'bookedtime' => Carbon::now()->format('Y-m-d'),
            );
            $userBookingStatus = UserBookingStatus::create($orderdata);

            $transactiondata = array( 
                'user_type' => 'user',
                'user_id' => $loggedinUser->id,
                'item_type' =>'UserBookingStatus',
                'item_id' => $userBookingStatus->id,
                'channel' =>'',
                'kind' => 'comp',
                'transaction_id' => '',
                'stripe_payment_method_id' => '',
                'amount' => $request->grand_total,
                'qty' =>'1',
                'status' =>'processing',
                'refund_amount' =>0,
                'payload' =>'',
            );

            $transactionstatus = Transaction::create($transactiondata);
            $lastid = $status->id; 

            foreach($cartService->items() as $item){
                $activityScheduler = BusinessActivityScheduler::find($item['actscheduleid']);
                $businessServices = BusinessServices::find($item['code']);
                $user = $businessServices->users;
                $price_detail = $cartService->getPriceDetail($item['priceid']);
                
                $customer = Customer::where(['business_id' => $businessServices->cid, 'email' => Auth::user()->email, 'user_id' => Auth::user()->id])->first();

                if(!$customer){
                    $customer = Customer::create([
                        'business_id' => $businessServices->cid,
                        'fname' => Auth::user()->firstname,
                        'lname' => (Auth::user()->lastname) ? Auth::user()->lastname : '',
                        'username' => Auth::user()->username,
                        'email' => Auth::user()->email,
                        'country' => 'US',
                        'status' => 0,
                        'phone_number' => Auth::user()->phone_number,
                        'birthdate' => Auth::user()->birthdate,
                        'user_id' => Auth::user()->id
                    ]);

                    $customer->create_stripe_customer_id();
                }

                $booking_detail = UserBookingDetail::create([                 
                    'booking_id' => $userBookingStatus->id,
                    'user_id'=> $customer->id,
                    'user_type'=> 'customer',
                    'sport' => $item['code'],
                    'bookedtime' => $item['sesdate'],
                    'business_id'=> $businessServices->cid,
                    'price' => json_encode($cartService->getQtyPriceByItem($item)['price']),
                    'qty' => json_encode($cartService->getQtyPriceByItem($item)['qty']),
                    'priceid' => $item['priceid'],
                    'pay_session' => $price_detail->pay_session,
                    'act_schedule_id' => $activityScheduler->id,
                    'expired_at' => $activityScheduler->end_activity_date,
                    'contract_date' => Carbon::now()->format('Y-m-d'),
                    'subtotal' => $cartService->getSubTotalByItem($item, $user),
                    'fitnessity_fee' => $cartService->getFitnessityFeeByItem($item, $user),
                    'tax' => 0,
                    'tip' => 0,
                    'discount' => 0,
                    'participate' => json_encode($item['participate']),
                    'transfer_provider_status' =>'unpaid',
                    'payment_number' => '{}',
                ]);

                $booking_detail->transfer_to_provider();

                $qty_c = $cartService->getQtyPriceByItem($item)['qty'];
                $price_detail = $cartService->getPriceDetail($item['priceid']);

                $tax_person = 0;
                if($qty_c['adult'] != 0){
                    $tax_person++;
                }if($qty_c['child']!= 0){
                    $tax_person++;
                }if($qty_c['infant'] != 0){
                    $tax_person++;
                }

                $per_person_tax = number_format(($tax / $tax_person),2);
                foreach($qty_c as $key=> $qty){
                    $re_i = 0;
                    $date = new Carbon;
                    $stripe_id = $stripe_charged_amount = $payment_method= '';

                    if($key == 'adult'){
                        if($qty != '' && $qty != 0){
                            $amount = $qty * $price_detail->recurring_first_pmt_adult;
                            $re_i = $price_detail->recurring_nuberofautopays_adult; 
                        }
                    }

                    if($key == 'child'){
                        if($qty != '' && $qty != 0){
                            $amount = $qty * $price_detail->recurring_first_pmt_child;
                            $re_i = $price_detail->recurring_nuberofautopays_child; 
                        }
                    }

                    if($key == 'infant'){
                        if($qty != '' && $qty != 0){
                            $amount = $qty * $price_detail->recurring_first_pmt_infant;
                            $re_i = $price_detail->recurring_nuberofautopays_infant;
                        }
                    }

                    if($qty != '' && $qty != 0){
                        if($re_i != '' && $re_i != 0 && $amount != ''){
                            for ($num = $re_i; $num >0 ; $num--) { 
                                if($num==1){
                                    $stripe_id =  '';
                                    $stripe_charged_amount = 0;
                                    $payment_method = '';
                                    $payment_date = $date->format('Y-m-d');
                                    $status = 'Completed';
                                }else{
                                    $month = $num - 1;
                                    $payment_date = (Carbon::now()->addMonth($month))->format('Y-m-d');
                                    $status = 'Scheduled';
                                } 

                                $recurring = array(
                                    "booking_detail_id" => $booking_detail->id,
                                    "user_id" => $loggedinUser->id,
                                    "user_type" => 'user',
                                    "business_id" => $booking_detail->business_id ,
                                    "payment_date" => $payment_date,
                                    "amount" => $amount,
                                    'charged_amount'=> $stripe_charged_amount,
                                    'payment_method'=> $payment_method,
                                    'stripe_payment_id'=> $stripe_id,
                                    "tax" => $per_person_tax,
                                    "status" => $status,
                                );
                                Recurring::create($recurring);
                            }
                        }
                    }
                }

                BookingCheckinDetails::create([
                    'business_activity_scheduler_id' => $activityScheduler->id,
                    'customer_id' => $customer->id,
                    'booking_detail_id' => $booking_detail->id,
                    'checkin_date' => date('Y-m-d',strtotime($item['sesdate'])),
                    'use_session_amount' => 0,
                    'source_type' => 'marketplace',
                ]);


                $company_email =  $businessServices->company_information->business_email;
                $getreceipemailtbody = $this->bookings->getreceipemailtbody($booking_detail->booking_id, $booking_detail->id);
                $email_detail = array(
                    'getreceipemailtbody' => $getreceipemailtbody,
                    'email' => Auth::user()->email);
                SGMailService::sendBookingReceipt($email_detail);


                $email_detail2 = array(
                    "email" => $company_email, 
                    "CustomerName" => @$cartService->getCompany($businessServices->cid)->full_name, 
                    "Url" => env('APP_URL').'/personal/orders?business_id='.$businessServices->cid, 
                    "BusinessName"=> @$cartService->getCompany($businessServices->cid)->company_name,
                    "BookedPerson"=> Auth::user()->full_name,
                    "ParticipantsName"=> @$cartService->getParticipateByComa($item['participate']),
                    "date"=> Carbon::parse($item['sesdate'])->format('m/d/Y'),
                    "time"=> $activityScheduler->activity_time(),
                    "duration"=> $activityScheduler->get_clean_duration(),
                    "ActivitiyType"=> $businessServices->service_type,
                    "ProgramName"=> $businessServices->program_name,
                    "CategoryName"=> $price_detail->business_price_details_ages_with_trashed->category_title);

                SGMailService::confirmationMail($email_detail2);
            }

            $updatedCartitems = $cartService->updatedCartitems();
            session()->put('cart_item', $updatedCartitems);
            return view('jobpost.confirm-payment-instant');
        }else{
            \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
            $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));

            if($loggedinUser->stripe_customer_id != '') {
                $stripe_customer_id = $loggedinUser->stripe_customer_id;
            }else{
                $stripe_customer_id = $loggedinUser->create_stripe_customer_id();
            }

            $totalprice = 0;
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
                            'status' => 'active',
                            'currency_code' => 'usd',
                            'amount' => $totalprice,
                            'bookedtime' =>Carbon::now()->format('Y-m-d'),
                        ); 
                        $userBookingStatus = UserBookingStatus::create($orderdata);

                        $transactiondata = array( 
                            'user_type' => 'user',
                            'user_id' => $loggedinUser->id,
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
                }catch(\Stripe\Exception\CardException $e) {
                    $errormsg = $e->getError()->message;
                    return redirect('/carts')->with('stripeErrorMsg', $errormsg);
                }catch (Exception $e) {
                    $errormsg = $e->getError()->message;
                    return redirect('/carts')->with('stripeErrorMsg', $errormsg);
                }
            }else{
               // echo $request->new_card_payment_method_id;
                $newCardPaymentMethodId = $request->new_card_payment_method_id;
              //  echo  $newCardPaymentMethodId;exit;
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
                    if(!$request->has('save_card')){
                        $stripePaymentMethod = \App\StripePaymentMethod::where('payment_id', $newCardPaymentMethodId)->firstOrFail();
                        $stripePaymentMethod->delete();
                    }

                    if($newCardPaymentIntent['status'] == 'succeeded'){
                        $orderdata = array(
                            'user_id' => Auth::user()->id,
                            'status' => 'active',
                            'currency_code' => 'usd',
                            'amount' => $totalprice,
                            'bookedtime' => Carbon::now()->format('Y-m-d'),
                        ); 
                        $userBookingStatus = UserBookingStatus::create($orderdata);

                        $transactiondata = array( 
                            'user_type' => 'user',
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
                }catch(\Stripe\Exception\CardException $e) {
                    $errormsg = $e->getError()->message;
                    return redirect('/carts')->with('stripeErrorMsg', $errormsg);
                }catch (Exception $e) {
                    $errormsg = $e->getError()->message;
                    return redirect('/carts')->with('stripeErrorMsg', $errormsg);
                }
            }

            $bspdata = BusinessSubscriptionPlan::where('id',1)->first();
            $tax = $bspdata->site_tax;

            foreach($cartService->items() as $item){
              
                $activityScheduler = BusinessActivityScheduler::find($item['actscheduleid']);
                $businessServices = BusinessServices::find($item['code']);
                $user = $businessServices->user;
                $price_detail = $cartService->getPriceDetail($item['priceid']);

                $customer = Customer::where(['business_id' => $businessServices->cid, 'email' => Auth::user()->email, 'user_id' => Auth::user()->id])->first();

                if(!$customer){
                    $customer = Customer::create([
                        'business_id' => $businessServices->cid,
                        'fname' => Auth::user()->firstname,
                        'lname' => (Auth::user()->lastname) ? Auth::user()->lastname : '',
                        'username' => Auth::user()->username,
                        'email' => Auth::user()->email,
                        'country' => 'US',
                        'status' => 0,
                        'phone_number' => Auth::user()->phone_number,
                        'birthdate' => Auth::user()->birthdate,
                        'user_id' => Auth::user()->id
                    ]);

                    $customer->create_stripe_customer_id();
                }

                $booking_detail = UserBookingDetail::create([                 
                    'booking_id' => $userBookingStatus->id,
                    'user_id'=> $customer->id,
                    'user_type'=> 'customer',
                    'sport' => $item['code'],
                    'bookedtime' => Carbon::now()->format('Y-m-d'),
                    'business_id'=> $businessServices->cid,
                    'price' => json_encode($cartService->getQtyPriceByItem($item)['price']),
                    'qty' => json_encode($cartService->getQtyPriceByItem($item)['qty']),
                    'priceid' => $item['priceid'],
                    'pay_session' => $price_detail->pay_session,
                    'act_schedule_id' => $activityScheduler->id,
                    'expired_at' => $activityScheduler->end_activity_date,
                    'contract_date' => Carbon::now()->format('Y-m-d'),
                    'subtotal' => $cartService->getSubTotalByItem($item, $user),
                    'fitnessity_fee' => $cartService->getFitnessityFeeByItem($item, $user),
                    'tax' =>  ($cartService->getGrossSubtotalByItem($item) * $tax )/100,
                    'tip' => 0,
                    'discount' => $cartService->getDiscountTotal($item),
                    'participate' => json_encode($item['participate']),
                    'transfer_provider_status' =>'unpaid',
                    'payment_number' => '{}',
                ]);

                $booking_detail->transfer_to_provider();

                $qty_c = $cartService->getQtyPriceByItem($item)['qty'];
                $price_detail = $cartService->getPriceDetail($item['priceid']);

                $tax_person = 0;
                if($qty_c['adult'] != 0){
                    $tax_person++;
                }if($qty_c['child']!= 0){
                    $tax_person++;
                }if($qty_c['infant'] != 0){
                    $tax_person++;
                }

                $per_person_tax = number_format(($tax / $tax_person),2); 
                foreach($qty_c as $key=> $qty){
                    $re_i = 0;
                    $date = new Carbon;
                    $stripe_id = $stripe_charged_amount = $payment_method= '';

                    if($key == 'adult'){
                        if($qty != '' && $qty != 0){
                            $amount = $qty * $price_detail->recurring_first_pmt_adult;
                            $re_i = $price_detail->recurring_nuberofautopays_adult; 
                        }
                    }

                    if($key == 'child'){
                        if($qty != '' && $qty != 0){
                            $amount =  $qty * $price_detail->recurring_first_pmt_child;
                            $re_i = $price_detail->recurring_nuberofautopays_child; 
                        }
                    }

                    if($key == 'infant'){
                        if($qty != '' && $qty != 0){
                            $amount =  $qty * $price_detail->recurring_first_pmt_infant;
                            $re_i = $price_detail->recurring_nuberofautopays_infant;
                        }
                    }

                    if($qty != '' && $qty != 0){
                        if($re_i != '' && $re_i != 0 && $amount != ''){
                            for ($num = $re_i; $num >0 ; $num--) { 
                                if($num==1){
                                    $stripe_id =  '';
                                    $stripe_charged_amount = 0;
                                    $payment_method = '';
                                    $payment_date = $date->format('Y-m-d');
                                    $status = 'Completed';
                                }else{
                                    $month = $num - 1;
                                    $payment_date = (Carbon::now()->addMonth($month))->format('Y-m-d');
                                    $status = 'Scheduled';
                                } 

                                $recurring = array(
                                    "booking_detail_id" => $booking_detail->id,
                                    "user_id" => $loggedinUser->id,
                                    "user_type" => 'user',
                                    "business_id" => $booking_detail->business_id ,
                                    "payment_date" => $payment_date,
                                    "amount" => $amount,
                                    'charged_amount'=> $stripe_charged_amount,
                                    'payment_method'=> $payment_method,
                                    'stripe_payment_id'=> $stripe_id,
                                    "tax" => $per_person_tax,
                                    "status" => $status,
                                );
                                Recurring::create($recurring);
                            }
                        }
                    }
                }

                BookingCheckinDetails::create([
                    'business_activity_scheduler_id' => $activityScheduler->id,
                    'customer_id' => $customer->id,
                    'booking_detail_id' => $booking_detail->id,
                    'checkin_date' => date('Y-m-d',strtotime($item['sesdate'])),
                    'use_session_amount' => 0,
                    'source_type' => 'marketplace',
                ]);

                $getreceipemailtbody = $this->bookings->getreceipemailtbody($booking_detail->booking_id, $booking_detail->id);
                $email_detail = array(
                    'getreceipemailtbody' => $getreceipemailtbody,
                    'email' => Auth::user()->email);
                SGMailService::sendBookingReceipt($email_detail);
               
                $email_detail2 = array(
                    "email" => @$cartService->getCompany($businessServices->cid)->business_email, 
                    "CustomerName" => @$cartService->getCompany($businessServices->cid)->full_name, 
                    "Url" => env('APP_URL').'/personal/orders?business_id='.$businessServices->cid, 
                    "BusinessName"=> @$cartService->getCompany($businessServices->cid)->company_name,
                    "BookedPerson"=> Auth::user()->full_name,
                    "ParticipantsName"=> @$cartService->getParticipateByComa( json_encode($item['participate'])),
                    "date"=> Carbon::parse($item['sesdate'])->format('m/d/Y'),
                    "time"=> $activityScheduler->activity_time(),
                    "duration"=> $activityScheduler->get_clean_duration(),
                    "ActivitiyType"=> $businessServices->service_type,
                    "ProgramName"=> $businessServices->program_name,
                    "CategoryName"=> $price_detail->business_price_details_ages_with_trashed->category_title);

                SGMailService::confirmationMail($email_detail2);
            }

            $updatedCartitems = $cartService->updatedCartitems();
            session()->put('cart_item', $updatedCartitems);

            return redirect('/instant-hire/confirm-payment');
        }
    }

    public function confirmpaymentinstant(Request $request) {
        return view('jobpost.confirm-payment-instant');
    }

    public function form_participate(Request $request){
     /*   print_r($request->all());exit;*/
        $cart_item = [];
        if ($request->session()->has('cart_item')) {
            $cart_item = $request->session()->get('cart_item');
        }
        if(in_array($request->act, array_keys($cart_item["cart_item"]))) {
            foreach($cart_item["cart_item"] as $k => $v) {
                if($request->act == $k) {
                    if($request->type == 'user'){
                        $cart_item["cart_item"][$k]["participate"][$request->counter]['id'] = Auth::user()->id;
                        $cart_item["cart_item"][$k]["participate"][$request->counter]['from'] = 'user';
                    }else{
                        $cart_item["cart_item"][$k]["participate"][$request->counter]['id'] = $request->familyid;
                        $cart_item["cart_item"][$k]["participate"][$request->counter]['from'] = 'family';
                    }
                }
            }
        }
        $request->session()->put('cart_item', $cart_item);
    } 


    public function refresh_payment_methods(Request $request){
        $user = User::findOrFail($request->user_id);
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $payment_methods = $stripe->paymentMethods->all(['customer' => $user->stripe_customer_id, 'type' => 'card']);
        foreach($payment_methods as $payment_method){
            $stripePaymentMethod = StripePaymentMethod::firstOrNew([
                'payment_id' => $payment_method['id'],
                'user_type' => 'User',
                'user_id' => $user->id,
            ]);

            $stripePaymentMethod->pay_type = $payment_method['type'];
            $stripePaymentMethod->brand = $payment_method['card']['brand'];
            $stripePaymentMethod->exp_month = $payment_method['card']['exp_month'];
            $stripePaymentMethod->exp_year = $payment_method['card']['exp_year'];
            $stripePaymentMethod->last4 = $payment_method['card']['last4'];
            $stripePaymentMethod->save();
        }
        if($request->return_url)
            return redirect($request->return_url);
    }
    
}
