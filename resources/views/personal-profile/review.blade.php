@extends('layouts.header')

@section('content')

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
                        <h4 class="page-title">My Review</h4>
                    </div>
                    
                    <div class="review_section padding-1 white-bg border-radius1">
                        <?php 
                        if(isset($RevData)) {
                        foreach ($RevData as $data) {
                        ?>
                        <div class="review-block">
                            <div class="review-content">
                                <h5> <span>Your review on</span> <?php echo $data['title']; ?> </h5>
                                <!--<div class="edit-txt"><a href="#"><i class="far fa-edit"></i> Edit</a></div>-->
                                <span class="date-txt"><?php echo $data['created_at']; ?></span>
                                <p><?php echo $data['review']; ?></p>
                            </div>

                            <div class="review-rating-txt">
                                <span><?php echo $data['rating']; ?></span> / 5 Ratings
                            </div>

                        </div>
                        <?php 
                        }
                        ?>
                        <div class="pr-submit-bg text-center">
                            <p>No reviews to view. Book your first activity and do a review afterward.</p>
                            <div class="btn btn-submit" onclick="location.href='/instant-hire'"> Add Review </div>
                        </div>
                        <?php
                        } else {
                        ?>
                        <div class="pr-submit-bg text-center">
                            <p>No reviews to view. Book your first activity and do a review afterward.</p>
                            <div class="btn btn-submit" onclick="location.href='/instant-hire'"> Add Review </div>
                        </div>
                        <?php
                        }
                        ?>

                    </div>

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