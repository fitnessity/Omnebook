@inject('request', 'Illuminate\Http\Request')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <link href="{{ asset('/dashboard-design/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel='stylesheet' type='text/css' href="{{asset('/css/bootstrap-select.min.css')}}">
	<link href="{{ asset('dashboard-design/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('dashboard-design/css/custom.css')}}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="{{url('public/dashboard-design/css/icons.min.css')}}">
	<link href="{{asset('dashboard-design/css/responsive.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/public/dashboard-design/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="{{ url('/public/css/all.css') }}">
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
	/* .profile-wid-bg{top: 90px;} */
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
                                        <span class="mini-stat-icon avatar-title xsmall-font rounded-circle text-success bg-soft-red fs-4 uppercase">{{$business->first_letter ?? $business->cname_first_letter}}</span> 
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
                        <a class="nav-link menu-link" href="#" aria-controls="sidebarDashboards" onclick="dashboard_menu();">
                            <img src="{{url('public/img/social-profile.png')}}" alt="Omnebook"> <span data-key="t-dashboards">Dashboard</span>
                        </a>
                    </li>
                    
                    {{-- <li class="nav-item">
                        <a class="nav-link menu-link" href="https://dev.fitnessity.co/profile/viewProfile" aria-controls="sidebarDashboards">
                            <img src="https://dev.fitnessity.co//public/img/social-profile.png" alt="Omnebook"> <span data-key="t-dashboards">View Social Profile</span>
                        </a>
                    </li> --}}
                    
                    <li class="nav-item">
                        <a class="nav-link menu-link " href="#" aria-controls="sidebarDashboards" onclick="EditProfile();">
                            <img src="{{url('public/img/edit-2.png')}}" alt="Omnebook"> <span data-key="t-dashboards"> Edit Profile &amp; Password </span>
                        </a>
                    </li>
    
                    <li class="nav-item">
                        <a class="nav-link menu-link" onclick="Schedule()" aria-controls="sidebarDashboards">
                            <img src="{{asset('/public/img/schedule-1.png')}}" alt="Omnebook">
                            <span data-key="t-dashboards"> Schedule</span>
                        </a>					
                    </li>
                    <li class="nav-item">
                        <a class="nav-link menu-link active" onclick="ManageAccount()" aria-controls="sidebarLanding" id="manage_account">
                            <img src="{{asset('/public/img/menu-icon5.svg')}}" alt="Omnebook"> <span data-key="t-landing">Manage Accounts</span>
                        </a>
                    </li>			
                    <li class="nav-item">
                        <a class="nav-link menu-link" onclick="PaymentHistory()" aria-controls="sidebarDashboards">
                            <img src="{{asset('/img/payment.png')}}" alt="Omnebook"> <span data-key="t-dashboards">Payment History</span>
                        </a>
                    </li>
    
                    <li class="nav-item">
                        <a class="nav-link menu-link" onclick="CreditCard()" aria-controls="sidebarDashboards">
                            <img src="{{asset('/public/img/credit-card.png')}}" alt="Omnebook"> <span data-key="t-dashboards"> Credit Card </span>
                        </a>
                    </li>  
                
                    <li class="nav-item">
                            <a id="logoutLink" class="nav-link menu-link" href="{{ route('logout_n', ['uniquecode' => $business->unique_code]) }}" aria-controls="sidebarDashboards">
                            <img src="{{url('public/img/social-profile.png')}}" alt="Omnebook">
                            <span data-key="t-dashboards">Logout</span>
                        </a>
                    </li>
                </ul>
            <!-- Sidebar -->
        </div>
        <div class="sidebar-background"></div>
    </div>
    <div class="main-content">
		<div class="page-content">
            <div class="container-fluid">
               <div class="row mb-3">
					<div class="col-12">
						<div class="page-heading">
							<h1>Manage Accounts</h1>
						</div>
					</div>
                </div><!--end row-->
				<div class="row">
					<div class="col-12">
						<div class="card" id="contact-view-detail">
							<div class="card-header align-items-center d-flex mb-20">
								<h4 class="card-title mb-0 flex-grow-1">Select Account To Manage</h4>
							</div>
							<div class="card-body text-center">
								<a class="profile-user position-relative d-inline-block mx-auto mb-4 ml-1 mr-1">
									@if($user->getPic())
										<img src="{{$user->getPic()}}" class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow" alt="user-profile-image">
									@else
										<div class="rounded-circle avatar-xl img-thumbnail user-profile-image shadow no-img-latter">
											<p class="character character-renovate">{{$user->first_letter}}</p>
										</div>
									@endif
									<div class="manage-account-name">
										<h5 class="mb-1 mt-2">{{$user->full_name}}</h5>
									</div>
								</a>
								
								@foreach($UserFamilyDetails as $family)
									<a class="profile-user position-relative d-inline-block mx-auto mb-4 ml-1 mr-1">
										@if(Storage::disk('s3')->exists(@$family->profile_pic))
											<img src="{{ Storage::URL(@$family->profile_pic)}}" class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow" alt="user-profile-image">
										@else
											<div class="rounded-circle avatar-xl img-thumbnail user-profile-image shadow no-img-latter">
												<p class="character character-renovate">{{$family->first_letter}}</p>
											</div>
										@endif

										<div class="manage-account-name">
											<h5 class="mb-1 mt-2">{{$family->full_name}}</h5>
										</div>
									</a>
								@endforeach

								<a data-url="{{ route('family_create', ['user_id' => $user->id]) }}" >
									<div class="profile-user position-relative d-inline-block mx-auto ml-1 mr-1">
										<div class="rounded-circle add-plus-option">
											<div class="round0plus">
												<i class="fas fa-plus"></i>
											</div>
										</div>
										<div class="manage-account-name">
											<h5 class="mb-1 mt-2">Add Family</h5>
										</div>
									</div>
								</a>
                            </div>
						</div>
					</div>
				</div>
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
	</div><!-- END layout-wrapper -->



<!-- Modal -->
<div class="modal fade" id="familyModal" tabindex="-1" role="dialog" aria-labelledby="familyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {{-- <h5 class="modal-title" id="familyModalLabel">Family Details</h5> --}}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-btn-modal"></button>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- Dynamic content will be loaded here -->
            </div>
        </div>
    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<script src="{{url('public/dashboard-design/js/bootstrap.bundle.min.js')}}"></script>
	{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="{{ url('/public/dashboard-design/js/flatpickr.min.js') }}"></script>
    <script src="{{url('public/js/jquery-input-mask-phone-number.js')}}"></script>
    <script src="{{url('public/dashboard-design/js/feather.min.js')}}"></script>
    <script src="{{url('public/dashboard-design/js/waves.min.js')}}"></script>
	<script src="{{url('public/dashboard-design/js/app.js')}}"></script>
    <script>
        $(document).on('focus', '[data-behavior~=text-phone]', function(e){
            $('[data-behavior~=text-phone]').usPhoneFormat({
                format: '(xxx) xxx-xxxx',
            });
        });
    </script>
	<script>
        flatpickr('.flatpickr-range',{
            dateFormat: "m/d/Y",
            maxDate: "today",
        });
    </script>
    <script>
		function dashboard_menu()
		{
			var token = localStorage.getItem('authToken');
			var code = {{$business->id ?? 'null'}};
			var customer = localStorage.getItem('customer');
			// alert(customer);
			const url = `https://dev.fitnessity.co/api/customer_dashboard?token=${encodeURIComponent(token)}&code=${encodeURIComponent(code)}&customer_id=${encodeURIComponent(customer)}`;
            window.parent.postMessage({ type: 'changeSrc', src: url }, '*');     
		}
	</script>
	<script>
		function EditProfile()
		{
			var customer = localStorage.getItem('customer');
			var code = {{$business->id ?? 'null'}};
			// const url = `https://dev.fitnessity.co/api/edit_profile?customer_id=${encodeURIComponent(customer)}`;
			// const url = `https://dev.fitnessity.co/api/edit_profile?code=${encodeURIComponent(code)}&customer_id=${encodeURIComponent(customer)}`;
            const url = `https://dev.fitnessity.co/api/edit_profile?code=${encodeURIComponent(code)}&customer_id=${encodeURIComponent({{$user->id}})}`;


            window.parent.postMessage({ type: 'changeSrc', src: url }, '*');   
		}
	</script>
	<script>
		window.addEventListener('load', function() {
			var val = '1';
			localStorage.setItem('loggedin',val);
		});
	</script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			var logoutLink = document.getElementById('logoutLink');	
			localStorage.setItem('loggedin', false);
			if (logoutLink) {
				logoutLink.addEventListener('click', function(event) {
					localStorage.removeItem('loggedin');					
				});
			}
		});
    </script>
    <script>
		function Schedule()
		{
			var businessId = {{ $business->id }};
			var user={{$user->id}};
			const url = `https://dev.fitnessity.co/api/business_activityschedulers?businessId=${encodeURIComponent(businessId)}&user=${encodeURIComponent(user)}`;
			window.parent.postMessage({ type: 'changeSrc', src: url }, '*'); 
		}
	</script>

	<script>
	function PaymentHistory()
	{
		var businessId = {{ $business->id }};
		var user={{$user->id}};
		const url = `https://dev.fitnessity.co/api/payment_history?businessId=${encodeURIComponent(businessId)}&user=${encodeURIComponent(user)}`;
		window.parent.postMessage({ type: 'changeSrc', src: url }, '*'); 
	}
	</script>
	<script>
		function CreditCard()
		{
			var businessId = {{ $business->id }};
			var user={{$user->id}};
			const url = `https://dev.fitnessity.co/api/creditcards?businessId=${encodeURIComponent(businessId)}&user=${encodeURIComponent(user)}`;
			window.parent.postMessage({ type: 'changeSrc', src: url }, '*'); 
		}
	</script>
	<script>
	function ManageAccount()
	{
			var businessId = {{ $business->id }};
			var user={{$user->id}};
			const url = `https://dev.fitnessity.co/api/manage_account?businessId=${encodeURIComponent(businessId)}&user=${encodeURIComponent(user)}`;
			window.parent.postMessage({ type: 'changeSrc', src: url }, '*'); 
		
	}
	</script>
    
    <script>
        $(document).ready(function() {
            $('a[data-url]').on('click', function(e) {
                e.preventDefault();        
                var url = $(this).data('url'); 
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(data) {
                        $('#modalContent').html(data); 
                        $('#familyModal').modal('show'); 
                    },
                    error: function(xhr) {
                        // Check if the response has any message
                        var errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'An unexpected error occurred. Please try again.';
                        $('#modalContent').html('<p>Error: ' + errorMessage + '</p>');
                        $('#familyModal').modal('show');
                    }
                });
            });
        });
        </script>
        <script>
            $(document).ready(function() {
                var d = document.getElementById("manage_account");            
                d.className += " active";

            });
        </script>
        <script>
            window.onload = function() {
            function sendHeight() {
                var height = document.body.scrollHeight;        
                window.parent.postMessage({
                    height: height
                }, '*');  
            }
            sendHeight();
            window.addEventListener('message', function(event) {
                if (event.data.action === 'getHeight') {
                    sendHeight(); 
                }
            });
        };
        </script>
 </body>
</html>