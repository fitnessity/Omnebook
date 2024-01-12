<div class="d-grid contact-info-1">
	<div class="mb-5x">
		<label>Provider Business Name:</label>
		<span>{{$company->public_company_name}}</span>
	</div>
	<div class="mb-5x">
		<label>Company Representative:</label>
		<span>{{$company->full_name}}</span>
	</div>
	<div class="mb-5x">
		<label>Address: </label>
		<span>{{$company->company_address()}}</span>
	</div>
	<div class="mb-5x">
		<label>Phone: </label>
		<span>{{$company->business_phone}}</span>
	</div>
	<div class="mb-5x">
		<label>Email: </label>
		<span>{{$company->business_email}}</span>
	</div>
	<div class="mb-5x">
		<label>Website: </label>
		<span>{{$company->business_website}}</span>
	</div>

	@php   
		$locations = []; 
        if($company->latitude != '' || $company->longitude  != ''){
			$lat = $company->latitude + ((floatVal('0.' . rand(1, 9)) * 1) / 10000);
			$long = $company->longitude + ((floatVal('0.' . rand(1, 9)) * 1) / 10000);
    		$a = [$company->public_company_name, $lat, $long, $company->id, $company->logo];
            array_push($locations, $a);
		}
		
	@endphp
	@if($company->latitude && $company->longitude)
	
	<div > 
		<label>Location: </label>
		<!-- <div class="map-area-wrapper">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d52933472.40627602!2d-161.90502575786684!3d35.92732763546466!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x54eab584e432360b%3A0x1c3bb99243deb742!2sUnited%20States!5e0!3m2!1sen!2sin!4v1700569528311!5m2!1sen!2sin" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div> -->
		<div style="height:300px">
			<div class="mysrchmap">
				<div id="map_canvas1" style="position: absolute; top: 230px; right: 0; bottom: 0; left: 0;"></div>
			</div>
			<div class="maparea"></div>
		</div>
		</div>
	</div>

	@endif
</div>

<script>
	    var locationsC = @json($locations);
	    var map =  infowindow =  marker =  circle = '';
	    var markers = []
	    
	    $('#map_canvas1').empty();
	    if (locationsC.length != 0) {  
	        map = new google.maps.Map(document.getElementById('map_canvas1'), {
	            zoom:18,
	            center: new google.maps.LatLng(locationsC[0][1], locationsC[0][2]),
	            mapTypeId: google.maps.MapTypeId.ROADMAP,
	        });
	        infowindow = new google.maps.InfoWindow();
	        var bounds = new google.maps.LatLngBounds();
	        var marker, i;
	        var icon = {
	            url: "{{url('/public/images/hoverout2.png')}}",
	            scaledSize: new google.maps.Size(50, 50),
	            labelOrigin: {x: 25, y: 16}
	        };
	        for (i = 0; i < locationsC.length; i++) {
	            var labelText = i + 1
	            marker = new google.maps.Marker({
	                position: new google.maps.LatLng(locationsC[i][1], locationsC[i][2]),
	                map: map,
	                icon: icon,
	                title: labelText.toString(),
	                label: {
	                    text: labelText.toString(),
	                    color: '#222222',
	                    fontSize: '12px',
	                    fontWeight: 'bold'
	                }
	            });

	            bounds.extend(marker.position);
	            markers.push(marker);
	        }
	        
	        $('.mysrchmap').show()
	    } else {
	        $('#mapdetails').hide()
	    }
	
</script>

