@extends('layouts.profile')

@section('content')

<div class="profile-div">
  <div class="container">
     <h3 style="color:red"><b>Welcome to Omnebook for Professional</b></h3></br>
    <div class="row"> 
    	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
        	<div class="signup-block">
            	<!-- <h1>Create Your Profile</h1> -->

                <!-- <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum</p> -->
                <p>Let’s get started with filling out your application and creating your professional profile with Omnebook.</p></br></br>
                <p>We want to help you put your best profile together to attract clients that are looking for the services you offer. All business profiles must go through an approval process with the Omnebook Quality Control Team. Not all applications are accepted, so take time to fill out your profile info in full and accurately. Our process usually takes 24 hours to complete.</p>
            	</br></br></br></br></br></br>
                
                <p><strong>Note: </strong> If you haven’t already, create a free personal profile to network with friends, share your experiences and get connected with more clients.</p>

            </div>

            <!-- step 1 starts -->

            <!-- <form  id="frmregister" method="post" action="/auth/registerBusiness"> -->

            {!! Form::open(array('url' => '/auth/registerProfessional', 'files' => true , 'enctype' => 'multipart/form-data', 'id' => 'frmregister', 'onSubmit' => 'return validateForm();')) !!}

            {!! csrf_field() !!}

	            <div id="singup_step_1" class="singup_steps">

			         <div class="step-block1">
			         	<h1>INTRODUCE YOURSELF</h1>
			            <div class="signup-block">
			            	<!-- <h3>Create Account</h3> -->
			            	<h3>First Create an Account</h3>
			                <!-- <p> Senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante pellentesque habitant morbi tristique</p> -->
			                <p>The information you provide on the following pages will help us verify you and learn more about your business. When you’re done, you will submit your profile for review. Remember, after the approval process, you can always come back and edit your information later.</p>
			                <div class="social-connect">
			                	<div class="row">
			                    	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
			                    		<a href="/socialauth/socialRegister/facebook/business" class="sgn sgn-fb">
			                    			<i class="fa fa-facebook"></i>Sign in via facebook
			                    		</a>
			                    	</div>
			                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
			                        	<a href="/socialauth/socialRegister/twitter/business" class="sgn  sgn-tw">
			                        		<i class="fa fa-twitter"></i>Sign in via Twitter
			                        	</a>
			                        </div>
			                        <!-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
			                        	<a href="#" class="sgn sgn-pt">
			                        		<i class="fa  fa-pinterest-p"></i>Sign in via Pinterest
			                        	</a>
			                        </div> -->
			                        <div class="clearfix"></div>
			                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 ">
			                        	<a href="/socialauth/socialRegister/linkedin/business" class="sgn sgn-in">
			                        		<i class="fa fa-linkedin"></i>Sign in via Linkedin
			                        	</a>
			                        </div>
			                        <!-- <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 "><a href="#" class="sgn sgn-rss"><i class="fa fa-rss"></i>Sign in via RSS</a></div> -->
			                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			                        	<a href="/socialauth/socialRegister/google/business" class=" sgn sgn-gp">
			                        		<i class="fa fa-google-plus"></i>Sign in via Google+
			                        	</a>
			                        </div>
			                    </div>
			                </div>
			            </div>
			         </div>

			         <div class="step-block1">
			         	<h1>CREATE PROFILE</h1>		         	
			            <div class="signup-block">
			            
				            <div class="row">
					            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9">
					                <p> <b>Upload a professional image that best represents you or your business.</b>
					                (Uploading a friendly, professional-looking image will increase your chances of being hired 5 times more often than those without a professional photo)</p>
					                <div class="clearfix"></div>
					                <input class="upload-pic" type="file" name="profile_pic" id="profile_pic" class="form-control" value="{{ old('profile_pic') }}" onchange="readURL(this);" >
                                    <br>
                                    <font style="color:red">@if ($errors->has('profile_pic')) {{$errors->first('profile_pic')}} @endif</font>
					                <!-- <button class="upload-pic" type="button"><i class="fa fa-picture-o"></i>upload picture</button> -->
					           </div>
					           <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
					           	<span class="user-img uploadedpic"><i class="fa fa-user"></i></span>
					           </div>
				           </div>
			                <div class="social-connect">
			                <!-- <span class="required">Required</span> -->
			                	<div class="row">
			                    	<div class="form-control">
			                        	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
			                        		<label>Company Name <span class="color-red">*</span></label>
			                        	</div>
			                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			                            	<input type="text" name="company_name" value="{{ old('company_name') }}"
			                            	 class="@if ($errors->has('company_name')) field-error @endif"
			                            	 placeholder="@if ($errors->has('company_name')) {{$errors->first('company_name')}} @endif"/>
			                            	<span class="req-line2"></span>
			                            </div>
			                        </div>
			                        <div class="form-control">
			                        	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"> 
			                        		<label>First Name <span class="color-red">*</span></label>
			                        	</div>
			                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12"> 
			                            	<input type="text" name="firstname" value="{{ old('firstname') }}"
			                            	 class="@if ($errors->has('firstname')) field-error @endif"
			                            	 placeholder="@if ($errors->has('firstname')) {{$errors->first('firstname')}} @endif"/>
			                            	<span class="req-line2"></span>
			                            </div>
			                        </div>
			                        <div class="form-control">
			                        	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"> 
			                        		<label>Last Name <span class="color-red">*</span></label>
			                        	</div>
			                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12"> 
			                            	<input type="text" name="lastname" value="{{ old('lastname') }}"
			                            	 class="@if ($errors->has('lastname')) field-error @endif"
			                            	 placeholder="@if ($errors->has('lastname')) {{$errors->first('lastname')}} @endif"/>
			                            	<span class="req-line2"></span>
			                            </div>
			                        </div>
			                        <div class="form-control">
			                        	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"> 
			                        		<label>Gender <span class="color-red">*</span></label>
			                        	</div>
			                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12"> 
			                            	<select name="gender" value="{{ old('gender') }}" class="@if ($errors->has('gender')) field-error @endif">
			                            		<option value="">Select Gender</option>
			                            		<option value="Male" @if(old('gender') == 'Male') selected @endif>Male</option>
			                            		<option value="Female" @if(old('gender') == 'Female') selected @endif>Female</option>
			                            	</select>
			                            	<span class="req-line2"></span>
			                            </div>
			                        </div>
			                        <div class="form-control">
			                        	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"> 
			                        		<label>Email <span class="color-red">*</span></label>
			                        	</div>
			                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12"> 
			                            	<input type="email" name="email" value="{{ old('email') }}"
			                            	 class="@if ($errors->has('email')) field-error @endif"
			                            	 placeholder="@if ($errors->has('email')) {{$errors->first('email')}} @endif"/>
			                            	<span class="req-line2"></span>
			                            </div>
			                        </div>
			                        <div class="form-control">
						                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						                  <label>Password <span class="color-red">*</span></label>
						                </div>
						                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
						                  <input type="password" name="password" id="password" 
						                    class="@if ($errors->has('password')) field-error @endif"
			                            	placeholder="@if ($errors->has('password')) {{$errors->first('password')}} @endif"/>
						                  <span class="req-line2"></span>
						                 </div>
						            </div>
						            <div class="form-control">
						                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						                  <label>Confirm password <span class="color-red">*</span></label>
						                </div>
						                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
						                  <input type="password" name="password_confirmation" 
						                    class="@if ($errors->has('password_confirmation')) field-error @endif"
			                            	placeholder="@if ($errors->has('password_confirmation')) {{$errors->first('password_confirmation')}} @endif"/>
						                  <span class="req-line2"></span>
						                </div>
						            </div>
			                        <div class="form-control">
			                        	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"> 
			                        		<label>Phone </label>
			                        	</div>
			                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12"> 
			                            	<!-- <input type="text" name="phone_number" value="{{ old('phone_number') }}" class="@if ($errors->has('phone_number')) field-error @endif"
			                            	placeholder="(XXX) XXX XXX" maxlength="10" /> -->
			                            	<input type="text" name="phone_number" placeholder="(xxx)xxx-xxxx" class="form-control" data-inputmask='"mask": "(999)999-9999"' data-mask value="{{ old('phone_number') }}">
			                            </div>
			                        </div>
			                        <div class="form-control">
			                        	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"> 
			                        		<label>Address <span class="color-red">*</span></label>
			                        	</div>
			                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12"> 
			                            	<input type="text" name="address" value="{{ old('address') }}" maxlength="255"
						                    class="@if ($errors->has('address')) field-error @endif"
			                            	placeholder="@if ($errors->has('address')) {{$errors->first('address')}} @endif" />
			                            	<span class="req-line2"></span>
			                            </div>
			                        </div>			                        
			                        <div class="form-control">
			                        	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"> 
			                        		<label>State <span class="color-red">*</span></label>
			                        	</div>
			                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12"> 
			                            	<select name="state" value="{{ old('state') }}" id="state" class="@if ($errors->has('state')) field-error @endif">
			                            		<option value="">Select State</option>
			                            	</select>
			                            	<!-- <input type="text" name="state" value="{{ old('state') }}" maxlength="10" 
						                    class="@if ($errors->has('state')) field-error @endif"
			                            	placeholder="@if ($errors->has('state')) {{$errors->first('state')}} @endif"/> -->
			                            	<span class="req-line2"></span>
			                            </div>
			                        </div>			                        
			                        <div class="form-control">
			                        	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"> 
			                        		<label>City <span class="color-red">*</span></label>
			                        	</div>
			                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12"> 
			                            	<select name="city" value="{{ old('city') }}" id="city" class="@if ($errors->has('city')) field-error @endif">
			                            		<option value="">Select City</option>
			                            	</select>
			                            	<!-- <input type="text" name="city" value="{{ old('city') }}" maxlength="10" 
						                    class="@if ($errors->has('city')) field-error @endif"
			                            	placeholder="@if ($errors->has('city')) {{$errors->first('city')}} @endif"/> -->
			                            	<span class="req-line2"></span>
			                            </div>
			                        </div>
			                        <div class="form-control">
			                        	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"> 
			                        		<label>Zipcode <span class="color-red">*</span></label>
			                        	</div>
			                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12"> 
			                            	<input type="text" name="zipcode" value="{{ old('zipcode') }}" maxlength="6" 
						                    class="@if ($errors->has('zipcode')) field-error @endif"
			                            	placeholder="@if ($errors->has('zipcode')) {{$errors->first('zipcode')}} @endif"/>
			                            	<span class="req-line2"></span>
			                            </div>
			                        </div>
			                        <div class="form-control">
			                        	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"> 
			                        		<label>Country <span class="color-red">*</span></label>
			                        	</div>
			                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			                            	<input type="hidden" name="country" value="US">
			                            	{!! Form::select('country_dd', ['' => 'Select'] +$countries,'US',array('id'=>'country', 'disabled' => 'disabled'));!!} 
			                            	<span class="req-line2"></span>
			                            </div>
			                        </div>
			                        <!-- two fields add on 17-05-2019 by myzeal -->
			                        
			                        <div class="form-control">
			                        	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"> 
			                        		<label>EIN Number <span class="color-red">*</span></label>
			                        	</div>
			                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			                            	<input type="text" name="ein_number" class="form-control" value="{{ old('ein_number') }}" class="@if ($errors->has('ein_number')) field-error @endif"
			                            	 placeholder="@if ($errors->has('ein_number')) {{$errors->first('ein_number')}} @endif">
			                            </div>
			                        </div>
			                        <div class="form-control">
			                        	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" style="text-align: center;"> 
			                        		<label> <span class="color-red">OR</span></label>
			                        	</div>
			                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			                            	
			                            </div>
			                        </div>
			                        <div class="form-control">
			                        	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"> 
			                        		<label>Social Security No. <span class="color-red">*</span></label>
			                        	</div>
			                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
			                            	<input type="text" name="social_security_no" class="form-control" value="{{ old('social_security_no') }}" class="@if ($errors->has('social_security_no')) field-error @endif"
			                            	 placeholder="@if ($errors->has('social_security_no')) {{$errors->first('social_security_no')}} @endif">
			                            </div>
			                        </div>

			                        <div class="form-control">
			                        	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"> 
			                        		<label>&nbsp;</label>
			                        	</div>
			                        	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 fitnessity-checkbox-div">
			                        	  <div class="form-control">
					                      <div class="btn-group" data-toggle="buttons">
					                        <label class="btn btn-primary" style="width:22px;">
					                          
					                          <span class="glyphicon glyphicon-ok">
					                          </span> </label>
					                          <input type="hidden" name="terms_condition" value="" id="terms_condition">
					                          <!-- <input type="checkbox" name="terms_condition" class="chk chkgoal" id="terms_condition"> -->
					                          I agree to <a href="javascript:void(0)" data-toggle="modal" data-target="#terms_modal">Omnebook Terms and Conditions</a>
					                        </div>
					                        <div id="term_error_div" style="display:none;">
					                        	<div class="error">
					                        	Please agree with terms & conditions
					                        	</div>
					                        </div>
					                        @if ($errors->has('terms_condition'))
					                        <br><div class="error">
					                        {{$errors->first('terms_condition')}}
					                        </div>
					                        @endif
					                        </div>

					                    </div>
				                    </div>

			                        <div class="form-control">
			                        	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"> 
			                        		<label></label>
			                        	</div>
			                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12" >
											<div  class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
											@if ($errors->has('g-recaptcha-response'))
											<span style="color:red">@if ($errors->has('g-recaptcha-response')) {{$errors->first('g-recaptcha-response')}} @endif</span>
											@endif

											@if ($errors->has('captcha'))
											<span style="color:red">@if ($errors->has('captcha')) {{$errors->first('captcha')}} @endif</span>
											@endif
											<div id="captcha_error_div" style="display:none;">
					                        	<div class="error">
					                        	Captcha is required
					                        	</div>
					                        </div>
			                            </div>
			                        </div>			                        

			                        <div class="form-control">
			                        	<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12"></div>
			                            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12"> 
			                            <!-- <input type="submit" value="Submit" />  -->
                                            <button class="button-nxt button-next" onclick="$('#frmregister').submit();">Submit</button>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			            </div>
			         </div>
			    </div>
			 <!-- </form>			  -->
			 {!! Form::close() !!}

		    <!-- step 1 ends -->
        </div>
        @include('includes.sidebar_signup')
    </div>
  </div>
</div>

<!-- Terms & Condition modal -->
<div class="modal fade" id="terms_modal" role="dialog">
	<div class="modal-dialog modal-lg">
    	<div class="modal-content" id="terms_modal_content"></div>
    	 <!-- Modal content-->
	      <div class="modal-body login-pad">
	        <div class="pop-title">
	          <h3> {{ $terms_condition_title }} </h3>
	        </div>
	        <button type="button" class="close modal-close" data-dismiss="modal">
	          <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
	        </button>
	        <div class="pagecontent">
	          {!! $terms_condition_content !!}           	
	        </div>
	      </div>
	</div>
</div>

<script type="text/javascript">
	$(function () {
        // for mobile no.
        $('[data-mask]').inputmask()
    })
    var selected_state = <?php if(!is_null(old('state')) && !empty(old('state'))) echo old('state'); else echo 'null' ?>;
    var selected_city  = <?php if(!is_null(old('city'))  && !empty(old('city'))) echo old('city'); else echo 'null'; ?>;
    // $('#country').change(function(){
    var country_code = $('#country').val();    
    if(country_code){
        $.ajax({
           type:"GET",
           url:"{{url('/get-state-list')}}?country_code="+country_code,
           success:function(res){               
            if(res){
                $("#state").empty();
                $("#state").append('<option value="">Select State</option>');
                var selected = '';
                $.each(res,function(key,value){
                    if(selected_state == key)
                        selected = "selected";
                    else 
                        selected = "";
                    $("#state").append('<option value="'+key+'" '+selected+' >'+value+'</option>');
                });
           
            }else{
               $("#state").empty();
            }
           }
        });
    }else{
        $("#state").empty();
        $("#city").empty();
    }      
   // });
   if(selected_state > 0) {
       getcityList(selected_state);
   }
   function getcityList(state_id)
   {
       if(state_id){
            $.ajax({
               type:"GET",
               url:"{{url('/get-city-list')}}?state_id="+state_id,
               success:function(res){               
                if(res){
                    $("#city").empty();
                    $("#city").append('<option value="">Select City</option>');
                    var selected = '';
                    $.each(res,function(key,value){
                        if(selected_city == key)
                            selected = "selected";
                        else 
                            selected = '';
                        $("#city").append('<option value="'+key+'" '+selected+' >'+value+'</option>');
                    });

                }else{
                   $("#city").empty();
                }
               }
            });
        }else{
            $("#city").empty();
        }
   }
    $('#state').on('change',function(){
        getcityList($('#state').val());        
   });
   function validateForm() {
   	
       $('#frmregister').validate({
              rules: 
              {
                  profile_pic: {
                   required: true,
                   accept: "image/*"
                  },
                  company_name: "required",
                  firstname: "required",
                  lastname: "required",
                  gender: "required",
                  email: {
                    required: true,
                    email: true
                  },
                  password: {
                    required: true,
                    minlength: 8
                  },
                  password_confirmation: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password"
                  },
                  phone_number: {
                    // phoneUS: true,
                    // maxlength:10
                  },
                  address: "required",
                  state: "required",
                  city: "required",
                  zipcode: "required",
                  terms_condition: {
                  	required:true
                  }
              },
              messages: {
                  profile_pic: {
                      required: "Upload a Profile picture",
                      accept: "Please upload an image"
                  },
                  company_name: "Enter Company",
                  firstname: "Enter your Firstname",
                  lastname: "Enter your Lastname",
                  gender: "Enter your Gender",
                  email: {
                    required: "Please enter a valid Email address",
                    minlength: "Please enter a valid Email address",
                    remote: jQuery.validator.format("{0} is already in use")
                  },
                  password: {
                    required: "Provide a Password",
                    minlength: jQuery.validator.format("Enter at least {0} characters")
                  },
                  password_confirmation: {
                    required: "Repeat your Password",
                    minlength: jQuery.validator.format("Enter at least {0} characters"),
                    equalTo: "Enter the same password as above"
                  },
                  phone_number: {
                    // phoneUS: "Phone number format is invalid. Please use format (XXX) XXX XXX",
                 },
                  address: "Enter your Address",
                  state: "Enter your State",
                  city: "Enter your City",
                  zipcode: "Provide a Zipcode",
                  terms_condition: {
                  	required:"Please agree with terms & conditions"
                  }
              }
        });
        if(!$('#frmregister').valid()) {
        	if($("#terms_condition").val() != 1)
        		$("#term_error_div").show();
        	else
        		$("#term_error_div").hide();
            return false;
        }
        else
        {
        	var captcha_response = grecaptcha.getResponse();
			if(captcha_response.length == 0)
			{
			   $("#captcha_error_div").show();
			    return false;
			}
			else
			{
				$("#captcha_error_div").hide();
			    return true;
			}
        }
        
        if($("#terms_condition").val() != 1) {
			$("#term_error_div").show();
			return false;
		}else {
			$("#term_error_div").hide();
		}
        
        return true;
   }

    // add US phone number validation
    $(document).ready(function(){
      jQuery.validator.addMethod("phoneUS", function(phone_number, element) {
              phone_number = phone_number.replace(/\s+/g, "");
              return this.optional(element) || phone_number.length > 9 &&
                      phone_number.match(/\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/);
      }, "Please specify a valid Phone number");

      $("label.btn").click(function() {
      	$(this).toggleClass("active");
      	if($("#terms_condition").val() == 1)
      		$("#terms_condition").val("");
      	else $("#terms_condition").val(1);
      	// $("#terms_condition").toggle("checked");
      });
    });
    
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
            	var html = '<img src="'+e.target.result+'">';
            	$('.uploadedpic').html(html);
                // $('.uploadedpic')
                //     .attr('src', e.target.result)
                //     .width(150)
                //     .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
//    function registerUser() {
//        if(!$('#frmregister').valid()) {
//            return false;
//        }
//        return true;
//    }
</script>
@endsection