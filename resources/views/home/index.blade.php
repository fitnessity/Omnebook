@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')
@section('content')
@include('includes.search_banner')
<style>
form#frmlogin input {
    border-radius: 0;
    border: 1px solid;
}
    .jumbotron.second{
        margin-top: 850px;
    }
    .jumbotron.second h3{
        font-size: 32px;
    letter-spacing: 0px;
    line-height: 1.2em;
    }
    .category{
        padding: 58px 50px;
    }
    .static_section h5 {
    font-size: 18px;
    font-weight: 600;
}
.slider-block button:hover{color:#f53b49;}
.container.static_section .card{min-height: 175px;}
.card_img{max-width:100%;}
.container.static_section button.btn.btn-web-btn{text-transform: capitalize !important;}
.card .btn-web-btn{border-radius: 0px !important;}
.card_img{margin: 15px 0 15px 10px;border-radius: 50%;}
.card-claimed-businessnew a:focus {
    color: #337ab7 !important;
}
</style>
<section class="category">
    <div class="cat-container">
		<div class="about-services-title" style="margin-bottom:3%">
        	<h1>What Do You Like To Do?</h1>
            <h3>Get Connect to a wide range of multi-sports, wellness, and active activities</h3>	
    	</div> 
        <div class="cate-sidebar hp">
            <h1>SELECT ACTIVITY</h1>
            <ul class="select_activity_hp">
                @foreach($product_categories as $key => $value)
                    @if($value->category_name != 'TRAINING FACILTIES')
                    <li><a href="javascript:void(0)" id="category_id_{{$value->id}}" class="search_by_category" @if($value->id==1) style="font-weight: 500;" @endif>{{$value->category_name}} <i class="fa fa-angle-right"></i></a></li>
                    @endif
                @endforeach
                <li><a class="btn btn-web-btn" href="{!! route('list-all-sports') !!}" style="font-size: 14px;padding: 10px;font-weight: bold;">VIEW ALL SPORTS</a></li>
            </ul>
        </div>
        <div class="cate-list owl-carousel hp" id="owl-demo-category">
        @foreach($most_searched_sports as $sports_key => $sports_value)
            <div class="cat-item style_prevu_sp item">

                <span>

                <div class="cat-img-name">

                <span><div class="sports_name"><span>{{ $sports_value->sport_name }}</span></div></span>

                    <img src="<?php echo Config::get('constants.SPORTS_IMAGE_THUMB'); ?>{{ $sports_value->image }}" height="466" width="313" alt="Fitnessity" /><p>&nbsp;</p>

                    <div class="pop-search-detail-sports">

                        <!-- <p>{{ $sports_value->description }} </p> -->

                        <h4>{{ $sports_value->sport_name }}</h4>

                        <h5>{{ $sports_value->description }}</h5>

                    </div>

                </div>

                <div class="cat-detail">

                    <h1>{{ $sports_value->sport_name }}</h1>

                    @if($sports_value->has_child == 1)

                        <a type="button" data-toggle="modal" data-target="#child_sports_modal" href="/home/jsModalChildSports/{{ $sports_value->sport }}">Book Now</a>

                    @else

                        @if(Auth::user())

                            @if($sports_value->booking_option == 'Professional')

                           {{-- <a title="Click here to book professional" data-toggle="modal" data-target="#lesson_modal" href="/lesson/jsModallesson/booklesson/{{ $sports_value->id }}">

                                Book Now

                            </a> --}}

                            <a title="Click here to book professional" class="gf" sp_id="{{$sports_value->booking_option}}" data-toggle="modal" data-target="#lesson_modal" href="/lesson/jsModallesson/booklesson/{{ $sports_value->id }}">

                                Book Now

                            </a>

                            @elseif($sports_value->booking_option == 'All') 

                                <a title="Click here to book professional" class="gf" sp_id="{{$sports_value->booking_option}}" data-toggle="modal" data-target="#lesson_modal" href="/lesson/jsModallesson/booklesson/{{ $sports_value->id }}">

                                Book Now

                            </a>

                            @else

                            <a  class="gf" sp_id="{{$sports_value->bookng_option}}" href= "<?php echo '/direct-hire?selected_sport='.$sports_value->id; ?>">Book Now</a>

                            @endif

                         @else

                            <a type="button" data-toggle="modal" data-target="#login_modal" href="/auth/jsModallogin/{{ $sports_value->id }}" title="Login to book professional">Book Now

                            </a>

                         @endif

                    @endif

                </div>

            </span>

            </div>

        <?php if($sports_key == 4) break; ?>

        @endforeach

        </div>



    </div>

      <br><br>

    <!-- login modal -->

    <div class="modal fade" id="child_sports_modal" role="dialog">

      <div class="modal-dialog modal-lg" style="width:90%">

            <div class="modal-content" id="child_sports_modal_content"></div>

      </div>

    </div>

</section>



<!-- <section class="category" style="background:#151820;">

    <div class="steps-block">

        <h1 style="color:white;">How dose it works?</h1>

        <div class="col-sm-12">

            <div class="line-process-home"></div>

            <div class="row">

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 steps">

                    <span class="step-active step_1">1</span>

                    <div class="steps-footer" style="color:white;font-size:18px;">Answer a few questions about your needs</div>

                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 steps">

                    <span class="step-active step_2">2</span>

                    <div class="steps-footer" style="color:white;font-size:18px;">Available pros submit quotes within 24 hours</div>

                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 steps pull-right">

                    <span class="step-active step_3">3</span>

                    <div class="steps-footer" style="color:white;font-size:18px;">Compare your quotes & hire the best pro</div>

                </div>

            </div>

        </div>

    </div>

</section> -->

<div class="jumbotron second">

         <h3 class="text-center"><b>EXPLORE AND RESERVE YOUR SPOT IN AN ACTIVITY<br>

            HAPPENING IN THE NEXT 24 HRS. LOCALLY OR ONLINE </b>

         </h3>

      </div>

      <div class="arrow-bottom"></div>

      <br>

      <div class="container static_section">

         <h5>ONLINE CLASSES & ACTIVITIES  &nbsp;&nbsp;&nbsp; <a href="/instant-hire">View all ></a></h5>

         <br><br>

         <div class="row">

            <div class="col-md-3">

               <div class="card">

                  <div class="row">

                     <div class="col-md-6">

                        <p><b>Thu 1:45 PM</b></p>

                     </div>

                     <div class="col-md-6 text-right">

                        <span class="badge badge-pill badge-dark">45 min</span>

                     </div>

                  </div>

                  <div class="row">

                     <div class="col-md-4">

                        <img src="https://kellyewhitney.files.wordpress.com/2018/03/jack-dorsey.jpeg?w=256&h=256&crop=1" class="img-fluid card_img" alt="Fitnessity">

                     </div>

                     <div class="col-md-8">

                        <p style="margin-top: 12px;"><b style="font-size: 20px;">Soul Ride/Spin</b><br>She Fit Studio</p>

                     </div>

                  </div>

                  <div class="row">

                     <div class="col-md-4">

                        <button type="button" class="btn btn-web-btn" style="border-radius: 0px;font-size: 14px;padding: 2px 7px;">Join Now</button>

                     </div>

                     <div class="col-md-4 text-center">

                        <p><b>$22.00</b></p>

                     </div>

                     <div class="col-md-4 text-right">

                        <button type="button" class="btn btn-web-btn" style="border-radius: 0px;font-size: 14px;padding: 2px 15px;">Live</button>

                     </div>

                  </div>

               </div>

            </div>

            <div class="col-md-3">

               <div class="card">

                  <div class="row">

                     <div class="col-md-6">

                        <p><b>Thu 1:45 PM</b></p>

                     </div>

                     <div class="col-md-6 text-right">

                        <span class="badge badge-pill badge-dark">45 min</span>

                     </div>

                  </div>

                  <div class="row">

                     <div class="col-md-4">

                        <img src="https://kellyewhitney.files.wordpress.com/2018/03/jack-dorsey.jpeg?w=256&h=256&crop=1" class="img-fluid card_img" alt="Fitnessity">

                     </div>

                     <div class="col-md-8">

                        <p style="margin-top: 12px;"><b style="font-size: 20px;">Soul Ride/Spin</b><br>She Fit Studio</p>

                     </div>

                  </div>

                  <div class="row">

                     <div class="col-md-4">

                        <button type="button" class="btn btn-web-btn" style="border-radius: 0px;font-size: 14px;padding: 2px 7px;">Join Now</button>

                     </div>

                     <div class="col-md-4 text-center">

                        <p><b>$22.00</b></p>

                     </div>

                     <div class="col-md-4 text-right">

                        <button type="button" class="btn btn-web-btn" style="border-radius: 0px;font-size: 14px;padding: 2px 15px;">Live</button>

                     </div>

                  </div>

               </div>

            </div>

            <div class="col-md-3">

               <div class="card">

                  <div class="row">

                     <div class="col-md-6">

                        <p><b>Thu 1:45 PM</b></p>

                     </div>

                     <div class="col-md-6 text-right">

                        <span class="badge badge-pill badge-dark">45 min</span>

                     </div>

                  </div>

                  <div class="row">

                     <div class="col-md-4">

                        <img src="https://kellyewhitney.files.wordpress.com/2018/03/jack-dorsey.jpeg?w=256&h=256&crop=1" class="img-fluid card_img" alt="Fitnessity">

                     </div>

                     <div class="col-md-8">

                        <p style="margin-top: 12px;"><b style="font-size: 17px;">Adaptive Partner Chair Yoga</b><br>Laura Nash</p>

                     </div>

                  </div>

                  <div class="row">

                     <div class="col-md-4">

                        <button type="button" class="btn btn-web-btn" style="border-radius: 0px;font-size: 14px;padding: 2px 7px;">Join Now</button>

                     </div>

                     <div class="col-md-4 text-center">

                        <p><b>$22.00</b></p>

                     </div>

                     <div class="col-md-4 text-right">

                        <button type="button" class="btn btn-web-btn" style="border-radius: 0px;font-size: 14px;padding: 2px 15px;">Live</button>

                     </div>

                  </div>

               </div>

            </div>

            <div class="col-md-3">

               <div class="card">

                  <div class="row">

                     <div class="col-md-6">

                        <p><b>Thu 1:45 PM</b></p>

                     </div>

                     <div class="col-md-6 text-right">

                        <span class="badge badge-pill badge-dark">45 min</span>

                     </div>

                  </div>

                  <div class="row">

                     <div class="col-md-4">

                        <img src="https://kellyewhitney.files.wordpress.com/2018/03/jack-dorsey.jpeg?w=256&h=256&crop=1" class="img-fluid card_img" alt="Fitnessity">

                     </div>

                     <div class="col-md-8">

                        <p style="margin-top: 12px;"><b style="font-size: 17px;">TOTAL Body Training</b><br>Akin Fitness COACH</p>

                     </div>

                  </div>

                  <div class="row">

                     <div class="col-md-4">

                        <button type="button" class="btn btn-outline-secondary" style="border-radius: 0px;font-size: 14px;padding: 5px 15px;">Sign Up</button>

                     </div>

                     <div class="col-md-4 text-center">

                        <p style="margin-top: 3px;"><b>$22.00</b></p>

                     </div>

                     <div class="col-md-4 text-right">

                        <p style="font-size: 12px;font-weight:bold; color: gray;font-weight: bold;margin-top: 5px;">Starts in 10 min</p>

                     </div>

                  </div>

               </div>

            </div>

         </div>

         <br><br><br><br>

         <h5>IN-PERSON CLASSES & ACTIVITIES &nbsp;&nbsp;&nbsp; <a href="/instant-hire">View all ></a></h5>

         <br><br>

         <div class="row">

            <div class="col-md-3">

               <div class="card">

                  <div class="row">

                     <div class="col-md-6">

                        <p><b>Thu 1:45 PM</b></p>

                     </div>

                     <div class="col-md-6 text-right">

                        <span class="badge badge-pill badge-dark">45 min</span>

                     </div>

                  </div>

                  <div class="row">

                     <div class="col-md-4">

                        <img src="https://kellyewhitney.files.wordpress.com/2018/03/jack-dorsey.jpeg?w=256&h=256&crop=1" class="img-fluid card_img" alt="Fitnessity">

                     </div>

                     <div class="col-md-8">

                        <p style="margin-top: 12px;"><b style="font-size: 20px;">Soul Ride/Spin</b><br>She Fit Studio</p>

                     </div>

                  </div>

                  <div class="row">

                     <div class="col-md-4">

                        <button type="button" class="btn btn-web-btn" style="border-radius: 0px;font-size: 14px;padding: 2px 7px;">Join Now</button>

                     </div>

                     <div class="col-md-4 text-center">

                        <p><b>$22.00</b></p>

                     </div>

                     <div class="col-md-4 text-right">

                        <button type="button" class="btn btn-web-btn" style="border-radius: 0px;font-size: 14px;padding: 2px 15px;">Live</button>

                     </div>

                  </div>

               </div>

            </div>

            <div class="col-md-3">

               <div class="card">

                  <div class="row">

                     <div class="col-md-6">

                        <p><b>Thu 1:45 PM</b></p>

                     </div>

                     <div class="col-md-6 text-right">

                        <span class="badge badge-pill badge-dark">45 min</span>

                     </div>

                  </div>

                  <div class="row">

                     <div class="col-md-4">

                        <img src="https://kellyewhitney.files.wordpress.com/2018/03/jack-dorsey.jpeg?w=256&h=256&crop=1" class="img-fluid card_img" alt="Fitnessity">

                     </div>

                     <div class="col-md-8">

                        <p style="margin-top: 12px;"><b style="font-size: 17px;">Adaptive Partner Chair Yoga</b><br>Laura Nash</p>

                     </div>

                  </div>

                  <div class="row">

                     <div class="col-md-4">

                        <button type="button" class="btn btn-web-btn" style="border-radius: 0px;font-size: 14px;padding: 2px 7px;">Join Now</button>

                     </div>

                     <div class="col-md-4 text-center">

                        <p><b>$22.00</b></p>

                     </div>

                     <div class="col-md-4 text-right">

                        <button type="button" class="btn btn-web-btn" style="border-radius: 0px;font-size: 14px;padding: 2px 15px;">Live</button>

                     </div>

                  </div>

               </div>

            </div>

            <div class="col-md-3">

               <div class="card">

                  <div class="row">

                     <div class="col-md-6">

                        <p><b>Thu 1:45 PM</b></p>

                     </div>

                     <div class="col-md-6 text-right">

                        <span class="badge badge-pill badge-dark">45 min</span>

                     </div>

                  </div>

                  <div class="row">

                     <div class="col-md-4">

                        <img src="https://kellyewhitney.files.wordpress.com/2018/03/jack-dorsey.jpeg?w=256&h=256&crop=1" class="img-fluid card_img" alt="Fitnessity">

                     </div>

                     <div class="col-md-8">

                        <p style="margin-top: 12px;"><b style="font-size: 17px;">TOTAL Body Training</b><br>Akin Fitness COACH</p>

                     </div>

                  </div>

                  <div class="row">

                     <div class="col-md-4">

                        <button type="button" class="btn btn-outline-secondary" style="border-radius: 0px;font-size: 14px;padding: 5px 15px;">Sign Up</button>

                     </div>

                     <div class="col-md-4 text-center">

                        <p style="margin-top: 3px;"><b>$22.00</b></p>

                     </div>

                     <div class="col-md-4 text-right">

                        <p style="font-size: 12px;font-weight:bold;color: gray;margin-top: 5px;">Starts in 10 min</p>

                     </div>

                  </div>

               </div>

            </div>

            <div class="col-md-3">

               <div class="card">

                  <div class="row">

                     <div class="col-md-6">

                        <p><b>Thu 1:45 PM</b></p>

                     </div>

                     <div class="col-md-6 text-right">

                        <span class="badge badge-pill badge-dark">45 min</span>

                     </div>

                  </div>

                  <div class="row">

                     <div class="col-md-4">

                        <img src="https://kellyewhitney.files.wordpress.com/2018/03/jack-dorsey.jpeg?w=256&h=256&crop=1" class="img-fluid card_img" alt="Fitnessity">

                     </div>

                     <div class="col-md-8">

                        <p style="margin-top: 12px;"><b style="font-size: 17px;">TOTAL Body Training</b><br>Akin Fitness COACH</p>

                     </div>

                  </div>

                  <div class="row">

                     <div class="col-md-4">

                        <button type="button" class="btn btn-outline-secondary" style="border-radius: 0px;font-size: 14px;padding: 5px 15px;">Sign Up</button>

                     </div>

                     <div class="col-md-4 text-center">

                        <p style="margin-top: 3px;"><b>$22.00</b></p>

                     </div>

                     <div class="col-md-4 text-right">

                        <p style="font-size: 12px;font-weight:bold; color: gray;font-weight: bold;margin-top: 5px;">Starts in 10 min</p>

                     </div>

                  </div>

               </div>

            </div>

         </div>

      </div>

      <br><br>

<section class="top-rank why_fitnessity_tr_hp">

    <div class="about-services-title">

        <h1>WHY &nbsp; FITNESSITY</h1>

    </div> 

    <div class="container pad-20 why_fitnessity_tr_hp">

      <div class="row pad-30">

        <div class="col-md-12">

          <div class="col-md-6 works-heading">

            <h3>A Comprehensive List of Activities & Businesses</h3>

            <p>Search thousands of local businesses and find activities you love when you need it.

Finding the right place for your workouts and activities can be time-consuming and tricky, from small studios to large gyms, to trainers, coaches, and more. There are so many options. With Fitnessity, we compiled all sports and wellness activities on one site. 

</p>

          </div>

          <div class="col-md-6 works-heading compare_hp">

            <h3>Online Booking with Options</h3>

            <p>It's not enough to handle all of your fitness and wellness needs. We give you options for how you can participate in different activities. You can participate 1-on-1 with a personal trainer, in a group class, or part of an adventure. The option is yours. We handle all scheduling and payments securely online on your behalf.</p>

          </div>

        </div>

      </div>

      <div class="row pad-50 why_fitnessity_hp">

        <div class="col-md-12">

          <div class="col-md-6  works-heading">

            <h3>Get Motivated</h3>

            <p>Let Fitnessity take care of you by becoming your accountability partner. 

Participate in activities alone, with family, friends, or a group. We create a community within your community and help you network and meet new people that are like you. 

</p>

          </div>

          <div class="col-md-6 works-heading last">

            <h3>Compare Programs and Prices</h3>

            <p>With a reduced search time, we also made it faster for you to compare services. When using Instant Hire, use the Add to Compare feature to compare up to 3 businesses side by side. Compare your favorite activity and service provider side by side. Get details about the programs, staff, reviews, prices, certifications, and much more. </p>

          </div>

        </div>

      </div>

    </div>

</section>



<section class="category" style="background:#151820;">

    <div class="steps-block">

        <h1 class="color-white">Its Easy</h1>

        <p>Fitnessity is the simplest and safest way to find your next activity. We take care of all your bookings, scheduling, payments, vetting service providers and making sure you are safe.</p>

        <div class="col-sm-12">

            <div class="line-process-home"></div>

            <div class="row">

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 steps">

                    <span class="step-active step_1">Step 1</span>

                    <div class="steps-footer color-white font-18">CHOOSE AN ACTIVITIY TO GET STARTED</div>

                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 steps">

                    <span class="step-active step_2">Step 2</span>

                    <div class="steps-footer color-white font-18">CONNECT WITH SERVICE PROVIDERS THROUGH MULTIPLE OPTIONS</div>

                </div>

                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 steps pull-right">

                    <span class="step-active step_3">Step 3</span>

                    <div class="steps-footer color-white font-18">HIRE THE BEST SERVICE PROVIDER FOR YOU…AND GET GOING</div>

                </div>

            </div>

        </div>

    </div>

</section>

<section class="top-rank why_fitnessity_tr_hp">

    <div class="about-services-title">

        <h1 style="background: unset;">GET CONNECTED TO ACTIVITIES YOU LOVE OR EXPLORE A NEW ONE</h1> 
        <hr style="margin-top: -50px;margin-bottom: 30px;border: 0;border-top: 4px solid #f53b49;width:50%; margin-left:25% !important; margin-right:25% !important;">
        <p style="color: black;margin-top: -20px;padding-bottom: 20px;">Find activities with local experts & businesses near you: Book 1:1 lessons, group classes, and active experiences on one site.</p>

    </div> 

    <div class="container pad-20 why_fitnessity_tr_hp">
      <div class="row pad-50 why_fitnessity_hp">

          <div class="col-md-4  works-heading" style="min-height: 375px;">
            <img src="{{ asset('public/images/sporty-black.jpg') }}" style="width: 100%;padding: 10px 0px;border-radius: 33px;height: 260px;" alt="Fitnessity">
            <h4 style="font-weight: bold;text-transform: uppercase;">FIND ACTIVITES ONLINE</h4>

            <p>Experience activities you love without leaving your home</p>

          </div>

          <div class="col-md-4 works-heading" style="min-height: 375px;">
             <img src="{{ asset('public/images/private-lessons-header.jpg') }}" style="width: 100%;padding: 10px 0px;border-radius: 33px;height: 260px;" alt="Fitnessity">

            <h4 style="font-weight: bold;text-transform: uppercase;">FIND 1:1 PERSONAL TRAINING AND COACHING LESSONS</h4>

            <p>Connect with personal trainers, fitness, health and life coaches, instructors, therapist, nutritionists, and more.</p>

          </div>
          <div class="col-md-4 works-heading" style="min-height: 375px;">
             <img src="{{ asset('public/images/hitt_training.jpeg') }}" style="width: 100%;padding: 10px 0px;border-radius: 33px;height: 260px;" alt="Fitnessity">

            <h4 style="font-weight: bold;text-transform: uppercase;">FIND CLASSES NEAR YOU </h4>

            <p>Search for experts or hard to find local favorites that offer classes.</p>

          </div>
           <div class="col-md-4  works-heading" style="min-height: 375px;">
            <img src="{{ asset('public/images/kayak.jpg') }}" style="width: 100%;padding: 10px 0px;border-radius: 33px;height: 260px;" alt="Fitnessity">
            <h4 style="font-weight: bold;text-transform: uppercase;">FIND ACTIVE EXPERIENCES </h4>

            <p>Turn your weekend or planned vacation into an adventure.</p>

          </div>
         <div class="col-md-4  works-heading" style="min-height: 375px;">
            <img src="{{ asset('public/images/Balsam_Mountain.jpg') }}" style="width: 100%;padding: 10px 0px;border-radius: 33px;height: 260px;" alt="Fitnessity">
            <h4 style="font-weight: bold;text-transform: uppercase;">FIND ACTIVITIES AND EXPERIENCES FOR KIDS</h4>

            <p>Keep your child busy with active activities. Find camps, clinics, local teams, classes, adventures, and more to keep them engages and active.
HAPPENING NOW SECTION TITLE
</p>

          </div>

          
        

      </div>

    </div>

</section>

<section class="top-rank why_fitnessity_tr_hp">

    <div class="container-fluid pad-20 why_fitnessity_tr_hp">
      <div class="row pad-50 why_fitnessity_hp" style="margin-right: -65px;margin-left: -65px;">
          <div class="col-md-4" style="background: black;min-height: 452px;border-radius: 8%;padding: 20px 20px;">
              <h4 style="color: #ffff;text-align: center;font-size: 22px;font-weight: bold;text-transform: uppercase;margin-top: 20px;">Fitnessity For Business</h4>
              <p style="color: #ffff;font-size: 16px;line-height: 24px;margin-top: 20px;text-align: center;">Manage your free business <br>directory listing today.</p>
               <p style="color: #ffff;font-size: 16px;line-height: 24px;margin-top: 15px;text-align: center;">Update your business information, add images, videos, update business details and the services you offer, get reviews, customer leads sent directly to you, online booking and payments, communicate via our social network, gain tools to host online activities, to operate and manage your clients and more all for free.</p>
                <p style="color: #ffff;font-size: 16px;line-height: 24px;margin-top: 15px;text-align: center;">Your business not listed already? Create a free profile to get started.</p>
                <a href="/claim-your-business" class="btn btn-warning" style="background: red;border-color: red;width: 100%;padding: 10px;border-radius: 20px;font-size: 20px;text-transform: uppercase;margin-top: 30px;">Manage My Free Listing</a>
          </div>
          <!--background: url('public/images/fitness.jpg'); background-repeat: no-repeat;background-size: 100% 100%;opacity: 0.8;-->
          <div class="col-md-8" style="background: #2b2a2a;min-height: 376px;padding: 20px 20px;margin-top: 33px;">
               <h4 style="color: #ffff;text-align: center;font-size: 22px;font-weight: bold;text-transform: uppercase;margin-top: 20px;">Ready To start earning more ?</h4>
               <p style="color: #ffff;font-size: 17px;line-height: 24px;margin-top: 40px;text-align: center;">Join our directory of local experts and businesses that offer activities, services and experiences in multiple sports, wellness and adventurous catagories.</p>
               <p style="color: #ffff;font-size: 17px;line-height: 24px;margin-top: 20px;text-align: center;">Users will be able to find and book you by searching directly for your business, from our plateform recommendations, from our booking options, from your business profile, or by searching for an activity you offer.</p>
               <p style="color: #ffff;font-size: 17px;line-height: 24px;margin-top: 20px;text-align: center;">We list trainers to coaches, gyms, studios, physical therapists to tour companies.</p>
          </div>
          
      </div>

    </div>

</section>

<!-- <section class="category">

    <div class="steps-block">

        <h1>Why should i use</h1>

        <div class="signup-block-home">

            <div class="sgnup-rates mrgn-md-top">

                <div class="row">

                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

                        <div class="sgnup-rates signup-rates experience_level_div ">

                            <label name="level" style="display: none;" value="entry_level">entry_level</label>

                            <span><i class="fa fa-file-text-o"></i></span>

                            <div class="clearfix"></div>

                            <h3>Multipal Quotes</h3>

                            <p>Get several option.</p>

                        </div>

                    </div>



                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

                        <div class="sgnup-rates signup-rates experience_level_div ">

                            <label name="level" style="display: none;" value="intermediate">intermediate</label>

                            <span><i class="fa fa-tags"></i></span>

                            <div class="clearfix"></div>

                            <h3>Compare Prices</h3>

                            <p>Get a great deal.</p>

                        </div>

                    </div>



                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

                        <div class="sgnup-rates signup-rates experience_level_div ">

                            <label name="level" style="display: none;" value="expert">expert</label>

                            <span><i class="fa fa-user"></i></span>

                            <div class="clearfix"></div>

                            <h3>Verified Reviews</h3>

                            <p>Hire the best pro</p>

                        </div>

                    </div>



                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

                        <div class="sgnup-rates signup-rates experience_level_div ">

                            <label name="level" style="display: none;" value="expert">expert</label>

                            <span><i class="fa fa-repeat"></i></span>

                            <div class="clearfix"></div>

                            <h3>Free to use</h3>

                            <p>No obligation to hire</p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section> -->



<section class="top-rank hp">

    <div class="container">
		
        
         <div class="about-services-title">
		 <p style="color: black;margin-top: -20px;padding-bottom: 45px;">FIND OUT WHAT’S HAPPENING ON FITNESSITY FASTER AND SEE OUR RECOMMENDED ACTIVITIES AND LOCAL EXPERTS</p>

    </div> 
   

    <!-- <br><br> -->

        <div class="rank-sidebar">

            <h1>HAPPENING &nbsp; NOW</h1>

            <ul>

             <!--<li><a href="javascript:void(0)" id="happeningnow_topprof" rel="" class="happening_now active">- TOP INLFUENCERS</a></li>

                 <li><a href="javascript:void(0)" id="happeningnow_topprof" rel="" class="happening_now">- MOST ACTIVE MEMBERS</a></li>

                <li><a href="javascript:void(0)" id="happeningnow_PRO" rel="" class="happening_now">- TOP BOOKED PROFESSIONALS</a></li>

                <li><a href="javascript:void(0)" id="happeningnow_CLA" rel="" class="happening_now">- TOP BOOKED CLASSES</a></li>

                <li><a href="javascript:void(0)" id="happeningnow_ADV" rel="" class="happening_now">- TOP BOOKED ADVENTURES </a></li>

                <li><a href="javascript:void(0)" id="happeningnow_PROG" rel="" class="happening_now">- TOP KIDS PROGRAMS  </a></li>

                <li><a href="javascript:void(0)" id="happeningnow_Testi" rel="" class="happening_now">- MEMBER TESTIMONIALS</a> </li>-->
                
                 <li><a href="javascript:void(0)" id="happeningnow_topprof" rel="" class="happening_now active">- Popular Online Activities</a></li>

                 <li><a href="javascript:void(0)" id="happeningnow_topprof" rel="" class="happening_now">- Popular In-Person Activities </a></li>

                <li><a href="javascript:void(0)" id="happeningnow_PRO" rel="" class="happening_now">- Popular Kids Activities</a></li>

                <li><a href="javascript:void(0)" id="happeningnow_CLA" rel="" class="happening_now">- Popular Experiences</a></li>

                <li><a href="javascript:void(0)" id="happeningnow_ADV" rel="" class="happening_now">- Top Booked Instructors </a></li>

                <li><a href="javascript:void(0)" id="happeningnow_PROG" rel="" class="happening_now">- Top Booked Business  </a></li>

                

            </ul>

        </div>

        <div class="rank-list happeing_now_mayank">

            <div class="rank-item">

                <div id="owl-demo" class="owl-carousel test" style="width:100%;">



                    @foreach($professionals_list as $professionals_list_key => $professionals_list_value)

                    <?php 

                         $sports_id = $professionals_list_value->user_sports;

                        if($sports_id != '')

                        {

                            $user_sport = explode(',',$sports_id);

                             $sports_title = '';

                            foreach($user_sport as $value) {

                                if(is_numeric($value)) $sports_title .= $sport_names[$value] . ' ';

                            }

                           

                        } ?>

                    <div class="item">

                        <div class="rank-item-detail hp">

                            <img src="public/uploads/profile_pic/{{ $professionals_list_value->profile_pic }}" height="466" width="313" alt="Fitnessity" />

                            <div class="ranker-detail">

                                <p>{{ $professionals_list_value->firstname }}, {{ $professionals_list_value->lastname }}</p>

                                <p><i class="fa fa-map-marker"></i> {{ $professionals_list_value->states->state_name }}, {{ $professionals_list_value->country }} , {{ $professionals_list_value->zipcode }}</p>

                                <p><i class="fa fa-thumbs-up"></i> {{ $professionals_list_value->bookingcount }}</p>

                                <p><i class="fa fa-thumbs-up"></i> {{ $professionals_list_value->followercount }} Followers</p>

                                <p><i class="fa fa-futbol-o"></i> {{ $sports_title }}</p>  

                                <p><i class="fa fa-certificate"></i> <?php if($professionals_list_value->user_certification) echo $professionals_list_value->user_certification; else echo "NA"; ?></p>

                            </div>

                        </div>

                     <?php if(Auth::user()){ ?>
                            <a  class="happening_now_btn" href="/directhire/viewprofile/{{ $professionals_list_value->id }}">VIEW MORE <i class="fa fa-angle-right"></i> </a>
                          <?php  } else{ ?> <a  class="happening_now_btn" data-toggle="modal" data-target="#login_modal" href="/auth/jsModallogin/{{ $professionals_list_value->id }}">VIEW MORE <i class="fa fa-angle-right"></i> </a> <?php } ?>                    </div>
                    @endforeach

                    <!--<div class="item">states.state_name

                        <div class="rank-item-detail">

                            <img src="images/rank/2.jpg" height="466" width="313" alt="Fitnessity" />

                            <div class="ranker-detail">

                                <p><i class="fa fa-map-marker"></i> California, USA</p>

                                <p><i class="fa fa-thumbs-up"></i> 12 / 15</p>

                                <p><i class="fa fa-futbol-o"></i> Football Trainer</p>  

                                <p><i class="fa fa-certificate"></i> USA Football Federation</p>

                            </div>

                        </div>

                        <a href="#">VIEW MORE <i class="fa fa-angle-right"></i> </a>

                    </div>

                    <div class="item">

                        <div class="rank-item-detail">

                            <img src="images/rank/3.jpg" height="466" width="313" alt="Fitnessity" />

                            <div class="ranker-detail">

                                <p><i class="fa fa-map-marker"></i> California, USA</p>

                                <p><i class="fa fa-thumbs-up"></i> 12 / 15</p>

                                <p><i class="fa fa-futbol-o"></i> Football Trainer</p>  

                                <p><i class="fa fa-certificate"></i> USA Football Federation</p>

                            </div>

                        </div>

                        <a href="#">VIEW MORE <i class="fa fa-angle-right"></i> </a>

                    </div>

                    <div class="item">

                        <div class="rank-item-detail">

                            <img src="images/rank/1.jpg" height="466" width="313" alt="Fitnessity" />

                            <div class="ranker-detail">

                                <p><i class="fa fa-map-marker"></i> California, USA</p>

                                <p><i class="fa fa-thumbs-up"></i> 12 / 15</p>

                                <p><i class="fa fa-futbol-o"></i> Football Trainer</p>  

                                <p><i class="fa fa-certificate"></i> USA Football Federation</p>

                            </div>

                        </div>

                        <a href="#">VIEW MORE <i class="fa fa-angle-right"></i> </a>

                    </div> -->

                </div>

            </div>          

        </div>

    </div>

</section>





<!-- <section class="top-rank">



    <div class="cat-container">



        <div class="rank-sidebar">

            <h1>HAPPENING NOW</h1>

            <ul>

                <li><a href="#">- MOST ACTIVE MEMBERS</a></li>



                <li><a href="#">- TOP BOOKED PROFESSIONALS</a></li>



                <li><a href="#">- TOP BOOKED CLASSES</a></li>



                <li><a href="#">- TOP BOOKED ADVENTURES </a></li>



                <li><a href="#">- TOP KIDS PROGRAMS  </a></li>



                <li><a href="#">- MEMBER TESTIMONIALS</a> </li>

            </ul>

        </div>



        <div class="rank-list">



            <div class="rank-item">



                <div id="top_ranks_slider" class="owl-carousel">



                    <div class="item">



                        <div class="rank-item-detail">



                            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>/rank/1.jpg" height="466" width="313" alt="Fitnessity" />



                            <div class="ranker-detail">



                                <p><i class="fa fa-map-marker"></i> California, USA</p>



                                <p><i class="fa fa-thumbs-up"></i> 12 / 15</p>



                                <p><i class="fa fa-futbol-o"></i> Football Trainer</p>



                                <p><i class="fa fa-certificate"></i> USA Football Federation</p>



                            </div>



                        </div>



                        <center><button type="button" class="btn btn-info btn-lg header-right-menu" 

                        href="#">VIEW PROFILE ></button></center>

                        

                    </div>



                    <div class="item">



                        <div class="rank-item-detail">



                            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>/rank/2.jpg" height="466" width="313" alt="Fitnessity" />



                            <div class="ranker-detail">



                                <p><i class="fa fa-map-marker"></i> California, USA</p>



                                <p><i class="fa fa-thumbs-up"></i> 12 / 15</p>



                                <p><i class="fa fa-futbol-o"></i> Football Trainer</p>



                                <p><i class="fa fa-certificate"></i> USA Football Federation</p>



                            </div>



                        </div>



                        <center><button type="button" class="btn btn-info btn-lg header-right-menu" 

                        href="#">VIEW PROFILE ></button></center>



                    </div>



                    <div class="item">



                        <div class="rank-item-detail">



                            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>/rank/3.jpg" height="466" width="313" alt="Fitnessity" />



                            <div class="ranker-detail">



                                <p><i class="fa fa-map-marker"></i> California, USA</p>



                                <p><i class="fa fa-thumbs-up"></i> 12 / 15</p>



                                <p><i class="fa fa-futbol-o"></i> Football Trainer</p>



                                <p><i class="fa fa-certificate"></i> USA Football Federation</p>



                            </div>



                        </div>



                        <center><button type="button" class="btn btn-info btn-lg header-right-menu" 

                        href="#">VIEW PROFILE ></button></center>



                    </div>



                    <div class="item">



                        <div class="rank-item-detail">



                            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>/rank/1.jpg" height="466" width="313" alt="Fitnessity" />



                            <div class="ranker-detail">



                                <p><i class="fa fa-map-marker"></i> California, USA</p>



                                <p><i class="fa fa-thumbs-up"></i> 12 / 15</p>



                                <p><i class="fa fa-futbol-o"></i> Football Trainer</p>



                                <p><i class="fa fa-certificate"></i> USA Football Federation</p>



                            </div>



                        </div>



                        <center><button type="button" class="btn btn-info btn-lg header-right-menu" 

                        href="#">VIEW PROFILE ></button></center>



                    </div>



                    <div class="item">



                        <div class="rank-item-detail">



                            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>/rank/2.jpg" height="466" width="313" alt="Fitnessity" />



                            <div class="ranker-detail">



                                <p><i class="fa fa-map-marker"></i> California, USA</p>



                                <p><i class="fa fa-thumbs-up"></i> 12 / 15</p>



                                <p><i class="fa fa-futbol-o"></i> Football Trainer</p>



                                <p><i class="fa fa-certificate"></i> USA Football Federation</p>



                            </div>



                        </div>



                        <center><button type="button" class="btn btn-info btn-lg header-right-menu" 

                        href="#">VIEW PROFILE ></button></center>



                    </div>



                    <div class="item">



                        <div class="rank-item-detail">



                            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>/rank/3.jpg" height="466" width="313" alt="Fitnessity" />



                            <div class="ranker-detail">



                                <p><i class="fa fa-map-marker"></i> California, USA</p>



                                <p><i class="fa fa-thumbs-up"></i> 12 / 15</p>



                                <p><i class="fa fa-futbol-o"></i> Football Trainer</p>



                                <p><i class="fa fa-certificate"></i> USA Football Federation</p>



                            </div>



                        </div>



                        <center><button type="button" class="btn btn-info btn-lg header-right-menu" 

                        href="#">VIEW PROFILE ></button></center>



                    </div>



                    <div class="item">



                        <div class="rank-item-detail">



                            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>/rank/1.jpg" height="466" width="313" alt="Fitnessity" />



                            <div class="ranker-detail">



                                <p><i class="fa fa-map-marker"></i> California, USA</p>



                                <p><i class="fa fa-thumbs-up"></i> 12 / 15</p>



                                <p><i class="fa fa-futbol-o"></i> Football Trainer</p>



                                <p><i class="fa fa-certificate"></i> USA Football Federation</p>



                            </div>



                        </div>



                        <center><button type="button" class="btn btn-info btn-lg header-right-menu" 

                        href="#">VIEW PROFILE ></button></center>



                    </div>



                    <div class="item">



                        <div class="rank-item-detail">



                            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>/rank/2.jpg" height="466" width="313" alt="Fitnessity" />



                            <div class="ranker-detail">



                                <p><i class="fa fa-map-marker"></i> California, USA</p>



                                <p><i class="fa fa-thumbs-up"></i> 12 / 15</p>



                                <p><i class="fa fa-futbol-o"></i> Football Trainer</p>



                                <p><i class="fa fa-certificate"></i> USA Football Federation</p>



                            </div>



                        </div>



                        <center><button type="button" class="btn btn-info btn-lg header-right-menu" 

                        href="#">VIEW PROFILE ></button></center>



                    </div>



                    <div class="item">



                        <div class="rank-item-detail">



                            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>/rank/3.jpg" height="466" width="313" />



                            <div class="ranker-detail">



                                <p><i class="fa fa-map-marker"></i> California, USA</p>



                                <p><i class="fa fa-thumbs-up"></i> 12 / 15</p>



                                <p><i class="fa fa-futbol-o"></i> Football Trainer</p>



                                <p><i class="fa fa-certificate"></i> USA Football Federation</p>



                            </div>



                        </div>



                        <center><button type="button" class="btn btn-info btn-lg header-right-menu" 

                        href="#">VIEW PROFILE ></button></center>



                    </div>







                </div>

                    

            </div>







        </div>



    </div>



</section> -->



<!--<section class="blog-event">



    <div class="container">



        <div class="blog-part">



            <div class="post-title">



                <h2>latest blog</h2>



                <span>Feb  21st  2014</span> 



            </div>



            <div class="post-detail">



                <div class="p_name">LOREM IPSUM</div>



                <div class="p_detail">Nam ei solum indoctum, reque dolorem persecuti ea qui. Doctus nominati ne pri, oratio propriae assueverit ex pri.



                    Nam ei solum indoctum 



                </div>



            </div>



            <a href="#">READ MORE >></a>



        </div>



        <div class="event-part">



            <div class="event-space">



                <div class="post-title">



                    <h2>Event</h2>



                    <span>Feb  21st  2014</span> 



                </div>



                <div class="event-detail">



                    <h3>reque dolorem persecuti ea qui. </h3>



                    <p>Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. </p>



                </div>



                <a href="#">READ MORE >></a>



            </div>



        </div>



    </div>



    </div>



</section>-->

<style>

    .select_activity_hp{

        margin-right: 20%;

    }

	.slider-block-2.hp{

		padding:0px 40px 40px 40px

	}

	.fit_for_business{

		height: 500px;

	}

    .row.img-box-1{

    padding-top: 30px;

}

.row.img-box-2{

    padding-top: 50px;

}



.row.img-box-3{

padding-top: 50px;padding-bottom:50px

}

.owl-prev {

    font-size: medium !important;

    border-radius: 50%;

    padding: 10px 15px !important;

  position: relative;

    top: -365px;

    left: -415px;

    color: black;

    background: white;

    z-index: 9999;

    padding: 7px 9px;

    border-radius: 50%;

    margin-right:10% !important;

    }

    .owl-next{

    position: relative;

    top: -365px;

    font-size: medium !important;

    color: black;

    background: white;

    right: -422px;

    z-index: 9999;

    border-radius: 50%;

    padding: 10px 15px !important;

    }

    .rank-sidebar{

        padding-right: 40px;

    }

   .owl-pagination {

    display: none;

}

#login_modal{

z-index:99999;

}

</style>

<script src="<?php echo Config::get('constants.FRONT_JS'); ?>owl.carousel.js"></script>



<script defer src="<?php echo Config::get('constants.FRONT_JS'); ?>jquery.flexslider.js"></script>



<script type="text/javascript" src="<?php echo Config::get('constants.FRONT_JS'); ?>lightbox.js"></script>



<!--<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyC45-kgXDIY_O8SZxc5d7YLdQYqSkcts7I&sensor=false" defer></script>-->



<script type="text/javascript" src="<?php echo Config::get('constants.FRONT_JS'); ?>home.js"></script>



<script>

function initialize1(q) {

        

            var input = q;

            var s = input.value

           var autocomplete = new google.maps.places.Autocomplete(input);

           

           $('.pac-container').css('z-index', '999999999');

            autocomplete.addListener('place_changed', function () {

                

               // $('#b_EINnumber').focus();

               var place = autocomplete.getPlace();

               lat = place.geometry.location.lat();

                long = place.geometry.location.lng();

              for (var i = 0; i < place.address_components.length; i++) {

  for (var j = 0; j < place.address_components[i].types.length; j++) {

    if (place.address_components[i].types[j] == "postal_code") {

      $('.b_zipcode').val(place.address_components[i].long_name);

    }

    if (place.address_components[i].types[j] == "locality") {

      $('.b_city').val(place.address_components[i].long_name);

        }

        if (place.address_components[i].types[j] == "country") {

            console.log("autocomplete")

            console.log(place.address_components[i].short_name)

            console.log("autocomplete")

          $('.b_country').val(place.address_components[i].short_name);

        }

        if (place.address_components[i].types[j] == "administrative_area_level_1") {

          $('.b_state').val(place.address_components[i].long_name);

        }

      }

    } 

                });

            }

            var profile_pic_var = '';

              function readURL(input) {

        if (input.files && input.files[0]) {

            var reader = new FileReader();



            reader.onload = function (e) {

                $('.blah').attr('src', e.target.result);

            	var html = '<img src="'+e.target.result+'" alt="Fitnessity">';

            	$('.uploadedpic').html(html);

            };

            profile_pic_var = input.files[0];

            reader.readAsDataURL(input.files[0]);

        }

    }

    $(document).ready(function() {

        $( "#lesson_modal" ).on('shown.bs.modal', function(e){

            console.log("I want this to appear after the modal has opened!");

        });

        if(window.location.href.includes('?ver=activitybook')){

            console.log("booklessonbtn")

            $('#booklessonbtn').click()

        }

        $('#birthday_date').Zebra_DatePicker({

      default_position: 'below',

       format: 'm-d-Y',

      direction:-1,

      container : $('#birthday_date-position')      

    });

    //     $(document).on('ready','#birthday_date',function(){

    //         $('#birthday_date').Zebra_DatePicker({

    //   default_position: 'below',

    //   container : $('#birthday_date-position')      

    // });

    //     })

  //  console.log(window.location.href)

  $('.b_address').load(function(){

       console.log("step")

  })

  $(document).on('ready','.b_address',function(){

      var step=$('#showstep').val()

 console.log(step)

  })

 var step=$('#showstep').val()

 console.log(step)

    if(step == 5){

        $('#birthday_date').Zebra_DatePicker({

      default_position: 'top',

      format: 'm-d-Y',

      direction:-1,

      

      container : $('.birthday_date-position')      

    });

    }

    

    if(step == 3 || step==4){

        console.log("step 2")

    }

    

    $(document).on('input','.first_name',function(){

        $('#birthday_date').Zebra_DatePicker({

      default_position: 'top',

      direction:-1,

      format: 'm-d-Y',

      container : $('.birthday_date-position')      

    });

    })

    

    $(document).on('click','#fileimgnext',function(){

        if($('#file').val() == ''){

            showSystemMessages('#systemMessage', 'danger', 'Select image to upload.');

        }

        else{

            var posturl = '/auth/uploadProfile';

            var formdata = new FormData();

            formdata.append('_token','{{csrf_token()}}')

            formdata.append('profile_pic',profile_pic_var)

            $.ajax({

              url:posturl,

              type:'POST',

              dataType: 'json',

              data:formdata,

              processData: false,

              contentType: false,

               headers: {'X-CSRF-TOKEN': $("#_token").val()},

              beforeSend: function () {

                $('#fileimgnext').prop('disabled', true);

                showSystemMessages('#systemMessage', 'info', 'Please wait while we processed you with Fitnessity.');

              },

              complete: function () {

                $('#fileimgnext').prop('disabled', false);

              },

              success: function (response) {

                //if(response.type === 'success'){

                  window.location.href = "{{url('/?showstep=1')}}"

                //}

              }

            });

        }

    })

        

        $(document).on('click','.step2_next',function(){

    var posturl = '/auth/updateStep?show_step=3';

    var formdata = new FormData();

    formdata.append('_token','{{csrf_token()}}')

    formdata.append('show_step',3)

    $.ajax({

      url:posturl,

      type:'POST',

      dataType: 'json',

      data:formdata,

      processData: false,

      contentType: false,

       headers: {'X-CSRF-TOKEN': $("#_token").val()},

      beforeSend: function () {

        $('.step2_next').prop('disabled', true);

        showSystemMessages('#systemMessage', 'info', 'Please wait while we processed you with Fitnessity.');

      },

      complete: function () {

        $('.step2_next').prop('disabled', false);

      },

      success: function (response) {

        //if(response.type === 'success'){

          window.location.href = "{{url('/?showstep=1')}}"

        //}

      }

    });

})



$(document).on('click','.step4_next',function(){

    if($('.b_address').val() == '' || $('.b_country').val() == '' || $('.b_city').val() == '' || $('.b_state').val() == ''|| $('.b_zipcode').val() == ''){

        showSystemMessages('#systemMessage', 'danger', 'Enter all data.');

    }

   

    else{

       var posturl = '/auth/saveaddress';

            var formdata = new FormData();

            formdata.append('_token','{{csrf_token()}}')

            formdata.append('address',$('.b_address').val())

            formdata.append('country',$('.b_country').val())

            formdata.append('city',$('.b_city').val())

            formdata.append('state',$('.b_state').val())

            formdata.append('zipcode',$('.b_zipcode').val())

            formdata.append('show_step',5)

            $.ajax({

              url:posturl,

              type:'POST',

              dataType: 'json',

              data:formdata,

              processData: false,

              contentType: false,

               headers: {'X-CSRF-TOKEN': $("#_token").val()},

              beforeSend: function () {

                $('.step4_next').prop('disabled', true);

                showSystemMessages('#systemMessage', 'info', 'Please wait while we processed you with Fitnessity.');

              },

              complete: function () {

                $('.step4_next').prop('disabled', false);

              },

              success: function (response) {

                //if(response.type === 'success'){

                  window.location.href = "{{url('/?showstep=1')}}"

                //}

              }

            });

    }

})



$(document).on('click','.skip5_next',function(){

    var posturl = '/skip-family-form1';

            var formdata = new FormData();

            formdata.append('_token','{{csrf_token()}}')

            formdata.append('first_name','check')

            formdata.append('show_step',6)

            setTimeout(function(){

            $.ajax({

              url:posturl,

              type:'POST',

              dataType: 'json',

              data:formdata,

              processData: false,

              contentType: false,

               headers: {'X-CSRF-TOKEN': $("#_token").val()},

              beforeSend: function () {

                $('#skip5_next').prop('disabled', true);

                showSystemMessages('#systemMessage', 'info', 'Please wait while we skipping the data');

              },

              complete: function () {

                $('#skip5_next').prop('disabled', true);

              },

              success: function (response) {

                  showSystemMessages('#systemMessage', response.type, response.msg);

                  if(response.type === 'success'){

                    window.location.href = response.redirecturl;

                  }else{

                    $('#skip5_next').prop('disabled', false);    

                  }

                }

            });

            },1000)

})



$(document).on('click','.step5_next',function(){

    if($('.first_name').val() == '' || $('.last_name').val() == '' || $('.relationship').val() == ''|| $('.mobile_number').val() == ''|| $('.emergency_phone').val() == ''|| $('.birthday').val() == ''|| $('.gender').val() == ''){

        showSystemMessages('#systemMessage', 'danger', 'Enter all data.');

    }

    else{

       var posturl = '/submit-family-form1';

            var formdata = new FormData();

            formdata.append('_token','{{csrf_token()}}')

            formdata.append('first_name',$('.first_name').val())

            formdata.append('last_name',$('.last_name').val())

            formdata.append('email',$('.email').val())

            formdata.append('relationship',$('.relationship').val())

            formdata.append('mobile_number',$('.mobile_number').val())

            formdata.append('emergency_phone',$('.emergency_phone').val())

            formdata.append('birthday',$('#birthday_date').val())

            formdata.append('gender',$('.gender').val())

            formdata.append('show_step',6)

            setTimeout(function(){

                

            

            $.ajax({

              url:posturl,

              type:'POST',

              dataType: 'json',

              data:formdata,

              processData: false,

              contentType: false,

               headers: {'X-CSRF-TOKEN': $("#_token").val()},

              beforeSend: function () {

                $('#step5_next').prop('disabled', true);

                showSystemMessages('#systemMessage', 'info', 'Please wait while we submitting the data');

              },

              complete: function () {

                $('#step5_next').prop('disabled', true);

              },

              success: function (response) {

                  showSystemMessages('#systemMessage', response.type, response.msg);

                  if(response.type === 'success'){

                    window.location.href = response.redirecturl;

                  }else{

                    $('#step5_next').prop('disabled', false);    

                  }

                }

            });

            },1000)

    }

})





 $(document).on('click','.step3_next',function(){

     console.log($('input[name="gender"]:checked').val())

    if($('input[name="gender"]:checked').val() == '' || $('input[name="gender"]:checked').val() == 'undefined' || $('input[name="gender"]:checked').val() == undefined){

        showSystemMessages('#systemMessage', 'danger', 'Select gender.');

    }

   

    else{

        if($('input[name="gender"]:checked').val() == 'other' && $('#othergender').val() == ''){

            showSystemMessages('#systemMessage', 'danger', 'Enter other gender.');

       

        }

        else{

            var posturl = '/auth/savegender';

            var formdata = new FormData();

            formdata.append('_token','{{csrf_token()}}')

            var g = $('input[name="gender"]:checked').val() == 'other' ? $('#othergender').val() :$('input[name="gender"]:checked').val()

            formdata.append('gender',g)

            formdata.append('show_step',4)

            $.ajax({

              url:posturl,

              type:'POST',

              dataType: 'json',

              data:formdata,

              processData: false,

              contentType: false,

               headers: {'X-CSRF-TOKEN': $("#_token").val()},

              beforeSend: function () {

                $('.step3_next').prop('disabled', true);

                showSystemMessages('#systemMessage', 'info', 'Please wait while we processed you with Fitnessity.');

              },

              complete: function () {

                $('.step3_next').prop('disabled', false);

              },

              success: function (response) {

                //if(response.type === 'success'){

                  window.location.href = "{{url('/?showstep=1')}}"

                //}

              }

            });

        }

    }

})

        

            $('.gf').click(function(){

                localStorage.setItem('myData',$(this).attr('sp_id'))

            })

        

        $('#hire_professional').on('click', function(){

       $('#signupoption').css('display','block');

       $('#chooseoption').css('display','none');

     });



if(window.location.href == '{{url("/p/login")}}'){

   // window.location.replace("{{url('/')}}")

   // window.history.pushState(“{{url('/p/login')}}”, “Fitnessity”, “{{url('/')}}”)

   history.replaceState('', 'Fitnessity', '{{url("/")}}');



    $("#loginbtn").click()

}

      var owl = $("#owl-demo");



      owl.owlCarousel({



      items : 2, //10 items above 1000px browser width

      itemsDesktop : [1024,2], //5 items between 1000px and 901px

      itemsDesktopSmall : [990,2], // 3 items betweem 900px and 601px

      itemsTablet: [768,2], //2 items between 600 and 0;

      itemsMobile : [567, 1], // itemsMobile disabled - inherit from itemsTablet option

       navigation:true,

      navigationText: ["<i class='fa fa-chevron-left leftbtn'></i>", "<i class='fa fa-chevron-right'></i>"] 

      });

      // Custom Navigation Events

      $(".next").click(function(){

        owl.trigger('owl.next');

      })

      $(".prev").click(function(){

        owl.trigger('owl.prev');

      })

      $(".play").click(function(){

        owl.trigger('owl.play',1000);

      })

      $(".stop").click(function(){

        owl.trigger('owl.stop');

      })

    

    //New Carousael added by ashu on category ------  start -----------------



     var owlCat = $("#owl-demo-category");



      owlCat.owlCarousel({

      items : 3, //10 items above 1000px browser width

      itemsDesktop : [1024,2], //5 items between 1000px and 901px

      itemsTablet: [768,2], //2 items between 600 and 0;

      itemsMobile : [567,1], // itemsMobile disabled - inherit from itemsTablet option

      navigation:true,

      navigationText: ["<i class='fa fa-chevron-left leftbtn'></i>", "<i class='fa fa-chevron-right'></i>"] 

      });

      // Custom Navigation Events

      $(".next").click(function(){

        owlCat.trigger('owlCat.next');

      })

      $(".prev").click(function(){

        owlCat.trigger('owlCat.prev');

      })

      $(".play").click(function(){

        owlCat.trigger('owlCat.play',1000); 

      })

      $(".stop").click(function(){

        owlCat.trigger('owlCat.stop');

      })



      //New Carousael added by ashu on category ------  end -----------------

    // 











    //Default selected VIEW ALL SPORTS

    $('#category_id_most').css("font-weight", "500");



    $('.search_by_category').click(function(e){



        var cat_id_arr = $(this).attr('id').split('category_id_');

        if(cat_id_arr[1] != undefined){



            //Unselect all categories

            $(this).parent().parent().find('li').find('a').css("font-weight", "300");



            //Highlight selected categories

            $(this).css("font-weight", "500");



            $.ajax({

                method: "POST",

                url: "{!! route('sports-ajax-get-list') !!}", 

                data: { 'cat_id': cat_id_arr[1], '_token': "{{ csrf_token() }}" },

                success: function(result){

                   if(result){

                        var resultObj = jQuery.parseJSON(result);

                        

                        $('.cate-list').html('');

                        

                        $.each(resultObj.sports_list, function( index, value ) {

                         //For Most Searched

                        if(value.id === undefined) value.id = value.sport;

                        var description = '';



                        if(value.description !== undefined && value.description !== null)

                        {

                                var description = value.description;

                        }

                         if(value.has_child == 1){

                            

                            $('.cate-list').append(

                                '<div class="cat-item style_prevu_sp item">'+

                                    '<span>'+

                                        '<div class="cat-img-name">'+

                                            '<span>'+

                                                '<div class="sports_name">'+

                                                    '<span>'+value.sport_name+'</span>'+

                                                '</div>'+

                                            '</span>'+

                                            '<img src="<?php echo Config::get('constants.SPORTS_IMAGE_THUMB'); ?>'+value.image+'" height="466" width="313" alt="Fitnessity" />'+

                                                '<p>&nbsp;</p>'+

                                                '<div class="pop-search-detail-sports">'+

                                                    '<h4>'+value.sport_name+'</h4>'+

                                                    '<h5>'+description+'</h5>'+

                                                '</div>'+

                                        '</div>'+

                                        '<div class="cat-detail">'+

                                            '<h1>'+value.sport_name+'</h1>'+

                                            '<a type="button" data-toggle="modal" data-target="#child_sports_modal" href="/home/jsModalChildSports/'+value.id+'">Book Now</a>'+

                                        '</div>'+

                                    '</span>'+

                                '</div>'); 

                                

                            } else {



                                <?php if(Auth::user()) { ?>



                                   $('.cate-list').append(

                                        '<div class="cat-item style_prevu_sp item">'+

                                            '<span>'+

                                                '<div class="cat-img-name">'+

                                                    '<span>'+

                                                        '<div class="sports_name">'+

                                                            '<span>'+value.sport_name+'</span>'+

                                                        '</div>'+

                                                    '</span>'+

                                                    '<img src="<?php echo Config::get('constants.SPORTS_IMAGE_THUMB'); ?>'+value.image+'" height="466" width="313" alt="Fitnessity" />'+

                                                    '<p>&nbsp;</p>'+

                                                    '<div class="pop-search-detail-sports">'+

                                                        '<h4>'+value.sport_name+'</h4>'+

                                                        '<h5>'+description+'</h5>'+

                                                    '</div>'+

                                                '</div>'+

                                                '<div class="cat-detail">'+

                                                    '<h1>'+value.sport_name+'</h1>'+

                                                        '<a title="Click here to book professional" data-toggle="modal" data-target="#lesson_modal" href="/lesson/jsModallesson/booklesson/'+value.id+'">Book Now</a>'+

                                                '</div>'+

                                            '</span>'+

                                        '</div>');

                                <?php } else { ?>

                                   

                                   $('.cate-list').append(

                                        '<div class="cat-item style_prevu_sp item">'+

                                            '<span>'+

                                                '<div class="cat-img-name">'+

                                                    '<span>'+

                                                        '<div class="sports_name">'+

                                                            '<span>'+value.sport_name+'</span>'+

                                                        '</div>'+

                                                    '</span>'+

                                                    '<img src="<?php echo Config::get('constants.SPORTS_IMAGE_THUMB'); ?>'+value.image+'" height="466" width="313" alt="Fitnessity" />'+

                                                        '<p>&nbsp;</p>'+

                                                        '<div class="pop-search-detail-sports">'+

                                                            '<h4>'+value.sport_name+'</h4>'+

                                                            '<h5>'+description+'</h5>'+

                                                        '</div>'+

                                                '</div>'+

                                                '<div class="cat-detail">'+

                                                    '<h1>'+value.sport_name+'</h1>'+

                                                        '<a type="button" data-toggle="modal" data-target="#login_modal" href="/auth/jsModallogin/'+value.id+'" title="Login to book professional" onclick="$(\'#child_sports_modal\').modal(\'hide\');">Book Now</a>'+

                                                '</div>'+

                                            '</span>'+

                                        '</div>');

                                <?php } ?>

                         

                         }

                          

                         if(index == 4) { return false; }

                        });



                        if($('.cate-list').html() == '') { $('.cate-list').html('<div class="cat-item"><div style="height:149px; width:100%; clear:both;"></div><div class="cat-detail"><h1>No Sports Found.</h1></div></div>'); }



                        $("#owl-demo-category").data('owlCarousel').destroy();

                           $("#owl-demo-category").owlCarousel({

                              items : 3, //10 items above 1000px browser width

                              itemsDesktop : [1024,2], //5 items between 1000px and 901px

                              itemsDesktopSmall : [990,2], // 3 items betweem 900px and 601px

                              itemsTablet: [768,2], //2 items between 600 and 0;

                              itemsMobile : [567,1],

                               navigation:true,

      navigationText: ["<i class='fa fa-chevron-left leftbtn'></i>", "<i class='fa fa-chevron-right'></i>"] ,

                           });

                   }

                }

            });

        }

    });



$('.happening_now').click(function(e) {
	
	//alert('aa');

    var flag = $(this).attr('id').split('happeningnow_');

 $('.happening_now').removeClass('active');

     $(this).addClass('active');

    if (flag[1] != undefined) {

      $(this).parent().parent().find('li').find('a').css("font-weight", "300");

      $(this).css("font-weight", "500");

      $.ajax({

        method: "POST",

        url: "{!! route('happening-now-ajax-get-list') !!}",

        data: {

          'flag': flag[1],

          '_token': "{{ csrf_token() }}"

        },

        success: function(result) {

          if (result) {

            var resultObj = jQuery.parseJSON(result);

            console.log(resultObj);

            $('.test').html('');

            var d = resultObj.professionals_list;

            $.each(d, function(index, value) {

              var sport_name = resultObj.sport_names;

              var sports_id = value.user_sports;

              if (sports_id != '') {

                var user_sport = sports_id.split(",");

                var sports_title = '';

                user_sport.forEach(function(value) {

                  sports_title += sport_name[value] + ' ';

                });

              }

<?php if(Auth::user()) { ?> 

             a_url = '<a href="/directhire/viewprofile/' + value.id + '">VIEW MORE <i class="fa fa-angle-right"></i> </a>';

              <?php } else { ?>

 a_url = '<a data-toggle="modal" data-target="#lesson_modal" href="/lesson/jsModallesson/'+value.id+'">VIEW MORE <i class="fa fa-angle-right"></i> </a>';

               <?php }?>

$('.test').append('<div class="item">' + '<div class="rank-item-detail">' + '<img src="public/uploads/profile_pic/<?php echo Config::get('constants.USER_IMAGE_THUMB '); ?>' + value.profile_pic + '" height="466" width="313" alt="Fitnessity" />' + '<div class="ranker-detail">' + '<p><i class="fa fa-user"></i> ' + value.firstname + ' ' + value.lastname + '</p>' + '<p><i class="fa fa-map-marker"></i> ' + value.states.state_name + ' ' + value.country + ' ' + value.zipcode + '</p>' + '<p><i class="fa fa-thumbs-up"></i>' + value.bookingcount + '</p>' + '<p><i class="fa fa-futbol-o"></i>' + sports_title + '</p>' + '</div>' + '</div>' + a_url + '<div>');

            });

            if ($('.test').html() == '') {

              $('.test').html('<div class="cat-item"><div style="height:149px; width:100%; clear:both;"></div><div class="cat-detail"><h1 style="height:245px; width:345px;">No Professionals Found.</h1></div></div>');

            }

            $("#owl-demo").data('owlCarousel').destroy();

            $("#owl-demo").owlCarousel({

              items: 2,

              itemsDesktop: [1024, 2],

              itemsDesktopSmall: [990, 2],

              itemsTablet: [768, 2],

              itemsMobile: [567, 1],

navigation:true,

      navigationText: ["<i class='fa fa-chevron-left leftbtn'></i>", "<i class='fa fa-chevron-right'></i>"] ,

            });

          }

        }

      });

    }

  });

  <?php if(session('bookSportAfterLogin') && session('bookSportAfterLogin') > 0 && Auth::user()){ ?>

        $('#lesson_modal').modal({'show':true,'remote':"/lesson/jsModallesson/booklesson/<?php echo session('bookSportAfterLogin') ?>"});

    <?php 

        session(['bookSportAfterLogin' => 0]);

    } ?>

});



</script>



@endsection

