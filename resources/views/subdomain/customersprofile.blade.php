@inject('request', 'Illuminate\Http\Request')
@extends('subdomain.layouts.header')

@section('content')
    <div class="main-content">
		<div class="mt-3">
			<div class="container-fluid">
				 <div class="position-relative mx-n4 mt-n4">
					<div class="profile-wid-bg profile-setting-img"></div>
				</div>
				<div class="row">
					<div class="col-xxl-3 col-lg-3">
						<div class="card mt-n5">
							<div class="card-body p-4">
								<div class="text-center">
									<div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                        @if($user->profile_pic_url)
                                            <img src="{{$user->profile_pic_url}}" class="rounded-circle avatar-xl img-thumbnail user-profile-image  shadow" alt="user-profile-image">
                                        @else
                                            <div class="rounded-circle avatar-xl img-thumbnail user-profile-image shadow no-img-latter">
                                                <p class="character character-renovate">{{$user->first_letter}}</p>
                                            </div>
                                        @endif										
                                        {{-- <form id="imageform" action="{{Route('customer_profile_update')}}" method="post" enctype="multipart/form-data"> --}}
                                            <form id="imageform" enctype="multipart/form-data">
											@csrf
											<div class="avatar-xs p-0 rounded-circle profile-photo-edit">
												<input type="hidden" name ="id" value="{{$user->id}}">
                                                <input type="hidden" name="type" value="photo">
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
					</div>
                    <!--end col-->

					<div class="col-xxl-9 col-lg-9">
						<div class="card mt-xxl-n5 mt-n5">
							<div class="card-header">
								<ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
									<li class="nav-item">
										<a class="nav-link active text-black" data-bs-toggle="tab" href="#personalDetails" role="tab">
											<i class="fas fa-home"></i> Personal Details
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
                                        <div id="message"></div>
			                    	</div>
									<div class="tab-pane active" id="personalDetails" role="tabpanel">
                                            {{-- <form action="{{Route('testers')}}" method="post" enctype="multipart/form-data"> --}}
                                        <form id="profileForm" method="post" enctype="multipart/form-data">
											@csrf
											<input type="hidden" name="type" value="details">
											<input type="hidden" name="id" value="{{$user->id}}">
											<div class="row">
												<div class="col-lg-4">
													<div class="mb-3">
														<label for="firstnameInput" class="form-label">First Name</label>
														<input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter your firstname" value="{{ $user->fname}}" required>
                                                        @if(session()->has('error'))
                                                            @error('firstname')
                                                                <div class="error">{{ $message }}</div>
                                                            @enderror
                                                        @endif
													</div>
												</div><!--end col-->

												<div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="lastnameInput" class="form-label">Last Name</label>
                                                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter your lastname" value="{{ $user->lname}}" required>
                                                        @if(session()->has('error'))
                                                            @error('lastname')
                                                                <div class="error">{{ $message }}</div>
                                                            @enderror
                                                        @endif    
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
                                                        @if(session()->has('error'))
                                                            @error('phone_number')
                                                                <div class="error">{{ $message }}</div>
                                                            @enderror
                                                        @endif
                                                    </div>
                                                </div><!--end col-->

												<div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="websiteInput1" class="form-label">User Name </label>
                                                        <input type="text" class="form-control"  placeholder="" value="{{ $user->username}}" readonly />
                                                    </div>
                                                </div><!--end col-->

                                                <div class="col-lg-4">
                                                    <div class="mb-3">
                                                        <label for="JoiningdatInput" class="form-label">Date of Birth</label>
                                                        <input type="text" class="form-control flatpickr" name="birthdate" placeholder="Birth Date" value="{{$user->birthdate}}" />
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
                                                            @if(session()->has('error'))
                                                                @error('gender')
                                                                    <div class="error">{{ $message }}</div>
                                                                @enderror
                                                            @endif
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

                                                <div class="col-lg-12">
                                                    <div class="hstack gap-2 justify-content-end">
                                                        <button type="submit" class="btn btn-red">Update</button>
                                                    </div>
                                                </div><!--end col-->
                                            </div><!--end row-->
                                        </form>
                                    </div>
                                    <!--end tab-pane-->
                                </div>
                            </div>
                        </div>
                    </div><!--end col-->
                </div>
                <!--end row-->
            </div><!-- container-fluid -->
		</div>
        <!-- End Page-content -->
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
	<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/confirmDate/confirmDate.js"></script>
     <script type="text/javascript">
        $('#profile-img-file-input').change(function() {
            // $('#imageform').submit();
            let form = $('#imageform')[0];
			let formData = new FormData(form); 
			var updateProfileUrl = "{{ route('customer_profile_update_sub') }}";
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
				$.ajax({
					type: 'POST',
					url: updateProfileUrl,
					data: formData,
					contentType: false,
					processData: false,
					success: function(response) {
						if (response.status === 'success') {
							$('#message').html('<div class="alert alert-success">' + response.message + '</div>');
							location.reload();
						} else {
							$('#message').html('<div class="alert alert-danger">' + response.message + '</div>');
						}
					},
					error: function(xhr) {
						$('#message').html('<div class="alert alert-danger">Something went wrong. Please try again.</div>');
					}
				});
        });
    </script> 

 
    

    <script src="{{url('public/dashboard-design/js/jquery-3.6.4.min.js')}}"></script>
    <script src="{{url('public/js/jquery-input-mask-phone-number.js')}}"></script>
    <script>
        $(document).on('focus', '[data-behavior~=text-phone]', function(e){
            $('[data-behavior~=text-phone]').usPhoneFormat({
                format: '(xxx) xxx-xxxx',
            });
        });
    </script>
    <script>
		function dashboard_menu()
		{
			var token = localStorage.getItem('authToken');
			var code = {{$business->id ?? 'null'}};
			var customer = localStorage.getItem('customer');
			const url = `https://dev.fitnessity.co/api/customer_dashboard?token=${encodeURIComponent(token)}&code=${encodeURIComponent(code)}&customer_id=${encodeURIComponent(customer)}`;
            window.parent.postMessage({ type: 'changeSrc', src: url }, '*');     
		}
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
    <script>
        $('#profileForm').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);
            var updateProfileUrl = "{{ route('customer_profile_update_sub') }}";
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: updateProfileUrl,
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status === 'success') {
                        $('#message').html('<div class="alert alert-success">' + response.message + '</div>');
                    } else {
                        $('#message').html('<div class="alert alert-danger">' + response.message + '</div>');
                    }
                },
                error: function(xhr) {
                    var errors = xhr.responseJSON.errors;
                    var errorHtml = '<div class="alert alert-danger"><ul>';
                    $.each(errors, function(key, value) {
                        errorHtml += '<li>' + value + '</li>';
                    });
                    errorHtml += '</ul></div>';
                    $('#message').html(errorHtml);
                }
            });
        });
    </script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var logoutLink = document.getElementById('logoutLink');	
        if (logoutLink) {
            logoutLink.addEventListener('click', function(event) {
                localStorage.removeItem('loggedin');					
            });
        }
    });
</script>
@endsection