@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')
@include('layouts.profile.business_topbar')


<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-12">
                    <div class="page-heading">
                        <label>Fall 2021 to 2022 Schedule</label>
                    </div>
                </div>
            </div>
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
                                        <div class="gap-2 mt-3 filter-check">
                                            <label for="">Header Image</label>
                                            <input class="form-control" type="file" id="formFile">
                                        </div>
                                        <div class="gap-2 mt-3 filter-check">
                                            <label for="">Header Text</label>
                                            <textarea class="form-control" placeholder="" id="des-info-description-input" rows="3" required=""></textarea>
                                        </div>
                                        <div class="gap-2 mt-3 filter-check">
                                            <label for="">Colors</label>
                                            <p>By not setting a color, the defaults will be used.</p>
                                            <label for="">Text</label>
                                            <input type="color" class="form-control form-control-color w-100 mb-15" id="colorPicker" value="#364574">
                                            <label for="">Button Background</label>
                                            <input type="color" class="form-control form-control-color w-100" id="colorPicker" value="#354256">
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
                            <div class="flex-shrink-0">
                                <div class="form-check form-switch form-switch-right form-switch-md">
                                    <label for="dropdown-base-example" class="form-label text-muted">Preview Size</label>
                                    <input class="form-check-input code-switcher" type="checkbox" id="dropdown-base-example">
                                </div>
                            </div>
                        </div><!-- end card header -->

                        <div>
                            <div class="live-preview">
                                <div>
                                    <div class="card-header bg-soft-grey">
                                        <h4 class="card-title mb-0 flex-grow-1">Find Class</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row justify-content-md-center">
                                            <div class="col-lg-12">
                                                <div class="mt-3">
                                                    <input type="text" class="form-control" data-provider="flatpickr" data-date-format="d M, Y" data-deafult-date="24 01,2021" data-inline-date="true">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>     
                                <div>
                                    <div class="card-header bg-soft-grey">
                                        <h4 class="card-title mb-0 flex-grow-1">Wednesday, February 7</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row justify-content-md-center">
                                            <div class="col-lg-6">
                                               <div class="d-grid schedule-wid-text">
                                                    <span>12:00 PM -12:45 PM EST</span>
                                                    <span>Kickboxing Level 1 & 2 (Mixed Level)</span>
                                                    <label>Bernard Seaborn</label>

                                               </div>
                                               <div>
                                                    <a class="Show">View Details</a>
                                                    <a class="Hideschedule">Hide Details</a>
                                                    <div id="targetone">
                                                        <div class="widget-sche-show">
                                                            <h3>Address: </h3><span>2067 Broadway 7th Floor, New York NY 10023</span>
                                                        </div>
                                                        <div class="widget-sche-show">
                                                            <h3>Phone: </h3><span>569874523</span>
                                                        </div>
                                                        <div class="widget-sche-show">
                                                            <p>This class is for both beginner and more experienced students.</p>
                                                        </div>
                                                    </div>
                                               </div>                                               
                                            </div>
                                            <div class="col-lg-6">
                                               <div>
                                                <button href="#" class="btn btn-red">Register</button>
                                               </div>
                                            </div>
                                        </div>
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
        </div><!-- container-fluid -->
    </div>
</div><!-- end main content-->	
</div><!-- END layout-wrapper -->





@include('layouts.business.footer')
<script>
$('.Show').click(function() {
    $('#targetone').show(200);
    $('.Show').hide(0);
    $('.Hideschedule').show(0);
});
$('.Hideschedule').click(function() {
    $('#targetone').hide(500);
    $('.Show').show(0);
    $('.Hideschedule').hide(0);
});
</script>
@endsection
