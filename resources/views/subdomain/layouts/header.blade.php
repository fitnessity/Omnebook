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
	



		{{-- new added --}}
    	<link href="{{ url('/public/dashboard-design/css/simplebar.min.css')}}" rel="stylesheet" type="text/css" />


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
		<!--datatable css-->
		<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
		<!--datatable responsive css-->
		<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
		<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
		
		<!-- font glyphicon -->
		<link href="{{url('/public/css/glyphicon.css')}}" rel="stylesheet" type="text/css" />

		<!-- Filepond css -->
		<link href="{{url('/public/dashboard-design/filepond/filepond.min.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{url('/public/dashboard-design/filepond/filepond-plugin-image-preview.min.css')}}" rel="stylesheet" type="text/css" />
		<script src="{{url('public/dashboard-design/js/jquery-3.6.4.min.js')}}"></script>
		<link href="{{url('public/css/frontend/jquery-ui.css')}}"  rel='stylesheet'>
			
{{-- 
		<script src="{{url('public/dashboard-design/js/jquery-3.6.4.min.js')}}"></script> --}}

			
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
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-KQRG55N3Q1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());
		
		  gtag('config', 'G-KQRG55N3Q1');
		</script>
		 <!-- new design end -->
		<script src="{{url('/public/js/owl.js')}}"></script>    

</head>
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
										<span class="mini-stat-icon avatar-title xsmall-font rounded-circle text-success bg-soft-red fs-4 uppercase">{{$business->first_letter??$business->cname_first_letter}}</span> 
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
						{{-- <a class="nav-link menu-link active" href="{{route('sub_customer_dashboard')}}" aria-controls="sidebarDashboards">
							<img src="{{url('public/img/social-profile.png')}}" alt="OmneBook"> <span data-key="t-dashboards">Dashboard</span>
						</a> --}}
						<a class="nav-link menu-link active" href="{{ route('sub_customer_dashboard', ['unique_code' => $unique_code]) }}">
							<img src="{{ url('public/img/social-profile.png') }}" alt="OmneBook"> <span data-key="t-dashboards">Dashboard</span>
						</a>
						
					</li>
					
					{{-- <li class="nav-item">
						<a class="nav-link menu-link" href="https://dev.OmneBook.co/profile/viewProfile" aria-controls="sidebarDashboards">
							<img src="https://dev.OmneBook.co//public/img/social-profile.png" alt="OmneBook"> <span data-key="t-dashboards">View Social Profile</span>
						</a>
					</li> --}}
					
					<li class="nav-item">
						<a class="nav-link menu-link " href="{{ route('user.editProfile', ['business_id' => $business->id, 'user_id' => auth()->id(),'unique_code' => $unique_code]) }}"  aria-controls="sidebarDashboards" onclick="EditProfile();">
							<img src="{{url('public/img/edit-2.png')}}" alt="OmneBook"> <span data-key="t-dashboards"> Edit Profile &amp; Password </span>
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link menu-link"href="{{ route('business_activity_schedulers_sub', ['business_id' => $business->id,'unique_code' => $unique_code]) }}" aria-controls="sidebarDashboards">
							<img src="{{asset('/public/img/schedule-1.png')}}" alt="OmneBook">
							<span data-key="t-dashboards">Schedule</span>
						</a>					
					</li>
					<li class="nav-item">
						<a class="nav-link menu-link" href="{{route('manage_account', ['unique_code' => $unique_code]) }}" aria-controls="sidebarLanding">
							<img src="{{asset('/public/img/menu-icon5.svg')}}" alt="OmneBook"> <span data-key="t-landing">Manage Accounts</span>
						</a>
					</li>			
					<li class="nav-item">
						<a class="nav-link menu-link" href="{{route('payment_history', ['unique_code' => $unique_code]) }}" aria-controls="sidebarDashboards">
							<img src="{{asset('/img/payment.png')}}" alt="OmneBook"> <span data-key="t-dashboards">Payment History</span>
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link menu-link" href="{{route('credit-cards', ['unique_code' => $unique_code]) }}" aria-controls="sidebarDashboards">
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
						<form id="logoutForm" action="{{ route('subdomain.logout_sub', ['unique_code' => $unique_code]) }}" method="POST" style="display: inline;">
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
	<script src="{{ url('/public/dashboard-design/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{url('public/dashboard-design/js/jquery-ui.min.js')}}"></script>
	<script src="https://js.stripe.com/v3/"></script>

	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/confirmDate/confirmDate.js"></script>
	<script src="{{url('/public/dashboard-design/js/profile-setting.init.js')}}"></script>
			
	<script src="{{ url('public/js/JQueryValidate/jquery.validate.js') }}"></script>
	<script src="{{ url('public/js/JQueryValidate/additional-methods.min.js') }}"></script>
	<script src="{{ url('public/js/jquery-input-mask-phone-number.js') }}"></script>
	<script src="{{ url('public/js/moment.js') }}"></script>
		
	<script src="{{url('/public/dashboard-design/js/form-file-upload.init.js')}}"></script> 
	<script src="{{ url('public/js/general.js') }}"></script>
	<script src="{{url('public/dashboard-design/js/feather.min.js')}}"></script>
	<script src="{{url('public/dashboard-design/js/waves.min.js')}}"></script>
	<script src="{{url('public/dashboard-design/js/app.js')}}"></script>
	
	
	<script>
        function valid(email)
    {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test(email); //this will either return true or false based on validation
    }

    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(email)) {
            return false;
        }else {
            return true;
        }
    }
</script>

</body>
</html>