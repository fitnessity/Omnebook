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



<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>compare/style.css">
<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>compare/w3.css">
<link href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css" type="text/css" rel="stylesheet" />
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/Compare.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/jquery-1.9.1.min.js"></script>
<script src="{{ url('public/js/jquery-ui.multidatespicker.js') }}"></script>
<script src="{{ url('public/js/jquery-ui.min.js') }}"></script>


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<section class="instant-hire" >
	<div class="instant-banner">
		<img src="/public/uploads/discover/thumb/1649648909-tennis 1.jpg" alt="Fitnessity">
		<h4>Find A Personal Training Session</h4>
	</div>
</section>

<section class="instant-hire-activites">
	<div class="container-fluid">
		<?php /*?><div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="title">
					<h3>Get Started Fast</h3>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="instant-section-info">
					<img src="{{ url('public/uploads/discover/thumb/1649648909-tennis 1.jpg')}}" >
					<h4>Find A Personal Training Session</h4>
					<p>Book a Private lesson for the activity that interest you.</p>
					<!-- <button id="84" class="showall-btn btn-position" type="button">Show all</button> -->
					<a id="84" class="showall-btn btn-position" href="/showall-activity" >Show all</a>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="instant-section-info">
					<img  src="{{ url('public/uploads/discover/thumb/1649648481-yoga classes.jpg') }}">
					<h4>Find Ways to Workout</h4>
					<p>Book classes, seminars, workshops, camps, and more</p>
					<button id="84" class="showall-btn btn-position" type="button">Show all</button>
				</div>
			</div>	
			<div class="col-md-4 col-sm-4 col-xs-12">
				<div class="instant-section-info">
					<img src="{{ url('public/uploads/discover/thumb/1649648221-snow ski.jpg')}}">
					<h4>Stay Active With Fun Things To Do</h4>
					<p>Turn your weekend of vacation into an adventure</p>
					<button id="84" class="showall-btn btn-position" type="button">Show all</button>
				</div>
			</div>	
		</div><?php */?>
		@include('includes.search_category_sidebar')
		<?php 
			$start_date = date('Y/m/d');  
			$date = strtotime($start_date);
			$date = strtotime("+8 hours", $date);
			
		?>

		@if(count($todayservicedata)>0)
		<div class="fst-0 fsb-1">
			<div class="row">
				<div class="col-md-10">
					<div class="title">
						<h3>Find Activities Starting In The Next 8 Hrs for <?php echo date('l').', '.date('F d, Y', $date); ?></h3>
					</div>
				</div>
				<div class="col-md-2">
					<div class="title-show">
						<a href="{{route('show-all-list')}}">Show All</a>
					</div>
				</div>
				<?php
	                $companyid = $companyname = $serviceid = "";
					$companycity = $companycountry = $pay_price  = "";
	                if (!empty($todayservicedata)) {
	                    $servicetype = [];
	                    $i=0;
	                    foreach ($todayservicedata as $loop => $service) {
	                    	if($i<3){
		                        $company = $price = $businessSp = [];
								$serviceid = $service['id'];
		                        $sport_activity = $service['sport_activity'];
		                        $servicetype[$service['service_type']] = $service['service_type'];
		                        $area = !empty($service['area']) ? $service['area'] : 'Location';
		                        $company = CompanyInformation::where('id',$service['cid'])->first();
		                        if ($company!= '') {
	                                $companyid = $company->id;
	                                $companyname = $company->dba_business_name;
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
									else if( $service['service_type']=='classes' )	$service_type = 'Group Classe'; 
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
								
 								$bookscheduler = BusinessActivityScheduler::where('serviceid', $service['id'])->orderby('id','desc')->first();
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
								/*echo $curr;*/
								$time1 = new DateTime($curr);
							    $time2 = new DateTime($ser_date);
							    $time_diff = $time1->diff($time2);
							   	$hours = $time_diff->h;
							    $minutes = $time_diff->i;
							    $seconds = $time_diff->s;
								if($hours != ''){
									$starttime .= $hours.' hr';
								}
								if($minutes != ''){
									$starttime .= ' '.$minutes.' min';
								}
								/*if($seconds != ''){
									$starttime .= ' '.$seconds.' sec';
								}*/
                	?>
					<div class="col-md-4">
						<div class="find-activity">
							<div class="row">
								<div class="col-md-4">
									<img src="{{ $profilePic }}" alt="Fitnessity">
								</div>
								<div class="col-md-8 activity-data">
									<div class="row">
										<div class="col-md-6">
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
										<div class="col-md-6">
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
									<div class="activity-information"> 
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
											<div class="activity-time-main">
												<span>Starts in {{$starttime}}</span>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php 
							} 
							$i++;
						}
					}?>
			</div>
		</div>
		@endif
		
	<section class="direc-hire" >
		<div class="">
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
								<input type="checkbox" name="maps" id="maps">
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
									<div class="activity-information activites-height">
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
				<div class="mysrchmap" style="display:none; position:relative; ">
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
		<!--<div class="row">
			<div class="col-md-12">
				<div class="direc-right distance-block map-sp">
					<div class="mapsb">Show Maps
						<label class="switch" for="maps">
							<input type="checkbox" name="maps" id="maps" checked>
							<span class="slider round"></span>
						</label>
					</div>
				</div>
			</div>
		</div>-->

		
		<!--<div class="row">
			<div class="col-md-6">
				<div class="title">
					<h3>New Trainers & Coaches</h3>
				</div>
			</div>
			<div class="col-md-6">
				<div class="nav-sliders-activites">
					<label>{{count($thismonthactivity)}} Results </label>
					<a href="#">Show All </a>
				</div>
			</div>
			<div class="col-md-12 leftside-kickboxing" id="activitylist">
				<div class="row"> 
					<div class="ptb-65 float-left w-100 discover_activities" id="counter">
						<div class="container-fluid">
							<div class="owl-slider kickboxing-slider-activites">
								<div id="carousel-slidertwo" class="owl-carousel">
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
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
        </div>-->
		
		<!--<div class="row">
			<div class="col-md-6">
				<div class="title">
					<h3>Most Popular Trainers & Coaches</h3>
				</div>
			</div>
			<div class="col-md-6">
				<div class="nav-sliders-activites">
					<label>{{count($thismonthactivity)}} Results </label>
					<a href="#">Show All </a>
				</div>
			</div>
			<div class="col-md-12 leftside-kickboxing" id="activitylist">
				<div class="row"> 
					<div class="ptb-65 float-left w-100 discover_activities" id="counter">
						<div class="container-fluid">
							<div class="owl-slider kickboxing-slider-activites">
								<div id="carousel-sliderthree" class="owl-carousel">
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
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
        </div>-->
		
		<!--<div class="row">
			<div class="col-md-6">
				<div class="title">
					<h3>Most Book Activities with Trainers & Coaches</h3>
				</div>
			</div>
			<div class="col-md-6">
				<div class="nav-sliders-activites">
					<label>{{count($thismonthactivity)}} Results </label>
					<a href="#">Show All </a>
				</div>
			</div>
			<div class="col-md-12 leftside-kickboxing" id="activitylist">
				<div class="row"> 
					<div class="ptb-65 float-left w-100 discover_activities" id="counter">
						<div class="container-fluid">
							<div class="owl-slider kickboxing-slider-activites">
								<div id="carousel-sliderfour" class="owl-carousel">
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
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
        </div>-->
		
		<!--<div class="row">
			<div class="col-md-6">
				<div class="title">
					<h3>Find fun things to do with Trainers & Coaches</h3>
				</div>
			</div>
			<div class="col-md-6">
				<div class="nav-sliders-activites">
					<label>{{count($thismonthactivity)}} Results </label>
					<a href="#">Show All </a>
				</div>
			</div>
			<div class="col-md-12 leftside-kickboxing" id="activitylist">
				<div class="row"> 
					<div class="ptb-65 float-left w-100 discover_activities" id="counter">
						<div class="container-fluid">
							<div class="owl-slider kickboxing-slider-activites">
								<div id="carousel-sliderfive" class="owl-carousel">
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
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
        </div>-->

		<div class="row">
			<div class="col-md-6">
				<div class="title">
					<h3>See all activities</h3>
				</div>
			</div>
			<div class="col-md-6">
				<div class="nav-sliders-activites">
					<label>{{count($thismonthactivity)}} Results </label>
					<a href="#">Show All </a>
				</div>
			</div>
			<div class="col-md-12 leftside-kickboxing" id="activitylist">
				<div class="row"> 
					<div class="ptb-65 float-left w-100 discover_activities" id="counter">
						<div class="container-fluid">
							<div class="owl-slider kickboxing-slider-activites">
								<div id="carousel-slidersix" class="owl-carousel">
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<div class="inner-owl-slider-hire">
													<div id="owl-demo-owl" class="owl-carousel owl-theme">
														<div class="item-inner">
															<img src="/public/uploads/profile_pic/1665035110-hip-hop-dance-class-700x400.jpg" class="productImg" alt="Fitnessity">
														</div>
														<div class="item-inner">
															<img src="/public/uploads/profile_pic/1665035030-kung fu.jpg" class="productImg" alt="Fitnessity">
														</div>
														<div class="item-inner">
															<img src="/public/uploads/profile_pic/1665971623-yoga.jpg" class="productImg" alt="Fitnessity">
														</div>
													</div>
												</div>
												<!--<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">-->
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<div class="inner-owl-slider-hire">
													<div id="owl-demo-activity" class="owl-carousel owl-theme">
														<div class="item-inner">
															<img src="/public/uploads/profile_pic/1665035110-hip-hop-dance-class-700x400.jpg" class="productImg" alt="Fitnessity">
														</div>
														<div class="item-inner">
															<img src="/public/uploads/profile_pic/1665035030-kung fu.jpg" class="productImg" alt="Fitnessity">
														</div>
														<div class="item-inner">
															<img src="/public/uploads/profile_pic/1665971623-yoga.jpg" class="productImg" alt="Fitnessity">
														</div>
													</div>
												</div>
												<!--<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">-->
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<div class="inner-owl-slider-hire">
													<div id="owl-demo-activitys" class="owl-carousel owl-theme">
														<div class="item-inner">
															<img src="/public/uploads/profile_pic/1665035110-hip-hop-dance-class-700x400.jpg" class="productImg" alt="Fitnessity">
														</div>
														<div class="item-inner">
															<img src="/public/uploads/profile_pic/1665035030-kung fu.jpg" class="productImg" alt="Fitnessity">
														</div>
														<div class="item-inner">
															<img src="/public/uploads/profile_pic/1665971623-yoga.jpg" class="productImg" alt="Fitnessity">
														</div>
													</div>
												</div>
												<!--<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">-->
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<div class="inner-owl-slider-hire">
													<div id="owl-demo-learn" class="owl-carousel owl-theme">
														<div class="item-inner">
															<img src="/public/uploads/profile_pic/1665035110-hip-hop-dance-class-700x400.jpg" class="productImg" alt="Fitnessity">
														</div>
														<div class="item-inner">
															<img src="/public/uploads/profile_pic/1665035030-kung fu.jpg" class="productImg" alt="Fitnessity">
														</div>
														<div class="item-inner">
															<img src="/public/uploads/profile_pic/1665971623-yoga.jpg" class="productImg" alt="Fitnessity">
														</div>
													</div>
												</div>
												<!--<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">-->
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<div class="inner-owl-slider-hire">
													<div id="owl-demo-learn-activites" class="owl-carousel owl-theme">
														<div class="item-inner">
															<img src="/public/uploads/profile_pic/1665035110-hip-hop-dance-class-700x400.jpg" class="productImg" alt="Fitnessity">
														</div>
														<div class="item-inner">
															<img src="/public/uploads/profile_pic/1665035030-kung fu.jpg" class="productImg" alt="Fitnessity">
														</div>
														<div class="item-inner">
															<img src="/public/uploads/profile_pic/1665971623-yoga.jpg" class="productImg" alt="Fitnessity">
														</div>
													</div>
												</div>
												<!--<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">-->
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<div class="inner-owl-slider-hire">
													<div id="owl-demo-jeck" class="owl-carousel owl-theme">
														<div class="item-inner">
															<img src="/public/uploads/profile_pic/1665035110-hip-hop-dance-class-700x400.jpg" class="productImg" alt="Fitnessity">
														</div>
														<div class="item-inner">
															<img src="/public/uploads/profile_pic/1665035030-kung fu.jpg" class="productImg" alt="Fitnessity">
														</div>
														<div class="item-inner">
															<img src="/public/uploads/profile_pic/1665971623-yoga.jpg" class="productImg" alt="Fitnessity">
														</div>
													</div>
												</div>
												<!--<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">-->
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<div class="inner-owl-slider-hire">
													<div id="owl-demo-yoga" class="owl-carousel owl-theme">
														<div class="item-inner">
															<img src="/public/uploads/profile_pic/1665035110-hip-hop-dance-class-700x400.jpg" class="productImg" alt="Fitnessity">
														</div>
														<div class="item-inner">
															<img src="/public/uploads/profile_pic/1665035030-kung fu.jpg" class="productImg" alt="Fitnessity">
														</div>
														<div class="item-inner">
															<img src="/public/uploads/profile_pic/1665971623-yoga.jpg" class="productImg" alt="Fitnessity">
														</div>
													</div>
												</div>
												<!--<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">-->
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>
									<!--<div class="item">
										<div class="kickboxing-block">
											<div class="kickboxing-topimg-content">
												<img src="/public/uploads/discover/thumb/1649648481-yoga classes.jpg" class="productImg">
												<a class="fav-fun-2" href="#"><i class="far fa-heart"></i></a>
												<span>From $25/Person</span>
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
												<div class="activity-information">
													<span>Learn How To Do Astanga Yogo In Central Park</span>
													<p>Group Class | Yoga</p>
												</div>
												<hr>
												<div class="all-details">
													<a class="showall-btn" data-toggle="modal" data-target="#mykickboxing17">More Details</a>
												</div>
											</div>
										</div>
									</div>-->
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
		
		<!--<div class="row align-self-center">
			<div class="col-md-6">
				<div class="text-center">
				<button id="" class="showall-btn" type="button">Load More</button>
				</div>
			</div> 
		</div>-->

		
		
		<div class="row align-self-center">
			<div class="col-md-6 col-xs-12">
				<div class="find-business">
					<div class="row">
						<div class="col-md-8">
							<div class="">
								<p>Can't Find A Business Offering Your Favorite Activity?</p>
								<p class="inner-txt">You can add a business to fitnessity for free.</p>
							</div>
						</div>
						<div class="col-md-4">
							<div class="btn-txt">
								<a href="#" class="showall-btn" data-toggle="modal" data-target="#addbusiness">Add A Business</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>		
</section>      

<!--preview panel-->
<div class="w3-container w3-center">
    <div class="w3-row w3-card-4 w3-round-large w3-border comparePanle w3-margin-top">
        <div class="w3-row">
            <div class="w3-col l12 m12 s12 w3-margin-top">
                <h4 style="text-transform: uppercase; font-weight: bold; margin-bottom: 30px;">
                    Added for Comparison
                    <span title="Close" class="closeItems" style="float:right; padding-right:15px; cursor: pointer;color:#ea1515">
                    <i class="fas fa-times-circle"></i> </span>
                </h4>                            
            </div>
        </div>
        <div class=" titleMargin w3-container comparePan">
            <button type="button" class="btn btn-primary notActive cmprBtn addtcmpr-btn" data-toggle="modal" data-target="#myModal">Compare</button>
        </div>
    </div>
</div>

<!--end of preview panel-->
<!-- The Modal Add Business-->
<div class="modal fade compare-model" id="addbusiness">
    <div class="modal-dialog modal-lg business">
        <div class="modal-content">
			<div class="modal-header" style="text-align: right;"> 
			  	<div class="closebtn">
					<button type="button" class="close close-btn-design" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
			</div>

            <!-- Modal body -->
            <div class="modal-body">
				<div class="row contentPop">
					<div class="col-lg-12">
					   <h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 600;">ADD BUSINESS</h4>
					</div>
                    <div class="col-lg-12">
                        <div class="modal-inner-txt">
                        	<p>Are you a customer or business owner wanting to add information about a business? <br>It’s free to add to Fitnessity!</p>
                        </div>
                    </div>
					<div class="col-lg-12 btns-modal">
						<a href="{{url('/instant-hire')}}" class="addbusiness-btn-modal">I'M A CUSTOMER</a>
						<a href="{{url('/claim-your-business')}}" class="addbusiness-btn-black">I'M A BUSINESS OWNER</a>
					</div>
				 </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<!-- The Modal -->
<div class="modal fade compare-model" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
			<div class="modal-header" style="text-align: right;">
			  <button class="clear_compare_list" type="button" style="color: white; border-color: red; background-color: red; margin-top: -5px;" data-dismiss="modal">×</button>
			</div>

            <!-- Modal body -->

            <div class="modal-body" style="padding: 0px;">
				<div class="row contentPop">
					<div class="col-lg-12 theme-black-bgcolor">
					   <h4 class="modal-title" style="text-align: center; color: white; line-height: inherit; padding: 6px;">COMPARE WITH SIMILAR ITEMS</h4>
					</div>
                    <div class="col-lg-12" style="padding-left: 0;padding-right: 0;">
                        <div class="comparetable compare-records-div">
                        </div>
                    </div>
				</div>
            </div>
        </div>
    </div>
</div>

<!-- comparision popup-->

<!--end of comparision popup-->

<!--  warning model  -->


<div id="WarningModal" class="w3-modal">
    <div class="w3-modal-content warningModal">
        <header class="w3-container w3-teal" style="background-color:#f53b49 !important;">
            <h3>
                <span>&#x26a0;</span> You cannot compare more then 3 Activity
                <button id="warningModalClose" onclick="document.getElementById('id01').style.display='none'" class="w3-btn w3-hexagonBlue w3-margin-bottom" style="float:right;background-color:#f53b49 !important;">X</button>
            </h3>
        </header>
        <div class="w3-container">
            <h4>Maximum of Three products are allowed for comparision</h4>
        </div>
    </div>
</div>

<!--  end of warning model  -->

<div class="modal fade compare-model11" id="actreview">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="text-align: right;">
            	<button class="clear_compare_list" type="button" style="color: white; border-color: red; background-color: red; margin-top: -5px;" id="closeActreview" >×</button>
            </div>

            <div class="modal-body" style="padding: 0px;">
				<div class="row">
					<div class="col-lg-12">
                    	<div id="actreviewBody" class="service-review actreviewBody">
                        	
                        </div>
            		</div>
				</div>
			</div>     
		</div>
	</div>
</div>                  

<!-- The Modal Add Business-->
    <div class="modal fade compare-model" id="addbusiness">
        <div class="modal-dialog modal-lg business">
            <div class="modal-content">
				<div class="modal-header" style="text-align: right;"> 
					<div class="closebtn">
						<button type="button" class="close close-btn-design-part" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
				</div>
                <!-- Modal body -->
                <div class="modal-body">
					<div class="row">
						<div class="col-lg-12">
							<h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 600;">ADD BUSINESS</h4>
						</div>
                        <div class="col-lg-12">
                            <div class="modal-inner-txt">
                                <p>Are you a customer or business owner wanting to add information about a business? <br>It’s free to add to Fitnessity!</p>
                            </div>
                        </div>
						<div class="col-lg-12 btns-modal">
							<a href="/instant-hire" class="addbusiness-btn-modal">I'M A CUSTOMER</a>
							<a href="/claim-your-business" class="addbusiness-btn-black">I'M A BUSINESS OWNER</a>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
<!-- end modal -->

@include('layouts.footer')
	
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
<script>
$(document).ready(function () {
    var locations = @json($locations);
   /* alert(locations);*/
    var map = ''
    var infowindow = ''
    var marker = ''
    var markers = []
    var circle = ''
    $('#map_canvas').empty();

    if (locations.length != 0) {  console.log('!empty');
        map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom:18,
            center: new google.maps.LatLng(locations[0][1], locations[0][2]),
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
        for (i = 0; i < locations.length; i++) {
            var labelText = i + 1
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
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

            var img_path = "{{Config::get('constants.USER_IMAGE_THUMB')}}";
            var contents =
                    '<div class="card-claimed-business"> <div class="row"><div class="col-lg-12" >' +
                    '<div class="img-claimed-business">' +
                    '<img src=' + img_path + encodeURIComponent(locations[i][4]) + ' alt="">' +
                    '</div></div> </div>' +
                    '<div class="row"><div class="col-lg-12" ><div class="content-claimed-business">' +
                    '<div class="content-claimed-business-inner">' +
                    '<div class="content-left-claimed">' +
                    '<a href="/pcompany/view/' + locations[i][3] + '">' + locations[i][0] + '</a>' +
                    '<ul>' +
                    '<li class="fill-str"><i class="fa fa-star"></i></li>' +
                    '<li class="fill-str"><i class="fa fa-star"></i></li>' +
                    '<li class="fill-str"><i class="fa fa-star "></i></li>' +
                    '<li><i class="fa fa-star"></i></li>' +
                    '<li><i class="fa fa-star"></i></li>' +
                    '<li class="count">25</li>' +
                    '</ul>' +
                    '</div>' +
                    '<div class="content-right-claimed"></div>' +
                    '</div>' +
                    '</div></div></div>' +
                    '</div>';

            google.maps.event.addListener(marker, 'mouseover', (function (marker, contents, infowindow) {
                return function () {
                    infowindow.setPosition(marker.latLng);
                    infowindow.setContent(contents);
                    infowindow.open(map, this);
                };
            })(marker, contents, infowindow));
            markers.push(marker);
        }

        //nnn commented on 18-05-2022 - its not displaying proper map
       // map.fitBounds(bounds);
       // map.panToBounds(bounds);
        
        $('.mysrchmap').show()
    } else {
        $('#mapdetails').hide()
        
        /*console.log('else map');
        map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom: 8,
            center: new google.maps.LatLng(42.567200, -83.807250),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        $('.mysrchmap').show()*/
    }
});
</script>
<script>

$(document).ready(function () {
    // Close modal on button click
    $(".btn-addtocart").click(function () {
        $(".mykickboxing").modal('hide');
    });
});

function viewActreview(aid)
{
	var _token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		type: 'POST',
		url: '{{route("viewActreview")}}',
		data: {
			_token: _token,
			aid: aid
		},

		success: function (data) {
			$('#actreviewBody').html(data);
			$("#actreview").modal('show');
		}
	});
}

</script>


<script type="text/javascript">	
	function submit_rating(sid)
	{
		@if(Auth::check())
		//var formData = $("#sreview"+sid).serialize();
		var formData = new FormData();
		var rating=$('#rating'+sid).val();
		var review=$('#review'+sid).val();
		var rtitle=$('#rtitle'+sid).val();
		var _token = $("input[name='_token']").val();
		
		TotalFiles = $('#rimg'+sid)[0].files.length;
		
		let rimg = $('#rimg'+sid)[0];
		for (let i = 0; i < TotalFiles; i++) {
			formData.append('rimg' + i, rimg.files[i]);
		}
		formData.append('TotalFiles', TotalFiles);
	    formData.append('rtitle', rtitle);
		formData.append('review', review);
		formData.append('rating', rating);
		formData.append('sid', sid);
		formData.append('_token', _token);
		
		if(rating!='' && review!='')
		{ 
			$.ajax({
				url: "{{route('save_business_service_reviews')}}",
				type: 'POST',
	            contentType: 'multipart/form-data',
	            cache: false,
	            contentType: false,
	            processData: false,
	            data: formData,
				success: function (response) {
					if(response=='submitted')
					{	$('#reviewerro'+sid).show(); $('#reviewerro'+sid).html('Review submitted'); 
						//$("#user_ratings_div"+sid).load(location.href + " #user_ratings_div"+sid);
						$("#user_ratings_div"+sid).load(location.href+" #user_ratings_div"+sid+">*","");
						$('#rating'+sid).val(' ');
						$('#review'+sid).val(' '); $('#rtitle'+sid).val(' ');
					}
					else if(response=='already')
					{ $('#reviewerro'+sid).show(); 
						$('#reviewerro'+sid).html('You have already submitted your review for this activity.'); }
					else if(response=='addreview')
					{ $('#reviewerro'+sid).show(); $('#reviewerro'+sid).html('Add your review and select rating for activity');  }
					
				}
			});
		}
		else
		{
			$('#reviewerro'+sid).show(); 
			$('#reviewerro'+sid).html('Please add your reivew and select rating'); 
			$('#rating'+sid).val(' ');
			$('#review'+sid).val(' ');
			return false;
		}
		@else
			$('#reviewerro'+sid).show(); 
			$('#reviewerro'+sid).html('Please login in your account to review this activity');
			$('#rating'+sid).val(' ');
			$('#review'+sid).val(' ');
			return false;
		@endif	
	}
</script>
<script type="text/javascript">
	function changeactpr(aid,val,part,div,maid)
	{
		var n = val.split('~~');
		var pr; var qty;
		var actfilparticipant=$('#actfilparticipant'+maid).val();
		
		if(actfilparticipant!='')
		{
			pr=actfilparticipant*n[1]; 
			qty=actfilparticipant;
		}
		else{ 
			qty=1; 
			if( n[1]!='' ){ pr=qty*n[1]; } else { pr='100'; }
		}
		var data = '<p>Price Option: '+n[0]+' Session</p><p>Participants: '+qty+'</p><p>Total: $'+pr+'/person</p>';
		var book 
		if(div=='book'){
			$('#book'+maid+aid).html(data);
			$('#pricequantity'+maid+aid).val(qty);
			$('#price'+maid+aid).val(pr);
			$('#priceid'+maid+aid).val(n[2]);
			$('#totprice'+maid).html(pr + ' USD');
			$('#paysession'+maid).html('Price Option: '+ n[0] + ' Session');
		}
		else if (div=='bookmore'){
			console.log(aid);
			$('#bookmore'+maid+aid).html(data);
			$('#pricebookmore'+maid+aid).val(pr);
			$('#priceid'+maid+aid).val(n[2]);
		}
		else if (div=='bookajax'){
			$('#bookajax'+maid+aid).html(data);
			$('#pricebookajax'+maid+aid).val(pr);
			$('#pricequantity'+maid+aid).val(qty);
			$('#priceid'+maid+aid).val(n[2]);
		}
	}
</script>


<script>
jQuery("#carousel-slidertwo").owlCarousel({
  autoplay: true,
  rewind: true, /* use rewind if you don't want loop */
  margin: 20,
   /*
  animateOut: 'fadeOut',
  animateIn: 'fadeIn',
  */
  responsiveClass: true,
  autoHeight: true,
  autoplayTimeout: 7000,
  smartSpeed: 800,
  nav: true,
  navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
  responsive: {
    0: {
      items: 1
    },

    600: {
      items: 3
    },

    1024: {
      items: 3
    },
	
	1200: {
      items: 5
    },
	
    1366: {
      items: 5
    },
  },
});
</script>
<script>
jQuery("#carousel-sliderthree").owlCarousel({
  autoplay: true,
  rewind: true, /* use rewind if you don't want loop */
  margin: 20,
   /*
  animateOut: 'fadeOut',
  animateIn: 'fadeIn',
  */
  responsiveClass: true,
  autoHeight: true,
  autoplayTimeout: 7000,
  smartSpeed: 800,
  nav: true,
  navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
  responsive: {
    0: {
      items: 1
    },

    600: {
      items: 3
    },

    1024: {
      items: 3
    },
	
	1200: {
      items: 5
    },
	
    1366: {
      items: 5
    },
  },
});
</script>
<script>
jQuery("#carousel-sliderfour").owlCarousel({
  autoplay: true,
  rewind: true, /* use rewind if you don't want loop */
  margin: 20,
   /*
  animateOut: 'fadeOut',
  animateIn: 'fadeIn',
  */
  responsiveClass: true,
  autoHeight: true,
  autoplayTimeout: 7000,
  smartSpeed: 800,
  nav: true,
  navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
  responsive: {
    0: {
      items: 1
    },

    600: {
      items: 3
    },

    1024: {
      items: 3
    },
	
	1200: {
      items: 5
    },
	
    1366: {
      items: 5
    },
  },
});
</script>
<script>
jQuery("#carousel-sliderfive").owlCarousel({
  autoplay: true,
  rewind: true, /* use rewind if you don't want loop */
  margin: 20,
   /*
  animateOut: 'fadeOut',
  animateIn: 'fadeIn',
  */
  responsiveClass: true,
  autoHeight: true,
  autoplayTimeout: 7000,
  smartSpeed: 800,
  nav: true,
  navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
  responsive: {
    0: {
      items: 1
    },

    600: {
      items: 3
    },

    1024: {
      items: 3
    },
	
	1200: {
      items: 5
    },
	
    1366: {
      items: 5
    },
  },
});
</script>
<script>
jQuery("#carousel-slidersix").owlCarousel({
  autoplay: true,
  rewind: true, /* use rewind if you don't want loop */
  margin: 20,
   /*
  animateOut: 'fadeOut',
  animateIn: 'fadeIn',
  */
  responsiveClass: true,
  autoHeight: true,
  autoplayTimeout: 7000,
  smartSpeed: 800,
  nav: true,
  navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
  responsive: {
    0: {
      items: 1
    },

    600: {
      items: 3
    },

    1024: {
      items: 3
    },
	
	1200: {
      items: 5
    },
	
    1366: {
      items: 5
    },
  },
});
</script>

<script>
$(document).ready(function() {
 
  $("#owl-demo-owl").owlCarousel({
    navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
    items : 1, 
    loop:true,
    nav:true,
    dots: false,
  });
 
});

$(document).ready(function() {
 
  $("#owl-demo-activity").owlCarousel({
    navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
    items : 1, 
    loop:true,
    nav:true,
    dots: false,
  });
 
});

$(document).ready(function() {
 
  $("#owl-demo-activitys").owlCarousel({
    navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
    items : 1, 
    loop:true,
    nav:true,
    dots: false,
  });
 
});

$(document).ready(function() {
 
  $("#owl-demo-learn").owlCarousel({
    navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
    items : 1, 
    loop:true,
    nav:true,
    dots: false,
  });
 
});

$(document).ready(function() {
 
  $("#owl-demo-learn-activites").owlCarousel({
    navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
    items : 1, 
    loop:true,
    nav:true,
    dots: false,
  });
 
});

$(document).ready(function() {
 
  $("#owl-demo-jeck").owlCarousel({
    navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
    items : 1, 
    loop:true,
    nav:true,
    dots: false,
  });
 
});

$(document).ready(function() {
 
  $("#owl-demo-yoga").owlCarousel({
    navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
    items : 1, 
    loop:true,
    nav:true,
    dots: false,
  });
 
});

</script>


@endsection