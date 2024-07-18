@inject('request', 'Illuminate\Http\Request')

@extends('layouts.header')

@section('content')

            <section class="category viewall_sports viewallcontainer inner_top">

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

                    <div class="cate-list col-md-12">

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="cat-item style_prevu_sp">
                                <div class="cat-img-name width-img">
                                    <img class="cat-img-name-allsport-img" src="{{ asset('public/images/sports/sports1.jpg')}}" alt="Fitnessity" />
                                </div>
                                <div class="cat-detail">
                                    <h1>Aerobics</h1>
                                    <a type="button" data-toggle="modal" data-target="#login_modal" href="#" title="Login to book professional" onclick="$('#child_sports_modal').modal('hide');">Book Now</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="cat-item style_prevu_sp">
                                <div class="cat-img-name width-img">
                                    <img class="cat-img-name-allsport-img" src="{{ asset('public/images/sports/sports2.jpg')}}" alt="Fitnessity" />
                                </div>
                                <div class="cat-detail">
                                    <h1>Badminton</h1>
                                    <a type="button" data-toggle="modal" data-target="#login_modal" href="#" title="Login to book professional" onclick="$('#child_sports_modal').modal('hide');">Book Now</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="cat-item style_prevu_sp">
                                <div class="cat-img-name width-img">
                                    <img class="cat-img-name-allsport-img" src="{{ asset('public/images/sports/sports3.jpg')}}" alt="Fitnessity" />
                                </div>
                                <div class="cat-detail">
                                    <h1>Archery</h1>
                                    <a type="button" data-toggle="modal" data-target="#login_modal" href="#" title="Login to book professional" onclick="$('#child_sports_modal').modal('hide');">Book Now</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="cat-item style_prevu_sp">
                                <div class="cat-img-name width-img">
                                    <img class="cat-img-name-allsport-img" src="{{ asset('public/images/sports/coming-soon.jpg')}}" alt="Fitnessity" />
                                </div>
                                <div class="cat-detail">
                                    <h1>Barre</h1>
                                    <a type="button" data-toggle="modal" data-target="#login_modal" href="/auth/jsModallogin/71" title="Login to book professional" onclick="$('#child_sports_modal').modal('hide');">Book Now</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="cat-item style_prevu_sp">
                                <div class="cat-img-name width-img">
                                    <img class="cat-img-name-allsport-img" src="{{ asset('public/images/sports/coming-soon.jpg')}}" alt="Fitnessity" />
                                </div>
                                <div class="cat-detail">
                                    <h1>BADMINTON</h1>
                                    <a type="button" data-toggle="modal" data-target="#login_modal" href="/auth/jsModallogin/71" title="Login to book professional" onclick="$('#child_sports_modal').modal('hide');">Book Now</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="cat-item style_prevu_sp">
                                <div class="cat-img-name width-img">
                                    <img class="cat-img-name-allsport-img" src="{{ asset('public/images/sports/coming-soon.jpg')}}" alt="Fitnessity" />
                                </div>
                                <div class="cat-detail">
                                    <h1>ARCHERY</h1>
                                    <a type="button" data-toggle="modal" data-target="#login_modal" href="/auth/jsModallogin/71" title="Login to book professional" onclick="$('#child_sports_modal').modal('hide');">Book Now</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="cat-item style_prevu_sp">
                                <div class="cat-img-name width-img">
                                    <img class="cat-img-name-allsport-img" src="{{ asset('public/images/sports/coming-soon.jpg')}}" alt="Fitnessity" />
                                </div>
                                <div class="cat-detail">
                                    <h1>Barre</h1>
                                    <a type="button" data-toggle="modal" data-target="#login_modal" href="/auth/jsModallogin/71" title="Login to book professional" onclick="$('#child_sports_modal').modal('hide');">Book Now</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="cat-item style_prevu_sp">
                                <div class="cat-img-name width-img">
                                    <img class="cat-img-name-allsport-img" src="{{ asset('public/images/sports/coming-soon.jpg')}}" alt="Fitnessity" />
                                </div>
                                <div class="cat-detail">
                                    <h1>BASEBALL</h1>
                                    <a type="button" data-toggle="modal" data-target="#login_modal" href="/auth/jsModallogin/71" title="Login to book professional" onclick="$('#child_sports_modal').modal('hide');">Book Now</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="cat-item style_prevu_sp">
                                <div class="cat-img-name width-img">
                                    <img class="cat-img-name-allsport-img" src="{{ asset('public/images/sports/coming-soon.jpg')}}" alt="Fitnessity"/>
                                </div>
                                <div class="cat-detail">
                                    <h1>BASKETBALL</h1>
                                    <a type="button" data-toggle="modal" data-target="#login_modal" href="/auth/jsModallogin/71" title="Login to book professional" onclick="$('#child_sports_modal').modal('hide');">Book Now</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="cat-item style_prevu_sp">
                                <div class="cat-img-name width-img">
                                    <img class="cat-img-name-allsport-img" src="{{ asset('public/images/sports/coming-soon.jpg')}}" alt="Fitnessity"/>
                                </div>
                                <div class="cat-detail">
                                    <h1>BEACH VOLLEYBALL</h1>
                                    <a type="button" data-toggle="modal" data-target="#login_modal" href="/auth/jsModallogin/71" title="Login to book professional" onclick="$('#child_sports_modal').modal('hide');">Book Now</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="cat-item style_prevu_sp">
                                <div class="cat-img-name width-img">
                                    <img class="cat-img-name-allsport-img" src="{{ asset('public/images/sports/coming-soon.jpg')}}" alt="Fitnessity" />
                                </div>
                                <div class="cat-detail">
                                    <h1>BOULDERING</h1>
                                    <a type="button" data-toggle="modal" data-target="#login_modal" href="/auth/jsModallogin/71" title="Login to book professional" onclick="$('#child_sports_modal').modal('hide');">Book Now</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="cat-item style_prevu_sp">
                                <div class="cat-img-name width-img">
                                    <img class="cat-img-name-allsport-img" src="{{ asset('public/images/sports/coming-soon.jpg')}}" alt="Fitnessity" />
                                </div>
                                <div class="cat-detail">
                                    <h1>BUNGEE JUMPING</h1>
                                    <a type="button" data-toggle="modal" data-target="#login_modal" href="/auth/jsModallogin/71" title="Login to book professional" onclick="$('#child_sports_modal').modal('hide');">Book Now</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="cat-item style_prevu_sp">
                                <div class="cat-img-name width-img">
                                    <img class="cat-img-name-allsport-img" src="{{ asset('public/images/sports/coming-soon.jpg')}}" alt="Fitnessity" />
                                </div>
                                <div class="cat-detail">
                                    <h1>CAMPS & CLINIC</h1>
                                    <a type="button" data-toggle="modal" data-target="#login_modal" href="/auth/jsModallogin/71" title="Login to book professional" onclick="$('#child_sports_modal').modal('hide');">Book Now</a>
                                </div>
                            </div>
                        </div>

                        
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="cat-item style_prevu_sp">
                                <div class="cat-img-name width-img">
                                    <img class="cat-img-name-allsport-img" src="{{ asset('public/images/sports/coming-soon.jpg')}}" alt="Fitnessity" />
                                </div>
                                <div class="cat-detail">
                                    <h1>CANOEING</h1>
                                    <a type="button" data-toggle="modal" data-target="#login_modal" href="/auth/jsModallogin/71" title="Login to book professional" onclick="$('#child_sports_modal').modal('hide');">Book Now</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <div class="cat-item style_prevu_sp">
                                <div class="cat-img-name width-img">
                                    <img class="cat-img-name-allsport-img" src="{{ asset('public/images/sports/coming-soon.jpg')}}" alt="Fitnessity" />
                                </div>
                                <div class="cat-detail">
                                    <h1>CYCLING</h1>
                                    <a type="button" data-toggle="modal" data-target="#login_modal" href="/auth/jsModallogin/71" title="Login to book professional" onclick="$('#child_sports_modal').modal('hide');">Book Now</a>
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

    <script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>jquery.flexslider.js"></script>

    <script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>lightbox.js"></script>

    <script src="https://darsa.in/sly/examples/js/vendor/plugins.js"></script>

    <script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>sly.min.js"></script>

    <script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>home.js"></script>

    <script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>toastr.min.js"></script>

    <script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>toastr-custom.js"></script>

    <script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>bootstrap.min.js"></script>

    <script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>JQueryValidate/jquery.validate.js"></script>

    <script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>JQueryValidate/additional-methods.min.js"></script>

    <script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>auth.js"></script>
    
    <script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>bootstrap-select.min.js"></script>

    <script src="<?php echo Config::get('constants.FRONT_NEW_JS'); ?>jquery.blockUI.js"></script>

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