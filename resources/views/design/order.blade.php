@extends('layouts.header')
@section('content')

<link rel="shortcut icon" href="{{ url('public/img/favicon.png') }}">

<!--<link rel="stylesheet" type="text/css" href="{{ url('public/css/bootstrap.css') }}">-->
<link rel="stylesheet" type="text/css" href="{{ url('public/css/all.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/metismenu.min.css') }}">
<link href="{{ url('public/css/jquery-ui.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/profile.css') }}">
<style type="text">
    .intro{
        height: auto;
    }
</style>
<?php use App\UserFamilyDetail;?>

<div class="page-wrapper inner_top" id="wrapper">
    <div class="page-container">
        <!-- Left Sidebar Start -->
        @include('personal-profile.left_panel')
        <!-- Left Sidebar End -->
        <div class="page-content-wrapper">
            <div class="content-page">
                <div class="container-fluid">
                    <div class="page-title-box">
                        <h4 class="page-title">BOOKINGS INFO & PURCHASE HISTORY</h4>
                    </div>
                    <div class="payment_info_section padding-2 white-bg border-radius1 purchases-bt">
                        <div class="booking-history selecting-pro">
                            <h3>Start by selecting a provider</h3>
                            <p>View your bookings, purchases, reserve your spot or rebook an activity</p>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="booking-info-history">
                                    <div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/add-family.png );">
                                        <h2>Valor Mixed Martial Arts </h2>
                                        <p>2067 Broadway, 7th Fl New York, NY 10023, United States</p>
                                        <div class="booking-activity">
                                            <span> Active Memberships: 2 </span>
                                            <span> Completed Memberships: 5 </span>
                                            <span> Expiring Memberships: 3 </span>
                                            <span> Number of visits: 150 </span>
                                        </div>
                                        
                                        <div class="booking-activity-view">
                                            <a class="view-booking" href="#"> View </a>
                                        </div>
                                     </div>
                                 </div>
                            </div>
                            <div class="col-md-4">
                                <div class="booking-info-history">
                                    <div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/add-family.png );">
                                        <h2>Equinox Gym</h2>
                                        <p>2067 Broadway, 7th Fl New York, NY 10023, United States</p>
                                        <div class="booking-activity">
                                            <span> Active Memberships: 2 </span>
                                            <span> Completed Memberships: 5 </span>
                                            <span> Expiring Memberships: 3 </span>
                                            <span> Number of visits: 150 </span>
                                        </div>
                                        
                                        <div class="booking-activity-view">
                                            <a class="view-booking" href="#"> View </a>
                                        </div>
                                     </div>
                                 </div>
                            </div>
                            <div class="col-md-4">
                                <div class="booking-info-history">
                                    <div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/add-family.png );">
                                        <h2>New York Dance Company </h2>
                                        <p>2067 Broadway, 7th Fl New York, NY 10023, United States</p>
                                        <div class="booking-activity">
                                            <span> Active Memberships: 2 </span>
                                            <span> Completed Memberships: 5 </span>
                                            <span> Expiring Memberships: 3 </span>
                                            <span> Number of visits: 150 </span>
                                        </div>
                                        
                                        <div class="booking-activity-view">
                                            <a class="view-booking" href="#"> View </a>
                                        </div>
                                     </div>
                                 </div>
                            </div>
                            <div class="">
                                <div class="col-md-12">
                                    <div class="text-right btn-txt-pro">
                                        <button type="submit" class="btn-nxt-profile">PREV </button>
                                        <button type="submit" class="btn-nxt-profile">NEXT </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 
@include('layouts.footer')



<script src="{{ url('public/js/jquery.1.11.1.min.js') }}"></script>

<script src="{{ url('public/js/bootstrap.min.js') }}"></script>

<script src="{{ url('public/js/metisMenu.min.js') }}"></script>

<script src="{{ url('public/js/jquery.slimscroll.js') }}"></script>

<script src="{{ url('public/js/moment.min.js') }}"></script>

<script src="{{ url('public/js/jquery-ui.min.js') }}"></script>

<script src="{{ url('public/js/jquery-ui.multidatespicker.js') }}"></script>

<script src="{{ url('public/js/custom.js') }}"></script>
<!-- <script src="{{ url('public/js/compare/jquery-1.9.1.min.js') }}"></script> -->



@endsection