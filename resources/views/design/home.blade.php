@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
@section('content')
@include('layouts.business.new-header')

	<div class="page-content-home">

		<div class="container-fuild">
			<div class="bg-cover home-banner-title" style="background-image: url(http://dev.fitnessity.co//public/dashboard-design/images/multi-img-banner.jpg);">
				<div class="pro-background-overlay-banner"></div>
				<div class="row">
					<div class="col-lg-7">
						<div class="fit-widget-container-banner">
							<label class="fs-65 mb-15">Find Next Place <br> To <span class="font-red"> Visit </span></label>
							<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
						</div>
					</div>
				</div>
				
			</div>
		</div>
			<!--<div class="container">
				<div class="row mb-3">
					<div class="col-lg-7 col-12">
						<div class="mb-15">
							<button type="submit" class="btn btn-grey shadow">Book With Us!</button>
						</div>
						<div class="banner0fonts">
							<label class="fs-65 mb-15">Find Next Place <br> To <span class="font-red"> Visit </span></label>
							<p class="fs-15">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
						</div>
					</div>
					<div class="col-lg-5 col-12">
						<div class="banner-img">
							<img src="http://dev.fitnessity.co//public/uploads/slider/thumb/1646832387-yoga%20classes.jpg">
						</div>
					</div>
					<div class="col-lg-9 col-12">
						<div class="set-searchbox">
							<div class="searchwrapper shadow">
								<div class="searchbox">
									<div class="row">
										<div class="col-lg-6 col-sm-4 col-md-6 col-6">
											<input type="text" class="form-control padding-lrtb-one" placeholder="Search by Activity, Business, Person, Username">
										</div>
										<div class="col-lg-4 col-sm-4 col-md-4 col-6">
											<input type="text" class="form-control no-side-border padding-lrtb" placeholder="Search by country, city, state, zip">
										</div>
										<div class="col-lg-2 col-sm-4 col-md-2 col-12">
											<button type="button" class="btn btn-red" class="form-control"><i class="fa fa-search livesearch"></i>Search</button>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div> -->

		<!--<div class="hpb-100">
			<div class="container">
				<div class="row mb-3">
					<div class="col-lg-7 col-12">
						<div class="mb-15">
							<button type="submit" class="btn btn-grey shadow">Book With Us!</button>
						</div>
						<div class="banner0fonts">
							<label class="fs-65 mb-15">Find Next Place <br> To <span class="font-red"> Visit </span></label>
							<p class="fs-15">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
						</div>
					</div>
					<div class="col-lg-5 col-12">
						<div class="banner-img">
							<img src="http://dev.fitnessity.co//public/uploads/slider/thumb/1646832387-yoga%20classes.jpg">
						</div>
					</div>
					<div class="col-lg-9 col-12">
						<div class="set-searchbox">
							<div class="searchwrapper shadow">
								<div class="searchbox">
									<div class="row">
										<div class="col-lg-6 col-sm-4 col-md-6 col-6">
											<input type="text" class="form-control padding-lrtb-one" placeholder="Search by Activity, Business, Person, Username">
										</div>
										<div class="col-lg-4 col-sm-4 col-md-4 col-6">
											<input type="text" class="form-control no-side-border padding-lrtb" placeholder="Search by country, city, state, zip">
										</div>
										<div class="col-lg-2 col-sm-4 col-md-2 col-12">
											<button type="button" class="btn btn-red" class="form-control"><i class="fa fa-search livesearch"></i>Search</button>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>-->
		
		<div class="bg-grey hpt-100 hpb-100">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="home-main-title mb-30">
							<h2>View All Activities</h2>
						</div>
					</div>	
					
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12">
						<div class="taxonomy-item taxonomy-card">
							<a class="taxonomy-link hover-effect" href="#">
								<div class="taxonomy-title">Stay Active With Fun Things To Do </div>
								<img class="img-responsive" src="http://dev.fitnessity.co//public/uploads/slider/thumb/1648141166-snowboarding.jpg">
							</a>
						</div>
					</div>
					
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-12">
						<div class="taxonomy-item taxonomy-card">
							<a class="taxonomy-link hover-effect" href="#">
								<div class="taxonomy-title">Products & Gear</div>
								<img class="img-responsive" src="https://fitnessity-production.s3.amazonaws.com/activity/S8DTAfpqVGP5ItziWc1H5JZVpmzKCy6MvcjFwIFw.jpg">
							</a>
						</div>
					</div>
					
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-12">
						<div class="taxonomy-item taxonomy-card">
							<a class="taxonomy-link hover-effect" href="#">
								<div class="taxonomy-title">Find Events </div>
								<img class="img-responsive" src="https://fitnessity-production.s3.amazonaws.com/activity/hRaDXKY7LX9XAuBp73XuNI4tlzMaJTpN1DC5vnqw.jpg">
							</a>
						</div>
					</div>
					
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-12">
						<div class="taxonomy-item taxonomy-card">
							<a class="taxonomy-link hover-effect" href="#">
								<div class="taxonomy-title">Find Ways to Workout</div>
								<img class="img-responsive" src="https://fitnessity-production.s3.amazonaws.com/activity/bKNSsvUN6bVxgbWaggKgcpyfaE1HOWlWPw82ZIoc.jpg">
							</a>
						</div>
					</div>
					
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-12">
						<div class="taxonomy-item taxonomy-card">
							<a class="taxonomy-link hover-effect" href="#">
								<div class="taxonomy-title">Find A Personal Training Session </div>
								<img class="img-responsive" src="https://fitnessity-production.s3.amazonaws.com/activity/8O4Vj1isE1acmqtEZZBIvWcnDmNYlWNfCz0tgRez.jpg">
							</a>
						</div>
					</div>
					
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12">
						<div class="taxonomy-item taxonomy-card">
							<a class="taxonomy-link hover-effect" href="#">
								<div class="taxonomy-title">View All </div>
								<img class="img-responsive" src="http://dev.fitnessity.co//public/uploads/slider/thumb/1646834734-ACTIVITES BACKGROUND.jpg">
							</a>
						</div>
					</div>
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 text-center">
						<button type="button" class="btn btn-red fs-15 btn-w-130 mt-30">Find More</button>
					</div>
					
				</div>
			</div>
		</div>
		
		<!--<div class="bg-grey hpt-100 hpb-100">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="home-main-title mb-30">
							<h2>View All Activities</h2>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="project-item">
                            <div class="project-img">
                                <a href="#"><img src="http://dev.fitnessity.co//public/uploads/slider/thumb/1648141166-snowboarding.jpg"></a>
                            </div>
                            <div class="project-content">
                                <div class="portfolio-inner">
                                    <h3 class="title"><a href="#">Find A Personal Training Session </a></h3>
                                    <span class="category"><a href="#">Book a Private lesson for the activity that interests you.</a></span>
                                </div>
                            </div>
                        </div>
					</div>
					
					<div class="col-lg-3">	
						<div class="project-item">
                            <div class="project-img">
                                <a href="#"><img src="http://dev.fitnessity.co//public/uploads/slider/thumb/1646835416-soccer coaches.jpg"></a>
                            </div>
                            <div class="project-content">
                                <div class="portfolio-inner">
                                    <h3 class="title"><a href="#">Find Ways to Workout </a></h3>
                                    <span class="category"><a href="#">Book classes, seminars, workshops, camps, and more</a></span>
                                </div>
                            </div>
                        </div>
					</div>
					
					<div class="col-lg-3">	
						<div class="project-item">
                            <div class="project-img">
                                <a href="#"><img src="http://dev.fitnessity.co//public/uploads/slider/thumb/1646834734-ACTIVITES BACKGROUND.jpg" ></a>
                            </div>
                            <div class="project-content">
                                <div class="portfolio-inner">
                                    <h3 class="title"><a href="#">Stay Active With Fun Things To Do </a></h3>
                                    <span class="category"><a href="#">Turn your weekend of vacation into an adventure</a></span>
                                </div>
                            </div>
                        </div>
					</div>
					
					<div class="col-lg-3">	
						<div class="project-item">
                            <div class="project-img">
                                <a href="#"><img src="http://dev.fitnessity.co//public/uploads/slider/thumb/1646834734-ACTIVITES BACKGROUND.jpg"></a>
                            </div>
                            <div class="project-content">
                                <div class="portfolio-inner">
                                    <h3 class="title"><a href="#">Find Events </a></h3>
                                    <span class="category"><a href="#">Search for events near you</a></span>
                                </div>
                            </div>
                        </div>
					</div>
					
					<div class="col-lg-3">	
						<div class="project-item">
                            <div class="project-img">
                                <a href="#"><img src="http://dev.fitnessity.co//public/uploads/slider/thumb/1646834734-ACTIVITES BACKGROUND.jpg"></a>
                            </div>
                            <div class="project-content">
                                <div class="portfolio-inner">
                                    <h3 class="title"><a href="#">Products & Gear </a></h3>
                                    <span class="category"><a href="#">Purchase or rent gear and more for your bookings</a></span>
                                </div>
                            </div>
                        </div>
					</div>
					
					<div class="col-lg-6">
						<div class="project-item">
                            <div class="project-img">
                                <a href="#"><img src="http://dev.fitnessity.co//images/beapart_bg.jpg"></a>
                            </div>
                            <div class="project-content">
                                <div class="portfolio-inner">
                                    <h3 class="title"><a href="#">View All </a></h3>
                                    <span class="category"><a href="#">Take a look around and explore your options</a></span>
                                </div>
                            </div>
                        </div>
					</div>
					
				</div>
			</div>
		</div>-->
		
		
		<div class="hpb-100">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12 col-xs-12 nopadding">
						<div class="home-black-section">
							<label>EXPLORE RESERVE YOUR SPOT IN  AN ACTIVITY <br> HAPPENING IN THE NEXT 8 HRS</label>
							<i class="fa fa-caret-down"></i>
						</div>
						<div class="fsth-0 fsbh-1">
							<div class="container-fluid">
								<div class="row">
									<div class="col-lg-10 col-md-10">
										<div class="title">
											<h3 class="f-16">Find Activities Starting In The Next 8 Hrs for Thursday, October 05, 2023</h3>
										</div>
									</div>
									<div class="col-lg-2 col-md-2 col-xs-12"> 
										<div class="title-show">
											<a href="http://dev.fitnessity.co/activities/next_8_hours">Show All</a>
										</div>
									</div>
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<div class="find-activity">
											<div class="row y-middle">
												<div class="col-lg-4 col-md-4 col-sm-4 col-4">
													<img src="https://fitnessity-production.s3.amazonaws.com/activity/S8DTAfpqVGP5ItziWc1H5JZVpmzKCy6MvcjFwIFw.jpg">
												</div>
												<div class="col-lg-8 col-md-8 col-sm-8 col-8 activity-data">
													<div class="row">
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
															<div class="activity-inner-data">
																<i class="fas fa-star"></i>
																<span> 4 (1) </span>
															</div>

															<div class="activity-hours">
																<span>1 hour</span>
															</div>
														</div>
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
															<div class="activity-city">
																<span style="white-space: nowrap;">New York</span>
																<div class="serv_fav1" ser_id="124" data-id="serfavstarts">
																	<a class="fav-fun-2" id="serfavstarts124">
																	<i class="fas fa-heart"></i></a>
																</div>
															</div>
														</div>
													</div>
													<div class="activity-information ">
														<span>
															<a href="http://dev.fitnessity.co/businessprofile/Fitness%20Pvt.%20Ltd./68" target="_blank">Spring Lake Day Camp</a>
														</span>
														<p>Experience | Day Camp</p>
														<a class="showall-btn" href="http://dev.fitnessity.co/activity-details/124">Book Now</a>
													</div>
													<div class="row">
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6 activites-price-details">
															<div class="dollar-person">
																<span>From $50/Person</span>
															</div>
														</div>
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6 activites-price-details-left">
															<div class="activity-time-main activity-time-main-red">
																<span>Starts in	1 hr</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div> 
									</div>
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<div class="find-activity">
											<div class="row y-middle">
												<div class="col-lg-4 col-md-4 col-sm-4 col-4">
													<img src="https://fitnessity-production.s3.amazonaws.com/activity/q4UxwuaI2PIgmrucdj1UXx4NidpxWtEx5NvUz71H.jpg">
												</div>
												<div class="col-lg-8 col-md-8 col-sm-8 col-8 activity-data">
													<div class="row">
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
															<div class="activity-inner-data">
																<i class="fas fa-star"></i>
																<span> 5 (1) </span>
															</div>
															<div class="activity-hours">
																<span>45 minutes</span>
															</div>
														</div>
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
															<div class="activity-city">
																<span style="white-space: nowrap;">New York</span>
																<div class="serv_fav1" ser_id="114" data-id="serfavstarts">
																	<a class="fav-fun-2" id="serfavstarts114">
																	<i class="far fa-heart"></i></a>
																</div>
															</div>
														</div>
													</div>
													<div class="activity-information ">
														<span>
															<a href="http://dev.fitnessity.co/businessprofile/Fitness%20Pvt.%20Ltd./68" target="_blank">Love Tennis</a>
														</span>
														<p>Personal Training | Tennis</p>
														<a class="showall-btn" href="http://dev.fitnessity.co/activity-details/114">Book Now</a>
													</div>
													<div class="row">
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6  activites-price-details">
															<div class="dollar-person">
																<span>From $500/Person</span>
															</div>
														</div>
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6  activites-price-details-left">
															<div class="activity-time-main activity-time-main-red">
																<span>Starts in 1 hr 30 mins</span>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div> 
									</div>
									<div class="col-lg-4 col-md-6 col-sm-6 col-12">
										<div class="find-activity">
											<div class="row y-middle">
												<div class="col-lg-4 col-md-4 col-sm-4 col-4">
													<img src="https://fitnessity-production.s3.amazonaws.com/activity/rr4c2ehnJWgy5sDhh3VXSwKEBCr8QldeJ38h4TzE.jpg">
												</div>
												<div class="col-lg-8 col-md-8 col-sm-8 col-8 activity-data">
													<div class="row">
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
															<div class="activity-inner-data">
																<i class="fas fa-star"></i>
																<span> 2.5 (2) </span>
															</div>
															<div class="activity-hours">
																<span>45 minutes</span>
															</div>
														</div>
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
															<div class="activity-city">
																<span style="white-space: nowrap;">New York</span>
																<div class="serv_fav1" ser_id="36" data-id="serfavstarts">
																	<a class="fav-fun-2" id="serfavstarts36">
																		<i class="fas fa-heart"></i></a>
																</div>
															</div>
														</div>
													</div>
													<div class="activity-information ">
														<span>
															<a href="http://dev.fitnessity.co/businessprofile/Fitness%20Pvt.%20Ltd./68" target="_blank">Extreme Bungee Jumping</a>
														</span>
														<p>Experience | Bungee Jumping</p>
														<a class="showall-btn" href="http://dev.fitnessity.co/activity-details/36">Book Now</a>
													</div>
													<div class="row">
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6  activites-price-details">
															<div class="dollar-person">
																<span>From $12/Person</span>
															</div>
														</div>
														<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6  activites-price-details-left">
															<div class="activity-time-main activity-time-main-red">
																<span>Starts in 1 hr 30 mins </span>
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
		
		<div class="bg-grey hpt-100 hpb-100">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="home-main-title mb-30">
							<h2>Discover Our Top Destinations</h2>
						</div>
					</div>		
					
					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
						<div class="taxonomy-item taxonomy-item-v2">
							<div class="taxonomy-item-image">
								<a class="taxonomy-link hover-effect" href="#">
									<img class="img-responsive" src="http://dev.fitnessity.co//public/uploads/slider/thumb/1646834734-ACTIVITES BACKGROUND.jpg">
								</a>	
							</div>
							<div class="taxonomy-item-content">
								<h3 class="taxonomy-title">
									<a href="#">New York City</a>
									<a href="#">United States</a>
								</h3>
								<div class="taxonomy-description">
									5 Activities
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
						<div class="taxonomy-item taxonomy-item-v2">
							<div class="taxonomy-item-image">
								<a class="taxonomy-link hover-effect" href="#">
									<img class="img-responsive" src="https://fitnessity-production.s3.amazonaws.com/activity/agnLoERqZaRjzjKffSzxzq2BH54AekTZJQ4bH4ol.jpg">
								</a>	
							</div>
							<div class="taxonomy-item-content">
								<h3 class="taxonomy-title">
									<a href="#">Los Angeles</a>
									<a href="#">United States</a>
								</h3>
								<div class="taxonomy-description">
									10 Activities
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
						<div class="taxonomy-item taxonomy-item-v2">
							<div class="taxonomy-item-image">
								<a class="taxonomy-link hover-effect" href="#">
									<img class="img-responsive" src="https://fitnessity-production.s3.amazonaws.com/activity/yaePqSO8Id6w8KUS63jk2Ye4s5A9cW6Ytp5jufj0.jpg">
								</a>	
							</div>
							<div class="taxonomy-item-content">
								<h3 class="taxonomy-title">
									<a href="#">Chicago</a>
									<a href="#">United States</a>
								</h3>
								<div class="taxonomy-description">
									7 Activities
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-lg-3 col-md-6 col-sm-6 col-12">
						<div class="taxonomy-item taxonomy-item-v2">
							<div class="taxonomy-item-image">
								<a class="taxonomy-link hover-effect" href="#">
									<img class="img-responsive" src="https://fitnessity-production.s3.amazonaws.com/activity/0BONWLWRLmu672gJmdMvxmoVTIYgfey3X23klhXE.jpg">
								</a>	
							</div>
							<div class="taxonomy-item-content">
								<h3 class="taxonomy-title">
									<a href="#">Miami</a>
									<a href="#">United States</a>
								</h3>
								<div class="taxonomy-description">
									7 Activities
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="hpt-100 hpb-100">
			<div class="container">
				<div class="row">
					<div class="col-lg-4">
						<div class="fitness-title mb-5">
							<h1>Why <span>Fitnessity?</span></h1>
						</div>
						
					</div>
					<div class="col-lg-8 hpl-50">
						<div class="amazonaws">
							<img src="https://fitnessity-production.s3.amazonaws.com/activity/bKNSsvUN6bVxgbWaggKgcpyfaE1HOWlWPw82ZIoc.jpg" >
						</div>
					</div>
					<!--<div class="col-lg-8">
						<div class="why-fit-vd">
							<video id="ban_video" class="tv-video">
								<source src="http://dev.fitnessity.co/public/uploads/cms/videos/e89af2028bd85191bf1cfd898f79bcf0.mp4" type="video/mp4">
								Your browser does not support the video tag.
							</video>
							<div class="play-bt video-icon"><i class="fa fa-play"></i></div>
							<div class="pause-bt video-icon" style="display: none;"><i class="fa fa-pause"></i></div>
						</div>
					</div>-->
					<div class="col-lg-4">
						<div class="info-imgs mt--25">
							<img src="http://dev.fitnessity.co/public/uploads/discover/thumb/1649648221-snow ski.jpg">
						</div>
					</div>
					<div class="col-lg-8 hpl-50">
						<div class="row">
							<div class="col-lg-6">
								<div class="services-item mt-25 mb-15">
									<div class="number_format">
										<label>1.</label>
									</div>
									<div class="info-content">
										<div class="services-text">
											<h3 class="title">A simple way to book active experiences online</h3>
										</div>
										<div class="services-desc">
											<p>Finding the right activity, workout, trainer or adventure can be overwhelming and time-consuming. Browse thousands active experiences from personal training, coaching, fitness classes, adventures & tours & much more.</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-6">	
								<div class="services-item mt-25 mb-15">
									<div class="number_format">
										<label>2.</label>
									</div>
									<div class="info-content">
										<div class="services-text">
											<h3 class="title">A seamless booking process that saves time </h3>
										</div>
										<div class="services-desc">
											<p>Book for yourself or a family in one go. Choose an unlimited amount of activities or products and add it to the cart. Fitnessity handles all scheduling, and payments securely on your behalf. </p>
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-lg-6">	
								<div class="services-item mb-15">
									<div class="number_format">
										<label>3.</label>
									</div>
									<div class="info-content">
										<div class="services-text">
											<h3 class="title">Compare programs and prices</h3>
										</div>
										<div class="services-desc">
											<p>With the 'Add to Compare' feature, you can compare up to 3 activities and service providers, viewing details about the various programs, staff, reviews, prices, certifications, and much more.</p>
										</div>
									</div>
								</div>
							</div>
							
							<div class="col-lg-6">	
								<div class="services-item mb-15">
									<div class="number_format">
										<label>4.</label>
									</div>
									<div class="info-content">
										<div class="services-text">
											<h3 class="title">Get Motivated </h3>
										</div>
										<div class="services-desc">
											<p>Whether you like to participate in activities one-on-one, with family, friends, or in a group, let Fitnessity be your accountability partner. Join the active community on the only dedicated social network for fitness. Network, share, comment & meet like-minded people interested in getting or staying active. Find your new fit fam at Fitnessity!</p>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="text-center">
									<a class="btn btn-red" href="http://dev.fitnessity.co/createNewBusinessProfile">Join Today</a>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="bg-grey hpt-100 hpb-100">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="home-main-title mb-30">
							<h2>Discover Activities</h2>
							<p> Get connected to Activities you love or explore a new one</p>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6 col-md-6">
						<div class="fit-project-item mb-30">
							<div class="project-img">
								<img src="http://dev.fitnessity.co//public/uploads/discover/thumb/1649648909-tennis 1.jpg" alt="images">
								<div class="discover-title">
									<h2>Book a Personal Trainer</h2>
								</div>
							</div>
							<div class="project-content"> 
								<div class="project-inner">
									<span class="category">
										Take your training to a new level with one-on-one lessons from from top trainers, coaches, instructors, and therapists.
									</span>
								</div>
							</div>
						</div>						
					</div>
					
					<div class="col-lg-3 col-sm-6 col-md-6">
						<div class="fit-project-item mb-30">
							<div class="project-img">
								<img src="http://dev.fitnessity.co//public/uploads/discover/thumb/1649648481-yoga classes.jpg" alt="images">
								<div class="discover-title">
									<h2>Book Fitness Classes</h2>
								</div>
							</div>
							<div class="project-content"> 
								<div class="project-inner">
									<span class="category">
										Participate in group classes that you love or discover new, hard-to-find favorites.
									</span>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-lg-3 col-sm-6 col-md-6">
						<div class="fit-project-item mb-30">
							<div class="project-img">
								<img src="http://dev.fitnessity.co//public/uploads/discover/thumb/1649648221-snow ski.jpg" alt="images">
								<div class="discover-title">
									<h2>Find Adventure Experiences</h2>
								</div>
							</div>
							<div class="project-content"> 
								<div class="project-inner">
									<span class="category">
										Turn your weekend or vacation into and adventure.
									</span>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-lg-3 col-sm-6 col-md-6">
						<div class="fit-project-item mb-30">
							<div class="project-img">
								<img src="http://dev.fitnessity.co//public/uploads/discover/thumb/1649648161-soccer coaches.jpg" alt="images">
								<div class="discover-title">
									<h2>Find Activities for Kids</h2>
								</div>
							</div>
							<div class="project-content"> 
								<div class="project-inner">
									<span class="category">
										Find activities to keep your kids engaged, active, and in shape.
									</span>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<!--<div class="bg-grey hpt-100 hpb-100">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="home-main-title mb-30">
							<h2>Discover Activities</h2>
							<p> Get connected to Activities you love or explore a new one</p>
						</div>
					</div>
					
					<div class="col-lg-4">
						<div class="dis-activity-box shadow">
							<a href="#">
								<div class="row y-middle">
									<div class="col-lg-4">
										<div class="dis-activity">	
											<img src="http://dev.fitnessity.co//public/uploads/discover/thumb/1649648909-tennis 1.jpg" alt="">
										</div>
									</div>
									<div class="col-lg-8">
										<div class="dis-activity-title">
											<h3>BOOK A PERSONAL TRAINER</h3>
											<p>Take your training to a new level with one-on-one lessons from from top trainers, coaches, instructors, and therapists.</p>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					
					<div class="col-lg-4">
						<div class="dis-activity-box shadow">
							<a href="#">
								<div class="row y-middle">
									<div class="col-lg-4">
										<div class="dis-activity">	
											<img src="http://dev.fitnessity.co//public/uploads/discover/thumb/1649648481-yoga classes.jpg" alt="">
										</div>
									</div>
									<div class="col-lg-8">
										<div class="dis-activity-title">
											<h3>BOOK FITNESS CLASSES</h3>
											<p>Participate in group classes that you love or discover new, hard-to-find favorites.</p>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					
					<div class="col-lg-4">
						<div class="dis-activity-box shadow">
							<a href="#">
								<div class="row y-middle">
									<div class="col-lg-4">
										<div class="dis-activity">	
											<img src="http://dev.fitnessity.co//public/uploads/discover/thumb/1649648221-snow ski.jpg" alt="">
										</div>
									</div>
									<div class="col-lg-8">
										<div class="dis-activity-title">
											<h3>FIND ADVENTURE EXPERIENCES</h3>
											<p>Turn your weekend or vacation into and adventure.</p>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					
					<div class="col-lg-4">
						<div class="dis-activity-box shadow">
							<a href="#">
								<div class="row y-middle">
									<div class="col-lg-4">
										<div class="dis-activity">	
											<img src="http://dev.fitnessity.co//public/uploads/discover/thumb/1649648161-soccer coaches.jpg" alt="">
										</div>
									</div>
									<div class="col-lg-8">
										<div class="dis-activity-title">
											<h3>FIND ACTIVITIES FOR KIDS</h3>
											<p>Find activities to keep your kids engaged, active, and in shape.</p>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					
					<div class="col-lg-4">
						<div class="dis-activity-box shadow">
							<a href="#">
								<div class="row y-middle">
									<div class="col-lg-4">
										<div class="dis-activity">	
											<img src="http://dev.fitnessity.co//public/uploads/discover/thumb/1649668850-massage.jpg" alt="">
										</div>
									</div>
									<div class="col-lg-8">
										<div class="dis-activity-title">
											<h3>BOOK HEALTH AND WELLNESS</h3>
											<p>Book a stretch, nutritionists, physical therapists, sports medicine, or massage therapists professional and get the proper preparation and recovery care.</p>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					
					<div class="col-lg-4">
						<div class="dis-activity-box shadow">
							<a href="#">
								<div class="row y-middle">
									<div class="col-lg-4">
										<div class="dis-activity">	
											<img src="http://dev.fitnessity.co//public/uploads/discover/thumb/1649649049-sporty-black-man-making-fist-plank-exercise-in-royalty-free-image-1592516283.jpg" alt="">
										</div>
									</div>
									<div class="col-lg-8">
										<div class="dis-activity-title">
											<h3>BOOK ACTIVITIES ONLINE</h3>
											<p>Participate in activities you love from your office, home, or while traveling.</p>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
					
				</div>
			</div>
		</div> -->
		
		<div class="hpt-100 hpb-100 ">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="providers-bg-image">
							<div class="pro-background-overlay"></div>
							<div class="fit-widget-container">
								<h2>Are You a Local Business?</h2>
								<p>Join the community of hundreds of flourishing local business in your city.</p>
								<div>
									<a href="#" class="btn btn-red btn-w-130 fs-15 mr-10 mb-10">Get Started</a>
									<a href="#" class="btn btn-border-white btn-w-180 fs-15 mb-10">Claim Your Business</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="hpt-100 hpb-100 joinus-bg-image">
			<div class="container">
				<div class="row">
					<div class="col-lg-8">
						<div class="up-down-sp">
							<div class="joinus-box">
								<div class="join-title mb-5">
									<h1>Join us <span>It's Easy</span></h1>
								</div>
								<div class="join-box-text">
									<p>One platform for your complete active lifestyle.</p>
									<p>We take care of all your bookings, scheduling, payments, and vetting of service providers.</p>
									<p>Fitnessity is the simplest way to find your next activity.</p>
									
									<ul class="mb-4">
										<li>Search and choose an activity </li>
										<li>Compare providers and services</li>
										<li>Book your activity... and get moving</li>
									</ul>
									
									<a href="/registration" class="btn btn-red">START TODAY</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div><!-- End Page-content -->
</div><!-- END layout-wrapper -->

<!--<script>

        var video1 = document.getElementById("ban_video");
        if (typeof(video1) != 'undefined' && video1 != null)
        {
          video1.currentTime = 0;
        }
        $(".mute-bt").click(function() {
            if ($(this).hasClass("stop")) {
                var ban_video = document.getElementById("ban_video");
                $("#ban_video").prop('muted', false);
                $(this).removeClass("stop");
            } else {
                var ban_video = document.getElementById("ban_video");
                $("#ban_video").prop('muted', true);
                $(this).addClass("stop");
            }
        });
        $(".play-bt").click(function() {
            $(".play-bt").hide();
            $(".pause-bt").show();
            var ban_video = document.getElementById("ban_video");
            if ($(".stop-bt").hasClass("active")) {
                ban_video.currentTime = 0;
            }
            ban_video.play();
        });
        $(".pause-bt").click(function() {
            $(".play-bt").show();
            $(".pause-bt").hide();
            $(".pause-bt").addClass("active");
            $(".stop-bt").removeClass("active");
            var ban_video = document.getElementById("ban_video");
            ban_video.pause();
        });
</script> -->
@include('layouts.business.footer')
@endsection