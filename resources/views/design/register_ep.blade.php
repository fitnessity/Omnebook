@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.business.new-header')


	<div class="">
    
        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container-fuild">             
                <div class="row justify-content-center">
                    <div class="col-lg-6 back-check-img" style="background-image:url(../dashboard-design/images/check-in-bg.jpg)">
                        <div class="card-check-in p-relative h-100">
                            <div class="pb-60 text-center">
                                <a href="#" class="register-check">
                                    <img src="http://dev.fitnessity.co//public/images/fitnessity_logo1_black.png" alt="logo">
                                </a>
                            </div>   
                            <div class="welcome-provider text-center">
                                <h3>Welcome to</h3>
                                <span>Fitness Pvt. Ltd.</span>
                                <p>Please select a check-in option to the right. </p>
                            </div>   
                            <div class="self-check-arrow">
                                <i class="fas fa-long-arrow-alt-left"></i>
                            </div>                         
                        </div>
                    </div>
                    <div class="col-lg-6 nopadding">
                        <div class="card-check-in bg-white">
                            <div class="regi-qr-code">
                                <img src="http://dev.fitnessity.co//public/dashboard-design/images/qr-code.png" alt="logo">
                            </div>
                            <div class="text-center">
                                <label class="fs-16 m-b-50 font-red">Already have an account?</label>
                            </div>
                            <div class="text-center reg-up-img">
                                <div class="mb-3">
                                    <img src="http://dev.fitnessity.co//public/dashboard-design/images/u-login.png" alt="logo">
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <div class="p-relative mb-25">
                                        <form class="form">
                                            <input type="email" class="form-control" placeholder="Enter phone number or email">
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
                                    </div> 
                                </div>
                            </div>
                        </div>       
                    </div>
                </div>
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