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
<?php use App\UserFamilyDetail;?>

<div class="page-wrapper inner_top" id="wrapper">
    <div class="page-container">
        <!-- Left Sidebar Start -->
         @include('personal-profile.left_panel')
        <!-- Left Sidebar End -->
        <div class="page-content-wrapper">
            <div class="content-page">
                <div class="container-fluid">
                    <div class="page-title-box">
                        <h4 class="page-title">BOOKINGS INFO & PURCHASE HISTORY @if(request()->business_id 
                            != '') FOR {{strtoupper($customer->full_name)}} @endif </h4>
                    </div>

                    @if(request()->business_id == '')
                        <div class="payment_info_section padding-2 white-bg border-radius1 purchases-bt">
                            <div class="booking-history selecting-pro">
                                <h3>Start by selecting a provider</h3>
                                <p>You can view your bookings and purchases history.</p>
                                <p>You can view the online schedule,make reservations,rebook or cancel an activity</p>
                            </div>
                            <div class="row">
                                @foreach($business as $bs)
                                <div class="col-md-4 col-sm-6">
                                    <div class="booking-info-history">
                                        <div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/add-family.png );">
                                            <h2>{{ $bs->company_name}}</h2>
                                            <p>{{$bs->company_address()}}</p>
                                            <div class="booking-activity">
                                                <span> Active Memberships: {{$bs->active_memberships_count_by_user_id()}}</span>
                                                <span> Completed Memberships: {{$bs->completed_memberships_count_by_user_id()}} </span>
                                                <span> Expiring Memberships: {{$bs->expired_soon_memberships_count_by_user_id()}} </span>
                                                <span> Number of visits: {{$bs->visits_count_by_user_id()}} </span>
                                            </div>
                                            
                                            <div class="booking-activity-view">
                                                <a class="view-booking" href="{{route('personal.orders.index',['business_id'=>$bs->id])}}"> View Bookings</a>
                                                <a class="view-schedule" href="{{route('business_activity_schedulers',['business_id'=>$bs->id])}}"> View Schedule</a>
                                            </div>
                                         </div>
                                     </div>
                                </div>
                                @endforeach
                                <div class="" style="display:none;">
                                    <div class="col-md-12">
                                        <div class="text-right btn-txt-pro">
                                            <button type="submit" class="btn-nxt-profile">PREV </button>
                                            <button type="submit" class="btn-nxt-profile">NEXT </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="booking-info-menu">
                            <div class='row'>
                                <div class="col-lg-7 col-md-6 col-sm-12">
                                    <ul>
                                        <li> <a href="{{route('personal.orders.index',array_merge(request()->query(), ['serviceType'=> null]))}}" @if(!request()->serviceType) class="active" @endif> All </a> </li>

                                        <li> <a href="{{route('personal.orders.index',array_merge(request()->query(), ['serviceType'=>'individual']))}}" @if(request()->serviceType == 'individual') class="active" @endif> Personal Trainer </a> </li>
                                        <li> <a href="{{route('personal.orders.index', array_merge(request()->query(), ['serviceType'=>'classes']))}}"  @if(request()->serviceType == 'classes') class="active" @endif>Classes </a> </li>
                                        <li> <a href="{{route('personal.orders.index',array_merge(request()->query(), ['serviceType'=>'events']))}}"  @if(request()->serviceType == 'events') class="active" @endif> Events </a> </li>
                                        <li> <a href="{{route('personal.orders.index',array_merge(request()->query(), ['serviceType'=>'experience']))}}"  @if(request()->serviceType == 'experience') class="active" @endif> Experiences </a> </li>
                                        
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
                                                <div class="col-md-2 col-sm-6 nopadding">
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
                                                        <input type="text"  id="dateserchfilter_current" placeholder="Search By Date" class="form-control booking-date w-80" data-behavior="datepicker">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6">
                                                    <label for="">Search:</label>
                                                    <input type="search" id="search_current" placeholder="See by Businesses Booked" class="form-control w-85 search-wid" onkeyup="getsearchdata('current');">
                                                </div>
												<div class="col-md-2 col-sm-12 nopadding">
													<a href="#" class="access-req booking-access-req" style="background: #0a9410">Access Granted</a>
                                                </div>
                                                <div class="col-md-2 col-sm-3" style="padding-top: 7px;">
                                                    <a href="{{route('remove_grant_access',['id'=>request()->business_id ])}}">Remove Access</a>
                                                </div>
                                            </div>
											<!-- Modal Start -->
											<!-- <div class="modal fade compare-model" id="accessreq">
												<div class="modal-dialog modal-lg business">
													<div class="modal-content">
														<div class="modal-header" style="text-align: right;"> 
															<div class="closebtn">
																<button type="button" class="close close-btn-design btn-grant" data-dismiss="modal" aria-label="Close">
																	<span aria-hidden="true">×</span>
																</button>
															</div>
														</div>

														<div class="modal-body">
															<div class="row contentPop"> 
																<div class="col-lg-12">
																	<div class="modal-access-autho">
																		<h4 class="modal-title">Access Authorization</h4>
																		<span>to {provider Name}</span>
																	</div>
																</div>
																<div class="col-lg-12">
																	<div class="autho-inner-txt">
																		<p>Your in control of what information is shared. Allow the provider the abilility to seamlessly sync to your Fitnessity account, and take what’s needed to complete your sign up process so you don’t have to do extra work.</p>
																		<label>Note: <p class="sync-req">You must approve all current & future account sync request</p></label>
																	</div>
																	<div class="granting-access">
																		<p>Take a look at what your granting access to. First time account syncs requires all information in order to complete bookings. Any future snyc request, you have control over what is shared.</p>
																		<div class="check-access">
																			<input type="checkbox" id="myCheck">
																			<label for="myCheck"> Name </label> 
																		</div>
																		<div class="check-access">
																			<input type="checkbox" id="myCheck">
																			<label for="myCheck"> Age </label> 
																		</div>
																		<div class="check-access">
																			<input type="checkbox" id="myCheck">
																			<label for="myCheck"> Phone number  </label> 
																		</div>
																		<div class="check-access">
																			<input type="checkbox" id="myCheck">
																			<label for="myCheck"> Address </label> 
																		</div>
																		<div class="check-access">
																			<input type="checkbox" id="myCheck">
																			<label for="myCheck"> Email </label> 
																		</div>
																		<div class="check-access">
																			<input type="checkbox" id="myCheck">
																			<label for="myCheck"> Booking & purchase history with requesting provider </label> 
																		</div>
																		<div class="check-access">
																			<input type="checkbox" id="myCheck">
																			<label for="myCheck"> Added family & family booking & purchase history</label> 
																		</div>
																		<div class="check-access">
																			<input type="checkbox" id="myCheck">
																			<label for="myCheck">Credit Card Information (for faster payment process)</label> 
																		</div>
																		
																	</div>
																</div>
																<div class="col-lg-12 btns-modal">
																	<button class="addbusiness-btn-modal acc-btn-grant">Grant Access</button>
																</div>
															 </div>
														</div>
													</div>
												</div>
											</div> -->
											<!-- Modal End -->
                                        </div>
                                    
                                        <div class="row"  id="searchbydate_current">
                                            @php $i = 1; @endphp
                                            @include('personal.orders._user_booking_detail', ['bookingDetail' => $currentbookingstatus, 'tabname' => 'current'])
                                        </div>
                                    </div> 

                                    <div class="tab-pane" id="nav-today" role="tabpanel" aria-labelledby="nav-today-tab">
                                        <div class="col-lg-12 col-md-12 book-info-sear">
                                            <div class='row'>
                                                <div class="col-md-2 col-sm-12 nopadding">
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
                                                        <input type="text"  id="dateserchfilter_today" placeholder="Search By Date" class="form-control booking-date w-80" data-behavior="datepicker">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-12">
                                                    <label for="">Search:</label>
                                                    <input type="search" id="search_today" placeholder="See by Businesses Booked" class="form-control w-85" onkeyup="getsearchdata('today');">
                                                </div>
                                                <div class="col-md-2 col-sm-12 nopadding">
                                                    <a href="#" class="access-req booking-access-req" style="background: #0a9410">Access Granted</a>
                                                </div>
                                                <div class="col-md-2 col-sm-12 " style="padding-top: 7px;">
                                                    <a href="{{route('remove_grant_access',['id'=>request()->business_id ])}}">Remove Access</a>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="row"  id="searchbydate_today">
                                            @php  $i = 1;
                                                $br = new \App\Repositories\BookingRepository;
                                                $BookingDetail = $br->tabFilterData($bookingDetails,'today',request()->serviceType);
                                            @endphp
                                            @include('personal.orders._user_booking_detail', ['bookingDetail' => @$BookingDetail, 'tabname' => 'today'])
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="nav-upcoming" role="tabpanel" aria-labelledby="nav-upcoming-tab">
                                        <div class="col-lg-12 col-md-12 book-info-sear">
                                            <div class='row'>
                                                <div class="col-md-2 col-sm-12 nopadding">
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
                                                        <input type="text"  id="dateserchfilter_upcoming" placeholder="Search By Date" class="form-control booking-date w-80" data-behavior="datepicker">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-12">
                                                    <label for="">Search:</label>
                                                    <input type="search" id="search_upcoming" placeholder="See by Businesses Booked" class="form-control w-85" onkeyup="getsearchdata('upcoming');">
                                                </div>
                                                <div class="col-md-2 col-sm-12 nopadding">
                                                    <a href="#" class="access-req booking-access-req" style="background: #0a9410">Access Granted</a>
                                                </div>
                                                <div class="col-md-2 col-sm-12 " style="padding-top: 7px;">
                                                    <a href="{{route('remove_grant_access',['id'=>request()->business_id ])}}">Remove Access</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="searchbydate_upcoming">
                                            @php  $i = 1;
                                                $br = new \App\Repositories\BookingRepository;
                                                $BookingDetail = $br->tabFilterData($bookingDetails,'upcoming',request()->serviceType);
                                            @endphp
                                            @include('personal.orders._user_booking_detail', ['bookingDetail' => @$BookingDetail, 'tabname' => 'upcoming']);

                                        </div>
                                    </div><!-- tab panel-->

                                    <div class="tab-pane" id="nav-past" role="tabpanel" aria-labelledby="nav-past-tab">
                                        <div class="col-lg-12 col-md-12 book-info-sear">
                                            <div class='row'>
                                                <div class="col-md-2 col-sm-12 nopadding">
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
                                                        <input type="text"  id="dateserchfilter_past" placeholder="Search By Date" class="form-control booking-date w-80" data-behavior="datepicker">
                                                        <i class="far fa-calendar-alt"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-12">
                                                    <label for="">Search:</label>
                                                    <input type="search" id="search_past" placeholder="See by Businesses Booked" class="form-control w-85" onkeyup="getsearchdata('past');">
                                                </div>
                                                <div class="col-md-2 col-sm-12 nopadding">
                                                    <a href="#" class="access-req booking-access-req" style="background: #0a9410">Access Granted</a>
                                                </div>
                                                <div class="col-md-2 col-sm-12 " style="padding-top: 7px;">
                                                    <a href="{{route('remove_grant_access',['id'=>request()->business_id ])}}">Remove Access</a>
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="row" id="searchbydate_past">
                                         @php  $i = 1;
                                            $br = new \App\Repositories\BookingRepository;
                                            $BookingDetail = $br->tabFilterData($bookingDetails,'past',request()->serviceType);
                                        @endphp
                                        @include('personal.orders._user_booking_detail', ['bookingDetail' => @$BookingDetail, 'tabname' => 'past']) 
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@include('layouts.footer')
<script>

    $( document ).ready(function() {
        var tabValue = '{{$tabval}}';
        if(tabValue == 'upcoming')
        {
            $('#nav-upcoming').addClass("active");
            $('#nav-upcoming-tab').addClass("active");
            $('#nav-past-tab').removeClass("active");
            $('#nav-today-tab').removeClass("active");
            $('#nav-current-tab').removeClass("active");
            $('#nav-pending-tab').removeClass("active");
        }else if(tabValue == 'past')
        {
            $('#nav-past').addClass("active");
            $('#nav-past-tab').addClass("active");
            $('#nav-upcoming-tab').removeClass("active");
            $('#nav-today-tab').removeClass("active");
            $('#nav-current-tab').removeClass("active");
            $('#nav-pending-tab').removeClass("active");
        }else if(tabValue == 'today')
        {
            $('#nav-today').addClass("active");
            $('#nav-today-tab').addClass("active");
            $('#nav-upcoming-tab').removeClass("active");
            $('#nav-past-tab').removeClass("active");
            $('#nav-current-tab').removeClass("active");
            $('#nav-pending-tab').removeClass("active");
        }else if(tabValue == 'pending')
        {
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

</script>

@endsection