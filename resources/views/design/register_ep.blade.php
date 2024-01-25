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
                                            <div class="p-relative">
                                                <form class="form">
                                                    <input type="email" class="form-control" placeholder="Enter phone number or email" />
                                                    <button type="button" class="uppercase btn btn-link inner-btn position-absolute end-0 top-0 text-decoration-none shadow-none text-muted password-addon"><i class="fas fa-arrow-right"></i></button>
                                                </form>
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
                                                    <button type="button" class="btn-red-primary btn-red w-100"><i class="ri-add-line align-bottom me-1"></i>Create Account</button>
                                                </div>                            
                                            </form>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                           
                            <!-- end card body -->
                        </div>
                        <div class="text-right">
                            <img src="http://dev.fitnessity.co//public/images/fit-logo.png" alt="logo">
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



@include('layouts.business.footer')
@endsection