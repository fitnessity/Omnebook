@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
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

<link rel='stylesheet' type='text/css' href="{{env('APP_URL')}}<?php echo Config::get('constants.FRONT_CSS'); ?>frontend/general.css">
<link rel='stylesheet' type='text/css' href="{{env('APP_URL')}}<?php echo Config::get('constants.FRONT_CSS'); ?>responsive.css">
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
<form method="post" action="/instant-hire" id="frmsearch">
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
			
			<button  type="button" class="show-1-yes btn-hide-show" ><img class="filter-img" src="{{url('/public/img/filter-icon.png')}}" width="25" alt="Fitnessity">More Filters</button>
			<button  type="button" class="hide-1-yes btn-hide-show"><img class="filter-img" src="{{url('/public/img/filter-icon.png')}}" width="25" alt="Fitnessity">More Filters</button>
		
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
						</div>-->
						
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
</form>
</section>
	<section class="direc-hire" style="margin-top:30px">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-6">
					<div class="title">
						<h3>See All Activities</h3>
					</div>
				</div>
				<div class="col-md-6">
					<div class="direc-right distance-block map-sp">
						<div class="mapsb">Show Maps
							<label class="switch" for="maps">
								<input type="checkbox" name="maps" id="maps" >
								<span class="slider round"></span>
							</label>
						</div>
					</div>
				</div>
				<div class="col-md-8 leftside-kickboxing kicks">
					<div class="row" id="activitylist">
						<div class="col-md-4 col-sm-4 col-map-show">
							<div class="kickboxing-block">
								<div class="kickboxing-topimg-content">
									<img src="https://fitnessity.govindcrankrod.com/public/uploads/profile_pic/thumb/1654003844-yoga-outside.webp" class="productImg" alt="Fitnessity">
									<a class="fav-fun-2" href="/userlogin"><i class="far fa-heart"></i></a>
								</div>
								
								<div class="bottom-content">
									<div class="class-info">
										<div class="row">
											<div class="col-md-7 ratingtime">
												<div class="activity-inner-data">
													<i class="fas fa-star"></i>
													<span>5 (1)</span>
												</div>
												<div class="activity-hours">
													<span>23hr. 30min. </span>
												</div>
											</div>
											<div class="col-md-5 country-instant">
												<div class="activity-city">
													<span>New York, United States</span>
												</div>
											</div>
										</div>
									</div>
									<div class="activity-information  activites-height">
										<span><a href="/userlogin" target="_blank">Summer Yoga</a>
										</span>
										<p>Personal Training  | Baseball Lessons</p>
									</div>
									<hr>
									<div class="all-details">
										<!-- <a class="showall-btn" data-toggle="modal" data-target="#mykickboxing3">More Details</a> -->
										<a class="showall-btn" href="/activity-details/3">More Details</a>
										<p class="addToCompare" id="compid1" title="Add to Compare">COMPARE SIMILAR +</p>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-4 col-map-show">
							<div class="kickboxing-block">
								<div class="kickboxing-topimg-content">
									<img src="https://fitnessity.govindcrankrod.com/public/uploads/profile_pic/thumb/1654092155-dance3.jpg" class="productImg" alt="Fitnessity">
									<a class="fav-fun-2" href="/userlogin"><i class="far fa-heart"></i></a>
								</div>
								
								<div class="bottom-content">
									<div class="class-info">
										<div class="row">
											<div class="col-md-7 ratingtime">
												<div class="activity-inner-data">
													<i class="fas fa-star"></i>
													<span>0 (1)</span>
												</div>
												<div class="activity-hours">
														<span>45min. </span>
												</div>
											</div>
											<div class="col-md-5 country-instant">
												<div class="activity-city">
													<span>New York, United States</span>
												</div>
											</div>
										</div>
									</div>
									<div class="activity-information activites-height">
										<span><a href="/userlogin" target="_blank">Summer Dance</a>
										</span>
										<p>Experience  | Dance</p>
									</div>
									<hr>
									<div class="all-details">
										<!-- <a class="showall-btn" data-toggle="modal" data-target="#mykickboxing5">More Details</a> -->
										<a class="showall-btn" href="/activity-details/5">More Details</a>
										<p class="addToCompare" id="compid1" title="Add to Compare">COMPARE SIMILAR +</p>
									</div>
								</div>
							</div>
						</div>
							
						<div class="col-md-4 col-sm-4 col-map-show">
							<div class="kickboxing-block">
								<div class="kickboxing-topimg-content">
									<img src="https://fitnessity.govindcrankrod.com/public/uploads/profile_pic/thumb/1654093746-GettyImages-136131022-56ca8aa35f9b5879cc4e7a73.jpg" class="productImg" alt="Fitnessity">
										<a class="fav-fun-2" href="/userlogin"><i class="far fa-heart"></i></a>
								</div>
								
								<div class="bottom-content">
									<div class="class-info">
										<div class="row">
											<div class="col-md-7 ratingtime">
												<div class="activity-inner-data">
													<i class="fas fa-star"></i>
													<span>0 (0)</span>
												</div>
												<div class="activity-hours">
														<span>2hr. 30min. </span>
												</div>
											</div>
											<div class="col-md-5 country-instant">
												<div class="activity-city">
													<span>New York, United States</span>
												</div>
											</div>
										</div>
									</div>
									<div class="activity-information activites-height">
										<span><a href="/userlogin" target="_blank">Kickboxing Level 1</a>
										</span>
										<p>Personal Training  | Boxing</p>
									</div>
									<hr>
									<div class="all-details">
										<!-- <a class="showall-btn" data-toggle="modal" data-target="#mykickboxing6">More Details</a> -->
										<a class="showall-btn" href="/activity-details/6">More Details</a>
										<p class="addToCompare" id="compid1" title="Add to Compare">COMPARE SIMILAR +</p>
									</div>
								</div>
							</div>
						</div>
							
						<div class="col-md-4 col-sm-4 col-map-show">
							<div class="kickboxing-block">
								<div class="kickboxing-topimg-content">
									<img src="https://fitnessity.govindcrankrod.com/public/uploads/profile_pic/thumb/1654183325-badminton-1428046__480.jpg" class="productImg" alt="Fitnessity">
										<a class="fav-fun-2" href="/userlogin"><i class="far fa-heart"></i></a>
								</div>
								
								<div class="bottom-content">
									<div class="class-info">
										<div class="row">
											<div class="col-md-7 ratingtime">
												<div class="activity-inner-data">
													<i class="fas fa-star"></i>
													<span>0 (0)</span>
												</div>
												<div class="activity-hours">
														<span>23hr. 45min. </span>
												</div>
											</div>
											<div class="col-md-5 country-instant">
												<div class="activity-city">
													<span>New York, United States</span>
												</div>
											</div>
										</div>
									</div>
									<div class="activity-information activites-height">
										<span><a href="/userlogin" target="_blank">gym3</a>
										</span>
										<p>Group Classe  | Gymnastics</p>
									</div>
									<hr>
									<div class="all-details">
										<!-- <a class="showall-btn" data-toggle="modal" data-target="#mykickboxing16">More Details</a> -->
										<a class="showall-btn" href="/activity-details/16">More Details</a>
										<p class="addToCompare" id="compid1" title="Add to Compare">COMPARE SIMILAR +</p>
									</div>
								</div>
							</div>
						</div>
							
						<div class="col-md-4 col-sm-4 col-map-show">
							<div class="kickboxing-block">
								<div class="kickboxing-topimg-content">
									<img src="https://fitnessity.govindcrankrod.com/public/uploads/profile_pic/thumb/1654693172-Aerobics-1.jpg" class="productImg" alt="Fitnessity">
										<a class="fav-fun-2" href="/userlogin"><i class="far fa-heart"></i></a>
								</div>
								
								<div class="bottom-content">
									<div class="class-info">
										<div class="row">
											<div class="col-md-7 ratingtime">
												<div class="activity-inner-data">
													<i class="fas fa-star"></i>
													<span>0 (0)</span>
												</div>
												<div class="activity-hours">
													<span>1hr. 30min. </span>
												</div>
											</div>
											<div class="col-md-5 country-instant">
												<div class="activity-city">
													<span>New York, United States</span>
												</div>
											</div>
										</div>
									</div>
									<div class="activity-information activites-height">
										<span><a href="/userlogin" target="_blank">Aerobics 2022</a>
										</span>
										<p>Personal Training  | Aerobics</p>
									</div>
									<hr>
									<div class="all-details">
										<!-- <a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a> -->
										<a class="showall-btn" href="/activity-details/17">More Details</a>
										<p class="addToCompare" id="compid1" title="Add to Compare">COMPARE SIMILAR +</p>
									</div>
								</div>
							</div>
						</div>
								
						<div class="col-md-4 col-sm-4 col-map-show">
							<div class="kickboxing-block">
								<div class="kickboxing-topimg-content">
									<img src="https://fitnessity.govindcrankrod.com/public/uploads/profile_pic/thumb/1655126994-5.jpg" class="productImg" alt="Fitnessity">
									<a class="fav-fun-2" href="/userlogin"><i class="far fa-heart"></i></a>
								</div>
								
								<div class="bottom-content">
									<div class="class-info">
										<div class="row">
											<div class="col-md-7 ratingtime">
												<div class="activity-inner-data">
													<i class="fas fa-star"></i>
													<span>0 (0)</span>
												</div>
												<div class="activity-hours">
													<span>4hr. </span>
												</div>
											</div>
											<div class="col-md-5 country-instant">
												<div class="activity-city">
													<span>New York, United States</span>
												</div>
											</div>
										</div>
									</div>
									<div class="activity-information activites-height">
										<span><a href="/userlogin" target="_blank">Summer Aerobics</a>
										</span>
										<p>Personal Training  | Aerobics</p>
									</div>
									<hr>
									<div class="all-details">
										<!-- <a class="showall-btn" data-toggle="modal" data-target="#mykickboxing20">More Details</a> -->
										<a class="showall-btn" href="/activity-details/20">More Details</a>
										<p class="addToCompare" id="compid1" title="Add to Compare">COMPARE SIMILAR +</p>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-4 col-map-show">
							<div class="kickboxing-block">
								<div class="kickboxing-topimg-content">
									<img src="https://fitnessity.govindcrankrod.com/public/uploads/profile_pic/thumb/1655389294-badminton-1428046__480.jpg" class="productImg" alt="Fitnessity">
									<a class="fav-fun-2" href="/userlogin"><i class="far fa-heart"></i></a>
								</div>
								
								<div class="bottom-content">
									<div class="class-info">
										<div class="row">
											<div class="col-md-7 ratingtime">
												<div class="activity-inner-data">
													<i class="fas fa-star"></i>
													<span>0 (0)</span>
												</div>
												<div class="activity-hours">
													<span>1hr. </span>
												</div>
											</div>
											<div class="col-md-5 country-instant">
												<div class="activity-city">
													<span>New York, United States</span>
												</div>
											</div>
										</div>
									</div>
									<div class="activity-information activites-height">
										<span><a href="/userlogin" target="_blank">test2adasd</a>
										</span>
										<p>Experience  | Beach Vollyball</p>
									</div>
									<hr>
									<div class="all-details">
										<!-- <a class="showall-btn" data-toggle="modal" data-target="#mykickboxing36">More Details</a> -->
										<a class="showall-btn" href="/activity-details/36">More Details</a>
										<p class="addToCompare" id="compid1" title="Add to Compare">COMPARE SIMILAR +</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-map-show">
							<div class="kickboxing-block">
								<div class="kickboxing-topimg-content">
									<img src="/public/images/service-nofound.jpg" class="productImg" alt="Fitnessity">
									<a class="fav-fun-2" href="/userlogin"><i class="far fa-heart"></i></a>
								</div>
								
								<div class="bottom-content">
									<div class="class-info">
										<div class="row">
											<div class="col-md-7 ratingtime">
												<div class="activity-inner-data">
													<i class="fas fa-star"></i>
													<span>0 (0)</span>
												</div>
												<div class="activity-hours">
														<span>1hr. 30min. </span>
													</div>
												</div>
											<div class="col-md-5 country-instant">
												<div class="activity-city">
													<span>New York, United States</span>
												</div>
											</div>
										</div>
									</div>
									<div class="activity-information activites-height">
										<span><a href="/userlogin" target="_blank">test badminton1232</a>
										</span>
										<p>Personal Training  | Badminton</p>
									</div>
									<hr>
									<div class="all-details">
										<!-- <a class="showall-btn" data-toggle="modal" data-target="#mykickboxing92">More Details</a> -->
										<a class="showall-btn" href="/activity-details/92">More Details</a>
										<p class="addToCompare" id="compid1" title="Add to Compare">COMPARE SIMILAR +</p>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-4 col-map-show">
							<div class="kickboxing-block">
								<div class="kickboxing-topimg-content">
									<img src="https://fitnessity.govindcrankrod.com/public/uploads/profile_pic/thumb/1660784581-IMG-20220817-WA0023.jpg" class="productImg" alt="Fitnessity">
										<a class="fav-fun-2" href="/userlogin"><i class="far fa-heart"></i></a>
								</div>
								
								<div class="bottom-content">
									<div class="class-info">
										<div class="row">
											<div class="col-md-7 ratingtime">
												<div class="activity-inner-data">
													<i class="fas fa-star"></i>
													<span>0 (2)</span>
												</div>
													<div class="activity-hours">
														<span>1hr. </span>
													</div>
											</div>
											<div class="col-md-5 country-instant">
												<div class="activity-city">
													<span>New York, US</span>
												</div>
											</div>
										</div>
									</div>
									<div class="activity-information activites-height">
										<span><a href="/userlogin" target="_blank">Yoga Personal Training Session with Christiane</a>
										</span>
										<p>Personal Training  | Yoga Classes</p>
									</div>
									<hr>
									<div class="all-details">
										<!-- <a class="showall-btn" data-toggle="modal" data-target="#mykickboxing93">More Details</a> -->
										<a class="showall-btn" href="/activity-details/93">More Details</a>
										<p class="addToCompare" id="compid1" title="Add to Compare">COMPARE SIMILAR +</p>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-md-4 col-sm-4 col-map-show">
							<div class="kickboxing-block">
								<div class="kickboxing-topimg-content">
									<img src="/public/images/service-nofound.jpg" class="productImg" alt="Fitnessity">
									<a class="fav-fun-2" href="/userlogin"><i class="far fa-heart"></i></a>
								</div>
								<div class="bottom-content">
									<div class="class-info">
										<div class="row">
											<div class="col-md-7 ratingtime">
												<div class="activity-inner-data">
													<i class="fas fa-star"></i>
													<span>0 (0)</span>
												</div>
												<div class="activity-hours">
														<span>1hr. 30min. </span>
												</div>
											</div>
											<div class="col-md-5 country-instant">
												<div class="activity-city">
													<span>New York, United States</span>
												</div>
											</div>
										</div>
									</div>
									<div class="activity-information activites-height">
										<span><a href="/userlogin" target="_blank">test11</a>
										</span>
										<p>Personal Training  | Badminton</p>
									</div>
									<hr>
									<div class="all-details">
										<!-- <a class="showall-btn" data-toggle="modal" data-target="#mykickboxing95">More Details</a> -->
										<a class="showall-btn" href="/activity-details/95">More Details</a>
										<p class="addToCompare" id="compid1" title="Add to Compare">COMPARE SIMILAR +</p>
									</div>
								</div>
							</div>
						</div>
						
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
		<div class="row align-self-center">
			<div class="col-md-6">
				<div class="text-center ptb-65">
				<button id="" class="showall-btn" type="button">Load More</button>
				</div>
			</div>
		</div>
	</div>
</section>
@include('layouts.business.footer')
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