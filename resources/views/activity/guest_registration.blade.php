<div class="row"> 
    <div class="col-lg-6 col-xs-12 register-modal">
		<div class="logo-my">
			<a href="#"> <img src="{{url('/public/images/logo-small.jpg')}}"> </a>
		</div>
		<div class="manage-customer-from">
			<div id="divstep1" style="display: block;">
				<form id="frmregister" method="post">
					<div class="register-pop-title ftitle1">
						<h3>Tell Us About You</h3>
					</div>
					<br>
					<h4 class="text-center">To make sure you are 18, please complete these steps</h4>
					
					<div id='systemMessage' class="alert-msgs"></div>
	    			<input type="hidden" name="_token" value="{{csrf_token()}}">
					<input type="text" name="firstname" id="firstname" size="30" maxlength="80" placeholder="First Name">
					<input type="text" name="lastname" id="lastname" size="30" maxlength="80" placeholder="Last Name">
					<input type="text" name="username" id="username" size="30" maxlength="80" placeholder="Username" autocomplete="off">
					<input type="email" name="email" id="email" class="myemail" size="30" placeholder="e-Mail" maxlength="80" autocomplete="off">
					<input type="text" name="contact" id="contact" size="30" maxlength="14" autocomplete="off" placeholder="Phone" data-behavior="text-phone">
					<input type="text" id="dob" name="dob" class="flatpicker_birthdate1" placeholder="Birthdate" maxlength="10" data-behavior="flatpicker_birthdate1">  
					

					<div class="position-relative auth-pass-inputgroup">	
						<input type="password" name="password" id="password" size="30" placeholder="Password" autocomplete="off">
                        <button class="btn-link position-absolute password-addon-guest-regi toggle-password" type="button" data-tp = "password">
                            <i class="fas fa-eye"></i>
						</button>
					</div>
					<div class="position-relative auth-pass-inputgroup">
						<input class="password-input" type="password" name="confirm_password" id="confirm_password" size="30" placeholder="Confirm Password" autocomplete="off">
						<button class="btn-link position-absolute password-addon-guest-regi toggle-password" type="button" data-tp = "confirm_password">
                            <i class="fas fa-eye"></i>
                        </button>
					</div>

					<!-- <input type="password" name="password" id="password" size="30" placeholder="Password" autocomplete="off">
					<input type="password" name="confirm_password" id="confirm_password" size="30" placeholder="Confirm Password" autocomplete="off"> -->


					<div class="row check-txt-center">
						<div class="col-md-12">
							<div class="terms-wrap wrap-sp">
								<input type="checkbox" name="b_trm1" id="b_trm1" class="form-check-input" value="1">
								<label class="modalregister-private" for="b_trm1">I agree to Fitnessity <a href="/terms-condition" target="_blank">Terms of Service</a> and <a href="/privacy-policy" target="_blank">Privacy Policy</a></label>
							</div>
	    					<div id='termserror'></div><br>
							<button type="button" style="margin-bottom: 10px;" class="signup-new" id="register_submit" onclick="$('#frmregister').submit();">Continue</button><br>
						</div>
					</div>
				</form>
			</div>
	
			<div id="divstep2" style="display: none;">
				<form action="#" enctype="multipart/form-data" id="myformprofile">
					<div class="sign-step_4">
						<div class="filledstep-bar">
							<div class="row">
								<div class="col-sm-12">
									<span class="filledstep"></span>
									<span class="filledstep"></span>
									<span class="filledstep"></span>
									<span></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<ul class="">
									<li><i class="fa fa-check"></i><span>Registration Information</span></li>
									<li><i class="fa fa-check"></i><span>Your Identification</span></li>
									<li><i class="fa fa-check"></i><span>Add Personal Information</span></li>
								</ul>
								<ul class="nav nav-tabs nav-stacked">
								   
									<li><a data-toggle="tab" href="#adding_photo"><span class="stp-numbr">4</span> <span>Adding Photo</span></a></li>
								</ul>
								
								<div class="tab-content">
								   
									<div id="adding_photo" class="tab-pane fade in active">
										<div class="upload-wrp-content">
											<p><b>Put a face to the name </b>and improve your adds to networking success.</p>
											<p>People prefer to network with members who has a profile photo, but if don't have one ready to upload, you can add it later.</p>
										</div>
										<div class="">
											<div class="upload-img">
												<input type="file" name="file_upload_profile" id="file_upload_profile" onchange="readURL(this);">
												<div class="upload-img-msg">
													<p>Touble uploading profile photo?</p>
												</div>
											</div>
										</div>
								
										<div class="signup-step-btn">
											<button type="button" class="signbutton-next step2_next" id="step2_next">Next</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			
			<div id="divstep3" style="display: none;">
				<form action="#" id="familyform">
					<div class="sign-step_5">
						<div class="filledstep-bar">
							<div class="row">
								<div class="col-sm-12">
									<span class="filledstep"></span>
									<span class="filledstep"></span>
									<span class="filledstep"></span>
									<span class="filledstep"></span>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<h2>Activities are much more fun with family</h2>
								<div class="error" id="systemMessage"></div>
								<h4 style="text-align: center; margin-bottom: 10px;"><b>Add Your Family Members Information</b></h4>
								<div class="error" id="familyerrormessage"></div>
								<input type="hidden" name="familycnt" id="familycnt" value="0">
								<div id="familymaindiv">
									<div class="new-client" id="familydiv0">
										<div class="content1">
											<div class="panel-group" id="accordion">
												<div class="panel panel-default">
													 <div class="panel-heading">
													   <h4 class="panel-title">
														 <a data-toggle="collapse" data-parent="#accordion" href="#collapse0" aria-expanded="true" class="">Family Member #1</a>
													   </h4>
													 </div>
													<div id="collapse0" class="panel-collapse collapse in" aria-expanded="true" style="">
														 <div class="panel-body">
															  <div class="form-group">
															<input type="text" name="first_name[]" id="first_name" class="form-control first_name required" placeholder="First Name">
															<span class="error" id="err_fname"></span>
														</div>
														<div class="form-group">
															<input type="text" name="last_name[]" id="last_name" class="form-control last_name required" placeholder="Last Name">
															<span class="error" id="err_lname"></span>
														</div>
														<div>
															<div class="birthday_date-position">
																<input type="text" name="birthday[]" id="birthday" class="form-control birthday  Flatpicker required" placeholder="Birthday">
																<span class="error" id="err_birthday_date"></span>
															</div>
														</div>
														<div class="form-group">
															<select name="relationship[]" id="relationship required" class="form-group relationship">
																<option value="">Select Relationship</option>
																<option value="Brother">Brother</option>
																<option value="Sister">Sister</option>
																<option value="Father">Father</option>
																<option value="Mother">Mother</option>
																<option value="Wife">Wife</option>
																<option value="Husband">Husband</option>
																<option value="Son">Son</option>
																<option value="Daughter">Daughter</option>
															</select>
															<span class="error" id="err_relationship"></span>
														</div>
														<div class="form-group">
															<input maxlength="14" type="text" name="mobile[]" id="mobile" class="form-control mobile_number" placeholder="Mobile Phone" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
															<span class="error" id="err_mphone"></span>
														</div>
														<div class="form-group">
															<input maxlength="14" type="text" name="emergency_phone[]" id="emergency_phone" class="form-control emergency_phone " placeholder="Emergency Contact Number" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
															<span class="error" id="err_emergency_phone"></span>
														</div>
														<div class="form-group">
															<select name="gender[]" id="gender" class="form-group gender" required="">
																<option value="">Select Gender</option>
																<option value="male">Male</option>
																<option value="female">Female</option>
																<option value="other">Specify other</option>
															</select>
															<span class="error" id="err_gender"></span>
														</div>
														<div class="form-group">
															<input type="email" name="email[]" id="email" class="form-control email required" placeholder="Email">
															<span class="error" id="err_emailid"></span>
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
						<div class="signup-step-btn">
							<button type="button" class="signbutton-next" id="add_family">Add New Family Member</button>
							<button type="button" class="signbutton-next step3_next" id="step3_next">Save</button>
							<button type="button" class="signbutton-next skip3_next" id="skip3_next">Skip</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">

	//$(".flatpicker_birthdate1").flatpickr({ static : true });
	
	flatpickr("[data-behavior~=flatpicker_birthdate1]", {
        dateFormat: "m/d/Y",
        maxDate: "01/01/2050",
    });

	$(document).on('focus', '#birthday', function(e){
        $(this).flatpickr({ 
           	dateFormat: "m/d/Y",
        	maxDate: "today",
        });
    });
 
</script>

<script type="text/javascript">
	jQuery(function ($) {
    	$('#frmregister').validate({
	        rules: {
	            firstname: "required",
	            lastname: "required",
	            username: "required",
	            email: {
	                required: true,
	                email: true
	            },
	            dob: {
	                required: true,
	            },
	            password: {
	                required: true,
	                minlength: 8
	            },
	            confirm_password: {
	                required: true,
	                minlength: 8,
	                equalTo: "#password"
	            },
	        },
	        messages: {
	            firstname: "Enter your Firstname",
	            lastname: "Enter your Lastname",
	            username: "Enter your Username",
	            email: {
	                required: "Please enter a valid email address",
	                minlength: "Please enter a valid email address",
	                remote: jQuery.validator.format("{0} is already in use")
	            },
	            dob: {
	                required: "Please provide your date of birth",
	            },
	            password: {
	                required: "Provide a password",
	                minlength: jQuery.validator.format("Enter at least {0} characters")
	            },
	            confirm_password: {
	                required: "Repeat your password",
	                minlength: jQuery.validator.format("Enter at least {0} characters"),
	                equalTo: "Enter the same password as above"
	            },
	        },
	        submitHandler:  function(form){
	        	if (!jQuery("#b_trm1").is(":checked")) {
		           $("#termserror").html('Plese Agree Terms of Service and Privacy Policy.').addClass('alert-class alert-danger');
		            return false;
		        }
		        var valchk = getAge();
		        if(valchk == 1){
		            $('#register_submit').prop('disabled', true);
	                var formData = $("#frmregister").serialize();
	                var posturl = '/auth/postRegistration_as_guest';
	                $.ajax({
	                    url: posturl,
	                    type: 'POST',
	                    dataType: 'json',
	                    data: formData,
	                    beforeSend: function () {
	                        $('#register_submit').prop('disabled', true).css('background','#999999');
	                        showSystemMessages('#systemMessage', 'info', 'Please wait while we register you with Fitnessity.');
	                        $("#systemMessage").html('Please wait while we register you with Fitnessity.').addClass('alert-class alert-danger');
	                    },
	                    complete: function () {
	                        $('#register_submit').prop('disabled', false).css('background','#ed1b24');
	                    },
	                    success: function (response) {
	                    	$('#register_submit').prop('disabled', false).css('background','#ed1b24');
	                        $("#systemMessage").html(response.msg).addClass('alert-class alert-danger');
	                        showSystemMessages('#systemMessage', response.type, response.msg);
	                        if (response.type === 'success') {

	                        	$("#systemMessage").html(response.msg).addClass('alert-class alert-danger');
		                    	$("#divstep1").css("display","none");
		                    	$("#divstep2").css("display","block");
		                    	
	                            //window.location.href = '{{route("carts_index")}}';
	                        } else {
	                            $('#register_submit').prop('disabled', false).css('background','#ed1b24');
	                        }
	                    }
	                });
		        }else{
		            $("#systemMessage").html('You must be at least 13 years old.').addClass('alert-class alert-danger');
		        }
	        }
	    });
    });

	$(document).ready(function () {
		$('.toggle-password').on('click', function() {
            var passwordField = $('#password');
            if($(this).data('tp') == 'confirm_password'){
                passwordField = $('#confirm_password');
            }

            var toggleButton = $(this);
            if (passwordField.attr('type') === 'password') {
                passwordField.attr('type', 'text');
                toggleButton.html('<i class="fas fa-eye-slash"></i>');
            } else {
                passwordField.attr('type', 'password');
                toggleButton.html('<i class="fas fa-eye"></i>');
            }
        });
        
	    $('#email').on('blur', function() {
	        var posturl = '{{route("emailvalidation")}}';
	        var formData = $("#frmregister").serialize();
	        $.ajax({
	            url: posturl,
	            type: 'get',
	            dataType: 'json',
	            data: formData,  
	             beforeSend: function () {
	                $("#systemMessage").html('');
	            },             
	            success: function (response) {                    
	                $("#systemMessage").html(response.msg).addClass('alert-class alert-danger');  
	            }
	        });
	    });

	    $(document).on('click', '#step2_next', function () {
	        var posturl = '/auth/savephoto';
	        var getData = new FormData($("#myformprofile")[0]);
	        getData.append('_token', '{{csrf_token()}}') 
	        $.ajax({
	            url: posturl,
	            type: 'POST',
	            dataType: 'json',
	            data: getData,
	            cache: true,
	            processData: false,
	            contentType: false,
	            success: function (response) {
	                $("#divstep2").css("display","none");
		            $("#divstep3").css("display","block");             
	            }
	        });
	    });

	    $(document).on('click', '#step3_next', function () {

	        $(".required").each(function() {
	            $(this).removeClass("redClass");
	        });
	        var counter = 0;
	        $(".required").each(function() {
	            if ($(this).val() === "") {
	                $(this).addClass("redClass");
	                counter++;
	            }
	        });
	        if(counter > 0){
	            $('#systemMessage').html("");

	            $('#familyerrormessage').html("Looks like some of the fields aren't filled out correctly. They're highlighted in red.");
	            return false;
	        }else{

	            var posturl = '/submit-family-form1';
	            var form = $('#familyform')[0];
	            var formdata = new FormData(form);
	            formdata.append('_token', '{{csrf_token()}}')
	            formdata.append('show_step', 6)

	            $.ajax({
	                url: posturl,
	                type: 'POST',
	                dataType: 'json',
	                data: formdata,
	                processData: false,
	                contentType: false,
	                headers: {
	                    'X-CSRF-TOKEN': $("#_token").val()
	                },
	                beforeSend: function () {
	                    $('#step3_next').prop('disabled', true).css('background','#999999');
	                    $("#systemMessage").html('Please wait while we submitting the data.')
	                },
	                complete: function () {
	                    $('#step3_next').prop('disabled', true).css('background','#999999');
	                },
	                success: function (response) {
	                    $("#systemMessage").html(response.msg);
	                    if (response.type === 'success') {
	                        window.location.href = '{{route("carts_index")}}';
	                    } else {
	                        $('#step3_next').prop('disabled', false).css('background','#ed1b24');
	                    }
	                }
	            });
	        }
	    });

	    $(document).on('click', '#skip3_next', function () {
		    var posturl = '/skip-family-form1';
	        var formdata = new FormData();
	        formdata.append('_token', '{{csrf_token()}}')
	        formdata.append('first_name', 'check')
	        formdata.append('show_step', 6)
	        setTimeout(function () {
	            $.ajax({
	                url: posturl,
	                type: 'POST',
	                dataType: 'json',
	                data: formdata,
	                processData: false,
	                contentType: false,
	                headers: {
	                    'X-CSRF-TOKEN': $("#_token").val()
	                },
	                beforeSend: function () {
	                    $('#skip3_next').prop('disabled', true).css('background','#999999');
	                    $("#systemMessage").html('Please wait while we skipping the data.');
	                },
	                complete: function () {
	                    $('#skip3_next').prop('disabled', true).css('background','#999999');
	                },
	                success: function (response) {
	                    $("#systemMessage").html(response.msg);
	                    if (response.type === 'success') {
	                        window.location.href = '{{route("carts_index")}}';
	                    } else {
	                        $('#skip3_next').prop('disabled', false).css('background','#ed1b24');
	                    }
	                }
	            });
	        }, 1000)
	    });

	    $(document).on("click",'#add_family',function(e){
	        var cnt = $('#familycnt').val();
	        var old_cnt = cnt;
	        cnt++;
	        var txtcount = cnt;
	        txtcount += 1;
	        var data = '';
	        data += '<div class="new-client" id="familydiv'+cnt+'">';
	        data += $('#familydiv'+old_cnt).html();
	        data += '</div>';
	        var re = data.replaceAll("heading"+old_cnt,"heading"+cnt);
	        re = re.replaceAll("collapse"+old_cnt,"collapse"+cnt);
	        re = re.replaceAll("birthday_date"+old_cnt,"birthday_date"+cnt);
	        re = re.replaceAll("Family Member #"+cnt,"Family Member #"+txtcount);
	        $('#familymaindiv').append(re);
	        $('.relationship').each(function(e) {
	        	$(this).removeClass("font-red");
	        });
	       	$('.gender').each(function(e) {
	        	$(this).removeClass("font-red");
	        });

	  		$(".required").each(function() {
		        $(this).removeClass("font-red");
		    });
	        $('#familycnt').val(cnt);
	    });
	});

	function getAge() {
        var dateString = document.getElementById("dob").value;
        var today = new Date();
        var birthDate = new Date(dateString);
        var age = today.getFullYear() - birthDate.getFullYear();
        if(age < 13)
        {
            var agechk = '0';
        } else {
           var agechk = '1';
        }
        return agechk;
    }
</script>
 


