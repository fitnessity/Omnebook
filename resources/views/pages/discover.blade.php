@extends('layouts.header')
@section('content')
<style>
.btn-style-one {
    position: relative;
    display: inline-block;
    font-size: 14px;
    line-height: 30px;
    color: #ffffff;
    padding: 10px 30px;
    font-weight: 500;
    overflow: hidden;
    border-radius: 50px;
    overflow: hidden;
    text-transform: capitalize;
    background-color: #f91942;
    font-family: 'Montserrat', sans-serif;
    cursor: pointer;
}

.btn-style-one:hover {
    color: #ffffff;
    background: #000;
}
</style>
<section class="main-slider inner-banner" style="background-image:url('/public/images/full-offer-banner.jpg')">
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

<div class="about-services">
    <div class="container">
        {!!html_entity_decode($pageContent)!!}   
    </div>
    <div class="row">
        <div class="col-md-10 text-right">
            <button type="button" class="btn-style-one" onclick="location.href = '/instant-hire'">Explore Now <i class="fa fa-arrow-right"></i></button>
        </div>
    </div>
</div>   

@include('layouts.footer')  
@endsection