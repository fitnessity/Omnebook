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
  
?>
<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>compare/style.css">
<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>compare/w3.css">
<link href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css" type="text/css" rel="stylesheet" />
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/Compare.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/jquery-1.9.1.min.js"></script>
<script src="{{ url('public/js/jquery-ui.multidatespicker.js') }}"></script>
<script src="{{ url('public/js/jquery-ui.min.js') }}"></script>
<script type="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js"></script>

<section class="instant-hire" >
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="title">
					<h3>Get Started Fast</h3>
				</div>
			</div>
			@foreach($getstarteddata as $getdatafast)
			<div class="col-md-3 col-sm-4 col-xs-12">
				<div class="instant-section-info">
					<img src="{{ url('public/uploads/discover/thumb/'.$getdatafast['image'])}}" >
					<h4>{{$getdatafast['title']}}</h4>
					<p>{{$getdatafast['small_text']}}</p>
					@if($getdatafast['id'] == 1)
						<a class="showall-btn btn-position" href="{{route('get_started_personal_trainer')}}" >Show all</a>
					@elseif($getdatafast['id'] == 2)
						<a class="showall-btn btn-position" href="{{route('get_started_ways_to_workout')}}" >Show all</a>
					@elseif($getdatafast['id'] == 3)
						<a class="showall-btn btn-position" href="{{route('get_started_activities_experiences')}}">Show all</a>
					@else
						<a class="showall-btn btn-position" href="{{route('get_started_activities_events')}}">Show all</a>
					@endif
				</div>
			</div>
	
			@endforeach
		</div>
		@include('includes.search_category_sidebar')
		<?php
			$start_date = date('Y/m/d');  
			$date = strtotime($start_date);
			$date = strtotime("+8 hours", $date);
			/*print_r($todayservicedata);*/
			
		?>

		@if(count($bookschedulers) > 0)
			<div class="fst-0 fsb-1">
				<div class="row">
					<div class="col-md-10">
						<div class="title">
							<h3>Find Activities Starting In The Next 8 Hrs for <?php echo date('l').', '.date('F d, Y', $date); ?></h3>
						</div>
					</div>
					<div class="col-md-2"> 
						<div class="title-show">
							<a href="{{route('activities_next_8_hours')}}">Show All</a>
						</div>
					</div>
					@foreach ($bookschedulers as $bookscheduler)
						<div class="col-md-4">
							<div class="find-activity">
								<div class="row">
									<div class="col-md-4 col-sm-4">
										<img src="{{ url('public/uploads/profile_pic/'.$bookscheduler->business_service->first_profile_pic())}}" >
									</div>
									<div class="col-md-8 col-sm-8 activity-data">
										<div class="row">
											<div class="col-md-6 col-sm-6 col-xs-6">
												<div class="activity-inner-data">
													<i class="fas fa-star"></i>
													<span> {{$bookscheduler->business_service->reviews_score()}} ({{$bookscheduler->business_service->reviews->count()}}) </span>
												</div>

												<div class="activity-hours">
													<span>{{$bookscheduler->get_duration_hours()}}</span>
												</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6">
												<div class="activity-city">
													<span style="white-space: nowrap;">{{$bookscheduler->company_information->city}}</span>
													@auth
														<div class="serv_fav1" ser_id="{{$bookscheduler->business_service->id}}" data-id="serfavstarts">
															<a class="fav-fun-2" id="serfavstarts{{$bookscheduler->business_service->id}}">

																<i class="<?php echo ($bookscheduler->business_service->is_liked_by(Auth::id())) ? 'fas' : 'far' ?> fa-heart"></i>
														</div>
													@endauth
													@guest
														<a class="fav-fun-2" href="{{ route('userlogin')}}" ><i class="far fa-heart"></i></a>
													@endguest
												</div>
											</div>
										</div>
										<div class="activity-information ">
											<span><a  @if (Auth::check())  href="{{route('show_businessprofile', ['user_name' => $bookscheduler->company_information->company_name, 'id' => $bookscheduler->company_information->id])}}" @else  href="{{ route('userlogin') }}"  @endif target="_blank"  class="companyalink">{{$bookscheduler->company_information->company_name}}</a></span>
											<span><a href="{{route('show_businessprofile', ['user_name' => $bookscheduler->company_information->company_name, 'id' => $bookscheduler->company_information->id])}}" target="_blank">{{$bookscheduler->business_service->program_name}}</a></span>
											<p>{{$bookscheduler->business_service->formal_service_types()}} | {{$bookscheduler->business_service->sport_activity}}</p>
											<a class="showall-btn" href="{{route('activities_show', ['serviceid' => $bookscheduler->business_service->id])}}">More Details</a>
										</div>
										<div class="row">
											<div class="col-md-6 col-sm-6 col-xs-6 activites-price-details">
											<div class="dollar-person">
												<span>From ${{$bookscheduler->price_detail()}}/Person</span>
											</div>
											</div>
											<div class="col-md-6 col-sm-6 col-xs-6 activites-price-details-left">
												<div class="activity-time-main <?php echo ($bookscheduler->is_start_in_one_hour($current_date)) ? 'activity-time-main-red' : ''?>">
													<span>Starts in 
														@if ($bookscheduler->time_left($current_date)->h)
															{{$bookscheduler->time_left($current_date)->h}} {{Str::plural('hr', $bookscheduler->time_left($current_date)->h)}}
														@endif
														@if ($bookscheduler->time_left($current_date)->i)
															{{$bookscheduler->time_left($current_date)->i}} {{Str::plural('min', $bookscheduler->time_left($current_date)->i)}}
														@endif
													</span>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		@endif
		<?php /*?><div class="row">
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
		</div><?php */?>

		@if(count($thismonthactivity) > 0)	
		<div class="row">
			<div class="col-xs-12 col-md-6 col-sm-6">
				<div class="title">
					<h3>See New Activities Listed This Month </h3>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-sm-6">
				<div class="nav-sliders-activites">
					<label>{{count($thismonthactivity)}} Results </label>
					<a href="{{route('activities_index',['filtervalue'=> 'thismonth'])}}" >Show all</a>
				</div>
			</div>
			<!--<div class="col-md-8 leftside-kickboxing" id="activitylist">-->
			<div class="col-md-12 leftside-kickboxing" id="activitylist">
				<div class="row">
					<div class="ptb-65 float-left w-100 discover_activities" id="activites">
						<div class="container-fluid">
							<div class="owl-slider kickboxing-slider-activites">
								<div id="carousel-slider" class="owl-carousel">
								<?php
					            $companyid = $companylat = $companylon = $companyname  = $latitude = $longitude = $serviceid = $companylogo = $companyaddress= "";
									$companycity = $companycountry = $pay_price  = "";
					            if (isset($thismonthactivity)) {
					               $servicetype = [];
					               foreach ($thismonthactivity as $loop => $service) {
					                  $company = $price = $businessSp = [];
											$serviceid = $service['id'];
			                        $sport_activity = $service['sport_activity'];
			                        $servicetype[$service['service_type']] = $service['service_type'];
			                        $area = !empty($service['area']) ? $service['area'] : 'Location';
			                        $company = CompanyInformation::where('id', $service['cid'])->first();
                                 if($company != '') {
                                    $companyid = $company->id;
                                    $companyaddress = $company->address;
                                    $companyname = $company->company_name;
												$companycity = $company->city;
												$companycountry = $company->country;
												$companylogo = $company->logo;
												$companylat = $company->latitude;
												$companylon = $company->longitude;
			                        }
					                            
			                        if ($service['profile_pic']!="") {
											    if(str_contains($service['profile_pic'], ',')){
											     $pic_image = explode(',', $service['profile_pic']);
												    if( $pic_image[0] == ''){
												       $p_image  = $pic_image[1];
												    }else{
												       $p_image  = $pic_image[0];
												    }
												  }else{
												  	$pic_image = $service['profile_pic'];
												   $p_image = $service['profile_pic'];
												}

												if (file_exists( public_path() . '/uploads/profile_pic/' . $p_image)) {
												   $profilePic = url('/public/uploads/profile_pic/' . $p_image);
												}else {
												   $profilePic = url('/public/images/service-nofound.jpg');
												}
											}else{ $profilePic = '/public/images/service-nofound.jpg'; }

											$bookscheduler='';
											$time='';
											$bookscheduler = BusinessActivityScheduler::where('serviceid', $service['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
											if(@$bookscheduler[0]['set_duration']!=''){
												$tm=explode(' ',$bookscheduler[0]['set_duration']);
												$hr=''; $min=''; $sec='';
												if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
												if($tm[2]!=0){ $min=$tm[2].'min. '; }
												if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
												if($hr!='' || $min!='' || $sec!='')
												{ $time =  $hr.$min.$sec; } 
											}
											$pricearr = [];
											$price_all = '';
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
		                    	?>
								
									<div class="item">

										<div class="selectProduct" data-id="{{ $service['id'] }}" data-title="{{ $service['program_name'] }}" data-name="{{ $service['program_name'] }}" data-companyname="{{ $companyname }}" data-email="" data-address="{{ $companyaddress }}" data-img="{{ $profilePic }}" data-price="{{ $pay_price }}" data-token="{{ csrf_token() }}"> 
										
											<div class="kickboxing-block">
												@if(Auth::check())
													@php
			                                	$loggedId = Auth::user()->id;
			                                	$favData = BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$service['id'])->first();                   
                             				@endphp
                             				<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
														<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn_thismon{{$service['id']}}" class="owl-carousel owl-theme">
																<?php 
																	$i = 0;
																	if(is_array($pic_image)){
																		foreach($pic_image as $img){
																			$profilePic1 = '';
																			if($img != ''){
																				if (file_exists( public_path() . '/uploads/profile_pic/' . $img)) {
														           				$profilePic1 = url('/public/uploads/profile_pic/' . $img);
																				}
														         		} 

													        				if($profilePic1 != ''){ ?>
																				<div class="item-inner">
																					<img src="{{$profilePic1}}" class="productImg">
																				</div>
																			<?php }
																		}
																	}else{
																		if (file_exists( public_path() . '/uploads/profile_pic/' . $pic_image)) {
													   					$profilePic1 = url('/public/uploads/profile_pic/' . $pic_image);
													    				}else {
													       				$profilePic1 = url('/public/images/service-nofound.jpg');
													    				} ?>
																		<div class="item-inner">
																			<img src="{{$profilePic1}}">
																		</div>
																<?php } ?>
															</div>
														</div>
														<script type="text/javascript">
															$(document).ready(function() {
															  	$("#owl-demo-learn_thismon{{$service['id']}}").owlCarousel({
																   navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
																   items : 1, 
																   loop:true,
																   nav:true,
																   dots: false,
															  	});
															});
														</script>
														<div class="serv_fav1" data-id = "serfavmonth" ser_id="{{$service['id']}}" >
															<a class="fav-fun-2" id="serfavmonth{{$service['id']}}">
			                                    	@if( !empty($favData) )
			                                        	<i class="fas fa-heart"></i>
																@else
			                                    		<i class="far fa-heart"></i>
			                                    	@endif
			                                     </a>
				                            	</div>
							                     @if($price_all != '')
															<span>From ${{$price_all}}/Person</span>
														@endif
													</div>
                             			@else
                                			<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
														<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn_thismon{{$service['id']}}" class="owl-carousel owl-theme">
																<?php 
																	$i = 0;
																	if(is_array($pic_image)){
																		foreach($pic_image as $img){
																			$profilePic1 = '';
																			if($img != ''){
																				if (file_exists( public_path() . '/uploads/profile_pic/' . $img)) {
														           				$profilePic1 = url('/public/uploads/profile_pic/' . $img);
																				}
														         		} 

													        				if($profilePic1 != ''){ ?>
																				<div class="item-inner">
																					<img src="{{$profilePic1}}" class="productImg">
																				</div>
																			<?php }
																		}
																	}else{
																		if (file_exists( public_path() . '/uploads/profile_pic/' . $pic_image)) {
													   					$profilePic1 = url('/public/uploads/profile_pic/' . $pic_image);
													    				}else {
													       				$profilePic1 = url('/public/images/service-nofound.jpg');
													    				} ?>
																		<div class="item-inner">
																			<img src="{{$profilePic1}}">
																		</div>
																<?php } ?>
															</div>
														</div>
														<script type="text/javascript">
															$(document).ready(function() {
															  	$("#owl-demo-learn_thismon{{$service['id']}}").owlCarousel({
																   navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
																   items : 1, 
																   loop:true,
																   nav:true,
																   dots: false,
															  	});
															});
														</script>
				                              <a class="fav-fun-2" href="{{ Config::get('constants.SITE_URL') }}/userlogin" ><i class="far fa-heart"></i></a>
				                              @if($price_all != '')	
				                                	<span>From ${{$price_all}}/Person</span>
				                              @endif
				                           </div>
                             			@endif
                             			@php
													$reviews_count = BusinessServiceReview::where('service_id', $service['id'])->count();
													$reviews_sum = BusinessServiceReview::where('service_id', $service['id'])->sum('rating');
													$reviews_avg=0;
													if($reviews_count>0)
													{	
														$reviews_avg= round($reviews_sum/$reviews_count,2); 
													}
												@endphp
												<div class="bottom-content">
													<div class="class-info">
														<div class="row">
															<div class="col-md-7 col-sm-7 col-xs-7 ratingtime">
																<div class="activity-inner-data">
																	<i class="fas fa-star"></i>
																	<span>{{$reviews_avg}} ({{$reviews_count}})</span>
																</div>
																@if($time != '')
																	<div class="activity-hours">
																		<span>{{$time}}</span>
																	</div>
																@endif
															</div>
															<div class="col-md-5 col-sm-5 col-xs-5 country-instant">
																<div class="activity-city">
																	<span style="white-space: nowrap;">{{$companycity}}</span>
																</div>
															</div>
														</div>
													</div>
													@php
														$redlink = str_replace(" ","-",$companyname);
														$service_type='';
														if($service['service_type']!=''){
															if( $service['service_type']=='individual' ) $service_type = 'Personal Training'; 
															else if( $service['service_type']=='classes' )	$service_type = 'Group Class'; 
															else if( $service['service_type']=='experience' ) $service_type = 'Experience'; 
															else if( $service['service_type']=='events' ) $service_type = 'Events';
														}
													@endphp
													<div class="activity-information activites-height">
														<span><a  @if (Auth::check())  
							                                    href="{{ route('businessprofile',['user_name'=>$redlink ,'id'=>$service['cid']])}}" 
							                                @else 
							                                    href="{{ route('userlogin') }}"  
							                                @endif
							                                    target="_blank"  class="companyalink">{{$companyname}}</a></span>
														<span><a 
							                                @if (Auth::check())  
							                                    href="{{ route('businessprofile',['user_name'=>$redlink ,'id'=>$service['cid']])}}" 
							                                @else 
							                                    href="{{ route('userlogin') }}"  
							                                @endif
							                                    target="_blank">{{ $service['program_name'] }}</a>
							                         	</span>
														<p>{{ $service_type }}  | {{ $service['sport_activity'] }}</p>
													</div>
													<hr>
													<div class="all-details">
														<a class="showall-btn" href="{{route('activities_show',['serviceid'=>  $serviceid])}}">More Details</a>
														<p class="addToCompare" id='compid{{$service["id"]}}' title="Add to Compare">COMPARE SIMILAR +</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								<?php
		                    		}
		                		} ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<!--<div class="col-md-4 col-sm-12 col-xs-12 kickboxing_map">
				<div class="mysrchmap" style="display:none; position:relative; height:100vh;">
					<div id="map_canvas" style="position: absolute; top: 0; right: 0; bottom: 0; left: 0;"></div>
				</div>
				<div class="maparea">
					<!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24176.251535935986!2d-73.96828678121815!3d40.76133318281456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c258c4d85a0d8d%3A0x11f877ff0b8ffe27!2sRoosevelt%20Island!5e0!3m2!1sen!2sin!4v1620041765199!5m2!1sen!2sin" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
				</div>
			</div> -->
      </div>
      @endif

		@if(count($mostpopularactivity) > 0)	
		<div class="row">
			<div class="col-xs-12 col-md-6 col-sm-6">
				<div class="title">
					<h3>Most Popular Activities	</h3>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-sm-6">
				<div class="nav-sliders-activites">
					<label>{{count($mostpopularactivity)}} Results </label>
					<a href="{{route('activities_index',['filtervalue'=> 'most_popular'])}}">Show All </a>
				</div>
			</div>
			<!--<div class="col-md-8 leftside-kickboxing" id="activitylist">-->
			<div class="col-md-12 leftside-kickboxing" id="activitylisttwo">
				<div class="row">
					<div class="ptb-65 float-left w-100 discover_activities" id="activitestwo">
						<div class="container-fluid">
							<div class="owl-slider kickboxing-slider-activites">
								<div id="popular-activities" class="owl-carousel">
									<?php
						            $companyid = $companylat = $companylon = $companyname  = $latitude = $longitude = $serviceid = $companylogo = $companyaddress= "";
										$companycity = $companycountry = $pay_price  = "";
						            if (isset($mostpopularactivity)) {
						               $servicetype = [];
						               foreach ($mostpopularactivity as $loop => $service) {
						                  $company = $price = $businessSp = [];
												$serviceid = $service['id'];
				                        $sport_activity = $service['sport_activity'];
				                        $servicetype[$service['service_type']] = $service['service_type'];
				                        $area = !empty($service['area']) ? $service['area'] : 'Location';
				                        $company = CompanyInformation::where('id', $service['cid'])->first();
		                               if($company != '') {
	                                    $companyid = $company->id;
	                                    $companyaddress = $company->address;
	                                    $companyname = $company->company_name;
													$companycity = $company->city;
													$companycountry = $company->country;
													$companylogo = $company->logo;
													$companylat = $company->latitude;
													$companylon = $company->longitude;
	                                 }
			                            
	                                 if ($service['profile_pic']!="") {
												   if(str_contains($service['profile_pic'], ',')){
												     $pic_image = explode(',', $service['profile_pic']);
													    if( $pic_image[0] == ''){
													       $p_image  = $pic_image[1];
													    }else{
													       $p_image  = $pic_image[0];
													    }
													  }else{
													  	$pic_image = $service['profile_pic'];
													   $p_image = $service['profile_pic'];
													}

													if (file_exists( public_path() . '/uploads/profile_pic/' . $p_image)) {
													   $profilePic = url('/public/uploads/profile_pic/' . $p_image);
													}else {
													   $profilePic = url('/public/images/service-nofound.jpg');
													}
												}else{ $profilePic = '/public/images/service-nofound.jpg'; }

												$bookscheduler='';
												$time='';
												$bookscheduler = BusinessActivityScheduler::where('serviceid', $service['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
												if(@$bookscheduler[0]['set_duration']!=''){
													$tm=explode(' ',$bookscheduler[0]['set_duration']);
													$hr=''; $min=''; $sec='';
													if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
													if($tm[2]!=0){ $min=$tm[2].'min. '; }
													if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
													if($hr!='' || $min!='' || $sec!='')
													{ $time =  $hr.$min.$sec; } 
												}
												$pricearr = [];
												$price_all = '';
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
			                    	?>
									<div class="item">
										<div class="selectProduct" data-id="{{ $service['id'] }}" data-title="{{ $service['program_name'] }}" data-name="{{ $service['program_name'] }}" data-companyname="{{ $companyname }}" data-email="" data-address="{{ $companyaddress }}" data-img="{{ $profilePic }}" data-price="{{ $pay_price }}" data-token="{{ csrf_token() }}"> 
											<div class="kickboxing-block">
												@if(Auth::check())
													@php
			                                	$loggedId = Auth::user()->id;
			                                	$favData = BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$service['id'])->first();                   
                             				@endphp
                             				<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
														<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn_pop{{$service['id']}}" class="owl-carousel owl-theme">
																<?php 
																	$i = 0;
																	if(is_array($pic_image)){
																		foreach($pic_image as $img){
																			$profilePic1 = '';
																			if($img != ''){
																				if (file_exists( public_path() . '/uploads/profile_pic/' . $img)) {
														           				$profilePic1 = url('/public/uploads/profile_pic/' . $img);
																				}
														         		} 

													        				if($profilePic1 != ''){ ?>
																				<div class="item-inner">
																					<img src="{{$profilePic1}}" class="productImg">
																				</div>
																			<?php }
																		}
																	}else{
																		if (file_exists( public_path() . '/uploads/profile_pic/' . $pic_image)) {
													   					$profilePic1 = url('/public/uploads/profile_pic/' . $pic_image);
													    				}else {
													       				$profilePic1 = url('/public/images/service-nofound.jpg');
													    				} ?>
																		<div class="item-inner">
																			<img src="{{$profilePic1}}">
																		</div>
																<?php } ?>
															</div>
														</div>
														<script type="text/javascript">
															$(document).ready(function() {
															  	$("#owl-demo-learn_pop{{$service['id']}}").owlCarousel({
																   navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
																   items : 1, 
																   loop:true,
																   nav:true,
																   dots: false,
															  	});
															});
														</script>
														<div class="serv_fav1" ser_id="{{$service['id']}}" data-id = "serfavpopular">
															<a class="fav-fun-2" id="serfavpopular{{$service['id']}}">
			                                    	@if( !empty($favData) )
			                                        	<i class="fas fa-heart"></i>
																@else
			                                    		<i class="far fa-heart"></i>
			                                    	@endif
			                                     </a>
							                     </div>
							                     @if($price_all != '')
															<span>From ${{$price_all}}/Person</span>
														@endif
													</div>
                             			@else
                                			<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
														<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn_pop{{$service['id']}}" class="owl-carousel owl-theme">
																<?php 
																	$i = 0;
																	if(is_array($pic_image)){
																		foreach($pic_image as $img){
																			$profilePic1 = '';
																			if($img != ''){
																				if (file_exists( public_path() . '/uploads/profile_pic/' . $img)) {
														           				$profilePic1 = url('/public/uploads/profile_pic/' . $img);
																				}
														         		} 

													        				if($profilePic1 != ''){ ?>
																				<div class="item-inner">
																					<img src="{{$profilePic1}}" class="productImg">
																				</div>
																			<?php }
																		}
																	}else{
																		if (file_exists( public_path() . '/uploads/profile_pic/' . $pic_image)) {
													   					$profilePic1 = url('/public/uploads/profile_pic/' . $pic_image);
													    				}else {
													       				$profilePic1 = url('/public/images/service-nofound.jpg');
													    				} ?>
																		<div class="item-inner">
																			<img src="{{$profilePic1}}">
																		</div>
																<?php } ?>
															</div>
														</div>
														<script type="text/javascript">
															$(document).ready(function() {
															  	$("#owl-demo-learn_pop{{$service['id']}}").owlCarousel({
																   navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
																   items : 1, 
																   loop:true,
																   nav:true,
																   dots: false,
															  	});
															});
														</script>
			                                	<a class="fav-fun-2" href="{{ Config::get('constants.SITE_URL') }}/userlogin" ><i class="far fa-heart"></i></a>
			                                	@if($price_all != '')	
			                                		<span>From ${{$price_all}}/Person</span>
			                                	@endif
				                           </div>
                             			@endif
                             			@php
													$reviews_count = BusinessServiceReview::where('service_id', $service['id'])->count();
													$reviews_sum = BusinessServiceReview::where('service_id', $service['id'])->sum('rating');
													$reviews_avg=0;
													if($reviews_count>0)
													{	
														$reviews_avg= round($reviews_sum/$reviews_count,2); 
													}
												@endphp
												<div class="bottom-content">
													<div class="class-info">
														<div class="row">
															<div class="col-md-7 col-sm-7 col-xs-7 ratingtime">
																<div class="activity-inner-data">
																	<i class="fas fa-star"></i>
																	<span>{{$reviews_avg}} ({{$reviews_count}})</span>
																</div>
																@if($time != '')
																	<div class="activity-hours">
																		<span>{{$time}}</span>
																	</div>
																@endif
															</div>
															<div class="col-md-5 col-sm-5 col-xs-5 country-instant">
																<div class="activity-city">
																	<span style="white-space: nowrap;">{{$companycity}}</span>
																</div>
															</div>
														</div>
													</div>
													@php
														$redlink = str_replace(" ","-",$companyname);
														$service_type='';
														if($service['service_type']!=''){
															if( $service['service_type']=='individual' ) $service_type = 'Personal Training'; 
															else if( $service['service_type']=='classes' )	$service_type = 'Group Classe'; 
															else if( $service['service_type']=='experience' ) $service_type = 'Experience'; 
															else if( $service['service_type']=='events' ) $service_type = 'Events';
														}
													@endphp
													<div class="activity-information activites-height">

														<span><a  @if (Auth::check())  
							                                    href="{{ route('businessprofile',['user_name'=>$redlink ,'id'=>$service['cid']])}}" 
							                                @else 
							                                    href="{{ route('userlogin') }}"  
							                                @endif
							                                    target="_blank" class="companyalink">{{$companyname}}</a></span>
														<span><a 
							                                @if (Auth::check())  
							                                    href="{{ route('businessprofile',['user_name'=>$redlink ,'id'=>$service['cid']])}}" 
							                                @else 
							                                    href="{{ route('userlogin') }}"  
							                                @endif
							                                    target="_blank">{{ $service['program_name'] }}</a>
							                         	</span>
														<p>{{ $service_type }}  | {{ $service['sport_activity'] }}</p>
													</div>
													<hr>
													<div class="all-details">
														<a class="showall-btn" href="{{route('activities_show',['serviceid'=>  $serviceid])}}">More Details</a>
														<p class="addToCompare" id='compid{{$service["id"]}}' title="Add to Compare">COMPARE SIMILAR +</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php
		                    		}
			                		} ?>
		                	    </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif

	
		@if(count($Trainers_coachesacitvity) > 0)
		<div class="row">
			<div class="col-xs-12 col-md-6 col-sm-6">
				<div class="title">
					<h3>Find Trainers & Coaches </h3>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-sm-6">
				<div class="nav-sliders-activites">
					<label>{{count($Trainers_coachesacitvity)}} Results </label>
					<a href="{{route('activities_index',['filtervalue'=> 'trainers_coaches'])}}">Show All </a>
				</div>
			</div>
			<!--<div class="col-md-8 leftside-kickboxing" id="activitylist">-->
			<div class="col-md-12 leftside-kickboxing" id="activitylistthree">
				<div class="row">
					<div class="ptb-65 float-left w-100 discover_activities" id="activitesthree">
						<div class="container-fluid">
							<div class="owl-slider kickboxing-slider-activites">
								<div id="find-trainers" class="owl-carousel">
									<?php
						            $companyid = $companylat = $companylon = $companyname  = $latitude = $longitude = $serviceid = $companylogo = $companyaddress= "";
										$companycity = $companycountry = $pay_price  = "";
						            if (isset($Trainers_coachesacitvity)) {
						               $servicetype = [];
						               foreach ($Trainers_coachesacitvity as $loop => $service) {
						                  $company = $price = $businessSp = [];
												$serviceid = $service['id'];
				                        $sport_activity = $service['sport_activity'];
				                        $servicetype[$service['service_type']] = $service['service_type'];
				                        $area = !empty($service['area']) ? $service['area'] : 'Location';
				                        $company = CompanyInformation::where('id', $service['cid'])->first();
		                              if($company != '') {
	                                    $companyid = $company->id;
	                                    $companyaddress = $company->address;
	                                    $companyname = $company->company_name;
													$companycity = $company->city;
													$companycountry = $company->country;
													$companylogo = $company->logo;
													$companylat = $company->latitude;
													$companylon = $company->longitude;
				                        }
						                            
				                        if ($service['profile_pic']!="") {
											    	if(str_contains($service['profile_pic'], ',')){
											     		$pic_image = explode(',', $service['profile_pic']);
												    	if( $pic_image[0] == ''){
												       	$p_image  = $pic_image[1];
												    	}else{
												       	$p_image  = $pic_image[0];
												    	}
												   }else{
													  	$pic_image = $service['profile_pic'];
													   $p_image = $service['profile_pic'];
													}

													if (file_exists( public_path() . '/uploads/profile_pic/' . $p_image)) {
													   $profilePic = url('/public/uploads/profile_pic/' . $p_image);
													}else {
													   $profilePic = url('/public/images/service-nofound.jpg');
													}
												}else{ $profilePic = '/public/images/service-nofound.jpg'; }

												$bookscheduler='';
												$time='';
												$bookscheduler = BusinessActivityScheduler::where('serviceid', $service['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
												if(@$bookscheduler[0]['set_duration']!=''){
													$tm=explode(' ',$bookscheduler[0]['set_duration']);
													$hr=''; $min=''; $sec='';
													if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
													if($tm[2]!=0){ $min=$tm[2].'min. '; }
													if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
													if($hr!='' || $min!='' || $sec!='')
													{ $time =  $hr.$min.$sec; } 
												}
												$pricearr = [];
												$price_all = '';
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
				                    ?>
									<div class="item">
										<div class="selectProduct" data-id="{{ $service['id'] }}" data-title="{{ $service['program_name'] }}" data-name="{{ $service['program_name'] }}" data-companyname="{{ $companyname }}" data-email="" data-address="{{ $companyaddress }}" data-img="{{ $profilePic }}" data-price="{{ $pay_price }}" data-token="{{ csrf_token() }}"> 
											<div class="kickboxing-block">
												@if(Auth::check())
													@php
			                                	$loggedId = Auth::user()->id;
			                                	$favData = BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$service['id'])->first();                   
                             				@endphp
                             				<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
                             					<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn_per{{$service['id']}}" class="owl-carousel owl-theme">
																<?php 
																	$i = 0;
																	if(is_array($pic_image)){
																		foreach($pic_image as $img){
																			$profilePic1 = '';
																			if($img != ''){
																				if (file_exists( public_path() . '/uploads/profile_pic/' . $img)) {
														           				$profilePic1 = url('/public/uploads/profile_pic/' . $img);
																				}
														         		} 

													        				if($profilePic1 != ''){ ?>
																				<div class="item-inner">
																					<img src="{{$profilePic1}}" class="productImg">
																				</div>
																			<?php }
																		}
																	}else{
																		if (file_exists( public_path() . '/uploads/profile_pic/' . $pic_image)) {
													   					$profilePic1 = url('/public/uploads/profile_pic/' . $pic_image);
													    				}else {
													       				$profilePic1 = url('/public/images/service-nofound.jpg');
													    				} ?>
																		<div class="item-inner">
																			<img src="{{$profilePic1}}">
																		</div>
																<?php } ?>
															</div>
														</div>
														<script type="text/javascript">
															$(document).ready(function() {
															  	$("#owl-demo-learn_per{{$service['id']}}").owlCarousel({
																   navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
																   items : 1, 
																   loop:true,
																   nav:true,
																   dots: false,
															  	});
															});
														</script>
														<div class="serv_fav1" ser_id="{{$service['id']}}" data-id = "serfavTrainer">
															<a class="fav-fun-2" id="serfavTrainer{{$service['id']}}">
						                                    	@if( !empty($favData) )
						                                        	<i class="fas fa-heart"></i>
																@else
						                                    		<i class="far fa-heart"></i>
						                                    	@endif
						                                     </a>
							                            </div>
							                            @if($price_all != '')
														<span>From ${{$price_all}}/Person</span>
														@endif
													</div>
	                                			@else
		                                			<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
																<div class="inner-owl-slider-hire">
																	<div id="owl-demo-learn_per{{$service['id']}}" class="owl-carousel owl-theme">
																		<?php 
																			$i = 0;
																			if(is_array($pic_image)){
																				foreach($pic_image as $img){
																					$profilePic1 = '';
																					if($img != ''){
																						if (file_exists( public_path() . '/uploads/profile_pic/' . $img)) {
																           				$profilePic1 = url('/public/uploads/profile_pic/' . $img);
																						}
																         		} 

															        				if($profilePic1 != ''){ ?>
																						<div class="item-inner">
																							<img src="{{$profilePic1}}" class="productImg">
																						</div>
																					<?php }
																				}
																			}else{
																				if (file_exists( public_path() . '/uploads/profile_pic/' . $pic_image)) {
															   					$profilePic1 = url('/public/uploads/profile_pic/' . $pic_image);
															    				}else {
															       				$profilePic1 = url('/public/images/service-nofound.jpg');
															    				} ?>
																				<div class="item-inner">
																					<img src="{{$profilePic1}}">
																				</div>
																		<?php } ?>
																	</div>
																</div>
																<script type="text/javascript">
																	$(document).ready(function() {
																	  	$("#owl-demo-learn_per{{$service['id']}}").owlCarousel({
																		   navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
																		   items : 1, 
																		   loop:true,
																		   nav:true,
																		   dots: false,
																	  	});
																	});
																</script>
						                              <a class="fav-fun-2" href="{{ Config::get('constants.SITE_URL') }}/userlogin" ><i class="far fa-heart"></i></a>
						                              @if($price_all != '')	
						                                	<span>From ${{$price_all}}/Person</span>
						                              @endif
						                            </div>
	                                			@endif
	                                			@php
													$reviews_count = BusinessServiceReview::where('service_id', $service['id'])->count();
													$reviews_sum = BusinessServiceReview::where('service_id', $service['id'])->sum('rating');
													$reviews_avg=0;
													if($reviews_count>0)
													{	
														$reviews_avg= round($reviews_sum/$reviews_count,2); 
													}
												@endphp
												<div class="bottom-content">
													<div class="class-info">
														<div class="row">
															<div class="col-md-7 col-sm-7 col-xs-7 ratingtime">
																<div class="activity-inner-data">
																	<i class="fas fa-star"></i>
																	<span>{{$reviews_avg}} ({{$reviews_count}})</span>
																</div>
																@if($time != '')
																	<div class="activity-hours">
																		<span>{{$time}}</span>
																	</div>
																@endif
															</div>
															<div class="col-md-5 col-sm-5 col-xs-5 country-instant">
																<div class="activity-city">
																	<span style="white-space: nowrap;">{{$companycity}}</span>
																</div>
															</div>
														</div>
													</div>
													@php
														$redlink = str_replace(" ","-",$companyname);
														$service_type='';
														if($service['service_type']!=''){
															if( $service['service_type']=='individual' ) $service_type = 'Personal Training'; 
															else if( $service['service_type']=='classes' )	$service_type = 'Group Class'; 
															else if( $service['service_type']=='experience' ) $service_type = 'Experience'; 
															else if( $service['service_type']=='events' ) $service_type = 'Events';
														}
													@endphp
													<div class="activity-information activites-height">
														<span><a  @if (Auth::check())  
							                                    href="{{ route('businessprofile',['user_name'=>$redlink ,'id'=>$service['cid']])}}" 
							                                @else 
							                                    href="{{ route('userlogin') }}"  
							                                @endif
							                                    target="_blank"  class="companyalink">{{$companyname}}</a></span>
														<span><a 
							                                @if (Auth::check())  
							                                    href="{{ route('businessprofile',['user_name'=>$redlink ,'id'=>$service['cid']])}}" 
							                                @else 
							                                    href="{{ route('userlogin') }}"  
							                                @endif
							                                    target="_blank">{{ $service['program_name'] }}</a>
							                         	</span>
														<p>{{ $service_type }}  | {{ $service['sport_activity'] }}</p>
													</div>
													<hr>
													<div class="all-details">
														<a class="showall-btn" href="{{route('activities_show',['serviceid'=> $serviceid])}}">More Details</a>
														<p class="addToCompare" id='compid{{$service["id"]}}' title="Add to Compare">COMPARE SIMILAR +</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php
										}
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif

		@if(count($Ways_To_Workout) > 0)
		<div class="row">
			<div class="col-xs-12 col-md-6 col-sm-6">
				<div class="title">
					<h3>Find Ways To Workout</h3>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-sm-6">
				<div class="nav-sliders-activites">
					<label>{{count($Ways_To_Workout)}} Results </label>
					<a href="{{route('activities_index',['filtervalue'=> 'ways_to_workout'])}}">Show All </a>
				</div>
			</div>
			<!--<div class="col-md-8 leftside-kickboxing" id="activitylist">-->
			<div class="col-md-12 leftside-kickboxing" id="activitylistfour">
				<div class="row">
					<div class="ptb-65 float-left w-100 discover_activities" id="activitesfour">
						<div class="container-fluid">
							<div class="owl-slider kickboxing-slider-activites">
								<div id="ways-to-workout" class="owl-carousel">
									<?php
						            $companyid = $companylat = $companylon = $companyname  = $latitude = $longitude = $serviceid = $companylogo = $companyaddress= "";
										$companycity = $companycountry = $pay_price  = "";
						            if (isset($Ways_To_Workout)) {
						               $servicetype = [];
						               foreach ($Ways_To_Workout as $loop => $service) {
						                  $company = $price = $businessSp = [];
												$serviceid = $service['id'];
				                        $sport_activity = $service['sport_activity'];
				                        $servicetype[$service['service_type']] = $service['service_type'];
				                        $area = !empty($service['area']) ? $service['area'] : 'Location';
				                        $company = CompanyInformation::where('id', $service['cid'])->first();
		                              if($company != '') {
	                                    $companyid = $company->id;
	                                    $companyaddress = $company->address;
	                                    $companyname = $company->company_name;
													$companycity = $company->city;
													$companycountry = $company->country;
													$companylogo = $company->logo;
													$companylat = $company->latitude;
													$companylon = $company->longitude;
	                                 }
			                            
	                                 if ($service['profile_pic']!="") {
					                        if(str_contains($service['profile_pic'], ',')){
			                                 $pic_image = explode(',', $service['profile_pic']);
		                                    if( $pic_image[0] == ''){
		                                       $p_image  = $pic_image[1];
		                                    }else{
		                                       $p_image  = $pic_image[0];
		                                    }
			                              }else{
			                              	$pic_image = $service['profile_pic'];
	                                       $p_image = $service['profile_pic'];
	                                    }

	                                    if (file_exists( public_path() . '/uploads/profile_pic/' . $p_image)) {
	                                       $profilePic = url('/public/uploads/profile_pic/' . $p_image);
	                                    }else {
	                                       $profilePic = url('/public/images/service-nofound.jpg');
	                                    }
												}else{ $profilePic = '/public/images/service-nofound.jpg'; }

												$bookscheduler='';
												$time='';
												$bookscheduler = BusinessActivityScheduler::where('serviceid', $service['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
												if(@$bookscheduler[0]['set_duration']!=''){
													$tm=explode(' ',$bookscheduler[0]['set_duration']);
													$hr=''; $min=''; $sec='';
													if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
													if($tm[2]!=0){ $min=$tm[2].'min. '; }
													if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
													if($hr!='' || $min!='' || $sec!='')
													{ $time =  $hr.$min.$sec; } 
												}
												$pricearr = [];
												$price_all = '';
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
				                    ?>
									<div class="item">
										<div class="selectProduct" data-id="{{ $service['id'] }}" data-title="{{ $service['program_name'] }}" data-name="{{ $service['program_name'] }}" data-companyname="{{ $companyname }}" data-email="" data-address="{{ $companyaddress }}" data-img="{{ $profilePic }}" data-price="{{ $pay_price }}" data-token="{{ csrf_token() }}"> 
											<div class="kickboxing-block">
												@if(Auth::check())
													@php
			                                	$loggedId = Auth::user()->id;
			                                	$favData = BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$service['id'])->first();                   
                             				@endphp
	                                		<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
	                                			<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn_classes{{$service['id']}}" class="owl-carousel owl-theme">
																<?php 
																$i = 0;
																if(is_array($pic_image)){
																	foreach($pic_image as $img){
																		$profilePic1 = '';
																		if($img != ''){
																			if (file_exists( public_path() . '/uploads/profile_pic/' . $img)) {
						                                       	$profilePic1 = url('/public/uploads/profile_pic/' . $img);
																			}
							                                 } 

						                                    if($profilePic1 != ''){ ?>
																		<div class="item-inner">
																			<img src="{{$profilePic1}}" class="productImg">
																		</div>
																	<?php }
																	}
																}else{
																	if (file_exists( public_path() . '/uploads/profile_pic/' . $pic_image)) {
				                                       	$profilePic1 = url('/public/uploads/profile_pic/' . $pic_image);
					                                    }else {
					                                       $profilePic1 = url('/public/images/service-nofound.jpg');
					                                    } ?>
																	<div class="item-inner">
																		<img src="{{$profilePic1}}">
																	</div>
																<?php } ?>
															</div>
														</div>
														<script type="text/javascript">
															$(document).ready(function() {
															  	$("#owl-demo-learn_classes{{$service['id']}}").owlCarousel({
																   navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
																   items : 1, 
																   loop:true,
																   nav:true,
																   dots: false,
															  	});
															});
														</script>
														<div class="serv_fav1" ser_id="{{$service['id']}}"  data-id = "serfavWorkout">
															<a class="fav-fun-2" id="serfavWorkout{{$service['id']}}">
						                                    	@if( !empty($favData) )
						                                        	<i class="fas fa-heart"></i>
																@else
						                                    		<i class="far fa-heart"></i>
						                                    	@endif
						                                     </a>
							                            </div>
							                            @if($price_all != '')
														<span>From ${{$price_all}}/Person</span>
														@endif
													</div>
                             			@else
                                			<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
														<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn_classes{{$service['id']}}" class="owl-carousel owl-theme">
																<?php 
																$i = 0;
																if(is_array($pic_image)){
																	foreach($pic_image as $img){
																		$profilePic1 = '';
																		if($img != ''){
																			if (file_exists( public_path() . '/uploads/profile_pic/' . $img)) {
						                                       	$profilePic1 = url('/public/uploads/profile_pic/' . $img);
																			}
							                                 } 

						                                    if($profilePic1 != ''){ ?>
																		<div class="item-inner">
																			<img src="{{$profilePic1}}" class="productImg">
																		</div>
																	<?php }
																	}
																}else{
																	if (file_exists( public_path() . '/uploads/profile_pic/' . $pic_image)) {
				                                       	$profilePic1 = url('/public/uploads/profile_pic/' . $pic_image);
					                                    }else {
					                                       $profilePic1 = url('/public/images/service-nofound.jpg');
					                                    } ?>
																	<div class="item-inner">
																		<img src="{{$profilePic1}}">
																	</div>
																<?php } ?>
															</div>
														</div>
														<script type="text/javascript">
															$(document).ready(function() {
															  	$("#owl-demo-learn_classes{{$service['id']}}").owlCarousel({
																   navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
																   items : 1, 
																   loop:true,
																   nav:true,
																   dots: false,
															  	});
															});
														</script>
				                                <a class="fav-fun-2" href="{{ Config::get('constants.SITE_URL') }}/userlogin" ><i class="far fa-heart"></i></a>
				                                @if($price_all != '')	
				                                <span>From ${{$price_all}}/Person</span>
				                                @endif
				                            </div>
                             			@endif
                             			@php
													$reviews_count = BusinessServiceReview::where('service_id', $service['id'])->count();
													$reviews_sum = BusinessServiceReview::where('service_id', $service['id'])->sum('rating');
													$reviews_avg=0;
													if($reviews_count>0)
													{	
														$reviews_avg= round($reviews_sum/$reviews_count,2); 
													}
												@endphp
												<div class="bottom-content">
													<div class="class-info">
														<div class="row">
															<div class="col-md-7 col-sm-7 col-xs-7 ratingtime">
																<div class="activity-inner-data">
																	<i class="fas fa-star"></i>
																	<span>{{$reviews_avg}} ({{$reviews_count}})</span>
																</div>
																@if($time != '')
																	<div class="activity-hours">
																		<span>{{$time}}</span>
																	</div>
																@endif
															</div>
															<div class="col-md-5 col-sm-5 col-xs-5 country-instant">
																<div class="activity-city">
																	<span style="white-space: nowrap;">{{$companycity}}</span>
																</div>
															</div>
														</div>
													</div>
													@php
														$redlink = str_replace(" ","-",$companyname);
														$service_type='';
														if($service['service_type']!=''){
															if( $service['service_type']=='individual' ) $service_type = 'Personal Training'; 
															else if( $service['service_type']=='classes' )	$service_type = 'Group Class'; 
															else if( $service['service_type']=='experience' ) $service_type = 'Experience'; 
															else if( $service['service_type']=='events' ) $service_type = 'Events';
														}
													@endphp
													<div class="activity-information activites-height">
														<span><a  @if (Auth::check())  
							                                    href="{{ route('businessprofile',['user_name'=>$redlink ,'id'=>$service['cid']])}}" 
							                                @else 
							                                    href="{{ route('userlogin') }}"  
							                                @endif
							                                    target="_blank"  class="companyalink">{{$companyname}}</a></span>
														<span><a 
							                                @if (Auth::check())  
							                                    href="{{ route('businessprofile',['user_name'=>$redlink ,'id'=>$service['cid']])}}" 
							                                @else 
							                                    href="{{ route('userlogin') }}" 
							                                @endif
							                                    target="_blank">{{ $service['program_name'] }}</a>
							                         	</span>
														<p>{{ $service_type }}  | {{ $service['sport_activity'] }}</p>
													</div>
													<hr>
													<div class="all-details">
														<a class="showall-btn" href="{{route('activities_show',['serviceid'=> $serviceid])}}">More Details</a>
														<p class="addToCompare" id='compid{{$service["id"]}}' title="Add to Compare">COMPARE SIMILAR +</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php
										}
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif

		@if(count($Fun_Activities) > 0)
		<div class="row">
			<div class="col-xs-12 col-md-6 col-sm-6">
				<div class="title">
					<h3>Find Fun Activities & Things To Do</h3>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-sm-6">
				<div class="nav-sliders-activites">
					<label>{{count($Fun_Activities)}} Results </label>
					<a href="{{route('activities_index',['filtervalue'=> 'active_wth_fun_things_to_do'])}}">Show All </a>
				</div>
			</div>
			<!--<div class="col-md-8 leftside-kickboxing" id="activitylist">-->
			<div class="col-md-12 leftside-kickboxing" id="activitylistfive">
				<div class="row">
					<div class="ptb-65 float-left w-100 discover_activities" id="activitesfive">
						<div class="container-fluid">
							<div class="owl-slider kickboxing-slider-activites">
								<div id="all-activities" class="owl-carousel">
									<?php
						            $companyid = $companylat = $companylon = $companyname  = $latitude = $longitude = $serviceid = $companylogo = $companyaddress= "";
										$companycity = $companycountry = $pay_price  = "";
						            if (isset($Fun_Activities)) {
						               $servicetype = [];
						               foreach ($Fun_Activities as $loop => $service) {
						                  $company = $price = $businessSp = [];
												$serviceid = $service['id'];
						                  $sport_activity = $service['sport_activity'];
				                        $servicetype[$service['service_type']] = $service['service_type'];
				                        $area = !empty($service['area']) ? $service['area'] : 'Location';
				                        $company = CompanyInformation::where('id', $service['cid'])->first();
		                              if($company != '') {
	                                    $companyid = $company->id;
	                                    $companyaddress = $company->address;
	                                    $companyname = $company->company_name;
													$companycity = $company->city;
													$companycountry = $company->country;
													$companylogo = $company->logo;
													$companylat = $company->latitude;
													$companylon = $company->longitude;
				                        }
						                            
				                        if ($service['profile_pic']!="") {
					                        if(str_contains($service['profile_pic'], ',')){
			                                 $pic_image = explode(',', $service['profile_pic']);
		                                    if( $pic_image[0] == ''){
		                                       $p_image  = $pic_image[1];
		                                    }else{
		                                       $p_image  = $pic_image[0];
		                                    }
			                              }else{
			                              	$pic_image = $service['profile_pic'];
	                                       $p_image = $service['profile_pic'];
	                                    }

	                                    if (file_exists( public_path() . '/uploads/profile_pic/' . $p_image)) {
	                                       $profilePic = url('/public/uploads/profile_pic/' . $p_image);
	                                    }else {
	                                       $profilePic = url('/public/images/service-nofound.jpg');
	                                    }
												}else{ $profilePic = '/public/images/service-nofound.jpg'; }

												$bookscheduler='';
												$time='';
												$bookscheduler = BusinessActivityScheduler::where('serviceid', $service['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
												if(@$bookscheduler[0]['set_duration']!=''){
													$tm=explode(' ',$bookscheduler[0]['set_duration']);
													$hr=''; $min=''; $sec='';
													if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
													if($tm[2]!=0){ $min=$tm[2].'min. '; }
													if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
													if($hr!='' || $min!='' || $sec!='')
													{ $time =  $hr.$min.$sec; } 
												}
												$pricearr = [];
												$price_all = '';
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
				                    ?>
									<div class="item">
										<div class="selectProduct" data-id="{{ $service['id'] }}" data-title="{{ $service['program_name'] }}" data-name="{{ $service['program_name'] }}" data-companyname="{{ $companyname }}" data-email="" data-address="{{ $companyaddress }}" data-img="{{ $profilePic }}" data-price="{{ $pay_price }}" data-token="{{ csrf_token() }}"> 
											<div class="kickboxing-block">
												@if(Auth::check())
													@php
			                                	$loggedId = Auth::user()->id;
			                                	$favData = BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$service['id'])->first();                   
                             				@endphp
                             				<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
                             					<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn_exp{{$service['id']}}" class="owl-carousel owl-theme">
																<?php 
																$i = 0;
																if(is_array($pic_image)){
																	foreach($pic_image as $img){
																		$profilePic1 = '';
																		if($img != ''){
																			if (file_exists( public_path() . '/uploads/profile_pic/' . $img)) {
						                                       	$profilePic1 = url('/public/uploads/profile_pic/' . $img);
																			}
							                                 } 

						                                    if($profilePic1 != ''){ ?>
																		<div class="item-inner">
																			<img src="{{$profilePic1}}" class="productImg">
																		</div>
																	<?php }
																	}
																}else{
																	if (file_exists( public_path() . '/uploads/profile_pic/' . $pic_image)) {
				                                       	$profilePic1 = url('/public/uploads/profile_pic/' . $pic_image);
					                                    }else {
					                                       $profilePic1 = url('/public/images/service-nofound.jpg');
					                                    } ?>
																	<div class="item-inner">
																		<img src="{{$profilePic1}}">
																	</div>
																<?php } ?>
															</div>
														</div>

														<script type="text/javascript">
															$(document).ready(function() {
															  	$("#owl-demo-learn_exp{{$service['id']}}").owlCarousel({
																   navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
																   items : 1, 
																   loop:true,
																   nav:true,
																   dots: false,
															  	});
															});
														</script>
														<div class="serv_fav1" ser_id="{{$service['id']}}"  data-id = "serfavfun">
															<a class="fav-fun-2" id="serfavfun{{$service['id']}}">
			                                    	@if( !empty($favData) )
			                                        	<i class="fas fa-heart"></i>
																@else
			                                    		<i class="far fa-heart"></i>
			                                    	@endif
		                                     	</a>
							                     </div>
							                     @if($price_all != '')
															<span>From ${{$price_all}}/Person</span>
														@endif
													</div>
                             			@else
                                			<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
														<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn_exp{{$service['id']}}" class="owl-carousel owl-theme">
																<?php 
																$i = 0;
																if(is_array($pic_image)){
																	foreach($pic_image as $img){
																		$profilePic1 = '';
																		if($img != ''){
																			if (file_exists( public_path() . '/uploads/profile_pic/' . $img)) {
						                                       	$profilePic1 = url('/public/uploads/profile_pic/' . $img);
																			}
							                                 } 

						                                    if($profilePic1 != ''){ ?>
																		<div class="item-inner">
																			<img src="{{$profilePic1}}" class="productImg">
																		</div>
																	<?php }
																	}
																}else{
																	if (file_exists( public_path() . '/uploads/profile_pic/' . $pic_image)) {
				                                       	$profilePic1 = url('/public/uploads/profile_pic/' . $pic_image);
					                                    }else {
					                                       $profilePic1 = url('/public/images/service-nofound.jpg');
					                                    } ?>
																	<div class="item-inner">
																		<img src="{{$profilePic1}}">
																	</div>
																<?php } ?>
															</div>
														</div>

														<script type="text/javascript">
															$(document).ready(function() {
															  	$("#owl-demo-learn_exp{{$service['id']}}").owlCarousel({
																   navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
																   items : 1, 
																   loop:true,
																   nav:true,
																   dots: false,
															  	});
															});
														</script>
				                                <a class="fav-fun-2" href="{{ Config::get('constants.SITE_URL') }}/userlogin" ><i class="far fa-heart"></i></a>
				                                @if($price_all != '')	
				                                <span>From ${{$price_all}}/Person</span>
				                                @endif
				                            </div>
                             			@endif
                             			@php
													$reviews_count = BusinessServiceReview::where('service_id', $service['id'])->count();
													$reviews_sum = BusinessServiceReview::where('service_id', $service['id'])->sum('rating');
													$reviews_avg=0;
													if($reviews_count>0)
													{	
														$reviews_avg= round($reviews_sum/$reviews_count,2); 
													}
												@endphp
												<div class="bottom-content">
													<div class="class-info">
														<div class="row">
															<div class="col-md-7 col-sm-7 col-xs-7 ratingtime">
																<div class="activity-inner-data">
																	<i class="fas fa-star"></i>
																	<span>{{$reviews_avg}} ({{$reviews_count}})</span>
																</div>
																@if($time != '')
																	<div class="activity-hours">
																		<span>{{$time}}</span>
																	</div>
																@endif
															</div>
															<div class="col-md-5 col-sm-5 col-xs-5 country-instant">
																<div class="activity-city">
																	<span style="white-space: nowrap;">{{$companycity}}</span>
																</div>
															</div>
														</div>
													</div>
													@php
														$redlink = str_replace(" ","-",$companyname);
														$service_type='';
														if($service['service_type']!=''){
															if( $service['service_type']=='individual' ) $service_type = 'Personal Training'; 
															else if( $service['service_type']=='classes' )	$service_type = 'Group Class'; 
															else if( $service['service_type']=='experience' ) $service_type = 'Experience'; 
															else if( $service['service_type']=='events' ) $service_type = 'Events';
														}
													@endphp
													<div class="activity-information activites-height">
														<span><a  @if (Auth::check())  
							                                    href="{{ route('businessprofile',['user_name'=>$redlink ,'id'=>$service['cid']])}}" 
							                                @else 
							                                    href="{{ route('userlogin') }}"  
							                                @endif
							                                    target="_blank"  class="companyalink">{{$companyname}}</a></span>
														<span><a 
							                                @if (Auth::check())  
							                                    href="{{ route('businessprofile',['user_name'=>$redlink ,'id'=>$service['cid']])}}" 
							                                @else 
							                                    href="{{ route('userlogin') }}" 
							                                @endif
							                                    target="_blank">{{ $service['program_name'] }}</a>
							                         	</span>
														<p>{{ $service_type }}  | {{ $service['sport_activity'] }}</p>
													</div>
													<hr>
													<div class="all-details">
														<a class="showall-btn" href="{{route('activities_show',['serviceid'=>  $serviceid])}}">More Details</a>
														<p class="addToCompare" id='compid{{$service["id"]}}' title="Add to Compare">COMPARE SIMILAR +</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php
			                    		}
			                		} ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif

		@if(count($events_activity) > 0)	
		<div class="row">
			<div class="col-xs-12 col-md-6 col-sm-6">
				<div class="title">
					<h3>Find Events In Your Area</h3>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-sm-6">
				<div class="nav-sliders-activites">
					<label>{{count($events_activity)}} Results </label>
					<a href="{{route('activities_index',['filtervalue'=> 'events_in_your_area'])}}">Show All </a>
				</div>
			</div>
			<!--<div class="col-md-8 leftside-kickboxing" id="activitylist">-->
			<div class="col-md-12 leftside-kickboxing" id="activitylistseven">
				<div class="row">
					<div class="ptb-65 float-left w-100 discover_activities" id="activitesseven">
						<div class="container-fluid">
							<div class="owl-slider kickboxing-slider-activites">
								<div id="inarea-activities" class="owl-carousel">
									<?php
						            $companyid = $companylat = $companylon = $companyname  = $latitude = $longitude = $serviceid = $companylogo = $companyaddress= "";
										$companycity = $companycountry = $pay_price  = "";
						            if (isset($events_activity)) {
						               $servicetype = [];
						               foreach ($events_activity as $loop => $service) {
						                  $company = $price = $businessSp = [];
												$serviceid = $service['id'];
				                        $sport_activity = $service['sport_activity'];
				                        $servicetype[$service['service_type']] = $service['service_type'];
				                        $area = !empty($service['area']) ? $service['area'] : 'Location';
				                        $company = CompanyInformation::where('id', $service['cid'])->first();
		                               if($company != '') {
	                                    $companyid = $company->id;
	                                    $companyaddress = $company->address;
	                                    $companyname = $company->company_name;
													$companycity = $company->city;
													$companycountry = $company->country;
													$companylogo = $company->logo;
													$companylat = $company->latitude;
													$companylon = $company->longitude;
	                                 }
			                            
	                                 if ($service['profile_pic']!="") {
												   if(str_contains($service['profile_pic'], ',')){
												     $pic_image = explode(',', $service['profile_pic']);
													    if( $pic_image[0] == ''){
													       $p_image  = $pic_image[1];
													    }else{
													       $p_image  = $pic_image[0];
													    }
													  }else{
													  	$pic_image = $service['profile_pic'];
													   $p_image = $service['profile_pic'];
													}

													if (file_exists( public_path() . '/uploads/profile_pic/' . $p_image)) {
													   $profilePic = url('/public/uploads/profile_pic/' . $p_image);
													}else {
													   $profilePic = url('/public/images/service-nofound.jpg');
													}
												}else{ $profilePic = '/public/images/service-nofound.jpg'; }

												$bookscheduler='';
												$time='';
												$bookscheduler = BusinessActivityScheduler::where('serviceid', $service['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
												if(@$bookscheduler[0]['set_duration']!=''){
													$tm=explode(' ',$bookscheduler[0]['set_duration']);
													$hr=''; $min=''; $sec='';
													if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
													if($tm[2]!=0){ $min=$tm[2].'min. '; }
													if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
													if($hr!='' || $min!='' || $sec!='')
													{ $time =  $hr.$min.$sec; } 
												}
												$pricearr = [];
												$price_all = '';
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
			                    	?>
									<div class="item">
										<div class="selectProduct" data-id="{{ $service['id'] }}" data-title="{{ $service['program_name'] }}" data-name="{{ $service['program_name'] }}" data-companyname="{{ $companyname }}" data-email="" data-address="{{ $companyaddress }}" data-img="{{ $profilePic }}" data-price="{{ $pay_price }}" data-token="{{ csrf_token() }}"> 
											<div class="kickboxing-block">
												@if(Auth::check())
													@php
			                                	$loggedId = Auth::user()->id;
			                                	$favData = BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$service['id'])->first();                   
                             				@endphp
                             				<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
														<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn_pop{{$service['id']}}" class="owl-carousel owl-theme">
																<?php 
																	$i = 0;
																	if(is_array($pic_image)){
																		foreach($pic_image as $img){
																			$profilePic1 = '';
																			if($img != ''){
																				if (file_exists( public_path() . '/uploads/profile_pic/' . $img)) {
														           				$profilePic1 = url('/public/uploads/profile_pic/' . $img);
																				}
														         		} 

													        				if($profilePic1 != ''){ ?>
																				<div class="item-inner">
																					<img src="{{$profilePic1}}" class="productImg">
																				</div>
																			<?php }
																		}
																	}else{
																		if (file_exists( public_path() . '/uploads/profile_pic/' . $pic_image)) {
													   					$profilePic1 = url('/public/uploads/profile_pic/' . $pic_image);
													    				}else {
													       				$profilePic1 = url('/public/images/service-nofound.jpg');
													    				} ?>
																		<div class="item-inner">
																			<img src="{{$profilePic1}}">
																		</div>
																<?php } ?>
															</div>
														</div>
														<script type="text/javascript">
															$(document).ready(function() {
															  	$("#owl-demo-learn_pop{{$service['id']}}").owlCarousel({
																   navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
																   items : 1, 
																   loop:true,
																   nav:true,
																   dots: false,
															  	});
															});
														</script>
														<div class="serv_fav1" ser_id="{{$service['id']}}" data-id = "serfavpopular">
															<a class="fav-fun-2" id="serfavpopular{{$service['id']}}">
			                                    	@if( !empty($favData) )
			                                        	<i class="fas fa-heart"></i>
																@else
			                                    		<i class="far fa-heart"></i>
			                                    	@endif
			                                     </a>
							                     </div>
							                     @if($price_all != '')
															<span>From ${{$price_all}}/Person</span>
														@endif
													</div>
                             			@else
                                			<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
														<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn_pop{{$service['id']}}" class="owl-carousel owl-theme">
																<?php 
																	$i = 0;
																	if(is_array($pic_image)){
																		foreach($pic_image as $img){
																			$profilePic1 = '';
																			if($img != ''){
																				if (file_exists( public_path() . '/uploads/profile_pic/' . $img)) {
														           				$profilePic1 = url('/public/uploads/profile_pic/' . $img);
																				}
														         		} 

													        				if($profilePic1 != ''){ ?>
																				<div class="item-inner">
																					<img src="{{$profilePic1}}" class="productImg">
																				</div>
																			<?php }
																		}
																	}else{
																		if (file_exists( public_path() . '/uploads/profile_pic/' . $pic_image)) {
													   					$profilePic1 = url('/public/uploads/profile_pic/' . $pic_image);
													    				}else {
													       				$profilePic1 = url('/public/images/service-nofound.jpg');
													    				} ?>
																		<div class="item-inner">
																			<img src="{{$profilePic1}}">
																		</div>
																<?php } ?>
															</div>
														</div>
														<script type="text/javascript">
															$(document).ready(function() {
															  	$("#owl-demo-learn_pop{{$service['id']}}").owlCarousel({
																   navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
																   items : 1, 
																   loop:true,
																   nav:true,
																   dots: false,
															  	});
															});
														</script>
			                                	<a class="fav-fun-2" href="{{ Config::get('constants.SITE_URL') }}/userlogin" ><i class="far fa-heart"></i></a>
			                                	@if($price_all != '')	
			                                		<span>From ${{$price_all}}/Person</span>
			                                	@endif
				                           </div>
                             			@endif
                             			@php
													$reviews_count = BusinessServiceReview::where('service_id', $service['id'])->count();
													$reviews_sum = BusinessServiceReview::where('service_id', $service['id'])->sum('rating');
													$reviews_avg=0;
													if($reviews_count>0)
													{	
														$reviews_avg= round($reviews_sum/$reviews_count,2); 
													}
												@endphp
												<div class="bottom-content">
													<div class="class-info">
														<div class="row">
															<div class="col-md-7 col-sm-7 col-xs-7 ratingtime">
																<div class="activity-inner-data">
																	<i class="fas fa-star"></i>
																	<span>{{$reviews_avg}} ({{$reviews_count}})</span>
																</div>
																@if($time != '')
																	<div class="activity-hours">
																		<span>{{$time}}</span>
																	</div>
																@endif
															</div>
															<div class="col-md-5 col-sm-5 col-xs-5 country-instant">
																<div class="activity-city">
																	<span style="white-space: nowrap;">{{$companycity}}</span>
																</div>
															</div>
														</div>
													</div>
													@php
														$redlink = str_replace(" ","-",$companyname);
														$service_type='';
														if($service['service_type']!=''){
															if( $service['service_type']=='individual' ) $service_type = 'Personal Training'; 
															else if( $service['service_type']=='classes' )	$service_type = 'Group Classe'; 
															else if( $service['service_type']=='experience' ) $service_type = 'Experience'; 
															else if( $service['service_type']=='events' ) $service_type = 'Events';
														}
													@endphp
													<div class="activity-information activites-height">
														<span><a  @if (Auth::check())  
							                                    href="{{ route('businessprofile',['user_name'=>$redlink ,'id'=>$service['cid']])}}" 
							                                @else 
							                                    href="{{ route('userlogin') }}"  
							                                @endif
							                                    target="_blank"  class="companyalink">{{$companyname}}</a></span>
														<span><a 
							                                @if (Auth::check())  
							                                    href="{{ route('businessprofile',['user_name'=>$redlink ,'id'=>$service['cid']])}}" 
							                                @else 
							                                    href="{{ route('userlogin') }}"  
							                                @endif
							                                    target="_blank">{{ $service['program_name'] }}</a>
							                         	</span>
														<p>{{ $service_type }}  | {{ $service['sport_activity'] }}</p>
													</div>
													<hr>
													<div class="all-details">
														<a class="showall-btn" href="{{route('activities_show',['serviceid'=>  $serviceid])}}">More Details</a>
														<p class="addToCompare" id='compid{{$service["id"]}}' title="Add to Compare">COMPARE SIMILAR +</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php
		                    		}
			                		} ?>
		                	    </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
		

		@if(count($allactivities) > 0)
		<div class="row">
			<div class="col-xs-12 col-md-6 col-sm-6">
				<div class="title">
					<h3>See All Activities	</h3>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-sm-6">
				<div class="nav-sliders-activites">
					<label>{{count($allactivities) }} Results </label>
					<a href="{{route('activities_index',['filtervalue'=> 'all'])}}">Show All </a>
				</div>
			</div>
		
			<div class="col-md-12 leftside-kickboxing" id="activitylistsix">
				<div class="row">
					<div class="ptb-65 float-left w-100 discover_activities" id="activitessix">
						<div class="container-fluid">
							<div class="owl-slider kickboxing-slider-activites">
								<div id="trainers-coaches" class="owl-carousel">
									<?php
					            	$companyid = $companylat = $companylon = $companyname  = $latitude = $longitude = $serviceid = $companylogo = $companyaddress= "";
										$companycity = $companycountry = $pay_price  = "";
					               if (isset($allactivities) && count($allactivities) > 0) {
					                  $servicetype = [];
					                  $profilePic1 = '';
					                  $pic_image = '';
					                  foreach ($allactivities as $loop => $service) {
					                     $company = $price = $businessSp = [];
												$serviceid = $service['id'];
				                        $sport_activity = $service['sport_activity'];
				                        $servicetype[$service['service_type']] = $service['service_type'];
				                        $area = !empty($service['area']) ? $service['area'] : 'Location';
				                        $company = CompanyInformation::where('id', $service['cid'])->first();
	                                 if($company != '') {
	                                    $companyid = $company->id;
	                                    $companyaddress = $company->address;
	                                    $companyname = $company->company_name;
													$companycity = $company->city;
													$companycountry = $company->country;
													$companylogo = $company->logo;
													$companylat = $company->latitude;
													$companylon = $company->longitude;
			                           }
					                            
			                           if ($service['profile_pic']!="") {
					                        if(str_contains($service['profile_pic'], ',')){
			                                 $pic_image = explode(',', $service['profile_pic']);
		                                    if( $pic_image[0] == ''){
		                                       $p_image  = $pic_image[1];
		                                    }else{
		                                       $p_image  = $pic_image[0];
		                                    }
			                              }else{
			                              	$pic_image = $service['profile_pic'];
	                                       $p_image = $service['profile_pic'];
	                                    }

	                                    if (file_exists( public_path() . '/uploads/profile_pic/' . $p_image)) {
	                                       $profilePic = url('/public/uploads/profile_pic/' . $p_image);
	                                    }else {
	                                       $profilePic = url('/public/images/service-nofound.jpg');
	                                    }
												}else{ $profilePic = '/public/images/service-nofound.jpg'; }

												$bookscheduler='';
												$time='';
												$bookscheduler = BusinessActivityScheduler::where('serviceid', $service['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
												if(@$bookscheduler[0]['set_duration']!=''){
													$tm=explode(' ',$bookscheduler[0]['set_duration']);
													$hr=''; $min=''; $sec='';
													if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
													if($tm[2]!=0){ $min=$tm[2].'min. '; }
													if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
													if($hr!='' || $min!='' || $sec!='')
													{ $time =  $hr.$min.$sec; } 
												}
												$pricearr = [];
												$price_all = '';
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
			                    ?>
									<div class="item">
										<div class="selectProduct" data-id="{{ $service['id'] }}" data-title="{{ $service['program_name'] }}" data-name="{{ $service['program_name'] }}" data-companyname="{{ $companyname }}" data-email="" data-address="{{ $companyaddress }}" data-img="{{ $profilePic }}" data-price="{{ $pay_price }}" data-token="{{ csrf_token() }}"> 
											<div class="kickboxing-block">
												@if(Auth::check())
													@php
			                                	$loggedId = Auth::user()->id;
			                                	$favData = BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$service['id'])->first();                   
                             				@endphp
	                                		<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
	                                			<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn{{$service['id']}}" class="owl-carousel owl-theme">
																<?php 
																$i = 0;
																if(is_array($pic_image)){
																	foreach($pic_image as $img){
																		$profilePic1 = '';
																		if($img != ''){
																			if (file_exists( public_path() . '/uploads/profile_pic/' . $img)) {
						                                       	$profilePic1 = url('/public/uploads/profile_pic/' . $img);
																			}
							                                 } 

						                                    if($profilePic1 != ''){ ?>
																		<div class="item-inner">
																			<img src="{{$profilePic1}}" class="productImg">
																		</div>
																	<?php }
																	}
																}else{
																	if (file_exists( public_path() . '/uploads/profile_pic/' . $pic_image)) {
				                                       	$profilePic1 = url('/public/uploads/profile_pic/' . $pic_image);
					                                    }else {
					                                       $profilePic1 = url('/public/images/service-nofound.jpg');
					                                    } ?>
																	<div class="item-inner">
																		<img src="{{$profilePic1}}">
																	</div>
																<?php } ?>
															</div>
														</div>
														<script type="text/javascript">
															$(document).ready(function() {
															  	$("#owl-demo-learn{{$service['id']}}").owlCarousel({
																   navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
																   items : 1, 
																   loop:true,
																   nav:true,
																   dots: false,
															  	});
															});
														</script>
														
														<div class="serv_fav1" ser_id="{{$service['id']}}" data-id = "serfavall">
															<a class="fav-fun-2" id="serfavall{{$service['id']}}">
						                                    	@if( !empty($favData) )
						                                        	<i class="fas fa-heart"></i>
																@else
						                                    		<i class="far fa-heart"></i>
						                                    	@endif
						                                     </a>
							                            </div>
							                            @if($price_all != '')
														<span>From ${{$price_all}}/Person</span>
														@endif
													</div>
                             			@else
                                			<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
														<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn{{$service['id']}}" class="owl-carousel owl-theme">
																<?php 
																$i = 0;
																if(is_array($pic_image)){
																	foreach($pic_image as $img){
																		$profilePic1 = '';
																		if($img != ''){
																			if (file_exists( public_path() . '/uploads/profile_pic/' . $img)) {
						                                       	$profilePic1 = url('/public/uploads/profile_pic/' . $img);
																			}
							                                 } 

						                                    if($profilePic1 != ''){ ?>
																		<div class="item-inner">
																			<img src="{{$profilePic1}}" class="productImg">
																		</div>
																	<?php }
																	}
																}else{
																	if (file_exists( public_path() . '/uploads/profile_pic/' . $pic_image)) {
				                                       	$profilePic1 = url('/public/uploads/profile_pic/' . $pic_image);
					                                    }else {
					                                       $profilePic1 = url('/public/images/service-nofound.jpg');
					                                    } ?>
																	<div class="item-inner">
																		<img src="{{$profilePic1}}">
																	</div>
																<?php } ?>
															</div>
														</div>
														<script type="text/javascript">
															$(document).ready(function() {
															  	$("#owl-demo-learn{{$service['id']}}").owlCarousel({
																   navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
																   items : 1, 
																   loop:true,
																   nav:true,
																   dots: false,
															  	});
															});
														</script>
			                                	<a class="fav-fun-2" href="{{ Config::get('constants.SITE_URL') }}/userlogin" ><i class="far fa-heart"></i></a>
			                                	@if($price_all != '')	
			                                		<span>From ${{$price_all}}/Person</span>
			                                	@endif
				                           </div>
                             			@endif
                             			@php
													$reviews_count = BusinessServiceReview::where('service_id', $service['id'])->count();
													$reviews_sum = BusinessServiceReview::where('service_id', $service['id'])->sum('rating');
													$reviews_avg=0;
													if($reviews_count>0)
													{	
														$reviews_avg= round($reviews_sum/$reviews_count,2); 
													}
												@endphp
												<div class="bottom-content">
													<div class="class-info">
														<div class="row">
															<div class="col-md-7 col-sm-7 col-xs-7 ratingtime">
																<div class="activity-inner-data">
																	<i class="fas fa-star"></i>
																	<span>{{$reviews_avg}} ({{$reviews_count}})</span>
																</div>
																@if($time != '')
																	<div class="activity-hours">
																		<span>{{$time}}</span>
																	</div>
																@endif
															</div>
															<div class="col-md-5 col-sm-5 col-xs-5 country-instant">
																<div class="activity-city">
																	<span style="white-space: nowrap;">{{$companycity}}</span>
																</div>
															</div>
														</div>
													</div>
													@php
														$redlink = str_replace(" ","-",$companyname);
														$service_type='';
														if($service['service_type']!=''){
															if( $service['service_type']=='individual' ) $service_type = 'Personal Training'; 
															else if( $service['service_type']=='classes' )	$service_type = 'Group Class'; 
															else if( $service['service_type']=='experience' ) $service_type = 'Experience'; 
															else if( $service['service_type']=='events' ) $service_type = 'Events';
														}
													@endphp
													<div class="activity-information activites-height">
														<span><a  @if (Auth::check())  
							                                    href="{{ route('businessprofile',['user_name'=>$redlink ,'id'=>$service['cid']])}}" 
							                                @else 
							                                    href="{{ route('userlogin') }}"  
							                                @endif
							                                    target="_blank"  class="companyalink">{{$companyname}}</a></span>
														<span><a 
							                                @if (Auth::check())  
							                                    href="{{ route('businessprofile',['user_name'=>$redlink ,'id'=>$service['cid']])}}" 
							                                @else 
							                                    href="{{ route('userlogin') }}"  
							                                @endif
							                                    target="_blank">{{ $service['program_name'] }}</a>
							                         	</span>
														<p>{{ $service_type }}  | {{ $service['sport_activity'] }}</p>
													</div>
													<hr>
													<div class="all-details">
														<a class="showall-btn" href="{{route('activities_show',['serviceid'=>  $serviceid])}}">More Details</a>
														<p class="addToCompare" id='compid{{$service["id"]}}' title="Add to Compare">COMPARE SIMILAR +</p>
													</div>
												</div>
											</div>
										</div>
									</div>
									
								<?php
		                    		}
		                		} ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
		
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
						<a href="{{route('addbusinesscustomer')}}" class="addbusiness-btn-modal">I'M A CUSTOMER</a>
						<a href="{{route('businessClaim')}}" class="addbusiness-btn-black">I'M A BUSINESS OWNER</a>
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
						if($('#serfavstarts'+ser_id).length){
							$('#serfavstarts'+ser_id).html('<i class="fas fa-heart"></i>');
						}
					
						if($('#serfavmonth'+ser_id).length){
							$('#serfavmonth'+ser_id).html('<i class="fas fa-heart"></i>');
						}

						if($('#serfavpopular'+ser_id).length){
							$('#serfavpopular'+ser_id).html('<i class="fas fa-heart"></i>');
						}

						if($('#serfavTrainer'+ser_id).length){
							$('#serfavTrainer'+ser_id).html('<i class="fas fa-heart"></i>');
						}

						if($('#serfavWorkout'+ser_id).length){
							$('#serfavWorkout'+ser_id).html('<i class="fas fa-heart"></i>');
						}

						if($('#serfavfun'+ser_id).length){
							$('#serfavfun'+ser_id).html('<i class="fas fa-heart"></i>');
						}

						if($('#serfavall'+ser_id).length){
							$('#serfavall'+ser_id).html('<i class="fas fa-heart"></i>');
						}
					}
					else
					{
						if($('#serfavstarts'+ser_id).length){
							$('#serfavstarts'+ser_id).html('<i class="far fa-heart"></i>');
						}

						if($('#serfavmonth'+ser_id).length){
							$('#serfavmonth'+ser_id).html('<i class="far fa-heart"></i>');
						}

						if($('#serfavpopular'+ser_id).length){
							$('#serfavpopular'+ser_id).html('<i class="far fa-heart"></i>');
						}

						if($('#serfavTrainer'+ser_id).length){
							$('#serfavTrainer'+ser_id).html('<i class="far fa-heart"></i>');
						}

						if($('#serfavWorkout'+ser_id).length){
							$('#serfavWorkout'+ser_id).html('<i class="far fa-heart"></i>');
						}

						if($('#serfavfun'+ser_id).length){
							$('#serfavfun'+ser_id).html('<i class="far fa-heart"></i>');
						}

						if($('#serfavall'+ser_id).length){
							$('#serfavall'+ser_id).html('<i class="far fa-heart"></i>');
						}
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
<!-- <script type="text/javascript">	
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
</script> -->

<!-- <script type="text/javascript">
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
</script> -->

<script>
	jQuery("#carousel-slider").owlCarousel({
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
	jQuery("#popular-activities").owlCarousel({
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
	jQuery("#inarea-activities").owlCarousel({
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
	jQuery("#find-trainers").owlCarousel({
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
	jQuery("#ways-to-workout").owlCarousel({
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
	jQuery("#all-activities").owlCarousel({
	  autoplay: true,
	  rewind: true,
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
	jQuery("#trainers-coaches").owlCarousel({
	  autoplay: true,
	  rewind: true,
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
</script>
@endsection