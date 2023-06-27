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
									<div class="col-6">
										<div class="page-heading">
											<label>Manage Services</label>
										</div>
									</div>
									<div class="col-6">
										<div class="service-create">
											<input type="submit" class="btn btn-red" name="btncreateservice" id="btncreateservice" value="Create New Service">
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
													<div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">	
														<img src="http://dev.fitnessity.co/public/uploads/profile_pic/1673005320-Screenshot 2023-01-04 at 03-17-41 Daniel Covel (@dancoveljiujitsu) • Instagram photos and videos.png" alt="Avatar" class="avatar">
													</div>
													<div class="col-xs-12 col-lg-6 col-md-8 col-sm-8">
														<div class="nw-user-details">
															<p class="texttr">Bucephalus Riding and Polo Club1 (Horseback Riding) <b>Active</b></p>
															<p class="texttr"><b>Events</b></p>
														</div>
                                                    </div>
													<div class="col-xs-12 col-lg-5 col-md-2 col-sm-2">
														<div class="float-end">
															<a href="#" data-bs-toggle="modal" data-bs-target=".moreoptions"> <i class="ri-more-fill"></i> </a>
															<div class="modal fade moreoptions" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
																<div class="modal-dialog modal-dialog-centered modal-70">
																	<div class="modal-content">
																		<div class="modal-header">
																			<h5 class="modal-title" id="myModalLabel">Services</h5>
																			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																		</div>
																		<div class="modal-body">
																			<div class="row">
																				<div class="col-lg-3 col-md-3 col-sm-6">
																					<div class="manage-txt mb-15">
																						<label class="highlight-font">Bookings Overview</label>
																						<span>0 Bookings This Week   </span>
																						<span>Service Expires on: 05/14/2023</span>
																						<a href="#" data-bs-toggle="modal" data-bs-target=".view-booking">VIEW BOOKINGS</a>
																					</div>
																				</div>
																				<div class="col-lg-4 col-md-3 col-sm-6">
																					<div class="manage-txt mb-15">
																						<label class="highlight-font">Edit/Add Schedule</label>
																						<span>1 CATEGORIES CREATED | <br> 1 CATEGORIES SCHEDULED | <br>
																						<a href="#" data-bs-toggle="modal" data-bs-target=".edit-schedule"> + EDIT SCHEDULE</a>
																						</span>
																					</div>
																				</div>
																				<div class="col-lg-2 col-md-3 col-sm-6">	
																					<div class="display-flex">
																						<input type="submit" class="btn btn-black mb-10 width-100 mr-15" name="btnedit" id="btnedit" value="Edit Service ">
																						<input type="button" class="btn btn-black mb-10 width-100" name="btndelete" id="btndelete" value="Delete Service">
																					</div>
																				</div>
																				<div class="col-lg-3 col-md-3 col-sm-6">	
																					 <input type="submit" class="btn btn-red width-100" name="btnactive" id="btnactive" value="Make Service Inactive">
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
													<!---->
												</div>
                                             </div><!-- end card body -->
										</div>
										
										<div class="card">
                                            <div class="card-body">
												<div class="row">
													<div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">	
														<img src="http://dev.fitnessity.co/public/uploads/profile_pic/1670232902-shutterstock_128564717.jpeg" alt="Avatar" class="avatar">
													</div>
													<div class="col-xs-12 col-lg-6 col-md-8 col-sm-8">
														<div class="nw-user-details">
															<div class="nw-user-details">
															<p class="texttr">River Rafting (Rafting)  <b>Active</b></p>
															<p class="texttr"><b>Events</b></p>
														</div>
														</div>
                                                    </div>
													<div class="col-xs-12 col-lg-5 col-md-2 col-sm-2">
														<div class="float-end">
															<a href="#" data-bs-toggle="modal" data-bs-target=".moreoptions"><i class="ri-more-fill"></i></a>
														</div>
													</div>
													<!---->
												</div>
                                             </div><!-- end card body -->
										</div>
										
										<div class="modal fade edit-schedule" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered modal-70">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="myModalLabel">Select the category you would like to schedule for bucephalus riding and polo club1</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">
														<div class="modal-inner-txt">
															<h4>Category</h4>
														</div>
														<div class="modal-inner-txt border-modal-data">
															<div class="row">
																<div class="col-md-4 col-sm-3 col-xs-12">
																	<span>1. Private Lessons 30 Min. (1 Person)</span><span class="schedle-separator"> | </span>
																</div>
																<div class="col-md-3 col-sm-3 col-xs-12">
																	<span>15min. </span><span class="schedle-separator"> | </span>
																</div>
																<div class="col-md-3 col-sm-4 col-xs-12">
																	<span> 1 TIMESLOTS SCHEDULED</span><span class="schedle-separator"> | </span>
																</div>
																<div class="col-md-2 col-sm-3 col-xs-12"> 
																	<span> <a href="#">+ EDIT SCHEDULE</a></span>
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
										<div class="modal fade edit-schedule" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered modal-70">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="myModalLabel">Select the category you would like to schedule for bucephalus riding and polo club1</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
													</div>
													<div class="modal-body">
														<div class="modal-inner-txt">
															<h4>Category</h4>
														</div>
														<div class="modal-inner-txt border-modal-data">
															<div class="row">
																<div class="col-md-4 col-sm-3 col-xs-12">
																	<span>1. Private Lessons 30 Min. (1 Person)</span><span class="schedle-separator"> | </span>
																</div>
																<div class="col-md-3 col-sm-3 col-xs-12">
																	<span>15min. </span><span class="schedle-separator"> | </span>
																</div>
																<div class="col-md-3 col-sm-4 col-xs-12">
																	<span> 1 TIMESLOTS SCHEDULED</span><span class="schedle-separator"> | </span>
																</div>
																<div class="col-md-2 col-sm-3 col-xs-12"> 
																	<span> <a href="#">+ EDIT SCHEDULE</a></span>
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
									<div class="modal fade view-booking" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered modal-80">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="myModalLabel">View Your bookings for Bucephalus Riding and Polo Club1</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body">
													<div class="mt-3 mt-lg-0">
														<form action="javascript:void(0);">
															<div class="row g-3 mb-0 align-items-center">
																<div class="col-sm-auto">
																	<div class="input-group">
																		<input type="text" class="form-control border-0 dash-filter-picker shadow flatpickr-range" data-range-date="false" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
																		<div class="input-group-text bg-primary border-primary text-white">
																			<i class="ri-calendar-2-line"></i>
																		</div>
																	</div>
																</div>
																<div class="col-sm-auto">
																	<div class="date-info">
																		<label>Today Date:</label><span> 05/17/2023</span>
																	</div>
																</div>
																<div class="col-sm-auto">
																	<div class="date-info">
																		<label>Total Bookings:</label><span>11</span>
																	</div>
																</div>
																<!--end col-->
															</div>
															<!--end row-->
														</form>
														<div class="view-booking-table">
															<div class="table-responsive">
																<table class="table mb-0">
																	<thead>
																		<tr>
																			<th>Name</th>
																			<th>Date Booked</th>
																			<th>Whos Participating</th>
																			<th>Category Name</th>
																			<th>Price Option</th>
																		</tr>
																	</thead>
																	<tbody>
																		<tr>
																			<td><a href="#">Nipa Soni</a></td>
																			<td>04/28/2023</td>
																			<td>Nipa Soni</td>
																			<td> Private Lessons 30 Min. (1 Person)  </td>
																			<td>30 Minute Private (01 Pack) </td>
																		</tr>
																		<tr>
																			<td><a href="#">Nipa Soni</a></td>
																			<td>04/28/2023</td>
																			<td>Nipa Soni ( age 23 )</td>
																			<td> Private Lessons 30 Min. (1 Person)  </td>
																			<td>30 Minute Private (01 Pack) </td>
																		</tr>
																		<tr>
																			<td><a href="#">Albina Glick</a></td>
																			<td>N/A</td>
																			<td>Albina Glick</td>
																			<td>Private Lessons 30 Min. (1 Person) </td>
																			<td>30 Minute Private (01 Pack)</td>
																		</tr>
																	</tbody>
																</table>
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
									<div class="manage-comapny">	
										<a href="/manage/company">Back to Manage Company</a>
									</div>
								</div><!--end col-->
							</div><!--end row-->					
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

	
	
	@include('layouts.business.footer')
	<script>
		flatpickr(".flatpickr-range", {
	        dateFormat: "m/d/Y",
	        maxDate: "01/01/2050",
			defaultDate: [new Date()],
	     });
	</script>
	

@endsection