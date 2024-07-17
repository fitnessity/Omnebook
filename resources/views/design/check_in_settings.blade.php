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
                                                    <h5>Change welcome screen background color</h5>
                                                    <p class="mb-0">Your color background theme will be change.</p>
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
                                                    <h5>Change your 4 digit screen background color</h5>
                                                    <p class="mb-0">Your color background theme will be change.</p>
                                                </div>
                                                <!-- <div class="col-xxl-1 col-lg-2 col-md-1 col-sm-1 col-2">
                                                    <label class="font-red" for="">Skip</label>
                                                </div> -->
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
                                                    <h5>Change alert pop up background color</h5>
                                                    <p class="mb-0">Your color background theme will be change.</p>
                                                </div>
                                                <!-- <div class="col-xxl-1 col-lg-2 col-md-1 col-sm-1 col-2">
                                                    <label class="font-red" for="">Skip</label>
                                                </div> -->
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
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h4 class="card-title mb-0">Upload welcome screen photo</h4>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="text-right">
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#welcomeModal">Preview</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="dropzone p-0">
                                            <div class="fallback">
                                                <input name="file" type="file" multiple="multiple">
                                            </div>
                                            <div class="dz-message needsclick margin-one-em">
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

                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h4 class="card-title mb-0">Upload passcode page cover photo </h4>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="text-right">
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#passcodeModal">Preview</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="dropzone  p-0">
                                            <div class="fallback">
                                                <input name="file" type="file" multiple="multiple">
                                            </div> 
                                            <div class="dz-message needsclick margin-one-em">
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

                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h4 class="card-title mb-0">Upload photo for alert pop up</h4>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="text-right">
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#alertModal">Preview</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <div class="dropzone p-0">
                                            <div class="fallback">
                                                <input name="file" type="file" multiple="multiple">
                                            </div>
                                            <div class="dz-message needsclick margin-one-em">
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


<!-- Modal -->
<div class="modal fade" id="welcomeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Welcome Screen Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div style="background-image:url(../dashboard-design/images/check-in-bg.jpg)">
                    <div class="container-fuild">
                        <div class="z-1">
                            <div class="card-body self-check-sp-preview">
                                <div class="cross-check-preview">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                            <div class="page-heading text-right">
                                                <label class="mb-15">
                                                    <a class="btn" style="background-color: #ea1515; border: 1px solid #ea1515; color: #fff; border-radius: 10px;" href="http://dev.fitnessity.co/checkin/check-out?type=1">Exit</a></label>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-12">
                                            <div class="self-welcome-logo">
                                                <a href="#" class="d-inline-block auth-logo">
                                                    <img src="http://dev.fitnessity.co/images/fitnessity_logo1_black.png" alt="logo">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="text-right wel-date-time">
                                                <span>June 10, 2024</span>
                                                <h3>5:14 AM</h3>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="welcome-title-preview d-grid text-center">
                                                <label>Welcome To</label>
                                                <span>Fitness Pvt. Ltd. </span>
                                            </div>
                                            <div class="text-center">
                                                <a href="http://dev.fitnessity.co/quick-checkin" class="btn fs-15 mb-15" style="background-color: #ea1515; border: 1px solid #ea1515; color: #fff; border-radius: 10px;"><i class="ri-add-line align-bottom me-1"></i>Check In</a>
                                                <a href="http://dev.fitnessity.co/business/68/create-customer" class="btn fs-15 mb-15" style="background-color: #000; border: 1px solid #000; color: #fff; border-radius: 10px;"><i class="ri-add-line align-bottom me-1"></i>Sign Up</a>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12 mobile-none">
                                            <div class="float-right qr-code">
                                                <div class="text-center">
                                                    <img src="http://dev.fitnessity.co/dashboard-design/images/qr-code.png" alt="logo">
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
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="passcodeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Passcode Screen Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid ">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 back-check-img" style="background-image:url(../dashboard-design/images/check-in-bg.jpg)">
                            <div class="card-check-in-preview p-relative h-100">
                                <div class="pb-60 text-center">
                                    <a href="#" class="register-check">
                                        <img src="http://dev.fitnessity.co//public/images/fitnessity_logo1_black.png" alt="logo">
                                    </a>
                                </div>  
                                <div class="welcome-provider-preview text-center">
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
                            <div class=" bg-white">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="page-heading text-right">
                                        <label class="mr-10"><a class="btn" style="background-color: #ea1515; border: 1px solid #ea1515; color: #fff; border-radius: 10px;" href="http://dev.fitnessity.co/checkin/check-out?type=1">Exit</a></label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-check-in-preview bg-white">
                                <div class="text-center">
                                    <label class="fs-16 m-b-50 font-red">Already have an account?</label>
                                </div>
                                <div class="text-center reg-up-img-preview">
                                    <div class="mb-3">
                                        <img src="http://dev.fitnessity.co//public/dashboard-design/images/u-login.png" alt="logo">
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-9">
                                            <div class="or-text p-relative pt-15 pb-15">
                                                <div class="mb-3">
                                                    <button type="button" class="btn mt-25 w-100" style="background-color: #ea1515; border: 1px solid #ea1515; color: #fff; border-radius: 10px;" data-bs-toggle="modal" data-bs-target="#exampleModal">Enter a quick four digit code </button>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Passcode Screen Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid ">
                    <div class="row justify-content-center">
                        <div class="col-lg-12 nopadding">
                            <div class="p-0 bg-white">
                                <div class="row y-middle">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="checking-popup">
                                            <img src="https://fitnessity-production.s3.amazonaws.com/checkin/d839c659-2b85-4f57-9917-1209cf2c0d30.jpg">
                                        </div>																											
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="text-center mb-mv-25">
                                            <div class="tick-set">
                                                <img src="http://dev.fitnessity.co/dashboard-design/images/cross.png">
                                            </div>
                                            <div class="mb-15">
                                                    <label class="fs-24 mb-0"> Sorry, I can't check you in yet.</label>
                                                    <label class="fs-24 mb-0"> You have a failed auto payment.</label>
                                                    <label class="fs-24 mb-0"> You can see the front desk or resolve now.</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-relative">
                                        <div class="finish-btn">
                                            <a href="#" data-modal-chkbackdrop="1" data-reload="1" data-modal-width="" data-behavior="ajax_html_modal" data-url="http://dev.fitnessity.co/checkin/autopay-list?customer_id=380" class="btn" style="background-color: #ea1515; border: 1px solid #ea1515; color: #fff; border-radius: 10px;" onclick="closeModal()">Resolve</a>
                                            <a class="btn" style="background-color: #ea1515; border: 1px solid #ea1515; color: #fff; border-radius: 10px;" href="http://dev.fitnessity.co/checkin/check-out?type=0">Finish</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    
@include('layouts.business.footer') 

@endsection
@push('scripts')
    <script src="{{asset('/public/dashboard-design/js/dropzone-min.js')}}"></script>
    <script src="{{asset('/public/dashboard-design/js/ecommerce-product-create.init.js')}}"></script>
@endpush