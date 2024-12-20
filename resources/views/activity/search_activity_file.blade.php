<div class="otherslider owl-carousel mb-45">
	@forelse($activitiesSearch as $sService) 
		@php
			$bookscheduler = App\BusinessActivityScheduler::where('serviceid', $sService->id)->orderBy('id', 'ASC')->first();
			$time = @$bookscheduler != '' ? @$bookscheduler->get_duration() : '';
		@endphp
		<div class="other-activity-card-info">
			<div class="container">
				<div class="row">
					<!-- <div class="find-activity"> -->
					<div class="col-lg-auto">
						<div class="p-relative like-heart mt-25">
							<div class="other-activity-imgs">
								{{-- <img src="https://fitnessity-production.s3.amazonaws.com/activity/5gmokEA2e4XKU4TSPDErZfFKJyYImLAVbVwXQHlk.jpg" alt="Omnebook"> --}}
								<img src="{{$sService->first_profile_pic()}}" alt="Omnebook">
							</div>
							<div class="wegites-like">
									@if(Auth::check())
											<div class="serv_fav1" ser_id="{{$sService->id}}">
												<a class="fav-fun-2" id="serfav{{$sService->id}}">
													<i class="{{ !empty(getFavorite(Auth::user()->id, $sService->id)) ? 'fas' : 'far' }} fa-heart"></i>
												</a>
											</div>
										@else
											<a class="fav-fun-2" href="{{ Config::get('constants.SITE_URL') }}/userlogin" ><i class="far fa-heart"></i></a>
										@endif
								<span>From  {!!$sService->min_price()!!}/Person</span>
							</div>
							<div class="">
								<div class="row y-middle">
									<div class="col-lg-6">
										<div class="activity-inner-data">
											<i class="fas fa-star"></i>
											{{-- <span>5 (1)</span> --}}
											{{$sService->reviews_score()}} ({{$sService->reviews()->count()}})  
										</div>
										@if($time != '')
										<div class="activity-hours">
											{{-- <span>45 Min</span> --}}
												<span>{{$time}}</span>
											</div>
											@endif
									</div>
									<div class="col-lg-6">
										<div class="activity-city">
											{{-- <span class="break-word">New York</span> --}}
											<span class="break-word">{{$sService->company_information->city}}, {{$sService->company_information->country}}</span>
											@if(Auth::check())
											<div class="serv_fav1" ser_id="{{$sService->id}}">
												<a class="fav-fun-2" id="serfav{{$sService->id}}">
													{{-- <i class="{{ !empty(getFavorite(Auth::user()->id, $sService->id)) ? 'fas' : 'far' }} fa-heart"></i> --}}
												</a>
											</div>
										@else
											<a class="fav-fun-2" href="{{ Config::get('constants.SITE_URL') }}/userlogin" ><i class="far fa-heart"></i></a>
										@endif
										</div>
									</div>
									<div class="col-lg-12">
										<div class="activity-information">
											@if(Auth::check())
											<span> <a href="{{ Config::get('constants.SITE_URL') }}/businessprofile/{{  str_replace(' ','-',$sService->company_information->company_name).'/'.$sService->cid }}" target="_blank"> {{ $sService->program_name }}</a></span>
											@else
											<span> <a href="{{ Config::get('constants.SITE_URL') }}/userlogin" target="_blank"> {{ $sService->program_name }}</a></span>
											@endif
											{{-- <span> <a href="/businessprofile/Fitness-Pvt.-Ltd./68" target="_blank"> Hocky Class On Fire</a></span> --}}
											<p>{{ $sService->formal_service_types() }} | {{ $sService->sport_activity }}</p>
											<div class="mt-15 mb-15">
												{{-- <a class="showall-btn" href="http://dev.fitnessity.co/activity-details/160">Book Now</a> --}}
												<a class="btn btn-red" href="{{route('activities_show',['serviceid'=>  $sService->id])}}">Book Now</a>
											</div>
											{{-- @if($sService->min_price() != '')
											<div>
												<span class="activity-time">From {!!$sService->min_price()!!}/Person</span>
											</div>
											@endif --}}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- <div class="row y-middle">
						<div class="col-md-5 col-sm-5 col-xs-12">
							<div class="img-modal-left customer-details other-activity-slider">
								<img src="{{$sService->first_profile_pic()}}" alt="Fitnessity">
							</div>
						</div>
						<div class="col-md-7 col-sm-7 col-xs-12 activity-data">
							<div class="row">
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="activity-inner-data">
										<i class="fas fa-star"></i>
										<span> {{$sService->reviews_score()}} ({{$sService->reviews()->count()}})  </span>
									</div>
									@if($time != '')
										<div class="activity-hours">
											<span>{{$time}}</span>
										</div>
									@endif
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6">
									<div class="activity-city">
										<span>{{$sService->company_information->city}}, {{$sService->company_information->country}}</span>
										@if(Auth::check())
											<div class="serv_fav1" ser_id="{{$sService->id}}">
												<a class="fav-fun-2" id="serfav{{$sService->id}}">
													<i class="{{ !empty(getFavorite(Auth::user()->id, $sService->id)) ? 'fas' : 'far' }} fa-heart"></i>
												</a>
											</div>
										@else
											<a class="fav-fun-2" href="{{ Config::get('constants.SITE_URL') }}/userlogin" ><i class="far fa-heart"></i></a>
										@endif
									</div>
								</div>
							</div>
							<div class="activity-information">
								@if(Auth::check())
									<span> <a href="{{ Config::get('constants.SITE_URL') }}/businessprofile/{{  str_replace(' ','-',$sService->company_information->company_name).'/'.$sService->cid }}" target="_blank"> {{ $sService->program_name }}</a></span>
									@else
									<span> <a href="{{ Config::get('constants.SITE_URL') }}/userlogin" target="_blank"> {{ $sService->program_name }}</a></span>
									@endif
									
								<p>{{ $sService->formal_service_types() }} | {{ $sService->sport_activity }}</p>
								<a class="showall-btn" href="{{route('activities_show',['serviceid'=>  $sService->id])}}">Book Now</a>
							</div>
							@if($sService->min_price() != '')
								<div>
									<span class="activity-time">From {!!$sService->min_price()!!}/Person</span>
								</div>
							@endif
						</div>
					</div> -->
				</div>
			</div>
		</div>
	@empty	
		<div class="container">	
			<div class="row">
				<div class="col-md-6">
					<p class="noactivity"> There Is No Activity</p>
				</div>	
			</div>
		</div>
	@endforelse
</div>