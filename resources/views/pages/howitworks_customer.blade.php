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

  <div class="container">

      <div class="row">

        <div class="col-md-12">

          <div class="col-md-1"></div>

          <div class="col-md-10">

            <p>It's easy. We’ve simply made booking alesson, class oradventurous activities easier faster and more convenient from one source. With secure payments and verified reviews,Fitnessity is the simplest and safest way to find your next activity.

            </p>

            <ol class="hiw_cus_first">

              <li>1.  CHOOSE A SPORT, CLASS OR ADVENTURE TO GET STARTED</li>

              <li>2.  OPTION IS YOURS WHEN YOU CHOOSE HOW YOU CONNECT WITH A SERVICE PROVIDER</li>

              <li>3.  COMPARE PROFILES, PRICES AND HIRE THE BEST SERVICE PROVIDER FOR YOU</li>

            </ol>

            <div class="about-title" style="padding: 10px 0px;">

              <h1 style="margin: 0px;padding: 0px;">WHY &nbsp; FITNESSITY</h1>

            </div>

            <ol>

              <li>

                <b>1.  MULTIPLE OPTIONS ON ONE PLATFORM</b>

                <p style="padding-left: 15px;">Not only can you book sports, lessons, classes,or adventures with Fitnessity, but you can get involved with thousands like you with our fitness community by creating a free profile.

                </p>

              </li>

              <li style="padding-top: 10px">

                <b>2.  COMPARE PROGRAMS AND PRICES</b>

                <p style="padding-left: 15px;">Know before you book. Compare 16 facts about each business, their offers, reviews, certifications,prices and much more.

                </p>

              </li>

              <li style="padding-top: 10px">

                <b>3.  FASTER BOOKING EXPEREINCE</b>

                <p style="padding-left: 15px;">Fitnessity give you options when choosing how you want to book an activity. Bookings are usually 5 minutes or less.

                </p>

              </li>

              <li style="padding-top: 10px">

                <b>4.  VERIFIED REVIEWS</b>

                <p style="padding-left: 15px;">People who use Fitnessity read the reviews and comments left by other users when making a booking choice.

                </p>

              </li>

            </ol>

          </div>

          <div class="col-md-1"></div>

        </div>

      </div>

  <!-- </div>

  <div class="container"> -->

      <div class="row hiw_professoinal">

        <div class="col-md-12">

          <div class="col-md-6">

            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>howItWorks_image1.jpg" style="width: 100%;height: auto;"/>

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

          <div class="col-md-6">

            <h2 class="subheading">FIND STUDIOS AND BOOK CLASSES</h2>

            <p style="padding-top: 20px">

              <b>FINDSTUDIOS AND CLASSES NEAR YOU</b>

                Search for popular studios or hard to find local favorites that offerclasses for kids and adults that interest you. You can see a business’s options when looking to try something out or join as a member. 

                </p>

          </div>

          <div class="col-md-6">

            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>howItWorks_image2.jpg" style="width: 100%;height: auto;" />

          </div>

          

        </div>

      </div>

      <div class="row hiw_adventures_activities">

        <div class="col-md-12">

          <div class="col-md-6">

            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>howItWorks_image3.jpg" style="width: 100%;height: auto;" />

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

   

@endsection