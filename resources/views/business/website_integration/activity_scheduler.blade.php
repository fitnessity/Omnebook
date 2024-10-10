@inject('request', 'Illuminate\Http\Request')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fitnessity</title>   
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="Fitnessity: Because Fitness=Necessity" name="description" />
	<meta content="" name="author" />
	<meta name="csrf-token" content="{{ csrf_token() }}"> 
    <link href="{{ asset('/dashboard-design/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel='stylesheet' type='text/css' href="{{asset('/css/bootstrap-select.min.css')}}">
	<link href="{{ url('/public/dashboard-design/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/public/dashboard-design/css/custom.css')}}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="{{url('public/dashboard-design/css/icons.min.css')}}">
	<link href="{{url('public/dashboard-design/css/responsive.css')}}" rel="stylesheet" type="text/css" />
    <link rel='stylesheet' type='text/css' href="{{url('public/css/owl.css')}}">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{url('public/css/all.css')}}">
    <link href="{{url('public/css/frontend/jquery-ui.css')}}" rel='stylesheet'>
    <script src="{{url('public/dashboard-design/js/jquery-ui.min.js')}}"></script>
</head>
<style>
	.navbar-menu .navbar-nav .nav-link.active{
		color: #fff;
	}
	.card-fix{
		height: 144px;
	}
    body
	{
		overflow: hidden;
	}
</style>
<body>    
    @php  use App\ActivityCancel; 
    use App\Repositories\BookingRepository;     
    $service_type_ary = array("all","classes","individual","events","experience");@endphp
    <div class="app-menu navbar-menu" >
        <div class="navbar-brand-box">
            <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover"> <i class="ri-record-circle-line"></i> </button>
        </div>
        <div id="scrollbar">
                <div id="two-column-menu">
                </div>
                <ul class="navbar-nav dash-sidebar-menu" id="navbar-nav">
                    <div class="d-flex align-items-center c-padding">
                    <div class="avatar-xsmall me-2">
                                <span class="mini-stat-icon avatar-title xsmall-font rounded-circle text-success bg-soft-red fs-4 uppercase">N S</span>
                            </div>
                        <div class="font-white flex-grow-1">{{$company->public_company_name}}.</div>
                    </div>
                    <li class="menu-title border-bottom width-250">
                        <span class="font-white switch-business" data-key="t-menu">Welcome {{$company->public_company_name}}</span>
                    </li>
                    <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link active" href="#" aria-controls="sidebarDashboards" onclick="dashboard()">
                            <img src="https://dev.fitnessity.co//public/img/social-profile.png" alt="Fitnessity"> <span data-key="t-dashboards">Dashboard</span>
                        </a>
                    </li>
                    
                    {{-- <li class="nav-item">
                        <a class="nav-link menu-link" href="#" aria-controls="sidebarDashboards">
                            <img src="https://dev.fitnessity.co//public/img/social-profile.png" alt="Fitnessity"> <span data-key="t-dashboards">View Social Profile</span>
                        </a>
                    </li>
                     --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link " href="#" aria-controls="sidebarDashboards">
                            <img src="https://dev.fitnessity.co//public/img/edit-2.png" alt="Fitnessity"> <span data-key="t-dashboards">Edit Profile &amp; Password </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('*business_activity_schedulers*') || request()->is('*multibooking*') ? 'active' : '' }}" onclick="Schedule()" aria-controls="sidebarDashboards">
                            <img src="{{asset('/public/img/schedule-1.png')}}" alt="Fitnessity">
                            <span data-key="t-dashboards"> Schedule</span>
                        </a>					
                    </li>
                
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('*payment-history*') ? 'active' : '' }}" onclick="PaymentHistory()" aria-controls="sidebarDashboards">
                            <img src="{{asset('/img/payment.png')}}" alt="Fitnessity"> <span data-key="t-dashboards">Payment History</span>
                        </a>
                    </li>
    
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('*creditcards*') ? 'active' : '' }}" onclick="CreditCard()" aria-controls="sidebarDashboards">
                            <img src="{{asset('/public/img/credit-card.png')}}" alt="Fitnessity"> <span data-key="t-dashboards"> Credit Card </span>
                        </a>
                    </li>  
                    <li class="nav-item">
                        {{-- <a class="nav-link menu-link" href="{{route('logout_n'.$business->unique_code)}}" aria-controls="sidebarDashboards">
                            <img src="https://dev.fitnessity.co//public/img/social-profile.png" alt="Fitnessity"> <span data-key="t-dashboards">Logout</span>
                        </a> --}}
                            <a id="logoutLink" class="nav-link menu-link" href="{{ route('logout_n', ['uniquecode' => $company->unique_code]) }}" aria-controls="sidebarDashboards">
                            <img src="https://dev.fitnessity.co//public/img/social-profile.png" alt="Fitnessity">
                            <span data-key="t-dashboards">Logout</span>
                        </a>
                        
                    </li>
                </ul>
            <!-- Sidebar -->
        </div>
        <div class="sidebar-background"></div>
    </div>
    <div id="your-login-widget-container">
    </div>
    <div class="main-content">
		<div class="md-25">
                <div class="container-fluid">
                   <div class="row mb-3">
                        <div class="col-12">
                            <div class="page-heading text-center mt-2">
                                <h2>{{$companyName}}</h2>
                                <p>Booking Schedule for {{ucwords(@$customer->full_name)}}</p>
                                {{-- <p>If you already have a membership with multiple sessions. Reserve your spot here.<br> If you don’t already have a membership, <a href="{{route('activities_index')}}">Book Here </a></p> --}}
                            </div>
                        </div>
                    </div><!--end row-->
                    
                    <div class="row">
                        <div class="col-12 ">
                            <div class="card">
                                <div class="container p-0 inner-top-activity text-center">
                                    <div class="col-md-12 col-xs-12 ">
                                        <div class="activity-schedule-tabs">
                                            <ul class="nav nav-tabs" role="tablist">
                                                @foreach($service_type_ary as $st)
                                                    <li @if($serviceType == $st ) class="active" @endif>
                                                        <a class="nav-link" href="{{$request->fullUrlWithQuery(['stype' => $st])}}"  aria-expanded="true">@if( $st == 'individual') PRIVATE LESSONS @else {{strtoupper($st)}} @endif</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                            <div class="tab-content" style="min-height: 600px;">
                                                @foreach($service_type_ary as $st)
                                                <div class="tab-pane @if($serviceType == $st ) active @endif" id="tabs-{{$st}}" role="tabpanel">
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12 col-xs-12 text-right">
                                                            <div class="calendar-icon">
                                                                <input type="text" name="date" class="date datepicker" readonly placeholder="DD/MM/YYYY" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="owl-carousel owl-theme schedulers-arrows">
                                                        @foreach ($days as $date)
                                                            @php
                                                                $hint_class = ($filter_date->format('Y-m-d') == $date->format('Y-m-d')) ? 'pairets' : 'pairets-inviable';
                                                            @endphp
                                                            <div class="item">
                                                                <div class="{{$hint_class}}">
                                                                    <a href="{{$request->fullUrlWithQuery(['date' => $date->format('Y-m-d')])}}" class="calendar-btn">{{$date->format("D d")}}</a>
                                                                </div>
                                                            </div>

                                                        @endforeach
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="tab-data">
                                                        <div class="row">
                                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                                <div class="checkout-sapre-tor">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4 col-xs-12 valor-mix-title">
                                                                <label>Activities on {{$filter_date->format("l, F j")}}</label>
                                                            </div>
                                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                                <div class="checkout-sapre-tor">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="activity-tabs">
                                                            @php $categoryList = []; @endphp
                                                            @if($serviceType == $st && !empty($services))
                                                            
                                                                @foreach($services as $ser)
                                                                    @php  
                                                                        if($priceid != ''){
                                                                            $pricelist =  @$ser->price_details()->find($priceid);
                                                                            if(@$pricelist->business_price_details_ages){
                                                                                $categoryList [] = @$pricelist->business_price_details_ages;
                                                                            }
                                                                        }else{
                                                                            foreach(@$ser->BusinessPriceDetailsAges as $cat){
                                                                                $categoryList [] = $cat;
                                                                            }
                                                                        }
                                                                    @endphp
                                                                @endforeach
    
                                                                @php 	
                                                                    function customKeySort($a, $b) {
                                                                        $timeA = strtotime($a);
                                                                        $timeB = strtotime($b);
                                                                        
                                                                        if ($timeA == $timeB) {
                                                                            return 0;
                                                                        }
                                                                        return ($timeA < $timeB) ? -1 : 1;
                                                                    }
                                                                    $schedule = [];
                                                                    foreach($categoryList as $c){
                                                                        foreach($c->BusinessActivityScheduler as $sc){
                                                                            if($sc->end_activity_date >= $filter_date->format('Y-m-d') && $sc->starting <= $filter_date->format('Y-m-d')){
                                                                                if(strpos($sc->activity_days, $filter_date->format('l')) !== false){
                                                                                    $cancelSc = $sc->activity_cancel->where('cancel_date',$filter_date->format('Y-m-d'))->first();
                                                                                    $hide_cancel = @$cancelSc->hide_cancel_on_schedule;
                                                                                    if(@$cancelSc->cancel_date_chk == 0 ){
                                                                                        $hide_cancel = 0;
                                                                                    }
                                                                                    if($hide_cancel == '' || $hide_cancel != 1 ){
                                                                                        $schedule[$sc->shift_start][] = $c;
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
    
                                                                    uksort($schedule, 'customKeySort');
                                                                    $categoryListFull = [];
                                                                    foreach ($schedule as $value) {
                                                                        $categoryListFull = array_merge($categoryListFull, (array)$value);
                                                                    }
                                                                    $categoryListFull = array_unique($categoryListFull);
                                                                @endphp 
    
                                                                @if(!empty($categoryListFull) && count($categoryListFull)>0)
                                                                    @foreach($categoryListFull as $cList)
                                                                        @php  $sche_ary = [];
                                                                        foreach($cList->BusinessActivityScheduler as $sc){
                                                                            if($sc->end_activity_date >= $filter_date->format('Y-m-d') && $sc->starting <= $filter_date->format('Y-m-d')){
                                                                                if(strpos($sc->activity_days, $filter_date->format('l')) !== false){
                                                                                    $cancelSc = $sc->activity_cancel->where('cancel_date',$filter_date->format('Y-m-d'))->first();
                                                                                    $hide_cancel = @$cancelSc->hide_cancel_on_schedule;
                                                                                    if(@$cancelSc->cancel_date_chk == 0 ){
                                                                                        $hide_cancel = 0;
                                                                                    }
                                                                                    if($hide_cancel == '' || $hide_cancel != 1 ){
                                                                                        $sche_ary [] = $sc;
                                                                                    }
                                                                                }
                                                                            }
                                                                        } 
                                                                        if(!empty($sche_ary)){
                                                                        @endphp
                                                                            <div class="row">
                                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                    <div class="classes-info text-left">
                                                                                        <div class="row">
                                                                                            {{-- 
                                                                                            <div class="col-md-12 col-xs-12">
                                                                                                <label class="fs-16">Schedule: </label> <span class="fs-16">{{@$cList->category_title}}</span>
                                                                                            </div>
                                                                                            --}}
                                                                                            <div class="col-md-12 col-xs-12 ">
                                                                                                <label>Activity Name: </label> <span> {{$cList->BusinessServices->program_name}}</span>
                                                                                            </div>
                                                                                            <div class="col-md-12 col-xs-12">
                                                                                                <div class="text-left line-height-1">
                                                                                                    <label>Activity: </label> <span> {{$cList->BusinessServices->sport_activity}}</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                                                    <div class="row">
                                                                                        @if(!empty($sche_ary))
                                                                                            @foreach($sche_ary as $scary)
                                                                                                @php 
                                                                                                    $duration = $scary->get_duration();
    
                                                                                                    $SpotsLeftdis = 0;
                                                                                                    $bs = new  \App\Repositories\BookingRepository;
                                                                                                    $bookedspot = $bs->gettotalbooking($scary->id,$filter_date->format('Y-m-d')); 
                                                                                                    $SpotsLeftdis = $scary->spots_available - $bookedspot;
                                                                                                    
                                                                                                    $cancel_chk = 0;
                                                                                                    $canceldata = ActivityCancel::where(['cancel_date'=>$filter_date->format('Y-m-d'),'schedule_id'=>$scary->id,'cancel_date_chk'=>1])->first();
                                                                                                    $date = $filter_date->format('Y-m-d');
                                                                                                    $time = $scary->shift_start;
                                                                                                    $st_time = date('Y-m-d H:i:s', strtotime("$date $time"));
                                                                                                    $current  = date('Y-m-d H:i:s');
                                                                                                    $difference = round((strtotime($st_time) - strtotime($current))/3600, 1);
                                                                                                    $timeOfActivity = date('h:i a', strtotime($scary->shift_start));
                                                                                                    $grayBtnChk = 0;$class = '';
                                                                                                    if($filter_date->format('Y-m-d') == date('Y-m-d') ){
                                                                                                        
                                                                                                        $start = new DateTime($scary->shift_start);
                                                                                                        $current = new DateTime();
                                                                                                        $current_time =  $current->format("Y-m-d H:i");
    
                                                                                                        if($cList->BusinessServices->can_book_after_activity_starts == 'No' && $cList->BusinessServices->beforetime != '' && $cList->BusinessServices->beforetimeint != ''){
                                                                                                            $matchTime = $start->modify('-'.$cList->BusinessServices->beforetimeint.' '.$cList->BusinessServices->beforetime)->format("Y-m-d H:i");
                                                                                                            if($current_time > $matchTime){
                                                                                                                $grayBtnChk = 1;
                                                                                                                $class = 'post-btn-gray';
                                                                                                            }
                                                                                                            
                                                                                                        }else if($cList->BusinessServices->can_book_after_activity_starts == 'Yes' && $cList->BusinessServices->beforetime != '' && $cList->BusinessServices->beforetimeint != ''){
                                                                                                            $matchTime = $start->modify('+'.$cList->BusinessServices->aftertimeint.' '.$cList->BusinessServices->aftertime)->format("Y-m-d H:i");
                                                                                                            if($current_time > $matchTime){
                                                                                                                $grayBtnChk = 1;
                                                                                                                $class = 'post-btn-gray';
                                                                                                            }
                                                                                                        }
    
                                                                                                    }
    
    
                                                                                                    if($SpotsLeftdis == 0){
                                                                                                        $grayBtnChk = 2;
                                                                                                        $class = 'post-btn-gray';
                                                                                                    }
    
                                                                                                    if($canceldata != ''){
                                                                                                        $grayBtnChk = 3;
                                                                                                        $class = 'post-btn-gray';
                                                                                                    }
    
                                                                                                    $insName = $scary->getInstructure($filter_date->format('Y-m-d'));
                                                                                                @endphp
    
                                                                                                <!-- $grayBtnChk = 1;
                                                                                                        $class = 'post-btn-gray'; -->
                                                                                                <div class="col-md-4 col-sm-5 col-xs-12">
                                                                                                    <div class="classes-time">
                                                                                                        <button class="post-btn {{$class}} activity-scheduler" onclick="openPopUp({{$scary->id}} , {{$cList->BusinessServices->id}} ,'{{$cList->BusinessServices->program_name}}','{{$timeOfActivity}}',{{$grayBtnChk}},'{{$scary->category_id}}');"  {{ $SpotsLeftdis == 0 ?  "disabled" : ''}}  {{ $canceldata != '' ?  "disabled" : ''}} >{{$timeOfActivity}} <br>{{$duration}}</button>
                                                                                                        <label>{{ $SpotsLeftdis == 0 ? 
                                                                                                            "Sold Out" : $SpotsLeftdis."/".$scary->spots_available."  Spots Left" }}</label>
    
                                                                                                        @if($canceldata != '')<label class="font-red">Cancelled</label>@endif
    
                                                                                                        @if($scary->chkReservedToday($filter_date->format('Y-m-d')) )<label class="font-green">Already Reserved</label>@endif
    
                                                                                                        <label>{{ $insName }}</label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endforeach
                                                                                        @else
                                                                                            <div class="col-md-12 col-sm-6 col-xs-12 noschedule">No Time available</div>
                                                                                        @endif
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12 col-xs-12">
                                                                                        <div class="checkout-sapre-tor">
                                                                                        </div>
                                                                                    </div>
                                                                                </div> 
                                                                        @php } @endphp
                                                                    @endforeach
                                                                @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- container-fluid -->
            </div><!-- End Page-content -->
        </div><!-- end main content-->
    </div><!-- END layout-wrapper -->    
    <div class="modal fade compare-model in modal-middle" id="ajax_html_modal" tabindex="-1" aria-labelledby="mySmallModalLabel" data-bs-focus="false"  aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered" id="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id='booking-time-model'>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade compare-model  modal-middle in selectbooking"  tabindex="-1" aria-labelledby="mySmallModalLabel" data-bs-focus="false"  aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered" id="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id='select-booking-type'>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" aria-labelledby="mySmallModalLabel" data-bs-focus="false"  aria-hidden="true" id="success-reservation">
        <div class="modal-dialog modal-dialog-centered modal-50" id="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" aria-label="Close" onClick="window.location.reload();"></button>
                </div>
                <div class="modal-body" id="receiptbody">
                    <div class="pay-confirm font-green text-center fs-16"></div>
                </div>
            </div>
        </div>
    </div>
<script src="{{url('public/js/owl.js')}}"></script>  
<script src="https://dev.fitnessity.co/public/dashboard-design/js/bootstrap.bundle.min.js"></script>
<script>
	$('.owl-carousel').owlCarousel({
	    loop:true,
	    margin:10,
	    nav:true,
		navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
	    responsive:{
	        0:{
	            items:3
	        },
	        600:{
	            items:3
	        },
	        1000:{
	            items:5
	        }
	    }
		
	});
</script>
<script>
      $(document).on('focus', '[data-behavior~=datepicker]', function(e){
        //jQuery.noConflict();
        $("[data-behavior~=datepicker]").datepicker( { 
           /* minDate: 0,*/
            changeMonth: true,
            changeYear: true ,
            yearRange: '1960:2060',
        });
    });
</script>
<script>
	flatpickr(".flatpickr-range", {
	    dateFormat: "m/d/Y",
	    maxDate: "01/01/2050",
		defaultDate: [new Date()],
	});
</script>
	
<script>
	$(function() {
		$( ".date" ).datepicker({
		 	dateFormat : 'yy-mm-dd',
		 	showOn: "both",
		 	buttonImage: "/public/img/calendar-icon.png",
		 	buttonImageOnly: true,
		 	buttonText: "Select date",
		 	changeMonth: true,
		 	changeYear: true,
		 	minDate: 'today',
		 	yearRange: "0:+20"
		}); 
	});

	$( ".datepicker" ).change(function(){
		var date  = $(this).val();
		var currentUrl = window.location.href;
		var url = new URL(currentUrl);
		var params = new URLSearchParams(url.search);
		if (params.has('date')) {
            params.set('date', date);
        } else {
            params.append('date', date);
        }

        url.search = params.toString();
        var updatedUrl = url.toString();
		window.location = updatedUrl;
    });



    function openPopUp(scheduleId,sid,activityName,time,chk,catId){		
        // if ("{{Auth::check()}}") { 
			if(chk == 1){
	 			$('#select-booking-type').html('<div class="row contentPop"> <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12  text-center"> <div class="modal-inner-txt scheduler-time-txt"><p>You can\'t book this activity for today. The time has passed. Please choose another time.</p></div> </div></div>');
			}else{
				$('#select-booking-type').html('<div class="row contentPop text-center"><div class="col-lg-12 btns-modal"><h4 class="mb-20">Choose How You Would Like To Book</h4><button type="button" class="btn btn-red mb-10" onclick="timeBookingPopUP('+scheduleId+','+sid+',\''+activityName+'\',\''+time+'\','+chk+','+catId+')" id="singletime" data-id="">Book 1 Time Slot</button></div></div>');
			}
			
			$('.selectbooking').modal('show');
		// }
        // else{
		// 	$.ajax({
		// 		url:'{{route("setSessionOfSchedule")}}',
		// 		type: 'POST',
		// 		data:{
		// 			_token: '{{csrf_token()}}',
		// 			businessId : '{{$businessId}}',
		// 		},
		// 		success:function(data){
		// 			 window.location.href = '/userlogin';
		// 		}
		// 	});
		// }
	}


    function timeBookingPopUP(scheduleId,sid,activityName,time,chk,catId) {
    
        var date = '{{$filter_date->format("m/d/Y")}}';
		$('.selectbooking').modal('hide');
		var membershipHtml = '';
		$.ajax({
			url:'{{route("chkOrder_Available")}}',
			type: 'POST',
			data:{
				_token: '{{csrf_token()}}',
				sid : sid,
				cid : '{{@$customer->id}}',
				// priceId : '{{$priceid}}',
				catId : catId,
				businessId : '{{$businessId}}',
			},
			success:function(data){
				if(data == ''){
					html = '<div class="row contentPop"> <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12  text-center"> <div class="modal-inner-txt scheduler-time-txt"><p>You don\'t have a membership for this activity.  </p> <p> Please buy a membership in order to book. </p></div> <a href="/activity-details/'+sid+'" class="btn btn-red">Buy Membership Now </a> </div> </div> ';
				}else{
					html = '<div class="row contentPop"> <div class="col-md-12"> <h4 class="mb-10 lh-25 text-center"> You are booking 1 time slot for '+activityName+' </h4> </div> <div class="col-md-12"> <h4 class="mb-30 lh-25 text-center"> on '+date+' at '+time+' </h4> </div> <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 text-center mb-0"> <div class="modal-inner-txt"> <lable> Select Your Membership To Pay For This </lable> </div> </div> <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 btns-modal mb-20"  id="bookingDetails" >'+data+'</div> <div class="col-lg-12 text-center"> <div class="modal-inner-txt"><p>Are You Sure To Book This Date And Time?</p></div> </div> <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12  text-center"><a onclick="addtimedate('+scheduleId+' ,'+sid+',\''+activityName+'\',\''+time+'\')" class="btn btn-red">Yes</a> <a onclick="closeModal()" class="btn btn-black">No</a> </div> </div>';
				}
				$('#ajax_html_modal').modal('show');
 				$('#booking-time-model').html(html);
			}
		});
	}
    function closeModal() {
        $('#ajax_html_modal').modal('hide');
    }
</script>
<script>
    function addtimedate(scheduleId,sid,activityName,time)
    {
        var priceId = $('#priceId').val();
        var selectedOption = $('#priceId').find("option:selected");
        var oid = selectedOption.attr("data-did");
        let date ='{{$filter_date->format("m-d-Y")}}';
        $.ajax({
            url: "{{route('schedulers_store')}}",
            type: 'POST',
            xhrFields: {
                withCredentials: true
            },
            data:{
                _token: '{{csrf_token()}}',
                date:'{{$filter_date->format("Y-m-d")}}',
                timeid:scheduleId,
                businessId:'{{$businessId}}',
                serviceID:sid,
                customerID:'{{@$customer->id}}',
                priceId:priceId,
                oid:oid,
            },
            success: function (response) { 
                //alert(response);
                if(response == 'success'){
                    $('.pay-confirm').addClass('font-green');
                    $('.pay-confirm').html('<div class="row"><div class="col-md-12"> <h4 class="mb-10 lh-25 text-center"> Booking Confirmed</h4> </div><div class="col-md-12 text-center"><p class="pay-confirm fs-17 font-green">Your reservation for  '+activityName+' '+date+' at '+time +'</p></div></div>');
                    $('#success-reservation').modal('show');
                    $('#ajax_html_modal').modal('hide');
                    $(".activity-tabs").load(location.href+" .activity-tabs>*","");
                }else if(response == 'fail'){
                    $('#booking-time-model').html('<div class="row contentPop"> <div class="col-lg-12 text-center"> <div class="modal-inner-txt scheduler-time-txt"><p>No membership/sessions available to pay for this activity.</p></div> </div> <div class="col-lg-12 btns-modal"><a href="/activity-details/'+sid+'"  class="addbusiness-btn-modal">Buy Membership Now</a></div> </div>');
                    //window.location = '/activity-details/'+sid;
                    //alert('schedule failed');
                }else{
                    $('#booking-time-model').html('<div class="row contentPop"> <div class="col-lg-12 text-center"> <div class="modal-inner-txt scheduler-time-txt"><p>'+response+'</p></div> </div></div>');
                }
                //window.location.reload();
            }
       });
    }
</script>
{{-- <script>
    function handleScheduleClick(event) {
        event.preventDefault();
        localStorage.setItem("scheduler", 'checkedin');
        var url = event.currentTarget.getAttribute('href');
        localStorage.setItem("schedulerurl", url);
        window.location.href = url;
    }
</script> --}}

{{-- <script>
    function clearLocalStorage() {
        event.preventDefault();  
        localStorage.removeItem("schedulerurl");
        localStorage.removeItem("scheduler");
        var url = event.currentTarget.getAttribute('href');
        window.location.href = url;
    }
</script> --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var logoutLink = document.getElementById('logoutLink');	
        if (logoutLink) {
            logoutLink.addEventListener('click', function(event) {
                localStorage.removeItem('loggedin');					
            });
        }
    });
</script>
<script>
    function dashboard()
    {	
        var token = localStorage.getItem('authToken');
        var code = {{$company->id ?? 'null'}};
        var customer = localStorage.getItem('customer');
            var executed = false;
            const url = `https://dev.fitnessity.co/api/customer_dashboard?token=${encodeURIComponent(token)}&code=${encodeURIComponent(code)}&customer_id=${encodeURIComponent(customer)}`;
            if (!executed) {
                window.parent.postMessage({ type: 'changeSrc', src: url }, '*');
                executed = true;
            } 
    
    }
</script>
<script>
    function Schedule()
    {
        var businessId = {{ $business->id }};
        var user={{$user->id}};
        const url = `https://dev.fitnessity.co/api/business_activityschedulers?businessId=${encodeURIComponent(businessId)}&user=${encodeURIComponent(user)}`;
        window.parent.postMessage({ type: 'changeSrc', src: url }, '*'); 
    }
</script>

<script>
function PaymentHistory()
{
    var businessId = {{ $business->id }};
    var user={{$user->id}};
    const url = `https://dev.fitnessity.co/api/payment_history?businessId=${encodeURIComponent(businessId)}&user=${encodeURIComponent(user)}`;
    window.parent.postMessage({ type: 'changeSrc', src: url }, '*'); 
}
</script>
<script>
    function CreditCard()
    {
        var businessId = {{ $business->id }};
        var user={{$user->id}};
        const url = `https://dev.fitnessity.co/api/creditcards?businessId=${encodeURIComponent(businessId)}&user=${encodeURIComponent(user)}`;
        window.parent.postMessage({ type: 'changeSrc', src: url }, '*'); 
    }
</script>
</body>
</html>
