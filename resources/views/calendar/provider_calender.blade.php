@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="shortcut icon" href="{{ url('public/img/favicon.png') }}">

<link rel="stylesheet" type="text/css" href="{{ url('public/css/all.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/metismenu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/fullcalendar/fullcalendar.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/profile.css') }}">
<script src="{{ url('public/js/moment.min.js') }}"></script>
<script src="{{ url('public/js/fullcalendar/fullcalendar.min.js') }}"></script>

<style>
    body .fc {
        font-size: 14px;
    }
    
</style>
<!--<div class="container">
</div>
<div id='calendar'></div>-->

<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">
        <div class="col-md-2" style="background: black;">
           @include('business.businessSidebar')
        </div>
        <div class="col-md-10 nopadding">
            <div class="page-wrapper " id="wrapper">
            <div class="page-container">
                <!-- Left Sidebar End -->
                <div class="page-content-wrapper calender-wrapper">
                    <div class="content-page">
                        <div class="container-fluid">
                            <div class="page-title-box">
                                <h4 class="page-title">Calendar</h4>
                            </div>
                            <div class="edit_profile_section padding-1 white-bg border-radius1">
                                <div id='calendar'>
                                    <!--<div class="complete-block">
                                        <a href="#" class="complete-link">complete</a>
                                        <a href="#" class="incomplete-link">incomplete</a>
                                    </div>-->
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

<div class="modal fade" id="schedule-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Add Your Schedule</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Schedule Name:</label>
                        <input type="text" class="form-control">
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
           
        </div>
    </div>
</div>


<div class="modal fade" id="schedule-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group book-info">
                    <!-- <label id="activity_name"></label>
                    <a class="btn btn-danger" href="{{route('bookinginfo')}}">View booking details</a> -->
                </div>
            </div>
        </div>
    </div>
</div>


<!-- The Calendar Modal -->
    <div class="modal fade compare-model" id="calenderevent">
        <div class="modal-dialog eventcalender">
            <div class="modal-content">
                <div class="modal-header" style="text-align: right;"> 
                    <div class="closebtn">
                        <button type="button" class="close close-btn-design manage-customer-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
                <!-- Modal body -->
                <div class="modal-body body-tbm">
                    <div class="row"> 
                        <div class="col-lg-12">
                            <h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 600; margin-top: 9px; margin-bottom: 12px;">Add Event</h4>
                        </div>
                    </div>
                    <div class="modal-box-selection" data-toggle="modal" data-target="#bookclienttraining">
                        <div class="row"> 
                            <div class="col-md-3">
                                <div class="schedule-client">
                                    <img src="http://dev.fitnessity.co/public/img/schedule-client.png">
                                </div>                              
                            </div>
                            <div class="col-md-9">
                                <div class="event-info text-center">
                                    <label>Schedule A Client</label>
                                    <p>Set up a schedule to train a client</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-box-selection" data-toggle="modal" data-target="">
                        <div class="row"> 
                            <div class="col-md-3">
                                <div class="schedule-client">
                                    <img src="http://dev.fitnessity.co/public/img/schedule-meetings.png">
                                </div>                              
                            </div>
                            <div class="col-md-9">
                                <div class="event-info text-center">
                                    <label>Schedule Meetings</label>
                                    <p>Schedule appointments and meetings</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-box-selection" data-toggle="modal" data-target="#blocktime">
                        <div class="row"> 
                            <div class="col-md-3">
                                <div class="schedule-client">
                                    <img src="http://dev.fitnessity.co/public/img/blockoff.png">
                                </div>                              
                            </div>
                            <div class="col-md-9">
                                <div class="event-info text-center">
                                    <label>Block Off Dates Or A Time Period</label>
                                    <p>Tell cleints when your not available</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- end modal -->

<!-- The Schedule A Client Modal -->
    <div class="modal fade compare-model" id="bookclienttraining">
        <div class="modal-dialog book-client-training">
            <div class="modal-content">
                <div class="modal-header" style="text-align: right;"> 
                    <div class="closebtn">
                        <button type="button" class="close close-btn-design manage-customer-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
                <!-- Modal body -->
                <div class="modal-body body-tbm">
                    <div class="row"> 
                        <div class="col-lg-12">
                            <h4 class="modal-title" style="text-align: center; color: #df0003; line-height: inherit; font-weight: 600; margin-top: 9px; margin-bottom: 0px;">Schedule A Client</h4>
                            <p class="text-center">Book a client for training</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="side-border-right-red">
                                <label class="red-fonts">Step 1: </label> <label> Plan Your Session</label> 
                                <div class="program-selection">
                                    <label>Select Program</label>
                                    <select name="" id="" class="form-control valid" autocomplete="off">
                                        <option value="">Select Program</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                    </select>
                                </div>
                                    
                                <div class="program-selection">
                                    <label>Select Catagory </label>
                                    <select name="" id="" class="form-control valid" autocomplete="off">
                                        <option value="">Select Catagory</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                    </select>
                                </div>
                                
                                <div class="program-selection">
                                    <label>Select Price Option </label>
                                    <select name="" id="" class="form-control valid" autocomplete="off">
                                        <option value="">Select Price</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="program-selection">
                                            <label>Participants</label>
                                            <input type="text" class="form-control valid" name="" id="" placeholder="1" title="" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="program-selection">
                                            <label>Price</label>
                                            <input type="text" class="form-control valid" name="" id="" placeholder="$" title="" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="program-selection">
                                            <label>Date:</label>
                                            <div class="date-activity-check">
                                                <input type="text"  id="refunddate" placeholder="Search By Date" class="form-control activity-scheduler-date w-80" autocomplete="off" value="{{date('m/d/Y')}}" onchange="changedate('simple');">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="program-selection">
                                            <label>Time</label>
                                            <input type="text" class="form-control valid" name="" id="" placeholder="$" title="" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="program-selection">
                                            <label>Duration:</label>
                                            <div class="duration-min">
                                                <input type="text" class="form-control valid" name="" id="" placeholder="$" title="" >
                                                <select name="" id="" class="form-control valid" autocomplete="off">
                                                    <option value="">Min</option>
                                                    <option>Hr</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="program-selection">
                                    <label>How Often Will this happen? </label>
                                    <form action="/action_page.php">
                                        <p>Please select your favorite Web language:</p>
                                        <input type="radio" id="" name="fav_language" value="HTML">
                                        <label class="onedaybboking" for="html">One Day Booking</label>
                                        <input type="radio" id="css" name="fav_language" value="CSS">
                                        <label class="onedaybboking" for="css">Repeat This Booking</label>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 nopadding side-border-right-red">
                            <label class="red-fonts">Step 2: </label> <label> Select Client</label> 
                            <div>
                                <label>Search for customer</label>
                                <div class="search-customer">
                                    <form method="get" action="/activities/">
                                        <input type="text" name="label" id="site_search" placeholder="Search by name, phone or email" autocomplete="off" value="">
                                        <button id="serchbtn"><i class="fa fa-search"></i></button>
                                    </form>
                                </div>
                                <div class="col-md-12 nopadding">
                                    <button type="submit" class="btn-nxt mb-00 addclint-btn" id="">Add New Client </button>
                                </div>
                            </div>
                            
                            <div>
                                <label>Send notification to customer</label>
                                <input type="text" class="form-control valid" name="" id="" placeholder="Enter email" title="" >
                                <div class="col-md-12 nopadding">
                                    <button type="submit" class="btn-nxt mb-00 addclint-btn" id="">Send Email</button>
                                </div>
                            </div>
                            
                            <div>
                                <label>Connect Calender for updates</label>
                                <div class="connect-calender">
                                    <input type="text" class="form-control valid" name="" id="" title="" >
                                    <input type="text" class="form-control valid" name="" id="" title="" >
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="col-md-4">
                            <label class="red-fonts">Step 3: </label> <label> Booking Summary & Pay</label> 
                            <div class="program-selection">
                                <label>Client Info:</label>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="sub-info-customer">
                                            <label>Client Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <span>Darryl Phipps</span>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="sub-info-customer">
                                            <label>Age</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <span>40</span>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="sub-info-customer">
                                            <label>Email</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <span>darrylkphipps@gmail.com</span>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="sub-info-customer">
                                            <label>Phone number</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <span>718-708-3690</span>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="sub-info-customer">
                                            <label>Location</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <span>New York, USA</span>
                                    </div>
                                </div>  
                                <div class="booking-border-sparetor"></div>
                                <label>Booking Details:</label>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="sub-info-customer">
                                            <label>Program Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <span>Kickboxing with Valor</span>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="sub-info-customer">
                                            <label>Catagory Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <span>Adult Kickboxing</span>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="sub-info-customer">
                                            <label>Price Option</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <span>1 Drop in Session</span>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="sub-info-customer">
                                            <label>Particpants</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <span>1 Adult</span>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="sub-info-customer">
                                            <label>Date</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <span>11/30/2022</span>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="sub-info-customer">
                                            <label>Time</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <span>9:00 Am to 10:00 PM</span>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="sub-info-customer">
                                            <label>Duration</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <span>1 Hour</span>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="sub-info-customer">
                                            <label>Booking Recurrence</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <span>One Day Booking</span>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="sub-info-customer">
                                            <label>Price</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <span>$100</span>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="sub-info-customer">
                                            <label>Service Fee</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <span>$7</span>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="sub-info-customer">
                                            <label>Tax</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <span>$9</span>
                                    </div>
                                    
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="sub-info-customer">
                                            <label>Total</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <span>$116</span>
                                    </div>
                                    
                                </div>  
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn-nxt mb-00 pay-btn" id="">Cancel</button>
                            <button type="submit" class="btn-nxt mb-00 pay-btn" id="">Payment</button>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
<!-- end modal -->

<!-- The Calendar Modal -->
    <div class="modal fade compare-model" id="blocktime">
        <div class="modal-dialog booking-time">
            <div class="modal-content">
                <div class="modal-header" style="text-align: right;"> 
                    <div class="closebtn">
                        <button type="button" class="close close-btn-design manage-customer-close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
                <!-- Modal body -->
                <div class="modal-body body-tbm">
                    <div class="row"> 
                        <div class="col-lg-12">
                            <h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 600; margin-top: 9px; margin-bottom: 12px;">Add a personal task or block off a date or time</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="select-date">
                                <label>Selected Date:</label>
                                <div class="block-datetime">
                                    <input type="text"  id="blockdatetime" placeholder="Search By Date" class="form-control activity-scheduler-date w-80" autocomplete="off" value="{{date('m/d/Y')}}" onchange="changedate('simple');">
                                </div>
                            </div>
                            <div class="program-selection">
                                <label>Personal Task:</label>
                                <select name="" id="" class="form-control valid" autocomplete="off">
                                    <option value="">Select personal task</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                            <div class="block-radio">
                                <input type="radio" id="html" name="fav_language" value="HTML">
                                <label for="html">Block off the full day</label><br>
                                <input type="radio" id="css" name="fav_language" value="CSS">
                                <label for="css">Block off a time</label>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="program-selection">
                                        <label>From: </label>
                                        <select name="shift_start[]" id="shift_start" class="shift_start form-control" required="required">
                                            <option value="">Select Time</option>
                                            <option value="00:00">12:00 AM</option>
                                            <option value="00:15">12:15 AM</option>
                                            <option value="00:30">12:30 AM</option>
                                            <option value="00:45">12:45 AM</option>
                                            <option value="01:00">01:00 AM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="program-selection">
                                        <label>To: </label>
                                        <select name="shift_start[]" id="shift_start" class="shift_start form-control" required="required">
                                            <option value="">Select Time</option>
                                            <option value="00:00">12:00 AM</option>
                                            <option value="00:15">12:15 AM</option>
                                            <option value="00:30">12:30 AM</option>
                                            <option value="00:45">12:45 AM</option>
                                            <option value="01:00">01:00 AM</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="col-lg-6">
                            <div class="program-selection">
                                <label>Add Comment: </label>
                                <textarea name="notetext" rows="4" style="width: 100%;"> </textarea>
                            </div>
                            
                            <div class="personal-task-sprator"></div>
                            
                            <label>Repeat: </label>
                            <div class="repeat">
                                <form action="">
                                    <group>
                                    <div class="input-container">
                                      <input type="radio" name="title"><label>Daily</label>      
                                    </div>
                                    <div class="input-container">
                                      <input type="radio" name="title" checked><label>Weekly</label>
                                    </div>
                                    <div class="input-container">
                                      <input type="radio" name="title"><label>Monthly</label>     
                                    </div>
                                    <div class="input-container">
                                      <input type="radio" name="title"><label>Yearly</label>  
                                    </div>  
                                    </group>
                                </form>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn-nxt mb-00 addclint-btn" id="">Schedule</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- end modal -->

@include('layouts.footer')

<script>
	$(document).ready(function () {
		var SITEURL = "{{ url('/') }}";
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var daydate = '';
        var calendar = $('#calendar').fullCalendar({
            editable: true,
           //events:'{{route("calendar")}}',
            events:[
                @foreach($fullary as $dt)
                {
                    allDay : false,
                    id:'{{$dt["id"]}}',
                    title:'{{$dt["title"] . ' \n '.date("h:i a", strtotime( $dt["shift_start"] )).' - '.$dt["time"]}}',    
                    //start:'{{$dt["start"]}}',
                    start:'{{$dt["start"].' '.date("h:i", strtotime( $dt["shift_start"]) )}}',
                    end:'{{$dt["start"].' '.date("h:i", strtotime( $dt["shift_end"]) )}}',
                },
                @endforeach
            ], 
           
            displayEventTime: false,
            editable: true,
            eventLimit: true,
			fixedWeekCount:false,
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
            /*defaultView: "month", */
            eventRender: function (event, element, view) {
                //alert('call');
                if (event.allDay === 'true') { event.allDay = true; } 
				else { event.allDay = false; }
            },
            selectable: true,
            selectHelper: true,

            eventClick: function(events) {
                //var time = events.start;
                var eventName = events.title;
                $.ajax({
                    type: "POST",
                    url: '{{route("eventmodelboxdata")}}',
                    data: "&id=" + events.id + "&start=" + events.start.toISOString(),
                    success: function(data) {
                        if(data != ''){
                            $('.book-info').html(data);
                            var modal = $("#schedule-edit");
                            modal.modal();
                        }
                    }
                });
                
               
              //$('#activity_name').html(eventName);
               
            },

            /*select: function(start, end, allDay) {
                var check = $.fullCalendar.formatDate(start,'yyyy-MM-dd');
                var today = $.fullCalendar.formatDate(new Date(),'yyyy-MM-dd');
                if(check < today)
                {
                    // Previous Day. show message if you want otherwise do nothing.
                    // So it will be unselectable
                }
                else
                {
                    // Its a right date
                    // Do something
                }
              },*/

            dayClick: function(date,allDay,  jsEvent, view) {
                var modal = $("#calenderevent");
                modal.modal();
                //alert('Clicked on: ' + date.format());

                // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

                // alert('Current view: ' + view.name); 

            }
            
        });
    });
    function displayMessage(message) {
        toastr.success(message, 'Event');
    }
     
            

    function openmodelbox(){
        $('#schedule-edit').modal('hide');
        $('#schedule-add').modal('show');
    }
</script>

<script type="text/javascript">
    $( function() {
            $( "#blockdatetime" ).datepicker( { 
                autoclose: true,
                minDate: 0,
                changeMonth: true,
                changeYear: true   
            } );
        } );
</script>

@endsection
