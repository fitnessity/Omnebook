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
							<label>BOOKINGS INFO - NIPA SONI </label>
						</div>
					</div>
                </div><!--end row-->
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-lg-12 col-md-6 col-12">
										<div class="form-group mmt-10 desktop-none-booking">
											<select class="form-select" name="frm_class_meets" id="frm_class_meets">
												<option selected="" value="All">All</option>
												<option value="Personal Trainer">Personal Trainer </option>
												<option value="Classes">Classes </option>
												<option value="Events">Events</option>
												<option value="Experiences">Experiences </option>
											</select>
										</div>
									</div>
									<div class="col-lg-12 col-md-6 col-12">
										<div class="form-group mmt-10 desktop-none-booking">
											<select class="form-select" name="frm_class_meets" id="frm_class_meets">
												<option selected="" value="Current">Current</option>
												<option value="Today">Today </option>
												<option value="Upcoming">Upcoming</option>
												<option value="Past">Past</option>
											</select>
										</div>
									</div>
								</div>
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
							</div><!-- end card-body -->
						</div>
					</div><!-- end col -->
				</div><!-- end row -->				
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->

<div class="modal fade receipt" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="" style="" aria-modal="true">
	<div class="modal-dialog modal-dialog-centered modal-70" id="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<h5 class="modal-title mb-10" id="myModalLabel">Booking Receipt</h5>
				<div class="row">
					<div class="col-lg-4 bg-sidebar">
						<div class="your-booking-page side-part">
							<div class="booking-page-meta">
								<a href="#" title="" class="underline"></a>
							</div>
							<div class="box-subtitle">
								<h4>Transaction Complete</h4>
								<div class="modal-inner-box">
									<label></label>
									<h3>Email Receipt</h3>
									<div class="form-group mb-25">
										<input type="text" name="email" id="email" placeholder="youremail@abc.com" class="form-control" value="nipavadhavana@gmail.com">
									</div>
									<button class="btn btn-red width-100 mb-25" onclick="sendemail();">Send Email Receipt</button>
									<div class="reviewerro" id="reviewerro"></div>
								</div>
							</div>
							<div class="powered-img">
								<label>Powered By</label>
								<div class="booking-modal-logo">
									<img src="http://dev.fitnessity.co/public/images/fitnessity_logo1.png">
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-8">
						<div class="modal-booking-info mmt-10 imt-10 main-separator mb-25">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="text-left space-bottom">
										<label>BOOKING#</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="float-end text-right">
										<span>FS_20230630082940252</span>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="text-left space-bottom">
										<label>PROVIDER COMPANY NAME:</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="float-end text-right">
										<span>Fitness Pvt. Ltd.</span>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="text-left space-bottom">
										<label>PROGRAM NAME:</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="float-end text-right">
										<span>Spring Lake Day Camp</span>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="text-left space-bottom">
										<label>CATEGORY:</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="float-end text-right">
										<span>Summer Camp Full Day</span>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="text-left space-bottom">
										<label>PRICE OPTION:</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="float-end text-right">
										<span>1 Day Full Camp</span>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="text-left space-bottom">
										<label>NUMBER OF SESSIONS:</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="float-end text-right">
										<span>1 Session</span>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="text-left space-bottom">
										<label>MEMBERSHIP OPTION:</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="float-end text-right">
										<span>Semester</span>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="text-left space-bottom">
										<label>PARTICIPANT QUANTITY:</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="float-end text-right">
										<span>adult:1</span>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="text-left space-bottom">
										<label>WHO IS PRATICIPATING?</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="float-end text-right">
										<span>gummy texas (18 yrs) Sister (Paid For by Nipa Soni)</span>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="text-left space-bottom">
										<label>ACTIVITY TYPE:</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="float-end text-right">
										<span>Day Camp</span>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="text-left space-bottom">
										<label>SERVICE TYPE:</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="float-end text-right">
										<span>Personal Training,Personal Training</span>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="text-left space-bottom">
										<label>MEMBERSHIP DURATION:</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="float-end text-right">
										<span>1 Days</span>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="text-left space-bottom">
										<label>PURCHASE DATE:</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="float-end text-right">
										<span>30-06-2023</span>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="text-left space-bottom">
										<label>MEMBERSHIP ACTIVATION DATE:</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="float-end text-right">
										<span>30-06-2023</span>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="text-left space-bottom">
										<label>MEMBERSHIP EXPIRATION:</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="float-end text-right">
										<span>01-07-2023</span>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="text-left space-bottom">
										<label class="highlight-fonts">PRICE:</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="float-end text-right">
										<span class="highlight-fonts">$50</span>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="text-left space-bottom">
										<label class="highlight-fonts">TOTAL:</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="float-end text-right">
										<span class="highlight-fonts">$50</span>
									</div>
								</div>
							</div>
						</div>
						
						<input type="hidden" name="booking_id" id="booking_id" value="1057"> 
						<input type="hidden" name="orderdetalidary[]" id="orderdetalidary" value="934"> 
						<div class="main-separator pay-space-remove mb-10">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class=" text-left">
										<label class="highlight-fonts">PAYMENT METHOD</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="float-end line-break text-right">
										<span class="highlight-fonts">cash</span>
									</div>
								</div>
							</div>
						</div>
								
						<div class="main-separator pay-space-remove mb-10">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class=" text-left">
										<label class="highlight-fonts">TIP AMOUNT</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="float-end line-break text-right">
										<span class="highlight-fonts">$0.00</span>
									</div>
								</div>
							</div>
						</div>
								
						<div class="main-separator pay-space-remove mb-10">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class=" text-left">
										<label class="highlight-fonts">DISCOUNT</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="float-end line-break text-right">
										<span class="highlight-fonts">$0.00</span>
									</div>
								</div>
							</div>
						</div>
								
						<div class="main-separator pay-space-remove mb-10">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class=" text-left">
										<label class="highlight-fonts">TAXES AND FEES</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="float-end line-break text-right">
										<span class="highlight-fonts">$0.00</span>
									</div>
								</div>
							</div>
						</div>
								
						<div class="main-separator pay-space-remove mb-10">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class=" text-left">
										<label class="highlight-fonts">MERCHANT FEE</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="float-end line-break text-right">
										<span class="highlight-fonts">$0</span>
									</div>
								</div>
							</div>
						</div>
								
						<div class="main-separator pay-space-remove mb-10">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class=" text-left">
										<label class="highlight-fonts">TOTAL AMOUNT PAID</label>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-6">
									<div class="float-end line-break text-right">
										<span class="highlight-fonts">$50</span>
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
	
<div class="modal fade removeaccess" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-modal="true">
	<div class="modal-dialog modal-dialog-centered" id="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="text-center">
					<p class="fs-14">You are about to remove your sync with Fitness Pvt. Ltd.. By denying access, the provider will no longer be able to link with your account. This allows the provider to automatically update your account and booking information with them.</p>
					<a class="addbusiness-btn-modal btn btn-red" href="#">Deny Access</a>
				</div>
			</div>
		</div>
	</div>
</div>
	@include('layouts.business.footer')

@endsection