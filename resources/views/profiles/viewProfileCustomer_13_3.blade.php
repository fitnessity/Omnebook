@inject('request', 'Illuminate\Http\Request')

@extends('layouts.profile')



@section('content')
<head>
    <meta charset="utf-8">
    <meta name="description" content="Looking for a place to grow your career. There are many good reasons to consider the great insurance jobs available through Legends United.">
    <meta name="keywords" content="Great Insurance Jobs">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Fitnessity </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>all.css">
    <link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>stylenew.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
   
.outer { margin:0 auto; max-width:800px;}
#big .item {padding: 0px 0px; margin:2px; color: #FFF; border-radius: 3px; text-align: center; }
#thumbs .item {height:70px; line-height:70px; padding: 0px; margin:8px 4px 0px; color: #FFF;text-align: center; cursor: pointer; }
#thumbs .item h1 { font-size: 18px; }
/*#thumbs .current .item { background:#FF5722; }*/
.owl-theme .owl-nav [class*='owl-'] { -webkit-transition: all .3s ease; transition: all .3s ease; }
.owl-theme .owl-nav [class*='owl-'].disabled:hover { background-color: #D6D6D6; }
#big.owl-theme { position: relative; }
#big.owl-theme .owl-next, #big.owl-theme .owl-prev { background:#ff4d4d; width: 40px;border-radius:50px; line-height:40px; height: 40px; margin-top: -20px; position: absolute; text-align:center; top: 50%; }
#big.owl-theme .owl-prev { left: 10px; }
#big.owl-theme .owl-next { right: 10px; }
.owl-carousel.owl-drag .owl-item{height: 375px !important;}
div#thumbs {
    height: 100px !important;
}
/*.owl-item.active .item img{*/
/*    height: 100px !important;*/
/*}*/
.fa.fa-arrow-right, .fa.fa-arrow-left{color: #fff;}
#thumbs.owl-theme .owl-next, #thumbs.owl-theme .owl-prev { background:#333; }
#sync1 {
  .item {
    background: #0c83e7;
    padding: 80px 0px;
    margin: 5px;
    color: #FFF;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    text-align: center;
  }
}

#sync2 {
  .item {
    background: #C9C9C9;
    padding: 10px 0px;
    margin: 5px;
    color: #FFF;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    text-align: center;
    cursor: pointer;
    h1 {
      font-size: 18px;
    }
  }
  .current .item{
    background: #0c83e7;
  }
}



.owl-theme {
  .owl-nav {
    /*default owl-theme theme reset .disabled:hover links */
    [class*='owl-'] {
      transition: all .3s ease;
      &.disabled:hover {
       background-color: #D6D6D6;
      }   
    }
    
  }
}

//arrows on first carousel
#sync1.owl-theme {
  position: relative;
  .owl-next, .owl-prev {
    width: 22px;
    height: 40px;
    margin-top: -20px;
    position: absolute;
    top: 50%;
  }
  .owl-prev {
    left: 10px;
  }
  .owl-next {
    right: 10px;
  }
}
ul.job_topic li {
    width: 19.33% !important;
    float: left;
    border-right: 1px solid #bfbfbf;
    border-bottom: 1px solid #bfbfbf;
}
</style>
</head>
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
 <?php 

       $loggedinUser = Auth::user(); 

       $customerName = $loggedinUser->firstname.' '.$loggedinUser->lastname;

       $profilePicture = $loggedinUser->profile_pic;

    ?>


<div class="banner">
    
    @if(Auth::user()->company_images != null && (count(json_decode(Auth::user()->company_images)) != 0))
        @if((json_decode(Auth::user()->company_images))[0] != '')
            <img src="<?php echo Config::get('constants.USER_IMAGE_THUMB').(json_decode(Auth::user()->company_images))[0]; ?>" alt="images" class="img-fluid">
        @else
            <img src="https://fitnessity.co/public/images/newimage/banner.png" alt="images" class="img-fluid">
        @endif
    @else
        <img src="https://fitnessity.co/public/images/newimage/banner.png" alt="images" class="img-fluid">
    @endif
</div>

<section class="banner-below-sec">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-2">
        <div class="comp-mark">
            <img src="<?php echo Config::get('constants.USER_IMAGE_THUMB').$UserProfileDetail['profile_pic']; ?>" alt="images" class="img-fluid">
            <a href="javascript:void(0);" class="edit-pic" data-toggle="modal" data-target="#editProfilePic" title="Click here to change picture"><div id="mycamera"  style="color:#fff;background-color:#000;height:30px;width:30px;border-radius:15px;position: absolute;
    right: 23px;
    bottom: 2px;">
                <span class="fa fa-camera" style="position: relative;
    left: -7px;
    top: 7px;"></span>
            </div>
            </a>
        </div>
        
        
         <!-- Modal -->

                <div class="modal fade" id="editProfilePic" role="dialog">

                  

                  {!! Form::open(array('files' => true , 'enctype' => 'multipart/form-data', 'id' => 'frmeditProfile_side')) !!}



                  <input type="hidden" name="_token" value="{{ csrf_token() }}">



                  <div class="modal-dialog modal-lg">

                    <!-- Modal content-->

                    <div class="modal-content">

                      <div class="modal-body login-pad">

                        <div class="pop-title employe-title">

                          <h3>EDIT PROFILE PICTURE</h3>

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

              <!-- Modal Ends -->  
        
        
        
      </div>
      
      <div class="col-lg-6">
        <div class="bnr-information">
            <h2 style="text-transform: capitalize;">{{$customerName}}</h2>
            <h6>@if(isset($UserProfileDetail['intro'])) {!! nl2br(@$UserProfileDetail['intro']) !!} @else - @endif</h6>
            <p>Company: @foreach($companies as $value) {{$value['company_name']}} @if(count($companies) != $loop->iteration) , @endif @endforeach</p>
            <p>Username: @if(isset($UserProfileDetail['username'])) {{ $UserProfileDetail['username']}} @else - @endif</p>
            <p>Favorite Activities: Martial Arts, Adventure Sports</p>
         </div>
      </div>
      
      <div class="col-lg-4">
        <div class="reatingbox">
          <h5><span>8.6 </span> / 10 Ratings</h5>
          <div class="social">
            <ul>
              <li><a href=""><i class="far fa-heart mr-2"></i>Save</a></li>
              <li><a href=""><img src="https://fitnessity.co/public/images/newimage/review.png" alt="icon"> Submit Review</a></li>
              <li><a href=""><img src="https://fitnessity.co/public/images/newimage//share.png" alt="icon">Share</a></li>
            </ul>
          </div>
        </div>
      </div>
      
    </div>
    </div>
</section>

<section class="menu-white">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6" style="background-color:#000;">
          <div class="name-div sticky-top">
            <span><a href="#mydesc" style="color:#ffffffb3"> About </a></span>
            <span><a href="#video-box" style="color:#ffffffb3"> Videos </a></span>
            <span><a href="#family-id" style="color:#ffffffb3"> Family </a></span>
            </div>
        </div>
         <div class="col-lg-6">
             <div class="row">
               <a href="javascript::void(0);" style="float: right" data-toggle="modal" data-target="#editProfileDetailModal"><div class="claim-business"> Edit Profile </div></a>
               <a href="{{url('/profile/createProfileSecurity')}}" style="float: right" ><div class="claim-business"> Add/Edit Security Questions </div></a>
               <a href="{{url('/profile/change-password')}}" style="float: right" ><div class="claim-business"> Change Password</div></a>
              </div>
          </div>
      </div>
    </div>
</section>


                <!-- Modal -->

                <div class="modal" id="editProfileDetailModal" role="dialog">

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



                            <button type="button" id="submit_profiledetail" onclick="$('#frmeditProfileDetail').submit();">Submit</button>

                          </div>

                        </div>

                    </div>

                  </div>

                  

                </div>

                {!! Form::close() !!}

                <!-- </form> -->

              </div>

<section class="desc-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="desc-box-new">
                    <div class="desc-text" id="mydesc">
                        <h5> Description</h5>
                        <?php $gender = array ('' => 'Select Gender','Male' => 'Male', 'Female' => 'Female'); ?>
                         <p>@if(isset($UserProfileDetail['about_me'])) {!! nl2br(@$UserProfileDetail['about_me']) !!} @else - @endif</p>
                    </div>
                    
                    
                    
                    <div class="gallery-box" id="photo">
                        @if(Auth::user()->company_images !== null)
                        <h5>Photos</h5>
                         <div class="outer">
                    <div id="big" class="owl-carousel owl-theme">
                         @foreach(json_decode(Auth::user()->company_images) as $value)
                      <div class="item">
                        <img src="<?php echo Config::get('constants.USER_IMAGE_THUMB').$value; ?>" style="width: 100%;border-radius:10px;"></img>
                      </div>
                      @endforeach
                      
                    </div>
                    <div id="thumbs" class="owl-carousel owl-theme">
                         @foreach(json_decode(Auth::user()->company_images) as $value)
                      <div class="item">
                        <img src="<?php echo Config::get('constants.USER_IMAGE_THUMB').$value; ?>" style="width: 100%;height: 100px;border-radius: 5px;"></img>
                      </div>
                       @endforeach
                      
                    </div>
                    </div>
                
            <div id="sync1" class="owl-carousel owl-theme">
                @foreach(json_decode(Auth::user()->company_images) as $value)
              <!--<div class="item">-->
              <!--  <img src="<?php echo Config::get('constants.USER_IMAGE_THUMB').$value; ?>" style="width: 100%;"></img>-->
              <!--  </div>-->
                @endforeach
            </div>
            @endif
        </div>
                    
                    
                    
                    <div class="video-box" id="video-box">
                      <h5> Video </h5>
                        <div class="video-responsive">
                           <iframe width="560" height="315" src="https://www.youtube.com/embed/Ol2QjF53OPQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="pr-listing-amerties" id="family-id">
                        
                        
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
                        
                        
                        
                        <h5> Family Details</h5>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nw-user-detail">
     <a href="javascript: void(0);" style="float: right" data-toggle="modal" id="addFamily" data-target="#addFamilyDetailModal"><i class="fa fa-plus"></i> Add Family Member</a>
    </div> 
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
                    </div>
                    
                    <div class="pr-upload-imgbox" id="imagedropbox">
          <div class="upoload-dotbox">
            <p>Drop images to upload</p>
            <p>Or</p>
            <p><img src="https://fitnessity.co/public/images/newimage/upload-img.jpg" alt="images"></p>
            <p class="gallryup">Gallery Images</p>
          </div>
        </div>
        
        
         @isset(Auth::user()->company_images)
         <div class="row" style="padding: 10px 20px;" id="delimgbox">
            @foreach(json_decode(Auth::user()->company_images) as $key=>$value)
            
                <div class="col-md-4" class="imgdeletediv" style="position:relative;padding: 15px;">
                    <img src="<?php echo Config::get('constants.USER_IMAGE_THUMB').$value; ?>" style="width:100%;height:auto;" />
                    <button type="button" myindex="{{$key}}" class="btn btn-primary delimg" style="margin-top: 15px;"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                </div>
            @endforeach
            </div>
         @endisset
        
                <div id="Modal" class="modal fade" role="dialog">
      <div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:black;">Add User Images</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('/user-multi-image-upload')}}" enctype="multipart/form-data">
            <input required type="file" class="form-control" name="images[]" placeholder="Company Image" multiple>
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
       
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default">Save</button>
         </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    
      </div>
    </div>
                        
                    
                    
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="right-box">
                    

                <div class="pr-verification">
                    <h1> Verification</h1>
                        <div class="veri-icon-new">


                            <span >
                              <a href="{{'tel:'.$UserProfileDetail['phone_number']}}" style="background-color:green;" title="phone" class="cophone"><i class="fa fa-phone" aria-hidden="true"></i></a>
                            </span>


                            <span >
                              <a href="{{'mailto:'.$UserProfileDetail['email']}}" style="background-color:green;" title="email"  class="coemail"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                             </span>
      
                             <span >
                              <a href="{{'http://maps.google.com/?q='.$UserProfileDetail['address']}}" style="background-color:green;" title="address" class="coaddress" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
                            </span>
    
                         </div>
              
                </div>
                
                <div class="static">
                    <h5><i class="far fa-bookmark mr-2"></i> Statistic </h5>
                    <div class="static-soc">
                
                        <ul>
                          <li><a href="#"><i class="far fa-eye mr-2"></i> 14344 Views </a></li>
                          <li><a href="#"><i class="far fa-star mr-2"></i> 8 Ratings </a></li>
                          <li><a href="#"><i class="far fa-heart mr-2"></i> 36 Favorites</a></li>
                          <li><a href="#"><i class="fas fa-share mr-2"></i> 28 Shares </a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="get-started">
                  <div class="get-img"><img src="https://fitnessity.co/public/images/newimage/get-started.jpg" alt="images" class="img-fluid"></div>
                  <div class="get-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</div>
                  <div class="get-btn-box"><a href="#" class="get-btn"> Get Started </a> </div>
                </div>
                
                <div class="ad-img">
                  <img src="https://fitnessity.co/public/images/newimage/ad-img.jpg" alt="images" class="img-fluid">
                </div>
            </div>
        </div>
        </div>
    </div>
                
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js" integrity="sha512-qp27nuUylUgwBZJHsmm3W7klwuM5gke4prTvPok3X5zi50y3Mo8cgpeXegWWrdfuXyF2UdLWK/WCb5Mv7CKHcA==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
<link href="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/css/default/zebra_datepicker.min.css" />
<!--<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>-->

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->

<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>-->
<link href="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.css" rel="stylesheet"/>
<script src="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.15/zebra_datepicker.src.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" defer integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){
        var bigimage = $("#big");
  var thumbs = $("#thumbs");
  //var totalslides = 10;
  var syncedSecondary = true;

  bigimage
    .owlCarousel({
    items: 1,
    slideSpeed: 2000,
    nav: true,
    autoplay: true,
    dots: false,
    loop: true,
    responsiveRefreshRate: 200,
    navText: [
      '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
      '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
    ]
  })
    .on("changed.owl.carousel", syncPosition);

  thumbs
    .on("initialized.owl.carousel", function() {
    thumbs
      .find(".owl-item")
      .eq(0)
      .addClass("current");
  })
    .owlCarousel({
    items: 6,
    dots: true,
    nav: true,
    navText: [
      '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
      '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
    ],
    smartSpeed: 200,
    slideSpeed: 500,
    slideBy: 4,
    responsiveRefreshRate: 100
  })
    .on("changed.owl.carousel", syncPosition2);

  function syncPosition(el) {
    //if loop is set to false, then you have to uncomment the next line
    //var current = el.item.index;

    //to disable loop, comment this block
    var count = el.item.count - 1;
    var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

    if (current < 0) {
      current = count;
    }
    if (current > count) {
      current = 0;
    }
    //to this
    thumbs
      .find(".owl-item")
      .removeClass("current")
      .eq(current)
      .addClass("current");
    var onscreen = thumbs.find(".owl-item.active").length - 1;
    var start = thumbs
    .find(".owl-item.active")
    .first()
    .index();
    var end = thumbs
    .find(".owl-item.active")
    .last()
    .index();

    if (current > end) {
      thumbs.data("owl.carousel").to(current, 100, true);
    }
    if (current < start) {
      thumbs.data("owl.carousel").to(current - onscreen, 100, true);
    }
  }

  function syncPosition2(el) {
    if (syncedSecondary) {
      var number = el.item.index;
      bigimage.data("owl.carousel").to(number, 100, true);
    }
  }

  thumbs.on("click", ".owl-item", function(e) {
    e.preventDefault();
    var number = $(this).index();
    console.log("number")
    console.log(number)
    console.log("number")
    bigimage.data("owl.carousel").to(number, 300, true);
  });
        
        
        
  var sync1 = $("#sync1");
  


  function syncPosition(el) {
    //if you set loop to false, you have to restore this next line
    //var current = el.item.index;
    
    //if you disable loop you have to comment this block
    var count = el.item.count-1;
    var current = Math.round(el.item.index - (el.item.count/2) - .5);
    
    if(current < 0) {
      current = count;
    }
    if(current > count) {
      current = 0;
    }
    
    //end block

    
  }
  
    $('.delimg').click(function(){
       $.ajax({
          url:"{{url('/delete-image-company?myindex=')}}"+$(this).attr('myindex')+'&company_id='+$(this).attr('company_id'),
          type:'get',
           beforeSend: function () {
             $('.loader').show();
           },
           complete: function () {
             $('.loader').hide();
           },
          success: function (response) { 
              //if(response.status ==200){
                window.location.reload()
                  $(this).parent().remove();
              //}
          }
         })
      
    })
  
  
  
            var images = [<?php echo '"'.implode('","', json_decode(Auth::user()->company_images)).'"' ?>];

    //       var imageUrl = images.length != 0 && images[0] != "" ? "<?php echo Config::get('constants.USER_IMAGE_THUMB'); ?>" : "{{url('/public/images')}}/" 
    //         var logo = (images.length != 0 && images[0] != "") ? images[0] : "claim-bg.jpeg"
            
    //       imageUrl = imageUrl+logo
    //      //  ttp://fitnessity.co//public/uploads/profile_pic/thumb/1614976793-215112.jpg
           
    //     setTimeout(function(){
    //         console.log(imageUrl)
    //         console.log("this one run")
    //          $(".banner img").attr("src", imageUrl);
    //     },20)				
    //   })
    var imageUrl = images.length != 0 && images[0] != "" ? "<?php echo Config::get('constants.USER_IMAGE_THUMB'); ?>" : "{{url('/public/images')}}/" 
        var logo = (images.length != 0 && images[0] != "") ? images[0] : "claim-bg.jpeg"
       
       
       imageUrl = "http://fitnessity.co/"+imageUrl+logo
       if(images.length != 0 && images[0] != ""){
    setTimeout(function(){
       
        // $(".banner").css("background-image", "url('" + imageUrl + "')", 'important');
      //  $(".banner img").attr("src",imageUrl)
    },20)	
       }
 $('#imagedropbox').click(function() {
   $('#Modal').modal('show');
});
       
        
        $('#imagedropbox').click(function() {
   $('#Modal').modal('show');
});

    $('.delimg').click(function(){
       $.ajax({
          url:"{{url('/delete-image-user?myindex=')}}"+$(this).attr('myindex'),
          type:'get',
           beforeSend: function () {
             $('.loader').show();
           },
           complete: function () {
             $('.loader').hide();
           },
          success: function (response) { 
              //if(response.status ==200){
                window.location.reload()
                  $(this).parent().remove();
              //}
          }
         })
      
    })
        
        
         if(window.location.href.split('?').pop() == 'companyCreate=1'){
            $('#create_company_btn').click()
        }
        
        // edit profile picture

    $('#frmeditProfile_side').submit(function(e) {

      e.preventDefault();

      $('#frmeditProfile_side').validate({

          rules: {

              profile_pic: {

               required: true,

               accept: "image/*"   

              },

          },

          messages: {

              profile_pic: {

                  required: "Upload a Company logo ",

                  accept: "Please upload an image"

              },

          }

      });

      if(!$('#frmeditProfile_side').valid()) {

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
              if (response.type == 'success') {
                  window.location.reload()
                  // $("#display_user_profile_pic").attr("src", response.returndata.profile_pic);
                  // $("#display_user_profile_pic_view_profile").attr("src", response.returndata.profile_pic);
                  // $(".display_user_profile_pic_view_profile").attr("src", response.returndata.profile_pic);
                 // $(".display_user_profile_pic_view_profile1").each(function(){
                    $('.comp-mark img').attr("src", response.returndata.profile_pic);
                 // });
                  
                  $('#editServicePic').modal('hide');
              }else {
                  showSystemMessages('#systemMessage', response.type, response.msg);
              }
          }
      });
       
    })
        
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


 var bigimage = $("#big");
  var thumbs = $("#thumbs");
  //var totalslides = 10;
  var syncedSecondary = true;

  bigimage
    .owlCarousel({
    items: 1,
    slideSpeed: 2000,
    nav: true,
    autoplay: true,
    dots: false,
    loop: true,
    responsiveRefreshRate: 200,
    navText: [
      '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
      '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
    ]
  })
    .on("changed.owl.carousel", syncPosition);

  thumbs
    .on("initialized.owl.carousel", function() {
    thumbs
      .find(".owl-item")
      .eq(0)
      .addClass("current");
  })
    .owlCarousel({
    items: 6,
    dots: true,
    nav: true,
    navText: [
      '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
      '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
    ],
    smartSpeed: 200,
    slideSpeed: 500,
    slideBy: 4,
    responsiveRefreshRate: 100
  })
    .on("changed.owl.carousel", syncPosition2);

  function syncPosition(el) {
    //if loop is set to false, then you have to uncomment the next line
    //var current = el.item.index;

    //to disable loop, comment this block
    var count = el.item.count - 1;
    var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

    if (current < 0) {
      current = count;
    }
    if (current > count) {
      current = 0;
    }
    //to this
    thumbs
      .find(".owl-item")
      .removeClass("current")
      .eq(current)
      .addClass("current");
    var onscreen = thumbs.find(".owl-item.active").length - 1;
    var start = thumbs
    .find(".owl-item.active")
    .first()
    .index();
    var end = thumbs
    .find(".owl-item.active")
    .last()
    .index();

    if (current > end) {
      thumbs.data("owl.carousel").to(current, 100, true);
    }
    if (current < start) {
      thumbs.data("owl.carousel").to(current - onscreen, 100, true);
    }
  }

  function syncPosition2(el) {
    if (syncedSecondary) {
      var number = el.item.index;
      bigimage.data("owl.carousel").to(number, 100, true);
    }
  }

  thumbs.on("click", ".owl-item", function(e) {
    e.preventDefault();
    var number = $(this).index();
    console.log("number")
    console.log(number)
    console.log("number")
    bigimage.data("owl.carousel").to(number, 300, true);
  });
        
        
        
  var sync1 = $("#sync1");
  


  function syncPosition(el) {
    //if you set loop to false, you have to restore this next line
    //var current = el.item.index;
    
    //if you disable loop you have to comment this block
    var count = el.item.count-1;
    var current = Math.round(el.item.index - (el.item.count/2) - .5);
    
    if(current < 0) {
      current = count;
    }
    if(current > count) {
      current = 0;
    }
    
    //end block

    
  }


    
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
        console.log("myyyyy run")

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

                    showSystemMessages('#systemMessage', 'info', 'Please wait while we delete family member with Fitnessity.');

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


// $(document).on('shown.bs.modal','.modal', function () {
//          // DO EVENTS
//     });
    $(document).on("shown","#editProfileDetailModal", function(){
        
        console.log("sdfsdfsdf")

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

    //$(document).ready(function(){

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

    //});



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

