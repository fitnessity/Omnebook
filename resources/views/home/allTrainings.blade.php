@inject('request', 'Illuminate\Http\Request')

@extends('layouts.header')

@section('content')
            <section class="category inner_top">

                <div class="cat-container">

                    <div class="categoryfilter width-100 float-left">
                        <div class="src-reviw-topic form-review-slct">
                            <span class="title">SELECT CATEGORY</span>
                            <select id="categorySelection" class="selectpicker" data-style="btn-primary">
                                <option id="category_id_most" value="category_id_most">Most Searched</option>
                                <option id="category_id_1" value="category_id_1">Fitness, Health &amp; Wellness</option>
                                <option id="category_id_2" value="category_id_2">Indoor Activities</option>
                                <option id="category_id_3" value="category_id_3">Outdoor Activities</option>
                                <option id="category_id_4" value="category_id_4">Adventures &amp; Tours</option>
                                <option id="category_id_5" value="category_id_5">Classes</option>
                                <option id="category_id_6" value="category_id_6">Kids Activities</option>
                            </select>
                        </div>
                    </div>

                    <div class="online_classes_wrap viewall_training">

                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                            <div class="online_classes_box">
                                <div class="imageclasses">
                                    <a href="#"><img src="{{ asset('public/images/classes1.jpg')}}" alt=""></a>
                                    <span class="live_img"><img src="{{ asset('public/images/liveimg.png')}}" alt=""></span>
                                </div>
                                <div class="classes_title">
                                    <h3>SHE FIT STUDIO <span>- WEIGHT LOSS TRAINING</span></h3>
                                </div>
                                <div class="classes_bottom_duration">
                                    <div class="duration_wrap">
                                        <span class="dtxt">DURATION</span>
                                        <span class="dtxt1">45 mins</span>
                                    </div>
                                    <div class="duration_wrap">
                                        <span class="dtxt">LEVEL</span>
                                        <span class="dtxt1">Easy</span>
                                    </div>
                                    <div class="duration_wrap">
                                        <span class="dtxt">TIMINGS</span>
                                        <span class="dtxt1">01:45 PM</span>
                                    </div>
                                    <div class="book_wrap">
                                        <a href="#"><span>$22.00</span><span>BOOK NOW</span></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                            <div class="online_classes_box">
                                <div class="imageclasses">
                                    <a href="#"><img src="{{ asset('public/images/classes3.jpg')}}" alt=""></a>
                                </div>
                                <div class="classes_title">
                                    <h3>LAURA NASH <span>- CORE STRENGTH TRAINING</span></h3>
                                </div>
                                <div class="classes_bottom_duration">
                                    <div class="duration_wrap">
                                        <span class="dtxt">DURATION</span>
                                        <span class="dtxt1">45 mins</span>
                                    </div>
                                    <div class="duration_wrap">
                                        <span class="dtxt">LEVEL</span>
                                        <span class="dtxt1">Easy</span>
                                    </div>
                                    <div class="duration_wrap">
                                        <span class="dtxt">TIMINGS</span>
                                        <span class="dtxt1">01:45 PM</span>
                                    </div>
                                    <div class="book_wrap">
                                        <a href="#"><span>$32.00</span><span>BOOK NOW</span></a>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                            <div class="online_classes_box">
                                <div class="imageclasses">
                                    <a href="#"><img src="{{ asset('public/images/trainings-coming-soon.jpg')}}" alt=""></a>
                                </div>
                                <div class="classes_title">
                                    <h3>SHE FIT STUDIO <span>- WEIGHT LOSS TRAINING</span></h3>
                                </div>
                                <div class="classes_bottom_duration">
                                    <div class="duration_wrap">
                                        <span class="dtxt">DURATION</span>
                                        <span class="dtxt1">45 mins</span>
                                    </div>
                                    <div class="duration_wrap">
                                        <span class="dtxt">LEVEL</span>
                                        <span class="dtxt1">Easy</span>
                                    </div>
                                    <div class="duration_wrap">
                                        <span class="dtxt">TIMINGS</span>
                                        <span class="dtxt1">01:45 PM</span>
                                    </div>
                                    <div class="book_wrap">
                                        <a href="#"><span>$22.00</span><span>BOOK NOW</span></a>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                            <div class="online_classes_box">
                                <div class="imageclasses">
                                    <a href="#"><img src="{{ asset('public/images/classes2.jpg')}}" alt=""></a>
                                </div>
                                <div class="classes_title">
                                    <h3>AKIN FITNESS COACH <span>- STRENGTH BUILDING TRAINING</span></h3>
                                </div>
                                <div class="classes_bottom_duration">
                                    <div class="duration_wrap">
                                        <span class="dtxt">DURATION</span>
                                        <span class="dtxt1">45 mins</span>
                                    </div>
                                    <div class="duration_wrap">
                                        <span class="dtxt">LEVEL</span>
                                        <span class="dtxt1">Easy</span>
                                    </div>
                                    <div class="duration_wrap">
                                        <span class="dtxt">TIMINGS</span>
                                        <span class="dtxt1">01:45 PM</span>
                                    </div>
                                    <div class="book_wrap">
                                        <a href="#"><span>$29.00</span><span>BOOK NOW</span></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                            <div class="online_classes_box">
                                <div class="imageclasses">
                                    <a href="#"><img src="{{ asset('public/images/trainings-coming-soon.jpg')}}" alt=""></a>
                                </div>
                                <div class="classes_title">
                                    <h3>SHE FIT STUDIO <span>- WEIGHT LOSS TRAINING</span></h3>
                                </div>
                                <div class="classes_bottom_duration">
                                    <div class="duration_wrap">
                                        <span class="dtxt">DURATION</span>
                                        <span class="dtxt1">45 mins</span>
                                    </div>
                                    <div class="duration_wrap">
                                        <span class="dtxt">LEVEL</span>
                                        <span class="dtxt1">Easy</span>
                                    </div>
                                    <div class="duration_wrap">
                                        <span class="dtxt">TIMINGS</span>
                                        <span class="dtxt1">01:45 PM</span>
                                    </div>
                                    <div class="book_wrap">
                                        <a href="#"><span>$22.00</span><span>BOOK NOW</span></a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        
                        <div class="col-lg-6 col-md-6 col-sm-6 col-12">

                            <div class="online_classes_box">
                                <div class="imageclasses">
                                    <a href="#"><img src="{{ asset('public/images/trainings-coming-soon.jpg')}}" alt=""></a>
                                    <span class="live_img"><img src="{{ asset('public/images/liveimg.png')}}" alt=""></span>
                                </div>
                                <div class="classes_title">
                                    <h3>SHE FIT STUDIO <span>- WEIGHT LOSS TRAINING</span></h3>
                                </div>
                                <div class="classes_bottom_duration">
                                    <div class="duration_wrap">
                                        <span class="dtxt">DURATION</span>
                                        <span class="dtxt1">45 mins</span>
                                    </div>
                                    <div class="duration_wrap">
                                        <span class="dtxt">LEVEL</span>
                                        <span class="dtxt1">Easy</span>
                                    </div>
                                    <div class="duration_wrap">
                                        <span class="dtxt">TIMINGS</span>
                                        <span class="dtxt1">01:45 PM</span>
                                    </div>
                                    <div class="book_wrap">
                                        <a href="#"><span>$22.00</span><span>BOOK NOW</span></a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </section>

            <section class="plr-60 float-left w-100 social_wrap">
                <div class="cat-container">
                    <ul>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Twitter</a></li>
                        <li><a href="#">Linkedin</a></li>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">Youtube</a></li>
                        <li><a href="#">Skype</a></li>
                    </ul>
                </div>
            </section>

        </section>
    </section>
</section>

               


    @include('layouts.footer')

    <p id="back-top" title="Back To Top">
        <a href="#top" class="cd-top"><span class="fa fa-arrow-up"></span></a>
    </p>

    <script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>owl.js"></script>

    <!--<script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>jquery.flexslider.js"></script>

    <script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>lightbox.js"></script>-->

    <script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>plugins.js"></script>

    <script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>sly.min.js"></script>

    <script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>home.js"></script>

    <!--<script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>toastr.min.js"></script>

    <script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>toastr-custom.js"></script>-->

    <script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>bootstrap.min.js"></script>

    <!--<script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>JQueryValidate/jquery.validate.js"></script>

    <script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>JQueryValidate/additional-methods.min.js"></script>

    <script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>auth.js"></script>-->
     <script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>bootstrap-select.min.js"></script>

    <!--<script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>jquery.blockUI.js"></script>-->

    <script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>general.js"></script>

    <script>
        $(document).ready(function() {
            // hide #back-top first
            $("#back-top").hide();
            // fade in #back-top
            $(function() {
                $(window).scroll(function() {
                    if ($(this).scrollTop() > 150) {
                        $('#back-top').fadeIn();
                    } else {
                        $('#back-top').fadeOut();
                    }
                });

                // scroll body to 0px on click
                $('#back-top a').click(function() {
                    $('body,html').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                });
            });
        });

    </script>

</body>

</html>

@endsection
