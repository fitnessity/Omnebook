@extends('layouts.business.header')
@section('content')
@include('layouts.userHeader')
<link href="{{ url('/public/css/frontend/general.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>compare/style.css">
<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>compare/w3.css">
<style>
    .payment-section{margin-top:-200px}
    .experienceBody ul, li { list-style: none !important;}
</style>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/Compare.js"></script>
<script src="{{ url('public/js/owl.carousel.js') }}"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/jquery-1.9.1.min.js"></script>
<div class="payment-section">
    <div class="payment-toptabs">
        <ul>
            <li> <span>1</span> Shopping Cart </li>
            <li> <span>2</span> Confirmation </li>
        </ul>
    </div>
    <div class="congratulation-block">
        <h2>Congratulation!</h2> 
        <p>Your booking is confirmed. Check your account for further details.</p>
        <p>Looking to find another active activity you love or to find a new one, get started by clicking below.</p>
        <a href="/activities" class="btn btn-web-btn">Book Another Activity</a>        
        <a href="{{route('personal.manage-account.index')}}" class="btn btn-web-btn">Go To My Profile</a>        
    </div>
</div>  
@include('layouts.business.footer')
@endsection
