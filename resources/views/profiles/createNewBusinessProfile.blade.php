@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<?php
    use App\BusinessSubscriptionPlan;
    use App\BusinessPriceDetailsAges;
    use App\BusinessPriceDetails;
    use App\StaffMembers;

    $fitnessity_fee= 0;
    //$bspdata = BusinessSubscriptionPlan::where('id',1)->first();
    //$fitnessity_fee = $bspdata->fitnessity_fee;
    $fitnessity_fee = Auth::user()->fitnessity_fee;

    function timeSlotOption($lbl, $val) {
        $start = "00:00"; //you can write here 00:00:00 but no t need to it
        $end = "23:30";
        $tStart = strtotime($start);
        $tEnd = strtotime($end);
        $tNow = $tStart;
        $startpm = "00:00"; //you can write here 00:00:00 but not need to it
        $endpm = "11:30";
        echo '<select name="'.$lbl.'[]" id="'.$lbl.'" class="'.$lbl.' form-control">';
        echo '<option value="">Select Time</option>';

        while($tNow <= $tEnd){
            if($val == date("H:i",$tNow)) {
                echo '<option selected value="'.date("H:i",$tNow).'">'.date("h:i A",$tNow).'</option>';
            } else {
                echo '<option value="'.date("H:i",$tNow).'">'.date("h:i A",$tNow).'</option>';
            }
            $tNow = strtotime('+15 minutes',$tNow);
        }

        echo '</select>';
    }

    function timeSlotOptionforservice($lbl, $val) {
        $start = "00:00"; //you can write here 00:00:00 but not need to it
        $end = "23:30";
        $tStart = strtotime($start);
        $tEnd = strtotime($end);
        $tNow = $tStart;
        $startpm = "00:00"; //you can write here 00:00:00 but not need to it
        $endpm = "11:30";
        echo '<select name="'.$lbl.'" id="'.$lbl.'" class="'.$lbl.' form-control">';
        echo '<option value="">Select Time</option>';
        while($tNow <= $tEnd){
            if($val == date("H:i",$tNow)) {
                echo '<option selected value="'.date("H:i",$tNow).'">'.date("h:i A",$tNow).'</option>';
            } else {
                echo '<option value="'.date("H:i",$tNow).'">'.date("h:i A",$tNow).'</option>';
            }
            $tNow = strtotime('+15 minutes',$tNow);
        }

        echo '</select>';
    }
      $profile_pic1  = [];
?>

<?php @$hours = json_decode($service['serv_time_slot'],true); ?>

<?php 
    use App\Sports;
    $sportsdata = Sports::where('is_deleted','0')->where('parent_sport_id', '=', NULL)->orWhere('parent_sport_id', '=', "''")->orderBy('sport_name')->get();
    $sportsparent  = Sports::where('is_deleted','0')->where('parent_sport_id', '!=', "''")->where('parent_sport_id', '!=', NULL)->orderBy('sport_name')->get();
   /* $sportsdata = Sports::where('is_deleted',0)->where('parent_sport_id', '=' ,'')->get();*/
   /* $sportsparent = Sports::where('is_deleted',0)->where('parent_sport_id', '!=' ,'')->get();*/
    $user = Auth::user();
?>

<!-- Navigation-->

<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">
        <div class="col-md-2" style="background: black;">
           @include('business.businessSidebar')
        </div>

        <div class="col-md-10">
            <!-- Page Content-->
            <form id="frmWelcome" name="frmWelcome" method="post" action="{{route('addbstep')}}">
                @csrf
                <input type="hidden" name="userid" id="userid" value="{{Auth::user()->id}}">
                <input type="hidden" name="bstep" id="bstep1" value="2">
                <input type="hidden" name="cid" value="0">
                <input type="hidden" name="serviceid" value="0">
                <div class="container-fluid p-0" id="frmWelcomediv" style="display:none">
                    <div class="tab-hed">Create Your Business Profile</div>
                    <hr style="border: 15px solid black;width: 104%;margin-left: -38px;"> 
                    <section class="row">
                        <div class="col-md-12 text-center">
                            <div class="tab-hed">Welcome To Fitnessity For Business Profile Setup</div>
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="tab-para">Ready To Start Earning More ? </div>
                            <br>
                            <p class="tab-para1">Your business profile will be like your resume. It's your first point of contact for your current and potential clients.You can offer your services online, at your place of business, or on the go. Start by adding your business information, images, videos, services, prices and verify your business by completing a background check. Once you're done setting up, you're ready to start receiving bookings from customers looking for the activities and services you offer.</p>
                            <p class="tab-para1">Things to Know</p>
                            <ul>
                                <li>You are recoomended to complete a background check to earn the trust of potential customers.</li>
                                <li>To get reviews, a customer must participate in the service you offer. Fitnessity doesn't allow random reviews from cutomers to outsiders.</li>
                                <li>The Fitnessity Quality Control team will be monitoring to make sure that you are conducting business with the highest standars.</li>
                            </ul>

                            <p class="tab-para1">Add your business information, images, videos, services, prices, get verified by completed a background check, start getting reviews,<br>manage your customers and accounts and much more. Start receiving bookings from customers looking for activites and services your offer.</p>
                        </div>

                        <div class="col-md-12">
                            <br/><br/><br/>
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn-nxt" id="next-btn">Continue <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            <br/>
                        </div>
                    </section>
                </div>
            </form>

            <form id="companyDetail" name="companyDetail" method="post" action="{{route('addbusinesscompanydetail')}}" enctype="multipart/form-data">
                <?php
                    $companyId = $Companyname = $Address = $City = $State = $ZipCode = $Country = $EINnumber = $Establishmentyear = $Businessusername = $Profilepic = $Firstnameb = $Lastnameb = $Emailb = $Phonenumber = $Aboutcompany = $Shortdescription = $EmbedVideo = $dba_business_name = $additional_address = $neighborhood = $business_phone = $business_email = $business_website = $business_type = $latitude = $longitude ="" ;
                    if(isset($business_details)){
                        if(isset($business_details['cid']) && !empty($business_details['cid'])) {
                            $companyId = $business_details['cid'];
                        }

                        if(isset($business_details['Companyname']) && !empty($business_details['Companyname'])) {
                            $Companyname = $business_details['Companyname'];
                        }

                        if(isset($business_details['Address']) && !empty($business_details['Address'])){
                            $Address = $business_details['Address'];
                        }

                        if(isset($business_details['City']) && !empty($business_details['City'])) {
                            $City = $business_details['City'];
                        }

                        if(isset($business_details['State']) && !empty($business_details['State'])) {
                            $State = $business_details['State'];
                        }

                        if(isset($business_details['ZipCode']) && !empty($business_details['ZipCode'])){
                            $ZipCode = $business_details['ZipCode'];
                        }

                        if(isset($business_details['Country']) && !empty($business_details['Country'])) {
                            $Country = $business_details['Country'];
                        }

                        if(isset($business_details['EINnumber']) && !empty($business_details['EINnumber'])) {
                            $EINnumber = $business_details['EINnumber'];
                        }

                        if(isset($business_details['Establishmentyear']) && !empty($business_details['Establishmentyear'])) {
                            $Establishmentyear = $business_details['Establishmentyear'];
                        }

                        if(isset($business_details['Businessusername']) && !empty($business_details['Businessusername'])) {
                            $Businessusername = $business_details['Businessusername'];
                        }

                        if(isset($business_details['Profilepic']) && !empty($business_details['Profilepic'])) {
                            $Profilepic = $business_details['Profilepic'];
                        }

                        if(isset($business_details['Firstnameb']) && !empty($business_details['Firstnameb'])) {
                            $Firstnameb = $business_details['Firstnameb'];
                        }

                        if(isset($business_details['Lastnameb']) && !empty($business_details['Lastnameb'])) {
                            $Lastnameb = $business_details['Lastnameb'];
                        }

                        if(isset($business_details['Emailb']) && !empty($business_details['Emailb'])) {
                            $Emailb = $business_details['Emailb'];
                        }

                        if(isset($business_details['Phonenumber']) && !empty($business_details['Phonenumber'])) {
                            $Phonenumber = $business_details['Phonenumber'];
                        }

                        if(isset($business_details['Aboutcompany']) && !empty($business_details['Aboutcompany'])) {
                            $Aboutcompany = $business_details['Aboutcompany'];
                        }

                        if(isset($business_details['Shortdescription']) && !empty($business_details['Shortdescription'])) {
                            $Shortdescription = $business_details['Shortdescription'];
                        }

                        if(isset($business_details['EmbedVideo']) && !empty($business_details['EmbedVideo'])) {
                            $EmbedVideo = $business_details['EmbedVideo'];
                        }

                            //  $dba_business_name = $additional_address = $neighborhood = $business_phone = $business_email = $business_website = $business_type

                        if(isset($company_info['dba_business_name']) && !empty($company_info['dba_business_name'])) {
                           $dba_business_name = $company_info['dba_business_name'];
                        }

                        if(isset($company_info['additional_address']) && !empty($company_info['additional_address'])) {
                            $additional_address = $company_info['additional_address'];
                        }

                        if(isset($company_info['neighborhood']) && !empty($company_info['neighborhood'])){
                            $neighborhood = $company_info['neighborhood'];
                        }

                        if(isset($company_info['business_phone']) && !empty($company_info['business_phone'])) {
                            $business_phone = $company_info['business_phone'];
                        }

                        if(isset($company_info['business_email']) && !empty($company_info['business_email'])) {
                            $business_email = $company_info['business_email'];
                        }

                        if(isset($company_info['business_website']) && !empty($company_info['business_website'])) {
                            $business_website = $company_info['business_website'];
                        }

                        if(isset($company_info['business_type']) && !empty($company_info['business_type'])) {
                            $business_type = $company_info['business_type'];
                        }

                        if(isset($company_info['longitude']) && !empty($company_info['longitude'])) {
                            $longitude = $company_info['longitude'];
                        }

                        if(isset($company_info['latitude']) && !empty($company_info['latitude'])) {
                            $latitude = $company_info['latitude'];
                        }

                        /*var_dump($company_info); exit();*/
                    } 
                ?>

                @csrf

                <input type="hidden" name="userid" id="userid" value="{{Auth::user()->id}}">
                <input type="hidden" name="cid" value="{{Auth::user()->cid}}">
                <input type="hidden" name="serviceid" value="{{Auth::user()->serviceid}}">
                <input type="hidden" name="bstep" id="bstep2" value="{{Auth::user()->bstep}}">
                <div class="container-fluid p-0" id="companyDetaildiv" style="display: none;">
                    <div class="tab-hed">Business Details Setup</div>
                    <hr style="border: 15px solid black;width: 104%;margin-left: -38px;">
                    <section class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="row com-setup-space" style="padding-right: 200px;">

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="email">Legal Business Name <span id="star">*</span></label>
                                    <input type="text" class="form-control" name="Companyname" id="b_companyname" size="30" maxlength="255" placeholder="Company Name" value="{{ $Companyname }}" required>
                                    <span class="error" id="b_cmpo"></span>
                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="pwd">dba Business Name <span id="star">*</span>(If its the same as legal name, add it here again.)</label>
                                    <input type="text" class="form-control" autocomplete="nope" name="dba_business_name" id="b_dba_business_name" placeholder="Dba Business name" value="{{ $dba_business_name }}" required>
                                    <span class="error" id="b_addr"></span>

                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="pwd">Business Address <span id="star">*</span></label>
                                    <input type="text" class="form-control" autocomplete="nope" name="Address" id="b_address" placeholder="Address" value="{{ $Address }}" required>
                                    <span class="error" id="b_addr"></span>
                                </div>

                                <div id="map" style="display: none;"></div>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="pwd">Additional Address Info</label>
                                    <input type="text" class="form-control" autocomplete="nope" name="additional_address" id="b_additional_address" placeholder="Additional Address" value="{{ $additional_address }}">
                                    <span class="error" id="b_addr"></span>
                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="City">City <span id="star">*</span></label>
                                    <input type="text" class="form-control" name="City" id="b_city" size="30" placeholder="City" maxlength="50" value="{{ $City }}" required>
                                    <span class="error" id="b_ct"></span>
                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                  <label for="State">State <span id="star">*</span></label>
                                  <input type="text" class="form-control" name="State" id="b_state" size="30" placeholder="State" maxlength="50" value="{{ $State }}" required>
                                  <span class="error" id="b_sta"></span>
                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="email">Zip Code <span id="star">*</span></label>
                                    <input type="text" class="form-control" name="ZipCode" id="b_zipcode" size="30" placeholder="Zip Code" value="{{ $ZipCode }}" maxlength="20" required>
                                    <span class="error" id="b_zip"></span>
                                </div>

                                <input type="hidden" name="lon" id="lon" value="{{$longitude}}">
                                <input type="hidden" name="lat" id="lat" value="{{$latitude}}">
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="pwd">Neighborhood/Location/Area</label>
                                    <input type="text" class="form-control" name="neighborhood" id="b_neighborhood" size="30" placeholder='Neighborhood' value="{{ $neighborhood }}" maxlength="50">
                                    <span class="error" id="b_cont"></span>
                                </div>

                                <?php   
                                    $phone_num = $business_phone;
                                    if (preg_match('/()-/', $phone_num)){
                                        $phone_number = $phone_num;
                                    }else{
                                        
                                        $phone_number = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $phone_num);
                                    }
                                ?>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="pwd">Business Phone Number <span id="star">*</span></label>
                                    <input type="text" class="form-control" name="business_phone" id="b_business_phone" placeholder="Business Phone" value="{{ $phone_number }}" onkeyup="changeformate_b_business_phone();" maxlength="14" required>
                                    <span class="error" id="b_usertag"></span>
                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="pwd">Business Email <span id="star">*</span></label>
                                    <input type="text" class="form-control" name="business_email" id="b_business_email" placeholder="Business email" value="{{ $business_email }}" required>
                                    <span class="error" id="b_usertag"></span>
                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="pwd">Business Username <span id="star">*</span></label>
                                    <input type="text" class="form-control" name="Businessusername" id="b_business_user_tag" placeholder="Business User Tag" value="{{ $Businessusername }}" required>
                                    <span class="error" id="b_usertag"></span>
                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="pwd">Business Website</label>
                                    <input type="text" class="form-control" name="business_website" id="b_business_user_tag" placeholder="Business Website" value="{{ $business_website }}" >
                                    <span class="error" id="b_usertag"></span>
                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="pwd">Business type <span id="star">*</span></label>
                                    <select class="form-control" name="business_type" required>
                                      <option {{$business_type == "individual" ? 'selected="selected"' : ''}} value="individual">Individual</option>
                                      <option {{$business_type == "business" ? 'selected="selected"' : ''}} value="individual">Business</option>
                                    </select>
                                    <span class="error" id="b_usertag"></span>
                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="pwd">Embed Video Code </label>
                                    <input type="text" class="form-control" name="EmbedVideo" id="b_embedvideo" placeholder="Video Code" value="{{ $EmbedVideo }}" maxlength="150">
                                    <span id="b_embedvideo">Example: https://www.youtube.com/embed/<b>rW_fwcmyIfk</b></span>
                                </div>

                                <hr style="border: 1px solid #d4cfcf;width: 100%;">
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="pwd" style="font-size: 20px;font-weight: bold;">Upload Profile Image</label>
                                    <input type="file" class="form-control" name="Profilepic" id="profile_pic" onchange="readURL(this);" style="height: 45px;">
                                    <input type="hidden" name="oldProfilepic" id="oldProfilepic" value="{{ $Profilepic }}" />
                                </div>

                                <div class="form-group col-md-6 col-sm-6 text-center col-xs-12">
                                    @if(!empty($Profilepic) && File::exists(public_path("/uploads/profile_pic/thumb/".$Profilepic)))
                                        <img src="{{ url('/public/uploads/profile_pic/thumb/'.$Profilepic) }}" class="pro_card_img blah" id="showimg">
                                    @else
                                        <img src="{{ url('/public/images/default-avatar.png') }}" class="pro_card_img blah" id="showimg">
                                    @endif

                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <input type="hidden" value="0" id="mybusinessid" />
                                    <label for="pwd">Company Representative First Name <span id="star">*</span></label>
                                    <input type="text" class="form-control" name="Firstnameb" id="b_firstname" size="30" maxlength="80" placeholder="Company Representative First Name" value="{{ $Firstnameb }}" required>
                                    <span class="error" id="b_firstnm"></span>
                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="pwd">Company Representative Last Name <span id="star">*</span></label>
                                    <input type="text" class="form-control" name="Lastnameb" id="b_lastname" size="30" maxlength="80" placeholder="Company Representative Last Name" value="{{ $Lastnameb }}" required>
                                    <span class="error" id="b_lastnm"></span>
                                </div>

                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="pwd">Email</label>
                                    <input type="email" class="form-control myemail" name="Emailb" id="b_email" autocomplete="off" placeholder="Email Address" size="30" maxlength="80" value="{{ $Emailb }}">
                                    <span class="error" id="b_eml"></span>
                                </div>
                                <?php   
                                    $phone_num_con = $Phonenumber;
                                    if (preg_match('/()-/', $phone_num)){
                                        $phone_number_con = $phone_num_con;
                                    }else{
                                        
                                        $phone_number_con = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $phone_num_con);
                                    }
                                ?>
                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                    <label for="pwd">Contact Number </label>
                                    <input type="text" class="form-control" name="Phonenumber" id="b_contact" size="30" maxlength="14" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Contact No" value="{{ $phone_number_con }}"  onkeyup="changeformate()">
                                    <span class="error" id="b_cot"></span>
                                </div>

                                <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                    <label for="pwd">Quick Business Intro <!-- <span id="star">*</span> --></label>
                                    <textarea class="form-control" rows="4" placeholder="Tell Us Somthing About Company..." name="Aboutcompany" id="about_company" maxlength="150">{{ $Aboutcompany }}</textarea>
                                    <div class="text-right"><span id="quick_business_left">150</span> Characters Left</div>
                                    <span class="error" id="b_abt"></span>

                                </div>

                                <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                    <label for="pwd">Company Description<!--  <span id="star">*</span> --></label>
                                    <textarea class="form-control" rows="10" placeholder="Tell Us Somthing About Company in short..." name="Shortdescription" id="short_description" maxlength="1000">{{ $Shortdescription }}</textarea>
                                   <div class="text-right"><span id="company_desc_left">1000</span> Characters Left</div>
                                    <span class="error" id="b_short"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-xs-12">
                            <br/>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button type="button" class="btn-bck" id="bck-nxt1"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <div class="text-right btn-txt-rp">
                                    <button type="submit" class="btn-nxt" id="btn-nxt1">Save & Continue <i class="fa fa-arrow-right"></i></button>
                                  </div>
                                </div>
                            </div>
                            <br>
                        </div>
                    </section>
                </div>
            </form>

            <form id="empHistory" name="empHistory" method="post" action="{{route('addbusinessexperience')}}">
                @csrf
                <input type="hidden" name="userid" id="userid" value="{{Auth::user()->id}}">
                <input type="hidden" name="cid" value="{{Auth::user()->cid}}">
                <input type="hidden" name="serviceid" value="{{Auth::user()->serviceid}}">
                <input type="hidden" name="bstep" id="bstep3" value="{{Auth::user()->bstep}}">
                <div class="container-fluid p-0" id="empHistorydiv" style="display: none;">
                    <div class="tab-hed">Tells us About Your Experience</div>
                    <hr style="border: 15px solid black;width: 104%;margin-left: -38px;">
                    <?php  $i=0;
                    if(isset($business_exp) && !empty($business_exp)) {
                        $frm_organisationname = $frm_position = $frm_servicestart = $frm_serviceend = $frm_ispresentcheck = array();
                        $frm_course = $frm_university = $frm_passingyear = $certification = $frm_passingdate = $skill_type = $skillcompletion = $frm_skilldetail = array();
                        if(isset($business_exp['frm_organisationname']) && !empty($business_exp['frm_organisationname'])) {
                            $frm_organisationname = json_decode($business_exp['frm_organisationname'],true);
                        }

                        if(isset($business_exp['frm_position']) && !empty($business_exp['frm_position'])) {
                            $frm_position = json_decode($business_exp['frm_position'],true);
                        }

                        if(isset($business_exp['frm_ispresentcheck']) && !empty($business_exp['frm_ispresentcheck'])) {
                            $frm_ispresentcheck = json_decode($business_exp['frm_ispresentcheck'],true);
                        }

                        if(isset($business_exp['frm_servicestart']) && !empty($business_exp['frm_servicestart'])) {
                            $frm_servicestart = json_decode($business_exp['frm_servicestart'],true);
                        }

                        if(isset($business_exp['frm_serviceend']) && !empty($business_exp['frm_serviceend'])) {
                            $frm_serviceend = json_decode($business_exp['frm_serviceend'],true);
                        }

                        if(isset($business_exp['frm_course']) && !empty($business_exp['frm_course'])) {
                            $frm_course = json_decode($business_exp['frm_course'],true);
                        }

                        if(isset($business_exp['frm_university']) && !empty($business_exp['frm_university'])) {
                            $frm_university = json_decode($business_exp['frm_university'],true);
                        }

                        if(isset($business_exp['frm_passingyear']) && !empty($business_exp['frm_passingyear'])) {
                            $frm_passingyear = json_decode($business_exp['frm_passingyear'],true);
                        }

                        if(isset($business_exp['certification']) && !empty($business_exp['certification'])) {
                            $certification = json_decode($business_exp['certification'],true);
                        }

                        if(isset($business_exp['frm_passingdate']) && !empty($business_exp['frm_passingdate'])) {
                            $frm_passingdate = json_decode($business_exp['frm_passingdate'],true);
                        }

                        if(isset($business_exp['skill_type']) && !empty($business_exp['skill_type'])) {
                            $skill_type = json_decode($business_exp['skill_type'],true);
                        }

                        if(isset($business_exp['skillcompletion']) && !empty($business_exp['skillcompletion'])) {
                            $skillcompletion = json_decode($business_exp['skillcompletion'],true);
                        }

                        if(isset($business_exp['frm_skilldetail']) && !empty($business_exp['frm_skilldetail'])) {
                            $frm_skilldetail = json_decode($business_exp['frm_skilldetail'],true);
                        }
                    ?>

                    <section class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="row com-setup-space" style="padding-right: 200px;">
                                <div class="col-md-12 col-sm-12">
                                    <div class="his-hed">Employment History</div>
                                </div>

                                <input type="hidden"  name="Emp_count" id="Emp_count" value="{{ count($frm_organisationname) - 1}}" /> 
                                <input type="hidden"  name="Edu_count" id="Edu_count" value="{{ count($frm_course) - 1}}" />
                                <input type="hidden"  name="certi_count" id="certi_count" value="{{ count($certification)- 1}}" />
                                <input type="hidden"  name="skill_count" id="skill_count" value="{{ count($skill_type)- 1}}" />

                                <div class="empdetail_block">
                                    @for($i=0; $i < count($frm_organisationname); $i++)
                                        <div class="row" >
                                            @if($i != 0)
                                                <hr style="border: 1px solid #d4cfcf;width: 100%;">
                                                <div class="col-md-11"></div><div class="col-md-1"><i class="remove-empdetails fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove activity"></i></div>
                                            @endif

                                            <div class="col-md-12">
                                                <div id="empdetail{{$i}}">
                                                    <div class="form-group col-md-6 col-sm-6 col-xs-12" >
                                                        <label for="email">Company Name <!-- <span id="star">*</span> --></label>
                                                        <input type="text" name="frm_organisationname[]" id="frm_organisationname" placeholder="Organization name" class="form-control" maxlength="100" value="{{ $frm_organisationname[$i] }}">
                                                        <span class="error" id="b_organisationname"></span>
                                                    </div>

                                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                        <label for="pwd">Position <!-- <span id="star">*</span> --></label>
                                                        <input  type="text" class="form-control" id="frm_position" name="frm_position[]" placeholder="Position" value="{{ $frm_position[$i] }}" maxlength="100">
                                                        <span class="error" id="b_position" ></span>
                                                    </div>

                                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label class=" present_work_btn">
                                                                <input type="checkbox" style="width: 25px;height: 25px;position: relative;top: 5px;" name="frm_ispresentcheck[]" id="frm_ispresentcheck{{$i}}" onchange="checkstillwork(this.value,{{$i}})" <?php if($frm_ispresentcheck[$i] == '0') echo " "; else echo "checked"; ?>>
                                                                <span>I Still Work Here</span>
                                                                <input type="hidden" name="frm_ispresent[]" id="frm_ispresent{{$i}}" value="1">
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6 col-sm-6 col-xs-12" id="dp1-position">
                                                        <label for="email">From (mm/dd/yyyy) <!-- <span id="star">*</span> --></label>
                                                        <div class="special-date">
                                                            <input type="text" class="form-control span2" name="frm_servicestart[]" placeholder="From" id="dp1_{{$i}}" value="{{ $frm_servicestart[$i] }}">
                                                            <span class="error" id="b_employmentfrom"></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-6 col-sm-6 col-xs-12" id="dp2_{{$i}}-position{{$i}}" <?php if($frm_ispresentcheck[$i]==1){ ?> style="display:none"; <?php } ?> >

                                                        <label for="pwd">To (mm/dd/yyyy) <!-- <span id="star">*</span> --></label>
                                                        <div class="special-date">
                                                            <input  type="text" class="form-control" id="dp2_{{$i}}" name="frm_serviceend[]" placeholder="To" value="{{ $frm_serviceend[$i] }}">
                                                            <span class="error" id="b_employmentto"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <script type="text/javascript">
                                            $('#dp1_{{$i}}').Zebra_DatePicker({
                                                format: 'm/d/Y',
                                                default_position: 'below'
                                            });

                                            $('#dp2_{{$i}}').Zebra_DatePicker({
                                                format: 'm/d/Y',
                                                default_position: 'below'
                                            });
                                        </script>
                                    @endfor
                                </div>

                                <div class="col-md-12 divrightstyle">
                                    <a class="button-fitness add-another-session-emphis">+ Add More</a>
                                </div>

                                <hr style="border: 1px solid #d4cfcf;width: 100%;">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="his-hed">Education Details</div>
                                </div> 

                                <div class="col-md-12 col-sm-12 col-xs-12 edudetail_block" >
                                    @for($i=0; $i < count($frm_course); $i++)
                                        <div class="row">
                                            @if($i != 0)
                                                <hr style="border: 1px solid #d4cfcf;width: 100%;">
                                                <div class="col-md-11"></div><div class="col-md-1"><i class="remove-edudetails fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove activity"></i></div>
                                            @endif

                                            <div class="col-md-12">
                                                <div id="edudetail0">
                                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                        <label for="pwd">Degree - Course <!-- <span id="star">*</span> --></label>
                                                        <input  type="text" id="frm_course" name="frm_course[]" class="form-control frm_course" placeholder="Degree/Course (Obtained or Seeking)" value="{{ $frm_course[$i] }}" maxlength="500">
                                                        <span class="error" id="b_degree"></span>
                                                    </div>

                                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                        <label for="pwd">University - School <!-- <span id="star">*</span> --></label>
                                                        <input  type="text" id="frm_university" name="frm_university[]" class="form-control frm_university" placeholder="University/School" value="{{ $frm_university[$i] }}"  maxlength="200">
                                                        <span class="error" id="b_university"></span>
                                                    </div>

                                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                        <label for="pwd">Year Graduated (yyyy) <!-- <span id="star">*</span> --></label>
                                                        <input  id="passingyear" name="frm_passingyear[]" class="form-control passingyear{{$i}}" placeholder="Year graduated" type="number" maxlength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:100%" autocomplete="off" value="{{ $frm_passingyear[$i] }}">
                                                        <span class="error" id="b_year"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <script type="text/javascript">
                                            var i = '{{$i}}';
                                            $('.passingyear'+i).Zebra_DatePicker({
                                                format: 'Y',
                                                default_position: 'below'
                                            });
                                        </script>
                                    @endfor   
                                </div>

                                <div class="col-md-12 divrightstyle">
                                    <a class="button-fitness add-another-session-edudetails">+ Add More</a>
                                </div>

                                <hr style="border: 1px solid #d4cfcf;width: 100%;">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="his-hed">Certification Details</div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12 certidetail_block" >
                                    @for($i=0; $i < count($certification); $i++)
                                        <div class="row">
                                            @if($i != 0)
                                              <hr style="border: 1px solid #d4cfcf;width: 100%;">
                                              <div class="col-md-11"></div><div class="col-md-1"><i class="remove-certidetails fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove activity"></i></div>
                                            @endif

                                            <div class="col-md-12">
                                                <div id="certidetail0">

                                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                        <label for="pwd">Name of Certification <!-- <span id="star">*</span> --></label>
                                                        <input  type="text" id="certification" name="certification[]" class="form-control" placeholder="Name of Certification" value="{{ $certification[$i] }}" maxlength="200">
                                                        <span class="error" id="b_certification"></span>
                                                    </div>

                                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                        <label for="email">Completion Date (mm/dd/yyyy) <!-- <span id="star">*</span> --></label>
                                                        <div class="special-date">
                                                            <input  type="text" class="form-control completionyear{{$i}}" id="completionyear" name="frm_passingdate[]" placeholder="Completion Date" autocomplete="off" value="{{ $frm_passingdate[$i] }}">
                                                            <span class="error" id="b_certificateyear"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <script type="text/javascript">
                                            $('.completionyear{{$i}}').Zebra_DatePicker({
                                                format: 'm/d/Y',
                                                default_position: 'below'
                                            });
                                        </script>
                                    @endfor
                                </div>

                                <div class="col-md-12 divrightstyle">
                                    <a class="button-fitness add-another-session-certidetails">+ Add More</a>
                                </div>

                                <hr style="border: 1px solid #d4cfcf;width: 100%;">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="his-hed">Skills, Achievments And Awards</div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12 skilldetails_block" >
                                    @for($i=0; $i < count($skill_type); $i++)
                                        <div class="row">
                                            @if($i != 0)
                                                <hr style="border: 1px solid #d4cfcf;width: 100%;">
                                                <div class="col-md-11"></div><div class="col-md-1"><i class="remove-skilldetails fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove activity"></i></div>
                                            @endif

                                            <div class="col-md-12">
                                                <div id="skilldetails0">
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label for="pwd">Skill Type <!-- <span id="star">*</span> --></label>
                                                            <select  name="skill_type[]" id="skiils_achievments_awards1" class="form-control my-select">
                                                                <option value="">Select Item</option>
                                                                <option value="Skills" {{ ($skill_type[$i]=='Skills') ? 'selected' : '' }}>Skills</option>
                                                                <option value="Achievment" {{ ($skill_type[$i]=='Achievment') ? 'selected' : '' }}>Achievments</option>
                                                                <option value="Award" {{ ($skill_type[$i]=='Award') ? 'selected' : '' }}>Awards</option>
                                                            </select>
                                                            <span class="error" id="b_skilltype"></span>
                                                        </div>

                                                        <div class="form-group" id="skillcompletionpicker-position">
                                                            <label for="email">Completion Date (mm/dd/yyyy) <!-- <span id="star">*</span> --></label>
                                                            <div class="special-date">
                                                                <input  type="text" name="skillcompletion[]" class="form-control skillcompletionpicker{{$i}}" id="skillcompletionpicker" placeholder="Completion Date"  autocomplete="off" value="{{ $skillcompletion[$i] }}">
                                                                <span class="error" id="b_skillyear"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                        <label for="pwd">Description <!-- <span id="star">*</span> --></label>
                                                        <textarea  name="frm_skilldetail[]" id="frm_skilldetail" placeholder="Description" cols="10" rows="3" class="form-control" maxlength="300">{{ $frm_skilldetail[$i] }}</textarea>
                                                        <span class="error" id="b_skilldetail"></span><span id="frm_skilldetail_left">150</span> Characters Left
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <script type="text/javascript">
                                            $('skillcompletionpicker{{$i}}').Zebra_DatePicker({
                                                format: 'm/d/Y',
                                                default_position: 'below'
                                            });
                                        </script>
                                    @endfor
                                </div>

                                <div class="col-md-12 divrightstyle">
                                    <a class="button-fitness add-another-session-skilldetails">+ Add More</a>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <br>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <button type="button" class="btn-bck" id="bck-nxt2"><i class="fa fa-arrow-left"></i> Back</button>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="text-right btn-txt-rp">
                                            <button type="submit" class="btn-nxt" id="btn-nxt2">Save & Continue <i class="fa fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </section>

                    <?php
                    } else { ?>
                    <section class="row">
                        <div class="col-md-12 col-xs-12">
                            <div class="row com-setup-space" style="padding-right: 200px;">
                                <div class="col-md-12 col-sm-12">
                                    <div class="his-hed">Employment History</div>
                                </div>
                                <!--  @php $i=0; @endphp -->

                                <input type="hidden"  name="Emp_count" id="Emp_count" value="0" /> 
                                <input type="hidden"  name="Edu_count" id="Edu_count" value="0" />
                                <input type="hidden"  name="certi_count" id="certi_count" value="0" />
                                <input type="hidden"  name="skill_count" id="skill_count" value="0" />
                                <div class="empdetail_block">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="empdetail0">
                                                <div class="form-group col-md-6 col-sm-6 col-xs-12" >
                                                    <label for="email">Company Name <!-- <span id="star">*</span> --></label>
                                                    <input type="text" name="frm_organisationname[]" id="frm_organisationname" placeholder="Organization name" class="form-control" maxlength="100" value="">
                                                    <span class="error" id="b_organisationname"></span>
                                                </div>

                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                    <label for="pwd">Position <!-- <span id="star">*</span> --></label>
                                                    <input type="text" class="form-control" id="frm_position" name="frm_position[]" placeholder="Position" value="" maxlength="100">
                                                    <span class="error" id="b_position" ></span>
                                                </div>

                                                <div class="col-md-12 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class=" present_work_btn">
                                                            <input type="checkbox" style="width: 25px;height: 25px;position: relative;top: 5px;" name="frm_ispresentcheck[]" id="frm_ispresentcheck0" onchange="checkstillwork(this.value,0)" checked >
                                                            <span>I Still Work Here</span>
                                                            <input type="hidden" name="frm_ispresent[]" id="frm_ispresent0" value="1">
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6 col-sm-6 col-xs-12" id="dp1-position">
                                                    <label for="email">From (mm/dd/yyyy) <!-- <span id="star">*</span> --></label>
                                                    <div class="special-date">
                                                        <input type="text" class="form-control span2" name="frm_servicestart[]" placeholder="From" id="dp1_0" value="">
                                                        <span class="error" id="b_employmentfrom"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6 col-sm-6 col-xs-12" id="dp2_0-position0" style="display:none;">
                                                    <label for="pwd">To (mm/dd/yyyy) <!-- <span id="star">*</span> --></label>
                                                    <div class="special-date">
                                                        <input  type="text" class="form-control" id="dp2" name="frm_serviceend[]" placeholder="To" value="">
                                                        <span class="error" id="b_employmentto"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 divrightstyle">
                                    <a class="button-fitness add-another-session-emphis">+ Add More</a>
                                </div>

                                <script type="text/javascript">
                                    $('#dp1_0').Zebra_DatePicker({
                                        format: 'm/d/Y',
                                        default_position: 'below'
                                    });
                                </script>

                                <hr style="border: 1px solid #d4cfcf;width: 100%;">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="his-hed">Education Details</div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12 edudetail_block" >
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="edudetail0">
                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                    <label for="pwd">Degree - Course <!-- <span id="star">*</span> --></label>
                                                    <input type="text" id="frm_course" name="frm_course[]" class="form-control frm_course" placeholder="Degree/Course (Obtained or Seeking)" value="" maxlength="500">
                                                    <span class="error" id="b_degree"></span>
                                                </div>

                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                    <label for="pwd">University - School <!-- <span id="star">*</span> --></label>
                                                    <input type="text" id="frm_university" name="frm_university[]" class="form-control frm_university" placeholder="University/School" value=""  maxlength="200">
                                                    <span class="error" id="b_university"></span>
                                                </div>

                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                    <label for="pwd">Year Graduated (yyyy) <!-- <span id="star">*</span> --></label>
                                                    <input  id="passingyear" name="frm_passingyear[]" class="form-control" placeholder="Year graduated" type="number" maxlength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:100%" autocomplete="off" value="">
                                                    <span class="error" id="b_year"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 divrightstyle">
                                    <a class="button-fitness add-another-session-edudetails">+ Add More</a>
                                </div>

                                <hr style="border: 1px solid #d4cfcf;width: 100%;">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="his-hed">Certification Details</div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12 certidetail_block" >
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="certidetail0">
                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                    <label for="pwd">Name of Certification <!-- <span id="star">*</span> --></label>
                                                    <input  type="text" id="certification" name="certification[]" class="form-control" placeholder="Name of Certification" value="" maxlength="200">
                                                    <span class="error" id="b_certification"></span>
                                                </div>

                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                    <label for="email">Completion Date (mm/dd/yyyy) <!-- <span id="star">*</span> --></label>
                                                    <div class="special-date">
                                                        <input  type="text" class="form-control" id="completionyear" name="frm_passingdate[]" placeholder="Completion Date" autocomplete="off" value="">
                                                        <span class="error" id="b_certificateyear"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 divrightstyle">
                                  <a class="button-fitness add-another-session-certidetails">+ Add More</a>
                                </div>

                                <hr style="border: 1px solid #d4cfcf;width: 100%;">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="his-hed">Skills, Achievments And Awards</div>
                                </div>

                                <div class="col-md-12 col-sm-12 col-xs-12 skilldetails_block" >
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div id="skilldetails0">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label for="pwd">Skill Type <!-- <span id="star">*</span> --></label>
                                                        <select  name="skill_type[]" id="skiils_achievments_awards1" class="form-control my-select">
                                                            <option value="">Select Item</option>
                                                            <option value="Skills">Skills</option>
                                                            <option value="Achievment">Achievments</option>
                                                            <option value="Award">Awards</option>
                                                        </select>
                                                        <span class="error" id="b_skilltype"></span>
                                                    </div>

                                                    <div class="form-group" id="skillcompletionpicker-position">
                                                        <label for="email">Completion Date (mm/dd/yyyy) <!-- <span id="star">*</span> --></label>
                                                        <div class="special-date">
                                                            <input type="text" name="skillcompletion[]" class="form-control" id="skillcompletionpicker" placeholder="Completion Date"  autocomplete="off" value="">
                                                            <span class="error" id="b_skillyear"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                                    <label for="pwd">Description <!-- <span id="star">*</span> --></label>
                                                    <textarea  name="frm_skilldetail[]" id="frm_skilldetail" placeholder="Description" cols="10" rows="3" class="form-control" maxlength="300"></textarea>
                                                    <span class="error" id="b_skilldetail"></span><span id="frm_skilldetail_left">150</span> Characters Left
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 divrightstyle">
                                    <a class="button-fitness add-another-session-skilldetails">+ Add More</a>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <br>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <button type="button" class="btn-bck" id="bck-nxt2"><i class="fa fa-arrow-left"></i> Back</button>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="text-right btn-txt-rp">
                                            <button type="submit" class="btn-nxt" id="btn-nxt2">Save & Continue <i class="fa fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </section>
                    <?php } ?>
                </div>
            </form>

            <form id="serviceSpecifics" name="serviceSpecifics" action="{{route('addbusinessspecification')}}" method="post">
                <?php
                    $languages = $medical_states = $fitness_goals = $medical_type = $goals_option = $hours_opt = $serTimeZone = $special_days_off = $serBusinessoff1 = "";
                    $mon_shift_start = $mon_shift_end = $tue_shift_start = $tue_shift_end = $wed_shift_start = $wed_shift_end = $thu_shift_start = $thu_shift_end = "";
                    $fri_shift_start = $fri_shift_end = $sat_shift_start = $sat_shift_end = $sun_shift_start = $sun_shift_end = "";
                    $shift_start = $shift_end = $set_duration = "";
                    if(isset($business_spec)) {
                        if(isset($business_spec['languages']) && !empty($business_spec['languages'])) {
                            $languages = $business_spec['languages'];
                        } 

                        if(isset($business_spec['medical_states']) && !empty($business_spec['medical_states'])) {
                            $medical_states = $business_spec['medical_states'];
                        } 

                        if(isset($business_spec['medical_type']) && !empty($business_spec['medical_type'])) {
                            $medical_type = $business_spec['medical_type'];
                        } 

                        if(isset($business_spec['fitness_goals']) && !empty($business_spec['fitness_goals'])) {
                            $fitness_goals = $business_spec['fitness_goals'];
                        } 

                        if(isset($business_spec['goals_option']) && !empty($business_spec['goals_option'])) {
                            $goals_option = $business_spec['goals_option'];
                        } 

                        if(isset($business_spec['hours_opt']) && !empty($business_spec['hours_opt'])) {
                            $hours_opt = $business_spec['hours_opt'];
                        } 

                        if(isset($business_spec['serTimeZone']) && !empty($business_spec['serTimeZone'])) {
                            $serTimeZone = $business_spec['serTimeZone'];
                        } 

                        if(isset($business_spec['special_days_off']) && !empty($business_spec['special_days_off'])) {
                            $special_days_off = $business_spec['special_days_off'];
                        } 

                        if(isset($business_spec['serBusinessoff1']) && !empty($business_spec['serBusinessoff1'])) {
                            $serBusinessoff1 = $business_spec['serBusinessoff1'];
                        } 

                        if(isset($business_spec['mon_shift_start']) && !empty($business_spec['mon_shift_start'])) {
                            $mon_shift_start = $business_spec['mon_shift_start'];
                        }

                        if(isset($business_spec['mon_shift_end']) && !empty($business_spec['mon_shift_end'])) {
                            $mon_shift_end = $business_spec['mon_shift_end'];
                        }

                        if(isset($business_spec['tue_shift_start']) && !empty($business_spec['tue_shift_start'])) {
                            $tue_shift_start = $business_spec['tue_shift_start'];
                        }

                        if(isset($business_spec['tue_shift_end']) && !empty($business_spec['tue_shift_end'])) {
                            $tue_shift_end = $business_spec['tue_shift_end'];
                        }

                        if(isset($business_spec['wed_shift_start']) && !empty($business_spec['wed_shift_start'])) {
                            $wed_shift_start = $business_spec['wed_shift_start'];
                        }

                        if(isset($business_spec['wed_shift_end']) && !empty($business_spec['wed_shift_end'])) {
                            $wed_shift_end = $business_spec['wed_shift_end'];
                        }

                        if(isset($business_spec['thu_shift_start']) && !empty($business_spec['thu_shift_start'])) {
                            $thu_shift_start = $business_spec['thu_shift_start'];
                        }

                        if(isset($business_spec['thu_shift_end']) && !empty($business_spec['thu_shift_end'])) {
                            $thu_shift_end = $business_spec['thu_shift_end'];
                        }

                        if(isset($business_spec['fri_shift_start']) && !empty($business_spec['fri_shift_start'])) {
                            $fri_shift_start = $business_spec['fri_shift_start'];
                        }

                        if(isset($business_spec['fri_shift_end']) && !empty($business_spec['fri_shift_end'])) {
                            $fri_shift_end = $business_spec['fri_shift_end'];
                        }

                        if(isset($business_spec['sat_shift_start']) && !empty($business_spec['sat_shift_start'])) {
                            $sat_shift_start = $business_spec['sat_shift_start'];
                        }

                        if(isset($business_spec['sat_shift_end']) && !empty($business_spec['sat_shift_end'])) {
                            $sat_shift_end = $business_spec['sat_shift_end'];
                        }

                        if(isset($business_spec['sun_shift_start']) && !empty($business_spec['sun_shift_start'])) {
                            $sun_shift_start = $business_spec['sun_shift_start'];
                        }

                        if(isset($business_spec['sun_shift_end']) && !empty($business_spec['sun_shift_end'])) {
                            $sun_shift_end = $business_spec['sun_shift_end'];
                        }
                    }
                ?>

                @csrf
                <input type="hidden" name="userid" id="userid" value="{{Auth::user()->id}}">
                <input type="hidden" name="cid" value="{{Auth::user()->cid}}">
                <input type="hidden" name="serviceid" value="{{Auth::user()->serviceid}}">
                <input type="hidden" name="bstep" id="bstep4" value="{{Auth::user()->bstep}}">
                <div class="container-fluid p-0" id="serviceSpecificsdiv" style="display: none;">
                    <div class="tab-hed">Service Specifics</div>
                    <hr style="border: 15px solid black;width: 104%;margin-left: -38px;">
                    <section class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="row com-setup-space" style="padding-right: 200px;">
                                <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                    <label for="email">Language(s) you and your staff speak ? (click all that apply) </label>
                                    <select required name="languages[]" id="testdemo" multiple>
                                        <option value="English">English</option>
                                        <option value="Abkhazian">Abkhazian</option>
                                        <option value="Afar">Afar</option>
                                        <option value="Afrikaans">Afrikaans</option>
                                        <option value="Albanian">Albanian</option>
                                        <option value="Amharic">Amharic</option>
                                        <option value="Arabic">Arabic</option>
                                        <option value="Armenian">Armenian</option>
                                        <option value="Assamese">Assamese</option>
                                        <option value="Aymara">Aymara</option>
                                        <option value="Azerbaijani">Azerbaijani</option>
                                        <option value="Bashkir">Bashkir</option>
                                        <option value="Basque">Basque</option>
                                        <option value="Belarusian">Belarusian</option>
                                        <option value="Bengali/Bangla">Bengali/Bangla</option>
                                        <option value="Bhutani">Bhutani</option>
                                        <option value="Bihari">Bihari</option>
                                        <option value="Bislama">Bislama</option>
                                        <option value="Breton">Breton</option>
                                        <option value="Bulgarian">Bulgarian</option>
                                        <option value="Burmese">Burmese</option>
                                        <option value="Catalan">Catalan</option>
                                        <option value="Cambodian">Cambodian</option>
                                        <option value="Chinese">Chinese</option>
                                        <option value="Corsican">Corsican</option>
                                        <option value="Croatian">Croatian</option>
                                        <option value="Czech">Czech</option>
                                        <option value="Danish">Danish</option>
                                        <option value="Dutch">Dutch</option>
                                        <option value="Esperanto">Esperanto</option>
                                        <option value="Estonian">Estonian</option>
                                        <option value="Finnish">Finnish</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Faeroese">Faeroese</option>
                                        <option value="French">French</option>
                                        <option value="Frisian">Frisian</option>
                                        <option value="Galician">Galician</option>
                                        <option value="Guarani">Guarani</option>
                                        <option value="Gujarati">Gujarati</option>
                                        <option value="Georgian">Georgian</option>
                                        <option value="German">German</option>
                                        <option value="Greek">Greek</option>
                                        <option value="Greenlandic">Greenlandic</option>
                                        <option value="Hausa">Hausa</option>
                                        <option value="Hebrew">Hebrew</option>
                                        <option value="Hindi">Hindi</option>
                                        <option value="Hungarian">Hungarian</option>
                                        <option value="Irish">Irish</option>
                                        <option value="Interlingua">Interlingua</option>
                                        <option value="Inupiak">Inupiak</option>
                                        <option value="Indonesian">Indonesian</option>
                                        <option value="Icelandic">Icelandic</option>
                                        <option value="Italian">Italian</option>
                                        <option value="Japanese">Japanese</option>
                                        <option value="Javanese">Javanese</option>
                                        <option value="Kazakh">Kazakh</option>
                                        <option value="Kinyarwanda">Kinyarwanda</option>
                                        <option value="Kirundi">Kirundi</option>
                                        <option value="Kannada">Kannada</option>
                                        <option value="Korean">Korean</option>
                                        <option value="Kashmiri">Kashmiri</option>
                                        <option value="Kurdish">Kurdish</option>
                                        <option value="Kirghiz">Kirghiz</option>
                                        <option value="Latin">Latin</option>
                                        <option value="Lingala">Lingala</option>
                                        <option value="Laothian">Laothian</option>
                                        <option value="Lithuanian">Lithuanian</option>
                                        <option value="Latvian/Lettish">Latvian/Lettish</option>
                                        <option value="Malagasy">Malagasy</option>
                                        <option value="Maori">Maori</option>
                                        <option value="Macedonian">Macedonian</option>
                                        <option value="Malayalam">Malayalam</option>
                                        <option value="Mongolian">Mongolian</option>
                                        <option value="Moldavian">Moldavian</option>
                                        <option value="Marathi">Marathi</option>
                                        <option value="Malay">Malay</option>
                                        <option value="Maltese">Maltese</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepali">Nepali</option>
                                        <option value="Norwegian">Norwegian</option>
                                        <option value="Occitan">Occitan</option>
                                        <option value="(Afan)/Oromoor/Oriya">(Afan)/Oromoor/Oriya</option>
                                        <option value="Persian">Persian</option>
                                        <option value="Punjabi">Punjabi</option>
                                        <option value="Polish">Polish</option>
                                        <option value="Pashto/Pushto">Pashto/Pushto</option>
                                        <option value="Portuguese">Portuguese</option>
                                        <option value="Quechua">Quechua</option>
                                        <option value="Rhaeto-Romance">Rhaeto-Romance</option>
                                        <option value="Romanian">Romanian</option>
                                        <option value="Russian">Russian</option>
                                        <option value="Samoan">Samoan</option>
                                        <option value="Sangro">Sangro</option>
                                        <option value="Sanskrit">Sanskrit</option>
                                        <option value="Shona">Shona</option>
                                        <option value="Sindhi">Sindhi</option>
                                        <option value="Singhalese">Singhalese</option>
                                        <option value="Scots/Gaelic">Scots/Gaelic</option>
                                        <option value="Serbo-Croatian">Serbo-Croatian</option>
                                        <option value="Slovak">Slovak</option>
                                        <option value="Slovenian">Slovenian</option>
                                        <option value="Somali">Somali</option>
                                        <option value="Serbian">Serbian</option>
                                        <option value="Siswati">Siswati</option>
                                        <option value="Sesotho">Sesotho</option>
                                        <option value="Setswana">Setswana</option>
                                        <option value="Spanish">Spanish</option>
                                        <option value="Sundanese">Sundanese</option>
                                        <option value="Swedish">Swedish</option>
                                        <option value="Swahili">Swahili</option>
                                        <option value="Tamil">Tamil</option>
                                        <option value="Tibetan">Tibetan</option>
                                        <option value="Telugu">Telugu</option>
                                        <option value="Tajik">Tajik</option>
                                        <option value="Thai">Thai</option>
                                        <option value="Tigrinya">Tigrinya</option>
                                        <option value="Turkmen">Turkmen</option>
                                        <option value="Tagalog">Tagalog</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Turkish">Turkish</option>
                                        <option value="Tsonga">Tsonga</option>
                                        <option value="Tatar">Tatar</option>
                                        <option value="Twi">Twi</option>
                                        <option value="Ukrainian">Ukrainian</option>
                                        <option value="Urdu">Urdu</option>
                                        <option value="Uzbek">Uzbek</option>
                                        <option value="Vietnamese">Vietnamese</option>
                                        <option value="Volapuk">Volapuk</option>
                                        <option value="Welsh">Welsh</option>
                                        <option value="Wolof">Wolof</option>
                                        <option value="Xhosa">Xhosa</option>
                                        <option value="Yiddish">Yiddish</option>
                                        <option value="Yoruba">Yoruba</option>
                                        <option value="Zulu">Zulu</option>
                                    </select>
                                    <script>
                                        var p = new SlimSelect({
                                            select: '#testdemo'
                                        });
                                    </script>
                                    <span class="error" id="b_testdemo"></span>
                                </div>

                                <div class="col-md-6 col-sm-12 col-xs-12" style="display: none;">
                                    <div class="form-group">
                                        <label>Do you work with clients with medical conditions ?</label><br>
                                        <input type="radio" name="medical_states" {{ ($medical_states == 1) ? 'checked' : '' }} id="checkyes" style="width: 25px;height: 25px;position: relative;top: 5px;" autocomplete="off" value="1">
                                        <span style="font-size: 20px;font-weight: bold;">Yes</span>
                                        <input type="radio" name="medical_states" {{ ($medical_states == 0) ? 'checked' : '' }} id="checkno" style="width: 25px;height: 25px;position: relative;top: 5px;margin-left: 20px;" autocomplete="off" value="0">
                                        <span style="font-size: 20px;font-weight: bold;">No</span>
                                    </div>

                                    <div class="form-group" id="medproblm" style="{{ ($medical_states == 1) ? 'display:block' : 'display:none' }};">
                                        <label for="email">If Yes, what type? </label>
                                        <select name="medical_type[]" id="mcc" multiple>
                                            <option value="0">Breathing Problem</option>
                                            <option value="1">Back Problem</option>
                                            <option value="2">Pregnant</option>
                                            <option value="3">Special Needs</option>
                                            <option value="4">Doesnt Matter</option>
                                            <option value="5">Others</option>
                                        </select>
                                        <span class="error" id="b_mcc"></span>
                                        <script>
                                            var p = new SlimSelect({
                                                select: '#mcc'
                                            });
                                        </script>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 col-xs-12" style="display: none;">
                                    <div class="form-group">
                                        <label>Does your business help clients with these fitness goals ?</label><br>
                                        <input type="radio" name="fitness_goals" {{ ($fitness_goals == 1) ? 'checked' : '' }} id="check_yes" style="width: 25px;height: 25px;position: relative;top: 5px;" autocomplete="off" value="1">
                                        <span style="font-size: 20px;font-weight: bold;">Yes</span>
                                        <input type="radio" name="fitness_goals" {{ ($fitness_goals == 0) ? 'checked' : '' }} id="check_no" style="width: 25px;height: 25px;position: relative;top: 5px;margin-left: 20px;" autocomplete="off" value="0">
                                        <span style="font-size: 20px;font-weight: bold;">No</span>
                                    </div>
                                    <div class="form-group" id="fit-goals" style="{{ ($fitness_goals == 1) ? 'display:block' : 'display:none' }};">
                                        <label for="email">If Yes, what type? </label>
                                        <select name="goals_option[]" id="fitness_goals_array" multiple>
                                            <option value="weight_loss">Weight Loss</option>
                                            <option value="firming_&amp;_toning">Firming &amp; Toning</option>
                                            <option value="increase_strenght">Increase Strenght</option>
                                            <option value="endurance_training">Endurance Training</option>
                                            <option value="nutritions">Nutritions</option>
                                            <option value="weight_gain">Weight Gain</option>
                                            <option value="flexibilty">Flexibilty</option>
                                            <option value="aerobics_fitness">Aerobics Fitness</option>
                                            <option value="body_building">Body Building</option>
                                            <option value="pre/post_natal">Pre/Post Natal</option>
                                            <option value="other">Other</option>
                                        </select>

                                        <span class="error" id="b_fitness_goals_array"></span>
                                        <script>
                                            var p = new SlimSelect({
                                                select: '#fitness_goals_array'
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 text-center">
                                <br>
                                <div class="form-group">
                                    <label>Add Your Business Hours<br>Add your business hours so its easy customers to know when you are open for business.<br>When you add business hours, Your page is also more likely to be suggested to people in your area.</label><br>
                                    <span style="font-size: 20px;font-weight: bold;">Hours</span><br>
                                    <input type="radio" id="hours1" name="hours_opt" {{ ($hours_opt == 'Open on selected hours') ? 'checked' : ''}} value="Open on selected hours" style="width: 25px;height: 25px;position: relative;top: 5px;" id="hours1" autocomplete="off" >
                                    <span style="font-size: 16px;">Select hours</span>
                                    <input type="radio" id="hours2" name="hours_opt" {{ ($hours_opt == 'Temporalily closed') ? 'checked' : ''}} value="Temporalily closed" style="width: 25px;height: 25px;position: relative;top: 5px;margin-left: 20px;" id="hours2" autocomplete="off">

                                    <?php /*?><span style="font-size: 16px;">Always open</span>
                                    <input type="radio" id="hours3" name="hours_opt" {{ ($hours_opt == 'Temporalily closed') ? 'checked' : ''}} value="Temporalily closed" style="width: 25px;height: 25px;position: relative;top: 5px;margin-left: 20px;" id="hours4" autocomplete="off"><?php */?>

                                    <span style="font-size: 16px;">Temporalily closed</span>
                                    <input type="radio" id="hours4" name="hours_opt" {{ ($hours_opt == 'Permanently closed') ? 'checked' : ''}} value="Permanently closed" style="width: 25px;height: 25px;position: relative;top: 5px;margin-left: 20px;" id="hours5" autocomplete="off">
                                    <span style="font-size: 16px;">Permanently closed</span>
                                </div>
                            </div>

                            <div class="col-md-12 company-specifics-day" id="selectdays" style="{{ ($hours_opt == 'Open on selected hours') ? 'display:block' : 'display:none'}};padding: 30px 110px;">
                                <div class="row">
                                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                                        <label for="mon">Monday</label>
                                    </div>

                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <!-- <input type="text" name="mon_shift_start" value="{{ $mon_shift_start }}" readonly class="form-control timepicker"> -->
                                        <?php timeSlotOptionforservice('mon_shift_start', $mon_shift_start); ?>
                                    </div>
                                    <div class="form-group col-md-1" style="text-align: center;">
                                        To
                                    </div>

                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <!-- <input type="text" name="mon_shift_end" value="{{ $mon_shift_end }}" readonly class="form-control timepicker1"> -->
                                        <?php timeSlotOptionforservice('mon_shift_end', $mon_shift_end); ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                                        <label for="tue">Tuesday</label>
                                    </div>

                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <!-- <input type="text" name="tue_shift_start" value="{{ $tue_shift_start }}" readonly class="form-control timepicker"> -->
                                        <?php timeSlotOptionforservice('tue_shift_start', $tue_shift_start); ?>
                                    </div>

                                    <div class="form-group col-md-1" style="text-align: center;">
                                        To
                                    </div>

                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <!-- <input type="text" name="tue_shift_end" value="{{ $tue_shift_end }}" readonly class="form-control timepicker1"> -->
                                        <?php timeSlotOptionforservice('tue_shift_end', $tue_shift_end); ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                                        <label for="wed">Wednesday</label>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <?php timeSlotOptionforservice('wed_shift_start', $wed_shift_start); ?>
                                    </div>

                                    <div class="form-group col-md-1" style="text-align: center;">
                                        To
                                    </div>

                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <?php timeSlotOptionforservice('wed_shift_end', $wed_shift_end); ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                                        <label for="thu">Thursday</label>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <!-- <input type="text" name="thu_shift_start" value="{{ $thu_shift_start }}" readonly class="form-control timepicker"> -->
                                        <?php timeSlotOptionforservice('thu_shift_start', $thu_shift_start); ?>
                                    </div>
                                    <div class="form-group col-md-1" style="text-align: center;">
                                        To
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <?php timeSlotOptionforservice('thu_shift_end', $thu_shift_end); ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                                        <label for="fri">Friday</label>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <?php timeSlotOptionforservice('fri_shift_start', $fri_shift_start); ?>
                                    </div>

                                    <div class="form-group col-md-1" style="text-align: center;">
                                        To
                                    </div>

                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <?php timeSlotOptionforservice('fri_shift_end', $fri_shift_end); ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                                        <label for="sat">Saturday</label>
                                    </div>

                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <?php timeSlotOptionforservice('sat_shift_start', $sat_shift_start); ?>
                                    </div>

                                    <div class="form-group col-md-1" style="text-align: center;">
                                        To
                                    </div>

                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <?php timeSlotOptionforservice('sat_shift_end', $sat_shift_end); ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-3 col-sm-12 col-xs-12">
                                        <label for="sun">Sunday</label>
                                    </div>

                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <?php timeSlotOptionforservice('sun_shift_start', $sun_shift_start); ?>
                                    </div>

                                    <div class="form-group col-md-1" style="text-align: center;">
                                        To
                                    </div>

                                    <div class="form-group col-md-4 col-sm-6 col-xs-12">
                                        <?php timeSlotOptionforservice('sun_shift_end', $sun_shift_end); ?>
                                    </div>

                                </div>

                                <script>

                                    var mon_shift_start = '{{ $mon_shift_start }}';
                                    var mon_shift_end = '{{ $mon_shift_end }}';

                                    $('.timepicker').timepicker({
                                        timeFormat: 'h:mm p',
                                        interval: 15,
                                        defaultTime: (mon_shift_start!='') ? 'value' : '10',
                                        startTime: '10:00',
                                        dynamic: false,
                                        dropdown: true,
                                        scrollbar: true
                                    });

                                    $('.timepicker1').timepicker({
                                        timeFormat: 'h:mm p',
                                        interval: 15,
                                        defaultTime: (mon_shift_end!='') ? 'value' : '17',
                                        startTime: '5:00',
                                        dynamic: false,
                                        dropdown: true,
                                        scrollbar: true
                                    });
                                </script>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12" id="selected_date_off" style="{{ ($hours_opt == 'Open on selected hours') ? 'display:block' : 'display:none'}}">
                                <br/>
                                <br/>
                                <br/>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label><strong>What is your time zone ?</strong> </label>
                                            <select class="form-control" id="serTimeZone" name="serTimeZone">

                                                <option value=""> Select Time Zone </option>
                                                <option value="est" {{ ($serTimeZone == 'est') ? 'selected' : ''}}>Eastern Standard Time - EST</option>
                                                <option value="pst" {{ ($serTimeZone == 'pst') ? 'selected' : ''}}>Pacific Standard Time - PST</option>
                                                <option value="mst" {{ ($serTimeZone == 'mst') ? 'selected' : ''}}>Mountain Standard Time - MST</option>
                                                <option value="cst" {{ ($serTimeZone == 'cst') ? 'selected' : ''}}>Central Standard Time - CST</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Any Special Days Off ?</strong> </label>
                                            <div class="special-date">               
                                                    <input type="text" class="form-control multidatepicker" id="mdp-demo" name="special_days_off" placeholder="Click here to select the dates you are closed" onkeydown="no_backspaces(event);" autocomplete="off" value="{{ $special_days_off }}">
                                            </div>
                                            <script>
                                                $(document).on('click', '#mdp-demo', function() {
                                                    $('#ui-datepicker-div').show();
                                                });

                                                $(document).on('click', '.rounded-corner', function() {
                                                    //console.log($(this).attr('date'));
                                                    $('#mdp-demo').multiDatesPicker('toggleDate', moment($(this).attr('date'), 'MM/DD/YYYY').format('MM/DD/YYYY'));
                                                    $(this).remove();
                                                })

                                                $('#mdp-demo').multiDatesPicker({
                                                    separator: ", ",
                                                    autoClose: true,
                                                    minDate: 0,
                                                    onSelect: function(dateText, inst) {  
                                                        $('.rounded-corner').each(function(i, obj) {
                                                            $('#ui-datepicker-div').hide();
                                                            if ($(this).text() == dateText + ' x') {
                                                                $(this).click();
                                                            }
                                                        });

                                                        $('.manual-remove').append('<button type="button" date="' + dateText + '" class="rounded-corner">' + dateText + ' x</button>')
                                                        inst.inline = true;
                                                    }
                                                });
                                            </script>
                                        </div>

                                        <div class="form-group">
                                            <label><strong>List amenities your business offers (Select that all apply)</strong> </label>
                                            <select multiple id="serBusinessoff1" name="serBusinessoff1[]">
                                                <option value="Cardio Equipment">Cardio Equipment</option>
                                                <option value="Strength Equipment">Strength Equipment</option>
                                                <option value="Stretch Equipment">Stretch Equipment </option>
                                                <option value="Equipment Rental">Equipment Rental</option>
                                                <option value="Lounge Area">Lounge Area</option>
                                                <option value="Waiting Area">Waiting Area</option>
                                                <option value="Wifi">Wifi</option>
                                                <option value="TV">TV</option>
                                                <option value="Showers ">Showers </option>
                                                <option value="Grooming Area">Grooming Area</option>
                                                <option value="Pool ">Pool </option>
                                                <option value="Jacuzzi  ">Jacuzzi </option>
                                                <option value="Massage">Massage</option>
                                                <option value="Salon">Salon</option>
                                                <option value="Sauna">Sauna</option>
                                                <option value="Steam Room">Steam Room</option>
                                                <option value="Basketball court">Basketball court</option>
                                                <option value="Tennis court">Tennis court</option>
                                                <option value="Racquetball court">Racquetball court</option>
                                                <option value="Track">Track</option>
                                                <option value="Tanning beds">Tanning beds</option>
                                                <option value="Juice Bar">Juice Bar</option>
                                                <option value="Smoothie Bar">Smoothie Bar</option>
                                                <option value="Bar Area">Bar Area</option>
                                                <option value="Snacks">Snacks</option>
                                                <option value="Nutritional Food">Nutritional Food</option>
                                                <option value="Food Options">Food Options</option>
                                                <option value="Cleaning Stations">Cleaning Stations</option>
                                                <option value="Sanitizing stations">Sanitizing stations</option>
                                                <option value="Lockers">Lockers</option>
                                                <option value="Water Fountain">Water Fountain</option>
                                                <option value="Bottle Fountain">Bottle Fountain</option>
                                                <option value="Sound system">Sound system</option>
                                                <option value="Social distancing">Social distancing</option>
                                                <option value="Trained staff on AED">Trained staff on AED</option>
                                                <option value="Trained CPR/ First Aid staff">Trained CPR/ First Aid staff </option>
                                                <option value="Certified personal trainers">Certified personal trainers</option>
                                                <option value="Alarm System">Alarm System</option>
                                                <option value="Bike Parking">Bike Parking</option>
                                                <option value="Car Parking">Car Parking</option>
                                                <option value="Elevator">Elevator</option>
                                                <option value="Security Cameras">Security Cameras</option>
                                                <option value="Wheelchair accessible">Wheelchair accessible</option>
                                                <option value="Outdoor seating">Outdoor seating</option>
                                                <option value="Indoor seating">Indoor seating</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#serBusinessoff1'
                                                });
                                            </script>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12" style="background:#dedada; padding: 30px 20px; min-height: 250px;">
                                        <div class="text-center">
                                            <span style="font-size: 18px;font-weight: bold;text-transform: uppercase;">Selected Date Off</span><br>
                                            <label>Customers will not be able to book you on these days</label>
                                        </div>

                                        <div class="manual-remove" style="float:left;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <br/>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <button type="button" class="btn-bck" id="bck-nxt3"><i class="fa fa-arrow-left"></i> Back</button>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="text-right btn-txt-rp">
                                            <button type="submit" class="btn-nxt" id="btn-nxt3">Save & Continue <i class="fa fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                            </div>
                        </div>
                    </section>
                </div>
            </form>

            <?php /*?> ///nnn show evident to user - go to UserProfileController and  addbusinessterms function and remove comment from this line User::where('id', Auth::user()->id)->update(['bstep' => 6]);<?php */?>

            <form id="termSet" name="termSet" action="{{route('addbusinessterms')}}" method="post"> 
                <?php
                    $houserules = $cancelation = $cleaning = $termcondfaq = $termcondfaqtext = $contractterms = $contracttermstext = $liability = $liabilitytext = $covid = $covidtext = $refundpolicy = $refundpolicytext = "";

                    if(isset($business_term)) {
                        if(isset($business_term['houserules']) && !empty($business_term['houserules'])) {
                            $houserules = $business_term['houserules'];
                        }

                        if(isset($business_term['cancelation']) && !empty($business_term['cancelation'])) {
                            $cancelation = $business_term['cancelation'];
                        }

                        if(isset($business_term['cleaning']) && !empty($business_term['cleaning'])) {
                            $cleaning = $business_term['cleaning'];
                        }

                        if(isset($business_term['termcondfaq']) && !empty($business_term['termcondfaq'])) {
                            $termcondfaq = $business_term['termcondfaq'];
                        }

                        if(isset($business_term['termcondfaqtext']) && !empty($business_term['termcondfaqtext'])) {
                            $termcondfaqtext = $business_term['termcondfaqtext'];
                        }

                        if(isset($business_term['refundpolicy']) && !empty($business_term['refundpolicy'])){
                            $refundpolicy = $business_term['refundpolicy'];
                        }

                        if(isset($business_term['refundpolicytext']) && !empty($business_term['refundpolicytext'])) {
                            $refundpolicytext = $business_term['refundpolicytext'];
                        }

                        if(isset($business_term['contractterms']) && !empty($business_term['contractterms'])) {
                            $contractterms = $business_term['contractterms'];
                        }

                        if(isset($business_term['contracttermstext']) && !empty($business_term['contracttermstext'])) {
                            $contracttermstext = $business_term['contracttermstext'];
                        }

                        if(isset($business_term['liability']) && !empty($business_term['liability'])) {
                            $liability = $business_term['liability'];
                        }

                        if(isset($business_term['liabilitytext']) && !empty($business_term['liabilitytext'])) {
                            $liabilitytext = $business_term['liabilitytext'];
                        }

                        if(isset($business_term['covid']) && !empty($business_term['covid'])) {
                            $covid = $business_term['covid'];
                        }

                        if(isset($business_term['covidtext']) && !empty($business_term['covidtext'])) {
                            $covidtext = $business_term['covidtext'];
                        }
                    }
                ?>

                @csrf

                <input type="hidden" name="userid" id="userid" value="{{Auth::user()->id}}">
                <input type="hidden" name="cid" value="{{Auth::user()->cid}}">
                <input type="hidden" name="serviceid" value="{{Auth::user()->serviceid}}">
                <input type="hidden" name="bstep" id="bstep5" value="{{Auth::user()->bstep}}">
                <div class="container-fluid p-0" id="termSetdiv" style="display: none;">
                    <div class="tab-hed">Set Your Terms</div>
                    <hr style="border: 15px solid black;width: 104%;margin-left: -38px;">
                    <section class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <p>
                                        Give your customers THINGS TO KNOW and information on how and what to prepare before they book.
                                    </p>
                                    <br/><br/>
                                    <div class="form-group">
                                        <label for="house_rules">Know Before You Go </label>
                                        <textarea  placeholder="Tell your customers how they should conduct themselves when attending your place of business or participating in your activity. Set out a few guidelines to help things go smoothly." name="houserules" id="house_rules_terms" cols="30" rows="6" class="form-control" maxlength="1000">{{ $houserules }}</textarea>
                                        <span class="error" id="err_house_rules"></span>

                                        <div class="text-right"><span id="house_rules_terms_left">1000</span> Characters Left</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="cancelation_policy">Cancelation Policy <!-- <span id="star">*</span> --></label>
                                        <textarea  placeholder="Let your customers know your rules about canceling a booking. Set your policy and regulations." name="cancelation" id="cancelation_policy" cols="30" rows="6" class="form-control" maxlength="1000">{{ $cancelation }}</textarea>
                                        <span class="error" id="err_cancelation_policy"></span>
                                        <div class="text-right"><span id="cancelation_policy_left">1000</span> Characters Left</div>
                                    </div>

                                    <div class="form-group">

                                        <label for="safety_cleaning">Safety and Cleaning Procedures <!-- <span id="star">*</span> --></label>

                                        <textarea  placeholder="Let your customers know your safety and cleaning procedures to keep them healthy and safe." name="cleaning" id="safety_cleaning" cols="30" rows="6" class="form-control" maxlength="1000">{{ $cleaning }}</textarea>

                                        <span class="error" id="err_safety_cleaning"></span>

                                        <div class="text-right"><span id="safety_cleaning_left">1000</span> Characters Left</div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <p class="text-center"> Select the section you require your clients to agree to upon completing registration.</p>
                                    <div class="setyour_block">
                                        <div class="col-md-12">
                                            <label for="terms_1" class="col-md-12 terms-check1">
                                                <input type="checkbox" value="1" class="chkdy" id="termcondfaq" name="termcondfaq" autocomplete="off" {{ ($termcondfaq==1) ? 'checked' : '' }}> Terms, Conditions, FAQ
                                            </label>
                                            <div class="col-md-12 textsam" id="termcondfaqdiv" style="display: none;">
                                                <textarea class="form-control" placeholder="Terms, Conditions, FAQ" id="termcondfaqtext" name="termcondfaqtext">{{ $termcondfaqtext }}</textarea>
                                                <div class="text-right"><span id="termcondfaqtext_left">1000</span> Characters Left</div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="terms_2" class="col-md-12 terms-check2">
                                                <input type="checkbox" value="1" class="chkdy" id="contractterm" name="contractterms" autocomplete="off" {{ ($contractterms==1) ? 'checked' : '' }}> Contract Terms ?
                                            </label>

                                            <div class="col-md-12 textsam" id="contracttermdiv" style="display: none;">
                                                <textarea class="form-control" placeholder="Contract Terms" id="contracttermtext" name="contracttermstext"  rows="8" maxlength="20000">{{ $contracttermstext }}</textarea>
                                                <div class="text-right"><span id="contracttermtext_left">20000</span> Characters Left</div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                             <label for="terms_3" class="col-md-12 terms-check3">
                                                <input type="checkbox" value="1" class="chkdy" id="liabilitys" name="liability" autocomplete="off" {{ ($liability==1) ? 'checked' : '' }}> Liability Waiver
                                            </label>

                                            <div class="col-md-12 textsam" id="liabilitysdiv" style="display: none;">
                                                <textarea class="form-control" placeholder="Liability Waiver" id="liabilitystext" name="liabilitytext">{{ $liabilitytext }}</textarea>
                                                <div class="text-right"><span id="liabilitystext_left">1000</span> Characters Left</div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="terms_4" class="col-md-12 terms-check4">
                                                <input type="checkbox" value="1" class="chkdy" id="covids" name="covid" autocomplete="off" {{ ($covid==1) ? 'checked' : '' }}> Covid – 19 Protocols
                                            </label>

                                            <div class="col-md-12 textsam" id="covidsdiv" style="display: none;">
                                                <textarea class="form-control" placeholder="Covid – 19 Protocols" id="covidstext" name="covidtext">{{ $covidtext }}</textarea>
                                                <div class="text-right"><span id="covidstext_left">1000</span> Characters Left</div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="terms_5" class="col-md-12 terms-check5">
                                                <input type="checkbox" value="1" class="chkdy" id="refundpolicy" name="refundpolicy" autocomplete="off" {{ ($refundpolicy==1) ? 'checked' : '' }}> Refund Policy
                                            </label>
                                            <div class="col-md-12 textsam" id="refundpolicydiv" style="display: none;">
                                                <textarea class="form-control" placeholder="Refund Policy" id="refundpolicytext" name="refundpolicytext">{{ $refundpolicytext }}</textarea>
                                                <div class="text-right"><span id="refundpolicy_left">1000</span> Characters Left</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <br/>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <button type="button" class="btn-bck" id="bck-nxt4"><i class="fa fa-arrow-left"></i> Back</button>
                                    </div>
                                    <div class="col-md-6 col-sm-6  col-xs-12">
                                        <div class="text-right btn-txt-rp">
                                            <button type="submit" class="btn-nxt" id="btn-nxt4">Save & Continue <i class="fa fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <br/>
                            </div>
                        </div>
                    </section>
                </div>
            </form>

            <form id="frmVerified" name="frmVerified" method="POST" action="{{route('addbusinessverification')}}">
                <?php
                    $card_number = $card_name = $card_expiry = $card_cvv = "";
                    $firstname = $lastname = $dob = $ssn = $phone = $email = "";
                    $rights_summary = $ack_summary = $authorize_detail = $ack_authorize = $signature = "";
                    if(isset($business_veri)) {                    
                        if(isset($business_veri['card_number']) && !empty($business_veri['card_number'])) {
                            $card_number = $business_veri['card_number'];
                        }

                        if(isset($business_veri['card_name']) && !empty($business_veri['card_name'])) {
                            $card_name = $business_veri['card_name'];
                        }

                        if(isset($business_veri['card_expiry']) && !empty($business_veri['card_expiry'])) {
                            $card_expiry = $business_veri['card_expiry'];
                        }

                        if(isset($business_veri['card_cvv']) && !empty($business_veri['card_cvv'])) {
                            $card_cvv = $business_veri['card_cvv'];
                        }

                        if(isset($business_veri['firstname']) && !empty($business_veri['firstname'])) {
                            $firstname = $business_veri['firstname'];
                        }

                        if(isset($business_veri['lastname']) && !empty($business_veri['lastname'])) {
                            $lastname = $business_veri['lastname'];
                        }

                        if(isset($business_veri['dob']) && !empty($business_veri['dob'])) {
                            $dob = $business_veri['dob'];
                        }

                        if(isset($business_veri['ssn']) && !empty($business_veri['ssn'])) {
                            $ssn = $business_veri['ssn'];
                        }

                        if(isset($business_veri['phone']) && !empty($business_veri['phone'])) {
                            $phone = $business_veri['phone'];
                        }

                        if(isset($business_veri['email']) && !empty($business_veri['email'])) {
                            $email = $business_veri['email'];
                        }

                        if(isset($business_veri['rights_summary']) && !empty($business_veri['rights_summary'])) {
                            $rights_summary = $business_veri['rights_summary'];
                        }

                        if(isset($business_veri['ack_summary']) && !empty($business_veri['ack_summary'])) {
                            $ack_summary = $business_veri['ack_summary'];
                        }

                        if(isset($business_veri['authorize_detail']) && !empty($business_veri['authorize_detail'])) {
                            $authorize_detail = $business_veri['authorize_detail'];
                        }

                        if(isset($business_veri['ack_authorize']) && !empty($business_veri['ack_authorize'])) {
                            $ack_authorize = $business_veri['ack_authorize'];
                        }

                        if(isset($business_veri['signature']) && !empty($business_veri['signature'])) {
                            $signature = $business_veri['signature'];
                        }
                    }

                    $item = $qty = $price = $service_fee = $grand_total = "";
                    if(isset($business_plan)) {
                        if(isset($business_plan['item']) && !empty($business_plan['item'])) {
                            $item = $business_plan['item'];
                        }

                        if(isset($business_plan['qty']) && !empty($business_plan['qty'])) {
                            $qty = $business_plan['qty'];
                        }

                        if(isset($business_plan['price']) && !empty($business_plan['price'])) {
                            $price = $business_plan['price'];
                        }

                        if(isset($business_plan['service_fee']) && !empty($business_plan['service_fee'])) {
                            $service_fee = $business_plan['service_fee'];
                        }

                        if(isset($business_plan['grand_total']) && !empty($business_plan['grand_total'])) {
                            $grand_total = $business_plan['grand_total'];
                        }
                    }
                ?>

                @csrf

                <input type="hidden" name="userid" id="userid" value="{{Auth::user()->id}}">
                <input type="hidden" name="cid" value="{{Auth::user()->cid}}">
                <input type="hidden" name="serviceid" value="{{Auth::user()->serviceid}}">
                <input type="hidden" name="bstep" id="bstep6" value="{{Auth::user()->bstep}}">
                
                <div class="container-fluid p-0" id="frmVerifieddiv0" style="display: none;">
                    <div class="tab-hed">Get Verified</div>
                    <div class="getverified_title">
                        Payment Details
                    </div>
                    <div class="col-md-6 text-left">
                        <img src="{{ url('public/images/verified-logo.png') }}" height="100" alt="">
                    </div>
                    <div class="col-md-6 evident-logo-right text-right">
                        <h4>Powered by: <img src="{{ url('public/images/evident.png') }}" alt=""></h4>
                    </div>

                    <div class="col-md-12 complete-section text-center" style="padding:50px">
                        <h3><b>Become a Fitnessity vetted business by undergoing a background check.</b></h3>
                        <p id="checkpass"> Complete a background check and earn your customer trust. It's a fast and simple process. Background checks are optional and <b>NOT</b> mandatory. Earn a Fitnessity vetted business badge for your profile page. Vetted businesses received more bookings than non-verified.
                        </p>
                    </div>

                    <div class="col-md-12">
                        <br/>
                        <div class="row" style="padding-bottom: 50px">
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <button type="button" class="btn-bck" id="backverified0"><i class="fa fa-arrow-left"></i> Skip Verified</button>
                            </div>

                            <div class="col-md-3 text-right">
                                <button type="button" class="btn-nxt" id="nextverified0">Get Started <i class="fa fa-arrow-right"></i></button>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                        <br/>
                        <br/>
                        <?php /*?><a href="https://www.vettedbiz.com/most-commonly-asked-questions-selling-a-business/" target="_new">Vetted Business FAQ's</a><br/>
                            <a href="https://www.evidentid.com/products/background-checks/" target="_new">Background Check FAQ's</a><br/><br/><?php 

                            ///nnn 15-5-2022
                            */
                        ?>
                    </div>
                </div>

                <div class="container-fluid p-0" id="frmVerifieddiv" style="display: none;">
                    <div class="tab-hed">Get Verified</div>
                    <div class="getverified_title">
                        Payment Details
                    </div>
                    <div class="col-md-12 evident-logo-right text-right">
                        <h4>Powered by: <img src="{{ url('public/images/evident.png') }}" alt=""></h4>
                    </div>

                    <div class="col-md-5 payment_block_left">
                        <div class="verified_logo_bg"><img src="{{ url('public/images/verified-logo.png') }}" alt=""></div>
                        <h3>ORDER SUMMERY</h3>
                        <table class="table" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>ITEM</th>
                                    <th>QTY</th>
                                    <th class="text-right">PRICE(USD)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?=$item?></td>
                                    <td><?=$qty?></td>
                                    <td class="text-right">$<?=$price?></td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="total_summery">
                            <p>Total : <span>$<?=$price?></span></p>
                            <p>Service Fee : <span><?=$service_fee?></span></p>
                            <p>Grand Total : <span>$<?=$grand_total?></span></p>
                        </div>
                    </div>

                    <div class="col-md-7 payment_block_right">
                        <h4>PAYMENT SELECTION</h4>
                        <div class="payment-item" style="display:none;">
                            <h5>SAVED CARDS <a href="#" class="edit_links">Edit</a></h5>
                            <div class="selection" id="card_1">
                                <div class="card_shapes1"><img src="{{ url('public/images/card-shapes.png') }}" alt=""></div>
                                <input type="radio" name="subscription" id="subscription" />
                                <label for="subscription">
                                    <span id="numbercard">XXXX 4023</span>
                                    <span class="cardimg"><img src="{{ url('public/images/visa-white.png') }}" alt=""></span>
                                </label>
                                <div class="check"></div>
                            </div>

                            <div class="selection" id="card_2" style="display:none;">
                                <div class="card_shapes2"><img src="{{ url('public/images/card-shapes1.png') }}" alt=""></div>
                                <input type="radio" name="subscription" id="subscription-2" />
                                <label for="subscription-2">
                                    <span class="numbercard">XXXX 5987</span>
                                    <span class="cardimg"><img src="{{ url('public/images/master-card.png') }}" alt=""></span>
                                </label>
                                <div class="check"></div>
                            </div>
                        </div>

                        <div class="col-md-12 padding-0 card_details_block">
                            <div class="row">
                                <div class="form-group col-md-6 card_number_block">
                                    <label for="card_number">Card Number <span id="star">*</span></label>
                                    <input required type="text" name="cardnumber" id="card_number" placeholder="0000 0000 0000 0000" class="form-control" autocomplete="off" maxlength="16" value="{{ $card_number }}">
                                    <span class="error" id="err_card_number"></span>
                                    <div class="cardpayment-logo">
                                        <img src="{{ url('public/images/visa-black.png') }}" alt="" class="visa_card">
                                        <img src="{{ url('public/images/master-card.png') }}" alt="" class="master_card">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="name_card">Name on Card <span id="star">*</span></label>
                                    <input required type="text" name="namecard" id="name_card" placeholder="Enter Your Name Here" class="form-control" autocomplete="off"value="{{ $card_name }}">
                                    <span class="error" id="err_name_card"></span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="expiry_date">Expiry Date <span id="star">*</span></label>
                                    <input required type="text" name="exirydate" id="expiry_date" placeholder="MM / YY" maxlength="5" class="form-control" autocomplete="off" value="{{ $card_expiry }}">
                                    <span class="error" id="err_expiry_date"></span>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="cvv">CVV <span id="star">*</span></label>
                                    <input required type="number" name="cvv" id="cvv" maxlength="3" placeholder="- - -" class="form-control" autocomplete="off" onKeyPress="if(this.value.length==3) return false;" value="{{ $card_cvv }}">
                                    <span class="error" id="err_cvv"></span>
                                    <a href="#" class="cvv_code" data-toggle="popover" data-trigger="hover" data-content="Lorem Ipsum is simply dummy text">?</a>
                                </div>
                            </div>

                            <div class="form-group col-md-12">
                                <label class="switch" id="cards_check">
                                    <input type="checkbox" {{ ($card_number!="") ? 'checked' : '' }}>
                                    <span class="slider round"></span>
                                </label>
                                <span>Save This Card</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <br/>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="btn-bck" id="backverified1"><i class="fa fa-arrow-left"></i> Back</button>
                            </div>

                            <div class="col-md-6 text-right">
                                <button type="button" class="btn-nxt" id="nextverified1">Pay & Continue <i class="fa fa-arrow-right"></i></button>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>

                <div class="container-fluid p-0" id="frmVerifieddiv1" style="display: none;">
                    <div class="tab-hed">Get Verified</div>
                    <div class="getverified_title">
                        Details
                    </div>
                    <div class="col-md-9">
                        <h3><b>WELCOME</b></h3>
                    </div>

                    <div class="col-md-3 evident-logo-right-1">
                        <img src="{{ url('public/images/evident.png') }}" alt="">
                    </div>

                    <div class="col-md-12">
                        <div class="details_section">
                            <p>
                                Completing your background check increases your trust & safety status on Fitnessity. We will notify you when the results are complete
                            </p>

                            <h5><b>A quick legal notice:</b></h5>
                            <p>
                                With your permission and understanding, Fitnessity, Inc. (the “Company”) is working with Evident ID, Inc. (“EvidentID”) to obtain a consumer report that will include a criminal background check of federal, state, and local criminal court records, a review of public sex offender registries, and Social Security number verification in connection with your request to use or your ability to continue to use the Fitnessity platform. Although Fitnessity does not believe that this consumer report is being obtained for an employment purpose, Fitnessity and Evident ID will nonetheless comply with the requirements of the Fair Credit Reporting Act and related state laws that apply specifically to consumer reports obtained for employment purposes.
                            </p>

                            <p>
                                After you’ve completed the form, you can check the status of your background check at {<a href="https://www.evidentid.com/products/background-checks/" target="_new">Evident Background Check</a>}
                            </p>
                        </div>

                        <p class="candidate_info">

                            CANDIDATE INFORMATION

                            <span>* REQUIRED</span>

                        </p>

                    </div>

                    <div class="col-md-12 details_verified_form1">

                        <div class="row">

                        <div class="form-group col-md-4">

                            <label for="first_name">First Name <span id="star">*</span></label>

                            <input type="text" name="firstname" id="first_name" class="form-control" autocomplete="off" value="{{ $firstname }}" maxlength="50">

                            <span class="error" id="err_first_name" ></span>

                        </div>

                        <div class="form-group col-md-4">

                            <label for="middle_name">Middle Name</label>

                            <input type="text" name="middlename" id="middle_name" class="form-control" autocomplete="off" maxlength="50">

                        </div>

                        <div class="form-group col-md-4">

                            <label for="last_name">Last Name <span id="star">*</span></label>

                            <input maxlength="50" type="text" name="lastname" id="last_name" class="form-control" autocomplete="off" value="{{ $lastname }}">

                            <span class="error" id="err_last_name"></span>

                        </div>

                        </div>

                        <div class="row">

                        <div class="form-group col-md-4">

                            <label for="date_birth">Date Of Birth <span id="star">*</span></label>

                            <input type="text" name="dateofbirth" id="date_birth" placeholder="MM / DD / YYYY" class="form-control" readonly="readonly" autocomplete="off" value="{{ $dob }}">

                            <span class="error" id="err_date_birth"></span>

                        </div>

                        <div class="form-group col-md-4">

                            <label for="security_number">Social Security Number <span id="star">*</span></label>

                            <input type="text" name="securitynumber" id="security_number" placeholder="" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="9" autocomplete="off" value="{{ $ssn }}">

                            <span class="error" id="err_security_number"></span>

                        </div>

                        <?php   
                            $phone_num_phone_number = $phone;
                            if (preg_match('/()-/', $phone_num)){
                                $num_phone_number = $phone_num_phone_number;
                            }else{
                                
                                $num_phone_number = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $phone_num_phone_number);
                            }
                        ?>
                        <div class="form-group col-md-4">

                            <label for="phone_number">Phone number <span id="star">*</span></label>

                            <input type="text" name="phonenumber" id="phone_number" placeholder="" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="14" autocomplete="off" value="{{ $num_phone_number }}" onkeyup="changeformate1()">

                            <span class="error" id="err_phone_number"></span>

                        </div>

                        </div>

                        <div class="row">

                        <div class="form-group col-md-4">

                            <label for="eamil">Email <span id="star">*</span></label>

                            <input type="email" name="email" id="eamil" class="form-control" autocomplete="off" value="{{ $email }}" maxlength="255">

                            <span class="error" id="err_eamil" ></span>

                        </div>

                        <div class="form-group col-md-12 checking_circle">

                            <input type="radio" name="radio_verified" id="radio_verified" class="pull-left" {{ ($firstname!="") ? 'checked' : '' }}>

                            <label for="radio_verified">

                                By checking this circle, you agree to Fitnessity, Inc. and Evident ID, Inc. Privacy Policy, and consent to Evident ID contacting you by email, phone, or SMS texts with information relating to your background check.

                            </label>

                            <span class="error" id="err_radio_verified"></span>

                        </div>

                        </div>

                    </div>

                    <div class="col-md-12">

                        <br/>

                        <div class="row">

                            <div class="col-md-6">

                                <button type="button" class="btn-bck" id="backverified2"><i class="fa fa-arrow-left"></i> Back</button>

                            </div>

                            <div class="col-md-6 text-right">

                                <button type="button" class="btn-nxt" id="nextverified2">Continue <i class="fa fa-arrow-right"></i></button>

                            </div>

                        </div>

                        <br>

                    </div>

                </div>



                <div class="container-fluid p-0" id="frmVerifieddiv2" style="display: none;">

                    <div class="tab-hed">Get Verified</div>

                    <div class="getverified_title">

                        FCRA Disclaimer

                    </div>

                    <div class="col-md-9 summary-area">

                        <div class="form-group">

                            <input type="text" name="title" id="title" value="Summery of Your Rights" class="form-control" readonly>

                            <span class="summary-icon"><i class="fa fa-file-text"></i></span>

                        </div>

                        <div class="form-group">

                            <div style="border:1px solid #000; padding:10px;">

                            <h3>APPLICANT DISCLOSURE STATEMENT</h3> 

                            <p>With your application to Fitnessity (COMPANY) to provide services as an independent contractor, employee, or volunteer, you may have the information requested about you from a Consumer Reporting Agency (CRA). This information may be obtained in the form of a consumer report.</p> 

                            <p>These reports may contain information about your character, general reputation, personal characteristics and/or mode of living. The types of information that may be obtained include, but are not limited to, social security number verifications; address history; criminal records checks; public court records checks; driving records checks; and professional licensing/certification checks. This information may be obtained from private and/or public records sources, including, as appropriate; governmental agencies, courthouses, educational institutions, former employers, or other information sources.</p>  

                            </div>

                            <textarea readonly name="rights_summary" id="rights_summary" cols="30" rows="10" class="form-control" style="display:none">

                            <?php 

                            if(!empty($rights_summary)) {

                            echo $rights_summary;

                            } else { ?>

                            <h3>APPLICANT DISCLOSURE STATEMENT</h3> 

                            <p>With your application to Fitnessity (COMPANY) to provide services as an independent contractor, employee, or volunteer, you may have the information requested about you from a Consumer Reporting Agency (CRA). This information may be obtained in the form of a consumer report.</p> 

                            <p>These reports may contain information about your character, general reputation, personal characteristics and/or mode of living. The types of information that may be obtained include, but are not limited to, social security number verifications; address history; criminal records checks; public court records checks; driving records checks; and professional licensing/certification checks. This information may be obtained from private and/or public records sources, including, as appropriate; governmental agencies, courthouses, educational institutions, former employers, or other information sources.</p>

                            <?php } ?>

                            </textarea>

                        </div>

                        <div class="form-group border-verified-top">

                            <label for="summary_receipt">

                                <input type="checkbox" name="summary_receipt" id="summary_receipt" value="1" {{ ($ack_summary==1)?'checked':'' }}>

                                I acknowledge receipt of the Summary of Your Rights Under the Fair Credit Reporting ACT (FCRA) and certify that i have read and understand this document.

                            </label>

                            <span class="error" id="err_summary_receipt"></span>

                        </div>

                    </div>

                    <div class="col-md-3 evident-logo-right text-right">

                        <h4><img src="{{ url('public/images/evident.png') }}" alt=""></h4>

                    </div>

                    <div class="col-md-12">

                        <br/>

                        <div class="row">

                            <div class="col-md-6">

                                <button type="button" class="btn-bck" id="backverified3"><i class="fa fa-arrow-left"></i> Back</button>

                            </div>

                            <div class="col-md-6 text-right">

                                <button type="button" class="btn-nxt" id="nextverified3">Continue <i class="fa fa-arrow-right"></i></button>

                            </div>

                        </div>

                        <br>

                    </div>

                </div>



                <div class="container-fluid p-0" id="frmVerifieddiv3" style="display: none;">

                    <div class="tab-hed">Get Verified</div>

                    <div class="getverified_title">

                        Authorization

                    </div>

                    <div class="col-md-9 summary-area">

                        <div class="form-group">

                            <input type="text" name="title" id="title" value="Authorize" class="form-control" readonly>

                            <span class="summary-icon"><i class="fa fa-file-text"></i></span>

                        </div>

                        <div class="form-group">

                            <div style="border:1px solid #000; padding:10px;">

                            <h3>APPLICANT AUTHORIZATION OF BACKGROUND INVESTIGATION</h3> 

                            <p>I have carefully read and understand this Authorization form and further acknowledge receipt of the separate document entitled “A Summary of Your Rights under the Fair Credit Reporting Act” and the “Applicant Disclosure Statement” and certify that I have read and understand both documents. By my signature below, I consent to the release of consumer reports and/or investigative consumer reports (“Background Reports”) prepared by Evident ID Inc. located at 75 5th Street NW Suite 2060 Atlanta, GA 30308 -- 877-832-5298 - Privacy Policy, to COMPANY and its designated representatives and agents to determine and maintain my relationship as an independent contractor, employee, or volunteer with COMPANY.</p> 

                            <p>I understand that if COMPANY engages in a relationship with me, my consent will apply. COMPANY may obtain Background Reports throughout my relationship with them if such obtainment is permissible under applicable State law and COMPANY policy. I also understand that information contained in my application or otherwise disclosed by me may be used when ordering the Background Reports and that nothing herein shall be construed as an offer of employment or a guarantee of a relationship with COMPANY.</p>  

                            </div>

                            <textarea name="authorize_detail" id="authorize_detail" cols="30" rows="10" class="form-control" style="display:none">

                            <?php 

                            if(!empty($authorize_detail)) {

                            echo $authorize_detail;

                            } else { ?>

                            <h3>APPLICANT AUTHORIZATION OF BACKGROUND INVESTIGATION</h3> 

                            <p>I have carefully read and understand this Authorization form and further acknowledge receipt of the separate document entitled “A Summary of Your Rights under the Fair Credit Reporting Act” and the “Applicant Disclosure Statement” and certify that I have read and understand both documents. By my signature below, I consent to the release of consumer reports and/or investigative consumer reports (“Background Reports”) prepared by Evident ID Inc. located at 75 5th Street NW Suite 2060 Atlanta, GA 30308 -- 877-832-5298 - Privacy Policy, to COMPANY and its designated representatives and agents to determine and maintain my relationship as an independent contractor, employee, or volunteer with COMPANY.</p> 

                            <p>I understand that if COMPANY engages in a relationship with me, my consent will apply. COMPANY may obtain Background Reports throughout my relationship with them if such obtainment is permissible under applicable State law and COMPANY policy. I also understand that information contained in my application or otherwise disclosed by me may be used when ordering the Background Reports and that nothing herein shall be construed as an offer of employment or a guarantee of a relationship with COMPANY.</p>

                            <?php } ?>

                            </textarea>

                        </div>

                        <div class="form-group border-verified-top">

                            <label for="receive_consumer">

                                <input type="checkbox" name="receive_consumer" id="receive_consumer" value="1" {{ ($ack_authorize==1)?'checked':'' }}>

                                Please check this box if you would like to receive a copy of a consumer report.

                            </label>

                            <span class="error" id="err_receive_consumer"></span>

                        </div>

                        

                        <p>Your Vetted Network Membership will automatically renew on <?=date('d/m/Y', strtotime("+1 year"))?>. At that time, $19.95 will be auto-deducted from the credit card we have on file for your account. If you cancel your membership prior to your renewal date, you will maintain your benefits and status as a Vetted Pro until <?=date('d/m/Y', strtotime("+1 year"))?>.</p>

                        <div class="row">

                            <div class="form-group col-md-6 autorize_name_block">

                                <label for="">Full Name</label>

                                <input type="text" name="full_name" id="full_name" placeholder="Full Name" class="form-control" value="{{ $signature }}" maxlength="50" >

                                <span class="autorize_icon"><img src="{{ url('public/images/icon-verified-autorize.png') }}" alt=""></span>

                                <span class="error" id="err_full_name"></span>

                            </div>

                            <div class="form-group col-md-6"></div>

                        </div>

                    </div>

                    <div class="col-md-3 evident-logo-right text-right">

                        <h4><img src="{{ url('public/images/evident.png') }}" alt=""></h4>

                    </div>

                    <div class="col-md-12">

                        <br/>

                        <div class="row">

                            <div class="col-md-6">

                                <button type="button" class="btn-bck" id="backverified4"><i class="fa fa-arrow-left"></i> Back</button>

                            </div>

                            <div class="col-md-6 text-right">

                                <button type="button" class="btn-nxt" id="nextverified4">Continue <i class="fa fa-arrow-right"></i></button>

                            </div>

                        </div>

                        <br/>

                    </div>

                </div>



                <div class="container-fluid p-0" id="frmVerifieddiv4" style="display: none;">

                    <div class="tab-hed">Get Verified</div>

                    <div class="getverified_title">

                        Complete

                    </div>

                    <div class="col-md-12 evident-logo-right text-right">

                        <h4><img src="{{ url('public/images/evident.png') }}" alt=""></h4>

                    </div>



                    <div class="col-md-12 complete-section text-center">

                        <h2>ALL DONE!</h2>

                        <h3 style="color:#33cc33">Processing</h3>

                        <p id="checkpass">

                        You have completed all steps to start your background check. Your application is completed, and you have passed your background check. Congratulations! Your business verified membership will expire on <?=date('d/m/Y', strtotime("+1 year"))?>. You will need to do another verification once the membership expires. Your business verified badge has been added to your profile.

                        </p>

                        <p id="checkreject" style="display:none">

                        Your background check did not pass. Fitnessity has been alerted and is taking a look at the results. Your profile will not reflect a verified business badge. If you think this is a mistake, please get in touch with us at contact@fitnesiity.co/verifiedbusiness, and you may be able to do another check after.

                        </p>

                        <img src="{{ url('public/images/verified-logo.png') }}" alt="">

                    </div>

                    <div class="col-md-12">

                        <br/>

                        <div class="row">

                            <div class="col-md-6">

                                <button type="button" class="btn-bck" id="backverified5"><i class="fa fa-arrow-left"></i> Back</button>

                            </div>

                            <div class="col-md-6 text-right">

                                <button type="submit" class="btn-nxt" id="nextverified5">Save & Continue <i class="fa fa-arrow-right"></i></button>

                            </div>

                        </div>

                        <br>

                    </div>

                </div>

            </form>



            

            <form name="creService" id="creService" action="{{route('business.services.store')}}" method="post" enctype="multipart/form-data">

                <?php

                    $service_type = $sport_activity = ""; $instant_booking = $request_booking = '';
                    $program_name = $program_desc = $knowbeforeugo = $profile_pic = $meetup_location = $frm_min_participate = $beforetime = $beforetimeint= $cancelbefore = $cancelbeforeint = "";
                    $notice_value = $notice_key = $advance_value = $advance_key = $activity_value = $activity_key = $cancel_value = $cancel_key = $willing_to_travel = $miles = $area = "";
                    $select_service_type = $activity_location = $activity_for = $age_range = $group_size = $difficult_level = $activity_experience = $instructor_habit = $is_late_fee ="";
                    $late_fee = $bring_wear = $notincluded_items=$included_items=$req_safety = $days_plan_title = $days_plan_desc=''; $days_plan_img= $day_pic = $old_pic ='';
                    $dplantitle= $dplandesc = $dplanimg= [];

                    
                    $mon_shift_start = $mon_shift_end = $tue_shift_start = $tue_shift_end = $wed_shift_start = $wed_shift_end = $thu_shift_start = $thu_shift_end = "";

                    $fri_shift_start = $fri_shift_end = $sat_shift_start = $sat_shift_end = $sun_shift_start = $sun_shift_end = "";

                    $mon_duration = $tue_duration = $wed_duration = $thu_duration = $fri_duration = $sat_duration = $sun_duration = "";

                    $frm_servicedesc = $exp_country = $exp_address = $exp_building = $exp_city = $exp_state = $exp_zip = $full_address = $exp_lng = $exp_lat = "" ;
                    $instructor_id  =  $business_phone = '';
                    $profile_pic1  = [];

                   // echo "<pre>"; print_r($business_service); die;

                    if(isset($business_service)) {
                        if(isset($business_service['service_type']) && !empty($business_service['service_type'])) {
                            $service_type = $business_service['service_type'];
                        }

                        if(isset($business_service['sport_activity']) && !empty($business_service['sport_activity'])) {
                            $sport_activity = $business_service['sport_activity'];
                        }

                        if(isset($business_service['program_name']) && !empty($business_service['program_name'])) {
                            $program_name = $business_service['program_name'];
                        }

                        if(isset($business_service['program_desc']) && !empty($business_service['program_desc'])) {
                            $program_desc = $business_service['program_desc'];
                        }

                        if(isset($business_service['know_before_you_go']) && !empty($business_service['know_before_you_go'])) {
                            $knowbeforeugo = $business_service['know_before_you_go'];
                        }

                        if(isset($business_service['instructor_id']) && !empty($business_service['instructor_id'])) {
                            $instructor_id = $business_service['instructor_id'];
                        }

                        if(isset($business_service['profile_pic']) && !empty($business_service['profile_pic'])) {
                            $profile_pic = $business_service['profile_pic'];
                            if(str_contains($profile_pic, ',')){
                                $profile_pic1 = explode(',', $profile_pic);
                            }else{
                                $profile_pic1 = $profile_pic;
                            }
                        }
                       
                        if(isset($business_service['instant_booking']) && !empty($business_service['instant_booking'])) {
                            $instant_booking = $business_service['instant_booking'];
                        }

                        if(isset($business_service['request_booking']) && !empty($business_service['request_booking'])) {
                            $request_booking = $business_service['request_booking'];
                        }

                        if(isset($business_service['frm_min_participate']) && !empty($business_service['frm_min_participate'])) {
                            $frm_min_participate = $business_service['frm_min_participate'];
                        }
                        if(isset($business_service['beforetime']) && !empty($business_service['beforetime'])) {
                            $beforetime = $business_service['beforetime'];
                        }

                        if(isset($business_service['beforetimeint']) && !empty($business_service['beforetimeint'])) {
                            $beforetimeint = $business_service['beforetimeint'];
                        }

                        if(isset($business_service['notice_value']) && !empty($business_service['notice_value'])) {
                            $notice_value = $business_service['notice_value'];
                        }

                        if(isset($business_service['notice_key']) && !empty($business_service['notice_key'])) {
                            $notice_key = $business_service['notice_key'];
                        }

                        if(isset($business_service['advance_value']) && !empty($business_service['advance_value'])) {
                            $advance_value = $business_service['advance_value'];
                        }

                        if(isset($business_service['advance_key']) && !empty($business_service['advance_key'])) {
                            $advance_key = $business_service['advance_key'];
                        }

                        if(isset($business_service['activity_value']) && !empty($business_service['activity_value'])) {
                            $activity_value = $business_service['activity_value'];
                        }

                        if(isset($business_service['activity_key']) && !empty($business_service['activity_key'])) {
                            $activity_key = $business_service['activity_key'];
                        }

                        if(isset($business_service['cancel_value']) && !empty($business_service['cancel_value'])) {
                            $cancel_value = $business_service['cancel_value'];
                        }

                        if(isset($business_service['cancel_key']) && !empty($business_service['cancel_key'])) {
                            $cancel_key = $business_service['cancel_key'];
                        }

                        if(isset($business_service['willing_to_travel']) && !empty($business_service['willing_to_travel'])) {
                            $willing_to_travel = $business_service['willing_to_travel'];
                        }

                        if(isset($business_service['miles']) && !empty($business_service['miles'])) {
                            $miles = $business_service['miles'];
                        }

                        if(isset($business_service['area']) && !empty($business_service['area'])) {
                            $area = $business_service['area'];
                        }

                        if(isset($business_service['select_service_type']) && !empty($business_service['select_service_type'])) {
                            $select_service_type = $business_service['select_service_type'];
                        }

                        if(isset($business_service['activity_location']) && !empty($business_service['activity_location'])) {
                            $activity_location = $business_service['activity_location'];
                        }

                        if(isset($business_service['activity_for']) && !empty($business_service['activity_for'])) {
                            $activity_for = $business_service['activity_for'];
                        }

                        if(isset($business_service['age_range']) && !empty($business_service['age_range'])) {
                            $age_range = $business_service['age_range'];
                        }

                        if(isset($business_service['group_size']) && !empty($business_service['group_size'])) {
                            $group_size = $business_service['group_size'];
                        }

                        if(isset($business_service['difficult_level']) && !empty($business_service['difficult_level'])) {
                            $difficult_level = $business_service['difficult_level'];
                        }

                        if(isset($business_service['activity_experience']) && !empty($business_service['activity_experience'])) {
                            $activity_experience = $business_service['activity_experience'];
                        }

                        if(isset($business_service['instructor_habit']) && !empty($business_service['instructor_habit'])) {
                            $instructor_habit = $business_service['instructor_habit'];
                        }

                        if(isset($business_service['frm_servicedesc']) && !empty($business_service['frm_servicedesc'])) {
                            $frm_servicedesc = $business_service['frm_servicedesc'];
                        }

                        if(isset($business_service['exp_address']) && !empty($business_service['exp_address'])) {
                            $exp_address = $business_service['exp_address'];
                            $full_address .=  $exp_address.',';
                        }

                        if(isset($business_service['exp_building']) && !empty($business_service['exp_building'])) {
                            $exp_building = $business_service['exp_building'];
                        }

                        if(isset($business_service['exp_city']) && !empty($business_service['exp_city'])) {
                            $exp_city = $business_service['exp_city'];
                            $full_address .=  $exp_city.',';
                        }

                        if(isset($business_service['exp_state']) && !empty($business_service['exp_state'])) {
                            $exp_state = $business_service['exp_state'];
                            $full_address .=  $exp_state.',';
                        }

                        if(isset($business_service['exp_country']) && !empty($business_service['exp_country'])) {
                            $exp_country = $business_service['exp_country'];
                            $full_address .=  $exp_country.',';
                        }

                        if(isset($business_service['exp_zip']) && !empty($business_service['exp_zip'])) {
                            $exp_zip = $business_service['exp_zip'];
                        }
                        
                        if(isset($business_service['exp_lng']) && !empty($business_service['exp_lng'])) {
                            $exp_lng = $business_service['exp_lng'];
                        }

                        if(isset($business_service['exp_lat']) && !empty($business_service['exp_lat'])) {
                            $exp_lat = $business_service['exp_lat'];
                        }

                        if(isset($business_service['cancel_key']) && !empty($business_service['cancel_key'])) {
                            $cancel_key = $business_service['cancel_key'];
                        }

                        if(isset($business_service['is_late_fee']) && !empty($business_service['is_late_fee'])) {
                            $is_late_fee = $business_service['is_late_fee'];
                        }

                        if(isset($business_service['late_fee']) && !empty($business_service['late_fee'])) {
                            $late_fee = $business_service['late_fee'];
                        }

                        if(isset($business_service['included_items']) && !empty($business_service['included_items'])) {
                            $included_items = $business_service['included_items'];
                        }

                        if(isset($business_service['included_items']) && !empty($business_service['included_items'])) {
                            $included_items = $business_service['included_items'];
                        }

                        if(isset($business_service['notincluded_items']) && !empty($business_service['notincluded_items'])) {
                            $notincluded_items = $business_service['notincluded_items'];
                        }

                        if(isset($business_service['bring_wear']) && !empty($business_service['bring_wear'])) {
                            $bring_wear = $business_service['bring_wear'];
                        }

                        if(isset($business_service['req_safety']) && !empty($business_service['req_safety']))
                        {
                            $req_safety=explode(',',$business_service['req_safety']);
                        }

                        if(isset($business_service['days_plan_title']) && !empty($business_service['days_plan_title'])) {
                            $days_plan_title = $business_service['days_plan_title'];
                            if($days_plan_title  != "[null]"){
                                $dplantitle = json_decode($days_plan_title,true); 
                            }
                        }

                        if(isset($business_service['days_plan_desc']) && !empty($business_service['days_plan_desc'])) {
                            $days_plan_desc = $business_service['days_plan_desc'];
                            $dplandesc = json_decode($days_plan_desc,true);
                        }

                        if(isset($business_service['days_plan_img']) && !empty($business_service['days_plan_img'])) {
                            $days_plan_img = $business_service['days_plan_img'];
                            $dplanimg = json_decode($days_plan_img,true);
                        }

                        if(isset($business_service['meetup_location']) && !empty($business_service['meetup_location'])) {
                            $meetup_location = $business_service['meetup_location'];
                        }

                        if(isset($business_service['cancelbefore']) && !empty($business_service['cancelbefore'])) {
                            $cancelbefore = $business_service['cancelbefore'];
                        }


                        if(isset($business_service['cancelbeforeint']) && !empty($business_service['cancelbeforeint'])) {
                            $cancelbeforeint = $business_service['cancelbeforeint'];
                        }

                        if(isset($company_info['business_phone']) && !empty($company_info['business_phone'])) {
                            $business_phone = $company_info['business_phone'];
                            if (preg_match('/()-/', $business_phone)){
                                $business_phone = $business_phone;
                            }else{
                                $business_phone = preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '($1) $2-$3', $business_phone);
                            }
                        }
                    }

                    
                    $activity_meets = $starting = $schedule_until = "";
                    $sales_tax = $sales_tax_percent = $dues_tax = $dues_tax_percent = "";


                    if(isset($business_activity[0])) {
                        $activity = $business_activity[0];
                        if(isset($activity['activity_meets']) && !empty($activity['activity_meets'])) {
                            $activity_meets = $activity['activity_meets'];
                        }

                        if(isset($activity['starting']) && !empty($activity['starting'])) {
                            $starting = $activity['starting'];
                        }

                        if(isset($activity['schedule_until']) && !empty($activity['schedule_until'])) {
                            $schedule_until = $activity['schedule_until'];
                        }

                        if(isset($activity['set_duration']) && !empty($activity['set_duration']))
                        {
                            $set_duration = $activity['set_duration'];
                        }

                        if(isset($activity['sales_tax']) && !empty($activity['sales_tax'])) {
                            $sales_tax = $activity['sales_tax'];
                        }

                        if(isset($activity['sales_tax_percent']) && !empty($activity['sales_tax_percent'])) {
                            $sales_tax_percent = $activity['sales_tax_percent'];
                        }

                        if(isset($activity['dues_tax']) && !empty($activity['dues_tax'])) {
                            $dues_tax = $activity['dues_tax'];
                        }

                        if(isset($activity['dues_tax_percent']) && !empty($activity['dues_tax_percent'])) {
                            $dues_tax_percent = $activity['dues_tax_percent'];
                        }
                    }
   
                ?>

                @csrf

                <input type="hidden" name="userid" id="userid" value="{{Auth::user()->id}}">

                <?php /*?>if( !empty($business_service) ){ ?> 111

                    <input type="hidden" name="cid" value="{{$business_service['cid']}}">

                    <input type="text" name="serviceid" id="serviceid" value="{{$business_service['id']}}">

                <?php }else{<?php */?>

                <?php //} ?>

                <input type="hidden" name="cid" id="cid" value="{{Auth::user()->cid}}">

                <input type="hidden" name="bstep" id="bstep7" value="{{Auth::user()->bstep}}">

                <?php if( !empty($business_service) ){ ?>

                  <input type="hidden" name="serviceid" id="serviceid" value="{{$business_service['id']}}">

                <?php } else { ?>

                  <input type="hidden" name="serviceid" id="serviceid">

                <?php } ?>

                <?php if( Auth::user()->servicetype !='' ) { ?>

                  <input type="hidden" name="service_type" id="service_type" value="{{Auth::user()->servicetype}}">

                <?php } else { ?>

                  <input type="hidden" name="service_type" id="service_type" value="{{$service_type}}">

                <?php } ?>

                <input type="hidden" name="current_tab_name" id="current_tab_name" value="individualDiv0">

                

                <div class="container-fluid p-0" id="creServicediv" style="display: none;">
                    <div class="tab-hed">Create Services & Prices</div>
                    <?php /*?><div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">
                        <span class="nav-link1 subtab">PERSONAL TRAINER</span>
                        <span class="nav-link1 subtab1">GYM/STUDIO</span>
                        <span class="nav-link1 subtab2">EXPERIENCE</span>
                    </div><?php */?>

                    <section class="row newbusiness-img">
                        <?php /*?><div class="col-md-12 text-justify">
                            <br/>
                            <p><span style="font-size: 22px;font-weight: bold;">YOU'RE ALMOST DONE!</span> This last section is where you will describe your programs, add attractive images, description, prices, taxes, terms and conditions, contracts, one-time payments, recurring payment, sessions, and more. We recommend you make sure your price sare competitive to your skill level and to what the market demands</p>
                        </div><?php */?>

                        <div class="col-md-12 text-center">
                            <br>
                            <span style="font-size: 20px;font-weight: bold;text-transform: uppercase;display: block;padding-bottom: 20px;">GET STARTED BY SELECTING A SERVICE YOU OFFER BELOW</span>
                            <label class="newbuiness-txt">Click on one of the services below to start creating a service to offer. Only select the type of business that best represents the type of experiences you offer your clients. Don’t worry; you can set up more than one type of business type.</label>
                        </div>

                        <div class="col-md-12 col-sm-12 text-center">
                            <br/><br/>
                            <div class="col-md-4 col-xs-12">
								<div class="custome-div">
									<input type="radio" id="test1" name="radio_group" {{ ($service_type=='individual')?'checked':'' }} value="individual">
									<label for="test1">
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<img src="/public/images/newimage/bus-individual.png" class="pro_card_img1">
											</div>

											<div class="col-md-12 col-xs-12">
												<div class="tab-hed1">Personal Trainer</div>
												<p>A provider offers one-on-one personal training, coaching, nutrition advice, or instructions.</p>
											</div>
										</div>
									</label>
								</div>
                            </div>

                            <div class="col-md-4 col-xs-12">
								<div class="custome-div">
									<input type="radio" id="test2" name="radio_group" {{ ($service_type=='classes')?'checked':'' }} value="classes">
									<label for="test2">
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<img src="/public/images/newimage/bus-gym.png" class="pro_card_img1">
											</div>
											<div class="col-md-12 col-xs-12">
												<div class="tab-hed1">CLASSES</div>
												<p>A provider offers group fitness workouts and classes at a gym, studio, or facility.</p>
											</div>
										</div>
									</label>
								</div>
                            </div>
							
                            <div class="col-md-4 col-xs-12">
								<div class="custome-div">
									<input type="radio" id="test3" name="radio_group" {{ ($service_type=='experience')?'checked':'' }} value="experience">
									<label for="test3">
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<img src="/public/images/newimage/bus-experience.png" class="pro_card_img1">
											</div>

											<div class="col-md-12 col-xs-12">
												<div class="tab-hed1">Experience</div>
												<p>A provider that offers an adventurous activity or an experience surrounding the activity.</p>
											</div>
										</div>
									</label>
								</div>
                            </div>

                            <div class="col-md-4 col-xs-12">
								<div class="custome-div">
									<input type="radio" id="test4" name="radio_group" {{ ($service_type=='events')?'checked':'' }} value="events">
									<label for="test4">
										<div class="row">
											<div class="col-md-12 col-xs-12">
												<img src="/public/images/newimage/bus-experience.png" class="pro_card_img1">
											</div>

											<div class="col-md-12 col-xs-12">
												<div class="tab-hed1">EVENTS</div>
												<p>You offer events, seminars, races, marathons, meets, tournaments and more.</p>
											</div>
										</div>
									</label>
								</div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <br/>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button type="button" class="btn-bck" id="bck-nxt8"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="text-right btn-txt-rp">
                                        <button type="button" class="btn-nxt" id="nextservice">Continue <i class="fa fa-arrow-right"></i></button>
                                    </div>
                                </div>
                            </div>
                            <br/>
                        </div>
                    </section>
                </div>

                <div class="container-fluid p-0 checkCurrentTabName" id="individualDiv0" style="display: none;">

                    <div class="tab-hed">Create Services & Prices</div>

                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">

                        <span class="individualTxt nav-link1 subtab" style="{{ ($service_type=='individual')?'color:red':'' }}">PERSONAL TRAINER</span>

                       <?php /* ?> <span class="classesTxt nav-link1 subtab1" style="{{ ($service_type=='classes')?'color:red':'' }}">GYM/STUDIO</span> <?php */ ?>

                       <span class="classesTxt nav-link1 subtab1" style="{{ ($service_type=='classes')?'color:red':'' }}">CLASSES</span>

                        <span class="experienceTxt nav-link1 subtab2" style="{{ ($service_type=='experience')?'color:red':'' }}">EXPERIENCE</span>

                        <span class="eventsTxt nav-link1 subtab3" style="{{ ($service_type=='events')?'color:red':'' }}">EVENTS</span>

                    </div>

                    <section class="row" style="padding: 40px 10px;">

                        <div class="col-md-2">

                            <input type="button" class="btn btn-red" name="btnCreateService" id="btnCreateService" value="Create Service" />

                        </div>

                        <div class="col-md-2">

                            <?php //print_r($companyservice); ?>

                            @if( empty($companyservice[0]) )

                              <input type="button" class="btn btn-red" name="btnManageService" id="btnManageService" value="Manage Services" Disabled />

                            @else

                              <div class="dropdown">

                                <button class="btn btn-primary dropdown-toggle" type="button" name="btnManageService" id="btnManageService" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                            Manage Service

                                <span class="caret"></span>

                                </button>

                                    

                                    <ul class="dropdown-menu manageserviceUL" aria-labelledby="manage-service">

                                    @if(isset($companyservice) && !empty($companyservice[0]))

                                        @foreach($companyservice as $cs => $cservice)

                                            @if($cservice->id != 0)

                                                 <li class="{{ $cservice->service_type }}"><a href="javascript:void(0);" data-sid="{{ $cservice->id }}" class="clsManageService">{{ $cservice->sport_activity}} - {{ $cservice->program_name}} </a></li>

                                            @endif

                                        @endforeach

                                    @endif

                                    </ul>

                              </div>

                            @endif

                        </div>

                        <div class="col-md-8 text-justify individualBody" style="display:{{ ($service_type=='individual')?'block':'none' }};">

                            <p>Set up your details and prices for your training services. Let customers know why you are the best personal trainer/coach.Personal training is completitive market. Think about your descriptions, heading, images, & prices. It's essential to becompetitive with your price point but not too low to de-value your experience.</p>

                            <h3>Recommended Tips to Do :</h3>

                            <ul>

                                <li>Create a professional profile. It's your website and resumer to potential clients.</li>

                                <li>Sell your business and show what makes your business the best.</li>

                                <li>Take professional high-resolution pictures.</li>

                                <li>Showcase your certifications, awards, education, and experience.</li>

                            </ul>

                            <h3>Tips Not to Do :</h3>

                            <ul>

                                <li>You have images that are not professional, creepy, or uncomfortable to clients.</li>

                                <li>Not having a well-planned experiences.</li>

                                <li>Just going with the flow will not give you repeat business.</li>

                                <li>Creating a generic service that customers can easily do on their own.</li>

                                <li>Offering a service or experience you are not qualified or skilled to do.</li>

                            </ul>

                        </div>

                        

                        <div class="col-md-8 text-justify classesBody" style="display:{{ ($service_type=='classes')?'block':'none' }}; background:url(/public/img/fitness-bg2.jpg); background-size:100% 100%;">

                            <p>Booking and creating group classes, boot camps, clinics, and more is very easy. You can create services both online and offline.WHen creating your profile, how do you stand out from others? Every image, video, description, price, completed background check,positive reviews, and how you deliver your services will help you become a top business professional on Fitnessity.</p>

                            <h3>Recommended Tips to Do :</h3>

                             <ul>

                                <li>Create a professional profile. It's your website and resumes to potentials clients.</li>

                                <li>Sell your business and show what makes your business the best</li>

                                <li>Take professional pictures and make your customers feel welcomed.</li>

                            </ul>

                                <h3>Tips Not to Do :</h3>

                            <ul>

                                <li>Posting images or videos that are not of professional manner, creepy, or uncomfortable.</li>

                                <li>Not having a well-planned experience.</li>

                                <li>Just going with the flow will not give you repeat business.</li>

                                <li>Creating a generic service that customers can easily do on their own.</li>

                                <li>Offering a service you are not qualified or skilled to do.</li>

                            </ul>
                        </div>

                        

                        <div class="col-md-8 text-justify experienceBody" style="display:{{ ($service_type=='experience')?'block':'none' }}; background:url(/public/img/fitness-bg3.jpg); background-size:100% 100%;">

                            <p>Create your itinerary, service details, and prices for your experience. Let customers know what the plans are. Describe what you will do with your customers. What's unique and sets you apart from other similar experiences? How will you make customers feel included and engaged during your time together? Being specific about what guests will do on your activity is important. Set up a detailed itinerary so that guests know what to expect.</p>

                            <h3>Recommended Tips to Do :</h3>

                            <ul>

                                <li>Create an experience around your activity.</li>

                                <li>Make it unique and different.</li>

                                <li>Think about your meet-up points and how customers will get to you.</li>

                                <li>Think about what your experience includes and what your customers will need to bring.</li>

                                <li>Think about your plans and think about the experience your customer will have.</li>

                            </ul>

                            <h3>Tips Not to Do :</h3>

                            <ul>

                                <li>Having no experience planned around your activity.</li>

                                <li>Not having a well-planned experience.</li>

                                <li>Giving incomple information is not recommended.</li>

                                <li>Creating generic experiences and activities customers can easily do on their own.</li>

                                <li>Offering an experience you are not qualified or skilled to host.</li>

                            </ul>
                        </div>

                        <div class="col-md-8 text-justify eventsBody" style="display:{{ ($service_type=='events')?'block':'none' }}; background:url(/public/img/fitness-bg3.jpg); background-size:100% 100%;">

                            <p></p>

                            <h3>Recommended Tips to Do :</h3>

                            <ul>

                                <li>Create an experience around your activity.</li>

                                <li>Make it unique and different.</li>

                                <li>Think about your meet-up points and how customers will get to you.</li>

                                <li>Think about what your experience includes and what your customers will need to bring.</li>

                                <li>Think about your plans and think about the experience your customer will have.</li>

                            </ul>

                            <h3>Tips Not to Do :</h3>

                            <ul>

                                <li>Having no experience planned around your activity.</li>

                                <li>Not having a well-planned experience.</li>

                                <li>Giving incomple information is not recommended.</li>

                                <li>Creating generic experiences and activities customers can easily do on their own.</li>

                                <li>Offering an experience you are not qualified or skilled to host.</li>

                            </ul>
                        </div>

                        <div class="col-md-12">

                            <br>

                            <div class="row">

                                <div class="col-md-6">

                                    <button type="button" class="btn-bck" id="backindividual0"><i class="fa fa-arrow-left"></i> Back</button>

                                </div>

                                <div class="col-md-6 text-right hide">

                                    <button type="button" class="btn-nxt" id="nextindividual0">Continue <i class="fa fa-arrow-right"></i></button>

                                </div>

                            </div>

                            <br>

                        </div>

                    </section>

                </div>

                

               <?php /*?> we are no using this tab now<?php */?>

                <div class="container-fluid p-0 checkCurrentTabName" id="individualDiv1" style="display: none;">

                    <div class="tab-hed">Create Services & Prices</div>

                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">

                        <span class="individualTxt nav-link1 subtab" style="{{ ($service_type=='individual')?'color:red':'' }}">PERSONAL TRAINER</span>

                       <?php /* ?> <span class="classesTxt nav-link1 subtab1" style="{{ ($service_type=='classes')?'color:red':'' }}">GYM/STUDIO</span> <?php */ ?>

                       <span class="classesTxt nav-link1 subtab1" style="{{ ($service_type=='classes')?'color:red':'' }}">CLASSES</span>

                        <span class="experienceTxt nav-link1 subtab2" style="{{ ($service_type=='experience')?'color:red':'' }}">EXPERIENCE</span>

                        <span class="eventsTxt nav-link1 subtab3" style="{{ ($service_type=='events')?'color:red':'' }}">EVENTS</span>

                    </div>

                    <section class="row">

                        <div class="col-md-4">

                            <br/><br/><br/>

                            <select name="frm_servicesport--commented" id="frm_servicesport--commented" class="form-control" autocomplete="off">

                                <option value="">Choose a Sport/Activity</option>

                                <option {{ ($sport_activity=='Aerobics')?'selected':''}}>Aerobics</option>

                                <option {{ ($sport_activity=='Archery')?'selected':''}}>Archery</option>

                                <option {{ ($sport_activity=='Badminton')?'selected':''}}>Badminton</option>

                                <option {{ ($sport_activity=='Barre')?'selected':''}}>Barre</option>

                                <option {{ ($sport_activity=='Baseball')?'selected':''}}>Baseball</option>

                                <option {{ ($sport_activity=='Basketball')?'selected':''}}>Basketball</option>

                                <option {{ ($sport_activity=='Beach Vollyball')?'selected':''}}>Beach Vollyball</option>

                                <option {{ ($sport_activity=='Bouldering')?'selected':''}}>Bouldering</option>

                                <option {{ ($sport_activity=='Bungee Jumping')?'selected':''}}>Bungee Jumping</option>

                                <optgroup label="Camps &amp; Clinics">

                                    <option {{ ($sport_activity=='Day Camp')?'selected':''}}>Day Camp</option>

                                    <option {{ ($sport_activity=='Sleep Away')?'selected':''}}>Sleep Away</option>

                                    <option {{ ($sport_activity=='Winter Camp')?'selected':''}}>Winter Camp</option>

                                </optgroup>

                                <option {{ ($sport_activity=='Canoeing')?'selected':''}}>Canoeing</option>
                                
                                <option {{ ($sport_activity=='Camp')?'selected':''}}>Camp</option>

                                <optgroup label="Cycling">

                                    <option {{ ($sport_activity=='Indoor cycling')?'selected':''}}>Indoor cycling</option>

                                </optgroup>

                                <option {{ ($sport_activity=='Dance')?'selected':''}}>Dance</option>

                                <option {{ ($sport_activity=='Diving')?'selected':''}}>Diving</option>

                                <optgroup label="Field Hockey">

                                    <option {{ ($sport_activity=='Ice Hockey')?'selected':''}}>Ice Hockey</option>

                                </optgroup>

                                <option {{ ($sport_activity=='Football')?'selected':''}}>Football</option>

                                <option {{ ($sport_activity=='Golf')?'selected':''}}>Golf</option>

                                <option {{ ($sport_activity=='Gymnastics')?'selected':''}}>Gymnastics</option>

                                <option {{ ($sport_activity=='Hang Gliding')?'selected':''}}>Hang Gliding</option>

                                <option {{ ($sport_activity=='Hiit')?'selected':''}}>Hiit</option>

                                <option {{ ($sport_activity=='Hiking - Backpacking')?'selected':''}}>Hiking - Backpacking</option>

                                <option {{ ($sport_activity=='Horseback Riding')?'selected':''}}>Horseback Riding</option>

                                <option {{ ($sport_activity=='Ice Skating')?'selected':''}}>Ice Skating</option>

                                <option {{ ($sport_activity=='Kayaking')?'selected':''}}>Kayaking</option>

                                <option {{ ($sport_activity=='lacrosse')?'selected':''}}>lacrosse</option>

                                <option {{ ($sport_activity=='Laser Tag')?'selected':''}}>Laser Tag</option>

                                <optgroup label="Martial Arts">

                                    <option {{ ($sport_activity=='Boxing')?'selected':''}}>Boxing</option>

                                    <option {{ ($sport_activity=='Jiu-Jitsu')?'selected':''}}>Jiu-Jitsu</option>

                                    <option {{ ($sport_activity=='Karate')?'selected':''}}>Karate</option>

                                    <option {{ ($sport_activity=='Kick Boxing')?'selected':''}}>Kick Boxing</option>

                                    <option {{ ($sport_activity=='Kung Fu')?'selected':''}}>Kung Fu</option>

                                    <option {{ ($sport_activity=='MMA')?'selected':''}}>MMA</option>

                                    <option {{ ($sport_activity=='Self-Defense')?'selected':''}}>Self-Defense</option>

                                    <option {{ ($sport_activity=='Tai Chi')?'selected':''}}>Tai Chi</option>

                                    <option {{ ($sport_activity=='Wrestling')?'selected':''}}>Wrestling</option>

                                </optgroup>

                                <option {{ ($sport_activity=='Massage Therapy')?'selected':''}}>Massage Therapy</option>

                                <option {{ ($sport_activity=='Nutrition')?'selected':''}}>Nutrition</option>

                                <option {{ ($sport_activity=='Paint Ball')?'selected':''}}>Paint Ball</option>

                                <option {{ ($sport_activity=='Physical Therapy')?'selected':''}}>Physical Therapy</option>

                                <option {{ ($sport_activity=='Pilates')?'selected':''}}>Pilates</option>

                                <option {{ ($sport_activity=='Rafting')?'selected':''}}>Rafting</option>

                                <option {{ ($sport_activity=='Rapelling')?'selected':''}}>Rapelling</option>

                                <option {{ ($sport_activity=='Rock Climbing')?'selected':''}}>Rock Climbing</option>

                                <option {{ ($sport_activity=='Rowing')?'selected':''}}>Rowing</option>

                                <option {{ ($sport_activity=='Running')?'selected':''}}>Running</option>

                                <optgroup label="Sightseeing Tours">

                                    <option {{ ($sport_activity=='Airplane Tour')?'selected':''}}>Airplane Tour</option>

                                    <option {{ ($sport_activity=='ATV Tours')?'selected':''}}>ATV Tours</option>

                                    <option {{ ($sport_activity=='Boat Tours')?'selected':''}}>Boat Tours</option>

                                    <option {{ ($sport_activity=='Bus Tour')?'selected':''}}>Bus Tour</option>

                                    <option {{ ($sport_activity=='Caving Tours')?'selected':''}}>Caving Tours</option>

                                    <option {{ ($sport_activity=='Helicopter Tour')?'selected':''}}>Helicopter Tour</option>

                                </optgroup>

                                <option {{ ($sport_activity=='Sailing')?'selected':''}}>Sailing</option>

                                <option {{ ($sport_activity=='Scuba Diving')?'selected':''}}>Scuba Diving</option>

                                <option {{ ($sport_activity=='Sky diving')?'selected':''}}>Sky diving</option>

                                <option {{ ($sport_activity=='Snow Skiing')?'selected':''}}>Snow Skiing</option>

                                <option {{ ($sport_activity=='Snowboarding')?'selected':''}}>Snowboarding</option>

                                <option {{ ($sport_activity=='Strength')?'selected':''}}>Strength &amp; Conditioning</option>

                                <option {{ ($sport_activity=='Surfing')?'selected':''}}>Surfing</option>

                                <option {{ ($sport_activity=='Swimming')?'selected':''}}>Swimming</option>

                                <option {{ ($sport_activity=='Tennis')?'selected':''}}>Tennis</option>

                                <option {{ ($sport_activity=='Tours')?'selected':''}}>Tours</option>

                                <option {{ ($sport_activity=='Vollyball')?'selected':''}}>Vollyball</option>

                                <option {{ ($sport_activity=='Weight training')?'selected':''}}>Weight training</option>

                                <option {{ ($sport_activity=='Windsurfing')?'selected':''}}>Windsurfing</option>

                                <option {{ ($sport_activity=='Yoga')?'selected':''}}>Yoga</option>

                                <option {{ ($sport_activity=='Zip-Line')?'selected':''}}>Zip-Line</option>

                                <option {{ ($sport_activity=='Zumba')?'selected':''}}>Zumba</option>

                            </select>

                            <span class="error" id="err_frm_servicesport"></span>

                            <br/>

                            <input type="text" name="frm_servicetitle_two--commented" id="frm_servicetitle_two--commented" placeholder="Name of Program" title="servicetitle" value="{{ $program_name }}" class="form-control">

                            <span class="error" id="err_frm_servicetitle_two--commented"></span>

                            <br/><br/>

                            <div class="text-center" style="display: none"> <label>No Service Added Yet.<br>

                                    Get started by selecting Add Activity Category to choose the activity.</label></div>

                        </div>

                        

                        <div class="col-md-8 text-justify individualBody" style="display: {{ ($service_type=='individual')?'block':'none' }}; background:url(/public/img/fitness-bg1.jpg); background-size:100% 100%;">

                            <p>Let’s create your service details and prices for your independent business.

                                Let customers know why you are the best at what you do. 1-on-1 businesses can

                                be a competitive market. When creating your profile, how do you stand out from

                                others. Every image, video, description, price, background check, review, and the

                                way you deliver your services will help you become a top business professional

                                on Fitnessity</p>

                            <h3>Recommended Tips to Do :</h3>

                            <p>- Create a professional profile. It’s your website and resume to potential clients.</p>

                            <p>- Sell your business and show what makes your business the best.</p>

                            <p>- Take professional pictures and make your customers feel welcomed.</p>

                            <h3>Tips Not to Do :</h3>

                            <p>- Having images that are not of professional manner, creepy or not comfortable.</p>

                            <p>- Not having a well-planned experience.</p>

                            <p>- Just going with the flow will not give you repeat business.</p>

                            <p>- Creating a generic service that customers can easily do on their own.</p>

                            <p>- Offering a service you are not qualified or skilled to do.</p>

                        </div>

                        

                        <div class="col-md-8 text-justify classesBody" style="display:{{ ($service_type=='classes')?'block':'none' }}; background:url(/public/img/fitness-bg2.jpg); background-size:100% 100%;">

                            <p>Booking and creating group classes, boot camps, clinics and more are one of the most popular 

                                services for kids, teens, and adults. Create services that use all of the tools Fitnessity 

                                offers to make your business the best it can be. Create services for both online and offline 

                                if you can. When creating your profile, how do you stand out from others? Every image, video, 

                                description, price, background check, review, and how you deliver your services will help you 

                                become a top business professional on Fitnessity.</p>

                            <h3>Recommended Tips to Do :</h3>

                            <p>- Create a professional profile. It’s your website and resume to potential clients.</p>

                            <p>- Sell your business and show what makes your business the best.</p>

                            <p>- Take professional pictures and make your customers feel welcomed.</p>

                            <h3>Tips Not to Do :</h3>

                            <p>- Having images that are not of professional manner, creepy or not comfortable.</p>

                            <p>- Not having a well-planned experience.</p>

                            <p>- Just going with the flow will not give you repeat business.</p>

                            <p>- Creating a generic service that customers can easily do on their own.</p>

                            <p>- Offering a service you are not qualified or skilled to do.</p>

                        </div>

                        

                        <div class="col-md-8 text-justify experienceBody" style="display:{{ ($service_type=='experience')?'block':'none' }}; background:url(/public/img/fitness-bg3.jpg); background-size:100% 100%;">

                           <p>Let’s create your itinerary, service details and prices for your experience.  

                            Let customers know what the plans are. Describe what you will do with your customers.  

                            What unique details set it apart from other similar experiences? How will you make 

                            customers feel included and engaged during your time together? Being specific about 

                            what guests will do on your activity. Set up a detailed itinerary so that guests 

                            know what to expect.</p>

                            <h3>Recommended Tips to Do :</h3>

                            <p>- Create an experience around your activity.</p>

                            <p>- Make it unique and different.</p>

                            <p>- Think about your meet-up points, how customers will get to you.</p>

                            <p>- Think about what your experience includes and what your customers will need to bring.</p>

                            <p>- Think about your plans and think about the experience your customer will have.</p>

                            <h3>Tips Not to Do :</h3>

                            <p>- Having no experience planned around your activity.</p>

                            <p>- Not having a well-planned experience.</p>

                            <p>- Giving incomplete information is not recommended.</p>

                            <p>- Creating generic experiences and activities customers can easily do on their own.</p>

                            <p>- Offering an experience you are not qualified or skilled to host.</p>

                        </div>

                        

                        <div class="col-md-12">

                            <br>

                            <div class="row">

                                <div class="col-md-6">

                                    <button type="button" class="btn-bck" id="backindividual1"><i class="fa fa-arrow-left"></i> Back</button>

                                </div>

                                <div class="col-md-6 text-right">

                                    <button type="button" class="btn-nxt" id="nextindividual1">Continue <i class="fa fa-arrow-right"></i></button>

                                </div>

                            </div>

                            <br>

                        </div>

                    </section>

                </div>

                <div class="container-fluid p-0 checkCurrentTabName" id="individualDiv2" style="display: none;">
                    <div class="tab-hed">Create Services & Prices</div>
                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">
                        <span class="individualTxt nav-link1 subtab" style="{{ ($service_type=='individual')?'color:red':'' }}">PERSONAL TRAINER</span>
                        <?php /* ?> <span class="classesTxt nav-link1 subtab1" style="{{ ($service_type=='classes')?'color:red':'' }}">GYM/STUDIO</span> <?php */ ?>

                       <span class="classesTxt nav-link1 subtab1" style="{{ ($service_type=='classes')?'color:red':'' }}">CLASSES</span>
                        <span class="experienceTxt nav-link1 subtab2" style="{{ ($service_type=='experience')?'color:red':'' }}">EXPERIENCE</span>
                        <span class="eventsTxt nav-link1 subtab3" style="{{ ($service_type=='events')?'color:red':'' }}">EVENTS</span>
                    </div>

                    <section class="row">
                        <div class="col-md-12">
                            <br/>
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="step-one">
                                        <h3>Step 1: Program Details</h3>
                                        <p>Explain to your customer what this program is.</p>
                                    </div>
                                    <div class="priceactivity">
                                        <select name="frm_servicesport" id="frm_servicesport" class="form-control" autocomplete="off">
                                            <option value="">Choose a Sport/Activity</option>
                                            @foreach(@$sportsdata as $Sports)
                                                <?php $optiondata = Sports::where('parent_sport_id',$Sports['id'])->get(); ?>
                                                @if(count($optiondata)>0)
                                                    <optgroup label="{{$Sports['sport_name']}}">
                                                    @foreach($optiondata as $data)
                                                        <option @if(strtoupper($sport_activity) == strtoupper($data['sport_name'])) selected @endif >{{$data['sport_name']}}</option>
                                                    @endforeach
                                                    </optgroup>
                                                @else
                                                <option @if(strtoupper($sport_activity) == strtoupper($Sports['sport_name'])) selected @endif >{{$Sports['sport_name']}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <span class="error" id="err_frm_servicesportS2"></span>
                                    </div>
                                    <div class="pro-title">
                                        <label>Program Title</label>
                                        <input type="text" class="form-control" name="frm_programname" id="frm_programname" placeholder="ex. Kickboxing for adults)" title="servicetitle" value="{{ $program_name }}">
                                        <span class="error" id="err_frm_programname"></span>
                                    </div>
                                    <div class="pro-title">
                                        <label>Program Description</label>
                                       <textarea class="form-control" rows="6" name="frm_programdesc" id="frm_programdesc" placeholder="Enter program description" maxlength="500">{{ $program_desc }}</textarea>
                                        <span class="error" id="err_frm_programdesc"></span>
                                        <div class="text-right"><span id="frm_programdesc_left">500</span> Characters Left</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="house_rules">Give your customers THINGS TO KNOW and information on how and what to prepare before they book</label>
                                        <textarea  placeholder="Tell your customers how they should conduct themselves when attending your place of business or participating in your activity. Set out a few guidelines to help things go smoothly." name="know_before_you_go" id="house_rules" cols="30" rows="6" class="form-control" maxlength="2000">{{ $knowbeforeugo }}</textarea>
                                        <span class="error" id="err_house_rules"></span>

                                        <div class="text-right"><span id="house_rules_left">2000</span> Characters Left</div>
                                    </div> 

                                    <?php $staffdata = StaffMembers::where('user_id',Auth::user()->id)->get(); ?>
                                    <div class="selectinstructor">  
                                        <h3>Choose Instructor</h3> <a href="" data-toggle="modal" data-target="#addins" class="modelbox-edit-link">Add Instructor</a>
                                        <p>Which staff member(s) will lead this program?</p>
                                        <div class="selectstaff">
                                            <select name="instructor_id" id="instructor_id" class="form-control">
                                                <option value="">Select Your Instructor </option>
                                                @if(!empty($staffdata))
                                                    @foreach($staffdata as $data)
                                                        <option value="{{$data->id}}" @if($instructor_id == $data->id) selected @endif> {{$data->name}} </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-7 col-xs-11">
                                    <div class="addphotos">
                                        <h3>Add Photos For Your Program</h3>
                                        <ul>
                                            <li>Photos uploaded should show details and people in action</li>
                                            <li>Photos should be high resolution and not pixelated.</li>
                                            <li>Photos should be professional and reflect the best of what your program represents.</li>
                                            <li>Photos should not have heavy filters, distortion, overlaid text, or watermarks </li>
                                        </ul>
                                    </div>
                                    <div id="dropBox">
                                        <p>Drag & Drop Images Here...</p>
                                       <!--  <form class="imgUploader"> -->
                                            <input type="file" id="imgUpload" name="imgUpload[]" multiple accept="image/*" onchange="filesManager(this.files)">
                                            <label class="buttonimg" for="imgUpload">...or Upload from your device</label>
                                       <!--  </form> -->
                                        <div id="gallery">
                                            @if(is_array(@$profile_pic1))
                                                <?php $i=0;?>
                                                    @if(!empty(@$profile_pic1))
                                                        @foreach(@$profile_pic1 as $img)
                                                            @if(!empty($img) && File::exists(public_path("/uploads/profile_pic/".$img)))
                                                            <div class="imagediv  imgno_{{$i}}" >
																<div class="more-option">
																	<div class="more">
																		<div class="more-post-optns">
																			<i class="fa fa-ellipsis-h"></i>
																			<ul>
																				<li><a  imgname="{{$img}}" class="editpopup" href="javascript:void(0);" serviceid="{{$business_service['id']}}"><i class="fa fa-pencil-square-o"></i>Edit Post</a></li>
																				<li><a href="javascript:void(0);" class="delpagepost" serviceid="{{$business_service['id']}}" imgname="{{$img}}" valofi={{$i}}><i class="fa fa-trash"></i>Delete Post</a></li>
																			</ul>
																		</div>
																	</div>
																</div>
                                                                <img src="{{ url('/public/uploads/profile_pic/'.$img) }}">
                                                            </div>
                                                            @endif
                                                        <?php $i++; ?>
                                                        @endforeach
                                                    @endif
                                            @else
                                                @if(!empty($profile_pic1) && File::exists(public_path("/uploads/profile_pic/".$profile_pic1)))
                                                    <div class="imagediv  imgno_0" >
                                                        <div class="more-option">
                                                            <div class="more">
                                                                <div class="more-post-optns">
                                                                    <i class="fa fa-ellipsis-h"></i>
                                                                    <ul>
                                                                        <li>
                                                                           <a imgname="{{$profile_pic1}}" class="editpopup" href="javascript:void(0);" serviceid="{{$business_service['id']}}"><i class="fa fa-pencil-square-o"></i>Edit Post</a>
                                                                           <!--  <a imgname="{{$profile_pic1}}" class="editpopup" href="javascript:void(0);" erviceid="{{$business_service['id']}}" onclick="openEditphotoModal();"><i class="fa fa-pencil-square-o"></i>Edit Post</a>  -->
                                                                           <!-- <a data-toggle="modal" data-target="#edit_post"><i class="fa fa-pencil-square-o"></i>Edit Post</a> --> 

                                                                        </li>
                                                                        <li><a href="javascript:void(0);" class="delpagepost" serviceid="{{$business_service['id']}}" imgname="{{$profile_pic1}}" valofi="0"><i class="fa fa-trash"></i>Delete Post</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <img src="{{ url('/public/uploads/profile_pic/'.$profile_pic1) }}">
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">

                            <br>

                            <div class="row">

                                <div class="col-md-6">

                                    <button type="button" class="btn-bck" id="backindividual2"><i class="fa fa-arrow-left"></i> Back</button>

                                </div>

                                <div class="col-md-6 text-right">

                                    <button type="button" class="btn-nxt" id="nextindividual2">Continue <i class="fa fa-arrow-right"></i></button>

                                </div>

                            </div>

                            <br>

                        </div>

                    </section>

                </div>



                <div class="container-fluid p-0 checkCurrentTabName" id="individualDiv3" style="display: none;">
                    <div class="tab-hed">Create Services & Prices</div>
                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">
                        <span class="individualTxt nav-link1 subtab" style="{{ ($service_type=='individual')?'color:red':'' }}">PERSONAL TRAINER</span>
                        <?php /* ?> <span class="classesTxt nav-link1 subtab1" style="{{ ($service_type=='classes')?'color:red':'' }}">GYM/STUDIO</span> <?php */ ?>

                       <span class="classesTxt nav-link1 subtab1" style="{{ ($service_type=='classes')?'color:red':'' }}">CLASSES</span>
                        <span class="experienceTxt nav-link1 subtab2" style="{{ ($service_type=='experience')?'color:red':'' }}">EXPERIENCE</span>
                        <span class="eventsTxt nav-link1 subtab3" style="{{ ($service_type=='events')?'color:red':'' }}">EVENTS</span>
                    </div>

                    <section class="row">
                        <br/>
                        <div class="col-md-12">
                            <div class="service_type">
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="step-one">
                                            <h3>Step 2: Booking Settings</h3>
                                            <p>Provide more details to get booked</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-1">  
                                        <div class="instantl-book map-sp">
                                            <div class="">
                                                <label class="switch" for="instantbooking">
                                                    <input type="checkbox" name="instantbooking" id="instantbooking" onchange="changetoggle(this.value,'instantbooking');" @if(@$request_booking == '' || @$request_booking == 0) checked @endif>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-11">
                                        <div class="booking-title">
                                            <label>INSTANT BOOKING:</label>
                                            <p>Allow customers to book you instantly (Recommeded to get more bookings)</p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-1">  
                                        <div class="instantl-book map-sp">
                                            <div class="">
                                                <label class="switch" for="requestbooking">
                                                    <input type="checkbox" name="requestbooking" id="requestbooking" onchange="changetoggle(this.value,'requestbooking');" @if(@$request_booking == 1) checked @endif>
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-11">
                                        <div class="booking-title">
                                            <label>REQUEST BOOKING:</label>
                                            <p>Customers can request a booking, but you want to confirm first.(Less booking frequency with this option) </p>
                                        </div>
                                    </div>
                                    <script type="text/javascript">

                                        $("#instantbooking").on('change', function() {
                                            if ($(this).is(':checked')) {
                                                switchStatus = $(this).is(':checked');
                                                $("#requestbooking").prop("checked", false);
                                                $('#requestbooking').value(1);
                                            }
                                            else {
                                                $("#requestbooking").prop("checked", true);
                                                $('#requestbooking').value(0); 
                                            }
                                        });

                                        $("#requestbooking").on('change', function() {
                                            if ($(this).is(':checked')) {
                                                switchStatus = $(this).is(':checked');
                                                $("#instantbooking").prop("checked", false);
                                                $('#instantbooking').value(1);
                                            }
                                            else {
                                                switchStatus = $(this).is(':checked');
                                                $("#instantbooking").prop("checked", true);
                                                $('#instantbooking').value(1);
                                            }
                                        });

                                    </script>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-lg-5">
                                        <div class="participant-req">
                                            <p>What is the minimum participant requirement for each booking?</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="sp-bottom">
                                            <input type="text" class="form-control valid" name="frm_min_participate" id="frm_min_participate" placeholder="1" value="@if($frm_min_participate != '') {{$frm_min_participate}} @else 1 @endif">
                                        </div>
                                    </div>
                                </div>

                                <?php /* ?><div class="row">
                                    <div class="col-md-6 col-lg-5">
                                        <div class="">
                                            <p>What is the latest a customer can book before your activity starts?</p>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="sp-bottom">
                                            <input type="text" class="form-control valid" name="beforetimeint" id="beforetimeint" placeholder="1" @if($beforetimeint != '') value="{{$beforetimeint}}" @else value="1" @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="sp-bottom">
                                            <select class="form-control week-section" name="beforetime" id="beforetime">
                                                <option value="minutes"  <?=($beforetime=='minutes')?"selected":""?>>Minute(s)</option>
                                                <option value="hours"  <?=($beforetime=='hours')?"selected":""?>>Hour(s)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>?php */ ?>

                                <div class="row">
                                    <div class="col-md-4 col-lg-4">
                                        <div class="">
                                            <p>Whats the latest a customer can cancel?</p>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="sp-bottom">
                                            <input type="text" class="form-control valid" name="cancelbeforeint" id="cancelbeforeint" placeholder="1" @if($cancelbeforeint != '') value="{{$cancelbeforeint}}" @else value="1" @endif>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="sp-bottom">
                                            <select class="form-control week-section" name="cancelbefore" id="cancelbefore">
                                                <option value="minutes"  <?=($cancelbefore=='minutes')?"selected":""?>>Minute(s)</option>
                                                <option value="hours"  <?=($cancelbefore=='hours')?"selected":""?>>Hour(s)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 col-sm-6">
                                        <div class="priceselect sp-select">
                                            <label>Select Service Type</label>
                                            <div id="individualstype" style="display:none;">
                                                <select name="frm_servicetype[]" id="categSTypeidividual" multiple>
                                                    <option value="Personal Training">Personal Training</option>
                                                    <option value="Coaching">Coaching</option>
                                                    <option value="Therapy">Therapy</option>
                                                    <option value="Event">Event </option>
                                                    <option value="Seminar">Seminar </option>
                                                </select>
                                            </div>
                                            <div id="experiencestype" style="display:none;">
                                                <select name="frm_servicetype[]" id="categSType" multiple>
                                                    <option value="Personal Training">Personal Training</option>
                                                    <option value="Coaching">Coaching</option>
                                                    <option value="Class">Class</option>
                                                    <option value="Therapy">Therapy</option>
                                                    <option value="Gym">Gym</option>
                                                    <option value="Adventure">Adventure</option>
                                                    <option value="Trip">Trip</option>
                                                    <option value="Tour">Tour</option>
                                                    <option value="Camp">Camp</option>
                                                    <option value="Team">Team</option>
                                                    <option value="Clinic">Clinic</option>
                                                    <option value="Event">Event </option>
                                                    <option value="Seminar">Seminar </option>
                                                </select>
                                            </div>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#categSType'
                                                });
                                            </script>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#categSTypeidividual'
                                                });
                                            </script>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="priceselect sp-select">
                                            <label>Location of Activity ?</label>
                                            <select name="frm_servicelocation[]" id="frm_servicelocation" multiple>
                                                <option value="Online">Online</option>
                                                <option value="At Business">At Business</option>
                                                <option value="On Location">On Location</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#frm_servicelocation'
                                                });
                                            </script>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-6">
                                        <div class="priceselect sp-select">
                                            <label>Activity Great For ?</label>
                                            <select name="frm_programfor[]" id="frm_programfor" multiple>
                                                <option value="Kids">Kids</option>
                                                <option value="Teens">Teens</option>
                                                <option value="Adults">Adults</option>
                                                <option value="Family">Family</option>
                                                <option value="Groups">Groups</option>
                                                <option value="Paralympic">Paralympic</option>
                                                <option value="Prenatal">Prenatal</option>
                                                <option value="Any">Any</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#frm_programfor'
                                                });
                                            </script>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-6">
                                        <div class="priceselect sp-select">
                                            <label>What age is this for?</label>
                                            <select name="frm_agerange[]" id="frm_agerange" multiple>
                                                <option value="Baby (0 to 12 months)">Baby (0 to 12 months)</option>
                                                <option value="Toddler (1 to 3 yrs.)">Toddler (1 to 3 yrs.)</option>
                                                <option value="Preschool (4 to 5 yrs.)">Preschool (4 to 5 yrs.)</option>
                                                <option value="Grade School (6 to 12 yrs.)">Grade School (6 to 12 yrs.)</option>
                                                <option value="Teen (13 to 17 yrs.)">Teen (13 to 17 yrs.)</option>
                                                <option value="Young Adult (18 to 21 yrs.)">Young Adult (18 to 21 yrs.)</option>
                                                <option value="Older Adult (21 to 39 yrs.)">Older Adult (21 to 39 yrs.)</option>
                                                <option value="Middle Age (40 to 59 yrs.)">Middle Age (40 to 59 yrs.)</option>
                                                <option value="Senior Adult (60 +)">Senior Adult (60 +)</option>
                                                <option value="Any">Any</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#frm_agerange'
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 col-sm-6">
                                        <div class="priceselect sp-select">
                                            <label>Difficulty Levels?</label>
                                            <select name="frm_experience_level[]" id="frm_experience_level" multiple>
                                                <option>Easy</option>
                                                <option>Medium</option>
                                                <option>Hard</option>
                                                <option>Any</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#frm_experience_level'
                                                });
                                            </script>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <div class="priceselect sp-select">
                                            <label>Customers Experience for this Activity?</label>
                                            <select name="frm_servicefocuses[]" id="frm_servicefocuses" multiple>
                                                <option value="Have Fun"> Have Fun</option>
                                                <option value="Adventurous">Adventurous</option>
                                                <option value="Thrilling">Thrilling</option>
                                                <option value="Physically Challenging">Physically Challenging </option>
                                                <option value="Mentally Challenging">Mentally Challenging </option>
                                                <option value="Peaceful">Peaceful</option>
                                                <option value="Calm">Calm</option>
                                                <option value="Gain Focus">Gain Focus</option>
                                                <option value="Learning a skill">Learning a skill</option>
                                                <option value="To accomplish a goal">To accomplish a goal</option>
                                                <option value="Gain Discipline">Gain Discipline</option>
                                                <option value="Gain Confidence">Gain Confidence</option>
                                                <option value="Better hand-eye coordination">Better hand-eye coordination</option>
                                                <option value="Get a toned body">Get a toned body</option>
                                                <option value="Get better nutrition habits">Get better nutrition habits</option>
                                                <option value="Release Pain">Release Pain</option>
                                                <option value="Relax">Relax</option>
                                                <option value="Body Alignment">Body Alignment</option>
                                                <option value="Strength and Conditioning">Strength and Conditioning </option>
                                                <option value="Athletic Conditioning">Athletic Conditioning</option>
                                                <option value="Better Technique">Better Technique</option>
                                                <option value="Weight Loss Help">Weight Loss Help</option>
                                                <option value="Competition training and prep">Competition training and prep</option>
                                                <option value="Gain better cardio">Gain better cardio</option>
                                            </select>

                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#frm_servicefocuses'
                                                });
                                            </script>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 col-sm-6">
                                        <div class="priceselect sp-select">
                                            <label>Personality & Habits of Instructor?</label>
                                            <select name="frm_teachingstyle[]" id="teaching" multiple>
                                                <option value="An educator">An Educator</option>
                                                <option value="A teacher">A Teacher</option>
                                                <option value="A lot of energy">A lot of energy</option>
                                                <option value="A drill sergeant">A drill sergeant</option>
                                                <option value="Inspiring">Inspiring</option>
                                                <option value="Motivational">Motivational</option>
                                                <option value="Supportive, Soft and Nurturing">Supportive, Soft and Nurturing</option>
                                                <option value="Tough and Firm">Tough and Firm</option>
                                                <option value="Gentle">Gentle</option>
                                                <option value="Intense">Intense</option>
                                                <option value="Likes to talk">Likes to talk</option>
                                                <option value="Punctual">An entertainer</option>
                                                <option value="Organized">Stern</option>
                                                <option value="Stern">Friendly & outgoing</option>
                                                <option value="Tells jokes and funny">Tells jokes and funny</option>
                                                <option value="Loves to talk">Loves to talk about the details</option>
                                                <option value="Very Organized">Very Organized</option>
                                                <option value="Punctual">Punctual</option>
                                                <option value="On Time">On Time</option>
                                            </select>

                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#teaching'
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>

                                <div  id="experienceitinerary" style="display:none;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="itinerary-data">
                                                <h3>Set Up Your Itinerary</h3> <p>( Let customers know what they will be doing for this experience)</p>
                                                <hr style="border: 1px solid #ec1b24; width: 100%; float: left; margin-top: 5px;">
                                            </div>
                                            <div class="highlights-title">
                                                <label>Experience Highlights</label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <textarea class="form-control valid" rows="6" name="exp_highlight" id="exp_highlight" maxlength="1000" placeholder="Briefly describe a few highlights so customer understand what they will be doing. ">{{@$business_service['exp_highlight']}}</textarea>
                                                        <span id="exp_highlight_left">1,000 Character Left</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <hr style="border: 1px solid #ec1b24; width: 100%; float: left; margin-top: 15px;">
                                            
                                        <div class="col-md-12">
                                            <div class="booking-titles">
                                                <h3>What’s Included with this experience?</h3>
                                                <p>What do you provide for your customers?</p>
                                                <p>Examples: You provide pick up and drop off transportation from hotels etc., provider, food and drinks, special equipment, video and photography services etc.)</p>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="activity-width">
                                                        <div class="special-offer select-dropoff">
                                                            <div class="multiples">
                                                                <select name="frm_included_things[]" id="frm_included_things" multiple class="mt-10">
                                                                    <option value="Safety & Protective Gear">Safety & Protective Gear</option>
                                                                    <option value="Activity Equipment">Activity Equipment</option>
                                                                    <option value="Breakfast">Breakfast</option>
                                                                    <option value="Lunch">Lunch</option>
                                                                    <option value="Dinner">Dinner</option>
                                                                    <option value="Snacks">Snacks</option>
                                                                    <option value="Drinks (tea, coffee, soda, bottled water, etc.) ">Drinks (tea, coffee, soda, bottled water, etc.)</option>
                                                                    <option value="Alcohol (beer, champagne, wine, mixed drink etc.)">Alcohol (beer, champagne, wine, mixed drink etc.)</option>
                                                                    <option value="Transportation">Transportation</option>
                                                                    <option value="Insurance Coverage">Insurance Coverage</option>
                                                                    <option value="Entrance Fees ">Entrance Fees </option>
                                                                    <option value="Airfare">Airfare</option>
                                                                    <option value="Taxes">Taxes</option>
                                                                    <option value="Professional Guide">Professional Guide</option>
                                                                    <option value="Guide Gratuity">Guide Gratuity</option>
                                                                    <option value="Accommodations">Accommodations</option>
                                                                    <option value="Video">Video</option>
                                                                    <option value="Photography">Photography</option>
                                                                    <option value="Fully Narrated">Fully Narrated</option>
                                                                    <option value="Historic landmarks">Historic landmarks</option>
                                                                    <option value="Rest period">Rest period</option>
                                                                    <option value="Typical souvenir">Typical souvenir</option>
                                                                </select>

                                                                <script>
                                                                    var p = new SlimSelect({
                                                                        select: '#frm_included_things'
                                                                    });
                                                                </script>
                                                                <span class="error" id="err_what_included"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="booking-titles">
                                                <h3>What’s Not Included with this experience?</h3>
                                                <p>List the items or services that are not includes with this experience. i.e. no food or drinks, no equipment, no insurance, etc. </p>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="activity-width">
                                                        <div class="special-offer select-dropoff">
                                                            <div class="multiples">
                                                                <select name="frm_notincluded_things[]" id="frm_notincluded_things" multiple>
                                                                    <option value="Safety & Protective Gear">Safety & Protective Gear</option>
                                                                    <option value="Activity Equipment">Activity Equipment</option>
                                                                    <option value="Breakfast">Breakfast</option>
                                                                    <option value="Lunch">Lunch</option>
                                                                    <option value="Dinner">Dinner</option>
                                                                    <option value="Snacks">Snacks</option>
                                                                    <option value="Drinks (tea, coffee, soda, bottled water, etc.) ">Drinks (tea, coffee, soda, bottled water, etc.)</option>
                                                                    <option value="Alcohol (beer, champagne, wine, mixed drink etc.)">Alcohol (beer, champagne, wine, mixed drink etc.)</option>
                                                                    <option value="Transportation">Transportation</option>
                                                                    <option value="Insurance Coverage">Insurance Coverage</option>
                                                                    <option value="Entrance Fees ">Entrance Fees </option>
                                                                    <option value="Airfare">Airfare</option>
                                                                    <option value="Taxes">Taxes</option>
                                                                    <option value="Professional Guide">Professional Guide</option>
                                                                    <option value="Guide Gratuity">Guide Gratuity</option>
                                                                    <option value="Accommodations">Accommodations</option>
                                                                    <option value="Video">Video</option>
                                                                    <option value="Photography">Photography</option>
                                                                    <option value="Fully Narrated">Fully Narrated</option>
                                                                    <option value="Historic landmarks">Historic landmarks</option>
                                                                    <option value="Rest period">Rest period</option>
                                                                    <option value="Typical souvenir">Typical souvenir</option>
                                                                </select>
                                                                <script>
                                                                    var p = new SlimSelect({
                                                                        select: '#frm_notincluded_things'
                                                                    });
                                                                </script>
                                                                 <span class="error" id="err_what_not_included"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="booking-titles">
                                                <h3>What Should Guest Bring and Wear?</h3>
                                                <p>If guests need anything in order to enjoy your experience, this is the place to tell them. Be as detailed as possible and add each item individually.</p>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="activity-width">
                                                        <div class="special-offer select-dropoff">
                                                            <div class="multiples">
                                                                <select name="frm_wear[]" id="frm_wear" multiple>
                                                                    <option value="Any Clothing Type">Any Clothing Type</option>
                                                                    <option value="Dress for warm weather">Dress for warm weather</option>
                                                                    <option value="Dress for wet weather">Dress for wet weather</option>
                                                                    <option value="Dress for cold weather">Dress for cold weather</option>
                                                                    <option value="Dress for nature activities">Dress for nature activities</option>
                                                                    <option value="Dress for wet activities">Dress for wet activities</option>
                                                                    <option value="Dress for cold activities">Dress for cold activities</option>
                                                                    <option value="Pants">Pants</option>
                                                                    <option value="Long Sleeve">Long Sleeve</option>
                                                                    <option value="Jacket">Jacket</option>
                                                                    <option value="Sandals">Sandals</option>
                                                                    <option value="Shoes">Shoes</option>
                                                                    <option value="Hats">Hats</option>
                                                                    <option value="Sunglasses">Sunglasses</option>
                                                                    <option value="Sunblock">Sunblock</option>
                                                                    <option value="Bug Spray">Bug Spray</option>
                                                                    <option value="Safety Goggles">Safety Goggles</option>
                                                                    <option value="Dinner">Dinner</option>
                                                                    <option value="Snacks">Snacks</option>
                                                                    <option value="First Aid Kit">First Aid Kit</option>
                                                                    <option value="Rain jacket">Rain jacket</option>
                                                                    <option value="Daypack">Daypack</option>
                                                                    <option value="Backpack">Backpack</option>
                                                                    <option value="Headlamp">Headlamp</option>
                                                                    <option value="Water bottle">Water bottle</option>
                                                                    <option value="Compass">Compass</option>
                                                                    <option value="Swimsuit">Swimsuit</option>
                                                                    <option value="Drybag (waterproof)">Drybag (waterproof)</option>
                                                                    <option value="Bandana or Buff headwear">Bandana or Buff headwear</option>
                                                                    <option value="Sleeping bag">Sleeping bag</option>
                                                                    <option value="Padlock">Padlock</option>
                                                                    <option value="Duct Tape">Duct Tape</option>
                                                                    <option value="Ear Plugs">Ear Plugs</option>
                                                                    <option value="Tent">Tent</option>
                                                                    <option value="Small Cooking Kit">Small Cooking Kit</option>
                                                                    <option value="Rope">Rope</option>
                                                                    <option value="Utility Knife">Utility Knife</option>
                                                                </select>
                                                                <script>
                                                                    var p = new SlimSelect({
                                                                        select: '#frm_wear'
                                                                    });
                                                                </script>
                                                                <span class="error" id="err_what_guest_bring"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="booking-titles">
                                                <h3>Accessibility</h3>
                                                <p>Explain if there is easy access for the disabled </p>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="accessibility select-dropoff">
                                                        <textarea class="form-control valid" rows="3" name="frm_accessibility" id="frm_accessibility" maxlength="500" >{{@$business_service['accessibility']}}</textarea>
                                                        <span id="frm_accessibility_left">500 Character Left</span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="booking-titles">
                                                <h3>Additional Information & FAQ</h3>
                                                <p>Have a few things you want your customers to know before arriving? </p>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="accessibility select-dropoff">
                                                        <textarea class="form-control valid" rows="6" name="frm_addi_info" id="frm_addi_info" maxlength="1000" >{{@$business_service['addi_info']}}</textarea>
                                                        <span id="frm_addi_info_left">1,000 Character Left</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr style="border: 1px solid #ec1b24; width: 100%; float: left; margin-top: 15px;">
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="plandaybyday">
                                                <h3>Let’s Plan Your Day By Day</h3>
                                                <p>Give your customers a day by day plan. Include a title, image and description of what the customers will be doing for that day. You can create multiple days. </p>

                                            @if(count($dplantitle) > 0)
                                                <input type="hidden"  name="planday_count" id="planday_count" value="{{count($dplantitle) - 1}}" />
                                            @else
                                                <input type="hidden"  name="planday_count" id="planday_count" value="0" />
                                            @endif
                                                <div class="add-another-day-schedule-block">
                                                <?php if(count($dplantitle) > 0){
                                                        for($i=0;$i<count($dplantitle);$i++){?>
                                                    <div class="add_another_day">
                                                        @if($i != 0)
                                                        <div class="col-md-11"></div><div class="col-md-1"><i class="remove-day-schedule fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove Day"></i></div>
                                                        @endif
                                                        <label class="select-dropoff">Day - <?php echo $i+1; ?></label>
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="photo-upload">
                                                                            <label for="dayplanpic{{$i}}" id="label">
                                                <?php if (@$dplanimg[$i] != '' && file_exists( public_path() . '/uploads/profile_pic/thumb/' . @$dplanimg[$i])){
                                                    $old_pic =  @$dplanimg[$i];
                                                   $day_pic = url('/public/uploads/profile_pic/thumb/' .  @$dplanimg[$i]);
                                                }else {
                                                    $old_pic =  '';
                                                   $day_pic = url('/public/images/Upload-Icon.png');
                                                } ?>
                                            
                                                                                <img src="{{$day_pic}}" class="pro_card_img blah planblah{{$i}}" id="showimg" >
                                                                                <span id="span_{{$i}}">Upload your file here</span>
                                                                                <input type="file" name="dayplanpic_{{$i}}" id="dayplanpic{{$i}}" class="uploadFile img" value="Upload Photo" onchange="planImg(this,{{$i}});" required>
                                                                            </label>
                                                                            <span class="error" id="err_oldservicepic2{{$i}}"></span>
                                                                            <input type="hidden" id="olddayplanpic2{{$i}}" name="olddayplanpic_{{$i}}" value="{{$old_pic}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div>
                                                                            <input type="text" class="form-control" name="days_title[]" id="days_title" placeholder="Give a heading for this day." title="servicetitle" value="{{$dplantitle[$i]}}">
                                                                        </div>
                                                                        <div class="description-txt">
                                                                            <textarea class="form-control valid" rows="2" name="days_description[]" id="days_description{{$i}}" placeholder="Give a description for this day" maxlength="500" oninput="changedesclenght({{$i}});">{{$dplandesc[$i]}}</textarea>
                                                                            <span id="days_description_left{{$i}}">500 Character Left</span>
                                                                        </div>
                                                                        <script type="text/javascript">
                                                                          $('#days_description_left{{$i}}').text(500-parseInt($("#days_description{{$i}}").val().length)); 
                                                                        </script>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                <?php } 
                                                    }else{ ?>
                                                    <div class="add_another_day">
                                                        <label class="select-dropoff">Day - 1</label>
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="photo-upload">
                                                                            <label for="dayplanpic0" id="label">
                                                                                <img src="{{url('/public/images/Upload-Icon.png')}}" class="pro_card_img blah planblah0" id="showimg" >
                                                                                <span id="span_0">Upload your file here</span>
                                                                                <input type="file" name="dayplanpic_0" id="dayplanpic0" class="uploadFile img" value="Upload Photo" onchange="planImg(this,0);" required>
                                                                            </label>
                                                                            <span class="error" id="err_oldservicepic20"></span>
                                                                            <input type="hidden" id="olddayplanpic20" name="olddayplanpic_0" value="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div>
                                                                            <input type="text" class="form-control" name="days_title[]" id="days_title" placeholder="Give a heading for this day." title="servicetitle">
                                                                        </div>
                                                                        <div class="description-txt">
                                                                            <textarea class="form-control valid" rows="2" name="days_description[]" id="days_description0" placeholder="Give a description for this day" maxlength="500" oninput="changedesclenght(0);"></textarea>
                                                                            <span id="days_description_left0">500 Character Left</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <span class="addnewdiv add-another-day-schedule">+ Add another day</span>
                                        </div>
                                        <hr style="border: 1px solid #ec1b24; width: 100%; float: left; margin-top: 15px;">
                                    </div>

                                    <div class="row">   
                                        <div class="col-md-6">
                                            <div class="return-info">
                                                <h3>Departure & Return Info & Describe the Location</h3>
                                                <p>Tell customers how and when you will depart and return, how to meet up, where to meet up, meeting point name and how to find you once the customer arrives. Don’t leave it up to customers to figure out how to meet up with you. Let them know before hand.</p>
                                                
                                                <textarea class="form-control valid" rows="6" name="desc_location" id="desc_location" placeholder="(Ex. Please arrive at the location of our business. The address reminder  is ABC Anytown, town, 12345 USA.) Or; We will pick you up at your hotel. Or; Please talk with your front desk staff about the meeting point, Or; Please meet us at Central Park at the entrance of 81st and Central Park West (CPW). Wait at the seating area if you arrive early. The instructor will have on a red hat and yellow vest. Please arrive 10 minutes before your activity starts.)" maxlength="500">{{@$business_service['desc_location']}}</textarea>
                                                <span id="desc_location_left">500 Character Left</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">   
                                        <div class="col-md-6">                  
                                            <div class="companydetails">
                                                <h3>Where should customers meet you?</h3>
                                                <p>If the meet up spot is different from the address you set earlier in Company Details, then you can set it here.</p>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="companydetails-info">
                                                        <label>Street address </label>
                                                        <input type="text" name="cus_st_address" id="cus_st_address" class="form-control" value="{{$exp_address}}">
                                                    </div>
                                                </div>
                                                <input type="hidden" id="address_p" value="{{ $full_address}}">
                                                <input type="hidden" name="cus_lat" id="cus_lat" value="{{$exp_lat}}">
                                                <input type="hidden" name="cus_lng" id="cus_lng" value="{{$exp_lng}}">
                                                <div id="cus_map" style="display: none;"></div>
                                                <div class="col-md-6">
                                                    <div class="companydetails-info">
                                                        <label>Country / Region </label>
                                                        <input type="text" name="cus_country" id="cus_country" class="form-control" value="{{$exp_country}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="companydetails-info">
                                                        <label>Bldg (optional)</label>
                                                        <input type="text" name="cus_addi_address" id="cus_addi_address" class="form-control" value="{{$exp_building}}"> 
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div>
                                                        <label> City </label>
                                                        <input type="text" name="cus_city" id="cus_city" class="form-control" value="{{$exp_city}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div>
                                                        <label>State  </label>
                                                        <input type="text" name="cus_state" id="cus_state" class="form-control" value="{{$exp_state}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div>
                                                        <label> ZIP code</label>
                                                        <input type="text" name="cus_zip" id="cus_zip" class="form-control" value="{{$exp_zip}}">
                                                    </div>
                                                </div>
                                                <div class="reviewerro" id="cus_map_error"></div>
                                                <div class="col-md-12">
                                                    <div class="select-dropoff">
                                                        <button class="showall-btn" type="button"  onclick="loadMaponclick();">Update Map</button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="pin-on-map">
                                                        <h3>Adjust the pin on the map</h3>
                                                        <p>You can drag the map so the pin is in the right location.</p>
                                                      <div class="mysrchmap_cus" style="height: 100%;min-height: 300px;">
                                                            <div id="map_canvas_cus">
                                                                <div class="maparea">
                                                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24176.251535935986!2d-73.96828678121815!3d40.76133318281456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258c4d85a0d8d%3A0x11f877ff0b8ffe27!2sRoosevelt%20Island!5e0!3m2!1sen!2sin!4v1620041765199!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="maparea"> 
                                                           <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24176.251535935986!2d-73.96828678121815!3d40.76133318281456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258c4d85a0d8d%3A0x11f877ff0b8ffe27!2sRoosevelt%20Island!5e0!3m2!1sen!2sin!4v1620041765199!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy"></iframe> 
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr style="border: 1px solid #ec1b24; width: 100%; float: left; margin-top: 15px;">
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="customers-help">
                                                <h3>Confirm your phone number if customers need your help</h3>
                                                <p>If customers have trouble finding your location, or need questions with help, they may need to call you. The number on file we'll give them is +1 {{$business_phone}}. </p>
                                                <h3>Any additinal information for help</h3>
                                                <textarea class="form-control valid" rows="3" maxlength="500" name="addi_info_help" id="addi_info_help">{{@$business_service['addi_info_help']}}</textarea>
                                                <span id="addi_info_help_left">500 Character Left</span>
                                            </div>
                                        </div>
                                    </div>
                              
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="customers-help">
                                                <h3>Require Safety Verifications </h3>
                                                <p>The primary booker has to successfully complete verified ID in order for them and their guests to attend your experience.</p>

                                                <input type="checkbox" id="id_proof" name="id_proof" value="1" @if(!empty($req_safety))
                                                    @if(in_array("id_proof", $req_safety)) checked @endif @endif />
                                                <label for="id_proof">Require the booker to have ID upon arrival for verificaiton of age and identity</label><br>
                                               
                                                <input type="checkbox" id="id_vaccine" name="id_vaccine" value="1" @if(!empty($req_safety))  @if(in_array("id_vaccine", $req_safety))checked @endif @endif />

                                                <label for="id_vaccine">Require the booker to have proof of Vacination. </label><br>

                                                <input type="checkbox" id="id_covid" name="id_covid" value="1"  @if(!empty($req_safety))  @if(in_array("id_covid", $req_safety))checked @endif @endif  />
                                                <label for="id_covid">Require the booker to have proof of a negative Covid-19 test. </label><br> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <br/>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn-bck" id="backindividual3"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>

                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn-nxt" data-type= "{{$service_type}}" id="nextindividual3">Continue <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            <br>
                        </div>
                    </section>
                </div>



                <div class="container-fluid p-0 checkCurrentTabName" id="individualDiv4" style="display: none;">

                    <div class="tab-hed">Create Services & Prices</div>

                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">

                        <span class="individualTxt nav-link1 subtab" style="{{ ($service_type=='individual')?'color:red':'' }}">PERSONAL TRAINER</span>

                       <?php /* ?> <span class="classesTxt nav-link1 subtab1" style="{{ ($service_type=='classes')?'color:red':'' }}">GYM/STUDIO</span> <?php */ ?>

                       <span class="classesTxt nav-link1 subtab1" style="{{ ($service_type=='classes')?'color:red':'' }}">CLASSES</span>

                        <span class="experienceTxt nav-link1 subtab2" style="{{ ($service_type=='experience')?'color:red':'' }}">EXPERIENCE</span>
                        <span class="eventsTxt nav-link1 subtab3" style="{{ ($service_type=='events')?'color:red':'' }}">EVENTS</span>

                    </div>

                    <section class="row">

                        <div class="col-md-12">

                            <div class="row" style="padding: 10px 100px;">

                                <div class="col-md-12 text-center">

                                    <h3 style="font-size: 17px;font-weight: bold;">SCHEDULE YOUR PROGRAM</h3>

                                    <label>Let’s select the dates and times this activity will happen</label>

                                </div>

                                <div class="col-md-12 text-center" style="padding: 30px 20px;">

                                    <div class="row">

                                        <div class="form-group col-md-4">

                                            <label>Activity Meets</label>

                                            <select class="form-control" name="frm_class_meets" id="frm_class_meets">

                                                <option value="Weekly" <?=($activity_meets=='Weekly')?"selected":""?>>Weekly</option>

                                                <option value="On a specific day" <?=($activity_meets=='On a specific day')?"selected":""?>>On a specific day</option>

                                            </select>

                                        </div>

                                        <div class="form-group col-md-4" id="startingpicker-position">

                                            <label>Starting</label>

                                            <input type="text" class="form-control frm_starting" name="starting" id="startingpicker" value="{{ $starting }}" min="<?php echo date('Y-m-d');?>">

                                        </div>

                                        <div class="form-group col-md-4 schedule_until_box">

                                            <input type="hidden" id="end_date" />

                                            <label>Program Expire In</label>

                                            <select class="form-control" name="frm_schedule_until" id="frm_schedule_until">

                                                <option value="1 Month" <?=($schedule_until=='1 Month')?'selected':''?>>1 Month</option>

                                                <option value="2 Months" <?=($schedule_until=='3 Months')?'selected':''?>>2 Months</option>

                                                <option value="3 Months" <?=($schedule_until=='3 Months')?'selected':''?>>3 Months</option>

                                                <option value="4 Months" <?=($schedule_until=='3 Months')?'selected':''?>>4 Months</option>

                                                <option value="5 Months" <?=($schedule_until=='3 Months')?'selected':''?>>5 Months</option>

                                                <option value="6 Months" <?=($schedule_until=='6 Months')?'selected':''?>>6 Months</option>

                                                <option value="7 Months" <?=($schedule_until=='7 Months')?'selected':''?>>7 Months</option>

                                                <option value="8 Months" <?=($schedule_until=='8 Months')?'selected':''?>>8 Months</option>

                                                <option value="9 Months" <?=($schedule_until=='9 Months')?'selected':''?>>9 Months</option>

                                                <option value="10 Months" <?=($schedule_until=='10 Months')?'selected':''?>>10 Months</option>

                                                <option value="11 Months" <?=($schedule_until=='11 Months')?'selected':''?>>11 Months</option>

                                                <option value="1 Year" <?=($schedule_until=='1 Year')?'selected':''?>>1 Year</option>

                                                <option value="2 Years" <?=($schedule_until=='2 Years')?'selected':''?>>2 Years</option>

                                                <option value="3 Years" <?=($schedule_until=='3 Years')?'selected':''?>>3 Years</option>

                                            </select>

                                        </div>

                                        <script>

                                            $('#end_date').datepicker({

                                                dateFormat: "mm/dd/yyyy",

                                            });

                                        </script>

                                    </div>

                                    <hr style="border: 1px solid #d4cfcf;width: 100%;">

                                    

                                    <div id="day-circle">

                                       <?php

                      if(isset($business_activity) && count($business_activity) > 0) { ?>

                                          <input type="hidden"  name="duration_cnt" id="duration_cnt" value="<?php echo count($business_activity); ?>" />

                    <?php } else { ?>

                      <input type="hidden"  name="duration_cnt" id="duration_cnt" value="0" />

                    <?php }

                                       $shift_start = $shift_end = $set_duration = $activity_days = "";

                                       if(isset($business_activity) && count($business_activity) > 0) {

                                        foreach($business_activity as $activity) {

                                            if(isset($activity['activity_days']) && !empty($activity['activity_days'])) {

                                                $activity_days = $activity['activity_days'];

                                            }

                                            if(isset($activity['shift_start']) && !empty($activity['shift_start'])) {

                                                $shift_start = $activity['shift_start'];

                                            }

                                            if(isset($activity['shift_end']) && !empty($activity['shift_end'])) {

                                                $shift_end = $activity['shift_end'];

                                            }

                                            if(isset($activity['set_duration']) && !empty($activity['set_duration'])) {

                                                $set_duration = $activity['set_duration'];

                                            }

                      

                                       ?>

                                       <div class="daycircle" id="editscheduler">

                                           <input type="hidden" name="activity_days[]" class="activity_days" width="800" value="<?=$activity_days?>" />

                                            <div class="row weekdays" style="justify-content: center;">

                                              <div class="col-md-11" style="display: flex;justify-content: center;">

                                                    <div data-day="Sunday" class="col-sm-1 timezone-round day_circle Sunday dys <?=(str_contains($activity_days, 'Sunday')) ? 'day_circle_fill' : '' ?>">

                                                        <p>Su</p>

                                                    </div>

                                                    <div data-day="Monday" class="col-sm-1 timezone-round day_circle Monday dys <?=(str_contains($activity_days, 'Monday')) ? 'day_circle_fill' : '' ?>">

                                                        <p>Mo</p>

                                                    </div>

                                                    <div data-day="Tuesday" class="col-sm-1 timezone-round day_circle Tuesday dys <?=(str_contains($activity_days, 'Tuesday')) ? 'day_circle_fill' : '' ?>">

                                                        <p>Tu</p>

                                                    </div>

                                                    <div data-day="Wednesday" class="col-sm-1 timezone-round day_circle Wednesday dys <?=(str_contains($activity_days, 'Wednesday')) ? 'day_circle_fill' : '' ?>">

                                                        <p>We</p>

                                                    </div>

                                                    <div data-day="Thursday" class="col-sm-1 timezone-round day_circle Thursday dys <?=(str_contains($activity_days, 'Thursday')) ? 'day_circle_fill' : '' ?>">

                                                        <p>Th</p>

                                                    </div>

                                                    <div data-day="Friday" class="col-sm-1 timezone-round day_circle Friday dys <?=(str_contains($activity_days, 'Friday')) ? 'day_circle_fill' : '' ?>">

                                                        <p>Fr</p>

                                                    </div>

                                                    <div data-day="Saturday" class="col-sm-1 timezone-round day_circle Saturday dys <?=(str_contains($activity_days, 'Saturday')) ? 'day_circle_fill' : '' ?>">

                                                        <p>Sa</p>

                                                    </div>

                                                </div>

                                                <div class="col-md-1"><i class="remove-activity fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove activity"></i></div>

                                            </div>

                                            <div class="row">

                                                <div class="form-group col-md-4">

                                                    From

                                                </div>

                                                <div class="form-group col-md-4">

                                                    To

                                                </div>

                                                <div class="form-group col-md-4">

                                                    Duration

                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="form-group col-md-4">

                                                    <?php timeSlotOption('shift_start', $shift_start); ?>

                                                </div>

                                                <div class="form-group col-md-4">

                                                    <?php timeSlotOption('shift_end', $shift_end); ?>

                                                </div>

                                                <div class="form-group col-md-4">

                                                    <input type="text" name="set_duration[]" id="set_duration" value="{{ $set_duration }}" readonly class="set_duration form-control" style="width:90%">

                                                </div>

                                            </div>

                                        </div> 

                                        

                                        <?php

                                       }} //else {

                       

                     ?>

                                    <div id="dayduration0">

                                       <div class="daycircle" style="display: none">

                                           <input type="hidden" name="activity_days[]" class="activity_days" width="800" value="" />

                                            <div class="row weekdays" style="justify-content: center;">

                                              <div class="col-md-11" style="display: flex;justify-content: center;">

                                                <div data-day="Sunday" class="col-sm-1 timezone-round day_circle Sunday dys">

                                                    <p>Su</p>

                                                </div>

                                                <div data-day="Monday" class="col-sm-1 timezone-round day_circle Monday dys">

                                                    <p>Mo</p>

                                                </div>

                                                <div data-day="Tuesday" class="col-sm-1 timezone-round day_circle Tuesday dys">

                                                    <p>Tu</p>

                                                </div>

                                                <div data-day="Wednesday" class="col-sm-1 timezone-round day_circle Wednesday dys">

                                                    <p>We</p>

                                                </div>

                                                <div data-day="Thursday" class="col-sm-1 timezone-round day_circle Thursday dys">

                                                    <p>Th</p>

                                                </div>

                                                <div data-day="Friday" class="col-sm-1 timezone-round day_circle Friday dys">

                                                    <p>Fr</p>

                                                </div>

                                                <div data-day="Saturday" class="col-sm-1 timezone-round day_circle Saturday dys">

                                                    <p>Sa</p>

                                                </div>

                                                </div>

                                                <div class="col-md-1"><i class="remove-activity fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove activity"></i></div>

                                            </div>

                                            <div class="row">

                                                <div class="form-group col-md-4">

                                                    From

                                                </div>

                                                <div class="form-group col-md-4">

                                                    To

                                                </div>

                                                <div class="form-group col-md-4">

                                                    Duration

                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="form-group col-md-4">

                                                    <?php timeSlotOption('shift_start', $shift_start); ?>

                                                </div>

                                                <div class="form-group col-md-4">

                                                    <?php timeSlotOption('shift_end', $shift_end); ?>

                                                </div>

                                                <div class="form-group col-md-4">

                                                    <input type="text" name="set_duration[]" id="set_duration" value="" readonly class="set_duration form-control" style="width:90%">

                                                     

                                                </div>

                                            </div>

                                        </div>

                                        </div>

                                        <?php 

                                       //}

                                       ?>

                                    </div>

                                    <br/>

                                    <div id="activity_scheduler_body">

                                        <!-- Activity description will fill here -->

                                    </div>

                                    <div class="col-md-12 text-center" style="margin-top: 50px;">

                                        <a id="test" class="button-fitness add-another-time">Add Another Time</a>

                                    </div>

                

                                </div>

                            </div>

                        </div>

                        <div class="col-md-12">

                            <br/>

                            <div class="row">

                                <div class="col-md-6">

                                    <button type="button" class="btn-bck" id="backindividual4"><i class="fa fa-arrow-left"></i> Back</button>

                                </div>

                                <div class="col-md-6 text-right">

                                    <button type="button" class="btn-nxt" id="nextindividual4">Continue <i class="fa fa-arrow-right"></i></button> 

                                   <!-- <button type="submit" class="btn-nxt" id="nextindividual4">Save & Continue  <i class="fa fa-arrow-right"></i></button> -->

                                </div>

                            </div>

                            <br/>

                        </div>

                    </section>

                </div>



                <div class="checkCurrentTabName" id="individualDiv5" style="display: none;">

                    <div class="container-fluid p-0">

                        <div class="tab-hed">CREATE SERVICES & PRICES</div>

                        <!-- <hr style="border: 15px solid black;width: 104%;margin-left: -38px;"> -->

                        <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">

                            <span class="individualTxt nav-link1 subtab" style="{{ ($service_type=='individual')?'color:red':'' }}">PERSONAL TRAINER</span>

                            <?php /* ?> <span class="classesTxt nav-link1 subtab1" style="{{ ($service_type=='classes')?'color:red':'' }}">GYM/STUDIO</span> <?php */ ?>

                       <span class="classesTxt nav-link1 subtab1" style="{{ ($service_type=='classes')?'color:red':'' }}">CLASSES</span>

                            <span class="experienceTxt nav-link1 subtab2" style="{{ ($service_type=='experience')?'color:red':'' }}">EXPERIENCE</span>
                            <span class="eventsTxt nav-link1 subtab3" style="{{ ($service_type=='events')?'color:red':'' }}">EVENTS</span>

                        </div>

                        <div class="row">

                            <div class="col-md-12">

                                <div class="serviceprice">

                                    <h3>Step 3: Set the price for this program</h3>

                                    <p>How much you charge customer for this program is entirely up to you. Set the price you want customer and see what you can earn. Remember to be competitive when selecting your price options.</p>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="service_price_block">

                    <?php

                        if(isset($business_price_ages) && count($business_price_ages) > 0) { ?>

                            <input type="hidden"  name="recurring_count" id="recurring_count" value="{{count($business_price_ages) - 1}}" />

                        <?php }else{ ?>

                            <input type="hidden"  name="recurring_count" id="recurring_count" value="0" />

                        <?php } 

                        if(isset($business_price_ages) && count($business_price_ages) > 0) {

                            $i=0;

                            foreach($business_price_ages as $priceagedata){

                        ?>    

                            <div id="pricediv{{$i}}">

                                @if($i != 0)

                                    <div class="row">

                                        <hr style="border: 1px solid #d4cfcf;width: 100%;">

                                        <div class="col-md-11"></div><div class="col-md-1"><i class="remove-category-price fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove activity"></i></div>

                                    </div>

                                @endif

                                <?php

                                    $business_price_details =  BusinessPriceDetails::where('category_id',$priceagedata['id'])->where('cid', $priceagedata['cid'])->where('serviceid', $priceagedata['serviceid'])->get(); ?>

                                    @if(count($business_price_details) > 0) 

                                        @php $acnt = count($business_price_details) - 1 ; @endphp

                                        <input type="hidden"  name="ages_count{{$i}}" id="ages_count{{$i}}" value="{{$acnt}}" />

                                    @else

                                        <input type="hidden"  name="ages_count{{$i}}" id="ages_count{{$i}}" value="0" />

                                    @endif



                                    <div id="agesmaindiv{{$i}}">

                                        <?php $j=0;

                                            if(isset($business_price_details) && count($business_price_details) > 0) {/*print_r($business_price_details);*/
                                                $j=0;
                                                foreach($business_price_details as $price){ 
                                                    $pay_chk = $pay_session_type = $pay_session = $pay_price = $pay_discountcat = $pay_discounttype = $pay_discount = $pay_estearn = $pay_setnum = $pay_setduration = $pay_after = $recurring_duration =  $recurring_every  = $recurring_price = $membership_type = $category_title = $dues_tax = $sales_tax = $price_title = $recurring_run_auto_pay_adult  = 

                                                    $is_recurring_adult =

                                                    $recurring_cust_be_charge_adult = $recurring_every_time_num_adult = $recurring_every_time_adult = $recurring_customer_chage_by_adult =$recurring_nuberofautopays_adult = $recurring_happens_aftr_12_pmt_adult = $recurring_client_be_charge_on_adult = "";

                                                    $recurring_first_pmt_adult = $recurring_recurring_pmt_adult = $recurring_total_contract_revenue_adult = 0 ;

                                                      $is_recurring_infant =$recurring_run_auto_pay_infant  = $recurring_cust_be_charge_infant = $recurring_every_time_num_infant = $recurring_every_time_infant = $recurring_customer_chage_by_infant = $recurring_nuberofautopays_infant = $recurring_happens_aftr_12_pmt_infant = $recurring_client_be_charge_on_infant = "";

                                                       $recurring_first_pmt_infant = $recurring_recurring_pmt_infant = $recurring_total_contract_revenue_infant = 0 ;

                                                      $is_recurring_child = $recurring_run_auto_pay_child  = $recurring_cust_be_charge_child = $recurring_every_time_num_child = $recurring_every_time_child = $recurring_customer_chage_by_child =$recurring_nuberofautopays_child = $recurring_happens_aftr_12_pmt_child = $recurring_client_be_charge_on_child = ""; 

                                                    $recurring_first_pmt_child = $recurring_recurring_pmt_child = $recurring_total_contract_revenue_child = 0 ;
                                                $editmodeltextadult = $editmodeltextchild =  $editmodeltextinfant ="";
                                                   /* print_r($price);*/

                                                    if(isset($price['pay_chk']) && !empty($price['pay_chk'])) {

                                                        $pay_chk = $price['pay_chk'];

                                                    }

                                                    if(isset($price['pay_session_type']) && !empty($price['pay_session_type'])) {

                                                        $pay_session_type = $price['pay_session_type'];

                                                    }

                                                    if(isset($price['pay_session']) && !empty($price['pay_session'])) {

                                                        $pay_session = $price['pay_session'];

                                                    }

                                                    if(isset($price['pay_price']) && !empty($price['pay_price'])) {

                                                        $pay_price = $price['pay_price'];

                                                    }

                                                    if(isset($price['category_title']) && !empty($price['category_title'])) {

                                                        $category_title = $price['category_title'];

                                                    }

                                                    if(isset($price['price_title']) && !empty($price['price_title'])) {

                                                        $price_title = $price['price_title'];

                                                    }

                                                    if(isset($price['pay_discountcat']) && !empty($price['pay_discountcat'])) {

                                                        $pay_discountcat = $price['pay_discountcat'];

                                                    }

                                                    if(isset($price['pay_discounttype']) && !empty($price['pay_discounttype'])) {

                                                        $pay_discounttype = $price['pay_discounttype'];

                                                    }

                                                    if(isset($price['pay_discount']) && !empty($price['pay_discount'])) {

                                                        $pay_discount = $price['pay_discount'];

                                                    }

                                                    if(isset($price['pay_estearn']) && !empty($price['pay_estearn'])) {

                                                        $pay_estearn = $price['pay_estearn'];

                                                    }

                                                    if(isset($price['pay_setnum']) && !empty($price['pay_setnum'])) {

                                                        $pay_setnum = $price['pay_setnum'];

                                                    }

                                                    if(isset($price['pay_setduration']) && !empty($price['pay_setduration'])) {

                                                        $pay_setduration = $price['pay_setduration'];

                                                    }

                                                    if(isset($price['pay_after']) && !empty($price['pay_after'])) {

                                                        $pay_after = $price['pay_after'];

                                                    }

                                                    if(isset($price['is_recurring_child']) && !empty($price['is_recurring'])) {

                                                        $is_recurring_child = $price['is_recurring_child'];

                                                    }

                                                    if(isset($price['recurring_price_child']) && !empty($price['recurring_price_child'])) {

                                                        $recurring_price_child = $price['recurring_price'];

                                                    }

                                                    if(isset($price['recurring_run_auto_pay_child']) && !empty($price['recurring_run_auto_pay_child'])) {

                                                        $recurring_run_auto_pay_child = $price['recurring_run_auto_pay_child'];

                                                    }

                                                    if(isset($price['recurring_cust_be_charge_child']) && !empty($price['recurring_cust_be_charge_child'])) {

                                                        $recurring_cust_be_charge_child = $price['recurring_cust_be_charge_child'];

                                                    }

                                                    if(isset($price['recurring_every_time_num_child']) && !empty($price['recurring_every_time_num_child'])) {

                                                        $recurring_every_time_num_child = $price['recurring_every_time_num_child'];

                                                    }

                                                    if(isset($price['recurring_every_time_child']) && !empty($price['recurring_every_time_child'])) {

                                                        $recurring_every_time_child = $price['recurring_every_time_child'];
                                                    }

                                                    if(isset($price['recurring_customer_chage_by_child']) && !empty($price['recurring_customer_chage_by_child'])) {
                                                        $recurring_customer_chage_by_child = $price['recurring_customer_chage_by_child'];
                                                    }

                                                    if(isset($price['recurring_nuberofautopays_child']) && !empty($price['recurring_nuberofautopays_child'])) {
                                                        $recurring_nuberofautopays_child = $price['recurring_nuberofautopays_child'];
                                                        $editmodeltextchild  .= 
                                                        '( '.$recurring_nuberofautopays_child.' Months contract ';
                                                    }

                                                    if(isset($price['recurring_happens_aftr_12_pmt_child']) && !empty($price['recurring_happens_aftr_12_pmt_child'])) {

                                                        $recurring_happens_aftr_12_pmt_child = $price['recurring_happens_aftr_12_pmt_child'];

                                                    }

                                                    if(isset($price['recurring_client_be_charge_on_child']) && !empty($price['recurring_client_be_charge_on_child'])) {

                                                        $recurring_client_be_charge_on_child = $price['recurring_client_be_charge_on_child'];

                                                    }

                                                    if(isset($price['recurring_first_pmt_child']) && !empty($price['recurring_first_pmt_child'])) {
                                                        $recurring_first_pmt_child = $price['recurring_first_pmt_child'];
                                                        $months = 0;
                                                        if( $recurring_nuberofautopays_child  != ''){
                                                            $months=$recurring_nuberofautopays_child;
                                                        }
                                                        $editmodeltextchild  .=  '| $'.$recurring_first_pmt_child.' A Month for '.$months.' Months ';
                                                    } 

                                                    if(isset($price['recurring_recurring_pmt_child']) && !empty($price['recurring_recurring_pmt_child'])) {
                                                        $recurring_recurring_pmt_child = $price['recurring_recurring_pmt_child'];
                                                    } 

                                                    if(isset($price['recurring_total_contract_revenue_child']) && !empty($price['recurring_total_contract_revenue_child'])) {

                                                        $recurring_total_contract_revenue_child = $price['recurring_total_contract_revenue_child'];
                                                        $editmodeltextchild  .= '| Totalling $'.$recurring_total_contract_revenue_child;

                                                    }if(isset($price['is_recurring_infant']) && !empty($price['is_recurring_infant'])) {
                                                        $is_recurring_infant = $price['is_recurring_infant'];
                                                    }

                                                    if(isset($price['recurring_price_infant']) && !empty($price['recurring_price_infant'])) {
                                                        $recurring_price_infant = $price['recurring_price_infant'];
                                                    }

                                                    if(isset($price['recurring_run_auto_pay_infant']) && !empty($price['recurring_run_auto_pay_infant'])) {
                                                        $recurring_run_auto_pay_infant = $price['recurring_run_auto_pay_infant'];
                                                    }

                                                    if(isset($price['recurring_cust_be_charge_infant']) && !empty($price['recurring_cust_be_charge_infant'])) {
                                                        $recurring_cust_be_charge_infant = $price['recurring_cust_be_charge_infant'];
                                                    }

                                                    if(isset($price['recurring_every_time_num_infant']) && !empty($price['recurring_every_time_num_infant'])) {
                                                        $recurring_every_time_num_infant = $price['recurring_every_time_num_infant'];
                                                    }

                                                    if(isset($price['recurring_every_time_infant']) && !empty($price['recurring_every_time_infant'])) {
                                                        $recurring_every_time_infant = $price['recurring_every_time_infant'];
                                                    }

                                                    if(isset($price['recurring_customer_chage_by_infant']) && !empty($price['recurring_customer_chage_by_infant'])) {
                                                        $recurring_customer_chage_by_infant = $price['recurring_customer_chage_by_infant'];
                                                    }

                                                    if(isset($price['recurring_nuberofautopays_infant']) && !empty($price['recurring_nuberofautopays_infant'])) {
                                                        $recurring_nuberofautopays_infant = $price['recurring_nuberofautopays_infant'];
                                                        $editmodeltextinfant  .= 
                                                        '( '.$recurring_nuberofautopays_infant.' Months contract ';
                                                    }

                                                    if(isset($price['recurring_happens_aftr_12_pmt_infant']) && !empty($price['recurring_happens_aftr_12_pmt_infant'])) {
                                                        $recurring_happens_aftr_12_pmt_infant = $price['recurring_happens_aftr_12_pmt_infant'];
                                                    }

                                                    if(isset($price['recurring_client_be_charge_on_infant']) && !empty($price['recurring_client_be_charge_on_infant'])) {
                                                        $recurring_client_be_charge_on_infant = $price['recurring_client_be_charge_on_infant'];
                                                    }

                                                    if(isset($price['recurring_first_pmt_infant']) && !empty($price['recurring_first_pmt_infant'])) {
                                                        $recurring_first_pmt_infant = $price['recurring_first_pmt_infant'];
                                                        $months = 0;
                                                        if( $recurring_nuberofautopays_infant  != ''){
                                                            $months=$recurring_nuberofautopays_infant;
                                                        }
                                                        $editmodeltextinfant  .=  '| $'.$recurring_first_pmt_infant.' A Month for '.$months.' Months ';
                                                    } 

                                                    if(isset($price['recurring_recurring_pmt_infant']) && !empty($price['recurring_recurring_pmt_infant'])) {
                                                        $recurring_recurring_pmt_infant = $price['recurring_recurring_pmt_infant'];
                                                    } 

                                                    if(isset($price['recurring_total_contract_revenue_infant']) && !empty($price['recurring_total_contract_revenue_infant'])) {
                                                        $recurring_total_contract_revenue_infant = $price['recurring_total_contract_revenue_infant'];
                                                        $editmodeltextinfant  .= '| Totalling $'.$recurring_total_contract_revenue_infant;
                                                    }

                                                    if(isset($price['is_recurring_adult']) && !empty($price['is_recurring_adult'])) {
                                                        $is_recurring_adult = $price['is_recurring_adult'];
                                                    }

                                                    if(isset($price['recurring_price_adult']) && !empty($price['recurring_price_adult'])) {
                                                        $recurring_price_adult = $price['recurring_price_adult'];
                                                    }

                                                    if(isset($price['recurring_run_auto_pay_adult']) && !empty($price['recurring_run_auto_pay_adult'])) {
                                                        $recurring_run_auto_pay_adult = $price['recurring_run_auto_pay_adult'];
                                                    }

                                                    if(isset($price['recurring_cust_be_charge_adult']) && !empty($price['recurring_cust_be_charge_adult'])) {
                                                        $recurring_cust_be_charge_adult = $price['recurring_cust_be_charge_adult'];
                                                    }

                                                    if(isset($price['recurring_every_time_num_adult']) && !empty($price['recurring_every_time_num_adult'])) {
                                                        $recurring_every_time_num_adult = $price['recurring_every_time_num_adult'];
                                                    }

                                                    if(isset($price['recurring_every_time_adult']) && !empty($price['recurring_every_time_adult'])) {
                                                        $recurring_every_time_adult = $price['recurring_every_time_adult'];
                                                    }

                                                    if(isset($price['recurring_customer_chage_by_adult']) && !empty($price['recurring_customer_chage_by_adult'])) {
                                                        $recurring_customer_chage_by_adult = $price['recurring_customer_chage_by_adult'];
                                                    }

                                                    if(isset($price['recurring_nuberofautopays_adult']) && !empty($price['recurring_nuberofautopays_adult'])) {
                                                        $recurring_nuberofautopays_adult = $price['recurring_nuberofautopays_adult'];
                                                        $editmodeltextadult  .= 
                                                        '( '.$recurring_nuberofautopays_adult.' Months contract ';
                                                    }

                                                    if(isset($price['recurring_happens_aftr_12_pmt_adult']) && !empty($price['recurring_happens_aftr_12_pmt_adult'])) {
                                                        $recurring_happens_aftr_12_pmt_adult = $price['recurring_happens_aftr_12_pmt_adult'];
                                                    }

                                                    if(isset($price['recurring_client_be_charge_on_adult']) && !empty($price['recurring_client_be_charge_on_adult'])) {
                                                        $recurring_client_be_charge_on_adult = $price['recurring_client_be_charge_on_adult'];
                                                    }

                                                    if(isset($price['recurring_first_pmt_adult']) && !empty($price['recurring_first_pmt_adult'])) {
                                                        $recurring_first_pmt_adult = $price['recurring_first_pmt_adult'];
                                                        $months = 0;
                                                        if( $recurring_nuberofautopays_adult  != ''){
                                                            $months=$recurring_nuberofautopays_adult;
                                                        }
                                                        $editmodeltextadult  .=  '| $'.$recurring_first_pmt_adult.' A Month for '.$months.' Months ';
                                                    } 

                                                    if(isset($price['recurring_recurring_pmt_adult']) && !empty($price['recurring_recurring_pmt_adult'])) {

                                                        $recurring_recurring_pmt_adult = $price['recurring_recurring_pmt_adult'];

                                                    } 

                                                    if(isset($price['recurring_total_contract_revenue_adult']) && !empty($price['recurring_total_contract_revenue_adult'])) {

                                                        $recurring_total_contract_revenue_adult = $price['recurring_total_contract_revenue_adult'];
                                                        $editmodeltextadult  .= '| Totalling $'.$recurring_total_contract_revenue_adult;
                                                    }

                                                    /*if(isset($price['recurring_every']) && !empty($price['recurring_every'])) {

                                                        $recurring_every = $price['recurring_every'];

                                                    }

                                                    if(isset($price['recurring_duration']) && !empty($price['recurring_duration'])) {

                                                        $recurring_duration = $price['recurring_duration'];

                                                    }*/

                                                    if(isset($price['membership_type']) && !empty($price['membership_type'])) {
                                                        $membership_type = $price['membership_type'];
                                                    }                
                                        ?>

                                        <input type="hidden" name="fitnessity_fee" value="{{$fitnessity_fee}}">

                                        <div id="agesdiv{{$i}}{{$j}}">
                                            @if($j != 0)
                                                <div class="row">
                                                    <hr style="border: 1px solid #d4cfcf;width: 100%;">
                                                    <div class="col-md-11"></div><div class="col-md-1"><i class="remove-agediv fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove activity" onclick="remove_agediv({{$i}},{{$j}});"></i></div>
                                                </div>
                                            @endif

                                            <div class="row">
                                                <div class="col-md-12">
                                                    @if($j == 0)
                                                    <div class="priceselect sp-select">
                                                        <input type="hidden" name="cat_id_db[]" id="cat_id_db" value="{{$priceagedata['id']}}">
                                                        <label>Category Title (Give a name for this category)</label>
                                                        <p>*Note: This name will be displayed on your booking schedule for customer to see. </p>
                                                           
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <input type="text" name="category_title[]" id="category_title"  class="inputs" value="{{$priceagedata['category_title']}}" placeholder="Ex: Kids Martial Arts (5 to 7 yrs Old)">
                                                            </div>

                                                            <div class="col-md-3">
                                                                <input type="text" name="sales_tax[]" id="sales_tax"  class="inputs toolwidth" value="{{$priceagedata['sales_tax']}}" placeholder="Sales Tax">
                                                                <label> %  <i class="fas fa-question-circle info-tooltip" id="tooltipex" data-placement="top" title="Typically used when charging for apparel, products, rentals, equipment, food, or snacks."></i></label>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <input type="text" name="dues_tax[]" id="dues_tax"  class="inputs toolwidth" value="{{$priceagedata['dues_tax']}}" placeholder="Dues Tax">
                                                                <label> %  <i class="fas fa-question-circle info-tooltip" id="tooltipex" data-placement="top" title="Typically used for all membership type fees."></i></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                                <!-- <div class="col-md-6">
                                                    @if($j == 0)
                                                    <div class="sp-select-sche">
                                                         <p><a onclick="setschedule();">+Set Your Schedule</a>(Schedule the times this activity will happen)</p> 
                                                    </div>
                                                    @endif
                                                </div> -->
                                            </div>

                                            <input type="hidden" name="price_id_db_{{$i}}{{$j}}" id="price_id_db{{$i}}{{$j}}" value="{{$price['id']}}" />
                                            <div class="row mt-30">

                                                <div class="col-md-3 col-sm-6">

                                                    <div class="priceselect sp-select">

                                                        <label>Price Title</label>

                                                        <input type="text" name="price_title_{{$i}}{{$j}}" id="price_title{{$i}}{{$j}}"  class="inputs" placeholder="Ex: 6 month Membership" value="{{$price_title}}" oninput="getpricetitle({{$i}},{{$j}})">

                                                    </div>

                                                </div>

                                                <div class="col-md-3 col-sm-6">

                                                    <div class="priceselect sp-select">

                                                        <label>Session Type</label>

                                                        <select name="pay_session_type_{{$i}}{{$j}}" id="pay_session_type{{$i}}{{$j}}" class="bd-right bd-bottom pay_session_type" onchange="pay_session_select({{$i}},{{$j}},this.value);">

                                                            <option <?=($pay_session_type=='Single')?'selected':'' ?>>Single</option>

                                                            <option <?=($pay_session_type=='Multiple')?'selected':'' ?>>Multiple</option>

                                                            <option <?=($pay_session_type=='Unlimited')?'selected':'' ?>>Unlimited</option>

                                                        </select>

                                                    </div>

                                                </div>



                                                <div class="col-md-3 col-sm-6">

                                                    <div class="priceselect sp-select">

                                                        <label>Number of Sessions</label>

                                                        <input type="text" name="pay_session_{{$i}}{{$j}}" id="pay_session{{$i}}{{$j}}"  class="inputs pay_session" placeholder="1" value="{{$pay_session}}">

                                                    </div>

                                                </div>



                                                <div class="col-md-3 col-sm-6">

                                                    <div class="priceselect sp-select">

                                                        <label>Membership Type</label>

                                                        <select name="membership_type_{{$i}}{{$j}}" id="membership_type{{$i}}{{$j}}" class="bd-right bd-bottom membership_type">

                                                            <option @if($membership_type=="Drop In") selected="selected" @endif value="Drop In">Drop In</option>

                                                            <option @if($membership_type=="Semester") selected="selected" @endif value="Semester">Semester (Long Term)</option>

                                                        </select>

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="setprice sp-select">
                                                        <div class="row">
                                                            <div class="col-md-12">

                                                                <input type="radio" id="freeprice{{$i}}{{$j}}" name="sectiondisplay{{$i}}{{$j}}" onclick="showdiv({{$i}},{{$j}});" value="freeprice">
                                                                <label class="recurring-pmt">Free</label>
                                                                
                                                                <input type="radio" id="weekdayprice{{$i}}{{$j}}" name="sectiondisplay{{$i}}{{$j}}" onclick="showdiv({{$i}},{{$j}});"  checked value="weekdayprice">
                                                                <label class="recurring-pmt">Everyday Price</label>
                                                                
                                                                <input type="radio" id="weekendprice{{$i}}{{$j}}" name="sectiondisplay{{$i}}{{$j}}" onclick="showdiv({{$i}},{{$j}});" value="weekendprice">
                                                                <label class="recurring-pmt">Weekend Price</label>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="displaysectiondiv{{$i}}{{$j}}">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="setprice sp-select">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label id="showlessmore{{$i}}{{$j}}" onclick="showlessmore({{$i}},{{$j}});">Show Less</label>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <h3 class="setprice-custom">You can set your prices to be the same or different based on age, the weekday or the weekend.To add prices for children or infants, click on the box.</h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                            
                                                <div class="row">

                                                    <div class="age-cat">

                                                        <div class="cat-age sp-select">

                                                            <label>Adults</label>

                                                            <p>Ages 12 & Older</p>

                                                        </div>

                                                    </div>

                                                    <div class="weekly-customer">

                                                        <div class="cus-week-price sp-select">

                                                            <label>Weekday Price</label>

                                                            <p> (Monday - Sunday)</p>

                                                            <input type="text" name="adult_cus_weekly_price_{{$i}}{{$j}}" id="adult_cus_weekly_price{{$i}}{{$j}}" placeholder="$" onkeyup="adultchangeestprice({{$i}},{{$j}});" value="{{$price['adult_cus_weekly_price']}}">

                                                        </div>

                                                    </div>

                                                    <div class="weekend-price Weekend{{$i}}{{$j}}" style="display: none;">

                                                        <div class="cus-week-price sp-select">

                                                            <label>Weekend Price </label>

                                                            <p> (Saturday & Sunday)</p>

                                                            <input type="text" name="adult_weekend_price_diff_{{$i}}{{$j}}" id="adult_weekend_price_diff{{$i}}{{$j}}" placeholder="$"  value="{{$price['adult_weekend_price_diff']}}" onkeyup="weekendadultchangeestprice({{$i}},{{$j}});">

                                                        </div>

                                                    </div>

                                                    <div class="re-discount">

                                                        <div class="discount sp-select">

                                                            <label>Any Discount? </label>

                                                            <p> (Recommended 10% to 15%)</p>

                                                            <input type="text" name="adult_discount_{{$i}}{{$j}}" id="adult_discount{{$i}}{{$j}}" onkeyup="adultdischangeestprice({{$i}},{{$j}});" value="{{$price['adult_discount']}}" >

                                                        </div>

                                                    </div>

                                                    <div class="single-dash">

                                                        <div class="desh sp-select">

                                                            <label>-</label>

                                                        </div>

                                                    </div>

                                                    <div class="fit-fees">

                                                        <div class="fees sp-select">

                                                            <label>Introduction Fee </label>

                                                            <label>Recurring Fee </label>

                                                            <p> 5%</p>
                                                            <p> 1%</p>

                                                        </div>

                                                    </div>

                                                    <div class="single-equal">

                                                        <div class="equal sp-select">

                                                            <label>=</label>

                                                        </div>

                                                    </div>

                                                    <div class="estimated-earn">

                                                        <div class="cus-week-price earn sp-select">

                                                            <label>Weekday Estimated Earnings </label>

                                                            <input type="text" name="adult_estearn_{{$i}}{{$j}}" id="adult_estearn{{$i}}{{$j}}" placeholder="$" value="{{$price['adult_estearn']}}">

                                                        </div>

                                                    </div>

                                                    <div class="estimated-earn Weekend{{$i}}{{$j}}">

                                                        <div class="cus-week-price earn sp-select">

                                                            <label>Weekend Estimated Earnings </label>

                                                            <input type="text" name="weekend_adult_estearn_{{$i}}{{$j}}" id="weekend_adult_estearn{{$i}}{{$j}}" placeholder="$" value="{{$price['weekend_adult_estearn']}}">

                                                        </div>

                                                    </div>

                                                    <div class="col-md-12">

                                                        <div class="priceselect sp-select modelmargin">

                                                            <input class="modelcheckbox"  data-count="0"  type="checkbox" id="is_recurring_adult{{$i}}{{$j}}" name="is_recurring_adult_{{$i}}{{$j}}" @if($price['is_recurring_adult'] == '1') Checked value="1" @else value="0"  @endif onclick="openmodelbox({{$i}},{{$j}},'adult');" >

                                                            <p class="recurring-pmt">Is This A Recurring Payment? Set the monthly payment terms for Adults @if($editmodeltextadult != '') {{$editmodeltextadult}} <button type="button" data-toggle="modal" data-target="#ModelRecurring_adult{{$i}}{{$j}}" class="modelbox-edit-link" >Edit</button> )@endif</p>

                                                            <button style="display:none" id="btn_recurring_adult{{$i}}{{$j}}" name="btn_recurring_adult_{{$i}}{{$j}}[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring_adult{{$i}}{{$j}}" onclick="recurrint_id({{$i}},{{$j}},'adult');">Launch demo modal</button>

                                                        </div>

                                                    </div>
                                                </div>
                                                <div id="showmorehide{{$i}}{{$j}}" @if($price['child_estearn'] == '' && $price['infant_estearn'] == '') style="display:none;" @endif>
                                                <div class="row">

                                                    <div class="age-cat">

                                                        <div class="cat-age sp-select">

                                                            <label>Children</label>

                                                            <p>Ages 2 to 12</p>

                                                        </div>

                                                    </div>

                                                    <div class="weekly-customer">

                                                        <div class="cus-week-price sp-select">

                                                            <label>Weekday Price</label>

                                                            <p> (Monday - Sunday)</p>

                                                            <input type="text" name="child_cus_weekly_price_{{$i}}{{$j}}" id="child_cus_weekly_price{{$i}}{{$j}}" placeholder="$"  onkeyup="childchangeestprice({{$i}},{{$j}});" value="{{$price['child_cus_weekly_price']}}">

                                                        </div>

                                                    </div>

                                                    <div class="weekend-price Weekend{{$i}}{{$j}}" style="display: none;">

                                                        <div class="cus-week-price sp-select">

                                                            <label>Weekend Price</label>

                                                            <p> (Saturday & Sunday)</p>

                                                            <input type="text" name="child_weekend_price_diff_{{$i}}{{$j}}" id="child_weekend_price_diff{{$i}}{{$j}}" placeholder="$" value="{{$price['child_weekend_price_diff']}}" onkeyup="weekendchildchangeestprice({{$i}},{{$j}});" >

                                                        </div>

                                                    </div>

                                                    <div class="re-discount">

                                                        <div class="discount sp-select">

                                                            <label>Any Discount?</label>

                                                            <p> (Recommended 10% to 15%)</p>

                                                            <input type="text" name="child_discount_{{$i}}{{$j}}" id="child_discount{{$i}}{{$j}}" onkeyup="childdischangeestprice({{$i}},{{$j}});" value="{{$price['child_discount']}}">

                                                        </div>

                                                    </div>

                                                    <div class="single-dash">

                                                        <div class="desh sp-select">

                                                            <label>-</label>

                                                        </div>

                                                    </div>

                                                    <div class="fit-fees">

                                                        <div class="fees sp-select">

                                                            <label>Introduction Fee </label>
                                                            <label>Recurring Fee </label>
                                                            <p> 5%</p>
                                                            <p> 1%</p>

                                                        </div>

                                                    </div>

                                                    <div class="single-equal">

                                                        <div class="equal sp-select">

                                                            <label>=</label>

                                                        </div>

                                                    </div>

                                                    <div class="estimated-earn">

                                                        <div class="cus-week-price earn sp-select">

                                                            <label>Weekday Estimated Earnings</label>

                                                            <input type="text" name="child_estearn_{{$i}}{{$j}}" id="child_estearn{{$i}}{{$j}}" placeholder="$" value="{{$price['child_estearn']}}">

                                                        </div>

                                                    </div>

                                                    <div class="estimated-earn Weekend{{$i}}{{$j}}">

                                                        <div class="cus-week-price earn sp-select">

                                                            <label>Weekend Estimated Earnings</label>

                                                            <input type="text" name="weekend_child_estearn_{{$i}}{{$j}}" id="weekend_child_estearn{{$i}}{{$j}}" placeholder="$" value="{{$price['weekend_child_estearn']}}">

                                                        </div>

                                                    </div>

                                                    <div class="col-md-12">

                                                        <div class="priceselect sp-select modelmargin">

                                                            <input class="modelcheckbox"  data-count="0"  type="checkbox" id="is_recurring_child{{$i}}{{$j}}" name="is_recurring_child_{{$i}}{{$j}}" @if($price['is_recurring_child'] == '1') Checked value="1" @else value="0"  @endif onclick="openmodelbox({{$i}},{{$j}},'child');" >

                                                            <p class="recurring-pmt">Is This A Recurring Payment? Set the monthly payment terms for Children @if($editmodeltextchild != '') {{$editmodeltextchild}} <button type="button" data-toggle="modal" data-target="#ModelRecurring_child{{$i}}{{$j}}" class="modelbox-edit-link">Edit</button> )@endif</p>

                                                            <button style="display:none" id="btn_recurring_child{{$i}}{{$j}}" name="btn_recurring_child_{{$i}}{{$j}}[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring_child{{$i}}{{$j}}" onclick="recurrint_id({{$i}},{{$j}},'child');">Launch demo modal</button>

                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="age-cat">

                                                        <div class="cat-age sp-select">

                                                            <label>Infants</label>

                                                            <p>Ages 2 & Under</p>

                                                        </div>

                                                    </div>

                                                    <div class="weekly-customer">

                                                        <div class="cus-week-price sp-select">

                                                            <label>Weekday Price</label>

                                                            <p> (Monday - Sunday)</p>

                                                            <input type="text" name="infant_cus_weekly_price_{{$i}}{{$j}}" id="infant_cus_weekly_price{{$i}}{{$j}}" placeholder="$" onkeyup="infantchangeestprice({{$i}},{{$j}});" value="{{$price['infant_cus_weekly_price']}}">

                                                        </div>

                                                    </div>

                                                    <div class="weekend-price Weekend{{$i}}{{$j}}" style="display: none;">

                                                        <div class="cus-week-price sp-select">

                                                            <label>Weekend Price</label>

                                                            <p> (Saturday & Sunday)</p>

                                                            <input type="text" name="infant_weekend_price_diff_{{$i}}{{$j}}" id="infant_weekend_price_diff{{$i}}{{$j}}" placeholder="$" value="{{$price['infant_weekend_price_diff']}}" onkeyup="weekendinfantchangeestprice({{$i}},{{$j}});" value="{{$price['infant_cus_weekly_price']}}">

                                                        </div>

                                                    </div>

                                                    <div class="re-discount">

                                                        <div class="discount sp-select">

                                                            <label>Any Discount?</label>

                                                            <p> (Recommended 10% to 15%)</p>

                                                            <input type="text" name="infant_discount_{{$i}}{{$j}}" id="infant_discount{{$i}}{{$j}}" onkeyup="infantdischangeestprice({{$i}},{{$j}});" value="{{$price['infant_discount']}}"> 

                                                        </div>

                                                    </div>

                                                    <div class="single-dash">

                                                        <div class="desh sp-select">

                                                            <label>-</label>

                                                        </div>

                                                    </div>

                                                    <div class="fit-fees">

                                                        <div class="fees sp-select">

                                                            <label>Introduction Fee </label>
                                                            <label>Recurring Fee </label>
                                                            <p> 5%</p>
                                                            <p> 1%</p>

                                                        </div>

                                                    </div>

                                                    <div class="single-equal">

                                                        <div class="equal sp-select">

                                                            <label>=</label>

                                                        </div>

                                                    </div>

                                                    <div class="estimated-earn">

                                                        <div class="cus-week-price earn sp-select">

                                                            <label>Weekday Estimated Earnings</label>

                                                            <input type="text" name="infant_estearn_{{$i}}{{$j}}" id="infant_estearn{{$i}}{{$j}}" placeholder="$" value="{{$price['infant_estearn']}}">

                                                        </div>

                                                    </div>

                                                    <div class="estimated-earn Weekend{{$i}}{{$j}}">

                                                        <div class="cus-week-price earn sp-select">

                                                            <label>Weekend Estimated Earnings</label>

                                                            <input type="text" name="weekend_infant_estearn_{{$i}}{{$j}}" id="weekend_infant_estearn{{$i}}{{$j}}" placeholder="$" value="{{$price['weekend_infant_estearn']}}">

                                                        </div>

                                                    </div>

                                                    <div class="col-md-12">

                                                        <div class="priceselect sp-select modelmargin">

                                                            <input class="modelcheckbox"  data-count="0"  type="checkbox" id="is_recurring_infant{{$i}}{{$j}}" name="is_recurring_infant_{{$i}}{{$j}}" @if($price['is_recurring_infant'] == '1') Checked value="1" @else value="0"  @endif onclick="openmodelbox({{$i}},{{$j}},'infant');" >

                                                             <p class="recurring-pmt">Is This A Recurring Payment? Set the monthly payment terms for Infants @if($editmodeltextinfant != '') {{$editmodeltextinfant}} <button type="button" data-toggle="modal" data-target="#ModelRecurring_infant{{$i}}{{$j}}" class="modelbox-edit-link">Edit</button> )@endif</p>

                                                            <button style="display:none" id="btn_recurring_infant{{$i}}{{$j}}" name="btn_recurring_infant_{{$i}}{{$j}}[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring_infant{{$i}}{{$j}}" onclick="recurrint_id({{$i}},{{$j}},'infant');">Launch demo modal</button>

                                                        </div>

                                                    </div>
                                                </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="serviceprice sp-select">
                                                        <h3>When Does This Price Setting Expire</h3>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="set-num">
                                                        <label>Set The Number</label>
                                                        <input type="text" name="pay_setnum_{{$i}}{{$j}}" id="pay_setnum{{$i}}{{$j}}" class="form-control valid" placeholder="(ex,1,2,3,etc.)" value="{{$pay_setnum}}" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="set-num">
                                                        <label>The Duration</label>
                                                        <select name="pay_setduration_{{$i}}{{$j}}" id="pay_setduration{{$i}}{{$j}}" class="form-control valid">
                                                            <option value="">Select Value</option>
                                                            <option <?=($pay_setduration=='Days')?'selected':'' ?>>Days</option>
                                                            <option <?=($pay_setduration=='Months')?'selected':'' ?>>Months</option>
                                                            <option <?=($pay_setduration=='Years')?'selected':'' ?>>Years</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-1 col-xs-12">

                                                    <div class="set-num after">

                                                        <label>After</label>

                                                    </div>

                                                </div>

                                                <div class="col-md-5 col-xs-12">

                                                    <div class="after-select">

                                                        <select name="pay_after_{{$i}}{{$j}}" id="pay_after{{$i}}{{$j}}" class="pay_after form-control valid">

                                                            <option value="">Select Value</option>

                                                            <option value="1" <?=($pay_after=='1')?'selected':'' ?>>Starts to expire the day of purchase</option>

                                                            <option value="2" <?=($pay_after=='2')?'selected':'' ?>>Starts to expire when the customer first participates in the activity</option>

                                                        </select>

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="modal fade ModelRecurring_adult{{$i}}{{$j}}" id="ModelRecurring_adult{{$i}}{{$j}}" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true">
                                                <div class="modal-dialog editingautopay" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                           <!--  <form  method="POST" role="form" enctype="multipart/form-data" id="adultformsumbit{{$i}}{{$j}}">
                                                            @csrf -->
                                                                <input type="hidden" name="priceid_{{$i}}{{$j}}" value="{{$price->id}}" > 
                                                                <input type="hidden" name="i" value="{{$i}}" >
                                                                <input type="hidden" name="j" value="{{$j}}" >
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="editingautopay">
                                                                            <h5 class="modal-title" id="ModelRecurringTitle_adult{{$i}}{{$j}}">Editing Recurring Payments Contract Settings for ({{$price_title}} for "Adults")</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-8">
                                                                        <div class="Settings-title">
                                                                            <h5> Settings </h5>
                                                                        </div>
                                                                        <div class="setting-box">
                                                                            <!-- <div class="row set-78">
                                                                                <div class="col-md-4">
                                                                                    <label class="contractsettings">Run Auto Pay</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <div class="autopay">
                                                                                        <input type="radio" id="run_auto_pay_adult{{$i}}{{$j}}" name="run_auto_pay_adult_{{$i}}{{$j}}" value="on_set_schedule"  @if($recurring_run_auto_pay_adult == 'on_set_schedule') checked @endif>
                                                                                        <label for="on_set_schedule">On a set schedule (recommended)</label><br>
                                                                                        <input type="radio" id="run_auto_pay_adult{{$i}}{{$j}}" name="run_auto_pay_adult_{{$i}}{{$j}}" value="price_opt_run_out" @if($recurring_run_auto_pay_adult == 'price_opt_run_out') checked @endif>
                                                                                        <label for="price_opt_run_out">When price option runs out   </label><br> 
                                                                                    </div>
                                                                                </div>
                                                                            </div> -->
                                                                            <div class="row set-78">
                                                                                <div class="col-md-4">
                                                                                    <label class="contractsettings">How often will customers be charged?</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <!-- <div class="autopay">
                                                                                        <input type="radio" id="cust_be_charge_adult{{$i}}{{$j}}" name="cust_be_charge_adult_{{$i}}{{$j}}" value="num_of_autopay" @if($recurring_cust_be_charge_adult == 'num_of_autopay') checked @endif>
                                                                                        <label for="Autopays">Set number of autopays</label><br>
                                                                                        <input type="radio" id="cust_be_charge_adult{{$i}}{{$j}}" name="cust_be_charge_adult_{{$i}}{{$j}}" value="month-to-month" @if($recurring_cust_be_charge_adult == 'month-to-month') checked @endif>
                                                                                        <label for="Month">Month - to -Month    </label><br> 
                                                                                    </div>
                                                                                    <div class="customerscharged">
                                                                                        <label> Every </label>
                                                                                        <input type="text" class="form-control valid" name="every_time_num_adult_{{$i}}{{$j}}" id="every_time_num_adult{{$i}}{{$j}}" placeholder="1" value="{{$recurring_every_time_num_adult}}">
                                                                                        <select class="form-control" name="every_time_adult_{{$i}}{{$j}}" id="every_time_adult{{$i}}{{$j}}">
                                                                                            <option value="Weekly" @if($recurring_every_time_adult == 'Weekly') selected @endif>Weekly</option>
                                                                                            <option value="On a specific month" @if($recurring_every_time_adult == 'On a specific month') selected @endif>Month </option>
                                                                                        </select>
                                                                                    </div> -->


                                                                                    <!-- <p>Customers will be charged every month for the duration of the contract</p> -->

                                                                                    <select class="form-control" name="recurring_customer_chage_by_adult_{{$i}}{{$j}}" id="recurring_customer_chage_by_adult{{$i}}{{$j}}">
                                                                                        <option value="1 Week" @if($recurring_customer_chage_by_adult == '1 Week') selected @endif>1 week</option>
                                                                                        <option value="2 Week" @if($recurring_customer_chage_by_adult == '2 Week') selected @endif>2 week</option>
                                                                                        <option value="1 Month" @if($recurring_customer_chage_by_adult == '1 Month') selected @endif>1 Month</option>
                                                                                        <option value="3 Month" @if($recurring_customer_chage_by_adult == '3 Month') selected @endif>3 Month</option>
                                                                                        <option value="6 Month" @if($recurring_customer_chage_by_adult == '6 Month') selected @endif>6 Month</option> 
                                                                                        <option value="1 Year" @if($recurring_customer_chage_by_adult == '1 Year') selected @endif>1 Year</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row set-78">
                                                                                <div class="col-md-4">
                                                                                    <label class="contractsettings">Number of autopays  </label>
                                                                                </div>

                                                                                <div class="col-md-8">
                                                                                    <div class="nuberofautopays">
                                                                                        <input type="text" class="form-control valid" name="nuberofautopays_adult_{{$i}}{{$j}}" id="nuberofautopays_adult{{$i}}{{$j}}" placeholder="12" value="{{$recurring_nuberofautopays_adult}}" oninput="getnumberofpmt({{$i}},{{$j}},'adult');">
                                                                                    </div>
                                                                                    <div class="contract">
                                                                                        <label>  Total duration of contract: </label>
                                                                                        <p id="total_duration_adult{{$i}}{{$j}}">@if($recurring_nuberofautopays_adult == '') 0 @else {{$recurring_nuberofautopays_adult}} @endif months</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row set-78">
                                                                                <div class="col-md-4">
                                                                                    <label class="contractsettings" id="contractsettings_adult{{$i}}{{$j}}">What happens after {{$recurring_nuberofautopays_adult}} payments?</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <div class="autopay">
                                                                                        <input type="radio" id="happens_aftr_12_pmt_adult{{$i}}{{$j}}" name="happens_aftr_12_pmt_adult_{{$i}}{{$j}}" value="contract_expire"@if($recurring_happens_aftr_12_pmt_adult == 'contract_expire') checked @endif>
                                                                                        <label for="contract">Contract Expires</label><br>
                                                                                        <input type="radio" id="happens_aftr_12_pmt_adult{{$i}}{{$j}}" name="happens_aftr_12_pmt_adult_{{$i}}{{$j}}" value="contract_renew" @if($recurring_happens_aftr_12_pmt_adult == 'contract_renew') checked @endif>
                                                                                        <label for="renews" id="renew_adult{{$i}}{{$j}}">Contract Automaitcally Renews Every  {{$recurring_nuberofautopays_adult}} payments</label><br> 
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row set-78">
                                                                                <div class="col-md-4">
                                                                                    <label class="contractsettings">When will clients be charged?</label>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <div class="saledate">
                                                                                        <!-- <input type="hidden" name="client_be_charge_on_adult_{{$i}}{{$j}}" id="client_be_charge_on_adult{{$i}}{{$j}}" value="On the sale date"> -->
                                                                                        <!-- <p>On the sale date </p> -->
                                                                                        <select class="form-control" name="client_be_charge_on_adult_{{$i}}{{$j}}" id="client_be_charge_on_adult{{$i}}{{$j}}">
                                                                                            <option value="sale date" @if($recurring_client_be_charge_on_adult == 'sale date') selected @endif>On the sale date </option> 
                                                                                            <option value="1stday" @if($recurring_client_be_charge_on_adult == '1stday') selected @endif> 1st Day of the Month</option>
                                                                                            <option value="15thday" @if($recurring_client_be_charge_on_adult == '15thday') selected @endif> 15th Day of the Month</option> 
                                                                                        </select> 
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4">
                                                                        <div class="Settings-title">
                                                                            <h5> Contract Review </h5>
                                                                        </div>

                                                                        <div class="setting-box">
                                                                            <div class="set-border">
                                                                                <div class="row">
                                                                                    <div class="col-md-8">
                                                                                        <p id="p_price_title_adult{{$i}}{{$j}}">{{$price_title}}</p>
                                                                                    </div>

                                                                                    <div class="col-md-4">
                                                                                        <p id="p1_price_adult{{$i}}{{$j}}">@if($price['adult_cus_weekly_price'] == '') $0 @else ${{$price['adult_cus_weekly_price']}}@endif</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <div class="Settings-title">
                                                                                        <h5> Revenue Breakdown </h5>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-10">
                                                                                    <p id="trems_payment_adult{{$i}}{{$j}}">Terms: @if($recurring_nuberofautopays_adult == '') 0 @else {{$recurring_nuberofautopays_adult}} @endif Monthly Payments</p>
                                                                                </div>

                                                                                    <div class="col-md-8">
                                                                                    <p>First Payment:</p>
                                                                                </div>

                                                                                <div class="col-md-4">
                                                                                    <p id="p_first_pmt_adult{{$i}}{{$j}}">${{$recurring_first_pmt_adult}}</p>
                                                                                </div>

                                                                                <input type="hidden" name="first_pmt_adult_{{$i}}{{$j}}" id="first_pmt_adult{{$i}}{{$j}}" value="{{$recurring_first_pmt_adult}}">

                                                                                <input type="hidden" name="recurring_pmt_adult_{{$i}}{{$j}}" id="recurring_pmt_adult{{$i}}{{$j}}" value="{{$recurring_recurring_pmt_adult}}">

                                                                                <div class="col-md-8">
                                                                                    <p>Recurring Payment: </p>
                                                                                </div>

                                                                                <div class="col-md-4">
                                                                                    <p id="p_recurring_pmt_adult{{$i}}{{$j}}">${{$recurring_recurring_pmt_adult}}</p>
                                                                                </div>

                                                                                <input type="hidden" name="total_contract_revenue_adult_{{$i}}{{$j}}" id="total_contract_revenue_adult{{$i}}{{$j}}" value="{{$price['recurring_total_contract_revenue_adult']}}">

                                                                                <div class="col-md-8">
                                                                                    <label>Total Contract Revenue:  </label>
                                                                                </div>

                                                                                <div class="col-md-4">
                                                                                    <p id="p_total_contract_revenue_adult{{$i}}{{$j}}"> @if($price['recurring_total_contract_revenue_adult'] == '') $0 @else ${{$price['recurring_total_contract_revenue_adult']}} @endif</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn button-fitness" id="submitFormadult{{$i}}{{$j}}">Save</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <!-- </form> -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 

                                
                                            <div class="modal fade ModelRecurring_child{{$i}}{{$j}}" id="ModelRecurring_child{{$i}}{{$j}}" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true">

                                                <div class="modal-dialog editingautopay" role="document">

                                                    <div class="modal-content">

                                                        <div class="modal-header">

                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                                <span aria-hidden="true">&times;</span>

                                                            </button>

                                                        </div>

                                                        <div class="modal-body">
                                                            <form  method="POST" role="form" enctype="multipart/form-data" id="childformsumbit">
                                                            @csrf
                                                                <div class="row">

                                                                    <div class="col-md-12">

                                                                        <div class="editingautopay">

                                                                            <h5 class="modal-title" id="ModelRecurringTitle_child{{$i}}{{$j}}">Editing Recurring Payments Contract Settings for ({{$price_title}} for "Childern")</h5>

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="row">

                                                                    <div class="col-md-8">

                                                                        <div class="Settings-title">

                                                                            <h5> Settings </h5>

                                                                        </div>

                                                                        <div class="setting-box">

                                                                            <!-- <div class="row set-78">

                                                                                <div class="col-md-4">

                                                                                    <label class="contractsettings">Run Auto Pay</label>

                                                                                </div>

                                                                                <div class="col-md-8">

                                                                                    <div class="autopay">

                                                                                        <input type="radio" id="run_auto_pay_child{{$i}}{{$j}}" name="run_auto_pay_child_{{$i}}{{$j}}" value="on_set_schedule"  @if($recurring_run_auto_pay_child == 'on_set_schedule') checked @endif>

                                                                                        <label for="on_set_schedule">On a set schedule (recommended)</label><br>

                                                                                        <input type="radio" id="run_auto_pay_child{{$i}}{{$j}}" name="run_auto_pay_child_{{$i}}{{$j}}" value="price_opt_run_out" @if($recurring_run_auto_pay_child == 'price_opt_run_out') checked @endif>

                                                                                        <label for="price_opt_run_out">When price option runs out   </label><br> 

                                                                                    </div>

                                                                                </div>

                                                                            </div> -->

                                                                            <div class="row set-78">

                                                                                <div class="col-md-4">

                                                                                    <label class="contractsettings">How often will customers be charged?</label>

                                                                                </div>

                                                                                <div class="col-md-8">

                                                                                    <select class="form-control" name="recurring_customer_chage_by_child_{{$i}}{{$j}}" id="recurring_customer_chage_by_child{{$i}}{{$j}}">
                                                                                        <option value="1 Week" @if($recurring_customer_chage_by_child == '1 Week') selected @endif>1 week</option>
                                                                                        <option value="2 Week" @if($recurring_customer_chage_by_child == '2 Week') selected @endif>2 week</option>
                                                                                        <option value="1 Month" @if($recurring_customer_chage_by_child == '1 Month') selected @endif>1 Month</option>
                                                                                        <option value="3 Month" @if($recurring_customer_chage_by_child == '3 Month') selected @endif>3 Month</option>
                                                                                        <option value="6 Month" @if($recurring_customer_chage_by_child == '6 Month') selected @endif>6 Month</option> 
                                                                                        <option value="1 Year" @if($recurring_customer_chage_by_child == '1 Year') selected @endif>1 Year</option>
                                                                                    </select>

                                                                                </div>

                                                                            </div>

                                                                            <div class="row set-78">

                                                                                <div class="col-md-4">

                                                                                    <label class="contractsettings">Number of autopays  </label>

                                                                                </div>

                                                                                <div class="col-md-8">

                                                                                    <div class="nuberofautopays">

                                                                                        <input type="text" class="form-control valid" name="nuberofautopays_child_{{$i}}{{$j}}" id="nuberofautopays_child{{$i}}{{$j}}" placeholder="12" value="{{$recurring_nuberofautopays_child}}" oninput="getnumberofpmt({{$i}},{{$j}},'child');">

                                                                                    </div>

                                                                                    <div class="contract">

                                                                                        <label>  Total duration of contract: </label>

                                                                                        <p id="total_duration_child{{$i}}{{$j}}">@if($recurring_nuberofautopays_child == '') 0 @else {{$recurring_nuberofautopays_child}} @endif months</p>

                                                                                    </div>

                                                                                </div>

                                                                            </div>

                                                                            <div class="row set-78">

                                                                                <div class="col-md-4">

                                                                                    <label class="contractsettings" id="contractsettings_child{{$i}}{{$j}}">What happens after {{$recurring_nuberofautopays_child}} payments?</label>

                                                                                </div>

                                                                                <div class="col-md-8">

                                                                                    <div class="autopay">

                                                                                        <input type="radio" id="happens_aftr_12_pmt_child{{$i}}{{$j}}" name="happens_aftr_12_pmt_child_{{$i}}{{$j}}" value="contract_expire"@if($recurring_happens_aftr_12_pmt_child == 'contract_expire') checked @endif>

                                                                                        <label for="contract">Contract Expires</label><br>

                                                                                        <input type="radio" id="happens_aftr_12_pmt_child{{$i}}{{$j}}" name="happens_aftr_12_pmt_child_{{$i}}{{$j}}" value="contract_renew" @if($recurring_happens_aftr_12_pmt_child == 'contract_renew') checked @endif>

                                                                                        <label for="renews" id="renew_child{{$i}}{{$j}}">Contract Automaitcally Renews Every  {{$recurring_nuberofautopays_child}} payments</label><br> 

                                                                                    </div>

                                                                                </div>

                                                                            </div>

                                                                            <div class="row set-78">

                                                                                <div class="col-md-4">

                                                                                    <label class="contractsettings">When will clients be charged?</label>

                                                                                </div>

                                                                                <div class="col-md-8">

                                                                                    <div class="saledate">
                                                                                        <!-- <input type="hidden" name="client_be_charge_on_child_{{$i}}{{$j}}" id="client_be_charge_on_child{{$i}}{{$j}}" value="On the sale date">
                                                                                        <p>On the sale date </p> -->
                                                                                        <select class="form-control" name="client_be_charge_on_child_{{$i}}{{$j}}" id="client_be_charge_on_child{{$i}}{{$j}}"> 

                                                                                            <option value="sale date" @if($recurring_client_be_charge_on_child == 'sale date') selected @endif>On the sale date </option> 
                                                                                            <option value="1stday" @if($recurring_client_be_charge_on_child == '1stday') selected @endif> 1st Day of the Month</option>
                                                                                            <option value="15thday" @if($recurring_client_be_charge_on_child == '15thday') selected @endif> 15th Day of the Month</option> 

                                                                                        </select> 

                                                                                    </div>

                                                                                </div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                    <div class="col-md-4">

                                                                        <div class="Settings-title">

                                                                            <h5> Contract Review </h5>

                                                                        </div>

                                                                        <div class="setting-box">

                                                                            <div class="set-border">

                                                                                <div class="row">

                                                                                    <div class="col-md-8">

                                                                                        <p id="p_price_title_child{{$i}}{{$j}}">{{$price_title}}</p>

                                                                                    </div>

                                                                                    <div class="col-md-4">

                                                                                        <p id="p1_price_child{{$i}}{{$j}}">
                                                                                        @if($price['child_cus_weekly_price'] == '') $0 @else ${{$price['child_cus_weekly_price']}}@endif</p>

                                                                                    </div>

                                                                                </div>

                                                                            </div>

                                                                            <div class="row">

                                                                                <div class="col-md-12">

                                                                                    <div class="Settings-title">

                                                                                        <h5> Revenue Breakdown </h5>

                                                                                    </div>

                                                                                </div>

                                                                                <div class="col-md-10">

                                                                                    <p  id="trems_payment_child{{$i}}{{$j}}">Terms: @if($recurring_nuberofautopays_child == '') 0 @else {{$recurring_nuberofautopays_child}} @endif Monthly Payments</p>

                                                                                </div>  

                                                                                <div class="col-md-8">

                                                                                    <p>First Payment:</p>

                                                                                </div>

                                                                                <div class="col-md-4">

                                                                                    <p id="p_first_pmt_child{{$i}}{{$j}}">${{$recurring_first_pmt_child}}</p>

                                                                                </div>

                                                                                <input type="hidden" name="first_pmt_child_{{$i}}{{$j}}" id="first_pmt_child{{$i}}{{$j}}" value="{{$recurring_recurring_pmt_child}}">

                                                                                <input type="hidden" name="recurring_pmt_child_{{$i}}{{$j}}" id="recurring_pmt_child{{$i}}{{$j}}" value="{{$recurring_recurring_pmt_child}}">

                                                                                <div class="col-md-8">

                                                                                    <p>Recurring Payment: </p>

                                                                                </div>

                                                                                <div class="col-md-4">

                                                                                    <p id="p_recurring_pmt_child{{$i}}{{$j}}">${{$recurring_recurring_pmt_child}}</p>

                                                                                </div>

                                                                                <input type="hidden" name="total_contract_revenue_child_{{$i}}{{$j}}" id="total_contract_revenue_child{{$i}}{{$j}}" value="{{$price['recurring_total_contract_revenue_child']}}">

                                                                                <div class="col-md-8">

                                                                                    <label>Total Contract Revenue:  </label>

                                                                                </div>

                                                                                <div class="col-md-4">

                                                                                    <p id="p_total_contract_revenue_child{{$i}}{{$j}}"> @if($price['recurring_total_contract_revenue_child'] == '') $0 @else ${{$price['recurring_total_contract_revenue_child']}} @endif </p>

                                                                                </div>

                                                                            </div>

                                                                            <div class="modal-footer">

                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                                                <button type="submit" class="btn button-fitness"  id="submitFormchild">Save</button>

                                                                            </div>

                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="modal fade ModelRecurring_infant{{$i}}{{$j}}" id="ModelRecurring_infant{{$i}}{{$j}}" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true">

                                                <div class="modal-dialog editingautopay" role="document">

                                                    <div class="modal-content">

                                                        <div class="modal-header">

                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                                <span aria-hidden="true">&times;</span>

                                                            </button>

                                                        </div>

                                                        <div class="modal-body">

                                                            <div class="row">

                                                                <div class="col-md-12">

                                                                    <div class="editingautopay">

                                                                        <h5 class="modal-title" id="ModelRecurringTitle_infant{{$i}}{{$j}}">Editing Recurring Payments Contract Settings for ({{$price_title}} for "Infant")</h5>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="row">

                                                                <div class="col-md-8">

                                                                    <div class="Settings-title">

                                                                        <h5> Settings </h5>

                                                                    </div>

                                                                    <div class="setting-box">

                                                                        <div class="row set-78">

                                                                            <div class="col-md-4">

                                                                                <label class="contractsettings">How often will customers be charged?</label>

                                                                            </div>

                                                                            <div class="col-md-8">

                                                                                <select class="form-control" name="recurring_customer_chage_by_infant_{{$i}}{{$j}}" id="recurring_customer_chage_by_infant{{$i}}{{$j}}">
                                                                                        <option value="1 Week" @if($recurring_customer_chage_by_infant == '1 Week') selected @endif>1 week</option>
                                                                                        <option value="2 Week" @if($recurring_customer_chage_by_infant == '2 Week') selected @endif>2 week</option>
                                                                                        <option value="1 Month" @if($recurring_customer_chage_by_infant == '1 Month') selected @endif>1 Month</option>
                                                                                        <option value="3 Month" @if($recurring_customer_chage_by_infant == '3 Month') selected @endif>3 Month</option>
                                                                                        <option value="6 Month" @if($recurring_customer_chage_by_infant == '6 Month') selected @endif>6 Month</option> 
                                                                                        <option value="1 Year" @if($recurring_customer_chage_by_infant == '1 Year') selected @endif>1 Year</option>
                                                                                    </select>

                                                                            </div>

                                                                        </div>

                                                                        <div class="row set-78">

                                                                            <div class="col-md-4">

                                                                                <label class="contractsettings">Number of autopays  </label>

                                                                            </div>

                                                                            <div class="col-md-8">

                                                                                <div class="nuberofautopays">

                                                                                    <input type="text" class="form-control valid" name="nuberofautopays_infant_{{$i}}{{$j}}" id="nuberofautopays_infant{{$i}}{{$j}}" placeholder="12" value="{{$recurring_nuberofautopays_infant}}" oninput="getnumberofpmt({{$i}},{{$j}},'infant');">

                                                                                </div>

                                                                                <div class="contract">

                                                                                    <label>  Total duration of contract: </label>

                                                                                    <p id="total_duration_infant{{$i}}{{$j}}">@if($recurring_nuberofautopays_infant == '') 0 @else {{$recurring_nuberofautopays_infant}} @endif months</p>

                                                                                </div>

                                                                            </div>

                                                                        </div>

                                                                        <div class="row set-78">

                                                                            <div class="col-md-4">

                                                                                <label class="contractsettings" id="contractsettings_infant{{$i}}{{$j}}">What happens after {{$recurring_nuberofautopays_infant}} payments?</label>

                                                                            </div>

                                                                            <div class="col-md-8">

                                                                                <div class="autopay">

                                                                                    <input type="radio" id="happens_aftr_12_pmt_infant{{$i}}{{$j}}" name="happens_aftr_12_pmt_infant_{{$i}}{{$j}}" value="contract_expire"@if($recurring_happens_aftr_12_pmt_infant == 'contract_expire') checked @endif>

                                                                                    <label for="contract">Contract Expires</label><br>

                                                                                    <input type="radio" id="happens_aftr_12_pmt_infant{{$i}}{{$j}}" name="happens_aftr_12_pmt_infant_{{$i}}{{$j}}" value="contract_renew" @if($recurring_happens_aftr_12_pmt_infant == 'contract_renew') checked @endif>

                                                                                    <label for="renews" id="renew_infant{{$i}}{{$j}}">Contract Automaitcally Renews Every  {{$recurring_nuberofautopays_infant}} payments</label><br> 

                                                                                </div>

                                                                            </div>

                                                                        </div>

                                                                        <div class="row set-78">

                                                                            <div class="col-md-4">

                                                                                <label class="contractsettings">When will clients be charged?</label>

                                                                            </div>

                                                                            <div class="col-md-8">

                                                                                <div class="saledate">
                                                                                    <!-- <input type="hidden" name="client_be_charge_on_infant_{{$i}}{{$j}}" id="client_be_charge_on_infant{{$i}}{{$j}}" value="On the sale date">
                                                                                    <p>On the sale date </p> -->
                                                                                    <select class="form-control" name="client_be_charge_on_infant_{{$i}}{{$j}}" id="client_be_charge_on_infant{{$i}}{{$j}}">

                                                                                        <option value="sale date" @if($recurring_client_be_charge_on_infant == 'sale date') selected @endif>On the sale date </option> 
                                                                                        <option value="1stday" @if($recurring_client_be_charge_on_infant == '1stday') selected @endif> 1st Day of the Month</option>
                                                                                        <option value="15thday" @if($recurring_client_be_charge_on_infant == '15thday') selected @endif> 15th Day of the Month</option> 

                                                                                    </select> 

                                                                                </div>

                                                                            </div>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="col-md-4">

                                                                    <div class="Settings-title">

                                                                        <h5> Contract Review </h5>

                                                                    </div>

                                                                    <div class="setting-box">

                                                                        <div class="set-border">

                                                                            <div class="row">

                                                                                <div class="col-md-8">

                                                                                    <p id="p_price_title_infant{{$i}}{{$j}}">{{$price_title}}</p>

                                                                                </div>

                                                                                <div class="col-md-4">

                                                                                    <p id="p1_price_infant{{$i}}{{$j}}">@if($price['infant_cus_weekly_price'] == '') $0 @else ${{$price['infant_cus_weekly_price']}}@endif</p>

                                                                                </div>

                                                                            </div>

                                                                        </div>

                                                                        <div class="row">

                                                                            <div class="col-md-12">

                                                                                <div class="Settings-title">

                                                                                    <h5> Revenue Breakdown </h5>

                                                                                </div>

                                                                            </div>

                                                                            <div class="col-md-10">

                                                                                <p  id="trems_payment_infant{{$i}}{{$j}}">Terms: @if($recurring_nuberofautopays_infant == '') 0 @else {{$recurring_nuberofautopays_infant}} @endif Monthly Payments</p>

                                                                            </div>

                                                                            <div class="col-md-8">

                                                                                <p>First Payment:</p>

                                                                            </div>

                                                                            <div class="col-md-4">

                                                                                <p id="p_first_pmt_infant{{$i}}{{$j}}">${{$recurring_first_pmt_infant}}</p>

                                                                            </div>

                                                                            <input type="hidden" name="first_pmt_infant_{{$i}}{{$j}}" id="first_pmt_infant{{$i}}{{$j}}" value="{{$recurring_first_pmt_infant}}">

                                                                            <input type="hidden" name="recurring_pmt_infant_{{$i}}{{$j}}" id="recurring_pmt_infant{{$i}}{{$j}}" value="{{$recurring_recurring_pmt_infant}}">

                                                                            <div class="col-md-8">

                                                                                <p>Recurring Payment: </p>

                                                                            </div>

                                                                            <div class="col-md-4">

                                                                                <p id="p_recurring_pmt_infant{{$i}}{{$j}}">${{$recurring_recurring_pmt_infant}}</p>

                                                                            </div>

                                                                            <input type="hidden" name="total_contract_revenue_infant_{{$i}}{{$j}}" id="total_contract_revenue_infant{{$i}}{{$j}}" value="{{$price['recurring_total_contract_revenue_infant']}}">

                                                                            <div class="col-md-8">

                                                                                <label>Total Contract Revenue:  </label>

                                                                            </div>

                                                                            <div class="col-md-4">
                                                                                <p id="p_total_contract_revenue_infant{{$i}}{{$j}}">@if($price['recurring_total_contract_revenue_infant'] == '') $0 @else ${{$price['recurring_total_contract_revenue_infant']}} @endif</p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                                                            <button type="submit" class="btn button-fitness"  id="submitFormchild">Save</button>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>
                                            </div>
                                        </div> 

                                        <?php $j++; } 

                                        }?>

                                    </div>

                                <div  class="">

                                    <div class="col-md-12">

                                        <div class="addanother">

                                            <a class="" onclick=" return add_another_price_ages({{$i}});"> +Add Another Session </a>
                                           <a class="" onclick=" return add_another_price_duplicate_session({{$i}});"> +Duplicate This Session Only </a>
                                            <a class="" onclick=" return add_another_price_duplicate_category({{$i}});"> +Duplicate Entire Category </a> 

                                        </div>  

                                    </div>

                                </div>

                            </div>

                        <?php 

                            $i++;

                            }

                        }else {

                      $y=0;

                    ?>  

                        <input type="hidden" name="fitnessity_fee" value="{{$fitnessity_fee}}">

                        <div id="pricediv0">
                            <input type="hidden"  name="ages_count0" id="ages_count0" value="0" />

                            <div id="agesmaindiv0">
                                <div id="agesdiv00">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="priceselect sp-select">
                                                <input type="hidden" name="cat_id_db[]" id="cat_id_db" value="">
                                                <label>Category Title (Give a name for this category)</label>
                                                <p>*Note: This name will be displayed on your booking schedule for customer to see. </p>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <input type="text" name="category_title[]" id="category_title"  class="inputs" placeholder="Ex: Kids Martial Arts (5 to 7 yrs Old)">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" name="sales_tax[]" id="sales_tax"  class="inputs" value="" placeholder="Sales Tax">
                                                        <label> % <i class="fas fa-question-circle info-tooltip" id="tooltipex" data-placement="top" title="Typically used when charging for apparel, products, rentals, equipment, food, or snacks."></i></label>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <input type="text" name="dues_tax[]" id="dues_tax"  class="inputs" value="" placeholder="Dues Tax">
                                                        <label> %  <i class="fas fa-question-circle info-tooltip" id="tooltipex" data-placement="top" title="Typically used for all membership type fees."></i></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="sp-select-sche">
                                               <!--  <p><a onclick="setschedule();">+Set Your Schedule</a>(Schedule the times this activity will happen)</p> -->
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="price_id_db_00" id="price_id_db00" value="" />
                                    <div class="row mt-30">
                                        <div class="col-md-3 col-sm-6">
                                            <div class="priceselect sp-select">
                                                <label>Price Title</label>
                                                <input type="text" name="price_title_00" id="price_title00"  class="inputs" placeholder="Ex: 6 month Membership" oninput="getpricetitle(0,0)">
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-sm-6">
                                            <div class="priceselect sp-select">
                                                <label>Session Type</label>
                                                <select name="pay_session_type_00" id="pay_session_type00" class="bd-right bd-bottom pay_session_type" onchange="pay_session_select(0,0,this.value);">
                                                    <option value="Single">Single</option>
                                                    <option value="Multiple">Multiple</option>
                                                    <option value="Unlimited">Unlimited</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-sm-6">
                                            <div class="priceselect sp-select">
                                                <label>Number of Sessions</label>
                                                <input type="text" name="pay_session_00" id="pay_session00"  class="inputs pay_session" placeholder="1" value="1" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-sm-6">
                                            <div class="priceselect sp-select">
                                                <label>Membership Type</label>
                                                <select name="membership_type_00" id="membership_type00" class="bd-right bd-bottom membership_type">
                                                    <option value="Drop In">Drop In</option>
                                                    <option value="Semester">Semester (Long Term)</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="setprice sp-select">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <input type="radio" id="freeprice00" name="sectiondisplay00" onclick="showdiv(0,0);" value="freeprice">
                                                        <label class="recurring-pmt">Free</label>
                                                        
                                                        <input type="radio" id="weekdayprice00" name="sectiondisplay00" checked onclick="showdiv(0,0);"  value="weekdayprice">
                                                        <label class="recurring-pmt">Everyday Price</label>
                                                        
                                                        <input type="radio" id="weekendprice00" name="sectiondisplay00" onclick="showdiv(0,0);"  value="weekendprice">
                                                        <label class="recurring-pmt">Weekend Price</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="displaysectiondiv00">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="setprice sp-select">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <label id="showlessmore00"  onclick="showlessmore(0,0);">Show Less</label>
                                                        </div>
                                                        <div class="col-md-10">
                                                            <h3 class="setprice-custom">You can set your prices to be the same or different based on age, the weekday or the weekend.To add prices for children or infants, click on the box.</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="row">
                                            <div class="age-cat">
                                                <div class="cat-age sp-select">
                                                    <label>Adults</label>
                                                    <p>Ages 12 & Older</p>
                                                </div>
                                            </div>

                                            <div class="weekly-customer">
                                                <div class="cus-week-price sp-select">
                                                    <label>Weekday Price</label>
                                                    <p> (Monday - Sunday)</p>
                                                    <input type="text" name="adult_cus_weekly_price_00" id="adult_cus_weekly_price00" placeholder="$"  onkeyup="adultchangeestprice(0,0);">
                                                </div>
                                            </div>

                                            <div class="weekend-price Weekend00" style="display: none;">
                                                <div class="cus-week-price sp-select">
                                                    <label>Weekend Price </label>
                                                    <p> (Saturday & Sunday)</p>
                                                    <input type="text" name="adult_weekend_price_diff_00" id="adult_weekend_price_diff00" placeholder="$" onkeyup="weekendadultchangeestprice(0,0);">
                                                </div>
                                            </div>

                                            <div class="re-discount">
                                                <div class="discount sp-select">
                                                    <label>Any Discount? </label>
                                                    <p> (Recommended 10% to 15%)</p>
                                                    <input type="text" name="adult_discount_00" id="adult_discount00" onkeyup="adultdischangeestprice(0,0);">
                                                </div>
                                            </div>

                                            <div class="single-dash">
                                                <div class="desh sp-select">
                                                    <label>-</label>
                                                </div>
                                            </div>

                                            <div class="fit-fees">

                                                <div class="fees sp-select">
                                                    <label>Introduction Fee </label>
                                                    <label>Recurring Fee </label>
                                                    <p> 5%</p>
                                                    <p> 1%</p>
                                                </div>

                                            </div>

                                            <div class="single-equal">

                                                <div class="equal sp-select">

                                                    <label>=</label>

                                                </div>

                                            </div>

                                            <div class="estimated-earn">

                                                <div class="cus-week-price sp-select">

                                                    <label>Weekday Estimated Earnings </label>

                                                    <input type="text" name="adult_estearn_00" id="adult_estearn00" placeholder="$">

                                                </div>

                                            </div>

                                            <div class="estimated-earn Weekend00">

                                                <div class="cus-week-price sp-select">

                                                    <label>Weekend Estimated Earnings</label>

                                                    <input type="text" name="weekend_adult_estearn_00" id="weekend_adult_estearn00" placeholder="$" >

                                                </div>

                                            </div>

                                            <div class="col-md-12">

                                                <div class="priceselect sp-select modelmargin">

                                                    <input class="modelcheckbox"  data-count="0"  type="checkbox" id="is_recurring_adult00" name="is_recurring_adult_00" value="0" onclick="openmodelbox(0,0,'adult');" >

                                                    <label>Is This A Recurring Payment? Set the monthly payment terms for Adults</label>

                                                    <button style="display:none" id="btn_recurring_adult00" name="btn_recurring_adult_00[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring_adult00" onclick="recurrint_id(0,0,'adult');">Launch demo modal</button>

                                                </div>

                                            </div>
                                        </div>

                                        <div id="showmorehide00">
                                            <div class="row">

                                                <div class="age-cat">

                                                    <div class="cat-age sp-select">

                                                        <label>Children</label>

                                                        <p>Ages 2 to 12</p>

                                                    </div>

                                                </div>

                                                <div class="weekly-customer">

                                                    <div class="cus-week-price sp-select">

                                                        <label>Weekday Price</label>

                                                        <p> (Monday - Sunday)</p>

                                                        <input type="text" name="child_cus_weekly_price_00" id="child_cus_weekly_price00" placeholder="$" onkeyup="childchangeestprice(0,0);">

                                                    </div>

                                                </div>

                                                <div class="weekend-price Weekend00" style="display: none;">

                                                    <div class="cus-week-price sp-select">

                                                        <label>Weekend Price</label>

                                                        <p> (Saturday & Sunday)</p>

                                                        <input type="text" name="child_weekend_price_diff_00" id="child_weekend_price_diff00" placeholder="$" onkeyup="weekendchildchangeestprice(0,0);">

                                                    </div>

                                                </div>

                                                <div class="re-discount">

                                                    <div class="discount sp-select">

                                                        <label>Any Discount?</label>

                                                        <p> (Recommended 10% to 15%)</p>

                                                        <input type="text" name="child_discount_00" id="child_discount00"  onkeyup="childdischangeestprice(0,0);">

                                                    </div>

                                                </div>

                                                <div class="single-dash">

                                                    <div class="desh sp-select">

                                                        <label>-</label>

                                                    </div>

                                                </div>

                                                <div class="fit-fees">

                                                    <div class="fees sp-select">

                                                        <label>Introduction Fee </label>
                                                        <label>Recurring Fee </label>
                                                        <p> 5%</p>
                                                        <p> 1%</p>

                                                    </div>

                                                </div>

                                                <div class="single-equal">

                                                    <div class="equal sp-select">

                                                        <label>=</label>

                                                    </div>

                                                </div>

                                                <div class="estimated-earn">

                                                    <div class="cus-week-price sp-select">

                                                        <label>Weekday Estimated Earnings</label>

                                                        <input type="text" name="child_estearn_00" id="child_estearn00" placeholder="$" >

                                                    </div>

                                                </div>

                                                <div class="estimated-earn Weekend00">

                                                    <div class="cus-week-price sp-select">

                                                        <label>Weekend Estimated Earnings</label>

                                                        <input type="text" name="weekend_child_estearn_00" id="weekend_child_estearn00" placeholder="$" >

                                                    </div>

                                                </div>

                                                <div class="col-md-12">

                                                    <div class="priceselect sp-select modelmargin">

                                                        <input class="modelcheckbox"  data-count="0"  type="checkbox" id="is_recurring_child00" name="is_recurring_child_00" value="0"  onclick="openmodelbox(0,0,'child');" >

                                                        <label>Is This A Recurring Payment? Set the monthly payment terms for Children</label>

                                                        <button style="display:none" id="btn_recurring_child00" name="btn_recurring_child_00[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring_child00" onclick="recurrint_id(0,0,'child');">Launch demo modal</button>

                                                    </div>

                                                </div>
                                            </div>

                                            <div class="row">

                                                <div class="age-cat">

                                                    <div class="cat-age sp-select">

                                                        <label>Infants</label>

                                                        <p>Ages 2 & Under</p>

                                                    </div>

                                                </div>

                                                <div class="weekly-customer">

                                                    <div class="cus-week-price sp-select">

                                                        <label>Weekday Price</label>

                                                        <p> (Monday - Sunday)</p>

                                                        <input type="text" name="infant_cus_weekly_price_00" id="infant_cus_weekly_price00" placeholder="$" onkeyup="infantchangeestprice(0,0);">

                                                    </div>

                                                </div>

                                                <div class="weekend-price Weekend00" style="display: none;">

                                                    <div class="cus-week-price sp-select">

                                                        <label>Weekend Price</label>

                                                        <p> (Saturday & Sunday)</p>

                                                        <input type="text" name="infant_weekend_price_diff_00" id="infant_weekend_price_diff00" placeholder="$" onkeyup="weekendinfantchangeestprice(0,0);">

                                                    </div>

                                                </div>

                                                <div class="re-discount">

                                                    <div class="discount sp-select">

                                                        <label>Any Discount?</label>

                                                        <p> (Recommended 10% to 15%)</p>

                                                        <input type="text" name="infant_discount_00" id="infant_discount00" onkeyup="infantdischangeestprice(0,0);">

                                                    </div>

                                                </div>

                                                <div class="single-dash">

                                                    <div class="desh sp-select">

                                                        <label>-</label>

                                                    </div>

                                                </div>

                                                <div class="fit-fees">

                                                    <div class="fees sp-select">

                                                        <label>Introduction Fee </label>
                                                        <label>Recurring Fee </label>
                                                        <p> 5%</p>
                                                        <p> 1%</p>

                                                    </div>

                                                </div>

                                                <div class="single-equal">

                                                    <div class="equal sp-select">

                                                        <label>=</label>

                                                    </div>

                                                </div>

                                                <div class="estimated-earn">

                                                    <div class="cus-week-price sp-select">

                                                        <label>Weekday Estimated Earnings</label>

                                                        <input type="text" name="infant_estearn_00" id="infant_estearn00" placeholder="$">

                                                    </div>

                                                </div>

                                                <div class="estimated-earn Weekend00">

                                                    <div class="cus-week-price sp-select">

                                                        <label>Weekend Estimated Earnings</label>

                                                        <input type="text" name="weekend_infant_estearn_00" id="weekend_infant_estearn00" placeholder="$">

                                                    </div>

                                                </div>

                                                <div class="col-md-12">

                                                    <div class="priceselect sp-select modelmargin">

                                                        <input class="modelcheckbox"  data-count="0"  type="checkbox" id="is_recurring_infant00"     name="is_recurring_infant_00" value="0"  onclick="openmodelbox(0,0,'infant');" >

                                                        <label>Is This A Recurring Payment? Set the monthly payment terms for Infants</label>

                                                        <button style="display:none" id="btn_recurring_infant00" name="btn_recurring_infant_00[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring_infant00" onclick="recurrint_id(0,0,'infant');">Launch demo modal</button>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-12 col-sm-12">

                                            <div class="serviceprice sp-select">

                                                <h3>When Does This Price Setting Expire</h3>

                                            </div>

                                        </div>

                                        <div class="col-md-3 col-sm-6 col-xs-12">

                                            <div class="set-num">

                                                <label>Set The Number</label>

                                                <input type="text" name="pay_setnum_00" id="pay_setnum00" class="form-control valid" placeholder="(ex,1,2,3,etc.)" value="1" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">

                                            </div>

                                        </div>

                        
                                        <div class="col-md-3 col-sm-6 col-xs-12">

                                            <div class="set-num">

                                                <label>The Duration</label>

                                                <select name="pay_setduration_00" id="pay_setduration00" class="form-control valid">

                                                    <option value="">Select Value</option>

                                                    <option selected="">Days</option>

                                                    <option>Months</option>

                                                    <option>Years</option>

                                                </select>

                                            </div>

                                        </div>

                                        <div class="col-md-1 col-xs-12">

                                            <div class="set-num after">

                                                <label>After</label>

                                            </div>

                                        </div>

                                        <div class="col-md-5 col-xs-12">

                                            <div class="after-select">

                                                <select name="pay_after_00" id="pay_after00" class="pay_after form-control valid">

                                                    <option value="">Select Value</option>

                                                    <option value="1" selected="">Starts to expire the day of purchase</option>

                                                    <option value="2">Starts to expire when the customer first participates in the activity</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade ModelRecurring_adult00" id="ModelRecurring_adult00" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true">
                                        <div class="modal-dialog editingautopay" role="document">

                                            <div class="modal-content">

                                                <div class="modal-header">

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                        <span aria-hidden="true">&times;</span>

                                                    </button>

                                                </div>

                                                <div class="modal-body">

                                                    <div class="row">

                                                        <div class="col-md-12">

                                                            <div class="editingautopay">

                                                                <h5 class="modal-title" id="ModelRecurringTitle_adult00">Editing Recurring Payments Contract Settings for ("Adults")  </h5>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-8">

                                                            <div class="Settings-title">

                                                                <h5> Settings </h5>

                                                            </div>

                                                            <div class="setting-box">

                                                                <!-- <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">Run Auto Pay</label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <div class="autopay">

                                                                            <input type="radio" id="run_auto_pay_adult00" name="run_auto_pay_adult_00" value="on_set_schedule"  >

                                                                            <label for="on_set_schedule">On a set schedule (recommended)</label><br>

                                                                            <input type="radio" id="run_auto_pay_adult00" name="run_auto_pay_adult_00" value="price_opt_run_out" >

                                                                            <label for="price_opt_run_out">When price option runs out   </label><br> 

                                                                        </div>

                                                                    </div>

                                                                </div> -->

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">How often will customers be charged?</label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <select class="form-control" name="recurring_customer_chage_by_adult_{{$i}}{{$j}}" id="recurring_customer_chage_by_adult{{$i}}{{$j}}">
                                                                            <option value="1 Week" @if($recurring_customer_chage_by_adult == '1 Week') selected @endif>1 week</option>
                                                                            <option value="2 Week" @if($recurring_customer_chage_by_adult == '2 Week') selected @endif>2 week</option>
                                                                            <option value="1 Month" @if($recurring_customer_chage_by_adult == '1 Month') selected @endif>1 Month</option>
                                                                            <option value="3 Month" @if($recurring_customer_chage_by_adult == '3 Month') selected @endif>3 Month</option>
                                                                            <option value="6 Month" @if($recurring_customer_chage_by_adult == '6 Month') selected @endif>6 Month</option> 
                                                                            <option value="1 Year" @if($recurring_customer_chage_by_adult == '1 Year') selected @endif>1 Year</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">Number of autopays  </label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <div class="nuberofautopays">

                                                                            <input type="text" class="form-control valid" name="nuberofautopays_adult_00" id="nuberofautopays_adult00" placeholder="12" value="" oninput="getnumberofpmt(0,0,'adult');">

                                                                        </div>

                                                                        <div class="contract">

                                                                            <label>  Total duration of contract: </label>

                                                                            <p id="total_duration_adult00">0 months</p>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings" id="contractsettings_adult00">What happens after payments?</label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <div class="autopay">

                                                                            <input type="radio" id="happens_aftr_12_pmt_adult00" name="happens_aftr_12_pmt_adult_00" value="contract_expire">

                                                                            <label for="contract">Contract Expires</label><br>

                                                                            <input type="radio" id="happens_aftr_12_pmt_adult00" name="happens_aftr_12_pmt_adult_00" value="contract_renew" >

                                                                            <label for="renews" id="renew_adult00">Contract Automaitcally Renews Every payments</label><br> 

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">When will clients be charged?</label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <div class="saledate">
                                                                            <!-- <input type="hidden" name="client_be_charge_on_adult_00" id="client_be_charge_on_adult_00" value="On the sale date">
                                                                                <p>On the sale date </p> -->
                                                                                <select class="form-control" name="client_be_charge_on_adult_00" id="client_be_charge_on_adult00">
                                                                                    <option value="sale date" @if($recurring_client_be_charge_on_adult == 'sale date') selected @endif>On the sale date </option> 
                                                                                    <option value="1stday" @if($recurring_client_be_charge_on_adult == '1stday') selected @endif> 1st Day of the Month</option>
                                                                                    <option value="15thday" @if($recurring_client_be_charge_on_adult == '15thday') selected @endif> 15th Day of the Month</option> 

                                                                                </select> 
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-4">

                                                            <div class="Settings-title">

                                                                <h5> Contract Review </h5>

                                                            </div>

                                                            <div class="setting-box">

                                                                <div class="set-border">

                                                                    <div class="row">

                                                                        <div class="col-md-8">

                                                                            <p id="p_price_title_adult00"></p>

                                                                        </div>

                                                                        <div class="col-md-4">

                                                                            <p id="p1_price_adult00">$0</p>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="row">

                                                                    <div class="col-md-12">

                                                                        <div class="Settings-title">

                                                                            <h5> Revenue Breakdown </h5>

                                                                        </div>

                                                                    </div>

                                                                    <div class="col-md-10">

                                                                        <p  id="trems_payment_adult00">Terms: 12 Monthly Payments</p>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <p>First Payment:</p>

                                                                    </div>

                                                                    <div class="col-md-4">

                                                                        <p id="p_first_pmt_adult00">$0</p>

                                                                    </div>

                                                                    <input type="hidden" name="first_pmt_adult_00" id="first_pmt_adult00" value="">

                                                                    <input type="hidden" name="recurring_pmt_adult_00" id="recurring_pmt_adult00" value="">

                                                                    <div class="col-md-8">

                                                                        <p>Recurring Payment: </p>

                                                                    </div>

                                                                    <div class="col-md-4">

                                                                        <p id="p_recurring_pmt_adult00">$0</p>

                                                                    </div>

                                                                    <input type="hidden" name="total_contract_revenue_adult_00" id="total_contract_revenue_adult00" value="">

                                                                    <div class="col-md-8">

                                                                        <label>Total Contract Revenue:  </label>

                                                                    </div>

                                                                    <div class="col-md-4">

                                                                        <p id="p_total_contract_revenue_adult00"> $0</p>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                    </div> 

                                    <div class="modal fade ModelRecurring_child00" id="ModelRecurring_child00" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true">

                                        <div class="modal-dialog editingautopay" role="document">

                                            <div class="modal-content">

                                                <div class="modal-header">

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                        <span aria-hidden="true">&times;</span>

                                                    </button>

                                                </div>

                                                <div class="modal-body">

                                                    <div class="row">

                                                        <div class="col-md-12">

                                                            <div class="editingautopay">

                                                                <h5 class="modal-title" id="ModelRecurringTitle_child00">Editing Recurring Payments Contract Settings for ("Children") </h5>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-8">

                                                            <div class="Settings-title">

                                                                <h5> Settings </h5>

                                                            </div>

                                                            <div class="setting-box">

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">How often will customers be charged?</label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <select class="form-control" name="recurring_customer_chage_by_child_00" id="recurring_customer_chage_by_child00">
                                                                            <option value="1 Week">1 week</option>
                                                                            <option value="2 Week">2 week</option>
                                                                            <option value="1 Month">1 Month</option>
                                                                            <option value="3 Month">3 Month</option>
                                                                            <option value="6 Month">6 Month</option> 
                                                                            <option value="1 Year">1 Year</option>
                                                                        </select>

                                                                    </div>

                                                                </div>

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">Number of autopays  </label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <div class="nuberofautopays">

                                                                            <input type="text" class="form-control valid" name="nuberofautopays_child_00" id="nuberofautopays_child00" placeholder="12" value="" oninput="getnumberofpmt(0,0,'child');">

                                                                        </div>

                                                                        <div class="contract">

                                                                            <label>  Total duration of contract: </label>

                                                                            <p id="total_duration_child00">0 months</p>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings" id="contractsettings_child00">What happens after payments?</label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <div class="autopay">

                                                                            <input type="radio" id="happens_aftr_12_pmt_child00" name="happens_aftr_12_pmt_child_00" value="contract_expire">

                                                                            <label for="contract">Contract Expires</label><br>

                                                                            <input type="radio" id="happens_aftr_12_pmt_child00" name="happens_aftr_12_pmt_child_00" value="contract_renew">

                                                                            <label for="renews" id="renew_child00">Contract Automaitcally Renews Every payments</label><br> 

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">When will clients be charged?</label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <div class="saledate">
                                                                            <!-- <input type="hidden" name="client_be_charge_on_child_00" id="client_be_charge_on_child_00" value="On the sale date">
                                                                                <p>On the sale date </p> -->
                                                                            <select class="form-control" name="client_be_charge_on_child_00" id="client_be_charge_on_child00">
                                                                                <option value="sale date" @if($recurring_client_be_charge_on_child == 'sale date') selected @endif>On the sale date </option> 
                                                                                <option value="1stday" @if($recurring_client_be_charge_on_child == '1stday') selected @endif> 1st Day of the Month</option>
                                                                                <option value="15thday" @if($recurring_client_be_charge_on_child == '15thday') selected @endif> 15th Day of the Month</option> 
                                                                            </select>
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-4">

                                                            <div class="Settings-title">

                                                                <h5> Contract Review </h5>

                                                            </div>

                                                            <div class="setting-box">

                                                                <div class="set-border">

                                                                    <div class="row">

                                                                        <div class="col-md-8">

                                                                            <p id="p_price_title_child00"></p>

                                                                        </div>

                                                                        <div class="col-md-4">

                                                                            <p  id="p1_price_child00">$0</p>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="row">

                                                                    <div class="col-md-12">

                                                                        <div class="Settings-title">

                                                                            <h5> Revenue Breakdown </h5>

                                                                        </div>

                                                                    </div>

                                                                    <div class="col-md-10">

                                                                        <p id="trems_payment_child00">Terms: 12 Monthly Payments</p>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <p>First Payment:</p>

                                                                    </div>

                                                                    <div class="col-md-4">

                                                                        <p id="p_first_pmt_child00">$0</p>

                                                                    </div>

                                                                    <input type="hidden" name="first_pmt_child_00" id="first_pmt_child00" value="">

                                                                    <input type="hidden" name="recurring_pmt_child_00" id="recurring_pmt_child00" value="">

                                                                    <div class="col-md-8">

                                                                        <p>Recurring Payment: </p>

                                                                    </div>

                                                                    <div class="col-md-4">

                                                                        <p id="p_recurring_pmt_child00">$0</p>

                                                                    </div>

                                                                    <input type="hidden" name="total_contract_revenue_child_00" id="total_contract_revenue_child00" value="">

                                                                    <div class="col-md-8">

                                                                        <label>Total Contract Revenue:  </label>

                                                                    </div>

                                                                    <div class="col-md-4">

                                                                        <p id="p_total_contract_revenue_child00"> $0</p>

                                                                    </div>

                                                                </div>


                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="modal fade ModelRecurring_infant00" id="ModelRecurring_infant00" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true">

                                        <div class="modal-dialog editingautopay" role="document">

                                            <div class="modal-content">

                                                <div class="modal-header">

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                        <span aria-hidden="true">&times;</span>

                                                    </button>

                                                </div>

                                                <div class="modal-body">

                                                    <div class="row">

                                                        <div class="col-md-12">

                                                            <div class="editingautopay">

                                                                <h5 class="modal-title" id="ModelRecurringTitle_infant00">Editing Recurring Payments Contract Settings for ("Infant")  </h5>

                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-8">

                                                            <div class="Settings-title">

                                                                <h5> Settings </h5>

                                                            </div>

                                                            <div class="setting-box">

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">How often will customers be charged?</label>

                                                                    </div>

                                                                    <div class="col-md-8">
                                                                        <select class="form-control" name="recurring_customer_chage_by_infant_00" id="recurring_customer_chage_by_infant00">
                                                                            <option value="1 Week" >1 week</option>
                                                                            <option value="2 Week" >2 week</option>
                                                                            <option value="1 Month" >1 Month</option>
                                                                            <option value="3 Month" >3 Month</option>
                                                                            <option value="6 Month" >6 Month</option> 
                                                                            <option value="1 Year" >1 Year</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">Number of autopays  </label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <div class="nuberofautopays">

                                                                            <input type="text" class="form-control valid" name="nuberofautopays_infant_00" id="nuberofautopays_infant00" placeholder="12" value="" oninput="getnumberofpmt(0,0,'infant');">

                                                                        </div>

                                                                        <div class="contract">

                                                                            <label>  Total duration of contract: </label>

                                                                            <p id="total_duration_infant00">0 months</p>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings" id="contractsettings_infant00">What happens after payments?</label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <div class="autopay">

                                                                            <input type="radio" id="happens_aftr_12_pmt_infant00" name="happens_aftr_12_pmt_infant_00" value="contract_expire">

                                                                            <label for="contract">Contract Expires</label><br>

                                                                            <input type="radio" id="happens_aftr_12_pmt_infant00" name="happens_aftr_12_pmt_infant_00" value="contract_renew" >

                                                                            <label for="renews" id="renew_infant00">Contract Automaitcally Renews Every payments</label><br> 

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="row set-78">

                                                                    <div class="col-md-4">

                                                                        <label class="contractsettings">When will clients be charged?</label>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <div class="saledate">
                                                                            <!-- <input type="hidden" name="client_be_charge_on_infant_00" id="client_be_charge_on_infant_00" value="On the sale date">
                                                                                <p>On the sale date </p> -->
                                                                            <select class="form-control" name="client_be_charge_on_infant_00" id="client_be_charge_on_infant00">
                                                                                <option value="sale date" @if($recurring_client_be_charge_on_infant == 'sale date') selected @endif>On the sale date </option> 
                                                                                <option value="1stday" @if($recurring_client_be_charge_on_infant == '1stday') selected @endif> 1st Day of the Month</option>
                                                                                <option value="15thday" @if($recurring_client_be_charge_on_infant == '15thday') selected @endif> 15th Day of the Month</option> 
                                                                            </select>
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>

                                                        <div class="col-md-4">

                                                            <div class="Settings-title">

                                                                <h5> Contract Review </h5>

                                                            </div>

                                                            <div class="setting-box">

                                                                <div class="set-border">

                                                                    <div class="row">

                                                                        <div class="col-md-8">

                                                                            <p id="p_price_title_infant00"></p>

                                                                        </div>

                                                                        <div class="col-md-4">

                                                                            <p  id="p1_price_infant00">$0</p>

                                                                        </div>

                                                                    </div>

                                                                </div>

                                                                <div class="row">

                                                                    <div class="col-md-12">

                                                                        <div class="Settings-title">

                                                                            <h5> Revenue Breakdown </h5>

                                                                        </div>

                                                                    </div>

                                                                    <div class="col-md-10">

                                                                        <p id="trems_payment_infant00">Terms: 12 Monthly Payments</p>

                                                                    </div>

                                                                    <div class="col-md-8">

                                                                        <p>First Payment:</p>

                                                                    </div>

                                                                    <div class="col-md-4">

                                                                        <p id="p_first_pmt_infant00">$0</p>

                                                                    </div>

                                                                    <input type="hidden" name="first_pmt_infant_00" id="first_pmt_infant00" value="">

                                                                    <input type="hidden" name="recurring_pmt_infant_00" id="recurring_pmt_infant00" value="">

                                                                    <div class="col-md-8">

                                                                        <p>Recurring Payment: </p>

                                                                    </div>

                                                                    <div class="col-md-4">

                                                                        <p id="p_recurring_pmt_infant00">$0</p>

                                                                    </div>

                                                                    <input type="hidden" name="total_contract_revenue_infant_00" id="total_contract_revenue_infant00" value="">

                                                                    <div class="col-md-8">

                                                                        <label>Total Contract Revenue:  </label>

                                                                    </div>

                                                                    <div class="col-md-4">

                                                                        <p id="p_total_contract_revenue_infant00"> $0</p>

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

                            <div  class="row">
                                <div class="col-md-12">
                                    <div class="addanother">
                                        <a class="" onclick=" return add_another_price_ages(0);"> +Add Another Session </a>
                                    </div>  
                                </div>
                            </div>
                        </div>

                    <?php } ?>

                    </div>

                    <div class="row">

                        <div class="col-md-12">

                            <div class="btn-cart-price">

                                <a class="showall-btn add-cate add-another-category-price">Add Another Category Price Options</a>

                                <p>This catagory price option is different from above</p>

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <button type="button" class="btn-bck" id="backindividual5"><i class="fa fa-arrow-left"></i> Back</button>

                        </div>

                        <div class="col-md-6 text-right"> 

                            <button type="submit" class="btn-nxt" id="nextindividual5">Save & Continue<i class="fa fa-arrow-right"></i></button>

                        </div>

                    </div>

                    <br>

                </div>


                <div id="addins" class="modal modaladdins kickboxing-more-one" tabindex="-1">
                    <div class="modal-dialog rating-star" role="document">
                        <div class="modal-content">
                            <div class="modal-header" style="padding:10px 36px 10px 11px!important; text-align: right;min-height: 40px;">
                                <h3>Add Instructor</h3>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <span class="error" id="addinserro"> </span>
                                <div class="rev-post-box">
                                    <form method="post" enctype="multipart/form-data" name="addinsform" id="addinsform" >
                                    @csrf
                                        <input type="text" name="insname" id="insname" placeholder="Instructor Name" class="inputs" /> 
                                        <input type="text" name="insemail" id="insemail" placeholder="Instructor Email" class="inputs" />
                                        <textarea placeholder="Description" name="insdescription" id="insdescription"></textarea>
                                        <input type="file" name="insimg" id="insimg" class="inputs" />
                                        <div class="error" id="addinserro"> </div>
                                        <input type="button" onclick="submit_staffmember()" value="Submit" class="btn rev-submit-btn mt-10" id="submit_member">
                                    </form>
                                </div>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="container-fluid p-0" id="classesDiv1" style="display: none;"></div>

                <div class="container-fluid p-0" id="classesDiv2" style="display: none;"></div>

                <div class="container-fluid p-0" id="classesDiv3" style="display: none;"></div>

                <div class="container-fluid p-0" id="classesDiv4" style="display: none;"></div>

                <div class="container-fluid p-0" id="classesDiv5" style="display: none;"></div>

                

                <div class="container-fluid p-0" id="experiencesDiv1" style="display: none;">

                    <div class="tab-hed">Create Services & Prices</div>

                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">

                        <span class="individualTxt nav-link1 subtab" style="{{ ($service_type=='individual')?'color:red':'' }}">PERSONAL TRAINER</span>

                        <?php /* ?> <span class="classesTxt nav-link1 subtab1" style="{{ ($service_type=='classes')?'color:red':'' }}">GYM/STUDIO</span> <?php */ ?>

                       <span class="classesTxt nav-link1 subtab1" style="{{ ($service_type=='classes')?'color:red':'' }}">CLASSES</span>

                        <span class="experienceTxt nav-link1 subtab2" style="{{ ($service_type=='experience')?'color:red':'' }}">EXPERIENCE</span>
                        <span class="eventsTxt nav-link1 subtab3" style="{{ ($service_type=='events')?'color:red':'' }}">EVENTS</span>

                    </div>

                    <section class="row">

                        <div class="col-md-4">

                            <br/><br/><br/>

                            <select name="frm_servicesport1" id="frm_servicesport1" class="form-control" autocomplete="off">

                                <option value="">Choose a Sport/Activity</option>

                                <option {{ ($sport_activity=='Aerobics')?'selected':''}}>Aerobics</option>

                                <option {{ ($sport_activity=='Archery')?'selected':''}}>Archery</option>

                                <option {{ ($sport_activity=='Badminton')?'selected':''}}>Badminton</option>

                                <option {{ ($sport_activity=='Barre')?'selected':''}}>Barre</option>

                                <option {{ ($sport_activity=='Baseball')?'selected':''}}>Baseball</option>

                                <option {{ ($sport_activity=='Basketball')?'selected':''}}>Basketball</option>

                                <option {{ ($sport_activity=='Beach Vollyball')?'selected':''}}>Beach Vollyball</option>

                                <option {{ ($sport_activity=='Bouldering')?'selected':''}}>Bouldering</option>

                                <option {{ ($sport_activity=='Bungee Jumping')?'selected':''}}>Bungee Jumping</option>

                                <optgroup label="Camps &amp; Clinics">

                                    <option {{ ($sport_activity=='Day Camp')?'selected':''}}>Day Camp</option>

                                    <option {{ ($sport_activity=='Sleep Away')?'selected':''}}>Sleep Away</option>

                                    <option {{ ($sport_activity=='Winter Camp')?'selected':''}}>Winter Camp</option>

                                </optgroup>

                                <option {{ ($sport_activity=='Canoeing')?'selected':''}}>Canoeing</option>

                                <optgroup label="Cycling">

                                    <option {{ ($sport_activity=='Indoor cycling')?'selected':''}}>Indoor cycling</option>

                                </optgroup>

                                <option {{ ($sport_activity=='Dance')?'selected':''}}>Dance</option>

                                <option {{ ($sport_activity=='Diving')?'selected':''}}>Diving</option>

                                <optgroup label="Field Hockey">

                                    <option {{ ($sport_activity=='Ice Hockey')?'selected':''}}>Ice Hockey</option>

                                </optgroup>

                                <option {{ ($sport_activity=='Football')?'selected':''}}>Football</option>

                                <option {{ ($sport_activity=='Golf')?'selected':''}}>Golf</option>

                                <option {{ ($sport_activity=='Gymnastics')?'selected':''}}>Gymnastics</option>

                                <option {{ ($sport_activity=='Hang Gliding')?'selected':''}}>Hang Gliding</option>

                                <option {{ ($sport_activity=='Hiit')?'selected':''}}>Hiit</option>

                                <option {{ ($sport_activity=='Hiking - Backpacking')?'selected':''}}>Hiking - Backpacking</option>

                                <option {{ ($sport_activity=='Horseback Riding')?'selected':''}}>Horseback Riding</option>

                                <option {{ ($sport_activity=='Ice Skating')?'selected':''}}>Ice Skating</option>

                                <option {{ ($sport_activity=='Kayaking')?'selected':''}}>Kayaking</option>

                                <option {{ ($sport_activity=='lacrosse')?'selected':''}}>lacrosse</option>

                                <option {{ ($sport_activity=='Laser Tag')?'selected':''}}>Laser Tag</option>

                                <optgroup label="Martial Arts">

                                    <option {{ ($sport_activity=='Boxing')?'selected':''}}>Boxing</option>

                                    <option {{ ($sport_activity=='Jiu-Jitsu')?'selected':''}}>Jiu-Jitsu</option>

                                    <option {{ ($sport_activity=='Karate')?'selected':''}}>Karate</option>

                                    <option {{ ($sport_activity=='Kick Boxing')?'selected':''}}>Kick Boxing</option>

                                    <option {{ ($sport_activity=='Kung Fu')?'selected':''}}>Kung Fu</option>

                                    <option {{ ($sport_activity=='MMA')?'selected':''}}>MMA</option>

                                    <option {{ ($sport_activity=='Self-Defense')?'selected':''}}>Self-Defense</option>

                                    <option {{ ($sport_activity=='Tai Chi')?'selected':''}}>Tai Chi</option>

                                    <option {{ ($sport_activity=='Wrestling')?'selected':''}}>Wrestling</option>

                                </optgroup>

                                <option {{ ($sport_activity=='Massage Therapy')?'selected':''}}>Massage Therapy</option>

                                <option {{ ($sport_activity=='Nutrition')?'selected':''}}>Nutrition</option>

                                <option {{ ($sport_activity=='Paint Ball')?'selected':''}}>Paint Ball</option>

                                <option {{ ($sport_activity=='Physical Therapy')?'selected':''}}>Physical Therapy</option>

                                <option {{ ($sport_activity=='Pilates')?'selected':''}}>Pilates</option>

                                <option {{ ($sport_activity=='Rafting')?'selected':''}}>Rafting</option>

                                <option {{ ($sport_activity=='Rapelling')?'selected':''}}>Rapelling</option>

                                <option {{ ($sport_activity=='Rock Climbing')?'selected':''}}>Rock Climbing</option>

                                <option {{ ($sport_activity=='Rowing')?'selected':''}}>Rowing</option>

                                <option {{ ($sport_activity=='Running')?'selected':''}}>Running</option>

                                <optgroup label="Sightseeing Tours">

                                    <option {{ ($sport_activity=='Airplane Tour')?'selected':''}}>Airplane Tour</option>

                                    <option {{ ($sport_activity=='ATV Tours')?'selected':''}}>ATV Tours</option>

                                    <option {{ ($sport_activity=='Boat Tours')?'selected':''}}>Boat Tours</option>

                                    <option {{ ($sport_activity=='Bus Tour')?'selected':''}}>Bus Tour</option>

                                    <option {{ ($sport_activity=='Caving Tours')?'selected':''}}>Caving Tours</option>

                                    <option {{ ($sport_activity=='Helicopter Tour')?'selected':''}}>Helicopter Tour</option>

                                </optgroup>

                                <option {{ ($sport_activity=='Sailing')?'selected':''}}>Sailing</option>

                                <option {{ ($sport_activity=='Scuba Diving')?'selected':''}}>Scuba Diving</option>

                                <option {{ ($sport_activity=='Sky diving')?'selected':''}}>Sky diving</option>

                                <option {{ ($sport_activity=='Snow Skiing')?'selected':''}}>Snow Skiing</option>

                                <option {{ ($sport_activity=='Snowboarding')?'selected':''}}>Snowboarding</option>

                                <option {{ ($sport_activity=='Strength')?'selected':''}}>Strength &amp; Conditioning</option>

                                <option {{ ($sport_activity=='Surfing')?'selected':''}}>Surfing</option>

                                <option {{ ($sport_activity=='Swimming')?'selected':''}}>Swimming</option>

                                <option {{ ($sport_activity=='Tennis')?'selected':''}}>Tennis</option>

                                <option {{ ($sport_activity=='Tours')?'selected':''}}>Tours</option>

                                <option {{ ($sport_activity=='Vollyball')?'selected':''}}>Vollyball</option>

                                <option {{ ($sport_activity=='Weight training')?'selected':''}}>Weight training</option>

                                <option {{ ($sport_activity=='Windsurfing')?'selected':''}}>Windsurfing</option>

                                <option {{ ($sport_activity=='Yoga')?'selected':''}}>Yoga</option>

                                <option {{ ($sport_activity=='Zip-Line')?'selected':''}}>Zip-Line</option>

                                <option {{ ($sport_activity=='Zumba')?'selected':''}}>Zumba</option>

                            </select>

                            <span class="error" id="err_frm_servicesport1"></span>

                            <br/>

                            <input type="text" name="frm_servicetitle_two1" id="frm_servicetitle_two1" placeholder="Name of Program" title="servicetitle1" value="{{ $program_name }}" class="form-control">

                            <span class="error" id="err_frm_servicetitle_two1"></span>

                            <br/><br/>

                            <div class="text-center"> <label>No Service Added Yet.<br>

                                    Get started by selecting Add Activity Category to choose the activity.</label></div>

                        </div>

                        <div class="col-md-8 text-justify" style="padding: 10px 40px;">

                            <br>

                            <br>

                            <p>

                                Let's create your itinerary, service details and prices for your experience. <br>

                                Let customers know what the plans are. Describe what you will do with your customers. <br>

                                What unique details set it apart from other similar experiences? How will you make customers feel included and engaged during your time together? Being specific about what guests will do on your activity. Set up a detailed itinerary so that guests know what to expect.

                            </p>

                            <h3>Recommended Tips to Do :</h3>

                            <p>- Create an experience around your activity.</p>

                            <p>- Make in unique and different</p>

                            <p>- Think about your meet-up points, how customers will get to you.</p>

                            <p>- Think about what your experience includes and what your customers will need to bring.</p>

                            <p>- Think about your plans and think about the experience your customer will have</p>

                            <h3>Tips Not to Do :</h3>

                            <p>- Having no experience planned around your activity</p>

                            <p>- Not having a well-planned experience.</p>

                            <p>- Giving incomplete information is not recommended.</p>

                            <p>- Creating generic experience and activities customers can easily do on their own.</p>

                            <p>- Offering an experience you are not qualified or skilled to host.</p>

                        </div>

                        <div class="col-md-12">

                            <br>

                            <div class="row">

                                <div class="col-md-6">

                                    <button type="button" class="btn-bck" id="backexperiences1"><i class="fa fa-arrow-left"></i> Back</button>

                                </div>

                                <div class="col-md-6 text-right">

                                    <button type="button" class="btn-nxt" id="nextexperiences1">Continue <i class="fa fa-arrow-right"></i></button>

                                </div>

                            </div>

                            <br>

                        </div>

                    </section>

                </div>
            </form>

            

            <form id="bookingInfo" name="bookingInfo" method="post" action="{{route('addbusinessbooking')}}">

                @csrf

                <input type="hidden" name="userid" id="userid" value="{{Auth::user()->id}}">

                <input type="hidden" name="cid" value="{{Auth::user()->cid}}">

                <input type="hidden" name="serviceid" value="{{Auth::user()->serviceid}}">

                <input type="hidden" name="bstep" id="bstep8" value="{{Auth::user()->bstep}}">

                <div class="container-fluid p-0" id="bookingInfodiv" style="display: none;">

                    <div class="tab-hed">Booking Info</div>

                    <hr style="border: 15px solid black;width: 104%;margin-left: -38px;">

                    <section class="row">

                        <div class="col-md-12">

                            <div class="row">

                                <div class="booking_info_section">

                                    <div class="bookings-block">

                                        <nav>

                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">

                                                <a class="nav-item nav-link" data-toggle="tab" href="#activity-schedule">Activity Schedule</a>

                                                <a class="nav-item nav-link" data-toggle="tab" href="#account-info">Client Account Info.</a>

                                                <a class="nav-item nav-link" data-toggle="tab" href="#pending">Pending</a>

                                                <a class="nav-item nav-link" data-toggle="tab" href="#quotes">Quotes</a>

                                                <a class="nav-item nav-link" data-toggle="tab" href="#completed">Completed</a>

                                                <a class="nav-item nav-link" data-toggle="tab" href="#cancelled">Cancelled</a>

                                                <a class="nav-item nav-link active" data-toggle="tab" href="#checkout">Checkout</a>

                                            </div>

                                        </nav>

                                        

                                        <div class="tab-content" id="nav-tabContent">

                                            

                                            <div class="tab-pane" id="activity-schedule">

                                                <h4>Pending</h4>

                                            </div>

                                            

                                            <div class="tab-pane" id="account-info">

                                                <h4>Pending</h4>

                                            </div>

            

                                            <div class="tab-pane" id="pending">

                                                <h4>Pending</h4>

                                            </div>



                                            <div class="tab-pane" id="quotes">

                                                <h4>Quotes</h4>

                                            </div>



                                            <div class="tab-pane" id="completed">

                                                <h4>Completed</h4>

                                            </div>



                                            <div class="tab-pane" id="cancelled">

                                                <h4>Cancelled</h4>

                                            </div>



                                            <div class="tab-pane in active" id="checkout">

                                                <div class="showentrie_block col-md-12">

                                                    <div class="showentries_date_block">

                                                        <div class="show_block">

                                                            <input type="text" name="" id="" class="form-control" placeholder="Select which client is making a purchase?">

                                                            <a class="submit-btn" data-toggle="modal" data-target="#myModal">Add New Client</a>

                                                        </div>

                                                    </div>



                                                    <div class="bookings-walksale-block">

                                                        <div class="col-md-6 col-sm-12 col-xs-12">

                                                            <div class="walkinsale-block">

                                                                <div class="clientname">

                                                                    <b>Client Name:</b> Lisa Santana or Walk-In-Sale

                                                                </div>



                                                                <div class="clientcategory">

                                                                    <select name="clientservice" id="clientservice" multiple>

                                                                        <option value="" hidden>Select Service Catagory</option>

                                                                        <option value="0">Service Catagory1</option>

                                                                        <option value="1">Service Catagory2</option>

                                                                        <option value="2">Service Catagory3</option>

                                                                        <option value="3">Service Catagory4</option>

                                                                        <option value="4">Service Catagory5</option>

                                                                        <option value="5">Service Catagory6</option>

                                                                    </select>

                                                                    <select name="clientprograme" id="clientprograme" multiple>

                                                                        <option value="" hidden>Select Program Name</option>

                                                                        <option value="0">Program Name1</option>

                                                                        <option value="1">Program Name2</option>

                                                                        <option value="2">Program Name3</option>

                                                                        <option value="3">Program Name4</option>

                                                                        <option value="4">Program Name5</option>

                                                                        <option value="5">Program Name6</option>

                                                                    </select>



                                                                    <script>

                                                                        var p = new SlimSelect({

                                                                            select: '#clientservice'

                                                                        });

                                                                        var p = new SlimSelect({

                                                                            select: '#clientprograme'

                                                                        });

                                                                    </script>

                                                                </div>

                                                                <div class="priceblock-client">

                                                                    <div class="form-group">

                                                                        <label>Price</label>

                                                                        <input type="text" name="" id="" value="$1200.00" class="form-control">

                                                                    </div>

                                                                    <div class="form-group">

                                                                        <label>Discount</label>

                                                                        <input type="text" name="" id="" class="form-control">

                                                                        <select name="amount" id="amount" multiple>

                                                                            <option value="" hidden>Amount</option>

                                                                            <option value="0">Dollar</option>

                                                                        </select>

                                                                        <script>

                                                                            var p = new SlimSelect({

                                                                                select: '#amount'

                                                                            });

                                                                        </script>

                                                                    </div>

                                                                    <div class="form-group">

                                                                        <label>Participant Count</label>

                                                                        <select name="count" id="count" multiple>

                                                                            <option value="" hidden>Select</option>

                                                                            <option value="0">Count 1</option>

                                                                            <option value="0">Count 2</option>

                                                                            <option value="0">Count 3</option>

                                                                        </select>

                                                                        <script>

                                                                            var p = new SlimSelect({

                                                                                select: '#count'

                                                                            });

                                                                        </script>

                                                                    </div>

                                                                    <div class="form-group">

                                                                        <label>Who's Participanting?</label>

                                                                        <select name="participanting" id="participanting" multiple>

                                                                            <option value="" hidden>Select</option>

                                                                            <option value="0">Participanting 1</option>

                                                                            <option value="0">Participanting 2</option>

                                                                            <option value="0">Participanting 3</option>

                                                                        </select>

                                                                        <script>

                                                                            var p = new SlimSelect({

                                                                                select: '#participanting'

                                                                            });

                                                                        </script>

                                                                    </div>

                                                                    <hr/>

                                                                    <h3>Detail Summary</h3>

                                                                    <div class="participants-two">

                                                                        <span>Participants</span>

                                                                        <span>2</span>

                                                                    </div>

                                                                    <div class="participants-two">

                                                                        <span>Subtotal</span>

                                                                        <span>$1200.00</span>

                                                                    </div>

                                                                    <div class="participants-two">

                                                                        <span>Discount</span>

                                                                        <span>$0.00</span>

                                                                    </div>

                                                                    <div class="participants-two">

                                                                        <span>Tax No Tax</span>

                                                                        <span>$54.00</span>

                                                                    </div>

                                                                    <div class="participants-two">

                                                                        <span>Service Fee</span>

                                                                        <span>12%</span>

                                                                    </div>

                                                                    <div class="participants-two">

                                                                        <span>Total</span>

                                                                        <span>$1.398</span>

                                                                    </div>

                                                                    <div class="participants-two">

                                                                        <a href="#" class="addticket">Add To Ticket</a>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>



                                                        <div class="col-md-6 col-sm-12 col-xs-12">

                                                            <div class="ticket-itemsblock">

                                                                <h2>Ticket Items</h2>

                                                                <div class="itembox">

                                                                    <h4>Item 1</h4>

                                                                    <p>

                                                                        <span>Service Catagory:</span>

                                                                        <span>Class</span>

                                                                    </p>

                                                                    <p>

                                                                        <span>Program Name:</span>

                                                                        <span>Kickboxing for Adults</span>

                                                                    </p>

                                                                    <p>

                                                                        <span>Who's Participating</span>

                                                                        <span>Lisa Santana (30), Eric Santana (45)</span>

                                                                    </p>

                                                                    <p>

                                                                        <span>Participants</span>

                                                                        <span>2</span>

                                                                    </p>

                                                                    <h3>

                                                                        <span>Subtotal</span>

                                                                        <span>$1200.00</span>

                                                                    </h3>

                                                                    <h3>

                                                                        <span>Discount</span>

                                                                        <span>$0.00</span>

                                                                    </h3>

                                                                    <h3>

                                                                        <span>Taxes & Service Fee</span>

                                                                        <span>$198.00</span>

                                                                    </h3>

                                                                    <h3>

                                                                        <span>Total</span>

                                                                        <span>$1,398</span>

                                                                    </h3>

                                                                </div>



                                                                <div class="total-boxes">

                                                                    <div class="totalbox">

                                                                        <h5>Sub Total</h5>

                                                                        <h4>$1200</h4>

                                                                    </div>

                                                                    <div class="totalbox">

                                                                        <h5>Discounts</h5>

                                                                        <h4>$0.00</h4>

                                                                    </div>

                                                                    <div class="totalbox">

                                                                        <h5>Tax & Service Fee</h5>

                                                                        <h4>$198.00</h4>

                                                                    </div>

                                                                    <div class="totalbox">

                                                                        <h5>Grand Total</h5>

                                                                        <h4>$1,398</h4>

                                                                    </div>

                                                                </div>



                                                                <div class="paymentmethod">

                                                                    <p>Select Payment Method</p>

                                                                    <a href="#">CC (Input Card)</a>

                                                                    <a href="#">CC (Stored Card)</a>

                                                                </div>

                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <!--

                                        <div id="myModal" class="modal addclient-modal" role="dialog">

                                            <div class="modal-dialog modal-lg" role="document">

                                                <div class="modal-content">

                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 leftblock">

                                                        <div class="modal-header">

                                                            <h5 class="modal-title" id="exampleModalLabel">Add New Client</h5>

                                                        </div>

                                                        <div class="modal-body">

                                                            <p>STEP 1 OF 5</p>

                                                            <form>

                                                                <div class="form-group pleftright">

                                                                    <input type="text" name="" id="" class="form-control" placeholder="First Name">

                                                                </div>

                                                                <div class="form-group pleftright">

                                                                    <input type="text" name="" id="" class="form-control" placeholder="Last Name">

                                                                </div>

                                                                <div class="form-group pleftright">

                                                                    <input type="text" name="" id="" class="form-control" placeholder="User Name">

                                                                </div>

                                                                <div class="form-group pleftright">

                                                                    <input type="email" name="" id="" class="form-control" placeholder="Email Address">

                                                                </div>

                                                                <div class="form-group pleftright">

                                                                    <input type="number" name="" id="" class="form-control" placeholder="Phone">

                                                                </div>

                                                                <div class="form-group pleftright">

                                                                    <input type="password" name="" id="" class="form-control" placeholder="Password">

                                                                </div>

                                                                <div class="form-group pleftright">

                                                                    <input type="password" name="" id="" class="form-control" placeholder="Confirm Password">

                                                                </div>

                                                                <div class="form-group pleftright">

                                                                    <label for="agree">

                                                                        <input type="checkbox" id="agree" name=""> <span>I AGREE TO FITNESSITY <b> TERMS OF SERVICE</b> AND <b> PRIVACY POLICY</b></span>

                                                                    </label>

                                                                </div>

                                                                <div class="form-group text-center">

                                                                    <input type="submit" name="" id="" value="CREATE ACCOUNT" class="submit-btn">

                                                                </div>

                                                            </form>

                                                        </div>

                                                    </div>

                                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 blackright">

                                                        <div class="modal-header">

                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                                                <span aria-hidden="true">&times;</span>

                                                            </button>

                                                        </div>

                                                        <div class="modal-body">

                                                            <h3>Search For Client On Fitnessity</h3>

                                                            <p>*Your client could already have a profile on Fitnessity*</p>

                                                            <form>

                                                                <div class="form-group">

                                                                    <input type="search" name="" id="" class="searchbox">

                                                                </div>

                                                            </form>

                                                        </div>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        -->



                                    </div>



                                </div>



                            </div>

                            <div class="col-md-12">

                                <br>

                                <div class="row">

                                    <div class="col-md-6">

                                        <button type="button" class="btn-bck" id="book-back1"><i class="fa fa-arrow-left"></i> Back</button>

                                    </div>

                                    <div class="col-md-6 text-right">

                                        <button type="submit" class="btn-nxt" id="book-nxt1">Save & Preview <i class="fa fa-arrow-right"></i></button>

                                    </div>

                                </div>

                                <br>

                            </div>

                        </div>

                    </section>

                </div>

            </form>
        </div>

    </div>

</div>

<div class="modal" id="edit_post" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body login-pad">  
                <div class="pop-title employe-title"><h3>Edit Photo</h3></div>
                <button type="button" class="close modal-close modelboxclose" data-dismiss="modal">
                    <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                </button>
                <div>                  
                    <div class="loadMore">
                        <div class="central-meta item">
                            <div class="user-post">
                                <form method="post" action="{{route('activityimgupdate')}}" enctype="multipart/form-data" >
                                    @csrf
                                    <div class="friend-info">      
                                        <div class="post-meta" id="edit_image"></div>
										<div class="row">
											<div class="col-md-12 align-self-modal">
												<button class="post-btn align-width" type="submit" data-ripple="">Update</button>
											</div>
										</div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')




<script>

//for selecting days nnn
//$(".timezone-round").click(function() {

$('body').delegate('.timezone-round','click',function(){  

   

  if($('#frm_class_meets').val()=='Weekly')

  {   

    if($(this).hasClass("day_circle_fill"))

      $(this).removeClass('day_circle_fill');

    else

      $(this).addClass('day_circle_fill');

  }

});



$('body').delegate('.subtab','click',function(){

    $(".individualBody").show();
    $(".classesBody").hide();
    $(".experienceBody").hide();
    $(".eventsBody").hide();

    $('#service_type').val('individual');
    $(".subtab").css("color", "red");
    $(".subtab1").css("color", "white");
    $(".subtab2").css("color", "white");
    $(".subtab3").css("color", "white");

    var curr_tab=$('#current_tab_name').val();

    $("#"+curr_tab).hide();
    $("#individualDiv2").hide();

    $("#individualDiv0").show();

    $('#current_tab_name').val('individualDiv0');
});

$('body').delegate('.subtab1','click',function(){

    $(".individualBody").hide();
    $(".classesBody").show();
    $(".experienceBody").hide();
    $(".eventsBody").hide();

    $('#service_type').val('classes');
    $(".subtab").css("color", "white");
    $(".subtab1").css("color", "red");
    $(".subtab2").css("color", "white");
    $(".subtab3").css("color", "white");

    var curr_tab=$('#current_tab_name').val();

    $("#"+curr_tab).hide();

    $("#individualDiv2").hide();
    $("#individualDiv0").show();

    $('#current_tab_name').val('individualDiv0');
});

$('body').delegate('.subtab2','click',function(){
    $(".individualBody").hide();
    $(".classesBody").hide();
    $(".experienceBody").show();
    $(".eventsBody").hide();
  
    $('#service_type').val('experience');
    $(".subtab").css("color", "white");
    $(".subtab1").css("color", "white");
    $(".subtab2").css("color", "red");
    $(".subtab3").css("color", "white");

    var curr_tab=$('#current_tab_name').val();
    $("#"+curr_tab).hide();

    $("#individualDiv2").hide();
    $("#individualDiv0").show();
    $('#current_tab_name').val('individualDiv0');
});

$('body').delegate('.subtab3','click',function(){
    $(".individualBody").hide();
    $(".classesBody").hide();
    $(".experienceBody").hide();
    $(".eventsBody").show();
  
    $('#service_type').val('events');
    $(".subtab").css("color", "white");
    $(".subtab1").css("color", "white");
    $(".subtab2").css("color", "white");
    $(".subtab3").css("color", "red");

    var curr_tab=$('#current_tab_name').val();
    $("#"+curr_tab).hide();

    $("#individualDiv2").hide();
    $("#individualDiv0").show();
    $('#current_tab_name').val('individualDiv0');
});

</script>



<script src="https://code.jquery.com/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>

<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<!--

<link rel="stylesheet" type="text/css" href="/public/css/zebra_datepicker.min.css" />

<script src="/public/js/zebra_datepicker.min.js"></script>

-->    

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/css/default/zebra_datepicker.min.css" type="text/css">

<script src="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/zebra_datepicker.min.js"></script>

<style>.Zebra_DatePicker_Icon_Wrapper{width:100%!important}</style>

<script src="{{ url('public/js/scripts.js') }}"></script>

<!-- <script src="{{ url('public/js/jquery.min.map.js') }}"></script> -->



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" type="text/css">

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<style>.manual-remove{width:100%}</style>

<!-- Updated JavaScript url -->

<script src="//jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>

<script type="text/javascript">

   

  var specialKeys = new Array();

    specialKeys.push(8); //Backspace

    function digitKeyOnly(e) {

        var keyCode = e.which ? e.which : e.keyCode

        var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);

        document.getElementById("err_late_fee").style.display = ret ? "none" : "inline";

        return ret;

    }

  
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


    function readServicePic(input) { 

        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function(e) {

                $('.blah').attr('src', e.target.result);

                $("#oldservicepic").val(e.target.result);

                var html = '<img src="' + e.target.result + '">';

                $('.uploadedpic').html(html);

            };

            profile_pic_var = input.files[0];

            reader.readAsDataURL(input.files[0]);

        }

    }

    function readServicePic2(input) { //alert(input);

        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function(e) {

                $('.blah2').attr('src', e.target.result);

        //input.closest('.divImgPreview').html('<img src="'+e.target.result+'">');

        $("#oldservicepic").val(e.target.result);

                var html = '<img src="' + e.target.result + '">';

                $('.uploadedpic2').html(html);

            };

            profile_pic_var = input.files[0];

            reader.readAsDataURL(input.files[0]);

        }

    }

    function planImg(input,cnt) { 
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.planblah'+cnt).attr('src', e.target.result);
                $("#oldservicepic2"+cnt).val(e.target.result);
            };
            profile_pic_var = input.files[0];
            reader.readAsDataURL(input.files[0]);
        }
    }

    function readServicePic1(input) {

        if (input.files && input.files[0]) {

            var reader = new FileReader();

            reader.onload = function(e) {

                $('.blah').attr('src', e.target.result);

                $("#oldservicepic1").val(e.target.result);

                var html = '<img src="' + e.target.result + '">';

                $('.uploadedpic').html(html);

            };

            profile_pic_var = input.files[0];

            reader.readAsDataURL(input.files[0]);

        }

    }

    function initialize() {
        console.log('initialize');
        var geocoder = new google.maps.Geocoder();
        var zipcode = '<?=$ZipCode?>';
        var country = '<?=$Country?>';
        var searchString = "New York";
        if(zipcode != '' || country != '') {
            searchString = zipcode + '&amp;' + country;
        } 
        console.log('searchString', searchString);
        geocoder.geocode( { 'address': searchString}, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            var latitude = results[0].geometry.location.lat();
            var longitude = results[0].geometry.location.lng();
            //var latitude = results[0].geometry.bounds.Bb.h;
            //var longitude = results[0].geometry.bounds.Ra.h;
            console.log('Lat and Long');
            console.log(latitude, longitude);
          } 
        }); 
    }

    function loadMap() {
        console.log("initMap");
        var lat = '40.7127';
        var long = '-74.0060';
        var miles = 20;
        var zoom = 9;
        var geocoder = new google.maps.Geocoder();
        var address = $("#wanttowork").val();
        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == "OK") {
              //  lat = results[0].geometry.bounds.Bb.h;

               // long = results[0].geometry.bounds.Ra.h;
            var lat = results[0].geometry.location.lat();
            var long = results[0].geometry.location.lng();
                console.log(lat + "=" + long);
                var map = new google.maps.Map(document.getElementById("map_canvas"), {
                    zoom: zoom,
                    center: new google.maps.LatLng(lat, long),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });

                //console.log(map);
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
        });
    }

    function loadEmbedMap() {
        var zipcode = '<?=$ZipCode?>';
        var country = '<?=$Country?>';
        var searchString = "New York";

        if(zipcode != '' || country != '') {
            searchString = zipcode + '&amp;' + country;
        } else {
            searchString = ($("#exp_city").val() != "") ? $("#exp_city").val() : "New York";
        }
        var mapURL = "https://maps.google.com/maps?width=400&amp;height=300&amp;hl=en&amp;t=&amp;z=10&amp;ie=UTF8&amp;iwloc=B&amp;output=embed";
        mapURL += "&amp;q=" + searchString;
        //document.getElementById('gmap_iframe').src = mapURL;
        var frame = '<iframe id="gmap_iframe" src="' + mapURL + '" style="border:0;" allowfullscreen="" loading="lazy"></iframe>';
        $(".maploaction-block").html(frame);   
    }
</script>

<script>
    $('body').delegate('.is_recurring_cls','click',function(){
      if($(this).prop("checked"))
      {
        var iid=$(this).attr("data-count");
        $('#btn_recurring'+iid).trigger("click");
      }
    });
</script>

<script type="text/javascript">

    function showdiv(i,j){
        var name = 'sectiondisplay'+i+j;
        var chk = $("input[name='sectiondisplay"+i+j+"']:checked").val();  
        if(chk == 'freeprice'){
            $('#displaysectiondiv'+i+j).css('display','none');
        }else if(chk == 'weekendprice'){
            $('.Weekend'+i+j).css('display','block');
            $('#displaysectiondiv'+i+j).css('display','block');
        }else{
            $('.Weekend'+i+j).css('display','none');
            $('#displaysectiondiv'+i+j).css('display','block');  
        }
    }

    function showlessmore(i,j){
        if($('#showlessmore'+i+j).html() == 'Show Less'){
            $('#showlessmore'+i+j).html('Show More');
            $('#showmorehide'+i+j).css('display','none');
        }else{
            $('#showlessmore'+i+j).html('Show Less');
            $('#showmorehide'+i+j).css('display','block');
        }

    }

    function IsNumeric(evt) {
        var getNumCd = (evt.which) ? evt.which : event.keyCode;
        if (getNumCd != 46 && getNumCd > 31 && (getNumCd < 48 || getNumCd > 57))
        return false;
        return true;
    }

    function pay_session_select(i,j,selectedval){
        if(selectedval=='Single') { 
            $('#pay_session'+i+j).val('1');
            $('#pay_session'+i+j).attr('readonly', true); 
        }

        if(selectedval=='Multiple') {
            $('#pay_session'+i+j).val('0');
            $('#pay_session'+i+j).attr('readonly', false);
        }

        if(selectedval=='Unlimited') {
            $('#pay_session'+i+j).val('10000');
            $('#pay_session'+i+j).attr('readonly', true);
        }
    }

    function setschedule(){
        $("#individualDiv5").hide();
        $("#individualDiv4").show();
    }

    function adultchangeestprice(i,j){
        var adult_discount = 0;
        var pay_price =  $('#adult_cus_weekly_price'+i+j).val();; 
        var adult_discount =  $('#adult_discount'+i+j).val();
        var fitnessity_fee = '{{$fitnessity_fee}}';
        $('#adult_estearn'+i+j).val(pay_price - (pay_price*fitnessity_fee)/100 - (pay_price*adult_discount)/100);s
        $('#adult_estearn'+i+j).attr('readonly', true);
        if(pay_price == ''){
            pay_price = 0;
        }
        $('#p1_price_adult'+i+j).html('$'+pay_price);
        $('#p_total_contract_revenue_adult'+i+j).html('$'+pay_price);
        $('#p_recurring_pmt_adult'+i+j).html('$'+pay_price);
        $('#p_first_pmt_adult'+i+j).html('$'+pay_price);
        $('#first_pmt_adult'+i+j).val(pay_price);
        $('#recurring_pmt_adult'+i+j).val(pay_price);
    }

    function weekendadultchangeestprice(i,j){

        var adult_discount = 0;

        var pay_price =  $('#adult_weekend_price_diff'+i+j).val();; 

        var adult_discount =  $('#adult_discount'+i+j).val();

        var fitnessity_fee = '{{$fitnessity_fee}}';

        $('#weekend_adult_estearn'+i+j).val(pay_price - (pay_price*fitnessity_fee)/100 - (pay_price*adult_discount)/100);

        $('#weekend_adult_estearn'+i+j).attr('readonly', true);

    }

    function adultdischangeestprice(i,j){

        var adult_discount = 0;

        var pricval = 0;

        var week_price =  $('#adult_cus_weekly_price'+i+j).val();

        var priceoff = $('#adult_weekend_price_diff'+i+j).val();

        var adult_discount =  $('#adult_discount'+i+j).val();

        var fitnessity_fee = '{{$fitnessity_fee}}';

        $('#adult_estearn'+i+j).val(week_price - ((week_price * adult_discount)/100 + (week_price*fitnessity_fee)/100));

        $('#adult_estearn'+i+j).attr('readonly', true); 

        $('#weekend_adult_estearn'+i+j).val(priceoff - ((priceoff * adult_discount)/100 + (priceoff*fitnessity_fee)/100));

        $('#weekend_adult_estearn'+i+j).attr('readonly', true);

    }

    function childchangeestprice(i,j){

        var child_discount = 0;

        var pricval = 0;

        var pay_price =  $('#child_cus_weekly_price'+i+j).val();

        var child_discount =  $('#child_discount'+i+j).val();

        var fitnessity_fee = '{{$fitnessity_fee}}';

        $('#child_estearn'+i+j).val(pay_price - (pay_price*fitnessity_fee)/100 - (pay_price*child_discount)/100);

        $('#child_estearn'+i+j).attr('readonly', true);
        if(pay_price == ''){
            pay_price = 0;
        }
        $('#p1_price_child'+i+j).html('$'+pay_price);

        $('#p_total_contract_revenue_child'+i+j).html('$'+pay_price);
        $('#p_recurring_pmt_child'+i+j).html('$'+pay_price);
        $('#p_first_pmt_child'+i+j).html('$'+pay_price);
        $('#first_pmt_child'+i+j).val(pay_price);
        $('#recurring_pmt_child'+i+j).val(pay_price);
    }

    function  weekendchildchangeestprice(i,j){

        var child_discount = 0;

        var pricval = 0;

        var pay_price =  $('#child_weekend_price_diff'+i+j).val();

        var child_discount =  $('#child_discount'+i+j).val();

        var fitnessity_fee = '{{$fitnessity_fee}}';

        $('#weekend_child_estearn'+i+j).val(pay_price - (pay_price*fitnessity_fee)/100 - (pay_price*child_discount)/100);

        $('#weekend_child_estearn'+i+j).attr('readonly', true);

    }

    function childdischangeestprice(i,j){

        var child_discount = 0;

        var pricval = 0;

        var week_price =  $('#child_cus_weekly_price'+i+j).val();

        var priceoff = $('#child_weekend_price_diff'+i+j).val();

        var child_discount =  $('#child_discount'+i+j).val();

        var fitnessity_fee = '{{$fitnessity_fee}}';

        $('#child_estearn'+i+j).val(week_price - ((week_price * child_discount)/100 + (week_price*fitnessity_fee)/100));

        $('#child_estearn'+i+j).attr('readonly', true);

        $('#weekend_child_estearn'+i+j).val(priceoff - ((priceoff * child_discount)/100 + (priceoff*fitnessity_fee)/100));

        $('#weekend_child_estearn'+i+j).attr('readonly', true);

    }

    function infantchangeestprice(i,j){

        var infant_discount = 0;

        var pricval = 0;

        var pay_price =  $('#infant_cus_weekly_price'+i+j).val();

        var infant_discount =  $('#infant_discount'+i+j).val();

        var fitnessity_fee = '{{$fitnessity_fee}}';

        $('#infant_estearn'+i+j).val(pay_price - (pay_price*fitnessity_fee)/100 - (pay_price*infant_discount)/100);

        $('#infant_estearn'+i+j).attr('readonly', true);
        if(pay_price == ''){
            pay_price = 0;
        }
       /* alert(pay_price);*/
        $('#p1_price_infant'+i+j).html('$'+pay_price);

        $('#p_total_contract_revenue_infant'+i+j).html('$'+pay_price);
        $('#p_recurring_pmt_infant'+i+j).html('$'+pay_price);
        $('#p_first_pmt_infant'+i+j).html('$'+pay_price);
        $('#first_pmt_infant'+i+j).val(pay_price);
        $('#recurring_pmt_infant'+i+j).val(pay_price);
    }

    function weekendinfantchangeestprice(i,j){

        var infant_discount = 0;

        var pricval = 0;

        var pay_price =  $('#infant_weekend_price_diff'+i+j).val();

        var infant_discount =  $('#infant_discount'+i+j).val();

        var fitnessity_fee = '{{$fitnessity_fee}}';

        $('#weekend_infant_estearn'+i+j).val(pay_price - (pay_price*fitnessity_fee)/100 - (pay_price*infant_discount)/100);

        $('#weekend_infant_estearn'+i+j).attr('readonly', true);

    }

    function infantdischangeestprice(i,j){

        var infant_discount = 0;

        var pricval = 0;

        var pay_price =  $('#infant_cus_weekly_price'+i+j).val();

        var priceoff = $('#infant_weekend_price_diff'+i+j).val();

        var infant_discount =  $('#infant_discount'+i+j).val();

        var fitnessity_fee = '{{$fitnessity_fee}}';

        $('#infant_estearn'+i+j).val(pay_price - ((pay_price * infant_discount)/100 + (pay_price*fitnessity_fee)/100));

        $('#infant_estearn'+i+j).attr('readonly', true);

        $('#weekend_infant_estearn'+i+j).val(priceoff - ((priceoff * infant_discount)/100 + (priceoff*fitnessity_fee)/100));

        $('#weekend_infant_estearn'+i+j).attr('readonly', true);

    }

    function openmodelbox(i,j,val) {

       var checkBox = document.getElementById("is_recurring_"+val+i+j);

        if (checkBox.checked == true){

            $('#btn_recurring_'+val+i+j).trigger("click");

            $('#is_recurring_'+val+i+j).val(1);

        }else{

            $('#is_recurring_'+val+i+j).val(0);

        }

    }

    function recurrint_id(i,j,val) {

       /* alert(val);*/

        $('#btn_recurring_'+val+i+j).attr("data-target","#ModelRecurring_"+val+i+j);

    }

    function add_another_price_duplicate_session(i){
        var cnt = $('#ages_count'+i).val();
        var cnt_old = cnt;
        cnt++;
        var data = '';
        data += '<div id="agesdiv'+i+cnt+'">';
        data += $('#agesdiv'+i+cnt_old).html();
        data += '</div>';
        if(i==0){
            var re = data.replaceAll("0"+cnt_old,"0"+cnt);
            re = re.replaceAll("(0,"+cnt_old,"(0,"+cnt);
        }else{
            var re = data.replaceAll(i+cnt_old,i+cnt);
            re = re.replaceAll("("+i+","+cnt_old,"("+i+","+cnt);
        }
        $('#agesmaindiv'+i).append(re);
        if(cnt_old == 0){
            $('#agesdiv'+i+cnt).find('div').first().remove();
            $('#agesdiv'+i+cnt).prepend('<div class="row"><hr style="border: 1px solid #d4cfcf;width: 100%;"><div class="col-md-11"></div><div class="col-md-1"><i class="remove-agediv fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove activity" onclick="remove_agediv('+i+','+cnt+');"></i></div></div>');
        }
        $('#ages_count'+i).val(cnt);
        $('#agesdiv'+i+cnt).find("input[name='price_id_db_"+i+cnt+"']").val('');
        
    }

    function add_another_price_duplicate_category(i){
        var cnt=$('#recurring_count').val();
        var agecnt = $('#ages_count'+cnt).val();
        var cnt_old=cnt;
        cnt++;
        $('#recurring_count').val(cnt);
        var data = '';
        data += '<div id="pricediv'+cnt+'">';
        if(cnt_old == 0){
            data += '<div class="row"><hr style="border: 1px solid #d4cfcf;width: 100%;"><div class="col-md-11"></div><div class="col-md-1"><i class="remove-category-price fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove emp option"></i></div></div>';
        }

        data += $('#pricediv'+cnt_old).html();
        data += '</div>';

        var re = data.replaceAll(cnt_old+"0",cnt+"0");
        if(agecnt == 1){
            re = re.replaceAll(cnt_old+"1",cnt+"1");
        }
        if(agecnt == 2){
            const mapObj = {
                "01": cnt+"1",
                "02": cnt+"2",
            };
            re = re.replace(/\b(?:01|02)\b/gi, matched => mapObj[matched]);
        }
        if(agecnt == 3){
            const mapObj = {
                "01": cnt+"1",
                "02": cnt+"2",
                "03": cnt+"3",
            };
            re = re.replace(/\b(?:01|02|03)\b/gi, matched => mapObj[matched]);
        }

        re = re.replaceAll("agesmaindiv"+cnt_old,"agesmaindiv"+cnt);
        re = re.replaceAll("ages_count"+cnt_old,"ages_count"+cnt);
        var old_i = i;
        i++;
        re = re.replaceAll("("+old_i+")","("+i+")");
        re = re.replaceAll("("+cnt_old+",","("+cnt+",");
        $('.service_price_block').append(re);
        for(var z=0; z<=agecnt ;z++){
            $('#pricediv'+cnt).find("input[name='price_id_db_"+cnt+z+"']").val('');
        }

        $('#pricediv'+cnt).find("input[name='cat_id_db[]']").val('');
    }

    function remove_agediv(i,j) {
        var cnt=$('#ages_count'+i).val();
        cnt--;
        $('#ages_count'+i).val(cnt);
        $('#agesdiv'+i+j).remove(); 
    }

    function add_another_price_ages(i){
        var fitnessity_fee = '{{$fitnessity_fee}}';
        var cnt = $('#ages_count'+i).val();
        /*alert(cnt);*/
        cnt++;
        $('#ages_count'+i).val(cnt);
        var ages_data = "";
        ages_data +='<div id="agesdiv'+i+cnt+'"><div class="row"><hr style="border: 1px solid #d4cfcf;width: 100%;"><div class="col-md-11"></div><div class="col-md-1"><i class="remove-agediv fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove emp option" onclick="remove_agediv('+i+','+cnt+');"></i></div></div><div class="row"><div class="col-md-4"> </div><div class="col-md-5"> </div></div> <input type="hidden" name="price_id_db_'+i+cnt+'" id="price_id_db'+i+cnt+'" value="" /> <div class="row mt-30"><div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Price Title</label><input type="text" name="price_title_'+i+cnt+'" id="price_title'+i+cnt+'"  class="inputs" placeholder="Ex: 6 month Membership" oninput="getpricetitle('+i+','+cnt+')"></div></div><div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Session Type</label><select name="pay_session_type_'+i+cnt+'" id="pay_session_type'+i+cnt+'" class="bd-right bd-bottom pay_session_type" onchange="pay_session_select('+i+','+cnt+',this.value);"><option value="Single">Single</option><option value="Multiple">Multiple</option><option value="Unlimited">Unlimited</option></select></div></div><div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Number of Sessions</label><input type="text" name="pay_session_'+i+cnt+'" id="pay_session'+i+cnt+'"  class="inputs pay_session" placeholder="1"  value="1" readonly></div></div><div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Membership Type</label><select name="membership_type_'+i+cnt+'" id="membership_type'+i+cnt+'" class="bd-right bd-bottom membership_type"><option value="Drop In">Drop In</option><option value="Semester">Semester (Long Term)</option></select></div></div></div> <div class="row"><div class="col-md-12"><div class="setprice sp-select"><div class="row"> <div class="col-md-12"><input type="radio" id="freeprice'+i+cnt+'" name="sectiondisplay'+i+cnt+'" onclick="showdiv('+i+','+cnt+');" value="freeprice"> <label class="recurring-pmt"> Free </label> <input type="radio" id="weekdayprice'+i+cnt+'" name="sectiondisplay'+i+cnt+'" onclick="showdiv('+i+','+cnt+');"  value="weekdayprice" checked> <label class="recurring-pmt"> Everyday Price </label> <input type="radio" id="weekendprice'+i+cnt+'" name="sectiondisplay'+i+cnt+'" onclick="showdiv('+i+','+cnt+');"  value="weekendprice"> <label class="recurring-pmt"> Weekend Price </label></div></div></div></div></div><div id="displaysectiondiv'+i+cnt+'"><div class="row"><div class="col-md-12"><div class="setprice sp-select"> <div class="row"> <div class="col-md-2"><label id="showlessmore'+i+cnt+'" onclick="showlessmore('+i+','+cnt+');">Show Less</label></div><div class="col-md-10"><h3 class="setprice-custom">You can set your prices to be the same or different based on age, the weekday or the weekend.To add prices for children or infants, click on the box.</h3> </div></div></div></div></div><div class="row"><div class="age-cat"><div class="cat-age sp-select"><label>Adults</label><p>Ages 12 & Older</p></div></div><div class="weekly-customer"><div class="cus-week-price sp-select"><label>Weekday Price</label><p> (Monday - Sunday)</p><input type="text" name="adult_cus_weekly_price_'+i+cnt+'" id="adult_cus_weekly_price'+i+cnt+'" placeholder="$"  onkeyup="adultchangeestprice('+i+','+cnt+');"></div></div><div class="weekend-price Weekend'+i+cnt+'" style="display: none;"><div class="cus-week-price sp-select"><label>Weekend Price </label><p> (Saturday & Sunday)</p><input type="text" name="adult_weekend_price_diff_'+i+cnt+'" id="adult_weekend_price_diff'+i+cnt+'" placeholder="$" onkeyup="weekendadultchangeestprice('+i+','+cnt+');"></div></div><div class="re-discount"><div class="discount sp-select"><label>Any Discount? </label><p> (Recommended 10% to 15%)</p><input type="text" name="adult_discount_'+i+cnt+'" id="adult_discount'+i+cnt+'" onkeyup="adultdischangeestprice('+i+','+cnt+');"></div></div><div class="single-dash"><div class="desh sp-select"><label>-</label></div></div><div class="fit-fees"><div class="fees sp-select"><label>Introduction Fee </label><label>Recurring Fee </label><p> 5%</p><p> 1%</p></div></div><div class="single-equal"><div class="equal sp-select"><label>=</label></div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekday Estimated Earnings </label><input type="text" name="adult_estearn_'+i+cnt+'" id="adult_estearn'+i+cnt+'" placeholder="$"></div></div><div class="estimated-earn Weekend'+i+cnt+'"><div class="cus-week-price sp-select"><label>Weekend Estimated Earnings</label><input type="text" name="weekend_adult_estearn_'+i+cnt+'" id="weekend_adult_estearn'+i+cnt+'" placeholder="$" ></div></div><div class="col-md-12"><div class="priceselect sp-select modelmargin">';
        var onclickadult ="'adult'";

        ages_data +='<input class="modelcheckbox"  data-count="0"  type="checkbox" id="is_recurring_adult'+i+cnt+'" name="is_recurring_adult_'+i+cnt+'" value="0" onclick="openmodelbox('+i+','+cnt+','+onclickadult+');" ><label>Is This A Recurring Payment? Set the monthly payment terms for Adults</label><button style="display:none" id="btn_recurring_adult'+i+cnt+'" name="btn_recurring_adult_'+i+cnt+'[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring_adult'+i+cnt+'" onclick="recurrint_id('+i+','+cnt+','+onclickadult+');">Launch demo modal</button></div></div></div><div id="showmorehide'+i+cnt+'"><div class="row"><div class="age-cat"><div class="cat-age sp-select"><label>Children</label><p>Ages 2 to 12</p></div></div><div class="weekly-customer"><div class="cus-week-price sp-select"><label>Weekday Price</label><p> (Monday - Sunday)</p><input type="text" name="child_cus_weekly_price_'+i+cnt+'" id="child_cus_weekly_price'+i+cnt+'" placeholder="$" onkeyup="childchangeestprice('+i+','+cnt+');"></div></div><div class="weekend-price Weekend'+i+cnt+'" style="display: none;"><div class="cus-week-price sp-select"><label>Weekend Price</label><p> (Saturday & Sunday)</p><input type="text" name="child_weekend_price_diff_'+i+cnt+'" id="child_weekend_price_diff'+i+cnt+'" placeholder="$" onkeyup="weekendchildchangeestprice('+i+','+cnt+');"></div></div><div class="re-discount"><div class="discount sp-select"><label>Any Discount?</label><p> (Recommended 10% to 15%)</p><input type="text" name="child_discount_'+i+cnt+'" id="child_discount'+i+cnt+'"  onkeyup="childdischangeestprice('+i+','+cnt+');"></div></div><div class="single-dash"><div class="desh sp-select"><label>-</label></div></div><div class="fit-fees"><div class="fees sp-select"><label>Introduction Fee </label><label>Recurring Fee </label><p> 5%</p><p> 1%</p></div></div><div class="single-equal"><div class="equal sp-select"><label>=</label></div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekday Estimated Earnings</label><input type="text" name="child_estearn_'+i+cnt+'" id="child_estearn'+i+cnt+'" placeholder="$" ></div></div><div class="estimated-earn Weekend'+i+cnt+'"><div class="cus-week-price sp-select"><label>Weekend Estimated Earnings</label><input type="text" name="weekend_child_estearn_'+i+cnt+'" id="weekend_child_estearn'+i+cnt+'" placeholder="$" ></div></div><div class="col-md-12"><div class="priceselect sp-select modelmargin">';
        var onclickchild ="'child'";



       ages_data +='<input class="modelcheckbox"  data-count="0"  type="checkbox" id="is_recurring_child'+i+cnt+'" name="is_recurring_child_'+i+cnt+'" value="0"  onclick="openmodelbox('+i+','+cnt+','+onclickchild+');" ><label>Is This A Recurring Payment? Set the monthly payment terms for Children</label><button style="display:none" id="btn_recurring_child'+i+cnt+'" name="btn_recurring_child_'+i+cnt+'[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring_child'+i+cnt+'" onclick="recurrint_id('+i+','+cnt+','+onclickchild+');">Launch demo modal</button></div></div></div><div class="row"><div class="age-cat"><div class="cat-age sp-select"><label>Infants</label><p>Ages 2 & Under</p></div></div><div class="weekly-customer"><div class="cus-week-price sp-select"><label>Weekday Price</label><p> (Monday - Sunday)</p><input type="text" name="infant_cus_weekly_price_'+i+cnt+'" id="infant_cus_weekly_price'+i+cnt+'" placeholder="$" onkeyup="infantchangeestprice('+i+','+cnt+');"></div></div><div class="weekend-price Weekend'+i+cnt+'" style="display: none;"><div class="cus-week-price sp-select"><label>Weekend Price</label><p> (Saturday & Sunday)</p><input type="text" name="infant_weekend_price_diff_'+i+cnt+'" id="infant_weekend_price_diff'+i+cnt+'" placeholder="$" onkeyup="weekendinfantchangeestprice('+i+','+cnt+');"></div></div><div class="re-discount"><div class="discount sp-select"><label>Any Discount?</label><p> (Recommended 10% to 15%)</p><input type="text" name="infant_discount_'+i+cnt+'" id="infant_discount'+i+cnt+'" onkeyup="infantdischangeestprice('+i+','+cnt+');"></div></div><div class="single-dash"><div class="desh sp-select"><label>-</label></div></div><div class="fit-fees"><div class="fees sp-select"><label>Introduction Fee </label><label>Recurring Fee </label><p> 5%</p><p> 1%</p></div></div><div class="single-equal"><div class="equal sp-select"><label>=</label></div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekday Estimated Earnings</label><input type="text" name="infant_estearn_'+i+cnt+'" id="infant_estearn'+i+cnt+'" placeholder="$"></div></div><div class="estimated-earn Weekend'+i+cnt+'"><div class="cus-week-price sp-select"><label>Weekend Estimated Earnings</label><input type="text" name="weekend_infant_estearn_'+i+cnt+'" id="weekend_infant_estearn'+i+cnt+'" placeholder="$"></div></div><div class="col-md-12"><div class="priceselect sp-select modelmargin">';

        var onclickinfant ="'infant'";

        ages_data +='<input class="modelcheckbox"  data-count="0"  type="checkbox" id="is_recurring_infant'+i+cnt+'"     name="is_recurring_infant_'+i+cnt+'" value="0"  onclick="openmodelbox('+i+','+cnt+','+onclickinfant+');" ><label>Is This A Recurring Payment? Set the monthly payment terms for Infants</label><button style="display:none" id="btn_recurring_infant'+i+cnt+'" name="btn_recurring_infant_'+i+cnt+'[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring_infant'+i+cnt+'" onclick="recurrint_id('+i+','+cnt+','+onclickinfant+');">Launch demo modal</button></div></div></div></div></div><div class="row"><div class="col-md-12 col-sm-12"><div class="serviceprice sp-select"><h3>When Does This Price Setting Expire</h3></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="set-num"><label>Set The Number</label><input type="text" name="pay_setnum_'+i+cnt+'" id="pay_setnum'+i+cnt+'" class="form-control valid" placeholder="(ex,1,2,3,etc.)" value="1" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="set-num"><label>The Duration</label><select name="pay_setduration_'+i+cnt+'" id="pay_setduration'+i+cnt+'" class="form-control valid"><option value="">Select Value</option><option selected="">Days</option><option>Months</option><option>Years</option></select></div></div><div class="col-md-1 col-xs-12"><div class="set-num after"><label>After</label></div></div><div class="col-md-5 col-xs-12"><div class="after-select"><select name="pay_after_'+i+cnt+'" id="pay_after'+i+cnt+'" class="pay_after form-control valid"><option value="">Select Value</option><option value="1" selected="">Starts to expire the day of purchase</option><option value="2">Starts to expire when the customer first participates in the activity</option></select></div></div></div><div class="modal fade ModelRecurring_adult'+i+cnt+'" id="ModelRecurring_adult'+i+cnt+'" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true"><div class="modal-dialog editingautopay" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div class="row"><div class="col-md-12"><div class="editingautopay"><h5 class="modal-title" id="ModelRecurringTitle_adult'+i+cnt+'">Editing Recurring Payments Contract Settings for ("Adults")</h5></div></div></div><div class="row"><div class="col-md-8"><div class="Settings-title"><h5> Settings </h5></div><div class="setting-box"><div class="row set-78"><div class="col-md-4"><label class="contractsettings">How often will customers be charged?</label></div><div class="col-md-8"><select class="form-control" name="recurring_customer_chage_by_adult_'+i+cnt+'" id="recurring_customer_chage_by_adult'+i+cnt+'"><option value="1 Week" >1 week</option><option value="2 Week" >2 week</option><option value="1 Month" >1 Month</option><option value="3 Month" >3 Month</option><option value="6 Month" >6 Month</option> <option value="1 Year" >1 Year</option></select></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">Number of autopays  </label></div><div class="col-md-8"><div class="nuberofautopays"><input type="text" class="form-control valid" name="nuberofautopays_adult_'+i+cnt+'" id="nuberofautopays_adult'+i+cnt+'" placeholder="12" value="" oninput="getnumberofpmt('+i+','+cnt+','+onclickadult+');"></div><div class="contract"><label>  Total duration of contract: </label><p id="total_duration_adult'+i+cnt+'">0 months</p></div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings" id="contractsettings_adult'+i+cnt+'">What happens after payments?</label></div><div class="col-md-8"><div class="autopay"><input type="radio" id="happens_aftr_12_pmt_adult'+i+cnt+'" name="happens_aftr_12_pmt_adult_'+i+cnt+'" value="contract_expire"><label for="contract">Contract Expires</label><br><input type="radio" id="happens_aftr_12_pmt_adult'+i+cnt+'" name="happens_aftr_12_pmt_adult_'+i+cnt+'" value="contract_renew" ><label for="renews" id="renew_adult'+i+cnt+'">Contract Automaitcally Renews Every payments</label><br> </div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">When will clients be charged?</label></div><div class="col-md-8"><div class="saledate"><select class="form-control" name="client_be_charge_on_adult_'+i+cnt+'" id="client_be_charge_on_adult'+i+cnt+'"><option value="sale date" >On the sale date </option> <option value="1stday" > 1st Day of the Month</option><option value="15thday"> 15th Day of the Month</option> </select> </div></div></div></div></div><div class="col-md-4"><div class="Settings-title"><h5> Contract Review </h5></div><div class="setting-box"><div class="set-border"><div class="row"><div class="col-md-8"><p id="p_price_title_adult'+i+cnt+'"></p></div><div class="col-md-4"><p id="p1_price_adult'+i+cnt+'">$0</p></div></div></div><div class="row"><div class="col-md-12"><div class="Settings-title"><h5> Revenue Breakdown </h5></div></div><div class="col-md-10"><p id="trems_payment_adult'+i+cnt+'">Terms: 0 Monthly Payments</p></div><div class="col-md-8"><p>First Payment:</p></div><div class="col-md-4"><p id="p_first_pmt_adult'+i+cnt+'">$0</p></div><input type="hidden" name="first_pmt_adult_'+i+cnt+'" id="first_pmt_adult'+i+cnt+'" value=""><input type="hidden" name="recurring_pmt_adult_'+i+cnt+'" id="recurring_pmt_adult'+i+cnt+'" value=""><div class="col-md-8"><p>Recurring Payment: </p></div><div class="col-md-4"><p id="p_recurring_pmt_adult'+i+cnt+'">$0</p></div><input type="hidden" name="total_contract_revenue_adult_'+i+cnt+'" id="total_contract_revenue_adult'+i+cnt+'" value=""><div class="col-md-8"><label>Total Contract Revenue:  </label></div><div class="col-md-4"><p id="p_total_contract_revenue_adult'+i+cnt+'"> $0</p></div></div></div></div></div></div></div></div></div> <div class="modal fade ModelRecurring_child'+i+cnt+'" id="ModelRecurring_child'+i+cnt+'" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true"><div class="modal-dialog editingautopay" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div class="row"><div class="col-md-12"><div class="editingautopay"><h5 class="modal-title" id="ModelRecurringTitle_child'+i+cnt+'">Editing Recurring Payments Contract Settings for ("Children") </h5></div></div></div><div class="row"><div class="col-md-8"><div class="Settings-title"><h5> Settings </h5></div><div class="setting-box"><div class="row set-78"><div class="col-md-4"><label class="contractsettings">How often will customers be charged?</label></div><div class="col-md-8"><select class="form-control" name="recurring_customer_chage_by_child_'+i+cnt+'" id="recurring_customer_chage_by_child'+i+cnt+'"><option value="1 Week" >1 week</option><option value="2 Week" >2 week</option><option value="1 Month" >1 Month</option><option value="3 Month" >3 Month</option><option value="6 Month" >6 Month</option> <option value="1 Year" >1 Year</option></select></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">Number of autopays  </label></div><div class="col-md-8"><div class="nuberofautopays"><input type="text" class="form-control valid" name="nuberofautopays_child_'+i+cnt+'" id="nuberofautopays_child'+i+cnt+'" placeholder="12" value="" oninput="getnumberofpmt('+i+','+cnt+','+onclickchild+');"></div><div class="contract"><label>  Total duration of contract: </label><p id="total_duration_child'+i+cnt+'">0 months</p></div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings" id="contractsettings_child'+i+cnt+'">What happens after payments?</label></div><div class="col-md-8"><div class="autopay"><input type="radio" id="happens_aftr_12_pmt_child'+i+cnt+'" name="happens_aftr_12_pmt_child_'+i+cnt+'" value="contract_expire"><label for="contract">Contract Expires</label><br><input type="radio" id="happens_aftr_12_pmt_child'+i+cnt+'" name="happens_aftr_12_pmt_child_'+i+cnt+'" value="contract_renew"><label for="renews" id="renew_child'+i+cnt+'">Contract Automaitcally Renews Every payments</label><br> </div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">When will clients be charged?</label></div><div class="col-md-8"><div class="saledate"><select class="form-control" name="client_be_charge_on_child_'+i+cnt+'" id="client_be_charge_on_child'+i+cnt+'"><option value="sale date" >On the sale date </option> <option value="1stday" > 1st Day of the Month</option><option value="15thday"> 15th Day of the Month</option> </select> </div></div></div></div></div><div class="col-md-4"><div class="Settings-title"><h5> Contract Review </h5></div><div class="setting-box"><div class="set-border"><div class="row"><div class="col-md-8"><p id="p_price_title_child'+i+cnt+'"></p></div><div class="col-md-4"><p id="p1_price_child'+i+cnt+'">$0</p></div></div></div><div class="row"><div class="col-md-12"><div class="Settings-title"><h5> Revenue Breakdown </h5></div></div><div class="col-md-10"><p id="trems_payment_child'+i+cnt+'">Terms: 0 Monthly Payments</p></div><div class="col-md-8"><p>First Payment:</p></div><div class="col-md-4"><p id="p_first_pmt_child'+i+cnt+'">$0</p></div><input type="hidden" name="first_pmt_child_'+i+cnt+'" id="first_pmt_child'+i+cnt+'" value=""><input type="hidden" name="recurring_pmt_child_'+i+cnt+'" id="recurring_pmt_child'+i+cnt+'" value=""><div class="col-md-8"><p>Recurring Payment: </p></div><div class="col-md-4"><p id="p_recurring_pmt_child'+i+cnt+'">$0</p></div><input type="hidden" name="total_contract_revenue_child_'+i+cnt+'" id="total_contract_revenue_child'+i+cnt+'" value=""><div class="col-md-8"><label>Total Contract Revenue:  </label></div><div class="col-md-4"><p id="p_total_contract_revenue_child'+i+cnt+'"> $0</p></div></div></div></div></div></div></div></div></div><div class="modal fade ModelRecurring_infant'+i+cnt+'" id="ModelRecurring_infant'+i+cnt+'" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true"><div class="modal-dialog editingautopay" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div class="row"><div class="col-md-12"><div class="editingautopay"><h5 class="modal-title" id="ModelRecurringTitle_infant'+i+cnt+'">Editing Recurring Payments Contract Settings for ("Infant")</h5></div></div></div><div class="row"><div class="col-md-8"><div class="Settings-title"><h5> Settings </h5></div><div class="setting-box"><div class="row set-78"><div class="col-md-4"><label class="contractsettings">How often will customers be charged?</label></div><div class="col-md-8"><select class="form-control" name="recurring_customer_chage_by_infant_'+i+cnt+'" id="recurring_customer_chage_by_infant'+i+cnt+'"><option value="1 Week" >1 week</option><option value="2 Week" >2 week</option><option value="1 Month" >1 Month</option><option value="3 Month" >3 Month</option><option value="6 Month" >6 Month</option> <option value="1 Year" >1 Year</option></select></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">Number of autopays  </label></div><div class="col-md-8"><div class="nuberofautopays"><input type="text" class="form-control valid" name="nuberofautopays_infant_'+i+cnt+'" id="nuberofautopays_infant'+i+cnt+'" placeholder="12" value="" oninput="getnumberofpmt('+i+','+cnt+','+onclickinfant+');"></div><div class="contract"><label>  Total duration of contract: </label><p id="total_duration_infant'+i+cnt+'">0 months</p></div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings" id="contractsettings_infant'+i+cnt+'">What happens after payments?</label></div><div class="col-md-8"><div class="autopay"><input type="radio" id="happens_aftr_12_pmt_infant'+i+cnt+'" name="happens_aftr_12_pmt_infant_'+i+cnt+'" value="contract_expire"><label for="contract">Contract Expires</label><br><input type="radio" id="happens_aftr_12_pmt_infant'+i+cnt+'" name="happens_aftr_12_pmt_infant_'+i+cnt+'" value="contract_renew" ><label for="renews" id="renew_infant'+i+cnt+'">Contract Automaitcally Renews Every payments</label><br> </div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">When will clients be charged?</label></div><div class="col-md-8"><div class="saledate"><select class="form-control" name="client_be_charge_on_infant_'+i+cnt+'" id="client_be_charge_on_infant'+i+cnt+'"><option value="sale date" >On the sale date </option> <option value="1stday" > 1st Day of the Month</option><option value="15thday"> 15th Day of the Month</option> </select> </div></div></div></div></div><div class="col-md-4"><div class="Settings-title"><h5> Contract Review </h5></div><div class="setting-box"><div class="set-border"><div class="row"><div class="col-md-8"><p id="p_price_title_infant'+i+cnt+'"></p></div><div class="col-md-4"><p id="p1_price_infant'+i+cnt+'">$0</p></div></div></div><div class="row"><div class="col-md-12"><div class="Settings-title"><h5> Revenue Breakdown </h5></div></div><div class="col-md-10"><p id="trems_payment_infant'+i+cnt+'">Terms: 0 Monthly Payments</p></div><div class="col-md-8"><p>First Payment:</p></div><div class="col-md-4"><p id="p_first_pmt_infant'+i+cnt+'">$0</p></div><input type="hidden" name="first_pmt_infant_'+i+cnt+'" id="first_pmt_infant'+i+cnt+'" value=""><input type="hidden" name="recurring_pmt_infant_'+i+cnt+'" id="recurring_pmt_infant'+i+cnt+'" value=""><div class="col-md-8"><p>Recurring Payment: </p></div>';   

        ages_data +='<div class="col-md-4"><p id="p_recurring_pmt_infant'+i+cnt+'">$0</p></div><input type="hidden" name="total_contract_revenue_infant_'+i+cnt+'" id="total_contract_revenue_infant'+i+cnt+'" value=""><div class="col-md-8"><label>Total Contract Revenue:  </label></div><div class="col-md-4"><p id="p_total_contract_revenue_infant'+i+cnt+'"> $0</p></div></div></div></div></div></div></div></div></div></div></div>'; 



        ages_data +='</div>';         

        $("#agesmaindiv"+i).append(ages_data);
    }

    function getpricetitle(i,j){

        var x = document.getElementById("price_title"+i+j).value;

        document.getElementById("ModelRecurringTitle_adult"+i+j).innerHTML = 'Editing Recurring Payments Contract Settings for ( '+x +' for "Adults"';

        document.getElementById("ModelRecurringTitle_child"+i+j).innerHTML = 'Editing Recurring Payments Contract Settings for ('+x+' for "Children"';

        document.getElementById("ModelRecurringTitle_infant"+i+j).innerHTML = 'Editing Recurring Payments Contract Settings for ('+x+' for "Infant"';

        $("#p_price_title_adult"+i+j).html(x);

        $("#p_price_title_child"+i+j).html(x);

        $("#p_price_title_infant"+i+j).html(x);

        $("#p1_price_title_adult"+i+j).html(x);

        $("#p1_price_title_child"+i+j).html(x);

        $("#p1_price_title_infant"+i+j).html(x);

    }

    function getnumberofpmt(i,j,val){
        var part  = $("#nuberofautopays_"+val+i+j).val();
        var price = $("#"+val+"_cus_weekly_price"+i+j).val();
        if(price == ''){
            price = 0;
        }
        if(part == 0){
            part = 0;
        }
        var total = part*price;
        if(total == 0){
            $("#p_total_contract_revenue_"+val+i+j).html('$'+price);
            $("#total_contract_revenue_"+val+i+j).val(price);
            $("#total_duration_"+val+i+j).html('0 Months');
            $("#trems_payment_"+val+i+j).html('Terms: 0 Monthly Payments');
        }else{
            $("#p_total_contract_revenue_"+val+i+j).html('$'+total);
            $("#total_contract_revenue_"+val+i+j).val(total);
            $("#total_duration_"+val+i+j).html(part+' Months');
            $("#trems_payment_"+val+i+j).html('Terms: '+part+' Monthly Payments');
        }
        $("#p_first_pmt_"+val+i+j).html('$'+price);
        $("#p_recurring_pmt_"+val+i+j).html('$'+price);
        $("#first_pmt_"+val+i+j).val(price);
        $("#recurring_pmt_"+val+i+j).val(price);
        $("#contractsettings_"+val+i+j).html('What happens after '+part +' payments?');        
        $("#renew_"+val+i+j).html('Contract Automaitcally Renews Every '+part +' payments');        
    }

    function changedesclenght(i){
        var desc = $('#days_description'+i).val();
        $('#days_description_left'+i).text(500-parseInt(desc.length));
    }
</script>



<script type="text/javascript">

$("body").on("click", ".add-another-category-price", function(){
    var fitnessity_fee = '{{$fitnessity_fee}}';
    var cnt=$('#recurring_count').val();
    cnt++;
    $('#recurring_count').val(cnt);
    var service_price = "";
    service_price += '';
    service_price +='<div id="pricediv'+cnt+'"><div class="row"><hr style="border: 1px solid #d4cfcf;width: 100%;"><div class="col-md-11"></div><div class="col-md-1"><i class="remove-category-price fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove emp option"></i></div></div><input type="hidden" name="ages_count'+cnt+'" id="ages_count'+cnt+'" value="0"><div id="agesmaindiv'+cnt+'"><div id="agesdiv'+cnt+'0"><div class="row"><div class="col-md-12"><div class="priceselect sp-select"><input type="hidden" name="cat_id_db[]" id="cat_id_db" value=""><label>Category Title (Give a name for this category)</label><p>*Note: This name will be displayed on your booking schedule for customer to see. </p><div class="row"><div class="col-md-3"><input type="text" name="category_title[]" id="category_title"  class="inputs" placeholder="Ex: Kids Martial Arts (5 to 7 yrs Old)"></div><div class="col-md-3"><input type="text" name="sales_tax[]" id="sales_tax"  class="inputs toolwidth" value="" placeholder="Sales Tax"><label> %  <i class="fas fa-question-circle info-tooltip" id="tooltipex" data-placement="top" title="Typically used when charging for apparel, products, rentals, equipment, food, or snacks."></i></label></div><div class="col-md-3"><input type="text" name="dues_tax[]" id="dues_tax"  class="inputs toolwidth" value="" placeholder="Dues Tax"><label> %  <i class="fas fa-question-circle info-tooltip" id="tooltipex" data-placement="top" title="Typically used for all membership type fees."></i></label></div></div></div></div></div><input type="hidden" name="price_id_db_'+cnt+'0" id="price_id_db'+cnt+'0" value="" /><div class="row mt-30"><div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Price Title</label><input type="text" name="price_title_'+cnt+'0" id="price_title'+cnt+'0"  class="inputs" placeholder="Ex: 6 month Membership" oninput="getpricetitle('+cnt+',0)"></div></div><div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Session Type</label><select name="pay_session_type_'+cnt+'0" id="pay_session_type'+cnt+'0" class="bd-right bd-bottom pay_session_type" onchange="pay_session_select('+cnt+',0,this.value);"><option value="Single">Single</option><option value="Multiple">Multiple</option><option value="Unlimited">Unlimited</option></select></div></div><div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Number of Sessions</label><input type="text" name="pay_session_'+cnt+'0" id="pay_session'+cnt+'0"  class="inputs pay_session" placeholder="1" value="1" readonly></div></div><div class="col-md-3 col-sm-6"><div class="priceselect sp-select"><label>Membership Type</label><select name="membership_type_'+cnt+'0" id="membership_type'+cnt+'0" class="bd-right bd-bottom membership_type"><option value="Drop In">Drop In</option><option value="Semester">Semester (Long Term)</option></select></div></div></div><div class="row"><div class="col-md-12"><div class="setprice sp-select"><div class="row"> <div class="col-md-12"><input type="radio" id="freeprice'+cnt+'0" name="sectiondisplay'+cnt+'0" onclick="showdiv('+cnt+',0);" value="freeprice"> <label class="recurring-pmt">Free</label> <input type="radio" id="weekdayprice'+cnt+'0" name="sectiondisplay'+cnt+'0" onclick="showdiv('+cnt+',0);"  value="weekdayprice" checked> <label class="recurring-pmt">Everyday Price</label> <input type="radio" id="weekendprice'+cnt+'0" name="sectiondisplay'+cnt+'0" onclick="showdiv('+cnt+',0);" value="weekendprice"> <label class="recurring-pmt">Weekend Price</label></div></div></div></div></div><div id="displaysectiondiv'+cnt+'0"><div class="row"><div class="col-md-12"><div class="setprice sp-select"><div class="row"><div class="col-md-2"><label id="showlessmore'+cnt+'0" onclick="showlessmore('+cnt+',0);">Show Less</label> </div><div class="col-md-10"><h3 class="setprice-custom">You can set your prices to be the same or different based on age, the weekday or the weekend.To add prices for children or infants, click on the box.</h3> </div> </div> </div></div></div> <div class="row"><div class="age-cat"><div class="cat-age sp-select"><label>Adults</label><p>Ages 12 & Older</p></div></div><div class="weekly-customer"><div class="cus-week-price sp-select"><label>Weekday Price</label><p> (Monday - Sunday)</p><input type="text" name="adult_cus_weekly_price_'+cnt+'0" id="adult_cus_weekly_price'+cnt+'0" placeholder="$"  onkeyup="adultchangeestprice('+cnt+',0);"></div></div><div class="weekend-price Weekend'+cnt+'0" style="display: none;"><div class="cus-week-price sp-select"><label>Weekend Price </label><p> (Saturday & Sunday)</p><input type="text" name="adult_weekend_price_diff_'+cnt+'0" id="adult_weekend_price_diff'+cnt+'0" placeholder="$" onkeyup="weekendadultchangeestprice('+cnt+',0);"></div></div><div class="re-discount"><div class="discount sp-select"><label>Any Discount? </label><p> (Recommended 10% to 15%)</p><input type="text" name="adult_discount_'+cnt+'0" id="adult_discount'+cnt+'0" onkeyup="adultdischangeestprice('+cnt+',0);"></div></div><div class="single-dash"><div class="desh sp-select"><label>-</label></div></div><div class="fit-fees"><div class="fees sp-select"><label>Introduction Fee </label><label>Recurring Fee </label><p> 5%</p><p> 1%</p></div></div><div class="single-equal"><div class="equal sp-select"><label>=</label></div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekday Estimated Earnings </label><input type="text" name="adult_estearn_'+cnt+'0" id="adult_estearn'+cnt+'0" placeholder="$"></div></div><div class="estimated-earn Weekend'+cnt+'0"><div class="cus-week-price sp-select"><label>Weekend Estimated Earnings</label><input type="text" name="weekend_adult_estearn_'+cnt+'0" id="weekend_adult_estearn'+cnt+'0" placeholder="$" ></div></div><div class="col-md-12"><div class="priceselect sp-select modelmargin">';

    var onclickadult ="'adult'";
    service_price +='<input class="modelcheckbox"  data-count="0"  type="checkbox" id="is_recurring_adult'+cnt+'0" name="is_recurring_adult_'+cnt+'0" value="0" onclick="openmodelbox('+cnt+',0,'+onclickadult+');" ><label>Is This A Recurring Payment? Set the monthly payment terms for Adults</label><button style="display:none" id="btn_recurring_adult'+cnt+'0" name="btn_recurring_adult_'+cnt+'0[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring_adult'+cnt+'0" onclick="recurrint_id('+cnt+',0,'+onclickadult+');">Launch demo modal</button></div></div></div><div id="showmorehide'+cnt+'0"> <div class="row"><div class="age-cat"><div class="cat-age sp-select"><label>Children</label><p>Ages 2 to 12</p></div></div><div class="weekly-customer"><div class="cus-week-price sp-select"><label>Weekday Price</label><p> (Monday - Sunday)</p><input type="text" name="child_cus_weekly_price_'+cnt+'0" id="child_cus_weekly_price'+cnt+'0" placeholder="$" onkeyup="childchangeestprice('+cnt+',0);"></div></div><div class="weekend-price Weekend'+cnt+'0" style="display: none;"><div class="cus-week-price sp-select"><label>Weekend Price</label><p> (Saturday & Sunday)</p><input type="text" name="child_weekend_price_diff_'+cnt+'0" id="child_weekend_price_diff'+cnt+'0" placeholder="$" onkeyup="weekendchildchangeestprice('+cnt+',0);"></div></div><div class="re-discount"><div class="discount sp-select"><label>Any Discount?</label><p> (Recommended 10% to 15%)</p><input type="text" name="child_discount_'+cnt+'0" id="child_discount'+cnt+'0"  onkeyup="childdischangeestprice('+cnt+',0);"></div></div><div class="single-dash"><div class="desh sp-select"><label>-</label></div></div><div class="fit-fees"><div class="fees sp-select"><label>Introduction Fee </label><label>Recurring Fee </label><p> 5%</p><p> 1%</p></div></div><div class="single-equal"><div class="equal sp-select"><label>=</label></div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekday Estimated Earnings</label><input type="text" name="child_estearn_'+cnt+'0" id="child_estearn'+cnt+'0" placeholder="$" ></div></div><div class="estimated-earn Weekend'+cnt+'0"><div class="cus-week-price sp-select"><label>Weekend Estimated Earnings</label><input type="text" name="weekend_child_estearn_'+cnt+'0" id="weekend_child_estearn'+cnt+'0" placeholder="$" ></div></div><div class="col-md-12"><div class="priceselect sp-select modelmargin">';

    var onclickchild ="'child'";
    service_price +='<input class="modelcheckbox"  data-count="0"  type="checkbox" id="is_recurring_child'+cnt+'0" name="is_recurring_child_'+cnt+'0" value="0"  onclick="openmodelbox('+cnt+',0,'+onclickchild+');" ><label>Is This A Recurring Payment? Set the monthly payment terms for Children</label><button style="display:none" id="btn_recurring_child'+cnt+'0" name="btn_recurring_child_'+cnt+'0[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring_child'+cnt+'0" onclick="recurrint_id('+cnt+',0,'+onclickchild+');">Launch demo modal</button></div></div></div><div class="row"><div class="age-cat"><div class="cat-age sp-select"><label>Infants</label><p>Ages 2 & Under</p></div></div><div class="weekly-customer"><div class="cus-week-price sp-select"><label>Weekday Price</label><p> (Monday - Sunday)</p><input type="text" name="infant_cus_weekly_price_'+cnt+'0" id="infant_cus_weekly_price'+cnt+'0" placeholder="$" onkeyup="infantchangeestprice('+cnt+',0);"></div></div><div class="weekend-price Weekend'+cnt+'0" style="display: none;"><div class="cus-week-price sp-select"><label>Weekend Price</label><p> (Saturday & Sunday)</p><input type="text" name="infant_weekend_price_diff_'+cnt+'0" id="infant_weekend_price_diff'+cnt+'0" placeholder="$" onkeyup="weekendinfantchangeestprice('+cnt+',0);"></div></div><div class="re-discount"><div class="discount sp-select"><label>Any Discount?</label><p> (Recommended 10% to 15%)</p><input type="text" name="infant_discount_'+cnt+'0" id="infant_discount'+cnt+'0" onkeyup="infantdischangeestprice('+cnt+',0);"></div></div><div class="single-dash"><div class="desh sp-select"><label>-</label></div></div><div class="fit-fees"><div class="fees sp-select"><label>Introduction Fee </label><label>Recurring Fee </label><p> 5%</p><p> 1%</p></div></div><div class="single-equal"><div class="equal sp-select"><label>=</label></div></div><div class="estimated-earn"><div class="cus-week-price sp-select"><label>Weekday Estimated Earnings</label><input type="text" name="infant_estearn_'+cnt+'0" id="infant_estearn'+cnt+'0" placeholder="$"></div></div><div class="estimated-earn Weekend'+cnt+'0"><div class="cus-week-price sp-select"><label>Weekend Estimated Earnings</label><input type="text" name="weekend_infant_estearn_'+cnt+'0" id="weekend_infant_estearn'+cnt+'0" placeholder="$"></div></div><div class="col-md-12"><div class="priceselect sp-select modelmargin">';

    var onclickinfant ="'infant'";
    service_price +='<input class="modelcheckbox"  data-count="0"  type="checkbox" id="is_recurring_infant'+cnt+'0"     name="is_recurring_infant_'+cnt+'0" value="0"  onclick="openmodelbox('+cnt+',0,'+onclickinfant+');" ><label>Is This A Recurring Payment? Set the monthly payment terms for Infants</label><button style="display:none" id="btn_recurring_infant'+cnt+'0" name="btn_recurring_infant_'+cnt+'0[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring_infant'+cnt+'0" onclick="recurrint_id('+cnt+',0,'+onclickinfant+');">Launch demo modal</button></div></div></div></div></div><div class="row"><div class="col-md-12 col-sm-12"><div class="serviceprice sp-select"><h3>When Does This Price Setting Expire</h3></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="set-num"><label>Set The Number</label><input type="text" name="pay_setnum_'+cnt+'0" id="pay_setnum'+cnt+'0" class="form-control valid" placeholder="(ex,1,2,3,etc.)" value="1" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></div></div><div class="col-md-3 col-sm-6 col-xs-12"><div class="set-num"><label>The Duration</label><select name="pay_setduration_'+cnt+'0" id="pay_setduration'+cnt+'0" class="form-control valid"><option value="">Select Value</option><option selected="">Days</option><option>Months</option><option>Years</option></select></div></div><div class="col-md-1 col-xs-12"><div class="set-num after"><label>After</label></div></div><div class="col-md-5 col-xs-12"><div class="after-select"><select name="pay_after_'+cnt+'0" id="pay_after'+cnt+'0" class="pay_after form-control valid"><option value="">Select Value</option><option value="1" selected="">Starts to expire the day of purchase</option><option value="2">Starts to expire when the customer first participates in the activity</option></select></div></div></div><div class="modal fade ModelRecurring_adult'+cnt+'0" id="ModelRecurring_adult'+cnt+'0" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true"><div class="modal-dialog editingautopay" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div class="row"><div class="col-md-12"><div class="editingautopay"><h5 class="modal-title" id="ModelRecurringTitle_adult'+cnt+'0">Editing Recurring Payments Contract Settings for ("Adults") </h5></div></div></div><div class="row"><div class="col-md-8"><div class="Settings-title"><h5> Settings </h5></div><div class="setting-box"><div class="row set-78"><div class="col-md-4"><label class="contractsettings">How often will customers be charged?</label></div><div class="col-md-8"><select class="form-control" name="recurring_customer_chage_by_adult_'+i+cnt+'" id="recurring_customer_chage_by_adult'+i+cnt+'"><option value="1 Week" >1 week</option><option value="2 Week" >2 week</option><option value="1 Month" >1 Month</option><option value="3 Month" >3 Month</option><option value="6 Month" >6 Month</option> <option value="1 Year" >1 Year</option></select></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">Number of autopays  </label></div><div class="col-md-8"><div class="nuberofautopays"><input type="text" class="form-control valid" name="nuberofautopays_adult_'+cnt+'0" id="nuberofautopays_adult'+cnt+'0" placeholder="12" value="" oninput="getnumberofpmt('+cnt+',0,'+onclickadult+');"></div><div class="contract"><label>  Total duration of contract: </label><p id="total_duration_adult'+cnt+'0">0 months</p></div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings" id="contractsettings_adult'+cnt+'0">What happens after payments?</label></div><div class="col-md-8"><div class="autopay"><input type="radio" id="happens_aftr_12_pmt_adult'+cnt+'0" name="happens_aftr_12_pmt_adult_'+cnt+'0" value="contract_expire"><label for="contract">Contract Expires</label><br><input type="radio" id="happens_aftr_12_pmt_adult'+cnt+'0" name="happens_aftr_12_pmt_adult_'+cnt+'0" value="contract_renew" ><label for="renews" id="renew_adult'+cnt+'0">Contract Automaitcally Renews Every payments</label><br> </div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">When will clients be charged?</label></div><div class="col-md-8"><div class="saledate"><select class="form-control" name="client_be_charge_on_adult_'+cnt+'0" id="client_be_charge_on_adult'+cnt+'0"><option value="sale date" >On the sale date </option> <option value="1stday" > 1st Day of the Month</option><option value="15thday"> 15th Day of the Month</option> </select> </div></div></div></div></div><div class="col-md-4"><div class="Settings-title"><h5> Contract Review </h5></div><div class="setting-box"><div class="set-border"><div class="row"><div class="col-md-8"><p id="p_price_title_adult'+cnt+'0"></p></div><div class="col-md-4"><p id="p1_price_adult'+cnt+'0">$0</p></div></div></div><div class="row"><div class="col-md-12"><div class="Settings-title"><h5> Revenue Breakdown </h5></div></div><div class="col-md-10"><p id="trems_payment_adult'+cnt+'0">Terms: 0 Monthly Payments</p></div><div class="col-md-8"><p>First Payment:</p></div><div class="col-md-4"><p id="p_first_pmt_adult'+cnt+'0">$0</p></div><input type="hidden" name="first_pmt_adult_'+cnt+'0" id="first_pmt_adult'+cnt+'0" value=""><input type="hidden" name="recurring_pmt_adult_'+cnt+'0" id="recurring_pmt_adult'+cnt+'0" value=""><div class="col-md-8"><p>Recurring Payment: </p></div><div class="col-md-4"><p id="p_recurring_pmt_adult'+cnt+'0">$0</p></div><input type="hidden" name="total_contract_revenue_adult_'+cnt+'0" id="total_contract_revenue_adult'+cnt+'0" value=""><div class="col-md-8"><label>Total Contract Revenue:  </label></div><div class="col-md-4"><p id="p_total_contract_revenue_adult'+cnt+'0"> $0</p></div></div></div></div></div></div></div></div></div> <div class="modal fade ModelRecurring_child'+cnt+'0" id="ModelRecurring_child'+cnt+'0" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true"><div class="modal-dialog editingautopay" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div class="row"><div class="col-md-12"><div class="editingautopay"><h5 class="modal-title" id="ModelRecurringTitle_child'+cnt+'0">Editing Recurring Payments Contract Settings for ("Children")  </h5></div></div></div><div class="row"><div class="col-md-8"><div class="Settings-title"><h5> Settings </h5></div><div class="setting-box"><div class="row set-78"><div class="col-md-4"><label class="contractsettings">How often will customers be charged?</label></div><div class="col-md-8"><select class="form-control" name="recurring_customer_chage_by_child_'+i+cnt+'" id="recurring_customer_chage_by_child'+i+cnt+'"><option value="1 Week" >1 week</option><option value="2 Week" >2 week</option><option value="1 Month" >1 Month</option><option value="3 Month" >3 Month</option><option value="6 Month" >6 Month</option> <option value="1 Year" >1 Year</option></select></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">Number of autopays  </label></div><div class="col-md-8"><div class="nuberofautopays"><input type="text" class="form-control valid" name="nuberofautopays_child_'+cnt+'0" id="nuberofautopays_child'+cnt+'0" placeholder="12" value="" oninput="getnumberofpmt('+cnt+',0,'+onclickchild+');"></div><div class="contract"><label>  Total duration of contract: </label><p id="total_duration_child'+cnt+'0">0 months</p></div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings" id="contractsettings_child'+cnt+'0">What happens after payments?</label></div><div class="col-md-8"><div class="autopay"><input type="radio" id="happens_aftr_12_pmt_child'+cnt+'0" name="happens_aftr_12_pmt_child_'+cnt+'0" value="contract_expire"><label for="contract">Contract Expires</label><br><input type="radio" id="happens_aftr_12_pmt_child'+cnt+'0" name="happens_aftr_12_pmt_child_'+cnt+'0" value="contract_renew"><label for="renews" id="renew_child'+cnt+'0">Contract Automaitcally Renews Every payments</label><br> </div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">When will clients be charged?</label></div><div class="col-md-8"><div class="saledate"><select class="form-control" name="client_be_charge_on_child_'+cnt+'0" id="client_be_charge_on_child'+cnt+'0"><option value="sale date" >On the sale date </option> <option value="1stday" > 1st Day of the Month</option><option value="15thday"> 15th Day of the Month</option> </select> </div></div></div></div></div><div class="col-md-4"><div class="Settings-title"><h5> Contract Review </h5></div><div class="setting-box"><div class="set-border"><div class="row"><div class="col-md-8"><p id="p_price_title_child'+cnt+'0"></p></div><div class="col-md-4"><p id="p1_price_child'+cnt+'0">$0</p></div></div></div><div class="row"><div class="col-md-12"><div class="Settings-title"><h5> Revenue Breakdown </h5></div></div><div class="col-md-10"><p id="trems_payment_child'+cnt+'0">Terms: 0 Monthly Payments</p></div><div class="col-md-8"><p>First Payment:</p></div><div class="col-md-4"><p id="p_first_pmt_child'+cnt+'0">$0</p></div><input type="hidden" name="first_pmt_child_'+cnt+'0" id="first_pmt_child'+cnt+'0" value=""><input type="hidden" name="recurring_pmt_child_'+cnt+'0" id="recurring_pmt_child'+cnt+'0" value=""><div class="col-md-8"><p>Recurring Payment: </p></div><div class="col-md-4"><p id="p_recurring_pmt_child'+cnt+'0">$0</p></div><input type="hidden" name="total_contract_revenue_child_'+cnt+'0" id="total_contract_revenue_child'+cnt+'0" value=""><div class="col-md-8"><label>Total Contract Revenue:  </label></div><div class="col-md-4"><p id="p_total_contract_revenue_child'+cnt+'0"> $0</p></div></div></div></div></div></div></div></div></div><div class="modal fade ModelRecurring_infant'+cnt+'0" id="ModelRecurring_infant'+cnt+'0" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true"><div class="modal-dialog editingautopay" role="document"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><div class="row"><div class="col-md-12"><div class="editingautopay"><h5 class="modal-title" id="ModelRecurringTitle_infant'+cnt+'0">Editing Recurring Payments Contract Settings for ("Infant") </h5></div></div></div><div class="row"><div class="col-md-8"><div class="Settings-title"><h5> Settings </h5></div><div class="setting-box"><div class="row set-78"><div class="col-md-4"><label class="contractsettings">How often will customers be charged?</label></div><div class="col-md-8"><select class="form-control" name="recurring_customer_chage_by_infant_'+i+cnt+'" id="recurring_customer_chage_by_infant'+i+cnt+'"><option value="1 Week" >1 week</option><option value="2 Week" >2 week</option><option value="1 Month" >1 Month</option><option value="3 Month" >3 Month</option><option value="6 Month" >6 Month</option> <option value="1 Year" >1 Year</option></select></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">Number of autopays  </label></div><div class="col-md-8"><div class="nuberofautopays"><input type="text" class="form-control valid" name="nuberofautopays_infant_'+cnt+'0" id="nuberofautopays_infant'+cnt+'0" placeholder="12" value="" oninput="getnumberofpmt('+cnt+',0,'+onclickinfant+');"></div><div class="contract"><label>  Total duration of contract: </label><p id="total_duration_infant'+cnt+'0">0 months</p></div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings" id="contractsettings_infant'+cnt+'0">What happens after payments?</label></div><div class="col-md-8"><div class="autopay"><input type="radio" id="happens_aftr_12_pmt_infant'+cnt+'0" name="happens_aftr_12_pmt_infant_'+cnt+'0" value="contract_expire"><label for="contract">Contract Expires</label><br><input type="radio" id="happens_aftr_12_pmt_infant'+cnt+'0" name="happens_aftr_12_pmt_infant_'+cnt+'0" value="contract_renew" ><label for="renews" id="renew_infant'+cnt+'0">Contract Automaitcally Renews Every payments</label><br> </div></div></div><div class="row set-78"><div class="col-md-4"><label class="contractsettings">When will clients be charged?</label></div><div class="col-md-8"><div class="saledate"><select class="form-control" name="client_be_charge_on_infant_'+cnt+'0" id="client_be_charge_on_infant'+cnt+'0"><option value="sale date" >On the sale date </option> <option value="1stday" > 1st Day of the Month</option><option value="15thday"> 15th Day of the Month</option> </select></div></div></div></div></div><div class="col-md-4"><div class="Settings-title"><h5> Contract Review </h5></div><div class="setting-box"><div class="set-border"><div class="row"><div class="col-md-8"><p id="p_price_title_infant'+cnt+'0"></p></div><div class="col-md-4"><p id="p1_price_infant'+cnt+'0">$0</p></div></div></div><div class="row"><div class="col-md-12"><div class="Settings-title"><h5> Revenue Breakdown </h5></div></div><div class="col-md-10"><p id="trems_payment_infant'+cnt+'0">Terms: 0 Monthly Payments</p></div><div class="col-md-8"><p>First Payment:</p></div><div class="col-md-4"><p id="p_first_pmt_infant'+cnt+'0">$0</p></div><input type="hidden" name="first_pmt_infant_'+cnt+'0" id="first_pmt_infant'+cnt+'0" value=""><input type="hidden" name="recurring_pmt_infant_'+cnt+'0" id="recurring_pmt_infant'+cnt+'0" value=""><div class="col-md-8"><p>Recurring Payment: </p></div><div class="col-md-4"><p id="p_recurring_pmt_infant'+cnt+'0">$0</p></div>';

    service_price +='<input type="hidden" name="total_contract_revenue_infant_'+cnt+'0" id="total_contract_revenue_infant'+cnt+'0" value=""><div class="col-md-8"><label>Total Contract Revenue:  </label></div><div class="col-md-4"><p id="p_total_contract_revenue_infant'+cnt+'0"> $0</p></div></div></div></div></div></div></div></div></div></div></div>';

    service_price +='<div  class=""><div class="col-md-12"><div class="addanother"><a class="" onclick=" return add_another_price_ages('+cnt+');"> +Add Another Session </a></div> </div></div></div>';

    $(".service_price_block").append(service_price);
});
$("body").on("blur", ".pay_price", function(){

  var pay_disc = 0;

  var pid = $(this).parent().parent().parent().attr('id');

  var pay_disc = $('#pay_discount').val();

  var fitnessity_fee = '{{$fitnessity_fee}}';

  $('#'+pid).find('.pay_estearn:first').val($(this).val() - ($(this).val()*fitnessity_fee)/100 - ($(this).val()*pay_disc)/100);

});



$("body").on("blur", "#pay_discount", function(){

  var p_dis_id = $(this).parent().parent().parent().attr('id');

  var pay_price = $('.pay_price').val();

  var fitnessity_fee = '{{$fitnessity_fee}}';

  $('#'+p_dis_id).find('.pay_estearn:first').val( pay_price - ((pay_price * $(this).val())/100 + (pay_price*fitnessity_fee)/100));
});



$("body").on("click", ".add-another-day-schedule", function(){
    var cnt=$('#planday_count').val();
    cnt++;
    $('#planday_count').val(cnt);
    var service_price = ""; var daycnt='';
    daycnt = cnt+1;                          
    
    service_price += '<div class="add_another_day planday'+cnt+'" style="margin-top:20px; padding-top:10px;border-top:1px dotted #000;">'; 


    service_price += '<div class="col-md-11"></div><div class="col-md-1"><i class="remove-day-schedule fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove Day"></i></div>';

    var img = "{{url('/public/images/Upload-Icon.png')}}";

	service_price += '<label class="select-dropoff">Day - '+daycnt+' </label><div class="row"><div class="col-md-8"><div class="row"><div class="col-md-3"><div class="photo-upload"><label for="dayplanpic'+cnt+'" id="label"><img src="'+img+'" class="pro_card_img blah planblah'+cnt+'" id="showimg" ><span id="span_'+cnt+'">Upload your file here</span><input type="file" name="dayplanpic_'+cnt+'" id="dayplanpic'+cnt+'" class="uploadFile img" value="Upload Photo" onchange="planImg(this,'+cnt+');" required></label><span class="error" id="err_oldservicepic2'+cnt+'"></span><input type="hidden" id="olddayplanpic2'+cnt+'" name="olddayplanpic_'+cnt+'" value=""></div></div><div class="col-md-6"><div><input type="text" class="form-control" name="days_title[]" id="days_title" placeholder="Give a heading for this day." title="servicetitle"></div><div class="description-txt"><textarea class="form-control valid" rows="2" name="days_description[]" id="days_description'+cnt+'" placeholder="Give a description for this day" maxlength="150" oninput="changedesclenght('+cnt+');"></textarea><span id="days_description_left'+cnt+'">500 Character Left</span> </div></div> </div></div></div>';

    service_price += '</div>';

    $(".add-another-day-schedule-block").append(service_price);

});

$("body").on("click", ".remove-day-schedule", function(){
    var cnt=$('#planday_count').val();
    cnt--;
    $('#planday_count').val(cnt);
    $(this).parent().parent().remove();
});
$("body").on("click", ".remove-pricedetails", function(){
    var cnt=$('#recurring_count').val();
 /*   cnt--;*/
    $('#recurring_count').val(cnt);
    $(this).parent('div').parent('div').remove();
});
$("body").on("click", ".remove-empdetails", function(){
    var cnt=$('#Emp_count').val();
    cnt--;
    $('#Emp_count').val(cnt);
    $(this).parent('div').parent('div').remove();
});
$("body").on("click", ".remove-edudetails", function(){
    var cnt=$('#Edu_count').val();
    cnt--;
    $('#Edu_count').val(cnt);
    $(this).parent('div').parent('div').remove();
});
$("body").on("click", ".remove-category-price ", function(){
    var cnt=$('#recurring_count').val();
    cnt--;
    $('#recurring_count').val(cnt);
    $(this).parent('div').parent('div').parent('div').remove();
});
$("body").on("click", ".remove-certidetails", function(){
    var cnt=$('#certi_count').val();
    cnt--;
    $('#certi_count').val(cnt);
    $(this).parent('div').parent('div').remove();
});
$("body").on("click", ".remove-skilldetails", function(){
    var cnt=$('#skill_count').val();
    cnt--;
    $('#skill_count').val(cnt);
    $(this).parent('div').parent('div').remove();
});
$("body").on("click", ".add-another-session-skilldetails", function(){
  var cnt=$('#skill_count').val();
  cnt++;
  $('#skill_count').val(cnt);
  var skill_details = '';
  skill_details += '<div class="row"><hr style="border: 1px solid #d4cfcf;width: 100%;"><div class="col-md-11"></div><div class="col-md-1"><i class="remove-skilldetails fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove emp option"></i></div>';
  skill_details +='<div class="col-md-12"><div id="certidetail'+cnt+'"><div class="col-md-6 col-sm-6 col-xs-12"><div class="form-group"><label for="pwd">Skill Type </label><select name="skill_type[]" id="skiils_achievments_awards1" class="form-control my-select"><option value="">Select Item</option><option value="Skills">Skills</option><option value="Achievment">Achievments</option> <option value="Award">Awards</option></select><span class="error" id="b_skilltype"></span></div><div class="form-group" id="skillcompletionpicker-position"><label for="email">Completion Date (mm/dd/yyyy) </label><div class="special-date"><input type="text" name="skillcompletion[]" class="form-control skillcompletionpicker'+cnt+'" id="skillcompletionpicker" placeholder="Completion Date"  autocomplete="off" value=""><span class="error" id="b_skillyear"></span></div></div></div><div class="form-group col-md-6 col-sm-6 col-xs-12"><label for="pwd">Description </label><textarea name="frm_skilldetail[]" id="frm_skilldetail" placeholder="Description" cols="10" rows="3" class="form-control" maxlength="300"></textarea><span class="error" id="b_skilldetail"></span><span id="frm_skilldetail_left">150</span> Characters Left</div></div></div></div>';
    $(".skilldetails_block").append(skill_details);
    $('.skillcompletionpicker'+cnt).Zebra_DatePicker({
        format: 'm/d/Y',
        default_position: 'below'
    });
});
$("body").on("click", ".add-another-session-certidetails", function(){
  var cnt=$('#certi_count').val();
  cnt++;
  $('#certi_count').val(cnt);
  var certi_details = '';
  certi_details += '<div class="row"><hr style="border: 1px solid #d4cfcf;width: 100%;"><div class="col-md-11"></div><div class="col-md-1"><i class="remove-certidetails fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove emp option"></i></div>';
  certi_details +='<div class="col-md-12"><div id="certidetail'+cnt+'"><div class="form-group col-md-6 col-sm-6 col-xs-12"><label for="pwd">Name of Certification </label><input type="text" id="certification" name="certification[]" class="form-control" placeholder="Name of Certification" value="" maxlength="200"><span class="error" id="b_certification"></span></div><div class="form-group col-md-6 col-sm-6 col-xs-12"><label for="email">Completion Date (mm/dd/yyyy) </label><div class="special-date"><input type="text" class="form-control completionyear'+cnt+'" id="completionyear" name="frm_passingdate[]" placeholder="Completion Date" autocomplete="off" value=""><span class="error" id="b_certificateyear"></span></div></div></div></div></div>';
    $(".certidetail_block").append(certi_details);
    $('.completionyear'+cnt).Zebra_DatePicker({
        format: 'm/d/Y',
        default_position: 'below'
    });
});
$("body").on("click", ".add-another-session-edudetails", function(){
  var cnt=$('#Edu_count').val();
  cnt++;
  $('#Edu_count').val(cnt);
  var edu_details = '';
  edu_details += '<div class="row"><hr style="border: 1px solid #d4cfcf;width: 100%;"><div class="col-md-11"></div><div class="col-md-1"><i class="remove-edudetails fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove emp option"></i></div>';
  edu_details +='<div class="col-md-12"><div id="edudetail'+cnt+'"><div class="form-group col-md-6 col-sm-6 col-xs-12"><label for="pwd">Degree - Course </label><input type="text" id="frm_course" name="frm_course[]" class="form-control frm_course" placeholder="Degree/Course (Obtained or Seeking)" value="" maxlength="500"><span class="error" id="b_degree"></span></div><div class="form-group col-md-6 col-sm-6 col-xs-12"><label for="pwd">University - School </label><input type="text" id="frm_university" name="frm_university[]" class="form-control frm_university" placeholder="University/School" value=""  maxlength="200"><span class="error" id="b_university"></span></div><div class="form-group col-md-6 col-sm-6 col-xs-12"><label for="pwd">Year Graduated (yyyy) </label><input id="passingyear" name="frm_passingyear[]" class="form-control passingyear'+cnt+'" placeholder="Year graduated" type="number" maxlength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:100%" autocomplete="off" value=""><span class="error" id="b_year"></span></div></div></div></div>';
    $(".edudetail_block").append(edu_details);
    $('.passingyear'+cnt+'').Zebra_DatePicker({
        format: 'Y',
        default_position: 'below'
    });
});

$("body").on("click", ".add-another-session-emphis", function(){
  var cnt=$('#Emp_count').val();
  cnt++;
  $('#Emp_count').val(cnt);
  var emp_details = "";
  emp_details += '<div class="row"><hr style="border: 1px solid #d4cfcf;width: 100%;"><div class="col-md-11"></div><div class="col-md-1"><i class="remove-empdetails fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove emp option"></i></div>';
  emp_details +='<div class="col-md-12"><div id="empdetail'+cnt+'"><div class="form-group col-md-6 col-sm-6 col-xs-12"><label for="email">Company Name </label><input type="text" name="frm_organisationname[]" id="frm_organisationname" placeholder="Organization name" class="form-control" maxlength="100" value=""><span class="error" id="b_organisationname"></span></div><div class="form-group col-md-6 col-sm-6 col-xs-12"><label for="pwd">Position </label><input type="text" class="form-control" id="frm_position" name="frm_position[]" placeholder="Position" value="" maxlength="100"><span class="error" id="b_position" ></span></div><div class="col-md-12 col-sm-6 col-xs-12"><div class="form-group"><label class=" present_work_btn"><input type="checkbox" style="width: 25px;height: 25px;position: relative;top: 5px;" name="frm_ispresentcheck[]" id="frm_ispresentcheck'+cnt+'" onchange="checkstillwork(this.value,'+cnt+')" checked /><span>I Still Work Here</span><input type="hidden" name="frm_ispresent[]" id="frm_ispresent'+cnt+'" value="1"></label></div></div><div class="form-group col-md-6 col-sm-6 col-xs-12" id="dp1-position"><label for="email">From (mm/dd/yyyy)</label><div class="special-date"><input type="text" class="form-control span2" name="frm_servicestart[]" placeholder="From" id="dp1_'+cnt+'" value=""><span class="error" id="b_employmentfrom"></span></div></div><div class="form-group col-md-6 col-sm-6 col-xs-12" id="dp2_'+cnt+'-position'+cnt+'" style="display:none;"><label for="pwd">To (mm/dd/yyyy) </label><div class="special-date"><input type="text" class="form-control" id="dp2_'+cnt+'" name="frm_serviceend[]" placeholder="To" value=""><span class="error" id="b_employmentto"></span></div></div></div></div>';

    $(".empdetail_block").append(emp_details);
    $('#dp1_'+cnt+', #dp2_'+cnt+'').Zebra_DatePicker({
        format: 'm/d/Y',
        default_position: 'below'
    });
});

$("body").on("click", ".add-another-session", function(){
	var cnt=$('#recurring_count').val();
	cnt++;
	$('#recurring_count').val(cnt);
	var service_price = "";
    service_price += '<div class="col-md-12 service_price serpridiv'+cnt+'" id="serpridiv'+cnt+'" style="margin-top:20px; padding-top:10px; float:left; border-top:1px dotted #000;">';

    service_price += '<div class="row"><div class="col-md-11"></div><div class="col-md-1"><i class="remove-service-price fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove price option"></i></div></div>';

    service_price += $(".service_price").html();
    service_price += '</div>';
    $(".service_price_block").append(service_price);

  parent = document.querySelector(".serpridiv"+cnt);

  pay_session_type = parent.querySelector('#pay_session_type').value='';

  pay_session = parent.querySelector('.pay_session').value='';

  membership_type = parent.querySelector('.membership_type').value='';

  pay_price = parent.querySelector('.pay_price').value='';

  pay_estearn = parent.querySelector('.pay_estearn').value='';

  pay_discount = parent.querySelector('#pay_discount').value='';

  pay_setnum = parent.querySelector('#pay_setnum').value='';

  pay_setduration = parent.querySelector('#pay_setduration').value='';

  pay_after = parent.querySelector('#pay_after').value='';

  var inps = document.getElementsByName('is_recurring[]');
  var cnt_chk=0;

  $('.is_recurring_cls').each(function(){
    var iid=$(this).attr('id');
    if(iid=='is_recurring0' && cnt_chk>0)
    { 
      $(this).attr('id', 'is_recurring'+cnt);
      $('#is_recurring'+cnt).attr("data-count",cnt);
    }
    cnt_chk++;
  });

  var cnt_chk=0;
  $('.recurrint_id').each(function(){ 
    var iid=$(this).attr('id'); 
    if(iid=='btn_recurring0' && cnt_chk>0)
    {
      $(this).attr('id', 'btn_recurring'+cnt);
      $('#btn_recurring'+cnt).attr("data-target","#ModelRecurring"+cnt);
      $('#btn_recurring'+cnt).attr("data-count",cnt);
    }
    cnt_chk++;
  });

  var cnt_chk=0;
  $('.model_cls').each(function(){
    var iid=$(this).attr('id');
    if(iid=='ModelRecurring0' && cnt_chk>0)
    {
      $(this).attr('id', 'ModelRecurring'+cnt);
    }
    cnt_chk++;
  });

  var cnt_chk=0;
  $('.rcprice').each(function(){
    var iid=$(this).attr('id');
    if(iid=='recurring_price0' && cnt_chk>0)
    {
      $(this).attr('id', 'recurring_price'+cnt);
    }
    cnt_chk++;
  });
  var cnt_chk=0;
  $('.rcevery').each(function(){
    var iid=$(this).attr('id');
    if(iid=='recurring_every0' && cnt_chk>0)
    {
      $(this).attr('id', 'recurring_every'+cnt);
    }
    cnt_chk++;
  });

  var cnt_chk=0;
  $('.rcduration').each(function(){
    var iid=$(this).attr('id');
    if(iid=='recurring_duration0' && cnt_chk>0)
    {
      $(this).attr('id', 'recurring_duration'+cnt);
    }
    cnt_chk++;
  });
});

$("body").on("click", ".remove-service-price", function(){
    $(this).parent().parent().parent().remove();
});

$(document).on('click', '.rounded-corner', function() {
    var dates = removeValue($('#mdp-demo').val(), $(this).attr('date'));
    $('#mdp-demo').val(dates);
    var dateObj = [];
    selectedDate = dates.split(',');
    $.each(selectedDate, function( index, value ) {
        dateObj.push(new Date(value));
    });
   // $('#mdp-demo').datepicker(setDates, dateObj); ///nnn 15-5-2022
    $(this).remove();
});

$(document).on('click', '.delpagepost', function(){
    if(confirm("Are you sure you want to delete this?")){
        var _token = $("input[name='_token']").val();
        var serviceid =$(this).attr('serviceid');
        var imgname =$(this).attr('imgname');
        var valofi =$(this).attr('valofi');
        $.ajax({
            url: "{{url('/delimageactivity')}}",
            xhrFields: {
                withCredentials: true
            },
            type: 'post',
            data:{
                _token:_token,
                serviceid:serviceid,
                imgname:imgname,
            },
            success: function (data) {
                if(data=='success'){
                    $(".imgno_"+valofi).remove();
                }
            }
        });
    }
    else{ return false; }
});

function removeValue(list, value) {
  return list.replace(new RegExp(",?" + value + ",?"), function(match) {
      var first_comma = match.charAt(0) === ',',
          second_comma;
      if (first_comma && (second_comma = match.charAt(match.length - 1) === ',')) {
        return ',';
      }
      return '';
    });
};

var expiryMask = function() {
    var inputChar = String.fromCharCode(event.keyCode);
    var code = event.keyCode;
    var allowedKeys = [8];
    if (allowedKeys.indexOf(code) !== -1) {
        return;
    }
    event.target.value = event.target.value.replace(
        /^([1-9]\/|[2-9])$/g, '0$1/'
    ).replace(
        /^(0[1-9]|1[0-2])$/g, '$1/'
    ).replace(
        /^([0-1])([3-9])$/g, '0$1/$2'
    ).replace(
        /^(0?[1-9]|1[0-2])([0-9]{2})$/g, '$1/$2'
    ).replace(
        /^([0]+)\/|[0]+$/g, '0'
    ).replace(
        /[^\d\/]|^[\/]*$/g, ''
    ).replace(
        /\/\//g, '/'
    );
}
var splitDate = function($domobj, value) {
    var regExp = /(1[0-2]|0[1-9]|\d)\/(20\d{2}|19\d{2}|0(?!0)\d|[1-9]\d)/;
    var matches = regExp.exec(value);
    $domobj.siblings('input[name$="expiryMonth"]').val(matches[1]);
    $domobj.siblings('input[name$="expiryYear"]').val(matches[2]);
}
$('#expiry_date').on('keyup', function(){
    expiryMask();
});
$('#expiry_date').on('focusout', function(){
    splitDate($(this), $(this).val());
});
$(document).ready(function(){ 
    var service_type = $("#service_type").val();
    if(service_type != ''){
        $(".individualTxt, .classesTxt, .experienceTxt").css("color","white");
        $("."+service_type+"Txt").css("color","red");
    }
    $('#quick_business_left').text(150-parseInt($("#about_company").val().length));
    $('#company_desc_left').text(1000-parseInt($("#short_description").val().length));
    $('#frm_skilldetail_left').text(150-parseInt($("#frm_skilldetail").val().length));
    $('#frm_programdesc_left').text(500-parseInt($("#frm_programdesc").val().length));
    $('#frm_accessibility_left').text(500-parseInt($("#frm_accessibility").val().length));
    $('#addi_info_help_left').text(500-parseInt($("#addi_info_help").val().length));
    $('#desc_location_left').text(500-parseInt($("#desc_location").val().length));
    $('#frm_addi_info_left').text(1000-parseInt($("#frm_addi_info").val().length));
    $('#exp_highlight_left').text(1000-parseInt($("#exp_highlight").val().length));
   /* $('#frm_programdesc1_left').text(150-parseInt($("#frm_programdesc1").val().length));*/
    $('#house_rules_left').text(2000-parseInt($("#house_rules").val().length));
    $('#house_rules_terms_left').text(1000-parseInt($("#house_rules_terms").val().length));
    $('#cancelation_policy_left').text(1000-parseInt($("#cancelation_policy").val().length));
    $('#safety_cleaning_left').text(1000-parseInt($("#safety_cleaning").val().length));
    $('#termcondfaqtext_left').text(1000-parseInt($("#termcondfaqtext").val().length));
    $('#contracttermtext_left').text(20000-parseInt($("#contracttermtext").val().length));
    $('#refundpolicy_left').text(1000-parseInt($("#refundpolicytext").val().length));
    $('#liabilitystext_left').text(1000-parseInt($("#liabilitystext").val().length));
    $('#covidstext_left').text(1000-parseInt($("#covidstext").val().length));

    $("#about_company").on('input', function() {
        $('#quick_business_left').text(150-parseInt(this.value.length));
    });

    $("#short_description").on('input', function() {
        $('#company_desc_left').text(1000-parseInt(this.value.length));
    });

    $("#frm_skilldetail").on('input', function() {
        $('#frm_skilldetail_left').text(150-parseInt(this.value.length));
    });
    $("#frm_programdesc").on('input', function() {
        $('#frm_programdesc_left').text(500-parseInt(this.value.length));
    });

    $("#frm_accessibility").on('input', function() {
        $('#frm_accessibility_left').text(500-parseInt(this.value.length));
    }); 

    $("#addi_info_help").on('input', function() {
        $('#addi_info_help_left').text(500-parseInt(this.value.length));
    }); 

    $("#frm_addi_info").on('input', function() {
        $('#frm_addi_info_left').text(1000-parseInt(this.value.length));
    });

    $("#exp_highlight").on('input', function() {
        $('#exp_highlight_left').text(1000-parseInt(this.value.length));
    });
    $("#desc_location").on('input', function() {
        $('#desc_location_left').text(500-parseInt(this.value.length));
    });
  /*$("#what_you_doing").on('input', function() {
        $('#frm_what_you_doing').text(500-parseInt(this.value.length));
    });*/
    /*$("#frm_programdesc1").on('input', function() {
        $('#frm_programdesc1_left').text(150-parseInt(this.value.length));
    });*/
    $("#house_rules").on('input', function() {
        $('#house_rules_left').text(2000-parseInt(this.value.length));
    });

    $("#house_rules_terms").on('input', function() {
        $('#house_rules_terms_left').text(1000-parseInt(this.value.length));
    });
    $("#cancelation_policy").on('input', function() {
        $('#cancelation_policy_left').text(1000-parseInt(this.value.length));
    });
    $("#safety_cleaning").on('input', function() {
        $('#safety_cleaning_left').text(1000-parseInt(this.value.length));
    });
    $("#termcondfaqtext").on('input', function() {
        $('#termcondfaqtext_left').text(1000-parseInt(this.value.length));
    }); 
    $("#contracttermtext").on('input', function() {
        $('#contracttermtext_left').text(20000-parseInt(this.value.length));
    });
    $("#liabilitystext").on('input', function() {
        $('#liabilitystext_left').text(1000-parseInt(this.value.length));
    }); 
    $("#refundpolicytext").on('input', function() {
        $('#refundpolicy_left').text(1000-parseInt(this.value.length));
    });
    $("#liabilitytext").on('input', function() {
        $('#liabilitytext_left').text(1000-parseInt(this.value.length));
    });
    $("#covidstext").on('input', function() {
        $('#covidstext_left').text(1000-parseInt(this.value.length));
    });
    var wo_json = [];
    //updateMap(wo_json, null);
    $('#milesnew').change(function() {
        var zoom = 9;
        if ($('#milesnew option:selected').val() == 1) {
            var miles = 4;
        } else if ($('#milesnew option:selected').val() == 3) {
            var miles = 5;
        } else if ($('#milesnew option:selected').val() == 5) {
            var miles = 6;
        } else {
            var miles = $('#milesnew option:selected').val();
        }
        //console.log('map canvas = ', miles, zoom);
        $('#map_canvas').empty();
        var geocoder = new google.maps.Geocoder();
        var address = $("#wanttowork").val();
        geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == "OK") {
        	var lat = results[0].geometry.location.lat();
            var long = results[0].geometry.location.lng();
        	//var lat = results[0].geometry.bounds.Bb.h;
			//var long = results[0].geometry.bounds.Ra.h;
			//console.log(lat + "=" + long);
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
            } 
        });
    });

    $('#refresh_map').click(function() {
        var zoom = 9;
        if ($('#milesnew option:selected').val() == 1) {
            var miles = 4;

        } else if ($('#milesnew option:selected').val() == 3) {
            var miles = 5;

        } else if ($('#milesnew option:selected').val() == 5) {
            var miles = 6;
        } else {
            var miles = $('#milesnew option:selected').val();
        }
        $('#map_canvas').empty();
        var geocoder = new google.maps.Geocoder();
        var address = $("#wanttowork").val();
        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == "OK") {
                //var lat = results[0].geometry.bounds.Bb.h;
                //var long = results[0].geometry.bounds.Ra.h;
      			var lat = results[0].geometry.location.lat();
            	var long = results[0].geometry.location.lng();
                //console.log(lat + "=" + long);
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
            } 
        });
    });
    var date = new Date();
    date.setDate(date.getDate()-1);
    $(".ui-datepicker-div").hide();
    $('#startingpicker').datepicker({
       minDate: 0
    }).change(activitySchedule);
    $("body").on("change",".shift_start, .shift_end", function(){
        var timeStart = new Date("01/01/2007 " + $(this).parent().parent().find('.shift_start').val());
        var timeEnd = new Date("01/01/2007 " + $(this).parent().parent().find('.shift_end').val());
        var seconds = Math.floor((timeEnd - (timeStart))/1000);
        var minutes = Math.floor(seconds/60);
        var hours = Math.floor(minutes/60);
        var days = Math.floor(hours/24);
        hours = hours-(days*24);
        minutes = minutes-(days*24*60)-(hours*60);
        seconds = seconds-(days*24*60*60)-(hours*60*60)-(minutes*60);
        if(hours > 1 || hours < -1) {
        	var duration = hours + ' hours ' + minutes + ' minutes ' + seconds + ' second';
        } else {
        	var duration = hours + ' hour ' + minutes + ' minutes ' + seconds + ' second';  
        }
        $(this).parent().parent().find('.set_duration').val(duration);
    });
    $("body").on("click", ".daycircle", function(){
        if($("#frm_class_meets").val() == 'Weekly')
    	{
			activity_days = "";     
      		$(this).find(".weekdays").each( function() {
				$.each( $(this).find('.day_circle'), function( key, value ) {
					if ($(this).hasClass('day_circle_fill')) {
            			activity_days += value.classList[3] + ",";
          			}  
				});
			});
            $(this).find('.activity_days').val(activity_days);
        }
    	if($("#frm_class_meets").val() == 'On a specific day')
		{
			activity_days = "";
            $.each( $(this).find('.weekdays').children(".day_circle_fill"), function( key, value ) {
                activity_days += value.classList[3] + ","
            });
            $(this).find('.activity_days').val(activity_days);
    	}
    });

    $("body").on("click", ".remove-activity", function(){
		if($('#duration_cnt').val()<=0)
		{
       		$(this).closest(".daycircle").hide();
		}
    	else
    	{
      		$(this).closest(".daycircle").remove();
    	}
       var cnt=$('#duration_cnt').val();
       var cnt1;
       if( cnt <= 0){ cnt1 = 0; }
       else{ cnt1 = cnt-1; }
       $('#duration_cnt').val(cnt1);
    });
  $("body").on("click", ".add-another-time", function(){ 
    var cnt=$('#duration_cnt').val();
    cnt++;
    $('#duration_cnt').val(cnt);
        var add_time = "";
        add_time += '<div id="dayduration'+cnt+'"><div class="daycircle" >';
    	add_time += $(".daycircle").html();
        add_time += '</div></div>';
        $("#activity_scheduler_body").append(add_time);
       // $("#activity_scheduler_body .daycircle").show();
        $(".remove-week").show();   
		parent = document.querySelector("#dayduration"+cnt);
		shift_start = parent.querySelector('#shift_start').value='';
		shift_end = parent.querySelector('#shift_end').value='';
		set_duration = parent.querySelector('#set_duration').value='';
		$("#dayduration"+cnt).parent().find('div.timezone-round').removeClass("day_circle_fill");
    });
    $("#frm_class_meets").on("change", function () {
        $('#startingpicker').val('');
        $(".daycircle").hide();
        $(".remove-week").hide();
        var day = moment($('#startingpicker').val(), 'MM-DD-YYYY').format('dddd');
        var activityMeet = $(this).val();
        $("#activity_scheduler_body").html("");
        $(".timezone-round").removeClass('day_circle_fill');
        $(".timezone-round").css('pointer-events', 'none');
        if(activityMeet == 'Weekly') {
            if(day=='Monday') {
                $(".Monday").css('pointer-events', '');
                $(".Tuesday").css('pointer-events', '');
                $(".Wednesday").css('pointer-events', '');
                $(".Thursday").css('pointer-events', '');
                $(".Friday").css('pointer-events', '');
                $(".Saturday").css('pointer-events', '');
            }
            if(day=='Tuesday') {
                $(".Tuesday").css('pointer-events', '');
                $(".Wednesday").css('pointer-events', '');
                $(".Thursday").css('pointer-events', '');
                $(".Friday").css('pointer-events', '');
                $(".Saturday").css('pointer-events', '');
            }
            if(day=='Wednesday') {
                $(".Wednesday").css('pointer-events', '');
                $(".Thursday").css('pointer-events', '');
                $(".Friday").css('pointer-events', '');
                $(".Saturday").css('pointer-events', '');
            }
            if(day=='Thursday') {
                $(".Thursday").css('pointer-events', '');
                $(".Friday").css('pointer-events', '');
                $(".Saturday").css('pointer-events', '');
            }
            if(day=='Friday') {
                $(".Friday").css('pointer-events', '');
                $(".Saturday").css('pointer-events', '');
            }
            if(day=='Saturday') {
                $(".Saturday").css('pointer-events', '');
            }
            if(day=='Sunday') {
                $(".Monday").css('pointer-events', '');
                $(".Tuesday").css('pointer-events', '');
                $(".Wednesday").css('pointer-events', '');
                $(".Thursday").css('pointer-events', '');
                $(".Friday").css('pointer-events', '');
                $(".Saturday").css('pointer-events', '');
                $(".Sunday").css('pointer-events', '');
            }
            //$(".remove-week").show();
        }
        $(".timezone-round").removeClass('day_circle_fill');
        $(".daycircle ."+day).addClass('day_circle_fill');
        $("#activity_scheduler_body").append($("#day-circle").html());
        $("#activity_scheduler_body .daycircle").show();
        $('#startingpicker').datepicker('hide');     
    });
	function activitySchedule(event) { 
        var d = new Date($('#startingpicker').val());
    	var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
    	$(".daycircle").hide();
        $(".remove-week").hide();
        //var day = moment($(this).val(), 'MM-DD-YYYY').format('dddd');
        var day = weekday[d.getDay()];
        var activityMeet = $("#frm_class_meets").val();
        $("#activity_scheduler_body").html("");
        $(".timezone-round").removeClass('day_circle_fill');
        //$(".timezone-round").css('pointer-events', 'none');
        if(activityMeet == 'Weekly') {
            if(day=='Monday') {
                $(".Monday").css('pointer-events', '');
                $(".Tuesday").css('pointer-events', '');
                $(".Wednesday").css('pointer-events', '');
                $(".Thursday").css('pointer-events', '');
                $(".Friday").css('pointer-events', '');
                $(".Saturday").css('pointer-events', '');
            }
            if(day=='Tuesday') {
                $(".Tuesday").css('pointer-events', '');
                $(".Wednesday").css('pointer-events', '');
                $(".Thursday").css('pointer-events', '');
                $(".Friday").css('pointer-events', '');
                $(".Saturday").css('pointer-events', '');
            }
            if(day=='Wednesday') {
                $(".Wednesday").css('pointer-events', '');
                $(".Thursday").css('pointer-events', '');
                $(".Friday").css('pointer-events', '');
                $(".Saturday").css('pointer-events', '');
            }
            if(day=='Thursday') {
                $(".Thursday").css('pointer-events', '');
                $(".Friday").css('pointer-events', '');
                $(".Saturday").css('pointer-events', '');
            }
            if(day=='Friday') {
                $(".Friday").css('pointer-events', '');
                $(".Saturday").css('pointer-events', '');
            }
            if(day=='Saturday') {
                $(".Saturday").css('pointer-events', '');
            }
            if(day=='Sunday') {
                $(".Monday").css('pointer-events', '');
                $(".Tuesday").css('pointer-events', '');
                $(".Wednesday").css('pointer-events', '');
                $(".Thursday").css('pointer-events', '');
                $(".Friday").css('pointer-events', '');
                $(".Saturday").css('pointer-events', '');
                $(".Sunday").css('pointer-events', '');
            }
            //$(".remove-week").show();
        }
        $(".timezone-round").removeClass('day_circle_fill');
        //$(".daycircle ."+day).addClass('day_circle_fill');
    
        var cnt=$('#duration_cnt').val();
        if(cnt>=0){
          $("#editscheduler").hide();
          $("#dayduration0 .daycircle").show();
          //$("#activity_scheduler_body").append($("#dayduration0").html());
          $('#duration_cnt').val('0');
        }
        else
        {
          $("#activity_scheduler_body").append($("#day-circle").html());
        }
            $("#activity_scheduler_body .daycircle").show();
            $(this).datepicker('hide');
        var cnt=$('#duration_cnt').val();
        parent = document.querySelector("#dayduration"+cnt);
        shift_start = parent.querySelector('#shift_start').value='';
        shift_end = parent.querySelector('#shift_end').value='';
        set_duration = parent.querySelector('#set_duration').value='';
    }
    /* 
     * *********************************************
     * Business Specification Checks 
     * *********************************************
     */
    $("#hours1").click(function () {
        $("#selectdays").show();
    });
    $("#hours2").click(function () {
        $("#selectdays").hide();
    });
    $("#hours3").click(function () {
        $("#selectdays").hide();
    });
    $("#hours4").click(function () {
        $("#selectdays").hide();
    });
    
    $('#mdp-demo').datepicker({
        todayHighlight: true,
        multidate: true,
        startDate: date
    }).change(dateChanged);
    
    function dateChanged(event) {
        //$(this).datepicker('hide');
        var dates = $('#mdp-demo').val();
        var dateObj = [];
        selectedDate = dates.split(',');
        $('.manual-remove').html("");
        $.each(selectedDate, function( index, value ) {
            dateObj.push(value);
            if(value!='') {
            $('.manual-remove').append('<button type="button" date="' + value + '" class="rounded-corner">' + value + ' x</button>');
            }
        });        
        
        /*
        var dateText = $(this).val();
        var dates = dateText.split(/[\s,]+/);
        var fdate = dates[dates.length-1];
        if(fdate!='') {
        $('.manual-remove').append('<button type="button" date="' + fdate + '" class="rounded-corner">' + fdate + ' x</button>');
        }
        */
    }
    /* Set the value of slimSelect drop down list */
    var langarr = [];
    var languages = '{{ $languages }}';
    languages = languages.split(',');
    $.each(languages, function( index, value ) {
       langarr.push(value);
    });
    const displaySelect = new SlimSelect({
        select: '#testdemo'
    });
    displaySelect.set(langarr);
    
    var busiarr = [];
    var serBusinessoff1 = '{{ $serBusinessoff1 }}';
    serBusinessoff1 = serBusinessoff1.split(',');
    $.each(serBusinessoff1, function( index, value ) {
        busiarr.push(value);
    });
    const displaySelect1 = new SlimSelect({
        select: '#serBusinessoff1'
    });
    displaySelect1.set(busiarr);   
    var medicalarr = [];
    var medicaltype = '{{ $medical_type }}';
    medicaltype = medicaltype.split(',');
    $.each(medicaltype, function( index, value ) {
        medicalarr.push(value);
    });
    const displaySelect2 = new SlimSelect({
        select: '#mcc'
    });
    displaySelect2.set(medicalarr);
    var goalarr = [];
    var goaloption = '{{ $goals_option }}';
    goaloption = goaloption.split(',');
    $.each(goaloption, function( index, value ) {
        goalarr.push(value);
    });
    const displaySelect3 = new SlimSelect({
        select: '#fitness_goals_array'
    });
    displaySelect3.set(goalarr);
    /* Service Specifics - Radio button click event show or hide relevent section */
    $('input[name="medical_states"]').click(function(){
        if($(this).val() == 1) {
            $("#medproblm").show();
        } else {
            $("#medproblm").hide();
        }
    });

    $('input[name="fitness_goals"]').click(function(){
        if($(this).val() == 1) {
            $("#fit-goals").show();
        } else {
            $("#fit-goals").hide();
        }
    });
   
    /*$('input[name="hours_opt"]').click(function(){
        if($(this).val() == 'Temporalily closed' || $(this).val() == 'Permanently closed') {
            $("#selected_date_off").hide();
        } else {
            $("#selected_date_off").show();
        }
    });
    */
    /* Business Specific - On page load special dates displaying right side section */
    var special_dates = '{{ $special_days_off }}';  
    special_dates = special_dates.split(',');
    $.each(special_dates, function( index, value ) {
        if(value != "") {
            $('.manual-remove').append('<button type="button" date="' + value + '" class="rounded-corner">' + value + ' x</button>');
        }
    });
    
    /* 
     * *********************************************
     * Business Terms Checks 
     * *********************************************
     */
    /* Terms - Checkbox button click event show or hide relevent section */
    $("#termcondfaq").click(function(){
        if($("#termcondfaq").is(':checked')) {
            $("#termcondfaqdiv").show();
        } else {
            $("#termcondfaqdiv").hide();
        }
    });
    $("#contractterm").click(function(){
        if($("#contractterm").is(':checked')) {
            $("#contracttermdiv").show();
        } else {
            $("#contracttermdiv").hide();
        }
    }); 

    $("#liabilitys").click(function(){
        if($("#liabilitys").is(':checked')) {
            $("#liabilitysdiv").show();
        } else {
            $("#liabilitysdiv").hide();
        }
    });
    $("#refundpolicy").click(function(){
        if($("#refundpolicy").is(':checked')) {
            $("#refundpolicydiv").show();
        } else {
            $("#refundpolicydiv").hide();
        }
    });    
 
    $("#covids").click(function(){
        if($("#covids").is(':checked')) {
            $("#covidsdiv").show();
        } else {
            $("#covidsdiv").hide();
        }    
    });    
    
    /* Business Terms - On page load hidden content show/hide */
    if($("#termcondfaq").is(':checked')) {$("#termcondfaqdiv").show();}
    if($("#contractterm").is(':checked')) {$("#contracttermdiv").show();}
    if($("#liabilitys").is(':checked')) {$("#liabilitysdiv").show();}
    if($("#refundpolicy").is(':checked')) {$("#refundpolicydiv").show();}
    if($("#covids").is(':checked')) {$("#covidsdiv").show();}
    
    /* 
     * *********************************************
     * Business Experience Checks 
     * *********************************************
     */
    
    /* Business Experience - Calendar object attached with elements */
    $('#dp1, #dp2, #completionyear, #skillcompletionpicker, #date_birth').Zebra_DatePicker({
        format: 'm/d/Y',
       default_position: 'below'
    });

    $('#passingyear').Zebra_DatePicker({
        format: 'Y',
        default_position: 'below'
    });
    /* Form navigation after the submission */
    var data = '{{$user->bstep}}'; 
    if(data == '1' || data == '0'){
        $("#tab1").addClass("tab-active");
        $("#frmWelcomediv").show();
    }
    if(data == '2'){
        $("#tab2").addClass("tab-active");
	    $("#tab1").removeClass("tab-active");
        $("#companyDetaildiv").show();
    }
    if(data == '3'){
        $("#tab3").addClass("tab-active");
	    $("#tab1").removeClass("tab-active");
        $("#empHistorydiv").show();
    }
    if(data == '4'){
        $("#tab4").addClass("tab-active");
	    $("#tab1").removeClass("tab-active");
        $("#serviceSpecificsdiv").show();
    }
    if(data == '5'){
        $("#tab5").addClass("tab-active");
	    $("#tab1").removeClass("tab-active");
        $("#termSetdiv").show();
    }
    if(data == '6'){
       $("#tab6").addClass("tab-active");
	   $("#tab1").removeClass("tab-active");
       $("#frmVerifieddiv0").show();
	    // $("#creServicediv").show();
    }
    if(data == '7'){
        $("#tab7").addClass("tab-active");
	    $("#tab1").removeClass("tab-active");
        $("#creServicediv").show();
    }
    if(data == '71'){
        $("#tab7").addClass("tab-active");
	    $("#tab1").removeClass("tab-active");
        $("#creServicediv").show();
    }
    if(data == '72'){
        $("#tab7").addClass("tab-active");
    	$("#tab1").removeClass("tab-active");
	    ///$("#individualDiv1").show(); ///nnn
	    $("#individualDiv2").show();
	    $('#current_tab_name').val('individualDiv2');
        if($('#service_type').val() == 'individual') {
            $("#individualstype").show();
          $('#current_tab_name').val('individualDiv0');
        }
        if($('#service_type').val() == 'classes') {
            //$("#classesDiv1").show();
            $("#experiencestype").show();
            $('#current_tab_name').val('individualDiv0');
        } 
        if($('#service_type').val() == 'events') {
            $("#experiencestype").show();
            $('#current_tab_name').val('individualDiv0');
        }
        if($('#service_type').val()=='experience') {
             $("#experiencestype").show();
             $("#experienceitinerary").show();
            $('#current_tab_name').val('individualDiv0');
        }
    	/*if($('#service_type').val()=='experience'){
      		$('.itenerary_div').show();
    	}*/
    }
    if(data == '8'){
        $("#tab8").addClass("tab-active");
    	$("#tab1").removeClass("tab-active");
        $("#bookingInfodiv").show();
    }
    //$('#date_birth').datepicker({});
    /* Business Verified - multi form next button */
    $("#nextverified0").click(function(){
       $("#frmVerifieddiv0").hide();
       $("#frmVerifieddiv").show();
   	 // $("#creServicediv").show();
    });
    $("#nextverified1").click(function(){
        var card_number = $('#card_number').val();
        var name_card = $('#name_card').val();
        var expiry_date = $('#expiry_date').val();
        var cvv = $('#cvv').val();
        $('#err_card_number').html('');
        $('#err_name_card').html('');
        $('#err_expiry_date').html('');
        $('#err_cvv').html('');       
        var str = /^[a-zA-Z\s]+$/;       
        if(card_number == ''){
            $('#err_card_number').html('Please enter card number');
            $('#card_number').focus();
            return false;
        }
        if(name_card == ''){
            $('#err_name_card').html('Please enter card owner');
            $('#name_card').focus();
            return false;
        }
        if(!str.test(name_card)){
            $('#err_name_card').html('Card owner name should be in alphabets');
            $('#name_card').focus();
              return false;
        }
        if(expiry_date == ''){
            $('#err_expiry_date').html('Please enter expiry date');
            $('#expiry_date').focus();
            return false;
        }
        if(cvv == ''){
            $('#err_cvv').html('Please enter CVV number');
            $('#cvv').focus();
            return false;
        }        
        $("#frmVerifieddiv").hide();
        $("#frmVerifieddiv1").show();
    });
    $("#nextverified2").click(function(){
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var date_birth = $('#date_birth').val();
        var security_number = $('#security_number').val();
        var phone_number = $('#phone_number').val();
        var eamil = $('#eamil').val();
        var radio_verified = $('#radio_verified').val();       
        $('#err_first_name').html('');
        $('#err_last_name').html('');
        $('#err_date_birth').html('');
        $('#err_security_number').html('');
        $('#err_phone_number').html('');
        $('#err_eamil').html('');
        $('#err_radio_verified').html('');
        var filter = /^\d*(?:\.\d{1,2})?$/;
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var str = /^[a-zA-Z\s]+$/;
  
        if(first_name == ''){
            $('#err_first_name').html('Please enter first name');
            $('#first_name').focus();
            return false;
        }
        if(last_name == ''){
            $('#err_last_name').html('Please enter last name');
            $('#last_name').focus();
            return false;
        }
        if(date_birth == ''){
            $('#err_date_birth').html('Please enter date of birth');
            $('#date_birth').focus();
            return false;
        }
        if(security_number == ''){
            $('#err_security_number').html('Please enter social security number');
            $('#security_number').focus();
            return false;
        }
        if(phone_number == ''){
            $('#err_phone_number').html('Please enter phone number');
            $('#phone_number').focus();
            return false;
        }
        if(filter.test(phone_number)){
            if(b_contact.length > 9 || b_contact.length < 9){
                $('#err_phone_number').html('Phone number is not valid.');
                $('#phone_number').focus();
                return false;
            }
        }
        if(eamil == ''){
            $('#err_eamil').html('Please enter Email');
            $('#eamil').focus();
            return false;
        }
        if(!regex.test(eamil)){
            $('#err_eamil').html('Please enter valid email');
            $('#eamil').focus();
            return false;
        }
        if ($('input[name="radio_verified"]:checked').length == 0) {
            $('#err_radio_verified').html('You agree to Fitnessity, Inc. and Evident ID, Inc');
            $('#radio_verified').focus();
            return false;
        }
        
        $("#frmVerifieddiv1").hide();
        $("#frmVerifieddiv2").show();
    });
    $("#nextverified3").click(function(){
        $('#err_summary_receipt').html('');
        if ($('input[name="summary_receipt"]:checked').length == 0) {
            $('#err_summary_receipt').html('I acknowledge receipt of the Summary');
            $('#summary_receipt').focus();
            return false;
        }
        $("#frmVerifieddiv2").hide();
        $("#frmVerifieddiv3").show();
    });
    $("#nextverified4").click(function(){       
        $('#err_receive_consumer').html('');
        $('#err_full_name').html('');
        if ($('input[name="receive_consumer"]:checked').length == 0) {
            $('#err_receive_consumer').html('You would like to receive a copy of a consumer report');
            $('#receive_consumer').focus();
            return false;
        }
        if ($('#full_name').val()=="") {
           $('#err_full_name').html('Please enter full name');
           $('#full_name').focus();
           return false;
       }
       $("#frmVerifieddiv3").hide();
       $("#frmVerifieddiv4").show();
   });

    /* Business Verified - multi form back button */
    /* First back button will jump on previous step
     * $("#backverified1").click(function(){
        $("#individualDiv1").hide();
        $("#creServicediv").show();
    });*/
    $("#backverified1").click(function(){
        $("#frmVerifieddiv").hide();
        $("#frmVerifieddiv0").show();
    });
    $("#backverified2").click(function(){
        $("#frmVerifieddiv1").hide();
        $("#frmVerifieddiv").show();
    });
    $("#backverified3").click(function(){
        $("#frmVerifieddiv2").hide();
        $("#frmVerifieddiv1").show();
    });
    $("#backverified4").click(function(){
        $("#frmVerifieddiv3").hide();
        $("#frmVerifieddiv2").show();
    });
    $("#backverified5").click(function(){
        $("#frmVerifieddiv4").hide();
        $("#frmVerifieddiv3").show();
    });
    /* Business Services - Individual form next button */   
    $(".clsManageService").click(function () { 
        var sid = $(this).data('sid');
    $.ajax({
      url: "{{url('/getServiceData')}}",
      type: 'post',
      data:{
        _token: '<?php echo csrf_token(); ?>',
        sid:sid,
      },
      success: function (data) {;
        location.reload(true);
      }
    });
  
        /*var sid = $(this).data('sid');
        $("#serviceid").val(sid);
        var service_type = "{{ $service_type }}";
        $(".manageserviceUL li").hide();
        $(".manageserviceUL li."+service_type).show();
        if(service_type == 'individual') {
            $("#test1").prop("checked", true);
        } else if(service_type == 'classes') {
            $("#test2").prop("checked", true);
        } else if(service_type == 'experience') {
            $("#test3").prop("checked", true);
        }
        $(".individualTxt, .classesTxt, .experienceTxt").css("color","white");
        $("."+service_type+"Txt").css("color","red");
        $("#frm_servicesport option:selected").val("{{ $sport_activity }}");
        $("#frm_servicesport option:selected").text("{{ $sport_activity }}");
        $("#frm_servicetitle_two").val("{{ $program_name }}");
        $("#frm_programname").val("{{ $program_name }}");
        $("#booking1").prop("checked", true);
        $("#creServicediv").hide();
        $("#individualDiv0").hide();
   		$("#individualDiv2").show();
    	$('#current_tab_name').val('individualDiv2');*/
    });
    $("#btnCreateService").click(function () {
      	var service_type = $("#service_type").val();
        $("#serviceid").val(0);
        $("#test1").prop("checked", true);     
        $("#individualBody, #classesBody, #experienceBody").hide();
        $("."+service_type+"Body").show();
        $(".individualTxt, .classesTxt, .experienceTxt").css("color","white");
        $("."+service_type+"Txt").css("color","red");
        $("#frm_servicesport option:selected").val("");
        $("#frm_servicesport option:selected").text("Choose a Sport/Activity");
        $("#frm_servicetitle_two").val("");
        $("#frm_programname").val("");
        $("#frm_programdesc").val("");
	    $("#what_you_doing").val("");
	    $("#days_description").val("");
        $("#showimgservice").attr("src","");
        $("#oldservicepic").val("");
        $("#booking1").prop("checked", false);

	    var cid = $("#cid").val();
    	$.ajax({
    	    url: "{{url('/NewService')}}",
    	    type: 'post',
    		data:{
    			_token: '<?php echo csrf_token(); ?>',
    			cid:cid,
    			service_type : service_type,
    		},
          	success: function (data) {
            	location.reload();
    	    }
        });
    	/*$("#individualDiv0").hide();
        if(service_type.trim()=='experience'){
          	$('.itenerary_div').show();
        }
        else
          	$('.itenerary_div').hide();
    	    $("#individualDiv2").show();
        	$('#current_tab_name').val('individualDiv2');*/
    });
    $("#btnManageService").click(function () {
        var service_type = $("#service_type").val();
        $(".manageserviceUL li").hide();
        $(".manageserviceUL li."+service_type).show();
    });
    $("#nextservice").click(function () {
        var service_type=$("input[name='radio_group']:checked").val();
        $("#service_type").val(service_type);      
        $(".individualBody, .classesBody, .experienceBody").hide();
        $("."+service_type+"Body").show();       
        $(".manageserviceUL li").hide();
        $(".manageserviceUL li."+service_type).show();
        $("#creServicediv").hide();
        if(service_type == 'individual') {
            $("#individualDiv0").show();
            $("#individualstype").show();
	      $('#current_tab_name').val('individualDiv0');
        }
        if(service_type == 'classes') {
            //$("#classesDiv1").show();
            $("#individualDiv0").show();
            $("#experiencestype").show();
      		$('#current_tab_name').val('individualDiv0');
        }
        if(service_type == 'experience') {
            $("#individualDiv0").show();
             $("#experiencestype").show();
             $("#experienceitinerary").show();
      		$('#current_tab_name').val('individualDiv0');
        }
    });
    $("#nextindividual0").click(function(){
        $("#individualDiv0").hide();
        //$("#individualDiv1").show(); ///nnn
    	$("#individualDiv2").show();
   		$('#current_tab_name').val('individualDiv2');
    });
    $("#nextindividual1").click(function(){
        var sport_activity = $("#frm_servicesport").val();
        var program_name = $("#frm_servicetitle_two").val();
        var service_type = $("#service_type").val();
        $('#lbl_activity').html(sport_activity);
        $('#frm_programdesc_left').text(500-parseInt($("#frm_programdesc").val().length));
        $('#err_frm_servicesport').html('');
        $('#err_frm_servicetitle_two').html('');
    
        if(sport_activity == ''){
            $('#err_frm_servicesport').html('Please select any sport activity.');
            $('#frm_servicesport').focus();
            return false;
        }

        if(program_name == ''){
            $('#err_frm_servicetitle_two').html('Please enter program name');
            $('#frm_servicetitle_two').focus();
            return false;
        }

        $(".individualTxt, .classesTxt, .experienceTxt").css("color","white");
        $("."+service_type+"Txt").css("color","red");
        $("#individualDiv1").hide();
        $("#individualDiv2").show();
	    $('#current_tab_name').val('individualDiv2');
    });
    $("#nextindividual2").click(function(){
        loadMap();
        var sport_activity = $("#frm_servicesport").val();
        var program_name = $("#frm_programname").val();
        var program_desc = $("#frm_programdesc").val();
        var instant_booking = $("#booking1").val();
        var service_pic = $("#imgUpload").val();
        $('#err_frm_servicesportS2').html('');
        $('#err_frm_programname').html('');
        $('#err_frm_programdesc').html('');
        $('#err_booking1').html('');
        $('#err_oldservicepic').html('');
        if(sport_activity == ''){ 
            $('#err_frm_servicesportS2').html('Please select any sport activity.');
            $('#frm_servicesport').focus();
            return false;
        }

        if(program_name == ''){
            $('#err_frm_programname').html('Please enter program name');
            $('#frm_programname').focus();
            return false;
        }

        if(program_desc == ''){ 
            $('#err_frm_programdesc').html('Please enter program description.');
            $('#frm_programdesc').focus();
            return false;
        }

        if($("#what_you_doing").is(":visible")){ 
            var what_you_doing = $("#what_you_doing").val();
            $('#err_what_you_doing').html('');
            if(what_you_doing == ''){ 
                $('#err_what_you_doing').html('Please enter what will you be doing.');
                $('#what_you_doing').focus();
                return false;
            }
        }

        if($('#is_late_fee').val()=="Yes")
        { 
            if($('#late_fee').val()=="")
            { 
                $('#err_late_fee').html('Please enter late fee amount.');
                $('#late_fee').focus();
                return false;
            }
        }else{
            $("[name='late_fee']").prop("required", false);
            $('#err_late_fee').html(' ');
        }

        var service_type = $("#service_type").val();
        $("#individualDiv2").hide();
        $("#individualDiv3").show();

        if(service_type.trim()=='individual'){
            $(".location_div").show();
            $('.location_div_experience').hide();
        }
        
        $('#current_tab_name').val('individualDiv3');
    });

    $("#nextindividual3").click(function(){
        var stype = $(this).attr('data-type');
        if(stype == 'experience'){
            if($("#frm_included_things").is(":hidden")){
                var included_things = $("#frm_included_things").val();
                $('#err_what_included').html('');
                if(included_things == '' || included_things == null){ 
                    $('#err_what_included').html('Please Select.');
                    $('#frm_included_things').focus();
                    return false;
                }
            }

            if($("#frm_notincluded_things").is(":hidden")){ 
                var notincluded_things = $("#frm_notincluded_things").val();
                $('#err_what_not_included').html('');
                if(notincluded_things == '' || notincluded_things == null){ 
                    $('#err_what_not_included').html('Please Select.');
                    $('#frm_notincluded_things').focus();
                    return false;
                }
            }

            if($("#frm_wear").is(":hidden")){ 
                var wear = $("#frm_wear").val();
                $('#err_what_guest_bring').html('');
                if(wear == '' || wear == null){ 
                    $('#err_what_guest_bring').html('Please Select.');
                    $('#frm_wear').focus();
                    return false;
                }
            }
        }
        
        $("#individualDiv3").hide();
        $("#individualDiv5").show();
        $('#current_tab_name').val('individualDiv5');
    });

    $("#nextindividual4").click(function(){

    /*$('input[name="shift_start[]"]').each(function(){
      alert($(this).val());
    });*/
        // $("#individualDiv4").hide();
        // $("#individualDiv5").show();
    // $('#current_tab_name').val('individualDiv5');
    });
    $("#nextindividual5").click(function(){
       $('#err_pay_session_type').html('');
       $('#err_pay_session').html('');
       $('#err_pay_setnum').html('');
       $('#err_pay_setduration').html('');
       $('#err_pay_after').html('');
    });
    /* Business Services - Individual form back button */
    $("#backindividual0").click(function(){
        $(".individualTxt, .classesTxt, .experienceTxt").css("color","white");
        $("#individualDiv0").hide();
        $("#creServicediv").show();
    });
    $("#backindividual1").click(function(){
        $("#individualDiv1").hide();
        $("#individualDiv0").show();
	    $('#current_tab_name').val('individualDiv0');
    });
    $("#backindividual2").click(function(){
        $("#individualDiv2").hide();
       // $("#individualDiv1").show(); ///nnn
	     $("#individualDiv0").show();
	     $('#current_tab_name').val('individualDiv0');
    });
    $("#backindividual3").click(function(){
        /*$("#individualDiv3").hide(); */
        $("#individualDiv3").hide();
        $("#individualDiv2").show();
	    $('#current_tab_name').val('individualDiv2');
    });
    $("#backindividual4").click(function(){
        $("#individualDiv4").hide();
        // $("#individualDiv3").show();
        $("#individualDiv5").show();
	    $('#current_tab_name').val('individualDiv3');
    });
    $("#backindividual5").click(function(){
        $("#individualDiv5").hide();
        // $("#individualDiv4").show();
        $("#individualDiv3").show();
	    $('#current_tab_name').val('individualDiv4');
    });
    
    /* Business Services - Classes form next button */
    $("#nextclasses1").click(function(){
        $("#classesDiv1").hide();
        $("#classesDiv2").show();
    });
    $("#nextclasses2").click(function(){
        $("#classesDiv2").hide();
        $("#classesDiv3").show();
    });
    $("#nextclasses3").click(function(){
        $("#classesDiv3").hide();
        $("#classesDiv4").show();
    });
    $("#nextclasses4").click(function(){
        $("#classesDiv4").hide();
        $("#classesDiv5").show();
    });
    /* Business Services - Classes form back button */
    $("#backclasses1").click(function(){
        $("#classesDiv1").hide();
        $("#creServicediv").show();
    });
    $("#backclasses2").click(function(){
        $("#classesDiv2").hide();
        $("#classesDiv1").show();
    });
    $("#backclasses3").click(function(){
        $("#classesDiv3").hide();
        $("#classesDiv2").show();
    });
    $("#backclasses4").click(function(){
        $("#classesDiv4").hide();
        $("#classesDiv3").show();
   });
    $("#backclasses5").click(function(){
        $("#classesDiv5").hide();
        $("#classesDiv4").show();
    });
    /* Business Services - Experience form next button */
    $("#nextexperiences1").click(function(){
               
        var sport_activity = $("#frm_servicesport1").val();
        var program_name = $("#frm_servicetitle_two1").val();
        $('#lbl_activity1').html(sport_activity);
        $('#err_frm_servicesport1').html('');
        $('#err_frm_servicetitle_two1').html('');
        if(sport_activity == ''){
            $('#err_frm_servicesport1').html('Please select any sport activity.');
            $('#frm_servicesport1').focus();
            return false;
        }
        if(program_name == ''){
            $('#err_frm_servicetitle_two1').html('Please enter program name');
            $('#frm_servicetitle_two1').focus();
            return false;
         }
        $("#experiencesDiv1").hide();
        $("#experiencesDiv2").show();
    });
    
    $("#nextexperiences2").click(function(){              
        var program_name = $("#frm_programname1").val();
        var program_desc = $("#frm_programdesc1").val();
        var instant_booking = $("#booking_1").val();
        var service_pic = $("#oldservicepic1").val();
        $('#err_frm_programname1').html('');
        $('#err_frm_programdesc1').html('');
        $('#err_booking_1').html('');
        $('#err_oldservicepic1').html('');
        if(program_name == ''){
            $('#err_frm_programname1').html('Please enter program name');
            $('#frm_programname1').focus();
            return false;
        }
        if(program_desc == ''){
            $('#err_frm_programdesc1').html('Please enter program description.');
            $('#frm_programdesc1').focus();
            return false;
        }
        if (!$('#booking_1').is(":checked")) {
            $('#err_booking_1').html('Please enabled instant booking');
            $('#booking_1').focus();
            return false;
        }
        if(service_pic == ''){
            $('#err_oldservicepic1').html('Please choose profile picture.');
            return false;
        }
        $("#experiencesDiv2").hide();
        $("#experiencesDiv3").show();
    });   
    $("#nextexperiences3").click(function(){
        // Disable things that we don't want to validate.
        //$(["input:hidden, textarea:hidden, select:hidden"]).attr("disabled", true);        
    });
    /* Business Services - Classes form back button */
    $("#backexperiences1").click(function(){
        $("#experiencesDiv1").hide();
        $("#creServicediv").show();
    });
    $("#backexperiences2").click(function(){
        $("#experiencesDiv2").hide();
        $("#experiencesDiv1").show();
    });
    $("#backexperiences3").click(function(){
        $("#experiencesDiv3").hide();
        $("#experiencesDiv2").show();
    });
    /* 
     * *********************************************
     * Business Services Checks 
     * *********************************************
     */
    /* Mouse over effect for the service activity type */
    $(".custome-div").on('mouseover', function(){
        $(this).find("input[name='radio_group']").prop('checked', true);
    });
    /* Business Services Step 1 */
    $("input[name='radio_group']").click(function () {
        var service_type=$("input[name='radio_group']:checked").val();
        $("#service_type").val(service_type);   
        $(".individualTxt, .classesTxt, .experienceTxt, .eventsTxt").css("color","white");
        $("."+service_type+"Txt").css("color","red");  
        $(".individualBody, .classesBody, .experienceBody, .eventsBody").hide();
        $("."+service_type+"Body").show();
        $("#creServicediv").hide();
        if(service_type == 'individual') {
            $("#individualDiv0").show();
    	    $('#current_tab_name').val('individualDiv0');
        }
        if(service_type == 'classes') {
            //$("#classesDiv1").show();
            $("#individualDiv0").show();
    	    $('#current_tab_name').val('individualDiv0');
        }
        if(service_type == 'experience') {
            $("#individualDiv0").show();
    	    $('#current_tab_name').val('individualDiv0');
        }
        if(service_type == 'events') {
            $("#individualDiv0").show();
            $('#current_tab_name').val('individualDiv0');
        }
    });

    $("#nextservice").click(function () {
        $("#creServicediv").hide();
        $("#individualDiv0").show();
    	$('#current_tab_name').val('individualDiv0');
    });
    $("#checkserviceyes").click(function () {
        $("#servicebox").show();
        $('.where_do_you_work').show();
        $('.service_type').removeClass("fixed_service");
        var rad_val = $("input[type='radio'][name='willing_to_travel']:checked").val();
        /*var willing_to_travel_radio = $(this).find('input[type=radio]');
        var willing_to_travel_val = $(willing_to_travel_radio).attr('value');*/
        if (rad_val == 'yes') {
            $(".travel_miles_div").prop("disabled", false);
            $('.travel_miles_div').show();
            $('.where_do_you_work').show();
        } else {
            $(".travel_miles_div").prop("disabled", true);
            $('.travel_miles_div').hide();
            $('.where_do_you_work').show();
        }
    });
    $("#checkserviceno").click(function () {
        $("#servicebox").hide();
        $('.where_do_you_work').hide();
        $('.service_type').addClass("fixed_service");
        var rad_val = $("input[type='radio'][name='willing_to_travel']:checked").val();
        if (rad_val == 'no') {
            $(".travel_miles_div").prop("disabled", true);
            $('.travel_miles_div').hide();
            $('.where_do_you_work').hide();
        } else {
            $(".travel_miles_div").prop("disabled", false);
            $('.travel_miles_div').show();
            $('.where_do_you_work').hide();
        }
    });
    /* Set the value of slimSelect drop down list */
    var servicetypearr = [];
    var servicetype = '{{ $select_service_type }}';
    servicetype = servicetype.split(',');
    $.each(servicetype, function( index, value ) {
        servicetypearr.push(value);
    });
    const serviceSelect1 = new SlimSelect({
        select: '#categSType'
    });
    serviceSelect1.set(servicetypearr); 

    const serviceSelect1indi = new SlimSelect({
        select: '#categSTypeidividual'
    });
    serviceSelect1indi.set(servicetypearr); 

    var included_thingsarr = [];
    var included_things = '<?php echo $included_items; ?>';
    included_things = included_things.split(',');
    $.each(included_things, function( index, value ) {
        included_thingsarr.push(value);
    });
    const included_thingsSelect = new SlimSelect({
        select: '#frm_included_things'
    });
    included_thingsSelect.set(included_thingsarr); 
    var notincluded_thingsarr = [];
    var notincluded_things = '<?php echo $notincluded_items; ?>';
    notincluded_things = notincluded_things.split(',');
    $.each(notincluded_things, function( index, value ) {
        notincluded_thingsarr.push(value);
    });
    const notincluded_thingsSelect = new SlimSelect({
        select: '#frm_notincluded_things'
    });
    notincluded_thingsSelect.set(notincluded_thingsarr);  
    var frm_wearsarr = [];
    var frm_wear = '<?php echo $bring_wear; ?>';
    frm_wear = frm_wear.split(',');
    $.each(frm_wear, function( index, value ) {
        frm_wearsarr.push(value);
    });
    const frm_wearSelect = new SlimSelect({
        select: '#frm_wear'
    });
    frm_wearSelect.set(frm_wearsarr);
    var servicelocationarr = [];
    var servicelocation = '{{ $activity_location }}';
    /*  alert(servicelocation); */
    servicelocation = servicelocation.split(',');
    $.each(servicelocation, function( index, value ) {
      servicelocationarr.push(value);
    });
    const serviceSelect2 = new SlimSelect({
      select: '#frm_servicelocation'
    });
    serviceSelect2.set(servicelocationarr);    
    var programforarr = [];
    var programfor = '{{ $activity_for }}';
    programfor = programfor.split(',');
    $.each(programfor, function( index, value ) {
        programforarr.push(value);
    });
    const serviceSelect3 = new SlimSelect({
        select: '#frm_programfor'
    });
    serviceSelect3.set(programforarr);
    var agerangearr = [];
    var agerange = '{{ $age_range }}';
    agerange = agerange.split(',');
    $.each(agerange, function( index, value ) {    
        agerangearr.push(value);
    });
    const serviceSelect4 = new SlimSelect({
        select: '#frm_agerange'
    });
    serviceSelect4.set(agerangearr);
    /*var numberofpeoplearr = [];
    var numberofpeople = '{{ $group_size }}';
    numberofpeople = numberofpeople.split(',');
    $.each(numberofpeople, function( index, value ) {
        numberofpeoplearr.push(value);
    });
    const serviceSelect5 = new SlimSelect({
        select: '#frm_numberofpeople'
    });
    serviceSelect5.set(numberofpeoplearr);*/
    var experiencelevelarr = [];
    var experiencelevel = '{{ $difficult_level }}';
    experiencelevel = experiencelevel.split(',');
    $.each(experiencelevel, function( index, value ) {
        experiencelevelarr.push(value);
    });
    const serviceSelect6 = new SlimSelect({
        select: '#frm_experience_level'
    });
    serviceSelect6.set(experiencelevelarr);
    var servicefocusesarr = [];
    var servicefocuses = '{{ $activity_experience }}';
    servicefocuses = servicefocuses.split(',');
    $.each(servicefocuses, function( index, value ) {
        servicefocusesarr.push(value);
    });
    const serviceSelect7 = new SlimSelect({
        select: '#frm_servicefocuses'
    });
    serviceSelect7.set(servicefocusesarr);    
    var teachingstylearr = [];
    var teachingstyle = '{{ $instructor_habit }}';
    teachingstyle = teachingstyle.split(',');
    $.each(teachingstyle, function( index, value ) {
        teachingstylearr.push(value);
    });
    
    const serviceSelect8 = new SlimSelect({
        select: '#teaching'
    });
    serviceSelect8.set(teachingstylearr);
 });
$("#frm_servicetitle_two").on("change", function() {
     $("#frm_programname").val($("#frm_servicetitle_two").val());
 });
$("#frm_servicetitle_two1").on("change", function() {
     $("#frm_programname1").val($("#frm_servicetitle_two1").val());
});

    $('.percentageckeck').click(function() {
        if ($(this).find('input[type=checkbox]').val() == 'salestax') {
            if($("#salestax").prop('checked') == true) {
                $('#salestaxpercentage').show();
            } else {
                $('#salestaxpercentage').hide();
            }
        }
        if ($(this).find('input[type=checkbox]').val() == 'duestax') {
            if($("#duestax").prop('checked') == true) {
                $('#duestaxpercentage').show();
            } else {
                $('#duestaxpercentage').hide();
            }
        }
    });
  
    $('.c_percentageckeck').click(function() {
        if ($(this).find('input[type=checkbox]').val() == 'csalestax') {
            if($("#c_salestax").prop('checked') == true) {
                $('#c_salestaxpercentage').show();
            } else {
                $('#c_salestaxpercentage').hide();
            }            
        }
        if ($(this).find('input[type=checkbox]').val() == 'cduestax') {
            if($("#c_duestax").prop('checked') == true) {
                $('#c_duestaxpercentage').show();
            } else {
                $('#c_duestaxpercentage').hide();
            }
        }
    });
</script>
<script>
    /*$("#b_EINnumber").keyup(function() {
        var $this = $(this);
        var input = $this.val();
        input = input.replace(/[\W\s\._\-]+/g, '');
        var split = 2;
        var chunk = [];
        for (var i = 0, len = input.length; i < len; i += split) {
            split = (i >= 2 && i <= 9) ? 7 : 2;
            chunk.push(input.substr(i, split));
        }
        $this.val(function() {
            return chunk.join("-").toUpperCase();
        });
    });*/

    function showEditDate() {
        $("#editDateDiv").toggle();
        $("#hoursshow").hide();
    }
    function hideEditDate() {
        $("#editDateDiv").hide();
    }
    function hidehoursshow() {
        $('#hoursshow').hide();
    }
    function hoursshow() {
        $('#hoursshow').toggle();
        $("#editDateDiv").hide();
    }
</script>
<script type="text/javascript">
    $("#btn-nxt8").click(function () {
        var frm_servicetitle = $("#frm_servicetitle").val();
        var frm_servicedesc = $("#frm_servicedesc").val();
    });
    $('#btn-nxt5').click(function () {
        var card_number = $('#card_number').val();
        var name_card = $('#name_card').val();
        var expiry_date = $('#expiry_date').val();
        var cvv = $('#cvv').val();
        $('#err_card_number').html('');
        $('#err_name_card').html('');
        $('#err_expiry_date').html('');
        $('#err_cvv').html('');
        var str = /^[a-zA-Z\s]+$/;
        if(card_number == ''){
            $('#err_card_number').html('Please enter card number');
            $('#card_number').focus();
            return false;
        }
        if(name_card == ''){
            $('#err_name_card').html('Please enter card owner');
            $('#name_card').focus();
            return false;
        }
        if(!str.test(name_card)){
            $('#err_name_card').html('Card owner name should be in alphabets');
            $('#name_card').focus();
            return false;
        }
        if(expiry_date == ''){
            $('#err_expiry_date').html('Please enter expiry date');
            $('#expiry_date').focus();
            return false;
        }
        if(cvv == ''){
           $('#err_cvv').html('Please enter CVV number');
           $('#cvv').focus();
           return false;
        }       
    });
    /*$('#btn-nxt4').click(function () {
        var house_rules = $('#house_rules').val();
        var cancelation_policy = $('#cancelation_policy').val();
        var safety_cleaning = $('#safety_cleaning').val();       
        $('#err_house_rules').html('');
        $('#err_cancelation_policy').html('');
        $('#err_safety_cleaning').html('');
        if(house_rules == ''){
            $('#err_house_rules').html('Please enter house rules');
            $('#house_rules').focus();
            return false;
        }
        if(cancelation_policy == ''){
            $('#err_cancelation_policy').html('Please enter cancelation policy');
            $('#cancelation_policy').focus();
            return false;
        }
        if(safety_cleaning == ''){
            $('#err_safety_cleaning').html('Please enter safety and cleaning procedures');
            $('#safety_cleaning').focus();
            return false;
        }        
    });*/
    $('#btn-nxt3').click(function () {
        var testdemo = $('#testdemo').val();
        $('#b_testdemo').html('');
        if(testdemo == null){
            $('#b_testdemo').html('Please select some languages');
            $('#testdemo').focus();
            return false;
        }
    });    
    $('#bck-nxt1').click(function () {
        $("#bstep2").val(1);
        $('#companyDetail').attr('action', '{{route('addbstep')}}');
        $('#companyDetail').attr('method', 'POST');
        $('#companyDetail').submit();
    });   
    $('#bck-nxt2').click(function () {
        $("#bstep3").val(2);
        $('#empHistory').attr('action', '{{route('addbstep')}}');
        $('#empHistory').attr('method', 'POST');
        $('#empHistory').submit();
    });
    $('#bck-nxt3').click(function () {
        $("#bstep4").val(3);
        $('#serviceSpecifics').attr('action', '{{route('addbstep')}}');
        $('#serviceSpecifics').attr('method', 'POST');
        $('#serviceSpecifics').submit();
    });
    $('#bck-nxt4').click(function () {
        $("#bstep5").val(4);
        $('#termSet').attr('action', '{{route('addbstep')}}');
        $('#termSet').attr('method', 'POST');
        $('#termSet').submit();
    });
    /* old id - bck-nxt5 */
    $('#backverified0').click(function () {
        $("#bstep6").val(5);
        $('#frmVerified').attr('action', '{{route('addbstep')}}');
        $('#frmVerified').attr('method', 'POST');
        $('#frmVerified').submit();
    });
    $('#bck-nxt8').click(function () {
        $("#bstep7").val(6);
        $('#creService').attr('action', '{{route('addbstep')}}');
        $('#creService').attr('method', 'POST');
        $('#creService').submit();
    });
    $('#book-back1').click(function () {
        $("#bstep8").val(7);
        $('#bookingInfo').attr('action', '{{route('addbstep')}}');
        $('#bookingInfo').attr('method', 'POST');
        $('#bookingInfo').submit();
    });
    $('#btn-nxt2').click(function () {
        var frm_organisationname = $('#frm_organisationname').val();
        var frm_position = $('#frm_position').val();
        var frm_ispresentcheck = $('#frm_ispresentcheck1').val();
        var b_employmentfrom = $('#dp1').val();
        var b_employmentto = $('#dp2').val();
        var frm_course = $('#frm_course').val();
        var frm_university = $('#frm_university').val();
        var passingyear = $('#passingyear').val();
        var certification = $('#certification').val();
        var completionyear = $('#completionyear').val();
        var skiils_achievments_awards1 = $('#skiils_achievments_awards1').val();
        var skillcompletionpicker = $('#skillcompletionpicker').val();
        var frm_skilldetail = $('#frm_skilldetail').val();
        var frm_ispresent = $('#frm_ispresent').val();

        $('#b_organisationname').html('');
        $('#b_position').html('');
        $('#b_employmentfrom').html('');
        $('#b_employmentto').html('');
        $('#b_degree').html('');
        $('#b_university').html('');
        $('#b_year').html('');
        $('#b_certification').html('');
        $('#b_certificateyear').html('');
        $('#b_skilltype').html('');
        $('#b_skillyear').html('');
        $('#b_skilldetail').html('');
      
       /* if(frm_organisationname == ''){
            $('#b_organisationname').html('Please enter company name');
              $('#frm_organisationname').focus();
              return false;
        }
        if(frm_position == ''){
            $('#b_position').html('Please enter position in company');
              $('#frm_position').focus();
              return false;
        }*/
        /*if (!$('#frm_ispresentcheck').is(":checked")) {
            alert('Please checked I still work here.');
            $('#frm_ispresentcheck').focus();
            return false;
        }*/
        /*if(b_employmentfrom == ''){
	         $('#b_employmentfrom').html('From date is required');
             $('#dp1').focus();
             return false;
        }*/

        /*if (!$("#frm_ispresentcheck").is(":checked"))
        { 
          if(b_employmentto == ''){
            $('#b_employmentto').html('To date is required');
              $('#dp2').focus();
              return false;
          }
        }*/
    
        /*if(frm_course == ''){
            $('#b_degree').html('Please enter degree / course name');
              $('#frm_course').focus();
              return false;
        }
        if(frm_university == ''){
            $('#b_university').html('Please enter university / school name');
              $('#frm_university').focus();
              return false;
        }
        if(passingyear == ''){
            $('#b_year').html('Please enter passing year');
              $('#passingyear').focus();
              return false;
        }
        if(certification == ''){
            $('#b_certification').html('Please enter name of certification');
              $('#certification').focus();
              return false;
        }
        if(completionyear == ''){
            $('#b_certificateyear').html('Please enter certification year');
              $('#completionyear').focus();
              return false;
        }
        if(skiils_achievments_awards1 == ''){
            $('#b_skilltype').html('Please select skill type');
              $('#skiils_achievments_awards1').focus();
              return false;
        }
        if(skillcompletionpicker == ''){
            $('#b_skillyear').html('Pleaes enter skill completion date');
             $('#skillcompletionpicker').focus();
              return false;
        }
        if(frm_skilldetail == ''){
            $('#b_skilldetail').html('Please describe your skills, achievement');
              $('#frm_skilldetail').focus();
              return false;
        }*/
    });
    $('#b_EINnumber').keypress(function(){
        $('#b_estb').html('');
        if($(this).val().length >= 9) {
            $('#b_estb').html('Establishment Year is required');
            $('#b_Establishmentyear').focus();
        }
    });    
   $('#b_Establishmentyear').keypress(function(){
        $('#b_usertag').html('');
        if($(this).val().length >= 4) {
            $('#b_usertag').html('Business Username is required');
            $('#b_business_user_tag').focus();
        }
    });
   
    $('#b_contact').keypress(function(){
        $('#b_abt').html('');
        if($(this).val().length == 9) {
            $('#b_abt').html('About Company is required');
            $('#about_company').focus();
        }
    });
    
    $('#btn-nxt1').click(function () {
        var b_companyname = $('#b_companyname').val();
        var b_address = $('#b_address').val();
        var b_city = $('#b_city').val();
        var b_state = $('#b_state').val();
        var b_zipcode = $('#b_zipcode').val();
        var b_country = $('#b_country').val();
        var b_EINnumber = $('#b_EINnumber').val();
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
        $('#b_ein').html('');
        $('#b_estb').html('');
        $('#b_usertag').html('');
        $('#b_firstnm').html('');
        $('#b_lastnm').html('');
        $('#b_eml').html('');
        $('#b_cot').html('');
        $('#b_abt').html('');
        $('#b_short').html('');
        
        if(b_companyname == ''){
            alert('1');
            $('#b_cmpo').html('Company Name is required');
            $('#b_companyname').focus();
            return false;
        }
        if(b_address == ''){
             alert('2');
            $('#b_addr').html('Address is required');
            $('#b_address').focus();
            return false;
        }
        if(b_city == ''){
             alert('3');
           $('#b_ct').html('City is required');
           $('#b_city').focus();
           return false;
        }
        if(!str.test(b_city)){
             alert('4');
            $('#b_ct').html('City Name is not Valid');
            $('#b_city').focus();
            return false;
        }
        if(b_state == ''){
             alert('5');
            $('#b_sta').html('State is required');
            $('#b_state').focus();
            return false;
        }
        if(!str.test(b_state)){
             alert('6');
            $('#b_sta').html('State Name is not Valid');
            $('#b_state').focus();
            return false;
        }
        if(b_zipcode == ''){
             alert('7');
            $('#b_zip').html('Zipcode is required');
            $('#b_zipcode').focus();
            return false;
        }
        if(b_country == ''){
             alert('8');
            $('#b_cont').html('Country is required');
            $('#b_country').focus();
            return false;
        }
        if(!str.test(b_country)){
             alert('9');
            $('#b_cont').html('Country Name is not Valid');
            $('#b_country').focus();
            return false;
        }
        /*if(b_EINnumber == ''){
            $('#b_ein').html('EIN number is required');
            $('#b_EINnumber').focus();
            return false;
        }*/
        if(b_Establishmentyear == ''){
             alert('10');
            $('#b_estb').html('Establishment Year is required');
            $('#b_Establishmentyear').focus();
            return false;
        }
        /*if(!filter.test(b_Establishmentyear)){
             alert('11');
            $('#b_estb').html('Establishment Year Not Valid');
            $('#b_Establishmentyear').focus();
            return false;
        }*/
        if(b_business_user_tag == ''){
             alert('12');
            $('#b_usertag').html('Business Username is required');
            $('#b_business_user_tag').focus();
            return false;
        }
        if(b_firstname == ''){
             alert('13');
            $('#b_firstnm').html('Company First Name is required');
            $('#b_firstname').focus();
            return false;
        }
        if(b_lastname == ''){
             alert('14');
            $('#b_lastnm').html('Company Last Name is required');
            $('#b_lastname').focus();
            return false;
        }
        /*if(b_email == ''){
             alert('15');
            $('#b_eml').html('Email is required');
            $('#b_email').focus();
            return false;
        }*/
        if(b_email != '' && !regex.test(b_email)){
             alert('16');
            $('#b_eml').html('Email is Not Valid');
            $('#b_email').focus();
            return false;
        }
       /* if(b_contact == ''){
            $('#b_cot').html('Contact Number is required');
            $('#b_contact').focus();
            return false;
        }*/

       if (filter.test(b_contact)) {
         alert('17');
            if(b_contact.length > 9 || b_contact.length < 9){
                $('#b_cot').html('Contact Number is not Valid');
                $('#b_contact').focus();
                return false;
            }
        }
       /* if(about_company == ''){
            $('#b_abt').html('About Company is required');
            $('#about_company').focus();
            return false;
       }
        if(short_description == ''){
            $('#b_short').html('Short Description is required');
            $('#short_description').focus();
            return false;
        }*/
       
    });
</script>
<script>
  function checkstillwork(val ,i){ 
    if ( $("#frm_ispresentcheck"+i).is(":checked")){ 
      $("#dp2_"+i+"-position"+i).hide(); 
      $("#frm_ispresent"+i).val('1');
      /*$("#frm_ispresentcheck"+i).val('1');*/
      $("#frm_ispresentcheck"+i).prop('checked', true);
    }
    else{ $("#dp2_"+i+"-position"+i).show(); $("#frm_ispresent"+i).val('0'); 
       /* $("#frm_ispresentcheck"+i).val('0');*/
      $("#frm_ispresentcheck"+i).prop('checked', false);}
  }
  function changeformate() {
		var con = $('#b_contact').val();
        var curchr = con.length;
        if (curchr == 3) {
            $("#b_contact").val("(" + con + ")" + " ");
        } else if (curchr == 9) {
            $("#b_contact").val(con + "-");
        }
    }
    function changeformate_b_business_phone() {
        var con = $('#b_business_phone').val();
        var curchr = con.length;
        if (curchr == 3) {
            $("#b_business_phone").val("(" + con + ")" + " ");
        } else if (curchr == 9) {
            $("#b_business_phone").val(con + "-");
       }
    }
    function changeformate1() {
	   var con = $('#phone_number').val();
        var curchr = con.length;
        if (curchr == 3) {
            $("#phone_number").val("(" + con + ")" + " ");
        } else if (curchr == 9) {
            $("#phone_number").val(con + "-");
        }
    }

    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!regex.test(email)) {
            return false;
        }else {
            return true;
        }
    }

    function submit_staffmember() {
        $('.error').hide();
        var insname=$('#insname').val();
        var insimg=$('#insimg').val();
        var insemail=$('#insemail').val();
        if (IsEmail(insemail) == false) {
            $('#addinserro').show(); 
            $('#addinserro').html('Email-id is invalid');
            return false;
        }
        var insdescription=$('#insdescription').val();
        var _token = $("input[name='_token']").val();

        if(insname !='' && insdescription !='')
        { 
            var formData = new FormData($("#addinsform")[0]);
            $.ajax({
                url: "{{route('add_instructor')}}",
                type: 'POST',
                enctype: 'multipart/form-data',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                success: function (response) {
                    if(response)
                    {   
                        $("#addinsform")[0].reset();
                        $('.selectinstructor').load(' .selectinstructor > *')
                        $('#addinserro').show(); 
                        $('#addinserro').html('Instructure Added Successfully..'); 
                        $("#submit_member").prop('disabled', true);
                    }                    
                }
            });
        }
        else
        {
            $('#addinserro').show(); 
            $('#addinserro').html('Please add your Instructure Name and Instructure Description rating'); 
            return false;
        }
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCr7-ilmvSu8SzRjUfKJVbvaQZYiuntduw&callback=initMap" async defer></script>
<script type="text/javascript">
    
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -33.8688, lng: 151.2195},
            zoom: 13
        });

        var autocomplete2 = new google.maps.places.Autocomplete(document.getElementById('cus_st_address'), { types: [ 'geocode' ] });
        google.maps.event.addListener(autocomplete2, 'place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete2.getPlace();
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
                  $('#cus_zip').val(place.address_components[i].long_name);
                }
                if(place.address_components[i].types[0] == 'country'){
                  $('#cus_country').val(place.address_components[i].long_name);
                }

                if(place.address_components[i].types[0] == 'locality'){
                    $('#cus_city').val(place.address_components[i].long_name);
                }

                if(place.address_components[i].types[0] == 'sublocality_level_1'){
                    sublocality_level_1 = place.address_components[i].long_name;
                }

                if(place.address_components[i].types[0] == 'street_number'){
                   badd = place.address_components[i].long_name ;
                }

                if(place.address_components[i].types[0] == 'route'){
                   badd += ' '+place.address_components[i].long_name ;
                } 

                if(place.address_components[i].types[0] == 'administrative_area_level_1'){
                  $('#cus_state').val(place.address_components[i].long_name);
                }
            }

            if(badd == ''){
              $('#cus_st_address').val(sublocality_level_1);
            }else{
              $('#cus_st_address').val(badd);
            }
            $('#address_p').val(place.formatted_address);
            $('#cus_lat').val(place.geometry.location.lat());
            $('#cus_lng').val(place.geometry.location.lng());
        });

        var input = document.getElementById('b_address');
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
                  $('#b_zipcode').val(place.address_components[i].long_name);
                }

                if(place.address_components[i].types[0] == 'locality'){
                    $('#b_city').val(place.address_components[i].long_name);
                }

                if(place.address_components[i].types[0] == 'sublocality_level_1'){
                    sublocality_level_1 = place.address_components[i].long_name;
                }

                if(place.address_components[i].types[0] == 'street_number'){
                   badd = place.address_components[i].long_name ;
                }

                if(place.address_components[i].types[0] == 'route'){
                   badd += ' '+place.address_components[i].long_name ;
                } 

                if(place.address_components[i].types[0] == 'administrative_area_level_1'){
                  $('#b_state').val(place.address_components[i].long_name);
                }
            }

            if(badd == ''){
              $('#b_address').val(sublocality_level_1);
            }else{
              $('#b_address').val(badd);
            }

            $('#lat').val(place.geometry.location.lat());
            $('#lon').val(place.geometry.location.lng());
        });
    }

    function loadMaponclick(){
        $('#cus_map_error').hide();
        var locations = $('#address_p').val();
        var cus_lat = $('#cus_lat').val();
        var cus_lng = $('#cus_lng').val();
        var map1 = ''
        var infowindow1 = ''
        var marker1 = ''
        var markers1 = []
        var circle = ''
        
        if (locations.length != 0) { 
            $('#map_canvas_cus').empty(); 
            console.log('!empty');
            map1 = new google.maps.Map(document.getElementById('map_canvas_cus'), {
                zoom:18,
                center: new google.maps.LatLng(cus_lat, cus_lng),
                mapTypeId: google.maps.MapTypeId.ROADMAP,
            });
            infowindow1 = new google.maps.InfoWindow();
            var bounds = new google.maps.LatLngBounds();
            var marker1;
            var icon1 = {
                url: "{{url('/public/images/hoverout2.png')}}",
                scaledSize: new google.maps.Size(50, 50),
                labelOrigin: {x: 25, y: 16}
            };
            for (var i = 0; i < locations.length; i++) {
                var labelText = i + 1
                marker1 = new google.maps.Marker({
                    position: new google.maps.LatLng(cus_lat,cus_lng),
                    map: map1,
                    icon: icon1,
                    title: labelText.toString(),
                    label: {
                        text: labelText.toString(),
                        color: '#222222',
                        fontSize: '12px',
                        fontWeight: 'bold'
                    }
                });

                bounds.extend(marker1.position);
            }               
            $('.mysrchmap_cus').show()
        } else {
            $('#cus_map_error').show(); 
            $('#cus_map_error').html('Plese Enter All Value For Map');
        }
    }
</script>



<script>
let dropBox = document.getElementById('dropBox');

    // modify all of the event types needed for the script so that the browser
    // doesn't open the image in the browser tab (default behavior)
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(evt => {
        dropBox.addEventListener(evt, prevDefault, false);
    });
    function prevDefault (e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // remove and add the hover class, depending on whether something is being
    // actively dragged over the box area
    ['dragenter', 'dragover'].forEach(evt => {
        dropBox.addEventListener(evt, hover, false);
    });
    ['dragleave', 'drop'].forEach(evt => {
        dropBox.addEventListener(evt, unhover, false);
    });
    function hover(e) {
        dropBox.classList.add('hover');
    }
    function unhover(e) {
        dropBox.classList.remove('hover');
    }

    // the DataTransfer object holds the data being dragged. it's accessible
    // from the dataTransfer property of drag events. the files property has
    // a list of all the files being dragged. put it into the filesManager function
    dropBox.addEventListener('drop', mngDrop, false);
    function mngDrop(e) {
        let dataTrans = e.dataTransfer;
        let files = dataTrans.files;
        filesManager(files);
    }

    // use FormData browser API to create a set of key/value pairs representing
    // form fields and their values, to send using XMLHttpRequest.send() method.
    // Uses the same format a form would use with multipart/form-data encoding
    function upFile(file) {
        //only allow images to be dropped
        let imageType = /image.*/;
        if (file.type.match(imageType)) {
            let url = 'HTTP/HTTPS URL TO SEND THE DATA TO';
            // create a FormData object
            let formData = new FormData();
            // add a new value to an existing key inside a FormData object or add the
            // key if it doesn't exist. the filesManager function will loop through
            // each file and send it here to be added
            formData.append('file', file);

            // standard file upload fetch setup
            fetch(url, {
                method: 'put',
                body: formData
            })
            .then(response => response.json())
            .then(result => { console.log('Success:', result); })
            .catch(error => { console.error('Error:', error); });
        } else {
            console.error("Only images are allowed!", file);
        }
    }

    // use the FileReader API to get the image data, create an img element, and add
    // it to the gallery div. The API is asynchronous so onloadend is used to get the
    // result of the API function
    function previewFile(file) {
        // only allow images to be dropped
        let imageType = /image.*/;
        if (file.type.match(imageType)) {
            let fReader = new FileReader();
            let gallery = document.getElementById('gallery');
            // reads the contents of the specified Blob. the result attribute of this
            // with hold a data: URL representing the file's data
            fReader.readAsDataURL(file);
            // handler for the loadend event, triggered when the reading operation is
            // completed (whether success or failure)
            fReader.onloadend = function() {
                let wrap = document.createElement('div');
                let img = document.createElement('img');
                // set the img src attribute to the file's contents (from read operation)
                img.src = fReader.result;
                let imgCapt = document.createElement('p');
                // the name prop of the file contains the file name, and the size prop
                // the file size. convert bytes to KB for the file size
                let fSize = (file.size / 1000) + ' KB';
                
                gallery.appendChild(wrap).appendChild(img);
                gallery.appendChild(wrap).appendChild(imgCapt);
            }
        } else {
            console.error("Only images are allowed!", file);
        }
    }

    function filesManager(files) {
        // spread the files array from the DataTransfer.files property into a new
        // files array here
        files = [...files];
        // send each element in the array to both the upFile and previewFile
        // functions
        files.forEach(upFile);
        files.forEach(previewFile);
    }
</script>

<script type="text/javascript">
    $(document).on('click', '.editpopup', function(e){
        var imgname = $(this).attr("imgname");
        var serviceid =$(this).attr('serviceid');
        jQuery.noConflict();
        $.ajax({
            url: "{{route('editactivityimg')}}",
            xhrFields: {
                    withCredentials: true
                },
            type: 'get',
            data:{
                imgname:imgname,
                serviceid:serviceid,
            },
            success: function (response) {
               $("#edit_post").modal('show');
               /* $("#edit_post").css('display','block');*/
                $('#edit_image').html(response);
            }
        });
    });

    /*$(document).on('click', '.modelboxclose ', function(e){
        $("#edit_post").css('display','none');
    });*/
</script>

<script type="text/javascript">
    $(document).ready(function(){ 
        loadMaponclick();
        $('#cus_map_error').hide();
    });
</script>

@endsection



