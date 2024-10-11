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
							<div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
								<div data-simplebar style="max-height: 320px;">
									<!-- item-->
									<div class="dropdown-header">
										<h6 class="text-overflow text-muted mb-0 text-uppercase">Recent Searches</h6>
									</div>

									<div class="dropdown-item bg-transparent text-wrap">
										<a href="#" class="btn btn-soft-secondary btn-sm btn-rounded">how to setup <i class="mdi mdi-magnify ms-1"></i></a>
										<a href="#" class="btn btn-soft-secondary btn-sm btn-rounded">buttons <i class="mdi mdi-magnify ms-1"></i></a>
									</div>
									<!-- item-->
									<div class="dropdown-header mt-2">
										<h6 class="text-overflow text-muted mb-1 text-uppercase">Pages</h6>
									</div>

									<!-- item-->
									<a href="javascript:void(0);" class="dropdown-item notify-item">
										<i class="ri-bubble-chart-line align-middle fs-18 text-muted me-2"></i>
										<span>Analytics Dashboard</span>
									</a>

									<!-- item-->
									<a href="javascript:void(0);" class="dropdown-item notify-item">
										<i class="ri-lifebuoy-line align-middle fs-18 text-muted me-2"></i>
										<span>Help Center</span>
									</a>

									<!-- item-->
									<a href="javascript:void(0);" class="dropdown-item notify-item">
										<i class="ri-user-settings-line align-middle fs-18 text-muted me-2"></i>
										<span>My account settings</span>
									</a>

									<!-- item-->
									<div class="dropdown-header mt-2">
										<h6 class="text-overflow text-muted mb-2 text-uppercase">Members</h6>
									</div>

									<div class="notification-list">
										<!-- item -->
										<a href="javascript:void(0);" class="dropdown-item notify-item py-2">
											<div class="d-flex">
												<img src="" class="me-3 rounded-circle avatar-xs" alt="user-pic">
												<div class="flex-1">
													<h6 class="m-0">Angela Bernier</h6>
													<span class="fs-11 mb-0 text-muted">Manager</span>
												</div>
											</div>
										</a>
										<!-- item -->
										<a href="javascript:void(0);" class="dropdown-item notify-item py-2">
											<div class="d-flex">
												<img src="" class="me-3 rounded-circle avatar-xs" alt="user-pic">
												<div class="flex-1">
													<h6 class="m-0">David Grasso</h6>
													<span class="fs-11 mb-0 text-muted">Web Designer</span>
												</div>
											</div>
										</a>
										<!-- item -->
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
							</div>
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

						<div class="dropdown ms-1 topbar-head-dropdown header-item">
							<!-- <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img src="{{asset('/public/dashboard-design/images/us.svg')}}" alt="user-image" class="rounded" height="20">
							</button> -->
							<div class="dropdown-menu dropdown-menu-end">

								<!-- item-->
								<!-- <a href="javascript:void(0);" class="dropdown-item notify-item language py-2" data-lang="en" title="English">
									<img src="{{asset('/public/dashboard-design/images/us.svg')}}" alt="user-image" class="me-2 rounded" height="18">
									<span class="align-middle">English</span>
								</a> -->

								<!-- item-->
								<!-- <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="sp" title="Spanish">
									<img src="{{asset('/public/dashboard-design/images/spain.svg')}}" alt="user-image" class="me-2 rounded" height="18">
									<span class="align-middle">Española</span>
								</a> -->

								<!-- item-->
								<!-- <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="gr" title="German">
									<img src="{{asset('/public/dashboard-design/images/germany.svg')}}" alt="user-image" class="me-2 rounded" height="18"> <span class="align-middle">Deutsche</span>
								</a> -->

								<!-- item-->
								<!-- <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="it" title="Italian">
									<img src="{{asset('/public/dashboard-design/images/italy.svg')}}" alt="user-image" class="me-2 rounded" height="18">
									<span class="align-middle">Italiana</span>
								</a> -->

								<!-- item-->
								<!-- <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ru" title="Russian">
									<img src="{{asset('/public/dashboard-design/images/russia.svg')}}" alt="user-image" class="me-2 rounded" height="18">
									<span class="align-middle">русский</span>
								</a> -->

								<!-- item-->
								<!-- <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ch" title="Chinese">
									<img src="{{asset('/public/dashboard-design/images/china.svg')}}" alt="user-image" class="me-2 rounded" height="18">
									<span class="align-middle">中国人</span>
								</a> -->

								<!-- item-->
								<!-- <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="fr" title="French">
									<img src="{{asset('/public/dashboard-design/images/french.svg')}}" alt="user-image" class="me-2 rounded" height="18">
									<span class="align-middle">français</span>
								</a> -->

								<!-- item-->
								<!-- <a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ar" title="Arabic">
									<img src="{{asset('/public/dashboard-design/images/ae.svg')}}" alt="user-image" class="me-2 rounded" height="18">
									<span class="align-middle">Arabic</span>
								</a> -->
							</div>
						</div>

						<!-- <div class="dropdown topbar-head-dropdown ms-1 header-item">
							<button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class='bx bx-category-alt fs-22'></i>
							</button>
							<div class="dropdown-menu dropdown-menu-lg p-0 dropdown-menu-end">
								<div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-0 fw-semibold fs-15"> Web Apps </h6>
										</div>
										<div class="col-auto">
											<a href="#!" class="btn btn-sm btn-soft-info shadow-none"> View All Apps
												<i class="ri-arrow-right-s-line align-middle"></i></a>
										</div>
									</div>
								</div>

								<div class="p-2">
									<div class="row g-0">
										<div class="col">
											<a class="dropdown-icon-item" href="#!">
												<img src="" alt="Github">
												<span>GitHub</span>
											</a>
										</div>
										<div class="col">
											<a class="dropdown-icon-item" href="#!">
												<img src="" alt="bitbucket">
												<span>Bitbucket</span>
											</a>
										</div>
										<div class="col">
											<a class="dropdown-icon-item" href="#!">
												<img src="" alt="dribbble">
												<span>Dribbble</span>
											</a>
										</div>
									</div>

									<div class="row g-0">
										<div class="col">
											<a class="dropdown-icon-item" href="#!">
												<img src="" alt="dropbox">
												<span>Dropbox</span>
											</a>
										</div>
										<div class="col">
											<a class="dropdown-icon-item" href="#!">
												<img src="" alt="mail_chimp">
												<span>Mail Chimp</span>
											</a>
										</div>
										<div class="col">
											<a class="dropdown-icon-item" href="#!">
												<img src="" alt="slack">
												<span>Slack</span>
											</a>
										</div>
									</div>
								</div>
							</div>
						</div> -->

						<!-- <div class="dropdown topbar-head-dropdown ms-1 header-item">
							<button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none" id="page-header-cart-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
								<i class='bx bx-shopping-bag fs-22'></i>
								<span class="position-absolute topbar-badge cartitem-badge fs-10 translate-middle badge rounded-pill bg-info">5</span>
							</button>
							<div class="dropdown-menu dropdown-menu-xl dropdown-menu-end p-0 dropdown-menu-cart" aria-labelledby="page-header-cart-dropdown">
								<div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
									<div class="row align-items-center">
										<div class="col">
											<h6 class="m-0 fs-16 fw-semibold"> My Cart</h6>
										</div>
										<div class="col-auto">
											<span class="badge badge-soft-warning fs-13"><span class="cartitem-badge">7</span>
												items</span>
										</div>
									</div>
								</div>
								<div data-simplebar style="max-height: 300px;">
									<div class="p-2">
										<div class="text-center empty-cart" id="empty-cart">
											<div class="avatar-md mx-auto my-3">
												<div class="avatar-title bg-soft-info text-info fs-36 rounded-circle">
													<i class='bx bx-cart'></i>
												</div>
											</div>
											<h5 class="mb-3">Your Cart is Empty!</h5>
											<a href="apps-ecommerce-products.html" class="btn btn-success w-md mb-3">Shop Now</a>
										</div>
										<div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
											<div class="d-flex align-items-center">
												<img src="
												" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
												<div class="flex-1">
													<h6 class="mt-0 mb-1 fs-14">
														<a href="apps-ecommerce-product-details.html" class="text-reset">Branded
															T-Shirts</a>
													</h6>
													<p class="mb-0 fs-12 text-muted">
														Quantity: <span>10 x $32</span>
													</p>
												</div>
												<div class="px-2">
													<h5 class="m-0 fw-normal">$<span class="cart-item-price">320</span></h5>
												</div>
												<div class="ps-2">
													<button type="button" class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn shadow-none"><i class="ri-close-fill fs-16"></i></button>
												</div>
											</div>
										</div>

										<div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
											<div class="d-flex align-items-center">
												<img src="" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
												<div class="flex-1">
													<h6 class="mt-0 mb-1 fs-14">
														<a href="apps-ecommerce-product-details.html" class="text-reset">Bentwood Chair</a>
													</h6>
													<p class="mb-0 fs-12 text-muted">
														Quantity: <span>5 x $18</span>
													</p>
												</div>
												<div class="px-2">
													<h5 class="m-0 fw-normal">$<span class="cart-item-price">89</span></h5>
												</div>
												<div class="ps-2">
													<button type="button" class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn shadow-none"><i class="ri-close-fill fs-16"></i></button>
												</div>
											</div>
										</div>

										<div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
											<div class="d-flex align-items-center">
												<img src="" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
												<div class="flex-1">
													<h6 class="mt-0 mb-1 fs-14">
														<a href="apps-ecommerce-product-details.html" class="text-reset">
															Borosil Paper Cup</a>
													</h6>
													<p class="mb-0 fs-12 text-muted">
														Quantity: <span>3 x $250</span>
													</p>
												</div>
												<div class="px-2">
													<h5 class="m-0 fw-normal">$<span class="cart-item-price">750</span></h5>
												</div>
												<div class="ps-2">
													<button type="button" class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn shadow-none"><i class="ri-close-fill fs-16"></i></button>
												</div>
											</div>
										</div>

										<div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
											<div class="d-flex align-items-center">
												<img src="" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
												<div class="flex-1">
													<h6 class="mt-0 mb-1 fs-14">
														<a href="apps-ecommerce-product-details.html" class="text-reset">Gray
															Styled T-Shirt</a>
													</h6>
													<p class="mb-0 fs-12 text-muted">
														Quantity: <span>1 x $1250</span>
													</p>
												</div>
												<div class="px-2">
													<h5 class="m-0 fw-normal">$ <span class="cart-item-price">1250</span></h5>
												</div>
												<div class="ps-2">
													<button type="button" class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn shadow-none"><i class="ri-close-fill fs-16"></i></button>
												</div>
											</div>
										</div>

										<div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
											<div class="d-flex align-items-center">
												<img src="" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
												<div class="flex-1">
													<h6 class="mt-0 mb-1 fs-14">
														<a href="apps-ecommerce-product-details.html" class="text-reset">Stillbird Helmet</a>
													</h6>
													<p class="mb-0 fs-12 text-muted">
														Quantity: <span>2 x $495</span>
													</p>
												</div>
												<div class="px-2">
													<h5 class="m-0 fw-normal">$<span class="cart-item-price">990</span></h5>
												</div>
												<div class="ps-2">
													<button type="button" class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn shadow-none"><i class="ri-close-fill fs-16"></i></button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="p-3 border-bottom-0 border-start-0 border-end-0 border-dashed border" id="checkout-elem">
									<div class="d-flex justify-content-between align-items-center pb-3">
										<h5 class="m-0 text-muted">Total:</h5>
										<div class="px-2">
											<h5 class="m-0" id="cart-item-total">$1258.58</h5>
										</div>
									</div>

									<a href="apps-ecommerce-checkout.html" class="btn btn-success text-center w-100">
										Checkout
									</a>
								</div>
							</div>
						</div> -->

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

						<div class="dropdown ms-sm-3 header-item topbar-user">
							<button type="button" class="btn shadow-none mobile-none" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="d-flex align-items-center">
									<img class="rounded-circle header-profile-user" src="{{asset('/public/dashboard-design/images/avatar-1.jpg')}}" alt="Header Avatar">
									<span class="text-start ms-xl-2">
										<span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">Anna Adame</span>
										<span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">Founder</span>
									</span>
								</span>
							</button>
							<div class="dropdown-menu dropdown-menu-end">
								<!-- item-->
								<h6 class="dropdown-header">Welcome Anna!</h6>
								<a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Profile</span></a>
								<a class="dropdown-item" href="apps-chat.html"><i class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Messages</span></a>
								<a class="dropdown-item" href="apps-tasks-kanban.html"><i class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Taskboard</span></a>
								<a class="dropdown-item" href="pages-faqs.html"><i class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Help</span></a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="pages-profile.html"><i class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Balance : <b>$5971.67</b></span></a>
								<a class="dropdown-item" href="pages-profile-settings.html"><span class="badge bg-soft-success text-success mt-1 float-end">New</span><i class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Settings</span></a>
								<a class="dropdown-item" href="auth-lockscreen-basic.html"><i class="mdi mdi-lock text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Lock screen</span></a>
								<a class="dropdown-item" href="auth-logout-basic.html"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

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

		        </div><!-- /.modal-content -->
		    </div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

        <!-- ========== App Menu ========== -->
        @include('layouts.business.businesssidebar')
        <!-- Left Sidebar End -->

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
                                <div class="row mb-3 pb-1">
                                    <div class="col-12">
                                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                            <div class="flex-grow-1">
                                                <h4 class="fs-16 mb-1">Good Morning, {Staff Name}</h4>
                                                <p class="text-muted mb-0">Here's a snap shot of what's happening with {Company Name} today.</p>
                                            </div>
                                            <div class="mt-3 mt-lg-0">
                                                <form action="javascript:void(0);">
                                                    <div class="row g-3 mb-0 align-items-center">
                                                        <div class="col-sm-auto">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control border-0 dash-filter-picker shadow" data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                                                <div class="input-group-text bg-primary border-primary text-white">
                                                                    <i class="ri-calendar-2-line"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end col-->
                                                        <!-- <div class="col-auto">
                                                            <button type="button" class="btn btn-soft-success shadow-none"><i class="ri-add-circle-line align-middle me-1"></i> Add Product</button>
                                                        </div> -->
                                                        <!--end col-->
                                                        <div class="col-auto">
                                                            <button type="button" class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn shadow-none"><i class="ri-pulse-line"></i></button>
                                                        </div>
                                                        <!--end col-->
                                                    </div>
                                                    <!--end row-->
                                                </form>
                                            </div>
                                        </div><!-- end card header -->
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->

                                <div class="row">
                                    <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="white-box flex-grow-1 overflow-hidden">
                                                        <p class="fw-medium text-muted text-truncate mb-0"> Total Sales | Today</p>
                                                    </div>
                                                    <div class="increase flex-shrink-0">
                                                        <h5 class="text-success fs-14 mb-0">
                                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +16.24 %
                                                        </h5>
														<p>Increase</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="559.25">0</span>k </h4>
                                                        <a href="" class="text-decoration-underline">View Sales Report</a>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-success rounded fs-3">
                                                            <i class="bx bx-dollar-circle"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->

                                    <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="white-box flex-grow-1 overflow-hidden">
                                                        <p class="fw-medium text-muted text-truncate mb-0">Total Bookings | Today</p>
                                                    </div>
                                                    <div class="decrease flex-shrink-0">
                                                        <h5 class="text-danger fs-14 mb-0">
                                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i> -3.57 %
                                                        </h5>
														<p>Decrease</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="36894">0</span></h4>
                                                        <a href="" class="text-decoration-underline">View Bookings</a>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-info rounded fs-3">
                                                            <i class="bx bx-shopping-bag"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->

                                    <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="white-box flex-grow-1 overflow-hidden">
                                                        <p class="fw-medium text-muted text-truncate mb-0">Customers | Today</p>
                                                    </div>
                                                    <div class="increase flex-shrink-0">
                                                        <h5 class="text-success fs-14 mb-0">
                                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +29.08 %
                                                        </h5>
														<p>Increase</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="183.35">0</span>M </h4>
                                                        <a href="" class="text-decoration-underline">View Customers</a>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-warning rounded fs-3">
                                                            <i class="bx bx-user-circle"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->

                                    <div class="col-xl-3 col-md-6">
                                        <!-- card -->
                                        <div class="card card-animate">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="white-box flex-grow-1 overflow-hidden">
                                                        <p class="fw-medium text-muted text-truncate mb-0"> Store Sales | Today</p>
                                                    </div>
                                                    <div class="decrease flex-shrink-0">
                                                       <h5 class="text-danger fs-14 mb-0">
                                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i> -3.57 %
                                                        </h5>
														<p>Decrease</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-end justify-content-between mt-4">
                                                    <div>
                                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="26.34">0</span>k </h4>
                                                        <a href="" class="text-decoration-underline">View Sales Report</a>
                                                    </div>
                                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-danger rounded fs-3">
                                                            <i class="bx bx-wallet"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div><!-- end card body -->
                                        </div><!-- end card -->
                                    </div><!-- end col -->
                                </div> <!-- end row-->

                                <div class="row">
                                    <div class="col-xl-8">
                                        <div class="card">
                                            <div class="card-header border-0 align-items-center d-flex flip-view">
                                                <h4 class="card-title mb-0 flex-grow-1">Revenue Goal Tracker </h4>
												 <h4 class="card-title mb-0 flex-grow-1">Current Month: {Month} of {Year} </h4>
                                                <div>
													 <button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
                                                        1M
                                                    </button>
													<button type="button" class="btn btn-soft-primary btn-sm shadow-none">
                                                        1Y
                                                    </button>
                                                    <button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
                                                        ALL
                                                    </button>
                                                </div>
                                            </div><!-- end card header -->

                                            <div class="card-header p-0 border-0 bg-soft-light">
                                                <div class="row g-0 text-center">
                                                    <div class="col-6 col-sm-3">
                                                        <div class="p-3 border border-dashed border-start-0">
															<h5 class="mb-1">$<span class="counter-value" data-target="30000">0</span></h5>
                                                            <p class="text-muted mb-0 revenue">Revenue Needed To Goal</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
													
                                                    <div class="col-6 col-sm-3">
                                                        <div class="p-3 border border-dashed border-start-0" style="padding: 0.4rem!important">
															<div class="flex-shrink-0">
																<div id="total_jobs" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
															</div>
                                                            <!-- <h5 class="mb-1">$<span class="counter-value" data-target="30000">0</span></h5> -->
                                                            <p class="text-muted mb-0 revenue">% of Revenue Acheived</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-sm-3">
                                                        <div class="p-3 border border-dashed border-start-0">
                                                            <h5 class="mb-1">$<span class="counter-value" data-target="2500">0</span></h5>
                                                            <p class="text-muted mb-0 revenue">Revenue Needed Per Day</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                    <div class="col-6 col-sm-3">
                                                        <div class="p-3 border border-dashed border-start-0 border-end-0">
                                                            <h5 class="mb-1">$<span class="counter-value" data-target="16400">0</span></h5>
                                                            <p class="text-muted mb-0 revenue">Revenue You Should Be At Today</p>
                                                        </div>
                                                    </div>
                                                    <!--end col-->
                                                </div>
                                            </div><!-- end card header -->

                                            <div class="card-body p-0 pb-2">
                                                <div class="w-100">
                                                    <div id="projects-overview-chart" data-colors='["--vz-primary", "--vz-warning", "--vz-success"]' class="apex-charts" dir="ltr"></div>
                                                </div>
                                            </div><!-- end card body -->
											
										</div><!-- end card -->
										<div class="col-md-12">
											<div class="card padding-15">
												<div class="row">
													<div class="col-lg-4 col-md-6">
														<div class="border-0 align-items-center text-center mb-15">
															<h4 class="payment-tracker flex-grow-1">Recurring Payments Tracker</h4>
															<h4 class="payment-tracker">{Month, Year}</h4>
															<h4 class="fs-22 fw-semibold ff-secondary scheduled-payments">$<span class="counter-value" data-target="36500">0</span></h4>
															<p class="mb-0">Scheduled Payments </p>
														</div>
													</div>
													<div class="col-lg-4 col-md-6">
														<div class="border-0 align-items-center">
															<div class="card card-animate overflow-hidden set-data mb-15">
																<div class="position-absolute start-0" style="z-index: 0;">
																	<svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
																		<style>
																			.s0 {
																				opacity: .05;
																				fill: var(--vz-info)
																			}
																		</style>
																		<path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z" />
																	</svg>
																</div>
																<div class="card-body" style="z-index:1 ;">
																	<div class="d-flex align-items-center">
																		<div class="flex-grow-1 overflow-hidden">
																			<h4 class="fs-15 fw-semibold ff-secondary mb-3">$<span class="counter-value" data-target="35000">0</span></h4>
																			<p class="fw-medium text-muted text-truncate mb-0">Paid So Far </p>
																		</div>
																		<div class="flex-shrink-0">
																			<div id="new_jobs_chart" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
																		</div>
																	</div>
																</div><!-- end card body -->
															</div>
														</div>
													</div>
													<div class="col-lg-4 col-md-6">
														<div class="border-0 align-items-center">
															<div class="card card-animate overflow-hidden set-data mb-15">
																<div class="position-absolute start-0" style="z-index: 0;">
																	<svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
																		<style>
																			.s0 {
																				opacity: .05;
																				fill: var(--vz-info)
																			}
																		</style>
																		<path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z" />
																	</svg>
																</div>
																<div class="card-body" style="z-index:1 ;">
																	<div class="d-flex align-items-center">
																		<div class="flex-grow-1 overflow-hidden">
																			<h4 class="fs-15 fw-semibold ff-secondary mb-3">$<span class="counter-value" data-target="15000">0</span></h4>
																			<p class="fw-medium text-muted text-truncate mb-0">Owed </p>
																		</div>
																		<div class="flex-shrink-0">
																			<div id="rejected_chart" data-colors='["--vz-danger"]' class="apex-charts" dir="ltr"></div>
																		</div>
																	</div>
																</div><!-- end card body -->
															</div>
														</div>
													</div>
												</div>
											</div>
											
											<!--<div class="card card-animate overflow-hidden">
                                                <div class="position-absolute start-0" style="z-index: 0;">
                                                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 120" width="200" height="120">
                                                        <style>
                                                            .s0 {
                                                                opacity: .05;
                                                                fill: var(--vz-info)
                                                            }
                                                        </style>
                                                        <path id="Shape 8" class="s0" d="m189.5-25.8c0 0 20.1 46.2-26.7 71.4 0 0-60 15.4-62.3 65.3-2.2 49.8-50.6 59.3-57.8 61.5-7.2 2.3-60.8 0-60.8 0l-11.9-199.4z" />
                                                    </svg>
                                                </div>
                                                <div class="card-body" style="z-index:1 ;">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1 overflow-hidden">
                                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-3"> Total Jobs</p>
                                                            <h4 class="fs-22 fw-semibold ff-secondary mb-0"><span class="counter-value" data-target="36894">0</span></h4>
                                                        </div>
                                                        <div class="flex-shrink-0">
                                                            <div id="total_jobs" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>-->
										</div>
                                    </div><!-- end col -->

                                    <div class="col-xl-4">
                                        <!-- card -->
										<div class="card">
											<div class="card-header border-0">
												<h4 class="card-title mb-0 calendar-title">Todays Schedule</h4>
											</div><!-- end cardheader -->
											<div class="card-body pt-0">
												<div class="upcoming-scheduled mb-55">
													<input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" data-deafult-date="today" data-inline-date="true">
												</div>
												<div class="dropdown-activity mt-4 mb-3">
													  <a class="alinkdrop dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
														Show All Activites
													  </a>
													  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
														<li><a class="dropdown-item" href="#">Option-1</a></li>
														<li><a class="dropdown-item" href="#">Option-2</a></li>
														<li><a class="dropdown-item" href="#">Option-3</a></li>
													  </ul>
												</div>
												
											<!--<h6 class="fw-semibold mt-4 mb-3 text-muted activity-show">Show All Activites <i class="fas fa-caret-down"></i></h6>-->
												<div class="mini-stats-wid d-flex align-items-center mt-3">
													<div class="flex-shrink-0 avatar-sm">
														<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-success fs-4 multiple-activites">
															1/1
															<label>Spots left</label>
														</span>
													</div>
													<div class="flex-grow-1 ms-3 activity-info">
														<h6 class="mb-1">Personal Training Sessions</h6>
														<p class="text-muted mb-0">Private Lessons 45 Min. (1 Person)</p>
														<p class="text-muted mb-0">45 Min | Private Lesson | w/ Odin Lin</p>
													</div>
													<div class="flex-shrink-0 ms-3">
														<p class="text-muted mb-0 color-black">9:00 <span class="text-uppercase">am</span></p>
														<p class="text-muted mb-0 color-black">9:45 <span class="text-uppercase">am</span></p>
													</div>
												</div><!-- end -->
												<div class="mini-stats-wid d-flex align-items-center mt-3">
													<div class="flex-shrink-0 avatar-sm">
														<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-success fs-4 multiple-activites">
															1/1
															<label>Spots left</label>
														</span>
													</div>
													<div class="flex-grow-1 ms-3 activity-info">
														<h6 class="mb-1">Personal Training Sessions</h6>
														<p class="text-muted mb-0">Private Lessons 45 Min. (1 Person)</p>
														<p class="text-muted mb-0">45 Min | Private Lesson | w/ Darryl Phipps</p>
													</div>
													<div class="flex-shrink-0">
														<p class="text-muted mb-0 color-black">10:00 <span class="text-uppercase">am</span></p>
														<p class="text-muted mb-0 color-black">10:45 <span class="text-uppercase">am</span></p>
													</div>
												</div><!-- end -->
												<div class="mini-stats-wid d-flex align-items-center mt-3">
													<div class="flex-shrink-0 avatar-sm">
														<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-success fs-4 multiple-activites">
															10/10
															<label>Spots left</label>
														</span>
													</div>
													<div class="flex-grow-1 ms-3 activity-info">
														<h6 class="mb-1">Adult Kickboxing Class</h6>
														<p class="text-muted mb-0">Adult Kickboxing</p>
														<p class="text-muted mb-0">45 Min | Group Class</p>
													</div>
													<div class="flex-shrink-0">
														<p class="text-muted mb-0 color-black">11:00 <span class="text-uppercase">am</span></p>
														<p class="text-muted mb-0 color-black">11:45 <span class="text-uppercase">am</span></p>
													</div>
												</div><!-- end -->
												<div class="mini-stats-wid d-flex align-items-center mt-3">
													<div class="flex-shrink-0 avatar-sm">
														<span class="mini-stat-icon avatar-title rounded-circle text-success bg-soft-success fs-4 multiple-activites">
															10/10
															<label>Spots left</label>
														</span>
													</div>
													<div class="flex-grow-1 ms-3 activity-info">
														<h6 class="mb-1">Kids Martial Arts Programs</h6>
														<p class="text-muted mb-0">Mini Ninjas (3 to 4 years)</p>
														<p class="text-muted mb-0">30 Min | Group Class</p>
													</div>
													<div class="flex-shrink-0">
														<p class="text-muted mb-0 color-black">3:00 <span class="text-uppercase">am</span></p>
														<p class="text-muted mb-0 color-black">3:30 <span class="text-uppercase">am</span></p>
													</div>
												</div><!-- end -->

												<div class="mt-3 text-center">
													<a href="javascript:void(0);" class="text-muted text-decoration-underline">View Full Schedule</a>
												</div>

											</div><!-- end cardbody -->
										</div><!-- end card -->
                                    </div>
                                    <!-- end col -->
                                </div>
								
								<div class="row">
									<div class="col-lg-3 col-md-6">
										<div class="card">
											<div class="card-header">
												<h4 class="card-title mb-0">Bookings & Revenue By Category</h4>
											</div><!-- end card header -->
											<div class="card-body">
												<div>
													<div id="updating_donut_chart" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div> 
												</div>
											</div><!-- end card-body -->
										</div>
									</div>
									<div class="col-lg-3 col-md-6">
										<div class="card">
										<div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Bookings & Revenue Source</h4>
                                                <div class="flex-shrink-0">
                                                    <button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
                                                        1 M
                                                    </button>
													<button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
                                                        All
                                                    </button>
                                                </div>
                                            </div><!-- end card header -->
											<div class="card-body">
												<div>
													<div id="revenue_donut_chart" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
												</div>
												<div class="col-md-12 text-center">
													<a href="" >View Bookings</a>
												</div>
											</div><!-- end card-body -->
										</div>
									</div>
									<div class="col-lg-6 col-md-12">
										<div class="card">
                                            <div class="card-header align-items-center d-flex flip-view">
                                                <h4 class="card-title mb-0 flex-grow-1">Expiring Memberships & Packages</h4>
                                                <div class="flex-shrink-0">
                                                    <button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
                                                        30D
                                                    </button>
													<button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
                                                        90D
                                                    </button>
													<button type="button" class="btn btn-soft-secondary btn-sm shadow-none">
                                                        All
                                                    </button>
                                                </div>
                                            </div><!-- end card header -->
											<div class="month-year align-items-center d-flex flip-view">
                                                <h4 class="card-title mb-0 flex-grow-1">Current Month, {Current Year}</h4>
                                                <div class="flex-shrink-0">
                                                    <h4 class="card-title mb-0 flex-grow-1">Expiring in the next 30 days - 26 </h4>
                                                </div>
                                            </div>

                                            <div class="card-body">
                                                <div class="table-responsive table-card">
                                                    <table class="table table-hover table-centered align-middle table-nowrap mb-0 memberships-pack">
														<thead>
															<tr>
																<td>Name</td>
																<td>Membership Type</td>
																<td>Started on</td>
																<td>End on</td>
																<td></td>
															</tr>
														</thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                   <h5 class="fs-14 my-1 fw-normal">{Customer Name} </h5>
                                                                </td>
                                                                <td>
                                                                   <h5 class="fs-14 my-1 fw-normal">{Membershiptype} </h5>
                                                                </td>
                                                                <td>
                                                                   <h5 class="fs-14 my-1 fw-normal">{startingdate} </h5>  
                                                                </td>
                                                                <td>
                                                                    <h5 class="fs-14 my-1 fw-normal">{enddate} </h5>
                                                                </td>
                                                                <td>
                                                                     <a href="#"> View </a>
                                                                </td>
                                                            </tr>
															<tr>
                                                                <td>
                                                                   <h5 class="fs-14 my-1 fw-normal">{Customer Name} </h5>
                                                                </td>
                                                                <td>
                                                                   <h5 class="fs-14 my-1 fw-normal">{Membershiptype} </h5>
                                                                </td>
                                                                <td>
                                                                   <h5 class="fs-14 my-1 fw-normal">{startingdate} </h5>  
                                                                </td>
                                                                <td>
                                                                    <h5 class="fs-14 my-1 fw-normal">{enddate} </h5>
                                                                </td>
                                                                <td>
                                                                     <a href="#"> View </a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
									</div>
								</div>

                               <!-- <div class="row">
                                    <div class="col-xl-4">
                                        <div class="card card-height-100">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Store Visits by Source</h4>
                                                <div class="flex-shrink-0">
                                                    <div class="dropdown card-header-dropdown">
                                                        <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="text-muted">Report<i class="mdi mdi-chevron-down ms-1"></i></span>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="#">Download Report</a>
                                                            <a class="dropdown-item" href="#">Export</a>
                                                            <a class="dropdown-item" href="#">Import</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-body">
                                                <div id="store-visits-source" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
                                            </div>
                                        </div> 
                                    </div> 
                                </div> -->
                            </div> <!-- end .h-100-->
                        </div> <!-- end col -->

                        <div class="col-auto layout-rightside-col d-none">
                            <div class="overlay"></div>
                            <div class="layout-rightside">
                                <div class="card h-100 rounded-0">
                                    <div class="card-body p-0">
                                        <div class="p-3">
                                            <h6 class="text-muted mb-0 text-uppercase fw-semibold">Recent Activity</h6>
                                        </div>
                                        <div data-simplebar style="max-height: 410px;" class="p-3 pt-0">
                                            <div class="acitivity-timeline acitivity-main">
                                                <div class="acitivity-item d-flex">
                                                    <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                                                        <div class="avatar-title bg-soft-success text-success rounded-circle shadow">
                                                            <i class="ri-shopping-cart-2-line"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-1 lh-base">Purchase by James Price</h6>
                                                        <p class="text-muted mb-1">Product noise evolve smartwatch </p>
                                                        <small class="mb-0 text-muted">02:14 PM Today</small>
                                                    </div>
                                                </div>
                                                <div class="acitivity-item py-3 d-flex">
                                                    <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                                                        <div class="avatar-title bg-soft-danger text-danger rounded-circle shadow">
                                                            <i class="ri-stack-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-1 lh-base">Added new <span class="fw-semibold">style collection</span></h6>
                                                        <p class="text-muted mb-1">By Nesta Technologies</p>
                                                        <div class="d-inline-flex gap-2 border border-dashed p-2 mb-2">
                                                            <a href="apps-ecommerce-product-details.html" class="bg-light rounded p-1">
                                                                <img src="" alt="" class="img-fluid d-block" />
                                                            </a>
                                                            <a href="apps-ecommerce-product-details.html" class="bg-light rounded p-1">
                                                                <img src="" alt="" class="img-fluid d-block" />
                                                            </a>
                                                            <a href="apps-ecommerce-product-details.html" class="bg-light rounded p-1">
                                                                <img src="" alt="" class="img-fluid d-block" />
                                                            </a>
                                                        </div>
                                                        <p class="mb-0 text-muted"><small>9:47 PM Yesterday</small></p>
                                                    </div>
                                                </div>
                                                <div class="acitivity-item py-3 d-flex">
                                                    <div class="flex-shrink-0">
                                                        <img src="" alt="" class="avatar-xs rounded-circle acitivity-avatar shadow">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-1 lh-base">Natasha Carey have liked the products</h6>
                                                        <p class="text-muted mb-1">Allow users to like products in your WooCommerce store.</p>
                                                        <small class="mb-0 text-muted">25 Dec, 2021</small>
                                                    </div>
                                                </div>
                                                <div class="acitivity-item py-3 d-flex">
                                                    <div class="flex-shrink-0">
                                                        <div class="avatar-xs acitivity-avatar">
                                                            <div class="avatar-title rounded-circle bg-secondary shadow">
                                                                <i class="mdi mdi-sale fs-14"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-1 lh-base">Today offers by <a href="apps-ecommerce-seller-details.html" class="link-secondary">Digitech Galaxy</a></h6>
                                                        <p class="text-muted mb-2">Offer is valid on orders of Rs.500 Or above for selected products only.</p>
                                                        <small class="mb-0 text-muted">12 Dec, 2021</small>
                                                    </div>
                                                </div>
                                                <div class="acitivity-item py-3 d-flex">
                                                    <div class="flex-shrink-0">
                                                        <div class="avatar-xs acitivity-avatar">
                                                            <div class="avatar-title rounded-circle bg-soft-danger text-danger shadow">
                                                                <i class="ri-bookmark-fill"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-1 lh-base">Favoried Product</h6>
                                                        <p class="text-muted mb-2">Esther James have favorited product.</p>
                                                        <small class="mb-0 text-muted">25 Nov, 2021</small>
                                                    </div>
                                                </div>
                                                <div class="acitivity-item py-3 d-flex">
                                                    <div class="flex-shrink-0">
                                                        <div class="avatar-xs acitivity-avatar">
                                                            <div class="avatar-title rounded-circle bg-secondary shadow">
                                                                <i class="mdi mdi-sale fs-14"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-1 lh-base">Flash sale starting <span class="text-primary">Tomorrow.</span></h6>
                                                        <p class="text-muted mb-0">Flash sale by <a href="javascript:void(0);" class="link-secondary fw-medium">Zoetic Fashion</a></p>
                                                        <small class="mb-0 text-muted">22 Oct, 2021</small>
                                                    </div>
                                                </div>
                                                <div class="acitivity-item py-3 d-flex">
                                                    <div class="flex-shrink-0">
                                                        <div class="avatar-xs acitivity-avatar">
                                                            <div class="avatar-title rounded-circle bg-soft-info text-info shadow">
                                                                <i class="ri-line-chart-line"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-1 lh-base">Monthly sales report</h6>
                                                        <p class="text-muted mb-2"><span class="text-danger">2 days left</span> notification to submit the monthly sales report. <a href="javascript:void(0);" class="link-warning text-decoration-underline">Reports Builder</a></p>
                                                        <small class="mb-0 text-muted">15 Oct</small>
                                                    </div>
                                                </div>
                                                <div class="acitivity-item d-flex">
                                                    <div class="flex-shrink-0">
                                                        <img src="" alt="" class="avatar-xs rounded-circle acitivity-avatar shadow" />
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-1 lh-base">Frank Hook Commented</h6>
                                                        <p class="text-muted mb-2 fst-italic">" A product that has reviews is more likable to be sold than a product. "</p>
                                                        <small class="mb-0 text-muted">26 Aug, 2021</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-3 mt-2">
                                            <h6 class="text-muted mb-3 text-uppercase fw-semibold">Top 10 Categories
                                            </h6>

                                            <ol class="ps-3 text-muted">
                                                <li class="py-1">
                                                    <a href="#" class="text-muted">Mobile & Accessories <span class="float-end">(10,294)</span></a>
                                                </li>
                                                <li class="py-1">
                                                    <a href="#" class="text-muted">Desktop <span class="float-end">(6,256)</span></a>
                                                </li>
                                                <li class="py-1">
                                                    <a href="#" class="text-muted">Electronics <span class="float-end">(3,479)</span></a>
                                                </li>
                                                <li class="py-1">
                                                    <a href="#" class="text-muted">Home & Furniture <span class="float-end">(2,275)</span></a>
                                                </li>
                                                <li class="py-1">
                                                    <a href="#" class="text-muted">Grocery <span class="float-end">(1,950)</span></a>
                                                </li>
                                                <li class="py-1">
                                                    <a href="#" class="text-muted">Fashion <span class="float-end">(1,582)</span></a>
                                                </li>
                                                <li class="py-1">
                                                    <a href="#" class="text-muted">Appliances <span class="float-end">(1,037)</span></a>
                                                </li>
                                                <li class="py-1">
                                                    <a href="#" class="text-muted">Beauty, Toys & More <span class="float-end">(924)</span></a>
                                                </li>
                                                <li class="py-1">
                                                    <a href="#" class="text-muted">Food & Drinks <span class="float-end">(701)</span></a>
                                                </li>
                                                <li class="py-1">
                                                    <a href="#" class="text-muted">Toys & Games <span class="float-end">(239)</span></a>
                                                </li>
                                            </ol>
                                            <div class="mt-3 text-center">
                                                <a href="javascript:void(0);" class="text-muted text-decoration-underline">View all Categories</a>
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            <h6 class="text-muted mb-3 text-uppercase fw-semibold">Products Reviews</h6>
                                            <!-- Swiper -->
                                            <div class="swiper vertical-swiper" style="height: 250px;">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <div class="card border border-dashed shadow-none">
                                                            <div class="card-body">
                                                                <div class="d-flex">
                                                                    <div class="flex-shrink-0 avatar-sm">
                                                                        <div class="avatar-title bg-light rounded shadow">
                                                                            <img src="" alt="" height="30">
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <div>
                                                                            <p class="text-muted mb-1 fst-italic text-truncate-two-lines"> " Great product and looks great, lots of features. "</p>
                                                                            <div class="fs-11 align-middle text-warning">
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="text-end mb-0 text-muted">
                                                                            - by <cite title="Source Title">Force Medicines</cite>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <div class="card border border-dashed shadow-none">
                                                            <div class="card-body">
                                                                <div class="d-flex">
                                                                    <div class="flex-shrink-0">
                                                                        <img src="" alt="" class="avatar-sm rounded shadow">
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <div>
                                                                            <p class="text-muted mb-1 fst-italic text-truncate-two-lines"> " Amazing template, very easy to understand and manipulate. "</p>
                                                                            <div class="fs-11 align-middle text-warning">
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-half-fill"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="text-end mb-0 text-muted">
                                                                            - by <cite title="Source Title">Henry Baird</cite>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <div class="card border border-dashed shadow-none">
                                                            <div class="card-body">
                                                                <div class="d-flex">
                                                                    <div class="flex-shrink-0 avatar-sm">
                                                                        <div class="avatar-title bg-light rounded shadow">
                                                                            <img src="" alt="" height="30">
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <div>
                                                                            <p class="text-muted mb-1 fst-italic text-truncate-two-lines"> "Very beautiful product and Very helpful customer service."</p>
                                                                            <div class="fs-11 align-middle text-warning">
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-line"></i>
                                                                                <i class="ri-star-line"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="text-end mb-0 text-muted">
                                                                            - by <cite title="Source Title">Zoetic Fashion</cite>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <div class="card border border-dashed shadow-none">
                                                            <div class="card-body">
                                                                <div class="d-flex">
                                                                    <div class="flex-shrink-0">
                                                                        <img src="" alt="" class="avatar-sm rounded shadow">
                                                                    </div>
                                                                    <div class="flex-grow-1 ms-3">
                                                                        <div>
                                                                            <p class="text-muted mb-1 fst-italic text-truncate-two-lines">" The product is very beautiful. I like it. "</p>
                                                                            <div class="fs-11 align-middle text-warning">
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-fill"></i>
                                                                                <i class="ri-star-half-fill"></i>
                                                                                <i class="ri-star-line"></i>
                                                                            </div>
                                                                        </div>
                                                                        <div class="text-end mb-0 text-muted">
                                                                            - by <cite title="Source Title">Nancy Martino</cite>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="p-3">
                                            <h6 class="text-muted mb-3 text-uppercase fw-semibold">Customer Reviews</h6>
                                            <div class="bg-light px-3 py-2 rounded-2 mb-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1">
                                                        <div class="fs-16 align-middle text-warning">
                                                            <i class="ri-star-fill"></i>
                                                            <i class="ri-star-fill"></i>
                                                            <i class="ri-star-fill"></i>
                                                            <i class="ri-star-fill"></i>
                                                            <i class="ri-star-half-fill"></i>
                                                        </div>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <h6 class="mb-0">4.5 out of 5</h6>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <div class="text-muted">Total <span class="fw-medium">5.50k</span> reviews</div>
                                            </div>

                                            <div class="mt-3">
                                                <div class="row align-items-center g-2">
                                                    <div class="col-auto">
                                                        <div class="p-1">
                                                            <h6 class="mb-0">5 star</h6>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="p-1">
                                                            <div class="progress bg-soft-success animated-progress progress-sm">
                                                                <div class="progress-bar bg-success" role="progressbar" style="width: 50.16%" aria-valuenow="50.16" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="p-1">
                                                            <h6 class="mb-0 text-muted">2758</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end row -->

                                                <div class="row align-items-center g-2">
                                                    <div class="col-auto">
                                                        <div class="p-1">
                                                            <h6 class="mb-0">4 star</h6>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="p-1">
                                                            <div class="progress bg-soft-success animated-progress progress-sm">
                                                                <div class="progress-bar bg-success" role="progressbar" style="width: 29.32%" aria-valuenow="29.32" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="p-1">
                                                            <h6 class="mb-0 text-muted">1063</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end row -->

                                                <div class="row align-items-center g-2">
                                                    <div class="col-auto">
                                                        <div class="p-1">
                                                            <h6 class="mb-0">3 star</h6>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="p-1">
                                                            <div class="progress bg-soft-warning animated-progress progress-sm">
                                                                <div class="progress-bar bg-warning" role="progressbar" style="width: 18.12%" aria-valuenow="18.12" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="p-1">
                                                            <h6 class="mb-0 text-muted">997</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end row -->

                                                <div class="row align-items-center g-2">
                                                    <div class="col-auto">
                                                        <div class="p-1">
                                                            <h6 class="mb-0">2 star</h6>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="p-1">
                                                            <div class="progress bg-soft-success animated-progress progress-sm">
                                                                <div class="progress-bar bg-success" role="progressbar" style="width: 4.98%" aria-valuenow="4.98" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="p-1">
                                                            <h6 class="mb-0 text-muted">227</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end row -->

                                                <div class="row align-items-center g-2">
                                                    <div class="col-auto">
                                                        <div class="p-1">
                                                            <h6 class="mb-0">1 star</h6>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="p-1">
                                                            <div class="progress bg-soft-danger animated-progress progress-sm">
                                                                <div class="progress-bar bg-danger" role="progressbar" style="width: 7.42%" aria-valuenow="7.42" aria-valuemin="0" aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="p-1">
                                                            <h6 class="mb-0 text-muted">408</h6>
                                                        </div>
                                                    </div>
                                                </div><!-- end row -->
                                            </div>
                                        </div>

                                        <div class="card sidebar-alert bg-light border-0 text-center mx-4 mb-0 mt-3">
                                            <div class="card-body">
                                                <img src="" alt="">
                                                <div class="mt-4">
                                                    <h5>Invite New Seller</h5>
                                                    <p class="text-muted lh-base">Refer a new seller to us and earn $100 per refer.</p>
                                                    <button type="button" class="btn btn-primary btn-label rounded-pill"><i class="ri-mail-fill label-icon align-middle rounded-pill fs-16 me-2"></i> Invite Now</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div> <!-- end card-->
                            </div> <!-- end .rightbar-->
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

    <!-- JAVASCRIPT -->
    <script src="{{asset('/public/dashboard-design/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('/public/dashboard-design/js/simplebar.min.js')}}"></script>
    <script src="{{asset('/public/dashboard-design/js/waves.min.js')}}"></script>
    <script src="{{asset('/public/dashboard-design/js/feather.min.js')}}"></script>
    <script src="{{asset('/public/dashboard-design/js/lord-icon-2.1.0.js')}}"></script>
    <script src="{{asset('/public/dashboard-design/js/plugins.js')}}"></script>

    <!-- apexcharts -->
    <script src="{{asset('/public/dashboard-design/js/apexcharts.min.js')}}"></script>

    <!-- Vector map
    <script src="assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
    <script src="assets/libs/jsvectormap/maps/world-merc.js"></script>-->

    <!--Swiper slider js -->
    <script src="{{asset('/public/dashboard-design/js/swiper-bundle.min.js')}}"></script>

	<script src="{{asset('/public/dashboard-design/js/feather.min.js')}}"></script>
    <!-- Dashboard init -->
    <!--<script src="{{asset('/public/dashboard-design/js/dashboard-ecommerce.init.js')}}"></script>-->
	<script src="{{asset('/public/dashboard-design/js/dashboard-projects.init.js')}}"></script>
	<!-- Pie chart -->
	<script src="{{asset('/public/dashboard-design/js/apexcharts-pie.init.js')}}"></script>
	<!-- circle -->
	<script src="{{asset('/public/dashboard-design/js/dashboard-job.init.js')}}"></script>
	
    <!-- App js -->
    <script src="{{asset('/public/dashboard-design/js/app.js')}}"></script> 
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
		/*jQuery(document).ready(function() {
			jQuery('#topnav-hamburger-icon').click(function(){
				$('html').attr('sidebar-size', 'sm'); 
			});
		});*/
	</script>
	<script type="text/javascript">

		var chartDonut1 = ( options = {
          	series: [44, 55, 13, 33, 22],
          	labels: ['Personal Training', 'Classes','Experiences','Events','Products'],
          	chart: {
          		 height: 300,
          		type: 'donut',
       	 	},
	        dataLabels: {
	          enabled: false
	        },
	        responsive: [{
	          	breakpoint: 480,
	          	options: {
		            legend: {
		              show: false
		            }
	          	}
        	}],
	        legend: {
	        	position: 'bottom',
	            bottom: 'center', 
	            itemHeight: 8,
	            itemWidth: 8
	        }
        },(chart = new ApexCharts(document.querySelector("#updating_donut_chart"), options)).render()),

        chartDonut2 = ( options = {
          	series: [44, 55],
          	labels: ['In-Person', 'Online'],
          	chart: {
          		height: 300,
          		type: 'donut',
       	 	},
	        dataLabels: {
	          enabled: false
	        },
	        responsive: [{
	          	breakpoint: 480,
	          	options: {
		            legend: {
		              show: false
		            }
	          	}
        	}],
	        legend: {
	        	position: 'bottom',
	            bottom: 'center', 
	            itemHeight: 8,
	            itemWidth: 8
	        }
        },(chart = new ApexCharts(document.querySelector("#revenue_donut_chart"), options)).render()),

        radialBar = ( options = {
	        series: [80],
	        chart: {
		      	width: 70,
		        type: 'radialBar',
		        sparkline: {
		            enabled: !0
		        }
        	},
        	dataLabels: {
		       enabled: !1
		    },
		    plotOptions: {
		        radialBar: {
		            hollow: {
		                margin: 0,
		                size: "60%"
		            },
		            track: {
		                margin: 1
		            },
		            dataLabels: {
		                show: !0,
		                name: {
		                    show: !1
		                },
		                value: {
		                    show: !0,
		                    fontSize: "10px",
		                    fontWeight: 800,
		                    offsetY: 5
		                }
		            }
		        }
   		 	},
        },(chart = new ApexCharts(document.querySelector("#total_jobs"), options)).render())

	</script>
@endsection