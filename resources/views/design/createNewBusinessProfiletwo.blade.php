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
	<link href="{{asset('/public/css/slimselect.min.css')}}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="{{asset('/public/js/select/select.css')}}" />
	<!-- icon -->
	<link rel="stylesheet" type="text/css" href="{{asset('/public/dashboard-design/css/icons.min.css')}}" />


</head>
@section('content')


    <!-- Begin page -->
    <div id="layout-wrapper">

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
								<input type="text" class="form-control" placeholder="Search..." autocomplete="off" id="search-options" value="">
								<span class="mdi mdi-magnify search-widget-icon"></span>
								<span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none" id="search-close-options"></span>
							</div>
							<!--<div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
								<div data-simplebar style="max-height: 320px;">
									<div class="dropdown-header">
										<h6 class="text-overflow text-muted mb-0 text-uppercase">Recent Searches</h6>
									</div>

									<div class="dropdown-item bg-transparent text-wrap">
										<a href="#" class="btn btn-soft-secondary btn-sm btn-rounded">how to setup <i class="mdi mdi-magnify ms-1"></i></a>
										<a href="#" class="btn btn-soft-secondary btn-sm btn-rounded">buttons <i class="mdi mdi-magnify ms-1"></i></a>
									</div>
									<div class="dropdown-header mt-2">
										<h6 class="text-overflow text-muted mb-1 text-uppercase">Pages</h6>
									</div>

									<a href="javascript:void(0);" class="dropdown-item notify-item">
										<i class="ri-bubble-chart-line align-middle fs-18 text-muted me-2"></i>
										<span>Analytics Dashboard</span>
									</a>

									<a href="javascript:void(0);" class="dropdown-item notify-item">
										<i class="ri-lifebuoy-line align-middle fs-18 text-muted me-2"></i>
										<span>Help Center</span>
									</a>

									<a href="javascript:void(0);" class="dropdown-item notify-item">
										<i class="ri-user-settings-line align-middle fs-18 text-muted me-2"></i>
										<span>My account settings</span>
									</a>

									<div class="dropdown-header mt-2">
										<h6 class="text-overflow text-muted mb-2 text-uppercase">Members</h6>
									</div>

									<div class="notification-list">
										<a href="javascript:void(0);" class="dropdown-item notify-item py-2">
											<div class="d-flex">
												<img src="" class="me-3 rounded-circle avatar-xs" alt="user-pic">
												<div class="flex-1">
													<h6 class="m-0">Angela Bernier</h6>
													<span class="fs-11 mb-0 text-muted">Manager</span>
												</div>
											</div>
										</a>
										<a href="javascript:void(0);" class="dropdown-item notify-item py-2">
											<div class="d-flex">
												<img src="" class="me-3 rounded-circle avatar-xs" alt="user-pic">
												<div class="flex-1">
													<h6 class="m-0">David Grasso</h6>
													<span class="fs-11 mb-0 text-muted">Web Designer</span>
												</div>
											</div>
										</a>
										<a href="javascript:void(0);" class="dropdown-item notify-item py-2">
											<div class="d-flex">
												<img src="" class="me-3 rounded-circle avatar-xs" alt="user-pic">
												<div class="flex-1">
													<h6 class="m-0">Mike Bunch</h6>
													<span class="fs-11 mb-0 text-muted">React Developer</span>
												</div>
											</div>
										</a>
									</div>
								</div>

								<div class="text-center pt-3 pb-1">
									<a href="pages-search-results.html" class="btn btn-primary btn-sm">View All Results <i class="ri-arrow-right-line ms-1"></i></a>
								</div>
							</div> -->
						</form>
						<a href="#" class="add-client mobile-none">Add New Client</a>
					</div>

					<div class="d-flex align-items-center">

						<div class="dropdown d-md-none topbar-head-dropdown header-item">
							<button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="bx bx-search fs-22"></i>
							</button>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
								<form class="p-3">
									<div class="form-group m-0">
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
											<button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
										</div>
									</div>
								</form>
							</div>
						</div>

						<div class="ms-1 header-item d-none d-sm-flex">
							<button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none" data-toggle="fullscreen">
								<i class='bx bx-fullscreen fs-22'></i>
							</button>
						</div>

						<div class="ms-1 header-item d-none d-sm-flex">
							<button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode shadow-none">
								<i class='bx bx-moon fs-22'></i>
							</button>
						</div>

						<div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
							<button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
								<i class='bx bx-bell fs-22'></i>
								<span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">3<span class="visually-hidden">unread messages</span></span>
							</button>
							<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">

								<div class="dropdown-head bg-primary bg-pattern rounded-top">
									<div class="p-3">
										<div class="row align-items-center">
											<div class="col">
												<h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
											</div>
											<div class="col-auto dropdown-tabs">
												<span class="badge badge-soft-light fs-13"> 4 New</span>
											</div>
										</div>
									</div>

									<div class="px-2 pt-2">
										<ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true" id="notificationItemsTab" role="tablist">
											<li class="nav-item waves-effect waves-light">
												<a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab" aria-selected="true">
													All (4)
												</a>
											</li>
											<li class="nav-item waves-effect waves-light">
												<a class="nav-link" data-bs-toggle="tab" href="#messages-tab" role="tab" aria-selected="false">
													Messages
												</a>
											</li>
											<li class="nav-item waves-effect waves-light">
												<a class="nav-link" data-bs-toggle="tab" href="#alerts-tab" role="tab" aria-selected="false">
													Alerts
												</a>
											</li>
										</ul>
									</div>

								</div>

								<div class="tab-content position-relative" id="notificationItemsTabContent">
									<div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
										<div data-simplebar style="max-height: 300px;" class="pe-2">
											<div class="text-reset notification-item d-block dropdown-item position-relative">
												<div class="d-flex">
													<div class="avatar-xs me-3">
														<span class="avatar-title bg-soft-info text-info rounded-circle fs-16">
															<i class="bx bx-badge-check"></i>
														</span>
													</div>
													<div class="flex-1">
														<a href="#!" class="stretched-link">
															<h6 class="mt-0 mb-2 lh-base">Your <b>Elite</b> author Graphic
																Optimization <span class="text-secondary">reward</span> is
																ready!
															</h6>
														</a>
														<p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
															<span><i class="mdi mdi-clock-outline"></i> Just 30 sec ago</span>
														</p>
													</div>
													<div class="px-2 fs-15">
														<div class="form-check notification-check">
															<input class="form-check-input" type="checkbox" value="" id="all-notification-check01">
															<label class="form-check-label" for="all-notification-check01"></label>
														</div>
													</div>
												</div>
											</div>

											<div class="text-reset notification-item d-block dropdown-item position-relative">
												<div class="d-flex">
													<img src="" class="me-3 rounded-circle avatar-xs" alt="user-pic">
													<div class="flex-1">
														<a href="#!" class="stretched-link">
															<h6 class="mt-0 mb-1 fs-13 fw-semibold">Angela Bernier</h6>
														</a>
														<div class="fs-13 text-muted">
															<p class="mb-1">Answered to your comment on the cash flow forecast's
																graph 🔔.</p>
														</div>
														<p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
															<span><i class="mdi mdi-clock-outline"></i> 48 min ago</span>
														</p>
													</div>
													<div class="px-2 fs-15">
														<div class="form-check notification-check">
															<input class="form-check-input" type="checkbox" value="" id="all-notification-check02">
															<label class="form-check-label" for="all-notification-check02"></label>
														</div>
													</div>
												</div>
											</div>

											<div class="text-reset notification-item d-block dropdown-item position-relative">
												<div class="d-flex">
													<div class="avatar-xs me-3">
														<span class="avatar-title bg-soft-danger text-danger rounded-circle fs-16">
															<i class='bx bx-message-square-dots'></i>
														</span>
													</div>
													<div class="flex-1">
														<a href="#!" class="stretched-link">
															<h6 class="mt-0 mb-2 fs-13 lh-base">You have received <b class="text-success">20</b> new messages in the conversation
															</h6>
														</a>
														<p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
															<span><i class="mdi mdi-clock-outline"></i> 2 hrs ago</span>
														</p>
													</div>
													<div class="px-2 fs-15">
														<div class="form-check notification-check">
															<input class="form-check-input" type="checkbox" value="" id="all-notification-check03">
															<label class="form-check-label" for="all-notification-check03"></label>
														</div>
													</div>
												</div>
											</div>

											<div class="text-reset notification-item d-block dropdown-item position-relative">
												<div class="d-flex">
													<img src="" class="me-3 rounded-circle avatar-xs" alt="user-pic">
													<div class="flex-1">
														<a href="#!" class="stretched-link">
															<h6 class="mt-0 mb-1 fs-13 fw-semibold">Maureen Gibson</h6>
														</a>
														<div class="fs-13 text-muted">
															<p class="mb-1">We talked about a project on linkedin.</p>
														</div>
														<p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
															<span><i class="mdi mdi-clock-outline"></i> 4 hrs ago</span>
														</p>
													</div>
													<div class="px-2 fs-15">
														<div class="form-check notification-check">
															<input class="form-check-input" type="checkbox" value="" id="all-notification-check04">
															<label class="form-check-label" for="all-notification-check04"></label>
														</div>
													</div>
												</div>
											</div>

											<div class="my-3 text-center view-all">
												<button type="button" class="btn btn-soft-success waves-effect waves-light">View
													All Notifications <i class="ri-arrow-right-line align-middle"></i></button>
											</div>
										</div>

									</div>

									<div class="tab-pane fade py-2 ps-2" id="messages-tab" role="tabpanel" aria-labelledby="messages-tab">
										<div data-simplebar style="max-height: 300px;" class="pe-2">
											<div class="text-reset notification-item d-block dropdown-item">
												<div class="d-flex">
													<img src="" class="me-3 rounded-circle avatar-xs" alt="user-pic">
													<div class="flex-1">
														<a href="#!" class="stretched-link">
															<h6 class="mt-0 mb-1 fs-13 fw-semibold">James Lemire</h6>
														</a>
														<div class="fs-13 text-muted">
															<p class="mb-1">We talked about a project on linkedin.</p>
														</div>
														<p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
															<span><i class="mdi mdi-clock-outline"></i> 30 min ago</span>
														</p>
													</div>
													<div class="px-2 fs-15">
														<div class="form-check notification-check">
															<input class="form-check-input" type="checkbox" value="" id="messages-notification-check01">
															<label class="form-check-label" for="messages-notification-check01"></label>
														</div>
													</div>
												</div>
											</div>

											<div class="text-reset notification-item d-block dropdown-item">
												<div class="d-flex">
													<img src="" class="me-3 rounded-circle avatar-xs" alt="user-pic">
													<div class="flex-1">
														<a href="#!" class="stretched-link">
															<h6 class="mt-0 mb-1 fs-13 fw-semibold">Angela Bernier</h6>
														</a>
														<div class="fs-13 text-muted">
															<p class="mb-1">Answered to your comment on the cash flow forecast's
																graph 🔔.</p>
														</div>
														<p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
															<span><i class="mdi mdi-clock-outline"></i> 2 hrs ago</span>
														</p>
													</div>
													<div class="px-2 fs-15">
														<div class="form-check notification-check">
															<input class="form-check-input" type="checkbox" value="" id="messages-notification-check02">
															<label class="form-check-label" for="messages-notification-check02"></label>
														</div>
													</div>
												</div>
											</div>

											<div class="text-reset notification-item d-block dropdown-item">
												<div class="d-flex">
													<img src="" class="me-3 rounded-circle avatar-xs" alt="user-pic">
													<div class="flex-1">
														<a href="#!" class="stretched-link">
															<h6 class="mt-0 mb-1 fs-13 fw-semibold">Kenneth Brown</h6>
														</a>
														<div class="fs-13 text-muted">
															<p class="mb-1">Mentionned you in his comment on 📃 invoice #12501.
															</p>
														</div>
														<p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
															<span><i class="mdi mdi-clock-outline"></i> 10 hrs ago</span>
														</p>
													</div>
													<div class="px-2 fs-15">
														<div class="form-check notification-check">
															<input class="form-check-input" type="checkbox" value="" id="messages-notification-check03">
															<label class="form-check-label" for="messages-notification-check03"></label>
														</div>
													</div>
												</div>
											</div>

											<div class="text-reset notification-item d-block dropdown-item">
												<div class="d-flex">
													<img src="" class="me-3 rounded-circle avatar-xs" alt="user-pic">
													<div class="flex-1">
														<a href="#!" class="stretched-link">
															<h6 class="mt-0 mb-1 fs-13 fw-semibold">Maureen Gibson</h6>
														</a>
														<div class="fs-13 text-muted">
															<p class="mb-1">We talked about a project on linkedin.</p>
														</div>
														<p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
															<span><i class="mdi mdi-clock-outline"></i> 3 days ago</span>
														</p>
													</div>
													<div class="px-2 fs-15">
														<div class="form-check notification-check">
															<input class="form-check-input" type="checkbox" value="" id="messages-notification-check04">
															<label class="form-check-label" for="messages-notification-check04"></label>
														</div>
													</div>
												</div>
											</div>

											<div class="my-3 text-center view-all">
												<button type="button" class="btn btn-soft-success waves-effect waves-light">View
													All Messages <i class="ri-arrow-right-line align-middle"></i></button>
											</div>
										</div>
									</div>
									<div class="tab-pane fade p-4" id="alerts-tab" role="tabpanel" aria-labelledby="alerts-tab"></div>

									<div class="notification-actions" id="notification-actions">
										<div class="d-flex text-muted justify-content-center">
											Select <div id="select-content" class="text-body fw-semibold px-1">0</div> Result <button type="button" class="btn btn-link link-danger p-0 ms-3" data-bs-toggle="modal" data-bs-target="#removeNotificationModal">Remove</button>
										</div>
									</div>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
		
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
											<div class="card-header align-items-center d-flex">
												<h4 class="card-title mb-0 flex-grow-1 nesting-steps-title">Step 1: Programs Details</h4>
											</div><!-- end card header -->

											<div class="card-body">
												<div class="live-preview">
													<div class="accordion" id="stepone">
														<div class="accordion-item shadow">
															<h2 class="accordion-header" id="stepheadingOne">
																<button class="accordion-custom-btn accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
																	Explain to your customer what this program is.
																</button>
															</h2>
															<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="stepheadingOne" data-bs-parent="#stepone">
																<div class="accordion-body">
																	<div class="row">
																		<div class="col-md-6">
																			<div class="steps-title">
																				<div class="mb-3">
																					<select class="form-select" id="choices-publish-status-input" data-choices data-choices-search-false>
																						<option value="Sport/Activity" selected>Choose a Sport/Activity</option>
																						<option value="Baseball">Baseball</option>
																						<option value="Basketball">Basketball</option>
																					</select>
																				</div>
																			</div>
																			<div class="steps-title">
																				<div class="mb-3">
																					<label for="choices-publish-status-input" class="form-label">Program Title</label>
																					<input type="text" class="form-control" id="" placeholder="ex. Kickboxing for adults)" placeholder="ex. Kickboxing for adults)">
																				</div>
																			</div>
																			<div class="steps-title">
																				<div class="mb-3">
																					<label for="choices-publish-status-input" class="form-label">Program Description</label>
																					<textarea class="form-control" placeholder="Enter program description" rows="3"></textarea>
																				</div>
																			</div>
																			<div class="steps-title">
																				<div class="mb-3">
																					<label for="choices-publish-status-input" class="form-label">Give your customers THINGS TO KNOW and information on how and what to prepare before they book</label> 
																					<textarea class="form-control" placeholder="Tell your customers how they should conduct themselves when attending your place of business or participating in your activity. Set out a few guidelines to help things go smoothly." rows="3"></textarea>
																				</div>
																			</div>
																			<div class="steps-title">
																				<h3>Choose Instructor</h3>
																				<a href="" data-bs-toggle="modal" data-bs-target=".bs-example-modal-center" class="">Add Instructor</a>
																				<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
																					<div class="modal-dialog modal-dialog-centered">
																						<div class="modal-content">
																							<div class="modal-header">
																								<h5 class="modal-title" id="myModalLabel">Add Instructor</h5>
																								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																							</div>
																							<div class="modal-body">
																								<form>
																									<div class="mb-3">
																										<input type="text" class="form-control" id="fname" placeholder="Instructor First Name">
																									</div>
																									<div class="mb-3">
																										<input type="text" class="form-control" id="lname" placeholder="Instructor Last Name">
																									</div>
																									<div class="mb-3">
																										<input type="text" class="form-control" id="email" placeholder="Instructor Email">
																									</div>
																									<div class="mb-3">
																										<textarea class="form-control" placeholder="Public Bio" rows="3"></textarea>
																									</div>
																									<div class="mb-3">
																										<input type="file" name="insimg" id="insimg" class="form-control">
																									</div>
																								</form>
																							</div>
																							<div class="modal-footer">
																								<button type="button" class="btn btn-primary btn-red">Submit</button>
																							</div>
																						</div><!-- /.modal-content -->
																					</div><!-- /.modal-dialog -->
																				</div><!-- /.modal -->
																				<p>Which staff member(s) will lead this program?</p>
																				<div class="mb-3">
																					<select class="form-select" id="choices-publish-status-input" data-choices data-choices-search-false>
																						<option value="Nipas" selected>Nipas Soni(Provider)</option>
																						<option value="smith"> George smith </option>
																						<option value="ardella"> Franecki Ardella </option>
																					</select>
																				</div>
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="add-photos">
																				<h3>Add Photos For Your Program</h3>
																				<ul>
																					<li>Photos uploaded should show details and people in action</li>
																					<li>Photos should be high resolution and not pixelated.</li>
																					<li>Photos should be professional and reflect the best of what your program represents.</li>
																					<li>Photos should not have heavy filters, distortion, overlaid text, or watermarks </li>
																				</ul>
																				<div id="dropBox" class="dropBoximg">
																					<p>Drag &amp; Drop Images Here...</p>
																				   <!--  <form class="imgUploader"> -->
																						<input type="file" id="imgUpload" name="imgUpload[]" multiple="" accept="image/*" onchange="filesManager(this.files)">
																						<label class="buttonimg" for="imgUpload">...or Upload from your device</label>
																				   <!--  </form> -->
																					<div id="gallery">
																						<div class="imagediv  imgno_0">
																							<div class="more-option">
																								<div class="more">
																									<div class="more-post-optns">
																										<i class="fa fa-ellipsis-h"></i>
																										<ul>
																											<li><a imgname="1667542553-Aerial-View.jpg" data-bs-toggle="modal" data-bs-target=".edit-photo" href="#">
																											<i class="fa fa-pencil-square-o"></i>Edit Post</a>
																												
																											</li>
																											
																											<li><a href="javascript:void(0);" class="delpagepost" serviceid="124" imgname="1667542553-Aerial-View.jpg" valofi="0"><i class="fa fa-trash"></i>Delete Post</a></li>
																										</ul>
																						
																									</div>
																								</div>
																							</div>
																						</div>
																						
																					</div>
																					
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<!--<div class="col-md-6 col-6">
																			<button type="button" class="btn-red-primary btn-red mt-15" id="backindividual2"><i class="fa fa-arrow-left"></i> Back</button>
																		</div>-->
																		<div class="col-md-12 col-12">
																			<button type="button" class="btn-red-primary btn-red float-right mt-15" id="nextindividual2">Save</button>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														
													</div>
												</div>
											
											</div><!-- end card-body -->
										</div><!-- end card -->
										
									</div><!--end col-->

								</div><!--end row-->
								
								<div class="row">
									<div class="col-md-12">
										<div class="card">
											<div class="card-header align-items-center d-flex">
												<h4 class="card-title mb-0 flex-grow-1 nesting-steps-title">Step 2: Online Marketplace Settings</h4>
											</div><!-- end card header -->

											<div class="card-body">
												<div class="live-preview">
													<div class="accordion" id="steptwo">
														<div class="accordion-item shadow">
															<h2 class="accordion-header" id="stepheadingTwo">
																<button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
																	Provide more details to get booked
																</button>
															</h2>
															<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="stepheadingTwo" data-bs-parent="#steptwo">
																<div class="accordion-body">
																	<div class="steps-title">
																		<div class="mb-3">
																			<div class="form-check form-switch">
																				<input class="custom-switch form-check-input" type="checkbox" id="flexSwitchCheckDefault">
																				<label class="form-check-label" for="flexSwitchCheckDefault">INSTANT BOOKING:</label>
																				<p>Allow customers to book you instantly (Recommeded to get more bookings)</p>
																			</div>
																			<div class="form-check form-switch">
																				<input class="custom-switch form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
																				<label class="form-check-label" for="flexSwitchCheckChecked">REQUEST BOOKING:</label>
																				<p>Customers can request a booking, but you want to confirm first.(Less booking frequency with this option) </p>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-6 col-lg-5 col-xxl-4">
																			<div class="participant-req">
																				<p>What is the minimum participant requirement for each booking?</p>
																			</div>
																		</div>
																		<div class="col-md-3">
																			<div class="">
																				<input type="text" class="form-control">
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-6 col-lg-4 col-xxl-3">
																			<div class="participant-req">
																				<p>Whats the latest a customer can cancel?</p>
																			</div>
																		</div>
																		<div class="col-md-2 col-sm-6">
																			<input type="text" class="form-control mmb-15">
																		</div>
																		<div class="col-md-3 col-sm-6">
																			<select class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
																				<option value="min" selected="">Minute(s)</option>
																				<option value="hour">Hour(s)</option>
																			</select>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-3 col-md-6 col-sm-6">
																			<div class="priceselect sp-select">
																				<label>Select Service Type</label>
																				<div id="individualstype" style="">
																					<select name="frm_servicetype[]" id="categSTypeidividuals" multiple>
																						<option value="Personal Training">Personal Training</option>
																						<option value="Coaching">Coaching</option>
																						<option value="Therapy">Therapy</option>
																						<option value="Event">Event </option>
																						<option value="Seminar">Seminar </option>
																					</select>
																				</div>
																			</div>
																		</div>
																		<div class="col-lg-3 col-md-6 col-sm-6">
																			<div class="priceselect sp-select">
																				<label>Location of Activity ?</label>
																				<select name="frm_servicelocation[]" id="frm_servicelocation" multiple>
																					<option value="Online">Online</option>
																					<option value="At Business">At Business</option>
																					<option value="On Location">On Location</option>
																				</select>
																			</div>
																		</div>
																		<div class="col-lg-3 col-md-6 col-sm-6">
																			<div class="priceselect sp-select">
																				<label>Activity Great For ?</label>
																				<select name="frm_programfor[]" id="frm_programfor" multiple>
																					<option value="Kids">Kids</option>
																					<option value="Teens">Teens</option>
																					<option value="Adults">Adults</option>
																					<option value="Family">Family</option>
																					<option value="Groups">Groups</option>
																					<option value="Paralympic">Paralympic</option>
																					<option value="Prenatal">Prenatal</option>
																					<option value="Any">Any</option>
																				</select>
																				
																			</div>
																		</div>
																		<div class="col-lg-3 col-md-6 col-sm-6">
																			<div class="priceselect sp-select">
																				<label>What age is this for?</label>
																				<select name="frm_agerange[]" id="frm_agerange" multiple>
																					<option value="Baby (0 to 12 months)">Baby (0 to 12 months)</option>
																					<option value="Toddler (1 to 3 yrs.)">Toddler (1 to 3 yrs.)</option>
																					<option value="Preschool (4 to 5 yrs.)">Preschool (4 to 5 yrs.)</option>
																					<option value="Grade School (6 to 12 yrs.)">Grade School (6 to 12 yrs.)</option>
																					<option value="Teen (13 to 17 yrs.)">Teen (13 to 17 yrs.)</option>
																					<option value="Young Adult (18 to 21 yrs.)">Young Adult (18 to 21 yrs.)</option>
																					<option value="Older Adult (21 to 39 yrs.)">Older Adult (21 to 39 yrs.)</option>
																					<option value="Middle Age (40 to 59 yrs.)">Middle Age (40 to 59 yrs.)</option>
																					<option value="Senior Adult (60 +)">Senior Adult (60 +)</option>
																					<option value="Any">Any</option>
																				</select>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-3 col-md-6 col-sm-6">
																			<div class="priceselect sp-select">
																				<label>Difficulty Levels?</label>
																				<select name="frm_experience_level[]" id="frm_experience_level" multiple>
																					<option>Easy</option>
																					<option>Medium</option>
																					<option>Hard</option>
																					<option>Any</option>
																				</select>
																			</div>
																		</div>
																		<div class="col-lg-4 col-md-6 col-sm-6">
																			<div class="priceselect sp-select">
																				<label>Customers Experience for this Activity?</label>
																				<select name="frm_servicefocuses[]" id="frm_servicefocuses" multiple>
																					<option value="Have Fun"> Have Fun</option>
																					<option value="Adventurous">Adventurous</option>
																					<option value="Thrilling">Thrilling</option>
																					<option value="Physically Challenging">Physically Challenging </option>
																					<option value="Mentally Challenging">Mentally Challenging </option>
																					<option value="Peaceful">Peaceful</option>
																					<option value="Calm">Calm</option>
																					<option value="Gain Focus">Gain Focus</option>
																					<option value="Learning a skill">Learning a skill</option>
																					<option value="To accomplish a goal">To accomplish a goal</option>
																					<option value="Gain Discipline">Gain Discipline</option>
																					<option value="Gain Confidence">Gain Confidence</option>
																					<option value="Better hand-eye coordination">Better hand-eye coordination</option>
																					<option value="Get a toned body">Get a toned body</option>
																					<option value="Get better nutrition habits">Get better nutrition habits</option>
																					<option value="Release Pain">Release Pain</option>
																					<option value="Relax">Relax</option>
																					<option value="Body Alignment">Body Alignment</option>
																					<option value="Strength and Conditioning">Strength and Conditioning </option>
																					<option value="Athletic Conditioning">Athletic Conditioning</option>
																					<option value="Better Technique">Better Technique</option>
																					<option value="Weight Loss Help">Weight Loss Help</option>
																					<option value="Competition training and prep">Competition training and prep</option>
																					<option value="Gain better cardio">Gain better cardio</option>
																				</select>
																			</div>
																		</div>
																		<div class="col-lg-4 col-md-6 col-sm-6">
																			<div class="priceselect sp-select">
																				<label>Personality & Habits of Instructor?</label>
																				<select name="frm_teachingstyle[]" id="teaching" multiple>
																					<option value="An educator">An Educator</option>
																					<option value="A teacher">A Teacher</option>
																					<option value="A lot of energy">A lot of energy</option>
																					<option value="A drill sergeant">A drill sergeant</option>
																					<option value="Inspiring">Inspiring</option>
																					<option value="Motivational">Motivational</option>
																					<option value="Supportive, Soft and Nurturing">Supportive, Soft and Nurturing</option>
																					<option value="Tough and Firm">Tough and Firm</option>
																					<option value="Gentle">Gentle</option>
																					<option value="Intense">Intense</option>
																					<option value="Likes to talk">Likes to talk</option>
																					<option value="Punctual">An entertainer</option>
																					<option value="Organized">Stern</option>
																					<option value="Stern">Friendly & outgoing</option>
																					<option value="Tells jokes and funny">Tells jokes and funny</option>
																					<option value="Loves to talk">Loves to talk about the details</option>
																					<option value="Very Organized">Very Organized</option>
																					<option value="Punctual">Punctual</option>
																					<option value="On Time">On Time</option>
																				</select>

																				
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-12">
																			<div class="itinerary-data">
																				<h3>Set Up Your Itinerary</h3>
																				<p>( Let customers know what they will be doing for this experience)</p>
																				<div class="dropdown-divider"></div>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-6">
																			<div class="itinerary-data">
																				<h3>Experience Highlights</h3> 
																				<textarea class="form-control valid" rows="6" name="exp_highlight" id="exp_highlight" maxlength="1000" placeholder="Briefly describe a few highlights so customer understand what they will be doing. "></textarea>
																				<span class="word-counter" id="exp_highlight_left">1000</span>
																			</div>
																		</div>
																	</div>
																	<div class="dropdown-divider mt-20 mb-20"></div>
																	<div class="row">
																		<div class="col-lg-12 col-md-12">
																			<div class="booking-titles">
																				<h3>What’s Included with this experience?</h3>
																				<p>What do you provide for your customers?</p>
																				<p>Examples: You provide pick up and drop off transportation from hotels etc., provider, food and drinks, special equipment, video and photography services etc.)</p>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-6 col-md-12 col-sm-12">
																			<div class="activity-width">
																				<div class="special-offer select-dropoff">
																					<div class="multiples">
																						<select name="frm_included_things[]" id="frm_included_things" multiple="" class="mt-10" tabindex="-1" >
																							<option value="Safety &amp; Protective Gear">Safety &amp; Protective Gear</option>
																							<option value="Activity Equipment">Activity Equipment</option>
																							<option value="Breakfast">Breakfast</option>
																							<option value="Lunch">Lunch</option>
																							<option value="Dinner">Dinner</option>
																							<option value="Snacks">Snacks</option>
																							<option value="Drinks (tea, coffee, soda, bottled water, etc.) ">Drinks (tea, coffee, soda, bottled water, etc.)</option>
																							<option value="Alcohol (beer, champagne, wine, mixed drink etc.)">Alcohol (beer, champagne, wine, mixed drink etc.)</option>
																							<option value="Transportation">Transportation</option>
																							<option value="Insurance Coverage">Insurance Coverage</option>
																							<option value="Entrance Fees ">Entrance Fees </option>
																							<option value="Airfare">Airfare</option>
																							<option value="Taxes">Taxes</option>
																							<option value="Professional Guide">Professional Guide</option>
																							<option value="Guide Gratuity">Guide Gratuity</option>
																							<option value="Accommodations">Accommodations</option>
																							<option value="Video">Video</option>
																							<option value="Photography">Photography</option>
																							<option value="Fully Narrated">Fully Narrated</option>
																							<option value="Historic landmarks">Historic landmarks</option>
																							<option value="Rest period">Rest period</option>
																							<option value="Typical souvenir">Typical souvenir</option>
																						</select>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-12 col-md-12">
																			<div class="booking-titles">
																				<h3>What’s Not Included with this experience?</h3>
																				<p>List the items or services that are not includes with this experience. i.e. no food or drinks, no equipment, no insurance, etc. </p>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-6  col-md-12 col-sm-12">
																			<div class="activity-width">
																				<div class="special-offer select-dropoff">
																					<div class="multiples">
																						<select name="frm_notincluded_things[]" id="frm_notincluded_things" multiple="" tabindex="-1" " data-ssid="ss-30992">
																							<option value="Safety &amp; Protective Gear">Safety &amp; Protective Gear</option>
																							<option value="Activity Equipment">Activity Equipment</option>
																							<option value="Breakfast">Breakfast</option>
																							<option value="Lunch">Lunch</option>
																							<option value="Dinner">Dinner</option>
																							<option value="Snacks">Snacks</option>
																							<option value="Drinks (tea, coffee, soda, bottled water, etc.) ">Drinks (tea, coffee, soda, bottled water, etc.)</option>
																							<option value="Alcohol (beer, champagne, wine, mixed drink etc.)">Alcohol (beer, champagne, wine, mixed drink etc.)</option>
																							<option value="Transportation">Transportation</option>
																							<option value="Insurance Coverage">Insurance Coverage</option>
																							<option value="Entrance Fees ">Entrance Fees </option>
																							<option value="Airfare">Airfare</option>
																							<option value="Taxes">Taxes</option>
																							<option value="Professional Guide">Professional Guide</option>
																							<option value="Guide Gratuity">Guide Gratuity</option>
																							<option value="Accommodations">Accommodations</option>
																							<option value="Video">Video</option>
																							<option value="Photography">Photography</option>
																							<option value="Fully Narrated">Fully Narrated</option>
																							<option value="Historic landmarks">Historic landmarks</option>
																							<option value="Rest period">Rest period</option>
																							<option value="Typical souvenir">Typical souvenir</option>
																						</select>
																						 <span class="error" id="err_what_not_included"></span>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-12 col-md-12">
																			<div class="booking-titles">
																				<h3>What Should Guest Bring and Wear?</h3>
																				<p>If guests need anything in order to enjoy your experience, this is the place to tell them. Be as detailed as possible and add each item individually. </p>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-6 col-md-12 col-sm-12">
																			<div class="activity-width">
																				<div class="special-offer select-dropoff">
																					<div class="multiples">
																						<select name="frm_wear[]" id="frm_wear" multiple="" tabindex="-1" data-ssid="ss-87640">
																							<option value="Any Clothing Type">Any Clothing Type</option>
																							<option value="Dress for warm weather">Dress for warm weather</option>
																							<option value="Dress for wet weather">Dress for wet weather</option>
																							<option value="Dress for cold weather">Dress for cold weather</option>
																							<option value="Dress for nature activities">Dress for nature activities</option>
																							<option value="Dress for wet activities">Dress for wet activities</option>
																							<option value="Dress for cold activities">Dress for cold activities</option>
																							<option value="Pants">Pants</option>
																							<option value="Long Sleeve">Long Sleeve</option>
																							<option value="Jacket">Jacket</option>
																							<option value="Sandals">Sandals</option>
																							<option value="Shoes">Shoes</option>
																							<option value="Hats">Hats</option>
																							<option value="Sunglasses">Sunglasses</option>
																							<option value="Sunblock">Sunblock</option>
																							<option value="Bug Spray">Bug Spray</option>
																							<option value="Safety Goggles">Safety Goggles</option>
																							<option value="Dinner">Dinner</option>
																							<option value="Snacks">Snacks</option>
																							<option value="First Aid Kit">First Aid Kit</option>
																							<option value="Rain jacket">Rain jacket</option>
																							<option value="Daypack">Daypack</option>
																							<option value="Backpack">Backpack</option>
																							<option value="Headlamp">Headlamp</option>
																							<option value="Water bottle">Water bottle</option>
																							<option value="Compass">Compass</option>
																							<option value="Swimsuit">Swimsuit</option>
																							<option value="Drybag (waterproof)">Drybag (waterproof)</option>
																							<option value="Bandana or Buff headwear">Bandana or Buff headwear</option>
																							<option value="Sleeping bag">Sleeping bag</option>
																							<option value="Padlock">Padlock</option>
																							<option value="Duct Tape">Duct Tape</option>
																							<option value="Ear Plugs">Ear Plugs</option>
																							<option value="Tent">Tent</option>
																							<option value="Small Cooking Kit">Small Cooking Kit</option>
																							<option value="Rope">Rope</option>
																							<option value="Utility Knife">Utility Knife</option>
																						</select>
																						<span class="error" id="err_what_guest_bring"></span>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-12 col-md-12">
																			<div class="booking-titles">
																				<h3>Accessibility</h3>
																				<p>Explain if there is easy access for the disabled</p>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-6 col-md-12 col-sm-12">
																			<div class="accessibility select-dropoff">
																				<textarea class="form-control valid" rows="3" name="frm_accessibility" id="frm_accessibility" maxlength="500"></textarea>
																				<span class="word-counter" id="frm_accessibility_left">500</span>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-12 col-md-12">
																			<div class="booking-titles">
																				<h3>Additional Information & FAQ</h3>
																				<p>Have a few things you want your customers to know before arriving? </p>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-lg-6 col-md-12 col-sm-12">
																			<div class="accessibility select-dropoff">
																				<textarea class="form-control valid" rows="6" name="frm_addi_info" id="frm_addi_info" maxlength="1000"></textarea>
																				<span class="word-counter" id="frm_addi_info_left">1000</span>
																			</div>
																		</div>
																	</div>
																	<div class="dropdown-divider mt-20 mb-20"></div>
																	<div class="row">
																		<div class=" col-lg-12 col-md-12">
																			<div class="plandaybyday">
																				<h3>Let’s Plan Your Day By Day</h3>
																				<p>Give your customers a day by day plan. Include a title, image and description of what the customers will be doing for that day. You can create multiple days. </p>
																				<input type="hidden" name="planday_count" id="planday_count" value="0">
																				<div class="add-another-day-schedule-block">
																					<div class="add_another_day">
																						<label class="select-dropoff">Day - 1</label>
																						<div class="row">
																							<div class="col-md-12 col-sm-12">
																								<div class="row">
																									<div class="col-lg-2 col-md-4 col-sm-3">
																										<div class="photo-upload">
																											<label for="dayplanpic0" id="label">
																											<img src="http://dev.fitnessity.co/public/images/Upload-Icon.png" class="pro_card_img blah planblah0" id="showimg">
																											<span id="span_0">Upload your file here</span>
																												<input type="file" name="dayplanpic_0" id="dayplanpic0" class="uploadFile img" value="Upload Photo" onchange="planImg(this,0);" required="">
																											</label>
																											<span class="error" id="err_oldservicepic20"></span>
																											<input type="hidden" id="olddayplanpic20" name="olddayplanpic_0" value="">
																										</div>
																									</div>
																									<div class="col-lg-5 col-md-8 col-sm-9">
																										<div>
																											<input type="text" class="form-control" name="days_title[]" id="days_title" placeholder="Give a heading for this day." title="servicetitle">
																										</div>
																										<div class="description-txt">
																											<textarea class="form-control valid" rows="2" name="days_description[]" id="days_description0" placeholder="Give a description for this day" maxlength="500" oninput="changedesclenght(0);"></textarea>
																											<span id="days_description_left0" class="word-counter">500 Character Left</span>
																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="col-md-12">
																			<span class="addnewdiv add-another-day-schedule">+ Add another day</span>
																		</div>
																	</div>
																	<div class="dropdown-divider mt-20 mb-20"></div>
																	<div class="row">   
																		<div class="col-md-12 col-mg-6">
																			<div class="return-info">
																				<h3>Departure &amp; Return Info &amp; Describe the Location</h3>
																				<p>Tell customers how and when you will depart and return, how to meet up, where to meet up, meeting point name and how to find you once the customer arrives. Don’t leave it up to customers to figure out how to meet up with you. Let them know before hand.</p>
																				
																				<textarea class="form-control valid" rows="6" name="desc_location" id="desc_location" placeholder="(Ex. Please arrive at the location of our business. The address reminder  is ABC Anytown, town, 12345 USA.) Or; We will pick you up at your hotel. Or; Please talk with your front desk staff about the meeting point, Or; Please meet us at Central Park at the entrance of 81st and Central Park West (CPW). Wait at the seating area if you arrive early. The instructor will have on a red hat and yellow vest. Please arrive 10 minutes before your activity starts.)" maxlength="500"></textarea>
																				<span class="word-counter" id="desc_location_left">500</span>
																			</div>
																		</div>
																	</div>
																	<div class="row">   
																		<div class="col-md-12 col-lg-6">                  
																			<div class="companydetails">
																				<h3>Where should customers meet you?</h3>
																				<p>If the meet up spot is different from the address you set earlier in Company Details, then you can set it here.</p>
																			</div>
																			<div class="row">
																				<div class="col-lg-6 col-md-6">
																					<div class="companydetails-info">
																						<label>Street address </label>
																						<input type="text" name="cus_st_address" id="cus_st_address" class="form-control pac-target-input" value="" placeholder="Enter a location" autocomplete="off">
																					</div>
																				</div>
																				<div class="col-lg-6 col-md-6">
																					<div class="companydetails-info">
																						<label>Country / Region </label>
																						<input type="text" name="cus_country" id="cus_country" class="form-control" value="">
																					</div>
																				</div>
																			</div>
																			<div class="row">
																				<div class="col-lg-6 col-md-6">
																					<div class="companydetails-info">
																						<label>Bldg (optional)</label>
																						<input type="text" name="cus_addi_address" id="cus_addi_address" class="form-control" value=""> 
																					</div>
																				</div>
																				<div class="col-lg-6 col-md-6">
																					<div>
																						<label> City </label>
																						<input type="text" name="cus_city" id="cus_city" class="form-control" value="">
																					</div>
																				</div>
																				<div class="col-lg-6 col-md-6">
																					<div>
																						<label>State  </label>
																						<input type="text" name="cus_state" id="cus_state" class="form-control" value="">
																					</div>
																				</div>
																				<div class="col-lg-6 col-md-6">
																					<div>
																						<label> ZIP code</label>
																						<input type="text" name="cus_zip" id="cus_zip" class="form-control" value="">
																					</div>
																				</div>
																				<div class="col-md-12 col-lg-12">
																					<div class="select-dropoff">
																						<button class="showall-btn btn-red" type="button" onclick="loadMaponclick();">Update Map</button>
																					</div>
																				</div>
																			</div>
																			
																			<div class="row">
																				<div class="col-md-12 col-lg-12">
																					<div class="pin-on-map">
																						<h3>Adjust the pin on the map</h3>
																						<p>You can drag the map so the pin is in the right location.</p>
																					  <div class="mysrchmap_cus" style="height: 100%;min-height: 300px;">
																							<div id="map_canvas_cus">
																								<div class="maparea">
																									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24176.251535935986!2d-73.96828678121815!3d40.76133318281456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258c4d85a0d8d%3A0x11f877ff0b8ffe27!2sRoosevelt%20Island!5e0!3m2!1sen!2sin!4v1620041765199!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="dropdown-divider mt-20 mb-20"></div>
																	<div class="row">
																		<div class="col-md-12 col-lg-6">
																			<div class="customers-help">
																				<h3>Confirm your phone number if customers need your help</h3>
																				<p>If customers have trouble finding your location, or need questions with help, they may need to call you. The number on file we'll give them is +1 (123) 333-3333. </p>
																				<h3>Any additinal information for help</h3>
																				<textarea class="form-control valid" rows="3" maxlength="500" name="addi_info_help" id="addi_info_help"></textarea>
																				<span id="addi_info_help_left">500</span>
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<div class="col-md-12 col-lg-8">
																			<div class="customers-help">
																				<h3>Require Safety Verifications </h3>
																				<p>The primary booker has to successfully complete verified ID in order for them and their guests to attend your experience.</p>

																				<input type="checkbox" id="id_proof" name="id_proof" value="1">
																				<label for="id_proof">Require the booker to have ID upon arrival for verificaiton of age and identity</label><br>
																			   
																				<input type="checkbox" id="id_vaccine" name="id_vaccine" value="1">

																				<label for="id_vaccine">Require the booker to have proof of Vacination. </label><br>

																				<input type="checkbox" id="id_covid" name="id_covid" value="1">
																				<label for="id_covid">Require the booker to have proof of a negative Covid-19 test. </label><br> 
																			</div>
																		</div>
																	</div>
																	<div class="row">
																		<!--<div class="col-md-6 col-6">
																			<button type="button" class="btn-red-primary btn-red mt-15" id="backindividual2"><i class="fa fa-arrow-left"></i> Back</button>
																		</div>-->
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
									<!--end col-->

								</div>
								<!--end row-->

								<div class="row">
									<div class="col-md-12">
										<div class="card">
											
											<div class="card-header align-items-center d-flex">
												<h4 class="card-title mb-0 flex-grow-1 nesting-steps-title">Step 3: Set Your Prices</h4>
											</div><!-- end card header -->
											<div class="p-3 bg-light rounded">
												<div class="row g-2">
													<!--<div class="col-lg-auto">
														<select class="form-control" data-choices data-choices-search-false name="choices-select-sortlist" id="choices-select-sortlist">
															<option value="">Sort</option>
															<option value="By ID">By ID</option>
															<option value="By Name">By Name</option>
														</select>
													</div>-->
													<div class="col-lg-auto">
														<select class="form-control" data-choices data-choices-search-false name="choices-select-status" id="choices-select-status">
															<option value="">Search by Category Name</option>
															<option value="Completed">Categories 1</option>
															<option value="Inprogress">Categories 2</option>
															<option value="Pending">Categories 3</option>
														</select>
													</div>
													<div class="col-lg">
														<div class="search-box search-width">
															<input type="text" id="searchTaskList" class="form-control search" placeholder="Search by Price Option">
															<i class="ri-search-line search-icon"></i>
														</div>
													</div>
													<!--<div class="col-lg-auto">
														<button class="btn btn-primary createTask" type="button" data-bs-toggle="modal" data-bs-target="#createTask">
															<i class="ri-add-fill align-bottom"></i> Add Tasks
														</button>
													</div>-->
												</div>
											</div>
											<div class="card-body">
												<div class="live-preview">
													<div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting">
														<div class="accordion-item shadow">
															<h2 class="accordion-header" id="accordionnestingExample1">
																<button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse1" aria-expanded="false" aria-controls="accor_nestingExamplecollapse1">
																<div class="container-fluid nopadding">
																	<div class="row ">
																		<div class="col-lg-6 col-md-6 col-8">
																			Category
																		 </div>
																		<div class="col-lg-6 col-md-6 col-4">
																			<div class="multiple-options">
																				<div class="setting-icon">
																					<i class="ri-more-fill"></i>
																					<ul>
																						<li>
																							<a href="" data-bs-toggle="modal" data-bs-target=".tax"><i class="fas fa-plus text-muted"></i>Taxes</a>
																						</li>
																						<li><a href=""><i class="fas fa-plus text-muted"></i>Schedule</a></li>
																						<li><a href="#"><i class="fas fa-plus text-muted"></i>Duplicate Entire Category</a></li>
																						<li><a href="#" data-bs-toggle="modal" data-bs-target=".add-on-service"><i class="fas fa-plus text-muted"></i>Create Add On Service</a></li>
																						<li class="dropdown-divider"></li>
																						<li><a href=""><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
																					</ul>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																</button>
															</h2>
															<div id="accor_nestingExamplecollapse1" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample1" data-bs-parent="#accordionnesting">
																<div class="accordion-body">
																	<div class="row">
																		<div class="col-md-12">
																			<div class="flex-shrink-0 float-right">
																				<div class="form-check form-switch form-switch-right form-switch-md">
																					<label for="default-base-showcode" class="form-label text-muted">Show To Public</label>
																					<input class="custom-switch form-check-input" type="checkbox" id="">
																				</div>
																			</div>
																		</div>
																	</div>
																	<div class="accordion nesting2-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting2">
																		<div class="accordion-item shadow">
																			<h2 class="accordion-header" id="accordionnesting2Example1">
																				<button class="accordion-custom-btn accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse1" aria-expanded="true" aria-controls="accor_nesting2Examplecollapse1">
																					<div class="container-fluid nopadding">
																						<div class="row">
																							<div class="col-lg-6 col-md-6 col-8">
																								Price Option
																							</div>
																							<div class="col-lg-6 col-md-6 col-4">
																								<div class="priceoptionsettings">
																									<div class="setting-icon">
																										<i class="ri-more-fill"></i>
																										<ul>
																											<li><a href="#"><i class="fas fa-plus text-muted"></i>Duplicate This Price Option Only</a></li>
																											<li class="dropdown-divider"></li>
																											<li><a href=""><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
																										</ul>
																									</div>
																								</div>
																							</div>
																						</div>
																					</div>
																				</button>
																			</h2>
																			<div id="accor_nesting2Examplecollapse1" class="accordion-collapse collapse show" aria-labelledby="accordionnesting2Example1" data-bs-parent="#accordionnesting2">
																				<div class="accordion-body">
																					<div class="row">
																						<div class="col-lg-3 col-md-6 col-sm-6">
																							<div class="set-price mb-0">
																								<label>Price Title</label>
																								<input class="form-control" type="text" name="" id="" placeholder="Ex: 6 month Membership">
																							</div>
																						</div>
																						<div class="col-lg-3 col-md-6 col-sm-6">
																							<div class="set-price mb-0">
																								<label>Session Type</label>
																								<select class="form-select" id="" data-choices="" data-choices-search-false="">
																									<option value="Single" selected="">Single</option>
																									<option value="Multiple">Multiple</option>
																									<option value="Unlimited">Unlimited</option>
																								</select>
																							</div>
																						</div>
																						<div class="col-lg-3 col-md-6 col-sm-6">
																							<div class="set-price mb-0">
																								<label>Number of Sessions</label>
																								<input class="form-control" type="text" name="" id="" placeholder="1">
																							</div>
																						</div>
																						<div class="col-lg-3 col-md-6 col-sm-6">
																							<div class="set-price mb-0">
																								<label>Membership Type</label>
																								<select class="form-select" id="" data-choices="" data-choices-search-false="">
																									<option selected="selected" value="Drop In">Drop In</option>
																									<option value="Semester" selected="">Semester (Long Term)</option>
																								</select>
																							</div>
																						</div>
																						<div class="col-lg-12">
																							<p class="info-txt-price">You can set your prices to be the same or different based on age, the weekday or the weekend. To add prices for children or infants, click on the box.</p>
																						</div>
																						<div class="col-md-12">
																							<div class="mt-15 price-selection">
																								<input type="radio" id="freeprice00" name="sectiondisplay00" onclick="showdiv(0,0);" value="freeprice" checked="checked">
																								<label class="recurring-pmt">Free</label>
																												
																								<input type="radio" id="weekdayprice00" name="sectiondisplay00" onclick="showdiv(0,0);" value="weekdayprice">
																								<label class="recurring-pmt">Everyday Price</label>
																												
																								<input type="radio" id="weekendprice00" name="sectiondisplay00" onclick="showdiv(0,0);" value="weekendprice">
																								<label class="recurring-pmt">Weekend Price</label>
																							</div>
																						</div>
																						<div class="col-md-12">
																							<div class="choose-age price-selection">
																								<p>Select who this price option is for. (choose all that apply)</p>
																								<input type="checkbox" id="all00" name="sectiondisplay00" onclick="showdiv(0,0);" value="all" checked="checked">
																								<label class="recurring-pmt">All</label>
																								
																								<input type="checkbox" id="adults00" name="sectiondisplay00" onclick="showdiv(0,0);" value="adults" checked="checked">
																								<label class="recurring-pmt">Adults (12 and up)</label>
																												
																								<input type="checkbox" id="children00" name="sectiondisplay00" onclick="showdiv(0,0);" value="children">
																								<label class="recurring-pmt">Children (2 to 12)</label>
																												
																								<input type="checkbox" id="infants00" name="sectiondisplay00" onclick="showdiv(0,0);" value="infants">
																								<label class="recurring-pmt">Infants ( 2 and Under)</label>
																							</div>
																						</div>
																						
																					</div>
																					<div class="accordion nesting4-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting4">
																						<div class="accordion-item shadow">
																							<h2 class="accordion-header" id="accordionnesting4Example2">
																								<button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting4Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting4Examplecollapse2">
																									Prices Options for Adults
																								</button>
																							</h2>
																							<div id="accor_nesting4Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting4Example2" data-bs-parent="#accordionnesting4">
																								<div class="accordion-body">
																									<div class="container nopadding">
																										<div class="row">
																											<div class="age-cat">
																												<div class="cat-age sp-select">
																													<label>Adults</label>
																													<p>Ages 12 &amp; Older</p>
																												</div>
																											</div>
																											<div class="weekly-customer">
																												<div class="cus-week-price sp-select">
																													<label>Weekday Price</label>
																													<p> (Monday - Sunday)</p>
																													<input class="form-control" type="text" name="adult_cus_weekly_price_10" placeholder="$">
																												</div>
																											</div>
																											<div class="weekend-price Weekend10">
																												<div class="cus-week-price sp-select">
																													<label>Weekend Price </label>
																													<p> (Saturday &amp; Sunday)</p>

																													<input class="form-control" type="text" name="adult_weekend_price_diff_10" id="adult_weekend_price_diff10" placeholder="$" value="2" onkeyup="weekendadultchangeestprice(1,0);">
																												</div>
																											</div>
																											<div class="re-discount">
																												<div class="discount sp-select">
																													<label>Any Discount? </label>
																													<p> (Recommended 10% to 15%)</p>
																													<input class="form-control" type="text" name="adult_discount_10" id="adult_discount10" onkeyup="adultdischangeestprice(1,0);" value="1">
																												</div>
																											</div>
																											<div class="single-dash">
																												<div class="desh sp-select">
																													<label>-</label>
																												</div>
																											</div>
																											<div class="fit-fees">
																												<div class="fees sp-select">
																													<label>Introduction Fee </label>
																													<label>Recurring Fee </label>
																													<p> 15%</p>
																													<p> 1%</p>
																												</div>
																											</div>
																											<div class="single-equal">
																												<div class="equal sp-select">
																													<label>=</label>
																												</div>
																											</div>
																											<div class="estimated-earn">
																												<div class="cus-week-price earn sp-select">
																													<label>Weekday Estimated Earnings </label>
																													<input class="form-control" type="text" name="adult_estearn_10" id="adult_estearn10" placeholder="$" value="6.72">
																												</div>
																											</div>
																											<div class="estimated-earn Weekend10">
																												<div class="cus-week-price earn sp-select">
																													<label>Weekend Estimated Earnings </label>
																													<input class="form-control" type="text" name="weekend_adult_estearn_10" id="weekend_adult_estearn10" placeholder="$" value="1.68">
																												</div>
																											</div>
																											<!--<div class="col-lg-1 col-md-6">
																												<div class="set-price">
																													<label>Adults</label>
																													<p>Ages 12 &amp; Older</p>
																												</div>
																											</div>
																											<div class="col-lg-2 col-md-6">
																												<div class="set-price">
																													<label>Weekday Price</label>
																													<p>(Monday - Sunday)</p>
																													<input class="form-control" type="text" name="" id="" placeholder="$">
																												</div>
																											</div>
																											<div class="col-lg-3 col-md-5">
																												<div class="set-price">
																													<label>Any Discount? </label>
																													<p> (Recommended 10% to 15%)</p>
																													<input class="form-control" type="text" name="" id="">
																												</div>
																											</div>
																											<div class="col-lg-1 col-md-2">
																												<div class="text-center equal-earn">
																													<label>-</label>
																												</div>
																											</div>
																											<div class="col-lg-2 col-md-5">
																												<div class="set-price">
																													<label>Introduction Fee </label>
																													<label>Recurring Fee </label>
																													<p>15%</p>
																													<p>1%</p>
																												</div>
																											</div>
																											<div class="col-lg-1 col-md-6">
																												<div class="text-center equal-earn">
																													<label>=</label>
																												</div>
																											</div>
																											<div class="col-lg-2 col-md-6">
																												<div class="set-price">
																													<label>Weekday Estimated Earnings  </label>
																													<input class="form-control" type="text" name="" id="" placeholder="$">
																												</div>
																											</div>-->
																											<div class="col-md-12">
																												<div class="mb-15 mt-15 checkbox-selection">
																													<input type="checkbox" id="adults1" name="adults1" value="Adults">
																													<label for="adults1">Is This A Recurring Payment? Set the Weekly payment terms for Adults  ( 4 Week contract | $30 per 1 Week| Totalling $120 
																														<a href="" data-bs-toggle="modal" data-bs-target=".edit-adults" class="">Edit</a> ) 
																													</label>
																													<div class="delete-recurring"><i class="fas fa-trash-alt"></i></div>
																													<div class="modal fade edit-adults" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
																														<div class="modal-dialog modal-dialog-centered modal-70">
																															<div class="modal-content">
																																<div class="modal-header">
																																	<h5 class="modal-title" id="myModalLabel">Editing Recurring Payments Contract Settings for (30 Minute Private (01 Pack) for "Adults")</h5>
																																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																																</div>
																																<div class="modal-body">
																																	<div class="row">
																																		<div class="col-lg-8">
																																			<div class="setting-title">
																																				<h3>Settings </h3>
																																			</div>
																																			<div class="setting-box">
																																				<div class="row">
																																					<div class="col-lg-4 mb-10">
																																						<label class="contractsettings">How often will customers be charged?</label>
																																					</div>
																																					<div class="col-md-2 mb-10">
																																						<span class="every">Every</span>
																																					</div>
																																					<div class="col-md-3 mb-10">
																																						<input type="text" class="form-control valid" name="" id="" placeholder="12" value="1">
																																					</div>
																																					<div class="col-md-3 mb-10">
																																						<select class="form-select" id="" data-choices="" data-choices-search-false="">
																																							<option value="Week" selected="">week</option>
																																							<option value="Month">Month</option>
																																							<option value="Year">Year</option>
																																						</select>
																																					</div>
																																				</div>
																																				<div class="row">
																																					<div class="col-md-4">
																																						<label class="contractsettings mb-10">Number of autopays  </label>
																																					</div>
																																					<div class="col-md-8">
																																						<div class="autopays mb-10">
																																							<input type="text" class="form-control valid" name="" id="" placeholder="12" value="4">
																																						</div>
																																						<div class="contract mb-10">
																																							<label>  Total duration of contract: </label>
																																							<p id="total_duration_adult00"> 4  Week</p>
																																						</div>
																																					</div>
																																				</div>
																																				<div class="row">
																																					<div class="col-md-4">
																																						<label class="contractsettings mb-10" id="contractsettings_adult00">What happens after 4 payments?</label>
																																					</div>
																																					<div class="col-md-8">
																																						<div class="autopay mb-10">
																																							<input type="radio" id="happens_aftr_12_pmt_adult00" name="happens_aftr_12_pmt_adult_00" value="contract_expire" checked="">
																																							<label for="contract">Contract Expires</label><br>
																																							<input type="radio" id="happens_aftr_12_pmt_adult00" name="happens_aftr_12_pmt_adult_00" value="contract_renew">
																																							<label for="renews" id="renew_adult00">Contract Automaitcally Renews Every  4 payments</label><br> 
																																						</div>
																																					</div>
																																				</div>
																																				<div class="row">
																																					<div class="col-md-4">
																																						<label class="contractsettings mb-10">When will clients be charged?</label>
																																					</div>
																																					<div class="col-md-8">
																																						<div class="saledate mb-10">
																																							<select class="form-select" id="" data-choices="" data-choices-search-false="">
																																								<option value="sale date" selected="">On the sale date </option> 
																																								<option value="1stday"> 1st Day of the Month</option>
																																								<option value="15thday"> 15th Day of the Month</option> 
																																							</select> 
																																						</div>
																																					</div>
																																				</div>
																																				<div class="row">
																																					<div class="col-md-4">
																																						<label class="contractsettings mb-10">Recurring Price</label>
																																					</div>
																																					<div class="col-md-8">
																																						<input type="text" class="form-control valid mb-10" name="" id="" placeholder="12" value="30">
																																					</div>
																																				</div>
																																			</div>
																																		</div>
																																		<div class="col-lg-4">
																																			<div class="setting-title mmt-10">
																																				<h3>Contract Review </h3>
																																			</div>
																																			<div class="setting-box">
																																				<div class="set-border">
																																					<div class="row">
																																						<div class="col-md-8">
																																							<p class="font-black" id="p_price_title_adult00">30 Minute Private (01 Pack)</p>
																																						</div>
																																						<div class="col-md-4">
																																							<p class="font-black" id="p1_price_adult00"> $30</p>
																																						</div>
																																					</div>
																																				</div>
																																				<div class="row">
																																					<div class="col-md-12">
																																						<div class="Settings-title">
																																							<h5> Revenue Breakdown </h5>
																																						</div>
																																					</div>

																																					<div class="col-md-10">
																																						<p class="font-black mbb-5" id="trems_payment_adult00">Terms:  4  Week Payments</p>
																																					</div>

																																					<div class="col-md-8">
																																						<p class="font-black mbb-5">First Payment:</p>
																																					</div>

																																					<div class="col-md-4">
																																						<p class="font-black mbb-5" id="p_first_pmt_adult00">$30</p>
																																					</div>

																																					<div class="col-md-8">
																																						<p class="font-black mbb-5">Recurring Payment: </p>
																																					</div>

																																					<div class="col-md-4">
																																						<p class="font-black mbb-5" id="p_recurring_pmt_adult00">$30</p>
																																					</div>

																																					<div class="col-md-8">
																																						<label class="font-black mbb-5">Total Contract Revenue:  </label>
																																					</div>

																																					<div class="col-md-4">
																																						<p class="font-black mbb-5" id="p_total_contract_revenue_adult00">  $120 </p>
																																					</div>
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
																												</div>
																											</div>
																										</div>
																										<!--<div class="row">
																											<div class="col-md-1">
																												<div class="set-price">
																													<label>Children</label>
																													<p>Ages 2 to 12</p>
																												</div>
																											</div>
																											<div class="col-md-2">
																												<div class="set-price">
																													<label>Weekday Price</label>
																													<p>(Monday - Sunday)</p>
																													<input class="form-control" type="text" name="" id="" placeholder="$">
																												</div>
																											</div>
																											<div class="col-md-3">
																												<div class="set-price">
																													<label>Any Discount? </label>
																													<p> (Recommended 10% to 15%)</p>
																													<input class="form-control" type="text" name="" id="">
																												</div>
																											</div>
																											<div class="col-md-1">
																												<div class="text-center equal-earn">
																													<label>-</label>
																												</div>
																											</div>
																											<div class="col-md-2">
																												<div class="set-price">
																													<label>Introduction Fee </label>
																													<label>Recurring Fee </label>
																													<p>15%</p>
																													<p>1%</p>
																												</div>
																											</div>
																											<div class="col-md-1">
																												<div class="text-center equal-earn">
																													<label>=</label>
																												</div>
																											</div>
																											<div class="col-md-2">
																												<div class="set-price">
																													<label>Weekday Estimated Earnings  </label>
																													<input class="form-control" type="text" name="" id="" placeholder="$">
																												</div>
																											</div>
																											<div class="col-md-12">
																												<div class="mb-15">
																													<input type="checkbox" id="children1" name="children1" value="Children">
																													<label for="children1">Is This A Recurring Payment? Set the Weekly payment terms for Children ( 5 Week contract | $10 per 1 Week| Totalling $50 
																														<a href="" data-bs-toggle="modal" data-bs-target=".edit-children" class="">Edit</a> )
																													</label>
																													<div class="modal fade edit-children" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
																														<div class="modal-dialog modal-dialog-centered modal-70">
																															<div class="modal-content">
																																<div class="modal-header">
																																	<h5 class="modal-title" id="myModalLabel">Editing Recurring Payments Contract Settings for (30 Minute Private (01 Pack) for "Childern")</h5>
																																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																																</div>
																																<div class="modal-body">
																																	<div class="row">
																																		<div class="col-lg-8">
																																			<div class="setting-title">
																																				<h3>Settings </h3>
																																			</div>
																																			<div class="setting-box">
																																				<div class="row">
																																					<div class="col-lg-4">
																																						<label class="contractsettings">How often will customers be charged?</label>
																																					</div>
																																					<div class="col-md-2">
																																						<span class="every">Every</span>
																																					</div>
																																					<div class="col-md-3">
																																						<input type="text" class="form-control valid" name="" id="" placeholder="12" value="1">
																																					</div>
																																					<div class="col-md-3">
																																						<select class="form-select" id="" data-choices="" data-choices-search-false="">
																																							<option value="Week" selected="">week</option>
																																							<option value="Month">Month</option>
																																							<option value="Year">Year</option>
																																						</select>
																																					</div>
																																				</div>
																																				<div class="row">
																																					<div class="col-md-4">
																																						<label class="contractsettings">Number of autopays  </label>
																																					</div>
																																					<div class="col-md-8">
																																						<div class="autopays">
																																							<input type="text" class="form-control valid" name="" id="" placeholder="12" value="4">
																																						</div>
																																						<div class="contract">
																																							<label>  Total duration of contract: </label>
																																							<p id="total_duration_adult00"> 5  Week</p>
																																						</div>
																																					</div>
																																				</div>
																																				<div class="row">
																																					<div class="col-md-4">
																																						<label class="contractsettings" id="contractsettings_adult00">What happens after 5 payments?</label>
																																					</div>
																																					<div class="col-md-8">
																																						<div class="autopay">
																																							<input type="radio" id="happens_aftr_12_pmt_adult00" name="happens_aftr_12_pmt_adult_00" value="contract_expire" checked="">
																																							<label for="contract">Contract Expires</label><br>
																																							<input type="radio" id="happens_aftr_12_pmt_adult00" name="happens_aftr_12_pmt_adult_00" value="contract_renew">
																																							<label for="renews" id="renew_adult00">Contract Automaitcally Renews Every  5 payments</label><br> 
																																						</div>
																																					</div>
																																				</div>
																																				<div class="row">
																																					<div class="col-md-4">
																																						<label class="contractsettings">When will clients be charged?</label>
																																					</div>
																																					<div class="col-md-8">
																																						<div class="saledate">
																																							<select class="form-select" id="" data-choices="" data-choices-search-false="">
																																								<option value="sale date" selected="">On the sale date </option> 
																																								<option value="1stday"> 1st Day of the Month</option>
																																								<option value="15thday"> 15th Day of the Month</option> 
																																							</select> 
																																						</div>
																																					</div>
																																				</div>
																																				<div class="row">
																																					<div class="col-md-4">
																																						<label class="contractsettings">Recurring Price</label>
																																					</div>
																																					<div class="col-md-8">
																																						<input type="text" class="form-control valid" name="" id="" placeholder="12" value="30">
																																					</div>
																																				</div>
																																			</div>
																																		</div>
																																		<div class="col-lg-4">
																																			<div class="setting-title">
																																				<h3>Contract Review </h3>
																																			</div>
																																			<div class="setting-box">
																																				<div class="set-border">
																																					<div class="row">
																																						<div class="col-md-8">
																																							<p class="font-black" id="p_price_title_adult00">30 Minute Private (01 Pack)</p>
																																						</div>
																																						<div class="col-md-4">
																																							<p class="font-black" id="p1_price_adult00"> $30</p>
																																						</div>
																																					</div>
																																				</div>
																																				<div class="row">
																																					<div class="col-md-12">
																																						<div class="Settings-title">
																																							<h5> Revenue Breakdown </h5>
																																						</div>
																																					</div>

																																					<div class="col-md-10">
																																						<p class="font-black mbb-5" id="trems_payment_adult00">Terms:  5  Week Payments</p>
																																					</div>

																																					<div class="col-md-8">
																																						<p class="font-black mbb-5">First Payment:</p>
																																					</div>

																																					<div class="col-md-4">
																																						<p class="font-black mbb-5" id="p_first_pmt_adult00">$10</p>
																																					</div>

																																					<div class="col-md-8">
																																						<p class="font-black mbb-5">Recurring Payment: </p>
																																					</div>

																																					<div class="col-md-4">
																																						<p class="font-black mbb-5" id="p_recurring_pmt_adult00">$10</p>
																																					</div>

																																					<div class="col-md-8">
																																						<label class="font-black mbb-5">Total Contract Revenue:  </label>
																																					</div>

																																					<div class="col-md-4">
																																						<p class="font-black mbb-5" id="p_total_contract_revenue_adult00">  $50 </p>
																																					</div>
																																				</div>
																																			</div>
																																		</div>
																																	</div>
																																</div>
																																<div class="modal-footer">
																																	<button type="button" class="btn btn-primary btn-red">Submit</button>
																																</div>
																															</div>
																														</div>
																													</div>
																												</div>
																											</div>
																										</div>-->
																									<!--<div class="row">
																											<div class="col-md-1">
																												<div class="set-price">
																													<label>Infants</label>
																													<p>Ages 2 & Under</p>
																												</div>
																											</div>
																											<div class="col-md-2">
																												<div class="set-price">
																													<label>Weekday Price</label>
																													<p>(Monday - Sunday)</p>
																													<input class="form-control" type="text" name="" id="" placeholder="$">
																												</div>
																											</div>
																											<div class="col-md-3">
																												<div class="set-price">
																													<label>Any Discount? </label>
																													<p> (Recommended 10% to 15%)</p>
																													<input class="form-control" type="text" name="" id="">
																												</div>
																											</div>
																											<div class="col-md-1">
																												<div class="text-center equal-earn">
																													<label>-</label>
																												</div>
																											</div>
																											<div class="col-md-2">
																												<div class="set-price">
																													<label>Introduction Fee </label>
																													<label>Recurring Fee </label>
																													<p>15%</p>
																													<p>1%</p>
																												</div>
																											</div>
																											<div class="col-md-1">
																												<div class="text-center equal-earn">
																													<label>=</label>
																												</div>
																											</div>
																											<div class="col-md-2">
																												<div class="set-price">
																													<label>Weekday Estimated Earnings  </label>
																													<input class="form-control" type="text" name="" id="" placeholder="$">
																												</div>
																											</div>
																											<div class="col-md-12">
																												<div class="mb-15">
																													<input type="checkbox" id="children1" name="children1" value="Children">
																													<label for="children1">Is This A Recurring Payment? Set the ly payment terms for Infants </label>
																												</div>
																											</div>
																										</div>-->
																										<div class="row">
																											<div class="col-md-12">
																												<div class="serviceprice">
																													<h3>When Does This Price Setting Expire</h3>
																												</div>
																											</div>
																											<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
																												<div class="set-num">
																													<label>Set The Number</label>
																													<input type="text" name="pay_setnum_00" id="" class="form-control valid" placeholder="(ex,1,2,3,etc.)" value="1">
																												</div>
																											</div>
																											<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
																												<div class="set-num">
																													<label>The Duration</label>
																													<select name="" id="" class="form-select valid">
																														<option value="">Select Value</option>
																														<option selected="">Days</option>
																														<option>Months</option>
																														<option>Years</option>
																													</select>
																												</div>
																											</div>
																											<div class="col-lg-1 col-md-2 col-xs-12">
																												<div class="set-num after">
																													<label>After</label>
																												</div>
																											</div>
																											<div class="col-lg-5 col-md-10 col-xs-12">
																												<div class="after-select">
																													<select name="pay_after_00" id="pay_after00" class="pay_after form-control valid">
																														<option value="">Select Value</option>
																														<option value="1" selected="">Starts to expire the day of purchase</option>
																														<option value="2">Starts to expire when the customer first participates in the activity</option>
																													</select>
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
																				<button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting2Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting2Examplecollapse2">
																					<div class="container-fluid nopadding">
																						<div class="row">
																							<div class="col-lg-6 col-md-6 col-8">
																								Price Option
																							</div>
																							<div class="col-lg-6 col-md-6 col-4">
																								<div class="priceoptionsettings">
																									<div class="setting-icon">
																										<i class="ri-more-fill"></i>
																										<ul>
																											<li><a href="#"><i class="fas fa-plus text-muted"></i>Duplicate This Price Option Only</a></li>
																											<li class="dropdown-divider"></li>
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
																		<div class="col-md-12">
																			<div class="addanother">
																				<a class="" onclick=" return add_another_price_ages(0);"> +Add Another Price Option</a>
																			</div>  
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="accordion-item shadow">
															<h2 class="accordion-header" id="accordionnestingExample2">
																<button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse2" aria-expanded="false" aria-controls="accor_nestingExamplecollapse2">
																	<div class="container-fluid nopadding">
																	<div class="row ">
																		<div class="col-lg-6 col-md-6 col-8">
																			Category
																		 </div>
																		<div class="col-lg-6 col-md-6 col-4">
																			<div class="multiple-options">
																				<div class="setting-icon">
																					<i class="ri-more-fill"></i>
																					<ul>
																						<li>
																							<a href="" data-bs-toggle="modal" data-bs-target=".tax"><i class="fas fa-plus text-muted"></i>Taxes</a>
																						</li>
																						<li><a href=""><i class="fas fa-plus text-muted"></i>Schedule</a></li>
																						<li><a href="#"><i class="fas fa-plus text-muted"></i>Duplicate Entire Category</a></li>
																						<li class="dropdown-divider"></li>
																						<li><a href=""><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
																					</ul>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																</button>
															</h2>
															<div id="accor_nestingExamplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample2" data-bs-parent="#accordionnesting">
																<div class="accordion-body">
																	Coming Soon
																	<!--<div class="accordion nesting3-accordion custom-accordionwithicon accordion-border-box mt-3" id="accordionnesting3">
																		<div class="accordion-item shadow mt-2">
																			<h2 class="accordion-header" id="accordionnesting3Example2">
																				<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nesting3Examplecollapse2" aria-expanded="false" aria-controls="accor_nesting3Examplecollapse2">
																					Howe does temperature impact my watch?
																				</button>
																			</h2>
																			<div id="accor_nesting3Examplecollapse2" class="accordion-collapse collapse" aria-labelledby="accordionnesting3Example2" data-bs-parent="#accordionnesting3">
																				<div class="accordion-body">
																					Opting out a subscriber will allow SlickText to maintain the history of the subscriber as it pertains to the textword you are opting them out of. If this user was to text to join again, the initial text they are met with will be a "welcome back" message instead of the auto reply.
																				</div>
																			</div>
																		</div>
																	</div>-->
																</div>
															</div>
														</div>
														<div class="accordion-item shadow">
															<h2 class="accordion-header" id="accordionnestingExample3">
																<button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse3" aria-expanded="false" aria-controls="accor_nestingExamplecollapse3">
																	<div class="container-fluid nopadding">
																	<div class="row ">
																		<div class="col-lg-6 col-md-6 col-8">
																			Category
																		 </div>
																		<div class="col-lg-6 col-md-6 col-4">
																			<div class="multiple-options">
																				<div class="setting-icon">
																					<i class="ri-more-fill"></i>
																					<ul>
																						<li>
																							<a href="" data-bs-toggle="modal" data-bs-target=".tax"><i class="fas fa-plus text-muted"></i>Taxes</a>
																						</li>
																						<li><a href=""><i class="fas fa-plus text-muted"></i>Schedule</a></li>
																						<li><a href="#"><i class="fas fa-plus text-muted"></i>Duplicate Entire Category</a></li>
																						<li class="dropdown-divider"></li>
																						<li><a href=""><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li>
																					</ul>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
																</button>
															</h2>
															<div id="accor_nestingExamplecollapse3" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample3" data-bs-parent="#accordionnesting">
																<div class="accordion-body">
																	Coming Soon
																</div>
															</div>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<div class="add-category">
															<a class="add-category-btn">Add Another Category</a>
															<p>This is a new category section</p>
														</div>
													</div>
												</div>
												<div class="row">
													<!--<div class="col-md-6 col-6">
														<button type="button" class="btn-red-primary btn-red mt-15" id="backindividual2"><i class="fa fa-arrow-left"></i> Back</button>
													</div>-->
													<div class="col-md-12 col-12">
														<button type="button" class="btn-red-primary btn-red float-right mt-15" id="nextindividual2">Save </button>
													</div>
												</div>
											</div><!-- end card-body -->
										</div><!-- end card -->
									</div><!--end col-->
								</div><!--end row-->
								
								<div class="row">
									<div class="col-md-12">
										<div class="card">
											<div class="card-header align-items-center d-flex">
												<h4 class="card-title mb-0 flex-grow-1 nesting-steps-title">Step 4: Schedule Class</h4>
											</div><!-- end card header -->

											<div class="card-body">
												<div class="live-preview">
													<div class="accordion" id="stepFour">
														<div class="accordion-item shadow">
															<h2 class="accordion-header" id="stepheadingFour">
																<button class="accordion-custom-btn accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
																	Adult Program Options
																</button>
															</h2>
															<div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="stepheadingFour" data-bs-parent="#stepFour">
																<div class="accordion-body">
																	<div class="row">
																		<div class="col-lg-12 col-md-12">
																			<div class="row y-middle card-header">	
																				<div class="col-lg-6 col-md-6">
																					<label class="fs-17">Classes</label>
																				</div>
																				<div class="col-lg-6 col-md-6">
																					<button type="submit" class="btn-red-primary btn-red float-right" id="" data-bs-toggle="modal" data-bs-target=".scheduleclass-modal">Create Class </button>
																				</div>
																			</div>
																			
																			<div class="classes-list">
																				<div class="row">
																					<div class="col-lg-6 col-md-6 col-sm-6 col-12">
																						<div class="fs-14">
																							<span>MMA Class</span>
																						</div>
																					</div>
																					<div class="col-lg-6 col-md-6 col-sm-6 col-12">
																						<div class="fs-14 float-right links-set setoflinkes">
																							<a href="#">2 Scheduled </a>
																							<label class="mr-5 ml-5"> | </label>
																							<a href="#">+ Scheduled </a>
																							<label class="mr-5 ml-5"> | </label>
																							<div class="userblock0">
																								<div class="login_links" onclick="openNavv()">
																									<a href="#" >+ Price Options </a>
																								</div>
																								<nav class="serviceclass">
																									<div class="navbar-wrapper">
																										<div id="Sidepanelone" class="service-sidepanel">
																											<div class="navbar-content-side sc ">
																												<div class="side-cross">
																													<div class="row">
																														<div class="col-lg-10 col-md-10 col-10">
																															<label>Choose the price options your clients can choose to book with this classes</label>
																												
																														</div>
																														<div class="col-lg-2 col-md-2 col-2">
																															<a href="javascript:void(0)" class="cancel fa fa-times " onclick="closeNavv()"></a>
																														</div>
																													</div>
																												</div>
																												<ul class="schedule-class-navbar">																													
																													<li class="pc-caption mb-10">
																														<input type="checkbox" id="all" name="all" value="Bike">
																														<label for="all">  Select All</label>
																													</li>
																													<li class="pc-caption">
																														<input type="checkbox" id="price1" name="price1" value="Bike">
																														<label for="price1">  price option 1 </label>
																													</li>																											
																												</ul>
																												<div class="side-dropdown">
																													<div class="form">
																														<input class="mr-5" type="checkbox" id="cat" name="cat" value="Bike">
																														<label for="cat" class="drop-header">Kickboxing  </label>
																														<button class="button-1"> <i class="fas fa-chevron-down fa-sm"></i></button>
																													</div>
																													<ul class="dropdownList">
																														<li>
																															<input type="checkbox" id="price1" name="price1" value="Bike">
																															<label for="price1">6 Months Membership (Recurring) $99 </label>
																														</li>
																														<li>
																															<input type="checkbox" id="price2" name="price2" value="Bike">
																															<label for="price2"> 6 Months Membership (PIF) $1250</label>
																														</li>
																														<li>
																															<input type="checkbox" id="price2" name="price2" value="Bike">
																															<label for="price2">1 Year Membership (Recurring) $150</label>
																														</li>
																														<li>
																															<input type="checkbox" id="price2" name="price2" value="Bike">
																															<label for="price2">1 Year Membership (PIF) $1950 </label>
																														</li>
																													</ul>
																												</div>
																												<ul class="schedule-class-navbar">		
																													<li class="pc-caption">
																														<div class="d-relative">
																															<div class="sche-submit">
																																<button type="button" class="btn-red select-event"> Submit </button>
																															</div>
																														</div>																														
																													</li>																													
																												</ul>
																												
																											</div>
																										</div>
																									</div>
																								</nav>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																			<div class="classes-list">
																				<div class="row">
																					<div class="col-lg-6 col-md-6 col-sm-6 col-12">
																						<div class="fs-14">
																							<span>Kickboxing (All Levels)</span>
																						</div>
																					</div>
																					<div class="col-lg-6 col-md-6 col-sm-6 col-12">
																						<div class="fs-14 float-right links-set">
																							<a href="#">4 Scheduled </a>
																							<label> | </label>
																							<a href="#">+ Scheduled </a>
																						</div>
																					</div>
																				</div>
																			</div>
																			
																			<div class="classes-list">
																				<div class="row">
																					<div class="col-lg-6 col-md-6 col-sm-6 col-12">
																						<div class="fs-14">
																							<span>Kickboxing Level 2</span>
																						</div>
																					</div>
																					<div class="col-lg-6 col-md-6 col-sm-6 col-12">
																						<div class="fs-14 float-right links-set">
																							<a href="#">Not Scheduled </a>
																							<label> | </label>
																							<a href="#">+ Scheduled </a>
																						</div>
																					</div>
																				</div>
																			</div>
																			
																			<div class="classes-list">
																				<div class="row">
																					<div class="col-lg-6 col-md-6 col-sm-6 col-12">
																						<div class="fs-14">
																							<span>Kickboxing Mixed Level</span>
																						</div>
																					</div>
																					<div class="col-lg-6 col-md-6 col-sm-6 col-12">
																						<div class="fs-14 float-right links-set">
																							<a href="#">5 Scheduled </a>
																							<label> | </label>
																							<a href="#">+ Scheduled </a>
																						</div>
																					</div>
																				</div>
																			</div>
																			
																			<div class="classes-list">
																				<div class="row">
																					<div class="col-lg-6 col-md-6 col-sm-6 col-12">
																						<div class="fs-14">
																							<span>March Graduation</span>
																						</div>
																					</div>
																					<div class="col-lg-6 col-md-6 col-sm-6 col-12">
																						<div class="fs-14 float-right links-set">
																							<a href="#">Not Scheduled </a>
																							<label> | </label>
																							<a href="#">+ Scheduled </a>
																						</div>
																					</div>
																				</div>
																			</div>
																			
																			<div class="classes-list">
																				<div class="row">
																					<div class="col-lg-6 col-md-6 col-sm-6 col-12">
																						<div class="fs-14">
																							<span>Max-Out Cardio Kickboxing</span>
																						</div>
																					</div>
																					<div class="col-lg-6 col-md-6 col-sm-6 col-12">
																						<div class="fs-14 float-right links-set">
																							<a href="#">2 Scheduled </a>
																							<label> | </label>
																							<a href="#">+ Scheduled </a>
																						</div>
																					</div>
																				</div>
																			</div>
																			
																			<div class="classes-list">
																				<div class="row">
																					<div class="col-lg-6 col-md-6 col-sm-6 col-12">
																						<div class="fs-14">
																							<span>Self Defense Seminar</span>
																						</div>
																					</div>
																					<div class="col-lg-6 col-md-6 col-sm-6 col-12">
																						<div class="fs-14 float-right links-set">
																							<a href="#">Not Scheduled </a>
																							<label> | </label>
																							<a href="#">+ Scheduled </a>
																						</div>
																					</div>
																				</div>
																			</div>
																			
																			<div class="classes-list">
																				<div class="row">
																					<div class="col-lg-6 col-md-6 col-sm-6 col-12">
																						<div class="fs-14">
																							<span>Stretch & Myofascial</span>
																						</div>
																					</div>
																					<div class="col-lg-6 col-md-6 col-sm-6 col-12">
																						<div class="fs-14 float-right links-set">
																							<a href="#">Not Scheduled </a>
																							<label> | </label>
																							<a href="#">+ Scheduled </a>
																						</div>
																					</div>
																				</div>
																			</div>
																			
																			<div class="classes-list">
																				<div class="row">
																					<div class="col-lg-6 col-md-6 col-sm-6 col-12">
																						<div class="fs-14">
																							<span>VMA Belt Class</span>
																						</div>
																					</div>
																					<div class="col-lg-6 col-md-6 col-sm-6 col-12">
																						<div class="fs-14 float-right links-set">
																							<a href="#">Not Scheduled </a>
																							<label> | </label>
																							<a href="#">+ Scheduled </a>
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
	<div class="modal fade scheduleclass-modal" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="myModalLabel">arya pvt lmt </h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form>
						<div class="mb-3">
							<label>Class Name</label>
							<input type="text" class="form-control" id="">
						</div>
						<div class="mb-3">
							<label>Class Description</label>
							<div id="ckeditor-classic">
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-red">Create Class</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
	
	<div class="modal fade add-on-service" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-50">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="myModalLabel">Create Add On Service</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row justify-content-md-center">
						<div class="col-md-6">
							<div class="mb-3">
								<label class="form-label" for="product-title-input">Name</label>
								<input type="text" class="form-control" id="" name="formAction" placeholder="Enter name" >
							</div>
							<div class="mb-3">
								<label class="form-label" for="product-title-input">Price</label>
								<input type="text" class="form-control" id="" name="formAction" placeholder="Enter price" >
							</div>
						</div>
						<div class="col-md-6">
							<div class="mb-3">
								<label class="form-label" for="product-title-input">Description</label>
								<textarea class="form-control" id="" placeholder="Enter description" rows="3"></textarea>
							</div>
							
						</div>
					</div>					
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-red">Submit</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<div class="modal fade edit-photo" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-80">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="myModalLabel">Edit Photo</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="row justify-content-md-center">
						<div class="col-md-6">
							<form method="post" action="http://dev.fitnessity.co/activityimgupdate" enctype="multipart/form-data">
								<input type="hidden" name="_token" value="vzH5Ep7VwtkR3Z5fNnPmWPFxgEsge9fleZgalU0C">                                    
								<div class="friend-info">      
									<div class="post-meta" id="edit_image"><input type="hidden" name="serviceid" id="serviceid" value="124">
										<input type="hidden" name="imgnameajax" id="imgnameajax" value="1667542553-Aerial-View.jpg">
										<figure>
											<div class="img-bunch">
												<figure>
													<input id="image_post" type="file" name="image_post[]">
													<a href="#" title="" data-toggle="modal">
														<span class="error" id="err_image_sign">
															<img src="http://dev.fitnessity.co/public/uploads/profile_pic/1667542553-Aerial-View.jpg" alt="">
														</span>
													</a>
												</figure>
											</div>
										</figure>
									</div>
								</div>
							</form>
						</div>
					</div>					
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary btn-red">Update</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<div class="modal fade tax" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="myModalLabel">Taxes</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form>
						<div class="mb-3">
							<input type="text" class="form-control" id="" placeholder="Ex: Kids Martial Arts (5 to 7 yrs Old)">
						</div>
						<div class="mb-3">
							<input type="text" class="form-control" id="" placeholder="Sales Tax">
						</div>
						<div class="mb-3">
							<input type="text" class="form-control" id="" placeholder="Dues Tax">
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary btn-red">Submit</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
	@include('layouts.business.footer')

<script>
$(function () {
	$(".button-1").click(function (e) {
		e.preventDefault();
		$(".dropdownList").slideToggle(500);
		$(".fa-chevron-down").toggleClass("active");
	});
});
</script>

<script>
function openNavv() {
	document.getElementById("Sidepanelone").style.width = "350px";
}

function closeNavv() {
	document.getElementById("Sidepanelone").style.width = "0";
}
</script>

<script>
	let dropBox = document.getElementById('dropBox');

    // modify all of the event types needed for the script so that the browser
    // doesn't open the image in the browser tab (default behavior)
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(evt => {
        dropBox.addEventListener(evt, prevDefault, false);
    });
    function prevDefault (e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // remove and add the hover class, depending on whether something is being
    // actively dragged over the box area
    ['dragenter', 'dragover'].forEach(evt => {
        dropBox.addEventListener(evt, hover, false);
    });
    ['dragleave', 'drop'].forEach(evt => {
        dropBox.addEventListener(evt, unhover, false);
    });
    function hover(e) {
        dropBox.classList.add('hover');
    }
    function unhover(e) {
        dropBox.classList.remove('hover');
    }

    // the DataTransfer object holds the data being dragged. it's accessible
    // from the dataTransfer property of drag events. the files property has
    // a list of all the files being dragged. put it into the filesManager function
    dropBox.addEventListener('drop', mngDrop, false);
    function mngDrop(e) {
        let dataTrans = e.dataTransfer;
        let files = dataTrans.files;
        filesManager(files);
    }

    // use FormData browser API to create a set of key/value pairs representing
    // form fields and their values, to send using XMLHttpRequest.send() method.
    // Uses the same format a form would use with multipart/form-data encoding
    function upFile(file) {
        //only allow images to be dropped
        let imageType = /image.*/;
        if (file.type.match(imageType)) {
            let url = 'HTTP/HTTPS URL TO SEND THE DATA TO';
            // create a FormData object
            let formData = new FormData();
            // add a new value to an existing key inside a FormData object or add the
            // key if it doesn't exist. the filesManager function will loop through
            // each file and send it here to be added
            formData.append('file', file);

            // standard file upload fetch setup
            fetch(url, {
                method: 'put',
                body: formData
            })
            .then(response => response.json())
            .then(result => { console.log('Success:', result); })
            .catch(error => { console.error('Error:', error); });
        } else {
            console.error("Only images are allowed!", file);
        }
    }

    // use the FileReader API to get the image data, create an img element, and add
    // it to the gallery div. The API is asynchronous so onloadend is used to get the
    // result of the API function
    function previewFile(file) {
        // only allow images to be dropped
        let imageType = /image.*/;
        if (file.type.match(imageType)) {
            let fReader = new FileReader();
            let gallery = document.getElementById('gallery');
            // reads the contents of the specified Blob. the result attribute of this
            // with hold a data: URL representing the file's data
            fReader.readAsDataURL(file);
            // handler for the loadend event, triggered when the reading operation is
            // completed (whether success or failure)
            fReader.onloadend = function() {
                let wrap = document.createElement('div');
                let img = document.createElement('img');
                // set the img src attribute to the file's contents (from read operation)
                img.src = fReader.result;
                let imgCapt = document.createElement('p');
                // the name prop of the file contains the file name, and the size prop
                // the file size. convert bytes to KB for the file size
                let fSize = (file.size / 1000) + ' KB';
                
                gallery.appendChild(wrap).appendChild(img);
                gallery.appendChild(wrap).appendChild(imgCapt);
            }
        } else {
            console.error("Only images are allowed!", file);
        }
    }

    function filesManager(files) {
        // spread the files array from the DataTransfer.files property into a new
        // files array here
        files = [...files];
        // send each element in the array to both the upFile and previewFile
        // functions
        files.forEach(upFile);
        files.forEach(previewFile);
    }

</script>

	<script>
		var p = new SlimSelect({
		select: '#categSTypeidividuals'
	});
	</script>
	<script>
		var p = new SlimSelect({
		select: '#frm_servicelocation'
	});
	</script>
	<script>
		var p = new SlimSelect({
		select: '#frm_programfor'
	});
	</script>
	
	<script>
		var p = new SlimSelect({
		select: '#frm_agerange'
		});
	</script>
	<script>
		var p = new SlimSelect({
		select: '#frm_experience_level'
	});
	</script>
	<script>
		var p = new SlimSelect({
		select: '#frm_servicefocuses'
	});
	</script>
	<script>
		var p = new SlimSelect({
		select: '#teaching'
	});
	</script>
	<script>
		var p = new SlimSelect({
		select: '#frm_included_things'
	});
	</script>
	<script>
		var p = new SlimSelect({
		select: '#frm_notincluded_things'
	});
	</script>
	<script>
        var p = new SlimSelect({
        select: '#frm_wear'
     });
    </script>
@endsection