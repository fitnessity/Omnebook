@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
<link rel='stylesheet' type='text/css' href="{{url('/public/css/frontend/general.css')}}">
<link rel='stylesheet' type='text/css' href="{{url('/public/css/responsive.css')}}">
@section('content')

<section class="show-all">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="border-list">
					<div class="row">
						<div class="activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => null])}}" >All Activities</a>
							</div>
						</div>

						<div class="activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Yoga'])}}" >Yoga</a>
							</div>
						</div>

						<div class="activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6">
							<div class="sports-list ">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Pilates'])}}" >Pilates</a>
							</div>
						</div>
						<div class="activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Cardio'])}}" >Cardio</a>
							</div>
						</div>
						<div class="activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Cycling'])}}" >Cycling</a>
							</div>
						</div>

						<div class="col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 show_activities_options">
							<div class="sports-list">
								<a href="#">More<i class="fas fa-caret-down"></i></a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Strength'])}}" >Strength</a>
							</div>
						</div>

						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Aerobics'])}}" >Aerobics</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Archery'])}}" >Archery</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Badminton'])}}" >Badminton</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Barre'])}}" >Barre</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Baseball'])}}" >Baseball</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Basketball'])}}" >Basketball</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Beach Vollyball'])}}" >Beach Vollyball</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Bouldering'])}}" >Bouldering</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Bungee Jumping'])}}" >Bungee Jumping</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Day Camp'])}}" >Day Camp</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Sleep Away'])}}" >Sleep Away</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Winter Camp'])}}" >Winter Camp</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Canoeing'])}}" >Canoeing</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Indoor cycling'])}}" >Indoor cycling</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Dance'])}}" >Dance</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Diving'])}}" >Diving</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Ice Hockey'])}}" >Ice Hockey</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Football'])}}" >Football</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Golf'])}}" >Golf</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Gymnastics'])}}" >Gymnastics</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Hang Gliding'])}}" >Hang Gliding</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Hiit'])}}" >Hiit</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Hiking - Backpacking'])}}" >Hiking - Backpacking</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Horseback Riding'])}}" >Horseback Riding</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Ice Skating'])}}" >Ice Skating</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Kayaking'])}}" >Kayaking</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'lacrosse'])}}" >lacrosse</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Laser Tag'])}}" >Laser Tag</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Boxing'])}}" >Boxing</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Jiu-Jitsu'])}}" >Jiu-Jitsu</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Karate'])}}" >Karate</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Kick Boxing'])}}" >Kick Boxing</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Kung Fu'])}}" >Kung Fu</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'MMA'])}}" >MMA</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Self-Defense'])}}" >Self-Defense</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Tai Chi'])}}" >Tai Chi</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Wrestling'])}}" >Wrestling</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Massage Therapy'])}}" >Massage Therapy</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Nutrition'])}}" >Nutrition</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Paint Ball'])}}" >Paint Ball</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Physical Therapy'])}}" >Physical Therapy</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Pilates'])}}" >Pilates</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Rafting'])}}" >Rafting</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Rapelling'])}}" >Rapelling</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Rock Climbing'])}}" >Rock Climbing</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Rowing'])}}" >Rowing</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Running'])}}" >Running</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Airplane Tour'])}}" >Airplane Tour</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'ATV Tours'])}}" >ATV Tours</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Boat Tours'])}}" >Boat Tours</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Bus Tour'])}}" >Bus Tour</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Caving Tours'])}}" >Caving Tours</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Helicopter Tour'])}}" >Helicopter Tour</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Sailing'])}}" >Sailing</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Scuba Diving'])}}" >Scuba Diving</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Sky diving'])}}" >Sky diving</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Snow Skiing'])}}" >Snow Skiing</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Snowboarding'])}}" >Snowboarding</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Strength &amp; Conditioning'])}}" >Strength &amp; Conditioning</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Surfing'])}}" >Surfing</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Swimming'])}}" >Swimming</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Tennis'])}}" >Tennis</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Tours'])}}" >Tours</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Vollyball'])}}" >Vollyball</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Weight training'])}}" >Weight training</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Windsurfing'])}}" >Windsurfing</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Yoga'])}}" >Yoga</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Zip-Line'])}}" >Zip-Line</a>
							</div>
						</div>
						<div class="more_activities_options col-lg-2 col-md-3 col-sm-3 col-xs-6 col-6 hidden">
							<div class="sports-list ">
								<a href="{{$request->fullUrlWithQuery(['sport_activity' => 'Zumba'])}}" >Zumba</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container">
		<div class="row">
			@foreach ($days as $date)
				@php
					$hint_class = ($filter_date->format('Y-m-d') == $date->format('Y-m-d')) ? 'pairets' : 'pairets-inviable';
				@endphp
			
				<div class="col-md-2 col-sm-2 col-xs-6 col-6">
					<div class="{{$hint_class}}">
						<!-- <div class="pairets-inviable"> -->
						<a href="{{$request->fullUrlWithQuery(['date' => $date->format('Y-m-d')])}}" class="calendar-btn">{{$date->format("D d")}}</a>
					</div>
				</div>
			@endforeach
		</div>
	
		<div class="row">
			<div class="col-md-12">
				<div class="header-bg-show">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="day-date">
								<span>{{$filter_date->format("D d")}}</span>
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="time-base">
								<label>Time Based On:</label>
								<span>New York, NY</span>
							</div>
						</div>
					</div>
				</div>
				@foreach ($bookschedulers as $bookscheduler)
					@php
						$spot_left = $bookscheduler->spots_left($filter_date);
					@endphp
					@if ($bookscheduler->price_detail() > 0 && $spot_left > 0)
						
						<div class="row">
							<div class="col-md-12">
								<div class="border-list">
									<div class="row">
										<div class="col-md-2 col-xs-12 col-sm-2">
											<div class="table-inner-data">
												<span class="mg-time"> {{date('h:i A', strtotime($bookscheduler['shift_start']))}} </span>
												<div class="time-min">
													<span> {{$bookscheduler->get_clean_duration()}} </span>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-xs-12 col-sm-5">
											<div class="table-inner-data-sec">
												<img src="{{ Storage::disk('s3')->exists($bookscheduler->business_service->first_profile_pic()) ? Storage::URL($bookscheduler->business_service->first_profile_pic()) : url('/images/service-nofound.jpg') }}" alt="Fitnessity">
												<div class="p-name">
													<h3>{{$bookscheduler->business_service->program_name}}</h3>
													<p> {{$bookscheduler->business_service->formal_service_types()}} | {{$bookscheduler->business_service->sport_activity}} | Spot Available - {{$bookscheduler->spots_left($filter_date)}}/{{$bookscheduler->spots_available}}
														</p>
													@if ($bookscheduler->is_start_in_one_hour($filter_date))
														<span> Starting in {{$bookscheduler->time_left($filter_date)->format('%i minutes')}} </span>
													@endif
													
												</div>
											</div>
										</div>
										<div class="col-md-1 col-xs-3 col-sm-2 col-2">
											<div class="star-rest">
												<div class="activity-inner-data">
													<i class="fas fa-star"></i>
													<span> {{$bookscheduler->business_service->reviews_score()}} </span>
												</div>
											</div>
										</div>
										<div class="col-md-1 col-xs-3 col-sm-1 col-4">
											<div class="table-price">
												<span> ${{$bookscheduler->price_detail()}} </span>
											</div>
										</div>
										<div class="col-md-2 col-xs-6 col-sm-2 col-6">
											<div class="join-btn">
												<a class="showall-btn btn-position" href="{{route('activities_show', ['serviceid' => $bookscheduler->business_service->id])}}">Book Now</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endif
				@endforeach
				
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	$(document).on('click', '.show_activities_options', function(e){
		e.preventDefault()

		$('.more_activities_options').toggleClass('hidden')
	})
</script>
@include('layouts.business.footer')
@endsection