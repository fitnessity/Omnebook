@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')
@section('content')
<?php
	use App\UserFavourite;
	use App\BusinessServicesFavorite;
	use Illuminate\Support\Str;
	use Illuminate\Support\Facades\Auth;
	use App\UserBookingDetail;
	use App\BusinessServiceReview;
	use App\BusinessPriceDetails;
	use App\BusinessActivityScheduler;
    use App\User;
    use App\AddrCities;    
    use App\CompanyInformation;    
    $locations = array("Viver Mind \u0026 Body","40.8079468","-73.96654219999999",354,"1660781252-Screenshot_20220316-094557_Instagram.jpg",0,0);
?>

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

<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>compare/style.css">
<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>compare/w3.css">
<link href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css" type="text/css" rel="stylesheet" />
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/Compare.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/jquery-1.9.1.min.js"></script>
<script src="{{ url('public/js/jquery-ui.multidatespicker.js') }}"></script>
<script src="{{ url('public/js/jquery-ui.min.js') }}"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<section class="direc-hire" style="margin-top:100px">
<!-- <form method="post" action="/instant-hire" id="frmsearch">
@csrf
<div class="container-fluid">
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
						
						<!--<div class="activity-width">
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
		</div> 
	</div>
</div>
</div>
</form> -->
</section>
	<section class="direc-hire" style="margin-top:30px">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="title">
						<h3>Find Activities Starting In The Next 8 Hrs for <?php echo date('l').', '.date('F d, Y'); ?></h3>
					</div>
				</div>
<!-- 				<div class="col-md-6">
					<div class="direc-right distance-block map-sp">
						<div class="mapsb">Show Maps
							<label class="switch" for="maps">
								<input type="checkbox" name="maps" id="maps" >
								<span class="slider round"></span>
							</label>
						</div>
					</div>
				</div> -->
				<div class="col-md-8 leftside-kickboxing kicks">
					<div class="row" id="activitylist">
						<?php
			                $companyid = $companyname = $serviceid = "";
							$companycity = $companycountry = $pay_price  = "";
			                if (!empty($todayservicedata)) {
			                    $servicetype = [];
			                    $i=0;
			                    foreach ($todayservicedata as $loop => $service) {
			                    	if($i<100){
				                        $company = $price = $businessSp = [];
										$serviceid = $service['id'];
				                        $sport_activity = $service['sport_activity'];
				                        $servicetype[$service['service_type']] = $service['service_type'];
				                        $area = !empty($service['area']) ? $service['area'] : 'Location';
				                        $company = CompanyInformation::where('id',$service['cid'])->first();
				                        if ($company!= '') {
			                                $companyid = $company->id;
			                                $companyname = $company->company_name;
											$companycity = $company->city;
											$companycountry = $company->country;
				                        }

				                        if ($service['profile_pic']!="") {
											if(File::exists(public_path("/uploads/profile_pic/thumb/" . $service['profile_pic']))) {
				                            	$profilePic = url('/public/uploads/profile_pic/thumb/'.$service['profile_pic']);
											} else {
												$profilePic = '/public/images/service-nofound.jpg';
											}
										}else{ $profilePic = '/public/images/service-nofound.jpg'; }
										
										$reviews_count = BusinessServiceReview::where('service_id', $service['id'])->count();
										$reviews_sum = BusinessServiceReview::where('service_id', $service['id'])->sum('rating');
										$reviews_avg=0;
										if($reviews_count>0)
										{	
											$reviews_avg= round($reviews_sum/$reviews_count,2); 
										}
										$redlink = str_replace(" ","-",$companyname)."/".$service['cid'];
										$service_type='';
										if($service['service_type']!=''){
											if( $service['service_type']=='individual' ) $service_type = 'Personal Training'; 
											else if( $service['service_type']=='classes' )	$service_type = 'Group Class'; 
											else if( $service['service_type']=='experience' ) $service_type = 'Experience'; 
										}
										$pricearr = [];
										$price_all = '';
										$ser_date = '';
										$price_allarray = BusinessPriceDetails::where('serviceid', $service['id'])->get();
										if(!empty($price_allarray)){
											foreach ($price_allarray as $key => $value) {
												if(date('l') == 'Saturday' || date('l') == 'Sunday'){
													$pricearr[] = $value->adult_weekend_price_diff;
												}else{
													$pricearr[] = $value->adult_cus_weekly_price;
												}
											}
										}
										if(!empty($pricearr)){
											$price_all = min($pricearr);
										}

										$bookscheduler='';
										$time='';
										
		 								$bookscheduler = BusinessActivityScheduler::where('serviceid', $service['id'])->orderby('id','asc')->first();
		 								/*print_r($bookscheduler);*/
		 								if(@$bookscheduler['set_duration']!=''){
											$tm=explode(' ',$bookscheduler['set_duration']);
											$hr=''; $min=''; $sec='';
											if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
											if($tm[2]!=0){ $min=$tm[2].'min. '; }
											if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
											if($hr!='' || $min!='' || $sec!='')
											{ $time =  $hr.$min.$sec; } 
										}
		 								/*echo $bookscheduler;exit;*/

							            if(@$bookscheduler['end_activity_date'] >= date('Y-m-d') &&  date("H:i:s") < $bookscheduler['shift_start'] ){ 
							                $ser_date = @$bookscheduler['shift_start']; 
							             }
								            
										$starttime = '';
										$curr = date("H:i:s");
										$time1 = new DateTime($curr);
									    $time2 = new DateTime($ser_date);
									    $time_diff = $time1->diff($time2);
									    var_dump($time2);
									    $red_style = $time2->getTimestamp() - $time1->getTimestamp() < 600 ? 'activity-time-main-red' : '';

									   	$hours = $time_diff->h;
									    $minutes = $time_diff->i;
									    $seconds = $time_diff->s;
									  
										if($hours != ''){
											$starttime .= $hours.' hr';
										}
										if($minutes != ''){
											$starttime .= ' '.$minutes.' min';
										}

										$startmin =0;
										$startsec =0;
										if($minutes != ''){
											$startmin = $minutes;
										}
										if($seconds != ''){
											$startsec = $seconds;
										}

										if($seconds != 0){
											$coundownt = $startmin * $startsec;
										}else{
											$coundownt = $startmin;
										}
										
										
		                	?>
							<div class="col-md-4">
								<div class="find-activity">
									<div class="row">
										<div class="col-md-4 col-sm-4">
											<img src="{{ $profilePic }}" >
										</div>
										<div class="col-md-8 col-sm-8 activity-data">
											<div class="row">
												<div class="col-md-6 col-sm-6 col-xs-6">
													<div class="activity-inner-data">
														<i class="fas fa-star"></i>
														<span> {{$reviews_avg}} ({{$reviews_count}}) </span>
													</div>
													@if($time != '')
														<div class="activity-hours">
															<span>{{$time}}</span>
														</div>
													@endif
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<div class="activity-city">
														<span>{{$companycity}}, {{$companycountry}}</span>
													@if(Auth::check())
													<?php
														$loggedId = Auth::user()->id;
														$favData = BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$service['id'])->orderby('id','desc')->first();                   
													?>
														<div class="serv_fav1" ser_id="{{$service['id']}}" data-id="serfavstarts">
															<a class="fav-fun-2" id="serfavstarts{{$service['id']}}">
																<?php
																	if( !empty($favData) ){ ?>
																		<i class="fas fa-heart"></i>
																	<?php }
																	else{ ?>
																		<i class="far fa-heart"></i>
																 <?php } ?></a>
														</div>
													@else
														<a class="fav-fun-2" href="{{ Config::get('constants.SITE_URL') }}/userlogin" ><i class="far fa-heart"></i></a>
													@endif
													</div>
												</div>
											</div>
											<div class="activity-information ">
												<span><a 
					                                <?php if (Auth::check()) { ?> 
					                                    href="{{ Config::get('constants.SITE_URL') }}/businessprofile/{{$redlink}}" 
					                                <?php } else { ?>
					                                    href="{{ Config::get('constants.SITE_URL') }}/userlogin" 
					                                <?php }?>
					                                    target="_blank">{{ $service['program_name'] }}</a></span>
												<p>{{ $service_type }} | {{ $service['sport_activity'] }}</p>
												<a c class="showall-btn" href="/activity-details/{{$service['id']}}">More Details</a>
											</div>
											<div class="row">
												<div class="col-md-6 col-sm-6 col-xs-6">
												@if($price_all != '')
													<div class="dollar-person">
														<span>From ${{$price_all}}/Person</span>
													</div>
												@endif
												</div>
												<div class="col-md-6 col-sm-6 col-xs-6">
													<div class="activity-time-main {{$red_style}}" >
														<span>Starts in {{$starttime}}</span>
													</div>
													<!-- <div id="clockdiv">
													  <div>
													    <span class="minutes{{$service['id']}}"></span>
													    <div class="smalltext{{$service['id']}}">Minutes</div>
													  </div>
													  <div>
													    <span class="seconds{{$service['id']}}"></span>
													    <div class="smalltext{{$service['id']}}">Seconds</div>
													  </div>
													</div> -->
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<!-- <script type="text/javascript">
								function getTimeRemaining(endtime) {
								 	var t = Date.parse(endtime) - Date.parse(new Date());
								  	var seconds = Math.floor((t / 1000) % 60);
								  	var minutes = Math.floor((t / 1000 / 60) % 60);
								  	var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
								  	var days = Math.floor(t / (1000 * 60 * 60 * 24));
								  	return {
									    'total': t,
									    'minutes': minutes,
									    'seconds': seconds
								  	};
								}

								function initializeClock(id, endtime) {
									var clock = document.getElementById(id);
									var minutesSpan = clock.querySelector('.minutes'+'{{$service['id']}}');
									var secondsSpan = clock.querySelector('.seconds'+'{{$service['id']}}');

								  	function updateClock() {
								    	var t = getTimeRemaining(endtime);
								    	/*alert(t);*/
								    	minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
								    	secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

								    	if (t.total <= 0) {
								      		clearInterval(timeinterval);
								    	}
								  	}

								  	updateClock();
								  	var timeinterval = setInterval(updateClock, 1000);
								}
								var dt ='{{$coundownt}}';
								console.log(dt);
								var deadline = new Date(Date.parse(new Date()) + parseInt(dt));
								initializeClock('clockdiv', deadline);
							</script> -->
						<?php 
									} 
									$i++;
								}
							}?>
						
					</div>
				</div>
			<div class="col-md-4 col-sm-12 col-xs-12 kickboxing_map mapskick">
				<div class="mysrchmap" style="display:none; position:relative; height:100vh;">
					<div id="map_canvas" style="position: absolute; top: 0; right: 0; bottom: 0; left: 0;"></div>
				</div>
				<div class="maparea">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24176.251535935986!2d-73.96828678121815!3d40.76133318281456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258c4d85a0d8d%3A0x11f877ff0b8ffe27!2sRoosevelt%20Island!5e0!3m2!1sen!2sin!4v1620041765199!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
				</div>
			</div>
			<div class="pagenation" style="display:none">
                <a href="#" class="active">1</a>
                <a href="#">2</a>
            </div>
        </div>

	</div>
</section>
@include('layouts.footer')
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
			document.getElementById('frmsearch').submit(); 
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


<script type="text/javascript">
	$(document).ready(function () {
		$(document).on('click', '.serv_fav1', function(){
	        var ser_id = $(this).attr('ser_id');
	        var id = $(this).attr('data-id');
	        var _token = $('meta[name="csrf-token"]'). attr('content');
	        $.ajax({
	            type: 'POST',
	            url: '{{route("service_fav")}}',
	            data: {
	                _token: _token,
	                ser_id: ser_id
	            },
	            success: function (data) {
	                if(data.status=='like')
					{
						$('#'+id+ser_id).html('<i class="fas fa-heart"></i>');
					}
					else
					{
						$('#'+id+ser_id).html('<i class="far fa-heart"></i>');
					}
	            }
	        });
	    });

	    $("#closeActreview").click(function(){
	    	$("#actreview").modal('hide');
			return false;
	    });
	
	    $(document).on('click', '.show-compare-detail', function () {
			$('.compare-model').modal('hide');
			let itemID = $(this).data('id');
			$('#mykickboxing'+itemID).modal('show');
		});

		$("#milesnew").on("change", function() {
	        var distance = $(this).val();
	        var zipcode = '562398';
	        var country = 'india';
	        var searchString = "new delhi";
	        
	        if(zipcode != '' || country != '') {
	        	searchString = zipcode + '&amp;' + country;
	        } else {
	        	searchString = ($("#exp_city").val() != "") ? $("#exp_city").val() : "new delhi";
	        }
	    });
    
	    $(".mapsb .switch .slider").click(function () {
	        $(".kickboxing_map").toggleClass("mapskick");
	        $(".leftside-kickboxing").toggleClass("kicks");
	    });

	});

</script>
@endsection