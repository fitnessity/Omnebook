@inject('request', 'Illuminate\Http\Request')

@extends('layouts.header')

@section('content')

<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>compare/style.css">
<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>compare/w3.css">
<link href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css" type="text/css" rel="stylesheet" />
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/Compare.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>compare/jquery-1.9.1.min.js"></script>
<script src="{{ url('public/js/jquery-ui.min.js') }}"></script>
<script src="{{ url('public/js/jquery-ui.multidatespicker.js') }}"></script>

<div class="payment-section" style="margin-top:78px">
    <div class="payment-toptabs">
        <ul>
            <li> <span>1</span> Shopping Cart </li>
            <li> <span>2</span> Confirmation </li>
        </ul>
    </div>

    <div class="col-md-12 orderdetails-block">
        <!--<h4>ORDER SUMMARY</h4>-->
        @include('layouts.shopping-cart')
    </div>
    
</div>
@include('layouts.footer')
@endsection
