@extends('layouts.app')

@section('content')
<style>
.service-box-div{
    padding: 10px;
    border-radius: 10px;
    border: 1px solid black;
    background: #fff;
}
.btn-info{
    background:#f53b49;
    border-color:#f53b49;
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
</style>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.10/slimselect.min.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.10/slimselect.min.css" rel="stylesheet"></link>

<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_JS'); ?>select/select.css"/>
<section class="direc-hire">

  @include('includes.search_category_sidebar')

  <div class="direc-right">
  <div class="cartedit" style="display:none"></div>
    <h1> Book Company</h1>
      <div class="business-offer-main">
        <div class="network_block nw-profile_block book-professional-sec">
          <div class="busines-offer-list busines-off-profile-list">
            <div class="job_block" style="display:none">
              {!! Form::open(array('id' => 'frmBookingDetail')) !!}
              <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
              <input type="hidden" name="professional_id" value="{{ $UserProfileDetail['id'] }}">

              <div id='systemMessage_booking'></div>

              <div class="row">
                  <div class="nw-user-detail-block">                  
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 nw-user-detail profiledetail">
                      <?php
                        $selected_sport = null;
                        $user = getLoggedInUser();
                        
                        if(Session::has('selected_sport'))
                            $selected_sport = Session::get('selected_sport');
                        ?>
                        <div class="select-style review-select2">

                        <select name="sport" id="frm_sport" class="selectpicker">
                          <option value="">Select Sport</option>
                          <?php 
                            ksort($userSport);
                            foreach ($userSport as $sportKey => $sportValue) {
                                if(@count(@$sportValue['child']) > 0){
                                  asort($sportValue['child']);
                                  echo "<optgroup label='".$sportKey."'>";
                                    foreach ($sportValue['child'] as $key => $value) {
                                      echo "<option value='$key'";
                                      if($selected_sport == $key) echo 'selected';
                                      echo ">$value</option>";  
                                    }
                                  echo "</optgroup>";
                                } else {
                                  foreach ($sportValue['self'] as $key1 => $value1) {
                                    echo "<option value='$key1'";
                                    if($selected_sport == $key1) echo 'selected';
                                    echo ">".$value1."</option>";
                                  }
                                }
                            }
                          ?>
                        </select>
                        </div>
                        <div class="emplouyee-form" style="width:100%">
                          <textarea name="booking_detail" id="frm_booking_detail" placeholder="Description"></textarea>
                        </div>
                        <p id="showSportPrice" style="display: none;"> 
                          Sport Price : <span id="sportPrice"></span>
                            <input type="hidden" id="sportPriceVal" name="sportPriceVal">
                            <input type="hidden" id="scheduleHoursVal" name="scheduleHoursVal">
                        </p>
                        
                      <div class="social-connect">
                          <div class="row">
                              <div class="form-control">
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                  <label>Name</label>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                  <input type="text" disabled="disabled" value="{{ Auth::user()->firstname. ' ' . Auth::user()->lastname }}" name="h_name" id="h_name" class="form-control"/>
                                </div>
                              </div>
                              <div class="form-control">
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                  <label>Email</label>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                  <input type="text" disabled="disabled" value="{{ Auth::user()->email }}"  name="h_email" id="h_email" class="form-control"/>
                                </div>
                              </div>
                              <div class="form-control">
                                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                  <label>Phone Number</label>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                  <input type="text" disabled="disabled" value="{{ Auth::user()->phone_number }}" name="h_phone" id="h_phone" class="form-control"/>
                                </div>
                              </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div style="float:right;">
                            <h4>My Availability : </h4>
                            <div class="select-schedule">
                              <div id="businessHoursContainer" class="text-center" ></div>
                            </div>
                        </div>
                    </div>                      
                  </div>
                  @if(Auth::User()->id != $user_id)
                  <div class="emplouyee-form">
                      <button class="btn btn-primary" id="submit_bookingdetail" >Submit</button>
                  </div>
                  @endif
                  {!! Form::close() !!}
              </div>
            </div>
          </div>
          
          <div class="clearfix"></div>

          <div class="row">
              <div class="nw-user-detail-block">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                  <div class="nw-user-img">
                    <?php
                    if($UserProfileDetail['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$UserProfileDetail['profile_pic'])) {
                      echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB').$UserProfileDetail['profile_pic'].'" width="254" height="275" id="display_user_profile_pic" />';
                    }
                    else {
                      echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png" width="254" height="275" id="display_user_profile_pic" />';
                    }
                    ?>
                  </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 nw-user-detail profiledetail">
                  <h1 class="nw-user-nm">{{ $UserProfileDetail['firstname']." ".$UserProfileDetail['lastname'] }}</h1>
                  <p>Lobortis nisl ut aliquip ex ea commodo  Duis autem vel eum iriure 
                    dolor in hendrerit in vulputate velit esse molestie consequat </p>
                  <div class="nw-user-edit profiledetail" style="display:none">
                    <div class="nw-dtl-edit">
                      <span class="nw-label">Company Name:</span>
                      <span id="display_user_company">{{ $UserProfileDetail['company_name'] }}</span>
                    </div>
                    <div class="nw-dtl-edit">
                      <span class="nw-label">Name:</span>
                      <span id="display_user_name">{{ $UserProfileDetail['firstname'] }} {{ $UserProfileDetail['lastname']}}</span>
                    </div>
                    <div class="nw-dtl-edit">
                      <span class="nw-label">Gender:</span>
                      <span id="display_user_name">{{ $UserProfileDetail['gender'] }}</span>
                    </div>
                    <div class="nw-dtl-edit">
                      <span class="nw-label">Email : </span><span>{{ $UserProfileDetail['email'] }}</span>
                    </div>
                    <div class="nw-dtl-edit">
                      <span class="nw-label" id="display_user_phone">Phone : </span><span>{{ $UserProfileDetail['phone_number'] }}</span>
                    </div>
                    <div class="nw-dtl-edit">
                      <span class="nw-label">Address :  </span>
                      <span class="nw-detail-txt" id="display_user_address">
                        {{ $UserProfileDetail['address'] }}
                        <br>
                        {{ $UserProfileDetail['cities']['city_name'] }}, {{ $UserProfileDetail['states']['state_name'] }} {{ $UserProfileDetail['zipcode'] }}
                        <br>
                        {{ $UserProfileDetail['countries']['country_name'] }}                  
                        <div class="clearfix"></div>
                        <a href="#"><i class="fa fa-phone"></i></a><a href="#"><i class="fa fa-map-marker"></i></a><a href="#"><i class="fa fa-envelope"></i></a>
                      </span>
                    </div>          
                  </div>
                </div>
              </div>
          </div>          
        <div class="loader" >
            <img alt="loader" style="width: 70px;" src="https://thumbs.gfycat.com/MarriedMarvelousHawaiianmonkseal-small.gif">
        </div>
 <input type="hidden" id="bsnid" value="{{$user_id}}">  

<div id="formstepnew">
     <div class="row">
     <div class="col-md-2">
      <p class="stripetext">1. Book Online </p>
      <div class="formstrip stripnew"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">2. Service</p>
      <div class="formstrip strip1" style="background: #d9d9d9!important;"></div>
    </div>
    <!--<div class="col-md-2">-->
    <!--  <p class="stripetext">3. Time</p>-->
    <!--  <div class="formstrip strip2" style="background: #d9d9d9!important;"></div>-->
    <!--</div>-->
    <!--<div class="col-md-2">-->
    <!--  <p class="stripetext">4. Details</p>-->
    <!--  <div class="formstrip strip3" style="background: #d9d9d9!important;"></div>-->
    <!--</div>-->
    <div class="col-md-2">
      <p class="stripetext">3. Cart</p>
      <div class="formstrip strip4" style="background: #d9d9d9!important;"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">4. Payment</p>
      <div class="formstrip strip5" style="background: #d9d9d9!important;"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">5. Done</p>
      <div class="formstrip strip6" style="background: #d9d9d9!important;"></div>
    </div>
   
  </div>
    <span id="formstepnewerror"></span>
    <div class="row">
      <div class="col-lg-4">
        <div class="row">
          <div class="col-md-12" id="bookonlinepicker-position">
           <input type="hidden" maxlength="4" style="width:100%" class="frm_bookonline" name="frm_bookonline" placeholder="Book Online" id="bookonline" autocomplete="off">
           </div>
        </div>
      </div>
      <div class="col-lg-8">
          <span class="select-date-span"></span>
          <div class="box-div"></div>
      </div>
    </div>
    <button id="formstepnewnext"  class="stepbtn" style="float: right;">NEXT</button>
</div>

<!-- formstep1 START -->
<div id="formstep1" style="display:none;">
<input type="hidden" value="">
  <div class="row">
     <div class="col-md-2">
      <p class="stripetext">1. Book Online </p>
      <div class="formstrip stripnew"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">2. Service</p>
      <div class="formstrip strip1"></div>
    </div>
    <!--<div class="col-md-2">-->
    <!--  <p class="stripetext">3. Time</p>-->
    <!--  <div class="formstrip strip2" style="background: #d9d9d9!important;"></div>-->
    <!--</div>-->
    <!--<div class="col-md-2">-->
    <!--  <p class="stripetext">4. Details</p>-->
    <!--  <div class="formstrip strip3" style="background: #d9d9d9!important;"></div>-->
    <!--</div>-->
    <div class="col-md-2">
      <p class="stripetext">3. Cart</p>
      <div class="formstrip strip4" style="background: #d9d9d9!important;"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">4. Payment</p>
      <div class="formstrip strip5" style="background: #d9d9d9!important;"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">5. Done</p>
      <div class="formstrip strip6" style="background: #d9d9d9!important;"></div>
    </div>
   
  </div>
   <p id="msg" style="display:none"></p>

<form id="firststepsform" method="post">

<div class="myclone" >
<input type="hidden" id="duestaxpercentage" name="duestaxpercentage" value="">
<input type="hidden" id="salestaxpercentage" name="salestaxpercentage" value="">
<div id="clonedInput1" class="clonedInput prdr-offer">

<p class="step_para">Please select from services this provider offers.</p>

<div class="row">
  <!--<div class="col-md-4">-->
  <!--  <div class="form-group">-->
  <!--    <label for="sel1" style="color: #f53b49;">Select Category</label>-->
  <!--    <select class="form-control selectcatagory" id="frm1" name="selectcatagory">-->
  <!--      <option value="">Select Category</option> -->
        <?php 
            // ksort($userSport);
            // foreach ($userSport as $sportKey => $sportValue) {
            //     if(@count(@$sportValue['child']) > 0){
            //       asort($sportValue['child']);
            //       echo "<optgroup label='".$sportKey."'>";
            //         foreach ($sportValue['child'] as $key => $value) {
            //           echo "<option value='$key'";
            //           if($selected_sport == $key) echo 'selected';
            //           echo ">$value</option>";  
            //         }
            //       echo "</optgroup>";
            //     } else {
            //       foreach ($sportValue['self'] as $key1 => $value1) {
            //         echo "<option value='$key1'";
            //         if($selected_sport == $key1) echo 'selected';
            //         echo ">".$value1."</option>";
            //       }
            //     }
            // }
          ?>
  <!--    </select>-->
  <!--  </div>-->
  <!--</div>-->
  <input type="hidden" id="frm1" name="selectcatagory">
  <div class="col-md-6 col-sm-6">
    <div class="form-group">
      <label for="sel1" style="color: #f53b49;">Choose Activity Type</label>
      <select class="form-control frm2" id="frm2" name="activitytype">
        <option>Choose Activity Type </option>
      </select>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 mymymy">
      <div class="form-group">
      <label for="email" style="color: #f53b49;">Who is Training</label>
        <select class="whois" id="whoistraining" name="whoistraining[]" multiple>
        @foreach ($family as $record)
         <option value="{{$record['id']}}">
          {{$record['first_name']}} {{$record['last_name']}} ({{$record['relationship']}})
         </option>
        @endforeach
        <option value="me">Me</option>
        </select>
    </div>
  </div>
</div>

<div class="row">

  <div class="col-md-6 col-sm-6">
    <div class="form-group">
    <input type="hidden" id="checkseats" value="">
      <label for="sel1" style="color: #f53b49;">Number of Persons - Available seats <span class="available">NA</span></label>
      <input type="text" disabled class="form-control" id="frm3" name="numberofpersons" placeholder="Number of Persons">
    </div>
  </div>
  <div class="col-md-6 col-sm-6">
    <div class="form-group">
      <label for="email" style="color: #f53b49;">Activity Location</label>
      <select class="form-control activitylocation" id="activitylocation" name="activitylocation">
      
      </select>
    </div>
  </div>
</div>

    <hr>
</div> <!-- clone div -->

</div><!-- myclone append div -->
<a href="javascript:void(0)"style="float: left;"><div class="step1_days cart" onclick="$('#formstep1').hide();$('#formstep2').hide();$('#formstep3').hide();$('#formstep4').show();" style="text-align: center;padding: 8px 4px;"><i class='fa fa-cart-plus' style="color: #fff"></i></div></a>
<button type="button" class="stepbtn" href="#" onclick="$('#formstepnew').show();$('#formstep1').hide();" style="float: left;">BACK</button>
<!--<button  class="stepbtn" id="step1" href="#" onclick="$('#formstep1').hide();$('#formstep2').show();" style="float: right;">NEXT</button> -->
<button type="submit" class="stepbtn" style="float: right;">NEXT</button>
</form>
</div>
<!-- formstep1 END -->

<input type="hidden" value="" id="price" name="price">
<input type="hidden" value="" id="bkid" name="bookid" >
<!-- formstep2 START -->
<div id="formstep2" style="display: none;">
  <div class="row">
    <div class="col-md-2">
      <p class="stripetext">1. Service</p>
      <div class="formstrip strip1"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">2. Time</p>
      <div class="formstrip strip2"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">3. Details</p>
      <div class="formstrip strip3" style="background: #d9d9d9!important;"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">4. Cart</p>
      <div class="formstrip strip4" style="background: #d9d9d9!important;"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">5. Payment</p>
      <div class="formstrip strip5" style="background: #d9d9d9!important;"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">6. Done</p>
      <div class="formstrip strip6" style="background: #d9d9d9!important;"></div>
    </div>
  </div>
  
<br>
<p class="step_para">Below you can find list of available time slots for <span id="sportname"></span> with {{ $UserProfileDetail['firstname']." ".$UserProfileDetail['lastname'] }}.</p>
<p class="step_para">Click on a time slot to proceed with the booking.</p>
<p>The selected time is not available anymore. Please, choose another time slot.</p>
<br>

<div class="form-group" style="width: 25%;">
      <select class="form-control" id="sel1" name="sellist1">
<option value="est"> Eastern Standard Time (EST)</option>
<option value="cst"> Central Standard Time (CST)</option>
<option value="mst"> Mountain Standard Time (MST)</option>
<option value="pst"> Pacific Standard Time (PST)</option>
      </select>
    </div>
<!-- Table Start -->
<form method="post" id="timedata">
<div class="step2_table" id="timedatatable">

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Sun {{date('F')}}</th>
        <th>Mon {{date('F', strtotime(' +1 day'))}}</th>
        <th>Tue {{date('F', strtotime(' +2 day'))}}</th>
        <th>Web {{date('F', strtotime(' +3 day'))}}</th>
        <th>Thu {{date('F', strtotime(' +4 day'))}}</th>
        <th>Fri {{date('F', strtotime(' +5 day'))}}</th>
        <th>Sat {{date('F', strtotime(' +6 day'))}}</th>
      </tr>
    </thead>
    <tbody>
     <tr>
        <td class="line_through">
        <input type="radio" class="form-check-input" name="hours['sun']" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['sun']" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['sun']" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['sun']" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['sun']" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['sun']" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['sun']" value=""> 10:00 am</td>
      </tr>
      <tr>
        <td><input type="radio" class="form-check-input" name="hours['mon']" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['mon']" value=""> 9:00 am</td>
        <td class="line_through">
        <input type="radio" class="form-check-input" name="hours['mon']" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['mon']" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['mon']" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['mon']" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['mon']" value=""> 10:00 am</td>
      </tr>
      <tr>
       <tr>
        <td><input type="radio" class="form-check-input" name="hours['tue']" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['tue']" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['tue']" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['tue']" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['tue']" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['tue']" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['tue']" value=""> 10:00 am</td>
      </tr>
      <tr>
        <td><input type="radio" class="form-check-input" name="hours['wed']" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['wed']" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['wed']" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['wed']" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['wed']" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['wed']" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['wed']" value=""> 10:00 am</td>
      </tr>
      <tr>
        <td><input type="radio" class="form-check-input" name="hours['thu']" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['thu']" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['thu']" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['thu']" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['thu']" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['thu']" value=""> 10:00 am</td>
        <td class="line_through"><input type="radio" class="form-check-input" name="thu" value=""> 10:00 am</td>
      </tr>
      <tr>
        <td><input type="radio" class="form-check-input" name="hours['fri']" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['fri']" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['fri']" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['fri']" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['fri']" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['fri']" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['fri']" value=""> 10:00 am</td>
      </tr>
      <tr>
        <td><input type="radio" class="form-check-input" name="hours['sat']" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['sat']" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['sat']" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['sat']" value=""> 8:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['sat']" value=""> 9:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['sat']" value=""> 10:00 am</td>
        <td><input type="radio" class="form-check-input" name="hours['sat']" value=""> 10:00 am</td>
      </tr>
    </tbody>
  </table>
  
</div>
<!-- Table End -->
<p id="msgtime" style="display:none"></p>

  <hr>
  <button type="button" class="stepbtn" href="#" onclick="$('#formstep1').show();$('#formstep2').hide();" style="float: left;">BACK</button>
  <button type="submit" class="stepbtn" href="#" style="float: right;">NEXT</button>
</form>
</div>

<!-- formstep2 END -->





<!-- formstep3 START -->
<div id="formstep3" style="display: none;">
   <div class="row">
  
    <div class="col-md-2">
      <p class="stripetext">1. Service</p>
      <div class="formstrip strip1"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">2. Time</p>
      <div class="formstrip strip2"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">3. Details</p>
      <div class="formstrip strip3"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">4. Cart</p>
      <div class="formstrip strip4" style="background: #d9d9d9!important;"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">5. Payment</p>
      <div class="formstrip strip5" style="background: #d9d9d9!important;"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">6. Done</p>
      <div class="formstrip strip6" style="background: #d9d9d9!important;"></div>
    </div>
  </div>
<br>
<p class="step_para">You selected to book <span id="dsn"></span> with {{ $UserProfileDetail['firstname']." ".$UserProfileDetail['lastname'] }} at <span id="dtime"></span> on <span id="ddate"></span>. Price for the service is <span id="dprice"></span>.</p>
<p class="step_para">Please provide your details in the form below to proceed with the booking.</p>
<br>
<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label for="F_name" style="color: #f53b49;">First Name:</label>
      <input type="text" class="form-control" id="usr" value="{{ Auth::user()->firstname. ' ' . Auth::user()->lastname }}" name="username">
    </div>
  </div>
  <div class="col-md-6">
     <div class="form-group">
      <label for="l_name" style="color: #f53b49;">Last Name:</label>
      <input type="text" class="form-control" id="usr" value="{{Auth::user()->lastname}}" name="username">
    </div>
  </div>
  <div class="col-md-6">
     <div class="form-group">
      <label for="phone" style="color: #f53b49;">Phone:</label>
      <input type="text" class="form-control" id="usr" value="{{Auth::user()->phone_number}}" name="username">
    </div>
  </div>
  <div class="col-md-6">
     <div class="form-group">
      <label for="email" style="color: #f53b49;">Email:</label>
      <input type="text" class="form-control" id="usr" value="{{ Auth::user()->email }}" name="username">
    </div>
  </div>
  
  <div class="col-md-12">
  <p id="notes" style="display:none"></p>
     <div class="form-group">
     
      <label for="email" style="color: #f53b49;">Notes (medical issue, request, etc.)</label>
      <textarea class="form-control" rows="5" id="comment"></textarea>
    </div>
  </div>
</div>
<hr>
  <button type="button" class="stepbtn" href="javascript:void(0)" onclick="$('#formstep2').show();$('#formstep3').hide();" style="float: left;">BACK</button>
  <button type="button" class="stepbtn addnote" href="javascript:void(0)" onclick="" style="float: right;">NEXT</button>
</div>
<!-- formstep3 END -->



<!-- formstep4 START -->
<div id="formstep4" style="display: none;">
  <div class="row">
    <div class="col-md-2">
      <p class="stripetext">1. Book Online</p>
      <div class="formstrip strip1"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">2. Service</p>
      <div class="formstrip strip1"></div>
    </div>
    <!--<div class="col-md-2">-->
    <!--  <p class="stripetext">2. Time</p>-->
    <!--  <div class="formstrip strip2"></div>-->
    <!--</div>-->
    <!--<div class="col-md-2">-->
    <!--  <p class="stripetext">3. Details</p>-->
    <!--  <div class="formstrip strip3"></div>-->
    <!--</div>-->
    <div class="col-md-2">
      <p class="stripetext">3. Cart</p>
      <div class="formstrip strip4"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">4. Payment</p>
      <div class="formstrip strip5" style="background: #d9d9d9!important;"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">5. Done</p>
      <div class="formstrip strip6" style="background: #d9d9d9!important;"></div>
    </div>
  </div>

<p class="step_para">Below you can find a list of the services you have selected for booking. Click BOOK MORE if you want to add more services.</p>
<p>The highlighted time is not available anymore. Please, choose another time slot.</p>

<button type="button" class="step3_bookmmore_btn" onclick="$('#formstepnew').show();$('#formstep4').hide();$('#whoistraining').val([]);$('.ss-value-delete').click()" href="javascript:void(0)">BOOK MORE</button>

<div id="getcart">
<table class="table">
    <thead>
      <tr>
        <th>Service Choice</th>
        <th>Date</th>
        <th>Time</th>
        <th>Number of Persons</th>
        <th>Price</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      
    </tbody>
  </table>
  </div>
<hr>
  <button type="button" class="stepbtn" href="#" onclick="$('#comment').val(' ');$('#formstep1').show();$('#formstep4').hide();$('.mymymy .ss-value-delete').click()" style="float: left;">BACK</button>
  <button type="button" class="stepbtn stipecheck" href="#" onclick="" style="float: right;">NEXT</button>
</div>
<!-- formstep4 END -->









<!-- formstep5 START -->
<div id="formstep5" style="display: none;">
  <div class="row">
    <div class="col-md-2">
      <p class="stripetext">1. Book Online</p>
      <div class="formstrip strip1"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">2. Service</p>
      <div class="formstrip strip1"></div>
    </div>
    <!--<div class="col-md-2">-->
    <!--  <p class="stripetext">2. Time</p>-->
    <!--  <div class="formstrip strip2"></div>-->
    <!--</div>-->
    <!--<div class="col-md-2">-->
    <!--  <p class="stripetext">3. Details</p>-->
    <!--  <div class="formstrip strip3"></div>-->
    <!--</div>-->
    <div class="col-md-2">
      <p class="stripetext">3. Cart</p>
      <div class="formstrip strip4"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">4. Payment</p>
      <div class="formstrip strip5"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">5. Done</p>
      <div class="formstrip strip6" style="background: #d9d9d9!important;"></div>
    </div>
  </div>

  
<div class="form-check" >
  <!--<label class="form-check-label" style="color: #5f5d5d !important;">
    <input type="radio" class="form-check-input" name="optradio">
     &nbsp; I will pay now with Stripe &nbsp; 
  </label> -->
  <br>
  <div class="payment" style="display:none"></div>
  <div class="paymentmsg" style="display:none"></div>
</div>
<hr>
  <button type="button" class="stepbtn" href="#" onclick="$('#formstep4').show();$('#formstep5').hide();" style="float: left;">BACK</button>
 <!-- <button type="button" class="stepbtn" style="float: right;">NEXT</button>-->
</div>
<!-- formstep5 END -->











<!-- formstep6 START -->
<div id="formstep6" style="display: none;">
  <div class="row">
    <div class="col-md-2">
      <p class="stripetext">1. Book Online</p>
      <div class="formstrip strip1"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">2. Service</p>
      <div class="formstrip strip1"></div>
    </div>
    <!--<div class="col-md-2">-->
    <!--  <p class="stripetext">2. Time</p>-->
    <!--  <div class="formstrip strip2"></div>-->
    <!--</div>-->
    <!--<div class="col-md-2">-->
    <!--  <p class="stripetext">3. Details</p>-->
    <!--  <div class="formstrip strip3"></div>-->
    <!--</div>-->
    <div class="col-md-2">
      <p class="stripetext">3. Cart</p>
      <div class="formstrip strip4"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">4. Payment</p>
      <div class="formstrip strip5"></div>
    </div>
    <div class="col-md-2">
      <p class="stripetext">5. Done</p>
      <div class="formstrip strip6"></div>
    </div>
  </div>
<br>
<p class="step_para1">Thank You! Your secure online booking with fitnessity is complete. an email with details of your booking has been sent to you and <span id="bsuname"></sapn>.</p>

<hr>
  <!--<button type="button" class="stepbtn" href="#" onclick="$('#formstep5').show();$('#formstep6').hide();" style="float: left;">BACK</button>
   <button type="button" class="stepbtn" href="#" onclick="$('#formstep2').hide();$('#formstep3').show();" style="float: right;">NEXT</button> -->
</div>
<!-- formstep6 END -->

</div>
</div>
  </div>   

 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.15/zebra_datepicker.src.js" defer></script>-->

  <link href="http://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.2.17/jquery.timepicker.min.css" rel="stylesheet">
  <link href="<?php echo Config::get('constants.FRONT_CSS'); ?>scheduleHours/jquery.businessHours.css" rel="stylesheet">
  <script src="<?php echo Config::get('constants.FRONT_JS'); ?>scheduleHours/jquery.businessHours.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.2.17/jquery.timepicker.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js" integrity="sha512-Izh34nqeeR7/nwthfeE0SI3c8uhFSnqxV0sI9TvTcXiFJkMd6fB644O64BRq2P/LA/+7eRvCw4GmLsXksyTHBg==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.15/zebra_datepicker.min.js" integrity="sha512-1y4nEuCxuenP6LwNp1dhlU0KnQd65JW270y7b8duFMSwAxxc9+LWlcjOpEOposA95fSMt9bCUAn2jvoqAQPrvA==" crossorigin="anonymous"></script>
  <script>
    $(document).ready(function()
    {
        var select_time;
        var service_id;
        $(document).on("change","input[name=service_select]",function(){
            select_time = $(this).attr("select_date_time")
            service_id = $(this).attr("service_id")
        });
        $("#whoistraining").change(function(){
            console.log($('#checkseats').val())
            console.log($("#whoistraining").val())
            if($("#whoistraining").val() == null){
                $("#frm3").val('')
            }
            else{
            if(($("#whoistraining").val()).length > $('#checkseats').val()){
                $("#whoistraining").val($("#whoistraining").val().splice(($("#whoistraining").val()).length-1,1))
            }
            $("#frm3").val(($("#whoistraining").val()).length)
            }
            
        })
        
        $("#formstepnewnext").click(function(){
            if($('input[name=service_select]').val() != undefined){
                console.log($('input[name=service_select]:checked').val())
                if($('input[name=service_select]:checked').val() != '' && $('input[name=service_select]:checked').val() != undefined){
                    var userid = '{{$user_id}}';
                      // var t = $(this).val();
                       //var then = $(this);
                      $.ajax({
                      url:'/getactivitychoice/'+userid+'/'+$('input[name=service_select]:checked').val()+'?service_id='+service_id,
                      type:'GET',
                      beforeSend: function () {
                         $('.loader').show();
                       },
                       complete: function () {
                         $('.loader').hide();
                       },
                      success: function (response) {
                       // testtime(userid,$('input[name=service_select]:checked').val());
                             $('.frm2').html(response.option);
                             $('#price,#dprice').val(response.price);
                             $('#dprice').text(response.price);
                             $('#pricepop').val(response.price);
                             $('.activitylocation').html(response.location);
                             $('.step2_table').html(response.time);
                             $('#sportname').text($('#frm1 option:selected').text());
                             $('#salestaxpercentage').val(response.salestaxpercentage);
                             $("#duestaxpercentage").val(response.duestaxpercentage);
                             
                             if(response.available==0){
                               
                                 $('#formstepnewerror').text('No seats available right now for Selected Catagory');
                                // $('span.available').text(response.available);
                                $('#step1').attr('disabled', true);
                                //$('#formstepnew').hide();$('#formstep1').show()
                             }else{
                                 
                                 $("#frm1").val($('input[name=service_select]:checked').val())
                               $('span.available').text(response.available);
                               $('#checkseats').val(response.available);
                               $('#formstepnew').hide();$('#formstep1').show()
                               //$('#step1').attr('disabled', false);
                             }
                        }
                    });
                    //$('#formstepnew').hide();$('#formstep1').show();
                }
                else{
                    $("#formstepnewerror").text("Select service")
                }
                console.log("if")
            }
            else{
                $("#formstepnewerror").text("Select service")
            }
            //onclick="$('#formstepnew').hide();$('#formstep1').show();"
        })
    //$('#bookonline').Zebra_DatePicker({format: "d-m-y"})
    var day;
    var day1;
    var arr = @json($final_available);
    console.log(arr)
    var current = moment().format('YYYY-MM-DD')
    $('#bookonline').Zebra_DatePicker({
         // disabled_dates: ['* * * 0,6']  ,
         //direction: [current, false],
         disabled_dates: ['* * * * *'],
        enabled_dates: arr,
        // enabled_dates: <?php //echo $final_available; ?>,
    always_visible: $('#bookonlinepicker-position'),
    container : $('#startingpicker-position'),
    onSelect: function(date) {
        console.log(date)
        $(".select-date-span").text(moment(date,"YYYY-MM-DD").format("dddd MMMM Do YYYY"))
         day = moment(date,"YYYY-MM-DD").format("dddd");
         day1 = moment(date,"YYYY-MM-DD").format("YYYY-MM-DD");
        var userid = '{{$user_id}}'
            $.ajax({
                url:'/get-booking-service-data?date='+date+'&user_id='+userid,
                type:'GET',
                //dataType: 'json',
                //data:inputData,
                //processData:false,
                //contentType:false,
                 beforeSend: function () {
                    $('.loader').show();
                  },
                  complete: function () {
                    $('.loader').hide();
                  },
                success: function (response) {
                  if(response.data.length != 0){
                    $(".box-div").empty();
                    var str = '';
                    response.data.forEach(function(value,key){
                        if(day == 'Sunday'){
                            var serv_slot = JSON.parse(value.serv_time_slot)
                            serv_slot.forEach(function(value2,key2){
                                if(value2.sunday_start != '')
                                str = str + '<div class="service-box-div"><input class="rd" service_id="'+value.id+'" select_date_time="'+value2.sunday_start+'" type="radio" name="service_select" value='+value.sport+'>'+value2.sunday_start+' - '+value.title+'<div class="lft-seat">'+ value.available_seats +' Slots Left</div></div>'
                            })
                        }
                        else if(day == 'Monday'){
                            var serv_slot = JSON.parse(value.serv_time_slot)
                            serv_slot.forEach(function(value2,key2){
                                if(value2.monday_start != '')
                                str = str + '<div class="service-box-div"><input class="rd" service_id="'+value.id+'" select_date_time="'+value2.monday_start+'" type="radio" name="service_select" value='+value.sport+'>'+value2.monday_start+' - '+value.title+'<div class="lft-seat">'+ value.available_seats +' Slots Left</div></div>'
                            })
                        }
                        else if(day == 'Tuesday'){
                            var serv_slot = JSON.parse(value.serv_time_slot)
                            serv_slot.forEach(function(value2,key2){
                                if(value2.tuesday_start != '')
                                str = str + '<div class="service-box-div"><input class="rd" service_id="'+value.id+'" select_date_time="'+value2.tuesday_start+'" type="radio" name="service_select" value='+value.sport+'>'+value2.tuesday_start+' - '+value.title+'<div class="lft-seat">'+ value.available_seats +' Slots Left</div></div>'
                            })
                        }
                        else if(day == 'Wednesday'){
                            var serv_slot = JSON.parse(value.serv_time_slot)
                            serv_slot.forEach(function(value2,key2){
                                if(value2.wednesday_start != '')
                                str = str + '<div class="service-box-div"><input class="rd" service_id="'+value.id+'" select_date_time="'+value2.wednesday_start+'" type="radio" name="service_select" value='+value.sport+'>'+value2.wednesday_start+' - '+value.title+'<div class="lft-seat">'+ value.available_seats +' Slots Left</div></div>'
                            })
                        }
                        else if(day == 'Thursday'){
                            var serv_slot = JSON.parse(value.serv_time_slot)
                            serv_slot.forEach(function(value2,key2){
                                if(value2.thrusday_start != '')
                                str = str + '<div class="service-box-div"><input class="rd" service_id="'+value.id+'" select_date_time="'+value2.thrusday_start+'" type="radio" name="service_select" value='+value.sport+'>'+value2.thrusday_start+' - '+value.title+'<div class="lft-seat">'+ value.available_seats +' Slots Left</div></div>'
                            })
                        }
                        else if(day == 'Friday'){
                            var serv_slot = JSON.parse(value.serv_time_slot)
                            serv_slot.forEach(function(value2,key2){
                                if(value2.friday_start != '')
                                str = str + '<div class="service-box-div"><input class="rd" service_id="'+value.id+'" select_date_time="'+value2.friday_start+'" type="radio" name="service_select" value='+value.sport+'>'+value2.friday_start+' - '+value.title+'<div class="lft-seat">'+ value.available_seats +' Slots Left</div></div>'
                            })
                        }
                        else{
                            var serv_slot = JSON.parse(value.serv_time_slot)
                            serv_slot.forEach(function(value2,key2){
                                
                                if(value2.saturday_start != '')
                                 str = str + '<div class="service-box-div"><input class="rd" service_id="'+value.id+'" select_date_time="'+value2.saturday_start+'" type="radio" name="service_select" value='+value.sport+'>'+value2.saturday_start+' - '+value.title+'<div class="lft-seat">'+ value.available_seats +' Slots Left</div></div>'
                            
                                
                                })
                        }
                        if(key+1 == response.data.length){
                             $(".box-div").append(str)
                        }
                        
                    })
                    //var str = 
                   
                  }
                  else{
                    $(".box-div").empty();
                    $(".box-div").append("<div class='service-box-div'>No Service found.</div>")
                  }
                }
          });
    }
});
    

      $("#frm3").keyup(function(){
        $('#msg').hide();
      if(!$.isNumeric($(this).val())){
       $('#msg').text('Please Only number').show();
       $(this).val('');
       $(this).focus();
      }
      });
       var x = new SlimSelect({
    select: '.whois'
  });
 
      //$(document).on('click','#step1', function (e) {
      $('#timedata').click(function() {
       // e.preventDefault();
        //var inputData = new FormData($(this)[0]);
        var bookid =$('#bkid').val();
        var inputData = new FormData()
       inputData.append('_token','{{csrf_token()}}');
       inputData.append('bookid',bookid);
       var d = moment(day1).format('ddd').toLowerCase();
       var t = moment(day1).format('YYYY-MM-DD');
       console.log(d)
       console.log(t)
       //vat txt = hours[wed]: 2020-10-14_00:00 am
       inputData.append('hours['+d+']',t+'_'+select_time);
       
//          var t = $('.form-check-input:checked').val();
//  t= t.split("_");
// $('#ddate').text(t[0]);
// $('#dtime').text(t[1]);
        $.ajax({
                url:'/savetimes',
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
                  if(response.status==1){
                    $('input[type="radio"]').prop( "checked", false );
                    $('#bkid').val($('#bkid').val());
                    $('.cart').click()
                   // $('#timedata').click();
                     $('#formstep2').hide();$('#formstep4').show();
                  }else{
                     $('#bkid').val($('#bkid').val());
                     $('#msgtime').text(response.msg).show();
                  }
                 
                }
          });
      });
       $('#firststepsform').submit(function(e) {
         $('#step1').attr('disabled', false);
        e.preventDefault();
        var numperson = $('#frm3').val();
        if($('#frm1').val()==''){
          $('#msg').text('Please fill the form').show();
          return false
        }
        if(numperson==''){
          $('#msg').text('Please enter the number of persons ').show();
          return false
        }
        if($('#activitylocation').val()==''){
          $('#msg').text('Please select activity location ').show();
          return false
        }
        $('#dsn').text($('#frm1 option:selected').text());
        var avseats = $('.available').text();
        avseats = parseInt(avseats);
        if(avseats<numperson){
        $('#msg').text('Please enter Number of persons less then '+avseats).show();
                    $('#step1').attr('disabled', true);
                    return false;
        }
        $('#comment').val("");
        
        var inputData = new FormData($(this)[0]);
        inputData.append('_token','{{csrf_token()}}');
         inputData.append('business_id','{{$user_id}}');
         inputData.append('price',$('#price').val());
         inputData.append('numberofpersons',numperson);
         inputData.append('service_id',service_id);
        $.ajax({
                url:'/savedirecthirerequest',
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
                  
                  if(response.type=='success'){
                    $('#bkid').val(response.bookid);
                    $('#timedata').click();
                     $('#formstep1').hide();$('#formstep4').show();
                     document.getElementById("firststepsform").reset();
                  }
                 
                }
          });
          
      });

      function testtime(userid,t){
        $.ajax({
          url:'/savetime/'+userid+'/'+t,
          type:'GET',
          beforeSend: function () {
             $('.loader').show();
           },
           complete: function () {
             $('.loader').hide();
           },
          success: function (response) {
            //$('#timedatatable').html(response);
          }
        });
      }
      $('.frm4').datepicker({
      format: 'dd-mm-yyyy'
    });
     $('.stateform').timepicker({
            timeFormat: 'h:mm p',
            interval: 30, 
            startTime: '00:00',
            dynamic: true,
            dropdown: true,
            scrollbar: true
        });
        /*
 $(document).on('click','.frm4', function () {
       
    });
    $(document).on('click','.stateform', function () {
          
        }); */
    
      $(document).on('change','.selectcatagory', function () {
        
         $('#msg').text('').hide();
        var userid = '{{$user_id}}';
           var t = $(this).val();
           var then = $(this);
          $.ajax({
          url:'/getactivitychoice?service_id='+service_id+'/'+userid+'/'+t,
          type:'GET',
          beforeSend: function () {
             $('.loader').show();
           },
           complete: function () {
             $('.loader').hide();
           },
          success: function (response) {
           // testtime(userid,t);
                 $('.frm2').html(response.option);
                 $('#price,#dprice').val(response.price);
                 $('#dprice').text(response.price);
                 $('#pricepop').val(response.price);
                 $('.activitylocation').html(response.location);
                 $('.step2_table').html(response.time);
                 $('#sportname').text($('#frm1 option:selected').text());
                 $('#salestaxpercentage').val(response.salestaxpercentage);
                 $("#duestaxpercentage").val(response.duestaxpercentage);
                 
                 if(response.available==0){
                   
                     $('#msg').text('No seats available right now for Selected Catagory').show();
                     $('span.available').text(response.available);
                    $('#step1').attr('disabled', true);
                 }else{
                   $('span.available').text(response.available);
                   $('#checkseats').val(response.available);
                   $('#step1').attr('disabled', false);
                 }
            }
        });
      });

/* cart */
$('.cart').click(function(){
   $.ajax({
          url:'/cart?booking_id='+$('#bkid').val(),
          type:'GET',
          beforeSend: function () {
             $('.loader').show();
           },
           complete: function () {
             $('.loader').hide();
           },
          success: function (response) {
            $('#formstep3').hide();$('#formstep4').show();
               $('#getcart').html(response);
            }
        });
});
/* cart end*/
/* addnote */
$('.addnote').click(function(){
  $('#notes').hide();
  if($('#comment').val()==''){
    $('#notes').text('Please enter the Notes, if no notes, type none').show();
    return false;
  }else{
$.ajax({
          url:'/addnote/'+$('#bkid').val()+'/'+$('#comment').val(),
          type:'GET',
          beforeSend: function () {
             $('.loader').show();
           },
           complete: function () {
             $('.loader').hide();
           },
          success: function (response) {
            
            $('#comment').val();
           $.ajax({
          url:'/cart',
          type:'GET',
          beforeSend: function () {
             $('.loader').show();
           },
           complete: function () {
             $('.loader').hide();
           },
          success: function (response) {
            $('#formstep3').hide();$('#formstep4').show();
               $('#getcart').html(response);
            }
        });
              if(response.status==1){
                
              }
            }
        });
  }
  
});
/* add note end*/


/* Payment */
$('.stipecheck').click(function(){
  var userid = '{{$user_id}}';
   $.ajax({
          url:'/pay?user_id='+userid+'&service_id='+service_id,
          type:'GET',
          beforeSend: function () {
             $('.loader').show();
           },
           complete: function () {
             $('.loader').hide();
           },
          success: function (response) {
            //return false;
            if(response.status!=1){
$('#formstep4').hide();$('#formstep5').show();
               $('.payment').html(response);
               $('.payment').show();
            }
            else{
              $('#formstep4').hide();$('#formstep1').show();
               $('#msg').text(response.msg).show();
              
               
            }
               
            }
        });
});


/* payment end*/

    });
  </script>
</section>
@endsection

<style>

.nw-user-img img {
    width: 50% !important;
}
#msg , #notes , #msgtime{
    background: #ff3636b0;
    padding: 7px 0px 3px 12px;
    margin-top: 10px;
    border-radius: 5px;
    color: #fff;
}
  button.stepbtn {
    color: #fff;
    background: #f53b49;
    border: 0;
    border-radius: 5px;
    width: 75px;
    padding: 6px;
    font-weight: 600;
    font-size: 14px;
}
.formstrip {
    background: #f53b49;
    height: 8px;
    border-radius: 6px;
}
.stripetext{
  color: #f53b49;
    font-weight: 600;
}
/*label {
    color: #f53b49;
}*/
.step_para {
    color: #000000;
    font-weight: 600;
}
.step_para1 {
    color: #000000;
    font-weight: 600;
    padding: 10px;
    background: #60ff6652;
}
.step1_days{
    border: 0px solid red;
    width: 30px;
    height: 30px;
    background: #f53b49;
    border-radius: 20px;
}
.col-md-1 {
    margin: 2px;
}
#editpopupcart{width: 100%;
display: none;
    background: aliceblue;
    height: 10px;
    position: absolute;
    z-index: 99;
    }
.step3_bookmmore_btn{
  color: #fff;
    background: #f53b49;
    border: 0;
    border-radius: 5px;
    padding: 7px 15px;
    font-weight: 600;
    font-size: 14px;
}
/* The container */
.Daysss {
  display: inline-block;
  position: relative;
  padding-left: 35px;
  margin-top: 10px !important;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
table.table.table-bordered {
    display: initial;
}
th {
    width: 117px;
}
/* Hide the browser's default checkbox */
.Daysss input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 30px;
  width: 30px;
  background-color: #eee;
  border-radius: 50px;
}

/* On mouse-over, add a grey background color */
.Daysss:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.Daysss input:checked ~ .checkmark {
  background-color: #f53b49;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the checkmark when checked */
.Daysss input:checked ~ .checkmark:after {
  display: block;
}
.loader {
  display:none;
       position: absolute;
    z-index: 9;
    height: 100%;
    width: 70%;
    text-align: center;
        background: #bdbdbd1f;
} 
/* Style the checkmark/indicator */
.Daysss .checkmark:after {
  left: 12px;
  top: 9px;
  width: 6px !important;
  height: 10px;
  border: solid white;
  border-width: 0 3px 3px 0;
  -webkit-transform: rotate(45deg);
  -ms-transform: rotate(45deg);
  transform: rotate(45deg);
}
.step2_table  th {
    background: #f53b49;
    color: #fff;
    text-align: center;
    font-size: 14px;
    font-weight: 500;
}
.step2_table tbody{
  text-align: center;
    font-size: 14px;
}
.line_through{
  text-decoration: line-through;
  color: #80808061;
}
.cartedit{
     position: absolute;
    background: #fff;
    padding-top: 0px;
    z-index: 1;
    width: 77%;
    margin: -12px 0px 0px -25px;
}
td a {
    display: inherit;
    padding: 4px;
}
</style>