@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')
@include('layouts.profile.business_topbar')

	<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<div class="row mb-3">
					<div class="col-12">
						<div class="text-center">
							<div class="page-heading ph-provider">
								<label>Lorem Ipsum</label>
							</div>
							<div class="cus-provider-logo">
								<img src="http://dev.fitnessity.co//public/images/fitnessity_logo1_black.png">
							</div>
						</div>
					</div>
					<!--<div class="col-6">
						<div class="page-heading">
							<label>Lorem Ipsum</label>
						</div>
					</div>
					<div class="col-6">
						<div class="cus-provider-logo">
							<img src="http://dev.fitnessity.co//public/images/fitnessity_logo1_black.png">
						</div>
					</div>-->
				</div><!--end row-->
				<div class="row mb-3 pb-1">
					<div class="col-12">
						<div class="d-flex align-items-lg-center flex-lg-row flex-column">
							<div class="flex-grow-1">
								<h4 class="fs-17 mb-1">Welcome Back, Ankita Patel </h4>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-3 col-md-6">
						<!-- card -->
						<div class="card card-animate">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div class="white-box flex-grow-1 overflow-hidden">
										<p class="fw-medium text-muted text-truncate mb-0"> Total Attendance</p>
									</div>
									<div class="increase flex-shrink-0">
										<h5 class="text-success fs-14 mb-0">
										<i class="ri-arrow-right-up-line fs-13 align-middle"></i> + 89.50 % </h5> 
										<p>Increase</p>
									</div>
								</div>
								<div class="d-flex align-items-end justify-content-between mt-4">
									<div>
										<h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="1039.63">1,039.63</span></h4>
										
									</div>
									<div class="avatar-sm flex-shrink-0">
										<span class="avatar-title bg-success rounded fs-3">
											<i class="bx bx-dollar-circle"></i>
										</span>
									</div>
								</div>
							</div><!-- end card body -->
						</div><!-- end card -->
					</div><!-- end col -->

					<!--<div class="col-xl-3 col-md-6">
						<div class="card card-animate">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div class="white-box flex-grow-1 overflow-hidden">
										<p class="fw-medium text-muted text-truncate mb-0">Total Bookings | Month</p>
									</div>
									<div class="decrease flex-shrink-0">
										<h5 class="text-success fs-14 mb-0">
										<i class="ri-arrow-right-up-line fs-13 align-middle"></i> + 0.00 % </h5> <p>Increase</p>
									</div>
								</div>
								<div class="d-flex align-items-end justify-content-between mt-4">
									<div>
										<h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="60">60</span></h4>
									</div>
									<div class="avatar-sm flex-shrink-0">
										<span class="avatar-title bg-info rounded fs-3">
											<i class="bx bx-shopping-bag"></i>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div> -->

					<div class="col-xl-3 col-md-6">
						<!-- card -->
						<div class="card card-animate">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div class="white-box flex-grow-1 overflow-hidden">
										<p class="fw-medium text-muted text-truncate mb-0">Customers | Month</p>
									</div>
									<div class="increase flex-shrink-0">
										<h5 class="text-success fs-14 mb-0">
										<i class="ri-arrow-right-up-line fs-13 align-middle"></i> + 0 % </h5> <p>Increase</p>
									</div>
								</div>
								<div class="d-flex align-items-end justify-content-between mt-4">
									<div>
										<h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="1">1</span></h4>
									</div>
									<div class="avatar-sm flex-shrink-0">
										<span class="avatar-title bg-warning rounded fs-3">
											<i class="bx bx-user-circle"></i>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div><!-- end col -->

					<!--<div class="col-xl-3 col-md-6">
						<div class="card card-animate">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div class="white-box flex-grow-1 overflow-hidden">
										<p class="fw-medium text-muted text-truncate mb-0"> Store Sales | Month</p>
									</div>
									<div class="decrease flex-shrink-0">
										<h5 class="text-danger fs-14 mb-0">
											<i class="ri-arrow-right-down-line fs-13 align-middle"></i> -3.57 %
										</h5>
										<p>Decrease</p>
									</div>
								</div>
								<div class="d-flex align-items-end justify-content-between mt-4">
									<div>
										<h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="0">0</span></h4>
										<a href="" target="_blank" class="text-decoration-underline">View Sales Report</a>
									</div>
									<div class="avatar-sm flex-shrink-0">
										<span class="avatar-title bg-danger rounded fs-3">
											<i class="bx bx-wallet"></i>
										</span>
									</div>
								</div>
							</div>
						</div>
					</div>-->
				</div>

				<div class="row">
					<div class="col-lg-6">
						<div class="card">
							<div class="card-header align-items-center d-flex">
								<h4 class="card-title mb-0 flex-grow-1">Important Alerts</h4>
							</div><!-- end card-header -->

							<div class="card-body">
								<div class="dashed-border">
									<div class="d-flex mb-3 align-middle y-middle">
										<div class="flex-shrink-0">
											<img src="http://dev.fitnessity.co/public/uploads/discover/thumb/1649648221-snow ski.jpg" class="avatar-md rounded img-fluid shadow" style="height: 60px;" alt="">
										</div>
										<div class="flex-grow-0 ms-3">
											<h6 class="mb-1 lh-base">Total Active Memberships <span class="font-red">(0)</span></h6>
											<p class="text-muted fs-12 mb-0">Dec 12, 2021 <i class="mdi mdi-circle-medium align-middle mx-1"></i>09:22 AM</p>
										</div>
										<div class="flex-grow-1 ms-3 text-end">
											<button type="button" class="btn btn-red">View</button>
										</div>
									</div><!-- end -->
								</div>
								<div class="dashed-border">
									<div class="d-flex mt-3 mb-3 y-middle">
										<div class="flex-shrink-0">
											<img src="https://fitnessity-production.s3.amazonaws.com/activity/hRaDXKY7LX9XAuBp73XuNI4tlzMaJTpN1DC5vnqw.jpg" class="avatar-md rounded img-fluid shadow" style="height: 60px;" alt="">
										</div>
										<div class="flex-grow-0 ms-3">
											<h6 class="mb-1 lh-base"> Notes & Alerts <span class="font-red">(0)</span> </h6>
											<p class="text-muted fs-12 mb-0">Dec 03, 2021 <i class="mdi mdi-circle-medium align-middle mx-1"></i>12:09 PM</p>
										</div>
										<div class="flex-grow-1 ms-3 text-end">
											<button type="button" class="btn btn-red">View</button>
										</div>
									</div><!-- end -->
								</div>
								<div class="dashed-border">
									<div class="d-flex mt-3 mb-3 y-middle">
										<div class="flex-shrink-0">
											<img src="https://fitnessity-production.s3.amazonaws.com/activity/SlRSfhii37WWCZHnJVKAAfAelsHJstTCzG6W3Y9R.webp" class="avatar-md rounded img-fluid shadow" style="height: 60px;" alt="">
										</div>
										<div class="flex-grow-0 ms-3">
											<h6 class="mb-1 lh-base">Announcements & News <span class="font-red">(0)</span></h6>
											<p class="text-muted fs-12 mb-0">Nov 22, 2021 <i class="mdi mdi-circle-medium align-middle mx-1"></i>11:47 AM</p>
										</div>
										<div class="flex-grow-1 ms-3 text-end">
											<button type="button" class="btn btn-red">View</button>
										</div>
									</div><!-- end -->
								</div>
								<div class="dashed-border">
									<div class="d-flex mt-4 mb-3 y-middle">
										<div class="flex-shrink-0">
											<img src="http://dev.fitnessity.co/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="avatar-md rounded img-fluid shadow" style="height: 60px;" alt="">
										</div>
										<div class="flex-grow-0 ms-3">
											<h6 class="mb-1 lh-base">Documents & Terms Alerts <span class="font-red">(0)</span></h6>
											<p class="text-muted fs-12 mb-0">Nov 18, 2021 <i class="mdi mdi-circle-medium align-middle mx-1"></i>06:13 PM</p>
										</div>
										<div class="flex-grow-1 ms-3 text-end">
											<button type="button" class="btn btn-red">View</button>
										</div>
									</div><!-- end -->
								</div>
							</div><!-- end card body -->
						</div><!-- end card -->
					</div><!-- end col -->
					<div class="col-lg-6">
						<div class="card">
							<div class="card-header align-items-center d-flex">
								<h4 class="card-title mb-0 flex-grow-1">Your Upcoming Classes</h4>
							</div><!-- end card-header -->

							<div class="card-body">
								<div class="row">
									<div class="col-lg-12">
										<label class="fs-15">Tomorrow</label>
									</div>
								</div>
								<div class="d-flex align-middle y-middle">
									<div class="flex-shrink-1">
										<h6 class="mb-1 lh-base fs-14">8/7 <i class="mdi mdi-circle-medium align-middle mx-1"></i>8am - Vinyasa Flow - Malibu Beach Yoga </h6>
									</div>
									<div class="flex-grow-1 ms-3 text-end">
										<button type="button" class="btn btn-black">View Booking</button>
									</div>
								</div><!-- end -->
							</div><!-- end card body -->
						</div><!-- end card -->
					</div><!-- end col -->
				</div>
			</div><!-- container-fluid -->
		</div>
	</div><!-- end main content-->
	
</div><!-- END layout-wrapper -->
@include('layouts.business.footer')
@endsection