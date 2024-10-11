<div class="fst-0 fsb-1">
	<div class="row">
		<div class="col-md-10">
			<div class="title">
				<h3>Find Activities Starting In The Next 8 Hrs for <?php echo date('l').', '.date('F d, Y', time()); ?></h3>
			</div>
		</div>
		<div class="col-md-2"> 
			<div class="title-show">
				<a href="{{route('activities_next_8_hours')}}">Show All</a>
			</div>
		</div>
		@foreach ($bookschedulers as $bookscheduler)
			@php 	$price_all = $bookscheduler->business_service->min_price(); @endphp
			<div class="col-lg-3 col-md-4 col-sm-6">
				<div class="find-activity">
					<div class="">
						<div class="col-lg-12 col-md-12 col-sm-12" style="overflow: hidden;">
							<div class="p-relative like-heart">
								<div class="item-inner">
									<img alt="Fitnessity" class="personal-find-activity" style="" src="{{ Storage::disk('s3')->exists($bookscheduler->business_service->first_profile_pic()) ? Storage::URL($bookscheduler->business_service->first_profile_pic()) : url('/images/service-nofound.jpg') }}" >
								</div>
								<div class="wegites-like">
									<div class="serv_fav1" ser_id="5" data-id="serfavstarts">
										<a class="fav-fun-2" id="serfavstarts5">
											<!-- <i class="far fa-heart"></i> -->
											<i class="far fa-heart"></i>
										</a>
									</div>
									<!-- <span>From   <strike> $510</strike> $459/Person</span> -->
									<span>From  {!!$price_all!!}</span>
								</div>
							</div>
							
						</div>
						<div class="col-lg-12 col-md-12 col-sm-12 activity-data">
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
							<div class="activity-information line-25">
								<span><a href="{{route('show_businessprofile', ['user_name' => $bookscheduler->company_information->dba_business_name, 'id' => $bookscheduler->company_information->id])}}" target="_blank">{{$bookscheduler->business_service->program_name}}</a></span>
								<p>{{$bookscheduler->business_service->formal_service_types()}} | {{$bookscheduler->business_service->sport_activity}}</p>
								<a c class="showall-btn" href="{{route('activities_show', ['serviceid' => $bookscheduler->business_service->id])}}">Book Now</a>
							</div>
							<div class="row">
								<!-- <div class="col-md-6 col-sm-6 col-xs-6">
									<div class="dollar-person">
										@if($price_all != '')
											<span>From {!!$price_all!!}/Person</span>
										@endif
									</div>
								</div> -->
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="activity-time-main text-center <?php echo ($bookscheduler->is_start_in_one_hour($current_date)) ? 'activity-time-main-red' : ''?>">
										<span>Starts in 
											@if ($bookscheduler->time_left($current_date)->h)
												{{$bookscheduler->time_left($current_date)->h}} {{Str::plural('hour', $bookscheduler->time_left($current_date)->h)}}
											@endif
											@if ($bookscheduler->time_left($current_date)->i)
												{{$bookscheduler->time_left($current_date)->i}} {{Str::plural('minute', $bookscheduler->time_left($current_date)->i)}}
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