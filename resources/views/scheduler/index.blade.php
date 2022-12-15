@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

@php
	 use App\StaffMembers;
@endphp
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
						<div class="tab-hed scheduler-txt"><span class="font-red">Activity Scheduler </span> | <a href="{{route('booking_request')}}">Booking Request </a></div>
					</div>
					<div class="col-md-6 col-xs-12 col-sm-12">
						<div class="row">
							<div class="col-md-4 col-xs-12 col-sm-3">
								<a href="#" class="btn-nxt manage-cus-btn" data-toggle="modal" data-target="#newclient">Add New Client</a>
							</div>
							<div class="col-md-8">
								<div class="manage-search serchcustomer">
									<form>
										<input type="text" name="serchclient" id="serchclient" placeholder="Search for client" autocomplete="off" value="">
										<div id="option-box1"></div>
										<button ><i class="fa fa-search"></i></button>
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
                            <div class="activityselect3 special-date">
								<!-- <input type="text" name="actfildate" id="managecalendarservice" placeholder="Date" class="form-control" onchange="getbookingmodel('.$request->sid.','ajax');" autocomplete="off" value="'.date('m/d/Y',strtotime($request->date)).'"> -->
								<input type="text" name="actfildate" id="managecalendarservice" placeholder="Date" class="form-control" autocomplete="off" value="{{date('m/d/Y')}}" onchange="getscheduledata('normal');" >
							</div>
                         </div>
					</div>
					<div class="col-md-5 col-xs-12 col-sm-6">
                        <p><b>Today Date: {{$todaydate}}</b></p>
                    </div>
				</div>
				<div class="row">
					<div class="col-md-12 col-xs-12 col-sm-12">
						<div class="schedule-viewing">
							<label>Schedule Viewing Date: </label>
							<span id="spandate">{{$todaydate}}</span>
						</div>
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

						<!-- <div class="overlay-activity">
							<label class="overlay-activity-label red-fonts">Activity Cancelled</label>
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
						</div> -->
						<div id="bindscheduledata">
							@php $total_reservations = 0; @endphp
							@if(!empty($bookschedulers) && count($bookschedulers)>0)
								@foreach ($bookschedulers as $cs => $bookscheduler)
									@php $total_reservations += $bookscheduler->spots_reserved($filter_date);
										$date1 = date('H:i',strtotime($bookscheduler['shift_end']));
										$date2 = date('H:i');
									 @endphp

									@if($date1 < $date2)
										<div class="overlay-activity">
										<label class="overlay-activity-label">Activity Completed</label>
									@endif
									
									<div class="scheduler-info-box">
										<div class="row">
											<div class="col-md-1 col-xs-12 col-sm-4">
												<div class="timeline">
													<label class="scheduler-titles">Time: </label> <span> {{date('h:i A', strtotime($bookscheduler['shift_start']))}} </span>
													<span>{{date('h:i A', strtotime($bookscheduler['shift_end']))}}</span>
												</div>
											</div>
											<div class="col-md-1 col-xs-12 col-sm-4">	
												<a href="{{route('scheduler_checkin',['sid'=>$bookscheduler->id])}}" class="scheduler-qty">
													<label class="scheduler-titles">QTY: </label> <span> {{$bookscheduler->spots_left($filter_date)}}/{{$bookscheduler->spots_available}} </span>
												</a>
											</div>
											<div class="col-md-1 col-xs-12 col-sm-4">
												<div class="scheduled-activity-info">
													<label class="scheduler-titles"> Duration: </label> <span>{{$bookscheduler->get_clean_duration()}} </span>
												</div>
											</div>
											<div class="col-md-3 col-xs-12 col-sm-4">
												<div class="scheduled-activity-info">
													<label class="scheduler-titles"> Scheduled Activity: </label> <span> {{$bookscheduler->business_service->program_name}}</span>
												</div>
											</div>
											<div class="col-md-2 col-xs-12 col-sm-4">
												<div class="scheduled-location">
													<label class="scheduler-titles"> Location: </label> <span> {{$bookscheduler->business_service->activity_location}}</span>
												</div>
											</div>
											<div class="col-md-2 col-xs-12 col-sm-4">
												<div class="scheduled-location">
													<label class="scheduler-titles"> Instructor: </label><span> {{StaffMembers::getinstructorname($bookscheduler->business_service->instructor_id)}}</span>
												</div>
											</div>
											<div class="col-md-2 col-xs-12 col-sm-12">
												<form id="frmCompany<?=$cs?>" name="frmCompany<?=$cs?>" method="post" action="{{route('editBusinessService')}}">
													@csrf
													<div class="scheduled-btns">
														<input type="hidden" class="btn btn-black" name="btnedit" id="btnedit" value="Edit" />
									                    <input type="hidden" name="cid" value="{{ $bookscheduler->business_service->cid }}" style="width:50px" />
									                    <input type="hidden" name="serviceid" value="{{ $bookscheduler->business_service->serviceid }}" style="width:50px" />
														<button type="submit" class="btn-edit btn-sp">Edit</button>
														<a class="btn-edit"  data-toggle="modal" data-target="#bookingcancel">Cancel</a>
													</div>
												</form>
											</div>
										</div>
									</div>
									@if($date1 < $date2)
										</div>
									@endif
								@endforeach
							@endif
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6 col-xs-12 col-sm-6">
						<div class="activities-details">
							<label>Total Activities Today: </label> <span id="sccount"> {{count($bookschedulers)}} </span>
							<label>Total Reservations Today:</label> <span id="rescount">{{$total_reservations}} </span>
						</div>
					</div>
					<div class="col-md-6 col-xs-12 col-sm-6">
						<div class="pre-next-btns pre-nxt-btn-space">
							<button class="btn-previous btn-sp" onclick="getscheduledata('previous');" style="background: darkgray;" disabled id="btn-pre"><i class="fas fa-caret-left preday-arrow" ></i>Previous Day</button>
							<button class="btn-previous"  onclick="getscheduledata('next');"  id="btn-next">Next Day <i class="fas fa-caret-right nextday-arrow"></i></button>
						</div>
					</div>
				</div>
				
			</div>	
		</div>
		@include('includes.add_new_client')
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
    $( function() {
        $( "#managecalendarservice" ).datepicker( { 
        	autoclose: true,
            minDate: 0,
            changeMonth: true,
            changeYear: true   
        } );
    } );
</script>
<script>
	$( function() {
		$( "#managecalendar" ).datepicker( { minDate: 0 } );
	} );
</script>
<script src="{{ url('public/js/jquery-ui.min.js') }}"></script>


<script type="text/javascript">

	function  getscheduledata(chk) {
		date = $('#managecalendarservice').val();
		$.ajax({
			url:'{{route("activity-scheduler")}}',
			type:"GET",
			data:{
				date:date,
				chk:chk,
			},
			success:function(response){
				var data = response.split('~');
				var data1 = data[0].split('^^');
				var data2 = data1[0].split('^');

				var data3 = data[1].split('$!^');
				$('#sccount').html(data2[1]);
				$('#rescount').html(data1[1]);
				$('#bindscheduledata').html(data2[0]);
				$('#spandate').html(data3[0]);
				if(data3[1] == 'notoday'){
					$('#btn-pre').prop('disabled', false);
					$('#btn-pre').css('background','#ed1b24');
				}else{
					$('#btn-pre').prop('disabled',true );
					$('#btn-pre').css('background','darkgray');
				}
			}
		});
	}
</script>
@include('layouts.footer')

@endsection