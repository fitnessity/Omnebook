@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')
	<!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
		<div class="page-content">
            <div class="container-fluid">
               <div class="row">
                  <div class="col">
                    <div class="h-100">
                        <div class="row mb-3">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="page-heading">
									<label>Check-in Settings</label>
								</div>
							</div>
							
                            <!--end col-->
						</div>
                        <!--end row-->
						
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title mb-0">Upload cover Photo</h4>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="dropzone">
                                            <div class="fallback">
                                                <input name="file" type="file" multiple="multiple">
                                            </div>
                                            <div class="dz-message needsclick">
                                                <div class="mb-3">
                                                    <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                                </div>
                                                <h4>Drop files here or click to upload.</h4>
                                            </div>
                                        </div>

                                        <ul class="list-unstyled mb-0" id="dropzone-preview">
                                            <li class="mt-2" id="dropzone-preview-list">
                                                <!-- This is used as the file preview template -->
                                                <div class="border rounded">
                                                    <div class="d-flex p-2">
                                                        <div class="flex-shrink-0 me-3">
                                                            <div class="avatar-sm bg-light rounded">
                                                                <img data-dz-thumbnail class="img-fluid rounded d-block" src="assets/images/new-document.png" alt="Dropzone-Image" />
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="pt-1">
                                                                <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                                <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                                <strong class="error text-danger" data-dz-errormessage></strong>
                                                            </div>
                                                        </div>
                                                        <div class="flex-shrink-0 ms-3">
                                                            <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <!-- end dropzon-preview -->
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->

                                <!-- <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Change Button and Text Color</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="live-preview mb-5">
                                                    <div class="d-flex flex-wrap gap-2">
                                                        <button type="button" class="btn btn-primary waves-effect waves-light mr-15">Primary</button>
                                                        <div class="nano-colorpicker"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="live-preview">
                                                    <div class="d-flex flex-wrap gap-2">
                                                        <label class="fs-15">Hello</label>
                                                        <div class="nano-colorpicker"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                                <div class="card">
                                    <div class="middle-border">
                                        <div class="card-body">
                                            <div class="row y-middle">
                                                <div class="col-xxl-1 col-lg-2 col-md-1 col-sm-1 col-2">
                                                    <div class="d-flex flex-wrap gap-2">
                                                        <div class="nano-colorpicker"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-11 col-lg-10 col-md-11 col-sm-11 col-10">
                                                    <h5>Color Theme</h5>
                                                    <p class="mb-0">Your color theme will be distributed through the buttons in your check in app</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>   
                                    
                                    <div class="middle-border">
                                        <div class="card-body">
                                            <div class="row y-middle">
                                                <div class="col-xxl-1 col-lg-2 col-md-1 col-sm-2 col-3">
                                                    <div class="profile-user position-relative d-inline-block mx-auto mb-2">
                                                        <img src="https://fitnessity-production.s3.amazonaws.com/customer/Pj5DKQgqQZvsvjBEQokyaKtuHHNHEmv0xTExXX2D.jpg" class="avatar-sm img-thumbnail user-profile-image  shadow" alt="upload-image">
                                                        <div class="avatar-xxs p-0 rounded-circle profile-photo-edit">
                                                            <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                                                            <label for="profile-img-file-input" class="profile-photo-edit logo-change avatar-xxs">
                                                                <span class="avatar-title rounded-circle bg-light text-body shadow">
                                                                    <i class="fas fa-plus"></i>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-11 col-lg-10 col-md-11 col-sm-10 col-9">
                                                    <h5>Logo</h5>
                                                    <p class="mb-0">Add a logo to show off your brand in the check in app</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="middle-border">
                                        <div class="card-body">
                                            <div class="row y-middle">
                                                <div class="col-xxl-2 col-lg-4 col-md-2 col-sm-2 col-5">
                                                    <div class="d-flex flex-wrap gap-2">
													    <select name="activity_type" data-behavior="on_change_submit" class="form-select" id="choices-publish-status-input" data-choices="" data-choices-search-false="">
														    <option value="">60 sec</option>
														    <option value="">50 sec</option>
                                                            <option value="">40 sec</option>
													    </select>																
                                                    </div>
                                                </div>
                                                <div class="col-xxl-10 col-lg-8 col-md-10 col-sm-10 col-7">
                                                    <h5>Automatically Return to Home</h5>
                                                    <p class="mb-0">After a time of inactivity, the app will return home.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    <div class="middle-border">
                                        <div class="card-body">
                                            <div class="row y-middle">
                                                <div class="col-xxl-1 col-lg-2 col-md-1 col-sm-1 col-2">
                                                    <div class="d-flex flex-wrap gap-2">
                                                        <div class="nano-colorpicker"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-10 col-lg-8 col-md-10 col-sm-10 col-8">
                                                    <h5>Change Background Color</h5>
                                                    <p class="mb-0">Your color background theme will be change.</p>
                                                </div>
                                                <div class="col-xxl-1 col-lg-2 col-md-1 col-sm-1 col-2">
                                                    <label class="font-red" for="">Skip</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                    
                                   <div class="middle-border">
                                        <div class="card-body">
                                            <div class="row y-middle">
                                                <div class="col-xxl-7 col-lg-8 col-md-10 col-sm-10 col-7">
                                                    <h5>Play Sound</h5>
                                                    <p class="mb-0">Choose if sounds play at successful or failing action </p>
                                                </div>
                                                <div class="col-xxl-5 col-lg-4 col-md-2 col-sm-2 col-5">
                                                    <div class="radio_container">
                                                        <input type="checkbox" name="radio" id="success" checked>
                                                        <label for="success">Success</label>
                                                        <input type="checkbox" name="radio" id="fail" checked>
                                                        <label for="fail">Failure</label>
                                                        <input type="checkbox" name="radio" id="none">
                                                        <label for="none">None</label>
                                                    </div>
                                                </div>                                               
                                            </div>
                                        </div>
                                    </div>

                                    <div class="middle-border">
                                        <div class="card-body">
                                            <div class="row y-middle">
                                                <div class="col-xxl-7 col-lg-8 col-md-10 col-sm-10 col-7">
                                                    <h5>Membership Purchase</h5>
                                                    <p class="mb-0">Require users to sign up for a membership at registration, or make it optional</p>
                                                </div>
                                                <div class="col-xxl-5 col-lg-4 col-md-2 col-sm-2 col-5">
                                                    <div class="radio_container">
                                                        <input type="radio" name="radio" id="one" checked>
                                                        <label for="one">None</label>
                                                        <input type="radio" name="radio" id="two">
                                                        <label for="two">Required</label>
                                                        <input type="radio" name="radio" id="three">
                                                        <label for="three">Optional</label>
                                                    </div>
                                                </div>                                               
                                            </div>
                                        </div>
                                    </div>

                                </div>  
                            </div> <!-- end col -->
                            <div class="col-lg-6">      
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
                                                    <div class="card z-1">
                                                        <div class="card-body p-4 ">
                                                            <div class="mt-70 mb-70">
                                                                <div class="row mt-4">
                                                                    <div class="col-lg-12">
                                                                        <div class="text-center self-check-sp">
                                                                            <label for="" class="fs-20 font-red mb-3">Self Check-In</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xxl-5 col-lg-12 col-md-5 col-sm-5">
                                                                        <div class="text-center">
                                                                            <label class="fs-16 m-b-50 font-red">Already have an account?</label>
                                                                        </div>
                                                                        <div class="text-center reg-up-check-setting">
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
                                                                        
                                                                    </div>
                                                                    <div class="col-xxl-2 col-lg-12 col-md-2 col-sm-2">
                                                                        <div class="border-start p-4 h-100 d-flex flex-column center-border"></div>
                                                                    </div>
                                                                    <div class="col-xxl-5 col-lg-12 col-md-5 col-sm-5">
                                                                        <div class="text-center d-grid">
                                                                            <label class="fs-16 font-red">New to Fitnessity</label>
                                                                            <label class="fs-16 m-b-50 font-red">Create A New Account</label>
                                                                        </div>
                                                                        <div class="text-center sign-up-check-settings">
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
                                                    </div>
                                                    <div class="text-right powerby">
                                                        <img src="http://dev.fitnessity.co//public/images/fit-logo.png" alt="logo">
                                                    </div>
                                                    <!-- end card -->
                                                </div>
                                            </div>
                                            <!-- end row -->
                                        </div>
                                        <!-- end container -->
                                    </div>                                                       
                                <!--<div class="card z-1">
                                    <div class="card-body p-4 ">
                                        <div class="mt-70 mb-70">
                                            <div class="row mt-4">
                                                <div class="col-lg-12">
                                                    <div class="text-center self-check-sp">
                                                        <label for="" class="fs-20 font-red mb-3">Self Check-In</label>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-5 col-lg-12 col-md-5 col-sm-5">
                                                    <div class="text-center">
                                                        <label class="fs-16 m-b-50 font-red">Already have an account?</label>
                                                    </div>
                                                    <div class="text-center reg-up-check-setting">
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
                                                    <div class="mb-3">
                                                        <button type="button" class="btn-red-primary btn-red mt-15 w-100" data-bs-toggle="modal" data-bs-target="#exampleModal">Enter a quick four digit code </button>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-xxl-2 col-lg-12 col-md-2 col-sm-2">
                                                    <div class="border-start p-4 h-100 d-flex flex-column center-border"></div>
                                                </div>
                                                <div class="col-xxl-5 col-lg-12 col-md-5 col-sm-5">
                                                    <div class="text-center d-grid">
                                                        <label class="fs-16 font-red">New to Fitnessity</label>
                                                        <label class="fs-16 m-b-50 font-red">Create A New Account</label>
                                                    </div>
                                                    <div class="text-center sign-up-check-settings">
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
                                </div>-->
                            </div>                         
                        </div>
                        <!-- end row -->	

					</div> <!-- end .h-100-->
                  </div> <!-- end col -->
                </div>
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
     </div><!-- end main content-->
</div><!-- END layout-wrapper -->
    
@include('layouts.business.footer')
	
@endsection