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

@php  use App\ActivityCancel; 
	use App\Repositories\BookingRepository; 
$service_type_ary = array("all","classes","individual","events","experience");@endphp
<div class="container-fluid p-0 inner-top-activity">
	<div class="row">
		<div class="col-md-7 col-xs-12 col-md-offset-3-custom">
			<div class="valor-mix-title">
				<h2>{{$companyName}}</h2>
				<p>Booking Schedule for {{ucwords(@$customer->full_name)}}</p>
			</div>
			<div class="member-txt">
				<p>If you already have a membership with multiple sessions. Reserve your spot here.<br> If you don’t already have a membership, <a href="{{route('activities_index')}}">Book Here </a></p>
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
								@if($serviceType == $st && !empty($services))
									@foreach($services as $ser)
										@php  
											$categoryList = [];
											if($priceid != ''){
												$pricelist =  @$ser->price_details()->find($priceid);
												if(@$pricelist->business_price_details_ages != ''){
													$categoryList []= @$pricelist->business_price_details_ages;
												}
											}else{
												$categoryList = @$ser->BusinessPriceDetailsAges;
											}
										@endphp
										@if(!empty($categoryList) && count($categoryList)>0)
											@foreach($categoryList as $cList)
												@php  $sche_ary = [];
												foreach($cList->BusinessActivityScheduler as $sc){
													if($sc->end_activity_date >= $filter_date->format('Y-m-d') && $sc->starting <= $filter_date->format('Y-m-d')){
														if(strpos($sc->activity_days, $filter_date->format('l')) !== false){
															$sche_ary [] = $sc;
														}
													}
												} 
												if(!empty($sche_ary)){
												@endphp
													<div class="row">
														<div class="col-md-6 col-sm-6 col-xs-12">
															<div class="classes-info">
																<div class="row">
																	<div class="col-md-12 col-xs-12">
																		<h2>{{$ser->sport_activity}}</h2>
																		<label>Program Name: </label> <span> {{$ser->program_name}}</span>
																	</div>
																	<div class="col-md-12 col-xs-12">
																		<label>Category Name: </label> <span>{{@$cList->category_title}}</span>
																	</div>
																	<div class="col-md-12 col-xs-12">
																		<label>Instructor: </label> <span>@if($ser->BusinessStaff != '') {{ucfirst($ser->BusinessStaff->full_name)}}  @else N/A @endif</span>
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
																			$date = $filter_date->format('Y-m-d');
																			$time = $scary->shift_start;
																			$st_time = date('Y-m-d H:i:s', strtotime("$date $time"));
																			$current  = date('Y-m-d H:i:s');
																			$difference = round((strtotime($st_time) - strtotime($current))/3600, 1);
																			$timeOfActivity = date('h:i a', strtotime($scary->shift_start));
																			$grayBtnChk = 0;$class = '';
																			if($filter_date->format('Y-m-d') == date('Y-m-d') && $st_time < $current){
																				$grayBtnChk = 1;
																				$class = 'post-btn-gray';
																			}
																			if($SpotsLeftdis == 0){
																				$grayBtnChk = 2;
																				$class = 'post-btn-gray';
																			}
																		@endphp
																		<div class="col-md-4 col-sm-5 col-xs-12">
																			<div class="classes-time">
																				<button class="post-btn {{$class}} activity-scheduler" onclick="openPopUp({{$scary->id}} , {{$ser->id}} ,'{{$ser->program_name}}','{{$timeOfActivity}}',{{$grayBtnChk}},'{{$scary->category_id}}');"  {{ $SpotsLeftdis == 0 ?  "disabled" : ''}} >{{$timeOfActivity}} <br>{{$duration}}</button>
																				
																				<label>{{ $SpotsLeftdis == 0 ? 
																					"Sold Out" : $SpotsLeftdis."/".$scary->spots_available."  Spots Left" }}</label>
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
												@php } @endphp
											@endforeach
										@endif
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

	<div class="modal fade compare-model in modal-middle" id="ajax_html_modal">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header" style="text-align: right;"> 
	                <div class="closebtn">
	                    <button type="button" class="close close-btn-design manage-customer-close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">×</span>
	                    </button>
	                </div>
	            </div>
	            <div class="modal-body" id='booking-time-model'>
	                
	            </div>
	        </div>
	    </div>
	</div>

	<div class="modal fade compare-model modal-middle in selectbooking">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header" > 
	                <div class="closebtn">
	                    <button type="button" class="close close-btn-design manage-customer-close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">×</span>
	                    </button>
	                </div>
	            </div>
	            <div class="modal-body" id="select-booking-type">
	            </div>
	        </div>
	    </div>
	</div>
</div>


@include('layouts.footer')

<script>
	flatpickr(".flatpickr-range", {
	    dateFormat: "m/d/Y",
	    maxDate: "01/01/2050",
		defaultDate: [new Date()],
	});
</script>
	
<script>

	$( '.activity-schedule-tabs .nav-tabs a' ).on('click',function () {
		$( '.activity-schedule-tabs .nav-tabs' ).find( 'li.active' ).removeClass( 'active' );
		$( this ).parent( 'li' ).addClass( 'active' );
	});
	

	function  getRemainingSession(){
		var did = $('#priceId').find('option:selected').data('did');
		if(did != ''){
			$.ajax({
				url:'/chksession/'+did,
				type: 'GET',
				success:function(data){
					$('#remainingSession').html(data+' Session Remaining.')
				}
			});
		}
	}

	function openPopUp(scheduleId,sid,activityName,time,chk,catId){
		if ("{{Auth::check()}}") { 
			if(chk == 1){
	 			$('#select-booking-type').html('<div class="row contentPop"> <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12  text-center"> <div class="modal-inner-txt scheduler-time-txt"><p>You can\'t book this activity for today. The time has passed. Please choose another time.</p></div> </div></div>');
			}else{
				$('#select-booking-type').html('<div class="row contentPop text-center"><div class="col-lg-12 btns-modal"><h4 class="mb-20">Choose How You Would Like To Book</h4><button type="button" class="addbusiness-btn-modal" onclick="timeBookingPopUP('+scheduleId+','+sid+',\''+activityName+'\',\''+time+'\','+chk+','+catId+')" id="singletime" data-id="">Book 1 Time Slot</button>  <button type="button" class="addbusiness-btn-modal" onclick="goToMultibookingPage('+sid+');">Book Multiple Time Slots At Once</button></div></div>');
			}
			
			$('.selectbooking').modal('show');
		}else{
			$.ajax({
				url:'{{route("setSessionOfSchedule")}}',
				type: 'POST',
				data:{
					_token: '{{csrf_token()}}',
					businessId : '{{$businessId}}',
				},
				success:function(data){
					 window.location.href = '/userlogin';
				}
			});
		}
	}

	function goToMultibookingPage(sid) {
		let date = '{{$filter_date->format("Y-m-d")}}';
		//window.open('/schedule/multibooking/'+'{{$businessId}}'+'?business_service_id='+sid+'&priceid='+'{{$priceid}}'+'&customer_id='+'{{@$customer->id}}' , '_blank');
		window.open('/schedule/multibooking/'+'{{$businessId}}'+'?customer_id='+'{{@$customer->id}}'+'&date='+date, '_blank');
	}

	function timeBookingPopUP(scheduleId,sid,activityName,time,chk,catId) {
		var date = '{{$filter_date->format("m/d/Y")}}';
		$('.selectbooking').modal('hide');
		var membershipHtml = '';
		$.ajax({
			url:'{{route("chkOrderAvailable")}}',
			type: 'POST',
			data:{
				_token: '{{csrf_token()}}',
				sid : sid,
				cid : '{{@$customer->id}}',
				// priceId : '{{$priceid}}',
				catId : catId,
			},
			success:function(data){
				if(data == ''){
					html = '<div class="row contentPop"> <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12  text-center"> <div class="modal-inner-txt scheduler-time-txt"><p>You don\'t have a membership for this activity.  </p> <p> Please buy a membership in order to book. </p></div> <a href="/activity-details/'+sid+'"  class="addbusiness-btn-modal">Buy Membership Now </a> </div> </div> ';
				}else{
					html = '<div class="row contentPop"> <div class="col-md-12"> <h4 class="mb-10 lh-25 text-center"> You are booking 1 time slot for '+activityName+' </h4> </div> <div class="col-md-12"> <h4 class="mb-30 lh-25 text-center"> on '+date+' at '+time+' </h4> </div> <div class="col-lg-7 col-sm-12 col-md-7 col-xs-12 text-center mb-20"> <div class="modal-inner-txt"> <p> Select Your Membership To Pay For This </p> </div> </div> <div class="col-lg-5 col-sm-12 col-md-5 col-xs-12 btns-modal mb-20"  id="bookingDetails" >'+data+'</div> <div class="col-lg-12 text-center"> <div class="modal-inner-txt"><p>Are You Sure To Book This Date And Time?</p></div> </div> <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 btns-modal"><a onclick="addtimedate('+scheduleId+' ,'+sid+',\''+activityName+'\',\''+time+'\')" class="addbusiness-btn-modal">Yes</a> <a data-dismiss="modal" class="addbusiness-btn-black">No</a> </div> </div>';
				}
				$('#ajax_html_modal').modal('show');
 				$('#booking-time-model').html(html);
			}
		});
	}

	function addtimedate(scheduleId,sid,activityName,time){
	
		var priceId = $('#priceId').val();
		var selectedOption = $('#priceId').find("option:selected");
		var oid = selectedOption.attr("data-did");
		let date ='{{$filter_date->format("m-d-Y")}}';
	   	$.ajax({
	   		url: "{{route('personal.schedulers.store')}}",
			type: 'POST',
			xhrFields: {
				withCredentials: true
	    	},
	    	data:{
				_token: '{{csrf_token()}}',
				date:'{{$filter_date->format("Y-m-d")}}',
				timeid:scheduleId,
				businessId:'{{$businessId}}',
				serviceID:sid,
				customerID:'{{@$customer->id}}',
				priceId:priceId,
				oid:oid,
			},
			success: function (response) { //alert(response);
				if(response == 'success'){
					$('.pay-confirm').addClass('green-fonts');
					$('.pay-confirm').html('Confirm your reservation for '+activityName+' on '+date+' at '+time);
					$('#success-reservation').modal('show');
					$('#ajax_html_modal').modal('hide');
 					$(".activity-tabs").load(location.href+" .activity-tabs>*","");
				}else if(response == 'fail'){
					$('#booking-time-model').html('<div class="row contentPop"> <div class="col-lg-12 text-center"> <div class="modal-inner-txt scheduler-time-txt"><p>No membership/sessions available to pay for this activity.</p></div> </div> <div class="col-lg-12 btns-modal"><a href="/activity-details/'+sid+'"  class="addbusiness-btn-modal">Buy Membership Now</a></div> </div>');
					//window.location = '/activity-details/'+sid;
					//alert('schedule failed');
				}else{
					$('#booking-time-model').html('<div class="row contentPop"> <div class="col-lg-12 text-center"> <div class="modal-inner-txt scheduler-time-txt"><p>'+response+'</p></div> </div></div>');
				}

				//swindow.location.reload();
			}
	   	});
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

<script>
	$('.owl-carousel').owlCarousel({
	    loop:true,
	    margin:10,
	    nav:true,
		navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
	    responsive:{
	        0:{
	            items:3
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
		 	minDate: 'today',
		 	yearRange: "0:+20"
		}); 
	});

	$( ".datepicker" ).change(function(){
		var date  = $(this).val();
		var businessId = '{{$businessId}}';
		var serviceType = '{{$serviceType}}';
		window.location = '/business_activity_schedulers/'+businessId+'?stype=' + serviceType+'&date='+date;
    });
</script>

@endsection