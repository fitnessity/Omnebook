<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
	<title>Fitnessity</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="Fitnessity: Because Fitness=Necessity" name="description" />
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
						<a class="nav-link menu-link active" href="#" aria-controls="sidebarDashboards" onclick="dashboard_menu();">
							<img src="{{url('public/img/social-profile.png')}}" alt="Fitnessity"> <span data-key="t-dashboards">Dashboard</span>
						</a>
					</li>
					
					{{-- <li class="nav-item">
						<a class="nav-link menu-link" href="https://dev.fitnessity.co/profile/viewProfile" aria-controls="sidebarDashboards">
							<img src="https://dev.fitnessity.co//public/img/social-profile.png" alt="Fitnessity"> <span data-key="t-dashboards">View Social Profile</span>
						</a>
					</li> --}}
					
					<li class="nav-item">
						<a class="nav-link menu-link " href="#" aria-controls="sidebarDashboards" onclick="EditProfile();">
							<img src="{{url('public/img/edit-2.png')}}" alt="Fitnessity"> <span data-key="t-dashboards"> Edit Profile &amp; Password </span>
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link menu-link" onclick="Schedule()" aria-controls="sidebarDashboards">
							<img src="{{asset('/public/img/schedule-1.png')}}" alt="Fitnessity">
							<span data-key="t-dashboards"> Schedule</span>
						</a>					
					</li>
					<li class="nav-item">
						<a class="nav-link menu-link" onclick="ManageAccount()" aria-controls="sidebarLanding">
							<img src="{{asset('/public/img/menu-icon5.svg')}}" alt="Fitnessity"> <span data-key="t-landing">Manage Accounts</span>
						</a>
					</li>			
					<li class="nav-item">
						<a class="nav-link menu-link" onclick="PaymentHistory()" aria-controls="sidebarDashboards">
							<img src="{{asset('/img/payment.png')}}" alt="Fitnessity"> <span data-key="t-dashboards">Payment History</span>
						</a>
					</li>

					<li class="nav-item">
						<a class="nav-link menu-link" onclick="CreditCard()" aria-controls="sidebarDashboards">
							<img src="{{asset('/public/img/credit-card.png')}}" alt="Fitnessity"> <span data-key="t-dashboards"> Credit Card </span>
						</a>
					</li>  
				
					<li class="nav-item">
							<a id="logoutLink" class="nav-link menu-link" href="{{ route('logout_n', ['uniquecode' => $business->unique_code]) }}" aria-controls="sidebarDashboards">
							<img src="{{url('public/img/social-profile.png')}}" alt="Fitnessity">
							<span data-key="t-dashboards">Logout</span>
						</a>
					</li>
				</ul>
			<!-- Sidebar -->
		</div>
	</div>
	<div class="vertical-overlay"></div>
    <div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<div class="row mb-3">
					 <div class="col-12">
						<div class="text-right mb-3 mt-3">
							<a class="btn btn-red" id="purchaseMembershipBtn">Purchase A Membership </a>
						</div>
					 </div>
					<div class="col-12">
						<div class="text-center">
							<div class="">
								@if(!$business->getCompanyImage())
								<div class="company-list-text mb-10">
					          		<p class="character">{{$business->first_letter}}</p>
					          	</div>
								@else
									<img src="{{$business->getCompanyImage()}}" alt="" class="avatar">
								@endif
							</div>
							<div class="page-heading">
								<label>{{$business->public_company_name}}</label>
							</div>
						</div>
					</div>				
				</div>
				<!--end row-->	
				<div class="row mb-3 pb-1">
					<div class="col-12">
						<div class="d-flex align-items-lg-center flex-lg-row flex-column">
							<div class="flex-grow-1">
								<h4 class="fs-17 mb-1">Welcome Back, {{$name}} </h4>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-3 col-md-6">
						<!-- card -->
						<div class="card card-animate card-fix">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div class="white-box flex-grow-1 overflow-hidden">
										<p class="fw-medium text-muted text-truncate mb-0"> Total Attendance | Month</p>
									</div>
									<div class="increase flex-shrink-0">
										@if(@$attendancePct < 0)
                                            <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>{{@$attendancePct}} % </h5> <p>Decrease</p>
                                        @else
                                            <h5 class="text-success fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> + {{@$attendancePct}} % </h5> <p>Increase</p>
                                        @endif      
									</div>
								</div>
								<div class="d-flex align-items-end justify-content-between mt-4">
									<div>
										<h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$attendanceCnt}}">{{$attendanceCnt}}</span></h4>
									</div>
									<div class="avatar-sm flex-shrink-0">
										<span class="avatar-title bg-warning rounded fs-3">
											<i class="bx bx-user-circle"></i>
										</span>
									</div>
								</div>
							</div>
							<!-- end card body -->
						</div>
						<!-- end card -->
					</div>
					<!-- end col -->

					<div class="col-xl-3 col-md-6">
						<!-- card -->
						<div class="card card-animate card-fix">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div class="white-box flex-grow-1 overflow-hidden">
										<p class="fw-medium text-muted text-truncate mb-0">Total Bookings | Month</p>
									</div>
									<div class="decrease flex-shrink-0">
										@if(@$bookingPct < 0)
                                            <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>{{@$bookingPct}} % </h5> <p>Decrease</p>
                                        @else
                                            <h5 class="text-success fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> + {{@$bookingPct}} % </h5> <p>Increase</p>
                                        @endif  

									</div>
								</div>
								<div class="d-flex align-items-end justify-content-between mt-4">
									<div>
										<h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$bookingCnt}}">{{$bookingCnt}}</span></h4>
									</div>
									<div class="avatar-sm flex-shrink-0">
										<span class="avatar-title bg-info rounded fs-3">
											<i class="bx bx-shopping-bag"></i>
										</span>
									</div>
								</div>
							</div>
							<!-- end card body -->
						</div>
						<!-- end card -->
					</div>
					<!-- end col -->

					<div class="col-xl-3 col-md-6">
						<div class="card card-animate card-fix">
							<div class="card-body">
								<div class="d-flex align-items-center">
									<div class="white-box flex-grow-1 overflow-hidden">
										<p class="fw-medium text-muted text-truncate mb-0">Self Check-In Options</p>
									</div>
								</div>
								<div class="d-flex align-items-end justify-content-between mt-4">
									<div class="fout-digit-info">
										<p><b>4 Digit Code: </b> {{$user->unique_code}}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
					

					<div class="col-xxl-12 col-lg-12">
						<div class="card">
							<div class="card-header align-items-center d-flex">
								<h4 class="card-title mb-0 flex-grow-1 font-red">Your Upcoming Classes</h4>
							</div>
							<!-- end card header -->

							<div class="mt-10 ml-10 fs-14" id="error-message"></div>	

							<div class="card-body">
								<div class="live-preview">
									<div class="table-responsive">
										<table class="table align-middle table-nowrap mb-0">
											<thead>
												<tr>
													<th scope="col">Session</th>
													<th scope="col">Program Name </th>
													<th scope="col">Time and Date</th>
													<th scope="col">Membership</th>
													<th scope="col"> </th>
													<th scope="col"> </th>
												</tr>
											</thead>
											<tbody>
												@forelse(@$classes as $c)
													<tr>
														<th scope="row">{{@$c->order_detail->getRemainingSessionAfterAttend()."/".@$c->order_detail->pay_session}}</th>
														<td>{{ @$c->order_detail->business_services_with_trashed->program_name }} </td>
														<td>{{ date('m/d/Y' ,strtotime($c->checkin_date))}}  {{ date("g:i A", strtotime(@$c->scheduler->shift_start))}} </td>
														<td> {{ @$c->order_detail->business_price_detail_with_trashed->price_title }}</td>
														<td>
															<div class="">
																<a class="btn {{ $c->checked_at ? 'btn-success' : 'btn-red' }}" id="{{ $c->id }}" @if(!$c->checked_at) onclick="checkin('{{ $c->id }}');" @endif>
																	{{ $c->checked_at ? 'Checked In' : 'Check-In' }}
																</a>
																<!-- <a class="btn btn-red" @if(!$c->checked_at) onclick="checkin('{{$c->id}}');" @endif >@if($c->checked_at) Checked @else Check-In @endif</a> -->
															</div>
														</td>
														<td>
															<div class="">
																{{-- <a class="btn btn-red" href="{{ url('/personal/orders') . '?' . http_build_query(['business_id' => request()->business_id, 'customer_id' => request()->has('customer_id') ? request()->customer_id : null,'type' => request()->has('type') ? request()->type : null]) }}">View Booking</a> --}}
																{{-- <a class="btn btn-red" >View Booking</a> --}}
																<a class="btn btn-red" id="viewBookingBtn-{{ $c->id }}" onclick="viewBooking('{{ $c->id }}')">View Booking</a>
																<!-- <a href="" class="btn btn-red"><img src="https://dev.fitnessity.co/public/images/processing.gif" alt="Processing..." class="clientloading"></a> -->
															</div>
														</td>
													</tr>
												@empty
													<tr><td>No Upcoming Class Available</td></tr>
												@endforelse
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- end card-body -->
						</div>
						<!-- end card -->
					</div>
					<!-- end col -->					
				</div>
			</div>
			<!-- container-fluid -->
		</div>
	</div>
	<!-- Modal Structure -->
		<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
			<div class="modal-dialog ">
				<div class="modal-content">
					<div class="modal-header">
						<!-- <h5 class="modal-title" id="bookingModalLabel">Booking Details</h5> -->
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<!-- Booking details will be loaded here -->
						<h5>booking</h5>
					</div>
				</div>
			</div>
		</div>
	{{-- end --}}

	<!-- Modal Structure -->
	<div class="modal fade" id="membershipModal" tabindex="-1" role="dialog" aria-labelledby="membershipModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					{{-- <h5 class="modal-title" id="membershipModalLabel">Purchase Membership</h5> --}}
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

				</div>
				<div class="modal-body" id="modalBodyContent">
					<!-- Content will be loaded here via AJAX -->
				</div>
				<div class="modal-footer">
					{{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
				</div>
			</div>
		</div>
	</div>
	
    	<!-- Modal Structure -->
        <div class="modal fade instructors" id="instructorModal" tabindex="-1" aria-labelledby="instructorModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                {{-- <h5 class="modal-title" id="instructorModalLabel">Instructor Details</h5> --}}
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div id="instructorContent">
                    <!-- Content will be injected here -->
                </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>
        {{-- modal ends --}}
		   {{-- membership modal starts --}}
		   <div class="modal fade membership-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" onclick="window.location.reload()"></button>
                    </div>
                    <div class="modal-body membership-modal-content"></div>
                </div>
              </div>
        </div>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<script src="{{url('public/dashboard-design/js/bootstrap.bundle.min.js')}}"></script>
	{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://js.stripe.com/v3/"></script>


	<script src="{{url('public/dashboard-design/js/feather.min.js')}}"></script>
    <script src="{{url('public/dashboard-design/js/waves.min.js')}}"></script>
	<script src="{{url('public/dashboard-design/js/app.js')}}"></script>
		{{-- <script>
		$(document).ready(function() {
			var url = localStorage.getItem("schedulerurl");
				if (localStorage.getItem("scheduler") === 'checkedin') {
					if(url!='')
					{
						window.location.href = url;
					}
				} 
		});
	</script> --}}

    <script>
        $(document).ready(function() {
            $("#actfildate_forcart").datepicker();
        });
    </script>
	<script>
		function dashboard_menu()
		{
			var token = localStorage.getItem('authToken');
			var code = {{$business->id ?? 'null'}};
			var customer = localStorage.getItem('customer');
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
			const url = `https://dev.fitnessity.co/api/edit_profile?code=${encodeURIComponent(code)}&customer_id=${encodeURIComponent(customer)}`;

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
	<script type="text/javascript">
		 $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
		function checkin(id) {
			$('#error-message').removeClass('text-danger font-green').html('');
			$.ajax({
				url: "{{route('quickcheckin')}}", 
				type: 'post',
				data: {
					checkinId: id,
                    _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
				},
				success: function(response) {
					if (response.success) {
						$('#error-message').addClass('font-green').html(response.message1);
						setTimeout(function (e){
							window.location.reload();
						},2000);
					} else {
						$('#error-message').addClass('text-danger').html(response.message || 'An error occurred. Please try again.');
					}
				},
				error: function(xhr, status, error) {
					$('#error-message').addClass('text-danger').html('An error occurred. Please try again.');
				}
			});
		}	
	</script>			

	<script>
		function viewBooking(bookingId) {
			var businessId = {{ $business->id }};
			var user={{$user->id}};
			var button = $('#viewBookingBtn-' + bookingId); 
			var originalContent = button.html();
			button.html('<img src="https://dev.fitnessity.co/public/images/processing.gif" alt="Loading..." class="clientloading">');

			$.ajax({
				url: "{{ route('orders.viewbooking') }}", 
				method: 'POST',
				data: {
					id: bookingId, 
					_token: $('meta[name="csrf-token"]').attr('content'),
					business_id: businessId,  // Add businessId here
					user_id:user,
				},
				success: function(response) {
					$('#bookingModal .modal-body').html(response.html);
					$('#bookingModal').modal('show');
					button.html(originalContent);
				},
				error: function() {
					$('#bookingModal .modal-body').html('<p>Error loading booking details.</p>');
				}
			});
		}
	</script>

	<script>
		function serchByActivty(){
			var text = $('#activityName').val();
			var type = $('#serchType').val();
			var businessId = {{ $business->id }};
			var user={{$user->id}};

			$.ajax({
				type: "post",
				url: '{{ route("orders_searchActivity") }}',
				data: {
					"_token": $('meta[name="csrf-token"]').attr('content'), 
					"text": text,
					"type": type,
					"businessId": businessId,
					'serviceType': '{{ request()->serviceType }}',
					'user_id':user,
				},
				success: function(data){
					$(".tabdata"+type).html(data);
				},
				error: function(xhr, status, error) {
					console.error(xhr.responseText); 
				}
			});
		}
	</script>
	<script>
		// $(document).ready(function() {
			$('#purchaseMembershipBtn').on('click', function() {
				var companyinfo = @json($companyinfo); 		
				var user={{$user->id}};
		
				$.ajax({
					url: '{{ route("membership") }}', 
					method: 'POST',
					data: {
						companyinfo: companyinfo,
						user:user,
					},
					success: function(response) {
						$('#modalBodyContent').html(response);
						$('#membershipModal').modal('show');
					},
					error: function() {
						$('#modalBodyContent').html('<p>There was an error loading the content. Please try again.</p>');
						$('#membershipModal').modal('show');
					}
				});
			});
		// });
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