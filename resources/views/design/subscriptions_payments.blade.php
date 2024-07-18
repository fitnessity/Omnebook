@inject('request', 'Illuminate\Http\Request')
@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')
	
		<!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
		<div class="page-content">
            <div class="container-fluid">
               <div class="row">
                  <div class="col">
                     <div class="h-100">
						<div class="row mb-3">
							<div class="col-6">
								<div class="page-heading">
									<label>Fitnessity Subscriptions</label>
								</div>
							</div> <!--end col-->
						</div>                   
                        <!--end row-->
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header align-items-center d-flex">
										<h4 class="card-title mb-0 flex-grow-1"> </h4>
										<div class="flex-shrink-0">
											<div class="form-check form-switch form-switch-right form-switch-md">
												<label class="form-label text-muted text-uppercase">Card Number</label>
												<div>
													<label class="form-label text-muted text-uppercase">*6917</label>
												</div>
											</div>
										</div>
										<div class="flex-shrink-1 ">
											<div data-bs-toggle="modal" data-bs-target=".editcard">
												<i class="fas fa-pencil-alt fs-15"></i>
											</div>
										</div>
									</div>
									<div class="card-body card-350-body mb-25">
										<div class="row">
											<div class="col-xxl-12 col-lg-12 col-md-12 col-sm-12">
												<div class="row y-middle mmb-10">
													<div class="col-lg-9 col-md-7">
														<div class="subscriptions-info mt-10 mb-10">
															<h1>Basic</h1>
															<span>Billed on the 25th of the month: 0.00 USD / Month </span>
															<span>Darryl Phipps, Account #: 1587142</span>
														</div>
													</div>
													<div class="col-lg-3 col-md-5">
														<div class="text-right">
															<button class="btn btn-red">Current Plan </button>
															<button class="btn btn-black">Switch Plan</button>
														</div>
													</div>
												</div>
												
												<div class="dropdown-divider"></div>
												<!--<div class="row y-middle mmb-10">
													<div class="col-lg-9 col-md-7">
														<div class="subscriptions-info mt-10 mb-10">
															<h1>Fitnessity Ultimate 2.0</h1>
															<span>Billed on the 25th of the month: 0.00 USD / Month </span>
															<span>Darryl Phipps, Account #: 1587142</span>
														</div>
													</div>
													<div class="col-lg-3 col-md-5">
														<div class="text-right">
															<button class="btn btn-red">Current Plan </button>
															<button class="btn btn-black">Switch Plan</button>
														</div>
													</div>
												</div>
												<div class="dropdown-divider"></div>-->
												<!--<div class="row y-middle mmb-10">
													<div class="col-lg-9 col-md-7">
														<div class="subscriptions-info mt-10 mb-10">
															<h1>Payment Processing</h1>
															<span>Billed on the 25th of the month: 0.00 USD / Month </span>
															<span>Darryl Phipps, Account #: 1587142</span>
														</div>
													</div>
													<div class="col-lg-3 col-md-5">
														<div class="text-right">
															<button class="btn btn-red">Current Plan </button>
															<button class="btn btn-black">Switch Plan</button>
														</div>
													</div>
												</div>
												<div class="dropdown-divider"></div>-->
												
											</div>
										</div>
									</div><!-- end cardbody -->
								</div><!-- end card -->
							</div><!--end col-->
						</div><!--end row-->	

						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-body card-350-body mb-25">
										<div class="row">
											<div class="invoices-select">
												<label class="fs-16 mr-5">Invoices</label>
												<select class="form-select mb-3 width-30" aria-label="Default select example">
                                                    <option selected="">All available years </option>
                                                    <option value="1">2023</option>
                                                    <option value="2">2022</option>
                                                    <option value="3">2021</option>
                                                </select>
											</div>
											<div>
												<p class="fs-12">Older invoices may not be displayed. To retrieve these invoices, contact fitnessity customer support</p>
											</div>
											<div class="col-xxl-12 col-lg-12 col-md-12 col-sm-12">
												<div class="scheduler-table">
													<div class="table-responsive">
														<table class="table mb-0">
															<thead>
																<tr>
																	<th>Invoice Due Date</th>
																	<th>Invoice</th>
																	<th>Amount</th>
																	<th>Download PDF</th>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td><p class="mb-0">10/25/2023</p></td>
																	<td><p class="mb-0">18763634</p></td>
																	<td><p class="mb-0">410.37 USD</p></td>
																	<td><i class="fas fa-download"></i></td>
																</tr>
																<tr>
																	<td><p class="mb-0">9/25/2023</p></td>
																	<td><p class="mb-0">1502369</p></td>
																	<td><p class="mb-0">410.37 USD</p></td>
																	<td><i class="fas fa-download"></i></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div><!-- end cardbody -->
								</div><!-- end card -->
							</div><!--end col-->
						</div><!--end row-->
						
					</div> <!-- end .h-100-->
                  </div> <!-- end col -->
                </div>
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->
	
<!--	<div class="modal fade editcard" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="myModalLabel"> </h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-red">Submit</button>
				</div>
			</div>
		</div>
	</div>-->
	
	@include('layouts.business.footer')

@endsection