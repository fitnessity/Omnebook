@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')
@section('content')
<?php
	use App\BusinessServices;
	use App\BusinessPriceDetails;
	use App\BusinessServiceReview;
	use App\User;
?>

<section class="main-slider inner-banner" style="background-image:url('/public/images/about-bg.jpg')">
    <div class="container">
        <h1></h1>
    </div>
</section>
<section class="breadcrumbs">
  <div class="container">
      <ul>
		<li>LEAVE A REVIEW</li>
		</ul>
    </div>
</section>

<section class="leavereview">
    <div class="container">
    	<div class="row">
        	<div class="col-md-2">
            	<img src="https://fitnessity.co/public/uploads/profile_pic/thumb/1637459901-arobics.jpg">
        	</div>
            <div class="col-md-10">
            	<h1> Adventure Sport Association </h1>
                <p class="caddress"> <b> Provider: </b> <a href="Passing-Miles-Digital/14"> Passing Miles Digital </a>
                    	East Lansin, United States, 48823
                </p>
                <p class="reviewnote"> Tell us your first-hand experiences. This review helps others like you. Thank you! </p>
                <h3> Review The Activity<span class="color-red f-16">*</span> <span>(Leave a review for the activity you participated in)</span> </h3>
        	</div>
        </div>
    </div>

</section>







@include('layouts.footer')