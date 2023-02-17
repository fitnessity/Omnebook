@extends('layouts.header')
@section('content')

<link rel="shortcut icon" href="{{ url('public/img/favicon.png') }}">

<!--<link rel="stylesheet" type="text/css" href="{{ url('public/css/bootstrap.css') }}">-->
<link rel="stylesheet" type="text/css" href="{{ url('public/css/all.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/metismenu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/fullcalendar.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/profile.css') }}">

<style type="text/css">
   .dob label {
        background-color: lightblue;
        padding: 8px;
        color: white;
        margin-right: -3px;
        z-index: 999999;
        position: relative;
        float:left;
        border-top:solid 1px #000;
        border-bottom:solid 1px #000;
        border-left:solid 1px #000;
    }
    .dob input {
        padding: 10px 10px 10px 10px !important;
        width: 240px;
        border: solid 1px lightgray;
    }
</style>

<div class="add_family_section padding-1 white-bg border-radius1 inner_top">
   <form name="frm_family" id="frm_family" action="http://dev.fitnessity.co/addFamilyMember" method="post" autocomplete="off">
        <input type="hidden" name="_token" value="RclQSf4ZdfshqRloJtNJwGc6V1CDxPaOOeiYuvXr">                           
		<div class="addfmaily_block">
             <div class="addfmaily_content">
                 <div class="row">
                     <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="padding-bottom:10px"></div>
                 </div>
                 <div class="row" id="familydiv0">	
                      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                          <div class="form-group">
                               <input type="hidden" name="fid[0]" id="fid[0]" value="98">
                               <input type="text" name="fname[0]" id="fname[0]" placeholder="First Name" class="form-control" required="required" value="">
                          </div>
                      </div>
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
						<div class="form-group">
                            <input type="text" name="lname[0]" id="lname[0]" placeholder="Last Name" class="form-control" required="required" value="">
                        </div>
					</div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                         <div class="form-group">
                             <select name="gender[0]" id="gender[0]" class="form-control" required="required">
                                  <option value="" hidden="">Select Gender</option>
                                  <option value="Male">Male</option>
                                  <option selected="" value="Female">Female</option>
                             </select>
                         </div>
                    </div>
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                           <input type="email" name="email[0]" id="email[0]" placeholder="Email" class="form-control" value="">
                        </div>
                    </div>
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                            <select name="relationship[0]" id="relationship[0]" class="form-control" required="required">
                                 <option value="" hidden="">Select Relationship</option>
                                 <option value="Brother">Brother</option>
                                 <option selected="" value="Sister">Sister</option>
                                 <option value="Father">Father</option>
                                 <option value="Mother">Mother</option>
                                 <option value="Wife">Wife</option>
                                 <option value="Husband">Husband</option>
                                 <option value="Son">Son</option>
                                 <option value="Daughter">Daughter</option>
								<option value="Friend">Friend</option>
                             </select>
                        </div>
					</div>
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="form-group dob">
                           <label>mm/dd/yyyy</label>
                           <input type="text" name="birthdate[0]" id="birthdate[0]" placeholder="Birthday" class="form-control" value="" required="required" data-behavior="datepicker">
                        </div>
					</div>
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                       <div class="form-group">
                           <input type="text" name="mobile[0]" id="mobile0" placeholder="Mobile" class="form-control" value="" maxlength="14" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
                       </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                       <div class="form-group">
                          <input type="text" name="emergency_name[0]" id="emergency_name[0]" placeholder="Emergency Contact Name" class="form-control" value="" onkeypress="return event.charCode >= 65 &amp;&amp; event.charCode <= 120">
						</div>
					</div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
                        <div class="form-group">
                             <input type="text" name="emergency_contact[0]" id="emergency_contact0" placeholder="Emergency Contact Number" class="form-control" maxlength="14" value="" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
                             <input type="text" name="removed_family[0]" id="removed_family0" value="">
                        </div>
					</div>
                    <div style="margin-bottom:10px" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                       <i class="fas fa-trash delete-icon" data-del="98" id="fmldlt"></i>
					</div>
					<div class="col-md-12">	
						<label class="connect-account">Connect the accounts with shared options</label>
						<div class="add-family-shared">
							<input type="radio" id="html" name="fav_language" value="HTML">
							<label for="html">Select if anyone is making purchases for this family member. (required for kids under 18)</label>
							<div class="form-group">
								<select name="" id="" class="form-control" required="required">
                                   <option value="" hidden="">Select </option>
                                   <option value="purvi">Purvi</option>
                                   <option selected="" value="Darryl Phipps">Darryl Phipps   </option>
                                </select>
                            </div><br>
							<input type="radio" id="css" name="fav_language" value="CSS">
							<label for="css">Select if a membership is being shared with another family member. The membership</label>
							<div class="form-group">
								<select name="" id="" class="form-control" required="required">
                                   <option value="" hidden="">Select membership option </option>
								   <option value="1">P1</option>
                                </select>
                            </div>
							<label>is shared with</label>
							<div class="form-group">
								<select name="" id="" class="form-control" required="required">
                                   <option value="" hidden="">Select Family Member to share with </option>
								   <option value="1">1</option>
                                </select>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>                          
    </form> 
</div>


@include('layouts.footer')


@endsection