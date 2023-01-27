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
                <select name="frm_servicesport" class="form-control valid" data-behavior="on_change_submit">
									<option value="all"> Show All Activities </option>
									<option value="individual">Personal Trainer</option>
									<option value="classes">Classes</option>
									<option value="events">Events</option>
									<option value="experience">Experience</option>
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
                        	<a href="{{route('booking_checkin_details_index',['business_activity_scheduler_id'=>$business_scheduler->id])}}" class="scheduler-qty">
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
	                     	<div class="col-md-1 col-xs-12 col-sm-4">
	                        <label class="overlay-activity-label">Activity Completed</label>
	                     	</div>
			                  <div class="col-md-1 col-xs-12 col-sm-12">
                         	<input name="_token" type="hidden" value="JLkwuOIVrxJovIsrY5fxBtCNDZxJuSeHLxuLmq0I">
													<div class="scheduled-btns">
                            <input type="hidden" class="btn btn-black" name="btnedit" id="btnedit" value="Edit">
                            <input type="hidden" name="cid" value="68" style="width:50px">
                            <input type="hidden" name="serviceid" value="20" style="width:50px">
                            <button type="submit" class="btn-edit btn-sp">Edit</button>
                            <button type="button" class="btn-edit" disabled="">Cancel</button>
			                    </div>
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
	                    	<a href="{{route('booking_checkin_details_index',['business_activity_scheduler_id'=>$business_scheduler->id])}}" class="scheduler-qty">
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
                       	<input name="_token" type="hidden" value="JLkwuOIVrxJovIsrY5fxBtCNDZxJuSeHLxuLmq0I">
												<div class="scheduled-btns">
                          <input type="hidden" class="btn btn-black" name="btnedit" id="btnedit" value="Edit">
                          <input type="hidden" name="cid" value="68" style="width:50px">
                          <input type="hidden" name="serviceid" value="20" style="width:50px">
                          <button type="submit" class="btn-edit btn-sp">Edit</button>
                          <button type="button" class="btn-edit" disabled="">Cancel</button>
		                    </div>
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

	function getcancellationdata(val,clientcnt,insname){
		date = $('#managecalendarservice').val();
		$.ajax({
			url:'{{route("cancelbookingmodel")}}',
			type:"POST",
			data:{
				date:date,
				sid: val,
				clientcnt: clientcnt,
				insname: insname,
				_token: '{{csrf_token()}}',
			},
			success:function(response){
				$("#bookingcancelmodel").modal('show')
				$('#cancellationdata').html(response);
			}
		});
	}

	function  getscheduledata(chk,val) {
		date = $('#managecalendarservice').val();
		$.ajax({
			url:'{{route("business.schedulers.index")}}',
			type:"GET",
			data:{
				date:date,
				chk:chk,
				dropval:val,
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
				if(data3[1] == 'notodaydate'){
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