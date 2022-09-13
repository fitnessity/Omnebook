<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <title>Fitnessity</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta content="charset=utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content=" Fitnessity: Because Fitness=Necessity ">
        <meta itemprop="name" content="">
        <meta itemprop="description" content=" Fitnessity: Because Fitness=Necessity ">
        <meta itemprop="image" content="">
        <meta name="twitter:card" content="product">
        <meta name="twitter:title" content="">
        <meta name="twitter:description" content=" Fitnessity: Because Fitness=Necessity ">
        <meta name="twitter:image" content="">
        <meta property="og:url" content="">
        <meta property="og:type" content="">
        <meta property="og:title" content="">
        <meta property="og:description" content=" Fitnessity: Because Fitness=Necessity ">
        <meta property="og:image" content="">
        <meta property="og:site_name" content="Fitnessity">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <link rel="shortcut icon" href="{{ url('public/images/email/favicon.ico') }}">
        <link rel="icon" href="{{ url('public/images/email/favicon.ico') }}">
        <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,700,900'>
        <link rel='stylesheet' type='text/css'href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300'>
        <link rel='stylesheet' type='text/css' href="<?php echo Config::get('constants.FRONT_CSS'); ?>font-awesome.css">
        <link rel='stylesheet' type='text/css' href="<?php echo Config::get('constants.FRONT_CSS'); ?>owl.css">
        <link rel='stylesheet' type='text/css' href="<?php echo Config::get('constants.FRONT_CSS'); ?>bootstrap.css">
        <link rel='stylesheet' type='text/css' href="<?php echo Config::get('constants.FRONT_CSS'); ?>bootstrap-select.min.css">
        <link rel='stylesheet' type='text/css' href="<?php echo Config::get('constants.FRONT_CSS'); ?>/frontend/general.css">
        <link rel='stylesheet' type='text/css' href="<?php echo Config::get('constants.FRONT_CSS'); ?>responsive.css">
        <script src="<?php echo Config::get('constants.FRONT_JS'); ?>jquery.1.11.1.min.js"></script>
    </head>

    <body>
        <? $module = explode(".co/", url()->current());?>
        <header>
            <div class="col-lg-12">
                <div class="menu_nav">
                    <a href="{{ Config::get('constants.SITE_URL') }}/" class="logo"> <img src="{{ asset('public/images/logo/fiynessity-logo.png') }}"> </a>
                    <nav id='cssmenu'>
                        <div class="button"><span></span></div>
                        <ul>
                            <li class="{{ (!isset($module[1])) ? 'active' : '' }}"><a href="{{ Config::get('constants.SITE_URL') }}/">Home</a></li>
                            <!--<li><a href='#activity' rel="" class="anchorLink">Join Activity</a></li>-->
                            <li class="{{ (strpos(url()->current(), 'about-us') !== false) ? 'active' : '' }}"><a href="{{ Config::get('constants.SITE_URL') }}/about-us" rel="" class="anchorLink">Why Fitnessity</a></li>
                            <li class="{{ (strpos(url()->current(), 'discover') !== false) ? 'active' : '' }}"><a href="{{ Config::get('constants.SITE_URL') }}/discover" rel="" class="anchorLink">Discover</a></li>
                            <li class="{{ (strpos(url()->current(), 'be-a-part') !== false) ? 'active' : '' }}"><a href="{{ Config::get('constants.SITE_URL') }}/be-a-part" rel="" class="anchorLink">Be a part</a></li>
                            <li class="{{ (strpos(url()->current(), 'hire-trainer') !== false) ? 'active' : '' }}"><a href="{{ Config::get('constants.SITE_URL') }}/hire-trainer" rel="" class="anchorLink">Hire Trainer</a></li>
                            <li class="{{ (strpos(url()->current(), 'contact-us') !== false) ? 'active' : '' }}"><a href="{{ Config::get('constants.SITE_URL') }}/contact-us">Contact Us</a></li>
                            <li class="{{ (strpos(url()->current(), 'instant-hire') !== false) ? 'active' : '' }}"><a href="/instant-hire" rel="" class="anchorLink">Book an Activity</a></li>
                        </ul>
                    </nav>
                    <div class="header-right">
                        <form id="searchform" method="" action="{{url('/search-result-location')}}">
                            <div class="form-row top-serarch">
                                <input autocomplete="off" type="text" name="label" id="label" class="form-control" placeholder="Search by activity or bussiness">
                                <button type="submit" class="btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </form>
                        <div class="userblock">
                            <div class="login_links"><img src="{{ asset('public/images/user-icon.png') }}" alt=""></div>
                            <div class="dropdown_login">
                                <svg focusable="false" class="icon--nav-triangle-borderless" viewBox="0 0 20 9" role="presentation">
                                <path d="M.47108938 9c.2694725-.26871321.57077721-.56867841.90388257-.89986354C3.12384116 6.36134886 5.74788116 3.76338565 9.2467995.30653888c.4145057-.4095171 1.0844277-.40860098 1.4977971.00205122L19.4935156 9H.47108938z" fill="#ffffff"></path>
                                </svg>
                                <ul>
                                    @if(Auth::user())
                                    <li><a href="#">Welcome {{ Auth::user()->firstname }}</a></li>
                                    <li><a href="{{route('profile-viewProfile')}}">Profile</a></li>
                                    <li><a href="{{route('user-profile')}}">Edit Profile</a></li>
                                    <li><a href="{{route('welcomeBusinessProfile')}}">Create Business</a></li>
                                    <li><a href="{{route('manageCompany')}}">Manage Business</a></li>
                                    <li><a href="{{ Config::get('constants.SITE_URL') }}/userlogout">Logout</a></li>
                                    @else
                                    <li><a href="{{ Config::get('constants.SITE_URL') }}/userlogin">Login</a></li>
                                    <li><a href="{{ Config::get('constants.SITE_URL') }}/registration">Register</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <button type="button" class="btn-cart">
                            <img src="{{ asset('public/images/cart-icon.png') }}" alt="cart"><span>0</span>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <section id="content">
            <section class="vbox">
                <section class="scrollable padder">
                    @yield('content')
                </section>
            </section>
        </section>

    </body>
</html>

<script>
$(document).ready(function () {
    //$(document).on('change','.myfilter', function () {
    $('.myfilter2').click(function () {
        $('.myfilter').trigger('change');
    });
    
    $('.myfilter').change(function () {
        var form = $("form#searchform").serialize();
        url = '/samfilter';
        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}',
            },
            data: {
                "_token": '{{csrf_token()}}',
                data: form
            },
            success: function (response) {

                $('.direc-right div#buisnessuser').empty();
                $('.direc-right div#buisnessuser').html(response);
            }
        });
    });
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
</script>