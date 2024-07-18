@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>

    <meta charset="utf-8" />
    <title>Fitnessity </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">


    <!-- Layout config Js-->
    <script src="{{asset('/public/dashboard-design/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('/public/dashboard-design/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/public/dashboard-design/css/simplebar.min.css')}}" rel="stylesheet" type="text/css" />
	
    <!-- Style Css-->
    <link href="{{asset('/public/dashboard-design/css/style.css')}}" rel="stylesheet" type="text/css" />
	
	<!-- Custom Css-->
    <link href="{{asset('/public/dashboard-design/css/custom.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('/public/dashboard-design/css/responsive.css')}}" rel="stylesheet" type="text/css" />
	
	<!-- icon -->
	<link rel="stylesheet" type="text/css" href="{{asset('/public/dashboard-design/css/icons.min.css')}}" />


</head>
@section('content')


    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.business.business_topbar')
	
		<!-- ========== App Menu ========== -->
        @include('layouts.business.businesssidebar')

        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

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
											<label>Create Services & Prices</label>
										</div>
									</div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
								<div class="row">
									<div class="col-md-12">
										<div class="card">
											<div class="card-body">
												<!-- Nav tabs -->
												<ul class="nav nav-tabs nav-tabs-custom nav-success nav-justified mb-3" role="tablist">
													<li class="nav-item">
														<a class="nav-link service-nav active" data-bs-toggle="tab" href="#home1" role="tab">
															Personal Trainer
														</a>
													</li>
													<li class="nav-item">
														<a class="nav-link service-nav" data-bs-toggle="tab" href="#profile1" role="tab">
															Classes
														</a>
													</li>
													<li class="nav-item">
														<a class="nav-link service-nav" data-bs-toggle="tab" href="#messages1" role="tab">
															Experience
														</a>
													</li>
													<li class="nav-item">
														<a class="nav-link service-nav" data-bs-toggle="tab" href="#settings1" role="tab">
															Events
														</a>
													</li>
												</ul>

												<!-- Tab panes -->
												<div class="tab-content text-muted">
													<div class="tab-pane active" id="home1" role="tabpanel">
														<div class="row">
															<div class="col-lg-2 col-md-4 col-6">
																<input type="button" class="btn service-btn wp-100" value="Create Service">
															</div>
															<div class="col-lg-2 col-md-4 col-6">
																<div class="dropdown mb-15">
																	<button class="btn btn-secondary btn-selection dropdown-toggle wp-100" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
																		Manage Service
																	</button>
																	<ul class="dropdown-menu dropdown-menu-dark selection-item-wrap" aria-labelledby="dropdownMenuButton2" style="">
																		<li><a class="dropdown-item active" href="#">Dance - Winter Dance Activity </a></li>
																		<li><a class="dropdown-item" href="#">Tennis - Love Tennis</a></li>
																		<li><a class="dropdown-item" href="#">Badminton - Global Academy for Badminton</a></li>
																		<li><a class="dropdown-item" href="#">Beach Vollyball - Summer Aerobics</a></li>
																		<li><a class="dropdown-item" href="#">Canoeing - Summer Yoga</a></li>
																	</ul>
																</div>
															</div>
															<div class="col-md-12">
																<div class="personal-trainer">
																	<p>Add the details and prices for your personal training services.</p>
																</div>
																<!-- Accordions -->
																<div class="accordion nesting-accordion custom-accordionwithicon accordion-border-box" id="accordionnestingone">
																	<div class="accordion-item">
																		<h2 class="accordion-header tips-accordion" id="accordionnestingExample1">
																			<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse1" aria-expanded="true" aria-controls="accor_nestingExamplecollapse1">
																				Recommended Tips to Do :
																			</button>
																		</h2>
																		<div id="accor_nestingExamplecollapse1" class="accordion-collapse collapse show" aria-labelledby="accordionnestingExample1" data-bs-parent="#accordionnestingone">
																			<div class="accordion-body tips">
																				<ul>
																					<li>Create a professional profile. It's your website and resumer to potential clients.</li>
																					<li>Sell your business and show what makes your business the best.</li>
																					<li>Take professional high-resolution pictures.</li>
																					<li>Showcase your certifications, awards, education, and experience.</li>
																				</ul>
																			</div>
																		</div>
																	</div>
																  
																	<div class="accordion-item">
																		<h2 class="accordion-header tips-accordion" id="accordionnestingExample2">
																			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse2" aria-expanded="false" aria-controls="accor_nestingExamplecollapse2">
																				Tips Not to Do :
																			</button>
																		</h2>
																		<div id="accor_nestingExamplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample2" data-bs-parent="#accordionnestingone">
																			<div class="accordion-body tips">
																				<ul>
																					<li>You have images that are not professional, creepy, or uncomfortable to clients.</li>
																					<li>Not having a well-planned experiences.</li>
																					<li>Just going with the flow will not give you repeat business.</li>
																					<li>Creating a generic service that customers can easily do on their own.</li>
																					<li>Offering a service or experience you are not qualified or skilled to do.</li>
																				</ul>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="tab-pane" id="profile1" role="tabpanel">
														<div class="row">
															<div class="col-lg-2 col-md-4 col-6">
																<input type="button" class="btn service-btn wp-100" value="Create Service">
															</div>
															<div class="col-lg-2 col-md-4 col-6">
																<div class="dropdown mb-15">
																	<button class="btn btn-secondary btn-selection dropdown-toggle wp-100" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
																		Manage Service
																	</button>
																	<ul class="dropdown-menu dropdown-menu-dark selection-item-wrap" aria-labelledby="dropdownMenuButton2" style="">
																		<li><a class="dropdown-item active" href="#">Dance - Summer Dance </a></li>
																		<li><a class="dropdown-item" href="#">Kung Fu - World Kungfu Championships </a></li>
																		<li><a class="dropdown-item" href="#">Day Camp - Aerobics 2022 </a></li>
																	</ul>
																</div>
															</div>
															<div class="col-md-12">
																<div class="personal-trainer">
																	<p>Add the details for your group class, boot camp, clinic, and more.</p>
																</div>
																<!-- Accordions -->
																<div class="accordion nesting-accordion custom-accordionwithicon accordion-border-box" id="accordionnestingtwo">
																	<div class="accordion-item">
																		<h2 class="accordion-header tips-accordion" id="accordionnestingExample3">
																			<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse3" aria-expanded="true" aria-controls="accor_nestingExamplecollapse3">
																				Recommended Tips to Do :
																			</button>
																		</h2>
																		<div id="accor_nestingExamplecollapse3" class="accordion-collapse collapse show" aria-labelledby="accordionnestingExample3" data-bs-parent="#accordionnestingtwo">
																			<div class="accordion-body tips">
																				<ul>
																					<li>Create a professional profile. It's your website and resumes to potentials clients.</li>
																					<li>Sell your business and show what makes your business the best</li>
																					<li>Take professional pictures and make your customers feel welcomed.</li>
																				</ul>
																			</div>
																		</div>
																	</div>
																	  
																	<div class="accordion-item">
																		<h2 class="accordion-header tips-accordion" id="accordionnestingExample4">
																			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse4" aria-expanded="false" aria-controls="accor_nestingExamplecollapse4">
																				Tips Not to Do :
																			</button>
																		</h2>
																		<div id="accor_nestingExamplecollapse4" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample4" data-bs-parent="#accordionnestingtwo">
																			<div class="accordion-body tips">
																				<ul>
																					<li>Posting images or videos that are not of professional manner, creepy, or uncomfortable.</li>
																					<li>Not having a well-planned experience.</li>
																					<li>Just going with the flow will not give you repeat business.</li>
																					<li>Creating a generic service that customers can easily do on their own.</li>
																					<li>Offering a service you are not qualified or skilled to do.</li>
																				</ul>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="tab-pane" id="messages1" role="tabpanel">
														<div class="row">
															<div class="col-lg-2 col-md-4 col-6">
																<input type="button" class="btn service-btn wp-100" value="Create Service">
															</div>
															<div class="col-lg-2 col-md-4 col-6">
																<div class="dropdown mb-15">
																	<button class="btn btn-secondary btn-selection dropdown-toggle wp-100" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
																		Manage Service
																	</button>
																	<ul class="dropdown-menu dropdown-menu-dark selection-item-wrap" aria-labelledby="dropdownMenuButton2" style="">
																		<li><a class="dropdown-item active" href="#">Day Camp - Spring Lake Day Camp  </a></li>
																		<li><a class="dropdown-item" href="#">Golf - Go Golfers  </a></li>
																		<li><a class="dropdown-item" href="#">Bungee Jumping - Extreme Bungee Jumping  </a></li>
																		<li><a class="dropdown-item" href="#">Dance - Summer Dance </a></li>
																	</ul>
																</div>
															</div>
															<div class="col-md-12">
																<div class="personal-trainer">
																	<p>Create your itinerary, service details, and prices for your experience. Let customers know what the plans are. Describe what you will do with your customers. What's unique and sets you apart from other similar experiences? How will you make customers feel included and engaged during your time together? Being specific about what guests will do on your activity is important. Set up a detailed itinerary so that guests know what to expect.</p>
																</div>
																<!-- Accordions -->
																<div class="accordion nesting-accordion custom-accordionwithicon accordion-border-box" id="accordionnestingthree">
																	<div class="accordion-item">
																		<h2 class="accordion-header tips-accordion" id="accordionnestingExample5">
																			<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse5" aria-expanded="true" aria-controls="accor_nestingExamplecollapse5">
																				Recommended Tips to Do :
																			</button>
																		</h2>
																		<div id="accor_nestingExamplecollapse5" class="accordion-collapse collapse show" aria-labelledby="accordionnestingExample5" data-bs-parent="#accordionnestingthree">
																			<div class="accordion-body tips">
																				<ul>
																					<li>Create an experience around your activity.</li>
																					<li>Make it unique and different.</li>
																					<li>Think about your meet-up points and how customers will get to you.</li>
																					<li>Think about what your experience includes and what your customers will need to bring.</li>
																					<li>Think about your plans and think about the experience your customer will have.</li>
																				</ul>
																			</div>
																		</div>
																	</div>
																	  
																	<div class="accordion-item">
																		<h2 class="accordion-header tips-accordion" id="accordionnestingExample6">
																			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse6" aria-expanded="false" aria-controls="accor_nestingExamplecollapse6">
																				Tips Not to Do :
																			</button>
																		</h2>
																		<div id="accor_nestingExamplecollapse6" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample6" data-bs-parent="#accordionnestingthree">
																			<div class="accordion-body tips">
																				<ul>
																					<li>Having no experience planned around your activity.</li>
																					<li>Not having a well-planned experience.</li>
																					<li>Giving incomple information is not recommended.</li>
																					<li>Creating generic experiences and activities customers can easily do on their own.</li>
																					<li>Offering an experience you are not qualified or skilled to host.</li>
																				</ul>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="tab-pane" id="settings1" role="tabpanel">
														<div class="row">
															<div class="col-lg-2 col-md-4 col-6">
																<input type="button" class="btn service-btn wp-100" value="Create Service">
															</div>
															<div class="col-lg-2 col-md-4 col-6">
																<div class="dropdown mb-15">
																	<button class="btn btn-secondary btn-selection dropdown-toggle wp-100" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
																		Manage Service
																	</button>
																	<ul class="dropdown-menu dropdown-menu-dark selection-item-wrap" aria-labelledby="dropdownMenuButton2" style="">
																		<li><a class="dropdown-item active" href="#">Horseback Riding - Bucephalus Riding and Polo Club1 </a></li>
																		<li><a class="dropdown-item" href="#">Rock Climbing - Rock Climbing At USA  </a></li>
																		<li><a class="dropdown-item" href="#">Rafting - River Rafting </a></li>
																	</ul>
																</div>
															</div>
															<div class="col-md-12">
																<div class="personal-trainer">
																	<p>Add the details for your upcoming event.</p>
																</div>
															<!-- Accordions -->
																<div class="accordion nesting-accordion custom-accordionwithicon accordion-border-box" id="accordionnestingfour">
																	<div class="accordion-item">
																		<h2 class="accordion-header tips-accordion" id="accordionnestingExample6">
																			<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse6" aria-expanded="true" aria-controls="accor_nestingExamplecollapse6">
																				Recommended Tips to Do :
																			</button>
																		</h2>
																		<div id="accor_nestingExamplecollapse6" class="accordion-collapse collapse show" aria-labelledby="accordionnestingExample6" data-bs-parent="#accordionnestingfour">
																			<div class="accordion-body tips">
																				<ul>
																					<li>Create an experience around your activity.</li>
																					<li>Make it unique and different.</li>
																					<li>Think about your meet-up points and how customers will get to you.</li>
																					<li>Think about what your experience includes and what your customers will need to bring.</li>
																					<li>Think about your plans and think about the experience your customer will have.</li>
																				</ul>
																			</div>
																		</div>
																	</div>
																	  
																	<div class="accordion-item">
																		<h2 class="accordion-header tips-accordion" id="accordionnestingExample7">
																			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse7" aria-expanded="false" aria-controls="accor_nestingExamplecollapse7">
																				Tips Not to Do :
																			</button>
																		</h2>
																		<div id="accor_nestingExamplecollapse7" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample7" data-bs-parent="#accordionnestingfour">
																			<div class="accordion-body tips">
																				<ul>
																					<li>Having no experience planned around your activity.</li>
																					<li>Not having a well-planned experience.</li>
																					<li>Giving incomple information is not recommended.</li>
																					<li>Creating generic experiences and activities customers can easily do on their own.</li>
																					<li>Offering an experience you are not qualified or skilled to host.</li>
																				</ul>
																			</div>
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
									<!--end col-->

								</div>
								<!--end row-->

                              

                            </div> <!-- end .h-100-->

                        </div> <!-- end col -->
                    </div>

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->


    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
	@include('layouts.business.footer')
@endsection