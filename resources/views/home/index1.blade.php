@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')
@section('content')
@include('layouts.business.new-header')

    <div class="page-content-home">
        <div class="hpb-100">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-lg-7 col-12">
                        <div class="banner0fonts">
                            <label class="fs-65 mb-15">Find Next Place <br> To <span class="font-red"> Visit </span></label>
                            <p class="fs-15">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        </div>
                    </div>
                    <div class="col-lg-5 col-12">
                        <div class="banner-img">
                            <img src="{{asset('uploads/slider/thumb/1646832387-yoga%20classes.jpg')}}">
                        </div>
                    </div>
                    <div class="col-lg-9 col-12">
                        <div class="set-searchbox">
                            <div class="searchwrapper shadow">
                                <form id="searchform" method="get" action="/activities/">
                                    <div class="searchbox">
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-4 col-md-6 col-6">
                                                <input type="text" class="form-control padding-lrtb-one" name="label" id="activity_label" placeholder="Search by Activity, Business, Person, Username">
                                                <div id="suggesstion-box-search-activity"></div>
                                            </div>
                                            <div class="col-lg-4 col-sm-4 col-md-4 col-6">
                                                <input type="hidden" name="address" id="b_city1" >
                                                <input type="text" name="" id="b_address1"  class="form-control no-side-border padding-lrtb" placeholder="Search by country, city, state, zip" oninput="initMapCall('b_address1', 'b_city1', 'b_state1', 'country1', 'b_zipcode1', 'lat', 'lon')">
                                                <div id="map" class="d-none p-relative" style="overflow: hidden;"></div>
                                                <div id="suggesstion-box-search-location"></div>
                                                <input type="hidden"  name="City" id="b_city1" value="">
                                                <input type="hidden"  name="State" id="b_state1" value="">
                                                <input type="hidden"  name="Country" id="country1" value="">
                                                <input type="hidden"  name="ZipCode" id="b_zipcode1" value="">
                                                <input type="hidden"  name="lat" id="lat" value="">
                                                <input type="hidden"  name="lon" id="lon" value="">
                                            </div>
                                            <div class="col-lg-2 col-sm-4 col-md-2 col-12">
                                                <button type="submit" class="btn btn-red" class="form-control"><i class="fa fa-search livesearch"></i>Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-grey hpt-100 hpb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="home-main-title mb-30">
                            <h2>View All Activities</h2>
                        </div>
                    </div>  
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12">
                        <div class="taxonomy-item taxonomy-card">
                            <a class="taxonomy-link hover-effect" href="{{url('/activities/active_wth_fun_things_to_do')}}">
                                <div class="taxonomy-title">Stay Active With Fun Things To Do </div>
                                <img class="img-responsive" src="{{asset('uploads/slider/thumb/1648141166-snowboarding.jpg')}}">
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-12">
                        <div class="taxonomy-item taxonomy-card">
                            <a class="taxonomy-link hover-effect" href="#">
                                <div class="taxonomy-title">Products & Gear</div>
                                <img class="img-responsive" src="{{asset('uploads/discover/thumb/fitness-bodybuilding.jpg')}}">
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-12">
                        <div class="taxonomy-item taxonomy-card">
                            <a class="taxonomy-link hover-effect" href="{{url('/activities/events_in_your_area')}}">
                                <div class="taxonomy-title">Find Events </div>
                                <img class="img-responsive" src="{{asset('uploads/discover/thumb/1670251820-events.jpg')}}">
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-12">
                        <div class="taxonomy-item taxonomy-card">
                            <a class="taxonomy-link hover-effect" href="{{url('/activities/ways_to_workout')}}">
                                <div class="taxonomy-title">Find Ways to Workout</div>
                                <img class="img-responsive" src="{{asset('uploads/discover/thumb/1649648481-yoga classes.jpg')}}">
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-12">
                        <div class="taxonomy-item taxonomy-card">
                            <a class="taxonomy-link hover-effect" href="{{url('/activities/trainers_coaches')}}">
                                <div class="taxonomy-title">Find A Personal Training Session </div>
                                <img class="img-responsive" src="{{asset('uploads/discover/thumb/1665403648-1649648909-tennis 1.jpg')}}">
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-12">
                        <div class="taxonomy-item taxonomy-card">
                            <a class="taxonomy-link hover-effect" href="{{url('/activities')}}">
                                <div class="taxonomy-title">View All </div>
                                <img class="img-responsive" src="{{asset('uploads/slider/thumb/1646834734-ACTIVITES BACKGROUND.jpg')}}">
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12 text-center">
                        <a href="{{url('/activities')}}" class="btn btn-red fs-15 btn-w-130 mt-30">Find More</a>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="hpb-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-xs-12 nopadding">
                        @include('includes.next_8_hours_home') 
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-grey hpt-100 hpb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="home-main-title mb-30">
                            <h2>Discover Our Top Destinations</h2>
                        </div>
                    </div>      
                    
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="taxonomy-item taxonomy-item-v2">
                            <div class="taxonomy-item-image">
                                <a class="taxonomy-link hover-effect" href="#">
                                    <img class="img-responsive" src="{{asset('uploads/slider/thumb/1646834734-ACTIVITES BACKGROUND.jpg')}}">
                                </a>    
                            </div>
                            <div class="taxonomy-item-content">
                                <h3 class="taxonomy-title">
                                    <a href="#">New York City</a>
                                    <a href="#">United States</a>
                                </h3>
                                <div class="taxonomy-description">
                                    5 Activities
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="taxonomy-item taxonomy-item-v2">
                            <div class="taxonomy-item-image">
                                <a class="taxonomy-link hover-effect" href="#">
                                    <img class="img-responsive" src="{{asset('uploads/slider/thumb/1646835416-soccer coaches.jpg')}}">
                                </a>    
                            </div>
                            <div class="taxonomy-item-content">
                                <h3 class="taxonomy-title">
                                    <a href="#">Los Angeles</a>
                                    <a href="#">United States</a>
                                </h3>
                                <div class="taxonomy-description">
                                    10 Activities
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="taxonomy-item taxonomy-item-v2">
                            <div class="taxonomy-item-image">
                                <a class="taxonomy-link hover-effect" href="#">
                                    <img class="img-responsive" src="{{asset('uploads/slider/thumb/1646832387-yoga classes.jpg')}}">
                                </a>    
                            </div>
                            <div class="taxonomy-item-content">
                                <h3 class="taxonomy-title">
                                    <a href="#">Chicago</a>
                                    <a href="#">United States</a>
                                </h3>
                                <div class="taxonomy-description">
                                    7 Activities
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                        <div class="taxonomy-item taxonomy-item-v2">
                            <div class="taxonomy-item-image">
                                <a class="taxonomy-link hover-effect" href="#">
                                    <img class="img-responsive" src="{{asset('uploads/slider/thumb/1648141166-snowboarding.jpg')}}">
                                </a>    
                            </div>
                            <div class="taxonomy-item-content">
                                <h3 class="taxonomy-title">
                                    <a href="#">Miami</a>
                                    <a href="#">United States</a>
                                </h3>
                                <div class="taxonomy-description">
                                    7 Activities
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="hpt-100 hpb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="fitness-title mb-5">
                            <h1>Why <span>Fitnessity?</span></h1>
                        </div>
                        
                    </div>
                    <div class="col-lg-8 hpl-50">
                        <div class="amazonaws">
                            <img src="{{asset('uploads/discover/thumb/activity-relarted.jpg')}}" >
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="info-imgs mt--25">
                            <img src="{{asset('uploads/discover/thumb/1649648221-snow ski.jpg')}}">
                        </div>
                    </div>
                    <div class="col-lg-8 hpl-50">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="services-item mt-25 mb-15">
                                    <div class="number_format">
                                        <label>1.</label>
                                    </div>
                                    <div class="info-content">
                                        <div class="services-text">
                                            <h3 class="title">A simple way to book active experiences online</h3>
                                        </div>
                                        <div class="services-desc">
                                            <p>Finding the right activity, workout, trainer or adventure can be overwhelming and time-consuming. Browse thousands active experiences from personal training, coaching, fitness classes, adventures & tours & much more.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">  
                                <div class="services-item mt-25 mb-15">
                                    <div class="number_format">
                                        <label>2.</label>
                                    </div>
                                    <div class="info-content">
                                        <div class="services-text">
                                            <h3 class="title">A seamless booking process that saves time </h3>
                                        </div>
                                        <div class="services-desc">
                                            <p>Book for yourself or a family in one go. Choose an unlimited amount of activities or products and add it to the cart. Fitnessity handles all scheduling, and payments securely on your behalf. </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">  
                                <div class="services-item mb-15">
                                    <div class="number_format">
                                        <label>3.</label>
                                    </div>
                                    <div class="info-content">
                                        <div class="services-text">
                                            <h3 class="title">Compare programs and prices</h3>
                                        </div>
                                        <div class="services-desc">
                                            <p>With the 'Add to Compare' feature, you can compare up to 3 activities and service providers, viewing details about the various programs, staff, reviews, prices, certifications, and much more.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">  
                                <div class="services-item mb-15">
                                    <div class="number_format">
                                        <label>4.</label>
                                    </div>
                                    <div class="info-content">
                                        <div class="services-text">
                                            <h3 class="title">Get Motivated </h3>
                                        </div>
                                        <div class="services-desc">
                                            <p>Whether you like to participate in activities one-on-one, with family, friends, or in a group, let Fitnessity be your accountability partner. Join the active community on the only dedicated social network for fitness. Network, share, comment & meet like-minded people interested in getting or staying active. Find your new fit fam at Fitnessity!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="text-center">
                                    @if(Auth::check())
                                        <a class="btn btn-red" href="/activities">Join Today</a>
                                    @else
                                        <a class="btn btn-red" href="{{route('registration')}}">Join Today</a>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-grey hpt-100 hpb-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="home-main-title mb-30">
                            <h2>Discover Activities</h2>
                            <p> Get connected to Activities you love or explore a new one</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-md-6">
                        <div class="fit-project-item mb-30">
                            <a href="/activities/trainers_coaches">
                                <div class="project-img">
                                    <img src="{{asset('uploads/discover/thumb/1649648909-tennis 1.jpg')}}" alt="images">
                                    <div class="discover-title">
                                        <h2>Book a Personal Trainer</h2>
                                    </div>
                                </div>
                                <div class="project-content"> 
                                    <div class="project-inner">
                                        <span class="category">
                                            Take your training to a new level with one-on-one lessons from from top trainers, coaches, instructors, and therapists.
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>                      
                    </div>
                    
                    <div class="col-lg-3 col-sm-6 col-md-6">
                        <div class="fit-project-item mb-30">
                            <a href="/activities/ways_to_workout">
                                <div class="project-img">
                                    <img src="{{asset('uploads/discover/thumb/1649648481-yoga classes.jpg')}}" alt="images">
                                    <div class="discover-title">
                                        <h2>Book Fitness Classes</h2>
                                    </div>
                                </div>
                                <div class="project-content"> 
                                    <div class="project-inner">
                                        <span class="category">
                                            Participate in group classes that you love or discover new, hard-to-find favorites.
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-sm-6 col-md-6">
                        <div class="fit-project-item mb-30">
                            <a href="/activities/active_wth_fun_things_to_do">
                                <div class="project-img">
                                    <img src="{{asset('uploads/discover/thumb/1649648221-snow ski.jpg')}}" alt="images">
                                    <div class="discover-title">
                                        <h2>Find Adventure Experiences</h2>
                                    </div>
                                </div>
                                <div class="project-content"> 
                                    <div class="project-inner">
                                        <span class="category">
                                            Turn your weekend or vacation into and adventure.
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-sm-6 col-md-6">
                        <div class="fit-project-item mb-30">
                            <a href="/activities/events_in_your_area">
                                <div class="project-img">
                                    <img src="{{asset('uploads/discover/thumb/1649648161-soccer coaches.jpg')}}" alt="images">
                                    <div class="discover-title">
                                        <h2>Find Activities for Kids</h2>
                                    </div>
                                </div>
                                <div class="project-content"> 
                                    <div class="project-inner">
                                        <span class="category">
                                            Find activities to keep your kids engaged, active, and in shape.
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="hpt-100 hpb-100 ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="providers-bg-image">
                            <div class="pro-background-overlay"></div>
                            <div class="fit-widget-container">
                                <h2>Are You a Local Business?</h2>
                                <p>Join the community of hundreds of flourishing local business in your city.</p>
                                <div>
                                    @if(Auth::check())
                                        @if(count(Auth::user()->company) > 0)
                                            <a class="btn btn-red" href="{{route('personal.company.create')}}">Get Started</a>
                                        @else
                                            <a class="btn btn-red" href="/activities">Get Started</a>
                                        @endif
                                    @else
                                        <a href="{{route('registration')}}" class="btn btn-red btn-w-130 fs-15 mr-10 mb-10">Get Started</a>
                                    @endif
                                    <a href="{{route('businessClaim')}}" class="btn btn-border-white btn-w-180 fs-15 mb-10">Claim Your Business</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="hpt-100 hpb-100 joinus-bg-image">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="up-down-sp">
                            <div class="joinus-box">
                                <div class="join-title mb-5">
                                    <h1>Join us <span>It's Easy</span></h1>
                                </div>
                                <div class="join-box-text">
                                    <p>One platform for your complete active lifestyle.</p>
                                    <p>We take care of all your bookings, scheduling, payments, and vetting of service providers.</p>
                                    <p>Fitnessity is the simplest way to find your next activity.</p>
                                    
                                    <ul class="mb-4">
                                        <li>Search and choose an activity </li>
                                        <li>Compare providers and services</li>
                                        <li>Book your activity... and get moving</li>
                                    </ul>

                                    @if(Auth::check())
                                        <a class="btn btn-red" href="/activities">START TODAY</a>
                                    @else
                                        <a href="{{route('registration')}}" class="btn btn-red">START TODAY</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Page-content -->
</div><!-- END layout-wrapper -->

@include('layouts.business.footer')

<script type="text/javascript">
    $("#activity_label").keyup(function(){
        var _token = $('input[name="_token"]').val();
        $.ajax({
            type: "POST",
            url: "/searchactionactivity",
            data:{query:$(this).val(), _token:'{{csrf_token()}}'},
            beforeSend: function(){
                //$("#label").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
            },
            success: function(data){ 
                $("#suggesstion-box-search-activity").show();
                $("#suggesstion-box-search-activity").html(data);
            }
        });
    });

    $(document).on('click', '.searchclickactivity', function(){
        $("#activity_label").val($(this).attr('data-num'));
        $("#suggesstion-box-search-activity").hide();
    });
</script>
@endsection