<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Register</title>
    <link href="{{ asset('/dashboard-design/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel='stylesheet' type='text/css' href="{{ asset('/css/bootstrap-select.min.css') }}">
    <link href="{{ url('/public/dashboard-design/css/style.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/public/dashboard-design/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('/public/dashboard-design/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ url('/public/css/all.css') }}">
</head>
<style>
    html {
        position: relative;
        min-height: 100%;
    }

    btn {
        width: auto;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0px;
        overflow-x: hidden;
        /* background: #fff; */
    }

    input {
        display: block;
        padding: 5px;
        width: 100%;
    }

    button {
        display: block;
        padding: 5px;
    }

    #loom-companion-mv3 {
        display: none;
    }

    .wrap-sp {
        display: inline-flex;
    }
    .register {
        padding-top: 80px;
    }
    .w-auto{
        width: auto;
    }
</style>
    @php
    $logBgColor =
        isset($companyinfo) && is_object($companyinfo)
            ? $companyinfo->reg_bg_color
            : '#defaultBackgroundColor';
    $logTextColor =
        isset($companyinfo) && is_object($companyinfo)
            ? $companyinfo->reg_textcolor
            : '#defaultTextColor';
            $bg=isset($companyinfo) && is_object($companyinfo)
            ? $companyinfo->reg_back_color
            : '#defaultBackgroundColor';
    @endphp
<body  style="background-color: {{ $bg }}">
    <div id="your-register-widget-container"></div>
    <div class="register card-body">
        <div class="container">
            <div class="live-preview">
                <div class="row justify-content-md-center">
                    <div class="col-lg-12">
                        <div class="text-center mb-35">
                            <h3 class="font-red">Create An Account</h3>
                        </div>
                        <form id="clientRegistration" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <h4 class="font-red">Personal Info</h4>
                                    <h6>Adult, Parent/Guardian 18+</h6>

                                </div>
                                <div class="col-md-4 col-lg-3">
                                    <label class="mt-10 ">First Name<span id="star">*</span></label>
                                    <input type="text" name="firstname" id="firstname" size="30" maxlength="80"
                                        class="form-control">
                                </div>
                                <div class="col-md-4 col-lg-3">
                                    <label class="mt-10">Last Name<span id="star">*</span></label>
                                    <input type="text" name="lastname" id="lastname" size="30" maxlength="80"
                                        class="form-control">
                                </div>
                                <div class="col-md-4 col-lg-3">
                                    <label class="mt-10">Email<span id="star">*</span></label>
                                    <input type="email" name="email" id="email" class="myemail form-control"
                                        size="30" maxlength="80" autocomplete="off">
                                </div>
                                <div class="col-md-4 col-lg-3">
                                    <label class="mt-10">Birthday<span id="star">*</span></label>
                                    <input type="hidden" class="form-control add-client-birthdate flatpickr-input"
                                        id="dob" name="dob">
                                    {{-- <input class="form-control add-client-birthdate form-control input" placeholder="" tabindex="0" type="text" readonly="readonly"> --}}
                                </div>

                                <div class="col-md-4 col-lg-3">
                                    <label class="mt-10">Phone <span id="star">*</span></label>
                                    <input type="text" name="contact" id="contact" size="30" maxlength="14"
                                        autocomplete="off"
                                        onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57"
                                        data-behavior="text-phone" class="form-control">
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
                                    <label class="mt-10">Check in Code </label>
                                    <input type="text" name="check_in" id="check_in" size="30" maxlength="4"
                                        autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                        class="form-control">
                                    <div class="font-red" id="check_in_error"></div>

                                </div>

                                <div class="col-md-4 col-lg-3">
                                    <div class="form-group check-box-info ">
                                        <input class="check-box-primary-account" type="checkbox"
                                            id="primaryAccountHolder" name="primaryAccountHolder" value="1">
                                            <label for="primaryAccountHolder"> Primary Account <span class="" data-bs-toggle="tooltip" data-bs-placement="top" title="You are paying for yourself and all added family members.">(i)</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="add-client-sapre-tor"></div>

                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <h4 class="font-red ">Address</h4>
                                </div>
                                <div class="col-md-4 col-lg-3 mt-10">
                                    <label>Address <span id="star">*</span></label>
                                {{-- <input type="text" class="form-control pac-target-input" autocomplete="off" name="address" id="addressCustomer" value="" required="" oninput="initMapCall('addressCustomer', 'cityCustomer', 'stateCustomer', 'countryCustomer', 'zipcodeCustomer', 'latitudeCustomer', 'longitudeCustomer')" aria-required="true">  --}}
                                    <input type="text" class="form-control pac-target-input" autocomplete="off" name="address" id="addressCustomer" value="" oninput="initMapCall('addressCustomer', 'cityCustomer', 'stateCustomer', 'countryCustomer', 'zipcodeCustomer', 'latitudeCustomer', 'longitudeCustomer')">
                                </div>
                                <div id="map" style="display: none;"></div>
                                <div class="col-md-4 col-lg-3 mt-10">
                                    <label for="City">City <span id="star">*</span></label>
                                    <input type="text" class="form-control" name="city" id="cityCustomer"
                                        size="30" maxlength="50" value="" required=""
                                        aria-required="true">
                                </div>
                                <input type="hidden" name="lon" id="longitudeCustomer" value="">
                                <input type="hidden" name="lat" id="latitudeCustomer" value="">

                                <div class="col-md-4 col-lg-3 mt-10">
                                    <label for="state">State <span id="star">*</span></label>
                                    <input type="text" class="form-control" name="state" id="stateCustomer"
                                    size="30" maxlength="50" value="" required=""
                                    aria-required="true">
                                </div>
                                <div class="col-md-4 col-lg-3 mt-10">
                                    <label for="country">Country <span id="star">*</span></label>
                                    <input type="text" class="form-control" name="country" id="countryCustomer"
                                    size="30" maxlength="50" value="" required=""
                                    aria-required="true">
                                </div>

                                <div class="col-md-4 col-lg-3 mt-10">
                                    <label for="zipcode">Zip Code <span id="star">*</span></label>
                                    <input type="text" class="form-control" name="zipcode" id="zipcodeCustomer"
                                    size="30" maxlength="50" value="" required=""
                                    aria-required="true">
                                </div>
                            </div>
                            <div class="add-client-sapre-tor"></div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 mt-20">
                                    <h4 class="font-red ">Add Family Members (Optional)</h4>
                                </div>
                                <div class="error mb-10" id="familyerrormessage"></div>
                                <input type="hidden" name="familycnt" id="familycnt" value="0">
                                <div id="familymaindiv">
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
                                                                <input type="text" class="form-control birthday_date0" name="birthdate[]" id="birthdate0">
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
                                                                <input maxlength="14" type="text" name="mphone[]" id="mphone" class="form-control mobile_number" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
                                                                <span class="error" id="err_mphone"></span>
                                                            </div>
                                                            <div class="col-md-4 col-lg-3">
                                                                <label class="mt-10">Email</label>
                                                                <input type="email" name="emailid[]" id="emailid" class="form-control email" required onblur="getCode(0,'email');">
                                                                <span class="error" id="err_emailid"></span>
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

                                                            <div class="col-md-4 col-lg-3">
                                                                <label class="mt-10">Check in Code </label>
                                                                <input type="text" name="check_in_code[]" id="check_in_code" size="30" maxlength="4" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" class="form-control check_in_code0" onblur="getCode(0,'code');">
                                                                <div class="font-red" id="check_in_error_family0"></div>
                                                            </div>

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
                                <div class="">
                                    <div class="col-md-12 col-lg-12 text-right">
                                        <button type="button" class="btn btn-red mt-10 w-auto" id="add_family" style="background-color: {{ $logBgColor }}; color: {{ $logTextColor }};">Add New Family
                                            Member</button>
                                    </div>
                                </div>
                            </div>
                            <div class="add-client-sapre-tor"></div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 mt-20">
                                    <h4 class="font-red ">How did you hear about us</h4>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-lg-4 mt-10">
                                        <label class="mt-10">How did you hear about us?</label>
                                        <select class="form-select" name="know_from">
                                            <option value="male">Search engine (Google, Bing, etc)</option>
                                            <option value="Google maps search">Google maps search</option>
                                            <option value="Referral">Referral</option>
                                            <option value="Social media">Social media</option>
                                            <option value="Online communities / forums">Online communities / forums
                                            </option>
                                            <option value="Online advertisement">Online advertisement</option>
                                            <option value="Offine advertisement">Offine advertisement</option>
                                            <option value="Noticed the physical location">Noticed the physical location
                                            </option>
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
                                <div class="col-md-12 col-lg-12 mt-20">
                                    <h4 class="font-red ">Account Password</h4>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <label class="mt-10">Please pick a password to log-in to your account later.</label>
                                        <div class="col-md-4 col-lg-3 mt-10">
                                            <label class="mt-10">Password</label>
                                            <input type="text" name="password" id="password" class="form-control">
                                        </div>
                                        <div class="col-md-4 col-lg-3 mt-10">
                                            <label class="mt-10">Confirm Password</label>
                                            <input type="text" name="confirmpassword" id="confirmpassword"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-client-sapre-tor"></div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12"><h4 class="font-red ">
                                    Agree to Terms, Waiver & Contract Signature</h4>
                                </div>

                                <div class="col-md-12">
                                    @if(@$businessTerms->termcondfaqtext != '' || @$businessTerms->liabilitytext != '' || @$businessTerms->covidtext != '' || @$businessTerms->contracttermstext != '' || @$businessTerms->refundpolicytext != '')
                                        <div class="col-lg-12" id="termsdiv">
                                            <div class="terms-head">
                                                <div>
                                                    @if($businessTerms->termcondfaqtext != '')
                                                        <a href="#" data-url="{{route('getTermsn',['id'=>$businessTerms->id , 'termsType' => 'termcondfaqtext' ,'termsHeader'=>'Terms, Conditions, FAQ'])}}"  class="font-13 color-red-a" data-behavior = 'termsModelOpen' >Terms, Conditions, FAQ</a> | @endif   
                                                    @if($businessTerms->liabilitytext != '')
                                                        <a href="#" data-url="{{route('getTermsn',['id'=>$businessTerms->id , 'termsType' =>'liabilitytext','termsHeader'=>'Liability Waiver'])}}"  class="font-13 color-red-a" data-behavior = 'termsModelOpen' >Liability Waiver</a> | @endif 

                                                    @if($businessTerms->covidtext != '')
                                                        <a href="#" data-url="{{route('getTermsn',['id'=>$businessTerms->id , 'termsType' =>'covidtext','termsHeader'=>'Covid - 19 Protocols'])}}"  class="font-13 color-red-a" data-behavior = 'termsModelOpen' >Covid - 19 Protocols</a> | @endif

                                                    @if($businessTerms->contracttermstext != '')
                                                        <a href="#" data-url="{{route('getTermsn',['id'=>$businessTerms->id , 'termsType' =>'contracttermstext','termsHeader'=>'Contract Terms'])}}"  class="font-13 color-red-a" data-behavior = 'termsModelOpen' >Contract Terms</a> | @endif 

                                                    @if($businessTerms->refundpolicytext != '')
                                                        <a href="#" data-url="{{route('getTermsn',['id'=>$businessTerms->id , 'termsType' =>'refundpolicytext','termsHeader'=>'Refund Policy'])}}"  class="font-13 color-red-a" data-behavior = 'termsModelOpen' >Refund Policy</a> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                @if(@$businessTerms)
                                    <label class="mt-10">To continue, please read the terms & waivers above. A signature is required to participate. </label>
                                @endif
                                {{-- <div class="col-md-12 col-lg-12 mt-20">
                                    <h4 class="font-red "> Agree to Terms, Waiver &amp; Contract Signature</h4>
                                </div> --}}
                                {{-- <div class="col-md-12">
                                    <div class="col-lg-12" id="termsdiv">
                                        <div class="terms-head"> --}}
                                            {{-- <div>
                                                <a href="#"
                                                    data-url="https://dev.fitnessity.co/getTerms?id=29&amp;termsType=refundpolicytext&amp;termsHeader=Refund%20Policy"
                                                    class="font-13 color-red-a" data-behavior="termsModelOpen">Refund
                                                    Policy</a>
                                            </div> --}}
                                        {{-- </div> --}}
                                    {{-- </div> --}}
                                {{-- </div> --}}
                                {{-- <label class="mt-10">To continue, please read the terms &amp; waivers above. A signature
                                    is required to participate. </label> --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <canvas id="signatureCanvas" name="signatureCanvas"></canvas>
                                        <input type="hidden" name="signpath" id="signpath" value="">
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="col-md-4 col-lg-3 col-lg-3">
                                            <button type="button" id="clearButton"
                                                class="btn btn-primary btn-black" style="background-color: {{ $logBgColor }}; color: {{ $logTextColor }};">Clear</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-lg-12 text-center">
                                    <div class="wrap-sp">
                                        <input type="checkbox" name="b_trm1" id="b_trm1" class="form-check-input"
                                            value="1">
                                        <label for="b_trm1" class="text-center">I agree to Fitnessity Terms of Service
                                            and Privacy Policy</label>
                                    </div>
                                    <div id="termserror" class="font-red fs-15 text-center mb-10"></div>
                                    <div id="systemMessage" class="mb-10 fs-15 mb-10"></div>
                                </div>
                            
                                <div class="col-md-12 col-lg-12 text-center">
                                    {{-- <button type="button" class="btn btn-red register_submit" id="register_submit"
                                        style="background-color: {{ $logBgColor }}; color: {{ $logTextColor }};"
                                        onclick="getType('submit');">Add Credit Card</button> --}}
                                    <button type="button" class="btn btn-red register_submit w-auto" id="register_skip"
                                        style="background-color: {{ $logBgColor }}; color: {{ $logTextColor }}; border: 1px solid {{ $logBgColor }};";

                                        onclick="getType('skip');">Skip</button>
                                </div>
                            </div>
                            <input type="hidden" name="buttonType" id="buttonType" value="">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ url('public/dashboard-design/js/jquery-3.6.4.min.js') }}"></script>
    <script src="{{ url('/public/dashboard-design/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('/public/dashboard-design/js/flatpickr.min.js') }}"></script>

    <div class="modal" id="termsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" id="termsModelContent"></div>
        </div>
    </div>

    

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDSB1-X7Uoh3CSfG-Sw7mTLl4vtkxY3Cxc"></script>
<script src="{{url('public/dashboard-design/js/jquery-3.6.4.min.js')}}"></script>
<script src="{{url('public/js/jquery-input-mask-phone-number.js')}}"></script>

    <script type="text/javascript">
        function initMapCall(addressInputID, cityElementID, stateElementID, countryElementID, zipcodeElementID,
            latElementID, lonElementID) {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: -33.8688,
                    lng: 151.2195
                },
                zoom: 13
            });
            var input = document.getElementById(addressInputID);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo('bounds', map);
            var infowindow = new google.maps.InfoWindow();
            var marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
            });

            autocomplete.addListener('place_changed', function() {
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }

                marker.setIcon(({
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(35, 35)
                }));

                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
                var address = '';
                var badd = '';
                var sublocality_level_1 = '';
                if (place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }

                infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                infowindow.open(map, marker);

                // Location details
                for (var i = 0; i < place.address_components.length; i++) {
                    if (place.address_components[i].types[0] == 'postal_code') {
                        $('#' + zipcodeElementID).val(place.address_components[i].long_name);
                    }

                    if (place.address_components[i].types[0] == 'locality') {
                        $('#' + cityElementID).val(place.address_components[i].long_name);
                    }

                    if (place.address_components[i].types[0] == 'sublocality_level_1') {
                        sublocality_level_1 = place.address_components[i].long_name;
                    }

                    if (place.address_components[i].types[0] == 'street_number') {
                        badd = place.address_components[i].long_name;
                    }

                    if (place.address_components[i].types[0] == 'route') {
                        badd += ' ' + place.address_components[i].long_name;
                    }

                    if (place.address_components[i].types[0] == 'country') {
                        $('#' + countryElementID).val(place.address_components[i].long_name);
                    }

                    if (place.address_components[i].types[0] == 'administrative_area_level_1') {
                        $('#' + stateElementID).val(place.address_components[i].long_name);
                    }
                }

                if (badd == '') {
                    $('#' + addressInputID).val(sublocality_level_1);
                } else {
                    $('#' + addressInputID).val(badd);
                }

                $('#' + latElementID).val(place.geometry.location.lat());
                $('#' + lonElementID).val(place.geometry.location.lng());
            });
        }
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>  
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
    <script>
        // flatpickr('.add-client-birthdate', {
        //     altInput: true,
        //     altFormat: "m/d/Y",
        //     dateFormat: "Y-m-d",
        //     maxDate: "today",
        //     onChange: function(selectedDates, dateStr, instance) {
        //         var age = calculateAge(dateStr);
        //         if (age < 18) {
        //             $('.check-box-primary-account:first').prop('disabled', true);
        //             if ($('.check-box-primary-account:first').is(':checked')) {
        //                 $('.check-box-primary-account:first').prop('checked', false);
        //             }
        //         } else {
        //             $('.check-box-primary-account:first').prop('disabled', false);
        //         }
        //     }
        // });

        $(document).on('focus', '#birthdate', function(e) {
            $(this).flatpickr({
                altInput: true,
                altFormat: "m/d/Y",
                dateFormat: "Y-m-d",
                maxDate: "today",
                onChange: function(selectedDates, dateStr, instance) {
                    var age = calculateAge(dateStr);
                    if (age < 18) {
                        $('.primaryAcCheck').prop('disabled', true);
                        if ($('.primaryAcCheck:first').is(':checked')) {
                            $('.primaryAcCheck:first').prop('checked', false);
                        }
                    } else {
                        $('.primaryAcCheck').prop('disabled', false);
                    }
                }
            });
        });

        $(document).on('blur', '#email', function(e) {
            var inputVal = $(this).val();
            $.ajax({
                url: '/get_checkin_code',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    email: inputVal,
                    fname: $('#firstname').val(),
                    lname: $('#lastname').val(),
                },
                success: function(response) {
                    console.log('Response:', response); 
                    $('#check_in').val(response);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        });

        $(document).on('blur', '#check_in', function(e) {
            $('#check_in_error').html('');
            var inputVal = $(this).val();

            $.ajax({
                url: '/get_checkin_code',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    checkin_code: inputVal,
                    email: $('.myemail').val(),
                },
                success: function(response) {
                    console.log('Response:', response); 
                    if (response == 1) {
                        $('#check_in_error').html(
                            'Code already taken by another user. If you don\'t change this code system will automatically assign you a new check in code.'
                            );
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        });

        function getCode(id, type) {
            if (type == 'code') {
                $('#check_in_error_family' + id).html('');
                $.ajax({
                    url: '/get_checkin_code',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        checkin_code: $('.check_in_code' + id).val(),
                        email: $('.email' + id).val(),
                    },
                    success: function(response) {
                        console.log('Response:', response); 
                        if (response == 1) {
                            $('#check_in_error_family' + id).html(
                                'Code already taken by another user. If you don\'t change this code system will automatically assign you a new check in code.'
                                )
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                    }
                });
            } else {
                $.ajax({
                    url: '/get_checkin_code',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        email: $('.email' + id).val(),
                        fname: $('.fname' + id).val(),
                        lname: $('.lname' + id).val(),
                    },
                    success: function(response) {
                        $('.check_in_code'+id).val(response);
                        console.log('Response:', response);  
                        // document.getElementById("check_in_code"+ id).value = "22";

                        
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

        function deletediv(i) {
            var cnt = $('#familycnt').val();
            cnt--;
            $('#familycnt').val(cnt);
            $('#familydiv' + i).remove();
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
            $('#deletediv'+new_cnt).html('<div class="setting-icon"><i class="ri-more-fill"></i> <ul> <li><a onclick="deletediv('+new_cnt+')"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete</a></li></ul></div>');
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

        $(document).on('click', '[data-behavior~=termsModelOpen]', function(e) {
            e.preventDefault()
            $.ajax({
                url: $(this).data('url'),
                success: function(html) {
                    $('#termsModelContent').html(html)
                    $('#termsModal').modal('show')
                }
            })
        });

        function getType(type) {
            $('#buttonType').val(type);
            $('#clientRegistration').submit();
        }
        
        jQuery(function($) {
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
                    password: {
                        required: 'Please enter a password',
                        minlength: 'Password must be at least 8 characters long'
                    },
                    confirmpassword: {
                        required: 'Please confirm your password',
                        equalTo: 'Passwords do not match'
                    }
                },
                submitHandler: function(form) {
                    $("#termserror").html('');
                    $("#systemMessage").html('');
                    $('#signpath').val(canvas.toDataURL());

                    $('#loading-img').addClass('d-none');
                    if ($('#dob').val() == '') {
                        $("#systemMessage").html('Please Enter Your Birthdate.').addClass(
                            'font-red alert-class alert-danger');
                        return false;
                    }

                    if (!jQuery("#b_trm1").is(":checked")) {
                        $("#termserror").html('Plese Agree Terms of Service and Privacy Policy.')
                            .addClass('alert-class alert-danger');
                        return false;
                    }

                    var imageData = ctx.getImageData(0, 0, canvas.width, canvas.height).data;
                    var isSignatureEmpty = imageData.every(value => value === 0);
                    if (isSignatureEmpty) {
                        $("#systemMessage").html('Please provide a signature.').addClass(
                            'font-red alert-class alert-danger');
                        return false;
                    }
                    var companyInfo = @json($companyinfo->id);    
                    var formData = $("#clientRegistration").serialize();
                    formData += '&company_info=' + encodeURIComponent(companyInfo);
                    
                    $.ajax({
                        url: '/sub_registration',
                        type: 'POST',
                        dataType: 'json',
                        data: formData,
                        beforeSend: function() {
                            $("#termserror").html('');
                            $('.register_submit').prop('disabled', true).css('background',
                                '#999999');
                            $('#systemMessage').addClass('font-red');

                            $('#loading-img').removeClass('d-none');
                            //$("#systemMessage").html('Please wait while we register you with Fitnessity.').addClass('alert-class alert-danger');
                        },
                        complete: function() {
                            $('.register_submit').prop('disabled', false).css('background',
                                '#ed1b24');
                        },
                        // success: function(response) {
                        //     if (response.type === 'success') {
                        //         if ($('#buttonType').val() == 'skip') {
                        //             $('.register').css('display','none');
                        //             if(response.redirect=='/sub_customer_dashboard'){
                        //                 setTimeout(function() {
                        //                     window.location.href = '/sub_customer_dashboard';
                        //                 }, 2000);   
                        //             } 
                                 
                        //         else{
                        //             $("#systemMessage").html(response.msg)
                        //             .removeClass('alert-success')
                        //             .addClass('alert-class alert-danger')
                        //             .show();
                                    
                        //         }
                        //         // else {
                        //         //     setTimeout(function() {
                        //         //         var currentURL = window.location.href;
                        //         //         window.location.href = currentURL +
                        //         //             "?step=2&customer_id=" + response.id;
                        //         //     }, 2000);
                        //         // }
                        //     } else {
                        //         $('#loading-img').addClass('d-none');
                        //         $("#systemMessage").html(response.msg).addClass(
                        //             'alert-class alert-danger');
                        //         $('.register_submit').prop('disabled', false).css(
                        //             'background', '#ed1b24');
                        //     }
                        // }
                        success: function(response) {
                            if (response.type === 'success') {
                                if ($('#buttonType').val() == 'skip') {
                                    $('.register').css('display','none');
                                        setTimeout(function() {
                                            window.location.href = '/sub_customer_dashboard';
                                        }, 2000);   
                                    
                                } else {
                                    $("#systemMessage").html(response.msg)
                                        .removeClass('alert-success')
                                        .addClass('alert-class alert-danger')
                                        .show();
                                }
                            } else {
                                $('#loading-img').addClass('d-none');
                                $("#systemMessage").html(response.msg).addClass('alert-class alert-danger');
                                $('.register_submit').prop('disabled', false).css('background', '#ed1b24');
                            }
                        }
                   });
                }
            });
        });
    </script>
      <script>
        // function dashboard(token)
        // {
        //     var container = $('#your-register-widget-container'); 
        //     $('#your-register-widget-container').css('height','100vh');
        //     $('#your-register-widget-container').css('overflow','hidden');
        //     var uniqueCode = container.attr('data-unique-code'); 
        //     var iframe = document.createElement('iframe');
        //     iframe.src = 'https://dev.fitnessity.co/api/customer_dashboard?token=' + token;
        //     iframe.style.border = 'none';
        //     iframe.style.width = '100%';
        //     iframe.style.height = '100%';
        //     var container = document.getElementById('your-register-widget-container');
        //     container.appendChild(iframe);
        //     window.addEventListener('message', function(event) {
        //         if (event.origin !== 'http://dev.fitnessity.co') return;        
        //         if (event.data === 'login_success') {
        //             console.log('User logged in successfully');
        //         }
        //     }, false);
        // }


        function dashboard(token,code)
        { 
            // alert('11');
            var customer = localStorage.getItem('customer');
            const url = `https://dev.fitnessity.co/api/customer_dashboard?token=${encodeURIComponent(token)}&code=${encodeURIComponent(code)}&customer_id=${encodeURIComponent(customer)}`;
                window.parent.postMessage({ type: 'changeSrc', src: url }, '*');
        }


    </script>
  <script>
    $(document).on('focus', '[data-behavior~=text-phone]', function(e){
        $('[data-behavior~=text-phone]').usPhoneFormat({
            format: '(xxx) xxx-xxxx',
        });
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
