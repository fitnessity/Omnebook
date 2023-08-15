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
	<link href="{{asset('/public/dashboard-design/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

	<link href="{{asset('/public/css/slimselect.min.css')}}" rel="stylesheet" type="text/css" />
	<link href="{{asset('/public/js/select/select.css')}}" rel="stylesheet" type="text/css" />
	<script src="{{asset('/public/dashboard-design/js/plugins.js')}}"></script>
	
	<!-- fullcalendar css >-->
	<link rel="stylesheet" type="text/css" href="{{ url('public/css/metismenu.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ url('public/css/fullcalendar/fullcalendar.min.css') }}"> 
	

	<!-- dropzone css -->
	<link href="{{asset('/public/dashboard-design/css/dropzone.css')}}" rel="stylesheet" type="text/css" />
	
	<!-- glightbox css -->
	<link href="{{asset('/public/dashboard-design/css/glightbox.min.css')}}" rel="stylesheet" type="text/css" />
	
	<!-- app css 
	<link href="{{asset('/public/dashboard-design/css/app.min.css')}}" rel="stylesheet" type="text/css" />-->
</head>

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
											<input type="text" class="form-control" placeholder="Search for client" autocomplete="off" id="serchclient_navbar1"  name="fname" value="{{Request::get('fname')}}">

											<button class="btn btn-red" type="button"><i class="mdi mdi-magnify"></i></button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div>
							<button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle shadow-none desktop-add-client-none" data-bs-toggle="modal" data-bs-target=".new-client-steps">
								<i class='bx bx-message-square-add fs-22' ></i>
							</button>
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

						<!--<div class="dropdown topbar-head-dropdown ms-1 header-item">
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
						</div>-->

						<!--<div class="dropdown topbar-head-dropdown ms-1 header-item">
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
						</div>-->

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
											Select <div id="select-content" class="text-body fw-semibold px-1">0</div> Result 
											<!-- <button type="button" class="btn btn-link link-danger p-0 ms-3" data-bs-toggle="modal" data-bs-target="#removeNotificationModal">Remove</button> -->
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="dropdown ms-sm-3 header-item topbar-user d-none">
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
		        </div>
		    </div>
		</div>

		@include('customers._add_new_client_modal')


		@include('layouts.profile.left_panel')

		<!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>
<script type="text/javascript">
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
