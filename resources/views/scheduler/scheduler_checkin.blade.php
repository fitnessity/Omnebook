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
				<hr style="border: 3px solid black; width: 123%; margin-left: -38px; margin-top: 5px;">
			  </div>
			  <div class="container-fluid plr-0">
				<div class="row">
					<div class="col-md-4 col-xs-12 col-sm-5">
						 <div class="scheduler-info">
                            <label>Program Name: </label><span>{{$servicedata->program_name}} </span>
                         </div>
						 <div class="scheduler-info">
                            <label>Date: </label><span>{{$todaydate}} </span>
                         </div>
						 <div class="scheduler-info">
                            <label>Time: </label><span>{{date('h:i A', strtotime($schedule_data->shift_start))}}  - {{date('h:i A', strtotime($schedule_data->shift_end))}}</span>
                         </div>
						 <div class="scheduler-info">
                            <label>Duration:  </label><span>{{$schedule_data->get_clean_duration()}} </span>
                         </div>
						 <div class="scheduler-info">
                            <label>Spots: </label><span>{{$schedule_data->spots_left($filter_date)}}/{{$schedule_data->spots_available}} </span>
                         </div>
					</div>
					<div class="col-md-3 col-sm-12 col-sm-6">
                        <div class="manage-search manage-space">
							<form method="get" action="/activities/">
								<input type="text" name="bookingclient" id="bookingclient" placeholder="Search for client" autocomplete="off" value="">
								<button id="serchbtn"><i class="fa fa-search"></i></button>
							</form>
						</div>
                    </div>
				</div>
				
				<hr style="border: 1px solid #efefef; width: 115%; margin-left: -15px; margin-top: 5px;">
				@if(session('success'))
			     <span class="alert alert-success" role="alert" style=" padding: 6px;">
			         <strong>{{ session('success') }}</strong>
			     </span>
				@endif
				<div class="row">
					<div class="col-md-12">
						<div class="row mobile-scheduler">
							<div class="col-md-2">
								<div class="scheduler-table-title">
									<label>  </label>
								</div>
							</div>
							<div class="col-md-1">
								<div class="scheduler-table-title">
									<label></label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="scheduler-table-title">
									<label>Client Name  </label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="scheduler-table-title">
									<label> Price Title  </label>
								</div>
							</div>
							<div class="col-md-2">
								<div class="scheduler-table-title">
									<label>  Remaining   </label>
								</div>
							</div>
							<div class="col-md-1">
								<div class="scheduler-table-title">
									<label> Expiration</label>
								</div>
							</div>
						</div>
						
						<div id="schedulelist">
							@if(!empty($bookingdata) && count($bookingdata) > 0)
							@foreach($bookingdata as $bd)
				
							<div class="scheduler-info-box">
								<div class="row">
									<div class="col-md-2 col-xs-12 col-sm-4">
										<div class="scheduler-border scheduler-label">
											<a><i class="fas fa-times"></i></a>
											<div class="checkbox-check">
												
												<input type="checkbox" id="check_in" name="check_in" value="1" data-oid="{{$bd->id}}" data-bookingid="{{$bd->booking_id}}"  @if($bd->getBookingCheckinDetails() == 1) checked @endif >
												<label for="check_in"> Check In</label><br>
												
												<input type="checkbox" id="late_cancel" name="late_cancel" value="1" data-behavior="show_latecancel" data-bookingid="{{$bd->id}}" data-oid="{{$bd->booking_id}}">
												<label for="late_cancel"> Late Cancel</label><br>
											</div>
										</div>
									</div>
									
									<div class="col-md-1 col-xs-3 col-sm-4">	
										<div class="scheduler-qty">
											<span> {{$bd->booking->user->firstname[0]}}{{$bd->booking->user->lastname[0]}}</span>
										</div>
									</div>
									<div class="col-md-2 col-xs-9 col-sm-4">
										<div class="scheduled-activity-info">
											<label class="scheduler-titles">Client Name: </label> <span>{{$bd->booking->user->firstname}} {{$bd->booking->user->lastname}}</span>
										</div>
									</div>
									<div class="col-md-2 col-xs-12 col-sm-4">
										<div class="scheduled-activity-info">
											<div class="price-mobileview">
												<label class="scheduler-titles">Price Title:</label>
												<select name="frm_servicesport" id="frm-servicesport" class="form-control valid price-info">
													@foreach($pricrdropdown as $bp)
													 <option value="{{$bp['id']}}" @if($bd->priceid == $bp['id']) selected @endif>{{$bp['price_title']}}</option>
													@endforeach
												</select>
											</div>
										</div>
									</div>
									<div class="col-md-2 col-xs-12 col-sm-4">
										<div class="scheduled-location">
											<label class="scheduler-titles">Remaining: </label> <span>{{$bd->pay_session}}/{{$schedule_data->spots_available}}</span>
										</div>
									</div>
									<div class="col-md-1 col-xs-12 col-sm-4">
										<div class="scheduled-location">
											<label class="scheduler-titles">Expiration: </label><span> {{date('m/d/Y',strtotime($bd->expired_at))}} </span>
										</div>
									</div>
									<div class="col-md-2 col-xs-12 col-sm-12">
										<div class="scheduled-btns">
											<a href="{{route('activity_purchase',['book_id'=>$bd->id])}}" class="btn-edit btn-sp">Purchase</a>
											<button type="button" class="btn-edit">View Account</button>
										</div>
									</div>
								</div>
							</div>
							@endforeach
							@endif
						</div>
					</div>
				</div>				
			</div>	
		</div>
	</div>
</div>
<!-- The Modal Add Business-->
		<div class="modal fade compare-model" id="latecancel">
			<div class="modal-dialog latecancel">
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
							   <h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 600; margin-top: 9px; margin-bottom: 10px;">What happens if a customer late cancels or no show? </h4>
							</div>
						</div>
						<div class="row">
							<form method="post" action="{{route('booking_activity_cancel')}}">
								@csrf
								<input type="hidden" name="booking_id" id="booking_id" value="">
								<input type="hidden" name="pageid" id="pageid" value="{{@$schedule_data->id}}">
								<input type="hidden" name="order_detail_id" id="order_detail_id" value="">
								<div class="col-md-12">
									<div class="latecancle-types" >
									</div>
									<button type="submit" class="btn-nxt manage-cus-btn cancel-modal">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end modal -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
@include('layouts.footer')

<script type="text/javascript">
	$(document).on('change', 'input[data-behavior="show_latecancel"]', function(){
		if($(this).is(':checked')){
			$.ajax({
					url:"/getbookingcancelmodel",
					type: "POST",
					data:{
							_token: '{{csrf_token()}}', 
							oid:$(this).attr("data-oid"),
							order_detail_id:$(this).attr("data-bookingid"),
					},
					success:function(response) {
							$('.latecancle-types').html(response);
							$('#latecancel').modal('show');
					}
			});
			$('#booking_id').val($(this).attr("data-oid"));
			$('#order_detail_id').val($(this).attr("data-bookingid"));
			
		}
	});

	$(document).on('change', 'input[id="check_in"]', function(){
			var checkin  = '';
			if($(this).is(':checked')){
				 checkin = '1';
			}else{
					checkin = '0';
			}

			$.ajax({
					url:"{{route('check_in_activity')}}",
					type: "POST",
					data:{
							_token: '{{csrf_token()}}', 
							oid:$(this).attr("data-bookingid"),
							order_detail_id:$(this).attr("data-oid"),
							checkin:checkin,
					},
					success:function(response) {
							// window.location.reload();
					}
			});
	});

	$(document).on('click', 'input[name="cancel_charge_action"]', function(){
				if($(this).val() == 'charge_fee_on_card'){
        	$('#cardinfodiv').css('display','block');
        	$("#cancel_charge_amt").attr('required', ''); 
        }else{
					$('#cardinfodiv').css('display','none');
        }
		});

		$(document).on('click', 'input[name="cardinfo"]', function(){
			$('#card_idval').val($(this).attr("card-id"));        	
		})


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

  	$("#bookingclient").keyup(function() {
      	$.ajax({
          	type: "POST",
          	url: "/searchcustomerbooking",
          	data: { 
          		query: $(this).val(),  
          		_token: '{{csrf_token()}}', 
          		sid: '{{@$schedule_data->id}}', 
          	},
          	beforeSend: function() {
              	//$("#label").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
          	},
          	success: function(data) {
              	// $("#schedulelist").html(data);
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
			url:'{{route("business_customer_index", ["business_id" => $companyId])}}',
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

@endsection