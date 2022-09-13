<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta content="charset=utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title><?php echo !empty($pageTitle)?$pageTitle.' - ':''; echo Config::get('constants.system_title');?></title>
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
@stack('header_script')
</head>

<body>
<?php
use App\Sports;
use App\Miscellaneous;
use App\Languages;

    $return = Sports::select(DB::raw('sports.*'),DB::raw('sports_categories.category_name'),DB::raw('IF((select count(*) from sports as sports1 where sports1.is_deleted = "0" AND sports1.parent_sport_id = sports.id ) > 0,1,0) as has_child'))

     ->leftjoin("sports_categories", DB::raw('sports.category_id'), '=', 'sports_categories.id');
        $return->where('sports.is_deleted','0');
        $return->where('sports.parent_sport_id',NULL);
        $return->groupBy('sports.id');
        $return->orderBy('sports.sport_name');
        $sports_list  = $return->get();
        $expLevel = Miscellaneous::expLevel();
        $dayactivity = Miscellaneous::dayactivity();
        $participateActivity = Miscellaneous::participateActivity();
        $expProfessional = Miscellaneous::expProfessional();
        $teaching = Miscellaneous::teaching();
        $gender = Miscellaneous::gender();
        $activeLevel = Miscellaneous::activeLevel();
        $expActivity = Miscellaneous::expActivity();
        $ageRange = Miscellaneous::ageRange();
        $getTimeSlot = Miscellaneous::getTimeSlot();
        $trainingLocation = Miscellaneous::trainingLocation();
        $serviceLocation = Miscellaneous::serviceLocation();
        $StartActivity = Miscellaneous::StartActivity();
        $travelUpto = Miscellaneous::travelUpto();
        $language = Languages::get();
        $activity = Miscellaneous::activity();
    ?>

    <?php  $uri = explode("/",Request::path()); ?>
    @if($uri[0] != "password")
        @include('includes.header_front')
    @endif

    <section id="content">
        <section class="vbox">
            <section class="scrollable padder">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                <!-- end flash-message -->
                @yield('content')
            </section>
        </section>
    </section>

    @include('includes.footer_front')

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