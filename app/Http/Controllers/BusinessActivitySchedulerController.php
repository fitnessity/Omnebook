<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{CompanyInformation,UserBookingStatus,UserBookingDetail,BusinessActivityScheduler,Customer,BusinessPriceDetails,BookingCheckinDetails,SGMailService};
use App\Repositories\BookingRepository;
use DateTime;
use App\BusinessPriceDetailsAges;
use Auth,View;
use Session;
use DB;
class BusinessActivitySchedulerController extends Controller
{
    protected $booking_repo;
    public function __construct(BookingRepository $booking_repo)
    {     
        $this->booking_repo = $booking_repo;
    }
    // public function index(Request $request , $business_id)
    // {
    //     $chkScheduleSession = '';
    //     $company = CompanyInformation::findOrFail($business_id);
    //     $companyName = $company->dba_business_name;
    //     $companyName = $companyName ?? $company->company_name ; 
    //     $business_services = $company->service()->where('is_active',1)->orderBy('created_at','desc');
    //     $servicetype = 'all';
 
    //     if($request->stype && $request->business_service_id == ''){
    //         $servicetype = $request->stype;
    //         if($request->stype != 'all')
    //         {
    //             $business_services = $company->service()->where(['is_active'=>1, 'service_type' => $servicetype])->orderBy('created_at','desc');
    //         }
    //         else{
    //             $business_services = $company->service()->where('is_active',1)->orderBy('created_at','desc');
    //         }        
    //     if(session()->has('schedule')) {
    //         session()->forget('schedule');
    //     }
    //     $user = Auth::user();
    //     $userCompany = @$user->company ?? [];
    //     $customer = Customer::where(['user_id'=>@$user->id, 'business_id'=>$business_id])->first();
    //     if($user != '' && $request->customer_id == ''){
    //         $request->customer_id = $customer->id;
    //     }
    //     if($request->customer_id){
    //         if(request()->type == 'user'){
    //             $familyMember = Auth::user()->user_family_details()->where('id',request()->customer_id)->first();
    //             $user = User::where(['firstname'=> @$familyMember->first_name, 'lastname'=>@$familyMember->last_name, 'email'=>@$familyMember->email])->first();
    //             $customer = Customer::where(['user_id' => @$user->id])->first();
    //         }else{
    //             $customer = Customer::where('id',$request->customer_id)->first();
    //         }
    //         $memberships = @$customer->active_memberships()->pluck('sport')->unique();
    //     }
    //     if($request->business_service_id){
    //         $servicetype = $request->stype;
    //         $business_services = $business_services->where(['id'=>$request->business_service_id,'is_active'=>1, 'service_type' => $servicetype]); 
    //     }
    //     $serviceids=BusinessPriceDetailsAges::wherein('serviceid',$business_services->pluck('id'))->where('stype','1')->where('class_type', $business_services->pluck('service_type'));
    //     $filter_date = new DateTime(); $shift = 1;
    //     if($request->date && (new DateTime($request->date)) > $filter_date){
    //         $filter_date = new DateTime($request->date); $shift = 0;
    //     }
    //     $days = []; $days[] = new DateTime(date('Y-m-d'));
    //     for($i = 0; $i<=100; $i++){
    //         $d = clone($filter_date);
    //         $days[] = $d->modify('+'.($i+$shift).' day');
    //     }
    //     $bookschedulers = BusinessActivityScheduler::getallscheduler($filter_date)->whereIn('serviceid', $serviceids->pluck('serviceid'))->orderBy('shift_start', 'asc')->get();
    //     $services = [];
    //     foreach($bookschedulers as $bs){ $services [] = $bs->business_service; }
    //     if($user != '' && count($userCompany) == 0){  $request->customer_id = '';}
    //     $services = array_unique($services);
    //     // dd('33');
    //     return view('business-activity-schedular.index',[
    //         'days' => $days,
    //         'filter_date' => $filter_date,
    //         'serviceType' => $servicetype,
    //         'services' => $services,
    //         'companyName' => $companyName,
    //         'businessId' => $business_id,
    //         'priceid' => $request->priceid,
    //         'customer' => $customer,
    //     ]);
    //  }
    // }
    //     public function index(Request $request, $business_id)
    //     {
    //     $chkScheduleSession = '';
    //     $company = CompanyInformation::findOrFail($business_id);
    //     $companyName = $company->dba_business_name ?? $company->company_name;
    //     $business_services = $company->service()->where('is_active', 1)->orderBy('created_at', 'desc');
    //     $servicetype = 'all';

    //     if ($request->stype && $request->business_service_id == '') {
    //         $servicetype = $request->stype;
    //         if ($request->stype != 'all') {
    //             $business_services = $company->service()->where(['is_active' => 1, 'service_type' => $servicetype])->orderBy('created_at', 'desc');
    //         }

    //         if (session()->has('schedule')) {
    //             session()->forget('schedule');
    //         }
    //     }

    //     $user = Auth::user();
    //     $userCompany = @$user->company ?? [];
    //     $customer = Customer::where(['user_id' => @$user->id, 'business_id' => $business_id])->first();
        
    //     if ($user && $request->customer_id == '') {
    //         $request->customer_id = $customer->id;
    //     }
        
    //     if ($request->customer_id) {
    //         if (request()->type == 'user') {
    //             $familyMember = Auth::user()->user_family_details()->where('id', request()->customer_id)->first();
    //             $user = User::where(['firstname' => @$familyMember->first_name, 'lastname' => @$familyMember->last_name, 'email' => @$familyMember->email])->first();
    //             $customer = Customer::where(['user_id' => @$user->id])->first();
    //         } else {
    //             $customer = Customer::where('id', $request->customer_id)->first();
    //         }
    //         $memberships = @$customer->active_memberships()->pluck('sport')->unique();
    //     }

    //     if ($request->business_service_id) {
    //         $servicetype = $request->stype;
    //         $business_services = $business_services->where(['id' => $request->business_service_id, 'is_active' => 1, 'service_type' => $servicetype]);
    //     }

    //     $serviceids = BusinessPriceDetailsAges::whereIn('serviceid', $business_services->pluck('id'))
    //         ->where('stype', '1')
    //         ->where('class_type', $business_services->pluck('service_type'));

    //     $filter_date = new DateTime();
    //     $shift = 1;
    //     if ($request->date && (new DateTime($request->date)) > $filter_date) {
    //         $filter_date = new DateTime($request->date);
    //         $shift = 0;
    //     }

    //     $days = [];
    //     $days[] = new DateTime(date('Y-m-d'));
    //     for ($i = 0; $i <= 100; $i++) {
    //         $d = clone($filter_date);
    //         $days[] = $d->modify('+' . ($i + $shift) . ' day');
    //     }

    //     $bookschedulers = BusinessActivityScheduler::getallscheduler($filter_date)
    //         ->whereIn('serviceid', $serviceids->pluck('serviceid'))
    //         ->orderBy('shift_start', 'asc')
    //         ->get();

    //     $services = [];
    //     foreach ($bookschedulers as $bs) {
    //         $services[] = $bs->business_service;
    //     }

    //     if ($user && count($userCompany) == 0) {
    //         $request->customer_id = '';
    //     }

    //     $services = array_unique($services);

    //     return view('business-activity-schedular.index', [
    //         'days' => $days,
    //         'filter_date' => $filter_date,
    //         'serviceType' => $servicetype,
    //         'services' => $services,
    //         'companyName' => $companyName,
    //         'businessId' => $business_id,
    //         'priceid' => $request->priceid,
    //         'customer' => $customer,
    //     ]);
    // }

    public function index(Request $request, $business_id)
    {
        // return '33';
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
            return view('business-activity-schedular.index', [
                'days' => $days,
                'filter_date' => $filter_date,
                'serviceType' => $servicetype,
                'services' => $services,
                'companyName' => $companyName,
                'businessId' => $business_id,
                'priceid' => $request->priceid,
                'customer' => $customer,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in schedule method: ' . $e->getMessage());
            return redirect()->back();
        }
        
    }

    public function create(){ }
    public function store(Request $request){ }
    public function show($id){ }
    public function edit($id){ }
    public function update(Request $request, $id){ }
    public function destroy($id){ }
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
    public function multibooking(Request $request, $business_id){
        $company = CompanyInformation::findOrFail($business_id);
        $filter_date = new DateTime();
        $shift = 1;
        if($request->date && (new DateTime($request->date)) > $filter_date){
            $filter_date = new DateTime($request->date);  $shift = 0;
        }
        $days = []; $days[] = new DateTime(date('Y-m-d'));
        for($i = 0; $i<=100; $i++){
            $d = clone($filter_date); $days[] = $d->modify('+'.($i+$shift).' day');
        }
        $business_services = $company->service()->where('is_active',1)->orderBy('created_at','desc');
        if($request->business_service_id){
            $business_services = $company->service()->where(['id'=>$request->business_service_id,'is_active'=>1]);
        }
        $user = Auth::user();
        $userCompany = @$user->company ?? [];
        $customer = Customer::where(['user_id'=>@$user->id, 'business_id'=>$business_id])->first();
        if($user != '' && count($userCompany) == 0  && $request->customer_id == ''){
            $request->customer_id = $customer->id;
        }   
        if($request->customer_id){
            $customer = Customer::where('id',$request->customer_id)->first();
            $memberships = $customer->active_memberships()->pluck('sport')->unique();
        }
        $bookschedulers = BusinessActivityScheduler::getallscheduler($filter_date)->whereIn('serviceid', $business_services->pluck('id'))->orderBy('shift_start', 'asc')->get();
        $services = [];
        foreach($bookschedulers as $bs){
            $services []= $bs->business_service;
        }
        $services = array_unique($services);
        $finalSessionAry =$sessionAry = [];
        $sessionAry = Session::get('multibooking');
        if(!empty($sessionAry)){
            foreach($sessionAry as $i=>$ary){
                $ary['priceId'] = ''; 
                if($ary['date'] == date('Y-m-d') &&  date( "H:i", strtotime($ary['time']) ) < date( "H:i", strtotime(date('Y-m-d H:i:s')) ) ||  $ary['date'] <  date('Y-m-d')){
                    unset($sessionAry[$i]);
                }else{
                    $finalSessionAry[] = $ary;
                }
            }
        }
        session::put('multibooking', $finalSessionAry);
        return view('business-activity-schedular.multibooking',[
            'days' => $days,
            'filter_date' => $filter_date,
            'company' => $company,
            'services' => $services,
            'priceid' => $request->priceid,
            'finalSessionAry' => $finalSessionAry,
            'customer' => $customer]);
    }
    public function chkMultiBooking(Request $request){
        $activitySchedulerData = BusinessActivityScheduler::find($request->timeid);
        $customer = Customer::where(['id'=>$request->customerID,'business_id'=>$request->businessId])->first();
        $UserBookingDetails = $customer->bookingDetail()->whereDate('expired_at' ,'>' ,date('Y-m-d'))->where(['id'=> $request->did])/*->where('sport',$request->serviceID )*/
        ->when($request->priceId, function ($query, $priceId) {
            return $query->orWhere('priceid', $priceId);
        })->whereDate('expired_at' ,'>' ,date('Y-m-d'))->orderby('created_at','desc')->first();
        if($UserBookingDetails != ''){
            $cnt = 0; $multiBookingAry =[];
            $totalSession = $UserBookingDetails->pay_session; $remaining = $UserBookingDetails->getremainingsession();
            $inSessionArray = Session::get('multibooking') ?? [];
            if(!empty($inSessionArray)){
                foreach($inSessionArray as $ary){
                    if($ary['priceId'] == $UserBookingDetails->priceid && $ary['cid'] == $customer->id && $ary['timeId'] == $request->timeid){
                        $cnt++;
                    }
                }
            }
            if($remaining + $cnt < $totalSession || $remaining == $totalSession ){
                $chk = 0;
                if(!empty($inSessionArray)){
                    foreach($inSessionArray as $ary){
                        if($ary['priceId'] == $UserBookingDetails->priceid && $ary['cid'] == $customer->id && $ary['date'] == $request->date && $ary['timeId'] == $request->timeid){
                           $chk = 1;
                        }
                    }
                }
                if($chk == 0){
                    $multiBookingAry [] = [
                        'oId' => $UserBookingDetails->id,
                        'priceId' => $UserBookingDetails->priceid,
                        'date' => $request->date,
                        'cid' => $customer->id,
                        'timeId' =>$request->timeid,
                        'pname' =>$UserBookingDetails->business_services->program_name,
                        'catname' =>$UserBookingDetails->business_price_detail->business_price_details_ages->category_title,
                        'time' => date('h:i a', strtotime($activitySchedulerData->shift_start)),
                        'duration' =>$activitySchedulerData->get_duration(),
                    ];
                }
                $multiBookingAry = !empty($inSessionArray) ? array_merge($inSessionArray ,$multiBookingAry) : $multiBookingAry;
                session::put('multibooking', $multiBookingAry);
            }else{
                return "Fail";
            }
        }
    }
    public function chkMultipleOrder(Request $request){
        $activitySchedulerData = BusinessActivityScheduler::find($request->timeid);
        $customer = Customer::where(['id'=>$request->customerID,'business_id'=>$request->businessId])->first();
        $UserBookingDetails = $customer->bookingDetail()->whereDate('expired_at' ,'>' ,date('Y-m-d'))->where(['sport'=>$request->serviceID ])->whereDate('expired_at' ,'>' ,date('Y-m-d'))->orderby('created_at','desc')->first();
        $inSessionArray = Session::get('multibooking') ?? [];
        $multiBookingAry = [];
        $alreadyAdded  = 0;
        if(!empty($inSessionArray)){
            foreach($inSessionArray as $ary){
                if($ary['serviceID'] == $request->serviceID && $ary['cid'] == $request->customerID && $ary['date'] == $request->date && $ary['timeId'] == $request->timeid){ $alreadyAdded  = 1; }
            }
        }
        if($alreadyAdded  == 0){
            $multiBookingAry [] = [
                'date' => $request->date,
                'category_id' => $request->category_id,
                'cid' => $request->customerID,
                'timeId' =>$request->timeid,
                'pname' =>$request->pname,
                'catname' => @$UserBookingDetails->business_price_detail->business_price_details_ages->category_title,
                'serviceID' =>$request->serviceID,
                'businessId' =>$request->businessId,
                'time' => $request->time,
                'duration' =>$activitySchedulerData->get_duration(),
                'priceId' =>@$UserBookingDetails->priceid,
                'oId' =>@$UserBookingDetails->id,
            ];
        }
        $multiBookingAry = !empty($inSessionArray) ? array_merge($inSessionArray ,$multiBookingAry) : $multiBookingAry;
        session::put('multibooking', $multiBookingAry);
        $j = collect($multiBookingAry)->filter(function ($ary) use ($request) {
            return $ary['cid'] == $request->customerID;
        })->count();
        return $j;
    }
    public function getReviewData($cid,$business_id){
        $sessionAry = Session::get('multibooking',[]);
        $finalSessionAry = collect($sessionAry)->filter(function($ary) use ($cid) {
            return $ary['cid'] == $cid;
        })->all();
        $company = CompanyInformation::find($business_id);
        return view('business-activity-schedular.reviewData',compact('finalSessionAry','company','cid'));
    }
    public function loadMembershipDropdown(Request $request){
        $cid = $request->cid;
        $i = $request->i;
        $sessionAry = Session::get('multibooking',[]);
        $finalSessionAry = collect($sessionAry)->filter(function($ary) use ($cid) {
            return $ary['cid'] == $cid;
        })->all(); 
        return view('business-activity-schedular.multibookin_select_box',compact('finalSessionAry','cid','i'));
    }
    public function deleteFromSession(Request $request){
        $sessionAry = Session::get('multibooking',[]);
        $sessionAry = collect($sessionAry)->reject(function ($ary) use ($request) {
            return $ary['serviceID'] == $request->serviceID && $ary['date'] == $request->date && $ary['timeId'] == $request->timeId; 
        })->all();
        $cid = $request->cid;
        $finalSessionAry = collect($sessionAry)->filter(function($ary) use ($cid) {
            return $ary['cid'] == $cid;
        })->count();
        session::put('multibooking', $sessionAry);
        return  $finalSessionAry;
    }
    public function save(Request $request){
        $confirmBooking = [];
        $sessionAry = Session::get('multibooking');
        foreach($sessionAry as $i=>$ary){
            if($ary['cid'] == $request->cid && $ary['priceId'] != ''){
                $customer = Customer::where(['id'=>$ary['cid']])->first();
                $UserBookingDetails = UserBookingDetail::where('id',$ary['oId'])->where('priceid',$ary['priceId'])->whereDate('expired_at','>', date('Y-m-d'))->orderby('created_at','desc')->first();
                if($UserBookingDetails != ''){
                    $sendmail = 0;
                    $checkIndetail = $UserBookingDetails->BookingCheckinDetails()->whereDate('checkin_date','=',$ary['date'])->where(['checked_at' =>null,'business_activity_scheduler_id'=>$ary['timeId']])->first();
                    if($checkIndetail != ''){
                        $checkIndetail->update(["business_activity_scheduler_id"=>$ary['timeId'],
                                "checkin_date"=>$ary['date']]);
                        $confirmBooking[] =$checkIndetail->id; 
                        $sendmail = 1;
                    }else{
                        $chkData = $UserBookingDetails->BookingCheckinDetails()->where('business_activity_scheduler_id',0)->where(['checkin_date' =>null])->first();
                        if($chkData != ''){
                            $chkData->update(["business_activity_scheduler_id"=>$ary['timeId'],
                                "checkin_date"=>$ary['date'], "instructor_id"=>@$activitySchedulerData->instructure_ids]);
                            $confirmBooking[] =$chkData->id; 
                            $sendmail = 1;
                        }else{
                            $chkMissSession = $UserBookingDetails->BookingCheckinDetails()->whereDate('checkin_date','<',date('Y-m-d'))->where(['checked_at' =>null,'business_activity_scheduler_id'=>$ary['timeId']])->first();
                            if($chkMissSession != ''){
                                $chkMissSession->update(["business_activity_scheduler_id"=>$ary['timeId'],
                                "checkin_date"=>$ary['date']]);
                                $confirmBooking[] =$chkMissSession->id; 
                                $sendmail = 1;
                            }else{
                                $chkUpdate = $UserBookingDetails->BookingCheckinDetails()->whereDate('checkin_date','>',date('Y-m-d'))->where(['checked_at' =>null])->first();
                                if($UserBookingDetails->pay_session == 1 && $chkUpdate){
                                    $chkUpdate->update(["business_activity_scheduler_id"=>$ary['timeId'],
                                    "checkin_date"=>$ary['date']]);
                                    $confirmBooking[] = $chkUpdate->id; 
                                    $sendmail = 1;
                                }
                                if($UserBookingDetails->BookingCheckinDetails()->count() < $UserBookingDetails->pay_session){
                                    $schedule = BusinessActivityScheduler::find($ary['timeId']);
                                    $cDetail = BookingCheckinDetails::create([
                                        "business_activity_scheduler_id"=>$ary['timeId'], 
                                        "instructor_id"=>@$schedule->instructure_ids, 
                                        "customer_id" => $ary['cid'],
                                        "booking_detail_id"=> $UserBookingDetails->id,
                                        "checkin_date"=>$ary['date'],
                                        "use_session_amount" => 0,
                                        "source_type" => 'online_scheduler'
                                    ]);
                                    $confirmBooking[] = $cDetail->id; 
                                    $sendmail = 1;
                                }
                            }
                        }
                    }
                    if($sendmail == 1){
                        // dd('44');
                        $UserBookingDetails->update(["act_schedule_id"=>$ary['timeId'],'bookedtime'=>$ary['date']]);
                        $getreceipemailtbody = $this->booking_repo->getreceipemailtbody($UserBookingDetails->booking_id, $UserBookingDetails->id);
                        $email_detail = array(
                             'getreceipemailtbody' => $getreceipemailtbody,
                             'email' => $customer->email);
                        $status  = SGMailService::sendBookingReceipt($email_detail);
                        $email_detail_provider = array(
                            "email" => @$UserBookingDetails->company_information->business_email, 
                            "CustomerName" => @$UserBookingDetails->Customer->full_name, 
                            "Url" => env('APP_URL').'/personal/orders?business_id='.@$UserBookingDetails->business_id, 
                            "BusinessName"=> @$UserBookingDetails->company_information->dba_business_name,
                            "BookedPerson"=> @$UserBookingDetails->Customer->full_name,
                            "ParticipantsName"=> @$UserBookingDetails->Customer->full_name,
                            "Age" => $this->calculateAge(@$UserBookingDetails->Customer->birthdate), // Using the controller method
                            "date"=> date('m/d/Y',strtotime($ary['date'])),
                            "time"=>  @$UserBookingDetails->business_activity_scheduler->activity_time(),
                            "duration"=> @$UserBookingDetails->business_activity_scheduler->get_clean_duration(),
                            "ActivitiyType"=>  @$UserBookingDetails->business_services->service_type,
                            "ProgramName"=> @$UserBookingDetails->business_services->program_name,
                            "CategoryName"=> @$UserBookingDetails->business_price_detail->business_price_details_ages_with_trashed->category_title);
                        SGMailService::confirmationMail($email_detail_provider);
                    }
                }
            }
            unset($sessionAry[$i]);
        }
        session::put('multibooking', $sessionAry);
        session::put('multibooking-confirm-booking', $confirmBooking);
        if(empty($sessionAry)){
            return "You booked schedule succesfully";
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
    public function confirmation(){
        $data = [];
        $checkInData = Session::get('multibooking-confirm-booking',[]);
        foreach($checkInData as $d){
            $data[] = BookingCheckinDetails::find($d);
        }
        session::put('multibooking-confirm-booking', );
        return view('business-activity-schedular.multiBookingSuccess',compact('data'));
    } 
    public function setSessionOfSchedule(Request $request){
        Session::put('schedule', $request->businessId);   
    }
}