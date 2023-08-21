@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')
@section('content')
<style>
    .register_wrap form{padding: 0 50px;}
    .sign-step_2 .reg-title-step2 input{max-width: 340px;}
    .sign-step_3 h2{letter-spacing: 6px}
    .sign-step_4 .form-group{padding:10px; width:355px;}
    .sign-step_5 .form-group{width:355px;}
    .Zebra_DatePicker_Icon_Wrapper{
        padding: 0 !important;
    }

</style>
<section class="register ptb-65" style="background-image: url({{ asset('public/images/register-bg.jpg')}})">
    <div class="container">
        <div class="col-lg-6 col-md-6 col-sm-7 col-xs-12">
            <div class="register_wrap" id="signup_normal">
                <input type="hidden" id="showstep" value="{{$show_step}}">
                <!--{{$show_step}}-->
                @if($show_step == 1)
                <div class="logo-my">
                    <a href="javascript:void(0)"> <img src="{{ asset('public/images/logo-small.jpg')}}"> </a>
                </div>
                <form id="frmregister" method="post">
                    <div class="pop-title ftitle1">
                        <h3>Welcome to fitnessity</h3>
                    </div>
                    <div id='systemMessage'></div>
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="customerId" value="{{$customerId}}">
                    <input type="text" name="firstname" id="firstname" size="30" maxlength="80" placeholder="First Name">
                    <input type="text" name="lastname" id="lastname" size="30" maxlength="80" placeholder="Last Name">
                    <input type="text" name="username" id="username" size="30" maxlength="80" placeholder="Username" autocomplete="off">
                    <input type="email" name="email" id="email" class="myemail" size="30" placeholder="e-MAIL" maxlength="80" autocomplete="off">
                    <input type="text" name="contact" id="contact" size="30" maxlength="14" autocomplete="off" placeholder="Phone" data-behavior="text-phone">
                    <input type="text" id="dob" name="dob" class=" flatpicker_birthdate1" placeholder="Date Of Birth (mm/dd/yyyy)">
					<div class="position-relative auth-pass-inputgroup">	
						<input type="password" name="password" id="password" size="30" placeholder="Password" autocomplete="off">
                        <button class="btn-link position-absolute password-addon toggle-password" type="button" data-tp = "password">
                            <i class="fas fa-eye"></i>
						</button>
					</div>
					<div class="position-relative auth-pass-inputgroup">
						<input class="password-input" type="password" name="confirm_password" id="confirm_password" size="30" placeholder="Confirm Password" autocomplete="off">
						<button class="btn-link position-absolute password-addon toggle-password" type="button" data-tp = "confirm_password">
                            <i class="fas fa-eye"></i>
                        </button>
					</div>
                    <div class="terms-wrap">
                        <input type="checkbox" name="b_trm1" id="b_trm1" class="form-check-input" value="1">
                        <label for="b_trm1">I agree to Fitnessity <a href="/terms-condition" target="_blank">Terms of Service</a> and <a href="/privacy-policy" target="_blank">Privacy Policy</a></label>
                    </div>
                    <div id='termserror'></div><br>
                    <button type="button" style="margin:0px;" class="signup-new" id="register_submit" onclick="$('#frmregister').submit();">Create Account</button>
                    <br><br>
                    <!-- <p class="or-data">OR</p>
                    <div class="social-login">
                        <a href="{{ Config::get('constants.SITE_URL') }}/login/facebook" class="fb-login">
                            <i class="fa fa-facebook" aria-hidden="true"></i> Login with Facebook
                        </a>
                      <a href="{{ Config::get('constants.SITE_URL') }}/login/google" class="plus-login">
                            <i class="fa fa-google-plus" aria-hidden="true"></i> Sign with Google+
                        </a> 
                    </div> -->
                    <p class="already">Already have an account? <a href="{{ Config::get('constants.SITE_URL') }}/userlogin">Login</a></p>

                   
                </form>
                @elseif(Auth::check() && Auth::user()->show_step == 2)
                <form action="#">
                    <div class="sign-step_2">
                        <div class="filledstep-bar">
                            <div class="row">
                                <div class="col-sm-12">
                                    <span class="filledstep"></span>
                                    <span class=""></span>
                                    <span class=""></span>
                                    <span class=""></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class='error' id='systemMessage'></div>
                                <div class="prfle-wrap">
                                    <img src="" alt="">
                                    {{substr(Auth::user()->firstname,0,1)}}
                                </div>
                                <div class="reg-email-step2">{{Auth::user()->email}}</div>
                                <h2>Welcome to Fitnessity</h2>
                                <div class="reg-title-step2"><input type="text" name="" id="" value="@<?=Auth::user()->username?>" readonly=""></div>
                                <p>Your answer to the next few question will help us find the right ideas for you</p>
                                <div class="signup-step-btn">
                                    <button type="button" class="signbutton-next step2_next" id="step2_next">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @elseif(Auth::check() && Auth::user()->show_step == 3)
                <form action="#">
                    <div class="sign-step_3">
                        <div class="filledstep-bar">
                            <div class="row">
                                <div class="col-sm-12">
                                    <span class="filledstep"></span>
                                    <span class="filledstep"></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h2>How do you Identify?</h2>
                                <div class='error' id='systemMessage'></div>
                                <div class="form-group">
                                    <span class="error" id="err_gender"></span>
                                    <div class="radio">
                                        <label for="male">Male<input type="radio" name="gender" id="male" value="male" class="" /><span class="checkmark"></span></label>
                                    </div>
                                    <div class="radio">
                                        <label for="female">Female<input type="radio" name="gender" id="female" value="female" class="" /><span class="checkmark"></span></label>
                                    </div>
                                    <div class="radio">
                                        <label for="other">Specify another<input type="radio" name="gender" id="other" value="other" class="" /><span class="checkmark"></span></label>
                                        <input type="text" name="othergender" id="othergender">
                                    </div>
                                </div>
                                <div class="signup-step-btn">
                                    <button type="button" class="signbutton-next step3_next" id="step3_next">Next</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @elseif(Auth::check() && Auth::user()->show_step == 4)
                <form action="#">
                    <div class="sign-step_4">
                        <div class="filledstep-bar">
                            <div class="row">
                                <div class="col-sm-12">
                                    <span class="filledstep"></span>
                                    <span class="filledstep"></span>
                                    <span class="filledstep"></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="">
                                    <li><i class="fa fa-check"></i><span>Registration Information</span></li>
                                    <li><i class="fa fa-check"></i><span>Your Identification</span></li>
                                </ul>
                                <ul class="nav nav-tabs nav-stacked">
                                    <li class="active"><a data-toggle="tab" href="#add_personel_info"><span class="stp-numbr">3</span> <span>Add Personal Information</span></a></li>
                                    <li><a data-toggle="tab" href="#adding_photo"><span class="stp-numbr">4</span> <span>Adding Photo</span></a></li>
                                </ul>
                                
                                <div class="tab-content">
                                    <div id="add_personel_info" class="tab-pane fade in active">
                                        <div class='error' id='systemMessage'></div>
                                        <div class="form-group">
                                            <input type="text" name="address_sign" id="address_sign" placeholder="Address" class="form-control b_address" oninput="initialize1(this)">
                                            <span class="error" id="err_address_sign"></span>
                                        </div>
                                        <div id="map" style="display: none;"></div>
                                        <input type="hidden" name="lon" id="lon" value="">
                                        <input type="hidden" name="lat" id="lat" value="">
                                        <div class="form-group">
                                            <input type="text" name="country_sign" id="country_sign" placeholder="Country" class="form-control b_country">
                                            <span class="error" id="err_country_sign"></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="city_sign" id="city_sign" placeholder="City" class="form-control b_city">
                                            <span class="error" id="err_city_sign"></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="state_sign" id="state_sign" placeholder="State" class="form-control b_state">
                                            <span class="error" id="err_state_sign"></span>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="zipcode_sign" id="zipcode_sign" placeholder="Zipcode" class="form-control b_zipcode">
                                            <span class="error" id="err_zipcode_sign"></span>
                                        </div>
                                        <div class="signup-step-btn">
                                            <button type="button" class="signbutton-next step4_next" id="step4_next">Next</button>
                                        </div>
                                    </div>
                                    <div id="adding_photo" class="tab-pane fade">
                                        <div class="upload-wrp-content">
                                            <p><b>Put a face to the name </b>and improve your adds to networking success.</p>
                                            <p>People prefer to network with members who has a profile photo, but if don't have one ready to upload, you can add it later.</p>
                                        </div>
                                        <div class="">
                                            <div class="upload-img">
                                                <input type="file" name="file_upload" id="file" onchange="readURL(this);">
                                                <div class="upload-img-msg">
                                                    <p>Touble uploading profile photo?</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="signup-step-btn">
                                            <button type="button" class="signbutton-next" id="fileimgnext">Upload</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @elseif(Auth::check() && Auth::user()->show_step == 5)
                <form action="#" enctype="multipart/form-data" id="myformprofile">
                    <div class="sign-step_4">
                        <div class="filledstep-bar">
                            <div class="row">
                                <div class="col-sm-12">
                                    <span class="filledstep"></span>
                                    <span class="filledstep"></span>
                                    <span class="filledstep"></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <ul class="">
                                    <li><i class="fa fa-check"></i><span>Registration Information</span></li>
                                    <li><i class="fa fa-check"></i><span>Your Identification</span></li>
                                    <li><i class="fa fa-check"></i><span>Add Personal Information</span></li>
                                </ul>
                                <ul class="nav nav-tabs nav-stacked">
                                   
                                    <li><a data-toggle="tab" href="#adding_photo"><span class="stp-numbr">4</span> <span>Adding Photo</span></a></li>
                                </ul>
                                
                                <div class="tab-content">
                                   
                                    <div id="adding_photo" class="tab-pane fade in active">
                                        <div class="upload-wrp-content">
                                            <p><b>Put a face to the name </b>and improve your adds to networking success.</p>
                                            <p>People prefer to network with members who has a profile photo, but if don't have one ready to upload, you can add it later.</p>
                                        </div>
                                        <div class="">
                                            <div class="upload-img">
                                                <input type="file" name="file_upload_profile" id="file_upload_profile" onchange="readURL(this);">
                                                <div class="upload-img-msg">
                                                    <p>Touble uploading profile photo?</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="signup-step-btn">
                                            <button type="button" class="signbutton-next" id="fileimgnext">Upload</button>
                                        </div> -->
                                        <div class="signup-step-btn">
                                    <button type="button" class="signbutton-next step3_next" id="step44_next">Next</button>
                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @else
                <form action="#" id="familyform">
                    <div class="sign-step_5">
                        <div class="filledstep-bar">
                            <div class="row">
                                <div class="col-sm-12">
                                    <span class="filledstep"></span>
                                    <span class="filledstep"></span>
                                    <span class="filledstep"></span>
                                    <span class="filledstep"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h2>Activities are much more fun with family</h2>
                                <div class='error' id='systemMessage'></div>
                                <h4 style="text-align: center; margin-bottom: 10px;"><b>Add Your Family Members Information</b></h4>
                                <div class="error" id="familyerrormessage"></div>
                                <input type="hidden" name="familycnt" id="familycnt" value="0">
                                <div id="familymaindiv">
                                    <div class="new-client" id="familydiv0">
										<div class="content1">
											<div class="panel-group" id="accordion">
												<div class="panel panel-default">
													 <div class="panel-heading">
													   <h4 class="panel-title">
														 <a data-toggle="collapse" data-parent="#accordion" href="#collapse0">Family Member #1</a>
													   </h4>
													 </div>
													<div id="collapse0" class="panel-collapse collapse in">
														 <div class="panel-body">
															  <div class="form-group">
                                                            <input type="text" name="first_name[]" id="first_name" class="form-control first_name required" placeholder="First Name">
                                                            <span class="error" id="err_fname" ></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" name="last_name[]" id="last_name" class="form-control last_name required" placeholder="Last Name" >
                                                            <span class="error" id="err_lname"></span>
                                                        </div>
                                                        <div>
                                                            <div class="birthday_date-position">
                                                                <input type="text" name="birthday[]" id="birthday0" class="form-control birthdayFlatpicker required" placeholder="mm/dd/yyyy"/>
                                                                <span class="error" id="err_birthday_date"></span>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <select name="relationship[]" id="relationship required" class="form-control relationship">
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
                                                        <div class="form-group">
                                                            <input maxlength="14" type="text" name="mobile[]" id="mobile" class="form-control mobile_number" placeholder="Mobile Phone" onkeypress="return event.charCode >= 48 && event.charCode <= 57" data-behavior="text-phone">
                                                            <span class="error" id="err_mphone"></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <input maxlength="14" type="text" name="emergency_phone[]" id="emergency_phone" class="form-control emergency_phone " placeholder="Emergency Contact Number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" data-behavior="text-phone">
                                                            <span class="error" id="err_emergency_phone" ></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <select name="gender[]" id="gender" class="form-control gender" required>
                                                                <option value="">Select Gender</option>
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>
                                                                <option value="other">Specify other</option>
                                                            </select>
                                                            <span class="error" id="err_gender"></span>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="email" name="email[]" id="email" class="form-control email required" placeholder="Email">
                                                            <span class="error" id="err_emailid"></span>
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
                        <div class="signup-step-btn">
                            <button type="button" class="signbutton-next" id="add_family">Add New Family Member</button>
                            <button type="button" class="signbutton-next step5_next" id="step5_next">Save</button>
                            <button type="button" class="signbutton-next skip5_next" id="skip5_next">Skip</button>
                        </div>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>

</section>

@include('layouts.footer')


<script>

    flatpickr(".flatpicker_birthdate1", {
        dateFormat: "m/d/Y",
        maxDate: "01/01/2050",
        defaultDate: [new Date()],
    });

    document.getElementById("birthday0").addEventListener("focus", function(event) {
      
            flatpickr(event.target, {
                dateFormat: "m/d/Y",
                maxDate: "01/01/2050",
                defaultDate: new Date(),
            });
        
    }, true);


   
    $(document).on("click",'#add_family',function(e){
        var cnt = $('#familycnt').val();
        var old_cnt = cnt;
        cnt++;
        var txtcount = cnt;
        txtcount += 1;
        var data = '';
        data += '<div class="new-client" id="familydiv'+cnt+'">';
        data += $('#familydiv'+old_cnt).html();
        data += '</div>';
        var re = data.replaceAll("heading"+old_cnt,"heading"+cnt);
        re = re.replaceAll("collapse"+old_cnt,"collapse"+cnt);
        re = re.replaceAll("birthday_date"+old_cnt,"birthday_date"+cnt);
        re = re.replaceAll("Family Member #"+cnt,"Family Member #"+txtcount);
        $('#familymaindiv').append(re);
        $('#familycnt').val(cnt);
    });
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/css/default/zebra_datepicker.min.css" type="text/css">
<script src="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/zebra_datepicker.min.js"></script>
<style>.Zebra_DatePicker_Icon_Wrapper{width:100%!important}</style>

<script type="text/javascript">
    /* Show steps */
    $(document).on('click', '#step2_next', function () {
        var posturl = '/auth/updateStep?show_step=3';
        var formdata = new FormData();
        formdata.append('_token', '{{csrf_token()}}');
        formdata.append('show_step', 3);
        $.ajax({
            url: posturl,
            type: 'POST',
            dataType: 'json',
            data: formdata,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $("#_token").val()
            },
            beforeSend: function () {
                $('.step2_next').prop('disabled', true).css('background','#999999');
                $('#systemMessage').html('Please wait while we processed you with Fitnessity.');
            },
            complete: function () {
                $('.step2_next').prop('disabled', false).css('background','#ed1b24');
            },
            success: function (response) {
                window.location.href = "{{url('/registration/?showstep=1')}}"
            }
        });
    });

    /* Step 3 */
    $(document).on('click', '#step3_next', function () {
        
        $("#err_gender").html("");
        
        if ($('input[name="gender"]:checked').val() == '' || $('input[name="gender"]:checked').val() == 'undefined' || $('input[name="gender"]:checked').val() == undefined) {
            $("#err_gender").html('Please select your gender');
        } else {
            if ($('input[name="gender"]:checked').val() == 'other' && $('#othergender').val() == '') {
                $("#err_gender").html('Please enter other gender');
            } else {
                var posturl = '/auth/savegender';
                var formdata = new FormData();
                formdata.append('_token', '{{csrf_token()}}')
                var g = $('input[name="gender"]:checked').val() == 'other' ? $('#othergender').val() : $('input[name="gender"]:checked').val();
                formdata.append('gender', g);
                formdata.append('show_step', 4);
                $.ajax({
                    url: posturl,
                    type: 'POST',
                    dataType: 'json',
                    data: formdata,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $("#_token").val()
                    },                
                    beforeSend: function () {
                        $('.step3_next').prop('disabled', true).css('background','#999999');
                        $('#systemMessage').html('Please wait while we processed you with Fitnessity.');
                    },
                    complete: function () {
                        $('.step3_next').prop('disabled', false).css('background','#ed1b24');
                    },
                    success: function (response) {
                        window.location.href = "{{url('/registration/?showstep=1')}}"
                    }
                });
            }
        }
    });

    /* Step 4 */
    $(document).on('click', '#step4_next', function () {
        
        var address_sign = $('#address_sign').val();
        var country_sign = $('#country_sign').val();
        var city_sign = $('#city_sign').val();
        var state_sign = $('#state_sign').val();
        var zipcode_sign = $('#zipcode_sign').val();
        var lon = $('#lon').val();
        var lat = $('#lat').val();
        
        $('#err_address_sign').html('');
        $('#err_country_sign').html('');
        $('#err_city_sign').html('');
        $('#err_state_sign').html('');
        $('#err_zipcode_sign').html('');

        var posturl = '/auth/saveaddress';
        var formdata = new FormData();
        formdata.append('_token', '{{csrf_token()}}')
        formdata.append('address', address_sign)
        formdata.append('country', country_sign)
        formdata.append('city', city_sign)
        formdata.append('state', state_sign)
        formdata.append('zipcode', zipcode_sign)
        formdata.append('lon', lon)
        formdata.append('lat', lat)
        formdata.append('show_step', 5)
        $.ajax({
            url: posturl,
            type: 'POST',
            dataType: 'json',
            data: formdata,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $("#_token").val()
            },
            beforeSend: function () {
                $('.step4_next').prop('disabled', true).css('background','#999999');
                $('#systemMessage').html('Please wait while we processed you with Fitnessity.');
            },
            complete: function () {
                $('.step4_next').prop('disabled', false).css('background','#ed1b24');
            },
            success: function (response) {
                window.location.href = "{{url('/registration/?showstep=1')}}"
            }
        });
       
    });

    /* Step 4 new */
    $(document).on('click', '#step44_next', function () {
        var posturl = '/auth/savephoto';
        var getData = new FormData($("#myformprofile")[0]);
        getData.append('_token', '{{csrf_token()}}') 
        $.ajax({
            url: posturl,
            type: 'POST',
            dataType: 'json',
            data: getData,
            cache: true,
            processData: false,
            contentType: false,
            success: function (response) {
                window.location.href = "{{url('/registration/?showstep=1')}}"
            }
        });
       
    });

    /* Step 5 add photo */
    $(document).on('click', '#step5_next', function () {
        
        var address_sign = $('#address_sign').val();
        var country_sign = $('#country_sign').val();
        var city_sign = $('#city_sign').val();
        var state_sign = $('#state_sign').val();
        var zipcode_sign = $('#zipcode_sign').val();
        var lon = $('#lon').val();
        var lat = $('#lat').val();
        
        $('#err_address_sign').html('');
        $('#err_country_sign').html('');
        $('#err_city_sign').html('');
        $('#err_state_sign').html('');
        $('#err_zipcode_sign').html('');
        
        var posturl = '/auth/saveaddress';
        var formdata = new FormData();
        formdata.append('_token', '{{csrf_token()}}')
        formdata.append('address', address_sign)
        formdata.append('country', country_sign)
        formdata.append('city', city_sign)
        formdata.append('state', state_sign)
        formdata.append('zipcode', zipcode_sign)
        formdata.append('lon', lon)
        formdata.append('lat', lat)
        formdata.append('show_step', 6)
        $.ajax({
            url: posturl,
            type: 'POST',
            dataType: 'json',
            data: formdata,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $("#_token").val()
            },
            beforeSend: function () {
                $('.step4_next').prop('disabled', true).css('background','#999999');
                $('#systemMessage').html('Please wait while we processed you with Fitnessity.');
            },
            complete: function () {
                $('.step4_next').prop('disabled', false).css('background','#ed1b24');
            },
            success: function (response) {
                //window.location.href = "{{url('/registration/?showstep=1')}}"
                window.location.href = response.redirecturl;
            }
        });
       
    });

    /* Step 5 */
    $(document).on('click', '#skip5_next', function () {
        var posturl = '/skip-family-form1';
        var formdata = new FormData();
        formdata.append('_token', '{{csrf_token()}}')
        formdata.append('first_name', 'check')
        formdata.append('show_step', 6)
        setTimeout(function () {
            $.ajax({
                url: posturl,
                type: 'POST',
                dataType: 'json',
                data: formdata,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $("#_token").val()
                },
                beforeSend: function () {
                    $('#skip5_next').prop('disabled', true).css('background','#999999');
                    $("#systemMessage").html('Please wait while we skipping the data.');
                },
                complete: function () {
                    $('#skip5_next').prop('disabled', true).css('background','#999999');
                },
                success: function (response) {
                    $("#systemMessage").html(response.msg);
                    //showSystemMessages('#systemMessage', response.type, response.msg);
                    if (response.type === 'success') {
                        window.location.href = response.redirecturl;
                    } else {
                        $('#skip5_next').prop('disabled', false).css('background','#ed1b24');
                    }
                }
            });
        }, 1000)
    });

    $(document).on('click', '#step5_next', function () {

        $(".required").each(function() {
            $(this).removeClass("redClass");
        });
        var counter = 0;
        $(".required").each(function() {
            if ($(this).val() === "") {
                $(this).addClass("redClass");
                counter++;
            }
        });
        if(counter > 0){
            $('#systemMessage').html("");

            $('#familyerrormessage').html("Looks like some of the fields aren't filled out correctly. They're highlighted in red.");
            return false;
        }else{
            var posturl = '/submit-family-form1';
            var form = $('#familyform')[0];
            var formdata = new FormData(form);
            formdata.append('_token', '{{csrf_token()}}')
            formdata.append('show_step', 6)

            setTimeout(function () {
            $.ajax({
                url: posturl,
                type: 'POST',
                dataType: 'json',
                data: formdata,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $("#_token").val()
                },
                beforeSend: function () {
                    $('#step5_next').prop('disabled', true).css('background','#999999');
                    //showSystemMessages('#systemMessage', 'info', 'Please wait while we submitting the data');
                    $("#systemMessage").html('Please wait while we submitting the data.')
                },
                complete: function () {
                    $('#step5_next').prop('disabled', true).css('background','#999999');
                },
                success: function (response) {
                    $("#systemMessage").html(response.msg);
                    //showSystemMessages('#systemMessage', response.type, response.msg);
                    if (response.type === 'success') {
                        window.location.href = response.redirecturl;
                    } else {
                        $('#step5_next').prop('disabled', false).css('background','#ed1b24');
                    }
                }
            });
        }, 1000)
        }
    });


    $(document).ready(function () {

        $('.toggle-password').on('click', function() {
            var passwordField = $('#password');
            if($(this).data('tp') == 'confirm_password'){
                passwordField = $('#confirm_password');
            }

            var toggleButton = $(this);
            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                toggleButton.html('<i class="fas fa-eye-slash"></i>');
            } else {
                passwordField.attr('type', 'password');
                toggleButton.html('<i class="fas fa-eye"></i>');
            }
        });

        $(".birthday").keyup(function(){
            if ($(this).val().length == 2){
                $(this).val($(this).val() + "/");
            }else if ($(this).val().length == 5){
                $(this).val($(this).val() + "/");
            }
        });
    });

    $('#email').on('blur', function() {
        var posturl = 'emailvalidation';
        var formData = $("#frmregister").serialize();
        $.ajax({
                url: posturl,
                type: 'get',
                dataType: 'json',
                data: formData,  
                 beforeSend: function () {
                    $("#systemMessage").html('');
                },             
                success: function (response) {                    
                    $("#systemMessage").html(response.msg).addClass('alert-class alert-danger');  
                }
            });
    });

    function getAge() {
        var dateString = document.getElementById("dob").value;
        var today = new Date();
        var birthDate = new Date(dateString);
        var age = today.getFullYear() - birthDate.getFullYear();
        if(age < 13)
        {
            var agechk = '0';
        } else {
           var agechk = '1';
        }
        return agechk;
    }

</script>
<script type="text/javascript">
    
    jQuery(function ($) {
        $('#frmregister').validate({
            rules: {
                firstname: "required",
                lastname: "required",
                username: "required",
                email: {
                    required: true,
                    email: true
                },
                dob: {
                    required: true,
                },
                password: {
                    required: true,
                    minlength: 8
                },
                confirm_password: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password"
                },
               /* b_trm1: {
                    required: true,
                },*/
            },
            messages: {
                firstname: "Enter your Firstname",
                lastname: "Enter your Lastname",
                username: "Enter your Username",
                email: {
                    required: "Please enter a valid email address",
                    minlength: "Please enter a valid email address",
                    remote: jQuery.validator.format("{0} is already in use")
                },
                dob: {
                    required: "Please provide your date of birth",
                },
                password: {
                    required: "Provide a password",
                    minlength: jQuery.validator.format("Enter at least {0} characters")
                },
                confirm_password: {
                    required: "Repeat your password",
                    minlength: jQuery.validator.format("Enter at least {0} characters"),
                    equalTo: "Enter the same password as above"
                },
                /*b_trm1: {
                    required: "Plese select Terms of Service and Privacy Policy",
                },*/
            },
            submitHandler: function (form) {
                if (!jQuery("#b_trm1").is(":checked")) {
                    $("#termserror").html('Plese Agree Terms of Service and Privacy Policy.').addClass('alert-class alert-danger');
                    return false;
                }
                var valchk = getAge();
                if(valchk == 1){
                    $('#register_submit').prop('disabled', true);
                    var formData = $("#frmregister").serialize();
                    var posturl = '/auth/registration';

                    $.ajax({
                        url: posturl,
                        type: 'POST',
                        dataType: 'json',
                        data: formData,
                        beforeSend: function () {
                            
                            $('#register_submit').prop('disabled', true).css('background','#999999');
                            showSystemMessages('#systemMessage', 'info', 'Please wait while we register you with Fitnessity.');
                            $("#systemMessage").html('Please wait while we register you with Fitnessity.').addClass('alert-class alert-danger');
                        },
                        complete: function () {
                        
                            $('#register_submit').prop('disabled', false).css('background','#ed1b24');
                        },
                        success: function (response) {
                            //alert(response.msg);
                            
                            $("#systemMessage").html(response.msg).addClass('alert-class alert-danger');
                            showSystemMessages('#systemMessage', response.type, response.msg);
                            if (response.type === 'success') {
                                window.location.href = response.redirecturl;
                            } else {
                                $('#register_submit').prop('disabled', false).css('background','#ed1b24');
                            }
                        }
                    });  
                }else{
                    $("#systemMessage").html('You must be at least 13 years old.').addClass('alert-class alert-danger');
                }
            }
        });
    });
</script>

<script type="text/javascript">
        function initMap() {
            if(document.getElementById('map') != '' && document.getElementById('map') != null){
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: -33.8688, lng: 151.2195},
                    zoom: 13
                });
                var input = document.getElementById('address_sign');
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
                        if(place.address_components[i].types[0] == 'postal_code'){
                          $('#zipcode_sign').val(place.address_components[i].long_name);
                        }
                   
                        if(place.address_components[i].types[0] == 'locality'){
                            $('#city_sign').val(place.address_components[i].long_name);
                        }

                        if(place.address_components[i].types[0] == 'sublocality_level_1'){
                            sublocality_level_1 = place.address_components[i].long_name;
                        }

                        if(place.address_components[i].types[0] == 'country'){
                            $('#country_sign').val(place.address_components[i].long_name);
                        }

                        if(place.address_components[i].types[0] == 'administrative_area_level_1'){
                             $('#state_sign').val(place.address_components[i].long_name);
                        }

                        if(place.address_components[i].types[0] == 'street_number'){
                           badd = place.address_components[i].long_name ;
                        }

                        if(place.address_components[i].types[0] == 'route'){
                           badd += ' '+place.address_components[i].long_name ;
                        } 
                    }
                    if(badd == ''){
                      $('#address_sign').val(sublocality_level_1);
                    }else{
                      $('#address_sign').val(badd);
                    }
                    $('#lat').val(place.geometry.location.lat());
                    $('#lon').val(place.geometry.location.lng());
                    
                });
            }
        }
</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap" async defer></script>


</body>
</html>
@endsection
