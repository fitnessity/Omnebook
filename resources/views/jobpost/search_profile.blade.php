@extends('layouts.header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{url('/public/css/all.css')}}">
<link rel="stylesheet" href="{{url('/public/css/stylenew.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type='text/css' href="/public/css/servicesmodal.css">

<style>
    #shopping-cart {margin: 40px;}
    #product-grid {margin: 40px;}
    #shopping-cart table {width: 100%;background-color: #F0F0F0;}
    #shopping-cart table td {background-color: #FFFFFF;}
    .txt-heading {color: #211a1a;border-bottom: 1px solid #E0E0E0;overflow: auto;}
    #btnEmpty {background-color: #ffffff;border: #d00000 1px solid;padding: 5px 10px;color: #d00000;float: right;text-decoration: none;border-radius: 3px;margin: 10px 0px;}
    .btnAddAction {padding: 5px 10px;margin-left: 5px;background-color: #efefef;border: #E0E0E0 1px solid;color: #211a1a;float: right;text-decoration: none;border-radius: 3px;cursor: pointer;}
    #product-grid .txt-heading {margin-bottom: 18px;}
    .product-item {float: left;background: #ffffff;margin: 30px 30px 0px 0px;border: #E0E0E0 1px solid;}
    .product-image {height: 155px;width: 250px;background-color: #FFF;}
    .clear-float {clear: both;}
    .demo-input-box {border-radius: 2px;border: #CCC 1px solid;padding: 2px 1px;}
    .tbl-cart {font-size: 0.9em;}
    .tbl-cart th {font-weight: normal;}
    .product-title {margin-bottom: 20px;}
    .product-price {float:left;}
    .cart-action {float: right;}
    .product-quantity {padding: 5px 10px;border-radius: 3px;border: #E0E0E0 1px solid;}
    .product-tile-footer {padding: 15px 15px 0px 15px;overflow: auto;}
    .cart-item-image {width: 30px;height: 30px;border-radius: 50%;border: #E0E0E0 1px solid;padding: 5px;vertical-align: middle;margin-right: 15px;}
    .no-records {text-align: center;clear: both;margin: 38px 0px;}
    .carousel-inner img{height:auto}
    
    .job_block a.active, .review-btn-links:hover{border:0!important; background:transparent; color:#777!important}
    .job_block .show{display:block}
    .outer { margin:0 auto; max-width:800px;}
    #big .item {padding: 0px 0px; margin:2px; color: #FFF; border-radius: 3px; text-align: center; }
    #thumbs .item {height:70px; line-height:70px; padding: 0px; margin:8px 4px 0px; color: #FFF;text-align: center; cursor: pointer; }
    #thumbs .item h1 { font-size: 18px; }
    /*#thumbs .current .item { background:#FF5722; }*/
    .owl-theme .owl-nav [class*='owl-'] { -webkit-transition: all .3s ease; transition: all .3s ease; }
    .owl-theme .owl-nav [class*='owl-'].disabled:hover { background-color: #D6D6D6; }
    #big.owl-theme { position: relative; }
    #big.owl-theme .owl-next, #big.owl-theme .owl-prev { background:#ff4d4d; width: 40px;border-radius:50px; line-height:40px; height: 40px; margin-top: -20px; position: absolute; text-align:center; top: 50%; }
    #big.owl-theme .owl-prev { left: 10px; }
    #big.owl-theme .owl-next { right: 10px; }
    /*.owl-carousel.owl-drag .owl-item{height: 375px !important;}*/
    div#thumbs {
        height: 100px !important;
    }
    /*.owl-item.active .item img{*/
    /*    height: 100px !important;*/
    /*}*/
    .fa.fa-arrow-right, .fa.fa-arrow-left{color: #fff;}
    #thumbs.owl-theme .owl-next, #thumbs.owl-theme .owl-prev { background:#333; }
    #sync1 {
        .item {
            background: #0c83e7;
            padding: 80px 0px;
            margin: 5px;
            color: #FFF;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            text-align: center;
        }
    }
    #sync2 {
        .item {
            background: #C9C9C9;
            padding: 10px 0px;
            margin: 5px;
            color: #FFF;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            text-align: center;
            cursor: pointer;
            h1 {
                font-size: 18px;
            }
        }
        .current .item{
            background: #0c83e7;
        }
    }
    .owl-theme {
        .owl-nav {
            /*default owl-theme theme reset .disabled:hover links */
            [class*='owl-'] {
                transition: all .3s ease;
                &.disabled:hover {
                    background-color: #D6D6D6;
                }   
            }
        }
    }
    #sync1.owl-theme {
        position: relative;
        .owl-next, .owl-prev {
            width: 22px;
            height: 40px;
            margin-top: -20px;
            position: absolute;
            top: 50%;
        }
        .owl-prev {
            left: 10px;
        }
        .owl-next {
            right: 10px;
        }
    }
    ul.job_topic li {
        width: 19.33% !important;
        float: left;
        border-right: 1px solid #bfbfbf;
        border-bottom: 1px solid #bfbfbf;
    }
    /*------- gallery ----------*/
    div#main_area {
        padding: 40px;
    }
    .wrapper{
        width:660px;
        height: 580px;
        background-color: #fff;
        float:left;
        margin:20px;
    }
    #big_img {
        width:600px;
        height: 420px;
        margin:20px 20px 0px 20px;
    }
    .thumbnail-inner{
        width:600px;
        height: 120px;
        background-color: #000;
        float: left;
        margin-left: 20px;
        overflow-y:auto;
    }
    .thumbnail-inner img{
        width:130px;
        height: 100px;
        margin:8px 0px 0px 12px;
        border:3px solid white;
        border-radius: 5px;
        opacity: 0.5;
        cursor: pointer;
    }
    .thumbnail-inner img:hover{
        opacity: 1;
    }
    .img-wrap {
        position: relative;
        float:left;
    }
    .img-wrap .delPhoto {
        position: absolute;
        top: 11px;
        right: 5px;
        z-index: 100;
        font-size:12px;
        color:#ff0000;
    }
</style>
<style>
    .booknow-box {
        border: 1px solid rgb(221, 221, 221);
        border-radius: 12px;
        padding: 24px;
        box-shadow: rgb(0 0 0 / 12%) 0px 6px 16px;
        margin-bottom: 20px;
    }
    .btn-book-now {
        background-color: #ed1b24;
        color: #fff !important;
        text-transform: uppercase;
        border-radius: 10px;
        border: 1px solid #ed1b24;
        text-align: center;
    }
    .bk-act{
        border: 1px solid #c7c3c3;
        border-radius: 15px;
    }
    .act-fld{
        border-right: 1px solid #c7c3c3;
        padding: 24px 6px;
        text-align: left;
    }
    .act-fld1{
        padding: 24px 6px;
        text-align: left;
    }
    #act-icn{
        font-size: 16px;
        position: absolute;
        margin-top: 2px;
        right: 8px;
    }
    .act-name{
        border: 1px solid rgb(221, 221, 221);
        padding: 6px;
        box-shadow: rgb(0 0 0 / 12%) 0px 6px 16px;
        background: #fafafa;
        position: absolute;
        margin-top: 4px;
        display:none;
    }
    .act-name1{
        border: 1px solid rgb(221, 221, 221);
        padding: 6px;
        box-shadow: rgb(0 0 0 / 12%) 0px 6px 16px;
        background: #fafafa;
        position: absolute;
        margin-top: 4px;
        display:none;
        width: 110px;
    }
    .act-name ul li {
        padding: 3px 10px;
        text-transform: capitalize;
    }
    .act-name ul li:hover{
        padding: 3px 10px;
        text-transform: capitalize;
        background: #208ee4;
        color: #fff;
    }
    .act-name1 ul li {
        padding: 3px 10px;
        text-transform: capitalize;
    }
    .act-name1 ul li:hover{
        padding: 3px 10px;
        text-transform: capitalize;
        background: #208ee4;
        color: #fff;
    }
    #actdatepicker{
        position: absolute;
    }
    .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-button.ui-state-active:hover {
        border: 1px solid #ff5722;
        background: #ff5722 url(images/ui-bg_fine-grain_15_eceadf_60x60.png) 50% 50% repeat;
        font-weight: bold;
        color: #ffff;
    }
    #actdateval{
        width:100%;
    }
    .righthalf {
        width: 38%;
        display: inline-block;
        padding-top: 10px;
    }
    .kickboxing-moredetails .modal-body .right-person .kickshow-block {
        border-bottom: 1px solid #000;
        padding-bottom: 5px;
        margin-bottom: 5px;
    }
    .kickboxing-moredetails .modal-body .right-person .kickshow-block .topkick.intro, .kickboxing-moredetails .modal-body .right-person .kickshow-block .topkick.intro1, .kickboxing-moredetails .modal-body .right-person .kickshow-block .topkick.intro2 {
        height: auto;
    }
    .btn{ }
    .btn-addtocart {
        padding:6px!important;
        background-color: #ed1b24;
        color: #fff !important;
        text-transform: uppercase;
        border-radius: 10px;
        border: 1px solid #ed1b24;
        text-align: center;
        font-size:10px!important;
        font-weight: bold;
    }
</style>

@section('content')
<div class="banner" style="height:371px; padding-top:71px; overflow:hidden">
    <a href="javascript::void(0);" data-toggle="modal" data-target="#uploadCoverPic">
          
            <img src="/public/images/newimage/banner.jpg" alt="images" class="img-fluid">
       
    </a>
</div>
<section class="banner-below-sec">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-2">
                <div class="comp-mark">
                    @if(File::exists(public_path("/uploads/profile_pic/thumb/".@$UserProfileDetail['profile_pic'])) && @$UserProfileDetail['profile_pic'] != '')
                    <img src="{{ url('/public/uploads/profile_pic/thumb/'.@$UserProfileDetail['profile_pic']) }}" alt="images" class="img-fluid">
                    @else
                    <img alt="" src="http://2.gravatar.com/avatar/?s=35&amp;d=mm&amp;r=g" srcset="http://0.gravatar.com/avatar/?s=70&amp;d=mm&amp;r=g 2x" class="avatar avatar-35 photo avatar-default" height="35" width="35" loading="lazy">
                    @endif
                    <a href="javascript:void(0);" class="edit-pic" data-toggle="modal" data-target="#editProfilePic" title="Click here to change picture">
                        
                    </a>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="editProfilePic" role="dialog">
                    {!! Form::open(array('url'=>url('/profile/editProfilePicture'),'method'=>'POST','files' => true , 'enctype' => 'multipart/form-data', 'id' => 'frmeditProfile_side')) !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-body login-pad">
                                <div class="pop-title employe-title">
                                    <h3>EDIT PROFILE PICTURE</h3>
                                </div>
                                <button type="button" class="close modal-close" data-dismiss="modal">
                                    <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                                </button>
                                <div class="signup">
                                    <div id='systemMessage'></div>
                                    <div class="emplouyee-form">
                                        <input class="upload-pic" type="file" name="profile_pic" id="profile_pic" class="form-control">
                                        <input type="hidden" name="croped_img" id="croped_img">
                                        <img class="result" id="result">
                                        <button type="submit" id="submit_profilepic">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- Modal Ends -->  
            </div>

            <div class="col-lg-6">
                <div class="bnr-information">
                    <h2 style="text-transform: capitalize;">{{@$UserProfileDetail->firstname}} {{@$UserProfileDetail->lastname}}</h2>
                    <h6></h6>
                    <div class="url-copy">                  
                    </div>
                    
                </div>
            </div>

            <div class="col-lg-4 top-1">
                <div class="reatingbox">
                    <!-- <h5><span>0 </span> / 5 Ratings</h5> -->
                    
                    <div class="social">
                        <ul>
                        <li>http://fitnessity.co/yournamehere 
                        </li>
                        </ul>
                        <ul>
                            <li><a href="javascript:void(0);" class="follower-fav">{{$ProfileFavcount}} Favourite </a></li>
                            <li><a class="follower-fun" href="javascript:void(0);">{{$ProfileFollowcount}} Followers </a></li>
                            <li><a href="#"><img src="/public/images/newimage/share.png" alt="icon">Share</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="menu-black sticky-top">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-4">
                <div class="name-div border-0">
                    <!--<span><a href="#mydesc" style="color:#ffffffb3"> About </a></span>
                    <span><a href="#photo" style="color:#ffffffb3"> Photos </a></span>
                    <span><a href="#video-box" style="color:#ffffffb3"> Videos </a></span>
                    <span><a href="#family-id" style="color:#ffffffb3"> Family </a></span>-->
                </div>
            </div>
            <div class="col-lg-8">
            </div>
        </div>
    </div>
</section>
<section class="desc-sec">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <h2>Info</h2>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                    &nbsp;
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                    Username: @if(isset(@$UserProfileDetail['username'])) {{ "@".@$UserProfileDetail['username']}} @else - @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                    Company: @if(isset($companies)) @foreach($companies as $value) {{$value['company_name']}} @if(count($companies) != $loop->iteration) , @endif @endforeach @endif <a href="/manage/company" title="Manage your company"></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                    Favorite Activities: @if(isset(@$UserProfileDetail['favorit_activity'])){{@$UserProfileDetail['favorit_activity']}}@else - @endif <a href="/personal-profile/user-profile" title="Update your activity"></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                    Member Since: 08/21
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                    <img src="https://upload.wikimedia.org/wikipedia/en/a/a4/Flag_of_the_United_States.svg" alt="images" class="img-fluid" width="25" height="15">
                    
                    New York, NY United States
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                   Favorite Activities: Tae Know Do, ATV, Kickboxking, BJJ
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 mt-70">
                        <div class="box-red">
                            <h1 class="red-box-font">VERIFICATION</h1>
                            <div class="veri-icon-new-1">
                                <span>
                                    <a href="{{'tel:'.@$UserProfileDetail['phone_number']}}" title="phone" class="cophone"><i class="fa fa-phone" aria-hidden="true"></i></a>
                                </span>
                                <span >
                                    <a href="{{'mailto:'.@$UserProfileDetail['email']}}" title="email"  class="coemail"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                                </span>
                                 <span>
                                    <a href="#" title="link"  class="coemail"><i class="fa fa-link" aria-hidden="true"></i></a>
                                </span>
                                <span >
                                    <a href="{{'http://maps.google.com/?q='.@$UserProfileDetail['address']}}" title="address" class="coaddress" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
                                </span>
                            </div>
                    <!--<img src="/public/img/verification.png" />-->
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-sm-12 col-lg-12 mt-20">
                        <div class="box-white">
                            <div class="title-statistics">
                                <a class="statistics-font" href="#"><i class="far fa-bookmark" aria-hidden="true"></i>  STATISTICS</a>
                            </div>
                            
                        <ul class="list-st">
                          <li class="list-items">
                            <img src="/public/img/profile.png" width="20" height="20"><a href="#">12433 Profile Views</a>
                          </li>
                          <li class="list-items">
                            <img src="/public/img/heart.png" width="20" height="20"><a href="#">36Favorites</a>
                          </li>
                          <li class="list-items">
                            <img src="/public/img/heart2.png" width="20" height="20"><a href="#">56Followings</a>
                          </li>
                        </ul>
                        <ul class="list-st">
                          <li class="list-items">
                            <img src="/public/img/calendar.png" width="20" height="20"><a href="#">400Bookings</a>
                          </li>
                          <li class="list-items">
                            <img src="/public/img/share.png" width="20" height="20"><a href="#">135Shares</a>
                          </li>
                          <li class="list-items">
                            <img src="/public/img/rating.png" width="20" height="20"><a href="#">Reviews Posted</a>
                          </li>
                        </ul>
                        </div>
                    <!--<img src="/public/img/statistics.png" />-->
                    </div>
                </div>
            </div>
            
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="desc-text">
                    <span><a href="#mydesc" style="color:#000000;font-size: 22px;padding-right: 20px;"> About </a></span>
                    <span><a href="#photo" style="color:#000000;font-size: 22px;"> Photos </a></span>
                </div>
                <div class="desc-box-new">
            
                    <div class="desc-text" id="mydesc">
                        <h5>About</h5>
                        <?php $gender = array('' => 'Select Gender', 'Male' => 'Male', 'Female' => 'Female'); ?>
                        <p>@if(isset(@$UserProfileDetail['business_info'])) {!! nl2br(@@$UserProfileDetail['business_info']) !!} @else - @endif</p>
                        <p>@if(isset(@$UserProfileDetail['intro'])) {!! nl2br(@@$UserProfileDetail['intro']) !!} @endif</p>
                    </div>

                    <div class="gallery-box" id="photo">
                        <div id="main_area" style="padding:0">
                            <!-- Slider -->
                            <div class="row" style="display:none">
                                <div class="col-xs-12" id="slider">
                                    <h5> Photos </h5>
                                    <!-- Top part of the slider -->
                                    <div class="" id="carousel-bounding-box">
                                        <div class="carousel slide round5px" id="myCarousel" data-ride="carousel">
                                            <!-- Carousel items -->
                                            <div class="carousel-inner">
                                                
                                                </div>
                                                <!-- Carousel nav -->
                                            </div>
                                            <!--/Slider-->
                                            <div id="slider-thumbs">
                                                <!-- Bottom switcher of slider -->
                                                <ul class="hide-bullets">
                                                   
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="video-box" id="video-box" style="display:none">
                                <h5> Video </h5>
                                <div class="video-responsive">
                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/Ol2QjF53OPQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                </div>
                            </div>

                            <div class="pr-listing-amerties" id="family-id" style="display:none">
                                <!-- Modal -->
                                <div class="modal fade" id="addFamilyDetailModal" role="dialog">
                                    <!-- <form  id="frmeditProfileDetail" method="post"> -->
                                    {!! Form::open(array('id' => 'frmaddFamilyDetail')) !!}
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="modal-dialog modal-lg">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-body login-pad">
                                                <div class="pop-title employe-title">
                                                    <h3 id="familyModal">Add Family Member Info</h3>
                                                </div>
                                                <button type="button" class="close modal-close" data-dismiss="modal">
                                                    <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                                                </button>

                                                <div class="signup">
                                                    <div id='systemMessage_detail'></div>
                                                    <div class="emplouyee-form">
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label for="usr" class="lbl">First Name:</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="text" name="first_name" id="frm1_firstname" placeholder="First Name">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label for="usr" class="lbl">Last Name:</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="text" name="last_name" id="frm1_lastname" placeholder="Last Name">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label for="usr" class="lbl">Gender Name:</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <div class="select-style review-select2">

                                                                    {!! Form::select('gender', $gender,null, ['class' => 'form-control', 'id' => 'frm1_gender']) !!}

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" style="display:none;" name="family_id" id="family_id" value="0" />
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label for="usr" class="lbl">Email:</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="text" name="email" id="frm1_email" placeholder="Email">
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label for="usr" class="lbl">Relationship:</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <?php
                                                                $relationship = array('' => 'Select Relationship', 'Brother' => 'Brother', 'Sister' => 'Sister', 'Father' => 'Father', 'Mother' => 'Mother', 'Wife' => 'Wife'
                                                                    , 'Husband' => 'Husband', 'Son' => 'Son', 'Daughter' => 'Daughter');
                                                                ?>

                                                                <div class="select-style review-select2">

                                                                    {!! Form::select('relationship', $relationship, null, ['class' => 'form-control', 'id' => 'frm1_relationship']) !!}

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label for="usr" class="lbl">Birthday:</label>
                                                            </div>
                                                            <div class="col-sm-8" id="datepicker-position">
                                                                <input type="text" class="form-control" autocomplete="off" name="birthday"   placeholder="MM-DD-YYYY" id="frm1_birthday" />
                                                            <!--<input type="text" autocomplete="off" name="birthday" id="my_date_picker" placeholder="Birthday">-->

                                                            </div>
                                                        </div>

                                                        <!-- <input type="text" name="phone_number" id="frm_phone_number" placeholder="(XXX) XXX XXX" value=""> -->
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label for="usr" class="lbl">Mobile:</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="text" name="mobile" maxlength="10" id="frm1_mobile" required placeholder="Mobile" />
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <label for="usr" class="lbl">Emergency Contact:</label>
                                                            </div>
                                                            <div class="col-sm-8">
                                                                <input type="text" name="emergency_contact" maxlength="10" id="frm1_emergency_contact" placeholder="Emergency Contact" />
                                                            </div>
                                                        </div>

                                                        <button type="button" id="submit_familydetail">Submit</button>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    {!! Form::close() !!}

                                    <!-- </form> -->

                                </div>

                                <h5> Family Details</h5>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 nw-user-detail">
                                    <a href="javascript: void(0);" style="float: right" data-toggle="modal" id="addFamily" data-target="#addFamilyDetailModal"><i class="fa fa-plus"></i> Add Family Member</a>
                                </div> 
                                <table class="table">
                                    <thead>
                                        <tr>

                                            <th scope="col" id="uplogradProfileBtn">Name</th>

                                            <th scope="col">Relationship</th>

                                            <th scope="col">Email</th>

                                            <th scope="col">Emergency Contact</th>

                                            <th scope="col">Mobile</th>

                                            <th scope="col">Gender</th>

                                            <th scope="col">Action</th>

                                            <!--<th scope="col">Birthday</th>-->

                                        </tr>

                                    </thead>

                                    

                                </table>

                            </div>

                            <div class="video-box">
                                <h5> Photos </h5>
                               

                                <div class="file-upload" style="width:600px">
                                    <form name="frm_cover" id="frm_cover" action="{{Route('file-upload')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                       
                                        <p>&nbsp;</p>
                                        <div class="image-title-wrap">
                                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                           <!--  <button type="submit" name="submit_cover" class="remove-image">Save Photo</button> -->
                                        </div>
                                    </form>
                                </div>

                                <div class="pr-upload-imgbox" id="imagedropbox" style="display:none">
                                    <div class="upoload-dotbox">
                                        <p>Drop images to upload</p>
                                        <p>Or</p>
                                        <p><img src="/public/images/newimage/upload-img.jpg" alt="images"></p>
                                        <p class="gallryup">Gallery Images</p>
                                    </div>
                                </div>

                            </div>


                            <!-- Thumbnail images of users from company_images objects are 
                            rendering here and also publishing in the buiness profile page -->                   
                            @isset(Auth::user()->company_images)
                            <div class="row" style="padding: 10px 20px;" id="delimgbox">
                                @foreach(json_decode(Auth::user()->company_images) as $key=>$value)

                                <div class="col-md-4" class="imgdeletediv" style="position:relative;padding: 15px;">
                                    <img src="<?php echo Config::get('constants.USER_IMAGE_THUMB') . $value; ?>" style="width:100%;height:200px;" />
                                    <button type="button" myindex="{{$key}}" class="btn btn-primary delimg" style="margin-top: 15px;"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                </div>
                                @endforeach
                            </div>
                            @endisset

                            <div id="Modal" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title" style="color:black;">Add User Images</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{url('/user-multi-image-upload')}}" enctype="multipart/form-data">
                                                <input required type="file" class="form-control" name="images[]" placeholder="Company Image" multiple>
                                                <input type="hidden" name="_token" value="{{csrf_token()}}" />

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-default">Save</button>
                                            </form>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <div class="right-box">
                        <!--<div class="pr-verification" style="background-color:transparent;background-image:url('/public/images/get-verified.jpg');background-repeat: no-repeat;background-position: center;background-size: 360px 240px">
                            <div class="veri-icon-new" style="margin-top:112px">
                                <span >
                                    <a href="{{'tel:'.@$UserProfileDetail['phone_number']}}" style="background-color:green;" title="phone" class="cophone"><i class="fa fa-phone" aria-hidden="true"></i></a>
                                </span>
                                <span >
                                    <a href="{{'mailto:'.@$UserProfileDetail['email']}}" style="background-color:green;" title="email"  class="coemail"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                                </span>
                                <span >
                                    <a href="{{'http://maps.google.com/?q='.@$UserProfileDetail['address']}}" style="background-color:green;" title="address" class="coaddress" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
                                </span>
                            </div>
                        </div>-->

                        <div class="static hide">
                            <h5><i class="far fa-bookmark mr-2"></i> Statistic </h5>
                            <div class="static-soc">
                                <ul>
                                    <li><a href="#"><i class="far fa-eye mr-2"></i> 0 Views </a></li>
                                    <li><a href="#"><i class="far fa-star mr-2"></i> 0 Ratings </a></li>
                                    <li><a href="#"><i class="far fa-heart mr-2"></i> 0 Favorites</a></li>
                                    <li><a href="#"><i class="fas fa-share mr-2"></i> 0 Shares </a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="get-started">
                            <div class="get-img"><img src="/public/images/newimage/get-started.jpg" alt="images" class="img-fluid"></div>
                            <div class="get-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</div>
                            <div class="get-btn-box"><a href="#" class="get-btn"> Get Started </a> </div>
                        </div>

                        <div class="ad-img">
                            <img src="/public/images/newimage/ad-img.jpg" alt="images" class="img-fluid">
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
</section>

<!-- Favourite , follow, following-->
<script type="text/javascript">
    // Follow script
    
    $(".follower-fun").click(function () {
        var _token = $("input[name='_token']").val();
        var followerId = '<?php echo @$UserProfileDetail->id ?>';
        $.ajax({
            type: 'POST',
            url: '{{route("follow_profile")}}',
            data: {
                _token: _token,
                followerId:followerId,
            },
            success: function (data) {
                if(data.success=='error'){
                    alert("Please login first!");
                }
                window.location.reload();
                
            }
        });
    });

    $(".follower-fav").click(function () {
        var _token = $("input[name='_token']").val();
        var favId = '<?php echo @$UserProfileDetail->id ?>';
        $.ajax({
            type: 'POST',
            url: '{{route("fav_profile")}}',
            data: {
                _token: _token,
                favId:favId,
            },
            success: function (data) {
                if(data.success=='error'){
                    alert("Please login first!");
                }
                //window.location.reload();
                
            }
        });
    });

    $(document).ready(function () {
        var profileViewCount = '<?php echo $ProfileView; ?>';
        if(profileViewCount == 0){
        var _token = $("input[name='_token']").val();
        var userd = '<?php echo @$UserProfileDetail->id ?>';
        $.ajax({
            type: 'POST',
            url: '{{route("profileView")}}',
            data: {
                _token: _token,
                userd:userd,
            },
            success: function (data) {
               
                
            }
        });
    }

    });

</script>
@endsection

