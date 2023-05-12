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
												<div class="row">
													<div class="col-md-6">
														<div class="steps-title">
															<h3>Step 1: Program Details</h3>
															<p class="mb-3">Explain to your customer what this program is.</p>
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
																<div id="gallery"></div>
															</div>
														</div>
													</div>
													<div class="col-md-6">
														<button type="button" class="btn-red-primary btn-red" id="backindividual2"><i class="fa fa-arrow-left"></i> Back</button>
													</div>
													<div class="col-md-6">
														<button type="button" class="btn-red-primary btn-red float-right" id="nextindividual2">Continue <i class="fa fa-arrow-right"></i></button>
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
											<div class="card-body">
												<div class="row">
													<div class="col-md-12">
														<div class="steps-title">
															<h3>Step 2: Booking Settings</h3>
															<p class="mb-3">Provide more details to get booked</p>
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
													</div>
													
												</div>
												<div class="row">
													<div class="col-md-5 col-lg-4">
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
													<div class="col-md-4 col-lg-3">
														<div class="participant-req">
															<p>Whats the latest a customer can cancel?</p>
														</div>
													</div>
													<div class="col-md-1">
														<input type="text" class="form-control">
													</div>
													<div class="col-md-2">
														<select class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
															<option value="min" selected="">Minute(s)</option>
															<option value="hour">Hour(s)</option>
														</select>
													</div>
												</div>
												<!--<div class="row">
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
													   
														<script>
															var p = new SlimSelect({
																select: '#categSTypeidividuals'
															});
														</script>
													</div>
												</div>-->
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