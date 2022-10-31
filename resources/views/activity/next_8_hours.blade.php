@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')
@section('content')

<section class="show-all">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="border-list">
					<div class="row">
						<div class="col-md-2 col-sm-3 col-xs-6">
							<div class="sports-list">
								<a href="" >Yoga</a>
							</div>
						</div>
						<div class="col-md-2 col-sm-3 col-xs-6">
							<div class="sports-list">
								<a href="" >Pilates</a>
							</div>
						</div>
						<div class="col-md-2 col-sm-3 col-xs-6">
							<div class="sports-list">
								<a href="" >Cardio</a>
							</div>
						</div>
						<div class="col-md-2 col-sm-3 col-xs-6">
							<div class="sports-list">
								<a href="" >Cycling</a>
							</div>
						</div>
						<div class="col-md-2 col-sm-3 col-xs-6">
							<div class="sports-list">
								<a href="" >Strength</a>
							</div>
						</div>
						<div class="col-md-2 col-sm-3 col-xs-6">
							<div class="sports-list">
								<a href="" >More<i class="fas fa-caret-down"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="container">
		<div class="row">
			<div class="col-md-2 col-sm-2 col-xs-6">
				<div class="pairets">
					<a class="calendar-btn">FRI 22</a>
				</div>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-6">
				<div class="pairets-inviable">
					<a class="calendar-btn">SAT 23</a>
				</div>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-6">
				<div class="pairets-inviable">
					<a class="calendar-btn">SUN 24</a>
				</div>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-6">
				<div class="pairets-inviable">
					<a class="calendar-btn">MON 25</a>
				</div>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-6">
				<div class="pairets-inviable">
					<a class="calendar-btn">TUE 26</a>
				</div>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-6">
				<div class="pairets-inviable">
					<a class="calendar-btn">WED 27</a>
				</div>
			</div>
		</div>
	
		<div class="row">
			<div class="col-md-12">
				<div class="header-bg-show">
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<div class="day-date">
								<span>Friday, July 22</span>
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
				<div class="row">
					<div class="col-md-12">
						<div class="border-list">
							<div class="row">
								<div class="col-md-2 col-xs-12 col-sm-2">
									<div class="table-inner-data">
										<span class="mg-time"> 10:00 AM </span>
										<div class="time-min">
											<span> 45 min </span>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-xs-12 col-sm-5">
									<div class="table-inner-data-sec">
										<img src="{{ url('public/uploads/profile_pic/thumb/1650612371-20.jpg')}}" alt="Fitnessity">
										<div class="p-name">
											<h3>Valor Mixed Martial Arts</h3>
											<p> Personal Training | Kickboxing</p>
											<!--<span> Start in 4 min </span>-->
										</div>
									</div>
								</div>
								<div class="col-md-1 col-xs-3 col-sm-2">
									<div class="star-rest">
										<div class="activity-inner-data">
											<i class="fas fa-star"></i>
											<span> 4.6 </span>
										</div>
									</div>
								</div>
								<div class="col-md-1 col-xs-3 col-sm-1">
									<div class="table-price">
										<span> $5.00 </span>
									</div>
								</div>
								<div class="col-md-2 col-xs-6 col-sm-2">
									<div class="join-btn">
										<button class="showall-btn btn-position" type="button">More Details</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				
				<div class="row">
					<div class="col-md-12">
						<div class="border-list">
							<div class="row">
								<div class="col-md-2 col-xs-12 col-sm-2">
									<div class="table-inner-data">
										<span class="mg-time"> 10:00 AM </span>
										<div class="time-min">
											<span> 55 min </span>
										</div>
									</div>
								</div>
								<div class="col-md-6 col-xs-12 col-sm-5">
									<div class="table-inner-data-sec">
										<img src="{{ url('public/uploads/gallery/720/thumb/home.jpg')}}" alt="Fitnessity">
										<div class="p-name">
											<h3>ATV Tours In New York</h3>
											<p>Experience | ATV</p>
											<!--<span> Start in 4 min </span>-->
										</div>
									</div>
								</div>
								<div class="col-md-1 col-xs-3 col-sm-2">
									<div class="star-rest">
										<div class="activity-inner-data">
											<i class="fas fa-star"></i>
											<span> 4.6 </span>
										</div>
									</div>
								</div> 
								<div class="col-md-1 col-xs-3 col-sm-1">
									<div class="table-price">
										<span> $25.00 </span>
									</div>
								</div>
								<div class="col-md-2 col-xs-6 col-sm-2">
									<div class="join-btn">
										<button class="showall-btn btn-position" type="button">More Details</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-12">
						<div class="border-list">
							<div class="row">
								<div class="col-md-2 col-xs-12 col-sm-2">
								<div class="table-inner-data">
									<span class="mg-time"> 10:00 AM </span>
									<div class="time-min">
										<span> 1 hr 35 min </span>
									</div>
								</div>
								</div>
								<div class="col-md-6 col-xs-12 col-sm-5">
									<div class="table-inner-data-sec">
										<img src="{{ url('public/uploads/gallery/720/thumb/home4.jpg')}}" alt="Fitnessity">
										<div class="p-name">
											<h3>Valor Mixed Martial Arts</h3>
											<p> Group Class | Kickboxing</p>
											<!--<span> Start in 4 min </span>-->
										</div>
									</div>
								</div>
								<div class="col-md-1 col-xs-3 col-sm-2">
									<div class="star-rest">
										<div class="activity-inner-data">
											<i class="fas fa-star"></i>
											<span> 4.6 </span>
										</div>
									</div>
								</div>
								<div class="col-md-1 col-xs-3 col-sm-1">
									<div class="table-price">
										<span> $30.00 </span>
									</div>
								</div>
								<div class="col-md-2 col-xs-6 col-sm-2">
									<div class="join-btn">
										<button class="showall-btn btn-position" type="button">More Details</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</section>

@include('layouts.footer')
@endsection