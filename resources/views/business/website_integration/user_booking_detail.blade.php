@php $counter = 0; @endphp
@forelse($orderDetails as $i=>$book_details)
	@php $accId = substr($i, 0, strpos($i, '!~!')); @endphp
	<div class="accordion-item shadow">
		<h2 class="accordion-header" id="accordionnestingExample{{$accId}}_{{$tabName}}">
			<button class="accordion-button @if($counter != 0) collapsed @endif" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse{{$accId}}_{{$tabName}}" aria-expanded="true" aria-controls="accor_nestingExamplecollapse{{$accId}}_{{$tabName}}">
				{{substr($i, strpos($i, '!~!') + strlen('!~!'))}} ({{count($book_details)}} Memberships)
			</button>
		</h2>
		<div id="accor_nestingExamplecollapse{{$accId}}_{{$tabName}}" class="accordion-collapse collapse @if($counter == 0) show @endif " aria-labelledby="accordionnestingExample{{$accId}}_{{$tabName}}" data-bs-parent="#accordionnesting">
			<div class="accordion-body">
				<div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting2">
					@foreach($book_details as $y=>$bs)
					<div class="accordion-item shadow">
						<h2 class="accordion-header" id="accordionnesting2Example{{$accId}}_{{$tabName}}_{{$y}}">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse{{$accId}}_{{$tabName}}_{{$y}}" aria-expanded="true" aria-controls="accor_nesting2Examplecollapse{{$accId}}_{{$tabName}}_{{$y}}">
								<div class="container-fluid nopadding">
									<div class="row y-middle">
										<div class="col-lg-9 col-md-7 col-12 mobile0view-flex y-middle">
											<div class="container-fluid">
												<div class="row y-middle">
													<div class="col-lg-1 col-sm-2 col-4">
														<div class="d-inline-block">
															<img src="@if(Storage::disk('s3')->exists(@$bs->business_services_with_trashed->first_profile_pic())) {{ Storage::url($bs->business_services_with_trashed->first_profile_pic()) }} @else {{ asset('/images/service-nofound.jpg')}} @endif" alt="" class="rounded avatar-sm shadow mr-5"> 
														</div>
													</div>
													<div class="col-lg-11 col-sm-10 col-8">
														<div class="mx-line d-inline-block mmt-10">
															<div>
																<label>{{@$bs->business_services_with_trashed->program_name}} |</label>
																<label>Remaining: {{@$bs->getRemainingSessionAfterAttend()}}/{{@$bs->pay_session}} |</label>
																<label>Expiration: {{date('m/d/Y',strtotime(@$bs->expired_at))}} |</label>
															</div>
															@if($tabName == 'past') 
																<div>
																	@if(@$bs->terminated_at) 
																		<label class="font-red mt-5">Status: Terminated on {{date('m/d/Y',strtotime(@$bs->terminated_at))}} </label> 
																	@endif
																</div>
															@endif

															@if($tabName != 'current' && $tabName != 'past') 
																<div>
																	@if(@$bs->getReserveData('reserve_date') != '—') 
																		<label class="mt-5">Reserved Date: {{@$bs->getReserveData('reserve_date')}}  | </label>
																		<label class=" mt-5">Reserved Time: {{@$bs->getReserveData('reserve_time')}}  </label> 
																	@endif
																</div>
															@endif
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-2 col-md-3 col-8">
											@if($tabName != 'past')
												<div class="mmt-10">
													<!-- {{-- <a type="button" class="btn btn-red" id="{{$bs->user_id}}" onClick="redirectUrl(this.getAttribute('data-url'))" @if(@$reserveUrl) data-url="{{route('check-in-portal',['business_id' => $bs['business_id'] ,'business_service_id'=>$bs['sport'] ,'stype'=>@$bs->business_services_with_trashed->service_type ,'priceid' =>$bs['priceid'] ,'customer_id' => request()->customer_id ,'activetab' => 'schedule'])}}" @else data-url="{{route('business_activity_schedulers',['business_id' => $bs['business_id'] ,'business_service_id'=>$bs['sport'] ,'stype'=>@$bs->business_services_with_trashed->service_type ,'priceid' =>$bs['priceid'] ,'customer_id' => ((request()->customer_id) ? $bs['user_id'] : '')] )}}" @endif> @if($tabName != 'current') Reschedule @else Reserve Now @endif</a> --}} -->
													<!-- <a class="btn btn-red" href="#"  data-bs-toggle="modal" data-bs-target=".selectbooking">Reserve Now</a> -->
													<a  class="btn btn-red" type="button" onClick="redirectUrl(this.getAttribute('data-url'))"
														@if(@$reserveUrl) 
															data-url="{{route('check-in-portal', [
																'business_id' => $bs['business_id'],
																'business_service_id' => $bs['sport'],
																'stype' => @$bs->business_services_with_trashed->service_type,
																'priceid' => $bs['priceid'],
																'activetab' => 'schedule'
															])}}" 
														@else 
															{{-- data-url="{{route('business_activityschedulers', [
																'business_id' => $bs['business_id'],
																'business_service_id' => $bs['sport'],
																'stype' => @$bs->business_services_with_trashed->service_type,
																'priceid' => $bs['priceid'],
																'customer_id' => @$bs['user_id']
															])}}"  --}}
															data-url="https://dev.fitnessity.co/api/businessactivityschedulers_api?businessId={{ $bs['business_id'] }}&business_service_id={{ $bs['sport'] }}&stype={{ @$bs->business_services_with_trashed->service_type }}&priceId={{ $bs['priceid'] }}&customer_id={{$bs['user_id']}}"
														@endif>
														@if($tabName != 'current') 
															Reschedule 
														@else 
															Reserve Now
														@endif
													 </a>
													 
												</div>		
											@endif
										</div>

										<div class="col-lg-1 col-md-2 col-4">
											<div class="multiple-options">
												<div class="setting-icon">
													<i class="ri-more-fill"></i>
													<ul>
														<li>
															{{-- <a class="openreceiptmodel set-file-icon" data-behavior="ajax_html_modal" data-url="{{url('/receiptmodel/'.$bs->id.'/'.$bs->user_id.'/booking')}}" data-item-type="Membership" data-modal-width="modal-70"><i class="ffas fa-plus text-muted" aria-hidden="true"></i>Receipt </a> --}}
														
														
															<a class="openreceiptmodel set-file-icon" href="#" data-url="{{url('/receiptmodel/'.$bs->id.'/'.$bs->user_id.'/booking')}}">
																<i class="ffas fa-plus text-muted" aria-hidden="true"></i>Receipt
															</a>
															
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</button>
						</h2>
						<div id="accor_nesting2Examplecollapse{{$accId}}_{{$tabName}}_{{$y}}" class="accordion-collapse collapse" aria-labelledby="accordionnesting2Example{{$accId}}_{{$tabName}}_{{$y}}" data-bs-parent="#accordionnesting2">
							<div class="accordion-body">
								<div class="booking-activity-details">
									<div class="row">
										<div class="col-lg-6 col-6">
											<label>BOOKING CONFIRMATION #</label>
										</div>
										<div class="col-lg-6 col-6">
											<span>{{@$bs->booking->order_id}}</span>
										</div>
										
										<div class="col-lg-6 col-6">
											<label>TOTAL PRICE</label>
										</div>
										<div class="col-lg-6 col-6">
											<span>$ @if(@$bs->booking->getPaymentDetail() != 'Comp') {{ @$bs->subtotal}} @else 0 @endif </span>
										</div>
										
										<div class="col-lg-6 col-6">
											<label>PRICE OPTION</label>
										</div>
										<div class="col-lg-6 col-6">
											<span>{{@$bs->business_price_detail_with_trashed->price_title}} - {{@$bs['pay_session']}} Sessions</span>
										</div>
										
										<div class="col-lg-6 col-6">
											<label>PAYMENT TYPE</label>
										</div>
										<div class="col-lg-6 col-6">
											<span>{{@$bs->pay_session}} Sessions</span>
										</div>
										
										<div class="col-lg-6 col-6">
											<label>TOTAL REMAINING</label>
										</div>
										<div class="col-lg-6 col-6">
											<span>{{@$bs->getRemainingSessionAfterAttend()}}/{{@$bs['pay_session']}}</span>
										</div>
										
										<div class="col-lg-6 col-6">
											<label>PROGRAM NAME</label>
										</div>
										<div class="col-lg-6 col-6">
											<span>{{@$bs->business_services_with_trashed->program_name}}</span>
										</div>
										
										<div class="col-lg-6 col-6">
											<label>EXPIRATION DATE</label>
										</div>
										<div class="col-lg-6 col-6">
											<span>{{date('m/d/Y',strtotime(@$bs->expired_at))}}</span>
										</div>
										
										<div class="col-lg-6 col-6">
											<label>DATE BOOKED</label>
										</div>
										<div class="col-lg-6 col-6">
											<span>{{date('m/d/Y',strtotime(@$bs->created_at))}}</span>
										</div>
										
										<div class="col-lg-6 col-6">
											<label>RESERVED DATE</label>
										</div>
										<div class="col-lg-6 col-6">
											<span>{{@$bs->getReserveData('reserve_date')}}</span>
										</div>
										
										<div class="col-lg-6 col-6">
											<label>BOOKED BY</label>
										</div>
										<div class="col-lg-6 col-6">
											<span>{{@$bs->booking->getBookedFirstName()}} {{@$bs->booking->getBookedLastName()}} </span>
										</div>
										
										<div class="col-lg-6 col-6">
											<label>ACTIVITY TYPE</label>
										</div>
										<div class="col-lg-6 col-6">
											<span>{{@$bs->business_services_with_trashed->sport_activity}}</span>
										</div>
										
										<div class="col-lg-6 col-6">
											<label>SERVICE TYPE</label>
										</div>
										<div class="col-lg-6 col-6">
											<span>{{@$bs->business_services_with_trashed->select_service_type ?? "—" }} </span>
										</div>
										
										<div class="col-lg-6 col-6">
											<label>ACTIVITY LOCATION</label>
										</div>
										<div class="col-lg-6 col-6">
											<span>{{@$bs->business_services_with_trashed->activity_location}}</span>
										</div>
										
										<div class="col-lg-6 col-6">
											<label>ACTIVITY DURATION</label>
										</div>
										<div class="col-lg-6 col-6">
											<span>{{@$bs->getReserveData('reserve_time')}}</span>
										</div>
										
										<div class="col-lg-6 col-6">
											<label>GREAT FOR</label>
										</div>
										<div class="col-lg-6 col-6">
											<span>{{@$bs->business_services_with_trashed->activity_for}}</span>
										</div>
										
										<div class="col-lg-6 col-6">
											<label>PARTICIPANTS</label>
										</div>
										<div class="col-lg-6 col-6">
											<span>{!!$bs->getparticipate()!!}</span>
										</div>
										
										<div class="col-lg-6 col-6">
											<label>WHO IS PARTICIPATING?</label>
										</div>
										<div class="col-lg-6 col-6">
											<span>{!!$bs->decodeparticipate()!!}</span>
										</div>
										
										<div class="col-lg-6 col-6">
											<label>ADD ON SERVICES</label>
										</div>
										<div class="col-lg-6 col-6">
											<span>{!! getAddonService($bs->addOnservice_ids,$bs->addOnservice_qty) !!} </span>
										</div>
										
										<div class="col-12">
											<div class="float-end mt-20">
												@if($tabName !='past')
													<!-- <a class="btn btn-red" @if(@$reserveUrl) href="{{route('check-in-portal',['business_id' => $bs['business_id'] ,'business_service_id'=>$bs['sport'] ,'stype'=>@$bs->business_services_with_trashed->service_type ,'priceid' =>$bs['priceid'] ,'customer_id' => request()->customer_id ,'activetab' => 'schedule'] )}}" @else href="{{route('business_activity_schedulers',['business_id' => $bs['business_id'] ,'business_service_id'=>$bs['sport'] ,'stype'=>@$bs->business_services_with_trashed->service_type ,'priceid' =>$bs['priceid'] ,'customer_id' => ((request()->customer_id) ? $bs['user_id'] : '')] )}}" @endif >Schedule {{$customer->id}}</a> -->
														<a id="scheduleLink" class="btn btn-red" @if(@$reserveUrl) href="{{ route('check-in-portal', 
														       ['business_id' => $bs['business_id'], 
																	'business_service_id' => $bs['sport'], 
																	'stype' => @$bs->business_services_with_trashed->service_type, 
																	'priceid' => $bs['priceid'], 
																	'customer_id' => $customer->id, 
																	'activetab' => 'schedule'
																])}}" 
															@else 
																{{-- href="{{ route('business_activityschedulers', [
																	'business_id' => $bs['business_id'], 
																	'business_service_id' => $bs['sport'], 
																	'stype' => @$bs->business_services_with_trashed->service_type, 
																	'priceid' => $bs['priceid'], 
																	'customer_id' => $customer->id
																]) }}"  --}}
																data-url="https://dev.fitnessity.co/api/businessactivityschedulers_api?businessId={{ $bs['business_id'] }}&business_service_id={{ $bs['sport'] }}&stype={{ @$bs->business_services_with_trashed->service_type }}&priceId={{ $bs['priceid'] }}&customer_id={{ $bs['user_id'] }}"
															@endif onclick="handleScheduleClick(this.getAttribute('data-url'))">
															Schedule 
														</a>
												@endif
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>

		<div class="modal fade modal-middle in selectbooking">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header" > 
		                <div class="closebtn">
		                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		                </div>
		            </div>
		            <div class="modal-body" id="select-booking-type">
		            	<div class="row contentPop text-center">
		            		<div class="col-lg-12 btns-modal">
		            			<h4 class="mb-20">Choose How You Would Like To Reserve</h4>
		            			<a class="btn btn-red" href="{{route('business_activity_schedulers',['business_id' => $bs['business_id'] ,'business_service_id'=>$bs['sport'],'stype'=>@$bs->business_services_with_trashed->service_type ,'priceid' =>$bs['priceid'] ,'customer_id' =>$bs['user_id'] ] )}}">Reserve A Single Spot</a>
		            			<a class="btn btn-red" href="{{route('multibooking',['business_id' => $bs['business_id'] ,'business_service_id'=>$bs['sport'],'stype'=>@$bs->business_services_with_trashed->service_type ,'priceid' =>$bs['priceid'] ,'customer_id' =>$bs['user_id'] ] )}}" >Reserve Multiple Spots</a>
		            		</div>
		            	</div>
		            </div>
		        </div>
		    </div>
		</div>




		
	</div>
	@php $counter++; @endphp
	@empty
		<div class="text-center mt-25">
			<p class="text-center mt-20"> Membership Is Not Available. </p>
			@if(@$membershipbtn == 1) 
			<!-- {{-- <a class="btn btn-red" data-modal-chkBackdrop="1" data-reload="1" data-modal-width="modal-50" data-behavior="ajax_html_modal" data-bs-backdrop="static" data-bs-keyboard="false" data-url="{{route('checkin.activity_booking_html')}}" class="btn btn-red"> Purchase A Membership </a>  --}} -->
			<a class="btn btn-red" data-bs-toggle="modal" data-modal-chkBackdrop="1" data-reload="1" data-modal-width="modal-50" data-behavior="ajax_html_modal" data-bs-backdrop="static" data-bs-keyboard="false" data-url="{{route('checkin.activity_booking_html')}}">Purchase A Membership</a>
			@endif 
		</div>
	@endforelse

	<script type="text/javascript">
		function redirectUrl(url) {
			// alert('33');
			// localStorage.setItem("scheduler", 'checkedin');
			// localStorage.setItem("schedulerurl", url);
			// window.location.href = url;
			window.parent.postMessage({ type: 'changeSrc', src: url }, '*'); 
		}
	</script>

	<script>
		document.getElementById('scheduleLink').addEventListener('click', function(event) {
			if (event.metaKey || event.ctrlKey || event.shiftKey) {
				event.preventDefault();
				alert('Opening this link in a new tab is not allowed.');
			}
		});
	</script>
<script>
    // function handleScheduleClick(event) {
    //     event.preventDefault();
    //     localStorage.setItem("scheduler", 'checkedin');
    //     var url = event.currentTarget.getAttribute('href');
    //     localStorage.setItem("schedulerurl", url);
    //     window.location.href = url;
    // }

	function handleScheduleClick(url) {
        // event.preventDefault();
        // localStorage.setItem("scheduler", 'checkedin');
        // var url = event.currentTarget.getAttribute('href');
        // localStorage.setItem("schedulerurl", url);
        // window.location.href = url;
		window.parent.postMessage({ type: 'changeSrc', src: url }, '*'); 

    }
</script>

