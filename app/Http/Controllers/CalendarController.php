<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AddrCities;
use App\AddrStates;
use App\UserBookingStatus;
use App\UserBookingDetail;
use App\{BusinessServices,Customer};
use Auth;
use DB;
use DateTime;
use Config;

class CalendarController extends Controller
{
    public function calendar(Request $request) {
         
        $user = User::where('id', Auth::user()->id)->first();
        $city = AddrCities::where('id', $user->city)->first();
        $UserProfileDetail['firstname'] = $user->firstname;
       
        $data = UserBookingStatus::selectRaw('bdetails.id, ser.program_name as title, ser_sche.shift_start, ser_sche.shift_end, ser_sche.set_duration,bdetails.bookedtime as start,bdetails.user_id')
                ->leftjoin("user_booking_details as bdetails", DB::raw('bdetails.booking_id'), '=', 'user_booking_status.id')
                ->join("business_services as ser", DB::raw('ser.id'), '=', 'bdetails.sport')
                ->join("business_activity_scheduler as ser_sche", DB::raw('ser_sche.id'), '=', 'bdetails.act_schedule_id')
                ->where('user_booking_status.user_id', Auth::user()->id)
                ->get();
       // echo "<pre>";print_r($data);exit;
        $fullary= [];

        foreach($data as $dt){
            $full_name = "N/A";
            if(@$dt->user_id != ''){
                $full_name = Customer::where('id',$dt->user_id)->first()->full_name;
                $full_name = ucwords($full_name);
            }
            if(@$dt->set_duration != ''){
                $tm = explode(' ',$dt->set_duration);
                $hr=''; $min=''; $sec='';
                if($tm[0]!=0){ $hr=$tm[0].' hr '; }
                if($tm[2]!=0){ $min=$tm[2].' min '; }
                if($tm[4]!=0){ $sec=$tm[4].' sec'; }
                if($hr!='' || $min!='' || $sec!='')
                { $time =  $hr.$min.$sec; } 
            }
            $title = $dt['title'];
            $shift_start = $dt['shift_start'];
            $shift_end = $dt['shift_end'];
           
            $id = $dt['id'];
            $start =  date('Y-m-d').'T'.$dt['shift_start'];
            $end =  date('Y-m-d').'T'.$dt['shift_end'];
            $fullary[] =array(
                "id"=>$id,
                "title"=>$title,
                "shift_start"=>$shift_start,
                "shift_end"=>$shift_end,
                "time"=>$time,
                "start"=>$dt['start'],
                "full_name"=>$full_name);
        }

        //print_r($fullary);exit;
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        
        //return view('calendar.index', ['UserProfileDetail' => $UserProfileDetail, 'cart' => $cart] );
        return view('calendar.index', ['UserProfileDetail' => $UserProfileDetail, 'cart' => $cart ,'fullary'=>$fullary] );
    }

    public function eventmodelboxdata(Request $request){
        /*$date = explode('T',$request->start);
        echo $date[0];*/
        $html = ''; 
        $booking_detail = UserBookingDetail::where('id',$request->id)->first();
        if( $booking_detail != ''){
            $ser_data = BusinessServices::select('service_type','program_name','cid','id')->where('id', $booking_detail->sport)->first();
            $time = "N/A";
            if( $booking_detail->act_schedule_id != ''){
                $time = $booking_detail->business_activity_scheduler->activity_time().' ('. $booking_detail->business_activity_scheduler->get_clean_duration().')';
            }
            $participate = $booking_detail->decodeparticipate();
            if($ser_data != ''){
                if(date('Y-m-d') > date('Y-m-d',strtotime($booking_detail->bookedtime) ) ){
                    $tabval = "past";
                }else if(date('Y-m-d') == date('Y-m-d',strtotime($booking_detail->bookedtime) ) ){
                    $tabval = "today";
                }else{
                    $tabval = "upcoming";
                }
                $html .='<div class="calendar-body">
                        <h3>'.$ser_data->program_name.'</h3>
                        <p>'.$ser_data->company_information->company_name.'</p>
                        <p class="calendar-address">'.$ser_data->company_information->company_address().'</p>
                       <div class="calendar-time">
                            <label>Time: </label> <span>'.$time.'</span>
                        </div>
                        <div class="calendar-time">
                            <label>Who\'s Participating: </label> <span>'.$participate.' </span>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="calendar-btns">
                                   <a class="btn btn-reschedule" href="'.route("business_activity_schedulers",['business_id' => $ser_data->cid, 'business_service_id' => $ser_data->id, 'stype' =>  $ser_data->service_type]).'" target="_blank">Reschedule</a> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="calendar-btns">
                                    <a class="btn btn-danger" href="'.route("personal.orders.index", ['business_id' => $ser_data->cid, 'serviceType'=>$ser_data->service_type, 'tab' => $tabval]).'" target="_blank">View Booking</a> 
                                </div>
                            </div>
                        </div>
                    </div>';
            }
            
        }   
        return $html;
    }

    public function provider_calendar(Request $request) {
        
        $data = UserBookingStatus::selectRaw('bdetails.id, ser.program_name as title, ser_sche.shift_start, ser_sche.shift_end, ser_sche.set_duration,bdetails.bookedtime as start,bdetails.user_id')
                ->leftjoin("user_booking_details as bdetails", DB::raw('bdetails.booking_id'), '=', 'user_booking_status.id')
                ->join("business_services as ser", DB::raw('ser.id'), '=', 'bdetails.sport')
                ->join("business_activity_scheduler as ser_sche", DB::raw('ser_sche.id'), '=', 'bdetails.act_schedule_id')
                ->where('ser.cid', Auth::user()->cid)
                ->get();
        /*echo "<pre>";print_r($data);exit;*/
        $fullary= [];
        foreach($data as $dt){
            $full_name = "N/A";
            if(@$dt->user_id != ''){
                $full_name = Customer::where('id',$dt->user_id)->first()->full_name;
                $full_name = ucwords($full_name);
            }
            if(@$dt->set_duration != ''){
                $tm = explode(' ',$dt->set_duration);
                $hr=''; $min=''; $sec='';
                if($tm[0]!=0){ $hr=$tm[0].' hr '; }
                if($tm[2]!=0){ $min=$tm[2].' min '; }
                if($tm[4]!=0){ $sec=$tm[4].' sec'; }
                if($hr!='' || $min!='' || $sec!='')
                { $time =  $hr.$min.$sec; } 
            }
            $title = $dt['title'];
            $shift_start = $dt['shift_start'];
            $shift_end = $dt['shift_end'];
           
            $id = $dt['id'];
            $start =  date('Y-m-d').'T'.$dt['shift_start'];
            $end =  date('Y-m-d').'T'.$dt['shift_end'];
            $fullary[] =array(
                "id"=>$id,
                "title"=>$title,
                "shift_start"=>$shift_start,
                "shift_end"=>$shift_end,
                "time"=>$time,
                "start"=>$dt['start'],
                "full_name"=>$full_name);
        }

        //print_r($fullary);exit;
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        
        //return view('calendar.index', ['UserProfileDetail' => $UserProfileDetail, 'cart' => $cart] );
        return view('calendar.provider_calender', ['cart' => $cart ,'fullary'=>$fullary] );
    }

}
