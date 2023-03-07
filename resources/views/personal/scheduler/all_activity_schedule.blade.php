@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<style>
.schedulers-arrows{
	position: relative;
}
.schedulers-arrows .owl-nav .owl-prev{
	position: absolute;
	top: 32px;
	left: -25px;
}
.schedulers-arrows .owl-nav .owl-next{
	position: absolute;
	top: 31px;
	right: -25px;
}
</style>

@php  use App\ActivityCancel; $service_type_ary = array("classes","individual","events","experience");@endphp
<div class="container-fluid p-0 inner-top-activity">
	<div class="row">
		<div class="col-md-7 col-xs-12 col-md-offset-3-custom">
			<div class="valor-mix-title">
				<h2>{{$companyName}}</h2>
				<p>Booking Schedule</p>
			</div>
			<div class="member-txt">
				<p>If you already have a membership with multiple sessions. Reserve your spot here. If you don’t already have a membership, <a href="{{route('activities_index')}}">Book Here </a></p>
			</div>

			<div class="activity-schedule-tabs">
				<ul class="nav nav-tabs" role="tablist">
					@foreach($service_type_ary as $st)
					<li @if($serviceType == $st ) class="active" @endif>
						<a class="nav-link" href="{{$request->fullUrlWithQuery(['stype' => $st])}}"  aria-expanded="true">@if( $st == 'individual') PRIVATE LESSONS @else {{strtoupper($st)}} @endif</a>
					</li>
					@endforeach
				</ul>
				<div class="tab-content" style="min-height: 600px;">
					@foreach($service_type_ary as $st)
					<div class="tab-pane @if($serviceType == $st ) active @endif" id="tabs-{{$st}}" role="tabpanel">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12 text-right">
								<div class="calendar-icon">
									<input type="text" name="date" class="date datepicker" readonly placeholder="DD/MM/YYYY" />
								</div>
							</div>
						</div>
						<div class="row">
							<div class="owl-carousel owl-theme schedulers-arrows">
							@foreach ($days as $date)
								@php
									$hint_class = ($filter_date->format('Y-m-d') == $date->format('Y-m-d')) ? 'pairets' : 'pairets-inviable';
								@endphp
								<div class="item">
									<div class="{{$hint_class}}">
										<a href="{{$request->fullUrlWithQuery(['date' => $date->format('Y-m-d')])}}" class="calendar-btn">{{$date->format("D d")}}</a>
									</div>
								</div>
							@endforeach
							</div>
						</div>
						
						<div class="tab-data">
							<div class="row">
								<div class="col-md-4 col-sm-4 col-xs-12">
									<div class="checkout-sapre-tor">
									</div>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-12 valor-mix-title nopadding">
									<label>Activities on {{$filter_date->format("l, F j")}}</label>
								</div>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<div class="checkout-sapre-tor">
									</div>
								</div>
							</div>
							<div class="activity-tabs">
								@if($serviceType == $st && !empty($orderdata))
									@foreach($orderdata as $odt)
									@php 
										$catelist = '';
										if($odt->business_price_detail != ''){
											$catelist = $odt->business_price_detail->business_price_details_ages;
										}
										$sche_ary = [];
										if($catelist != ''){
											foreach($catelist->BusinessActivityScheduler as $sc){
												if($sc->end_activity_date > $filter_date->format('Y-m-d')){
													if(strpos($sc->activity_days, date("l")) !== false){
														$sche_ary [] = $sc;
													}
												}
											} 
										}
									@endphp
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="classes-info">
												<div class="row">
													<div class="col-md-12 col-xs-12">
														<h2>{{$odt->business_services->sport_activity}}</h2>
														<label>Program Name: </label> <span> {{$odt->business_services->program_name}}</span>
													</div>
													<div class="col-md-12 col-xs-12">
														<label>Category Name: </label> <span>{{@$catelist->category_title}}</span>
													</div>
													<div class="col-md-12 col-xs-12">
														<label>Instructor: </label> <span>@if($odt->business_services->StaffMembers != '') {{$odt->business_services->StaffMembers->name}} @endif</span>
													</div>
													<div class="col-md-12 col-xs-12">
														<label>Remaining Session: </label> 
														<span>
															{{$odt->getremainingsession()}}
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
														$bookedspot = $bs->gettotalbooking($scary->id,$filter_date->format('Y-m-d')); 
														$SpotsLeftdis = $scary->spots_available - $bookedspot;
														
												        $checkindetail = $bs->getCheckinDetail($scary->id,$filter_date->format('Y-m-d'),$odt->id,$odt->booking->customer_id);

												        $cancel_chk = 0;
														$canceldata = ActivityCancel::where(['cancel_date'=>$filter_date->format('Y-m-d'),'schedule_id'=>$scary->id])->first();
														$date = $filter_date->format('Y-m-d');
														$time = $scary->shift_start;
														$st_time = date('Y-m-d H:i:s', strtotime("$date $time"));
														$current  = date('Y-m-d H:i:s');
														$difference = round((strtotime($st_time) - strtotime($current))/3600, 1)
													@endphp
															<div class="col-md-4 col-sm-5 col-xs-12">
																<div class="classes-time">
																	<button class="post-btn activity-scheduler @if($canceldata != '' || $checkindetail != '') gry-cancel @endif"  onclick="addtimedate({{$scary->id}},{{$odt->id}});" 
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
									@endforeach
								@endif
							</div>
						</div>

					</div>
					@endforeach
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
	                       <label class="pay-confirm "></label>
	                    </div>
	            	</div>
	            </div>
	        </div>
	    </div>
	</div> 

</div>


@include('layouts.footer')
<script>
	$('.owl-carousel').owlCarousel({
	    loop:true,
	    margin:10,
	    nav:true,
		navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
	    responsive:{
	        0:{
	            items:1
	        },
	        600:{
	            items:3
	        },
	        1000:{
	            items:5
	        }
	    }
		
	});
</script>

<script>
	$(function() {
		$( ".date" ).datepicker({
		 	dateFormat : 'yy-mm-dd',
		 	showOn: "both",
		 	buttonImage: "/public/img/calendar-icon.png",
		 	buttonImageOnly: true,
		 	buttonText: "Select date",
		 	changeMonth: true,
		 	changeYear: true,
		 	yearRange: "-100:+100"
		}); 
	});

	$( ".datepicker" ).change(function(){
		var date  = $(this).val();
		var businessId = '{{$businessId}}';
		var serviceType = '{{$serviceType}}';
		window.location = '/activities/'+businessId+'?stype=' + serviceType+'&date='+date;
    });
</script>

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
					businessId:'{{$businessId}}',
				},
				success: function (response) { /*alert(response);*/

					if(response == 'success'){
						$('.pay-confirm').addClass('green-fonts');
						$('.pay-confirm').html('Your Reservation Is Confirmed.');
						$('#success-reservation').modal('show');
	 					$(".activity-tabs").load(location.href+" .activity-tabs>*","");
					}else{
						window.location = '/activities';
					}

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