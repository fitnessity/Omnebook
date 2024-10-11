@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
@section('content')

	@include('layouts.business.business_topbar')

    <div class="main-content">
		<div class="page-content">
            <div class="container-fluid">
               <div class="row">
                  <div class="col">
                    <div class="h-100">
                        <div class="row mb-3">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="page-heading">
									<label class="mb-15">Check-in Portal </label>
								</div>
								<div class="page-subheading">
									<span>Good Morning, Ankita Patel</span>
								</div>
								<div class="page-subheading">
									<span>Date & Time: 1/2/2024, 5:15:17 PM</span>
								</div>
								<div class="page-subheading">
									<span>Check-In. You can also quick check alerts and news from Fitnessity</span>
								</div>
							</div>
							
                            <!--end col-->
						</div>
                        <!--end row-->
						
                        <div class="row">
                            <div class="col-xl-3 col-lg-4">								
                                <div class="card">
									<div class="card-body border-bottom-grey">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
													<div class="check-in-profile">
														<img src="https://fitnessity-production.s3.amazonaws.com/customer/Pj5DKQgqQZvsvjBEQokyaKtuHHNHEmv0xTExXX2D.jpg" alt="user-img" class="img-thumbnail rounded-circle">
													</div>
													<div class="check-pro-name mt-3">
														<span>Ankita Patel</span>
													</div>													
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>

                                <!--<div class="card-body border-bottom-grey">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <label class="fs-15">Missed Payments</label>
                                                    <div>
                                                        <button type="button" class="btn btn-red">Resolve</button>
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body border-bottom-grey">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <label class="fs-15">Documents Needed Signed</label>
                                                    <div>
                                                        <button type="button" class="btn btn-red">Review & Sign</button>
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body border-bottom-grey">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <label class="fs-15">Notes</label>
                                                    <div>
                                                        <button type="button" class="btn btn-red">View</button>
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div> -->

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-center">
                                                    <label class="fs-15">Money Owed</label>
													<div class="row y-middle">
														<div class="col-lg-8 col-md-8 col-8">
															<div class="mb-15">
																<span>1. Missed Payment for $40</span>
															</div>
														</div>
														<div class="col-lg-4 col-md-4 col-4">
															<div class="mb-15">
																<button type="button" class="btn btn-red"  data-bs-toggle="modal" data-bs-target="#payment-view">View</button>
															</div>
														</div>
													</div>
													<div class="row y-middle">
														<div class="col-lg-8 col-md-8 col-8">
															<div class="mb-15">
																<span>2. Missed Payment for $150</span>
															</div>
														</div>
														<div class="col-lg-4 col-md-4 col-4">
															<div class="mb-15">
																<button type="button" class="btn btn-red"  data-bs-toggle="modal" data-bs-target="#payment-view">View</button>
															</div>
														</div>
													</div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card -->
                            </div>
                            <!-- end col -->

                            <div class="col-xl-9 col-lg-8">
                                <div>
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row align-items-center">
                                                <div class="col">
                                                    <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
														<li class="nav-item">
                                                            <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#schedule-booking" role="tab">
                                                            	Schedule Bookings
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#productnav-all" role="tab">
                                                                Reserve By Membership
                                                            </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#productnav-published" role="tab">
                                                                Full Schedule
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-auto">
                                                    <div id="selection-element">
                                                        <div class="my-n1 d-flex align-items-center text-muted">
                                                            Select <div id="select-content" class="text-body fw-semibold px-1"></div> Result <button type="button" class="btn btn-link link-danger p-0 ms-3 shadow-none" data-bs-toggle="modal" data-bs-target="#removeItemModal">Remove</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end card header -->
                                        <div class="card-body">
                                            <div class="tab-content text-muted">
												<div class="tab-pane active" id="schedule-booking" role="tabpanel">
													<div class="col-xxl-12 col-lg-12">
														<div class="card">
															<div class="card-header align-items-center d-flex">
																<h4 class="card-title mb-0 flex-grow-1 font-red">Your Upcoming Classes</h4>
															</div><!-- end card header -->

															<div class="card-body">
																<div class="live-preview">
																	<div class="table-responsive">
																		<table class="table align-middle table-nowrap mb-0">
																			<thead>
																				<tr>
																					<th scope="col">Session</th>
																					<th scope="col">Program Name </th>
																					<th scope="col">Time and Date</th>
																					<th scope="col">Membership</th>
																					<th scope="col"> </th>
																					<th scope="col"> </th>
																				</tr>
																			</thead>
																			<tbody>
																				<tr>
																					<th scope="row">4/5 </th>
																					<td>Kickboxing Class </td>
																					<td>02/21/2024 10:00 AM (45 Min) </td>
																					<td>Love Tennis - 45 Minute Private (5 Pack) </td>
																					<td>
																						<div class="">
																							<a class="btn btn-red" href="http://dev.fitnessity.co/design/register_ep">Check-In</a>
																						</div>
																					</td>
																					<td>
																						<div class="">
																							<a class="btn btn-red" href="http://dev.fitnessity.co/personal/orders?business_id=68">View Booking</a>
																						</div>
																					</td>
																				</tr>
																				<tr>
																					<th scope="row">9991/10000 </th>
																					<td>Kickboxing Class </td>
																					<td>02/21/2024 10:00 AM (45 Min) </td>
																					<td>Go Golfers - 30 Minute Private (01 Pack) </td>
																					<td>
																						<div class="">
																							<a class="btn btn-red" href="http://dev.fitnessity.co/design/register_ep">Check-In</a>
																						</div>
																					</td>
																					<td>
																						<div class="">
																							<a class="btn btn-red" href="http://dev.fitnessity.co/personal/orders?business_id=68">View Booking</a>
																						</div>
																					</td>
																				</tr>
																			</tbody>
																		</table>
																	</div>
																</div>
															</div><!-- end card-body -->
														</div><!-- end card -->
													</div>

													<div class="col-xxl-12 col-lg-12">
														<div class="card space-btw">
															<div class="card-header align-items-center d-flex">
																<h4 class="card-title mb-0 flex-grow-1 font-red">Important Alerts</h4>
															</div><!-- end card-header -->

															<div class="card-body">
																<div class="dashed-border p-tb-10">
																	<div class="row y-middle">
																		<div class="col-lg-8 col-md-8 col-sm-8 col-12">
																			<div class="d-flex">
																				<i class="fa fa-user fs-18"></i>
																				<h6 class="mb-1 lh-base ms-3">Total Active Memberships <span class="font-red">(3)(0 New)</span></h6>
																			</div>
																		</div>
																		<div class="col-lg-4 col-md-4 col-sm-4 col-12">
																			<div class="flex-grow-1 ms-3 text-end">
																				<a class="btn btn-red" href="http://dev.fitnessity.co/personal/orders?business_id=68">View</a>
																			</div>
																		</div>
																	</div>
																</div>

																<div class="dashed-border p-tb-10">
																	<div class="row y-middle">
																		<div class="col-lg-8 col-md-8 col-sm-8 col-12">
																			<div class="d-flex">
																				<i class="fa fa-sticky-note fs-18"></i>
																				<h6 class="mb-1 lh-base ms-3"> Notes &amp; Alerts <span class="font-red">(12)(0 New)</span> </h6>
																			</div>
																		</div>
																		<div class="col-lg-4 col-md-4 col-sm-4 col-12">
																			<div class="flex-grow-1 ms-3 text-end">
																				<a class="btn btn-red" href="http://dev.fitnessity.co/personal/notes-alerts?business_id=68">View</a>
																			</div>
																		</div>
																	</div>
																</div>

																<div class="dashed-border p-tb-10">
																	<div class="row y-middle">
																		<div class="col-lg-8 col-md-8 col-sm-8 col-12">
																			<div class="d-flex">
																				<i class="fa fa-bullhorn fs-18"></i>
																				<h6 class="mb-1 lh-base ms-3">Announcements &amp; News <span class="font-red">(4)(0 New)</span></h6>
																			</div>
																		</div>
																		<div class="col-lg-4 col-md-4 col-sm-4 col-12">
																			<div class="flex-grow-1 ms-3 text-end">
																				<a class="btn btn-red" href="http://dev.fitnessity.co/personal/announcement-news?business_id=68">View</a>
																			</div>
																		</div>
																	</div>
																</div>

																<div class="dashed-border p-tb-10">
																	<div class="row y-middle">
																		<div class="col-lg-8 col-md-8 col-sm-8 col-12">
																			<div class="d-flex">
																				<i class="fa fa-file fs-18"></i>
																				<h6 class="mb-1 lh-base ms-3">Documents &amp; Terms Alerts <span class="font-red">(4)(0 New)</span></h6>
																			</div>
																		</div>
																		<div class="col-lg-4 col-md-4 col-sm-4 col-12">
																			<div class="flex-grow-1 ms-3 text-end">
																				<a class="btn btn-red" href="http://dev.fitnessity.co/personal/documents-contract?business_id=68">View</a>
																			</div>
																		</div>
																	</div>
																</div>
															</div><!-- end card body -->
														</div><!-- end card -->
													</div>
												</div>

                                                <div class="tab-pane" id="productnav-all" role="tabpanel">
													<div class="nav-custom-grey nav-custom mb-3">
														<div class="row">
															<div class="col-lg-6">
																<div class="btn-group mobile-none">
																	<button class="btn btn-booking-activity dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																		Filter Options
																	</button>
																	<div class="dropdown-menu" style="">
																		<a class="dropdown-item" href="#">All</a>
																		<a class="dropdown-item" href="#">Personal Trainer </a>
																		<a class="dropdown-item" href="#">Classes </a>
																		<a class="dropdown-item" href="#">Events </a>
																		<a class="dropdown-item" href="#">Experiences </a>
																	</div>
																</div>
															</div>
																
															<div class="col-lg-6">
																<!-- Nav tabs -->
																<ul class="nav nav-pills float-right mobile-none" role="tablist">
																	<li class="nav-item">
																		<a class="nav-link active" data-bs-toggle="tab" href="#nav-current" role="tab">
																			Active Bookings
																		</a>
																	</li>
																	<li class="nav-item">
																		<a class="nav-link" data-bs-toggle="tab" href="#nav-today" role="tab">
																			Today
																		</a>
																	</li>
																	<li class="nav-item">
																		<a class="nav-link" data-bs-toggle="tab" href="#nav-upcoming" role="tab">
																			Upcoming
																		</a>
																	</li>
																	<li class="nav-item">
																		<a class="nav-link" data-bs-toggle="tab" href="#nav-past" role="tab">
																			Past
																		</a>
																	</li>
																</ul>
															</div>
														</div>
													</div>
													<div class="tab-content text-muted">
														<div class="tab-pane active" id="nav-current" role="tabpanel">
															<div class="">
																<div class="row">
																	<div class="col-lg-5 col-md-5 col-12">
																		<label class="text-muted">
																			Today Date: Tuesday, August 15 , 2023 
																		</label>
																	</div>
																	<div class="col-lg-7 col-md-7 col-12">
																		<div class="float-right mb-20">
																			<div class="search-set mr-5">
																				<form class="client-search">
																					<div class="position-relative">
																						<input type="text" class="form-control" placeholder="Search By Activity" autocomplete="off" id="search-options" value="">
																						<span class="mdi mdi-magnify search-widget-icon"></span>
																						<span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
																					</div>
																					<div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
																						
																					</div>
																				</form>
																			</div>
																			<div class="multiple-options">
																				<div class="setting-icon">
																					<i class="ri-more-fill"></i>
																					<ul>
																						<li>
																							<a href="#"><i class="fas fa-plus text-muted"></i>Access Granted</a>
																						</li>
																						<li class="dropdown-divider"></li>
																						<li><a href="#" data-bs-target=".removeaccess" data-bs-toggle="modal"><i class="ri-delete-bin-fill align-bottom text-muted"></i>Remove Access</a></li>
																					</ul>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="col-lg-12 col-12">
																		<div class="active-member">
																			<h3>Active Membership Available For Bookings</h3>
																			<p>You can use an available membership below to reserve your spot in an activity</p>
																		</div>
																	</div>
																</div>
																
																<div class="live-preview">
																	<div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting">
																		<div class="accordion-item shadow">
																			<h2 class="accordion-header" id="accordionnestingExample1">
																				<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse1" aria-expanded="true" aria-controls="accor_nestingExamplecollapse1">
																					Summer Dance (5 Memberships)
																				</button>
																			</h2>
																			<div id="accor_nestingExamplecollapse1" class="accordion-collapse collapse show" aria-labelledby="accordionnestingExample1" data-bs-parent="#accordionnesting">
																				<div class="accordion-body">
																				
																					<div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting2">
																						<div class="accordion-item shadow">
																							<h2 class="accordion-header" id="accordionnesting2Example1">
																								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse1" aria-expanded="true" aria-controls="accor_nesting2Examplecollapse1">
																									<div class="container-fluid nopadding">
																										<div class="row y-middle">
																											<div class="col-lg-9 col-md-6 col-12 mobile0view-flex">
																												<div class="d-inline-block">
																													<img src="https://fitnessity-production.s3.amazonaws.com/activity/AZrNzk2XFUfgoDOla2ZEGo1nHIarxQ1S7dmDMPVB.jpg" alt="" class="rounded avatar-sm shadow mr-5"> 
																												</div>
																												<div class="mx-line d-inline-block mmt-10">
																													<label class="mr-10-title">Summer Dance</label>
																													<label>Remaining: 9999/10000 |</label>
																													<label>Expiration: 02-14-2025</label>
																												</div>
																											</div>
																											<div class="col-lg-2 col-md-3 col-8">
																												<div class="mmt-10">
																													<a class="btn btn-red">Reserve Now</a>
																												</div>
																											</div>
																											<div class="col-lg-1 col-md-3 col-4">
																												<div class="multiple-options">
																													<div class="setting-icon">
																														<i class="ri-more-fill"></i>
																														<ul>
																															<li>
																																<a href="" data-bs-toggle="modal" data-bs-target=".receipt"><i class="fas fa-plus text-muted"></i>Receipt</a>
																															</li>
																															<li class="dropdown-divider"></li>
																															<li><a href=""><i class="ri-delete-bin-fill align-bottom text-muted"></i>Delete</a></li>
																														</ul>
																													</div>
																												</div>
																											</div>
																										</div>
																									</div>
																								</button>
																							</h2>
																							<div id="accor_nesting2Examplecollapse1" class="accordion-collapse collapse" aria-labelledby="accordionnesting2Example1" data-bs-parent="#accordionnesting2">
																								<div class="accordion-body">
																									<div class="booking-activity-details">
																										<div class="row">
																											<div class="col-lg-6 col-6">
																												<label>BOOKING CONFIRMATION #</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span> FS_20230121022432467</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>TOTAL PRICE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>$ 19</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>PRICE OPTION</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>360 mt - 10000 Sessions</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>PAYMENT TYPE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>10000 Sessions</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>TOTAL REMAINING</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>9999/10000</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>PROGRAM NAME</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Summer Dance</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>EXPIRATION DATE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>02-14-2025</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>DATE BOOKED</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>01-21-2023</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>RESERVED DATE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>02-01-2023</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>BOOKED BY</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Albina Glick </span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>ACTIVITY TYPE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Dance</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>SERVICE TYPE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Adventure </span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>ACTIVITY LOCATION</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>At Business,On Location</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>ACTIVITY DURATION</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>03:45 AM to 04:30 AM</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>GREAT FOR</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Family,Groups</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>PARTICIPANTS</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>adult:1</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>WHO IS PARTICIPATING?</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Albina Glick</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>ADD ON SERVICES</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>-</span>
																											</div>
																											
																											<div class="col-12">
																												<div class="float-end mt-20">
																													<a class="btn btn-red" href="http://dev.fitnessity.co/business_activity_schedulers/68?business_service_id=5&amp;stype=experience&amp;priceid=1006&amp;customer_id=380" target="_blank">Schedule</a>
																													<a class="btn btn-black" href="http://dev.fitnessity.co//businessprofile/fitnesspvt.ltd./68" target="_blank">View Provider</a>
																												</div>
																											</div>
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="accordion-item shadow">
																							<h2 class="accordion-header" id="accordionnesting2Example2">
																								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting2Examplecollapse2">
																									<div class="container-fluid nopadding">
																										<div class="row y-middle">
																											<div class="col-lg-9 col-md-6 col-12  mobile0view-flex">
																												<div class="d-inline-block">
																													<img src="https://fitnessity-production.s3.amazonaws.com/activity/AZrNzk2XFUfgoDOla2ZEGo1nHIarxQ1S7dmDMPVB.jpg" alt="" class="rounded avatar-sm shadow mr-5"> 
																												</div>
																												<div class="mx-line d-inline-block mmt-10">
																													<label class="mr-10-title">Summer Dance</label>
																													<label>Remaining: 9999/10000 |</label>
																													<label>Expiration: 02-14-2025</label>
																												</div>
																											</div>
																											<div class="col-lg-2 col-md-3 col-8">
																												<div class="mmt-10">
																													<a class="btn btn-red">Reserve Now</a>
																												</div>
																											</div>
																											<div class="col-lg-1 col-md-3 col-4">
																												<div class="multiple-options">
																													<div class="setting-icon">
																														<i class="ri-more-fill"></i>
																														<ul>
																															<li>
																																<a href="" data-bs-toggle="modal" data-bs-target=".receipt"><i class="fas fa-plus text-muted"></i>Receipt</a>
																															</li>
																															<li class="dropdown-divider"></li>
																															<li><a href=""><i class="ri-delete-bin-fill align-bottom text-muted"></i>Delete</a></li>
																														</ul>
																													</div>
																												</div>
																											</div>
																										</div>
																									</div>
																								</button>
																							</h2>
																							<div id="accor_nesting2Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting2Example2" data-bs-parent="#accordionnesting2">
																								<div class="accordion-body">
																									Coming Soon
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="accordion-item shadow">
																			<h2 class="accordion-header" id="accordionnestingExample2">
																				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse2" aria-expanded="false" aria-controls="accor_nestingExamplecollapse2">
																					Love Tennis (2 Memberships)
																				</button>
																			</h2>
																			<div id="accor_nestingExamplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample2" data-bs-parent="#accordionnesting">
																				<div class="accordion-body">
																					
																					<div class="accordion nesting3-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting3">
																						<div class="accordion-item shadow mt-2">
																							<h2 class="accordion-header" id="accordionnesting3Example2">
																								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting3Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting3Examplecollapse2">
																									<div class="container-fluid nopadding">
																										<div class="row y-middle">
																											<div class="col-lg-9 col-md-6 col-12 mobile0view-flex">
																												<div class="d-inline-block">
																													<img src="https://fitnessity-production.s3.amazonaws.com/activity/q4UxwuaI2PIgmrucdj1UXx4NidpxWtEx5NvUz71H.jpg" alt="" class="rounded avatar-sm shadow mr-5"> 
																												</div>
																												<div class="mx-line d-inline-block mmt-10">
																													<label class="mr-10-title">Love Tennis</label>
																													<label>Remaining: 1052/10200 |</label>
																													<label>Expiration: 09-20-2025</label>
																												</div>
																											</div>
																											<div class="col-lg-2 col-md-3 col-8">
																												<div class="mmt-10">
																													<a class="btn btn-red">Reserve Now</a>
																												</div>
																											</div>	
																											<div class="col-lg-1 col-md-3 col-4">
																												<div class="multiple-options">
																													<div class="setting-icon">
																														<i class="ri-more-fill"></i>
																														<ul>
																															<li>
																																<a href="" data-bs-toggle="modal" data-bs-target=".receipt"><i class="fas fa-plus text-muted"></i>Receipt</a>
																															</li>
																															<li class="dropdown-divider"></li>
																															<li><a href=""><i class="ri-delete-bin-fill align-bottom text-muted"></i>Delete</a></li>
																														</ul>
																													</div>
																												</div>
																											</div>
																										</div>
																									</div>
																								</button>
																							</h2>
																							<div id="accor_nesting3Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting3Example2" data-bs-parent="#accordionnesting3">
																								<div class="accordion-body">
																									<div class="booking-activity-details">
																										<div class="row">
																											<div class="col-lg-6 col-6">
																												<label>BOOKING CONFIRMATION #</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span> FS_20230125203646758</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>TOTAL PRICE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>$ 950 </span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>PRICE OPTION</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>45 Minute Private (10 Pack) - 10 Sessions</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>PAYMENT TYPE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>10 Sessions</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>TOTAL REMAINING</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>9/10</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>PROGRAM NAME</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Love Tennis</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>EXPIRATION DATE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>01-25-2024</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>DATE BOOKED</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>01-26-2023</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>BOOKED BY</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Darryl Smith  </span>
																											</div>
																																																	
																											<div class="col-lg-6 col-6">
																												<label>ACTIVITY TYPE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Tennis</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>SERVICE TYPE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Personal Training,Personal Training </span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>ACTIVITY LOCATION</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>At Business,On Location</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>ACTIVITY DURATION</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>01:30 AM to 03:30 AM</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>GREAT FOR</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Kids,Teens,Adults</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>PARTICIPANTS</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>adult:1</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>WHO IS PARTICIPATING?</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Darryl Smith</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>ADD ON SERVICES</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>-</span>
																											</div>
																											
																											<div class="col-12">
																												<div class="float-end mt-20">
																													<a class="btn btn-red" href="http://dev.fitnessity.co/business_activity_schedulers/68?business_service_id=5&amp;stype=experience&amp;priceid=1006&amp;customer_id=380" target="_blank">Schedule</a>
																													<a class="btn btn-black" href="http://dev.fitnessity.co//businessprofile/fitnesspvt.ltd./68" target="_blank">View Provider</a>
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
																		</div>
																		<div class="accordion-item shadow">
																			<h2 class="accordion-header" id="accordionnestingExample3">
																				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse3" aria-expanded="false" aria-controls="accor_nestingExamplecollapse3">
																					Spring Lake Day Camp (15 Memberships)
																				</button>
																			</h2>
																			<div id="accor_nestingExamplecollapse3" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample3" data-bs-parent="#accordionnesting">
																				<div class="accordion-body">
																					
																					<div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting5">
																						<div class="accordion-item shadow">
																							<h2 class="accordion-header" id="accordionnesting4Example1">
																								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting4Examplecollapse1" aria-expanded="true" aria-controls="accor_nesting4Examplecollapse1">
																									<div class="container-fluid nopadding">
																										<div class="row y-middle">
																											<div class="col-lg-9 col-md-6 col-12 mobile0view-flex">
																												<div class="d-inline-block">
																													<img src="https://fitnessity-production.s3.amazonaws.com/activity/S8DTAfpqVGP5ItziWc1H5JZVpmzKCy6MvcjFwIFw.jpg" alt="" class="rounded avatar-sm shadow mr-5"> 
																												</div>
																												<div class="mx-line d-inline-block mmt-10">
																													<label class="mr-10-title">Spring Lake Day Camp</label>
																													<label>Remaining: 1052/10200 |</label>
																													<label>Expiration: 09-20-2025</label>
																												</div>
																											</div>
																											<div class="col-lg-2 col-md-3 col-8">
																												<div class="mmt-10">
																													<a class="btn btn-red">Reserve Now</a>
																												</div>
																											</div>
																											<div class="col-lg-1 col-md-3 col-4">
																												<div class="multiple-options">
																													<div class="setting-icon">
																														<i class="ri-more-fill"></i>
																														<ul>
																															<li>
																																<a href="" data-bs-toggle="modal" data-bs-target=".receipt"><i class="fas fa-plus text-muted"></i>Receipt</a>
																															</li>
																															<li class="dropdown-divider"></li>
																															<li><a href=""><i class="ri-delete-bin-fill align-bottom text-muted"></i>Delete</a></li>
																														</ul>
																													</div>
																												</div>
																											</div>
																										</div>
																									</div>
																								</button>
																							</h2>
																							<div id="accor_nesting4Examplecollapse1" class="accordion-collapse collapse" aria-labelledby="accordionnesting4Example1" data-bs-parent="#accordionnesting2">
																								<div class="accordion-body">
																									<div class="booking-activity-details">
																										<div class="row">
																											<div class="col-lg-6 col-6">
																												<label>BOOKING CONFIRMATION #</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span> FS_20230121022432467</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>TOTAL PRICE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>$ 19 </span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>PRICE OPTION</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>360 mt - 10000 Sessions</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>PAYMENT TYPE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>10000 Sessions</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>TOTAL REMAINING</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>9999/10000</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>PROGRAM NAME</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Summer Dance</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>EXPIRATION DATE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>02-14-2025</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>DATE BOOKED</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>01-21-2023</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>BOOKED BY</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Albina Glick </span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>ACTIVITY TYPE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Dance</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>SERVICE TYPE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Adventure </span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>ACTIVITY LOCATION</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>At Business,On Location</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>ACTIVITY DURATION</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>03:45 AM to 04:30 AM</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>GREAT FOR</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Family,Groups</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>PARTICIPANTS</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>adult:1</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>WHO IS PARTICIPATING?</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Albina Glick</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>ADD ON SERVICES</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>-</span>
																											</div>
																											
																											<div class="col-12">
																												<div class="float-end mt-20">
																													<a class="btn btn-red" href="http://dev.fitnessity.co/business_activity_schedulers/68?business_service_id=5&amp;stype=experience&amp;priceid=1006&amp;customer_id=380" target="_blank">Schedule</a>
																													<a class="btn btn-black" href="http://dev.fitnessity.co//businessprofile/fitnesspvt.ltd./68" target="_blank">View Provider</a>
																												</div>
																											</div>
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="accordion-item shadow">
																							<h2 class="accordion-header" id="accordionnesting5Example2">
																								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting5Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting5Examplecollapse2">
																									<div class="container-fluid nopadding">
																										<div class="row y-middle">
																											<div class="col-lg-9 col-md-6 col-12 mobile0view-flex">
																												<div class="d-inline-block">
																													<img src="https://fitnessity-production.s3.amazonaws.com/activity/S8DTAfpqVGP5ItziWc1H5JZVpmzKCy6MvcjFwIFw.jpg" alt="" class="rounded avatar-sm shadow mr-5"> 
																												</div>
																												<div class="mx-line d-inline-block mmt-10">
																													<label class="mr-10-title">Spring Lake Day Camp</label>
																													<label>Remaining: 1578/20200 |</label>
																													<label>Expiration: 05-20-2026</label>
																												</div>
																											</div>
																											<div class="col-lg-2 col-md-3 col-8">
																												<div class="mmt-10">
																													<a class="btn btn-red">Reserve Now</a>
																												</div>
																											</div>
																											<div class="col-lg-1 col-md-3 col-4">
																												<div class="multiple-options">
																													<div class="setting-icon">
																														<i class="ri-more-fill"></i>
																														<ul>
																															<li>
																																<a href="" data-bs-toggle="modal" data-bs-target=".receipt"><i class="fas fa-plus text-muted"></i>Receipt</a>
																															</li>
																															<li class="dropdown-divider"></li>
																															<li><a href=""><i class="ri-delete-bin-fill align-bottom text-muted"></i>Delete</a></li>
																														</ul>
																													</div>
																												</div>
																											</div>
																										</div>
																									</div>
																								</button>
																							</h2>
																							<div id="accor_nesting5Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting5Example2" data-bs-parent="#accordionnesting5">
																								<div class="accordion-body">
																									Coming Soon
																								</div>
																							</div>
																						</div>
																					</div>
																					
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div><!-- end card-body -->
														</div>
														<div class="tab-pane" id="nav-today" role="tabpanel">
															<div class="">
																<div class="row">
																	<div class="col-lg-5 col-12">
																		<label class="text-muted">
																			Today Date: Tuesday, August 15 , 2023 
																		</label>
																	</div>
																	<div class="col-lg-7 col-12">
																		<div class="float-right mb-20">
																			<div class="search-set">
																				<form class="client-search">
																					<div class="position-relative">
																						<input type="text" class="form-control" placeholder="Search By Activity" autocomplete="off" id="search-options" value="">
																						<span class="mdi mdi-magnify search-widget-icon"></span>
																						<span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
																					</div>
																					<div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
																						
																					</div>
																				</form>
																			</div>
																			<div class="btn-client-search">
																				<button type="button" class="btn-red-primary btn-red mmt-10" id="">Access Granted</button>
																			</div>
																			<div class="access-remove">
																				<a href="#removeaccess" data-target="#removeaccess" data-toggle="modal">Remove Access</a>
																			</div>
																		</div>
																	</div>
																</div>
																
																<div class="live-preview">
																	<div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting1">
																		<div class="accordion-item shadow">
																			<h2 class="accordion-header" id="accordionnestingExample5">
																				<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse5" aria-expanded="true" aria-controls="accor_nestingExamplecollapse5">
																					Go Golfers
																				</button>
																			</h2>
																			<div id="accor_nestingExamplecollapse5" class="accordion-collapse collapse show" aria-labelledby="accordionnestingExample5" data-bs-parent="#accordionnesting1">
																				<div class="accordion-body">
																					<div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting15">
																						<div class="accordion-item shadow">
																							<h2 class="accordion-header" id="accordionnesting5Example1">
																								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting5Examplecollapse1" aria-expanded="true" aria-controls="accor_nesting5Examplecollapse1">
																									<div class="container-fluid nopadding">
																										<div class="row y-middle">
																											<div class="col-lg-10 col-md-6 col-8 mobile0view-flex">
																												<div class="d-inline-block">
																													<img src="https://fitnessity-production.s3.amazonaws.com/activity/SlRSfhii37WWCZHnJVKAAfAelsHJstTCzG6W3Y9R.webp" alt="" class="rounded avatar-sm shadow mr-5"> 
																												</div>
																												<div class="mx-line d-inline-block">
																													<label class="mr-10-title">Go Golfers</label>
																													<label>Remaining: 9999/10000 |</label>
																													<label>Expiration: 02-14-2025</label>
																												</div>
																											</div>
																											<div class="col-lg-2 col-md-6 col-4">
																												<div class="multiple-options">
																													<div class="setting-icon">
																														<i class="ri-more-fill"></i>
																														<ul>
																															<li>
																																<a href="" data-bs-toggle="modal" data-bs-target=".receipt"><i class="fas fa-plus text-muted"></i>Receipt</a>
																															</li>
																															<li class="dropdown-divider"></li>
																															<li><a href=""><i class="ri-delete-bin-fill align-bottom text-muted"></i>Delete</a></li>
																														</ul>
																													</div>
																												</div>
																											</div>
																										</div>
																									</div>
																								</button>
																							</h2>
																							<div id="accor_nesting5Examplecollapse1" class="accordion-collapse collapse" aria-labelledby="accordionnesting5Example1" data-bs-parent="#accordionnesting15">
																								<div class="accordion-body">
																									<div class="booking-activity-details">
																										<p class="font-black">02-01-2023 | 03:45 AM to 04:30 AM </p>
																										<div class="row">
																											<div class="col-lg-6 col-6">
																												<label>BOOKING CONFIRMATION #</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span> FS_20230121022432467</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>TOTAL PRICE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>$ 19 </span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>PRICE OPTION</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>360 mt - 10000 Sessions</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>PAYMENT TYPE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>10000 Sessions</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>TOTAL REMAINING</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>9999/10000</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>PROGRAM NAME</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Summer Dance</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>EXPIRATION DATE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>02-14-2025</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>DATE BOOKED</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>01-21-2023</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>RESERVED DATE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>02-01-2023</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>BOOKED BY</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Albina Glick </span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>CHECK IN DATE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>02-01-2023</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>CHECK IN TIME</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>-</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>ACTIVITY TYPE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Dance</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>SERVICE TYPE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Adventure </span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>ACTIVITY LOCATION</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>At Business,On Location</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>ACTIVITY DURATION</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>03:45 AM to 04:30 AM</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>GREAT FOR</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Family,Groups</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>PARTICIPANTS</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>adult:1</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>WHO IS PARTICIPATING?</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Albina Glick</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>ADD ON SERVICES</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>-</span>
																											</div>
																											
																											<div class="col-12">
																												<div class="float-end mt-20">
																													<a class="btn btn-red" href="http://dev.fitnessity.co/business_activity_schedulers/68?business_service_id=5&amp;stype=experience&amp;priceid=1006&amp;customer_id=380" target="_blank">Schedule</a>
																													<a class="btn btn-black" href="http://dev.fitnessity.co//businessprofile/fitnesspvt.ltd./68" target="_blank">View Provider</a>
																												</div>
																											</div>
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="accordion-item shadow">
																							<h2 class="accordion-header" id="accordionnesting5Example2">
																								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting5Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting5Examplecollapse2">
																									<div class="container-fluid nopadding">
																										<div class="row y-middle">
																											<div class="col-lg-10 col-md-6 col-8 mobile0view-flex">
																												<div class="d-inline-block">
																													<img src="https://fitnessity-production.s3.amazonaws.com/activity/SlRSfhii37WWCZHnJVKAAfAelsHJstTCzG6W3Y9R.webp" alt="" class="rounded avatar-sm shadow mr-5"> 
																												</div>
																												<div class="mx-line d-inline-block">
																													<label class="mr-10-title">Go Golfers</label>
																												</div>
																											</div>
																											<div class="col-lg-2 col-md-6 col-4">
																												<div class="multiple-options">
																													<div class="setting-icon">
																														<i class="ri-more-fill"></i>
																														<ul>
																															<li>
																																<a href="" data-bs-toggle="modal" data-bs-target=".receipt"><i class="fas fa-plus text-muted"></i>Receipt</a>
																															</li>
																															<li class="dropdown-divider"></li>
																															<li><a href=""><i class="ri-delete-bin-fill align-bottom text-muted"></i>Delete</a></li>
																														</ul>
																													</div>
																												</div>
																											</div>
																										</div>
																									</div>
																								</button>
																							</h2>
																							<div id="accor_nesting5Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting5Example2" data-bs-parent="#accordionnesting15">
																								<div class="accordion-body">
																									Coming Soon
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="accordion-item shadow">
																			<h2 class="accordion-header" id="accordionnestingExample16">
																				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse16" aria-expanded="false" aria-controls="accor_nestingExamplecollapse16">
																					Extreme Bungee Jumping
																				</button>
																			</h2>
																			<div id="accor_nestingExamplecollapse16" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample16" data-bs-parent="#accordionnesting1">
																				<div class="accordion-body">
																					
																					<div class="accordion nesting3-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting16">
																						<div class="accordion-item shadow mt-2">
																							<h2 class="accordion-header" id="accordionnesting16Example2">
																								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting16Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting16Examplecollapse2">
																									<div class="container-fluid nopadding">
																										<div class="row y-middle">
																											<div class="col-lg-10 col-md-6 col-8 mobile0view-flex">
																												<div class="d-inline-block">
																													<img src="https://fitnessity-production.s3.amazonaws.com/activity/rr4c2ehnJWgy5sDhh3VXSwKEBCr8QldeJ38h4TzE.jpg" alt="" class="rounded avatar-sm shadow mr-5"> 
																												</div>
																												<div class="mx-line d-inline-block">
																													<label class="mr-10-title">Extreme Bungee Jumping</label>
																													<label>Remaining:  9/10 |</label>
																													<label>Expiration: 01-25-2024</label>
																												</div>
																											</div>
																											<div class="col-lg-2 col-md-6 col-4">
																												<div class="multiple-options">
																													<div class="setting-icon">
																														<i class="ri-more-fill"></i>
																														<ul>
																															<li>
																																<a href="" data-bs-toggle="modal" data-bs-target=".receipt"><i class="fas fa-plus text-muted"></i>Receipt</a>
																															</li>
																															<li class="dropdown-divider"></li>
																															<li><a href=""><i class="ri-delete-bin-fill align-bottom text-muted"></i>Delete</a></li>
																														</ul>
																													</div>
																												</div>
																											</div>
																										</div>
																									</div>
																								</button>
																							</h2>
																							<div id="accor_nesting16Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting16Example2" data-bs-parent="#accordionnesting16">
																								<div class="accordion-body">
																									<div class="booking-activity-details">
																										<p class="font-black">02-08-2023 | 01:30 AM to 03:30 AM  </p>
																										<div class="row">
																											<div class="col-lg-6 col-6">
																												<label>BOOKING CONFIRMATION #</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span> FS_20230125203646758</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>TOTAL PRICE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>$ 950 </span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>PRICE OPTION</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>45 Minute Private (10 Pack) - 10 Sessions</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>PAYMENT TYPE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>10 Sessions</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>TOTAL REMAINING</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>9/10</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>PROGRAM NAME</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Love Tennis</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>EXPIRATION DATE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>01-25-2024</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>DATE BOOKED</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>01-26-2023</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>RESERVED DATE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>02-08-2023</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>BOOKED BY</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Darryl Smith  </span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>CHECK IN DATE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>02-08-2023</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>CHECK IN TIME</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>-</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>ACTIVITY TYPE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Tennis</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>SERVICE TYPE</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Personal Training,Personal Training </span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>ACTIVITY LOCATION</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>At Business,On Location</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>ACTIVITY DURATION</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>01:30 AM to 03:30 AM</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>GREAT FOR</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Kids,Teens,Adults</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>PARTICIPANTS</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>adult:1</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>WHO IS PARTICIPATING?</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>Darryl Smith</span>
																											</div>
																											
																											<div class="col-lg-6 col-6">
																												<label>ADD ON SERVICES</label>
																											</div>
																											<div class="col-lg-6 col-6">
																												<span>-</span>
																											</div>
																											
																											<div class="col-12">
																												<div class="float-end mt-20">
																													<a class="btn btn-red" href="http://dev.fitnessity.co/business_activity_schedulers/68?business_service_id=5&amp;stype=experience&amp;priceid=1006&amp;customer_id=380" target="_blank">Schedule</a>
																													<a class="btn btn-black" href="http://dev.fitnessity.co//businessprofile/fitnesspvt.ltd./68" target="_blank">View Provider</a>
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
																		</div>
																	
																	</div>
																</div>
															</div><!-- end card-body -->
														</div>
														<div class="tab-pane" id="nav-upcoming" role="tabpanel">
															Coming soon 
														</div>
														<div class="tab-pane" id="nav-past" role="tabpanel">
															Coming soon
														</div>
													</div>
                                                </div>
                                                <!-- end tab pane -->

                                                <div class="tab-pane" id="productnav-published" role="tabpanel">
													<div class="row">
														<div class="col-md-12 col-xs-12 ">
															<div class="activity-schedule-tabs">
																<ul class="nav nav-tabs" role="tablist">
																	<li class="active">
																		<a class="nav-link" href="#" aria-expanded="true"> ALL </a>
																	</li>
																	<li>
																		<a class="nav-link" href="#" aria-expanded="true"> CLASSES </a>
																	</li>
																	<li>
																		<a class="nav-link" href="#" aria-expanded="true"> PRIVATE LESSONS </a>
																	</li>
																	<li>
																		<a class="nav-link" href="#" aria-expanded="true"> EVENTS </a>
																	</li>
																	<li>
																		<a class="nav-link" href="#" aria-expanded="true"> EXPERIENCE </a>
																	</li>
																</ul>
																<div class="tab-content">
																	<div class="tab-pane  active " id="tabs-all" role="tabpanel">
																		<div class="row">
																			<div class="col-md-12 col-sm-12 col-xs-12 text-right">
																				<div class="calendar-icon">
																					<input type="text" name="date" class="date datepicker hasDatepicker" readonly="" placeholder="DD/MM/YYYY" id="dp1706696183062"><img class="ui-datepicker-trigger" src="/public/img/calendar-icon.png" alt="Select date" title="Select date">
																				</div>
																			</div>
																		</div>
																		<div class="row">
																			<div class="owl-carousel owl-theme schedulers-arrows owl-loaded owl-drag">			
																				<div class="item">
																					<div class="pairets">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-01-31" class="calendar-btn">Wed 31</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-01" class="calendar-btn">Thu 01</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-02" class="calendar-btn">Fri 02</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-03" class="calendar-btn">Sat 03</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-04" class="calendar-btn">Sun 04</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-05" class="calendar-btn">Mon 05</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-06" class="calendar-btn">Tue 06</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-07" class="calendar-btn">Wed 07</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-08" class="calendar-btn">Thu 08</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-09" class="calendar-btn">Fri 09</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-10" class="calendar-btn">Sat 10</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-11" class="calendar-btn">Sun 11</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-12" class="calendar-btn">Mon 12</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-13" class="calendar-btn">Tue 13</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-14" class="calendar-btn">Wed 14</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-15" class="calendar-btn">Thu 15</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-16" class="calendar-btn">Fri 16</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-17" class="calendar-btn">Sat 17</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-18" class="calendar-btn">Sun 18</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-19" class="calendar-btn">Mon 19</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-20" class="calendar-btn">Tue 20</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-21" class="calendar-btn">Wed 21</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-22" class="calendar-btn">Thu 22</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-23" class="calendar-btn">Fri 23</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-24" class="calendar-btn">Sat 24</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-25" class="calendar-btn">Sun 25</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-26" class="calendar-btn">Mon 26</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-27" class="calendar-btn">Tue 27</a>
																					</div>
																				</div>
																				<div class="item">
																					<div class="pairets-inviable">
																						<a href="http://dev.fitnessity.co/business_activity_schedulers/68?date=2024-02-28" class="calendar-btn">Wed 28</a>
																					</div>
																				</div>
																			</div>										
																		</div>
																	</div>
																	<div class="tab-data">
																		<div class="row">
																			<div class="col-md-4 col-sm-4 col-xs-12">
																				<div class="checkout-sapre-tor"></div>
																			</div>
																			<div class="col-md-4 col-sm-4 col-xs-12 valor-mix-title">
																				<label>Activities on Wednesday, January 31</label>
																			</div>
																			<div class="col-md-4 col-sm-4 col-xs-12">
																				<div class="checkout-sapre-tor"></div>
																			</div>
																		</div>
																		<div class="activity-tabs">
																			<div class="row">
																				<div class="col-md-6 col-sm-6 col-xs-12">
																					<div class="classes-info text-left">
																						<div class="row">
																							<div class="col-md-12 col-xs-12">
																								<label class="fs-16">Category Name: </label> <span class="fs-16">Private Lessons Recurring Options</span>
																							</div>
																							<div class="col-md-12 col-xs-12 ">
																								<label>Program Name: </label> <span> Love Tennis</span>
																							</div>
																							<div class="col-md-12 col-xs-12">
																								<div class="text-left line-height-1">
																									<label>Activity: </label> <span> Tennis</span>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																				<div class="col-md-6 col-sm-6 col-xs-12">
																					<div class="row">
																						<div class="col-md-4 col-sm-5 col-xs-12">
																							<div class="classes-time">
																								<button class="post-btn post-btn-gray activity-scheduler" onclick="openPopUp(1173 , 158 ,'Kickboxing All Levels','01:15 am',1,'429');">01:15 am <br>1 hr</button>
																								<label>2/2  Spots Left</label>
																								<label>Mr. Phipps</label>
																							</div>
																						</div>
																					</div>
																				</div>
																				<div class="col-md-12 col-xs-12">
																					<div class="checkout-sapre-tor"></div>
																				</div>
																			</div> 
																			<div class="row">
																				<div class="col-md-6 col-sm-6 col-xs-12">
																					<div class="classes-info text-left">
																						<div class="row">
																							<div class="col-md-12 col-xs-12">
																								<label class="fs-16">Category Name: </label> <span class="fs-16">global acdamy</span>
																							</div>
																							<div class="col-md-12 col-xs-12 ">
																								<label>Program Name: </label> <span> Go Golfers</span>
																							</div>
																							<div class="col-md-12 col-xs-12">
																								<div class="text-left line-height-1">
																									<label>Activity: </label> <span> Golf</span>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																				<div class="col-md-6 col-sm-6 col-xs-12">
																					<div class="row">
																						<div class="col-md-4 col-sm-5 col-xs-12">
																							<div class="classes-time">
																								<button class="post-btn post-btn-gray activity-scheduler" onclick="openPopUp(1125 , 158 ,'Kickboxing All Levels','02:30 am',1,'364');">02:30 am <br>1 hr</button>
																								<label>5/5  Spots Left</label>
																								<label>Franecki Ardella, Discover Test</label>
																							</div>
																						</div>
																					</div>
																				</div>
																				<div class="col-md-12 col-xs-12">
																					<div class="checkout-sapre-tor"></div>
																				</div>
																			</div> 
																			<div class="row">
																				<div class="col-md-6 col-sm-6 col-xs-12">
																					<div class="classes-info text-left">
																						<div class="row">
																							<div class="col-md-12 col-xs-12">
																								<label class="fs-16">Category Name: </label> <span class="fs-16">1st river rafting</span>
																							</div>
																							<div class="col-md-12 col-xs-12 ">
																								<label>Program Name: </label> <span> River Rafting</span>
																							</div>
																							<div class="col-md-12 col-xs-12">
																								<div class="text-left line-height-1">
																									<label>Activity: </label> <span> Rafting</span>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																				<div class="col-md-6 col-sm-6 col-xs-12">
																					<div class="row">
																						<div class="col-md-4 col-sm-5 col-xs-12">
																							<div class="classes-time">
																								<button class="post-btn post-btn-gray activity-scheduler" onclick="openPopUp(1144 , 158 ,'Kickboxing All Levels','04:30 am',1,'384');">04:30 am <br>1 hr</button>
																								<label>2/2  Spots Left</label>
																								<label></label>
																							</div>
																						</div>
																					</div>
																				</div>
																				<div class="col-md-12 col-xs-12">
																					<div class="checkout-sapre-tor"></div>
																				</div>
																			</div> 
																			<div class="row">
																				<div class="col-md-6 col-sm-6 col-xs-12">
																					<div class="classes-info text-left">
																						<div class="row">
																							<div class="col-md-12 col-xs-12">
																								<label class="fs-16">Category Name: </label> <span class="fs-16">Private Lessons 30 Min. (1 Person)</span>
																							</div>
																							<div class="col-md-12 col-xs-12 ">
																								<label>Program Name: </label> <span> Bucephalus Riding and Polo Club1</span>
																							</div>
																							<div class="col-md-12 col-xs-12">
																								<div class="text-left line-height-1">
																									<label>Activity: </label> <span> Horseback Riding</span>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																				<div class="col-md-6 col-sm-6 col-xs-12">
																					<div class="row">
																						<div class="col-md-4 col-sm-5 col-xs-12">
																							<div class="classes-time">
																								<button class="post-btn  activity-scheduler" onclick="openPopUp(1139 , 158 ,'Kickboxing All Levels','09:15 am',0,'387');">09:15 am <br>1 hr</button>
																								<label>10/10  Spots Left</label>
																								<label>jack Black, Gimmy Ttouqe</label>
																							</div>
																						</div>
																					</div>
																				</div>
																				<div class="col-md-12 col-xs-12">
																					<div class="checkout-sapre-tor"> </div>
																				</div>
																			</div> 

																			<div class="row">
																				<div class="col-md-6 col-sm-6 col-xs-12">
																					<div class="classes-info text-left">
																						<div class="row">
																							<div class="col-md-12 col-xs-12">
																								<label class="fs-16">Category Name: </label> <span class="fs-16">rock and rock12</span>
																							</div>
																							<div class="col-md-12 col-xs-12 ">
																								<label>Program Name: </label> <span> Rock Climbing At USA</span>
																							</div>
																							<div class="col-md-12 col-xs-12">
																								<div class="text-left line-height-1">
																									<label>Activity: </label> <span> Rock Climbing</span>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																				<div class="col-md-6 col-sm-6 col-xs-12">
																					<div class="row">
																						<div class="col-md-4 col-sm-5 col-xs-12">
																							<div class="classes-time">
																								<button class="post-btn  activity-scheduler" onclick="openPopUp(1127 , 158 ,'Kickboxing All Levels','09:30 am',0,'385');">09:30 am <br>1 hr</button>
																								<label>20/20  Spots Left</label>
																								<label></label>
																							</div>
																						</div>
																					</div>
																				</div>
																				<div class="col-md-12 col-xs-12">
																					<div class="checkout-sapre-tor"></div>
																				</div>
																			</div> 
																			<div class="row">
																				<div class="col-md-6 col-sm-6 col-xs-12">
																					<div class="classes-info text-left">
																						<div class="row">
																							<div class="col-md-12 col-xs-12">
																								<label class="fs-16">Category Name: </label> <span class="fs-16">Kung Fu Fun</span>
																							</div>
																							<div class="col-md-12 col-xs-12 ">
																								<label>Program Name: </label> <span> Kung Fu Gym</span>
																							</div>
																							<div class="col-md-12 col-xs-12">
																								<div class="text-left line-height-1">
																									<label>Activity: </label> <span> Gymnastics</span>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																				<div class="col-md-6 col-sm-6 col-xs-12">
																					<div class="row">
																						<div class="col-md-4 col-sm-5 col-xs-12">
																							<div class="classes-time">
																								<button class="post-btn  activity-scheduler" onclick="openPopUp(1176 , 158 ,'Kickboxing All Levels','01:00 pm',0,'409');">01:00 pm <br>2 hr</button>
																								<label>1/1  Spots Left</label>
																								<label>Eric Smith</label>
																							</div>
																						</div>
																					</div>
																				</div>
																				<div class="col-md-12 col-xs-12">
																					<div class="checkout-sapre-tor"></div>
																				</div>
																			</div> 

																			<div class="row">
																				<div class="col-md-6 col-sm-6 col-xs-12">
																					<div class="classes-info text-left">
																						<div class="row">
																							<div class="col-md-12 col-xs-12">
																								<label class="fs-16">Category Name: </label> <span class="fs-16">Adult Program</span>
																							</div>
																							<div class="col-md-12 col-xs-12 ">
																								<label>Program Name: </label> <span> Kickboxing All Levels</span>
																							</div>
																							<div class="col-md-12 col-xs-12">
																								<div class="text-left line-height-1">
																									<label>Activity: </label> <span> Kickboxing</span>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																				<div class="col-md-6 col-sm-6 col-xs-12">
																					<div class="row">
																						<div class="col-md-4 col-sm-5 col-xs-12">
																							<div class="classes-time">
																								<button class="post-btn  activity-scheduler" onclick="openPopUp(1175 , 158 ,'Kickboxing All Levels','08:00 pm',0,'434');">08:00 pm <br>13 hr</button>
																								<label>1/1  Spots Left</label>
																								<label>Discover Test</label>
																							</div>
																						</div>
																					</div>
																				</div>
																				<div class="col-md-12 col-xs-12">
																					<div class="checkout-sapre-tor"></div>
																				</div>
																			</div> 
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
                                                </div>
                                                <!-- end tab pane --> 

                                            </div>
                                            <!-- end tab content -->

                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

					</div> <!-- end .h-100-->
                  </div> <!-- end col -->
                </div>
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->


<!-- Modal -->
<div class="modal fade" id="payment-view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-70">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
           		<div class="live-preview">
            		<div class="table-responsive">
                    	<table class="table align-middle table-nowrap mb-0">
                        	<thead>
                            	<tr>
                                	<th scope="col">Payment</th>
                                 	<th scope="col">Status</th>
                                   	<th scope="col">Failed or Missed</th>
                                 	<th scope="col">Failed Payment date </th>
                                  	<th scope="col"></th>
                              	</tr>
                           	</thead>
                          	<tbody>
                            	<tr>
                                	<th scope="row"><a href="#" class="fw-medium">Abc</a></th>
                                 	<td>Payed</td>
                                  	<td>-</td>
                                  	<td>-</td>
                                	<td><a href="javascript:void(0);" class="link-dangure">Paynow <i class="ri-arrow-right-line align-middle"></i></a></td>
                              	</tr>
								  <tr>
                                	<th scope="row"><a href="#" class="fw-medium">Xyz</a></th>
                                 	<td>Payed</td>
                                  	<td>-</td>
                                  	<td>-</td>
                                	<td><a href="javascript:void(0);" class="link-dangure">Paynow <i class="ri-arrow-right-line align-middle"></i></a></td>
                              	</tr>
                         	</tbody>
                       	</table>
                 	</div>
               	</div>
			</div>
		</div>
	</div>
</div>



@include('layouts.business.footer')
<script>
	$('.owl-carousel').owlCarousel({
	    loop:true,
	    margin:10,
	    nav:true,
		navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
	    responsive:{
	        0:{
	            items:3
	        },
	        600:{
	            items:3
	        },
	        1000:{
	            items:5
	        }
	    }
		
	});
</script>
@endsection


