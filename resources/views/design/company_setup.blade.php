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
							<div class="col-12">
								<div class="page-heading">
									<label>COMPANY SET UP</label>
								</div>
							</div>
                            <!--end col-->
						</div>
                        <!--end row-->
						<div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header align-items-center d-flex">
										<h4 class="card-title mb-0 flex-grow-1 nesting-steps-title">Business Details Setup</h4>
									</div><!-- end card header -->
									<div class="card-body">
										<div class="live-preview">
											<div class="accordion" id="default-accordion-example">
												<div class="accordion-item shadow">
													<h2 class="accordion-header" id="headingOne">
														<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
															Details Setup
														</button>
													</h2>
													<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#default-accordion-example">
														<div class="accordion-body">
															<div class="row">
																<div class="col-lg-6 col-md-6">
																	<div class="form-group mt-10">
																		<label for="email">Legal Business Name <span id="star">*</span></label>
																		<input type="text" class="form-control" name="Companyname" id="b_companyname" size="30" maxlength="255" placeholder="Company Name" value="Fitness Pvt. Ltd." required="">
																		<span class="error" id="b_cmpo"></span>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6">
																	<div class="form-group mt-10">
																		<label for="pwd">dba Business Name <span id="star">*</span>(If its the same as legal name, add it here again.)</label>
																		<input type="text" class="form-control" autocomplete="nope" name="dba_business_name" id="b_dba_business_name" placeholder="Dba Business name" value="" required="">
																		<span class="error" id="b_addr"></span>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6">
																	<div class="form-group mt-10">
																		<label for="pwd">Business Address <span id="star">*</span></label>
																		<input type="text" class="form-control pac-target-input" autocomplete="off" name="Address" id="b_address" placeholder="Address" value="2077 Broadway" required="">
																		<span class="error" id="b_addr"></span>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6">
																	<div class="form-group mt-10">
																		<label for="pwd">Additional Address Info</label>
																		<input type="text" class="form-control" autocomplete="nope" name="additional_address" id="b_additional_address" placeholder="Additional Address" value="">
																		<span class="error" id="b_addr"></span>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6">
																	<div class="form-group mt-10">
																		<label for="City">City <span id="star">*</span></label>
																		<input type="text" class="form-control" name="City" id="b_city" size="30" placeholder="City" maxlength="50" value="New York" required="">
																		<span class="error" id="b_ct"></span>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6">
																	<div class="form-group mt-10">
																		<label for="State">State <span id="star">*</span></label>
																		<input type="text" class="form-control" name="State" id="b_state" size="30" placeholder="State" maxlength="50" value="NY" required="">
																		<span class="error" id="b_sta"></span>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6">
																	<div class="form-group mt-10">
																		<label for="zip">Zip Code <span id="star">*</span></label>
																		<input type="text" class="form-control" name="ZipCode" id="b_zipcode" size="30" placeholder="Zip Code" value="10023" maxlength="20" required="">
																		<span class="error" id="b_zip"></span>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6">
																	<div class="form-group mt-10">
																		<label for="location">Neighborhood/Location/Area</label>
																		<input type="text" class="form-control" name="neighborhood" id="b_neighborhood" size="30" placeholder="Neighborhood" value="1235" maxlength="50">
																		<span class="error" id="b_cont"></span>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6">
																	<div class="form-group mt-10">
																		<label for="pno">Business Phone Number <span id="star">*</span></label>
																		<input type="text" class="form-control" name="business_phone" id="b_business_phone" placeholder="Business Phone" value="(123) 333-3333" onkeyup="changeformate_b_business_phone();" maxlength="14" required="">
																		<span class="error" id="b_usertag"></span>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6">
																	<div class="form-group mt-10">
																		<label for="email">Business Email <span id="star">*</span></label>
																		<input type="text" class="form-control" name="business_email" id="b_business_email" placeholder="Business email" value="nipavadhavana@gmail.com" required="">
																		<span class="error" id="b_usertag"></span>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6">
																	<div class="form-group mt-10">
																		<label for="uname">Business Username <span id="star">*</span></label>
																		<input type="text" class="form-control" name="Businessusername" id="b_business_user_tag" placeholder="Business User Tag" value="fitness" required="">
																		<span class="error" id="b_usertag"></span>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6">
																	<div class="form-group mt-10">
																		<label for="web">Business Website</label>
																		<input type="text" class="form-control" name="business_website" id="b_business_user_tag" placeholder="Business Website" value="www.fit.in">
																		<span class="error" id="b_usertag"></span>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6">
																	<div class="form-group mt-10">
																		<label for="btype">Business type <span id="star">*</span></label>
																		<select class="form-select" name="business_type" required="">
																			<option selected="&quot;selected&quot;" value="individual">Individual</option>
																			<option value="individual">Business</option>
																		</select>
																		<span class="error" id="b_usertag"></span>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6">
																	<div class="form-group mt-10">
																		<label for="video">Embed Video Code </label>
																		<input type="text" class="form-control" name="EmbedVideo" id="b_embedvideo" placeholder="Video Code" value="https://www.youtube.com/embed/brjAjq4zEIE" maxlength="150">
																		<span id="b_embedvideo">Example: https://www.youtube.com/embed/<b>rW_fwcmyIfk</b></span>
																	</div>
																</div>
															</div>
															<div class="dropdown-divider mt-20 mb-20"></div>
															<div class="row">
																<div class="col-lg-6 col-md-6">
																	<div class="form-group mt-10">
																		<label for="img">Upload Profile Image</label>
																		<input type="file" class="form-control" name="Profilepic" id="profile_pic" onchange="readURL(this);">
																		<input type="hidden" name="oldProfilepic" id="oldProfilepic" value="1670847631-gettyimages-820294498-612x612.jpg">
																	</div>
																</div>
																<div class="col-lg-6 col-md-6 text-center">
																	<div class="form-group mt-10">
																		<img src="http://dev.fitnessity.co/public/uploads/profile_pic/thumb/1670847631-gettyimages-820294498-612x612.jpg" class="pro_card_img blah" id="showimg">
																	</div>
																</div>
																<div class="col-lg-6 col-md-6">
																	<div class="form-group mt-10">
																		<label>Company Representative First Name <span id="star">*</span></label>
																		<input type="text" class="form-control" name="Firstnameb" id="b_firstname" size="30" maxlength="80" placeholder="Company Representative First Name" value="Nipas" required="">
																		<span class="error" id="b_firstnm"></span>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6">
																	<div class="form-group mt-10">
																		<label>Company Representative Last Name <span id="star">*</span></label>
																		<input type="text" class="form-control" name="Lastnameb" id="b_lastname" size="30" maxlength="80" placeholder="Company Representative Last Name" value="Soni" required="">
																		<span class="error" id="b_lastnm"></span>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6">
																	<div class="form-group mt-10">
																		<label>Email</label>
																		<input type="email" class="form-control myemail" name="Emailb" id="b_email" autocomplete="off" placeholder="Email Address" size="30" maxlength="80" value="">
																		<span class="error" id="b_eml"></span>
																	</div>
																</div>
																<div class="col-lg-6 col-md-6">
																	<div class="form-group mt-10">
																		<label>Contact Number </label>
																		<input type="text" class="form-control" name="Phonenumber" id="b_contact" size="30" maxlength="14" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" placeholder="Contact No" value="(123)-454-6456" onkeyup="changeformate()">
																		<span class="error" id="b_cot"></span>
																	</div>
																</div>
																<div class="col-lg-12">
																	<div class="form-group mt-10">
																		<label>Quick Business Intro</label>
																		<textarea class="form-control" rows="4" placeholder="Tell Us Somthing About Company..." name="Aboutcompany" id="about_company" maxlength="150">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</textarea>
																		<div class="word-counter">
																			<span id="quick_business_left">2</span> 
																			Characters Left
																		</div>
																		<span class="error" id="b_abt"></span>
																	</div>
																</div>
																<div class="col-lg-12">
																	<div class="form-group mt-10">
																		<label>Company Description</label>
																		<textarea class="form-control" rows="5" placeholder="Tell Us Somthing About Company in short..." name="Shortdescription" id="short_description" maxlength="1000">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</textarea>
																		<div class="word-counter">
																			<span id="company_desc_left">556</span> 
																			Characters Left
																		</div>
																		<span class="error" id="b_short"></span>
																	</div>
																</div>
																<div class="col-md-12 col-12">
																	<button type="button" class="btn-red-primary btn-red float-right mt-15" id="nextindividual2">Save </button>
																</div>
															</div>
															
														</div>
													</div>
												</div>
											</div>
										</div>
									</div><!-- end card-body -->
								</div><!-- end card -->
							</div>
						</div><!--end row-->	
						
						<div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header align-items-center d-flex">
										<h4 class="card-title mb-0 flex-grow-1 nesting-steps-title">Tells us About Your Experience</h4>
									</div><!-- end card header -->
									<div class="card-body">
										<div class="live-preview">
											<div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting">
												<div class="accordion-item shadow">
													<h2 class="accordion-header" id="accordionnestingExample1">
														<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse1" aria-expanded="false" aria-controls="accor_nestingExamplecollapse1">
															Employment History
														</button>
													</h2>
													<div id="accor_nestingExamplecollapse1" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample1" data-bs-parent="#accordionnesting">
														<div class="accordion-body">
															<div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting2">
																<div class="accordion-item shadow">
																	<h2 class="accordion-header" id="accordionnesting2Example1">
																		<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse1" aria-expanded="false" aria-controls="accor_nesting2Examplecollapse1">
																			<div class="container-fluid nopadding">
																				<div class="row">
																					<div class="col-lg-6 col-md-6 col-8">
																						Employment Details
																					</div>
																					<div class="col-lg-6 col-md-6 col-4">
																						<div class="multiple-options">
																							<div class="setting-icon">
																								<i class="ri-more-fill"></i>
																								<ul>
																								   <li><a href=""><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
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
																			<div class="row">
																				<div class="col-lg-6 col-md-6">
																					<div class="form-group mt-10">
																						<label>Company Name </label>
																						<input type="text" name="frm_organisationname[]" id="frm_organisationname" placeholder="Organization name" class="form-control" maxlength="100" value="Fitness">
																						<span class="error" id="b_organisationname"></span>
																					</div>
																				</div>
																				<div class="col-lg-6 col-md-6">
																					<div class="form-group mt-10">
																						<label>Position </label>
																						<input type="text" class="form-control" id="frm_position" name="frm_position[]" placeholder="Position" value="designer" maxlength="100">
																						<span class="error" id="b_position"></span>
																					</div>
																				</div>
																				<div class="col-lg-6 col-md-6">
																					<div class="form-group mt-25">
																						<label class=" present_work_btn">
																							<input type="checkbox" name="frm_ispresentcheck[]" id="frm_ispresentcheck0" onchange="checkstillwork(this.value,0)" checked="">
																							<span>I Still Work Here</span>
																							<input type="hidden" name="frm_ispresent[]" id="frm_ispresent0" value="1">
																						</label>
																					</div>
																				</div>
																				<div class="col-lg-6 col-md-6">
																					<div class="form-group mt-10" id="dp1-position">
																						<label>From (mm/dd/yyyy)</label>
																						<div class="input-group">
																							<input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-range flatpiker-with-border" data-range-date="false" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
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
																				<div class="row">
																					<div class="col-lg-6 col-md-6 col-8">
																						Employment Details
																					</div>
																					<div class="col-lg-6 col-md-6 col-4">
																						<div class="multiple-options">
																							<div class="setting-icon">
																								<i class="ri-more-fill"></i>
																								<ul>
																								   <li><a href=""><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
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
															<div class="col-md-12">
																<div class="addanother">
																	<a class=""> + Add More</a>
																</div>  
															</div>
														</div>
														
													</div>
												</div>
												<div class="accordion-item shadow">
													<h2 class="accordion-header" id="accordionnestingExample2">
														<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse2" aria-expanded="false" aria-controls="accor_nestingExamplecollapse2">
															Education Details
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
																			<div class="row">
																				<div class="col-lg-6 col-md-6">
																					<div class="form-group mt-10">
																						<label>Degree - Course</label>
																						<input type="text" id="frm_course" name="frm_course[]" class="form-control frm_course" placeholder="Degree/Course (Obtained or Seeking)" value="MCA" maxlength="500">
																						<span class="error" id="b_degree"></span>
																					</div>
																				</div>
																				<div class="col-lg-6 col-md-6">
																					<div class="form-group mt-10">
																						<label>University - School</label>
																						<input type="text" id="frm_university" name="frm_university[]" class="form-control frm_university" placeholder="University/School" value="rk" maxlength="200">
																						<span class="error" id="b_university"></span>
																					</div>
																				</div>
																				<div class="col-lg-6 col-md-6">
																					<div class="form-group mt-10">
																						<label>Year Graduated (yyyy)</label>
																						<div class="input-group">
																							<input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-year flatpiker-with-border" data-range-date="false" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
																						</div>
																						<span class="error" id="b_year"></span>
																					</div>
																				</div>
																				
																			</div>
																		</div>
																	</div>
																</div>
																<div class="col-md-12">
																	<div class="addanother">
																		<a class=""> + Add More</a>
																	</div>  
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="accordion-item shadow">
													<h2 class="accordion-header" id="accordionnestingExample3">
														<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse4" aria-expanded="false" aria-controls="accor_nestingExamplecollapse4">
														   Certification Details
														</button>
													</h2>
													<div id="accor_nestingExamplecollapse4" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample4" data-bs-parent="#accordionnesting">
														<div class="accordion-body">
															
															<div class="accordion nesting4-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting4">
																<div class="accordion-item shadow mt-2">
																	<h2 class="accordion-header" id="accordionnesting3Example2">
																		<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting4Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting4Examplecollapse2">
																			Details
																		</button>
																	</h2>
																	<div id="accor_nesting4Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting4Example2" data-bs-parent="#accordionnesting4">
																		<div class="accordion-body">
																			<div class="row">
																				<div class="col-lg-6 col-md-6">
																					<div class="form-group mt-10">
																						<label>Name of Certification </label>
																						<input type="text" id="certification" name="certification[]" class="form-control" placeholder="Name of Certification" value="mca" maxlength="200">
																						<span class="error" id="b_certification"></span>
																					</div>
																				</div>
																				<div class="col-lg-6 col-md-6">
																					<div class="form-group mt-10">
																						<label>Completion Date (mm/dd/yyyy)</label>
																						<div class="input-group">
																							<input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-range flatpiker-with-border" data-range-date="false" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
																						</div>
																						<span class="error" id="b_year"></span>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="col-md-12">
																	<div class="addanother">
																		<a class=""> + Add More</a>
																	</div>  
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="accordion-item shadow">
													<h2 class="accordion-header" id="accordionnestingExample5">
														<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse5" aria-expanded="false" aria-controls="accor_nestingExamplecollapse5">
														   Skills, Achievements And Awards
														</button>
													</h2>
													<div id="accor_nestingExamplecollapse5" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample5" data-bs-parent="#accordionnesting">
														<div class="accordion-body">
															
															<div class="accordion nesting5-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting5">
																<div class="accordion-item shadow mt-2">
																	<h2 class="accordion-header" id="accordionnesting5Example2">
																		<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting5Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting4Examplecollapse2">
																			Details
																		</button>
																	</h2>
																	<div id="accor_nesting5Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting5Example2" data-bs-parent="#accordionnesting4">
																		<div class="accordion-body">
																			<div class="row">
																				<div class="col-lg-6 col-md-6">
																					<div class="form-group mt-10">
																						<label for="pwd">Skill Type</label>
																						<select name="skill_type[]" id="skiils_achievments_awards1" class="form-select my-select">
																							<option value="">Select Item</option>
																							<option value="Skills">Skills</option>
																							<option value="Achievment">Achievments</option>
																							<option value="Award" selected="">Awards</option>
																						</select>
																						<span class="error" id="b_skilltype"></span>
																					</div>
																				</div>
																				<div class="col-lg-6 col-md-6">
																					<div class="form-group mt-10">
																						<label>Completion Date (mm/dd/yyyy)</label>
																						<div class="input-group">
																							<input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-range flatpiker-with-border" data-range-date="false" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
																						</div>
																						<span class="error" id="b_year"></span>
																					</div>
																				</div>
																				<div class="col-lg-6 col-md-6">
																					<div class="form-group mt-10">
																						<label for="pwd">Description</label>
																						<textarea name="frm_skilldetail[]" id="frm_skilldetail" placeholder="Description" cols="10" rows="3" class="form-control" maxlength="300">asdasdasd asdasdsad</textarea>
																						<div class="word-counter">
																							<span id="quick_business_left">131</span> 
																							Characters Left 
																						</div>
																						<span class="error" id="b_skilldetail"></span>
																					</div>
																				</div>
																				
																			</div>
																		</div>
																	</div>
																</div>
																<div class="col-md-12">
																	<div class="addanother">
																		<a class=""> + Add More</a>
																	</div>  
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="col-md-12 col-12">
													<button type="button" class="btn-red-primary btn-red float-right mt-15" id="nextindividual2">Save </button>
												</div>
												
											</div>
										</div>
									</div><!-- end card-body -->
								</div><!-- end card -->
							</div>
                        <!--end col-->
						</div>
						<!--end row-->
						
						<div class="row">
							<div class="col-xl-12">
								<div class="card">
									<div class="card-header align-items-center d-flex">
										<h4 class="card-title mb-0 flex-grow-1">Company Specifics</h4>
									</div><!-- end card header -->

									<div class="card-body">
										<div class="live-preview">
											<div class="accordion" id="default-accordion-example">
												<div class="accordion-item shadow">
													<h2 class="accordion-header" id="headingTwo">
														<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
															Service Specifics
														</button>
													</h2>
													<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#default-accordion-example">
														<div class="accordion-body">
															<div class="row">
																<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
																	<div class="form-group mb-25">
																		<label for="email">Language(s) you and your staff speak ? (click all that apply) </label>
																		<select required="" name="languages[]" id="testdemo" multiple="" tabindex="-1" data-ssid="ss-91931">
																			<option value="English">English</option>
																			<option value="Abkhazian">Abkhazian</option>
																			<option value="Afar">Afar</option>
																			<option value="Afrikaans">Afrikaans</option>
																			<option value="Albanian">Albanian</option>
																			<option value="Amharic">Amharic</option>
																			<option value="Arabic">Arabic</option>
																			<option value="Armenian">Armenian</option>
																			<option value="Assamese">Assamese</option>
																			<option value="Aymara">Aymara</option>
																			<option value="Azerbaijani">Azerbaijani</option>
																			<option value="Bashkir">Bashkir</option>
																			<option value="Basque">Basque</option>
																			<option value="Belarusian">Belarusian</option>
																			<option value="Bengali/Bangla">Bengali/Bangla</option>
																			<option value="Bhutani">Bhutani</option>
																			<option value="Bihari">Bihari</option>
																			<option value="Bislama">Bislama</option>
																			<option value="Breton">Breton</option>
																			<option value="Bulgarian">Bulgarian</option>
																			<option value="Burmese">Burmese</option>
																			<option value="Catalan">Catalan</option>
																			<option value="Cambodian">Cambodian</option>
																			<option value="Chinese">Chinese</option>
																			<option value="Corsican">Corsican</option>
																			<option value="Croatian">Croatian</option>
																			<option value="Czech">Czech</option>
																			<option value="Danish">Danish</option>
																			<option value="Dutch">Dutch</option>
																			<option value="Esperanto">Esperanto</option>
																			<option value="Estonian">Estonian</option>
																			<option value="Finnish">Finnish</option>
																			<option value="Fiji">Fiji</option>
																			<option value="Faeroese">Faeroese</option>
																			<option value="French">French</option>
																			<option value="Frisian">Frisian</option>
																			<option value="Galician">Galician</option>
																			<option value="Guarani">Guarani</option>
																			<option value="Gujarati">Gujarati</option>
																			<option value="Georgian">Georgian</option>
																			<option value="German">German</option>
																			<option value="Greek">Greek</option>
																			<option value="Greenlandic">Greenlandic</option>
																			<option value="Hausa">Hausa</option>
																			<option value="Hebrew">Hebrew</option>
																			<option value="Hindi">Hindi</option>
																			<option value="Hungarian">Hungarian</option>
																			<option value="Irish">Irish</option>
																			<option value="Interlingua">Interlingua</option>
																			<option value="Inupiak">Inupiak</option>
																			<option value="Indonesian">Indonesian</option>
																			<option value="Icelandic">Icelandic</option>
																			<option value="Italian">Italian</option>
																			<option value="Japanese">Japanese</option>
																			<option value="Javanese">Javanese</option>
																			<option value="Kazakh">Kazakh</option>
																			<option value="Kinyarwanda">Kinyarwanda</option>
																			<option value="Kirundi">Kirundi</option>
																			<option value="Kannada">Kannada</option>
																			<option value="Korean">Korean</option>
																			<option value="Kashmiri">Kashmiri</option>
																			<option value="Kurdish">Kurdish</option>
																			<option value="Kirghiz">Kirghiz</option>
																			<option value="Latin">Latin</option>
																			<option value="Lingala">Lingala</option>
																			<option value="Laothian">Laothian</option>
																			<option value="Lithuanian">Lithuanian</option>
																			<option value="Latvian/Lettish">Latvian/Lettish</option>
																			<option value="Malagasy">Malagasy</option>
																			<option value="Maori">Maori</option>
																			<option value="Macedonian">Macedonian</option>
																			<option value="Malayalam">Malayalam</option>
																			<option value="Mongolian">Mongolian</option>
																			<option value="Moldavian">Moldavian</option>
																			<option value="Marathi">Marathi</option>
																			<option value="Malay">Malay</option>
																			<option value="Maltese">Maltese</option>
																			<option value="Nauru">Nauru</option>
																			<option value="Nepali">Nepali</option>
																			<option value="Norwegian">Norwegian</option>
																			<option value="Occitan">Occitan</option>
																			<option value="(Afan)/Oromoor/Oriya">(Afan)/Oromoor/Oriya</option>
																			<option value="Persian">Persian</option>
																			<option value="Punjabi">Punjabi</option>
																			<option value="Polish">Polish</option>
																			<option value="Pashto/Pushto">Pashto/Pushto</option>
																			<option value="Portuguese">Portuguese</option>
																			<option value="Quechua">Quechua</option>
																			<option value="Rhaeto-Romance">Rhaeto-Romance</option>
																			<option value="Romanian">Romanian</option>
																			<option value="Russian">Russian</option>
																			<option value="Samoan">Samoan</option>
																			<option value="Sangro">Sangro</option>
																			<option value="Sanskrit">Sanskrit</option>
																			<option value="Shona">Shona</option>
																			<option value="Sindhi">Sindhi</option>
																			<option value="Singhalese">Singhalese</option>
																			<option value="Scots/Gaelic">Scots/Gaelic</option>
																			<option value="Serbo-Croatian">Serbo-Croatian</option>
																			<option value="Slovak">Slovak</option>
																			<option value="Slovenian">Slovenian</option>
																			<option value="Somali">Somali</option>
																			<option value="Serbian">Serbian</option>
																			<option value="Siswati">Siswati</option>
																			<option value="Sesotho">Sesotho</option>
																			<option value="Setswana">Setswana</option>
																			<option value="Spanish">Spanish</option>
																			<option value="Sundanese">Sundanese</option>
																			<option value="Swedish">Swedish</option>
																			<option value="Swahili">Swahili</option>
																			<option value="Tamil">Tamil</option>
																			<option value="Tibetan">Tibetan</option>
																			<option value="Telugu">Telugu</option>
																			<option value="Tajik">Tajik</option>
																			<option value="Thai">Thai</option>
																			<option value="Tigrinya">Tigrinya</option>
																			<option value="Turkmen">Turkmen</option>
																			<option value="Tagalog">Tagalog</option>
																			<option value="Tonga">Tonga</option>
																			<option value="Turkish">Turkish</option>
																			<option value="Tsonga">Tsonga</option>
																			<option value="Tatar">Tatar</option>
																			<option value="Twi">Twi</option>
																			<option value="Ukrainian">Ukrainian</option>
																			<option value="Urdu">Urdu</option>
																			<option value="Uzbek">Uzbek</option>
																			<option value="Vietnamese">Vietnamese</option>
																			<option value="Volapuk">Volapuk</option>
																			<option value="Welsh">Welsh</option>
																			<option value="Wolof">Wolof</option>
																			<option value="Xhosa">Xhosa</option>
																			<option value="Yiddish">Yiddish</option>
																			<option value="Yoruba">Yoruba</option>
																			<option value="Zulu">Zulu</option>
																		</select>
																		
																		<span class="error" id="b_testdemo"></span>
																	</div>
																</div>
																<div class="col-md-12 text-center">
																	<div class="form-group mb-25">
																		<label>Add Your Business Hours<br>Add your business hours so its easy customers to know when you are open for business.<br>When you add business hours, Your page is also more likely to be suggested to people in your area.</label><br>
																			<span style="font-size: 20px;font-weight: bold;">Hours</span><br>
																			<div class="custom-radio-btns">
																				<input type="radio" id="hours1" name="hours_opt" value="Open on selected hours" autocomplete="off">
																				<span>Select hours</span>
																				<input type="radio" id="hours2" name="hours_opt" value="Temporalily closed" autocomplete="off">
																				<span>Temporalily closed</span>
																				<input type="radio" id="hours4" name="hours_opt" value="Permanently closed" autocomplete="off">
																				<span>Permanently closed</span>
																			</div>
																		</div>
																	</div>
																</div>
																<div class="col-lg-12">
																	<div class="company-specifics-day company-specifics" id="selectdays">
																		<div class="row">
																			<div class="col-lg-2 col-md-3 col-sm-2 col-xs-12">
																				<div class="form-group mb-10">
																					<label for="mon">Monday</label>
																				</div>
																			</div>

																			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																				<div class="form-group mb-10">
																				<!-- <input type="text" name="mon_shift_start" value="" readonly class="form-control timepicker"> -->
																					<select name="mon_shift_start" id="mon_shift_start" class="mon_shift_start form-select">
																						<option value="">Select Time</option>
																						<option value="00:00">12:00 AM</option>
																						<option value="00:15">12:15 AM</option>
																						<option value="00:30">12:30 AM</option>
																						<option value="00:45">12:45 AM</option>
																						<option value="01:00">01:00 AM</option>
																						<option value="01:15">01:15 AM</option>
																						<option value="01:30">01:30 AM</option>
																						<option value="01:45">01:45 AM</option>
																						<option value="02:00">02:00 AM</option>
																						<option value="02:15">02:15 AM</option>
																						<option value="02:30">02:30 AM</option>
																						<option value="02:45">02:45 AM</option>
																						<option value="03:00">03:00 AM</option>
																						<option value="03:15">03:15 AM</option>
																						<option value="03:30">03:30 AM</option>
																						<option value="03:45">03:45 AM</option>
																						<option value="04:00">04:00 AM</option>
																						<option value="04:15">04:15 AM</option>
																						<option value="04:30">04:30 AM</option>
																						<option value="04:45">04:45 AM</option>
																						<option value="05:00">05:00 AM</option>
																						<option value="05:15">05:15 AM</option>
																						<option value="05:30">05:30 AM</option>
																						<option value="05:45">05:45 AM</option>
																						<option value="06:00">06:00 AM</option>
																						<option value="06:15">06:15 AM</option>
																						<option value="06:30">06:30 AM</option>
																						<option value="06:45">06:45 AM</option>
																						<option value="07:00">07:00 AM</option>
																						<option value="07:15">07:15 AM</option>
																						<option value="07:30">07:30 AM</option>
																						<option value="07:45">07:45 AM</option>
																						<option value="08:00">08:00 AM</option>
																						<option value="08:15">08:15 AM</option>
																						<option value="08:30">08:30 AM</option>
																						<option value="08:45">08:45 AM</option>
																						<option value="09:00">09:00 AM</option>
																						<option value="09:15">09:15 AM</option>
																						<option value="09:30">09:30 AM</option>
																						<option value="09:45">09:45 AM</option>
																						<option value="10:00">10:00 AM</option>
																						<option value="10:15">10:15 AM</option>
																						<option value="10:30">10:30 AM</option>
																						<option value="10:45">10:45 AM</option>
																						<option value="11:00">11:00 AM</option>
																						<option value="11:15">11:15 AM</option>
																						<option value="11:30">11:30 AM</option>
																						<option value="11:45">11:45 AM</option>
																						<option value="12:00">12:00 PM</option>
																						<option value="12:15">12:15 PM</option>
																						<option value="12:30">12:30 PM</option>
																						<option value="12:45">12:45 PM</option>
																						<option value="13:00">01:00 PM</option>
																						<option value="13:15">01:15 PM</option>
																						<option value="13:30">01:30 PM</option>
																						<option value="13:45">01:45 PM</option>
																						<option value="14:00">02:00 PM</option>
																						<option value="14:15">02:15 PM</option>
																						<option value="14:30">02:30 PM</option>
																						<option value="14:45">02:45 PM</option>
																						<option value="15:00">03:00 PM</option>
																						<option value="15:15">03:15 PM</option>
																						<option value="15:30">03:30 PM</option>
																						<option value="15:45">03:45 PM</option>
																						<option value="16:00">04:00 PM</option>
																						<option value="16:15">04:15 PM</option>
																						<option value="16:30">04:30 PM</option>
																						<option value="16:45">04:45 PM</option>
																						<option value="17:00">05:00 PM</option>
																						<option value="17:15">05:15 PM</option>
																						<option value="17:30">05:30 PM</option>
																						<option value="17:45">05:45 PM</option>
																						<option value="18:00">06:00 PM</option>
																						<option value="18:15">06:15 PM</option>
																						<option value="18:30">06:30 PM</option>
																						<option value="18:45">06:45 PM</option>
																						<option value="19:00">07:00 PM</option>
																						<option value="19:15">07:15 PM</option>
																						<option value="19:30">07:30 PM</option>
																						<option value="19:45">07:45 PM</option>
																						<option value="20:00">08:00 PM</option>
																						<option value="20:15">08:15 PM</option>
																						<option value="20:30">08:30 PM</option>
																						<option value="20:45">08:45 PM</option>
																						<option value="21:00">09:00 PM</option>
																						<option value="21:15">09:15 PM</option>
																						<option value="21:30">09:30 PM</option>
																						<option value="21:45">09:45 PM</option>
																						<option value="22:00">10:00 PM</option>
																						<option value="22:15">10:15 PM</option>
																						<option value="22:30">10:30 PM</option>
																						<option value="22:45">10:45 PM</option>
																						<option value="23:00">11:00 PM</option>
																						<option value="23:15">11:15 PM</option>
																						<option value="23:30">11:30 PM</option>
																					</select>
																				</div>
																			</div>
																			
																			<div class="col-lg-2 col-sm-2 col-md-1 col-xs-12">
																				<div class="form-group text-center mmb-10">
																					To
																				</div>
																			</div>

																			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																				<div class="form-group mb-10">
																					<!-- <input type="text" name="mon_shift_end" value="" readonly class="form-control timepicker1"> -->
																					<select name="mon_shift_end" id="mon_shift_end" class="mon_shift_end form-select">
																						<option value="">Select Time</option>
																						<option value="00:00">12:00 AM</option>
																						<option value="00:15">12:15 AM</option>
																						<option value="00:30">12:30 AM</option>
																						<option value="00:45">12:45 AM</option>
																						<option value="01:00">01:00 AM</option>
																						<option value="01:15">01:15 AM</option>
																						<option value="01:30">01:30 AM</option>
																						<option value="01:45">01:45 AM</option>
																						<option value="02:00">02:00 AM</option>
																						<option value="02:15">02:15 AM</option>
																						<option value="02:30">02:30 AM</option>
																						<option value="02:45">02:45 AM</option>
																						<option value="03:00">03:00 AM</option>
																						<option value="03:15">03:15 AM</option>
																						<option value="03:30">03:30 AM</option>
																						<option value="03:45">03:45 AM</option>
																						<option value="04:00">04:00 AM</option>
																						<option value="04:15">04:15 AM</option>
																						<option value="04:30">04:30 AM</option>
																						<option value="04:45">04:45 AM</option>
																						<option value="05:00">05:00 AM</option>
																						<option value="05:15">05:15 AM</option>
																						<option value="05:30">05:30 AM</option>
																						<option value="05:45">05:45 AM</option>
																						<option value="06:00">06:00 AM</option>
																						<option value="06:15">06:15 AM</option>
																						<option value="06:30">06:30 AM</option>
																						<option value="06:45">06:45 AM</option>
																						<option value="07:00">07:00 AM</option>
																						<option value="07:15">07:15 AM</option>
																						<option value="07:30">07:30 AM</option>
																						<option value="07:45">07:45 AM</option>
																						<option value="08:00">08:00 AM</option>
																						<option value="08:15">08:15 AM</option>
																						<option value="08:30">08:30 AM</option>
																						<option value="08:45">08:45 AM</option>
																						<option value="09:00">09:00 AM</option>
																						<option value="09:15">09:15 AM</option>
																						<option value="09:30">09:30 AM</option>
																						<option value="09:45">09:45 AM</option>
																						<option value="10:00">10:00 AM</option>
																						<option value="10:15">10:15 AM</option>
																						<option value="10:30">10:30 AM</option>
																						<option value="10:45">10:45 AM</option>
																						<option value="11:00">11:00 AM</option>
																						<option value="11:15">11:15 AM</option>
																						<option value="11:30">11:30 AM</option>
																						<option value="11:45">11:45 AM</option>
																						<option value="12:00">12:00 PM</option>
																						<option value="12:15">12:15 PM</option>
																						<option value="12:30">12:30 PM</option>
																						<option value="12:45">12:45 PM</option>
																						<option value="13:00">01:00 PM</option>
																						<option value="13:15">01:15 PM</option>
																						<option value="13:30">01:30 PM</option>
																						<option value="13:45">01:45 PM</option>
																						<option value="14:00">02:00 PM</option>
																						<option value="14:15">02:15 PM</option>
																						<option value="14:30">02:30 PM</option>
																						<option value="14:45">02:45 PM</option>
																						<option value="15:00">03:00 PM</option>
																						<option value="15:15">03:15 PM</option>
																						<option value="15:30">03:30 PM</option>
																						<option value="15:45">03:45 PM</option>
																						<option value="16:00">04:00 PM</option>
																						<option value="16:15">04:15 PM</option>
																						<option value="16:30">04:30 PM</option>
																						<option value="16:45">04:45 PM</option>
																						<option value="17:00">05:00 PM</option>
																						<option value="17:15">05:15 PM</option>
																						<option value="17:30">05:30 PM</option>
																						<option value="17:45">05:45 PM</option>
																						<option value="18:00">06:00 PM</option>
																						<option value="18:15">06:15 PM</option>
																						<option value="18:30">06:30 PM</option>
																						<option value="18:45">06:45 PM</option>
																						<option value="19:00">07:00 PM</option>
																						<option value="19:15">07:15 PM</option>
																						<option value="19:30">07:30 PM</option>
																						<option value="19:45">07:45 PM</option>
																						<option value="20:00">08:00 PM</option>
																						<option value="20:15">08:15 PM</option>
																						<option value="20:30">08:30 PM</option>
																						<option value="20:45">08:45 PM</option>
																						<option value="21:00">09:00 PM</option>
																						<option value="21:15">09:15 PM</option>
																						<option value="21:30">09:30 PM</option>
																						<option value="21:45">09:45 PM</option>
																						<option value="22:00">10:00 PM</option>
																						<option value="22:15">10:15 PM</option>
																						<option value="22:30">10:30 PM</option>
																						<option value="22:45">10:45 PM</option>
																						<option value="23:00">11:00 PM</option>
																						<option value="23:15">11:15 PM</option>
																						<option value="23:30">11:30 PM</option>
																					</select>
																				</div>
																			</div>
																		</div>

																		<div class="row">
																			<div class="col-lg-2 col-md-3 col-sm-2 col-xs-12">
																				<div class="form-group mb-10">
																					<label for="tue">Tuesday</label>
																				</div>
																			</div>

																			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																				<div class="form-group mb-10">
																					<!-- <input type="text" name="tue_shift_start" value="" readonly class="form-control timepicker"> -->
																					<select name="tue_shift_start" id="tue_shift_start" class="tue_shift_start form-select">
																						<option value="">Select Time</option>
																						<option value="00:00">12:00 AM</option>
																						<option value="00:15">12:15 AM</option>
																						<option value="00:30">12:30 AM</option>
																						<option value="00:45">12:45 AM</option>
																						<option value="01:00">01:00 AM</option>
																						<option value="01:15">01:15 AM</option>
																						<option value="01:30">01:30 AM</option>
																						<option value="01:45">01:45 AM</option>
																						<option value="02:00">02:00 AM</option>
																						<option value="02:15">02:15 AM</option>
																						<option value="02:30">02:30 AM</option>
																						<option value="02:45">02:45 AM</option>
																						<option value="03:00">03:00 AM</option>
																						<option value="03:15">03:15 AM</option>
																						<option value="03:30">03:30 AM</option>
																						<option value="03:45">03:45 AM</option>
																						<option value="04:00">04:00 AM</option>
																						<option value="04:15">04:15 AM</option>
																						<option value="04:30">04:30 AM</option>
																						<option value="04:45">04:45 AM</option>
																						<option value="05:00">05:00 AM</option>
																						<option value="05:15">05:15 AM</option>
																						<option value="05:30">05:30 AM</option>
																						<option value="05:45">05:45 AM</option>
																						<option value="06:00">06:00 AM</option>
																						<option value="06:15">06:15 AM</option>
																						<option value="06:30">06:30 AM</option>
																						<option value="06:45">06:45 AM</option>
																						<option value="07:00">07:00 AM</option>
																						<option value="07:15">07:15 AM</option>
																						<option value="07:30">07:30 AM</option>
																						<option value="07:45">07:45 AM</option>
																						<option value="08:00">08:00 AM</option>
																						<option value="08:15">08:15 AM</option>
																						<option value="08:30">08:30 AM</option>
																						<option value="08:45">08:45 AM</option>
																						<option value="09:00">09:00 AM</option>
																						<option value="09:15">09:15 AM</option>
																						<option value="09:30">09:30 AM</option>
																						<option value="09:45">09:45 AM</option>
																						<option value="10:00">10:00 AM</option>
																						<option value="10:15">10:15 AM</option>
																						<option value="10:30">10:30 AM</option>
																						<option value="10:45">10:45 AM</option>
																						<option value="11:00">11:00 AM</option>
																						<option value="11:15">11:15 AM</option>
																						<option value="11:30">11:30 AM</option>
																						<option value="11:45">11:45 AM</option>
																						<option value="12:00">12:00 PM</option>
																						<option value="12:15">12:15 PM</option>
																						<option value="12:30">12:30 PM</option>
																						<option value="12:45">12:45 PM</option>
																						<option value="13:00">01:00 PM</option>
																						<option value="13:15">01:15 PM</option>
																						<option value="13:30">01:30 PM</option>
																						<option value="13:45">01:45 PM</option>
																						<option value="14:00">02:00 PM</option>
																						<option value="14:15">02:15 PM</option>
																						<option value="14:30">02:30 PM</option>
																						<option value="14:45">02:45 PM</option>
																						<option value="15:00">03:00 PM</option>
																						<option value="15:15">03:15 PM</option>
																						<option value="15:30">03:30 PM</option>
																						<option value="15:45">03:45 PM</option>
																						<option value="16:00">04:00 PM</option>
																						<option value="16:15">04:15 PM</option>
																						<option value="16:30">04:30 PM</option>
																						<option value="16:45">04:45 PM</option>
																						<option value="17:00">05:00 PM</option>
																						<option value="17:15">05:15 PM</option>
																						<option value="17:30">05:30 PM</option>
																						<option value="17:45">05:45 PM</option>
																						<option value="18:00">06:00 PM</option>
																						<option value="18:15">06:15 PM</option>
																						<option value="18:30">06:30 PM</option>
																						<option value="18:45">06:45 PM</option>
																						<option value="19:00">07:00 PM</option>
																						<option value="19:15">07:15 PM</option>
																						<option value="19:30">07:30 PM</option>
																						<option value="19:45">07:45 PM</option>
																						<option value="20:00">08:00 PM</option>
																						<option value="20:15">08:15 PM</option>
																						<option value="20:30">08:30 PM</option>
																						<option value="20:45">08:45 PM</option>
																						<option value="21:00">09:00 PM</option>
																						<option value="21:15">09:15 PM</option>
																						<option value="21:30">09:30 PM</option>
																						<option value="21:45">09:45 PM</option>
																						<option value="22:00">10:00 PM</option>
																						<option value="22:15">10:15 PM</option>
																						<option value="22:30">10:30 PM</option>
																						<option value="22:45">10:45 PM</option>
																						<option value="23:00">11:00 PM</option>
																						<option value="23:15">11:15 PM</option>
																						<option value="23:30">11:30 PM</option>
																					</select>
																				</div>
																			</div>
																			
																			<div class="col-lg-2 col-sm-2 col-md-1 col-xs-12">
																				<div class="form-group mmb-10 text-center">
																					To
																				</div>
																			</div>

																			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																				<div class="form-group mb-10">
																					<!-- <input type="text" name="tue_shift_end" value="" readonly class="form-control timepicker1"> -->
																					<select name="tue_shift_end" id="tue_shift_end" class="tue_shift_end form-select">
																						<option value="">Select Time</option>
																						<option value="00:00">12:00 AM</option>
																						<option value="00:15">12:15 AM</option>
																						<option value="00:30">12:30 AM</option>
																						<option value="00:45">12:45 AM</option>
																						<option value="01:00">01:00 AM</option>
																						<option value="01:15">01:15 AM</option>
																						<option value="01:30">01:30 AM</option>
																						<option value="01:45">01:45 AM</option>
																						<option value="02:00">02:00 AM</option>
																						<option value="02:15">02:15 AM</option>
																						<option value="02:30">02:30 AM</option>
																						<option value="02:45">02:45 AM</option>
																						<option value="03:00">03:00 AM</option>
																						<option value="03:15">03:15 AM</option>
																						<option value="03:30">03:30 AM</option>
																						<option value="03:45">03:45 AM</option>
																						<option value="04:00">04:00 AM</option>
																						<option value="04:15">04:15 AM</option>
																						<option value="04:30">04:30 AM</option>
																						<option value="04:45">04:45 AM</option>
																						<option value="05:00">05:00 AM</option>
																						<option value="05:15">05:15 AM</option>
																						<option value="05:30">05:30 AM</option>
																						<option value="05:45">05:45 AM</option>
																						<option value="06:00">06:00 AM</option>
																						<option value="06:15">06:15 AM</option>
																						<option value="06:30">06:30 AM</option>
																						<option value="06:45">06:45 AM</option>
																						<option value="07:00">07:00 AM</option>
																						<option value="07:15">07:15 AM</option>
																						<option value="07:30">07:30 AM</option>
																						<option value="07:45">07:45 AM</option>
																						<option value="08:00">08:00 AM</option>
																						<option value="08:15">08:15 AM</option>
																						<option value="08:30">08:30 AM</option>
																						<option value="08:45">08:45 AM</option>
																						<option value="09:00">09:00 AM</option>
																						<option value="09:15">09:15 AM</option>
																						<option value="09:30">09:30 AM</option>
																						<option value="09:45">09:45 AM</option>
																						<option value="10:00">10:00 AM</option>
																						<option value="10:15">10:15 AM</option>
																						<option value="10:30">10:30 AM</option>
																						<option value="10:45">10:45 AM</option>
																						<option value="11:00">11:00 AM</option>
																						<option value="11:15">11:15 AM</option>
																						<option value="11:30">11:30 AM</option>
																						<option value="11:45">11:45 AM</option>
																						<option value="12:00">12:00 PM</option>
																						<option value="12:15">12:15 PM</option>
																						<option value="12:30">12:30 PM</option>
																						<option value="12:45">12:45 PM</option>
																						<option value="13:00">01:00 PM</option>
																						<option value="13:15">01:15 PM</option>
																						<option value="13:30">01:30 PM</option>
																						<option value="13:45">01:45 PM</option>
																						<option value="14:00">02:00 PM</option>
																						<option value="14:15">02:15 PM</option>
																						<option value="14:30">02:30 PM</option>
																						<option value="14:45">02:45 PM</option>
																						<option value="15:00">03:00 PM</option>
																						<option value="15:15">03:15 PM</option>
																						<option value="15:30">03:30 PM</option>
																						<option value="15:45">03:45 PM</option>
																						<option value="16:00">04:00 PM</option>
																						<option value="16:15">04:15 PM</option>
																						<option value="16:30">04:30 PM</option>
																						<option value="16:45">04:45 PM</option>
																						<option value="17:00">05:00 PM</option>
																						<option value="17:15">05:15 PM</option>
																						<option value="17:30">05:30 PM</option>
																						<option value="17:45">05:45 PM</option>
																						<option value="18:00">06:00 PM</option>
																						<option value="18:15">06:15 PM</option>
																						<option value="18:30">06:30 PM</option>
																						<option value="18:45">06:45 PM</option>
																						<option value="19:00">07:00 PM</option>
																						<option value="19:15">07:15 PM</option>
																						<option value="19:30">07:30 PM</option>
																						<option value="19:45">07:45 PM</option>
																						<option value="20:00">08:00 PM</option>
																						<option value="20:15">08:15 PM</option>
																						<option value="20:30">08:30 PM</option>
																						<option value="20:45">08:45 PM</option>
																						<option value="21:00">09:00 PM</option>
																						<option value="21:15">09:15 PM</option>
																						<option value="21:30">09:30 PM</option>
																						<option value="21:45">09:45 PM</option>
																						<option value="22:00">10:00 PM</option>
																						<option value="22:15">10:15 PM</option>
																						<option value="22:30">10:30 PM</option>
																						<option value="22:45">10:45 PM</option>
																						<option value="23:00">11:00 PM</option>
																						<option value="23:15">11:15 PM</option>
																						<option value="23:30">11:30 PM</option>
																					</select>
																				</div>
																			</div>
																		</div>

																		<div class="row">
																			<div class="col-lg-2 col-md-3 col-sm-2 col-xs-12">	
																				<div class="form-group mb-10">
																					<label for="wed">Wednesday</label>
																				</div>
																			</div>
																			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																				<div class="form-group mb-10">
																					<select name="wed_shift_start" id="wed_shift_start" class="wed_shift_start form-select">
																						<option value="">Select Time</option>
																						<option value="00:00">12:00 AM</option>
																						<option value="00:15">12:15 AM</option>
																						<option value="00:30">12:30 AM</option>
																						<option value="00:45">12:45 AM</option>
																						<option value="01:00">01:00 AM</option>
																						<option value="01:15">01:15 AM</option>
																						<option value="01:30">01:30 AM</option>
																						<option value="01:45">01:45 AM</option>
																						<option value="02:00">02:00 AM</option>
																						<option value="02:15">02:15 AM</option>
																						<option value="02:30">02:30 AM</option>
																						<option value="02:45">02:45 AM</option>
																						<option value="03:00">03:00 AM</option>
																						<option value="03:15">03:15 AM</option>
																						<option value="03:30">03:30 AM</option>
																						<option value="03:45">03:45 AM</option>
																						<option value="04:00">04:00 AM</option>
																						<option value="04:15">04:15 AM</option>
																						<option value="04:30">04:30 AM</option>
																						<option value="04:45">04:45 AM</option>
																						<option value="05:00">05:00 AM</option>
																						<option value="05:15">05:15 AM</option>
																						<option value="05:30">05:30 AM</option>
																						<option value="05:45">05:45 AM</option>
																						<option value="06:00">06:00 AM</option>
																						<option value="06:15">06:15 AM</option>
																						<option value="06:30">06:30 AM</option>
																						<option value="06:45">06:45 AM</option>
																						<option value="07:00">07:00 AM</option>
																						<option value="07:15">07:15 AM</option>
																						<option value="07:30">07:30 AM</option>
																						<option value="07:45">07:45 AM</option>
																						<option value="08:00">08:00 AM</option>
																						<option value="08:15">08:15 AM</option>
																						<option value="08:30">08:30 AM</option>
																						<option value="08:45">08:45 AM</option>
																						<option value="09:00">09:00 AM</option>
																						<option value="09:15">09:15 AM</option>
																						<option value="09:30">09:30 AM</option>
																						<option value="09:45">09:45 AM</option>
																						<option value="10:00">10:00 AM</option>
																						<option value="10:15">10:15 AM</option>
																						<option value="10:30">10:30 AM</option>
																						<option value="10:45">10:45 AM</option>
																						<option value="11:00">11:00 AM</option>
																						<option value="11:15">11:15 AM</option>
																						<option value="11:30">11:30 AM</option>
																						<option value="11:45">11:45 AM</option>
																						<option value="12:00">12:00 PM</option>
																						<option value="12:15">12:15 PM</option>
																						<option value="12:30">12:30 PM</option>
																						<option value="12:45">12:45 PM</option>
																						<option value="13:00">01:00 PM</option>
																						<option value="13:15">01:15 PM</option>
																						<option value="13:30">01:30 PM</option>
																						<option value="13:45">01:45 PM</option>
																						<option value="14:00">02:00 PM</option>
																						<option value="14:15">02:15 PM</option>
																						<option value="14:30">02:30 PM</option>
																						<option value="14:45">02:45 PM</option>
																						<option value="15:00">03:00 PM</option>
																						<option value="15:15">03:15 PM</option>
																						<option value="15:30">03:30 PM</option>
																						<option value="15:45">03:45 PM</option>
																						<option value="16:00">04:00 PM</option>
																						<option value="16:15">04:15 PM</option>
																						<option value="16:30">04:30 PM</option>
																						<option value="16:45">04:45 PM</option>
																						<option value="17:00">05:00 PM</option>
																						<option value="17:15">05:15 PM</option>
																						<option value="17:30">05:30 PM</option>
																						<option value="17:45">05:45 PM</option>
																						<option value="18:00">06:00 PM</option>
																						<option value="18:15">06:15 PM</option>
																						<option value="18:30">06:30 PM</option>
																						<option value="18:45">06:45 PM</option>
																						<option value="19:00">07:00 PM</option>
																						<option value="19:15">07:15 PM</option>
																						<option value="19:30">07:30 PM</option>
																						<option value="19:45">07:45 PM</option>
																						<option value="20:00">08:00 PM</option>
																						<option value="20:15">08:15 PM</option>
																						<option value="20:30">08:30 PM</option>
																						<option value="20:45">08:45 PM</option>
																						<option value="21:00">09:00 PM</option>
																						<option value="21:15">09:15 PM</option>
																						<option value="21:30">09:30 PM</option>
																						<option value="21:45">09:45 PM</option>
																						<option value="22:00">10:00 PM</option>
																						<option value="22:15">10:15 PM</option>
																						<option value="22:30">10:30 PM</option>
																						<option value="22:45">10:45 PM</option>
																						<option value="23:00">11:00 PM</option>
																						<option value="23:15">11:15 PM</option>
																						<option value="23:30">11:30 PM</option>
																					</select>
																				</div>
																			</div>																				

																			<div class="col-lg-2 col-sm-2 col-md-1 col-xs-12">
																				<div class="mmb-10 form-group text-center">
																					To
																				</div>
																			</div>

																			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																				<div class="form-group mb-10">
																					<select name="wed_shift_end" id="wed_shift_end" class="wed_shift_end form-select">
																						<option value="">Select Time</option>
																						<option value="00:00">12:00 AM</option>
																						<option value="00:15">12:15 AM</option>
																						<option value="00:30">12:30 AM</option>
																						<option value="00:45">12:45 AM</option>
																						<option value="01:00">01:00 AM</option>
																						<option value="01:15">01:15 AM</option>
																						<option value="01:30">01:30 AM</option>
																						<option value="01:45">01:45 AM</option>
																						<option value="02:00">02:00 AM</option>
																						<option value="02:15">02:15 AM</option>
																						<option value="02:30">02:30 AM</option>
																						<option value="02:45">02:45 AM</option>
																						<option value="03:00">03:00 AM</option>
																						<option value="03:15">03:15 AM</option>
																						<option value="03:30">03:30 AM</option>
																						<option value="03:45">03:45 AM</option>
																						<option value="04:00">04:00 AM</option>
																						<option value="04:15">04:15 AM</option>
																						<option value="04:30">04:30 AM</option>
																						<option value="04:45">04:45 AM</option>
																						<option value="05:00">05:00 AM</option>
																						<option value="05:15">05:15 AM</option>
																						<option value="05:30">05:30 AM</option>
																						<option value="05:45">05:45 AM</option>
																						<option value="06:00">06:00 AM</option>
																						<option value="06:15">06:15 AM</option>
																						<option value="06:30">06:30 AM</option>
																						<option value="06:45">06:45 AM</option>
																						<option value="07:00">07:00 AM</option>
																						<option value="07:15">07:15 AM</option>
																						<option value="07:30">07:30 AM</option>
																						<option value="07:45">07:45 AM</option>
																						<option value="08:00">08:00 AM</option>
																						<option value="08:15">08:15 AM</option>
																						<option value="08:30">08:30 AM</option>
																						<option value="08:45">08:45 AM</option>
																						<option value="09:00">09:00 AM</option>
																						<option value="09:15">09:15 AM</option>
																						<option value="09:30">09:30 AM</option>
																						<option value="09:45">09:45 AM</option>
																						<option value="10:00">10:00 AM</option>
																						<option value="10:15">10:15 AM</option>
																						<option value="10:30">10:30 AM</option>
																						<option value="10:45">10:45 AM</option>
																						<option value="11:00">11:00 AM</option>
																						<option value="11:15">11:15 AM</option>
																						<option value="11:30">11:30 AM</option>
																						<option value="11:45">11:45 AM</option>
																						<option value="12:00">12:00 PM</option>
																						<option value="12:15">12:15 PM</option>
																						<option value="12:30">12:30 PM</option>
																						<option value="12:45">12:45 PM</option>
																						<option value="13:00">01:00 PM</option>
																						<option value="13:15">01:15 PM</option>
																						<option value="13:30">01:30 PM</option>
																						<option value="13:45">01:45 PM</option>
																						<option value="14:00">02:00 PM</option>
																						<option value="14:15">02:15 PM</option>
																						<option value="14:30">02:30 PM</option>
																						<option value="14:45">02:45 PM</option>
																						<option value="15:00">03:00 PM</option>
																						<option value="15:15">03:15 PM</option>
																						<option value="15:30">03:30 PM</option>
																						<option value="15:45">03:45 PM</option>
																						<option value="16:00">04:00 PM</option>
																						<option value="16:15">04:15 PM</option>
																						<option value="16:30">04:30 PM</option>
																						<option value="16:45">04:45 PM</option>
																						<option value="17:00">05:00 PM</option>
																						<option value="17:15">05:15 PM</option>
																						<option value="17:30">05:30 PM</option>
																						<option value="17:45">05:45 PM</option>
																						<option value="18:00">06:00 PM</option>
																						<option value="18:15">06:15 PM</option>
																						<option value="18:30">06:30 PM</option>
																						<option value="18:45">06:45 PM</option>
																						<option value="19:00">07:00 PM</option>
																						<option value="19:15">07:15 PM</option>
																						<option value="19:30">07:30 PM</option>
																						<option value="19:45">07:45 PM</option>
																						<option value="20:00">08:00 PM</option>
																						<option value="20:15">08:15 PM</option>
																						<option value="20:30">08:30 PM</option>
																						<option value="20:45">08:45 PM</option>
																						<option value="21:00">09:00 PM</option>
																						<option value="21:15">09:15 PM</option>
																						<option value="21:30">09:30 PM</option>
																						<option value="21:45">09:45 PM</option>
																						<option value="22:00">10:00 PM</option>
																						<option value="22:15">10:15 PM</option>
																						<option value="22:30">10:30 PM</option>
																						<option value="22:45">10:45 PM</option>
																						<option value="23:00">11:00 PM</option>
																						<option value="23:15">11:15 PM</option>
																						<option value="23:30">11:30 PM</option>
																					</select>
																				</div>
																			</div>
																		</div>

																		<div class="row">
																			<div class="col-lg-2 col-md-3 col-sm-2 col-xs-12">
																				<div class="form-group mb-10">
																					<label for="thu">Thursday</label>
																				</div>
																			</div>
																			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																				<div class="form-group mb-10">
																					<!-- <input type="text" name="thu_shift_start" value="" readonly class="form-control timepicker"> -->
																					<select name="thu_shift_start" id="thu_shift_start" class="thu_shift_start form-select">
																						<option value="">Select Time</option>
																						<option value="00:00">12:00 AM</option>
																						<option value="00:15">12:15 AM</option>
																						<option value="00:30">12:30 AM</option>
																						<option value="00:45">12:45 AM</option>
																						<option value="01:00">01:00 AM</option>
																						<option value="01:15">01:15 AM</option>
																						<option value="01:30">01:30 AM</option>
																						<option value="01:45">01:45 AM</option>
																						<option value="02:00">02:00 AM</option>
																						<option value="02:15">02:15 AM</option>
																						<option value="02:30">02:30 AM</option>
																						<option value="02:45">02:45 AM</option>
																						<option value="03:00">03:00 AM</option>
																						<option value="03:15">03:15 AM</option>
																						<option value="03:30">03:30 AM</option>
																						<option value="03:45">03:45 AM</option>
																						<option value="04:00">04:00 AM</option>
																						<option value="04:15">04:15 AM</option>
																						<option value="04:30">04:30 AM</option>
																						<option value="04:45">04:45 AM</option>
																						<option value="05:00">05:00 AM</option>
																						<option value="05:15">05:15 AM</option>
																						<option value="05:30">05:30 AM</option>
																						<option value="05:45">05:45 AM</option>
																						<option value="06:00">06:00 AM</option>
																						<option value="06:15">06:15 AM</option>
																						<option value="06:30">06:30 AM</option>
																						<option value="06:45">06:45 AM</option>
																						<option value="07:00">07:00 AM</option>
																						<option value="07:15">07:15 AM</option>
																						<option value="07:30">07:30 AM</option>
																						<option value="07:45">07:45 AM</option>
																						<option value="08:00">08:00 AM</option>
																						<option value="08:15">08:15 AM</option>
																						<option value="08:30">08:30 AM</option>
																						<option value="08:45">08:45 AM</option>
																						<option value="09:00">09:00 AM</option>
																						<option value="09:15">09:15 AM</option>
																						<option value="09:30">09:30 AM</option>
																						<option value="09:45">09:45 AM</option>
																						<option value="10:00">10:00 AM</option>
																						<option value="10:15">10:15 AM</option>
																						<option value="10:30">10:30 AM</option>
																						<option value="10:45">10:45 AM</option>
																						<option value="11:00">11:00 AM</option>
																						<option value="11:15">11:15 AM</option>
																						<option value="11:30">11:30 AM</option>
																						<option value="11:45">11:45 AM</option>
																						<option value="12:00">12:00 PM</option>
																						<option value="12:15">12:15 PM</option>
																						<option value="12:30">12:30 PM</option>
																						<option value="12:45">12:45 PM</option>
																						<option value="13:00">01:00 PM</option>
																						<option value="13:15">01:15 PM</option>
																						<option value="13:30">01:30 PM</option>
																						<option value="13:45">01:45 PM</option>
																						<option value="14:00">02:00 PM</option>
																						<option value="14:15">02:15 PM</option>
																						<option value="14:30">02:30 PM</option>
																						<option value="14:45">02:45 PM</option>
																						<option value="15:00">03:00 PM</option>
																						<option value="15:15">03:15 PM</option>
																						<option value="15:30">03:30 PM</option>
																						<option value="15:45">03:45 PM</option>
																						<option value="16:00">04:00 PM</option>
																						<option value="16:15">04:15 PM</option>
																						<option value="16:30">04:30 PM</option>
																						<option value="16:45">04:45 PM</option>
																						<option value="17:00">05:00 PM</option>
																						<option value="17:15">05:15 PM</option>
																						<option value="17:30">05:30 PM</option>
																						<option value="17:45">05:45 PM</option>
																						<option value="18:00">06:00 PM</option>
																						<option value="18:15">06:15 PM</option>
																						<option value="18:30">06:30 PM</option>
																						<option value="18:45">06:45 PM</option>
																						<option value="19:00">07:00 PM</option>
																						<option value="19:15">07:15 PM</option>
																						<option value="19:30">07:30 PM</option>
																						<option value="19:45">07:45 PM</option>
																						<option value="20:00">08:00 PM</option>
																						<option value="20:15">08:15 PM</option>
																						<option value="20:30">08:30 PM</option>
																						<option value="20:45">08:45 PM</option>
																						<option value="21:00">09:00 PM</option>
																						<option value="21:15">09:15 PM</option>
																						<option value="21:30">09:30 PM</option>
																						<option value="21:45">09:45 PM</option>
																						<option value="22:00">10:00 PM</option>
																						<option value="22:15">10:15 PM</option>
																						<option value="22:30">10:30 PM</option>
																						<option value="22:45">10:45 PM</option>
																						<option value="23:00">11:00 PM</option>
																						<option value="23:15">11:15 PM</option>
																						<option value="23:30">11:30 PM</option>
																					</select>
																				</div>
																			</div>
																			
																			<div class="col-lg-2 col-sm-2 col-md-1 col-xs-12">
																				<div class="mmb-10 form-group text-center">
																					To
																				</div>
																			</div>
																			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																				<div class="form-group mb-10">
																					<select name="thu_shift_end" id="thu_shift_end" class="thu_shift_end form-select">
																						<option value="">Select Time</option>
																						<option value="00:00">12:00 AM</option>
																						<option value="00:15">12:15 AM</option>
																						<option value="00:30">12:30 AM</option>
																						<option value="00:45">12:45 AM</option>
																						<option value="01:00">01:00 AM</option>
																						<option value="01:15">01:15 AM</option>
																						<option value="01:30">01:30 AM</option>
																						<option value="01:45">01:45 AM</option>
																						<option value="02:00">02:00 AM</option>
																						<option value="02:15">02:15 AM</option>
																						<option value="02:30">02:30 AM</option>
																						<option value="02:45">02:45 AM</option>
																						<option value="03:00">03:00 AM</option>
																						<option value="03:15">03:15 AM</option>
																						<option value="03:30">03:30 AM</option>
																						<option value="03:45">03:45 AM</option>
																						<option value="04:00">04:00 AM</option>
																						<option value="04:15">04:15 AM</option>
																						<option value="04:30">04:30 AM</option>
																						<option value="04:45">04:45 AM</option>
																						<option value="05:00">05:00 AM</option>
																						<option value="05:15">05:15 AM</option>
																						<option value="05:30">05:30 AM</option>
																						<option value="05:45">05:45 AM</option>
																						<option value="06:00">06:00 AM</option>
																						<option value="06:15">06:15 AM</option>
																						<option value="06:30">06:30 AM</option>
																						<option value="06:45">06:45 AM</option>
																						<option value="07:00">07:00 AM</option>
																						<option value="07:15">07:15 AM</option>
																						<option value="07:30">07:30 AM</option>
																						<option value="07:45">07:45 AM</option>
																						<option value="08:00">08:00 AM</option>
																						<option value="08:15">08:15 AM</option>
																						<option value="08:30">08:30 AM</option>
																						<option value="08:45">08:45 AM</option>
																						<option value="09:00">09:00 AM</option>
																						<option value="09:15">09:15 AM</option>
																						<option value="09:30">09:30 AM</option>
																						<option value="09:45">09:45 AM</option>
																						<option value="10:00">10:00 AM</option>
																						<option value="10:15">10:15 AM</option>
																						<option value="10:30">10:30 AM</option>
																						<option value="10:45">10:45 AM</option>
																						<option value="11:00">11:00 AM</option>
																						<option value="11:15">11:15 AM</option>
																						<option value="11:30">11:30 AM</option>
																						<option value="11:45">11:45 AM</option>
																						<option value="12:00">12:00 PM</option>
																						<option value="12:15">12:15 PM</option>
																						<option value="12:30">12:30 PM</option>
																						<option value="12:45">12:45 PM</option>
																						<option value="13:00">01:00 PM</option>
																						<option value="13:15">01:15 PM</option>
																						<option value="13:30">01:30 PM</option>
																						<option value="13:45">01:45 PM</option>
																						<option value="14:00">02:00 PM</option>
																						<option value="14:15">02:15 PM</option>
																						<option value="14:30">02:30 PM</option>
																						<option value="14:45">02:45 PM</option>
																						<option value="15:00">03:00 PM</option>
																						<option value="15:15">03:15 PM</option>
																						<option value="15:30">03:30 PM</option>
																						<option value="15:45">03:45 PM</option>
																						<option value="16:00">04:00 PM</option>
																						<option value="16:15">04:15 PM</option>
																						<option value="16:30">04:30 PM</option>
																						<option value="16:45">04:45 PM</option>
																						<option value="17:00">05:00 PM</option>
																						<option value="17:15">05:15 PM</option>
																						<option value="17:30">05:30 PM</option>
																						<option value="17:45">05:45 PM</option>
																						<option value="18:00">06:00 PM</option>
																						<option value="18:15">06:15 PM</option>
																						<option value="18:30">06:30 PM</option>
																						<option value="18:45">06:45 PM</option>
																						<option value="19:00">07:00 PM</option>
																						<option value="19:15">07:15 PM</option>
																						<option value="19:30">07:30 PM</option>
																						<option value="19:45">07:45 PM</option>
																						<option value="20:00">08:00 PM</option>
																						<option value="20:15">08:15 PM</option>
																						<option value="20:30">08:30 PM</option>
																						<option value="20:45">08:45 PM</option>
																						<option value="21:00">09:00 PM</option>
																						<option value="21:15">09:15 PM</option>
																						<option value="21:30">09:30 PM</option>
																						<option value="21:45">09:45 PM</option>
																						<option value="22:00">10:00 PM</option>
																						<option value="22:15">10:15 PM</option>
																						<option value="22:30">10:30 PM</option>
																						<option value="22:45">10:45 PM</option>
																						<option value="23:00">11:00 PM</option>
																						<option value="23:15">11:15 PM</option>
																						<option value="23:30">11:30 PM</option>
																					</select>
																				</div>
																			</div>
																		</div>
																		
																		<div class="row">
																			<div class="col-lg-2 col-md-3 col-sm-2 col-xs-12">
																				<div class="form-group mb-10">
																					<label for="fri">Friday</label>
																				</div>
																			</div>
																			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																				<div class="form-group mb-10">
																					<select name="fri_shift_start" id="fri_shift_start" class="fri_shift_start form-select">
																						<option value="">Select Time</option>
																						<option value="00:00">12:00 AM</option>
																						<option value="00:15">12:15 AM</option>
																						<option value="00:30">12:30 AM</option>
																						<option value="00:45">12:45 AM</option>
																						<option value="01:00">01:00 AM</option>
																						<option value="01:15">01:15 AM</option>
																						<option value="01:30">01:30 AM</option>
																						<option value="01:45">01:45 AM</option>
																						<option value="02:00">02:00 AM</option>
																						<option value="02:15">02:15 AM</option>
																						<option value="02:30">02:30 AM</option>
																						<option value="02:45">02:45 AM</option>
																						<option value="03:00">03:00 AM</option>
																						<option value="03:15">03:15 AM</option>
																						<option value="03:30">03:30 AM</option>
																						<option value="03:45">03:45 AM</option>
																						<option value="04:00">04:00 AM</option>
																						<option value="04:15">04:15 AM</option>
																						<option value="04:30">04:30 AM</option>
																						<option value="04:45">04:45 AM</option>
																						<option value="05:00">05:00 AM</option>
																						<option value="05:15">05:15 AM</option>
																						<option value="05:30">05:30 AM</option>
																						<option value="05:45">05:45 AM</option>
																						<option value="06:00">06:00 AM</option>
																						<option value="06:15">06:15 AM</option>
																						<option value="06:30">06:30 AM</option>
																						<option value="06:45">06:45 AM</option>
																						<option value="07:00">07:00 AM</option>
																						<option value="07:15">07:15 AM</option>
																						<option value="07:30">07:30 AM</option>
																						<option value="07:45">07:45 AM</option>
																						<option value="08:00">08:00 AM</option>
																						<option value="08:15">08:15 AM</option>
																						<option value="08:30">08:30 AM</option>
																						<option value="08:45">08:45 AM</option>
																						<option value="09:00">09:00 AM</option>
																						<option value="09:15">09:15 AM</option>
																						<option value="09:30">09:30 AM</option>
																						<option value="09:45">09:45 AM</option>
																						<option value="10:00">10:00 AM</option>
																						<option value="10:15">10:15 AM</option>
																						<option value="10:30">10:30 AM</option>
																						<option value="10:45">10:45 AM</option>
																						<option value="11:00">11:00 AM</option>
																						<option value="11:15">11:15 AM</option>
																						<option value="11:30">11:30 AM</option>
																						<option value="11:45">11:45 AM</option>
																						<option value="12:00">12:00 PM</option>
																						<option value="12:15">12:15 PM</option>
																						<option value="12:30">12:30 PM</option>
																						<option value="12:45">12:45 PM</option>
																						<option value="13:00">01:00 PM</option>
																						<option value="13:15">01:15 PM</option>
																						<option value="13:30">01:30 PM</option>
																						<option value="13:45">01:45 PM</option>
																						<option value="14:00">02:00 PM</option>
																						<option value="14:15">02:15 PM</option>
																						<option value="14:30">02:30 PM</option>
																						<option value="14:45">02:45 PM</option>
																						<option value="15:00">03:00 PM</option>
																						<option value="15:15">03:15 PM</option>
																						<option value="15:30">03:30 PM</option>
																						<option value="15:45">03:45 PM</option>
																						<option value="16:00">04:00 PM</option>
																						<option value="16:15">04:15 PM</option>
																						<option value="16:30">04:30 PM</option>
																						<option value="16:45">04:45 PM</option>
																						<option value="17:00">05:00 PM</option>
																						<option value="17:15">05:15 PM</option>
																						<option value="17:30">05:30 PM</option>
																						<option value="17:45">05:45 PM</option>
																						<option value="18:00">06:00 PM</option>
																						<option value="18:15">06:15 PM</option>
																						<option value="18:30">06:30 PM</option>
																						<option value="18:45">06:45 PM</option>
																						<option value="19:00">07:00 PM</option>
																						<option value="19:15">07:15 PM</option>
																						<option value="19:30">07:30 PM</option>
																						<option value="19:45">07:45 PM</option>
																						<option value="20:00">08:00 PM</option>
																						<option value="20:15">08:15 PM</option>
																						<option value="20:30">08:30 PM</option>
																						<option value="20:45">08:45 PM</option>
																						<option value="21:00">09:00 PM</option>
																						<option value="21:15">09:15 PM</option>
																						<option value="21:30">09:30 PM</option>
																						<option value="21:45">09:45 PM</option>
																						<option value="22:00">10:00 PM</option>
																						<option value="22:15">10:15 PM</option>
																						<option value="22:30">10:30 PM</option>
																						<option value="22:45">10:45 PM</option>
																						<option value="23:00">11:00 PM</option>
																						<option value="23:15">11:15 PM</option>
																						<option value="23:30">11:30 PM</option>
																					</select>
																				</div>
																			</div>
																				
																			<div class="col-lg-2 col-sm-2 col-md-1 col-xs-12">
																				<div class="mmb-10 form-group text-center">
																					To
																				</div>
																			</div>

																			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																				<div class="form-group mb-10">
																					<select name="fri_shift_end" id="fri_shift_end" class="fri_shift_end form-select">
																						<option value="">Select Time</option>
																						<option value="00:00">12:00 AM</option>
																						<option value="00:15">12:15 AM</option>
																						<option value="00:30">12:30 AM</option>
																						<option value="00:45">12:45 AM</option>
																						<option value="01:00">01:00 AM</option>
																						<option value="01:15">01:15 AM</option>
																						<option value="01:30">01:30 AM</option>
																						<option value="01:45">01:45 AM</option>
																						<option value="02:00">02:00 AM</option>
																						<option value="02:15">02:15 AM</option>
																						<option value="02:30">02:30 AM</option>
																						<option value="02:45">02:45 AM</option>
																						<option value="03:00">03:00 AM</option>
																						<option value="03:15">03:15 AM</option>
																						<option value="03:30">03:30 AM</option>
																						<option value="03:45">03:45 AM</option>
																						<option value="04:00">04:00 AM</option>
																						<option value="04:15">04:15 AM</option>
																						<option value="04:30">04:30 AM</option>
																						<option value="04:45">04:45 AM</option>
																						<option value="05:00">05:00 AM</option>
																						<option value="05:15">05:15 AM</option>
																						<option value="05:30">05:30 AM</option>
																						<option value="05:45">05:45 AM</option>
																						<option value="06:00">06:00 AM</option>
																						<option value="06:15">06:15 AM</option>
																						<option value="06:30">06:30 AM</option>
																						<option value="06:45">06:45 AM</option>
																						<option value="07:00">07:00 AM</option>
																						<option value="07:15">07:15 AM</option>
																						<option value="07:30">07:30 AM</option>
																						<option value="07:45">07:45 AM</option>
																						<option value="08:00">08:00 AM</option>
																						<option value="08:15">08:15 AM</option>
																						<option value="08:30">08:30 AM</option>
																						<option value="08:45">08:45 AM</option>
																						<option value="09:00">09:00 AM</option>
																						<option value="09:15">09:15 AM</option>
																						<option value="09:30">09:30 AM</option>
																						<option value="09:45">09:45 AM</option>
																						<option value="10:00">10:00 AM</option>
																						<option value="10:15">10:15 AM</option>
																						<option value="10:30">10:30 AM</option>
																						<option value="10:45">10:45 AM</option>
																						<option value="11:00">11:00 AM</option>
																						<option value="11:15">11:15 AM</option>
																						<option value="11:30">11:30 AM</option>
																						<option value="11:45">11:45 AM</option>
																						<option value="12:00">12:00 PM</option>
																						<option value="12:15">12:15 PM</option>
																						<option value="12:30">12:30 PM</option>
																						<option value="12:45">12:45 PM</option>
																						<option value="13:00">01:00 PM</option>
																						<option value="13:15">01:15 PM</option>
																						<option value="13:30">01:30 PM</option>
																						<option value="13:45">01:45 PM</option>
																						<option value="14:00">02:00 PM</option>
																						<option value="14:15">02:15 PM</option>
																						<option value="14:30">02:30 PM</option>
																						<option value="14:45">02:45 PM</option>
																						<option value="15:00">03:00 PM</option>
																						<option value="15:15">03:15 PM</option>
																						<option value="15:30">03:30 PM</option>
																						<option value="15:45">03:45 PM</option>
																						<option value="16:00">04:00 PM</option>
																						<option value="16:15">04:15 PM</option>
																						<option value="16:30">04:30 PM</option>
																						<option value="16:45">04:45 PM</option>
																						<option value="17:00">05:00 PM</option>
																						<option value="17:15">05:15 PM</option>
																						<option value="17:30">05:30 PM</option>
																						<option value="17:45">05:45 PM</option>
																						<option value="18:00">06:00 PM</option>
																						<option value="18:15">06:15 PM</option>
																						<option value="18:30">06:30 PM</option>
																						<option value="18:45">06:45 PM</option>
																						<option value="19:00">07:00 PM</option>
																						<option value="19:15">07:15 PM</option>
																						<option value="19:30">07:30 PM</option>
																						<option value="19:45">07:45 PM</option>
																						<option value="20:00">08:00 PM</option>
																						<option value="20:15">08:15 PM</option>
																						<option value="20:30">08:30 PM</option>
																						<option value="20:45">08:45 PM</option>
																						<option value="21:00">09:00 PM</option>
																						<option value="21:15">09:15 PM</option>
																						<option value="21:30">09:30 PM</option>
																						<option value="21:45">09:45 PM</option>
																						<option value="22:00">10:00 PM</option>
																						<option value="22:15">10:15 PM</option>
																						<option value="22:30">10:30 PM</option>
																						<option value="22:45">10:45 PM</option>
																						<option value="23:00">11:00 PM</option>
																						<option value="23:15">11:15 PM</option>
																						<option value="23:30">11:30 PM</option>
																					</select>
																				</div>
																			</div>
																		</div>

																		<div class="row">
																			<div class="col-lg-2 col-md-3 col-sm-2 col-xs-12">
																				<div class="form-group mb-10">
																					<label for="sat">Saturday</label>
																				</div>
																			</div>

																			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																				<div class="form-group mb-10">
																					<select name="sat_shift_start" id="sat_shift_start" class="sat_shift_start form-select">
																						<option value="">Select Time</option>
																						<option value="00:00">12:00 AM</option>
																						<option value="00:15">12:15 AM</option>
																						<option value="00:30">12:30 AM</option>
																						<option value="00:45">12:45 AM</option>
																						<option value="01:00">01:00 AM</option>
																						<option value="01:15">01:15 AM</option>
																						<option value="01:30">01:30 AM</option>
																						<option value="01:45">01:45 AM</option>
																						<option value="02:00">02:00 AM</option>
																						<option value="02:15">02:15 AM</option>
																						<option value="02:30">02:30 AM</option>
																						<option value="02:45">02:45 AM</option>
																						<option value="03:00">03:00 AM</option>
																						<option value="03:15">03:15 AM</option>
																						<option value="03:30">03:30 AM</option>
																						<option value="03:45">03:45 AM</option>
																						<option value="04:00">04:00 AM</option>
																						<option value="04:15">04:15 AM</option>
																						<option value="04:30">04:30 AM</option>
																						<option value="04:45">04:45 AM</option>
																						<option value="05:00">05:00 AM</option>
																						<option value="05:15">05:15 AM</option>
																						<option value="05:30">05:30 AM</option>
																						<option value="05:45">05:45 AM</option>
																						<option value="06:00">06:00 AM</option>
																						<option value="06:15">06:15 AM</option>
																						<option value="06:30">06:30 AM</option>
																						<option value="06:45">06:45 AM</option>
																						<option value="07:00">07:00 AM</option>
																						<option value="07:15">07:15 AM</option>
																						<option value="07:30">07:30 AM</option>
																						<option value="07:45">07:45 AM</option>
																						<option value="08:00">08:00 AM</option>
																						<option value="08:15">08:15 AM</option>
																						<option value="08:30">08:30 AM</option>
																						<option value="08:45">08:45 AM</option>
																						<option value="09:00">09:00 AM</option>
																						<option value="09:15">09:15 AM</option>
																						<option value="09:30">09:30 AM</option>
																						<option value="09:45">09:45 AM</option>
																						<option value="10:00">10:00 AM</option>
																						<option value="10:15">10:15 AM</option>
																						<option value="10:30">10:30 AM</option>
																						<option value="10:45">10:45 AM</option>
																						<option value="11:00">11:00 AM</option>
																						<option value="11:15">11:15 AM</option>
																						<option value="11:30">11:30 AM</option>
																						<option value="11:45">11:45 AM</option>
																						<option value="12:00">12:00 PM</option>
																						<option value="12:15">12:15 PM</option>
																						<option value="12:30">12:30 PM</option>
																						<option value="12:45">12:45 PM</option>
																						<option value="13:00">01:00 PM</option>
																						<option value="13:15">01:15 PM</option>
																						<option value="13:30">01:30 PM</option>
																						<option value="13:45">01:45 PM</option>
																						<option value="14:00">02:00 PM</option>
																						<option value="14:15">02:15 PM</option>
																						<option value="14:30">02:30 PM</option>
																						<option value="14:45">02:45 PM</option>
																						<option value="15:00">03:00 PM</option>
																						<option value="15:15">03:15 PM</option>
																						<option value="15:30">03:30 PM</option>
																						<option value="15:45">03:45 PM</option>
																						<option value="16:00">04:00 PM</option>
																						<option value="16:15">04:15 PM</option>
																						<option value="16:30">04:30 PM</option>
																						<option value="16:45">04:45 PM</option>
																						<option value="17:00">05:00 PM</option>
																						<option value="17:15">05:15 PM</option>
																						<option value="17:30">05:30 PM</option>
																						<option value="17:45">05:45 PM</option>
																						<option value="18:00">06:00 PM</option>
																						<option value="18:15">06:15 PM</option>
																						<option value="18:30">06:30 PM</option>
																						<option value="18:45">06:45 PM</option>
																						<option value="19:00">07:00 PM</option>
																						<option value="19:15">07:15 PM</option>
																						<option value="19:30">07:30 PM</option>
																						<option value="19:45">07:45 PM</option>
																						<option value="20:00">08:00 PM</option>
																						<option value="20:15">08:15 PM</option>
																						<option value="20:30">08:30 PM</option>
																						<option value="20:45">08:45 PM</option>
																						<option value="21:00">09:00 PM</option>
																						<option value="21:15">09:15 PM</option>
																						<option value="21:30">09:30 PM</option>
																						<option value="21:45">09:45 PM</option>
																						<option value="22:00">10:00 PM</option>
																						<option value="22:15">10:15 PM</option>
																						<option value="22:30">10:30 PM</option>
																						<option value="22:45">10:45 PM</option>
																						<option value="23:00">11:00 PM</option>
																						<option value="23:15">11:15 PM</option>
																						<option value="23:30">11:30 PM</option>
																					</select>
																				</div>
																			</div>
																				
																			<div class="col-lg-2 col-md-1 col-sm-2 col-xs-12">
																				<div class="mmb-10 form-group text-center">
																					To
																				</div>
																			</div>

																			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																				<div class="form-group mb-10">
																					<select name="sat_shift_end" id="sat_shift_end" class="sat_shift_end form-select">
																						<option value="">Select Time</option>
																						<option value="00:00">12:00 AM</option>
																						<option value="00:15">12:15 AM</option>
																						<option value="00:30">12:30 AM</option>
																						<option value="00:45">12:45 AM</option>
																						<option value="01:00">01:00 AM</option>
																						<option value="01:15">01:15 AM</option>
																						<option value="01:30">01:30 AM</option>
																						<option value="01:45">01:45 AM</option>
																						<option value="02:00">02:00 AM</option>
																						<option value="02:15">02:15 AM</option>
																						<option value="02:30">02:30 AM</option>
																						<option value="02:45">02:45 AM</option>
																						<option value="03:00">03:00 AM</option>
																						<option value="03:15">03:15 AM</option>
																						<option value="03:30">03:30 AM</option>
																						<option value="03:45">03:45 AM</option>
																						<option value="04:00">04:00 AM</option>
																						<option value="04:15">04:15 AM</option>
																						<option value="04:30">04:30 AM</option>
																						<option value="04:45">04:45 AM</option>
																						<option value="05:00">05:00 AM</option>
																						<option value="05:15">05:15 AM</option>
																						<option value="05:30">05:30 AM</option>
																						<option value="05:45">05:45 AM</option>
																						<option value="06:00">06:00 AM</option>
																						<option value="06:15">06:15 AM</option>
																						<option value="06:30">06:30 AM</option>
																						<option value="06:45">06:45 AM</option>
																						<option value="07:00">07:00 AM</option>
																						<option value="07:15">07:15 AM</option>
																						<option value="07:30">07:30 AM</option>
																						<option value="07:45">07:45 AM</option>
																						<option value="08:00">08:00 AM</option>
																						<option value="08:15">08:15 AM</option>
																						<option value="08:30">08:30 AM</option>
																						<option value="08:45">08:45 AM</option>
																						<option value="09:00">09:00 AM</option>
																						<option value="09:15">09:15 AM</option>
																						<option value="09:30">09:30 AM</option>
																						<option value="09:45">09:45 AM</option>
																						<option value="10:00">10:00 AM</option>
																						<option value="10:15">10:15 AM</option>
																						<option value="10:30">10:30 AM</option>
																						<option value="10:45">10:45 AM</option>
																						<option value="11:00">11:00 AM</option>
																						<option value="11:15">11:15 AM</option>
																						<option value="11:30">11:30 AM</option>
																						<option value="11:45">11:45 AM</option>
																						<option value="12:00">12:00 PM</option>
																						<option value="12:15">12:15 PM</option>
																						<option value="12:30">12:30 PM</option>
																						<option value="12:45">12:45 PM</option>
																						<option value="13:00">01:00 PM</option>
																						<option value="13:15">01:15 PM</option>
																						<option value="13:30">01:30 PM</option>
																						<option value="13:45">01:45 PM</option>
																						<option value="14:00">02:00 PM</option>
																						<option value="14:15">02:15 PM</option>
																						<option value="14:30">02:30 PM</option>
																						<option value="14:45">02:45 PM</option>
																						<option value="15:00">03:00 PM</option>
																						<option value="15:15">03:15 PM</option>
																						<option value="15:30">03:30 PM</option>
																						<option value="15:45">03:45 PM</option>
																						<option value="16:00">04:00 PM</option>
																						<option value="16:15">04:15 PM</option>
																						<option value="16:30">04:30 PM</option>
																						<option value="16:45">04:45 PM</option>
																						<option value="17:00">05:00 PM</option>
																						<option value="17:15">05:15 PM</option>
																						<option value="17:30">05:30 PM</option>
																						<option value="17:45">05:45 PM</option>
																						<option value="18:00">06:00 PM</option>
																						<option value="18:15">06:15 PM</option>
																						<option value="18:30">06:30 PM</option>
																						<option value="18:45">06:45 PM</option>
																						<option value="19:00">07:00 PM</option>
																						<option value="19:15">07:15 PM</option>
																						<option value="19:30">07:30 PM</option>
																						<option value="19:45">07:45 PM</option>
																						<option value="20:00">08:00 PM</option>
																						<option value="20:15">08:15 PM</option>
																						<option value="20:30">08:30 PM</option>
																						<option value="20:45">08:45 PM</option>
																						<option value="21:00">09:00 PM</option>
																						<option value="21:15">09:15 PM</option>
																						<option value="21:30">09:30 PM</option>
																						<option value="21:45">09:45 PM</option>
																						<option value="22:00">10:00 PM</option>
																						<option value="22:15">10:15 PM</option>
																						<option value="22:30">10:30 PM</option>
																						<option value="22:45">10:45 PM</option>
																						<option value="23:00">11:00 PM</option>
																						<option value="23:15">11:15 PM</option>
																						<option value="23:30">11:30 PM</option>
																					</select>
																				</div>
																			</div>
																		</div>

																		<div class="row">
																			<div class="col-lg-2 col-md-3 col-sm-2 col-xs-12">
																				<div class="form-group mb-10">
																					<label for="sun">Sunday</label>
																				</div>
																			</div>

																			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																				<div class="form-group mb-10">
																					<select name="sun_shift_start" id="sun_shift_start" class="sun_shift_start form-select">
																						<option value="">Select Time</option>
																						<option value="00:00">12:00 AM</option>
																						<option value="00:15">12:15 AM</option>
																						<option value="00:30">12:30 AM</option>
																						<option value="00:45">12:45 AM</option>
																						<option value="01:00">01:00 AM</option>
																						<option value="01:15">01:15 AM</option>
																						<option value="01:30">01:30 AM</option>
																						<option value="01:45">01:45 AM</option>
																						<option value="02:00">02:00 AM</option>
																						<option value="02:15">02:15 AM</option>
																						<option value="02:30">02:30 AM</option>
																						<option value="02:45">02:45 AM</option>
																						<option value="03:00">03:00 AM</option>
																						<option value="03:15">03:15 AM</option>
																						<option value="03:30">03:30 AM</option>
																						<option value="03:45">03:45 AM</option>
																						<option value="04:00">04:00 AM</option>
																						<option value="04:15">04:15 AM</option>
																						<option value="04:30">04:30 AM</option>
																						<option value="04:45">04:45 AM</option>
																						<option value="05:00">05:00 AM</option>
																						<option value="05:15">05:15 AM</option>
																						<option value="05:30">05:30 AM</option>
																						<option value="05:45">05:45 AM</option>
																						<option value="06:00">06:00 AM</option>
																						<option value="06:15">06:15 AM</option>
																						<option value="06:30">06:30 AM</option>
																						<option value="06:45">06:45 AM</option>
																						<option value="07:00">07:00 AM</option>
																						<option value="07:15">07:15 AM</option>
																						<option value="07:30">07:30 AM</option>
																						<option value="07:45">07:45 AM</option>
																						<option value="08:00">08:00 AM</option>
																						<option value="08:15">08:15 AM</option>
																						<option value="08:30">08:30 AM</option>
																						<option value="08:45">08:45 AM</option>
																						<option value="09:00">09:00 AM</option>
																						<option value="09:15">09:15 AM</option>
																						<option value="09:30">09:30 AM</option>
																						<option value="09:45">09:45 AM</option>
																						<option value="10:00">10:00 AM</option>
																						<option value="10:15">10:15 AM</option>
																						<option value="10:30">10:30 AM</option>
																						<option value="10:45">10:45 AM</option>
																						<option value="11:00">11:00 AM</option>
																						<option value="11:15">11:15 AM</option>
																						<option value="11:30">11:30 AM</option>
																						<option value="11:45">11:45 AM</option>
																						<option value="12:00">12:00 PM</option>
																						<option value="12:15">12:15 PM</option>
																						<option value="12:30">12:30 PM</option>
																						<option value="12:45">12:45 PM</option>
																						<option value="13:00">01:00 PM</option>
																						<option value="13:15">01:15 PM</option>
																						<option value="13:30">01:30 PM</option>
																						<option value="13:45">01:45 PM</option>
																						<option value="14:00">02:00 PM</option>
																						<option value="14:15">02:15 PM</option>
																						<option value="14:30">02:30 PM</option>
																						<option value="14:45">02:45 PM</option>
																						<option value="15:00">03:00 PM</option>
																						<option value="15:15">03:15 PM</option>
																						<option value="15:30">03:30 PM</option>
																						<option value="15:45">03:45 PM</option>
																						<option value="16:00">04:00 PM</option>
																						<option value="16:15">04:15 PM</option>
																						<option value="16:30">04:30 PM</option>
																						<option value="16:45">04:45 PM</option>
																						<option value="17:00">05:00 PM</option>
																						<option value="17:15">05:15 PM</option>
																						<option value="17:30">05:30 PM</option>
																						<option value="17:45">05:45 PM</option>
																						<option value="18:00">06:00 PM</option>
																						<option value="18:15">06:15 PM</option>
																						<option value="18:30">06:30 PM</option>
																						<option value="18:45">06:45 PM</option>
																						<option value="19:00">07:00 PM</option>
																						<option value="19:15">07:15 PM</option>
																						<option value="19:30">07:30 PM</option>
																						<option value="19:45">07:45 PM</option>
																						<option value="20:00">08:00 PM</option>
																						<option value="20:15">08:15 PM</option>
																						<option value="20:30">08:30 PM</option>
																						<option value="20:45">08:45 PM</option>
																						<option value="21:00">09:00 PM</option>
																						<option value="21:15">09:15 PM</option>
																						<option value="21:30">09:30 PM</option>
																						<option value="21:45">09:45 PM</option>
																						<option value="22:00">10:00 PM</option>
																						<option value="22:15">10:15 PM</option>
																						<option value="22:30">10:30 PM</option>
																						<option value="22:45">10:45 PM</option>
																						<option value="23:00">11:00 PM</option>
																						<option value="23:15">11:15 PM</option>
																						<option value="23:30">11:30 PM</option>
																					</select>
																				</div>
																			</div>
																				
																			<div class="col-lg-2 col-sm-2 col-md-1 col-xs-12">
																				<div class="mmb-10 form-group text-center">
																					To
																				</div>
																			</div>

																			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
																				<div class="form-group mb-10">
																					<select name="sun_shift_end" id="sun_shift_end" class="sun_shift_end form-select">
																						<option value="">Select Time</option>
																						<option value="00:00">12:00 AM</option>
																						<option value="00:15">12:15 AM</option>
																						<option value="00:30">12:30 AM</option>
																						<option value="00:45">12:45 AM</option>
																						<option value="01:00">01:00 AM</option>
																						<option value="01:15">01:15 AM</option>
																						<option value="01:30">01:30 AM</option>
																						<option value="01:45">01:45 AM</option>
																						<option value="02:00">02:00 AM</option>
																						<option value="02:15">02:15 AM</option>
																						<option value="02:30">02:30 AM</option>
																						<option value="02:45">02:45 AM</option>
																						<option value="03:00">03:00 AM</option>
																						<option value="03:15">03:15 AM</option>
																						<option value="03:30">03:30 AM</option>
																						<option value="03:45">03:45 AM</option>
																						<option value="04:00">04:00 AM</option>
																						<option value="04:15">04:15 AM</option>
																						<option value="04:30">04:30 AM</option>
																						<option value="04:45">04:45 AM</option>
																						<option value="05:00">05:00 AM</option>
																						<option value="05:15">05:15 AM</option>
																						<option value="05:30">05:30 AM</option>
																						<option value="05:45">05:45 AM</option>
																						<option value="06:00">06:00 AM</option>
																						<option value="06:15">06:15 AM</option>
																						<option value="06:30">06:30 AM</option>
																						<option value="06:45">06:45 AM</option>
																						<option value="07:00">07:00 AM</option>
																						<option value="07:15">07:15 AM</option>
																						<option value="07:30">07:30 AM</option>
																						<option value="07:45">07:45 AM</option>
																						<option value="08:00">08:00 AM</option>
																						<option value="08:15">08:15 AM</option>
																						<option value="08:30">08:30 AM</option>
																						<option value="08:45">08:45 AM</option>
																						<option value="09:00">09:00 AM</option>
																						<option value="09:15">09:15 AM</option>
																						<option value="09:30">09:30 AM</option>
																						<option value="09:45">09:45 AM</option>
																						<option value="10:00">10:00 AM</option>
																						<option value="10:15">10:15 AM</option>
																						<option value="10:30">10:30 AM</option>
																						<option value="10:45">10:45 AM</option>
																						<option value="11:00">11:00 AM</option>
																						<option value="11:15">11:15 AM</option>
																						<option value="11:30">11:30 AM</option>
																						<option value="11:45">11:45 AM</option>
																						<option value="12:00">12:00 PM</option>
																						<option value="12:15">12:15 PM</option>
																						<option value="12:30">12:30 PM</option>
																						<option value="12:45">12:45 PM</option>
																						<option value="13:00">01:00 PM</option>
																						<option value="13:15">01:15 PM</option>
																						<option value="13:30">01:30 PM</option>
																						<option value="13:45">01:45 PM</option>
																						<option value="14:00">02:00 PM</option>
																						<option value="14:15">02:15 PM</option>
																						<option value="14:30">02:30 PM</option>
																						<option value="14:45">02:45 PM</option>
																						<option value="15:00">03:00 PM</option>
																						<option value="15:15">03:15 PM</option>
																						<option value="15:30">03:30 PM</option>
																						<option value="15:45">03:45 PM</option>
																						<option value="16:00">04:00 PM</option>
																						<option value="16:15">04:15 PM</option>
																						<option value="16:30">04:30 PM</option>
																						<option value="16:45">04:45 PM</option>
																						<option value="17:00">05:00 PM</option>
																						<option value="17:15">05:15 PM</option>
																						<option value="17:30">05:30 PM</option>
																						<option value="17:45">05:45 PM</option>
																						<option value="18:00">06:00 PM</option>
																						<option value="18:15">06:15 PM</option>
																						<option value="18:30">06:30 PM</option>
																						<option value="18:45">06:45 PM</option>
																						<option value="19:00">07:00 PM</option>
																						<option value="19:15">07:15 PM</option>
																						<option value="19:30">07:30 PM</option>
																						<option value="19:45">07:45 PM</option>
																						<option value="20:00">08:00 PM</option>
																						<option value="20:15">08:15 PM</option>
																						<option value="20:30">08:30 PM</option>
																						<option value="20:45">08:45 PM</option>
																						<option value="21:00">09:00 PM</option>
																						<option value="21:15">09:15 PM</option>
																						<option value="21:30">09:30 PM</option>
																						<option value="21:45">09:45 PM</option>
																						<option value="22:00">10:00 PM</option>
																						<option value="22:15">10:15 PM</option>
																						<option value="22:30">10:30 PM</option>
																						<option value="22:45">10:45 PM</option>
																						<option value="23:00">11:00 PM</option>
																						<option value="23:15">11:15 PM</option>
																						<option value="23:30">11:30 PM</option>
																					</select>
																				</div>
																			</div>
																				
																		</div>
																	</div>
																</div>
																<div class="col-lg-12">
																	<div id="selected_date_off mt-25">
																		<div class="row">
																			<div class="col-md-6 col-sm-6 col-xs-12">
																				<div class="form-group mb-15">
																					<label><strong>What is your time zone ?</strong> </label>
																					<select class="form-select" id="serTimeZone" name="serTimeZone">
																						<option value=""> Select Time Zone </option>
																						<option value="est">Eastern Standard Time - EST</option>
																						<option value="pst">Pacific Standard Time - PST</option>
																						<option value="mst">Mountain Standard Time - MST</option>
																						<option value="cst">Central Standard Time - CST</option>
																					</select>
																				</div>
																				<div class="form-group mb-15">
																					<label><strong>Any Special Days Off ?</strong> </label>
																					<div class="special-date">               
																						<div class="input-group">
																							<input type="text" class="form-control flatpiker-with-border border-0 dash-filter-picker shadow flatpickr-range flatpickr-input active" data-range-date="false" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022" readonly="readonly">
																							<div class="input-group-text bg-primary border-primary text-white">
																								<i class="ri-calendar-2-line"></i>
																							</div>
																						</div>
																					</div>
																					<script>
																						$(document).on('click', '#mdp-demo', function() {
																							$('#ui-datepicker-div').show();
																						});

																						$(document).on('click', '.rounded-corner', function() {
																							//console.log($(this).attr('date'));
																							$('#mdp-demo').multiDatesPicker('toggleDate', moment($(this).attr('date'), 'MM/DD/YYYY').format('MM/DD/YYYY'));
																							$(this).remove();
																						})

																						$('#mdp-demo').multiDatesPicker({
																							separator: ", ",
																							autoClose: true,
																							minDate: 0,
																							onSelect: function(dateText, inst) {  
																								$('.rounded-corner').each(function(i, obj) {
																									$('#ui-datepicker-div').hide();
																									if ($(this).text() == dateText + ' x') {
																										$(this).click();
																									}
																								});

																								$('.manual-remove').append('<button type="button" date="' + dateText + '" class="rounded-corner">' + dateText + ' x</button>')
																								inst.inline = true;
																							}
																						});
																					</script>
																				</div>

																				<div class="form-group">
																					<label><strong>List amenities your business offers (Select that all apply)</strong> </label>
																					<select multiple="" id="serBusinessoff1" name="serBusinessoff1[]" tabindex="-1" data-ssid="ss-88275">
																						<option value="Cardio Equipment">Cardio Equipment</option>
																						<option value="Strength Equipment">Strength Equipment</option>
																						<option value="Stretch Equipment">Stretch Equipment </option>
																						<option value="Equipment Rental">Equipment Rental</option>
																						<option value="Lounge Area">Lounge Area</option>
																						<option value="Waiting Area">Waiting Area</option>
																						<option value="Wifi">Wifi</option>
																						<option value="TV">TV</option>
																						<option value="Showers ">Showers </option>
																						<option value="Grooming Area">Grooming Area</option>
																						<option value="Pool ">Pool </option>
																						<option value="Jacuzzi  ">Jacuzzi </option>
																						<option value="Massage">Massage</option>
																						<option value="Salon">Salon</option>
																						<option value="Sauna">Sauna</option>
																						<option value="Steam Room">Steam Room</option>
																						<option value="Basketball court">Basketball court</option>
																						<option value="Tennis court">Tennis court</option>
																						<option value="Racquetball court">Racquetball court</option>
																						<option value="Track">Track</option>
																						<option value="Tanning beds">Tanning beds</option>
																						<option value="Juice Bar">Juice Bar</option>
																						<option value="Smoothie Bar">Smoothie Bar</option>
																						<option value="Bar Area">Bar Area</option>
																						<option value="Snacks">Snacks</option>
																						<option value="Nutritional Food">Nutritional Food</option>
																						<option value="Food Options">Food Options</option>
																						<option value="Cleaning Stations">Cleaning Stations</option>
																						<option value="Sanitizing stations">Sanitizing stations</option>
																						<option value="Lockers">Lockers</option>
																						<option value="Water Fountain">Water Fountain</option>
																						<option value="Bottle Fountain">Bottle Fountain</option>
																						<option value="Sound system">Sound system</option>
																						<option value="Social distancing">Social distancing</option>
																						<option value="Trained staff on AED">Trained staff on AED</option>
																						<option value="Trained CPR/ First Aid staff">Trained CPR/ First Aid staff </option>
																						<option value="Certified personal trainers">Certified personal trainers</option>
																						<option value="Alarm System">Alarm System</option>
																						<option value="Bike Parking">Bike Parking</option>
																						<option value="Car Parking">Car Parking</option>
																						<option value="Elevator">Elevator</option>
																						<option value="Security Cameras">Security Cameras</option>
																						<option value="Wheelchair accessible">Wheelchair accessible</option>
																						<option value="Outdoor seating">Outdoor seating</option>
																						<option value="Indoor seating">Indoor seating</option>
																					</select>
																					
																				</div>
																			</div>

																			<div class="col-md-6 col-sm-6 col-xs-12" style="">
																				<div class="grey-box-date">
																					<div class="text-center">
																						<span class="select-date-off">Selected Date Off</span><br>
																						<label>Customers will not be able to book you on these days</label>
																					</div>

																					<div class="manual-remove"></div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="col-md-12 col-12">
														<button type="button" class="btn-red-primary btn-red float-right mt-15" id="nextindividual2">Save </button>
													</div>
												</div>
											</div>
										</div>
									</div><!-- end card-body -->
								</div><!-- end card -->
							</div>
							
							<div class="row">
								<div class="col-xl-12">
									<div class="card">
										<div class="card-header align-items-center d-flex">
											<h4 class="card-title mb-0 flex-grow-1">Set Your Terms</h4>
										</div><!-- end card header -->

										<div class="card-body">
											<div class="live-preview">
												<div class="accordion" id="default-accordion-example">
													<div class="accordion-item shadow">
														<h2 class="accordion-header" id="headingThree">
															<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
																Terms
															</button>
														</h2>
														<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#default-accordion-example">
															<div class="accordion-body">
																<div class="row">
																	<div class="col-md-6 col-sm-6 col-xs-12">
																		<div class="mb-25">
																			<p>Give your customers THINGS TO KNOW and information on how and what to prepare before they book.</p>
																		</div>
																		<div class="form-group mb-25">
																			<label for="house_rules">Know Before You Go </label>
																			<textarea placeholder="Tell your customers how they should conduct themselves when attending your place of business or participating in your activity. Set out a few guidelines to help things go smoothly." name="houserules" id="house_rules_terms" cols="30" rows="6" class="form-control" maxlength="1000">test</textarea>
																			<span class="error" id="err_house_rules"></span>

																			<div class="text-right word-counter">
																				<span id="house_rules_terms_left">996</span> Characters Left
																			</div>
																		</div>
																		<div class="form-group mb-25">
																			<label for="cancelation_policy">Cancellation Policy <!-- <span id="star">*</span> --></label>
																			<textarea placeholder="Let your customers know your rules about canceling a booking. Set your policy and regulations." name="cancelation" id="cancelation_policy" cols="30" rows="6" class="form-control" maxlength="1000">test</textarea>
																			<span class="error" id="err_cancelation_policy"></span>
																			<div class="text-right word-counter">
																				<span id="cancelation_policy_left">996</span> Characters Left
																			</div>
																		</div>
																		<div class="form-group mb-25">
																			<label for="safety_cleaning">Safety and Cleaning Procedures <!-- <span id="star">*</span> --></label>
																			<textarea placeholder="Let your customers know your safety and cleaning procedures to keep them healthy and safe." name="cleaning" id="safety_cleaning" cols="30" rows="6" class="form-control" maxlength="1000">test</textarea>
																			<span class="error" id="err_safety_cleaning"></span>

																			<div class="text-right word-counter">
																				<span id="safety_cleaning_left">996</span> Characters Left
																			</div>
																		</div>
																	</div>
																	
																	<div class="col-md-6 col-sm-6 col-xs-12">
																		<div class="mb-25">
																			<p>Select the section you require your clients to agree to upon completing registration.</p>
																		</div>
																		<div class="mb-15">
																			<label for="terms_1" class="col-md-12 terms-check1">
																				<input type="checkbox" value="1" class="chkdy" id="termcondfaq" name="termcondfaq" autocomplete="off"> Terms, Conditions, FAQ
																			</label>
																			<div class="textsam" id="termcondfaqdiv" style="display: none;">
																				<textarea class="form-control" placeholder="Terms, Conditions, FAQ" id="termcondfaqtext" name="termcondfaqtext"></textarea>
																				<div class="text-right word-counter">
																					<span id="termcondfaqtext_left">1000</span> Characters Left
																				</div>
																			</div>
																		</div>
																		
																		<div class="mb-15">
																			<label for="terms_2" class="terms-check2">
																				<input type="checkbox" value="1" class="chkdy" id="contractterm" name="contractterms" autocomplete="off"> Contract Terms ?
																			</label>
																			<div class="col-md-12 textsam" id="contracttermdiv" style="display: none;">
																				<textarea class="form-control" placeholder="Contract Terms" id="contracttermtext" name="contracttermstext" rows="8" maxlength="20000"></textarea>
																				<div class="text-right word-counter">
																					<span id="contracttermtext_left">20000</span> Characters Left
																				</div>
																			</div>
																		</div>
																		
																		<div class="mb-15">
																			<label for="terms_3" class="col-md-12 terms-check3">
																				<input type="checkbox" value="1" class="chkdy" id="liabilitys" name="liability" autocomplete="off"> Liability Waiver
																			</label>
																			<div class="col-md-12 textsam" id="liabilitysdiv" style="display: none;">
																				<textarea class="form-control" placeholder="Liability Waiver" id="liabilitystext" name="liabilitytext"></textarea>
																				<div class="text-right word-counter">
																					<span id="liabilitystext_left">1000</span> Characters Left
																				</div>
																			</div>
																		</div>
																		
																		<div class="mb-15">
																			<label for="terms_4" class="col-md-12 terms-check4">
																				<input type="checkbox" value="1" class="chkdy" id="covids" name="covid" autocomplete="off"> Covid – 19 Protocols
																			</label>
																			<div class="col-md-12 textsam" id="covidsdiv" style="display: none;">
																				<textarea class="form-control" placeholder="Covid – 19 Protocols" id="covidstext" name="covidtext"></textarea>
																				<div class="text-right word-counter">
																					<span id="covidstext_left">1000</span> Characters Left
																				</div>
																			</div>
																		</div>
																		
																		<div class="mb-15">
																			<label for="terms_5" class="col-md-12 terms-check5">
																				<input type="checkbox" value="1" class="chkdy" id="refundpolicy" name="refundpolicy" autocomplete="off"> Refund Policy
																			</label>
																			<div class="col-md-12 textsam" id="refundpolicydiv" style="display: none;">
																				<textarea class="form-control" placeholder="Refund Policy" id="refundpolicytext" name="refundpolicytext"></textarea>
																				<div class="text-right word-counter">
																					<span id="refundpolicy_left">1000</span> Characters Left
																				</div>
																			</div>
																		</div>
																		
																	</div>
																</div>
															</div>
														</div>
														<div class="col-md-12 col-12">
															<button type="button" class="btn-red-primary btn-red float-right mt-15" id="nextindividual2">Save </button>
														</div>
													</div>
												</div>
											</div>
										</div><!-- end card-body -->
									</div><!-- end card -->
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
	<script>
		flatpickr(".flatpickr-range", {
	        dateFormat: "m/d/Y",
	        maxDate: "01/01/2050",
			defaultDate: [new Date()],
	     });
	</script>
	<script>
		flatpickr(".flatpickr-year", {
	        dateFormat: "Y",
	        maxDate: "2050",
			defaultDate: [new Date()],
	     });
	</script>
	<script>
        var p = new SlimSelect({
			select: '#testdemo'
        });
    </script>
	<script>
		var mon_shift_start = '';
		var mon_shift_end = '';

		$('.timepicker').timepicker({
			timeFormat: 'h:mm p',
			interval: 15,
			defaultTime: (mon_shift_start!='') ? 'value' : '10',
			startTime: '10:00',
			dynamic: false,
			dropdown: true,
			scrollbar: true
		});

		$('.timepicker1').timepicker({
			timeFormat: 'h:mm p',
			interval: 15,
			defaultTime: (mon_shift_end!='') ? 'value' : '17',
			startTime: '5:00',
			dynamic: false,
			dropdown: true,
			scrollbar: true
		});
	</script>
	<script>
		 $("#hours1").click(function () {
				$("#selectdays").show();
			});
			$("#hours2").click(function () {
				$("#selectdays").hide();
			});
			$("#hours3").click(function () {
				$("#selectdays").hide();
			});
			$("#hours4").click(function () {
				$("#selectdays").hide();
			});
	</script>
	<script>
		var p = new SlimSelect({
		select: '#serBusinessoff1'
	});
	</script>
	<script>
		flatpickr(".flatpickr-range", {
	        dateFormat: "m/d/Y",
	        maxDate: "01/01/2050",
			defaultDate: [new Date()],
	     });
	</script>
	<script>
	 /* 
         * *********************************************
         * Business Terms Checks 
         * *********************************************
         */
        /* Terms - Checkbox button click event show or hide relevent section */
        $("#termcondfaq").click(function(){
            if($("#termcondfaq").is(':checked')) {
                $("#termcondfaqdiv").show();
            } else {
                $("#termcondfaqdiv").hide();
            }
        });
        $("#contractterm").click(function(){
            if($("#contractterm").is(':checked')) {
                $("#contracttermdiv").show();
            } else {
                $("#contracttermdiv").hide();
            }
        }); 

        $("#liabilitys").click(function(){
            if($("#liabilitys").is(':checked')) {
                $("#liabilitysdiv").show();
            } else {
                $("#liabilitysdiv").hide();
            }
        });
        $("#refundpolicy").click(function(){
            if($("#refundpolicy").is(':checked')) {
                $("#refundpolicydiv").show();
            } else {
                $("#refundpolicydiv").hide();
            }
        });    
     
        $("#covids").click(function(){
            if($("#covids").is(':checked')) {
                $("#covidsdiv").show();
            } else {
                $("#covidsdiv").hide();
            }    
        });    
		</script>


@endsection