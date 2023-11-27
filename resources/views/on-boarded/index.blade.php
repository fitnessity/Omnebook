@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.business.new-header')

	<div class="page-content-two">
		<div class="container">
			<div class="row y-middle mb-3">
				<div class="col-12">
					<div class="card-body">
						<div class="save-exit">
							<!-- <button type="button" class="btn btn-black text-decoration-none previestab" data-previous="pills-info-desc-tab">Save & Exit</button> -->
						</div>
						<div class="form-steps" autocomplete="off">
							<div id="custom-progress-bar" class="progress-nav mb-4">
								<div class="progress" style="height: 1px;">
									<div class="progress-bar" role="progressbar" style="width: 
									@if($show == 0)
								        0%;
								    @elseif($show == 2)
								        20%;
								    @elseif($show == 3)
								        40%;
								    @elseif($show == 4)
								        60%;
								    @elseif($show == 5)
								        80%;
								    @elseif($show == 6)
								        100%;
								    @endif"
								    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<ul class="nav nav-pills progress-bar-tab custom-nav" role="tablist">
									<li class="nav-item" role="presentation">
										<button class="nav-link rounded-pill @if($show == 1) active @endif @if($show > 1) done @endif" data-progressbar="custom-progress-bar" id="pills-gen-info-tab" data-bs-toggle="pill" data-bs-target="#pills-gen-info" type="button" role="tab" aria-controls="pills-gen-info" aria-selected="true" @if($show != 1 ) disabled @endif>1</button>
										<div class="steps-titles-about ">
											<label>About You</label>
										</div>
									</li>

									<li class="nav-item" role="presentation">
										<button class="nav-link rounded-pill @if($show == 2 ) active  @endif @if($show > 2) done @endif" data-progressbar="custom-progress-bar" id="pills-claim-tab" data-bs-toggle="pill" data-bs-target="#pills-claim" type="button" role="tab" aria-controls="pills-claim" aria-selected="false" @if($show != 2) disabled @endif>2</button>
										<div class="steps-titles">
											<label>Claim Your Business </label>
										</div>
									</li>

									<li class="nav-item" role="presentation">
										<button class="nav-link rounded-pill @if($show ==3 ) active  @endif @if($show > 3 ) done @endif" data-progressbar="custom-progress-bar" id="pills-info-desc-tab" data-bs-toggle="pill" data-bs-target="#pills-info-desc" type="button" role="tab" aria-controls="pills-info-desc" aria-selected="false" disabled>3</button>
										<div class="steps-titles">
											<label>Your Business </label>
										</div>
									</li>
									<li class="nav-item" role="presentation">
										<button class="nav-link rounded-pill @if($show == 4) active @endif @if($show > 4 ) done @endif" data-progressbar="custom-progress-bar" id="pills-success-tab" data-bs-toggle="pill" data-bs-target="#pills-success" type="button" role="tab" aria-controls="pills-success" aria-selected="false" @if($show != 4) disabled @endif>4</button>
										<div class="steps-titles-payout">
											<label>Payout</label>
										</div>
									</li>
									<li class="nav-item service-set" role="presentation">
										<button class="nav-link rounded-pill  @if($show == 5) active @endif @if($show > 5 ) done @endif" data-progressbar="custom-progress-bar" id="pills-step4-tab" data-bs-toggle="pill" data-bs-target="#pills-step4" type="button" role="tab" aria-controls="pills-step4" aria-selected="false" @if($show != 5) disabled @endif>5</button>
										<div class="steps-titles-plan">
											<label>Choose Plan</label>
										</div>
									</li>
									<li class="nav-item cre-service" role="presentation">
										<button class="nav-link rounded-pill ml-25 @if($show == 6) active @endif @if($show > 6 ) done @endif" data-progressbar="custom-progress-bar" id="pills-step5-tab" data-bs-toggle="pill" data-bs-target="#pills-step5" type="button" role="tab" aria-controls="pills-step5" aria-selected="false" @if($show != 6) disabled @endif>6</button>
										<div class="steps-titles-service">
											<label>Create Service</label>
										</div>
									</li>
								</ul>
							</div>

							<div class="tab-content">
								<div class="tab-pane fade @if($show == 1) show active @endif" id="pills-gen-info" role="tabpanel" aria-labelledby="pills-gen-info-tab">
									<form id="step1">
										<input type="hidden" name="step" value="1">
										<input type="hidden" name="id" value="{{@$user->id}}">
										<input type="hidden" name="cid" value="{{@$cid}}">
										<div class="row">
											<div class="col-12">
												<div>
													<div class="mb-6 mt-4">
														<div class="steps-title about-text-steps">
															<h5 class="mb-1">Tell Us About You</h5>
															<p>You will have a personal and business account.</p>
															<p>You can also make bookings for activities you love or network with others</p>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-4 col-md-4 text-center">
															<div class="profile-user position-relative d-inline-block mx-auto mb-2">
																<img @if(@$user && @$user->getPic()) src="{{@$user->getPic()}}"  @else src="{{url('dashboard-design/images/user-dummy-img.jpg')}}" @endif class="rounded-circle avatar-lg img-thumbnail user-profile-image" alt="user-profile-image">
																<div class="avatar-xs p-0 rounded-circle profile-photo-edit">
																	<input id="profile-img-file-input" type="file" class="profile-img-file-input" name="profile_pic" accept="image/png, image/jpeg">
																	<label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
																		<span class="avatar-title rounded-circle bg-light text-body">
																			<i class="ri-camera-fill"></i>
																		</span>
																	</label>
																</div>
															</div>
														</div>
														
														<div class="col-lg-4 col-md-4">
															<div class="mb-3">
																<label class="form-label">First Name </label>
																<input type="text" class="form-control" id="fname" name="fname" required  value="{{@$user->firstname}}">
																<div class="invalid-feedback">Please enter an first name</div>
															</div>
														</div>
														
														<div class="col-lg-4 col-md-4">
															<div class="mb-3">
																<label class="form-label"> Last Name </label>
																<input type="text" class="form-control" id="lname" name="lname" required  value="{{@$user->lastname}}">
																<div class="invalid-feedback">Please enter an last name</div>
															</div>
														</div>	

														<div class="col-lg-4 col-md-4">
															<div class="mb-3">
																<label class="form-label"> Email Address </label>
																<input type="text" class="form-control" id="useremail" name="email" required value="{{@$user->email}}" @if(@$user) disabled @endif>
																<div class="fs-11 font-red chkemail"></div>
																<div class="invalid-feedback">Please enter an email address</div>
															</div>
														</div>
														
														<div class="col-lg-4 col-md-4">
															<div class="mb-3">
																<label class="form-label"> Gender </label>
																<div>
																	<input type="radio" id="male" name="gender" value="Male"  @if(@$user->gender == 'Male' && @$user == '') checked @endif>
																	<label for="male">Male</label>
																	<input type="radio" id="female" name="gender" value="Female" @if(@$user->gender == 'Female') checked @endif>
																	<label for="female">Female</label>
																</div>
															</div>
														</div>
														
														<div class="col-lg-4 col-md-4">
															<div class="mb-3">
																<label class="form-label"> Birth Date </label>
																<input type="text" class="form-control" data-provider="flatpickr" id="birthdate" name="birthdate" placeholder="Select date" required  value="{{@$user->birthdate}}"/>
																<div class="invalid-feedback">Please select birthdate</div>
															</div>
														</div>
														
														<div class="col-lg-4 col-md-4">
															<div class="mb-3">
																<label class="form-label"> User Name </label>
																<input type="text" class="form-control" id="username" name="username" required value="{{@$user->username}}">
																<div class="invalid-feedback">Please enter an username</div>
															</div>
														</div>
														
														<div class="col-lg-4 col-md-4">
															<div class="mb-3">
																<label class="form-label"> Phone Number </label>
																<input type="text" class="form-control" id="" name="phone" data-behavior="text-phone" value="{{@$user->phone_number}}">
															</div>
														</div>
														
														<div class="col-lg-4 col-md-4">
															<div class="mb-3">
																<label class="form-label"> Address </label>
																<input type="text" class="form-control" id="address" name="address" required oninput="initializeAutocomplete('address', 'city', 'state', 'country', 'zipcode', 'lat', 'lon')" value="{{@$user->address}}">
																<div class="invalid-feedback">Please enter an address</div>
															</div>
															<div id="map"></div>
					                                        <input type="hidden" name="lon" id="lon" value="{{@$user->longitude}}">
					                                        <input type="hidden" name="lat" id="lat" value="{{@$user->latitude}}">
														</div>
														
														<div class="col-lg-4 col-md-4">
															<div class="mb-3">
																<label class="form-label"> City </label>
																<input type="text" class="form-control" id="city" name="city" value="{{@$user->city}}">
															</div>
														</div>
														
														<div class="col-lg-4 col-md-4">
															<div class="mb-3">
																<label class="form-label"> State </label>
																<input type="text" class="form-control" id="state" name="state" value="{{@$user->state}}">
															</div>
														</div>
														
														<div class="col-lg-4 col-md-4">
															<div class="mb-3">
																<label class="form-label"> Country </label>
																<input type="text" class="form-control" id="country" name="country"  value="{{@$user->country}}">
															</div>
														</div>
														
														<div class="col-lg-4 col-md-4">
															<div class="mb-3">
																<label class="form-label"> Zipcode </label>
																<input type="text" class="form-control" id="zipcode" name="zipcode" value="{{@$user->zipcode}}"> 
															</div>
														</div>
														
														<div class="col-lg-4 col-md-4">
															<div class="mb-3">
																<label class="form-label"> Quick Intro </label>
																<textarea name="quick_intro" id="quick_intro" cols="30" minlength="0" maxlength="100" rows="2" placeholder="Quick Intro (max 100 Words)" class="form-control" >{{@$user->quick_intro}}</textarea>
																<span id="quick_intro_count" class="float-right">
																	<span id="display_count">100</span> words. Words left : 
																	<span id="word_left">100</span>
																</span>
															</div>
														</div>

														<div class="col-lg-4 col-md-4">
															<div class="mb-3">
																<label class="form-label"> Password </label>
																<input name="password" id="password" placeholder="*****" class="form-control"   @if(@$user) disabled @else  required @endif>
																<div class="invalid-feedback">Please enter password</div>
															</div>
														</div>
														
														<div class="col-lg-4 col-md-4">
															<div class="mb-3">
																<label class="form-label">Favorite Activities </label>
																<input type="text" class="form-control" id="favorit_activity" name="favorit_activity" value="{{@$user->favorit_activity}}">
															</div>
														</div>
														
														<div class="col-lg-8 col-md-12">
															<div class="mb-3">
																<label class="form-label">About </label>
																<textarea name="business_info" id="business_info" cols="30" rows="7" maxlength="1000" placeholder=" About (a short description about your business - max 1000 words)" class="form-control">{{@$user->business_info}}</textarea>
																<span id="business_info_count" class="float-right">
																	<span id="display_count_business">1000</span> words. Words left : <span id="word_left_business">1000</span>
																</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="d-flex align-items-start gap-3 mt-4">
											<button type="button" class="btn btn-red btn-label right ms-auto nexttab nexttab step1_next" data-nexttab="pills-claim-tab" onclick="testEmail()"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Step 2</button>
										</div>
									</form>
								</div><!-- end tab pane -->
								
								<div class="tab-pane fade @if($show ==2) show active @endif" id="pills-claim" role="tabpanel" aria-labelledby="pills-claim-tab">
									<div class="row y-middle">
										<div class="col-12">
											<div>
												<div class="steps-title about-text-steps mb-25">
													<h5 class="mb-1">Claiming your business</h5>
													<p>How Would You Would Like to Verify Ownership of {{@$companyDetail->public_company_name}}</p>
												</div>
												
												<input type="hidden" name="cid" value="{{@$companyDetail->id}}">
												<div class="row">
													<div class="col-lg-12 col-md-12">
														<div class="claiming-section claimyour-business" style="">
														    <div class="row">
														        <div class="col-md-6 claiming-business-block">
														            <div id="error-email"><h5 class="Alertred"></h5></div>

														            <input type="hidden" name="cid" id="cid" value="{{$cid}}">
																
																	@if(@$companyDetail->business_email != '')
																		@php 
																			$parts = explode('@', $companyDetail->business_email);
																			$extension = end($parts); 
																		@endphp
															            <div class="claiming-boxn">
															                <h4><i class="fa fa-envelope" aria-hidden="true"></i> EMAIL ME</h4>
															                <p>Fitnessity will send a verification email to the email address below. Please check your email to verify.</p>
															                <form id="varify_email_for_claim">
															                    @csrf
															                    <div class="form-group">
																					<div class="row">
																						<div class="col-md-4">
																							<span>Send email to:</span>
																						</div>
																						<div class="col-md-6">
																							<input type="text" name="email_id" id="email_id" class="form-control" placeholder="{{@$extension}}" required="">
																						</div>
																						<span class="text-danger" id="email-error"></span>
																					</div>
															                    </div>
															                    <input type="button" value="Send" class="btn btn-red varify_email_for_claim">
															                </form>
															            </div>
															        @endif

														            @if(@$companyDetail->business_phone != '')
														              	<div id="error-phone"><h5 class="Alertred"></h5></div>

															            <div class="claiming-boxn twon">
															                <h4><i class="fa fa-mobile" aria-hidden="true"></i> TEXT ME</h4>
															                <p>Fitnessity will send a 4-digit verification code via SMS, You'll submit this code on the next screen.</p>
															                <form id="varify_phone_for_claim">
															                    <div class="form-group">
															                        <span>Send text to: +1 {{@$companyDetail->business_phone}}</span>
															                        <input type="hidden" name="phone_num" id="phone_num" class="form-control" value="{{@$companyDetail->business_phone}}">
															                    </div>
															                    <input type="button" value="Send" class="btn btn-red varify_phone_for_claim">
															                </form>
															                <br>
															            </div>
															            
															            <div id="error-call" ><h5 class="Alertred"></h5></div>

															            <div class="claiming-boxn twon">
															                <h4><i class="fas fa-phone-alt" aria-hidden="true"></i> CALL ME</h4>
															                <p>Fitnessity will call you and with a verification code will be displayed on the next screen. Submit this code using your phone.</p>
															                <form id="varify_call_for_claim">
															                    @csrf
															                    <div class="form-group">
															                        <span>Call this number: + 1 {{@$companyDetail->business_phone}}</span>
															                    </div>
															                    <input type="button" value="Send" class="btn btn-red varify_call_for_claim">
															                </form>
															            </div> 
															        @endif
																	
															        
																	
															   </div>
															   <div class="col-md-6">
																	<div class="claiming-boxn mt-10">
														                <h4><i class="fa fa-envelope" aria-hidden="true"></i>VERIFICATION CODE</h4>
														                <form id="verify_code" class="mb-10">
														                    <div class="container">
														                        <div class="row">
														                            <div class="col-md-8">
														                                <div class="">
														                                    <input type="text" name="vari_code" id="vari_code" class="form-control" placeholder="Verification Code" required="">
														                                </div>
														                            </div>
														                            <div class="col-md-4 text-right">
														                                <input type="button" value="Submit" class="btn btn-red verify_code">
														                            </div>
														                            <div class="col-md-12">
														                                <div class="mt-15">
														                                    <a class="font-red" onclick="resendOtp();">Resend</a>
														                                    <div class="fs-16" id="otpMsg"></div>
														                                </div>
														                            </div>
														                        </div>
														                    </div>
														                </form>
														                <span class="text-danger" id="error_msg" ></span>
														                <br>
														            </div>
															   </div>
														    </div>
														</div>
													</div>
												</div>
												<div class="d-flex align-items-start gap-3 mt-4">
													<button type="button" class="btn btn-red btn-label right ms-auto nexttab nexttab" data-nexttab="pills-info-desc-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Step 3</button>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="tab-pane fade @if($show ==3) show active @endif" id="pills-info-desc" role="tabpanel" aria-labelledby="pills-info-desc-tab">
									<div class="row y-middle">
										<div class="col-lg-6 col-md-12 col-12">
											<div>
												<div class="mb-4 mt-4">
													<div class="steps-title">
														<h5 class="mb-1">Tell us about your business</h5>
													</div>
												</div>
												<form id="step3">
													<input type="hidden" name="cid" value="{{@$companyDetail->id}}">
													<input type="hidden" name="id" value="{{@$user->id}}">
													<div class="row">
														<div class="col-lg-6 col-md-6">
															<div class="mb-3">
																<label class="form-label">Legal Business Name <span class="font-red">*</span></label>
																<input type="text" class="form-control" id="companyName" name="companyName" required value="{{@$companyDetail->company_name}}">
																<div class="invalid-feedback">Please enter an business name</div>
															</div>
														</div>
														
														<div class="col-lg-6 col-md-6">
															<div class="mb-3">
																<label class="form-label"> dba Business Name <span class="font-red">*</span></label>
																<input type="text" class="form-control" id="dbaBusinessName" name="dbaBusinessName" required value="{{@$companyDetail->dba_business_name}}">
																<div class="invalid-feedback">Please enter an business name</div>
															</div>
														</div>
														
														<div class="col-lg-6 col-md-6">
															<div class="mb-3">
																<label class="form-label">Business Address <span class="font-red">*</span></label>
																			
																<input type="text" class="form-control" id="bAddress" name="bAddress" required oninput="initializeAutocomplete('bAddress', 'bcity', 'bstate', 'bcountry', 'bzipcode', 'blat', 'blon')" value="{{@$companyDetail->address}}">
																<div class="invalid-feedback">Please enter business address</div>
															</div>
														</div>
														
														<input type="hidden" name="blon" id="blon" value="{{@$companyDetail->longitude}}">
														<input type="hidden" name="blat" id="blat" value="{{@$companyDetail->latitude}}">
														<input type="hidden" name="bcountry" id="bcountry" value="{{@$companyDetail->country}}">
														<div class="col-lg-6 col-md-6">
															<div class="mb-3">
																<label class="form-label">Additional Address Info</label>
																			
																<input type="text" class="form-control" id="additionalAddress" name="additionalAddress" value="{{@$companyDetail->additional_address}}">
															</div>
														</div>
																	
														<div class="col-lg-6 col-md-6">
															<div class="mb-3">
																<label class="form-label">City <span class="font-red">*</span></label>
																			
																<input type="text" class="form-control" id="bcity" name="bcity" required value="{{@$companyDetail->city}}">
																<div class="invalid-feedback">Please enter city</div>
															</div>
														</div>
																	
														<div class="col-lg-6 col-md-6">
															<div class="mb-3">
																<label class="form-label">State <span class="font-red">*</span></label>
																			
																<input type="text" class="form-control" id="bstate" name="bstate"required value="{{@$companyDetail->state}}">
																<div class="invalid-feedback">Please enter State</div>
															</div>
														</div>
																	
														<div class="col-lg-6 col-md-6">
															<div class="mb-3">
																<label class="form-label">Zip Code <span class="font-red">*</span></label>
																			
																<input type="text" class="form-control" id="bzipcode" name="bzipcode"required value="{{@$companyDetail->zip_code}}">
																<div class="invalid-feedback">Please zip code</div>
															</div>
														</div>
														
														<div class="col-lg-6 col-md-6">
															<div class="mb-3">
																<label class="form-label">Neighborhood/Location/Area </label>
																<input type="text" class="form-control" name="neighborhood" value="{{@$companyDetail->neighborhood}}">
															</div>
														</div>
														
														<div class="col-lg-6 col-md-6">
															<div class="mb-3">
																<label class="form-label">Business Phone Number <span class="font-red">*</span></label>
																			
																<input type="text" class="form-control" id="business_phone" name="business_phone" required data-behavior="text-phone" value="{{@$companyDetail->business_phone}}">
																<div class="invalid-feedback">Please phone number</div>
															</div>
														</div>
														
														<div class="col-lg-6 col-md-6">
															<div class="mb-3">
																<label class="form-label">Business Email <span class="font-red">*</span></label>
																			
																<input type="email" class="form-control" id="businessEmail" name="businessEmail" required value="{{@$companyDetail->business_email}}">
																<div class="invalid-feedback">Please enter valid email address</div>
															</div>
														</div>
														
														<div class="col-lg-6 col-md-6">
															<div class="mb-3">
																<label class="form-label">Business Username <span class="font-red">*</span></label>
																			
																<input type="text" class="form-control" id="businessUserName" name="businessUserName" required value="{{@$companyDetail->business_user_tag}}">
																<div class="invalid-feedback">Please username</div>
															</div>
														</div>
														
														<div class="col-lg-6 col-md-6">
															<div class="mb-3">
																<label class="form-label">Business Website </label>
																			
																<input type="text" class="form-control" id="website" name="website" value="{{@$companyDetail->business_website}}">
															</div>
														</div>
													
														<div class="col-lg-6 col-md-6">
															<div class="mb-3">
																<label class="form-label">Business type</label>
																<div>
																	<select name="businessType" class="form-control form-select">
																		<option value="individual"  @if(@$companyDetail->business_type == 'individual') selected @endif>Individual</option>
																		<option value="business"  @if(@$companyDetail->business_type == 'business') selected @endif>Business</option>
																	</select>
																</div>
															</div>
														</div>
														
														<div class="col-lg-6 col-md-6 text-center">
															<div class="profile-user position-relative d-inline-block mx-auto mb-2">
																<img @if(@$companyDetail && @$companyDetail->getCompanyImage()) src="{{@$companyDetail->getCompanyImage()}}"  @else src="{{url('/dashboard-design/images/user-dummy-img.jpg')}}" @endif class="rounded-circle avatar-lg img-thumbnail user-profile-image profile-image1" alt="user-profile-image">
																<div class="avatar-xs p-0 rounded-circle profile-photo-edit">
																	<input id="profile-img-file-input1" type="file" class="profile-img-file-input img-file-input1" name="logo" accept="image/png, image/jpeg" >
																	<label for="profile-img-file-input1" class="profile-photo-edit avatar-xs">
																		<span class="avatar-title rounded-circle bg-light text-body">
																			<i class="ri-camera-fill"></i>
																		</span>
																	</label>
																</div>
															</div>
														</div>
														
														<div class="col-lg-12">
															<div class="mb-3">
																<label class="form-label">Quick Business Intro</label>
																<textarea class="form-control" rows="4" placeholder="Tell Us Somthing About Company..." name="shortDescription" id="shortDescription" maxlength="150">{{@$companyDetail->short_description}}</textarea>
																<div class="word-counter">
																	<span id="companyDescLeft">150</span> Characters Left
																</div>
															</div>
														</div>
														
														<div class="col-lg-12">
															<div class="mb-3">
																<label class="form-label">Company Description</label>
																<textarea class="form-control" rows="5" placeholder="Tell Us Somthing About Company in short..." name="aboutCompany" id="aboutCompany" maxlength="1000">{{@$companyDetail->about_company}}</textarea>
																<div class="word-counter">
																	<span id="aboutCompanyLeft">1000</span> Characters Left
																</div>
															</div>
														</div>
													</div>
												</form>
											</div>
										</div>
										<div class="col-lg-6 col-md-12 col-12">
											<div class="sports-side-img text-center">
												<img src="{{url('dashboard-design/images/sports-set.jpg')}}" alt="">
											</div>
										</div>
										<div class="col-12">
											<div class="d-flex align-items-start gap-3 mt-4">
												<button type="button" class="btn btn-black text-decoration-none btn-label previestab" data-previous="pills-gen-info-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Step 2</button>
												<button type="button" class="btn btn-red btn-label right ms-auto nexttab nexttab step3_next" data-nexttab="pills-success-tab1"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Step 4</button>
											</div>
										</div>
									</div>
								</div><!-- end tab pane -->
								

								<div class="tab-pane fade @if($show == 4) show active @endif" id="pills-success" role="tabpanel" aria-labelledby="pills-success-tab">
									<div class="row y-middle">
										<div class="col-lg-6 col-md-12 col-12">
											<div>
												<div class="mb-4 mt-4">
													<div class="steps-title">
														<h5 class="mb-1">Tell us where to send your money</h5>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-12 col-md-12 col-12">
														<div class="payout-sub-txt mt-10 mb-10">
															<label>We partner with stripe to handle all payments. Set up your account to receive payments from your customers.</label>
														</div>
													</div>
													<div class="col-lg-12 text-center">
														<a href="{{route('stripe-dashboard-onboard' ,['cid' => $cid])}}" class="btn btn-red ms-auto nexttab nexttab mt-10 mb-10">Connect to Strip</a>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6 col-md-12 col-12">
											<div class="sports-side-img text-center">
												<img src="{{url('dashboard-design/images/fitnessity&stripe.png')}}" alt="">
											</div>
										</div>
										<div class="d-flex align-items-start gap-3 mt-6">
											<button type="button" class="btn btn-black text-decoration-none btn-label previestab" data-previous="pills-info-desc-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Step 3</button>
											<button type="button" class="btn btn-red btn-label right ms-auto nexttab nexttab" data-nexttab="pills-step4-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Step 5</button>
										</div>										
									</div>
								</div><!-- end tab pane -->
								
								<div class="tab-pane fade @if($show == 5) show active @endif" id="pills-step4" role="tabpanel" aria-labelledby="pills-success-tab">
									<div class="row y-middle">
										<div class="col-12">
											<div class="mb-4 mt-4">
												<div class="steps-title">
													<h5 class="mb-1">Select Your Plan </h5>
												</div>
											</div>
											<div class="row">
												<div class="booking-titles text-center">
													<h4 class="fs-18">Plans & Pricing</h4>
												</div>
												<div class="price-switch">
													<div class="row">
														<div class="col-md-12">
															 <div class="top">
																<div class="toggle-btn">
																	<span>Monthly</span>
																	<label class="switch">
																		<input type="checkbox" id="checbox" onclick="check()" ; />
																		<span class="slider round"></span>
																	</label>
																	<span>Annual</span>
																</div>
															</div>
														</div>
													</div>
													<div class="row justify-content-center">
														<div class="col-xl-10 col-lg-10 mb-120">
															<div class="row">
																@foreach($plans as $p)
																<div class="col-lg-4 col-md-6 col-sm-6 mb-20">
																	<div class="packages">
																		<div>
																			<img src="{{$p->getPic()}}" alt="">
																		</div>
																		<div class="basic-plan">
																			<h1>{{$p->title}}</h1>
																			<p>{{$p->heading}}</p>
																		</div>
																		<div class="v-plan-cart">
																			<div class=" position-relative text-center">
																				<div class="d-flex justify-center align-center">
																					<sup class="text-sm me-1 mt-10">$</sup>
																					<h1 class="text1 text-5xl font-weight-medium font-red">{{$p->price_per_month}}</h1>
																					<h1 class="text2 text-5xl font-weight-medium font-red">{{$p->price_per_year / 12 }}</h1>
																					<sub class="text-sm font-weight-medium ms-1 mt-4">/month</sub>
																				</div>
																			</div>
																			<div class="price-list">
																				<label class="text1">USD {{$p->price_per_year}}/Year</label>
																			</div>
																		</div>

										
																		<div class="v-plan-details">
																			{!! $p->description !!}
																		</div>
																		<div class="width-100">
																			<a onclick="getPlan({{$p->id}},'{{$cid}}','{{$p->price_per_month}}')" class="btn btn-red mt-25 width-100" >Your Current Plan </a>
																		</div>
																	</div>
																</div>
																@endforeach
																
																<div class="col-lg-12">
																	<div class="bg-light-red mt-105 mb-55">
																		<div class="row">
																			<div class="col-lg-8 col-md-7 col-sm-12">
																				<div class="free-trial-text">
																					<h3> Still not convinced? Start with a 14-day FREE trial! </h3>
																					<p>You will get full access to all the features for 14 days. </p>
																					<a onclick="getPlan(1,'{{$cid}}',0)"class="btn btn-red "> Start-14-day FREE trial </a>
																				</div>
																			</div>
																			<div class="col-lg-4 col-md-5 col-sm-12">
																				<div class="steps-free-trial-img">
																					<img src="{{url('dashboard-design/images/laptop-girl.png')}}" alt="">
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																
																<div class="card-body mb-20">	
																	<div class="booking-titles text-center mb-20 mt-10">
																		<h4 class="fs-18">Pick a plan that works best for you</h4>
																		<p>Stay cool, we have a 48-hour money back guarantee!</p>
																	</div>
																	<div class="row">
																		<div class="col-lg-12">	 
																			<div class="fit-price-plan-table">
																				<div class="row">
																					<div class="col-md-6 fit-xop">
																						<div class="custom-table-header">
																							<h1 class="text-muted fs-12 mb-1 text-uppercase">FEATURES </h1>
																							<span class="text-muted fs-12 mb-0 text-uppercase"> Native Front Features </span>
																						</div>
																						<div class="custom-table-data">
																							<label>14-days free trial</label>
																						</div>
																						@foreach($features as $key=>$f)
																						<div class="custom-table-data">
																							<label>{{$f->name}}  
																							<span type="button" class="plan-tlp" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="	{{$f->tooltip_text}}" data-bs-original-title="{{$f->tooltip_text}}"><i class="fas fa-info"></i></span>
																						</label>
																						</div>
																						@endforeach
																						<div class="custom-table-data-footer">
																							<label></label>
																						</div>											
																					</div>
																					@foreach($plans as $p)
																					<div class="col-md-2 @if(!$loop->last)fit-xop nopadding @endif @if($loop->last) pl-0 @endif">
																						<div class="custom-table-header">
																							<h1 class="text-muted fs-12 mb-1 text-uppercase"> {{$p->title}} </h1>
																							<span class="text-muted fs-12 mb-0 text-uppercase"> @if($p->price_per_month != 0) ${{$p->price_per_month}}/MONTH @else FREE @endif  </span>
																						</div>
																						<div class="custom-table-data">
																							<div class="check-right">
																								<i class="fas fa-check"></i>
																							</div>
																						</div>
																						@foreach(json_decode(@$p->featurs_details) as $i=> $f)
																						<div class="custom-table-data">

																							@if($f == 'Yes')
																							<div class="check-right">
																								<i class="fas fa-check"></i>
																							</div>
																							@elseif($f == 'No')
																							<div class="check-wrong">
																								<i class="fas fa-times"></i>
																							</div>
																							@elseif($f == 'Add On')
																								<span class="badge badge-soft-red p-2"> ADD-ON AVAILABLE </span>
																							@else
																								<span class="badge badge-soft-red p-2"> {{$f}}</span>
																							@endif
																						</div>
																						@endforeach
																						<div class="custom-table-data-footer">
																							<a onclick="getPlan('{{$p->id}}','{{$cid}}','{{$p->price_per_month}}')"  class="btn btn-red"> Choose Plan </a>
																						</div>
																					</div>
																					@endforeach
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															
																<div class="col-lg-12 col-md-12  col-sm-12 col-12">
																	<div class="booking-titles text-center mb-20 mt-40">
																		<h4 class="fs-18">FAQ's </h4>
																		<p>Let us help answer the most common questions. </p>
																	</div>
																	<div class="accordion accordion-border-box" id="genques-accordion">
																		<div class="accordion-item shadow">
																			<h2 class="accordion-header" id="genques-headingOne">
																				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#genques-collapseOne" aria-expanded="true" aria-controls="genques-collapseOne">
																					What counts towards the 100 responses limit?
																				</button>
																			</h2>
																			<div id="genques-collapseOne" class="accordion-collapse collapse" aria-labelledby="genques-headingOne" data-bs-parent="#genques-accordion">
																				<div class="accordion-body">
																					Donec placerat, lectus sed mattis semper, neque lectus feugiat lectus, varius pulvinar diam eros in elit. Pellentesque convallis laoreet laoreet.Donec placerat, lectus sed mattis semper, neque lectus feugiat lectus, varius pulvinar diam eros in elit. Pellentesque convallis laoreet laoreet.
																				</div>
																			</div>
																		</div>
																		<div class="accordion-item shadow">
																			<h2 class="accordion-header" id="genques-headingTwo">
																				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#genques-collapseTwo" aria-expanded="false" aria-controls="genques-collapseTwo">
																					How do you process payments?
																				</button>
																			</h2>
																			<div id="genques-collapseTwo" class="accordion-collapse collapse" aria-labelledby="genques-headingTwo" data-bs-parent="#genques-accordion">
																				<div class="accordion-body">
																					We accept Visa®, MasterCard®, American Express®, and PayPal®. So you can be confident that your credit card information will be kept safe and secure.
																				</div>
																			</div>
																		</div>
																		<div class="accordion-item shadow">
																			<h2 class="accordion-header" id="genques-headingThree">
																				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#genques-collapseThree" aria-expanded="false" aria-controls="genques-collapseThree">
																					What payment methods do you accept?
																				</button>
																			</h2>
																			<div id="genques-collapseThree" class="accordion-collapse collapse" aria-labelledby="genques-headingThree" data-bs-parent="#genques-accordion">
																				<div class="accordion-body">
																					Checkout accepts all types of credit and debit cards.
																				</div>
																			</div>
																		</div>
																		<div class="accordion-item shadow">
																			<h2 class="accordion-header" id="genques-headingFour">
																				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#genques-collapseFour" aria-expanded="false" aria-controls="genques-collapseFour">
																					Do you have a money-back guarantee?
																				</button>
																			</h2>
																			<div id="genques-collapseFour" class="accordion-collapse collapse" aria-labelledby="genques-headingFour" data-bs-parent="#genques-accordion">
																				<div class="accordion-body">
																					Yes. You may request a refund within 30 days of your purchase without any additional explanations.
																				</div>
																			</div>
																		</div>
																	</div><!--end accordion-->
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										
										<div class="d-flex align-items-start gap-3 mt-4">
											<button type="button" class="btn btn-black text-decoration-none btn-label previestab" data-previous="pills-success-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Step 4</button>
											
											<button type="button" class="btn btn-red btn-label right ms-auto nexttab nexttab" data-nexttab="pills-step4-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Step 6</button>
										</div>
									</div>
								</div><!-- end tab pane -->
								
								<div class="tab-pane fade @if($show == 6) show active @endif" id="pills-step5" role="tabpanel" aria-labelledby="pills-success-tab">
									<div class="row">
										<div class="col-lg-6 col-md-6 col-12">
											<div class="row">
												<div class="col-lg-12 col-md-12 col-12">
													<div class="mb-4 mt-4">
														<div class="steps-title">
															<h5 class="mb-2">Get Started By Creating A Service</h5>
														</div>
														<div>
															<p>List a service, set your prices and times to start getting bookings</p>
														</div>
													</div>
												</div>
												<div class="col-lg-12 col-md-12 col-12">
													<div class="service-img-steps">
														<img src="{{url('dashboard-design/images/ss-services.png')}}" alt="">
													</div>
												</div>
											</div>
											
											<div class="text-left">
												<a class="btn btn-red ms-auto nexttab nexttab mt-10 mb-10 width-135" href="{{route('doLoginProcess' ,['cid' => $cid , 'redirect' => 'service'])}}">Create A Service</a>
											</div>
										</div>
										<div class="col-lg-6 col-md-6 col-12">
											<div class="row">
												<div class="col-lg-12 col-md-12 col-12">
													<div class="mb-4 mt-4">
														<div class="steps-title">
															<h5 class="mb-2">Get Started By Looking Around First</h5>
														</div>
														<div>
															<p>Start with the dashboard, then check all the features</p>
														</div>
													</div>
												</div>
												<div class="col-lg-12 col-md-12 col-12">
													<div class="dashboard-side-img ">
														<img src="{{url('dashboard-design/images/ss-dashboard.png')}}" alt="">
													</div>
												</div>
											</div>											
										</div>
										
										<div class="d-flex align-items-start gap-3 mt-4">
											<button type="button" class="btn btn-black text-decoration-none btn-label previestab" data-previous="pills-step4-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Step 5</button>
											<a href="{{route('doLoginProcess' ,['cid' => $cid , 'redirect' => 'dashboard'])}}" class="btn btn-red ms-auto right nexttab nexttab mt-10 mb-10">Check Out The Features</a>
										</div>
									</div>
								</div><!-- end tab pane -->
							</div><!-- end tab content -->
						</div>
					</div><!-- end card body -->
				</div>
			</div> <!-- end row-->
		</div><!-- container -->
	</div><!-- End Page-content -->
</div><!-- END layout-wrapper -->


<div class="modal fade card-form" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-modal="true">
	<div class="modal-dialog modal-dialog-centered" id="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body card-form-data"></div>
		</div>
	</div>
</div>

<script>
	flatpickr("#birthdate", {
		altInput: true,
		altFormat: "m/d/Y",
    	dateFormat: "Y-m-d",
		maxDate: "01/01/2050"
	});
	
</script>

<script>

	function getPlan(id,cid,price){
		$.ajax({
            url: '{{route('onboard_process.storePlan')}}',
            type: 'POST',
            data: {
            	'id':id,
            	'cid':cid,
            	'_token' :'{{csrf_token()}}'
            },
            success: function (response) {
            	if(price == 0){
            		window.location.href = '/onboard_process?show=6&cid='+cid;
            	}else{
					getCardForm(cid);
				}
            }
        });
	}

	function getCardForm(cid){
		$.ajax({
            url: '{{route('onboard_process.getCardForm')}}',
            type: 'GET',
            data: {
            	'cid':cid,
            }, 
            success: function (response) {
            	$('.card-form-data').html(response);
            	$('.card-form').modal('show');
            }
        });
	}

	function testEmail(){
		var chkemail = $('#useremail').val(); 
		var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	    if (chkemail != '' && !emailPattern.test(chkemail)) {
	        $('#useremail').css('background-image' ,'none').css('border-color','#f06548');
	        $('.chkemail').html("Invalid email address");
	    }
	}

	function check() {
	  	var checkBox = document.getElementById("checbox");
	  	var text1 = $(".text1");
	  	var text2 = $(".text2");

	  	if (checkBox.checked) {
	    	text1.css("display", "block");
	    	text2.css("display", "none");
	  	} else {
	    	text1.css("display", "none");
	    	text2.css("display", "block");
	  	}
	}

	check();

	function resendOtp(){
        var _token = $("input[name='_token']").val();
        var cid ='{{$cid}}';
        $.ajax({
            url: "/resend-otp-for-claim",
            type:"POST",
            headers: {'X-CSRF-TOKEN': _token},
            data:{
                cid:cid
            },
            success:function(response){
                $('#otpMsg').removeClass('font-red').addClass('font-green').html('Text message sent! Enter the code above.');
            },
        });
    }

	$(document).ready(function() {

		$('#word_left').text(100-parseInt($("#quick_intro").val().length));
		$("#quick_intro").on('input', function() {
            $('#word_left').text(100-parseInt(this.value.length));
        });

        $('#word_left_business').text(1000-parseInt($("#business_info").val().length));
		$("#business_info").on('input', function() {
            $('#word_left_business').text(1000-parseInt(this.value.length));
        });

        $('#companyDescLeft').text(150-parseInt($("#shortDescription").val().length));
		$("#shortDescription").on('input', function() {
            $('#companyDescLeft').text(150-parseInt(this.value.length));
        });

        $('#aboutCompanyLeft').text(1000-parseInt($("#aboutCompany").val().length));
		$("#aboutCompany").on('input', function() {
            $('#aboutCompanyLeft').text(1000-parseInt(this.value.length));
        });


		document.querySelector("#profile-img-file-input1") && document.querySelector("#profile-img-file-input1").addEventListener("change", function() {
		    var o = document.querySelector(".profile-image1"),
		        e = document.querySelector(".img-file-input1").files[0],
		        i = new FileReader;
		    i.addEventListener("load", function() {
		        o.src = i.result
		    }, !1), e && i.readAsDataURL(e)
		});

		$('#useremail').on('input', function() {
        	$('.chkemail').html("");
        	$('#useremail').css('border-color','ced4da');
	    });

	    $('#useremail').on('blur', function() {
	        var posturl = 'emailvalidation';
	        $.ajax({
                url: posturl,
                type: 'get',
                dataType: 'json',
                data: {
                	email: $('#useremail').val(),
                	_token :'{{csrf_token()}}'
                },  
                beforeSend: function () {
                    $(".chkemail").html('');
                },             
                success: function (response) { 
                	if(response.msg){ 
                    	$(".chkemail").html(response.msg);  
                	}                
                }
            });
	    });

	    $('.varify_email_for_claim').click(function(e) {
            e.preventDefault();
            var _token = $("input[name='_token']").val();
            var email = $('#email_id').val();
            var cid = $('#cid').val();
            var type_enter = "email";
            $('#error-email').html('<h5 class="Alertred"></h5>');
            if(email){
	            $.ajax({
	                url: "/varify-email-for-claim-business",
	                type:"POST",
	                headers: {'X-CSRF-TOKEN': _token},
	                data:{
	                    val:email,
	                    cid:cid,
	                    type_enter:type_enter
	                },
	                success:function(response){
	                    if(response == 'Success'){
	                        $('#error-email').removeClass('font-red').addClass('font-green').find('h5').text('OTP successfully sent. Please enter the OTP below.');
	                    }else{
	                    	$('#error-email').removeClass('font-green').addClass('font-red').find('h5').text("We can't send otp on your email..");
	                    }
	                },
	            });
	       	}else{
	       		$('#error-email').removeClass('font-green').addClass('font-red').find('h5').text("Please enter email id.");
	       	}
        }); 

	    $('.varify_phone_for_claim').click(function(e) {
            e.preventDefault();
            var _token = $("input[name='_token']").val();
            var phone = $('#phone_num').val();
            var cid = $('#cid').val();
            var type_enter = "phone";
            $.ajax({
                url: "/varify-email-for-claim-business",
                type:"POST",
                headers: {'X-CSRF-TOKEN': _token},
                data:{
                    val:phone,
                    cid:cid,
                    type_enter:type_enter
                },
                success:function(response){
                	if(response == 'Success'){
                    	$('#error-phone').removeClass('font-red').addClass('font-green').removeClass('d-none').find('h5').text("OTP successfully sent. Please enter the OTP below.");
                    }else{
                    	$('#error-phone').removeClass('font-green').addClass('font-red').find('h5').text("We can't send otp on your phone number..");
                    }
                },
            });
        });

        $('.varify_call_for_claim').click(function(e) {
            e.preventDefault();
            var _token = $("input[name='_token']").val();
            var phone = $('#phone_num').val();
            var cid = $('#cid').val();
            var type_enter = "call";
            $.ajax({
                url: "/varify-email-for-claim-business",
                type:"POST",
                headers: {'X-CSRF-TOKEN': _token},
                data:{
                    val:phone,
                    cid:cid,
                    type_enter:type_enter
                },
                success:function(response){
                    if(response == 'Success'){
                    	$('#error-call').removeClass('font-red').addClass('font-green').removeClass('d-none').find('h5').text("OTP successfully sent. Please enter the OTP below.");
                    }else{
                    	$('#error-call').removeClass('font-green').addClass('font-red').find('h5').text("We can't call on your phone number..");
                    }
                },
            });
        });

        $('.verify_code').click(function(e) {
            e.preventDefault();
            var _token = $("input[name='_token']").val();
            var code = $('#vari_code').val();
            var cid ='{{$cid}}';
            $.ajax({
                url: "/varify-code-to-claim-business",
                type:"POST",
                headers: {'X-CSRF-TOKEN': _token},
                data:{
                    code:code,
                    cid:cid,
                    id:'{{$id}}'
                },
                xhrFields: {
                    withCredentials: true
                },

                success:function(response){
                    $('#otpMsg').html('');
                    if(response == 'Match'){
                       	window.location = "/onboard_process?show=3&cid="+cid+"&id="+"{{$id}}";
                    }else if(response == 'Not Match'){
                        $('#error_msg').html('Verification code is not valid. Please enter valid code.');
                    }else{
                        $('#error_msg').html('Facing Issue to claim your Business.');
                    }
                },
            });
        });
	});

	$(document).on('click', '.step1_next', function (e) {
		let valid = 0;

    	$('#pills-gen-info [required]').each(function() {
            if (!$(this).val()) {
            	valid = 1;
                $(this).addClass('is-invalid'); // Add a CSS class for styling
                $(this).next('.invalid-feedback').show();
            } else {
                $(this).removeClass('is-invalid'); // Remove the CSS class if the field is filled
                $(this).next('.invalid-feedback').hide();
            }
        });

   		if (valid != 1) {
           e.preventDefault(); 
           var posturl = '/onboard_process/store';
        	var formdata = new FormData(document.getElementById('step1'));
	        formdata.append('_token', '{{csrf_token()}}');
	        $.ajax({
	            url: posturl,
	            type: 'POST',
	            dataType: 'json',
	            data: formdata,
	            processData: false,
	            contentType: false,
	            headers: {
	                'X-CSRF-TOKEN': $("#_token").val()
	            },
	            success: function (response) {
	            	if('{{Auth::check()}}'){
	            		window.location.href = '/onboard_process?id='+response.id+'&cid='+response.cid;
	            	}else{
	            		window.location.href = '/onboard_process?id='+response.id+'&cid='+response.cid;
	            	}
	            }
	        });
       	}
    });

    $(document).on('click', '.step3_next', function (e) {
		let valid = 0;

    	$('#pills-info-desc [required]').each(function() {
            if (!$(this).val()) {
               valid = 1;
               $(this).addClass('is-invalid'); // Add Bootstrap's is-invalid class
               $(this).next('.invalid-feedback').show(); // Show the error message
            } else {
               $(this).removeClass('is-invalid');
               $(this).next('.invalid-feedback').hide(); // Hide the error message if field is valid
            }
        });

   		if (valid != 1) {
            e.preventDefault(); 
            var posturl = '/onboard_process/store';
        	var formdata = new FormData(document.getElementById('step3'));
	        formdata.append('_token', '{{csrf_token()}}');
	        formdata.append('show', 3);
	        $.ajax({
	            url: posturl,
	            type: 'POST',
	            dataType: 'json',
	            data: formdata,
	            processData: false,
	            contentType: false,
	            headers: {
	                'X-CSRF-TOKEN': $("#_token").val()
	            },
	            success: function (response) {
	            	if('{{Auth::check()}}'){
	            		window.location.href = '/onboard_process?id='+response.id+'&cid='+response.cid;
	            	}else{
	            		window.location.href = '/onboard_process?id='+response.id+'&cid='+response.cid;
	            	}
	            }
	        });
       	}
    });
</script>

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{env('GOOGLE_MAP_KEY')}}" async defer></script>

<script type="text/javascript">
	function initializeAutocomplete(addressInputID, cityElementID, stateElementID, countryElementID, zipcodeElementID, latElementID, lonElementID) {
	    var map = new google.maps.Map(document.getElementById('map'), {
	        center: {lat: -33.8688, lng: 151.2195},
	        zoom: 13
	    });

	    var input = document.getElementById(addressInputID);
	    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
	    var autocomplete = new google.maps.places.Autocomplete(input);
	    autocomplete.bindTo('bounds', map);
	    var infowindow = new google.maps.InfoWindow();
	    var marker = new google.maps.Marker({
	        map: map,
	        anchorPoint: new google.maps.Point(0, -29)
	    });

	    var address = '';
        var badd = '';
        var sublocality_level_1 = '';

	    autocomplete.addListener('place_changed', function() {
	        infowindow.close();
	        marker.setVisible(false);
	        var place = autocomplete.getPlace();
	        if (!place.geometry) {
	            window.alert("Autocomplete's returned place contains no geometry");
	            return;
	        }

	        // (Rest of your code...)

	        // Location details
	        for (var i = 0; i < place.address_components.length; i++) {
	            if(place.address_components[i].types[0] == 'postal_code'){
	                $('#' + zipcodeElementID).val(place.address_components[i].long_name);
	            }

	            if(place.address_components[i].types[0] == 'locality'){
	                $('#' + cityElementID).val(place.address_components[i].long_name);
	            }

	            if(place.address_components[i].types[0] == 'sublocality_level_1'){
	                sublocality_level_1 = place.address_components[i].long_name;
	            }

	            if(place.address_components[i].types[0] == 'street_number'){
	               badd = place.address_components[i].long_name ;
	            }

	            if(place.address_components[i].types[0] == 'route'){
	               badd += ' '+place.address_components[i].long_name ;
	            } 

	            if(place.address_components[i].types[0] == 'country'){
	                $('#'+countryElementID).val(place.address_components[i].long_name);
	            }

	            if(place.address_components[i].types[0] == 'administrative_area_level_1'){
	              $('#'+stateElementID).val(place.address_components[i].long_name);
	            }

	            // (Continue with other elements...)
	        }

	        if(badd == ''){
	          	$('#'+addressInputID).val(sublocality_level_1);
	        }else{
	          	$('#'+addressInputID).val(badd);
	        }

	        $('#'+latElementID).val(place.geometry.location.lat());
        	$('#'+lonElementID).val(place.geometry.location.lng());
	        // (Rest of your code...)
	    });
	}
</script>

@include('layouts.business.footer')
@endsection