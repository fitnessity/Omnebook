@extends('layouts.header')
@section('content')
@include('layouts.userHeader')
<?php
function timeSlotOption($lbl, $val) {
    $start = "00:00"; //you can write here 00:00:00 but not need to it
    $end = "23:30";

    $tStart = strtotime($start);
    $tEnd = strtotime($end);
    $tNow = $tStart;
	
	$startpm = "00:00"; //you can write here 00:00:00 but not need to it
    $endpm = "11:30";
	
    echo '<select name="'.$lbl.'[]" class="'.$lbl.' form-control">';
    echo '<option value="">Select Time</option>';
    while($tNow <= $tEnd){
        if($val == date("H:i",$tNow)) {
        echo '<option selected value="'.date("H:i",$tNow).'">'.date("h:i A",$tNow).'</option>';    
        } else {
        echo '<option value="'.date("H:i",$tNow).'">'.date("h:i A",$tNow).'</option>';
        }
        $tNow = strtotime('+30 minutes',$tNow);
    }
	
    /*
    $timeslots = array();
    for ($n = 0; $n < 24 * 60; $n+=5)
    {
        $date = sprintf('%02d:%02d', $n / 60, $n % 60);
        $timeslots[$date] = $date;
        if($val == $date) {
            echo "<option selected>".$date."</option>";
        } else {
            echo "<option>".$date."</option>";
        }
    }*/
    echo '</select>';
}

?>
<?php @$hours = json_decode($service['serv_time_slot'],true); ?>
<?php 
$user = Auth::user();
?>
<!-- Navigation-->
<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">
        <div class="col-md-2" style="background: black;">
        	 @include('business.businessSidebar')
            <?php /*?><div class="navbar1">
                <div class="navlink1" id="tab1" onclick="location.href='business-welcome';">Welcome</div>
                <div class="navlink1" id="tab2" onclick="linkJump(2);">Company Details</div>
                <div class="navlink1" id="tab3" onclick="linkJump(3);">Your Experience</div>
                <div class="navlink1" id="tab4" onclick="linkJump(4);">Company Specifics</div>
                <div class="navlink1" id="tab5" onclick="linkJump(5);">Set Your Terms</div>
                <div class="navlink1" id="tab6" onclick="linkJump(6);">Get Verified</div>
                <div class="navlink1" id="tab7" onclick="linkJump(7);">Create Services & Prices</div>
                <div class="navlink1" id="tab8" onclick="linkJump(8);">Booking Info</div>
            </div><?php */?>
            <?php /*
            @if(isset($business_details) && !empty($business_details['id']))
            <div class="navbar1">
                <div class="navlink1"><a style="color:#fff" href="/pcompany/view/{{ $business_details['id'] }}" target="_blank">Preview Profile</a></div>
            </div>
            @endif
             */ ?>
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
                                <p class="tab-para1">Your business profile will be like your resume. It's your first point of contact for your current and potential clients.
You can offer your services online, at your place of business, or on the go. Start by adding your business information, images, videos, services, prices and verify your business by completing a background check. Once you're done setting up, you're ready to start receiving bookings from customers looking for the activities and services you offer.</p>

                                <p class="tab-para1">Things to Know</p>
                                <ul>
                                	<li>You are recoomended to complete a background check to earn the trust of potential customers.</li>
                                    <li>To get reviews, a customer must participate in the service you offer. Fitnessity doesn't allow random reviews from cutomers to outsiders.</li>
                                    <li>The Fitnessity Quality Control team will be monitoring to make sure that you are conducting business with the highest standars.</li>
                               	</ul>
                                <p class="tab-para1">Add your business information, images, videos, services, prices, get verified by completed a background check, start getting reviews,<br>
                                    manage your customers and accounts and much more. Start receiving bookings from customers looking for activites and services your offer.</p>
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
                    $companyId = $Companyname = $Address = $City = $State = $ZipCode = $Country = $EINnumber = $Establishmentyear = $Businessusername = $Profilepic = $Firstnameb = $Lastnameb = $Emailb = $Phonenumber = $Aboutcompany = $Shortdescription = $EmbedVideo = "";
                    if(isset($business_details)){
                       if(isset($business_details['cid']) && !empty($business_details['cid'])) {
                           $companyId = $business_details['cid'];
                       }
                       if(isset($business_details['Companyname']) && !empty($business_details['Companyname'])) {
                           $Companyname = $business_details['Companyname'];
                       }
                       if(isset($business_details['Address']) && !empty($business_details['Address'])) {
                           $Address = $business_details['Address'];
                       }
                       if(isset($business_details['City']) && !empty($business_details['City'])) {
                           $City = $business_details['City'];
                       }
                       if(isset($business_details['State']) && !empty($business_details['State'])) {
                           $State = $business_details['State'];
                       }
                       if(isset($business_details['ZipCode']) && !empty($business_details['ZipCode'])) {
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
                    } 
                    ?>
                    @csrf
                    <input type="hidden" name="userid" id="userid" value="{{Auth::user()->id}}">
                    <input type="hidden" name="cid" value="{{Auth::user()->cid}}">
                    <input type="hidden" name="serviceid" value="{{Auth::user()->serviceid}}">
                    <input type="hidden" name="bstep" id="bstep2" value="{{Auth::user()->bstep}}">
                    <div class="container-fluid p-0" id="companyDetaildiv" style="display: none;">
                        <div class="tab-hed">Company Details Setup</div>
                        <hr style="border: 15px solid black;width: 104%;margin-left: -38px;">
                        <section class="row">
                            <div class="col-md-12">
                                <div class="row" style="padding-right: 200px;">
                                    <div class="form-group col-md-6">
                                        <label for="email">Company Name <span id="star">*</span></label>
                                        <input type="text" class="form-control" name="Companyname" id="b_companyname" size="30" maxlength="255" placeholder="Company Name" value="{{ $Companyname }}">
                                        <span class="error" id="b_cmpo"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pwd">Address <span id="star">*</span></label>
                                        <input type="text" class="form-control" autocomplete="nope" name="Address" id="b_address" placeholder="Address" value="{{ $Address }}">
                                        <span class="error" id="b_addr"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">City <span id="star">*</span></label>
                                        <input type="text" class="form-control" name="City" id="b_city" size="30" placeholder="City" maxlength="50" value="{{ $City }}">
                                        <span class="error" id="b_ct"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pwd">State <span id="star">*</span></label>
                                        <input type="text" class="form-control" name="State" id="b_state" size="30" placeholder="State" maxlength="50" value="{{ $State }}">
                                        <span class="error" id="b_sta"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Zip Code <span id="star">*</span></label>
                                        <input type="text" class="form-control" name="ZipCode" id="b_zipcode" size="30" placeholder="Zip Code" value="{{ $ZipCode }}" maxlength="20">
                                        <span class="error" id="b_zip"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pwd">Country <span id="star">*</span></label>
                                        <input type="text" class="form-control" name="Country" id="b_country" size="30" placeholder='Country' value="{{ $Country }}" maxlength="50">
                                        <span class="error" id="b_cont"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">EIN Number <span id="star">*</span></label>
                                        <input type="text" class="form-control" name="EINnumber" id="b_EINnumber" maxlength="9" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="EIN Number" value="{{ $EINnumber }}">
                                        <span class="error" id="b_ein"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pwd">Establishment Year <span id="star">*</span></label>
                                        <input class="form-control" type="text" name="Establishmentyear" id="b_Establishmentyear" size="30" maxlength="4" placeholder="Establishment Year" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{ $Establishmentyear }}">
                                        <span class="error" id="b_estb"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pwd">Business Username <span id="star">*</span></label>
                                        <input type="text" class="form-control" name="Businessusername" id="b_business_user_tag" placeholder="Business User Tag" value="{{ $Businessusername }}">
                                        <span class="error" id="b_usertag"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pwd">Embed Video Code </label>
                                        <input type="text" class="form-control" name="EmbedVideo" id="b_embedvideo" placeholder="Video Code" value="{{ $EmbedVideo }}" maxlength="150">
                                        <span id="b_embedvideo">Example: https://www.youtube.com/embed/<b>rW_fwcmyIfk</b></span>
                                    </div>
                                    <hr style="border: 1px solid #d4cfcf;width: 100%;">
                                    <div class="form-group col-md-6">
                                        <label for="pwd" style="font-size: 20px;font-weight: bold;">Upload Profile Image</label>
                                        <input type="file" class="form-control" name="Profilepic" id="profile_pic" onchange="readURL(this);" style="height: 45px;">
                                        <input type="hidden" name="oldProfilepic" id="oldProfilepic" value="{{ $Profilepic }}" />
                                    </div>
                                    <div class="form-group col-md-6 text-center">
                                        @if(!empty($Profilepic) && File::exists(public_path("/uploads/profile_pic/thumb/".$Profilepic)))
                                        <img src="{{ url('/public/uploads/profile_pic/thumb/'.$Profilepic) }}" class="pro_card_img blah" id="showimg">
                                        @else
                                        <img src="{{ url('/public/images/default-avatar.png') }}" class="pro_card_img blah" id="showimg">
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="hidden" value="0" id="mybusinessid" />
                                        <label for="pwd">Company Representative First Name <span id="star">*</span></label>
                                        <input type="text" class="form-control" name="Firstnameb" id="b_firstname" size="30" maxlength="80" placeholder="Company Representative First Name" value="{{ $Firstnameb }}">
                                        <span class="error" id="b_firstnm"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pwd">Company Representative Last Name <span id="star">*</span></label>
                                        <input type="text" class="form-control" name="Lastnameb" id="b_lastname" size="30" maxlength="80" placeholder="Company Representative Last Name" value="{{ $Lastnameb }}">
                                        <span class="error" id="b_lastnm"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pwd">Email <span id="star">*</span></label>
                                        <input type="email" class="form-control myemail" name="Emailb" id="b_email" autocomplete="off" placeholder="Email Address" size="30" maxlength="80" value="{{ $Emailb }}">
                                        <span class="error" id="b_eml"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pwd">Contact Number <span id="star">*</span></label>
                                        <input type="text" class="form-control" name="Phonenumber" id="b_contact" size="30" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Contact No" value="{{ $Phonenumber }}">
                                        <span class="error" id="b_cot"></span>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="pwd">Quick Business Intro <span id="star">*</span></label>
                                        <textarea class="form-control" rows="4" placeholder="Tell Us Somthing About Company..." name="Aboutcompany" id="about_company" maxlength="150">{{ $Aboutcompany }}</textarea>
                                        <div class="text-right"><span id="quick_business_left">150</span> Characters Left</div>
                                        <span class="error" id="b_abt"></span>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="pwd">Company Description <span id="star">*</span></label>
                                        <textarea class="form-control" rows="10" placeholder="Tell Us Somthing About Company in short..." name="Shortdescription" id="short_description" maxlength="500">{{ $Shortdescription }}</textarea>
                                        <div class="text-right"><span id="company_desc_left">500</span> Characters Left</div>
                                        <span class="error" id="b_short"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <br/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn-bck" id="bck-nxt1"><i class="fa fa-arrow-left"></i> Back</button>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="submit" class="btn-nxt" id="btn-nxt1">Save & Continue <i class="fa fa-arrow-right"></i></button>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </section>
                    </div>
                </form>
            
                <form id="empHistory" name="empHistory" method="post" action="{{route('addbusinessexperience')}}">
                    <?php
                    $frm_organisationname = $frm_position = $frm_ispresentcheck = $frm_servicestart = $frm_serviceend = "";
                    $frm_course = $frm_university = $frm_passingyear = $certification = $frm_passingdate = $skill_type = $skillcompletion = $frm_skilldetail = "";
                    if(isset($business_exp)) {
                        if(isset($business_exp['frm_organisationname']) && !empty($business_exp['frm_organisationname'])) {
                            $frm_organisationname = $business_exp['frm_organisationname'];
                        }
                        if(isset($business_exp['frm_position']) && !empty($business_exp['frm_position'])) {
                            $frm_position = $business_exp['frm_position'];
                        }
                        if(isset($business_exp['frm_ispresentcheck']) && !empty($business_exp['frm_ispresentcheck'])) {
                            $frm_ispresentcheck = $business_exp['frm_ispresentcheck'];
                        }
                        if(isset($business_exp['frm_servicestart']) && !empty($business_exp['frm_servicestart'])) {
                            $frm_servicestart = $business_exp['frm_servicestart'];
                        }
                        if(isset($business_exp['frm_serviceend']) && !empty($business_exp['frm_serviceend'])) {
                            $frm_serviceend = $business_exp['frm_serviceend'];
                        }
                        if(isset($business_exp['frm_course']) && !empty($business_exp['frm_course'])) {
                            $frm_course = $business_exp['frm_course'];
                        }
                        if(isset($business_exp['frm_university']) && !empty($business_exp['frm_university'])) {
                            $frm_university = $business_exp['frm_university'];
                        }
                        if(isset($business_exp['frm_passingyear']) && !empty($business_exp['frm_passingyear'])) {
                            $frm_passingyear = $business_exp['frm_passingyear'];
                        }
                        if(isset($business_exp['certification']) && !empty($business_exp['certification'])) {
                            $certification = $business_exp['certification'];
                        }
                        if(isset($business_exp['frm_passingdate']) && !empty($business_exp['frm_passingdate'])) {
                            $frm_passingdate = $business_exp['frm_passingdate'];
                        }
                        if(isset($business_exp['skill_type']) && !empty($business_exp['skill_type'])) {
                            $skill_type = $business_exp['skill_type'];
                        }
                        if(isset($business_exp['skillcompletion']) && !empty($business_exp['skillcompletion'])) {
                            $skillcompletion = $business_exp['skillcompletion'];
                        }
                        if(isset($business_exp['frm_skilldetail']) && !empty($business_exp['frm_skilldetail'])) {
                            $frm_skilldetail = $business_exp['frm_skilldetail'];
                        }                        
                    }
                    ?>
                    @csrf
                    <input type="hidden" name="userid" id="userid" value="{{Auth::user()->id}}">
                    <input type="hidden" name="cid" value="{{Auth::user()->cid}}">
                    <input type="hidden" name="serviceid" value="{{Auth::user()->serviceid}}">
                    <input type="hidden" name="bstep" id="bstep3" value="{{Auth::user()->bstep}}">
                    <div class="container-fluid p-0" id="empHistorydiv" style="display: none;">
                        <div class="tab-hed">Tells us About Your Experience</div>
                        <hr style="border: 15px solid black;width: 104%;margin-left: -38px;">
                        <section class="row">
                            <div class="col-md-12">
                                <div class="row" style="padding-right: 200px;">
                                    <div class="col-md-12">
                                        <div class="his-hed">Employment History</div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Company Name <span id="star">*</span></label>
                                        <input required type="text" name="frm_organisationname" id="frm_organisationname" placeholder="Organization name" class="form-control" maxlength="100" value="{{ $frm_organisationname }}">
                                        <span class="error" id="b_organisationname"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pwd">Position <span id="star">*</span></label>
                                        <input required type="text" class="form-control" id="frm_position" name="frm_position" placeholder="Position" value="{{ $frm_position }}" maxlength="100">
                                        <span class="error" id="b_position" ></span>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class=" present_work_btn">
                                                <input type="checkbox" style="width: 25px;height: 25px;position: relative;top: 5px;" autocomplete="off" name="frm_ispresentcheck" id="frm_ispresentcheck" value="1" {{ ($frm_ispresentcheck==1) ? 'checked' : '' }}>
                                                <input type="hidden" name="frm_ispresent" id="frm_ispresent" value="0">
                                                <span>I Still Work Here</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6" id="dp1-position">
                                        <label for="email">From (mm/dd/yyyy) <span id="star">*</span></label>
                                        <div class="special-date">
                                            <input required type="text" class="form-control span2" name="frm_servicestart" placeholder="From" id="dp1" value="{{ $frm_servicestart }}">
                                            <span class="error" id="b_employmentfrom"></span>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6" id="dp2-position">
                                        <label for="pwd">To (mm/dd/yyyy) <span id="star">*</span></label>
                                        <div class="special-date">
                                            <input required type="text" class="form-control" id="dp2" name="frm_serviceend" placeholder="To" value="{{ $frm_serviceend }}">
                                            <span class="error" id="b_employmentto"></span>
                                        </div>
                                    </div>
                                    <hr style="border: 1px solid #d4cfcf;width: 100%;">
                                    <div class="col-md-12">
                                        <div class="his-hed">Education Details</div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pwd">Degree - Course <span id="star">*</span></label>
                                        <input required type="text" id="frm_course" name="frm_course" class="form-control frm_course" placeholder="Degree/Course (Obtained or Seeking)" value="{{ $frm_course }}" maxlength="500">
                                        <span class="error" id="b_degree"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pwd">University - School <span id="star">*</span></label>
                                        <input required type="text" id="frm_university" name="frm_university" class="form-control frm_university" placeholder="University/School" value="{{ $frm_university }}"  maxlength="200">
                                        <span class="error" id="b_university"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pwd">Year Graduated (yyyy) <span id="star">*</span></label>
                                        <input required id="passingyear" name="frm_passingyear" class="form-control" placeholder="Year graduated" type="number" maxlength="4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" style="width:100%" autocomplete="off" value="{{ $frm_passingyear }}">
                                        <span class="error" id="b_year"></span>
                                    </div>
                                    <hr style="border: 1px solid #d4cfcf;width: 100%;">
                                    <div class="col-md-12">
                                        <div class="his-hed">Certification Details</div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pwd">Name of Certification <span id="star">*</span></label>
                                        <input required type="text" id="certification" name="certification" class="form-control" placeholder="Name of Certification" value="{{ $certification }}" maxlength="200">
                                        <span class="error" id="b_certification"></span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">Completion Date (mm/dd/yyyy) <span id="star">*</span></label>
                                        <div class="special-date">
                                            <input required type="text" class="form-control" id="completionyear" name="frm_passingdate" placeholder="Completion Date" autocomplete="off" value="{{ $frm_passingdate }}">
                                            <span class="error" id="b_certificateyear"></span>
                                        </div>
                                    </div>
                                    <hr style="border: 1px solid #d4cfcf;width: 100%;">
                                    <div class="col-md-12">
                                        <div class="his-hed">Skills, Achievments And Awards</div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pwd">Skill Type <span id="star">*</span></label>
                                            <select required name="skill_type" id="skiils_achievments_awards1" class="form-control my-select">
                                                <option value="">Select Item</option>
                                                <option value="Skills" {{ ($skill_type=='Skills') ? 'selected' : '' }}>Skills</option>
                                                <option value="Achievment" {{ ($skill_type=='Achievment') ? 'selected' : '' }}>Achievments</option>
                                                <option value="Award" {{ ($skill_type=='Award') ? 'selected' : '' }}>Awards</option>
                                            </select>
                                            <span class="error" id="b_skilltype"></span>
                                        </div>
                                        <div class="form-group" id="skillcompletionpicker-position">
                                            <label for="email">Completion Date (mm/dd/yyyy) <span id="star">*</span></label>
                                            <div class="special-date">
                                                <input required type="text" name="skillcompletion" class="form-control" id="skillcompletionpicker" placeholder="Completion Date"  autocomplete="off" value="{{ $skillcompletion }}">
                                                <span class="error" id="b_skillyear"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="pwd">Description <span id="star">*</span></label>
                                        <textarea required name="frm_skilldetail" id="frm_skilldetail" placeholder="Description" cols="10" rows="3" class="form-control" maxlength="300">{{ $frm_skilldetail }}</textarea>
                                        <span class="error" id="b_skilldetail"></span><span id="frm_skilldetail_left">150</span> Characters Left
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button type="button" class="btn-bck" id="bck-nxt2"><i class="fa fa-arrow-left"></i> Back</button>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <button type="submit" class="btn-nxt" id="btn-nxt2">Save & Continue <i class="fa fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </section>
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
                        <div class="col-md-12">
                            <div class="row" style="padding-right: 200px;">
                                <div class="form-group col-md-12">
                                    <label for="email">Language(s) you and your staff speak ? (click all that apply) </label>
                                    <select required name="languages[]" id="testdemo" multiple>
                                        <option value="English">English</option>
                                        <option value="Afar">Afar</option>
                                        <option value="Abkhazian">Abkhazian</option>
                                        <option value="Afrikaans">Afrikaans</option>
                                        <option value="Amharic">Amharic</option>
                                        <option value="Arabic">Arabic</option>
                                        <option value="Assamese">Assamese</option>
                                        <option value="Aymara">Aymara</option>
                                        <option value="Azerbaijani">Azerbaijani</option>
                                        <option value="Bashkir">Bashkir</option>
                                        <option value="Belarusian">Belarusian</option>
                                        <option value="Bulgarian">Bulgarian</option>
                                        <option value="Bihari">Bihari</option>
                                        <option value="Bislama">Bislama</option>
                                        <option value="Bengali/Bangla">Bengali/Bangla</option>
                                        <option value="Tibetan">Tibetan</option>
                                        <option value="Breton">Breton</option>
                                        <option value="Catalan">Catalan</option>
                                        <option value="Corsican">Corsican</option>
                                        <option value="Czech">Czech</option>
                                        <option value="Welsh">Welsh</option>
                                        <option value="Danish">Danish</option>
                                        <option value="German">German</option>
                                        <option value="Bhutani">Bhutani</option>
                                        <option value="Greek">Greek</option>
                                        <option value="Esperanto">Esperanto</option>
                                        <option value="Spanish">Spanish</option>
                                        <option value="Estonian">Estonian</option>
                                        <option value="Basque">Basque</option>
                                        <option value="Persian">Persian</option>
                                        <option value="Finnish">Finnish</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Faeroese">Faeroese</option>
                                        <option value="French">French</option>
                                        <option value="Frisian">Frisian</option>
                                        <option value="Irish">Irish</option>
                                        <option value="Scots/Gaelic">Scots/Gaelic</option>
                                        <option value="Galician">Galician</option>
                                        <option value="Guarani">Guarani</option>
                                        <option value="Gujarati">Gujarati</option>
                                        <option value="Hausa">Hausa</option>
                                        <option value="Hindi">Hindi</option>
                                        <option value="Croatian">Croatian</option>
                                        <option value="Hungarian">Hungarian</option>
                                        <option value="Armenian">Armenian</option>
                                        <option value="Interlingua">Interlingua</option>
                                        <option value="Interlingue">Interlingue</option>
                                        <option value="Inupiak">Inupiak</option>
                                        <option value="Indonesian">Indonesian</option>
                                        <option value="Icelandic">Icelandic</option>
                                        <option value="Italian">Italian</option>
                                        <option value="Hebrew">Hebrew</option>
                                        <option value="Japanese">Japanese</option>
                                        <option value="Yiddish">Yiddish</option>
                                        <option value="Javanese">Javanese</option>
                                        <option value="Georgian">Georgian</option>
                                        <option value="Kazakh">Kazakh</option>
                                        <option value="Greenlandic">Greenlandic</option>
                                        <option value="Cambodian">Cambodian</option>
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
                                        <option value="Burmese">Burmese</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepali">Nepali</option>
                                        <option value="Dutch">Dutch</option>
                                        <option value="Norwegian">Norwegian</option>
                                        <option value="Occitan">Occitan</option>
                                        <option value="(Afan)/Oromoor/Oriya">(Afan)/Oromoor/Oriya</option>
                                        <option value="Punjabi">Punjabi</option>
                                        <option value="Polish">Polish</option>
                                        <option value="Pashto/Pushto">Pashto/Pushto</option>
                                        <option value="Portuguese">Portuguese</option>
                                        <option value="Quechua">Quechua</option>
                                        <option value="Rhaeto-Romance">Rhaeto-Romance</option>
                                        <option value="Kirundi">Kirundi</option>
                                        <option value="Romanian">Romanian</option>
                                        <option value="Russian">Russian</option>
                                        <option value="Kinyarwanda">Kinyarwanda</option>
                                        <option value="Sanskrit">Sanskrit</option>
                                        <option value="Sindhi">Sindhi</option>
                                        <option value="Sangro">Sangro</option>
                                        <option value="Serbo-Croatian">Serbo-Croatian</option>
                                        <option value="Singhalese">Singhalese</option>
                                        <option value="Slovak">Slovak</option>
                                        <option value="Slovenian">Slovenian</option>
                                        <option value="Samoan">Samoan</option>
                                        <option value="Shona">Shona</option>
                                        <option value="Somali">Somali</option>
                                        <option value="Albanian">Albanian</option>
                                        <option value="Serbian">Serbian</option>
                                        <option value="Siswati">Siswati</option>
                                        <option value="Sesotho">Sesotho</option>
                                        <option value="Sundanese">Sundanese</option>
                                        <option value="Swedish">Swedish</option>
                                        <option value="Swahili">Swahili</option>
                                        <option value="Tamil">Tamil</option>
                                        <option value="Telugu">Telugu</option>
                                        <option value="Tajik">Tajik</option>
                                        <option value="Thai">Thai</option>
                                        <option value="Tigrinya">Tigrinya</option>
                                        <option value="Turkmen">Turkmen</option>
                                        <option value="Tagalog">Tagalog</option>
                                        <option value="Setswana">Setswana</option>
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
                                        <option value="Wolof">Wolof</option>
                                        <option value="Xhosa">Xhosa</option>
                                        <option value="Yoruba">Yoruba</option>
                                        <option value="Chinese">Chinese</option>
                                        <option value="Zulu">Zulu</option>
                                    </select>
                                    <script>
                                        var p = new SlimSelect({
                                            select: '#testdemo'
                                        });
                                    </script>
                                    <span class="error" id="b_testdemo"></span>
                                </div>
                                <div class="col-md-6">
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
                                <div class="col-md-6">
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
                                    <input type="radio" id="hours2" name="hours_opt" {{ ($hours_opt == 'Always open') ? 'checked' : ''}} value="Always open" style="width: 25px;height: 25px;position: relative;top: 5px;margin-left: 20px;" id="hours2" autocomplete="off">
                                    <?php /*?><span style="font-size: 16px;">Always open</span>
                                    <input type="radio" id="hours3" name="hours_opt" {{ ($hours_opt == 'Temporalily closed') ? 'checked' : ''}} value="Temporalily closed" style="width: 25px;height: 25px;position: relative;top: 5px;margin-left: 20px;" id="hours4" autocomplete="off"><?php */?>
                                    <span style="font-size: 16px;">Temporalily closed</span>
                                    <input type="radio" id="hours4" name="hours_opt" {{ ($hours_opt == 'Permanently closed') ? 'checked' : ''}} value="Permanently closed" style="width: 25px;height: 25px;position: relative;top: 5px;margin-left: 20px;" id="hours5" autocomplete="off">
                                    <span style="font-size: 16px;">Permanently closed</span>
                                </div>
                            </div>
                            <div class="col-md-12" id="selectdays" style="{{ ($hours_opt == 'Open on selected hours') ? 'display:block' : 'display:none'}};padding: 30px 110px;">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="mon">Monday</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="mon_shift_start" value="{{ $mon_shift_start }}" readonly class="form-control timepicker">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="mon_shift_end" value="{{ $mon_shift_end }}" readonly class="form-control timepicker1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="tue">Tuesday</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="tue_shift_start" value="{{ $tue_shift_start }}" readonly class="form-control timepicker">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="tue_shift_end" value="{{ $tue_shift_end }}" readonly class="form-control timepicker1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="wed">Wednesday</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="wed_shift_start" value="{{ $wed_shift_start }}" readonly class="form-control timepicker">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="wed_shift_end" value="{{ $wed_shift_end }}" readonly class="form-control timepicker1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="thu">Thursday</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="thu_shift_start" value="{{ $thu_shift_start }}" readonly class="form-control timepicker">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="thu_shift_end" value="{{ $thu_shift_end }}" readonly class="form-control timepicker1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="fri">Friday</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="fri_shift_start" value="{{ $fri_shift_start }}" readonly class="form-control timepicker">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="fri_shift_end" value="{{ $fri_shift_end }}" readonly class="form-control timepicker1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="sat">Saturday</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="sat_shift_start" value="{{ $sat_shift_start }}" readonly class="form-control timepicker">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="sat_shift_end" value="{{ $sat_shift_end }}" readonly class="form-control timepicker1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="sun">Sunday</label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="sun_shift_start" value="{{ $sun_shift_start }}" readonly class="form-control timepicker">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" name="sun_shift_end" value="{{ $sun_shift_end }}" readonly class="form-control timepicker1">
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
                            <div class="col-md-12" id="selected_date_off" style="{{ ($hours_opt == 'Open on selected hours' || $hours_opt == 'Always open') ? 'display:block' : 'display:none'}}">
                                <br/>
                                <br/>
                                <br/>
                                <div class="row">
                                    <div class="col-md-6">
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
                                                <!--<input type="text" class="form-control" name="special_days_off" value="{{ $special_days_off }}" placeholder="Click here to select the dates you are closed" id="mdp-demo" maxlength="500" />-->								
                                                    <input type="text" class="form-control multidatepicker" id="mdp-demo" name="special_days_off" placeholder="Click here to select the dates you are closed" onkeydown="no_backspaces(event);" >
                                            </div>
                                            
                                            <script>
                                                /*$('.multidatepicker').multiDatesPicker();*/

												 	
													/*$(document).ready(function () {
            $('#mdp-demo').multiDatesPicker();
        });*/
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
                                    <div class="col-md-6" style="background:#dedada; padding: 30px 20px; min-height: 250px;">
                                        <div class="text-center">
                                            <span style="font-size: 18px;font-weight: bold;text-transform: uppercase;">Selected Date Off</span><br>
                                            <label>Customers will not be able to book you on these days</label>
                                        </div>
                                        <div class="manual-remove" style="float:left;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <br/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn-bck" id="bck-nxt3"><i class="fa fa-arrow-left"></i> Back</button>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="submit" class="btn-nxt" id="btn-nxt3">Save & Continue <i class="fa fa-arrow-right"></i></button>
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
                $houserules = $cancelation = $cleaning = $termcondfaq = $termcondfaqtext = $contractterms = $contracttermstext = $liability = $liabilitytext = $covid = $covidtext = "";
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
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>
                                        Give your customers THINGS TO KNOW and information on how and what to prepare before they book.
                                    </p>
                                    <br/><br/>
                                    <div class="form-group">
                                        <label for="house_rules">House Rules <span id="star">*</span></label>
                                        <textarea required placeholder="Tell your customers how they should conduct themselves when attending your place of business or participating in your activity. Set out a few guidelines to help things go smoothly." name="houserules" id="house_rules" cols="30" rows="4" class="form-control" maxlength="500">{{ $houserules }}</textarea>
                                        <span class="error" id="err_house_rules"></span>
                                        <div class="text-right"><span id="house_rules_left">500</span> Characters Left</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cancelation_policy">Cancelation Policy <span id="star">*</span></label>
                                        <textarea required placeholder="Let your customers know your rules about canceling a booking. Set your policy and regulations." name="cancelation" id="cancelation_policy" cols="30" rows="4" class="form-control" maxlength="500">{{ $cancelation }}</textarea>
                                        <span class="error" id="err_cancelation_policy"></span>
                                        <div class="text-right"><span id="cancelation_policy_left">500</span> Characters Left</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="safety_cleaning">Safety and Cleaning Procedures <span id="star">*</span></label>
                                        <textarea required placeholder="Let your customers know your safety and cleaning procedures to keep them healthy and safe." name="cleaning" id="safety_cleaning" cols="30" rows="4" class="form-control" maxlength="500">{{ $cleaning }}</textarea>
                                        <span class="error" id="err_safety_cleaning"></span>
                                        <div class="text-right"><span id="safety_cleaning_left">500</span> Characters Left</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                                <input type="checkbox" value="1" class="chkdy" id="contractterms" name="contractterms" autocomplete="off" {{ ($contractterms==1) ? 'checked' : '' }}> Contract Terms ?
                                            </label>
                                            <div class="col-md-12 textsam" id="contracttermsdiv" style="display: none;">
                                                <textarea class="form-control" placeholder="Contract Terms" id="contracttermstext" name="contracttermstext">{{ $contracttermstext }}</textarea>
                                                <div class="text-right"><span id="contracttermstext_left">1000</span> Characters Left</div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="terms_3" class="col-md-12 terms-check3">
                                                <input type="checkbox" value="1" class="chkdy" id="liability" name="liability" autocomplete="off" {{ ($liability==1) ? 'checked' : '' }}> Liability Waiver
                                            </label>
                                            <div class="col-md-12 textsam" id="liabilitydiv" style="display: none;">
                                                <textarea class="form-control" placeholder="Liability Waiver" id="liabilitytext" name="liabilitytext">{{ $liabilitytext }}</textarea>
                                                <div class="text-right"><span id="liabilitytext_left">1000</span> Characters Left</div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="terms_4" class="col-md-12 terms-check4">
                                                <input type="checkbox" value="1" class="chkdy" id="covid" name="covid" autocomplete="off" {{ ($covid==1) ? 'checked' : '' }}> Covid – 19 Protocols
                                            </label>
                                            <div class="col-md-12 textsam" id="coviddiv" style="display: none;">
                                                <textarea class="form-control" placeholder="Covid – 19 Protocols" id="covidtext" name="covidtext">{{ $covidtext }}</textarea>
                                                <div class="text-right"><span id="covidtext_left">1000</span> Characters Left</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <br/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn-bck" id="bck-nxt4"><i class="fa fa-arrow-left"></i> Back</button>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <button type="submit" class="btn-nxt" id="btn-nxt4">Save & Continue <i class="fa fa-arrow-right"></i></button>
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
                        <p id="checkpass">
                            Complete a background check and earn your customer trust. It's a fast and simple process. Background checks are optional and <b>NOT</b> mandatory. Earn a Fitnessity vetted business badge for your profile page. Vetted businesses received more bookings than non-verified.
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
                        <div class="form-group col-md-4">
                            <label for="phone_number">Phone number <span id="star">*</span></label>
                            <input type="text" name="phonenumber" id="phone_number" placeholder="" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" autocomplete="off" value="{{ $phone }}">
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

            
            <form name="creService" id="creService" action="{{route('addbusinessservices')}}" method="post" enctype="multipart/form-data">
                <?php
                //echo "<pre>";print_r($business_service);die;
                $service_type = $sport_activity = "";
                $program_name = $program_desc = $profile_pic = $instant_booking = $reserved_booking = "";
                $notice_value = $notice_key = $advance_value = $advance_key = $activity_value = $activity_key = $cancel_value = $cancel_key = $willing_to_travel = $miles = $area = "";
                $select_service_type = $activity_location = $activity_for = $age_range = $group_size = $difficult_level = $activity_experience = $instructor_habit = $is_late_fee =
				$late_fee = "";
                
                $mon_shift_start = $mon_shift_end = $tue_shift_start = $tue_shift_end = $wed_shift_start = $wed_shift_end = $thu_shift_start = $thu_shift_end = "";
                $fri_shift_start = $fri_shift_end = $sat_shift_start = $sat_shift_end = $sun_shift_start = $sun_shift_end = "";
                $mon_duration = $tue_duration = $wed_duration = $thu_duration = $fri_duration = $sat_duration = $sun_duration = "";
                $frm_servicedesc = $exp_country = $exp_address = $exp_building = $exp_city = $exp_state = $exp_zip = "";
				
                //echo "<pre>";print_r($business_service);die;
                
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
                    if(isset($business_service['profile_pic']) && !empty($business_service['profile_pic'])) {
                        $profile_pic = $business_service['profile_pic'];
                    }
                    if(isset($business_service['instant_booking']) && !empty($business_service['instant_booking'])) {
                        $instant_booking = $business_service['instant_booking'];
                    }
                    if(isset($business_service['reserved_booking']) && !empty($business_service['reserved_booking'])) {
                        $reserved_booking = $business_service['reserved_booking'];
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
                    if(isset($business_service['exp_country']) && !empty($business_service['exp_country'])) {
                        $exp_country = $business_service['exp_country'];
                    }
                    if(isset($business_service['exp_address']) && !empty($business_service['exp_address'])) {
                        $exp_address = $business_service['exp_address'];
                    }
                    if(isset($business_service['exp_building']) && !empty($business_service['exp_building'])) {
                        $exp_building = $business_service['exp_building'];
                    }
                    if(isset($business_service['exp_city']) && !empty($business_service['exp_city'])) {
                        $exp_city = $business_service['exp_city'];
                    }
                    if(isset($business_service['exp_state']) && !empty($business_service['exp_state'])) {
                        $exp_state = $business_service['exp_state'];
                    }
                    if(isset($business_service['exp_zip']) && !empty($business_service['exp_zip'])) {
                        $exp_zip = $business_service['exp_zip'];
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
                    if(isset($activity['set_duration']) && !empty($activity['set_duration'])) {
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
                <?php /*?>if( !empty($business_service) ){ ?>111
                    <input type="hidden" name="cid" value="{{$business_service['cid']}}">
                    <input type="text" name="serviceid" id="serviceid" value="{{$business_service['id']}}">
                <?php }else{<?php */?>
                <?php //} ?>
                <input type="hidden" name="cid" value="{{Auth::user()->cid}}">
                <input type="hidden" name="bstep" id="bstep7" value="{{Auth::user()->bstep}}">
                <?php if( !empty($business_service) ){ ?>
                	<input type="hidden" name="serviceid" id="serviceid" value="{{$business_service['id']}}">
                <?php } else { ?>
                	<input type="hidden" name="serviceid" id="serviceid">
                <?php } ?>
                <input type="hidden" name="service_type" id="service_type" value="{{$service_type}}">
                <input type="hidden" name="current_tab_name" id="current_tab_name" value="individualDiv0">
                
                <div class="container-fluid p-0" id="creServicediv" style="display: none;">
                    <div class="tab-hed">Create Services & Prices</div>
                    <?php /*?><div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">
                        <span class="nav-link1 subtab">PERSONAL TRAINER</span>
                        <span class="nav-link1 subtab1">GYM/STUDIO</span>
                        <span class="nav-link1 subtab2">EXPERIENCE</span>
                    </div><?php */?>
                    <section class="row">
                        <?php /*?><div class="col-md-12 text-justify">
                            <br/>
                            <p><span style="font-size: 22px;font-weight: bold;">YOU'RE ALMOST DONE!</span> This last section is where you will describe your programs, add attractive images, description, prices, taxes, terms
                                and conditions, contracts, one-time payments, recurring payment, sessions, and more. We recommend you make sure your price sare competitive to your skill level and to what the market demands</p>
                        </div><?php */?>
                        <div class="col-md-12 text-center">
                            <br>
                            <span style="font-size: 20px;font-weight: bold;text-transform: uppercase;">Select Your Business Type</span><br>
                            <label>Click on one of the business types below to start creating a service to offer. Only select the type of business that best
represents the type of experiences you offer your clients. Don't worry; you can set up more than one type of business type.</label><br>
                        </div>
                        <div class="col-md-12">
                            <br/><br/>
                            <div class="custome-div col-md-offset-2 col-md-8 col-md-offset-2">
                                <input type="radio" id="test1" name="radio_group" {{ ($service_type=='individual')?'checked':'' }} value="individual">
                                <label for="test1">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="/public/images/newimage/bus-individual.png" class="pro_card_img1">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="tab-hed1">Personal Trainer</div>
                                            <p>A provider offers one-on-one personal training, coaching, nutrition advice, or instructions.</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <br/>
                            <div class="custome-div col-md-offset-2 col-md-8 col-md-offset-2">
                                <input type="radio" id="test2" name="radio_group" {{ ($service_type=='classes')?'checked':'' }} value="classes">
                                <label for="test2">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="/public/images/newimage/bus-gym.png" class="pro_card_img1">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="tab-hed1">Gym/Studio</div>
                                            <p>A provider offers group fitness workouts and classes at a gym, studio, or facility.</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <br/>
                            <div class="custome-div col-md-offset-2 col-md-8 col-md-offset-2">
                                <input type="radio" id="test3" name="radio_group" {{ ($service_type=='experience')?'checked':'' }} value="experience">
                                <label for="test3">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <img src="/public/images/newimage/bus-experience.png" class="pro_card_img1">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="tab-hed1">Experience</div>
                                            <p>A provider that offers an adventurous activity or an experience surrounding the activity.</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <br/><br/>
                        </div>
                        <div class="col-md-12">
                            <br/>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn-bck" id="bck-nxt8"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn-nxt" id="nextservice">Continue <i class="fa fa-arrow-right"></i></button>
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
                        <span class="classesTxt nav-link1 subtab1" style="{{ ($service_type=='classes')?'color:red':'' }}">GYM/STUDIO</span>
                        <span class="experienceTxt nav-link1 subtab2" style="{{ ($service_type=='experience')?'color:red':'' }}">EXPERIENCE</span>
                    </div>
                    <section class="row" style="padding: 40px 10px;">
                        <div class="col-md-2">
                            <input type="button" class="btn btn-red" name="btnCreateService" id="btnCreateService" value="Create Service" />
                        </div>
                        <div class="col-md-2">
                            @if(Auth::user()->serviceid==0)
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
                            @if($cservice->serviceid != 0)
                            <li class="{{ $cservice->service_type }}"><a href="javascript:void(0);" data-sid="{{ $cservice->serviceid }}" class="clsManageService">{{ $cservice->service_type }}-{{ $cservice->sport_activity}} </a></li>
                            @endif
                            @endforeach
                            @endif
                            </ul>
                            </div>
                            @endif
                        </div>
                        
                       <!-- <div class="col-md-8 text-justify individualBody" style="display:{{ ($service_type=='individual')?'block':'none' }}; background:url(/public/img/fitness-bg1.jpg); background-size:100% 100%;">-->
                        <div class="col-md-8 text-justify individualBody" style="display:{{ ($service_type=='individual')?'block':'none' }};">
                            <p>Set up your details and prices for your training services. Let customers know why you are the best personal trainer/coach.
Personal training is completitive market. Think about your descriptions, heading, images, & prices. It's essential to be
competitive with your price point but not too low to de-value your experience.</p>
                            <h3>Recommended Tips to Do :</h3>
                            <ul>
                                <li>Create a professional profile. It's your website and resumer to potential clients.</li>
                                <li>Sell your business and show what makes your business the best.</li>
                                <li>Take professional high-resolution pictures.</li>
                                <li>Showcase your certifications, awards, education, and experience.</li>
                            </ul>
                           <!-- <p>- Create a professional profile. It’s your website and resume to potential clients.</p>
                            <p>- Sell your business and show what makes your business the best.</p>
                            <p>- Take professional pictures and make your customers feel welcomed.</p>-->
                            <h3>Tips Not to Do :</h3>
                            <!--<p>- Having images that are not of professional manner, creepy or not comfortable.</p>
                            <p>- Not having a well-planned experience.</p>
                            <p>- Just going with the flow will not give you repeat business.</p>
                            <p>- Creating a generic service that customers can easily do on their own.</p>
                            <p>- Offering a service you are not qualified or skilled to do.</p>-->
                            <ul>
                                <li>You have images that are not professional, creepy, or uncomfortable to clients.</li>
                                <li>Not having a well-planned experiences.</li>
                                <li>Just going with the flow will not give you repeat business.</li>
                                <li>Creating a generic service that customers can easily do on their own.</li>
                                <li>Offering a service or experience you are not qualified or skilled to do.</li>
                          	</ul>
                        </div>
                        
                        <div class="col-md-8 text-justify classesBody" style="display:{{ ($service_type=='classes')?'block':'none' }}; background:url(/public/img/fitness-bg2.jpg); background-size:100% 100%;">
                            <p>Booking and creating group classes, boot camps, clinics, and more is very easy. You can create services both online and offline.
WHen creating your profile, how do you stand out from others? Every image, video, description, price, completed background check,
positive reviews, and how you deliver your services will help you become a top business professional on Fitnessity.</p>
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
                            <!--<p>- Create a professional profile. It’s your website and resume to potential clients.</p>
                            <p>- Sell your business and show what makes your business the best.</p>
                            <p>- Take professional pictures and make your customers feel welcomed.</p>
                            <h3>Tips Not to Do :</h3>
                            <p>- Having images that are not of professional manner, creepy or not comfortable.</p>
                            <p>- Not having a well-planned experience.</p>
                            <p>- Just going with the flow will not give you repeat business.</p>
                            <p>- Creating a generic service that customers can easily do on their own.</p>
                            <p>- Offering a service you are not qualified or skilled to do.</p>-->
                        </div>
                        
                        <div class="col-md-8 text-justify experienceBody" style="display:{{ ($service_type=='experience')?'block':'none' }}; background:url(/public/img/fitness-bg3.jpg); background-size:100% 100%;">
                            <p>Create your itinerary, service details, and prices for your experience. Let customers know what the plans are. Describe what you will
do with your customers. What's unique and sets you apart from other similar experiences? How will you make customers feel included
and engaged during your time together? Being specific about what guests will do on your activity is important. Set up a 
detailed itinerary so that guests know what to expect.</p>
                            <h3>Recommended Tips to Do :</h3>
                            <ul>
                                <li>Create an experience around your activity.</li>
                                <li>Make it unique and different.</li>
                                <li>Think about your meet-up points and how customers will get to you.</li>
                                <li>Think about what your experience includes and what your customers will need to bring.</li>
                                <li>Think about your plans and think about the experience your customer will have.</li>
                           	</ul>
                            
                            <!--<p>- Create an experience around your activity.</p>
                            <p>- Make it unique and different.</p>
                            <p>- Think about your meet-up points, how customers will get to you.</p>
                            <p>- Think about what your experience includes and what your customers will need to bring.</p>
                            <p>- Think about your plans and think about the experience your customer will have.</p>-->
                            
                            <h3>Tips Not to Do :</h3>
                            <ul>
                                <li>Having no experience planned around your activity.</li>
                                <li>Not having a well-planned experience.</li>
                                <li>Giving incomple information is not recommended.</li>
                                <li>Creating generic experiences and activities customers can easily do on their own.</li>
                                <li>Offering an experience you are not qualified or skilled to host.</li>
                            </ul>
                            <!--<p>- Having no experience planned around your activity.</p>
                            <p>- Not having a well-planned experience.</p>
                            <p>- Giving incomplete information is not recommended.</p>
                            <p>- Creating generic experiences and activities customers can easily do on their own.</p>
                            <p>- Offering an experience you are not qualified or skilled to host.</p>-->
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
                        <span class="classesTxt nav-link1 subtab1" style="{{ ($service_type=='classes')?'color:red':'' }}">GYM/STUDIO</span>
                        <span class="experienceTxt nav-link1 subtab2" style="{{ ($service_type=='experience')?'color:red':'' }}">EXPERIENCE</span>
                    </div>
                    <section class="row">
                        <div class="col-md-4">
                            <br/><br/><br/>
                            <select name="frm_servicesport--commented" id="frm_servicesport--commented" class="form-control">
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
                            <span class="error" id="err_frm_servicesport"></span>
                            <br/>
                            <input type="text" name="frm_servicetitle_two--commented" id="frm_servicetitle_two--commented" placeholder="Name of Program" title="servicetitle" value="{{ $program_name }}" class="form-control">
                            <span class="error" id="err_frm_servicetitle_two--commented"></span>
                            <br/><br/>
                            <div class="text-center" style="display: none"> <label>No Service Added Yet.<br>
                                    Get started by selecting Add Activity Category to choose the activity.</label></div>
                        </div>
                        
                        <div class="col-md-8 text-justify individualBody" style="display:{{ ($service_type=='individual')?'block':'none' }}; background:url(/public/img/fitness-bg1.jpg); background-size:100% 100%;">
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
                        <span class="classesTxt nav-link1 subtab1" style="{{ ($service_type=='classes')?'color:red':'' }}">GYM/STUDIO</span>
                        <span class="experienceTxt nav-link1 subtab2" style="{{ ($service_type=='experience')?'color:red':'' }}">EXPERIENCE</span>
                    </div>
                    <section class="row">
                        <div class="col-md-12">
                            <br/>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                            				<label for="frm_programname">Let's get a few details about the program <span id="star">*</span></label><br>
                                            <select name="frm_servicesport" id="frm_servicesport" class="form-control">
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
                                            <span class="error" id="err_frm_servicesportS2"></span>
                                        </div>
                                    </div>
                                     
                                     <div class="row">    
                                        <div class="form-group col-md-12">
                                            <input type="text" class="form-control" name="frm_programname" id="frm_programname" placeholder="Enter Name of Program" title="servicetitle" value="{{ $program_name }}">
                                            <span class="error" id="err_frm_programname"></span>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" rows="6" name="frm_programdesc" id="frm_programdesc" placeholder="Enter program description" maxlength="150">{{ $program_desc }}</textarea>
                                            <span class="error" id="err_frm_programdesc"></span>
                                            <div class="text-right"><span id="frm_programdesc_left">150</span> Characters Left</div>
                                        </div>
                                        <div class="form-group col-md-12 hide">
                                            <label class="switch" for="booking1">
                                                <input type="radio" name="booking" id="booking1" value="instant" {{ ($instant_booking==1) ? "Checked" : "" }}>
                                                <span class="slider round"></span>
                                            </label>
                                            <span class="error" id="err_booking1"></span>
                                            <span>INSTANT BOOKING : Allow customers to book you instantly</span>
                                        </div>
                                        <div class="form-group col-md-12" style="display:none">
                                            <label class="switch" for="booking2">
                                                <input type="radio" name="booking" id="booking2" value="reserve" {{ ($reserved_booking==1) ? "Checked" : "" }}>
                                                <span class="slider round"></span>
                                            </label>
                                            <span>RESERVED BOOKING : You need to confirm each booking first before completion</span>
                                        </div>
                                        <?php /*?><div class="form-group col-md-12">
                                            <label>How much notice do you need for each booking ?</label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="notice_value" id="firstdayweek" rel="notice">
                                                <option value="">Select Value</option>
                                                <option value="Days" {{ ($notice_value=='Days') ? "selected" : "" }}>Days</option>
                                                <option value="Weeks" {{ ($notice_value=='Weeks') ? "selected" : "" }}>Weeks</option>
                                                <option value="Months" {{ ($notice_value=='Months') ? "selected" : "" }}>Months</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6" id="notice_div">
                                            <select class="form-control" name="notice_key" id="notice">
                                                <? if($notice_key == "") { ?>
                                                <option value="">Select Value</option>
                                                <? } ?>
                                                <?php for($i=1; $i<=31; $i++) { ?>
                                                <option value="<?=$i?>" <?= ($notice_key==$i) ? "selected" : "" ?>><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <script>
                                            $('#firstdayweek').change(function() {
                                                var t = $('#firstdayweek option:selected').val();
                                                var id = $('#firstdayweek').attr('rel');
                                                console.log(t, "---", id)
                                                if (t == 'Days') {
                                                    options_f(31, id);
                                                }
                                                if (t == 'Weeks') {
                                                    options_f(52, id);
                                                }
                                                if (t == 'Months') {
                                                    options_f(12, id);
                                                }
                                            });
                                        </script>
                                        <div class="form-group col-md-12">
                                            <label>How far in advance can a customer book ?</label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php $addv = []; ?>
                                            <select class="form-control" name="advance_value" id="secdayweek" rel="addvance" onchange="seconddayweek_change_event(this.value)">
                                                <option value="">Select Value</option>
                                                <option value="Days" {{ ($advance_value=='Days') ? "selected" : "" }}>Days</option>
                                                <option value="Weeks" {{ ($advance_value=='Weeks') ? "selected" : "" }}>Weeks</option>
                                                <option value="Months" {{ ($advance_value=='Months') ? "selected" : "" }}>Months</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="advance_key" id="addvance">
                                                <? if($advance_key == "") { ?>
                                                <option value="">Select Value</option>
                                                <? } ?>
                                                <?php for($i=1; $i<=31; $i++) { ?>
                                                <option value="<?=$i?>" <?= ($advance_key==$i) ? "selected" : "" ?>><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <script>
                                            $('#secdayweek').change(function() {
                                                var t = $('#secdayweek option:selected').val();
                                                var id = $('#secdayweek').attr('rel');
                                                console.log(t, "---", id)
                                                if (t == 'Days') {
                                                    options_f(31, id);
                                                }
                                                if (t == 'Weeks') {
                                                    options_f(52, id);
                                                }
                                                if (t == 'Months') {
                                                    options_f(12, id);
                                                }
                                            });
                                        </script>
                                        <div class="form-group col-md-12">
                                            <label>What's the latest moment a person can book your activity?</label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="activity_value" id="thirdminute" rel="minute">
                                                <option value="">Select Value</option>
                                                <option value="Minute" {{ ($activity_value=='Minute') ? "selected" : "" }}>Minute</option>
                                                <option value="Hours" {{ ($activity_value=='Hours') ? "selected" : "" }}>Hours</option>
                                                <option value="Days" {{ ($activity_value=='Days') ? "selected" : "" }}>Days</option>
                                                <option value="Weeks" {{ ($activity_value=='Weeks') ? "selected" : "" }}>Weeks</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="activity_key" id="minute">
                                                <? if($activity_key == "") { ?>
                                                <option value="">Select Value</option>
                                                <? } ?>
                                                <?php for($i=1; $i<=31; $i++) { ?>
                                                <option value="<?=$i?>" <?= ($activity_key==$i) ? "selected" : "" ?>><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <script>
                                            $('#thirdminute').change(function() {
                                                var t = $('#thirdminute option:selected').val();
                                                var id = $('#thirdminute').attr('rel');
                                                console.log(t, "---", id)
                                                if (t == 'Minute') {
                                                    options_f(60, id);
                                                }
                                                if (t == 'Hours') {
                                                    options_f(24, id);
                                                }
                                                if (t == 'Days') {
                                                    options_f(31, id);
                                                }
                                                if (t == 'Weeks') {
                                                    options_f(52, id);
                                                }
                                            });
                                        </script><?php */?>
                                        
                                        <div class="form-group col-md-12">
                                            <label>What's the latest a customer can cancel?</label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="cancel_value2" id="forthcancel" rel="forthcancel1">
                                                <option value="">Select Value</option>
                                                <option value="Days" {{ ($cancel_value=='Days') ? "selected" : "" }}>Days</option>
                                                <option value="Weeks" {{ ($cancel_value=='Weeks') ? "selected" : "" }}>Weeks</option>
                                                <option value="Months" {{ ($cancel_value=='Months') ? "selected" : "" }}>Months</option>             
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="cancel_key2" id="forthcancel1">
                                                <?php if($cancel_key == "") { ?>
                                                <option value="">Select Value</option>
                                                <? } ?>
                                                <?php for($i=1; $i<=31; $i++) { ?>
                                                <option value="<?=$i?>" <?= ($cancel_key==$i) ? "selected" : "" ?>><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Is there a fee for late cancelation?</label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>If late cancelation then enter fee amount</label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="is_late_fee" id="is_late_fee" onchange="get_fee_box(this.value)">
                                                <option value="">Select Value</option>
                                                <option value="Yes" {{ ($is_late_fee=='Yes') ? "selected" : "" }}>Yes</option>
                                                <option value="No" {{ ($is_late_fee=='No') ? "selected" : "" }}>No</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <input class="form-control" type="text" name="late_fee" id="late_fee" value="{{$late_fee}}" style="width:92%;display: inline-block;" onkeypress="return digitKeyOnly(event)"/> USD
                                            <br />
                                            <span class="error" id="err_late_fee"></span>
                                        </div>
                                        <script>
                                            $('#forthcancel').change(function() {
                                                var t = $('#forthcancel option:selected').val();
                                                var id = $('#forthcancel').attr('rel');
                                                console.log(t, "---", id)
                                                if (t == 'Hours') {
                                                    options_f(24, id);
                                                }
                                                if (t == 'Days') {
                                                    options_f(31, id);
                                                }
                                                if (t == 'Weeks') {
                                                    options_f(52, id);
                                                }
                                                if (t == 'Months') {
                                                    options_f(12, id);
                                                }
                                            });
											function get_fee_box(fld)
											{
												if(fld=='Yes')
												{
													$("[name='late_fee']").prop("required", true);
													$('#err_late_fee').html('Please enter late fee amount.');
													$('#late_fee').focus();
													return false;
												}
												else
												{
													$("[name='late_fee']").prop("required", false);
													$('#err_late_fee').html(' ');
													
												}
											}
                                        </script>
                                    </div>
                                    <div class="row itenerary_div" style="display:none">
                                    	<div class="form-group col-md-12">
                                        	<label><h3>Set Up Your Itinerary</h3></label>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="" for="what_you_doing">What will you be doing? </label>
                                            <textarea class="form-control" rows="6" name="what_you_doing" id="what_you_doing" placeholder="Briefly describe what you'll do with your customers. Be specific about what guests will do on your activity." maxlength="500">{{ $program_desc }}</textarea>
                                            <span class="error" id="err_what_you_doing"></span>
                                            <div class="text-right"><span id="frm_what_you_doing">500</span> Characters Left</div>
                                        </div>
                                        <div class="form-group col-md-12 mt-25">
                                            <label>What's Included with this experience?</label>
                                            <p>
                                            What do you provide for your guest that will make the experience memorabel?
                                            (You can provide transportation and pickup from hotels etc. Food an drinks, special
                                            equipment, video and photography services, or anything else special to make your 
                                            guests comfortable.)
                                            Select all that apply </p>
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
                                        <div class="form-group col-md-12">
                                            <label>What's Not Included with this experience?</label>
                                            <p> List the items or services that are not includes with this experience. i.e. no food or drinks, no equipment, no insurance, etc.</p>
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
                                        <div class="form-group col-md-12">
                                            <label>What should Guest Bring and Wear?</label>
                                            <p> If guests need anything in order to enjoy your experience, this is the place to tell them. This list will be emailed to guests when they book your experience to help them prepare. Be as detailed as possible and each item individually.</p>
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
                                        <div class="form-group col-md-12">
                                            <label>Require Safety Verifications</label>
                                            <p> The primary booker has to successfully complete verified ID in order for them and there guests to attend your experience.</p>
                                            <div class="col-md-12">
                                            	<input type="checkbox" id="id_proof" name="id_proof"  value="1" /> 
                                                Require the booker to have ID upon arrival for verification of age and identity (This will be emailed to guest so the are prepared).
                                           	</div>
                                            <div class="col-md-12">
                                            	<input type="checkbox"  id="id_vaccine" name="id_vaccine"  value="1" /> 
                                                Require the booker to have proof of vacination. (This will be emailed to guest so they are prepared)
                                           	</div>
                                            <div class="col-md-12">
                                            	<input type="checkbox"  id="id_covid" name="id_covid"  value="1" /> Require the booker to have proof of a nagative Covid-19 test. (This will be emailed to guest so they are prepared)
                                           	</div>
                                            
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Let's Plan Your Day By Day</label>
                                            <p> Give your customers a day by day plan. Include a title, image and description of what the customers will be doing for that day. You can create multiple days.</p>
                                            <div class="col-md-12 add-another-day-schedule-block mt-25">
                                            	<div class="row add_another_day">
                                                    <div class="col-md-3 text-center">
                                                        <div class="imagePreview divImgPreview">
                                                            <img src="" class="imagePreview blah2" id="showimgDayPlan">
                                                        </div>
                                                        <label class="img-tab-btn">Upload Image<input type="file" name="dayplanpic" class="uploadFile img" value="Upload Photo" onchange="readServicePic2(this);" style="width: 0px;height: 0px;overflow: hidden;"></label>
                                                        <span class="error" id="err_oldservicepic2"></span>
                                                        <input type="hidden" id="olddayplanpic2" name="olddayplanpic" value="">
                                                        
                                                    </div>
                                                    <div class="col-md-9">
                                                    	<input type="text" class="form-control" name="days_title[]" id="days_title0" placeholder="Give Heading for This Day"/><br />
                                                        <textarea class="form-control" rows="6" name="days_description[]" id="days_description" placeholder="Give Description For This Day" maxlength="150">{{ $program_desc }}</textarea>
                                                    </div>
                                                </div>
                                           	</div>
                                            <div class="col-md-12 text-center" style="margin-top: 50px;">
                                           		<a id="test" class="button-fitness add-another-day-schedule">Add Another Day</a>
                                           	</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8 imgUp">
                                            <div class="imagePreview divImgPreview">
                                                @if(!empty($profile_pic) && File::exists(public_path("/uploads/profile_pic/thumb/".$profile_pic)))
                                                <img src="{{ url('/public/uploads/profile_pic/thumb/'.$profile_pic) }}" class="imagePreview blah2" id="showimgservice">
                                                @else
                                                <img src="{{ url('/public/images/default-avatar.png') }}" class="imagePreview blah2" id="showimgservice">
                                                @endif
                                            </div>
                                            <label class="img-tab-btn">Upload Image<input type="file" name="servicepic" class="uploadFile img" value="Upload Photo"  onchange="readServicePic2(this);" style="width: 0px;height: 0px;overflow: hidden;"></label>
                                            <span class="error" id="err_oldservicepic2"></span>
                                            <input type="hidden" id="oldservicepic" name="oldservicepic" value="{{ $profile_pic }}" >
                                            <label style="font-size: 12px;">Upload an image that best represents your program</label>
                                        </div><!-- col-2 -->
                                    </div><!-- row -->
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
                        <span class="classesTxt nav-link1 subtab1" style="{{ ($service_type=='classes')?'color:red':'' }}">GYM/STUDIO</span>
                        <span class="experienceTxt nav-link1 subtab2" style="{{ ($service_type=='experience')?'color:red':'' }}">EXPERIENCE</span>
                    </div>
                    <section class="row">
                        <br/>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 location_div">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <h3 style="font-size: 17px;font-weight: bold;">MORE DETAILS ABOUT YOUR SERVICES</h3>
                                            <div class="form-group">
                                                <label>Do you travel to clients to offer this service ? If yes, click yes to activate.</label><br>
                                                <input class="willing_to_travel" value="yes" type="radio" name="willing_to_travel" {{ ($willing_to_travel=='yes')?'checked':'' }} id="checkserviceyes" style="width: 25px;height: 25px;position: relative;top: 5px;">
                                                <span style="font-size: 20px;font-weight: bold;">Yes</span>
                                                <input class="willing_to_travel" value="no" type="radio" name="willing_to_travel" {{ ($willing_to_travel=='no')?'checked':'' }} id="checkserviceno" style="width: 25px;height: 25px;position: relative;top: 5px;margin-left: 20px;">
                                                <span style="font-size: 20px;font-weight: bold;">No</span>
                                            </div>
                                            <div class="form-group" id="servicebox" style="display:block;">
                                                <label for="milesnew">If yes, how far are you willing to travel out of your base zipcode ? Select the distance and check the map for reference of distance. </label>
                                                <?php
                                                $miles_arr = array('1'=>'1 Mile','3'=>'3 Miles','5'=>'5 Miles','10'=>'10 Miles','15'=>'15 Miles','20'=>'20 Miles');
                                                ?>
                                                <select class="form-control travel_miles_div" name="travel_miles" id="milesnew" {{ ($willing_to_travel=='yes')?'':'disabled="disabled"' }}>
                                                    <option value="">Select Miles</option>
                                                    <?php foreach($miles_arr as $key=>$value) { ?>
                                                    <option <?= ($miles == $key) ? "selected" : "" ?> value="<?= $key; ?>"><?php echo $value; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="where_do_you_work">
                                            <div class="col-md-6">
                                                <label for="wanttowork">Where do you want to work ?</label>
                                                <input type="text" name="wanttowork" id="wanttowork" class="form-control" placeholder="Specific Area" value="{{ !empty($area) ? $area : 'New York' }}">
                                            </div>
                                            <div class="col-md-6">
                                                <input style="margin-top:25px;" type="button" class="btn btn-primary" value="Refresh Map" id="refresh_map" />
                                            </div>
                                        </div>
                                        <div class="map-block" style="border:1px solid #000">
                                            <span class="travel_miles_div">
                                                <div id="map_canvas"></div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 location_div_experience">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <h3 style="font-size: 17px;font-weight: bold;">Describe the location</h3>
                                            <div class="form-group">
                                                <label>Tell customers how to meet up, where to meet up, meeting point name and how to find you once the customers arrive.
Don't leave it up to customers to figure out how to meet up with you. Let them know before hand.</label><br>
                                                <textarea class="form-control" value="yes" name="meetup_location" placeholder="(Ex. Please arrive at the location of our business. The address reminder is ABC Anytown, town 12345 USA.) Or; We will pick you up at your hotel. Or; Please talk with your front desk staff about the meeting poing, Or; Please meet us at Central Park at the entrance
of 81st and Central Park West (CPW). Wait at the seating area if you arrive early. The instructor will have on a red
hat and yellow vest. Please arrive 10 minutes before your activity starts.)"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                        	<label>Where should customers meet you?</label><br />
                                            If the meet up spot is different from the address you set earlier in Company Details, then you can set it here.
                                        </div>
                                        <div class="form-group col-md-6">
                                        	<label>Country/Region</label>
                                            <input type="text" name="meetup_country_region" id="meetup_country_region" class="form-control" value="New York">
                                        </div>
                                        <div class="form-group col-md-6">
                                        	<label>Street address</label>
                                            <input type="text" name="meetup_street_address" id="meetup_street_address" class="form-control">
                                        </div>
                                         <div class="form-group col-md-3">
                                        	<label>Apt/Suite/Bldg.</label>
                                            <input type="text" name="meetup_apt_suit" id="meetup_apt_suit" class="form-control">
                                        </div>
                                        <div class="form-group col-md-3">
                                        	<label>City</label>
                                            <input type="text" name="meetup_city" id="meetup_city" class="form-control">
                                        </div>
                                        <div class="form-group col-md-3">
                                        	<label>State</label>
                                            <input type="text" name="state" id="meetup_state" class="form-control">
                                        </div>
                                        <div class="form-group col-md-3">
                                        	<label>ZIP Code</label>
                                            <input type="text" name="meetup_zipcode" id="meetup_zipcode" class="form-control">
                                        </div>
                                        <div class="where_do_you_work">
                                            <div class="form-group col-md-12">
                                                <input style="margin-top:25px;" type="button" class="btn btn-primary" value="Refresh Map" id="refresh_map" />
                                            </div>
                                        </div>
                                        <div class="map-block" style="border:1px solid #000">
                                            <span class="travel_miles_div">
                                                <div id="map_canvas"></div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6  service_type">
                                    <br>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Select Service Type You Offer</label>
                                            <select name="frm_servicetype[]" id="categSType" multiple>
                                                <option value="Personal Training">Personal Training</option>
                                                <option value="Coaching">Coaching</option>
                                                <option value="Therapy">Therapy</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#categSType'
                                                });
                                            </script>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Location of Activity</label>
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
                                        <div class="form-group col-md-12">
                                            <label>Activity Great For</label>
                                            <select name="frm_programfor[]" id="frm_programfor" multiple>
                                               <?php /*?> <option>Individual</option><?php */?>
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
                                        <div class="form-group col-md-12">
                                            <label>Age Range</label>
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
                                        <div class="form-group col-md-12">
                                            <label>Number of slots Available for Booking</label>
                                            <select name="frm_numberofpeople[]" id="frm_numberofpeople">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10</option>
                                                <option>15</option>
                                                <option>20</option>
                                                <option>25</option>
                                                <option>30</option>
                                                <option>35</option>
                                                <option>40</option>
                                                <option>45</option>
                                                <option>50</option>
                                                <option>55</option>
                                                <option>60</option>
                                                <option>65</option>
                                                <option>70</option>
                                                <option>75</option>
                                                <option>80</option>
                                                <option>85</option>
                                                <option>90</option>
                                                <option>95</option>
                                                <option>100</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#frm_numberofpeople'
                                                });

                                            </script>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Difficulty Level</label>
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
                                        <div class="form-group col-md-12">
                                            <label>Activity Experience</label>
                                            <select name="frm_servicefocuses[]" id="frm_servicefocuses" multiple>
                                                <option value="Have Fun"> Have Fun</option>
                                                <option value="Adventurous">Adventurous</option>
                                                <option value="Thrilling">Thrilling</option>
                                               <?php /*?> <option value="Dangerous">Dangerous </option><?php */?>
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
                                        <div class="form-group col-md-12">
                                            <label>Personality & Habits of Instructor</label>
                                            <select name="frm_teachingstyle[]" id="teaching" multiple>
                                                <option value="An educator &amp; teacher">An Educator</option>
                                                <option value="A lot of energy">A Teacher</option>
                                                <option value="A drill sergeant">A lot of energy</option>
                                                <option value="Inspiring">A drill sergeant</option>
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
                                    </div><!-- row -->
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
                                    <button type="button" class="btn-nxt" id="nextindividual3">Continue <i class="fa fa-arrow-right"></i></button>
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
                        <span class="classesTxt nav-link1 subtab1" style="{{ ($service_type=='classes')?'color:red':'' }}">GYM/STUDIO</span>
                        <span class="experienceTxt nav-link1 subtab2" style="{{ ($service_type=='experience')?'color:red':'' }}">EXPERIENCE</span>
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
                                            <input type="date" class="form-control frm_starting" name="starting" id="startingpicker" value="{{ $starting }}" min="<?php echo date('Y-m-d');?>">
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
                                    <div id="activity_scheduler_body">
                                        <!-- Activity description will fill here -->
                                    </div>
                                    <div id="day-circle">
                                       <?php
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
                                       <div class="daycircle">
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
                                                    <input type="text" name="set_duration[]" value="{{ $set_duration }}" readonly class="set_duration form-control" style="width:90%">
                                                </div>
                                            </div>
                                        </div> 
                                        <?php
                                       }} else {
                                       ?>
                                       <div class="daycircle" style="display: none">
                                           <input type="text" name="activity_days[]" class="activity_days" width="800" value="" />
                                            <div class="row weekdays" style="justify-content: center;">
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
                                                    <input type="text" name="set_duration[]" value="" readonly class="set_duration form-control" style="width:90%">
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                       }
                                       ?>
                                    </div>
                                    <br/>
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
                                </div>
                            </div>
                            <br/>
                        </div>
                    </section>
                </div>

                <div class="container-fluid p-0 checkCurrentTabName" id="individualDiv5" style="display: none;">
                    <div class="tab-hed">Create Services & Prices</div>
                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">
                        <span class="individualTxt nav-link1 subtab" style="{{ ($service_type=='individual')?'color:red':'' }}">PERSONAL TRAINER</span>
                        <span class="classesTxt nav-link1 subtab1" style="{{ ($service_type=='classes')?'color:red':'' }}">GYM/STUDIO</span>
                        <span class="experienceTxt nav-link1 subtab2" style="{{ ($service_type=='experience')?'color:red':'' }}">EXPERIENCE</span>
                    </div>
                    <section class="row">
                        <div class="col-md-12">
                            <div class="row" style="padding: 30px 20px;">
                                <div class="col-md-12">
                                    <h3 style="font-size: 17px;font-weight: bold;">SET UP YOUR PRICING DETAILS</h3>
                                </div>
                                <div class="col-md-12" style="padding:10px 0">
                                    <div class="col-md-3">
                                        <label for="salestax" class="percentageckeck">
                                            <input type="checkbox" <?=($sales_tax=='salestax')?'checked':''?> value="salestax" name="salestax" id="salestax"> Sales Tax 
                                            <a href="#" title="Typically used for sales of merchandise, apparel, gear, goods, rentals, food, drinks, etc." class="tooltip-custom sp1" data-toggle="tooltip" data-placement="top">?</a>
                                        </label>
                                        <div class="salestaxpercentage" id="salestaxpercentage" style="position: absolute; left: 55%; top:-1px; <?=($sales_tax=='salestax')?'display:block':''?>">
                                            <input type="text" value="<?=$sales_tax_percent?>" name="salestaxpercentage" onkeypress="return event.charCode >= 46 && event.charCode <= 57" maxlength="3" class="form-control percentage"> %
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="duestax" class="percentageckeck">
                                            <input type="checkbox" <?=($dues_tax=='duestax')?'checked':''?> value="duestax" name="duestax" id="duestax"> Dues Tax 
                                            <a href="#" title="Typically used for memberships and dues" class="tooltip-custom sp1" data-toggle="tooltip" data-placement="top">?</a>
                                        </label>
                                        <div class="duestaxpercentage" id="duestaxpercentage" style="position: absolute; left: 55%; top:-1px; <?=($dues_tax=='duestax')?'display:block':''?>">
                                            <input type="text" value="<?=$dues_tax_percent?>" onkeypress="return event.charCode >= 46 && event.charCode <= 57" maxlength="3" name="duestaxpercentage" class="form-control percentage" > %
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12 service_price_block">
                                
                                    <input type="hidden"  name="recurring_count" id="recurring_count" value="0" />
									<?php
                                    if(isset($business_price) && count($business_price) > 0) {
                                        foreach($business_price as $price) 
										{
                                        $pay_chk = $pay_session_type = $pay_session = $pay_price =  $pay_discountcat = $pay_discounttype = $pay_discount = $pay_estearn = $pay_setnum = $pay_setduration = $pay_after =  $fitnessity_fee  = $recurring_duration =  $recurring_every  = $recurring_price =$fitnessity_fee = $membership_type = $is_recurring  = "" ;    
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
										if(isset($price['fitnessity_fee']) && !empty($price['fitnessity_fee'])) {
                                            $fitnessity_fee = $price['fitnessity_fee'];
                                        }
										if(isset($price['is_recurring']) && !empty($price['is_recurring'])) {
                                            $is_recurring = $price['is_recurring'];
                                        }
										if(isset($price['recurring_price']) && !empty($price['recurring_price'])) {
                                            $recurring_price = $price['recurring_price'];
                                        }
										if(isset($price['recurring_every']) && !empty($price['recurring_every'])) {
                                            $recurring_every = $price['recurring_every'];
                                        }
										if(isset($price['recurring_duration']) && !empty($price['recurring_duration'])) {
                                            $recurring_duration = $price['recurring_duration'];
                                        }
										if(isset($price['membership_type']) && !empty($price['membership_type'])) {
                                            $membership_type = $price['membership_type'];
                                        }
										
                                        ?>
                                         
                                        <div class="col-md-12 service_price" style="margin-top:20px; padding-top:10px; float:left; border-top:1px dotted #000;">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                     <label for="pay_session_type">Session Type <a href="#" title="Setting sessions for single, multiple or unlimited sessions" class="tooltip-custom sp1" data-toggle="tooltip" data-placement="top">?</a></label>
                                                     <select name="pay_session_type[]" id="pay_session_type" class="pay_session_type form-control">
                                                         <option value="">Select Value</option>
                                                         <option <?=($pay_session_type=='Single')?'selected':'' ?>>Single</option>
                                                         <option <?=($pay_session_type=='Multiple')?'selected':'' ?>>Multiple</option>
                                                         <option <?=($pay_session_type=='Unlimited')?'selected':'' ?>>Unlimited</option>
                                                     </select>
                                                 </div>
                                                 <div class="form-group col-md-3">
                                                     <label for="pay_session">Numbers of Sessions</label>
                                                     <input type="text" name="pay_session[]" id="pay_session" class="pay_session form-control" value="<?=$pay_session?>">
                                                 </div>
                                                 <div class="form-group col-md-3">
                                                     <label for="pay_session">Membership Type</label>
                                                     <select name="membership_type[]" id="membership_type" class="membership_type form-control">
                                                     	<option @if($membership_type=="Day") selected="selected" @endif value="Drop In">Drop In</option>
                                                         <option @if($membership_type=="Day") selected="selected" @endif value="Semester">Semester (Long Term)</option>
                                                    </select>
                                                 </div>
                                                 <div class="form-group col-md-3">
                                                     <label for="pay_price">Retail Price ($)</label>
                                                     <input type="text" name="pay_price[]" id="pay_price" class="pay_price form-control" value="<?=$pay_price?>" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                                                 </div>
                                          	</div>
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                     <label for="is_recurring"><input class="is_recurring_cls" data-count="0" type="checkbox" name="is_recurring[]" id="is_recurring0" <?=($is_recurring=='on')?'checked':''?> value="on"> </label>
                                                       Is this a recurring payment? <br /> If so, set the terms
                                                       <button style="display:none" id="btn_recurring0" name="btn_recurring[]" type="button" data-count="0" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring0">Launch demo modal</button>
                                                      
                                                 </div>
                                                  <!--model box-->
                                                 <div class="modal fade" id="ModelRecurring0" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="ModelRecurringTitle">Set Recurring Payment Option</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                       		<div class="row">
                                                                <div class="col-md-4">
                                                                    <label for="salestax">Price $</label>
                                                                    <input type="text" name="recurring_price[]" id="recurring_price0" class="form-control rcprice" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" value="{{$recurring_price}}">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="salestax">Every</label>
                                                                    <input type="text"  name="recurring_every[]" id="recurring_every" class="form-control rcevery" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" value="{{$recurring_every}}">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="salestax">Duration</label>
                                                                    <select name="recurring_duration[]" id="recurring_duration0" class="form-control rcduration">																
                                                                    	<option value="">-Select-</option>
																		<option @if($recurring_duration=="Day") selected="selected" @endif value="Day">Day</option>
                                                                        <option @if($recurring_duration=="Week") selected="selected" @endif value="Week">Week</option>
																		<option @if($recurring_duration=="Month") selected="selected" @endif value="Month">Month</option>
																	</select>
                                                                </div>
                                                            </div>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn button-fitness">OK</button>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                
                                                <!--end for model box-->
                                                 
                                                 <div class="form-group col-md-3">
                                                     <label for="pay_estearn">Your Estimated Earnings <a href="#" title="The user will earn minus the fitnessity service fee when the user sets the price." class="tooltip-custom sp1" data-toggle="tooltip" data-placement="top">?</a></label>
                                                     <input type="text" name="pay_estearn[]" id="pay_estearn" class="pay_estearn form-control" value="<?=$pay_estearn?>">
                                                 </div>
                                                 
                                                 <div class="form-group col-md-3">
                                                 	<label for="pay_discount">Promotional Discount</label>
                                                    <input type="text" name="pay_discount[]" id="pay_discount" class="form-control" placeholder="0" value="{{$pay_discount}}">
                                                 </div>
                                                  <div class="form-group col-md-3" >
                                                    <label for="pay_discount">Fitnessity Fee</label>
                                                    <input type="text" name="fitnessity_fee[]" id="fitnessity_fee" class="form-control" placeholder="15" value="{{$fitnessity_fee}}" readonly="readonly">
                                                 </div>
                                             </div>
                                             <div class="row" style="padding:10px 0">
                                                 <div class="col-md-12">
                                                    <h4>Expiration Details</h4>
                                                 </div>
                                             </div>
                                             <div class="row">
                                                 <div class="form-group col-md-4">
                                                     <label for="pay_setnum">Set Number</label>
                                                     <input type="text" name="pay_setnum[]" id="pay_setnum" class="form-control" placeholder="(ex,1,2,3,etc.)" value="<?=$pay_setnum?>" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;" >
                                                 </div>
                                                 <div class="form-group col-md-4">
                                                     <label for="pay_setduration">Duration</label>
                                                     <select name="pay_setduration[]" id="pay_setduration" class="form-control">
                                                         <option value="">Select Value</option>
                                                         <option <?=($pay_setduration=='Days')?'selected':'' ?>>Days</option>
                                                         <option <?=($pay_setduration=='Months')?'selected':'' ?>>Months</option>
                                                         <option <?=($pay_setduration=='Year')?'selected':'' ?>>Year</option>
                                                     </select>
                                                 </div>
                                                 <div class="form-group col-md-4">
                                                     <label for="pay_after">After</label>
                                                     <select name="pay_after[]" id="pay_after" class="pay_after form-control">
                                                         <option value="">Select Value</option>
                                                         <option value="1" <?=($pay_after=='1')?'selected':'' ?>>Starts to expire the day of purchase</option>
                                                         <option value="2" <?=($pay_after=='2')?'selected':'' ?>>Starts to expire when the customer first participates in the activity</option>
                                                     </select>
                                                 </div>
                                             </div>
                                             <?php /*?><div class="row" style="padding-top:10px">
                                                 <div class="col-md-4">
                                                     <label for="pay_discountcat">Discount Category</label>
                                                     <select name="pay_discountcat[]" id="pay_discountcat" class="pay_discountcat form-control">
                                                         <option value="">Select Value</option>
                                                         <option <?=($pay_discountcat=='Free')?'selected':'' ?>>Free</option>
                                                         <option <?=($pay_discountcat=='Consultation')?'selected':'' ?>>Consultation</option>
                                                         <option <?=($pay_discountcat=='Assessment')?'selected':'' ?>>Assessment</option>
                                                         <option <?=($pay_discountcat=='Trial')?'selected':'' ?>>Trial</option>
                                                         <option <?=($pay_discountcat=='Gift')?'selected':'' ?>>Gift</option>
                                                         <option <?=($pay_discountcat=='Student')?'selected':'' ?>>Student </option>
                                                         <option <?=($pay_discountcat=='Military')?'selected':'' ?>>Military</option>
                                                         <option <?=($pay_discountcat=='Black Friday')?'selected':'' ?>>Black Friday</option>
                                                         <option <?=($pay_discountcat=='Holiday')?'selected':'' ?>>Holiday</option>
                                                         <option <?=($pay_discountcat=='Cyber Monday')?'selected':'' ?>>Cyber Monday</option>
                                                         <option <?=($pay_discountcat=='New Years')?'selected':'' ?>>New Years </option>
                                                         <option <?=($pay_discountcat=='Summer')?'selected':'' ?>>Summer</option>
                                                         <option <?=($pay_discountcat=='Winter')?'selected':'' ?>>Winter</option>
                                                         <option <?=($pay_discountcat=='Fall')?'selected':'' ?>>Fall</option>
                                                         <option <?=($pay_discountcat=='Spring')?'selected':'' ?>>Spring</option>
                                                         <option <?=($pay_discountcat=='Online')?'selected':'' ?>>Online</option>
                                                     </select>
                                                 </div>
                                                 <div class="col-md-4">
                                                     <label for="pay_discounttype">Discount Type</label>
                                                     <select name="pay_discounttype[]" class="form-control" id="pay_discounttype">
                                                         <option value="$ Dollar">$ Dollar</option>
                                                         <option value="% Percentage">% Percentage</option>
                                                     </select>
                                                 </div>
                                                 <div class="col-md-4">
                                                     <label for="pay_discount">Discount</label>
                                                     <input type="text" name="pay_discount[]" id="pay_discount" class="form-control" placeholder="10"  value="<?=$pay_discount?>">
                                                 </div>
                                             </div><?php */?>
                                        </div>
                                        <?php
                                        }
                                    } else {
                                    ?>
                                        <div class="col-md-12 service_price" style="margin-top:20px; padding-top:10px; float:left; border-top:1px dotted #000;">
                                            <div class="row">
                                                <div class="form-group col-md-3">
                                                    <label for="pay_session_type">Session Type <a href="#" title="Setting sessions for single, multiple or unlimited sessions" class="tooltip-custom sp1" data-toggle="tooltip" data-placement="top">?</a></label>
                                                    <select name="pay_session_type[]" id="pay_session_type" class="pay_session_type form-control" required>
                                                        <option value="">Select Value</option>
                                                        <option>Single</option>
                                                        <option>Multiple</option>
                                                        <option>Unlimited</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="pay_session">Numbers of Sessions</label>
                                                    <input type="text" name="pay_session[]" id="pay_session" class="pay_session form-control" required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                     <label for="pay_session">Membership Type</label>
                                                     <select name="membership_type[]" id="membership_type" class="membership_type form-control">
                                                     	<option value="Drop In">Drop In</option>
                                                         <option value="Semester">Semester (Long Term)</option>
                                                    </select>
                                                 </div>
                                                <div class="form-group col-md-3">
                                                    <label for="pay_price">Retail Price ($)</label>
                                                    <input type="text" name="pay_price[]" id="pay_price" class="pay_price form-control" required onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                                                </div>
                                          </div>
                                          <div class="row">
                                                <div class="form-group col-md-3">
                                                	
                                                     <label for="is_recurring"><input class="is_recurring_cls" data-count="0" type="checkbox" name="is_recurring[]" id="is_recurring0"> </label>
                                                       Is this a recurring payment? <br /> If so, set the terms
                                                       <button data-count="0" style="display:none" id="btn_recurring0" name="btn_recurring[]" type="button" class="btn btn-primary recurrint_id" data-toggle="modal" data-target="#ModelRecurring0">Launch demo modal</button>
                                                 </div>
                                                 <div class="form-group col-md-3">
                                                 	<label for="pay_discount">Promotional Discount</label>
                                                    <input type="text" name="pay_discount[]" id="pay_discount" class="form-control" placeholder="0">
                                                 </div>
                                                  <div class="form-group col-md-3" >
                                                    <label for="pay_discount">Fitnessity Fee</label>
                                                    <input type="text" name="fitnessity_fee[]" id="fitnessity_fee" class="form-control" placeholder="15" value="15"  readonly="readonly">
                                                 </div>
                                                 
                                                <div class="form-group col-md-3">
                                                    <label for="pay_estearn">Your Estimated Earnings <a href="#" title="Your estimated earnings after Fitnessity takes a service fee of 10%. " class="tooltip-custom sp1" data-toggle="tooltip" data-placement="top">?</a></label>
                                                    <input type="text" name="pay_estearn[]" id="pay_estearn" class="pay_estearn form-control">
                                                </div>
                                            </div>
                                            <!--model box-->
                                                 <div class="modal fade model_cls" id="ModelRecurring0" name="ModelRecurring[]" tabindex="-1" role="dialog" aria-labelledby="ModelRecurringTitle" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="ModelRecurringTitle">Modal title</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="row">
                                                                <div class="col-md-4">
                                                                    <label for="recurring_price0">Price $</label>
                                                                    <input type="text" value="" name="recurring_price[]" id="recurring_price0" class="form-control rcprice" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="recurring_every0">Every</label>
                                                                    <input type="text" value="" name="recurring_every[]" id="recurring_every0" class="form-control rcevery" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="recurring_duration0">Duration</label>
                                                                    <select name="recurring_duration[]" id="recurring_duration0" class="form-control rcduration">																
                                                                    	<option value="">-Select-</option>
																		<option value="Day">Day</option>
                                                                        <option value="Week">Week</option>
																		<option value="Month">Month</option>
																	</select>
                                                                </div>
                                                            </div>
                                                      <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn button-fitness">OK</button>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                               
                                             <div class="row" style="padding:10px 0">
                                                 <div class="col-md-12">
                                                    <h4>Expiration Details</h4>
                                                 </div>
                                             </div>
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                    <label for="pay_setnum">Set Number</label>
                                                    <input type="text" name="pay_setnum[]" id="pay_setnum" class="form-control" placeholder="(ex,1,2,3,etc.)" required>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="pay_setduration">Duration</label>
                                                    <select name="pay_setduration[]" id="pay_setduration" class="form-control" required>
                                                        <option value="">Select Value</option>
                                                        <option>Days</option>
                                                        <option>Months</option>
                                                        <option>Year</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="pay_after">After</label>
                                                    <select name="pay_after[]" id="pay_after" class="pay_after form-control" required>
                                                        <option value="">Select Value</option>
                                                        <option value="1">Starts to expire the day of purchase</option>
                                                        <option value="2">Starts to expire when the customer first participates in the activity</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php /*?><div class="row" style="padding-top:10px">
                                                <div class="col-md-4">
                                                    <label for="pay_discountcat">Discount Category</label>
                                                    <select name="pay_discountcat[]" id="pay_discountcat" class="pay_discountcat form-control">
                                                        <option value="">Select Value</option>
                                                        <option>Free</option>
                                                        <option>Consultation</option>
                                                        <option>Assessment</option>
                                                        <option>Trial</option>
                                                        <option>Gift</option>
                                                        <option>Student </option>
                                                        <option>Military</option>
                                                        <option>Black Friday</option>
                                                        <option>Holiday</option>
                                                        <option>Cyber Monday</option>
                                                        <option>New Years </option>
                                                        <option>Summer</option>
                                                        <option>Winter</option>
                                                        <option>Fall</option>
                                                        <option>Spring</option>
                                                        <option>Online</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="pay_discounttype">Discount Type</label>
                                                    <select name="pay_discounttype[]" class="form-control" id="pay_discounttype">
                                                        <option value="$ Dollar">$ Dollar</option>
                                                        <option value="% Percentage">% Percentage</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="pay_discount">Discount</label>
                                                    <input type="text" name="pay_discount[]" id="pay_discount" class="form-control" placeholder="10">
                                                </div>
                                            </div><?php */?>
                                        </div>

                                    <?php } ?>
                                </div>
                                
                                <div class="col-md-12" style="margin-top: 20px;">
                                    <a class="button-fitness add-another-session">+ Add Another Price Option</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <br/>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn-bck" id="backindividual5"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn-nxt" id="nextindividual5">Save & Continue <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            <br>
                        </div>
                    </section>
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
                        <span class="classesTxt nav-link1 subtab1" style="{{ ($service_type=='classes')?'color:red':'' }}">GYM/STUDIO</span>
                        <span class="experienceTxt nav-link1 subtab2" style="{{ ($service_type=='experience')?'color:red':'' }}">EXPERIENCE</span>
                    </div>
                    <section class="row">
                        <div class="col-md-4">
                            <br/><br/><br/>
                            <select name="frm_servicesport1" id="frm_servicesport1" class="form-control">
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

                <div class="container-fluid p-0" id="experiencesDiv2" style="display: none;">
                    <div class="tab-hed">Create Services & Prices</div>
                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">
                        <span class="individualTxt nav-link1 subtab" style="{{ ($service_type=='individual')?'color:red':'' }}">PERSONAL TRAINER</span>
                        <span class="classesTxt nav-link1 subtab1" style="{{ ($service_type=='classes')?'color:red':'' }}">GYM/STUDIO</span>
                        <span class="experienceTxt nav-link1 subtab2" style="{{ ($service_type=='experience')?'color:red':'' }}">EXPERIENCE</span>
                    </div>
                    <section class="row">
                        <div class="col-md-12">
                            <br/>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="frm_programname1">Setup the programs for your <span id="lbl_activity1">kickboxing</span> service<br>
                                                Let's get a few details about the program <span id="star">*</span></label>
                                                <input type="text" class="form-control" name="frm_programname1" id="frm_programname1" placeholder="Enter Name of Program" title="servicetitle" value="{{ $program_name }}">
                                                <span class="error" id="err_frm_programname1"></span>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <textarea class="form-control" rows="6" name="frm_programdesc1" id="frm_programdesc1" placeholder="Enter program description" maxlength="150">{{ $program_desc }}</textarea>
                                            <div class="text-right"><span id="frm_programdesc1_left">150</span> Characters Left</div>
                                            <span class="error" id="err_frm_programdesc1"></span>
                                        </div>
                                        <div class="form-group col-md-12 hide">
                                            <label class="switch" for="booking_1">
                                                <input type="radio" name="booking1" id="booking_1" value="instant" {{ ($instant_booking==1) ? "Checked" : "" }}>
                                                <span class="slider round"></span>
                                            </label>
                                            <span class="error" id="err_booking_1"></span>
                                            <span>INSTANT BOOKING : Allow customers to book you instantly</span>
                                        </div>
                                        <div class="form-group col-md-12" style="display:none">
                                            <label class="switch" for="booking_2">
                                                <input type="radio" name="booking1" id="booking_2" value="reserve" {{ ($reserved_booking==1) ? "Checked" : "" }}>
                                                <span class="slider round"></span>
                                            </label>
                                            <span>RESERVED BOOKING : You need to confirm each booking first before completion</span>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>How much notice do you need for each booking ?</label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="notice_value1" id="notice_value1" rel="notice_key1">
                                                <option value="">Select Value</option>
                                                <option value="Days" {{ ($notice_value=='Days') ? "selected" : "" }}>Days</option>
                                                <option value="Weeks" {{ ($notice_value=='Weeks') ? "selected" : "" }}>Weeks</option>
                                                <option value="Months" {{ ($notice_value=='Months') ? "selected" : "" }}>Months</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="notice_key1" id="notice_key1">
                                                <? if($notice_key == "") { ?>
                                                <option value="">Select Value</option>
                                                <? } ?>
                                                <?php for($i=1; $i<=31; $i++) { ?>
                                                <option value="<?=$i?>" <?= ($notice_key==$i) ? "selected" : "" ?>><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <script>
                                            $('#notice_value1').change(function() {
                                                var t = $('#notice_value1 option:selected').val();
                                                var id = $('#notice_value1').attr('rel');
                                                console.log(t, "---", id)
                                                if (t == 'Days') {
                                                    options_f(31, id);
                                                }
                                                if (t == 'Weeks') {
                                                    options_f(52, id);
                                                }
                                                if (t == 'Months') {
                                                    options_f(12, id);
                                                }
                                            });
                                        </script>
                                        <div class="form-group col-md-12">
                                            <label>How far in advance can a customer book ?</label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <?php $addv = []; ?>
                                            <select class="form-control" name="advance_value1" id="advance_value1" rel="advance_key1" onchange="seconddayweek_change_event(this.value)">
                                                <option value="">Select Value</option>
                                                <option value="Days" {{ ($advance_value=='Days') ? "selected" : "" }}>Days</option>
                                                <option value="Weeks" {{ ($advance_value=='Weeks') ? "selected" : "" }}>Weeks</option>
                                                <option value="Months" {{ ($advance_value=='Months') ? "selected" : "" }}>Months</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="advance_key1" id="advance_key1">
                                                <? if($advance_key == "") { ?>
                                                <option value="">Select Value</option>
                                                <? } ?>
                                                <?php for($i=1; $i<=31; $i++) { ?>
                                                <option value="<?=$i?>" <?= ($advance_key==$i) ? "selected" : "" ?>><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <script>
                                            $('#advance_value1').change(function() {
                                                var t = $('#advance_value1 option:selected').val();
                                                var id = $('#advance_value1').attr('rel');
                                                console.log(t, "---", id)
                                                if (t == 'Days') {
                                                    options_f(31, id);
                                                }
                                                if (t == 'Weeks') {
                                                    options_f(52, id);
                                                }
                                                if (t == 'Months') {
                                                    options_f(12, id);
                                                }
                                            });
                                        </script>
                                        <div class="form-group col-md-12">
                                            <label>What's the latest moment a person can book your activity?</label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="activity_value1" id="activity_value1" rel="activity_key1">
                                                <option value="">Select Value</option>
                                                <option value="Minute" {{ ($activity_value=='Minute') ? "selected" : "" }}>Minute</option>
                                                <option value="Hours" {{ ($activity_value=='Hours') ? "selected" : "" }}>Hours</option>
                                                <option value="Days" {{ ($activity_value=='Days') ? "selected" : "" }}>Days</option>
                                                <option value="Weeks" {{ ($activity_value=='Weeks') ? "selected" : "" }}>Weeks</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="activity_key1" id="activity_key1">
                                                <? if($activity_key == "") { ?>
                                                <option value="">Select Value</option>
                                                <? } ?>
                                                <?php for($i=1; $i<=31; $i++) { ?>
                                                <option value="<?=$i?>" <?= ($activity_key==$i) ? "selected" : "" ?>><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <script>
                                            $('#activity_value1').change(function() {
                                                var t = $('#activity_value1 option:selected').val();
                                                var id = $('#activity_value1').attr('rel');
                                                console.log(t, "---", id)
                                                if (t == 'Minute') {
                                                    options_f(60, id);
                                                }
                                                if (t == 'Hours') {
                                                    options_f(24, id);
                                                }
                                                if (t == 'Days') {
                                                    options_f(31, id);
                                                }
                                                if (t == 'Weeks') {
                                                    options_f(52, id);
                                                }
                                            });
                                        </script>
                                        <div class="form-group col-md-12">
                                            <label>What's the latest a customer can cancel?</label>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="cancel_value1" id="cancel_value1" rel="cancel_key1">
                                                <option value="">Select Value</option>
                                                <option value="Hours" {{ ($cancel_value=='Hours') ? "selected" : "" }}>Hours</option>
                                                <option value="Days" {{ ($cancel_value=='Days') ? "selected" : "" }}>Days</option>
                                                <option value="Weeks" {{ ($cancel_value=='Weeks') ? "selected" : "" }}>Weeks</option>
                                                <option value="Months" {{ ($cancel_value=='Months') ? "selected" : "" }}>Months</option>             
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <select class="form-control" name="cancel_key1" id="cancel_key1">
                                                <? if($cancel_key == "") { ?>
                                                <option value="">Select Value</option>
                                                <? } ?>
                                                <?php for($i=1; $i<=31; $i++) { ?>
                                                <option value="<?=$i?>" <?= ($cancel_key==$i) ? "selected" : "" ?>><?=$i?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <script>
                                            $('#cancel_value1').change(function() {
                                                var t = $('#cancel_value1 option:selected').val();
                                                var id = $('#cancel_value1').attr('rel');
                                                console.log(t, "---", id)
                                                if (t == 'Hours') {
                                                    options_f(24, id);
                                                }
                                                if (t == 'Days') {
                                                    options_f(31, id);
                                                }
                                                if (t == 'Weeks') {
                                                    options_f(52, id);
                                                }
                                                if (t == 'Months') {
                                                    options_f(12, id);
                                                }
                                            });
                                        </script>
                                    </div>
                                </div>
                                <div class="col-md-4 text-center">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-8 imgUp">
                                            <div class="imagePreview divImgPreview">
                                                @if(!empty($profile_pic) && File::exists(public_path("/uploads/profile_pic/thumb/".$profile_pic)))
                                                <img src="{{ url('/public/uploads/profile_pic/thumb/'.$profile_pic) }}" class="imagePreview blah" id="showimg">
                                                @else
                                                <img src="{{ url('/public/images/default-avatar.png') }}" class="imagePreview blah" id="showimg">
                                                @endif
                                            </div>
                                            <label class="img-tab-btn">Upload Image<input type="file" name="servicepic1" id="servicepic1" onchange="readServicePic1(this);" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;"></label>
                                            <span class="error" id="err_oldservicepic1"></span>
                                            <input type="hidden" name="oldservicepic1" id="oldservicepic1" value="{{ $profile_pic }}" >
                                            <label style="font-size: 12px;">Upload an image that best represents your program</label>
                                        </div><!-- col-2 -->
                                    </div><!-- row -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn-bck" id="backexperiences2"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="button" class="btn-nxt" id="nextexperiences2">Continue <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            <br>
                        </div>
                    </section>
                </div>

                <div class="container-fluid p-0" id="experiencesDiv3" style="display: none;">
                    <div class="tab-hed">Create Services & Prices</div>
                    <div style="background: black;width: 107%;margin-left: -38px;padding: 6px;">
                        <span class="individualTxt nav-link1 subtab" style="{{ ($service_type=='individual')?'color:red':'' }}">PERSONAL TRAINER</span>
                        <span class="classesTxt nav-link1 subtab1" style="{{ ($service_type=='classes')?'color:red':'' }}">GYM/STUDIO</span>
                        <span class="experienceTxt nav-link1 subtab2" style="{{ ($service_type=='experience')?'color:red':'' }}">EXPERIENCE</span>
                    </div>
                    <section class="row">
                        <br>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <h3 style="font-size: 17px;font-weight: bold;">Describe the location</h3>
                                            <div class="form-group">
                                                <label>Tell customers how to meet up, where to meet up, meeting point name and how to find you once the customers arrive.</label><br>
                                                <textarea class="form-control" rows="6" name="frm_servicedesc" id="frm_servicedesc" placeholder="Don't leave it up to customers to figure out how to meet up with you. Let them know before hand. (Ex. We will pick you up at your hotel. Talk with your front desk staff or we will meet at Central Park at the entrance of 81st and Central Park West, (CPW). Wait at the seating area if you arrive early. The nstructor will have on a red hat and yellow vest. Please arrive 10 minutes before tour starts.)">{{ $frm_servicedesc }}</textarea>
                                            </div>
                                            <h3 style="font-size: 17px;font-weight: bold;">Where should customers meet you?</h3>
                                            <div class="form-group">
                                                <label for="email">if the meet up spot is different from the address you set earlier in Company Details, then you can set in here.</label>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="exp_country">Country / Region</label>
                                                    <input type="text" name="exp_country" id="exp_country" value="{{ $exp_country }}" class="form-control">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="">Street address</label>
                                                    <input type="text" name="exp_address" id="exp_address" value="{{ $exp_address }}" class="form-control">
                                                </div>
                                                <div class="form-group col-md-3" style="align-self: flex-end;">
                                                    <label for="exp_building">Apt, Suit, Bldg. <span style="font-size: 10px">(optional)</span></label>
                                                    <input type="text" name="exp_building" id="exp_building" value="{{ $exp_building }}" class="form-control">
                                                </div>
                                                <div class="form-group col-md-3" style="align-self: flex-end;">
                                                    <label for="exp_city">City</label>
                                                    <input type="text" name="exp_city" id="exp_city" value="{{ $exp_city }}" class="form-control">
                                                </div>
                                                <div class="form-group col-md-3" style="align-self: flex-end;">
                                                    <label for="exp_state">State</label>
                                                    <input type="text" name="exp_state" id="exp_state" value="{{ $exp_state }}" class="form-control">
                                                </div>
                                                <div class="form-group col-md-3" style="align-self: flex-end;">
                                                    <label for="exp_zip">ZIP Code</label>
                                                    <input type="text" name="exp_zip" id="exp_zip" value="{{ $exp_zip }}" class="form-control">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <a href="javascript:void(0)" class="updat-map-btn" onclick="loadEmbedMap()">Update Map</a>
                                                </div>
                                                <h3 class="col-md-12" style="font-size: 17px;font-weight: bold;">Adjust the pin on the map</h3>
                                                <div class="form-group col-md-12">
                                                    <label for="">You can drag the map so the pin is in the right location.</label>
                                                </div>
                                                <div class="col-md-12 maploaction-block">
                                                    <iframe id="gmap_iframe" src="https://maps.google.com/maps?width=400&amp;height=300&amp;hl=en&amp;q={{ ($ZipCode!="") ? $ZipCode."&amp;".$Country : 'New York' }}&amp;t=&amp;z=10&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                                </div>
                                                <h3 class="col-md-12" style="font-size: 17px;font-weight: bold;">Confirm your phone number</h3>
                                                <div class="form-group col-md-12">
                                                    <label for="">If customers have trouble finding your locatoin, they may need to call you. The number we'll give them is +1 (555) 555-5555. This was set during the company details section. You can update this number</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <br>
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label>Select Service Type</label>
                                            <select name="frm_lservice[]" id="l_service" multiple>
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
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#l_service'
                                                });
                                            </script>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Location of Activity</label>
                                            <select name="frm_lactivity[]" id="l_activity" multiple>
                                                <option value="Online">Online</option>
                                                <option value="At Business">At Business</option>
                                                <option value="On Location">On Location</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#l_activity'
                                                });
                                            </script>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Activity Great For</label>
                                            <select name="frm_lgreat[]" id="l_greatfor" multiple>
                                                <option value="Individual">Individual</option>
                                                <option value="Kids">Kids</option>
                                                <option value="Teens">Teens</option>
                                                <option value="Adults">Adults</option>
                                                <option value="Family">Family</option>
                                                <option value="Groups">Groups</option>
                                                <option value="Any">Any</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#l_greatfor'
                                                });
                                            </script>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Age Range</label>
                                            <select name="frm_lagerange[]" id="l_agerange" multiple>
                                                <option value="Baby (0 to 12 months)">Baby (0 to 12 months)</option>
                                                <option value="Toddler (1 to 3 yrs.)">Toddler (1 to 3 yrs.)</option>
                                                <option value="Preschool (4 to 5 yrs.)">Preschool (4 to 5 yrs.)</option>
                                                <option value="Grade School (6 to 12 yrs.)">Grade School (6 to 12 yrs.)</option>
                                                <option value="Teen (13 to 17 yrs.)">Teen (13 to 17 yrs.)</option>
                                                <option value="Young Adult (18 to 21 yrs.)">Young Adult (18 to 21 yrs.)</option>
                                                <option value="Older Adult (21 to 39 yrs.)">Older Adult (21 to 39 yrs.)</option>
                                                <option value="Middle Age (40 to 59 yrs.)">Middle Age (40 to 59 yrs.)</option>
                                                <option value="Senior Adult (60 +)">Senior Adult (60 +)</option>
                                                <option>Any</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#l_agerange'
                                                });
                                            </script>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Difficulty Level</label>
                                            <select name="frm_ldifficulty[]" id="l_difficulty" multiple>
                                                <option value="Beginner">Beginner</option>
                                                <option value="Intermediate">Intermediate</option>
                                                <option value="Advanced">Advanced</option>
                                                <option value="Professional">Professional</option>
                                                <option value="Expert">Expert</option>
                                                <option value="Any">Any</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#l_difficulty'
                                                });
                                            </script>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>What experience will the customers have</label>
                                            <select name="frm_lcustomers[]" id="l_customershave" multiple>
                                                <option value="teaching_a_desired_skill"> Teaching a desired skill</option>
                                                <option value="accomplish_a_goal_or_skill"> Accomplish a goal or skill</option>
                                                <option value="cardio"> Cardio</option>
                                                <option value="weight_loss"> Weight loss</option>
                                                <option value="technique"> Technique</option>
                                                <option value="strength_and_conditioning"> Strength and conditioning</option>
                                                <option value="athletic_conditioning"> Athletic conditioning</option>
                                                <option value="body_building"> Body building</option>
                                                <option value="total_body_workout"> Total body workout</option>
                                                <option value="get_toned"> Get toned</option>
                                                <option value="with_equipment"> With equipment</option>
                                                <option value="fun_experience"> Fun experience</option>
                                                <option value="thrilling_experience"> Thrilling experience</option>
                                                <option value="challenging_experience"> Challenging experience</option>
                                                <option value="gross_motor_skills"> Gross motor skills</option>
                                                <option value="hand_eye_coordination"> Hand eye coordination</option>
                                                <option value="discipline"> Discipline</option>
                                                <option value="focus"> Focus</option>
                                                <option value="self-defense"> Self-Defense</option>
                                                <option value="confidence"> Confidence</option>
                                                <option value="mental_challenge"> Mental Challenge</option>
                                            </select>
                                            <script>
                                                var p = new SlimSelect({
                                                    select: '#l_customershave'
                                                });
                                            </script>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label>Personality & Habits of Instructor</label>
                                            <select name="frm_lproviders[]" id="l_providers" multiple>
                                                <option value="An educator &amp; teacher">An Educator</option>
                                                <option value="A lot of energy">A Teacher</option>
                                                <option value="A drill sergeant">A lot of energy</option>
                                                <option value="Inspiring">A drill sergeant</option>
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
                                                    select: '#l_providers'
                                                });
                                            </script>
                                        </div>
                                    </div><!-- row -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn-bck" id="backexperiences3"><i class="fa fa-arrow-left"></i> Back</button>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button type="submit" class="btn-nxt" id="nextexperiences3">Save & Continue <i class="fa fa-arrow-right"></i></button>
                                </div>
                            </div>
                            <br>
                        </div>
                    </section>
                </div>
            </form>
            
            <form id="bookingInfo" name="bookingInfo" method="post" action="{{route('addbusinessbooking')}}">
                <?php
                
                ?>
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
	
	$('#service_type').val('individual');
	$(".subtab").css("color", "red");
	$(".subtab1").css("color", "white");
	$(".subtab2").css("color", "white");
	var curr_tab=$('#current_tab_name').val();
	$("#"+curr_tab).hide();
	$("#individualDiv0").show();
	$('#current_tab_name').val('individualDiv0');
	
	
});
$('body').delegate('.subtab1','click',function(){
	$(".individualBody").hide();
	$(".classesBody").show();
	$(".experienceBody").hide();
	
	$('#service_type').val('classes');
	$(".subtab").css("color", "white");
	$(".subtab1").css("color", "red");
	$(".subtab2").css("color", "white");
	var curr_tab=$('#current_tab_name').val();
	$("#"+curr_tab).hide();
	$("#individualDiv0").show();
	$('#current_tab_name').val('individualDiv0');
	
});
$('body').delegate('.subtab2','click',function(){
	
	$(".individualBody").hide();
	$(".classesBody").hide();
	$(".experienceBody").show();
	
	$('#service_type').val('experience');
	$(".subtab").css("color", "white");
	$(".subtab1").css("color", "white");
	$(".subtab2").css("color", "red");
	var curr_tab=$('#current_tab_name').val();
	$("#"+curr_tab).hide();
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" type="text/css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<style>.manual-remove{width:100%}</style>

<!-- Updated JavaScript url -->
<script src="//jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ Config::get('constants.MAP_KEY') }}" async defer ></script>

<script src="https://dev.fvnew.com/plugins/markerclusterer/oms.min.js"></script>
<script src="https://dev.fvnew.com/plugins/markerclusterer/markerclusterer.js"></script>
<script src="https://dev.fvnew.com/plugins/markerclusterer/markerclustererplus.min.js"></script>

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
    
	/*$(".uploadFile").bind("change", function() {  alert('bbb');
		if ($(this).files && $(this).files[0]) 
		{ 
		 	alert('aaaa');
			 var reader = new FileReader();
			 reader.onload = function(e) {
			 alert(e.target.result);
			  $(this).closest('.blah2').attr('src', e.target.result);
			 // $(this).parents('.blah2').attr('src', e.target.result);
			   var html = '<img src="' + e.target.result + '">';
			 });
		}
	});*/
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
				///input.closest('.divImgPreview').html('<img src="'+e.target.result+'">');
				$("#oldservicepic2").val(e.target.result);
                var html = '<img src="' + e.target.result + '">';
                $('.uploadedpic2').html(html);
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
//$(".is_recurring_cls").click(function(event){
$('body').delegate('.is_recurring_cls','click',function(){
	if($(this).prop("checked"))
	{
		var iid=$(this).attr("data-count");
		$('#btn_recurring'+iid).trigger("click");
	}
});
												</script>
<script type="text/javascript">
        function IsNumeric(evt) {
           var getNumCd = (evt.which) ? evt.which : event.keyCode;
		  if (getNumCd != 46 && getNumCd > 31 
			&& (getNumCd < 48 || getNumCd > 57))
			 return false;
		  return true;
        }
    </script>

<script type="text/javascript">



$("body").on("click", ".pay_session_type", function(){
    if($(this).val()=='Single') {
        $(".pay_session").val(1);
		$('.pay_session').attr('readonly', true);
    }
    if($(this).val()=='Multiple') {
        $(".pay_session").val(10);
		$('.pay_session').attr('readonly', false);
    }
    if($(this).val()=='Unlimited') {
        $(".pay_session").val(10000);
		$('.pay_session').attr('readonly', true);
    }
});

$("body").on("blur", ".pay_price", function(){
    $(".pay_estearn").val($(this).val() - 19.95);
});

$("body").on("click", ".add-another-day-schedule", function(){
	var service_price = "";
	service_price += '<div class="row add_another_day" style="margin-top:20px; padding-top:10px;border-top:1px dotted #000;">';
	service_price += '<div class="col-md-11"></div><div class="col-md-1"><i class="remove-day-schedule fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove Day"></i></div>';
	service_price += $(".add_another_day").html();
	service_price += '</div>';
	$(".add-another-day-schedule-block").append(service_price);
});


$("body").on("click", ".remove-day-schedule", function(){
	$(this).parent().parent().remove();
});
	
	
$("body").on("click", ".add-another-session", function(){
	
	var cnt=$('#recurring_count').val();
	cnt++;
	$('#recurring_count').val(cnt);
	
	
    var service_price = "";
    service_price += '<div class="col-md-12 service_price serpridiv'+cnt+'" style="margin-top:20px; padding-top:10px; float:left; border-top:1px dotted #000;">';
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



function removeValue(list, value) {
  return list.replace(new RegExp(",?" + value + ",?"), function(match) {
      var first_comma = match.charAt(0) === ',',
          second_comma;

      if (first_comma &&
          (second_comma = match.charAt(match.length - 1) === ',')) {
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
    
    $('#quick_business_left').text(150-parseInt($("#about_company").val().length));
    $('#company_desc_left').text(500-parseInt($("#short_description").val().length));
    $('#frm_skilldetail_left').text(150-parseInt($("#frm_skilldetail").val().length));
    $('#frm_programdesc_left').text(150-parseInt($("#frm_programdesc").val().length));
    $('#frm_programdesc1_left').text(150-parseInt($("#frm_programdesc1").val().length));
    $('#house_rules_left').text(500-parseInt($("#house_rules").val().length));
    $('#cancelation_policy_left').text(500-parseInt($("#cancelation_policy").val().length));
    $('#safety_cleaning_left').text(500-parseInt($("#safety_cleaning").val().length));
    $('#termcondfaqtext_left').text(1000-parseInt($("#termcondfaqtext").val().length));
    $('#contracttermstext_left').text(1000-parseInt($("#contracttermstext").val().length));
    $('#liabilitytext_left').text(1000-parseInt($("#liabilitytext").val().length));
    $('#covidtext_left').text(1000-parseInt($("#covidtext").val().length));
	$('#frm_what_you_doing').text(500-parseInt($("#what_you_doing").val().length)); 
    
    $("#about_company").on('input', function() {
        //$('#display_count').text(this.value.length);
        $('#quick_business_left').text(150-parseInt(this.value.length));
    });
    $("#short_description").on('input', function() {
        //$('#display_count_business').text(this.value.length);
        $('#company_desc_left').text(500-parseInt(this.value.length));
    });
    $("#frm_skilldetail").on('input', function() {
        $('#frm_skilldetail_left').text(150-parseInt(this.value.length));
    });
    $("#frm_programdesc").on('input', function() {
        $('#frm_programdesc_left').text(150-parseInt(this.value.length));
    });
	$("#what_you_doing").on('input', function() {
        $('#frm_what_you_doing').text(500-parseInt(this.value.length));
    });
    $("#frm_programdesc1").on('input', function() {
        $('#frm_programdesc1_left').text(150-parseInt(this.value.length));
    });
    $("#house_rules").on('input', function() {
        $('#house_rules_left').text(500-parseInt(this.value.length));
    });
    $("#cancelation_policy").on('input', function() {
        $('#cancelation_policy_left').text(500-parseInt(this.value.length));
    });
    $("#safety_cleaning").on('input', function() {
        $('#safety_cleaning_left').text(500-parseInt(this.value.length));
    });
    $("#termcondfaqtext").on('input', function() {
        $('#termcondfaqtext_left').text(1000-parseInt(this.value.length));
    });
    $("#contracttermstext").on('input', function() {
        $('#contracttermstext_left').text(1000-parseInt(this.value.length));
    });
    $("#liabilitytext").on('input', function() {
        $('#liabilitytext_left').text(1000-parseInt(this.value.length));
    });
    $("#covidtext").on('input', function() {
        $('#covidtext_left').text(1000-parseInt(this.value.length));
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
        //console.log('map canvas = ', miles, zoom);
        $('#map_canvas').empty();

        var geocoder = new google.maps.Geocoder();
        var address = $("#wanttowork").val();
        
        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == "OK") {
                //var lat = results[0].geometry.bounds.Bb.h;
                //var long = results[0].geometry.bounds.Ra.h;
			
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
        
    });

    var date = new Date();
    date.setDate(date.getDate()-1);
    /*       
    $(".daycircle").hide();
    $(".remove-week").hide();
    var activityMeet = '<?= $activity_meets ?>';
    console.log('activityMeet', activityMeet);
    var starting = '<?= $starting ?>';
    console.log('starting', starting);
    var day = moment(starting, 'MM-DD-YYYY').format('dddd');
    console.log('day', day);
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
    //$(".timezone-round").removeClass('day_circle_fill');
    //$(".daycircle ."+day).addClass('day_circle_fill');
    $("#activity_scheduler_body").append($("#day-circle").html());
    $("#activity_scheduler_body .daycircle").show();
    */
    
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
        
        //console.log(timeStart + '-' + timeEnd + '=' + duration);
        
        $(this).parent().parent().find('.set_duration').val(duration);
    });

    $("body").on("click", ".daycircle", function(){
        if($("#frm_class_meets").val() == 'Weekly')
		{
            activity_days = "";
            $.each( $(this).find('.weekdays').children(".day_circle_fill"), function( key, value ) {
                activity_days += value.classList[3] + ",";
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
    
    $("body").on("click", ".remove-activity", function(){ alert('aaa');
        //$(this).parent().parent().parent().remove();
		//$(this).parent().parent('.daycircle').remove();
		 $(this).closest(".daycircle").remove();
    });
    
    $(".add-another-time").on("click", function(){
        //$(".timezone-round").removeClass('day_circle_fill');
        var add_time = "";
        add_time += '<div class="daycircle">';
		add_time += $(".daycircle").html();
        
       
        add_time += '</div>';
		//add_time += '<div class="row"><div class="col-md-11"></div><div class="col-md-1"><i class="remove-activity fa fa-trash-o" style="color:red; font-weight:bold; cursor:pointer; float:right" title="Remove activity"></i></div></div>';
        //console.log(add_time.replace("shift_start[]", "shift_start1[]"));
        $("#activity_scheduler_body").append(add_time);
        $("#activity_scheduler_body .daycircle").show();
        $(".remove-week").show();
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
    
    function activitySchedule(event) { //alert('aaaaa'+$('#startingpicker').val());
        var d = new Date($('#startingpicker').val());
		var weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
		//alert(weekday[d.getDay()]); 
		
		$(".daycircle").hide();
        $(".remove-week").hide();
        //var day = moment($(this).val(), 'MM-DD-YYYY').format('dddd');
		var day = weekday[d.getDay()];
		//alert(day);
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
        $(".daycircle ."+day).addClass('day_circle_fill');
        $("#activity_scheduler_body").append($("#day-circle").html());
        $("#activity_scheduler_body .daycircle").show();
        $(this).datepicker('hide');
        
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
        console.log(dates);
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
    
    $('input[name="hours_opt"]').click(function(){
        if($(this).val() == 'Temporalily closed' || $(this).val() == 'Permanently closed') {
            $("#selected_date_off").hide();
        } else {
            $("#selected_date_off").show();
        }
    });
    
    
    
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
    $("#contractterms").click(function(){
        if($("#contractterms").is(':checked')) {
            $("#contracttermsdiv").show();
        } else {
            $("#contracttermsdiv").hide();
        }    
    });    
    $("#liability").click(function(){
        if($("#liability").is(':checked')) {
            $("#liabilitydiv").show();
        } else {
            $("#liabilitydiv").hide();
        } 
        });    
    $("#covid").click(function(){
        if($("#covid").is(':checked')) {
            $("#coviddiv").show();
        } else {
            $("#coviddiv").hide();
        }    
    });    
    
    /* Business Terms - On page load hidden content show/hide */
    if($("#termcondfaq").is(':checked')) {$("#termcondfaqdiv").show();}
    if($("#contractterms").is(':checked')) {$("#contracttermsdiv").show();}
    if($("#liability").is(':checked')) {$("#liabilitydiv").show();}
    if($("#covid").is(':checked')) {$("#coviddiv").show();}
    
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
    //alert(data);
    if(data == '1' || data == '0'){
        $("#tab1").addClass("tab-active");
        $("#frmWelcomediv").show();
    }
    if(data == '2'){
        $("#tab2").addClass("tab-active");
        $("#companyDetaildiv").show();
    }
    if(data == '3'){
        $("#tab3").addClass("tab-active");
        $("#empHistorydiv").show();
    }
    if(data == '4'){
        $("#tab4").addClass("tab-active");
        $("#serviceSpecificsdiv").show();
    }
    if(data == '5'){
        $("#tab5").addClass("tab-active");
        $("#termSetdiv").show();
    }
    if(data == '6'){
        $("#tab6").addClass("tab-active");
       $("#frmVerifieddiv0").show();
	  // $("#creServicediv").show();
    }
    if(data == '7'){
        $("#tab7").addClass("tab-active");
        $("#creServicediv").show();
    }
    if(data == '71'){
        $("#tab7").addClass("tab-active");
        $("#creServicediv").show();
    }
    if(data == '72'){
        $("#tab7").addClass("tab-active");
        ///$("#individualDiv1").show(); ///nnn
		$("#individualDiv2").show();
		$('#current_tab_name').val('individualDiv2');
    }
    if(data == '8'){
        $("#tab8").addClass("tab-active");
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
            if(b_contact.length > 12 || b_contact.length < 10){
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
        console.log('Manage Service');
        var sid = $(this).data('sid');
        console.log(sid);
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
        $("#frm_programdesc").val("{{ $program_desc }}");
        $("#showimgservice").attr("src","{{ url('/public/uploads/profile_pic/thumb/'.$profile_pic) }}");
        $("#oldservicepic").val("{{ $profile_pic }}");
        $("#booking1").prop("checked", true);
        $("#creServicediv").hide();
        $("#individualDiv0").hide();
        //$("#individualDiv1").show(); ///nnn
		$("#individualDiv2").show();
		$('#current_tab_name').val('individualDiv2');
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
        $("#showimgservice").attr("src","");
        $("#oldservicepic").val("");
        $("#booking1").prop("checked", false);
        $("#individualDiv0").hide();
        //$("#individualDiv1").show(); ///nnn
		if(service_type.trim()=='experience'){
			$('.itenerary_div').show();
		}
		else
			$('.itenerary_div').hide();
		$("#individualDiv2").show();
		$('#current_tab_name').val('individualDiv2');
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
        //console.log(servicetype);
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
        $('#frm_programdesc_left').text(150-parseInt($("#frm_programdesc").val().length));
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
        var service_pic = $("#oldservicepic").val();
		$('#err_frm_servicesport').html('');
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
		if($("#frm_included_things").is(":visible")){ 
			var included_things = $("#frm_included_things").val();
			$('#err_what_included').html('');
			if(included_things == ''){ 
				$('#err_what_included').html('Please Select.');
				$('#included_things').focus();
				return false;
			}
		}
		if($("#frm_notincluded_things").is(":visible")){ 
			var notincluded_things = $("#frm_notincluded_things").val();
			$('#err_what_not_included').html('');
			if(notincluded_things == ''){ 
				$('#err_what_not_included').html('Please Select.');
				$('#notincluded_things').focus();
				return false;
			}
		}
		if($("#frm_wear").is(":visible")){ 
			var wear = $("#frm_wear").val();
			$('#err_what_guest_bring').html('');
			if(wear == ''){ 
				$('#err_what_guest_bring').html('Please Select.');
				$('#wear').focus();
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
		}
		else
		{
			$("[name='late_fee']").prop("required", false);
			$('#err_late_fee').html(' ');
		}
        /*
        if (!$('#booking1').is(":checked")) {
            $('#err_booking1').html('Please enabled instant booking');
            $('#booking1').focus();
            return false;
        }
        */
        
        $("#individualDiv2").hide();
		alert('9');
		var service_type = $("#service_type").val();
		alert(service_type);
		if(service_type.trim()=='classes' || service_type.trim()=='experience')
		{ alert('9.1');
			alert(service_pic);
			/*if(service_pic == ''){ 
				$('#err_oldservicepic2').html('Please choose profile picture.');
				return false;
        	}*/
			alert('9.2');
			$('#categ').html('<option value="Group Class">Group Class</option><option value="Seminar">Seminar</option><option value="Workshop">Workshop</option><option value="Clinic">Clinic</option><option value="Camp">Camp</option><option value="Team">Team</option><option value="Corporate">Corporate</option>');
			
			$('.location_div').hide();
			if(service_type.trim()=='experience')
			{
				alert('10');
				$('#categ').html('<option value="Tour">Tour</option><option value="Adventure">Adventure</option><option value="Retreat">Retreat</option><option value="Workshop">Workshop</option><option value="Seminar">Seminar</option><option value="Private experience">Private experience</option>');
				$('.location_div_experience').show();
				alert('11');
			}
			else{  alert('12');
				$('.location_div_experience').hide();
			}
		}
		else
		{ 
			$('#categ').html('<option value="Personal Training">Personal Training</option><option value="Coaching">Coaching</option><option value="Instructions">Instructions</option><option value="Therapy">Therapy</option>');
			
			$('.location_div').show();
			$('.location_div_experience').hide();
		}
        $("#individualDiv3").show();
		$('#current_tab_name').val('individualDiv3');
    });
    $("#nextindividual3").click(function(){
        $("#individualDiv3").hide();
        $("#individualDiv4").show();
		$('#current_tab_name').val('individualDiv4');
    });
    $("#nextindividual4").click(function(){
        $("#individualDiv4").hide();
        $("#individualDiv5").show();
		$('#current_tab_name').val('individualDiv5');
    });
    $("#nextindividual5").click(function(){
        // Disable things that we don't want to validate.
        //$(["input:hidden, textarea:hidden, select:hidden"]).attr("disabled", true);
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
        $("#individualDiv3").hide();
        $("#individualDiv2").show();
		$('#current_tab_name').val('individualDiv2');
    });
    $("#backindividual4").click(function(){
        $("#individualDiv4").hide();
        $("#individualDiv3").show();
		$('#current_tab_name').val('individualDiv3');
    });
    $("#backindividual5").click(function(){
        $("#individualDiv5").hide();
        $("#individualDiv4").show();
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
    
    $(".individualTxt, .classesTxt, .experiencesTxt").css("color","white");
    $("."+service_type+"Txt").css("color","red");
    
    $(".individualBody, .classesBody, .experienceBody").hide();
    $("."+service_type+"Body").show();
    
    //console.log(servicetype);
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
	
    const serviceSelect1exp = new SlimSelect({
        select: '#l_service'
    });
    serviceSelect1exp.set(servicetypearr);
    
    var servicelocationarr = [];
    var servicelocation = '{{ $activity_location }}';
    servicelocation = servicelocation.split(',');
    $.each(servicelocation, function( index, value ) {
        servicelocationarr.push(value);
    });
    const serviceSelect2 = new SlimSelect({
        select: '#frm_servicelocation'
    });
    serviceSelect2.set(servicelocationarr);
    const serviceSelect2exp = new SlimSelect({
        select: '#l_activity'
    });
    serviceSelect2exp.set(servicelocationarr);
    
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
    const serviceSelect3exp = new SlimSelect({
        select: '#l_greatfor'
    });
    serviceSelect3exp.set(programforarr);
    
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
    const serviceSelect4exp = new SlimSelect({
        select: '#l_agerange'
    });
    serviceSelect4exp.set(agerangearr);
    
    var numberofpeoplearr = [];
    var numberofpeople = '{{ $group_size }}';
    numberofpeople = numberofpeople.split(',');
    $.each(numberofpeople, function( index, value ) {
        numberofpeoplearr.push(value);
    });
    const serviceSelect5 = new SlimSelect({
        select: '#frm_numberofpeople'
    });
    serviceSelect5.set(numberofpeoplearr);
    
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
    const serviceSelect6exp = new SlimSelect({
        select: '#l_difficulty'
    });
    serviceSelect6exp.set(experiencelevelarr);
    
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
    const serviceSelect7exp = new SlimSelect({
        select: '#l_providers'
    });
    serviceSelect7exp.set(servicefocusesarr);
    
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
    const serviceSelect8exp = new SlimSelect({
        select: '#l_customershave'
    });
    serviceSelect8exp.set(teachingstylearr);
    
    
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
   
    $('#btn-nxt4').click(function () {
        
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
        
    });
    
    $('#btn-nxt3').click(function () {
        var testdemo = $('#testdemo').val();
        $('#b_testdemo').html('');
        if(testdemo == null){
            $('#b_testdemo').html('Please select some languages');
            $('#testdemo').focus();
            return false;
        }
    });
    
    function linkJump(bstep) {
        var cid = '<?=$companyId?>';
       // if(cid!='') {
            location.href = '/businessjumps/'+bstep+'/'+cid;
       // }
    }
    
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
        var frm_ispresentcheck = $('#frm_ispresentcheck').val();
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
        
        if(frm_organisationname == ''){
            $('#b_organisationname').html('Please enter company name');
              $('#frm_organisationname').focus();
              return false;
        }
        if(frm_position == ''){
            $('#b_position').html('Please enter position in company');
              $('#frm_position').focus();
              return false;
        }
        /*if (!$('#frm_ispresentcheck').is(":checked")) {
            alert('Please checked I still work here.');
            $('#frm_ispresentcheck').focus();
            return false;
        }*/
        if(b_employmentfrom == ''){
            $('#b_employmentfrom').html('From date is required');
              $('#dp1').focus();
              return false;
        }
        
		if (!$("#frm_ispresentcheck").is(":checked"))
		{ 
			if(b_employmentto == ''){
				$('#b_employmentto').html('To date is required');
				  $('#dp2').focus();
				  return false;
			}
		}
		
        if(frm_course == ''){
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
        }
        
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
        if($(this).val().length >= 9) {
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
        if(b_EINnumber == ''){
            $('#b_ein').html('EIN number is required');
            $('#b_EINnumber').focus();
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
            $('#b_email').focus();
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
