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
						<div class="row">
							<div class="col-lg-12">
								<div class="float-right">
									<div class="search-set">
										<form class="client-search">
											<div class="position-relative">
												<input type="text" class="form-control" placeholder="Search for client" autocomplete="off" id="search-options" value="">
												<span class="mdi mdi-magnify search-widget-icon"></span>
												<span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
											</div>
											<div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
												
											</div>
										</form>
									</div>
									<div class="btn-client-search">
										<button type="button" class="btn-red-primary btn-red mmt-10" id="">Search </button>
									</div>
								</div>
							</div>
						</div>
                        <div class="row mb-3">
							<div class="col-6">
								<div class="page-heading">
									<label>Activity Scheduler </label>
								</div>
							</div>
							<div class="col-6">
								<div class="service-create">
									<input type="submit" class="btn btn-red" data-bs-toggle="modal" data-bs-target=".new-client-steps" value="Add New Client">
									<div class="modal fade new-client-steps" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered modal-80">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body body-tbm">
													<div class="row">
														<div class="col-lg-6 col-md-6 col-sm-6 space-remover ">
															<div class="manage-customer-modal-title">
																<h4>Add A New Client Manually</h4> <h3>- Or -</h3>
															</div>
															<div class="manage-customer-from">
																<div id="divstep1" style="display: block;">
																	<form id="frmregister" method="post">
																		<h4 class="heading-step">Step 1</h4>
																		<div id="systemMessage" class="alert-msgs"></div>
																		<input type="hidden" name="_token">
																		<input type="hidden" name="business_id" value="68">
																		<input type="text" name="firstname" id="firstname" size="30" maxlength="80" placeholder="First Name">
																		<input type="text" name="lastname" id="lastname" size="30" maxlength="80" placeholder="Last Name">
																		<input type="text" name="username" id="username" size="30" maxlength="80" placeholder="Username" autocomplete="off">
																		<input type="email" name="email" id="email" class="myemail" size="30" placeholder="Email-Address" maxlength="80" autocomplete="off">
																		<input type="text" name="contact" id="contact" size="30" maxlength="14" autocomplete="off" placeholder="Phone" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
																		<input type="text" class="form-control border-0 dash-filter-picker flatpiker-with-border flatpickr-range-birthdate" data-range-date="false" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
																		
																		<div class="row check-txt-center">
																			<div class="col-lg-8 col-md-12 col-9">
																				<div class="terms-wrap wrap-sp">
																					<input type="checkbox" name="b_trm1" id="b_trm1" class="form-check-input" value="1">
																					<label for="b_trm1" class="modalregister-private">I agree to Fitnessity <a href="/terms-condition" target="_blank">Terms of Service</a> and <a href="/privacy-policy" target="_blank">Privacy Policy</a></label>
																				</div>
																				<div id="termserror"></div><br>
																				<button type="button" style="margin-bottom: 10px;" class="signup-new btn-red" id="register_submit" onclick="$('#frmregister').submit();">Continue</button><br>
																			</div>
																		</div>	
																	</form>
																</div>
																
																<div id="divstep2" style="display: none;">
																	<form action="#">
																		<div class="sign-step_2">
																			<div class="filledstep-bar">
																				<div class="row">
																					<div class="col-sm-12">
																						<span class="filledstep"></span>
																						<span class=""></span>
																						<span class=""></span>
																						<span class=""></span>
																					</div>
																				</div>
																			</div>
																			<div class="row">
																				<div class="col-sm-12">
																					<div class="error" id="systemMessage"></div>
																					<div class="prfle-wrap">
																						<img src="" alt="">
																						N
																					</div>
																					<div class="reg-email-step2">nipavadhavana@gmail.com</div>
																					<h2>Welcome to Fitnessity</h2>
																					<div class="reg-title-step2"><input type="text" name="" id="" value="@nipa" readonly=""></div>
																					<p>Your answer to the next few question will help us find the right ideas for you</p>
																					<div class="signup-step-btn">
																						<button type="button" class="signup-new btn-red" id="step2_next">Next</button>
																					</div>
																				</div>
																			</div>
																		</div>
																	</form>
																</div>
																
																<div id="divstep3" style="display: none;">
																	<form action="#">
																		<h4 class="heading-step">Step 2</h4>
																		<input type="hidden" name="cust_id" id="cust_id" value="">
																		<div class="sign-step_3">
																			<div class="filledstep-bar">
																				<div class="row">
																					<div class="col-sm-12">
																						<span class="filledstep"></span>
																						<span class="filledstep"></span>
																						<span></span>
																						<span></span>
																					</div>
																				</div>
																			</div>
																			<div class="row">
																				<div class="col-sm-12">
																					<h2>How do you Identify?</h2>
																					<div class="error" id="systemMessage"></div>
																					<div class="form-group">
																						<span class="error" id="err_gender"></span>
																						<div class="radio">
																							<label for="male">Male<input type="radio" name="gender" id="male" value="male" class=""><span class="checkmark"></span></label>
																						</div>
																						<div class="radio">
																							<label for="female">Female<input type="radio" name="gender" id="female" value="female" class=""><span class="checkmark"></span></label>
																						</div>
																						<div class="radio">
																							<label for="other">Specify another<input type="radio" name="gender" id="other" value="other" class=""><span class="checkmark"></span></label>
																							<input class="border-none" type="text" name="othergender" id="othergender">
																						</div>
																					</div>
																					<div class="signup-step-btn">
																						<button type="button" class="signup-new btn-red" id="step3_next">Next</button>
																					</div>
																				</div>
																			</div>
																		</div>
																	</form>
																</div>
																
																<div id="divstep4" style="display: none;">
																	<form action="#">
																		<h4 class="heading-step">Step 3</h4>
																		<div class="sign-step_4">
																			<div class="filledstep-bar">
																				<div class="row">
																					<div class="col-sm-12">
																						<span class="filledstep"></span>
																						<span class="filledstep"></span>
																						<span class="filledstep"></span>
																						<span></span>
																					</div>
																				</div>
																			</div>
																			<div class="row">
																				<div class="col-sm-12">
																					<ul class="">
																						<li><i class="fa fa-check"></i><span>Registration Information</span></li>
																						<li><i class="fa fa-check"></i><span>Your Identification</span></li>
																					</ul>
																					<ul class="nav nav-tabs nav-stacked">
																						<li class="active"><a data-bs-toggle="tab" data-bs-target="#add_personel_info" role="tab" aria-controls="add_personel_info" aria-selected="true"><span class="stp-numbr">3</span> <span>Add Personal Information</span></a></li>
																						<li><a data-bs-toggle="tab" data-bs-target="#adding_photo" role="tab" aria-controls="adding_photo" aria-selected="false"><span class="stp-numbr">4</span> <span>Adding Photo</span></a></li>
																						<li><a data-bs-toggle="tab" data-bs-target="#" role="tab" aria-controls=""><span class="stp-numbr" aria-selected="false">5</span> <span>Adding Family Member</span></a></li>
																					</ul>
																					
																					<div class="tab-content">
																						<div id="add_personel_info" class="tab-pane fade show active manage-customer-from-step-two">
																							<div class="error" id="systemMessage"></div>
																							<div class="form-group">
																								<input type="text" class="form-control" autocomplete="nope" name="Address" id="b_address" placeholder="Address" value="">
																								<span class="error" id="err_address_sign"></span>
																							</div>
																							<div id="map" style="display: none;"></div>
																							<input type="hidden" name="lon" id="lon" value="">
																							<input type="hidden" name="lat" id="lat" value="">
																							<div class="form-group">
																								<input type="text" class="form-control" name="Country" id="b_country" size="30" placeholder="Country" value="" maxlength="20">
																								<span class="error" id="err_country_sign"></span>
																							</div>
																							<div class="form-group">
																								<input type="text" class="form-control" name="City" id="b_city" size="30" placeholder="City" maxlength="50" value="">
																								<span class="error" id="err_city_sign"></span>
																							</div>
																							<div class="form-group">
																								<input type="text" class="form-control" name="State" id="b_state" size="30" placeholder="State" maxlength="50" value="">
																								<span class="error" id="err_state_sign"></span>
																							</div>
																							<div class="form-group">
																								<input type="text" class="form-control" name="ZipCode" id="b_zipcode" size="30" placeholder="Zip Code" value="" maxlength="20">
																								<span class="error" id="err_zipcode_sign"></span>
																							</div>
																							<div class="signup-step-btn">
																								<button type="button" class="signup-new btn-red" id="step4_next">Next</button>
																							</div>
																						</div>
																						<div id="adding_photo" class="tab-pane fade">
																							<div class="upload-wrp-content">
																								<p><b>Put a face to the name </b>and improve your adds to networking success.</p>
																								<p>People prefer to network with members who has a profile photo, but if don't have one ready to upload, you can add it later.</p>
																							</div>
																							<div class="">
																								<div class="upload-img">
																									<input type="file" name="file_upload" id="file" onchange="">
																									<div class="upload-img-msg">
																										<p>Touble uploading profile photo?</p>
																									</div>
																								</div>
																							</div>
																							<div class="signup-step-btn">
																								<button type="button" class="signup-new btn-red" id="fileimgnext">Upload</button>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</form>
																</div>
																
																<div id="divstep5" style="display: none;">
																	<form action="#" enctype="multipart/form-data" id="myformprofile">
																		<h4 class="heading-step">Step 4</h4>
																		<div class="sign-step_4">
																			<div class="filledstep-bar">
																				<div class="row">
																					<div class="col-sm-12">
																						<span class="filledstep"></span>
																						<span class="filledstep"></span>
																						<span class="filledstep"></span>
																						<span></span>
																					</div>
																				</div>
																			</div>
																			<div class="row">
																				<div class="col-sm-12">
																					<ul class="">
																						<li><i class="fa fa-check"></i><span>Registration Information</span></li>
																						<li><i class="fa fa-check"></i><span>Your Identification</span></li>
																						<li><i class="fa fa-check"></i><span>Add Personal Information</span></li>
																					</ul>
																					<ul class="nav nav-tabs nav-stacked">
																						<li class="active"><a data-toggle="tab" data-bs-target="#adding_photo" role="tab" aria-controls="adding_photo" class="active" aria-selected="true"><span class="stp-numbr">4</span> <span>Adding Photo</span></a></li>
																						<li class=""><a data-toggle="tab" data-bs-target="#" role="tab" class="" aria-controls="" aria-selected="false"><span class="stp-numbr">5</span> <span>Adding Family Member</span></a></li>
																					</ul>
																					
																					<div class="tab-content">
																					   
																						<div id="adding_photo" class="tab-pane fade show active">
																							<div class="upload-wrp-content">
																								<p><b>Put a face to the name </b>and improve your adds to networking success.</p>
																								<p>People prefer to network with members who has a profile photo, but if don't have one ready to upload, you can add it later.</p>
																							</div>
																							<div class="">
																								<div class="upload-img">
																									<input type="file" name="file_upload_profile" id="file_upload_profile" onchange="">
																									<div class="upload-img-msg">
																										<p>Touble uploading profile photo?</p>
																									</div>
																								</div>
																							</div>
																							<div class="signup-step-btn">
																								<button type="button" class="signup-new btn-red" id="step44_next">Next</button>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</form>
																</div>
																
																<div id="divstep6" style="display: none;">
																	<form action="#" id="familyform">
																		<h4 class="heading-step">Step 5</h4>
																		<div class="sign-step_5">
																			<div class="filledstep-bar">
																				<div class="row">
																					<div class="col-sm-12">
																						<span class="filledstep"></span>
																						<span class="filledstep"></span>
																						<span class="filledstep"></span>
																						<span class="filledstep"></span>
																					</div>
																				</div>
																			</div>

																			<div class="row">
																				<div class="col-sm-12">
																					<h2>Activities are much more fun with family</h2>
																					<div class="error" id="systemMessage"></div>
																					<h4><b>Add Your Family Members Information</b></h4>
																					<div class="error" id="familyerrormessage"></div>
																					<input type="hidden" name="familycnt" id="familycnt" value="0">
																					<div id="familymaindiv">
																						<div class="accordion" id="default-accordion-example">
																							<div class="accordion-item shadow">
																								<h2 class="accordion-header" id="headingOne">
																									<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
																										Family Member #1
																									</button>
																								</h2>
																								<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
																									<div class="accordion-body">
																										<div class="form-group">
																											<input type="text" name="fname[]" id="fname" class="form-control first_name required" placeholder="First Name">
																											<span class="error" id="err_fname"></span>
																										</div>
																										<div class="form-group">
																											<input type="text" name="lname[]" id="lname" class="form-control last_name required" placeholder="Last Name">
																											<span class="error" id="err_lname"></span>
																										</div>
																										<div>
																											<input type="text" class="form-control border-0 dash-filter-picker flatpiker-with-border flatpickr-range-birthdate" data-range-date="false" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
																										</div>
																										<div class="form-group">
																											<select name="relationship[]" id="relationship" class="form-select relationship required">
																												<option value="">Select Relationship</option>
																												<option value="Brother">Brother</option>
																												<option value="Sister">Sister</option>
																												<option value="Father">Father</option>
																												<option value="Mother">Mother</option>
																												<option value="Wife">Wife</option>
																												<option value="Husband">Husband</option>
																												<option value="Son">Son</option>
																												<option value="Daughter">Daughter</option>
																											</select>
																											<span class="error" id="err_relationship"></span>
																										</div>
																										<div class="form-group">
																											<input maxlength="14" type="text" name="mphone[]" id="mphone" class="form-control mobile_number" placeholder="Mobile Phone" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
																											<span class="error" id="err_mphone"></span>
																										</div>
																										<div class="form-group">
																											<input maxlength="14" type="text" name="emergency_phone[]" id="emergency_phone" class="form-control emergency_phone" placeholder="Emergency Contact Number" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
																											<span class="error" id="err_emergency_phone"></span>
																										</div>
																										<div class="form-group">
																											<select name="gender[]" id="gender" class="form-select gender" required="">
																												<option value="">Select Gender</option>
																												<option value="male">Male</option>
																												<option value="female">Female</option>
																												<option value="other">Specify other</option>
																											</select>
																											<span class="error" id="err_gender"></span>
																										</div>
																										<div class="form-group">
																											<input type="email" name="emailid[]" id="emailid" class="form-control email" placeholder="Email">
																											<span class="error" id="err_emailid"></span>
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																						<div class="new-client" id="familydiv0">
																							
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="signup-step-btn">
																				<button type="button" class="signup-new btn-red mb-10 mt-25" id="add_family">Add New Family Member</button>
																				<button type="button" class="signup-new btn-red mb-10" id="step5_next">Save</button>
																				<button type="button" class="signup-new btn-red mb-10" id="skip5_next">Skip</button>
																			</div>
																		</div>
																	</form>
																</div>
																
															</div>
														</div>
														<div class="col-lg-6 col-md-6 col-sm-6 space-remover manage-customer-gray-bg">
															<div class="manage-customer-search search-info">
																<h3>Onboard A New Client Fast</h3>
																<h4>Search for your clients on Fitnessity</h4>
																<p>“Your client could already have an account on Fitnessity.<br>If so, get access and sync their information fast.”</p>
															</div>
															<div class="row check-txt-center claimyour-business">
																<div class="col-md-10 col-xs-10 col-8 frm-claim">
																	<input id="clients_name" style="margin-top:10px;" type="text" class="form-control" placeholder="Search by typing your clients name" autocomplete="off" data-customer-id="">
																	
																	<div class="request-access" style="display:none">
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
                            <!--end col-->
						</div>
                        <!--end row-->
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header border-0">
										<h4 class="card-title mb-0">Calendar</h4>
									</div><!-- end cardheader -->
									<div class="card-body pt-0 card-350-body">
										<div class="row">
											<div class="col-xxl-3 col-lg-4 col-md-7 col-sm-6">
												<div class="input-group">
													<input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-range" data-range-date="false" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
													<div class="input-group-text bg-primary border-primary text-white">
														<i class="ri-calendar-2-line"></i>
													</div>
												</div>
											</div>
											<div class="col-xxl-2 col-lg-3 col-md-5 col-sm-5">
												<div class="steps-title mmt-10">
													<div class="mb-3">
														<select name="activity_type" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
															<option value=""> Show All Activities </option>
															<option value="individual">Personal Trainer</option>
															<option value="classes">Classes</option>
															<option value="events">Events</option>
															<option value="experience">Experience</option>
														</select>
													</div>
												</div>												
											</div>
										</div>
										<h6 class="text-uppercase fw-semibold mt-4 mb-3 text-muted"></h6>
										<div class="mini-stats-wid d-flex align-items-center mt-3 scheduler-box">
											<div class="flex-shrink-0 right-spretar">
												<p class="text-muted mb-0">7:00 <span class="text-uppercase">am</span></p>
												<p class="text-muted mb-0">9:20 <span class="text-uppercase">pm</span></p>
											</div>
											<div class="flex-shrink-0 avatar-sm ms-3">
												<a href="#" class="cursor-pointer" data-bs-toggle="modal" data-bs-target=".add_client">
													<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4">
														1/10
													</span>
												</a>
											</div>
											<div class="flex-grow-1 ms-3">
												<h6 class="mb-1">Private Lessons (No Booking Online. Call to Reserve and Book)</h6>
												<p class="text-muted mb-0">with Valor Instructor in Indoor/Outdoors</p>
											</div>
											<div class="flex-grow-1 ms-3">
												<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".activity-scheduler "><i class="ri-more-fill"></i></a>
												<div class="modal fade activity-scheduler" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
																						<th>Status</th>
																						<th>Duration</th>
																						<th>Location</th>
																						<th> Instructor</th>
																						<th></th>
																					</tr>
																				</thead>
																				<tbody>
																					<tr>
																						<td>
																							<label class="overlay-activity-label">Activity Completed</label>
																						</td>
																						<td>
																							<div class="scheduled-activity-info">
																								<span>2 hr 15 Min </span>
																							</div>
																						</td>
																						<td>
																							<div class="scheduled-location">
																								<span> At Business,On Location</span>
																							</div>
																						</td>
																						<td>
																							<div class="scheduled-location">
																								<span>-</span>
																							</div>
																						</td>
																						<td>
																							<div class="scheduled-btns">
																								<button type="submit" class="btn-red mb-10">Edit</button>
																								<button type="button" class="btn-black" disabled="">Cancel</button>
																							</div>
																						</td>
																					</tr>
																					
																					<tr>
																						<td>
																							<label class="overlay-activity-label">Activity Completed</label>
																						</td>
																						<td>
																							<div class="scheduled-activity-info">
																								<span>45 Min</span>
																							</div>
																						</td>
																						<td>
																							<div class="scheduled-location">
																								<span> Online</span>
																							</div>
																						</td>
																						<td>
																							<div class="scheduled-location">
																								<span>-</span>
																							</div>
																						</td>
																						<td>
																							<div class="scheduled-btns">
																								<button type="submit" class="btn-red mb-10">Edit</button>
																								<button type="button" class="btn-black" disabled="">Cancel</button>
																							</div>
																						</td>
																					</tr>
																				</tbody>
																			</table>
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
											
										</div><!-- end -->
										<div class="mini-stats-wid d-flex align-items-center mt-3 scheduler-box">
											<div class="flex-shrink-0 right-spretar">
												<p class="text-muted mb-0">11:00 <span class="text-uppercase">am</span></p>
												<p class="text-muted mb-0">11:45 <span class="text-uppercase">am</span></p>
											</div>
											<div class="flex-shrink-0 avatar-sm ms-3">
												<a href="#" class="cursor-pointer">
													<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4">
														1/10
													</span>
												</a>
											</div>
											<div class="flex-grow-1 ms-3">
												<h6 class="mb-1">Kickboxing (All Levels)</h6>
												<p class="text-muted mb-0">with Bernard Seaborn in Studio A</p>
											</div>
											<div class="flex-grow-1 ms-3">
												<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".activity-scheduler"><i class="ri-more-fill"></i></a>
											</div>
											
										</div><!-- end -->
										<div class="mini-stats-wid d-flex align-items-center mt-3 scheduler-box">
											<div class="flex-shrink-0 right-spretar">
												<p class="text-muted mb-0">3:30 <span class="text-uppercase">pm</span></p>
												<p class="text-muted mb-0">4:00 <span class="text-uppercase">pm</span></p>
											</div>
											<div class="flex-shrink-0 avatar-sm ms-3">
												<a href="#" class="cursor-pointer">
													<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4">
														1/10
													</span>
												</a>
											</div>
											<div class="flex-grow-1 ms-3">
												<h6 class="mb-1">Mini Ninjas (Age 3 to 4 yrs.)</h6>
												<p class="text-muted mb-0">with Valor Instructor in Studio A</p>
											</div>
											<div class="flex-grow-1 ms-3">
												<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".activity-scheduler"><i class="ri-more-fill"></i></a>
											</div>
											
										</div><!-- end -->
										<div class="mini-stats-wid d-flex align-items-center mt-3 scheduler-box">
											<div class="flex-shrink-0 right-spretar">
												<p class="text-muted mb-0">4:00 <span class="text-uppercase">pm</span></p>
												<p class="text-muted mb-0">4:30 <span class="text-uppercase">pm</span></p>
											</div>
											<div class="flex-shrink-0 avatar-sm ms-3">
												<a href="#" class="cursor-pointer">
													<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4">
														1/10
													</span>
												</a>
											</div>
											<div class="flex-grow-1 ms-3">
												<h6 class="mb-1">Little Ninjas(5 to 7 yrs old)</h6>
												<p class="text-muted mb-0">with Valor Instructor in Studio A</p>
											</div>
											<div class="flex-grow-1 ms-3">
												<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".activity-scheduler"><i class="ri-more-fill"></i></a>
											</div>
											
										</div><!-- end -->
										<div class="mini-stats-wid d-flex align-items-center mt-3 scheduler-box">
											<div class="flex-shrink-0 right-spretar">
												<p class="text-muted mb-0">4:30 <span class="text-uppercase">pm</span></p>
												<p class="text-muted mb-0">5:15 <span class="text-uppercase">pm</span></p>
											</div>
											<div class="flex-shrink-0 avatar-sm ms-3">
												<a href="#" class="cursor-pointer">
													<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4">
														1/10
													</span>
												</a>
											</div>
											<div class="flex-grow-1 ms-3">
												<h6 class="mb-1">Kids Beginner Class(7 to 12yrs)</h6>
												<p class="text-muted mb-0">with Valor Instructor in Studio A</p>
											</div>
											<div class="flex-grow-1 ms-3">
												<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".activity-scheduler"><i class="ri-more-fill"></i></a>
											</div>
											
										</div><!-- end -->
										<div class="mini-stats-wid d-flex align-items-center mt-3 scheduler-box">
											<div class="flex-shrink-0 right-spretar">
												<p class="text-muted mb-0">5:15 <span class="text-uppercase">pm</span></p>
												<p class="text-muted mb-0">6:00 <span class="text-uppercase">pm</span></p>
											</div>
											<div class="flex-shrink-0 avatar-sm ms-3">
												<a href="#" class="cursor-pointer">
													<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4">
														1/10
													</span>
												</a>
											</div>
											<div class="flex-grow-1 ms-3">
												<h6 class="mb-1">Kids Int. & Adv.</h6>
												<p class="text-muted mb-0">with Valor Instructor in Studio A</p>
											</div>
											<div class="flex-grow-1 ms-3">
												<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".activity-scheduler"><i class="ri-more-fill"></i></a>
											</div>
											
										</div><!-- end -->
										<div class="mini-stats-wid d-flex align-items-center mt-3 scheduler-box">
											<div class="flex-shrink-0 right-spretar">
												<p class="text-muted mb-0">6:15 <span class="text-uppercase">pm</span></p>
												<p class="text-muted mb-0">7:00 <span class="text-uppercase">pm</span></p>
											</div>
											<div class="flex-shrink-0 avatar-sm ms-3">
												<a href="#" class="cursor-pointer">
													<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4">
														1/10
													</span>
												</a>
											</div>
											<div class="flex-grow-1 ms-3">
												<h6 class="mb-1">Kickboxing(All Levels) </h6>
												<p class="text-muted mb-0">with Bernard Seaborn</p>
											</div>
											<div class="flex-grow-1 ms-3">
												<a class="float-end" href="#" data-bs-toggle="modal" data-bs-target=".activity-scheduler"><i class="ri-more-fill"></i></a>
											</div>
											
										</div><!-- end -->
										<div class="row">
											<div class="col-md-6 col-xs-12 col-sm-6">
												<div class="activities-details mt-10">
													<label>Total Activities Today: </label> <span id="sccount"> 10 </span>
													<label>Total Reservations Today:</label> <span id="rescount">0 </span>
													05/25/2023
												</div>
											</div>
											<div class="col-md-6 col-xs-12 col-sm-6">
												<div class="pre-next-btns pre-nxt-btn-space mt-10">
													<a class="btn-previous btn-sp btn-black" href="#" disabled="" id="btn-pre">
														<i class="fas fa-caret-left preday-arrow"></i>Previous Day
													</a>
													
													<a class="btn-previous btn-red" id="btn-next" href="#">Next Day <i class="fas fa-caret-right nextday-arrow"></i></a>
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

<div class="modal fade add_client" tabindex="-1" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-70">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="myModalLabel">Activity Scheduler Check-In</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-5">
						<div class="pro-name">
							<label>World Kungfu Championships</label>
						</div>
						<div class="row">
							<div class="col-md-6">
								<span class="mb-3">kung fu session 2</span>
							</div>
							<div class="col-md-6">
								<div class="mb-3">
									<span >Wednesday, August 2, 2023</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-7">
						<div class="row">
							<div class="col-md-4 col-sm-4 col-6">
								<div class="gry-box d-grid side-box mb-3">
									<label>Time</label>
									<span>01:30 AM - 03:30 AM</span>
								</div>
							</div>
							<div class="col-md-4 col-sm-4 col-6">
								<div class="gry-box d-grid side-box mb-3">
									<label>Duration</label>
									<span>2 hour</span>
								</div>
							</div>
							<div class="col-md-4 col-sm-4 col-6">
								<div class="gry-box d-grid side-box mb-3">
									<label>Spots</label>
									<span>8/10</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-12">	
						<div class="mb-3 select-staff-member">
							<select name="activity_type" class="form-select" id="" data-choices="" data-choices-search-false="">
								<option value="">Select Staff Member</option>
								<option value="">Option 2</option>
								<option value="">Option 3</option>
								<option value="">Option 4</option>
								<option value="">Option 5</option>
							</select>
						</div>
					</div>
					<div class="col-md-8 col-sm-8 col-12">	
						<div class="float-right mb-3">
							<div class="search-set manage-search manage-space">
								<div class="client-search">
									<div class="position-relative">
										<input type="text" class="form-control ui-autocomplete-input" placeholder="Search for client" autocomplete="off" id="search_postorder_client" value="">
										<span class="mdi mdi-magnify search-widget-icon"></span>
										<span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
									</div>
									<div class="dropdown-menu dropdown-menu-lg" id="search-dropdown"></div>
								</div>
							</div>
							<div class="btn-client-search">
								<a class="btn-red-primary btn-red mmt-10" data-business-activity-scheduler-id="1101" data-behavior="add_client_to_booking_post_order">Add </a>
								<!--<a class="btn-red-primary btn-red mmt-10" href="#" data-bs-toggle="modal" data-bs-target=".add_client">Add </a>-->
							</div>
						</div>
					</div>
					
					<div class="col-md-12">	
						<div class="booking-add-client">
							<div class="table-responsive">
								<table>
								  <tr>
									<th>No</th>
									<th>Client</th>
									<th>Options</th>
									<th>Check In</th>
									<th>Remaining </th>
									<th>Expiration</th>
									<th>Alerts</th>
									<th></th>
								  </tr>
								<tr>
									<td>1</td>
									<td>
										<div class="mini-stats-wid d-flex align-items-center width-185">
											<div class="avatar-sm mr-15">
												<div class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">
													<span> AJ </span>
												</div>
											</div>
											<h6 class="mb-1">Aadi Jambawalikar</h6>
										</div>
									</td>
									<td>
										<select class="form-select valid price-info mmt-10 width-105" data-behavior="change_price_title" data-booking-checkin-detail-id="370">
											<option value="" selected="">Choose option</option>
										</select>
									</td>
									<td>
										<div class="check-cancel width-105">
											<input type="checkbox" id="checkin" name="checkin" value="">
											<label for="checkin" class="mb-0 mmt-10">Check In</label><br>
											<input type="checkbox" id="cancel" name="cancel" value="">
											<label for="cancel" class="mb-0 mmt-10"> Late Cancel</label><br>
										</div>
									</td>
									<td>
										<div>
											<h6 class="mmt-10">Remaining</h6>
											<p class="mb-0">N/A</p>
										</div>
									</td>
									<td>N/A</td>
									<td>
										<p>expired CC</p>
									</td>
									<td>
										<div class="multiple-options">
											<div class="setting-icon">
												<i class="ri-more-fill"></i>
												<ul>
													<li><a href="http://dev.fitnessity.co/business/68/orders/create?cus_id=30400"><i class="fas fa-plus text-muted"></i>Purchase</a></li>
													<li><a href="http://dev.fitnessity.co/business/68/customers/30400" target="_blank" ><i class="fas fa-plus text-muted"></i>View Account</a></li>
													<li>
														<a href="#" data-behavior="delete_checkin_detail" data-booking-checkin-detail-id="374"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>
													</li>
												</ul>
											</div>
										</div>
									</td>
								  </tr>
								 <tr>
									<td>2</td>
									<td>
										<div class="mini-stats-wid d-flex align-items-center width-185">
											<div class="avatar-sm mr-15">
												<div class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-red fs-4 uppercase">
													<span> AJ </span>
												</div>
											</div>
											<h6 class="mb-1">Aadi Jambawalikar</h6>
										</div>
									</td>
									<td>
										<select class="form-select valid price-info mmt-10 width-105" data-behavior="change_price_title" data-booking-checkin-detail-id="370">
											<option value="" selected="">Choose option</option>
										</select>
									</td>
									<td>
										<div class="check-cancel width-105">
											<input type="checkbox" id="checkin" name="checkin" value="">
											<label for="checkin" class="mb-0 mmt-10">Check In</label><br>
											<input type="checkbox" id="cancel" name="cancel" value="">
											<label for="cancel" class="mb-0 mmt-10"> Late Cancel</label><br>
										</div>
									</td>
									<td>
										<div>
											<h6 class="mmt-10">Remaining</h6>
											<p class="mb-0">N/A</p>
										</div>
									</td>
									<td>N/A</td>
									<td>
										<div class="scheduled-btns width-120">
											<p>expired CC</p>
										</div>
									</td>
									<td>
										<div class="multiple-options">
											<div class="setting-icon">
												<i class="ri-more-fill"></i>
												<ul>
													<li><a href="http://dev.fitnessity.co/business/68/orders/create?cus_id=30400"><i class="fas fa-plus text-muted"></i>Purchase</a></li>
													<li><a href="http://dev.fitnessity.co/business/68/customers/30400" target="_blank" ><i class="fas fa-plus text-muted"></i>View Account</a></li>
													<li>
														<a href="#" data-behavior="delete_checkin_detail" data-booking-checkin-detail-id="374"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a>
													</li>
												</ul>
											</div>
										</div>
									</td>
								  </tr>
								<tr>
									<td colspan="8"> 
										<div class="no0signup text-center">
											<img src="http://dev.fitnessity.co/public/dashboard-design/images/sports-set.jpg">
											<h3>No one is signed up. Add them to this activity</h3>
										</div>
									</td>
								</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div> 

<div class="modal fade checking-details0" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" style="display: none;" aria-modal="true">
	<div class="modal-dialog modal-dialog-centered width-50 bsw-35">
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
									<th>Expiration</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<p class="mb-0">N/A</p>
									</td>
									<td>
										<div class="scheduled-btns">
											<a href="http://dev.fitnessity.co/business/68/orders/create?cus_id=30400" class="btn btn-red mb-10">Purchase</a>
											<a href="http://dev.fitnessity.co/business/68/customers/30400" target="_blank" class="btn btn-black mb-10">View Account</a>
										</div>
									</td>
									<td>
										<div class="scheduled-btns">
											<a href="#" data-behavior="delete_checkin_detail" data-booking-checkin-detail-id="374" class="btn btn-red">Delete</a>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>	
	
	@include('layouts.business.footer')
	<script>
		flatpickr(".flatpickr-range", {
	        dateFormat: "m/d/Y",
	        maxDate: "01/01/2050",
			defaultDate: [new Date()],
	     });
		 
		 flatpickr(".flatpickr-range-birthdate", {
	        dateFormat: "m/d/Y",
	        maxDate: "01/01/2050",
			defaultDate: [new Date()],
	     });
		 
	</script>

@endsection