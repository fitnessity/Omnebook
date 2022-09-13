@extends('layouts.app')



@section('content')

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
<style>
  .hiw_cus_first, ol{
    padding: 20px 0px !important;
  }
  .hiw_professoinal{
    padding-top: 30px;
  }
  .hiw_find_studios{
    padding-top: 50px
  }
  .hiw_adventures_activities{
    padding-top: 50px;
    padding-bottom:50px;
  }
</style>


<section class="main-slider inner-banner">

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



<section class="about-block">

  <div class="about-services-title">

    <h1>WHY &nbsp; FITNESSITY</h1>

  </div> 

  <div class="container pad-20">

      <div class="row pad-30">

        <div class="col-md-12">

          <div class="col-md-6 works-heading">

            <h3>Multiple Options On One Platform</h3>

            <p>Not only can you book sports, lessons, classes, or adventures with Fitnessity, but you can get involved with thousands like you with our fitness community by creating a free profile.</p>

          </div>

          <div class="col-md-6 works-heading no-mb">

            <h3>Compare Programs And Prices</h3>

            <p>Know before you book. Compare 16 facts about each business, their offers, reviews, certifications, prices and much more.</p>

          </div>

        </div>

      </div>

      <div class="row pad-50 np">

        <div class="col-md-12">

          <div class="col-md-6  works-heading">

            <h3>Faster Booking Experience</h3>

            <p>Fitnessity gives you options when choosing how you want to book an activity. Bookings are usually 5 minutes or less.</p>

          </div>

          <div class="col-md-6 works-heading no-mb">

            <h3>Verified Reviews</h3>

            <p>People who use Fitnessity read the reviews and comments left by other users when making a booking choice.</p>

          </div>

        </div>

      </div>

  </div>

</section>



<section class="category bk-color-black">

    <div class="steps-block">

        <h1 class="color-white">It's Easy</h1>

        <p>We’ve simply made booking a lesson, class or adventurous activities easier faster and more convenient from one source. With secure payments and verified reviews, Fitnessity is the simplest and safest way to find your next activity.</p>

        <div class="col-sm-12">

            <div class="line-process-home"></div>

            <div class="row">

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 steps">

                    <span class="step-active step_1">1</span>

                    <div class="steps-footer color-white font-18">CHOOSE A SPORT, CLASS OR ADVENTURE TO GET STARTED</div>

                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 steps">

                    <span class="step-active step_2">2</span>

                    <div class="steps-footer color-white font-18">OPTION IS YOURS WHEN YOU CHOOSE HOW YOU CONNECT WITH A SERVICE PROVIDER</div>

                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 steps pull-right">

                    <span class="step-active step_3">3</span>

                    <div class="steps-footer color-white font-18">COMPARE PROFILES, PRICES AND HIRE THE BEST SERVICE PROVIDER FOR YOU</div>

                </div>

            </div>

        </div>

    </div>

</section>



<section class="about-block"> 

  <div class="container">

      <div class="row hiw_professoinal">

        <div class="col-md-12">

          <div class="col-md-6">

            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>howItWorks_image1.jpg" style="width: 100%;height: auto;" />

          </div>

          <div class="col-md-6">

            <h2 class="subheading">PROFESSIONALS</h2>

            <p style="padding-top: 20px">

              <b>TAKE YOUR FITNESS TO THE NEXT LEVEL</b>

                Looking for a new challenge or need some additional motivation? Book a session with a personal trainer, coach, instructor or therapist. Searching for local professionals that are highly skilled inmultiple sports and fitness activities has never been faster and easier.

                </p>

          </div>

        </div>

      </div>

      <div class="row hiw_find_studios">

        <div class="col-md-12">

          <div class="col-md-6 ">

            <h2 class="subheading">FIND STUDIOS AND BOOK CLASSES</h2>

            <p style="padding-top: 20px">

              <b>FINDSTUDIOS AND CLASSES NEAR YOU</b>

                Search for popular studios or hard to find local favorites that offerclasses for kids and adults that interest you. You can see a business’s options when looking to try something out or join as a member. 

                </p>

          </div>

          <div class="col-md-6">

            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>howItWorks_image2.jpg" style="width: 100%;height: auto;"/>

          </div>

          

        </div>

      </div>

      <div class="row hiw_adventures_activities">

        <div class="col-md-12">

          <div class="col-md-6">

            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>howItWorks_image3.jpg" style="width: 100%;height: auto;"/>

          </div>

          <div class="col-md-6">

            <h2 class="subheading">ADVENTURES & ACTIVITIES</h2>

            <p style="padding-top: 20px">

              <b>GET MORE OUT OF YOUR ADVENTURES</b>

                Whether you’re looking for your next weekend activity or looking to plan an activity on your next vacation. Fitnessity helps you get closer to participating in activities you love or helps you find a new one. 

                </p>

          </div>

        </div>

      </div>

  </div>

</section>



<section class="main-slider">

  <div class="row">

    <div class="col-md-12">

      <div class="flexslider" id="home_page_banners">

          <ul class="slides">

              <li>

                <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>how-it-works-bg.jpg" style="

      height: 500px;"/>

              </li>

          </ul>

      </div>

      <div class="slider-block-2">

          <h2 class="block-h2">Grow your business with Fitnessity</h2>



            <p class="block-u-p">Showcase Your Business</p>



            <p class="block-paragraph">Fitnessity was designed by fitness professionals for fitness professionals and we provide valuable tools to help you grow your business get noticed. Coaches, personal trainers, instructors, physical therapist, local studios, and businesses offering lessons, classes, and adventures in multiple sports and activities who all benefit from Fitnessity.</p>



            <a href="auth/registerBusiness" class="block-button" style="">CREATE A FREE BUSINESS PROFILE</a>



            <p class="block-footer">YOUR FAVORITE LESSONS, CLASS, TRAINER, STUDIO, OR ADVENTURE NOT LISTED ON FITNESSITY? <a data-toggle="modal" id="btn_feedback" data-target="#feedback_modal" href="/feedback/jsModalfeedback">SEND A SUGGESTION</a>.

            </p>

      </div>

    </div>

  </div>

</section>

@endsection