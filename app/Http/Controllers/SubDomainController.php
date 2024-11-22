<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanyInformation;
use App\User;
use App\Repositories\{BookingRepository};
use App\{BusinessServices,BusinessService,BusinessPriceDetails,BusinessClassPriceDetails,BusinessSubscriptionPlan,BusinessPriceDetailsAges,BusinessActivityScheduler,UserFollow,BusinessServicesFavorite,StripePaymentMethod,Customer,Transaction,CustomerNotes,Recurring,CustomersDocuments,Announcement,BookingCheckinDetails,BusinessTerms,UserBookingDetail,SGMailService,UserFamilyDetail,UserBookingStatus};
use App\WebsiteIntegration;
use DB,Carbon\Carbon;
use Validator;
use Illuminate\Support\Facades\Auth; 
use DateTime;
use Session;
use Response;
use App\Repositories\CustomerRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\BusinessStaff;
use App\Services\CartService;
use View;
use Stripe\StripeClient;
use Exception;
use Illuminate\Support\Facades\Redirect;
use App\Services\CartWidgetService;
use Illuminate\Support\Facades\Crypt;
use App\helpers\CartHelper;
use App\CartWidget;

class SubDomainController extends Controller
{
    //
    protected $user;
    protected $booking_repo;

    public function __construct(CustomerRepository $customers,BookingRepository $booking_repo) {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
        $this->customers = $customers;

         $this->booking_repo = $booking_repo;
    }

    public function Loginindex($unique_code)
    {    
        // if (Auth::check()) {
        //     return redirect()->route('sub_customer_dashboard');
        // }
        
        $code=$unique_code;
        $code = CompanyInformation::where('unique_code', $code)->first();
        $companyinfo=WebsiteIntegration::where('user_id',$code->user_id)->first();
        return view('subdomain.userlogin',compact('code','companyinfo'));
    }
    public function loadRegisterPage(Request $request)
    {
        // dd('8');
        $uniqueCode = $request->input('unique_code');
        $companyinfo = CompanyInformation::where('unique_code', $uniqueCode)->first();
        $registerContent = view('subdomain.register', compact('companyinfo'))->render(); 
        // dd($registerContent);   
        return response()->json($registerContent);
    }
    public function getCheckinCode(Request $request){
        if($request->checkin_code){
            $user = User::where('unique_code' , $request->checkin_code)->where('email' , '!=' , $request->email)->first();
            if($user){ return 1; }
            return 0;
        }else{
            $user = User::where(['email' => $request->email])->whereRaw('LOWER(firstname) = ?', [strtolower($request->fname)])
                ->whereRaw('LOWER(lastname) = ?', [strtolower($request->lname)])->first();
            if($user){ return $user->unique_code;}
            else{ return generateUniqueCode(); }
        }
    }
    public function RegisterPage($unique_code)
    {
        $code=$unique_code;
        $code = CompanyInformation::where('unique_code', $code)->first();
        $companyinfo=WebsiteIntegration::where('user_id',$code->user_id)->first();
        return view('subdomain.register', compact('code','companyinfo'))->render();    
    }

    public function UserLogin(Request $request)
    {
        // Validate incoming request
        // $host = request()->getHost();
        // dd($host);/
     
        $postArr = $request->input();
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];

        $validator = Validator::make($postArr, $rules);

        if ($validator->fails()) {
            $errMsg = array_flatten($validator->messages()->all());
            $response = [
                'type' => 'danger',
                'msg' => $errMsg,
            ];
            return response()->json($response);
        } else {
            $currentDate = Carbon::now();
            $resultDate = $currentDate->subYears(18)->format('Y-m-d');

            if (Auth::attempt(['email' => $postArr['email'], 'password' => $postArr['password'], 'activated' => 1, 'primary_account' => 1])) {
                $user = Auth::user();
                $userBirthdate = Carbon::parse($user->birthdate);
                $resultDate = Carbon::parse($resultDate);

                if ($userBirthdate <= $resultDate) {
                    session_start();
                    User::whereId($user->id)->update(['last_login' => now(), 'last_ip' => $request->ip()]);
                    $_SESSION["myses"] = $request->user();

                    $claim = 'not set';
                    $claim_cid = $claim_status = $claim_cname = $claim_welcome = $checkoutsession = $schedule = $onboard = '';
                    
                    // Check for session variables and set values accordingly
                    // if (session()->has('claim_business_page')) {
                    //     $claim = 'set';
                    //     $claim_cid = session('claim_cid');
                    //     $data = CompanyInformation::find($claim_cid);
                    //     $claim_cname = $data ? $data->company_name : '';
                    //     $claim_status = session('claim_status');
                    // }

                    // if (session()->has('business_welcome')) {
                    //     $claim_welcome = session('business_welcome');
                    // }

                    // if (session()->has('checkoutsession')) {
                    //     $checkoutsession = session('checkoutsession');
                    // }

                    // if (session()->has('schedule')) {
                    //     $schedule = session('schedule');
                    // }

                    // if (session()->has('redirectToOnboard')) {
                    //     $onboard = session('redirectToOnboard');
                    // }

                    // Handle various redirects based on session values
                    $redirectUrl = '/sub_customer_dashboard';
                    // if ($onboard != '') {
                    //     $redirectUrl = $onboard;
                    // } elseif ($request->redirect) {
                    //     $redirectUrl = $request->redirect;
                    // } elseif ($claim == 'set') {
                    //     $redirectUrl = '/claim/reminder/' . $claim_cname . "/" . $claim_cid;
                    // } elseif ($checkoutsession != '') {
                    //     $redirectUrl = '/carts';
                    // } elseif ($schedule != '') {
                    //     $redirectUrl = '/business_activity_schedulers/' . $schedule;
                    // } else {
                    //     $redirectUrl = route('homepage');
                    // }

                    return response()->json(['type' => 'success', 'redirect' => $redirectUrl]);
                } else {
                    return response()->json(['type' => 'danger', 'msg' => 'You must be at least 18 years old to log in.']);
                }
            } else {
                return response()->json(['type' => 'danger', 'msg' => 'Invalid credentials or your account is not activated.']);
            }
        }
    }

    public function next_8_hours(Request $request, $unique_code)
    {
        $code = CompanyInformation::where('unique_code', $unique_code)->first();
        $companyinfo = WebsiteIntegration::where('user_id', $code->user_id)->first();    
        $filter_date = new DateTime();
        $shift = 1;

        if ($request->date && (new DateTime($request->date)) > $filter_date) {
            $filter_date = new DateTime($request->date);    
            $shift = 0;
        }

        $days = [];
        $days[] = new DateTime(date('Y-m-d'));
        for ($i = 0; $i <= 4; $i++) {
            $d = clone($filter_date);
            $days[] = $d->modify('+' . ($i + $shift) . ' day');
        }

        // Extract the day name (e.g., "Monday") from the $filter_date
        $dayName = $filter_date->format('l');

        $services = $request->input('services', 'All Services');
        $greatfor = $request->input('great_for', 'All');
        $difficultylevel = $request->input('difficulty_level', 'All Levels');

        // Filter only active business services and check against category_id and BusinessPriceDetailsAges
        $bookschedulers = BusinessActivityScheduler::whereHas('business_service', function ($query) use ($services, $greatfor, $difficultylevel) {
            $query->where('business_services.is_active', 1); // Only active services
            
            if ($services !== 'All Services') {
                $query->where('service_type', $services);
            }
            if ($greatfor !== 'All') {
                $query->whereRaw("FIND_IN_SET(?, activity_for)", [$greatfor]);
            }
            if ($difficultylevel !== 'All Levels') {
                $query->whereRaw("FIND_IN_SET(?, difficult_level)", [$difficultylevel]);
            }
        })
        // Check the category_id and match it with BusinessPriceDetailsAges where stype=1
        ->whereHas('business_price_details_ages', function ($query) {
            $query->where('stype', 1);
            $query->whereNotNull('class_type');

        })
        ->where('activity_days', 'LIKE', "%$dayName%") // Compare with day name
        ->where('end_activity_date', '>', now()) 
        ->where('cid',$code->id) 
        ->orderBy('end_activity_date', 'desc')
        ->get();


        if ($request->ajax()) {
            return view('subdomain.scheduler', compact('bookschedulers', 'filter_date', 'days', 'companyinfo', 'code'))->render();
        }

        // dd($bookschedulers);
        return view('subdomain.schedule', compact('bookschedulers', 'filter_date', 'request', 'days', 'companyinfo', 'code'));
    }



    public function customerdashboard(Request $request)
    {
        // dd(auth::user());
        // $business = CompanyInformation::find($request->business_id);
        if (!Auth::check()) {
            return redirect()->back();
            // return redirect()->route('sub_customer_dashboard');
        }
        $businessId = $request->business_id ?? auth()->user()->cid;//updated
        $business = CompanyInformation::find($businessId);//updated
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
            // $customer = Customer::where(['business_id'=>$request->business_id,'user_id'=>Auth::user()->id])->first();
            $customer = Customer::where(['business_id'=>$request->business_id ?? auth()->user()->cid,'user_id'=>Auth::user()->id])->first();//updated
            $name = @$customer->full_name;
        }
        $attendanceCnt = BookingCheckinDetails::where('customer_id' ,@$customer->id)->whereMonth('checkin_date', '>=', date('m'))->whereMonth('checkin_date', '<=', date('m'))->whereNotNull('checked_at')->count();
        $attendanceCntPre = BookingCheckinDetails::where('customer_id' ,@$customer->id)->whereMonth('checkin_date', '>=', date('m') - 1)->whereMonth('checkin_date', '<=', date('m') - 1 )->whereNotNull('checked_at')->count();
        $attendancePct =  $attendanceCntPre != 0 ? number_format(($attendanceCnt - $attendanceCntPre)*100/$attendanceCntPre,2,'.','') : 0;

        $bookingCnt=1;
        $bookingCntPre=2;
        $bookingCnt = @$business->UserBookingDetails()->where('user_id' ,@$customer->id)->whereMonth('created_at', '>=', date('m'))->whereMonth('created_at', '<=', date('m'))->count();
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

        $classes = BookingCheckinDetails::where('customer_id' ,@$customer->id)->whereDate('checkin_date' , '>=' , date('Y-m-d'))->orderby('checkin_date','asc')->get()->filter(function ($bd){
            return $bd->booking_detail_id;
        });

        return view('subdomain.dashboard',compact('customer','name','notesCnt','activeMembershipCnt','docCnt','docCntNew','announcemetCnt','attendanceCnt','announcemetCntNew','bookingCnt','bookingPct','classes','attendancePct','business','notesCntNew','activeMembershipCntNew'));
    }


    public function logout(Request $request)
    {
        $loggedinUser = Auth::user()->cid;
        Auth::logout();
        Session::flush();
        $cookie = cookie()->forget('sub_session');
        $code = CompanyInformation::where('id', $loggedinUser)->first();
        return redirect()->route('/login', ['unique_code' => $code->unique_code]);
    }


    // public function postRegistrationCustomer(Request $request) {
    //     set_time_limit(-1);
    //     $postArr = $request->all();
    //      $rules = [
    //         'firstname' => 'required',
    //         'lastname' => 'required',
    //         'contact' => 'required',
    //     ];

    //     $validator = Validator::make($postArr, $rules);
    //     if ($validator->fails()) {
    //         $errMsg = array();
    //         foreach ($validator->messages()->getMessages() as $field_name => $messages) {
    //             $errMsg = $messages;
    //         }
    //         $response = array(
    //             'type' => 'danger',
    //             'msg' => $errMsg,
    //         );
    //         return Response::json($response);
    //     } else {
    //         //check for unique email id
    //         if (!$this->customers->findUniquefeildPerBusiness($company->id, 'email',$postArr['email'])) {
    //             $response = array(
    //                 'type' => 'danger',
    //                 'msg' => 'Email already exists. Please select different Email',
    //             );
    //             return Response::json($response);
    //         }; 

    //         if (!$this->customers->findUniquefeildPerBusiness($company->id, 'phone_number',$postArr['contact'])) {
    //             $response = array(
    //                 'type' => 'danger',
    //                 'msg' => 'Phone Number already exists. Please Enter different Phone Number',
    //             );
    //             return Response::json($response);
    //         };
            
    //         if (count($postArr) > 0) {
    //             \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
    //             $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));

    //             $last_name = ($postArr['firstname']) ? $postArr['lastname'] : '';
    //             $cus_name = $postArr['firstname'].' '.$last_name;
    //             $customer = \Stripe\Customer::create( 
    //                 [ 'name' => $cus_name,
    //                     'email'=> $postArr['email'] 
    //                 ]);
    //             $stripe_customer_id = $customer->id;  

    //             if($request->password){
    //                 $random_password = $request->password;
    //             }else{
    //                 $random_password = Str::random(8);    
    //             }
               
    //             $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->signpath));
    //             $filename = 'signatures/signature_' . time() . '.png';
    //             Storage::disk('s3')->put($filename, $image);

    //             $customerObj = New Customer();
    //             $customerObj->business_id = $company->id;
    //             $customerObj->fname = $postArr['firstname'];
    //             $customerObj->lname = $postArr['lastname'] ?? '';
    //             $customerObj->password = Hash::make($random_password);
    //             $customerObj->email = $postArr['email'];
    //             $customerObj->primary_account = $request->primaryAccountHolder ?? 0;
    //             $customerObj->status = 0;
    //             $customerObj->phone_number = $postArr['contact'];
    //             // $customerObj->birthdate = $postArr['dob'];
    //             // $customerObj->birthdate = Carbon::createFromFormat('m/d/Y', $postArr['dob'])->format('Y-m-d');
    //             // dd($postArr['dob']);
    //             // $userObj->birthdate = isset($postArr['dob']) ? date('Y-m-d', strtotime($postArr['dob'])) : NULL;
    //             $customerObj->birthdate = $postArr['dob'];
    //             $customerObj->stripe_customer_id = $stripe_customer_id;
    //             $customerObj->request_status = 1;
    //             $customerObj->gender=@$request->gender;
    //             $customerObj->get_fitnessity_info_from = @$request->know_from;

    //             $customerObj->address = @$request->address;
    //             $customerObj->country = @$request->country;
    //             $customerObj->city = @$request->city;
    //             $customerObj->state = @$request->state;
    //             $customerObj->zipcode = @$request->zipcode;

    //             $customerObj->terms_covid = date('Y-m-d');
    //             $customerObj->terms_liability = date('Y-m-d');
    //             $customerObj->terms_contract = date('Y-m-d');
    //             $customerObj->terms_condition = date('Y-m-d');
    //             $customerObj->terms_refund = date('Y-m-d');

    //             $customerObj->terms_sign_path = $filename;
    //             $customerObj->contract_sign_path = $filename;
    //             $customerObj->liability_sign_path = $filename;
    //             $customerObj->refund_sign_path = $filename;
    //             $customerObj->covid_sign_path = $filename;

    //             $fitnessity_user = User::where(['firstname'=> $postArr['firstname'],'lastname'=>$postArr['lastname'] ,'email' => $postArr['email']])->first();

    //             $checkInCode = $postArr['check_in'];
    //             $chkGenerate = 0;
    //             $chkUser = User::where('unique_code' , $checkInCode)->where('email' , '!=' , $postArr['email'])->first();
    //             $chkBusinessStaff = BusinessStaff::where('unique_code', $checkInCode)->first();//my code
    //             // if($chkUser){
    //             //     $checkInCode = getCode();
    //             //     $chkGenerate = 1;
    //             // }
    //             // my code starts
    //             if($chkUser){
    //                 $checkInCode = generateUniqueCode();
    //                 $chkGenerate = 1;
    //             }
    //             // ends
    //             if($fitnessity_user){
    //                 $ids = $fitnessity_user->orders()->get()->map(function($item){
    //                     return $item->id;
    //                 });

    //                 $result = UserBookingDetail::whereIn('sport', function($query) use ($company){
    //                     $query->select('id')->from('business_services')->where('cid', $company->id);
    //                 })->whereIn('booking_id', $ids)->exists();

    //                 if($result){
    //                     $customerObj->user_id = $fitnessity_user->id;
    //                 }
    //                 $customerObj->save();
    //                 $fitnessity_user->update(['unique_code' =>$checkInCode ]);

    //             }else{
    //                 $userObj = New User();
    //                 $userObj->role = 'customer';
    //                 $userObj->firstname = $postArr['firstname'];
    //                 $userObj->lastname = $postArr['lastname'] ?? '';
    //                 $userObj->username = $postArr['firstname'].$postArr['lastname'];
    //                 $userObj->password = $customerObj->password;
    //                 $userObj->buddy_key = $random_password;
    //                 $userObj->email = $postArr['email'];
    //                 $userObj->primary_account = $request->primaryAccountHolder ?? 0;
    //                 $userObj->country = 'United Status';
    //                 $userObj->phone_number = $postArr['contact'];
    //                 // $userObj->birthdate = $postArr['dob'];
    //                 // $userObj->birthdate = Carbon::createFromFormat('m/d/Y', $postArr['dob'])->format('Y-m-d');
    //                 $userObj->birthdate = isset($postArr['dob']) ? date('Y-m-d', strtotime($postArr['dob'])) : NULL;
    //                 $userObj->stripe_customer_id = $stripe_customer_id;
    //                 $userObj->unique_code = $checkInCode;
    //                 $userObj->save(); 
    //                 $customerObj->user_id = $userObj->id;
    //             }
    
    //             $customerObj->save();
    //             if ($customerObj) {    
    //                 // dd($customerObj);
    //                 $parentId = NULL;
    //                 $currentCustomer = $customerObj;
    //                 if ($request->fname !='') { //my line of code
    //                     for($i=0;$i<=$request->familycnt;$i++){
    //                         if($request->fname[$i] != ''){
    //                             $random_passwordFamily = Str::random(8);    
    //                             // $date = $request->birthdate[$i] ?? NULL;
    //                             // $date = $request->birthdate[$i] ? Carbon::createFromFormat('m/d/Y', $request->birthdate[$i])->format('Y-m-d') : NULL;
    //                             $date = $request->birthdate[$i] ? date('Y-m-d', strtotime($request->birthdate[$i])): NULL;
    //                             if($request->primaryAccount == 1 && $currentCustomer->primary_account != 1){
    //                                 if($i == 0){
    //                                     $parentId = NULL;
    //                                     $isParentAccount = 1;
    //                                 }
    //                             }else{
    //                                 $parentId = $currentCustomer->id;
    //                                 $isParentAccount = 0;
    //                             }

    //                             $customerFamily = New Customer();
    //                             $customerFamily->parent_cus_id = $parentId;
    //                             $customerFamily->primary_account = $isParentAccount;
    //                             $customerFamily->business_id = $company->id;
    //                             $customerFamily->fname = $request->fname[$i];
    //                             $customerFamily->lname = $request->lname[$i];
    //                             $customerFamily->relationship = $request->relationship[$i];
    //                             $customerFamily->email = $request->emailid[$i];
    //                             $customerFamily->country = 'United Status';
    //                             $customerFamily->status = 0;
    //                             $customerFamily->phone_number = $request->mphone[$i];
    //                             $customerFamily->birthdate = $date;
    //                             $customerFamily->emergency_contact = $request->emergency_phone[$i];
    //                             $customerFamily->emergency_name = $request->emergency_name[$i];
    //                             $customerFamily->emergency_email = $request->emergency_email[$i];
    //                             $customerFamily->emergency_relation = $request->emergency_relation[$i];
    //                             $customerFamily->gender =  $request->familygender[$i];
    //                             $customerFamily->password =   Hash::make($random_passwordFamily);
    //                             $customerFamily->request_status =  1;
    //                             $customerFamily->save();
    //                             $customerFamily->create_stripe_customer_id();
    //                             if($request->primaryAccount == 1 && $currentCustomer->primary_account != 1){
    //                                 if($i == 0){
    //                                 $parentId = $customerFamily->id;
    //                                 $currentCustomer->update(['parent_cus_id' =>$parentId]);
    //                                 }
    //                             }

    //                             if ($customerFamily) {      
    //                                 SGMailService::sendWelcomeMailToCustomer($customerFamily->id,$company->id,'');
    //                                 SGMailService::sendMailToCustomer($customerFamily->id,$company->id,''); 

    //                             }

    //                             $is_user = User::where(['firstname'=> $request->fname[$i],'lastname'=> $request->lname[$i],'email' => $request->emailid[$i]])->first();

    //                             $checkInCodeF = $request->check_in_code[$i];
    //                             $chkUserF = User::where('unique_code' , $checkInCodeF)->where('email' , '!=' , $request->emailid[$i])->first();
    //                             $chkBusinessStaff = BusinessStaff::where('unique_code', $checkInCode)->first();//my code

    //                             // if($chkUserF){
    //                             //     $checkInCodeF = getCode();
    //                             //     $chkGenerate = 1;
    //                             // }
    //                             // my code starts
    //                             if($chkUserF  || $chkBusinessStaff){
    //                                 $checkInCodeF = generateUniqueCode();
    //                                 $chkGenerate = 1;
    //                             }
    //                             // ends
    //                             if($is_user){
    //                                 $customerFamily->stripe_customer_id = @$is_user->stripe_customer_id;
    //                                 $customerFamily->user_id = @$is_user->id;
    //                                 if(@$is_user->password){
    //                                     $customerFamily->password = @$is_user->password;
    //                                 }

    //                                 $is_user->update(['unique_code' => $checkInCodeF ]);
    //                             }else{
                    
    //                                 $familyUser = New User();
    //                                 $familyUser->role = 'customer';
    //                                 $familyUser->firstname =  $request->fname[$i];
    //                                 $familyUser->lastname =  $request->lname[$i];
    //                                 $familyUser->username = $request->fname[$i].$request->lname[$i];
    //                                 $familyUser->password = Hash::make($random_passwordFamily);
    //                                 $familyUser->buddy_key = $random_passwordFamily;
    //                                 $familyUser->email = $request->emailid[$i];
    //                                 $familyUser->primary_account = $isParentAccount;
    //                                 $familyUser->country = 'United Status';
    //                                 $familyUser->phone_number = $request->mphone[$i];
    //                                 $familyUser->birthdate =  $date;
    //                                 $familyUser->gender = $request->familygender[$i];
    //                                 $familyUser->stripe_customer_id = $customerFamily->stripe_customer_id;
    //                                 $familyUser->unique_code = $checkInCodeF;
    //                                 $familyUser->save(); 
    //                                 $customerFamily->user_id = $familyUser->id;
    //                             }

    //                             $customerFamily->save();

    //                             UserFamilyDetail::create([
    //                                 'user_id' => $currentCustomer->user_id,
    //                                 'first_name' => $request->fname[$i],
    //                                 'last_name' => $request->lname[$i],
    //                                 'email' => $request->emailid[$i],
    //                                 'mobile' => $request->mphone[$i],
    //                                 'emergency_contact' =>$request->emergency_phone[$i],
    //                                 'relationship' =>  $request->relationship[$i],
    //                                 'gender' => $request->familygender[$i],
    //                                 'birthday' =>  $date,
    //                                 'emergency_contact_name' => $request->emergency_name[$i],
    //                             ]);
    //                         }
    //                     }
    //                 } //ends

    //                 session()->put('success-register', '1');
    //                 if($chkGenerate == 1){
    //                     $url  = env('APP_URL').'/business/'.$customerObj->business_id.'/customers/'.$customerObj->id;
    //                     $msg = 'Your code is taken by another user. Please try another code from your <a href="'.$url.'"> profile.</a>';
    //                     session()->put('auto_generate_msg', $msg);
    //                 }

    //                 $status = SGMailService::sendWelcomeMailToCustomer($customerObj->id,Auth::user()->cid,$random_password); 
    //                 $checkstatus=SGMailService::sendMailToCustomer($customerObj->id,Auth::user()->cid,$random_password);

    //                 // Auth::login($user);
    //                 if ($userObj) {
    //                     Auth::login($userObj); // Logs in the created user
    //                 }
                    
    //                 $response = array(
    //                     'id'=>$customerObj->id,
    //                     'type' => 'success',
    //                     'msg' => 'Registration done successfully.',
    //                     'redirect'=>'/sub_customer_dashboard',
    //                 );
    //                 return Response::json($response);
    //             } else {
    //                 $response = array(
    //                     'type' => 'danger',
    //                     'msg' => 'Some error occured while registering. Please try again later.',
    //                 );
    //                 return Response::json($response);
    //             }


    //         } else {
    //             $response = array(
    //                 'type' => 'danger',
    //                 'msg' => 'Invalid email or password',
    //             );
    //             return Response::json($response);
    //         }
    //     }
    // }
    public function postRegistrationCustomer(Request $request) {
        set_time_limit(-1);
        $postArr = $request->all();
        
        $code=$request->company_info;
        // dd($postArr);
        $companyinfo=WebsiteIntegration::where('id',$code)->first();
        $company = CompanyInformation::where('id', $companyinfo->business_id)->first();         
        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'contact' => 'required',
        ];

        $validator = Validator::make($postArr, $rules);
        if ($validator->fails()) {
            $errMsg = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $errMsg = $messages;
            }
            $response = array(
                'type' => 'danger',
                'msg' => $errMsg,
            );
            return Response::json($response);
        } else {
            //check for unique email id
            if (!$this->customers->findUniquefeildPerBusiness($company->id, 'email',$postArr['email'])) {
                $response = array(
                    'type' => 'danger',
                    'msg' => 'Email already exists. Please select different Email',
                );
                return Response::json($response);
            }; 

            if (!$this->customers->findUniquefeildPerBusiness($company->id, 'phone_number',$postArr['contact'])) {
                $response = array(
                    'type' => 'danger',
                    'msg' => 'Phone Number already exists. Please Enter different Phone Number',
                );
                return Response::json($response);
            };
            
            if (count($postArr) > 0) {
                \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
                $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));

                $last_name = ($postArr['firstname']) ? $postArr['lastname'] : '';
                $cus_name = $postArr['firstname'].' '.$last_name;
                $customer = \Stripe\Customer::create( 
                    [ 'name' => $cus_name,
                        'email'=> $postArr['email'] 
                    ]);
                $stripe_customer_id = $customer->id;  

                if($request->password){
                    $random_password = $request->password;
                }else{
                    $random_password = Str::random(8);    
                }
               
                $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->signpath));
                $filename = 'signatures/signature_' . time() . '.png';
                Storage::disk('s3')->put($filename, $image);

                $customerObj = New Customer();
                $customerObj->business_id = $company->id;
                $customerObj->fname = $postArr['firstname'];
                $customerObj->lname = $postArr['lastname'] ?? '';
                $customerObj->password = Hash::make($random_password);
                $customerObj->email = $postArr['email'];
                $customerObj->primary_account = $request->primaryAccountHolder ?? 0;
                $customerObj->status = 0;
                $customerObj->phone_number = $postArr['contact'];
                // $customerObj->birthdate = $postArr['dob'];
                // $customerObj->birthdate = Carbon::createFromFormat('m/d/Y', $postArr['dob'])->format('Y-m-d');
                // dd($postArr['dob']);
                // $userObj->birthdate = isset($postArr['dob']) ? date('Y-m-d', strtotime($postArr['dob'])) : NULL;
                $customerObj->birthdate = $postArr['dob'];
                $customerObj->stripe_customer_id = $stripe_customer_id;
                $customerObj->request_status = 1;
                $customerObj->gender=@$request->gender;
                $customerObj->get_fitnessity_info_from = @$request->know_from;

                $customerObj->address = @$request->address;
                $customerObj->country = @$request->country;
                $customerObj->city = @$request->city;
                $customerObj->state = @$request->state;
                $customerObj->zipcode = @$request->zipcode;

                $customerObj->terms_covid = date('Y-m-d');
                $customerObj->terms_liability = date('Y-m-d');
                $customerObj->terms_contract = date('Y-m-d');
                $customerObj->terms_condition = date('Y-m-d');
                $customerObj->terms_refund = date('Y-m-d');

                $customerObj->terms_sign_path = $filename;
                $customerObj->contract_sign_path = $filename;
                $customerObj->liability_sign_path = $filename;
                $customerObj->refund_sign_path = $filename;
                $customerObj->covid_sign_path = $filename;

                $fitnessity_user = User::where(['firstname'=> $postArr['firstname'],'lastname'=>$postArr['lastname'] ,'email' => $postArr['email']])->first();

                $checkInCode = $postArr['check_in'];
                $chkGenerate = 0;
                $chkUser = User::where('unique_code' , $checkInCode)->where('email' , '!=' , $postArr['email'])->first();
                $chkBusinessStaff = BusinessStaff::where('unique_code', $checkInCode)->first();//my code
                // if($chkUser){
                //     $checkInCode = getCode();
                //     $chkGenerate = 1;
                // }
                // my code starts
                if($chkUser){
                    $checkInCode = generateUniqueCode();
                    $chkGenerate = 1;
                }
                // ends
                if($fitnessity_user){
                    $ids = $fitnessity_user->orders()->get()->map(function($item){
                        return $item->id;
                    });

                    $result = UserBookingDetail::whereIn('sport', function($query) use ($company){
                        $query->select('id')->from('business_services')->where('cid', $company->id);
                    })->whereIn('booking_id', $ids)->exists();

                    if($result){
                        $customerObj->user_id = $fitnessity_user->id;
                    }
                    $customerObj->save();
                    $fitnessity_user->update(['unique_code' =>$checkInCode ]);

                }else{
                    $userObj = New User();
                    $userObj->role = 'customer';
                    $userObj->firstname = $postArr['firstname'];
                    $userObj->lastname = $postArr['lastname'] ?? '';
                    $userObj->username = $postArr['firstname'].$postArr['lastname'];
                    $userObj->password = $customerObj->password;
                    $userObj->buddy_key = $random_password;
                    $userObj->email = $postArr['email'];
                    $userObj->primary_account = $request->primaryAccountHolder ?? 0;
                    $userObj->country = 'United Status';
                    $userObj->phone_number = $postArr['contact'];
                    // $userObj->birthdate = $postArr['dob'];
                    // $userObj->birthdate = Carbon::createFromFormat('m/d/Y', $postArr['dob'])->format('Y-m-d');
                    $userObj->birthdate = isset($postArr['dob']) ? date('Y-m-d', strtotime($postArr['dob'])) : NULL;
                    $userObj->stripe_customer_id = $stripe_customer_id;
                    $userObj->unique_code = $checkInCode;
                    $userObj->cid=$company->id;
                    $userObj->save(); 
                    $customerObj->user_id = $userObj->id;
                }
    
                $customerObj->save();
                if ($customerObj) {    
                    // dd($customerObj);
                    $parentId = NULL;
                    $currentCustomer = $customerObj;
                    if ($request->fname !='') { //my line of code
                        for($i=0;$i<=$request->familycnt;$i++){
                            if($request->fname[$i] != ''){
                                $random_passwordFamily = Str::random(8);    
                                // $date = $request->birthdate[$i] ?? NULL;
                                // $date = $request->birthdate[$i] ? Carbon::createFromFormat('m/d/Y', $request->birthdate[$i])->format('Y-m-d') : NULL;
                                $date = $request->birthdate[$i] ? date('Y-m-d', strtotime($request->birthdate[$i])): NULL;
                                if($request->primaryAccount == 1 && $currentCustomer->primary_account != 1){
                                    if($i == 0){
                                        $parentId = NULL;
                                        $isParentAccount = 1;
                                    }
                                }else{
                                    $parentId = $currentCustomer->id;
                                    $isParentAccount = 0;
                                }

                                $customerFamily = New Customer();
                                $customerFamily->parent_cus_id = $parentId;
                                $customerFamily->primary_account = $isParentAccount;
                                $customerFamily->business_id = $company->id;
                                $customerFamily->fname = $request->fname[$i];
                                $customerFamily->lname = $request->lname[$i];
                                $customerFamily->relationship = $request->relationship[$i];
                                $customerFamily->email = $request->emailid[$i];
                                $customerFamily->country = 'United Status';
                                $customerFamily->status = 0;
                                $customerFamily->phone_number = $request->mphone[$i];
                                $customerFamily->birthdate = $date;
                                $customerFamily->emergency_contact = $request->emergency_phone[$i];
                                $customerFamily->emergency_name = $request->emergency_name[$i];
                                $customerFamily->emergency_email = $request->emergency_email[$i];
                                $customerFamily->emergency_relation = $request->emergency_relation[$i];
                                $customerFamily->gender =  $request->familygender[$i];
                                $customerFamily->password =   Hash::make($random_passwordFamily);
                                $customerFamily->request_status =  1;
                                $customerFamily->save();
                                $customerFamily->create_stripe_customer_id();
                                if($request->primaryAccount == 1 && $currentCustomer->primary_account != 1){
                                    if($i == 0){
                                    $parentId = $customerFamily->id;
                                    $currentCustomer->update(['parent_cus_id' =>$parentId]);
                                    }
                                }

                                if ($customerFamily) {      
                                    SGMailService::sendWelcomeMailToCustomer($customerFamily->id,$company->id,'');
                                    SGMailService::sendMailToCustomer($customerFamily->id,$company->id,''); 

                                }

                                $is_user = User::where(['firstname'=> $request->fname[$i],'lastname'=> $request->lname[$i],'email' => $request->emailid[$i]])->first();

                                $checkInCodeF = $request->check_in_code[$i];
                                $chkUserF = User::where('unique_code' , $checkInCodeF)->where('email' , '!=' , $request->emailid[$i])->first();
                                $chkBusinessStaff = BusinessStaff::where('unique_code', $checkInCode)->first();//my code

                                // if($chkUserF){
                                //     $checkInCodeF = getCode();
                                //     $chkGenerate = 1;
                                // }
                                // my code starts
                                if($chkUserF  || $chkBusinessStaff){
                                    $checkInCodeF = generateUniqueCode();
                                    $chkGenerate = 1;
                                }
                                // ends
                                if($is_user){
                                    $customerFamily->stripe_customer_id = @$is_user->stripe_customer_id;
                                    $customerFamily->user_id = @$is_user->id;
                                    if(@$is_user->password){
                                        $customerFamily->password = @$is_user->password;
                                    }

                                    $is_user->update(['unique_code' => $checkInCodeF ]);
                                }else{
                    
                                    $familyUser = New User();
                                    $familyUser->role = 'customer';
                                    $familyUser->firstname =  $request->fname[$i];
                                    $familyUser->lastname =  $request->lname[$i];
                                    $familyUser->username = $request->fname[$i].$request->lname[$i];
                                    $familyUser->password = Hash::make($random_passwordFamily);
                                    $familyUser->buddy_key = $random_passwordFamily;
                                    $familyUser->email = $request->emailid[$i];
                                    $familyUser->primary_account = $isParentAccount;
                                    $familyUser->country = 'United Status';
                                    $familyUser->phone_number = $request->mphone[$i];
                                    $familyUser->birthdate =  $date;
                                    $familyUser->gender = $request->familygender[$i];
                                    $familyUser->stripe_customer_id = $customerFamily->stripe_customer_id;
                                    $familyUser->unique_code = $checkInCodeF;
                                    $familyUser->cid=$company->id;
                                    $familyUser->save(); 
                                    $customerFamily->user_id = $familyUser->id;
                                }

                                $customerFamily->save();

                                UserFamilyDetail::create([
                                    'user_id' => $currentCustomer->user_id,
                                    'first_name' => $request->fname[$i],
                                    'last_name' => $request->lname[$i],
                                    'email' => $request->emailid[$i],
                                    'mobile' => $request->mphone[$i],
                                    'emergency_contact' =>$request->emergency_phone[$i],
                                    'relationship' =>  $request->relationship[$i],
                                    'gender' => $request->familygender[$i],
                                    'birthday' =>  $date,
                                    'emergency_contact_name' => $request->emergency_name[$i],
                                ]);
                            }
                        }
                    } //ends

                    session()->put('success-register', '1');
                    if($chkGenerate == 1){
                        $url  = env('APP_URL').'/business/'.$customerObj->business_id.'/customers/'.$customerObj->id;
                        $msg = 'Your code is taken by another user. Please try another code from your <a href="'.$url.'"> profile.</a>';
                        session()->put('auto_generate_msg', $msg);
                    }

                    // $status = SGMailService::sendWelcomeMailToCustomer($customerObj->id,Auth::user()->cid,$random_password); 
                    // $checkstatus=SGMailService::sendMailToCustomer($customerObj->id,Auth::user()->cid,$random_password);
                    // dd($userObj);
                    // Auth::login($user);
                    // if ($userObj) {
                    //     Auth::login($userObj); // Logs in the created user
                    // }
                    // dd($customerObj->user_id);
                    $user = User::find($customerObj->user_id);
                    if ($user) {
                        // Auth::login($user);
                        Auth::login($user, true); 

                    }
                    if (Auth::check()) {
                        $response = array(
                            'id'=>$customerObj->id,
                            'type' => 'success',
                            'msg' => 'Registration done successfully.',
                            'redirect'=>'/sub_customer_dashboard'
                        );
                    }
                  

                    // $status = SGMailService::sendWelcomeMailToCustomer($customerObj->id,Auth::user()->cid,$random_password); 
                    // $checkstatus=SGMailService::sendMailToCustomer($customerObj->id,Auth::user()->cid,$random_password);
                    $status = SGMailService::sendWelcomeMailToCustomer($customerObj->id,$company->id,$random_password); 

                    
                    $response = array(
                        'id'=>$customerObj->id,
                        'type' => 'success',
                        'msg' => 'Registration done successfully.',
                    );
                    return Response::json($response);
                } else {
                    $response = array(
                        'type' => 'danger',
                        'msg' => 'Some error occured while registering. Please try again later.',
                    );
                    return Response::json($response);
                }


            } else {
                $response = array(
                    'type' => 'danger',
                    'msg' => 'Invalid email or password',
                );
                return Response::json($response);
            }
        }
    }
}
