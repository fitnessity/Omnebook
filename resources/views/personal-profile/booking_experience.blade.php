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
                                    <li> <a href="/personal-profile/gym-studio-info"> Gym/Studio </a> </li>
                                    <li> <a href="/personal-profile/experience-info" class="active"> Experiences </a> </li>
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
                                        <?php
                                            $data = UserBookingStatus::where('id',$book_details['user_booking_detail']['booking_id'])->first();
                                            $scheduleddata = json_decode(@$book_details['user_booking_detail']['booking_detail'],true);
                                            $sc_date = date("m-d-Y", strtotime($scheduleddata['sessiondate']));
                                            $sc_date = str_replace('-', '/', $sc_date);  
                                        ?>

                                        @if(date('Y-m-d',strtotime($sc_date)) == date('Y-m-d'))
                                        <?php 
                                            $servicedata = BusinessActivityScheduler::where(['serviceid' => @$book_details['user_booking_detail']['sport'],'id' => $book_details['user_booking_detail']['act_schedule_id']])->first();

                                            $BusinessPriceDetails = BusinessPriceDetails::where(['id'=>@$book_details['user_booking_detail']['priceid'],'serviceid' =>@$book_details['user_booking_detail']['sport']])->first();

                                            if(@$book_details['businessservices']['service_type']=='individual'){ 
                                                $b_type = 'Personal Training'; 
                                            }else { 
                                                $b_type =ucfirst($book_details['businessservices']['service_type']); 
                                            }

                                            if ($book_details['businessservices']['profile_pic']!="") {
                                                if(str_contains($book_details['businessservices']['profile_pic'], ',')){
                                                    $pic_image = explode(',', $book_details['businessservices']['profile_pic']);
                                                    if( $pic_image[0] == ''){
                                                       $p_image  = $pic_image[1];
                                                    }else{
                                                        $p_image  = $pic_image[0];
                                                    }
                                                }else{
                                                    $p_image = $book_details['businessservices']['profile_pic'];
                                                }

                                                if (file_exists( public_path() . '/uploads/profile_pic/' . $p_image)) {
                                                   $pro_pic = url('/public/uploads/profile_pic/' . $p_image);
                                                }else {
                                                   $pro_pic = url('/public/images/service-nofound.jpg');
                                                }

                                            }else{ $pro_pic = '/public/images/service-nofound.jpg'; }

                                            $today = date('Y-m-d');
                                            $SpotsLeftdis = 0;
                                            $SpotsLeft = UserBookingDetail::where(['act_schedule_id' => $book_details['user_booking_detail']['act_schedule_id']])->whereDate('bookedtime', '=', date('Y-m-d'))->get()->toArray();

                                            $totalquantity = 0;
                                            foreach($SpotsLeft as $data1){
                                                $item = json_decode($data1['qty'],true);
                                                if($item['adult'] != '')
                                                    $totalquantity += $item['adult'];
                                                if($item['child'] != '')
                                                    $totalquantity += $item['child'];
                                                if($item['infant'] != '')
                                                    $totalquantity += $item['infant'];
                                            }
                                            if( @$servicedata['spots_available'] != ''){
                                                $SpotsLeftdis = $servicedata['spots_available'] - $totalquantity;
                                            }

                                            $language_name = BusinessService::where('cid',@$book_details['businessservices']['cid'])->first(); 
                                            $language = $language_name->languages;
                                            $booking_details_for_sub_total = UserBookingDetail::where('booking_id',$book_details['user_booking_detail']['booking_id'])->get();
                                            $sub_totprice = 0;
                                            foreach( $booking_details_for_sub_total as $bds){
                                                $aprice = json_decode($bds->price,true); 
                                                $sub_price_adu = $sub_price_chi = $sub_price_inf = 0;
                                                if( !empty($aprice['adult']) ){ 
                                                    $sub_price_adu = $aprice['adult']; 
                                                }
                                                if( !empty($aprice['child']) ){
                                                    $sub_price_chi = $aprice['child']; 
                                                }
                                                if( !empty($aprice['infant']) ){
                                                    $sub_price_inf = $aprice['infant']; 
                                                }

                                                $a = json_decode($bds->qty,true);
                                                if( !empty($a['adult']) ){  
                                                    $sub_totprice += $sub_price_adu * $a['adult'];
                                                }
                                                if( !empty($a['child']) ){
                                                    $sub_totprice += $sub_price_chi * $a['child'];
                                                }
                                                if( !empty($a['infant']) ){ 
                                                    $sub_totprice += $sub_price_inf * $a['infant'];
                                                }
                                            }

                                            $tot_amount_cart = 0;
                                            if(@$book_details['amount'] != ''){
                                                $tot_amount_cart = @$book_details['amount'];
                                            }
                                            
                                            $taxval = 0;
                                            $taxval = $tot_amount_cart - $sub_totprice; 
                                            
                                            $tax_for_this = $taxval / count(@$booking_details_for_sub_total);

                                            $aprice = json_decode(@$book_details['user_booking_detail']['price'],true); 
                                            $aprice_adu = $aprice_chi = $aprice_inf = 0;
                                            if( !empty($aprice['adult']) ){ 
                                                $aprice_adu = $aprice['adult']; 
                                            }
                                            if( !empty($aprice['child']) ){
                                                $aprice_chi = $aprice['child']; 
                                            }
                                            if( !empty($aprice['infant']) ){
                                                $aprice_inf = $aprice['infant']; 
                                            }

                                            $qty = '';
                                            $totprice_for_this = 0;
                                            $a = json_decode(@$book_details['user_booking_detail']['qty'],true);
                                            if( !empty($a['adult']) ){ 
                                                $qty .= 'Adult: '.$a['adult']; 
                                                $totprice_for_this += $aprice_adu * $a['adult'];
                                            }
                                            if( !empty($a['child']) ){
                                                $qty .= '<br> Child: '.$a['child']; 
                                                $totprice_for_this += $aprice_chi * $a['child'];
                                            }
                                            if( !empty($a['infant']) ){
                                                $qty .= '<br>Infant: '.$a['infant']; 
                                                $totprice_for_this += $aprice_inf * $a['infant'];
                                            }

                                            $main_total =  $tax_for_this + $totprice_for_this;
                                        ?>
                                            <div class="col-md-4 col-sm-6 ">
                                                <div class="boxes_arts">
                                                    <div class="headboxes">
                                                        <img src="{{ $pro_pic  }}" class="imgboxes" alt="">
                                                        <h4 class="fontsize">{{$book_details['businessservices']['program_name']}}</h4>
                                                        <a class="openreceiptmodel" orderid = '{{$book_details["id"]}}' orderdetailid="{{$book_details['user_booking_detail']['id']}}">
                                                            <i class="fas fa-file-alt file-booking-receipt" aria-hidden="true"></i>
                                                        </a>
                                                        <div class="highlighted_box">Confirmed</div>
                                                    </div>
                                                    <div class="middleboxes middletoday" id="today_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>">
                                                        <p>
                                                            <span>BOOKING CONFIRMATION #</span>
                                                            <span>{{$data->order_id}}</span>
                                                        </p>
                                                        <p>
                                                            <span>PRICE OPTION:</span>
                                                            <span>{{@$BusinessPriceDetails['price_title']}} - {{@$BusinessPriceDetails['pay_session']}} Sessions</span>
                                                        </p>
                                                        <p>
                                                            <span>TOTAL REMAINING:</span>
                                                            <span>{{$SpotsLeftdis}} / {{ @$servicedata['spots_available'] }}</span>
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
                                                            <span>${{@$main_total}} </span>
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
                                                           <!--  <a href="{{route('activities_show',['serviceid' => $book_details['businessservices']['id'] ])}}" target="_blank">Schedule</a>
                                                            <a href="#">Cancel</a> -->
                                                        </div>
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
                                            $sc_date = date("m-d-Y", strtotime($scheduleddata['sessiondate']));
                                            $sc_date = str_replace('-', '/', $sc_date);  
                                        @endphp
                                        @if(date('Y-m-d',strtotime($sc_date)) > date('Y-m-d'))
                                            <?php $servicedata = BusinessActivityScheduler::where(['serviceid' => @$book_details['user_booking_detail']['sport'],'id' => $book_details['user_booking_detail']['act_schedule_id']])->first();

                                                $BusinessPriceDetails = BusinessPriceDetails::where(['id'=>@$book_details['user_booking_detail']['priceid'],'serviceid' =>@$book_details['user_booking_detail']['sport']])->first();

                                                if(@$book_details['businessservices']['service_type']=='individual')
                                                { 
                                                    $b_type = 'Personal Training'; 
                                                }else { 
                                                    $b_type =ucfirst($book_details['businessservices']['service_type']); 
                                                }

                                                if ($book_details['businessservices']['profile_pic']!="") {
                                                    if(str_contains($book_details['businessservices']['profile_pic'], ',')){
                                                        $pic_image = explode(',', $book_details['businessservices']['profile_pic']);
                                                        if( $pic_image[0] == ''){
                                                           $p_image  = $pic_image[1];
                                                        }else{
                                                            $p_image  = $pic_image[0];
                                                        }
                                                    }else{
                                                        $p_image = $book_details['businessservices']['profile_pic'];
                                                    }

                                                    if (file_exists( public_path() . '/uploads/profile_pic/' . $p_image)) {
                                                       $pro_pic = url('/public/uploads/profile_pic/' . $p_image);
                                                    }else {
                                                       $pro_pic = url('/public/images/service-nofound.jpg');
                                                    }

                                                }else{ $pro_pic = '/public/images/service-nofound.jpg'; }

                                                $today = date('Y-m-d');
                                                $SpotsLeftdis = 0;
                                                $SpotsLeft = [];
                                                $SpotsLeft = UserBookingDetail::where(['act_schedule_id' => $book_details['user_booking_detail']['act_schedule_id'], 'id' => $book_details['user_booking_detail']['id'] , 'booking_id' => $book_details['id']])->whereDate('bookedtime', '=', $book_details['user_booking_detail']['bookedtime'])->get()->toArray();
                                                
                                                $totalquantity = 0;
                                                foreach($SpotsLeft as $data1){
                                                    $item = json_decode($data1['qty'],true);
                                                    if($item['adult'] != '')
                                                        $totalquantity += $item['adult'];
                                                    if($item['child'] != '')
                                                        $totalquantity += $item['child'];
                                                    if($item['infant'] != '')
                                                        $totalquantity += $item['infant'];
                                                }
                                                if( @$servicedata['spots_available'] != ''){
                                                    $SpotsLeftdis =  @$servicedata['spots_available'] - $totalquantity;
                                                }

                                                $language_name = BusinessService::where('cid',@$book_details['businessservices']['cid'])->first(); 
                                                $language = $language_name->languages;
                                                $booking_details_for_sub_total = UserBookingDetail::where('booking_id',$book_details['user_booking_detail']['booking_id'])->get();
                                            $sub_totprice = 0;
                                            foreach( $booking_details_for_sub_total as $bds){
                                                $aprice = json_decode($bds->price,true); 
                                                $sub_price_adu = $sub_price_chi = $sub_price_inf = 0;
                                                if( !empty($aprice['adult']) ){ 
                                                    $sub_price_adu = $aprice['adult']; 
                                                }
                                                if( !empty($aprice['child']) ){
                                                    $sub_price_chi = $aprice['child']; 
                                                }
                                                if( !empty($aprice['infant']) ){
                                                    $sub_price_inf = $aprice['infant']; 
                                                }

                                                $a = json_decode($bds->qty,true);
                                                if( !empty($a['adult']) ){  
                                                    $sub_totprice += $sub_price_adu * $a['adult'];
                                                }
                                                if( !empty($a['child']) ){
                                                    $sub_totprice += $sub_price_chi * $a['child'];
                                                }
                                                if( !empty($a['infant']) ){ 
                                                    $sub_totprice += $sub_price_inf * $a['infant'];
                                                }
                                            }

                                            $tot_amount_cart = 0;
                                            if(@$book_details['amount'] != ''){
                                                $tot_amount_cart = @$book_details['amount'];
                                            }
                                            
                                            $taxval = 0;
                                            $taxval = $tot_amount_cart - $sub_totprice; 
                                            
                                            $tax_for_this = $taxval / count(@$booking_details_for_sub_total);

                                            $aprice = json_decode(@$book_details['user_booking_detail']['price'],true); 
                                            $aprice_adu = $aprice_chi = $aprice_inf = 0;
                                            if( !empty($aprice['adult']) ){ 
                                                $aprice_adu = $aprice['adult']; 
                                            }
                                            if( !empty($aprice['child']) ){
                                                $aprice_chi = $aprice['child']; 
                                            }
                                            if( !empty($aprice['infant']) ){
                                                $aprice_inf = $aprice['infant']; 
                                            }

                                            $qty = '';
                                            $totprice_for_this = 0;
                                            $a = json_decode(@$book_details['user_booking_detail']['qty'],true);
                                            if( !empty($a['adult']) ){ 
                                                $qty .= 'Adult: '.$a['adult']; 
                                                $totprice_for_this += $aprice_adu * $a['adult'];
                                            }
                                            if( !empty($a['child']) ){
                                                $qty .= '<br> Child: '.$a['child']; 
                                                $totprice_for_this += $aprice_chi * $a['child'];
                                            }
                                            if( !empty($a['infant']) ){
                                                $qty .= '<br>Infant: '.$a['infant']; 
                                                $totprice_for_this += $aprice_inf * $a['infant'];
                                            }

                                            $main_total =  $tax_for_this + $totprice_for_this;
                                            ?>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="boxes_arts">
                                                    <div class="headboxes">
                                                        <img src="{{  $pro_pic  }}" class="imgboxes" alt="">
                                                        <h4>{{$book_details['businessservices']['program_name']}}</h4>
                                                        <a class="openreceiptmodel" orderid = '{{$book_details["id"]}}' orderdetailid="{{$book_details['user_booking_detail']['id']}}">
                                                            <i class="fas fa-file-alt file-booking-receipt" aria-hidden="true"></i>
                                                        </a>
                                                        <div class="highlighted_box">Confirmed</div>
                                                    </div>
                                                    <div class="middleboxes middletoday" id="upcoming_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>">
                                                        <p>
                                                            <span>BOOKING CONFIRMATION #</span>
                                                            <span>{{$data->order_id}}</span>
                                                        </p>
                                                        <p>
                                                            <span>PRICE OPTION:</span>
                                                            <span>{{@$BusinessPriceDetails['price_title']}} - {{@$BusinessPriceDetails['pay_session']}} Sessions</span>
                                                        </p>
                                                        <p>
                                                            <span>TOTAL REMAINING:</span>
                                                            <span>{{$SpotsLeftdis}} / {{ @$servicedata['spots_available']}}</span>
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
                                                            <span>${{@$main_total}} </span>
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
                                                            <!-- <a href="{{route('activities_show',['serviceid' => $book_details['businessservices']['id'] ])}}" target="_blank">Schedule</a>
                                                            <a href="#">Cancel</a> -->
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
                                    @php  $i = 1;@endphp
                                    @if(!empty($BookingDetail))
                                    @foreach($BookingDetail as $book_details)
                                        @php
                                            $data = UserBookingStatus::where('id',$book_details['user_booking_detail']['booking_id'])->first();
                                            $scheduleddata = json_decode(@$book_details['user_booking_detail']['booking_detail'],true);
                                            $sc_date = date("m-d-Y", strtotime($scheduleddata['sessiondate']));
                                            $sc_date = str_replace('-', '/', $sc_date);  
                                        @endphp
                                        @if(date('Y-m-d',strtotime($sc_date)) < date('Y-m-d'))
                                            <?php
                                            $servicedata  = '';
                                            $servicedata = BusinessActivityScheduler::where(['serviceid' => @$book_details['user_booking_detail']['sport'],'id' => $book_details['user_booking_detail']['act_schedule_id']])->first();

                                            $BusinessPriceDetails = BusinessPriceDetails::where(['id'=>@$book_details['user_booking_detail']['priceid'],'serviceid' =>@$book_details['user_booking_detail']['sport']])->first();

                                            if(@$book_details['businessservices']['service_type']=='individual')
                                            { 
                                                $b_type = 'Personal Training'; 
                                            }else { 
                                                $b_type =ucfirst($book_details['businessservices']['service_type']); 
                                            }
                                           
                                            if ($book_details['businessservices']['profile_pic']!="") {
                                                if(str_contains($book_details['businessservices']['profile_pic'], ',')){
                                                    $pic_image = explode(',', $book_details['businessservices']['profile_pic']);
                                                    if( $pic_image[0] == ''){
                                                       $p_image  = $pic_image[1];
                                                    }else{
                                                        $p_image  = $pic_image[0];
                                                    }
                                                }else{
                                                    $p_image = $book_details['businessservices']['profile_pic'];
                                                }

                                                if (file_exists( public_path() . '/uploads/profile_pic/' . $p_image)) {
                                                   $pro_pic = url('/public/uploads/profile_pic/' . $p_image);
                                                }else {
                                                   $pro_pic = url('/public/images/service-nofound.jpg');
                                                }

                                            }else{ $pro_pic = '/public/images/service-nofound.jpg'; }

                                            $today = date('Y-m-d');
                                            $SpotsLeftdis = 0;
                                            $SpotsLeft = [];
                                            $SpotsLeft = UserBookingDetail::where(['act_schedule_id' => $book_details['user_booking_detail']['act_schedule_id']])->whereDate('bookedtime', '=', $book_details['user_booking_detail']['bookedtime'])->get()->toArray();
                                            
                                             $totalquantity = 0;
                                            foreach($SpotsLeft as $data1){
                                               
                                                $item = json_decode($data1['qty'],true);
                                                if($item['adult'] != '')
                                                    $totalquantity += $item['adult'];
                                                if($item['child'] != '')
                                                    $totalquantity += $item['child'];
                                                if($item['infant'] != '')
                                                    $totalquantity += $item['infant'];
                                            }
                                            if( @$servicedata['spots_available'] != ''){
                                                $SpotsLeftdis =  @$servicedata['spots_available'] - $totalquantity;
                                            }


                                            $language_name = BusinessService::where('cid',@$book_details['businessservices']['cid'])->first(); 
                                            $language = $language_name->languages; 
                                            $booking_details_for_sub_total = UserBookingDetail::where('booking_id',$book_details['user_booking_detail']['booking_id'])->get();
                                            $sub_totprice = 0;
                                            foreach( $booking_details_for_sub_total as $bds){
                                                $aprice = json_decode($bds->price,true); 
                                                $sub_price_adu = $sub_price_chi = $sub_price_inf = 0;
                                                if( !empty($aprice['adult']) ){ 
                                                    $sub_price_adu = $aprice['adult']; 
                                                }
                                                if( !empty($aprice['child']) ){
                                                    $sub_price_chi = $aprice['child']; 
                                                }
                                                if( !empty($aprice['infant']) ){
                                                    $sub_price_inf = $aprice['infant']; 
                                                }

                                                $a = json_decode($bds->qty,true);
                                                if( !empty($a['adult']) ){  
                                                    $sub_totprice += $sub_price_adu * $a['adult'];
                                                }
                                                if( !empty($a['child']) ){
                                                    $sub_totprice += $sub_price_chi * $a['child'];
                                                }
                                                if( !empty($a['infant']) ){ 
                                                    $sub_totprice += $sub_price_inf * $a['infant'];
                                                }
                                            }

                                            $tot_amount_cart = 0;
                                            if(@$book_details['amount'] != ''){
                                                $tot_amount_cart = @$book_details['amount'];
                                            }
                                            
                                            $taxval = 0;
                                            $taxval = $tot_amount_cart - $sub_totprice; 
                                            
                                            $tax_for_this = $taxval / count(@$booking_details_for_sub_total);

                                            $aprice = json_decode(@$book_details['user_booking_detail']['price'],true); 
                                            $aprice_adu = $aprice_chi = $aprice_inf = 0;
                                            if( !empty($aprice['adult']) ){ 
                                                $aprice_adu = $aprice['adult']; 
                                            }
                                            if( !empty($aprice['child']) ){
                                                $aprice_chi = $aprice['child']; 
                                            }
                                            if( !empty($aprice['infant']) ){
                                                $aprice_inf = $aprice['infant']; 
                                            }

                                            $qty = '';
                                            $totprice_for_this = 0;
                                            $a = json_decode(@$book_details['user_booking_detail']['qty'],true);
                                            if( !empty($a['adult']) ){ 
                                                $qty .= 'Adult: '.$a['adult']; 
                                                $totprice_for_this += $aprice_adu * $a['adult'];
                                            }
                                            if( !empty($a['child']) ){
                                                $qty .= '<br> Child: '.$a['child']; 
                                                $totprice_for_this += $aprice_chi * $a['child'];
                                            }
                                            if( !empty($a['infant']) ){
                                                $qty .= '<br>Infant: '.$a['infant']; 
                                                $totprice_for_this += $aprice_inf * $a['infant'];
                                            }

                                            $main_total =  $tax_for_this + $totprice_for_this;
                                        ?>
                                            <div class="col-md-4 col-sm-6">
                                                <div class="boxes_arts">
                                                    <div class="headboxes">
                                                        <img src="{{ $pro_pic }}" class="imgboxes" alt="">
                                                        <h4>{{$book_details['businessservices']['program_name']}}</h4>
                                                        <a class="openreceiptmodel" orderid = '{{$book_details["id"]}}' orderdetailid="{{$book_details['user_booking_detail']['id']}}">
                                                            <i class="fas fa-file-alt file-booking-receipt" aria-hidden="true"></i>
                                                        </a>
                                                        <div class="highlighted_box">Confirmed</div>
                                                    </div>
                                                    <div class="middleboxes middletoday" id="past_<?php echo $i.'_'.$book_details['businessservices']['id']; ?>">
                                                        <p>
                                                            <span>BOOKING CONFIRMATION #</span>
                                                            <span>{{$data->order_id}}</span>
                                                        </p>
                                                        <p>
                                                            <span>PRICE OPTION:</span>
                                                            <span>{{@$BusinessPriceDetails['price_title']}} - {{@$BusinessPriceDetails['pay_session']}} Sessions</span>
                                                        </p>
                                                        <p>
                                                            <span>TOTAL REMAINING:</span>
                                                            <span>{{$SpotsLeftdis}} / {{ @$servicedata['spots_available']}}</span>
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
                                                            <span>${{@$main_total}} </span>
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
                                                            <!-- <a href="{{route('activities_show',['serviceid' => $book_details['businessservices']['id'] ])}}" target="_blank">Schedule</a>
                                                            <a href="#">Cancel</a> -->
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
<div class="modal" id="bookingreceipt" role="dialog">
    <div class="modal-dialog modal-lg booking-receipt">
        <div class="modal-content">
            <div class="modal-header" style="text-align: right;"> 
                <div class="closebtn">
                    <button type="button" class="close close-btn-design" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
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

<script>

    $( document ).ready(function() {
       
        $("input[id=dateserchfilter_today]").change(function(){
            var date = $(this).val();
            var type = 'today';
            $.ajax({
                type: "post",
                url:'{{route("datefilterdata")}}',
                data:{"_token":"{{csrf_token()}}" ,"date":date ,'type':type,"page":"experience"},
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
                data:{"_token":"{{csrf_token()}}" ,"date":date ,'type':type,"page":"experience"},
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
                data:{"_token":"{{csrf_token()}}" ,"date":date ,'type':type,"page":"experience"},
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
            data:{"_token":"{{csrf_token()}}" ,"text":text ,"type":type,"page":"experience"},
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

</script>

<script type="text/javascript">

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