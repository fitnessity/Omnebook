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
							<button type="button" class="btn btn-black text-decoration-none previestab" data-previous="pills-info-desc-tab">Save & Exit</button>
						</div>
						<form action="#" class="form-steps" autocomplete="off">
							<div id="custom-progress-bar" class="progress-nav mb-4">
								<div class="progress" style="height: 1px;">
									<div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<ul class="nav nav-pills progress-bar-tab custom-nav" role="tablist">
									<li class="nav-item" role="presentation">
										<button class="nav-link rounded-pill active" data-progressbar="custom-progress-bar" id="pills-gen-info-tab" data-bs-toggle="pill" data-bs-target="#pills-gen-info" type="button" role="tab" aria-controls="pills-gen-info" aria-selected="true">1</button>
										<div class="steps-titles-about ">
											<label>About You</label>
										</div>
									</li>
									<li class="nav-item" role="presentation">
										<button class="nav-link rounded-pill" data-progressbar="custom-progress-bar" id="pills-info-desc-tab" data-bs-toggle="pill" data-bs-target="#pills-info-desc" type="button" role="tab" aria-controls="pills-info-desc" aria-selected="false">2</button>
										<div class="steps-titles">
											<label>Your Business </label>
										</div>
									</li>
									<li class="nav-item" role="presentation">
										<button class="nav-link rounded-pill" data-progressbar="custom-progress-bar" id="pills-success-tab" data-bs-toggle="pill" data-bs-target="#pills-success" type="button" role="tab" aria-controls="pills-success" aria-selected="false">3</button>
										<div class="steps-titles-payout">
											<label>Payout</label>
										</div>
									</li>
									<li class="nav-item service-set" role="presentation">
										<button class="nav-link rounded-pill" data-progressbar="custom-progress-bar" id="pills-step4-tab" data-bs-toggle="pill" data-bs-target="#pills-step4" type="button" role="tab" aria-controls="pills-step4" aria-selected="false">4</button>
										<div class="steps-titles-plan">
											<label>Choose Plan</label>
										</div>
									</li>
									<li class="nav-item cre-service" role="presentation">
										<button class="nav-link rounded-pill ml-25" data-progressbar="custom-progress-bar" id="pills-step5-tab" data-bs-toggle="pill" data-bs-target="#pills-step5" type="button" role="tab" aria-controls="pills-step5" aria-selected="false">5</button>
										<div class="steps-titles-service">
											<label>Create Service</label>
										</div>
									</li>
								</ul>
							</div>

							<div class="tab-content">
								<div class="tab-pane fade show active" id="pills-gen-info" role="tabpanel" aria-labelledby="pills-gen-info-tab">
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
															<img src="http://dev.fitnessity.co/public/dashboard-design/images/user-dummy-img.jpg" class="rounded-circle avatar-lg img-thumbnail user-profile-image" alt="user-profile-image">
															<div class="avatar-xs p-0 rounded-circle profile-photo-edit">
																<input id="profile-img-file-input" type="file" class="profile-img-file-input" accept="image/png, image/jpeg">
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
																			
															<input type="text" class="form-control" id="" required >
															<div class="invalid-feedback">Please enter an first name</div>
														</div>
													</div>
													
													<div class="col-lg-4 col-md-4">
														<div class="mb-3">
															<label class="form-label"> Last Name </label>
																		
															<input type="text" class="form-control" id="" required >
															<div class="invalid-feedback">Please enter an last name</div>
														</div>
													</div>	

													<div class="col-lg-4 col-md-4">
														<div class="mb-3">
															<label class="form-label"> Email Address </label>
																		
															<input type="text" class="form-control" id="" required >
															<div class="invalid-feedback">Please enter an email address</div>
														</div>
													</div>
													
													<div class="col-lg-4 col-md-4">
														<div class="mb-3">
															<label class="form-label"> Gender </label>
															<div>
															<input type="radio" id="male" name="fav_language" value="male">
															<label for="male">Male</label>
															<input type="radio" id="female" name="fav_language" value="female">
															<label for="female">Female</label>
															</div>
														</div>
													</div>
													
													<div class="col-lg-4 col-md-4">
														<div class="mb-3">
															<label class="form-label"> Birth Date </label>
															<input type="text" class="form-control flatpickr" data-provider="flatpickr" id="JoiningdatInput" data-date-format="d M, Y" data-deafult-date="24 Nov, 2021" placeholder="Select date" />
														</div>
													</div>
													
													<div class="col-lg-4 col-md-4">
														<div class="mb-3">
															<label class="form-label"> User Name </label>
															<input type="text" class="form-control" id="" required >
														</div>
													</div>
													
													<div class="col-lg-4 col-md-4">
														<div class="mb-3">
															<label class="form-label"> Phone Number </label>
															<input type="text" class="form-control" id="">
														</div>
													</div>
													
													<div class="col-lg-4 col-md-4">
														<div class="mb-3">
															<label class="form-label"> Address </label>
															<input type="text" class="form-control" id="">
														</div>
													</div>
													
													<div class="col-lg-4 col-md-4">
														<div class="mb-3">
															<label class="form-label"> City </label>
															<input type="text" class="form-control" id="">
														</div>
													</div>
													
													<div class="col-lg-4 col-md-4">
														<div class="mb-3">
															<label class="form-label"> State </label>
															<input type="text" class="form-control" id="">
														</div>
													</div>
													
													<div class="col-lg-4 col-md-4">
														<div class="mb-3">
															<label class="form-label"> Country </label>
															<input type="text" class="form-control" id="">
														</div>
													</div>
													
													<div class="col-lg-4 col-md-4">
														<div class="mb-3">
															<label class="form-label"> Zipcode </label>
															<input type="text" class="form-control" id="">
														</div>
													</div>
													
													<div class="col-lg-8 col-md-4">
														<div class="mb-3">
															<label class="form-label"> Quick Intro </label>
															<textarea name="quick_intro" id="quick_intro" cols="30" minlength="50" maxlength="200" rows="2" placeholder="Quick Intro (max 100 Words)" class="form-control"></textarea>
															<span id="quick_intro_count" class="float-right">
																<span id="display_count">163</span> words. Words left : 
																<span id="word_left">37</span>
															</span>
														</div>
													</div>
													
													<div class="col-lg-4 col-md-4">
														<div class="mb-3">
															<label class="form-label">Favorite Activities </label>
															<input type="text" class="form-control" id="">
														</div>
													</div>
													
													<div class="col-lg-8 col-md-12">
														<div class="mb-3">
															<label class="form-label">About </label>
															<textarea name="business_info" id="business_info" cols="30" rows="7" maxlength="1000" placeholder=" About (a short description about your business - max 1000 words)" class="form-control">Darryl is one of New York’s most requested martial arts instructors and personal fitness trainer. He is currently the owner and chief instructor @ Valor Mixed Martial Arts &amp; Fitnessity. 

															Darryl uses high energy, close attention to detail and motivation to get the best results out of each session. Darryl’s sessions consist of a total body workout that consist of conditioning and muscle building workouts infused with authentic martial arts training with kickboxing, mma, and self-defense.

															Darryl is a 6th degree black belt in the art of Kaju Bujutsu Kwai and a 1st degree black belt in Bushido kempo. He is versed in MMA, Krav Maga, Kickboxing, Juitsu, Self-Defense, Close Quarters Combat, Weapons and Tactics and more.
															</textarea>
															<span id="business_info_count" class="float-right">
																<span id="display_count_business">881</span> words. Words left : <span id="word_left_business">119</span>
															</span>
															
														</div>
													</div>
													
												</div>
											</div>
										</div>
										
										
									</div>
									<div class="d-flex align-items-start gap-3 mt-4">
										<button type="button" class="btn btn-red btn-label right ms-auto nexttab nexttab" data-nexttab="pills-info-desc-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Step 2</button>
									</div>
								</div>
							  <!-- end tab pane -->

								<div class="tab-pane fade" id="pills-info-desc" role="tabpanel" aria-labelledby="pills-info-desc-tab">
									<div class="row y-middle">
										<div class="col-lg-6 col-md-12 col-12">
											<div>
												<div class="mb-4 mt-4">
													<div class="steps-title">
														<h5 class="mb-1">Tell us about your business</h5>
													</div>
												</div>
												<div class="row">
													<div class="col-lg-6 col-md-6">
														<div class="mb-3">
															<label class="form-label">Legal Business Name <span class="font-red">*</span></label>
																		
															<input type="text" class="form-control" id="" required >
															<div class="invalid-feedback">Please enter an business name</div>
														</div>
													</div>
													
													<div class="col-lg-6 col-md-6">
														<div class="mb-3">
															<label class="form-label"> dba Business Name <span class="font-red">*</span></label>
																		
															<input type="text" class="form-control" id="" required >
															<div class="invalid-feedback">Please enter an business name</div>
														</div>
													</div>
													
													<div class="col-lg-6 col-md-6">
														<div class="mb-3">
															<label class="form-label">Business Address <span class="font-red">*</span></label>
																		
															<input type="text" class="form-control" id="" required >
															<div class="invalid-feedback">Please enter business address</div>
														</div>
													</div>
																
													<div class="col-lg-6 col-md-6">
														<div class="mb-3">
															<label class="form-label">Additional Address Info</label>
																		
															<input type="text" class="form-control" id="">
														</div>
													</div>
																
													<div class="col-lg-6 col-md-6">
														<div class="mb-3">
															<label class="form-label">City <span class="font-red">*</span></label>
																		
															<input type="text" class="form-control" id="" required >
															<div class="invalid-feedback">Please enter city</div>
														</div>
													</div>
																
													<div class="col-lg-6 col-md-6">
														<div class="mb-3">
															<label class="form-label">State <span class="font-red">*</span></label>
																		
															<input type="text" class="form-control" id="" required >
															<div class="invalid-feedback">Please enter State</div>
														</div>
													</div>
																
													<div class="col-lg-6 col-md-6">
														<div class="mb-3">
															<label class="form-label">Zip Code <span class="font-red">*</span></label>
																		
															<input type="text" class="form-control" id="" required >
															<div class="invalid-feedback">Please zip code</div>
														</div>
													</div>
													
													<div class="col-lg-6 col-md-6">
														<div class="mb-3">
															<label class="form-label">Neighborhood/Location/Area </label>
																		
															<input type="text" class="form-control" id="" >
														</div>
													</div>
													
													<div class="col-lg-6 col-md-6">
														<div class="mb-3">
															<label class="form-label">Business Phone Number <span class="font-red">*</span></label>
																		
															<input type="text" class="form-control" id="" required >
															<div class="invalid-feedback">Please phone number</div>
														</div>
													</div>
													
													<div class="col-lg-6 col-md-6">
														<div class="mb-3">
															<label class="form-label">Business Email <span class="font-red">*</span></label>
																		
															<input type="email" class="form-control" id="" required >
															<div class="invalid-feedback">Please email address</div>
														</div>
													</div>
													
													<div class="col-lg-6 col-md-6">
														<div class="mb-3">
															<label class="form-label">Business Username <span class="font-red">*</span></label>
																		
															<input type="text" class="form-control" id="" required >
															<div class="invalid-feedback">Please username</div>
														</div>
													</div>
													
													<div class="col-lg-6 col-md-6">
														<div class="mb-3">
															<label class="form-label">Business Website </label>
																		
															<input type="text" class="form-control" id="" >
														</div>
													</div>
												
													<div class="col-lg-6 col-md-6">
														<div class="mb-3">
															<label class="form-label">Business type <span class="font-red">*</span></label>
															<div>
																<input type="checkbox" id="individual" name="individual" value="individual">
																<label for="individual"> Individual </label>
															</div>
														</div>
													</div>
													
													<!-- <div class="col-lg-6">
														<div class="mb-3">
															<label class="form-label" for="img">Upload Profile Image</label>
															<input type="file" class="form-control" name="profilePic" id="profilePic" onchange="readURL(this);">
															<input type="hidden" name="oldProfile" id="oldProfile" value="">
														</div>
													</div> -->
													
													<div class="col-lg-6 col-md-6 text-center">
														<div class="profile-user position-relative d-inline-block mx-auto mb-2">
															<img src="http://dev.fitnessity.co/public/dashboard-design/images/user-dummy-img.jpg" class="rounded-circle avatar-lg img-thumbnail user-profile-image" alt="user-profile-image">
															<div class="avatar-xs p-0 rounded-circle profile-photo-edit">
																<input id="profile-img-file-input" type="file" class="profile-img-file-input" accept="image/png, image/jpeg">
																<label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
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
															<textarea class="form-control" rows="4" placeholder="Tell Us Somthing About Company..." name="shortDescription" id="shortDescription" maxlength="150">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad</textarea>
															<div class="word-counter">
																<span id="companyDescLeft">16</span> 
																	Characters Left
															</div>
														</div>
													</div>
													
													<div class="col-lg-12">
														<div class="mb-3">
															<label class="form-label">Company Description</label>
															<textarea class="form-control" rows="5" placeholder="Tell Us Somthing About Company in short..." name="aboutCompany" id="aboutCompany" maxlength="1000">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</textarea>
															<div class="word-counter">
																<span id="aboutCompanyLeft">852</span> 
																Characters Left
															</div>
														</div>
													</div>
													
												</div>
											</div>
											
										</div>
										<div class="col-lg-6 col-md-12 col-12">
											<div class="sports-side-img text-center">
												<img src="http://dev.fitnessity.co/public/dashboard-design/images/sports-set.jpg" alt="">
											</div>
										</div>
										<div class="col-12">
											
											<div class="d-flex align-items-start gap-3 mt-4">
												<button type="button" class="btn btn-black text-decoration-none btn-label previestab" data-previous="pills-gen-info-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Step 1</button>
												<button type="button" class="btn btn-red btn-label right ms-auto nexttab nexttab" data-nexttab="pills-success-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Step 3</button>
											</div>
										</div>
									</div>
								</div>
								<!-- end tab pane -->

								<div class="tab-pane fade" id="pills-success" role="tabpanel" aria-labelledby="pills-success-tab">
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
													<!--<div class="col-lg-6">
														<div class="mb-3">
															<label class="form-label">First Name </label>
																		
															<input type="text" class="form-control" id="" required >
															<div class="invalid-feedback">Please enter an first name</div>
														</div>
													</div>
													
													<div class="col-lg-6">
														<div class="mb-3">
															<label class="form-label"> Last Name </label>
																		
															<input type="text" class="form-control" id="" required >
															<div class="invalid-feedback">Please enter an last name</div>
														</div>
													</div>	
													<div class="col-lg-12">
														<div class="mb-3">
															<label class="form-label"> Email </label>
																
															<input type="email" class="form-control" id="" required="">
															<div class="invalid-feedback">Please enter an email address</div>
														</div>
													</div> -->
													<div class="col-lg-12 text-center">
														<button type="button" class="btn btn-red ms-auto nexttab nexttab mt-10 mb-10">Connect to Strip</button>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-6 col-md-12 col-12">
											<div class="sports-side-img text-center">
												<img src="http://dev.fitnessity.co/public/dashboard-design/images/fitnessity&stripe.png" alt="">
											</div>
										</div>
										<div class="d-flex align-items-start gap-3 mt-6">
											<button type="button" class="btn btn-black text-decoration-none btn-label previestab" data-previous="pills-info-desc-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Step 2</button>
											<button type="button" class="btn btn-red btn-label right ms-auto nexttab nexttab" data-nexttab="pills-step4-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Step 4</button>
										</div>										
									</div>
								</div>
								<!-- end tab pane -->
								
								<div class="tab-pane fade" id="pills-step4" role="tabpanel" aria-labelledby="pills-success-tab">
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
													<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
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
																<div class="col-lg-4 col-md-6 col-sm-6 mb-20">
																	<div class="packages">
																		<div>
																			<img src="http://dev.fitnessity.co/public/dashboard-design/images/dollar-coins.png" alt="">
																		</div>
																		<div class="basic-plan">
																			<h1>Pay as you go</h1>
																			<p>A simple start for everyone</p>
																		</div>
																		<div class="v-plan-cart">
																			<div class=" position-relative text-center">
																				<div class="d-flex justify-center align-center">
																					<sup class="text-sm me-1 mt-10">$</sup>
																					<h1 class="text1 text-5xl font-weight-medium font-red">0 </h1>
																					<h1 class="text2 text-5xl font-weight-medium font-red">0</h1>
																					<sub class="text-sm font-weight-medium ms-1 mt-4">/month</sub>
																				</div>
																			</div>
																			<div class="price-list">
																				<label class="text1">Free</label>
																			</div>
																		</div>
																		<div class="v-plan-details">
																			<ul>
																				<li>100 responses a month</li>
																				<li>Unlimited forms and surve</li>
																				<li>Unlimited fields</li>
																				<li>Basic form creation tools</li>
																				<li>Up to 2 subdomains</li>
																			</ul>
																		</div>
																		<div class="width-100">
																			<button type="submit" class="btn btn-red mt-25 width-100">Your Current Plan </button>
																		</div>
																	</div>
																</div>
																<div class="col-lg-4 col-md-6 col-sm-6 mb-20">
																	<div class="packages popular-box">
																		<div class="pxyz">
																			<span class="badge badge-soft-popular text-uppercase">Popular </span>
																		</div>
																		<div>
																			<img src="http://dev.fitnessity.co/public/dashboard-design/images/3d-safe-box.png" alt="">
																		</div>
																		<div class="basic-plan">
																			<h1>Basic </h1>
																			<p>For small to medium businesses</p>
																		</div>
																		<div class="v-plan-cart">
																			<div class=" position-relative text-center">
																				<div class="d-flex justify-center align-center">
																					<sup class="text-sm me-1 mt-10">$</sup>
																					<h1 class="text1 text-5xl font-weight-medium font-red">42 </h1>
																					<h1 class="text2 text-5xl font-weight-medium font-red">38</h1>
																					<sub class="text-sm font-weight-medium ms-1 mt-4">/month</sub>
																				</div>
																			</div>
																			<div class="price-list">
																				<label class="text1">USD 460/Year</label>
																			</div>
																		</div>
																		<div class="v-plan-details">
																			<ul>
																				<li>Unlimited responses</li>
																				<li>Unlimited forms and surv..</li>
																				<li>Instagram profile page</li>
																				<li>Google Docs integration</li>
																				<li>Custom “Thank you” pag..</li>
																			</ul>
																		</div>
																		<div class="width-100">
																			<button type="submit" class="btn btn-black mt-25 width-100">Upgrade</button>
																		</div>
																	</div>
																</div>
																<div class="col-lg-4 col-md-6 col-sm-6 mb-20">
																	<div class="packages">
																		<div>
																			<img src="http://dev.fitnessity.co/public/dashboard-design/images/3d-space-rocket.png" alt="">
																		</div>
																		<div class="basic-plan">
																			<h1>Pro</h1>
																			<p>Solution for big organizations</p>
																		</div>
																		<div class="v-plan-cart">
																			<div class=" position-relative text-center">
																				<div class="d-flex justify-center align-center">
																					<sup class="text-sm me-1 mt-10">$</sup>
																					<h1 class="text1 text-5xl font-weight-medium font-red">84</h1>
																					<h1 class="text2 text-5xl font-weight-medium font-red">57</h1>
																					<sub class="text-sm font-weight-medium ms-1 mt-4">/month</sub>
																				</div>
																			</div>
																			<div class="price-list">
																				<label class="text1">USD 690/Year</label>
																			</div>
																		</div>
																		<div class="v-plan-details">
																			<ul>
																				<li>PayPal payments</li>
																				<li>Logic Jumps</li>
																				<li>File upload with 5GB stora</li>
																				<li>Custom domain support</li>
																				<li>Stripe integration</li>
																			</ul>
																		</div>
																		<div class="width-100">
																			<button type="submit" class="btn btn-red mt-25 width-100">Upgrade</button>
																		</div>
																	</div>
																</div>
																
																<div class="col-lg-12">
																	<div class="bg-light-red mt-105 mb-55">
																		<div class="row">
																			<div class="col-lg-8 col-md-7 col-sm-12">
																				<div class="free-trial-text">
																					<h3> Still not convinced? Start with a 14-day FREE trial! </h3>
																					<p>You will get full access to all the features for 14 days. </p>
																					<button type="submit" class="btn btn-red "> Start-14-day FREE trial </button>
																				</div>
																			</div>
																			<div class="col-lg-4 col-md-5 col-sm-12">
																				<div class="steps-free-trial-img">
																					<img src="http://dev.fitnessity.co/public/dashboard-design/images/laptop-girl.png" alt="">
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																
																<div class="col-lg-12">
																	<div class="booking-titles text-center mt-70">
																		<h4 class="fs-18">Pick a plan that works best for you</h4>
																		<p>Stay cool, we have a 48-hour money back guarantee!</p>
																	</div>
																	<div class="row">
																		<div class="col-lg-12">
																			<div class="priceplan-table steps-table">
																				 <div class="table-responsive">
																					<table class="table table-borderless table-nowrap align-middle mb-25 mt-25">
																						<thead class="table-light">
																							<tr class="text-muted">
																								<th scope="col"> 
																									<h1 class="text-muted fs-12 mb-0 text-uppercase">FEATURES </h1>
																									<span class="text-muted fs-12 mb-0 text-uppercase"> Native Front Features </span>
																								</th>
																								<th scope="col">
																									<h1 class="text-muted fs-12 text-uppercase"> Pay As You Go
																									</h1>
																								</th>
																								<th scope="col" style="width: 20%;">
																									<h1 class="text-muted fs-12 text-uppercase"> BASIC </h1>
																								</th>
																								
																								<th scope="col" style="width: 16%;">
																									<h1 class="text-muted fs-12 text-uppercase"> Pro </h1>
																								</th>
																							</tr>
																						</thead>

																						<tbody>
																							<tr>
																								<td>14-days free trial</td>
																								<td>
																									<div class="check-right">
																										<i class="fas fa-check"></i>
																									</div>
																								</td>
																								<td>
																									<div class="check-right">
																										<i class="fas fa-check"></i>
																									</div>
																								</td>
																								<td>
																									<div class="check-right">
																										<i class="fas fa-check"></i>
																									</div>
																								</td>
																							</tr>
																							<tr>
																								<td>No user limit</td>
																								 <td>
																									<div class="check-wrong">
																										<i class="fas fa-times"></i>
																									</div>
																								</td>
																								<td>
																									<div class="check-wrong">
																										<i class="fas fa-times"></i>
																									</div>
																								</td>
																								<td>
																									<div class="check-right">
																										<i class="fas fa-check"></i>
																									</div>
																								</td>
																							</tr>
																							<tr>
																								<td>Product Support</td>
																								 <td>
																									<div class="check-wrong">
																										<i class="fas fa-times"></i>
																									</div>
																								</td>
																								<td>
																									<div class="check-right">
																										<i class="fas fa-check"></i>
																									</div>
																								</td>
																								<td>
																									<div class="check-right">
																										<i class="fas fa-check"></i>
																									</div>
																								</td>
																							</tr>
																							<tr>
																								<td>Email Support</td>
																								  <td>
																									<div class="check-wrong">
																										<i class="fas fa-times"></i>
																									</div>
																								</td>
																								<td>
																									<span class="badge badge-soft-red p-2"> ADD-ON AVAILABLE </span>
																								</td>
																								<td>
																									<div class="check-right">
																										<i class="fas fa-check"></i>
																									</div>
																								</td>
																							</tr>
																							<tr>
																								<td>Integrations</td>
																								<td>
																									<div class="check-wrong">
																										<i class="fas fa-times"></i>
																									</div>
																								</td>
																								<td>
																									<div class="check-right">
																										<i class="fas fa-check"></i>
																									</div>
																								</td>
																								<td>
																									<div class="check-right">
																										<i class="fas fa-check"></i>
																									</div>
																								</td>
																							</tr>
																							<tr>
																								<td>Removal of Front branding</td>
																								<td>
																									<div class="check-wrong">
																										<i class="fas fa-times"></i>
																									</div>
																								</td>
																								<td>
																									<span class="badge badge-soft-red p-2"> ADD-ON AVAILABLE </span>
																								</td>
																								<td>
																									<div class="check-right">
																										<i class="fas fa-check"></i>
																									</div>
																								</td>
																							</tr>
																							<tr>
																								<td>Active maintenance & support</td>
																								 <td>
																									<div class="check-wrong">
																										<i class="fas fa-times"></i>
																									</div>
																								</td>
																								<td>
																									<div class="check-wrong">
																										<i class="fas fa-times"></i>
																									</div>
																								</td>
																								<td>
																									<div class="check-right">
																										<i class="fas fa-check"></i>
																									</div>
																								</td>
																							</tr>
																							<tr>
																								<td>Data storage for 365 days</td>
																								 <td>
																									<div class="check-wrong">
																										<i class="fas fa-times"></i>
																									</div>
																								</td>
																								<td>
																									<div class="check-wrong">
																										<i class="fas fa-times"></i>
																									</div>
																								</td>
																								<td>
																									<div class="check-right">
																										<i class="fas fa-check"></i>
																									</div>
																								</td>
																							</tr>
																							<tr>
																								<td>Data storage for 365 days </td>
																								 <td>
																									<button type="submit" class="btn btn-red"> Choose Plan </button>
																								</td>
																								<td>
																									<button type="submit" class="btn btn-black"> Choose Plan </button>
																								</td>
																								<td>
																									<button type="submit" class="btn btn-red"> Choose Plan </button>
																								</td>
																							</tr>
																						</tbody><!-- end tbody -->
																					</table><!-- end table -->
																				</div><!-- end table responsive -->
																			</div>
																		</div>
																	</div>
																</div>
															
																<div class="col-lg-12 col-md-12  col-sm-12 col-12">
																	<div class="booking-titles text-center mb-20 mt-20">
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
																					2Checkout accepts all types of credit and debit cards.
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
											<button type="button" class="btn btn-black text-decoration-none btn-label previestab" data-previous="pills-success-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Step 3</button>
											
											<button type="button" class="btn btn-red btn-label right ms-auto nexttab nexttab" data-nexttab="pills-step4-tab"><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Step 5</button>
										</div>
									</div>
								</div>
								<!-- end tab pane -->
								
								<div class="tab-pane fade" id="pills-step5" role="tabpanel" aria-labelledby="pills-success-tab">
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
														<img src="http://dev.fitnessity.co/public/dashboard-design/images/ss-services.png" alt="">
													</div>
												</div>
											</div>
											
											<div class="text-left">
												<button type="button" class="btn btn-red ms-auto nexttab nexttab mt-10 mb-10 width-135">Create A Service</button>
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
														<img src="http://dev.fitnessity.co/public/dashboard-design/images/ss-dashboard.png" alt="">
													</div>
												</div>
											</div>
											
											
										</div>
										
										<div class="d-flex align-items-start gap-3 mt-4">
											<button type="button" class="btn btn-black text-decoration-none btn-label previestab" data-previous="pills-step4-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i>Step 4</button>
											<!--<button type="button" class="btn btn-red btn-label right ms-auto nexttab nexttab" data-nexttab="pills-step5-tab "><i class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Submit</button>-->
											<button type="button" class="btn btn-red ms-auto right nexttab nexttab mt-10 mb-10">Check Out The Features</button>
										</div>
									</div>
								</div>
								<!-- end tab pane -->
							</div>
							<!-- end tab content -->
						</form>
					</div>
					<!-- end card body -->
				</div>
			<!--<div class="col-6">
					<div class="sports-side-img text-center">
						<img src="http://dev.fitnessity.co/public/dashboard-design/images/sports-set.jpg" alt="">
					</div>
				</div>-->
			</div> <!-- end row-->
		</div><!-- container -->
		
	</div><!-- End Page-content -->
</div><!-- END layout-wrapper -->


<script>
	flatpickr(".flatpickr", {
		dateFormat: "m/d/Y",
		maxDate: "01/01/2050",
		defaultDate: [new Date()],
	});
	
	
</script>

<script>
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
</script>


@include('layouts.business.footer')
@endsection