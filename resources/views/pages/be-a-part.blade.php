@extends('layouts.header')
@section('content')

<section class="main-slider inner-banner" style="background-image:url('/public/images/beapart-easy-bg.jpg')">
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
          <div class="about-left-right-para">
            {!! $pageContent !!}
          </div>
        </div>
        <div class="about-right">
          <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>left-signup-img.jpg" width="500px" style="margin-bottom:50px" />
        </div>
      </div>
    </div>
  </section>

@include('layouts.footer')
@endsection