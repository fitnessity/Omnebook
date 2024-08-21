<script src="https://www.google.com/recaptcha/api.js"></script>
<style>
    .modal {
        z-index: 99999;
    }
    .mybtns {
        float: left;
        color: #bdbdbd;
        font-family: 'Roboto Condensed', sans-serif;
        padding: 7px 15px;
        font-size: 16px;
        background: none;
        transition: 0.5s;
        border: none;
        text-transform: uppercase;
    }
    section.search {
        position: absolute;
        background: #ffffff;
        width: 100%;
        display: none;
    }
    #srfld {
        width: 792px;
        border: none;
        display: inherit;
        float: left;
        webkit-box-shadow: unset !important;
        box-shadow: unset;
    }
    .close-search {
        float: right;
        background: #b9babc;
        color: #ffff;
        right: 18px;
        position: absolute;
        top: 14px;
        border-radius: 135px;
        padding: 5px 10px;
    }
    .srbtn {
        float: left;
        margin-left: 15px;
        margin-right: 7px;
        border: 0;
        background: transparent;
        font-size: 23px;
        color: #b9babc;
    }
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    a:hover {
        text-decoration: none;
    }
    a:focus,
    button:focus,
    form:focus,
    input:focus {
        outline: none;
        text-decoration: none;
    }
    .btn.focus,
    .btn:focus {
        outline: 0;
        box-shadow: none;
    }
    body {
        font-family: 'Roboto', sans-serif;
    }
    header {
        width: 100%;
        background: #15181f;
        padding: 16px 0 !important;
    }
    html {
        scroll-behavior: smooth;
    }
    .top-serarch input {
        border-radius: 50px;
        width: 66%;
    }
    .top-serarch {
        position: relative;
    }
    .btn-finest {
        background-color: #ed1b24;
        border: 2px solid #ed1b24;
        color: #fff;
        text-transform: uppercase;
        border-radius: 50px;
        position: absolute;
        right: 0px;
        width: 30%;
    }
    .btn-finest:hover {
        background-color: transparent;
        border: 2px solid #fff;
        color: #ffff;
    }
    .btn-write-review {
        border: 1px solid #fff;
        color: #fff;
        text-transform: uppercase;
        border-radius: 0px;
    }
    .btn-write-review:hover {
        color: #fff;
        background-color: #ed1b24;
        border: 1px solid red;
    }
    .btn-cart {
        position: relative;
    }
    .btn-cart>span {
        background: white;
        width: 22px;
        height: 22px;
        line-height: 22px;
        display: inline-block;
        border-radius: 50px;
        position: absolute;
        top: -1px;
        right: 0px;
        color: #ed1b24;
        font-weight: bold;
    }
    .btn-web-btn {
        background-color: #f53b49;
        color: #fff !important;
        text-transform: uppercase;
        border-radius: 50px;
    }
    .btn-box .btn {
        margin: 0 6px;
        font-size: 14px;
    }
    .comp-mark {
        text-align: right;
    }
    .banner>img {
        width: 100%;
        background-size: cover;
        object-fit: cover;
        background-position: center;
        object-position: center;
    }
    .banner-below-sec {
        padding: 40px 0;
    }
    .bnr-information>h6 {
        font-size: 15px;
        font-weight: 400;
        color: #777;
        margin-bottom: 20px;
    }
    .bnr-information>p {
        font-size: 15px;
        font-weight: 400;
        color: #777;
        margin-bottom: 0;
    }
    .reatingbox>h5 {
        text-align: right;
        font-size: 14px;
        color: #777;
    }
    .reatingbox>h5>span {
        color: #f53b49;
        font-size: 18px;
    }
    .social>ul>li {
        list-style-type: none;
        float: left;
        font-size: 14px;
        margin-left: 25px;
    }
    .social>ul>li>a>i,
    .social>ul>li>a>img {
        margin-right: 10px;
    }
    .social {
        float: right;
    }
    .social>ul>li>a {
        color: #777;
    }
    section.menublck {
        padding: 20px;
        background: #000;
        color: #fff;
    }
    .name-div>span {
        margin-right: 18px;
        font-weight: 300;
        padding-top: 6px;
        display: inline-block;
    }
    .desc-sec {
        background-color: #fafafa;
        padding: 30px 0;
    }
    .desc-box {
        background-color: #fff;
        border: 1px solid #f5f5f5;
        padding: 40px;
    }
    .desc-box>p {
        color: #555;
    }
    .top-serarch input {
        border-radius: 50px;
        width: 66%;
    }
    .top-serarch {
        position: relative;
        top: 15px;
    }
    .btn-finest {
        background-color: #ed1b24;
        border: 2px solid #ed1b24;
        color: #fff;
        text-transform: uppercase;
        border-radius: 50px;
        position: absolute;
        right: 0 !important;
        width: 30%;
        top: 0;
    }
    .btn-finest:hover {
        background-color: transparent;
        border: 2px solid #fff;
        color: #ffff;
    }
    .btn-write-review {
        border: 1px solid #fff;
        color: #fff;
        text-transform: uppercase;
        border-radius: 0px;
        background-color: transparent;
    }
    .btn-write-review:hover {
        color: #fff;
        background-color: #ed1b24;
        border: 1px solid red;
    }
    .btn-cart {
        position: relative;
        background-color: transparent;
    }
    .btn-cart>span {
        background: white;
        width: 22px;
        height: 22px;
        line-height: 22px;
        display: inline-block;
        border-radius: 50px;
        position: absolute;
        top: -1px;
        right: 0px;
        color: #ed1b24;
        font-weight: bold;
    }
    .btn-web-btn {
        background-color: #f53b49 !important;
        color: #fff !important;
        text-transform: uppercase !important;
        border-radius: 50px !important;
    }
    .btn-box .btn {
        margin: 0 6px !important;
        font-size: 14px !important;
    }
    span#loginbtn {
        position: relative;
        right: 25px;
        top: 5px;
        cursor: pointer;
        font-size: 16px !important;
        color: #f5f5f5 !important;
    }
    #my_reg_btn {
        position: relative;
        top: 11px;
        right: 19px;
        cursor: pointer;
        font-size: 16px !important;
        color: #f5f5f5 !important;
    }
    .without_signin {
        position: relative;
        right: 30px;
    }
    /*------changes--------*/
    .slider-block li button {
        padding: 4px 20px !important;
        font-size: 13px !important;
        margin-top: 11px !important;
        position: relative;
        right: 10px !important;
    }
    .slider-block i.fa.fa-map-marker {
        top: 41px !important;
    }
    .catagories_btn>button {
        margin-right: 6px;
    }
    span#loginbtn>img {
        opacity: 0.8;
    }
    .slider-block h5 {
        font-weight: 400 !important;
    }
</style>
<style type="text/css">
    .frmSearch {
        border: 1px solid #a8d4b1;
        background-color: #c6f7d0;
        margin: 2px 0px;
        padding: 40px;
        border-radius: 4px;
    }
    #country-list {
        float: left;
        list-style: none;
        margin-top: -3px;
        padding-1eft: 10;
        width: 388px;
        position: absolute;
        z-index: 99;
    }
    #country-list li {
        padding: 10px;
        background: #f0f0f0;
        border-bottom: #bbb9b9 1px solid;
    }
    #country-list li:hover {
        background: #ece3d2;
        cursor: pointer;
    }
    #search-box {
        padding: 10px;
        border: #a8d4b1 1px solid;
        border-radius: 4px;
    }
</style>

<section class="search">
    <div class="container-fluid">
        <div class="row">
            <a href="#" class="close-search clsbtn"><i class="fa fa-times" aria-hidden="true"></i></a>
        </div>
    </div>
</section>

<header>
    <div class="col-lg-3">
        <a href="/"> <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>logo_new.png" height="63" width="300" /> </a>
    </div>
    <div class="col-lg-4">
        @if( isset($_SERVER['HTTPS'] ) && url()->current() != 'https://fitnessity.co')
        <form method="get" action="/search-result-location">
            <div class="form-row top-serarch">
                <input autocomplete="off" type="text" name="label" id="label" class="form-control" placeholder="Search by activity or business">
                <div id="suggesstion-box"></div>
                <button type="submit" class="btn btn-finest">Search</button>
            </div>
        </form>
        @endif

        @if( !(isset($_SERVER['HTTPS'] )) && url()->current() != 'https://fitnessity.co')
        <form method="get" action="/search-result-location">
            <div class="form-row top-serarch">
                <input autocomplete="off" type="text" name="label" id="label" class="form-control" placeholder="Search by activity or business">
                <div id="suggesstion-box"></div>
                <button type="submit" class="btn btn-finest">Search</button>
            </div>
        </form>
        @endif

        <script>
            $(document).ready(function () {
                $("#label").keyup(function () {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        type: "POST",
                        url: "/searchaction",
                        data: {
                            query: $(this).val(),
                            _token: _token
                        },
                        beforeSend: function () {
                            //$("#label").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
                        },
                        success: function (data) {
                            $("#suggesstion-box").show();
                            $("#suggesstion-box").html(data);
                            $("#label").css("background", "#FFF");
                        }
                    });
                });
            });

            $(document).on('click', '.searchclick', function () {
                $("#label").val($(this).attr('data-num'));
                $("#suggesstion-box").hide();
            });
        </script>
    </div>

    <div id="nav">
        <div class="dropdown header-search" style="display:none">
            <form id="searchform" method="post" action="/filter">
                {!! Form::token() !!}
                <input type="text" name="label" placeholder="Type to Search" style="background-color: black;color:white;padding:8px" value="@if(isset($selected_label) && $selected_label != NULL){{$selected_label }}@endif">
                <input type="hidden" name="top" id="top" value="topfilter">
                <button type="submit" class="btn btn-info btn-lg header-search-a" data-toggle="modal" data-target="#myModal3"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>search.png" height="17" width="19" /></button>
            </form>
        </div>

        <nav class="navbar navbar-inverse">
            <div class="collapse navbar-collapse" id="myNavbar">
            </div>
        </nav>
    </div>

    <div class="header-right">
        @if (Auth::guest())
        <div class="without_signin">
            <button type="button" class="btn btn-write-review" id="review-btn">Write A Review</button>
            <button type="button" class="btn btn-cart"><img src="{{asset('public/images/newimage/cart.png')}}" alt="cart"><span style="background: #eb1c24;color:#fff">0</span></button>
        </div>
        <span style="display:inline-block;color: #fff;font-size: 18px;text-align: left;" data-toggle="modal" data-target="#login_modal" href="/auth/jsModallogin" id="loginbtn"><img src="/public/images/signin.png" style="width: 45px;">Sign in or</span><span id="my_reg_btn" style="display:inline-block;color: #fff;font-size: 18px;text-align: left;" data-toggle="modal" data-target="#register_modal" href="/auth/jsModalregister" onclick="$('#fitnessity_for_business').hide();$('#learnmoreCustomer').hide();$('#learnmore').hide();$('#fitnessity_for_business_step2').hide();$('#fitnessity_for_business_step3').hide();$('#fitnessity_professional').hide();$('#fitnessity_professional_step2').hide();$('#fitnessity_professional_step3').hide();$('input').val('');$('.error.b_eml').hide()"> Register</span>
        @else
        <button type="button" style="display:none" class="btn btn-info btn-lg header-right-menu" data-toggle="modal" data-target="#login_modal" href="/auth/jsModallogin" id="loginbtn"><i class="fa fa-unlock-alt" aria-hidden="true"></i></button>
        <?php $loggedinUser = Auth::user(); ?>
        <button type="button" class="btn btn-write-review" id="review-btn">Write A Review</button>
        <button type="button" class="btn btn-cart"><img src="{{asset('public/images/newimage/cart.png')}}" alt="cart"><span>2</span></button>
        @if($loggedinUser['role'] == "customer")
        @if(Request::url() == 'https://fitnessity.co/profile/viewProfile')
        <a href="{{url('/?ver=activitybook')}}" style="margin-left:5px;"><button type="button" class="btn btn-web-btn">Book an Activity</button></a>
        @else
        <a href="#" style="margin-left:5px;"><button type="button" class="btn btn-web-btn" data-toggle="modal" data-target="#lesson_modal" href="/lesson/jsModallesson/booklesson" id="booklessonbtn">Book an Activity</button></a>
        @endif
        @endif
        <button type="button" style="display:none;" class="btn btn-info btn-lg header-right-menu signupmodal" data-toggle="modal" data-target="#register_modal" href="/auth/jsModalregister" onclick="$('#fitnessity_for_business').hide();$('#learnmoreCustomer').hide();$('#learnmore').hide();$('#fitnessity_for_business_step2').hide();$('#fitnessity_for_business_step3').hide();$('#fitnessity_professional').hide();$('#fitnessity_professional_step2').hide();$('#fitnessity_professional_step3').hide();$('input').val('');$('.error.b_eml').hide()">SIGN UP</button>

        @if((strpos(Request::url(), 'pcompany/view')) !== false)
        <a href="{{url('/profile/viewProfile')}}" style="margin-left:5px;" id="btn_myprofile1"><button type="button" class="btn btn-web-btn">My Profile</button></a>
        @else
        <a href="{{url('/profile/viewProfile')}}" style="margin-left:5px;"><button type="button" class="btn btn-web-btn">My Profile</button></a>
        @endif

        <form method="post" id="buddyloginform" action="/buddy/wp-login.php" style="float: left;margin-right: 5px; display:none">
            <input type="hidden" name="log" id="user_login" value="<?php echo substr($loggedinUser['email'], 0, strpos($loggedinUser['email'], "@")); ?>">
            <input type="hidden" name="pwd" id="user_pass" value="<?php echo $loggedinUser['buddy_key']; ?>">
            <input type="hidden" name="redirect_to" id="redirect_to" value="{{URL::to('/buddy')}}">
            <input type="hidden" value="<?php //echo wp_create_nonce();  ?>" name="_wpnonce">
            <input type="submit" name="wp-submit" class="header-right-menu topbtn my_act_feed" value="My Activity Feed">
        </form>

        <button type="button" style="margin-left:5px;border:0" class="btn btn-info btn-lg btnlogout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" data-toggle="tooltip" title="" data-original-title="Logout">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form><i class="fa fa-unlock-alt" aria-hidden="true"></i>
        </button>
        @endif
    </div>

    <!--login modal -->
    <div class="modal fade" id="login_modal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="login_modal_content"></div>
        </div>
    </div>

    <!--signup modal -->
    <div class="modal fade" id="register_modal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="register_modal_content">
            </div>
        </div>
    </div>

    <!--forgot password modal -->
    <div class="modal fade" id="password_modal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="password_modal_content"></div>
        </div>
    </div>

    <!--feedback modal -->
    <div class="modal fade" id="feedback_modal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="feedback_modal_content"></div>
        </div>
    </div>

    <!--network modal -->
    <div class="modal fade" id="network_modal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="network_modal_content"></div>
        </div>
    </div>

    <!--sports modal -->
    <div class="modal fade" id="sports_modal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="sports_modal_content"></div>
        </div>
    </div>

    <div id="lesson_section">
        <!--book a lesson modal -->
        <div class="modal" id="lesson_modal" tabindex="-1">
            <div class="modal-dialog modal-lg" style="width: 90%;">
                <div class="modal-content" id="lesson_modal_content"></div>
            </div>
        </div>
    </div>

    <div id="searchOption" class="modal searchoption-block" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-body login-pad">
                        <div class="lesson_modal_content">
                            <div class="pop-title">
                                <h3>Choose Your Search Options</h3>
                            </div>
                            <button type="button" class="close modal-close" data-dismiss="modal">
                                <img src="/public/images/close.jpg" height="70" width="34">
                            </button>

                            <div class="signup">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="instantboxes-two">
                                            <p class="instantmatch">INSTANT MATCH</p>
                                            <div class="contetnmain">
                                                <div class="inimg">
                                                    <img src="/public/img/instant-match.jpg">
                                                </div>
                                                <div class="content-in">
                                                    <div class="">
                                                        <img src="/public/img/in-icon1.jpg">
                                                        <h6>Answer Some Questions</h6>
                                                        <p>Tell us what you are looking for so we can find you the right provider.</p>
                                                    </div>

                                                    <div class="">
                                                        <img src="/public/img/in-icon2.jpg">
                                                        <h6>Get Matched</h6>
                                                        <p>Get matched with multiple experts in your area the meets your needs.</p>
                                                    </div>

                                                    <div class="">
                                                        <img src="/public/img/in-icon3.jpg">
                                                        <h6>Hire The Right Expert</h6>
                                                        <p>Compare offers, ask questions, and hire when ready.</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <a data-toggle="modal" onclick="close_searchOption()" data-target="#searchoptionform" class="continue  btn_select searchoptionform">CONTINUE</a>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="instantboxes-two">
                                            <p class="instantmatch">DIRECT HIRE</p>
                                            <div class="contetnmain">
                                                <div class="inimg">
                                                    <img src="/public/img/DIRECT-HIRE.jpg">
                                                </div>
                                                <div class="content-in tow">
                                                    <h6>Direct Hire - Search for 1-on-1 lessons, classes and expriences. Find the activite you love, invite family and friends to join you.</h6>
                                                    <h6>Get Specific - Compare activites, businesses, profiles, prices, services, reviews background checked, verified, personality and more. Book from multiple service providers from any business all at once.</h6>
                                                </div>
                                            </div>
                                            <a href="{{ Config::get('constants.SITE_URL') }}/direct-hire" class="continue  btn_select searchoptionform">CONTINUE</a>
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

    <!--form model-->
    <div id="searchoptionform" class="modal searchoptionform-block" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-content">
                    <div class="modal-body login-pad">
                        <div class="lesson_modal_content">
                            <div class="signup">
                                <div class="row">
                                    <?php $step_count = 3; ?>
                                    <?php $current_step = 1; ?>
                                    <form  action="/addinstantHire" method="POST">
                                        @csrf
                                        <div class="lesson_modal_content" id="step_sport_select">
                                            <div class="modal-body login-pad">                                           
                                                <div class="qh-step-bar">
                                                    <div class="qh-step-bar-status"> </div>
                                                </div>

                                                <div class="modal-body login-pad">
                                                    <div class="qh-step-title">
                                                        <span class="qh-info"><i class="fa fa-info"></i></span>
                                                        <h1 class="qh-title head-hd" style="color:red">Step <?php echo $current_step++ . " of " . $step_count; ?></h1>
                                                        <h1 class="qh-title subtitle-hd">Let’s get started by asking you a few questions to help you find the service provider that matches what you are looking for.</h1>
                                                        <button type="button" class="close qh-close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34" /> </button>
                                                    </div>

                                                    <div class="emplouyee-form employee-frm">
                                                        <!-- Step_1-->
                                                        <div class="form-group">
                                                            <span id="actismsg"></span>
                                                            <label>Choose Your Activity</label>
                                                            <div class="select-style review-select2">
                                                                <select id="sport" name="sport" class="selectpicker">
                                                                    <option>Select</option>>
                                                                    @if(isset($sports_list))    
                                                                    @foreach ($sports_list as $record)
                                                                    <option value="{{$record->sport_name}}"> {{$record->sport_name}} </option>
                                                                    @endforeach
                                                                    @endif 
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <!-- Step_2-->
                                                        <div class="form-group">
                                                            <span id="quotesmsg"></span>
                                                            <label>How many quotes would you like to receive from professionals?<br> (Choose a minimum of 5 and maximum of 20)</label>
                                                            <input type="text" name="qoutes" id="quotes" placeholder="Number of quotes" />

                                                        </div>

                                                        <!-- Step_3-->
                                                        <div class="form-group">
                                                            <div class="multiples">
                                                                <label>Who is participating ?</label>
                                                                <select id="activity_for" name="activity_for[]" class="selectpicker" multiple>
                                                                    @if(isset($activity))
                                                                    @foreach ($activity as $pkey => $pval)
                                                                    <option value='{{$pkey}}'> {{$pval}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <!-- Step_3-->
                                                        <div class="form-group">
                                                            <div class="multiples">
                                                                <label>Language your professional should speak.</label>
                                                                <!-- <div class="select-style review-select2"> -->
                                                                <select id="Language" name="language[]" class="selectpicker" multiple>
                                                                    @if(isset($language))    
                                                                    @foreach ($language as $lkey => $lval)
                                                                    <option value="{{$lval->name}}">{{$lval->name}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                                <!-- </div> -->
                                                            </div>
                                                        </div>

                                                        <!-- Step_4-->
                                                        <div class="form-group">
                                                            <label>What’s your skill level in this activity?</label>
                                                            <div class="select-style review-select2">
                                                                <select name="expLevel[]" class="selectpicker">
                                                                    <option>What’s your skill level in this activity</option>
                                                                    @if(isset($expLevel))    
                                                                    @foreach ($expLevel as $elkey => $elval)
                                                                    <option value='{{$elkey}}'> {{$elval}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <!-- Step_4-->
                                                        <div class="form-group">
                                                            <label>What activity experience are you looking for?</label>
                                                            <div class="select-style review-select2">
                                                                <select name="expActivity[]" class="selectpicker">
                                                                    <option>What activity experience are you looking for?</option>
                                                                    @if(isset($expActivity))
                                                                    @foreach($expActivity as $key=> $p)
                                                                    <?php $key = str_replace(' ', '_', strtolower($key)); ?>
                                                                    <option value="{{$key}}">{{$p}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <!-- Step_4-->
                                                        <div class="form-group">
                                                            <label>What experience level should your professional have?</label>
                                                            <div class="select-style review-select2">
                                                                <select name="expProfessional[]" class="selectpicker">
                                                                    <option>What experience level should your professional have?</option>
                                                                    @if(isset($expProfessional))
                                                                    @foreach($expProfessional as $key=> $el)
                                                                    <option value="{{$key}}">{{$el}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <!-- Step_4-->
                                                        <div class="form-group">
                                                            <label>Do you have gear for this activity?</label><br>
                                                            <label class="radio-inline" style="margin-top: 2%;padding-left: 12px;">
                                                                <input type="radio" onclick="javascript:yesnoCheck4();" name="gear" value="false" id="noCheck4" checked="checked"><span style="margin-left: 80%;">No</span>
                                                            </label>
                                                            <label class="radio-inline" style="margin-top: 2%;margin-left: 40px;">
                                                                <input type="radio" onclick="javascript:yesnoCheck4();" name="gear" value="true" id="yesCheck4"><span style="margin-left: 80%;">Yes</span>
                                                            </label>
                                                            <div id="ifYes4" style="display: none;">
                                                                <input type='text' id='yes' placeholder="Please list the gear you have to participate in the activity." name="gearYes">
                                                            </div>
                                                        </div>

                                                        <!-- Step_5-->
                                                        <div class="form-group">
                                                            <label>How often are you active?</label>
                                                            <div class="select-style review-select2">
                                                                <select name="activeLevel" class="selectpicker">
                                                                    <option>How often are you active</option>
                                                                    @if(isset($activeLevel))
                                                                    @foreach($activeLevel as $key=> $al)
                                                                    <option value="{{$key}}">{{$al}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <!-- Step_6-->
                                                    </div>

                                                    <div class="clearfix"></div>
                                                    <div class="qh-next">
                                                        <a class="qh-continue submitInstant" >continue</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="lesson_modal_content" id="step_1" style="display:none;">
                                            <div class="qh-step-bar">
                                                <div class="qh-step-bar-status"> </div>
                                            </div>

                                            <div class="modal-body login-pad">
                                                <div class="qh-step-title">
                                                    <span class="qh-info"><i class="fa fa-info"></i></span>
                                                    <h1 class="qh-title" style="color:red"><b>Step <?php echo $current_step++ . " of " . $step_count; ?></b></h1>
                                                    <button type="button" class="close qh-close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34" /> </button>
                                                </div>

                                                <div class="emplouyee-form employee-frm">
                                                    <!-- STEP7-->
                                                    <div class="form-group">
                                                        <div class="multiples">
                                                            <label>Where would you like to do this activity?</label>
                                                            <!-- <div class="select-style review-select2"> -->
                                                            <select id="do_activity" name="do_activity[]" class="selectpicker" multiple>           
                                                                <!-- name="question[train_location][answer][]"  -->
                                                                <option>Where would you like to do this activity?</option>
                                                                @if(isset($serviceLocation))
                                                                @foreach ($serviceLocation as $slkey => $slval)
                                                                <?php $slkey = str_replace(' ', '_', strtolower($slkey)); ?>
                                                                <option value='{{$slkey}}'>{{$slval}}</option>
                                                                @endforeach 
                                                                @endif
                                                            </select>   
                                                            <!-- </div> -->
                                                        </div>
                                                    </div>

                                                    <!-- STEP8-->
                                                    <div class="form-group">
                                                        <div class="multiples">
                                                            <label>Which personality & habits should your professional have? </label>
                                                            <!-- <div class="select-style review-select2"> -->
                                                            <select id="which_personality" name="which_personality[]" class="selectpicker" multiple>
                                                                <!-- name="question[best_work][answer][]" -->
                                                                <option>Which personality & habits should your professional have?</option>
                                                                @if(isset($teaching))
                                                                @foreach ($teaching as $elkey => $elval)
                                                                <option value='{{$elkey}}'> {{$elval}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                            <!-- </div> -->
                                                        </div>
                                                    </div>

                                                    <!-- STEP9-->
                                                    <div class="form-group">
                                                        <label>Any Gender Preference?</label>
                                                        <div class="select-style review-select2">
                                                            <select name="gender" class="selectpicker">
                                                                <option>Any Gender Preference</option>
                                                                @if(isset($gender))
                                                                @foreach ($gender as $elkey => $gval)
                                                                <option value="{{$elkey}}">{{$gval}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- STEP10-->
                                                    <div class="form-group">
                                                        <label>What is the Age Range?</label>
                                                        <div class="select-style review-select2">
                                                            <select name="ageRange" class="selectpicker">
                                                                <option>What is the Age Range?</option>
                                                                @if(isset($ageRange))
                                                                @foreach ($ageRange as $arkey => $arval)
                                                                <?php $arkey = str_replace(' ', '_', strtolower($arkey)); ?>
                                                                <option value='{{$arval}}'> {{$arval}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- STEP11-->
                                                    <div class="form-group">
                                                        <label>How often will you participate in this activity?</label>
                                                        <div class="select-style review-select2">
                                                            <select name="participateActivity" class="selectpicker">
                                                                <option> How often will you participate in this activity?</option>
                                                                @if(isset($participateActivity))
                                                                @foreach ($participateActivity as $key => $paval)
                                                                <option value="{{$key}}">{{$paval}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- STEP12-->
                                                    <div class="form-group">
                                                        <div class="multiples">
                                                            <label>What days are you free?</label>
                                                            <select id="days" name="days[]" class="selectpicker" multiple>
                                                                @if(isset($dayactivity))
                                                                @foreach ($dayactivity as $key => $dval)
                                                                <option value="{{$key}}">{{$dval}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- <div class="clearfix"></div> -->
                                                <div class="qh-next" style="margin-top: -40px;">
                                                    <!-- <button type="button" class="close qh-back" onClick="gobackStep('sport_select')" ><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>back.jpg" height="70" width="34"/> </button> -->
                                                    <a class="qh-continue" onClick="gobackStep('sport_select')">Previous</a>
                                                    <a class="qh-continue" onclick="$('#step_1').hide();$('#step_2').show();">continue</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="lesson_modal_content" id="step_2" style="display:none;">
                                            <div class="qh-step-bar">
                                                <div class="qh-step-bar-status"> </div>
                                            </div>

                                            <div class="modal-body login-pad">
                                                <div class="qh-step-title">
                                                    <span class="qh-info"><i class="fa fa-info"></i></span>
                                                    <h1 class="qh-title" style="color:red"><b>Step <?php echo $current_step++ . " of " . $step_count; ?></b></h1>
                                                    <button type="button" class="close qh-close" data-dismiss="modal"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34" /> </button>
                                                </div>
                                                <div class="emplouyee-form employee-frm">

                                                    <!-- Step_13 -->
                                                    <div class="form-group">
                                                        <div class="multiples">
                                                            <label>What time period works best for you?</label>
                                                            <select id="time_period" name="time_available[]" class="selectpicker" multiple>
                                                                @if(isset($getTimeSlot))
                                                                @foreach ($getTimeSlot as $key => $slotval)
                                                                <option value="{{$key}}">{{$slotval}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Step_14 -->
                                                    <div class="form-group">
                                                        <label>Any medical issues?</label>
                                                        <br>
                                                        <label class="radio-inline" style="padding-left: 12px;">
                                                            <input type="radio" onclick="javascript:yesnoCheck();" name="medicalIssue" value="false" id="noCheck" checked="checked"><span style="margin-left: 80%;">No</span>
                                                        </label>
                                                        <label class="radio-inline" style="margin-left: 40px;">
                                                            <input type="radio" onclick="javascript:yesnoCheck();" name="question[medical][answer]" value="true" id="yesCheck"><span style="margin-left: 80%;">Yes</span>
                                                        </label>
                                                        <div id="ifYes" style="display: none;">
                                                            <input type='text' id='yes' placeholder="Please list your medical issues so the professional can plan accordingly." name='medicalYes'>
                                                        </div>
                                                    </div>

                                                    <!-- Step_15 -->
                                                    <div class="form-group">
                                                        <label>Are you willing to travel to the professionals specified training location? (park, gym, etc.)</label>
                                                        <div class="select-style review-select2">
                                                            <select name="trainingLocation" class="selectpicker">
                                                                @if(isset($trainingLocation))
                                                                @foreach ($trainingLocation as $key => $locval)
                                                                <option value="{{$key}}">{{$locval}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Step_15 -->

                                                    <div class="form-group">
                                                        <label>How soon do you want to start?</label>
                                                        <div class="select-style review-select2">
                                                            <select name="StartActivity" class="selectpicker">
                                                                @if(isset($StartActivity))
                                                                @foreach ($StartActivity as $key => $actsval)
                                                                <option value="{{$key}}">{{$actsval}}</option>
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- Step_15 -->
                                                    <div class="form-group">
                                                        <label>I am willing to travel up to</label>
                                                        <div class="select-style review-select2">
                                                            <select name="travelUpto" class="selectpicker">
                                                                @if(isset($travelUpto))
                                                                @foreach ($travelUpto as $key => $travelval)
                                                                <option value="{{$key}}">{{$travelval}}</option>    
                                                                @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label id="zipmsg">Enter the desired zip code. We locate the top service providers closest to you.</label>
                                                        <input type="text" name="zipcode" id="zipcode" placeholder="10982" />
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="qh-next">
                                                    <input type="hidden" name="notificationby" class="chkqt" value="email">
                                                    <!--  <button type="button" class="close qh-back"  onClick="gobackStep('1')"><img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>back.jpg" height="70" width="34"/> </button> -->
                                                    <a class="qh-continue" onClick="gobackStep('1')">Previous</a>
                                                    <input type="submit" class="qh-continue" id="submitform" value="Send">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- </form> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!--end for form model-->
</header>

<!--end header-->

<script>
    function close_searchOption() {
        console.log('model close- search close');
        $('#searchOption').modal('toggle');
    }

    $(document).ready(function () {
        $('#review-btn').click(function () {
            window.location.href = "{{url('/reviews')}}"
        })

        if (window.location.href.split('?showstep=').pop() == 1) {
            $(".signupmodal").click()
        }

        $(".modal").on("shown.bs.modal", function () {
            $('body').addClass('modal-open');
        });

        $("#btn_myprofile1").click(function () {
            formdata = new FormData();
            var token = '{{csrf_token()}}';
            formdata.append("_token", token)
            $.ajax({
                url: '/profile/switchaccount',
                type: 'POST',
                dataType: 'json',
                data: formdata,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $("#_token").val()
                },
                success: function (response) {
                    if (response.type === 'success') {
                        // $('#upgradeProfileForm').modal('hide'); 
                        window.location.href = "/profile/viewProfile";
                    }
                }
            });
        })

        $(".modal").on("hidden.bs.modal", function () {
            var modal_id = $(this).attr('id');
            if (modal_id == "feedback_modal") {
                $(this).find("#rating").val("");
                $(this).find("#stars").find("span").removeClass("glyphicon-star").addClass("glyphicon-star-empty");
                $(this).find("#comment").val("");
                $(this).find("#suggestion").val("");
                if (!$(this).find("#name").attr("readonly"))
                    $(this).find("#name").val("");
                if (!$(this).find("#email").attr("readonly"))
                    $(this).find("#email").val("");
                $(this).find("#systemMessage").html('');
            } else if (modal_id == "register_modal") {
                $(this).find('#signup_normal').show();
                $(this).find('#signup_selection').hide();
                $(this).find("#firstname").val("");
                $(this).find("#lastname").val("");
                $(this).find("#email").val("");
                $(this).find("#password").val("");
                $(this).find("#confirm_password").val("");
                $(this).find("label.error").remove();
                grecaptcha.reset();
            } else {
                $(this).removeData();
                // $(this).find("#systemMessage").html(''); 
            }
        });

        $("button").click(function () {
            // $('#signup_selection').hide();
            // $('#signup_normal').show();
        });
        //register validations
        // fetch param from url
        var getUrlParameter = function getUrlParameter(sParam) {
            var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                    sURLVariables = sPageURL.split('&'),
                    sParameterName,
                    i;
            for (i = 0; i < sURLVariables.length; i++) {
                sParameterName = sURLVariables[i].split('=');
                if (sParameterName[0] === sParam) {
                    return sParameterName[1] === undefined ? true : sParameterName[1];
                }
            }
        };
        //if found the success param and its true than open login modal
        var status = getUrlParameter('success');
        if (status === "true") {
            $('#loginbtn').trigger('click');
        }
    });

    function openLoginModal(modalname) {
        if (modalname == 'login') {
            $("#register_modal").modal('hide');
            $("#password_modal").modal('hide');
        } else if (modalname == 'register') {
            // $("#learnmore_modal").modal('hide');
            // $("#communitylearnmore_modal").modal("hide");
            $("#login_modal").modal('hide');
            $("#password_modal").modal('hide');
        } else if (modalname == 'password') {
            $("#login_modal").modal('hide');
            $("#register_modal").modal('hide');
        } else if (modalname == 'learnmore') {
            $("#login_modal").modal('hide');
            $("#register_modal").modal('hide');
        } else if (modalname == 'terms_condition') {
            $("#terms_modal").modal('show');
        } else if (modalname == 'sport-alert') {
            $("#login_modal").modal('hide');
        }
    }

    $(".submitInstant").click(function () {
        console.log('sdfsfs')
        var re = 0;
        $('#quotesmsg').hide();
        var v = $('#quotes').val();
        if (v == '') {
            $('#quotesmsg').text('Please Fill this field').css('color', "red").show();
            $('#quotes').val('').focus();
            re = 0;
        }
        if (v >= 5 && v <= 20) {
            $('#step_sport_select').hide();
            $('#step_1').show();
        } else {
            $('#quotesmsg').text('Choose a minimum of 5 and maximum of 20').css('color', "red").show();
            $('#quotes').val('').focus();
        }
        var sport = $('#sport').val();
        if (sport == '') {
            $('#actismsg').text('Please Fill this field').css('color', "red").show();
            $('#sport').val('').focus();
            re = 0;
        }
        if (re == 0) {
            return false;
        } else {
            return true;
        }
    });
</script>

