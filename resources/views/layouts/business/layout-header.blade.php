<?php
use App\User;
$total_quantity = 0;
?>

<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <title>Fitnessity</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta content="charset=utf-8">
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
        <link rel="shortcut icon" href="{{ url('/public/images/email/favicon.ico') }}">
        <link rel="icon" href="{{ url('/public/images/email/favicon.ico') }}">
        <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,700,900'>
        <link rel='stylesheet' type='text/css'href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300'>
        <link rel='stylesheet' type='text/css' href="{{url('/public/css/font-awesome.css')}}"> 
        <link rel="stylesheet" type="text/css" href="{{env('APP_URL')}}<?php echo Config::get('constants.FRONT_CSS'); ?>all.css">
        <link rel='stylesheet' type='text/css' href="{{env('APP_URL')}}<?php echo Config::get('constants.FRONT_CSS'); ?>owl.css">
		
		@if(Route::current()->getName() == 'design.home' ) 
			<link href="{{asset('/public/dashboard-design/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
		@endif
		
		@if(Route::current()->getName() != 'design.dashboard' && Route::current()->getName() != 'design.createNewBusinessProfile' && Route::current()->getName() != 'design.home') 
			<!--<link href="{{asset('/public/dashboard-design/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" /> -->
			<link rel='stylesheet' type='text/css' href="{{env('APP_URL')}}<?php echo Config::get('constants.FRONT_CSS'); ?>bootstrap.css"> 

       		<link rel='stylesheet' type='text/css' href="{{env('APP_URL')}}<?php echo Config::get('constants.FRONT_CSS'); ?>frontend/general.css">
			
			<link rel='stylesheet' type='text/css' href="{{env('APP_URL')}}<?php echo Config::get('constants.FRONT_CSS'); ?>frontend/custom.css">
       	@endif
        <link rel='stylesheet' type='text/css' href="{{env('APP_URL')}}<?php echo Config::get('constants.FRONT_CSS'); ?>bootstrap-select.min.css">
		<link rel='stylesheet' type='text/css' href="{{env('APP_URL')}}<?php echo Config::get('constants.FRONT_CSS'); ?>frontend/header-footer.css">
        
        <link rel='stylesheet' type='text/css' href="{{env('APP_URL')}}<?php echo Config::get('constants.FRONT_CSS'); ?>responsive.css">
		<link rel="stylesheet" href="/public/AdminLTE/plugins/datatables/dataTables.bootstrap.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="{{env('APP_URL')}}/public/js/ratings.js"></script>

		<link rel='stylesheet' type='text/css' href="{{asset('/public/dashboard-design/css/style.css')}}">
		<script src="{{asset('/public/dashboard-design/js/plugins.js')}}"></script>

		@if(Route::current()->getName() == 'design.shopping_cart' || Route::current()->getName() == 'carts_index') 
			<link rel='stylesheet' type='text/css' href="{{asset('/public/dashboard-design/css/custom.css')}}">
			<link rel='stylesheet' type='text/css' href="{{asset('/public/dashboard-design/css/responsive.css')}}">
			<link rel='stylesheet' type='text/css' href="{{asset('/public/dashboard-design/css/bootstrap.min.css')}}">
			<script src="{{asset('public/dashboard-design/js/bootstrap.bundle.min.js')}}"></script>
		@endif
		

        <style>

		/*
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
        <header>
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="menu_nav">
                
						<div class="logo-header">
						<a href="{{ Config::get('constants.SITE_URL') }}/" class="logo"> <img src="{{ asset('/public/images/fitnessity_logo1_black.png') }}"> </a>
						</div>
					
						<div class="top-area">
                    <?php /*if( !request()->is('/') ) {*/ ?>
                        <div class="top-search">
                            <!-- <form method="get" action="/instant-hire"> -->
                            <form method="get" action="/activities/">
                                <input type="text" name="label" id="site_search" placeholder="Search by activity, business, person, username" autocomplete="off" value="">
                                <div id="suggesstion-box"></div>
                                <button id="serchbtn" ><i class="fa fa-search"></i></button>
                            </form>
						</div>
					<?php /*}*/ ?>
                        <?php /*?>
						<ul class="setting-area">
                            <li><a href="{{ url('') }}" title="Home" data-ripple=""><i class="fa fa-home"></i></a></li>
                            <li>
                                <a href="" title="Friend Requests" data-ripple="">
                                    <i class="fa fa-user"></i><em class="bg-red">5</em>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="Notification" data-ripple="">
                                    <i class="fa fa-bell"></i><em class="bg-purple">7</em>
                                </a>					
                            </li>
                            <li>
                                <a href="#" title="Messages" data-ripple="">
                                <i class="commentdots fas fa-comment"></i><em class="bg-blue">9</em></a>
                            </li><?php */?>
                            <!--<li><a href="#" title="Languages" data-ripple=""><i class="fa fa-globe"></i><em>EN</em></a></li>-->
                            <?php /*?><li><a href="{{route('help')}}" title="Help" data-ripple=""><i class="fa fa-question-circle"></i></a></li>
                        </ul> <?php */?>
             		       <?php /*?><nav id='cssmenu'>
                        <form id="searchform" method="" action="{{url('/instant-hire')}}">
                           <div class="row" style="position: relative;">

									<input autocomplete="off" type="text" name="label" id="label" class="form-control" placeholder="Search by activity or bussiness name or profile"  style="width:300px; float:left; border-radius: 0; margin:0; background-color:#555; color:#fff; border:0">
									<input type="submit" value="Search" class="btn-style-one" style="padding:12px!important">
									<div id="search-business"></div>
								
                           </div>
                        </form>
                    </nav><?php */?>
					
						<div class="header-right">
                           <?php /* @if(Session('StaffLogin'))
                            	<a href="{{ Config::get('constants.SITE_URL') }}/userlogout" class="btn btn-list-business mr-15 header-bottom-sp"  style="color: white;">Logout </a>
							@elseif(Auth::check() == '0')
								<a  class="btn btn-list-business mr-15 header-bottom-sp" href="{{route('staff_login')}}">Staff Login</a>
							@endif  */?>
							<a href="{{route('businessClaim')}}" class="btn btn-list-business business-sp header-bottom-sp">List My Business</a>
							<div class="button"><span></span></div>

							<a value="Book an Activity" class="btn business-sp btn-style-two" href="{{route('activities_index')}}">Book An Activity</a>
							<div  class="cartitmclass mobile-none">
								<?php 
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
								<img src="{{ asset('/public/images/shoping-cart-header-black.png') }}" alt="cart"><span id="cart-item">
									 {{$total_quantity}}</span>
                                <!--<img src="{{ asset('/public/images/cart-icon.png') }}" alt="cart"><span id="cart-item">0</span>-->
                            </a>
							</div>
							
                        	@if(Auth::check())
						 	<div class="userblock mobile-none">
                        		<div class="login_links" onclick="openNav()">
                                	<img src="{{ Storage::disk('s3')->exists(Auth::user()->profile_pic) ? Storage::URL(Auth::user()->profile_pic) : url('/images/user-icon.png') }}"
                                     alt="Fitnessity" >
                                </div>
								<nav class="pc-sidebar">
									<div class="navbar-wrapper">
										<div id="mySidepanel" class="sidepanel">
											<div class="navbar-content ps">
												<a href="javascript:void(0)" class="cancle fa fa-times" onclick="closeNav()"></a>
												<ul class="pc-navbar">
													<li style="text-align: center;"> 
                                                        <img src="{{ Storage::disk('s3')->exists(Auth::user()->profile_pic) ? Storage::URL(Auth::user()->profile_pic) : url('/images/user-icon.png') }}" class="sidemenupic" alt="Fitnessity">
													</li>
													<li class="pc-caption"><span> Welcome</span></li>
                                                    <li class="pc-caption-1">
                                                        <span> {{ Auth::user()->firstname }} </span>
                                                    </li>
                                                    <li class="lp-tag">
                                                        <span><?php echo "@"; ?>{{ Auth::user()->username }} </span>
                                                    </li>
                                                    <li class="lp-per-pro"> <span> Personal Profile </span> </li>
                                                    <li class="border-1">
                                                     <button class="btn-lp" type="button"><a style="color: white;" href="{{url('/activities')}}">Book An Activity </a> </button> 
                                                    </li>
                                                    <li class="pc-link">
                                                    	<span class="pc-micon"><i class="fa fa-user"></i></span>
                                                        <a href="{{route('profile-viewProfile')}}" style="color: white;">View Personal Profile</a>
                                                    </li>
                                                   <?php /*?> <li class="pc-link">
                                                    	<span class="pc-micon"><i class="fa fa-user"></i></span>
                                                      	<a href="{{route('profile-viewbusinessProfile')}}" style="color: white;">Business Profile</a>
                                                    </li><?php */?>
                                                    <li class="pc-link">
                                                    	<span class="pc-micon"><i class="fas fa-cog"></i></span><a href="{{route('user-profile')}}" style="color: white;">Manage Personal Profile</a>
                                                    </li>
													<!-- <li class="pc-link">
                                                    	<span class="pc-micon"><i class="fas fa-calendar-alt"></i></span><a href="{{ Config::get('constants.SITE_URL') }}/personal-profile/calendar" style="color: white;">Calender</a>
                                                    </li> -->
													<li class="pc-link">
                                                    	<span class="pc-micon"><i class="fas fa-users"></i></span><a href="{{route('family-member.index')}}" style="color: white;">Manage Accounts</a>
                                                    </li>
													<!-- <li class="pc-link">
                                                    	<span class="pc-micon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
															<a href="{{ Config::get('constants.SITE_URL') }}/booking-request" style="color: white;">Inbox</a>
                                                    </li> -->

                                                   <!--  <li class="pc-link">
                                                    	<span class="pc-micon"><i class="fas fa-file-alt"></i></span>
															<a href="{{ route('personal.orders.index')}}" style="color: white;">Booking Info</a>
                                                    </li> -->
													<!-- <li class="pc-link">
                                                    	<span class="pc-micon"><i class="fas fa-user-plus"></i></span><a href="#" style="color: white;">Invite Friends</a>
                                                    </li> -->
													
													<li><div class="border-sidebar"></div></li>
													<li class="lp-per-pro"> <span>Business Center </span></li>
													<li class="pc-link">
                                                    	<span class="pc-micon"><i class="fas fa-clipboard-list"></i></span>
                                                        <a href="{{ Config::get('constants.SITE_URL') }}/claim-your-business" style="color: white;">Create A Business</a>
                                                    </li>
                                                    <li class="pc-link">
                                                    	<span class="pc-micon"><i class="fa fa-tasks"></i></span>
                                                    	<!-- <a href="{{route('manageCompany')}}" style="color: white;">Manage My Business</a> -->
                                                    	<a @if(count(Auth::user()->company) > 0) href="{{route('business_dashboard')}}"  @else href="{{route('staff_login')}}" @endif style="color: white;">Staff Login</a>
                                                    </li>
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
                                                    <!-- <li class="pc-link">
                                                    	<span class="pc-micon"><i class="fa fa-user-plus"></i></span>
                                                        <a href="#" style="color: white;">Invite Friends</a>
                                                    </li> -->
                                                    <li><div class="border-sidebar"></div></li>
                                                    <li class="pc-link">
                                                    	<span class="pc-micon"><i class="fa fa-right-from-bracket"></i></span>
                                                        <a href="{{ Config::get('constants.SITE_URL') }}/userlogout" style="color: white;">Logout </a>
                                                    </li>
												</ul>
											</div>
											<p class="pri-1"> <a href="{{ Config::get('constants.SITE_URL') }}/privacy-policy" style="color: white;"> Privacy </a> - <a href="{{ Config::get('constants.SITE_URL') }}/terms-condition" style="color: white;">Terms </a></p>
											<p class="pri-2">Fitnessity, Inc 2021</p>
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
									<!--<img src="{{ asset('/public/images/user-icon.png') }}" alt="">-->
								</div>
                           		<div class="dropdown_login">
                                	<!--<svg focusable="false" class="icon--nav-triangle-borderless" viewBox="0 0 20 9" role="presentation">
                                		<path d="M.47108938 9c.2694725-.26871321.57077721-.56867841.90388257-.89986354C3.12384116 6.36134886 5.74788116 3.76338565 9.2467995.30653888c.4145057-.4095171 1.0844277-.40860098 1.4977971.00205122L19.4935156 9H.47108938z" fill="#ffffff"></path>
                                	</svg>-->
                                    <ul>
                                        @if(Auth::user())
                                            <li><a href="#">Welcome {{ Auth::user()->firstname }}</a></li>
                                            <li><a href="{{route('profile-viewProfile')}}">Profile</a></li>
                                            <li><a href="{{route('user-profile')}}">Edit Profile</a></li>
                                            <li><a href="{{route('business-welcome')}}">Create Business</a></li>
                                            <li><a href="{{route('manageCompany')}}">Manage Business</a></li>
                                            <li><a href="{{ Config::get('constants.SITE_URL') }}/userlogout">Logout</a></li>
                                        @else
                                            <!--<li><a href="{{ Config::get('constants.SITE_URL') }}/userlogin">Login</a></li>
                                            <li><a href="{{ Config::get('constants.SITE_URL') }}/registration">Register</a></li>-->
                                        @endif
                                    </ul>
                            	</div>
                        	</div>

                        	@endif
                            
							<script>
                                //$("#cart-item").html('<?=$total_quantity?>');
                            </script>
                    	</div>
					
                        <!--<div class="user-img">
                            <h5>Jack Carter</h5>
                            <img src="/images/newimage/nearly1.jpg" alt="">
                            <span class="status f-online"></span>
                            <!--<div class="user-setting">
                                <span class="seting-title">Chat setting <a href="#" title="">see all</a></span>
                                <ul class="chat-setting">
                                    <li><a href="#" title=""><span class="status f-online"></span>online</a></li>
                                    <li><a href="#" title=""><span class="status f-away"></span>away</a></li>
                                    <li><a href="#" title=""><span class="status f-off"></span>offline</a></li>
                                </ul>
                                <span class="seting-title">User setting <a href="#" title="">see all</a></span>
                                <ul class="log-out">
                                    <li><a href="profile.html" title=""><i class="ti-user"></i> view profile</a></li>
                                    <li><a href="settings.html" title=""><i class="ti-pencil-alt"></i>edit profile</a></li>
                                    <li><a href="#" title=""><i class="ti-target"></i>activity log</a></li>
                                    <li><a href="settings.html" title=""><i class="ti-settings"></i>account setting</a></li>
                                    <li><a href="index.html" title=""><i class="ti-power-off"></i>log out</a></li>
                                </ul>
                                </div>
                            </div>-->
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
        
    </body>
</html>


<script>
	
$(document).ready(function () {
	
	$.ajaxSetup({
		xhrFields: {
		   withCredentials: true
		},
	});
	
	var BASE_URL='{{ url("/") }}/';		
    //$(document).on('change','.myfilter', function () {
    $('.myfilter2').click(function () {
        //$('.myfilter').trigger('change');
		var values = {};
		//$.each($("form#frmsearchCategory").serializeArray(), function (i, field) {
		//	values[field.name] = field.value;
		//});
		//console.log(values);
		//var selectedValues = $('#providerservices').val();
		//console.log(selectedValues);
		
		//text_array = selected_buttons.selected('text')
		//value_array = selected_buttons.selected()
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
		
		/*var professionalType = new SlimSelect({
            select: '#professional_type'
        });
		GetData['professional_type'] = professionalType.selected();*/
		
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
		
		/*var genderpreference = new SlimSelect({
            select: '#genderpreference'
        });
		GetData['gender'] = genderpreference.selected();*/
		
		/*var getLanguage = new SlimSelect({
            select: '#categ'
        });
		GetData['language'] = getLanguage.selected();*/
		
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
					//$('#label').val('').css("background","#FFF").attr("placeholder", "No results found");			
				}else{
					var items = [];
					$.each(data, function(i, item) {
						//console.log(item);
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
        // $("#learnmore_modal").modal('hide');
        // $("#communitylearnmore_modal").modal("hide");
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

<link href='{{asset("/public/css/frontend/jquery-ui.css")}}'  rel='stylesheet'>
<!-- <link href=
'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'  rel='stylesheet'> -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ></script>
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
