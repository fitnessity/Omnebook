<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\WebsiteIntegration;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Validator;
use Session;
use Response;
use DB,Carbon\Carbon;
use App\User;
use App\CompanyInformation;
use App\{UserFollow,BusinessServicesFavorite,StripePaymentMethod,Customer,Transaction,CustomerNotes,Recurring,CustomersDocuments,Announcement,BookingCheckinDetails};
use App\Repositories\{BookingRepository};
class WebsiteIntegrationConroller extends Controller
{
    //

    protected $booking_repo;

    public function __construct(BookingRepository $booking_repo) {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
         $this->booking_repo = $booking_repo;
    }

    public function index()
    {
        $currentCompany = Auth::user()->current_company()->first();
        $data =  WebsiteIntegration::where('business_id', $currentCompany->id)->first();
        $color1 = @$data->log_textcolor; 
        $color2 = @$data->log_bg_color; 
        $color3 = @$data->reg_textcolor; 
        $color4 = @$data->reg_bg_color; 
        $logoUrl = $data ? Storage::disk('s3')->url($data->logo) : null;
        $selectedState=@$data->default_state;
        $company_code = $currentCompany->unique_code;
        $selectLink = '<a href="http://host.fitnessity.co?company_code='. $company_code .'"></a>';    
        // $login = '<a href="http://host.fitnessity.co?company_code='.$company_code.'">Login</a>';
        $login = '<div id="your-login-widget-container" data-unique-code="' . $company_code . '"></div>';
        // $login .= '<script src="http://dev.fitnessity.co/public/js/websiteintegration/login-widget.js"></script>';
        $register='<a href="http://host.fitnessity.co?company_code='.$company_code.'">Register</a>';
        
        return view('business.website_integration.index',compact('data','color1','color2','logoUrl','color3','color4','selectedState','login','register','selectLink'));
    }


    public function update(Request $request)
    {
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
        } else {
            WebsiteIntegration::create($input);
        }
        return redirect()->back();
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
        if ($data) {
            $data->update($input);
        } else {
            WebsiteIntegration::create($input);
        }
        return redirect()->back();
    }

    public function Loginindex()
    {
        $userId = auth()->id();
        $code = CompanyInformation::where('user_id', $userId)->first();
    
        return view('business.website_integration.login', compact('code'));
    }
    
    public function Loginuser($unique_code)
    {
        $code=$unique_code;
        $code = CompanyInformation::where('unique_code', $code)->first();
        $companyinfo=WebsiteIntegration::where('user_id',$code->user_id)->first();
        // dd($companyinfo);
        return view('business.website_integration.userlogin',compact('companyinfo'));
    }
    public function UserLogin(Request $request) {
        // dd($request->input());
        $postArr = $request->input();
    	//dd($postArr);
    	$rules = [
            'email' => 'required',
            'password' => 'required',
        ];
        $validator = Validator::make($postArr, $rules);
        if($validator->fails()) {
          $errMsg = array();
            foreach($validator->messages()->getMessages() as $field_name => $messages) {
                $errMsg = $messages;
            }
            $response = array(
                'type' => 'danger',
                'msg' => $errMsg,
            );
            // return view('home.login',compact('response'));
            return response()->json($response);

            /*   return Response::json($response);*/
        } else {      
            $currentDate = Carbon::now();
            $resultDate = $currentDate->subYears(18)->format('Y-m-d');      
            if (Auth::attempt(['email' => $postArr['email'], 'password' => $postArr['password'], 'activated' =>1 ,'primary_account' => 1 ])) {
                $user = Auth::user();
                $userBirthdate = Carbon::parse($user->birthdate);
                $resultDate = Carbon::parse($resultDate);
                if ($userBirthdate <= $resultDate) {
                    session_start();
    				User::whereId($user->id)->update(['last_login' => date('Y-m-d H:i:s'),'last_ip'=>$request->ip()]);
                    $_SESSION["myses"] = $request->user();
                    $claim = 'not set';
                    $claim_cid = $claim_status = $claim_cname = $claim_welcome = $checkoutsession  = $schedule =$onboard = '';
                    if(session()->has('claim_business_page')) {
                    	$claim = 'set';
                        $claim_cid = session()->get('claim_cid');
                        $data = CompanyInformation::where('id',$claim_cid)->first();
                     
                        if($data != ''){
                            $claim_cname = $data->company_name;
                        }
                        $claim_status = session()->get('claim_status');
                    }
                    if(session()->has('business_welcome')) {
                        $claim_welcome = session()->get('business_welcome');
                    }
                    if(session()->has('checkoutsession')) {
                        $checkoutsession = session()->get('checkoutsession');
                    }

                    if(session()->has('schedule')) {
                        $schedule = session()->get('schedule');
                    }
                    if(session()->has('redirectToOnboard')){
                        $onboard = session()->get('redirectToOnboard');
                    }

                    if($onboard != ''){
                        return redirect($onboard);
                    }

                    if($request->redirect){
                        return redirect($request->redirect);
                    }
                    if($claim  == 'set'){
                        return redirect('/claim/reminder/'.$claim_cname."/".$claim_cid); 
                    }else if($checkoutsession != ''){
                        return redirect('/carts');
                    }else if($schedule != ''){
                        return redirect('/business_activity_schedulers/'.$schedule);
                    }else{
                        // return redirect()->route('homepage');
                        $response = array(
                            'type' => 'success',
                            'msg' => 'success.',
                        );    
                        return response()->json($response);

                    }
                }else{
                    Auth::logout();
                    $response = array(
                        'type' => 'not_exists',
                        'msg' => 'Only Above 18 is allowed to Login.',
                    );
                    // return view('home.login',compact('response'));
                    return response()->json($response);

                }
               /* return Response::json($response);*/
            } else {
                $response = array(
                    'type' => 'not_exists',
                    'msg' => 'User details not verified in our database.',
                );
                // return view('home.login',compact('response'));
                return response()->json($response);

            }
        }
    }
    
    // public function customerdashboard(Request $request)
    // {
    //     $business = CompanyInformation::find($request->business_id);
    //     return view('business.website_integration.customerdashboard',compact('business'));
    // }


    public function customerdashboard(Request $request)
    {

        // $business = CompanyInformation::find($request->business_id);
        $businessId = $request->business_id ?? auth()->user()->cid;
        $business = CompanyInformation::find($businessId);
        // dd($business);
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

        return view('business.website_integration.customerdashboard',compact('customer','name','notesCnt','activeMembershipCnt','docCnt','docCntNew','announcemetCnt','attendanceCnt','announcemetCntNew','bookingCnt','bookingPct','classes','attendancePct','business','notesCntNew','activeMembershipCntNew'));
    }
}