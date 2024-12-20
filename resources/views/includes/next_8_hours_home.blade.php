<?php
	$start_date = date('Y/m/d');  
	$date = strtotime($start_date);
	$date = strtotime("+8 hours", $date);
?>

@if(count($bookschedulers) > 0)
	<div class="home-black-section">
        <label>EXPLORE RESERVE YOUR SPOT IN  AN ACTIVITY <br> HAPPENING IN THE NEXT 8 HRS</label>
        <i class="fa fa-caret-down"></i>
    </div>
    <div class="fsth-0 fsbh-1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 col-md-10">
                    <div class="title">
                        <h3 class="f-16">Find Activities Starting In The Next 8 Hrs for {{date('l, F d, Y' ,$date)}}</h3>
                    </div>
                </div>

				<div class="col-md-2 col-xs-12"> 
					<div class="title-show">
						<a href="{{route('activities_next_8_hours')}}">Show All</a>
					</div>
				</div>

				@foreach($bookschedulers as $bookscheduler)
                @php $price_all = $bookscheduler->business_service->min_price(); @endphp
				<div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="find-activity">
                        <div class="row y-middle">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-4">
                                {{-- <img src="{{ Storage::url($bookscheduler->business_service->first_profile_pic())}}"> --}}
                                <img src="{{ $bookscheduler->business_service->first_profile_pic()}}" alt="fitness">
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-8 activity-data">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
                                        <div class="activity-inner-data">
                                            <i class="fas fa-star"></i>
                                            <span> {{$bookscheduler->business_service->reviews_score()}} ({{$bookscheduler->business_service->reviews->count()}}) </span>
                                        </div>

                                        <div class="activity-hours">
                                            <span>{{$bookscheduler->get_duration_hours()}}</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6">
                                        <div class="activity-city">
                                            <span style="white-space: nowrap;">{{$bookscheduler->company_information->city}}</span>
                                            @auth
												<div class="serv_fav1" ser_id="{{$bookscheduler->business_service->id}}" data-id="serfavstarts">
													<a class="fav-fun-2" id="serfavstarts{{$bookscheduler->business_service->id}}">
														<i class="{{ $bookscheduler->business_service->is_liked_by(Auth::id()) ? 'fas' : 'far'}}fa-heart"></i>
													</a>
												</div>
											@endauth
											@guest
												<a class="fav-fun-2" href="{{ route('userlogin')}}" ><i class="far fa-heart"></i></a>
											@endguest
                                        </div>
                                    </div>
                                </div>
                                <div class="activity-information ">
                                    <span>
                                        <a href="{{route('show_businessprofile', ['user_name' => $bookscheduler->company_information->public_company_name, 'id' => $bookscheduler->company_information->id])}}" target="_blank">{{$bookscheduler->business_service->program_name}}</a>
                                    </span>
                                    <p>{{$bookscheduler->business_service->formal_service_types()}} | {{$bookscheduler->business_service->sport_activity}}</p>
                                    <a class="showall-btn" href="{{route('activities_show', ['serviceid' => $bookscheduler->business_service->id])}}">Book Now</a>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6 activites-price-details">
                                        <div class="dollar-person">
                                            @if($price_all != '')
                                                <span>From {!!$price_all!!}/Person</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-6 activites-price-details-left">
                                        <div class="activity-time-main {{ $bookscheduler->is_start_in_one_hour($current_date) ? 'activity-time-main-red' : ''}}">
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
	</div>
@endif

