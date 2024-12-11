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
use Str;

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

         $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
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
        $businessTerms = BusinessTerms::where('cid',$code->id)->first();
        return view('subdomain.register', compact('code','companyinfo','businessTerms'))->render();    
    }

    public function UserLogin(Request $request)
    {
        // Validate incoming request
        // $host = request()->getHost();
        // dd($host);/
        // dd($request->all());
        // dd('4');

        // dd($request->input('code'));
        // if($request->input('schedule')==1)
        // {
        //     $codeId = $request->input('code');
        //     // new 
        //     $postArr = $request->only('email', 'password');
        //     $rules = [
        //         'email' => 'required|email',
        //         'password' => 'required',
        //     ];            
        //     $validator = Validator::make($postArr, $rules);
        //     if ($validator->fails()) {
        //         return response()->json([
        //             'type' => 'danger',
        //             'msg' => $validator->errors()->all(),
        //         ], 400);
        //     }
    
        //     // Fetch the necessary business and customer details
        //     $webdata = WebsiteIntegration::where('id', $request->company_info)->first();
        //     $customer = Customer::where('business_id', $codeId)->where('email', $request->email)->first();
            
        //     if (!$customer) {
        //         return response()->json([
        //             'type' => 'register',
        //             'msg' => 'You are not registered with this business. Please register now.',
        //         ], 400);
        //     }
    
        //     // Verify booking and service details
        //     $status = 0;
        //     $BusinessActivityScheduler = BusinessActivityScheduler::where('id', $request->bookingid)->first();
        //     if ($BusinessActivityScheduler) {
        //         $business_services = BusinessServices::where('id', $BusinessActivityScheduler->serviceid)->first();
        //         if ($business_services) {
        //             $status = 1;
        //         }
        //     }
    
        //     // Check if login attempt is valid
        //     if (!Auth::attempt(['email' => $postArr['email'], 'password' => $postArr['password'], 'activated' => 1, 'primary_account' => 1])) {
        //         return response()->json([
        //             'type' => 'not_exists',
        //             'msg' => 'User details not verified in our database.',
        //         ], 401);
        //     }
    
        //     $user = Auth::user();
        //     $currentDate = Carbon::now()->subYears(18)->format('Y-m-d');
        //     $userBirthdate = Carbon::parse($user->birthdate);
    
        //     if ($userBirthdate > $currentDate) {
        //         Auth::logout();
        //         return response()->json([
        //             'type' => 'not_exists',
        //             'msg' => 'Only users above 18 years old are allowed to log in.',
        //         ], 401);
        //     }
    
        //     // Generate JWT token
        //     try {
        //         $token = JWTAuth::fromUser($user);
        //     } catch (JWTException $e) {
        //         return response()->json([
        //             'type' => 'danger',
        //             'msg' => 'Could not create token.',
        //         ], 500);
        //     }
    
        //     // Update user last login details
        //     $user->update([
        //         'last_login' => now(),
        //         'last_ip' => $request->ip(),
        //     ]);
    
        //     // Check for session redirects and return appropriate responses
        //     $claim = session('claim_business_page', 'not set');
        //     $claim_cid = session('claim_cid', '');
        //     $schedule = session('schedule', '');
        //     $onboard = session('redirectToOnboard', '');
    
        //     if ($onboard) {
        //         return redirect($onboard);
        //     }
    
        //     if ($request->redirect) {
        //         return redirect($request->redirect);
        //     }
    
        //     if ($claim == 'set') {
        //         $company = CompanyInformation::find($claim_cid);
        //         return redirect('/claim/reminder/' . $company->company_name . '/' . $claim_cid);
        //     }
    
        //     if ($schedule) {
        //         return redirect('/business_activity_schedulers/' . $schedule);
        //     }
    
        //     // Return the JWT token along with the login status
        //     return response()->json([
        //         // 'customer_enc'=>Crypt::encrypt($customer->id),
        //         // 'token_enc'=>Crypt::encrypt($token),
        //         'customer'=>$customer->id,
        //         'type' => 'success',
        //         'msg' => 'Login successful.',
        //         'membership' => $status,
        //     ], 200);


        //     // end



            
        // }

        if ($request->input('schedule') == 1) {
            $codeId = $request->input('code');
        
            // Validation
            $postArr = $request->only('email', 'password');
            $rules = [
                'email' => 'required|email',
                'password' => 'required',
            ];
            $validator = Validator::make($postArr, $rules);
        
            if ($validator->fails()) {
                return response()->json([
                    'type' => 'danger',
                    'msg' => $validator->errors()->all(),
                ], 400);
            }
        
            // Fetch necessary business and customer details
            $webdata = WebsiteIntegration::where('id', $request->company_info)->first();
            $customer = Customer::where('business_id', $codeId)->where('email', $request->email)->first();
        
            if (!$customer) {
                return response()->json([
                    'type' => 'register',
                    'msg' => 'You are not registered with this business. Please register now.',
                ], 400);
            }
        
            // Verify booking and service details
            $status = 0;
            $BusinessActivityScheduler = BusinessActivityScheduler::where('id', $request->bookingid)->first();
            if ($BusinessActivityScheduler) {
                $business_services = BusinessServices::where('id', $BusinessActivityScheduler->serviceid)->first();
                if ($business_services) {
                    $status = 1;
                }
            }
        
            // Check login attempt
            if (!Auth::attempt(['email' => $postArr['email'], 'password' => $postArr['password'], 'activated' => 1, 'primary_account' => 1])) {
                return response()->json([
                    'type' => 'not_exists',
                    'msg' => 'User details not verified in our database.',
                ], 200);
            }
        
            $user = Auth::user();
            $currentDate = Carbon::now()->subYears(18)->format('Y-m-d');
            $userBirthdate = Carbon::parse($user->birthdate);
        
            if ($userBirthdate > $currentDate) {
                Auth::logout();
                return response()->json([
                    'type' => 'not_exists',
                    'msg' => 'Only users above 18 years old are allowed to log in.',
                ], 200);
            }
        
            // Update user last login details
            $user->update([
                'last_login' => now(),
                'last_ip' => $request->ip(),
            ]);
        
            // Check for session redirects and return appropriate responses
            $claim = session('claim_business_page', 'not set');
            $claim_cid = session('claim_cid', '');
            $schedule = session('schedule', '');
            $onboard = session('redirectToOnboard', '');
        
            if ($onboard) {
                return redirect($onboard);
            }
        
            if ($request->redirect) {
                return redirect($request->redirect);
            }
        
            if ($claim == 'set') {
                $company = CompanyInformation::find($claim_cid);
                return redirect('/claim/reminder/' . $company->company_name . '/' . $claim_cid);
            }
        
            if ($schedule) {
                return redirect('/business_activity_schedulers/' . $schedule);
            }
        
            // Return login success response
            return response()->json([
                'customer' => $customer->id,
                'type' => 'success',
                'msg' => 'Login successful.',
                'membership' => $status,
            ], 200);
        }
        
        else{
            $codeId = decrypt($request->input('code'));
        }
        $companyinfo = CompanyInformation::where('id', $codeId)->first();
        // dd($companyinfo);
        $uniqueCode=$companyinfo->unique_code;
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
                    
                    // dd($uniqueCode);
                    $redirectUrl = route('sub_customer_dashboard',['unique_code' => $uniqueCode]);


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
        // if (!Auth::check()) {
        //     return redirect()->route('/login', ['unique_code' => $unique_code]);
        // }
        // dd('44');
        // dd($request->all());
        $unique_code =  $request->unique_code??$unique_code;   
        // dd($unique_codes);     
        if ($request->ajax()) {
            $code = CompanyInformation::where('unique_code', $request->unique_code)->first();
            $companyinfo = WebsiteIntegration::where('user_id', $code->user_id)->first();    
        }
        else{
            $code = CompanyInformation::where('unique_code', $unique_code)->first();
            $companyinfo = WebsiteIntegration::where('user_id', $code->user_id)->first();    
        }
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
            return view('subdomain.scheduler', compact('bookschedulers', 'filter_date', 'days', 'companyinfo', 'code','unique_code'))->render();
        }

        // dd($bookschedulers);
        return view('subdomain.schedule', compact('bookschedulers', 'filter_date', 'request', 'days', 'companyinfo', 'code','unique_code'));
    }



    public function customerdashboard(Request $request,$unique_code)
    {

        // dd(auth::user());
        // dd($unique_code);
        // $business = CompanyInformation::find($request->business_id);
        if (!Auth::check()) {
            // return redirect()->back();
            // return redirect()->route('sub_customer_dashboard');
            return redirect()->route('/login', ['unique_code' => $unique_code]);
        }
        // $businessId = $request->business_id ?? auth()->user()->cid;//updated
        // $business = CompanyInformation::find($businessId);//updated
        // dd($unique_code);
        $business = CompanyInformation::where('unique_code', $unique_code)->first();
        $businessId=$business->id;
        $user=$this->user;
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
            // dd($businessId);
            $customer = Customer::where(['business_id'=>$businessId,'user_id'=>Auth::user()->id])->first();//updated
            $name = @$customer->full_name;
            // dd($customer->user);
            // dd($customer);
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
                })->where('business_id', $businessId)->count();

        $notesCntNew = CustomerNotes::where(['customer_id'=> @$customer->id ,'display_chk' => 1])->orderby('due_date','desc')->whereDate('due_date', '=', now())->whereTime('time', now()->format('H:i'))
                ->orWhere(function ($query) use($customer) {
                    $query->whereDate('due_date', now())->where('customer_id', @$customer->id )->where('display_chk' ,1);
                })->where('business_id', $businessId)->count();

        $expiredCards = StripePaymentMethod::where(['user_id'=> @$customer->id, 'user_type' => 'Customer'])->where('exp_year','<=', date('Y'))->where('exp_month','<', date('m'))->count();
        $missedPayments = Recurring::where(['user_id'=> @$customer->id, 'user_type' => 'Customer'])->where('status' ,'!=','Completed')->whereDate('payment_date' ,'<' ,date('Y-m-d'))->count();

        $notesCnt += $expiredCards;
        $notesCnt += $missedPayments;

        $activeMembershipCnt = count($this->booking_repo->currentTab($request->serviceType,$businessId,@$customer));
        $activeMembershipCntNew = $business->UserBookingDetails()->where('user_id' ,@$customer->id)->whereDate('created_at', date('Y-m-d'))->count();
        $docCnt =  $documents = CustomersDocuments::where('customer_id',  @$customer->id)->where('business_id', $businessId)->count();

        $docCntNew =  $documents = CustomersDocuments::where('customer_id',  @$customer->id)->where('business_id', $businessId)->whereDate('created_at',date('Y-m-d'))->count();

        $announcemetCnt = Announcement::where(['business_id' => $businessId, 'status' => 'active'])
                ->where(function ($query) {
                    $query->whereDate('announcement_date', '<=', date('Y-m-d'))->whereTime('announcement_time', '<=', date('H:i'));
                    })->orWhere(function ($query) {
                        $query->whereDate('announcement_date', '<=', date('Y-m-d'))->whereNull('announcement_time');
                })->count();

        $announcemetCntNew = Announcement::where(['business_id' => $businessId, 'status' => 'active'])->whereDate('announcement_date', date('Y-m-d'))->count();
        // \DB::enableQueryLog(); // Enable query log
        $classes = BookingCheckinDetails::where('customer_id' ,@$customer->id)->whereDate('checkin_date' , '>=' , date('Y-m-d'))->orderby('checkin_date','asc')->get()->filter(function ($bd){
            return $bd->booking_detail_id;
        });
        // dd(\DB::getQueryLog()); // Show results of log
        return view('subdomain.dashboard',compact('customer','name','user','unique_code','notesCnt','activeMembershipCnt','docCnt','docCntNew','announcemetCnt','attendanceCnt','announcemetCntNew','bookingCnt','bookingPct','classes','attendancePct','business','notesCntNew','activeMembershipCntNew','business'));
    }
    public function membership(Request $request)
    {
        // dd($request->all());
        $companyinfo = $request->input('companyinfo');
        $users = $request->input('user');
        $companyId = $companyinfo['id'];
        $user_Id=$companyinfo['user_id'];
        $customer =Customer::where('business_id',$companyId)->where('user_id',$user_Id)->first();
        $business = CompanyInformation::where('id',$companyId)->first();
        $customerId=$customer->id;
        // dd($customer);
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
        return view('subdomain.membership', compact('companyId', 'services', 'customerId','users'))->render();
        // return view('business.website_integration', compact('companyId','services','customerId'));

    }

    public function viewbooking(Request $request)
    {
        // dd('11');
        // dd($request->all());
        // $userid =$request->user_id;
        // dd($user_id);/
        // $user=User::find($userid);
        // $data = $request->query();
        // // dd($data);
        // if($data)
        // {

        //     // dd($data);
        //     dd($request->all());
        // }
        $user = Auth::user();
        $userid =$user->id;
        $business = $user->company()->where('id',request()->business_id)->first();
        // dd(request()->all());
        if(!request()->business_id){
            return redirect()->back();
        }
        if($request->customer_id){
            if(request()->type == 'user'){
                $familyMember = Auth::user()->user_family_details()->where('id',request()->customer_id)->first();
                $user = User::where(['firstname'=> @$familyMember->first_name, 'lastname'=>@$familyMember->last_name, 'email'=>@$familyMember->email])->first();
                $customer = Customer::where(['user_id' => @$user->id])->first();
                $name = @$familyMember->full_name;
            }else{
                $customer = Customer::find(request()->customer_id);
                $name = @$customer->full_name;
            }   
        }else{
            $customer = Customer::where(['business_id'=>$request->business_id,'user_id'=>$userid])->first();
            $name = @$customer->full_name;
        }

        $bookingDetails = $currentBooking =  [];
        $bookingDetails =  $this->booking_repo->otherTab($request->serviceType, $request->business_id,@$customer);
        $currentBookingData = $this->booking_repo->currentTab($request->serviceType,$request->business_id,@$customer);
       
        foreach($currentBookingData as $i=>$book_details){
            $currentBooking[@$book_details->business_services_with_trashed->id .'!~!'.@$book_details->business_services_with_trashed->program_name] [] = $book_details;
        }
        // new code start

        // ends
        // dd($book_details);
        // dd('4');
        $tabval = $request->tab; 
        // return view('personal.orders.index', compact('bookingDetails','currentBooking','tabval','customer','name','business'));
        $html = view('subdomain.orders_index', compact('bookingDetails', 'currentBooking', 'tabval', 'customer', 'name', 'business','user'))->render();
        return response()->json(['html' => $html]);

    }


    public function act_detail_filter_for_cart(Request $request){
        // dd($request->all());
    	$schedule = $priceId  = $priceOption = '';
    	$activityDate = $request->actdate;
        $serviceId = $request->serviceid;
        $companyId = $request->companyid;
        $categoryId = $request->categoryId;
        $priceId = $request->priceId;
        $scheduleId = $request->scheduleId;
        $businessService = BusinessService::where('cid' ,$companyId)->first();
        $chkFound = strpos(@$businessService->special_days_off , date('m/d/Y',strtotime($activityDate))) !== false ?  "Found" : "Not" ;
        $service = BusinessServices::where('id' ,$serviceId)->first();
        // dd($service);
        if($activityDate != ''){
        	$schedule = BusinessActivityScheduler::where('serviceid',$serviceId)->where('cid',$companyId)->where('starting','<=',date('Y-m-d',strtotime($activityDate)) )->where('end_activity_date','>=',  date('Y-m-d',strtotime($activityDate)) )->whereRaw('FIND_IN_SET("'.date('l',strtotime($activityDate)).'",activity_days)');
	    }
        // dd($schedule);
	    $schedulers = $schedule != '' ? $schedule->get() : [];
	    $firstSchedule = $schedule != '' ? $schedule->first() : '';
		// dd($service);
		if (!$service) {
			return response()->json(['message' => 'Service not found'], 200);
		}		
        // \DB::enableQueryLog(); // Enable query log
	   	$rawcategory = $service->BusinessPriceDetailsAges()->whereNotNull('class_type')->has('BusinessActivityScheduler')->orderBy('id', 'ASC');
        $categories = $firstSchedule != '' ? $rawcategory->where('visibility_to_public' , 1)->get() : [];
        $firstCategory = $firstSchedule != '' ?  $rawcategory->when($categoryId, function ($query) use ($categoryId) {
		    $query->where('id', $categoryId);
		})->where('visibility_to_public' , 1)->first() : '';

        // dd($categoryId);
        //    dd(\DB::getQueryLog()); // Show results of log
   		$categoryId = $categoryId ?? @$firstCategory->id;
   		if(@$firstCategory->class_type){
   			$prices = $firstCategory  != '' ? $firstCategory->bPriceDetails()->orderBy('id', 'ASC')->get() : []; 
   		}else{
        	$prices = $firstCategory  != '' ? $firstCategory->BusinessPriceDetails()->orderBy('id', 'ASC')->get() : []; 
   		}
        // dd($prices);
        $addOnServices = $firstCategory  != '' ?  $firstCategory->AddOnService: [];
        // if (!$prices->isEmpty()) {
            if (!empty($prices)) {
        	$priceId = $priceId ?? $prices[0]['id'];
            foreach ($prices as  $pr) {
            	$select = $pr['id'] == $priceId ? 'selected' : '';
                $priceOption .='<option value="'.$pr['id'].'" '.$select.'>'.$pr['price_title'].'</option>';
            }
        }
        $BusinessActivityScheduler = BusinessActivityScheduler::where('serviceid',$serviceId)->where('category_id',@$firstCategory->id)->where('starting','<=',date('Y-m-d',strtotime($activityDate)) )->where('end_activity_date','>=',  date('Y-m-d',strtotime($activityDate)) )->whereRaw('FIND_IN_SET("'.date('l',strtotime($activityDate)).'",activity_days)');
		$bschedule = $BusinessActivityScheduler->get();
		$bschedulefirst = $scheduleId != '' ? $BusinessActivityScheduler->when($scheduleId, function ($query) use ($scheduleId) {
		    $query->where('id', $scheduleId);
		})->first() : '';
		$scheduleId = $scheduleId ?? ''; $timeChk= 1;
		if(date('Y-m-d',strtotime($activityDate)) == date('Y-m-d') ){
            $start = new DateTime(@$bschedulefirst->shift_start);
            $start_time = $start->format("Y-m-d H:i"); $current = new DateTime();
            $current_time =  $current->format("Y-m-d H:i");
            if($service->can_book_after_activity_starts == 'No' && $service->beforetime != ''  && $service->beforetimeint != '' ){
            	$matchTime = $start->modify('-'.$service->beforetimeint.' '.$service->beforetime)->format("Y-m-d H:i");
				$timeChk =  $current_time <  $matchTime ? 0 : 1;
			}else if($service->can_book_after_activity_starts == 'Yes' && $service->aftertime != '' && $service->aftertimeint != ''){
				$matchTime = $start->modify('+'.$service->aftertimeint.' '.$service->aftertime)->format("Y-m-d H:i");
				$timeChk =  $current_time <  $matchTime ? 1 : 0;
			}
        }
        $pricedata = BusinessPriceDetails::where('id', $priceId)->first(); $totalquantity =0;
        $SpotsLeft = UserBookingDetail::where('act_schedule_id',@$bschedulefirst->id)->whereDate('bookedtime', '=', date('Y-m-d',strtotime($activityDate)))->get();
        foreach($SpotsLeft as $data){
            $totalquantity += $data->userBookingDetailQty();
		}
		$maxSports = @$bschedulefirst->spots_available != '' ? $bschedulefirst->spots_available - $totalquantity : 0;
		$adult_price =  $pricedata != '' && $scheduleId != ''  ? $pricedata->getCurrentPrice('adult',$request->date) : 0;
        $child_price =  $pricedata != '' && $scheduleId != '' ? $pricedata->getCurrentPrice('child',$request->date) : 0;  
        $infant_price = $pricedata != '' && $scheduleId != '' ? $pricedata->getCurrentPrice('infant',$request->date) : 0;
        $adultDiscountPrice=  $pricedata != '' && $scheduleId != '' ? $pricedata->getDiscoutPrice('adult',$request->date) : 0;
        $childDiscountPrice=  $pricedata != '' && $scheduleId != '' ? $pricedata->getDiscoutPrice('child',$request->date) : 0;  
        $infantDiscountPrice= $pricedata != '' && $scheduleId != '' ? $pricedata->getDiscoutPrice('infant',$request->date) : 0;
        $paySession = @$pricedata->pay_session;
        $date = new DateTime($activityDate);
		$formattedDate = $date->format('l, F j, Y');
        // dd($request->type);
        $page = 'subdomain.booking_html';
		// if(@$request->type == 'checkin_portal'){ $page = 'checkin.booking_html';}else{ $page = 'activity.activity_booking_html'; }
    	$html = View::make($page)->with(['activityDate' => $activityDate, 'service' => $service ,'serviceId' => $serviceId , 'companyId' => $companyId ,'users'=>$request->users ,'chk_found'=>$chkFound ,'categories' => $categories, 'priceOption' =>$priceOption,'bschedule' =>$bschedule , 'timeChk' => $timeChk ,'maxSports' =>  $maxSports , 'adultPrice' => $adult_price , 'childPrice' => $child_price, 'infantPrice' => $infant_price , 'addOnServices' =>$addOnServices ,'priceId' =>$priceId ,'bschedulefirst' => $bschedulefirst ,'date' =>$date,'categoryId' =>$categoryId ,'scheduleId' =>$scheduleId , 'paySession' => $paySession ,'adultDiscountPrice' => $adultDiscountPrice,'childDiscountPrice' => $childDiscountPrice,'infantDiscountPrice' => $infantDiscountPrice])->render();
 		return response()->json(['html' => $html ,'date'=>$formattedDate]);
    }

    public function logout(Request $request,$unique_code)
    {
        // $loggedinUser = Auth::user()->cid;
        $business = CompanyInformation::where('unique_code', $unique_code)->first();
        $loggedinUser=$business->id;
        Auth::logout();
        Session::flush();
        $cookie = cookie()->forget('sub_session');
        $code = CompanyInformation::where('id', $loggedinUser)->first();
        return redirect()->route('/login', ['unique_code' => $unique_code]);
    }

    public function getParticipateData(Request $request){
    	$cusId = $request->cus_id ?? '';
    	$family = getFamilyMember($cusId,$request->cid);
    	$priceid = $request->priceid;  $type = $request->type; 
    	$customer = ( $cusId ) ? Customer::find($cusId) : '';
		return view('subdomain.participate_data' ,compact('priceid','type','family','customer'));
    }

    public function getInsData(Request $request){
    	$scheduler = BusinessActivityScheduler::find($request->scheduleId);
    	return view('subdomain.ins_modal',compact('scheduler'));
    }

    public function addToCart(Request $request)
    {
        // dd($request->all());

        // Retrieve data from the request
        $tax = $request->value_tax ?? 0;
        $tip_amt_val = $request->tip_amt_val ?? 0;
        $dis_amt_val = $request->dis_amt_val ?? 0;
        $parti_from_chkout_regi = $request->has('pc_value') ? ['id' => $request->pc_regi_id, 'from' => $request->pc_user_tp, 'pc_name' => $request->pc_value] : [];
        $categoryid = $request->categoryid ?? null;
        $p_session = $request->pay_session ?? '';
        $activity_days = $request->activity_days ?? null;
        $notes = $request->notes ?? '';
        $repeateTimeType = $request->repeateTimeType ?? '';
        $everyWeeks = $request->everyWeeks ?? 0;
        $monthDays = $request->monthDays ?? 0;
        $enddate = $request->has('enddate') ? date('Y-m-d', strtotime($request->enddate)) : null;
        $addOnServicesId = $request->addOnServicesId ?? null;
        $addOnServicesQty = $request->addOnServicesQty ?? null;
        $addOnServicesTotalPrice = $request->addOnServicesTotalPrice ?? 0;
        $pid = $request->pid ?? 0;
        $priceid = $request->priceid ?? 0;
        $chk = $msg = '';

        $price = $request->price ?? 0;
        $pricetotal = $request->pricetotal ?? 0;
        $actscheduleid = $request->actscheduleid ?? 0;
        $sesdate = isset($request->sesdate) ? date('Y-m-d', strtotime($request->sesdate)) : 0;

        // Retrieve business service based on pid
        $result = DB::select('select * from business_services where id = ?', [$pid]);

        $infantarray = $childarray = $adultarray = $totparticipate = [];
        $tot_qty = 0;

        if ($request->aduquantity != 0) {
            $adultarray = ['quantity' => $request->aduquantity, 'price' => $request->cartaduprice];
            $tot_qty += $request->aduquantity;
        }
        if ($request->childquantity != 0) {
            $childarray = ['quantity' => $request->childquantity, 'price' => $request->cartchildprice];
            $tot_qty += $request->childquantity;
        }
        if ($request->infantquantity != 0) {
            $infantarray = ['quantity' => $request->infantquantity, 'price' => $request->cartinfantprice];
            $tot_qty += $request->infantquantity;
        }

        if (isset($request->participateAry)) {
            $totparticipate = $request->participateAry;
        } else {
            for ($i = 0; $i < $tot_qty; $i++) {
                if ($request->user) {
                    $totparticipate[] = ['id' => $request->user, 'from' => "user"];
                } else {
                    $totparticipate[] = ['id' => '', 'from' => "user"];
                }
            }
        }
        // dd($request->participateAry);
        // dd($activity_days);
        if (count($result) > 0) {
            $cartWidgetIds = []; 
            foreach ($result as $item) {
                $pictures = explode(',', $item->profile_pic);
                $p_image = @$pictures[0];
    
                // Save to CartWidget table
                $cartWidget = CartWidget::create([
                    'user_id'=>$request->user,
                    'business_service_id'=>$request->serviceid,
                    'type' => $item->service_type,
                    'name' => $item->program_name,
                    'code' => $item->id,
                    'image' => $p_image,
                    'adult' => json_encode($adultarray),
                    'child' => json_encode($childarray),
                    'infant' => json_encode($infantarray),
                    'actscheduleid' => $actscheduleid,
                    'session_date' => $sesdate,
                    'total_price' => $pricetotal,
                    'priceid' => $priceid,
                    'participate' => json_encode($totparticipate),
                    'tax' => $tax,
                    'discount' => $dis_amt_val,
                    'tip' => $tip_amt_val,
                    'participate_from_checkout_regi' => json_encode($parti_from_chkout_regi),
                    'chk' => $chk,
                    'categoryid' => $categoryid,
                    'p_session' => $p_session,
                    'repeateTimeType' => $repeateTimeType,
                    'everyWeeks' => $everyWeeks,
                    'monthDays' => $monthDays,
                    'enddate' => $enddate,
                    'activity_days' => $activity_days,
                    'addOnServicesId' => $addOnServicesId,
                    'addOnServicesQty' => $addOnServicesQty,
                    'addOnServicesTotalPrice' => $addOnServicesTotalPrice
                ]);
                $cartWidgetIds[] = $cartWidget->id;
            }
        }

        if ($request->chk == 'activity_purchase') {
            return redirect()->route('business.orders.create', ['business_id' => Auth::user()->cid, 'cus_id' => $request->pageid]);
        } elseif ($request->chk == 'calendar_activity_purchase') {
            return config('app.url') . '/business/' . Auth::user()->cid . '/paymentModal/' . $request->pageid;
        } elseif ($request->chk == 'checkin') {
            // return 'Membership added successfully.';
                // Return success message along with all the CartWidget IDs
            return response()->json([
                'message' => 'Memberships added successfully.',
                'cartWidgetIds' => $cartWidgetIds,
            ]);
        } else {
            if ($msg == '') {
                $msg = route('successcart_sub', ['priceid' => $priceid]);
            }
            return $msg;
        }
    }
    public function successcart($priceid)
    {   
        $total_quantity=0; $cart_item = [];
        if (session()->has('cart_item')) { $cart_item = session()->get('cart_item'); }
        $pricedetails = BusinessPriceDetails::find($priceid);
        $sdata = BusinessServices::where('id',$pricedetails->serviceid)->first();
        $ser = BusinessService::where('cid', @$sdata->cid)->first();
        $companyData = CompanyInformation::where('id',@$sdata->cid)->first();
        $discovermore = BusinessServices::where('cid',@$sdata->cid)->where('id','!=',$sdata->id)->where('is_active', 1)->limit(4)->get();
        return view('activity.success_cart',[
            'priceid'=> $priceid, 'cart'=> $cart_item, 'companyData'=> $companyData, 'sdata'=> $sdata, 'discovermore'=> $discovermore, 'ser'=> $ser
        ]);
    }
    public function getMembershipPayment(Request $request){
        // dd($request->all());
        $cart = $request->input('cart_items'); 
        $users=$request->users??auth()->user()->id;

        $customer_id= $request->customer_id;
        $customer = Customer::where('id', $customer_id)->first(); 
        if ($customer) {
            $businessId = $customer->business_id; 
        }
        $cartWidgetIds = $request->cartWidgetIds;
        if (is_array($cart) && isset($cart['selectedOptions'])) {
            $item = $cart['selectedOptions'][0]; 
            $serprice = BusinessPriceDetails::where('id', $cart['priceid'])->first();    
            $cartCount = 1; $totalquantity =  $discount = 0;    
            if (!empty($item['adult'])) {
                $totalquantity += $item['adult']['quantity'];
                $discount += $item['adult']['quantity'] * ($item['adult']['price'] * (int) @$serprice['adult_discount']) / 100;
            }
            if (!empty($item['child'])) {
                $totalquantity += $item['child']['quantity'];
                $discount += $item['child']['quantity'] * ($item['child']['price'] * (int) @$serprice['child_discount']) / 100;
            }
            if (!empty($item['infant'])) {
                $totalquantity += $item['infant']['quantity'];
                $discount += $item['infant']['quantity'] * ($item['infant']['price'] * (int) @$serprice['infant_discount']) / 100;
            }    
            $item_price = $request->totalPrice;
            $fees = BusinessSubscriptionPlan::where('id', 1)->first(); 
    
            $service_fee = ($item_price * $fees->service_fee) / 100;
            $tax = ($item_price * $fees->site_tax) / 100;
            $total_amount = number_format(($item_price + $service_fee + $tax - $discount), 2, '.', '');
            $subTotal = ($discount) ? number_format($item_price - $discount, 2) : number_format($item_price, 2);
            $taxDisplay = number_format(($tax + $service_fee), 2);
    
            $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
            $customer = Customer::find($request->customer_id);
            $customer->create_stripe_customer_id(); 
            $intent = $stripe->setupIntents->create([
                'customer' => @$customer->stripe_customer_id,
                'payment_method_types' => ['card'],
            ]);
    

    	    $cardInfo = StripePaymentMethod::where('user_type', 'User')->where('user_id', $users)->get();
            // dd($users);
            return view('subdomain.membership_payment', compact('intent','cardInfo', 'cartWidgetIds','cartCount' ,'discount' ,'taxDisplay' ,'users','total_amount' ,'subTotal','customer_id','businessId'));

        }
    
        return redirect()->back()->withErrors('Cart data is invalid');
    }
    public function memberhsipPay(Request $request){
        $cartWidgetIds = json_decode($request->input('cartWidgetIds'), true);
        $loggedinUser = Customer::find($request->customer_id);
        $cartService = new CartService();
        $userid=$request->user_id;
        $user=User::where('id',$userid)->first();
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
                        'user_id' => $userid,
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

    
            }catch(Exception $e) {
                $errormsg = $e->getError()->message.$e->getLine();
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
                        'user_id' =>$userid,
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
                return $e->getError()->message . $e->getLine();
            }catch(\Stripe\Exception\InvalidRequestException $e) {
                return "Your card is not connected with your account. Please add your card again.";
            }catch( \Exception $e) {
                return  $e->getError()->message . $e->getLine() ;
            }
        }

        $bspdata = BusinessSubscriptionPlan::where('id',1)->first();
        $tax = $bspdata->site_tax;
        foreach($cartWidgetIds as $cart){
            $item=CartWidget::where('id',$cart)->first();
            $activityScheduler = BusinessActivityScheduler::find($item->actscheduleid) ;
            $businessServices = BusinessServices::find($item->code);
            $user = $businessServices->user;
            $price_detail=BusinessPriceDetails::where('id',$item->priceid)->first();


            // new start

            $participateData = json_decode($item->participate, true);
            $adultData = json_decode($item->adult, true);
            $infantData = json_decode($item->infant, true);
            $childData = json_decode($item->child, true);
            foreach ($participateData as $key => $p) {
                if (isset($infantData['quantity']) && $key < $infantData['quantity']) {
                    $category = 'infant';
                    $quantity = $infantData['quantity'];
                    $price = $infantData['price'];
                } elseif (isset($childData['quantity']) && $key < ($infantData['quantity'] + $childData['quantity'])) {
                    $category = 'child';
                    $quantity = $childData['quantity'];
                    $price = $childData['price'];
                } else {
                    $category = 'adult';
                    $quantity = $adultData['quantity'];
                    $price = $adultData['price'];
                } 
                if ($p['from'] == 'user') {
                    $findCustomer = Customer::where(['business_id' => $businessServices->cid, 'user_id' => $p['id']])->first();
                    $userID = $findCustomer ? $findCustomer->id : null;
                } elseif ($p['from'] == 'family') {
                    $family = UserFamilyDetail::where('id', $p['id'])->first();
                    $customer = Customer::where(['business_id' => $businessServices->cid, 'fname' => $family->first_name, 'lname' => $family->last_name, 'email' => $family->email])->first();
                    if (!$customer) {
                        $parentId = $family->user ? $family->user->id : null;
                        $customer = Customer::create([
                            'business_id' => $businessServices->cid,
                            'fname' => $family->first_name,
                            'lname' => $family->last_name,
                            'email' => $family->email,
                            'phone_number' => $family->mobile,
                            'emergency_contact' => $family->emergency_contact,
                            'relationship' => $family->relationship,
                            'profile_pic' => $family->profile_pic,
                            'user_id' => null,
                            'parent_cus_id' => $parentId,
                            'gender' => $family->gender,
                            'birthdate' => $family->birthday,
                        ]);
                    }
                    $userID = $customer->id ?? null;
                } else {
                    $userID = $p['id'];
                }    
             
                $participant = [
                    'id' => $userID,
                    'from' => $p['from'],
                    'type' => $category,
                    'quantity' => $quantity,
                    'price' => $price,
                ];
                $newArray[] = $participant;
            }
    
            $participateLoop = $newArray; 
        
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

                $discount = $cartService->getDiscount($item->priceid,$d['type'],$d['price']);
                // dd($discount);
                $addOnServicePrice = @$item->addOnServicesTotalPrice ?? 0 ;
                $priceWithDiscount = $d['price'] - $discount + $addOnServicePrice;
                // dd($price_detail);
                $expiredate = $price_detail->getExpirationDate($item->session_date);

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

                BookingCheckinDetails::create([
                    'business_activity_scheduler_id' => @$activityScheduler->id,
                    'instructor_id' => @$activityScheduler->instructure_ids,
                    'customer_id' => $d['id'],
                    'booking_detail_id' => $booking_detail->id,
                    'checkin_date' => date('Y-m-d',strtotime($item->sesdate)),
                    'use_session_amount' => 0,
                    'source_type' => 'marketplace',
                ]);

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
                    $price_detail,
                    $user
                );

                SGMailService::confirmationMail($email_detail2);
                $company = @$cartService->getCompany($businessServices->cid);
                $businessTerms = @$company->businessterms; 
                $email_detail1 = array(
                    "CustomerName" =>  @$MailCustomer->full_name, 
                    "CompanyName" =>  @$company->company_name, 
                    "RepName" =>  @$company->full_name, 
                    "CompanyAddress" => @$company->company_address(),
                    "Age"=> @$cartService->getParticipateAge(json_encode($participateAry)),
                    "logo"=> @$cartService->getCompany($businessServices->cid)->logo, 
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
    public function editProfile(Request $request ,$business_id, $user_id,$unique_code)
    {
        // dd($request->all());

        if($request->business_id){
            // dd($request->customer_id);
            $business_id=$business_id;
            $cus_id=$user_id;        
            // $business = CompanyInformation::find($business_id);    
            $business = CompanyInformation::where('unique_code', $unique_code)->first();
            $customer=Customer::where('user_id',$user_id)->where('business_id',$business_id)->first();
            $userid=$customer->user_id;
            $userdata=User::where('id',$userid)->first();
            if($customer->primary_account===0)
            {
                $user=UserFamilyDetail::where('id',$userid)->first();
                if($user)
                {
                    $name = @$user->full_name;
                    return view('subdomain.user_family_profile',compact('user','business','name','unique_code'));
                }
                else{
                    $user=customer::where('user_id',$userid)->first();
                    $name = @$customer->full_name;
                    return view('subdomain.customersprofile',compact('user','business','name','unique_code'));
                }
            }
            else{
                $user=User::where('id',$userid)->first();
                $name = @$customer->full_name;
                return view('subdomain.edit_profile',compact('user','business','name','unique_code'));   
            }
        }
    }

    public function searchActivity(Request $request){
        $serviceType = $request->serviceType;
        // dd($request->customerId);
        // dd($serviceType);
        if(!$request->customerId){
            $customer = Auth::user()->customers()->where('business_id' ,$request->businessId)->first();
            $customerID = @$customer->id;
        }else{
            $customer = Customer::find($request->customerId);
            $customerID = $request->customerId;
        }
        $orderDetails = [];
        $tabName = $request->type;
        if($customerID){
            if($request->type == 'current'){
                $bDetails = $this->booking_repo->currentTab($request->serviceType,$request->business_id,@$customer);
            }else{
                $bookingDetails =  $this->booking_repo->otherTab($request->serviceType, $request->business_id,@$customer);
                $bDetails = $this->booking_repo->tabFilterData($bookingDetails,$tabName,request()->serviceType ,date('Y-m-d'));
            }

            foreach($bDetails as $bd){
                if($request->text != ''){
                    $activity = BusinessServices::where('id',$bd->sport)->where('program_name', 'like', '%'.$request->text.'%')->withTrashed()->first();
                }else{
                    $activity = BusinessServices::where('id',$bd->sport)->withTrashed()->first();
                }
                if($activity){
                    $orderDetails[@$bd->business_services_with_trashed->id .'!~!'.@$bd->business_services_with_trashed->program_name] [] = $bd;
                }
            }

            //print_r($orderDetails);exit();
            return view('subdomain.user_booking_detail',compact('orderDetails','tabName','customer'))->render();
        }
    }

    public function customerProfileUpdate(Request $request) {
        // dd('77');
        // dd($request->all());
        $user = Customer::find($request->id);

        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.'
            ], 404);
        }
        
        $successMessage = '';
        $errorMessage = '';
        $status = false;
    
        if ($request->type == 'details') {
            $validated = $request->validate([
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
    
            $successMessage = 'Profile updated successfully!';
            $errorMessage = 'Problem updating profile.';
        } else if ($request->type == 'photo') {
            if ($request->hasFile('profile_pic')) {
                $profilePic = $request->file('profile_pic')->store('customer');
            } else {
                $profilePic = $user->profile_pic;
            }
            $status = $user->update(['profile_pic' => $profilePic]);
            $successMessage = 'Profile photo has been changed successfully.';
            $errorMessage = 'Problem in uploading profile photo.';
            // return Redirect::back();
        }
        if ($status) {
            return response()->json([
                'status' => 'success',
                'message' => $successMessage
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => $errorMessage
            ], 400);
        }
    }
    
    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $status = false;
        $message = '';
        $type = 'error';

        if ($request->type == 'details') {
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

            $message = $status ? 'Profile updated successfully!' : 'Problem in profile update.';
        } else if ($request->type == 'password') {
            $this->validate($request, [
                'newPassword' => 'required',
                'confirmPassword' => 'required',
            ]);

            $status = $user->update(['password' => Hash::make($request->newPassword), 'buddy_key' => $request->newPassword]);
            $message = $status ? 'Password has been changed successfully.' : 'Problem changing password.';
        } else if ($request->type == 'portfolio') {
            $data = $request->except(['_token', 'id', 'type']);
            $status = $user->update($data);
        } else {
            $profilePic = $coverPic = '';

            if ($request->hasFile('profile_pic')) {
                $profilePic = $request->file('profile_pic')->store('customer');
            } else {
                $profilePic = $user->profile_pic;
            }

            if ($request->hasFile('coverPic')) {
                $coverPic = $request->file('coverPic')->store('customer');
            } else {
                $coverPic = $user->cover_photo;
            }

            $status = $user->update(['profile_pic' => $profilePic, 'cover_photo' => $coverPic]);
            $user->customers()->update(['profile_pic' => $profilePic]);

            $message = $status ? 'Profile photo has been changed successfully.' : 'Problem in uploading profile photo.';
        }

        $responseType = $status ? 'success' : 'error';

        return response()->json(['status' => $responseType, 'message' => $message]);
        // return redirect()->back();
        // return Redirect::back()->with('success', $status);
    }
    public function userFamilyProfileUpdate(Request $request) {
        $user = UserFamilyDetail::where('id', $request->id)->first();
        $success = '';
        $fail = '';
   
        // Handle details update
        if ($request->type == 'details') {
            $this->validate($request, [
                'firstname' => 'required',
                'lastname' => 'required',
                'gender' => 'required',
                'phone_number' => 'required',
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
    
            $success = 'Profile updated successfully!';
            $fail = 'There was a problem updating the profile details.';
        }
        // Handle profile picture update
        else if ($request->type == 'photo') {
            if ($request->hasFile('profile_pic')) {
                // dd('22');
                $profilePic = $request->file('profile_pic')->store('customer');
                $status = $user->update(['profile_pic' => $profilePic]);
                $status=true;
            } else {
                $status = false;
            }
    
            $success = 'Profile photo has been updated successfully.';
            $fail = 'There was a problem uploading the profile photo.';
        }
    
        // Return response based on status
        if ($status) {
            return response()->json(['status' => 'success', 'message' => $success]);
        } else {
            return response()->json(['status' => 'error', 'message' => $fail]);
        }
    }

    public function postRegistrationCustomer(Request $request) {
        set_time_limit(-1);
        $postArr = $request->all();
        
        $code=$request->company_info;
        // dd($postArr);
        $companyinfo=WebsiteIntegration::where('id',$code)->first();
        $company = CompanyInformation::where('id', $companyinfo->business_id)->first(); 
        
        $uniqueCode=$company->unique_code;
        // $codeId = decrypt($request->input('code'));
        // $companyinfo = CompanyInformation::where('id', $codeId)->first();
        // $uniqueCode=$companyinfo->unique_code;

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
                    $redirectUrl = route('sub_customer_dashboard', ['unique_code' => $uniqueCode]);

                    if (Auth::check()) {
                        $response = array(
                            'id'=>$customerObj->id,
                            'type' => 'success',
                            'msg' => 'Registration done successfully.',
                            'uniqueCode'=>$uniqueCode,
                            'redirect'=>$redirectUrl,
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

    public function manage_account(Request $request,$unique_code)
    {
        // dd('1');

        $user = $this->user;
        // dd($user->id);
        // $businessId = $request->business_id ?? auth()->user()->cid;
        // $business = CompanyInformation::find($businessId);
        $business = CompanyInformation::where('unique_code', $unique_code)->first();
        $businessId =$business->id;
        $customer_nm=Customer::where('user_id',$user->id)->where('business_id',$businessId)->first();
        $name = @$customer_nm->full_name;
            
        $UserFamilyDetails = $familyDetails = [];
        $customer = @$user->customers;
        // dd($customer);
        // DB::enableQueryLog();

        if($customer){
            foreach($customer as $cs){
                foreach ($cs->get_families() as $fm){
                    $familyDetails [] = $fm;
                }  
            }
            // dd(\DB::getQueryLog()); 
            $groupedFamilyDetails = collect($familyDetails)->groupBy(function ($item) {
                return $item->fname . ' ' . $item->lname;
            });

            $uniqueFamilyDetails = collect([]);

            foreach ($groupedFamilyDetails as $name => $group) {
                $uniqueFamilyDetails->push($group->first()); // Add the first item from each group
            }

            foreach ($uniqueFamilyDetails as $detail) {
                $UserFamilyDetails [] = $detail;
            }
        }else{
            $userfamily = $user->user_family_details;
            foreach($userfamily as $uf){
                $UserFamilyDetails [] = $uf;
            }
        }

        return view('subdomain.manage_account',compact('user','UserFamilyDetails','business','name','unique_code'));
    }

    public function create_manage(Request $request){
        $user = $this->user;
        return view('subdomain.manage_user_create');
    }

    public function store_family(Request $request)
    {
        $user = $this->user;
        $company_ids = $user->customers()->distinct('business_id')->pluck('business_id')->toArray();
        
        $message = "There is issue while adding member.Please try again.";
        $profile_pic = $request->hasFile('profile_pic') ? $request->file('profile_pic')->store('customer') : '';
        UserFamilyDetail::create([
            'user_id' => $user->id,
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'emergency_contact' => $request->emergency_contact,
            'relationship' => $request->relationship,
            'gender' => $request->gender,
            'profile_pic' => $profile_pic,
            'birthday' =>   $request->birthdate,
            'emergency_contact_name' => $request->emergency_name,
        ]);

        $chkProviderOrNot = CompanyInformation::where('user_id' , $user->id)->get(); 
        if($chkProviderOrNot->isNotEmpty()){
            foreach($chkProviderOrNot as $key=>$c){
                $businessCustomer = $c->customers()->where('user_id', $user->id)->first();
                if($businessCustomer == ''){
                    $random_password = Str::random(8);
                    $password = Hash::make($random_password);
                    $businessCustomer = createBusinessCustomer($user,$password,$c->id); 
                }
            }
        }

        $company = CompanyInformation::whereIn('id' ,$company_ids)->get();

        foreach($company as $key=>$c){
            $password = '';
            if($key == 0){
                $random_password = Str::random(8);
                $password = Hash::make($random_password);
            }

            $customer = Customer::where(['business_id'=> $businessCustomer->business_id, 'fname' =>  $request->fname,'lname' => $request->lname,'parent_cus_id' => $businessCustomer->id])->first();
            if($customer == ''){
                $createCustomer = Customer::create([
                    'business_id' => $c->id,
                    'fname' => $request->fname,
                    'lname' => $request->lname,
                    'email' => $request->email,
                    'phone_number' => $request->mobile,
                    'emergency_contact' => $request->emergency_contact,
                    'relationship' => $request->relationship,
                    'profile_pic' => $profile_pic,
                    'gender' => $request->gender,
                    'birthdate' =>  $request->birthdate,
                    'parent_cus_id' => $businessCustomer->id,
                ]); 
                $createCustomer->create_stripe_customer_id();

                $chk = 1;
            }else{
                $message = 'Member already added as customer..';
            }
        }

        return redirect()->back()->with(['message'=>$message]);
    }

    public function paymentHistory(Request $request,$unique_code){
        $user = $this->user;
        // $businessId = $request->business_id ?? auth()->user()->cid;
        // $business = CompanyInformation::find($businessId);
        $business = CompanyInformation::where('unique_code', $unique_code)->first();
        $businessId =$business->id;
        $customer_nm=Customer::where('user_id',$user->id)->where('business_id',$businessId)->first();
        $name = @$customer_nm->full_name;
        if(!$businessId){
            return redirect()->back();
        }
        $customers = $user->customers()->where('business_id',$businessId)->first();
        $customer_ids = @$customers->id;
        $business_id = $businessId;
        // \DB::enableQueryLog();
            $statusArray = Transaction::select('transaction.*')->where('item_type', 'UserBookingStatus')
              ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
              ->join('user_booking_details as ubd', function($join) use ($business_id,$customer_ids) {
                    $join->on('ubd.booking_id', '=', 'ubs.id')
                        ->where('ubd.order_type', 'Membership')
                        ->where('ubd.user_id', $customer_ids)
                        ->where('ubd.business_id', '=', $business_id);
              })->get()->toArray();
        // dd(\DB::getQueryLog()); 
        // dd($statusArray);
        $recurringArray = Transaction::select('transaction.*')->Where('item_type', 'Recurring')
                    ->join('recurring as re', 're.id', '=', 'transaction.item_id')->where('re.business_id', '=', $business_id)->where('re.user_id', $customer_ids)->get()->toArray();

        
        $mergedArray = array_merge($statusArray, $recurringArray);
        usort($mergedArray, function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        $mergedCollection = collect($mergedArray)->sortByDesc('created_at');
        $perPage = 10; 
        $currentPage = request()->get('page', 1); 
        $paginatedData = array_slice($mergedArray,($currentPage - 1) * $perPage, $perPage);
        $transactionDetail = new \Illuminate\Pagination\LengthAwarePaginator(
            $paginatedData,
            count($mergedCollection),
            $perPage,
            $currentPage
        );
        // dd($transactionDetail);
        $transactionDetail->setPath(url()->current());

        // dd($transactionDetail);
        return view('subdomain.payment_history', compact('transactionDetail','business','name','unique_code')); 
    }
    
    public function receiptmodel($orderId,$customer,$isFrom = null){
        // dd('6');
        $customerData = Customer::where('id',$customer)->first();
        $transaction = Transaction::where('item_id',$orderId)->first();
        if(!$isFrom){
            if(@$transaction->item_type == 'UserBookingStatus'){
                $oid = $orderId; $bookingArray = UserBookingDetail::where('booking_id',$oid)->pluck('id')->toArray();
            }else{
                $orderId = @$transaction->Recurring->booking_detail_id; $oid = $orderId;
                $bookingArray = UserBookingDetail::where('id',$orderId)->pluck('id')->toArray();
            }
            $transactionType = @$transaction->item_type;
        }else{
            $oid = $orderId;
            $bookingArray = UserBookingDetail::where('id',$orderId)->pluck('id')->toArray();
            $transactionType = 'Membership';
        }
        // dd('33');
        return view('subdomain._receipt_model',['array'=> $bookingArray ,'email' =>@$customerData->email, 'orderId' => $oid ,'type' =>$transactionType]);
    }

    public function sendreceiptfromcheckout(Request $request){
        $compare_chk=[];
        
        $odetail = explode("," , $request->orderdetalidary);
        foreach($odetail as $od){
             $book_data = UserBookingDetail::getbyid($od);
             $cid = @$book_data->business_id;
             $newary = array($cid=>array("oid"=>$od,"cid"=> $cid,"booking_id"=>$request->booking_id));
             if(in_array( $cid ,array_keys($compare_chk))){
                  foreach($compare_chk  as $chk){
                       if($chk['cid'] == $cid ){
                            $oid = $compare_chk[$cid]['oid'].','.$od;
                            $compare_chk[$cid]['oid'] = $oid;
                       }
                  }
             }else{
                  $compare_chk  = $compare_chk + $newary;
             }
        }
        foreach($compare_chk as $detail){
             $orderId = explode("," , $detail['oid']);
             foreach($orderId as $oid){
                  $getreceipemailtbody = $this->booking_repo->getreceipemailtbody($detail['booking_id'], $oid);

                  if($request->notes != ''){
                       $getreceipemailtbody['notes'] = $request->notes;
                  } 
                  $email_detail = array(
                       'getreceipemailtbody' => $getreceipemailtbody,
                       'email' => $request->email);
                  $status  = SGMailService::sendBookingReceipt($email_detail);
             }
        }
   }

     public function creditCards($unique_code)
    {
        $cardInfo = [];
        $intent = null;
        $user = $this->user;
        // dd($user);
        $customers = $user->customers()->pluck('id')->toArray();
        $customer_ids = implode(',',$customers);
        // $businessId = $request->business_id ?? auth()->user()->cid;
        // $business = CompanyInformation::find($businessId);
        $business = CompanyInformation::where('unique_code', $unique_code)->first();
        $businessId = $business->id;
        $customer_nm=Customer::where('user_id',$user->id)->where('business_id',$businessId)->first();
        $name = @$customer_nm->full_name;
       
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

        return view('subdomain.credit_cards',compact('cardInfo','intent','business','name','unique_code'));
    }

        public function cardsSave(Request $request) 
        {
            // dd($request->all());

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
                    $card = StripePaymentMethod::where(['payment_id'=>$payment_method['id']])->first();
                    if(!$card){
                        $stripePaymentMethod = new StripePaymentMethod;
                        $stripePaymentMethod->payment_id = $payment_method['id'];
                        $stripePaymentMethod->user_type = 'User';
                        $stripePaymentMethod->user_id = $user->id;
                        $stripePaymentMethod->pay_type = $payment_method['type'];
                        $stripePaymentMethod->brand = $payment_method['card']['brand'];
                        $stripePaymentMethod->exp_month = $payment_method['card']['exp_month'];
                        $stripePaymentMethod->exp_year = $payment_method['card']['exp_year'];
                        $stripePaymentMethod->last4 = $payment_method['card']['last4'];
                        $stripePaymentMethod->save();
                    }
                }
            }

            return redirect()->route('credit-cards');     
        }

        public function cardDelete(Request $request) {
            $user = User::where('id', $this->user->id)->first();
            $stripePaymentMethod = \App\StripePaymentMethod::where('payment_id', $request->stripe_payment_method)->firstOrFail();
            $stripePaymentMethod->delete();
        }

        public function activity_scheduler_index(Request $request,$bussinessId,$unique_code)
        {
            // return '33';
            // dd('4');
            try {
                $chkScheduleSession = '';
                // $business_id = $request->business_id ?? auth()->user()->cid;
                // $company = CompanyInformation::findOrFail($business_id);
                // $company = CompanyInformation::where('unique_code', $unique_code)->first();
                $business = CompanyInformation::where('unique_code', $unique_code)->first();

                // dd($unique_code);
                $business_id = $business->id;
                $companyName = $business->dba_business_name ?? $business->company_name;
                $business_services = $business->service()->where('is_active', 1)->orderBy('created_at', 'desc');
                $servicetype = 'all';

                if ($request->stype && $request->business_service_id == '') {
                    $servicetype = $request->stype;
                    if ($request->stype != 'all') {
                        $business_services = $business->service()->where(['is_active' => 1, 'service_type' => $servicetype])->orderBy('created_at', 'desc');
                    }

                    if (session()->has('schedule')) {
                        session()->forget('schedule');
                    }
                }

                $user = Auth::user();
                // dd($user);
                $userCompany = @$user->company ?? [];
                $customer = Customer::where(['user_id' => @$user->id, 'business_id' => $business_id])->first();
                $name = @$customer->full_name;

                if ($user && $request->customer_id == '') {
                    $request->customer_id = $customer->id;
                }

                if ($request->customer_id) {
                    if (request()->type == 'user') {
                        $familyMember = Auth::user()->user_family_details()->where('id', request()->customer_id)->first();
                        $user = User::where([
                            'firstname' => @$familyMember->first_name,
                            'lastname' => @$familyMember->last_name,
                            'email' => @$familyMember->email
                        ])->first();
                        $customer = Customer::where(['user_id' => @$user->id])->first();
                    } else {
                        $customer = Customer::where('id', $request->customer_id)->first();
                    }
                    $memberships = @$customer->active_memberships()->pluck('sport')->unique();
                }

                if($request->stype!='all')
                {
                    if ($request->business_service_id) {
                        $servicetype = $request->stype;
                        $business_services = $business_services->where(['id' => $request->business_service_id, 'is_active' => 1, 'service_type' => $servicetype]);
                    }
                }
                else{
                    if ($request->business_service_id) {
                        $servicetype = $request->stype;
                        $business_services = $business_services->where(['id' => $request->business_service_id, 'is_active' => 1]);
                    }
                }

                $service_ids = $business_services->pluck('id')->toArray();        
                $filter_date = new DateTime();
                $shift = 1;
                if ($request->date && (new DateTime($request->date)) > $filter_date) {
                    $filter_date = new DateTime($request->date);
                    $shift = 0;
                }
                $days = [];
                $days[] = new DateTime(date('Y-m-d'));
                for ($i = 0; $i <= 100; $i++) {
                    $d = clone($filter_date);
                    $days[] = $d->modify('+' . ($i + $shift) . ' day');
                }

                $services = [];
                if (!empty($service_ids)) {
                    $serviceids = BusinessPriceDetailsAges::whereIn('serviceid', $service_ids)
                        ->where('stype', '1')
                        ->whereIn('class_type', $business_services->pluck('service_type')->toArray())
                        ->pluck('serviceid');

                    $bookschedulers = BusinessActivityScheduler::getallscheduler($filter_date)
                        ->whereIn('serviceid', $serviceids)
                        ->orderBy('shift_start', 'asc')
                        ->get();

                    foreach ($bookschedulers as $bs) {
                        $services[] = $bs->business_service;
                    }

                    $services = array_unique($services);
                }

                if ($user && count($userCompany) == 0) {
                    $request->customer_id = '';
                }
                // dd($days);
                // dd($days);
                return view('subdomain.activity_schedule', [
                    'days' => $days,
                    'filter_date' => $filter_date,
                    'serviceType' => $servicetype,
                    'services' => $services,
                    'companyName' => $companyName,
                    'businessId' => $business_id,
                    'priceid' => $request->priceid,
                    'customer' => $customer,
                    'business'=>$business,
                    'unique_code'=>$unique_code,
                    'name'=>$name,
                ]);
            } catch (\Exception $e) {
                \Log::error('Error in schedule method: ' . $e->getMessage());
                return redirect()->back();
                // dd($e->getMessage());
            }
            
        }

        public function setSessionOfSchedule(Request $request){
            Session::put('schedule', $request->businessId);   
        }

        public function chksession($dId,$date = null,$timeid = null,$chk = null){
            $inSession = 0;
            $detail = UserBookingDetail::find($dId);
            $inSessionArray = Session::get('multibooking') ?? [];
            $remaining = $detail->getremainingsession();
            if($date != ''){
                foreach($inSessionArray as $i=>$ary){
                    if($ary['timeId'] == $timeid && $ary['date'] == $date){
                        $inSessionArray[$i]['priceId'] = $detail->priceid;
                        $inSessionArray[$i]['oId'] = $detail->id;
                    }
                }
                session::put('multibooking', $inSessionArray);
            }
            if($chk == 1){
                foreach($inSessionArray as $i=>$ary){
                    if($ary['priceId'] == $detail->priceid && $ary['oId'] == $detail->id){
                        $inSession++; 
                    }
                }
            }
            $inSession = max(1, $inSession);
            $remaining = $remaining - $inSession;
            return max(0, $remaining);
        }
        public function chkOrderAvailable(Request $request){
            $html = $data = ''; $remaining = 0; $firstDataProcessed = false; 
            if($request->priceId != ''){
                $priceDetail = BusinessPriceDetails::find($request->priceId);
                $bookingDetail = UserBookingDetail::where(['sport'=> $request->sid ,'user_id'=>$request->cid,'priceid' => $request->priceId])->whereDate('expired_at' ,'>' ,date('Y-m-d'))->first();
                $remaining = max(@$bookingDetail != '' ? @$bookingDetail->getremainingsession() - 1 : 0, 0);
                @$bookingDetail != '' ? @$bookingDetail->getremainingsession() - 1 : 0;
                if($remaining != 0 ){
                    $html .= '<option value="'.$priceDetail->id.'" data-did="'.$bookingDetail->id.'">'.$priceDetail->price_title.'</option>';
                }
            }else{
                $customer = Customer::where('business_id' ,$request->businessId)->find($request->cid);
                $active_memberships = $customer ? @$customer->active_memberships()->where('user_booking_details.user_id',$request->cid)->get() : [];

                foreach($active_memberships as $active_membership){
                    $remainingSession = max($active_membership->getremainingsession() - 1, 0);
                    if($remainingSession > 0 && $active_membership->business_price_detail){
                        $priceDetail = $active_membership->business_price_detail;
                        $html .= '<option value="'.$priceDetail->id.'" data-did ="'.$active_membership->id.'">'.$priceDetail->price_title.'</option>';
                        if (!$firstDataProcessed) {
                            $remaining = $remainingSession; 
                            $firstDataProcessed = true; 
                        }
                    }
                }
            }
            if($html != ''){
                $data .='<select class="mb-10 form-select" id="priceId" onchange="getRemainingSession()">'.$html.'</select><div class="font-red text-center" id="remainingSession">'.$remaining.' Session Remaining.</div>';
            }
            return $data;
        }

        public function store_scheduler(Request $request)
        {  
            
            $activitySchedulerData = BusinessActivityScheduler::find($request->timeid);
            $customer = Customer::where(['id'=>$request->customerID,'business_id'=>$request->businessId])->first();
            $UserBookingDetails = '';
            $today = date('Y-m-d');
            
            $UserBookingDetails = $customer->bookingDetail()->when($request->oid, function($query) use($request){
                    $query->where('id', $request->oid);
                })->when($request->priceId, function ($query) use ($request) {
                    $query->where('priceid', $request->priceId);
                })
                //->where('sport',$request->serviceID)
                ->orderby('created_at','desc')->first();
            if($UserBookingDetails != ''){
                $sendmail = 0;
                $checkIndetail = $UserBookingDetails->BookingCheckinDetails()->whereDate('checkin_date','=',$request->date)->where(['checked_at' =>null])->first();
                if($request->date == $today){
                    $start_time = (new DateTime($activitySchedulerData->shift_start))->format("H:i");
                    $current_time = (new DateTime())->format("H:i");
                    if($current_time > $start_time){
                        return "You can't book this activity for today";
                    }
                }
                if($checkIndetail != ''){
                    $checkIndetail->update(["business_activity_scheduler_id"=>$request->timeid,
                            "checkin_date"=>$request->date]);
                    $sendmail = 1;
                }else{
                    $chkData = $UserBookingDetails->BookingCheckinDetails()->whereDate('business_activity_scheduler_id',0)->where(['checkin_date' =>null])->first();
                    if($chkData != ''){
                        $chkData->update(["business_activity_scheduler_id"=>$request->timeid,
                            "checkin_date"=>$request->date, "instructor_id"=>@$activitySchedulerData->instructure_ids]);
                        $sendmail = 1;
                    }else{
                        // echo $UserBookingDetails.'<br>';
                        // print_r($UserBookingDetails->BookingCheckinDetails()->get());
                        // echo '<br>';
                        //echo $UserBookingDetails->BookingCheckinDetails()->count();
                        if($UserBookingDetails->BookingCheckinDetails()->count() < $UserBookingDetails->pay_session){
                            BookingCheckinDetails::create([
                                "business_activity_scheduler_id"=>$request->timeid, 
                                "instructor_id"=>@$activitySchedulerData->instructure_ids, 
                                "customer_id" => $customer->id,
                                'booking_detail_id'=> $UserBookingDetails->id,
                                "checkin_date"=>$request->date,
                                "use_session_amount" => 0,
                                "source_type" => 'online_scheduler'
                            ]);
                            $sendmail = 1;
                        }else{
                            return "fail";
                        }
                    }
                }

                if($sendmail == 1){
                    $UserBookingDetails->update(["act_schedule_id"=>$request->timeid,'bookedtime'=>$request->date]);

                    $getreceipemailtbody = $this->booking_repo->getreceipemailtbody($UserBookingDetails->booking_id, $UserBookingDetails->id);
                    $email_detail = array(
                        'getreceipemailtbody' => $getreceipemailtbody,
                        'email' => $customer->email);
                    $status  = SGMailService::sendBookingReceipt($email_detail);

                    $email_detail_provider = array(
                        "email" => @$UserBookingDetails->company_information->business_email, 
                        "CustomerName" => @$UserBookingDetails->Customer->full_name, 
                        "Url" => env('APP_URL').'/personal/orders?business_id='.Auth::user()->cid, 
                        "BusinessName"=> @$UserBookingDetails->company_information->dba_business_name,
                        "Age" => $this->calculateAge(@$UserBookingDetails->Customer->birthdate), // Using the controller method
                        "BookedPerson"=> @$UserBookingDetails->Customer->full_name,
                        "ParticipantsName"=> @$UserBookingDetails->Customer->full_name,
                        "date"=> date('m/d/Y',strtotime($request->date)),
                        "time"=>  @$UserBookingDetails->business_activity_scheduler->activity_time(),
                        "duration"=> @$UserBookingDetails->business_activity_scheduler->get_clean_duration(),
                        "ActivitiyType"=>  @$UserBookingDetails->business_services->service_type,
                        "ProgramName"=> @$UserBookingDetails->business_services->program_name,
                        "CategoryName"=> @$UserBookingDetails->business_price_detail->business_price_details_ages_with_trashed->category_title);

                    SGMailService::confirmationMail($email_detail_provider);
                }
                //$UserBookingDetails->update(["act_schedule_id"=>$request->timeid,"bookedtime"=>$request->date]);
                return "success";
            }else{
                return "fail";
            }   
        }
        private function calculateAge($birthdate)
        {
            if (!$birthdate) {
                return null; // Return null if birthdate is not available
            }
        
            $birthDateTime = new DateTime($birthdate);
            $currentDateTime = new DateTime();
        
            return $currentDateTime->diff($birthDateTime)->y;
        }


        public function destroy_scheduler(Request $request,$id)
        {
            $checkinDetail = BookingCheckinDetails::findOrFail($id);
            $user_booking_detail = $checkinDetail->UserBookingDetail;
        /* $array = json_decode($user_booking_detail->booking_detail,true);
            $array['sessiondate'] = '';
            UserBookingDetail::where('id',$user_booking_detail->id)->update(["act_schedule_id"=>'',"bookedtime"=>NULL,'booking_detail'=>json_encode($array)]);*/
            UserBookingDetail::where('id',$user_booking_detail->id)->update(["act_schedule_id"=>'']);
            $checkinDetail->delete();

            return response()->json([
                'success' => true,
                'message' => 'Rescheduled successfully',
            ], 200);
        }

    public function data(Request $request)
    {
        // dd($request->all());
        $companyinfo = $request->companyinfo;
        $code = CompanyInformation::where('id', $companyinfo['business_id'])->first();
        $filter_date = new DateTime();
        $shift = 1;
        
        if ($request->date && (new DateTime($request->date)) > $filter_date) {
            $filter_date = new DateTime($request->date);    
            $shift = 0;
        }    
        $dayName = $filter_date->format('l');
        $services = $request->input('services', 'All Services');
        $greatfor = $request->input('great_for', 'All');
        $difficultylevel = $request->input('difficulty_level', 'All Levels');
        $bookschedulers = BusinessActivityScheduler::whereHas('business_service', function($query) use ($services, $greatfor, $difficultylevel) {
            $query->where('business_services.is_active', 1);             
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
        ->whereHas('business_price_details_ages', function ($query) {
            $query->where('stype', 1);
            $query->whereNotNull('class_type');
        })
        ->where('activity_days', 'LIKE', "%$dayName%") 
        ->where('end_activity_date', '>', now()) 
        ->where('cid',$code->id) 
        ->orderBy('end_activity_date', 'desc')
        ->get();
        $days = [];
        $days[] = new DateTime(date('Y-m-d'));
        for($i = 0; $i <= 4; $i++){
            $d = clone($filter_date);
            $days[] = $d->modify('+'.($i+$shift).' day');
        }
        if ($request->ajax()) {
            return view('subdomain.scheduler', compact('bookschedulers', 'filter_date', 'days', 'companyinfo','code'))->render();
        }
        
        return view('subdomain.schedule', compact('bookschedulers', 'filter_date', 'request', 'days', 'companyinfo','code'));
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


    public function schedule_index(Request $request, $business_id)
    {
        // return '33';
        // dd('44');/''
        try {
            $chkScheduleSession = '';
            $company = CompanyInformation::findOrFail($business_id);
            $companyName = $company->dba_business_name ?? $company->company_name;
            $business_services = $company->service()->where('is_active', 1)->orderBy('created_at', 'desc');
            $servicetype = 'all';

            if ($request->stype && $request->business_service_id == '') {
                $servicetype = $request->stype;
                if ($request->stype != 'all') {
                    $business_services = $company->service()->where(['is_active' => 1, 'service_type' => $servicetype])->orderBy('created_at', 'desc');
                }

                if (session()->has('schedule')) {
                    session()->forget('schedule');
                }
            }

            $user = Auth::user();
            // dd($user);
            $userCompany = @$user->company ?? [];
            $customer = Customer::where(['user_id' => @$user->id, 'business_id' => $business_id])->first();
            $name = @$customer->full_name;

            if ($user && $request->customer_id == '') {
                $request->customer_id = $customer->id;
            }

            if ($request->customer_id) {
                if (request()->type == 'user') {
                    $familyMember = Auth::user()->user_family_details()->where('id', request()->customer_id)->first();
                    $user = User::where([
                        'firstname' => @$familyMember->first_name,
                        'lastname' => @$familyMember->last_name,
                        'email' => @$familyMember->email
                    ])->first();
                    $customer = Customer::where(['user_id' => @$user->id])->first();
                    $name = @$customer->full_name;

                } else {
                    $customer = Customer::where('id', $request->customer_id)->first();
                    $name = @$customer->full_name;

                }
                $memberships = @$customer->active_memberships()->pluck('sport')->unique();
            }

            if($request->stype!='all')
            {
                if ($request->business_service_id) {
                    $servicetype = $request->stype;
                    $business_services = $business_services->where(['id' => $request->business_service_id, 'is_active' => 1, 'service_type' => $servicetype]);
                }
            }
            else{
                if ($request->business_service_id) {
                    $servicetype = $request->stype;
                    $business_services = $business_services->where(['id' => $request->business_service_id, 'is_active' => 1]);
                }
            }

            $service_ids = $business_services->pluck('id')->toArray();        
            $filter_date = new DateTime();
            $shift = 1;
            if ($request->date && (new DateTime($request->date)) > $filter_date) {
                $filter_date = new DateTime($request->date);
                $shift = 0;
            }
            $days = [];
            $days[] = new DateTime(date('Y-m-d'));
            for ($i = 0; $i <= 100; $i++) {
                $d = clone($filter_date);
                $days[] = $d->modify('+' . ($i + $shift) . ' day');
            }

            $services = [];
            if (!empty($service_ids)) {
                $serviceids = BusinessPriceDetailsAges::whereIn('serviceid', $service_ids)
                    ->where('stype', '1')
                    ->whereIn('class_type', $business_services->pluck('service_type')->toArray())
                    ->pluck('serviceid');

                $bookschedulers = BusinessActivityScheduler::getallscheduler($filter_date)
                    ->whereIn('serviceid', $serviceids)
                    ->orderBy('shift_start', 'asc')
                    ->get();

                foreach ($bookschedulers as $bs) {
                    $services[] = $bs->business_service;
                }

                $services = array_unique($services);
            }

            if ($user && count($userCompany) == 0) {
                $request->customer_id = '';
            }
            return view('subdomain.activity_schedule', [
                'days' => $days,
                'filter_date' => $filter_date,
                'serviceType' => $servicetype,
                'services' => $services,
                'companyName' => $companyName,
                'businessId' => $business_id,
                'priceid' => $request->priceid,
                'customer' => $customer,
                'company'=>$company,
                'business'=>$company,
                'name'=>$name,
                'unique_code'=>$company->unique_code,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in schedule method: ' . $e->getMessage());
            // return redirect()->back();
            dd($e->getMessage());
        }
        
    }
    public function checkin(Request $request){
        // dd($request->all());
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
}
