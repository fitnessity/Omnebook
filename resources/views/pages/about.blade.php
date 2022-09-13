@extends('layouts.header')
@section('content')

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
          <div class="about-left-right-para">
            {!! $pageContent !!}
          </div>
        </div>
        <div class="about-right">
          <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>about-sport.png" style="width:770px !important;margin-top:50px"/>
        </div>
      </div>
    </div>
  </section>

 <!--  <section class="about-block">
    <div class="about-two">
      <div class="container">
        <div class="card">
          <div class="card-header" style="text-align: center;"><h1>DISCOVER MORE AND  LIVE ACTIVELY</h1></div>
        </div>
        <p style="text-align: center;">We believe in creating opportunities for our users to stay healthy and active while connecting to a community that's get them.</p></br>
        <p style="color:red; text-align: center">Some Platform Features</p></br>
        <div class="row justify-content-center">
          <div class="col-md-4">
            <img style="float: left;" src="http://fitnessity.co/public/images/user.png" alt="img" height="50px;" width="50px;">
            <h4 style="color: red;">Multi-Sports,Wellness & Active Experiences</h4>
          </br>
              <p>Fitnessity helps fitness enthusiasts, athletes, and newcomers take on being active differently. Getting in shape or getting involved with sports  and wellness has a different motivation from person to person. What motivates one person to be active might not motivate the other. Fitnessity creates the ability to book one-on-one lessons, group classes, and active adventures on one site.</p>
          </div>
          <div class="col-md-4">

             <img style="float: left;" src="http://fitnessity.co/public/images/user.png" alt="img" height="50px;" width="50px;">
            <h4 style="color: red;">Scheduling, Booking & Payments</h4>
          </br>
              <p>Never ask, "what time works for you?" again. Book directly with hundreds of businesses and new view real-time avalibility. Book personal training, classes, activities, adventures and experiences, all while paying securely online.</p>


          </div>
          <div class="col-md-4">
             <img style="float: left;" src="http://fitnessity.co/public/images/user.png" alt="img" height="50px;" width="50px;">
            <h4 style="color: red;">Social Networking, Notifications and private mMessaging (Comming Soon)</h4>
          </br>
              <p>Motivation plays an essential role in excercising. Without it, working out becomes working. share your experience, network with friends and instructors, send private messages to discuss your needs, or chat. Fitnessity uses the network to not only connect with others but to use it as an accountability partner.  </p>
          </div>
        </div>


      </div>
    </div>
  </section> -->

@include('layouts.footer')
@endsection