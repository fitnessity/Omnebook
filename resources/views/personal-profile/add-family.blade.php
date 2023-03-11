@extends('layouts.header')
@section('content')

<link rel="shortcut icon" href="{{ url('public/img/favicon.png') }}">

<!--<link rel="stylesheet" type="text/css" href="{{ url('public/css/bootstrap.css') }}">-->
<link rel="stylesheet" type="text/css" href="{{ url('public/css/all.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/metismenu.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/fullcalendar.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('public/css/profile.css') }}">
<style type="text/css">
   .dob label {
        background-color: lightblue;
        padding: 8px;
        color: white;
        margin-right: -3px;
        z-index: 999999;
        position: relative;
        float:left;
        border-top:solid 1px #000;
        border-bottom:solid 1px #000;
        border-left:solid 1px #000;
    }
    .dob input {
        padding: 10px 10px 10px 10px !important;
        width: 240px;
        border: solid 1px lightgray;
        border-radius: 20px;
    }
</style>
<?php 
    $today =date('m-d-Y') ;
?>
<div class="page-wrapper inner_top" id="wrapper">
    <div class="page-container">

        <!-- Left Sidebar Start -->
        @include('personal-profile.left_panel')
        <!-- Left Sidebar End -->

        <div class="page-content-wrapper">
            <div class="content-page">
                <div class="container-fluid">
                    <div class="page-title-box">
                        <h4 class="page-title">Add Family or Friends</h4>
                    </div>
                    <div class="payment_info_section padding-2 white-bg border-radius1">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="padding-bottom:10px">
                                @if(session()->has('success'))
                                <div class="alert alert-success fade in alert-dismissible show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:23px">
                                        <span aria-hidden="true" style="font-size:20px">×</span>
                                    </button> {{ session()->get('success') }}
                                </div>
                                @elseif(session()->has('error'))
                                <div class="alert alert-danger fade in alert-dismissible show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:23px">
                                        <span aria-hidden="true" style="font-size:20px">×</span>
                                    </button> {{ session()->get('error') }}
                                </div>
                                @endif
                            </div>
                        </div>

                        @foreach($UserFamilyDetails as $family)
                        <div class="add-family-frnd" style="cursor: pointer">
                            <div class="cards-content" style="color:#ffffff; background-image: url(/public/img/add-family.png);">
                                <h2>{{$family->first_name}} {{$family->last_name}} </h2>
                                <p>({{$family->relationship}} {{$family->getAge()}} yrs old)</p>
                                <div class="familyfrnd-info">
                                    <a class="view-booikng" href="{{route('personal.orders.index')}}"> View Booking </a>
                                    <a class="edit-family" href="#" data-behavior="ajax_html_modal" data-url="{{route('showFamilyMember' ,['id'=>$family->id])}}" data-modal-width="1200px"> Edit </a>
                                    <a class="delete-family" href="{{route('removefamily' ,['id'=>$family->id])}}"> Delete </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <div class="add-family-frnd" style="cursor: pointer">
                            <div class="cards-content" style="color:#ffffff; background-image: url('/public/img/add-family.png');">
                                <h2>( + )</h2>
                                <a class="add-fm-a" data-behavior="ajax_html_modal" data-url="{{route('showFamilyMember')}}" data-modal-width="1200px">Add Family Member or Friend</a>
                             </div>
                        </div>
                    </div>
                    
                    <!-- <div class="row">
                        <div class="col-md-12">
                            <div class="text-right btn-txt-pro">
                                <button type="submit" class="btn-nxt-profile">PREV </button>
                                <button type="submit" class="btn-nxt-profile">NEXT </button>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@endsection