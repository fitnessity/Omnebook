@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.business.new-header')


	<div class="page-content-register">
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>
        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div class="register-logo-middle">
                                <a href="#" class="d-inline-block auth-logo">
                                    <img src="http://dev.fitnessity.co//public/images/fitnessity_logo1_black.png" alt="logo">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-12">
                        <div class="card mt-4 z-1">
                            <div class="card-body p-4 ">
                                <div class="mt-70 mb-70 cross-check">
                                    <div class="row mt-4">
                                        <div class="col-lg-12">
                                            <div class="text-center self-check-sp">
                                                <label for="" class="fs-20 font-red mb-3">Self Check-In</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="text-center">
                                                <label class="fs-16 m-b-50 font-red">Already have an account?</label>
                                            </div>
                                            <div class="text-center reg-up-img">
                                                <div class="mb-3">
                                                <img src="http://dev.fitnessity.co//public/dashboard-design/images/u-login.png" alt="logo">
                                                </div>
                                            </div>
                                            <div class="p-relative mb-25">
                                                <form class="form">
                                                    <input type="email" class="form-control" placeholder="Enter phone number or email" />
                                                    <button type="button" class="uppercase btn btn-link inner-btn position-absolute end-0 top-0 text-decoration-none shadow-none text-muted password-addon"><i class="fas fa-arrow-right"></i></button>
                                                </form>
                                            </div>
                                            <div class="or-text p-relative pt-15 pb-15">
                                                <div class="border-bottom-or"></div>
                                                <div class="or-set-btn">
                                                    <label>OR</label>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <button type="button" class="btn-red-primary btn-red mt-25 w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">Enter a quick four digit code </button>
                                            </div>
                                            
                                           <!-- <form action="">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Enter Email Address or Phone Number</label>
                                                    <input type="text" class="form-control" id="username" placeholder="Enter phone or email">
                                                </div>
                                                <div class="mb-3">
                                                    <button type="button" class="btn-red-primary btn-red mt-15 w-100">Submit </button>
                                                </div>                            
                                            </form> -->
                                        </div>
                                        <div class="col-lg-2">
                                            <div class="border-start p-4 h-100 d-flex flex-column center-border"></div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="text-center d-grid">
                                                <label class="fs-16 font-red">New to Fitnessity</label>
                                                <label class="fs-16 m-b-50 font-red">Create A New Account</label>
                                            </div>
                                            <div class="text-center sign-up-img">
                                                <img src="http://dev.fitnessity.co//public/dashboard-design/images/reg.png" alt="logo">
                                            </div>
                                            <form action="">
                                                <div class="mb-3">
                                                    <a href="http://dev.fitnessity.co/business/68/create-customer" class="btn-red-primary btn-red w-100"><i class="ri-add-line align-bottom me-1"></i>Create Account</a>
                                                </div>                            
                                            </form>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                           
                            <!-- end card body -->
                        </div>
                        <div class="col-lg-12">
                            <div class="text-right powerby">
                                <img class="mr-15" src="http://dev.fitnessity.co//public/images/fit-logo.png" alt="logo">
                                <button type="button" class="btn btn-black" data-bs-toggle="modal" data-bs-target="#exit">Exit</button>
                            </div>
                        </div>
                        

                        <!-- end card -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

	</div><!-- End Page-content -->
</div><!-- END layout-wrapper -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-20">
			        <h2 class="font-red">Check-In</h2>
			    </div>
			    <div class="d-flex justify-content-center mb-20">
				    <input type="text" class="form-control w-50 numberfield" id="numberInput" placeholder="Enter check-in code..">
				</div>
			    <div class="container">
				    <div id="pincode_check">
					    <div class="table">
						    <div class="">
							    <div id="numbers_check">
								    <div class="grid">
										<div class="grid__col grid__col--1-of-3"><button>1</button></div>
										<div class="grid__col grid__col--1-of-3"><button>2</button></div>
										<div class="grid__col grid__col--1-of-3"><button>3</button></div>

										<div class="grid__col grid__col--1-of-3"><button>4</button></div>
										<div class="grid__col grid__col--1-of-3"><button>5</button></div>
										<div class="grid__col grid__col--1-of-3"><button>6</button></div>

										<div class="grid__col grid__col--1-of-3"><button>7</button></div>
										<div class="grid__col grid__col--1-of-3"><button>8</button></div>
										<div class="grid__col grid__col--1-of-3"><button>9</button></div>

										<div class="grid__col grid__col--1-of-3"></div>
										<div class="grid__col grid__col--1-of-3"><button>0</button></div>
										<div class="grid__col grid__col--1-of-3"></div>
							        </div>
						        </div>
						    </div>
					    </div>
				    </div>
			    </div>					
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-red">Check In</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Exit Check-In Portal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="fs-15">To deactivate the check-in portal , a staff member must enter their password. You are currently logged in as Ankita Patel.</p>
                <input type="password" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-red" data-bs-dismiss="modal">Exit Check-In Portal </button>
            </div>
        </div>
    </div>
</div>

<script>
        jQuery(document).ready(function ($) {
            var pin = +!![] + [] + (!+[] + !![] + []) + (!+[] + !![] + !![] + []) + (!+[] + !![] + !![] + !![] + []);
            var enterCode = "";
            enterCode.toString();

            $("#numbers_check button").click(function () {
                var clickedNumber = $(this).text().toString();
                enterCode = enterCode + clickedNumber;

                // Update the input field
                $("#numberInput").val(enterCode);

                var lengthCode = parseInt(enterCode.length);
                lengthCode--;
                $("#fields .numberfield:eq(" + lengthCode + ")").addClass("active");

                if (lengthCode == 3) {
                    // Check the PIN
                    if (enterCode == pin) {
                        // Right PIN!
                        $("#fields .numberfield").addClass("right");
                        $("#numbers_check").addClass("hide");
                        $("#anleitung p").html("Amazing!<br>You entered the correct Code!");
                    } else {
                        // Wrong PIN!
                        $("#fields").addClass("miss");
                        enterCode = "";
                        setTimeout(function () {
                            $("#fields .numberfield").removeClass("active");
                        }, 200);
                        setTimeout(function () {
                            $("#fields").removeClass("miss");
                        }, 500);
                    }
                }
            });

            $("#restartbtn").click(function () {
                enterCode = "";
                $("#fields .numberfield").removeClass("active");
                $("#fields .numberfield").removeClass("right");
                $("#numbers_check").removeClass("hide");
                $("#anleitung p").html("<strong>Please enter the correct PIN-Code.</strong><br> It is: 1234 / Also try a wrong code");
            });
        });
 </script>
@include('layouts.business.footer')
@endsection