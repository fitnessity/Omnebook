@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<link href="{{ url('public/css/jquery-ui.css') }}" rel="stylesheet" type="text/css">

<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">
        <div class="col-md-2 col-sm-12" style="background: black;">
        	 @include('business.businessSidebar')
        </div>
		<div class="col-md-10 col-sm-12">
            <div class="container-fluid p-0">
				<div class="row">
					<div class="col-md-6 col-xs-12 col-sm-12">
						<div class="tab-hed scheduler-txt"><span class="font-red">Activity Scheduler </span> | <a href="#">Booking Request </a></div>
					</div>
					<div class="col-md-6 col-xs-12 col-sm-12">
						<div class="row">
							<div class="col-md-4 col-xs-12 col-sm-3">
								<a href="#" class="btn-nxt manage-cus-btn">Add New Client</a>
							</div>
							<div class="col-md-8 col-xs-12 col-sm-6">
								<div class="manage-search">
									<form method="get" action="/activities/">
										<input type="text" name="label" id="" placeholder="Search for client" autocomplete="off" value="">
										<button id="serchbtn"><i class="fa fa-search"></i></button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr style="border: 3px solid black; width: 125%; margin-left: -38px; margin-top: 5px;">
			  </div>
			  <div class="container-fluid plr-0">
				<div class="row">
					<div class="col-md-3 col-xs-12 col-sm-6">
						 <div class="date-activity-scheduler">
                            <label for="">Date:</label>
                            <input type="text"  id="" placeholder="Search By Date" class="form-control activity-scheduler-date w-80">
                            <i class="far fa-calendar-alt"></i>
                         </div>
					</div>
					<div class="col-md-5 col-xs-12 col-sm-6">
                        <p><b>Today Date: Thursday, December 01 , 2022 </b></p>
                    </div>
				</div>
				<div class="row">
					<div class="col-md-12 col-xs-12 col-sm-12">
						<div class="schedule-viewing">
							<label>Schedule Viewing Date: </label>
							<span> Monday,  November 28, 2022</span>
						</div>
						<!--<div class="priceactivity-scheduler">
                            <select name="frm_servicesport" id="frm-servicesport" class="form-control valid">
                                 <option value=""> Show All Activities </option>
								 <optgroup label="Badminton">
									 <option>abcd test</option>
									 <option>aaa</option>
                                 </optgroup>
								 <option>Baseball</option>
								 <option>Basketball</option>
								 <option>Beach Vollyball</option>
                            </select>
                       </div>-->
					</div>
				</div>
				<hr style="border: 1px solid #efefef; width: 115%; margin-left: -15px; margin-top: 5px;">
				<div class="row">
					<div class="col-md-12">
						<div class="row mobile-scheduler">
							<div class="col-md-1">
								<div class="scheduler-table-title">
									<label> Time </label>
								</div>
							</div>
							<div class="col-md-1">
								<div class="scheduler-table-title">
									<label>QTY</label>
								</div>
							</div>
							<div class="col-md-1">
								<div class="scheduler-table-title">
									<label>Duration</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="scheduler-table-title">
									<label> Scheduled Activity  </label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="scheduler-table-title">
									<label> Location </label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="scheduler-table-title">
									<label> Instructor </label>
								</div>
							</div>
						</div>
							<div class="overlay-activity">
								<label>Activity Completed</label>
								<div class="scheduler-info-box">
									<div class="row">
										<div class="col-md-1 col-xs-12 col-sm-4">
											<div class="timeline">
												<label class="scheduler-titles">Time: </label> <span> 9:00 AM </span>
												<span> 9:45 AM </span>
											</div>
										</div>
										<div class="col-md-1 col-xs-12 col-sm-4">	
											<a href="{{route('scheduler_checkin')}}" class="scheduler-qty">
												<label class="scheduler-titles">QTY: </label> <span> 9/30 </span>
											</a>
										</div>
										<div class="col-md-1 col-xs-12 col-sm-4">
											<div class="scheduled-activity-info">
												<label class="scheduler-titles"> Duration: </label> <span> 45 Min. </span>
											</div>
										</div>
										<div class="col-md-3 col-xs-12 col-sm-4">
											<div class="scheduled-activity-info">
												<label class="scheduler-titles"> Scheduled Activity: </label> <span> Adult kickboxing Class  </span>
											</div>
										</div>
										<div class="col-md-2 col-xs-12 col-sm-4">
											<div class="scheduled-location">
												<label class="scheduler-titles"> Location: </label> <span> At Business </span>
											</div>
										</div>
										<div class="col-md-2 col-xs-12 col-sm-4">
											<div class="scheduled-location">
												<label class="scheduler-titles"> Instructor: </label> <span> Darryl Phipps </span>
											</div>
										</div>
										<div class="col-md-2 col-xs-12 col-sm-12">
											<div class="scheduled-btns">
												<button type="button" class="btn-edit btn-sp">Edit</button>
												<a class="btn-edit"  data-toggle="modal" data-target="#bookingcancel">Cancel</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						
							<div class="overlay-activity">
								<label class="red-fonts">Activity Cancelled</label>
								<div class="scheduler-info-box">
									<div class="row">
										<div class="col-md-1 col-xs-12 col-sm-4">
											<div class="timeline timeline-before">
												<label class="scheduler-titles">Time: </label> <span> 10:00 AM </span>
												<span> 10:45 AM </span>
											</div>
										</div>
										<div class="col-md-1 col-xs-12 col-sm-4">	
											<a href="{{route('scheduler_checkin')}}" class="scheduler-qty">
												<label class="scheduler-titles">QTY: </label> <span> 1/20 </span>
											</a>
										</div>
										<div class="col-md-1 col-xs-12 col-sm-4">
											<div class="scheduled-activity-info">
												<label class="scheduler-titles"> Duration: </label> <span> 45 Min. </span>
											</div>
										</div>
										<div class="col-md-3 col-xs-12 col-sm-4">
											<div class="scheduled-activity-info">
												<label class="scheduler-titles"> Scheduled Activity: </label> <span> Brazilian Jujitsu Class </span>
											</div>
										</div>
										<div class="col-md-2 col-xs-12 col-sm-4">
											<div class="scheduled-location">
												<label class="scheduler-titles"> Location: </label> <span> At Business </span>
											</div>
										</div>
										<div class="col-md-2 col-xs-12 col-sm-4">
											<div class="scheduled-location">
												<label class="scheduler-titles"> Instructor: </label> <span> Dan Covel </span>
											</div>
										</div>
										<div class="col-md-2 col-xs-12 col-sm-12">
											<div class="scheduled-btns">
												<button type="button" class="btn-edit btn-sp">Edit</button>
												<a class="btn-edit"  data-toggle="modal" data-target="#bookingcancel">Cancel</a>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						<div class="scheduler-info-box">
							<div class="row">
								<div class="col-md-1 col-xs-12 col-sm-4">
									<div class="timeline">
										<label class="scheduler-titles">Time: </label> <span> 12:00 PM </span>
										<span> 1:00 PM </span>
									</div>
								</div>
								<div class="col-md-1 col-xs-12 col-sm-4">	
									<a href="{{route('scheduler_checkin')}}" class="scheduler-qty">
										<label class="scheduler-titles">QTY: </label> <span> 10/20 </span>
									</a>
								</div>
								<div class="col-md-1 col-xs-12 col-sm-4">
									<div class="scheduled-activity-info">
										<label class="scheduler-titles"> Duration: </label> <span> 1 Hr. </span>
									</div>
								</div>
								<div class="col-md-3 col-xs-12 col-sm-4">
									<div class="scheduled-activity-info">
										<label class="scheduler-titles"> Scheduled Activity: </label> <span> Adult VMA Class </span>
									</div>
								</div>
								<div class="col-md-2 col-xs-12 col-sm-4">
									<div class="scheduled-location">
										<label class="scheduler-titles"> Location: </label> <span> At Business </span>
									</div>
								</div>
								<div class="col-md-2 col-xs-12 col-sm-4">
									<div class="scheduled-location">
										<label class="scheduler-titles"> Instructor: </label><span> Darryl Phipps </span>
									</div>
								</div>
								<div class="col-md-2 col-xs-12 col-sm-12">
									<div class="scheduled-btns">
										<button type="button" class="btn-edit btn-sp">Edit</button>
										<a class="btn-edit"  data-toggle="modal" data-target="#bookingcancel">Cancel</a>
									</div>
								</div>
							</div>
						</div>
						
						<div class="scheduler-info-box">
							<div class="row">
								<div class="col-md-1 col-xs-12 col-sm-4">
									<div class="timeline timeline-before">
										<label class="scheduler-titles">Time: </label> <span>   2:00 PM </span>
										<span>  4:00 PM </span>
									</div>
								</div>
								<div class="col-md-1 col-xs-12 col-sm-4">	
									<a href="{{route('scheduler_checkin')}}" class="scheduler-qty">
										<label class="scheduler-titles">QTY: </label> <span> 20/40 </span>
									</a>
								</div>
								<div class="col-md-1 col-xs-12 col-sm-4">
									<div class="scheduled-activity-info">
										<label class="scheduler-titles"> Duration: </label><span> 45 Min. </span>
									</div>
								</div>
								<div class="col-md-3 col-xs-12 col-sm-4">
									<div class="scheduled-activity-info">
										<label class="scheduler-titles"> Scheduled Activity: </label> <span> Adult kickboxing Class </span>
									</div>
								</div>
								<div class="col-md-2 col-xs-12 col-sm-4">
									<div class="scheduled-location">
										<label class="scheduler-titles"> Location: </label> <span> At Business </span>
									</div>
								</div>
								<div class="col-md-2 col-xs-12 col-sm-4">
									<div class="scheduled-location">
										<label class="scheduler-titles"> Instructor: </label> <span> Darryl Phipps  </span>
									</div>
								</div>
								<div class="col-md-2 col-xs-12 col-sm-12">
									<div class="scheduled-btns">
										<button type="button" class="btn-edit btn-sp">Edit</button>
										<a class="btn-edit"  data-toggle="modal" data-target="#bookingcancel">Cancel</a>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6 col-xs-12 col-sm-6">
						<div class="activities-details">
							<label>Total Activities Today: </label> <span> 4 </span>
							<label>Total Reservations Today:</label> <span> 50 </span>
						</div>
					</div>
					<div class="col-md-6 col-xs-12 col-sm-6">
						<div class="pre-next-btns pre-nxt-btn-space">
							<button type="button" class="btn-previous btn-sp"><i class="fas fa-caret-left preday-arrow"></i>Previous Day</button>
							<button type="button" class="btn-previous">Next Day <i class="fas fa-caret-right nextday-arrow"></i></button>
						</div>
					</div>
				</div>
				
			</div>	
		</div>
		<!-- The Modal Add Business-->
		<div class="modal fade compare-model" id="bookingcancel">
			<div class="modal-dialog bookingcancel">
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
							   <h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 600; margin-top: 9px;">How Would You Like To Cancel This Activity?</h4>
							</div>
						</div>
						<hr style="border: 3px solid #ed1b24; width: 107%; margin-left: -15px; margin-top: 5px;">
						<div class="row">
							<div class="col-md-12">
								<div class="">
									<input type="checkbox" id="" name="" value="">
									<label for="vehicle1"> Cancel this activity for today only</label><br>
									<input type="checkbox" id="" name="" value="">
									<label for="vehicle2">Show cancellation on schedule</label><br>
									<input type="checkbox" id="" name="" value="">
									<label for="vehicle3">Hide cancellation on schedule</label><br>
								</div>
							</div>
						</div>
						<hr style="border: 1px solid #efefef; width: 107%; margin-left: -15px; margin-top: 15px;">
						<div class="row">
							<div class="col-md-12">
								 <h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 500; font-size: 15px; margin-bottom: 15px">Alert others of the cancellations</h4> 
								<div class="">
									<input type="checkbox" id="" name="" value="">
									<label for="vehicle1">Email {Instructor Name}</label><br>
									<input type="checkbox" id="" name="" value="">
									<label for="vehicle2">You have {4} clients registered </label><br>
									<label class="alert-label"> Alert registed clients with an email</label><br>
								</div>
								<a href="#" class="btn-nxt manage-cus-btn cancel-modal">Submit</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end modal -->
	</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
 $('.activity-scheduler-date').datepicker({
        dateFormat: "mm/dd/yy"
    })
</script>
<script src="{{ url('public/js/jquery-ui.min.js') }}"></script>
@include('layouts.footer')

@endsection