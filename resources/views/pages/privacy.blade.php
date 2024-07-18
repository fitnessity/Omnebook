@extends('layouts.business.header')
@section('content')
<head>
    <link rel='stylesheet' type='text/css' href="{{env('APP_URL')}}<?php echo Config::get('constants.FRONT_CSS'); ?>frontend/general.css">
    <link rel='stylesheet' type='text/css' href="{{env('APP_URL')}}<?php echo Config::get('constants.FRONT_CSS'); ?>css/responsive.css">
</head>

  <section class="inner-banner pmt-105" style="background-image:url('/public/uploads/cms/{{ $banner_image }}')">
      <div class="container">
            <h1>{{ $pageTitle }}</h1>
      </div>
  </section>
  <section class="breadcrumbs">
  <div class="container">
      <ul>
        <li><a href="/">HOME    </a></li><li><i class="fa fa-angle-right"></i>
      </li>
        <li>{{ $pageTitle }}</li>
        </ul>
    </div>
</section>
  <section class="privacy-block">

  <div class="container">
      <div class="about-title">
          <!-- <h1>{{ $pageTitle }}</h1> -->
        <div class="pagecontent">  {!!html_entity_decode($content)!!}  </div>
        </div>
    </div>

  </section>
  @include('layouts.business.footer')
@endsection