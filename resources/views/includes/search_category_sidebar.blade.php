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
			print_r($activity_type);exit();
		}
?>

<!-- <form method="post" action="/activities" id="frmsearch"> -->
<!-- @csrf -->
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
		
		<!-- <div class="activity-width-one">  
			<div id="target-1">
			 
				<div id="show-hide-container-1">
					<div class="points-cards-home-text"><a id="promo-step-2"></a>
						<div class="activity-width">
							<div class="special-offer">
								<div class="multiples">
									<h2>Membership Type</h2>
									<select id="membership_type" multiple name="activity_type[]" class="myfilter"  multiple="multiple"  onclick="actFilter()">
										<option>Individual</option>
										<option>Kids</option>
										<option>Teens</option>
									</select>
									<script type="text/javascript">
										var categ = new SlimSelect({
											select: '#membership_type'
										});
									</script>
								</div>
							</div>
						</div>
						
						<div class="activity-width">
							<div class="special-offer">
								<div class="multiples">
									<h2>Search By Activity</h2>
									<select id="search_by_activity" multiple name="activity_type[]" class="myfilter"  multiple="multiple"  onclick="actFilter()">
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
						</div>
						
						<div class="activity-width">
							<div class="special-offer">
								<div class="multiples">
									<h2>Search By Location</h2>
									<select id="search_by_location" multiple name="activity_type[]" class="myfilter"  multiple="multiple"  onclick="actFilter()">
										<option>Search By Location</option>
										<option>Search By Location</option>
										<option>Search By Location</option>
										<option>Search By Location</option>
									</select>
									<script type="text/javascript">
										var categ = new SlimSelect({
											select: '#search_by_location'
										});
									</script>
								</div>
							</div>
						</div>
						
						<div class="activity-width">
							<div class="special-offer">
								<div class="multiples">
									<h2>Location of Activity</h2>
									<select id="location_of_activity" multiple name="activity_type[]" class="myfilter"  multiple="multiple"  onclick="actFilter()">
										<option>Location of Activity</option>
										<option>Location of Activity</option>
										<option>Location of Activity</option>
										<option>Location of Activity</option>
									</select>
									<script type="text/javascript">
										var categ = new SlimSelect({
											select: '#location_of_activity'
										});
									</script>
								</div>
							</div>
						</div>
						
						<div class="activity-width">
							<div class="special-offer">
								<div class="multiples">
									<h2>Age Range</h2>
									<select id="age_range" multiple name="activity_type[]" class="myfilter"  multiple="multiple"  onclick="actFilter()">
										<option>Age Range</option>
										<option>Age Range</option>
										<option>Age Range</option>
										<option>Age Range</option>
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
		</div> -->
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
	/*    alert(service_type);*/
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
	   
       
    });
</script>

<script>
	/*function actFilter()
	{   
		var sessionprogramfor = '{{ $activity_type }}';
		alert(sessionprogramfor);
		var programservices=$('#programservices').val();

		var service_type=$('#service_type').val();
		var service_type_two=$('#servicetypetwo').val();
		var activity_for=$('#activity_for').val();
		var _token = $('meta[name="csrf-token"]').attr('content');
		alert(activity_for);
		if(sessionprogramfor != activity_for){
			$.ajax({
				// url: "{{route('instant_hire_search_filter')}}",
				url: "{{url('/instant-hire')}}",
				type: 'POST',
				data:{
					_token: _token,
					type: 'POST',
					programservices:programservices,
					service_type:service_type,
					service_type_two:service_type_two,
					activity_for:activity_for,
				},
				success: function (response) {

					// /alert(response);
					// if(response != ''){
					// 	$('#activitylist').html(response);
					// }else{
					// 	$('#activitylist').html('<div class="col-md-4 col-sm-4 col-map-show"><p>No Activity Found.</p></div>');
					// }		
				}
			});
		}
	}*/


	function actFilter()
	{  /*alert('hii');*/
		var sessionprogramfor = '{{ $activity_type }}';
		var sessionprogram_type = '{{ $program_type }}';
		var sessionservice_type= '{{ $service_type }}';
		var sessionservice_type_two = '{{ $service_type_two }}';

		if(sessionprogramfor == ''){
			sessionprogramfor = 'no';
		}
		if(sessionprogram_type == ''){
			sessionprogram_type = 'no';
		}
		if(sessionservice_type == ''){
			sessionservice_type = 'no';
		}
		if(sessionservice_type_two == ''){
			sessionservice_type_two = 'no';
		}
		var activity_for=$('#activity_for').val();
		var programservices=$('#programservices').val();
		var service_type=$('#service_type').val();
		var service_type_two=$('#servicetypetwo').val();
			/*alert(service_type);*/

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
		/*alert(sessionprogram_type);
		alert(programservices);
		alert(sessionservice_type);
		alert(service_type);
		alert(sessionservice_type_two);
		alert(service_type_two);
		alert(sessionprogramfor);
		alert(activity_for);*/
		if(sessionprogramfor != activity_for || sessionprogram_type != programservices  || sessionservice_type != service_type  || sessionservice_type_two != service_type_two) 
		{
			window.location = '/activities/btype='+service_type;
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