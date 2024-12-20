@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.business.new-header')


	<div class="">
        <!-- auth page content -->
        <div class="auth-page-content" style="background-image:url(../dashboard-design/images/check-in-bg.jpg)">
            <div class="container-fuild">
                <div class="mt-4 z-1">
                    <div class="card-body self-check-sp ">
                        <div class="mt-70 mb-70 cross-check">
                            <div class="row mt-4">
                                <div class="col-lg-6 col-12">
                                    <div class="self-welcome-logo">
                                        <a href="#" class="d-inline-block auth-logo">
                                            <img src="http://dev.fitnessity.co//public/images/fitnessity_logo1_black.png" alt="logo">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="text-right wel-date-time">
                                        <span>March 01, 2024</span>
                                        <h3>12:00 AM</h3>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="welcome-title d-grid text-center">
                                        <label>Welcome To</label>
                                        <span>Fitness Pvt. Ltd. </span>
                                    </div>
                                    <div class="text-center">
                                        <a href="http://dev.fitnessity.co/design/register_ep" class="btn btn-red fs-15 mr-15"><i class="ri-add-line align-bottom me-1"></i>Check In</a>
                                        <a href="http://dev.fitnessity.co/business/68/create-customer" class="btn btn-black fs-15"><i class="ri-add-line align-bottom me-1"></i>Sign Up</a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 mobile-none">
                                    <div class="float-right qr-code">
                                        <div class="text-center">
                                            <img src="http://dev.fitnessity.co//public/dashboard-design/images/qr-code.png" alt="logo">
                                            <p>Scan QR Code for touchless check-in or sign-up</p>
                                        </div>                                               
                                    </div>
                                </div>
                            </div>                                   
                        </div>
                    </div>
                    <!-- end card body -->
                </div>                      
                <!-- end card -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

	</div><!-- End Page-content -->
</div><!-- END layout-wrapper -->



@include('layouts.business.footer')
@endsection