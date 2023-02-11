@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

@php use App\ActivityCancel; $service_type_ary = array("classes","individual","events","experience");@endphp
<div class="container-fluid p-0 inner-top-activity">
	<div class="row">
		<div class="col-md-7 col-md-offset-3-custom">
			<div class="valor-mix-title">
				<h2>{{$programName}}</h2>
				<!-- <p>Booking Schedule</p> -->
				<p>{{$companyName}}</p>
			</div>
			<div class="member-txt">
				<p>If you already have a membership with multiple sessions. Reserve your spot here. If you don’t already have a membership, <a href="{{route('activities_index')}}">Book Here </a></p>
			</div>
			<!-- <div class="schedule-header">
				<h3  class="btn-nxt manage-search ">SELECT AN OPTION </h3>
			</div> -->
			<div class="activity-schedule-tabs">
				<ul class="nav nav-tabs" role="tablist">
					@foreach($service_type_ary as $st)
					<li @if($serviceType== $st ) class="active" @endif>
						<a class="nav-link" data-toggle="tab" href="#tabs-{{$st}}" role="tab" aria-expanded="true">@if( $st == 'individual') PRIVATE LESSONS @else {{strtoupper($st)}} @endif</a>
					</li>
					@endforeach
				</ul>
				<div class="tab-content" style="min-height: 600px;">
					@foreach($service_type_ary as $st)
					<div class="tab-pane @if($serviceType== $st ) active @endif" id="tabs-{{$st}}" role="tabpanel">
						<div class="row">
							@foreach ($days as $date)
								@php
									$hint_class = ($filter_date->format('Y-m-d') == $date->format('Y-m-d')) ? 'pairets' : 'pairets-inviable';
								@endphp
							
								<div class="col-md-2 col-sm-2 col-xs-6">
									<div class="{{$hint_class}}">
										<a href="{{$request->fullUrlWithQuery(['date' => $date->format('Y-m-d')])}}" class="calendar-btn">{{$date->format("D d")}}</a>
									</div>
								</div>
							@endforeach
						</div>
						<div class="tab-data">
							<div class="row">
								<div class="col-md-3 col-sm-4 col-xs-12">
									<div class="checkout-sapre-tor">
									</div>
								</div>
								<div class="col-md-6 col-sm-4 col-xs-12 valor-mix-title">
									<label>Classes on {{$filter_date->format("l, F j")}}</label>
								</div>
								<div class="col-md-3 col-sm-4 col-xs-12">
									<div class="checkout-sapre-tor">
									</div>
								</div>
							</div>
							@if($serviceType== $st && !empty($orderData)) 
								@php 
									$catelist = $orderData->business_price_detail->business_price_details_ages;
									$sche_ary = [];
									foreach($catelist->BusinessActivityScheduler as $sc){
										if($sc->end_activity_date > $filter_date->format('Y-m-d')){
											if(strpos($sc->activity_days, $filter_date->format("l")) !== false){
												$sche_ary [] = $sc;
											}
										}
									} 
								@endphp
							
							 	<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="classes-info">
											<div class="row">
												<div class="col-md-12 col-xs-12">
													<h2>{{$orderData->business_services->sport_activity}}<label class="cancel-activity" style="display:none;">Activity Cancelled</label></h2>
													<label>Program Name: </label> <span> {{$orderData->business_services->program_name}}</span>
												</div>
												<div class="col-md-12 col-xs-12">
													<label>Category Name: </label> <span>{{$catelist->category_title}}</span>
												</div>
												<div class="col-md-12 col-xs-12">
													<label>Instructor: </label> <span>@if($orderData->business_services->StaffMembers != '') {{$orderData->business_services->StaffMembers->name}} @endif</span>
												</div>
												<div class="col-md-12 col-xs-12">
													<label>Remaining Session: </label> 
													<span>
														{{$orderData->getremainingsession()}}
													</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-sm-6 col-xs-12 nopadding">
										<div class="row">
										@if(!empty($sche_ary))
											@foreach($sche_ary as $scary)
												@php 
													$duration = $scary->get_duration();

													$SpotsLeftdis = 0;
													$bs = new  \App\Repositories\BookingRepository;
													$bookedspot = $bs->getcheckincount($scary->id,$filter_date->format('Y-m-d')); 
													$SpotsLeftdis = $scary->spots_available - $bookedspot;
											
											        $checkindetail = $bs->getCheckinDetail($scary->id,$filter_date->format('Y-m-d'),$orderData->id,$orderData->booking->customer_id);

											        $cancel_chk = 0;
											        $canceldata = ActivityCancel::where(['cancel_date'=>$filter_date->format('Y-m-d'),'schedule_id'=>$scary->id])->first();

											        $date = $filter_date->format('Y-m-d');
													$time = $scary->shift_start;
													$st_time = date('Y-m-d H:i:s', strtotime("$date $time"));
													$current  = date('Y-m-d H:i:s');
													$difference = round((strtotime($st_time) - strtotime($current))/3600, 1)
												@endphp
														<div class="col-md-4 col-xs-12">
															<div class="classes-time">
																<button class="post-btn activity-scheduler @if($canceldata != '' || $checkindetail != '') gry-cancel @endif"  onclick="addtimedate({{$scary->id}} , {{$orderData->id}});" 
																@if($canceldata != '' || $checkindetail != '') disabled @endif>{{date('h:i a', strtotime($scary->shift_start))}} <br>{{$duration}}</button>
																@if($checkindetail != '' && $difference >= 24)
																	<a onclick="ReScheduleOrder({{$checkindetail->id}});">Reschedule</a>
																@endif
																<label>{{$SpotsLeftdis}}/{{$scary->spots_available}} Spots Left</label>
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
							@endif
						</div>
					</div>
					@endforeach
					<div class="valor-mix-title"> 
						<a href="{{route('personal.allActivitySchedule')}}">Want to see full scheduler?</a>
						<h2></h2>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal" id="success-reservation" role="dialog">
	    <div class="modal-dialog modal-lg booking-receipt">
	        <div class="modal-content">
	            <!-- Modal body -->
	            <div class="modal-body" id="receiptbody">
	            	<div class="row">
	            		<div class="col-md-12 text-center">
	                       <label class="pay-confirm green-fonts"> Your Reservation Is Confirmed.</label>
	                    </div>
	            	</div>
	            </div>
	        </div>
	    </div>
	</div> 

</div>


@include('layouts.footer')

<script>
	$( '.activity-schedule-tabs .nav-tabs a' ).on('click',function () {
		$( '.activity-schedule-tabs .nav-tabs' ).find( 'li.active' ).removeClass( 'active' );
		$( this ).parent( 'li' ).addClass( 'active' );
	});

	function addtimedate(sid,odid){
		//jQuery.noConflict();
		let text = "Are You Sure To Book This Date And Time?";
		if (confirm(text) == true) {
		   	$.ajax({
		   		url: "{{route('personal.schedulers.store')}}",
				type: 'POST',
				xhrFields: {
					withCredentials: true
		    	},
		    	data:{
					_token: '{{csrf_token()}}',
					date:'{{$filter_date->format("Y-m-d")}}',
					timeid:sid,
					odid:odid,
				},
				success: function (response) { /*alert(response);*/
					$('#success-reservation').modal('show');
 					$(".activity-schedule-tabs").load(location.href+" .activity-schedule-tabs>*","");
					//swindow.location.reload();
				}
		   	});
		}
	}

	function ReScheduleOrder(checkinId){
		let text = "Are You Sure To ReSchedule This Booking?";
		if (confirm(text) == true) {
		   	$.ajax({
		   		url: "/personal/schedulers/" + checkinId,
				method: "DELETE",
		    	data:{
					_token: '{{csrf_token()}}',
				},
				success: function (response) { /*alert(response);*/
 					location.reload();
				}
		   	});
		}
	}
</script>

@endsection