@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

@php $service_type_ary = array("classes","individual","events","experience");@endphp
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
                   <!--  <li @if($service_data->service_type == 'individual' ) class="active" @endif>
                        <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" aria-expanded="false">PRIVATE LESSONS</a>
					</li>
                    <li @if($service_data->service_type == 'events' ) class="active" @endif>
						<a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab" aria-expanded="false">EVENTS</a>
					</li>
                    <li @if($service_data->service_type == 'experience' ) class="active" @endif>
                         <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab" aria-expanded="false">EXPERIENCES</a>
					</li> -->
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
											$sche_ary [] = $sc;
										}
									} 
								@endphp
									@if(count($sche_ary) >0)
								 	<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="classes-info">
												<div class="row">
													<div class="col-md-12 col-xs-12">
														<h2>{{$orderdata->business_services->sport_activity}}</h2>
														<label>Program Name: </label> <span> {{$orderdata->business_services->program_name}}</span>
													</div>
													<div class="col-md-12 col-xs-12">
														<label>Category Name: </label> <span>{{$catelist->category_title}}</span>
													</div>
													<!-- <div class="col-md-12 col-xs-12">
														<label>Duration: </label> <span> 30 Min</span>
													</div> -->
													<div class="col-md-12 col-xs-12">
														<label>Instructor: </label> <span>@if($orderdata->business_services->StaffMembers != '') {{$service_data->StaffMembers->name}} @endif</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12 nopadding">
											<div class="row">
											@foreach($sche_ary as $scary)
												@php 
													$duration = $scary->get_duration();
													$SpotsLeftdis = 0;
													$bs = new  \App\Repositories\BookingRepository;
													$bookedspot = $bs->gettotalbooking($scary->id,date('Y-m-d')); 
													$SpotsLeftdis = $scary->spots_available - $bookedspot;
												@endphp
														<div class="col-md-4 col-xs-12">
															<div class="classes-time">
																<button class="post-btn activity-scheduler"  onclick="addtimedate({{$scary->id}});">{{date('h:i a', strtotime($scary->shift_start))}} <br>{{$duration}}</button>
																<label>{{$SpotsLeftdis}}/{{$scary->spots_available}} Spots Left</label>
															</div>
														</div>
											@endforeach
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
					<!-- <div class="tab-pane" id="tabs-2" role="tabpanel">
						<div class="row">
							@foreach ($days as $date)
								@php
									$hint_class = ($filter_date->format('Y-m-d') == $date->format('Y-m-d')) ? 'pairets' : 'pairets-inviable';
								@endphp
							
								<div class="col-md-2 col-sm-2 col-xs-6">
									<div class="{{$hint_class}}">
										<a href="" class="calendar-btn">{{$date->format("D d")}}</a>
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
						</div>
					</div>
                   	 	<div class="tab-pane" id="tabs-3" role="tabpanel">
                    	<div class="row">
							@foreach ($days as $date)
								@php
									$hint_class = ($filter_date->format('Y-m-d') == $date->format('Y-m-d')) ? 'pairets' : 'pairets-inviable';
								@endphp
							
								<div class="col-md-2 col-sm-2 col-xs-6">
									<div class="{{$hint_class}}">
										<a href="" class="calendar-btn">{{$date->format("D d")}}</a>
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
						</div>
					</div>
					<div class="tab-pane" id="tabs-4" role="tabpanel">
						<div class="row">
							@foreach ($days as $date)
								@php
									$hint_class = ($filter_date->format('Y-m-d') == $date->format('Y-m-d')) ? 'pairets' : 'pairets-inviable';
								@endphp
							
								<div class="col-md-2 col-sm-2 col-xs-6">
									<div class="{{$hint_class}}">
										<a href="" class="calendar-btn">{{$date->format("D d")}}</a>
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
						</div>
					</div> -->
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
		alert(sid);
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
				},
				success: function (response) { /*alert(response);*/
				}
		   	});
		}
	}
</script>
@include('layouts.footer')

@endsection