<script type="text/javascript" src="/AdminLTE/plugins/bootstrap-slider/bootstrap-slider.js"></script>
<link rel="stylesheet" type="text/css" href="/AdminLTE/plugins/bootstrap-slider/slider.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.10/slimselect.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.10/slimselect.min.css" rel="stylesheet">
<link rel="stylesheet" href="/js/select/select.css" />
 <?php		
	 $program_type = '';
	 $service_type = '';
	 $service_type_two = '';
	 $activity_type = '';
	 $membership_type = '';
	 $activity_location = '';
	 $age_range  = '';

        if(Session::has('program_type')){ 
			$program_type = Session::get('program_type'); 
			/*print_r($program_type);exit();*/
		}

        if(Session::has('service_type')){ 
			$service_type = Session::get('service_type');
		}
		if(Session::has('service_type_two')){ 
			$service_type_two = Session::get('service_type_two'); 
		}
		if(Session::has('activity_type')){ 
			$activity_type = Session::get('activity_type'); 
			/*echo $activity_type;exit();*/
		}
		if(Session::has('membership_type')){ 
			$membership_type = Session::get('membership_type'); 
			/*echo $activity_type;exit();*/
		}
		if(Session::has('activity_location')){ 
			$activity_location = Session::get('activity_location'); 
			/*echo $activity_type;exit();*/
		}
		if(Session::has('age_range')){ 
			$age_range  = Session::get('age_range'); 
			/*echo $age_range;exit();*/
		}
?>

<!-- <form method="post" action="/" id="frmsearch"> -->
<!-- @csrf -->
<input type="text" name="session">
<div class="row">
    <div class="col-md-12">
		<div class="choose-sport-hire">

			<div class="activity-width">
				<div class="special-offer">
					<div class="multiples">
						<h2>Select Activity</h2>
						<select id="programservices" name="program_type[]" class="myfilter" multiple="multiple" onchange="actFilter()">
							<option>Aerobics</option>
							<option>Archery</option>
							<option>Badminton</option>
							<option>Barre</option>
							<option>Baseball</option>
							<option>Basketball</option>
							<option>Beach Vollyball</option>
							<option>Bouldering</option>
							<option>Bungee Jumping</option>
							<optgroup label="Camps & Clinics">
								<option>Day Camp</option>
								<option>Sleep Away</option>
								<option>Winter Camp</option>
							</optgroup>
							<option>Canoeing</option>
							<optgroup label="Cycling">
								<option>Indoor cycling</option>
							</optgroup>
							<option>Dance</option>
							<option>Diving</option>
							<optgroup label="Field Hockey">
								<option>Ice Hockey</option>
							</optgroup>
							<option>Football</option>
							<option>Golf</option>
							<option>Gymnastics</option>
							<option>Hang Gliding</option>
							<option>Hiit</option>
							<option>Hiking - Backpacking</option>
							<option>Horseback Riding</option>
							<option>Ice Skating</option>
							<option>Kayaking</option>
							<option>lacrosse</option>
							<option>Laser Tag</option>
							<optgroup label="Martial Arts">
								<option>Boxing</option>
								<option>Jiu-Jitsu</option>
								<option>Karate</option>
								<option>Kick Boxing</option>
								<option>Kung Fu</option>
								<option>MMA</option>
								<option>Self-Defense</option>
								<option>Tai Chi</option>
								<option>Wrestling</option>
							</optgroup>
							<option>Massage Therapy</option>
							<option>Nutrition</option>
							<option>Paint Ball</option>
							<option>Physical Therapy</option>
							<option>Pilates</option>
							<option>Rafting</option>
							<option>Rapelling</option>
							<option>Rock Climbing</option>
							<option>Rowing</option>
							<option>Running</option>
							<optgroup label="Sightseeing Tours">
								<option>Airplane Tour</option>
								<option>ATV Tours</option>
								<option>Boat Tours</option>
								<option>Bus Tour</option>
								<option>Caving Tours</option>
								<option>Helicopter Tour</option>
							</optgroup>
							<option>Sailing</option>
							<option>Scuba Diving</option>
							<option>Sky diving</option>
							<option>Snow Skiing</option>
							<option>Snowboarding</option>
							<option>Strength &amp; Conditioning</option>
							<option>Surfing</option>
							<option>Swimming</option>
							<option>Tennis</option>
							<option>Tours</option>
							<option>Vollyball</option>
							<option>Weight training</option>
							<option>Windsurfing</option>
							<option>Yoga</option>
							<option>Zip-Line</option>
							<option>Zumba</option>
						</select>
						<script type="text/javascript">
							var categ = new SlimSelect({
					            select: '#programservices'
					        });
						</script>
						 
					</div>
				</div>
			</div>
				
			<div class="activity-width">
				<div class="special-offer">
					<div class="multiples">
						<h2>Business Type</h2>
						<select id="service_type" name="service_type[]" class="myfilter" multiple="multiple" onchange="actFilter()">
							<option value="individual">Personal Trainer</option>
							<option value="classes">Gym/Studio</option>
							<option value="experience">Experience</option>
						</select>
						<script type="text/javascript">
							var categ = new SlimSelect({
					            select: '#service_type'
					        });
						</script>
					</div>
				</div>
			</div>
			
			<div class="activity-width">
				<div class="special-offer">
					<div class="multiples">
						<h2>Service Type</h2>
						<select id="servicetypetwo" name="service_type_two[]" class="myfilter" multiple="multiple"  onchange="actFilter()">
							<option>Personal Training</option>
                            <option>Coaching</option>
                            <option>Therapy</option>
                            <option>Group Class</option>
                            <option>Seminar</option>
                            <option>Workshop</option>
                            <option>Clinic</option>
                            <option>Camp</option>
                            <option>Team</option>
                            <option>Corporate</option>
                            <option>Tour</option>
                            <option>Adventure</option>
                            <option>Retreat</option>
                            <option>Workshop</option>
                            <option>Seminar</option>
                            <option>Private experience</option>
						</select>
						<script type="text/javascript">
							var categ = new SlimSelect({
					            select: '#servicetypetwo'
					        });
						</script>
					</div>
				</div>
			</div>
			
			<div class="activity-width">
				<div class="special-offer">
					<div class="multiples">
						<h2>Great For</h2>
						<select id="activity_for" multiple name="activity_type[]" class="myfilter"  multiple="multiple"  onchange="actFilter()">
							<option>Individual</option>
		                    <option>Kids</option>
		                    <option>Teens</option>
		                    <option>Adults</option>
		                    <option>Family</option>
		                    <option>Groups</option>
		                    <option>Paralympic</option>
		                    <option>Prenatal</option>
		                    <option>Any</option>
						</select>
						<script type="text/javascript">
					        var categ = new SlimSelect({
					            select: '#activity_for'
					        });
						</script>
					</div>
				</div>
			</div>
			
			<button  type="button" class="show-1-yes btn-hide-show" ><img class="filter-img" src="http://dev.fitnessity.co/public/img/filter-icon.png" width="25">More Filters</button>
			<button  type="button" class="hide-1-yes btn-hide-show"><img class="filter-img" src="http://dev.fitnessity.co/public/img/filter-icon.png" width="25">More Filters</button>
		
		</div>
		
		<div class="activity-width-one">  
			<div id="target-1">
				<div id="show-hide-container-1">
					<div class="points-cards-home-text"><a id="promo-step-2"></a>
						<div class="activity-width">
							<div class="special-offer">
								<div class="multiples">
									<h2>Membership Type</h2>
									<select id="membership_type" multiple name="membership_type[]" class="myfilter"  multiple="multiple"  onchange="actFilter()">
										<option>Drop In</option>
                    					<option>Semester</option>
									</select>
									<script type="text/javascript">
										var categ = new SlimSelect({
											select: '#membership_type'
										});
									</script>
								</div>
							</div>
						</div>
						
						<!-- <div class="activity-width">
							<div class="special-offer">
								<div class="multiples">
									<h2>Search By Activity</h2>
									<select id="search_by_activity" multiple name="[]" class="myfilter"  multiple="multiple"  onclick="actFilter()">
										<option>Search By Activity</option>
										<option>Search By Activity</option>
										<option>Search By Activity</option>
									</select>
									<script type="text/javascript">
										var categ = new SlimSelect({
											select: '#search_by_activity'
										});
									</script>
								</div>
							</div>
						</div> -->
						
						<div class="activity-width">
							<div class="special-offer">
								<div class="multiples">
									<h2>Search By Location</h2>
									<input id="pac-input" type="text" class="location-control myfilter" name="location" placeholder="search by country, city, state, zip" value="@if(isset($selected_location) && $selected_location != NULL){{$selected_location }}@endif" />
								</div>
							</div>
						</div>
						
						<div class="activity-width">
							<div class="special-offer">
								<div class="multiples">
									<h2>Location of Activity</h2>
									<select id="activity_location" multiple name="activity_location[]" class="myfilter"  multiple="multiple"  onchange="actFilter()">
										@foreach (@$serviceLocation as $slkey => $slval)
						                    <option value='{{$slval}}'>{{$slval}}</option>
					                    @endforeach
									</select>
									<script type="text/javascript">
										var categ = new SlimSelect({
											select: '#activity_location'
										});
									</script>
								</div>
							</div>
						</div>
						
						<div class="activity-width">
							<div class="special-offer">
								<div class="multiples">
									<h2>Age Range</h2>
									<select id="age_range" multiple name="age_range[]" class="myfilter"  multiple="multiple"  onchange="actFilter()">
										<option>Baby (0 to 12 months)</option>
					                    <option>Toddler (1 to 3 yrs.)</option>
					                    <option>Preschool (4 to 5 yrs.)</option>
					                    <option>Grade School (6 to 12 yrs.)</option>
					                    <option>Teen (13 to 17 yrs.)</option>
					                    <option>Young Adult (18 to 21 yrs.)</option>
					                    <option>Older Adult (21 to 39 yrs.)</option>
					                    <option>Middle Age (40 to 59 yrs.) </option>
					                    <option>Senior Adult (60 +)</option>
					                    <option>Any</option>
									</select>
									<script type="text/javascript">
										var categ = new SlimSelect({
											select: '#age_range'
										});
									</script>
								</div>
							</div>
						</div>
						
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>
<!-- </form> -->
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/jquery-1.9.1.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key={{ Config::get('constants.MAP_KEY') }}&sensor=false"></script>

<script>
    $(document).ready(function() {
   		
   		var programforarr = [];
	    var programfor = '{{ $activity_type }}';
	    if(programfor != ''){
	    	programfor = programfor.split(',');
		    $.each(programfor, function( index, value ) {
		        programforarr.push(value);
		    });
		    const serviceSelect4 = new SlimSelect({
		        select: '#activity_for'
		    });
		    serviceSelect4.set(programforarr);
	    }

	    var programtypearr = [];
	    var programtype = '{{ $program_type }}';
	    if(programtype != ''){
	    	programtype = programtype.split(',');
		    $.each(programtype, function( index, value ) {
		        programtypearr.push(value);
		    });
		    const serviceSelect1 = new SlimSelect({
		        select: '#programservices'
		    });
		    serviceSelect1.set(programtypearr);
	    }
	   
	    var service_typearr = [];
	    var service_type = '{{ $service_type }}';
	    /*alert(service_type);*/
	    if(service_type != ''){
	    	service_type = service_type.split(',');
		    $.each(service_type, function( index, value ) {
		        service_typearr.push(value);
		    });
		    const serviceSelect2 = new SlimSelect({
		        select: '#service_type'
		    });
		    serviceSelect2.set(service_typearr);
	    }

	    var service_type_twoarr = [];
	    var service_type_two = '{{ $service_type_two }}';
	    if(service_type_two != ''){
	    	service_type_two = service_type_two.split(',');
		    $.each(service_type_two, function( index, value ) {
		        service_type_twoarr.push(value);
		    });
		    const serviceSelect3 = new SlimSelect({
		        select: '#servicetypetwo'
		    });
		    serviceSelect3.set(service_type_twoarr);
	    }

	    var membership_typearr = [];
	    var membership_type = '{{ $membership_type }}';
	    if(membership_type != ''){
	    	membership_type = membership_type.split(',');
		    $.each(membership_type, function( index, value ) {
		        membership_typearr.push(value);
		    });
		    const serviceSelect5 = new SlimSelect({
		        select: '#membership_type'
		    });
		    serviceSelect5.set(membership_typearr);
	    }

	    var activity_locationarr = [];
	    var activity_location = '{{ $activity_location }}';
	    if(activity_location != ''){
	    	activity_location = activity_location.split(',');
		    $.each(activity_location, function( index, value ) {
		        activity_locationarr.push(value);
		    });
		    const serviceSelect3 = new SlimSelect({
		        select: '#activity_location'
		    });
		    serviceSelect3.set(activity_locationarr);
	    }

	    var age_rangearr = [];
	    var age_range = '{{ $age_range }}';
	    if(age_range != ''){
	    	age_range = age_range.split(',');
		    $.each(age_range, function( index, value ) {
		        age_rangearr.push(value);
		    });
		    const serviceSelect6 = new SlimSelect({
		        select: '#age_range'
		    });
		    serviceSelect6.set(age_rangearr);
	    }


	    if(membership_type != '' || age_range != '' || activity_location != '' ){
	    	$('#target-1').show(500);
		    $('.show-1-yes').hide(0);
		    $('.hide-1-yes').show(0);
	    }
	    
	   
	   $(".ss-value-delete").click(function(){
	   		/*alert('hii');*/

	   		var activity_for=$('#activity_for').val();
			var programservices=$('#programservices').val();
			var service_type=$('#service_type').val();
			var service_type_two=$('#servicetypetwo').val();
			var membership_type=$('#membership_type').val();
			var activity_location=$('#activity_location').val();
			var age_range=$('#age_range').val();

	   		var locationval = '';
			if(service_type !=  null && service_type != ''){
				service_type = service_type.toString().replace(/ /g, "%20");
				locationval += 'btype='+service_type+'~';
			}
			if(programservices != null && programservices != ''){
				programservices = programservices.toString().replace(/ /g, "%20");
				locationval += 'ptype='+programservices+'~';
			}

			if(service_type_two  != null &&  service_type_two != ''){
				service_type_two = service_type_two.toString().replace(/ /g, "%20");
				locationval += 'stype='+service_type_two+'~';
			}

			if(activity_for  != null &&  activity_for != ''){
				activity_for = activity_for.toString().replace(/ /g, "%20");
				locationval += 'gfor='+activity_for+'~';
			}

			if(membership_type != null &&  membership_type != ''){
				membership_type = membership_type.toString().replace(/ /g, "%20");
				locationval += 'memtype='+membership_type+'~';
			}

			if(activity_location != null &&  activity_location != ''){
				activity_location = activity_location.toString().replace(/ /g, "%20");
				locationval += 'actloctype='+activity_location+'~';
			}

			if(age_range != null &&  age_range != ''){
				age_range = age_range.toString().replace(/ /g, "%20");
				locationval += 'agerange='+age_range+'~';
			}

			var name = '{{ env('APP_URL') }}';
			var url = window.location.href;
			var urldynamic = name+'instant-hire/'+locationval;
			/*alert(url);
		alert(urldynamic);*/
			if(url != urldynamic){
				window.location = urldynamic;
			}
	   });
       
    });
</script>

<script>

	function actFilter()
	{  /*alert('hii');*/
		var sessionprogramfor = '{{ $activity_type }}';
		var sessionprogram_type = '{{ $program_type }}';
		var sessionservice_type= '{{ $service_type }}';
		var sessionservice_type_two = '{{ $service_type_two }}';
		var sessionmembership_type = '{{ $membership_type }}';
		var sessionactivity_location = '{{ $activity_location }}';
		var sessionage_range = '{{ $age_range }}';

		var activity_for=$('#activity_for').val();
		var programservices=$('#programservices').val();
		var service_type=$('#service_type').val();
		var service_type_two=$('#servicetypetwo').val();
		var membership_type=$('#membership_type').val();
		var activity_location=$('#activity_location').val();
		var age_range=$('#age_range').val();
		/*alert(age_range);*/
		if(activity_for == '' || activity_for == null){
			activity_for = 'no';
		}
		if(programservices == ''  || programservices == null){
			programservices = 'no';
		}
		if(service_type == '' || service_type == null){
			service_type = 'no';
		}
		if(service_type_two == '' || service_type_two == null){
			service_type_two = 'no';
		}
		if(membership_type == '' || membership_type == null){
			membership_type = 'no';
		}
		if(activity_location == '' || activity_location == null){
			activity_location = 'no';
		}
		if(age_range == '' || age_range == null){
			age_range = 'no';
		}

		if(sessionprogramfor == ''){
			sessionprogramfor = 'no';
		}
		else{
			if(activity_for == 'no'){
				activity_for = sessionprogramfor;
			}
		}

		if(sessionprogram_type == ''){
			sessionprogram_type = 'no';
		}
		else{
			if(programservices == 'no'){
				programservices = sessionprogram_type;
			}
		}

		if(sessionservice_type == ''){
			sessionservice_type = 'no';
		}
		else{
			if(service_type == 'no'){
				service_type = sessionservice_type;
			}
		}

		if(sessionservice_type_two == ''){
			sessionservice_type_two = 'no';
		}else{
			if(service_type_two == 'no'){
				service_type_two = sessionservice_type_two;
			}
		}

		if(sessionmembership_type == ''){
			sessionmembership_type = 'no';
		}else{
			if(membership_type == 'no'){
				membership_type = sessionmembership_type;
			}
		}

		if(sessionactivity_location == ''){
			sessionactivity_location = 'no';
		}else{
			if(activity_location == 'no'){
				activity_location = sessionactivity_location;
			}
		}

		if(sessionage_range == ''){
			sessionage_range = 'no';
		}else{
			if(age_range == 'no'){
				age_range = sessionage_range;
			}
		}

		

		/*alert(sessionprogram_type);
		alert(programservices);
		alert(sessionservice_type);
		alert(service_type);*/
		/*alert(sessionservice_type_two);
		alert(service_type_two);
		alert(sessionprogramfor);*/
	
		var locationval = '';

		if(service_type != 'no'){
			service_type = service_type.toString().replace(/ /g, "%20");
			locationval += 'btype='+service_type+'~';
		}

		if(programservices != 'no'){
			programservices = programservices.toString().replace(/ /g, "%20");
			locationval += 'ptype='+programservices+'~';
		}

		if(service_type_two != 'no'){
			service_type_two = service_type_two.toString().replace(/ /g, "%20");
			locationval += 'stype='+service_type_two+'~';
		}

		if(activity_for != 'no'){
			activity_for = activity_for.toString().replace(/ /g, "%20");
			locationval += 'gfor='+activity_for+'~';
		}

		if(membership_type != 'no'){
			membership_type = membership_type.toString().replace(/ /g, "%20");
			locationval += 'memtype='+membership_type+'~';
		}

		if(activity_location != 'no'){
			activity_location = activity_location.toString().replace(/ /g, "%20");
			locationval += 'actloctype='+activity_location+'~';
		}

		if(age_range != 'no'){
			age_range = age_range.toString().replace(/ /g, "%20");
			locationval += 'agerange='+age_range+'~';
		}
		/*alert(activity_location);*/

		/*if(programservices != 'no'){
			locationval += 'ptype='+programservices+'~';
		}*/
		var name = '{{ env('APP_URL') }}';
		var url = window.location.href;
		var urldynamic = name+'instant-hire/'+locationval;
		/*alert(url);
		alert(urldynamic);*/
		if(url != urldynamic){
			window.location = urldynamic;
		}
	}

</script>
<script>
$('.show-1-yes').click(function() {
    $('#target-1').show(500);
    $('.show-1-yes').hide(0);
    $('.hide-1-yes').show(0);
});
$('.hide-1-yes').click(function() {
    $('#target-1').hide(500);
    $('.show-1-yes').show(0);
    $('.hide-1-yes').hide(0);
});
</script>