@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')
@section('content')

<div class="container-fluid p-0 inner-top-activity">
	<div class="row">
		<div class="col-md-7 col-xs-12 col-md-offset-3-custom">
			<div class="custom-multiple-book">
				<div class="row">
					<div class="col-lg-12">
						<div class="valor-mix-title">
							<h2>{{$company->company_name}}</h2>
							<p>Booking Schedule for {{ucwords(@$customer->full_name)}}</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12 text-right">
						<div class="calendar-icon">
							<input type="text" name="date" class="date datepicker" readonly placeholder="DD/MM/YYYY" />
						</div>
					</div>
				</div>
				<div class="">
					<ul class="nav nav-tabs calendar-nav-tabs" role="tablist">
						<div class="owl_1 owl-carousel owl-theme ">
							@foreach($days as $i=>$date)
								<div class="item">
									<li @if($filter_date->format('Y-m-d') == $date->format('Y-m-d')) class="active" @endif><a  href="{{$request->fullUrlWithQuery(['date' => $date->format('Y-m-d')])}}" role="tab">{{$date->format("D d")}}</a></li>
								</div>
							@endforeach
						</div>
					</ul>
				</div>
				<div class="tab-content">
					<div class="row">
						<div class="col-md-12">
							<div class="multiple-slots">
								<h3>Reserve Multiple Time Slots</h3>
								<p> Select dates and time slots you would like to reserve. Once you’re done, review and confirm your selections </p>
							</div>
						</div>
					</div>
					<div id="tab" class="tab-pane fade active in" role="tabpanel">
						<div class="row mb-10">
							<div class="col-md-4 col-sm-4 col-xs-12">
								<div class="checkout-sapre-tor"></div>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12 valor-mix-title nopadding">
								<label>Activities on {{$filter_date->format("l, F j")}}</label>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<div class="checkout-sapre-tor"></div>
							</div>
						</div>

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

													$cancelSc = $sc->activity_cancel->where('cancel_date',$filter_date->format('Y-m-d'))->first();
													$hide_cancel = @$cancelSc->hide_cancel_on_schedule;
													if(@$cancelSc->cancel_date_chk == 0 ){
														$hide_cancel = 0;
													}
													if($hide_cancel == '' || $hide_cancel != 1){
														$sche_ary [] = $sc;
													}
												}
											}
										} 
										if(!empty($sche_ary)){
									@endphp
									<div class="row">
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="classes-info remove-line mb-10">
												<div class="row">
													<div class="col-md-12 col-xs-12">
														<div class="text-left line-height-1 ">
															<label class="fs-17">Category Name: </label> <span class="fs-17">{{@$cList->category_title}}</span>
														</div>
													</div>
													<div class="col-md-12 col-xs-12">
														<div class="text-left line-height-1">
															<label>Program Name: </label> <span> {{$ser->program_name}}</span>
															<h2>{{$ser->sport_activity}}</h2>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<div class="row calendar-separator-line">
												@if(!empty($sche_ary))
													@foreach($sche_ary as $s=>$scary)
														@php 
															$duration = $scary->get_duration();

															$SpotsLeftdis = 0;
															$bs = new  \App\Repositories\BookingRepository;
															$bookedspot = $bs->gettotalbooking($scary->id,$filter_date->format('Y-m-d')); 
															$SpotsLeftdis = $scary->spots_available - $bookedspot;
															
													        $cancel_chk = 0;
															$canceldata = App\ActivityCancel::where(['cancel_date'=>$filter_date->format('Y-m-d'),'schedule_id'=>$scary->id,'cancel_date_chk'=>1])->first();
															$date = $filter_date->format('Y-m-d');
															$time = $scary->shift_start;
															$st_time = date('Y-m-d H:i:s', strtotime("$date $time"));
															$current  = date('Y-m-d H:i:s');
															$difference = round((strtotime($st_time) - strtotime($current))/3600, 1);
															$timeOfActivity = date('h:i a', strtotime($scary->shift_start));
															$grayBtnChk = 0;
															if($filter_date->format('Y-m-d') == date('Y-m-d') && $st_time < $current){
																$grayBtnChk = 1;
															}
															if($SpotsLeftdis == 0){
																$grayBtnChk = 2;
															}
															if($canceldata != ''){
																$grayBtnChk = 3;
																$class = 'post-btn-gray';
															}

															$insName = $scary->getInstructure($filter_date->format('Y-m-d'));
														@endphp
														<div class="col-lg-4 col-md-3 col-sm-5 col-xs-6">
															<div class="multiple0select btn-group w-100">
																<div class="select">
																	<input type="checkbox" id="item_{{$s}}{{$scary->id}}" class="checkboxchk" data-pname="{{$ser->program_name}}" data-toa="{{$timeOfActivity}}" data-chk="{{$grayBtnChk}}" data-sid="{{$ser->id}}" data-scid="{{$scary->id}}" data-catId="{{$scary->category_id}}" {{ $SpotsLeftdis == 0 ? "disabled" : ''}} {{ $canceldata != '' ?  "disabled" : ''}}>
																	<label class="btn button_select" for="item_{{$s}}{{$scary->id}}">{{$timeOfActivity}} <br>{{$duration}}</label>
																	<span>{{ $SpotsLeftdis == 0 ? "Sold Out" : $SpotsLeftdis."/".$scary->spots_available."  Spots Left" }}</span>
																	<label class="font-red">{{ $canceldata != '' ? "Cancelled" : ''}}</label>
																	<span>{{ $insName }}</span>
																</div>
															</div>
														</div>
													@endforeach
												@else
													<div class="col-md-12 col-sm-6 col-xs-12 noschedule">No Time available</div>
												@endif
											</div>
										</div>
										<div class="col-md-12 col-xs-12">
											<div class="checkout-sapre-tor"></div>
										</div>
									</div>
									@php } @endphp
								@endforeach
							@endif
						@endforeach
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="calendar-footer mt-10">
							<label><span id="timeSlotCntUpdate">{{count($finalSessionAry)}}</span>-Time Slot Added  </label> 
							<!-- <a href="#" class="showall-btn" data-toggle="modal" data-target="#review_selections" >Review Selections</a> -->
							<a class="showall-btn" data-behavior="ajax_html_modal" data-url="{{route('getReviewData' ,['cid'=> @$customer->id,'business_id'=> @$company->id])}}" data-modal-width="1000px"data-modal-chkBackdrop="1" id="reviewData">Review Selections</a>
						</div>
					</div>
				</div>
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


@include('layouts.footer')
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
		var businessId = '{{$company->id}}';
		var cid = '{{@$customer->id}}';
		window.location = '/schedule/multibooking/'+businessId+'?customer_id='+cid+'&date='+date;
    });
    
    $(".checkboxchk").on("change", function() {
    	var pname = $(this).data('pname');
    	var toa = $(this).data('toa');
    	var chk = $(this).data('chk');
    	var sid = $(this).data('sid');
    	var scid = $(this).data('scid');
    	var catId = $(this).data('catid');
    	var checkboxId = $(this).attr('id');

    	if ($(this).prop("checked")) {
    		openPopUp(scid,sid,pname,toa,chk,catId,checkboxId);
    	} else {
    		confirmdelete(sid,'{{$filter_date->format("Y-m-d")}}',scid , 1);
    	}
       	
    });

    function openPopUp(scheduleId,sid,activityName,time,chk,catId,checkboxId ,category_id){
    	$('#select-booking-type').html('');
		if(chk == 1){
 			$('#select-booking-type').html('<div class="row contentPop"> <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12  text-center"> <div class="modal-inner-txt scheduler-time-txt"><p>You can\'t book this activity for today. The time has passed. Please choose another time.</p></div> </div></div>');
 			$("#"+checkboxId).prop("checked", false);
 			$('.selectbooking').modal('show');
		}else{
			$.ajax({
				url:'{{route("chkMultipleOrder")}}',
				type: 'POST',
				data:{
					_token: '{{csrf_token()}}',
					date:'{{$filter_date->format("Y-m-d")}}',
					timeid:scheduleId,
					businessId:'{{$company->id}}',
					serviceID:sid,
					customerID:'{{@$customer->id}}',
					pname:activityName,
					time:time,
					pname:activityName,
					category_id:catId,
				},
				success:function(data){
					$('#timeSlotCntUpdate').html(data);
				}
			});
		}
	}


	function addtimedate(scheduleId,sid,activityName,time){
	
		var priceId = $('#priceId').val();
		var did = $('#priceId').find('option:selected').data('did');
		let date ='{{$filter_date->format("m-d-Y")}}';
	   	$.ajax({
	   		url: "{{route('chkMultiBooking')}}",
			type: 'POST',
			xhrFields: {
				withCredentials: true
	    	},
	    	data:{
				_token: '{{csrf_token()}}',
				date:'{{$filter_date->format("Y-m-d")}}',
				timeid:scheduleId,
				businessId:'{{$company->id}}',
				serviceID:sid,
				customerID:'{{@$customer->id}}',
				priceId:priceId,
				did:did,
			},
			success: function (response) { //alert(response);
				if(response == 'fail'){
					$('#booking-time-model').html('<div class="row contentPop"> <div class="col-lg-12 text-center"> <div class="modal-inner-txt scheduler-time-txt"><p>No membership/sessions available to pay for this activity.</p></div> </div> <div class="col-lg-12 btns-modal"><a href="/activity-details/'+sid+'"  class="addbusiness-btn-modal">Buy Membership Now</a></div> </div>');
				}
				window.location.reload();
			}
	   	});
	}

	function  getRemainingSession(i,date,timeid){
		var did = $('#priceId'+i).find('option:selected').data('did');
		if(did != '' &&  did != '0'){
			$.ajax({
				url:'/chksession/'+did+'/'+date+'/'+timeid+'/1',
				type: 'GET',
				success:function(data){
					$('#remainingSession'+i).html(data+' Session Remaining.')
				}
			});
		}else{
			$('#remainingSession'+i).html('')
		}
	}

	function confirmdelete(serviceID ,date ,timeId ,chk) {
		if (confirm('Are you want to remove this selected slot ?')) {
			$.ajax({
		   		url: "{{route('deleteFromSession')}}",
				type: 'POST',
				xhrFields: {
					withCredentials: true
		    	},
		    	data:{
					_token: '{{csrf_token()}}',
					date: date,
					serviceID:serviceID,
					timeId:timeId,
					cid:'{{$customer->id}}',
				},
				success: function (response) { 
					if(chk ==0){
						//window.location.reload();
						$('#reviewData').click();
					}else{
						$('#timeSlotCntUpdate').html(response);
					}
				}
			});
		}
	}

</script>
<script>

$(' .owl_1').owlCarousel({
    loop: true,
    margin:2,	 
	responsiveClass:true,
	autoplay: false,
	nav: true,
	autoplayTimeout:2500,
	navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
    responsive:{
        0:{
            items:2,
        },
        600:{
            items:3,
        },
        1000:{
            items:5,
        },
		1500:{
            items:6,
        }
    }
})

$(document) .ready(function(){
	var li =  $(".owl-item li ");
	$(".owl-item li").click(function(){
	li.removeClass('active');
	});
});

</script>


@endsection<div class="row">
	<div class="col-lg-12">
		<div class="review-header mb-20 mt-10">
			<h4 class="modal-title" style="">Confirm Your Booking Selection For</h4>
			<h4 class="modal-title" style="">{{$company->company_name}}</h4>
		</div>
	</div>
</div>
<div class="time-slots-saprator mb-20">
	<label><span>{{count($finalSessionAry)}} </span>- Time Slots Selected</label>
</div>
<div class="mb-20 font-green" id="successMsg"></div>
<div class="row">
	<div class="col-md-12">
		<div class="table-responsive confirm-booking purchase-history review-data">
			<table style="width:100%" class="table mb-0">
				<tr>
					<th>No</th>
					<th>Activity Name</th>
					<th>Date</th>
					<th>Time</th>
					<th>Duration</th>
					<th>Spots</th>
					<th>Choose Membership</th>
					<th>Action</th>
				</tr>

				@foreach($finalSessionAry as $i=>$sesAry)
				<tr id="blankTr">
					<td>{{$i+1}}.</td>
					<td>{{$sesAry['pname']}} @if(@$sesAry['catname']) -  {{@$sesAry['catname']}} @endif</td>
					<td>{{(new DateTime($sesAry['date']))->format("l, F j,Y")}}</td>
					<td>{{$sesAry['time']}} </td>
					<td>{{$sesAry['duration']}} </td>
					<td> 1 Slot </td>
					<td>  
						<?php 
							$html = $data = '';$remaining = 0;$firstDataProcessed = false; 
				            $customer = Auth::user()->customers()->find(request()->cid);

				            $active_memberships = $customer->active_memberships()->where('user_booking_details.user_id',request()->cid)->get();

				            foreach($active_memberships as $active_membership){
				                $remainingSession = $active_membership->getremainingsession();
				                if($remainingSession > 0 && $active_membership->business_price_detail){
				                    $priceDetail = $active_membership->business_price_detail;
				                    $html .= '<option value="'.$priceDetail->id.'" data-did ="'.$active_membership->id.'">'.$priceDetail->price_title.'</option>';
				                }
				            }

				            if($html != ''){
					            $data .='<select class="mb-10 form-control required" id="priceId'.$i.'" onchange="getRemainingSession('.$i.',\''.$sesAry["date"].'\','.$sesAry['timeId'].')"  ><option value="" data-did ="0">Choose Membership</option>'.$html.'</select>  <div class="font-red text-center" id="remainingSession'.$i.'"></div>';

					            //'<div class="font-red text-center" id="remainingSession'.$i.'">'.$remaining.' Session Remaining.</div>';
					        }
				        ?>
				        <div class="text-center">
				        	{!! $data != '' ? $data : '<p> No MemberShip Available</p>' !!}

				        	<div class="time-slots-saprator mb-20"></div><a href="/activity-details/{{$sesAry['serviceID']}}" class="btn btn-lp" target="_blank">Purchase A Membership.</a>
				        </div>
				    </td>
					<td><button class="btn-delete font-red" onclick="confirmdelete({{$sesAry['serviceID']}},'{{$sesAry["date"]}}' ,{{$sesAry['timeId']}} , 0);"> Delete </button></td>
				  </tr>
				@endforeach
			</table>
		</div>
	</div>
</div>
<div class="modal-footer mt-20">
	<button type="button" @if(count($finalSessionAry) > 0 ) onclick="confirmSchedule('{{count($finalSessionAry)}}');" @endif class="btn btn-lp">Confirm Booking</button>
</div>

<script type="text/javascript">
	function confirmSchedule(cnt){
		if(confirm('Are you want to confirm this booking schedule ?')){
			if(cnt == 0){
				alert('Please select time first..');
			}else{
				var isValid = 1;
				$('.required').each(function() {
					if ($(this).val() === '') {
				        alert('Please select membership from each activity.');
				        isValid = 0;
			      	}
				});

				if (isValid == 1) {
					$.ajax({
			   			url: "{{route('multibooking.save')}}",
						type: 'POST',
						xhrFields: {
							withCredentials: true
				    	},
				    	data:{
							_token: '{{csrf_token()}}',
							cid: '{{$cid}}',
						},
						success: function (response) { 
							//window.location.reload();
							$('#blankTr').html('');
							$('#successMsg').html(response);
							setTimeout(function() {
							    window.location.href = "/business_activity_schedulers/" + "{{$company->id}}" + "?customer_id=" + "{{$cid}}";
							}, 2000);
							
						}
					});
				}
			}			
		}
	}
</script>