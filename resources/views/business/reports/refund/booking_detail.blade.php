@forelse($bookDetails as $y=>$bs)
	<div class="accordion-item shadow">
		<h2 class="accordion-header" id="accordionnesting{{$dateKey}}{{$y}}_{{@$loopkey}}">
			<button class="accordion-button collapsed buttonaccodian" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingcollapse{{$dateKey}}{{$y}}_{{@$loopkey}}" aria-expanded="true" aria-controls="accor_nestingcollapse{{$dateKey}}{{$y}}_{{@$loopkey}}">
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
		<div id="accor_nestingcollapse{{$dateKey}}{{$y}}_{{@$loopkey}}" class="accordion-collapse collapse buttonaccodiandiv" aria-labelledby="accordionnesting{{$dateKey}}{{$y}}_{{@$loopkey}}" data-bs-parent="#default-accordion-example">
			<div class="accordion-body">
				<div class="booking-activity-details">
					<div class="membership-expirations-table">
						<div class="table-responsive">
							<table class="table mb-0">
								<thead>
									<tr>
										<th>CLIENT NAME</th>
										<th>PROGRAM NAME</th>
										<th>PRICE OPTION</th>
										<th>TOTAL PRICE</th>
										<th>REFUND AMOUNT</th>
										<th>REASON FOR REFUND</th>
										<th>REFUND TO</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>{{@$bs->customer->full_name}}</td>
										<td>{{@$bs->business_services_with_trashed->program_name}}</td>
										<td>{{@$bs->business_price_detail_with_trashed->price_title}} - {{@$bs['pay_session']}} Sessions</td>
										<td>$ @if(@$bs->booking->getPaymentDetail() != 'Comp') {{ @$bs->subtotal}} @else 0 @endif </td>
										<td>$ {{@$bs->refund_amount}}</td>
										<td>{{@$bs->refund_reason ?? 'N/A'}}</td>
										<td>{{@$bs->customer->full_name}}</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@empty
@endforelse