<?php
$total_quantity = 0;
if(isset($cart["cart_item"])){
    foreach($cart["cart_item"] as $item){
        $total_quantity += (int)$item["quantity"];
    }
}
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
        <?php /*?><link rel='stylesheet' type='text/css' href="<?php echo Config::get('constants.FRONT_CSS'); ?>font-awesome.css"><?php */?>
        <link rel="stylesheet" type="text/css" href="<?php echo Config::get('constants.FRONT_CSS'); ?>all.css">
        <link rel='stylesheet' type='text/css' href="<?php echo Config::get('constants.FRONT_CSS'); ?>owl.css">
        <link rel='stylesheet' type='text/css' href="<?php echo Config::get('constants.FRONT_CSS'); ?>bootstrap.css">
        <link rel='stylesheet' type='text/css' href="<?php echo Config::get('constants.FRONT_CSS'); ?>bootstrap-select.min.css">
        <link rel='stylesheet' type='text/css' href="<?php echo Config::get('constants.FRONT_CSS'); ?>frontend/general.css">
        <link rel='stylesheet' type='text/css' href="<?php echo Config::get('constants.FRONT_CSS'); ?>frontend/custom.css">
        <link rel='stylesheet' type='text/css' href="<?php echo Config::get('constants.FRONT_CSS'); ?>responsive.css">
        <script src="<?php echo Config::get('constants.FRONT_JS'); ?>jquery.1.11.1.min.js"></script>
        <style>
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
            }
			#equipment-list{
			  left: 0;
			  top: 30px;
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
			.pc-sidebar {
				background: rgb(47 47 47);
				box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
			   /* width: 298px;*/
				/*position: fixed;*/
				top: 72px;
				bottom: 0;
				z-index: 1026;
			}
			.pc-sidebar .navbar-content {
				position: relative;
				/*height: calc(100vh - 70px);*/
			}
			.ps {
				overflow: hidden !important;
				overflow-anchor: none;
				touch-action: auto;
			}
			.pc-sidebar ul {
				list-style: none;
				padding-left: 0;
				margin-bottom: 0;
			}
			.profile-img{			
			}
			.text-lp{
				color: white;
				/*padding: 15px 15px 15px 15px;*/
			}
			.pc-sidebar .pc-caption {
				color: white;
				display: block;
				padding: 5px 28px 0px;
				text-align: center;
				font-size: 15px;
			}
			.pc-sidebar .pc-caption-1 {
				color: white;
				display: block;
				text-align: center;
				font-size: 18px;
			}
			.lp-tag{
				color: white;
				display: block;
				padding: 0px 28px 0px;
				font-size: 14px;
				text-align: center;
				margin-bottom: 10px;			
			}
			.lp-per-pro{
				color: white;
				display: block;
				padding: 0px 28px 5px;
				font-size: 16px;
				text-align: center;
			}
			.btn-lp{
				background: #f91942;
				color: white;
				padding: 7px 25px 7px 25px;
				border-radius: 7px;
				margin-top: 0px;
				margin-bottom: 15px;
				border: 1px solid #f91942;
			}
			.pc-navbar .btn-lp:hover{
				background: #000;
				color: white;
				padding: 7px 25px 7px 25px;
				border-radius: 7px;
				margin-top: 0px;
				margin-bottom: 15px;
				border: 1px solid #000;
			}
			.border-1{
				border-bottom: 1.5px solid #c9c9c9;
				padding: 0px;
				text-align: center;
				margin-bottom: 7px;
			}
			.pc-sidebar .pc-link {
				display: block;
				padding: 5px 30px;
				color: white;
				font-size: 15px;
				font-weight: 400;
				text-align: left;
			}
			.pc-micon{
				margin-right: 15px;
			}
			.pri-1{
				color: white;
				text-align: center;
				margin-top: 12px;
				font-size: 10px;
			}
			.pri-2{
				 color: white;
				text-align: center;
				font-size: 10px;			
			}
			.cancle{
				color: white;
				padding: 15px;
			}
			.sidepanel  {
			  width: 0;
			  position: fixed;
			  z-index: 9;
			  height: 100%;
			  top: 0;
			  /*left: 78%;*/
			  right: 0;
			  background-color: #2f2f2f;
			  overflow-x: hidden;
			  transition: 0.5s;
			  padding-top: 60px;
			}
			.openbtn {
				font-size: 20px;
				cursor: pointer;
				background-color: #111;
				color: white;
				padding: 10px 15px;
				border: none;
			}
			.top-search {
			  float: left;
			  margin-top: 0px;
			  text-align: left;
			  width: 32%;
			}
			.top-search form {
			  display: inline-block;
			  position: relative;
			  width: 100%;
			}
			.top-search button {
			  background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
			  color: #f91942;
			  font-size: 15px;
			  position: absolute;
			  left: 6px;
			  top: 47%;
			  transform: translateY(-50%);
			  padding: 9px;
			  border: none;
			}
			.top-search form input {
			  background: white;
			  border: medium none;
			  font-size: 13px;
			  padding: 8px 40px;
			  width: 100%;
			  color: #2e2e2e;
				border-radius: 5px;
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
			
			.logo {width: 100%;}
			.top-area {
			  display: contents;
			  text-align: right;
			  vertical-align: middle;
			  width: 84%;
			}
			.top-area > ul {
			  display: inline-block;
			  float: left;
			  line-height: 64px;
			  list-style: outside none none;
			  margin-bottom: 0;
			  padding-left: 10px;
			  vertical-align: middle;
			}
			.top-area > ul > li {
			  display: inline-block;
			  position: relative;
			  vertical-align: top;
			  z-index: 2;
			}
			.top-area > ul > li > a {
			  color: #b9b9b9;
			  font-size: 18px;
			  position: relative;
			  display: inline-block;
			  width: 50px;
			  text-align: center;
			  transition: all 0.2s linear 0s;
			  vertical-align: middle;
			}
			.top-area > ul > li > a::before {
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
			.top-area > ul > li > a > em {
			  border-radius: 100%;
			  color: #fff;
			  font-size: 10px;
			  height: 17px;
			  line-height: 17px;
			  position: absolute;
			  right: 6px;
			  text-align: center;
			  top: 10px;
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
			.top-area .user-img > span.status { bottom: 10px;right: 5px; }
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
			
			@media screen and (max-width: 400px){
				.top-search { width: 100%; }
			}
			@media screen and (min-width: 401px) and (max-width: 767px){
				.top-search { width: 100%; }
			}
			@media screen and (min-width: 768px) and (max-width: 992px){
				.top-search { width: 73%; }
			}
			@media screen and (min-width: 1920px) and (max-width: 2500px){
			}
</style>
</head>

    <body>
        <?php 
        $companyid = (isset($companyid) && $companyid != "") ? $companyid : 0;
        $module = explode(".co/", url()->current());?>
        <header>
            <div class="col-lg-12">
        		<div class="menu_nav">
					<div class="logo-header">
                    	<a href="{{ Config::get('constants.SITE_URL') }}/" class="logo"> <img src="{{ asset('/public/images/fitnessity_logo.png') }}"> </a>
					</div>
					<div class="top-area">
                        <div class="top-search">
                            <form method="post">
                                <input type="text" name="searchproduct" id="searchproduct" placeholder="Search by activity, business, person, username">
                                <button ><i class="fa fa-search"></i></button>
                            </form>
                        </div>
						<ul class="setting-area">
                            <li><a href="#" title="Home" data-ripple=""><i class="fa fa-home"></i></a></li>
                            <li>
                                <a href="" title="Friend Requests" data-ripple="">
                                <i class="fa fa-user"></i><em class="bg-red">5</em></a>
                            </li>
                            <li>
                                <a href="#" title="Notification" data-ripple="">
                                    <i class="fa fa-bell"></i><em class="bg-purple">7</em>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="Messages" data-ripple="">
                                <i class="fa fa-comment"></i><em class="bg-blue">9</em></a>
                            </li>
                            <li><a href="#" title="Languages" data-ripple=""><i class="fa fa-globe"></i><em>EN</em></a></li>
                            <li><a href="#" title="Help" data-ripple=""><i class="fa fa-question-circle"></i></a></li>
                        </ul>
                       <!-- <nav id='cssmenu'>
                            <form id="searchform" method="" action="{{url('/instant-hire')}}">
                               <div class="row" style="position: relative;">
    
                                        <input autocomplete="off" type="text" name="label" id="label" class="form-control" placeholder="Search by activity or bussiness name or profile"  style="width:300px; float:left; border-radius: 0; margin:0; background-color:#555; color:#fff; border:0">
                                        <input type="submit" value="Search" class="btn-style-one" style="padding:12px!important">
                                        <div id="search-business"></div>
                                    
                               </div>
                            </form>
                        </nav>-->
                   
						<div class="header-right">
							<div class="button"><span></span></div>
							<input type="button" value="Book an Activity" class="btn-style-one" onclick="location.href='/instant-hire'">
                        	@if(Auth::check())
						 		<div class="userblock">
                        			<div class="login_links" onclick="openNav()"><img src="{{ asset('/public/images/user-icon.png') }}" alt=""></div>
						
										<nav class="pc-sidebar">
											<div class="navbar-wrapper">
												<div id="mySidepanel" class="sidepanel">
													<div class="navbar-content ps">
														<a href="javascript:void(0)" class="cancle fa fa-times" onclick="closeNav()"></a>
														<ul class="pc-navbar">
                                                            <li style="text-align: center;">
                                                                <img src="/public/uploads/gallery/616/thumb/1629311769-activities-img1.jpg" alt="" style="border-radius: 100%;width: 80px; height: 80px;"> 
                                                            </li>
                                                            <li class="pc-caption">
                                                                <span> Welcome</span>
                                                            </li>
                                                            
                                                            <li class="pc-caption-1">
                                                                <span> {{ Auth::user()->firstname }} </span>
                                                            </li>
                                                            <li class="lp-tag">
                                                                <span><?php echo "@"; ?>{{ Auth::user()->username }} </span>
                                                            </li>
                                                            <li class="lp-per-pro">
                                                                <span> Personal Profile </span>
                                                            </li>		
                                                            <li class="border-1">
                                                             <button class="btn-lp" type="button"><a style="color: white;" href="{{route('welcomeBusinessProfile')}}">Create Business Profile </a> </button> 
                                                            </li>
                                                            <li class="pc-link">
                                                            <span class="pc-micon"><i class="fa fa-user"></i></span>
                                                                <a href="{{route('profile-viewProfile')}}" style="color: white;">Personal Profile</a>
                                                            </li>
                        									<li class="pc-link">
																<span class="pc-micon"><i class="fa fa-user"></i></span>
																<a href="{{route('profile-viewbusinessProfile')}}" style="color: white;">Business Profile</a>
															</li>
                                                            <li class="pc-link">
                                                                <span class="pc-micon"><i class="fas fa-cog"></i></span>
                                                                <a href="{{route('user-profile')}}" style="color: white;">Edit Personal Profile</a>
                                                            </li>
                                                            <li class="pc-link">
                                                                <span class="pc-micon"><i class="fa fa-tasks"></i></span>
                                                                <a href="{{route('manageCompany')}}" style="color: white;">Manage Business Profile</a>
                                                            </li>
                                                            <li class="pc-link">
                                                                <span class="pc-micon"><i class="fas fa-question-circle"></i></span>
                                                                <a href="#" style="color: white;">Help Desk</a>
                                                            </li>
                                                            <li class="pc-link">
                                                                <span class="pc-micon"><i class="fa fa-user-plus"></i></span>
                                                                <a href="#" style="color: white;">Invite Friends</a>
                                                            </li>
                                                            <li class="pc-link">
                                                                <span class="pc-micon"><i class="fas fa-comments"></i></span>
                                                                <a href="#" style="color: white;">Give Feedback</a>
                                                            </li>
                                                            <li class="pc-link">
                                                                <span class="pc-micon"><i class="fa fa-sign-out"></i></span>
                                                                <a href="{{ Config::get('constants.SITE_URL') }}/userlogout" style="color: white;">Logout </a>
                                                            </li>
														</ul>
													</div>
													<p class="pri-1">Privacy - Terms</p>
													<p class="pri-2">Fitnessity, Inc 2021</p>
												</div>
											</div>
										</nav>
								</div>
							@else
                                <!-- old nav -->
                                <div class="userblock">
                                    <div class="login_links"><img src="{{ asset('/public/images/user-icon.png') }}" alt=""></div>
                                    <div class="dropdown_login">
                                        <svg focusable="false" class="icon--nav-triangle-borderless" viewBox="0 0 20 9" role="presentation">
                                            <path d="M.47108938 9c.2694725-.26871321.57077721-.56867841.90388257-.89986354C3.12384116 6.36134886 5.74788116 3.76338565 9.2467995.30653888c.4145057-.4095171 1.0844277-.40860098 1.4977971.00205122L19.4935156 9H.47108938z" fill="#ffffff"></path>
                                        </svg>
                                        <ul>
                                            @if(Auth::user())
                                                <li><a href="#">Welcome {{ Auth::user()->firstname }}</a></li>
                                                <li><a href="{{route('profile-viewProfile')}}">Profile</a></li>
                                                <li><a href="{{route('user-profile')}}">Edit Profile</a></li>
                                                <li><a href="{{route('welcomeBusinessProfile')}}">Create Business</a></li>
                                                <li><a href="{{route('manageCompany')}}">Manage Business</a></li>
                                                <li><a href="{{ Config::get('constants.SITE_URL') }}/userlogout">Logout</a></li>
                                            @else
                                                <li><a href="{{ Config::get('constants.SITE_URL') }}/userlogin">Login</a></li>
                                                <li><a href="{{ Config::get('constants.SITE_URL') }}/registration">Register</a></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                        	@endif
                            <a class="btn-cart">
                                <img src="{{ asset('/public/images/cart-icon.png') }}" alt="cart"><span id="cart-item">0</span>
                            </a>
							<script>
                                $(".btn-cart").attr("href","/instant-hire/cart-payment");
                                $("#cart-item").html('<?=$total_quantity?>');
                            </script>
                    	</div><!-- header-right -->
					
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
					
                	</div> <!-- top-area -->
				</div> <!-- menu_nav -->
			</div>
        </header>

        <section id="content">
            <section class="vbox">
                <section class="scrollable padder">
                    @yield('content')
                </section>
            </section>
        </section>

    </body>
</html>

<script>
	
$(document).ready(function () {
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
		
		var programType = new SlimSelect({
            select: '#programservices'
        });
		GetData['program_type'] = programType.selected();
		
		var professionalType = new SlimSelect({
            select: '#professional_type'
        });
		GetData['professional_type'] = professionalType.selected();
		
		var activityLocation = new SlimSelect({
			select: '#activity_location'
        });
		GetData['activity_location'] = activityLocation.selected();
		
		GetData['location'] = $('#pac-input').val();
		
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
		
		var genderpreference = new SlimSelect({
            select: '#genderpreference'
        });
		GetData['gender'] = genderpreference.selected();
		
		var getLanguage = new SlimSelect({
            select: '#categ'
        });
		GetData['language'] = getLanguage.selected();
		
		var activityExp = new SlimSelect({
            select: '#activity_exp'
        });
		GetData['activity_exp'] = activityExp.selected();
		
		var personalityHabit = new SlimSelect({
            select: '#personality_habit'
        });
		GetData['personality_habit'] = personalityHabit.selected();
		//console.log(GetData);
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
                //console.log(response);
                $('.direc-right div#buisnessuser').empty();
                $('.direc-right div#buisnessuser').html(response);
            }
        });
		
    });
    
    $('.myfilter').change(function () {
		console.log("pp");return false;
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
	                        $.each(data, function(i, item) {console.log(item);
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

<link href=
'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'  rel='stylesheet'
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" ></script>
<script type="text/javascript">
$(document).ready(function () { 
	$( ".birthdate" ).datepicker();      
});
<?php /* ?>
$(document).ready(function () {
	$('#searchproduct').on('keyup',function() {
		var query = $(this).val();
		$.ajax({
			url:"{{ route('autocomplete') }}",
			type:"GET",
			data:{'product':query},
			success:function (data) {
				$('#autoData').html(data);
			}
		});
	});*/ 

	/* $(document).on('click', 'li', function()
	{
		var value = $(this).text();
		$('#product').val(value);
		window.location.href= "product_detail";  
		$('#autoData').html("");
	});
});<?php */ ?>
</script>