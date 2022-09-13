@extends('layouts.header')
@section('content')
@include('layouts.userHeader')
<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>compare/style.css">
<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>compare/w3.css">
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
        <a href="/lesson/jsModallesson/booklesson" class="btn btn-web-btn" data-toggle="modal" data-target="#lesson_modal">Book Another Activity</a>        
    </div>
</div>
@include('layouts.footer')
@endsection