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
							<button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<img src="{{asset('/public/dashboard-design/images/us.svg')}}" alt="user-image" class="rounded" height="20">
							</button>
							<div class="dropdown-menu dropdown-menu-end">

								<!-- item-->
								<a href="javascript:void(0);" class="dropdown-item notify-item language py-2" data-lang="en" title="English">
									<img src="{{asset('/public/dashboard-design/images/us.svg')}}" alt="user-image" class="me-2 rounded" height="18">
									<span class="align-middle">English</span>
								</a>

								<!-- item-->
								<a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="sp" title="Spanish">
									<img src="{{asset('/public/dashboard-design/images/spain.svg')}}" alt="user-image" class="me-2 rounded" height="18">
									<span class="align-middle">Española</span>
								</a>

								<!-- item-->
								<a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="gr" title="German">
									<img src="{{asset('/public/dashboard-design/images/germany.svg')}}" alt="user-image" class="me-2 rounded" height="18"> <span class="align-middle">Deutsche</span>
								</a>

								<!-- item-->
								<a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="it" title="Italian">
									<img src="{{asset('/public/dashboard-design/images/italy.svg')}}" alt="user-image" class="me-2 rounded" height="18">
									<span class="align-middle">Italiana</span>
								</a>

								<!-- item-->
								<a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ru" title="Russian">
									<img src="{{asset('/public/dashboard-design/images/russia.svg')}}" alt="user-image" class="me-2 rounded" height="18">
									<span class="align-middle">русский</span>
								</a>

								<!-- item-->
								<a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ch" title="Chinese">
									<img src="{{asset('/public/dashboard-design/images/china.svg')}}" alt="user-image" class="me-2 rounded" height="18">
									<span class="align-middle">中国人</span>
								</a>

								<!-- item-->
								<a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="fr" title="French">
									<img src="{{asset('/public/dashboard-design/images/french.svg')}}" alt="user-image" class="me-2 rounded" height="18">
									<span class="align-middle">français</span>
								</a>

								<!-- item-->
								<a href="javascript:void(0);" class="dropdown-item notify-item language" data-lang="ar" title="Arabic">
									<img src="{{asset('/public/dashboard-design/images/ae.svg')}}" alt="user-image" class="me-2 rounded" height="18">
									<span class="align-middle">Arabic</span>
								</a>
							</div>
						</div>

						<div class="dropdown topbar-head-dropdown ms-1 header-item">
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
						</div>

						<div class="dropdown topbar-head-dropdown ms-1 header-item">
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
																	<p>Booking and creating group classes, boot camps, clinics, and more is very easy. You can create services both online and offline.WHen creating your profile, how do you stand out from others? Every image, video, description, price, completed background check,positive reviews, and how you deliver your services will help you become a top business professional on Fitnessity.</p>
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

@endsection