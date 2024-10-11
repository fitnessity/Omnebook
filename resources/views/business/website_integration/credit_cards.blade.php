@inject('request', 'Illuminate\Http\Request')
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
    
 
    <style>
	.navbar-menu .navbar-nav .nav-link.active{
		color: #fff;
	}
	.card-fix{
		height: 144px;
	}
	.page-content {
        padding: calc(0px + 4.5rem) calc(1.5rem* .5) 60px calc(1.5rem* .5);
    }
    #page-topbar{top: 0;}
    :is([data-layout="vertical"], [data-layout="semibox"])[data-sidebar-size="sm"] .navbar-menu{padding-top: 0; padding: 0;}
	:is([data-layout="vertical"], [data-layout="semibox"])[data-sidebar-size="sm"] .navbar-menu .com-name{display: none;}
	
</style>
</head>

<body>

	<!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    
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
                        <a class="nav-link menu-link" onclick="PaymentHistory()" aria-controls="sidebarDashboards">
                            <img src="{{asset('/img/payment.png')}}" alt="Fitnessity"> <span data-key="t-dashboards">Payment History</span>
                        </a>
                    </li>
    
                    <li class="nav-item">
                        <a class="nav-link menu-link active" onclick="CreditCard()" aria-controls="sidebarDashboards">
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
						<div class="page-heading">
							<label>Credit Card Information</label>
						</div>
					</div>
                </div><!--end row-->
				<div class="row">
					<div class="col-lg-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title mb-0">Your Saved Cards</h4>
							</div><!-- end card header -->
							<div class="card-body">
								<div class="row">
									@forelse($cardInfo as $card) 
									    <div class="col-lg-3 col-sm-6">
										    <div class="cards-block dispalycard" style="cursor: pointer" data-name="{{$card['name']}}" data-cvv="" data-cnumber="{{$card['last4']}}" data-month="{{$card['exp_month']}}" data-year="{{$card['exp_year']}}" data-type="{{strtolower($card['brand'])}}" data-id="{{$card['id']}}" data-ptype="update">
											    <div class="cards-content" style="background-image: url('/public/img/visa-card-bg.jpg');">
		                                            <img src="{{ url('/public/images/creditcard/'.strtolower($card['brand']).'.jpg') }}" alt="">
		                                            <span>{{$card['name']}}</span>
		                                            <p>{{ucfirst(strtolower($card['brand']))}}</p>
		                                            <span>
                		                                <span class="dots"></span><span class="dots"></span><span class="dots"></span><span class="dots"></span>{{$card['last4']}} 
                		                            </span>
		                                           <a class="float-end card-remove" data-behavior="delete_card" data-url="{{route('cardDeleteApi', ['stripe_payment_method' => $card['payment_id']])}}" data-cardid="{{$card['id']}}" title="Delete Card" class="delCard"><i class="fa fa-trash"></i></a>
		                                        </div>
                                            </div>
									    </div>
									@empty
									@endforelse
									<div class="col-lg-3 col-sm-6">
										<div class="cards-block addcard" style="cursor: pointer" data-name="" data-cvv="" data-cnumber="" data-month="" data-year="" data-type="" data-ptype="insert">
                                            <div class="cards-content" style=" background-image: url('/public/img/visa-card-bg.jpg');">
                                                <span style="text-align: center">Add New Card</span>
                                            </div>
                                        </div>
									</div>


                        

									<div class="row" id="stripediv" style="display:none;">
                                        <div class="col-md-6">
                                            @if (session('stripeErrorMsg'))
                                                <div class="col-md-12">
                                                    <div class='form-row row'>
                                                        <div class='col-md-12  error form-group'>
                                                            <div class="alert-danger alert">{{ session('stripeErrorMsg') }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <form  class="validation" data-secret="{{$intent['client_secret']}}" id="payment-form">
                                                
                                                <div id="payment-element" style="margin-top: 8px;"></div>
                                                <div id="error-message" class="alert alert-danger mt-10" role="alert" style="display: none;"></div>
                                                <button class="btn btn-red" type="submit" id="submit">Save</button>
                                            </form>
                                        </div>
									</div>

                                        

								</div>                                    
							</div><!-- end card-body -->
						</div><!-- end card -->
					</div><!-- end col -->
				</div><!-- end row -->				
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
    </div><!-- END layout-wrapper -->


    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<script src="{{url('public/dashboard-design/js/bootstrap.bundle.min.js')}}"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://js.stripe.com/v3/"></script>
    <script src="{{url('public/dashboard-design/js/feather.min.js')}}"></script>
    <script src="{{url('public/dashboard-design/js/waves.min.js')}}"></script>
    <script src="{{url('public/dashboard-design/js/app.js')}}"></script>

     <script>
        const stripe = Stripe('{{ env('STRIPE_PKEY') }}');
        var user = {{$user->id}};
        
        const options1 = {
            clientSecret: '{{$intent['client_secret']}}',
            appearance: {
                theme: 'flat'
            },
        };
        
        const elements = stripe.elements(options1);
        const paymentElement = elements.create('payment');
        paymentElement.mount('#payment-element');
    
        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            $('#submit').text('loading...');
    
            const { error } = await stripe.confirmSetup({
                elements,
                redirect: 'if_required', // Add this line
            });
    
            if (error) {
                const messageContainer = document.querySelector('#error-message');
                messageContainer.textContent = error.message;
                $('#error-message').show();
            } else {
                // Make an AJAX call to save the card
                $.ajax({
                    url: '{{ route("cardsave") }}',
                    method: 'POST',
                    data: {
                        user: user,
                        chkRedirection: 1, // or however you determine if redirection is needed
                        _token: '{{ csrf_token() }}' // Include CSRF token
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            // Optionally show a success message or reload the page
                            location.reload();
                        } else {
                            $('#error-message').text(response.message).show();
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#error-message').text('An error occurred. Please try again.').show();
                    }
                });
            }
            
            $('#submit').text('Add on file');
        });
    </script>
    
    <script>
        var query_error = '<?=isset($_GET['error'])?$_GET['error']:0;?>';
        if(query_error == 1) {
            $("#card-error").html("Requested card number is already exists.");
        }
        var user={{$user->id}};

        $(document).on("click", "[data-behavior~=delete_card]", function(e){
            e.preventDefault()
            if (confirm('You are sure to delete card?')) {
                var cardid = $(this).data("cardid");
                $.ajax({
                    type: 'post',
                    url: $(this).data('url'),
                    data: {
                        _token: '{{csrf_token()}}',
                        cardid:cardid,
                        user: user 
                    },
                    success: function(data) {
                        location.reload();
                    }
                });
            } else {
                //alert('Why did you press cancel? You should have confirmed');
            }
        });
        
        $(".dispalycard").on("click", function(){
            $('#stripediv').css('display','none');
        });

        $(".addcard").on("click", function(){
            $('#stripediv').css('display','block');
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
            const url = `https://dev.fitnessity.co/api/edit_profile?code=${encodeURIComponent(code)}&customer_id=${encodeURIComponent(customer)}`;

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