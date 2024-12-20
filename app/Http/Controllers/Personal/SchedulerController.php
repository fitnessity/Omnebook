<?php

namespace App\Http\Controllers\Personal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{UserBookingDetail,BookingCheckinDetails,UserBookingStatus,BusinessActivityScheduler,Customer,SGMailService};
use App\Repositories\{BookingRepository};
use Auth;
use DateTime;

class SchedulerController extends Controller
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

    public function index(Request $request)
    {   
        $serviceType='classes';
        $programName = $companyName = '';
        $orderData = UserBookingDetail::where(['id'=>$request->user_booking_detail_id])->first();
        if($orderData->business_services()->exists()){
            $programName = $orderData->business_services->program_name;
            $companyName = $orderData->business_services->company_information->dba_business_name;
        }

        $businessId = $orderData->business_id;
        if($orderData->booking->user_id != Auth::user()->id){
            $orderData = [];
        }else{
            if($orderData->business_services()->exists()){
                $serviceType = $orderData->business_services->service_type;
            }
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

        return view('personal.scheduler.index',[
            'days' => $days,
            'filter_date' => $filter_date,
            'orderData' => $orderData,
            'companyName' => $companyName,
            'programName' => $programName,
            'serviceType' => $serviceType,
            'businessId' => $businessId,
            'user_booking_detail_id' => $request->user_booking_detail_id,
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

                $email_detail_provider = array(
                    "email" => @$UserBookingDetails->company_information->business_email, 
                    "CustomerName" => @$UserBookingDetails->Customer->full_name, 
                    "Url" => env('APP_URL').'/personal/orders?business_id='.Auth::user()->cid, 
                    "BusinessName"=> @$UserBookingDetails->company_information->dba_business_name,
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
    public function destroy(Request $request,$id)
    {
        $checkinDetail = BookingCheckinDetails::findOrFail($id);
        $user_booking_detail = $checkinDetail->UserBookingDetail;
       /* $array = json_decode($user_booking_detail->booking_detail,true);
        $array['sessiondate'] = '';
        UserBookingDetail::where('id',$user_booking_detail->id)->update(["act_schedule_id"=>'',"bookedtime"=>NULL,'booking_detail'=>json_encode($array)]);*/
        UserBookingDetail::where('id',$user_booking_detail->id)->update(["act_schedule_id"=>'']);
        $checkinDetail->delete();
    }

}
