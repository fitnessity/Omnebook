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
                        <div class="row mb-3 y-middle">
							<div class="col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="page-heading">
									<label>Manage Customers</label>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-12">
								<div class="multiple-options">
									<div class="setting-icon">
										<i class="ri-more-fill fs-26"></i>
										<ul id="catUl0">
											<li><a href="#" data-bs-toggle="modal" data-bs-target="#merge_customer"><i class="fas fa-plus text-muted"></i>Merge Clients</a></li>
										</ul>
									</div>
								</div>
							</div>
                            <!--end col-->
						</div>
                        <!--end row-->
						<div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header align-items-center d-flex">
										<h4 class="card-title mb-0 flex-grow-1">Nipa Soni Account</h4>
									</div><!-- end card header -->
									<div class="card-body">
										<div class="live-preview">
											<div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting">
												<div class="accordion-item shadow">
													<h2 class="accordion-header" id="accordionnestingExample1">
														<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse1" aria-expanded="true" aria-controls="accor_nestingExamplecollapse1">
															Customer Information
														</button>
													</h2>
													<div id="accor_nestingExamplecollapse1" class="accordion-collapse collapse show" aria-labelledby="accordionnestingExample1" data-bs-parent="#accordionnesting">
														<div class="accordion-body">
															<div class="accordion-item shadow">
																<h2 class="accordion-header" id="accordionnesting7Example2">
																	<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting7Examplecollapse2" aria-expanded="true" aria-controls="accor_nesting7Examplecollapse2">
																		Customers Details
																	</button>
																</h2>
																<div id="accor_nesting7Examplecollapse2" class="accordion-collapse collapse show" aria-labelledby="accordionnesting7Example2" data-bs-parent="#accordionnesting7">
																	<div class="accordion-body">
																		<div class="container-fluid">
																			<div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
																				<div class="row d-flex align-items-center">
																					<div class="col-auto">
																						<div class="avatar-lg">
																							<div class="customers-name rounded-circle">
																								<p>N</p>
																							</div>
																						</div>
																							
																					</div>
																					<!--end col-->
																					<div class="col-lg-7 col-md-6 col-sm-5 col-xs-12 col-auto">
																						<div class="p-2">
																							<h3 class="mb-1">Nipa Soni</h3>
																						</div>
																					</div>
																					<!--end col-->
																					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 col-lg-auto order-last order-lg-0">
																						<div class="flex-shrink-0 float-end mfloat-left small0width">
																							<!--<a href="#" data-bs-toggle="modal" data-bs-target=".editprofile" class="btn btn-black small0width">
																								<i class="ri-edit-box-line align-bottom"></i> Edit Profile
																							</a> -->
																							<div class="modal fade editprofile" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
																								<div class="modal-dialog modal-dialog-centered modal-50">
																									<div class="modal-content">
																										<div class="modal-header">
																											<h5 class="modal-title" id="myModalLabel">Edit Customer</h5>
																											<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																										</div>
																										<div class="modal-body">
																											<div class="row">
																												<div class="col-lg-6 col-md-6 col-sm-6">
																													<div class="mb-10">
																														<label>	First Name</label>
																														<input class="form-control" type="text" id="fname" name="fname" placeholder="First name" value="Nipa">
																													</div>
																												</div>
																												<div class="col-lg-6 col-md-6 col-sm-6">
																													<div class="mb-10">
																														<label>Last Name</label>
																														<input class="form-control" type="text" id="lname" name="lname" placeholder="Last Name" value="Soni">
																													</div>
																												</div>
																												<div class="col-lg-6 col-md-6 col-sm-6">
																													<div class="mb-10">
																														<label>Email</label>
																														<input class="form-control" type="text" id="email" name="email" placeholder="Email" value="nipavadhavana@gmail.com">
																													</div>
																												</div>
																												<div class="col-lg-6 col-md-6 col-sm-6">
																													<div class="mb-10">
																														<label>	Phone Number </label>
																														<input class="form-control" type="text" id="phone_number" name="phone_number" placeholder="Phone Number" value="(156) 456-4511" data-behavior="text-phone">
																													</div>
																												</div>
																												<div class="col-lg-6 col-md-6 col-sm-6">
																													<div class="mb-10">
																														<label>	Birthdate </label>
																														<div class="input-group">
																															<input type="text" class="form-control border-0 dash-filter-picker flatpickr-range flatpiker-with-border" data-range-date="false" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
																														</div>
																													</div>
																												</div>
																												<div class="col-lg-6 col-md-6 col-sm-6">
																													<div class="mb-10">
																														<label>	Gender </label>
																														<div>
																															<input type="radio" name="gender" value="male"> Male
																															<input type="radio" name="gender" value="female"> Female
																															<input type="radio" name="gender" value="other"> Other
																														</div>
																													</div>
																												</div>
																												<div class="col-lg-6 col-md-6 col-sm-6">
																													<div class="mb-10">
																														<label>	Address </label>
																														<input class="form-control pac-target-input" type="text" id="b_address" name="address" placeholder="Address" value="" autocomplete="off">
																													</div>
																												</div>
																												<div class="col-lg-6 col-md-6 col-sm-6">
																													<div class="mb-10">
																														<label>	City  </label>
																														<input class="form-control" type="text" id="city" name="city" placeholder="City " value="">
																													</div>
																												</div>
																												<div class="col-lg-6 col-md-6 col-sm-6">
																													<div class="mb-10">
																														<label>	State </label>
																														<input class="form-control" type="text" id="state" name="state" placeholder="State" value="">
																													</div>
																												</div>
																												<div class="col-lg-6 col-md-6 col-sm-6">
																													<div class="mb-10">
																														<label>	Country </label>
																														<input class="form-control" type="text" id="country" name="country" placeholder="Country" value="US">
																													</div>
																												</div>
																												<div class="col-lg-6 col-md-6 col-sm-6">
																													<div class="mb-10">
																														<label>	Zipcode </label>
																														<input class="form-control" type="text" id="zipcode1" name="zipcode" placeholder="Zipcode" value="">
																													</div>
																												</div>
																												<div class="col-lg-6 col-md-6 col-sm-6">
																													<div class="mb-10">
																														<label>	Profile Picture</label>
																														<div class="userblock text-center">
																															<div class="login_links">
																																<div class="company-list-text"><p>N</p></div>
																															</div>
																														</div>
																														<input type="file" class="form-control mt-10" name="profile_pic" id="profile_pic">
																													</div>
																												</div>
																											</div>					
																										</div>
																										<div class="modal-footer">
																											<button type="button" class="btn btn-primary btn-red">Submit</button>
																										</div>
																									</div><!-- /.modal-content -->
																								</div><!-- /.modal-dialog -->
																							</div><!-- /.modal -->
																						</div>
																					</div>
																					<!--end col-->
																				</div>
																				<!--end row-->
																			</div>
																			<div class="card card-border">
																				<div class="card-body">
																					<div class="container-fluid">
																						<div class="row">
																							<div class="col-lg-6">
																								<div class="row mb-10">
																									<div class="col-lg-5 col-sm-5">
																										<label class="font-black">Email :</label>
																									</div>
																									<div class="col-lg-7 col-sm-7">
																										<span>nipavadhavana@gmail.com </span>
																									</div>
																								</div>
																								<div class="row mb-10">
																									<div class="col-lg-5 col-sm-5">
																										<label class="font-black">Phone Number :</label>
																									</div>
																									<div class="col-lg-7 col-sm-7">
																										<span>(156) 456-4511 </span>
																									</div>
																								</div>
																								<div class="row mb-10">
																									<div class="col-lg-5 col-sm-5">
																										<label class="font-black">Address :</label>
																									</div>
																									<div class="col-lg-7 col-sm-7">
																										<span>United States</span>
																									</div>
																								</div>
																								<div class="row mb-10">
																									<div class="col-lg-5 col-sm-5">
																										<label class="font-black">Last Visited :</label>
																									</div>
																									<div class="col-lg-7 col-sm-7">
																										<span>2023-04-11</span>
																									</div>
																								</div>
																								<div class="row mb-10">
																									<div class="col-lg-5 col-sm-5">
																										<label class="font-black">Birthday :</label>
																									</div>
																									<div class="col-lg-7 col-sm-7">
																										<span>01/02/2000</span>
																									</div>
																								</div>
																							</div>
																								
																							<div class="col-lg-6">
																								<div class="row mb-10">
																									<div class="col-lg-5 col-sm-5">
																										<label class="font-black">Age :</label>
																									</div>
																									<div class="col-lg-7 col-sm-7">
																										<span> 23 Years Old </span>
																									</div>
																								</div>
																								<div class="row mb-10">
																									<div class="col-lg-5 col-sm-5">
																										<label class="font-black">Gender :</label>
																									</div>
																									<div class="col-lg-7 col-sm-7">
																										<span> —   </span>
																									</div>
																								</div>
																								<div class="row mb-10">
																									<div class="col-lg-5 col-sm-5">
																										<label class="font-black">Location :</label>
																									</div>
																									<div class="col-lg-7 col-sm-7">
																										<span>US</span>
																									</div>
																								</div>
																								<div class="row mb-10"> 
																									<div class="col-lg-5 col-sm-5">
																										<label class="font-black">Customers Since :</label>
																									</div>
																									<div class="col-lg-7 col-sm-7">
																										<span>03/22/2023</span>
																									</div>
																								</div>
																								<div class="row mb-10"> 
																									<div class="col-lg-5 col-sm-5">
																										<label class="font-black">Your Self Check-In Code :</label>
																									</div>
																									<div class="col-lg-7 col-sm-7">
																										<span class="mr-25">3455</span>
																										<a href="#" data-bs-toggle="modal" data-bs-target="#check-in-code">(Add/Edit)</a>
																									</div>
																								</div>
																									
																							</div>
																							
																						</div>
																					</div>
																				</div><!-- end card body -->
																			</div>
																			<div class="card card-border">
																				<div class="card-body">
																					<div class="container-fluid">
																						<div class="row">
																							<div class="col-lg-12">
																								<div class="customer-info">
																									<h4 class="card-title mb-15 flex-grow-1">Customer Information</h4>
																								</div>						
																							</div>
																						</div>
																						<div class="row">
																							<div class="col-lg-6">
																								<div class="row mb-10">
																									<div class="col-lg-6 col-sm-6">
																										<label class="font-black">Status</label>
																									</div>
																									<div class="col-lg-6 col-sm-6">
																										<span class="font-green">Active</span>
																									</div>
																								</div>
																								<div class="row mb-10">
																									<div class="col-lg-6 col-sm-6">
																										<label class="font-black">Activities Booked</label>
																									</div>
																									<div class="col-lg-6 col-sm-6">
																										<span>0</span>
																									</div>
																								</div>
																								<div class="row mb-10">
																									<div class="col-lg-6 col-sm-6">
																										<label class="font-black">Money Spent</label>
																									</div>
																									<div class="col-lg-6 col-sm-6">
																										<span>$ 10.39</span>
																									</div>
																								</div>
																							</div>
																							<div class="col-lg-6">
																								<div class="row mb-10">
																									<div class="col-lg-6 col-sm-6">
																										<label class="font-black">Number of Visits</label>
																									</div>
																									<div class="col-lg-6 col-sm-6">
																										<span>0</span>
																									</div>
																								</div>
																								<div class="row mb-10">
																									<div class="col-lg-6 col-sm-6">
																										<label class="font-black">Active Memberships</label>
																									</div>
																									<div class="col-lg-6 col-sm-6">
																										<span class="font-green">2</span>
																									</div>
																								</div>
																								<div class="row mb-10">
																									<div class="col-lg-6 col-sm-6">
																										<label class="font-black">Expiring Memberships</label>
																									</div>
																									<div class="col-lg-6 col-sm-6">
																										<span>0</span>
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
															
														   <div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-2" id="accordionnesting2">
																<div class="accordion-item shadow">
																	<h2 class="accordion-header" id="accordionnesting2Example1">
																		<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse1" aria-expanded="false" aria-controls="accor_nesting2Examplecollapse1">
																			Account Details
																		</button>
																	</h2>
																	<div id="accor_nesting2Examplecollapse1" class="accordion-collapse collapse" aria-labelledby="accordionnesting2Example1" data-bs-parent="#accordionnesting2">
																		<div class="accordion-body">
																			
																			<div class="accordion nesting4-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting4">
																				<div class="accordion-item shadow">
																					<h2 class="accordion-header" id="accordionnesting4Example2">
																						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting4Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting4Examplecollapse2">
																							Active Memberships
																						</button>
																					</h2>
																					<div id="accor_nesting4Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting4Example2" data-bs-parent="#accordionnesting4">
																						<div class="accordion-body">
																							<div class="accordion nesting4-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting7">
																								<div class="accordion-item shadow">
																									<h2 class="accordion-header" id="accordionnesting4Example4">
																										<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting4Examplecollapse4" aria-expanded="false" aria-controls="accor_nesting4Examplecollapse2">
																											
																											<div class="container-fluid nopadding">
																												<div class="row mini-stats-wid d-flex align-items-center ">
																													<div class="col-lg-6 col-md-6 col-8">
																														Beach Volleyball BIRMINGHAM
																													</div>
																													<div class="col-lg-6 col-md-6 col-4">
																														<div class="multiple-options">
																															<div class="setting-icon">
																																<i class="ri-more-fill"></i>
																																<ul>
																																	<li data-bs-toggle="modal" data-bs-target=".view-visit">
																																		<a href=""><i class="fas fa-plus text-muted"></i>View Visits</a>
																																	</li>
																																	<li data-bs-toggle="modal" data-bs-target=".edit-details">
																																		<a href=""><i class="fas fa-plus text-muted"></i>Edit Booking</a>
																																	</li>
																																	<li data-bs-toggle="modal" data-bs-target=".void">
																																		<a href="#"><i class="fas fa-plus text-muted"></i>Refund or Void</a>
																																	</li>
																																	<li data-bs-toggle="modal" data-bs-target=".suspend">
																																		<a href="#"><i class="fas fa-plus text-muted"></i>Suspend or Terminate</a>
																																	</li>
																																	<li data-bs-toggle="modal" data-bs-target=".autopay-schedule">
																																		<a href="#"><i class="fas fa-plus text-muted"></i>Autopay Schedule</a>
																																	</li>
																																	<li data-bs-toggle="modal" data-bs-target=".autopay-history">
																																		<a href="#"><i class="fas fa-plus text-muted"></i>Autopay History</a>
																																	</li>
																																</ul>
																															</div>
																														</div>
																													</div>
																												</div>
																											</div>
																										</button>
																									</h2>
																									<div id="accor_nesting4Examplecollapse4" class="accordion-collapse collapse" aria-labelledby="accordionnesting4Example4" data-bs-parent="#accordionnesting7">
																										<div class="accordion-body">
																											<div class="mb-10">
																												<div class="red-separator mb-10">
																													<div class="container-fluid nopadding">
																														<div class="row">
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="inner-accordion-titles">
																																	<label> Beach Volleyball BIRMINGHAM</label>	
																																</div>
																															</div>
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="inner-accordion-titles float-end text-right line-break">
																																	<span>Remaining 10000/10000</span> 
																																	<a class="mailRecipt" href="#" data-bs-toggle="modal" data-bs-target=".customer-info"><i class="far fa-file-alt" aria-hidden="true"></i></a>
																																	<div class="modal fade customer-info" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
																																		<div class="modal-dialog modal-dialog-centered modal-70">
																																			<div class="modal-content">
																																				<div class="modal-header">
																																					<h5 class="modal-title" id="myModalLabel">Booking Receipt</h5>
																																						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																																					</div>
																																					<div class="modal-body">
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
																																											<div class="text-left">
																																												<label>BOOKING#</label>
																																											</div>
																																										</div>
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="float-end text-right">
																																												<span>FS_20230322024956862</span>
																																											</div>
																																										</div>
																																										
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="text-left">
																																												<label>PROVIDER COMPANY NAME:</label>
																																											</div>
																																										</div>
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="float-end text-right">
																																												<span>Arya Company</span>
																																											</div>
																																										</div>
																																										
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="text-left">
																																												<label>PROGRAM NAME:</label>
																																											</div>
																																										</div>
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="float-end text-right">
																																												<span>Beach Volleyball BIRMINGHAM</span>
																																											</div>
																																										</div>
																																										
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="text-left">
																																												<label>CATEGORY:</label>
																																											</div>
																																										</div>
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="float-end text-right">
																																												<span>Beach vollybal session</span>
																																											</div>
																																										</div>
																																										
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="text-left">
																																												<label>PRICE OPTION:</label>
																																											</div>
																																										</div>
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="float-end text-right">
																																												<span>Beach vollybal session</span>
																																											</div>
																																										</div>
																																										
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="text-left">
																																												<label>NUMBER OF SESSIONS:</label>
																																											</div>
																																										</div>
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="float-end text-right">
																																												<span>10000 Session</span>
																																											</div>
																																										</div>
																																										
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="text-left">
																																												<label>MEMBERSHIP OPTION:</label>
																																											</div>
																																										</div>
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="float-end text-right">
																																												<span>Drop In</span>
																																											</div>
																																										</div>
																																										
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="text-left">
																																												<label>PARTICIPANT QUANTITY:</label>
																																											</div>
																																										</div>
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="float-end text-right">
																																												<span>adult:1</span>
																																											</div>
																																										</div>
																																										
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="text-left">
																																												<label>WHO IS PRATICIPATING?</label>
																																											</div>
																																										</div>
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="float-end text-right">
																																												<span>Nipa Soni ( age 23 )</span>
																																											</div>
																																										</div>
																																										
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="text-left">
																																												<label>ACTIVITY TYPE:</label>
																																											</div>
																																										</div>
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="float-end text-right">
																																												<span>Beach Vollyball</span>
																																											</div>
																																										</div>
																																										
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="text-left">
																																												<label>SERVICE TYPE:</label>
																																											</div>
																																										</div>
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="float-end text-right">
																																												<span>Event,Event</span>
																																											</div>
																																										</div>
																																										
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="text-left">
																																												<label>MEMBERSHIP DURATION:</label>
																																											</div>
																																										</div>
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="float-end text-right">
																																												<span></span>
																																											</div>
																																										</div>
																																										
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="text-left">
																																												<label>PURCHASE DATE:</label>
																																											</div>
																																										</div>
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="float-end text-right">
																																												<span>22-03-2023</span>
																																											</div>
																																										</div>
																																										
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="text-left">
																																												<label>MEMBERSHIP ACTIVATION DATE:</label>
																																											</div>
																																										</div>
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="float-end text-right">
																																												<span>22-03-2023</span>
																																											</div>
																																										</div>
																																										
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="text-left">
																																												<label>MEMBERSHIP EXPIRATION:</label>
																																											</div>
																																										</div>
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="float-end text-right">
																																												<span>20-01-2024</span>
																																											</div>
																																										</div>
																																										
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="text-left">
																																												<label class="highlight-fonts">PRICE:</label>
																																											</div>
																																										</div>
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="float-end text-right">
																																												<span class="highlight-fonts">$10</span>
																																											</div>
																																										</div>
																																										
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="text-left">
																																												<label class="highlight-fonts">TOTAL:</label>
																																											</div>
																																										</div>
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="float-end text-right">
																																												<span class="highlight-fonts">$10</span>
																																											</div>
																																										</div>
																																										
																																									</div>
																																								</div>
																																								
																																								<div class="main-separator mb-10">
																																									<div class="row">
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class=" text-left">
																																												<label class="highlight-fonts">PAYMENT METHOD</label>
																																											</div>
																																										</div>
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="float-end line-break text-right">
																																												<span class="highlight-fonts">amex ****8431</span>
																																											</div>
																																										</div>
																																									</div>
																																								</div>
																																										
																																								<div class="main-separator mb-10">
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
																																										
																																								<div class="main-separator mb-10">
																																									<div class="row">
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class=" text-left">
																																												<label class="highlight-fonts">DISCOUNT</label>
																																											</div>
																																										</div>
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="float-end line-break text-right">
																																												<span class="highlight-fonts">$1.00</span>
																																											</div>
																																										</div>
																																									</div>
																																								</div>
																																										
																																								<div class="main-separator mb-10">
																																									<div class="row">
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class=" text-left">
																																												<label class="highlight-fonts">TAXES AND FEES</label>
																																											</div>
																																										</div>
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="float-end line-break text-right">
																																												<span class="highlight-fonts">$0.89</span>
																																											</div>
																																										</div>
																																									</div>
																																								</div>
																																										
																																								<div class="main-separator mb-10">
																																									<div class="row">
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class=" text-left">
																																												<label class="highlight-fonts">MERCHANT FEE</label>
																																											</div>
																																										</div>
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="float-end line-break text-right">
																																												<span class="highlight-fonts">$-1</span>
																																											</div>
																																										</div>
																																									</div>
																																								</div>
																																										
																																								<div class="main-separator mb-10">
																																									<div class="row">
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class=" text-left">
																																												<label class="highlight-fonts">TOTAL AMOUNT PAID</label>
																																											</div>
																																										</div>
																																										<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																											<div class="float-end line-break text-right">
																																												<span class="highlight-fonts">$10.39</span>
																																											</div>
																																										</div>
																																									</div>	
																																								</div>
																																								
																																							</div>
																																						</div>
																																					</div>
																																			</div><!-- /.modal-content -->
																																		</div><!-- /.modal-dialog -->
																																	</div><!-- /.modal -->
																																</div>
																															</div>
																														</div>
																													</div>
																												</div>
																											
																												<div class="container-fluid nopadding">
																													<div class="row">
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>BOOKING # </label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span> FS_20230322024956862 </span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>TOTAL PRICE </label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span> $10.39 </span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>PAYMENT TYPE:</label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span></span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>TOTAL REMAINING:</label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span>10000/10000</span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>PROGRAM NAME:</label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span>Beach Volleyball BIRMINGHAM </span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>EXPIRATION DATE:</label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span> 01/20/2024</span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>DATE BOOKED:	</label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span>03/22/2023</span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>BOOKING TIME: </label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span> 07:00 PM</span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>ACTIVITY TYPE:</label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span>Beach Vollyball</span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>SERVICE TYPE:</label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span>Personal Training</span>
																															</div>
																														</div>
																													</div>
																												</div>
																											</div>
																										</div>
																									</div>
																								</div>
																							</div>
																							
																							<div class="accordion nesting4-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting6">
																								<div class="accordion-item shadow">
																									<h2 class="accordion-header" id="accordionnesting4Example3">
																										<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting4Examplecollapse3" aria-expanded="false" aria-controls="accor_nesting4Examplecollapse3">
																											<div class="container-fluid nopadding">
																												<div class="row mini-stats-wid d-flex align-items-center">
																													<div class="col-lg-6 col-md-6 col-8">
																														Beach Volleyball BIRMINGHAM
																													</div>
																													<div class="col-lg-6 col-md-6 col-4">
																														<div class="multiple-options">
																															<div class="setting-icon">
																																<i class="ri-more-fill"></i>
																																<ul>
																																	<li data-bs-toggle="modal" data-bs-target=".view-visit">
																																		<a href=""><i class="fas fa-plus text-muted"></i>View Visits</a>
																																	</li>
																																	<li data-bs-toggle="modal" data-bs-target=".edit-details">
																																		<a href=""><i class="fas fa-plus text-muted"></i>Edit Booking</a>
																																	</li>
																																	<li data-bs-toggle="modal" data-bs-target=".void">
																																		<a href="#"><i class="fas fa-plus text-muted"></i>Refund or Void</a>
																																	</li>
																																	<li data-bs-toggle="modal" data-bs-target=".suspend">
																																		<a href="#"><i class="fas fa-plus text-muted"></i>Suspend or Terminate</a>
																																	</li>
																																	<li data-bs-toggle="modal" data-bs-target=".autopay-schedule">
																																		<a href="#"><i class="fas fa-plus text-muted"></i>Autopay Schedule</a>
																																	</li>
																																	<li data-bs-toggle="modal" data-bs-target=".autopay-history">
																																		<a href="#"><i class="fas fa-plus text-muted"></i>Autopay History</a>
																																	</li>
																																</ul>
																															</div>
																														</div>
																													</div>
																												</div>
																											</div>
																										</button>
																									</h2>
																									<div id="accor_nesting4Examplecollapse3" class="accordion-collapse collapse" aria-labelledby="accordionnesting4Example3" data-bs-parent="#accordionnesting6">
																										<div class="accordion-body">
																											<div class="mb-10">
																												<div class="red-separator mb-10">
																													<div class="container-fluid nopadding">
																														<div class="row">
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="inner-accordion-titles">
																																	<label>Beach Volleyball BIRMINGHAM</label>	
																																</div>
																															</div>
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="inner-accordion-titles float-end text-right line-break">
																																	<span>Remaining 10000/10000</span> 
																																	<a class="mailRecipt"><i class="far fa-file-alt" aria-hidden="true"></i></a>
																																</div>
																															</div>
																														</div>
																													</div>
																												</div>
																											
																												<div class="container-fluid nopadding">
																													<div class="row">
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>BOOKING # </label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span>  FS_20230411040545580 </span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>TOTAL PRICE </label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span> $31.16 </span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>PAYMENT TYPE:</label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span></span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>TOTAL REMAINING:</label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span>10000/10000</span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>PROGRAM NAME:</label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span> Beach Volleyball BIRMINGHAM</span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>EXPIRATION DATE:</label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span> 01/20/2024 </span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>DATE BOOKED:	</label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span>04/11/2023</span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>BOOKING TIME: </label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span> 07:00 PM </span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>ACTIVITY TYPE:</label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span>Beach Vollyball</span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>SERVICE TYPE:</label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span>Personal Training</span>
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
																			
																			<div class="accordion nesting5-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting5">
																				<div class="accordion-item shadow">
																					<h2 class="accordion-header" id="accordionnesting5Example2">
																						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting5Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting5Examplecollapse2">
																							 Completed Memberships
																						</button>
																					</h2>
																					<div id="accor_nesting5Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting5Example2" data-bs-parent="#accordionnesting5">
																						<div class="accordion-body">
																						
																							<div class="accordion nesting5-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting01">
																								<div class="accordion-item shadow">
																									<h2 class="accordion-header" id="accordionnesting01Example2">
																										<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting01Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting01Examplecollapse2">
																											 <div class="container-fluid nopadding">
																												<div class="row mini-stats-wid d-flex align-items-center ">
																													<div class="col-lg-6 col-md-6 col-8">
																														Beach Volleyball BIRMINGHAM
																													</div>
																													<div class="col-lg-6 col-md-6 col-4">
																														<div class="multiple-options">
																															<div class="setting-icon">
																																<i class="ri-more-fill"></i>
																																<ul>
																																	<li data-bs-toggle="modal" data-bs-target=".view-visit">
																																		<a href=""><i class="fas fa-plus text-muted"></i>View Visits</a>
																																	</li>
																																</ul>
																															</div>
																														</div>
																													</div>
																												</div>
																											</div>
																										</button>
																									</h2>
																									<div id="accor_nesting01Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting01Example2" data-bs-parent="#accordionnesting01">
																										<div class="accordion-body">
																											<div class="mb-10">
																												<div class="red-separator mb-10">
																													<div class="container-fluid nopadding">
																														<div class="row">
																															<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																																<div class="inner-accordion-titles">
																																	<label> Beach Volleyball BIRMINGHAM</label>	
																																</div>
																															</div>
																														</div>
																													</div>
																												</div>
																											
																												<div class="container-fluid nopadding">
																													<div class="row">
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>BOOKING # </label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span> FS_20230322024956862 </span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>TOTAL PRICE </label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span> $10.39 </span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>PAYMENT TYPE:</label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span></span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>TOTAL REMAINING:</label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span>10000/10000</span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>PROGRAM NAME:</label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span>Beach Volleyball BIRMINGHAM </span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>EXPIRATION DATE:</label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span> 01/20/2024</span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>DATE BOOKED:	</label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span>03/22/2023</span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>BOOKING TIME: </label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span> 07:00 PM</span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>ACTIVITY TYPE:</label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span>Beach Vollyball</span>
																															</div>
																														</div>
																													
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="line-break">
																																<label>SERVICE TYPE:</label>
																															</div>
																														</div>
																														<div class="col-lg-6 col-md-6 col-sm-6 col-6">
																															<div class="float-end line-break text-right">
																																<span>Personal Training</span>
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
																			
																		</div>
																	</div>
																</div>
																
																<div class="accordion-item shadow">
																	<h2 class="accordion-header" id="accordionnesting2Example2">
																		<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting2Examplecollapse2">
																			Purchase history
																		</button>
																	</h2>
																	<div id="accor_nesting2Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting2Example2" data-bs-parent="#accordionnesting2">
																		<div class="accordion-body">
																			<div class="purchase-history">
																				<div class="table-responsive">
																					<table class="table mb-0">
																						<thead>
																							<tr>
																								<th>Sale Date </th>
																								<th>Item Description </th>
																								<th>Item Type</th>
																								<th>Pay Method</th>
																								<th>Price</th>
																								<th>Qty</th>
																								<th>Refund/Void</th>
																								<th>Receipt</th>
																							</tr>
																						</thead>
																						<tbody>
																							<tr>
																								<td>04/21/2023</td>
																								<td>1. Beach Volleyball BIRMINGHAM (Beach vollybal session) ,Beach vollybal session</td>
																								<td>Membership</td>
																								<td>discover ****9424</td>
																								<td>$10.39</td>
																								<td>1</td>
																								<td>Refund | Void</td>
																								<td>
																									<a class="mailRecipt" data-behavior="send_receipt" data-url="#" data-item-type="Membership" data-modal-width="900px">
																									<i class="far fa-file-alt" aria-hidden="true"></i>
																									</a>
																								</td>
																							</tr>
																						</tbody>
																					</table>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																
																<div class="accordion-item shadow">
																	<h2 class="accordion-header" id="accordionnesting8Example2">
																		<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting8Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting8Examplecollapse2">
																			Connected Family Accounts (0)
																		</button>
																	</h2>
																	<div id="accor_nesting8Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting8Example2" data-bs-parent="#accordionnesting8">
																		<div class="accordion-body">
																			<div class="purchase-history">
																				<div class="table-responsive">
																					<table class="table mb-0">
																						<thead>
																							<tr>
																								<th>Name</th>
																								<th>Relationship</th>
																								<th>Age</th>
																								<th></th>
																								<th></th>
																							</tr>
																						</thead>
																						<tbody>
																							<tr>
																								<td> Nipa Soni </td>
																								<td></td>
																								<td>23</td>
																								<td><a href="#" class="btn btn-red width-100">Add</a></td>
																								<td><a href="#" class="btn btn-black width-100">View</a></td>
																							</tr>
																						</tbody>
																					</table>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																
																<!--<div class="accordion-item shadow">
																	<h2 class="accordion-header" id="accordionnesting3Example1">
																		<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting3Examplecollapse1" aria-expanded="false" aria-controls="accor_nesting3Examplecollapse1">
																			Customer Info
																		</button>
																	</h2>
																	<div id="accor_nesting3Examplecollapse1" class="accordion-collapse collapse" aria-labelledby="accordionnesting3Example1" data-bs-parent="#accordionnesting3">
																		<div class="accordion-body">
																			Comming soon
																		</div>
																	</div>
																</div>-->
																
																<div class="accordion-item shadow">
																	<h2 class="accordion-header" id="accordionnesting6Example2">
																		<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting6Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting6Examplecollapse2">
																			View Visits
																		</button>
																	</h2>
																	<div id="accor_nesting6Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting6Example2" data-bs-parent="#accordionnesting6">
																		<div class="accordion-body">
																			<div class="purchase-history">
																				<div class="table-responsive">
																					<table class="table mb-0">
																						<thead>
																							<tr>
																								<th>Date</th>
																								<th>Time</th>
																								<th>Program Name </th>
																								<th>Program Title </th>
																								<th>Status</th>
																								<th>Instructor</th>
																							</tr>
																						</thead>
																						<tbody>
																							<tr>
																								<td> 04/11/2023 </td>
																								<td>07:00 PM </td>
																								<td>Beach Volleyball BIRMINGHAM</td>
																								<td>Beach vollybal session</td>
																								<td><a target="_blank" href="http://dev.fitnessity.co/business/437/schedulers/1136/checkin_details?date=2023-04-11">Unprocess</a></td>
																								<td>george smith</td>
																							</tr>
																							<tr>
																								<td> 03/22/2023 </td>
																								<td> 07:00 PM  </td>
																								<td>Beach Volleyball BIRMINGHAM</td>
																								<td>Beach vollybal session</td>
																								<td><a target="_blank" href="http://dev.fitnessity.co/business/437/schedulers/1136/checkin_details?date=2023-04-11">Unprocess</a></td>
																								<td>george smith</td>
																							</tr>
																						</tbody>
																					</table>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																
																<div class="accordion-item shadow">
																	<h2 class="accordion-header" id="accordionnesting9Example2">
																		<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting9Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting9Examplecollapse2">
																			<div class="container-fluid nopadding">
                                                                                <div class="row ">
                                                                                    <div class="col-lg-6 col-md-6 col-8">
                                                                                        Credit Card Info
                                                                                    </div>
                                                                                    <div class="col-lg-6 col-md-6 col-4">
                                                                                        <div class="multiple-options">
                                                                                            <div class="setting-icon">
                                                                                                <i class="ri-more-fill"></i>
                                                                                                <ul>
																									<li>
																										<a href="#" data-bs-toggle="modal" data-bs-target=".card-add"><i class="fas fa-plus text-muted"></i>Add</a>
																									</li>
                                                                                                </ul>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
																		</button>
																	</h2>
																	<div id="accor_nesting9Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting9Example2" data-bs-parent="#accordionnesting9">
																		<div class="accordion-body">
																			<div class="mini-stats-wid d-flex align-items-center mt-3 scheduler-box">
																				<div class="flex-grow-1">
																					<div class="mb-10">
																						<p class="text-muted card-details mb-0">discover **** **** **** 9424 </p>
																					</div>
																				</div>
																																							
																				<div class="flex-grow-1 ms-3">
																					<div class="priceoptionsettings">
																						<div class="setting-icon">
																							<i class="ri-more-fill"></i>
																							<ul>
																								<li>
																									<a href="#"><i class="fas fa-plus text-muted"></i>Edit</a>
																								</li>
																								<li class="dropdown-divider"></li>
																								<li>
																									<a href="#">
																										<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete
																									</a>
																								</li>
																							</ul>
																						</div>
																					</div>
																					
																				</div>
																				
																			</div>
																			<!--<div class="mini-stats-wid d-flex align-items-center mt-3 cardinfo">
																				<div class="container-fluid nopadding">
																					<div class="row">
																						<div class="col-lg-8 col-md-7 col-sm-6">
																							<div class="mb-10">
																								<p class="text-muted card-details mb-0">discover **** **** **** 9424 </p>
																							</div>
																						</div>
																						<div class="col-lg-2 col-md-2 col-sm-3">
																							<a href="#" class="btn btn-red width-100 mmb-10" data-bs-toggle="modal" data-bs-target=".card-add">Add</a>
																						</div>
																						<div class="col-lg-2 col-md-3 col-sm-3">
																							<a class="btn btn-black width-100 delCard mmb-10" data-behavior="delete_card" data-url="http://dev.fitnessity.co/stripe_payment_methods/pm_1Mp75eCr65ASmcsqyf0jFa9R" data-cardid="89" title="Delete Card"> Remove</a>
																						</div>
																					</div>
																				</div>
																			</div>-->
																		</div>
																	</div>
																</div>
																
																<div class="accordion-item shadow">
																	<h2 class="accordion-header" id="accordionnesting10Example2">
																		<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting10Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting10Examplecollapse2">
																			Customer Notes & Alerts
																		</button>
																	</h2>
																	<div id="accor_nesting10Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting10Example2" data-bs-parent="#accordionnesting10">
																		<div class="accordion-body">
																			<div class="container-fluid nopadding">
																				<div class="row">
																					<div class="col-lg-12">
																						<textarea class="form-control mb-10" name="notes" rows="4"> </textarea>
																					</div>
																					<div class="col-lg-12">
																						<button type="submit" class="btn btn-red float-end">Submit</button>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																
																<div class="accordion-item shadow">
																	<h2 class="accordion-header" id="accordionnesting11Example2">
																		<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting11Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting11Examplecollapse2">
																			Agreed on Terms, Contracts, & Liability Waiver
																		</button>
																	</h2>
																	<div id="accor_nesting11Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting11Example2" data-bs-parent="#accordionnesting11">
																		<div class="accordion-body">
																			<div class="mini-stats-wid d-flex align-items-center mt-3 cardinfo">
																				<div class="container-fluid nopadding">
																					<div class="row">
																						<div class="col-lg-10 col-md-10 col-sm-10">
																							<div class="row">
																								<div class="col-lg-12 col-md-12">
																									<span>1.</span>
																									<span>Covid-19 Protocols agreed on   06/06/2023  </span>
																								</div>
																								<div class="col-lg-12 col-md-12">
																									<span> 2. </span>
																									<span>Liability Waiver agreed on  </span>
																								</div>
																								<div class="col-lg-12 col-md-12 mb-10">
																									<span>3. </span>
																									<span>Contract Terms  agreed on </span>
																								</div>
																							</div>
																						</div>
																						<div class="col-lg-2 col-md-2 col-sm-2">
																							<div class="row">
																								<div class="col-lg-12 col-md-12 col-sm-12">
																									<a href="#" class="btn btn-red float-end mmb-10" data-bs-toggle="modal" data-bs-target=".terms">Edit</a>
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
												<!--<div class="accordion-item shadow">
													<h2 class="accordion-header" id="accordionnestingExample2">
														<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse2" aria-expanded="false" aria-controls="accor_nestingExamplecollapse2">
															Customer Info
														</button>
													</h2>
													<div id="accor_nestingExamplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample2" data-bs-parent="#accordionnesting">
														<div class="accordion-body">
															
															<div class="accordion nesting3-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting3">
																<div class="accordion-item shadow mt-2">
																	<h2 class="accordion-header" id="accordionnesting3Example2">
																		<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting3Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting3Examplecollapse2">
																			Details
																		</button>
																	</h2>
																	<div id="accor_nesting3Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting3Example2" data-bs-parent="#accordionnesting3">
																		<div class="accordion-body">
																			Coming soon
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
															Visits
														</button>
													</h2>
													<div id="accor_nestingExamplecollapse3" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample3" data-bs-parent="#accordionnesting">
														<div class="accordion-body">
															Coming soon
														</div>
													</div>
												</div>-->
											</div>
										</div>
									</div><!-- end card-body -->
								</div><!-- end card -->
							</div>
							<!--end col-->
						</div>
						<!--end row-->
						
					</div> <!-- end .h-100-->
                  </div> <!-- end col -->
                </div>
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->

<!-- Modal -->
<div class="modal fade" id="check-in-code" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add/Edit</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="form-group mt-10">
					<label for="email">Self Check-In Code</label>
					<input type="text" class="form-control" name="companyName">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-red">Submit</button>
			</div>
		</div>
  	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="merge_customer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered modal-40">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Merge Customer</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form class="app-search d-md-block">
                    <div class="position-relative mb-25">
                        <input type="text" class="form-control" placeholder="Enter customer name or email" autocomplete="off" id="search-options" value="">
                        <span class="mdi mdi-magnify search-widget-icon"></span>
                        <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
                    </div>
                    <!--<div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
                    
                        <div class="text-center pt-3 pb-1">
                            <a href="pages-search-results.html" class="btn btn-primary btn-sm">View All Results <i class="ri-arrow-right-line ms-1"></i></a>
                        </div>
                    </div> -->
                </form>
				<p>Select a customer below to merge this customer to. <span class="font-red">Note:</span> This cannot be undone once merged. All bookings and payments will transfer over to the selected customer below.  </p>
				<a href="">
					<div class="row y-middle">
						<div class="col-sm-auto col-auto">
							<div class="flex-shrink-0 avatar-sm ">
								<span class="marge-customer-f-text avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">A</span>
							</div>
						</div>
						<div class="col-lg-9 col-auto">
							<h6 class="mb-1">Darryl Phipps</h6>
							<p class="text-muted mb-0"> <strong>Email: </strong> darrylphipps@gmail.com </p>
						</div>
					</div>
				</a>				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-red">Merge Customers</button>
			</div>
		</div>
  	</div>
</div>


<div class="modal fade view-visit" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-70">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Activity Scheduler</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="scheduler-table">
					<div class="table-responsive">
						<table class="table mb-0">
							<thead>
								<tr>
									<th>Date</th>
									<th>Time</th>
									<th>Program Name </th>
									<th>Program Title </th>
									<th>Status</th>
									<th>Instructor</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><p class="mb-0">03/22/2023</p></td>
									<td><p class="mb-0">11:00 AM</p></td>
									<td><p class="mb-0">Beach Volleyball BIRMINGHAM</p></td>
									<td><p class="mb-0">Beach vollybal session</p></td>
									<td><p class="mb-0"></p></td>
									<td><p class="mb-0">george smith</p></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade edit-details" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-100">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Edit Details</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="red-separator mb-10">
					<div class="container-fluid nopadding">
						<div class="row">	
							<div class="col-lg-6 col-md-6">
								<div class="modal-sub-title">
									<h4>Edit info for membership Beach Volleyball BIRMINGHAM</h4>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="modal-side-title">
									<h4> Membership Status: 
										<span class="font-green"> Active </span> 
									</h4>
								</div>
							</div>
						</div> 
						
					</div>
				</div>
				<div class="container-fluid nopadding">
					<div class="row">
						<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 ">
							<div class="title-sp-customer">
								<h4 class="edit-booking-title">Current Booking Details</h4>
								<p class="text-center">Review the membership details before any changes</p>
							</div>
							<div class="side-border-right">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="remaining-total">
											<label>Total Remaining</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="remaining-number">
											<span>10000/10000</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Booking # </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer line-break">
											<span>FS_20230322024956862 </span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Program Name: </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span> Beach Volleyball BIRMINGHAM</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Catagory: </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>Beach vollybal session</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Price Option:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>Beach vollybal session</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Number of Sessions:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>10000</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Membership Option:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>Drop In</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Participant Quantity:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>Adult x 1 </span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Who's Participating:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>
											<span>
										</span></span></div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Activity Type:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>Beach Vollyball</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Service Type:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>individual</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Membership Duration:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>9 month 29 day</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Purchase Date:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>03/22/2023</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Membership Activation Date: </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>03/22/2023</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Membership Expiration: </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>01/20/2024</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer tip-xp">
											<label>Tip Amount: </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer tip-xp">
											<span>$0</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Discount: </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>$0</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Tax:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>$0</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="remaining-total tip-xp">
											<label>Total Amount Paid </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="remaining-number tip-xp">
											<span>$-0.11</span>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 nopadding">
							<div class="title-middle-part">
								<h4 class="edit-booking-title">Edit Section </h4>
								<p class="text-center">Use this section to edit the membership details you need below</p>
							</div>
							<div class="side-border-right">
								<div class="row">
									<div class="col-md-12 col-xs-12 col-sm-12">
										<div class="bottom-border-sparetor sessions-no">
											<label>Number of sessions</label>
											<input class="form-control" type="text" id="editSession" name="editSession" placeholder="20" value="10000">
										</div>
									</div>
									<div class="col-md-12 col-xs-12 col-sm-12">
										<div class="activation-date">
											<label>Membership Activation Date</label>
											<div class="date-activity-check">
												<div class="input-group">
													<input type="text" class="form-control border-0 dash-filter-picker width-flatpiker flatpickr-range flatpiker-with-border flatpickr-input active" data-range-date="false" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022" readonly="readonly">
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-12 col-xs-12 col-sm-12">
										<div class="membership-duration">
											<label>Membership Expiration</label>
										</div>
										<div class="input-group">
											<input type="text" class="form-control border-0 dash-filter-picker width-flatpiker flatpickr-range flatpiker-with-border flatpickr-input active" data-range-date="false" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022" readonly="readonly">
										</div>
										<button type="button" class="btn btn-red membership-save float-end" id="" data-behavior="update_order_detail" data-booking-detail-id="775" data-booking-id="884" data-customer-id="284">Save </button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
							<div class="title-sp-customer">
								<h4 class="edit-booking-title">Updated Sections </h4>
								<p class="text-center">Review the changes below. Changes are listed in red</p>
							</div>
							<div class="">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<label>Total Remaining</label>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="remaining-number">
											<span id="span_remaining_session">10000/10000</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Booking # </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer line-break">
											<span>FS_20230322024956862</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Program Name: </label>
										</div>
									</div> 
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>Beach Volleyball BIRMINGHAM</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Catagory: </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>Beach vollybal session</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Price Option:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>Beach vollybal session</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Number of Sessions:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span id="editsession_span">10000</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Membership Option:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>Drop In</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Participant Quantity:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>Adult x 1</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Who's Participating:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span></span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Activity Type:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>Beach Vollyball</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Service Type:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>individual</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Membership Duration:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span id="span_membership_duration"></span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Purchase Date:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>03/22/2023</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Membership Activation Date: </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span id="span_membership_activation" class="red-fonts">03/23/2023</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Membership Expiration: </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span id="span_membership_expiration">01/20/2024</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer tip-xp">
											<label>Tip Amount: </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer tip-xp">
											<span>$0</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Discount: </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>$0</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Tax:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>$0</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="tip-xp">
											<label>Total Amount Paid </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="remaining-number tip-xp">
											<span>$-0.11</span>
										</div>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade void" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-100">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Void or Refund </h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="red-separator mb-10">
					<div class="container-fluid nopadding">
						<div class="row">	
							<div class="col-lg-6 col-md-6">
								<div class="modal-sub-title">
									<h4>Edit info for membership Beach Volleyball BIRMINGHAM</h4>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="modal-side-title">
									<h4> Membership Status: 
										<span class="font-green"> Active </span> 
									</h4>
								</div>
							</div>
						</div> 
					</div>
				</div>
				
				<div class="container-fluid nopadding">
					<div class="row">
						<div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
							<div class="title-sp-customer">
								<h4 class="edit-booking-title">Current Booking Details</h4>
								<p class="text-center">Review the membership details before any changes</p>
							</div>
							<div class="side-border-right">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="remaining-total">
											<label>Total Remaining</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="remaining-number">
											<span>10000/10000</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Booking # </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer line-break">
											<span>FS_20230322024956862 </span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Program Name: </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>Beach Volleyball BIRMINGHAM</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Catagory: </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>Beach vollybal session</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Price Option:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>Beach vollybal session</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Number of Sessions:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>10000</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Membership Option:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>Drop In</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Participant Quantity:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>Adult x 1</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Who's Participating:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span></span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Membership Duration:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span></span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Purchase Date:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>03/22/2023</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Membership Activation Date: </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>03/22/2023</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Membership Expiration: </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>01/20/2024</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer tip-xp">
											<label>Tip Amount: </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer tip-xp">
											<span>$0</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Discount: </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>$0</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Tax:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>$0</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="remaining-total tip-xp mt-150">
											<label>Total Amount Paid </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="remaining-number tip-xp mt-150">
											<span>$-0.11</span>
										</div>
									</div>
									
								</div>
							</div>
						</div>
						<div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 nopadding">
							<div class="title-sp-customer">
								<h4 class="edit-booking-title">Edit Section </h4>
								<p class="text-center">Use this section to edit the membership details you need below</p>
							</div>
							<div class="radio-text">
								<form action="">
								<input type="radio" id="void" name="fav_language" value="void">
								&nbsp; <label for="void">Void This Sale (Made a booking mistake? Training or testing a sale? You can void this membership.)</label>
								</form>
							</div>
							<div class="void-box">
								<div class="void-transaction">
									<p>Voiding this transaction will delete this record from your system, You will not be able to undo this once you agree to void.</p>
									<button type="button" class="btn btn-red" id="" data-behavior="destroy_order_detail" data-booking-detail-id="775" data-booking-id="884" data-customer-id="284">Yes, Void This Sale</button>
								</div>
							</div>
							<div class="row">
								<div class="col-md-5 col-sm-5 col-xs-5 col-5">
									<div class="red-separator mt-7"></div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2 col-2 text-center">
									<label> OR </label>
								</div>
								<div class="col-md-5 col-sm-5 col-xs-5 col-5">
									<div class="red-separator mt-7"></div>
								</div>
							</div>
													
							<div class="radio-text">
								<form action="">
								<input type="radio" id="refund" name="fav_language" value="refund">
								&nbsp; <label for="void">Issue a Refund</label>
								</form>
							</div>
							<div class="refund-details"> 
								<label>Total Amount Paid: </label>
								<span> $10.39 (Original payment method: TBD) </span>
							</div>
							<div class="refund-details refund-date"> 
								<label>Refund Issue Date: </label>
									<input type="text" class="form-control border-0 dash-filter-picker flatpickr-range flatpiker-with-border flatpickr-input active" data-range-date="false" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022" readonly="readonly">
						
							</div>
							<div class="refund-details refund-amount"> 
								<label>Refund Amount:  </label>
								<input class="form-control" type="text" id="refund_amount" name="refund_amount" placeholder="20" value="">
								<h4>(Refund amount can’t be greater than the total amount paid)</h4>
							</div>
							<div class="refund-details refund-method"> 
								<label>Refund Method: </label>
								<textarea class="form-control" rows="2" name="refund_method" id="refund_method" placeholder="Refund Method" maxlength="500"></textarea>
							</div>
							<div class="refund-details text-center">
								<textarea class="form-control" rows="2" name="refund_reason" id="refund_reason" placeholder="Leave a note for the reason of the refund" maxlength="500"></textarea>
								<button type="button" class="btn btn-red mt-10 float-end" id="" data-behavior="refund_order_detail" data-booking-detail-id="775" data-booking-id="884" data-customer-id="284">Issue The Refund</button>
							</div>
							
						</div>
						
					</div>
				</div>
				
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade suspend" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-100">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Suspend or Terminate</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="red-separator mb-10">
					<div class="container-fluid nopadding">
						<div class="row">	
							<div class="col-lg-6 col-md-6">
								<div class="modal-sub-title">
									<h4>Edit info for membership Beach Volleyball BIRMINGHAM</h4>
								</div>
							</div>
							<div class="col-lg-6 col-md-6">
								<div class="modal-side-title">
									<h4> Membership Status: 
										<span class="font-green"> Active </span> 
									</h4>
								</div>
							</div>
						</div> 
					</div>
				</div>
				
				<div class="container-fluid nopadding">
					<div class="row">
						<div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
							<div class="title-sp-customer">
								<h4 class="edit-booking-title">Current Booking Details</h4>
								<p class="text-center">Review the membership details before any changes</p>
							</div>
							<div class="side-border-right">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="remaining-total">
											<label>Total Remaining</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="remaining-number">
											<span>10000/10000</span>
										</div>
									</div>
									 
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Booking # </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>FS_20230322024956862 </span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Program Name: </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span> Beach Volleyball BIRMINGHAM</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Catagory: </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>Beach vollybal session</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Price Option:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>Beach vollybal session</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Number of Sessions:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>10000</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Membership Option:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>Drop In</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Participant Quantity:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>Adult x 1</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Who's Participating:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span></span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Activity Type:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>Beach Vollyball</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Service Type:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>individual</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Membership Duration:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span></span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Purchase Date:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>03/22/2023</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Membership Activation Date: </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>03/22/2023</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Membership Expiration: </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>01/20/2024</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer tip-xp">
											<label>Tip Amount: </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer tip-xp">
											<span>$0</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Discount: </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>$0</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<label>Tax:</label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="sub-info-customer">
											<span>$0</span>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="remaining-total tip-xp">
											<label>Total Amount Paid </label>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
										<div class="remaining-number tip-xp">
											<span>$-0.11</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 nopadding">
							<div class="title-sp-customer">
								<h4 class="edit-booking-title">Edit Section </h4>
								<p class="text-center">Use this section to edit the membership details you need below</p>
							</div>
							<div class="radio-text">
								<form action="">
								<input type="radio" id="suspend" name="fav_language" value="suspend">
								&nbsp; <label for="void">Suspend/Freeze (Seeting a membership or contract suspension will freeze this membership for a duration of time.)</label>
								</form>
							</div>
							<div class="refund-details refund-method"> 
								<label>Reason for Suspension: </label>
								<textarea class="form-control" rows="2" name="suspension_reason" id="suspension_reason" placeholder="Leave a note for the reason of the refund" maxlength="500"></textarea>
							</div>
							<div class="row">
								<div class="col-lg-6 col-sm-6 col-md-6">
									<div class="refund-details refund-method">
										<label>Suspension Start Date: </label>
										<div class="input-group">
											<input type="text" class="form-control border-0 dash-filter-picker flatpickr-range flatpiker-with-border" data-range-date="false" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6">
									<div class="refund-details refund-method">
										<label>Suspension End Date:</label>
										<div class="input-group">
											<input type="text" class="form-control border-0 dash-filter-picker flatpickr-range flatpiker-with-border" data-range-date="false" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
										</div>
									</div>
								</div>
								<div class="col-lg-6  col-md-6 col-sm-6">
									<div class="refund-details mb-10"> 
										<label>Suspension Fee: </label>
										<input class="form-control" type="text" id="suspension_fee" name="suspension_fee" placeholder="$" value="">
									</div>
								</div>
								<div class="col-lg-6 col-sm-6 col-md-6">
									<div class="refundcomment">
										<label>Leave a comment:</label>
										<textarea class="form-control" rows="1" name="suspension_comment" id="suspension_comment" placeholder="Leave a note for the reason of the refund" maxlength="500"></textarea>
									</div>
								</div>
								<div class="col-lg-12 col-xs-12">
									<button type="button" class="btn btn-red float-end" id="" data-behavior="suspend_order_detail" data-booking-detail-id="775" data-booking-id="884" data-customer-id="284">Suspend/Freeze</button>
								</div>
							</div>
							<div class="row">
								<div class="col-md-5 col-sm-5 col-xs-5 col-5">
									<div class="red-separator mt-7"></div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2 col-2 text-center">
									<label> OR </label>
								</div>
								<div class="col-md-5 col-sm-5 col-xs-5 col-5">
									<div class="red-separator mt-7"></div>
								</div>
							</div>
							
							<div class="radio-text">
								<form action="">
								<input type="radio" id="termination" name="fav_language" value="termination">
								&nbsp; <label for="void">Terminate/Cancel (Terminate/Cancel this membership)	  </label>
								</form>
							</div>
							<div class="refund-details refund-method mb-10"> 
								<label>Reason for Termination:  </label>
								<textarea class="form-control" rows="2" name="terminate_reason" id="terminate_reason" placeholder="Leave a note for the reason of the refund" maxlength="500"></textarea>
							</div>
							
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<label>Termination  Date:</label>
									<div class="input-group">
										<input type="text" class="form-control border-0 dash-filter-picker flatpickr-range flatpiker-with-border" data-range-date="false" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="mb-10"> 
										<label>Termination Fee: </label>
										<input class="form-control" type="text" id="terminate_fee" name="terminate_fee" placeholder="$" value="">
									</div>
								</div>
							</div>
														
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="refundcomment">
										<label>Leave a comment:</label>
										<textarea class="form-control" rows="2" name="terminate_comment" id="terminate_comment" placeholder="Leave a note for the reason of the refund" maxlength="500"></textarea>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="refundcomment refund-note">
										<p>By clicking terminate, you will be removing all remaining contract &amp; membership agreements, payment agreements &amp; scheduled recurring payments. </p>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
				
			</div>
			<div class="modal-footer">
                 <div class="fonts-red" id="addinserro"> </div>
                 <button type="submit" class="btn btn-red float-end" id="" data-behavior="terminate_order_detail" data-booking-detail-id="775" data-booking-id="884" data-customer-id="284">Terminate</button>
            </div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade card-add" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-50">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Card</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form id="payment-form" data-secret="seti_1NFyBYCr65ASmcsqZ3Z2ggcu_secret_O22GPYDcAQ37Y8PlRITikuUb08f3tca" style="padding: 16px;margin-bottom: 0px;">

				  <div id="error-message" class="alert alert-danger" role="alert" style="display: none;"></div>
				  <div id="payment-element" style="margin-top: 8px;" class="StripeElement"><div class="__PrivateStripeElement" style="margin: -4px 0px !important; padding: 0px !important; border: medium none !important; display: block !important; background: transparent !important; position: relative !important; opacity: 1 !important; clear: both !important; transition: height 0.35s ease 0s !important;"><iframe name="__privateStripeFrame38117" allowtransparency="true" scrolling="no" role="presentation" src="https://js.stripe.com/v3/elements-inner-payment-916b422e3867ec80e55523cbfd7e1d62.html#wait=false&amp;rtl=false&amp;componentName=payment&amp;keyMode=test&amp;apiKey=pk_test_OsczNDatguPzxcYVHzTfC2Bv009RQc4cYp&amp;referrer=http%3A%2F%2Fdev.fitnessity.co%2Fbusiness%2F437%2Fcustomers%2F284&amp;controllerId=__privateStripeController38112" title="Secure payment input frame" style="border: medium none !important; margin: -4px; padding: 0px !important; width: calc(100% + 8px); min-width: 100% !important; overflow: hidden !important; display: block !important; user-select: none !important; transform: translate(0px) !important; color-scheme: light only !important; height: 306.55px; opacity: 1; transition: height 0.35s ease 0s, opacity 0.4s ease 0.1s;" frameborder="0"></iframe></div></div>
				  
				  <button class="btn btn-red" type="submit" id="submit">Add on file</button>

				  
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->	

<div class="modal fade terms" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-50">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Edit Terms of Service</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="modal-checkbox mb-15">
							<label>Covid-19 Protocols</label>
							<div class="modal-terms-wrap">
								<input type="checkbox" id="terms_covid" name="terms_covid" value="1" checked="">
								<p> The provider(s) require that you agree to Covid-19 Protocols. </p>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="modal-checkbox mb-15">
							<label>Liability Waiver</label>
							<div class="modal-terms-wrap">
								<input type="checkbox" id="terms_liability" name="terms_liability" value="1">
								<p> The provider(s) require that you agree to Liability Waiver.</p>
							</div>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="modal-checkbox mb-15">
							<label>Contract Terms</label>
							<div class="modal-terms-wrap">
								<input type="checkbox" id="terms_contract" name="terms_contract" value="1">
								<p>The provider(s) require that you agree to Contract Terms.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary btn-red">Submit</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->	
	
<div class="modal fade autopay-schedule" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-100">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Autopay Schedule </h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="container-fuild">
					<div class="row">
						<div class="col-lg-12">
							<label>Auopay Schedule For:</label>
							<span>Nipa Soni </span>
						</div>
						<div class="col-lg-5">
							<div>
								<label>Contract Details:</label>
								<span>sleep away camp , 1 Day camp</span>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="auto-details-location float-end">
								<label>Location:</label>
								<span>Fitness Pvt. Ltd.</span>
								
								<label> Autopay Remaining</label>
								<span>10/12 </span>
								
								<label>Autopay History</label>
								<a href="#"> View </a>
							</div>
						</div>
					</div>
				</div>
				<div class="scheduler-table">
					<div class="table-responsive">
						<table class="table mb-0">
							<thead>
								<tr>
									<th>No</th>
									<th>Payment Date </th>
									<th>Amount</th>
									<th>Tax </th>
									<th>Charged Amount </th>
									<th>Payment Method </th>
									<th>Status </th>
									<th><input type="checkbox" class="checkAll"> Check All  | Uncheck All </th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>
										<div class="input-group">
											<input type="text" class="form-control border-0 dash-filter-picker flatpickr-from0 flatpiker-with-border flatpickr-input flatpickr-range active" value="06/05/2023" id="from0" name="frm_servicestart[]" placeholder="From" readonly="readonly">
										</div>
									</td>
									<td>
										<div class="auto-amount">
											<label>$</label>
											<input type="text" class="form-control valid" name="amount" id="amount1" placeholder="0" value="50">
										</div>
									</td>
									<td>$8.875</td>
									<td> $0 </td>
									<td></td>
									<td>Scheduled</td>
									<td><input type="checkbox" id="chkbox1" name="chkbox[]" class="custom_chkbox" value="1"></td>
									<td>
										<button id="submit" type="button" class="btn btn-red" data-behavior="updateAutoPay" data-recurring-id="1">Save</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade autopay-history" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-80">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Autopay history</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="container-fuild">
					<div class="row">
						<div class="col-lg-12">
							<label>Auopay Schedule For:</label>
							<span>Nipa Soni </span>
						</div>
						<div class="col-lg-5">
							<div>
								<label>Contract Details:</label>
								<span>sleep away camp , 1 Day camp</span>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="auto-details-location float-end">
								<label>Location:</label>
								<span>Fitness Pvt. Ltd.</span>
								
								<label> Autopay Remaining</label>
								<span>10/12 </span>
								
								<label>Autopay History</label>
								<a href="#"> View </a>
							</div>
						</div>
					</div>
				</div>
				<div class="scheduler-table">
					<div class="table-responsive">
						<table class="table mb-0">
							<thead>
								<tr>
									<th>Payment Date </th>
									<th>Amount</th>
									<th>Tax </th>
									<th>Charged Amount </th>
									<th>Payment Method </th>
									<th>Status </th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>03/01/2023</td>
									<td>50</td>
									<td>$8.875</td>
									<td>$83.6 </td>
									<td>visa XXXX4242 </td>
									<td>Completed</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
	
	
	@include('layouts.business.footer')
	<script>
		flatpickr(".flatpickr-range", {
	        dateFormat: "m/d/Y",
	        maxDate: "01/01/2050",
			defaultDate: [new Date()],
	     });
	</script>

@endsection