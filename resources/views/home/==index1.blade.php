@inject('request', 'Illuminate\Http\Request')

@extends('layouts.header')

@section('content')
<style>
    .online_classes_box .classes_bottom_duration .duration_wrap{
        font-size:13px;
    }
    .title-bg{
        background: #ed1b24;
        font-size: 33px;
        color: #fff;
    }
    .img-title-home{
        font-size: 33px;
        color: #fff;
    }
    .sub-part {
        display: inline-block;
        width: 9%;
        vertical-align: top;
        padding: 5px 16px;
    }
    .sub-part p{
        color: #f53b49;
        font-size: 15px;
        border-radius: 100%;
        padding: 9px 14px;
        border: 2px solid #f53b49;
        font-weight: 600;
        height: 40px;
        width: 40px;
    }
    .sub-text {
        display: inline-block;
        padding-left: 10px;
        vertical-align: middle;
        width: 90%;
        margin-bottom: 25px;
    }
    .sub-text h3 {
        font-size: 17px;
        display: inline-block;
        font-weight: 400;
        line-height: 40px;
        color: #fff;
    }
    .sub-text p {
        display: inline-block;
        font-size: 13px;
        line-height: 20px;
        color: #888c8d;
    }
    .btn-home a{
        padding: 12px 50px;
        font-size: 15px;
        border-radius: 50px;
        transition: 0.5s;
        cursor: pointer;
        border: 2px solid #f53b49;
        background: none;
        color: #fff;
    }
    .btn-home a:hover {
        transition: 0.5s;
        background: #f53b49;
        color: #ffffff;
    }
    .btn-home{ margin-left: 63px; margin-top: 15px; }
    .heading-bt-sp{ margin-bottom: 45px; }
    
    

.kickboxing-slider .owl-nav .owl-prev {
    width: 30px;
    height: 30px;
    text-align: center;
    background: #c72321;
    opacity: 1;
    border-radius: 50px;
    top: 45%;
    position: absolute;
    left: -34px;
    font-size: 21px;
    color: #fff;
}
.kickboxing-slider .owl-nav .owl-next {
    width: 30px;
    height: 30px;
    text-align: center;
    background: #c72321;
    opacity: 1;
    border-radius: 50px;
    top: 45%;
    position: absolute;
    right: -34px;
    font-size: 21px;
    color: #fff;
}
.item .activities_img {
  width: 100%;
  height: 100%;
  overflow: hidden;
}
.activites_content {
  width: 100%;
}
.activites_content h3 {
  background: #151925;
  padding: 9px 15px;
  font-style: italic;
  font-size: 18px;
  letter-spacing: 2px;
  height: 60px;
}
.activites_content h3 a {
  color: #fff;
}
.activites_content p {
  color: #04344d;
  padding: 10px 15px;
  font-style: italic;
}

</style>
<section class="slider_wrapper">
    <div class="main-slider owl-carousel owl-theme">
        @foreach($sliders as $slider)
        <div class="slide" style="background-image: url('/public/uploads/slider/thumb/{{$slider->image}}') ">
            <div class="content-column">
                <div class="inner-column">
                    <div class="title">{{$slider->title}}</div>
                    <h1>{{$slider->heading}}</h1>
                        <div class="stext">{{$slider->stext}}
                            <span>
                                @if(!empty($slider->price))
                                    ${{$slider->price}}/MONTH
                                @else
                                {{$slider->price}}
                                @endif
                            </span>
                        </div>
                    <div class="btns-box hide">
                        <a href="{{ Config::get('constants.SITE_URL') }}/registration" class="btn btn-web-btn">Register Now</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <?php 
        use App\Cms;
        $content = '';
        $search_title = Cms::where('id',9)->first();
        if(!empty($search_title)){
            $content = $search_title->content;
        }
    ?>
    <div class="slider-block">
        <div class="container">
            <h1>{{$content}}<br></h1>
            <!--<h1>FIND SPORTS, WELLNESS &amp; ADVENTUROUS ACTIVITIES<br></h1>-->
            <form id="searchform" method="get" action="/activities/">
                <div class="row cstm-bnner">
                    <div class="col-sm-12">
                        <ul>
                            <li>
                                <img src="{{ asset('public/images/search-by-activity.png') }}" alt="">
                                <input autocomplete="off" type="text" name="label" id="activity_label" placeholder="Search by Activity, Business, Person, Username" value="@if(isset($selected_label) && $selected_label != NULL){{$selected_label }}@endif" class="search_input_banner">
                                <div id="suggesstion-box-search-activity"></div>
                            </li>
                            <li>
                                <div id="suggestions" class="location-find">
                                    <img src="{{ asset('public/images/location-search.png') }}" alt="">
                                    <!-- <input autocomplete="off" id="pac-input1" name="location" type="text" placeholder="Search by City, State, Country" value="@if(isset($selected_location) && $selected_location != NULL){{$selected_location }}@endif"> -->
                                    <input type="text" name="address" id="b_address1" placeholder="search by country, city, state, zip" autocomplete="off"  value="{{@$address}}" />
                                </div>
                                <div id="map" style="display: none; position: relative; overflow: hidden;"></div>
                                <div id="suggesstion-box-search-location"></div>
                                <input type="hidden"  name="City" id="b_city1" value="{{@$City}}">
                                <input type="hidden"  name="State" id="b_state1" value="{{@$State}}">
                                <input type="hidden"  name="Country" id="country1" value="{{@$Country}}">
                                <input type="hidden"  name="ZipCode" id="b_zipcode1" value="{{@$zip_code}}">
                            </li>
                           <!-- <li>
                                <img src="{{ asset('public/images/envlope-icon.png') }}" alt="">
                                <input type="text" autocomplete="off" placeholder="Zip Code" name="zipcode" id="zipcode" value="@if(isset($selected_zipcode) && $selected_zipcode != NULL){{$selected_zipcode }}@endif">
                                <div id="suggesstion-box-search-zipcode"></div>
                            </li>-->
                            <li><button type="submit">SEARCH</button></li>
                        </ul>
                       <!-- <ul>
                            <li>
                                <img src="{{ asset('public/images/run-icon.png') }}" alt="">
                                <input autocomplete="off" type="text" name="label" id="activity_label" placeholder="Activity or Bussiness" value="@if(isset($selected_label) && $selected_label != NULL){{$selected_label }}@endif" class="search_input_banner">
                                <div id="suggesstion-box-search-activity"></div>
                            </li>
                            <li>
                                <div id="suggestions">
                                    <img src="{{ asset('public/images/map-marker-icon.png') }}" alt="">
                                    <input autocomplete="off" id="pac-input1" name="location" type="text" placeholder="Location" value="@if(isset($selected_location) && $selected_location != NULL){{$selected_location }}@endif">
                                </div>
                                <div id="suggesstion-box-search-location"></div>
                            </li>
                            <li>
                                <img src="{{ asset('public/images/envlope-icon.png') }}" alt="">
                                <input type="text" autocomplete="off" placeholder="Zip Code" name="zipcode" id="zipcode" value="@if(isset($selected_zipcode) && $selected_zipcode != NULL){{$selected_zipcode }}@endif">
                                <div id="suggesstion-box-search-zipcode"></div>
                            </li>
                            <li><button type="submit">SEARCH</button></li>
                        </ul>-->
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="bepart_wraper mdisplay-none" style="background-image: url({{ asset('public/images/beapart_bg.jpg') }}) ">
    <div class="container">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
            <div class="col-xs-4 col-lg-4">
                <div class="count_up">
                    <p class="counter_count">{{$count_trainer}}</p>
                    <h3>TRAINERS</h3>
                </div>
            </div>
            <div class="col-xs-4 col-lg-4">
                <div class="count_up">
                    <p class="counter_count">{{$count_location}}</p>
                    <h3>LOCATIONS</h3>
                </div>
            </div>
            <div class="col-xs-4 col-lg-4">
                <div class="count_up">
                    <p class="counter_count">{{$count_activity}}</p>
                    <h3>ACTIVITIES</h3>
                </div>
            </div>
            <div class="col-xs-4 col-lg-4">
                <div class="count_up">
                    <p class="counter_count">{{$count_business}}</p>
                    <h3>BUSSINESSES</h3>
                </div>
            </div>
            <div class="col-xs-4 col-lg-4">
                <div class="count_up">
                    <p class="counter_count">{{$count_userbooking}}</p>
                    <h3>BOOKINGS</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="category" style="background-image: url({{ asset('public/images/category-bg.jpg') }})">
    <div class="cat-container">
        <div class="about-services-title" style="margin-bottom:3%">
            <h1>View All Activities</h1>
            <h3>Get Connect to a wide range of multi-sports, wellness, and active activities</h3>
        </div>
        <div class="cate-sidebar hp">
            <h1>SELECT ACTIVITY</h1>
            <ul class="select_activity_hp nav nav-tabs">
                @php 
                $k = 0;
                @endphp
                @foreach($sports_categories as $sports)
                @php 
                $data = str_replace('&', '', $sports->category_name);
                $str = str_replace(' ', '', $data);
                $str1 = str_replace(',', '', $str);
                @endphp
                <li class="@if($k== 0) active @endif">
                    <a href="#{{$str1}}" data-toggle="tab" class="search_by_category">{{$sports->category_name}}</a>
                </li>
                @php 
                $k++;
                @endphp
                @endforeach
                <li>&nbsp;</li>
                <li>&nbsp;</li>
                <li><a href="/activities">View All Activities</a></li>
            </ul>
        </div>

        <div class="tab-content">
            @php 
            $i = 0;
            @endphp
            @foreach($sports_categories as $sports)
            @php 
            $data = str_replace('&', '', $sports->category_name);
            $str = str_replace(' ', '', $data);
            $str1 = str_replace(',', '', $str);
            @endphp
            <div id="{{$str1}}" class="cate-list owl-carousel owl-demo-category tab-pane fade <?= ($i== 0) ? 'in active' : ''; ?>">
                @php
                $j=1;
                @endphp
                @foreach($most_searched_sports as $data)
                    @php 
                        $catdata = explode(",",$data->category_id);
                    @endphp
                    @if($j<=6)
                        @if (in_array($sports->id, $catdata))
                            <div class="cat-item style_prevu_sp item" data-dot="{{$j}}">
                                <span>
                                    <div class="cat-img-name">
                                       @if(File::exists(public_path("/uploads/sports/".$data->image)) && $data->image!='' )
                                            <img src="{{asset('public/uploads/sports/'."$data->image")}}" alt="{{$data->sport_name}}" />
                                        @else
                                            <img src="{{asset('public/images/service-nofound.jpg')}}"/>
                                        @endif
                                    </div>
                                    <div class="cat-detail">
                                        <h1>{{$data->sport_name}}</h1>
                                         <!-- <form action="{{route('activities_index')}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="label" value="{{$data->sport_name}}">
                                            <button type="submit" class="getstarted">
                                                 Get Started
                                            </button>
                                        </form> -->
                                        <a href="/activities/activity_type={{$data->sport_name}}" class="getstarted">Get Started</a>
                                    </div>
                                </span>
                            </div>
                            @php
                            $j++;
                            @endphp
                        @endif
                    @endif
                @endforeach
            </div>
            @php
            $i++;
            @endphp
            @endforeach

        </div>

    </div>
</section>
       
<section class="online_wraper hide" id="activity">
    <div class="cat-container">
        <div class="about-services-title" style="margin-bottom:3%">
            <h1>ONLINE CLASSES & ACTIVITIES</h1>
            <h3>Book your class now and start with the Training Instantly. <a href="{{ Config::get('constants.SITE_URL') }}/activities" class="all_links">View All Trainings</a></h3>
        </div>
        <div class="online_classes_wrap frame" id="cyclepages">
            <ul>
                @foreach($onlines as $online)
                <li>
                    <div class="online_classes_box">
                        <div class="imageclasses">
                            <a href="/activities"><img src="{{ asset('public/uploads/online/thumb/'."$online->image") }}" alt=""></a>
                            <span class="live_img"><img src="{{ asset('public/images/liveimg.png') }}" alt=""></span>
                        </div>
                        <div class="classes_title">
                            <h3>{{$online->heading}}<span>{{$online->title}}</span></h3>

                        </div>
                        <div class="classes_bottom_duration">
                            <div class="duration_wrap">
                                <span class="dtxt">DURATION</span>
                                <span class="dtxt1">{{$online->duration}}</span>
                            </div>
                            <div class="duration_wrap">
                                <span class="dtxt">LEVEL</span>
                                <span class="dtxt1">{{$online->level}}</span>
                            </div>
                            <div class="duration_wrap">
                                <span class="dtxt">TIMINGS</span>
                                <span class="dtxt1">{{$online->timings}}</span>
                            </div>
                            <div class="book_wrap">
                                <a href="/activities"><span>${{$online->price}}</span><span>BOOK NOW</span></a>
                            </div>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="scrollbar">
            <div class="handle">
                <div class="mousearea"></div>
            </div>
        </div>
    </div>
</section>

<?php /*?><section class="online_wraper">
    <div class="cat-container">
        <div class="about-services-title" style="margin-bottom:3%">
            <h1>RECOMMENDED CLASSESS & ACTIVITIES</h1>
            <h3>Book your class now and start with the Training Instantly. <a href="{{ Config::get('constants.SITE_URL') }}/instant-hire" class="all_links">View All Trainings</a></h3>
        </div>
        <div class="online_classes_wrap frame" id="cyclepages1">
            <ul>
                @foreach($persons as $person)
                <li>
                    <div class="online_classes_box">
                        <div class="imageclasses">
                            <a href="/instant-hire"><img src="{{ asset('public/uploads/person/thumb/'."$person->image") }}" alt=""></a>
                        </div>
                        <div class="classes_title">
                            <h3>{{$person->heading}} <span>- {{$person->title}}</span></h3>
                        </div>
                        <div class="classes_bottom_duration">
                            <div class="duration_wrap">
                                <span class="dtxt">DURATION</span>
                                <span class="dtxt1">{{$person->duration}}</span>
                            </div>
                            <div class="duration_wrap">
                                <span class="dtxt">LEVEL</span>
                                <span class="dtxt1">{{$person->level}}</span>
                            </div>
                            <div class="duration_wrap">
                                <span class="dtxt">TIMINGS</span>
                                <span class="dtxt1">{{$person->timings}}</span>
                            </div>
                            <form method="post" action="/instant-hire?action=add&pid=1">
                            <div class="book_wrap" style="cursor:pointer">
                                <span><input type="submit" value="${{$person->price}}" style="color:#fff; background:#ed1b24" /></span><br/>
                                <span>
                                    @csrf
                                    <input type="hidden" class="product-quantity" name="quantity" value="1" size="2" />
                                    <input type="hidden" class="product-price" name="price" value="<?=$person->price?>" size="2" />
                                    <input type="submit" value="BOOK NOW" style="color:#fff; background:#ed1b24" />
                                </span>
                            </div>
                            </form>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="scrollbar">
            <div class="handle">
                <div class="mousearea"></div>
            </div>
        </div>
    </div>
</section><?php */?>

<section class="online_wraper hide">
    <div class="cat-container">
        <div class="about-services-title" style="margin-bottom:3%">
            <h1>RECOMMENDED CLASSESS & ACTIVITIES</h1>
            <h3>Book your class now and start with the Training Instantly. <a href="{{ Config::get('constants.SITE_URL') }}/activities" class="all_links">View All Trainings</a></h3>
        </div>
        <div class="online_classes_wrap frame" id="cyclepages1">
            <ul>
                <?php
                $companyid = $companylogo = $companyname = $companyaddress = $latitude = $longitude = "";
                $pay_session = $pay_price = $pay_setduration = $pay_discount = $languages = "";
                if (isset($serviceData)) {
                    $servicetype = [];
                    foreach ($serviceData as $loop => $service) {
                        $company = $price = $businessSp = [];
                        $sport_activity = $service['sport_activity'];
                        $servicetype[$service['service_type']] = $service['service_type'];
                        $area = !empty($service['area']) ? $service['area'] : 'Location';
                        if (isset($companyData)) {
                            if (isset($companyData[$service['cid']]) && !empty($companyData[$service['cid']])) {
                                $company = $companyData[$service['cid']];
                                $company = isset($company[0]) ? $company[0] : [];
                                if(!empty($company)) {
                                    $companyid = $company['id'];
                                    $companylogo = $company['logo'];
                                    $companyname = $company['dba_business_name'];
                                    $companyaddress = $company['address'];
                                    $latitude = $company['latitude'];
                                    $longitude = $company['longitude'];
                                }
                                $price = $servicePrice[$service['cid']];
                                $price = isset($price[0]) ? $price[0] : [];
                                if(!empty($price)) {
                                    $pay_session = $price['pay_session'];
                                    $pay_price = !empty($price['pay_price']) ? $price['pay_price'] : '10';
                                    $pay_setduration = $price['pay_setduration'];
                                    $pay_discount = $price['pay_discount'];
                                }
                                $businessSp = $businessSpec[$service['cid']];
                                $businessSp = isset($businessSp[0]) ? $businessSp[0] : [];
                                if(!empty($businessSp)) {
                                    $languages = $businessSp['languages'];
                                }
                            }
                        }
                        if ($service['profile_pic']!="" && File::exists(public_path("/uploads/profile_pic/thumb/" . $service['profile_pic']))) {
                            $profilePic = url('/public/uploads/profile_pic/thumb/' . $service['profile_pic']);
                        } else {
                            $profilePic = '/public/images/claim-bg.jpeg';
                        }
                        ?>
                        <li>
                            <div class="online_classes_box">
                                <div class="imageclasses">
                                    <a href="/activities"><img src="{{ $profilePic }}" alt=""></a>
                                </div>
                                <div class="classes_title">
                                    <h3>{{ $service['program_name'] }}<span>-{{ $service['sport_activity'] }}</span></h3>
                                </div>
                                <div class="classes_bottom_duration">
                                    <div class="duration_wrap">
                                        <span class="dtxt">DURATION</span>
                                        <span class="dtxt1">{{ $service['mon_duration'] }}</span>
                                    </div>
                                    <div class="duration_wrap">
                                        <span class="dtxt">LEVEL</span>
                                        <span class="dtxt1">{{ $service['difficult_level'] }}</span>
                                    </div>
                                    <div class="duration_wrap">
                                        <span class="dtxt">TIMINGS</span>
                                        <span class="dtxt1"><?= $service['mon_shift_start'] ?> - <?= $service['mon_shift_end'] ?></span>
                                    </div>
                                    <form method="post" action="/activities?action=add&pid=1">
                                    <div class="book_wrap" style="cursor: pointer">
                                        <span>
                                            $<?=$pay_price?><br/>
                                            @csrf
                                            <input type="hidden" class="product-quantity" name="quantity" value="1" size="2" />
                                            <input type="hidden" class="product-price" name="price" value="<?=$pay_price?>" size="2" />
                                            <input type="submit" value="BOOK NOW" style="color:#fff; background:#ff0000" /> 
                                        </span>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </li>
                        <?php
                    }
                }
                ?>
            </ul>
        </div>
        <div class="scrollbar">
            <div class="handle">
                <div class="mousearea"></div>
            </div>
        </div>
    </div>
</section>

<section class="instant-hire-home">
	<div class="col-md-12 col-xs-12 custom-fitnessity">
		@include('includes.next_8_hours_home') 
	</div>
</section>

@foreach($why_fitnessity as $whydata)
<section class="ptb-65 plr-60 why_fitnessity mdisplay-none" id="why-fitnessity" style=" background-image: url('/public/uploads/cms/{{ $whydata->banner_image }}')">
    <div class="cat-container">
        <div class="col-md-6 col-sm-6 col-xs-12">
            {!!$whydata->content!!}
            
            <div class="btn-home">
                <a href="{{url('/createNewBusinessProfile')}}">JOIN TODAY</a>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <?php if( !empty( $whydata['video'] ) ){ ?>
                <div class="why_fit_vd">
                    <video id="ban_video" class="tv_video">
                        <source src="<?php echo url('/public/' . $whydata['video']); ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="play-bt video_icon"><i class="fa fa-play"></i></div>
                    <div class="pause-bt video_icon" style="display:none;"><i class="fa fa-pause"></i></div>
                </div>
               <?php /*?> <div>
                <p style="color:#fff;"> GET CONNECTED TO ACTIVITIES YOU LOVE OR EXPLORE A NEW ONE </p>
                </div><?php */?>
            <?php } ?>
        </div>
    </div>
</section>
@endforeach

<section class="ptb-65 plr-60 float-left w-100 discover_activities mdisplay-none" id="discover" style="margin-top:100px">
    <div class="cat-container">
        <div class="about-services-title" style="margin-bottom:3%">
            <h1>DISCOVER ACTIVITIES</h1>
            <h3>GET CONNECTED TO ACTIVITIES YOU LOVE OR EXPLORE A NEW ONE</h3>
        </div>
        <div class="owl-slider kickboxing-slider">
            <div id="carousel-discover" class="owl-carousel">
                <?php 
                    if(isset($discovers)) {
                    $divId=1;
                    foreach($discovers as $discover) {
                    ?>
                    <div class="item">
                        <div class="activities_img">
                            <a href="/activities"><img style="height:300px" src="{{ asset('public/uploads/discover/thumb/'.$discover->image) }}" alt=""></a>
                        </div>
                        <div class="activites_content">
                            <h3><a href="/activities">{{$discover->title}}</a></h3>
                            <p>{{$discover->description}}</p>
                        </div>
                    </div>
                   <?php } } ?>
            </div>
        </div>
    </div>
</section>


<!-- <section class="ptb-65 plr-60 float-left w-100 discover_activities" id="discover" style="margin-top:100px">
    <div class="cat-container">
        <div class="about-services-title" style="margin-bottom:3%">
            <h1>DISCOVER ACTIVITIES</h1>
            <h3>GET CONNECTED TO ACTIVITIES YOU LOVE OR EXPLORE A NEW ONE</h3>
        </div>
        <div class="row row1">
            <div id="carousel-reviews" class="carousel kickboxing-slider slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php /*
                    if(isset($discovers)) {
                    $divId=1;
                    foreach($discovers as $discover) {
                    if($divId==1) {
                        echo ($divId%3 == 1)?'<div class="item active">':'';
                    } else {
                        echo ($divId%3 == 1)?'<div class="item">':'';
                    }*/
                    ?>
                    <div class="col-md-4 col-sm-4 col-xs-12 activities_box">
                        <div class="activities_img"><a href="/instant-hire"><img style="height:300px" src="{{ asset('public/uploads/discover/thumb/'."    ") }}" alt=""></a></div>
                        <div class="activites_content">
                            <h3><a href="/instant-hire"></a></h3>
                            <p></p>
                        </div>
                    </div>
                    <? /*=($divId%3 == 0)?'</div>':'' */?>
                    <?php /* $divId++;} */ ?>
                    <? /* =($divId%3 != 1)?'</div>':'' */?>
                    <?php /* } */ ?>
                </div>
                <a class="left carousel-control" href="#carousel-reviews" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-reviews" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>
    </div>
 
    <div class="cat-container hide">
        <div class="about-services-title" style="margin-bottom:3%">
            <h1>DISCOVER ACTIVITIES</h1>
            <h3>GET CONNECTED TO ACTIVITIES YOU LOVE OR EXPLORE A NEW ONE</h3>
        </div>
        <div class="row row1">
            @foreach($discovers as $discover)
            <div class="col-md-4 col-sm-4 col-xs-12 activities_box">
                <div class="activities_img"><a href="/instant-hire"><img src="{{ asset('public/uploads/discover/thumb/'."$discover->image") }}" alt=""></a></div>
                <div class="activites_content">
                    <h3><a href="/instant-hire">{{$discover->title}}</a></h3>
                    <p>{{$discover->description}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>-->
@foreach($bepart_data as $data)
<section class="ptb-65 plr-60 float-left w-100 bepart_easywrap" id="be-a-part" style="background-image: url('/public/uploads/cms/{{$data->banner_image}}')">
    <div class="cat-container">
        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12"></div>
        <div class="col-lg-6 col-md-8 col-sm-8 col-xs-12">
            <div class="bepart_easy_content">
                <h3 class="easy_title">{{ $data->content_title }} <span class="easy_highlighted">IT’s EASY</span></h3>
                {!!$data->content!!}
                <a href="{{ Config::get('constants.SITE_URL') }}/registration" class="button_default">START TODAY</a>
            </div>
        </div>
    </div>
</section>
@endforeach

<?php /*?><section class="ptb-65 plr-60 float-left w-100 popular_trainer_wrap" id="trainer">
    <div class="cat-container">
        <div class="about-services-title button_title" style="margin-bottom:3%">
            <h1>MEET THE MOST POPULAR ON FITNESSITY</h1>
            <h3 id="h3lbl"><span>MEET THE MOST POPULAR TRAINERS AND COACHES NEAR YOU</span></h3>
            <h5 id="h5lbl"><span>Fitnessity has 20 featured top-reviewed and most booked trainers & coaches near you to challenge you in becoming the best version of yourself.</span></h5>
            <h3 style="float:right">
                <select id="categorySelection" data-style="btn-primary" style="margin-top:-105px">
                    <option id="category_id_most" value="category_id_most">Trainers & Coaches</option>
                    <option id="category_id_1" value="category_id_1">Online Activities</option>
                    <option id="category_id_2" value="category_id_2">Kids Activities</option>
                    <option id="category_id_3" value="category_id_3">Group Classes</option>
                    <option id="category_id_4" value="category_id_4">Experiences</option>
                    <option id="category_id_5" value="category_id_5">Businesses</option>            
                </select>
            </h3>
        </div>     
        <div class="easyboxes_wrap">
            @foreach($trainers as $trainer)
            <div class="easyboxes_items">
                <div class="easy_img"><a href="#"><img src="{{ asset('public/uploads/trainer/thumb/'."$trainer->image") }}" alt=""></a></div>
                <div class="easy_content">
                    <h3>Company Name</h3>
                    <h5>{{$trainer->name}}</h5>
                    <div style="background:#585858; color:#ffffff; border-radius: 20px; padding:10px;"><a href="#" style="color:#ffffff">View profile</a></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section><?php */?>

<section class="plr-60 float-left w-100 social_wrap hide">
    <div class="cat-container">
        <ul>
            <li><a href="#"><i class="fa fa-facebook fa-w-14 fa-3x"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter fa-w-14 fa-3x"></i></a></li>
            <li><a href="#"><i class="fa fa-linkedin fa-w-14 fa-3x"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram fa-w-14 fa-3x"></i></a></li>
            <li><a href="#"><i class="fa fa-youtube fa-w-14 fa-3x"></i></a></li>
            <li><a href="#"><i class="fa fa-skype fa-w-14 fa-3x"></i></a></li>
        </ul>
    </div>
</section>

@include('layouts.footer')

<script>
    $(document).ready(function() {
        
        $("#categorySelection").on("change", function(){
            var id = $(this).val();
            if(id=='category_id_most') {
                $("#h3lbl").text("MEET THE MOST POPULAR TRAINERS AND COACHES NEAR YOU");
                $("#h5lbl").text("Fitnessity has 20 featured top-reviewed and most booked trainers & coaches near you to challenge you in becoming the best version of yourself.");
            }
            if(id=='category_id_1') {
                $("#h3lbl").text("EXPERIENCE THE MOST POPULAR ONLINE ACTIVITIES");
                $("#h5lbl").text("Fitnessity has 20 featured top-reviewed and most booked online activities near you to support you in becoming active, healthier, and happier.");
            }
            if(id=='category_id_2') {
                $("#h3lbl").text("EXPERIENCE THE BEST KIDS ACTIVITIES");
                $("#h5lbl").text("Fitnessity has 10 featured top-reviewed and most booked kids activities near you to keep your child entertained, engaged, and active.");
            }
            if(id=='category_id_3') {
                $("#h3lbl").text("EXPERIENCE THE BEST GROUP CLASSES");
                $("#h5lbl").text("Fitnessity has 20 featured top-reviewed and most booked group classes near you that are challenging, fun, and engaging.");
            }
            if(id=='category_id_4') {
                $("#h3lbl").text("DISCOVER THE BEST EXPERIENCES");
                $("#h5lbl").text("Fitnessity has 30 featured top-reviewed and most booked experiences near you to support you in becoming active, have fun, and be adventurous.");
            }
            if(id=='category_id_5') {
                $("#h3lbl").text("DISCOVER THE BEST BUSINESSES");
                $("#h5lbl").text("Learn more about the top businesses on Fitnessity that has consistently offered top-of-the-line services to all their customers.");
            }
        });
        
        var video1 = document.getElementById("ban_video");
        if (typeof(video1) != 'undefined' && video1 != null)
        {
          video1.currentTime = 0;
        }
        $(".mute-bt").click(function() {
            if ($(this).hasClass("stop")) {
                var ban_video = document.getElementById("ban_video");
                $("#ban_video").prop('muted', false);
                $(this).removeClass("stop");
            } else {
                var ban_video = document.getElementById("ban_video");
                $("#ban_video").prop('muted', true);
                $(this).addClass("stop");
            }
        });
        $(".play-bt").click(function() {
            $(".play-bt").hide();
            $(".pause-bt").show();
            var ban_video = document.getElementById("ban_video");
            if ($(".stop-bt").hasClass("active")) {
                ban_video.currentTime = 0;
            }
            ban_video.play();
        });
        $(".pause-bt").click(function() {
            $(".play-bt").show();
            $(".pause-bt").hide();
            $(".pause-bt").addClass("active");
            $(".stop-bt").removeClass("active");
            var ban_video = document.getElementById("ban_video");
            ban_video.pause();
        });
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCr7-ilmvSu8SzRjUfKJVbvaQZYiuntduw&callback=initMap" async defer></script>
<script type="text/javascript">
    $('#instant-hire').scroll(function(){ 
        //Set new top to autocomplete dropdown
        newTop = $('#b_address1').offset().top + $('#b_address1').outerHeight();
        alert(newTop);
        $('.pac-container').css('top', newTop + 'px');
    });
    
    $(document).ready(function () {
        $("#autocomplete").parent()
        .css({position: "relative"})
        .append(".pac-container");
    });
    
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: -33.8688, lng: 151.2195},
            zoom: 13
        });

        var input = document.getElementById('b_address1');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);
        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function() {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            if (!place.geometry) {
                window.alert("Autocomplete's returned place contains no geometry");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }

            marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));

            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
            var address = '';
            var badd = '';
            var sublocality_level_1 = '';
            if (place.address_components) {
                address = [
                  (place.address_components[0] && place.address_components[0].short_name || ''),
                  (place.address_components[1] && place.address_components[1].short_name || ''),
                  (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);

            // Location details
            for (var i = 0; i < place.address_components.length; i++) {
              //alert(place.address_components[i].types[0]);
                if(place.address_components[i].types[0] == 'locality'){
                    $('#b_city1').val(place.address_components[i].long_name);
                }
                if(place.address_components[i].types[0] == 'country'){
                    $('#country1').val(place.address_components[i].long_name);
                }
                if(place.address_components[i].types[0] == 'administrative_area_level_1'){
                  $('#b_state1').val(place.address_components[i].long_name);
                }
                if(place.address_components[i].types[0] == 'postal_code'){
                  $('#b_zipcode1').val(place.address_components[i].long_name);
                }
            }
        });
    }
</script>

<script>
    //google.maps.event.addDomListener(window, 'load', initialize);
    function initialize() {
        var options = {
            types: ['(cities)'],
            componentRestrictions: {country: "US"}
        };
        var input = document.getElementById('pac-input');
        var autocomplete = new google.maps.places.Autocomplete(input, options);
        autocomplete.addListener('place_changed', function () {
            var place = autocomplete.getPlace();
            $("#location").val(place.formatted_address);
            // place variable will have all the information you are looking for.
            // console.log(place.geometry['location'].lat());
            // console.log(place.geometry['location'].lng());
        });
    }
</script>

<script>
    $(document).ready(function(){  
        $("#activity_label").keyup(function(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "POST",
                url: "/searchactionactivity",
                data:{query:$(this).val(), _token:_token},
                beforeSend: function(){
                    //$("#label").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
                },
                success: function(data){ 
                    $("#suggesstion-box-search-activity").show();
                    $("#suggesstion-box-search-activity").html(data);
                }
            });
        });
        $(document).on('click', '.searchclickactivity', function()
        {
            $("#activity_label").val($(this).attr('data-num'));
            $("#suggesstion-box-search-activity").hide();
        });
        $("#pac-input1").keyup(function(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "POST",
                url: "/searchactionlocation",
                data:{query:$(this).val(), _token:_token},
                beforeSend: function(){
                    //$("#label").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
                },
                success: function(data){
                    $("#suggesstion-box-search-location").show();
                    $("#suggesstion-box-search-location").html(data);
                }
            });
        });
    });
    $(document).on('click', '.searchclicklocation', function(){
        var address = $(this).attr('data-num');
        /*address = address.toString().replace(/ /g, "%20");*/
       /* alert(address);*/
        $("#pac-input1").val(address);
        $("#suggesstion-box-search-location").hide();
    });

        $(document).on('click', '.serv_fav1', function(){
            var ser_id = $(this).attr('ser_id');
            var id = $(this).attr('data-id');
            var _token = $('meta[name="csrf-token"]'). attr('content');
            $.ajax({
                type: 'POST',
                url: '{{route("service_fav")}}',
                data: {
                    _token: _token,
                    ser_id: ser_id
                },
                success: function (data) {
                    if(data.status=='like')
                    {
                        if($('#serfavstarts'+ser_id).length){
                            $('#serfavstarts'+ser_id).html('<i class="fas fa-heart"></i>');
                        }
                    }else{
                        if($('#serfavstarts'+ser_id).length){
                            $('#serfavstarts'+ser_id).html('<i class="far fa-heart"></i>');
                        }
                    }
                }
            });
        });

</script>
<script>
jQuery("#carousel-discover").owlCarousel({
  autoplay: true,
  rewind: true, /* use rewind if you don't want loop */
  margin: 20,
   /*
  animateOut: 'fadeOut',
  animateIn: 'fadeIn',
  */
  responsiveClass: true,
  autoHeight: true,
  autoplayTimeout: 7000,
  smartSpeed: 800,
  nav: true,
  navText: ['<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>'],
  responsive: {
    0: {
      items: 1
    },

    600: {
      items: 3
    },

    1024: {
      items: 3
    },

    1366: {
      items: 3
    }
  }
});
</script>
@endsection