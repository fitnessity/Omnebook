@inject('request', 'Illuminate\Http\Request')

@extends('layouts.profile')



@section('content')
<style>
	table.dp_monthpicker.dp_body td {
    padding: 15px !important;
}

a:hover, a:focus {
    color: #fff !important;
    text-decoration: none !important;
}
.button {
      display: block;
    width: 135px;
    height: 41px;
    background: #f53b49;
    padding: 10px;
    text-align: center;
    border-radius: 0px;
    color: #fff;
    font-weight: bold;
    /* line-height: 25px; */
    font-size: 17px;
}
.Zebra_DatePicker{
	width: 70% !important;
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
    .avatar {
  vertical-align: middle;
  width: 120px;
  height: 120px;
  border-radius: 50%;
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
    .Zebra_DatePicker {
    background: #666;
    border-radius: 4px;
    box-shadow: 0 0 10px #888;
    color: #222;
    font: 13px Tahoma,Arial,Helvetica,sans-serif;
    padding: 3px;
    position: absolute;
    display: table;
    *width: 255px;
    z-index: 1200
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
    background: #fc3;
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
.pad{
    padding-top:10px;
}
</style>
<style>
 .mt83{
  margin-top: 83px;
}
.close{
  opacity: 1 !important;
}
.signleft-customer form a {
    font-size: 13.5px;
    color: #777;
    padding-bottom: 0;
    text-align: left;
    float: none;
}
.t_c {
    font-size: 13.5px !important;
    color: #777 !important;
    padding-bottom: 0;
    text-align: left;
    float: none;}

button.FITNESS_ENTHUSIASTS_signup {
    margin-top: 22.4%;
}
.signleft {
    float: left;
    width: 45%;
}
.signright{
  width: 45%;
}
input,select {
  margin: 2.2% 0.5%;
    border: 1px solid #828282;
    padding: 16px 10px;
    width: 100%;
}
.modallink.mt20 {
    margin-top: 8% !important;
}
.pac-container {
    z-index: 999999999;
}
 </style>
<style>
  table.dp_monthpicker.dp_body td {
    padding: 15px !important;
}
  .Zebra_DatePicker .dp_body .dp_selected {
    background: #f53b49 !important;
    color: #fff !important;
}
  .Zebra_DatePicker .dp_daypicker th {
    background: #f53b49 !important;
    cursor: text;
    font-weight: 700;
    color: #fff !important;
}
  input#frm1_birthday{
    padding-right: 0px !important;
  }
  .Zebra_DatePicker{
    width: 100% !important;
  }
  button.Zebra_DatePicker_Icon {
    display: none !important;
}

    .lbl{

        float:left;

    }
    .Zebra_DatePicker_Icon_Wrapper{
        width:150px !important;
    }

</style>

<div class="business-offer-main profile-sec">

    <?php 

       $loggedinUser = Auth::user(); 

       $customerName = $loggedinUser->firstname.' '.$loggedinUser->lastname;

       $profilePicture = $loggedinUser->profile_pic;

    ?>



    @include('includes.sidebar_profile_left',array ('customerName' => $customerName,'profilePicture' => $profilePicture))



  <div class="business-middle">



    <div class="network_block nw-profile_block">

       

      @if(Auth::user()->status == "rejected")

        <div class="flash-message" style="margin-bottom:15px;">

            <p class="alert alert-danger"><?php echo nl2br(Auth::user()->rejected_reason); ?></p>

        </div>

      @endif

     

      <div class="row">



        <div class="nw-user-detail-block">

          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">

            <div class="nw-user-img">

              <?php

              if($UserProfileDetail['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR.$UserProfileDetail['profile_pic'])) {

                echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB').$UserProfileDetail['profile_pic'].'" width="254" height="275" id="display_user_profile_pic_view_profile" class="display_user_profile_pic_view_profile"/>';

              }

              else {

                echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png" width="254" height="275" id="display_user_profile_pic_view_profile" class="display_user_profile_pic_view_profile"/>';

              }

              ?>

              @can('profile_edit_access')

                <a href="" class="edit-pic" data-toggle="modal" data-target="#editProfilePic" title="Click here to change picture"><i class="fa fa-camera"></i></a>

              @endcan

            </div>

            <button class="nw-view-profile">View profile as</button>

          </div>



                <!-- Modal -->

                <div class="modal fade" id="editProfilePic" role="dialog">

                  

                  {!! Form::open(array('files' => true , 'enctype' => 'multipart/form-data', 'id' => 'frmeditProfile')) !!}



                  <input type="hidden" name="_token" value="{{ csrf_token() }}">



                  <div class="modal-dialog modal-lg">

                    <!-- Modal content-->

                    <div class="modal-content">

                      <div class="modal-body login-pad">

                        <div class="pop-title employe-title">

                          <h3>EDIT PROFILE PICTUREE</h3>

                        </div>

                        <button type="button" class="close modal-close" data-dismiss="modal">

                        <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>

                      </button>

                      

                        <div class="signup">

                          <div id='systemMessage'></div>

                          <div class="emplouyee-form">

                            <input class="upload-pic" type="file" name="profile_pic" id="profile_pic" class="form-control">

                            <button type="submit" id="submit_profilepic">Submit</button>

                          </div>

                        </div>

                    </div>

                  </div>

                  

                </div>

                {!! Form::close() !!}



              </div>

            <!-- Modal -->

                <div class="modal fade" id="upgradeProfileForm" role="dialog">
                
                  <div class="modal-dialog modal-lg">

                    <!-- Modal content-->

                    <div class="modal-content">

                      <div class="modal-body login-pad">
                          <div id="fitnessity_for_business_step2" style="display:none;">

                        <div class="pop-title employe-title">

                          <h3>EDUCATION & EXPERIENCE</h3>

                        </div>

                        <button type="button" class="close modal-close" data-dismiss="modal">

                        <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>

                      </button>
                        
                        <div class="signup">
                        <div id='systemMessage'></div>
                             <div class="signleft-customer">
                          <h4 class="heading">Employment History</h4>
                          <div class="row col-sm-12 text-left">
                             <label>Organistation Name </label>
                         </div>
                         <input type="text" class="frm_organization" id="frm_organisationname" name="frm_organization" placeholder="Organization name" />
                         <span class="error" id="b_organisationname"></span>
                         
                         <div class="row col-sm-12 text-left">
                             <label>Position </label>
                         </div>
                         <input type="text" id="frm_position" class="frm_position" id="frm_position" name="frm_position" placeholder="Position" />
                         <span class="error" id="b_position"></span>
                         
                         <div class="qh-steps-form">
                            <div class="form-control">
                              <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-primary present_work_btn">
                                  <input type="checkbox" autocomplete="off" name="frm_ispresentcheck" id="frm_ispresentcheck" value="1">
                                  <input type="hidden" name="frm_ispresent" id="frm_ispresent" value="0">
                                  <span class="glyphicon glyphicon-ok"></span>
                                </label>
                                <span>Presently working here</span> </div>
                            </div>
                          </div>
                          
                          <div class="row col-sm-12 text-left">
                             <label>From </label>
                         </div>
                         <div class="row">
                         <div class="col-md-12" id="dp1-position">
                         <input type="text" name="frm_servicestart" class="span2" placeholder="From" id="dp1" readonly >
                         </div>
                         </div>
                         <span class="error" id="b_employmentfrom"></span> 
                         
                         <div class="row col-sm-12 text-left">
                             <label>To </label>
                         </div>
                         <div class="row">
                         <div class="col-md-12" id="dp2-position">
                         <input type="text" name="frm_serviceend" class="span2" placeholder="To" id="dp2" readonly >
                         </div>
                         </div>
                         <span class="error" id="b_employmentto"></span>
                         <hr>
                          <h4 class="heading">Education Details</h4>
                         <div class="row col-sm-12 text-left">
                         <label>Degree/Course </label>
                         </div>
                         <input type="text" class="frm_course" id="frm_course" name="frm_course" placeholder="Degree/Course (Obtained or Seeking)" />
                         <span class="error" id="b_degree"></span>
                         <div class="row col-sm-12 text-left">
                         <label>University/School </label>
                         </div>
                         <input type="text" class="frm_university" id="frm_university" name="frm_university" placeholder="University/School" />
                         <span class="error" id="b_university"></span>
                         <div class="row col-sm-12 text-left">
                         <label>Year Graduated</label>
                         </div>
                         <div class="row">
                         <div class="col-md-12" id="passingpicker-position">
                         <input type="number" maxlength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:100%" class="frm_passingyear" name="frm_passingyear" placeholder="Year graduated/projected graduation" id="passingyear" autocomplete="off">
                         </div>
                         </div>
                         <span class="error" id="b_year"></span>
                      <hr>
                         <h4 class="heading">Certification Details</h4>
                         <div class="row col-sm-12 text-left">
                         <label>Name of Certification </label>
                         </div>
                         <input type="text" name="certification" id="certification" placeholder="Name of Certification"/>
                         <span class="error" id="b_certification"></span>
                         
                         <div class="row col-sm-12 text-left">
                         <label>Completion Date</label>
                         </div>
                         <div class="row">
                         <div class="col-md-12" id="completionpicker-position">
                         <input type="text" style="width:100%" class="frm_passingyear" name="frm_passingyear" placeholder="Completion Date" id="completionyear" autocomplete="off">
                         </div>
                         </div>
                         <span class="error" id="b_certificateyear"></span>
                         <hr>
                         <h4 class="heading">SKILLS, ACHIEVMENTS AND AWARDS</h4>
                         <div class="row col-sm-12 text-left">
                         <label>Skill Type</label>
                         </div>
                         
                         <select class="selectpicker" id="skiils_achievments_awards" name="skill_type" rel="notice">
                          <option value="">Select Item</option>
                          <option value="Skills">Skills</option>
                          <option value="Achievment">Achievments</option>
                          <option value="Award">Awards</option>
                        </select>
                         
                         <span class="error" id="b_skilltype"></span>
                         
                         <div class="row">
                         <div class="col-sm-12 text-left">
                         <label>Description</label>
                         </div>
                         <div class="col-md-12">
                         <textarea class="form-control rounded-0" id="frm_skilldetail" rows="3" placeholder="Description"></textarea>
                         </div>
                         </div>
                         <span class="error" id="b_skilldetail"></span>
                         
                         <div class="row col-sm-12 text-left">
                         <label>Completion Date</label>
                         </div>
                         <div class="row">
                         <div class="col-md-12" id="skillcompletionpicker-position">
                         <input type="text" style="width:100%" class="frm_skillcompletion" name="skillcompletion" placeholder="Completion Date" id="skillcompletionpicker" autocomplete="off">
                         </div>
                         </div>
                         <span class="error" id="b_skillyear"></span>
                         </div>
                           <div class="modallink mt20">
                            <div class="signup-new-customer">
                                <button type="button" id="b_v_2"  onclick="">Next Step</button>
                            </div>
                            </div>
                         </div>
                    </div>
                    <div id="fitnessity_for_business_step3">
                    <div class="pop-title employe-title">

                          <h3>Company Information</h3>

                        </div>

                        <button type="button" class="close modal-close" data-dismiss="modal">

                        <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>

                      </button>
                        
                        <div class="signup">
                        <div id='systemMessage'></div>
                        <div class="row add-more-div">
                            <div class="col-sm-6">
                                <div class="row col-sm-12 text-left">
                                 <label>Company Name<span class="color-red">*</span></label>
                                 </div>
                                <input type="text" name="Companyname" id="b_companyname" size="30" maxlength="80" placeholder="Company Name">
                                  <span class="error" id="b_cmpo"></span>
                                  
                                  
                                
                                 <div class="row col-sm-12 text-left">
                                 <label>City<span class="color-red">*</span></label>
                                 </div>
                                 <input type="text" name="City" id="b_city" size="30" placeholder="City" size="30" maxlength="80"> 
                                  <span class="error" id="b_ct"></span>
                                  <div class="row col-sm-12 text-left">
                                 <label>Zip Code<span class="color-red">*</span></label>
                                 </div>
                                 <input type="number" name="Zip Code" id="b_zipcode" size="30" placeholder="Zip Code">
                                  <span class="error" id="b_zip"></span>
                                  
                                  
                                  <div class="row col-sm-12 text-left">
                                 <label>EIN Number<span class="color-red">*</span></label>
                                 </div>
                                 <input type="text" name="b_EINnumber" maxlength="10" id="b_EINnumber" maxlength="10"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="EIN Number">
                                 <span class="error" id="b_ein"></span>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="row col-sm-12 text-left">
                                 <label>Address<span class="color-red">*</span></label>
                                 </div>
                                 <input type="text" name="Address" id="b_address" placeholder="Address">
                                  <span class="error" id="b_addr"></span>
                                  <div class="row col-sm-12 text-left">
                                 <label>State<span class="color-red">*</span></label>
                                 </div>
                                <input type="text" name="State" id="b_state" size="30" placeholder="State" size="30" maxlength="80">
                                  <span class="error" id="b_sta"></span>
                                  
                                <div class="row col-sm-12 text-left">
                                 <label>Country<span class="color-red">*</span></label>
                                 </div>
                                 <input type="text" name="Country" value="" id="b_country" size="30" placeholder='Country'>
                                 
                                  <span class="error" id="b_cont"></span>
                                <div class="row col-sm-12 text-left">
                                 <label>Establishment Year<span class="color-red">*</span></label>
                                 </div>
                                 <input type="number" name="b_Establishmentyear" id="b_Establishmentyear" size="30" maxlength="4" placeholder="Establishment Year" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                              <span class="error" id="b_estb"></span>
                            </div>
                            
                          </div>
                            <div class="text-right">
                            <button type="button" class="btn btn-secondary add-more">Add More</button>
                            </div>
                        </div>
                        
                    </div>
                    </div>
                    </div>
                </div>
             </div>



          <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 nw-user-detail">

            <h1 class="nw-user-nm">
                <span>{{ $UserProfileDetail['firstname']." ".$UserProfileDetail['lastname'] }} </span>
            <span style="display: inline-flex;float: right;">
                 <!--<button href="/reviews" class="nw-view-profile">Write a review</button>-->
                <a href="/reviews" class="button">Write a review</a>
                 </span>
            </h1>

            

            <div class="nw-user-edit">
             <div class="edit-wrp text-right">
                @can('profile_edit_access')

                  <a href="javascript::void(0);" style="float: right" data-toggle="modal" data-target="#editProfileDetailModal">

                    <i class="fa fa-pencil"></i> Edit Personal Info

                  </a>
                  

                @endcan
                  <a href="{{url('/profile/createProfileSecurity')}}"><i class="fa fa-pencil"></i> Add/Edit Security Questions</a>
                  
                  <a href="{{url('/profile/change-password')}}" >Change Password</a>
             </div>


              @if($UserProfileDetail['role'] == "business")

                <div class="nw-dtl-edit">

                  <span class="nw-label">Company Name:</span>

                  <span id="display_user_company">{{ $UserProfileDetail['dba_business_name'] }}</span>

                </div>

              @endif

              <div class="nw-dtl-edit">

                <span class="nw-label">Name:</span>

                <span id="display_user_name">{{ $UserProfileDetail['firstname'] }} {{ $UserProfileDetail['lastname']}}</span>

              </div>

              <div class="nw-dtl-edit">

                <span class="nw-label">User Name :</span>

                <span >@if(isset($UserProfileDetail['username'])) {{ $UserProfileDetail['username']}} @else - @endif</span>

              </div>

              <!--<div class="nw-dtl-edit">-->

              <!--  <span class="nw-label">Gender :</span>-->

              <!--  <span id="display_user_gender">@if(isset($UserProfileDetail['gender'])) {{ $UserProfileDetail['gender']}} @else - @endif</span>-->

              <!--</div>-->

              <div class="nw-dtl-edit">

                <span class="nw-label">Email : </span><span>{{ $UserProfileDetail['email'] }}</span>

              </div>

              <div class="nw-dtl-edit">

                <span class="nw-label" id="display_user_phone">Phone : </span><span> @if(isset($UserProfileDetail['phone_number'])) {{ $UserProfileDetail['phone_number'] }} @else - @endif</span>

              </div>

              <div class="nw-dtl-edit">

                <span class="nw-label">Address :  </span>

                <span class="nw-detail-txt" id="display_user_address">

                  @if(isset($UserProfileDetail['address'])) {{ $UserProfileDetail['address'] }} @else - @endif

                  <br>

                  @if(isset($UserProfileDetail['city']) && @$cities[$UserProfileDetail['city']]) {{ $cities[$UserProfileDetail['city']] }}, @endif @if(isset($UserProfileDetail['state']) && @$states[$UserProfileDetail['state']]) {{ $states[$UserProfileDetail['state']] }} @endif @if(isset($UserProfileDetail['zipcode'])) {{ $UserProfileDetail['zipcode'] }} @endif

                  <br>

                  @if(isset($UserProfileDetail['country']) && @$countries[$UserProfileDetail['country']]) {{ $countries[$UserProfileDetail['country']] }}  @endif                

                  <div class="clearfix"></div>

                  <a href="#"><i class="fa fa-phone"></i></a><a href="#"><i class="fa fa-map-marker"></i></a><a href="#"><i class="fa fa-envelope"></i></a>

                </span>

              </div>
              
               <div class="nw-dtl-edit">

                <span class="nw-label">Intro : </span>
                <span> @if(isset($UserProfileDetail['intro'])) {!! nl2br(@$UserProfileDetail['intro']) !!} @else - @endif</span>

              </div>

              <div class="nw-dtl-edit">

                <span class="nw-label" id="display_user_phone">About : </span><span> @if(isset($UserProfileDetail['about_me'])) {!! nl2br(@$UserProfileDetail['about_me']) !!} @else - @endif</span>

              </div>



            </div>


          </div>


<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nw-user-detail">
     <a href="javascript: void(0);" style="float: right" data-toggle="modal" id="addFamily" data-target="#addFamilyDetailModal"><i class="fa fa-plus"></i> Add Family Member</a>
    </div>          

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nw-user-detail addfamily-membr-table" style="overflow-x: auto;">
<!--<div class="datepicker-position">-->
<!--<input  id="datepicker-on-change" type="text" class="form-control" data-zdp_readonly_element="false">                                -->
<!--</div>-->
             
              <!--<a href="javascript: void(0);" style="float: right" id="uplogradProfileBtn"><i class="fa fa-plus"></i>UpgradeProfile</a>-->
             
              @if($UserProfileDetail['role'] == 'customer')

                <table class="table">

                  <thead>

                    <tr>

                     

                      <th scope="col" id="uplogradProfileBtn">Name</th>

                      <th scope="col">Relationship</th>

                      <th scope="col">Email</th>

                      <th scope="col">Emergency Contact</th>

                      <th scope="col">Mobile</th>

                      <th scope="col">Gender</th>

                      <th scope="col">Action</th>

                      <th scope="col">Birthday</th>

                      

                    </tr>

                  </thead>

                  <tbody>

                      @if(count($family) == 0)

                       <tr>

                           <td colspan="8"><h3 class="nw-user-nm text-center">Family Details not added yet.</h3></td>

                        </tr>

                      @else

                      @foreach($family as $value)

                    <tr>

                      

                      <td>{{$value->first_name}} {{$value->last_name}}</td>

                      <td>{{$value->relationship}}</td>

                      <td>{{$value->email}}</td>

                      <td>{{$value->emergency_contact}}</td>

                      <td>{{$value->mobile}}</td>

                      <td>{{$value->gender}}</td>

                      <td><a href="javascript: void(0);" data-toggle="modal" data-target="#addFamilyDetailModal"><i class="fa fa-pencil family_edit" user_id="{{$value}}" style="color: #f53b49"></i></a> 
                      <a href="javascript: void(0);" ><i class="fa fa-trash family_delete" user_id="{{$value->id}}" style="color: #f53b49"></i></a></td>

                      <td style="display: flex!important;">{{ date('m-d-Y', strtotime($value->birthday)) }}</td>

                      

                    </tr>

                    @endforeach

                    @endif

                  </tbody>

                </table>

              @endif

          </div>



                <!-- Modal -->

                <div class="modal fade" id="editProfileDetailModal" role="dialog">

                  <!-- <form  id="frmeditProfileDetail" method="post"> -->

                  {!! Form::open(array('id' => 'frmeditProfileDetail')) !!}



                  <input type="hidden" name="_token" value="{{ csrf_token() }}">



                  <div class="modal-dialog modal-lg">

                    <!-- Modal content-->

                    <div class="modal-content">

                      <div class="modal-body login-pad">

                        <div class="pop-title employe-title">

                          <h3>EDIT Personal Infoqqq</h3>

                        </div>

                        <button type="button" class="close modal-close" data-dismiss="modal">

                          <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>

                        </button>



                        <div class="signup">

                          <div id='systemMessage_detail'></div>

                          <div class="emplouyee-form">

                            <input type="text" name="firstname" id="frm_firstname" placeholder="First Name">

                            <input type="text" name="lastname" id="frm_lastname" placeholder="Last Name">
                            
                             <input type="text" name="username" id="frm_username" placeholder="User Name">

                            <?php $gender = array ('' => 'Select Gender','Male' => 'Male', 'Female' => 'Female'); ?>

                            <div class="select-style review-select2">

                                {!! Form::select('gender', $gender, $UserProfileDetail['gender'], ['class' => 'selectpicker', 'id' => 'frm_gender']) !!}

                            </div>

                            <input type="text" name="email" id="frm_email" placeholder="Email" readonly class="disable-input">



                            <!-- <input type="text" name="phone_number" id="frm_phone_number" placeholder="(XXX) XXX XXX" value=""> -->

                            <input type="text" name="phone_number" required placeholder="(xxx)xxx-xxxx" class="form-control" data-inputmask='"mask": "(999)999-9999"' data-mask value="{{ old('phone_number',$UserProfileDetail['phone_number']) }}">

                            

                            <input type="text" name="address" id="frm_address" placeholder="Address" maxlength="255">
                            
                            <div class="select-style review-select2">

                              {!! Form::select('state',$states,$UserProfileDetail['state'],array('id'=>'frm_state', 'class' => 'selectpicker'));!!}

                            </div>

                            <div class="select-style review-select2">

                              {!! Form::select('city', $cities,$UserProfileDetail['city'],array('id'=>'frm_city', 'class' => 'selectpicker'));!!} 

                            </div>

                            <div class="select-style review-select2">

                              <input type="hidden" name="country" id="frm_country">

                              {!! Form::select('country_dd', $countries,$UserProfileDetail['country'],array('id'=>'frm_country_dd', 'disabled' => 'disabled', 'class' => 'selectpicker'));!!} 

                            </div>



                            <input type="text" name="zipcode" id="frm_zipcode" placeholder="Zipcode" maxlength="6">

                            <textarea placeholder="Intro ..." name="intro" id="message_area" rows="7" maxlength="120" required>@if(isset($UserProfileDetail['intro'])){!! $UserProfileDetail['intro'] !!}@endif</textarea>
                           <p>
                            <span class="hint" style="color:red" id="textarea_message">
                                </p>

                            <textarea placeholder="Tell Us Somthing About You..." name="about_me" id="about_msg" rows="7" maxlength="300" required>@if(isset($UserProfileDetail['about_me'])){!! $UserProfileDetail['about_me'] !!}@endif</textarea>
                            
                             <p>
                            <span class="hint" style="color:red" id="aboutarea_message">
                                </p>



                            <button type="submit" id="submit_profiledetail" onclick="$('#frmeditProfileDetail').submit();">Submit</button>

                          </div>

                        </div>

                    </div>

                  </div>

                  

                </div>

                {!! Form::close() !!}

                <!-- </form> -->

              </div>

              

              

              <!-- Modal -->

                <div class="modal fade" id="addFamilyDetailModal" role="dialog">

                  <!-- <form  id="frmeditProfileDetail" method="post"> -->

                  {!! Form::open(array('id' => 'frmaddFamilyDetail')) !!}



                  <input type="hidden" name="_token" value="{{ csrf_token() }}">



                  <div class="modal-dialog modal-lg">

                    <!-- Modal content-->

                    <div class="modal-content">

                      <div class="modal-body login-pad">

                        <div class="pop-title employe-title">

                          <h3 id="familyModal">Add Family Member Info</h3>

                        </div>

                        <button type="button" class="close modal-close" data-dismiss="modal">

                          <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>

                        </button>



                        <div class="signup">

                          <div id='systemMessage_detail'></div>

                          <div class="emplouyee-form">

                             <div class="row">
                            <div class="col-sm-4">
                            <label for="usr" class="lbl">First Name:</label>
                            </div>
                            <div class="col-sm-8">
                            <input type="text" name="first_name" id="frm1_firstname" placeholder="First Name">
                            </div>
                            </div>
                            
                            <div class="row">
                            <div class="col-sm-4">
                            <label for="usr" class="lbl">Last Name:</label>
                            </div>
                            <div class="col-sm-8">
                            <input type="text" name="last_name" id="frm1_lastname" placeholder="Last Name">
                            </div>
                            </div>

                            <div class="row">
                            <div class="col-sm-4">
                            <label for="usr" class="lbl">Gender Name:</label>
                            </div>
                            <div class="col-sm-8">
                            <div class="select-style review-select2">

                                {!! Form::select('gender', $gender,null, ['class' => 'selectpicker', 'id' => 'frm1_gender']) !!}

                            </div>
                            </div>
                            </div>

                        
                           

                           <input type"hidden" style="display:none;" name="family_id" id="family_id" value="0" />
<div class="row">
                            <div class="col-sm-4">
                            <label for="usr" class="lbl">Email:</label>
                            </div>
                            <div class="col-sm-8">
                            <input type="text" name="email" id="frm1_email" placeholder="Email">
                            </div>
                            </div>
                            
                            <div class="row">
                            <div class="col-sm-4">
                            <label for="usr" class="lbl">Relationship:</label>
                            </div>
                            <div class="col-sm-8">
                            <?php $relationship = array ('' => 'Select Relationship','Brother' => 'Brother', 'Sister' => 'Sister','Father' => 'Father', 'Mother' => 'Mother','Wife' => 'Wife'
                            ,'Husband' => 'Husband','Son' => 'Son','Daughter' => 'Daughter'); ?>

                            <div class="select-style review-select2">

                                {!! Form::select('relationship', $relationship, null, ['class' => 'selectpicker', 'id' => 'frm1_relationship']) !!}

                            </div>
                            </div>
                            </div>
                            
                            <div class="row">
                            <div class="col-sm-4">
                            <label for="usr" class="lbl">Birthday:</label>
                            </div>
                            <div class="col-sm-8" id="datepicker-position">
                                <input type="text" class="form-control" autocomplete="off" name="birthday"   placeholder="Birthday" id="frm1_birthday" />
                            <!--<input type="text" autocomplete="off" name="birthday" id="my_date_picker" placeholder="Birthday">-->
                            
                         
                            
                            </div>
                            </div>

                            

                            <!-- <input type="text" name="phone_number" id="frm_phone_number" placeholder="(XXX) XXX XXX" value=""> -->
<div class="row">
                            <div class="col-sm-4">
                            <label for="usr" class="lbl">Mobile:</label>
                            </div>
                            <div class="col-sm-8">
                            <input type="text" name="mobile" maxlength="10" id="frm1_mobile" required placeholder="Mobile" />
                            </div>
                            </div>
                            
                            <div class="row">
                            <div class="col-sm-4">
                            <label for="usr" class="lbl">Emergency Contact:</label>
                            </div>
                            <div class="col-sm-8">
                            <input type="text" name="emergency_contact" maxlength="10" id="frm1_emergency_contact" placeholder="Emergency Contact" />
                            </div>
                            </div>

                            
                            <button type="button" id="submit_familydetail">Submit</button>

                          </div>

                        </div>

                    </div>

                  </div>

                  

                </div>

                {!! Form::close() !!}

                <!-- </form> -->

              </div>



          <div class="nw-user-detail-line"></div>

        </div>

      </div>

      <div class="clearfix"></div>      



    </div>



  </div>



  @include('includes.sidebar_profile_right')



</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
<link href="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/css/default/zebra_datepicker.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<link href="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.css" rel="stylesheet"/>
<script src="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.15/zebra_datepicker.src.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>


<script>
    $(document).ready(function(){
        $('.coemail').attr('href',"{{'mailto:'.$UserProfileDetail['email']}}")
        $('.cophone').attr('href',"{{'tel:'.$UserProfileDetail['phone_number']}}")
        $('.coaddress').attr('href',"{{'http://maps.google.com/?q='.$UserProfileDetail['address']}}")
        $('.prfl-nme').html('')
        if(window.location.href.split('?').pop() == 'companyCreate=1'){
            $('#create_company_btn').click()
        }
        
        $("#resetPassword").click(function(){
             formdata = new FormData();
            var token = '{{csrf_token()}}';
            var email = '{{Auth::user()->email}}';
            formdata.append("_token",token)
            formdata.append("email",email)
            $.ajax({

          url:'/password/email',

          type:'POST',

          dataType: 'json',

          data:formdata,
          processData:false,
                  contentType:false,

          beforeSend: function () {

           // $('#submit_profiledetail').prop('disabled', true);

          },

          complete: function () {

           // $('#submit_profiledetail').prop('disabled', false);

          },

          success: function (response) {

            showSystemMessages('#systemMessage_detail', response.type, response.msg);
          }
        });
        })
        
        $('#datepicker-on-change').Zebra_DatePicker({
        default_position: 'below',
        container : $('.datepicker-position')      
});
        //$('#frm1_birthday').Zebra_DatePicker();
        $('#frm1_birthday').Zebra_DatePicker({
        default_position: 'below',
        direction:-1,
        format: 'm-d-Y',
        container : $('#datepicker-position')      
});
        // $('#frm1_birthday').multiDatesPicker({
        //     dateFormat: "yy-mm-dd", 
        //      onSelect: function(dateText, inst) { $("#frm1_birthday").val(dateText) }
        // });
    //   $('#markcalendar').click(function() {
    //       $("#mdp-demo").focus();
    //     });
    })
</script>
<script> 

    $(function() { 

        $( "#my_date_picker" ).datepicker({ 

             format: 'yy/mm/dd',

        }); 

    }); 

</script>

<script>
    
    //console.log()
    $(document).on('click', '.delete', function(){ 
        var j = $(this).attr('num')
        var hell = $('.add-more-div').toArray();
        hell[j].remove();
        console.log($(this).attr('num'))
    });
    
    $('.add-more').click(function(){
        var lastcount = $('.delete').length + 1;
        var html = '<div class="row add-more-div"><hr />'
                            +'<div class="col-sm-6">'
                                +'<div class="row col-sm-12 text-left">'
                                 +'<label>Company Name<span class="color-red">*</span></label>'
                                +' </div>'
                                +'<input type="text" name="Companyname" id="b_companyname" size="30" maxlength="80" placeholder="Company Name">'
                                +' <span class="error" id="b_cmpo"></span>'
                                + '<div class="row col-sm-12 text-left">'
                                + '<label>City<span class="color-red">*</span></label>'
                                + '</div>'
                                + '<input type="text" name="City" id="b_city" size="30" placeholder="City" size="30" maxlength="80"> '
                                + '<span class="error" id="b_ct"></span>'
                                +  '<div class="row col-sm-12 text-left">'
                                + '<label>Zip Code<span class="color-red">*</span></label>'
                                + '</div>'
                                + '<input type="number" name="Zip Code" id="b_zipcode" size="30" placeholder="Zip Code">'
                                + '<span class="error" id="b_zip"></span>'
                                  +'<div class="row col-sm-12 text-left">'
                                 +'<label>EIN Number<span class="color-red">*</span></label>'
                                 +'</div>'
                                 +'<input type="text" name="b_EINnumber" maxlength="10" id="b_EINnumber" maxlength="10"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="EIN Number">'
                                 +'<span class="error" id="b_ein"></span>'
                            +'</div>'
                            
                            +'<div class="col-sm-6">'
                                +'<div class="row col-sm-12 text-left">'
                                +' <label>Address<span class="color-red">*</span></label>'
                                +' </div>'
                                +' <input type="text" name="Address" id="b_address" placeholder="Address">'
                                 +' <span class="error" id="b_addr"></span>'
                                 +' <div class="row col-sm-12 text-left">'
                                +' <label>State<span class="color-red">*</span></label>'
                                +' </div>'
                                +'<input type="text" name="State" id="b_state" size="30" placeholder="State" size="30" maxlength="80">'
                                  +'<span class="error" id="b_sta"></span>'
                                  
                                +'<div class="row col-sm-12 text-left">'
                                 +'<label>Country<span class="color-red">*</span></label>'
                                 +'</div>'
                                 +'<input type="text" name="Country" value="" id="b_country" size="30" placeholder="Country">'
                                 
                                  +'<span class="error" id="b_cont"></span>'
                                +'<div class="row col-sm-12 text-left">'
                                 +'<label>Establishment Year<span class="color-red">*</span></label>'
                                 +'</div>'
                                 +'<input type="number" name="b_Establishmentyear" id="b_Establishmentyear" size="30" maxlength="4" placeholder="Establishment Year" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">'
                              +'<span class="error" id="b_estb"></span>'
                            +'</div>'
                            +'<div class="text-right">'
                            +'<button type="button" class="btn btn-secondary delete" num="'+lastcount+'">Delete</button>'
                            +'</div>'
                          +'</div>'
                          $("div.add-more-div:last").after(html);
                          lastcout = lastcount+1;
    })
    
    $('#b_v_2').click(function(){
    $(".error").empty();
    if($("#frm_organisationname").val()!=''){
    if($("#frm_position").val()!=''){
    if($("#dp1").val()!=''){
    if($("#dp2").val()!=''){
    if($("#frm_course").val()!=''){
    if($("#frm_university").val()!=''){
        if($("#passingyear").val()!=''){
                if($("#certification").val()!=''){
                    if($("#completionyear").val()!=''){
                            if($("#skiils_achievments_awards").val()!=''){
                                if($("#skillcompletionpicker").val()!=''){
                                    $('#fitnessity_for_business_step2').hide();$('#fitnessity_for_business_step3').show();
                                }else{
                                    $("#b_skillyear").text("Please Enter the skill completion date");       
                                }
                            }else{
                                $("#b_skilltype").text("Please select skill type");   
                            }
                    }else{
                        $("#b_certificateyear").text("Please Enter the Certication completion date");
                    }
                }else{
                    $("#b_certification").text("Please Enter the certification");
                }
            }else{
    $("#b_year").text("Please select passing year ");
            }
    
    }else{
    $("#b_university").text("Please Enter the university ");
    }
    }else{
    $("#b_degree").text("Please enter the course ");
    }
    }else{
    $("#b_employmentto").text("Please enter the to date ");
    }
    }else{
    $("#b_employmentfrom").text("Please enter the from date ");
    }
    }else{
    $("#b_position").text("Please enter the position ");
    }
    }else{
    $("#b_organisationname").text("Please enter the organisation name ");
    }
    
    });
    $("label.present_work_btn").click(function() {
        $("#frm_ispresentcheck").attr("checked", !$("#frm_ispresentcheck").attr("checked"));
        changeDateBasedonPresent();
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
    
//     $('#passingyear').Zebra_DatePicker({
//          view: 'years',
//          format: 'Y',
//         default_position: 'below',
//         container : $('#passingpicker-position')      
// });
$('#dp1').Zebra_DatePicker({
        default_position: 'below',
        container : $('#dp1-position')      
});$('#dp2').Zebra_DatePicker({
        default_position: 'below',
        container : $('#dp2-position')      
});
      $('#completionyear').Zebra_DatePicker({
        default_position: 'below',
        container : $('#completionpicker-position')      
});
$('#skillcompletionpicker').Zebra_DatePicker({
        default_position: 'below',
        container : $('#skillcompletionpicker-position')      
});
    $('#uplogradProfileBtn').click(function(){
         $('#upgradeProfileForm').modal('show'); 
        //         $.ajax({

        //   url:'customer/upgradeProfile/{{Auth::user()->upgrade_profile_link}}',
        //   type:'GET',
        // success: function (response) {
        //     if(response.type === 'success'){
        //             $('#upgradeProfileForm').modal('show'); 
        //       }else{
        //           showSystemMessages('#systemMessage', response.type, response.msg);
        //       }

        //     }

        // });
    })

    $(".family_edit").click(function(){

        var data = JSON.parse($(this).attr('user_id'))

       $('#family_id').val(data.id)

        $('#frm1_firstname').val(data.first_name)

        $('#frm1_lastname').val(data.last_name)

        $('#frm1_email').val(data.email)

        $('#frm1_mobile').val(data.mobile)

        $('#frm1_emergency_contact').val(data.emergency_contact)

        $('#frm1_gender').val(data.gender)

        $('#frm1_relationship').val(data.relationship)
console.log(moment("YYYY-MM-DD",data.birthday))
        $('#frm1_birthday').val(moment(data.birthday,"YYYY-MM-DD").format("MM-DD-YYYY"))

        $('#familyModal').text('Edit Family Detail')

    })

    $("#addFamily").click(function(){

        //var data = JSON.parse($(this).attr('user_id'))

        $('#family_id').val(0)

        $('#frm1_firstname').val('')

        $('#frm1_lastname').val('')

        $('#frm1_email').val('')

        $('#frm1_mobile').val('')

        $('#frm1_gender').val('')

        $('#frm1_relationship').val('')

        $('#frm1_birthday').val('')

        $('#frm1_emergency_contact').val('')

        $('#familyModal').text('Add Family Detail')

    })

    

    $(".family_delete").click(function(){

        var family_id = $(this).attr('user_id')

        swal({

              title: "Are you sure?",

              text: "You want to delete this family member!",

              icon: "warning",

              buttons: [

                'Cancel',

                'Delete'

              ],

              dangerMode: true,

            }).then(function(isConfirm) {

              if (isConfirm) {

                $.ajax({

                  url:'/family-member-delete/'+family_id,

                  type:'GET',

                  beforeSend: function () {

                   // $('#register_submit').prop('disabled', true);

                    showSystemMessages('#systemMessage', 'info', 'Please wait while we delete family member with Omnebook.');

                  },

                  complete: function () {

                    //$('#register_submit').prop('disabled', true);

                  },

                  success: function (response) {

                      showSystemMessages('#systemMessage', response.type, response.msg);

                      if(response.type === 'success'){

                        window.location.reload();

                      }else{

                       // $('#register_submit').prop('disabled', false);    

                      }

                    }

                });

              } else {

                swal("Cancelled", "Your data is safe");

              }

            })

    })



  $(function () {

        // for mobile no.

        $('[data-mask]').inputmask()

    })

//    var phonecode = '<?php //echo $phonecode; ?>';

    $('#country').change(function(){

        var country_code = $('#frm_country').val();    

        if(country_code){

            $.ajax({

               type:"GET",

               url:"{{url('/get-state-list')}}?country_code="+country_code,

               success:function(res){               

                if(res){

                    $("#frm_state").empty();

                    $("#frm_state").append('<option>Select</option>');

                    $.each(res,function(key,value){

                        $("#frm_state").append('<option value="'+key+'">'+value+'</option>');

                    });



                }else{

                   $("#frm_state").empty();

                }

               }

            });

        }else{

            $("#frm_state").empty();

            $("#frm_city").empty();

        }

    });

    $('#frm_state').on('change',function(){

        var state_id = $(this).val();    

        if(state_id){

            $.ajax({

               type:"GET",

               // url: '/get-city-list/'+state_id,

               url:"{{url('/get-city-list')}}?state_id="+state_id,

               success:function(res){               

                if(res){

                    $("#frm_city").empty();

                    $.each(res,function(key,value){

                        $("#frm_city").append('<option value="'+key+'">'+value+'</option>');

                    });



                }else{

                   $("#frm_city").empty();

                }

               }

            });

        }else{

            $("#frm_city").empty();

        }        

   });

//   $("#frm_phone_number").keydown(function(e) {

//        var field=this;

//        setTimeout(function () {

//            if(field.value.indexOf(phonecode) !== 0) {

//                $(field).val(phonecode);

//            } 

//        }, 1);

//    });

   

    var form = document.querySelector('form');



    // edit profile picture

    $('#frmeditProfile').submit(function(e) {

      e.preventDefault();

      $('#frmeditProfile').validate({

          rules: {

              profile_pic: {

               required: true,

               accept: "image/*"   

              },

          },

          messages: {

              profile_pic: {

                  required: "Upload a Profile picture",

                  accept: "Please upload an image"

              },

          }

      });

      if(!$('#frmeditProfile').valid()) {

          return false;

      }

      var inputData = new FormData($(this)[0]);

      $.ajax({

        url:'/profile/editProfilePicture',

        type:'POST',

        dataType: 'json',

        data:inputData,

        processData:false,

        contentType:false,

        beforeSend: function () {

          $('#submit_profilepic').prop('disabled', true);

        },

        complete: function () {

          $('#submit_profilepic').prop('disabled', false);

        },

        success: function (response) {                      
console.log('dfsfddsf')
              if (response.type == 'success') {
                  showSystemMessages('#systemMessage', 'success', 'Profile updated scuccessfully');

                  // $("#display_user_profile_pic").attr("src", response.returndata.profile_pic);

                  // $(".display_user_profile_pic_view_profile").attr("src", response.returndata.profile_pic);

                  $(".display_user_profile_pic_view_profile").each(function(){

                    $(this).attr("src", response.returndata.profile_pic);

                  });

                  

                  $('#editProfilePic').modal('hide');

              }else {

                  showSystemMessages('#systemMessage', response.type, response.msg);

              }

          }

      });

    });

    

    // fill modal form with user details

    var UserProfileDetail = <?php echo json_encode($UserProfileDetail); ?>;

  var ProfessionalDetail = <?php echo json_encode($UserProfileDetail['ProfessionalDetail']); ?>;



    $("#editProfileDetailModal").on("show.bs.modal", function(){

        $('#editProfileDetailModal').find('#frm_firstname').val(UserProfileDetail.firstname);

        $('#editProfileDetailModal').find('#frm_lastname').val(UserProfileDetail.lastname);
        
         $('#editProfileDetailModal').find('#frm_username').val(UserProfileDetail.username);

        $('#editProfileDetailModal').find('#frm_gender').val(UserProfileDetail.gender);

        $('#editProfileDetailModal').find('#frm_email').val(UserProfileDetail.email);

        $('#editProfileDetailModal').find('#frm_phone_number').val(UserProfileDetail.phone_number);

        $('#editProfileDetailModal').find('#frm_address').val(UserProfileDetail.address);

        if(UserProfileDetail.state != null) {

            $('#editProfileDetailModal').find('#frm_state').val(UserProfileDetail.state);

            $('#frm_state').change(function() {

                if(UserProfileDetail.city != null)

                    $('#editProfileDetailModal').find('#frm_city').val(UserProfileDetail.city);

            });

        }        

        $('#editProfileDetailModal').find('#frm_country').val(UserProfileDetail.country);

        $('#editProfileDetailModal').find('#frm_zipcode').val(UserProfileDetail.zipcode);

        

    });

    $("#submit_familydetail").click(function(){

        $('#frmaddFamilyDetail').submit()

    })

    // validate user detail form

    $('#frmeditProfileDetail').submit(function(e) {

        e.preventDefault();

        // check for validation

        $('#frmeditProfileDetail').validate({

          rules: {

            company_name: {

              required: true

            },

            firstname: {

              required: true

            },

            lastname: {

              required: true

            },

            gender: {

              required: true

            },

             phone_number: {

               // phoneUS: true

             },

            address: {

              required: true

            },

            city: {

              required: true

            },

            state: {

              required: true

            },

            zipcode: {

              required: true

            },
            intro:{
                required:true
            },

            about_me: {

              required: true

            },

          },

          messages: {

            company_name: {

              required: "Provide a company name",

            },

            firstname: {

              required: "Provide a first name",

            },

            lastname: {

              required: "Provide a last name",

            },
             username: {

              required: "Provide a last name",

            },

            gender: {

              required: "Select a Gender",

            },

             phone_number: {

                // phoneUS: "Phone number format is invalid. Please enter phone in format of (XXX) XXX XXX",



             },

            address: {

              required: "Provide an adderess",

            },

            city: {

              required: "Provide a city",

            },

            state: {

              required: "Provide a state",

            },

            zipcode: {

              required: "Provide a zipcode",

            },
            
            intro: {

              required: "Provide a intro",

            },

            about_me: {

              required: "Provide about me",

            },

          },

        submitHandler: saveProfileDetail

        });

    });

    

    // $("#submit_familydetail").click(function(){

    //       console.log("called2")

    //     $('#frmaddFamilyDetail').submit();

    //   });

    

      // validate user detail form

    $('#frmaddFamilyDetail').submit(function(e) {

        //console.log("callled")

        e.preventDefault();

        // check for validation

        $('#frmaddFamilyDetail').validate({

          rules: {

            first_name: {

              required: true

            },

            last_name: {

              required: true

            },

            gender: {

              required: true

            },
            // email:{
            //     required:true
            // },
            relationship: {

              required: true

            },
 
            birthday: {

              required: true

            },

             mobile: {

                 required:true,
                 maxlength: 10,

                    minlength: 10,

               // phoneUS: true

             },

           

            emergency_contact: {

                    maxlength: 10,

                    minlength: 10,

                  },

          },

          messages: {

            mobile: {

              required: "Provide a phone number",
              minlength: "Please enter a valid contact number",

                    maxlength: "Please enter a valid contact number",

            },

            first_name: {

              required: "Provide a first name",

            },

            last_name: {

              required: "Provide a last name",

            },

            gender: {

              required: "Select a Gender",

            },

            relationship: {

              required: "Select relationship",

            },

            birthday: {

              required: "Select Birthdate",

            },
            // email: {

            //   required: "Email field is required",

            // },

            emergency_contact: {

                   minlength: "Please enter a valid contact number",

                    maxlength: "Please enter a valid contact number",

                },

          },

        submitHandler: saveFamilyDetail

        });

    });

    // save user profile



    // add US phone number validation

    $(document).ready(function(){

          jQuery.validator.addMethod("phoneUS", function(phone_number, element) {

                  phone_number = phone_number.replace(/\s+/g, "");

//                  phone_number = phone_number.replace(phonecode, ""); 

                  console.log(phone_number);

                  return this.optional(element) || phone_number.length > 9 &&

                          phone_number.match(/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/);

          }, "Please specify a valid phone number");
          
          
          $('#mdp-demo').multiDatesPicker();
      $('#mdp-demo').click(function() {
          $("#mdp-demo").focus();
        });

    });



    // save user profile

    function saveProfileDetail()

    {

      if ($('#frmeditProfileDetail').valid()) {

        var formData = $("#frmeditProfileDetail").serialize();

        $.ajax({

          url:'/profile/editProfileDetail',

          type:'POST',

          dataType: 'json',

          data:formData,

          beforeSend: function () {

            $('#submit_profiledetail').prop('disabled', true);

          },

          complete: function () {

            $('#submit_profiledetail').prop('disabled', false);

          },

          success: function (response) {

            showSystemMessages('#systemMessage_detail', response.type, response.msg);

            console.log(response);

            if (response.type == 'success') {

              setTimeout( function(){

                  location.reload();

                }, 1000);

                // window.location = "/profile/viewProfile";

            }

          }

        });

      }

    }

    

     

    function saveFamilyDetail()

    {

      if ($('#frmaddFamilyDetail').valid()) {

        var formData = $("#frmaddFamilyDetail").serialize();

        $.ajax({

          url:'/add-family-detail',

          type:'POST',

          dataType: 'json',

          data:formData,

          beforeSend: function () {

            $('#submit_familydetail').prop('disabled', true);

          },

          complete: function () {

            $('#submit_familydetail').prop('disabled', false);

          },

          success: function (response) {

            showSystemMessages('#systemMessage_detail', response.type, response.msg);

            console.log(response);

            if (response.type == 'success') {

              setTimeout( function(){

                  location.reload();

                }, 1000);

                // window.location = "/profile/viewProfile";

            }
        

          }

        });

      }

    } 

    </script>
<script>
$('textarea#message_area').on('keyup',function() 
{
  var maxlen = $(this).attr('maxlength');
  
  var length = $(this).val().length;
  if(length > (maxlen-10) ){
    $('#textarea_message').text('max length '+maxlen+' characters only!')
  }
  else
    {
      $('#textarea_message').text('');
    }
});
</script>

<script>
$('textarea#about_msg').on('keyup',function() 
{
  var maxlen = $(this).attr('maxlength');
  
  var length = $(this).val().length;
  if(length > (maxlen-10) ){
    $('#aboutarea_message').text('max length '+maxlen+' characters only!')
  }
  else
    {
      $('#aboutarea_message').text('');
    }
});
</script>

@endsection