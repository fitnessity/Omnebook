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
															<a href="{{route('business.sales_report.index')}}">Sales Reports</a>
														</div>
														<div class="report-links">
															<a href="{{route('business.credit_card_report.index')}}">Credit Card Expirations</a>
														</div>
														<div class="report-links">
															<a href="{{route('business.recurring_payments.index')}}">Recurring Payments Details</a>
														</div>
														<div class="report-links">
															<a href="{{route('business.money_owed.index')}}">Money Owed Details</a>
														</div>
														<!-- <div class="report-links">
															<a href="#">Tax Reports</a>
														</div> -->
														<div class="report-links">
															<a href="{{route('business.refund.index')}}">Refund Details</a>
														</div>

														<div class="report-links remove-border">
															<a href="{{route('business.membership_revenue')}}">Memberships & Revenue Breakdown</a>
														</div>
													</div>
												</div>												
											</div>
										</div>
										
										<div class="row">
											<div class="col-12 col-lg-4 col-md-4">
												<div class="reports-title">
													<label>Activity Bookings Reports</label>
												</div>
											</div>
											<div class="col-12 col-lg-6 col-md-8">
												<div class="card card-body box-border">
													<div class="d-grid align-items-center">
														<div class="report-links">
															<a href="{{route('business.todays_booking.index')}}">Bookings Today</a>
														</div>
														<div class="report-links">
															<a href="{{route('business.booking_category')}}">Bookings By Category</a>
														</div>
														<div class="report-links remove-border">
															<a href="{{route('business.booking_history')}}">Bookings History</a>
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
															<a href="{{route('business.client.index')}}">Inactive Clients</a>
														</div>
														<!-- <div class="report-links">
															<a href="#">Attendance</a>
														</div> -->
														<div class="report-links">
															<a href="{{route('business.client.birthday')}}">Client Birthday List</a>
														</div>
														<div class="report-links">
															<a href="{{route('business.client.new_client')}}">New Clients</a>
														</div>

														<div class="report-links">
															<a href="{{route('business.client.contact_list')}}">Contact List</a>
														</div>
														<div class="report-links">
															<a href="{{route('business.client.cancellation_noshow')}}">Cancellations & No Shows</a>
														</div>
														<!-- <div class="report-links remove-border">
															<a href="#">Referral Details</a>
														</div> -->
													</div>
												</div>												
											</div>
										</div>
										
										<div class="row">
											<div class="col-12 col-lg-4 col-md-4">
												<div class="reports-title">
													<label>Memberships</label>
												</div>
											</div>
											<div class="col-12 col-lg-6 col-md-8">
												<div class="card card-body box-border">
													<div class="d-grid align-items-center">
														<div class="report-links">
															<a href="{{route('business.active-membership.index')}}">Active Memberships</a>
														</div>
														<div class="report-links">
															<a href="{{route('business.activity-not-used')}}">Active Memberships Not Being Used</a>
														</div>
														<div class="report-links">
															<a href="{{route('business.membership-paused')}}">Memberships Paused</a>
														</div>
														<div class="report-links">
															<a href="{{route('business.membership-terminated')}}">Memberships Terminated</a>
														</div>
														<div class="report-links">
															<a href="{{route('business.member_expirations.index')}}">Expired Memberships</a>
														</div>
														<div class="report-links remove-border">
															<a href="{{route('business.membership-popular')}}">Membership Options by Popularity</a>
														</div>
													</div>
												</div>												
											</div>
										</div>
										
										<div class="row">
											<div class="col-12 col-lg-4 col-md-4">
												<div class="reports-title">
													<label>Inventory</label>
												</div>
											</div>
											<div class="col-12 col-lg-6 col-md-8">
												<div class="card card-body box-border">
													<div class="d-grid align-items-center">
														<div class="report-links remove-border">
															<a href="#">Products In Stock</a>
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
															<a href="{{route('business.online-review.index')}}">Online Reviews</a>
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