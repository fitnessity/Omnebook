@extends('layouts.header')
@section('content')
@include('layouts.userHeader')
@php 
	use Carbon\Carbon;
@endphp
<div class="p-0 col-md-12 inner_top padding-0">
    <div class="row">
        <div class="col-md-2 col-sm-12" style="background: black;">
        	 @include('business.businessSidebar')
        </div>
		<div class="col-md-10 col-sm-12">
      <div class="container-fluid p-0">
	 			
	 			<div class="row">
	 				<div class="col-md-4 col-xs-12">
	 					<div class="tab-hed ">Manage Customers</div>
	 				</div>
	 				<div class="col-md-8 col-xs-12">
	 					@include('customers._search_header', ['company_id' => $company->id])
	 				</div>
	 			</div>
				<hr style="border: 3px solid black; width: 115%; margin-left: -38px; margin-top: 5px;">
      </div>

			<div id="systemMessage1" style="padding-top:10px;"></div>
			<div class="row">
				<div class="col-md-6 col-xs-12">
				</div>
				<div class="col-md-6 col-xs-12">
					<div class="staff-main">
						<button href="#" data-toggle="modal" data-target="#exampleModal"  class="btn-bck btn-black">Import List</button>
						<form method="get" action='{{route("export")}}'>
							<input type="hidden" name="chk" id="chk" value="empty">
							<input type="hidden" name="id" id="id" value="{{$company->id}}">
							<button type="submit" class="btn-nxt" >Export List</button> 
						</form>
						
						<!-- <button type="button" class="btn-nxt" onclick="exportcustomer();">Export List</button> -->
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 col-xs-12" id="customerlist">
					<div class="total-clients">
						<i class="fas fa-user-circle"></i>
						<label>You Have {{$customer_count}} Clients</label>
					</div>
					<div class="panel-group" id="accordion-customer">

						@foreach ($grouped_customers as $section_letter => $customers) 
							<div class="custom-panel panel panel-default">
								<div class="custom panel-heading">
									<h4 class="panel-title">
										<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-customer" href="#collapse_{{$section_letter}}">
										{{$section_letter}}
										</a>
									</h4>
								</div>
								<div id="collapse_{{$section_letter}}" class="panel-collapse collapse" data-parent="#accordion-customer">
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												@foreach ($customers as $customer) 
												<div class="collapse-inner-box mrb-2">
													<div class="row">
														<div class="col-md-1 col-xs-4 col-sm-2">
															<div class="collapse-img">
																@if($customer->profile_pic)
																	<img src="{{Storage::Url($customer->profile_pic)}}" class="imgboxes" alt="">
																@else
																	<div class="company-list-text"><p>{{$customer->fname[0]}}</p></div>
																@endif
															</div>
														</div>
														<div class="col-md-2 col-xs-8 col-sm-2">
															<div class="client-name">
																<span>{{$customer->fname}} {{$customer->lname}}</span>
																<p>Last Attended: {{$customer->get_last_seen()}}</p>
															</div>
														</div>
														<div class="col-md-1 col-xs-12 col-sm-1">
															<div class="client-age">
																<span>Age: 
																	@if($customer->age)
																		{{$customer->age}}
																	@else
																		-
																	@endif
																</span>
															</div>
														</div>
														<div class="col-md-2 col-xs-12 col-sm-2">
															<div class="client-status">
																<label>Status: </label>
																
																<span class="green-fonts">
																	@if($customer->is_active() == 0)
																		InActive
																	@else
																		Active
																	@endif</span>
															</div>
														</div>
														<div class="col-md-2 col-xs-12 col-sm-3">
															<div class="client-status">
																<label>Active Memberships: </label>
																<span class="green-fonts">{{$customer->active_memberships()}}</span>
															</div>
														</div>
														<div class="col-md-1 col-xs-12 col-sm-2">
															<div class="client-status">
																<label>Expiring Soon: </label>
																<span class="red-fonts">{{$customer->expired_soon()}}</span>
															</div>
														</div>
														<div class="col-md-2 col-xs-12 col-sm-6">
															<div class=" scheduled-btns">
																<button onclick="sendmail({{$customer->id}},{{$company->id}});" class="btn-edit btn-sp">Send Welcome Email</button>
																<a href="{{ route('business_customer_show',['business_id' => $company->id, 'id'=>$customer->id]) }}" class="btn-edit">View</a>
															</div>
														</div>
														<div class="col-md-1 col-xs-12 col-sm-6">
															<div class=" scheduled-btns">
																<a href="{{ route('business_customer_delete',['business_id' =>$company->id, 'id'=>$customer->id]) }}" class="delcustomer">
																	<i class="fa fa-trash"></i></a>
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
								$("#collapse_{{$section_letter}}").click(function(){
									$(".panel-collapse").removeClass('show in');
									$("#collapse_{{$section_letter}}").addClass('show in');
								});
							</script>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="exampleModalLabel">Upload File for Customer</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
              <label>Choose File: </label>
              <input type="file" name="file" id="file" onchange="readURL(this)" />
              <p class='err' style="color:red;padding-top:10px;"></p>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="upload-csv" class="btn btn-secondary">Upload File</button>
        </div>
      </div>
    </div>
</div>
</div>


<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>-->
@include('layouts.footer')

<script>
	$(document).on('click', '.delcustomer', function(e){
		e.preventDefault();

		var token = $("meta[name='csrf-token']").attr("content");
		let data_row = $(this).parents('.collapse-inner-box');
    $.ajax({
      url: $(this).attr('href'),
      type: 'DELETE',
      data: {
          "_token": token,
      },
      success: function (){
          data_row.remove();
      }
    });
	});
</script>
<script>
  	var profile_pic_var = '';
  	var ext = '';

  	function readURL(input) {
	    if (input.files && input.files[0]) {
	      const name = input.files[0].name;
	      const lastDot = name.lastIndexOf('.');
	      const fileName = name.substring(0, lastDot);
	      ext = name.substring(lastDot + 1);
	      //console.log(ext)
	      var reader = new FileReader();
	      reader.onload = function (e) {
	      };
	      profile_pic_var = input.files[0];
	      reader.readAsDataURL(input.files[0]);
	    }
  	} 

</script>
<script type="text/javascript">
	$(document).ready(function () {
		  $("#collapse_A").addClass('show in');
      $('#upload-csv').click(function(){
        	if(profile_pic_var == ''){
        		$('.err').html('Select file to upload.');
        	}else if(ext != 'csv' && ext != 'csvx' && ext != 'xls' && ext != 'xlsx'){
            	$('.err').html('File format is not supported.')
        	}else{
            	var formdata = new FormData();
            	formdata.append('import_file',profile_pic_var);
            	formdata.append('business_id','{{$company->id}}');
             	formdata.append('_token','{{csrf_token()}}')
             	$.ajax({
                  url:'/import-customer',
                  type:'post',
                  dataType: 'json',
                  enctype: 'multipart/form-data',
                  data:formdata,
                  processData: false,
                  contentType: false,
                  headers: {'X-CSRF-TOKEN': $("#_token").val()},
                  beforeSend: function () {
                     $('.loader').show();
                  },
                  complete: function () {
                     $('.loader').hide();
                  },
                  success: function (response) { 
                      if(response.status == 200){
                          $('#exampleModal').modal('hide');
                          $('#systemMessage1').html(response.message).addClass('alert alert-success');
                          setTimeout(function(){
                              window.location.reload();
                          },2000)
                      }
                      else{
                      	$('#systemMessage1').html(response.message).addClass('alert alert-danger alert-dismissible');
                          $('#file').val('')
                          $('#exampleModal').modal('hide');
                      }
                  }
            	});
        	}
    	})
	});

	function  sendmail(cid,bid) {
		$.ajax({
			url:'{{route("sendemailtocutomer")}}',
			type:"GET",
			xhrFields: {
                withCredentials: true
            },
			data:{
				cid:cid,
				bid:bid,
			},
			success:function(response){
				if(response == 'success'){
                    //$('.reviewerro').html('Email Successfully Sent..');
                  alert('Email Successfully Sent..');
                }else{
                    //$('.reviewerro').html("Can't Mail on this Address. Plese Check your Email..");
                  alert("Can't Mail on this Address. Plese Check Email..");
                }
			}
		});
	}
</script>

<script src="{{asset('/public/js/compare/jquery-1.9.1.min.js')}}"></script>

<script src="{{ url('public/js/jquery.payform.min.js') }}" charset="utf-8"></script>
 

<!-- <script src="{{ url('/public/js/front/jquery-ui.js') }}"></script>
<link href="{{ url('/public/css/frontend/jquery-ui.css') }}" rel="stylesheet" type="text/css" media="all"/> -->
<script type="text/javascript">
	
	$(document).ready(function () {
		var business_id = '{{$company->id}}';
		var url = "{{ url('/business/business_id/customers') }}";
		url = url.replace('business_id', business_id);

    	$( "#clients_name" ).autocomplete({
      		source: url,
      		focus: function( event, ui ) {
      			 return false;
        	},
        	select: function( event, ui ) {
        		var cName = ui.item.fname +' '+ ui.item.lname
	            $('#clients_name').val(cName); 
	        }
    	}).autocomplete( "instance" )._renderItem = function( ul, item ) {
        return $( "<li></li>" )
        .append( "<p>" + item.fname + " " + item.lname + "</p>" )
        .appendTo( ul );
	    };
  	});
</script>

<script type="text/javascript">
	/*$("#business_name").keyup(function() {
      $.ajax({
          type: "POST",
          url: "/searchcustomersaction",
          data: { query: $(this).val(),  _token: '{{csrf_token()}}', },
         
          success: function(data) {
              $("#option-box").show();
              $("#option-box").html(data);
              $("#business_name").css("background", "#FFF");
          }
      });
  	});*/

	function registerUser() {
    	
        var validForm = $('#frmregister').valid();
        var posturl = '/customers/registration';
        if (!jQuery("#b_trm1").is(":checked")) {
           $("#termserror").html('Plese Agree Terms of Service and Privacy Policy.').addClass('alert-class alert-danger');
            return false;
        }
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
                
                    $('#register_submit').prop('disabled', false).css('background','#ed1b24');
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
              password: "required",
              email: {
                  required: true,
                  email: true
              },
          },
          messages: {
              firstname: "Enter your Firstname",
              lastname: "Enter your Lastname",
              username: "Enter your Username",
              username: "Enter your Password",
              email: {
                  required: "Please enter a valid email address",
                  minlength: "Please enter a valid email address",
                  remote: jQuery.validator.format("{0} is already in use")
              },
          },
          submitHandler: registerUser
      });
  	});

    /*$('#email').on('blur', function() {
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
  	});*/

    $(document).on('click', '#step3_next', function () {
        $("#err_gender").html("");
   
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
	    	$('#familyerrormessage').html("Looks like some of the fields aren't filled out correctly. They're highlighted in red.");
	    	return false;
	    }else{

	        var form = $('#familyform')[0];
	        var posturl = '/submitfamilyCustomer';
	        var formdata = new FormData(form);
	        formdata.append('_token', '{{csrf_token()}}')
	        formdata.append('cust_id', $('#cust_id').val())
	        formdata.append('business_id', '{{$company->id}}')
	     
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
        }
    });

    $(document).on('click', '#skip5_next', function () {
    	window.location.href = '/business/{{$company->id}}/customers/'+$('#cust_id').val();
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