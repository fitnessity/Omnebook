<h5 class="modal-title mb-10" id="exampleModalLabel">Add New Staff</h5>
<form action="{{route('business.staff.store')}}" method="post" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-3">
			<div class="photo-select">
				<img src="{{asset('/public/images/service-nofound.jpg')}}" class="pro_card_img blah" id="showimg">
				<input type="file" id="files" name="files" class="hidden">
				<label for="files">Upload Image</label>
			</div>
			<p>Upload an image to showcase your staff</p>
		</div>
		<div class="col-lg-9 col-md-9 col-sm-9">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="form-group mb-10">
						<label for="fname">First Name</label>
						<input type="text" class="form-control" name="first_name" required>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="form-group mb-10">
						<label for="lname">Last Name</label>
						<input type="text" class="form-control" name="last_name" required>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="form-group mb-10">
						<label for="cnumber">Cell Number</label>
						<input type="text" class="form-control" name="phone" data-behavior="text-phone" required>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="form-group mb-10">
						<label for="email">Email</label>
						<input type="text" class="form-control" name="email" required>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="form-group mb-10">
						<label for="position">Position</label> 
						<select class="form-select" name="position" required="">
							<option value="none"> Select</option>
							@foreach($positions as $ps)
								<option value="{{$ps->name}}">{{$ps->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="form-group mb-10">
						<label class="position-gander">How Do You Identify?</label>
						<div>
							<input type="radio" id="male" name="gender" value="male" checked>
							<label class="inner-fonts-staff" for="male" >Male</label>
							<input type="radio" id="female" name="gender" value="Female">
							<label class="inner-fonts-staff" for="female">Female</label>
							<input type="radio" id="other" name="gender" value="Other">
							<label class="inner-fonts-staff" for="other">Other</label>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="form-group mb-10">
						<label for="address">Address</label>
						<input id="address" name="address" type="text" class="form-control" autocomplete="off">
					</div>
				</div>
				<div id="map" style="display: none;"></div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="form-group mb-10">
						<label for="city">City</label>
						<input type="text" class="form-control" name="city" id="city" >
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="form-group mb-10">
						<label for="state">State</label>
						<input type="text" class="form-control" name="state" id="state">
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="form-group mb-10">
						<label for="postcode">Post Code</label>
						<input type="text" class="form-control" name="postcode" id="postcode">
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div class="form-group mb-10">
						<label for="email">Birthday <!-- <span id="star">*</span> --></label>
						<div class="input-group">
							<input type="text" class="form-control border-0 dash-filter-picker flatpickr-range flatpiker-with-border flatpickr-input active" name="birthdate" id="birthdate">
						</div>
					</div>
				</div>
				<div class="col-lg-12 col-md-12">
					<div class="form-group mb-10 text-border public-bio">
						<label class="position-gander">Public Bio</label>
						<textarea class="form-control" id="" name="" rows="4" cols="80">Tell us something about your staff member. Customers will learn more about who they are training with.
						</textarea> 
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<div class="hstack gap-2 justify-content-end">
			<button type="submit" class="btn btn-red" id="add-btn">Add</button>
		</div>
	</div>
</form>
<script type="text/javascript">
	flatpickr('.flatpickr-input',{
		dateFormat: "m/d/Y",
		maxDate: "01/01/2050",
	});
</script>

<script type="text/javascript">
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