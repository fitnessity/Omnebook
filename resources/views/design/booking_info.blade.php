@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.profile.business_topbar')
	<!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
		<div class="page-content">
            <div class="container-fluid">
               <div class="row mb-3">
					<div class="col-12">
						<div class="page-heading">
							<label>BOOKINGS INFO & PURCHASE HISTORY </label>
						</div>
					</div>
                </div><!--end row-->
				
				<div class="row">
					<div class="col-12">
						<div class="card" id="contact-view-detail">
							<div class="card-body text-center">
								<div class="booking-titles">
									<h4 class="fs-18">Start by selecting a provider</h4>
									<p>You can view your bookings and purchases history.</p>
									<p>You can view the online schedule, make reservations, rebook or cancel an activity</p>
								</div>
								<div class="row">
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<div class="card-body purchase-history mt-5 body-bg-gradient">
											<div class="d-flex flex-column h-100">
												<div class="d-flex mb-2">
													<div class="flex-grow-1 text-center">
														<h5 class="mb-1 fs-15"><a href="#" class="text-black">Fitness Pvt. Ltd.</a></h5>
														<p class="text-black text-truncate-two-lines mb-3">20 Cooper Square, New York, New York, United States, 10003</p>
														<div class="d-grid booking-activity">
															<span> Active Memberships: 10</span>
															<span> Completed Memberships: 0 </span>
															<span> Expiring Memberships: 0 </span>
															<span> Number of visits: 2 </span>
														</div>
													</div>
												</div>
											</div>
											<div class="card-footer bg-transparent border-top-dashed pt-8 footer-padding-remove">
												<div class="d-flex align-items-center">
													<div class="flex-grow-1 v-booking">
														<a class="view-booking float-left" href="#"> View Bookings</a>
													</div>
													<div class="flex-shrink-0 v-schedule">
														<a class="view-schedule float-right" href="#"> View Schedule</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<div class="card-body purchase-history mt-5 body-bg-gradient">
											<div class="d-flex flex-column h-100">
												<div class="d-flex mb-2">
													<div class="flex-grow-1 text-center">
														<h5 class="mb-1 fs-15"><a href="#" class="text-black">arya pvt lmt </a></h5>
														<p class="text-black text-truncate-two-lines mb-3">20 Cooper Square, New York, New York, United States, 10003</p>
														<div class="d-grid booking-activity">
															<span> Active Memberships: 3</span>
															<span> Completed Memberships: 1 </span>
															<span> Expiring Memberships: 0 </span>
															<span> Number of visits: 0 </span>
														</div>
													</div>
												</div>
											</div>
											<div class="card-footer bg-transparent border-top-dashed pt-8 footer-padding-remove">
												<div class="d-flex align-items-center">
													<div class="flex-grow-1 v-booking">
														<a class="view-booking float-left" href="#"> View Bookings</a>
													</div>
													<div class="flex-shrink-0 v-schedule">
														<a class="view-schedule float-right" href="#"> View Schedule</a>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<div class="card-body purchase-history mt-5 body-bg-gradient">
											<div class="d-flex flex-column h-100">
												<div class="d-flex mb-2">
													<div class="flex-grow-1 text-center">
														<h5 class="mb-1 fs-15"><a href="#" class="text-black">Arya Company</a></h5>
														<p class="text-black text-truncate-two-lines mb-3">240 East 38th Street, New York, New York, United States, 10016</p>
														<div class="d-grid booking-activity">
															<span> Active Memberships: 1</span>
															<span> Completed Memberships: 0 </span>
															<span> Expiring Memberships: 0 </span>
															<span> Number of visits: 0 </span>
														</div>
													</div>
												</div>
											</div>
											<div class="card-footer bg-transparent border-top-dashed pt-8 footer-padding-remove">
												<div class="d-flex align-items-center">
													<div class="flex-grow-1 v-booking">
														<a class="view-booking float-left" href="#"> View Bookings</a>
													</div>
													<div class="flex-shrink-0 v-schedule">
														<a class="view-schedule float-right" href="#"> View Schedule</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
                            </div>							
						</div>
					</div>
				</div>
				
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->

	
	@include('layouts.business.footer')


@endsection