@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">
        <div class="col-md-2 col-sm-12" style="background: black;">
        	 @include('business.businessSidebar')
        </div>
		<div class="col-md-10 col-sm-12">
            <div class="container-fluid p-0">
				<div class="row">
					<div class="col-md-6 col-xs-6">
						<div class="tab-hed ">Manage Customers</div>
					</div>
					<div class="col-md-6 col-xs-6">
						<div class="row">
							<div class="col-md-4">
								<a href="#" class="btn-nxt manage-cus-btn" data-toggle="modal" data-target="#newclient">Add New Client</a>
							</div>
							<div class="col-md-5">
								<div class="manage-search">
									<form method="get" action="/activities/">
										<input type="text" name="label" id="" placeholder="Search for client" autocomplete="off" value="">
										<button id="serchbtn"><i class="fa fa-search"></i></button>
									</form>
								</div>
							</div>
							<div class="col-md-3">
								<button type="button" class="btn-nxt search-btn-sp">Search</button>
							</div>
						</div>
					</div>
				</div>
                <!--<div class="tab-hed manage-cus">Manage Customers</div>
				<button type="button" class="btn-nxt manage-cus-btn">Add New Client</button>-->
				<hr style="border: 3px solid black; width: 115%; margin-left: -38px; margin-top: 5px;">
            </div>
			<div class="row">
				<div class="col-md-6 col-xs-12">
					
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="staff-main">
						<button type="button" class="btn-bck">Import List</button>
						<button type="button" class="btn-nxt">Export List</button>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-xs-12">
					<div class="total-clients">
						<i class="fas fa-user-circle"></i>
						<label>You Have {{$customer_count}} Clients</label>
					</div>
					<div class="panel-group" id="accordion-customer">
						@php  $i= 0;@endphp
						@foreach ($customers as $section=>$cust) 
						<div class="custom-panel panel panel-default">
							<div class="custom panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-customer" href="#collapse_{{$i}}">
									{{$section}}
									</a>
								</h4>
							</div>
							<div id="collapse_{{$i}}" class="panel-collapse collapse" data-parent="#accordion-customer">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											@foreach ($cust as $dt) 
											<div class="collapse-inner-box mrb-2">
												<div class="row">
													<div class="col-md-1 col-xs-3 col-sm-1">
														<div class="collapse-img">
															{!! $dt->getimage() !!}
															
														</div>
													</div>
													<div class="col-md-2 col-xs-8 col-sm-2">
														<div class="client-name">
															<span>{{$dt->fname}} {{$dt->lname}}</span>
															<p>Last Attended: 20/09/2019</p>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
														<div class="client-age">
															<span>Age: 32</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Status: </label>
															
															<span class="green-fonts">
																@if($dt->status == 0)
																	InActive
																@else
																	Active;
																@endif</span>
														</div>
													</div>
													<div class="col-md-3 col-xs-12 col-sm-3">
														<div class="client-status">
															<label>Active Memberships: </label>
															<span class="green-fonts">2</span>
														</div>
													</div>
													<div class="col-md-2 col-xs-12 col-sm-2">
														<div class="client-status">
															<label>Expiring Soon: </label>
															<span class="red-fonts">1</span>
														</div>
													</div>
													<div class="col-md-1 col-xs-12 col-sm-1">
														<div class="client-status">
															<a href="{{ route('viewcustomer',['id'=>$dt->id]) }}">View</a>
														</div>
													</div>
												</div>
											</div>	
											@endforeach									
										</div>
									</div>
								</div>
							</div>
						</div>
						<script type="text/javascript">
							$("#collapse_{{$i}}").click(function(){
								$(".panel-collapse").removeClass('in');
								$("#collapse_{{$i}}").addClass('in');
							});
						</script>
						@php  $i++;  @endphp
						@endforeach
						
					</div>
				</div>
			</div>
		</div>
	</div>
	
<!-- The Modal Add Business-->
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
									<h4 >Step 1</h4>
									<div id='systemMessage' class="alert-msgs"></div>
	                    			<input type="hidden" name="_token" value="{{csrf_token()}}">
	                    			<input type="hidden" name="business_id" value="{{$companyId}}">
									<input type="text" name="firstname" id="firstname" size="30" maxlength="80" placeholder="First Name">
									<input type="text" name="lastname" id="lastname" size="30" maxlength="80" placeholder="Last Name">
									<input type="text" name="username" id="username" size="30" maxlength="80" placeholder="Username" autocomplete="off">
									<input type="email" name="email" id="email" class="myemail" size="30" placeholder="Email-Address" maxlength="80" autocomplete="off">
									<input type="text" name="contact" id="contact" size="30" maxlength="14" autocomplete="off" placeholder="Phone" onkeypress="return event.charCode >= 48 && event.charCode <= 57" onkeyup="changeformate()">
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
				                                    <div id="add_personel_info" class="tab-pane fade in active">
				                                        <div class='error' id='systemMessage'></div>
				                                        <div class="form-group">
				                                            <input type="text" name="address_sign" id="address_sign" placeholder="Address" class="form-control b_address" >
				                                            <span class="error" id="err_address_sign"></span>
				                                        </div>
				                                        <div id="map" style="display: none;"></div>
				                                        <input type="hidden" name="lon" id="lon" value="">
				                                        <input type="hidden" name="lat" id="lat" value="">
				                                        <div class="form-group">
				                                            <input type="text" name="country_sign" id="country_sign" placeholder="Country" class="form-control b_country">
				                                            <span class="error" id="err_country_sign"></span>
				                                        </div>
				                                        <div class="form-group">
				                                            <input type="text" name="city_sign" id="city_sign" placeholder="City" class="form-control b_city">
				                                            <span class="error" id="err_city_sign"></span>
				                                        </div>
				                                        <div class="form-group">
				                                            <input type="text" name="state_sign" id="state_sign" placeholder="State" class="form-control b_state">
				                                            <span class="error" id="err_state_sign"></span>
				                                        </div>
				                                        <div class="form-group">
				                                            <input type="text" name="zipcode_sign" id="zipcode_sign" placeholder="Zipcode" class="form-control b_zipcode">
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
				                                                <input type="file" name="file_upload" id="file" onchange="readURL(this);">
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
				                                        <!-- <div class="signup-step-btn">
				                                            <button type="button" class="signbutton-next" id="fileimgnext">Upload</button>
				                                        </div> -->
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
				                                        <input type="text" name="birthday_date" id="birthday_date" class="form-control birthday" placeholder="mm/dd/yyyy" />
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
				                                    <label for="">Email</label>
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
							<h4>Search For Client On Fitnessity</h4>
							<p>"Your client could already have a profile on fitnessity"</p>
						</div>
						<div class="row check-txt-center claimyour-business">
							<div class="col-md-10 col-xs-10 frm-claim">
								<input id="business_name" style="margin-top:10px;" type="text" class="form-control" placeholder="Your Business Name Here" />
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
<!-- end modal -->
</div>


<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>-->
@include('layouts.footer')
<script type="text/javascript">
	$(document).ready(function () {
		$("#collapse_0").addClass('in');

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

		$(".dobdate").keyup(function(){
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
	        if ($('input[name="gender"]:checked').val() == '' || $('input[name="gender"]:checked').val() == 'undefined' || $('input[name="gender"]:checked').val() == undefined) {
	            $("#err_gender").html('Please select your gender');
	        } else {
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
	        }
	    });

	    $(document).on('click', '#step4_next', function () {
        
	        var address_sign = $('#address_sign').val();
	        var country_sign = $('#country_sign').val();
	        var city_sign = $('#city_sign').val();
	        var state_sign = $('#state_sign').val();
	        var zipcode_sign = $('#zipcode_sign').val();
	        var lon = $('#lon').val();
	        var lat = $('#lat').val();
	        
	        $('#err_address_sign').html('');
	        $('#err_country_sign').html('');
	        $('#err_city_sign').html('');
	        $('#err_state_sign').html('');
	        $('#err_zipcode_sign').html('');
	        
	        if(address_sign == ''){
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
	        }

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
                        	$("#frmregister")[0].reset();
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

    function searchclick(cid){
        window.location.href = "viewcustomer/"+cid;
    }

    function changeformate() {
        /*alert($('#contact').val());*/
        var con = $('#contact').val();
        var curchr = con.length;
        if (curchr == 3) {
            $("#contact").val("(" + con + ")" + "-");
        } else if (curchr == 9) {
            $("#contact").val(con + "-");
        }
    }
</script>
<script type="text/javascript">
        function initMap() {
            
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: -33.8688, lng: 151.2195},
                    zoom: 13
                });
                var input = document.getElementById('address_sign');
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
                    alert(place.address_components.length);
                    // Location details
                    for (var i = 0; i < place.address_components.length; i++) {
                        if(place.address_components[i].types[0] == 'postal_code'){
                          $('#zipcode_sign').val(place.address_components[i].long_name);
                        }
                   
                        if(place.address_components[i].types[0] == 'locality'){
                            $('#city_sign').val(place.address_components[i].long_name);
                        }

                        if(place.address_components[i].types[0] == 'sublocality_level_1'){
                            sublocality_level_1 = place.address_components[i].long_name;
                        }

                        if(place.address_components[i].types[0] == 'country'){
                            $('#country_sign').val(place.address_components[i].long_name);
                        }

                        if(place.address_components[i].types[0] == 'administrative_area_level_1'){
                             $('#state_sign').val(place.address_components[i].long_name);
                        }

                        if(place.address_components[i].types[0] == 'street_number'){
                           badd = place.address_components[i].long_name ;
                        }

                        if(place.address_components[i].types[0] == 'route'){
                           badd += ' '+place.address_components[i].long_name ;
                        } 
                    }
                    if(badd == ''){
                      $('#address_sign').val(sublocality_level_1);
                    }else{
                      $('#address_sign').val(badd);
                    }
                    $('#lat').val(place.geometry.location.lat());
                    $('#lon').val(place.geometry.location.lng());
                    
                });
            
        }
</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCr7-ilmvSu8SzRjUfKJVbvaQZYiuntduw&callback=initMap" async defer></script>

@endsection