<div class="modal fade compare-model" id="newclient">
    <div class="modal-dialog manage-customer">
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
							<h4>Add New Client</h4>
						</div>
						<div class="manage-customer-from">
							<div id="divstep1">
								<form id="frmregister" method="post">
									<h4 class="heading-step">Step 1</h4>
									<div id='systemMessage' class="alert-msgs"></div>
	                    			<input type="hidden" name="_token" value="{{csrf_token()}}">
	                    			<input type="hidden" name="business_id" value="{{$companyId}}">
									<input type="text" name="firstname" id="firstname" size="30" maxlength="80" placeholder="First Name">
									<input type="text" name="lastname" id="lastname" size="30" maxlength="80" placeholder="Last Name">
									<input type="text" name="username" id="username" size="30" maxlength="80" placeholder="Username" autocomplete="off">
									<input type="email" name="email" id="email" class="myemail" size="30" placeholder="Email-Address" maxlength="80" autocomplete="off">
									<input type="text" name="contact" id="contact" size="30" maxlength="14" autocomplete="off" placeholder="Phone" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeyup="changeformate_fami_pho('contact')">
									<input type="text" id="dob" name="dob" class=" dobdate" placeholder="Date Of Birth (mm/dd/yyyy)" maxlength="10" onkeypress="return event.charCode >= 48 && event.charCode <= 57" >
									<input type="password" name="password" id="password" size="30" placeholder="Password" autocomplete="off">
									<input type="password" name="confirm_password" id="confirm_password" size="30" placeholder="Confirm Password" autocomplete="off">
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
								<form action="#">
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
				                                <div class="form-group">
				                                    <input type="text" name="fname" id="fname" class="form-control first_name" placeholder="First Name">
				                                    <span class="error" id="err_fname"></span>
				                                </div>
				                                <div class="form-group">
				                                    <input type="text" name="lname" id="lname" class="form-control last_name" placeholder="Last Name">
				                                    <span class="error" id="err_lname"></span>
				                                </div>
				                                <div>
				                                    <div class="birthday_date-position">
				                                        <input type="text" name="birthday_date" id="birthday_date" class="form-control birthday" placeholder="mm/dd/yyyy"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" />
				                                        <span class="error" id="err_birthday_date"></span>
				                                    </div>
				                                </div>
				                                <div class="form-group">
				                                    <select name="relationship" id="relationship" class="form-control relationship">
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
				                                    <input maxlength="14" type="text" name="mphone" id="mphone" class="form-control mobile_number" placeholder="Mobile Phone" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeyup="changeformate_fami_pho('mphone')">
				                                    <span class="error" id="err_mphone"></span>
				                                </div>
				                                <div class="form-group">
				                                    <input maxlength="14" type="text" name="emergency_phone" id="emergency_phone" class="form-control emergency_phone" placeholder="Emergency Contact Number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeyup="changeformate_fami_pho('emergency_phone')">
				                                    <span class="error" id="err_emergency_phone" ></span>
				                                </div>
				                                <div class="form-group">
				                                    <select name="gender" id="gender" class="form-control gender">
				                                        <option value="">Select Gender</option>
				                                        <option value="male">Male</option>
				                                        <option value="female">Female</option>
				                                        <option value="other">Specify other</option>
				                                    </select>
				                                    <span class="error" id="err_gender"></span>
				                                </div>
				                                <div class="form-group">
				                                    <input type="email" name="emailid" id="emailid" class="form-control email" placeholder="Email">
				                                    <span class="error" id="err_emailid"></span>
				                                </div>
				                            </div>
				                        </div>
				                        <div class="signup-step-btn">
				                            <button type="button" class="signbutton-next step5_next" id="step5_next">Save</button>
				                            <button type="button" class="signbutton-next skip5_next" id="skip5_next">Skip</button>
				                        </div>
				                    </div>
				                </form>
							</div>
						</div>
                    </div>
					<div class="col-lg-6 col-xs-12 space-remover manage-customer-gray-bg">
                        <div class="manage-customer-search">
							<h4>Search for your clients on Fitnessity</h4>
							<p>Save time by searching for your clients on Fitnessity. They could already have a profile.</p>
						</div>
						<div class="row check-txt-center claimyour-business">
							<div class="col-md-10 col-xs-10 frm-claim">
								<input id="business_name" style="margin-top:10px;" type="text" class="form-control" placeholder="Search by typing your clients name" />
			                    <div id="option-box">
			                    </div>
							</div>
						</div>
                    </div>
				 </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
	$(document).mouseup(function (e) {
        if ($(e.target).closest("#option-box1").length === 0) {
            $("#option-box1").hide();
        } 
        if ($(e.target).closest("#option-box").length === 0) {
            $("#option-box").hide();
        }
    });
</script>

<script type="text/javascript">
	$("#business_name").keyup(function() {
      $.ajax({
          type: "POST",
          url: "/searchcustomersaction",
          data: { query: $(this).val(),  _token: '{{csrf_token()}}', },
          beforeSend: function() {
              //$("#label").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
          },
          success: function(data) {
              $("#option-box").show();
              $("#option-box").html(data);
              $("#business_name").css("background", "#FFF");
          }
      });
  	});

	function registerUser() {
    	
       /* var valchk = getAge();*/
        var validForm = $('#frmregister').valid();
        var posturl = '/customers/registration';
        if (!jQuery("#b_trm1").is(":checked")) {
           $("#termserror").html('Plese Agree Terms of Service and Privacy Policy.').addClass('alert-class alert-danger');
            return false;
        }
       /* if(valchk == 1){
            $('#register_submit').prop('disabled', true);*/
            if (validForm) {
                var formData = $("#frmregister").serialize();
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
                    
                        $('#register_submit').prop('disabled', true).css('background','#999999');
                    },
                    success: function (response) {
                        $("#systemMessage").html(response.msg).addClass('alert-class alert-danger');
                        showSystemMessages('#systemMessage', response.type, response.msg);
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
        
        /*}else{
            $("#systemMessage").html('You must be at least 13 years old.').addClass('alert-class alert-danger');
        }*/
    }

  	function changeformate_fami_pho(idname) {
      /*alert($('#contact').val());*/
      var con = $('#'+idname).val();
      var curchr = con.length;
      if (curchr == 3) {
          $('#'+idname).val("(" + con + ")" + "-");
      } else if (curchr == 9) {
          $('#'+idname).val(con + "-");
      }
    }

    function getcustomerlist(){
		$('#option-box1').hide();
		var inpuval = $('#serchclient').val();
		if(inpuval == ''){
			$('#chk').val('empty');
			$('#id').val('{{$companyId}}');
		}else{
			$('#chk').val('notempty');
			$('#id').val(inpuval);
		}
		
		$.ajax({
			url:'{{route("manage-customer")}}',
			type:"GET",
			data:{
				inpuval:inpuval
			},
			success:function(response){
				$('#customerlist').html(response);
			}
		});
	}

	function searchclick(cid){
	  	$url = '{{env("APP_URL")}}';
	  	//window.location.href = "viewcustomer/"+cid;
	     window.open($url + "viewcustomer/"+cid, "_blank");
	}

	$("#serchclient").keyup(function() {
      $.ajax({
          type: "POST",
          url: "/searchcustomersaction",
          data: { query: $(this).val(),  _token: '{{csrf_token()}}', },
          beforeSend: function() {
              //$("#label").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
          },
          success: function(data) {
              $("#option-box1").show();
              $("#option-box1").html(data);
              $("#serchclient").css("background", "#FFF");
          }
      });
    });

    $(".dobdate").keyup(function(){
      if ($(this).val().length == 2){
          $(this).val($(this).val() + "/");
      }else if ($(this).val().length == 5){
          $(this).val($(this).val() + "/");
      }
  	});

    $(".birthday").keyup(function(){
        if ($(this).val().length == 2){
            $(this).val($(this).val() + "/");
        }else if ($(this).val().length == 5){
            $(this).val($(this).val() + "/");
        }
    });

		$("#frmregister").submit(function (e) {
      e.preventDefault();
      $('#frmregister').validate({
          rules: {
              firstname: "required",
              lastname: "required",
              username: "required",
              email: {
                  required: true,
                  email: true
              },
              /*dob: {
                  required: true,
              },*/
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
             /* dob: {
                  required: "Please provide your date of birth",
              },*/
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
          submitHandler: registerUser
      });
  	});

    $('#email').on('blur', function() {
      var posturl = '{{route("emailvalidation_customer")}}';
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

    $(document).on('click', '#step3_next', function () {
        $("#err_gender").html("");
        /*if ($('input[name="gender"]:checked').val() == '' || $('input[name="gender"]:checked').val() == 'undefined' || $('input[name="gender"]:checked').val() == undefined) {
            $("#err_gender").html('Please select your gender');
        } else {*/
            if ($('input[name="gender"]:checked').val() == 'other' && $('#othergender').val() == '') {
                $("#err_gender").html('Please enter other gender');
            } else {
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
        //}
    });

    $(document).on('click', '#step4_next', function () {
      
        var address_sign = $('#b_address').val();
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
        
        /*if(address_sign == ''){
            $('#err_address_sign').html('Please enter address');
            $('#address_sign').focus();
            return false;
        }
        if(country_sign == ''){
            $('#err_country_sign').html('Please enter country');
            $('#country_sign').focus();
            return false;
        }
        if(city_sign == ''){
            $('#err_city_sign').html('Please enter city');
            $('#city_sign').focus();
            return false;
        }
        if(state_sign == ''){
            $('#err_state_sign').html('Please enter state');
            $('#state_sign').focus();
            return false;
        }
        if(zipcode_sign == ''){
            $('#err_zipcode_sign').html('Please enter zipcode');
            $('#zipcode_sign').focus();
            return false;
        }*/

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
            }
        });
       
    });

    $(document).on('click', '#step44_next', function () {
      	var posturl = '/customers/savephoto';
       	var getData = new FormData($("#myformprofile")[0]);
      	getData.append('_token', '{{csrf_token()}}')       
      	getData.append('cust_id', $('#cust_id').val())       
      	$.ajax({
            url: posturl,
            type: 'POST',
            dataType: 'json',
            data: getData,
            cache: true,
            processData: false,
            contentType: false,
           
            success: function (response) {
                $("#divstep5").css("display","none");
                $("#divstep6").css("display","block");
            }
        });
  	});

  	$(document).on('click', '#step5_next', function () {
      
        var fname = $('#fname').val();
        var lname = $('#lname').val();
        var birthday_date = $('#birthday_date').val();
        var relationship = $('#relationship').val();
        var mphone = $('#mphone').val();
        var gender = $('#gender').val();
        var emailid = $('#emailid').val();
        
        $('#err_fname').html('');
        $('#err_lname').html('');
        $('#err_birthday_date').html('');
        $('#err_relationship').html('');
        $('#err_mphone').html('');
        $('#err_gender').html('');
        $('#err_emailid').html('');
        
        if(fname == ''){
            $('#err_fname').html('Please enter first name');
            $('#fname').focus();
            return false;
        }
        if(lname == ''){
            $('#err_lname').html('Please enter last name');
            $('#lname').focus();
            return false;
        }
        if(birthday_date == ''){
            $('#err_birthday_date').html('Please enter birth date');
            $('#birthday_date').focus();
            return false;
        }
        if(relationship == ''){
            $('#err_relationship').html('Please select relationship');
            $('#relationship').focus();
            return false;
        }
        if(mphone == ''){
            $('#err_mphone').html('Please enter mobile number');
            $('#mphone').focus();
            return false;
        }
        if(gender == ''){
            $('#err_gender').html('Please select gender');
            $('#gender').focus();
            return false;
        }
        if(emailid == ''){
            $('#err_emailid').html('Please enter emailid');
            $('#emailid').focus();
            return false;
        }
        
        var posturl = '/submitfamilyCustomer';
        var formdata = new FormData();
        formdata.append('_token', '{{csrf_token()}}')
        formdata.append('first_name', $('.first_name').val())
        formdata.append('last_name', $('.last_name').val())
        formdata.append('email', $('.email').val())
        formdata.append('relationship', $('.relationship').val())
        formdata.append('mobile_number', $('.mobile_number').val())
        formdata.append('emergency_phone', $('.emergency_phone').val())
        formdata.append('birthday', $('#birthday_date').val())
        formdata.append('gender', $('.gender').val())
        formdata.append('cust_id', $('#cust_id').val())

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
                    $('#step5_next').prop('disabled', true).css('background','#999999');
                  
                    $("#systemMessage").html('Please wait while we submitting the data.')
                },
                complete: function () {
                    $('#step5_next').prop('disabled', true).css('background','#999999');
                },
                success: function (response) {
                    $("#systemMessage").html(response.msg);
                    if (response.type === 'success') {
                        window.location.href = response.redirecturl;
                    } else {
                        $('#step5_next').prop('disabled', false).css('background','#ed1b24');
                    }
                }
            });
        }, 1000)
    });

    $(document).on('click', '#skip5_next', function () {
    	window.location.href = '/viewcustomer/'+$('#cust_id').val();
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