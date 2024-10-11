@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
@section('content')
<?php
	use Illuminate\Support\Str;
	use Illuminate\Support\Facades\Auth; 
?>
<!-- is this file is loading?  -->
<link rel='stylesheet' type='text/css' href="{{url('/public/css/frontend/general.css')}}">
<link href="{{url('/public/css/compare/style.css')}}" rel="stylesheet" type="text/css" />
<link href="{{url('/public/css/compare/w3.css')}}" rel="stylesheet" type="text/css" />
 <link href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css" type="text/css" rel="stylesheet" /> 
 <link rel='stylesheet' type='text/css' href="{{url('/public/css/responsive.css')}}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<section class="instant-hire" >
	<div class="container-fluid plr-15">
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="title get-start-sp">
					<h3>Find Activities By Category</h3>
				</div>
			</div>
			<!-- Mobile Slider -->
			<div class="col-md-12 desktop-none">
				<div class="mobile-slider owl-carousel owl-theme">
					@foreach($getstarteddata as $getdatafast)
						<div class="owl-item" style="width: 300px;">
							<div class="card-info instant-section-info">
								<div class="img">
								   <img src="{{ url('public/uploads/discover/thumb/'.$getdatafast['image'])}}" alt="Fitnessity" loading="lazy">
								</div>
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
			</div>
			
			@foreach($getstarteddata as $getdatafast)
				<div class="col-md-3 col-sm-3 col-xs-12 mobile-none ipad-none">
					<div class="instant-section-info">
						<img src="{{ url('public/uploads/discover/thumb/'.$getdatafast['image'])}}" alt="Fitnessity" loading="lazy">
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
							<h3 class="desktop-none f-16">Get Started Fast With Activities Starting In 8 Hrs for <?php echo date('l').', '.date('F d, Y', $date); ?></h3>
							<h3 class="mobile-none ipad-none">Get Started Fast With Activities Starting In 8 Hrs for <?php echo date('l').', '.date('F d, Y', $date); ?></h3>
						</div>
					</div>
					<div class="col-md-2 col-xs-12"> 
						<div class="title-show desktop-none show-all-page">
							<a href="{{route('activities_next_8_hours')}}"><i class="fas fa-chevron-right"></i></a>
						</div>
						<div class="title-show mobile-none ipad-none">
							<a href="{{route('activities_next_8_hours')}}">Show All</a>
						</div>
					</div>
					<!-- Mobile Slider -->
					
						<div class="col-md-12 desktop-none">
							<div class="find-activity-owl owl-carousel owl-theme">
								@foreach ($bookschedulers as $bookscheduler) 
								<div class="owl-item" style="width: 300px;">
									<div class="card-info">
                                    	<div class="">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12">
                                                    <div class="find-activity">
                                                   		<div class="container">
                                                            <div class="row y-middle">
                                                                <div class="col-xs-12 col-sm-12 col-12 like-heart">
                                                                    <div class="item-inner">
                                                                        <!-- {{-- <img src="{{$bookscheduler->business_service->first_profile_pic()}}" class="productImg" alt="Fitnessity"> --}} -->
																		<img src="{{$bookscheduler->business_service->getConverPhotoUrl()}}" class="productImg" alt="Fitnessity" loading="lazy">
                                                                    </div>
                                                                    <div class="wegites-like">
																		@auth
																			<div class="serv_fav1"  ser_id="{{$bookscheduler->business_service->id}}" data-id="serfavstarts">
																				<a class="fav-fun-2" id="serfavstarts{{$bookscheduler->business_service->id}}">
																					<!-- <i class="far fa-heart"></i> -->
																					<i class="<?php echo ($bookscheduler->business_service->is_liked_by(Auth::id())) ? 'fas' : 'far' ?> fa-heart"></i>
																				</a>
																			</div>
																			@endauth
																				@guest
																				<a class="fav-fun-2" href="{{ route('userlogin')}}" ><i class="far fa-heart"></i></a>
																				@endguest
																			<!-- <span>From   <strike> $510</strike> $459/Person</span> -->
																			@php 
																				$bookschedulercom_name = $bookscheduler->company_information->dba_business_name;
																				if($bookscheduler->company_information->dba_business_name == ''){
																					$bookschedulercom_name = $bookscheduler->company_information->company_name;
																				}
																				$price_all = $bookscheduler->business_service->min_price();
																			@endphp
																			@if($price_all != '')
																					<span>From {!!$price_all!!}/Person</span>
																				@endif
																		</div>
                                                                </div>
                                                                
                                                                <div class="col-xs-12 col-sm-12 col-12 activity-data">
                                                                <div class="container">
                                                                    <div class="row">
                                                                       <?php /*?> <div class="col-xs-12 text-right">
                                                                            @auth
                                                                                <div class="serv_fav1" ser_id="{{$bookscheduler->business_service->id}}" data-id="serfavstarts">
                                                                                    <a class="fav-fun-2" id="serfavstarts{{$bookscheduler->business_service->id}}">
                                                                                        <i class="<?php echo ($bookscheduler->business_service->is_liked_by(Auth::id())) ? 'fas' : 'far' ?> fa-heart"></i>
                                                                                </div>
                                                                            @endauth
                                                                            @guest
                                                                                <a class="fav-fun-2" href="{{ route('userlogin')}}" ><i class="f
                                                                                    ar fa-heart"></i></a>
                                                                            @endguest
                                                                        </div><?php */?>
                                                                        <div class="col-xs-6 col-6">
                                                                            <div class="activity-inner-data">
                                                                                <i class="fas fa-star"></i>
                                                                                <span> {{$bookscheduler->business_service->reviews_score()}} ({{$bookscheduler->business_service->reviews->count()}})</span>
                                                                            </div>
        
                                                                            <div class="activity-hours">
                                                                                <span>{{$bookscheduler->get_duration_hours()}}</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-6 col-6">
                                                                            <div class="activity-city float-right">
                                                                                <span style="white-space: nowrap;">{{$bookscheduler->company_information->city}}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
        														</div>
                                                                    <div class="activity-information">
                                                                        @php 
                                                                            $bookschedulercom_name = $bookscheduler->company_information->dba_business_name;
                                                                            if($bookscheduler->company_information->dba_business_name == ''){
                                                                                $bookschedulercom_name = $bookscheduler->company_information->company_name;
                                                                            }
                                                                            $price_all = $bookscheduler->business_service->min_price();
                                                                        @endphp
                                                                        <span><a href="{{route('businessprofiletimeline', ['user_name' => $bookschedulercom_name, 'id' => $bookscheduler->company_information->id])}}" target="_blank">{{$bookscheduler->business_service->program_name}}</a></span>
                                                                        <span><a href="{{route('businessprofiletimeline', ['user_name' => $bookschedulercom_name, 'id' => $bookscheduler->company_information->id])}}" target="_blank"  class="companyalink">{{$bookschedulercom_name}}</a></span>
                                                                        <p>{{$bookscheduler->business_service->formal_service_types()}} | {{$bookscheduler->business_service->sport_activity}}</p>
                                                                        <div class="dollar-person">
                                                                            <!-- {{-- @if($price_all != '')
                                                                                <span>From {!!$price_all!!}/Person</span>
                                                                            @endif --}} -->
                                                                        </div>
                                                                    </div>
        
                                                                    <div class="row">
                                                                        <div class="col-xs-12 text-center">
                                                                            <a class="showall-btn" href="{{route('activities_show', ['serviceid' => $bookscheduler->business_service->id])}}">Book Now</a>
                                                                        </div>
                                                                        <div class="col-xs-12">
                                                                            <div class="activity-time-main <?php echo ($bookscheduler->is_start_in_one_hour($current_date)) ? 'activity-time-main-red' : ''?>">
                                                                                <span>Starts in 
                                                                                @if ($bookscheduler->time_left($current_date)->h)
                                                                                    {{$bookscheduler->time_left($current_date)->h}} {{Str::plural('hr', $bookscheduler->time_left($current_date)->h)}}
                                                                                @endif
                                                                                @if ($bookscheduler->time_left($current_date)->i)
                                                                                    {{$bookscheduler->time_left($current_date)->i}} {{Str::plural('min', $bookscheduler->time_left($current_date)->i)}}
                                                                                @endif</span>
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
									</div>
								</div>
								@endforeach
							</div>
						</div>

					@foreach ($bookschedulers as $bookscheduler)
						<div class="col-lg-3 col-md-4 col-sm-6 mobile-none ipad-none">
							<div class="find-activity">
								<div class="">
									<div class="col-lg-12 col-md-4 col-sm-4">
										<div class="p-relative like-heart">
											<div class="item-inner">
												<!-- {{-- <img src="{{$bookscheduler->business_service->first_profile_pic()}}" class="productImg" alt="Fitnessity"> --}} -->
												<img src="{{$bookscheduler->business_service->getConverPhotoUrl()}}" class="productImg" alt="Fitnessity" loading="lazy">
												<!-- {{-- <input type="text" value="{{$bookscheduler->business_service->getConverPhotoUrl()}}"> --}} -->
											</div>
											<div class="wegites-like">
												@auth
														<div class="serv_fav1"  ser_id="{{$bookscheduler->business_service->id}}" data-id="serfavstarts">
															 <a class="fav-fun-2" id="serfavstarts{{$bookscheduler->business_service->id}}">
																  <!-- <i class="far fa-heart"></i> -->
																	<i class="<?php echo ($bookscheduler->business_service->is_liked_by(Auth::id())) ? 'fas' : 'far' ?> fa-heart"></i>
															</a>
														</div>
												@endauth
												@guest
														<a class="fav-fun-2" href="{{ route('userlogin')}}" ><i class="far fa-heart"></i></a>
												@endguest
												<!-- <span>From   <strike> $510</strike> $459/Person</span> -->
												@php 
													 $bookschedulercom_name = $bookscheduler->company_information->dba_business_name;
													 if($bookscheduler->company_information->dba_business_name == ''){
														 $bookschedulercom_name = $bookscheduler->company_information->company_name;
													 }
													 $price_all = $bookscheduler->business_service->min_price();
												 @endphp
												@if($price_all != '')
													<span>From {!!$price_all!!}/Person</span>
												@endif
										</div>
										</div>
									</div>
									<div class="col-lg-12 col-md-8 col-sm-8 activity-data">
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
													
												</div>
											</div>
										</div>
										<div class="activity-information ">
											@php 
												$bookschedulercom_name = $bookscheduler->company_information->dba_business_name;
												if($bookscheduler->company_information->dba_business_name == ''){
													$bookschedulercom_name = $bookscheduler->company_information->company_name;
												}
												$price_all = $bookscheduler->business_service->min_price();
											@endphp
											<span><a href="{{route('businessprofiletimeline', ['user_name' => $bookschedulercom_name, 'id' => $bookscheduler->company_information->id])}}" target="_blank">{{$bookscheduler->business_service->program_name}}</a></span>

											<span><a  href="{{route('businessprofiletimeline', ['user_name' => $bookschedulercom_name, 'id' => $bookscheduler->company_information->id])}}"target="_blank"  class="companyalink">{{$bookschedulercom_name}}</a></span>
											
											<p>{{$bookscheduler->business_service->formal_service_types()}} | {{$bookscheduler->business_service->sport_activity}}</p>
											<div class="mt-15"><a class="showall-btn" href="{{route('activities_show', ['serviceid' => $bookscheduler->business_service->id])}}">Book Now</a></div>
											
										</div>
										<div class="row">
											<div class="col-md-6 col-sm-6 col-xs-6 activites-price-details">
											<!-- <div class="dollar-person"> -->
												<!-- @if($price_all != '')
													<span>From {!!$price_all!!}/Person</span>
												@endif -->
											<!-- </div> -->
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12 activites-price-details-left">
												<div class="activity-time-main text-center <?php echo ($bookscheduler->is_start_in_one_hour($current_date)) ? 'activity-time-main-red' : ''?>">
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
				<div class="nav-sliders-activites activity-z-index">
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
					            $companyid =  $companyname  =  $serviceid = $companyaddress= "";
									$companycity = $pay_price  = "";
					            if (isset($thismonthactivity)) {
					               foreach ($thismonthactivity as $loop => $service) {
					                  $company = $price = $businessSp = [];
											$serviceid = $service['id'];
			                        $company = $service->company_information;
                                 if($company != '') {
                                    $companyaddress = $company->address;
                                    $companyname = $companyname == '' ? $company->company_name : $company->dba_business_name;
                                    
												$companycity = $company->city;
			                        }
					                  

					                //   $profilePic =  Storage::disk('s3')->exists($service->first_profile_pic()) ? Storage::URL($service->first_profile_pic()) : url('/images/service-nofound.jpg'); 
									$profilePic = $service->first_profile_pic();
									if($profilePic=='')
									{
										$profilePic =  url('/images/service-nofound.jpg');

									}
									  
					                  $pic_image = explode(',',$service['profile_pic']);
											$bookscheduler = App\BusinessActivityScheduler::where('serviceid', $service['id'])->orderBy('id', 'ASC')->first();
											$time = @$bookscheduler != '' ? @$bookscheduler->get_duration() : '';
											$price_all = (@$bookscheduler->business_service !='')  ? $bookscheduler->business_service->min_price() : 0;
		                    	?>
										<!-- {{$profilePic}} -->
								
									<div class="item">
										<div class="selectProduct" data-id="{{ @$service['id'] }}" data-title="{{ @$service['program_name'] }}" data-name="{{ @$service['program_name'] }}" data-companyname="{{ $companyname }}" data-email="" data-address="{{ $companyaddress }}" data-img="{{ $profilePic }}" data-price="{{ $pay_price }}" data-token="{{ csrf_token() }}"> 
											<div class="kickboxing-block">
												@if(Auth::check())
													@php
			                                	$loggedId = Auth::user()->id;
			                                	$favData = App\BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$service['id'])->first();                   
                             				@endphp
                             				<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
														<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn_thismon{{$service['id']}}" class="owl-carousel owl-theme">
																@if(is_array($pic_image))
																	@foreach($pic_image as $img)
																		@if(Storage::disk('s3')->exists($img) && $img != '' )
																			<div class="item-inner">
																				<img src="{{Storage::URL($img)}}" class="productImg" alt="Fitnessity" loading="lazy">
																			</div>
																		@else
																			<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																		@endif
																	@endforeach
																@else
																	@if(Storage::disk('s3')->exists($pic_image) && $pic_image != '' )
																		<div class="item-inner">
																			<img src="{{Storage::URL($pic_image)}}" loading="lazy">
																		</div>
																	@else
																		<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																	@endif
																@endif
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
															<span>From {!!$price_all!!}/Person</span>
														@endif
													</div>
                             			@else
                                			<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
														<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn_thismon{{$service['id']}}" class="owl-carousel owl-theme">
																@if(is_array($pic_image))
																	@foreach($pic_image as $img)
																		@if(Storage::disk('s3')->exists($img) && $img != '' )
																			<div class="item-inner">
																				<img src="{{Storage::URL($img)}}" class="productImg" alt="Fitnessity" loading="lazy">
																			</div>
																		@else
																			<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																		@endif
																	@endforeach
																@else
																	@if(Storage::disk('s3')->exists($pic_image) && $pic_image != '' )
																		<div class="item-inner">
																			<img src="{{Storage::URL($pic_image)}}" loading="lazy">
																		</div>
																	@else
																		<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																	@endif
																@endif
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
				                                	<span>From {!!$price_all!!}/Person</span>
				                              @endif
				                           </div>
                             			@endif
                             			@php
													$reviews_count = App\BusinessServiceReview::where('service_id', $service['id'])->count();
													$reviews_sum = App\BusinessServiceReview::where('service_id', $service['id'])->sum('rating');
													
													$reviews_avg=  $reviews_count>0 ? round($reviews_sum/$reviews_count,2):0;
												@endphp
												<div class="bottom-content">
													<div class="class-info">
														<div class="row">
															<div class="col-md-7 col-sm-7 col-xs-7 col-7 ratingtime">
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
															<div class="col-md-5 col-sm-5 col-xs-5 col-5 country-instant">
																<div class="activity-city">
																	<span style="white-space: nowrap;">{{$companycity}}</span>
																</div>
															</div>
														</div>
													</div>
													@php
														$redlink = str_replace(" ","-",$companyname);
													@endphp
													<div class="activity-information activites-height">
														<span><a href="{{ route('businessprofiletimeline',['user_name'=>$redlink ,'id'=>$service['cid']])}}" target="_blank">{{ $service['program_name'] }}</a></span>
														<span><a  href="{{ route('businessprofiletimeline',['user_name'=>$redlink ,'id'=>$service['cid']])}}" target="_blank"  class="companyalink">{{$companyname}}</a></span>
														<p>{{ $service->formal_service_types() }}  | {{ $service['sport_activity'] }}</p>
													</div>
													<hr>
													<div class="all-details">
														<a class="showall-btn" href="{{route('activities_show',['serviceid'=>  $serviceid])}}">Book Now</a>
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

		@if(count($mostpopularactivity) > 0)	
		<div class="row">
			<div class="col-xs-12 col-md-6 col-sm-6">
				<div class="title">
					<h3>Most Popular Activities	</h3>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-sm-6">
				<div class="nav-sliders-activites activity-z-index ">
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
						            $companyid =  $companyname  =  $serviceid = $companyaddress= "";
										$companycity = $pay_price  = "";
						            if (isset($mostpopularactivity)) {
						               foreach ($mostpopularactivity as $loop => $service) {
						                  $company = $price = $businessSp = [];
												$serviceid = $service['id'];
				                        $company = $service->company_information;
		                               if($company != '') {
	                                    $companyaddress = $company->address;
	                                    $companyname = $company->dba_business_name != '' ? $company->dba_business_name : $company->company_name;
													$companycity = $company->city;
	                                 }
			                            
	                                //  $profilePic =  Storage::disk('s3')->exists($service->first_profile_pic()) ? Storage::URL($service->first_profile_pic()) : url('/images/service-nofound.jpg'); 
									$profilePic = $service->first_profile_pic();
							
					                  	$pic_image = explode(',',$service['profile_pic']);
									 	$cover_photo=$service->getConverPhotoUrl_img();

										 if (!empty($cover_photo)) {
												array_unshift($pic_image, $cover_photo);
										}

										$bookscheduler = App\BusinessActivityScheduler::where('serviceid', $service['id'])->orderBy('id', 'ASC')->first();
										$time = @$bookscheduler != '' ? @$bookscheduler->get_duration() : '';
										$price_all = $service->min_price();
			                    	?>
									
									<div class="item">
										<div class="selectProduct" data-id="{{ $service['id'] }}" data-title="{{ $service['program_name'] }}" data-name="{{ $service['program_name'] }}" data-companyname="{{ $companyname }}" data-email="" data-address="{{ $companyaddress }}" data-img="{{ $profilePic }}" data-price="{{ $pay_price }}" data-token="{{ csrf_token() }}"> 
											<div class="kickboxing-block">
												@if(Auth::check())
												@php
			                                	$loggedId = Auth::user()->id;
			                                	$favData = App\BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$service['id'])->first();                   
                             					@endphp
                             				<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
														<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn_pop{{$service['id']}}" class="owl-carousel owl-theme">
																@if(is_array($pic_image))
																	@foreach($pic_image as $img)
																		@if(Storage::disk('s3')->exists($img) && $img != '' )
																			<div class="item-inner">
																				<img src="{{Storage::URL($img)}}" class="productImg" alt="Fitnessity" loading="lazy">
																			</div>
																		@else
																			<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																		@endif
																	@endforeach
																@else
																	@if(Storage::disk('s3')->exists($pic_image) && $pic_image != '' )
																		<div class="item-inner">
																			<img src="{{Storage::URL($pic_image)}}" loading="lazy">
																		</div>
																	@else
																		<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																	@endif
																@endif
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
			                                    	@if(!empty($favData) )
			                                        	<i class="fas fa-heart"></i>
																@else
			                                    		<i class="far fa-heart"></i>
			                                    	@endif
			                                     </a>
							                     </div>
							                     @if($price_all != '')
															<span>From {!!$price_all!!}/Person</span>
														@endif
													</div>
													@if($service['video']!='')
                                                    <div class="p-relative">
                                                    	<a class="play-btn-set item-gallery" href="{{$service['video']}}" data-fancybox="" data-elementor-open-lightbox="no">
                                                         <source src="{{$service['video']}}" type="video/mp4">
                                                       		<i class="fas fa-play"></i>
                                                        </a>
                                                    </div>
													@endif 
                             			@else
                                			<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
														<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn_pop{{$service['id']}}" class="owl-carousel owl-theme">
																@if(is_array($pic_image))
																	@foreach($pic_image as $img)
																		@if(Storage::disk('s3')->exists($img) && $img != '' )
																			<div class="item-inner">
																				<img src="{{Storage::URL($img)}}" class="productImg" alt="Fitnessity" loading="lazy">
																			</div>
																		@else
																			<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																		@endif
																	@endforeach
																@else
																	@if(Storage::disk('s3')->exists($pic_image) && $pic_image != '' )
																		<div class="item-inner">
																			<img src="{{Storage::URL($pic_image)}}" loading="lazy">
																		</div>
																	@else
																		<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																	@endif
																@endif
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
			                                		<span>From {!!$price_all!!}/Person</span>
			                                	@endif
				                           </div>
                                           <!-- <div class="p-relative">
                                            <a class="play-btn-set item-gallery" href="https://www.youtube.com/watch?v=AmZ0WrEaf34" data-fancybox="" data-elementor-open-lightbox="no">
                                             <source src="https://www.youtube.com/watch?v=AmZ0WrEaf34" type="video/mp4">
                                                <i class="fas fa-play"></i>
                                            </a> 
                                        	</div> -->
													@if($service['video']!='')
                                                    <div class="p-relative">
                                                    	<a class="play-btn-set item-gallery" href="{{$service['video']}}" data-fancybox="" data-elementor-open-lightbox="no">
                                                         <source src="{{$service['video']}}" type="video/mp4">
                                                       		<i class="fas fa-play"></i>
                                                        </a>
                                                    </div>
													@endif 
                             			@endif
                             			@php
													$reviews_count = App\BusinessServiceReview::where('service_id', $service['id'])->count();
													$reviews_sum = App\BusinessServiceReview::where('service_id', $service['id'])->sum('rating');
													
													$reviews_avg=  $reviews_count>0 ? round($reviews_sum/$reviews_count,2):0;
												@endphp
												<div class="bottom-content">
													<div class="class-info">
														<div class="row">
															<div class="col-md-7 col-sm-7 col-xs-7 col-7 ratingtime">
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
															<div class="col-md-5 col-sm-5 col-xs-5 col-5 country-instant">
																<div class="activity-city">
																	<span style="white-space: nowrap;">{{$companycity}}</span>
																</div>
															</div>
														</div>
													</div>
													@php
														$redlink = str_replace(" ","-",$companyname);
													@endphp
													<div class="activity-information activites-height">
														<span><a href="{{ route('businessprofiletimeline',['user_name'=>$redlink ,'id'=>$service['cid']])}}" target="_blank">{{ $service['program_name'] }}</a></span>
														<span><a  href="{{ route('businessprofiletimeline',['user_name'=>$redlink ,'id'=>$service['cid']])}}" target="_blank" class="companyalink">{{$companyname}}</a></span>
														
														<p>{{ $service->formal_service_types() }}  | {{ $service['sport_activity'] }} {{$service->id}} </p>
													</div>
													<hr>
													<div class="all-details">
														<div class="col-md-12 col-xs-12">
														<a class="showall-btn" href="{{route('activities_show',['serviceid'=>  $serviceid])}}">Book Now</a>
														</div>
														<div class="col-md-12 col-xs-12">
														<p class="addToCompare" id='compid{{$service["id"]}}' title="Add to Compare">COMPARE SIMILAR +</p>
														</div>
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
				<div class="nav-sliders-activites activity-z-index ">
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
						            $companyid =  $companyname  =  $serviceid = $companyaddress= "";
										$companycity = $pay_price  = "";
						            if (isset($Trainers_coachesacitvity)) {
						               foreach ($Trainers_coachesacitvity as $loop => $service) {
						                  $company = $price = $businessSp = [];
												$serviceid = $service['id'];
				                        $company = $service->company_information;
		                              if($company != '') {
	                                    $companyaddress = $company->address;
	                                    $companyname = $company->dba_business_name != '' ? $company->dba_business_name : $company->company_name;
													$companycity = $company->city;
				                        }
						                            
				                        // $profilePic =  Storage::disk('s3')->exists($service->first_profile_pic()) ? Storage::URL($service->first_profile_pic()) : url('/images/service-nofound.jpg');  
										$profilePic = $service->first_profile_pic();
										if ($profilePic == '') {
												$profilePic = url('/images/service-nofound.jpg');
											}
										$pic_image = explode(',',$service['profile_pic']);
										$cover_photo=$service->getConverPhotoUrl_img();

											if (!empty($cover_photo)) {
												array_unshift($pic_image, $cover_photo);
											}
												$bookscheduler = App\BusinessActivityScheduler::where('serviceid', $service['id'])->orderBy('id', 'ASC')->first();
												$time = @$bookscheduler != '' ? @$bookscheduler->get_duration() : '';
												$price_all = $service->min_price();
				                    ?>
									<div class="item">
										<div class="selectProduct" data-id="{{ $service['id'] }}" data-title="{{ $service['program_name'] }}" data-name="{{ $service['program_name'] }}" data-companyname="{{ $companyname }}" data-email="" data-address="{{ $companyaddress }}" data-img="{{ $profilePic }}" data-price="{{ $pay_price }}" data-token="{{ csrf_token() }}"> 
											<div class="kickboxing-block">
												@if(Auth::check())
													@php
			                                	$loggedId = Auth::user()->id;
			                                	$favData = App\BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$service['id'])->first();                   
                             				@endphp
                             				<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
                             					<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn_per{{$service['id']}}" class="owl-carousel owl-theme">
																@if(is_array($pic_image))
																	@foreach($pic_image as $img)
																		@if(Storage::disk('s3')->exists($img) && $img != '' )
																			<div class="item-inner">
																				<img src="{{Storage::URL($img)}}" class="productImg" alt="Fitnessity" loading="lazy">
																			</div>
																		@else
																			<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																		@endif
																	@endforeach
																@else
																	@if(Storage::disk('s3')->exists($pic_image) && $pic_image != '' )
																		<div class="item-inner">
																			<img src="{{Storage::URL($pic_image)}}" alt="Fitnessity" loading="lazy"> 
																		</div>
																	@else
																		<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																	@endif
																@endif
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
															<span>From {!!$price_all!!}/Person</span>
														@endif
													</div>
                                                    <!-- <div class="p-relative">
                                                        <a class="play-btn-set item-gallery" href="https://www.youtube.com/watch?v=AmZ0WrEaf34" data-fancybox="" data-elementor-open-lightbox="no">
                                                         <source src="https://www.youtube.com/watch?v=AmZ0WrEaf34" type="video/mp4">
                                                            <i class="fas fa-play"></i>
                                                        </a> 
                                                    </div> -->
													@if($service['video']!='')
                                                    <div class="p-relative">
                                                    	<a class="play-btn-set item-gallery" href="{{$service['video']}}" data-fancybox="" data-elementor-open-lightbox="no">
                                                         <source src="{{$service['video']}}" type="video/mp4">
                                                       		<i class="fas fa-play"></i>
                                                        </a>
                                                    </div>
													@endif 
	                                			@else
		                                			<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
																<div class="inner-owl-slider-hire">
																	<div id="owl-demo-learn_per{{$service['id']}}" class="owl-carousel owl-theme">
																		@if(is_array($pic_image))
																			@foreach($pic_image as $img)
																				@if(Storage::disk('s3')->exists($img) && $img != '' )
																					<div class="item-inner">
																						<img src="{{Storage::URL($img)}}" class="productImg" alt="Fitnessity" loading="lazy">
																					</div>
																				@endif
																			@endforeach
																		@else
																			@if(Storage::disk('s3')->exists($pic_image) && $pic_image != '' )
																				<div class="item-inner">
																					<img src="{{Storage::URL($pic_image)}}" alt="Fitnessity" loading="lazy">
																				</div>
																			@endif
																		@endif
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
						                                	<span>From {!!$price_all!!}/Person</span>
						                              @endif
						                            </div>
	                                			@endif
	                                			@php
													$reviews_count = App\BusinessServiceReview::where('service_id', $service['id'])->count();
													$reviews_sum = App\BusinessServiceReview::where('service_id', $service['id'])->sum('rating');
													
													$reviews_avg=  $reviews_count>0 ? round($reviews_sum/$reviews_count,2):0;
												@endphp
												<div class="bottom-content">
													<div class="class-info">
														<div class="row">
															<div class="col-md-7 col-sm-7 col-xs-7 col-7 ratingtime">
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
															<div class="col-md-5 col-sm-5 col-xs-5 col-5 country-instant">
																<div class="activity-city">
																	<span style="white-space: nowrap;">{{$companycity}}</span>
																</div>
															</div>
														</div>
													</div>
													@php
														$redlink = str_replace(" ","-",$companyname);
													@endphp
													<div class="activity-information activites-height">
														<span><a href="{{ route('businessprofiletimeline',['user_name'=>$redlink ,'id'=>$service['cid']])}}" target="_blank">{{ $service['program_name'] }}</a></span>
														<span><a  href="{{ route('businessprofiletimeline',['user_name'=>$redlink ,'id'=>$service['cid']])}}" target="_blank"  class="companyalink">{{$companyname}}</a></span>
														
														<p>{{ $service->formal_service_types() }}  | {{ $service['sport_activity'] }}</p>
													</div>
													<hr>
													<div class="all-details">
														<a class="showall-btn" href="{{route('activities_show',['serviceid'=> $serviceid])}}">Book Now</a>
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
				<div class="nav-sliders-activites activity-z-index ">
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
						            $companyid =  $companyname  =  $serviceid = $companyaddress= "";
										$companycity = $pay_price  = "";
						            if (isset($Ways_To_Workout)) {
						               foreach ($Ways_To_Workout as $loop => $service) {
						                  $company = $price = $businessSp = [];
												$serviceid = $service['id'];
				                        $company = $service->company_information;
		                              if($company != '') {
	                                    $companyaddress = $company->address;
	                                    $companyname = $company->dba_business_name != '' ? $company->dba_business_name : $company->company_name;
													$companycity = $company->city;
	                                 }
			                            
	                                //  $profilePic =  Storage::disk('s3')->exists($service->first_profile_pic()) ? Storage::URL($service->first_profile_pic()) : url('/images/service-nofound.jpg');  
									$profilePic = $service->first_profile_pic();
										if ($profilePic == '') {
											$profilePic = url('/images/service-nofound.jpg');
										}
					                  	$pic_image = explode(',',$service['profile_pic']);
										  $cover_photo=$service->getConverPhotoUrl_img();

											if (!empty($cover_photo)) {
												array_unshift($pic_image, $cover_photo);
											}
												$bookscheduler= '';
												$bookscheduler = App\BusinessActivityScheduler::where('serviceid', $service['id'])->orderBy('id', 'ASC')->first();
												$time = @$bookscheduler != '' ? @$bookscheduler->get_duration() : '';
												$price_all = $service->min_price();
				                    ?>
									<div class="item">
										<div class="selectProduct" data-id="{{ $service['id'] }}" data-title="{{ $service['program_name'] }}" data-name="{{ $service['program_name'] }}" data-companyname="{{ $companyname }}" data-email="" data-address="{{ $companyaddress }}" data-img="{{ $profilePic }}" data-price="{{ $pay_price }}" data-token="{{ csrf_token() }}"> 
											<div class="kickboxing-block">
												@if(Auth::check())
													@php
			                                	$loggedId = Auth::user()->id;
			                                	$favData = App\BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$service['id'])->first();                   
                             				@endphp
	                                		<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
	                                			<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn_classes{{$service['id']}}" class="owl-carousel owl-theme">
																@if(is_array($pic_image))
																	@foreach($pic_image as $img)
																		@if(Storage::disk('s3')->exists($img) && $img != '' )
																			<div class="item-inner"> 
																				<img src="{{Storage::URL($img)}}" class="productImg" alt="Fitnessity" loading="lazy">
																			</div>
																		@else
																			<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																		@endif
																	@endforeach
																@else
																	@if(Storage::disk('s3')->exists($pic_image) && $pic_image != '' )
																		<div class="item-inner">
																			<img src="{{Storage::URL($pic_image)}}" loading="lazy">
																		</div>
																	@else
																		<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																	@endif
																@endif
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
														<span>From {!!$price_all!!}/Person</span>
														@endif
													</div>
                                                    <!-- <div class="p-relative"> 
                                                        <a class="play-btn-set item-gallery" href="https://www.youtube.com/watch?v=AmZ0WrEaf34" data-fancybox="" data-elementor-open-lightbox="no">
                                                         <source src="https://www.youtube.com/watch?v=AmZ0WrEaf34" type="video/mp4">
                                                            <i class="fas fa-play"></i>
                                                        </a> 
                                                    </div> -->
													@if($service['video']!='')
                                                    <div class="p-relative">
                                                    	<a class="play-btn-set item-gallery" href="{{$service['video']}}" data-fancybox="" data-elementor-open-lightbox="no">
                                                         <source src="{{$service['video']}}" type="video/mp4">
                                                       		<i class="fas fa-play"></i>
                                                        </a>
                                                    </div>
													@endif 
                             			@else
                                			<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
														<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn_classes{{$service['id']}}" class="owl-carousel owl-theme">
																@if(is_array($pic_image))
																	@foreach($pic_image as $img)
																		@if(Storage::disk('s3')->exists($img) && $img != '' )
																			<div class="item-inner">
																				<img src="{{Storage::URL($img)}}" class="productImg" alt="Fitnessity" loading="lazy">
																			</div>
																		@else
																			<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																		@endif
																	@endforeach
																@else
																	@if(Storage::disk('s3')->exists($pic_image) && $pic_image != '' )
																		<div class="item-inner">
																			<img src="{{Storage::URL($pic_image)}}" loading="lazy">
																		</div>
																	@else
																		<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																	@endif
																@endif
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
				                                <span>From {!!$price_all!!}/Person</span>
				                                @endif
				                            </div>
                             			@endif
                             			@php
													$reviews_count = App\BusinessServiceReview::where('service_id', $service['id'])->count();
													$reviews_sum = App\BusinessServiceReview::where('service_id', $service['id'])->sum('rating');
													
													$reviews_avg=  $reviews_count>0 ? round($reviews_sum/$reviews_count,2):0;
												@endphp
												<div class="bottom-content">
													<div class="class-info">
														<div class="row">
															<div class="col-md-7 col-sm-7 col-xs-7 col-7 ratingtime">
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
															<div class="col-md-5 col-sm-5 col-xs-5 col-5 country-instant">
																<div class="activity-city">
																	<span style="white-space: nowrap;">{{$companycity}}</span>
																</div>
															</div>
														</div>
													</div>
													@php
														$redlink = str_replace(" ","-",$companyname);
													@endphp
													<div class="activity-information activites-height">
														<span><a href="{{ route('businessprofiletimeline',['user_name'=>$redlink ,'id'=>$service['cid']])}}" target="_blank">{{ $service['program_name'] }}</a></span>
														<span><a  href="{{ route('businessprofiletimeline',['user_name'=>$redlink ,'id'=>$service['cid']])}}" target="_blank"  class="companyalink">{{$companyname}}</a></span>
														
														<p>{{ $service->formal_service_types() }}  | {{ $service['sport_activity'] }}</p>
													</div>
													<hr>
													<div class="all-details">
														<a class="showall-btn" href="{{route('activities_show',['serviceid'=> $serviceid])}}">Book Now</a>
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
				<div class="nav-sliders-activites activity-z-index ">
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
						            $companyid =  $companyname  =  $serviceid = $companyaddress= "";
										$companycity = $pay_price  = "";
						            if (isset($Fun_Activities)) {
						               foreach ($Fun_Activities as $loop => $service) {
						                  $company = $price = $businessSp = [];
												$serviceid = $service['id'];
				                        $company = $service->company_information;
		                              if($company != '') {
	                                    $companyaddress = $company->address;
	                                    $companyname = $company->dba_business_name != '' ? $company->dba_business_name : $company->company_name;
													$companycity = $company->city;
				                        }
						                            
				                        // $profilePic =  Storage::disk('s3')->exists($service->first_profile_pic()) ? Storage::URL($service->first_profile_pic()) : url('/images/service-nofound.jpg');  
										  // Check if the profile picture path is empty
										  $profilePic = $service->first_profile_pic();
										  if($profilePic=='')
										  {
											  $profilePic =  url('/images/service-nofound.jpg');
  
										  }
											
					                  	$pic_image = explode(',',$service['profile_pic']);
										  $cover_photo=$service->getConverPhotoUrl_img();

											if (!empty($cover_photo)) {
													array_unshift($pic_image, $cover_photo);
											}
												$bookscheduler= '';
												$bookscheduler = App\BusinessActivityScheduler::where('serviceid', $service['id'])->orderBy('id', 'ASC')->first();
												$time = @$bookscheduler != '' ? @$bookscheduler->get_duration() : '';
												
												$price_all = $service->min_price();
				                    ?>
									<div class="item">
										<div class="selectProduct" data-id="{{ $service['id'] }}" data-title="{{ $service['program_name'] }}" data-name="{{ $service['program_name'] }}" data-companyname="{{ $companyname }}" data-email="" data-address="{{ $companyaddress }}" data-img="{{ $profilePic }}" data-price="{{ $pay_price }}" data-token="{{ csrf_token() }}"> 
											<div class="kickboxing-block">
												@if(Auth::check())
													@php
			                                	$loggedId = Auth::user()->id;
			                                	$favData = App\BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$service['id'])->first();                   
                             				@endphp
                             				<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
                             					<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn_exp{{$service['id']}}" class="owl-carousel owl-theme">
																@if(is_array($pic_image))
																	@foreach($pic_image as $img)
																		@if(Storage::disk('s3')->exists($img) && $img != '' )
																			<div class="item-inner">
																				<img src="{{Storage::URL($img)}}" class="productImg" alt="Fitnessity" loading="lazy">
																			</div>
																		@else
																			<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																		@endif
																	@endforeach
																@else
																	@if(Storage::disk('s3')->exists($pic_image) && $pic_image != '' )
																		<div class="item-inner">
																			<img src="{{Storage::URL($pic_image)}}" alt="Fitnessity" loading="lazy">
																		</div>
																	@else
																		<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																	@endif
																@endif
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
															<span>From {!!$price_all!!}/Person</span>
														@endif
													</div>
                                                   <!-- <div class="p-relative">
                                                        <a class="play-btn-set item-gallery" href="https://www.youtube.com/watch?v=AmZ0WrEaf34" data-fancybox="" data-elementor-open-lightbox="no">
                                                         <source src="https://www.youtube.com/watch?v=AmZ0WrEaf34" type="video/mp4">
                                                            <i class="fas fa-play"></i>
                                                        </a> 
                                                    </div> -->
													@if($service['video']!='')
                                                    <div class="p-relative">
                                                    	<a class="play-btn-set item-gallery" href="{{$service['video']}}" data-fancybox="" data-elementor-open-lightbox="no">
                                                         <source src="{{$service['video']}}" type="video/mp4">
                                                       		<i class="fas fa-play"></i>
                                                        </a>
                                                    </div>
													@endif 
                             			@else
                                			<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
														<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn_exp{{$service['id']}}" class="owl-carousel owl-theme">
																@if(is_array($pic_image))
																	@foreach($pic_image as $img)
																		@if(Storage::disk('s3')->exists($img) && $img != '' )
																			<div class="item-inner">
																				<img src="{{Storage::URL($img)}}" class="productImg" alt="Fitnessity" loading="lazy"> 
																			</div>
																		@else
																			<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																		@endif
																	@endforeach
																@else
																	@if(Storage::disk('s3')->exists($pic_image) && $pic_image != '' )
																		<div class="item-inner">
																			<img src="{{Storage::URL($pic_image)}}" loading="lazy">
																		</div>
																	@else
																		<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																	@endif
																@endif
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
				                                <span>From {!!$price_all!!}/Person</span>
				                                @endif
				                            </div>
                             			@endif
                             			@php
													$reviews_count = App\BusinessServiceReview::where('service_id', $service['id'])->count();
													$reviews_sum = App\BusinessServiceReview::where('service_id', $service['id'])->sum('rating');
													
													$reviews_avg=  $reviews_count>0 ? round($reviews_sum/$reviews_count,2):0;
												@endphp
												<div class="bottom-content">
													<div class="class-info">
														<div class="row">
															<div class="col-md-7 col-sm-7 col-xs-7 col-7 ratingtime">
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
															<div class="col-md-5 col-sm-5 col-xs-5 col-5 country-instant">
																<div class="activity-city">
																	<span style="white-space: nowrap;">{{$companycity}}</span>
																</div>
															</div>
														</div>
													</div>
													@php
														$redlink = str_replace(" ","-",$companyname);
													@endphp
													<div class="activity-information activites-height">
														<span><a  href="{{ route('businessprofiletimeline',['user_name'=>$redlink ,'id'=>$service['cid']])}}" target="_blank">{{ $service['program_name'] }}</a></span>
														<span><a  href="{{ route('businessprofiletimeline',['user_name'=>$redlink ,'id'=>$service['cid']])}}"  target="_blank"  class="companyalink">{{$companyname}}</a></span>
														
														<p>{{ $service->formal_service_types() }}  | {{ $service['sport_activity'] }}</p>
													</div>
													<hr>
													<div class="all-details">
														<a class="showall-btn" href="{{route('activities_show',['serviceid'=>  $serviceid])}}">Book Now</a>
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
				<div class="nav-sliders-activites activity-z-index ">
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
						            $companyid =  $companyname  =  $serviceid = $companyaddress= "";
										$companycity = $pay_price  = "";
						            if (isset($events_activity)) {
						               foreach ($events_activity as $loop => $service) {
						                  $company = $price = $businessSp = [];
												$serviceid = $service['id'];
				                        $company = $service->company_information;
		                               if($company != '') {
	                                    $companyaddress = $company->address;
	                                    $companyname = $company->dba_business_name != '' ? $company->dba_business_name : $company->company_name;
													$companycity = $company->city;
	                                 }
			                            
	                                //  $profilePic =  Storage::disk('s3')->exists($service->first_profile_pic()) ? Storage::URL($service->first_profile_pic()) : url('/images/service-nofound.jpg');  
									$profilePic = $service->first_profile_pic();
									if($profilePic=='')
									{
										$profilePic =  url('/images/service-nofound.jpg');

									}
									  
									$pic_image = explode(',',$service['profile_pic']);
										$cover_photo=$service->getConverPhotoUrl_img();

										if (!empty($cover_photo)) {
											array_unshift($pic_image, $cover_photo);
										}
												$bookscheduler= '';
												$bookscheduler = App\BusinessActivityScheduler::where('serviceid', $service['id'])->orderBy('id', 'ASC')->first();
												$time = @$bookscheduler != '' ? @$bookscheduler->get_duration() : '';
												$price_all = $service->min_price();
			                    	?>
									<div class="item">
										<div class="selectProduct" data-id="{{ $service['id'] }}" data-title="{{ $service['program_name'] }}" data-name="{{ $service['program_name'] }}" data-companyname="{{ $companyname }}" data-email="" data-address="{{ $companyaddress }}" data-img="{{ $profilePic }}" data-price="{{ $pay_price }}" data-token="{{ csrf_token() }}"> 
											<div class="kickboxing-block">
												@if(Auth::check())
													@php
			                                	$loggedId = Auth::user()->id;
			                                	$favData = App\BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$service['id'])->first();                   
                             				@endphp
                             				<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
														<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn_event{{$service['id']}}" class="owl-carousel owl-theme">
																@if(is_array($pic_image))
																	@foreach($pic_image as $img)
																		@if(Storage::disk('s3')->exists($img) && $img != '' )
																			<div class="item-inner">
																				<img src="{{Storage::URL($img)}}" class="productImg" alt="Fitnessity" loading="lazy">
																			</div>
																		@else
																			<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																		@endif
																	@endforeach
																@else
																	@if(Storage::disk('s3')->exists($pic_image) && $pic_image != '' )
																		<div class="item-inner">
																			<img src="{{Storage::URL($pic_image)}}" loading="lazy">
																		</div>
																	@else
																		<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																	@endif
																@endif
															</div>
														</div>
														<script type="text/javascript">
															$(document).ready(function() {
															  	$("#owl-demo-learn_event{{$service['id']}}").owlCarousel({
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
															<span>From {!!$price_all!!}/Person</span>
														@endif
													</div>
                                                     <!-- <div class="p-relative">
                                                        <a class="play-btn-set item-gallery" href="https://www.youtube.com/watch?v=AmZ0WrEaf34" data-fancybox="" data-elementor-open-lightbox="no">
                                                         <source src="https://www.youtube.com/watch?v=AmZ0WrEaf34" type="video/mp4">
                                                            <i class="fas fa-play"></i>
                                                        </a> 
                                                    </div> -->
													@if($service['video']!='')
                                                    <div class="p-relative">
                                                    	<a class="play-btn-set item-gallery" href="{{$service['video']}}" data-fancybox="" data-elementor-open-lightbox="no">
                                                         <source src="{{$service['video']}}" type="video/mp4">
                                                       		<i class="fas fa-play"></i>
                                                        </a>
                                                    </div>
													@endif 
                             			@else
                                			<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
														<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn_event{{$service['id']}}" class="owl-carousel owl-theme">
																@if(is_array($pic_image))
																	@foreach($pic_image as $img)
																		@if(Storage::disk('s3')->exists($img) && $img != '' )
																			<div class="item-inner">
																				<img src="{{Storage::URL($img)}}" class="productImg" alt="Fitnessity" loading="lazy">
																			</div>
																		@else
																			<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																		@endif
																	@endforeach
																@else
																	@if(Storage::disk('s3')->exists($pic_image) && $pic_image != '' )
																		<div class="item-inner">
																			<img src="{{Storage::URL($pic_image)}}" alt="Fitnessity" loading="lazy">
																		</div>
																	@else
																		<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																	@endif
																@endif
															</div>
														</div>
														<script type="text/javascript">
															$(document).ready(function() {
															  	$("#owl-demo-learn_event{{$service['id']}}").owlCarousel({
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
			                                		<span>From {!!$price_all!!}/Person</span>
			                                	@endif
				                           </div>
                             			@endif
                             			@php
													$reviews_count = App\BusinessServiceReview::where('service_id', $service['id'])->count();
													$reviews_sum = App\BusinessServiceReview::where('service_id', $service['id'])->sum('rating');
													
													$reviews_avg=  $reviews_count>0 ? round($reviews_sum/$reviews_count,2):0;
												@endphp
												<div class="bottom-content">
													<div class="class-info">
														<div class="row">
															<div class="col-md-7 col-sm-7 col-xs-7 col-7 ratingtime">
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
															<div class="col-md-5 col-sm-5 col-xs-5 col-5 country-instant">
																<div class="activity-city">
																	<span style="white-space: nowrap;">{{$companycity}}</span>
																</div>
															</div>
														</div>
													</div>
													@php
														$redlink = str_replace(" ","-",$companyname);
													@endphp
													<div class="activity-information activites-height">
														<span><a href="{{ route('businessprofiletimeline',['user_name'=>$redlink ,'id'=>$service['cid']])}}" target="_blank">{{ $service['program_name'] }}</a></span>
														<span><a  href="{{ route('businessprofiletimeline',['user_name'=>$redlink ,'id'=>$service['cid']])}}" target="_blank"  class="companyalink">{{$companyname}}</a></span>
														
														<p>{{ $service->formal_service_types() }}  | {{ $service['sport_activity'] }}</p>
													</div>
													<hr>
													<div class="all-details">
														<a class="showall-btn" href="{{route('activities_show',['serviceid'=>  $serviceid])}}">Book Now</a>
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
				<div class="nav-sliders-activites activity-z-index ">
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
					            	$companyid =  $companyname  =  $serviceid = $companyaddress= "";
										$companycity = $pay_price  = "";
					               if (isset($allactivities) && count($allactivities) > 0) {
					                  $profilePic1 = $pic_image = '';
					                  foreach ($allactivities as $loop => $service) {
					                     $company = $price = $businessSp = [];
												$serviceid = $service['id'];
				                        $company = $service->company_information;
	                                 if($company != '') {
	                                    $companyaddress = $company->address;
	                                    $companyname = $company->dba_business_name != '' ? $company->dba_business_name : $company->company_name;
													$companycity = $company->city;
			                           }
					                            
			                        //    $profilePic =  Storage::disk('s3')->exists($service->first_profile_pic()) ? Storage::URL($service->first_profile_pic()) : url('/images/service-nofound.jpg');
									$profilePic = $service->first_profile_pic();
										  if($profilePic=='')
										  {
											  $profilePic =  url('/images/service-nofound.jpg');
  
										  }
											  
					                  	$pic_image = explode(',',$service['profile_pic']);
										  $cover_photo=$service->getConverPhotoUrl_img();

											if (!empty($cover_photo)) {
												array_unshift($pic_image, $cover_photo);
											}
												$bookscheduler = App\BusinessActivityScheduler::where('serviceid', $service['id'])->orderBy('id', 'ASC')->first();
												$time = @$bookscheduler != '' ? @$bookscheduler->get_duration() : '';
												$price_all = $service->min_price();
			                    ?>
									<div class="item">
										<div class="selectProduct" data-id="{{ $service['id'] }}" data-title="{{ $service['program_name'] }}" data-name="{{ $service['program_name'] }}" data-companyname="{{ $companyname }}" data-email="" data-address="{{ $companyaddress }}" data-img="{{ $profilePic }}" data-price="{{ $pay_price }}" data-token="{{ csrf_token() }}"> 
											<div class="kickboxing-block">
												@if(Auth::check())
													@php
			                                	$loggedId = Auth::user()->id;
			                                	$favData = App\BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$service['id'])->first();                   
                             				@endphp
	                                		<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
	                                			<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn{{$service['id']}}" class="owl-carousel owl-theme">
																@if(is_array($pic_image))
																	@foreach($pic_image as $img)
																		@if(Storage::disk('s3')->exists($img) && $img != '' )
																			<div class="item-inner">
																				<img src="{{Storage::URL($img)}}" class="productImg" alt="Fitnessity" loading="lazy">
																			</div>
																		@else
																			<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																		@endif
																	@endforeach
																@else
																	@if(Storage::disk('s3')->exists($pic_image) && $pic_image != '' )
																		<div class="item-inner">
																			<img src="{{Storage::URL($pic_image)}}" alt="Fitnessity" loading="lazy">
																		</div>
																	@else
																		<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																	@endif
																@endif
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
															<span>From {!!$price_all!!}/Person</span>
														@endif
													</div>
                                                     <!-- <div class="p-relative">
                                                        <a class="play-btn-set item-gallery" href="https://www.youtube.com/watch?v=AmZ0WrEaf34" data-fancybox="" data-elementor-open-lightbox="no">
                                                         <source src="https://www.youtube.com/watch?v=AmZ0WrEaf34" type="video/mp4">
                                                            <i class="fas fa-play"></i>
                                                        </a> 
                                                    </div> -->
													@if($service['video']!='')
                                                    <div class="p-relative">
                                                    	<a class="play-btn-set item-gallery" href="{{$service['video']}}" data-fancybox="" data-elementor-open-lightbox="no">
                                                         <source src="{{$service['video']}}" type="video/mp4">
                                                       		<i class="fas fa-play"></i>
                                                        </a>
                                                    </div>
													@endif 
                             			@else
                                			<div class="kickboxing-topimg-content" ser_id="{{$service['id']}}" >
														<div class="inner-owl-slider-hire">
															<div id="owl-demo-learn{{$service['id']}}" class="owl-carousel owl-theme">
																@if(is_array($pic_image))
																	@foreach($pic_image as $img)
																		@if(Storage::disk('s3')->exists($img) && $img != '' )
																			<div class="item-inner">
																				<img src="{{Storage::URL($img)}}" class="productImg" alt="Fitnessity" loading="lazy">
																			</div>
																		@else
																			<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																		@endif
																	@endforeach
																@else
																	@if(Storage::disk('s3')->exists($pic_image) && $pic_image != '' )
																		<div class="item-inner">
																			<img src="{{Storage::URL($pic_image)}}" alt="Fitnessity" loading="lazy">
																		</div>
																	@else
																		<img src="{{url('/images/service-nofound.jpg')}}" class="productImg" alt="Fitnessity" loading="lazy">
																	@endif
																@endif
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
			                                		<span>From {!!$price_all!!}/Person</span>
			                                	@endif
				                           </div>
                             			@endif
                             			@php
													$reviews_count = App\BusinessServiceReview::where('service_id', $service['id'])->count();
													$reviews_sum = App\BusinessServiceReview::where('service_id', $service['id'])->sum('rating');
													
													$reviews_avg=  $reviews_count>0 ? round($reviews_sum/$reviews_count,2):0;
												@endphp
												<div class="bottom-content">
													<div class="class-info">
														<div class="row">
															<div class="col-md-7 col-sm-7 col-xs-7 col-7 ratingtime">
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
															<div class="col-md-5 col-sm-5 col-xs-5 col-5 country-instant">
																<div class="activity-city">
																	<span style="white-space: nowrap;">{{$companycity}}</span>
																</div>
															</div>
														</div>
													</div>
													@php
														$redlink = str_replace(" ","-",$companyname);
													@endphp
													<div class="activity-information activites-height">
														<span><a  href="{{ route('businessprofiletimeline',['user_name'=>$redlink ,'id'=>$service['cid']])}}" target="_blank">{{ $service['program_name'] }}</a></span>
														
														<span><a  href="{{ route('businessprofiletimeline',['user_name'=>$redlink ,'id'=>$service['cid']])}}" target="_blank"  class="companyalink">{{$companyname}}</a></span>
														
														<p>{{ $service->formal_service_types() }}  | {{ $service['sport_activity'] }}</p>
													</div>
													<hr>
													<div class="all-details">
														<a class="showall-btn" href="{{route('activities_show',['serviceid'=>  $serviceid])}}">Book Now</a>
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
			<div class="col-lg-6 col-md-9 col-xs-12">
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
								<a href="#" class="showall-btn" data-bs-toggle="modal" data-bs-target="#addbusiness">Add A Business</a>
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
                    <span title="Close" class="closeItems" style="float:right; padding-right:15px; cursor: pointer;color:#98002e">
                    <i class="fas fa-times-circle"></i> </span>
                </h4>                            
            </div>
        </div>
        <div class=" titleMargin w3-container comparePan">
            <button type="button" class="btn btn-red notActive cmprBtn addtcmpr-btn" data-bs-toggle="modal" data-bs-target="#myModal">Compare</button>
        </div>
    </div>
</div>

<!--end of preview panel-->
<!-- The Modal Add Business-->
<div class="modal fade compare-model" id="addbusiness" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg business">
        <div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
			<div class="modal-header" style="text-align: right; display: block;">
			  <button class="clear_compare_list" type="button" style="color: white; border-color: #98002e; background-color: #98002e; margin-top: -5px;" data-dismiss="modal">×</button>
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
	<div class="modal-dialog modal-lg">
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

<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/Compare.js"></script>
<!-- <script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/jquery-1.9.1.min.js"></script> -->
<!-- <script src="{{ url('public/js/jquery-ui.multidatespicker.js') }}"></script>
<script src="{{ url('public/js/jquery-ui.min.js') }}"></script> -->
<!-- <script type="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.min.js"></script>

@include('layouts.business.footer')
	
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

<script>
var windowwidth = $(window).width();
if( windowwidth < 600 ){
	jQuery(document).ready(function(){
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
			  items: 1.2,
			  /*autoWidth: true,
			  loop: false*/
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
	});
}
else
{
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
			  items: 1,
			  autoWidth: true,
			  loop: false
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
}
if( windowwidth < 600 ){
	jQuery(document).ready(function(){
		jQuery("#popular-activities").owlCarousel({
		  autoplay: false,
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
			  items: 1.2,
			 /* autoWidth: true,
			  loop: false*/
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
	});
}
else {
	jQuery("#popular-activities").owlCarousel({
		  autoplay: false,
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
			  items: 1,
			  autoWidth: true,
			  loop: false
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
}


if( windowwidth < 600 ){
	jQuery(document).ready(function(){
		jQuery("#inarea-activities").owlCarousel({
		  autoplay: false,
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
			  items: 1.2,
			  /*autoWidth: true,
			  loop: false*/
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
	});
}
else {
	jQuery("#inarea-activities").owlCarousel({
		  autoplay: false,
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
			  items: 1,
			  autoWidth: true,
			  loop: false
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
}

if( windowwidth < 600 ){
	jQuery(document).ready(function(){
		jQuery("#find-trainers").owlCarousel({
		  autoplay: false,
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
			  items: 1.2,
			  /*autoWidth: true,
			  loop: false*/
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
	});
}
else {
	jQuery("#find-trainers").owlCarousel({
		  autoplay: false,
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
			  items: 1,
			  autoWidth: true,
			  loop: false
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
}
if( windowwidth < 600 ){
	jQuery(document).ready(function(){
		jQuery("#ways-to-workout").owlCarousel({
		  autoplay: false,
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
			  items: 1.2,
			  /*autoWidth: true,
			  loop: false*/
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
	 });
}else{
	jQuery("#ways-to-workout").owlCarousel({
		  autoplay: false,
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
			  items: 1,
			  autoWidth: true,
			  loop: false
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
}
if( windowwidth < 600 ){
	jQuery(document).ready(function(){
		jQuery("#all-activities").owlCarousel({
		  autoplay: false,
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
			  items: 1.2,
			  /*autoWidth: true,
			  loop: false*/
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
	});
}
else
{
	jQuery("#all-activities").owlCarousel({
		  autoplay: false,
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
			  items: 1,
			  autoWidth: true,
			  loop: false
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
}
if( windowwidth < 600 ){
	jQuery(document).ready(function(){
		jQuery("#trainers-coaches").owlCarousel({
		  autoplay: false,
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
			  items: 1.2,
			  /*autoWidth: true,
			  loop: false*/
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
	}); 
}
else
{
	jQuery("#trainers-coaches").owlCarousel({
		  autoplay: false,
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
			  items: 1,
			  autoWidth: true,
			  loop: false
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
}

$(document).ready(function() {
 
  $("#owl-demo-owl").owlCarousel({
    navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
    items : 1, 
    loop:true,
    nav:true,
    dots: false,
  });
 
});
$(".mobile-slider").owlCarousel({
	loop: false,
	autoWidth: true,
	autoplay: false,
	autoplayTimeout: 2000, //2000ms = 2s;
	autoplayHoverPause: true,
	responsiveClass: true,
	responsive: {
			0: {
			  items: 1
			},

			600: {
			  items: 2
			},

			1024: {
			  items: 2
			},
			
			1200: {
			  items: 3
			},
			
			1366: {
			  items: 5
			},
		  },
});
	
$(".find-activity-owl").owlCarousel({
	loop: false,
	autoWidth: true,
	autoplay: false,
	margin: 10,
	autoplayTimeout: 2000, //2000ms = 2s;
	autoplayHoverPause: true,
	responsiveClass: true,
	responsive: {
			0: {
			  items: 1
			},

			600: {
			  items: 2
			},

			1024: {
			  items: 2
			},
			
			1200: {
			  items: 3
			},
			
			1366: {
			  items: 5
			},
		  },
		
});
</script>

@endsection