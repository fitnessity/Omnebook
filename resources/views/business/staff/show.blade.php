@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.business.business_topbar')
   	<div class="main-content">
		<div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="h-100">
                        	<div class="row mb-3">
								<div class="col-6">
									<div class="page-heading">
										<label>Manage Staff</label>
									</div>
								</div>
								@if(!Session('StaffLogin'))
									<div class="col-6">
										<div class="import-export float-end mt-10">
											<a href="{{route('business.staff.index')}}" class="btn btn-red">Staff List</a>
										</div>
									</div>
								@endif
							</div>
						
							<div class="row">
								<div class="col-xxl-3 col-lg-3 col-sm-12">
									<div class="card">
										<div class="card-body p-4">
											<div>
												<form action="{{route('business.staff.update',['business_id'=>$staffMember->business_id,'staff'=>$staffMember->id])}}" method="post" enctype="multipart/form-data">
													@csrf
													<input type="hidden" name="_method" value="put" />
													<input type="hidden" name="oldImage" value="{{$staffMember->profile_pic}}" />
													<div class="text-center">
														<div class="profile-user position-relative d-inline-block mx-auto  mb-4">
															@if($staffMember->profile_pic != '')
																<img src="{{Storage::Url($staffMember->profile_pic)}}" alt="" class="rounded-circle avatar-xl img-thumbnail user-profile-image shadow">
															@else
																<div class="avatar-xl">
																	<span class="mini-stat-icon avatar-title msmall-font rounded-circle text-success bg-soft-red fs-4 uppercase">{{$staffMember->first_name[0]}}</span>
	                                      						</div>
															@endif
															
															<div class="avatar-xs p-0 rounded-circle profile-photo-edit">
																<input id="profile-img-file-input" type="file" class="profile-img-file-input" name="image">
																<label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
																	<span class="avatar-title rounded-circle bg-light text-body shadow">
																		<i class="ri-camera-fill"></i>
																	</span>
																</label>
															</div>
														</div>
														<h5 class="fs-16 mb-1">{{$staffMember->full_name}}</h5> 
													</div>
												
													<div class="row">
														<div class="col-lg-12">
															<div class="form-group mt-10 mb-10">
																<label for="email">First Name</label>
																<input type="text" class="form-control" name="fname" id="fname" size="30" placeholder="Full Name" value="{{$staffMember->first_name}}" required="">
															</div>
															<div class="form-group mb-10">
																<label for="lname">Last Name</label>
																<input type="text" class="form-control" name="lname" value="{{$staffMember->last_name}}">
															</div>
															<div class="form-group mb-10">
																<label for="cnumber">Cell Number</label>
																<input type="text" class="form-control" name="phone" data-behavior="text-phone" value="{{$staffMember->phone}}">
															</div>
															<div class="form-group mb-10">
																<label for="email">Email</label>
																<input type="text" class="form-control" name="email" value="{{$staffMember->email}}">
															</div>
															<div class="form-group mb-10">
																<label for="email">Position</label>
																<select class="form-select" name="position" required="" >
																	<option value="none" {{$staffMember->position == 'none' ? "selected" : ''}}> Select</option>
																	@foreach($positions as $ps)
																	<option value="{{$ps->name}}" {{$staffMember->position == $ps->name ? "selected" : ''}}>{{$ps->name}}</option>
																	@endforeach
																</select>
															</div>
															<div class="form-group mb-10">
																<label class="position-gander">How Do You Identify?</label>
																<div>
																	<input type="radio" id="male" name="gender" value="male" {{$staffMember->gender == 'male' || $staffMember->gender == '' ? "checked" : ''}}>
																	<label class="inner-fonts-staff" for="male">Male</label>
																	<input type="radio" id="female" name="gender" value="female" {{$staffMember->gender == 'female' ? "checked" : ''}}>
																	<label class="inner-fonts-staff" for="female">Female</label>
																	<input type="radio" id="other" name="gender" value="other" {{$staffMember->gender == 'other' ? "checked" : ''}}>
																	<label class="inner-fonts-staff" for="other">Other</label>
																</div>
															</div>
															<div class="form-group mb-10">
																<label for="address">Address</label>
																<input type="text" class="form-control" name="address" id="address" value="{{$staffMember->address}}">
															</div>
															<div id="map" style="display: none;"></div>
															<div class="form-group mb-10">
																<label for="city">City</label>
																<input type="text" class="form-control" name="city" id="city" value="{{$staffMember->city}}">
															</div>
															<div class="form-group mb-10">
																<label for="state">State</label>
																<input type="text" class="form-control" name="state" id="state" value="{{$staffMember->state}}">
															</div>
															<div class="form-group mb-10">
																<label for="postcode">Post Code</label>
																<input type="text" class="form-control" name="postcode" id="postcode" value="{{$staffMember->postcode}}">
															</div>
															<div class="form-group mb-10">
																<label for="email">Birthday</label>
																<div class="input-group">
																	<input type="text" class="form-control border-0 dash-filter-picker flatpickr-range flatpiker-with-border flatpickr-input active" name="birthdate" id="birthdate" value="{{$staffMember->birthdate != '' ? date('m-d-Y',strtotime($staffMember->birthdate)): ''}}">
																</div>
															</div>
															<div class="form-group mb-10">
																<label class="position-gander">Public Bio</label>
																<textarea class="form-control" id="" name="bio" rows="5">{{$staffMember->bio}}</textarea> 
															</div>
															<div class="form-group mb-10">
																<label class="position-gander">Set Password</label>
																<input type="text" class="form-control" id="password" name="password" value="{{$staffMember->buddy_key}}" placeholder="*****" /> 
															</div>
															<div class="form-group mb-10 float-end">
																<button type="submit" class="btn btn-red" id="add-btn">Update</button>
															</div>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xxl-9 col-lg-9 col-sm-12">
									<div class="card">
										<div class="card-header border-0 align-items-center d-flex">
											<h4 class="card-title mb-0 flex-grow-1">Staff Information</h4>
										</div>
										<div class="card-body pb-2">
											<div class="row">
												<div class="col-lg-2 col-md-3 col-sm-3">
													<div class="avatar-lg">
														@if($staffMember->profile_pic != '')
															<img src="{{Storage::Url($staffMember->profile_pic)}}" alt="" class="rounded-circle avatar-lg img-thumbnail user-profile-image  shadow">
														@else
															<span class="mini-stat-icon avatar-title msmall-font rounded-circle text-success bg-soft-red fs-4 uppercase">{{$staffMember->first_name[0]}}</span>
														@endif
													</div>
												</div>
												<div class="col-lg-10 col-md-3 col-sm-9">
													<div class="row">
														<div class="col-lg-6 col-sm-12">
															<div class="mb-10">
																<div class="row">
																	<div class="col-lg-4 col-sm-4 col-4">
																		<label> Name: </label>
																	</div>
																	<div class="col-lg-8 col-sm-8 col-8">
																		<span> {{$staffMember->full_name}} </span>
																	</div>													
																</div>
															</div>
															<div class="mb-10">
																<div class="row">
																	<div class="col-lg-4 col-sm-4 col-4">
																		<label> Cell Number: </label>
																	</div>
																	<div class="col-lg-8 col-sm-8 col-8">
																		<span> {{$staffMember->phone}} </span>
																	</div>													
																</div>
															</div>
															<div class="mb-10">
																<div class="row">
																	<div class="col-lg-4 col-sm-4 col-4">
																		<label> Email: </label>
																	</div>
																	<div class="col-lg-8 col-sm-8 col-8">
																		<span>{{$staffMember->email}}</span>
																	</div>													
																</div>
															</div>
															<div class="mb-10">
																<div class="row">
																	<div class="col-lg-4 col-sm-4 col-4">
																		<label> Position: </label>
																	</div>
																	<div class="col-lg-8 col-sm-8 col-8">
																		<span>{{$staffMember->position}}</span>
																	</div>				
																</div>
															</div>
															<div class="mb-10">
																<div class="row">
																	<div class="col-lg-4 col-sm-4 col-4">
																		<label> Gender: </label>
																	</div>
																	<div class="col-lg-8 col-sm-8 col-8">
																		<span>{{$staffMember->gender}} </span>
																	</div>													
																</div>
															</div>
															<div class="mb-10">
																<div class="row">
																	<div class="col-lg-4 col-sm-4 col-4">
																		<label> Address: </label>
																	</div>
																	<div class="col-lg-8 col-sm-8 col-8">
																		<span>{{$staffMember->address != '' ? $staffMember->address : 'N/A'}}</span>
																	</div>													
																</div>
															</div>
															
														</div>
														<div class="col-lg-6">
															<div class="mb-10">
																<div class="row">
																	<div class="col-lg-4 col-sm-4 col-4">
																		<label> City: </label>
																	</div>
																	<div class="col-lg-8 col-sm-8 col-8">
																		<span>{{$staffMember->city != '' ? $staffMember->city : 'N/A'}}</span>
																	</div>													
																</div>
															</div>
															<div class="mb-10">
																<div class="row">
																	<div class="col-lg-4 col-sm-4 col-4">
																		<label> State:</label>
																	</div>
																	<div class="col-lg-8 col-sm-8 col-8">
																		<span>{{$staffMember->state != '' ? $staffMember->state  : 'N/A'}}</span>
																	</div>													
																</div>
															</div>
															<div class="mb-10">
																<div class="row">
																	<div class="col-lg-4 col-sm-4 col-4">
																		<label> Post Code: </label>
																	</div>
																	<div class="col-lg-8 col-sm-8 col-8">
																		<span>{{$staffMember->postcode != '' ? $staffMember->postcode : 'N/A'}}</span>
																	</div>													
																</div>
															</div>
															<div class="mb-10">
																<div class="row">
																	<div class="col-lg-4 col-sm-4 col-4">
																		<label> Birthday: </label>
																	</div>
																	<div class="col-lg-8 col-sm-8 col-8">
																		<span>{{$staffMember->birthdate != '' ? date('m/d/Y',strtotime($staffMember->birthdate)) : "N/A"}}</span>
																	</div>	
																</div>
															</div>
															<div class="mb-10">
																<div class="row">
																	<div class="col-lg-4 col-sm-4 col-4">
																		<label> Public Bio: </label>
																	</div>
																	<div class="col-lg-8 col-sm-8 col-8">
																		<span>{{$staffMember->bio}}</span>
																	</div>				
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="card" id="customerList">
										<div class="card-body">
											<div>
												<div class="table-responsive table-card mb-1">
													<table class="table table-hover table-centered align-middle table-nowrap mb-0 memberships-pack" id="customerTable">
														<thead class="table-light text-muted">
															<tr>
																<th scope="col" style="width: 50px;">
																	<div class="form-check">
																		<input class="form-check-input" type="checkbox" id="checkAll" value="option">
																	</div>
																</th>

																<th class="sort custom-sort" data-sort="activity">Activity</th>
																<th class="sort custom-sort" data-sort="program">Program</th>
																<th class="sort custom-sort" data-sort="map">Location</th>
																<th class="sort custom-sort" data-sort="days_of_week">Days of week</th>
																<th class="sort custom-sort" data-sort="position">Position</th>
																<th class="sort custom-sort" data-sort="service_type">Service Type</th>
																<th class="sort custom-sort" data-sort="duration">Duration</th>
																<th class="sort custom-sort" data-sort="time">Time</th>
															</tr>
														</thead>
														<tbody class="empty-table form-check-all">
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
																<td>No Schedule Appointed</td>
																<td></td>
																<td></td>
																<td></td>
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>	
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<tr rowspan="9">
																<td></td>
															</tr>
															<!-- <tr>
																<th scope="row">
																	<div class="form-check">
																		<input class="form-check-input" type="checkbox" name="chk_child" value="option1">
																	</div>
																</th>
																<td class="activity">s Krav Maga </td>
																<td class="program"> Womens Self Defense </td>
																<td class="map">At Business</td>
																<td class="days_of_week">03/26/2022</td>
																<td class="position"> 	Instructor</td>
																<td class="service_type"> 	Class</td>
																<td class="duration">2h 30m</td>
																<td class="time">1:00 pm to 3:30 pm </td>
															</tr> -->
															
														</tbody>
													</table>
												</div>
												<div class="d-flex justify-content-end">
													<div class="pagination-wrap hstack gap-2">
														<a class="page-item pagination-prev disabled" href="#">
															Previous
														</a>
														<ul class="pagination listjs-pagination mb-0"></ul>
														<a class="page-item pagination-next" href="#">
															Next
														</a>
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
            </div><!-- container-fluid -->
        </div><!-- End Page-content -->
    </div><!-- end main content-->
</div><!-- END layout-wrapper -->

 @include('layouts.business.footer')
    <script type="text/javascript">
    	flatpickr('.flatpickr-input',{
    		dateFormat: "m/d/Y",
			maxDate: "01/01/2050",
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
              $('#postcode').val(place.address_components[i].long_name);
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

            if(place.address_components[i].types[0] == 'administrative_area_level_1'){
              $('#state').val(place.address_components[i].long_name);
            }
        }

        if(badd == ''){
          $('#address').val(sublocality_level_1);
        }else{
          $('#address').val(badd);
        }
    });
	}
	</script>

	<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{env('AUTO_COMPLETE_ADDRESS_GOOGLE_KEY')}}&callback=initMap" async defer></script>
@endsection