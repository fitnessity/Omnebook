<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{CompanyInformation,UserBookingStatus,UserBookingDetail,BusinessActivityScheduler,Customer,BusinessPriceDetails,BookingCheckinDetails,SGMailService};
use App\Repositories\BookingRepository;
use DateTime;
use Auth;
use Session;

class BusinessActivitySchedulerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $booking_repo;
    public function __construct(BookingRepository $booking_repo)
    {     
        $this->booking_repo = $booking_repo;
    }

    public function index(Request $request , $business_id)
    {
        $company = CompanyInformation::findOrFail($business_id);
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

        $full_name = '';
        if($request->customer_id){
            $customer = Customer::where('id',$request->customer_id)->first();
        }else{
            $user= Auth::user();
            $customer = Customer::where(['user_id'=>@$user->id, 'business_id'=>$business_id])->first();
        }

        if($request->business_service_id){
            $servicetype = $request->stype;
            $business_services = $company->service()->where(['id'=>$request->business_service_id,'is_active'=>1, 'service_type' => $servicetype]);
            //print_r($business_services);exit;
            
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

        $companyName = $company->dba_business_name;
        if($companyName == ''){
           $companyName = $company->company_name; 
        }
        $bookschedulers = BusinessActivityScheduler::getallscheduler($filter_date)->whereIn('serviceid', $business_services->pluck('id'))->orderBy('end_activity_date', 'desc')->get();
        $services = [];

        //print_r($bookschedulers);exit;
        foreach($bookschedulers as $bs){
            $services []= $bs->business_service;
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
        if($request->priceId != ''){
            $priceDetail = BusinessPriceDetails::find($request->priceId);
            $bookingDetail = UserBookingDetail::where(['sport'=> $request->sid ,'user_id'=>$request->cid,'priceid' => $request->priceId])->whereDate('expired_at' ,'>' ,date('Y-m-d'))->first();
            $remaining= @$bookingDetail->getremainingsession() ?? 0;
            if($remaining != 0 ){
                $html .= '<option value="'.$priceDetail->id.'" data-did="'.$bookingDetail->id.'">'.$priceDetail->price_title.'</option>';
            }
        }else{
            $bookingDetail = UserBookingDetail::where(['sport'=> $request->sid ,'user_id'=>$request->cid])->whereDate('expired_at' ,'>' ,date('Y-m-d'))->get();
           
            if(!empty($bookingDetail)){
                foreach($bookingDetail as $i=>$detail){
                    $remainingSession = $detail->getremainingsession();
                    $priceDetail = $detail->business_price_detail;
                  
                    if($remainingSession != 0 &&  $priceDetail->category_id == $request->catId){
                        if (!$firstDataProcessed) {
                            $remaining = $remainingSession; 
                            $firstDataProcessed = true; 
                        }
                        $html .= '<option value="'.$priceDetail->id.'" data-did ="'.$detail->id.'">'.$priceDetail->price_title.'</option>';
                    }
                }
            }
        }
        
        if($html != ''){

            $data .='<select class="mb-10 form-control" id="priceId" onchange="getRemainingSession()">'.$html.'</select><div class="font-red text-center" id="remainingSession">'.$remaining.' Session Remaining.</div>';
        }
        return $data;
    }

    public function chksession($dId,$date = null,$timeid = null){
        $detail = UserBookingDetail::find($dId);
        $remaining = $detail->getremainingsession();
        if($date != ''){
            $inSessionArray = Session::get('multibooking') ?? [];
            foreach($inSessionArray as $i=>$ary){
                if($ary['serviceID'] == $detail->sport && $ary['timeId'] == $timeid && $ary['date'] == $date){
                    $inSessionArray[$i]['priceId'] = $detail->priceid;
                    $inSessionArray[$i]['oId'] = $detail->id;
                }
            }
            $sessionAry = session::put('multibooking', $inSessionArray);
        }
        return $remaining;
    }

    public function multibooking(Request $request, $business_id){
        if($request->customer_id){
            $customer = Customer::where('id',$request->customer_id)->first();
        }else{
            $user= Auth::user();
            $customer = Customer::where(['user_id'=>@$user->id, 'business_id'=>$business_id])->first();
        }

        $company = CompanyInformation::findOrFail($business_id);
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

        $business_services = $company->service()->where('is_active',1)->orderBy('created_at','desc');
        if($request->business_service_id){
            $business_services = $company->service()->where(['id'=>$request->business_service_id,'is_active'=>1]);            
        }

        $bookschedulers = BusinessActivityScheduler::getallscheduler($filter_date)->whereIn('serviceid', $business_services->pluck('id'))->orderBy('end_activity_date', 'desc')->get();

        $services = [];
        foreach($bookschedulers as $bs){
            $services []= $bs->business_service;
        }

        $services = array_unique($services);

        $finalSessionAry =$sessionAry = [];
        $sessionAry = Session::get('multibooking');
       /* print_r($sessionAry);*/
        /*Session::forget('multibooking');*/

        if(!empty($sessionAry)){
            foreach($sessionAry as $i=>$ary){
                if($ary['cid'] == $customer->id){
                    if($ary['date'] == date('Y-m-d') &&  date( "H:i", strtotime($ary['time']) ) < date( "H:i", strtotime(date('Y-m-d H:i:s')) ) ){
                        unset($sessionAry[$i]);
                    }else{
                        $finalSessionAry[] = $ary;
                    }
                }  
            }
        }
        $sessionAry = session::put('multibooking', $sessionAry);
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
        //print_r($request->all());exit;
        $activitySchedulerData = BusinessActivityScheduler::find($request->timeid);
        $customer = Customer::where(['id'=>$request->customerID,'business_id'=>$request->businessId])->first();

        $UserBookingDetails = $customer->bookingDetail()->whereDate('expired_at' ,'>' ,date('Y-m-d'))->where(['sport'=>$request->serviceID ,'id'=> $request->did])
        ->when($request->priceId, function ($query, $priceId) {
            return $query->orWhere('priceid', $priceId);
        })
        ->whereDate('expired_at' ,'>' ,date('Y-m-d'))->orderby('created_at','desc')->first();
        //secho $UserBookingDetails;
        if($UserBookingDetails != ''){
            $cnt = 0;
            $multiBookingAry =[];

            $totalSession = $UserBookingDetails->pay_session;
            $remaining = $UserBookingDetails->getremainingsession();
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
                if($ary['serviceID'] == $request->serviceID && $ary['cid'] == $request->customerID && $ary['date'] == $request->date && $ary['timeId'] == $request->timeid){
                   $alreadyAdded  = 1;
                }
            }
        }
        if($alreadyAdded  == 0){
            $multiBookingAry [] = [
                'date' => $request->date,
                'cid' => $request->customerID,
                'timeId' =>$request->timeid,
                'pname' =>$request->pname,
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
        $sessionAry = Session::get('multibooking');
        //print_r($sessionAry);exit();
        foreach($sessionAry as $i=>$ary){
            if($ary['cid'] == $request->cid && $ary['priceId'] != ''){
                $customer = Customer::where(['id'=>$ary['cid']])->first();
                $UserBookingDetails = UserBookingDetail::where('id',$ary['oId'])->where('priceid',$ary['priceId'])->whereDate('expired_at','>', date('Y-m-d'))->orderby('created_at','desc')->first();
                //echo $UserBookingDetails->id;exit;
                if($UserBookingDetails != ''){
                    $sendmail = 0;
                    $checkIndetail = $UserBookingDetails->BookingCheckinDetails()->whereDate('checkin_date','=',$ary['date'])->where(['checked_at' =>null,'business_activity_scheduler_id'=>$ary['timeId']])->first();
                    if($checkIndetail != ''){
                        $checkIndetail->update(["business_activity_scheduler_id"=>$ary['timeId'],
                                "checkin_date"=>$ary['date']]);
                        $sendmail = 1;
                    }else{
                        $chkData = $UserBookingDetails->BookingCheckinDetails()->whereDate('business_activity_scheduler_id',0)->where(['checkin_date' =>null])->first();
                        if($chkData != ''){
                            $chkData->update(["business_activity_scheduler_id"=>$ary['timeId'],
                                "checkin_date"=>$ary['date']]);
                            $sendmail = 1;
                        }else{
                            if($UserBookingDetails->BookingCheckinDetails()->count() < $UserBookingDetails->pay_session){
                                BookingCheckinDetails::create([
                                    "business_activity_scheduler_id"=>$ary['timeId'], 
                                    "customer_id" => $ary['cid'],
                                    "booking_detail_id"=> $UserBookingDetails->id,
                                    "checkin_date"=>$ary['date'],
                                    "use_session_amount" => 0,
                                    "source_type" => 'online_scheduler'
                                ]);
                                $sendmail = 1;
                            }
                        }
                    }

                    if($sendmail == 1){
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
    }
}
