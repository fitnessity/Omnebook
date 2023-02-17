<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AddrCities;
use App\AddrStates;
use App\UserBookingStatus;
use App\UserBookingDetail;
use App\BusinessServices;
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
        $UserProfileDetail['lastname'] = $user->lastname;
        $UserProfileDetail['gender'] = $user->gender;
        $UserProfileDetail['username'] = $user->username;
        $UserProfileDetail['phone_number'] = $user->phone_number;
        $UserProfileDetail['address'] = $user->address;
        $UserProfileDetail['quick_intro'] = $user->quick_intro;
        $UserProfileDetail['birthdate'] = date('m d,Y', strtotime($user->birthdate));
        $UserProfileDetail['email'] = $user->email;
        $UserProfileDetail['favorit_activity'] = $user->favorit_activity;
        $UserProfileDetail['email'] = $user->email;

        $UserProfileDetail['cover_photo'] = $user->cover_photo;
        if (empty($city)) {
            $UserProfileDetail['city'] = $user->city;
            ;
        } else {
            $UserProfileDetail['city'] = $city->city_name;
        }
        $state = AddrStates::where('id', $user->state)->first();
        if (empty($state)) {
            $UserProfileDetail['state'] = $user->state;
            ;
        } else {
            $UserProfileDetail['state'] = $state->state_name;
        }
        $UserProfileDetail['country'] = $user->country;

        $data = UserBookingStatus::selectRaw('bdetails.id, ser.program_name as title, ser_sche.shift_start, ser_sche.shift_end, ser_sche.set_duration,bdetails.bookedtime as start')
                ->leftjoin("user_booking_details as bdetails", DB::raw('bdetails.booking_id'), '=', 'user_booking_status.id')
                ->join("business_services as ser", DB::raw('ser.id'), '=', 'bdetails.sport')
                ->join("business_activity_scheduler as ser_sche", DB::raw('ser_sche.id'), '=', 'bdetails.act_schedule_id')
                ->where('user_booking_status.user_id', Auth::user()->id)
                ->get();
        //echo "<pre>";print_r($data);exit;
        $fullary= [];
        foreach($data as $dt){
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
                "start"=>$dt['start']);
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
            $ser_data = BusinessServices::select('service_type','program_name')->where('id', $booking_detail->sport)->first();
            if($ser_data != ''){

                if(date('Y-m-d') > date('Y-m-d',strtotime($booking_detail->bookedtime) ) ){
                    $tabval = "past";
                }else if(date('Y-m-d') == date('Y-m-d',strtotime($booking_detail->bookedtime) ) ){
                    $tabval = "today";
                }else{
                    $tabval = "upcoming";
                }
                $html .='<div class="calendar-body">';
                if($ser_data->service_type == 'individual'){
                    $html .='<h3>'.$ser_data->program_name.'</h3>
                            <p>with Valor Mixed Martial Arts</p>
                            <p class="calendar-address">2063 broadaway ,7th Fl, New York,NY 10023</p>
                           <div class="calendar-time">
                                <label>Time: </label> <span>03:45 am to 4:15 am (30min)</span>
                            </div>
                            <div class="calendar-time">
                                <label>Whos Participating: </label> <span>Erica Adams(35 years Old)</span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="calendar-btns">
                                       <a class="btn btn-reschedule" href="" target="_blank">Reschedule</a> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="calendar-btns">
                                        <a class="btn btn-danger" href="'.route("personal.orders.index", ['tabval' => $tabval]).'" target="_blank">View Booking</a> 
                                    </div>
                                </div>
                            </div>';
                            
                }else if($ser_data->service_type == 'classes'){
                    $html .='<h3>'.$ser_data->program_name.'</h3>
                            <p>with Valor Mixed Martial Arts</p>
                            <p class="calendar-address">2063 broadaway ,7th Fl, New York,NY 10023</p>
                            <div class="calendar-time">
                                <label>Time: </label> <span>03:45 am to 4:15 am (30min)</span>
                            </div>
                            <div class="calendar-time">
                                <label>Whos Participating: </label> <span>Erica Adams(35 years Old)</span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="calendar-btns">
                                       <a class="btn btn-reschedule" href="" target="_blank">Reschedule</a> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="calendar-btns">
                                        <a class="btn btn-danger" href="'.route("personal.booking_gym_studio", ['tabval' => $tabval]).'" target="_blank">View Booking</a> 
                                    </div>
                                </div>
                            </div>';

                }else if($ser_data->service_type == 'experience'){
                    $html .='<h3>'.$ser_data->program_name.'</h3>
                            <p>with Valor Mixed Martial Arts</p>
                            <p class="calendar-address">2063 broadaway ,7th Fl, New York,NY 10023</p>
                            <div class="calendar-time">
                                <label>Time: </label> <span>03:45 am to 4:15 am (30min)</span>
                            </div>
                            <div class="calendar-time">
                                <label>Whos Participating: </label> <span>Erica Adams(35 years Old)</span>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="calendar-btns">
                                       <a class="btn btn-reschedule" href="" target="_blank">Reschedule</a> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="calendar-btns">
                                        <a class="btn btn-danger" href="'.route("personal.experience_page", ['tabval' => $tabval]).'" target="_blank">View Booking</a>
                                    </div> 
                                </div>
                            </div>';
                }else {
                    $html .='<h3>'.$ser_data->program_name.'</h3>
                            <p>with Valor Mixed Martial Arts</p>
                            <p class="calendar-address">2063 broadaway ,7th Fl, New York,NY 10023</p>
                            <div class="calendar-time">
                                <label>Time: </label> <span>03:45 am to 4:15 am (30min)</span>
                            </div>
                            <div class="calendar-time">
                                <label>Whos Participating: </label> <span>Erica Adams(35 years Old)</span>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="calendar-btns">
                                       <a class="btn btn-reschedule" href="" target="_blank">Reschedule</a> 
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="calendar-btns">
                                        <a class="btn btn-danger" href="'.route("personal.events_page", ['tabval' => $tabval]).'" target="_blank">View Booking</a> 
                                    </div>
                                </div>
                            </div>'; 
                }
                $html .='</div>';
            }
            
        }   
        return $html;
    }

    public function provider_calendar(Request $request) {
        
        $data = UserBookingStatus::selectRaw('bdetails.id, ser.program_name as title, ser_sche.shift_start, ser_sche.shift_end, ser_sche.set_duration,bdetails.bookedtime as start')
                ->leftjoin("user_booking_details as bdetails", DB::raw('bdetails.booking_id'), '=', 'user_booking_status.id')
                ->join("business_services as ser", DB::raw('ser.id'), '=', 'bdetails.sport')
                ->join("business_activity_scheduler as ser_sche", DB::raw('ser_sche.id'), '=', 'bdetails.act_schedule_id')
                ->where('ser.cid', Auth::user()->cid)
                ->get();
        /*echo "<pre>";print_r($data);exit;*/
        $fullary= [];
        foreach($data as $dt){
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
                "start"=>$dt['start']);
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
