@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')

   <div class="main-content">
		<div class="page-content">
         <div class="container-fluid">
            <div class="row">
               <div class="col">
                  <div class="h-100">
                     <div class="row mb-3">
								<div class="col-6">
									<div class="page-heading">
										<label>Activity Scheduler </label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="card">
										<div class="card-header border-0">
											<h4 class="card-title mb-0">Date</h4>
												<a onclick="alert();">asdf</a>
										</div><!-- end cardheader -->
										<div class="card-body pt-0 card-350-body">
											<form method="GET">
												<div class="row">
													<div class="col-xxl-3 col-lg-4 col-md-7 col-sm-6">
														<div class="input-group mmb-10">
															<input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-range" name="date" autocomplete="off" value="{{$filterDate->format('m/d/Y')}}" data-behavior="on_change_submit">
															<div class="input-group-text bg-primary border-primary text-white">
																<i class="ri-calendar-2-line"></i>
															</div>
														</div>
													</div>
													<div class="col-xxl-2 col-lg-3 col-md-5 col-sm-5">
														<div class="steps-title mmb-10">
															<div class="mb-3">
																<select name="activity_type" data-behavior="on_change_submit" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
																	<option value=""> Show All Activities </option>
																	<option value="individual" @if(request()->activity_type == 'individual') selected @endif>Personal Trainer</option>
																	<option value="classes" @if(request()->activity_type == 'classes') selected @endif>Classes</option>
																	<option value="events" @if(request()->activity_type == 'events') selected @endif>Events</option>
																	<option value="experience" @if(request()->activity_type == 'experience') selected @endif>Experience</option>
																</select>
															</div>
														</div>												
													</div>
												</div>
											</form>

											<h6 class="text-uppercase fw-semibold mt-4 mb-3 text-muted"></h6>

											@php
											   $scheduleIds = implode(',', $schedules->pluck('id')->toArray());
											@endphp

											<div class="row">
												<div class="col-md-12">
													<div class="text-right">
														<button type="button" class="btn btn-red" data-behavior="ajax_html_modal" data-url="{{route('business.schedulers.cancel_all', ['schedulerId' => rtrim($scheduleIds, ','), 'date' => $filterDate->format('m/d/Y'), 'return_url' => url()->full()])}}">Cancel All Activity Of Today</button>
													
														<button type="button" class="btn btn-red" data-behavior="ajax_html_modal" data-url="{{route('business.schedulers.cancel_all_by_date', ['activity_type'=>request()->activity_type, 'return_url' => url()->full()])}}">Cancel Multiple Days</button>
													</div>
												</div>
											</div>
											
											@php $total_reservations = 0; @endphp
											@foreach ($schedules as $i=>$schedule)
												@php 
													$total_reservations += $schedule->spots_reserved($filterDate);
													$schedule_end = strtotime($filterDate->format('Y/m/d').' '.$schedule['shift_end']);
													$insName = $schedule->getInstructure($filterDate->format('Y-m-d'))
											 	@endphp
												<div class="mini-stats-wid d-flex align-items-center mt-3 scheduler-box">
													<div class="flex-shrink-0 right-spretar">
														<p class="text-muted mb-0">{{date('h:i A', strtotime($schedule['shift_start']))}}</p>
														<p class="text-muted mb-0">{{date('h:i A', strtotime($schedule['shift_end']))}}</p>
													</div>
													<div class="flex-shrink-0 avatar-sm ms-3">
														<a class="cursor-pointer" onclick="getCheckInDetails({{$schedule->id}},'{{$filterDate->format("m/d/Y")}}','','','','','')">
															<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4">
																{{$schedule->spots_left($filterDate)}}/{{$schedule->spots_available}}
															</span>
														</a>
													</div>
													<div class="flex-grow-auto ms-3">
														<h3 class="fs-15 mb-1"> @if($schedule->business_service()->exists())  {{$schedule->businessPriceDetailsAges->category_title}} @endif </h3>
														<p class="mb-1"> {{$insName != '' ? 'with '.$insName : ''}} <!-- @if($schedule->business_service()->exists()) {{$schedule->business_service->program_name}} @endif @if($schedule->businessPriceDetailsAges()->exists()) @endif -->  </p> 
														
														<p class="text-muted mb-0">with {{$schedule->company_information->public_company_name}} @if($schedule->business_service()->exists()) {{$schedule->business_service->activity_location}} @endif </p>
													</div>
													<div class="flex-grow-auto ms-3">
														@if($schedule->activity_cancel->where('cancel_date',$filterDate->format('Y-m-d'))->first())
															@if($schedule->activity_cancel->where('cancel_date',$filterDate->format('Y-m-d'))->first()->cancel_date_chk == 1)
																<p class="font-red mb-0 fs-17 act-cancel-p">Activity Cancelled </p>
															@endif
														@endif
													</div>
													<div class="flex-grow-1 ms-3">
														<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".activity-scheduler{{$i}}"><i class="ri-more-fill"></i></a>
													</div>
												</div>

												<div class="modal fade activity-scheduler{{$i}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered modal-70">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="myModalLabel">Activity Scheduler</h5>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
															</div>
															<div class="modal-body">
																<div class="scheduler-table">
																	<div class="table-responsive">
																		<table class="table mb-0">
																			<thead>
																				<tr>
																					<th>Status</th>
																					<th>Duration</th>
																					<th>Location</th>
																					<th> Instructor</th>
																					<th></th>
																				</tr>
																			</thead>
																			<tbody>
																				@php $cancelchk = $schedule->activity_cancel()->where(['cancel_date'=>$filterDate->format('Y-m-d'),'act_cancel_chk'=>1])->first(); @endphp
																				<tr>
																					<td>
																						<label class="overlay-activity-label">
																							@if ($schedule_end < time()) 	Activity Completed 
																							@elseif($cancelchk != '') Activity Canceled  
																							@else Activity Remaining @endif</label>
																					</td>
																					<td>
																						<div class="scheduled-activity-info">
																							<span>{{$schedule->get_duration()}}  </span>
																						</div>
																					</td>
																					<td>
																						<div class="scheduled-location">
																							<span> @if($schedule->business_service()->exists()) {{$schedule->business_service->activity_location}}@endif </span>
																						</div>
																					</td>
																					<td>
																						<div class="scheduled-location">
																							<span> {{ $schedule->business_service()->exists() ? ( $schedule->business_service->BusinessStaff()->exists() ? ucfirst($schedule->business_service->BusinessStaff->full_name) : "N/A" )  : "N/A"}}</span>
																						</div>
																					</td>
																					<td>
																						<?php 
																							$serviceType = $schedule->business_service()->exists() ? $schedule->business_service->service_type : '' ;

																							$serviceId= $schedule->business_service()->exists() ? $schedule->business_service->id : '' ;
																						?>
																						<div class="scheduled-btns">
																	                  <a class="btn-red mb-10 text-center" href="{{route('business.services.create',['serviceType'=>$serviceType,'serviceId'=>$serviceId])}}" target="_blank">Edit</a>
																	                  @if ($schedule_end > time()) 
																		                  <button type="button" class="btn-black" data-behavior="ajax_html_modal" data-url="{{route('business.schedulers.delete_modal', ['schedulerId' => $schedule->id, 'date' => $filterDate->format('m/d/Y'), 'return_url' => url()->full()])}}" >
																		                  	@if($schedule->activity_cancel->where('cancel_date',$filterDate->format('Y-m-d'))->first())
																										@if($schedule->activity_cancel->where('cancel_date',$filterDate->format('Y-m-d'))->first()->cancel_date_chk == 1)
																											Uncanel 
																										@else
																											Cancel
																										@endif
																									@else
																										Cancel
																									@endif
																								</button>
																	                  @endif
																	               </div>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											@endforeach

											<div class="row">
												<div class="col-md-6 col-xs-12 col-sm-6">
													<div class="activities-details mt-10">
														<label>Total Activities Today: </label> <span id="sccount"> {{count($schedules)}}   </span>
														<label>Total Reservations Today:</label> <span id="rescount">{{$total_reservations}}   </span> 
														<label>Next Date:</label>
														{{$filterDate->addDay()->format('m/d/Y')}}
													</div>
												</div>
												<div class="col-md-6 col-xs-12 col-sm-6">
													<div class="pre-next-btns pre-nxt-btn-space mt-10">
														<a class="btn-previous btn-sp btn-black" href="{{route('business.schedulers.index', array_merge(request()->query(), ['date' => $filterDate->subDay()->format('m/d/Y')]))}}" disabled="" id="btn-pre">
															<i class="fas fa-caret-left preday-arrow"></i>Previous Day
														</a>
														
														<a class="btn-previous btn-red" id="btn-next" href="{{route('business.schedulers.index', array_merge(request()->query(), ['date' => $filterDate->addDay()->format('m/d/Y')]))}}">Next Day <i class="fas fa-caret-right nextday-arrow"></i></a>
													</div>
												</div>
											</div>
										</div><!-- end cardbody -->
									</div><!-- end card -->
								</div><!--end col-->
							</div>		
						</div>
               </div> 
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade checkinDetails" tabindex="-1" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-70">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Activity Scheduler Check-In</h5>
					<button type="button" class="btn-close" onclick="window.location.reload()"></button>
			</div>
			<div class="modal-body" id="checkInHtml">

			</div>
		</div>
	</div>
</div>

	@include('layouts.business.footer')
	<script>
		flatpickr(".flatpickr-range", {
	      dateFormat: "m/d/Y",
	      maxDate: "01/01/2050",
	   });
		 
		flatpickr(".flatpickr-range-birthdate", {
	      dateFormat: "m/d/Y",
	      maxDate: "01/01/2050",
			defaultDate: [new Date()],
	   });
			 
	</script>

	<script type="text/javascript">
		$(document).on('change', '[data-behavior~=on_change_submit]', function(e){
			e.preventDefault()
			$(this).parents('form').submit();
		});

		$(document).on('click', '[data-behavior~=disable_scheduler]', function(e){
			e.preventDefault()
		});

		function getCheckInDetails(scheduleId,date,chkInID,cus_id,chk,chkMsg,chkInMsg){
			var business_id = '{{$request->current_company->id}}';
			$.ajax({	
				url:"/business/"+business_id+"/schedulers/"+scheduleId+"/checkin_details?date="+date+"&chkInId="+chkInID+"&cus_id="+cus_id+"&chk="+chk+"&msg="+chkMsg+"&chkInMsg="+chkInMsg,
				type:'GET',
				success:function(data){
					$('#checkInHtml').html(data);
					$('.checkinDetails').modal('show');
				}
			});	
		}

		/*$(document).ready(function() {
			var scheduleId = '{{@$flagScheduleId}}';
			var date = '{{@$flagDate}}';
			if(date != '' && scheduleId != ''){
				getCheckInDetails(scheduleId,date,'')
			}
		});*/


	</script>

@endsection