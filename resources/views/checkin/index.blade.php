@inject('request', 'Illuminate\Http\Request')

@extends('layouts.business.header')

@section('content')
    @include('layouts.business.new-header')
    <div class="">
        <!-- auth page content -->
        <div class="auth-page-content check_img" style="background-image:url('{{ $imageUrl }}')">
            <div class="container-fuild">
                <div class="z-1">
                    <div class="card-body self-check-sp height-vh">
                        <div class="cross-check">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                    <div class="page-heading text-right">
                                        <label class="mb-15">
                                            <a class="btn btn-red" data-bs-toggle="modal" data-bs-target=".exitModal"
                                                style="background-color: {{ $settings ? $settings->welcome_screen_color : '' }};border-color: {{ $settings ? $settings->welcome_screen_color : '' }};">Exit</a></label>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="self-welcome-logo">
                                        <a href="#" class="d-inline-block auth-logo">
                                            <img src="{{ $logoUrl }}" alt="logo">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="text-right wel-date-time">
                                        <span>{{ \Carbon\Carbon::now()->format('F d, Y') }}</span>
                                        <h3>{{ date('g:i A') }}</h3>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12">
                                    <div class="welcome-title d-grid text-center">
                                        <label>Welcome To</label>
                                        <span>{{ $business->company_name }} </span>
                                    </div>
                                    <div class="text-center">
                                        <!-- <a href="{{ route('quick-checkin') }}" class="btn btn-red fs-15 mr-15"><i class="ri-add-line align-bottom me-1"></i>Check In</a> -->
                                     <a href="{{ route('quick-checkin') }}" class="btn btn-red fs-15 mr-15"
                                            style="background-color: {{ $settings ? $settings->welcome_screen_color : '' }}; 
                                                border-color: {{ $settings ? $settings->welcome_screen_color : '' }};">
                                            <i class="ri-add-line align-bottom me-1"></i>Check In
                                        </a> 
                                         <!-- {{-- <a href="{{route('business_customer_create',$business->id)}}"
                                        class="btn btn-black fs-15"><i class="ri-add-line align-bottom me-1"></i>Sign
                                        Up old
                                        </a>  --}} -->
                                        <a href="javascript:void(0);" class="btn btn-black fs-15"
                                            data-business-id="{{ $business->id }}"
                                            data-url="{{ route('business_customer_create_model', $business->id) }}"
                                            id="signupButton" data-bs-target="#customerModal" data-bs-toggle="modal">
                                            <i class="ri-add-line align-bottom me-1"></i> Sign Up
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 mobile-none">
                                    <div class="float-right qr-code">
                                        <div class="text-center">
                                            <img src="{{ url('/dashboard-design/images/qr-codes.png') }}" alt="logo">
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

    <!-- {{-- my new code goes here --}} -->
    <!-- Modal -->
    <div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true" data-bs-focus="false">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customerModalLabel">Create An Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="main-content" style="margin-left:0;">
                        <div class="page-content" style="padding-top:0;">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col">
                                      
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <div class="page-heading">
                                                        <label>Register A New Account or Search for Your Account</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xxl-12">
                                                    <ul class="nav nav-tabs mb-3" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-bs-toggle="tab" href="#add" role="tab" aria-selected="false"> Create Account </a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab" href="#search" role="tab" aria-selected="false">Search OmneBook</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content  text-muted">
                                                        <div class="tab-pane active" id="add" role="tabpanel">
                                                           
                                                            <div id="clientRegistration_form">
                                                                <form id="clientRegistration" method="post" action="">
                                                                    @csrf
                                                                    <div class="create-customer-box">
                                                                        <div class="row">
                                                                            <div class="col-md-12 col-lg-12">
                                                                                <h4 class="font-red ">Personal Info</h4>
                                                                                <h6>Adult, Parent/Guardian 18+</h6>
                                                                            </div>
                                                                            <div class="col-md-4 col-lg-3">
                                                                                <label class="mt-10 ">First Name<span
                                                                                        id="star">*</span></label>
                                                                                <input type="text" name="firstname"
                                                                                    id="firstname" size="30" maxlength="80"
                                                                                    class="form-control">
                                                                                    <div class="fname_error"></div>
                                                                            </div>
                                                                            <div class="col-md-4 col-lg-3">
                                                                                <label class="mt-10">Last Name<span
                                                                                        id="star">*</span></label>
                                                                                <input type="text" name="lastname" id="lastname"
                                                                                    size="30" maxlength="80"
                                                                                    class="form-control">
                                                                                    <div class="lname_error"></div>
                                                                            </div>
                                                                            <div class="col-md-4 col-lg-3">
                                                                                <label class="mt-10">Email<span
                                                                                        id="star">*</span></label>
                                                                                <input type="email" name="email" id="email"
                                                                                    class="myemail form-control" size="30"
                                                                                    maxlength="80" autocomplete="off" on>
                                                                                    <div class="email_error"></div>
                                                                            </div>
                                                                            <div class="col-md-4 col-lg-3">
                                                                                <label class="mt-10">Birthday<span id="star">*</span></label>
                                                                                <input type="text" class="form-control add-client-birthdate" id="dob" name="dob">
                                                                                <div class="dob_error"></div>
                                                                            </div>
                                                                            
                                                                            <div class="col-md-4 col-lg-3">
                                                                                <label class="mt-10">Phone <span id="star">*</span></label>
                                                                                <input type="text" name="contact" id="contact" size="30" maxlength="14" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" data-behavior="text-phone" class="form-control">
                                                                            </div>
                                                                            <!-- {{-- <div class="col-md-4 col-lg-3">
                                                                                <label class="mt-10">Check in Code </label>
                                                                                <input type="text" name="check_in" id="check_in" size="30" maxlength="4" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control">
                                                                                <div class="font-red" id="check_in_error"></div>
                                                                            </div> --}}
                                                                            {{-- <div class="col-md-4 col-lg-3 mt-10">
                                                                                <label class="mt-10">Password <span id="star">*</span></label>
                                                                                <input type="text" name="password" id="password" class="form-control">
                                                                            </div>
                                                                            <div class="col-md-4 col-lg-3 mt-10">
                                                                                <label class="mt-10">Confirm Password <span id="star">*</span></label>
                                                                                <input type="text" name="confirmpassword" id="confirmpassword" class="form-control">
                                                                            </div> --}} -->
                                                                            <div class="col-md-4 col-lg-3">
                                                                                <label class="mt-10">Gender<span id="star">*</span></label>
                                                                                <select class="form-select" name="gender">
                                                                                    <option value="male">Male</option>
                                                                                    <option value="female">Female</option>
                                                                                    <option value="other">Other</option>
                                                                                </select>
                                                                            </div>

                                                                            <div class="col-md-4 col-lg-3">
                                                                                <label class="mt-10">Check in Code </label>
                                                                                <!-- <input type="text" name="check_in" id="check_in" size="30" maxlength="4" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control"> -->
                                                                                <input type="text" name="check_in" id="check_in" size="30" maxlength="4"
                                                                                autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                                class="form-control">
                                                                                <div class="font-red" id="check_in_error"></div>
                                                                                
                                                                            </div>
                                                                            <div class="col-md-4 col-lg-3">
                                                                                <div class="form-group check-box-info ">
                                                                                    <input class="check-box-primary-account" type="checkbox" id="primaryAccountHolder" name="primaryAccountHolder" value="1">
                                                                                    <label for="primaryAccountHolder"> Primary Account <span class="" data-bs-toggle="tooltip" data-bs-placement="top" title="You are paying for yourself and all added family members.">(i)</span></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- <div class="add-client-sapre-tor"></div> -->
                                                                        <!-- {{-- <div class="container-fuild">
                                                                            <div class="row">
                                                                                <div class="col-lg-12">
                                                                                    <canvas id="signatureCanvas"
                                                                                        name="signatureCanvas"></canvas>
                                                                                    <input type="hidden" name="signpath"
                                                                                        id="signpath" value="">
                                                                                </div>
                                                                                <div class="col-lg-12">
                                                                                    <div class="col-md-4 col-lg-3 col-lg-3">
                                                                                        <button type="button"
                                                                                            id="clearButton"
                                                                                            class="btn btn-primary btn-black">Clear</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div> --}} -->
                                                                    </div>

                                                                    <!-- {{-- my new code start --}} -->
                                                                    
                                                                    <div class="create-customer-box">
                                                                        <div class="row">
                                                                            <div class="col-md-12 col-lg-12"><h4 class="font-red ">Address</h4></div>
                                                                            <div class="col-md-4 col-lg-3 mt-10">
                                                                                <label>Address </label>
                                                                                <!-- <input type="text" class="form-control pac-target-input" autocomplete="off" name="address" id="addressCustomer" value=""  oninput="initMapCall('addressCustomer', 'cityCustomer', 'stateCustomer', 'countryCustomer', 'zipcodeCustomer', 'latitudeCustomer', 'longitudeCustomer')">  -->
                                                                                <input type="text" class="form-control pac-target-input" autocomplete="off" name="address" id="addressCustomer" value="" oninput="initMapCall('addressCustomer', 'cityCustomer', 'stateCustomer', 'countryCustomer', 'zipcodeCustomer', 'latitudeCustomer', 'longitudeCustomer')">

                                                                            </div>
                                                                            <div id="map" style="display: none;"></div>
                                                                            <div class="col-md-4 col-lg-3 mt-10">
                                                                                <label for="City">City</label>
                                                                                <!-- <input type="text" class="form-control" name="city" id="cityCustomer" size="30" maxlength="50" value="" > -->
                                                                                <input type="text" class="form-control" name="city" id="cityCustomer"
                                                                                size="30" maxlength="50" value="" required=""
                                                                                aria-required="true">
                                                                            </div>
                                                                            <input type="hidden" name="lon" id="longitudeCustomer" value="">
                                                                            <input type="hidden" name="lat" id="latitudeCustomer" value="">

                                                                            <div class="col-md-4 col-lg-3 mt-10">
                                                                                <label for="state">State</label>
                                                                                <!-- <input type="text" class="form-control" name="state" id="stateCustomer" size="30" maxlength="50" value="" > -->
                                                                                <input type="text" class="form-control" name="state" id="stateCustomer"
                                                                                size="30" maxlength="50" value="" required=""
                                                                                aria-required="true">
                                                                            </div>
                                                                            <div class="col-md-4 col-lg-3 mt-10">
                                                                                <label for="country">Country </label>
                                                                                <!-- <input type="text" class="form-control" name="country" id="countryCustomer" size="30" maxlength="50" value="" > -->
                                                                                    <input type="text" class="form-control" name="country" id="countryCustomer"
                                                                                    size="30" maxlength="50" value="" required=""
                                                                                    aria-required="true">
                                                                            </div> 

                                                                            <div class="col-md-4 col-lg-3 mt-10">
                                                                                <label for="zipcode">Zip Code </label>
                                                                                <!-- <input type="text" class="form-control" name="zipcode" id="zipcodeCustomer" size="30" maxlength="50" value="" > -->
                                                                                <input type="text" class="form-control" name="zipcode" id="zipcodeCustomer"
                                                                                size="30" maxlength="50" value="" required=""
                                                                                aria-required="true">
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                
                                                                    <!-- <div class="add-client-sapre-tor"></div> -->
                                                                    <div class="create-customer-box">
                                                                        <div class="row">
                                                                            <div class="col-md-12 col-lg-12"><h4 class="font-red ">Add Family Members (Optional)</h4></div>
                                                                            <div class="error mb-10" id="familyerrormessage"></div>
                                                                            <input type="hidden" name="familycnt" id="familycnt" value="0">
                                                                            <div id="familymaindiv">
                                                                                <!-- <div class="new-client mb-10" id="familydiv0" data-i="0" data-text="1" > -->
                                                                                 <div class="new-client mb-10" id="familydiv0" data-i="0" data-text="1">    
                                                                                    <div class="accordion" id="default-accordion-example">
                                                                                        <div class="accordion-item shadow">
                                                                                            <h2 class="accordion-header" id="heading0">
                                                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse0" aria-expanded="true" aria-controls="collapse0">
                                                                                                    <div class="container-fluid nopadding">
                                                                                                        <div class="row"> 
                                                                                                            <div class="col-lg-6 col-md-6 col-8"> Family Member #1 </div> 
                                                                                                            <div class="col-lg-6 col-md-6 col-4"> 
                                                                                                                <div class="multiple-options" id="deletediv0"> 
                                                                                                                </div> 
                                                                                                            </div> 
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </button>
                                                                                            </h2>
                                                                                            <div id="collapse0" class="accordion-collapse collapse" aria-labelledby="heading0" data-bs-parent="#default-accordion-example">
                                                                                                <div class="accordion-body">
                                                                                                    <div class="row">
                                                                                                        <div class="col-md-4 col-lg-3">
                                                                                                            <label class="mt-10">First Name</label>
                                                                                                            <input type="text" name="fname[]" id="fname" class="form-control required fname0" >
                                                                                                            <span class="error" id="err_fname"></span>
                                                                                                        </div>
                                                                                                        <div class="col-md-4 col-lg-3">
                                                                                                            <label class="mt-10">Last Name</label>
                                                                                                            <input type="text" name="lname[]" id="lname" class="form-control required lname0" >
                                                                                                            <span class="error" id="err_lname"></span>
                                                                                                        </div>
                                                                                                        <div class="col-md-4 col-lg-3">
                                                                                                            <label class="mt-10">Birthday</label>
                                                                                                            <input type="text" class="form-control birthday_date0" name="birthdate[]" id="birthdate0" required>
                                                                                                        </div>
                                                                                                        <div class="col-md-4 col-lg-3">
                                                                                                            <label class="mt-10">Gender</label>
                                                                                                            <select name="familygender[]" id="gender" class="form-select gender" required="">
                                                                                                                <option value="male">Male</option>
                                                                                                                <option value="female">Female</option>
                                                                                                                <option value="other">Specify other</option>
                                                                                                            </select>
                                                                                                            <span class="error" id="err_gender"></span>
                                                                                                        </div>
                                                                                                        <div class="col-md-4 col-lg-3">
                                                                                                            <label class="mt-10">Relationship</label>
                                                                                                            <select name="relationship[]" id="relationship" class="form-select relationship required">
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
                                                                                                            <input maxlength="14" type="text" name="mphone[]" id="mphone" class="form-control mobile_number" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone" required>
                                                                                                            <span class="error" id="err_mphone"></span>
                                                                                                        </div>
                                                                                                        <div class="col-md-4 col-lg-3">
                                                                                                            <label class="mt-10">Email</label>
                                                                                                            <input type="email" name="emailid[]" id="emailid" class="form-control email" required onblur="getCode(0,'email');">
                                                                                                            <span class="error" id="err_emailid"></span>
                                                                                                        </div>
                                                                                                        <div class="col-md-4 col-lg-3">
                                                                                                            <label class="mt-10">Check in Code </label>
                                                                                                            <input type="text" name="check_in_code[]" id="check_in_code" size="30" maxlength="4" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control check_in_code0" onblur="getCode(0,'code');">
                                                                                                            <div class="font-red" id="check_in_error_family0"></div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="border-bottom-grey  mt-15 mb-15"></div>
                                                                                                    <div class="row">
                                                                                                        <div class="col-lg-12">
                                                                                                            <div class="additional-lab">
                                                                                                                <label>Additional</label>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-4 col-lg-3">
                                                                                                            <label class="mt-10">Emergency Name</label>
                                                                                                            <input type="text" name="emergency_name[]" id="emergency_name" class="form-control emergency_name" >
                                                                                                            <span class="error" id="err_emergency_name"></span>
                                                                                                        </div>
                                                                                                        <div class="col-md-4 col-lg-3">
                                                                                                            <label class="mt-10">Emergency Phone</label>
                                                                                                            <input maxlength="14" type="text" name="emergency_phone[]" id="emergency_phone" class="form-control emergency_phone"  onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
                                                                                                            <span class="error" id="err_emergency_phone"></span>
                                                                                                        </div>
                                                                                                        <div class="col-md-4 col-lg-3">
                                                                                                            <label class="mt-10">Emergency Email</label>
                                                                                                            <input type="text" name="emergency_email[]" id="emergency_email" class="form-control emergency_email" >
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

                                                                                                        <!-- <div class="col-md-4 col-lg-3">
                                                                                                            <label class="mt-10">Check in Code </label>
                                                                                                            <input type="text" name="check_in_code[]" id="check_in_code" size="30" maxlength="4" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control check_in_code0" onblur="getCode(0,'code');">
                                                                                                            <div class="font-red" id="check_in_error_family0"></div>
                                                                                                        </div> -->

                                                                                                        <div class="col-md-4 col-lg-3"> 
                                                                                                            <div class="form-group check-box-info">
                                                                                                                <input class="check-box-primary-account primaryAcCheck" type="checkbox" id="primaryAccount" name="primaryAccount" value="1" >
                                                                                                                <label for="primaryAccount"> Primary Account <span class="" data-bs-toggle="tooltip" data-bs-placement="top" title="Choose the primary account holder to determine whose card covers bookings for up to two family members (e.g., Mom or Dad). All cards stored under the primary account will be available at checkout.">(i)</span></label>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="container-fuild">
                                                                                <div class="row">
                                                                                    <div class="col-md-12 col-lg-12 text-right">
                                                                                        <button type="button" class="btn btn-red mt-10" id="add_family">Add New Family Member</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <!-- <div class="add-client-sapre-tor"></div> -->

                                                                    <div class="create-customer-box">
                                                                        <div class="row">
                                                                            <div class="col-md-12 col-lg-12"><h4 class="font-red ">How did you hear about us</h4></div>
                                                                            <div class="container-fuild">
                                                                                <div class="row">
                                                                                    <div class="col-md-4 col-lg-3 mt-10">
                                                                                        <label class="mt-10">How did you hear about us?</label>
                                                                                        <select class="form-control" name="know_from">
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
                                                                        </div>
                                                                    </div>

                                                                    <!-- <div class="add-client-sapre-tor"></div> -->

                                                                    <div class="create-customer-box">
                                                                        <div class="row">
                                                                            <div class="col-md-12 col-lg-12"><h4 class="font-red ">
                                                                            Account Password</h4></div>
                                                                            <div class="container-fuild">
                                                                                <div class="row">
                                                                                    <label class="mt-10">Please pick a password to log-in to your account later.</label>
                                                                                    <div class="col-md-4 col-lg-3 mt-10">
                                                                                        <label class="mt-10">Password <span id="star">*</span></label>
                                                                                        <input type="text" name="password" id="password" class="form-control">
                                                                                    </div>
                                                                                    <div class="col-md-4 col-lg-3 mt-10">
                                                                                        <label class="mt-10">Confirm Password <span id="star">*</span></label>
                                                                                        <input type="text" name="confirmpassword" id="confirmpassword" class="form-control">
                                                                                    </div>
                                                                                </div>
                                                                            </div>                                                                    
                                                                        </div>
                                                                    </div>

                                                                    <!-- <div class="add-client-sapre-tor"></div> -->
                                                                    <!-- {{-- @php 
                                                                    $user = Auth::user();
                                                                    $currentCompany = $user->current_company;
                                                                    $businessTerms = null;
                                                                    
                                                                    if (!empty($currentCompany->id)) {
                                                                        $businessTerms = App\BusinessTerms::where('cid', $currentCompany->id)->first();
                                                                    }
                                                                    @endphp  
                                                                    <div class="create-customer-box">
                                                                        <div class="row"> 
                                                                            <div class="col-md-12 col-lg-12"><h4 class="font-red ">
                                                                                Agree to Terms, Waiver & Contract Signature</h4>
                                                                            </div>
                                                                    
                                                                            <div class="col-md-12">
                                                                                @if($businessTerms->termcondfaqtext != '' || $businessTerms->liabilitytext != '' || $businessTerms->covidtext != '' || $businessTerms->contracttermstext != '' || $businessTerms->refundpolicytext != '')
                                                                                    <div class="col-lg-12" id="termsdiv">
                                                                                        <div class="terms-head">
                                                                                            <div>
                                                                                                @if($businessTerms->termcondfaqtext != '')
                                                                                                    <a href="#" data-url="{{route('getTerms',['id'=>$businessTerms->id , 'termsType' => 'termcondfaqtext' ,'termsHeader'=>'Terms, Conditions, FAQ'])}}"  class="font-13 color-red-a" data-behavior = 'termsModelOpen' >Terms, Conditions, FAQ</a> | @endif 
                                                                                                
                                                                                                @if($businessTerms->liabilitytext != '')
                                                                                                    <a href="#" data-url="{{route('getTerms',['id'=>$businessTerms->id , 'termsType' =>'liabilitytext','termsHeader'=>'Liability Waiver'])}}"  class="font-13 color-red-a" data-behavior = 'termsModelOpen' >Liability Waiver</a> | @endif 

                                                                                                @if($businessTerms->covidtext != '')
                                                                                                    <a href="#" data-url="{{route('getTerms',['id'=>$businessTerms->id , 'termsType' =>'covidtext','termsHeader'=>'Covid - 19 Protocols'])}}"  class="font-13 color-red-a" data-behavior = 'termsModelOpen' >Covid - 19 Protocols</a> | @endif

                                                                                                @if($businessTerms->contracttermstext != '')
                                                                                                    <a href="#" data-url="{{route('getTerms',['id'=>$businessTerms->id , 'termsType' =>'contracttermstext','termsHeader'=>'Contract Terms'])}}"  class="font-13 color-red-a" data-behavior = 'termsModelOpen' >Contract Terms</a> | @endif 

                                                                                                @if($businessTerms->refundpolicytext != '')
                                                                                                    <a href="#" data-url="{{route('getTerms',['id'=>$businessTerms->id , 'termsType' =>'refundpolicytext','termsHeader'=>'Refund Policy'])}}"  class="font-13 color-red-a" data-behavior = 'termsModelOpen' >Refund Policy</a> 
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                                                            @if($businessTerms)
                                                                                <label class="mt-10">To continue, please read the terms & waivers above. A signature is required to participate. </label>
                                                                            @endif --}} -->
                                                                            @php 
                                                                            $user = Auth::user();
                                                                            $currentCompany = $user->current_company;
                                                                            $businessTerms = null;

                                                                            if (!empty($currentCompany->id)) {
                                                                                $businessTerms = App\BusinessTerms::where('cid', $currentCompany->id)->first();
                                                                            }
                                                                            @endphp  

                                                                            <div class="create-customer-box">
                                                                                <div class="row"> 
                                                                                    <div class="col-md-12 col-lg-12">
                                                                                        <h4 class="font-red">Agree to OmneBook, Waiver & Contract Signature</h4>
                                                                                    </div>

                                                                                    <div class="col-md-12">
                                                                                        @if($businessTerms && (
                                                                                            $businessTerms->termcondfaqtext != '' || 
                                                                                            $businessTerms->liabilitytext != '' || 
                                                                                            $businessTerms->covidtext != '' || 
                                                                                            $businessTerms->contracttermstext != '' || 
                                                                                            $businessTerms->refundpolicytext != '')
                                                                                        )
                                                                                            <div class="col-lg-12" id="termsdiv">
                                                                                                <div class="terms-head">
                                                                                                    <div>
                                                                                                        @if($businessTerms->termcondfaqtext != '')
                                                                                                            <a href="#" data-url="{{ route('getTerms', ['id' => $businessTerms->id, 'termsType' => 'termcondfaqtext', 'termsHeader' => 'Terms, Conditions, FAQ']) }}" class="font-13 color-red-a" data-behavior="termsModelOpen">Terms, Conditions, FAQ</a> | 
                                                                                                        @endif 
                                                                                                        
                                                                                                        @if($businessTerms->liabilitytext != '')
                                                                                                            <a href="#" data-url="{{ route('getTerms', ['id' => $businessTerms->id, 'termsType' => 'liabilitytext', 'termsHeader' => 'Liability Waiver']) }}" class="font-13 color-red-a" data-behavior="termsModelOpen">Liability Waiver</a> | 
                                                                                                        @endif 

                                                                                                        @if($businessTerms->covidtext != '')
                                                                                                            <a href="#" data-url="{{ route('getTerms', ['id' => $businessTerms->id, 'termsType' => 'covidtext', 'termsHeader' => 'Covid - 19 Protocols']) }}" class="font-13 color-red-a" data-behavior="termsModelOpen">Covid - 19 Protocols</a> | 
                                                                                                        @endif

                                                                                                        @if($businessTerms->contracttermstext != '')
                                                                                                            <a href="#" data-url="{{ route('getTerms', ['id' => $businessTerms->id, 'termsType' => 'contracttermstext', 'termsHeader' => 'Contract Terms']) }}" class="font-13 color-red-a" data-behavior="termsModelOpen">Contract Terms</a> | 
                                                                                                        @endif 

                                                                                                        @if($businessTerms->refundpolicytext != '')
                                                                                                            <a href="#" data-url="{{ route('getTerms', ['id' => $businessTerms->id, 'termsType' => 'refundpolicytext', 'termsHeader' => 'Refund Policy']) }}" class="font-13 color-red-a" data-behavior="termsModelOpen">Refund Policy</a> 
                                                                                                        @endif
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        @endif
                                                                                    </div>
                                                                                    @if($businessTerms)
                                                                                        <label class="mt-10">To continue, please read the terms & waivers above. A signature is required to participate.</label>
                                                                                    @endif
 
                                                                            <div class="container-fuild">
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
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    
                                                                    <!-- {{-- ends --}} -->
                                                                    <div class="row">
                                                                        <div class="col-md-12 col-lg-12 text-center">
                                                                            <div class="wrap-sp">
                                                                                <input type="checkbox" name="b_trm1"
                                                                                    id="b_trm1" class="form-check-input"
                                                                                    value="1">
                                                                                <label for="b_trm1" class="text-center">I agree
                                                                                    to Fitnessity Terms of Service and Privacy
                                                                                    Policy</label>
                                                                            </div>
                                                                            <div id="termserror"
                                                                                class="font-red fs-15 text-center mb-10"></div>
                                                                            <div id="systemMessage" class="mb-10 fs-15 mb-10">
                                                                            </div>
                                                                            <div class="row d-none" id="loading-img">
                                                                                <div class="col-md-12">
                                                                                    <div
                                                                                        class="loading-container text-center loading-width mb-10">
                                                                                        <img src="{{ '/public/images/processing.gif' }}"
                                                                                            alt="Processing..." />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12 col-lg-12 text-center">
                                                                            <button type="button"
                                                                                class="btn btn-red register_submit"
                                                                                id="register_submit"
                                                                                onclick="getType('submit');">Add Credit
                                                                                Card</button>
                                                                            <button type="button"
                                                                                class="btn btn-red register_submit"
                                                                                id="register_skip" data-type="skip"
                                                                                onclick="getType('skip');">Skip</button>
                                                                        </div>
                                                                    </div>

                                                                </form>
                                                            </div>
                                                            
                                                            <div id="paymentform" style="display:none">
                                                                <input type="hidden" id="client_secret" value="">
                                                                <div class="row">
                                                                    @if (session('stripeErrorMsg'))
                                                                        <div class="col-md-12">
                                                                            <div class='form-row row'>
                                                                                <div class='col-md-12  error form-group'>
                                                                                    <div class="alert-danger alert">
                                                                                        {{ session('stripeErrorMsg') }}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    <div class="" style="height: 50vh;">
                                                                    <form id="payment-form1" data-secret="">
                                                                        <div>
                                                                            <div id="payment-element1"></div>
        
                                                                            <div id="error-message1" class="alert alert-danger mt-10" role="alert" style="display: none;"></div>
                                                                        </div>
                                                                        <div class="text-center mt-25">
                                                                            <button class="btn btn-red mr-5" type="submit" id="submitStripe">Add on file</button>
                                                                            <button type="button" class="btn btn-red" id="skip_next">Skip</button>
                                                                        </div>
                                                                        <input type="hidden" name="buttonType" id="buttonType"
                                                                        value="">
                                                                    </form>
                                                                    </div>
                                                                    
                                                                </div>
                                                            </div>
                                                       
                                                        </div>
                                                        <div class="tab-pane" id="search" role="tabpanel">
                                                            <div class="text-center font-black mt-20 mb-20">
                                                                <h3 class="mb-10">Already have an account on OmneBook?</h3>
                                                                <h4>Search for your name and get access and sync your information fast.</h4>
                                                                <!-- <p>“Your client could already have an account on OmneBook.<br>If so, get access and sync their information fast.”</p> -->
                                                            </div>
                                                            <div class="row check-txt-center claimyour-business">
                                                                <div class="col-md-10 col-xs-10 col-8 frm-claim">
                                                                    <input id="clients_name" style="margin-top:10px;" type="text" class="form-control" placeholder="Search for your name" autocomplete="off" data-customer-id="">
                                                                    
                                                                    <div class="request-access" style="display:none">
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
    </div>
    

    <!-- {{-- ends here --}} -->
    <!-- my code start -->

    <div class="modal fade exitModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" onclick="window.location.reload()"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-20">
                        <h2 class="font-red">Exit Check-In Mode</h2>
                        <p>To deactivate check-in mode, please enter your staff passcode</p>
                    </div>
                    <div class="d-flex justify-content-center mb-20">
                        <input type="text" class="form-control w-50 numberfield" id="numberInput"
                            placeholder="Enter 4 digit code.."
                            onkeypress="return event.charCode >= 48 && event.charCode <= 57" disabled>
                    </div>
                    <div class="container">
                        <div id="pincode_check">
                            <div class="table">
                                <div class="">
                                    <div id="numbers_check" class="numbers_check">
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
                                            <div class="grid__col grid__col--1-of-3"><button class="fs-20"><i
                                                        class="fas fa-backspace"></i></button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center text-danger fs-16" id="error-message-code"></div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-red" id="checkInExit">Exit</button> -->
                    <button type="button" class="btn btn-red" id="checkInExit" data-bs-toggle="modal"
                        data-bs-target="#exit-text">Exit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ends -->
    <!-- my new code goes here -->
    <div class="modal" id="termsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" id="termsModelContent"></div>
        </div>
    </div>
    <!-- ends here -->
    <script>
        jQuery(document).ready(function($) {
            var pin = +!![] + [] + (!+[] + !![] + []) + (!+[] + !![] + !![] + []) + (!+[] + !![] + !![] + !![] +
        []);

            $("#numbers_check button").click(function() {
                var enterCode = $("#numberInput").val();
                enterCode.toString();
                var clickedNumber = $(this).text().toString();

                if (clickedNumber != '') {
                    enterCode = enterCode + clickedNumber;
                    // Update the input field
                    $("#numberInput").val(enterCode);

                    var lengthCode = parseInt(enterCode.length);
                    lengthCode--;
                    $("#fields .numberfield:eq(" + lengthCode + ")").addClass("active");

                    if (lengthCode > 3) {
                        $("#numberInput").val(clickedNumber);
                    }
                } else {
                    var originalString = $('#numberInput').val();
                    $('#numberInput').val(originalString.slice(0, -1));
                }
            });
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#checkInExit').click(function(e) {
                e.preventDefault();
                $('#error-message-code').removeClass('text-success text-danger').html('');
                var checkInCode = $('#numberInput').val();
                if (checkInCode === '') {
                    $('#error-message-code').addClass('text-danger').text('Please enter a 4 digit code.');
                    return;
                }

                $.ajax({
                    url: "{{ route('checkin.chk-chckin-code_exit') }}",
                    type: 'POST',
                    data: {
                        code: checkInCode,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log(response.success);
                            $('#error-message-code').addClass('text-success').text(response
                                .message || 'An error occurred. Please try again.');
                            window.location.href = response.url
                        } else {
                            $('#numberInput').val('');
                            $('#error-message-code').addClass('text-danger').text(response
                                .message || 'An error occurred. Please try again.');
                        }
                    },
                    error: function(xhr, status, error) {
                        $('#numberInput').val('');
                        $('#error-message-code').addClass('text-danger').text(
                            'An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>

    <!-- my new script goes here -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        /*
        $(document).ready(function() {
            $('#signupButton').on('click', function() {
                var url = $(this).data('url');
                var businessId = $(this).data('business-id');

                $.ajax({
                    url: url,
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        var htmlContent = response.html;
                        $('#customerModal .modal-body').html(htmlContent);
                        $('#customerModal').modal('show'); 
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        }); */
        function getType(type)
        {
            $('#buttonType').val(type);
            $('#clientRegistration').submit();
        }
    </script>
    @include('layouts.business.footer')
    @include('layouts.business.scripts')

    <script type="text/javascript">
    $(document ).ready(function() {
        flatpickr('.add-client-birthdate', {
            altInput: true,
            altFormat: "m/d/Y",
            dateFormat: "Y-m-d",
            maxDate: "today",
            onChange: function(selectedDates, dateStr, instance) {
                var age = calculateAge(dateStr);
                if (age < 18) {
                    $('.check-box-primary-account:first').prop('disabled', true);
                    if ($('.check-box-primary-account:first').is(':checked')) {
                        $('.check-box-primary-account:first').prop('checked', false);
                    }
                } else {
                    $('.check-box-primary-account:first').prop('disabled', false);
                }
            }
        });
    });

        function assignfliptpicker(val)
        { 
            // alert('call');
            flatpickr('.'+val, {
                altInput: true,
                altFormat: "m/d/Y",
                dateFormat: "Y-m-d",
                maxDate: "today",
                onChange: function(selectedDates, dateStr, instance) {
                    var age = calculateAge(dateStr);
                    if (age < 18) {
                        $('.check-box-primary-account:first').prop('disabled', true);
                        if ($('.check-box-primary-account:first').is(':checked')) {
                            $('.check-box-primary-account:first').prop('checked', false);
                        }
                    } else {
                        $('.check-box-primary-account:first').prop('disabled', false);
                    }
                }
            });
        }


    </script>
    <script type="text/javascript">
        $(document ).ready(function() {
            flatpickr('#birthdate0', {
               // altInput: true,
               // altFormat: "m/d/Y",
                dateFormat: "m/d/Y",
                maxDate: "today",
                onChange: function(selectedDates, dateStr, instance) {
                    var age = calculateAge(dateStr);
                    if (age < 18) {
                        $('.check-box-primary-account:first').prop('disabled', true);
                        if ($('.check-box-primary-account:first').is(':checked')) {
                            $('.check-box-primary-account:first').prop('checked', false);
                        }
                    } else {
                        $('.check-box-primary-account:first').prop('disabled', false);
                    }
                }
            });
        });
        </script>
  
 
    <script type="text/javascript">
        const canvas = document.getElementById('signatureCanvas');
        const ctx = canvas.getContext('2d');
        var drawing = false;

        function startDrawing(e) {
            e.preventDefault();
            var pos = getMouseOrTouchPos(canvas, e);
            ctx.beginPath();
            ctx.moveTo(pos.x, pos.y);
            drawing = true;
        }

        function draw(e) {
            e.preventDefault();
            if (!drawing) return;

            var pos = getMouseOrTouchPos(canvas, e);
            ctx.lineTo(pos.x, pos.y);
            ctx.stroke();
        }

        function stopDrawing(e) {
            e.preventDefault();
            drawing = false;
        }

        function getMouseOrTouchPos(canvas, e) {
            var rect = canvas.getBoundingClientRect();
            var clientX, clientY;

            if (e.touches && e.touches.length > 0) {
                clientX = e.touches[0].clientX;
                clientY = e.touches[0].clientY;
            } else {
                clientX = e.clientX;
                clientY = e.clientY;
            }

            return {
                x: clientX - rect.left,
                y: clientY - rect.top
            };
        }

        // Add unified event listeners
        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing);

        canvas.addEventListener('touchstart', startDrawing);
        canvas.addEventListener('touchmove', draw);
        canvas.addEventListener('touchend', stopDrawing);
        canvas.addEventListener('touchcancel', stopDrawing);

        const clearButton = document.getElementById('clearButton');
        clearButton.addEventListener('click', clearCanvas);

        function clearCanvas() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }
    </script>
    <!-- {{-- my code start --}} -->
<script>
 $(document).on('blur', '#email', function(e){
            var inputVal = $(this).val();
            $.ajax({
                url: '{{ route("get_checkin_code") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    email: inputVal,
                    fname: $('#firstname').val(),
                    lname: $('#lastname').val(),
                },
                success: function(response) {
                    $('#check_in').val(response);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        }); 

        $(document).on('blur', '#check_in', function(e){
            $('#check_in_error').html('');
            var inputVal = $(this).val();

            $.ajax({
                url: '{{ route("get_checkin_code") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    checkin_code: inputVal,
                    email: $('.myemail').val(),
                },
                success: function(response) {
                    if(response == 1){
                         $('#check_in_error').html('Code already taken by another user. If you don\'t change this code system will automatically assign you a new check in code.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        });

        function getCode(id,type){
        	if(type == 'code'){
        		$('#check_in_error_family'+id).html('');
        		$.ajax({
	                url: '{{ route("get_checkin_code") }}',
	                type: 'POST',
	                data: {
	                    _token: '{{ csrf_token() }}',
	                    checkin_code: $('.check_in_code'+id).val(),
	                    email: $('.email'+id).val(),
	                },
	                success: function(response) {
	                    if(response == 1){
	                    	$('#check_in_error_family'+id).html('Code already taken by another user. If you don\'t change this code system will automatically assign you a new check in code.')
	                    }
	                },
	                error: function(xhr, status, error) {
	                    console.error('AJAX Error:', error);
	                }
	            });
        	}else{
        		$.ajax({
                	url: '{{ route("get_checkin_code") }}',
	                type: 'POST',
	                data: {
	                    _token: '{{ csrf_token() }}',
	                    email: $('.email'+id).val(),
	                    fname: $('.fname'+id).val(),
	                    lname: $('.lname'+id).val(),
	                },
	                success: function(response) {
	                     $('.check_in_code'+id).val(response);
	                },
	                error: function(xhr, status, error) {
	                    console.error('AJAX Error:', error);
	                }
	            });
        	}
        }
        function calculateAge(dateStr) {
           var birthDate = new Date(dateStr);
            var currentDate = new Date();
            var age = currentDate.getFullYear() - birthDate.getFullYear();
            var monthDiff = currentDate.getMonth() - birthDate.getMonth();
            if (monthDiff < 0 || (monthDiff === 0 && currentDate.getDate() < birthDate.getDate())) {
                age--;
            }

            return age;
        }

        function deletediv(i){
            var cnt = $('#familycnt').val();
            cnt--;
            $('#familycnt').val(cnt);
            $('#familydiv'+i).remove();
        }

        $(document).on("click",'#add_family',function(e){
            var cnt = $('#familycnt').val();
            cnt++;
            var data = '';
            var dataIValue = 0;
            var familyDivs = document.querySelectorAll(".new-client");
            familyDivs.forEach(function(element) {
                dataIValue = element.getAttribute("data-i");
                dataTxt = element.getAttribute("data-text");
            });
            var old_cnt = dataIValue;
            var new_cnt = old_cnt;
            var txtcount = dataTxt;
            txtcount++;
            new_cnt++;
            data += '<div class="new-client mb-10" id="familydiv'+new_cnt+'" data-i="'+new_cnt+'" data-text="'+txtcount+'" >';
            data += $('#familydiv'+old_cnt).html();
            data += '</div>';
            var re = data.replaceAll("heading"+old_cnt,"heading"+new_cnt);
            re = re.replaceAll("collapse"+old_cnt,"collapse"+new_cnt);
            re = re.replaceAll("birthday_date"+old_cnt,"birthday_date"+new_cnt);
            re = re.replaceAll("birthdate"+old_cnt,"birthdate"+new_cnt);
            re = re.replaceAll("deletediv"+old_cnt,"deletediv"+new_cnt);
            re = re.replaceAll("Family Member #"+dataTxt,"Family Member #"+txtcount);
            re = re.replaceAll("primaryAcCheck"+old_cnt,"primaryAcCheck"+new_cnt);
            re = re.replaceAll("getCode("+old_cnt,"getCode("+new_cnt);
            re = re.replaceAll("fanem"+old_cnt,"fanem"+new_cnt);
            re = re.replaceAll("lname"+old_cnt,"lname"+new_cnt);
            re = re.replaceAll("check_in_code"+old_cnt,"check_in_code"+new_cnt);
            re = re.replaceAll("check_in_error_family"+old_cnt,"check_in_error_family"+new_cnt);
            var $data = $(re);
            $data.find('.check-box-info').remove();
            var modifiedData = $data[0].outerHTML;
            $('#familymaindiv').append(modifiedData);
            $("#check_in_error_family"+new_cnt).html('');
            $('#deletediv'+new_cnt).html('<div class="setting-icon"> <i class="ri-more-fill"></i> <ul> <li><a onclick="deletediv('+new_cnt+')"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li></ul></div>');
            $('.relationship').each(function(e) {
                $(this).removeClass("font-red");
            });
            $('.email').each(function(e) {
                $(this).removeClass("font-red");
            });
            $('.gender').each(function(e) {
                $(this).removeClass("font-red");
            });
            $(".required").each(function() {
                $(this).removeClass("font-red");
            });
            $('#familycnt').val(cnt);
           var varnm='#birthdate'+new_cnt;
           flatpickr(varnm, {
                dateFormat: "m/d/Y", maxDate: "today",
                onChange: function(selectedDates, dateStr, instance) {
                    var age = calculateAge(dateStr);
                    if (age < 18) {
                        $('.check-box-primary-account:first').prop('disabled', true);
                        if ($('.check-box-primary-account:first').is(':checked')) {
                            $('.check-box-primary-account:first').prop('checked', false);
                        }
                    } else {
                        $('.check-box-primary-account:first').prop('disabled', false);
                    }
                }
            });
           
        });

        $(document).on('click', '[data-behavior~=termsModelOpen]', function(e){
            e.preventDefault()
            $.ajax({
                url: $(this).data('url'),
                success: function(html){
                    $('#termsModelContent').html(html)
                    $('#termsModal').modal('show')
                }
            })
        });
</script>
@php 
$user = Auth::user();
$currentCompany = $user->current_company;
@endphp

@if(isset($currentCompany))
<!-- {{-- {{ $currentCompany->id }} --}} -->
<script>
jQuery(function ($) {
    var businessId = "{{ $currentCompany->id }}";
            $.validator.addMethod("uniqueCheckInCodes", function(value, element) {
                var codes = [];
                $('input[name="check_in_code[]"]').each(function() {
                    if ($(this).val() !== '') {
                        codes.push($(this).val());
                    }
                });
                var uniqueCodes = Array.from(new Set(codes));
                return codes.length === uniqueCodes.length;
            }, 'Check-in codes must be unique.');

            $('#clientRegistration').validate({
                rules: {
                    firstname: "required",
                    lastname: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    dob: 'required',
                    contact: 'required',
                    password: {
                        required: true,
                        minlength: 8
                    },
                    confirmpassword: {
                        required: true,
                        equalTo: '#password'
                    },
                    'check_in_code[]': {
                        required: true,
                        minlength: 4,
                        maxlength: 4,
                        uniqueCheckInCodes: true // Use the custom method here
                    }
                },
                messages: {
                    firstname: "Enter your Firstname",
                    lastname: "Enter your Lastname",
                    dob: "Enter your Birthdate",
                    email: {
                        required: "Please enter a valid email address",
                    },
                    contact: {
                        required: "Enter your Phone Number",
                    },
                    password:  {
                        required: 'Please enter a password',
                        minlength: 'Password must be at least 8 characters long'
                    },
                    confirmpassword: {
                        required: 'Please confirm your password',
                        equalTo: 'Passwords do not match'
                    },
                            'check_in_code[]': {
                        required: 'Please enter a check-in code',
                        minlength: 'Check-in code must be exactly 4 digits',
                        maxlength: 'Check-in code must be exactly 4 digits',
                        uniqueCheckInCodes: 'Check-in codes must be unique.'
                    }
                },
                submitHandler: function (form) {
                    $("#termserror").html('');
                    $("#systemMessage").html('');
                    $('#signpath').val(canvas.toDataURL());

                    $('#loading-img').addClass('d-none');
                    if ($('#dob').val() == '') {
                        $("#systemMessage").html('Please Enter Your Birthdate.').addClass('font-red alert-class alert-danger');
                        return false;
                    }

                    if (!jQuery("#b_trm1").is(":checked")) {
                        $("#termserror").html('Plese Agree Terms of Service and Privacy Policy.').addClass('alert-class alert-danger');
                        return false;
                    }

                    var imageData = ctx.getImageData(0, 0, canvas.width, canvas.height).data;
                    var isSignatureEmpty = imageData.every(value => value === 0);
                    if (isSignatureEmpty) {
                        $("#systemMessage").html('Please provide a signature.').addClass('font-red alert-class alert-danger');
                        return false;
                    }

                    var formData = $("#clientRegistration").serialize();
                    $.ajax({
                    url: '/customers/registration',
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    beforeSend: function () {
                        $("#termserror").html('');
                        $('.register_submit').prop('disabled', true).css('background','#98002e');
                        $('#systemMessage').addClass('font-red');

                        $('#loading-img').removeClass('d-none');
                        //$("#systemMessage").html('Please wait while we register you with Fitnessity.').addClass('alert-class alert-danger');
                    },
                    complete: function () {
                        $('.register_submit').prop('disabled', false).css('background','#98002e');
                    },
                    success: function (response) {
                       
                        if (response.type === 'success') {
                            if ($('#buttonType').val() == 'skip') {
                                // window.location.href = 'check-in-welcome';
                                window.location.href = '/dashboard';
                            }
                            else {
                                 $.ajax({
                                    url: '/create-customer_data',
                                    type: 'GET',
                                    dataType: 'json',
                                    data: {
                                        businessId:businessId ,
                                        customer_id: response.id
                                    },
                                    beforeSend: function () {
                                        $("#termserror").html('');
                                        $('.register_submit').prop('disabled', true).css('background','#1c256c');
                                        $('#systemMessage').addClass('font-red');
                                        $('#loading-img').removeClass('d-none');
                                    },
                                    complete: function () {
                                        $('.register_submit').prop('disabled', false).css('background','#1c256c');
                                    },
                                    success: function (response) {
                                        if (response) {
                                            $('#clientRegistration_form').hide();
                                            $('#paymentform').show();
                                            if (response.clientSecret) {
                                                // console.log(response.clientSecret);
                                                $('.modal-dialog').removeClass('modal-xl').addClass('modal-md');
                                                $('.modal .page-content').removeAttr('style').removeClass();

                                                $('#client_secret').val(response.clientSecret);            
                                                $('#payment-form1').attr('data-secret', response.clientSecret)
                                                if (response.customer_id !== '') {
                                                     paymentform(response.customer_id);
                                                }
                                            }
                                            if (response.successMsg) {
                                                $("#systemMessage").html(response.successMsg).removeClass('alert-danger').addClass('alert-success');
                                                window.location.href = '/dashboard';
                                            }
                                        } else {
                                            $('#loading-img').addClass('d-none');
                                            $("#systemMessage").html("An error occurred").addClass('alert-class alert-danger');
                                        }
                                    },
                                    error: function () {
                                        $('#loading-img').addClass('d-none');
                                        $("#systemMessage").html("An error occurred").addClass('alert-class alert-danger');
                                        $('.register_submit').prop('disabled', false).css('background','#ed1b24');
                                    }
                                });
                            }
                        
                        } else {
                        	$('#loading-img').addClass('d-none');
                            $("#systemMessage").html(response.msg).addClass('alert-class alert-danger');
                            $('.register_submit').prop('disabled', false).css('background','#ed1b24');
                        }
                    }
                });
                }
            });
        });

</script>
@endif

<script type="text/javascript">
    $(document).ready(function () {
        var url = "{{ url('/searchuser') }}";
        $( "#clients_name" ).autocomplete({
            source: url,
            focus: function( event, ui ) {
                 return false;
            },
            select: function( event, ui ) {
                $("#clients_name").val( ui.item.firstname + ' ' +  ui.item.lastname);
                $('#clients_name').data('customer-id', ui.item.id);
                $('.request-access').css('display','block');
                $('.request-access').html('<p>To import the name, contact information, family members and credit card information for '+ ui.item.firstname + ' ' +  ui.item.lastname +', they must authorize you access.</p><label>Steps </label><div class="request-step"><p>1. Click the Request Access button below. </p><p>2. OmneBook will send an email to the customer to authorize you access.</p><p>3. Once authorization has been granted, the sync button will turn green, and you can sync the information immediately.</p><button type="button" style="margin-bottom: 10px;" class="signup-new request_access_btn" id="request_access_btn">Request Access</button></div><div class="error text-center errclass"></div>');
                 return false;
            },
        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
             let profile_img = '<div class="collapse-img"><div class="company-list-text" style="height: 50px;width: 50px;"><p style="padding: 0;">' + item.firstname.charAt(0).toUpperCase() + '</p></div></div> ';

            if(item.profile_pic_url){
                profile_img = '<img class="searchbox-img" src="' + (item.profile_pic ? item.profile_pic : '') + '" style="">';            
            }

            var inner_html = '<div class="row rowclass-controller"></div><div class="row"><div class="col-md-3 nopadding text-center">' + profile_img + '</div><div class="col-md-9 div-controller">' + 
                      '<p class="pstyle"><label class="liaddress">' + item.firstname + ' ' +  item.lastname  + (item.age ? ' (' + item.age+ '  Years Old)' : '') + '</label></p>' +
                      '<p class="pstyle liaddress">' + item.email +'</p>' + 
                      '<p class="pstyle liaddress">' + item.phone_number + '</p></div></div>';
           
            return $( "<li></li>" )
                    .data( "item.autocomplete", item )
                    .append(inner_html)
                    .appendTo( ul );
        };
    });
</script>

@if(isset($currentCompany))
<script>
  $(document).on("click",'.request_access_btn',function(e){
    var businessId = "{{ $currentCompany->id }}";
        $.ajax({
            url: "{{route('sendgrantaccessmail')}}",
            method: "POST",
            data: { 
                _token: '{{csrf_token()}}', 
                id:$('#clients_name').data('customer-id'),
                business_id:businessId 
            },
            success: function(response){
                $('.errclass').removeClass('font-green');
                if(response == 'already'){
                    $('.errclass').html("<p> Request access already granted. And user already sync with this business.</p>");
                    $('.request_access_btn').attr('disabled', 'disabled');
                }else if(response == 'success'){
                    $('.errclass').removeClass('error');
                    $('.errclass').addClass('font-green');
                    $('.errclass').html('<p>Email Successfully Sent..</p><a class="request_access_btn">Resend Email</a>');
                }else{
                    $('.errclass').html("<p>Can't Send Mail to your mail..</p>");
                }
            }
        });
    });
</script>
@endif

@if(request()->customer_id)
    <script type="text/javascript">
        var customer_id = '{{ request()->customer_id }}';
        var businessId = "{{ $currentCompany->id }}";

        const stripe1 = Stripe('{{ env('STRIPE_PKEY') }}');
        const options1 = {
            clientSecret: $('#client_secret').val(),
            appearance: {
                theme: 'flat'
            },
        };

        const elements1 = stripe1.elements(options1);
        const paymentElement1 = elements1.create('payment');
        paymentElement1.mount('#payment-element1');

        const form = document.getElementById('payment-form1');
        const cus_id = customer_id;
        var return_url = '/business/' + businessId + '/customers/' + customer_id;
        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            $('#submitStripe').text('Loading...');

            const { error } = await stripe1.confirmSetup({
                elements: elements1,
                confirmParams: {
                    return_url: '/business/' + businessId + '/customers/refresh_payment_methods?customer_id=' + cus_id,
                }
            });

            if (error) {
                const messageContainer1 = document.querySelector('#error-message1');
                messageContainer1.textContent = error.message;
                $('#error-message1').show();
            } else {
                // Handle success if needed
            }
            $('#submitStripe').text('Add on file');
        });

        $(document).on('click', '#skip_next', function () {
            window.location.href = '/dashboard';
        });
    </script>
@endif
@php 
$user = Auth::user();
$currentCompany = $user->current_company;
@endphp
<script>
    function paymentform(customer_id) {
        var businessId = "{{ $currentCompany->id }}";
        const stripe1 = Stripe('{{ env('STRIPE_PKEY') }}');
        const options1 = {
            clientSecret: $('#client_secret').val(),
            appearance: {
                theme: 'flat'
            },
        };
        const elements1 = stripe1.elements(options1);
        const paymentElement1 = elements1.create('payment');
        paymentElement1.mount('#payment-element1');
        const form = document.getElementById('payment-form1');
        const cus_id = customer_id;
        var return_url = '/business/' + businessId + '/customers/' + customer_id;

        form.addEventListener('submit', function(event) {
            event.preventDefault();
            $('#submitStripe').text('Loading...');

            stripe1.confirmSetup({
                elements: elements1,
                confirmParams: {
                    return_url: '{{ route('business.customers.refresh_payment_methods_modal',['business_id' => $currentCompany->id ])}}?customer_id=' + cus_id,
                }
            }).then(function(result) {
                if (result.error) {
                    const messageContainer1 = document.querySelector('#error-message1');
                    messageContainer1.textContent = result.error.message;
                    $('#error-message1').show();
                } else {
                    $('#customerModal').modal('hide');
                }
                $('#submitStripe').text('Add on file');
            }).catch(function(error) {
                console.error('Error during confirmSetup:', error);
                $('#error-message1').text('An unexpected error occurred. Please try again.').show();
                $('#submitStripe').text('Add on file');
            });
        });

        $(document).on('click', '#skip_next', function () {
            window.location.href = '/dashboard';
            $('#customerModal').modal('hide');
        });
    }
</script>

@endsection
