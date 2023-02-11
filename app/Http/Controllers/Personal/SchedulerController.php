<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{UserBookingDetail,BookingCheckinDetails,UserBookingStatus};
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
        $programName = $companyName = $serviceType='classes';
        $orderData = UserBookingDetail::where(['id'=>$request->user_booking_detail_id])->first();
        if($orderData->booking->user_id != Auth::user()->id){
            $orderData = [];
        }else{
            $programName = $orderData->business_services->program_name;
            $companyName= $orderData->business_services->company_information->company_name;
            $serviceType= $orderData->business_services->service_type;
        }
        
       
        $filter_date = new DateTime();
        $shift = 1;
        if($request->date && (new DateTime($request->date)) > $filter_date){
            $filter_date = new DateTime($request->date); 
            $shift = 0;
        }

        $days = [];
        $days[] = new DateTime(date('Y-m-d'));
        for($i = 0; $i<=4; $i++){
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
        $data =  UserBookingDetail::where('id',$request->odid)->first();
        $array = json_decode($data['booking_detail'],true);
        $array['sessiondate'] = $request->date;
        UserBookingDetail::where('id',$request->odid)->update(["act_schedule_id"=>$request->timeid,"bookedtime"=>$request->date,'booking_detail'=>json_encode($array)]);
        BookingCheckinDetails::create([
            "business_activity_scheduler_id"=>$request->timeid, 
            "customer_id" => $data->booking->customer_id,
            'booking_detail_id'=> $request->odid ,
            "checkin_date"=>$request->date ,
            'use_session_amount' => 0]);
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

    public function allActivitySchedule(Request $request){
        $order = UserBookingStatus::where(['user_id'=>Auth::user()->id,'order_type'=>'checkout_register'])->get();
        $servicetype = 'classes';
        if($request->stype){
            $servicetype = $request->stype;
        }
        $orderdata = [];
        foreach($order as $odt){
            $orderdetaildata = UserBookingDetail::where('booking_id',$odt->id)->get();
            foreach($orderdetaildata as $odetail){
                if($odetail->business_services->service_type ==   $servicetype ){
                    $orderdata []= $odetail;
                }
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
        for($i = 0; $i<=4; $i++){
            $d = clone($filter_date);
            $days[] = $d->modify('+'.($i+$shift).' day');
        }
        return view('personal.scheduler.allActivitySchedule',[
            'days' => $days,
            'filter_date' => $filter_date,
            'orderdata' => $orderdata,
            'servicetype' => $servicetype,
        ]);
    }
}
