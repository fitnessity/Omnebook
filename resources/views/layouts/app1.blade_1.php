<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta content="charset=utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Instant Hire - Fitnessity</title>
        <meta name="description" content="@if(isset($fbshare_desc)){{$fbshare_desc}}@else Fitnessity: Because Fitness=Necessity @endif">
        <!-- Schema.org markup for Google+ -->
        <meta itemprop="name" content="@if(isset($fbshare_title)){{$fbshare_title}}@endif">
        <meta itemprop="description" content="@if(isset($fbshare_desc)){{$fbshare_desc}}@else Fitnessity: Because Fitness=Necessity @endif">
        <meta itemprop="image" content="@if(isset($fbshare_image)){{$fbshare_image}}@endif">
        <!-- Twitter Card data -->
        <meta name="twitter:card" content="product">
        <meta name="twitter:title" content="@if(isset($fbshare_title)){{$fbshare_title}}@endif">
        <meta name="twitter:description" content="@if(isset($fbshare_desc)){{$fbshare_desc}}@else Fitnessity: Because Fitness=Necessity @endif">
        <meta name="twitter:image" content="@if(isset($fbshare_image)){{$fbshare_image}}@endif">
        <meta property="og:url"         content="@if(isset($fbshare_url)){{$fbshare_url}}@endif" />
        <meta property="og:type"        content="@if(isset($fbshare_type)){{$fbshare_type}}@endif" />
        <meta property="og:title"       content="@if(isset($fbshare_title)){{$fbshare_title}}@endif" />
        <meta property="og:description" content="@if(isset($fbshare_desc)){{$fbshare_desc}}@else Fitnessity: Because Fitness=Necessity @endif" />
        <meta property="og:image"       content="@if(isset($fbshare_image)){{$fbshare_image}}@endif" />
        <meta property="og:site_name"   content="Fitnessity" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link rel="shortcut icon" href="{{ url('public/images/email/favicon.ico') }}" >
        <link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,700,900' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
        <link type="image/x-icon" href="{{ url('public/images/email/favicon.ico') }}" rel="icon">
        <link href="<?php echo Config::get('constants.FRONT_CSS'); ?>font-awesome.css" rel="stylesheet">
        <!-- Add fancyBox main JS and CSS files -->
        <link rel="stylesheet" type="text/css" href="<?php echo Config::get('constants.FRONT_CSS'); ?>lightbox.min.css">
        <!-- Owl Carousel Assets -->
        <link href="<?php echo Config::get('constants.FRONT_CSS'); ?>owl.carousel.css" rel="stylesheet">
        <link href="<?php echo Config::get('constants.FRONT_CSS'); ?>owl.theme.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>flexslider.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>bootstrap.css">
        <link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>datepicker.css">
        <link href="<?php echo Config::get('constants.FRONT_CSS'); ?>general.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo Config::get('constants.FRONT_CSS'); ?>responsive.css" type="text/css" rel="stylesheet"/>
        <link rel='stylesheet' type='text/css' href="<?php echo Config::get('constants.FRONT_CSS'); ?>/frontend/general.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <!-- jQuery -->
        <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> -->
        <script src="<?php echo Config::get('constants.FRONT_JS'); ?>jquery.1.11.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <!-- braintree -->
        <script src="https://js.braintreegateway.com/js/braintree-2.32.1.min.js"></script>
        <!-- Load the required client component. -->
        <script src="https://js.braintreegateway.com/web/3.37.0/js/client.min.js"></script>
        <!-- Load Hosted Fields component. -->
        <script src="https://js.braintreegateway.com/web/3.37.0/js/hosted-fields.min.js"></script>
        <!-- braintree -->
        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.15/zebra_datepicker.src.js" defer></script>-->
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5c4ead9cab5284048d0f2bd9/1ebh7l50k';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        <!--End of Tawk.to Script-->
        <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCK4fSC1gA6qWJTio-djkKgW8WgS9vQG48&sensor=false"></script>
        <!-- 
        <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyC45-kgXDIY_O8SZxc5d7YLdQYqSkcts7I&sensor=false"></script>-->
        <!--<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyBeg1QiN3CKYXroVj8ivV9_Rq6E-xOkzno&sensor=false"></script>-->
        <script>
            var baseurl = '<?php echo Config::get('constants.URL'); ?>';
        </script>
        <script>
            $(document).ready( function(){
                toastr.options.closeButton = true;
            });
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.10/slimselect.min.js"></script>
        <link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_JS'); ?>select/select.css"/>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.10/slimselect.min.css" rel="stylesheet"></link>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.15/zebra_datepicker.min.js" integrity="sha512-1y4nEuCxuenP6LwNp1dhlU0KnQd65JW270y7b8duFMSwAxxc9+LWlcjOpEOposA95fSMt9bCUAn2jvoqAQPrvA==" crossorigin="anonymous"></script>
        <style>
        .menu_nav {
            display: flex;
            align-items: center;
            flex-flow: wrap;
            justify-content: space-between;
        }
        .logo {
            float: left;
            padding: 0 0 0 15px;
            width: 16%;
        }
        </style>

</head>

<body>
    <?php  $uri = explode("/",Request::path()); ?>
    @if($uri[0] != "password")
        
    @endif
    
    <? $module = explode(".co/", url()->current());?>
    <header>
        <div class="col-lg-12">
            <div class="menu_nav">
                <a href="{{ Config::get('constants.SITE_URL') }}/" class="logo"> <img src="{{ asset('public/images/logo/fiynessity-logo.png') }}"> </a>
                <nav id='cssmenu'>
                    
                    <ul>
                        <li class="{{ (!isset($module[1])) ? 'active' : '' }}"><a href="{{ Config::get('constants.SITE_URL') }}/">Home</a></li>
                        <li class="{{ (strpos(url()->current(), 'about-us') !== false) ? 'active' : '' }}"><a href="{{ Config::get('constants.SITE_URL') }}/about-us" rel="" class="anchorLink">Why Fitnessity</a></li>
                        <li class="{{ (strpos(url()->current(), 'discover') !== false) ? 'active' : '' }}"><a href="{{ Config::get('constants.SITE_URL') }}/discover" rel="" class="anchorLink">Discover</a></li>
                        <li class="{{ (strpos(url()->current(), 'be-a-part') !== false) ? 'active' : '' }}"><a href="{{ Config::get('constants.SITE_URL') }}/be-a-part" rel="" class="anchorLink">Be a part</a></li>
                        <li class="{{ (strpos(url()->current(), 'hire-trainer') !== false) ? 'active' : '' }}"><a href="{{ Config::get('constants.SITE_URL') }}/hire-trainer" rel="" class="anchorLink">Hire Trainer</a></li>
                        <li class="{{ (strpos(url()->current(), 'contact-us') !== false) ? 'active' : '' }}"><a href="{{ Config::get('constants.SITE_URL') }}/contact-us">Contact Us</a></li>
                        <li class="{{ (strpos(url()->current(), 'instant-hire') !== false) ? 'active' : '' }}"><a href="/instant-hire" rel="" class="anchorLink">Book an Activity</a></li>
                    </ul>
                </nav>
                <div class="header-right">
                    <form id="searchform" method="" action="{{url('/filter')}}">
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
                                <li><a href="{{route('createNewBusinessProfile')}}">Create Business</a></li>
                                <li><a href="{{route('manageCompany')}}">Manage Business</a></li>
                                <li><a href="{{ Config::get('constants.SITE_URL') }}/userlogout">Logout</a></li>
                                @else
                                <li><a href="{{ Config::get('constants.SITE_URL') }}/userlogin">Login</a></li>
                                <li><a href="{{ Config::get('constants.SITE_URL') }}/registration">Register</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    
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
    
    

    @include('layouts.footer')

    <p id="back-top" title="Back To Top">
        <a href="#top" class="cd-top"><span class="fa fa-arrow-up"></span></a>
    </p>
    @stack('footer-scripts')
    <style>
    .pac-container{
    /*top: 582px !important;*/
    }
    </style>
    <script>	
        $(document).ready(function(){
            $("#review-btn").hide();
            $(".btn-cart").hide();
            
            //$(document).on('change','.myfilter', function () {
            $('.myfilter2').click(function(){
                $('.myfilter').trigger('change');
            }); 

            $('.myfilter').change(function(){
            var form = $("form#frmsearchCategory").serialize();
                url = '/samfilter';
                $.ajax({
                url:url,
                type:'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}',
                },
                data: {
                    "_token": '{{csrf_token()}}',
                    data : form
                },           
                success:function(response){ 

                    $('.direc-right div#buisnessuser').empty();
                    $('.direc-right div#buisnessuser').html(response);
                    }
                });
            });
        });
    </script>
</body>
</html>