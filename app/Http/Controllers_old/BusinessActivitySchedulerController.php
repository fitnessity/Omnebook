<?php
<<<<<<< HEAD
namespace App\Http\Controllers;
=======

namespace App\Http\Controllers;

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{CompanyInformation,UserBookingStatus,UserBookingDetail,BusinessActivityScheduler,Customer,BusinessPriceDetails,BookingCheckinDetails,SGMailService};
use App\Repositories\BookingRepository;
use DateTime;
use App\BusinessPriceDetailsAges;
use Auth,View;
use Session;
use DB;
<<<<<<< HEAD
class BusinessActivitySchedulerController extends Controller
{
=======

class BusinessActivitySchedulerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
    protected $booking_repo;
    public function __construct(BookingRepository $booking_repo)
    {     
        $this->booking_repo = $booking_repo;
    }
<<<<<<< HEAD
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
    public function index(Request $request, $business_id)
{
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
    $userCompany = @$user->company ?? [];
    $customer = Customer::where(['user_id' => @$user->id, 'business_id' => $business_id])->first();
    
    if ($user && $request->customer_id == '') {
        $request->customer_id = $customer->id;
    }
    
    if ($request->customer_id) {
        if (request()->type == 'user') {
            $familyMember = Auth::user()->user_family_details()->where('id', request()->customer_id)->first();
            $user = User::where(['firstname' => @$familyMember->first_name, 'lastname' => @$familyMember->last_name, 'email' => @$familyMember->email])->first();
            $customer = Customer::where(['user_id' => @$user->id])->first();
        } else {
            $customer = Customer::where('id', $request->customer_id)->first();
        }
        $memberships = @$customer->active_memberships()->pluck('sport')->unique();
    }

    if ($request->business_service_id) {
        $servicetype = $request->stype;
        $business_services = $business_services->where(['id' => $request->business_service_id, 'is_active' => 1, 'service_type' => $servicetype]);
    }

    $serviceids = BusinessPriceDetailsAges::whereIn('serviceid', $business_services->pluck('id'))
        ->where('stype', '1')
        ->where('class_type', $business_services->pluck('service_type'));

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

    $bookschedulers = BusinessActivityScheduler::getallscheduler($filter_date)
        ->whereIn('serviceid', $serviceids->pluck('serviceid'))
        ->orderBy('shift_start', 'asc')
        ->get();

    $services = [];
    foreach ($bookschedulers as $bs) {
        $services[] = $bs->business_service;
    }

    if ($user && count($userCompany) == 0) {
        $request->customer_id = '';
    }

    $services = array_unique($services);

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
}

    public function create(){ }
    public function store(Request $request){ }
    public function show($id){ }
    public function edit($id){ }
    public function update(Request $request, $id){ }
    public function destroy($id){ }
    public function chkOrderAvailable(Request $request){
        $html = $data = ''; $remaining = 0; $firstDataProcessed = false; 
=======

    public function index(Request $request , $business_id)
    {
        $chkScheduleSession = '';
        $company = CompanyInformation::findOrFail($business_id);
        $companyName = $company->dba_business_name;
        $companyName = $companyName ?? $company->company_name ; 
        
        $business_services = $company->service()->where('is_active',1)->orderBy('created_at','desc');
        $servicetype = 'all';
        if($request->stype && $request->business_service_id == ''){
            $servicetype = $request->stype;
            if($request->stype != 'all'){
                $business_services = $company->service()->where(['is_active'=>1, 'service_type' => $servicetype])->orderBy('created_at','desc');
            }else{
                $business_services = $company->service()->where('is_active',1)->orderBy('created_at','desc');
            }
        }

        if(session()->has('schedule')) {
            session()->forget('schedule');
        }

        $user = Auth::user();
        $userCompany = @$user->company ?? [];
        $customer = Customer::where(['user_id'=>@$user->id, 'business_id'=>$business_id])->first();

        if($user != '' && $request->customer_id == ''){
            $request->customer_id = $customer->id;
        }

        if($request->customer_id){
            if(request()->type == 'user'){
                $familyMember = Auth::user()->user_family_details()->where('id',request()->customer_id)->first();
                $user = User::where(['firstname'=> @$familyMember->first_name, 'lastname'=>@$familyMember->last_name, 'email'=>@$familyMember->email])->first();
                $customer = Customer::where(['user_id' => @$user->id])->first();
            }else{
                $customer = Customer::where('id',$request->customer_id)->first();
            }
            
            $memberships = @$customer->active_memberships()->pluck('sport')->unique();
            /*$business_services = $business_services->whereIn('id', @$memberships);*/
        }



        if($request->business_service_id){
            $servicetype = $request->stype;
            $business_services = $business_services->where(['id'=>$request->business_service_id,'is_active'=>1, 'service_type' => $servicetype]); 
        }
        
        // my code start
            $serviceids=BusinessPriceDetailsAges::wherein('serviceid',$business_services->pluck('id'))->where('stype','1')->where('class_type', $business_services->pluck('service_type'));
        // my code ends
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
        // \DB::enableQueryLog(); // Enable query log
        // $bookschedulers = BusinessActivityScheduler::getallscheduler($filter_date)->whereIn('serviceid', $business_services->pluck('id'))->orderBy('shift_start', 'asc')->get();//old
        $bookschedulers = BusinessActivityScheduler::getallscheduler($filter_date)->whereIn('serviceid', $serviceids->pluck('serviceid'))->orderBy('shift_start', 'asc')->get();//added by me
        // dd(\DB::getQueryLog());


        $services = [];
        foreach($bookschedulers as $bs){
            $services [] = $bs->business_service;
        }

        if($user != '' && count($userCompany) == 0){
            $request->customer_id = '';
        }
        $services = array_unique($services);

        // /print_r( $services);exit;
        return view('business-activity-schedular.index',[
            'days' => $days,
            'filter_date' => $filter_date,
            /*'orderdata' => $orderdata,*/
            'serviceType' => $servicetype,
            'services' => $services,
            'companyName' => $companyName,
            'businessId' => $business_id,
            'priceid' => $request->priceid,
            'customer' => $customer,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function chkOrderAvailable(Request $request){
        $html = $data = '';
        $remaining = 0;
        $firstDataProcessed = false; 
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
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
<<<<<<< HEAD
        if($html != ''){
=======
        
        if($html != ''){

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
            $data .='<select class="mb-10 form-select" id="priceId" onchange="getRemainingSession()">'.$html.'</select><div class="font-red text-center" id="remainingSession">'.$remaining.' Session Remaining.</div>';
        }
        return $data;
    }
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
    public function chksession($dId,$date = null,$timeid = null,$chk = null){
        $inSession = 0;
        $detail = UserBookingDetail::find($dId);
        $inSessionArray = Session::get('multibooking') ?? [];
        $remaining = $detail->getremainingsession();
<<<<<<< HEAD
=======
       /* echo $remaining.'<br>';*/
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
        if($date != ''){
            foreach($inSessionArray as $i=>$ary){
                if($ary['timeId'] == $timeid && $ary['date'] == $date){
                    $inSessionArray[$i]['priceId'] = $detail->priceid;
                    $inSessionArray[$i]['oId'] = $detail->id;
                }
            }
            session::put('multibooking', $inSessionArray);
        }
<<<<<<< HEAD
        if($chk == 1){
=======

        if($chk == 1){            
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
            foreach($inSessionArray as $i=>$ary){
                if($ary['priceId'] == $detail->priceid && $ary['oId'] == $detail->id){
                    $inSession++; 
                }
            }
<<<<<<< HEAD
        }
        $inSession = max(1, $inSession);
        $remaining = $remaining - $inSession;
        return max(0, $remaining);
    }
    public function multibooking(Request $request, $business_id){
=======
            
        }

        $inSession = max(1, $inSession);
        $remaining = $remaining - $inSession;

        return max(0, $remaining);
    }

    public function multibooking(Request $request, $business_id){
        // dd('test');
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
        $company = CompanyInformation::findOrFail($business_id);
        $filter_date = new DateTime();
        $shift = 1;
        if($request->date && (new DateTime($request->date)) > $filter_date){
<<<<<<< HEAD
            $filter_date = new DateTime($request->date);  $shift = 0;
        }
        $days = []; $days[] = new DateTime(date('Y-m-d'));
        for($i = 0; $i<=100; $i++){
            $d = clone($filter_date); $days[] = $d->modify('+'.($i+$shift).' day');
        }
=======
            $filter_date = new DateTime($request->date); 
            $shift = 0;
        }
        $days = [];
        $days[] = new DateTime(date('Y-m-d'));
        for($i = 0; $i<=100; $i++){
            $d = clone($filter_date);
            $days[] = $d->modify('+'.($i+$shift).' day');
        }

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
        $business_services = $company->service()->where('is_active',1)->orderBy('created_at','desc');
        if($request->business_service_id){
            $business_services = $company->service()->where(['id'=>$request->business_service_id,'is_active'=>1]);
        }
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
        $user = Auth::user();
        $userCompany = @$user->company ?? [];
        $customer = Customer::where(['user_id'=>@$user->id, 'business_id'=>$business_id])->first();
        if($user != '' && count($userCompany) == 0  && $request->customer_id == ''){
            $request->customer_id = $customer->id;
        }   
<<<<<<< HEAD
        if($request->customer_id){
            $customer = Customer::where('id',$request->customer_id)->first();
            $memberships = $customer->active_memberships()->pluck('sport')->unique();
        }
        $bookschedulers = BusinessActivityScheduler::getallscheduler($filter_date)->whereIn('serviceid', $business_services->pluck('id'))->orderBy('shift_start', 'asc')->get();
=======

        if($request->customer_id){
            $customer = Customer::where('id',$request->customer_id)->first();
            $memberships = $customer->active_memberships()->pluck('sport')->unique();
            /*$business_services = $company->service()->whereIn('id', $memberships)->get();*/
        }

        $bookschedulers = BusinessActivityScheduler::getallscheduler($filter_date)->whereIn('serviceid', $business_services->pluck('id'))->orderBy('shift_start', 'asc')->get();

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
        $services = [];
        foreach($bookschedulers as $bs){
            $services []= $bs->business_service;
        }
<<<<<<< HEAD
        $services = array_unique($services);
        $finalSessionAry =$sessionAry = [];
        $sessionAry = Session::get('multibooking');
=======

        $services = array_unique($services);

        $finalSessionAry =$sessionAry = [];
        $sessionAry = Session::get('multibooking');
       /* print_r($sessionAry);*/
        /*Session::forget('multibooking');*/

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
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
<<<<<<< HEAD
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
=======

    public function chkMultiBooking(Request $request){
        //print_r($request->all());exit;
        $activitySchedulerData = BusinessActivityScheduler::find($request->timeid);
        $customer = Customer::where(['id'=>$request->customerID,'business_id'=>$request->businessId])->first();

        $UserBookingDetails = $customer->bookingDetail()->whereDate('expired_at' ,'>' ,date('Y-m-d'))->where(['id'=> $request->did])/*->where('sport',$request->serviceID )*/
        ->when($request->priceId, function ($query, $priceId) {
            return $query->orWhere('priceid', $priceId);
        })
        ->whereDate('expired_at' ,'>' ,date('Y-m-d'))->orderby('created_at','desc')->first();
        //echo $UserBookingDetails;
        if($UserBookingDetails != ''){
            $cnt = 0;
            $multiBookingAry =[];

            $totalSession = $UserBookingDetails->pay_session;
            $remaining = $UserBookingDetails->getremainingsession();
            $inSessionArray = Session::get('multibooking') ?? [];
            
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
            if(!empty($inSessionArray)){
                foreach($inSessionArray as $ary){
                    if($ary['priceId'] == $UserBookingDetails->priceid && $ary['cid'] == $customer->id && $ary['timeId'] == $request->timeid){
                        $cnt++;
                    }
                }
            }
<<<<<<< HEAD
=======
           
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
            if($remaining + $cnt < $totalSession || $remaining == $totalSession ){
                $chk = 0;
                if(!empty($inSessionArray)){
                    foreach($inSessionArray as $ary){
                        if($ary['priceId'] == $UserBookingDetails->priceid && $ary['cid'] == $customer->id && $ary['date'] == $request->date && $ary['timeId'] == $request->timeid){
                           $chk = 1;
                        }
                    }
                }
<<<<<<< HEAD
                if($chk == 0){
=======

                if($chk == 0){

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
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
<<<<<<< HEAD
                $multiBookingAry = !empty($inSessionArray) ? array_merge($inSessionArray ,$multiBookingAry) : $multiBookingAry;
=======

                $multiBookingAry = !empty($inSessionArray) ? array_merge($inSessionArray ,$multiBookingAry) : $multiBookingAry;
                
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
                session::put('multibooking', $multiBookingAry);
            }else{
                return "Fail";
            }
        }
    }
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
    public function chkMultipleOrder(Request $request){
        $activitySchedulerData = BusinessActivityScheduler::find($request->timeid);
        $customer = Customer::where(['id'=>$request->customerID,'business_id'=>$request->businessId])->first();
        $UserBookingDetails = $customer->bookingDetail()->whereDate('expired_at' ,'>' ,date('Y-m-d'))->where(['sport'=>$request->serviceID ])->whereDate('expired_at' ,'>' ,date('Y-m-d'))->orderby('created_at','desc')->first();
<<<<<<< HEAD
=======
       
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
        $inSessionArray = Session::get('multibooking') ?? [];
        $multiBookingAry = [];
        $alreadyAdded  = 0;
        if(!empty($inSessionArray)){
            foreach($inSessionArray as $ary){
<<<<<<< HEAD
                if($ary['serviceID'] == $request->serviceID && $ary['cid'] == $request->customerID && $ary['date'] == $request->date && $ary['timeId'] == $request->timeid){ $alreadyAdded  = 1; }
=======
                if($ary['serviceID'] == $request->serviceID && $ary['cid'] == $request->customerID && $ary['date'] == $request->date && $ary['timeId'] == $request->timeid){
                   $alreadyAdded  = 1;
                }
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
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
<<<<<<< HEAD
        $multiBookingAry = !empty($inSessionArray) ? array_merge($inSessionArray ,$multiBookingAry) : $multiBookingAry;
        session::put('multibooking', $multiBookingAry);
        $j = collect($multiBookingAry)->filter(function ($ary) use ($request) {
            return $ary['cid'] == $request->customerID;
        })->count();
        return $j;
    }
=======
    
        $multiBookingAry = !empty($inSessionArray) ? array_merge($inSessionArray ,$multiBookingAry) : $multiBookingAry;
        
        session::put('multibooking', $multiBookingAry);

        $j = collect($multiBookingAry)->filter(function ($ary) use ($request) {
            return $ary['cid'] == $request->customerID;
        })->count();

        return $j;
    }

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
    public function getReviewData($cid,$business_id){
        $sessionAry = Session::get('multibooking',[]);
        $finalSessionAry = collect($sessionAry)->filter(function($ary) use ($cid) {
            return $ary['cid'] == $cid;
        })->all();
<<<<<<< HEAD
        $company = CompanyInformation::find($business_id);
        return view('business-activity-schedular.reviewData',compact('finalSessionAry','company','cid'));
    }
=======
       // print_r($finalSessionAry);
        $company = CompanyInformation::find($business_id);
        return view('business-activity-schedular.reviewData',compact('finalSessionAry','company','cid'));
    }

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
    public function loadMembershipDropdown(Request $request){
        $cid = $request->cid;
        $i = $request->i;
        $sessionAry = Session::get('multibooking',[]);
        $finalSessionAry = collect($sessionAry)->filter(function($ary) use ($cid) {
            return $ary['cid'] == $cid;
<<<<<<< HEAD
        })->all(); 
        return view('business-activity-schedular.multibookin_select_box',compact('finalSessionAry','cid','i'));
    }
=======
        })->all();
        
        return view('business-activity-schedular.multibookin_select_box',compact('finalSessionAry','cid','i'));
    }

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
    public function deleteFromSession(Request $request){
        $sessionAry = Session::get('multibooking',[]);
        $sessionAry = collect($sessionAry)->reject(function ($ary) use ($request) {
            return $ary['serviceID'] == $request->serviceID && $ary['date'] == $request->date && $ary['timeId'] == $request->timeId; 
        })->all();
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
        $cid = $request->cid;
        $finalSessionAry = collect($sessionAry)->filter(function($ary) use ($cid) {
            return $ary['cid'] == $cid;
        })->count();
<<<<<<< HEAD
        session::put('multibooking', $sessionAry);
        return  $finalSessionAry;
    }
    public function save(Request $request){
        $confirmBooking = [];
        $sessionAry = Session::get('multibooking');
=======

        session::put('multibooking', $sessionAry);
        return  $finalSessionAry;
    }

    public function save(Request $request){
        $confirmBooking = [];
        $sessionAry = Session::get('multibooking');
        //print_r($sessionAry);exit;
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
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
<<<<<<< HEAD
                                $chkUpdate = $UserBookingDetails->BookingCheckinDetails()->whereDate('checkin_date','>',date('Y-m-d'))->where(['checked_at' =>null])->first();
=======
                                
                                $chkUpdate = $UserBookingDetails->BookingCheckinDetails()->whereDate('checkin_date','>',date('Y-m-d'))->where(['checked_at' =>null])->first();

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
                                if($UserBookingDetails->pay_session == 1 && $chkUpdate){
                                    $chkUpdate->update(["business_activity_scheduler_id"=>$ary['timeId'],
                                    "checkin_date"=>$ary['date']]);
                                    $confirmBooking[] = $chkUpdate->id; 
                                    $sendmail = 1;
                                }
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
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
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
                                    $confirmBooking[] = $cDetail->id; 
                                    $sendmail = 1;
                                }
                            }
                        }
                    }
<<<<<<< HEAD
                    if($sendmail == 1){
                        $UserBookingDetails->update(["act_schedule_id"=>$ary['timeId'],'bookedtime'=>$ary['date']]);
=======

                    if($sendmail == 1){
                        $UserBookingDetails->update(["act_schedule_id"=>$ary['timeId'],'bookedtime'=>$ary['date']]);

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
                        $getreceipemailtbody = $this->booking_repo->getreceipemailtbody($UserBookingDetails->booking_id, $UserBookingDetails->id);
                        $email_detail = array(
                             'getreceipemailtbody' => $getreceipemailtbody,
                             'email' => $customer->email);
                        $status  = SGMailService::sendBookingReceipt($email_detail);
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
                        $email_detail_provider = array(
                            "email" => @$UserBookingDetails->company_information->business_email, 
                            "CustomerName" => @$UserBookingDetails->Customer->full_name, 
                            "Url" => env('APP_URL').'/personal/orders?business_id='.@$UserBookingDetails->business_id, 
                            "BusinessName"=> @$UserBookingDetails->company_information->dba_business_name,
                            "BookedPerson"=> @$UserBookingDetails->Customer->full_name,
                            "ParticipantsName"=> @$UserBookingDetails->Customer->full_name,
                            "date"=> date('m/d/Y',strtotime($ary['date'])),
                            "time"=>  @$UserBookingDetails->business_activity_scheduler->activity_time(),
                            "duration"=> @$UserBookingDetails->business_activity_scheduler->get_clean_duration(),
                            "ActivitiyType"=>  @$UserBookingDetails->business_services->service_type,
                            "ProgramName"=> @$UserBookingDetails->business_services->program_name,
                            "CategoryName"=> @$UserBookingDetails->business_price_detail->business_price_details_ages_with_trashed->category_title);
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
                        SGMailService::confirmationMail($email_detail_provider);
                    }
                }
            }
            unset($sessionAry[$i]);
        }
<<<<<<< HEAD
        session::put('multibooking', $sessionAry);
        session::put('multibooking-confirm-booking', $confirmBooking);
=======
        //print_r($confirmBooking);
        session::put('multibooking', $sessionAry);
        session::put('multibooking-confirm-booking', $confirmBooking);

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
        if(empty($sessionAry)){
            return "You booked schedule succesfully";
        }
    }
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
    public function confirmation(){
        $data = [];
        $checkInData = Session::get('multibooking-confirm-booking',[]);
        foreach($checkInData as $d){
            $data[] = BookingCheckinDetails::find($d);
        }
<<<<<<< HEAD
        session::put('multibooking-confirm-booking', );
        return view('business-activity-schedular.multiBookingSuccess',compact('data'));
    } 
    public function setSessionOfSchedule(Request $request){
        Session::put('schedule', $request->businessId);   
    }
}
=======
      
        session::put('multibooking-confirm-booking', );
        return view('business-activity-schedular.multiBookingSuccess',compact('data'));
    } 

    public function setSessionOfSchedule(Request $request){
        Session::put('schedule', $request->businessId);   
    }
}
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
