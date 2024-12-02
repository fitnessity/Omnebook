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
    public function membership(Request $request)
    {
        
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
        if (!$prices->isEmpty()) {
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

    public function logout(Request $request)
    {
        $loggedinUser = Auth::user()->cid;
        Auth::logout();
        Session::flush();
        $cookie = cookie()->forget('sub_session');
        $code = CompanyInformation::where('id', $loggedinUser)->first();
        return redirect()->route('/login', ['unique_code' => $code->unique_code]);
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
        $cart = $request->input('cart_items'); 
        $users=$request->users;
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
    public function editProfile(Request $request ,$business_id, $user_id)
    {
        // dd($request->all());
        if($request->business_id){
            // dd($request->customer_id);
            $business_id=$business_id;
            $cus_id=$user_id;        
            $business = CompanyInformation::find($business_id);    
            $customer=Customer::where('user_id',$user_id)->where('business_id',$business_id)->first();
            $userid=$customer->user_id;
            $userdata=User::where('id',$userid)->first();
            if($customer->primary_account===0)
            {
                $user=UserFamilyDetail::where('id',$userid)->first();
                if($user)
                {
                    $name = @$user->full_name;
                    return view('subdomain.user_family_profile',compact('user','business','name'));
                }
                else{
                    $user=customer::where('user_id',$userid)->first();
                    $name = @$customer->full_name;
                    return view('subdomain.customersprofile',compact('user','business','name'));
                }
            }
            else{
                $user=User::where('id',$userid)->first();
                $name = @$customer->full_name;
                return view('subdomain.edit_profile',compact('user','business','name'));   
            }
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
