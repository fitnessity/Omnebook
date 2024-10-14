@forelse($bookDetails as $y=>$bs)
	<div class="accordion-item shadow">
		<h2 class="accordion-header" id="accordionnesting{{@$dateKey}}{{$y}}_{{@$loopkey}}">
			<button class="accordion-button collapsed buttonaccodian" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingcollapse{{@$dateKey}}{{$y}}_{{@$loopkey}}" aria-expanded="true" aria-controls="accor_nestingcollapse{{@$dateKey}}{{$y}}_{{@$loopkey}}">
				<div class="container-fluid nopadding">
					<div class="row y-middle">
						<div class="col-lg-9 col-md-6 col-12 mobile0view-flex">
							<div class="d-inline-block">
								<img src="@if(Storage::disk('s3')->exists(@$bs->business_services_with_trashed->first_profile_pic())) {{ Storage::url($bs->business_services_with_trashed->first_profile_pic()) }} @else {{ asset('/images/service-nofound.jpg')}} @endif" alt="" class="rounded avatar-sm shadow mr-5"> 
							</div>
							<div class="mx-line d-inline-block mmt-10">
								<label class="mr-10-title">{{@$bs->business_services_with_trashed->program_name}}</label>
								<label>Remaining: {{@$bs->getremainingsession()}}/{{@$bs['pay_session']}} |</label>
								<label>Expiration: {{date('m/d/Y',strtotime(@$bs->expired_at))}} </label>
							</div>
						</div>
						<div class="col-lg-2 col-md-3 col-8"></div>

						<div class="col-lg-1 col-md-3 col-4"></div>
					</div>
				</div>
			</button>
		</h2>
		<div id="accor_nestingcollapse{{@$dateKey}}{{$y}}_{{@$loopkey}}" class="accordion-collapse collapse buttonaccodiandiv" aria-labelledby="accordionnesting{{@$dateKey}}{{$y}}_{{@$loopkey}}" data-bs-parent="#default-accordion-example">
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
							<span>{{@$bs->getremainingsession()}}/{{@$bs['pay_session']}}</span>
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
					
					</div>
				</div>
			</div>
		</div>
	</div>
@empty
@endforelse