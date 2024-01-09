<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth,Redirect,Storage,Hash,Response;
use App\{UserFollow,BusinessServicesFavorite,StripePaymentMethod,User,CompanyInformation,Customer,Transaction,CustomerNotes,Recurring,CustomersDocuments,Announcement,BookingCheckinDetails};
use App\Repositories\{BookingRepository};

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $user;
    protected $booking_repo;

    public function __construct(BookingRepository $booking_repo) {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
         $this->booking_repo = $booking_repo;
    }

    public function dashboard(Request $request)
    {
        $business = CompanyInformation::find($request->business_id);
        if($request->customer_id){
            if(request()->type == 'user'){
                $familyMember = $this->user->user_family_details()->where('id',request()->customer_id)->first();
                $user = User::where(['firstname'=> @$familyMember->first_name, 'lastname'=>@$familyMember->last_name, 'email'=>@$familyMember->email])->first();
                $customer = Customer::where(['user_id' => @$user->id])->first();
                $name = @$familyMember->full_name;
            }else{
                $customer = Customer::find(request()->customer_id);
                $name = @$customer->full_name;
            }
        }else{
            $customer = Customer::where(['business_id'=>$request->business_id,'user_id'=>Auth::user()->id])->first();
            $name = @$customer->full_name;
        }

        $attendanceCnt = BookingCheckinDetails::where('customer_id' ,@$customer->id)->whereMonth('checkin_date', '>=', date('m'))->whereMonth('checkin_date', '<=', date('m'))->whereNotNull('checked_at')->count();
        $attendanceCntPre = BookingCheckinDetails::where('customer_id' ,@$customer->id)->whereMonth('checkin_date', '>=', date('m') - 1)->whereMonth('checkin_date', '<=', date('m') - 1 )->whereNotNull('checked_at')->count();
        $attendancePct =  $attendanceCntPre != 0 ? number_format(($attendanceCnt - $attendanceCntPre)*100/$attendanceCntPre,2,'.','') : 0;

        $bookingCnt = $business->UserBookingDetails()->where('user_id' ,@$customer->id)->whereMonth('created_at', '>=', date('m'))->whereMonth('created_at', '<=', date('m'))->count();
        $bookingCntPre = $business->UserBookingDetails()->where('user_id' ,@$customer->id)->whereMonth('created_at', '>=', date('m') - 1)->whereMonth('created_at', '<=', date('m') - 1)->count();
        $bookingPct =  $bookingCntPre != 0 ? number_format(($bookingCnt - $bookingCntPre)*100/$bookingCntPre,2,'.','') : 0;

        $notesCnt = CustomerNotes::where(['customer_id'=> @$customer->id ,'display_chk' => 1])->orderby('due_date','desc')->whereDate('due_date', '=', now())->whereTime('time', '<=', now()->format('H:i'))
                ->orWhere(function ($query) use($customer) {
                    $query->whereDate('due_date', '<=', now())->where('customer_id', @$customer->id )->where('display_chk' ,1);
                })->where('business_id', $request->business_id)->count();

        $notesCntNew = CustomerNotes::where(['customer_id'=> @$customer->id ,'display_chk' => 1])->orderby('due_date','desc')->whereDate('due_date', '=', now())->whereTime('time', now()->format('H:i'))
                ->orWhere(function ($query) use($customer) {
                    $query->whereDate('due_date', now())->where('customer_id', @$customer->id )->where('display_chk' ,1);
                })->where('business_id', $request->business_id)->count();

        $expiredCards = StripePaymentMethod::where(['user_id'=> @$customer->id, 'user_type' => 'Customer'])->where('exp_year','<=', date('Y'))->where('exp_month','<', date('m'))->count();
        $missedPayments = Recurring::where(['user_id'=> @$customer->id, 'user_type' => 'Customer'])->where('status' ,'!=','Completed')->whereDate('payment_date' ,'<' ,date('Y-m-d'))->count();

        $notesCnt += $expiredCards;
        $notesCnt += $missedPayments;

        $activeMembershipCnt = count($this->booking_repo->currentTab($request->serviceType,$request->business_id,@$customer));
        $activeMembershipCntNew = $business->UserBookingDetails()->where('user_id' ,@$customer->id)->whereDate('created_at', date('Y-m-d'))->count();

        $docCnt =  $documents = CustomersDocuments::where('customer_id',  @$customer->id)->where('business_id', $request->business_id)->count();

        $docCntNew =  $documents = CustomersDocuments::where('customer_id',  @$customer->id)->where('business_id', $request->business_id)->whereDate('created_at',date('Y-m-d'))->count();

        $announcemetCnt = Announcement::where(['business_id' => $request->business_id, 'status' => 'active'])
                ->where(function ($query) {
                    $query->whereDate('announcement_date', '<=', date('Y-m-d'))->whereTime('announcement_time', '<=', date('H:i'));
                    })->orWhere(function ($query) {
                        $query->whereDate('announcement_date', '<=', date('Y-m-d'))->whereNull('announcement_time');
                })->count();

        $announcemetCntNew = Announcement::where(['business_id' => $request->business_id, 'status' => 'active'])->whereDate('announcement_date', date('Y-m-d'))->count();

        $classes = BookingCheckinDetails::where('customer_id' ,@$customer->id)->whereDate('checkin_date' , '>=' , date('Y-m-d'))->get();

        return view('personal.profile.dashboard',compact('name','notesCnt','activeMembershipCnt','docCnt','docCntNew','announcemetCnt','attendanceCnt','announcemetCntNew','bookingCnt','bookingPct','classes','attendancePct','business','notesCntNew','activeMembershipCntNew'));
    }


    public function index(Request $request)
    {
        if($request->customer_id){
            if(request()->type == 'user'){
                $user = $this->user->user_family_details()->where('id',request()->customer_id)->first();
                return view('personal.profile.user_family_profile',compact('user'));
            }else{
                $user = Customer::find(request()->customer_id);
                return view('personal.profile.customer_profile',compact('user'));
            }
        }else{
            $user = $this->user; 
            return view('personal.profile.index',compact('user'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Responsall();exit;
     */
    public function store(Request $request)
    {   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   //print_r($request->all());exit;
        $user =  $this->user;
        $success = $fail = '';
        if($request->type == 'details'){
            $this->validate($request, [
                'firstname' => 'required',
                'lastname' => 'required',
                'gender' => 'required',
                'phone_number' => 'required',
                'address' => 'required',
            ]);

            $status = $user->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'gender' => $request->gender,
                'phone_number' => $request->phone_number,
                'dobstatus' => $request->dobstatus,
                'address' => $request->address,
                'country' => $request->country,
                'zipcode' => $request->zipcode,
                'state' => $request->state,
                'city' => $request->city,
                'birthdate' => date('Y-m-d', strtotime($request['birthdate'])),
                'quick_intro' => $request->user_intro,
                'favorit_activity' => $request->favorit_activity,
                'business_info' => $request->about_user,
            ]);

            $success = 'Profile updated succesfully!';
            $fail = 'Problem in profile update.';
        }else if($request->type == 'password'){
            $currentPassword = $user->password;
            if (Hash::check($request->newPassword, $currentPassword)) {
                $status = $user->update(['password' => Hash::make($request->newPassword)]);
                $success = 'Password has been changed successfully.';
            }else{
                $fail = 'Problem in password change.Please check your old password and enter again.';
            }
        }else if($request->type == 'portfolio'){
            $data = $request->all();
            unset($data['_token']);
            unset($data['id']);
            unset($data['type']);
            $user->update($data);
        }else{

            $profilePic = $coverPic ='';
            if($request->hasFile('profile_pic')){
                $profilePic = $request->file('profile_pic')->store('customer');
            }else{
                $profilePic = $user->profile_pic;
            }

            if($request->hasFile('coverPic')){
                $coverPic = $request->file('coverPic')->store('customer');
            }else{
                $coverPic = $user->cover_photo;
            }

            @$status = $user->update(['profile_pic' => $profilePic,'cover_photo' => $coverPic]);
            $success = 'Profile photo has been changed successfully.';
            $fail = 'Problem in uploading profile photo.';
        }
        

        if(@$status)
            return Redirect::back()->with('success',$success);
        else
            return Redirect::back()->with('error', $fail);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function userFamilyProfileUpdate(Request $request){
        $user = $this->user->user_family_details()->where('id',$request->id)->first();
        $success = $fail = '';
        if($request->type == 'details'){
            $this->validate($request, [
                'firstname' => 'required',
                'lastname' => 'required',
                'gender' => 'required',
                'phone_number' => 'required'
            ]);

            $status = $user->update([
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'gender' => $request->gender,
                'mobile' => $request->phone_number,
                'birthday' => $request->birthday,
                'emergency_contact' => $request->emergency_contact,
                'relationship' => $request->relationship,
            ]);

            $success = 'Profile updated succesfully!';
            $fail = 'Problem in profile update.';
        }else{
            $profilePic = $coverPic ='';
            if($request->hasFile('profile_pic')){
                $profilePic = $request->file('profile_pic')->store('customer');
            }else{
                $profilePic = $user->profile_pic;
            }


            @$status = $user->update(['profile_pic' => $profilePic]);
            $success = 'Profile photo has been changed successfully.';
            $fail = 'Problem in uploading profile photo.';
        }
        

        if(@$status)
            return Redirect::back()->with('success',$success);
        else
            return Redirect::back()->with('error', $fail);
    }

    public function customerProfileUpdate(Request $request){
        $user = Customer::find($request->id);
        $success = $fail = '';
        if($request->type == 'details'){
            $this->validate($request, [
                'firstname' => 'required',
                'lastname' => 'required',
                'gender' => 'required',
                'phone_number' => 'required'
            ]);

            $status = $user->update([
                'fname' => $request->firstname,
                'lname' => $request->lastname,
                'gender' => $request->gender,
                'phone_number' => $request->phone_number,
                'birthdate' => $request->birthdate,
                'address' => $request->address,
                'country' => $request->country,
                'zipcode' => $request->zipcode,
                'state' => $request->state,
                'city' => $request->city,
            ]);

            $success = 'Profile updated succesfully!';
            $fail = 'Problem in profile update.';
        }else{
            $profilePic = $coverPic ='';
            if($request->hasFile('profile_pic')){
                $profilePic = $request->file('profile_pic')->store('customer');
            }else{
                $profilePic = $user->profile_pic;
            }


            @$status = $user->update(['profile_pic' => $profilePic]);
            $success = 'Profile photo has been changed successfully.';
            $fail = 'Problem in uploading profile photo.';
        }
        

        if(@$status)
            return Redirect::back()->with('success',$success);
        else
            return Redirect::back()->with('error', $fail);
    }

    public function provider(Request $request){
        $company_information = [];$continue = 0;
        if($request->customer_id){
            if($request->type == 'user'){
                $familyMember =  $this->user->user_family_details()->where('id',request()->customer_id)->first();
                $user = User::where(['firstname'=> @$familyMember->first_name, 'lastname'=>@$familyMember->last_name, 'email'=>@$familyMember->email])->first();
                $continue = 1;
                $id = @$user->id;
            }else{
                $customerDetail  = Customer::find($request->customer_id);
                $user = $customerDetail->user;
                $id = @$user->id;
                if($user){
                    $continue = 1;
                }else{
                    $company_information []= $customerDetail->company_information;
                }
            }
        }else{
            $user = $this->user;
            $id = $user->id;
            $continue = 1;
        }
        
        if($continue == 1){
            $customer = @$user->customers;
            if($customer){
                foreach($customer as $cs){
                    $company_information []= $cs->company_information;
                }
            }
        }

        /*$url = url()->current();
        $separator = (parse_url($url, PHP_URL_QUERY) == null) ? '?' : '&';*/
        $business = array_values(array_filter(array_unique($company_information, SORT_REGULAR)));
        return view('personal.provider.index',compact('business','id'));
    }

    public function contactInfo(Request $request){
        $company = CompanyInformation::find($request->company);
        return view('personal.provider.contact_info',['company' => $company])->render();
    }

    public function updatePortfolio(Request $request){
        $data = $request->all();
        unset($data['_token']);
        unset($data['id']);
        unset($data['type']);
        //print_r($data);
        $user =  $this->user;
        $user->update($data);
    }

    public function following(){
        $user = $this->user;
        $followDetail = UserFollow::where("follower_id", "=", $user->id)->get();
        return view('personal.profile.following',compact('user','followDetail'));
    }

    public function followers(){
        $user = $this->user;
        $followDetail = UserFollow::where("follower_id", $this->user->id)
            ->whereIn('user_id', function ($query) {
                $query->select('id')->from('users');
            })->get();
        return view('personal.profile.followers',compact('user','followDetail'));
    }

    public function favourite(){
        $user = $this->user;
        $favDetail = BusinessServicesFavorite::select("business_services.id", "business_services.program_name", 
        "business_services.profile_pic", "business_services.sport_activity", "business_services_favorite.service_id", 
        "business_services_favorite.user_id")->join("business_services", "business_services_favorite.service_id", "=", "business_services.id")->where("business_services_favorite.user_id",  $this->user->id)->get();
        return view('personal.profile.favourite',compact('user','favDetail'));
    }

    public function removefollower(Request $request) {
        $remove_id = $request->fid;
        $del = UserFollow::where('user_id', $remove_id)->where('follower_id', $this->user->id)->delete();
    
        if($del){
            $response = array(
                'type' => 'success',
                'msg' => 'Successfully removed follower',
            );
        }else{
            $response = array(
                'type' => 'fail',
                'msg' => 'Something wrong please try again',
            );
        }
        
        return Response::json($response);
    }

    public function followBack(Request $request) {
        $followback = UserFollow::create([
                    'user_id' => $this->user->id,
                    'follow_id' => $request->id ?? 0,
                    'follower_id' =>$request->userid
                ]);
        if($followback){
            $response = array( 'type' => 'success', );
        }else{
            $response = array( 'type' => 'fail', );
        }
        return Response::json($response);
    }

    public function followingUpdate(Request $request){
        $delete = UserFollow::where('user_id',  $this->user->id)->where('follower_id', $request->fid)->delete();
        if($delete){
            $response = array(
                'type' => 'success',
            );
        }else{
            $response = array(
                'type' => 'fail',
                'msg' => 'Something wrong please try again',
            );
        }
        return Response::json($response);
    }

    public function serviceFavourite(){
        $ser_id = $request->ser_id;
        $user = $this->user;
        $status='';
        $favData = BusinessServicesFavorite::where('user_id',$user)->where('service_id',$ser_id)->first();
        if(!empty($favData)){
            BusinessServicesFavorite::find($favData->id)->delete();
            $status='unlike';
        }else{
            $data=array(
                "user_id" =>  $this->user->id,
                "service_id" => $ser_id,
            );
            BusinessServicesFavorite::create($data);
            $status='like';
        }
        return response()->json(array("success"=>'success','status'=>$status)); 
    }

    public function creditCards(){
        $cardInfo = [];
        $intent = null;
        $user = $this->user;
        $customers = $user->customers()->pluck('id')->toArray();
        $customer_ids = implode(',',$customers);

        $query = StripePaymentMethod::where('user_type', 'user')
            ->where('user_id',$user->id);

        if ($customer_ids) {
            $query->orWhere(function($subquery) use ($customer_ids) {
                $subquery->where('user_type', 'customer')
                    ->whereIn('user_id', explode(',', $customer_ids));
            });
        }

        $cardInfo = $query->orderBy('created_at', 'desc')->get();

        \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        if($user->stripe_customer_id != ''){
            $intent = $stripe->setupIntents->create([
                'payment_method_types' => ['card'],
                'customer' => $user->stripe_customer_id,
            ]);
        }

        return view('personal.profile.credit_cards',compact('cardInfo','intent'));
    }

    public function cardsSave(Request $request) {
       
        $user = User::where('id', $this->user->id)->first();
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $payment_methods = $stripe->paymentMethods->all(['customer' => $user->stripe_customer_id, 'type' => 'card']);
        $fingerprints = [];
        foreach($payment_methods as $payment_method){
            $fingerprint = $payment_method['card']['fingerprint'];
            if (in_array($fingerprint, $fingerprints, true)) {
                $deletePaymentMethod = StripePaymentMethod::where('payment_id', $payment_method['id'])->first();
                if($deletePaymentMethod != ''){
                    $deletePaymentMethod->delete();
                }
            } else {
                $fingerprints[] = $fingerprint;
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

                $customer = Customer::where(['fname' =>$user->firstname,'lname' =>$user->lastname, 'email' => $user->email])->get();

                if ($stripePaymentMethod->wasRecentlyCreated && !empty($customer) ) {
                  
                    foreach($customer as $cus){
                        $spmForCus = StripePaymentMethod::create([
                            'payment_id' => $payment_method['id'],
                            'user_type' => 'Customer',
                            'user_id' => $cus->id,
                            'pay_type' => $payment_method['type'],
                            'brand' => $payment_method['card']['brand'],
                            'exp_month' => $payment_method['card']['exp_month'],
                            'exp_year' => $payment_method['card']['exp_year'],
                            'last4' => $payment_method['card']['last4'],
                        ]);
                    }
                }
            }
        }

        if($request->chkRedirection == 1){
            $user->show_step = 7;
            $user->save();
            return redirect('/registration/?showstep=1'); 
        }else{
            return redirect()->route('personal.credit-cards'); 
        }    
    }

    public function cardDelete(Request $request) {
        $user = User::where('id', $this->user->id)->first();
        $stripePaymentMethod = \App\StripePaymentMethod::where('payment_id', $request->stripe_payment_method)->firstOrFail();

        $stripePaymentMethod->delete();
    }

    public function paymentHistory(Request $request){
        $user = $this->user;
        if(!request()->business_id){
            return redirect()->route('personal.manage-account.index');
        }
        $customers = $user->customers()->where('business_id',request()->business_id)->pluck('id')->toArray();
        $customer_ids = implode(',',$customers);

        $business_id = request()->business_id;

        $query2 = Transaction::where(['transaction.user_type' => 'user', 'transaction.user_id' => $this->user->id])
            ->leftJoin("user_booking_status as ubs", "transaction.item_id", "=", "ubs.id")->join("user_booking_details as usd", function ($join) use ($business_id) {
                    $join->on("ubs.id", "=", "usd.booking_id")->where('usd.business_id', $business_id)
                        ->where('usd.order_type', 'Membership')
                        ->whereNotNull('usd.id');
            });

        if ($customer_ids) {
            $query2->orWhere(function ($subquery) use ($customer_ids,$business_id) {
                $subquery->where('transaction.user_type', 'customer')
                    ->whereIn('transaction.user_id', explode(',', $customer_ids))
                    ->leftJoin("user_booking_status as ubs1", "transaction.item_id", "=", "ubs1.id")
                    ->join("user_booking_details as usd1", function ($join) use ($business_id) {
                        $join->on("ubs1.id", "=", "usd1.booking_id")
                            ->where('usd1.business_id', $business_id)
                            ->where('usd1.order_type', 'Membership')
                            ->whereNotNull('usd1.id');
                    });
            });
        }

        $query2->leftJoin("recurring as rt", "transaction.item_id", "=", "rt.id")
            ->orWhere(function ($query) use ($business_id) {
                $query->where('rt.business_id', $business_id)->join("user_booking_details as rusd", function ($join) use ($business_id) {
                    $join->on("rt.booking_detail_id", "=", "rusd.id")->where('rusd.business_id', $business_id)
                        ->where('rusd.order_type', 'Membership')
                        ->whereNotNull('rusd.id');
                    });
            });

        $transactionDetail = $query2->select('transaction.*')->orderBy('transaction.created_at', 'DESC')->paginate(10);

       
        return view('personal.profile.payment_history', compact('transactionDetail')); 
    }


}
