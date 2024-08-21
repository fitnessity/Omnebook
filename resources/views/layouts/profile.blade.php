<!doctype html>
<html class="no-js" lang="en">
    <style>
        .Zebra_DatePicker {
            background: #666;
            border-radius: 4px;
            box-shadow: 0 0 10px #888;
            color: #222;
            font: 13px Tahoma,Arial,Helvetica,sans-serif;
            padding: 3px;
            position: absolute;
            display: table;
            *width: 255px;
            z-index: 1200
        }
        .Zebra_DatePicker *,
        .Zebra_DatePicker :after,
        .Zebra_DatePicker :before {
            box-sizing: content-box!important
        }
        .Zebra_DatePicker * {
            padding: 0
        }
        .Zebra_DatePicker table {
            border-collapse: collapse;
            border-radius: 4px;
            border-spacing: 0;
            width: 100%
        }
        .Zebra_DatePicker td,
        .Zebra_DatePicker th {
            padding: 5px;
            cursor: pointer;
            text-align: center;
            min-width: 25px;
            width: 25px
        }
        .Zebra_DatePicker .dp_body td,
        .Zebra_DatePicker .dp_body th {
            border: 1px solid #bfbfbf
        }
        .Zebra_DatePicker .dp_body td:first-child,
        .Zebra_DatePicker .dp_body th:first-child {
            border-left: none
        }
        .Zebra_DatePicker .dp_body td:last-child,
        .Zebra_DatePicker .dp_body th:last-child {
            border-right: none
        }
        .Zebra_DatePicker .dp_body tr:first-child td,
        .Zebra_DatePicker .dp_body tr:first-child th {
            border-top: none
        }
        .Zebra_DatePicker .dp_body tr:last-child td,
        .Zebra_DatePicker .dp_body tr:last-child th {
            border-bottom: none
        }
        .Zebra_DatePicker .dp_body td {
            background: #e6e5e5
        }
        .Zebra_DatePicker .dp_body .dp_weekend {
            background: #d6d6d6
        }
        .Zebra_DatePicker .dp_body .dp_not_in_month {
            background: #e0e6f2;
            color: #98acd4
        }
        .Zebra_DatePicker .dp_body .dp_time_controls_condensed td {
            width: 25%
        }
        .Zebra_DatePicker .dp_body .dp_current {
            color: #cc236b
        }
        .Zebra_DatePicker .dp_body .dp_selected {
            background: #b56a6a;
            color: #fff
        }
        .Zebra_DatePicker .dp_body .dp_disabled {
            background: #f2f2f2;
            color: #ccc;
            cursor: text
        }
        .Zebra_DatePicker .dp_body .dp_disabled.dp_current {
            color: #b56a6a
        }
        .Zebra_DatePicker .dp_body .dp_hover {
            color: #fff;
            background: #88a09e
        }
        .Zebra_DatePicker .dp_body .dp_hover.dp_time_control {
            background-color: #8c8c8c;
            color: #fff
        }
        .Zebra_DatePicker .dp_monthpicker td,
        .Zebra_DatePicker .dp_timepicker td,
        .Zebra_DatePicker .dp_yearpicker td {
            width: 33.3333%
        }
        .Zebra_DatePicker .dp_timepicker .dp_disabled {
            border: none;
            color: #222;
            font-size: 26px;
            font-weight: 700
        }
        .Zebra_DatePicker .dp_time_separator div {
            position: relative
        }
        .Zebra_DatePicker .dp_time_separator div:after {
            content: ":";
            color: 1px solid #bfbfbf;
            font-size: 20px;
            left: 100%;
            margin-left: 2px;
            margin-top: -13px;
            position: absolute;
            top: 50%;
            z-index: 1
        }
        .Zebra_DatePicker .dp_header {
            margin-bottom: 3px
        }
        @supports (-ms-ime-align:auto) {
            .Zebra_DatePicker .dp_header {
                font-family: 'Segoe UI Symbol',Tahoma,Arial,Helvetica,sans-serif
            }
        }
        .Zebra_DatePicker .dp_footer {
            margin-top: 3px
        }
        .Zebra_DatePicker .dp_footer .dp_icon {
            width: 50%
        }
        .Zebra_DatePicker .dp_actions td {
            border-radius: 4px;
            color: #fff
        }
        .Zebra_DatePicker .dp_actions .dp_caption {
            font-weight: 700;
            width: 100%
        }
        .Zebra_DatePicker .dp_actions .dp_next,
        .Zebra_DatePicker .dp_actions .dp_previous {
            *padding: 0 10px
        }
        .Zebra_DatePicker .dp_actions .dp_hover {
            background-color: #8c8c8c;
            color: #fff
        }
        .Zebra_DatePicker .dp_daypicker th {
            background: #fc3;
            cursor: text;
            font-weight: 700
        }
        .Zebra_DatePicker.dp_hidden {
            display: none
        }
        .Zebra_DatePicker .dp_icon {
            height: 16px;
            background-image: url(icons.png);
            background-repeat: no-repeat;
            text-indent: -9999px;
            *text-indent: 0
        }
        .Zebra_DatePicker .dp_icon.dp_confirm {
            background-position: center -123px
        }
        .Zebra_DatePicker .dp_icon.dp_view_toggler {
            background-position: center -91px
        }
        .Zebra_DatePicker .dp_icon.dp_view_toggler.dp_calendar {
            background-position: center -59px
        }
        button.Zebra_DatePicker_Icon {
            background: url(icons.png) center top no-repeat;
            border: none;
            cursor: pointer;
            display: block;
            height: 16px;
            line-height: 0;
            padding: 0;
            position: absolute;
            text-indent: -9000px;
            width: 16px
        }
        button.Zebra_DatePicker_Icon.Zebra_DatePicker_Icon_Disabled {
            background-position: center -32px;
            cursor: default
        }
        section.main-slider.inner-banner.profile-banner {
            display: none;
        }
    </style>
    <head>
        <title><?php echo!empty($pageTitle) ? $pageTitle . ' - ' : '';
echo Config::get('constants.system_title'); ?></title>
        <meta content="charset=utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta property="og:url"                content="@if(isset($fbshare_url)){{$fbshare_url}}@endif" />
        <meta property="og:type"               content="@if(isset($fbshare_type)){{$fbshare_type}}@endif" />
        <meta property="og:title"              content="@if(isset($fbshare_title)){{$fbshare_title}}@endif" />
        <meta property="og:description"        content="@if(isset($fbshare_desc)){{$fbshare_desc}}@endif" />
        <meta property="og:image"              content="@if(isset($fbshare_image)){{$fbshare_image}}@endif" />
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
        <!-- <link rel="stylesheet" href="<?php //echo Config::get('constants.FRONT_CSS');  ?>datepicker.css">-->
        <link href="<?php echo Config::get('constants.FRONT_CSS'); ?>general.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo Config::get('constants.FRONT_CSS'); ?>responsive.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo Config::get('constants.FRONT_CSS'); ?>jquery-ui.css" type="text/css" rel="stylesheet"/>
        <link href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css" type="text/css" rel="stylesheet"/>
        <link href="<?php echo Config::get('constants.FRONT_CSS'); ?>jquery-ui.multidatespicker.css" type="text/css" rel="stylesheet"/>
        <!-- braintree -->
        <script src="https://js.braintreegateway.com/js/braintree-2.32.1.min.js"></script>
        <!-- Load the required client component. -->
        <script src="https://js.braintreegateway.com/web/3.37.0/js/client.min.js"></script>
        <!-- Load Hosted Fields component. -->
        <script src="https://js.braintreegateway.com/web/3.37.0/js/hosted-fields.min.js"></script>
        <!-- braintree -->
        <!--<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyC45-kgXDIY_O8SZxc5d7YLdQYqSkcts7I&sensor=false"></script>-->
        <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCK4fSC1gA6qWJTio-djkKgW8WgS9vQG48&v=3"></script>
        <!-- jQuery -->
        <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script> -->
        <!-- Style start for banner image -->
        @if($user = Auth::user())
        @if($user['role'] == 'customer' && $user['customerDetail']['banner_image'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'banner_image'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$user['customerDetail']['banner_image']))
        <style>
            .profile-banner {background:url(<?php echo Config::get('constants.USER_BANNER_IMAGE_THUMB') . $user['customerDetail']['banner_image']; ?>) center center no-repeat}
        </style>
        @elseif($user['role'] == 'business' && $user['ProfessionalDetail']['banner_image'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'banner_image'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$user['ProfessionalDetail']['banner_image']))
        <style>
            .profile-banner {background:url(<?php echo Config::get('constants.USER_BANNER_IMAGE_THUMB') . $user['ProfessionalDetail']['banner_image']; ?>) center center no-repeat}
        </style>
        @else
        <style>
            .profile-banner {background:url(/public/images/profile-banner.jpg) center center no-repeat}
        </style>
        @endif
        @endif
        <!-- Style end for banner image -->
        <script src="<?php echo Config::get('constants.FRONT_JS'); ?>jquery.1.11.1.min.js"></script>
        <script src="<?php echo Config::get('constants.FRONT_JS'); ?>jquery.inputmask.js"></script>
        <script src="<?php echo Config::get('constants.FRONT_JS'); ?>jquery.inputmask.extensions.js"></script>
        <script src="<?php echo Config::get('constants.FRONT_JS'); ?>jquery-ui.min.js"></script>
        <script src="<?php echo Config::get('constants.FRONT_JS'); ?>jquery-ui.multidatespicker.js"></script>
        <script>
var baseurl = '<?php echo Config::get('constants.URL'); ?>';
        </script>
        <script type="text/javascript" src="http://www.google.com/jsapi"></script>         
        <!--<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>-->
        <script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js"></script>
        <script type="text/javascript" src="http://geoxml3.googlecode.com/svn/branches/polys/geoxml3.js"></script>
        {{--   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>  --}}
        {{--  sam  --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.10/slimselect.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.18.10/slimselect.min.css" rel="stylesheet"></link>
        <link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_JS'); ?>select/select.css"/>
        {{--  timepicker  --}}
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.0/moment.min.js" integrity="sha512-Izh34nqeeR7/nwthfeE0SI3c8uhFSnqxV0sI9TvTcXiFJkMd6fB644O64BRq2P/LA/+7eRvCw4GmLsXksyTHBg==" crossorigin="anonymous"></script>
        {{--  sam end  --}}
    </head>
    <body>
        <?php

        use App\Sports;
        use App\Miscellaneous;
        use App\Languages;

$return = Sports::select(DB::raw('sports.*'), DB::raw('sports_categories.category_name'), DB::raw('IF((select count(*) from sports as sports1 where sports1.is_deleted = "0" AND sports1.parent_sport_id = sports.id ) > 0,1,0) as has_child'))
                ->leftjoin("sports_categories", DB::raw('sports.category_id'), '=', 'sports_categories.id');
        $return->where('sports.is_deleted', '0');
        $return->where('sports.parent_sport_id', NULL);
        $return->groupBy('sports.id');
        $return->orderBy('sports.sport_name');
        $sports_list = $return->get();
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
        @include('includes.header_front')
        <section id="content">
            <section class="vbox">
                <section class="scrollable padder">
                    @if (!Auth::guest())
                    @include('includes.header_front_subheader')
                    @endif
                    <!-- display error message ends -->
                    <section class="main-slider inner-banner profile-banner">
                        <div class="container">
                            <?php
                            if (isset($pageTitle) && $pageTitle != '')
                                echo '<h1>' . $pageTitle . '</h1>';
                            ?>
                            @if (Auth::user())
                            <div class="nw-user-img text-right" style="padding-bottom:80px">
                                <a href="" class="edit-pic" data-toggle="modal" data-target="#editBannerPic" title="Click here to change Banner Image"><i class="fa fa-camera"></i></a>
                            </div>
                            <div class="modal fade" id="editBannerPic" role="dialog">
                                {!! Form::open(array('files' => true , 'enctype' => 'multipart/form-data', 'id' => 'frmeditBanner')) !!}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-body login-pad">
                                            <div class="pop-title employe-title">
                                                <h3>CHANGE BANNER IMAGE</h3>
                                            </div>
                                            <button type="button" class="close modal-close" data-dismiss="modal">
                                                <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                                            </button>
                                            <div class="signup">
                                                <div id='systemMessage'></div>
                                                <div class="emplouyee-form">
                                                    <input class="upload-pic" type="file" name="banner_image" onchange="validateImage()" id="banner_image" class="form-control">
                                                    <div class="text-left"><span style="color:red;font-size:13px"><b>* Image size : minimum 2000px width.</b></span></div>
                                                    <div>&nbsp;</div>
                                                    <button type="submit" id="submit_bannerpic">UPLOAD</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                            @endif
                        </div>
                    </section>
                    <section class="breadcrumbs">
                        <div class="container">
                            <ul>
                                <li><a href="/">HOME </a></li>
                                <li><i class="fa fa-angle-right"></i> </li>
                                <?php
                                if (isset($pageTitle) && $pageTitle != '')
                                    echo $pageTitle;
                                ?>
                            </ul>
                        </div>
                    </section>
                    <!-- Display Validation Errors -->
                    @yield('content')
                    <?php /* @include('includes.footer_front_subfooter') */ ?>
                </section>
            </section>
        </section>
        @include('includes.footer_front')
        <script src="<?php echo Config::get('constants.FRONT_JS'); ?>profile-feeds/profile-feeds.js"></script>
        <p id="back-top" title="Back To Top">
            <a href="#top" class="cd-top"><span class="fa fa-arrow-up"></span></a>
        </p>

        <script>
        function validateImage() {
            var reader = new FileReader();
            reader.readAsDataURL(document.getElementById("banner_image").files[0]);
            reader.onload = function (e)
            {
                var image = new Image();
                image.src = e.target.result;
                image.onload = function ()
                {
                    var width = this.width;
                    if (width < 2000) {
                        alert("Please upload image of minimum 2000px width.");
                        document.getElementById("banner_image").value = '';
                        return false;
                    }
                };
            }
        }

        $('#frmeditBanner').submit(function (e) {
            e.preventDefault();
            $('#frmeditBanner').validate({
                rules: {
                    banner_image: {
                        required: true,
                        accept: "image/*"
                    },
                },
                messages: {
                    banner_image: {
                        required: "Upload a Banner Image",
                        accept: "Please upload an image"
                    },
                }
            });
            if (!$('#frmeditBanner').valid()) {
                return false;
            }
            var inputData = new FormData($(this)[0]);
            $.ajax({
                url: '/profile/editBannerPicture',
                type: 'POST',
                dataType: 'json',
                data: inputData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#submit_bannerpic').prop('disabled', true);
                },
                complete: function () {
                    $('#submit_bannerpic').prop('disabled', false);
                },
                success: function (response) {
                    if (response.type == 'success') {
                        $('#editBannerPic').modal('hide');
                        showSystemMessages('#systemMessage', response.type, response.msg);
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    } else {
                        showSystemMessages('#systemMessage', response.type, response.msg);
                    }
                }
            });
        });
        </script>
    </body>
</html>