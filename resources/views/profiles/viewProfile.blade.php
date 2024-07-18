@inject('request', 'Illuminate\Http\Request')
@extends('layouts.profile')
@section('content')

<style>
    table.dp_monthpicker.dp_body td {
        padding: 15px !important;
    }
    #dp1-position .Zebra_DatePicker {
        width: 35%!important;
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
        z-index: 1200;
    }
    img.header_img {
        position: absolute;
        left: 0;
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
        border-radius: 0;
        color: #fff;
        font-weight: bold;
        font-size: 17px;
        float: right;
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
    /*    .avatar {*/
    /*  vertical-align: middle;*/
    /*  width: 120px;*/
    /*  height: 120px;*/
    /*  border-radius: 50%;*/
    /*}*/
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
        color: #fff !important;ava
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
    /*.Zebra_DatePicker{
      width: 100% !important;
    }*/
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

<div class="business-offer-main ">
    <?php
    $loggedinUser = Auth::user();
    $customerName = $loggedinUser->firstname . ' ' . $loggedinUser->lastname;
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
                            if ($UserProfileDetail['profile_pic'] != '' && file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR . $UserProfileDetail['profile_pic'])) {
                                echo '<img src="' . Config::get('constants.USER_IMAGE_THUMB') . $UserProfileDetail['profile_pic'] . '" width="254" height="275" id="display_user_profile_pic_view_profile" class="display_user_profile_pic_view_profile"/>';
                            } else {
                                echo '<img src="' . Config::get('constants.FRONT_IMAGE') . 'user.png" width="254" height="275" id="display_user_profile_pic_view_profile" class="display_user_profile_pic_view_profile" />';
                            }
                            ?>
                            @can('profile_edit_access')
                            <a href="javascript:void(0);" class="edit-pic" data-toggle="modal" data-target="#editProfilePic" title="Click here to change picture"><i class="fa fa-camera"></i></a>
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
                                        <h3>EDIT PROFILE PICTURE</h3>
                                    </div>
                                    <button type="button" class="close modal-close" data-dismiss="modal">
                                        <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>/close.jpg" height="70" width="34"/>
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

                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 nw-user-detail">
                        <h1 class="nw-user-nm">@if($UserProfileDetail['dba_business_name']!='') {{ $UserProfileDetail['dba_business_name'] }} @else - @endif
                            <a href="/reviews" class="button">Write a review</a>

                            @if(in_array(Auth::user()->status, array("draft", "rejected")))
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6" style="float:right;">
                                <form action="/profile/sendProfileToReview/submit_review" method="POST" onclick="return confirm('Are you sure to submit your profile to Fitnessity Review Process ?')">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button class="nw-view-profile">Submit Profile To Review</button>
                                </form>
                            </div>
                            @endif
                        </h1>
                        <div class="nw-user-edit">
                            @can('profile_edit_access')
                            <a href="javascript::void(0);" style="float: right" data-toggle="modal" data-target="#editProfileDetailModal">
                                <i class="fa fa-pencil"></i> Edit Personal Info
                            </a>
                            <br/>
                            @endcan
                            <div class="row text-right">
                                <a href="{{url('/profile/createProfileSecurity')}}"><i class="fa fa-pencil"></i> Add/Edit Security Questions</a>
                                <br/>
                                <a href="{{url('/profile/change-password')}}" >Change Password</a>
                            </div>
                            @if($UserProfileDetail['role'] == "business")
                            <!--<div class="nw-dtl-edit">-->
                            <!--  <span class="nw-label">Company Name:</span>-->
                            <!--  <span id="display_user_company">{{ $UserProfileDetail['dba_business_name'] }}</span>-->
                            <!--</div>-->
                            <div class="nw-dtl-edit">
                                <span class="nw-label">Name</span>
                                <span id="display_user_company">{{ $UserProfileDetail['full_name'] }}</span>
                            </div>
                            <div class="nw-dtl-edit">
                                <span class="nw-label">Company Representative Name</span>
                                <span id="display_user_company">{{ $firstCompany['full_name']}}</span>
                            </div>
                            <div class="nw-dtl-edit">
                                <span class="nw-label">Position</span>
                                <span id="display_user_company">@if(@$UserProfileDetail['position']!='') {{ @$UserProfileDetail['position'] }} @else - @endif</span>
                            </div>
                            @endif
                            <!--<div class="nw-dtl-edit">-->
                            <!--  <span class="nw-label">Name:</span>-->
                            <!--  <span id="display_user_name">{{ $UserProfileDetail['firstname'] }} {{ $UserProfileDetail['lastname']}}</span>-->
                            <!--</div>-->

                            <div class="nw-dtl-edit">
                                <span class="nw-label">Gender:</span>
                                <span id="display_user_gender">@if(isset($UserProfileDetail['gender'])) {{ $UserProfileDetail['gender']}} @else - @endif</span>
                            </div>
                            <div class="nw-dtl-edit">
                                <span class="nw-label">Email : </span><span>{{ $UserProfileDetail['email'] }}</span>
                            </div>
                            <div class="nw-dtl-edit">
                                <span class="nw-label" id="display_user_phone">Phone : </span><span> @if(isset($UserProfileDetail['phone_number'])) {{ $UserProfileDetail['phone_number'] }} @else - @endif</span>
                            </div>




                            @if($UserProfileDetail['role'] == "business")
                            <div class="nw-dtl-edit">
                                <span class="nw-label">Intro : </span><span style="display: contents;">@if(@$UserProfileDetail['intro']!='') {{ @$UserProfileDetail['intro'] }} @else - @endif</span>
                            </div>
                            <div class="nw-dtl-edit">
                                <span class="nw-label" id="display_user_phone">About Business : </span><span style="display:contents"> @if(isset($UserProfileDetail['about_me'])) {!! nl2br(@$UserProfileDetail['about_me']) !!} @else - @endif</span>
                            </div>
                            <div class="nw-dtl-edit">
                                <?php //if($approve[0]['status']==1){  ?>
                               <!--<span class="nw-label" id="display_user_phone">Profile Stauts : </span><span><img src="/public/images/backgroundcheck.jfif" style="width:60px"> </span>-->
                                <?php //}else{  ?>
                            <!--<span class="nw-label" id="display_user_phone">Company Verified : </span><span> : Pending </span>-->
                                <?// } ?>

                            </div>
                            @endif

                        </div>
                    </div>
                    <!-- Modal -->

                    <div class="modal fade" id="updateBusinessDetial" role="dialog">

                        <div class="modal-dialog modal-lg">

                            <!-- Modal content-->

                            <div class="modal-content">

                                <div class="modal-body login-pad">
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
                                                <input type="text" name="Companyname" class="b_companyname" size="30" maxlength="80" placeholder="Company Name">
                                                <span class="error b_cmpo" id=""></span>



                                                <div class="row col-sm-12 text-left">
                                                    <label>City<span class="color-red">*</span></label>
                                                </div>
                                                <input type="text" name="City" class="b_city" size="30" placeholder="City" size="30" maxlength="80"> 
                                                <span class="error b_ct" id=""></span>
                                                <div class="row col-sm-12 text-left">
                                                    <label>Zip Code<span class="color-red">*</span></label>
                                                </div>
                                                <input type="number" name="Zip Code" class="b_zipcode" size="30" placeholder="Zip Code">
                                                <span class="error b_zip" id=""></span>


                                                <div class="row col-sm-12 text-left">
                                                    <label>EIN Number<span class="color-red">*</span></label>
                                                </div>
                                                <input type="text" name="b_EINnumber" maxlength="10" class="b_EINnumber" maxlength="10"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="EIN Number">
                                                <span class="error b_ein" id=""></span>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="row col-sm-12 text-left">
                                                    <label>Address<span class="color-red">*</span></label>
                                                </div>
                                                <input type="text" name="Address" class="b_address" oninput="initialize1(this)" placeholder="Address">
                                                <span class="error b_addr" id=""></span>
                                                <div class="row col-sm-12 text-left">
                                                    <label>State<span class="color-red">*</span></label>
                                                </div>
                                                <input type="text" name="State" class="b_state" size="30" placeholder="State" size="30" maxlength="80">
                                                <span class="error b_sta" id=""></span>

                                                <div class="row col-sm-12 text-left">
                                                    <label>Country<span class="color-red">*</span></label>
                                                </div>
                                                <input type="text" name="Country" value="" class="b_country" size="30" placeholder='Country'>

                                                <span class="error b_cont" id=""></span>
                                                <div class="row col-sm-12 text-left">
                                                    <label>Establishment Year<span class="color-red">*</span></label>
                                                </div>
                                                <input type="number" name="b_Establishmentyear" class="b_Establishmentyear" size="30" maxlength="4" placeholder="Establishment Year" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                                <span class="error b_estb" id=""></span>
                                            </div>

                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-secondary createBusiness">Create</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                        <h3>EDIT Personal Info</h3>
                                    </div>
                                    <button type="button" class="close modal-close" data-dismiss="modal">
                                        <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>/close.jpg" height="70" width="34"/>
                                    </button>

                                    <div class="signup">
                                        <div id='systemMessage_detail'></div>
                                        <div class="emplouyee-form">
                                            @if($UserProfileDetail['role'] == "business")
                                            <input type="text" name="company_name" id="frm_company_name" placeholder="Company">
                                            @endif
                                            <input type="text" name="firstname" id="frm_firstname" placeholder="First Name">
                                            <input type="text" name="lastname" id="frm_lastname" placeholder="Last Name">
                                            <input type="text" name="username" id="frm_username" placeholder="User Name">
                                            <input type="text" name="position" id="frm_position" placeholder="Position">
                                            <?php $gender = array('' => 'Select Gender', 'Male' => 'Male', 'Female' => 'Female'); ?>
                                            <div class="select-style review-select2">
                                                {!! Form::select('gender', $gender, $UserProfileDetail['gender'], ['class' => 'selectpicker', 'id' => 'frm_gender']) !!}
                                            </div>
                                            <input type="text" name="email" id="frm_email" placeholder="Email" readonly class="disable-input">

                            <!-- <input type="text" name="phone_number" id="frm_phone_number" placeholder="(XXX) XXX XXX" value=""> -->

                                            <input type="text" name="phone_number" required placeholder="(xxx)xxx-xxxx" class="form-control" data-inputmask='"mask": "(999)999-9999"' data-mask value="{{ old('phone_number',$UserProfileDetail['phone_number']) }}">

                                            <input type="text" name="address" id="frm_address" placeholder="Address" maxlength="255">



                                            <input type="text" name="zipcode" id="frm_zipcode" placeholder="Zipcode" maxlength="6">

                                            <textarea placeholder="Intro... " name="intro" id="frm_intro" rows="7" maxlength="150">
                                 
                                     <p>
                            <span class="hint" style="color:red" id="textarea_message">
                                </p>

                            <textarea placeholder="Tell Us Somthing About You..." name="about_me" id="frm_aboutme" rows="7" maxlength="200">
                              @if(isset($UserProfileDetail['about_me'])) {!! nl2br(@$UserProfileDetail['about_me']) !!} @endif</textarea>

                                                <textarea placeholder="Tell Us Somthing About Your Business..." name="about_business" id="frm_aboutme" rows="7" maxlength="200">
                              @if(isset($UserProfileDetail['about_business'])) {!! nl2br(@$UserProfileDetail['about_business']) !!} @endif</textarea>

                                                <button type="submit" id="submit_profiledetail" onclick="$('#frmeditProfileDetail').submit();">Submit</button>
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

            @if($UserProfileDetail['role'] == "business")
            @can('profile_edit_access')
            <a href="/profile/editProfileHistory" class="pull-right"><i class="fa fa-pencil"></i> Add/Edit Profile Details</a>
            @endcan
            @endif
            <a href="javascript: void(0);" style="float: right"  id="updateBusinessDetialBtn"><i class="fa fa-plus"></i> Create business</a>
            <div class="clearfix"></div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Company Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">Country</th>
                        <th scope="col">State</th>
                        <th scope="col">City</th>
                        <th scope="col">Zip Code</th>
                        <th scope="col">EIN Number</th>
                        <th scope="col">Establishment Year</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><a href="{{url('/company/'.Auth::user()->company_name.'/0')}}">{{Auth::user()->company_name}}</a></td>
                        <td>{{Auth::user()->address}}</td>
                        <td>{{Auth::user()->country}}</td>
                        <td>{{Auth::user()->state}}</td>
                        <td>{{Auth::user()->city}}</td>
                        <td>{{Auth::user()->zipcode}}</td>
                        <td>{{Auth::user()->ein_number}}</td>
                        <td>{{Auth::user()->establishment_year}}</td>
                        <td><a href="javascript: void(0);" data-toggle="modal" data-target="#updateBusinessDetial"><i class="fa fa-pencil business_edit" business_id="{{Auth::user()}}" style="color: #f53b49"></i></a> 
                            <a href="javascript: void(0);" ><i class="fa fa-trash business_delete" business_id="user_table" style="color: #f53b49"></i></a></td>
                    </tr>
                    @if(isset($business_details))
                    @foreach($business_details as $value)
                    <tr>
                        <td><a href="{{url('/company/'.$value->dba_business_name.'/1')}}">{{$value->dba_business_name}}</a></td>
                        <td>{{$value->address}}</td>
                        <td>{{$value->country}}</td>
                        <td>{{$value->state}}</td>
                        <td>{{$value->city}}</td>
                        <td>{{$value->zip_code}}</td>
                        <td>{{$value->ein_number}}</td>
                        <td>{{$value->establishment_year}}</td>
                        <td><a href="javascript: void(0);" data-toggle="modal" data-target="#updateBusinessDetial"><i class="fa fa-pencil business_edit" business_id="{{$value}}" style="color: #f53b49"></i></a> 
                            <a href="javascript: void(0);" ><i class="fa fa-trash business_delete" business_id="{{$value->id}}" style="color: #f53b49"></i></a></td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>


            @if(Auth::user()->is_upgrade == 0 ||Auth::user()->is_upgrade == 1 )
            <div class="busines-offer-list busines-off-profile-list">

                <div class="job_block">

                    <ul id="myTab_1" class="job_topic">
                        <li class="active"><a href="#tab_employment_history" data-toggle="tab" >Work History</a></li>
                        <li><a href="#tab_education" data-toggle="tab" >Education</a></li>
                        <li><a href="#tab_certification" data-toggle="tab" >Certification</a></li>
                        <li><a href="#tab_services" data-toggle="tab" >Services</a></li>
                    </ul>

                    <div id="myTabContent" class="tab-content">          
                        <!-- employment history section -  starts -->
                        <?php $ProfessionalDetail = $UserProfileDetail['ProfessionalDetail']; ?>
                        <div id="tab_employment_history" class="tab-pane active in fade job_listing_block">
                            <div class="job_listing">
                                <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">
                                        <span></span>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">
                                        <div class="job_post_dtls">
                                            <h4>Profession Type:</h4> @if(isset($ProfessionalDetail->professional_type)) {{ ucfirst($ProfessionalDetail->professional_type) }} @else - @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">
                                        <span></span>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">
                                        <div class="job_post_dtls">
                                            <h4>Experience Level:</h4> 
                                            <?php
                                            if (isset($ProfessionalDetail->experience_level) && !empty($ProfessionalDetail->experience_level)) {
                                                $d = json_decode($ProfessionalDetail->experience_level);
                                                if (isset($experience_level)) {
                                                    foreach ($d as $experience_level) {
                                                        echo ucfirst(str_replace('_', ' ', $experience_level)) . ", ";
                                                    }
                                                }
                                            } else {
                                                echo "-";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">
                                        <span></span>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">
                                        <div class="job_post_dtls">
                                            <h4>Provides training to:</h4>
                                            @if(isset($ProfessionalDetail->train_to))
                                            <?php
                                            $train_to = json_decode($ProfessionalDetail->train_to);
                                            $i = 1;
                                            if ($train_to != null) {
                                                foreach ($train_to as $av) {
                                                    echo str_replace('_', ' ', $av) . ", ";
                                                }
                                            }
                                            ?>

                                            @else - @endif
                                        </div>
                                    </div>
                                </div>

                                <!--<div class="row">-->
                                <!--  <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">-->
                                <!--    <span></span>-->
                                <!--  </div>-->
                                <!--  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">-->
                                <!--    <div class="job_post_dtls">-->
                                <!--      <h4>Availability:</h4>-->
                                @if(isset($ProfessionalDetail->availability))
                                <?php
                                //  $availability = json_decode($ProfessionalDetail->availability); 
                                // $i=1;
                                // foreach($availability as $k => $av){
                                //   if($i % 2 == 0)
                                //   {echo ucfirst(str_replace('_',' ',$k))."-".$av."<br>";}
                                //   else{echo ucfirst(str_replace('_',' ',$k))."-".$av."  -  ";}
                                //   $i++;
                                //}
                                ?>
                                @else - @endif
                                <!--    </div>-->
                                <!--  </div>-->
                                <!--</div>-->

                                <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">
                                        <span></span>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">
                                        <div class="job_post_dtls">
                                            <h4>Willing To Travel:</h4>
                                            @if(isset($ProfessionalDetail->willing_to_travel)) {{ ucfirst($ProfessionalDetail->willing_to_travel) }}
                                            @if(isset($ProfessionalDetail->travel_miles)) , {{ $ProfessionalDetail->travel_miles }} Miles @endif
                                            @else No
                                            @endif
                                            <br>
                                            @if(isset($ProfessionalDetail->travel_times)) {{ ucfirst($ProfessionalDetail->travel_times) }}@endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">
                                        <span></span>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">
                                        <div class="job_post_dtls">
                                            <h4>Languages :</h4>
                                            @if(isset($ProfessionalDetail->languages))
                                            <?php
                                            $languages = json_decode(@$ProfessionalDetail->languages);
                                            $i = 1;
                                            foreach (@$languages as $av) {
                                                echo $av . ", ";
                                            }
                                            ?>
                                            @else - @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="nw-user-detail-line2"></div>

                            <?php $employmenthistories = $UserProfileDetail['employmenthistory']; ?>

                            @if(count($employmenthistories) > 0)
                            <div class="job_listing">
                                <div class="row">
                                    <div class="nw-user-detail-sumry">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nw-user-sumry profiledetail">
                                            <h1>Experience</h1>
                                            <div class="clearfix"></div>
                                            @foreach($employmenthistories as $employmenthistory)
                                            <span class="timenplace border-rgt">
                                                {{ date('d M, Y', strtotime($employmenthistory['service_start'])) }} -
                                                @if($employmenthistory['is_present'] == 1)
                                                Till Date
                                                @else
                                                {{ date('d M, Y', strtotime($employmenthistory['service_end'])) }}
                                                @endif
                                            </span>
                                            <span class="timenplace">{{ $employmenthistory['organization'] }}</span>
                                            <div class="clearfix"></div>
                                            <p>{{ $employmenthistory['position'] }}</p>
                                            <div class="clearfix" style="padding-bottom:20px"></div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="job_listing">                
                                <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">
                                        <span></span>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">
                                        No Employeement History Found
                                    </div>
                                </div>
                            </div>

                            @endif

                        </div>

                        <!-- employment history section -  ends -->

                        <!-- education section -  starts -->

                        <div id="tab_education" class="tab-pane fade job_listing_block">

                            <?php $educations = $UserProfileDetail['education']; ?>

                            @if(count($educations) > 0)
                            @foreach($educations as $education)

                            <div class="job_listing">
                                <div class="row">
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls profiledetail">
                                        <div class="jb-title">
                                            <h1>{{ $education['course'] }}</h1>
                                        </div>
                                        <p>{{ $education['university'] }}</p>
                                        <div class="job_post_dtls">
                                            <a href="javascript:void(0);" style="text-decoration: none;">
                                                <i class="fa fa-calendar"></i>
                                                {{ date('d M, Y', strtotime($education['passing_year'])) }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                            @else

                            <div class="job_listing">                
                                <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">
                                        <span></span>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">
                                        No record found
                                    </div>
                                </div>
                            </div>

                            @endif

                        </div>

                        <!-- education section -  ends -->

                        <!-- certification section -  starts -->          

                        <div id="tab_certification" class="tab-pane fade job_listing_block">

                            <?php $certifications = $UserProfileDetail['certification']; ?>

                            @if(count($certifications) > 0)
                            @foreach($certifications as $certification)

                            <div class="job_listing">
                                <div class="row">
                                    <!--                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">
                                                          <span></span>
                                                        </div>-->
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls profiledetail">
                                        <div class="jb-title">
                                            <h1>{{ $certification['title'] }}</h1>
                                        </div>
                                        <p></p>
                                        <div class="job_post_dtls">
                                            <a href="javascript:void(0);" style="text-decoration: none;">
                                                <i class="fa fa-calendar"></i>
                                                {{ date('d M, Y', strtotime($certification['completion_date'])) }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                            @else

                            <div class="job_listing">                
                                <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">
                                        <span></span>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">
                                        No record found
                                    </div>
                                </div>
                            </div>

                            @endif

                        </div>

                        <!-- certification section -  ends -->

                        <!-- services section -  starts -->          

                        <div id="tab_services" class="tab-pane fade job_listing_block">

                            <?php $services = $UserProfileDetail['service'];
                            ?>

                            @if(count($services) > 0)

                            @foreach($services as $service)
                            @if(isset($sports_names[$service['sport']]))

                            <div class="job_listing">
                                <div class="row">

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 job_lst_dtls profiledetail">
                                        <div class="jb-title">
                                            <h1>
                                                <?php
                                                if ($service['image'] != '' && file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'service_profile_pic' . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR . $service['image'])) {
                                                    echo '<img src="' . Config::get('constants.SERVICE_IMAGE_THUMB') . $service['image'] . '"  id="display_user_profile_pic_view_profile" class="display_user_profile_pic_view_profile" style="width: 75px;height: 75px"/>';
                                                } else {
                                                    echo '<img src="' . url('/') . '/public/images/offer1.jpg" height="75" width="75" />';
                                                }
                                                ?>
                                                {{ @$sports_names[$service['sport']] }}
                                            </h1>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 0px;">
                                            <div class="col-md-6" style="padding-left: 0px;">
                                                <p><b>Activity Name: </b>{{ @$sports_names[$service['sport']] }}</p>
                                                <p><b>Price: </b>${{ $service['price'] }}</p>
                                                <p><b>Description: </b>{{ $service['servicedesc'] }}</p>

                                                @if(isset($serviceType[$service['servicetype']]))
                                                <p><b>Service Type: </b>{{ $serviceType[$service['servicetype']] }}</p>
                                                @endif
                                                @if(isset($programType[$service['programtype']]))
                                                <p><b>Program Type: </b>{{ $programType[$service['programtype']] }}</p>
                                                @endif
                                                @if(isset($ageRange[$service['agerange']]))
                                                <p><b>Age Range: </b>{{ $ageRange[$service['agerange']] }}</p>
                                                @endif
                                                @if(isset($programFor[$service['programfor']]))
                                                <p><b>Program is for: </b> {{ $programFor[$service['programfor']] }}</p>
                                                @endif
                                                @if(isset($expLevel[$service['experience_level']]))
                                                <p><b>Experience Level: </b> {{ $expLevel[$service['experience_level']] }}</p>
                                                @endif
                                            </div>
                                            <div class="col-md-6" style="padding-left: 0px;">
                                                @if(isset($numberOfPeople[$service['numberofpeople']]))
                                                <p><b>Number of People: </b>{{ $numberOfPeople[$service['numberofpeople']] }}</p>
                                                @endif
                                                @if($service['servicelocation'] != '' && $service['servicelocation'] != null && $service['servicelocation'] != 'null')
                                                <p><b>Place: </b>
                                                    <?php $c = count((array) (json_decode($service['servicelocation']))); ?>
                                                    @foreach((json_decode($service['servicelocation'])) as $key1 => $val)
                                                    {!! str_replace('_', ' ', $val) !!}
                                                    @if($c != ($key1+1))
                                                    <span>, </span>
                                                    @endif
                                                    @endforeach
                                                    {{--   @if(@$service['servicelocation'] == "indoor")
                              {{ @$serviceLocation[@$service['servicelocation']] }}</p>
                                                @else
                                                Outdoors({{$serviceLocation['outdoors'][$service['servicelocation']] }})
                                                @endif  --}}
                                                @endif
                                                @if(isset($pFocuses[$service['focuses']]))
                                                <p><b>Program Focuses On: </b> {{ $pFocuses[$service['focuses']] }}</p>
                                                @endif
                                                @if(isset($specialDeals[$service['specialdeals']]))
                                                <p><b>Special Deals: </b> {{ $specialDeals[$service['specialdeals']] }}</p>
                                                @endif
                                                @if(isset($servicePriceOption[$service['servicepriceoption']]))
                                                <p><b>Service Price Options: </b> {{ $servicePriceOption[$service['servicepriceoption']] }}</p>
                                                @endif
                                                @if(isset($duration[$service['duration']]))
                                                <p><b>Duration: </b> {{ $duration[$service['duration']] }}</p>
                                                @endif

<!-- <p> {{ $service['profile_pic'] }}</p> -->
                                                @if($service['terms_conditions'] != '')
                                                <p><b>Terms & Conditions: </b> {{ $service['terms_conditions'] }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="job_post_dtls">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            @else

                            <div class="job_listing">                
                                <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">
                                        <span></span>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">
                                        No record found
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <!-- services section -  ends -->
                    </div
                ></div>
            </div>
        </div>
        @endif
    </div>



</div>

@include('includes.sidebar_profile_right')

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>jquery.1.11.1.min.js"></script>
<link href="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.css" rel="stylesheet"/>

<script src="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>jquery-ui.min.js"></script>

<script>
$('#updateBusinessDetialBtn').click(function () {
    $('#updateBusinessDetial').modal('show');
})
$(".createBusiness").click(function () {
    $(".error").empty();
    if ($(".b_companyname").val() != '') {
        if ($(".b_address").val() != '') {
            if ($(".b_state").val() != '') {
                if ($(".b_city").val() != '') {
                    if ($(".b_zipcode").val() != '') {
                        if ($(".b_country").val() != '') {
                            if ($(".b_EINnumber").val() != '') {
                                if ($('.b_Establishmentyear').val() != "") {
                                    b_submit1();
                                } else {
                                    $(".b_estb").text("Please Enter the Establishment Year ");
                                }
                            } else {
                                $(".b_ein").text("Please Enter the EIN number");
                            }
                        } else {
                            $(".b_cont").text("Please Enter the Country name ");
                        }
                    } else {
                        $(".b_zip").text("Please Enter the Zip code ");
                    }
                } else {
                    $(".b_ct").text("Please Enter the City");
                }
            } else {
                $(".b_sta").text("Please Enter the State");
            }
        } else {
            $(".b_addr").text("Please Enter the Address ");
        }
    } else {
        $(".b_cmpo").text("Please Enter the Company");
    }
});

function b_submit1() {
    var posturl = '/upgarde/createBusiness';
    $('.createBusiness').prop('disabled', true);
    var formdata = new FormData();
    formdata.append('company_name', $(".b_companyname").val())
    formdata.append('address', $(".b_address").val())
    formdata.append('state', $(".b_state").val())
    formdata.append('city', $(".b_city").val())
    formdata.append('zipcode', $(".b_zipcode").val())
    formdata.append('b_EINnumber', $(".b_EINnumber").val())
    formdata.append('b_Establishmentyear', $(".b_Establishmentyear").val())
    formdata.append('country', $(".b_country").val())
    formdata.append('_token', '{{csrf_token()}}')
    $.ajax({
        url: posturl,
        type: 'POST',
        dataType: 'json',
        data: formdata,
        processData: false,
        contentType: false,
        headers: {'X-CSRF-TOKEN': $("#_token").val()},
        beforeSend: function () {
            $('.b_submit').prop('disabled', true);
            showSystemMessages('#systemMessage', 'info', 'Please wait while we register you with Fitnessity.');
        },
        complete: function () {
            $('.b_submit').prop('disabled', false);
        },
        success: function (response) {
            showSystemMessages('#systemMessage', response.type, response.msg);
            if (response.type === 'success') {
                $('#updateBusinessDetial').modal('hide');
                //window.location.href = response.redirecturl;
            }
        }
    });
}
$(".b_EINnumber").keyup(function () {
    var $this = $(this);
    var input = $this.val();

// 2
    input = input.replace(/[\W\s\._\-]+/g, '');

// 3
    var split = 2;
    var chunk = [];

    for (var i = 0, len = input.length; i < len; i += split) {
        split = (i >= 2 && i <= 9) ? 7 : 2;
        chunk.push(input.substr(i, split));
    }

// 4
    $this.val(function () {
        return chunk.join("-").toUpperCase();
    });
});
function initialize1(q) {
    console.log(q.value)
    console.log('callles')
    var input = q;
    console.log(input.value)
    var s = input.value

    // var streetaddress= input.substr(0, input.indexOf(',')); 
    // console.log(streetaddress)

    var autocomplete = new google.maps.places.Autocomplete(input);
    //  if(s != ''){
    //     var streetaddress= s.substr(0, s.indexOf(','));
    //     console.log(streetaddress)
    //     input.value = streetaddress
    // }
    $('.pac-container').css('z-index', '999999999');
    autocomplete.addListener('place_changed', function () {
        var place = autocomplete.getPlace();
        console.log(place.address_components);
        for (var i = 0; i < place.address_components.length; i++) {
            for (var j = 0; j < place.address_components[i].types.length; j++) {
                if (place.address_components[i].types[j] == "postal_code") {
                    $('.b_zipcode').val(place.address_components[i].long_name);
                }
                if (place.address_components[i].types[j] == "locality") {
                    $('.b_city').val(place.address_components[i].long_name);
                    // document.getElementById('b_address').value = place.address_components[i].short_name;
                    //document.getElementById('b_city').value = place.address_components[i].short_name;
                }
                if (place.address_components[i].types[j] == "country") {
                    $('.b_country').val(place.address_components[i].short_name);
                }
                if (place.address_components[i].types[j] == "administrative_area_level_1") {
                    $('.b_state').val(place.address_components[i].long_name);
                }
            }
        }
    });
}
$(function () {
    // for mobile no.
    $('[data-mask]').inputmask()
})
//    var phonecode = '<?php //echo $phonecode;   ?>';
$('#country').change(function () {
    var country_code = $('#frm_country').val();
    if (country_code) {
        $.ajax({
            type: "GET",
            url: "{{url('/get-state-list')}}?country_code=" + country_code,
            success: function (res) {
                if (res) {
                    $("#frm_state").empty();
                    $("#frm_state").append('<option>Select</option>');
                    $.each(res, function (key, value) {
                        $("#frm_state").append('<option value="' + key + '">' + value + '</option>');
                    });

                } else {
                    $("#frm_state").empty();
                }
            }
        });
    } else {
        $("#frm_state").empty();
        $("#frm_city").empty();
    }
});
$('#frm_state').on('change', function () {
    var state_id = $(this).val();
    if (state_id) {
        $.ajax({
            type: "GET",
            // url: '/get-city-list/'+state_id,
            url: "{{url('/get-city-list')}}?state_id=" + state_id,
            success: function (res) {
                if (res) {
                    $("#frm_city").empty();
                    $.each(res, function (key, value) {
                        $("#frm_city").append('<option value="' + key + '">' + value + '</option>');
                    });

                } else {
                    $("#frm_city").empty();
                }
            }
        });
    } else {
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
$('#frmeditProfile').submit(function (e) {
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
    if (!$('#frmeditProfile').valid()) {
        return false;
    }
    var inputData = new FormData($(this)[0]);
    $.ajax({
        url: '/profile/editProfilePicture',
        type: 'POST',
        dataType: 'json',
        data: inputData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $('#submit_profilepic').prop('disabled', true);
        },
        complete: function () {
            $('#submit_profilepic').prop('disabled', false);
        },
        success: function (response) {
            if (response.type == 'success') {
                // $("#display_user_profile_pic").attr("src", response.returndata.profile_pic);
                // $("#display_user_profile_pic_view_profile").attr("src", response.returndata.profile_pic);
                // $(".display_user_profile_pic_view_profile").attr("src", response.returndata.profile_pic);
                $(".display_user_profile_pic_view_profile").each(function () {
                    $(this).attr("src", response.returndata.profile_pic);
                });

                $('#editProfilePic').modal('hide');
            } else {
                showSystemMessages('#systemMessage', response.type, response.msg);
            }
        }
    });
});

// fill modal form with user details
var UserProfileDetail = <?php echo json_encode($UserProfileDetail); ?>;
var ProfessionalDetail = <?php echo json_encode($UserProfileDetail['ProfessionalDetail']); ?>;

$("#editProfileDetailModal").on("show.bs.modal", function () {
    $('#editProfileDetailModal').find('#frm_company_name').val(UserProfileDetail.dba_business_name);
    $('#editProfileDetailModal').find('#frm_firstname').val(UserProfileDetail.firstname);
    $('#editProfileDetailModal').find('#frm_lastname').val(UserProfileDetail.lastname);
    $('#editProfileDetailModal').find('#frm_username').val(UserProfileDetail.username);
    $('#editProfileDetailModal').find('#frm_position').val(UserProfileDetail.position);
    $('#editProfileDetailModal').find('#frm_gender').val(UserProfileDetail.gender);
    $('#editProfileDetailModal').find('#frm_email').val(UserProfileDetail.email);
    $('#editProfileDetailModal').find('#frm_phone_number').val(UserProfileDetail.phone_number);
    $('#editProfileDetailModal').find('#frm_address').val(UserProfileDetail.address);
    if (UserProfileDetail.state != null) {
        $('#editProfileDetailModal').find('#frm_state').val(UserProfileDetail.state);
        $('#frm_state').change(function () {
            if (UserProfileDetail.city != null)
                $('#editProfileDetailModal').find('#frm_city').val(UserProfileDetail.city);
        });
    }
    $('#editProfileDetailModal').find('#frm_country').val(UserProfileDetail.country);
    $('#editProfileDetailModal').find('#frm_zipcode').val(UserProfileDetail.zipcode);
    $('#editProfileDetailModal').find('#frm_intro').val(UserProfileDetail.intro);
    var about_me = '';
    if (typeof (ProfessionalDetail) != "undefined" && ProfessionalDetail !== null && typeof (ProfessionalDetail.about_me) != "undefined" && ProfessionalDetail.about_me !== null)
        about_me = ProfessionalDetail.about_me;
    $('#editProfileDetailModal').find('#frm_aboutme').val(about_me);
});

// validate user detail form
$('#frmeditProfileDetail').submit(function (e) {
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
            about_me: {
                required: true
            },
            about_business: {
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
            about_me: {
                required: "Tell me somthing about you",
            },
            about_business: {
                required: "Tell me somthing about your Business",
            }
        },
        submitHandler: saveProfileDetail
    });
});

// add US phone number validation
$(document).ready(function () {
    jQuery.validator.addMethod("phoneUS", function (phone_number, element) {
        phone_number = phone_number.replace(/\s+/g, "");
//                  phone_number = phone_number.replace(phonecode, ""); 
        console.log(phone_number);
        return this.optional(element) || phone_number.length > 9 &&
                phone_number.match(/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/);
    }, "Please specify a valid phone number");
});

// save user profile
function saveProfileDetail()
{
    if ($('#frmeditProfileDetail').valid()) {
        var formData = $("#frmeditProfileDetail").serialize();
        $.ajax({
            url: '/profile/editProfileDetail',
            type: 'POST',
            dataType: 'json',
            data: formData,
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
                    window.location = "/profile/viewProfile";
                }
            }
        });
    }
}
</script>

<script>
    $('textarea#frm_intro').on('keyup', function ()
    {
        var maxlen = $(this).attr('maxlength');

        var length = $(this).val().length;
        if (length > (maxlen - 10)) {
            $('#textarea_message').text('max length ' + maxlen + ' characters only!')
        } else
        {
            $('#textarea_message').text('');
        }
    });
</script>
@endsection