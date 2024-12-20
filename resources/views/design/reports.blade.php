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
									<label>Reports</label>
								</div>
							</div>
                            <!--end col-->
						</div>	
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col-12 col-lg-4 col-md-4">
												<div class="reports-title">
													<label>Financials</label>
												</div>
											</div>
											<div class="col-12 col-lg-6 col-md-8">
												<div class="card card-body box-border">
													<div class="d-grid align-items-center">
														<div class="report-links">
															<a href="#">Sales Reports</a>
														</div>
														<div class="report-links">
															<a href="#">Credit Card Expirations</a>
														</div>
														<div class="report-links">
															<a href="#">Recurring Payments Details</a>
														</div>
														<div class="report-links remove-border">
															<a href="#">Refund Details</a>
														</div>
													</div>
												</div>												
											</div>
										</div>
										
										<div class="row">
											<div class="col-12 col-lg-4 col-md-4">
												<div class="reports-title">
													<label>Client Reports</label>
												</div>
											</div>
											<div class="col-12 col-lg-6 col-md-8">
												<div class="card card-body box-border">
													<div class="d-grid align-items-center">
														<div class="report-links">
															<a href="#">Attendance</a>
														</div>
														<div class="report-links">
															<a href="#">Client Birthday List</a>
														</div>
														<div class="report-links">
															<a href="#">Leads</a>
														</div>
														<div class="report-links remove-border">
															<a href="#">Cancellations & No Shows</a>
														</div>
													</div>
												</div>												
											</div>
										</div>
										
										<div class="row">
											<div class="col-12 col-lg-4 col-md-4">
												<div class="reports-title">
													<label>Memberships </label>
												</div>
											</div>
											<div class="col-12 col-lg-6 col-md-8">
												<div class="card card-body box-border">
													<div class="d-grid align-items-center">
														<div class="report-links">
															<a href="#">Active Memberships</a>
														</div>
														<div class="report-links">
															<a href="#">Active Memberships Not Being Used</a>
														</div>
														<div class="report-links">
															<a href="#">Total Memberships</a>
														</div>
														<div class="report-links">
															<a href="#">Memberships Paused</a>
														</div>
														<div class="report-links">
															<a href="#">Memberships Terminated</a>
														</div>
														<div class="report-links">
															<a href="#">Expired Memberships</a>
														</div>
														<div class="report-links remove-border">
															<a href="#">Membership Options by Popularity</a>
														</div>
													</div>
												</div>												
											</div>
										</div>
										
										<div class="row">
											<div class="col-12 col-lg-4 col-md-4">
												<div class="reports-title">
													<label>Ratings & Reviews</label>
												</div>
											</div>
											<div class="col-12 col-lg-6 col-md-8">
												<div class="card card-body box-border">
													<div class="d-grid align-items-center">
														<div class="report-links remove-border">
															<a href="#">Online Reviews</a>
														</div>
													</div>
												</div>												
											</div>
										</div>
										
									</div>
								</div>
							</div>
						</div>
					</div> <!-- end .h-100-->
                  </div> <!-- end col -->
                </div>
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->
    
@include('layouts.business.footer')
	
@endsection