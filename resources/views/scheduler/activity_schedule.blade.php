@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

@php use App\ActivityCancel; $service_type_ary = array("classes","individual","events","experience");@endphp
<div class="container-fluid p-0 inner-top-activity">
	<div class="row">
		<div class="col-md-7 col-md-offset-3-custom">
			<div class="valor-mix-title">
				<h2>{{$orderdata->business_services->program_name}}</h2>
				<p>Booking Schedule</p>
			</div>
			<div class="member-txt">
				<p>If you already have a memerbship with multiple sessions. Reserve your spot here. If you don’t already have a membership, <a href="{{route('activities_index')}}">Book Here </a></p>
			</div>
			<div>
				<button type="button" class="btn-nxt manage-search">SELECT AN OPTION </button>
			</div>
			<div class="activity-schedule-tabs">
				<ul class="nav nav-tabs" role="tablist">
					@foreach($service_type_ary as $st)
					<li @if($orderdata->business_services->service_type == $st ) class="active" @endif>
						<a class="nav-link" data-toggle="tab" href="#tabs-{{$st}}" role="tab" aria-expanded="true">@if( $st == 'individual') PRIVATE LESSONS @else {{strtoupper($st)}} @endif</a>
					</li>
					@endforeach
				</ul>
				<div class="tab-content">
					@foreach($service_type_ary as $st)
					<div class="tab-pane @if($orderdata->business_services->service_type == $st ) active @endif" id="tabs-{{$st}}" role="tabpanel">
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
							@if($orderdata->business_services->service_type == $st ) 
								@php 
									$catelist = $orderdata->business_price_details->business_price_details_ages;
									$sche_ary = [];
									foreach($catelist->BusinessActivityScheduler as $sc){
										if($sc->end_activity_date > $filter_date->format('Y-m-d')){
											if(strpos($sc->activity_days, date("l")) !== false){
												$sche_ary [] = $sc;
											}
										}
									} 
								@endphp
								@if( $orderdata->act_schedule_id == '' )
							 	<div class="row">
									<div class="col-md-6 col-sm-6 col-xs-12">
										<div class="classes-info">
											<div class="row">
												<div class="col-md-12 col-xs-12">
													<h2>{{$orderdata->business_services->sport_activity}}<label class="cancel-activity" style="display:none;">Activity Cancelled</label></h2>
													<label>Program Name: </label> <span> {{$orderdata->business_services->program_name}}</span>
												</div>
												<div class="col-md-12 col-xs-12">
													<label>Category Name: </label> <span>{{$catelist->category_title}}</span>
												</div>
												<div class="col-md-12 col-xs-12">
													<label>Instructor: </label> <span>@if($orderdata->business_services->StaffMembers != '') {{$orderdata->business_services->StaffMembers->name}} @endif</span>
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
													$bookedspot = $bs->gettotalbooking($scary->id,$filter_date->format('Y-m-d')); 
													$SpotsLeftdis = $scary->spots_available - $bookedspot;
													$cancel_chk = 0;
											        
											        $canceldata = ActivityCancel::where(['cancel_date'=>$filter_date->format('Y-m-d'),'schedule_id'=>$scary->id])->first();
												@endphp
														<div class="col-md-4 col-xs-12">
															<div class="classes-time">
																<button class="post-btn activity-scheduler @if($canceldata != '') gry-cancel @endif"  onclick="addtimedate({{$scary->id}});" @if($canceldata != '') disabled @endif>{{date('h:i a', strtotime($scary->shift_start))}} <br>{{$duration}}</button>
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
							@endif
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$( '.activity-schedule-tabs .nav-tabs a' ).on('click',function () {
		$( '.activity-schedule-tabs .nav-tabs' ).find( 'li.active' ).removeClass( 'active' );
		$( this ).parent( 'li' ).addClass( 'active' );
	});

	function addtimedate(sid){
		let text = "Are You Sure To Book This Date And Time?";
		if (confirm(text) == true) {
		   	$.ajax({
		   		url: "{{route('updateorderdetails')}}",
				type: 'POST',
				xhrFields: {
					withCredentials: true
		    		},
		    		data:{
					_token: '{{csrf_token()}}',
					type: 'POST',
					date:'{{$filter_date->format("Y-m-d")}}',
					timeid:sid,
					odid:'{{$odid}}',
				},
				success: function (response) { /*alert(response);*/
					window.location.reload();
				}
		   	});
		}
	}
</script>
@include('layouts.footer')

@endsection