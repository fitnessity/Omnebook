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
                        <h4 class="page-title">BOOKINGS INFO & PURCHASE HISTORY</h4>
                    </div>
                    <div class="booking-info-menu">
                        <div class='row'>
                            <div class="col-lg-7 col-md-6 col-sm-12">
                                <ul>
                                    <li> <a href="{{route('bookinginfo')}}" class="active"> Personal Trainer </a> </li>
                                    <li> <a href="{{route('gym_studio_page')}}">Classes </a> </li>
                                    <li> <a href="{{route('events_page')}}" > Events </a> </li>
                                    <li> <a href="{{route('experience_page')}}"> Experiences </a> </li>
                                    <!-- <li> <a href="{{route('all_activity_schedule')}}"  > | Schedule</a> </li> -->
                                  <!--   <li> <a href="#"> Products </a> </li> -->
                                </ul>
                            </div>
                            <div class="col-lg-5 col-md-6 col-sm-12">
                                <div class="booking-info-tab">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link" id="nav-current-tab" data-toggle="tab" href="#nav-current" role="tab" aria-controls="nav-current" aria-selected="true" onclick="changecolor(this.id)">Current</a>
                                        
                                        <a class="nav-item nav-link" id="nav-today-tab" data-toggle="tab" href="#nav-today" role="tab" aria-controls="nav-today" aria-selected="true" onclick="changecolor(this.id)">Today</a>
                                        
                                        <a class="nav-item nav-link" id="nav-upcoming-tab" data-toggle="tab" href="#nav-upcoming" role="tab" aria-controls="nav-upcoming" aria-selected="false"  onclick="changecolor(this.id)">Upcoming</a>
                                        
                                        <a class="nav-item nav-link" id="nav-past-tab" data-toggle="tab" href="#nav-past" role="tab" aria-controls="nav-past" aria-selected="false"  onclick="changecolor(this.id)">Past</a>
                                       
                                        <!-- <a class="nav-item nav-link" id="nav-pending-tab" data-toggle="tab" href="#nav-pending" role="tab" aria-controls="nav-pending" aria-selected="false"  onclick="changecolor(this.id)">Pending</a> -->
                                    </div>
                                </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="booking_info_section padding-1 white-bg border-radius1">
                        <div class="bookings-block">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane" id="nav-current" role="tabpanel" aria-labelledby="nav-current-tab">
                                    <div class="col-lg-12 col-md-12 book-info-sear">
                                        <div class='row'>
                                            <div class="col-md-3 col-sm-12">
                                                <p><b>Today Date: <?php echo date('l'); echo", ";echo date('F d , Y')?> </b></p>
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
                                                    <input type="text"  id="dateserchfilter_current" placeholder="Search By Date" class="form-control booking-date w-80">
                                                    <i class="far fa-calendar-alt"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <label for="">Search:</label>
                                                <input type="search" id="search_current" placeholder="See by Businesses Booked" class="form-control w-85" onkeyup="getsearchdata('current');">
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="row"  id="searchbydate_current">
                                    @php    $i = 1;
                                            $br = new \App\Repositories\BookingRepository;
                                        $currentbookingstatus = $br->getdeepdetailofcurrentorder($currentbooking_status);
                                    @endphp
                                    @if(!empty($currentbookingstatus))
                                        @foreach($currentbookingstatus as $book_details)
                                            <div class="col-md-4 col-sm-6 ">
                                                <div class="boxes_arts">
                                                    <div class="headboxes">
                                                        <img src="{{ $book_details['pro_pic']  }}" class="imgboxes" alt="">
                                                        <h4 class="fontsize">{{$book_details['businessservices']['program_name']}}</h4>
                                                        <a class="openreceiptmodel" orderid = '{{$book_details["orderid"]}}' orderdetailid="{{$book_details['orderdetailid']}}">
                                                            <i class="fas fa-file-alt file-booking-receipt" aria-hidden="true"></i>
                                                        </a>
                                                        <div class="highlighted_box">Confirmed</div>
                                                    </div>
                                                    <div class="middleboxes middletoday" id="current_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>">
                                                        <p>
                                                            <span>BOOKING CONFIRMATION #</span>
                                                            <span>{{$book_details['confirm_id']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>TOTAL PRICE:</span>
                                                            <span>${{@$book_details['main_total']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>PRICE OPTION:</span>
                                                            <span>{{@$book_details['price_title']}} - {{@$book_details['pay_session']}} Sessions
                                                            
                                                            </span>
                                                        </p>
                                                        <p>
                                                            <span>PAYMENT TYPE:</span>
                                                            <span> {{@$book_details['pay_session']}} Sessions</span>
                                                        </p>

                                                        <p>
                                                            <span>TOTAL REMAINING:</span>
                                                            <span> {{@$book_details['remaing_session']}}/{{@$book_details['pay_session']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>PROGRAM NAME:</span>
                                                            <span>{{$book_details['businessservices']['program_name']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>EXPIRATION DATE:</span>
                                                            <span>{{$book_details['expired_at']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>DATE BOOKED:</span>
                                                            <span>{{$book_details['date_booked']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>RESERVED DATE:</span>
                                                            <span>{{$book_details['reserve_date']}}</span>
                                                        </p>
                                                    
                                                        <p>
                                                            <span>BOOKED BY:</span>
                                                            <span>{{$book_details['name']}}</span>
                                                        </p>

                                                        <p>
                                                            <span>CHECK IN DATE:</span>
                                                            <span>{{$book_details['reserve_date']}}</span>
                                                        </p> 
                                                        <p>
                                                            <span>CHECK IN TIME:</span>
                                                            <span>{{$book_details['check_in_time']}}</span>
                                                        </p>

                                                        <p>
                                                            <span>ACTIVITY TYPE:</span>
                                                            <span>{{$book_details['businessservices']['sport_activity']}}</span>
                                                        </p>
                                                        <p>
                                                            <span>SERVICE TYPE:</span>
                                                            <span>@if($book_details['businessservices']['select_service_type'] != '') {{$book_details['businessservices']['select_service_type']}} @else — @endif</span>
                                                        </p>
                                                        
                                                        <p>
                                                            <span>ACTIVITY LOCATION:</span>
                                                            <span>{{$book_details['businessservices']['activity_location']}}</span>
                                                        </p> 

                                                        <p>
                                                            <span>ACTIVITY DURATION:</span>
                                                            <span>{{$book_details['reserve_time']}}</span>
                                                        </p>

                                                        <p>
                                                            <span>GREAT FOR:</span>
                                                            <span>{{$book_details['businessservices']['activity_for']}}</span>
                                                        </p>
                                                       
                                                        <p>
                                                            <span>PARTICIPANTS:</span>
                                                            <span><?php $a = json_decode($book_details['participate']);
                                                                if( !empty($a->adult) ){ echo 'Adult: '.$a->adult; }
                                                                if( !empty($a->child) ){ echo '<br> Child: '.$a->child; }
                                                                if( !empty($a->infant) ){ echo '<br>Infant: '.$a->infant; }
                                                            ?>
                                                            </span>
                                                        </p>
                                                        <p>
                                                            <span>WHO IS PARTICIPATING?</span>
                                                            <span> <?php $a = json_decode($book_details['participate_name'],true); 
                                                                    if(!empty($a)){
                                                                        foreach($a as $data){
                                                                            echo $data['pc_name']."<br>";
                                                                        }
                                                                    }
                                                                ?></span>
                                                        </p>
                                                    </div>
                                                    <div class="foterboxes">
                                                        <div class="threebtn_fboxes">
                                                           <!--  <a href="#">Check In</a> -->
                                                            <a href="{{route('personal.schedulers.index',['odid' => $book_details['orderdetailid'] ])}}" target="_blank">Schedule</a>
                                                           <!-- <button class="canclebtn" type="button" onclick="cancelorder({{@$book_details['user_booking_detail']['id']}});">Cancel</button> -->
                                                        </div>
                                                        <div class="threebtn_fboxes" id="anothertwobtn{{$i}}_{{$book_details['businessservices']['id']}}" style="display:none;">
                                                            <!-- <a href="{{$book_details['acc_url']}}" target="_blank">View Account</a> -->
                                                            <a href="<?php echo config('app.url'); ?>/businessprofile/<?php echo strtolower(str_replace(' ', '', $book_details['company_name'])).'/'.$book_details['company_id']; ?>" target="_blank">View Provider</a>
                                                        </div>
                                                        <!-- <div class="icon">
                                                            <span><img src="{{ url('public/img/map.png') }}" alt=""></span>
                                                            <span><img src="{{ url('public/img/message.png') }}" alt=""></span>
                                                        </div> -->
                                                        <div class="viewmore_links">
                                                            <a id="viewmore_cu_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>" style="display:block">View More <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                                            <a id="viewless_cu_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>" style="display:none">View Less <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                                        </div>
                                                        <script>
                                                            $("#viewmore_cu_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").click(function () {
                                                                $("#current_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").addClass("intro");
                                                                $("#viewless_cu_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").show();
                                                                $("#viewmore_cu_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").hide();
                                                                $("#anothertwobtn<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").show();
                                                            });
                                                            $("#viewless_cu_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").click(function () {
                                                                $("#current_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").removeClass("intro");
                                                                $("#viewless_cu_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").hide();
                                                                $("#viewmore_cu_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").show();
                                                                $("#anothertwobtn<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").hide();
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                        @php  $i++;@endphp
                                        @endforeach
                                    @endif
                                    </div>
                                </div> 

                                <div class="tab-pane" id="nav-today" role="tabpanel" aria-labelledby="nav-today-tab">
                                    <div class="col-lg-12 col-md-12 book-info-sear">
                                        <div class='row'>
                                            <div class="col-md-3 col-sm-12">
                                                <p><b>Today Date: <?php echo date('l'); echo", ";echo date('F d , Y')?> </b></p>
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
                                    @php  $i = 1;
                                        $br = new \App\Repositories\BookingRepository;
                                        $BookingDetail = $br->getdeepdetailoforder($Booking_Detail,'today');
                                    @endphp
                                    @if(!empty($BookingDetail))
                                    @foreach($BookingDetail as $book_details)
                                        <div class="col-md-4 col-sm-6 ">
                                            <div class="boxes_arts">
                                                <div class="headboxes">
                                                    <img src="{{ $book_details['pro_pic']  }}" class="imgboxes" alt="">
                                                    <h4 class="fontsize">{{$book_details['program_name']}}</h4>
                                                    <a class="openreceiptmodel" orderid = '{{$book_details["orderid"]}}' orderdetailid="{{$book_details['orderdetailid']}}">
                                                        <i class="fas fa-file-alt file-booking-receipt" aria-hidden="true"></i>
                                                    </a>
                                                    <div class="highlighted_box">Confirmed</div>
                                                </div>
                                                <div class="middleboxes middletoday" id="today_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>">
                                                    <p>
                                                        <span>BOOKING CONFIRMATION #</span>
                                                        <span>{{$book_details['confirm_id']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>PRICE OPTION:</span>
                                                        <span>{{@$book_details['price_title']}} - {{@$book_details['pay_session']}} Sessions
                                                        
                                                        </span>
                                                    </p>
                                                    <p>
                                                        <span>TOTAL REMAINING:</span>
                                                        <span>{{@$book_details['SpotsLeftdis']}} / {{@$book_details['spots_available']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>DATE SCHEDULED:</span>
                                                        <span>{{@$book_details['sc_date']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>RESERVED TIMED:</span>
                                                        <span>@php if(@$book_details['shift_start']!=''){
                                                            echo date('h:ia', strtotime( @$book_details['shift_start'] )); 
                                                        }
                                                        if(@$book_details['shift_end']!=''){
                                                            echo ' to '.date('h:ia', strtotime( @$book_details['shift_end'] )); 
                                                        }@endphp</span>
                                                    </p>
                                                    <p>
                                                        <span>TOTAL PRICE</span>
                                                        <span>${{@$book_details['main_total']}} </span>
                                                    </p>
                                                    
                                                    <p>
                                                        <span>BOOKED BY:</span>
                                                        <span>{{@$book_details['name']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>ACTIVITY TYPE:</span>
                                                        <span>{{$book_details['businessservices']['sport_activity']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>SERVICE TYPE:</span>
                                                        <span>@if($book_details['businessservices']['select_service_type'] != '') {{$book_details['businessservices']['select_service_type']}} @else — @endif</span>
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
                                                        <span>{{@$book_details['language']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>PARTICIPANTS:</span>
                                                        <span>
                                                        <?php $a = json_decode($book_details['participate']);
                                                            if( !empty($a->adult) ){ echo 'Adult: '.$a->adult; }
                                                            if( !empty($a->child) ){ echo '<br> Child: '.$a->child; }
                                                            if( !empty($a->infant) ){ echo '<br>Infant: '.$a->infant; }
                                                        ?>
                                                        </span>
                                                    </p>
                                                    <p>
                                                        <span>SKILL LEVEL:</span>
                                                        <span> {{$book_details['businessservices']['difficult_level']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>MEMBERSHIP TYPE:</span>
                                                        <span>{{$book_details['membership_type']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>BUSINESS TYPE:</span>
                                                        <span>{{@$book_details['b_type']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>WHO IS PARTICIPATING?</span>
                                                        <span> <?php $a = json_decode($book_details['participate_name'],true); 
                                                                if(!empty($a)){
                                                                    foreach($a as $data){
                                                                        if($data['from'] == 'family'){
                                                                            $family = UserFamilyDetail::where('id',$data['id'])->first();
                                                                            echo @$family->first_name.' '.@$family->last_name."<br>";
                                                                        }else{ ?>
                                                                             {{@$book_details['name']}}
                                                                        <?php echo "<br>"; } 
                                                                    } 
                                                                }
                                                            ?></span>
                                                    </p>
                                                    <p>
                                                        <span>COMPANY:</span>
                                                        <span>{{ $book_details['company_name'] }}</span>
                                                    </p>
                                                </div>
                                                <div class="foterboxes">
                                                    <div class="threebtn_fboxes">
                                                       <!--  <a href="#">Check In</a> 
                                                       <button class="canclebtn" type="button" onclick="cancelorder({{@$book_details['user_booking_detail']['id']}});">Cancel</button> -->
                                                      <!--  <a href="{{$book_details['acc_url']}}" target="_blank">View Account</a> -->
                                                    </div>
                                                    <div class="threebtn_fboxes" id="anothertwobtn{{$i}}_{{$book_details['businessservices']['id']}}" style="display:none;">
                                                        <a href="<?php echo config('app.url'); ?>/businessprofile/<?php echo strtolower(str_replace(' ', '', $book_details['company_name'])).'/'.$book_details['company_id']; ?>" target="_blank">View Provider</a>
                                                    </div>
                                                    <!-- <div class="icon">
                                                        <span><img src="{{ url('public/img/map.png') }}" alt=""></span>
                                                        <span><img src="{{ url('public/img/message.png') }}" alt=""></span>
                                                    </div> -->
                                                    <div class="viewmore_links">
                                                        <a id="viewmore_to_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>" style="display:block">View More <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                                        <a id="viewless_to_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>" style="display:none">View Less <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                                    </div>
                                                    <script>
                                                        $("#viewmore_to_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").click(function () {
                                                            $("#today_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").addClass("intro");
                                                            $("#viewless_to_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").show();
                                                            $("#viewmore_to_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").hide();
                                                            $("#anothertwobtn<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").show();
                                                        });
                                                        $("#viewless_to_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").click(function () {
                                                            $("#today_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").removeClass("intro");
                                                            $("#viewless_to_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").hide();
                                                            $("#viewmore_to_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").show();
                                                            $("#anothertwobtn<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").hide();
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
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
                                    @php  $i = 1;
                                        $br = new \App\Repositories\BookingRepository;
                                        $BookingDetail = $br->getdeepdetailoforder($Booking_Detail,'upcoming');
                                    @endphp
                                    @if(!empty($BookingDetail))
                                    @foreach($BookingDetail as $book_details)
                                        <div class="col-md-4 col-sm-6 ">
                                            <div class="boxes_arts">
                                                <div class="headboxes">
                                                    <img src="{{ $book_details['pro_pic']  }}" class="imgboxes" alt="">
                                                    <h4 class="fontsize">{{$book_details['program_name']}}</h4>
                                                    <a class="openreceiptmodel" orderid = '{{$book_details["orderid"]}}' orderdetailid="{{$book_details['orderdetailid']}}">
                                                        <i class="fas fa-file-alt file-booking-receipt" aria-hidden="true"></i>
                                                    </a>
                                                    <div class="highlighted_box">Confirmed</div>
                                                </div>
                                                <div class="middleboxes middleupcoming" id="upcoming_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>">
                                                    <p>
                                                        <span>BOOKING CONFIRMATION #</span>
                                                        <span>{{$book_details['confirm_id']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>PRICE OPTION:</span>
                                                        <span>{{@$book_details['price_title']}} - {{@$book_details['pay_session']}} Sessions
                                                        
                                                        </span>
                                                    </p>
                                                    <p>
                                                        <span>TOTAL REMAINING:</span>
                                                        <span>{{@$book_details['SpotsLeftdis']}} / {{@$book_details['spots_available']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>DATE SCHEDULED:</span>
                                                        <span>{{@$book_details['sc_date']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>RESERVED TIMED:</span>
                                                        <span>@php if(@$book_details['shift_start']!=''){
                                                            echo date('h:ia', strtotime( @$book_details['shift_start'] )); 
                                                        }
                                                        if(@$book_details['shift_end']!=''){
                                                            echo ' to '.date('h:ia', strtotime( @$book_details['shift_end'] )); 
                                                        }@endphp</span>
                                                    </p>
                                                    <p>
                                                        <span>TOTAL PRICE</span>
                                                        <span>${{@$book_details['main_total']}} </span>
                                                    </p>
                                                    
                                                    <p>
                                                        <span>BOOKED BY:</span>
                                                        <span>{{@$book_details['name']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>ACTIVITY TYPE:</span>
                                                        <span>{{$book_details['businessservices']['sport_activity']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>SERVICE TYPE:</span>
                                                        <span>@if($book_details['businessservices']['select_service_type'] != '') {{$book_details['businessservices']['select_service_type']}} @else — @endif</span>
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
                                                        <span>{{@$book_details['language']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>PARTICIPANTS:</span>
                                                        <span>
                                                        <?php $a = json_decode($book_details['participate']);
                                                            if( !empty($a->adult) ){ echo 'Adult: '.$a->adult; }
                                                            if( !empty($a->child) ){ echo '<br> Child: '.$a->child; }
                                                            if( !empty($a->infant) ){ echo '<br>Infant: '.$a->infant; }
                                                        ?>
                                                        </span>
                                                    </p>
                                                    <p>
                                                        <span>SKILL LEVEL:</span>
                                                        <span> {{$book_details['businessservices']['difficult_level']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>MEMBERSHIP TYPE:</span>
                                                        <span>{{$book_details['membership_type']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>BUSINESS TYPE:</span>
                                                        <span>{{@$book_details['b_type']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>WHO IS PARTICIPATING?</span>
                                                        <span> <?php $a = json_decode($book_details['participate_name'],true); 
                                                                if(!empty($a)){
                                                                    foreach($a as $data){
                                                                        if($data['from'] == 'family'){
                                                                            $family = UserFamilyDetail::where('id',$data['id'])->first();
                                                                            echo @$family->first_name.' '.@$family->last_name."<br>";
                                                                        }else{ ?>
                                                                             {{@$book_details['name']}}
                                                                        <?php echo "<br>"; } 
                                                                    } 
                                                                }
                                                            ?></span>
                                                    </p>
                                                    <p>
                                                        <span>COMPANY:</span>
                                                        <span>{{ $book_details['company_name'] }}</span>
                                                    </p>
                                                </div>
                                                <div class="foterboxes">
                                                    <div class="threebtn_fboxes">
                                                       <!--  <a href="#">Check In</a> 
                                                       <button class="canclebtn" type="button" onclick="cancelorder({{@$book_details['user_booking_detail']['id']}});">Cancel</button> -->
                                                       <!-- <a href="{{$book_details['acc_url']}}" target="_blank">View Account</a> -->
                                                    </div>
                                                    <div class="threebtn_fboxes" id="anothertwobtn{{$i}}_{{$book_details['businessservices']['id']}}" style="display:none;">
                                                        <a href="<?php echo config('app.url'); ?>/businessprofile/<?php echo strtolower(str_replace(' ', '', $book_details['company_name'])).'/'.$book_details['company_id']; ?>" target="_blank">View Provider</a>
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
                                                            $("#anothertwobtn<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").show();
                                                        });
                                                        $("#viewless<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").click(function () {
                                                            $("#upcoming_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").removeClass("intro");
                                                            $("#viewless<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").hide();
                                                            $("#viewmore<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").show();
                                                            $("#anothertwobtn<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").hide();
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
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
                                    @php  $i = 1;
                                        $br = new \App\Repositories\BookingRepository;
                                        $BookingDetail = $br->getdeepdetailoforder($Booking_Detail,'past');
                                    @endphp
                                    @if(!empty($BookingDetail))
                                    @foreach($BookingDetail as $book_details)
                                        <div class="col-md-4 col-sm-6 ">
                                            <div class="boxes_arts">
                                                <div class="headboxes">
                                                    <img src="{{ $book_details['pro_pic']  }}" class="imgboxes" alt="">
                                                    <h4 class="fontsize">{{$book_details['program_name']}}</h4>
                                                    <a class="openreceiptmodel" orderid = '{{$book_details["orderid"]}}' orderdetailid="{{$book_details['orderdetailid']}}">
                                                        <i class="fas fa-file-alt file-booking-receipt" aria-hidden="true"></i>
                                                    </a>
                                                    <div class="highlighted_box">Confirmed</div>
                                                </div>
                                                <div class="middleboxes middletoday" id="past_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>">
                                                    <p>
                                                        <span>BOOKING CONFIRMATION #</span>
                                                        <span>{{$book_details['confirm_id']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>PRICE OPTION:</span>
                                                        <span>{{@$book_details['price_title']}} - {{@$book_details['pay_session']}} Sessions
                                                        
                                                        </span>
                                                    </p>
                                                    <p>
                                                        <span>TOTAL REMAINING:</span>
                                                        <span>{{@$book_details['SpotsLeftdis']}} / {{@$book_details['spots_available']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>DATE SCHEDULED:</span>
                                                        <span>{{@$book_details['sc_date']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>RESERVED TIMED:</span>
                                                        <span>@php if(@$book_details['shift_start']!=''){
                                                            echo date('h:ia', strtotime( @$book_details['shift_start'] )); 
                                                        }
                                                        if(@$book_details['shift_end']!=''){
                                                            echo ' to '.date('h:ia', strtotime( @$book_details['shift_end'] )); 
                                                        }@endphp</span>
                                                    </p>
                                                    <p>
                                                        <span>TOTAL PRICE</span>
                                                        <span>${{@$book_details['main_total']}} </span>
                                                    </p>
                                                    
                                                    <p>
                                                        <span>BOOKED BY:</span>
                                                        <span>{{@$book_details['name']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>ACTIVITY TYPE:</span>
                                                        <span>{{$book_details['businessservices']['sport_activity']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>SERVICE TYPE:</span>
                                                        <span>@if($book_details['businessservices']['select_service_type'] != '') {{$book_details['businessservices']['select_service_type']}} @else — @endif</span>
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
                                                        <span>{{@$book_details['language']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>PARTICIPANTS:</span>
                                                        <span>
                                                        <?php $a = json_decode($book_details['participate']);
                                                            if( !empty($a->adult) ){ echo 'Adult: '.$a->adult; }
                                                            if( !empty($a->child) ){ echo '<br> Child: '.$a->child; }
                                                            if( !empty($a->infant) ){ echo '<br>Infant: '.$a->infant; }
                                                        ?>
                                                        </span>
                                                    </p>
                                                    <p>
                                                        <span>SKILL LEVEL:</span>
                                                        <span> {{$book_details['businessservices']['difficult_level']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>MEMBERSHIP TYPE:</span>
                                                        <span>{{$book_details['membership_type']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>BUSINESS TYPE:</span>
                                                        <span>{{@$book_details['b_type']}}</span>
                                                    </p>
                                                    <p>
                                                        <span>WHO IS PARTICIPATING?</span>
                                                        <span> <?php $a = json_decode($book_details['participate_name'],true); 
                                                                if(!empty($a)){
                                                                    foreach($a as $data){
                                                                        if($data['from'] == 'family'){
                                                                            $family = UserFamilyDetail::where('id',$data['id'])->first();
                                                                            echo @$family->first_name.' '.@$family->last_name."<br>";
                                                                        }else{ ?>
                                                                             {{@$book_details['name']}}
                                                                        <?php echo "<br>"; } 
                                                                    } 
                                                                }
                                                            ?></span>
                                                    </p>
                                                    <p>
                                                        <span>COMPANY:</span>
                                                        <span>{{ $book_details['company_name'] }}</span>
                                                    </p>
                                                </div>
                                                <div class="foterboxes">
                                                    <div class="threebtn_fboxes">
                                                       <!--  <a href="#">Check In</a> -->
                                                       <a href="{{route('activities_show',['serviceid' => $book_details['businessservices']['id'] ])}}" target="_blank">Rebook</a>
                                                        <!-- <button class="canclebtn" type="button" onclick="cancelorder({{@$book_details['user_booking_detail']['id']}});">Cancel</button> -->
                                                    </div>
                                                    <div class="threebtn_fboxes" id="anothertwobtn{{$i}}pa_{{$book_details['businessservices']['id']}}" style="display:none;">
                                                        <!-- <a href="{{$book_details['acc_url']}}" target="_blank">View Account</a> -->
                                                        <a href="<?php echo config('app.url'); ?>/businessprofile/<?php echo strtolower(str_replace(' ', '', $book_details['company_name'])).'/'.$book_details['company_id']; ?>" target="_blank">View Provider</a>
                                                    </div>
                                                    <!-- <div class="icon">
                                                        <span><img src="{{ url('public/img/map.png') }}" alt=""></span>
                                                        <span><img src="{{ url('public/img/message.png') }}" alt=""></span>
                                                    </div> -->
                                                    <div class="viewmore_links">
                                                        <a id="viewmore_pa_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>" style="display:block">View More <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                                        <a id="viewless_pa_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>" style="display:none">View Less <img src="{{ url('public/img/arrow-down.png') }}" alt=""></a>
                                                    </div>
                                                    <script>
                                                        $("#viewmore_pa_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").click(function () {
                                                            $("#past_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").addClass("intro");
                                                            $("#viewless_pa_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").show();
                                                            $("#viewmore_pa_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").hide();
                                                            $("#anothertwobtn<?php echo $i.'pa_'.$book_details['businessservices']['id']; ?>").show();
                                                        });
                                                        $("#viewless_pa_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").click(function () {
                                                            $("#past_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").removeClass("intro");
                                                            $("#viewless_pa_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").hide();
                                                            $("#viewmore_pa_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>").show();
                                                             $("#anothertwobtn<?php echo $i.'pa_'.$book_details['businessservices']['id']; ?>").hide();
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        @php  $i++;@endphp
                                    @endforeach
                                    @endif
                                    </div>
                                </div><!-- tab-pane -->

                                 <div class="tab-pane" id="nav-pending" role="tabpanel" aria-labelledby="nav-pending-tab">
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
                                                    <input type="text"  id="dateserchfilter_pending" placeholder="Search By Date" class="form-control booking-date w-80">
                                                    <i class="far fa-calendar-alt"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <label for="">Search:</label>
                                                <input type="search" id="search_pending" placeholder="See by Businesses Booked" class="form-control w-85" onkeyup="getsearchdata('pending');">
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="row" id="searchbydate_pending">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="bookingreceipt" role="dialog">
    <div class="modal-dialog modal-lg booking-receipt">
        <div class="modal-content">
            <div class="modal-header" style="text-align: right;"> 
                <div class="row">
                    <div class="col-md-12 text-center">
                       <label class="pay-confirm"> Booking & Payment Confirmed</label>
                    </div>
                    <div class="closebtn booking-pmt-close">
                        <button type="button" class="close close-btn-design booking-pmt-close-btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="receiptbody">
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
<!-- <script src="{{ url('public/js/compare/jquery-1.9.1.min.js') }}"></script> -->
<script>

    $( document ).ready(function() {
        var tabvalue = '{{$tabvalue}}';
        if(tabvalue == 'upcoming'){
            $('#nav-upcoming').addClass("active");
            $('#nav-upcoming-tab').addClass("active");
            $('#nav-past-tab').removeClass("active");
            $('#nav-today-tab').removeClass("active");
            $('#nav-current-tab').removeClass("active");
            $('#nav-pending-tab').removeClass("active");
        }else if(tabvalue == 'past'){
            $('#nav-past').addClass("active");
            $('#nav-past-tab').addClass("active");
            $('#nav-upcoming-tab').removeClass("active");
            $('#nav-today-tab').removeClass("active");
            $('#nav-current-tab').removeClass("active");
            $('#nav-pending-tab').removeClass("active");
        }else if(tabvalue == 'today'){
            $('#nav-today').addClass("active");
            $('#nav-today-tab').addClass("active");
            $('#nav-upcoming-tab').removeClass("active");
            $('#nav-past-tab').removeClass("active");
            $('#nav-current-tab').removeClass("active");
            $('#nav-pending-tab').removeClass("active");
        }else if(tabvalue == 'pending'){
            $('#nav-pending').addClass("active");
            $('#nav-pending-tab').addClass("active");
            $('#nav-past-tab').removeClass("active");
            $('#nav-today-tab').removeClass("active");
            $('#nav-upcoming-tab').removeClass("active");
            $('#nav-current-tab').removeClass("active");
        }else{
            $('#nav-current').addClass("active");
            $('#nav-current-tab').addClass("active");
            $('#nav-past-tab').removeClass("active");
            $('#nav-today-tab').removeClass("active");
            $('#nav-upcoming-tab').removeClass("active");
            $('#nav-pending-tab').removeClass("active");
        }
        $("input[id=dateserchfilter_today]").change(function(){
            var date = $(this).val();
            var type = 'today';
            $.ajax({
                type: "post",
                url:'{{route("datefilterdata")}}',
                data:{"_token":"{{csrf_token()}}" ,"date":date ,'type':type,"page":"personal"},
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
                data:{"_token":"{{csrf_token()}}" ,"date":date ,'type':type,"page":"personal"},
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
                data:{"_token":"{{csrf_token()}}" ,"date":date ,'type':type,"page":"personal"},
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


        $(document).on('click', '.openreceiptmodel', function(e){
            var orderdetailid = $(this).attr("orderdetailid");
            var orderid =$(this).attr('orderid');
            jQuery.noConflict();
            $.ajax({
                url: "{{route('getreceiptmodel')}}",
                xhrFields: {
                        withCredentials: true
                    },
                type: 'get',
                data:{
                    orderdetailid:orderdetailid,
                    orderid:orderid,
                },
                success: function (response) {
                    $("#bookingreceipt").modal('show');
                    $('#receiptbody').html(response);
                }
            });
        });
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
            data:{"_token":"{{csrf_token()}}" ,"text":text ,"type":type,"page":"personal"},
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
    

    
    $('.booking_date1').datepicker({
        dateFormat: "mm/dd/yy"
    })
    $('.booking_date2').datepicker({
        dateFormat: "mm/dd/yy"
    })
    $('.booking_date3').datepicker({
        dateFormat: "mm/dd/yy"
    })
    $('.booking-date').datepicker({
        dateFormat: "mm/dd/yy"
    })

    
</script>

<script type="text/javascript">

    function cancelorder(bookingid) {
        $.ajax({
            url: "{{route('cancelbooking')}}",
            xhrFields: {
                withCredentials: true
            },
            type: 'get',
            data:{
                bookingid:bookingid,
            },
            success: function (response) {
               /* $('.reviewerro').html('');
                $('.reviewerro').css('display','block');
                if(response == 'success'){
                    $('.reviewerro').html('Email Successfully Sent..');
                }else{
                    $('.reviewerro').html("Can't Mail on this Address. Plese Check your Email..");
                }*/
            }
        });
    }

    function  changecolor(id){
     /*   alert(id);*/
        if(id === 'nav-upcoming-tab'){
            $('#'+id).addClass("active");
            $('#nav-past-tab').removeClass("active");
            $('#nav-today-tab').removeClass("active");
            $('#nav-current-tab').removeClass("active");
            $('#nav-pending-tab').removeClass("active");
        }else if(id === 'nav-past-tab'){
            $('#'+id).addClass("active");
            $('#nav-upcoming-tab').removeClass("active");
            $('#nav-today-tab').removeClass("active");
            $('#nav-current-tab').removeClass("active");
            $('#nav-pending-tab').removeClass("active");
        }else if(id === 'nav-today-tab'){
            $('#'+id).addClass("active");
            $('#nav-upcoming-tab').removeClass("active");
            $('#nav-past-tab').removeClass("active");
            $('#nav-current-tab').removeClass("active");
            $('#nav-pending-tab').removeClass("active");
        }else if(id === 'nav-current-tab'){
            $('#'+id).addClass("active");
            $('#nav-past-tab').removeClass("active");
            $('#nav-today-tab').removeClass("active");
            $('#nav-upcoming-tab').removeClass("active");
            $('#nav-pending-tab').removeClass("active");
        }else{
            $('#'+id).addClass("active");
            $('#nav-past-tab').removeClass("active");
            $('#nav-today-tab').removeClass("active");
            $('#nav-upcoming-tab').removeClass("active");
            $('#nav-current-tab').removeClass("active");
        }
    }

    function valid(email)
    {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test(email); //this will either return true or false based on validation
    }

    function sendemail(odetailid,oid){
        $('.reviewerro').html('');
        var email = $('#email').val();
        if(email == ''){
            $('.reviewerro').css('display','block');
            $('.reviewerro').html('Please Add Email Address..');
        }else if(!valid(email)){
            $('.reviewerro').css('display','block');
            $('.reviewerro').html('Please Enter Valid Email Address..');
        }else{
            $('.btn-modal-booking').attr('disabled',true);
            $('.reviewerro').css('display','block');
            $('.reviewerro').html('Sending...');
            $.ajax({
                url: "{{route('sendemailofreceipt')}}",
                xhrFields: {
                    withCredentials: true
                },
                type: 'get',
                data:{
                    odetailid:odetailid,
                    oid:oid,
                    email:email,
                },
                success: function (response) {
                    $('.reviewerro').html('');
                    $('.reviewerro').css('display','block');
                    if(response == 'success'){
                        $('.reviewerro').html('Email Successfully Sent..');
                    }else{
                        $('.reviewerro').html("Can't Mail on this Address. Plese Check your Email..");
                    }
                }
            });
        }
    }
</script>
@endsection