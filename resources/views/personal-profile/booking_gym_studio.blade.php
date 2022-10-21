@extends('layouts.header')
@section('content')

<link rel="shortcut icon" href="{{ url('public/img/favicon.png') }}">

<!--<link rel="stylesheet" type="text/css" href="{{ url('public/css/bootstrap.css') }}">-->
<link rel="stylesheet" type="text/css" href="{{ url('public/css/all.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/metismenu.min.css') }}">
<link href="{{ url('public/css/jquery-ui.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/profile.css') }}">

<style type="text">
    .intro{
        height: auto;
    }
</style>
<?php 

use Carbon\Carbon;
use App\BusinessPriceDetails;
use App\BusinessService;
use App\BusinessActivityScheduler;
use App\UserBookingStatus;
use App\UserBookingDetail;
use App\UserFamilyDetail;
?>
<div class="page-wrapper inner_top" id="wrapper">
    <div class="page-container">
        <!-- Left Sidebar Start -->
        @include('personal-profile.left_panel')
        <!-- Left Sidebar End -->
        <div class="page-content-wrapper">
            <div class="content-page">
                <div class="container-fluid">
                    <div class="page-title-box">
                        <h4 class="page-title">BOOKINGS INFO</h4>
                    </div>
                    <div class="booking-info-menu">
                        <div class='row'>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <ul>
                                    <li> <a href="/personal-profile/booking-info"> Personal Trainer </a> </li>
                                    <li> <a href="/personal-profile/gym-studio-info" class="active"> Gym/Studio </a> </li>
                                    <li> <a href="/personal-profile/experience-info"> Experiences </a> </li>
                                  <!--   <li> <a href="#"> Products </a> </li> -->
                                </ul>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="booking-info-tab">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-today-tab" data-toggle="tab" href="#nav-today" role="tab" aria-controls="nav-today" aria-selected="true" onclick="changecolor(this.id)">Today</a>
                                        <a class="nav-item nav-link" id="nav-upcoming-tab" data-toggle="tab" href="#nav-upcoming" role="tab" aria-controls="nav-upcoming" aria-selected="false"  onclick="changecolor(this.id)">Upcoming</a>
                                        <a class="nav-item nav-link" id="nav-past-tab" data-toggle="tab" href="#nav-past" role="tab" aria-controls="nav-pending" aria-selected="false"  onclick="changecolor(this.id)">Past</a>
                                    </div>
                                </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="booking_info_section padding-1 white-bg border-radius1">
                        <div class="bookings-block">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane active" id="nav-today" role="tabpanel" aria-labelledby="nav-today-tab">
                                    <div class="col-lg-12 col-md-12 book-info-sear">
                                        <div class='row'>
                                            <div class="col-md-3 col-sm-12">
                                                <p><b>Today Date: <?php echo date('l'); echo", ";echo date('F d , Y')?> </b></p>
                                            </div>
                                           <!--  <div class="col-md-2 col-sm-6">
                                                <div class="show_block">
                                                    <label for="">Show</label>
                                                    <select name="" id="" class="form-control w-38">
                                                        <option value="">10</option>
                                                        <option value="">25</option>
                                                        <option value="">50</option>
                                                        <option value="">All</option>
                                                    </select>
                                                    <label for="">Entries</label>
                                                </div>
                                            </div> -->
                                            <div class="col-md-3 col-sm-6">
                                                <div class="date_block">
                                                    <label for="">Date:</label>
                                                    <input type="text"  id="dateserchfilter_today" placeholder="Search By Date" class="form-control booking-date w-80">
                                                    <i class="far fa-calendar-alt"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <label for="">Search:</label>
                                                <input type="search" id="search_today" placeholder="See by Businesses Booked" class="form-control w-85" onkeyup="getsearchdata('today');">
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="row"  id="searchbydate_today">
                                    @php  $i = 1;@endphp
                                    @if(!empty($BookingDetail))
                                    @foreach($BookingDetail as $book_details)
                                        @php
                                            $data = UserBookingStatus::where('id',$book_details['user_booking_detail']['booking_id'])->first();
                                            $scheduleddata = json_decode(@$book_details['user_booking_detail']['booking_detail'],true);
                                            $sc_date = date("m-d-Y", strtotime($scheduleddata['sessiondate']));
                                            $sc_date = str_replace('-', '/', $sc_date);  

                                            $servicedata = BusinessActivityScheduler::where('serviceid',@$book_details['user_booking_detail']['sport'])->first();

                                            $BusinessPriceDetails = BusinessPriceDetails::where(['id'=>@$book_details['user_booking_detail']['priceid'],'serviceid' =>@$book_details['user_booking_detail']['sport']])->first();

                                            if(@$book_details['businessservices']['service_type']=='individual')
                                            { 
                                                $b_type = 'Personal Training'; 
                                            }else { 
                                                $b_type =ucfirst($book_details['businessservices']['service_type']); 
                                            }

                                            if($book_details['businessservices']['profile_pic'] == ''){
                                                $pro_pic = asset('/public/images/service-nofound.jpg');
                                            }else{
                                                $pro_pic = asset('/public/uploads/profile_pic/thumb/'.$book_details['businessservices']['profile_pic']);
                                            }

                                            $today = date('Y-m-d');
                                            $SpotsLeftdis = 0;
                                            $SpotsLeft = UserBookingDetail::where('sport', @$book_details['user_booking_detail']['sport'] )->whereDate('bookedtime', '=', $today)->sum('qty');
                                            
                                            if( $book_details['businessservices']['group_size'] != '' ){
                                                $SpotsLeftdis = $book_details['businessservices']['group_size'] - $SpotsLeft;
                                            }

                                            $language_name = BusinessService::where('cid',@$book_details['businessservices']['cid'])->first(); 
                                            $language = $language_name->languages;
                                        @endphp
                                        @if(date('Y-m-d',strtotime($sc_date)) == date('Y-m-d'))
                                            <div class="col-md-4 col-sm-6 ">
                                                <div class="boxes_arts">
                                                    <div class="headboxes">
                                                        <img src="{{ $pro_pic  }}" class="imgboxes" alt="">
                                                        <h4 class="fontsize">{{$book_details['businessservices']['program_name']}}</h4>
                                                        <div class="highlighted_box">Confirmed</div>
                                                    </div>
                                                    <div class="middleboxes middletoday" id="today_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>">
                                                        <p>
                                                            <span>BOOKING CONFIRMATION #</span>
                                                            <span>{{$data->order_id}}</span>
                                                        </p>
                                                        <p>
                                                            <span>PRICE OPTION:</span>
                                                            <span>{{$BusinessPriceDetails['pay_session']}} Sessions</span>
                                                        </p>
                                                        <p>
                                                            <span>TOTAL REMAINING:</span>
                                                            <span>{{$SpotsLeftdis}} / {{ $book_details['businessservices']['group_size']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>DATE SCHEDULED:</span>
                                                            <span>{{@$sc_date}}</span>
                                                        </p>
                                                        <p>
                                                            <span>RESERVED TIMED:</span>
                                                            <span>@php if(@$servicedata['shift_start']!=''){
                                                                echo date('h:ia', strtotime( @$servicedata['shift_start'] )); 
                                                            }
                                                            if(@$servicedata['shift_end']!=''){
                                                                echo ' to '.date('h:ia', strtotime( @$servicedata['shift_end'] )); 
                                                            }@endphp</span>
                                                        </p>
                                                        <p>
                                                            <span>TOTAL PRICE</span>
                                                            <span>${{@$data->amount}} </span>
                                                        </p>
                                                        
                                                        <p>
                                                            <span>BOOKED BY:</span>
                                                            <span>{{$book_details['user']['firstname'] }} {{ $book_details['user']['lastname'] }}</span>
                                                        </p>
                                                        <p>
                                                            <span>ACTIVITY TYPE:</span>
                                                            <span>{{$book_details['businessservices']['sport_activity']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>SERVICE TYPE:</span>
                                                            <span>{{$book_details['businessservices']['select_service_type']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>PROGRAM NAME:</span>
                                                            <span>{{$book_details['businessservices']['program_name']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>ACTIVITY LOCATION:</span>
                                                            <span>{{$book_details['businessservices']['activity_location']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>GREAT FOR:</span>
                                                            <span>{{$book_details['businessservices']['activity_for']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>LANGUAGE:</span>
                                                            <span>{{@$language}}</span>
                                                        </p>
                                                        <p>
                                                            <span>PARTICIPANTS:</span>
                                                            <span><?php $a = json_decode($book_details['user_booking_detail']['qty']);
                                                                if( !empty($a->adult) ){ echo 'Adult: '.$a->adult; }
                                                                if( !empty($a->child) ){ echo '<br> Child: '.$a->child; }
                                                                if( !empty($a->infant) ){ echo '<br>Infant: '.$a->infant; }
                                                            ?></span>
                                                        </p>
                                                        <p>
                                                            <span>SKILL LEVEL:</span>
                                                            <span> {{$book_details['businessservices']['difficult_level']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>MEMBERSHIP TYPE:</span>
                                                            <span>{{$BusinessPriceDetails['membership_type']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>BUSINESS TYPE:</span>
                                                            <span>{{@$b_type}}</span>
                                                        </p>
                                                        <p>
                                                            <span>WHO IS PARTICIPATING?</span>
                                                            <span>
                                                                <?php $a = json_decode($book_details['user_booking_detail']['participate'],true); 
                                                                    if(!empty($a)){
                                                                        foreach($a as $data){
                                                                            if($data['from'] == 'family'){
                                                                                $family = UserFamilyDetail::where('id',$data['id'])->first();
                                                                                echo @$family->first_name.' '.@$family->last_name."<br>";
                                                                            }else{ ?>
                                                                                 {{$book_details['user']['firstname'] }} {{ $book_details['user']['lastname']}}
                                                                            <?php echo "<br>"; } 
                                                                        } 
                                                                    }
                                                                ?>
                                                               </span>
                                                        </p>
                                                        <p>
                                                            <span>COMPANY:</span>
                                                            <span>{{ $book_details['businessuser']['company_name'] }}</span>
                                                        </p>
                                                    </div>
                                                    <div class="foterboxes">
                                                        <div class="threebtn_fboxes">
                                                           <!--  <a href="#">Check In</a> -->
                                                            <a href="#">Reschedule</a>
                                                            <a href="#">Cancel</a>
                                                        </div>
                                                        <!-- <div class="icon">
                                                            <span><img src="{{ url('public/img/map.png') }}" alt=""></span>
                                                            <span><img src="{{ url('public/img/message.png') }}" alt=""></span>
                                                        </div> -->
                                                        <div class="viewmore_links">
                                                            <a id="viewmore<?php echo $i.'_'.$book_details['businessservices']['id']; ?>" style="display:block">View More <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                                            <a id="viewless<?php echo $i.'_'.$book_details['businessservices']['id']; ?>" style="display:none">View Less <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                                        </div>
                                                        <script>
                                                            $("#viewmore<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").click(function () {
                                                                $("#today_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").addClass("intro");
                                                                $("#viewless<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").show();
                                                                $("#viewmore<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").hide();
                                                            });
                                                            $("#viewless<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").click(function () {
                                                                $("#today_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").removeClass("intro");
                                                                $("#viewless<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").hide();
                                                                $("#viewmore<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").show();
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @php  $i++;@endphp
                                    @endforeach
                                    @endif
                                    </div>
                                </div>

                                <div class="tab-pane" id="nav-upcoming" role="tabpanel" aria-labelledby="nav-upcoming-tab">
                                    <div class="col-lg-12 col-md-12 book-info-sear">
                                        <div class='row'>
                                            <div class="col-md-3 col-sm-12">
                                                <p><b>Today Date: <?php echo date('l'); echo", ";echo date('F d , Y')?></b></p>
                                            </div>
                                            <!-- <div class="col-md-2 col-sm-6">
                                                <div class="show_block">
                                                    <label for="">Show</label>
                                                    <select name="" id="" class="form-control w-38">
                                                        <option value="">10</option>
                                                        <option value="">25</option>
                                                        <option value="">50</option>
                                                        <option value="">All</option>
                                                    </select>
                                                    <label for="">Entries</label>
                                                </div>
                                            </div> -->
                                            <div class="col-md-3 col-sm-6">
                                                <div class="date_block">
                                                    <label for="">Date:</label>
                                                    <input type="text"  id="dateserchfilter_upcoming" placeholder="Search By Date" class="form-control booking-date w-80">
                                                    <i class="far fa-calendar-alt"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <label for="">Search:</label>
                                                <input type="search" id="search_upcoming" placeholder="See by Businesses Booked" class="form-control w-85" onkeyup="getsearchdata('upcoming');">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="searchbydate_upcoming">
                                    @php  $i = 1;@endphp
                                    @if(!empty($BookingDetail))
                                    @foreach($BookingDetail as $book_details)
                                        @php
                                            $data = UserBookingStatus::where('id',$book_details['user_booking_detail']['booking_id'])->first();
                                            $scheduleddata = json_decode(@$book_details['user_booking_detail']['booking_detail'],true);
                                            echo $scheduleddata['sessiondate']."<br>";
                                            $sc_date = date("m-d-Y", strtotime($scheduleddata['sessiondate']));
                                            $sc_date = str_replace('-', '/', $sc_date);  
                                            echo  $sc_date."<br>";
                                            
                                            $servicedata = BusinessActivityScheduler::where('serviceid',@$book_details['user_booking_detail']['sport'])->first();

                                            $BusinessPriceDetails = BusinessPriceDetails::where(['id'=>@$book_details['user_booking_detail']['priceid'],'serviceid' =>@$book_details['user_booking_detail']['sport']])->first();

                                            if(@$book_details['businessservices']['service_type']=='individual')
                                            { 
                                                $b_type = 'Personal Training'; 
                                            }else { 
                                                $b_type =ucfirst($book_details['businessservices']['service_type']); 
                                            }

                                            if($book_details['businessservices']['profile_pic'] == ''){
                                                $pro_pic = asset('/public/images/service-nofound.jpg');
                                            }else{
                                                $pro_pic = asset('/public/uploads/profile_pic/thumb/'.$book_details['businessservices']['profile_pic']);
                                            }

                                            $today = date('Y-m-d');
                                            $SpotsLeftdis = 0;
                                            $SpotsLeft = UserBookingDetail::where('sport', @$book_details['user_booking_detail']['sport'] )->whereDate('bookedtime', '=', $today)->sum('qty');
                                            
                                            if($book_details['businessservices']['group_size'] != '' ){
                                                $SpotsLeftdis = $book_details['businessservices']['group_size']-$SpotsLeft;
                                            }


                                            $language_name = BusinessService::where('cid',@$book_details['businessservices']['cid'])->first(); 
                                            $language = $language_name->languages;
                                        @endphp
                                        @if(date('Y-m-d',strtotime($sc_date)) > date('Y-m-d'))
                                        @php echo "<pre>";print_r($book_details);  @endphp
                                            <div class="col-md-4 col-sm-6">
                                                <div class="boxes_arts">
                                                    <div class="headboxes">
                                                        <img src="{{  $pro_pic  }}" class="imgboxes" alt="">
                                                        <h4>{{$book_details['businessservices']['program_name']}}</h4>
                                                        <div class="highlighted_box">Confirmed</div>
                                                    </div>
                                                    <div class="middleboxes middletoday" id="upcoming_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>">
                                                        <p>
                                                            <span>BOOKING CONFIRMATION #</span>
                                                            <span>{{$data->order_id}}</span>
                                                        </p>
                                                        <p>
                                                            <span>PRICE OPTION:</span>
                                                            <span>{{$BusinessPriceDetails['pay_session']}} Sessions</span>
                                                        </p>
                                                        <p>
                                                            <span>TOTAL REMAINING:</span>
                                                            <span>{{$SpotsLeftdis}} / {{ $book_details['businessservices']['group_size']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>DATE SCHEDULED:</span>
                                                            <span>{{@$sc_date}}</span>
                                                        </p>
                                                        <p>
                                                            <span>RESERVED TIMED:</span>
                                                            <span>@php if(@$servicedata['shift_start']!=''){
                                                                echo date('h:ia', strtotime( @$servicedata['shift_start'] )); 
                                                            }
                                                            if(@$servicedata['shift_end']!=''){
                                                                echo ' to '.date('h:ia', strtotime( @$servicedata['shift_end'] )); 
                                                            }@endphp</span>
                                                        </p>
                                                        <p>
                                                            <span>TOTAL PRICE</span>
                                                            <span>${{@$data->amount}} </span>
                                                        </p>
                                                        
                                                        <p>
                                                            <span>BOOKED BY:</span>
                                                            <span>{{$book_details['user']['firstname'] }} {{ $book_details['user']['lastname'] }}</span>
                                                        </p>
                                                        <p>
                                                            <span>ACTIVITY TYPE:</span>
                                                            <span>{{$book_details['businessservices']['sport_activity']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>SERVICE TYPE:</span>
                                                            <span>{{$book_details['businessservices']['select_service_type']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>PROGRAM NAME:</span>
                                                            <span>{{$book_details['businessservices']['program_name']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>ACTIVITY LOCATION:</span>
                                                            <span>{{$book_details['businessservices']['activity_location']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>GREAT FOR:</span>
                                                            <span>{{$book_details['businessservices']['activity_for']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>LANGUAGE:</span>
                                                            <span>{{@$language}}</span>
                                                        </p>
                                                        <p>
                                                            <span>PARTICIPANTS:</span>
                                                            <span><?php $a = json_decode($book_details['user_booking_detail']['qty']);
                                                                if( !empty($a->adult) ){ echo 'Adult: '.$a->adult; }
                                                                if( !empty($a->child) ){ echo '<br> Child: '.$a->child; }
                                                                if( !empty($a->infant) ){ echo '<br>Infant: '.$a->infant; }
                                                            ?></span>
                                                        </p>
                                                        <p>
                                                            <span>SKILL LEVEL:</span>
                                                            <span> {{$book_details['businessservices']['difficult_level']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>MEMBERSHIP TYPE:</span>
                                                            <span>{{$BusinessPriceDetails['membership_type']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>BUSINESS TYPE:</span>
                                                            <span>{{@$b_type}}</span>
                                                        </p>
                                                        <p>
                                                            <span>WHO IS PARTICIPATING?</span>
                                                            <span> <?php $a = json_decode($book_details['user_booking_detail']['participate'],true); 
                                                                    if(!empty($a)){
                                                                        foreach($a as $data){
                                                                            if($data['from'] == 'family'){
                                                                                $family = UserFamilyDetail::where('id',$data['id'])->first();
                                                                                echo @$family->first_name.' '.@$family->last_name."<br>";
                                                                            }else{ ?>
                                                                                 {{$book_details['user']['firstname'] }} {{ $book_details['user']['lastname']}}
                                                                            <?php echo "<br>"; } 
                                                                        } 
                                                                    }
                                                                ?>
                                                            </span>
                                                        </p>
                                                        <p>
                                                            <span>COMPANY:</span>
                                                            <span>{{ $book_details['businessuser']['company_name'] }}</span>
                                                        </p>
                                                    </div>
                                                    <div class="foterboxes">
                                                        <div class="threebtn_fboxes">
                                                           <!--  <a href="#">Check In</a> -->
                                                            <a href="#">Reschedule</a>
                                                            <a href="#">Cancel</a>
                                                        </div>
                                                        <!-- <div class="icon">
                                                            <span><img src="{{ url('public/img/map.png') }}" alt=""></span>
                                                            <span><img src="{{ url('public/img/message.png') }}" alt=""></span>
                                                        </div> -->
                                                        <div class="viewmore_links">
                                                             <a id="viewmore<?php echo $i.'_'.$book_details['businessservices']['id']; ?>" style="display:block">View More <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                                            <a id="viewless<?php echo $i.'_'.$book_details['businessservices']['id']; ?>" style="display:none">View Less <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                                        </div>
                                                        <script>
                                                            $("#viewmore<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").click(function () {
                                                                $("#upcoming_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").addClass("intro");
                                                                $("#viewless<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").show();
                                                                $("#viewmore<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").hide();
                                                            });
                                                            $("#viewless<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").click(function () {
                                                                $("#upcoming_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").removeClass("intro");
                                                                $("#viewless<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").hide();
                                                                $("#viewmore<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").show();
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @php  $i++;@endphp
                                    @endforeach
                                    @endif
                                    </div>
                                    
                                </div><!-- tab panel-->

                                <div class="tab-pane" id="nav-past" role="tabpanel" aria-labelledby="nav-past-tab">
                                    <div class="col-lg-12 col-md-12 book-info-sear">
                                        <div class='row'>
                                            <div class="col-md-3 col-sm-12">
                                                <p><b>Today Date: <?php echo date('l'); echo", ";echo date('F d , Y')?></b></p>
                                            </div>
                                           <!--  <div class="col-md-2 col-sm-6">
                                                <div class="show_block">
                                                    <label for="">Show</label>
                                                    <select name="" id="" class="form-control w-38">
                                                        <option value="">10</option>
                                                        <option value="">25</option>
                                                        <option value="">50</option>
                                                        <option value="">All</option>
                                                    </select>
                                                    <label for="">Entries</label>
                                                </div>
                                            </div> -->
                                            <div class="col-md-3 col-sm-6">
                                                <div class="date_block">
                                                    <label for="">Date:</label>
                                                    <input type="text"  id="dateserchfilter_past" placeholder="Search By Date" class="form-control booking-date w-80">
                                                    <i class="far fa-calendar-alt"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <label for="">Search:</label>
                                                <input type="search" id="search_past" placeholder="See by Businesses Booked" class="form-control w-85" onkeyup="getsearchdata('past');">
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="row" id="searchbydate_past">
                                    @php  $i = 1;@endphp
                                    @if(!empty($BookingDetail))
                                    @foreach($BookingDetail as $book_details)
                                        @php
                                            $data = UserBookingStatus::where('id',$book_details['user_booking_detail']['booking_id'])->first();
                                            $scheduleddata = json_decode(@$book_details['user_booking_detail']['booking_detail'],true);
                                            $sc_date = date("m-d-Y", strtotime($scheduleddata['sessiondate']));
                                            $sc_date = str_replace('-', '/', $sc_date);  

                                            $servicedata = BusinessActivityScheduler::where('serviceid',@$book_details['user_booking_detail']['sport'])->first();

                                            $BusinessPriceDetails = BusinessPriceDetails::where(['id'=>@$book_details['user_booking_detail']['priceid'],'serviceid' =>@$book_details['user_booking_detail']['sport']])->first();

                                            if(@$book_details['businessservices']['service_type']=='individual')
                                            { 
                                                $b_type = 'Personal Training'; 
                                            }else { 
                                                $b_type =ucfirst($book_details['businessservices']['service_type']); 
                                            }
                                           
                                            if($book_details['businessservices']['profile_pic'] == ''){
                                                $pro_pic = asset('/public/images/service-nofound.jpg');
                                            }else{
                                                $pro_pic = asset('/public/uploads/profile_pic/thumb/'.$book_details['businessservices']['profile_pic']);
                                            }

                                            $today = date('Y-m-d');
                                            $SpotsLeftdis = 0;
                                            $SpotsLeft = UserBookingDetail::where('sport', @$book_details['user_booking_detail']['sport'] )->whereDate('bookedtime', '=', $today)->sum('qty');
                                            
                                            if($book_details['businessservices']['group_size'] != ''){
                                                $SpotsLeftdis = $book_details['businessservices']['group_size']-$SpotsLeft;
                                            }


                                            $language_name = BusinessService::where('cid',@$book_details['businessservices']['cid'])->first(); 
                                            $language = $language_name->languages;
                                        @endphp
                                        @if(date('Y-m-d',strtotime($sc_date)) < date('Y-m-d'))
                                            <div class="col-md-4 col-sm-6">
                                                <div class="boxes_arts">
                                                    <div class="headboxes">
                                                        <img src="{{ $pro_pic }}" class="imgboxes" alt="">
                                                        <h4>{{$book_details['businessservices']['program_name']}}</h4>
                                                        <div class="highlighted_box">Confirmed</div>
                                                    </div>
                                                    <div class="middleboxes middletoday" id="past_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>">
                                                        <p>
                                                            <span>BOOKING CONFIRMATION #</span>
                                                            <span>{{$data->order_id}}</span>
                                                        </p>
                                                        <p>
                                                            <span>PRICE OPTION:</span>
                                                            <span> @if($BusinessPriceDetails != '')  {{$BusinessPriceDetails['pay_session']}} @endif Sessions</span>
                                                        </p>
                                                        <p>
                                                            <span>TOTAL REMAINING:</span>
                                                            <span>{{$SpotsLeftdis}} / {{ $book_details['businessservices']['group_size']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>DATE SCHEDULED:</span>
                                                            <span>{{@$sc_date}}</span>
                                                        </p>
                                                        <p>
                                                            <span>RESERVED TIMED:</span>
                                                            <span>@php if(@$servicedata['shift_start']!=''){
                                                                echo date('h:ia', strtotime( @$servicedata['shift_start'] )); 
                                                            }
                                                            if(@$servicedata['shift_end']!=''){
                                                                echo ' to '.date('h:ia', strtotime( @$servicedata['shift_end'] )); 
                                                            }@endphp</span>
                                                        </p>
                                                        <p>
                                                            <span>TOTAL PRICE</span>
                                                            <span>${{@$data->amount}} </span>
                                                        </p>
                                                        
                                                        <p>
                                                            <span>BOOKED BY:</span>
                                                            <span>{{$book_details['user']['firstname'] }} {{ $book_details['user']['lastname'] }}</span>
                                                        </p>
                                                        <p>
                                                            <span>ACTIVITY TYPE:</span>
                                                            <span>{{$book_details['businessservices']['sport_activity']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>SERVICE TYPE:</span>
                                                            <span>{{$book_details['businessservices']['select_service_type']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>PROGRAM NAME:</span>
                                                            <span>{{$book_details['businessservices']['program_name']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>ACTIVITY LOCATION:</span>
                                                            <span>{{$book_details['businessservices']['activity_location']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>GREAT FOR:</span>
                                                            <span>{{$book_details['businessservices']['activity_for']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>LANGUAGE:</span>
                                                            <span>{{@$language}}</span>
                                                        </p>
                                                        <p>
                                                            <span>PARTICIPANTS:</span>
                                                            <span><?php $a = json_decode($book_details['user_booking_detail']['qty']);
                                                                if( !empty($a->adult) ){ echo 'Adult: '.$a->adult; }
                                                                if( !empty($a->child) ){ echo '<br> Child: '.$a->child; }
                                                                if( !empty($a->infant) ){ echo '<br>Infant: '.$a->infant; }
                                                            ?></span>
                                                        </p>
                                                        <p>
                                                            <span>SKILL LEVEL:</span>
                                                            <span> {{$book_details['businessservices']['difficult_level']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>MEMBERSHIP TYPE:</span>
                                                            <span>@if($BusinessPriceDetails != '') {{$BusinessPriceDetails['membership_type']}} @endif</span>
                                                        </p>
                                                        <p>
                                                            <span>BUSINESS TYPE:</span>
                                                            <span>{{@$b_type}}</span>
                                                        </p>
                                                        <p>
                                                            <span>WHO IS PARTICIPATING?</span>
                                                            <span> <?php $a = json_decode($book_details['user_booking_detail']['participate'],true); 
                                                                    if(!empty($a)){
                                                                        foreach($a as $data){
                                                                            if($data['from'] == 'family'){
                                                                                $family = UserFamilyDetail::where('id',$data['id'])->first();
                                                                                echo @$family->first_name.' '.@$family->last_name."<br>";
                                                                            }else{ ?>
                                                                                 {{$book_details['user']['firstname'] }} {{ $book_details['user']['lastname']}}
                                                                            <?php echo "<br>"; } 
                                                                        } 
                                                                    }
                                                                ?>
                                                            </span>
                                                        </p>
                                                        <p>
                                                            <span>COMPANY:</span>
                                                            <span>{{ $book_details['businessuser']['company_name'] }}</span>
                                                        </p>
                                                    </div>
                                                    <div class="foterboxes">
                                                        <div class="threebtn_fboxes">
                                                           <!--  <a href="#">Check In</a> -->
                                                            <a href="#">Reschedule</a>
                                                            <a href="#">Cancel</a>
                                                        </div>
                                                        <!-- <div class="icon">
                                                            <span><img src="{{ url('public/img/map.png') }}" alt=""></span>
                                                            <span><img src="{{ url('public/img/message.png') }}" alt=""></span>
                                                        </div> -->
                                                        <div class="viewmore_links">
                                                            <a id="viewmore<?php echo $i.'_'.$book_details['businessservices']['id']; ?>" style="display:block">View More <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                                            <a id="viewless<?php echo $i.'_'.$book_details['businessservices']['id']; ?>" style="display:none">View Less <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                                        </div>
                                                        <script>
                                                            $("#viewmore<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").click(function () {
                                                                $("#past_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").addClass("intro");
                                                                $("#viewless<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").show();
                                                                $("#viewmore<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").hide();
                                                            });
                                                            $("#viewless<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").click(function () {
                                                                $("#past_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").removeClass("intro");
                                                                $("#viewless<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").hide();
                                                                $("#viewmore<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").show();
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @php  $i++; @endphp  
                                    @endforeach
                                    @endif
                                    </div>
                                </div><!-- tab-pane -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')

<script src="{{ url('public/js/jquery.1.11.1.min.js') }}"></script>

<script src="{{ url('public/js/bootstrap.min.js') }}"></script>

<script src="{{ url('public/js/metisMenu.min.js') }}"></script>

<script src="{{ url('public/js/jquery.slimscroll.js') }}"></script>

<script src="{{ url('public/js/moment.min.js') }}"></script>

<script src="{{ url('public/js/jquery-ui.min.js') }}"></script>

<script src="{{ url('public/js/jquery-ui.multidatespicker.js') }}"></script>

<script src="{{ url('public/js/custom.js') }}"></script>

<script>

    $( document ).ready(function() {
       
        $("input[id=dateserchfilter_today]").change(function(){
            var date = $(this).val();
            var type = 'today';
            $.ajax({
                type: "post",
                url:'{{route("datefilterdata")}}',
                data:{"_token":"{{csrf_token()}}" ,"date":date ,'type':type,"page":"gym-studio"},
                success: function(data){
                    $("#searchbydate_today").html(data);
                }
            });
        });

        $("input[id=dateserchfilter_past]").change(function(){
            var date = $(this).val();
            var type = 'past';
            $.ajax({
                type: "post",
                url:'{{route("datefilterdata")}}',
                data:{"_token":"{{csrf_token()}}" ,"date":date ,'type':type,"page":"gym-studio"},
                success: function(data){
                    $("#searchbydate_past").html(data);
                }
            });
        });

        $("input[id=dateserchfilter_upcoming]").change(function(){
            var date = $(this).val();
            var type = 'upcoming';
            $.ajax({
                type: "post",
                url:'{{route("datefilterdata")}}',
                data:{"_token":"{{csrf_token()}}" ,"date":date ,'type':type,"page":"gym-studio"},
                success: function(data){
                    $("#searchbydate_upcoming").html(data);
                }
            });
        });


        /*$("input[id=search_today]").change(function(){
            var text = $(this).val();
            alert(text);
            var type = 'today';
            $.ajax({
                type: "post",
                url:'{{route("datefilterdata")}}',
                data:{"_token":"{{csrf_token()}}" ,"date":date},
                success: function(data){
                    $("#searchbydate_upcoming").html(data);
                }
            });
        });*/
       
    });

    function getsearchdata(type){
     
        if(type == 'past'){
            var text = $('#search_past').val();
            var type = 'past';
        }else if(type == 'today'){
            var text = $('#search_today').val();
            var type = 'today';
        }else{
            var text = $('#search_upcoming').val();
            var type = 'upcoming';
        }
        
       
        $.ajax({
            type: "post",
            url:'{{route("searchfilterdata")}}',
            data:{"_token":"{{csrf_token()}}" ,"text":text ,"type":type,"page":"gym-studio"},
            success: function(data){
                if(type == 'today'){
                    $("#searchbydate_today").html(data);
                }else if(type == 'past'){
                    $("#searchbydate_past").html(data);
                }else{
                    $("#searchbydate_upcoming").html(data);
                }
            }
        });
    }
    

    $('.booking-date').datepicker({
        dateFormat: "mm/dd/yy"
    })
    $('.booking_date1').datepicker({
        dateFormat: "mm/dd/yy"
    })
    $('.booking_date2').datepicker({
        dateFormat: "mm/dd/yy"
    })
    $('.booking_date3').datepicker({
        dateFormat: "mm/dd/yy"
    })

    function  changecolor(id){
     /*   alert(id);*/
        if(id === 'nav-upcoming-tab'){
            $('#'+id).addClass("active");
            $('#nav-past-tab').removeClass("active");
            $('#nav-today-tab').removeClass("active");
        }else if(id === 'nav-past-tab'){
            $('#'+id).addClass("active");
            $('#nav-upcoming-tab').removeClass("active");
            $('#nav-today-tab').removeClass("active");
        }else{
            $('#'+id).addClass("active");
            $('#nav-upcoming-tab').removeClass("active");
            $('#nav-past-tab').removeClass("active");
        }
    }

</script>

@endsection