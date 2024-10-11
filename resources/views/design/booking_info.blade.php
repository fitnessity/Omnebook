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
							<label>Select A Provider </label>
						</div>
					</div>
                </div><!--end row-->
				
				<div class="row">
					<div class="col-12">
						<div class="card" id="contact-view-detail">
							<div class="card-body text-center">
								<div class="booking-titles">
									<h4 class="fs-18">Start by Selecting A Provider</h4>
									<p>Subtext "Make a reservation, view your bookings and memberships, payment history, credit card information and more.</p>
								</div>
								<div class="row">
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<div class="card-body purchase-history mt-5 body-bg-gradient">
											<div class="d-flex flex-column h-100">
												<div class="d-flex mb-2">
													<div class="flex-grow-1 text-center">
														<h5 class="mb-1 fs-15"><a href="#" class="text-red fs-18">Fitness Pvt. Ltd.</a></h5>
														<!--<p class="text-black text-truncate-two-lines mb-3">20 Cooper Square, New York, New York, United States, 10003</p> -->
														<div class="d-grid booking-activity">
															<span> Active Memberships: 10</span>
															<span> Completed Memberships: 0 </span>
															<span> Expiring Memberships: 0 </span>
															<span> Attenance: 2 </span>
															<span> Notes & Alerts: <label class="font-red">0<label> </span>
														</div>
													</div>
												</div>
											</div>
											<div class="text-right">
												
											</div>
											<div class="card-footer bg-transparent border-top-dashed pt-8 footer-padding-remove">
												<div class="d-flex align-items-center">
													<div class="flex-grow-1 v-booking">
														<button type="submit" class="btn btn-red float-left" data-bs-toggle="modal" data-bs-target=".contact-info">Contact Info</button> 
													</div>
													<div class="flex-shrink-0 v-schedule">
														<button type="submit" class="btn btn-red">Select</button> 
													</div>
												</div>
											</div>
											<!--<div class="card-footer bg-transparent border-top-dashed pt-8 footer-padding-remove">
												<div class="d-flex align-items-center">
													<div class="flex-grow-1 v-booking">
														<a class="view-booking float-left" href="#"> View Bookings</a>
													</div>
													<div class="flex-shrink-0 v-schedule">
														<a class="view-schedule float-right" href="#"> View Schedule</a>
													</div>
												</div>
											</div> -->
										</div>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<div class="card-body purchase-history mt-5 body-bg-gradient">
											<div class="d-flex flex-column h-100">
												<div class="d-flex mb-2">
													<div class="flex-grow-1 text-center">
														<h5 class="mb-1 fs-15"><a href="#" class="text-red fs-18">arya pvt lmt </a></h5>
														<!--<p class="text-black text-truncate-two-lines mb-3">20 Cooper Square, New York, New York, United States, 10003</p> -->
														<div class="d-grid booking-activity">
															<span> Active Memberships: 3</span>
															<span> Completed Memberships: 1 </span>
															<span> Expiring Memberships: 0 </span>
															<span> Attenance: 0 </span>
															<span> Notes & Alerts: <label class="font-red">1<label> </span>
														</div>
													</div>
												</div>
											</div>
											<div class="card-footer bg-transparent border-top-dashed pt-8 footer-padding-remove">
												<div class="d-flex align-items-center">
													<div class="flex-grow-1 v-booking">
														<button type="submit" class="btn btn-red float-left" data-bs-toggle="modal" data-bs-target=".contact-info">Contact Info</button> 
													</div>
													<div class="flex-shrink-0 v-schedule">
														<button type="submit" class="btn btn-red">Select</button> 
													</div>
												</div>
											</div>
											<!--<div class="card-footer bg-transparent border-top-dashed pt-8 footer-padding-remove">
												<div class="d-flex align-items-center">
													<div class="flex-grow-1 v-booking">
														<a class="view-booking float-left" href="#"> View Bookings</a>
													</div>
													<div class="flex-shrink-0 v-schedule">
														<a class="view-schedule float-right" href="#"> View Schedule</a>
													</div>
												</div>
											</div> -->
										</div>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<div class="card-body purchase-history mt-5 body-bg-gradient">
											<div class="d-flex flex-column h-100">
												<div class="d-flex mb-2">
													<div class="flex-grow-1 text-center">
														<h5 class="mb-1 fs-15"><a href="#" class="text-red fs-18">Arya Company</a></h5>
													<!--<p class="text-black text-truncate-two-lines mb-3">240 East 38th Street, New York, New York, United States, 10016</p> -->
														<div class="d-grid booking-activity">
															<span> Active Memberships: 1</span>
															<span> Completed Memberships: 0 </span>
															<span> Expiring Memberships: 0 </span>
															<span> Attenance: 0 </span>
															<span> Notes & Alerts: <label class="font-red">2<label> </span>
														</div>
													</div>
												</div>
											</div>
											<div class="card-footer bg-transparent border-top-dashed pt-8 footer-padding-remove">
												<div class="d-flex align-items-center">
													<div class="flex-grow-1 v-booking">
														<button type="submit" class="btn btn-red float-left" data-bs-toggle="modal" data-bs-target=".contact-info">Contact Info</button> 
													</div>
													<div class="flex-shrink-0 v-schedule">
														<button type="submit" class="btn btn-red">Select</button> 
													</div>
												</div>
											</div>
											<!--<div class="card-footer bg-transparent border-top-dashed pt-8 footer-padding-remove">
												<div class="d-flex align-items-center">
													<div class="flex-grow-1 v-booking">
														<a class="view-booking float-left" href="#"> View Bookings</a>
													</div>
													<div class="flex-shrink-0 v-schedule">
														<a class="view-schedule float-right" href="#"> View Schedule</a>
													</div>
												</div>
											</div> -->
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

<div class="modal fade contact-info" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>  
			<div class="modal-body rev-post-box">
                <div class="d-grid contact-info-1">
					<div class="mb-5x">
						<label>Provider Business Name:</label>
						<span>Fitness Pvt. Ltd.</span>
					</div>
					<div class="mb-5x">
						<label>Company Representative:</label>
						<span>arya pvt lmt </span>
					</div>
					<div class="mb-5x">
						<label>Address: </label>
						<span>20 Cooper Square, New York, New York, United States, 10003</span>
					</div>
					<div class="mb-5x">
						<label>Phone: </label>
						<span>236 3596 3217</span>
					</div>
					<div class="mb-5x">
						<label>Email: </label>
						<span> contact@fitnessity.co </span>
					</div>
					<div class="mb-5x">
						<label>Website: </label>
						<span> http://dev.fitnessity.co </span>
					</div>
					<div> 
						<label>Location: </label>
						<div class="map-area-wrapper">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d52933472.40627602!2d-161.90502575786684!3d35.92732763546466!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited%20States!5e0!3m2!1sen!2sin!4v1700569528311!5m2!1sen!2sin" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
						</div>
					</div>
					
					
				</div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
	
	@include('layouts.business.footer')


@endsection