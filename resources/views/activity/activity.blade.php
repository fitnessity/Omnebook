@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')
@section('content')

<link rel="stylesheet" href="/public/css/compare/style.css">
	<section class="direc-hire" style="margin-top:100px">
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
								<input type="checkbox" name="maps" id="maps" checked="">
								<span class="slider round"></span>
							</label>
						</div>
					</div>
				</div>
				<div class="col-md-8 leftside-kickboxing">
					<div class="row" id="activitylist">
						<div class="col-md-4 col-sm-4 col-map-show">
							<div class="kickboxing-block">
								<div class="kickboxing-topimg-content">
										<img src="https://fitnessity.govindcrankrod.com/public/uploads/profile_pic/thumb/1654003844-yoga-outside.webp" class="productImg">
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
									<div class="activity-information">
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
									<img src="https://fitnessity.govindcrankrod.com/public/uploads/profile_pic/thumb/1654092155-dance3.jpg" class="productImg">
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
									<div class="activity-information">
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
									<img src="https://fitnessity.govindcrankrod.com/public/uploads/profile_pic/thumb/1654093746-GettyImages-136131022-56ca8aa35f9b5879cc4e7a73.jpg" class="productImg">
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
									<div class="activity-information">
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
									<img src="https://fitnessity.govindcrankrod.com/public/uploads/profile_pic/thumb/1654183325-badminton-1428046__480.jpg" class="productImg">
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
									<div class="activity-information">
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
									<img src="https://fitnessity.govindcrankrod.com/public/uploads/profile_pic/thumb/1654693172-Aerobics-1.jpg" class="productImg">
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
									<div class="activity-information">
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
									<img src="https://fitnessity.govindcrankrod.com/public/uploads/profile_pic/thumb/1655126994-5.jpg" class="productImg">
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
									<div class="activity-information">
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
									<img src="https://fitnessity.govindcrankrod.com/public/uploads/profile_pic/thumb/1655389294-badminton-1428046__480.jpg" class="productImg">
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
									<div class="activity-information">
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
									<img src="/public/images/service-nofound.jpg" class="productImg">
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
									<div class="activity-information">
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
									<img src="https://fitnessity.govindcrankrod.com/public/uploads/profile_pic/thumb/1660784581-IMG-20220817-WA0023.jpg" class="productImg">
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
									<div class="activity-information">
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
									<img src="/public/images/service-nofound.jpg" class="productImg">
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
									<div class="activity-information">
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
			<div class="col-md-4 col-sm-12 col-xs-12 kickboxing_map" style="display: none;">
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
@include('layouts.footer')


@endsection