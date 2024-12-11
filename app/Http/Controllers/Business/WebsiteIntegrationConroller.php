<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\WebsiteIntegration;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Validator;
use Response;
use DB,Carbon\Carbon;
use App\User;
use App\CompanyInformation;
use App\{BusinessServices,BusinessService,BusinessPriceDetails,BusinessClassPriceDetails,BusinessSubscriptionPlan,BusinessPriceDetailsAges,BusinessActivityScheduler,UserFollow,BusinessServicesFavorite,StripePaymentMethod,Customer,Transaction,CustomerNotes,Recurring,CustomersDocuments,Announcement,BookingCheckinDetails,BusinessTerms,UserBookingDetail,SGMailService,UserFamilyDetail,UserBookingStatus};
use App\Repositories\{BookingRepository};
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Repositories\CustomerRepository;
use Illuminate\Support\Facades\Hash;
use App\BusinessStaff;
use DateTime;
use App\Services\CartService;
use View;
use Stripe\StripeClient;
use Exception;
use Illuminate\Support\Facades\Redirect;
use App\Services\CartWidgetService;
use Illuminate\Support\Facades\Crypt;
use App\helpers\CartHelper;
use App\CartWidget;
class WebsiteIntegrationConroller extends Controller
{
    //

    // protected $booking_repo;

    // public function __construct(BookingRepository $booking_repo) {
    //     $this->middleware(function ($request, $next) {
    //         $this->user = Auth::user();
    //         return $next($request);
    //     });
    //      $this->booking_repo = $booking_repo;
    // }

    protected $customers;
    protected $booking_repo;
    protected $user;

    public function __construct(CustomerRepository $customers, BookingRepository $booking_repo) {
        $this->customers = $customers;
        $this->booking_repo = $booking_repo;        
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }
    public function index()
    {
        $currentCompany = Auth::user()->current_company()->first();
        $data =  WebsiteIntegration::where('business_id', $currentCompany->id)->first();
        $color1 = @$data->log_textcolor??'#ea1515'; 
        $color2 = @$data->log_bg_color??'#ea1515'; 
        $color3 = @$data->reg_textcolor??'#fff'; 
        $color4 = @$data->reg_bg_color??'#ea1515'; 
        $color8 = @$data->reg_back_color??'#fff';
        $color5 = @$data->primary_color??'#fff'; 
        $color6 = @$data->secondary_color??'#ea1515'; 
        $color9 = @$data->schedule_back_color??'#fff';
        $color10 = @$data->schedule_label??'#fff';
        $color11=@$data->schedule_label_color??'#fff';
        $color12=@$data->date_color??'#ea1515';
        // dd($color6);
        // $logoUrl = $data ? Storage::disk('s3')->url($data->logo) : null;
        $logoUrl = ($data && !empty($data->logo)) ? Storage::disk('s3')->url($data->logo) : null;
        $selectedState=@$data->default_state;
        $company_code = $currentCompany->unique_code;
        $selectLink = '';    
        $login_sub = 'https://host.fitnessity.co/login/' . $company_code;
        $register_sub = 'https://host.fitnessity.co/register/' . $company_code;
        $schedule_sub = 'https://host.fitnessity.co/schedule/' . $company_code;
        
        $login = '<div id="your-login-widget-container" data-unique-code="' . $company_code . '"></div>';
        $register='<div id="your-register-widget-container" data-unique-code="' . $company_code . '"></div>';
        $schedule='<div id="your-schedule-widget-container" data-unique-code="' . $company_code . '"></div>';
        return view('business.website_integration.index',compact('data','color1','color2','logoUrl','color3','color4','color5','color6','color8','color9','color10','color11','color12','selectedState','login','register','selectLink','schedule','login_sub','register_sub','schedule_sub'));
    }


    public function update(Request $request)
    {
        // dd($request->all());
        // \DB::enableQueryLog();

        $currentCompany = Auth::user()->current_company()->first();        
        $data = WebsiteIntegration::where('business_id', $request->business_id)->first();
        $input = [];
        if ($request->has('checkin')) {
            $base64File = $request->input('checkin');
            $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64File));
            $filename = 'checkin-settings/' . Str::uuid()->toString() . '.jpg';
            Storage::disk('s3')->put($filename, $fileData);
            $input['background_img'] = $filename;
        } else {
            $input['background_img'] = $data ? $data->background_img : '';
        }
        if ($request->hasFile('logo')) {
            $input['logo'] = $request->file('logo')->store('checkin-settings', 's3');
        }
        $input['user_id'] = auth()->user()->id;
        $input['business_id'] = $currentCompany->id;
        $input['log_textcolor'] = $request->input('text_color');
        $input['log_bg_color'] = $request->input('background_color');
        
        if ($data) {
            $data->update($input);
            // dd($data);
        } else {
            WebsiteIntegration::create($input);
        }
        // dd(\DB::getQueryLog()); 
        session()->flash('message', 'login');
        return redirect()->back();
    }
    public function deleteImage(Request $request)
    {
        // dd($request->all());
        $image = WebsiteIntegration::find($request->id);    
        if ($image && $image->background_img) {
            if (Storage::disk('s3')->exists($image->background_img)) {
                Storage::disk('s3')->delete($image->background_img); // Delete the file from S3
            }            
            $image->delete();
            return response()->json(['success' => true]);
        }
    
        return response()->json(['success' => false], 404);
    }
    
    public function update_register(Request $request)
    {
        // dd($request->all());
        $currentCompany = Auth::user()->current_company()->first();        
        $data = WebsiteIntegration::where('business_id', $request->business_id)->first();
        $input['user_id'] = auth()->user()->id;
        $input['business_id'] = $currentCompany->id;
        $input['reg_textcolor'] = $request->input('reg_text_color');
        $input['reg_bg_color'] = $request->input('reg_bg_color');
        $input['default_country'] = $request->input('country');
        $input['default_state'] = $request->input('state');        
        $input['reg_back_color'] = $request->input('backreg_color');        
        if ($data) {
            $data->update($input);
        } else {
            WebsiteIntegration::create($input);
        }
        session()->flash('message', 'register');

        return redirect()->back();
    }


    public function update_bookingschedule(Request $request)
    {
        // dd($request->all());
        // \DB::enableQueryLog();
        $currentCompany = Auth::user()->current_company()->first();        
        $data = WebsiteIntegration::where('business_id', $request->business_id)->first();
        $input['user_id'] = auth()->user()->id;
        $input['business_id'] = $currentCompany->id;
        $input['primary_color'] = $request->input('primary_color');
        $input['secondary_color'] = $request->input('secondary_color');
        $input['font'] = $request->input('font');
        $input['button_text'] = $request->input('button_text');        
        $input['button_style'] = $request->input('style');        
        $input['filters'] = $request->input('filter');        
        $input['schedule_back_color'] = $request->input('backcolor'); 
        $input['schedule_label']=$request->input('label_color');  
        $input['schedule_label_color']=$request->input('label_text_color');  
        $input['date_color']=$request->input('date_text_color');  

        if ($data) {
            $data->update($input);
        } else {
            WebsiteIntegration::create($input);
        }
        // dd(\DB::getQueryLog());
        session()->flash('message', 'booking');

        return redirect()->back();
    }


    public function Loginindex()
    {
        // dd('22');
        $userId = auth()->id();
        $code = CompanyInformation::where('user_id', $userId)->first();
        return view('business.website_integration.login', compact('code'));
    }
    
    public function Loginuser($unique_code)
    {
        $code=$unique_code;
        $code = CompanyInformation::where('unique_code', $code)->first();
        $companyinfo=WebsiteIntegration::where('user_id',$code->user_id)->first();
        // dd($code);
        return view('business.website_integration.userlogin',compact('companyinfo','code'));



    }
    public function Loginuserbook($unique_code)
    {
        $code=$unique_code;
        // // dd($code);
        $code = CompanyInformation::where('unique_code', $code)->first();
        $companyinfo=WebsiteIntegration::where('user_id',$code->user_id)->first();
       
    
        return view('business.website_integration.login',compact('companyinfo','code'));
    }

  

    // public function UserLogin(Request $request)
    // {
    //     // dd($request->all());
    //     $webdata=WebsiteIntegration::where('id',$request->company_info)->first();
    //     $customer=Customer::where('business_id',$webdata->business_id)->where('email',$request->email)->first();
    //     // $bookingid=$request->bookingid;
    //     $BusinessActivityScheduler=BusinessActivityScheduler::where('id',$request->bookingid)->first();
    //     if($BusinessActivityScheduler)
    //     {
    //         // dd($BusinessActivityScheduler);
    //         $business_services=BusinessServices::where('id',$BusinessActivityScheduler->serviceid)->first();
    //         // dd($business_services);
    //         if($business_services){
    //             $status=1;
    //         }
    //         else{
    //             $status=0;
    //         }
    //     }
    //     else{
    //         $status=0;
    //     }
    //     // dd($BusinessActivityScheduler);
    //     // dd($customer);
    //     if(!$customer)
    //     {
    //         return response()->json([
    //             'type' => 'register',
    //             'msg' => 'you are not registered with this business please register now.',
    //         ]);
    //     }
    //     $postArr = $request->input();
    //     $rules = [
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ];

    //     $validator = Validator::make($postArr, $rules);

    //     if ($validator->fails()) {
    //         $errMsg = [];
    //         foreach ($validator->messages()->getMessages() as $messages) {
    //             $errMsg[] = $messages;
    //         }
    //         return response()->json([
    //             'type' => 'danger',
    //             'msg' => $errMsg,
    //         ]);
    //     } else {
    //         $currentDate = Carbon::now();
    //         $resultDate = $currentDate->subYears(18)->format('Y-m-d');

    //         if (Auth::attempt([
    //             'email' => $postArr['email'],
    //             'password' => $postArr['password'],
    //             'activated' => 1,
    //             'primary_account' => 1
    //         ])) {
    //             $user = Auth::user();
    //             $userBirthdate = Carbon::parse($user->birthdate);
    //             $resultDate = Carbon::parse($resultDate);

    //             if ($userBirthdate <= $resultDate) {
    //                 try {
    //                     if (!$token = JWTAuth::fromUser($user)) {
    //                         return response()->json(['type' => 'danger', 'msg' => 'Could not create token.'], 500);
    //                     }
    //                 } catch (JWTException $e) {
    //                     return response()->json(['type' => 'danger', 'msg' => 'Could not create token.'], 500);
    //                 }

    //                 User::whereId($user->id)->update([
    //                     'last_login' => now(),
    //                     'last_ip' => $request->ip()
    //                 ]);

    //                 $claim = 'not set';
    //                 $claim_cid = $claim_status = $claim_cname = $claim_welcome = $checkoutsession  = $schedule = $onboard = '';

    //                 if (session()->has('claim_business_page')) {
    //                     $claim = 'set';
    //                     $claim_cid = session()->get('claim_cid');
    //                     $data = CompanyInformation::where('id', $claim_cid)->first();

    //                     if ($data != '') {
    //                         $claim_cname = $data->company_name;
    //                     }
    //                     $claim_status = session()->get('claim_status');
    //                 }

    //                 if (session()->has('business_welcome')) {
    //                     $claim_welcome = session()->get('business_welcome');
    //                 }
    //                 if (session()->has('checkoutsession')) {
    //                     $checkoutsession = session()->get('checkoutsession');
    //                 }

    //                 if (session()->has('schedule')) {
    //                     $schedule = session()->get('schedule');
    //                 }

    //                 if (session()->has('redirectToOnboard')) {
    //                     $onboard = session()->get('redirectToOnboard');
    //                 }

    //                 if ($onboard != '') {
    //                     return redirect($onboard);
    //                 }

    //                 if ($request->redirect) {
    //                     return redirect($request->redirect);
    //                 }

    //                 if ($claim == 'set') {
    //                     return redirect('/claim/reminder/' . $claim_cname . "/" . $claim_cid);
    //                 } elseif ($checkoutsession != '') {
    //                     return redirect('/carts');
    //                 } elseif ($schedule != '') {
    //                     return redirect('/business_activity_schedulers/' . $schedule);
    //                 } else {
    //                     return response()->json([
    //                         'type' => 'success',
    //                         'msg' => 'Login successful.',
    //                         'membership'=>$status,
    //                         'token' => $token, 
    //                     ]);
    //                 }
    //             } else {
    //                 Auth::logout();
    //                 return response()->json([
    //                     'type' => 'not_exists',
    //                     'msg' => 'Only Above 18 is allowed to Login.',
    //                 ]);
    //             }
    //         } else {
    //             return response()->json([
    //                 'type' => 'not_exists',
    //                 'msg' => 'User details not verified in our database.',
    //             ]);
    //         }
    //     }
    // }

    public function UserLogin(Request $request)
    {
        // Validate incoming request
        $postArr = $request->only('email', 'password', 'company_info');
        // dd($request->all());
        
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
            // 'company_info' => 'required|exists:website_integrations,id',
        ];
        
        $validator = Validator::make($postArr, $rules);
        $business=request()->input('code');
        // dd($business);
        if ($validator->fails()) {
            return response()->json([
                'type' => 'danger',
                'msg' => $validator->errors()->all(),
            ], 400);
        }

        // Fetch the necessary business and customer details
        // $webdata = WebsiteIntegration::where('id', $request->company_info)->first();
        $customer = Customer::where('business_id', $business)->where('email', $request->email)->first();
        
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

        // Check if login attempt is valid
        if (!Auth::attempt(['email' => $postArr['email'], 'password' => $postArr['password'], 'activated' => 1, 'primary_account' => 1])) {
            return response()->json([
                'type' => 'not_exists',
                'msg' => 'User details not verified in our database.',
            ], 401);
        }

        $user = Auth::user();
        $currentDate = Carbon::now()->subYears(18)->format('Y-m-d');
        $userBirthdate = Carbon::parse($user->birthdate);

        if ($userBirthdate > $currentDate) {
            Auth::logout();
            return response()->json([
                'type' => 'not_exists',
                'msg' => 'Only users above 18 years old are allowed to log in.',
            ], 401);
        }

        // Generate JWT token
        try {
            $token = JWTAuth::fromUser($user);
        } catch (JWTException $e) {
            return response()->json([
                'type' => 'danger',
                'msg' => 'Could not create token.',
            ], 500);
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

        // Return the JWT token along with the login status
        return response()->json([
            // 'customer_enc'=>Crypt::encrypt($customer->id),
            // 'token_enc'=>Crypt::encrypt($token),
            'customer'=>$customer->id,
            'type' => 'success',
            'msg' => 'Login successful.',
            'membership' => $status,
            'token' => $token,  
        ], 200);
    }
    
    public function customerdashboard(Request $request)
    {
        // return 'test';
        // $tok=Crypt::decrypt($request->query('token'));
        // return $tok;
        $token = $request->query('token');
        $businessId = $request->query('code');    
        // dd($businessId);
        // dd($request->query('customer_id'));
        if (!$token) {
            return response()->json(['error' => 'Token is required'], 401);
        }
        $business = CompanyInformation::find($businessId);        
        try {
            $user = JWTAuth::setToken($token)->authenticate();
        } catch (\Exception $e) {
            return  'Error: ' . $e->getMessage();   
        }
        $companyinfo=WebsiteIntegration::where('business_id',$businessId)->first();
        // $businessId = $request->business_id ?? $user->cid;
        // dd($request->all());
        // dd($request->customer_id);
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
            $customer = Customer::where(['business_id'=>$businessId ?? auth()->user()->cid,'user_id'=>Auth::user()->id])->first();//updated
            $name = @$customer->full_name;
        }

            // dd();
        $attendanceCnt = BookingCheckinDetails::where('customer_id' ,@$customer->id)->whereMonth('checkin_date', '>=', date('m'))->whereMonth('checkin_date', '<=', date('m'))->whereNotNull('checked_at')->count();
        $attendanceCntPre = BookingCheckinDetails::where('customer_id' ,@$customer->id)->whereMonth('checkin_date', '>=', date('m') - 1)->whereMonth('checkin_date', '<=', date('m') - 1 )->whereNotNull('checked_at')->count();
        $attendancePct =  $attendanceCntPre != 0 ? number_format(($attendanceCnt - $attendanceCntPre)*100/$attendanceCntPre,2,'.','') : 0;
        // dd($business);
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
        // \DB::enableQueryLog(); 
        $classes = BookingCheckinDetails::where('customer_id' ,@$customer->id)->whereDate('checkin_date' , '>=' , date('Y-m-d'))->orderby('checkin_date','asc')->get()->filter(function ($bd){
            return $bd->booking_detail_id;
        });
        // dd(\DB::getQueryLog());

        // dd($classes);
        // dd(\DB::getQueryLog()); 
        // dd($user);
        return view('business.website_integration.customerdashboard',compact('customer','user','companyinfo','name','notesCnt','activeMembershipCnt','docCnt','docCntNew','announcemetCnt','attendanceCnt','announcemetCntNew','bookingCnt','bookingPct','classes','attendancePct','business','notesCntNew','activeMembershipCntNew','user'));
        // $html = view('business.website_integration.customerdashboard', compact(
        //     'customer', 'name', 'notesCnt', 'activeMembershipCnt', 'docCnt', 'docCntNew', 
        //     'announcemetCnt', 'attendanceCnt', 'announcemetCntNew', 'bookingCnt', 
        //     'bookingPct', 'classes', 'attendancePct', 'business', 'notesCntNew', 'activeMembershipCntNew', 'user'
        // ))->render();
    
        // Return the HTML data in a JSON response
        // return response()->json(['html' => $html]);

    }

    public function registerindex(Request $request,$unique_code)
    {
        // dd($unique_code);
        $code = CompanyInformation::where('unique_code', $unique_code)->first();
        $companyinfo=WebsiteIntegration::where('user_id',$code->user_id)->first();
        // $companyinfo=WebsiteIntegration::where('user_id',$code->user_id)->first();
        $businessTerms = BusinessTerms::where('cid',$code->id)->first();

        $business_id=$code->id;
        $intent = $clientSecret = null;
            $success = 0; $successMsg = '';
            if(!$request->customer_id){
                if (session()->has('success-register')) { $success = session('success-register'); }
                if (session()->has('auto_generate_msg')) { $successMsg = session('auto_generate_msg'); }
                session()->forget('success-register'); session()->forget('auto_generate_msg');
            }
            $businessTerms = BusinessTerms::where('cid',$business_id)->first();
            if($request->customer_id){
                $customer = Customer::find($request->customer_id);
                \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
                $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
                if($customer->stripe_customer_id != ''){
                    $intent = $stripe->setupIntents->create([
                        'payment_method_types' => ['card'],
                        'customer' => $customer->stripe_customer_id,
                    ]);
                    $clientSecret = $intent['client_secret'];
                } 
            }
        return view('business.website_integration.register',compact('clientSecret', 'business_id','success', 'businessTerms','successMsg','companyinfo','code','businessTerms'));
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
    public function postRegistrationCustomer(Request $request) {  
        set_time_limit(-1);
        $postArr = $request->all();
        // $user = Auth::user();
        // $company = $user->businesses->find(Auth::user()->cid);
        $comp=$request->company_info;
        $bussiness=$request->code;

        // dd($code);
        // dd($code);
        $companyinfo=WebsiteIntegration::where('id',$bussiness)->first();
        $code = CompanyInformation::where('id', $bussiness)->first();
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
            if (!$this->customers->findUniquefeildPerBusiness($code->id, 'email',$postArr['email'])) {
                $response = array(
                    'type' => 'danger',
                    'msg' => 'Email already exists. Please select different Email',
                );
                return Response::json($response);
            }; 
            if (!$this->customers->findUniquefeildPerBusiness($code->id, 'phone_number',$postArr['contact'])) {
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
                $customerObj->business_id = $code->id;
                $customerObj->fname = $postArr['firstname'];
                $customerObj->lname = $postArr['lastname'] ?? '';
                $customerObj->password = Hash::make($random_password);
                $customerObj->email = $postArr['email'];
                $customerObj->primary_account = $request->primaryAccountHolder ?? 0;
                $customerObj->status = 0;
                $customerObj->phone_number = $postArr['contact'];
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
                if($chkUser){
                    $checkInCode = generateUniqueCode();
                    $chkGenerate = 1;
                }
                // ends
                if($fitnessity_user){
                    $ids = $fitnessity_user->orders()->get()->map(function($item){
                        return $item->id;
                    });

                    $result = UserBookingDetail::whereIn('sport', function($query) use ($code){
                        $query->select('id')->from('business_services')->where('cid', $code->id);
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
                    $userObj->birthdate = isset($postArr['dob']) ? date('Y-m-d', strtotime($postArr['dob'])) : NULL;
                    $userObj->stripe_customer_id = $stripe_customer_id;
                    $userObj->unique_code = $checkInCode;
                    $userObj->cid=$code->id;
                    $userObj->save(); 
                    $customerObj->user_id = $userObj->id;
                }
                
                $customerObj->save();
                // dd($customerObj);
                    $user = User::find($customerObj->user_id);                
                    if ($user) {
                        $token = Auth::guard('api')->login($user);
                    } 
                // $token = Auth::login($customerObj->user);
                // dd($token);
                if ($customerObj) {    
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
                                $customerFamily->business_id = $code->id;
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
                                    SGMailService::sendWelcomeMailToCustomer($customerFamily->id,$code->id,'');
                                }

                                $is_user = User::where(['firstname'=> $request->fname[$i],'lastname'=> $request->lname[$i],'email' => $request->emailid[$i]])->first();

                                $checkInCodeF = $request->check_in_code[$i];
                                $chkUserF = User::where('unique_code' , $checkInCodeF)->where('email' , '!=' , $request->emailid[$i])->first();
                                $chkBusinessStaff = BusinessStaff::where('unique_code', $checkInCode)->first();//my code

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

                    $status = SGMailService::sendWelcomeMailToCustomer($customerObj->id,$code->id,$random_password); 
                    $response = array(
                        'id'=>$customerObj->id,
                        'type' => 'success',
                        'msg' => 'Registration done successfully.',
                        'token' => $token,
                        'bussiness_id'=>$bussiness,
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
            return view('business.website_integration.scheduler', compact('bookschedulers', 'filter_date', 'days', 'companyinfo', 'code'))->render();
        }

        // dd($bookschedulers);
        return view('business.website_integration.schedule', compact('bookschedulers', 'filter_date', 'request', 'days', 'companyinfo', 'code'));
    }


    
    public function data(Request $request)
    {
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
            return view('business.website_integration.scheduler', compact('bookschedulers', 'filter_date', 'days', 'companyinfo','code'))->render();
        }
        
        return view('business.website_integration.schedule', compact('bookschedulers', 'filter_date', 'request', 'days', 'companyinfo','code'));
    }
    
    public function getTerms(Request $request){
    	$termsDesc =BusinessTerms::where('id',$request->id)->pluck($request->termsType)->first();
    	$termsHeader = $request->termsHeader;
    	return view('business.website_integration.termsModel',compact('termsDesc','termsHeader'));
    }

    // public function logout($uniquecode)
    // {
    //     $forever = true;
    // JWTAuth::getToken(); 
    //     JWTAuth::invalidate($forever);    
    //     return redirect()->route('loginuser', ['uniquecode' => $uniquecode]);
    // }
    public function logout($uniquecode)
    {
        // $forever = true;
        // JWTAuth::getToken(); 
        // JWTAuth::invalidate($forever);    
        // dd('1');
        // $token=JWTAuth::getToken();
        // dd($token);
        return redirect()->route('loginuser', ['uniquecode' => $uniquecode]);
        
    }

    public function membership(Request $request)
    {

        // dd($request->all());
        // $companyinfo = $request->input('companyinfo');
        $users = $request->input('user');
        $companyId = $request->input('business_id');;
        // $user_Id=$companyinfo['user_id'];
        $user_Id=$users;
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
        return view('business.website_integration.membership', compact('companyId', 'services', 'customerId','users'))->render();
        // return view('business.website_integration', compact('companyId','services','customerId'));

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
        if($activityDate != ''){
        	$schedule = BusinessActivityScheduler::where('serviceid',$serviceId)->where('cid',$companyId)->where('starting','<=',date('Y-m-d',strtotime($activityDate)) )->where('end_activity_date','>=',  date('Y-m-d',strtotime($activityDate)) )->whereRaw('FIND_IN_SET("'.date('l',strtotime($activityDate)).'",activity_days)');
	    }
	    $schedulers = $schedule != '' ? $schedule->get() : [];
	    $firstSchedule = $schedule != '' ? $schedule->first() : '';
		// dd($service);
		if (!$service) {
			return response()->json(['message' => 'Service not found'], 200);
		}		
	   	$rawcategory = $service->BusinessPriceDetailsAges()->whereNotNull('class_type')->has('BusinessActivityScheduler')->orderBy('id', 'ASC');
        $categories = $firstSchedule != '' ? $rawcategory->where('visibility_to_public' , 1)->get() : [];
        $firstCategory = $firstSchedule != '' ?  $rawcategory->when($categoryId, function ($query) use ($categoryId) {
		    $query->where('id', $categoryId);
		})->where('visibility_to_public' , 1)->first() : '';
   		$categoryId = $categoryId ?? @$firstCategory->id;
   		if(@$firstCategory->class_type){
   			$prices = $firstCategory  != '' ? $firstCategory->bPriceDetails()->orderBy('id', 'ASC')->get() : []; 
   		}else{
        	$prices = $firstCategory  != '' ? $firstCategory->BusinessPriceDetails()->orderBy('id', 'ASC')->get() : []; 
   		}
        $addOnServices = $firstCategory  != '' ?  $firstCategory->AddOnService: [];
        // if (!$prices->isEmpty()) {
            // dd($prices);
            // if (!empty($prices)) {
                if (!empty($prices) && count($prices) > 0) {
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
        $page = 'business.website_integration.booking_html';
		// if(@$request->type == 'checkin_portal'){ $page = 'checkin.booking_html';}else{ $page = 'activity.activity_booking_html'; }
    	$html = View::make($page)->with(['activityDate' => $activityDate, 'service' => $service ,'serviceId' => $serviceId , 'companyId' => $companyId ,'users'=>$request->users ,'chk_found'=>$chkFound ,'categories' => $categories, 'priceOption' =>$priceOption,'bschedule' =>$bschedule , 'timeChk' => $timeChk ,'maxSports' =>  $maxSports , 'adultPrice' => $adult_price , 'childPrice' => $child_price, 'infantPrice' => $infant_price , 'addOnServices' =>$addOnServices ,'priceId' =>$priceId ,'bschedulefirst' => $bschedulefirst ,'date' =>$date,'categoryId' =>$categoryId ,'scheduleId' =>$scheduleId , 'paySession' => $paySession ,'adultDiscountPrice' => $adultDiscountPrice,'childDiscountPrice' => $childDiscountPrice,'infantDiscountPrice' => $infantDiscountPrice])->render();
 		return response()->json(['html' => $html ,'date'=>$formattedDate]);
    }
    public function getParticipateData(Request $request){
    	$cusId = $request->cus_id ?? '';
    	$family = getFamilyMember($cusId,$request->cid);
    	$priceid = $request->priceid;  $type = $request->type; 
    	$customer = ( $cusId ) ? Customer::find($cusId) : '';
		return view('business.website_integration.participate_data' ,compact('priceid','type','family','customer'));
    }
    // public function form_participate(Request $request){
    //     $cart_item = [];
    //     // if ($request->session()->has('cart_item')) {
    //     //     $cart_item = $request->session()->get('cart_item');
    //     // }
    //     if(in_array($request->act, array_keys($cart_item["cart_item"]))) {
    //         foreach($cart_item["cart_item"] as $k => $v) {
    //             if($request->act == $k) {
    //                 if($request->type == 'user'){
    //                     $cart_item["cart_item"][$k]["participate"][$request->counter]['id'] = Auth::user()->id;
    //                     $cart_item["cart_item"][$k]["participate"][$request->counter]['from'] = 'user';
    //                 }else if($request->type == 'family'){
    //                     $cart_item["cart_item"][$k]["participate"][$request->counter]['id'] = $request->familyid;
    //                     $cart_item["cart_item"][$k]["participate"][$request->counter]['from'] = 'family';
    //                 }else{
    //                     $cart_item["cart_item"][$k]["participate"][$request->counter]['id'] = $request->familyid;
    //                     $cart_item["cart_item"][$k]["participate"][$request->counter]['from'] = 'customer';
    //                 }
    //             }
    //         }
    //     }
    //     // $request->session()->put('cart_item', $cart_item);
    //     dd($cart_item);
    // }
    public function form_participate(Request $request)
    {
        $cart_item = $request->input('cart_item', []);
        if (isset($cart_item['cart_item'][$request->act])) {
            foreach ($cart_item['cart_item'] as $k => $v) {
                if ($request->act == $k) {
                    if ($request->type == 'user') {
                        $cart_item['cart_item'][$k]['participate'][$request->counter]['id'] = Auth::user()->id;
                        $cart_item['cart_item'][$k]['participate'][$request->counter]['from'] = 'user';
                    } elseif ($request->type == 'family') {
                        $cart_item['cart_item'][$k]['participate'][$request->counter]['id'] = $request->familyid;
                        $cart_item['cart_item'][$k]['participate'][$request->counter]['from'] = 'family';
                    } else {
                        $cart_item['cart_item'][$k]['participate'][$request->counter]['id'] = $request->familyid;
                        $cart_item['cart_item'][$k]['participate'][$request->counter]['from'] = 'customer';
                    }
                }
            }
        }

        // Return the updated cart_item
        return response()->json([
            'success' => true,
            'cart_item' => $cart_item
        ]);
    }


  

    // public function addToCart(Request $request) {
    //     // Initialize variables
    //     $cart_item = [];
    //     $tax = $request->value_tax ?? 0;
    //     $tip_amt_val = $request->tip_amt_val ?? 0;
    //     $dis_amt_val = $request->dis_amt_val ?? 0;
    //     $parti_from_chkout_regi = $request->pc_value ? ['id' => $request->pc_regi_id, 'from' => $request->pc_user_tp, 'pc_name' => $request->pc_value] : [];
    //     $categoryid = $request->categoryid ?? '';
    //     $p_session = $request->pay_session ?? '';
    //     $activity_days = $request->activity_days ?? '';
    //     $notes = $request->notes ?? '';
    //     $repeateTimeType = $request->repeateTimeType ?? '';
    //     $everyWeeks = $request->everyWeeks ?? 0;
    //     $monthDays = $request->monthDays ?? 0;
    //     $enddate = $request->enddate ? date('Y-m-d', strtotime($request->enddate)) : '';
    //     $addOnServicesId = $request->addOnServicesId ?? '';
    //     $addOnServicesQty = $request->addOnServicesQty ?? '';
    //     $addOnServicesTotalPrice = $request->addOnServicesTotalPrice ?? 0;
    //     $pid = $request->pid ?? 0;
    //     $priceid = $request->priceid ?? 0;
    //     $chk = $msg = '';
    
    //     // Check for cart item related conditions
    //     if ($request->has('chk')) {
    //         $chk = $request->chk;
    //         // Remove item if necessary
    //         if ($request->deletepid != $request->pid) {
    //             unset($cart_item["cart_item"][$request->deletepid]);
    //         }
    //         if ($chk == 'calendar_activity_purchase') {
    //             foreach ($cart_item["cart_item"] ?? [] as $proId => $ci) {
    //                 if ($ci['chk'] == 'calendar_activity_purchase') {
    //                     unset($cart_item["cart_item"][$proId]);
    //                 }
    //             }
    //         }
    //     }
    
    //     $price = $request->price ?? 0;
    //     $pricetotal = $request->pricetotal ?? 0;
    //     $actscheduleid = $request->actscheduleid ?? 0;
    //     $sesdate = $request->sesdate ? date('Y-m-d', strtotime($request->sesdate)) : 0;
    
    //     // Fetch business service information
    //     $result = DB::select('SELECT * FROM business_services WHERE id = ?', [$pid]);
    
    //     // Handle participant details and quantities
    //     $infantarray = $childarray = $adultarray = $totparticipate = [];
    //     $tot_qty = 0;
    //     if ($request->aduquantity != 0) {
    //         $adultarray = ['quantity' => $request->aduquantity, 'price' => $request->cartaduprice];
    //         $tot_qty += $request->aduquantity;
    //     }
    //     if ($request->childquantity != 0) {
    //         $childarray = ['quantity' => $request->childquantity, 'price' => $request->cartchildprice];
    //         $tot_qty += $request->childquantity;
    //     }
    //     if ($request->infantquantity != 0) {
    //         $infantarray = ['quantity' => $request->infantquantity, 'price' => $request->cartinfantprice];
    //         $tot_qty += $request->infantquantity;
    //     }
    
    //     // Add participants to the cart item
    //     if (isset($request->participateAry)) {
    //         $totparticipate = $request->participateAry;
    //     } else {
    //         for ($i = 0; $i < $tot_qty; $i++) {
    //             $totparticipate[] = ['id' => Auth::check() ? Auth::user()->id : '', 'from' => "user"];
    //         }
    //     }
    //     // dd($request->all());
    //     // Process the result and build the cart item array
    //     if (count($result) > 0) {
    //         foreach ($result as $item) {
    //             $pictures = explode(',', $item->profile_pic);
    //             $p_image = $pictures[0] ?? '';
    //             $itemArray = [
    //                 $request->priceid => [
    //                     'type' => $item->service_type,
    //                     'name' => $item->program_name,
    //                     'code' => $item->id,
    //                     'image' => $p_image,
    //                     'adult' => $adultarray,
    //                     'child' => $childarray,
    //                     'infant' => $infantarray,
    //                     'actscheduleid' => $actscheduleid,
    //                     'sesdate' => $sesdate,
    //                     'totalprice' => $request->pricetotal,
    //                     'priceid' => $priceid,
    //                     'participate' => $totparticipate,
    //                     'tax' => $tax,
    //                     'discount' => $dis_amt_val,
    //                     'tip' => $tip_amt_val,
    //                     'participate_from_checkout_regi' => $parti_from_chkout_regi,
    //                     'chk' => $chk,
    //                     'categoryid' => $categoryid,
    //                     'p_session' => $p_session,
    //                     'notes' => $notes,
    //                     'repeateTimeType' => $repeateTimeType,
    //                     'everyWeeks' => $everyWeeks,
    //                     'monthDays' => $monthDays,
    //                     'enddate' => $enddate,
    //                     'activity_days' => $activity_days,
    //                     'addOnServicesId' => $addOnServicesId,
    //                     'addOnServicesQty' => $addOnServicesQty,
    //                     'addOnServicesTotalPrice' => $addOnServicesTotalPrice,
    //                 ]
    //             ];
    
    //             // Merge cart items
    //             $cart_item["cart_item"] = $cart_item["cart_item"] ?? [];
    //             $cart_item["cart_item"] = array_merge($cart_item["cart_item"], $itemArray);
    //         }
    //     }

    //     // dd($cart_item);
    //     // Handle redirections or return values based on `chk`
    //     if ($request->chk == 'activity_purchase') {
    //         return redirect()->route('business.orders.create', ['business_id' => Auth::user()->cid, 'cus_id' => $request->pageid]);
    //     } elseif ($request->chk == 'calendar_activity_purchase') {
    //         return config('app.url') . '/business/' . Auth::user()->cid . '/paymentModal/' . $request->pageid;
    //     } elseif ($request->chk == 'checkin') {
    //         return 'Membership added successfully.';
    //     } else {
    //         return $msg ?: config('app.url') . '/success-cart/' . $priceid;
    //     }
    // }
    
    // public function addToCart(Request $request) {
    //     if(@$request->flushsession == 1){ $request->session()->forget('cart_item'); }
    //     $cartService  = new CartWidgetService();
    //     $cartitem = $cartService ->items();
    //     $cart_item=$cartitem??[];
    //     // dd($request->all());
    //     $tax = $request->has('value_tax') != '' ? $request->value_tax : 0;
    //     $tip_amt_val = $request->has('tip_amt_val') != '' ? $request->tip_amt_val : 0;
    //     $dis_amt_val = $request->has('dis_amt_val') != '' ? $request->dis_amt_val : 0;
    //     $parti_from_chkout_regi = $request->has('pc_value') != '' ? array('id'=>$request->pc_regi_id, 'from'=>$request->pc_user_tp, 'pc_name'=>$request->pc_value) : array();
    //     $categoryid = $request->has('categoryid') != '' ? $request->categoryid : '';
    //     $p_session = $request->has('pay_session') != '' ? $request->pay_session : '';
    //     $activity_days = $request->has('activity_days') != '' ? $request->activity_days : '';
    //     $notes = $request->has('notes') != '' ? $request->notes : '';
    //     $repeateTimeType = $request->has('repeateTimeType') != '' ? $request->repeateTimeType : '';
    //     $everyWeeks = $request->has('everyWeeks') != '' ? $request->everyWeeks : 0;
    //     $monthDays = $request->has('monthDays') != '' ? $request->monthDays : 0;
    //     $enddate = $request->has('enddate') != '' ? date('Y-m-d',strtotime($request->enddate)): '';
    //     $addOnServicesId = $request->has('addOnServicesId') != '' ? $request->addOnServicesId: '';
    //     $addOnServicesQty = $request->has('addOnServicesQty') != '' ? $request->addOnServicesQty: '';
    //     $addOnServicesTotalPrice = $request->has('addOnServicesTotalPrice') != '' ? $request->addOnServicesTotalPrice: 0 ;
    //     $pid = isset($request->pid) ? $request->pid : 0;
    //     $priceid = isset($request->priceid) ? $request->priceid : 0;
    //     $chk = $msg = '';
    //     if($request->has('chk')){
    //         if($request->deletepid != $request->pid){ unset($cart_item["cart_item"][$request->deletepid]); } 
    //         $chk = $request->chk;
    //         if($chk == 'calendar_activity_purchase'){
    //             if(!empty($cart_item)){
    //                 foreach($cart_item["cart_item"] as $proId=>$ci){
    //                     if( $ci['chk'] == 'calendar_activity_purchase'){ unset($cart_item["cart_item"][$proId]); }
    //                 }
    //             }
    //         }
    //     }
    //     $price = isset($request->price) ? $request->price : 0;
    //     $pricetotal = isset($request->pricetotal) ? $request->pricetotal : 0;
    //     $actscheduleid = isset($request->actscheduleid) ? $request->actscheduleid : 0;
    //     $sesdate = isset($request->sesdate) ? date('Y-m-d',strtotime($request->sesdate)) : 0;
    //     $result = DB::select('select * from business_services where id = "'.$pid.'"');
    //     $infantarray = $childarray = $adultarray= $totparticipate = []; $tot_qty = 0;
    //     if($request->aduquantity != 0){
    //         $adultarray = array('quantity'=>$request->aduquantity, 'price'=>$request->cartaduprice); $tot_qty += $request->aduquantity;
    //     }
    //     if($request->childquantity != 0){
    //         $childarray = array('quantity'=>$request->childquantity, 'price'=>$request->cartchildprice);$tot_qty += $request->childquantity;
    //     }
    //     if($request->infantquantity != 0){
    //         $infantarray = array('quantity'=>$request->infantquantity, 'price'=>$request->cartinfantprice); $tot_qty += $request->infantquantity;
    //     }
    //     if(isset($request->participateAry)){ $totparticipate = $request->participateAry;
    //     }else{
    //         for ($i=0; $i < $tot_qty; $i++) { 
    //             if(Auth::check()){$totparticipate[] = array('id'=>Auth::user()->id, 'from'=>"user");}
    //             else{ $totparticipate[] = array('id'=>'', 'from'=>"user"); } 
    //         }
    //     }
    //     if (count($result) > 0) {
    //         foreach ($result as $item) {
    //             $pictures = explode(',',$item->profile_pic);
    //             $p_image = @$pictures[0];
    //             $itemArray = array($request->priceid=>array('type'=>$item->service_type, 'name'=>$item->program_name, 'code'=>$item->id, 'image'=> $p_image,'adult'=>$adultarray,'child'=>$childarray,'infant'=>$infantarray,'actscheduleid'=>$actscheduleid, 'sesdate'=>$sesdate,'totalprice'=>$request->pricetotal,'priceid'=>$priceid,'participate'=>$totparticipate,'tax'=>$tax,'discount'=>$dis_amt_val ,'tip'=>$tip_amt_val ,'participate_from_checkout_regi'=> $parti_from_chkout_regi,'chk'=>$chk ,'categoryid'=>$categoryid ,'p_session'=>$p_session,'notes' => $notes,'repeateTimeType' => $repeateTimeType,'everyWeeks' => $everyWeeks,'monthDays' => $monthDays,'enddate' => $enddate,'activity_days'=>$activity_days ,'addOnServicesId'=> $addOnServicesId, 'addOnServicesQty' => $addOnServicesQty, 'addOnServicesTotalPrice' => $addOnServicesTotalPrice));
    //             if(!empty($cart_item["cart_item"])) {
    //                 if(in_array($request->priceid, array_keys($cart_item["cart_item"]))) {
    //                     foreach($cart_item["cart_item"] as $k => $v) {
    //                         if($request->priceid == $k) {
    //                             $cart_item["cart_item"][$k]["actscheduleid"] = $actscheduleid; $cart_item["cart_item"][$k]["tip"] = $tip_amt_val;
    //                             $cart_item["cart_item"][$k]["discount"] = $dis_amt_val; $cart_item["cart_item"][$k]["tax"] = $tax;
    //                             $cart_item["cart_item"][$k]["categoryid"] = $categoryid;
    //                             $cart_item["cart_item"][$k]["p_session"] = $p_session;
    //                             $cart_item["cart_item"][$k]["chk"] = $chk ; $cart_item["cart_item"][$k]["notes"] = $notes;
    //                             $cart_item["cart_item"][$k]["repeateTimeType"] = $repeateTimeType;
    //                             $cart_item["cart_item"][$k]["everyWeeks"] = $everyWeeks; $cart_item["cart_item"][$k]["monthDays"] = $monthDays;
    //                             $cart_item["cart_item"][$k]["enddate"] = $enddate; $cart_item["cart_item"][$k]["activity_days"] = $activity_days;
    //                             $cart_item["cart_item"][$k]["participate_from_checkout_regi"] = $parti_from_chkout_regi ;
    //                             $cart_item["cart_item"][$k]["sesdate"] = $sesdate; $cart_item["cart_item"][$k]["totalprice"] = $request->pricetotal;
    //                             $cart_item["cart_item"][$k]["priceid"] = $request->priceid;
    //                             $cart_item["cart_item"][$k]['adult']["price"] = $request->cartaduprice;
    //                             $cart_item["cart_item"][$k]['child']["price"] = $request->cartchildprice;
    //                             $cart_item["cart_item"][$k]['infant']["price"] = $request->cartinfantprice;
    //                             $cart_item["cart_item"][$k]["participate"] = $totparticipate; $cart_item["cart_item"][$k]['adult']["quantity"] = $request->aduquantity;
    //                             $cart_item["cart_item"][$k]['child']["quantity"] = $request->childquantity;
    //                             $cart_item["cart_item"][$k]['infant']["quantity"] = $request->infantquantity;
    //                             $cart_item["cart_item"][$k]["addOnServicesId"] = $addOnServicesId; $cart_item["cart_item"][$k]["addOnServicesQty"] = $addOnServicesQty;
    //                             $cart_item["cart_item"][$k]["addOnServicesTotalPrice"] = $addOnServicesTotalPrice;
    //                         }
    //                     }
    //                 }else {
    //                     $tot_qty_cart = 0; $final_qty_cart = 0; $remaing  = 0; $chk_item = 0;
    //                     foreach($cart_item["cart_item"] as $k => $v){
    //                         if($cart_item["cart_item"][$k]["chk"] == ''){
    //                             if($cart_item["cart_item"][$k]["actscheduleid"] == $actscheduleid &&  $cart_item["cart_item"][$k]["sesdate"] == $sesdate){
    //                                 $chk_item =1;
    //                                 if(!empty($cart_item["cart_item"][$k]['adult'])){ $tot_qty_cart += $cart_item["cart_item"][$k]['adult']["quantity"]; }
    //                                 if(!empty($cart_item["cart_item"][$k]['child'])){ $tot_qty_cart += $cart_item["cart_item"][$k]['child']["quantity"]; }
    //                                 if(!empty($cart_item["cart_item"][$k]['infant'])){ $tot_qty_cart += $cart_item["cart_item"][$k]['infant']["quantity"]; }
    //                                 $db_totalquantity = $this->bookings->gettotalbooking($actscheduleid,$sesdate);
    //                                 $bookscheduler = BusinessActivityScheduler::where('id', $actscheduleid)->first();
    //                                 if($bookscheduler!= ''){ $remaing = ($bookscheduler->spots_available - $db_totalquantity ); }
    //                             }
    //                         }
    //                     }
    //                     if($chk_item == 1){
    //                         $final_qty_cart = ($tot_qty +  $tot_qty_cart);
    //                         if($remaing >= $final_qty_cart){
    //                             $cart_item["cart_item"] = $cart_item["cart_item"] + $itemArray;
    //                         }else{
    //                             $msg = "no_spots";
    //                         }
    //                     }else {
    //                         $cart_item["cart_item"] = $cart_item["cart_item"] + $itemArray;
    //                     }
    //                 }
    //             }else {
    //                 $cart_item["cart_item"] = $itemArray;
    //             }
    //         }
    //     }
    //     if (isset($cart_item)) { 
            
    //         $cartService->updateCartItem($cart_item);
    //         $updatedCartItems = $cartService->updatedCartitems();
    //         // $request->session()->put('cart_item', $cart_item); 
    //     }
    //     else { $request->session()->forget('cart_item');}
    //     if($request->chk == 'activity_purchase')
    //     {
    //         return redirect()->route('business.orders.create', ['business_id'=>Auth::user()->cid,'cus_id' => $request->pageid]);
    //     }else if($request->chk == 'calendar_activity_purchase'){
    //         return config('app.url').'/business/'.Auth::user()->cid.'/paymentModal/'.$request->pageid;;
    //     }else if($request->chk == 'checkin'){
    //        return 'Membership added successfully.';
    //     }else{
    //         if($msg == ''){
    //             //  $msg = config('app.url').'/success-cart/'.$priceid; 
    //             $msg = route('successcart', ['priceid' => $priceid]);    
    //     }
    //       return $msg;
    //     }    
    // }

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
                $msg = route('successcart', ['priceid' => $priceid]);
            }
            return $msg;
        }
    }



    
    public function getBookingSummary(Request $request){
		$participantIds = explode(',', $request->participants);
		$participants = Customer::whereIn('id', $participantIds)->get();
    	$childCount  = $request->childCount; $infantCount = $request->infantCount;
    	$adultCount = $request->adultCount; $aosPrice = $request->aosPrice; $aosId = $request->aosId; $aosQty = $request->aosQty;
    	$price = BusinessPriceDetails::find($request->priceId);
    	$scheduler = BusinessActivityScheduler::find($request->schedule);
    	$category = BusinessPriceDetailsAges::find(@$scheduler->category_id);
    	$adult_price =  $price != '' ? ($price->getCurrentPrice('adult',$request->date)  * $adultCount)  : 0;
        $child_price =  $price != '' ? ($price->getCurrentPrice('child',$request->date) * $childCount) : 0;  
        $infant_price = $price != '' ? ($price->getCurrentPrice('infant',$request->date) * $infantCount)  : 0;   
        $adultDiscount = $price != '' ? ( $price->getDiscoutPrice('adult',$request->date) * $adultCount ) : 0;  
        $childDiscount = $price != '' ? ( $price->getDiscoutPrice('child',$request->date)  * $childCount ) : 0;  
        $infantDiscount = $price != '' ? ( $price->getDiscoutPrice('infant',$request->date) * $infantCount)  : 0;  
        $total = $childDiscount + $adultDiscount + $infantDiscount + $aosPrice;
        //    dd($participants);
    	return view('business.website_integration.bookingModal',compact('participants','price','scheduler','adultCount','childCount' , 'infantCount' ,'category' , 'childDiscount','adultDiscount','infantDiscount' ,'adult_price','child_price','infant_price','total','aosId','aosQty'));
    }
  
    public function getMembershipPayment(Request $request){
        // dd($request->all());
        // Fetch the cart data directly as an array
        $cart = $request->input('cart_items'); // Now expecting cart_items as an array
        $users=$request->users;
        $customer_id= $request->customer_id;
        $customer = Customer::where('id', $customer_id)->first(); // Use first() to get a single instance
        if ($customer) {
            $businessId = $customer->business_id; 
            // dd($businessId);
        }
        $cartWidgetIds = $request->cartWidgetIds;
        if (is_array($cart) && isset($cart['selectedOptions'])) {
            $item = $cart['selectedOptions'][0]; // Example of accessing first selected participant
    
            // Fetch pricing details for the selected service
            $serprice = BusinessPriceDetails::where('id', $cart['priceid'])->first();
    
            // Initialize variables
            $cartCount = 1; $totalquantity =  $discount = 0;
    
            // Calculate quantities and discounts for different participant types
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
    
            // Calculate item price, service fee, tax, and total amount
            $item_price = $request->totalPrice;
            $fees = BusinessSubscriptionPlan::where('id', 1)->first(); // Fetch service fees
    
            $service_fee = ($item_price * $fees->service_fee) / 100;
            $tax = ($item_price * $fees->site_tax) / 100;
            $total_amount = number_format(($item_price + $service_fee + $tax - $discount), 2, '.', '');
            $subTotal = ($discount) ? number_format($item_price - $discount, 2) : number_format($item_price, 2);
            $taxDisplay = number_format(($tax + $service_fee), 2);
    
            // Create a Stripe setup intent for future payments
            $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
            $customer = Customer::find($request->customer_id);
            $customer->create_stripe_customer_id(); // Ensure the customer has a Stripe ID
            $intent = $stripe->setupIntents->create([
                'customer' => @$customer->stripe_customer_id,
                'payment_method_types' => ['card'],
            ]);
    
            // Get existing payment methods for the customer
            // $cardInfo = $customer->stripePaymentMethods()->get();
            // dd($users);
    	    $cardInfo = StripePaymentMethod::where('user_type', 'User')->where('user_id', $users)->get();

            // Pass the necessary data to the view
            // return view('checkin.membership_payment', compact(
            //     'intent', 'cardInfo', 'totalquantity', 'discount', 'taxDisplay', 'total_amount', 'subTotal'
            // ));
            // dd($subTotal);
            return view('business.website_integration.membership_payment', compact('intent','cardInfo', 'cartWidgetIds','cartCount' ,'discount' ,'taxDisplay' ,'users','total_amount' ,'subTotal','customer_id','businessId'));

        }
    
        return redirect()->back()->withErrors('Cart data is invalid');
    }

    public function memberhsipPay(Request $request){
        $cartWidgetIds = json_decode($request->input('cartWidgetIds'), true);
        // dd($cartWidgetIds);
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
            // dd($stripe);
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
                    // dd($transactionstatus);
                }
            }catch(\Stripe\Exception\CardException | \Stripe\Exception\InvalidRequestException $e) {
                // return "Your card is not connected with your account. Please add your card again.";
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
        // dd($cartService->items());$cartService->updatedCartitems()
        foreach($cartWidgetIds as $cart){
            $item=CartWidget::where('id',$cart)->first();
            // dd($item);
            $activityScheduler = BusinessActivityScheduler::find($item->actscheduleid) ;
            // dd($activityScheduler);
            $businessServices = BusinessServices::find($item->code);
            $user = $businessServices->user;
            // $price_detail = $cartService->getPriceDetail($item['priceid']);
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
    public function viewbooking(Request $request)
    {
        // dd('11');
        // dd($request->all());
        $userid =$request->user_id;
        $user=User::find($userid);
        $business = $user->company()->where('id',request()->business_id)->first();
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
        $tabval = $request->tab; 
        // return view('personal.orders.index', compact('bookingDetails','currentBooking','tabval','customer','name','business'));
        $html = view('business.website_integration.orders_index', compact('bookingDetails', 'currentBooking', 'tabval', 'customer', 'name', 'business','user'))->render();
        return response()->json(['html' => $html]);

    }

    public function searchActivity(Request $request){
        $serviceType = $request->serviceType;
    
        if(!$request->customerId){
            $customer=Customer::where('business_id',$request->businessId)->where('user_id',$request->user_id)->first();
            $customerID = @$customer->id;
        }

        $orderDetails = [];
        $tabName = $request->type;
        if($customerID){
            if($request->type == 'current'){
                $bDetails = $this->booking_repo->currentTab($request->serviceType,$request->businessId,@$customer);
            }else{
                $bookingDetails =  $this->booking_repo->otherTab($request->serviceType, $request->businessId,@$customer);
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
            
            return view('business.website_integration.user_booking_detail',compact('orderDetails','tabName','customer'))->render();
        }
    }



    public function schedule(Request $request)
    {
        // dd($request->all());
        $business_id=$request->businessId;
        try {
            $chkScheduleSession = '';
            $company = CompanyInformation::findOrFail($business_id);
            $user=User::where('id',$company->user_id)->first();
            $companyName = $company->dba_business_name ?? $company->company_name;
            $business_services = $company->service()->where('is_active', 1)->orderBy('created_at', 'desc');
            $servicetype = 'all';

            if ($request->stype && $request->business_service_id == '') {
                $servicetype = $request->stype;
                if ($request->stype != 'all') {
                    $business_services = $company->service()->where(['is_active' => 1, 'service_type' => $servicetype])->orderBy('created_at', 'desc');
                }
            }

            // $user = Auth::user();
            $userCompany = @$user->company ?? [];
            $customer = Customer::where(['user_id' => @$user->id, 'business_id' => $business_id])->first();
            
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
            // DB::enableQueryLog();
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
            // dd(\DB::getQueryLog()); 
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

            // dd($service_ids);
            $services = [];
            // DB::enableQueryLog();
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
            // dd(\DB::getQueryLog()); 
            // dd($services);
            if ($user && count($userCompany) == 0) {
                $request->customer_id = '';
            }
            // dd($user);
            $business = CompanyInformation::findOrFail($business_id);
            return view('business.website_integration.activity_scheduler', [
                'days' => $days,
                'filter_date' => $filter_date,
                'serviceType' => $servicetype,
                'services' => $services,
                'companyName' => $companyName,
                'businessId' => $business_id,
                'priceid' => $request->priceid,
                'customer' => $customer,
                'company'=>$company,
                'business'=>$business,
                'name'=>$name,
                'user'=>$user,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in schedule method: ' . $e->getMessage());
            // return redirect()->back();
        }
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

    public function SchedulersStore(Request $request)
    {  // print_r($request->all());exit;
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
                    // dd('33');
                $email_detail_provider = array(
                    "email" => @$UserBookingDetails->company_information->business_email, 
                    "CustomerName" => @$UserBookingDetails->Customer->full_name, 
                    "Url" => env('APP_URL').'/personal/orders?business_id='.$request->businessId, 
                    "BusinessName"=> @$UserBookingDetails->company_information->dba_business_name,
                    "BookedPerson"=> @$UserBookingDetails->Customer->full_name,
                    "ParticipantsName"=> @$UserBookingDetails->Customer->full_name,
                    "Age" => $this->calculateAge(@$UserBookingDetails->Customer->birthdate), // Using the controller method
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

    public function edit_profile(Request $request)
    {
        if($request->customer_id){
            // dd($request->customer_id);
            $business_id=$request->code;
            $cus_id=$request->customer_id;        
            $business = CompanyInformation::find($business_id);    
            $customer=Customer::where('user_id',request()->customer_id)->where('business_id',$business_id)->first();
            // dd($customer);
            $userid=$customer->user_id;
            $userdata=User::where('id',$userid)->first();
            if($customer->primary_account===0)
            {
                $user=UserFamilyDetail::where('id',$userid)->first();
                if($user)
                {
                    $name = @$user->full_name;
                    return view('business.website_integration.user_family_profile',compact('user','business','name'));
                }
                else{
                    $user=customer::where('user_id',$userid)->first();
                    $name = @$customer->full_name;
                    return view('business.website_integration.customersprofile',compact('user','business','name'));
                }
            }
            else{
                $user=User::where('id',$userid)->first();
                $name = @$customer->full_name;
                return view('business.website_integration.edit_profile',compact('user','business','name'));       
            }
        }
    }
    public function updateProfile(Request $request, $id)
    {
        // dd($id);
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


    public function customerprofile(Request $request)
    {   
        $user = User::findOrFail($request->id);
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
            $this->validate($request, [
                'newPassword' => 'required',
                'confirmPassword' => 'required',
            ]);

            $status = $user->update(['password' => Hash::make($request->newPassword) ,'buddy_key' =>$request->newPassword]);
            $success = 'Password has been changed successfully.';

        }else if($request->type == 'portfolio'){
            $data = $request->except(['_token', 'id', 'type']);
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
            $user->customers()->update(['profile_pic' => $profilePic ]);

            $success = 'Profile photo has been changed successfully.';
            $fail = 'Problem in uploading profile photo.';
        }
        
        if(@$status){
            return Redirect::back()->with('success', $success);
            // return Redirect::route('personal.profile.index')->with('success', $success);
        }else{
            return Redirect::back();
            // return Redirect::route('personal.profile.index')->with('error', $fail);
           //return Redirect::back()->with('error', $fail);
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
    

    public function testers(Request $request){
        $Customer = Customer::where('id',$request->id)->first();
        $user = User::findOrFail($Customer->user_id);
        $success = $fail = '';
        // dd($request->all());
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
                    'dobstatus' => 0,
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
            $this->validate($request, [
                'newPassword' => 'required',
                'confirmPassword' => 'required',
            ]);

            $status = $user->update(['password' => Hash::make($request->newPassword) ,'buddy_key' =>$request->newPassword]);
            $success = 'Password has been changed successfully.';

        }
        if(@$status){
            return Redirect::back()->with('success', $success);
            // return Redirect::route('personal.profile.index')->with('success', $success);
        }else{
            return Redirect::back();
            // return Redirect::route('personal.profile.index')->with('error', $fail);
           //return Redirect::back()->with('error', $fail);
        }
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


    // schedule
    public function scheduler_index(Request $request)
    {
        // dd($request->all());
        $business_id=$request->businessId;
        $business = CompanyInformation::find($business_id);     
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
            }
            $user=User::where('id',$request->user)->first();
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
                // DB::enableQueryLog();
                $serviceids = BusinessPriceDetailsAges::whereIn('serviceid', $service_ids)
                    ->where('stype', '1')
                    ->whereIn('class_type', $business_services->pluck('service_type')->toArray())
                    ->pluck('serviceid');

                    $bookschedulers = BusinessActivityScheduler::getallscheduler($filter_date)
                    ->whereIn('serviceid', $serviceids)
                    ->orderBy('shift_start', 'asc')
                    ->get();

                 
                    foreach ($bookschedulers as $bs) {
                        $serviceExists = DB::table('business_class_price_option')
                        ->where('service_id', $bs->serviceid)
                        ->where('business_id', $business_id)
                        ->where('class_id', $bs->category_id)
                        ->whereNull('deleted_at')                        
                        ->exists();

                        if ($serviceExists) {
                            $services[] = $bs->business_service;
                        }
                        
                    }

                    // dd(\DB::getQueryLog());
                    $services = array_unique($services);
            }
            // dd($services);

            if ($user && count($userCompany) == 0) {
                $request->customer_id = '';
            }
            return view('business.website_integration.schedule_index', [
                'days' => $days,
                'filter_date' => $filter_date,
                'serviceType' => $servicetype,
                'services' => $services,
                'companyName' => $companyName,
                'businessId' => $business_id,
                'priceid' => $request->priceid,
                'customer' => $customer,
                'business'=> $business,
                'name'=>$name,
                'user'=>$user,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in schedule method: ' . $e->getMessage());
            return redirect()->back();
        }
        
    }


    // public function paymentHistory(Request $request) {
    //     // dd($request->all());
    //     $user = User::where('id', $request->user)->first();
    //     $business = CompanyInformation::find($request->businessId);
    //     $customers = $user->customers()->where('business_id', $request->businessId)->first();
    //     $customer_ids = @$customers->id;
    //     $name = @$customers->full_name;
    //     $business_id = $request->businessId;

    //     $status = Transaction::select('transaction.*')
    //         ->where('item_type', 'UserBookingStatus')
    //         ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
    //         ->join('user_booking_details as ubd', function($join) use ($business_id, $customer_ids) {
    //             $join->on('ubd.booking_id', '=', 'ubs.id')
    //                 ->where('ubd.order_type', 'Membership')
    //                 ->where('ubd.user_id', $customer_ids)
    //                 ->where('ubd.business_id', '=', $business_id);
    //         })->get();
    
    //     $recurring = Transaction::select('transaction.*')
    //         ->where('item_type', 'Recurring')
    //         ->join('recurring as re', 're.id', '=', 'transaction.item_id')
    //         ->where('re.business_id', '=', $business_id)
    //         ->where('re.user_id', $customer_ids)
    //         ->get();
            
    //     $statusArray = [];
    //     foreach ($status as $history) {
    //         $statusArray[] = [
    //             "created_at" => date('m/d/Y', strtotime($history->created_at)),
    //             'itemDescription' => $history->item_description($business_id)['itemDescription'],
    //             'item_type_terms' => $history->item_type_terms(),
    //             'getPmtMethod' => $history->getPmtMethod(),
    //             'amount' => $history->amount,
    //             'qty' => $history->item_description($business_id)['qty'],
    //             'getBookingStatus' => $history->getBookingStatus(),
    //             'item_id' => $history->item_id,
    //             'customer_id' => $history->customer_id,
    //             'id' => $history->id,
    //         ];
    //     }

    //     $recurringArray = [];
    //     foreach ($recurring as $history) {
    //         $recurringArray[] = [
    //             "created_at" => date('m/d/Y', strtotime($history->created_at)),
    //             'itemDescription' => $history->item_description($business_id)['itemDescription'],
    //             'item_type_terms' => $history->item_type_terms(),
    //             'getPmtMethod' => $history->getPmtMethod(),
    //             'amount' => $history->amount,
    //             'qty' => $history->item_description($business_id)['qty'],
    //             'getBookingStatus' => $history->getBookingStatus(),
    //             'item_id' => $history->item_id,
    //             'customer_id' => $history->customer_id,
    //             'id' => $history->id,
    //         ];
    //     }
    
    //     $mergedArray = array_merge($statusArray, $recurringArray);
    
    //     usort($mergedArray, function ($a, $b) {
    //         return strtotime($b['created_at']) - strtotime($a['created_at']);
    //     });
    
    //     return view('business.website_integration.payment_history', compact('mergedArray', 'name', 'business','user'));
    // }

    public function paymentHistorys(Request $request)
    {
        $user = User::find($request->user);
        $business = CompanyInformation::find($request->businessId);
        
        if (!$user || !$business) {
            // Handle the case where either the user or business is not found
            return redirect()->back()->withErrors('User or Business not found.');
        }

        $customers = $user->customers()->where('business_id', $request->businessId)->first();
        $customer_ids = $customers->id ?? null;
        $name = $customers->full_name ?? null;

        if (!$customer_ids) {
            // Handle no customer found case early and return empty view or error
            return view('business.website_integration.payment_history', compact('name', 'business', 'user'))->with('mergedArray', []);
        }

        // Combine the queries using a union for better performance
        $status = Transaction::select('transaction.*')
            ->where('item_type', 'UserBookingStatus')
            ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
            ->join('user_booking_details as ubd', function ($join) use ($customer_ids, $request) {
                $join->on('ubd.booking_id', '=', 'ubs.id')
                    ->where('ubd.order_type', 'Membership')
                    ->where('ubd.user_id', $customer_ids)
                    ->where('ubd.business_id', $request->businessId);
            });

        $recurring = Transaction::select('transaction.*')
            ->where('item_type', 'Recurring')
            ->join('recurring as re', 're.id', '=', 'transaction.item_id')
            ->where('re.business_id', $request->businessId)
            ->where('re.user_id', $customer_ids);

        // Merge queries with union
        $transactions = $status->union($recurring)->orderBy('created_at', 'desc')->get();

        $mergedArray = $transactions->map(function ($history) use ($request) {
            return [
                "created_at" => $history->created_at->format('m/d/Y'),
                'itemDescription' => $history->item_description($request->businessId)['itemDescription'],
                'item_type_terms' => $history->item_type_terms(),
                'getPmtMethod' => $history->getPmtMethod(),
                'amount' => $history->amount,
                'qty' => $history->item_description($request->businessId)['qty'],
                'getBookingStatus' => $history->getBookingStatus(),
                'item_id' => $history->item_id,
                'customer_id' => $history->customer_id,
                'id' => $history->id,
            ];
        })->toArray();

        return view('business.website_integration.payment_history', compact('mergedArray', 'name', 'business', 'user'));
    }



    // new start

    public function paymentHistory(Request $request){
        // $user = $this->user;
        // $businessId = $request->business_id ?? auth()->user()->cid;
        // $business = CompanyInformation::find($businessId);
        // $business = CompanyInformation::where('unique_code', $unique_code)->first();
        $user = User::find($request->user);
        $business = CompanyInformation::find($request->businessId);
    
        $business_id =$business->id;
        if(!$user || !$business) {
            // Handle the case where either the user or business is not found
            return redirect()->back()->withErrors('User or Business not found.');
        }

        $customers = $user->customers()->where('business_id', $request->businessId)->first();
        $customer_ids = $customers->id ?? null;
        $name = $customers->full_name ?? null;

        // $customers = $user->customers()->where('business_id',$businessId)->first();
        // $customer_ids = @$customers->id;
        // $business_id = $businessId;

        $statusArray = Transaction::select('transaction.*')->where('item_type', 'UserBookingStatus')
              ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
              ->join('user_booking_details as ubd', function($join) use ($business_id,$customer_ids) {
                    $join->on('ubd.booking_id', '=', 'ubs.id')
                        ->where('ubd.order_type', 'Membership')
                        ->where('ubd.user_id', $customer_ids)
                        ->where('ubd.business_id', '=', $business_id);
              })->get()->toArray();

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
        return view('business.website_integration.payment_history', compact('transactionDetail', 'name', 'business', 'user'));

    }

    // end
    public function receipt_model_api($orderId, $customer, $isFrom = null)
    {
        $customerData = Customer::where('id', $customer)->first();
        $transaction = Transaction::where('item_id', $orderId)->first();
        if (!$isFrom) {
            if (@$transaction->item_type == 'UserBookingStatus') {
                $oid = $orderId;
                $bookingArray = UserBookingDetail::where('booking_id', $oid)->pluck('id')->toArray();            
            } else {
                $orderId = @$transaction->Recurring->booking_detail_id;
                $oid = $orderId;
                $bookingArray = UserBookingDetail::where('id', $orderId)->pluck('id')->toArray();
            }
            $transactionType = @$transaction->item_type;
        } else {
            $oid = $orderId;
            $bookingArray = UserBookingDetail::where('id', $orderId)->pluck('id')->toArray();
            $transactionType = 'Membership';
        }
        $view = view('business.website_integration._receipt_model', [
            'array' => $bookingArray,
            'email' => @$customerData->email,
            'orderId' => $oid,
            'type' => $transactionType
        ])->render();

        return response()->json(['html' => $view]);
    }

    public function sendreceiptfromcheckout_api(Request $request){
        //print_r($request->all());exit;
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
        //print_r($compare_chk);exit;
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
    
   public function creditCards(Request $request)
   {
        $cardInfo = [];
        $intent = null;
        $business = CompanyInformation::find($request->businessId); 
        $user=User::where('id',$request->user)->first();
        $customers = $user->customers()->pluck('id')->toArray();
        $customer_ids = implode(',',$customers);

        $customer=customer::where('user_id',$request->user)->first();
        $name = $customer->full_name;

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

        return view('business.website_integration.credit_cards',compact('cardInfo','intent','business','name','user'));
    }

    public function cardsapiSave(Request $request) {
       
        // dd($request->all());
        $user = User::where('id', $request->user)->first();
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

        if($request->chkRedirection == 1){
            $user->show_step = 7;
            $user->save();
            $responseType = 'success' ;
            $message='success';
            // return response()->json(['success' => true]);
            // return response()->json(['status' => $responseType, 'message' => $message]);
              // Redirect or return a JSON response based on your needs
              return response()->json(['status' => 'success', 'message' => 'Card saved successfully']);

        
        }else{
            $responseType = 'success' ;
            $message='success';
            // return response()->json(['success' => true]);
            // return response()->json(['status' => $responseType, 'message' => $message]);
              // Redirect or return a JSON response based on your needs
              return response()->json(['status' => 'success', 'message' => 'Card saved successfully']);
        }    
    }

    public function cardDelete(Request $request) {
        $user = User::where('id', $request->user)->first();
        $stripePaymentMethod = \App\StripePaymentMethod::where('payment_id', $request->stripe_payment_method)->firstOrFail();
        $stripePaymentMethod->delete();
    }
    public function UsersFamilyIndex(Request $request)
    {

        $user = User::where('id', $request->user)->first();
        $business = CompanyInformation::find($request->businessId);
        $customer=customer::where('user_id',$request->user)->first();
        $name = $customer->full_name;
        $UserFamilyDetails = $familyDetails = [];
        $customer = @$user->customers;
        // dd($customer);
        if($customer){
            foreach($customer as $cs){
                foreach ($cs->get_families() as $fm){
                    $familyDetails [] = $fm;
                }  
            }

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

        return view('business.website_integration.manage_user_family',compact('user','UserFamilyDetails','business','name'));
    }

    // public function create(Request $request){
    //     $user = User::where('id', $request->user)->first();
    //     return view('business.website_integration.user_family_create');
    // }
    public function UsersFamilyCreate(Request $request)
    {
        // dd('33');
        $user = User::where('id', $request->user_id)->first();
        return response()->view('business.website_integration.user_family_create', compact('user'));
    }


    public function UsersFamilyStore(Request $request,$user_id)
    {
        // dd($user_id);
        $user = User::where('id', $user_id)->first();
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


    public function refresh_payment_methods(Request $request){
        // dd($request->all());
        $customer = Customer::findOrFail($request->customer_id);
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $payment_methods = $stripe->paymentMethods->all(['customer' => $customer->stripe_customer_id, 'type' => 'card']);
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
                    $stripePaymentMethod->user_type = 'Customer';
                    $stripePaymentMethod->user_id = $customer->id;
                    $stripePaymentMethod->pay_type = $payment_method['type'];
                    $stripePaymentMethod->brand = $payment_method['card']['brand'];
                    $stripePaymentMethod->exp_month = $payment_method['card']['exp_month'];
                    $stripePaymentMethod->exp_year = $payment_method['card']['exp_year'];
                    $stripePaymentMethod->last4 = $payment_method['card']['last4'];
                    $stripePaymentMethod->save();
                }
            }
        }
        // dd('44');
        return redirect()->back();
        // if($request->return_url){
        //     if (str_contains($request->return_url, 'check-in-portal')) {
        //         $returnUrl = route('check-in-portal', ['customer_id' => $customer->id]);
        //         return redirect($returnUrl);
        //     }
        //     Session::put(['cardSuccessMsg' => 1]);
        //     return redirect($request->return_url);
        // }else{
        //     return redirect()->route('business_customer_create',['business_id' => $customer->business_id]);
        // }
    }
    public function generateEmailDetails($email, $businessServices, $cartService, $participateAry, $item, $activityScheduler, $price_detail,$user){
        return array(
            "email" => $email,  
            "Url" => env('APP_URL').'/personal/orders?business_id='.$businessServices->cid, 
            "BusinessName"=> @$cartService->getCompany($businessServices->cid)->dba_business_name,
            "BookedPerson"=> $user->full_name,
            "ParticipantsName"=> @$cartService->getParticipateByComa( json_encode($participateAry)),
            "logo"=> @$cartService->getCompany($businessServices->cid)->logo,
            "Age"=> @$cartService->getParticipateAge(json_encode($participateAry)),
            "date"=> Carbon::parse($item['sesdate'])->format('m/d/Y'),
            "time"=> $activityScheduler->activity_time(),
            "duration"=> $activityScheduler->get_clean_duration(),
            "ActivitiyType"=> $businessServices->service_type,
            "ProgramName"=> $businessServices->program_name,
            "CategoryName"=> $price_detail->business_price_details_ages_with_trashed->category_title
        );
    }	

    public function orders_get(Request $request)
    {
        $user = $request->user;
        // dd($user);
        $business = $user->company()->where('id',$request->business)->first();
        if(!request()->business_id){
            return redirect()->route('personal.manage-account.index');
        }
        if($request->customer_id){
            if(request()->type == 'user'){
                $familyMember = $user->user_family_details()->where('id',request()->customer_id)->first();
                $user = User::where(['firstname'=> @$familyMember->first_name, 'lastname'=>@$familyMember->last_name, 'email'=>@$familyMember->email])->first();
                $customer = Customer::where(['user_id' => @$user->id])->first();
                $name = @$familyMember->full_name;
            }else{
                $customer = Customer::find(request()->customer_id);
                $name = @$customer->full_name;
            }   
        }else{
            $customer = Customer::where(['business_id'=>$request->business,'user_id'=>$user->id])->first();
            $name = @$customer->full_name;
        }

        $bookingDetails = $currentBooking =  [];
        $bookingDetails =  $this->booking_repo->otherTab($request->serviceType, $request->business,@$customer);
        $currentBookingData = $this->booking_repo->currentTab($request->serviceType,$request->business,@$customer);
       
        foreach($currentBookingData as $i=>$book_details){
            $currentBooking[@$book_details->business_services_with_trashed->id .'!~!'.@$book_details->business_services_with_trashed->program_name] [] = $book_details;
        }

        $tabval = $request->tab; 
        // dd($currentBooking);
        // dd(\DB::getQueryLog()); 
        $html = view('business.website_integration.orders_index', compact('bookingDetails', 'currentBooking', 'tabval', 'customer', 'name', 'business','user'))->render();
        return response()->json(['html' => $html]);
        // return view('business.website_integration.orders.index', compact('bookingDetails','currentBooking','tabval','customer','name','business'));
    }
   

} 