@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')
@include('layouts.profile.business_topbar')

	<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<div class="row mb-3">
					<div class="col-12">
						<div class="page-heading">
							<label>Notes and Alerts</label>
						</div>
					</div>				
				</div><!--end row-->
				<div class="row">
					<div class="col-xxl-12">
						<div class="card">
							<div class="card-body">
								<!-- Nav tabs -->
								<ul class="nav nav-tabs mb-3" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" data-bs-toggle="tab" href="#Notes" role="tab" aria-selected="false">
											Provider Notes ({{count($notes)}})
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="tab" href="#Alerts" role="tab" aria-selected="false">
											 Alerts ({{$alertCount}})
										</a>
									</li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content  text-muted">

									<div class="tab-pane active" id="Notes" role="tabpanel">
										<div class="container-fluid nopadding">
											<div class="row">	
												@forelse($notes as $n)
												<div class="row">
													<div class="col-md-10">
														<div class="row">
															<div class="col-md-4">{{$n->title}}</div>
															<div class="col-md-4">{{date('m/d/Y' ,strtotime($n->created_at))}}</div>
															<div class="col-md-4">Uploded By  {{$n->User->full_name}}</div>
														</div>
													</div>
													
													<div class="col-md-2 mb-10">
														<div class="text-right">
															<button class="btn btn-red btn-sm dropdown" data-bs-toggle="modal" data-bs-target=".notes{{$n->id}}" ><i class="ri-eye-fill fs-14" ></i></button>
														</div>
														<div class="modal fade notes{{$n->id}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-bs-focus="false">
															<div class="modal-dialog modal-dialog-centered modal-30">
																<div class="modal-content">
																	<div class="modal-header">
																		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																	</div>
																	
																	<div class="modal-body" id="noteHtml">		
																		<h5 class="modal-title text-center" id="staticBackdropLabel">{{$n->title}}</h5>
																		<div class="row y-middle mt-10">
																			<div class="col-lg-12 col-sm-12 col-md-12">
																				<div class="mb-3 ck-content">{!! $n->note ?? 'N/A' !!}</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>

												@empty
													<p>No Notes Available</p>
												@endforelse
											</div>
										</div>
									</div>

									<div class="tab-pane" id="Alerts" role="tabpanel">
										<div class="row">
											<div class="col-xxl-12 col-lg-12">
												<div class="card">
													<div class="card-body">
														<div class="live-preview">
															<div class="accordion" id="default-accordion-example">
																<div class="accordion-item shadow">
																	<h2 class="accordion-header" id="headingOne">
																		<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
																			Expired Credit Card ({{count($expiredCards)}})
																		</button>
																	</h2>
																	<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
																		<div class="accordion-body">
																			@forelse($expiredCards as $c)
																			<div class="row y-middle mt-5">
																				<div class="col-lg-6 col-md-6 col-sm-6 col-3">
																					Card : **** **** **** {{$c->last4}}
																				</div>
																				<div class="col-lg-3 col-md-3 col-sm-3 col-3">
																					Card Type: {{ $c->brand}}
																				</div>										
																				<div class="col-lg-3 col-md-3 col-sm-3 col-3">
																					Expired On: {{$c->exp_month}}/{{$c->exp_year}}
																				</div>
																			</div>
																			@empty
																				Not Expired Credit Card Available
																			@endforelse
																		</div>
																	</div>
																</div>
																<div class="accordion-item shadow">
																	<h2 class="accordion-header" id="headingTwo">
																		<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
																			Missed Payment ({{count($missedPayments)}})
																		</button>
																	</h2>
																	<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#default-accordion-example">
																		<div class="accordion-body">
																			<div class="purchase-history">
																				<div class="table-responsive">
																					<table class="table mb-0">
																						<thead>
																							<tr>
																								<th>Purchase Date </th>
																								<th>Item Description </th>
																								<th>Item Type</th>
																								<th>Price</th>
																								<th>Qty</th>
																								<th>Payment Failed Date</th>
																							</tr>
																						</thead>
																						<tbody>
																							@forelse($missedPayments as $p)
																								@if($p->UserBookingDetail)
																									<tr>
																										<td>{{date('Y-m-d' , strtotime($p->UserBookingDetail->created_at))}}</td>
																										<td>{{$p->UserBookingDetail->business_services_with_trashed->program_name}}<br></td>
																										<td>Membership</td>
																										<td>${{$p->total_amount}}</td>
																										<td>1</td>
																										<td>{{date('Y-m-d' , strtotime($p->payment_date))}}</td>
																									</tr>	
																								@endif
																							@empty
																								Not Missed Payment Available
																							@endforelse							
																						</tbody>
																					</table>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																
															</div>
														</div>
													</div><!-- end card-body -->
												</div><!-- end card -->
											</div>
										</div>
									</div>
								</div>
							</div><!-- end card-body -->
						</div><!-- end card -->
					</div><!--end col-->
				</div>
			</div><!-- container-fluid -->
		</div>
	</div><!-- end main content-->
	
</div><!-- END layout-wrapper -->

@include('layouts.business.footer')
@endsection