@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')
@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.10/slimselect.min.css" rel="stylesheet">


<section style="margin-top:70px; margin-bottom: 70px;">
	<div class="container-fluid bannar-set">
		<div class="row">
			<div class="col-md-12">
				<div class="business-banner">
					<img src="https://development.fitnessity.co/public/images/newimage/addbusiness-customer.jpg" alt="">
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="business-info">
					<h3>ADD A BUSINESS TO FITNESSITY AS A CUSTOMER</h3>
					<p>Thank you for telling us about a new business to list on Fitnessity. Your contributions introduces others to another great business and to make our community stronger. To get started, tell us a little bit yourself and about the business.</p>
				</div>
			</div>
			<div class="col-md-12">
				<h3 class="business-inner-title">Tell Us About You</h3>
			</div>
		</div>
		<form id="add_details" action="{{route('add_business_customer')}}" method="post">
			<input name="_token" type="hidden" value="{{csrf_token()}}">
			<div class="border-fs">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>What’s your full name?</label>
							<input type="text" class="form-control" name="business_added_by_cust_name" id="business_added_by_cust_name">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>What’s your email?</label>
							<input type="text" class="form-control" name="email" id="email"> 
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<h3 class="business-inner-title">Tell Us About The Business</h3>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="position">What type of business is this?</label>
						<p>(Choose Only One)</p>
						<div class="special-offer offer-sp">
							<div class="multiples">
								<select id="business" name="business_type" class="myfilter" >
									<option value="individual">Individual</option>
									<option value="business">Business</option>
								</select>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label>Business Name</label>
						<input type="text" class="form-control" name="Companyname" id="b_companyname" placeholder="Enter Business Name">
					</div>
					<div class="form-group">
						<label>Business Owners Name (optional)</label>
						<input type="text" class="form-control" name="Firstnameb" id="b_firstname" placeholder="Enter Business Owners Name">
					</div>
					<div class="form-group">
						<label>Business Address</label>
						<input type="text" class="form-control" autocomplete="nope" name="Address" id="b_address" placeholder="Address" value="">
					</div>

					<div id="map" style="display: none;"></div>

					<div class="form-group">
						<label>Additional address info. (optional)</label>
						<input type="text" class="form-control" autocomplete="nope" name="additional_address" id="b_additional_address" placeholder="Suite number, plaza, square" value="">
					</div>

					<div class="form-group">
						<label>City/Town</label>
						<input type="text" class="form-control" name="City" id="b_city" size="30" placeholder="City" maxlength="50" value="">
					</div>

					<div class="form-group">
						<label>State/Province/Region</label>
						<input type="text" class="form-control" name="State" id="b_state" size="30" placeholder="State" maxlength="50" value="">
					</div>

					<div class="form-group">
						<label>Zipcode/Postal Code</label>
						<input type="text" class="form-control" name="ZipCode" id="b_zipcode" size="30" placeholder="Zip Code" value="" maxlength="20">
					</div>

					<input type="hidden" name="lon" id="lon" value="">
					<input type="hidden" name="lat" id="lat" value="">

					<div class="form-group">
						<label for="position">Country</label>
						<div class="special-offer offer-sp">
							<div class="multiples">
								<input type="text" class="form-control" name="Country" id="b_country" size="30" placeholder="Country" value="" maxlength="20">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Neighborhood (optional)</label>
						<input type="text" class="form-control" name="neighborhood" id="b_neighborhood" size="30" placeholder='Neighborhood' value="" maxlength="50">
					</div>

					<div class="form-group">
						<label>Phone Number (optional)</label>
						<input type="text" class="form-control" name="business_phone" id="b_business_phone" placeholder="Business Phone" value="" onkeyup="addphonenumber();">
					</div>
					<div class="form-group">
						<label>Website Address (optional)</label>
						<input type="text" class="form-control" name="business_website" id="business_website" placeholder="Website Name" value="">
					</div>
					<div class="form-group">
						<label>Email (optional)</label>
						<input type="email" class="form-control myemail" name="business_email" id="b_business_email" autocomplete="off" placeholder="Email Address" size="30" maxlength="80" value="" onkeyup="addemail();">
					</div>
					<div class="form-group">
						<label>Other Activites Offered (optional)</label>
						<p>Upload Up To 6</p>
						<p>Example: karate, yoga, physical therapy, massage (optional)</p>
						<p>1.  Add Actviity <a href="#" class="addactivity">+</a></p>
						<input type="text" class="form-control" name="email">
					</div>
					
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="position">What activity does this business offer?</label>
						<p>Pick just one. The business owner will add more later.</p>
						<div class="special-offer offer-sp">
							<div class="multiples">
								<select id="activity" name="service_type[]" class="myfilter" multiple="multiple">
									<option value="individual">select activity</option>
									<option value="classes">select activity</option>
								</select>
							</div>
						</div>
					</div>
					
					<div class="widget mx-sp">
					<h4 class="widget-title">Business Info</h4>	
						<div class="business maparea modal-map">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24176.251535935986!2d-73.96828678121815!3d40.76133318281456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258c4d85a0d8d%3A0x11f877ff0b8ffe27!2sRoosevelt%20Island!5e0!3m2!1sen!2sin!4v1620041765199!5m2!1sen!2sin" style="border:0; width: 100%; height: 60vh;" allowfullscreen="" loading="lazy"></iframe>
						</div>
						<div class="map-info">
							<span>
								<i class="fas fa-map-marker-alt map-fa"></i>
								<p id="address_p"></p>
							</span>
							<span>
								<i class="fas fa-phone-alt map-fa"></i>
								<p id="phonenum_p"></p>
							</span>
							<span>
								<i class="fa fa-envelope map-fa"></i>
								<p id="email_p"></p>
							</span>
						</div>
					</div>
					
					<div>
						<h3 class="business-inner-title">Write the first review for this business!</h3>
					</div>
					<div class="star-rating">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
					</div>
					
					<div class="widget control-review">
						<div class="form-group">
	                        <label for="email">Title your review  <span id="star">*</span></label>
							<input type="text" class="form-control" name="pno" placeholder="">
	                    </div>
						<div class="form-group">
	                        <label for="email">Your review <span id="star">*</span></label>
							<textarea class="form-control" rows="4" placeholder="Tell us about your experience" name="Aboutcompany" id="about_company" maxlength="150"></textarea>
	                    </div>
						<div class="row">
							<div class="col-md-5">
								<div class="photo-select-review">
									<img src="https://development.fitnessity.co/public/uploads/profile_pic/thumb/1657726206-badminton-1428046__480.jpg" class="pro_card_img blah" id="showimg">
									<input type="file" id="files" class="hidden">
									<label for="files">Upload Image</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
	                    <label for="email">Business Description (Optional)</label>
	                    <textarea class="form-control" rows="10" placeholder="Tell Us Somthing About Company in short..." name="Shortdescription" id="short_description" maxlength="1000"></textarea>
	                    <div class="text-right"><span id="company_desc_left">1000</span> Characters Left</div>
	                    <span class="error" id="b_short"></span>
	                </div>
					<button class="showall-btn btn-display"  id="submitButton">Submit</button> 
				</div>
			</div>
		</form>
	</div>
</section>

<div class="modal fade" id="Countermodal">
    <div class="modal-dialog counter-modal-size">
        <div class="modal-content">
           <div class="modal-header"> 
				<div class="closebtn">
					<button type="button" class="close close-btn-design" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
			</div>  
            <div class="modal-body conuter-body" id="Countermodalbody">

            </div>            
            <div class="modal-footer conuter-body">
                <button type="button"  class="btn btn-primary rev-submit-btn">I didn't find it, add new listing</button>
                <button type="button" class="close close-btn-design" data-dismiss="modal" aria-label="Close">Go back</button>
            </div>
    	</div>                                                                       
    </div>                                          
</div>                    


@include('layouts.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.10/slimselect.min.js"></script>
<script>
    $(document).ready(function() {
      
        var categ = new SlimSelect({
            select: '#business'
        });
	
		var categ = new SlimSelect({
            select: '#activity'
        });

        $('#company_desc_left').text(1000-parseInt($("#short_description").val().length));

		$("#short_description").on('input', function() {
	        $('#company_desc_left').text(1000-parseInt(this.value.length));
    	});
    });

	$("#submitButton").click(function(e) {
		var form = $("#add_details");
        var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function(data) {
            	if(data == 'matched'){

            	}
            	/*alert(data);*/
            },
        });
	});
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
             $('#address_p').html(place.formatted_address);
            $('#lat').val(place.geometry.location.lat());
            $('#lon').val(place.geometry.location.lng());
        });
    }

    function addphonenumber(){
    	$('#phonenum_p').html($('#b_business_phone').val());
    }
    function addemail(){
    	$('#email_p').html($('#b_business_email').val());
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCr7-ilmvSu8SzRjUfKJVbvaQZYiuntduw&callback=initMap" async defer></script>


@endsection

