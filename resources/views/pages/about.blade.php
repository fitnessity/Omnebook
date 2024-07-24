@extends('layouts.business.header')
@section('content')

    <link rel='stylesheet' type='text/css' href="{{url('/public/css/frontend/general.css')}}">
    <link rel='stylesheet' type='text/css' href="{{url('/public/css/responsive.css')}}">


<section class="main-slider inner-banner" style="background-image:url('/public/images/about-bg.jpg')">
    <div class="container">
        <h1>{{ $pageTitle }}</h1>
    </div>
</section>

<section class="breadcrumbs">
  <div class="container">
      <ul>
        <li><a href="/">HOME</a></li><li><i class="fa fa-angle-right"></i>
      </li>
        <li>{{ $pageTitle }}</li>
        </ul>
    </div>
</section>
  <section class="about-block">
    <div class="about-two">
      <div class="container">
          
        <div class="about-left">
          <div class="about-left-right-para" style="padding: 10px;">
            {!! $pageContent !!}
          </div>
        </div>
        <div class="about-right">
          <!-- <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>about-sport.png" style="width:770px !important;margin-top:50px"/> -->
        </div>
      </div>
    </div>
  </section>
  @include('layouts.business.footer')
@endsection