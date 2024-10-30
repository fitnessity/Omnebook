<?php
use App\User;
$total_quantity = 0;
?>

<!DOCTYPE html>
<html class="no-js" lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
    <head>
        <title>Fitnessity</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta content="Fitnessity: Because Fitness=Necessity" name="description" />
		<meta content="" name="author" />

        <!-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="charset=utf-8"> -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content=" Fitnessity: Because Fitness=Necessity ">
        <meta itemprop="name" content="">
        <meta itemprop="description" content=" Fitnessity: Because Fitness=Necessity ">
        <meta itemprop="image" content="">
        <meta name="twitter:card" content="product">
        <meta name="twitter:title" content="">
        <meta name="twitter:description" content=" Fitnessity: Because Fitness=Necessity ">
        <meta name="twitter:image" content="">
        <meta property="og:url" content="">
        <meta property="og:type" content="">
        <meta property="og:title" content="">
        <meta property="og:description" content=" Fitnessity: Because Fitness=Necessity ">
        <meta property="og:image" content="">
        <meta property="og:site_name" content="Fitnessity">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <link rel="shortcut icon" href="{{ url('/public/images/email/favicon.png') }}">
        <link rel="icon" href="{{ url('/public/images/email/favicon.png') }}">
        <!-- <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,700,900'>
        <link rel='stylesheet' type='text/css'href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300'> -->

		<!-- Bootstrap Css -->
		<link href="{{ url('/public/dashboard-design/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    	<link href="{{ url('/public/dashboard-design/css/simplebar.min.css')}}" rel="stylesheet" type="text/css" />

		 <!-- Style Css-->
		 <link href="{{ url('/public/dashboard-design/css/style.css')}}" rel="stylesheet" type="text/css" />

		<!-- Custom Css-->
		<link href="{{ url('/public/dashboard-design/css/custom.css')}}" rel="stylesheet" type="text/css" />

        <link rel='stylesheet' type='text/css' href="{{ url('/public/css/font_family.css')}}">
        <link rel='stylesheet' type='text/css' href="{{ url('/public/css/font_family_roboto.css')}}">
		<!-- fullcalendar css >-->
		<link rel="stylesheet" type="text/css" href="{{ url('/public/css/metismenu.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{ url('/public/css/fullcalendar/fullcalendar.min.css')}}"> 
		<link href="{{url('/public/dashboard-design/css/glightbox.min.css')}}" rel="stylesheet" type="text/css" />
		<!-- icon -->
		<link href="{{ url('/public/dashboard-design/css/icons.min.css')}}" rel="stylesheet" type="text/css" />

		<link href="{{ url('/public/css/slimselect.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ url('/public/css/select.css')}}" rel="stylesheet" type="text/css" />
		<script src="{{ url('/public/dashboard-design/js/plugins.js')}}"></script>

        <link rel="stylesheet" type="text/css" href="{{url('/public/css/all.css')}}">
        <link rel='stylesheet' type='text/css' href="{{url('/public/css/owl.css')}}">
	
        <link rel='stylesheet' type='text/css' href="{{url('/public/css/bootstrap-select.min.css')}}">
		<link rel='stylesheet' type='text/css' href="{{url('/public/css/frontend/header-footer.css')}}">
        
        <link rel='stylesheet' type='text/css' href="{{url('/public/css/responsive.css')}}">
		<!-- <link rel="stylesheet" href="{{url('/public/css/AdminLTE/plugins/datatables/dataTables.bootstrap.css')}}"> -->
		<!--datatable css-->
		<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
		<!--datatable responsive css-->
		<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
		<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
		
		<!-- font glyphicon -->
		<link href="{{url('/public/css/glyphicon.css')}}" rel="stylesheet" type="text/css" />

        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
        <!-- <script src="https://d2bgo0bc1t29nh.cloudfront.net/public/dashboard-design/js/jquery-3.6.4.min.js"></script>
        <script src="https://d2bgo0bc1t29nh.cloudfront.net/public/js/slimselect.min.js"></script> -->
		<!-- <script src="{{env('APP_URL')}}/public/js/ratings.js"></script> -->
		<script src="{{url('/public/dashboard-design/js/jquery-3.6.4.min.js')}}"></script>
        <script src="{{url('/public/js/slimselect.min.js')}}"></script>
	
  		<!-- <script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('AUTO_COMPLETE_ADDRESS_GOOGLE_KEY') }}" ></script> -->
  

		<!-- <script src="https://maps.googleapis.com/maps/api/js?loading=async&v=weekly&libraries=marker&key=AIzaSyBHm1RdzTbNsr9qm-AEfdreOWihD-oHN9A" async></script> -->
        <style>/*
            .btn-style-one {
                position: relative;
                display: inline-block;
                font-size: 14px;
                line-height: 10px;
                color: #ffffff;
                padding: 10px!important;
                font-weight: 500;
                overflow: hidden;
                overflow: hidden;
                text-transform: capitalize;
                background-color: #f91942;
                font-family: 'Montserrat', sans-serif;
                cursor: pointer;
                border-radius: 0!important;
                width: auto;
                margin: 0!important;
                border: 0;
            }*/
			#equipment-list{
			  left: 0;
			  top: 30px;
			  list-style: none;
			  padding: 0;
			  width: 100%;
			  position: absolute;
			  /*max-width: calc(100% - 30px);*/
			  /*background: #fff;*/
			  border-top: #dcdcdc 1px solid;
			  box-shadow: 0px 0px 4px rgba(220, 220, 220, 0.6);
			  z-index: 999;			  
			}
			#equipment-list li{
			  padding: 5px 10px;
			  background: #f7f7f7;
			  border: #dcdcdc 1px solid;
			  border-top: none;
			  transition: all 0.2s ease;
			  font-size: 12px;
			}
			#equipment-list li:hover{
			  background: #ecf0f5;
			  cursor: pointer;
			  transition: all 0.2s ease;
			}
			.equipment-list{
			  	left: 0;
			  	top: 35px;
			  	list-style: none;
			  	/*margin-top: 0px;*/
			  	padding: 0;
			  	width: 100%;
			  	position: absolute;
			  	/*max-width: calc(100% - 30px);*/
			  	/*background: #fff;*/
			  	border-top: #dcdcdc 1px solid;
			  	box-shadow: 0px 0px 4px rgba(220, 220, 220, 0.6);
			  	z-index: 999;
			}
			.equipment-list li{
			  	padding: 5px 10px;
			  	background: #f7f7f7;
			  	border: #dcdcdc 1px solid;
			  	border-top: none;
			  	transition: all 0.2s ease;
			  	font-size:12px;
			}
			.equipment-list li:hover{
			 	background: #ecf0f5;
			  	cursor: pointer;
			  	transition: all 0.2s ease;
			}			
			
			.profile-img{ }
			.text-lp{ color: white; /*padding: 15px 15px 15px 15px;*/ }
					
			.openbtn {
				font-size: 20px;
				cursor: pointer;
				background-color: #111;
				color: white;
				padding: 10px 15px;
				border: none;
			}
			
			.btn-style-srch {
			  position: relative;
			  display: inline-block;
			  font-size: 14px;
			  line-height: 10px;
			  color: #ffffff;
			  padding: 12px !important;
			  font-weight: 500;
			  overflow: hidden;
			  overflow: hidden;
			  text-transform: capitalize;
			  background-color: #f91942;
			  font-family: 'Montserrat', sans-serif;
			  cursor: pointer;
			  border-radius: 21px;
			  width: 116px;
			  margin: 0 !important;
			  border: 0;
			}
			
			.top-area ul.setting-area li  a {
			  color: #b9b9b9;
			  font-size: 18px;
			  position: relative;
			  display: inline-block;
			  width: 50px;
			  text-align: center;
			  transition: all 0.2s linear 0s;
			  vertical-align: middle;
			}
			.top-area ul.setting-area li a::before {
			  background: rgba(0, 0, 0, 0.1) none repeat scroll 0 0;
			  border-radius: 100%;
			  content: "";
			  height: 40px;
			  left: 50%;
			  position: absolute;
			  top: 53%;
			  transform: translate(-50%, -50%) scale(0);
			  transition: all 0.2s linear 0s;
			  width: 40px;
			  z-index: -1;
			}
			.top-area ul.setting-area li a em {
			  border-radius: 100%;
			  color: #fff;
			  font-size: 10px;
			  height: 17px;
			  line-height: 17px;
			  position: absolute;
			  right: 6px;
			  text-align: center;
			  top: -11px;
			  width: 17px;
			  font-style: normal;
			}
			.bg-red { background: #e44a3c; }
			.bg-purple { background: #7750f8; }
			.bg-blue { background: #23d2e2; }
			.top-area .user-img {
			  cursor: pointer;
			  display: inline-block;
			  vertical-align: middle;
			  position: relative;
			  line-height: 65px;
			  background: none !important;
			  padding: 0px;
			}
			.user-img > h5 {
			  color: #fff;
			  display: inline-block;
			  font-size: 14px;
			  font-weight: 500;
			  margin: 0;
			  vertical-align: middle;
			}
			.top-area .user-img > img {
			  border-radius: 50%;
			  display: inline-block;
			  transform: scale(0.8);
			  vertical-align: inherit;
			  border: 2px solid rgba(255,255,255,.8);
			}
			.top-area .user-img > span.status { bottom: 10px; right: 5px; }
			span.status.f-online { background: #7FBA00; }
			span.status {
			  background: #bebebe none repeat scroll 0 0;
			  border-radius: 50%;
			  bottom: 0;
			  display: inline-block;
			  height: 10px;
			  padding: 2px;
			  position: absolute;
			  right: 0;
			  width: 10px;
			}
			span.status::after {
			  background: white none repeat scroll 0 0;
			  border-radius: 100%;
			  content: "";
			  height: 2px;
			  left: 50%;
			  position: absolute;
			  top: 50%;
			  transform: translate(-50%, -50%);
			  width: 6px;
			}
			.help-us-side{
				font-size: 11px;
			}
			.border-sidebar{
				border-bottom: 1px solid #fff;
				margin-top: 10px;
				margin-bottom: 10px;
			}
			@media screen and (max-width: 400px){
				.top-search { width: 100%; }
			}
			@media screen and (min-width: 401px) and (max-width: 767px){
				.top-search { width: 100%;  }
			}
			@media screen and (min-width: 768px) and (max-width: 992px){
				.top-search { width: 73%;  }
			}
			@media screen and (min-width: 1920px) and (max-width: 2500px){ }
			*/
	</style>
	
	

	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-KQRG55N3Q1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
	
	  gtag('config', 'G-KQRG55N3Q1');
	</script>

    </head>

    <body>
        <?php 
        $companyid = (isset($companyid) && $companyid != "") ? $companyid : 0;
        $module = explode(".co/", url()->current());?>
        <header @if(  request()->is('*register_ep*') || request()->is('*check-in-welcome*') || request()->is('*quick-checkin*')|| request()->is('*check-in-portal*')) class="d-none" @endif>
			<div class="container-fluid printnone">
				<div class="row">
					<div class="col-lg-12">
						<div class="menu_nav">
                
						<div class="logo-header"> 
							<a href="{{ Config::get('constants.SITE_URL') }}/" class="logo"><img src="/public/images/omnebook.png" alt="logo"></a>
						<!-- <a href="{{ Config::get('constants.SITE_URL') }}/" class="logo"> <img src="https://d2bgo0bc1t29nh.cloudfront.net/public/images/fitnessity_logo1_black.png"> </a> -->
						</div>
					
						<div class="top-area">
							<!-- {{Route::currentRouteName()}} -->
							@if (in_array(Route::currentRouteName(), ['activities_index', 'businessClaim', 'userlogin', 'staff_login', 'registration', 'contact-us', 'help', 'feedback', 'get_started_activities_experiences', 'profile-viewProfile', 'userprofile', 'activities_next_8_hours', 'privacy-policy', 'terms-condition', 'show_businessprofile']))
							

							<div class="top-search">
								<!-- <form method="get" action="/instant-hire"> -->
								<form method="get" action="/activities/">
									<input type="text" name="label" id="site_search" placeholder="Search by activity, business, person, username" autocomplete="off" value="">
									<div id="suggesstion-box"></div>
									<button id="serchbtn" ><i class="fa fa-search"></i></button>
								</form>
							</div>
							@endif
				
					
						<div class="header-right">
                        	  <?php /* @if(Session('StaffLogin'))
                            	<a href="{{ Config::get('constants.SITE_URL') }}/userlogout" class="btn btn-list-business mr-15 header-bottom-sp" style="color: white;">Logout </a>
							@endif  */?>
						
							<a href="{{route('businessClaim')}}" class="btn btn-list-business business-sp header-bottom-sp">List My Business</a>
							<div class="button"><span></span></div>

							

							<a value="Book an Activity" class="btn business-sp btn-style-two" href="{{route('activities_index')}}">Book An Activity</a>
							<div  class="cartitmclass mobile-none">
								<?php 
									$cart = [];
							        if (request()->session()->has('cart_item')) {
							            $cart = request()->session()->get('cart_item');
							        }
									$newcart['cart_item'] = [];
									if(isset($cart["cart_item"])){
									    foreach($cart["cart_item"] as $item){
									    	if($item['chk'] == ''){
									    		$newcart['cart_item'] [] = $item;
									    	}
									    }
									} 
									$total_quantity = count($newcart["cart_item"]);?>
								<a class="btn-cart" href="{{route('carts_index')}}">
									<img src="{{asset('images/shoping-cart-header-black.png')}}" alt="cart"><span id="cart-item">
									<!-- <img src="https://d2bgo0bc1t29nh.cloudfront.net/public/images/shoping-cart-header-black.png" alt="cart"><span id="cart-item"> -->
										{{$total_quantity}}</span>
								</a>
							</div>
							
							@php
							     if(session('StaffLogin') != '') {
								    $staff = App\BusinessStaff::find(session('StaffLogin'));
									$name = ucwords(@$staff->full_name);
								 }
							@endphp
							@if(Auth::check())
						 	<div class="userblock mobile-none">
                        		<div class="login_links" onclick="openNav()">
									@if(session('StaffLogin') != '') 
									<img src="{{ Storage::disk('s3')->exists($staff->profile_pic) ? Storage::URL($staff->profile_pic) : url('/images/user-icon-black.png') }}" alt="Fitnessity" >
                                	@else
									<img src="{{ Storage::disk('s3')->exists(Auth::user()->profile_pic) ? Storage::URL(Auth::user()->profile_pic) : url('/images/user-icon-black.png') }}" alt="Fitnessity" >
									@endif
                                </div>
								<nav class="pc-sidebar">
									<div class="navbar-wrapper">
										<div id="mySidepanel" class="sidepanel">
											<div class="navbar-content ps">
												<a href="javascript:void(0)" class="cancle fa fa-times" onclick="closeNav()"></a>
												<ul class="pc-navbar">
													<li style="text-align: center;"> 
														@if(session('StaffLogin') != '') 
														<img src="{{ Storage::disk('s3')->exists($staff->profile_pic) ? Storage::URL($staff->profile_pic) : url('/images/user-icon-black.png') }}" alt="Fitnessity"  class="sidemenupic">
														@else
														<img src="{{ Storage::disk('s3')->exists(Auth::user()->profile_pic) ? Storage::URL(Auth::user()->profile_pic) : url('/images/user-icon.png') }}" alt="Fitnessity" class="sidemenupic" >
														@endif
													</li>
													<li class="pc-caption"><span> Welcome olne</span></li>
                                                    <li class="pc-caption-1">
                                                        <span> 
															@if(session('StaffLogin') != '')
															{{$name}} 
															@else
															{{ Auth::user()->firstname }} 
															@endif
														</span>
                                                    </li>
                                                    <li class="lp-tag">
                                                        <span><?php echo "@"; ?>
															@if(session('StaffLogin') != '')
															{{$staff->first_name}}
															@else
															{{ Auth::user()->username }} 
															@endif
														</span>
                                                    </li>
                                                    <li class="lp-per-pro"> <span> Personal Profile </span> </li>
                                                    <li class="border-1">
                                                     <button class="btn-lp" type="button"><a style="color: white;" href="{{url('/activities')}}">Book An Activity</a> </button> 
                                                    </li>
                                                    <li class="pc-link">
                                                    	<span class="pc-micon"><i class="fa fa-user"></i></span>
                                                        <a href="{{route('profile-viewProfile')}}" style="color: white;">View Personal Profile</a>
                                                    </li>

                                                    <li class="pc-link">
														<span class="pc-micon"><img src="{{asset('/public/img/edit-2.png')}}" alt="Fitnessity"></span><a href="{{url('/personal/profile')}}" style="color: white;">Edit Profile & Password</a>
													</li>

													<li class="pc-link">
														<span class="pc-micon"><img src="{{asset('/public/img/menu-icon5.svg')}}" alt="Fitnessity"></span><a href="{{route('personal.manage-account.index')}}" style="color: white;">Manage Accounts</a>
													</li>

													<li class="pc-link">
														<span class="pc-micon"><img src="{{ url('public/img/menu-icon3.svg') }}" alt="Fitnessity"></span><a href="{{ url('/personal/calendar')}}" style="color: white;">Calendar</a>
													</li>

													<li class="pc-link">
														<span class="pc-micon"><img src="{{asset('/public/img/credit-card.png')}}" alt="Fitnessity"></span><a href="{{route('personal.credit-cards')}}" style="color: white;">Credit Card</a>
													</li>

													<li class="pc-link">
														<span class="pc-micon"><img src="{{asset('/public/img/favorite.png')}}" alt="Fitnessity"></span><a href="{{route('personal.favourite')}}" style="color: white;">Favorite</a>
													</li>
													<li class="pc-link">
														<span class="pc-micon"><img src="{{asset('/public/img/follower.png')}}" alt="Fitnessity"></span><a href="{{route('personal.followers')}}" style="color: white;">Followers</a>
													</li>
													<li class="pc-link">
														<span class="pc-micon"><img src="{{asset('/public/img/follower.png')}}" alt="Fitnessity"></span><a href="{{route('personal.following')}}" style="color: white;">Following</a>
													</li>
                                                
													<!-- <li class="pc-link">
                                                    	<span class="pc-micon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
															<a href="{{ Config::get('constants.SITE_URL') }}/booking-request" style="color: white;">Inbox</a>
                                                    </li> -->

													<li><div class="border-sidebar"></div></li>
													<li class="lp-per-pro"> <span>Business Center </span></li>
													<li class="pc-link"><span class="pc-micon"><i class="fas fa-clipboard-list"></i></span><a href="{{ Config::get('constants.SITE_URL') }}/claim-your-business" style="color: white;">Create A Business</a>
                                                    </li>

                                                    @if(count(Auth::user()->company) > 0)
	                                                    <li class="pc-link">
															<span class="pc-micon"><i class="fa fa-tasks"></i></span><a href="{{route('business_dashboard')}}"  style="color: white;">Manage My Business</a>
														</li>

														@if(!Session('StaffLogin'))
															<li class="pc-link">
																<span class="pc-micon"><i class="fa fa-tasks"></i></span><a href="{{route('staff_login')}}"  style="color: white;">Staff Login</a>
															</li>
														@endif
													@endif
                                                  
													<li><div class="border-sidebar"></div></li>
													<li class="lp-per-pro"> <span>Support </span> </li>
													<li class="pc-link">
                                                    	<span class="pc-micon"><i class="fas fa-comments"></i></span>
                                                        <a href="{{ Config::get('constants.SITE_URL') }}/feedback" style="color: white;">Give Feedback<br><p class="help-us-side">(Help us improve)<p></a>
                                                    </li>	
                                                    <li class="pc-link">
                                                    	<span class="pc-micon"><i class="fas fa-question-circle"></i></span>
                                                        <a href="{{route('help')}}" style="color: white;">Help Desk</a>
                                                    </li>
                                                    <li><div class="border-sidebar"></div></li>
                                                    <li class="pc-link">
                                                    	<span class="pc-micon"><i class="fa fa-right-from-bracket"></i></span>
                                                        <a href="{{ Config::get('constants.SITE_URL') }}/userlogout" style="color: white;">Logout </a>
                                                    </li>
												</ul>
											</div>
											<p class="pri-1"> <a href="{{ Config::get('constants.SITE_URL') }}/privacy-policy" style="color: white;"> Privacy </a> - <a href="{{ Config::get('constants.SITE_URL') }}/terms-condition" style="color: white;">Terms </a></p>
											<p class="pri-2">Fitnessity, Inc {{date('Y')}}</p>
										</div>
									</div>
								</nav>
							</div>
							@else
							<!-- old nav -->
                         	<div class="userblock">
                        		<div class="login_links">
									<img class="sign-in-header" src="{{ asset('/public/images/login-header-black.png') }}" alt="cart">
									<a href="{{ Config::get('constants.SITE_URL') }}/userlogin">Sign in or </a> 
									<a href="{{ Config::get('constants.SITE_URL') }}/registration"> Register </a>
								</div>
                           		<div class="dropdown_login">
                                    <ul>
                                        @if(Auth::user())
                                            <li><a href="#">Welcome {{ Auth::user()->firstname }}</a></li>
                                            <li><a href="{{route('profile-viewProfile')}}">Profile</a></li>
                                            <li><a href="{{route('user-profile')}}">Edit Profile</a></li>
                                            <li><a href="{{route('business-welcome')}}">Create Business</a></li>
                                            <li><a href="{{route('manageCompany')}}">Manage Business</a></li>
                                            <li><a href="{{ Config::get('constants.SITE_URL') }}/userlogout">Logout</a></li>
                                        @endif
                                    </ul>
                            	</div>
                        	</div>
                        	@endif
                    	</div>
					</div>
				</div>
					</div>
				</div>
			</div>
		</header>

        <section id="content">
            <section class="vbox">
                <section class="scrollable padder">
                    @yield('content')
                </section>
            </section>
        </section>
		
        <!-- forgot password modal -->
        <div class="modal fade" id="password_modal" role="dialog">
			<div class="modal-dialog modal-lg">
				<div class="modal-content" id="password_modal_content"></div>
			</div>
		</div>
		<!-- {{-- customers start --}} -->
			<div class="modal fade" id="CustomerModal" tabindex="-1" aria-labelledby="CustomerModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="CustomerModalLabel">Create a New Customer</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						<form id="customerForm" method="post">	
								@csrf
								<div class="mb-3">
									<label for="firstName" class="form-label">First Name</label>
									<input type="text" class="form-control" id="firstName" name="firstname">
									<span class="text-danger error-message" id="firstnameError"></span>

								</div>
								<div class="mb-3">
									<label for="lastName" class="form-label">Last Name</label>
									<input type="text" class="form-control" id="lastName" name="lastname">
									<span class="text-danger error-message" id="lastNameError"></span>

								</div>
								<div class="mb-3">
									<label for="email" class="form-label">Email</label>
									<input type="email" class="form-control" id="emailid" name="email">
									<span class="text-danger error-message" id="emailError"></span>
								</div>
								<div class="mb-3">
									<label for="phone" class="form-label">Phone Number</label>
									<input type="text" name="contact" id="contact" size="30" maxlength="14" autocomplete="off" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone" class="form-control">
									<span class="text-danger error-message" id="contactError"></span>
								</div>
								{{-- <div class="mb-3">
									<label for="password" class="form-label">Password</label>
									<input type="password" class="form-control" id="password" name="password">
									<span class="text-danger error-message" id="passwordError"></span>

								</div>
								<div class="mb-3">
									<label for="confirmPassword" class="form-label">Confirm Password</label>
									<input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
									<span class="text-danger error-message" id="confirmPasswordError"></span>
								</div> --}}
								<div id="responseMessage" class="alert" style="display: none;"></div>

								<div class="float-right">
									<button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Cancel</button>
									<button type="submit" form="customerForm" class="btn btn-primary">Create</button>
								</div>
								
							</form>
						</div>
					</div>
				</div>
			</div>
		<!-- {{-- customers end --}} -->

    </body>
</html>
<script>
    $(document).ready(function () {
        $('#customerForm').on('submit', function (e) {
            e.preventDefault(); // Prevent the default form submission
            let isValid = true;

            // Clear previous error messages
            $('.error-message').text('');

            // Validate First Name
            const firstName = $('#firstName').val().trim();
            if (firstName === '') {
                $('#firstnameError').text('First name is required.');
                isValid = false;
            }

            // Validate Last Name
            const lastName = $('#lastName').val().trim();
            if (lastName === '') {
                $('#lastNameError').text('Last name is required.');
                isValid = false;
            }

            // Validate Email
            const email = $('#emailid').val();
			// alert(email);
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
			// alert(email);
            if (email === '') {
                $('#emailError').text('Email is required.');
                isValid = false;
            } else if (!emailPattern.test(email)) {
                $('#emailError').text('Please enter a valid email address.');
                isValid = false;
            }

            // Validate Phone Number
            const contact = $('#contact').val().trim();
            const phonePattern = /^[0-9]{10,14}$/;
            if (contact === '') {
                $('#contactError').text('Phone number is required.');
                isValid = false;
            } 
			// else if (!phonePattern.test(contact)) {
            //     $('#contactError').text('Please enter a valid phone number.');
            //     isValid = false;
            // }

            // Validate Password
            // const password = $('#password').val();
            // if (password === '') {
            //     $('#passwordError').text('Password is required.');
            //     isValid = false;
            // }

            // // Validate Confirm Password
            // const confirmPassword = $('#confirmPassword').val();
            // if (confirmPassword === '') {
            //     $('#confirmPasswordError').text('Please confirm your password.');
            //     isValid = false;
            // } else if (password !== confirmPassword) {
            //     $('#confirmPasswordError').text('Passwords do not match.');
            //     isValid = false;
            // }
            if (isValid) {
				$.ajax({
						url: "{{ route('customer_create') }}",
						type: 'POST',
						data: $(this).serialize(),
						headers: {
							'X-CSRF-TOKEN': '{{ csrf_token() }}'
						},
						success: function(data) {
							const messageDiv = $('#responseMessage');
							messageDiv.removeClass('alert-success alert-danger alert-warning');
							if (data.type === "success") {
								messageDiv.removeClass('alert-danger').addClass('alert-success').text(data.msg).show();
								// $('#CustomerModal').modal('hide'); 
								$('#customerForm')[0].reset(); 
							} 
							else if (data.type === "danger") {
								messageDiv.addClass('alert alert-danger').text(data.msg).show();	
							}
							else {
									messageDiv.addClass('alert alert-warning').text("An unexpected response was received.").show();
								}
						},
						error: function(xhr, status, error) {
							console.error('Error:', error);
							alert("An unexpected error occurred.");
						}
					});
            }
        });
    });
</script>


<!-- <script>
$(document).ready(function() {
    $('#customerForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission
        
        // Clear any previous error messages
        $('.error-message').remove();
        
        $.ajax({
            url: "{{ route('customer_create') }}",
            type: 'POST',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(data) {
                if (data.success) {
                    alert("Customer created successfully!");
                    $('#CustomerModal').modal('hide'); 
                    $('#customerForm')[0].reset(); // Reset the form on success
                } else {
                    // Display error messages
                    if (data.errors) {
                        data.errors.forEach(function(error) {
                            const fieldName = error.field; // Assuming the server returns field-specific error info
                            const errorSpan = $(`#${fieldName}Error`);
                            if (errorSpan.length) {
                                errorSpan.text(error.message).addClass('text-danger error-message');
                            }
                        });
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert("An unexpected error occurred.");
            }
        });
    });
});
</script> -->


<script>
	
$(document).ready(function () {
	
	$.ajaxSetup({
		xhrFields: {
		   withCredentials: true
		},
	});
	
	var BASE_URL='{{ url("/") }}/';		
    $('.myfilter2').click(function () {
		var values = {};
		var GetData = {};
		var serviceType = new SlimSelect({
            select: '#providerservices'
        });
		GetData['service_type'] = serviceType.selected();
		
		var servicetypetwo = new SlimSelect({
            select: '#servicetypetwo'
        });
		GetData['service_typetwo'] = servicetypetwo.selected();
		
		var programType = new SlimSelect({
            select: '#programservices'
        });
		GetData['program_type'] = programType.selected();
	
		var activityLocation = new SlimSelect({
			select: '#activity_location'
        });
		GetData['activity_location'] = activityLocation.selected();
		
		GetData['location'] = $('#pac-input').val();
		
		var activity_Member = new SlimSelect({
			select: '#activity_Member'
        });
		GetData['activity_Member'] = activity_Member.selected();
		
		var activityType = new SlimSelect({
            select: '#activity_type'
        });
		GetData['activity_type'] = activityType.selected();
		
		var ageRange = new SlimSelect({
            select: '#age_range'
        });
		GetData['age_range'] = ageRange.selected();
		
		var frmCnumberofpeople = new SlimSelect({
            select: '#frm_cnumberofpeople'
        });
		GetData['cnumber_people'] = frmCnumberofpeople.selected();
		
		var getDuration = new SlimSelect({
            select: '#duration'
        });
		GetData['duration'] = getDuration.selected();
		
		var difficultylevel = new SlimSelect({
            select: '#difficultylevel'
        });
		GetData['difficulty_level'] = difficultylevel.selected();
	
		var activityExp = new SlimSelect({
            select: '#activity_exp'
        });
		GetData['activity_exp'] = activityExp.selected();
		
		var personalityHabit = new SlimSelect({
            select: '#personality_habit'
        });
		GetData['personality_habit'] = personalityHabit.selected();
		console.log(GetData);
		url = '/samfilter';
        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}',
            },
            data: {
                "_token": '{{csrf_token()}}',
                data: GetData
            },
            success: function (response) {
                console.log(response);
                $('.direc-right div#buisnessuser').empty();
                $('.direc-right div#buisnessuser').html(response);
            }
        });
		
    });
    
    $('.myfilter').change(function () {
		return false;
        var form = $("form#frmsearchCategory").serialize();
		//console.log(form);
		//return false;
        url = '/samfilter';
        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}',
            },
            data: {
                "_token": '{{csrf_token()}}',
                data: form
            },
            success: function (response) {
                $('.direc-right div#buisnessuser').empty();
                $('.direc-right div#buisnessuser').html(response);
            }
        });
    });
	
	// For sire searchng prfile with ajax
	$('body').on('keyup','#label',function() { console.log("dddd");
		var _Url = BASE_URL + 'instant-hire-search';
		$("#search-business").show();
	    $.ajax({
	    	type: "get",
			url: _Url,
			data: 'keyword='+$(this).val(),
	        dataType: 'JSON',
	        cache: false,
			beforeSend: function(){
				$("#label").css("background",'#F3F6F9; url("/public/images/LoaderIcon.gif") no-repeat 165px');
			},
			success: function(data){
				console.log(data);
	            $('#search-business').html('');
	            if(data == 'No'){	
				}else{
					var items = [];
					$.each(data, function(i, item) {
						let itemProgram = item;
						items.push("<li class='setLabelSearch' get-data='" +JSON.stringify(item).replace(/[\/\(\)\']/g, "&apos;")+"'>" + itemProgram + " - " +i+ "</li>");
					});
					$('#search-business').append('<ul class="equipment-list">'+items.join('')+'</ul>');
	                $("#label").css("background","#F3F6F9;");
				}
			}
		});
	});
	$('body').on('click', '.setLabelSearch', function(e) {
		var getObject = JSON.parse($(this).attr('get-data'));
		$('#label').val(getObject);
		$('#search-business').html('');
	});
});

function openLoginModal(modalname) {
    if (modalname == 'login') {
        $("#register_modal").modal('hide');
        $("#password_modal").modal('hide');
    } else if (modalname == 'register') {
        $("#login_modal").modal('hide');
        $("#password_modal").modal('hide');
    } else if (modalname == 'password') {
		$("#password_modal").modal('show');
        $("#login_modal").modal('hide');
        $("#register_modal").modal('hide');
    } else if (modalname == 'learnmore') {
        $("#login_modal").modal('hide');
        $("#register_modal").modal('hide');
    } else if (modalname == 'terms_condition') {
        $("#terms_modal").modal('show');
    } else if (modalname == 'sport-alert') {
        $("#login_modal").modal('hide');
    }
}

function openNav() {
	document.getElementById("mySidepanel").style.width = "300px";
}

function closeNav() {
	document.getElementById("mySidepanel").style.width = "0";
}

</script>

<!-- <link href='https://d2bgo0bc1t29nh.cloudfront.net/public/css/frontend/jquery-ui.css'  rel='stylesheet'>
<script src='https://d2bgo0bc1t29nh.cloudfront.net/public/dashboard-design/js/jquery-ui.min.js'></script> -->
<link href="{{url('public/css/frontend/jquery-ui.css')}}"  rel='stylesheet'>
<script src="{{url('public/dashboard-design/js/jquery-ui.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function () { 
	$( ".birthdate" ).datepicker();
});
</script>
<script>
	$(document).on('click', '#serchbtn', function() {
		var searchval = $('#site_search').val();
		if(searchval==''){ $('#site_search').focus(); return false; }
	});
	$(document).ready(function() {
		$("#site_search").keyup(function() {
			// var _token = $('input[name="_token"]').val();
			var _token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
			/*alert(_token);*/
			$.ajax({
				type: "POST",
				url: "/searchaction",
				data: {
					query: $(this).val(),
					_token: _token
				},
				beforeSend: function() {
					//$("#label").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
				},
				success: function(data) {
					$("#suggesstion-box").show();
					$("#suggesstion-box").html(data);
					$("#site_search").css("background", "#FFF");
				}
			});
		});
	});
	function selectSearch(val) {
		jQuery("#suggesstion-box").hide();
		window.location.href = val;
	}
</script>

@stack('scripts')
