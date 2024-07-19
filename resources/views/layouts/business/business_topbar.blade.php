<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="utf-8" />
    <title>Fitnessity </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <!-- <link rel="shortcut icon" href="{{ url('/public/images/email/favicon.ico') }}"> -->
	

    <!-- Layout config Js-->
    <script src="{{asset('/public/dashboard-design/js/layout.js')}}"></script>
    <!-- Bootstrap Css 
    <link href="{{asset('public/dashboard-design/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/dashboard-design/css/simplebar.min.css')}}" rel="stylesheet" type="text/css" /> -->
	
    <!-- Style Css-->
    <!-- <link href="{{asset('/public/dashboard-design/css/style.css')}}" rel="stylesheet" type="text/css" /> -->
	
	<!-- Custom Css-->
    <!-- <link href="{{asset('/public/dashboard-design/css/custom.css')}}" rel="stylesheet" type="text/css" /> -->
    
		<!-- <script src="https://cdn.ckeditor.com/4.21.0/standard-all/ckeditor.js"></script>  -->

   <script src="{{asset('/public/dashboard-design/js/ckeditor/ckeditor.js')}}"></script>
	<link href="{{asset('/public/dashboard-design/css/responsive.css')}}" rel="stylesheet" type="text/css" />
	
	<!-- icon
	<link href="{{asset('/public/dashboard-design/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

	<link href="{{asset('/public/css/slimselect.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('/public/js/select/select.css')}}" rel="stylesheet" type="text/css" />
	<script src="{{asset('/public/dashboard-design/js/plugins.js')}}"></script> -->
	
	<!-- fullcalendar css >
	<link rel="stylesheet" type="text/css" href="{{ url('public/css/metismenu.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('public/css/fullcalendar/fullcalendar.min.css') }}"> -->
	

	<!-- dropzone css -->
	<link href="{{asset('/public/dashboard-design/css/dropzone.css')}}" rel="stylesheet" type="text/css" />
	
	<!-- glightbox css -->
	<link href="{{asset('/public/dashboard-design/css/glightbox.min.css')}}" rel="stylesheet" type="text/css" />

	<!-- Emoji icons -->
	<link href="{{asset('/public/dashboard-design/css/emojionearea.min.css')}}" rel="stylesheet" type="text/css" />
	
	<!-- app css 
	<link href="{{asset('/public/dashboard-design/css/app.min.css')}}" rel="stylesheet" type="text/css" />-->

	<!-- Color Piker Css-->
    <link href="{{asset('/public/dashboard-design/css/nano.min.css')}}" rel="stylesheet" type="text/css" />

	<!-- filepond -->
	<link rel="stylesheet" href="{{asset('/public/dashboard-design/filepond/filepond.min.css')}}" type="text/css" />
	<link rel="stylesheet" href="{{asset('/public/dashboard-design/filepond/filepond-plugin-image-preview.min.css')}}" type="text/css" />

	<link rel="stylesheet" href="{{asset('/public/dashboard-design/css/dragula.min.css')}}" type="text/css" />
</head>

 <!-- Begin page -->
   <div id="layout-wrapper printnone">
		<div id="page-topbar">
			<div class="layout-width">
				<div class="navbar-header">
					<div class="d-flex">
						<button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger shadow-none" id="topnav-hamburger-icon">
							<span class="hamburger-icon">
								<span></span>
								<span></span>
								<span></span>
							</span>
						</button>

						<!-- App Search-->
						<form class="app-search d-none d-md-block">
							<div class="position-relative">
								<input type="text" class="form-control" placeholder="Search for client" autocomplete="off" id="serchclient_navbar"  name="fname" value="{{Request::get('fname')}}">
							</div>
						</form>
						<div class="app-search">
							<a href="{{route('business_customer_create' ,['business_id'=> Auth::user()->cid])}}" class="add-client mobile-none zfold-none" >Add New Client</a>
							<!-- <a href="#" class="add-client mobile-none"  data-bs-toggle="modal" data-bs-target=".new-client-steps">Add New Client</a> -->
						</div>
					</div>

					<div class="d-flex align-items-center">

						<div class="provider-sidebar-scroll">
							<div class="ms-1 header-item d-none d-sm-flex">
								<button type="button" class="btn btn-red zfold-none ipad-none" onClick="openNaav()"> Complete Setup <i class="fas fa-angle-right ml-20 mil-5"></i>
								</button>
							</div>
							<div class="ms-1 header-item d-sm-flex">
								<button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none sidebar-progress-bar" onClick="openNaav()"> <i class="fas fa-tasks fs-22"></i>
								</button>
							</div>
						
							<nav class="com-sidebar">
								<div class="navbar-wrapper">
									<div id="completesetup" class="com-sidepanel">
										<div class="navbar-content">
											<div class="container"> 
												<div class="row">
													<div class="col-lg-8 col-8">
														<div class="setup-title">
															<label> Setup Guide</label>
														</div>
													</div>
													<div class="col-lg-4 col-4">
														<div class="p-relative">
															<a href="javascript:void(0)" class="com-cancle fa fa-times" onClick="closeNaav()"></a>
														</div>
													</div>
												</div>	
											</div>
											<div class="border-bottom-grey mt-10 mb-10"></div>	
												
											<div class="highlight-part">
												<div class="row">
													<div class="col-lg-8 col-8">
														<div class="welcome-sidebar">
															<label>Hi {{ucwords(Auth::user()->full_name)}}, continue setting up your company.</label>
															<span>{{completeSetUpCount()}} of 6 tasks completed</span>
														</div>
													</div>
													<div class="col-lg-4 col-4">
														<div id="wrapper" class="center">
															<svg class="circle-progress green noselect" data-progress="{{setUpPercentage()}}" x="0px" y="0px" viewBox="0 0 80 80">
																<path class="track" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
																<path class="fill" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
																<text class="value" x="50%" y="43%">0%</text>
																<text class="text1" x="50%" y="64%">Complete</text>
															</svg>
														</div>
													</div>
												</div>
											</div>	
											@php 
												$businessTopbar = Auth::user()->current_company;
											@endphp
											<div class="container">
												<div class="new sidebar-radio">
													<form>
														<div class="form-group options-box">
															<input type="checkbox" id="Setup" @if(Auth::user()->businesses()->count() > 0 ) checked disabled @endif>
															<label for="Setup" @if(Auth::user()->businesses()->count() == 0 ) onclick="companySetup() @endif"> Complete your company setup. </label>
														</div>
														<div class="form-group options-box">
															<input type="checkbox" id="Client" @if(Auth::user()->customers()->where('business_id', Auth::user()->cid)->count() > 0 ) checked disabled @endif >
															<label for="Client" @if(Auth::user()->customers()->where('business_id', Auth::user()->cid)->count() == 0 )  onclick="addClient()" @endif  > Add your clients </label>
														</div>
														<div class="form-group options-box">
															<input type="checkbox" id="servies" @if(Auth::user()->BusinessServices()->where('cid', Auth::user()->cid)->count() > 0 ) checked disabled @endif >
															<label for="servies" @if(Auth::user()->BusinessServices()->where('cid', Auth::user()->cid)->count() == 0 )  onclick="servies()" @endif> Set up your services </label>
														</div> 
														<div class="form-group options-box">
															<input type="checkbox" id="staff" @if($businessTopbar && @$businessTopbar->business_staff()->count() > 0 ) checked disabled @endif >
															<label for="staff" @if($businessTopbar && @$businessTopbar->business_staff()->count() == 0 )  onclick="staff()"  @endif > Add your staff </label> 
														</div>
														<div class="form-group options-box">
															<input type="checkbox" id="working"  @if(Auth::user()->Products()->where('business_id', Auth::user()->cid)->count() > 0 ) checked disabled @endif >
															<label for="working" @if(Auth::user()->Products()->where('business_id', Auth::user()->cid)->count() == 0 ) onclick="product()" @endif  > Add your products </label>
														</div>
														<div class="form-group options-box">
															<input type="checkbox" id="payment"  @if($businessTopbar && @$businessTopbar->UserBookingDetails()->count() > 0 ) checked disabled @endif >
															<label for="payment"  @if($businessTopbar && @$businessTopbar->UserBookingDetails()->count() == 0 )  onclick="payment()"  @endif  > Take your first payment</label>
														</div>
													</form>
												</div>
											</div>
											<div class="container mb-60 mb-200">
												<div class="row">
													<div class="col-lg-12">
														<label class="fs-15">Things to try</label>
													</div>
													<div class="col-lg-6">
														<div class="sidebar-service-box mb-15">
															<div class="mb-15">
																<i class="fas fa-share-alt fs-18"></i>
															</div>
															<div class="mb-15">
																<label>Share Experience </label>
																<p>Make a post on your social profile to engage clients, network and share. </p>
															</div>
															<div>
																<a href="{{ route('businessprofiletimeline',['user_name'=>str_replace(' ','-', Auth::user()->current_company->public_company_name) ,'id'=> Auth::user()->cid])}}" target="_blank" class="btn btn-red">Experience</a>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="sidebar-service-box mb-15">
															<div class="mb-15">
																<i class="fas fa-plus fs-18"></i>
															</div>
															<div class="mb-15">
																<label>Create A Task </label>
																<p>Create a task to stay get things done and stay organized.</p>
															</div>
															<div>
																<a type="button" class="btn btn-red">Task</a>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="sidebar-service-box mb-15">
															<div class="mb-15">
																<i class="fas fa-users fs-18"></i>
															</div>
															<div class="mb-15">
																<label>Engage Clients </label>
																<p>Send a direct message to your clients from the inbox</p>
															</div>
															<div>
																<a type="button" class="btn btn-red">Clients</a>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="sidebar-service-box mb-15">
															<div class="mb-15">
																<i class="fas fa-bullhorn fs-18"></i>
															</div>
															<div class="mb-15">
																<label>Create An Announcement</label>
																<p>Engage your clients further by sending an announcement</p>
															</div>
															<div>
																<a href="{{route('business.announcement.index' ,['business_id' => Auth::user()->cid])}}" target="_blank" class="btn btn-red">Announcement</a>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="sidebar-service-box mb-15">
															<div class="mb-15">
																<i class="fas fa-coins fs-18"></i>
															</div>
															<div class="mb-15">
																<label>Financial Dashboard</label>
																<p>Keep track of all upcoming payments from stripe</p>
															</div>
															<div>
																<a href="{{route('stripe-dashboard')}}" target="_blank" class="btn btn-red">Dashboard</a>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="sidebar-service-box mb-15">
															<div class="mb-15">
																<i class="fas fa-file fs-18"></i>
															</div>
															<div class="mb-15">
																<label>Reports</label>
																<p>Keep track of the health of your business by checking your reports</p>
															</div>
															<div>
																<a href="{{route('business.reports.index',['business_id' => Auth::user()->cid])}}" target="_blank"  type="button" class="btn btn-red">Reports</a>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="sidebar-service-box mb-15">
															<div class="mb-15">
																<i class="fas fa-home fs-18"></i>
															</div>
															<div class="mb-15">
																<label>Dashboard</label>
																<p>Get insights and quick data on how your business is doing.</p>
															</div>
															<div>
																<a href="{{route('business_dashboard')}}" class="btn btn-red">Dashboard</a>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="sidebar-service-box mb-15">
															<div class="mb-15">
																<i class="fas fa-percentage fs-18"></i>
															</div>
															<div class="mb-15">
																<label>Point of Sale</label>
																<p>Explore the point of sale to learn how to take payments.</p>
															</div>
															<div>
																<a  href="{{route('business.orders.create',['business_id' => Auth::user()->cid,'book_id' => 0])}}" target="_blank"  class="btn btn-red">Sale</a>
															</div>
														</div>
													</div>
													<div class="col-lg-6">
														<div class="sidebar-service-box mb-15">
															<div class="mb-15">
																<i class="fas fa-user  fs-18"></i>
															</div>
															<div class="mb-15">
																<label>Client Section</label>
																<p>Get info, insights, and manage your clients</p>
															</div>
															<div>
																<a  href="{{route('business_customer_index',['business_id' => Auth::user()->cid])}}" target="_blank"  class="btn btn-red">Client Section</a>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</nav>
						</div>
						
						<div class="provider-sidebar-scroll ms-1">
							<button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none" onClick="openNavxop()">
								<i class="fas fa-rocket fs-19"></i>
							</button>						
							<nav class="blog-sidebar">
								<div class="navbar-wrapper">
									<div id="newthings" class="blog-sidepanel">
										<div class="navbar-content">
											<div class="blog-header">
												<div class="container"> 
													<div class="row">
														<div class="col-lg-9 col-9">
															<div class="newsfeed-title">
																<label>What's new on Fitnessity</label>
															</div>
														</div>
														<div class="col-lg-3 col-3">
															<div class="p-relative">
																<a href="javascript:void(0)" class="blog-cancle fa fa-times" onClick="closeNavxop()"></a>
															</div>
														</div>
													</div>	
												</div>
											</div>
											<div class="container">
												<div class="row">
													<div class="col-xxl-12">
														<div class="">
															<div class="tab-content text-muted mb-165">
																<div class="tab-pane active" id="bottomtabs-newsfeed" role="tabpanel">
																	<div class="card mt-15">
																		<div class="card-body box-border">
																			<div class="mb-5">
																				<span class="badge rounded-pill text-bg-warning fs-11">Announcement</span>
																				<label>March 15, 2024</label>
																			</div>
																			<div class="mb-15 blog-title">
																				<a href="">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a>
																			</div>
																			<div class="mb-15">
																				<img src="http://dev.fitnessity.co/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="blog-card-img-top" alt="card img">
																			</div>
																			
																			<p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
																			<p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
																			<a href="#" class="btn btn-primary">Learn More</a>
																		</div>
																	</div>
																	<div class="card mt-15">
																		<div class="card-body box-border" >
																			<div class="mb-5">
																				<span class="badge rounded-pill text-bg-info fs-11">New</span>
																				<label>April 18, 2024</label>
																			</div>
																			<div class="mb-15 blog-title">
																				<a href="">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a>
																			</div>
																			<div class="mb-15">
																				<img src="http://dev.fitnessity.co/public/uploads/discover/thumb/1649648221-snow ski.jpg" class="blog-card-img-top" alt="card img">
																			</div>
																			<p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
																			<div class="blog-info">
																				<ul>
																					<li>
																						It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
																					</li>
																					<li>
																						The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
																					</li>
																					<li>
																						It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. 
																					</li>
																				</ul>
																			</div>
																			
																			<p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
																			<a href="#" class="btn btn-primary">Learn More</a>
																		</div>
																	</div>
																</div>
																<div class="tab-pane" id="bottomtabs-ideas" role="tabpanel">
																	<div class="card mt-25">
																		<div class="card-body box-border" id="divMsg" style="display:none">
																			<form action="">
																				<div class="row">
																					<div class="col-lg-12">
																						<div class="mb-3">
																							<label for="title" class="form-label">Title</label>
																							<input type="text" class="form-control" id="title">
																						</div>
																						<div class="mb-3">
																							<label for="email" class="form-label">Email</label>
																							<input type="text" class="form-control" id="email">
																						</div>
																						<div class="mb-3">
																							<label for="fname" class="form-label">First Name</label>
																							<input type="text" class="form-control" id="fname">
																						</div>
																						<div class="mb-3">
																							<label for="lname" class="form-label">Last Name</label>
																							<input type="text" class="form-control" id="lname">
																						</div>
																						<div class="mb-3">
																							<label for="lname" class="form-label">Upload Image</label>
																							<input class="form-control" type="file" id="formFile">
																						</div>
																						<div class="mb-3">
																							<label for="details" class="form-label">Details</label>
																							<textarea class="form-control" id="exampleFormControlTextarea" rows="3"></textarea>
																						</div>
																						<div class="mb-3 float-right">
																							<button class="btn btn-black ">Submit</button>
																						</div>
																					</div>
																				</div>
																			</form>
																		</div>
																	</div>

																	<div class="card mt-15">
																		<div class="card-body box-border">
																			<div class="border-bottom-grey mt-15">
																				<div class="row">
																					<div class="col-lg-2 col-2">
																						<span class="ri-check-double-fill fs-22"> </span>
																					</div>
																					<div class="col-lg-8 col-8">
																						<div class="mb-5 idea-title">
																							<a href="" class="mb-5">Lorem Ipsum is simply </a>
																						</div>
																						<div>
																							<span class="badge rounded-pill text-bg-warning fs-11">Improvement</span>
																						</div>
																						<div class="idea-review">
																							<i class="ri-checkbox-blank-circle-fill"></i> <label>Under Review</label>
																						</div>
																						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>													
																					</div>
																					<div class="col-lg-2 col-2">
																						<span> 4 </span>
																						<i class="ri-chat-4-line"></i>
																					</div>
																				</div>
																			</div>		
																			
																			<div class="border-bottom-grey mt-15">
																				<div class="row">
																					<div class="col-lg-2 col-2">
																						<span class="ri-check-double-fill fs-22"> </span>
																					</div>
																					<div class="col-lg-8 col-8">
																						<div class="mb-5 idea-title">
																							<a href="" class="mb-5">It is a long established fact that a reader will be distracted by the readable </a>
																						</div>
																						<div>
																							<span class="badge rounded-pill text-bg-success fs-11">Feature Request</span>
																						</div>
																						<div class="idea-review">
																							<i class="ri-checkbox-blank-circle-fill methoyopilo"></i> <label>Completed</label>
																						</div>
																						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>													
																					</div>
																					<div class="col-lg-2 col-2">
																						<span> 4 </span>
																						<i class="ri-chat-4-line"></i>
																					</div>
																				</div>
																			</div>

																			<div class="border-bottom-grey mt-15">
																				<div class="row">
																					<div class="col-lg-2 col-2">
																						<span class="ri-check-double-fill fs-22"> </span>
																					</div>
																					<div class="col-lg-8 col-8">
																						<div class="mb-5 idea-title">
																							<a href="" class="mb-5">Contrary to popular belief, Lorem Ipsum is not simply random text. </a>
																						</div>
																						<div>
																							<span class="badge rounded-pill text-bg-success fs-11">Feature Request</span>
																						</div>
																						<div class="idea-review">
																							<i class="ri-checkbox-blank-circle-fill"></i> <label>Under Review</label>
																						</div>
																						<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. </p>
																					</div>
																					<div class="col-lg-2 col-2">
																						<span> 4 </span>
																						<i class="ri-chat-4-line"></i>
																					</div>
																				</div>
																			</div>
																			
																			<div class="">
																				<div class="suggested-set">
																					<button class="btn- btn-red btn-suggest" onClick="showHideDiv('divMsg')">Suggest a new idea</button>
																				</div>
																			</div>
																			
																		</div>
																	</div>
																</div>
																<div class="tab-pane" id="bottomtabs-roadmap" role="tabpanel" > 
																	<div class="card mt-15 grey-border-top">
																		<div class="card-body box-border">
																			<div class="roadmap-title">
																				<i class="ri-checkbox-blank-circle-fill round-grey"></i> <label>Under Review</label>
																			</div>
																			<div class="border-bottom-grey mt-15">
																				<div class="row">
																					<div class="col-lg-2 col-2">
																						<span class="ri-check-double-fill fs-22"> </span>
																					</div>
																					<div class="col-lg-10 col-10">
																						<div class="mb-5 roadmap-subtitle">
																							<a href="" class="mb-5">Lorem Ipsum is simply </a>
																						</div>
																						<div class="mb-25 improvment">
																							<span >Improvement</span>
																						</div>												
																					</div>
																				</div>
																			</div>

																			<div class="border-bottom-grey mt-15">
																				<div class="row">
																					<div class="col-lg-2 col-2">
																						<span class="ri-check-double-fill fs-22"> </span>
																					</div>
																					<div class="col-lg-10 col-10">
																						<div class="mb-5 roadmap-subtitle">
																							<a href="" class="mb-5">When an unknown printer took a galley of type</a>
																						</div>
																						<div class="mb-25 improvment">
																							<span>Feature Request</span>
																						</div>												
																					</div>
																				</div>
																			</div>

																			<div class="border-bottom-grey mt-15">
																				<div class="row"> 
																					<div class="col-lg-2 col-2">
																						<span class="ri-check-double-fill fs-22"> </span>
																					</div>
																					<div class="col-lg-10 col-10">
																						<div class="mb-5 roadmap-subtitle">
																							<a href="" class="mb-5">Contrary to popular belief, Lorem Ipsum is not simply</a>
																						</div>
																						<div class="mb-25 improvment">
																							<span>Feature Request</span>
																						</div>												
																					</div>
																				</div>
																			</div>

																			<div class="border-bottom-grey mt-15">
																				<div class="row">
																					<div class="col-lg-2 col-2">
																						<span class="ri-check-double-fill fs-22"> </span>
																					</div>
																					<div class="col-lg-10 col-10">
																						<div class="mb-5 roadmap-subtitle">
																							<a href="" class="mb-5">There are many variations of passages of Lorem Ipsum available</a>
																						</div>
																						<div class="mb-25 improvment">
																							<span>Improvement</span>
																						</div>												
																					</div>
																				</div>
																			</div>

																		</div>
																	</div>

																	<div class="card mt-15 yellow-border-top">
																		<div class="card-body box-border">
																			<div class="roadmap-title">
																				<i class="ri-checkbox-blank-circle-fill methoyopilo"></i> <label>Completed</label>
																			</div>
																			<div class="border-bottom-grey mt-15">
																				<div class="row">
																					<div class="col-lg-2 col-2">
																						<span class="ri-check-double-fill fs-22"> </span>
																					</div>
																					<div class="col-lg-10 col-10">
																						<div class="mb-5 roadmap-subtitle">
																							<a href="" class="mb-5">Contrary to popular belief </a>
																						</div>
																						<div class="mb-25 improvment">
																							<span >Improvement</span>
																						</div>												
																					</div>
																				</div>
																			</div>

																			<div class="border-bottom-grey mt-15">
																				<div class="row">
																					<div class="col-lg-2 col-2">
																						<span class="ri-check-double-fill fs-22"> </span>
																					</div>
																					<div class="col-lg-10 col-10">
																						<div class="mb-5 roadmap-subtitle">
																							<a href="" class="mb-5">Lorem Ipsum is not simply random text</a>
																						</div>
																						<div class="mb-25 improvment">
																							<span>Feature Request</span>
																						</div>												
																					</div>
																				</div>
																			</div>

																			<div class="border-bottom-grey mt-15">
																				<div class="row">
																					<div class="col-lg-2 col-2">
																						<span class="ri-check-double-fill fs-22"> </span>
																					</div>
																					<div class="col-lg-10 col-10">
																						<div class="mb-5 roadmap-subtitle">
																							<a href="" class="mb-5">It has roots in a piece</a>
																						</div>
																						<div class="mb-25 improvment">
																							<span>Feature Request</span>
																						</div>												
																					</div>
																				</div>
																			</div>

																			<div class="border-bottom-grey mt-15">
																				<div class="row">
																					<div class="col-lg-2 col-2">
																						<span class="ri-check-double-fill fs-22"> </span>
																					</div>
																					<div class="col-lg-10 col-10">
																						<div class="mb-5 roadmap-subtitle">
																							<a href="" class="mb-5">Majority have suffered alteration in some form</a>
																						</div>
																						<div class="mb-25 improvment">
																							<span>Improvement</span>
																						</div>												
																					</div>
																				</div>
																			</div>

																		</div>
																	</div>

																	<div class="card mt-15 green-border-top">
																		<div class="card-body box-border">
																			<div class="roadmap-title">
																				<i class="ri-checkbox-blank-circle-fill green-round"></i> <label>In Progress</label>
																			</div>
																			<div class="border-bottom-grey mt-15">
																				<div class="row">
																					<div class="col-lg-2 col-2">
																						<span class="ri-check-double-fill fs-22"> </span>
																					</div>
																					<div class="col-lg-10 col-10">
																						<div class="mb-5 roadmap-subtitle">
																							<a href="" class="mb-5"> If you are going to use a passage </a>
																						</div>
																						<div class="mb-25 improvment">
																							<span >Improvement</span>
																						</div>												
																					</div>
																				</div>
																			</div>

																			<div class="border-bottom-grey mt-15">
																				<div class="row">
																					<div class="col-lg-2 col-2">
																						<span class="ri-check-double-fill fs-22"> </span>
																					</div>
																					<div class="col-lg-10 col-10">
																						<div class="mb-5 roadmap-subtitle">
																							<a href="" class="mb-5">There are many variations of passages of Lorem Ipsum</a>
																						</div>
																						<div class="mb-25 improvment">
																							<span>Feature Request</span>
																						</div>												
																					</div>
																				</div>
																			</div>

																			<div class="border-bottom-grey mt-15">
																				<div class="row">
																					<div class="col-lg-2 col-2">
																						<span class="ri-check-double-fill fs-22"> </span>
																					</div>
																					<div class="col-lg-10 col-10">
																						<div class="mb-5 roadmap-subtitle">
																							<a href="" class="mb-5">Finibus Bonorum et Malorum</a>
																						</div>
																						<div class="mb-25 improvment">
																							<span>Feature Request</span>
																						</div>												
																					</div>
																				</div>
																			</div>

																			<div class="border-bottom-grey mt-15">
																				<div class="row">
																					<div class="col-lg-2 col-2">
																						<span class="ri-check-double-fill fs-22"> </span>
																					</div>
																					<div class="col-lg-10 col-10">
																						<div class="mb-5 roadmap-subtitle">
																							<a href="" class="mb-5">The standard chunk of Lorem Ipsum</a>
																						</div>
																						<div class="mb-25 improvment">
																							<span>Improvement</span>
																						</div>												
																					</div>
																				</div>
																			</div>

																		</div>
																	</div>

																</div>
																<div class="tab-pane" id="bottomtabs-engage" role="tabpanel"> 
																	<div class="pt-40">
																		<div class="container">
																			<div class="row">
																				<div class="col-lg-12 col-12">
																					<div class="top-welcome">
																						<label>Welcome to Fitnessity</label>
																						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
																					</div>
																				</div>
																			</div>
																			<div class="border-bottom-grey"></div>
																			<div class="row">
																				<div class="col-lg-12 col-12">
																					<div class="top-welcome mt-15 mb-15">
																						<label>Follow@fitnessity on Instagram</label>
																						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
																						<button type="submit" class="btn-red-primary btn-red mt-15">Follow Fitnessity </button>
																					</div>
																				</div>
																			</div>
																			<div class="border-bottom-grey"></div>
																			<div class="row">
																				<div class="col-lg-12 col-12">
																					<div class="top-welcome mt-15 mb-15">
																						<label>Follow@fitnessity on Twitter</label>
																						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
																						<button type="submit" class="btn-red-primary btn-red mt-15">Follow Fitnessity </button>
																					</div>
																				</div>
																			</div>
																			<div class="border-bottom-grey"></div>
																			<div class="row">
																				<div class="col-lg-12 col-12">
																					<div class="top-welcome mt-15 mb-15">
																						<label>Follow@fitnessity on Facebook</label>
																						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
																						<button type="submit" class="btn-red-primary btn-red mt-15">Follow Fitnessity </button>
																					</div>
																				</div>
																			</div>
																			<div class="border-bottom-grey"></div>
																			<div class="row">
																				<div class="col-lg-12 col-12">
																					<div class="top-welcome mt-15 mb-15">
																						<label>Follow@fitnessity on Ticktok</label>
																						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
																						<button type="submit" class="btn-red-primary btn-red mt-15">Follow Fitnessity </button>
																					</div>
																				</div>
																			</div>
																			<div class="border-bottom-grey"></div>
																			<div class="row">
																				<div class="col-lg-12 col-12">
																					<div class="top-welcome mt-15 mb-15">
																						<label>Watch how to use the software on YouTube</label> 
																						<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
																						<button type="submit" class="btn-red-primary btn-red mt-15">Watch and subscribe </button>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>									
																</div>
																<div class="tab-pane" id="bottomtabs-feedback" role="tabpanel"> 
																	<div class="mt-20">
																		<label class="mb-0 fs-18">Give Us Feedback</label>
																	</div>
																	<div class="card mt-20 mb-25">
																		<div class="card-body box-border">
																			<form action="">
																				<div class="row">
																					<div class="col-lg-12">
																						<div class="mb-3">
																							<label for="name" class="form-label">Name</label>
																							<input type="text" class="form-control" id="name"">
																						</div>
																						<div class="mb-3">
																							<label for="email" class="form-label">Email</label>
																							<input type="text" class="form-control" id="email">
																						</div>
																						<div class="mb-3">
																							<label for="sub" class="form-label">Subject</label>
																							<input type="text" class="form-control" id="sub">
																						</div>
																						<div class="mb-3">
																							<label for="msg" class="form-label">Message</label>
																							<textarea class="form-control" rows="3"></textarea>
																						</div>
																						<div class="mb-3 float-right">
																							<button class="btn btn-black">Send Feedback</button>
																						</div>
																					</div>
																				</div>
																			</form>
																		</div>
																	</div>
																	<div class="border-bottom-grey"> </div>
																	<div class="mt-20">
																		<label class="mb-0 fs-18">Report A Bug</label>
																	</div>
																	<div class="card mt-20 mb-25">
																		<div class="card-body box-border">
																			<form action="">
																				<div class="row">
																					<div class="col-lg-12">
																						<div class="mb-3">
																							<label for="name" class="form-label">Name</label>
																							<input type="text" class="form-control" id="name"">
																						</div>
																						<div class="mb-3">
																							<label for="email" class="form-label">Email</label>
																							<input type="text" class="form-control" id="email">
																						</div>
																						<div class="mb-3">
																							<label for="bug" class="form-label">Where was this bug found?</label>
																							<input type="text" class="form-control" id="bug">
																						</div>
																						<div class="mb-3">
																							<label for="details" class="form-label">Details</label>
																							<textarea class="form-control" rows="3"></textarea>
																						</div>
																						<div class="mb-3 float-right">
																							<button class="btn btn-black">Submit</button>
																						</div>
																					</div>
																				</div>
																			</form>
																		</div>
																	</div>

																</div>

															</div>
															<div class="p-relative">
																<div class="side-footer-set bg-white">
																	<!-- Nav tabs --> 
																	<ul class="nav nav-pills nav-justified card-footer-tabs fs-17" role="tablist">
																		<li class="nav-item">
																			<a class="nav-link active" data-bs-toggle="tab" href="#bottomtabs-newsfeed" role="tab">
																				<i class="fas fa-newspaper mb-5"></i>
																				<label class="bottom-tab-titles mb-0">Newsfeed</label>
																			</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link" data-bs-toggle="tab" href="#bottomtabs-ideas" role="tab">
																				<i class="fas fa-lightbulb mb-5"></i>
																				<label class="bottom-tab-titles mb-0">Ideas</label>
																			</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link" data-bs-toggle="tab" href="#bottomtabs-roadmap" role="tab">
																				<i class="fas fa-map mb-5"></i>
																				<label class="bottom-tab-titles mb-0">Roadmap</label>
																			</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link" data-bs-toggle="tab" href="#bottomtabs-engage" role="tab">
																				<i class="fas fa-hand-point-up mb-5"></i>
																				<label class="bottom-tab-titles mb-0">Engage</label>
																			</a>
																		</li>
																		<li class="nav-item">
																			<a class="nav-link" data-bs-toggle="tab" href="#bottomtabs-feedback" role="tab">
																				<i class="fas fa-comment-alt mb-5"></i>
																				<label class="bottom-tab-titles mb-0">Feedback</label>
																			</a>
																		</li>
																	</ul>
																</div>
															</div>															
														</div><!-- end card -->
													</div>

													
												</div>
											</div>
											
											
										</div>
									</div>
								</div>
							</nav>
						</div>

						<div class="ms-1 header-item d-none i-none d-sm-flex">
							<button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none" data-toggle="fullscreen">
								<i class='bx bx-fullscreen fs-22'></i>
							</button>
						</div>

						<div class="ms-1 header-item d-none i-none d-sm-flex">
							<button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode shadow-none">
								<i class='bx bx-moon fs-22'></i>
							</button>
						</div>

						<div class="ms-1 header-item d-sm-flex">
							<button type="button" id="m_add_new_client" class="desktop-none-client btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none">
								<i class="ri-user-add-fill fs-22"></i>
							</button>
							<!-- <a href="{{route('business_customer_create' ,['business_id'=> Auth::user()->cid])}}" class="add-client mr-5 desktop-none-client">Add Client</a>  -->
						</div>

						<div class="dropdown d-md-none topbar-head-dropdown header-item">
							<button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="bx bx-search fs-22"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">

								<form class="p-3">
									<div class="form-group m-0">
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Search for client" autocomplete="off" id="serchclient_navbar1"  name="fname" value="{{Request::get('fname')}}">
											<button class="btn btn-black m-search" type="submit"><i class="mdi mdi-magnify"></i></button>
										</div>
									</div>
								</form>
							</div>
						</div>
						@php
						$notificationDashboardCount = count(getNotificationDashboard(''));
						$customerFilesNotifyCount = count(getCustomerFilesNotifiy());
						$totalNotifications = $notificationDashboardCount + $customerFilesNotifyCount;
						@endphp
						<div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
							<button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
								<i class='bx bx-bell fs-22'></i>
								<span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">{{$totalNotifications}}<span class="visually-hidden">unread messages</span></span>
							</button>

							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">

								<div class="dropdown-head bg-primary bg-pattern rounded-top">
									<div class="p-3">
										<div class="row align-items-center">
											<div class="col">
												<h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
											</div>
										</div>
									</div>
									
									<div class="px-2 pt-2">
										<ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true" id="notificationItemsTab" role="tablist">
											<li class="nav-item waves-effect waves-light">
												<a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab" aria-selected="true">
													All ({{$totalNotifications}})
												</a>
											</li>
											<li class="nav-item waves-effect waves-light">
												<a class="nav-link" data-bs-toggle="tab" href="#messages-tab" role="tab" aria-selected="false">Messages (0)</a>
											</li>
											<li class="nav-item waves-effect waves-light">
												<a class="nav-link" data-bs-toggle="tab" href="#alerts-tab" role="tab" aria-selected="false">
													Alerts ({{count(getNotificationDashboard('Alert'))}})
												</a>
											</li>
										</ul>
									</div>
								</div>

								<div class="tab-content position-relative" id="notificationItemsTabContent">
									<div class="tab-pane fade show active py-2 ps-2 alerts-scroll" id="all-noti-tab" role="tabpanel">
										<div class="pe-2">
											@php
												$notifications = getCustomerFilesNotifiy();
											@endphp
												@if($notifications->isNotEmpty())
														@foreach($notifications as $notification)
															<div class="text-reset notification-item d-block dropdown-item position-relative">
																<div class="d-flex">
																	<img src="{{ asset($notification->profile_pic) }}" class="me-3 rounded-circle avatar-xs" alt="user-pic">

																	{{-- start --}}

																	<div class="flex-1">
																		<div class="">
																			<div class="row y-middle">
																				<div class="col-md-7 col-12">	
																					<h6 class="mt-0 mb-1 fs-13 fw-semibold">{{$notification->user_name}}</h6>
																				</div>
																				<div class="col-md-2 col-2">
																					<a href="{{ route('business_customer_index', ['business_id' => $notification->business_id]) }}">View Customer</a>																				</div>
																				</div>
																				<div class="col-12">
																					<p class="notification-text-set"> Your file  {{ basename($notification->file) }}  is processed successfully. </p>
																				</div>
																		</div>
																	</div>

																	{{-- end --}}
																</div>
															</div>
														@endforeach
												@endif
											@forelse(getNotificationDashboard('') as $n)
												<div class="text-reset notification-item d-block dropdown-item position-relative">
													<div class="d-flex">
														@php
															if($n->table == 'CustomerNotes'){
																if (isset($n->CustomerNotes->customer->profile_pic_url)) {
																	$profilePic = $n->CustomerNotes->customer->profile_pic_url;
																}
																if (isset($n->CustomerNotes->customer->first_letter)) {
																	$firstLetter = $n->CustomerNotes->customer->first_letter;
																}
																if (isset($n->CustomerNotes->customer->full_name)) {
																	$fullName = $n->CustomerNotes->customer->full_name;
																}
																$text = $n->CustomerNotes->title;
															}else if($n->table == 'CustomersDocuments'){
																if (isset($n->CustomersDocuments->customer->profile_pic_url)) {
																	$profilePic = $n->CustomersDocuments->Customer->profile_pic_url;
																}
																$firstLetter = $n->CustomersDocuments->Customer->first_letter;
																$fullName = $n->CustomersDocuments->Customer->full_name;
																$text = $n->CustomersDocuments->title.' document is signed by '.$fullName;
															}else if($n->table == 'Customer'){
																if (isset($n->customer->profile_pic_url)) {
																	$profilePic = $n->Customer->profile_pic_url;
																}
																$firstLetter = $n->Customer->first_letter;
																$fullName = $n->Customer->full_name;
																$text = 'Terms is signed by '.$fullName;
															}else if($n->table == 'CustomerDocumentsRequested'){
																if (isset($n->CustomerDocumentsRequested->customer->profile_pic_url)) {
																	$profilePic = $n->CustomerDocumentsRequested->Customer->profile_pic_url;
																}
																$firstLetter = $n->CustomerDocumentsRequested->Customer->first_letter;
																$fullName = $n->CustomerDocumentsRequested->Customer->full_name;
																$text = $n->CustomerDocumentsRequested->content .' is uploded by '.$fullName;
															}else if($n->table == 'User'){
																$profilePic = $n->User->getPic();
																$firstLetter = $n->User->first_letter;
																$fullName = $n->User->full_name;
																$text = 'Granted Access by '.$fullName.' on '.date('m/d/Y',strtotime($n->display_date));
															}
														@endphp
														@if($profilePic)
															<img src="{{$profilePic}}" class="me-3 rounded-circle avatar-xs" alt="user-pic">
														@else
															<div class="avatar-xs me-3">
																<span class="avatar-title bg-soft-danger text-danger rounded-circle fs-14">{{$firstLetter}}</span>
															</div>
														@endif
														<div class="flex-1">
															<div class="">
																<div class="row">
																	<div class="col-md-7 col-12">
																		<a @if($n->table != 'User') href="{{route('business_customer_show' ,['business_id'=> Auth::user()->cid, 'id' =>$n->customer_id])}}" @endif >
																			<h6 class="mt-0 mb-1 fs-13 fw-semibold">{{$fullName}}</h6>
																		</a>
																	</div>
																	<div class="col-md-2 col-2">
																		 @if($n->table != 'User') <a href="{{route('business_customer_show' ,['business_id'=> Auth::user()->cid, 'id' =>$n->customer_id])}}" class="mb-0">View</a> @endif 
																	</div>
																	<div class="col-md-3 col-3">
																		<a onClick="deleteNoteFromNotification({{$n->id}})" class="mb-0">Delete</a>
																	</div>
																</div>
															</div>
															<div class="fs-13 text-muted mb-0 notetxt"> {!!$text!!} </div>
															<p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
																<span><i class="mdi mdi-clock-outline"></i> {{ timeAgo($n->created_at)}}</span>
															</p>
														</div>
													</div>
												</div> 
											@empty
											@endforelse
										</div>
									</div>

									<div class="tab-pane fade py-2 ps-2 alerts-scroll" id="messages-tab" role="tabpanel" aria-labelledby="messages-tab">
										<div class="pe-2">
										</div>
									</div>

									<div class="tab-pane fade py-2 ps-2 alerts-scroll" id="alerts-tab" role="tabpanel" aria-labelledby="alerts-tab">
										<div>
											
											@if(!empty(getNotificationDashboard('Alert')))
												<input type="hidden" id="alertIds" value="{{ implode(',', getNotificationDashboard('Alert')->pluck('id')->toArray())}}">
											@endif
											@forelse(getNotificationDashboard('Alert') as $n)
												<div class="text-reset notification-item d-block dropdown-item">
													<div class="d-flex">
														@php
															if($n->table == 'CustomerNotes'){
																$profilePic = $n->CustomerNotes->customer->profile_pic_url;
																$firstLetter = $n->CustomerNotes->customer->first_letter;
																$fullName = $n->CustomerNotes->customer->full_name;
																$text = $n->CustomerNotes->limit_note_character;
															}else if($n->table == 'CustomersDocuments'){
																$profilePic = $n->CustomersDocuments->Customer->profile_pic_url;
																$firstLetter = $n->CustomersDocuments->Customer->first_letter;
																$fullName = $n->CustomersDocuments->Customer->full_name;
																$text = $n->CustomersDocuments->title.' document is signed by '.$fullName;
															}else if($n->table == 'Customer'){
																$profilePic = $n->Customer->profile_pic_url;
																$firstLetter = $n->Customer->first_letter;
																$fullName = $n->Customer->full_name;
																$text = 'Terms is signed by '.$fullName;
															}else if($n->table == 'CustomerDocumentsRequested'){
																$profilePic = $n->CustomerDocumentsRequested->Customer->profile_pic_url;
																$firstLetter = $n->CustomerDocumentsRequested->Customer->first_letter;
																$fullName = $n->CustomerDocumentsRequested->Customer->full_name;
																$text = $n->CustomerDocumentsRequested->content .' is uploded by '.$fullName;
															}else if($n->table == 'User'){
																$profilePic = $n->User->getPic();
																$firstLetter = $n->User->first_letter;
																$fullName = $n->User->full_name;
																$text = 'Granted Access by '.$fullName.' on '.date('m/d/Y',strtotime($n->display_date));
															}
														@endphp
														@if($profilePic)
															<img src="{{$profilePic}}" class="me-3 rounded-circle avatar-xs" alt="user-pic">
														@else
															<div class="avatar-xs me-3">
																<span class="avatar-title bg-soft-danger text-danger rounded-circle fs-14">{{$firstLetter}}</span>
															</div>
														@endif
														<div class="flex-1">
															<div class="">
																<div class="row">
																	<div class="col-md-7 col-12">
																		<a @if($n->table != 'User') href="{{route('business_customer_show' ,['business_id'=> Auth::user()->cid, 'id' =>$n->customer_id])}}" @endif  >
																			<h6 class="mt-0 mb-1 fs-13 fw-semibold">{{$fullName}}</h6>
																		</a>
																	</div>
																	<div class="col-md-2 col-2">
																		<a @if($n->table != 'User') href="{{route('business_customer_show' ,['business_id'=> Auth::user()->cid, 'id' =>$n->customer_id])}}" @endif  class="mb-0">View</a>
																	</div>
																	<div class="col-md-3 col-3">
																		<a onClick="deleteNoteFromNotification({{$n->id}})" class="mb-0">Delete</a>
																	</div>
																</div>
															</div>
															<div class="fs-13 text-muted mb-0 notetxt">{!!$text!!}</div>
															<p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
																<span><i class="mdi mdi-clock-outline"></i> {{timeAgo($n->created_at)}}</span>
															</p>
														</div>
													</div>
												</div>
											@empty
											@endforelse

											@if(count(getNotificationDashboard('Alert')) > 0)
												<div class="text-center">
													<button type="button" class="btn btn-red text-center clearAlert" onClick="clearAlert()">Clear All Alerts</button>
												</div>
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="ms-1 header-item d-sm-flex">
							<button type="button" class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn shadow-none"><i class="ri-pulse-line"></i></button>
						
						</div>
					</div>
				</div>
			</div>
		</div>

		{!! sidebarUpdatesNotification() !!}

		<!-- removeNotificationModal -->
		<div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
		    <div class="modal-dialog modal-dialog-centered">
		        <div class="modal-content">
		            <div class="modal-header">
		               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="NotificationModalbtn-close"></button>
		            </div>
		            <div class="modal-body">
		                <div class="mt-2 text-center">
		                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
		                    <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
		                        <h4>Are you sure ?</h4>
		                        <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
		                    </div>
		                </div>
		                <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
		                    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
		                    <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>

	

		@include('layouts.business.businesssidebar')

		<!-- Vertical Overlay-->
      <div class="vertical-overlay"></div>

		<script type="text/javascript">

			function deleteNoteFromNotification(id){
				let text = "You are about to delete the Notes from Notification. Are you sure you want to continue?";
				if (confirm(text)) {
			      $.ajax({
			         type: 'POST',
			         url: '/notification/delete/',
			         data:{
			         	'_token':'{{csrf_token()}}',
			         	'id':id,
			         },
			         success: function (data) {
			            window.location.reload();
			         }
			      });
			   }
			}

			function clearAlert(){
				var id = $('#alertIds').val();  
     		deleteNoteFromNotification(id);
			}

			$(document).ready(function () {
		     	var business_id = '{{Auth::user()->cid}}';
		     	var url = "{{ url('/business/business_id/customers') }}";
		     	url = url.replace('business_id', business_id);

		     	$( "#serchclient_navbar" ).autocomplete({
		         source: url,
		         focus: function( event, ui ) {
		              return false;
		         },
		         select: function( event, ui ) {
		             window.location.href = "/business/"+business_id+"/customers/"+ui.item.id;
		              return false;
		         }
		     	}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
		         let profile_img = '<div class="collapse-img"><div class="company-list-text" style="height: 50px;width: 50px;"><p style="padding: 0;">' + item.fname.charAt(0).toUpperCase() + '</p></div></div> ';

		         if(item.profile_pic_url){
		             profile_img = '<img class="searchbox-img" src="' + (item.profile_pic_url ? item.profile_pic_url : '') + '" style="">';            
		         }

		         var inner_html = '<div class="row rowclass-controller"></div><div class="row"><div class="col-lg-3 col-md-3 col-3 nopadding text-center">' + profile_img + '</div><div class="col-lg-9 col-md-9 col-9 div-controller">' + 
		                   '<p class="pstyle"><label class="liaddress">' + item.fname + ' ' +  item.lname  + (item.age ? ' (' + item.age+ '  Years Old)' : '') + '</label></p>' +
		                   '<p class="pstyle liaddress">' + item.email +'</p>' + 
		                   '<p class="pstyle liaddress">' + item.phone_number + '</p></div></div>';
		        
		         return $( "<li></li>" )
		                 .data( "item.autocomplete", item )
		                 .append(inner_html)
		                 .appendTo( ul );
		     	};

		     	$( "#serchclient_navbar1" ).autocomplete({
		         source: url,
		         focus: function( event, ui ) {
		              return false;
		         },
		         select: function( event, ui ) {
		             window.location.href = "/business/"+business_id+"/customers/"+ui.item.id;
		              return false;
		         }
		     	}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
		         let profile_img = '<div class="collapse-img"><div class="company-list-text" style="height: 50px;width: 50px;"><p style="padding: 0;">' + item.fname.charAt(0).toUpperCase() + '</p></div></div> ';

		         if(item.profile_pic_url){
		             profile_img = '<img class="searchbox-img" src="' + (item.profile_pic_url ? item.profile_pic_url : '') + '" style="">';            
		         }

		         var inner_html = '<div class="row rowclass-controller"></div><div class="row"><div class="col-lg-3 col-md-3 col-3 nopadding text-center">' + profile_img + '</div><div class="col-lg-9 col-md-9 col-9 div-controller">' + 
		                   '<p class="pstyle"><label class="liaddress">' + item.fname + ' ' +  item.lname  + (item.age ? ' (' + item.age+ '  Years Old)' : '') + '</label></p>' +
		                   '<p class="pstyle liaddress">' + item.email +'</p>' + 
		                   '<p class="pstyle liaddress">' + item.phone_number + '</p></div></div>';
		        
		         return $( "<li></li>" )
		                 .data( "item.autocomplete", item )
		                 .append(inner_html)
		                 .appendTo( ul );
		     	};
		   });

		</script>

<script>
	document.getElementById("m_add_new_client").onclick = function () {
        location.href = "{{route('business_customer_create' ,['business_id'=> Auth::user()->cid])}}";
    };
</script>

<script>
function openNaav() {
	document.getElementById("completesetup").style.width = "500px";
}

function closeNaav() {
	document.getElementById("completesetup").style.width = "0";
}
</script>

<script>
function openNavxop() {
	document.getElementById("newthings").style.width = "500px";
}

function closeNavxop() {
	document.getElementById("newthings").style.width = "0";
}
</script>
<script>
 	function showHideDiv(ele) {
    	var srcElement = document.getElementById(ele);
     	if (srcElement != null) {
        	if (srcElement.style.display == "block") {
             	srcElement.style.display = 'none';
         	}
       		else {
                srcElement.style.display = 'block';
             	}
          	return false;
          	}
    }

</script>

<script>
	var forEach = function (array, callback, scope) {
	for (var i = 0; i < array.length; i++) {
		callback.call(scope, i, array[i]);
	}
};
window.onload = function(){
	var max = -219.99078369140625;
	forEach(document.querySelectorAll('.circle-progress'), function (index, value) {
	percent = value.getAttribute('data-progress');
		value.querySelector('.fill').setAttribute('style', 'stroke-dashoffset: ' + ((100 - percent) / 100) * max);
		value.querySelector('.value').innerHTML = percent + '%';
	});
}
</script>

<script>
	function companySetup() {
		var url = '{{route("personal.company.index")}}';
	  	window.location.href(url,'_blank')
	}

	function addClient() {
		var url = '{{route("business_customer_create",["business_id" => Auth::user()->cid])}}';
		window.open(url, "_blank");
	}

	function servies() {
		var url = '{{route("business.service.select",["business_id" => Auth::user()->cid])}}';
		window.open(url, "_blank");
	}

	function staff() {
		var url = '{{route("business.staff.index",["business_id" => Auth::user()->cid])}}';
		window.open(url, "_blank");
	}

	function product() {
		var url = '{{route("business.products.create",["business_id" => Auth::user()->cid])}}';
		window.open(url, "_blank");
	}

	function payment() {
		var url = '{{route("business.orders.create",["business_id" => Auth::user()->cid])}}';
		window.open(url, "_blank");
	}
</script>