<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{UserBookingDetail,BookingCheckinDetails,UserBookingStatus,BusinessActivityScheduler};
use Auth;
use DateTime;

class SchedulerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $serviceType='classes';
        $programName =  $companyName= '';
        $orderData = UserBookingDetail::where(['id'=>$request->user_booking_detail_id])->first();
        if($orderData->business_services()->exists()){
            $programName = $orderData->business_services->program_name;
            $companyName = $orderData->business_services->company_information->company_name;
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
    {   
        $activitySchedulerData = BusinessActivityScheduler::find($request->timeid);
        $customer = Auth::user()->customers()->where('business_id',$request->businessId)->first();
        $UserBookingDetails = '';
        $today = date('Y-m-d');
        $UserBookingDetails = $customer->bookingDetail()->where('bookedtime' , NULL)->orderby('created_at','desc')->first();
        //echo $UserBookingDetails;exit();
        if($UserBookingDetails != ''){
            if($request->date == $today){
                $start = new DateTime($activitySchedulerData->shift_start);
                $start_time = $start->format("H:i");
                $current = new DateTime();
                $current_time =  $current->format("H:i");
                if($current_time > $start_time){
                    return "You can't book this activity for today";
                }
            }
            $UserBookingDetails->update(["act_schedule_id"=>$request->timeid,"bookedtime"=>$request->date]);

            if($UserBookingDetails->booking->order_type == 'checkout_register'){
                BookingCheckinDetails::create([
                    "business_activity_scheduler_id"=>$request->timeid, 
                    "customer_id" => $customer->id,
                    'booking_detail_id'=> $UserBookingDetails->id ,
                    "checkin_date"=>$request->date ,
                    "use_session_amount" => 1,
                    "source_type" => 'online_scheduler'
                ]);
            }else{
                $BookingCheckinDetails = new BookingCheckinDetails;
                $BookingCheckinDetails->update(["business_activity_scheduler_id"=>$request->timeid,
                    "checkin_date"=>$request->date]);
            }
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
        $array = json_decode($user_booking_detail->booking_detail,true);
        $array['sessiondate'] = '';
        UserBookingDetail::where('id',$user_booking_detail->id)->update(["act_schedule_id"=>'',"bookedtime"=>NULL,'booking_detail'=>json_encode($array)]);
        $checkinDetail->delete();
    }

}
