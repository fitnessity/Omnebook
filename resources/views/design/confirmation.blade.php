@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

@section('content')

	@include('layouts.business.new-header')


    <div class="page-content-register">
        <!-- auth page content -->
        <div class="auth-page-content mmt-25">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-height-100">
                            <div class="d-flex">
                                <div class="flex-grow-1 cp-45">
                                    <div class="confirmed mb-25">
                                        <h5 class="mb-3">Booking Confirmed!</h5>
                                    </div>
                                    <div class="confirmed-sub-txt">
                                        <p>Check your email and your account for booking details.</p>
                                        <p>Get a snapshot of your bookings below.</p>
                                    </div>
                                    <div class="text-center mt-15">
                                        <a class="btn btn-red fs-15 mmb-15" href="/activities">Book Another Activity</a>
                                        <a class="btn btn-red fs-15 mmb-15" href="http://dev.fitnessity.co/personal-profile/user-profile">Go To My Profile</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Booking Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="confirmed-slider owl-carousel">
                                    <div class="order-card">
                                        <div class="img">
                                            <img src="https://fitnessity-production.s3.amazonaws.com/activity/HwfDMdWiAJvwIGulXLbGVXP5m88lkymaBSt9FLqX.webp" alt=""> 
                                        </div>
                                        <div class="content">
                                            <div class="title">
                                                Go Golfers
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-6">
                                                    <label>Date Booked:</label>
                                                </div>
                                                <div class="col-lg-6 col-6">
                                                    <div class="text-right">
                                                        <label>02/27/2024</label>
                                                    </div>                                                 
                                                </div>

                                                <div class="col-lg-6 col-6">
                                                    <label>Time & Duration:</label>
                                                </div>
                                                <div class="col-lg-6 col-6">
                                                    <div class="text-right">
                                                        <label>09:00am to 09:45am | 45 Min </label>
                                                    </div>                                                
                                                </div>

                                                <div class="col-lg-6 col-6">
                                                    <label>Price Option: </label>
                                                </div>
                                                <div class="col-lg-6 col-6">
                                                    <div class="text-right">
                                                        <label >30 Minute Private </label>
                                                    </div>                                                
                                                </div>

                                                <div class="col-lg-6 col-6">
                                                    <label>Provider Company: </label>
                                                </div>
                                                <div class="col-lg-6 col-6">
                                                    <div class="text-right">
                                                        <label>Fitness Pvt. Ltd. </label>
                                                    </div>                                                 
                                                </div>
                                            </div>
                                        </div>
                                    </div>  
                                    
                                    <div class="order-card">
                                        <div class="img">
                                            <img src="https://fitnessity-production.s3.amazonaws.com/activity/SmNxBAuI2YYGHQ12baa4kPYxWY5JqyBxUkqBToj7.jpg" alt=""> 
                                        </div>
                                        <div class="content">
                                            <div class="title">
                                                River Rafting
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-6">
                                                    <label>Date Booked:</label>
                                                </div>
                                                <div class="col-lg-6 col-6">
                                                    <div class="text-right">
                                                        <label>02/27/2024</label>
                                                    </div>                                                 
                                                </div>

                                                <div class="col-lg-6 col-6">
                                                    <label>Time & Duration:</label>
                                                </div>
                                                <div class="col-lg-6 col-6">
                                                    <div class="text-right">
                                                        <label>04:30am to 05:30am | 1 hr </label>
                                                    </div>                                                
                                                </div>

                                                <div class="col-lg-6 col-6">
                                                    <label>Price Option: </label>
                                                </div>
                                                <div class="col-lg-6 col-6">
                                                    <div class="text-right">
                                                        <label >session 1 </label>
                                                    </div>                                                
                                                </div>

                                                <div class="col-lg-6 col-6">
                                                    <label>Provider Company: </label>
                                                </div>
                                                <div class="col-lg-6 col-6">
                                                    <div class="text-right">
                                                        <label>Fitness Pvt. Ltd. </label>
                                                    </div>                                                 
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="order-card">
                                        <div class="img">
                                            <img src="https://fitnessity-production.s3.amazonaws.com/activity/q4UxwuaI2PIgmrucdj1UXx4NidpxWtEx5NvUz71H.jpg" alt="">
                                        </div>
                                        <div class="content">
                                            <div class="title">
                                                Love Tennis
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-6">
                                                    <label>Date Booked:</label>
                                                </div>
                                                <div class="col-lg-6 col-6">
                                                    <div class="text-right">
                                                        <label>02/27/2024</label>
                                                    </div>                                                 
                                                </div>

                                                <div class="col-lg-6 col-6">
                                                    <label>Time & Duration:</label>
                                                </div>
                                                <div class="col-lg-6 col-6">
                                                    <div class="text-right">
                                                        <label>09:00am to 09:45am | 45 Min </label>
                                                    </div>                                                
                                                </div>

                                                <div class="col-lg-6 col-6">
                                                    <label>Price Option: </label>
                                                </div>
                                                <div class="col-lg-6 col-6">
                                                    <div class="text-right">
                                                        <label >6 month membership</label>
                                                    </div>                                                
                                                </div>

                                                <div class="col-lg-6 col-6">
                                                    <label>Provider Company: </label>
                                                </div>
                                                <div class="col-lg-6 col-6">
                                                    <div class="text-right">
                                                        <label>Fitness Pvt. Ltd. </label>
                                                    </div>                                                 
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="order-card">
                                        <div class="img">
                                            <img src="https://fitnessity-production.s3.amazonaws.com/activity/yaePqSO8Id6w8KUS63jk2Ye4s5A9cW6Ytp5jufj0.jpg" alt="">
                                        </div>
                                        <div class="content">
                                            <div class="title">
                                                Kung Fu Gym
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-6">
                                                    <label>Date Booked:</label>
                                                </div>
                                                <div class="col-lg-6 col-6">
                                                    <div class="text-right">
                                                        <label>02/27/2024</label>
                                                    </div>                                                 
                                                </div>

                                                <div class="col-lg-6 col-6">
                                                    <label>Time & Duration:</label>
                                                </div>
                                                <div class="col-lg-6 col-6">
                                                    <div class="text-right">
                                                        <label>01:00pm to 03:00pm | 2 hr </label>
                                                    </div>                                                
                                                </div>

                                                <div class="col-lg-6 col-6">
                                                    <label>Price Option: </label>
                                                </div>
                                                <div class="col-lg-6 col-6">
                                                    <div class="text-right">
                                                        <label >Kung Ku Fun Day 1 </label>
                                                    </div>                                                
                                                </div>

                                                <div class="col-lg-6 col-6">
                                                    <label>Provider Company: </label>
                                                </div>
                                                <div class="col-lg-6 col-6">
                                                    <div class="text-right">
                                                        <label>Fitness Pvt. Ltd. </label>
                                                    </div>                                                 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->
	</div><!-- End Page-content -->
</div><!-- END layout-wrapper -->


@include('layouts.business.footer')
<script>
    $(".confirmed-slider").owlCarousel({
        loop: true,
        nav:true,
	    dots: false,
        autoplay: true,
        autoplayTimeout: 2000, //2000ms = 2s;
        autoplayHoverPause: true,
        loop: $('.item img').lenght > 2 ? true : false,
        navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
        responsive: {
			0: {
			  items: 1
			},
	
			600: {
			  items: 1
			},

            750: {
			  items: 2
			},

			1024: {
			  items: 3
			},
			
			1200: {
			  items: 3
			},
			
			1366: {
			  items: 3
			},
        }
	  
    });

</script>
<script>
    // Get the element with the class "owl-nav"
    var owlNav = document.querySelector('.owl-nav');

    // Remove the "disabled" class
    owlNav.classList.remove('disabled');
</script>
@endsection