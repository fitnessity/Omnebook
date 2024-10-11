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
											Provider Notes (0)
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-bs-toggle="tab" href="#Alerts" role="tab" aria-selected="false">
											 Alerts (0)
										</a>
									</li>
								</ul>
								<!-- Tab panes -->
								<div class="tab-content  text-muted">
									<div class="tab-pane active" id="Notes" role="tabpanel">
										<h6>Coming Soon</h6>
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
																			Expired Credit Card
																		</button>
																	</h2>
																	<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
																		<div class="accordion-body">
																			Coming soon
																		</div>
																	</div>
																</div>
																<div class="accordion-item shadow">
																	<h2 class="accordion-header" id="headingTwo">
																		<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
																			Missed Payment
																		</button>
																	</h2>
																	<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#default-accordion-example">
																		<div class="accordion-body">
																			Coming soon
																		</div>
																	</div>
																</div>
																<div class="accordion-item shadow">
																	<h2 class="accordion-header" id="headingThree">
																		<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
																			Low Attendance Alert
																		</button>
																	</h2>
																	<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#default-accordion-example">
																		<div class="accordion-body">
																			Coming soon
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