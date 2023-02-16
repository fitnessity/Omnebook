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
        <!-- Left Sidebar End -->

        <div class="page-content-wrapper">

            <div class="content-page">

                <div class="container-fluid">

                    <div class="page-title-box">
                        <h4 class="page-title">Add Family or Friends</h4>
                    </div>
					
					<div class="payment_info_section padding-2 white-bg border-radius1">
						<div class="add-family-frnd" style="cursor: pointer">
                            <div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/add-family.png );">
								<h2>Eric Phipps </h2>
								<p>(Son 35 yrs old)</p>
								<div class="familyfrnd-info">
									<a class="edit-family" href="#"> Edit </a>
									<a class="delete-family" href="#"> Delete </a>
								</div>
                             </div>
                         </div>
						 <div class="add-family-frnd" style="cursor: pointer">
                            <div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/add-family.png );">
								<h2>Eric Phipps </h2>
								<p>(Son 35 yrs old)</p>
								<div class="familyfrnd-info">
									<a class="edit-family" href="#"> Edit </a>
									<a class="delete-family" href="#"> Delete </a>
								</div>
                             </div>
                         </div>
						 <div class="add-family-frnd" style="cursor: pointer">
                            <div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/add-family.png );">
								<h2>Eric Phipps </h2>
								<p>(Son 35 yrs old)</p>
								<div class="familyfrnd-info">
									<a class="edit-family" href="#"> Edit </a>
									<a class="delete-family" href="#"> Delete </a>
								</div>
                             </div>
                         </div>
						 <div class="add-family-frnd" style="cursor: pointer">
                            <div class="cards-content" style="color:#ffffff; background-image: url(http://dev.fitnessity.co/public/img/add-family.png );">
								<h2>( + )</h2>
								<p class="add-fm-fr">Add Family Member or Friend</p>
                             </div>
                         </div>
					</div>
					
					<div class="row">
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
@include('layouts.footer')

@endsection