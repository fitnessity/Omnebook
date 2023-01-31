@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

@php
	 use App\StaffMembers;
@endphp

<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">
        <div class="col-md-2 col-sm-12" style="background: black;">
        	 @include('business.businessSidebar')
        </div>
		<div class="col-md-10 col-sm-12">
      <div class="container-fluid p-0">
				<div class="row">
					<div class="col-md-6 col-xs-12 col-sm-12">
						<div class="tab-hed scheduler-txt"><span class="font-red">Activity Scheduler </span> </div> 
					</div>
					<div class="col-md-6 col-xs-12 col-sm-12">
						@include('customers._search_header', ['company_id' => request()->current_company->id])
					</div>
	 					
 				</div>
			</div>
			<hr style="border: 3px solid black; width: 125%; margin-left: -38px; margin-top: 5px;">
		  
		  <div class="container-fluid plr-0">
		  	<form method="GET">
					<div class="row">
						<div class="col-md-3 col-xs-12 col-sm-6">
							 <div class="date-activity-scheduler">
	                <label for="">Date:</label>
	                <div class="activityselect3 special-date">
										<input type="text" name="date" class="form-control" autocomplete="off" value="{{$filter_date->format('m/d/Y')}}" data-behavior="on_change_submit datepicker">
									</div>
	              </div>
						</div>
						<div class="col-md-6 col-xs-12 col-sm-12">
							<div class="priceactivity-scheduler">
                <select name="activity_type" class="form-control valid" data-behavior="on_change_submit">
									<option value=""> Show All Activities </option>
									<option value="individual" @if(request()->activity_type == 'individual') selected @endif>Personal Trainer</option>
									<option value="classes" @if(request()->activity_type == 'classes') selected @endif>Classes</option>
									<option value="events" @if(request()->activity_type == 'events') selected @endif>Events</option>
									<option value="experience" @if(request()->activity_type == 'experience') selected @endif>Experience</option>
                </select>
							</div>
						</div>
						
					</div>
				</form>
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

						<div id="bindscheduledata">
							@php
								$total_reservations = 0;
							@endphp
							@foreach ($business_schedulers as $business_scheduler)
								@php 
									$total_reservations += $business_scheduler->spots_reserved($filter_date);
									$schedule_end = strtotime($filter_date->format('Y/m/d').' '.$business_scheduler['shift_end']);
							 	@endphp
							 	@if ($schedule_end < time())
									<div class="overlay-activity">
		                <div class="scheduler-info-box">
			                <div class="row">
    	                	<div class="col-md-1 col-xs-12 col-sm-4">
    											<div class="timeline">
    												<label class="scheduler-titles">Time: </label> 
    												<span>{{date('h:i A', strtotime($business_scheduler['shift_start']))}}</span>
    												<span>{{date('h:i A', strtotime($business_scheduler['shift_end']))}}</span>
    											</div>
    										</div>
                        <div class="col-md-1 col-xs-12 col-sm-4">    
                        	<a href="{{route('business.schedulers.checkin_details.index',['scheduler'=>$business_scheduler->id, 'date' =>$filter_date->format('m/d/Y')])}}" class="scheduler-qty">
                        		<label class="scheduler-titles">QTY: </label> 
                        		<span> {{$business_scheduler->spots_left($filter_date)}}/{{$business_scheduler->spots_available}} </span>
                        	</a>
                        </div>
    	                  <div class="col-md-1 col-xs-12 col-sm-4 nopadding">
    	                  	<div class="scheduled-activity-info">
    	                  		<label class="scheduler-titles"> Duration: </label> <span>{{$business_scheduler->get_duration()}} </span>
    	                  	</div>
    	                  </div>
    										<div class="col-md-3 col-xs-12 col-sm-4">
    											<div class="scheduled-activity-info">
    												<label class="scheduler-titles"> Scheduled Activity: </label> 
    												<span>{{$business_scheduler->business_service->program_name}}</span>
    											</div>
    										</div>
                        <div class="col-md-2 col-xs-12 col-sm-4">
                         	<div class="scheduled-location">
                         		<label class="scheduler-titles"> Location: </label> <span> {{$business_scheduler->business_service->activity_location}}</span>
                         	</div>
                        </div>
			                  <div class="col-md-2 col-xs-12 col-sm-4">
                          <div class="scheduled-location">
                            <label class="scheduler-titles"> Instructor: </label>
                            <span>—</span>
                        	</div>
			                  </div>
	                     	<div class="col-md-1 col-xs-12 col-sm-4 nopadding">
	                        <label class="overlay-activity-label">Activity Completed</label>
	                     	</div>
			                  <div class="col-md-1 col-xs-12 col-sm-12">
			                  	<form name="frmservice" method="post" action="{{route('editBusinessService')}}">
			                  		@csrf
														<div class="scheduled-btns">
	                            <input type="hidden" name="btnedit" value="Edit">
	                            <input type="hidden" name="cid" value="{{request()->current_company->id}}">
	                            <input type="hidden" name="serviceid" value="{{$business_scheduler->business_service->id}}">
	                            <button type="submit" class="btn-edit btn-sp">Edit</button>
	                            <button type="button" class="btn-edit" disabled="">Cancel</button>
			                    	</div>
			                  	</form>
			                  </div>
			                </div>
		           			</div>
		         			</div>
		         		@else

	                <div class="scheduler-info-box">
		                <div class="row">
		                	<div class="col-md-1 col-xs-12 col-sm-4">
												<div class="timeline">
													<label class="scheduler-titles">Time: </label> 
													<span>{{date('h:i A', strtotime($business_scheduler['shift_start']))}}</span>
													<span>{{date('h:i A', strtotime($business_scheduler['shift_end']))}}</span>
												</div>
											</div>
	                    <div class="col-md-1 col-xs-12 col-sm-4">    
	                    	<a href="{{route('business.schedulers.checkin_details.index',['scheduler'=>$business_scheduler->id, 'date' =>$filter_date->format('m/d/Y')])}}" class="scheduler-qty">
	                    		<label class="scheduler-titles">QTY: </label> 
	                    		<span> {{$business_scheduler->spots_left($filter_date)}}/{{$business_scheduler->spots_available}} </span>
	                    	</a>
	                    </div>
		                  <div class="col-md-1 col-xs-12 col-sm-4 nopadding">
		                  	<div class="scheduled-activity-info">
		                  		<label class="scheduler-titles"> Duration: </label> <span>{{$business_scheduler->get_duration()}} </span>
		                  	</div>
		                  </div>
											<div class="col-md-3 col-xs-12 col-sm-4">
												<div class="scheduled-activity-info">
													<label class="scheduler-titles"> Scheduled Activity: </label> 
													<span>{{$business_scheduler->business_service->program_name}}</span>
												</div>
											</div>
	                    <div class="col-md-2 col-xs-12 col-sm-4">
	                     	<div class="scheduled-location">
	                     		<label class="scheduler-titles"> Location: </label> <span> {{$business_scheduler->business_service->activity_location}}</span>
	                     	</div>
	                    </div>
		                  <div class="col-md-2 col-xs-12 col-sm-4">
	                      <div class="scheduled-location">
	                        <label class="scheduler-titles"> Instructor: </label>
	                        <span>—</span>
	                    	</div>
		                  </div>
		                  <div class="col-md-2 col-xs-12 col-sm-12">
		                  	<form name="frmservice" method="post" action="{{route('editBusinessService')}}">
		                  		@csrf
													<div class="scheduled-btns">
                            <input type="hidden" name="btnedit" value="Edit">
                            <input type="hidden" name="cid" value="{{request()->current_company->id}}">
                            <input type="hidden" name="serviceid" value="{{$business_scheduler->business_service->id}}">
                            <button type="submit" class="btn-edit btn-sp">Edit</button>
                            <button type="button" class="btn-edit" data-behavior="ajax_html_modal" data-url="{{route("business.schedulers.delete_modal", ['business_scheduler_id' => $business_scheduler->id, 'date' => $filter_date->format('m/d/Y'), 'return_url' => url()->full()])}}">Cancel</button>
		                    	</div>
		                  	</form>
		                  </div>
		                </div>
	           			</div>
		         		@endif
	         		@endforeach
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6 col-xs-12 col-sm-6">
						<div class="activities-details">
							<label>Total Activities Today: </label> <span id="sccount"> {{count($business_schedulers)}} </span>
							<label>Total Reservations Today:</label> <span id="rescount">{{$total_reservations}} </span>
							{{$filter_date->addDay()->format('m/d/Y')}}
						</div>
					</div>
					<div class="col-md-6 col-xs-12 col-sm-6">
						<div class="pre-next-btns pre-nxt-btn-space">
							<a class="btn-previous btn-sp" style="background: darkgray;" href="{{route('business.schedulers.index', array_merge(request()->query(), ['date' => $filter_date->subDay()->format('m/d/Y')]))}}"  disabled id="btn-pre"><i class="fas fa-caret-left preday-arrow" ></i>Previous Day</a>
							<a class="btn-previous" id="btn-next" href="{{route('business.schedulers.index', array_merge(request()->query(), ['date' => $filter_date->addDay()->format('m/d/Y')]))}}">Next Day <i class="fas fa-caret-right nextday-arrow"></i></a>
						</div>
					</div>
				</div>
				
			</div>	
		</div>
</div>
		<!-- The Modal Add Business-->
		<div class="modal fade compare-model in" id="bookingcancelmodel">
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
						<div id="cancellationdata">
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end modal -->
	</div>

</div>


<script type="text/javascript">
	
</script>
<script type="text/javascript">
	$(document).on('change', '[data-behavior~=on_change_submit]', function(e){
		e.preventDefault()

		$(this).parents('form').submit();

	})

	$(document).on('click', '[data-behavior~=disable_scheduler]', function(e){
		e.preventDefault()

	})
</script>

@include('layouts.footer')

@endsection