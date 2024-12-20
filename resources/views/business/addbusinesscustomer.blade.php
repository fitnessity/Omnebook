@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
	<link rel='stylesheet' type='text/css' href="{{env('APP_URL')}}<?php echo Config::get('constants.FRONT_CSS'); ?>frontend/general.css">
    <link rel='stylesheet' type='text/css' href="{{env('APP_URL')}}<?php echo Config::get('constants.FRONT_CSS'); ?>responsive.css">
@section('content')

<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.10/slimselect.min.css" rel="stylesheet"> -->

<style>
	body{background: #fff;}
	label{font-size: 14px;}
	.form-group {
		margin-bottom: 15px;
	}
	.form-control{
		font-size: 14px;
	}
	.form-group p{font-size: 14px;}
	input{font-size: 14px;}
	.ss-main .ss-content .ss-list .ss-option{font-size: 14px;}
	.ss-main .ss-content .ss-search input{font-size: 14px;}
	.ss-main .ss-single-selected .placeholder{background: none; font-size: 14px;}
	.map-info p{font-size: 14px;}
	.rvw-overall-rate span{font-size: 14px;}
</style>
<section style="margin-top:99px; margin-bottom: 70px;">
	<div class="container-fluid bannar-set">
		<div class="row">
			<div class="col-md-12">
				<div class="business-banner">
					<img src="{{url('/public/images/newimage/addbusiness-customer.jpg')}}" alt="Omnebook" loading="lazy">
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="business-info">
					<h3>ADD A BUSINESS TO OMNEBOOK AS A CUSTOMER</h3>
					<p>Thank you for telling us about a new business to list on Omnebook. Your contributions introduces others to another great business and to make our community stronger. To get started, tell us a little bit yourself and about the business.</p>
				</div>
			</div>
			<div class="col-md-12">
				<div  class="business-info success_msg">
				</div>
			</div>

			<div class="col-md-12">
				<h3 class="business-inner-title">Tell Us About You</h3>
			</div>
		</div>
		<form method="post" enctype="multipart/form-data" name="add_details" id="add_details">
        	@csrf 
			<input name="_token" type="hidden" value="{{csrf_token()}}">
			<input name="add_status" id="add_status" type="hidden" value="no">
			<div class="border-fs">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="fs-14">What’s your full name?</label>
							<input type="text" class="form-control" name="business_added_by_cust_name" id="business_added_by_cust_name">
							<div class="reviewerro fs-14" id="business_added_by_cust_nameerro"> </div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="fs-14">What’s your email?</label>
							<input type="text" class="form-control" name="email" id="email"> 
							<div class="reviewerro fs-14" id="emailerro"> </div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<h3 class="business-inner-title">Tell Us About The Business</h3>
				</div>
				<div class="col-lg-6 col-md-12 col-sm-12">
					<div class="form-group">
						<label for="position" class="fs-14">What type of business is this?</label>
						<p>(Choose Only One)</p>
						<div class="special-offer offer-sp">
							<div class="multiples">
								<select id="business_type" name="business_type" class="myfilter" onchange="addbustype(this.value);">
									<option value="individual">Individual</option>
									<option value="business">Business</option>
								</select>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label class="fs-14">Business Name</label>
						<input type="text" class="form-control" name="Companyname" id="b_companyname" placeholder="Enter Business Name" onkeyup="addbusname();">
						<div class="reviewerro fs-14" id="b_companynameerro"> </div>
					</div>
					<div class="form-group">
						<label class="fs-14">Business Owners Name (optional)</label>
						<input type="text" class="form-control" name="Firstnameb" id="b_firstname" placeholder="Enter Business Owners Name" onkeyup="addownname();">
					</div>
					<div class="form-group">
						<label class="fs-14">Business Address</label>
						<input type="text" class="form-control" autocomplete="nope" name="Address" id="b_address" placeholder="Address" value="">
						<div class="reviewerro fs-14" id="b_addresserro"> </div>
					</div>

					<div id="map" style="display: none;"></div>

					<div class="form-group">
						<label class="fs-14">Additional address info. (optional)</label>
						<input type="text" class="form-control" autocomplete="nope" name="additional_address" id="b_additional_address" placeholder="Suite number, plaza, square" value="">
					</div>

					<div class="form-group">
						<label class="fs-14">City/Town</label>
						<input type="text" class="form-control" name="City" id="b_city" size="30" placeholder="City" maxlength="50" value="">
					</div>

					<div class="form-group">
						<label class="fs-14">State/Province/Region</label>
						<input type="text" class="form-control" name="State" id="b_state" size="30" placeholder="State" maxlength="50" value="">
					</div>

					<div class="form-group">
						<label class="fs-14">Zipcode/Postal Code</label>
						<input type="text" class="form-control" name="ZipCode" id="b_zipcode" size="30" placeholder="Zip Code" value="" maxlength="20">
					</div>

					<input type="hidden" name="lon" id="lon" value="">
					<input type="hidden" name="lat" id="lat" value="">

					<div class="form-group">
						<label for="position" class="fs-14">Country</label>
						<div class="special-offer offer-sp">
							<div class="multiples">
								<input type="text" class="form-control" name="Country" id="b_country" size="30" placeholder="Country" value="" maxlength="20">
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="fs-14">Neighborhood (optional)</label>
						<input type="text" class="form-control" name="neighborhood" id="b_neighborhood" size="30" placeholder='Neighborhood' value="" maxlength="50">
					</div>

					<div class="form-group">
						<label class="fs-14">Phone Number</label>
						<input type="text" class="form-control" name="business_phone" id="b_business_phone" placeholder="Business Phone" value="" maxlength="16" onkeyup="addphonenumber();">
						<div class="reviewerro fs-14" id="b_business_phoneerro"> </div>
					</div>
					<div class="form-group">
						<label class="fs-14">Website Address (optional)</label>
						<input type="text" class="form-control" name="business_website" id="business_website" placeholder="Website Name" value="" onkeyup="addwebsite();;">
					</div>
					<div class="form-group">
						<label class="fs-14">Email </label>
						<input type="email" class="form-control myemail" name="business_email" id="b_business_email" autocomplete="off" placeholder="Email Address" size="30" maxlength="80" value="" onkeyup="addemail();">
						<div class="reviewerro fs-14" id="b_business_emailerro"> </div>
					</div>
					<!-- <div class="form-group">
						<label>Other Activites Offered (optional)</label>
						<p>Upload Up To 6</p>
						<p>Example: karate, yoga, physical therapy, massage (optional)</p>
						<p>1.  Add Actviity <a href="#" class="addactivity">+</a></p>
						<input type="text" class="form-control" name="email">
					</div> -->
					
				</div>
				<div class="col-lg-6 col-md-12 col-sm-12">
					<!-- <div class="form-group">
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
					</div> -->
					<div class="widget mx-sp mapscroll">
						<h4 class="widget-title fs-14">Business Info</h4>	
						<div class="business maparea modal-map-business kickboxing_map" style="margin-left:0px; margin-bottom: 15px;">
							<div class="mysrchmap" style="height: 100%;min-height: 300px;">
								<div id="map_canvas" style="position: absolute; top: 0; right: 0; bottom: 0; left: 0;">
									<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387190.279909073!2d-74.25987368715491!3d40.69767006458873!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sin!4v1667217425288!5m2!1sen!2sin" style="border:0; width: 100%; height: 60vh;" allowfullscreen="" loading="lazy"></iframe>
								</div>
							</div>
							<div class="maparea">
								
							</div>
						</div>
						<div class="map-info">
							<span>
								<i class="fas fa-map-marker-alt map-fa"></i>
								<p id="address_p">New York, NY , United States</p>
							</span>
							<span>
								<i class="fas fa-phone-alt map-fa"></i>
								<p id="phonenum_p">(000) 000 - 000</p>
							</span>
							<span>
								<i class="fa fa-envelope map-fa"></i>
								<p id="email_p">example@gmail.com</p>
							</span>
						</div>
					</div>
					
					<div>
						<h3 class="business-inner-title">Write the first review for this business!</h3>
					</div>
					<!--<div class="star-rating">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
					</div>-->
					<div class="rvw-overall-rate rvw-ex-mrgn">
						<span>Rating</span>
						 <input type="hidden" name="rating" id="rating" value="0">
						<div id="stars" class="starrr" style="font-size:22px"></div>
					</div>
					<script>
					 	$('#stars').on('starrr:change', function(e, value){
							$('#rating').val(value);
					 	});
					</script>
					<div class="widget control-review">
						<div class="form-group">
	                        <label for="title">Title your review  <span id="star">*</span></label>
							<input type="text" class="form-control" name="re_title" id="re_title" placeholder="">
							<div class="reviewerro fs-14" id="re_titleerro"> </div>
	                    </div>
						<div class="form-group">
	                        <label for="email">Your review <span id="star">*</span></label>
							<textarea class="form-control" rows="4" placeholder="Tell us about your experience" name="re_detail" id="re_detail" maxlength="150"></textarea>
							<div class="reviewerro fs-14" id="re_detailerro"> </div>
	                    </div>
						<div class="row">
							<div class="col-auto">
								<div class="photo-select-review">
									<img src="{{ url('/public/images/Upload-Icon.png')}}" class="pro_card_img blah" id="showimg"  loading="lazy">
									<input type="file" name="rimg[]" id="files" class="text-center" multiple="multiple" />
									<!-- <label for="files">Upload Image</label> -->
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
	                    <textarea class="form-control" rows="10" placeholder="Tell Us Somthing About Company in short..." name="Shortdescription" id="short_description" maxlength="1000" onchange="adddesc();"></textarea>
	                    <div class="text-right fs-14"><span id="company_desc_left">1000</span> Characters Left</div>
	                    <span class="reviewerro fs-14" id="short_descriptionerro"></span>
	                </div>
					<button type="button" class="showall-btn btn-display fs-14"  id="submitButton">Submit</button> 
					<!-- <button type="button" class="showall-btn btn-display"  data-toggle="modal" data-target="#successmodelbox">Add</button>  -->
				</div>
			</div>
		</form>
	</div>
</section>                    

<!-- The Modal Add Business-->
<div class="modal fade" id="successmodelbox" tabindex="-1" role="dialog" aria-labelledby="successmodelboxLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg location-modal">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body">
				<div class="row contentPop"> 
					<div class="col-lg-12">
					   <h4 class="modal-title" style="color: #000; line-height: inherit; font-weight: 600;">Successfully Added Business to Omnebook</h4>
					   <p style="color: #000; line-height: inherit; font-weight: 500; margin-bottom: 10px;" >This business will be reviewed by the Quality Control Team before going live</p>
					</div>
                    <div class="col-lg-12" id="modelbody_successmodelbox">
                    	<p id="modelbusname">Business Name: </p>
                    	<p id="modelbustype">Business Type: Individual</p>
                    	<p id="modelownername">Business Owners Name: </p>
                    	<p id="modeladdress">Business Address: </p>
                    	<p id="modelemail">Business Email: </p>
                    	<p id="modelphone">Business Phone Number: </p>
                    	<p id="modelweb">Website Address: </p>
                    	<p id="modeldesc">Business Description: </p>
                    </div>
					
					<div class="col-lg-12 btns-modal">
						<a class="addbusiness-btn-modal" href="{{route('activities_index')}}">Close</a>
					</div>
				 </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal Add Business-->
<div class="modal fade compare-model" id="location">
    <div class="modal-dialog modal-lg location-modal">
        <div class="modal-content">
			<div class="modal-header" style="text-align: right;"> 
			  	<div class="closebtn">
					<button type="button" class="close close-btn-location" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
			</div>

            <!-- Modal body -->
            <div class="modal-body">
				<div class="row contentPop"> 
					<div class="col-lg-12">
					   <h4 class="modal-title" style="color: #000; line-height: inherit; font-weight: 600;">That location may already be listed</h4>
					   <p>Are any of these what you are looking for?</p>
					</div>
                    <div class="col-lg-12" id="modelbody_already_bus">
                    </div>
					
					<div class="col-lg-12 btns-modal">
						<a class="addbusiness-btn-modal" data-dismiss="modal" >Go Back</a>
						<a class="addbusiness-btn-modal btn-right" onclick="add_details_already()">I didn't find it, add new listing</a>
					</div>
				 </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

@include('layouts.business.footer')
@include('layouts.business.scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.10/slimselect.min.js"></script>
<script>

    $(document).ready(function() {
      
        var categ = new SlimSelect({
            select: '#business_type'
        });
	
		/*var categ = new SlimSelect({
            select: '#activity'
        });*/

        $('#company_desc_left').text(1000-parseInt($("#short_description").val().length));

		$("#short_description").on('input', function() {
	        $('#company_desc_left').text(1000-parseInt(this.value.length));
    	});
    });

    function add_details_already(){
		var formData = new FormData($("#add_details")[0]);
		$.ajax({
            type: "POST",
            url: "{{route('add_business_customer')}}",
            enctype: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function(data) {
            	$("#add_details")[0].reset();
            	$('#location').hide();
            	$('#add_status').val("no");
            	$('.success_msg').css("color", "green");
            	$('.success_msg').html('Successfully Added Business...');
            },
        });
    }

    $(".closebtn").click(function(e) {
    	$('#add_status').val("no");
    });

    $(".close-btn-location").click(function(e) {
    	$('#add_status').val("no");
    }); 

    $(".addbusiness-btn-modal").click(function(e) {
    	$('#add_status').val("no");
    });

	$("#submitButton").click(function(e) {
		$('#business_added_by_cust_nameerro').hide(); 
		$('#emailerro').hide(); 
		$('#b_companynameerro').hide();
		$('#b_addresserro').hide();
		$('#re_titleerro').hide();
		$('#re_detailerro').hide();
		$('#b_business_emailerro').hide();
		$('#b_business_phoneerro').hide();
		var business_added_by_cust_name = $("#business_added_by_cust_name").val();
		var email = $("#email").val();
		var b_companyname = $("#b_companyname").val();
		var b_address = $("#b_address").val();
		var rating = $("#rating").val();
		var re_title = $("#re_title").val();
		var re_detail = $("#re_detail").val();
		var b_business_email = $("#b_business_email").val();
		var b_business_phone = $("#b_business_phone").val();
		
		if(business_added_by_cust_name !='' && email !='' && b_companyname !='' && b_address !='' && re_title !='' && re_detail !='' && b_business_phone !='' && b_business_email !='')
        {  
			var formData = new FormData($("#add_details")[0]);
	        $.ajax({
	            type: "POST",
	            url: "{{route('add_business_customer')}}",
	            enctype: 'multipart/form-data',
	            cache: false,
	            contentType: false,
	            processData: false,
	            data: formData,
	            success: function(data) {
	            	if(data != 'added'){
						$('#add_status').val("yes");
						//$('#location').modal('toggle');
						$('#location').modal({ backdrop: 'static',keyboard: false});
						$('#modelbody_already_bus').html(data);
	            	}else{
	            		$("#add_details")[0].reset();
						$('#successmodelbox').modal({ backdrop: 'static',keyboard: false});
						
	            	}
	            },
	        });
	    }else{
	    	if(business_added_by_cust_name =='')
	        { 	
	        	$('#business_added_by_cust_nameerro').show(); 
	        	$('#business_added_by_cust_nameerro').html('Please Enter Full Name'); 
	        }

	        if(email =='')
	        { 
	        	$('#emailerro').show(); 
				$('#emailerro').html('Please Enter Email'); 
	        }
	    	
	    	if(b_companyname =='' )
	        { 
	        	$('#b_companynameerro').show();
	        	$('#b_companynameerro').html('Please Enter Company Name'); 
	        }

	        if(b_address =='')
	        { 
	        	$('#b_addresserro').show();
	        	$('#b_addresserro').html('Please Enter Address'); 
	        }

	        if(b_business_phone =='')
	        { 
	        	$('#b_business_phoneerro').show();
	        	$('#b_business_phoneerro').html('Please Enter Business phone'); 
	        }

	        if(b_business_email =='')
	        { 
	        	$('#b_business_emailerro').show();
	        	$('#b_business_emailerro').html('Please Enter Business Email'); 
	        }
	       
	        if(re_title =='')
	        { 
	        	$('#re_titleerro').show();
	        	$('#re_titleerro').html('Please Enter Review Title'); 
	        }

	        if(re_detail =='')
	        { 
	        	$('#re_detailerro').show();
	        	$('#re_detailerro').html('Please Enter Review'); 
	        }
            return false;
        }
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
             $('#modeladdress').html('Business Address : ' + place.formatted_address);
            $('#lat').val(place.geometry.location.lat());
            $('#lon').val(place.geometry.location.lng());

        	var locations = place.formatted_address;
		   
		    var map1 = ''
		    var infowindow1 = ''
		    var marker1 = ''
		    var markers1 = []
		    var circle = ''
		    $('#map_canvas').empty();

		    if (locations.length != 0) {  console.log('!empty');
		        map1 = new google.maps.Map(document.getElementById('map_canvas'), {
		            zoom:18,
		            center: new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng()),
		            mapTypeId: google.maps.MapTypeId.ROADMAP,
		        });
		        infowindow1 = new google.maps.InfoWindow();
		        var bounds = new google.maps.LatLngBounds();
		        var marker1;
		        var icon1 = {
		            url: "{{url('/public/images/hoverout2.png')}}",
		            scaledSize: new google.maps.Size(50, 50),
		            labelOrigin: {x: 25, y: 16}
		        };
		        for (var i = 0; i < locations.length; i++) {
		            var labelText = i + 1
		            marker1 = new google.maps.Marker({
		                position: new google.maps.LatLng(place.geometry.location.lat(),place.geometry.location.lng()),
		                map: map1,
		                icon: icon1,
		                title: labelText.toString(),
		                label: {
		                    text: labelText.toString(),
		                    color: '#222222',
		                    fontSize: '12px',
		                    fontWeight: 'bold'
		                }
		            });

		            bounds.extend(marker1.position);
		        }		        
		        $('.mysrchmap').show()
		    } else {
		        $('#mapdetails').hide()
		    }
        });
    }

    function addphonenumber(){
    	if($('#b_business_phone').val() == ''){
			$('#phonenum_p').html('(000) 000 - 000');
			$('#modelphone').html('Business Phone Number : — ');
    	}else{
    		var con = $('#b_business_phone').val();
	        var curchr = con.length;
	        if (curchr == 3) {
	            $("#b_business_phone").val("(" + con + ")" + " ");
	        } else if (curchr == 9) {
	            $("#b_business_phone").val(con + " - ");
	        }
    		$('#phonenum_p').html($('#b_business_phone').val());
    		$('#modelphone').html('Business Phone Number : ' + $('#b_business_phone').val());

    	} 

    	
    }
    function addemail(){
    	if($('#b_business_email').val() == ''){
			$('#email_p').html('example@gmail.com');
			$('#modelemail').html('Business Email : — ' );
    	}else{
    		$('#email_p').html($('#b_business_email').val());
    		$('#modelemail').html('Business Email : ' + $('#b_business_email').val());
    	} 	
    }

    function addwebsite() {
    	if($('#business_website').val() != ''){
    		$('#modelweb').html('Website Address : ' + $('#business_website').val() );
    	}else{
    		$('#modelweb').html('Website Address : — ');
    	}
    }

    function adddesc() {
    	if($('#short_description').val() != ''){
    		$('#modeldesc').html('Business Description : ' + $('#short_description').val());
    	}else{
    		$('#modeldesc').html('Business Description : — ');
    	}
    } 

    function addbustype(val) {
    	str = $('#business_type').val().toLowerCase().replace(/\b[a-z]/g, function(letter) {
		    return letter.toUpperCase();
		});

		if($('#business_type').val() != ''){
    		$('#modelbustype').html('Business Type : ' + str);
    	}else{
    		$('#modelbustype').html('Business Type : Individual');
    	}
    }

    function addbusname() {
    	if($('#b_companyname').val() != ''){
    		$('#modelbusname').html('Business Name : ' + $('#b_companyname').val());
    	}else{
    		$('#modelbusname').html('Business Name : — ');
    	}
    	
    }

    function addownname() {
    	if($('#b_firstname').val() != ''){
    		$('#modelownername').html('Business Owners Name : ' + $('#b_firstname').val());
    	}else{
    		$('#modelownername').html('Business Owners Name : — ');
    	}
    }

</script>

{{-- <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap" async defer></script> --}}
{{-- <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ env('MAP_KEY') }}"></script>  --}}



@endsection

