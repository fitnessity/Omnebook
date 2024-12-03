<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
	<title>OmneBook</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="OmneBook: Because OmneBook=Necessity" name="description" />
	<meta content="" name="author" />
	<meta name="csrf-token" content="{{ csrf_token() }}"> 
    <link href="{{ asset('/dashboard-design/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel='stylesheet' type='text/css' href="{{asset('/css/bootstrap-select.min.css')}}">
	<link href="{{ asset('dashboard-design/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard-design/css/custom.css')}}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="{{url('public/dashboard-design/css/icons.min.css')}}">
	<link href="{{asset('dashboard-design/css/responsive.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/public/dashboard-design/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="{{ url('/public/css/all.css') }}">
	<script src="{{url('public/dashboard-design/js/jquery-3.6.4.min.js')}}"></script>
	<script src="{{ url('/public/dashboard-design/js/bootstrap.bundle.min.js') }}"></script>
	<script src="https://js.stripe.com/v3/"></script>

	<link href="{{url('public/css/frontend/jquery-ui.css')}}"  rel='stylesheet'>
	<script src="{{url('public/dashboard-design/js/jquery-ui.min.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/confirmDate/confirmDate.js"></script>
	<script src="{{url('/public/dashboard-design/js/profile-setting.init.js')}}"></script>
	<script src="https://js.stripe.com/v3/"></script>
	
    <script src="{{ url('public/js/JQueryValidate/jquery.validate.js') }}"></script>
    <script src="{{ url('public/js/JQueryValidate/additional-methods.min.js') }}"></script>
    <script src="{{ url('public/js/jquery-input-mask-phone-number.js') }}"></script>
    <script src="{{ url('public/js/moment.js') }}"></script>
  
    <!-- init js -->

		<script src="{{url('/public/dashboard-design/js/form-file-upload.init.js')}}"></script> 


		<script src="{{ url('public/js/general.js') }}"></script>


</head>
<style>
	.navbar-menu .navbar-nav .nav-link.active{
		color: #fff;
	}
	.card-fix{
		height: 144px;
	}
	.page-content { padding: calc(0px + 4.5rem) calc(1.5rem* .5) 60px calc(1.5rem* .5);}
	#page-topbar{top: 0;}
	:is([data-layout="vertical"], [data-layout="semibox"])[data-sidebar-size="sm"] .navbar-menu{padding-top: 0; padding: 0;}
	:is([data-layout="vertical"], [data-layout="semibox"])[data-sidebar-size="sm"] .navbar-menu .com-name{display: none;}

</style>
<body>
	<header id="page-topbar">
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
            </div>
        </div>
    </header>
	<div class="app-menu navbar-menu" >
		<div class="navbar-brand-box">
			<button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover"> <i class="ri-record-circle-line"></i> </button>
		</div>
		<div id="scrollbar">
				<div id="two-column-menu">
				</div>
				<ul class="navbar-nav dash-sidebar-menu" id="navbar-nav">
					<div class="d-flex align-items-center c-padding mt-2">
						<div class="avatar-xsmall me-2">
								{{-- <span class="mini-stat-icon avatar-title xsmall-font rounded-circle text-success bg-soft-red fs-4 uppercase">N S</span> --}}
								@if(!$business->getCompanyImage())
										<span class="mini-stat-icon avatar-title xsmall-font rounded-circle text-success bg-soft-red fs-4 uppercase">{{$business->first_letter}}</span> 
									@else
										<img src="{{$business->getCompanyImage()}}" alt="" class="avatar-xsmall rounded-circle">
								@endif
							</div>
						<div class="font-white flex-grow-1 com-name">{{$business->public_company_name}}.</div>
					</div>
					<li class="menu-title border-bottom">
						<span class="font-white switch-business" data-key="t-menu">Welcome {{$name}}</span>
					</li>
					<li class="menu-title"><span data-key="t-menu">Menu</span></li>
					<li class="nav-item">
						<a class="nav-link menu-link active" href="{{route('sub_customer_dashboard')}}" aria-controls="sidebarDashboards">
							<img src="{{url('public/img/social-profile.png')}}" alt="OmneBook"> <span data-key="t-dashboards">Dashboard</span>
						</a>
					</li>
					
					{{-- <li class="nav-item">
						<a class="nav-link menu-link" href="https://dev.OmneBook.co/profile/viewProfile" aria-controls="sidebarDashboards">
							<img src="https://dev.OmneBook.co//public/img/social-profile.png" alt="OmneBook"> <span data-key="t-dashboards">View Social Profile</span>
						</a>
					</li> --}}
					
					<li class="nav-item">
						<a class="nav-link menu-link " href="{{ route('user.editProfile', ['business_id' => $business->id, 'user_id' => auth()->id()]) }}"  aria-controls="sidebarDashboards" onclick="EditProfile();">
							<img src="{{url('public/img/edit-2.png')}}" alt="OmneBook"> <span data-key="t-dashboards"> Edit Profile &amp; Password </span>
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link menu-link" onclick="Schedule()" aria-controls="sidebarDashboards">
							<img src="{{asset('/public/img/schedule-1.png')}}" alt="OmneBook">
							<span data-key="t-dashboards"> Schedule</span>
						</a>					
					</li>
					<li class="nav-item">
						<a class="nav-link menu-link" href="{{route('manage_account')}}" aria-controls="sidebarLanding">
							<img src="{{asset('/public/img/menu-icon5.svg')}}" alt="OmneBook"> <span data-key="t-landing">Manage Accounts</span>
						</a>
					</li>			
					<li class="nav-item">
						<a class="nav-link menu-link" onclick="PaymentHistory()" aria-controls="sidebarDashboards">
							<img src="{{asset('/img/payment.png')}}" alt="OmneBook"> <span data-key="t-dashboards">Payment History</span>
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link menu-link" onclick="CreditCard()" aria-controls="sidebarDashboards">
							<img src="{{asset('/public/img/credit-card.png')}}" alt="OmneBook"> <span data-key="t-dashboards"> Credit Card </span>
						</a>
					</li>  
				
					{{-- <li class="nav-item">
							<a id="logoutLink" class="nav-link menu-link" href="#" aria-controls="sidebarDashboards">
							<img src="{{url('public/img/social-profile.png')}}" alt="OmneBook">
							<span data-key="t-dashboards">Logout</span>
						</a>
					</li> --}}
					<li class="nav-item">
						<form id="logoutForm" action="{{ route('subdomain.logout_sub') }}" method="POST" style="display: inline;">
							@csrf
							<button type="submit" class="nav-link menu-link" style="border: none; background: transparent;">
								<img src="{{ url('public/img/social-profile.png') }}" alt="OmneBook">
								<span data-key="t-dashboards">Logout</span>
							</button>
						</form>
					</li>
					
				</ul>
			<!-- Sidebar -->
		</div>
	</div>
	<div class="vertical-overlay"></div>
    @yield('content')
	
</body>
</html>