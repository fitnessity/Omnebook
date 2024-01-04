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
										<div class="col-lg-2 col-md-3 col-8">
											@if($tabName != 'past')
												<div class="mmt-10">
													<a type="button" class="btn btn-red" onClick="redirectUrl(this.getAttribute('data-url'))" data-url="{{route('business_activity_schedulers',['business_id' => $bs['business_id'] ,'business_service_id'=>$bs['sport'] ,'stype'=>@$bs->business_services_with_trashed->service_type ,'priceid' =>$bs['priceid'] ,'customer_id' =>$bs['user_id'] ] )}}">Reserve Now</a>

													<!-- <a class="btn btn-red" href="#"  data-bs-toggle="modal" data-bs-target=".selectbooking">Reserve Now</a> -->
												</div>		
											@endif
										</div>

										<div class="col-lg-1 col-md-3 col-4">
											<div class="multiple-options">
												<div class="setting-icon">
													<i class="ri-more-fill"></i>
													<ul>
														<li>
															<a class="openreceiptmodel set-file-icon" data-behavior="ajax_html_modal" data-url="{{url('/receiptmodel/'.$bs->id.'/'.$bs->user_id.'/booking')}}" data-item-type="Membership" data-modal-width="modal-70"><i class="ffas fa-plus text-muted" aria-hidden="true"></i>Receipt </a>
														</li>
														<!-- <li class="dropdown-divider"></li>
														<li><a href=""><i class="ri-delete-bin-fill align-bottom text-muted"></i>Delete</a></li> -->
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
										
										<div class="col-12">
											<div class="float-end mt-20">
												@if($tabName !='past')
													<a class="btn btn-red" href="{{route('business_activity_schedulers',['business_id' => $bs['business_id'] ,'business_service_id'=>$bs['sport'] ,'stype'=>@$bs->business_services_with_trashed->service_type ,'priceid' =>$bs['priceid'] ,'customer_id' =>$bs['user_id'] ] )}}" target="_blank">Schedule</a>
												@endif
												<a class="btn btn-black" href="{{env('APP_URL')}}/businessprofile/{{strtolower(str_replace(' ', '', $bs->company_information->public_company_name))}}/{{$bs->company_information->id}}" target="_blank">View Provider</a>
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
	Membership Is Not Available
@endforelse

<script type="text/javascript">
	function redirectUrl(url) {
		window.location = url
	}
</script>