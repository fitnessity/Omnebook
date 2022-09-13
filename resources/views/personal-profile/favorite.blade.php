@extends('layouts.header')
@section('content')
<?php
	use App\BusinessPriceDetails;
?>

<link rel="shortcut icon" href="{{ url('public/img/favicon.png') }}">

<!--<link rel="stylesheet" type="text/css" href="{{ url('public/css/bootstrap.css') }}">-->
<link rel="stylesheet" type="text/css" href="{{ url('public/css/all.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/metismenu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/fullcalendar.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/profile.css') }}">

<div class="page-wrapper inner_top" id="wrapper">

    <div class="page-container">

        <!-- Left Sidebar Start -->
       @include('personal-profile.left_panel')
        <!-- Left Sidebar End -->

        <div class="page-content-wrapper">

            <div class="content-page">

                <div class="container-fluid">

                    <div class="page-title-box">
                        <h4 class="page-title">My Favorite</h4>
                        <div class="favorite_section padding-1 white-bg border-radius1">
							<ul class="nav nav-tabs">
								<li class="active"><a data-toggle="tab" href="#activity">Activity</a></li>
                              	<li><a data-toggle="tab" href="#business"> Business </a></li>
                            </ul>
                            <div class="tab-content">
								<div id="activity" class="tab-pane fade in active">
                                	<h4 class="page-title">Favorite Activity</h4>
                                    <?php //print_r($FavDetail);
                                	if(isset($FavDetail)) {
                    					foreach ($FavDetail as $data) {
											$price = BusinessPriceDetails::where('serviceid', $data['id'])->first();
											
											/*if ($price) {
												$price = $price->toArray();
											}*/
											$disprice='-'; $pay_session='-'; //print_r($price);
											if( !empty($price->pay_price) ){ $disprice= $price->pay_price; }
											if( !empty($price->pay_session) ){ $disprice= $price->pay_session; }
                                    		?>
                                            	<div class="favorite-block">
                                                    <div class="favorite-content">
                                                        <div class="favorite-img">
                                      						<img src="/public/uploads/profile_pic/thumb/<?php echo $data['profile_pic'];?>" alt="">
                                                            <div class="ratings-txt"><span>8.6</span> / 10</div>
                                                        </div>
                                                        <div class="favorite-right-content">
                                                            <h5><?php echo $data['program_name'];?> </h5>
                                                            <ul>
                                                                <li><?php echo $data['short_description']; ?></li>
                                                                <?php /*?><li>$ <?php echo $disprice; ?></li><?php */?>
                                                                <?php /*?><li>$ <?php echo $pay_session.' session'; ?></li><?php */?>
                                                                <li><i class="fas fa-asterisk"></i> <?php echo $data['sport_activity'];?></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                        
                                                    <div class="favorite-button">
                                                        <a href="#"><i class="fas fa-eye"></i> View Listing</a>
                                                        <a href="#"><i class="far fa-trash-alt"></i> Remove</a>
                                                    </div>
                        
                                                </div>
                                            <?php
										}
									}
                                    ?>
                              	</div>
                              <div id="business" class="tab-pane fade">
                                <h4 class="page-title">Favorite Business</h4>
                                <p>No favorite Business added</p>
                              </div>
                            </div>
                        </div>
                    </div>
                    <?php /*?><?php
                    if(isset($FavDetail)) {
                    foreach ($FavDetail as $data) {  
                    ?>
                    <div class="favorite_section padding-1 white-bg border-radius1">

                        <div class="favorite-block">

                            <div class="favorite-content">
                                <div class="favorite-img">
                                    <img src="/public/uploads/profile_pic/thumb/<?php  echo $data['logo'];?>" alt="">
                                    <div class="ratings-txt"><span>8.6</span> / 10</div>
                                </div>
                                <div class="favorite-right-content">
                                    <h5><?php  echo $data['first_name'];?> </h5>
                                    <ul>
                                        <li><?php  echo $data['short_description'];?></li>
                                        <li><i class="fas fa-map-marker-alt"></i> <?php  echo $data['address'];?></li>
                                        <li><i class="fas fa-phone-volume"></i> <?php  echo $data['contact_number'];?></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="favorite-button">
                                <a href="#"><i class="fas fa-eye"></i> View Listing</a>
                                <a href="#"><i class="far fa-trash-alt"></i> Remove</a>
                            </div>

                        </div>

                    </div>
                    <?php 
                    }
                    ?>
                    <div class="pr-submit-bg text-center">
                        <p>No favorite activities or businesses added. Find your favorite activity or business and keep track of them here.</p>
                        <div class="btn btn-submit" onclick="location.href='/instant-hire'"> Add Favorite </div>
                    </div>
                    <?php
                    } else {
                    ?>
                    <div class="pr-submit-bg text-center">
                        <p>No favorite activities or businesses added. Find your favorite activity or business and keep track of them here.</p>
                        <div class="btn btn-submit" onclick="location.href='/instant-hire'"> Add Favorite </div>
                    </div>
                    <?php
                    }
                    ?><?php */?>
                </div>

            </div>

        </div>

    </div>


</div>
@include('layouts.footer')

<script src="{{ url('public/js/jquery-3.3.1.slim.min.js') }}"></script>

<script src="{{ url('public/js/bootstrap.min.js') }}"></script>

<script src="{{ url('public/js/metisMenu.min.js') }}"></script>

<script src="{{ url('public/js/jquery.slimscroll.js') }}"></script>

<script src="{{ url('public/js/moment.min.js') }}"></script>

<script src="{{ url('public/js/fullcalendar.min.js') }}"></script>

<script src="{{ url('public/js/jquery.fullcalendar.js') }}"></script>

<script src="{{ url('public/js/custom.js') }}"></script>

@endsection