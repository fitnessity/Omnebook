@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
@section('content')
@include('layouts.business.business_topbar')

<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- <link rel="shortcut icon" href="{{ url('public/img/favicon.png') }}"> -->
<link rel="stylesheet" type="text/css" href="{{ url('public/css/profile.css') }}">


<style>
    body .fc {
        font-size: 14px;
    }
</style>

    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="h-100">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <div class="page-heading">
                                        <label>Calendar</label>
                                    </div>
                                </div>
                            </div>
                        
                            <div class="row">
                                <div class="page-wrapper " id="wrapper">
                                    <div class="page-container">
                                        <div class="calender-wrapper">
                                            <div class=""> 
                                                <div class="">
                                                    <div class="edit_profile_section padding-1 white-bg border-radius1">
														<div class="row">
															<div class="col-lg-3 col-md-5 col-sm-5">
																<div class="form-group mb-10">
																	<select class="form-select" name="position" required="">
																		<option value="none" selected=""> Select</option>
																		<option value="sub instructor">All</option>
																		<option value="Trainer">Appointments</option>
																		<option value="Sub director">Personal Training</option>
																		<option value="sub Trianer">Group Bookings</option>
																		<option value="sub Trianer">Events</option>
																	</select>
																</div>
															</div>
														</div>
														<div id='calendar'></div>
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
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
    </div><!-- end main content-->
</div><!-- END layout-wrapper -->

<div class="modal fade" id="schedule-add" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add Your Schedule</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
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

<div class="modal fade" id="schedule-edit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group book-info">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Calendar Event Modal -->
    <div class="modal fade compare-model" id="calenderevent" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog eventcalender modal-dialog-centered">
            <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="myModalLabel">Add Event</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
                <!-- Modal body -->
                <div class="modal-body body-tbm">
                    <div class="modal-box-selection" onClick="openNaavbookclienttraining()" data-bs-dismiss="modal">
                        <div class="row"> 
                            <div class="col-md-3 col-3">
                                <div class="schedule-client">
                                    <img src="{{url('/public/img/schedule-client.png')}}">
                                </div>                              
                            </div>
                            <div class="col-md-9 col-9">
                                <div class="event-info">
                                    <label>Schedule A Client</label>
                                    <p>Set up a schedule to train a client</p>
                                </div>
                            </div>
                        </div>
                    </div>
					
                    <div  class="modal-box-selection" onClick="openNaavmeetings()" data-bs-dismiss="modal">
                        <div class="row"> 
                            <div class="col-md-3 col-3">
                                <div class="schedule-client">
                                    <img src="{{url('/public/img/schedule-meetings.png')}}">
                                </div>                              
                            </div>
                            <div class="col-md-9 col-9">
                                <div class="event-info">
                                    <label>Schedule Meetings</label>
                                    <p>Schedule appointments and meetings</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-box-selection" onClick="openNaavblockoff()" data-bs-dismiss="modal">
                        <div class="row"> 
                            <div class="col-md-3 col-3">
                                <div class="schedule-client">
                                    <img src="{{url('/public/img/blockoff.png')}}">
                                </div>                              
                            </div>
                            <div class="col-md-9 col-9">
                                <div class="event-info">
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



<nav class="com-sidebar">
    <div class="navbar-wrapper">
        <div id="completeblockoff" class="com-sidepanel">
            <div class="navbar-content">
                <div class="container"> 
                    <div class="row">
                        <div class="col-lg-8 col-8">
                            <div class="setup-title">
                                <label> Schedule a day, days or a time period off.</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-4">
                            <div class="p-relative">
                                <a href="javascript:void(0)" class="com-cancle fa fa-times" onClick="closeNaavblockoff()"></a>
                            </div>
                        </div>
                    </div>	
                </div>
                <div class="border-bottom-grey mt-10 mb-10"></div>	
                <div class="container"> 
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="select-date mb-20">
                                <label>Selected Date:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control border-0 flatpickr-range flatpiker-with-border flatpickr-input active" value="10/12/2000" readonly="readonly">
                                </div>
                            </div>
                            <div class="program-selection mb-20">
                                <label>Reason For Scheduling:</label>
                                <select name="" id="" class="form-select valid" autocomplete="off">
                                    <option value="">Select personal task</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                            <div class="block-radio">
                                <input type="radio" id="html" name="fav_language" value="HTML">
                                <label for="html">Block off the full day</label>
                                <input type="radio" class="ml-10" id="css" name="fav_language" value="CSS">
                                <label for="css">Block off a time</label>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="program-selection mb-20">
                                        <label>From: </label>
                                        <select name="shift_start[]" id="shift_start" class="shift_start form-select" required="required">
                                            <option value="">Select Time</option>
                                            <option value="00:00">12:00 AM</option>
                                            <option value="00:15">12:15 AM</option>
                                            <option value="00:30">12:30 AM</option>
                                            <option value="00:45">12:45 AM</option>
                                            <option value="01:00">01:00 AM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="program-selection mb-20">
                                        <label>To: </label>
                                        <select name="shift_end[]" id="shift_end" class="shift_start form-select" required="required">
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
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="program-selection mb-20">
                                <label>Add Comment: </label>
                                <textarea class="form-control" name="notetext" rows="4" style="width: 100%;"> </textarea>
                            </div>
                                                        
                            <label>Repeat: </label>
                            <div class="repeat mb-20">
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
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="float-end">
                                <button type="submit" class="btn btn-red mb-00">Manage Days Off</button>
                                <button type="submit" class="btn btn-black mb-00 addclint-btn" id="">Schedule</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<nav class="com-sidebar">
    <div class="navbar-wrapper">
        <div id="schedule_meetings" class="com-sidepanel">
            <div class="navbar-content">
                <div class="container"> 
                    <div class="row">
                        <div class="col-lg-8 col-8">
                            <div class="setup-title">
                                <label>Schedule An Appointment</label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-4">
                            <div class="p-relative">
                                <a href="javascript:void(0)" class="com-cancle fa fa-times" onClick="closeNaavmeetings()"></a>
                            </div>
                        </div>
                    </div>	
                </div>
                <div class="border-bottom-grey mt-10 mb-10"></div>	
                <div class="container"> 
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
							<div class="row">
								<div class="col-12">
									<div class="mb-3">
										<label class="form-label">Event Name</label>
                                        <input class="form-control" placeholder="Enter event name" type="text" name="title" id="event-title" required value="" />
                                    </div>
                                </div>
								<div class="col-lg-6 col-6">
									<label>All Day Event</label>
								</div>
								<div class="col-lg-6 col-6">
									<div class="form-check form-switch float-end">
										<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="mb-3">
										<label>Date</label>
										<div class="input-group">
											<span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
											<input type="text" id="event-start-date" class="form-control flatpickr flatpickr-input flatpickr-range" placeholder="Select date" required="" readonly="readonly">
                                        </div>
                                    </div>
								</div>
								
								<div class="col-md-12">
									<div class="mb-15">
										<button class="add_people"> + Add People</button>
									</div>  
									<div class="data">
										<div class="col-lg-12">
											<div class="mb-3">
											   <label class="form-label">Name</label>
											   <input class="form-control d-block" placeholder="Enter name" type="text" name="title" id="" required="" value="">
											 </div>
										</div>
										
										<div class="col-lg-12">
											<div class="mb-3">
											   <label class="form-label">Email</label>
											   <input class="form-control d-block" placeholder="Enter email" type="text" name="email" id="" required="" value="">
											 </div>
										</div>
									</div>
								</div>
								
								<div class="col-lg-12">
									<div class="mb-3">
										<div class="repeat-box">
											<div class="row">
												<div class="col-lg-6 col-6">
													<i class='bx bx-repeat'></i>
													<label>Repeat</label>
												</div>
												<div class="col-lg-6 col-6">
													<span class="float-end">Never</span>
												</div>
											</div>
                                         </div>
                                    </div>
                                </div>
								
								<div class="col-lg-12">
									<div class="mb-3">
										<div class="repeat-box">
											<div class="row">
												<div class="col-lg-6 col-6">
													<i class='bx bx-bell'></i>
													<label>Alert</label>
												</div>
												<div class="col-lg-6 col-6">
													<span class="float-end">15 minutes before</span>
												</div>
											</div>
                                         </div>
                                    </div>
                                </div>
								<div class="col-12">
                                     <div class="mb-3">
                                         <label for="event-location">Location</label>
                                         <div>
                                             <input type="text" class="form-control" name="event-location" id="event-location" placeholder="Event location">
                                         </div>
                                     </div>
                                </div>
                                <div class="col-12">
                                     <div class="mb-3">
                                          <label class="form-label">Description</label>
                                          <textarea class="form-control" id="event-description" placeholder="Enter a description" rows="3" spellcheck="false"></textarea>
                                      </div>
                                </div>
                                <div class="col-12">
                                    <div class="float-end">
                                        <button type="submit" class="btn btn-red" id="">Submit</button>
                                    </div>
                                </div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- The Calendar block time Modal -->
    <!-- <div class="modal fade compare-model" id="blocktime" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog booking-time modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
					<h5 class="modal-title" id="myModalLabel">Schedule a day, days or a time period off.</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
                <div class="modal-body body-tbm">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="select-date mb-20">
                                <label>Selected Date:</label>
								<div class="input-group">
									<input type="text" class="form-control border-0 flatpickr-range flatpiker-with-border flatpickr-input active" value="10/12/2000" readonly="readonly">
								</div>
                            </div>
                            <div class="program-selection mb-20">
                                <label>Reason For Scheduling:</label>
                                <select name="" id="" class="form-select valid" autocomplete="off">
                                    <option value="">Select personal task</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                </select>
                            </div>
                            <div class="block-radio">
                                <input type="radio" id="html" name="fav_language" value="HTML">
                                <label for="html">Block off the full day</label>
                                <input type="radio" class="ml-10" id="css" name="fav_language" value="CSS">
                                <label for="css">Block off a time</label>
                            </div>
                            
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="program-selection mb-20">
                                        <label>From: </label>
                                        <select name="shift_start[]" id="shift_start" class="shift_start form-select" required="required">
                                            <option value="">Select Time</option>
                                            <option value="00:00">12:00 AM</option>
                                            <option value="00:15">12:15 AM</option>
                                            <option value="00:30">12:30 AM</option>
                                            <option value="00:45">12:45 AM</option>
                                            <option value="01:00">01:00 AM</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <div class="program-selection mb-20">
                                        <label>To: </label>
                                        <select name="shift_end[]" id="shift_end" class="shift_start form-select" required="required">
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
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="program-selection mb-20">
                                <label>Add Comment: </label>
                                <textarea class="form-control" name="notetext" rows="4" style="width: 100%;"> </textarea>
                            </div>
                                                        
                            <label>Repeat: </label>
                            <div class="repeat mb-20">
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
                    </div>
                </div>
				<div class="modal-footer float-end">
					<button type="submit" class="btn btn-red mb-00">Manage Days Off</button>
					<button type="submit" class="btn btn-black mb-00 addclint-btn" id="">Schedule</button>
				</div>
            </div>
        </div>
    </div> -->
<!-- end modal -->

<!-- The Calendar Schedule a Meeting Modal -->
    <div class="modal fade compare-model" id="schedule-meetings" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog booking-time modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
					<h5 class="modal-title" id="myModalLabel">Schedule An Appointment</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
                <!-- Modal body -->
                <div class="modal-body body-tbm">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
							<div class="row">
								<div class="col-12">
									<div class="mb-3">
										<label class="form-label">Event Name</label>
                                        <input class="form-control" placeholder="Enter event name" type="text" name="title" id="event-title" required value="" />
                                    </div>
                                </div>
								<div class="col-lg-6 col-6">
									<label>All Day Event</label>
								</div>
								<div class="col-lg-6 col-6">
									<div class="form-check form-switch float-end">
										<input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
									</div>
								</div>
								<div class="col-lg-12">
									<div class="mb-3">
										<label>Date</label>
										<div class="input-group">
											<span class="input-group-text"><i class="ri-calendar-event-line"></i></span>
											<input type="text" id="event-start-date" class="form-control flatpickr flatpickr-input flatpickr-range" placeholder="Select date" required="" readonly="readonly">
                                        </div>
                                    </div>
								</div>
								
								<div class="col-md-12">
									<div class="mb-15">
										<button class="add_people"> + Add People</button>
									</div>  
									<div class="data">
										<div class="col-lg-12">
											<div class="mb-3">
											   <label class="form-label">Name</label>
											   <input class="form-control d-block" placeholder="Enter name" type="text" name="title" id="" required="" value="">
											 </div>
										</div>
										
										<div class="col-lg-12">
											<div class="mb-3">
											   <label class="form-label">Email</label>
											   <input class="form-control d-block" placeholder="Enter email" type="text" name="email" id="" required="" value="">
											 </div>
										</div>
									</div>
								</div>
								
								
								<div class="col-lg-12">
									<div class="mb-3">
										<div class="repeat-box">
											<div class="row">
												<div class="col-lg-6 col-6">
													<i class='bx bx-repeat'></i>
													<label>Repeat</label>
												</div>
												<div class="col-lg-6 col-6">
													<span class="float-end">Never</span>
												</div>
											</div>
                                         </div>
                                    </div>
                                </div>
								
								<div class="col-lg-12">
									<div class="mb-3">
										<div class="repeat-box">
											<div class="row">
												<div class="col-lg-6 col-6">
													<i class='bx bx-bell'></i>
													<label>Alert</label>
												</div>
												<div class="col-lg-6 col-6">
													<span class="float-end">15 minutes before</span>
												</div>
											</div>
                                         </div>
                                    </div>
                                </div>
								<div class="col-12">
                                     <div class="mb-3">
                                         <label for="event-location">Location</label>
                                         <div>
                                             <input type="text" class="form-control" name="event-location" id="event-location" placeholder="Event location">
                                         </div>
                                     </div>
                                </div>
                                <div class="col-12">
                                     <div class="mb-3">
                                          <label class="form-label">Description</label>
                                          <textarea class="form-control" id="event-description" placeholder="Enter a description" rows="3" spellcheck="false"></textarea>
                                      </div>
                                </div>
													
								
							</div>
                        </div>
                     
                    </div>
                </div>
				<div class="modal-footer float-end">
					<button type="submit" class="btn btn-red" id="">Submit</button>
				</div>
            </div>
        </div>
    </div>
<!-- end modal -->

<div class="modal fade bookingreceipt" role="dialog" id="" tabindex="-1" aria-modal="true" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog counter-modal-size modal-80">
        <div class="modal-content">
            <div class="modal-header p-3">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>  
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="modal-title mb-10 partcipate-model">Booking & Payment Confirmed</h4>
                    </div>
                    <div id="receiptbody"> {!! $modeldata !!} </div>
                </div>
            </div>   
        </div>                                                                       
    </div>                                          
</div>

@include('layouts.business.footer')
@include('layouts.business.scripts')
@include('calendar.schedule_client_modal')

<script src="{{ url('public/js/moment.min.js') }}"></script>
<script src="{{ asset('/js/fullcalendar/fullcalendar.min.js') }}"></script>


<script>
function openNaavblockoff() {
    var windowWidth = window.innerWidth;
	var newthingsWidth = windowWidth <= 768 ? "100%" : "500px";  // Set to 100% for mobile, 500px for desktop
	document.getElementById("completeblockoff").style.width = newthingsWidth;
	// document.getElementById("completeblockoff").style.width = "500px";
}

function closeNaavblockoff() {
	document.getElementById("completeblockoff").style.width = "0";
}
</script>

<script>
function openNaavmeetings() {
    var windowWidth = window.innerWidth;
	var newthingsWidth = windowWidth <= 768 ? "100%" : "500px";  // Set to 100% for mobile, 500px for desktop
	document.getElementById("schedule_meetings").style.width = newthingsWidth;
	// document.getElementById("schedule_meetings").style.width = "500px";
}

function closeNaavmeetings() {
	document.getElementById("schedule_meetings").style.width = "0";
}
</script>

<script>
	$(document).ready(function () {
		var SITEURL = "{{ url('/') }}";
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        var calendar = $('#calendar').fullCalendar({
            editable: true,
            events:[
                @foreach($fullary as $dt)
                {
                    allDay : false,
                    id:'{{$dt["id"]}}',
                    title:'{{$dt["title"] . ' \n '.date("h:i a", strtotime( $dt["shift_start"] )).' - '.$dt["time"] . ' \n '.$dt["full_name"]}}',    
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
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') { event.allDay = true; } 
				else { event.allDay = false; }
            },
            selectable: true,
            selectHelper: true,

            eventClick: function(events) {
                var eventName = events.title;
                $.ajax({
                    type: "POST",
                    url: '{{route("eventmodelboxdata")}}',
                    data: "&id=" + events.id + "&start=" + events.start.toISOString(),
                    success: function(data) {
                        if(data != ''){
                            $('.book-info').html(data);
                            $("#schedule-edit").modal('show');
                        }
                    }
                });
            },
            dayClick: function(date,allDay, jsEvent, view) {
                dDate = date.format('MM/DD/YYYY');
                flatpickr('.sessionDate',{
                    dateFormat: "m/d/Y",
                    maxDate: "01/01/2050",
                    defaultDate: dDate,
                });

                var today = moment().format('YYYY-MM-DD');; 
                if(date.format('YYYY-MM-DD') >= today){
                    $("#sesdate").val(date.format('YYYY-MM-DD'));
                    $("#calenderevent").modal('show');
                }
            }
        });
    });

    function openmodelbox(){
        $('#schedule-edit').modal('hide');
        $('#schedule-add').modal('show');
    }
</script>

<script>
    $(window).on('load', function() {
        var modelchk = '{{$modelchk}}';
        if(modelchk == 1){  
            $(".bookingreceipt").modal('show');
        }
    });

    function sendemail(){
        $('.reviewerro').html('');
        var email = $('#receipt_email').val();
        var orderdetalidary = $('#orderdetalidary').val();
        var booking_id = $('#booking_id').val();
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
                url: "{{route('sendreceiptfromcheckout')}}",
                xhrFields: {
                    withCredentials: true
                },
                type: 'get',
                data:{
                    orderdetalidary:orderdetalidary,
                    email:email,
                    booking_id:booking_id,
                },
                success: function (response) {
                    $('.reviewerro').html('');
                    $('.reviewerro').css('display','block');
                    $('.reviewerro').html('Email Successfully Sent..');
                }
            });
        }
    }
</script>

@endsection
