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
	.page-content {    padding: calc(0px + 4.5rem) calc(1.5rem* .5) 60px calc(1.5rem* .5);}
    #page-topbar{top: 0;}
    :is([data-layout="vertical"], [data-layout="semibox"])[data-sidebar-size="sm"] .navbar-menu{padding-top: 0; padding: 0;}
	:is([data-layout="vertical"], [data-layout="semibox"])[data-sidebar-size="sm"] .navbar-menu .com-name{display: none;}


.table#example .w4 {
	width:40px !important;
}
.table#example .w6 {
	width:60px !important;
}
.table#example .w8 {
	width:80px !important;
}
.table#example .w10 {
	width:100px !important;
}
.table#example .w15 {
	width:150px !important;
}
.table#example .w18 {
	width:174px !important;
}
.table#example .w20 {
	width:200px !important;
}
.table#example .w26 {
	width:260px !important;
}

#example_length label{
    display: flex !important;
    align-items: center;
}
#example_length label select{
    margin-left: 7px;
    margin-right: 7px;
    
}
.table-responsive {
    overflow-x: hidden !important;
}
#example_paginate{float: right;}

@media (max-width: 767px) {
    .table-responsive {
        overflow-x: auto !important;
    }
}
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
                    <li class="menu-title border-bottom width-250">
                        <span class="font-white switch-business" data-key="t-menu">Welcome {{$name}}</span>
                    </li>
                    <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#" aria-controls="sidebarDashboards" onclick="dashboard_menu();">
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
                        <a class="nav-link menu-link active" onclick="PaymentHistory()" aria-controls="sidebarDashboards">
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
        <div class="sidebar-background"></div>
    </div>
    <div class="main-content">
		<div class="page-content">
            <div class="container-fluid">
               <div class="row mb-3">
					<div class="col-12">
						<div class="page-heading">
							<label>Payment Information</label>
						</div>
					</div>
                </div><!--end row-->
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title mb-0">Payment History</h4>
							</div><!-- end card header -->
							<div class="card-body">
								<div class="row">
                                    <div class="col-12">
                                        <div class="item-history">
                                            <div class="table-responsive dt-responsive">
                                                <table id="example" class="table mb-25" style="width: 99%">
                                                    <thead>
                                                        <tr>
                                                            <th class="w4">Sale Date </th>
                                                            <th class="w26">Item Description </th>
                                                            <th class="w10">Item Type</th>
                                                            <th class="w10">Pay Method</th>
                                                            <th class="w8">Price</th>
                                                            <th class="w4">Qty</th>
                                                            <th class="w6">Status</th>
                                                            <th class="w6">Receipt</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tbodydetail">
                                                        @forelse($mergedArray as $history )
                                                            <tr>
                                                                <td>{{$history['created_at']}}</td>
                                                                <td>{!!$history['itemDescription']!!} </td>
                                                                <td>{{$history['item_type_terms']}}</td>
                                                                <td>{{$history['getPmtMethod']}}</td>
                                                                <td>${{$history['amount']}}</td>
                                                                <td>{{$history['qty']}}</td>
                                                                <td>{!!$history['getBookingStatus']!!}</td>
                                                                {{-- <td><a  class="mailRecipt" data-behavior="send_receipt"  data-url="{{route('receiptmodel',['orderId'=>$history['item_id'],'customer'=>$history['customer_id']])}}" data-item-type="{{$history['item_type_terms']}}" data-modal-width="modal-70" ><i class="far fa-file-alt" aria-hidden="true"></i></a>
                                                                </td> --}}
                                                                <td>
                                                                    <a class="mailRecipt" data-behavior="send_receipt" data-url="{{ route('receipt_model', ['orderId' => $history['item_id'], 'customer' => $history['customer_id']]) }}" data-item-type="{{ $history['item_type_terms'] }}" data-modal-width="modal-70">
                                                                        <i class="far fa-file-alt" aria-hidden="true"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @empty 
                                                            <tr> <td colspan="8">Payment History Is Not Available</td></tr>
                                                      @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
								</div>                                    
							</div>
                            <!-- end card-body -->
						</div>
                        <!-- end card -->
					</div>
                    <!-- end col -->
				</div>
                <!-- end row -->				
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
     </div>
     <!-- end main content-->
</div>
<!-- END layout-wrapper -->
<!-- new code starts -->

<div class="modal fade" id="receiptModal" tabindex="-1" role="dialog" aria-labelledby="receiptModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="receiptModalLabel">Receipt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-btn-modal"></button>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- Content will be loaded here via AJAX -->
            </div>
        </div>
    </div>
</div>


<!-- ends -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script src="{{url('public/dashboard-design/js/bootstrap.bundle.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://js.stripe.com/v3/"></script>
    <script src="{{url('public/dashboard-design/js/feather.min.js')}}"></script>
    <script src="{{url('public/dashboard-design/js/waves.min.js')}}"></script>
    <script src="{{url('public/dashboard-design/js/app.js')}}"></script>

<script src="{{url('public/dashboard-design/js/datatable/jquery.dataTables.min.js')}}"></script>
<script src="{{url('public/dashboard-design/js/datatable/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{url('public/dashboard-design/js/datatable/dataTables.responsive.min.js')}}"></script>
<script src="{{url('public/dashboard-design/js/datatable/dataTables.buttons.min.js')}}"></script>
<script src="{{url('public/dashboard-design/js/datatable/buttons.print.min.js')}}"></script>
<script src="{{url('public/dashboard-design/js/datatable/buttons.html5.min.js')}}"></script>

<!-- <script>
    jQuery(document).ready(function() {
        jQuery('#example').DataTable({
            "aLengthMenu": [[10, 20, 30, 55, -1], [10, 25, 50, 70, "All"]],
            "pageLength": 10,
            "order": [],
            "dom": '<"row justify-content-between align-items-center"<"col-auto"l><"col-auto"f>>rt<"row justify-content-between bottom-information"<"col-auto"i><"col-auto"p>><"clear">'
        });
    });
</script>  -->

<script>
    jQuery(document).ready(function() {
        jQuery('#example').DataTable({
            // "aLengthMenu": [[10, 25, 50, 70, -1], [10, 25, 50, 70, "All"]],
            "pageLength": 10,
            "order": [],
            "dom": '<"row justify-content-between align-items-center"<"col-auto"l>>rt<"row justify-content-between bottom-information"<"col-auto"i><"col-auto"p>><"clear">',
            "lengthChange": false,
        });
    });
    table.on('draw', function() {
        var info = table.page.info();
        console.log('Total records: ' + info.recordsTotal);
        console.log('Displayed records: ' + info.recordsDisplay);
    });
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
	function Schedule()
	{
		var businessId = {{ $business->id }};
		var user={{$user->id}};
		const url = `https://dev.fitnessity.co/api/business_activityschedulers?businessId=${encodeURIComponent(businessId)}&user=${encodeURIComponent(user)}`;
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
		document.addEventListener('DOMContentLoaded', function() {
			var logoutLink = document.getElementById('logoutLink');	
			if (logoutLink) {
				logoutLink.addEventListener('click', function(event) {
					localStorage.removeItem('loggedin');					
				});
			}
		});
	</script>
    	<script>
            $(document).on('click', '.mailRecipt', function(e) {
            e.preventDefault();
            var url = $(this).data('url');
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        $('#modalContent').html(response.html);
                        $('#receiptModal').modal('show');
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr);
                        alert('An error occurred while loading the receipt.');
                    }
                });
            });
    
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
     
</body>
</html>