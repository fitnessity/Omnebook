@extends('layouts.header')
@section('content')
<?php
	use App\BusinessPriceDetails;
    use App\BusinessServiceReview;
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
							<ul class="nav nav-tabs" role="tablist">
								<li class="active"><a data-toggle="tab" href="#activity_list" role="tab">Activity</a></li>
                              	<li><a data-toggle="tab" href="#business_list" role="tab"> Business </a></li>
                            </ul>
                            <div class="tab-content">
								<div id="activity_list" class="tab-pane active" role="tabpanel">
                                	<h4 class="page-title">Favorite Activity</h4>
                                    <?php //print_r($FavDetail);
                                	if(isset($FavDetail) && count($FavDetail) > 0) {
                    					foreach ($FavDetail as $data) {
                                            $reviews_avg=0;
                                            $reviews_count = BusinessServiceReview::where('service_id', $data['id'])->count();
                                            $reviews_sum = BusinessServiceReview::where('service_id', $data['id'])->sum('rating');
                                            if($reviews_count>0)
                                            { 
                                                $reviews_avg = round($reviews_sum/$reviews_count,2); 
                                            }
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
                                                        <?php 
                                                        if($data['profile_pic'] != ''){
                                                            if(str_contains($data['profile_pic'], ',')){
                                                                $pic_image = explode(',', $data['profile_pic']);
                                                                if( $pic_image[0] == ''){
                                                                   $p_image  = $pic_image[1];
                                                                }else{
                                                                    $p_image  = $pic_image[0];
                                                                }
                                                            }else{
                                                                $p_image = $data['profile_pic'];
                                                            }

                                                            if (file_exists( public_path() . '/uploads/profile_pic/' . $p_image)) {
                                                               $act_img = url('/public/uploads/profile_pic/' . $p_image);
                                                            }else {
                                                               $act_img = url('/public/images/service-nofound.jpg');
                                                            }
                                                        }else{
                                                            $act_img = url('/public/images/service-nofound.jpg');
                                                        }
                                                        ?>
                                      						<img src="{{$act_img}}" alt="">
                                                            <div class="ratings-txt"><span>{{$reviews_avg}}</span> / 5</div>
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
                                                        <a href="/activity-details/{{$data['id']}}" target="_blank"><i class="fas fa-eye"></i> View Listing</a>
                                                        <a onclick="deletefromfav({{$data['id']}});"><i class="far fa-trash-alt"></i> Remove</a>
                                                    </div>
                        
                                                </div>
                                            <?php
										}
									}else{ ?>
                                        <p>No favorite Activity added</p>
                                    <?php } ?>
                              	</div>
                                <div id="business_list" class="tab-pane " role="tabpanel">
                                    <h4 class="page-title">Favorite Business</h4>
                                   
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
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    function  deletefromfav(ser_id) {
        var _token = $('meta[name="csrf-token"]'). attr('content');
        $.ajax({
            type: 'POST',
            url: '{{route("service_fav")}}',
            data: {
                _token: _token,
                ser_id: ser_id
            },
            success: function (data) {
                window.location.reload();
            }
        });
    }
</script>

@endsection