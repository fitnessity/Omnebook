@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">

        @include('business.leftNavigation')

        <div class="col-md-10">

            <form id="companyDetail" name="companyDetail" method="post" action="{{route('addbusinesscompanydetail')}}">

                @csrf
                <input type="hidden" name="userid" id="userid" value="{{Auth::user()->id}}">
                <div class="container-fluid p-0" id="detail-form">
                    <div class="tab-hed">Company Details Setup</div>
                    <hr style="border: 15px solid black;width: 104%;margin-left: -38px;">
                    <section class="row">
                        <div class="col-md-12">
                            <div class="row" style="padding-right: 200px;">
                                <div class="form-group col-md-6">
                                    <label for="email">Company Name <span id="star">*</span></label>
                                    <input type="text" class="form-control" name="Companyname" id="b_companyname" size="30" maxlength="80" placeholder="Company Name" value="{{ isset($business_details['Companyname']) ? $business_details['Companyname'] : '' }}">
                                    <span class="error " id="b_cmpo"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pwd">Address <span id="star">*</span></label>
                                    <input type="text" class="form-control" autocomplete="nope" name="Address" id="b_address" oninput="initialize1(this)" placeholder="Address" value="{{ isset($business_details['Address']) ? $business_details['Address'] : '' }}">
                                    <span class="error " id="b_addr"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">City <span id="star">*</span></label>
                                    <input type="text" class="form-control" name="City" id="b_city" size="30" placeholder="City" maxlength="80" value="{{ isset($business_details['City']) ? $business_details['City'] : '' }}">
                                    <span class="error " id="b_ct"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pwd">State <span id="star">*</span></label>
                                    <input type="text" class="form-control" name="State" id="b_state" size="30" placeholder="State" maxlength="80" value="{{ isset($business_details['State']) ? $business_details['State'] : '' }}">
                                    <span class="error " id="b_sta"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Zip Code <span id="star">*</span></label>
                                    <input type="text" class="form-control" name="ZipCode" id="b_zipcode" size="30" placeholder="Zip Code" value="{{ isset($business_details['ZipCode']) ? $business_details['ZipCode'] : '' }}">
                                    <span class="error " id="b_zip"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pwd">Country <span id="star">*</span></label>
                                    <input type="text" class="form-control" name="Country" id="b_country" size="30" placeholder='Country' value="{{ isset($business_details['Country']) ? $business_details['Country'] : '' }}">
                                    <span class="error " id="b_cont"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">EIN Number </label>
                                    <input type="text" class="form-control" name="EINnumber" id="b_EINnumber" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="EIN Number" value="{{ isset($business_details['EINnumber']) ? $business_details['EINnumber'] : '' }}">
                                    <span class="error " id="b_ein"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pwd">Establishment Year <span id="star">*</span></label>
                                    <input class="form-control" type="number" name="Establishmentyear" id="b_Establishmentyear" size="30" maxlength="4" placeholder="Establishment Year" oninput="javascript: if (this.value.length > this.maxLength || this.value > new Date().getFullYear() ) this.value = this.value.slice(0, this.maxLength);" value="{{ isset($business_details['Establishmentyear']) ? $business_details['Establishmentyear'] : '' }}">
                                    <span class="error " id="b_estb"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pwd">Business Username <span id="star">*</span></label>
                                    <input type="text" class="form-control" name="Businessusername" id="b_business_user_tag" placeholder="Business User Tag" value="{{ isset($business_details['Businessusername']) ? $business_details['Businessusername'] : '' }}">
                                    <span class="error" id="b_usertag"></span>
                                </div>
                                <div class="form-group col-md-6">
                                </div>
                                <hr style="border: 1px solid #d4cfcf;width: 100%;">

                                <div class="form-group col-md-6">
                                    <label for="pwd" style="font-size: 20px;font-weight: bold;">Upload Profile Image</label>
                                    <input type="file" class="form-control" name="Profilepic" id="profile_pic" onchange="readURL(this);" style="height: 45px;" value="{{ isset($business_details['Profilepic']) ? $business_details['Profilepic'] : '' }}">
                                </div>
                                <div class="form-group col-md-6 text-center">
                                    @if(isset($business_details['Profilepic']))
                                    <img src="/public/uploads/profile_pic/thumb/{{ $business_details['Profilepic'] }}" class="pro_card_img blah" id="showimg">
                                    @else
                                    <img src="http://0.gravatar.com/avatar/?s=35&d=mm&r=g" class="pro_card_img blah" id="showimg">
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <input type="hidden" value="0" id="mybusinessid" />
                                    <label for="pwd">Company Representative First Name <span id="star">*</span></label>
                                    <input type="text" class="form-control" name="Firstnameb" id="b_firstname" size="30" maxlength="80" placeholder="Company Representative First Name" value="{{ isset($business_details['Firstnameb']) ? $business_details['Firstnameb'] : '' }}">
                                    <span class="error" id="b_firstnm"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pwd">Company Representative Last Name <span id="star">*</span></label>
                                    <input type="text" class="form-control" name="Lastnameb" id="b_lastname" size="30" maxlength="80" placeholder="Company Representative Last Name" value="{{ isset($business_details['Lastnameb']) ? $business_details['Lastnameb'] : '' }}">
                                    <span class="error" id="b_lastnm"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pwd">Email <span id="star">*</span></label>
                                    <input type="email" class="form-control myemail" name="Emailb" id="b_email" autocomplete="off" placeholder="Email Address" size="30" maxlength="80" value="{{ isset($business_details['Emailb']) ? $business_details['Emailb'] : Auth::user()->email }}">
                                    <span class="error" id="b_eml"></span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pwd">Contact Number <span id="star">*</span></label>
                                    <input type="number" class="form-control" name="Phonenumber" id="b_contact" size="30" maxlength="10" placeholder="Contact No" value="{{ isset($business_details['Phonenumber']) ? $business_details['Phonenumber'] : session()->get('phone') }}">
                                    <span class="error" id="b_cot"></span>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="pwd">Quick Business Intro <span id="star">*</span></label>
                                    <textarea class="form-control" rows="6" placeholder="Tell Us Somthing About Company..." name="Aboutcompany" id="about_company" maxlength="300">{{ isset($business_details['Aboutcompany']) ? $business_details['Aboutcompany'] : '' }}</textarea>
                                    <div class="text-right">150 Characters Left</div>
                                    <span class="error" id="b_abt"></span>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="pwd">Company Description <span id="star">*</span></label>
                                    <textarea class="form-control" rows="10" placeholder="Tell Us Somthing About Company in short..." name="Shortdescription" id="short_description" maxlength="20">{{ isset($business_details['Shortdescription']) ? $business_details['Shortdescription'] : '' }}</textarea>
                                    <div class="text-right">500 Characters Left</div>
                                    <span class="error" id="b_short"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn-bck" onclick="location.href='{{route('welcomeBusinessProfile')}}'"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn-nxt" id="btn-nxt1">Continue <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            <br>
                        </div>
                    </section>
                </div>
            </form>

        </div>
    </div>
</div>

@include('layouts.footer')

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script type="text/javascript">
    
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.blah').attr('src', e.target.result);
                var html = '<img src="' + e.target.result + '">';
                $('.uploadedpic').html(html);
            };
            profile_pic_var = input.files[0];
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $('#btn-nxt1').click(function () {
        var b_companyname = $('#b_companyname').val();
        var b_address = $('#b_address').val();
        var b_city = $('#b_city').val();
        var b_state = $('#b_state').val();
        var b_zipcode = $('#b_zipcode').val();
        var b_country = $('#b_country').val();
        var b_Establishmentyear = $('#b_Establishmentyear').val();
        var b_business_user_tag = $('#b_business_user_tag').val();
        var b_firstname = $('#b_firstname').val();
        var b_lastname = $('#b_lastname').val();
        var b_email = $('#b_email').val();
        var b_contact = $('#b_contact').val();
        var about_company = $('#about_company').val();
        var short_description = $('#short_description').val();

        var filter = /^\d*(?:\.\d{1,2})?$/;
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var str = /^[a-zA-Z\s]+$/;

        $('#b_cmpo').html('');
        $('#b_addr').html('');
        $('#b_ct').html('');
        $('#b_sta').html('');
        $('#b_zip').html('');
        $('#b_cont').html('');
        $('#b_estb').html('');
        $('#b_usertag').html('');
        $('#b_firstnm').html('');
        $('#b_lastnm').html('');
        $('#b_eml').html('');
        $('#b_cot').html('');
        $('#b_abt').html('');
        $('#b_short').html('');
        
        if(b_companyname == ''){
            $('#b_cmpo').html('Company Name is required');
              $('#b_companyname').focus();
              return false;
        }
        if(b_address == ''){
            $('#b_addr').html('Address is required');
            $('#b_address').focus();
              return false;
        }
        if(b_city == ''){
            $('#b_ct').html('City is required');
            $('#b_city').focus();
              return false;
        }
        if(!str.test(b_city)){
            $('#b_ct').html('City Name is not Valid');
            $('#b_city').focus();
              return false;
        }
        if(b_state == ''){
            $('#b_sta').html('State is required');
            $('#b_state').focus();
              return false;
        }
        if(!str.test(b_state)){
            $('#b_sta').html('State Name is not Valid');
            $('#b_state').focus();
              return false;
        }
        if(b_zipcode == ''){
            $('#b_zip').html('Zipcode is required');
            $('#b_zipcode').focus();
              return false;
        }
        if(b_country == ''){
            $('#b_cont').html('Country is required');
            $('#b_country').focus();
              return false;
        }
        if(!str.test(b_country)){
            $('#b_cont').html('Country Name is not Valid');
            $('#b_country').focus();
              return false;
        }
        if(b_Establishmentyear == ''){
            $('#b_estb').html('Establishment Year is required');
            $('#b_Establishmentyear').focus();
              return false;
        }
        if(!filter.test(b_Establishmentyear)){
            $('#b_estb').html('Establishment Year Not Valid');
            $('#b_Establishmentyear').focus();
              return false;
        }
        if(b_business_user_tag == ''){
            $('#b_usertag').html('Business Username is required');
            $('#b_business_user_tag').focus();
              return false;
        }
        if(b_firstname == ''){
            $('#b_firstnm').html('Company First Name is required');
            $('#b_firstname').focus();
              return false;
        }
        if(b_lastname == ''){
            $('#b_lastnm').html('Company Last Name is required');
            $('#b_lastname').focus();
              return false;
        }
        if(b_email == ''){
            $('#b_eml').html('Email is required');
              return false;
        }
        if(!regex.test(b_email)){
            $('#b_eml').html('Email is Not Valid');
            $('#b_email').focus();
              return false;
        }
        if(b_contact == ''){
            $('#b_cot').html('Contact Number is required');
            $('#b_contact').focus();
              return false;
        }
        if (filter.test(b_contact)) {
            if(b_contact.length > 12 || b_contact.length < 10){
                $('#b_cot').html('Contact Number is not Valid');
                $('#b_contact').focus();
                return false;
            }
        }
        if(about_company == ''){
            $('#b_abt').html('About Company is required');
            $('#about_company').focus();
              return false;
        }
        if(short_description == ''){
            $('#b_short').html('Short Description is required');
            $('#short_description').focus();
              return false;
        }
        

    });
</script>

@endsection
