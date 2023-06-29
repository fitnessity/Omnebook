<style>
	.section.instant-hire{
		margin-top: 70px;
	}
</style>
<div class="col-md-4 col-sm-4 col-map-show limitload">
	<div class="selectProduct" data-id="{{ $activity->id }}" data-title="{{ $activity->program_name }}" data-name="{{ $activity->program_name }}" data-companyname="{{ $activity->company_information->dba_business_name }}" data-email="" data-address="{{ $activity->company_information->dba_business_name }}" data-img="{{ Storage::disk('s3')->exists($activity->first_profile_pic()) ? Storage::URL($activity->first_profile_pic()) : url('/images/service-nofound.jpg') }}" data-token="{{ csrf_token() }}"> 
		<div class="kickboxing-block">
			<div class="kickboxing-topimg-content" ser_id="{{$activity->id}}" >
				<div class="inner-owl-slider-hire">
					<div id="owl-demo-learn{{$activity->id}}" class="owl-carousel owl-theme">
						@foreach ($activity->profile_pictures() as $picture)
							@if(Storage::disk('s3')->exists($picture) && $picture != '' )
								<div class="item-inner">
									<img src="{{Storage::URL($picture)}}" class="productImg">
								</div>
							@else
								<img src="{{url('/images/service-nofound.jpg')}}" class="productImg">
							@endif
						@endforeach
					</div>
				</div>
				<script type="text/javascript">
					$(document).ready(function() {
					  	$("#owl-demo-learn{{$activity->id}}").owlCarousel({
						   navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
						   items : 1, 
						   loop:true,
						   nav:true,
						   dots: false,
					  	});
					});
				</script>
				@auth
					<div class="serv_fav1" ser_id="{{$activity->id}}" data-id="serfavstarts">
						<a class="fav-fun-2" id="serfavstarts{{$activity->id}}">
							<i class="<?php echo ($activity->is_liked_by(Auth::id())) ? 'fas' : 'far' ?> fa-heart"></i>
						</a>
					</div>
				@endauth
				@guest
					<a class="fav-fun-2" href="{{ route('userlogin')}}" ><i class="far fa-heart"></i></a>
				@endguest
				@if ($activity->schedulers->first())
					<span>From ${{$activity->schedulers->first()->price_detail()}}/Person</span>
				@endif
			</div>
			
			<div class="bottom-content">
				<div class="class-info">
					<div class="row">
						<div class="col-md-7 col-xs-7 ratingtime">
							<div class="activity-inner-data">
								<i class="fas fa-star"></i>
								<span>{{$activity->reviews_score()}} ({{$activity->reviews->count()}})</span>
							</div>
							@if ($activity->schedulers->first())

								<div class="activity-hours">
									<span>{{$activity->schedulers->first()->get_duration_hours()}}</span>
								</div>
							@endif
						</div>
						<div class="col-md-5 col-xs-5 country-instant">
							<div class="activity-city">
								<span>{{$activity->company_information->city}}</span>
							</div>
						</div>
					</div>
				</div>
				<div class="activity-information activites-height">
					<span><a href="{{route('show_businessprofile', ['user_name' => $activity->company_information->dba_business_name, 'id' => $activity->company_information->id])}}" target="_blank">{{$activity->program_name}}</a>
					</span>
					<p>{{ $activity->formal_service_types() }}  | {{$activity->sport_activity}}</p>
				</div>
				<hr>
				<div class="all-details">
					<!-- <a class="showall-btn" data-toggle="modal" data-target="#mykickboxing3">Book Now</a> -->
					<a class="showall-btn" href="{{route('activities_show', ['serviceid' => $activity->id])}}">Book Now</a>
					<p class="addToCompare" id='compid{{$activity->id}}' title="Add to Compare">COMPARE SIMILAR +</p>
				</div>
			</div>
		</div>
	</div>
</div>