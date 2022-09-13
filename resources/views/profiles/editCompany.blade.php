@extends('layouts.profile')
@section('content')
<style>
.Zebra_DatePicker {
    background: #666;
    border-radius: 4px;
    box-shadow: 0 0 10px #888;
    color: #222;
    font: 13px Tahoma,Arial,Helvetica,sans-serif;
    padding: 3px;
    position: absolute;
    display: table;
    z-index: 1200
    width: 35%!important;
    margin-top: 40px;
    margin-left: 16px;
}
.user_img img {
    height: 110px;
    width: 110px;
    border-radius: 55px;
}
 img.header_img {
    position: absolute;
    left: 0;
}
    hr.heading_hr {
    width: 10%;
    color: #f53b49;
    margin-top: 0;
    border-top: 3px solid;
    position: absolute;
    margin-bottom: 0 !important;
}
.introduction_section,.Education_section,.Company_section{
  padding-left: 16.7%;
}
h3{
  color: #f53b49;
}
.modal_buttons{
  text-align: center;
}
.btn.btn-secondary{
    width: 249px;
    display: inline-block;
    font-size: 23px;
    margin: 40px 0 25px;
    background: #f53b49 none repeat scroll 0 0;
    border: 1px solid #f53b49;
    padding: 12px 0;
    cursor: pointer;
    text-transform: uppercase;
    color: #fff;
    border-radius: 0px;
}

.user_img{
    text-align: center;
    margin: 5% 0px;
}
.user_img_content {
    margin: 3% 0px;
}
.header_content {
    padding: 0px 7%;
}
  span.user-img > img {
    width: 100%;
    height: 100%;
    border-radius: 100px;
}
  h4.heading {
    font-size: 22px;
    font-weight: 600;
    text-transform: uppercase;
    margin: 20px 0;
    border-bottom: 3px solid #f53b49;
    width: 70%;
    text-align: center;
    margin: 0px auto 20px auto;
    color: #f53b49;
}
  span.Zebra_DatePicker_Icon_Wrapper {
    width: 100% !important;
}
.Zebra_DatePicker *,
.Zebra_DatePicker :after,
.Zebra_DatePicker :before {
    box-sizing: content-box!important
}
.Zebra_DatePicker * {
    padding: 0
}
.Zebra_DatePicker table {
    border-collapse: collapse;
    border-radius: 4px;
    border-spacing: 0;
    width: 100%
}
.Zebra_DatePicker td,
.Zebra_DatePicker th {
    padding: 5px;
    cursor: pointer;
    text-align: center;
    min-width: 25px;
    width: 25px
}
.Zebra_DatePicker .dp_body td,
.Zebra_DatePicker .dp_body th {
    border: 1px solid #bfbfbf
}
.Zebra_DatePicker .dp_body td:first-child,
.Zebra_DatePicker .dp_body th:first-child {
    border-left: none
}
.Zebra_DatePicker .dp_body td:last-child,
.Zebra_DatePicker .dp_body th:last-child {
    border-right: none
}
.Zebra_DatePicker .dp_body tr:first-child td,
.Zebra_DatePicker .dp_body tr:first-child th {
    border-top: none
}
.Zebra_DatePicker .dp_body tr:last-child td,
.Zebra_DatePicker .dp_body tr:last-child th {
    border-bottom: none
}
.Zebra_DatePicker .dp_body td {
    background: #e6e5e5
}
.Zebra_DatePicker .dp_body .dp_weekend {
    background: #d6d6d6
}
.Zebra_DatePicker .dp_body .dp_not_in_month {
    background: #e0e6f2;
    color: #98acd4
}
.Zebra_DatePicker .dp_body .dp_time_controls_condensed td {
    width: 25%
}
.Zebra_DatePicker .dp_body .dp_current {
    color: #cc236b
}
.Zebra_DatePicker .dp_body .dp_selected {
    background: #b56a6a;
    color: #fff
}
.Zebra_DatePicker .dp_body .dp_disabled {
    background: #f2f2f2;
    color: #ccc;
    cursor: text
}
.Zebra_DatePicker .dp_body .dp_disabled.dp_current {
    color: #b56a6a
}
.Zebra_DatePicker .dp_body .dp_hover {
    color: #fff;
    background: #88a09e
}
.Zebra_DatePicker .dp_body .dp_hover.dp_time_control {
    background-color: #8c8c8c;
    color: #fff
}
.Zebra_DatePicker .dp_monthpicker td,
.Zebra_DatePicker .dp_timepicker td,
.Zebra_DatePicker .dp_yearpicker td {
    width: 33.3333%
}
.Zebra_DatePicker .dp_timepicker .dp_disabled {
    border: none;
    color: #222;
    font-size: 26px;
    font-weight: 700
}
.Zebra_DatePicker .dp_time_separator div {
    position: relative
}
.Zebra_DatePicker .dp_time_separator div:after {
    content: ":";
    color: 1px solid #bfbfbf;
    font-size: 20px;
    left: 100%;
    margin-left: 2px;
    margin-top: -13px;
    position: absolute;
    top: 50%;
    z-index: 1
}
.Zebra_DatePicker .dp_header {
    margin-bottom: 3px
}
@supports (-ms-ime-align:auto) {
    .Zebra_DatePicker .dp_header {
        font-family: 'Segoe UI Symbol',Tahoma,Arial,Helvetica,sans-serif
    }
}
.Zebra_DatePicker .dp_footer {
    margin-top: 3px
}
.Zebra_DatePicker .dp_footer .dp_icon {
    width: 50%
}
.Zebra_DatePicker .dp_actions td {
    border-radius: 4px;
    color: #fff
}
.Zebra_DatePicker .dp_actions .dp_caption {
    font-weight: 700;
    width: 100%
}
.Zebra_DatePicker .dp_actions .dp_next,
.Zebra_DatePicker .dp_actions .dp_previous {
    *padding: 0 10px
}
.Zebra_DatePicker .dp_actions .dp_hover {
    background-color: #8c8c8c;
    color: #fff
}
.Zebra_DatePicker .dp_daypicker th {
    background: #ed3948;
    cursor: text;
    font-weight: 700
}
.Zebra_DatePicker.dp_hidden {
    display: none
}
.Zebra_DatePicker .dp_icon {
    height: 16px;
    background-image: url(icons.png);
    background-repeat: no-repeat;
    text-indent: -9999px;
    *text-indent: 0
}
.Zebra_DatePicker .dp_icon.dp_confirm {
    background-position: center -123px
}
.Zebra_DatePicker .dp_icon.dp_view_toggler {
    background-position: center -91px
}
.Zebra_DatePicker .dp_icon.dp_view_toggler.dp_calendar {
    background-position: center -59px
}
button.Zebra_DatePicker_Icon {
    background: url(icons.png) center top no-repeat;
    border: none;
    cursor: pointer;
    display: block;
    height: 16px;
    line-height: 0;
    padding: 0;
    position: absolute;
    text-indent: -9000px;
    width: 16px
}
button.Zebra_DatePicker_Icon.Zebra_DatePicker_Icon_Disabled {
    background-position: center -32px;
    cursor: default
}
.rounded-corner{
    padding: 6px;
    padding-right: 10px;
    padding-left: 10px;
    background: red;
    color: #fff !important;
    border-radius: 30px;
    border: 1px solid red;
    cursor: hand;
    margin-bottom: 5px;
}
.delete-date{
    color:#fff !important;
}
  .dlt{w
    cursor: not-allowed;
  }
.delete_icon {
    float: right;
    color: #f53b49;
    position: relative;
    top: -20px;
}
span.brfcse {
    width: 36%;
    margin: 0 auto;
}


span.display_servicesport{
    padding-left: 0px !important;
}
.brfcse i.fa.fa-briefcase{
    color: #ffffff;
    font-size: 36px;
    background-color: #f53b49;
    padding: 25%;
    border-radius: 100%;
    position: relative;
    top: -47px;
}
.setterms{margin-bottom: 17px;
    padding-left: 17px;
    color: #f53b49;}
#taxmsg,#setnumbermsg{
         padding: 5px;
    border-radius: 4px;
    text-align: left;
    border: 1px solid #f53b49;
    background: #ff7e7e;
    color: #fff;
    width: fit-content;
}
.textsam {
    padding: 5px;
}
.hrsam {
    border-top: 1px solid #dedede;
    padding: 5px 0px;
        text-align: initial;
}
.col-md-3.often {
    text-align: left;
    padding-left: 0px;
    padding-right: 5px;
}
.percentage{
  border-bottom: 1px solid;
    width: 10%;
    text-align: -webkit-right;
    padding: 2px 8px;
    border-radius: 1px;
}
.msesinput{
      border: 1px solid;
      padding: 10px;
      width: 30%;
      float: left;
      margin-bottom: 11px;
}
.m-1{
      margin-top: 18px
}
.pd-0 {
    padding-left: 0;
    padding-right: 7px;
}
.qh-steps-form .btn.active span.glyphicon {
    color: #ffffff;
}
h2.additionheading {
    color: #f53b49;
    text-align: initial;
        font-size: 17px;
}
.col-md-3.samm,.col-md-6.samm,.col-md-12.samm {
    display: contents;
    text-align: left;
}
label.setupprice {
    margin-bottom: -12px;
}
input.offpro {
    width: unset;
    margin-right: 9px;
    margin-top: 7px;
}
  .multiples {
  padding: 5px 0;
  text-align: left;
  font-size: 17px;
  }
  .multiples label {
  font-size: 17px;
  font-weight: 400;
  padding: 2px 10px;
  color: #f53b49;
  }
  .weekDays-selector input {
  display: none!important;
  }
  a.ui-corner-all {
  background: #ff7e7e;
  color: white;
  padding: 0;
  font-size: 15px;
  }
  li.ui-menu-item{
    width: 82px !important;
    margin: 2px !important;
  }
  .weekDays-selector input[type=checkbox] + label {
  display: inline-block;
  border-radius: 50px;
  background: #dddddd;
  height: 39px;
  width: 40px;
  margin-right: 3px;
  line-height: 40px;
  text-align: center;
  cursor: pointer;
  }
  .weekDays-selector input[type=checkbox]:checked + label {
  background: #f53b49;
  color: #ffffff;
  }
  label.btn.btn-primary.active {
  background: #f53b49;
  }
  /* The container */
  #editDateDiv label.btn.btn-primary{
  border-radius: 50%;
  padding: 10px;
  margin-top: 16px;
  position: relative;
  left: 30px;
  top: 9px;
  }
  /* Create a custom checkbox */
  .checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radias:50%;
  }
  /* On mouse-over, add a grey background color */
  .container:hover input ~ .checkmark {
  background-color: #ccc;
  }
  /* When the checkbox is checked, add a blue background */
  .container input:checked ~ .checkmark {
  background-color: #2196F3;
  }
  /* Create the checkmark/indicator (hidden when not checked) */
  .checkmark:after {
  content: "";
  position: absolute;
  display: none;
  }
  /* Show the checkmark when checked */
  .container input:checked ~ .checkmark:after {
  display: block;
  }
  /* Style the checkmark/indicator */
  .container .checkmark:after {
  left: 9px;
  top: 5px;
  width: 5px;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
  }

  .loader {
       content: '';
display: block;
position: fixed;
left: 48%;
top: 40%;
width: 120px;
height: 120px;
border-style: solid;
border-color: #f53b49;
border-top-color: transparent;
border-width: 16px;
border-radius: 50%;
-webkit-animation: spin 2s linear infinite;
animation: spin 2s linear infinite;
z-index: 9999999;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<?php 
  $address = $mydetails['zip_code'];
  $url = "https://maps.google.com/maps/api/geocode/json?key=AIzaSyC45-kgXDIY_O8SZxc5d7YLdQYqSkcts7I&address=$address&sensor=false";
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  $response = curl_exec($ch);
  curl_close($ch);
  $response = json_decode($response);
  
  $getlat = $getlong = 0;
  if(isset($response->results)) {
    if(count($response->results) == 0){
      $getlat = $mydetails['latitude'];
      $getlong = $mydetails['longitude'];
    } else {
      $getlat = $response->results[0]->geometry->location->lat;
      $getlong = $response->results[0]->geometry->location->lng;
    }
  }
  ?>
  <div class="loader" style="display:none"></div>
<div class="profile-div editcompany-sec">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        <div class="signup-block">
          <h1>Complete YOUR PROFILE</h1>
          <p>Let’s showcase your experience level, skills, work experience, business details and what services you offer your clients.</p>
        </div>
        <div class="steps-block">
          <div class="line-process"></div>
        </div>
        <!-- step 1 starts -->
        <form id="frmregister" method="post" action="/profile/saveEditedProfileHistory" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="company_id" value="{{substr(Request::url(), strrpos(Request::url(), '/') + 1)}}">
          <?php 
          $ProfessionalDetail = [];
          if(isset($ProfessionalDetail) && !empty($ProfessionalDetail)) {
          $ProfessionalDetail = $UserProfileDetail['ProfessionalDetail'];
          $service = @$UserProfileDetail['service'];
          $myservice = @$UserProfileDetail['service'];
          $service = null;
          $login_id = Auth::user();
            ?>
         <input type="hidden" name="professional_detail_id" value="{{$ProfessionalDetail->id}}">
          <?php 
          }
            $train_to = array(); $personality = array(); $availability = array(); @$languages=array(); $travelTimes = array();
            @$languages  = json_decode(@$ProfessionalDetail->languages,true);
            @$experience_level = json_decode(@$ProfessionalDetail->experience_level,true);
            @$personality = json_decode(@$ProfessionalDetail->personality,true);
            @$goals_option = json_decode(@$ProfessionalDetail->goals_option,true);
            @$train_to = json_decode(@$ProfessionalDetail->train_to,true); 
            @$skill_lavel = json_decode(@$ProfessionalDetail->skill_lavel,true); 
            @$medical_type = json_decode(@$ProfessionalDetail->medical_type,true); 
            @$work_locations = json_decode(@$ProfessionalDetail->work_locations,true);
            @$hours = json_decode(@$ProfessionalDetail->availability,true);           
            @$hours = json_decode(@$hours,true);
            ?>
          <div id="singup_step_1" class="singup_steps">
            <!-- tab one -->
            <div class="step-block1 tab">
              <div class="row">
                <div class="col-sm-12">
                <div class="signup-block">
                  <h3>Name : {{$mydetails['first_name']}} {{$mydetails['last_name']}} </h3>
                  <h3>Company : {{$mydetails['company_name']}}</h3>
                  <h3>EIN : {{$mydetails['ein_number']}}</h3>
                  <div class="sgnup-rates mrgn-md-top">
                     <h1 class="step2-title">Company Representative First Name</h1>
                     <input type="text" name="firstnameb" id="b_firstname" size="30" maxlength="80" class="form-control" placeholder="Company Representative First Name" value="{{$mydetails['first_name']}}">
                     <span class="error" id="b_fn"></span>
                    <p>&nbsp;</p> 
                    <h1 class="step2-title">Company Representative Last Name</h1>
                     <input type="text" name="lastnameb" id="b_lastname" size="30" maxlength="80" class="form-control" placeholder="Company Representative Last Name" value="{{$mydetails['last_name']}}">
                     <span class="error" id="b_ln"></span>
                    <p>&nbsp;</p> 
                    <h1 class="step2-title">Email</h1>
                     <input type="email" name="emailb" id="b_email" class="myemail form-control" autocomplete="off" size="30" placeholder="Email Address" value="{{$mydetails['email']}}" size="30" maxlength="80">
                        <span class="error b_eml" id="b_eml" style="display:none"></span
                    <p>&nbsp;</p> 
                    <h1 class="step2-title">Contact Number</h1>
                     <input type="number" name="phone_number" id="b_contact" size="30" placeholder="Contact No" class="form-control" value="{{$mydetails['contact_number']}}" size="30" maxlength="10"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                        <span class="error" id="b_cot"></span>
                    <p>&nbsp;</p> 
                    <h1 class="step2-title">Company Name</h1>
                    <input type="text" class="form-control" name="Companyname" id="b_companyname" size="30" maxlength="80" value="{{$mydetails['company_name']}}" placeholder="Company Name">
                    <p>&nbsp;</p> 
                    <h1 class="step2-title">EIN NUmber</h1>
                    <input type="text" class="form-control" name="b_EINnumber" maxlength="10" id="b_EINnumber" maxlength="10"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" value="{{$mydetails['ein_number']}}" placeholder="EIN Number">
                    <p>&nbsp;</p> 
                    <h1 class="step2-title">Establishment Year</h1>
                    <input type="number" class="form-control" name="b_Establishmentyear" id="b_Establishmentyear" size="30"  maxlength="4" placeholder="Establishment Year" oninput="javascript: if (this.value.length > this.maxLength || this.value > new Date().getFullYear() ) this.value = this.value.slice(0, this.maxLength);" value="{{$mydetails['establishment_year']}}">
                    <p>&nbsp;</p>
                    <h1 class="step2-title">Address</h1>
                        <input autocomplete="nope" class="form-control" value="{{$mydetails['address']}}" type="text" name="address" id="b_address" oninput="initialize1(this)" placeholder="Address">
                    <p>&nbsp;</p>
                    <h1 class="step2-title">City</h1>
                    <input type="text" name="city" class="form-control" id="b_city" value="{{$mydetails['city']}}" size="30" placeholder="City" size="30" maxlength="80"> 
                    <p>&nbsp;</p>
                    <h1 class="step2-title">State</h1>
                    <input type="text" name="state" class="form-control" id="b_state" value="{{$mydetails['state']}}" size="30" placeholder="State" size="30" maxlength="80">
                    <p>&nbsp;</p>
                    
                    <h1 class="step2-title">Zip Code</h1>
                    <input type="number" name="zip_code" class="form-control" id="b_zipcode" value="{{$mydetails['zip_code']}}" size="30" placeholder="Zip Code">
                    <p>&nbsp;</p>
                    
                     <h1 class="step2-title">Country</h1>
                    <input type="text" name="country" class="form-control" id="b_country" value="{{$mydetails['country']}}" size="30" placeholder='Country'>
                    <p>&nbsp;</p>
                    {{ Form::hidden('latitude', $mydetails['latitude'], array('id' => 'b_lat')) }}
                    {{ Form::hidden('longitude', $mydetails['longitude'], array('id' => 'b_long')) }}
                    
                    <h1 class="step2-title">About Company</h1>
                    @if($mydetails['about_company'] == null)
                    <textarea style="width:100%;" placeholder="Tell Us Somthing About Company..." name="about_company" id="about_company" rows="7" maxlength="300" required></textarea>
                    @else
                    <textarea style="width:100%;" placeholder="Tell Us Somthing About Company..." name="about_company" id="about_company" rows="7" maxlength="300" required>{!! $mydetails['about_company'] !!}</textarea>
                    @endif
                    <p>&nbsp;</p> 
                    <h1 class="step2-title">Short Description</h1>
                    <input type="text" class="form-control" name="b_shortDescription" id="b_shortDescription" value="{{$mydetails['short_description']}}" placeholder="Short Description" maxlength="20">
                    <p>&nbsp;</p> 
                    
                    
                    <p>&nbsp;</p> 
                     <h1 class="step2-title">Languages (s) you and your staff speak ?</h1>
                    <select name="languages[]" id="testdemo" multiple>
                        @foreach($allLanguages as  $language)
                          <option value="{{$language}}" @if(@in_array($language, $languages)) selected @endif>{{$language}}</option>
                        }
                        @endforeach 
                    </select>
                      <p>&nbsp;</p>
                    <h1 class="step2-title">Who do you work with?</h1>
                    <?php $op = array("kid"=>"Kid","Teens & Adult"=>"Teens & Adult","Partners & Couples"=>"Partners & Couples","individuals"=>"Individuals","Groups"=>"Groups","all"=>"all");?>
                    <select name="train_to[]" id="train_to"  multiple>
                    @foreach($op  as $key=> $p)
                    <?php $key = str_replace(' ','_',strtolower($key)); ?>
                    <option value="{{ $key }}" @if(@in_array($key, $train_to)) selected @endif>{{$p}}</option>
                    @endforeach
                    </select>
                    <p>&nbsp;</p>
                    <h1 class="step2-title">SERVICE Experience? (Choose all that apply)</h1>
                    <?php
                      $experience  = array(
                          "Technical"=>"Technical",
                          "Workout"=>"Workout",
                          "Bootcamp"=>"Bootcamp",
                          "Challenging and Tough "=>"Challenging and Tough ",
                          "Strength and Conditioning"=>"Strength and Conditioning",
                          "Learning a skill"=>"Learning a skill",
                          "Educational"=>"Educational",
                          "Adventurous"=>"Adventurous"
                        );
                      ?>
                    <select name="experience_level[]" id="personality" multiple>
                    @foreach($experience  as $key=> $p)
                    <?php $key = str_replace(' ','_',strtolower($key)); ?>
                    <option value="{{$key}}" @if(@in_array($key, $experience_level)) selected @endif>{{$p}}</option>
                    @endforeach
                    </select>
                    <p>&nbsp;</p>
                    <h1 class="step2-title">Personality Type?</h1>
                    <?php $type = array(
                      "An Educator & Teacher"=>"An Educator & Teacher",
                      "A Lot Of Energy"=>"A Lot Of Energy",
                      "Supportive, Soft And Nurturing"=>"Supportive, Soft And Nurturing",
                      "Tough And Firm"=>"Tough And Firm",
                      "Care About The Details"=>"Care About The Details",
                      "Drill Seargent"=>"Drill Seargent",
                      "Entertaining and Funny"=>"Entertaining and Funny"
                        );
                        ?>
                    <select name="personality[]" id="personality_type"  multiple>
                    @foreach($type  as $key=> $p)
                    <?php $key = str_replace(' ','_',strtolower($key)); ?>
                    <option value="{{$key}}" @if(@in_array($key, $personality)) selected @endif>{{$p}}</option>
                    @endforeach
                    </select>
                    <p>&nbsp;</p>
                    <h1 class="step2-title">What skill level should your clients have?</h1>
                    <?php
                      $skills  = array(
                      "beginner"=>"Beginner",
                      "intermediated"=>"Intermediate",
                      "advanced"=>"Advanced",
                      "amateur"=>"Amateur",
                      "professional"=>"Professional",
                      "Any Experience"=>"Any Experience"
                      );
                      ?>    
                    <select name="skill_lavel[]" id="skill"  multiple>
                    @foreach($skills  as $key=> $p)
                    <?php $key = str_replace(' ','_',strtolower($key)); ?>
                    <option value="{{$key}}" @if(@in_array($key, $skill_lavel)) selected @endif>{{$p}}</option>
                    @endforeach
                    </select>
                    <p>&nbsp;</p>
                    <h1 class="step2-title">Do you work with clients with medical conditions?</h1>
                    <div class="col-md-6 col-sm-6 col-xs-6 qh-steps-form">
                      <div class="form-control med-cond-check">
                        <div class="btn-group" data-toggle="buttons">
                          <label class="btn btn-primary medicaloption @if(@$ProfessionalDetail->medical_states == 1) active @endif">
                          <input type="radio" value="1" class="chkdy" name="medical_states" autocomplete="off" @if(@$ProfessionalDetail->medical_states == 1) checked @endif>
                          <span class="glyphicon glyphicon-ok"></span> </label>
                          Yes
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 qh-steps-form">
                      <div class="form-control med-cond-check">
                        <div class="btn-group" data-toggle="buttons">
                          <label class="btn btn-primary medicaloption @if(@$ProfessionalDetail->medical_states == 0) active @endif">
                          <input type="radio" value="0" class="chkdy" name="medical_states" autocomplete="off" @if(@$ProfessionalDetail->medical_states == 0) checked @endif>
                          <span class="glyphicon glyphicon-ok"></span> </label>
                          No
                        </div>
                      </div>
                    </div>
                    {{--  start  --}}
                    <div class="medicalyesno row" style="@if(@$ProfessionalDetail->medical_states == 'no') display: none; @endif">
                      <p>&nbsp;</p>
                      <h1 class="step2-title text-left" style="padding-left:15px;text-transform: none;">If Yes, what type? </h1>
                      <div class="col-md-12">
                        <?php $medicalCondition = array('Breathing Problem','Back Problem','Pregnant','Special Needs','Doesnt Matter','Others'); ?>
                        <select name="medical_type[]" id="mcc" multiple>
                        @foreach($medicalCondition as $key => $mcc)
                        <?php $key = str_replace(' ','_',strtolower($key)); ?>
                        <option value="{{$key}}" @if(@in_array($key, $medical_type)) selected @endif>{{$mcc}}</option>
                        @endforeach
                        </select>
                      </div>
                    </div>
                    {{--  end  --}} 
                    <p>&nbsp;</p>
                    <h1>WHERE DO YOU WORK WITH CLIENTS? (Choose all that apply) 
                    </h1>
                    <?php
                      $clients_option  = array(
                          "Online"=>"Online", 
                          "Studio"=>"Studio", 
                       "Local Gym"=>"Local Gym",
                       "Training Facility"=>"Training Facility",
                       "Public location"=>"Public location",
                       "Outside location"=>"Outside location",
                       "Indoor facility"=>"Indoor facility",
                       "Clients home OR Apartment"=>"Clients home OR Apartment",
                       "A location chosen by the client"=>"A location chosen by the client",
                       "Other"=>"Other",
                       "Any location"=>"Any location"
                      );
                       ?>   
                    <select name="work_locations[]" id="where_choose" multiple>
                    @foreach($clients_option as $key => $mcc)
                    <?php $key = str_replace(' ','_',strtolower($key)); ?>
                    <option value="{{$key}}" @if(@in_array($key, $work_locations)) selected @endif>{{$mcc}}</option>
                    @endforeach
                    </select>
                  <p>&nbsp;</p>
                  </div>
                  <h1 class="step2-title">Do your business help clients with these fitness goals?</h1>
                  <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12 qh-steps-form">
                      <div class="col-md-6 col-sm-6 col-xs-6 qh-steps-form">
                        <div class="form-control">
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary fitgolsop @if(@$ProfessionalDetail->goals_states == 1) active @endif">
                            <input type="radio" value="1" class="chkdy" name="fitness_goals" autocomplete="off" @if( @$ProfessionalDetail->goals_states == 1) checked @endif>
                            <span class="glyphicon glyphicon-ok"></span> </label>
                            Yes
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-6 qh-steps-form">
                        <div class="form-control">
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-primary fitgolsop @if(@$ProfessionalDetail->goals_states == 0) active @endif">
                            <input type="radio" value="0" class="chkdy" name="fitness_goals" autocomplete="off" @if(@$ProfessionalDetail->goals_states == 0) checked @endif>
                            <span class="glyphicon glyphicon-ok"></span> </label>
                            No
                          </div>
                        </div>
                      </div>
                    </div>
                    {{--  end row  --}}
                    <span class="fitgolsyesno" style="@if(@$ProfessionalDetail->goals_states == 0) display: none; @endif">
                      <h1 class="step2-title text-left" style="padding-left:15px;text-transform: none;">If Yes, what type? </h1>
                      <div class="col-md-12 col-sm-12 col-xs-12 qh-steps-form">
                        <?php $fitness_goals_array = array('Weight Loss','Firming & Toning','Increase Strenght','Endurance Training','Nutritions','Weight Gain','Flexibilty','Aerobics Fitness','Body Building','Pre/Post Natal','Other'); ?>
                        <select name="goals_option[]" id="fitness_goals_array" multiple>
                        @foreach($fitness_goals_array as $fga)
                        <?php $key = str_replace(' ','_',strtolower($fga)); ?>
                        <option value="{{$key}}" @if(@in_array($key, $goals_option)) selected @endif>{{$fga}}</option>
                        @endforeach
                        </select>
                      </div>
                    </span>
                    {{-- end span  --}}
                  </div>
                </div>
              </div>
              </div>
            </div>
          </div>
          <!-- tab nine -->
          <div class="step-block1 tab">
            <h1 class="step2-title">Add your Business Hours</h1>
            <div class="signup-block">
              <h3 class="step2-title">Add your business hours to Valor Mixed Martial Arts NYC, so its easy to people to plan a visit. When you add business hours, Your page is also more likely to be suggested to people in your area.</h3>
              <div class="sgnup-rates mrgn-md-top">
                <div class="row">
                  <div class="col-md-12">
                    <h4>Hours</h4>
                  </div>
                  <?php 
                    $businessHoursType = array ('Open on selected hours','Always Open','No hours available','Permanently Closed');
                    foreach ($businessHoursType as $bkey => $bval) { ?>
                    <div class="col-md-4 col-sm-12 col-xs-12 qh-steps-form">
                      <div class="form-control">
                        <div class="btn-group" data-toggle="buttons">
                          <label class="business_hour_type btn btn-primary @if(@$ProfessionalDetail->hours == $bkey) active @endif" @if(@$bkey==0) onclick="javascript:hoursshow();" @endif @if(@$bkey==1 || @$bkey==2 || @$bkey==3) onclick="javascript:hidehoursshow();" @endif >
                          <input type="radio" class="chk" value="<?php echo $bkey; ?>" name="hours_opt" autocomplete="off" @if(@$ProfessionalDetail->hours == $bkey) checked @endif>
                          <span class="glyphicon glyphicon-ok"></span> </label>
                          <?php echo $bval; ?>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
                <div id="hourshow" style="display:none">
                  <hr/>
                  <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12 qh-steps-form">
                      <div class="form-control">
                        <div class="btn-group" data-toggle="buttons">
                          <label class="btn btn-primary" onclick="javascript:hoursshow();">
                          <input type="radio" class="chk" value="anyday" name="business_hour_supertype" autocomplete="off">
                          <span class="glyphicon glyphicon-ok"></span> </label>
                          Specific Day or Time
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 col-sm-12 col-xs-12 qh-steps-form">
                      <div class="form-control">
                        <div class="btn-group" data-toggle="buttons">
                          <label class="btn btn-primary" onclick="javascript:showEditDate();">
                          <input type="radio" class="chk" value="mubusinesshour" name="business_hour_supertype" autocomplete="off">
                          <span class="glyphicon glyphicon-ok"></span> </label>
                          My business hours
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- div classs hourshow end  --}}
                <div class="row" id="hoursshow"  @if(@$ProfessionalDetail->hours !=0) style="display:none" @endif >                 
                  <div class="col-md-12 col-sm-12 col-xs-12 qh-steps-form">
                    <div class="form-control">
                      <div class="row">
                          <div class="col-md-5">
                              <div class="btn-group" data-toggle="buttons">
                                Sunday
                              </div>
                          </div>
                          <div class="col-md-3" style="">
                            <input type="text"  class="bsunstarttimepicker" name="availability[sunday_start]" value="{{$hours['sunday_start']}}" autocomplete="off" style="width:100%">
                          </div>
                          <div class="col-sm-1"> &nbsp;-&nbsp;</div>
                          <div class="col-md-3">   
                            <input type="text" class="bsunendtimepicker" name="availability[sunday_end]" value="{{$hours['sunday_end']}}" autocomplete="off" style="width:100%">
                          </div>
                      </div>
                    </div>
                    <div class="form-control">
                        <div class="row">
                            <div class="col-md-5">
                              <div class="btn-group" data-toggle="buttons">
                                Monday
                              </div>
                            </div>
                            <div class="col-md-3">
                              <input type="text" class="bmonstarttimepicker" name="availability[monday_start]" value="{{$hours['monday_start']}}" autocomplete="off" style="width:100%">
                            </div>
                            <div class="col-sm-1"> &nbsp;-&nbsp;</div>
                            <div class="col-md-3">   
                              <input type="text" class="bmonendtimepicker" name="availability[monday_end]" value="{{$hours['monday_end']}}" autocomplete="off" style="width:100%">
                            </div>
                        </div>
                    </div>
                    <div class="form-control">
                         <div class="row">
                            <div class="col-md-5">
                              <div class="btn-group" data-toggle="buttons">
                                Tuesday
                              </div>
                            </div>
                            <div class="col-md-3">
                              <input type="text" class="btuesstarttimepicker" name="availability[tuesday_start]" value="{{$hours['tuesday_start']}}" autocomplete="off" style="width:100%">
                            </div>
                            <div class="col-sm-1"> &nbsp;-&nbsp;</div>
                            <div class="col-md-3">   
                              <input type="text" class="btuesendtimepicker" name="availability[tuesday_end]" value="{{$hours['tuesday_end']}}" autocomplete="off" style="width:100%">
                            </div>
                        </div>
                    </div>
                    <div class="form-control">
                        <div class="row">
                            <div class="col-md-5">
                              <div class="btn-group" data-toggle="buttons">
                                Wednesday
                              </div>
                            </div>
                            <div class="col-md-3">
                              <input type="text" class="bwedstarttimepicker" name="availability[wednesday_start]" value="{{$hours['wednesday_start']}}" autocomplete="off" style="width:100%">
                            </div>
                            <div class="col-sm-1"> &nbsp;-&nbsp;</div>
                            <div class="col-md-3">   
                              <input type="text" class="bwedendtimepicker" name="availability[wednesday_end]" value="{{$hours['wednesday_end']}}" autocomplete="off" style="width:100%">
                            </div>
                        </div>
                    </div>
                    <div class="form-control">
                       <div class="row">
                            <div class="col-md-5">
                              <div class="btn-group" data-toggle="buttons">
                                Thursday
                              </div>
                            </div>
                            <div class="col-md-3">
                              <input type="text" class="bthrusstarttimepicker" name="availability[thrusday_start]" value="{{$hours['thrusday_start']}}" autocomplete="off" style="width:100%">
                            </div>
                            <div class="col-sm-1"> &nbsp;-&nbsp;</div>
                            <div class="col-md-3">   
                              <input type="text" class="bthrusendtimepicker" name="availability[thrusday_end]" value="{{$hours['thrusday_end']}}" autocomplete="off" style="width:100%">
                            </div>
                        </div>
                    </div>
                    <div class="form-control">
                        <div class="row">
                            <div class="col-md-5">
                              <div class="btn-group" data-toggle="buttons">
                                Friday
                              </div>
                            </div>
                            <div class="col-md-3">
                              <input type="text" class="bfristarttimepicker" name="availability[friday_start]" value="{{$hours['friday_start']}}" autocomplete="off" style="width:100%">
                            </div>
                            <div class="col-sm-1"> &nbsp;-&nbsp;</div>
                            <div class="col-md-3">   
                              <input type="text" class="bfriendtimepicker" name="availability[friday_end]" value="{{$hours['friday_end']}}" autocomplete="off" style="width:100%">
                            </div>
                        </div>
                    </div>
                    <div class="form-control">
                         <div class="row">
                            <div class="col-md-5">
                              <div class="btn-group" data-toggle="buttons">
                                Saturday
                              </div>
                            </div>
                            <div class="col-md-3">
                              <input type="text" class="bsatstarttimepicker" name="availability[saturday_start]" value="{{$hours['saturday_start']}}" autocomplete="off" style="width:100%">
                            </div>
                            <div class="col-sm-1"> &nbsp;-&nbsp;</div>
                            <div class="col-md-3">   
                              <input type="text" class="bsatendtimepicker" name="availability[saturday_end]" value="{{$hours['saturday_end']}}" autocomplete="off" style="width:100%">
                            </div>
                        </div>
                    </div>
                  </div>
                  
                </div>
                <div class="row timezone-sec">
                    <div class="col-md-6 col-xs-12" >
                      <h1>Time Zone</h1>
                      <select name="timezone" class="form-control">
                        <option value="est" @if(isset($ProfessionalDetail->timezone) && $ProfessionalDetail->timezone=="est") selected @endif> Eastern Standard Time (EST)</option>
                        <option value="cst" @if(isset($ProfessionalDetail->timezone) && $ProfessionalDetail->timezone=="cst") selected @endif> Central Standard Time (CST)</option>
                        <option value="mst" @if(isset($ProfessionalDetail->timezone) && $ProfessionalDetail->timezone=="mst") selected @endif> Mountain Standard Time (MST)</option>
                        <option value="pst" @if(isset($ProfessionalDetail->timezone) && $ProfessionalDetail->timezone=="pst") selected @endif> Pacific Standard Time (PST)</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                    </div>
                  </div>
                <div class="row">
                 
                  <div style="width: 90%;float: inherit;border-radius: 4px;margin: 20px 10px 10px 10px;">
                    <div id="editDateDiv" style="width: 90%;margin-left: 10px;display: none;">
                      <p>What are your business hours?</p>
                      <br>
                      <p>Which days do you work?</p>
                      <br>
                      <div class="weekDays-selector">
                        <input type="checkbox" id="weekday-sun" class="weekday" />
                        <label for="weekday-sun">S</label>
                        <input type="checkbox" id="weekday-mon" class="weekday" />
                        <label for="weekday-mon">M</label>
                        <input type="checkbox" id="weekday-tue" class="weekday" />
                        <label for="weekday-tue">T</label>
                        <input type="checkbox" id="weekday-wed" class="weekday" />
                        <label for="weekday-wed">W</label>
                        <input type="checkbox" id="weekday-thu" class="weekday" />
                        <label for="weekday-thu">T</label>
                        <input type="checkbox" id="weekday-fri" class="weekday" />
                        <label for="weekday-fri">F</label>
                        <input type="checkbox" id="weekday-sat" class="weekday" />
                        <label for="weekday-sat">S</label>
                      </div>
                      {{--  <div style="line-height: 3;">
                        <p>What hours are you normally available to work?</P>
                        <input class="form-control timepicker" type="text" name="to" value="">
                        To 
                        <input class="form-control timepicker" type="text" name="to" id="timepicker1" value=""> 
                        <script type="text/javascript">
                          $('#timepicker1').timepicker({
                            showInputs: false
                          });
                        </script>
                      </div>  --}}
                    </div>
                  </div>
                  <hr/>
                </div>
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12 qh-steps-form">
                    <div class="form-control special-dy-sec">
                      <h4>Any Special Days Off?</h4>
                      
                      <div class="manual-remove">
                        @if(isset($ProfessionalDetail) && !empty($ProfessionalDetail))
                        @foreach((explode(',',$ProfessionalDetail->special_days_off)) as $value)
                        @if($value != 'null' && $value != null)
                        <button type="button" date="{{$value}}" class="rounded-corner {{$value}}">{{$value}} x</button>
                        @endif
                        @endforeach
                        @endif
                        </div>
                      <div class="btn-group" data-toggle="buttons">
                        <input type="text" class="form-control" name="special_days_off"  placeholder="Click here to select the dates you are closed" id="mdp-demo" onkeydown="no_backspaces(event);" />
                      </div>
                    </div>
                  </div>
                  
                </div>
                <div class="row">
                  <div class="col-md-4 col-sm-12 col-xs-12 qh-steps-form">
                    <hr/>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <h3 style="text-align: left">How much notice do you need for each booking?</h3>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                    <div class="form-control">
                      <div class="select-style">
                        <?php 
                        if(isset($ProfessionalDetail) && !empty($ProfessionalDetail)) {
                        $note = json_decode($ProfessionalDetail->notice_each_book,true);
                        }
                        ?>
                        <select class="selectpicker" name="notice_each_book_day" id="firstdayweek" rel="notice">
                          <option values="Days" @if(@array_key_exists("Days",$note)) selected @endif>Days</option>
                          <option values="Weeks" @if(@array_key_exists("Weeks",$note)) selected @endif>Weeks</option>
                          <option values="Months" @if(@array_key_exists("Months",$note)) selected @endif>Months</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                    <div class="form-control">
                      <div class="select-style">
                        <select class="selectpicker" name="notice_each_book_ans" id="notice">
                          @for ($i = 1; $i <= 31; $i++)
                          <option values="{{$i}}" @if(@in_array($i,array_values($note))) selected @endif>{{$i}}</option>
                          @endfor
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <h3 style="text-align: left">How far in advance can a customer book/reserve?</h3>
                  </div>
                </div>
                <?php 
                if(isset($ProfessionalDetail) && !empty($ProfessionalDetail)) {
                $addv = json_decode($ProfessionalDetail->advance_book,true);
                }
                ?>
                <div class="row">
                  <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                    <div class="form-control">
                      <div class="select-style">
                        <select class="selectpicker" name="advance_book_day" id="secdayweek" rel="addvance">
                          <option values="Days" @if(@array_key_exists("Days",$addv)) selected @endif>Days</option>
                          <option values="Weeks" @if(@array_key_exists("Weeks",$addv)) selected @endif>Weeks</option>
                          <option values="Months" @if(@array_key_exists("Months",$addv)) selected @endif>Months</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12 col-xs-12 qh-steps-form">
                    <div class="form-control">
                      <div class="select-style">
                        <select class="selectpicker" name="advance_book_ans" id="addvance">
                          @for ($i = 1; $i <= 31; $i++)
                          <option values="{{$i}}" @if(@in_array($i,array_values($addv))) selected @endif>{{$i}}</option>
                          @endfor
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- tab ten -->
          <div class="step-block1 tab">
            <h1 class="step2-title">Do you travel to clients?</h1>
            <div class="signup-block">
              <div class="sgnup-rates mrgn-md-top">
                <div class="row">
                  <div class="col-md-4 col-sm-12 col-xs-12 qh-steps-form">
                    <div class="col-md-6 col-sm-6 col-xs-6 qh-steps-form">
                      <div class="form-control">
                        <div class="btn-group" data-toggle="buttons">
                          <label class="btn btn-primary willing_to_travel @if(isset($ProfessionalDetail->willing_to_travel) && $ProfessionalDetail->willing_to_travel == 'yes') active @endif">
                          <input type="radio" value="yes" class="chkdy" name="willing_to_travel" autocomplete="off" @if(isset($ProfessionalDetail->willing_to_travel) && $ProfessionalDetail->willing_to_travel == 'yes') checked @endif>
                          <span class="glyphicon glyphicon-ok"></span> </label>
                          Yes
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 qh-steps-form">
                      <div class="form-control">
                        <div class="btn-group" data-toggle="buttons">
                          <label class="btn btn-primary willing_to_travel @if(isset($ProfessionalDetail->willing_to_travel) && $ProfessionalDetail->willing_to_travel == 'no') active @endif">
                          <input type="radio" value="no" class="chkdy" name="willing_to_travel" autocomplete="off" @if( isset($ProfessionalDetail->willing_to_travel) && $ProfessionalDetail->willing_to_travel == 'no') checked @endif>
                          <span class="glyphicon glyphicon-ok"></span> </label>
                          No
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-12 qh-steps-form">
                    <div class="form-control mapedit-sec">
                      <span class="travel_miles_div"
                        style="@if(isset($ProfessionalDetail->willing_to_travel) && $ProfessionalDetail->willing_to_travel == 'no') display: none; @endif">
                        <div class="select-style">
                          <?php
                            $miles_arr = array('1'=>'1 Mile','3'=>'3 Miles','5'=>'5 Miles','10'=>'10 Miles','15'=>'15 Miles','20'=>'20 Miles');
                            ?>
                          <select class="selectpicker" name="travel_miles" id="milesnew">
                          <?php 
                          foreach($miles_arr as $key=>$value) { ?>
                          <option value="<?php echo $key; ?>" @if($key == isset($ProfessionalDetail->travel_miles) && $ProfessionalDetail->travel_miles) selected @endif ><?php echo $value; ?></option>
                          <?php } ?>
                          </select>
                        </div>
                        <p class="zipara">How far are you willing to travel out of your zip code?</p>
                        <div id="map_canvas" style="height:300px;width:700px"></div>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="row" style="text-align: center;">
                  <!--  <a href="/reviews"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>u19.png" /></a>-->
                </div>
                 <h1>Become A Fitnessity Vetted Business</h1>
                <div class="signup-block">
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!--<h3 class="step2-title">What’s your education history?</h3>-->
                        <p>Win your customers trust when you complete a background check. It’s a fast and simple process. Customers will be able to see on your profile that you are a vetted business.</p>
                        <p>Are you interested in becoming a vetted business? This service is optional but highly recommended. To maintain the vetted business stamp on your profile, we will do background checks twice a year, or every 6 months. </p>
                     </div> 
                       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <div class="table-responsive">
                            
                            <table class="uiuuiuiu lrnmr-table" id="education_table_l" cellpadding="0" cellspacing="0" border="0" style="width:100%">
                                
                                  <tbody>
                                    <tr><td colspan="4"><hr /></td></tr>
                                    <tr><td colspan="4"><h4 style="color: red">Learn More</h4></td></tr>
                                    <tr id="7777">
                                        <td valign="middle">
                                          <a href="{{url('vetted-business-faq') }}" target="_blank" style="color: red">Vetted Business FAQ's</a><a href="{{ url('background-check-faq') }}" target="_blank" style="color: red">Background Check FAQ's</a>
                                        </td>
                                        <td valign="middle" align="right">
                                          <button class="upload-pic" id="verfy_check" type="button">Get Started</button>
                                        </td>
                                    </tr>
                              
                                  </tbody>
                              </table>
                          </div>
                        </div>
                  </div>
                </div>
                <!-- employement -->
  <h1><div style="border: 2px solid #dad5d599;height: 7px;border-style: inset;margin-bottom: 20px;"></div>
  EMPLOYEMENT HISTORY</h1>
               <div class="signup-block">
                  <div class="row rw-wrp"> 
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                      <h3 class="step2-title">Add your employment history</h3>
                      
                      <p>Write about previous positions, companies, and the number of years you have worked, plus highlight relevant projects and accomplishments.</p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                      <span class="user-img" style="overflow:inherit;width: 100;margin-bottom: 20px;padding: 28px 42px;">
                        <i class="fa fa-briefcase"></i>
                        
                        <a href="#" class="add_sngp" id="add_sngp">+</a>
                      </span>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                        <input type="hidden" name="edited_employmenthistory_id" id="edited_employmenthistory_id" value="">
                        <input type="hidden" name="deleted_employmenthistory_id" id="deleted_employmenthistory_id" value="">
                          <table class="table add_education" id="employement_history_table" cellpadding="0" cellspacing="0" border="0">
                              <thead>
                                  <tr>
                                      <th>Organization</th>
                                        <th>Position</th>
                                        <th>From</th>
                                        <th>To</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $employmenthistories = $UserProfileDetail['employmenthistory']; ?>
                          @if(count($employmenthistories) > 0)
                            <?php $history_index = 0; ?>
                              @foreach($employmenthistories as $employmenthistory)
                                <?php $history_index++; ?>
                                    <tr id="history_{{$history_index}}">
                                      <input type="hidden" name="employmenthistory_id[]" value="{{$employmenthistory->id}}">
                              <td valign="middle">
                                <input type="text" name="organization[]" value="{{ $employmenthistory->organization }}" class="noborder" title="organization" readonly>
                              </td>
                              <td valign="middle">
                                <input type="text" name="position[]" value="{{ $employmenthistory->position }}" class="noborder"  title="position" readonly>
                              </td>
                              <td valign="middle">
                                <input type="hidden" name="ispresent[]" value="{{ $employmenthistory->is_present }}" class="noborder" title="ispresent">
                                <input type="text" name="servicestart[]" value="{{ date('m-d-Y', strtotime($employmenthistory->service_start)) }}" class="noborder"  title="servicestart" readonly>
                              </td>
                              <td valign="middle">
                                @if($employmenthistory->is_present)
                                  <?php $service_end = "Till Date"; ?>
                                @else
                                  <?php $service_end = date('m-d-Y', strtotime($employmenthistory->service_end)); ?>
                                @endif
                                <input type="text" name="serviceend[]" value="{{ $service_end }}" class="noborder"  title="serviceend" readonly>
                              </td>
                              <td valign="middle" align="center">
                                <a href="javascript:editHistory({{$history_index}})"><i class="fa fa-pencil-square"></i></a>
                                <a href="javascript:deleteRow('history_{{$history_index}}')" title="Delete this detail"><i class="fa fa-trash"></i></a>
                              </td>
                            </tr>
                          @endforeach
                        @else
                          <tr id="history_0">                                     
                                    </tr>     
                            @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Modal -->
                <div class="modal fade" id="addEmployementHistory" role="dialog">
                
                <input type="hidden" name="editrowcount" id="editrowcount" value="">
                  <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-body login-pad">
                        <div class="pop-title employe-title">
                          <h3>EMPLOYEMENT HISTORY</h3>
                        </div>
                        <button type="button" class="close modal-close" data-dismiss="modal">
                        <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                      </button>
                      
                        <div class="signup">
                          <div id='systemMessage_history'></div>
                            <div class="emplouyee-form">
                            <input type="text" name="frm_organization" placeholder="Organization name" />
                            <input type="text" name="frm_position" placeholder="Position" />
                            <div class="qh-steps-form">
                                <div class="form-control">
                                  <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-primary present_work_btn">
                                      <input type="checkbox" autocomplete="off" name="frm_ispresentcheck" id="frm_ispresentcheck" value="1">
                                      <input type="hidden" name="frm_ispresent" id="frm_ispresent" value="0">
                                      <span class="glyphicon glyphicon-ok"></span>
                                    </label>
                                    <span class="lbl-txt">Presently working here</span> 
                                  </div>
                                </div>
                              </div>
                            <div id="dp1-position">
                            <input type="text" name="frm_servicestart" class="span2" placeholder="From" id="dp1" readonly >
                            </div>
                            <div id="dp2-position">
                            <input type="text" name="frm_serviceend" class="span2" placeholder="To" id="dp2" readonly >
                            </div>
                              <button type="button" id="submit_employement_history">SUBMIT</button>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
                  </div>
                </div> 
<!-- employement end -->
<!--  Education  -->

               <h1>
               <div style="border: 2px solid #dad5d599;height: 7px;border-style: inset;margin-bottom: 20px;"></div>Education</h1>
                <div class="signup-block">
                  <div class="row "> 
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
                        <h3 class="step2-title">What’s your education history?</h3>
                     </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <div class="table-responsive">
                        <input type="hidden" name="edited_education_id" id="edited_education_id" value="">
                        <input type="hidden" name="deleted_education_id" id="deleted_education_id" value="">
                        <table class="table add_education" id="education_table" cellpadding="0" cellspacing="0" border="0">
                            <thead>
                                <tr>
                                    <th>Degree/Course</th>
                                      <th>University/School</th>
                                      <th>Year graduated</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php $educations = $UserProfileDetail['education']; ?>
                          @if(count($educations) > 0)
                            <?php $education_index = 0; ?>
                              @foreach($educations as $education)
                                <?php $education_index++; ?>
                                    <tr id="education_{{$education_index}}">
                                      <input type="hidden" name="education_id[]" value="{{$education->id}}">
                              <td valign="middle">
                                <input type="text" name="course[]" value="{{ $education->course }}" class="noborder" title="course" readonly>
                              </td>
                              <td valign="middle">
                                <input type="text" name="university[]" value="{{ $education->university }}" class="noborder"  title="university" readonly>
                              </td>
                              <td valign="middle">
                                <input type="text" name="passingyear[]" value="{{ date('Y', strtotime($education->passing_year)) }}" class="noborder"  title="passingyear" readonly>
                              </td>
                              <td valign="middle" align="center">
                                <a href="javascript:editEducation({{$education_index}})"><i class="fa fa-pencil-square"></i></a>
                                <a href="javascript:deleteRow('education_{{$education_index}}')" title="Delete this detail"><i class="fa fa-trash"></i></a>
                              </td>
                            </tr>
                          @endforeach
                        @else
                          <tr id="education_0">                                     
                                    </tr>     
                            @endif
                              </tbody>
                          </table>
                      </div>
                    </div> 

                    <!-- Education Modal -->
                <div class="modal fade" id="addEducation" role="dialog">
                  <input type="hidden" name="editrowcount_education" id="editrowcount_education" value="">
                    <div class="modal-dialog modal-lg">
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-body login-pad">
                          <div class="pop-title employe-title">
                            <h3>Education Details</h3>
                          </div>
                          <button type="button" class="close modal-close" data-dismiss="modal">
                          <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                        </button>
                          <div class="signup">
                            <div id='systemMessage_education'></div>
                              <div class="emplouyee-form">
                              <input type="text" class="frm_course" name="frm_course" placeholder="Degree/Course (Obtained or Seeking)" />
                              <input type="text" class="frm_university" name="frm_university" placeholder="University/School" />
                              <div id="passingyear-position">
                                <input type="number" maxlength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="frm_passingyear" name="frm_passingyear" placeholder="Year graduated" id="passingyear" autocomplete="off">
                                </div>
                                <span class="error" id="b_year"></span>
                                <button type="button" id="submit_education">SUBMIT</button>
                              </div>
                          </div>
                        </div>
                      </div>
                   </div>
                </div>
                <!-- Education Modal -->

                 </div>
                <button class="upload-pic" id="add_education" type="button">ADD EDUCATION</button>
                </div>
<!--- education end -->
<!-- certificate -->
<h1><div style="border: 2px solid #dad5d599;height: 7px;border-style: inset;margin-bottom: 20px;"></div>
CERTIFICATIONS</h1>
                <div class="signup-block">
                  <div class="row rw-wrp">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                      
                      <p>List your certifications (AED, First Aid, Pediatric Care, CPR, Certified Personal Trainer etc.)</p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                      <span class="user-img" style="overflow:inherit;width: 100;margin-bottom: 20px;padding: 25px 47px;">
                        <i class="fa fa-shield"></i>
                        <a href="#" class="add_sngp" id="add_certificate">+</a>
                      </span>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                          <input type="hidden" name="edited_certificate_id" id="edited_certificate_id" value="">
                          <input type="hidden" name="deleted_certificate_id" id="deleted_certificate_id" value="">
                          <table class="table add_education" id="certificate_table" cellpadding="0" cellspacing="0" border="0">
                              <thead>
                                  <tr>
                                      <th>Name of Certification</th>
                                        <th>Completion Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php $certificates = $UserProfileDetail['certification']; ?>
                            @if(count($certificates) > 0)
                              <?php $certificate_index = 0; ?>
                                @foreach($certificates as $certificate)
                                  <?php $certificate_index++; ?>
                                      <tr id="certificate_{{$certificate_index}}">
                                        <input type="hidden" name="certificate_id[]" value="{{$certificate->id}}">
                                <td valign="middle">
                                  <input type="text" name="certificatetitle[]" value="{{ $certificate->title }}" class="noborder" title="certificatetitle" readonly>
                                </td>
                                <td valign="middle">
                                  <input type="text" name="certificatecompletion[]" value="{{ date('m-d-Y', strtotime($certificate->completion_date)) }}" class="noborder"  title="certificatecompletion" readonly>
                                </td>
                                <td valign="middle" align="center">
                                  <a href="javascript:editCertificate({{$certificate_index}})"><i class="fa fa-pencil-square"></i></a>
                                  <a href="javascript:deleteRow('certificate_{{$certificate_index}}')" title="Delete this detail"><i class="fa fa-trash"></i></a>
                                </td>
                              </tr>
                            @endforeach
                          @else
                            <tr id="certificate_0">                                     
                                      </tr>     
                              @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Modal -->
                <div class="modal fade" id="addCertificate" role="dialog">
                <input type="hidden" name="editrowcount_certificate" id="editrowcount_certificate" value="">
                  <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-body login-pad">
                        <div class="pop-title employe-title">
                          <h3>Certifications</h3>
                        </div>
                        <button type="button" class="close modal-close" data-dismiss="modal">
                        <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                      </button>
                        <div class="signup">
                          <div id='systemMessage_certificate'></div>
                            <div class="emplouyee-form">
                            <input type="text" name="frm_certificatetitle" placeholder="Name of Certification"/>
                            <div id="certificate_completion_date-position">
                            <input type="text" name="frm_certificatecompletion_date" placeholder="Completion Date" class="certificate_completion_date" id="certificate_completion_date"/>
                            </div>
                            
                              <button type="button" id="submit_certificate">SUBMIT</button>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                  </div>
                </div>
<!-- certificate end -->
<!-- skill -->
<h1>
<div style="border: 2px solid #dad5d599;height: 7px;border-style: inset;margin-bottom: 20px;"></div>
SKILLS, ACHIEVMENTS AND AWARDS</h1>
                <div class="signup-block">
                  <div class="row rw-wrp">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
                      
                      <p>List your skills, achievments and awards (gold medalist, black belt, ufc champion, pro kick boxer)</p>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
                      <span class="user-img" style="overflow:inherit;width: 100;margin-bottom: 20px;padding: 25px 47px;">
                        <i class="fa fa-shield"></i>
                        <a href="#" class="add_sngp" id="add_skills" data-toggle="modal" data-target="#myModal11">+</a>
                      </span>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                          <input type="hidden" name="edited_skill_award_id" id="edited_skill_award_id" value="">
                          <input type="hidden" name="deleted_skill_award_id" id="deleted_skill_award_id" value="">
                          <table class="table add_education" id="skillaward_table" cellpadding="0" cellspacing="0" border="0">
                              <thead>
                                  <tr>
                                      <th>Type of Skill,Achievment or Awards</th>
                                      <th>Description</th>
                                        <th>Completion Date</th>
                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php $skillAwards = $UserProfileDetail['skill']; ?>
                            @if(@count(@$skillAwards) > 0)
                              <?php $certificate_index = 0; ?>
                                @foreach($skillAwards as $skillAwards)
                                  <?php $certificate_index++; ?>
                                      <tr id="skillaward_{{$certificate_index}}">
                                        <input type="hidden" name="skillaward_id[]" value="{{$skillAwards->id}}">
                                <td valign="middle">
                                  <input type="text" name="skillawardtype[]" value="{{ $skillAwards->type }}" class="noborder" title="skiilsachievmentsawards" readonly>
                                </td>
                                <td valign="middle">
                                  <input type="text" name="skilldetail[]" value="{{ $skillAwards->skill_detail }}" class="noborder" title="skilldetail" readonly>
                                </td>
                                <td valign="middle">
                                  <input type="text" name="skillawardcompletion[]" value="{{ date('m-d-Y', strtotime($skillAwards->completion_date)) }}" class="noborder"  title="certificatecompletion" readonly>
                                </td>
                                <td valign="middle" align="center">
                                  <a href="javascript:editSkillAward({{$certificate_index}})"><i class="fa fa-pencil-square"></i></a>
                                  <a href="javascript:deleteRow('skillaward_{{$certificate_index}}')" title="Delete this detail"><i class="fa fa-trash"></i></a>
                                </td>
                              </tr>
                            @endforeach
                          @else
                            <tr id="certificate_0">                                     
                                      </tr>     
                              @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Modal -->
                <div class="modal fade" id="addSkills" role="dialog">
                <input type="hidden" name="editrowcount_certificate" id="editrowcount_skills" value="">
                  <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-body login-pad">
                        <div class="pop-title employe-title">
                          <h3>Certifications</h3>
                        </div>
                        <button type="button" class="close modal-close" data-dismiss="modal">
                        <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                      </button>
                        <div class="signup">
                          <div id='systemMessage_certificate'></div>
                            <div class="emplouyee-form">
                            <input type="text" name="frm_certificatetitle" placeholder="Name of Certification"/>
                            <input type="text" name="frm_certificatecompletion" placeholder="Completion Date" id="skillscompletion" readonly/>
                              <button type="button" id="submit_skills">SUBMIT</button>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                  </div>
                </div>

<!-- skill end -->
                 <h1>
                  <div style="border: 2px solid #dad5d599;height: 7px;border-style: inset;margin-bottom: 20px;"></div>
                  <p style="color: red">YOU’RE ALMOST DONE:</p>
                  SET YOUR BUSINESS SERVICES AND PRICES
                </h1>
                <div class="signup-block signup-block1">
                  <h3>What service or activity do you offer your clients?</h3>
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center service-icon">
                      <span class="user-img" style="overflow:inherit;">
                      <i class="fa fa-briefcase"></i>
                      <a href="#" class="add_sngp" id="add_service">+</a>
                      </span>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 text-left ">
                      <p>This last section is where you will describe your programs, place images, description, prices, taxes, terms and conditions, contracts, one-time payments, recurring payment, sessions, create tours, and more.<br>Make sure your prices are competitive to your skill level. Add an attractive description and images that best represents your program. </p>
                    </div>
                  </div>
                </div>
                <!--ALMOST DONE end -->
                
                <div class="services-block">
                  <div class="row" id="service_div">                      
                      @if(@count($myservice) > 0)
                        <?php $service_index = 0; ?>
                        @foreach($myservice as $serv)
                          <?php $service_index++; ?>
                          <div id="service_{{$service_index}}">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="services-list">
                              <a href="javascript:editService({{$serv->id}})" class="decoration-none">
                                <span class="brfcse"><i class="fa fa-briefcase"></i></span>
                              </a>
                              <div class="clearfix"></div>
                              <h3>
                                <input type="hidden" name="servicesport[]" value="{{ $serv->sport }}" title="servicesport">
                                <!-- <a href="javascript:editService({{$serv->id}})" class="decoration-none"> -->
                                  <span class="display_servicesport" style="padding-left: 30px;"> {{ @$sport_dd[$serv->sport] }} </span>
                                <!-- </a> -->
                                <!-- javascript:deleteRow('service_{{$service_index}}') -->
                                <a href="#" onclick="return false" class="delete_icon dlt"  disabled title="Delete this Service"><i class="fa fa-trash"></i></a>

                                <a href="javascript:editService({{$serv->id}})" title="Edit this Service" class="delete_icon"  style="padding-right: 7px;"><i class="fa fa-pencil"></i></a>
                              </h3>
                              <div class="clearfix"></div>
                              <input type="hidden" name="servicetitle[]" value="{{ $serv->title }}" title="servicetitle">

                              <p class="display_servicetitle"><strong> {{ $serv->title }} ({{ $serv->price }})</strong></p>
                              <div class="clearfix"></div>
                              <input type="hidden" name="serviceprice[]" value="{{ $serv->price }}" title="serviceprice">
                              <div class="clearfix"></div>
                              <input type="hidden" name="servicedesc[]" value="{{ $serv->servicedesc }}" title="servicedesc">
                              <p class="display_servicedesc">{{ substr($serv->servicedesc, 0,50) }}...</p>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      @endif                    
                  </div>
                </div>

              </div>
            </div>
          </div>
          <!-- END tab ten -->
          <!-- Circles which indicates the steps of the form: -->
          <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
          </div>
          <!-- add for multi step form -->
          <div class="bcknext-btn">
            <div style="float:left;">
              <button type="button" class="button-nxt button-next" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
            </div>
            <div style="float:right;">
              <button type="button"  class="button-nxt button-next" id="nextBtn" onclick="nextPrev(1)">Next</button>
            </div>
          </div>
          
          <!-- END - - add for multi step form -->
          <div class="step-block1 back-prfl">
            <a class="back-profile" href="/profile/viewProfile"><i class="fa fa-angle-double-left"></i> Back to Profile</a>
            <!--<button type="submit" class="button-nxt button-next">Save & Continue<i class="fa fa-angle-double-right"></i></button>-->
          </div>
      </div>
      </form>
      <?php /*   
      <div class="modal fade" id="addService" role="dialog">
        <form method="post" enctype="multipart/form-data" id="servicedata">
          <input type="hidden" name="_token" value="{{csrf_token()}}"> 
          <input type="hidden" name="editrowcount_service" id="editrowcount_service" value="">
          <input type="hidden" name="editservice_id" id="editservice_id" value="">
          <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-body login-pad">
                <div class="pop-title employe-title">
                  <h3>Services</h3>
                </div>
                <button type="button" class="close modal-close" data-dismiss="modal">
                <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                </button>
                <div class="signup">
                  <div id='systemMessage_service'></div>
                  <div class="emplouyee-form">
                    <div class="select-style review-select2">
                      <select name="frm_servicesport" id="frm_servicesport" class="selectpicker">
                        @if(isset($sports_select) && !empty($sports_select))
                        {!! $sports_select !!}
                        @endif
                      </select>
                    </div>
                    <input type="text" name="frm_servicetitle" id="frm_servicetitle" placeholder="Name of Program" title="servicetitle" value="" style="margin-top: 0px;margin-bottom: 2px;"/>
                    <div class="multiples">
                      <label>Choose Provider Type</label> 
                      <select name="frm_servicetype[]" id="categ" multiple>
                        @if(isset($businessType) && !empty($businessType))
                        @foreach ($businessType as $bkey => $bval)
                        <?php 
                        $servicetype = json_decode($service['servicetype'],true); 
                        ?> 
                        <option value='{{$bkey}}' @if(@in_array($bkey,$servicetype)) selected @endif> {{$bval->type}}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="multiples">
                     <label>Activity Designed For</label>
                      <select name="activitydesignsfor[]" id="activitydesigned" multiple>
                          @if(isset($activity) && !empty($activity))
                          @foreach ($activity as $pkey => $pval)
                          <?php $pkey = str_replace(' ','_',strtolower($pkey)); 
                          $activitydesignsfor = json_decode($service['activitydesignsfor'],true);
                          ?>
                        <option value='{{$pkey}}'  @if(@in_array($pkey,$activitydesignsfor)) selected @endif> {{$pval}}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="multiples">
                      <label>Choose Activity Type </label>
                      <select name="activitytype[]" id="activitytype" multiple>
                          @if(isset($programType) && !empty($programType))
                          @foreach ($programType as $pkey => $pval)
                         <?php $pkey = str_replace(' ','_',strtolower($pkey)); 
                         $activitytype = json_decode($service['activitytype'],true);?>
                        <option value='{{$pkey}}' @if(@in_array($pkey,$activitytype)) selected @endif> {{$pval}}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="multiples">
                      <label>Age Range</label>
                      <select name="frm_agerange[]" id="frm_agerange" multiple>
                        @foreach ($ageRange as $arkey => $arval)
                         <?php $arkey = str_replace(' ','_',strtolower($arkey)); 
                         $agerange = json_decode($service['agerange'],true);
                         ?>
                        <option value='{{$arkey}}' @if(@in_array($arkey,$agerange)) selected @endif> {{$arval}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="multiples">
                      <label>Activity For?</label>
                      <select name="frm_programfor[]" id="frm_programfor" multiple>
                        @if(isset($service) && !empty($service))
                          @foreach ($programFor as $pfkey => $pfval)
                         <?php $pfkey = str_replace(' ','_',strtolower($pfkey));
                         $programfor = json_decode($service['programfor'],true);
                          ?>
                        <option value='{{$pfkey}}' @if(@in_array($pfkey,$programfor)) selected @endif> {{$pfval}}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="multiples">
                      <label>Participates Number</label>
                      <select name="frm_numberofpeople[]" id="frm_numberofpeople" multiple>
                        @if(isset($service) && !empty($service))
                          @foreach ($numberOfPeople as $npkey => $npval)
                         <?php $npkey = str_replace(' ','_',strtolower($npkey)); 
                         $numberofpeople = json_decode($service['numberofpeople'],true);
                         ?>
                        <option value='{{$npkey}}' @if(@in_array($npkey,$numberofpeople)) selected @endif> {{$npval}}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="multiples">
                      <label>Program Experience Level</label>
                      <select name="frm_experience_level[]" id="frm_experience_level" multiple>
                        @if(isset($service) && !empty($service))
                          @foreach ($expLevel as $elkey => $elval)
                         <?php 
                         $experience_level = json_decode($service['experience_level'],true);
                         ?>
                        <option value='{{$elkey}}' @if(@in_array($elkey,$experience_level)) selected @endif> {{$elval}}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="multiples">
                      <label>Teaching Style</label>
                      <select name="frm_teachingstyle[]" id="teaching" multiple>
                        @if(isset($service) && !empty($service))
                          @foreach ($teaching as $elkey => $elval)
                         <?php 
                         $frm_teachingstyle = json_decode($service['frm_teachingstyle'],true);
                         ?>
                        <option value='{{$elkey}}' @if(@in_array($elkey,$frm_teachingstyle)) selected @endif> {{$elval}}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="multiples">
                      <label>Activity Location</label>
                      <select name="frm_servicelocation[]" id="frm_servicelocation" multiple>
                        @if(isset($service) && !empty($service))
                          @foreach ($serviceLocation as $slkey => $slval)
                        <?php $slkey = str_replace(' ','_',strtolower($slkey));
                         $servicelocation = json_decode($service['servicelocation'],true);
                         ?>
                        <option value='{{$slkey}}' @if(@in_array($slkey,$servicelocation)) selected @endif>{{$slval}}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="multiples">
                      <label>Activity Experience</label>
                      <select name="frm_servicefocuses[]" id="frm_servicefocuses" multiple>
                        @if(isset($service) && !empty($service))
                          @foreach ($pFocuses as $pfkey => $pfval)
                          <?php $pfkey = str_replace(' ','_',strtolower($pfkey)); 
                          $focuses = json_decode($service['focuses'],true);
                          ?>
                        <option value='{{$pfkey}}' @if(@in_array($pfkey,$focuses)) selected @endif> {{$pfval}}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                    <div>
                      
                      </div>
                    <div class="multiples"><br>
                      <h3>Set Up Your Pricing </h3>
                       
                      <label>Is this an special offer or a promotion</label>
                      <br>
                        <label class="setupprice">
                              <input type="radio" value="1" class="chkdy offpro" name="setupprice" autocomplete="off" @if($service['setupprice'] == 1) checked @endif>
                              <span class="promo">Yes</span>
                        </label>
                        <label class="setupprice">
                            <input type="radio" value="0" class="chkdy offpro" name="setupprice" autocomplete="off" @if($service['setupprice'] == 0) checked @endif>
                            <span class="promo">No</span>
                        </label>
                    </div>
                    <div class="multiples" id="offprom_option" style="display: none;" >
                        <select name="frm_specialdeals[]" id="frm_specialdeals" multiple>
                        @foreach ($specialDeals as $pfkey => $pfval)
                          <option value='{{$pfkey}}'> {{$pfval}}</option>
                        @endforeach
                        </select>
                    </div>
                    
                    <div class="multiples">
                    <label>Service Price Options</label>
                      <select name="frm_servicepriceoption[]" id="frm_servicepriceoption" multiple>
                        @if(isset($service) && !empty($service))
                          @foreach ($servicePriceOption as $pfkey => $pfval)
                          <?php $pfkey = str_replace(' ','_',strtolower($pfkey)); 
                          $servicepriceoption =json_decode($service['servicepriceoption'],true);
                          ?>
                        <option value='{{$pfkey}}' @if(@in_array($pfkey,$servicepriceoption)) selected @endif> {{$pfval}}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                    <div class="multiples">
                    <label>Duration</label>
                      <select name="frm_serviceduration" id="duration" >
                        @if(isset($service) && !empty($service))
                          @foreach ($duration as $pfkey => $pfval)
                          <?php $pfkey = str_replace(' ','_',strtolower($pfkey)); 
                          $durations =$service['duration'];
                          ?>
                        <option value='{{$pfkey}}' @if($pfkey==$durations) selected @endif> {{$pfval}}</option>
                        @endforeach
                        @endif
                      </select>
                    </div>
                  </div>
                  {{--  additional option  --}}
                   <div id="taxmsg" style="display:none"></div>
                    <div class="row hrsam">
                     <div class="col-md-3"><h2 class="additionheading">Tax</h2></div>
                    <div class="col-md-9">
                   
                      <div class="col-md-3 col-sm-3 col-xs-3 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary percentageckeck  @if($service['salestax'] == 'salestax') active @endif">
                              <input type="checkbox"  value="salestax" class="" name="salestax" @if($service['salestax'] == 'salestax') checked @endif autocomplete="off">
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              Sales Tax
                            </div>
                          </div>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-3 qh-steps-form samm" id="salestaxpercentage" @if($service['salestax'] == '') style="display:none" @endif >
                          <div class="form-control">
                              <input type="text" value="{{$service['salestaxpercentage']}}" name="salestaxpercentage" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="percentage">
                              %
                          </div>
                      </div>
                    <div class="col-md-3 col-sm-3 col-xs-3 qh-steps-form samm">
                    <div class="form-control">
                        <div class="btn-group" data-toggle="buttons">
                          <label class="btn btn-primary percentageckeck">
                          <input type="checkbox" value="duestax" class="" name="duestax" >
                          <span class="glyphicon glyphicon-ok"></span> </label>
                          Dues Tax
                      </div>
                      </div>
                      <div class="col-md-3 col-sm-3 col-xs-3 qh-steps-form samm" id="duestaxpercentage" style="display:none">
                          <div class="form-control">
                              <input type="text" value="{{$service['duestaxpercentage']}}" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="duestaxpercentage" class="percentage">
                            %
                          </div>
                      </div>
                    </div>
                    </div>
                    </div>
                  <div class="row hrsam">
                    <div class="col-md-3">
                        <h2 class="additionheading">Expires</h2>
                    </div>
                    <div class="col-md-9">
                    <div id="setnumbermsg" style="display:none"></div>
                      <div class="col-md-2 pd-0">
                        <label>Set Number</label>
                        <input type="text" class="form-control setnumber" maxlength="3" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="expire_days" value="{{$service['expire_days']}}">
                      </div>
                      <div class="col-md-3 pd-0">
                      <label>Duration</label>
                            <select name="expire_in_option" class="form-control" >
                                <option @if($service['expire_in_option'] == 'Minute') selected @endif value="Minute">Minute</option>
                                <option @if($service['expire_in_option'] == 'Hour') selected @endif value="Hour">Hour</option>
                                <option @if($service['expire_in_option'] == 'Day') selected @endif value="Day">Day</option>
                                <option @if($service['expire_in_option'] == 'Weeks') selected @endif value="Weeks">Weeks</option>
                                <option @if($service['expire_in_option'] == 'Months') selected @endif value="Months">Months(s)</option>
                                <option @if($service['expire_in_option'] == 'Year') selected @endif value="Year">Year</option>
                            </select>
                      </div>
                      <div class="col-md-4 pd-0">
                          <label>When will client be charged?</label>
                            <select name="expire_in_option2" class="form-control" id="duration" >
                                <option @if($service['expire_in_option2'] == '1') selected @endif value="1">Immediately</option>
                                <option @if($service['expire_in_option2'] == '2') selected @endif value="2">I confirm booking with client</option> 
                                <option @if($service['expire_in_option2'] == '3') selected @endif value="3">After client participates in the activity</option>
                            </select>
                      </div>
                    </div>
                  </div>
                  <div class="row hrsam m-1">
                    <div class="col-md-3">
                        <h2 class="additionheading">Number of Sessions</h2>
                    </div> <!-- col-md-3 -->
                    <div class="col-md-9">
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary multises @if($service['sessions'] == 'single') active @endif">
                              <input type="radio" value="single" class="chkdy" name="sessions" autocomplete="off" @if($service['sessions'] == 'single') checked @endif>
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              Single Session
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary multises @if($service['sessions'] == 'multiple') active @endif">
                              <input type="radio" value="multiple" class="chkdy" @if($service['sessions'] == 'multiple') checked @endif name="sessions" autocomplete="off" >
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              Multiple Sessions
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6 qh-steps-form samm" id="multisession" style="text-align: initial; @if($service['sessions'] != 'multiple') display:none @endif">
                        <input type="text" name="multiple_count" value="{{$service['multiple_count']}}" class="msesinput">
                        </div>
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary multises @if($service['sessions'] == 'unlimited') active @endif">
                              <input type="radio" value="99999" class="chkdy" name="sessions" autocomplete="off" @if($service['sessions'] == 'unlimited') checked @endif>
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              Unlimited Sessions
                            </div>
                          </div>
                        </div>
                    </div><!--col-md-9 -->
                  </div> <!-- row end -->

                  <div class="row hrsam">
                    <div class="col-md-3">
                      <h2 class="additionheading">Is this an recurring payment?</h2>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary recurring_pay @if($service['recurring_pay'] == 1) active @endif">
                              <input type="radio" value="1" class="chkdy" @if($service['recurring_pay'] == 1) checked @endif name="recurring_pay" autocomplete="off">
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              Yes
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary recurring_pay @if($service['recurring_pay'] == 0) active @endif">
                              <input type="radio" value="0" class="chkdy" @if($service['recurring_pay'] == 0) checked @endif name="recurring_pay" autocomplete="off" >
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              No
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                <div @if($service['recurring_pay'] == 0) style="display:none" @endif id="recurring_pay">  
                  <div class="row">
                    <div class="col-md-3">
                      <h2 class="additionheading">Is this an Intro offer? (limit of 1 per client)</h2>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary @if($service['introoffer'] == 0) active @endif">
                              <input type="radio" value="0" class="chkdy" name="introoffer" autocomplete="off" @if($service['introoffer'] == 0) checked  @endif>
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              no
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary @if($service['introoffer'] == 1) active @endif">
                              <input type="radio" value="1" class="chkdy" name="introoffer" autocomplete="off" @if($service['introoffer'] == 1) checked @endif >
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              Yes, for new clinets only
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary @if($service['introoffer'] == 2) active @endif">
                              <input type="radio" value="2" class="chkdy" name="introoffer" autocomplete="off" @if($service['introoffer'] ==2) checked @endif >
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              Yes, for new and existing clinets
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="row" >
                    <div class="col-md-3">
                      <h2 class="additionheading">Run autopay</h2>
                    </div>
                    <div class="col-md-9">
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary @if($service['runautopay'] == 'on_a_set_schedule') active @endif">
                              <input type="radio" value="on_a_set_schedule" class="chkdy" name="runautopay" autocomplete="off"@if($service['runautopay'] == 'on_a_set_schedule') checked @endif >
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              On a set Schedule (recommended)
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary @if($service['runautopay'] == 'when_the_priceing') active @endif">
                              <input type="radio" value="when_the_priceing" class="chkdy" name="runautopay" autocomplete="off"@if($service['runautopay'] == 'when_the_priceing') checked @endif >
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              When the Priceing option run out
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>

<!-- autopay-->
              <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-3">
                      <h2 class="additionheading">how often will clients be charged?</h2>
                    </div>
                     <div class="col-md-9">
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary myautopay ">
                              <input type="radio" value="0" class="chkdy" name="often" autocomplete="off">
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              Set of number of autopay
                            </div>
                          </div>
                        </div>  
                     <div id="myautopaynum" style="display:none;width: auto; padding: 0;">
                    <div class="col-md-4 often" style="width: auto; padding: 0;">
                        <span>Number of autopay</span>
                    </div>
                    <div class="col-md-8 often">
                      <input type="number" class="form-control" name="numberofpays" style="border:1px solid;" value="{{$service['numberofpays']}}">
                      <span>Total duration of contract : 12 months</span>
                    </div>
                    </div>

                    <div class="col-md-12 qh-steps-form samm">
                      <div class="form-control">
                        <div class="btn-group" data-toggle="buttons">
                          <label class="btn btn-primary myautopay ">
                          <input type="radio" value="1" class="chkdy" name="often" autocomplete="off">
                          <span class="glyphicon glyphicon-ok"></span> </label>
                          Month to month
                        </div>
                      </div>
                    </div>
                    <div id="monthtomonth" style="display:none">
                        <div class="col-md-3 often" style="width: auto;">
                          <p>Every</p>
                        </div>
                        <div class="col-md-3 often">
                          <select name="often_every_op1" class="form-control">
                             <option  @if($service['often_every_op1'] == 1) selected @endif value="1">1</option>
                             <option  @if($service['often_every_op1'] == 2) selected @endif value="2">2</option>
                             <option  @if($service['often_every_op1'] == 3) selected @endif value="3">3</option>
                             <option  @if($service['often_every_op1'] == 4) selected @endif value="4">4</option>
                             <option  @if($service['often_every_op1'] == 5) selected @endif value="5">5</option>
                             <option  @if($service['often_every_op1'] == 6) selected @endif value="6">6</option>
                             </select>
                        </div>
                        <div class="col-md-3 often">
                             <select name="often_every_op2" class="form-control">
                                  <option  @if($service['often_every_op2'] == 'Minute') selected @endif value="Minute">Minute</option>
                                  <option  @if($service['often_every_op2'] == 'Hour') selected @endif value="Hour">Hour</option>
                                  <option  @if($service['often_every_op2'] == 'Day') selected @endif value="Day">Day</option>
                                  <option  @if($service['often_every_op2'] == 'Weeks') selected @endif value="Weeks">Weeks</option>
                                  <option  @if($service['often_every_op2'] == 'Months') selected @endif value="Months">Months(s)</option>
                                  <option  @if($service['often_every_op2'] == 'Year') selected @endif value="Year">Year</option>
                             </select>
                        </div>
                        </div>
                      </div>    
              </div>
<!-- autopay end-->

                  <div class="row">
                    <div class="col-md-3">
                    <h2 class="additionheading">when will clients be charged?</h2>
                    </div>
                    <div class="col-md-6">
                    <?php
                    $op = array("on the sale date"=>"on the sale date",
"1st of the month"=>"1st of the month",
"15th of the month"=>"15th of the month",
"Last day of the month"=>"Last day of the month",
"1st of 15th of the month"=>"1st of 15th of the month",
"1st of 16th of the month"=>"1st of 16th of the month",
"15th of last day of the month"=>"15th of last day of the month",
"Specific date"=>"Specific date");
                    ?>
                     <select name="chargeclients" class="form-control">
                            @foreach ($op as $key=>$val)
                                <?php $key = str_replace(' ','_',strtolower($key)); 
                                
                                ?>
                                <option value="{{$key}}" @if($service['chargeclients'] == $key) selected @endif>{{$val}}</option>
                            @endforeach
                             </select>
                    </div>
                  </div>


                  </div> <!-- hide and show-->
                  <div class="row hrsam">
                  <h3 class="setterms">Set Your Terms</h3>
                  <p style="padding-left: 17px; font-weight: 600;">Covid – 19 Protocols</p>
                  <p style="text-align: initial;padding-left: 17px;">Select the section you require your clients to agree to upon completing registration.</p>
                    <div class="col-md-3">
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary termcondfaq @if($service['termcondfaq'] == 1) active @endif">
                              <input type="checkbox" value="1" class="chkdy" name="termcondfaq" @if($service['termcondfaq'] == 1) checked @endif autocomplete="off" >
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              Terms, Conditions, FAQ
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 textsam" id="termfaq" @if($service['termcondfaq'] != 1) style="display:none" @endif>
                      <textarea type="number" class="form-control" name="termcondfaqtext"> {{$service['terms_conditions']}}</textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary contractterms @if($service['contractterms'] == 1) active @endif">
                              <input type="checkbox" value="1" class="chkdy" name="contractterms" @if($service['contractterms'] == 1) checked @endif autocomplete="off" >
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              Contract Terms
                              <a href="#" class="tooltip-custom" data-toggle="tooltip" data-placement="top" title="Incase, no contract please enter NA">?</a>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 textsam" id="contractterms" @if($service['contractterms'] != 1) style="display:none" @endif>
                      <textarea type="number" class="form-control" name="contracttermstext"> {{$service['contracttermstext']}}</textarea>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-3">
                        <div class="col-md-12 qh-steps-form samm">
                          <div class="form-control">
                            <div class="btn-group" data-toggle="buttons">
                              <label class="btn btn-primary liability @if($service['liability'] == 1) active @endif">
                              <input type="checkbox" value="1" class="chkdy" name="liability" @if($service['liability'] == 1) checked @endif autocomplete="off" >
                              <span class="glyphicon glyphicon-ok"></span> </label>
                              Liability
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-md-6 textsam" id="liability" @if($service['liability'] != 1) style="display:none" @endif>
                      <textarea type="number" class="form-control" name="liabilitytext"> {{$service['liabilitytext']}}</textarea>
                    </div>
                  </div>
                  {{--  additional option  --}}
                 <div class="emplouyee-form hrsam" style="width: 95%;">
                    <div class="row" style="margin-left: -21px;">
                      <div class="emplouyee-form" style="width: 95%;">
                        <p> <b>Upload an image that best represents your program.</b><br>
                          (Uploading a professional image of your program will appear on your profile and increase your chances of being picked by customers.)
                        </p>
                        <input type="hidden" name="old_profile_pic" id="old_profile_pic" title="old_profile_pic">
                        <input type="hidden" name="updated_profile_pic" id="updated_profile_pic" title="updated_profile_pic">
                        <input class="upload-pic" type="file" name="frm_profile_pic" id="frm_profile_pic" class="form-control" title="profile_pic" value="{{ old('image') }}" onchange="readURL(this)" style="width:89%;">
                        <br>
                        <font style="color:red">@if ($errors->has('profile_pic')) {{$errors->first('profile_pic')}} @endif</font>
                        <span class="user-img uploadedpic" style="margin-left: 13px;width: 75px;height: 75px"><i class="fa fa-user" style="line-height: 56px;"></i></span>
                      </div>
                    </div>
                    <input type="text" name="frm_serviceprice" id="frm_serviceprice" value="$"/ title="serviceprice" style="margin-top: 15px;">
                    <textarea name="frm_servicedesc" id="frm_servicedesc" placeholder="Program Description"></textarea>
                    <button type="submit" id="submit_service">SUBMIT</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
      */ ?>  
      <!-- step 1 ends -->
      @include('includes.sidebar_signup')
    </div>
  </div>
</div>
</div>

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
    function no_backspaces(event)
            {
                backspace = 8;
                if (event.keyCode == backspace) event.preventDefault();
            }
</script>
<script>
  $(document).ready(function() {
    $("#verfy_check").click(function() {
          $.ajax({
          url:'/evident',
          type:'get',
          beforeSend: function () {
             $('.loader').show();
           },
           complete: function () {
             $('.loader').hide();
           },
          success: function (response) { 
            $('#addService').html(response);
            $('#addService').modal('show');
            }
        });
            //$('#addService').modal('show');
          });
  var x = new SlimSelect({
    select: '#train_to'
  });
  var  p= new SlimSelect({
    select: '#testdemo'
  });
  var  pp2= new SlimSelect({
    select: '#frm_servicefocuses'
  });
  
  var  pp= new SlimSelect({
    select: '#where_choose'
  });
  var  u= new SlimSelect({
    select: '#mcc'
  });
  var  activitydesigned= new SlimSelect({
    select: '#activitydesigned'
  });
  var  personality= new SlimSelect({
    select: '#personality'
  });
  var  personality_type= new SlimSelect({
    select: '#personality_type'
  });
  var  skill= new SlimSelect({
    select: '#skill'
  });
  var  fitness_goals_array= new SlimSelect({
    select: '#fitness_goals_array'
  });
  var  frm_servicelocation= new SlimSelect({
    select: '#frm_servicelocation'
  });
  var  teaching= new SlimSelect({
    select: '#teaching'
  });
  var  frm_experience_level= new SlimSelect({
    select: '#frm_experience_level'
  });
  var  frm_numberofpeople= new SlimSelect({
    select: '#frm_numberofpeople'
  });
  var  frm_programfor= new SlimSelect({
    select: '#frm_programfor'
  });
  var  frm_agerange= new SlimSelect({
    select: '#frm_agerange'
  });
  var  categ= new SlimSelect({
    select: '#categ'
  });
  var  activitytype= new SlimSelect({
    select: '#activitytype'
  });
  var  duration= new SlimSelect({
    select: '#duration'
  });
  var  frm_servicepriceoption= new SlimSelect({
    select: '#frm_servicepriceoption'
  });
  var  frm_specialdeals= new SlimSelect({
    select: '#frm_specialdeals'
  });
$('.percentage').keyup(function(){
var val =parseInt($(this).val());
if($.isNumeric(val)){
if(val>100 ){
$(this).val('');
$('#taxmsg').text('Please enter the value less than 100').show();
setTimeout(function(){ $('#taxmsg').hide() }, 3000);
return false;
}
}else{
  $(this).val('');
$('#taxmsg').text('Please enter only numbers').show();
setTimeout(function(){ $('#taxmsg').hide() }, 3000);
}

});
$('.setnumber').keyup(function(){
  var val =parseInt($(this).val());
if($.isNumeric(val)){
if(val>100 ){
$(this).val('');
$('#setnumbermsg').text('Please enter the value less than 100').show();
setTimeout(function(){ $('#setnumbermsg').hide() }, 3000);
}
}else{
  $(this).val('');
$('#setnumbermsg').text('Please enter only numbers').show();
setTimeout(function(){ $('#setnumbermsg').hide() }, 3000);
}
});
  $(".myautopay").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=radio]').val();
        if(willing_to_travel_radio == 0){
          $('#myautopaynum').show();
            $('#monthtomonth').hide();
        } else {
        $('#monthtomonth').show();
            $('#myautopaynum').hide();
        }
      });
  });
      $(document).ready(function(){
        $('.bsunstarttimepicker').timepicker({
            timeFormat: 'h:mm p',
           // minTime: '2:00 AM',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                //console.log(time)
                var newt = moment(time,'hh:mm A').add(30, 'minutes').format('hh:mm A');
                $('.bsunendtimepicker').timepicker('destroy')
                $('.bsunendtimepicker').timepicker({
                timeFormat: 'h:mm p',
                minTime: newt,
                interval: 30, 
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
            });  
            }
        });  
          
          $('.bsunendtimepicker').timepicker({
            timeFormat: 'h:mm p',
          // minTime: '2:00 AM',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
        
        $('.bmonstarttimepicker').timepicker({
            timeFormat: 'h:mm p',
           // minTime: '2:00 AM',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                //console.log(time)
                var newt = moment(time,'hh:mm A').add(30, 'minutes').format('hh:mm A');
                $('.bmonendtimepicker').timepicker('destroy')
                $('.bmonendtimepicker').timepicker({
                timeFormat: 'h:mm p',
                minTime: newt,
                interval: 30, 
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
            });  
            }
        });  
          
          $('.bmonendtimepicker').timepicker({
            timeFormat: 'h:mm p',
          // minTime: '2:00 AM',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
        
        $('.btuesstarttimepicker').timepicker({
            timeFormat: 'h:mm p',
           // minTime: '2:00 AM',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                //console.log(time)
                var newt = moment(time,'hh:mm A').add(30, 'minutes').format('hh:mm A');
                $('.btuesendtimepicker').timepicker('destroy')
                $('.btuesendtimepicker').timepicker({
                timeFormat: 'h:mm p',
                minTime: newt,
                interval: 30, 
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
            });  
            }
        });  
          
          $('.btuesendtimepicker').timepicker({
            timeFormat: 'h:mm p',
          // minTime: '2:00 AM',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
        $('.bwedstarttimepicker').timepicker({
            timeFormat: 'h:mm p',
           // minTime: '2:00 AM',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                //console.log(time)
                var newt = moment(time,'hh:mm A').add(30, 'minutes').format('hh:mm A');
                $('.bwedendtimepicker').timepicker('destroy')
                $('.bwedendtimepicker').timepicker({
                timeFormat: 'h:mm p',
                minTime: newt,
                interval: 30, 
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
            });  
            }
        });  
          
          $('.bwedendtimepicker').timepicker({
            timeFormat: 'h:mm p',
          // minTime: '2:00 AM',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
         $('.bthrusstarttimepicker').timepicker({
            timeFormat: 'h:mm p',
           // minTime: '2:00 AM',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                //console.log(time)
                var newt = moment(time,'hh:mm A').add(30, 'minutes').format('hh:mm A');
                $('.bthrusendtimepicker').timepicker('destroy')
                $('.bthrusendtimepicker').timepicker({
                timeFormat: 'h:mm p',
                minTime: newt,
                interval: 30, 
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
            });  
            }
        });  
          
          $('.bthrusendtimepicker').timepicker({
            timeFormat: 'h:mm p',
          // minTime: '2:00 AM',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        }); 
        $('.bfristarttimepicker').timepicker({
            timeFormat: 'h:mm p',
           // minTime: '2:00 AM',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                //console.log(time)
                var newt = moment(time,'hh:mm A').add(30, 'minutes').format('hh:mm A');
                $('.bfriendtimepicker').timepicker('destroy')
                $('.bfriendtimepicker').timepicker({
                timeFormat: 'h:mm p',
                minTime: newt,
                interval: 30, 
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
            });  
            }
        });  
          
          $('.bfriendtimepicker').timepicker({
            timeFormat: 'h:mm p',
          // minTime: '2:00 AM',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
        $('.bsatstarttimepicker').timepicker({
            timeFormat: 'h:mm p',
           // minTime: '2:00 AM',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true,
            change: function(time){
                //console.log(time)
                var newt = moment(time,'hh:mm A').add(30, 'minutes').format('hh:mm A');
                $('.bsatendtimepicker').timepicker('destroy')
                $('.bsatendtimepicker').timepicker({
                timeFormat: 'h:mm p',
                minTime: newt,
                interval: 30, 
                startTime: '00:00',
                dynamic: true,
                dropdown: true,
                scrollbar: true,
            });  
            }
        });  
          
          $('.bsatendtimepicker').timepicker({
            timeFormat: 'h:mm p',
          // minTime: '2:00 AM',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
        
      $('.timepicker').timepicker({
            timeFormat: 'h:mm p',
            //minTime: '2:00 AM',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
  
    /* $('.business_hour_type').on('change','input[name="business_hour_type"]:checked',function(){
      var t = $(this).val();
      if(t==0){
        $('#hourshow').show();
      }else{
  $('#hourshow').hide();
      }
    });  */
  
    function options_f(len,id){
      $('#'+id).empty();
      for (i = 1; i <= len ; i++) {
        $('#'+id).append('<option value="'+i+'">'+i+'</option>');
      }
    }
  
    $('#secdayweek').change(function(){
      var t = $('#secdayweek option:selected').val();
      var id = $('#secdayweek').attr('rel');
      console.log(t,"---",id)
      if(t=='Days'){
        options_f(31,id);
      }
      if(t=='Weeks'){
        options_f(52,id);
      }
      if(t=='Months'){
        options_f(12,id);
      }
    });
    $('#firstdayweek').change(function(){
      var t = $('#firstdayweek option:selected').val();
      var id = $('#firstdayweek').attr('rel');
      console.log(t,"---",id)
      if(t=='Days'){
        options_f(31,id);
      }
      if(t=='Weeks'){
        options_f(52,id);
      }
      if(t=='Months'){
        options_f(12,id);
      }
    });
    
    $('#testdemo').change(function(){
        //console.log("called");
        //console.log()
    })
  
    $('[type="search"]').keyup(function(){
      var t = $('[type="search"]').val();
      
    //   $.ajax({
    //       url: "/getlanguage",
    //       type: "post",
    //       data: { lang : t },
    //   headers: {
    //       'X-CSRF-TOKEN': '{{csrf_token()}}'
    //   },
    //       success: function(data){
    //     //alert(JSON.stringify(data));
    //     var myArray = $.map(data, function(element) {        
    //       return '<option value="'+element.name+'">'+element.name+'</option>';
    //       });
    //           $("#testdemo").html(myArray);
    //       }
    //   });
  }); 
  

  $(document).on('click','.rounded-corner',function(){
      console.log("runrun")
     console.log($(this).attr('date'))
     $('#mdp-demo').multiDatesPicker('toggleDate', moment($(this).attr('date'),'MM/DD/YYYY').format('MM/DD/YYYY'));
     $(this).remove()
  })
  
  var d = "{{ (isset($ProfessionalDetail->special_days_off)) ? $ProfessionalDetail->special_days_off : '' }}"
  console.log("d "+d)
  var date_arr = d.split(',')
  console.log(date_arr)
  var new_date_arr = []
  date_arr.forEach(function(value,key){
      if(value != '')
      new_date_arr.push(moment(value,'MM/DD/YYYY').format('MM/DD/YYYY'))
  })
      $('#mdp-demo').multiDatesPicker();
      	if(new_date_arr.length !=0){
      $('#mdp-demo').multiDatesPicker({
        	separator: ", ",
        //addDates: [date.setDate(11/14/2020), date.setDate(11/19/2020)]
        	addDates: new_date_arr,
        	onSelect: function(dateText, inst) { var j; $('.rounded-corner').each(function(i, obj) {
        	    console.log($(this))
    if($(this).text() == dateText+' x'){
        console.log("if")
        $(this).click()
    }
}); $('.manual-remove').append('<button type="button" date="'+dateText+'" class="rounded-corner">'+dateText+' x</button>') } 
        });
      	}
      	else{
      	     $('#mdp-demo').multiDatesPicker({
        	separator: ", ",
        	onSelect: function(dateText, inst) { $('.rounded-corner').each(function(i, obj) {
        	    console.log($(this))
    if($(this).text() == dateText+' x'){
        console.log("if")
         $(this).click()
    }
}); $('.manual-remove').append('<button type="button" date="'+dateText+'" class="rounded-corner">'+dateText+' x</button>') } 
        });
      	}
        setTimeout(function(){
          //  $('#mdp-demo').multiDatesPicker('value', '2/19/1985, 11/14/2009');
        },1000)
        
      $('#markcalendar').click(function() {
          $("#mdp-demo").focus();
        });
  
  
  
        $(".singup_steps").hide();
        $("#singup_step_1").show();
          $("#frm_serviceprice").keydown(function(e) {
              var field=this;
              setTimeout(function () {
                  if(field.value.indexOf('$') !== 0) {
                      $(field).val('$');
                  } 
              }, 1);
          });
  
        /*** employment history form process - starts ***/
  
        $("#addEmployementHistory").on("hidden.bs.modal", function(){
              removeFormValues('addEmployementHistory');
          });
  
        // open employement history form 
          $("#add_sngp").click(function() {
            $('#addEmployementHistory').modal('show');
          });       
  
  
          // save employement history form
          $("#submit_employement_history").click(function() {
  
            // check validations
            if(!validateFormEmploymentHistory()) {
              return false;
            }
            var token = '{{csrf_token()}}';
            var inputdata1 = new FormData();
            inputdata1.append("organization",$("input:text[name='frm_organization']").val())
            inputdata1.append("position",$("input:text[name='frm_position']").val())
            inputdata1.append("service_start",$("input:text[name='frm_servicestart']").val())
            inputdata1.append("service_end",$("input:text[name='frm_serviceend']").val())
            inputdata1.append("is_present",$("#frm_ispresent").val())
            inputdata1.append("_token",token)
             inputdata1.append("company_id","{{$company_id}}")
            var inputData = {"organization": $("input:text[name='frm_organization']").val(),"position": $("input:text[name='frm_position']").val(),"is_present": $("#frm_ispresent").val(),"service_start":$("input:text[name='frm_servicestart']").val(),"service_end":$("input:text[name='frm_serviceend']").val(),"_token":token }
             
  
            // check if form is open in edit mode
            var editrowcount = $("#addEmployementHistory").find("input[name='editrowcount']").val();
            if(editrowcount != "") {
                
                inputdata1.append("history_id",$("#"+editrowcount).find("input[name='employmenthistory_id[]']").val())
                
                  var selected_id = $("#"+editrowcount).find("input[name='employmenthistory_id[]']").val();
                  if(selected_id > 0) {
                    if($("#edited_employmenthistory_id").val() == "")
                      $("#edited_employmenthistory_id").val(selected_id);
                    else
                      $("#edited_employmenthistory_id").val($("#edited_employmenthistory_id").val() +","+ selected_id);
                  }
                  $("#addEmployementHistory").find("input").each(function() {
                  var form_element_name = $(this).attr('name').split("_");
                  form_element_name = form_element_name[1];
                  $("#"+editrowcount).find("input[title='"+form_element_name+"']").val($(this).val());
                });
                $.ajax({
                  url:'/editprofile/addhistorydetail',
                  type:'POST',
                  dataType: 'json',
                  data:inputdata1,
                  processData:false,
                  contentType:false,
                   beforeSend: function () {
                     $('.loader').show();
                   },
                   complete: function () {
                     $('.loader').hide();
                   },
                  success: function (response) {
                        if (response.type == 'success') {
                          showSystemMessages('#systemMessage', response.type, response.msg);
                        }else {
                            showSystemMessages('#systemMessage', response.type, response.msg);
                        }
                    }
             }); 
            }
            else {
                
                     $.ajax({
                  url:'/editprofile/addhistorydetail',
                  type:'POST',
                  dataType: 'json',
                  data:inputdata1,
                  processData:false,
                  contentType:false,
                   beforeSend: function () {
                     $('.loader').show();
                   },
                   complete: function () {
                     $('.loader').hide();
                   },
                  success: function (response) {
                        if (response.type == 'success') {
                          showSystemMessages('#systemMessage', response.type, response.msg);
                            var last_row_id = $("#employement_history_table > tbody > tr:last-child").closest('tr').attr('id');
              var last_row_count = last_row_id.split("_");
              employement_history_count = parseInt(last_row_count[1]) + 1;
              var newrow = '<tr id="history_'+employement_history_count+'">'
                    + '<input type="hidden" name="employmenthistory_id[]" value="'+response.id+'">'
                    + '<td valign="middle">' 
                    + '<input type="text" name="organization[]" value="'+inputData.organization+'" class="noborder" title="organization" readonly>'
                    +  '</td>'
                    + '<td valign="middle">' 
                    + '<input type="text" name="position[]" value="'+inputData.position+'" class="noborder"  title="position" readonly>'
                    + '</td>'
                    + '<td valign="middle">'
                    + '<input type="hidden" name="ispresent[]" value="'+inputData.is_present+'" class="noborder" title="ispresent">'
                    + '<input type="text" name="servicestart[]" value="'+inputData.service_start+'" class="noborder"  title="servicestart" readonly>'
                    + '</td>'
                    + '<td valign="middle">' 
                    + '<input type="text" name="serviceend[]" value="'+inputData.service_end+'" class="noborder"  title="serviceend" readonly>'
                    + '</td>'
                    + '<td valign="middle" align="center">'
                    + '   <a href="javascript:editHistory('+employement_history_count+')"><i class="fa fa-pencil-square"></i></a>'
                    + '   <a href="javascript:deleteRow(\'history_'+employement_history_count+'\')" title="Delete this detail"><i class="fa fa-trash"></i></a>'
                    + '</td>'
                    + '</tr>';
  
              $("#employement_history_table > tbody:last-child").append(newrow);
                        }else {
                            showSystemMessages('#systemMessage', response.type, response.msg);
                        }
                    }
             }); 
            }         
  
            // remove form field values
            removeFormValues('addEmployementHistory');
            $('#addEmployementHistory').modal('hide');
          });
  
          /*** education form process - starts ***/
        $("#addEducation").on("hidden.bs.modal", function(){
              removeFormValues('addEducation');
          });
  
        // open education form 
          $("#add_education").click(function() {
            $('#addEducation').modal('show');
          });
          
          $("#passingyear").change(function(){
    //console.log("ggfh")
    var a = $("#passingyear").val();
    if(a > new Date().getFullYear()){
         $("#b_year").text("Passing year shoud be less than current year");
    }
    else{
        $("#b_year").text("");
    }
})
  
          // save education form
          $("#submit_education").click(function() {
  
            // check validations
            if(!validateFormEducation()) {
              return false;
            }
            var token = '{{csrf_token()}}';
            var inputdata1 = new FormData();
            inputdata1.append("course",$(".frm_course").val())
            inputdata1.append("passing_year",$(".frm_passingyear").val())
            inputdata1.append("university",$(".frm_university").val())
            inputdata1.append("company_id","{{$company_id}}")
            inputdata1.append("_token",token)
            var inputData = {"course": $(".frm_course").val(),"passing_year":$(".frm_passingyear").val(),"university":$(".frm_university").val(),"_token":token }
            // check if form is open in edit mode
            var editrowcount = $("#addEducation").find("input[name='editrowcount_education']").val();
            if(editrowcount != "") {
                inputdata1.append("education_id",$("#"+editrowcount).find("input[name='education_id[]']").val())
                $.ajax({
                  url:'/editprofile/addeducationdetail',
                  type:'POST',
                  dataType: 'json',
                  data:inputdata1,
                  processData:false,
                  contentType:false,
                   beforeSend: function () {
                     $('.loader').show();
                   },
                   complete: function () {
                     $('.loader').hide();
                   },
                  success: function (response) {
                        if (response.type == 'success') {
                          showSystemMessages('#systemMessage', response.type, response.msg);
                        }else {
                            showSystemMessages('#systemMessage', response.type, response.msg);
                        }
                    }
                });
                
                
              var selected_id = $("#"+editrowcount).find("input[name='education_id[]']").val();
              if(selected_id > 0) {
                if($("#edited_education_id").val() == "")
                  $("#edited_education_id").val(selected_id);
                else
                  $("#edited_education_id").val($("#edited_education_id").val() +","+ selected_id);
              }
              $("#addEducation").find("input").each(function() {
              var form_element_name = $(this).attr('name').split("_");
              form_element_name = form_element_name[1];
              $("#"+editrowcount).find("input[title='"+form_element_name+"']").val($(this).val());
            });
            }
            else {
                
                console.log(inputData)
            $.ajax({
          url:'/editprofile/addeducationdetail',
          type:'POST',
          dataType: 'json',
          data:inputdata1,
          processData:false,
          contentType:false,
           beforeSend: function () {
             $('.loader').show();
           },
           complete: function () {
             $('.loader').hide();
           },
          success: function (response) {
                if (response.type == 'success') {
                  showSystemMessages('#systemMessage', response.type, response.msg);
                  //$("#addService").find("#updated_profile_pic").val(response.image_name);
                  //$('#addService').modal('hide');
  var last_row_id = $("#education_table > tbody > tr:last-child").closest('tr').attr('id');
              var last_row_count = last_row_id.split("_");
              education_count = parseInt(last_row_count[1]) + 1;
              var newrow = '<tr id="education_'+education_count+'">'
                    + '<input type="hidden" name="education_id[]" value="'+response.id+'">'
                    + '<td valign="middle">' 
                    + '<input type="text" name="course[]" value="'+inputData.course+'" class="noborder" title="course" readonly>'
                    +  '</td>'
                    + '<td valign="middle">' 
                    + '<input type="text" name="university[]" value="'+inputData.university+'" class="noborder"  title="university" readonly>'
                    + '</td>'
                    + '<td valign="middle">' 
                    + '<input type="text" name="passingyear[]" value="'+inputData.passing_year+'" class="noborder"  title="passingyear" readonly>'
                    + '</td>'
                    + '<td valign="middle" align="center">'
                    + '   <a href="javascript:editEducation('+education_count+')"><i class="fa fa-pencil-square"></i></a>'
                    + '   <a href="javascript:deleteRow(\'education_'+education_count+'\')" title="Delete this detail"><i class="fa fa-trash"></i></a>'
                    + '</td>'
                    + '</tr>';
  
              $("#education_table > tbody:last-child").append(newrow);
                  saveValues();
  
                }else {
                    showSystemMessages('#systemMessage', response.type, response.msg);
                }
            }
        });    
  
            
            }         
  
            // remove form field values
            removeFormValues('addEducation');
            $('#addEducation').modal('hide');
          });
  
          /*** certification form process - starts ***/
        $("#addCertificate").on("hidden.bs.modal", function(){
              removeFormValues('addCertificate');
          });
  
        // open certification form 
          $("#add_certificate").click(function() {
            $('#addCertificate').modal('show');
          });
  
          // save certificate form
          $("#submit_certificate").click(function() {
  
            // check validations
            if(!validateFormCertificate()) {
              return false;
            }
            
             var token =  '{{csrf_token()}}'
                var inputData = {'title':$("input:text[name='frm_certificatetitle']").val(),'completion_date':$('.certificate_completion_date').val()}
                  var inputdata1 = new FormData();
                  inputdata1.append("title",$("input:text[name='frm_certificatetitle']").val())
                  inputdata1.append("completion_date",$('.certificate_completion_date').val())
                  inputdata1.append("_token",token)
                   inputdata1.append("company_id","{{$company_id}}")
  
                // check if form is open in edit mode
                var editrowcount = $("#myModal11").find("input[name='editrowcount_certificate']").val();
                if(editrowcount != "") {
                    inputdata1.append("certificate_id",$("#"+editrowcount).find("input[name='certificate_id[]']").val())
                     $.ajax({
                      url:'/editprofile/addcertificatedetail',
                      type:'POST',
                      dataType: 'json',
                      data:inputdata1,
                      processData:false,
                      contentType:false,
                       beforeSend: function () {
                         $('.loader').show();
                       },
                       complete: function () {
                         $('.loader').hide();
                       },
                      success: function (response) {
                            if (response.type == 'success') {
                              showSystemMessages('#systemMessage', response.type, response.msg);
                            }else {
                                showSystemMessages('#systemMessage', response.type, response.msg);
                            }
                        }
                 });
                
              var selected_id = $("#"+editrowcount).find("input[name='certificate_id[]']").val();
              if(selected_id > 0) {
                if($("#edited_certificate_id").val() == "")
                  $("#edited_certificate_id").val(selected_id);
                else
                  $("#edited_certificate_id").val($("#edited_certificate_id").val() +","+ selected_id);
              }
              $("#myModal11").find("input").each(function() {
              var form_element_name = $(this).attr('name').split("_");
              form_element_name = form_element_name[1];
              $("#"+editrowcount).find("input[title='"+form_element_name+"']").val($(this).val());
            });
            }
            else {
                  $.ajax({
                  url:'/editprofile/addcertificatedetail',
                  type:'POST',
                  dataType: 'json',
                  data:inputdata1,
                  processData:false,
                  contentType:false,
                   beforeSend: function () {
                     $('.loader').show();
                   },
                   complete: function () {
                     $('.loader').hide();
                   },
                  success: function (response) {
                        if (response.type == 'success') {
                          showSystemMessages('#systemMessage', response.type, response.msg);
                           // $("#"+rowid).remove();
                           var last_row_id = $("#certificate_table > tbody > tr:last-child").closest('tr').attr('id');
              var last_row_count = last_row_id.split("_");
              certificate_count = parseInt(last_row_count[1]) + 1;
              var newrow = '<tr id="certificate_'+certificate_count+'">'
                    + '<input type="hidden" name="certificate_id[]" value="'+response.id+'">'
                    + '<td valign="middle">' 
                    + '<input type="text" name="certificatetitle[]" value="'+inputData.title+'" class="noborder" title="skiilsachievmentsawards" readonly>'
                    +  '</td>'
                    + '<td valign="middle">' 
                    + '<input type="text" name="certificatecompletion[]" value="'+inputData.completion_date+'" class="noborder"  title="certificatecompletion" readonly>'
                    + '</td>'
                    + '<td valign="middle" align="center">'
                    + '   <a href="javascript:editCertificate('+certificate_count+')"><i class="fa fa-pencil-square"></i></a>'
                    + '   <a href="javascript:deleteRow(\'certificate_'+certificate_count+'\')" title="Delete this detail"><i class="fa fa-trash"></i></a>'
                    + '</td>'
                    + '</tr>';
  
              $("#certificate_table > tbody:last-child").append(newrow);
                        }else {
                            showSystemMessages('#systemMessage', response.type, response.msg);
                        }
                    }
             });    
  
              
            }         
  
            // remove form field values
            removeFormValues('addCertificate');
            $('#addCertificate').modal('hide');
          });
          
          
          // save skill award form
          $("#skill_award_form").click(function() {
  
            // check validations
            if(!validateSkillAward()) {
              return false;
            }
             var token =  '{{csrf_token()}}'
                var inputData = {'type':$("#skiils_achievments_awards").val(),'completion_date':$('#certificatecompletion').val(),'skill_detail':$('#skill_detail').val()}
                  var inputdata1 = new FormData();
                  inputdata1.append("type",$("#skiils_achievments_awards").val())
                  inputdata1.append("completion_date",$('#certificatecompletion').val())
                  inputdata1.append("skill_detail",$('#skill_detail').val())
                  inputdata1.append("_token",token)
                   inputdata1.append("company_id","{{$company_id}}")
                  // check if form is open in edit mode
                var editrowcount = $("#myModal11").find("input[name='editrowcount_skillaward']").val();
                if(editrowcount != "") {
                    inputdata1.append("skill_award_id",$("#"+editrowcount).find("input[name='skillaward_id[]']").val())
                     $.ajax({
                      url:'/editprofile/addskillawarddetail',
                      type:'POST',
                      dataType: 'json',
                      data:inputdata1,
                      processData:false,
                      contentType:false,
                       beforeSend: function () {
                         $('.loader').show();
                       },
                       complete: function () {
                         $('.loader').hide();
                       },
                      success: function (response) {
                            if (response.type == 'success') {
                              showSystemMessages('#systemMessage', response.type, response.msg);
                            }else {
                                showSystemMessages('#systemMessage', response.type, response.msg);
                            }
                        }
                 });
                
              var selected_id = $("#"+editrowcount).find("input[name='skillaward_id[]']").val();
              if(selected_id > 0) {
                if($("#edited_skill_award_id").val() == "")
                  $("#edited_skill_award_id").val(selected_id);
                else
                  $("#edited_skill_award_id").val($("#edited_skill_award_id").val() +","+ selected_id);
              }
               $("#"+editrowcount).find("input[title='skiilsachievmentsawards']").val(inputData.type);
               $("#"+editrowcount).find("input[title='certificatecompletion']").val(inputData.completion_date);
               $("#"+editrowcount).find("input[title='skilldetail']").val(inputData.skill_detail);
              //$("#myModal11").find("input").each(function() {
            //   var form_element_name = $(this).attr('name').split("_");
            //   console.log("form_element_name")
            //   console.log(form_element_name)
            //   form_element_name = form_element_name[1];
             
            // $("#"+editrowcount).find("input[title='"+form_element_name+"']").val($(this).val());
            //});
            }
                  else {
                   $.ajax({
                  url:'/editprofile/addskillawarddetail',
                  type:'POST',
                  dataType: 'json',
                  data:inputdata1,
                  processData:false,
                  contentType:false,
                   beforeSend: function () {
                     $('.loader').show();
                   },
                   complete: function () {
                     $('.loader').hide();
                   },
                  success: function (response) {
                        if (response.type == 'success') {
                          showSystemMessages('#systemMessage', response.type, response.msg);
                          
                          var last_row_id = $("#skillaward_table > tbody > tr:last-child").closest('tr').attr('id');
                      var last_row_count = last_row_id.split("_");
                      certificate_count = parseInt(last_row_count[1]) + 1;
                      var newrow = '<tr id="skillaward_'+certificate_count+'">'
                            + '<input type="hidden" name="skillaward_id[]" value="'+response.id+'">'
                            + '<td valign="middle">' 
                            + '<input type="text" name="skillawardtype[]" value="'+inputData.type+'" class="noborder" title="skiilsachievmentsawards" readonly>'
                            +  '</td>'
                            + '<td valign="middle">' 
                            + '<input type="text" name="skillawardcompletion[]" value="'+inputData.completion_date+'" class="noborder"  title="certificatecompletion" readonly>'
                            + '</td>'
                            +'<td valign="middle">' 
                            + '<input type="text" name="skilldetail[]" value="'+inputData.skill_detail+'" class="noborder"  title="skill_detail" readonly>'
                            + '</td>'
                            + '<td valign="middle" align="center">'
                            + '   <a href="javascript:editSkillAward('+certificate_count+')"><i class="fa fa-pencil-square"></i></a>'
                            + '   <a href="javascript:deleteRow(\'skillaward_'+certificate_count+'\')" title="Delete this detail"><i class="fa fa-trash"></i></a>'
                            + '</td>'
                            + '</tr>';
          
                      $("#skillaward_table > tbody:last-child").append(newrow);
                          
                          
                          
                        }else {
                            showSystemMessages('#systemMessage', response.type, response.msg);
                        }
                    }
             });
            }
             $('#myModal11').modal('hide');
          
          });
  
          /*** services form process - starts ***/
        $("#addService").on("hidden.bs.modal", function(){
              removeFormValues('addService');
          });
          
          $("#myModal11").on("hidden.bs.modal", function(){
              $("#skiils_achievments_awards").val('')
              removeFormValues('myModal11');
          });
  
        // open service form 
          $("#add_service").click(function() {
          $.ajax({
          url:'/get_serviceform',
          type:'get',
          beforeSend: function () {
             $('.loader').show();
           },
           complete: function () {
             $('.loader').hide();
           },
          success: function (response) { 
            $('#addService').html(response);
            $('#addService').modal('show');
            setTimeout(function(){
                console.log("settime")
                $('#company_id').val('{{$company_id}}')
                // $('<input>').attr({
                //     type: 'hidden',
                //     id: 'foo',
                //     name:'company_id',
                //     value: '{{$company_id}}'
                // }).appendTo($('#servicedata'));
            },100)
            }
        });
            //$('#addService').modal('show');
          });
  
          // save service form
          // $("#submit_service1").click(function() {
         
  
      $(".button-back").click(function() {
        var steps_div_id = $(this).closest('div[class="singup_steps"]').attr("id");
        var step_id = steps_div_id.split("_");
        var current_step = step_id[2];
        var next_step = parseInt(current_step) - 1;
  
        $("#singup_step_"+current_step).fadeOut(function () {
          $("#singup_step_"+next_step).fadeIn(1000);
        });
  
        $('.steps').find('.step_'+next_step).addClass("step-active");
      });
  
      $(".experience_level_div").click(function() {
        $(".experience_level_div").removeClass('active');
        var label_value = $(this).find('label').html();
        $(this).addClass('active');
        $('#selected_experience_level').val(label_value);
      });
  
      $("label.present_work_btn").click(function() {
        $("#frm_ispresentcheck").attr("checked", !$("#frm_ispresentcheck").attr("checked"));
        changeDateBasedonPresent();
      });
      });
  
    function changeDateBasedonPresent()
    {
      if($("#frm_ispresentcheck").attr("checked")) {
          $("#frm_ispresent").val("1");
          $("#dp2").val("Till Date");
          $("#dp2").attr("disabled", true); 
        }else {
          $("#frm_ispresent").val("0");
          $("#dp2").val("");
          $("#dp2").attr("disabled", false);
        }
    }
  
    function validateFormEmploymentHistory()
    {
      var msg = '';
      var returnVal;
      returnVal = true;
      if($("input:text[name='frm_organization']").val().trim() == "") {
        msg += '<br>Enter Organization';
        returnVal = false;
      }
      if($("input:text[name='frm_position']").val().trim() == "") {
        msg += '<br>Enter Position';
        returnVal = false;
      }
      if($("input:text[name='frm_servicestart']").val().trim() == "") {
        msg += '<br>Enter Service start date';
        returnVal = false;
      }
      if(!$("#frm_ispresentcheck").attr("checked") && $("input:text[name='frm_serviceend']").val() == "") {
        msg += '<br>Enter Service end date';
        returnVal = false;
      }
      if($("input:text[name='frm_servicestart']").val() != "" && !$("#frm_ispresentcheck").attr("checked") && $("input:text[name='frm_serviceend']").val() != "") {
        var selected_startDate = $("input:text[name='frm_servicestart']").val().split("-");
        var startDate = new Date(selected_startDate[2], selected_startDate[1]-1, selected_startDate[0]);
        var selected_endDate = $("input:text[name='frm_serviceend']").val().split("-");
        var endDate = new Date(selected_endDate[2], selected_endDate[1]-1, selected_endDate[0]);
        if (startDate.valueOf() > endDate.valueOf()) {
          msg += '<br>The from-date can not be greater then the to-date';
          returnVal = false;
        }
      }
      if(!returnVal) {
        showSystemMessages('#systemMessage_history', 'danger', msg);
        return false;
      }
      return true;    
    }
  
    function validateFormEducation()
    {
      var msg = '';
      var returnVal;
      returnVal = true;
      if($("input:text[name='frm_course']").val().trim() == "") {
        msg += '<br>Enter Course';
        returnVal = false;
      }
      if($("input:text[name='frm_university']").val().trim() == "") {
        msg += '<br>Enter University';
        returnVal = false;
      }
      if($("input[name='frm_passingyear']").val() == "") {
        msg += '<br>Enter Passing year';
        returnVal = false;
      }
      if($("#b_year").text() != ''){
          returnVal = false;
      }
      if(!returnVal) {
        showSystemMessages('#systemMessage_education', 'danger', msg);
        return false;
      }
      return true;    
    }
    
    function validateSkillAward()
    {
      var msg = '';
      var returnVal;
      returnVal = true;
      console.log($("#skiils_achievments_awards").val())
      if($("#skiils_achievments_awards").val() == "") {
        msg += '<br>Enter Skill type';
        returnVal = false;
      }
      if($("input:text[name='frm_certificatecompletion']").val().trim() == "") {
        msg += '<br>Enter completion date';
        returnVal = false;
      }
      if(!returnVal) {
        showSystemMessages('#systemMessage_education', 'danger', msg);
        return false;
      }
      return true;    
    }
  
    function validateFormCertificate()
    {
      var msg = '';
      var returnVal;
      returnVal = true;
      if($("input:text[name='frm_certificatetitle']").val().trim() == "") {
        msg += '<br>Enter Name of certification';
        returnVal = false;
      }
      if($("input:text[name='frm_certificatecompletion_date']").val().trim() == "") {
        msg += '<br>Enter Completion date';
        returnVal = false;
      }
      if(!returnVal) {
        showSystemMessages('#systemMessage_certificate', 'danger', msg);
        return false;
      }
      return true;    
    }
  
    function validateFormService()
    {
      var msg = '';
      var returnVal;
      returnVal = true;
  null
      if($("input:text[name='frm_servicetitle']").val().trim() == "") {
        msg += '<br>Enter Name of service';
        returnVal = false;
      }
      if($("input:text[name='frm_serviceprice']").val().trim() == "") {
        msg += '<br>Enter Price for service';
        returnVal = false;
      }else {
        var price = $("input:text[name='frm_serviceprice']").val();
        var valid = /^\$?(\d{1,3}(\,\d{3})*|(\d+))(\.\d{0,2})?$/.test(price);                    
        if(!valid) {
          msg += '<br>Enter proper Price for service';
        returnVal = false;
        }
        }
                  //check valid amountc
      if($("#frm_servicedesc").val().trim() == "") {
        msg += '<br>Enter Description';
        returnVal = false;
      }
      if($("select[name='frm_servicesport']").val() == "") {
        msg += '<br>Select Sport';
        returnVal = false;
      }
      //----------------------new validation for new fields--------------------------------
      /*if($("select[name='frm_servicetype[]']").val() == null) {
        msg += '<br>Choose Service Type';
        returnVal = false;
      }
      if($("select[name='activitydesignsfor[]']").val() == null) {
        msg += '<br>Choose Activity Designed For';
        returnVal = false;
      }
      if($("select[name='activitytype[]']").val() == null) {
        msg += '<br>Choose  Activity Type';
        returnVal = false;
      } 
      if($("select[name='frm_agerange[]']").val() == null) {
        msg += '<br>Select Age Range';
        returnVal = false;
      }
      if($("select[name='frm_programfor[]']").val() == null) {
        msg += '<br>Activity For?';
        returnVal = false;
      } 
      if($('[name="setupprice"]:checked').length ==0){
        msg += '<br>Is this an special offer or a promotion?';
        returnVal = false;
      }
      if($('[name="termcondfaqtext"]').val()==' '){
        msg += '<br>Terms, Conditions, FAQ';
        returnVal = false;
      }
      if($('[name="contracttermstext"]').val()==' '){
        msg += '<br>Contract Terms';
        returnVal = false;
      }
      if($('[name="liabilitytext"]').val()==' '){
        msg += '<br>Liability';
        returnVal = false;
      } 
      if($("select[name='frm_numberofpeople[]']").val() == null) {
        msg += '<br>Select Participates Number';
        returnVal = false;
      }
  
      if($("select[name='frm_experience_level[]']").val() == null) {
        msg += '<br>Select Program Experience Level';
        returnVal = false;
      }
      if($("select[name='frm_servicelocation[]']").val() == null) {
        msg += '<br>Select Service Location';
        returnVal = false;
      }
      if($("select[name='frm_teachingstyle[]']").val() == null) {
        msg += '<br>Select Teaching Style';
        returnVal = false;
      }     
      if($("select[name='frm_servicepriceoption[]']").val() == null) {
        msg += '<br>Select Service Price Options';
        returnVal = false;
      }
      if($("select[name='frm_serviceduration']").val() == null) {
        msg += '<br>Select Duration';
        returnVal = false;
      }
      if($("input[name='service_image']").val() == "") {
        msg += '<br>Select Profile pic';
        returnVal = false;
      }
      */
                  
      if(!returnVal) {
        showSystemMessages('#systemMessage_service', 'danger', msg);
        return false;
      }
      return true;    
    }
  
      function editHistory(rowcount)
      {
        $("#history_"+rowcount).find("input").each(function() {
          var form_element_name = $(this).attr('title');
          $("#addEmployementHistory").find("input[name='frm_"+form_element_name+"']").val($(this).val());
        });
        if($("#frm_ispresent").val() == "1") {
          $("#frm_ispresentcheck").attr("checked",true);
          $("label.present_work_btn").addClass('active');
          changeDateBasedonPresent();
        }else {
          $("#frm_ispresentcheck").attr("checked",false);
        }
        $("#addEmployementHistory").find("input[id='editrowcount']").val("history_"+rowcount);
        $('#addEmployementHistory').modal('show');
      }
  
      function editEducation(rowcount)
      {
        $("#education_"+rowcount).find("input").each(function() {
          var form_element_name = $(this).attr('title');
          $("#addEducation").find("input[name='frm_"+form_element_name+"']").val($(this).val());
        });
        $("#addEducation").find("input[id='editrowcount_education']").val("education_"+rowcount);
        $('#addEducation').modal('show');
      }
  
      function editCertificate(rowcount)
      {
        $("#certificate_"+rowcount).find("input").each(function() {
          var form_element_name = $(this).attr('title');
          if(form_element_name == 'certificatecompletion'){
              $("#addCertificate").find("input[name='frm_certificatecompletion_date']").val($(this).val());
          }
          $("#addCertificate").find("input[name='frm_"+form_element_name+"']").val($(this).val());
        });
        $("#addCertificate").find("input[id='editrowcount_certificate']").val("certificate_"+rowcount);
        
        $('#addCertificate').modal('show');
      }
      
      function editSkillAward(rowcount)
      {
        $("#skillaward_"+rowcount).find("input").each(function() {
          var form_element_name = $(this).attr('title');
          console.log(form_element_name)
          if(form_element_name == 'skiilsachievmentsawards'){
              $("#myModal11").find("#skiils_achievments_awards").val($(this).val());
          }
          else if(form_element_name == 'skilldetail'){
              console.log("called "+$(this).val())
              $("#myModal11").find("#skill_detail").val($(this).val());
          }
          else
          $("#myModal11").find("input[name='frm_"+form_element_name+"']").val($(this).val());
        });
        $("#myModal11").find("input[id='editrowcount_skillaward']").val("skillaward_"+rowcount);
        
        $('#myModal11').modal('show');
      }
  
      function editService(rowcount)
      {
        $.ajax({
          url:'/get_serviceform/'+rowcount,
          type:'get',
           beforeSend: function () {
             $('.loader').show();
           },
           complete: function () {
             $('.loader').hide();
           },
          success: function (response) { 
            $('#addService').html(response);
            $('#addService').modal('show');
            }
        });
      
      
      }
  
      function deleteRow(rowid)
      {
          //console.log(rowid)
        var selected_section = rowid.split("_");
        var selected_section_id = ""; 
        if(selected_section[0] == "history") {
          selected_section_id = "employmenthistory_id";
        }
        else if(selected_section[0] == "education") {
          selected_section_id = "education_id";
        }
        else if(selected_section[0] == "certificate") {
          selected_section_id = "certificate_id";
        }
        else if(selected_section[0] == "service") {
          selected_section_id = "service_id";
        }
        else if(selected_section[0] == "skillaward") {
          selected_section_id = "skillaward_id";
        }
        var selected_id = $("#"+rowid).find("input[name='"+selected_section_id+"[]']").val();
          if(selected_id > 0) {
            if($("#deleted_"+selected_section_id).val() == "")
              $("#deleted_"+selected_section_id).val(selected_id);
            else
              $("#deleted_"+selected_section_id).val($("#deleted_"+selected_section_id).val() +","+ selected_id);
          }
          var token =  '{{csrf_token()}}'
          var inputdata1 = new FormData();
          inputdata1.append("selection_data",selected_section_id)
          inputdata1.append("id",selected_id)
          inputdata1.append("_token",token)
          $.ajax({
          url:'/deleteprofile/data',
          type:'POST',
          dataType: 'json',
          data:inputdata1,
          processData:false,
          contentType:false,
           beforeSend: function () {
             $('.loader').show();
           },
           complete: function () {
             $('.loader').hide();
           },
          success: function (response) {
                if (response.type == 'success') {
                  showSystemMessages('#systemMessage', response.type, response.msg);
                    $("#"+rowid).remove();
                }else {
                    showSystemMessages('#systemMessage', response.type, response.msg);
                }
            }
        });    
          //console.log(selected_id)
        
      }        
  
      function removeFormValues(modalName)
      {
        var modalElement = $('#'+modalName).find("input");
        modalElement.each(function() {
          $(this).val('');
        });
        if(modalName == "addEmployementHistory") {
          $("#systemMessage_history").html('');
          $("#frm_ispresentcheck").attr("checked",false);
          $("label.present_work_btn").removeClass('active');
          $("#dp2").val("");
        $("#dp2").attr("disabled", false);
        }
        else if(modalName == "addEducation") {
          $("#systemMessage_education").html('');
        }     
        else if(modalName == "addCertificate") {
          $("#systemMessage_certificate").html('');
        }
        
      }
  
      $("label.btn").click(function() {
                // find clicked button radio option name
                var radio_option = $(this).find('input[type=radio]');
                if ($(radio_option).is(':radio')) {
                  var radio_option_name = $(radio_option).attr('name');
                  // make all other options to null
                  $('input[type=radio][name="'+radio_option_name+'"]').each(function() {
                    $(this).closest('label.btn').removeClass('active');
                  });
                 
                  $(this).addClass('active');
                }              
          });    
      
      $(".willing_to_travel").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=radio]');  
        var willing_to_travel_val = $(willing_to_travel_radio).attr('value');     
  
        if(willing_to_travel_val == 'yes'){
          $('.travel_miles_div').show();
        } else {
        $('.travel_miles_div').hide();
        }
  
      });
     $(".medicaloption").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=radio]');  
        var willing_to_travel_val = $(willing_to_travel_radio).attr('value');     
        if(willing_to_travel_val == 1){
          $('.medicalyesno').show();
        } else {
        $('.medicalyesno').hide();
        }
      });
    $(".fitgolsop").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=radio]');  
        var willing_to_travel_val = $(willing_to_travel_radio).attr('value');     
        if(willing_to_travel_val == 1){
          $('.fitgolsyesno').show();
        } else {
        $('.fitgolsyesno').hide();
        }
      });
   $(".setupprice").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=radio]').val();
        if(willing_to_travel_radio == 1){
          $('#offpromo').show();
          $('#offprom_option').show();
        } else {
        $('#offpromo').hide();
        $('#offprom_option').hide();
        }
      });
      
      $(".multises").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=radio]').val();
        if(willing_to_travel_radio == 'multiple'){
          $('#multisession').show();
        } else {
        $('#multisession').hide();
        }
      });
      $(".termcondfaq").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=checkbox]').val();
        if(willing_to_travel_radio == 1){
          $('#termfaq').toggle();
        } 
      });
      $(".liability").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=checkbox]').val();
        if(willing_to_travel_radio == 1){
          $('#liability').toggle();
        } 
      });
      $(".contractterms").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=checkbox]').val();
        if(willing_to_travel_radio == 1){
          $('#contractterms').toggle();
        } 
      });

      
      $(".recurring_pay").click(function() {
        var willing_to_travel_radio = $(this).find('input[type=radio]').val();
        if(willing_to_travel_radio == 1){
          $('#recurring_pay').show();
        } else {
        $('#recurring_pay').hide();
        }
      });

      $('.percentageckeck').click(function(){
        if($(this).find('input[type=checkbox]').val() =='salestax' ){
        $('#salestaxpercentage').toggle();
      }
     if($(this).find('input[type=checkbox]').val() == 'duestax'){
        $('#duestaxpercentage').toggle();
      }
      });
        
      
</script> 
<script>
  if (top.location != location) {
      top.location.href = document.location.href ;
  }
  $(function(){
    window.prettyPrint && prettyPrint();
    $('#dp1').Zebra_DatePicker({
        default_position: 'below',
        format: 'm-d-Y',
        container : $('#dp1-position')      
});
$('#dp2').Zebra_DatePicker({
        default_position: 'below',
        format: 'm-d-Y',
        container : $('#dp2-position')      
});
    // $('#dp1').datepicker({
    //   dateFormat: 'mm-dd-yy'
    // }).on('changeDate', function(ev){
    //     var selected_enddate = $('#dp2').val().split("-");
    //     var endDate = new Date(selected_enddate[2], selected_enddate[1]-1, selected_enddate[0]);
    //     console.log(ev.date +"--"+endDate +"--"+ ev.date.valueOf() +"--"+ endDate.valueOf());
    //     if (ev.date.valueOf() > endDate.valueOf()){ console.log(ev.date.valueOf());
    //       showSystemMessages('#systemMessage_history', 'danger', 'The from-date can not be greater then the to-date');
    //     } else {
    //       $('#systemMessage_history').html('');
    //       // startDate = new Date(ev.date);
    //     }
    //     $('#dp1').datepicker('hide');
    // });
    // $('#dp2').datepicker({
    //   dateFormat: 'mm-dd-yy'
    // }).on('changeDate', function(ev){
    //     var selected_startDate = $('#dp1').val().split("-");
    //     var startDate = new Date(selected_startDate[2], selected_startDate[1]-1, selected_startDate[0]);
    //     console.log(startDate +"--"+ev.date +"--"+ startDate.valueOf() +"--"+ ev.date.valueOf());
    //     if (startDate.valueOf() > ev.date.valueOf()){ console.log(ev.date.valueOf());
    //       showSystemMessages('#systemMessage_history', 'danger', 'The from-date can not be greater then the to-date');
    //     } else {
    //       $('#systemMessage_history').html('');
    //       // startDate = new Date(ev.date);
    //     }
    //     $('#dp2').datepicker('hide');
    // });
    // $('#passingyear').datepicker({
    //   dateFormat: 'yy',
    //   changeYear: true,
    //     showButtonPanel: true,
    //   // dateFormat: 'yy',
    // });
    
  $('#passingyear').Zebra_DatePicker({
        default_position: 'below',
        format: 'Y',
        container : $('#passingyear-position')      
});  

$('#certificatecompletion').Zebra_DatePicker({
        default_position: 'below',
        format: 'm-d-Y',
        container : $('#certificatecompletion-position')      
});

$('#certificate_completion_date').Zebra_DatePicker({
        default_position: 'below',
        format: 'm-d-Y',
        container : $('#certificate_completion_date-position')      
});

    // $('#certificatecompletion').datepicker({
    //   dateFormat: 'mm-dd-yy'
    // });
    
    // $('.certificate_completion_date').datepicker({
    //   //format: 'dd-mm-yyyy'
    //   dateFormat:'mm-dd-yy'
    // });
  
        // disabling dates
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
  
        var checkin = $('#dpd1').datepicker({
          onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';
          }
        }).on('changeDate', function(ev) {
          if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.setValue(newDate);
          }
          checkin.hide();
          $('#dpd2')[0].focus();
        }).data('datepicker');
        var checkout = $('#dpd2').datepicker({
          onRender: function(date) {
            return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
          }
        }).on('changeDate', function(ev) {
          checkout.hide();
        }).data('datepicker');
  });
  
  
  $('#servicedata').submit(function(e) {

        e.preventDefault();
        if(!validateFormService()) {
            return false;
          }
        var inputData = new FormData($(this)[0]);
        console.log(inputData);
        inputData.append('_token','{{csrf_token()}}');
         $.ajax({
          url:'/service/editservicedetail',
          type:'POST',
          dataType: 'json',
          data:inputData,
          processData:false,
          contentType:false,
           beforeSend: function () {
             $('.loader').show();
           },
           complete: function () {
             $('.loader').hide();
           },
          success: function (response) { 
                if (response.type == 'success') {
                  showSystemMessages('#systemMessage', response.type, response.msg);
                
                  saveValues();
  
                }else {
                    showSystemMessages('#systemMessage', response.type, response.msg);
                }
            }
        });
  });
  
  function initialize1(q) {
        var input = q;
                var s = input.value
               var autocomplete = new google.maps.places.Autocomplete(input);
               $('.pac-container').css('z-index', '999999999');
                autocomplete.addListener('place_changed', function () {
                    $('#b_EINnumber').focus();
                   var place = autocomplete.getPlace();
                   $('#b_lat').val(place.geometry.location.lat())
                   $('#b_long').val(place.geometry.location.lng())
                  for (var i = 0; i < place.address_components.length; i++) {
      for (var j = 0; j < place.address_components[i].types.length; j++) {
        if (place.address_components[i].types[j] == "postal_code") {
          $('#b_zipcode').val(place.address_components[i].long_name);
        }
        if (place.address_components[i].types[j] == "locality") {
           $('#b_city').val(place.address_components[i].long_name);
       }
        if (place.address_components[i].types[j] == "country") {
          $('#b_country').val(place.address_components[i].short_name);
        }
        if (place.address_components[i].types[j] == "administrative_area_level_1") {
          $('#b_state').val(place.address_components[i].long_name);
        }
      }
    } 
                });
            }
  
  
  
  
  function readURL(input) {
         if (input.files && input.files[0]) {
             var reader = new FileReader();
  
             reader.onload = function (e) {
              var html = '<img src="'+e.target.result+'">';
              $('.uploadedpic').html(html);
             };
  
             reader.readAsDataURL(input.files[0]);
         }
     }
      function saveValues(){
        $('#service_div').empty();
           $.ajax({
          url:'/getmyservices',
          type:'GET',
          beforeSend: function () {
             $('.loader').show();
           },
           complete: function () {
             $('.loader').hide();
           },
          success: function (response) { 
                  $('#service_div').html(response);
            }
        });
      }
   
        /* added for multi step form */
  
        var currentTab = 0; // Current tab is set to be the first tab (0)
  showTab(currentTab); // Display the current tab
  
  function showTab(n) {
    // This function will display the specified tab of the form ...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    // ... and fix the Previous/Next buttons:
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
      document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
      document.getElementById("nextBtn").innerHTML = "Next";
    }
    // ... and run a function that displays the correct step indicator:
    fixStepIndicator(n)
  }
  
  function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if(n == 1){
        if($('#b_firstname').val() == ''){
            showSystemMessages('#systemMessage', 'danger', 'Company representative first name is required');
        }
        if($('#b_lastname').val() == ''){
            showSystemMessages('#systemMessage', 'danger', 'Company representative last name is required');
        }
        if($('#b_email').val() == ''){
            showSystemMessages('#systemMessage', 'danger', 'Email is required');
        }
        if($('#b_contact').val() == ''){
            showSystemMessages('#systemMessage', 'danger', 'Contact number is required');
        }
        if($('#b_companyname').val() == ''){
            showSystemMessages('#systemMessage', 'danger', 'Company name is required');
        }
        if($('#b_EINnumber').val() == ''){
            showSystemMessages('#systemMessage', 'danger', 'EIN Number is required');
        }
        if($('#b_address').val() == ''){
            showSystemMessages('#systemMessage', 'danger', 'Address is required');
        }
        if($('#b_state').val() == ''){
            showSystemMessages('#systemMessage', 'danger', 'State is required');
        }
        if($('#b_city').val() == ''){
            showSystemMessages('#systemMessage', 'danger', 'City is required');
        }
        if($('#b_country').val() == ''){
            showSystemMessages('#systemMessage', 'danger', 'Country is required');
        }
        if($('#b_zipcode').val() == ''){
            showSystemMessages('#systemMessage', 'danger', 'Zip code is required');
        }
        if($('#b_Establishmentyear').val() == ''){
            showSystemMessages('#systemMessage', 'danger', 'Establishment year is required');
        }
        if(!($('#about_company').val() != null && $('#about_company').val() != '' && $('#about_company').val() != ' ') ){
            showSystemMessages('#systemMessage', 'danger', 'About company is required');
        }
        if(!($('#about_company').val() != null && $('#about_company').val() != '' && $('#about_company').val() != ' ') ){
            showSystemMessages('#systemMessage', 'danger', 'About company is required');
        }
        if(!($('#about_company').val() != null && $('#about_company').val() != '' && $('#about_company').val() != ' ') || $('#b_firstname').val() == '' ||
$('#b_lastname').val() == '' ||
$('#b_email').val() == '' ||
$('#b_contact').val() == '' ||
$('#b_companyname').val() == '' ||
$('#b_EINnumber').val() == '' ||
$('#b_Establishmentyear').val() == '' ||
$('#b_address').val() == '' ||
$('#b_state').val() == '' ||
$('#b_city').val() == '' ||
$('#b_country').val() == '' ||
$('#b_zipcode').val() == '' 
){
    return false
}
    }
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form... :
    if (currentTab >= x.length) {
      //...the form gets submitted:
      document.getElementById("frmregister").submit();
      return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
  }
  
  function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
      // If a field is empty...
     /* if (y[i].value == "") {
        // add an "invalid" class to the field:
        y[i].className += " invalid";
        // and set the current valid status to false:
        valid = false;
      } */
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
      document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
    
  }
  
  function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
      x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class to the current step:
    x[n].className += " active";
  }
   /*  END added for multi step form */
  
  
  function initialize() {
    var miles = 3;
    var lat = <?php echo $getlat;?>;
    var long = <?php echo $getlong;?>;
        var map = new google.maps.Map(document.getElementById("map_canvas"), {
            zoom: 11,
            center: new google.maps.LatLng(lat, long),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
  
        var circle = new google.maps.Circle({
            center: new google.maps.LatLng(lat, long),
            radius: miles * 1609.344,
            fillColor: "#ff69b4",
            fillOpacity: 0.5,
            strokeOpacity: 0.0,
            strokeWeight: 0,
            map: map
        });
  }
  initialize();
  $('#milesnew').change(function(){
  //var miles = $('#milesnew option:selected').val();
  
    if($('#milesnew option:selected').val() == 1 || $('#milesnew option:selected').val() == 3 || $('#milesnew option:selected').val() == 5 ){
      var miles = 4;
      var zoom = 10;
  }else{
      var miles = $('#milesnew option:selected').val();
       var zoom = 8;
  }
  
  $('#map_canvas').empty();
  
    var lat = <?php echo $getlat;?>;
    var long = <?php echo $getlong;?>;
        var map = new google.maps.Map(document.getElementById("map_canvas"), {
            zoom: zoom,
            center: new google.maps.LatLng(lat, long),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
  
        var circle = new google.maps.Circle({
            center: new google.maps.LatLng(lat, long),
            radius: miles * 1609.344,
            fillColor: "#ff69b4",
            fillOpacity: 0.5,
            strokeOpacity: 0.0,
            strokeWeight: 0,
            map: map
        });
  
  });
  
  function showEditDate() {
  $("#editDateDiv").toggle();
  $("#hoursshow").hide();
  }
  
  function hideEditDate() {
  $("#editDateDiv").hide();
  }
  function hidehoursshow(){
  $('#hoursshow').hide();
  }
  function hoursshow(){
  $('#hoursshow').toggle();
  $("#editDateDiv").hide();
  }
  
  
  
</script>
@endsection









                <!-- The Modal -->
  <div class="modal fade skillachievemodel" id="myModal11">
    <input type="hidden" name="editrowcount_skillaward" id="editrowcount_skillaward" value="">
                  <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-body login-pad">
                        <div class="pop-title employe-title">
                          <h3 style="font-size: 31px;">SKILLS, ACHIEVMENTS & AWARDS</h3>
                        </div>
                        <button type="button" class="close modal-close" data-dismiss="modal">
                        <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                      </button>
                        <div class="signup">
                          <div id='systemMessage_certificate'></div>
                            <div class="emplouyee-form">
                              <div class="select-style" style="background-color: #fff !important;font-size: 15px;color: #7a7b7b;">
            
                        <select class="selectpicker" id="skiils_achievments_awards" name="frm_skiilsachievmentsawards" rel="notice">
                          <option value="">Select Item</option>
                          <option value="Skills">Skills</option>
                          <option value="Achievment">Achievments</option>
                          <option value="Award">Awards</option>
                        </select>
                      </div>
                      <div id="certificatecompletion-position">
                       <input type="text" name="frm_certificatecompletion" placeholder="Completion Date" id="certificatecompletion"/>
                       </div>
                       <textarea class="form-control rounded-0" id="skill_detail" rows="3" placeholder="Description"></textarea>
                              <button type="button" id="skill_award_form">SUBMIT</button>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
  </div>
  