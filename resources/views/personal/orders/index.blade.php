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
                            <p>You can view your bookings and purchases history.</p>
                            <p>You can view the online schedule,make reservations,rebook or cancel an activity</p>
                        </div>
                        <div class="row">
                            @foreach($business as $bs)
                            <div class="col-md-4">
                                <div class="booking-info-history">
                                    <div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/add-family.png );">
                                        <h2>{{ $bs->company_name}}</h2>
                                        <p>{{$bs->company_address()}}</p>
                                        <div class="booking-activity">
                                            <span> Active Memberships: {{$bs->active_memberships_count()}}</span>
                                            <span> Completed Memberships: {{$bs->completed_memberships_count()}} </span>
                                            <span> Expiring Memberships: {{$bs->expired_soon()}} </span>
                                            <span> Number of visits: {{$bs->visits_count()}} </span>
                                        </div>
                                        
                                        <div class="booking-activity-view">
                                            <a class="view-booking" href="{{route('personal.orders.show',['order'=>$bs->id])}}"> View Bookings</a>
                                            <a class="view-schedule" href="{{route('personal.allActivitySchedule')}}"> View Schedule</a>
                                        </div>
                                     </div>
                                 </div>
                            </div>
                            @endforeach
                            <!-- <div class="col-md-4">
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
                            </div> -->
                            <div class="" style="display:none;">
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


@endsection