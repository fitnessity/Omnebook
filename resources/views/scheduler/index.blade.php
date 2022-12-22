@extends('layouts.header')
@section('content')
@include('layouts.userHeader')

@php
	 use App\StaffMembers;
@endphp
<link href="{{ url('public/css/jquery-ui.css') }}" rel="stylesheet" type="text/css">

<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">
        <div class="col-md-2 col-sm-12" style="background: black;">
        	 @include('business.businessSidebar')
        </div>
		<div class="col-md-10 col-sm-12">
            <div class="container-fluid p-0">
				<div class="row">
					<div class="col-md-6 col-xs-12 col-sm-12">
						<div class="tab-hed scheduler-txt"><span class="font-red">Activity Scheduler </span> | <a href="{{route('booking_request')}}">Booking Request </a></div>
					</div>
					<div class="col-md-6 col-xs-12 col-sm-12">
						<div class="row">
							<div class="col-md-4 col-xs-12 col-sm-3">
								<a href="#" class="btn-nxt manage-cus-btn" data-toggle="modal" data-target="#newclient">Add New Client</a>
							</div>
							<div class="col-md-8">
								<div class="manage-search serchcustomer">
									<form>
										<input type="text" name="serchclient" id="serchclient" placeholder="Search for client" autocomplete="off" value="">
										<div id="option-box1"></div>
										<button ><i class="fa fa-search"></i></button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr style="border: 3px solid black; width: 125%; margin-left: -38px; margin-top: 5px;">
			  </div>
			  <div class="container-fluid plr-0">
				<div class="row">
					<div class="col-md-3 col-xs-12 col-sm-6">
						 <div class="date-activity-scheduler">
                            <label for="">Date:</label>
                            <div class="activityselect3 special-date">
								<!-- <input type="text" name="actfildate" id="managecalendarservice" placeholder="Date" class="form-control" onchange="getbookingmodel('.$request->sid.','ajax');" autocomplete="off" value="'.date('m/d/Y',strtotime($request->date)).'"> -->
								<input type="text" name="actfildate" id="managecalendarservice" placeholder="Date" class="form-control" autocomplete="off" value="{{date('m/d/Y')}}" onchange="getscheduledata('normal');" >
							</div>
                         </div>
					</div>
					<div class="col-md-5 col-xs-12 col-sm-6">
                        <p><b>Today Date: {{$todaydate}}</b></p>
                    </div>
				</div>
				<div class="row">
					<div class="col-md-12 col-xs-12 col-sm-12">
						<div class="schedule-viewing">
							<label>Schedule Viewing Date: </label>
							<span id="spandate">{{$todaydate}}</span>
						</div>
						<div class="priceactivity-scheduler">
                            <select name="frm_servicesport" id="frm-servicesport" class="form-control valid" onchange="getscheduledata('stype',this.value);">
                                 <option value="all"> Show All Activities </option>
								 <option value="individual">Personal Trainer</option>
								 <option value="classes">Classes</option>
								 <option value="events">Events</option>
								 <option value="experience">Experience</option>
                            </select>
                       </div>
					</div>
				</div>
				<hr style="border: 1px solid #efefef; width: 115%; margin-left: -15px; margin-top: 5px;">
				<div class="row">
					<div class="col-md-12">
						<div class="row mobile-scheduler">
							<div class="col-md-1">
								<div class="scheduler-table-title">
									<label> Time </label>
								</div>
							</div>
							<div class="col-md-1">
								<div class="scheduler-table-title">
									<label>QTY</label>
								</div>
							</div>
							<div class="col-md-1">
								<div class="scheduler-table-title">
									<label>Duration</label>
								</div>
							</div>
							<div class="col-md-3">
								<div class="scheduler-table-title">
									<label> Scheduled Activity  </label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="scheduler-table-title">
									<label> Location </label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="scheduler-table-title">
									<label> Instructor </label>
								</div>
							</div>
						</div>

						<div id="bindscheduledata">
							@php $total_reservations = 0; @endphp
							@if(!empty($bookschedulers) && count($bookschedulers)>0)
								@foreach ($bookschedulers as $cs => $bookscheduler)
									@php $total_reservations += $bookscheduler->spots_reserved($filter_date);
										$date1 = date('H:i',strtotime($bookscheduler['shift_end']));
										$date2 = date('H:i');
										$cancel_chk = $bookscheduler->getcanceldata( $filter_date, $bookscheduler->id);
									 @endphp

									@php if($date1 < $date2){ @endphp
										<div class="overlay-activity">
										<label class="overlay-activity-label">Activity Completed</label>
									@php } else if($cancel_chk == 1) { @endphp
										<div class="overlay-activity">
										<label class="overlay-activity-label red-fonts">Activity Cancelled</label>
									@php } @endphp

	
									<div class="scheduler-info-box">
										<div class="row">
											<div class="col-md-1 col-xs-12 col-sm-4">
												<div class="timeline">
													<label class="scheduler-titles">Time: </label> <span> {{date('h:i A', strtotime($bookscheduler['shift_start']))}} </span>
													<span>{{date('h:i A', strtotime($bookscheduler['shift_end']))}}</span>
												</div>
											</div>
											<div class="col-md-1 col-xs-12 col-sm-4">	
												<a href="{{route('scheduler_checkin',['sid'=>$bookscheduler->id])}}" class="scheduler-qty">
													<label class="scheduler-titles">QTY: </label> <span> {{$bookscheduler->spots_left($filter_date)}}/{{$bookscheduler->spots_available}} </span>
												</a>
											</div>
											<div class="col-md-1 col-xs-12 col-sm-4">
												<div class="scheduled-activity-info">
													<label class="scheduler-titles"> Duration: </label> <span>{{$bookscheduler->get_clean_duration()}} </span>
												</div>
											</div>
											<div class="col-md-3 col-xs-12 col-sm-4">
												<div class="scheduled-activity-info">
													<label class="scheduler-titles"> Scheduled Activity: </label> <span> {{$bookscheduler->business_service->program_name}}</span>
												</div>
											</div>
											<div class="col-md-2 col-xs-12 col-sm-4">
												<div class="scheduled-location">
													<label class="scheduler-titles"> Location: </label> <span> {{$bookscheduler->business_service->activity_location}}</span>
												</div>
											</div>
											<div class="col-md-2 col-xs-12 col-sm-4">
												<div class="scheduled-location">
													<label class="scheduler-titles"> Instructor: </label><span> {{StaffMembers::getinstructorname($bookscheduler->business_service->instructor_id)}}</span>
												</div>
											</div>
											<div class="col-md-2 col-xs-12 col-sm-12">
												<form id="frmCompany<?=$cs?>" name="frmCompany<?=$cs?>" method="post" action="{{route('editBusinessService')}}">
													@csrf
													<div class="scheduled-btns">
														<input type="hidden" class="btn btn-black" name="btnedit" id="btnedit" value="Edit" />
									                    <input type="hidden" name="cid" value="{{ $bookscheduler->business_service->cid }}" style="width:50px" />
									                    <input type="hidden" name="serviceid" value="{{ $bookscheduler->business_service->serviceid }}" style="width:50px" />
														<button type="submit" class="btn-edit btn-sp">Edit</button>
														@if($date1 < $date2 )
															<button type="button" class="btn-edit" disabled>Cancel</button>
														@else
															<a class="btn-edit" onclick="getcancellationdata({{$bookscheduler->id}},'{{$bookscheduler->spots_reserved($filter_date)}}','{{StaffMembers::getinstructorname($bookscheduler->business_service->instructor_id)}}');">Cancel</a>
														@endif
														
													</div>
												</form>
											</div>
										</div>
									</div>
									@php if($date1 < $date2){ @endphp
										</div>
										
									@php }else if($cancel_chk == 1) { @endphp
										</div>
									@php } @endphp
								@endforeach
							@endif
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6 col-xs-12 col-sm-6">
						<div class="activities-details">
							<label>Total Activities Today: </label> <span id="sccount"> {{count($bookschedulers)}} </span>
							<label>Total Reservations Today:</label> <span id="rescount">{{$total_reservations}} </span>
						</div>
					</div>
					<div class="col-md-6 col-xs-12 col-sm-6">
						<div class="pre-next-btns pre-nxt-btn-space">
							<button class="btn-previous btn-sp" onclick="getscheduledata('previous');" style="background: darkgray;" disabled id="btn-pre"><i class="fas fa-caret-left preday-arrow" ></i>Previous Day</button>
							<button class="btn-previous"  onclick="getscheduledata('next');"  id="btn-next">Next Day <i class="fas fa-caret-right nextday-arrow"></i></button>
						</div>
					</div>
				</div>
				
			</div>	
		</div>

		<!-- The Modal Add Business-->
		<div class="modal fade compare-model in" id="bookingcancelmodel">
			<div class="modal-dialog bookingcancel">
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
							<div class="col-lg-12">
							   <h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 600; margin-top: 9px;">How Would You Like To Cancel This Activity?</h4>
							</div>
						</div>
						<hr style="border: 3px solid #ed1b24; width: 107%; margin-left: -15px; margin-top: 5px;">
						<div id="cancellationdata">
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end modal -->
	</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script type="text/javascript">
	jQuery.noConflict();
	function getcancellationdata(val,clientcnt,insname){
		date = $('#managecalendarservice').val();
		$.ajax({
			url:'{{route("cancelbookingmodel")}}',
			type:"POST",
			data:{
				date:date,
				sid: val,
				clientcnt: clientcnt,
				insname: insname,
				_token: '{{csrf_token()}}',
			},
			success:function(response){
				$("#bookingcancelmodel").modal('show')
				$('#cancellationdata').html(response);
			}
		});
	}

	function  getscheduledata(chk,val) {
		date = $('#managecalendarservice').val();
		$.ajax({
			url:'{{route("activity-scheduler")}}',
			type:"GET",
			data:{
				date:date,
				chk:chk,
				dropval:val,
			},
			success:function(response){
				var data = response.split('~');
				var data1 = data[0].split('^^');
				var data2 = data1[0].split('^');

				var data3 = data[1].split('$!^');
				$('#sccount').html(data2[1]);
				$('#rescount').html(data1[1]);
				$('#bindscheduledata').html(data2[0]);
				$('#spandate').html(data3[0]);
				if(data3[1] == 'notodaydate'){
					$('#btn-pre').prop('disabled', false);
					$('#btn-pre').css('background','#ed1b24');
				}else{
					$('#btn-pre').prop('disabled',true );
					$('#btn-pre').css('background','darkgray');
				}
			}
		});
	}
</script>

<script>
    $( function() {
        $( "#managecalendarservice" ).datepicker( { 
        	autoclose: true,
            minDate: 0,
            changeMonth: true,
            changeYear: true   
        } );
    } );
</script>
<script>
	$( function() {
		$( "#managecalendar" ).datepicker( { minDate: 0 } );
	} );
</script>
<script src="{{ url('public/js/jquery-ui.min.js') }}"></script>


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
        formdata.append('business_id', '{{$companyId}}')
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

<script type="text/javascript">
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -33.8688, lng: 151.2195},
            zoom: 13
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
              $('#b_address').val(sublocality_level_1);
            }else{
              $('#b_address').val(badd);
            }
            
        
           /* $('#lat').val(place.geometry.location.lat());
            $('#lon').val(place.geometry.location.lng());*/
        });
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCr7-ilmvSu8SzRjUfKJVbvaQZYiuntduw&callback=initMap" async defer></script>

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

@include('layouts.footer')

@endsection