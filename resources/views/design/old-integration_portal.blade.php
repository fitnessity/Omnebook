@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')
@include('layouts.profile.business_topbar')

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs mb-3" role="tablist">
                                <!-- <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#widgets" role="tab" aria-selected="false">
                                        Widgets
                                    </a>
                                </li> -->
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#links" role="tab" aria-selected="false">
                                        Links
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#site_settings" role="tab" aria-selected="false">
                                        Site Settings
                                    </a>
                                </li> -->
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content  text-muted">
                                <div class="tab-pane" id="widgets" role="tabpanel">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="">
                                                <div class="card-header align-items-center d-flex">
                                                    <h4 class="card-title mb-0 flex-grow-1">Widgets</h4>
                                                </div><!-- end card header -->
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-auto">
                                                            <div class="dropdown mb-25">
                                                                <button class="btn btn-red dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Create New Widget
                                                                </button>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                    <a class="dropdown-item" href="http://dev.fitnessity.co/design/registration_widget">Registration Widget</a>
                                                                    <a class="dropdown-item" href="http://dev.fitnessity.co/design/schedule_widget">Schedule Widget</a>
                                                                    <a class="dropdown-item" href="#">Enrollment Widget</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-auto">
                                                            <div class="mb-25">
                                                                <button href="#" class="btn btn-black">Refresh Widget Data</button>
                                                            </div>                                                           
                                                        </div>                                                        
                                                    </div>
                                                    <div class="live-preview">
                                                        <div class="table-responsive">
                                                            <table class="table align-middle table-nowrap mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Widget Title</th>
                                                                        <th scope="col">Type</th>
                                                                        <th scope="col">Deployed</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th scope="row"><a href="http://dev.fitnessity.co/design/schedule_widget">Fall 2021 to 2022 Schedule</a></th>
                                                                        <td>Schedule</td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row"><a href="#">Login / Register (Default Registration Widget)</a></th>
                                                                        <td>Registration</td>
                                                                        <td></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row"><a href="#">Upcoming Events </a></th>
                                                                        <td>Enrollment</td>
                                                                        <td></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                </div><!-- end card-body -->
                                            </div><!-- end card -->
                                        </div> <!-- end col -->
                                    </div>
                                </div>
                                <div class="tab-pane  active" id="links" role="tabpanel">
                                    <div class="card bg-soft-grey ">
                                        <div class="card-header align-items-center d-flex bg-soft-grey">
                                            <h4 class="card-title mb-0 flex-grow-1">Create your link</h4>
                                        </div>

                                        <div class="card-body">
                                            <div class="live-preview">
                                                <div class="row ">
                                                    <div class="col-lg-3">
                                                        <div class="mt-3 filter-check">
                                                            <label for="">Link type</label>
                                                            <select class="form-select mb-3" id="selectField">
                                                                <option selected="selected">Select...</option>
                                                                <option value="option1">Login</option>     
                                                                <option value="option2">Register</option>  
                                                                <option value="option3">Booking Schedule</option>                                                       
                                                            </select>
                                                        </div>
                                                    </div>                                                  
                                                </div>
                                                <div id="option1" class="lrcontent">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <div class="mt-3 filter-check">
                                                                                <label for="">Text Color</label>
                                                                            </div>
                                                                            <div class="d-flex flex-wrap gap-2">
                                                                            <div class="pickr">
                                                                                <button type="button" class="pcr-button" role="button" aria-label="toggle color picker dialog" style="--pcr-color: rgba(156, 39, 176, 1);"></button>
                                                                            </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="mt-3 filter-check">
                                                                                <label for="">Background Color</label>
                                                                            </div>
                                                                            <div class="d-flex flex-wrap gap-2">
                                                                                <div class="pickr">
                                                                                    <button type="button" class="pcr-button" role="button" aria-label="toggle color picker dialog" style="--pcr-color: rgba(244, 67, 54, 1);"></button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- <div class="col-lg-6 col-md-6 col-12">
                                                                            <div class="mt-3 filter-check">
                                                                                <label for="">Background Image </label>
                                                                                <input class="form-control" type="file" id="formFileMultiple" multiple="">
                                                                            </div>
                                                                        </div> -->
                                                                        
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-12">
                                                                            <div class="mt-3 filter-check">
                                                                                <label for="">Upload Logo</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="profile-user position-relative mx-auto mb-2">
                                                                                <img src="http://dev.fitnessity.co/public/images/fitnessity_logo1_black.png" class="avatar-lg img-thumbnail user-profile-image shadow" alt="upload-image">
                                                                                <div class="avatar-xxs p-0 rounded-circle profile-photo-edit">
                                                                                    <input id="profile-img-file-input" type="file" class="profile-img-file-input" name="logo">
                                                                                    <label for="profile-img-file-input" class="profile-photo-edit logo-change avatar-xxs">
                                                                                        <span class="avatar-title rounded-circle bg-light text-body shadow">
                                                                                            <i class="fas fa-plus"></i>
                                                                                        </span>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    
                                                                    <div class="row">
                                                                        <div class="col-lg-6">
                                                                            <h4 class="card-title mb-0">Upload Login screen photo</h4>
                                                                        </div>
                                                                        <div class="col-lg-6">
                                                                            <div class="text-right">
                                                                                <a href="" data-bs-toggle="modal" data-bs-target="#login_preview">Preview</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end card header -->

                                                                <div class="card-body">
                                                                    <div class="dropzone dz-clickable">
                                                                        <div class="dz-message login-preview-modal needsclick">
                                                                            <div class="mb-3">
                                                                                <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                                                            </div>
                                                                            <h4>Drop files here or click to upload.</h4>
                                                                        </div>
                                                                    </div>

                                                                    <ul class="list-unstyled mb-0" id="dropzone-preview">
                                                                        <li class="mt-2" id="ddropzone-preview">
                                                                            <input type="hidden" name="cover" value="checkin-settings/3357c1a8-a38e-4196-9b5f-701def5d16ca.jpg">
                                                                            <div class="border rounded">
                                                                                <div class="d-flex p-2">
                                                                                    <div class="flex-shrink-0 me-3">
                                                                                        <div class="avatar-sm bg-light rounded product-display">
                                                                                            <img class="img-fluid rounded d-block" src="https://fitnessity-production.s3.amazonaws.com/checkin-settings/3357c1a8-a38e-4196-9b5f-701def5d16ca.jpg" alt="Product-Image">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="flex-grow-1">
                                                                                        <div class="pt-1">
                                                                                            <h5 class="fs-14 mb-1">&nbsp;3357c1a8-a38e-4196-9b5f-701def5d16ca.jpg</h5>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="flex-shrink-0 ms-3">
                                                                                        <button class="btn btn-sm btn-danger delete-btn" type="button">Delete</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                    <!-- end dropzon-preview -->
                                                                </div>
                                                                <!-- end card body -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div id="option2" class="lrcontent">
                                                    <div class="row">
                                                        <div class="col-xl-3 col-lg-4">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <div class="d-flex">
                                                                        <div class="flex-grow-1">
                                                                            <h5 class="fs-16">Registration Link Settings</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="accordion accordion-flush filter-accordion">
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="flush-headingBrands">
                                                                            <button class="accordion-button bg-transparent shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseBrands" aria-expanded="true" aria-controls="flush-collapseBrands">
                                                                                <span class="text-muted text-uppercase fs-12 fw-medium">Style</span> <span class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                                                                            </button>
                                                                        </h2>

                                                                        <div id="flush-collapseBrands" class="accordion-collapse collapse show" aria-labelledby="flush-headingBrands">
                                                                            <div class="accordion-body text-body pt-0">
                                                                               
                                                                                <div class="gap-2 mt-3 filter-check">
                                                                                    <label for="">Colors</label>
                                                                                    <p>By not setting a color, the defaults will be used.</p>
                                                                                    <label for="">Text Color</label>
                                                                                    <div class="pickr mb-15">
                                                                                        <button type="button" class="pcr-button w-100" role="button" aria-label="toggle color picker dialog" style="--pcr-color: rgba(244, 67, 54, 1);"></button>
                                                                                    </div>
                                                                                    <label for="">Button Background</label>
                                                                                    <div class="pickr mb-15">
                                                                                        <button type="button" class="pcr-button w-100" role="button" aria-label="toggle color picker dialog" style="--pcr-color: rgba(156, 39, 176, 1);"></button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>                                    
                                                                        </div>
                                                                    </div>
                                                                    <!-- end accordion-item -->    
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="flush-headingDiscount">
                                                                            <button class="accordion-button bg-transparent shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseDiscount" aria-expanded="true" aria-controls="flush-collapseDiscount">
                                                                                <span class="text-muted text-uppercase fs-12 fw-medium">Content</span> <span class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                                                                            </button>
                                                                        </h2>
                                                                        <div id="flush-collapseDiscount" class="accordion-collapse collapse" aria-labelledby="flush-headingDiscount">
                                                                            <div class="accordion-body text-body pt-1">
                                                                                <div class="gap-2 mt-3 filter-check">
                                                                                    <label for="">Send Email Notifications</label>
                                                                                    <div>
                                                                                        <button href="#" class="btn btn-red mb-15"><i class="ri-add-line align-bottom me-1"></i> Add an email</button>  
                                                                                        <p>When a new registration is added or a duplicate email is detected, we will send a notification email to these addresses. </p>
                                                                                    </div>                                                                                  
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end accordion-item -->                            
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="flush-headingRating">
                                                                            <button class="accordion-button bg-transparent shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseRating" aria-expanded="false" aria-controls="flush-collapseRating">
                                                                                <span class="text-muted text-uppercase fs-12 fw-medium">Region</span> <span class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                                                                            </button>
                                                                        </h2>

                                                                        <div id="flush-collapseRating" class="accordion-collapse collapse" aria-labelledby="flush-headingRating">
                                                                            <div class="accordion-body text-body">
                                                                                <div class="gap-2 filter-check">
                                                                                    <label for="">Language</label>
                                                                                    <select class="form-select mb-3" aria-label="Default select example">
                                                                                        <option selected="">English </option>
                                                                                        <option value="1">Hindi </option>
                                                                                        <option value="2">Arabela </option>
                                                                                        <option value="3">Egyptian Arabic </option>
                                                                                        <option value="3">Auslan </option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="gap-2 filter-check">
                                                                                    <label for="">Default Selected Country</label>
                                                                                    <select class="form-select mb-3" aria-label="Default select example">
                                                                                        <option selected="">United States </option>
                                                                                        <option value="1">Canada </option>
                                                                                        <option value="2">India </option>
                                                                                    </select>
                                                                                </div>
                                                                                <div class="gap-2 filter-check">
                                                                                    <label for="">Default Selected State</label>
                                                                                    <select class="form-select mb-3" aria-label="Default select example">
                                                                                        <option selected="">None Selected </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <!-- end accordion-item -->
                                                                </div>
                                                                <div class="card-footer">
                                                                    <div class="d-flex mt-3 mb-3">
                                                                        <div class="flex-grow-1">
                                                                            <a href="http://dev.fitnessity.co/design/deploy_widget" class="btn btn-black w-100">Save and Deploy</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-9 col-lg-8">
                                                            <div class="card">
                                                                <div class="card-header align-items-center d-flex">
                                                                    <h4 class="card-title mb-0 flex-grow-1">Preview</h4>
                                                                    <div class="flex-shrink-0">
                                                                        <div>
                                                                            
                                                                        </div>
                                                                        <div class="form-check form-switch form-switch-right form-switch-md">
                                                                            <label for="dropdown-base-example" class="form-label text-muted">Preview Size</label>
                                                                            <input class="form-check-input code-switcher" type="checkbox" id="dropdown-base-example">
                                                                        </div>
                                                                    </div>
                                                                </div><!-- end card header -->

                                                                <div class="card-body">
                                                                    <div class="live-preview">
                                                                        <div class="row justify-content-md-center">
                                                                            <div class="col-lg-10">
                                                                                <form action="">
                                                                                    <div class="row ">
                                                                                        <div class="col-md-12 col-lg-12"><h4 class="font-red ">Personal Info</h4></div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10 ">First Name<span id="star">*</span></label>
                                                                                            <input type="text" name="firstname" id="firstname" size="30" maxlength="80" class="form-control">
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Last Name<span id="star">*</span></label>
                                                                                            <input type="text" name="lastname" id="lastname" size="30" maxlength="80" class="form-control">
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Email<span id="star">*</span></label>
                                                                                            <input type="email" name="email" id="email" class="myemail form-control" size="30" maxlength="80" autocomplete="off">
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Birthday<span id="star">*</span></label>
                                                                                            <input type="hidden" class="form-control add-client-birthdate flatpickr-input" id="dob" name="dob"><input class="form-control add-client-birthdate form-control input" placeholder="" tabindex="0" type="text" readonly="readonly">
                                                                                        </div>

                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Phone <span id="star">*</span></label>
                                                                                            <input type="text" name="contact" id="contact" size="30" maxlength="14" autocomplete="off" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone" class="form-control">
                                                                                        </div>

                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Gender<span id="star">*</span></label>
                                                                                            <select class="form-control" name="gender">
                                                                                                <option value="male">Male</option>
                                                                                                <option value="female">Female</option>
                                                                                                <option value="other">Other</option>
                                                                                            </select>
                                                                                        </div>
                                                                                                    
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <div class="form-group check-box-info ">
                                                                                                <input class="check-box-primary-account" type="checkbox" id="primaryAccountHolder" name="primaryAccountHolder" value="1">
                                                                                                <label for="primaryAccountHolder"> Primary Account <span class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="You are paying for yourself and all added family members.">(i)</span></label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="add-client-sapre-tor"></div>

                                                                                    <div class="row">
                                                                                        <div class="col-md-12 col-lg-12"><h4 class="font-red ">Address</h4></div>
                                                                                        <div class="col-md-4 col-lg-3 mt-10">
                                                                                            <label>Address <span id="star">*</span></label>
                                                                                            <input type="text" class="form-control pac-target-input" autocomplete="off" name="address" id="addressCustomer" value="" required="" oninput="initMapCall('addressCustomer', 'cityCustomer', 'stateCustomer', 'countryCustomer', 'zipcodeCustomer', 'latitudeCustomer', 'longitudeCustomer')" aria-required="true"> 
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3 mt-10">
                                                                                            <label for="City">City <span id="star">*</span></label>
                                                                                            <input type="text" class="form-control" name="city" id="cityCustomer" size="30" maxlength="50" value="" required="" aria-required="true">
                                                                                        </div>
                                                                                        <input type="hidden" name="lon" id="longitudeCustomer" value="">
                                                                                        <input type="hidden" name="lat" id="latitudeCustomer" value="">

                                                                                        <div class="col-md-4 col-lg-3 mt-10">
                                                                                            <label for="state">State <span id="star">*</span></label>
                                                                                            <input type="text" class="form-control" name="state" id="stateCustomer" size="30" maxlength="50" value="" required="" aria-required="true">
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3 mt-10">
                                                                                            <label for="country">Country <span id="star">*</span></label>
                                                                                            <input type="text" class="form-control" name="country" id="countryCustomer" size="30" maxlength="50" value="" required="" aria-required="true">
                                                                                        </div> 

                                                                                        <div class="col-md-4 col-lg-3 mt-10">
                                                                                            <label for="zipcode">Zip Code <span id="star">*</span></label>
                                                                                            <input type="text" class="form-control" name="zipcode" id="zipcodeCustomer" size="30" maxlength="50" value="" required="" aria-required="true">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="add-client-sapre-tor"></div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 col-lg-12 mt-20"><h4 class="font-red ">Add Family Members (Optional)</h4></div>
                                                                                        <div class="error mb-10" id="familyerrormessage"></div>
                                                                                        <input type="hidden" name="familycnt" id="familycnt" value="0">
                                                                                        <div id="familymaindiv">
                                                                                            <div class="new-client mb-10" id="familydiv0" data-i="0" data-text="1">
                                                                                                <div class="accordion" id="default-accordion-example">
                                                                                                    <div class="accordion-item shadow">
                                                                                                        <h2 class="accordion-header" id="heading0">
                                                                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse0" aria-expanded="false" aria-controls="collapse0">
                                                                                                                <div class="container-fluid nopadding">
                                                                                                                    <div class="row"> 
                                                                                                                        <div class="col-lg-6 col-md-6 col-8"> Family Member #1 </div> 
                                                                                                                        <div class="col-lg-6 col-md-6 col-4"> 
                                                                                                                            <div class="multiple-options" id="deletediv0"> </div> 
                                                                                                                        </div> 
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </button>
                                                                                                        </h2>
                                                                                                        <div id="collapse0" class="accordion-collapse collapse" aria-labelledby="heading0" data-bs-parent="#default-accordion-example" style="">
                                                                                                            <div class="accordion-body">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">First Name</label>
                                                                                                                        <input type="text" name="fname[]" id="fname" class="form-control required" aria-required="true">
                                                                                                                        <span class="error" id="err_fname"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Last Name</label>
                                                                                                                        <input type="text" name="lname[]" id="lname" class="form-control required" aria-required="true">
                                                                                                                        <span class="error" id="err_lname"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Birthday</label>
                                                                                                                        <input type="text" class="form-control" name="birthdate[]" id="birthdate">
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Gender</label>
                                                                                                                        <select name="familygender[]" id="gender" class="form-select gender" required="" aria-required="true">
                                                                                                                            <option value="male">Male</option>
                                                                                                                            <option value="female">Female</option>
                                                                                                                            <option value="other">Specify other</option>
                                                                                                                        </select>
                                                                                                                        <span class="error" id="err_gender"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Relationship</label>
                                                                                                                        <select name="relationship[]" id="relationship" class="form-select relationship required" aria-required="true">
                                                                                                                            <option value="">Select Relationship</option>
                                                                                                                            <option value="Brother">Brother</option>
                                                                                                                            <option value="Sister">Sister</option>
                                                                                                                            <option value="Father">Father</option>
                                                                                                                            <option value="Mother">Mother</option>
                                                                                                                            <option value="Wife">Wife</option>
                                                                                                                            <option value="Husband">Husband</option>
                                                                                                                            <option value="Son">Son</option>
                                                                                                                            <option value="Daughter">Daughter</option>
                                                                                                                        </select>
                                                                                                                        <span class="error" id="err_relationship"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Phone</label>
                                                                                                                        <input maxlength="14" type="text" name="mphone[]" id="mphone" class="form-control mobile_number" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
                                                                                                                        <span class="error" id="err_mphone"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Email</label>
                                                                                                                        <input type="email" name="emailid[]" id="emailid" class="form-control email" required="" aria-required="true">
                                                                                                                        <span class="error" id="err_emailid"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Emergency Name</label>
                                                                                                                        <input type="text" name="emergency_name[]" id="emergency_name" class="form-control emergency_name">
                                                                                                                        <span class="error" id="err_emergency_name"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Emergency Phone</label>
                                                                                                                        <input maxlength="14" type="text" name="emergency_phone[]" id="emergency_phone" class="form-control emergency_phone" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
                                                                                                                        <span class="error" id="err_emergency_phone"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Emergency Email</label>
                                                                                                                        <input type="text" name="emergency_email[]" id="emergency_email" class="form-control emergency_email">
                                                                                                                        <span class="error" id="err_emergency_email"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Emergency Relation</label>
                                                                                                                        <select name="emergency_relation[]" id="emergency_relation" class="form-select emergency_relation">
                                                                                                                            <option value="">Select Emergency Relationship</option>
                                                                                                                            <option value="Brother">Brother</option>
                                                                                                                            <option value="Sister">Sister</option>
                                                                                                                            <option value="Father">Father</option>
                                                                                                                            <option value="Mother">Mother</option>
                                                                                                                            <option value="Wife">Wife</option>
                                                                                                                            <option value="Husband">Husband</option>
                                                                                                                            <option value="Son">Son</option>
                                                                                                                            <option value="Daughter">Daughter</option>
                                                                                                                        </select>
                                                                                                                        <span class="error" id="err_emergency_relation"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3"> 
                                                                                                                        <div class="form-group check-box-info">
                                                                                                                            <input class="check-box-primary-account primaryAcCheck" type="checkbox" id="primaryAccount" name="primaryAccount" value="1">
                                                                                                                            <label for="primaryAccount"> Primary Account <span class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Choose the primary account holder to determine whose card covers bookings for up to two family members (e.g., Mom or Dad). All cards stored under the primary account will be available at checkout.">(i)</span></label>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="">
                                                                                            <div class="col-md-12 col-lg-12 text-right">
                                                                                                <button type="button" class="btn btn-red mt-10" id="add_family">Add New Family Member</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="add-client-sapre-tor"></div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 col-lg-12 mt-20"><h4 class="font-red ">How did you hear about us</h4></div>
                                                                                        <div class="row">
                                                                                            <div class="col-md-4 col-lg-4 mt-10">
                                                                                                <label class="mt-10">How did you hear about us?</label>
                                                                                                <select class="form-select" name="know_from">
                                                                                                    <option value="male">Search engine (Google, Bing, etc)</option>
                                                                                                    <option value="Google maps search">Google maps search</option>
                                                                                                    <option value="Referral">Referral</option>
                                                                                                    <option value="Social media">Social media</option>
                                                                                                    <option value="Online communities / forums">Online communities / forums</option>
                                                                                                    <option value="Online advertisement">Online advertisement</option>
                                                                                                    <option value="Offine advertisement">Offine advertisement</option>
                                                                                                    <option value="Noticed the physical location">Noticed the physical location</option>
                                                                                                    <option value="Website">Website</option>
                                                                                                    <option value="Event">Event</option>
                                                                                                    <option value="School">School</option>
                                                                                                    <option value="Other">Other</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="add-client-sapre-tor"></div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 col-lg-12 mt-20"><h4 class="font-red ">Account Password</h4></div>
                                                                                        <div class="row">
                                                                                            <label class="mt-10">Please pick a password to log-in to your account later.</label>
                                                                                            <div class="col-md-4 col-lg-3 mt-10">
                                                                                                <label class="mt-10">Password</label>
                                                                                                <input type="text" name="password" id="password" class="form-control">
                                                                                            </div>
                                                                                            <div class="col-md-4 col-lg-3 mt-10">
                                                                                                <label class="mt-10">Confirm Password</label>
                                                                                                <input type="text" name="confirmpassword" id="confirmpassword" class="form-control">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="add-client-sapre-tor"></div>
                                                                                    <div class="row"> 
                                                                                        <div class="col-md-12 col-lg-12 mt-20">
                                                                                            <h4 class="font-red "> Agree to Terms, Waiver &amp; Contract Signature</h4>
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <div class="col-lg-12" id="termsdiv">
                                                                                                <div class="terms-head">
                                                                                                    <div>
                                                                                                        <a href="#" data-url="http://dev.fitnessity.co/getTerms?id=29&amp;termsType=refundpolicytext&amp;termsHeader=Refund%20Policy" class="font-13 color-red-a" data-behavior="termsModelOpen">Refund Policy</a> 
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <label class="mt-10">To continue, please read the terms &amp; waivers above. A signature is required to participate. </label>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12">
                                                                                                <canvas id="signatureCanvas" name="signatureCanvas"></canvas>
                                                                                                <input type="hidden" name="signpath" id="signpath" value="">
                                                                                            </div>
                                                                                            <div class="col-lg-12">
                                                                                                <div class="col-md-4 col-lg-3 col-lg-3">
                                                                                                    <button type="button" id="clearButton" class="btn btn-primary btn-black">Clear</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 col-lg-12 text-center">
                                                                                            <div class="wrap-sp">
                                                                                                <input type="checkbox" name="b_trm1" id="b_trm1" class="form-check-input" value="1">
                                                                                                <label for="b_trm1" class="text-center">I agree to Fitnessity Terms of Service and Privacy Policy</label>
                                                                                            </div>
                                                                                            <div id="termserror" class="font-red fs-15 text-center mb-10"></div>
                                                                                            <div id="systemMessage" class="mb-10 fs-15 mb-10"></div>
                                                                                        </div>
                                                                                        <div class="col-md-12 col-lg-12 text-center">
                                                                                            <button type="button" class="btn btn-red register_submit" id="register_submit" onclick="getType('submit');">Add Credit Card</button>
                                                                                            <button type="button" class="btn btn-red register_submit" id="register_skip" data-type="skip" onclick="getType('skip');">Skip</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="d-none code-view">
                                                                        <div class="row justify-content-md-center">
                                                                            <div class="col-lg-7">
                                                                                <form action="">
                                                                                    <div class="row ">
                                                                                        <div class="col-md-12 col-lg-12"><h4 class="font-red ">Personal Info</h4></div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10 ">First Name<span id="star">*</span></label>
                                                                                            <input type="text" name="firstname" id="firstname" size="30" maxlength="80" class="form-control">
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Last Name<span id="star">*</span></label>
                                                                                            <input type="text" name="lastname" id="lastname" size="30" maxlength="80" class="form-control">
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Email<span id="star">*</span></label>
                                                                                            <input type="email" name="email" id="email" class="myemail form-control" size="30" maxlength="80" autocomplete="off">
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Birthday<span id="star">*</span></label>
                                                                                            <input type="hidden" class="form-control add-client-birthdate flatpickr-input" id="dob" name="dob"><input class="form-control add-client-birthdate form-control input" placeholder="" tabindex="0" type="text" readonly="readonly">
                                                                                        </div>

                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Phone <span id="star">*</span></label>
                                                                                            <input type="text" name="contact" id="contact" size="30" maxlength="14" autocomplete="off" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone" class="form-control">
                                                                                        </div>

                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <label class="mt-10">Gender<span id="star">*</span></label>
                                                                                            <select class="form-control" name="gender">
                                                                                                <option value="male">Male</option>
                                                                                                <option value="female">Female</option>
                                                                                                <option value="other">Other</option>
                                                                                            </select>
                                                                                        </div>
                                                                                                    
                                                                                        <div class="col-md-4 col-lg-3">
                                                                                            <div class="form-group check-box-info ">
                                                                                                <input class="check-box-primary-account" type="checkbox" id="primaryAccountHolder" name="primaryAccountHolder" value="1">
                                                                                                <label for="primaryAccountHolder"> Primary Account <span class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="You are paying for yourself and all added family members.">(i)</span></label>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="add-client-sapre-tor"></div>

                                                                                    <div class="row">
                                                                                        <div class="col-md-12 col-lg-12"><h4 class="font-red ">Address</h4></div>
                                                                                        <div class="col-md-4 col-lg-3 mt-10">
                                                                                            <label>Address <span id="star">*</span></label>
                                                                                            <input type="text" class="form-control pac-target-input" autocomplete="off" name="address" id="addressCustomer" value="" required="" oninput="initMapCall('addressCustomer', 'cityCustomer', 'stateCustomer', 'countryCustomer', 'zipcodeCustomer', 'latitudeCustomer', 'longitudeCustomer')" aria-required="true"> 
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3 mt-10">
                                                                                            <label for="City">City <span id="star">*</span></label>
                                                                                            <input type="text" class="form-control" name="city" id="cityCustomer" size="30" maxlength="50" value="" required="" aria-required="true">
                                                                                        </div>
                                                                                        <input type="hidden" name="lon" id="longitudeCustomer" value="">
                                                                                        <input type="hidden" name="lat" id="latitudeCustomer" value="">

                                                                                        <div class="col-md-4 col-lg-3 mt-10">
                                                                                            <label for="state">State <span id="star">*</span></label>
                                                                                            <input type="text" class="form-control" name="state" id="stateCustomer" size="30" maxlength="50" value="" required="" aria-required="true">
                                                                                        </div>
                                                                                        <div class="col-md-4 col-lg-3 mt-10">
                                                                                            <label for="country">Country <span id="star">*</span></label>
                                                                                            <input type="text" class="form-control" name="country" id="countryCustomer" size="30" maxlength="50" value="" required="" aria-required="true">
                                                                                        </div> 

                                                                                        <div class="col-md-4 col-lg-3 mt-10">
                                                                                            <label for="zipcode">Zip Code <span id="star">*</span></label>
                                                                                            <input type="text" class="form-control" name="zipcode" id="zipcodeCustomer" size="30" maxlength="50" value="" required="" aria-required="true">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="add-client-sapre-tor"></div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 col-lg-12 mt-20"><h4 class="font-red ">Add Family Members (Optional)</h4></div>
                                                                                        <div class="error mb-10" id="familyerrormessage"></div>
                                                                                        <input type="hidden" name="familycnt" id="familycnt" value="0">
                                                                                        <div id="familymaindiv">
                                                                                            <div class="new-client mb-10" id="familydiv0" data-i="0" data-text="1">
                                                                                                <div class="accordion" id="default-accordion-example">
                                                                                                    <div class="accordion-item shadow">
                                                                                                        <h2 class="accordion-header" id="heading0">
                                                                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse0" aria-expanded="false" aria-controls="collapse0">
                                                                                                                <div class="container-fluid nopadding">
                                                                                                                    <div class="row"> 
                                                                                                                        <div class="col-lg-6 col-md-6 col-8"> Family Member #1 </div> 
                                                                                                                        <div class="col-lg-6 col-md-6 col-4"> 
                                                                                                                            <div class="multiple-options" id="deletediv0"> </div> 
                                                                                                                        </div> 
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </button>
                                                                                                        </h2>
                                                                                                        <div id="collapse0" class="accordion-collapse collapse" aria-labelledby="heading0" data-bs-parent="#default-accordion-example" style="">
                                                                                                            <div class="accordion-body">
                                                                                                                <div class="row">
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">First Name</label>
                                                                                                                        <input type="text" name="fname[]" id="fname" class="form-control required" aria-required="true">
                                                                                                                        <span class="error" id="err_fname"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Last Name</label>
                                                                                                                        <input type="text" name="lname[]" id="lname" class="form-control required" aria-required="true">
                                                                                                                        <span class="error" id="err_lname"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Birthday</label>
                                                                                                                        <input type="text" class="form-control" name="birthdate[]" id="birthdate">
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Gender</label>
                                                                                                                        <select name="familygender[]" id="gender" class="form-select gender" required="" aria-required="true">
                                                                                                                            <option value="male">Male</option>
                                                                                                                            <option value="female">Female</option>
                                                                                                                            <option value="other">Specify other</option>
                                                                                                                        </select>
                                                                                                                        <span class="error" id="err_gender"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Relationship</label>
                                                                                                                        <select name="relationship[]" id="relationship" class="form-select relationship required" aria-required="true">
                                                                                                                            <option value="">Select Relationship</option>
                                                                                                                            <option value="Brother">Brother</option>
                                                                                                                            <option value="Sister">Sister</option>
                                                                                                                            <option value="Father">Father</option>
                                                                                                                            <option value="Mother">Mother</option>
                                                                                                                            <option value="Wife">Wife</option>
                                                                                                                            <option value="Husband">Husband</option>
                                                                                                                            <option value="Son">Son</option>
                                                                                                                            <option value="Daughter">Daughter</option>
                                                                                                                        </select>
                                                                                                                        <span class="error" id="err_relationship"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Phone</label>
                                                                                                                        <input maxlength="14" type="text" name="mphone[]" id="mphone" class="form-control mobile_number" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
                                                                                                                        <span class="error" id="err_mphone"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Email</label>
                                                                                                                        <input type="email" name="emailid[]" id="emailid" class="form-control email" required="" aria-required="true">
                                                                                                                        <span class="error" id="err_emailid"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Emergency Name</label>
                                                                                                                        <input type="text" name="emergency_name[]" id="emergency_name" class="form-control emergency_name">
                                                                                                                        <span class="error" id="err_emergency_name"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Emergency Phone</label>
                                                                                                                        <input maxlength="14" type="text" name="emergency_phone[]" id="emergency_phone" class="form-control emergency_phone" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
                                                                                                                        <span class="error" id="err_emergency_phone"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Emergency Email</label>
                                                                                                                        <input type="text" name="emergency_email[]" id="emergency_email" class="form-control emergency_email">
                                                                                                                        <span class="error" id="err_emergency_email"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3">
                                                                                                                        <label class="mt-10">Emergency Relation</label>
                                                                                                                        <select name="emergency_relation[]" id="emergency_relation" class="form-select emergency_relation">
                                                                                                                            <option value="">Select Emergency Relationship</option>
                                                                                                                            <option value="Brother">Brother</option>
                                                                                                                            <option value="Sister">Sister</option>
                                                                                                                            <option value="Father">Father</option>
                                                                                                                            <option value="Mother">Mother</option>
                                                                                                                            <option value="Wife">Wife</option>
                                                                                                                            <option value="Husband">Husband</option>
                                                                                                                            <option value="Son">Son</option>
                                                                                                                            <option value="Daughter">Daughter</option>
                                                                                                                        </select>
                                                                                                                        <span class="error" id="err_emergency_relation"></span>
                                                                                                                    </div>
                                                                                                                    <div class="col-md-4 col-lg-3"> 
                                                                                                                        <div class="form-group check-box-info">
                                                                                                                            <input class="check-box-primary-account primaryAcCheck" type="checkbox" id="primaryAccount" name="primaryAccount" value="1">
                                                                                                                            <label for="primaryAccount"> Primary Account <span class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Choose the primary account holder to determine whose card covers bookings for up to two family members (e.g., Mom or Dad). All cards stored under the primary account will be available at checkout.">(i)</span></label>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="">
                                                                                            <div class="col-md-12 col-lg-12 text-right">
                                                                                                <button type="button" class="btn btn-red mt-10" id="add_family">Add New Family Member</button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="add-client-sapre-tor"></div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 col-lg-12 mt-20"><h4 class="font-red ">How did you hear about us</h4></div>
                                                                                        <div class="row">
                                                                                            <div class="col-md-4 col-lg-5 mt-10">
                                                                                                <label class="mt-10">How did you hear about us?</label>
                                                                                                <select class="form-select" name="know_from">
                                                                                                    <option value="male">Search engine (Google, Bing, etc)</option>
                                                                                                    <option value="Google maps search">Google maps search</option>
                                                                                                    <option value="Referral">Referral</option>
                                                                                                    <option value="Social media">Social media</option>
                                                                                                    <option value="Online communities / forums">Online communities / forums</option>
                                                                                                    <option value="Online advertisement">Online advertisement</option>
                                                                                                    <option value="Offine advertisement">Offine advertisement</option>
                                                                                                    <option value="Noticed the physical location">Noticed the physical location</option>
                                                                                                    <option value="Website">Website</option>
                                                                                                    <option value="Event">Event</option>
                                                                                                    <option value="School">School</option>
                                                                                                    <option value="Other">Other</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="add-client-sapre-tor"></div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 col-lg-12 mt-20"><h4 class="font-red ">Account Password</h4></div>
                                                                                        <div class="row">
                                                                                            <label class="mt-10">Please pick a password to log-in to your account later.</label>
                                                                                            <div class="col-md-4 col-lg-4 mt-10">
                                                                                                <label class="mt-10">Password</label>
                                                                                                <input type="text" name="password" id="password" class="form-control">
                                                                                            </div>
                                                                                            <div class="col-md-4 col-lg-4 mt-10">
                                                                                                <label class="mt-10">Confirm Password</label>
                                                                                                <input type="text" name="confirmpassword" id="confirmpassword" class="form-control">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="add-client-sapre-tor"></div>
                                                                                    <div class="row"> 
                                                                                        <div class="col-md-12 col-lg-12 mt-20">
                                                                                            <h4 class="font-red "> Agree to Terms, Waiver &amp; Contract Signature</h4>
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <div class="col-lg-12" id="termsdiv">
                                                                                                <div class="terms-head">
                                                                                                    <div>
                                                                                                        <a href="#" data-url="http://dev.fitnessity.co/getTerms?id=29&amp;termsType=refundpolicytext&amp;termsHeader=Refund%20Policy" class="font-13 color-red-a" data-behavior="termsModelOpen">Refund Policy</a> 
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <label class="mt-10">To continue, please read the terms &amp; waivers above. A signature is required to participate. </label>
                                                                                        <div class="row">
                                                                                            <div class="col-lg-12">
                                                                                                <canvas id="signatureCanvas" name="signatureCanvas"></canvas>
                                                                                                <input type="hidden" name="signpath" id="signpath" value="">
                                                                                            </div>
                                                                                            <div class="col-lg-12">
                                                                                                <div class="col-md-4 col-lg-3 col-lg-3">
                                                                                                    <button type="button" id="clearButton" class="btn btn-primary btn-black">Clear</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 col-lg-12 text-center">
                                                                                            <div class="wrap-sp">
                                                                                                <input type="checkbox" name="b_trm1" id="b_trm1" class="form-check-input" value="1">
                                                                                                <label for="b_trm1" class="text-center">I agree to Fitnessity Terms of Service and Privacy Policy</label>
                                                                                            </div>
                                                                                            <div id="termserror" class="font-red fs-15 text-center mb-10"></div>
                                                                                            <div id="systemMessage" class="mb-10 fs-15 mb-10"></div>
                                                                                        </div>
                                                                                        <div class="col-md-12 col-lg-12 text-center">
                                                                                            <button type="button" class="btn btn-red register_submit" id="register_submit" onclick="getType('submit');">Add Credit Card</button>
                                                                                            <button type="button" class="btn btn-red register_submit" id="register_skip" data-type="skip" onclick="getType('skip');">Skip</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div><!-- end card-body -->
                                                            </div><!-- end card -->
                                                        </div> <!-- end col -->
                                                    </div> <!-- end row-->
                                                </div>
                                                <div id="option3" class="lrcontent">
                                                    <div class="row">
                                                        <div class="col-xl-3 col-lg-4">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <div class="d-flex mb-3">
                                                                        <div class="flex-grow-1">
                                                                            <h5 class="fs-16">Widget Settings</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="accordion accordion-flush filter-accordion">
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="flush-headingBrands">
                                                                            <button class="accordion-button bg-transparent shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseBrands" aria-expanded="true" aria-controls="flush-collapseBrands">
                                                                                <span class="text-muted text-uppercase fs-12 fw-medium">Style</span> <span class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                                                                            </button>
                                                                        </h2>

                                                                        <div id="flush-collapseBrands" class="accordion-collapse collapse show" aria-labelledby="flush-headingBrands">
                                                                            <div class="accordion-body text-body pt-0">
                                                                                <div class="mb-25">
                                                                                    <div class="gap-2 mt-3 filter-check">
                                                                                        <label class="font-15">Color Scheme</label>
                                                                                    </div>
                                                                                    <div class="gap-2 mt-3 filter-check">                                            
                                                                                        <label for="">Primary</label>
                                                                                        <div class="col-lg-auto">
                                                                                            <div class="pickesettings">
                                                                                                <input type="text" autocomplete="off" spellcheck="false">
                                                                                                <input type="color" value="#FFB61A">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="gap-2 mt-3 filter-check">                                            
                                                                                        <label for="">Secondary</label>
                                                                                        <div class="col-lg-auto">
                                                                                            <div class="pickesettings">
                                                                                                <input type="text" autocomplete="off" spellcheck="false">
                                                                                                <input type="color" value="#4b38b3">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="gap-2 mt-3 filter-check">                                            
                                                                                        <label for="">Secondary</label>
                                                                                        <div class="col-lg-auto">
                                                                                            <div class="pickesettings">
                                                                                                <input type="text" autocomplete="off" spellcheck="false">
                                                                                                <input type="color" value="#ea1515">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>            
                                                                                <div class="mb-25">
                                                                                    <div class="gap-2 mt-3 filter-check">                                            
                                                                                        <label for="">Font</label>
                                                                                        <select class="form-select" name="know_from">
                                                                                            <option Selected>Arial</option>
                                                                                            <option>Calibri</option>
                                                                                            <option>Cambria</option>
                                                                                            <option>Monospace</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>  
                                                                                <div class="mb-25">
                                                                                    <div class="gap-2 mt-3 filter-check">                                            
                                                                                        <label for="">Button Text</label>
                                                                                        <select class="form-select" name="know_from">
                                                                                            <option Selected>Register</option>
                                                                                            <option>Enroll</option>
                                                                                            <option>Sign Up</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div> 
                                                                                <div class="mb-25">
                                                                                    <div class="gap-2 mt-3 filter-check">                                            
                                                                                        <label for="">Button Style</label>
                                                                                        <div>
                                                                                            <input type="radio" id="html" name="fav_language" value="HTML">
                                                                                            <label for="html">Text only</label><br>
                                                                                            <input type="radio" id="css" name="fav_language" value="CSS">
                                                                                            <label for="css">Outline</label><br>
                                                                                            <input type="radio" id="javascript" name="fav_language" value="JavaScript">
                                                                                            <label for="javascript">Solid</label> 
                                                                                        </div>                                               
                                                                                    </div>
                                                                                </div>

                                                                            </div>                                    
                                                                        </div>
                                                                    </div>
                                                                    <!-- end accordion-item -->    
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="flush-headingDiscount">
                                                                            <button class="accordion-button bg-transparent shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseDiscount" aria-expanded="true" aria-controls="flush-collapseDiscount">
                                                                                <span class="text-muted text-uppercase fs-12 fw-medium">Content</span> <span class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                                                                            </button>
                                                                        </h2>
                                                                        <div id="flush-collapseDiscount" class="accordion-collapse collapse" aria-labelledby="flush-headingDiscount">
                                                                            <div class="accordion-body text-body pt-1">
                                                                                <div class="gap-2 mt-3 filter-check">
                                                                                    <div>
                                                                                        <button class="btn btn-red mb-15 w-100">Select Schedule Contents</button>  
                                                                                    </div>                                                                                  
                                                                                </div>
                                                                                <div class="mb-25">
                                                                                    <div class="gap-2 mt-3 filter-check">                                            
                                                                                        <label for="">Main Schedule</label>
                                                                                        <p>Select what you'd like to show in the main view of the schedule.</p>
                                                                                        <div>
                                                                                            <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                                                                            <label for="vehicle1">Staff </label><br>
                                                                                            <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
                                                                                            <label for="vehicle2">Class type </label><br>
                                                                                            <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
                                                                                            <label for="vehicle3">Class level </label><br> 
                                                                                        </div>                                               
                                                                                    </div>
                                                                                </div>

                                                                                <div class="mb-25">
                                                                                    <div class="gap-2 mt-3 filter-check">                                            
                                                                                        <label for="">Date Range</label>
                                                                                        <div>
                                                                                            <input type="radio" id="html" name="fav_language" value="HTML">
                                                                                            <label for="html">Week </label><br>
                                                                                            <input type="radio" id="css" name="fav_language" value="CSS">
                                                                                            <label for="css">Day</label><br>
                                                                                        </div>                                               
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- end accordion-item -->                            
                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="flush-headingRating">
                                                                            <button class="accordion-button bg-transparent shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseRating" aria-expanded="false" aria-controls="flush-collapseRating">
                                                                                <span class="text-muted text-uppercase fs-12 fw-medium">Filters</span> <span class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                                                                            </button>
                                                                        </h2>

                                                                        <div id="flush-collapseRating" class="accordion-collapse collapse" aria-labelledby="flush-headingRating">
                                                                            <div class="accordion-body text-body">
                                                                                <div class="gap-2 filter-check">
                                                                                    <label for="">Select a maximum of 4</label>
                                                                                    <div>
                                                                                        <input type="radio" id="html" name="fav_language" value="HTML">
                                                                                        <label for="html">Class </label><br>
                                                                                        <input type="radio" id="css" name="fav_language" value="CSS">
                                                                                        <label for="css">Staff </label><br>
                                                                                        <input type="radio" id="javascript" name="fav_language" value="JavaScript">
                                                                                        <label for="javascript">Class Type</label> <br>
                                                                                        <input type="radio" id="javascript1" name="fav_language" value="JavaScript1">
                                                                                        <label for="javascript1">Class Level</label> 
                                                                                    </div>  
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <!-- end accordion-item -->

                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="flush-headingregion">
                                                                            <button class="accordion-button bg-transparent shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseregion" aria-expanded="false" aria-controls="flush-collapseregion">
                                                                                <span class="text-muted text-uppercase fs-12 fw-medium">Region</span> <span class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                                                                            </button>
                                                                        </h2>

                                                                        <div id="flush-collapseregion" class="accordion-collapse collapse" aria-labelledby="flush-headingregion">
                                                                            <div class="accordion-body text-body">
                                                                                <div class="gap-2 filter-check">
                                                                                    <label for="">Language</label>
                                                                                    <select class="form-select mb-3" aria-label="Default select example">
                                                                                        <option selected="">English </option>
                                                                                        <option value="1">Hindi </option>
                                                                                        <option value="2">Arabela </option>
                                                                                        <option value="3">Egyptian Arabic </option>
                                                                                        <option value="3">Auslan </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <!-- end accordion-item -->
                                                                </div>
                                                                <div class="card-footer">
                                                                    <div class="d-flex mt-3 mb-3">
                                                                        <div class="flex-grow-1">
                                                                            <button href="#" class="btn btn-black w-100">Save and Deploy</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-9 col-lg-8">
                                                            <div class="card">
                                                                <div class="card-header align-items-center d-flex">
                                                                    <h4 class="card-title mb-0 flex-grow-1">Preview</h4>
                                                                    <!--<div class="flex-shrink-0">
                                                                        <div class="form-check form-switch form-switch-right form-switch-md">
                                                                            <label for="dropdown-base-example" class="form-label text-muted">Preview Size</label>
                                                                            <input class="form-check-input code-switcher" type="checkbox" id="dropdown-base-example">
                                                                        </div>
                                                                    </div>-->
                                                                </div><!-- end card header -->

                                                                <div>
                                                                    <div class="live-preview">
                                                                        <!--<div>
                                                                            <div class="card-header bg-soft-grey">
                                                                                <h4 class="card-title mb-0 flex-grow-1">Find Class</h4>
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <div class="row">
                                                                                    <div class="activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6">
                                                                                        <div class="sports-list">
                                                                                            <a href="#">All Activities</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6">
                                                                                        <div class="sports-list">
                                                                                            <a href="#">Yoga</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6">
                                                                                        <div class="sports-list">
                                                                                            <a href="#">Pilates</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6">
                                                                                        <div class="sports-list">
                                                                                            <a href="#">Cardio</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6">
                                                                                        <div class="sports-list">
                                                                                            <a href="#">Cycling</a>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 show_activities_options">
                                                                                        <div class="sports-list">
                                                                                            <a href="#">More<i class="fas fa-caret-down"></i></a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div> -->

                                                                        <div class="row">
                                                                            <div class="col-lg-3 col-md-3">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 service-pr-0">
                                                                                        <div class="card-header bg-soft-grey">
                                                                                            <h4 class="card-title mb-0 flex-grow-1">Services</h4>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12">
                                                                                        <div class="card-body">
                                                                                            <select class="form-select" name="know_from">
                                                                                                <option value="All Services" Selected>All Services</option>
                                                                                                <option value="Classes">Classes</option>
                                                                                                <option value="Private Lessons">Private Lessons</option>
                                                                                                <option value="Events">Events</option>
                                                                                                <option value="Experience">Experience</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>                                        
                                                                            </div>
                                                                            <div class="col-lg-3 col-md-3">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 fall-schedule">
                                                                                        <div class="card-header bg-soft-grey">
                                                                                            <h4 class="card-title mb-0 flex-grow-1">Great For</h4>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12 fall-schedule">
                                                                                        <div class="card-body">
                                                                                            <select class="form-select" name="know_from">
                                                                                                <option value="All" Selected>All</option>
                                                                                                <option value="adults">Adults</option>
                                                                                                <option value="kids">Kids</option>
                                                                                                <option value="infants">Infants</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>                                        
                                                                            </div>
                                                                            <div class="col-lg-3 col-md-3">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 fall-schedule">
                                                                                        <div class="card-header bg-soft-grey">
                                                                                            <h4 class="card-title mb-0 flex-grow-1">Difficulty Level</h4>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12 fall-schedule">
                                                                                        <div class="card-body">
                                                                                            <select class="form-select" name="know_from">
                                                                                                <option value="All Levels" Selected>All Levels</option>
                                                                                                <option value="Beginner">Beginner</option>
                                                                                                <option value="Intermediate">Intermediate</option>
                                                                                                <option value="Advance">Advance</option>
                                                                                                <option value="Pro">Pro</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>                                        
                                                                            </div>
                                                                            <div class="col-lg-3 col-md-3">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12 staff-pl-0">
                                                                                        <div class="card-header bg-soft-grey">
                                                                                            <h4 class="card-title mb-0 flex-grow-1">All Staff</h4>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-12 staff-pl-0">
                                                                                        <div class="card-body">
                                                                                            <select class="form-select" name="know_from">
                                                                                                <option value="All Staff" Selected>All Staff</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div> 
                                                                            </div>
                                                                        </div>

                                                                        <div>
                                                                            <div class="card-header bg-soft-grey">
                                                                                <div class="row">
                                                                                    <div class="col-lg-6 col-6">
                                                                                        <h4 class="card-title mb-0 flex-grow-1">Find Date</h4>
                                                                                    </div>
                                                                                    <div class="col-lg-6 col-6">
                                                                                        <div class="calendar-icon float-right">
                                                                                            <input type="text" name="date" class="date datepicker" readonly placeholder="DD/MM/YYYY" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                                
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-2 col-sm-2 col-xs-6 col-6">
                                                                                        <div class="pairets">
                                                                                            <!-- <div class="pairets-inviable"> -->
                                                                                            <a href="#" class="calendar-btn">Wed 14</a>
                                                                                        </div>
                                                                                    </div>
                                                                                                            
                                                                                    <div class="col-md-2 col-sm-2 col-xs-6 col-6">
                                                                                        <div class="pairets-inviable">
                                                                                            <!-- <div class="pairets-inviable"> -->
                                                                                            <a href="#" class="calendar-btn">Thu 15</a>
                                                                                        </div>
                                                                                    </div>
                                                                                                            
                                                                                    <div class="col-md-2 col-sm-2 col-xs-6 col-6">
                                                                                        <div class="pairets-inviable">
                                                                                            <!-- <div class="pairets-inviable"> -->
                                                                                            <a href="#" class="calendar-btn">Fri 16</a>
                                                                                        </div>
                                                                                    </div>
                                                                                                            
                                                                                    <div class="col-md-2 col-sm-2 col-xs-6 col-6">
                                                                                        <div class="pairets-inviable">
                                                                                            <!-- <div class="pairets-inviable"> -->
                                                                                            <a href="#" class="calendar-btn">Sat 17</a>
                                                                                        </div>
                                                                                    </div>
                                                                                                            
                                                                                    <div class="col-md-2 col-sm-2 col-xs-6 col-6">
                                                                                        <div class="pairets-inviable">
                                                                                            <!-- <div class="pairets-inviable"> -->
                                                                                            <a href="#" class="calendar-btn">Sun 18</a>
                                                                                        </div>
                                                                                    </div>
                                                                                                            
                                                                                    <div class="col-md-2 col-sm-2 col-xs-6 col-6">
                                                                                        <div class="pairets-inviable">
                                                                                            <!-- <div class="pairets-inviable"> -->
                                                                                            <a href="#" class="calendar-btn">Mon 19</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <!-- <div class="row justify-content-md-center">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="mt-3">
                                                                                            <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" data-deafult-date="24 01,2021" data-inline-date="true">
                                                                                        </div>
                                                                                    </div>
                                                                                </div> -->
                                                                            </div>
                                                                        </div>     
                                                                        <div>
                                                                            <div class="card-header bg-soft-grey">
                                                                                <h4 class="card-title mb-0 flex-grow-1">Wednesday, February 14</h4>
                                                                            </div>
                                                                            <div class="card-body card-body-schedule show-all">
                                                                                <div class="row justify-content-md-center">
                                                                                    <div class="col-lg-2 col-md-2 col-xs-12 col-sm-2 col-12">
                                                                                        <div class="table-inner-data">
                                                                                            <span class="mg-time"> 06:30 AM </span>
                                                                                            <div class="time-min bg-red-fall">
                                                                                                <span> 1 hour </span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-7 col-md-7 col-xs-12 col-sm-7 col-12">
                                                                                        <div class="table-inner-data-sec">
                                                                                            <img src="https://fitnessity-production.s3.amazonaws.com/activity/meka8JsFR68TpdRhatzxzZpTFPVUSvgEx1MGILm5.jpg" alt="Fitnessity">
                                                                                            <div class="p-name">
                                                                                                <h3>jumping 1</h3>
                                                                                                <div class="d-grid">
                                                                                                    <p> Personal Training | Bungee Jumping | Spot Available - 1/1</p>
                                                                                                    <p>Instructor: Darryl Phipps <span class="difficult-level">Difficulty Level: Pro </span></p>  
                                                                                                </div>
                                                                                                            
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-1 col-md-1 col-xs-3 col-sm-1 col-6">
                                                                                        <div class="star-rest">
                                                                                            <div class="activity-inner-data">
                                                                                                <i class="fas fa-star"></i>
                                                                                                <span> 5 </span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-2 col-md-2 col-xs-6 col-sm-2 col-6">
                                                                                        <div class="join-btn">
                                                                                            <a class="btn btn-red" href="#">Book Now</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="schedule-widget-sapre-tor"></div>
                                                                            </div>

                                                                            <div class="card-body card-body-schedule show-all">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="border-list">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-2 col-md-2 col-xs-12 col-sm-2  col-12">
                                                                                                    <div class="table-inner-data">
                                                                                                        <span class="mg-time"> 09:00 AM </span>
                                                                                                        <div class="time-min bg-red-fall">
                                                                                                            <span> 1 hour 15 minute </span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-lg-7 col-md-7 col-xs-12 col-sm-7  col-12">
                                                                                                    <div class="table-inner-data-sec">
                                                                                                        <img src="https://fitnessity-production.s3.amazonaws.com/activity/eisJPbu7UPhASgD4edJSOufZSXENkw3TkZV281HL.jpg" alt="Fitnessity">
                                                                                                        <div class="p-name">
                                                                                                            <h3>Summer Camp at Valor</h3>
                                                                                                            <div class="d-grid">
                                                                                                                <p> Events | Day Camp | Spot Available - 200/200</p>
                                                                                                                <p>Instructor: Darryl Phipps <span class="difficult-level">Difficulty Level: Beginner</span></p>   
                                                                                                            </div>                                                                   
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-lg-1 col-md-1 col-xs-3 col-sm-1  col-6">
                                                                                                    <div class="star-rest">
                                                                                                        <div class="activity-inner-data">
                                                                                                            <i class="fas fa-star"></i>
                                                                                                            <span> 0 </span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-lg-2 col-md-2 col-xs-6 col-sm-2  col-6">
                                                                                                    <div class="join-btn">
                                                                                                        <a class="btn btn-red" href="#">Book Now</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="schedule-widget-sapre-tor"></div>
                                                                            </div>

                                                                            <div class="card-body card-body-schedule show-all">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="border-list">
                                                                                            <div class="row">
                                                                                                <div class="col-lg-2 col-md-2 col-xs-12 col-sm-2  col-12">
                                                                                                    <div class="table-inner-data">
                                                                                                        <span class="mg-time"> 09:15 AM </span>
                                                                                                        <div class="time-min bg-red-fall">
                                                                                                            <span> 1 hour </span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-lg-7 col-md-7 col-xs-12 col-sm-7  col-12">
                                                                                                    <div class="table-inner-data-sec">
                                                                                                        <img src="https://fitnessity-production.s3.amazonaws.com/activity/wvahqhcKOL6C8NQ1IBqh3vtfVOc3MOAM3aarjoLf.jpg" alt="Fitnessity">
                                                                                                        <div class="p-name">
                                                                                                            <h3>Bucephalus Riding and Polo Club1</h3>
                                                                                                            <div class="d-grid">
                                                                                                                <p> Events | Horseback Riding | Spot Available - 10/10</p>
                                                                                                                <p>Instructor: Darryl Phipps <span class="difficult-level">Difficulty Level: Advance</span></p>  
                                                                                                            </div>                                                                                                                        
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-lg-1 col-md-1 col-xs-3 col-sm-1  col-6">
                                                                                                    <div class="star-rest">
                                                                                                        <div class="activity-inner-data">
                                                                                                            <i class="fas fa-star"></i>
                                                                                                            <span> 0 </span>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col-lg-2 col-md-2 col-xs-6 col-sm-2  col-6">
                                                                                                    <div class="join-btn">
                                                                                                        <a class="btn btn-red" href="#">Book Now</a>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="schedule-widget-sapre-tor"></div>
                                                                            </div>
                                                                        </div>                             
                                                                    </div>
                                                                </div><!-- end card-body -->
                                                            </div><!-- end card -->
                                                        </div> <!-- end col -->
                                                    </div> <!-- end row-->
                                                </div>
                                            </div>
                                              
                                        </div>
                                    </div>

                                    <div class="card bg-soft-grey ">
                                        <div class="card-header align-items-center d-flex bg-soft-grey">
                                            <h4 class="card-title mb-0 flex-grow-1">Copy your code</h4>
                                        </div>

                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="copy-code">
                                                        <p>Paste the code into your webpage where you would like the link to appear. Changes made above automatically update your code.</p>
                                                        <textarea class="form-control" placeholder="<script src=http://dev.fitnessity.co//public/dashboard-design/js/jquery-3.6.4.min.js></script><script src=https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCr7-ilmvSu8SzRjUfKJVbvaQZYiuntduw async defer></script> <script async src=https://www.googletagmanager.com/gtag/js?id=G-KQRG55N3Q1></script>" id="des-info-description-input" rows="4" required=""></textarea>
                                                        <button class="btn btn-red mt-15">Copy</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    

                                </div>
                                <div class="tab-pane" id="site_settings" role="tabpanel">
                                    <div class="">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Site Settings - Valor Mixed Martial Arts</h4>
                                        </div><!-- end card header -->

                                        <div class="card-body">
                                            <div class="live-preview">
                                                <div class="row ">
                                                    <div class="col-lg-12">
                                                        <button href="#" class="btn btn-black">Refresh all fitnessity data</button>
                                                    </div>                                                  
                                                </div>
                                            </div>
                                        </div><!-- end card-body -->
                                    </div><!-- end card -->

                                    <div class="card bg-soft-grey ">
                                        <div class="card-header align-items-center d-flex bg-soft-grey">
                                            <h4 class="card-title mb-0 flex-grow-1">Who powers your website?</h4>
                                        </div><!-- end card header -->

                                        <div class="card-body">
                                            <div class="live-preview">
                                                <div class="row ">
                                                    <div class="col-lg-3">
                                                        <div class="mt-3 filter-check">
                                                            <label for="">Who powers your website?</label>
                                                            <select class="form-select mb-3" aria-label="Default select example">
                                                                <option selected="">Wordpress </option>
                                                                <option value="1">Facebook </option>
                                                                <option value="2">GoDaddy </option>
                                                                <option value="3">Joomla </option>
                                                                <option value="3"> Drupal</option>                                                               
                                                            </select>
                                                        </div>
                                                    </div>                                                  
                                                </div>
                                            </div>
                                        </div><!-- end card-body -->
                                    </div><!-- end card -->

                                    <div class="card bg-soft-grey ">
                                        <div class="card-header align-items-center d-flex bg-soft-grey">
                                            <h4 class="card-title mb-0 flex-grow-1">Branding </h4>
                                        </div><!-- end card header -->

                                        <div class="card-body">
                                            <div class="live-preview">
                                                <div class="row ">
                                                    <div class="col-lg-6">
                                                        <div class="row y-middle mb-15">
                                                            <div class="col-lg-5">
                                                                <label for="">Primary Color</label>
                                                            </div>
                                                            <div class="col-lg-auto">
                                                                <div class="pickesettings">
                                                                    <input type="text" autocomplete="off" spellcheck="false">
                                                                    <input type="color" value="#FFB61A">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row y-middle mb-15">
                                                            <div class="col-lg-5">
                                                                <label for="">Secondary Color</label>
                                                            </div>
                                                            <div class="col-lg-auto">
                                                                <div class="pickesettings">
                                                                    <input type="text" autocomplete="off" spellcheck="false">
                                                                    <input type="color" value="#FFB35A">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row y-middle">
                                                            <div class="col-lg-5">
                                                                <label for="">Widget background Color</label>
                                                            </div>
                                                            <div class="col-lg-auto">
                                                                <div class="pickesettings">
                                                                    <input type="text" autocomplete="off" spellcheck="false">
                                                                    <input type="color" value="#FCB91A">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>                                                  
                                                </div>
                                            </div>
                                        </div><!-- end card-body -->
                                    </div><!-- end card -->

                                    <div class="card bg-soft-grey ">
                                        <div class="card-header align-items-center d-flex bg-soft-grey">
                                            <h4 class="card-title mb-0 flex-grow-1">Account Registration</h4>
                                        </div><!-- end card header -->

                                        <div class="card-body">
                                            <div class="live-preview">
                                                <div class="row ">
                                                    <div class="col-lg-3">
                                                        <div class="mt-3 filter-check">
                                                            <label for="">Default Registration Widget</label>
                                                            <select class="form-select mb-3" aria-label="Default select example">
                                                                <option selected="">Login/Register </option>
                                                                <option value="1">Register an Account 02 </option>                                      
                                                            </select>
                                                        </div>
                                                    </div>                                                  
                                                </div>
                                            </div>
                                        </div><!-- end card-body -->
                                    </div><!-- end card -->

                                    <div class="card bg-soft-grey ">
                                        <div class="card-header align-items-center d-flex bg-soft-grey">
                                            <h4 class="card-title mb-0 flex-grow-1">Locations</h4>
                                        </div><!-- end card header -->

                                        <div class="card-body">
                                            <div class="live-preview">
                                                <div class="row ">
                                                    <div class="col-lg-3">
                                                        <div class="mt-3 filter-check">
                                                            <label for="">Valor Mixed Martial Arts</label>
                                                        </div>
                                                    </div>                                                  
                                                </div>
                                            </div>
                                        </div><!-- end card-body -->
                                    </div><!-- end card -->

                                    <div class="card bg-soft-grey ">
                                        <div class="card-header align-items-center d-flex bg-soft-grey">
                                            <h4 class="card-title mb-0 flex-grow-1">Region</h4>
                                        </div><!-- end card header -->

                                        <div class="card-body">
                                            <div class="live-preview">
                                                <div class="row ">
                                                    <div class="col-lg-6">
                                                        <div class="row y-middle mb-15">
                                                            <div class="col-lg-3">
                                                                <div class="filter-check">
                                                                    <label for="">Currency Symbol</label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <select class="form-select" aria-label="Default select example">
                                                                    <option selected="">$ (Dollar)</option>                         
                                                                </select>
                                                            </div>
                                                        </div>    
                                                        <div class="row y-middle mb-15">
                                                            <div class="col-lg-3">
                                                                <div class="filter-check">
                                                                    <label for="">Language </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <select class="form-select" aria-label="Default select example">
                                                                    <option selected="">English</option>     
                                                                    <option>Hindi</option>                     
                                                                </select>
                                                            </div>
                                                        </div>                                                      
                                                    </div>                                                  
                                                </div>
                                            </div>
                                        </div><!-- end card-body -->
                                    </div><!-- end card -->

                                    <div class="card bg-soft-grey ">
                                        <div class="card-header align-items-center d-flex bg-soft-grey">
                                            <h4 class="card-title mb-0 flex-grow-1">Users</h4>
                                        </div><!-- end card header -->

                                        <div class="card-body">
                                            <div class="live-preview">
                                                <button href="#" class="btn btn-black" data-bs-toggle="modal" data-bs-target="#adduser">Add New User</button>
                                                <div class="row ">
                                                    <div class="col-lg-12">
                                                        <div class="table-responsive">
                                                            <table class="table align-middle table-nowrap mb-0">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">Name</th>
                                                                        <th scope="col">Email</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th scope="row">Darryl Phipps</th>
                                                                        <td>mrphipps@valormmanyc.com</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>                                                  
                                                </div>
                                            </div>
                                        </div><!-- end card-body -->
                                    </div><!-- end card -->

                                </div>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!--end col-->
            </div>
        </div><!-- container-fluid -->
    </div>
</div><!-- end main content-->	
</div><!-- END layout-wrapper -->


<!-- Modal -->
<div class="modal fade" id="login_preview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-100">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <section class="register ptb-65" style="background-image: url(http://dev.fitnessity.co//public/images/register-bg.jpg)">
                <div class="container">
                    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                        <div class="register_wrap" id="signup_normal">
                            <input type="hidden" id="showstep" value="">
                            <div class="logo-my">
                                <a href="javascript:void(0)"> <img src="http://dev.fitnessity.co//public/images/logo-small.jpg"> </a>
                            </div>               
                            <form method="post" action="">
                                <input type="hidden" name="_token" value="5QJLNEz2voSG1yd1mOKWRs91y0u50UhbqKLCiNJS">
                                <div class="pop-title ftitle1">
                                    <h3>Welcome to Fitnessity</h3>
                                </div>
                                <br> 
                                <input type="hidden" name="redirect" value="http://dev.fitnessity.co/design/integration_portal">
                                <input type="email" name="email" id="email" class="myemail" size="30" autocomplete="off" placeholder="e-MAIL" maxlength="80">
                                <span class="text-danger cls-error" id="erremail"></span> 
                                <div class="position-relative auth-pass-inputgroup">
                                    <input class="password-input" type="password" name="password" id="password" size="30" placeholder="Password" autocomplete="off">
                                    <button class="btn-link position-absolute password-addon toggle-password" type="button" id="password-addon">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <span class="text-danger cls-error" id="errpass"></span>                    
                                <div class="remembermediv terms-wrap">
                                    <input type="checkbox" id="remember" name="remember" checked="" class="remembercheckbox">
                                    <span for="remember" class="rememberme">Remember me</span>
                                </div>
                                <div id="capchaimg"></div>
                                <button class="btn signup-new" id="login_submit" type="submit">Log in </button>
                                <p class="or-data">OR</p>
                                <div class="social-login">
                                    <a href="login/facebook" class="fb-login">
                                        <i class="fab fa-facebook" aria-hidden="true"></i> Login with Facebook
                                    </a>
                                </div>
                                <div class="text-center mb-10">
                                    <a href="login/google" class="fb-login btn signup-new">
                                        <i class="fab fa-google" aria-hidden="true"></i>   <span class="ml-10">Login with Google</span>
                                    </a>
                                </div>

                                <a class="forgotpass" data-behavior="ajax_html_modal" data-url="http://dev.fitnessity.co/auth/jsModalpassword">Forgot Password?</a>

                                <a class="forgotpass" href="http://dev.fitnessity.co/staff_login">Login For Staff Member?</a>

                                <p class="already">Don't have an account?
                                    <a href="/registration">SIGN UP</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="register_preview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-100">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
           		<section class="register ptb-65" style="background-image: url(http://dev.fitnessity.co//public/images/register-bg.jpg)">
                    <div class="container">
                        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
                            <div class="register_wrap modal-register-preview" id="signup_normal">
                                <input type="hidden" id="showstep" value="1">
                                <!--1-->
                                                <div class="logo-my">
                                    <a href="javascript:void(0)"> <img src="http://dev.fitnessity.co//public/images/logo-small.jpg" alt="Fitnessity"> </a>
                                </div>
                                <form id="frmregister" method="post" novalidate="novalidate">
                                    <div class="pop-title ftitle1">
                                        <h3>Welcome to fitnessity</h3>
                                    </div>
                                    <div id="systemMessage"></div>
                                    <input type="hidden" name="_token" value="E4MKIsrjC7a9tlI0LqoOFnqRZdAK85o1YLbI53LN">
                                    <input type="hidden" name="customerId" value="">
                
                                    <input type="text" name="firstname" id="firstname" size="30" maxlength="80" placeholder="First Name">
                                    <input type="text" name="lastname" id="lastname" size="30" maxlength="80" placeholder="Last Name">
                                    <input type="text" name="username" id="username" size="30" maxlength="80" placeholder="Username" autocomplete="off">
                
                                    <input type="email" name="email" id="email" class="myemail" size="30" placeholder="e-MAIL" maxlength="80" autocomplete="off">
                                    <input type="text" name="contact" id="contact" size="30" maxlength="14" autocomplete="off" placeholder="Phone" data-behavior="text-phone">
                                    <input type="text" id="dob" name="dob" class="flatpicker_birthdate1 flatpickr-input" placeholder="Birthday" readonly="readonly">
                                    <div class="position-relative auth-pass-inputgroup">	
                                        <input type="password" name="password" id="password" size="30" placeholder="Password" autocomplete="off">
                                        <button class="btn-link position-absolute password-addon toggle-password" type="button" data-tp="password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="position-relative auth-pass-inputgroup">
                                        <input class="password-input" type="password" name="confirm_password" id="confirm_password" size="30" placeholder="Confirm Password" autocomplete="off">
                                        <button class="btn-link position-absolute password-addon toggle-password" type="button" data-tp="confirm_password">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                
                                    <div class="form-group check-box-info">
                                        <input class="check-box-primary-account" type="checkbox" id="primary_account" name="primary_account" value="1">
                                        <label for="primary_account"> Primary Account <span class="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="You are paying for yourself and all added family members.">(i)</span></label>
                                    </div>
                                    
                
                                    <div class="terms-wrap">
                                        <input type="checkbox" name="b_trm1" id="b_trm1" class="form-check-input" value="1">
                                        <label for="b_trm1">I agree to Fitnessity <a href="/terms-condition" target="_blank">Terms of Service</a> and <a href="/privacy-policy" target="_blank">Privacy Policy</a></label>
                                    </div>
                                    <div id="termserror"></div><br>
                                    <button type="button" style="margin:0px;" class="signup-new" id="register_submit" onclick="$('#frmregister').submit();">Create Account</button>
                                    <br><br>
                                    <!-- <p class="or-data">OR</p>
                                    <div class="social-login">
                                        <a href="/login/facebook" class="fb-login">
                                            <i class="fa fa-facebook" aria-hidden="true"></i> Login with Facebook
                                        </a>
                                      <a href="/login/google" class="plus-login">
                                            <i class="fa fa-google-plus" aria-hidden="true"></i> Sign with Google+
                                        </a> 
                                    </div> -->
                                    <p class="already">Already have an account? <a href="/userlogin">Login</a></p>    
                                </form>
                            </div>
                        </div>
                    </div>
            	</section>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="booking_preview" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-100">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
           		<div class="row mb-3">
					<div class="col-12">
                    	<div class="text-center pbooking-modal-logo">
                        	<img src="http://dev.fitnessity.co//public/images/fitnessity_logo1_black.png">
                        </div>
						<div class="page-heading text-center">
							<h2>Fitness Pvt. Ltd.</h2>
							<p>Booking Schedule for Nipa Soni (Demo)</p>
							<p>If you already have a membership with multiple sessions. Reserve your spot here.<br> If you don’t already have a membership, <a href="http://dev.fitnessity.co/activities">Book Here </a></p>
						</div>
					</div>
	            </div>
                
                <div class="row">
					<div class="col-12 ">
						<div class="">
							<div class="container p-0 inner-top-activity text-center">
								<div class="col-md-12 col-xs-12 ">
									<div class="activity-schedule-tabs">
										<ul class="nav nav-tabs" role="tablist">
											<li class="active">
												<a class="nav-link" href="#" aria-expanded="true"> ALL </a>
											</li>
											<li>
												<a class="nav-link" href="#" aria-expanded="true"> CLASSES </a>
											</li>
											<li>
												<a class="nav-link" href="#" aria-expanded="true"> PRIVATE LESSONS </a>
											</li>
											<li>
												<a class="nav-link" href="#" aria-expanded="true"> EVENTS </a>
											</li>
											<li>
												<a class="nav-link" href="#" aria-expanded="true"> EXPERIENCE </a>
											</li>
										</ul>
										<div class="tab-content" style="min-height: 600px;">
											<div class="tab-pane  active " id="tabs-all" role="tabpanel">
												<div class="row">
													<div class="col-md-12 col-sm-12 col-xs-12 text-right">
														<div class="calendar-icon">
															<input type="text" name="date" class="date datepicker hasDatepicker" readonly="" placeholder="DD/MM/YYYY" id="dp1720435536625"><img class="ui-datepicker-trigger" src="/public/img/calendar-icon.png" alt="Select date" title="Select date">
														</div>
													</div>
												</div>
                                                <div class="row">
                                                    <div class="col-lg-3">
                                                        <div class="item">
                                                            <div class="pairets">
                                                                <a href="#" class="calendar-btn">Mon 08</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="item">
                                                            <div class="pairets-inviable">
                                                                <a href="#" class="calendar-btn">Tue 09</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="item">
                                                            <div class="pairets-inviable">
                                                                <a href="#" class="calendar-btn">Wed 10</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="item">
                                                            <div class="pairets-inviable">
                                                                <a href="#" class="calendar-btn">Thu 11</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
												
												<div class="tab-data">
													<div class="row">
														<div class="col-md-4 col-sm-4 col-xs-12">
															<div class="checkout-sapre-tor">
															</div>
														</div>
														<div class="col-md-4 col-sm-4 col-xs-12 valor-mix-title">
															<label>Activities on Monday, July 8</label>
														</div>
														<div class="col-md-4 col-sm-4 col-xs-12">
															<div class="checkout-sapre-tor">
															</div>
														</div>
													</div>
													<div class="activity-tabs">
														<div class="row">
															<div class="col-md-6 col-sm-6 col-xs-12">
																<div class="classes-info text-left">
																	<div class="row">
																		<div class="col-md-12 col-xs-12 ">
																			<label>Activity Name: </label> <span> Summer Dance</span>
																		</div>
																		<div class="col-md-12 col-xs-12">
																			<div class="text-left line-height-1">
																				<label>Activity: </label> <span> Dance</span>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<div class="row">
																	<div class="col-md-4 col-sm-5 col-xs-12">
																		<div class="classes-time">
																			<button class="post-btn  activity-scheduler" onclick="openPopUp(1182 , 5 ,'Summer Dance','04:00 am',0,'516');">04:00 am <br>1 hr</button>
																				<label>2/2  Spots Left</label>
																				<label>Discover Test, Ashley Wong</label>
																		</div>
																	</div>
                                                                </div>
															</div>
															<div class="col-md-12 col-xs-12">
																<div class="checkout-sapre-tor">
																</div>
															</div>
														</div> 
																																																																																                                                        <div class="row"> 
															<div class="col-md-6 col-sm-6 col-xs-12">
																<div class="classes-info text-left">
																	<div class="row">
                                                                    	<div class="col-md-12 col-xs-12 ">
																			<label>Activity Name: </label> <span> Passion Airplane Tours New York NYny</span>
																		</div>
																		<div class="col-md-12 col-xs-12">
																			<div class="text-left line-height-1">
																				<label>Activity: </label> <span> Airplane Tour</span>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
																			
															<div class="col-md-6 col-sm-6 col-xs-12">
																<div class="row">
																	<div class="col-md-4 col-sm-5 col-xs-12">
																		<div class="classes-time">
																			<button class="post-btn  activity-scheduler" onclick="openPopUp(1208 , 304 ,'Passion Airplane Tours New York NYny','08:45 am',0,'553');">08:45 am <br>1 hr</button>
																			<label>1/1  Spots Left</label>
																			<label>Discover Test, Gimmy Ttouqe</label>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-md-12 col-xs-12">
																<div class="checkout-sapre-tor">
																</div>
															</div>
														</div> 
                                                        <div class="row">
															<div class="col-md-6 col-sm-6 col-xs-12">
																<div class="classes-info text-left">
																	<div class="row">
																		<div class="col-md-12 col-xs-12 ">
																			<label>Activity Name: </label> <span> Passion Airplane Tours New York NYny</span>
																		</div>
																		<div class="col-md-12 col-xs-12">
																			<div class="text-left line-height-1">
																				<label>Activity: </label> <span> Airplane Tour</span>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															<div class="col-md-6 col-sm-6 col-xs-12">
																<div class="row">
																	<div class="col-md-4 col-sm-5 col-xs-12">
																		<div class="classes-time">
																			<button class="post-btn  activity-scheduler" onclick="openPopUp(1198 , 304 ,'Passion Airplane Tours New York NYny','09:00 pm',0,'554');">09:00 pm <br>5 hr</button>
																			<label>10/10  Spots Left</label>
																			<label>Discover Test</label>
																		</div>
																	</div>
                                                                </div>
															</div>
															<div class="col-md-12 col-xs-12">
																<div class="checkout-sapre-tor">
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
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-3">
                    <label for="">Important</label>
                    <p>User are able to create, edit, and delete widgets. Add only trusted users to your site!</p>
                </div>
                <div class="mt-3">
                    <label for="">Email</label>
                    <input type="text" class="form-control" id="email">
                </div>
                <div class="mt-3">
                    <label for="">Name</label>
                    <input type="text" class="form-control" id="username">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-red">Add</button>
            </div>
        </div>
    </div>
</div>


@include('layouts.business.footer')



<script>
// Inputs
const valueInput = document.querySelector('input[type="text"]');
const colorInput = document.querySelector('input[type="color"]');

// Sync the color from the picker
const syncColorFromPicker = () => {
  valueInput.value = colorInput.value;
};

// Sync the color from the field
const syncColorFromText = () => {
  colorInput.value = valueInput.value;
};

// Bind events to callbacks
colorInput.addEventListener("input", syncColorFromPicker, false);
valueInput.addEventListener("input", syncColorFromText, false);

// Optional: Trigger the picker when the text field is focused
valueInput.addEventListener("focus", () => colorInput.click(), false);

// Refresh the text field
syncColorFromPicker();

</script>

<script>
$(function() {
   $('.lrcontent').hide();
   $('#selectField').change(function() {
      $('.lrcontent').hide();
      $('#' + $(this).val()).show();
   });
});
</script>
<script>
	$('.owl-carousel').owlCarousel({
	    loop:true,
	    margin:10,
	    nav:true,
		navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
	    responsive:{
	        0:{
	            items:3
	        },
	        600:{
	            items:3
	        },
	        1000:{
	            items:5
	        }
	    }
		
	});
</script>
@endsection