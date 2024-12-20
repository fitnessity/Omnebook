@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

    @include('layouts.business.business_topbar')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="h-100">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <div class="page-heading">
                                        <label>Add A New Client Manually -Or- Onboard A New Client Fast</label>
                                    </div>
                                </div>
                            </div>

                            @if($success == 1)
                            <div class="row mb-3">
                                <div class="page-heading">
                                    <span class="font-green fs-16">Customer Successfully Registered.</span>
                                </div>
                            </div>
                            @endif
                            <div class="row">
                                <div class="col-xxl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <!-- Nav tabs -->
                                            <ul class="nav nav-tabs mb-3" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-bs-toggle="tab" href="#add" role="tab" aria-selected="false"> Manually Add Client </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" href="#search" role="tab" aria-selected="false">Search OmneBook</a>
                                                </li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content  text-muted">
                                                <div class="tab-pane active" id="add" role="tabpanel">
                                                    @if(!$request->step)
                                                        <form id="clientRegistration" method="post">
                                                            @csrf            
                                                            <div class="create-customer-box">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-lg-12"><h4 class="font-red ">Personal Info</h4></div>
                                                                    <h6>Adult, Parent/Guardian 18+</h6>
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
                                                                        <input type="text" class="form-control add-client-birthdate" id="dob" name="dob">
                                                                    </div>

                                                                    <div class="col-md-4 col-lg-3">
                                                                        <label class="mt-10">Phone <span id="star">*</span></label>
                                                                        <input type="text" name="contact" id="contact" size="30" maxlength="14" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" data-behavior="text-phone" class="form-control">
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
                                                                            <label for="primaryAccountHolder"> Primary Account <span class="" data-bs-toggle="tooltip" data-bs-placement="top" title="You are paying for yourself and all added family members.">(i)</span></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>                                                
                                                            
                                                            <!-- <div class="add-client-sapre-tor"></div> -->
                                                            <div class="create-customer-box">
                                                                <div class="row">
                                                                    <div class="col-md-12 col-lg-12"><h4 class="font-red ">Address</h4></div>
                                                                    <div class="col-md-4 col-lg-3 mt-10">
                                                                        <label>Address </label>
                                                                        <input type="text" class="form-control pac-target-input" autocomplete="off" name="address" id="addressCustomer" value=""  oninput="initMapCall('addressCustomer', 'cityCustomer', 'stateCustomer', 'countryCustomer', 'zipcodeCustomer', 'latitudeCustomer', 'longitudeCustomer')"> 
                                                                    </div>
                                                                    <div id="map" style="display: none;"></div>
                                                                    <div class="col-md-4 col-lg-3 mt-10">
                                                                        <label for="City">City</label>
                                                                        <input type="text" class="form-control" name="city" id="cityCustomer" size="30" maxlength="50" value="" >
                                                                    </div>
                                                                    <input type="hidden" name="lon" id="longitudeCustomer" value="">
                                                                    <input type="hidden" name="lat" id="latitudeCustomer" value="">

                                                                    <div class="col-md-4 col-lg-3 mt-10">
                                                                        <label for="state">State</label>
                                                                        <input type="text" class="form-control" name="state" id="stateCustomer" size="30" maxlength="50" value="" >
                                                                    </div>
                                                                    <div class="col-md-4 col-lg-3 mt-10">
                                                                        <label for="country">Country </label>
                                                                        <input type="text" class="form-control" name="country" id="countryCustomer" size="30" maxlength="50" value="" >
                                                                    </div> 

                                                                    <div class="col-md-4 col-lg-3 mt-10">
                                                                        <label for="zipcode">Zip Code </label>
                                                                        <input type="text" class="form-control" name="zipcode" id="zipcodeCustomer" size="30" maxlength="50" value="" >
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
                                                                        <div class="new-client mb-10" id="familydiv0" data-i="0" data-text="1" >
                                                                            <div class="accordion" id="default-accordion-example">
                                                                                <div class="accordion-item shadow">
                                                                                    <h2 class="accordion-header" id="heading0">
                                                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse0" aria-expanded="true" aria-controls="collapse0">
                                                                                            <div class="container-fluid nopadding">
                                                                                                <div class="row"> 
                                                                                                    <div class="col-lg-6 col-md-6 col-8"> Family Member #1 </div> 
                                                                                                    <div class="col-lg-6 col-md-6 col-4"> 
                                                                                                        <div class="multiple-options"  id="deletediv0"> 
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
                                                                                                    <input type="text" name="fname[]" id="fname" class="form-control required" >
                                                                                                    <span class="error" id="err_fname"></span>
                                                                                                </div>
                                                                                                <div class="col-md-4 col-lg-3">
                                                                                                    <label class="mt-10">Last Name</label>
                                                                                                    <input type="text" name="lname[]" id="lname" class="form-control required" >
                                                                                                    <span class="error" id="err_lname"></span>
                                                                                                </div>
                                                                                                <div class="col-md-4 col-lg-3">
                                                                                                    <label class="mt-10">Birthday</label>
                                                                                                    <input type="text" class="form-control" name="birthdate[]" id="birthdate" >
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
                                                                                                    <input type="email" name="emailid[]" id="emailid" class="form-control email" required>
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

                                                                    <label class="mt-10">To continue, please read the terms & waivers above. A signature is required to participate. </label>
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
                                                            

                                                            <div class="row">
                                                                <div class="col-md-12 col-lg-12 text-center">
                                                                    <div class="wrap-sp">
                                                                        <input type="checkbox" name="b_trm1" id="b_trm1" class="form-check-input" value="1">
                                                                        <label for="b_trm1" class="text-center">I agree to OmneBook Terms of Service and Privacy Policy</label>
                                                                    </div>
                                                                    <div id="termserror" class="font-red fs-15 text-center mb-10"></div>
                                                                    <div id="systemMessage" class="mb-10 fs-15 mb-10"></div>
                                                                </div>
                                                                <div class="col-md-12 col-lg-12 text-center">
                                                                    <button type="button" class="btn btn-red register_submit" id="register_submit" onclick="getType('submit');">Add Credit Card</button>
                                                                    <button type="button" class="btn btn-red register_submit" id="register_skip" data-type="skip" onclick="getType('skip');">Skip</button>
                                                                </div>
                                                            </div>

                                                            <input type="hidden" name="buttonType" id="buttonType" value="">
                                                        </form>
                                                    @else
                                                        <input type="hidden" id="client_secret" value="{{@$clientSecret}}">
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
                                                            <form id="payment-form1" data-secret="{{@$clientSecret}}">
                                                                <div>
                                                                    <div id="payment-element1"></div>

                                                                    <div id="error-message1" class="alert alert-danger mt-10" role="alert" style="display: none;"></div>
                                                                </div>
                                                                <div class="text-center mt-25">
                                                                    <button class="btn btn-red mr-5" type="submit" id="submitStripe">Add on file</button>
                                                                    <button type="button" class="btn btn-red" id="skip_next">Skip</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="tab-pane" id="search" role="tabpanel">
                                                    <div class="text-center font-black">
                                                        <h3 >Onboard A New Client Fast</h3>
                                                        <h4>Search for your clients on OmneBook</h4>
                                                        <p>“Your client could already have an account on OmneBook.<br>If so, get access and sync their information fast.”</p>
                                                    </div>
                                                    <div class="row check-txt-center claimyour-business">
                                                        <div class="col-md-10 col-xs-10 col-8 frm-claim">
                                                            <input id="clients_name" style="margin-top:10px;" type="text" class="form-control" placeholder="Search by typing your clients name" autocomplete="off" data-customer-id="">
                                                            
                                                            <div class="request-access" style="display:none">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end card-body -->
                                    </div><!-- end card -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="termsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="termsModelContent"></div>
    </div>
</div>
@include('layouts.business.footer')
@include('layouts.business.scripts')
@if(request()->customer_id)
    <script type="text/javascript">
        var customer_id = '{{request()->customer_id}}';
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
            var return_url = '/business/'+'{{$business_id}}'+'/customers/'+customer_id;
            form.addEventListener('submit', async (event) => {
                event.preventDefault();
                $('#submitStripe').text('loading...')

                const {error: error} = await stripe1.confirmSetup({
                    elements: elements1,
                    confirmParams: {
                        return_url: '{{ route('business.customers.refresh_payment_methods',['business_id' => $business_id ])}}?customer_id=' + cus_id,
                    }
                });

                if (error) {
                  const messageContainer1 = document.querySelector('#error-message1');
                  messageContainer1.textContent = error.message;
                  $('#error-message1').show();

                } else {
                    
                }
                $('#submitStripe').text('Add on file')
            });

        $(document).on('click', '#skip_next', function () {
            window.location.href = '/business/{{$business_id}}/create-customer';
        });
    </script>
@else
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

        jQuery(function ($) {
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
                    password:  {
                        required: 'Please enter a password',
                        minlength: 'Password must be at least 8 characters long'
                    },
                    confirmpassword: {
                        required: 'Please confirm your password',
                        equalTo: 'Passwords do not match'
                    }
                },
                submitHandler: function (form) {
                    $("#termserror").html('');
                    $("#systemMessage").html('');
                    $('#signpath').val(canvas.toDataURL());

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
                        $('.register_submit').prop('disabled', true).css('background','#999999');
                        $('#systemMessage').addClass('font-red');
                        $("#systemMessage").html('Please wait while we register you with Fitnessity.').addClass('alert-class alert-danger');
                    },
                    complete: function () {
                        $('.register_submit').prop('disabled', false).css('background','#ed1b24');
                    },
                    success: function (response) {
                       
                        if (response.type === 'success') {
                            if($('#buttonType').val() == 'skip'){
                                window.location.href = '/business/{{$business_id}}/create-customer';
                            }else{
                                setTimeout(function() {
                                    var currentURL = window.location.href;
                                    window.location.href = currentURL +"?step=2&customer_id="+response.id;
                                }, 2000);
                            }
                        } else {
                             $("#systemMessage").html(response.msg).addClass('alert-class alert-danger');
                            $('.register_submit').prop('disabled', false).css('background','#ed1b24');
                        }
                    }
                });
                }
            });
        });
    </script>

    <script>
        flatpickr('.add-client-birthdate',{
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

        $(document).on('focus', '#birthdate', function(e){
            //jQuery.noConflict();
            $(this).flatpickr( { 
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
            re = re.replaceAll("deletediv"+old_cnt,"deletediv"+new_cnt);
            re = re.replaceAll("Family Member #"+dataTxt,"Family Member #"+txtcount);
            re = re.replaceAll("primaryAcCheck"+old_cnt,"primaryAcCheck"+new_cnt);
            var $data = $(re);
            $data.find('.check-box-info').remove();
            var modifiedData = $data[0].outerHTML;
            $('#familymaindiv').append(modifiedData);
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

        function getType(type){
            $('#buttonType').val(type);
            $('#clientRegistration').submit();
        }
    </script>
@endif

<script type="text/javascript">
    
    // $(document).ready(function () {
    //     var url = "{{ url('/searchuser') }}";
    //     $( "#clients_name").autocomplete({
    //         source: url,
    //         focus: function( event, ui ) {
    //              return false;
    //         },
    //         select: function( event, ui ) {
    //             $("#clients_name").val( ui.item.firstname + ' ' +  ui.item.lastname);
    //             $('#clients_name').data('customer-id', ui.item.id);
    //             $('.request-access').css('display','block');
    //             $('.request-access').html('<p>To import the name, contact information, family members and credit card information for '+ ui.item.firstname + ' ' +  ui.item.lastname +', they must authorize you access.</p><label>Steps </label><div class="request-step"><p>1. Click the Request Access button below. </p><p>2. OmneBook will send an email to the customer to authorize you access.</p><p>3. Once authorization has been granted, the sync button will turn green, and you can sync the information immediately.</p><button type="button" style="margin-bottom: 10px;" class="signup-new request_access_btn" id="request_access_btn">Request Access</button></div><div class="error text-center errclass"></div>');
    //              return false;
    //         },
    //     }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
    //          let profile_img = '<div class="collapse-img"><div class="company-list-text" style="height: 50px;width: 50px;"><p style="padding: 0;">' + item.firstname.charAt(0).toUpperCase() + '</p></div></div> ';

    //         if(item.profile_pic_url){
    //             profile_img = '<img class="searchbox-img" src="' + (item.profile_pic ? item.profile_pic : '') + '" style="">';            
    //         }

    //         var inner_html = '<div class="row rowclass-controller"></div><div class="row"><div class="col-md-3 nopadding text-center">' + profile_img + '</div><div class="col-md-9 div-controller">' + 
    //                   '<p class="pstyle"><label class="liaddress">' + item.firstname + ' ' +  item.lastname  + (item.age ? ' (' + item.age+ '  Years Old)' : '') + '</label></p>' +
    //                   '<p class="pstyle liaddress">' + item.email +'</p>' + 
    //                   '<p class="pstyle liaddress">' + item.phone_number + '</p></div></div>';
           
    //         return $( "<li></li>" )
    //                 .data( "item.autocomplete", item )
    //                 .append(inner_html)
    //                 .appendTo( ul );
    //     };
    // });
    $(document).ready(function () {
        var url = "{{ url('/searchuser') }}";
        $("#clients_name").autocomplete({
            source: url,
            focus: function (event, ui) {
                return false;
            },
            select: function (event, ui) {
                $("#clients_name").val(ui.item.firstname + ' ' + ui.item.lastname);
                $('#clients_name').data('customer-id', ui.item.id);
                $('.request-access').css('display', 'block');
                $('.request-access').html('<p>To import the name, contact information, family members and credit card information for ' +
                    ui.item.firstname + ' ' + ui.item.lastname + ', they must authorize you access.</p><label>Steps </label><div class="request-step"><p>1. Click the Request Access button below. </p><p>2. OmneBook will send an email to the customer to authorize you access.</p><p>3. Once authorization has been granted, the sync button will turn green, and you can sync the information immediately.</p><button type="button" style="margin-bottom: 10px;" class="signup-new request_access_btn" id="request_access_btn">Request Access</button></div><div class="error text-center errclass"></div>');
                return false;
            },
        }).data("ui-autocomplete")._renderItem = function (ul, item) {
            // console.log(item.profile_pic);
            let profile_img = '<div class="collapse-img"><div class="company-list-text" style="height: 50px;width: 50px;"><p style="padding: 0;">' + item.firstname.charAt(0).toUpperCase() + '</p></div></div>';
            if (item.profile_pic_url) {
                profile_img = '<img class="searchbox-img" src="' + (item.profile_pic_url ? item.profile_pic_url : '') + '" style="">';
            }

            let email = item.email ? '<p class="pstyle liaddress">' + item.email + '</p>' : '';
            let phone_number = item.phone_number ? '<p class="pstyle liaddress">' + item.phone_number + '</p>' : '';

            var inner_html = '<div class="row rowclass-controller"></div><div class="row"><div class="col-lg-2 col-md-3 nopadding text-center">' + profile_img + '</div><div class="col-lg-10 col-md-9 div-controller nopadding ">' +
                '<p class="pstyle"><label class="liaddress">' + item.firstname + ' ' + item.lastname + (item.age ? ' (' + item.age + ' Years Old)' : '') + '</label></p>' +
                email +
                phone_number +
                '</div></div>';

            return $("<li></li>")
                .data("item.autocomplete", item)
                .append(inner_html)
                .appendTo(ul);
        };
    });


    $(document).on("click",'.request_access_btn',function(e){
        $.ajax({
            url: "{{route('sendgrantaccessmail')}}",
            method: "POST",
            data: { 
                _token: '{{csrf_token()}}', 
                id:$('#clients_name').data('customer-id'),
                business_id:'{{$business_id}}'
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


@endsection