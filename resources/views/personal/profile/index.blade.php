@inject('request', 'Illuminate\Http\Request')

@extends('layouts.business.header')

@section('content')

	@include('layouts.profile.business_topbar')
	<!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				 <div class="position-relative mx-n4 mt-n4">
					<div class="profile-wid-bg profile-setting-img">
						<img src="@if($user->getCoverPic()) {{$user->getCoverPic()}} @else 'assets/images/profile-bg.jpg' @endif" class="profile-wid-img" alt="">
						<!-- <img src="assets/images/profile-bg.jpg" class="profile-wid-img" > -->
						<div class="overlay-content">
							<div class="text-end p-3">
								<form id="image-upload-form1" action="{{Route('personal.profile.update',['profile'=> $user->id])}}" method="post" enctype="multipart/form-data">
									@method('PUT')
									@csrf
									<div class="p-0 ms-auto rounded-circle profile-photo-edit">
										<input id="profile-foreground-img-file-input" type="file" class="profile-foreground-img-file-input" name="coverPic">
										<label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light"><i class="ri-image-edit-line align-bottom me-1"></i> Change Cover
										</label>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-xxl-3 col-lg-3">
						<div class="card mt-n5">
							<div class="card-body p-4">
								<div class="text-center">
									<div class="profile-user position-relative d-inline-block mx-auto  mb-4">
										@if($user->getPic())
											<img src="{{$user->getPic()}}" class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow" alt="user-profile-image">
										@else
											<div class="rounded-circle avatar-xl img-thumbnail user-profile-image shadow no-img-latter">
												<p class="character character-renovate">{{$user->first_letter}}</p>
											</div>
										@endif
										
										<form id="image-upload-form" action="{{Route('personal.profile.update',['profile'=> $user->id])}}" method="post" enctype="multipart/form-data">
											@method('PUT')
											@csrf
											<div class="avatar-xs p-0 rounded-circle profile-photo-edit">
												<input id="profile-img-file-input" name ="profile_pic" type="file" class="profile-img-file-input">
												<label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
													<span class="avatar-title rounded-circle bg-light text-body shadow">
														<i class="ri-camera-fill"></i>
													</span>
												</label>
											</div>
										</form>
									</div>
									<h5 class="fs-16 mb-1">{{$user->full_name}}</h5>
								</div>
							</div>
						</div><!--end card-->

						<div class="card">
							<div class="card-body">
								<div class="d-flex align-items-center mb-4">
									<div class="flex-grow-1">
										<h5 class="card-title mb-0">Portfolio</h5>
									</div>
								</div>
								<div class="mb-3 d-flex">
									<div class="avatar-xs d-block flex-shrink-0 me-3">
										<span class="avatar-title rounded-circle fs-16 bg-primary shadow">
											<i class="ri-global-fill"></i>
										</span>
									</div>
									<input type="text" class="form-control" id="website" placeholder="www.example.com" value="{{$user->website}}">
								</div>
								<div class="mb-3 d-flex">
									<div class="avatar-xs d-block flex-shrink-0 me-3">
										<span class="avatar-title rounded-circle fs-16 bg-twitter-blue text-light shadow">
											<i class="fab fa-twitter"></i>
										</span>
									</div>
									<input type="email" class="form-control" id="twitter" placeholder="Twitter" value="{{$user->twitter}}">
								</div>
								
								<div class="mb-3 d-flex">
									<div class="avatar-xs d-block flex-shrink-0 me-3">
										<span class="avatar-title rounded-circle fs-16 bg-dark shadow">
											<i class="fab fa-instagram"></i>
										</span>
									</div>
									<input type="text" class="form-control" id="insta" placeholder="Instagram" value="{{$user->insta}}">
								</div>
								<div class="d-flex">
									<div class="avatar-xs d-block flex-shrink-0 me-3">
										<span class="avatar-title rounded-circle fs-16 shadow">
											<i class="fab fa-facebook-f"></i>
										</span>
									</div>
									<input type="text" class="form-control" id="facebook" placeholder="Facebook" value="{{$user->facebook}}">
								</div>
							</div>
						</div><!--end card-->
					</div><!--end col-->

					

					<div class="col-xxl-9 col-lg-9">
						<div class="card mt-xxl-n5 mt-n5">
							<div class="card-header">
								<ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
									<li class="nav-item">
										<a class="nav-link active text-black" data-bs-toggle="tab" href="#personalDetails" role="tab">
											<i class="fas fa-home"></i> Personal Details
										</a>
									</li>
									<li class="nav-item">
										<a class="nav-link text-black" data-bs-toggle="tab" href="#changePassword" role="tab">
											<i class="far fa-user"></i> Change Password
										</a>
									</li>
								</ul>
							</div>
							<div class="card-body p-4">
								<div class="tab-content">

									<div class="col-md-12">
				                        @if(session()->has('success'))
				                        <div class="alert alert-success fade in alert-dismissible show"> {{ session()->get('success') }}  </div>
				                        @elseif(session()->has('error'))
				                        <div class="alert alert-danger fade in alert-dismissible show"> {{ session()->get('error') }}</div>
				                        @endif
			                    	</div>
									<div class="tab-pane active" id="personalDetails" role="tabpanel">
										<form  action="{{Route('personal.profile.update',['profile'=> $user->id])}}" method="post" enctype="multipart/form-data">
											@method('PUT')
											@csrf
											<input type="hidden" name="type" value="details">
											<div class="row">
												<div class="col-lg-4">
													<div class="mb-3">
														<label for="firstnameInput" class="form-label">First Name</label>
														<input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter your firstname" value="{{ $user->firstname}}" required>
													</div>
												</div><!--end col-->

												<div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="lastnameInput" class="form-label">Last Name</label>
                                                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter your lastname" value="{{ $user->lastname}}" required>
                                                    </div>
                                                </div><!--end col-->

                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="emailInput" class="form-label">Email Address</label>
                                                        <input type="email" class="form-control" placeholder="Enter your email" readonly value="{{ $user->email}}">
                                                    </div>
                                                </div><!--end col-->

												<div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="phonenumberInput" class="form-label">Phone Number</label>
                                                        <input type="text" class="form-control"name="phone_number" id="phone_number" placeholder="Enter your phone number" value="{{ $user->phone_number}}" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="14" data-behavior="text-phone">
                                                    </div>
                                                </div><!--end col-->

												<div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="websiteInput1" class="form-label">User Name </label>
                                                        <input type="text" class="form-control" placeholder="" value="{{ $user->username}}" readonly />
                                                    </div>
                                                </div><!--end col-->

                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="JoiningdatInput" class="form-label">Date of Birth</label>
                                                        <input type="text" class="form-control flatpickr" name="birthdate" placeholder="Birth Date" value="{{$user->birthdate}}" />

														<div class="dob-radio mt-10">
															<input type="radio" class="radio-dots" name="dobstatus" value="0" @if($user->dobstatus == 0) checked @endif>
															<label style="font-weight: normal;">Show</label>
															<input type="radio" class="radio-dots" name="dobstatus" value="1" @if($user->dobstatus == 1) checked @endif>
															<label style="font-weight: normal;">Hide</label>
														</div>
                                                    </div>
                                                </div><!--end col-->

                                                <div class="col-lg-4">
													<div class="steps-title mmb-10">
														<div class="mb-3">
															<label for="JoiningdatInput" class="form-label"> Gender </label>
															<select name="gender" id="gender" class="form-select data-choices">
																<option value="male" {{strtolower($user->gender) == 'male' ? 'selected' : ''}}> Male </option>
																<option value="female" {{strtolower($user->gender) == 'female' ? 'selected' : ''}}>Female</option>
																<option value="other" {{strtolower($user->gender) == 'other' ? 'selected' : ''}}>Other</option>
															</select>
														</div>
													</div>
                                                </div> <!--end col-->

												<div class="col-lg-8">
                                                    <div class="mb-3">
                                                        <label for="address" class="form-label">Address</label>
                                                        <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="{{$user->address}}" />
                                                    </div>
                                                </div><!--end col-->

                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="City" class="form-label">City</label>
                                                        <input type="text" class="form-control" name="city" id="city" placeholder="City" value="{{$user->city}}" />
                                                    </div>
                                                </div><!--end col-->

												<div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="State" class="form-label">State</label>
                                                        <input type="text" class="form-control" name="state" id="state"  placeholder="State" value="{{$user->state}}" />
                                                    </div>
                                                </div>   <!--end col-->

                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="country" class="form-label">Country</label>
                                                        <input type="text" class="form-control" name="country" id="country"placeholder="Country" value="{{$user->country}}" />
                                                    </div>
                                                </div><!--end col-->

                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="zipcodeInput" class="form-label">Zip Code</label>
                                                        <input type="text" class="form-control" minlength="5" maxlength="6" name="zipcode" id="zipcode"  placeholder="Enter zipcode" value="{{$user->zipcode}}">
                                                    </div>
                                                </div><!--end col-->

												<div class="col-lg-8">
                                                    <div class="mb-3">
                                                        <label for="favorit_activity" class="form-label">Favorite Activities </label>
                                                        <input type="text" class="form-control" id="favorit_activity" name="favorit_activity" placeholder="Favorite Activities" value="{{$user->favorit_activity}}">
                                                    </div>
                                                </div><!--end col-->

                                                <div class="col-lg-12">
												    <div class="mb-3 pb-2">
												        <label for="about_user" class="form-label">About</label>
												        <textarea class="form-control about_user" id="about_user"  name="about_user" placeholder="Enter your description" rows="3" maxlength="1000">{{$user->business_info}}</textarea>
												        <span class="float-right">
												            <span id="count_user">0</span> words. Words left: <span id="word_left_about">1000</span>
												        </span>
												    </div>
												</div>

												<div class="col-lg-12">
												    <div class="mb-3 pb-2">
												        <label for="user_intro" class="form-label">Quick Intro</label>
												        <textarea class="form-control user_intro" name="user_intro" id="user_intro" placeholder="Enter your description" rows="3" maxlength="200">{{$user->quick_intro}}</textarea>
												        <span class="float-right">
												            <span id="count_intro">0</span> words. Words left: <span id="word_left">200</span>
												        </span>
												    </div>
												</div>
                                                <div class="col-lg-12">
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <button type="submit" class="btn btn-red">Updates</button>
                                                    </div>
                                                </div><!--end col-->
                                            </div><!--end row-->
                                        </form>
                                    </div><!--end tab-pane-->

                                    <div class="tab-pane" id="changePassword" role="tabpanel">
                                        <form id="password-update-form" action="{{Route('personal.profile.update',['profile'=> $user->id])}}" method="post" enctype="multipart/form-data">
											@method('PUT')
                                         	@csrf
                                         	<div class="mb-10">
                                         		<span class="help-block font-red">
		                                            <strong id="password-error"></strong>
		                                        </span>
                                         	</div>
                                         	<input type="hidden" name="type" value="password">
                                            <div class="row g-2">
                                                <div class="col-lg-4">
                                                    <div>
                                                        <label for="currentPassword" class="form-label">Old Password<span class="font-red">*</span></label>
                                                        <input type="password" class="form-control" id="currentPassword"  name="currentPassword" placeholder="Enter current password"  required>
                                                    </div>
                                                </div> <!--end col-->

                                                <div class="col-lg-4">
                                                    <div>
                                                        <label for="newPassword" class="form-label">New Password<span class="font-red">*</span></label>
                                                        <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter new password" required>
                                                    </div>
                                                </div><!--end col-->

                                                <div class="col-lg-4">
                                                    <div>
                                                        <label for="confirmPassword" class="form-label">Confirm Password<span class="font-red">*</span></label>
                                                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm password" required>
                                                    </div>
                                                </div> <!--end col-->

                                                <div class="col-lg-12">
                                                    <div class="text-end">
                                                        <button type="submit" class="btn btn-red">Change Password</button>
                                                    </div>
                                                </div><!--end col-->
                                            </div> <!--end row-->
                                        </form>
                                    </div><!--end tab-pane-->
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!-- container-fluid -->
		</div><!-- End Page-content -->
    </div><!-- end main content-->
</div><!-- END layout-wrapper -->


@include('layouts.business.footer')
<script type="text/javascript">

    var user_intro = $("#user_intro").val();
    var business_info = $("#about_user").val();
    $('#count_intro').text(user_intro.length);
    $('#word_left').text(200-parseInt(user_intro.length));
    $('#count_user').text(business_info.length);
    $('#word_left_about').text(1000-parseInt(business_info.length));

    $("#user_intro").on('input', function() {
        $('#count_intro').text(this.value.length);
        $('#word_left').text(200-parseInt(this.value.length));
    });
    $("#about_user").on('input', function() {
        $('#count_user').text(this.value.length);
        $('#word_left_about').text(1000-parseInt(this.value.length));
    });

    $("#password-update-form").submit(function(event) {
        var newPassword = $("#newPassword").val();
        var confirmPassword = $("#confirmPassword").val();

        if($("#currentPassword").val() == ''){
        	$('#password-error').html("Current Password is required.");
        }if($("#newPassword").val() == ''){
        	$('#password-error').html("New Password is required.");
        }else if (newPassword !== confirmPassword) {
            $('#password-error').html("New Password and Confirm Password must match.");
            event.preventDefault(); // Prevent the form from submitting
        }
    });

    $('#profile-img-file-input').change(function() {
        // Trigger form submission when an image is selected
        $('#image-upload-form').submit();
    });

    $('#profile-foreground-img-file-input').change(function() {
        // Trigger form submission when an image is selected
        $('#image-upload-form1').submit();
    });

	$(document).on('blur', '#website', function() {
		var id= "{{$user->id}}";
	    $.ajax({
	    	url: "{{route('personal.updatePortfolio')}}",
            type: "POST",
         	data: {
	            _token: "{{ csrf_token() }}",
	            id: "{{@$user->id}}",
	            website: $(this).val(),
	            type: 'portfolio',
	   		},
         	success: function (data) {
         	}
      	});
	});


	$(document).on('blur', '#twitter', function() {
		var id= "{{$user->id}}";
	    $.ajax({
	    	url: "{{route('personal.updatePortfolio')}}",
            type: "POST",
         	data: {
	            _token: "{{ csrf_token() }}",
	            id: "{{@$user->id}}",
	            twitter: $(this).val(),
	            type: 'portfolio',
	   		},
         	success: function (data) {
         	}
      	});
	});
	$(document).on('blur', '#facebook', function() {
		var id= "{{$user->id}}";
	    $.ajax({
	    	url: "{{route('personal.updatePortfolio')}}",
            type: "POST",
         	data: {
	            _token: "{{ csrf_token() }}",
	            id: "{{@$user->id}}",
	            facebook: $(this).val(),
	            type: 'portfolio',
	   		},
         	success: function (data) {
         	}
      	});
	});

	$(document).on('blur', '#insta', function() {
		var id= "{{$user->id}}";
	    $.ajax({
	    	url: "{{route('personal.updatePortfolio')}}",
            type: "POST",
         	data: {
	            _token: "{{ csrf_token() }}",
	            id: "{{@$user->id}}",
	            insta: $(this).val(),
	            type: 'portfolio',
	   		},
         	success: function (data) {
         	}
      	});
	});

</script>

<script>
	flatpickr(".flatpickr", {
		altInput:true,
        dateFormat: "Y-m-d",
        altFormat: "m/d/Y",
    });

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 13
        });
        var input = document.getElementById('address');
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
                  $('#zipcode').val(place.address_components[i].long_name);
                }
           
                if(place.address_components[i].types[0] == 'locality'){
                    $('#city').val(place.address_components[i].long_name);
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
                if(place.address_components[i].types[0] == 'country'){
                    $('#country').val(place.address_components[i].long_name);
                }
                if(place.address_components[i].types[0] == 'administrative_area_level_1'){
                    $('#state').val(place.address_components[i].long_name);
                }
            }
            if(badd == ''){
              $('#address').val(sublocality_level_1);
            }else{
              $('#address').val(badd);
            }
            
            $('#lat').val(place.geometry.location.lat());
            $('#lon').val(place.geometry.location.lng());
            
        });
    }
</script>

@endsection
