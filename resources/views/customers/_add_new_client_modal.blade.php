<style>
		.ui-autocomplete {
		  z-index: 1050 !important;
		}
</style>

<div class="modal fade compare-model" id="newclient">
    <div class="modal-dialog manage-customer mobile-1920">
        <div class="modal-content">
			<div class="modal-header" style="text-align: right;"> 
			  	<div class="closebtn">
					<button type="button" class="close close-btn-design manage-customer-close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
			</div>

            <!-- Modal body -->
            <div class="modal-body body-tbm">
				<div class="row"> 
                    <div class="col-lg-6 col-xs-12 space-remover">
						<div class="manage-customer-modal-title">
							<h4>Add A New Client Manually</h4> <h3>- Or -</h3>
						</div>
						<div class="manage-customer-from">
							<div id="divstep1">
								<form id="frmregister" method="post">
									<h4 class="heading-step">Step 1</h4>
									<div id='systemMessage' class="alert-msgs"></div>
	                    			<input type="hidden" name="_token" value="{{csrf_token()}}">
	                    			<input type="hidden" name="business_id" value="{{$business_id}}">
									<input type="text" name="firstname" id="firstname" size="30" maxlength="80" placeholder="First Name">
									<input type="text" name="lastname" id="lastname" size="30" maxlength="80" placeholder="Last Name">
									<input type="text" name="username" id="username" size="30" maxlength="80" placeholder="Username" autocomplete="off">
									<input type="email" name="email" id="email" class="myemail" size="30" placeholder="Email-Address" maxlength="80" autocomplete="off">
									<input type="text" name="contact" id="contact" size="30" maxlength="14" autocomplete="off" placeholder="Phone" onkeypress="return event.charCode >= 48 && event.charCode <= 57" data-behavior="text-phone">
									<input type="text" id="dob" name="dob" class=" dobdate" placeholder="Date Of Birth (mm/dd/yyyy)" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57" data-behavior="datepicker">
									<!-- <input type="password" name="password" id="password" size="30" placeholder="Password" autocomplete="off"> -->
									<!-- <input type="password" name="confirm_password" id="confirm_password" size="30" placeholder="Confirm Password" autocomplete="off"> -->
									<div class="row check-txt-center">
										<div class="col-md-8">
											<div class="terms-wrap wrap-sp">
												<input type="checkbox" name="b_trm1" id="b_trm1" class="form-check-input" value="1">
												<label for="b_trm1" class="modalregister-private">I agree to Fitnessity <a href="/terms-condition" target="_blank">Terms of Service</a> and <a href="/privacy-policy" target="_blank">Privacy Policy</a></label>
											</div>
											<div id='termserror'></div><br>
											<button type="button" style="margin-bottom: 10px;" class="signup-new" id="register_submit" onclick="$('#frmregister').submit();">Continue</button><br>
										</div>
									</div>	
								</form>
							</div>

							<div id="divstep2" style="display:none;">
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
				                                <div class='error' id='systemMessage'></div>
				                                <div class="prfle-wrap">
				                                    <img src="" alt="">
				                                    {{substr(Auth::user()->firstname,0,1)}}
				                                </div>
				                                <div class="reg-email-step2">{{Auth::user()->email}}</div>
				                                <h2>Welcome to Fitnessity</h2>
				                                <div class="reg-title-step2"><input type="text" name="" id="" value="@<?=Auth::user()->username?>" readonly=""></div>
				                                <p>Your answer to the next few question will help us find the right ideas for you</p>
				                                <div class="signup-step-btn">
				                                    <button type="button" class="signbutton-next step2_next" id="step2_next">Next</button>
				                                </div>
				                            </div>
				                        </div>
				                    </div>
				                </form>
							</div>

							<div id="divstep3" style="display:none;">
								<form action="#">
									<h4 class="heading-step">Step 2</h4>
									<input type="hidden" name="cust_id" id="cust_id" value="">
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
				                                <div class='error' id='systemMessage'></div>
				                                <div class="form-group">
				                                    <span class="error" id="err_gender"></span>
				                                    <div class="radio">
				                                        <label for="male">Male<input type="radio" name="gender" id="male" value="male" class="" /><span class="checkmark"></span></label>
				                                    </div>
				                                    <div class="radio">
				                                        <label for="female">Female<input type="radio" name="gender" id="female" value="female" class="" /><span class="checkmark"></span></label>
				                                    </div>
				                                    <div class="radio">
				                                        <label for="other">Specify another<input type="radio" name="gender" id="other" value="other" class="" /><span class="checkmark"></span></label>
				                                        <input type="text" name="othergender" id="othergender">
				                                    </div>
				                                </div>
				                                <div class="signup-step-btn">
				                                    <button type="button" class="signbutton-next step3_next" id="step3_next">Next</button>
				                                </div>
				                            </div>
				                        </div>
				                    </div>
				                </form>
							</div>

							<div id="divstep4" style="display:none;">
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
				                                    <li class="active"><a data-toggle="tab" href="#add_personel_info"><span class="stp-numbr">3</span> <span>Add Personal Information</span></a></li>
				                                    <li><a data-toggle="tab" href="#adding_photo"><span class="stp-numbr">4</span> <span>Adding Photo</span></a></li>
				                                    <li><a data-toggle="tab" href="#"><span class="stp-numbr">5</span> <span>Adding Family Member</span></a></li>
				                                </ul>
				                                
				                                <div class="tab-content">
				                                    <div id="add_personel_info" class="tab-pane fade in active manage-customer-from-step-two">
				                                        <div class='error' id='systemMessage'></div>
				                                        <div class="form-group">
				                                        	<input type="text" class="form-control" autocomplete="nope" name="Address" id="b_address" placeholder="Address" value="">
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
				                                            <button type="button" class="signbutton-next step4_next" id="step4_next">Next</button>
				                                        </div>
				                                    </div>
				                                    <div id="adding_photo" class="tab-pane fade">
				                                        <div class="upload-wrp-content">
				                                            <p><b>Put a face to the name </b>and improve your adds to networking success.</p>
				                                            <p>People prefer to network with members who has a profile photo, but if don't have one ready to upload, you can add it later.</p>
				                                        </div>
				                                        <div class="">
				                                            <div class="upload-img">
				                                                <input type="file" name="file_upload" id="file" onchange="">
				                                                <div class="upload-img-msg">
				                                                    <p>Touble uploading profile photo?</p>
				                                                </div>
				                                            </div>
				                                        </div>
				                                        <div class="signup-step-btn">
				                                            <button type="button" class="signbutton-next" id="fileimgnext">Upload</button>
				                                        </div>
				                                    </div>
				                                </div>
				                            </div>
				                        </div>
				                    </div>
				                </form>
							</div>

							<div id="divstep5" style="display:none;">
								<form action="#" enctype="multipart/form-data" id="myformprofile">
									<h4 class="heading-step">Step 4</h4>
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
				                                    <li><a data-toggle="tab" href="#"><span class="stp-numbr">5</span> <span>Adding Family Member</span></a></li>
				                                </ul>
				                                
				                                <div class="tab-content">
				                                   
				                                    <div id="adding_photo" class="tab-pane fade in active">
				                                        <div class="upload-wrp-content">
				                                            <p><b>Put a face to the name </b>and improve your adds to networking success.</p>
				                                            <p>People prefer to network with members who has a profile photo, but if don't have one ready to upload, you can add it later.</p>
				                                        </div>
				                                        <div class="">
				                                            <div class="upload-img">
				                                                <input type="file" name="file_upload_profile" id="file_upload_profile" onchange="">
				                                                <div class="upload-img-msg">
				                                                    <p>Touble uploading profile photo?</p>
				                                                </div>
				                                            </div>
				                                        </div>
				                                        <div class="signup-step-btn">
				                                    <button type="button" class="signbutton-next step3_next" id="step44_next">Next</button>
				                                </div>
				                                    </div>
				                                </div>
				                            </div>
				                        </div>
				                    </div>
				                </form>
							</div>

							<div id="divstep6" style="display:none;">
								<form action="#" id="familyform">
									<h4 class="heading-step" >Step 5</h4>
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
				                                <div class='error' id='systemMessage'></div>
				                                <h4 style="text-align: center; margin-bottom: 10px;"><b>Add Your Family Members Information</b></h4>
				                                <div class="error" id="familyerrormessage"></div>
				                                <input type="hidden" name="familycnt" id="familycnt" value="0">
				                                <div id="familymaindiv">
				                                	<div class="new-client" id="familydiv0">
														<div class="panel-group wrap" id="accordion" role="tablist" aria-multiselectable="true">
															 <div class="panel">
																<div class="panel-heading" role="tab" id="heading0">
																  <h4 class="panel-title">
																		<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse0" aria-expanded="true" aria-controls="collapse0">
																		Family Member #1
																		</a>
																	</h4>
																</div>
																<div id="collapse0" class="panel-collapse collapse show in" role="tabpanel" aria-labelledby="heading0">
																	<div class="panel-body">
																		<div class="form-group">
																			<input type="text" name="fname[]" id="fname" class="form-control first_name required" placeholder="First Name" >
																			<span class="error" id="err_fname" ></span>
																		</div>
																		<div class="form-group">
																			<input type="text" name="lname[]" id="lname" class="form-control last_name required" placeholder="Last Name" >
																			<span class="error" id="err_lname"></span>
																		</div>
																		<div>
																			<div class="birthday_date-position">
																				<input type="text" name="birthday_date[]" id="birthday_date0" class="form-control " placeholder="mm/dd/yyyy" data-behavior="datepicker" />
																				<span class="error" id="err_birthday_date"></span>
																			</div>
																		</div>
																		<div class="form-group">
																			<select name="relationship[]" id="relationship" class="form-control relationship required" >
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
																			<input maxlength="14" type="text" name="mphone[]" id="mphone" class="form-control mobile_number" placeholder="Mobile Phone" onkeypress="return event.charCode >= 48 && event.charCode <= 57" data-behavior="text-phone">
																			<span class="error" id="err_mphone"></span>
																		</div>
																		<div class="form-group">
																			<input maxlength="14" type="text" name="emergency_phone[]" id="emergency_phone" class="form-control emergency_phone" placeholder="Emergency Contact Number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" data-behavior="text-phone">
																			<span class="error" id="err_emergency_phone" ></span>
																		</div>
																		<div class="form-group">
																			<select name="gender[]" id="gender" class="form-control gender" required>
																				<option value="">Select Gender</option>
																				<option value="male">Male</option>
																				<option value="female">Female</option>
																				<option value="other">Specify other</option>
																			</select>
																			<span class="error" id="err_gender"></span>
																		</div>
																		<div class="form-group">
																			<input type="email" name="emailid[]" id="emailid" class="form-control email" placeholder="Email" >
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
				                        <div class="signup-step-btn">
											<button type="button" class="signbutton-next" id="add_family">Add New Family Member</button>
				                            <button type="button" class="signbutton-next step5_next" id="step5_next">Save</button>
				                            <button type="button" class="signbutton-next skip5_next" id="skip5_next">Skip</button>
				                        </div>
				                    </div>
				                </form>
							</div>
						</div>
                    </div>
					<div class="col-lg-6 col-xs-12 space-remover manage-customer-gray-bg">
                        <div class="manage-customer-search search-info">
							<h3>Onboard A New Client Fast</h3>
							<h4>Search for your clients on Fitnessity</h4>
							<p>“Your client could already have an account on Fitnessity.<br>If so, get access and sync their information fast.”</p>
						</div>
						<div class="row check-txt-center claimyour-business">
							<div class="col-md-10 col-xs-10 frm-claim">
								<input id="clients_name" style="margin-top:10px;" type="text" class="form-control" placeholder="Search by typing your clients name" autocomplete="off" data-customer-id=""/>
			                    
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

<!-- <script src="{{ url('/public/js/front/jquery-ui.js') }}"></script>
<link href="{{ url('/public/css/frontend/jquery-ui.css') }}" rel="stylesheet" type="text/css" media="all"/> -->

<script>
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
        	$(this).removeClass("redClass");
        });
       	$('.gender').each(function(e) {
        	$(this).removeClass("redClass");
        });

  		$(".required").each(function() {
	        $(this).removeClass("redClass");
	    });
        $('#familycnt').val(cnt);
	});


	$(document).on("click",'#request_access_btn',function(e){
		$.ajax({
            url: "{{route('sendgrantaccessmail')}}",
            method: "POST",
            data: { 
                _token: '{{csrf_token()}}', 
                id:$('#clients_name').data('customer-id'),
                business_id:'{{$business_id}}'
            },
            success: function(response){
            	$('.errclass').removeClass('green-fonts');
              	if(response == 'already'){
              		$('.errclass').html("<p> Request Access Already Granted..</p>");
              		$('.request_access_btn').attr('disabled', 'disabled');
              	}else if(response == 'success'){
              		$('.errclass').removeClass('error');
              		$('.errclass').addClass('green-fonts');
              		$('.errclass').html("<p>Email Successfully Sent..</p>");
              	}else{
              		$('.errclass').html("<p>Can't Send Mail to your mail..</p>");
              	}
            }
        });
	});

</script>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" ></script>
