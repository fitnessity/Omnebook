<style>
		.ui-autocomplete {
		  z-index: 9999 !important;
		}
</style>

@php $business_id = Auth::user()->cid; @endphp

<div class="modal fade new-client-steps" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-bs-focus="false">
	<div class="modal-dialog modal-dialog-centered modal-80">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="window.location.reload()"></button>
			</div>
			<div class="modal-body body-tbm">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 space-remover ">
						<div class="manage-customer-modal-title">
							<h4>Add A New Client Manually</h4> 
							<div class="p-relative">
								<h3>- Or -</h3>
							</div>
						</div>
						<div class="manage-customer-from">
							<div id="divstep1" style="display: block ;">
								<form id="frmregister" method="post">
									<h4 class="heading-step">Step 1</h4>
									<div id="systemMessage" class="alert-msgs font-red"></div>
									<input type="hidden" name="_token" value="{{csrf_token()}}">
									<input type="hidden" name="business_id" value="{{$business_id}}">
									<input type="text" name="firstname" id="firstname" size="30" maxlength="80" placeholder="First Name">
									<input type="text" name="lastname" id="lastname" size="30" maxlength="80" placeholder="Last Name">
									<!-- <input type="text" name="username" id="username" size="30" maxlength="80" placeholder="Username" autocomplete="off"> -->
									<input type="email" name="email" id="email" class="myemail" size="30" placeholder="Email-Address" maxlength="80" autocomplete="off">
									<input type="text" name="contact" id="contact" size="30" maxlength="14" autocomplete="off" placeholder="Phone" onkeypress="return event.charCode >= 48 && event.charCode <= 57" data-behavior="text-phone">
									<input type="text" class="form-control border-0 dash-filter-picker flatpiker-with-border add-client-birthdate" id="dob" name="dob" placeholder="Birthday">

									<div class="form-group check-box-info">
										<input class="check-box-primary-account" type="checkbox" id="primaryAccountHolder" name="primaryAccountHolder" value="1">
										<label for="primaryAccountHolder"> Primary Account <span class="" data-bs-toggle="tooltip" data-bs-placement="top" title="You are paying for yourself and all added family members.">(i)</span></label>
									</div>
									
									<div class="row check-txt-center">
										<div class="col-lg-8 col-md-12 col-9">
											<div class="terms-wrap wrap-sp">
												<input type="checkbox" name="b_trm1" id="b_trm1" class="form-check-input" value="1">
												<label for="b_trm1" class="modalregister-private">I agree to Fitnessity <a href="/terms-condition" target="_blank">Terms of Service</a> and <a href="/privacy-policy" target="_blank">Privacy Policy</a></label>
											</div>
											<div id="termserror" class="error"></div><br>
											<button type="button" style="margin-bottom: 10px;" class="signup-new btn-red" id="register_submit" onclick="$('#frmregister').submit();">Continue</button><br>
										</div>
									</div>	
								</form>
							</div>
							<div id="divstep2" style="display: none;">
								<form action="#">
									<div class="sign-step_2">
										<div class="filledstep-bar">
											<div class="row">
												<div class="col-sm-12">
													<span class="filledstep"></span>
													<span class=""></span>
													<span class=""></span>
													<span class=""></span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<div class="error" id="systemMessage"></div>
												<div class="prfle-wrap">
													<img src="" alt="">
												</div>
												<div class="reg-email-step2"></div>
												<h2>Welcome to Fitnessity</h2>
												<p>Your answer to the next few question will help us find the right ideas for you</p>
												<div class="signup-step-btn">
													<button type="button" class="signup-new btn-red" id="step2_next">Next</button>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>							
							<div id="divstep3" style="display: none;">

								<form action="#">
									<input type="hidden" name="cust_id" id="cust_id" value="">
									<h4 class="heading-step">Step 2</h4>
									<div class="sign-step_3">
										<div class="filledstep-bar">
											<div class="row">
												<div class="col-sm-12">
													<span class="filledstep"></span>
													<span class="filledstep"></span>
													<span></span>
													<span></span>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<h2>How do you Identify?</h2>
												<div class="error" id="systemMessage"></div>
												<div class="form-group">
													<span class="error" id="err_gender"></span>
													<div class="radio">
														<label for="male">Male<input type="radio" name="gender" id="male" value="male" class=""><span class="checkmark"></span></label>
													</div>
													<div class="radio">
														<label for="female">Female<input type="radio" name="gender" id="female" value="female" class=""><span class="checkmark"></span></label>
													</div>
													<div class="radio">
														<label for="other">Specify another<input type="radio" name="gender" id="other" value="other" class=""><span class="checkmark"></span></label>
														<input class="border-none" type="text" name="othergender" id="othergender">
													</div>
												</div>
												<div class="signup-step-btn">
													<button type="button" class="signup-new btn-red" id="step3_next">Next</button>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
							
							<div id="divstep4" style="display: none;">
								<form action="#">
									<h4 class="heading-step">Step 3</h4>
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
												</ul>
												<ul class="nav nav-tabs nav-stacked">
													<li class="active"><a data-bs-toggle="tab" data-bs-target="#add_personel_info" role="tab" aria-controls="add_personel_info" aria-selected="true"><span class="stp-numbr">3</span> <span>Add Personal Information</span></a></li>
													<li><a data-bs-toggle="tab" data-bs-target="#" role="tab" aria-controls=""><span class="stp-numbr" aria-selected="false">4</span> <span>Adding Family Member</span></a></li>
												</ul>
												
												<div class="tab-content">
													<div id="add_personel_info" class="tab-pane fade show active manage-customer-from-step-two">
														<div class="error" id="systemMessage"></div>
														<div class="form-group">
															<input type="text" class="form-control" autocomplete="nope" name="Addresstopbar" id="b_address_topbar" placeholder="Address" value="">
															<span class="error" id="err_address_sign"></span>
														</div>
														<div id="map" style="display: none;"></div>
														<input type="hidden" name="lon" id="lon" value="">
														<input type="hidden" name="lat" id="lat" value="">
														<div class="form-group">
															<input type="text" class="form-control" name="Country" id="b_country" size="30" placeholder="Country" value="" maxlength="20">
															<span class="error" id="err_country_sign"></span>
														</div>
														<div class="form-group">
															<input type="text" class="form-control" name="City" id="b_city" size="30" placeholder="City" maxlength="50" value="">
															<span class="error" id="err_city_sign"></span>
														</div>
														<div class="form-group">
															<input type="text" class="form-control" name="State" id="b_state" size="30" placeholder="State" maxlength="50" value="">
															<span class="error" id="err_state_sign"></span>
														</div>
														<div class="form-group">
															<input type="text" class="form-control" name="ZipCode" id="b_zipcode" size="30" placeholder="Zip Code" value="" maxlength="20">
															<span class="error" id="err_zipcode_sign"></span>
														</div>
														<div class="signup-step-btn">
															<button type="button" class="signup-new btn-red" id="step4_next">Next</button>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
							
							<div id="divstep5" style="display: none ;">
								<form action="#" id="familyform">
									<h4 class="heading-step">Step 5</h4>
									<div class="sign-step_5">
										<div class="filledstep-bar">
											<div class="row">
												<div class="col-sm-12">
													<span class="filledstep"></span>
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
												<h4><b>Add Your Family Members Information</b></h4>
												<div class="error mb-10" id="familyerrormessage"></div>
												<input type="hidden" name="familycnt" id="familycnt" value="0">
												<div id="familymaindiv">
													<div class="new-client mb-10" id="familydiv0">
														<div class="accordion" id="default-accordion-example">
															<div class="accordion-item shadow">
																<h2 class="accordion-header" id="heading0">
																	<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse0" aria-expanded="true" aria-controls="collapse0">Family Member #1</button>
																</h2>
																<div id="collapse0" class="accordion-collapse collapse show" aria-labelledby="heading0" data-bs-parent="#default-accordion-example">
																	<div class="accordion-body">
																		<div class="form-group check-box-info">
																			<input class="check-box-primary-account" type="checkbox" id="primaryAccount" name="primaryAccount" value="1">
																			<label for="primaryAccount"> Primary Account <span class="" data-bs-toggle="tooltip" data-bs-placement="top" title="Choose the primary account holder to determine whose card covers bookings for up to two family members (e.g., Mom or Dad). All cards stored under the primary account will be available at checkout.">(i)</span></label>
																		</div>
																		<div class="form-group">
																			<input type="text" name="fname[]" id="fname" class="form-control first_name required" placeholder="First Name">
																			<span class="error" id="err_fname"></span>
																		</div>
																		<div class="form-group">
																			<input type="text" name="lname[]" id="lname" class="form-control last_name required" placeholder="Last Name">
																			<span class="error" id="err_lname"></span>
																		</div>
																		<div>
																			<input type="text" class="form-control border-0 dash-filter-picker flatpiker-with-border" name="birthdate[]" id="birthdate"  placeholder="Birthday">
																		</div>
																		<div class="form-group">
																			<select name="gender[]" id="gender" class="form-select gender" required="">
																				<option value="">Select Gender</option>
																				<option value="male">Male</option>
																				<option value="female">Female</option>
																				<option value="other">Specify other</option>
																			</select>
																			<span class="error" id="err_gender"></span>
																		</div>
																		<div class="form-group">
																			<select name="relationship[]" id="relationship" class="form-select relationship required">
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
																			<input maxlength="14" type="text" name="mphone[]" id="mphone" class="form-control mobile_number" placeholder="Mobile Phone" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
																			<span class="error" id="err_mphone"></span>
																		</div>
																		<div class="form-group">
																			<input type="email" name="emailid[]" id="emailid" class="form-control email" placeholder="Email">
																			<span class="error" id="err_emailid"></span>
																		</div>
																		<div class="form-group">
																			<input type="text" name="emergency_name[]" id="emergency_name" class="form-control emergency_name" placeholder="Emergency Contact Name">
																			<span class="error" id="err_emergency_name"></span>
																		</div>
																		<div class="form-group">
																			<input maxlength="14" type="text" name="emergency_phone[]" id="emergency_phone" class="form-control emergency_phone" placeholder="Emergency Contact Number" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" data-behavior="text-phone">
																			<span class="error" id="err_emergency_phone"></span>
																		</div>
																		<div class="form-group">
																			<input type="text" name="emergency_email[]" id="emergency_email" class="form-control emergency_email" placeholder="Emergency Contact Email">
																			<span class="error" id="err_emergency_email"></span>
																		</div>
																		<div class="form-group">
																			<select name="emergency_relation[]" id="emergency_relation" class="form-select emergency_relation">
																				<option value="">Select Emergency Relationship</option>
																				<option value="Brother">Brother</option>
																				<option value="Sister">Sister</option>
																				<option value="Father">Father</option>
																				<option value="Mother">Mother</option>
																				<option value="Wife">Wife</option>
																				<option value="Husband">Husband</option>
																				<option value="Son">Son</option>
																				<option value="Daughter">Daughter</option>
																			</select>
																			<span class="error" id="err_emergency_relation"></span>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-xl-12 col-lg-12 col-sm-12">
												<div class="">
													<button type="button" class="btn btn-red mb-10 w-100" id="add_family">Add New Family Member</button>
												</div>
											</div>
											<div class="col-xl-6 col-lg-6 col-sm-12">
												<div class="">
													<button type="button" class="btn btn-red mb-10 w-100" id="step6_next">Save</button>
												</div>
											</div>
											<div class="col-xl-6 col-lg-6 col-sm-12">
												<div class="">
													<button type="button" class="btn btn-red mb-10 w-100" id="skip6_next">Skip</button>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>

							<div id="divstep6" style="display: none;">
								<input type="hidden" id="client_secret" value="">
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
										@if (session('stripeErrorMsg'))
				                            <div class="col-md-12">
				                                <div class='form-row row'>
				                                    <div class='col-md-12  error form-group'>
				                                        <div class="alert-danger alert">
				                                            {{ session('stripeErrorMsg') }}
				                                        </div>
				                                    </div>
				                                </div>
				                            </div>
				                        @endif
										<form id="payment-form1" data-secret="{{@$intent['client_secret']}}" style="padding: 16px;margin-bottom: 0px;">
											<div>
											  	<div id="error-message1" class="alert alert-danger" role="alert" style="display: none;"></div>
											  	<div id="payment-element1" style="margin-top: 8px;"></div>
											</div>
											<div class="text-center mt-25">
										  		<button class="btn btn-red mr-5" type="submit" id="submit1">Add on file</button>
										  		<button type="button" class="btn btn-red" id="skip7_next">Skip</button>
										  	</div>
										</form>
									</div>
								</div>
				   			</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 space-remover manage-customer-gray-bg">
						<div class="manage-customer-search search-info">
							<h3>Onboard A New Client Fast</h3>
							<h4>Search for your clients on Fitnessity</h4>
							<p>“Your client could already have an account on Fitnessity.<br>If so, get access and sync their information fast.”</p>
						</div>
						<div class="row check-txt-center claimyour-business">
							<div class="col-md-10 col-xs-10 col-8 frm-claim">
								<input id="clients_name" style="margin-top:10px;" type="text" class="form-control" placeholder="Search by typing your clients name" autocomplete="off" data-customer-id="">
								
								<div class="request-access" style="display:none">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>

	flatpickr('.add-client-birthdate',{
		altInput: true,
		altFormat: "m/d/Y",
		dateFormat: "Y-m-d",
        maxDate: "today",
	});

	$(document).on('focus', '#birthdate', function(e){
        //jQuery.noConflict();
        $(this).flatpickr( { 
			dateFormat: "m/d/Y",
        	maxDate: "today",
        });
    });

	jQuery(function ($) {
      	$('#frmregister').validate({
          	rules: {
	            firstname: "required",
	            lastname: "required",
	            /*username: "required",*/
	            email: {
	                required: true,
	                email: true
	            },
	            contact: {
	            	required: true,
	            }
          	},
          	messages: {
              	firstname: "Enter your Firstname",
              	lastname: "Enter your Lastname",
             	/*username: "Enter your Username",*/
              	email: {
                  	required: "Please enter a valid email address",
              	},
              	contact: {
                  	required: "Enter your Phone Number",
              	},
          	},
          	submitHandler: function (form) {
          		if (!jQuery("#b_trm1").is(":checked")) {
		           	$("#termserror").html('Plese Agree Terms of Service and Privacy Policy.').addClass('alert-class alert-danger');
		            return false;
        		}

        		var formData = $("#frmregister").serialize();
            	$.ajax({
                url: '/customers/registration',
                type: 'POST',
                dataType: 'json',
                data: formData,
                beforeSend: function () {
                	$("#termserror").html('');
                    $('#register_submit').prop('disabled', true).css('background','#999999');
                    $('#systemMessage').addClass('font-red');
                    $("#systemMessage").html('Please wait while we register you with Fitnessity.').addClass('alert-class alert-danger');
                },
                complete: function () {
                
                    $('#register_submit').prop('disabled', false).css('background','#ed1b24');
                },
                success: function (response) {
                    $("#systemMessage").html(response.msg).addClass('alert-class alert-danger');
                    if (response.type === 'success') {
                    	// $("#frmregister")[0].reset();
                    	$("#systemMessage").html(response.msg).addClass('alert-class alert-danger');
                    	$("#divstep1").css("display","none");
                    	$("#divstep3").css("display","block");
                    	$("#cust_id").val(response.id);
                    } else {
                        $('#register_submit').prop('disabled', false).css('background','#ed1b24');
                    }
                }
            });
          	}
      	});
  	});

  	$(document).on('click', '#step3_next', function () {
        $("#err_gender").html("");

    	if ($('input[name="gender"]:checked').val() == '' || $('input[name="gender"]:checked').val() == 'undefined' || $('input[name="gender"]:checked').val() == undefined) {
            $("#err_gender").html('Please select your gender');
        } else {
            if ($('input[name="gender"]:checked').val() == 'other' && $('#othergender').val() == '') {
                $("#err_gender").html('Please enter other gender');
            }else{
	            var posturl = '/customers/savegender';
	            var formdata = new FormData();
	            formdata.append('_token', '{{csrf_token()}}')
	            formdata.append('cust_id', $('#cust_id').val())
	            var g = $('input[name="gender"]:checked').val() == 'other' ? $('#othergender').val() : $('input[name="gender"]:checked').val();
	            formdata.append('gender', g);
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
	                    $('.step3_next').prop('disabled', true).css('background','#999999');
	                    $('#systemMessage').html('Please wait while we processed you with Fitnessity.');
	                },
	                complete: function () {
	                    $('.step3_next').prop('disabled', false).css('background','#ed1b24');
	                },
	                success: function (response) {
	                   $("#divstep3").css("display","none");
	                   $("#divstep4").css("display","block");
	                }
	            });
	        }
        }
    });

    $(document).on('click', '#step4_next', function () {
        var address_sign = $('#b_address_topbar').val();
        var country_sign = $('#b_country').val();
        var city_sign = $('#b_city').val();
        var state_sign = $('#b_state').val();
        var zipcode_sign = $('#b_zipcode').val();
        var lon = $('#lon').val();
        var lat = $('#lat').val();
        
        $('#err_address_sign').html('');
        $('#err_country_sign').html('');
        $('#err_city_sign').html('');
        $('#err_state_sign').html('');
        $('#err_zipcode_sign').html('');

    	if(address_sign == ''){
    		$('#err_address_sign').html('Please enter address.');
    	}else{
    		var posturl = '/customers/saveaddress';
	        var formdata = new FormData();
	        formdata.append('_token', '{{csrf_token()}}')
	        formdata.append('address', address_sign)
	        formdata.append('country', country_sign)
	        formdata.append('city', city_sign)
	        formdata.append('state', state_sign)
	        formdata.append('zipcode', zipcode_sign)
	        formdata.append('lon', lon)
	        formdata.append('lat', lat)
	        formdata.append('cust_id', $('#cust_id').val())
	        var cus_id = $('#cust_id').val();
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
	                $('.step4_next').prop('disabled', true).css('background','#999999');
	                $('#systemMessage').html('Please wait while we processed you with Fitnessity.');
	            },
	            complete: function () {
	                $('.step4_next').prop('disabled', false).css('background','#ed1b24');
	            },
	            success: function (response) {
	                $("#divstep4").css("display","none");
	                $("#divstep5").css("display","block");
	                $('#client_secret').val(response.client_secret)
	                $('#payment-form1').attr('data-secret', response.client_secret);
	            }
	        });
	    }
    });

  	$(document).on('click', '#step6_next', function () {
       $('.relationship').each(function(e) {
        	$(this).removeClass("font-red");
        });
       	$('.gender').each(function(e) {
        	$(this).removeClass("font-red");
        });

  		$(".required").each(function() {
	        $(this).removeClass("font-red");
	    });
        var counter = 0;

        $('.relationship').each(function(e) {
        	if ($(this).val() === "") {
	            $(this).addClass("font-red");
	            counter++;
	        }
        });

	    $(".required").each(function() {
	        if ($(this).val() === "") {
	            $(this).addClass("font-red");
	            counter++;
	        }
	    });

	    $('.gender').each(function(e) {
        	if ($(this).val() === "") {
	            $(this).addClass("font-red");
	            counter++;
	        }
        });

	    if(counter > 0){
	    	$('#familyerrormessage').html("Looks like some of the fields aren't filled out correctly. They're highlighted in red.");
	    	return false;
	    }else{
	    	var cus_id = $('#cust_id').val();
	        var form = $('#familyform')[0];
	        var posturl = '/submitfamilyCustomer';
	        var formdata = new FormData(form);
	        formdata.append('_token', '{{csrf_token()}}')
	        formdata.append('cust_id', cus_id)
	        formdata.append('business_id', '{{$business_id}}')
	     
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
	                    $('#step6_next').prop('disabled', true).css('background','#999999');
	                  
	                    $("#systemMessage").html('Please wait while we submitting the data.')
	                },
	                complete: function () {
	                    $('#step6_next').prop('disabled', true).css('background','#999999');
	                },
	                success: function (response) {
	                    $("#systemMessage").html(response.msg);
	                    if (response.type === 'success') {
	                    	$("#divstep5").css("display","none");
							$("#divstep6").css("display","block");
							executeScript(cus_id);
	                       // window.location.href = response.redirecturl;
	                    } else {
	                        $('#step6_next').prop('disabled', false).css('background','#ed1b24');
	                    }
	                }
	            });
	        }, 1000)
        }
    });

    $(document).on('click', '#skip6_next', function () {
    	$("#divstep5").css("display","none");
		$("#divstep6").css("display","block");
		executeScript($('#cust_id').val());
    	//window.location.href = '/business/{{$business_id}}/customers/'+$('#cust_id').val();
    });

    $(document).on('click', '#skip7_next', function () {
    	window.location.href = '/business/{{$business_id}}/customers/'+$('#cust_id').val();
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

   

	$(document).on("click",'#add_family',function(e){
		var cnt = $('#familycnt').val();
		var old_cnt = cnt;
		cnt++;
		var txtcount = cnt;
		txtcount += 1;
		var data = '';
		data += '<div class="new-client mb-10" id="familydiv'+cnt+'">';
        data += $('#familydiv'+old_cnt).html();
        data += '</div>';
        var re = data.replaceAll("heading"+old_cnt,"heading"+cnt);
        re = re.replaceAll("collapse"+old_cnt,"collapse"+cnt);
        re = re.replaceAll("birthday_date"+old_cnt,"birthday_date"+cnt);
        re = re.replaceAll("Family Member #"+cnt,"Family Member #"+txtcount);
        var $data = $(re);
       	$data.find('.check-box-info').remove();
       	var modifiedData = $data[0].outerHTML;

        $('#familymaindiv').append(modifiedData);
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

	$(document).on("click",'.request_access_btn',function(e){
		$.ajax({
            url: "{{route('sendgrantaccessmail')}}",
            method: "POST",
            data: { 
                _token: '{{csrf_token()}}', 
                id:$('#clients_name').data('customer-id'),
                business_id:'{{$business_id}}'
            },
            success: function(response){
            	$('.errclass').removeClass('font-green');
              	if(response == 'already'){
              		$('.errclass').html("<p> Request access already granted. And user already sync with this business.</p>");
              		$('.request_access_btn').attr('disabled', 'disabled');
              	}else if(response == 'success'){
              		$('.errclass').removeClass('error');
              		$('.errclass').addClass('font-green');
              		$('.errclass').html('<p>Email Successfully Sent..</p><a class="request_access_btn">Resend Email</a>');
              	}else{
              		$('.errclass').html("<p>Can't Send Mail to your mail..</p>");
              	}
            }
        });
	});
</script>

<script type="text/javascript">
	
	$(document).ready(function () {
		var url = "{{ url('/searchuser') }}";
    	$( "#clients_name" ).autocomplete({
      		source: url,
      		focus: function( event, ui ) {
      			 return false;
        	},
        	select: function( event, ui ) {
        		$("#clients_name").val( ui.item.firstname + ' ' +  ui.item.lastname);
        		$('#clients_name').data('customer-id', ui.item.id);
        		$('.request-access').css('display','block');
        		$('.request-access').html('<p>To import the name, contact information, family members and credit card information for '+ ui.item.firstname + ' ' +  ui.item.lastname +', they must authorize you access.</p><label>Steps </label><div class="request-step"><p>1. Click the Request Access button below. </p><p>2. Fitnessity will send an email to the customer to authorize you access.</p><p>3. Once authorization has been granted, the sync button will turn green, and you can sync the information immediately.</p><button type="button" style="margin-bottom: 10px;" class="signup-new request_access_btn" id="request_access_btn">Request Access</button></div><div class="error text-center errclass"></div>');
                 return false;
	        },
    	}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
    		 let profile_img = '<div class="collapse-img"><div class="company-list-text" style="height: 50px;width: 50px;"><p style="padding: 0;">' + item.firstname.charAt(0).toUpperCase() + '</p></div></div> ';

            if(item.profile_pic_url){
                profile_img = '<img class="searchbox-img" src="' + (item.profile_pic ? item.profile_pic : '') + '" style="">';            
            }

            var inner_html = '<div class="row rowclass-controller"></div><div class="row"><div class="col-md-3 nopadding text-center">' + profile_img + '</div><div class="col-md-9 div-controller">' + 
                      '<p class="pstyle"><label class="liaddress">' + item.firstname + ' ' +  item.lastname  + (item.age ? ' (' + item.age+ '  Years Old)' : '') + '</label></p>' +
                      '<p class="pstyle liaddress">' + item.email +'</p>' + 
                      '<p class="pstyle liaddress">' + item.phone_number + '</p></div></div>';
           
            return $( "<li></li>" )
                    .data( "item.autocomplete", item )
                    .append(inner_html)
                    .appendTo( ul );
        };
  	});
</script>


<script type="text/javascript">
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -33.8688, lng: 151.2195},
            zoom: 13
        });

        var input = document.getElementById('b_address_topbar');
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
                if(place.address_components[i].types[0] == 'country'){
                  $('#b_country').val(place.address_components[i].long_name);
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
              $('#b_address_topbar').val(sublocality_level_1);
            }else{
              $('#b_address_topbar').val(badd);
            }
            
        });
    }
</script>

<!-- <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{env('AUTO_COMPLETE_ADDRESS_GOOGLE_KEY')}}&callback=initMap" async defer></script>
 -->


<script>
$(document).ready(function() {
  $('.collapse.in').prev('.panel-heading').addClass('active');
  $('#accordion, #bs-collapse')
    .on('show.bs.collapse', function(a) {
      $(a.target).prev('.panel-heading').addClass('active');
    })
    .on('hide.bs.collapse', function(a) {
      $(a.target).prev('.panel-heading').removeClass('active');
    });
});

</script>

<script type="text/javascript">
	function executeScript(customer_id){
	    const stripe1 = Stripe('{{ env('STRIPE_PKEY') }}');
	    const options1 = {
	        clientSecret: $('#client_secret').val(),
	        appearance: {
	        theme: 'flat'
	        },
	    };

	    const elements1 = stripe1.elements(options1);
	    const paymentElement1 = elements1.create('payment');
	    paymentElement1.mount('#payment-element1');

	    const form = document.getElementById('payment-form1');
		const cus_id = customer_id;
	    var return_url = '/business/'+'{{$business_id}}'+'/customers/'+customer_id;
	    form.addEventListener('submit', async (event) => {
	        event.preventDefault();
	        $('#submit1').text('loading...')

	        const {error} = await stripe1.confirmSetup({
	            elements: elements1,
	            confirmParams: {
	                return_url: '{{ route('business.customers.refresh_payment_methods',['business_id' => $business_id ])}}?customer_id=' + cus_id,
	            }
	        });

	        if (error) {
	          const messageContainer1 = document.querySelector('#error-message1');
	          messageContainer1.textContent = error.message;
	          $('#error-message1').show();

	        } else {
	          	
	        }
	        $('#submit1').text('Add on file')
	    });
  	}
</script>
