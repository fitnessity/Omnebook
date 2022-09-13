@extends('layouts.header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>all.css">
<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>stylenew.css">
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
    
    .review-btn-links:hover{border:0!important; background:transparent; color:#777!important}
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
    }
    /*------- gallery ----------*/
    div#main_area {
        padding: 40px;
    }
    .wrapper{
       /* width:660px;
        height: 580px; */
        background-color: #fff;
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
        /* float: left; */
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
<?php
use App\CompanyInformation;
use App\Review;
 $companyinfo = CompanyInformation::find($company->id);
        $avgrating = Review::where('reviewfor_userid',$companyinfo->user_id)->avg('rating');
?>
<div class="text-right" id="bookCompany" style="margin-right: 16px;display:none;">
    <a href="/directhire/bookprofile/{{ $company['id'] }}" class="view-more-right" style="float:right;">
        BOOK THIS COMPANY
    </a>
</div>

<div class="banner">
    <?php
    if (!empty($gallery)) {
        ?>
        <div style="height:371px; padding-top:71px; background:#000;  padding-bottom:5px;">
            <?php
            foreach (array_slice($gallery, 0, 4) as $pic) {
            ?>
            <img style="padding:0; margin:0; float:left" width="25%" height="300" src="/public/uploads/gallery/<?= $company->user_id ?>/thumb/<?= $pic['name'] ?>" />
            <?php } ?>
        </div>
    <?php } else { ?> 
        @if(isset($company->company_images[0]) && !empty($company->company_images[0]))
        <img src="<?php echo Config::get('constants.USER_IMAGE_THUMB') . $company->company_images[0]; ?>" alt="images" class="img-fluid">
        @else
        <img src="/public/images/newimage/banner.jpg" alt="images" class="img-fluid">
        @endif
    <?php } ?>
</div>

<section class="banner-below-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="comp-mark">
                    <?php
                    if (File::exists(public_path("/uploads/profile_pic/thumb/" . $company['logo']))) {
                        $profilePic = url('/public/uploads/profile_pic/thumb/' . $company['logo']);
                    } else {
                        $profilePic = '/public/images/default-avatar.png';
                    }
                    ?>
                    <img src="<?php echo $profilePic; ?>" alt="images" class="img-fluid">
                    <a href="javascript:void(0);" class="edit-pic" data-toggle="modal" data-target="#editProfilePic" title="Click here to change picture">
                        <div id="mycamera">
                            <span class="fa fa-camera" style="position:relative;left:-7px;top:7px;"></span>
                        </div>
                    </a>
                </div>
            </div>

            <div id="Modal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title" style="color:black;">Add Company Images</h4>
                        </div>
                        <form method="POST" action="{{url('/company-image-upload')}}" enctype="multipart/form-data">
                            <div class="modal-body">
                                @isset($company->id)
                                <input type="hidden" name="company_id" value="{{$company->id}}" />
                                @endisset
                                <input required type="file" class="form-control" name="images[]" placeholder="Company Image" multiple>
                                <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default">Save</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="editProfilePic" role="dialog">
                {!! Form::open(array('files' => true , 'enctype' => 'multipart/form-data', 'id' => 'frmeditProfile_side')) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-dialog modal-lg">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-body login-pad">
                            <div class="pop-title employe-title">
                                <h3>EDIT COMPANY LOGO</h3>
                            </div>
                            <button type="button" class="close modal-close" data-dismiss="modal">
                                <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                            </button>
                            <div class="signup">
                                <div id='systemMessage'></div>
                                <div class="emplouyee-form">
                                    <input class="upload-pic" type="file" name="profile_pic" id="profile_pic" class="form-control">
                                    <button type="submit" id="submit_profilepic">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- Modal Ends -->  

            <div class="col-lg-6">
                <div class="bnr-information">
                    <h2>{{$company->company_name}}<span class="pr-climed">Claimed</span></h2>
                    <h6>{{$company->short_description}}</h6>
                    <p><b>Company: </b>{{$company->first_name}} {{$company->last_name}}</p>
                    <p><b>Username: </b><?php echo '@'; ?>{{$company->business_user_tag}}</p>
                    <?php if( $services->count() > 0 ){ ?>
                    <p><b>Favorite Activities: </b>  
                        @foreach($services as $service)
                        {{$service['amenties']}}@if(($loop->iteration != count($services))), @endif
                        @endforeach
                    </p>
                    <?php } ?>
                </div>
            </div>

            @if(Auth::check())
            <?php 
				$companyUserId = CompanyInformation::find($company->id);
				$reviewuser = \App\Review::where('reviewby_userid',Auth::user()->id)->where('reviewfor_userid',$companyUserId->user_id)->first(); 
			?>

                @if(empty($reviewuser))
    
                 <!--  <div class="col-lg-4"> 
               <form method="post" action="{{route('savereviews')}}">
                    @csrf
                    <div class="review-dtl-block">
                     <div class="clearfix"></div>
                     <div class="write-review-form">
                        <input type="hidden" name="companyId" value="{{$company['id']}}">
                        
                        <div class="rvw-overall">
                          <input type="hidden" name="rating" id="rating" value="0">
                          <div class="rvw-overall-rate rvw-ex-mrgn">
                            <span>Rating</span>
                            <div id="stars" class="starrr">                
                            </div>
            
                          </div>
                           
                        <div class="review-form-block">
                          <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12 rvw-ex-mrgn">
                                  <textarea name="review" id="reviewDescription" class="rvw-input @if ($errors->has('review')) field-error @endif" placeholder="Review (atleast 30 words)"></textarea>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                  <button class="rvw-button" id="saveBtn" type="submit"> SAVE</button>
                                </div>                  
                            </div>
                        </div>
                        </div>
                     </div>
            
                    </div>
                    </form>
                </div>-->
                @endif
    		@endif

    <div class="col-lg-4"> 
    <p>You Have already given rating.</p>
    </div>
                  

            <div class="col-lg-4">
                <div class="reatingbox">
                    <h5><span>{{number_format($avgrating,1)}} </span> / 5 Ratings</h5>
                    <div class="social">
                        <ul>
                            <li><a class="fav-fun" href=""><i class="far fa-heart mr-2"></i>Favourite</a></li>
                            <li><a class="follow-fun" href=""><i class="fa fa-hand-o-right mr-2"></i>Follow</a></li>
                            <li><a href="#write_review">
                            	<img src="/public/images/newimage/review.png" alt="icon"> Submit Review</a>
                            </li>
                            <li><a href=""><img src="/public/images/newimage/share.png" alt="icon">Share</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="menu-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div class="name-div sticky-top">
                    <span><a href="#mydesc"> About </a></span>
                    <span><a href="#amenities-id"> Amenities </a></span>
                    <span><a href="#photo"> Photos </a></span>
                    <span><a href="#video-box"> Videos </a></span>
                    <span><a href="#experience-id"> Experience </a></span>
                    <span><a href="#things-id"> Things to Know </a></span>
                    <!--<span><a href="#review-id"> Reviews </a></span>-->
                    <span><a href="#write_review"> Reviews </a></span>
                    <span><a href="javascript::void(0);" data-toggle="modal" data-target="#ServicesModal">Services</a></span>
                    <span style="display: none"><a href="#services-id"> Services </a></span>
                </div>
            </div>
            <div class="col-lg-4 text-right">
                <div class="claim-business border-radius6" onclick="location.href = '/claim-your-business'"> Claim Business </div>
            </div>
        </div>
    </div>
</section>

<section class="desc-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="desc-box-new">
                    <div class="desc-text" id="mydesc">
                        <h5> About</h5>
                        <p>{{$company->about_company}}</p>
                    </div>
                    <div class="pr-listing-amerties" id="amenities-id">
                        <h5>Amenities</h5>
                        <div class="row no-gutters">
                            <div class="col-lg-8 mb-3 pr-list">
                            <?php
                            if (isset($business_spec) && !empty($business_spec)) {
                                if (isset($business_spec['serBusinessoff1']) && !empty($business_spec['serBusinessoff1'])) {
                                    echo $business_spec['serBusinessoff1'];
                                }
                            }
                            ?>
                            </div>
                        </div>
                    </div>

                    <div class="gallery-box" id="photo">
                        <h5>Photos</h5>
                        <?php
                        if (!empty($gallery)) {
                            ?>
                            <div class="wrapper">
                                <div id="big_img">
                                    <img src="/public/uploads/gallery/<?= $company->user_id ?>/<?= $gallery[0]['name'] ?>" width="600" height="400" id="myPicture" class="border" />
                                </div>
                                <div class="thumbnail-inner">
                                    <?php
                                    foreach ($gallery as $pic) {
                                        ?>
                                        <div class="img-wrap">
                                            <i class="fa fa-trash-o delPhoto hide" delId="{{ $pic['id'] }}" aria-hidden="true" title="Delete photo"></i>
                                            <img src="/public/uploads/gallery/<?= $company->user_id ?>/thumb/<?= $pic['name'] ?>" id="/public/uploads/gallery/<?= $company->user_id ?>/<?= $pic['name'] ?>" />
                                        </div>
                                    <?php } ?> 
                                </div>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="video-box" id="video-box">
                        <h5> Videos </h5>
                        <div class="video-responsive">
                            <?php
                            $EmbedVideo = $company->embed_video;
                            $embedURL = !empty($EmbedVideo) ? $EmbedVideo : 'rW_fwcmyIfk';
                            ?>
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/<?=$embedURL?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>

                    <div class="busines-offer-list busines-off-profile-list" id="experience-id">
                        <div class="job_block">
                            <ul id="myTab_1" class="job_topic">
                                <li class="active"><a href="#tab_employment_history" data-toggle="tab" >Work History</a></li>
                                <li><a href="#tab_education" data-toggle="tab" >Education</a></li>
                                <li><a href="#tab_certification" data-toggle="tab" >Certification</a></li>
                                <li><a href="#tab_skill" data-toggle="tab" >Skill</a></li>
                                <li><a href="#tab_services" data-toggle="tab" >Services</a></li>
                            </ul>

                            <div id="myTabContent" class="tab-content">  
                                <!-- employment history section - starts -->
                                <div id="tab_employment_history" class="tab-pane active in fade job_listing_block">
                                    <div class="job_listing">
                                        <div class="row">
                                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">
                                                @if(isset($business_exp) && !empty($business_exp))
                                                <div class="job_post_dtls">
                                                    <h4>Company Name:</h4> {{ $business_exp['frm_organisationname'] }} 
                                                </div>
                                                <div class="job_post_dtls">
                                                    <h4>Position:</h4> {{ $business_exp['frm_position'] }} 
                                                </div>
                                                <div class="job_post_dtls">
                                                    <h4>Experience between:</h4> {{ $business_exp['frm_servicestart'] }} - {{ $business_exp['frm_serviceend'] }} 
                                                </div>
                                                @else
                                                No Employeement History Found
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nw-user-detail-line2"></div>
                                </div>

                                <!-- education section -  starts -->

                                <div id="tab_education" class="tab-pane fade job_listing_block">
                                    <div class="job_listing">
                                        <div class="row">
                                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls profiledetail">
                                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">
                                                    @if(isset($business_exp) && !empty($business_exp))
                                                    <div class="job_post_dtls">
                                                        <h4>Degree - Course:</h4> {{ $business_exp['frm_course'] }} 
                                                    </div>
                                                    <div class="job_post_dtls">
                                                        <h4>University - School:</h4> {{ $business_exp['frm_university'] }} 
                                                    </div>
                                                    <div class="job_post_dtls">
                                                        <h4>Year Graduated (yyyy):</h4> {{ $business_exp['frm_passingyear'] }}
                                                    </div>
                                                    @else
                                                    No record found
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- certification section -  starts -->          

                                <div id="tab_certification" class="tab-pane fade job_listing_block">
                                    <div class="job_listing">
                                        <div class="row">
                                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls profiledetail">
                                                @if(isset($business_exp) && !empty($business_exp))
                                                <div class="job_post_dtls">
                                                    <h4>Name of Certification:</h4> {{ $business_exp['certification'] }} 
                                                </div>
                                                <div class="job_post_dtls">
                                                    <h4>Completion Date (mm/dd/yyyy):</h4> {{ $business_exp['frm_passingdate'] }} 
                                                </div>
                                                @else
                                                No record found
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- skill starts -->          

                                <div id="tab_skill" class="tab-pane fade job_listing_block">
                                    <div class="job_listing">
                                        <div class="row">
                                            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls profiledetail">
                                                @if(isset($business_exp) && !empty($business_exp))
                                                <div class="job_post_dtls">
                                                    <h4>Skill Type:</h4> {{ $business_exp['skill_type'] }} 
                                                </div>
                                                <div class="job_post_dtls">
                                                    <h4>Description:</h4> {{ $business_exp['frm_skilldetail'] }} 
                                                </div>
                                                <div class="job_post_dtls">
                                                    <h4>Completion Date (mm/dd/yyyy):</h4> {{ $business_exp['skillcompletion'] }} 
                                                </div>
                                                @else
                                                No record found
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- services section starts -->          

                                <div id="tab_services" class="tab-pane fade job_listing_block">
                                    <?php
                                    $companyid = $companylogo = $companyname = $companyaddress = "";
                                    if (isset($serviceData)) {
                                        foreach ($serviceData as $key => $service) {
                                            $company = [];
                                            $serviceId = $service['id'];
                                            $sport_activity = $service['sport_activity'];
                                            $area = !empty($service['area']) ? $service['area'] : 'Location';
                                            if (isset($companyData)) {
                                                if (isset($companyData[$service['cid']]) && !empty($companyData[$service['cid']])) {
                                                    $company = $companyData[$service['cid']];
                                                    $company = isset($company[0]) ? $company[0] : [];
                                                    if (!empty($company)) {
                                                        $companyid = $company['id'];
                                                        $companylogo = $company['logo'];
                                                        $companyname = $company['company_name'];
                                                        $companyaddress = $company['address'];
                                                    }
                                                }
                                            }
                                            ?>
                                            <div class="job_listing">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 job_lst_dtls profiledetail">
                                                        <div class="jb-title">
                                                            <h1>
                                                                <?php
                                                                if (File::exists(public_path("/uploads/profile_pic/thumb/" . $service['profile_pic']))) {
                                                                    $profilePic = url('/public/uploads/profile_pic/thumb/' . $service['profile_pic']);
                                                                } else {
                                                                    $profilePic = '/public/images/default-avatar.png';
                                                                }
                                                                ?>
                                                                <img width="90" src="{{ $profilePic }}">
                                                            </h1>
                                                        </div>
                                                        <div class="col-md-12" style="padding-left: 0px;">
                                                            <div class="col-md-6" style="padding-left: 0px;">
                                                                <p><b>Activity Name:</b> <?= $service['program_name'] ?></p>
                                                                <p><b>Price:</b> $140</p>
                                                                <p><b>Description:</b> </p>
                                                                <p><b>Service Type:</b> <?= $service['program_name'] ?></p>
                                                                <p><b>Program Type:</b> <?= $service['program_name'] ?></p>
                                                                <p><b>Age Range:</b> <?= $service['age_range'] ?></p>
                                                                <p><b>Program is for:</b> <?= $service['activity_for'] ?></p>
                                                                <p><b>Experience Level:</b> <?= $service['difficult_level'] ?></p>
                                                            </div>
                                                            <div class="col-md-6" style="padding-left: 0px;">
                                                                <p><b>Number of People:</b> <?= $service['group_size'] ?></p>
                                                                <p><b>Place:</b> <?= $service['activity_location'] ?></p>
                                                                <p><b>Program Focuses On:</b> </p>
                                                                <p><b>Special Deals:</b> </p>
                                                                <p><b>Service Price Options:</b> </p>
                                                                <p><b>Duration:</b> <?= $service['activity_meets'] ?></p>
                                                                <p><b>Terms & Conditions:</b> </p>
                                                            </div>
                                                        </div>
                                                        <div class="job_post_dtls"></div>
                                                    </div>
                                                </div>
                                            </div>            
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="job_listing">                
                                            <div class="row">
                                                <div class="col-lg-1 col-md-1 col-sm-8 col-xs-8 job_lst_img">
                                                    <span></span>
                                                </div>
                                                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 job_lst_dtls">
                                                    No record found
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pr-thinsg-to-know" id="things-id">
                        <h5>THINGS TO KNOW</h5>
                        <?php
                        $houserules = $cancelation = $cleaning = $termcondfaq = $termcondfaqtext = $contractterms = $contracttermstext = $liability = $liabilitytext = $covid = $covidtext = "";
                        if (isset($business_term)) {
                            if (isset($business_term['houserules']) && !empty($business_term['houserules'])) {
                                $houserules = $business_term['houserules'];
                            }
                            if (isset($business_term['cancelation']) && !empty($business_term['cancelation'])) {
                                $cancelation = $business_term['cancelation'];
                            }
                            if (isset($business_term['cleaning']) && !empty($business_term['cleaning'])) {
                                $cleaning = $business_term['cleaning'];
                            }
                            if (isset($business_term['termcondfaq']) && !empty($business_term['termcondfaq'])) {
                                $termcondfaq = $business_term['termcondfaq'];
                            }
                            if (isset($business_term['termcondfaqtext']) && !empty($business_term['termcondfaqtext'])) {
                                $termcondfaqtext = $business_term['termcondfaqtext'];
                            }
                            if (isset($business_term['contractterms']) && !empty($business_term['contractterms'])) {
                                $contractterms = $business_term['contractterms'];
                            }
                            if (isset($business_term['contracttermstext']) && !empty($business_term['contracttermstext'])) {
                                $contracttermstext = $business_term['contracttermstext'];
                            }
                            if (isset($business_term['liability']) && !empty($business_term['liability'])) {
                                $liability = $business_term['liability'];
                            }
                            if (isset($business_term['liabilitytext']) && !empty($business_term['liabilitytext'])) {
                                $liabilitytext = $business_term['liabilitytext'];
                            }
                            if (isset($business_term['covid']) && !empty($business_term['covid'])) {
                                $covid = $business_term['covid'];
                            }
                            if (isset($business_term['covidtext']) && !empty($business_term['covidtext'])) {
                                $covidtext = $business_term['covidtext'];
                            }
                        }
                        ?>
                        @if($houserules!='')
                        	<h3>House Rules</h3>
                        	<p>{{ $houserules }}</p>
                        @endif
                        @if($cancelation!='')
                            <h3>Cancelation Policy</h3>
                            <p>{{ $cancelation }}</p>
                        @endif
                        @if($cleaning!='')
                            <h3>Safty and Cleaning Procedures</h3>
                            <p>{{ $cleaning }}</p>
                        @endif
                        @if($termcondfaq==1)
                            <h3>Terms, Conditions, FAQ</h3>
                            <p>{{ $termcondfaqtext }}</p>
                        @endif
                        @if($contractterms==1)
                            <h3>Contract Terms ?</h3>
                            <p>{{ $contracttermstext }}</p>
                        @endif
                        @if($liability==1)
                            <h3>Liability Waiver</h3>
                            <p>{{ $liabilitytext }}</p>
                        @endif
                        @if($covid==1)
                            <h3>Covid – 19 Protocols</h3>
                            <p>{{ $covidtext }}</p>
                        @endif
                    </div>

                    <div class="pr-rivew hide" id="review-id">
                        <h4> Review </h4>
                        <a href="{{url('/reviews')}}" class="review-btn hide" target="_blank">Add Review</a>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="review-points"> 4 Reviews  <span><i class="fas fa-star mr-1 ml-2"></i> 4.09</span></div>
                            </div>
                            <div class="col-lg-6 text-right">
                                <a href="" class="review-btn" >Submit a Review</a href="">
                            </div>
                            <div class="col-lg-12">
                                <div class="pr-progressbar">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col-lg-3 mb-3"><div class="pr-progess-txt">Cleanliness</div></div>
                                        <div class="col-lg-3 mb-3">
                                            <div class="pr-progess-bar">
                                                <div class="progress">
                                                    <div class="progress-bar bg-pro-company" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> <span>3.8</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-3"><div class="pr-progess-txt">Communication</div></div>
                                        <div class="col-lg-3 mb-3">
                                            <div class="pr-progess-bar">
                                                <div class="progress">
                                                    <div class="progress-bar bg-pro-company" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> <span>4.0</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-3"><div class="pr-progess-txt">Check-in</div></div>
                                        <div class="col-lg-3 mb-3">
                                            <div class="pr-progess-bar">
                                                <div class="progress">
                                                    <div class="progress-bar bg-pro-company" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> <span>3.8</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-3"><div class="pr-progess-txt">Accuracy</div></div>
                                        <div class="col-lg-3 mb-3">
                                            <div class="pr-progess-bar">
                                                <div class="progress">
                                                    <div class="progress-bar bg-pro-company" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> <span>4.0</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-3"><div class="pr-progess-txt">Location</div></div>
                                        <div class="col-lg-3 mb-3">
                                            <div class="pr-progess-bar">
                                                <div class="progress">
                                                    <div class="progress-bar bg-pro-company" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> <span>3.8</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 mb-3"><div class="pr-progess-txt">Value</div></div>
                                        <div class="col-lg-3 mb-3">
                                            <div class="pr-progess-bar">
                                                <div class="progress">
                                                    <div class="progress-bar bg-pro-company" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> <span>4.0</span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="main-review hide">
                        <div class="media">
                            <img src="/public/images/newimage/get-started.jpg" class="mr-3" alt="images">
                            <div class="media-body mt-2">
                                <h5 class="mt-0">Aitor Molina <span><i class="fas fa-star mr-1 ml-2"></i> 4.09</span></h5>
                                <h6> 30 Nov</h6>
                            </div>
                        </div>
                        <p>Amazing place!</p>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                        <div class="media-gllarybox">
                            <span><img src="/public/images/newimage/media.jpg"></span>
                            <span><img src="/public/images/newimage/media.jpg"></span>
                            <span><img src="/public/images/newimage/media.jpg"></span>
                            <span><img src="/public/images/newimage/media.jpg"></span>
                            <span><img src="/public/images/newimage/media.jpg"></span>
                        </div>
                        <div class="pr-author">
                            <h5>Author</h5>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </p>
                        </div>
                        <div class="media">
                            <img src="/public/images/newimage/get-started.jpg" class="mr-3" alt="images">
                            <div class="media-body mt-2">
                                <h5 class="mt-0">Aitor Molina <span><i class="fas fa-star mr-1 ml-2"></i> 4.09</span></h5>
                                <h6> 30 Nov</h6>
                            </div>
                        </div>
                        <p>Amazing place!</p>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
                    </div>

                    <div class="add-reviw-and-rate hide" style="display: none">
                        <h4>Add Review & Rate</h4>
                        <div class="pr-reviw mt-5">
                            <span>Quality</span>
                            <span class="qulity-star pr-starbox">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </span>
                            <span><img src="/public/images/newimage/smile.jpg" alt="images"> Excellent</span>
                        </div>

                        <div class="pr-reviw">
                            <span>Location</span>
                            <span class="Location-star pr-starbox">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </span>
                            <span><img src="/public/images/newimage/smile.jpg" alt="images"> Excellent</span>
                        </div>

                        <div class="pr-reviw">
                            <span>Space</span>
                            <span class="Space-star pr-starbox">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </span>
                            <span><img src="/public/images/newimage/smile.jpg" alt="images"> Excellent</span>
                        </div>

                        <div class="pr-reviw">
                            <span>Service</span>
                            <span class="Service-star pr-starbox">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </span>
                            <span><img src="/public/images/newimage/smile.jpg" alt="images"> Excellent</span>
                        </div>

                        <div class="pr-reviw">
                            <span>Price</span>
                            <span class="Price-star pr-starbox">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </span>
                            <span><img src="/public/images/newimage/smile.jpg" alt="images"> Excellent</span>
                        </div>

                        <div class="your-review" id="services-id"> Your review </div>
                    </div>
					
						
	 <form method="post" action="{{route('savereviews')}}">
        @csrf
        <div class="review-dtl-block" id="write_review">
         <div class="clearfix"></div>
         <div class="write-review-form">
            <input type="hidden" name="companyId" value="{{$company['id']}}">
            
            <div class="rvw-overall">
              <input type="hidden" name="rating" id="rating" value="0">
              <div class="rvw-overall-rate rvw-ex-mrgn">
                <span>Rating</span>
                <div id="stars" class="starrr">                
                </div>

              </div>
               
            <div class="review-form-block">
              <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12 rvw-ex-mrgn">
                      <textarea name="review" id="reviewDescription" class="rvw-input @if ($errors->has('review')) field-error @endif" placeholder="Review (atleast 30 words)"></textarea>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <button class="rvw-button" id="saveBtn" type="submit"> SAVE</button>
                    </div>                  
                </div>
            </div>
            </div>
         </div>

        </div>
        </form>
		
                   <!-- <div class="pr-submit-bg">
                        <div class="btn btn-submit"> Submit Review </div>
                    </div>-->

                </div>

            </div>

            <?php
            $sport_activity = [];
            if (isset($serviceData)) {
                foreach ($serviceData as $key => $service) {
                    $sport_activity = $service['sport_activity'];
                }
            }
            $languages = "";
            if (isset($business_spec) && !empty($business_spec)) {
                if (isset($business_spec['languages']) && !empty($business_spec['languages'])) {
                    $languages = $business_spec['languages'];
                }
            }
            ?>
            <div class="col-lg-4">
                <div class="booknow-box ">
                    <h5 style="margin-bottom:10px;"><strong>From $ 100 /person </strong></h5>
                    <div class="row bk-act">
                        <div class="col-md-3 act-fld" style="padding:20px 2px">
                            <select id="pactivity" name="pactivity" class="form-control">
                                <option value="">Activity Offered</option>
                                <option {{ ($sport_activity=='Aerobics')?'selected':''}}>Aerobics</option>
                                <option {{ ($sport_activity=='Archery')?'selected':''}}>Archery</option>
                                <option {{ ($sport_activity=='Badminton')?'selected':''}}>Badminton</option>
                                <option {{ ($sport_activity=='Barre')?'selected':''}}>Barre</option>
                                <option {{ ($sport_activity=='Baseball')?'selected':''}}>Baseball</option>
                                <option {{ ($sport_activity=='Basketball')?'selected':''}}>Basketball</option>
                                <option {{ ($sport_activity=='Beach Vollyball')?'selected':''}}>Beach Vollyball</option>
                                <option {{ ($sport_activity=='Bouldering')?'selected':''}}>Bouldering</option>
                                <option {{ ($sport_activity=='Bungee Jumping')?'selected':''}}>Bungee Jumping</option>
                                <optgroup label="Camps &amp; Clinics">
                                    <option {{ ($sport_activity=='Day Camp')?'selected':''}}>Day Camp</option>
                                    <option {{ ($sport_activity=='Sleep Away')?'selected':''}}>Sleep Away</option>
                                    <option {{ ($sport_activity=='Winter Camp')?'selected':''}}>Winter Camp</option>
                                </optgroup>
                                <option {{ ($sport_activity=='Canoeing')?'selected':''}}>Canoeing</option>
                                <optgroup label="Cycling">
                                    <option {{ ($sport_activity=='Indoor cycling')?'selected':''}}>Indoor cycling</option>
                                </optgroup>
                                <option {{ ($sport_activity=='Dance')?'selected':''}}>Dance</option>
                                <option {{ ($sport_activity=='Diving')?'selected':''}}>Diving</option>
                                <optgroup label="Field Hockey">
                                    <option {{ ($sport_activity=='Ice Hockey')?'selected':''}}>Ice Hockey</option>
                                </optgroup>
                                <option {{ ($sport_activity=='Football')?'selected':''}}>Football</option>
                                <option {{ ($sport_activity=='Golf')?'selected':''}}>Golf</option>
                                <option {{ ($sport_activity=='Gymnastics')?'selected':''}}>Gymnastics</option>
                                <option {{ ($sport_activity=='Hang Gliding')?'selected':''}}>Hang Gliding</option>
                                <option {{ ($sport_activity=='Hiit')?'selected':''}}>Hiit</option>
                                <option {{ ($sport_activity=='Hiking - Backpacking')?'selected':''}}>Hiking - Backpacking</option>
                                <option {{ ($sport_activity=='Horseback Riding')?'selected':''}}>Horseback Riding</option>
                                <option {{ ($sport_activity=='Ice Skating')?'selected':''}}>Ice Skating</option>
                                <option {{ ($sport_activity=='Kayaking')?'selected':''}}>Kayaking</option>
                                <option {{ ($sport_activity=='lacrosse')?'selected':''}}>lacrosse</option>
                                <option {{ ($sport_activity=='Laser Tag')?'selected':''}}>Laser Tag</option>
                                <optgroup label="Martial Arts">
                                    <option {{ ($sport_activity=='Boxing')?'selected':''}}>Boxing</option>
                                    <option {{ ($sport_activity=='Jiu-Jitsu')?'selected':''}}>Jiu-Jitsu</option>
                                    <option {{ ($sport_activity=='Karate')?'selected':''}}>Karate</option>
                                    <option {{ ($sport_activity=='Kick Boxing')?'selected':''}}>Kick Boxing</option>
                                    <option {{ ($sport_activity=='Kung Fu')?'selected':''}}>Kung Fu</option>
                                    <option {{ ($sport_activity=='MMA')?'selected':''}}>MMA</option>
                                    <option {{ ($sport_activity=='Self-Defense')?'selected':''}}>Self-Defense</option>
                                    <option {{ ($sport_activity=='Tai Chi')?'selected':''}}>Tai Chi</option>
                                    <option {{ ($sport_activity=='Wrestling')?'selected':''}}>Wrestling</option>
                                </optgroup>
                                <option {{ ($sport_activity=='Massage Therapy')?'selected':''}}>Massage Therapy</option>
                                <option {{ ($sport_activity=='Nutrition')?'selected':''}}>Nutrition</option>
                                <option {{ ($sport_activity=='Paint Ball')?'selected':''}}>Paint Ball</option>
                                <option {{ ($sport_activity=='Physical Therapy')?'selected':''}}>Physical Therapy</option>
                                <option {{ ($sport_activity=='Pilates')?'selected':''}}>Pilates</option>
                                <option {{ ($sport_activity=='Rafting')?'selected':''}}>Rafting</option>
                                <option {{ ($sport_activity=='Rapelling')?'selected':''}}>Rapelling</option>
                                <option {{ ($sport_activity=='Rock Climbing')?'selected':''}}>Rock Climbing</option>
                                <option {{ ($sport_activity=='Rowing')?'selected':''}}>Rowing</option>
                                <option {{ ($sport_activity=='Running')?'selected':''}}>Running</option>
                                <optgroup label="Sightseeing Tours">
                                    <option {{ ($sport_activity=='Airplane Tour')?'selected':''}}>Airplane Tour</option>
                                    <option {{ ($sport_activity=='ATV Tours')?'selected':''}}>ATV Tours</option>
                                    <option {{ ($sport_activity=='Boat Tours')?'selected':''}}>Boat Tours</option>
                                    <option {{ ($sport_activity=='Bus Tour')?'selected':''}}>Bus Tour</option>
                                    <option {{ ($sport_activity=='Caving Tours')?'selected':''}}>Caving Tours</option>
                                    <option {{ ($sport_activity=='Helicopter Tour')?'selected':''}}>Helicopter Tour</option>
                                </optgroup>
                                <option {{ ($sport_activity=='Sailing')?'selected':''}}>Sailing</option>
                                <option {{ ($sport_activity=='Scuba Diving')?'selected':''}}>Scuba Diving</option>
                                <option {{ ($sport_activity=='Sky diving')?'selected':''}}>Sky diving</option>
                                <option {{ ($sport_activity=='Snow Skiing')?'selected':''}}>Snow Skiing</option>
                                <option {{ ($sport_activity=='Snowboarding')?'selected':''}}>Snowboarding</option>
                                <option {{ ($sport_activity=='Strength')?'selected':''}}>Strength &amp; Conditioning</option>
                                <option {{ ($sport_activity=='Surfing')?'selected':''}}>Surfing</option>
                                <option {{ ($sport_activity=='Swimming')?'selected':''}}>Swimming</option>
                                <option {{ ($sport_activity=='Tennis')?'selected':''}}>Tennis</option>
                                <option {{ ($sport_activity=='Tours')?'selected':''}}>Tours</option>
                                <option {{ ($sport_activity=='Vollyball')?'selected':''}}>Vollyball</option>
                                <option {{ ($sport_activity=='Weight training')?'selected':''}}>Weight training</option>
                                <option {{ ($sport_activity=='Windsurfing')?'selected':''}}>Windsurfing</option>
                                <option {{ ($sport_activity=='Yoga')?'selected':''}}>Yoga</option>
                                <option {{ ($sport_activity=='Zip-Line')?'selected':''}}>Zip-Line</option>
                                <option {{ ($sport_activity=='Zumba')?'selected':''}}>Zumba</option>
                            </select>
                        </div>


                        <div class="col-md-3 act-fld" style="padding:20px 2px">
                            <div class="activityselect3 special-date">
                                <input type="text" name="pdate" id="pdate" placeholder="Date" class="form-control">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <script type="text/javascript">
                                $('#pdate').datepicker();
                            </script>
                        </div>
                        <div class="col-md-3 act-fld" style="padding:20px 2px">
                            <select id="pguest" name="pguest" class="form-control">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                                <option>15</option>
                                <option>20</option>
                                <option>25</option>
                                <option>30</option>
                                <option>35</option>
                                <option>40</option>
                                <option>45</option>
                                <option>50</option>
                                <option>55</option>
                                <option>60</option>
                                <option>65</option>
                                <option>70</option>
                                <option>75</option>
                                <option>80</option>
                                <option>85</option>
                                <option>90</option>
                                <option>95</option>
                                <option>100</option>
                            </select>
                        </div>
                        <div class="col-md-3 act-fld" style="padding:20px 2px">
                            <select id="pduration" name="pduration" class="form-control">
                                <option value="">Duration</option>
                                <option>30 Minutes</option>
                                <option>45 Minutes</option>
                                <option>1 Hours</option>
                                <option>2 Hours</option>
                                <option>3 Hours</option>
                                <option>4 Hours</option>
                                <option>5 Hours</option>
                                <option>6 Hours</option>
                                <option>7 Hours</option>
                                <option>8 Hours</option>
                                <option>9 Hours</option>
                                <option>10 Hours</option>
                                <option>1 Day</option>
                                <option>2 Days</option>
                                <option>3 Days</option>
                                <option>4 Days</option>
                                <option>5 Days</option>
                                <option>6 Days</option>
                                <option>7 Days</option>
                                <option>8 Days</option>
                                <option>9 Days</option>
                                <option>10 Days</option>
                            </select>
                        </div>
                    </div>
                    <br/>
                    <?php
                    $companyid = $companylogo = $companyname = $companyaddress = "";
                    $pay_session = $pay_price = $pay_setduration = $pay_discount = $languages = "";
                    if (isset($serviceData)) {
                        foreach ($serviceData as $key => $service) {
                            $company = $price = [];
                            $serviceId = $service['id'];
                            $sport_activity = $service['sport_activity'];
                            $area = !empty($service['area']) ? $service['area'] : 'Location';
                            if (isset($companyData)) {
                                if (isset($companyData[$service['cid']]) && !empty($companyData[$service['cid']])) {
                                    $company = $companyData[$service['cid']];
                                    $company = isset($company[0]) ? $company[0] : [];
                                    if (!empty($company)) {
                                        $companyid = $company['id'];
                                        $companylogo = $company['logo'];
                                        $companyname = $company['company_name'];
                                        $companyaddress = $company['address'];
                                    }
                                    $price = $servicePrice[$service['cid']];
                                    $price = isset($price[0]) ? $price[0] : [];
                                    if (!empty($price)) {
                                        $pay_session = $price['pay_session'];
                                        $pay_price = $price['pay_price'];
                                        $pay_setduration = $price['pay_setduration'];
                                        $pay_discount = $price['pay_discount'];
                                    }
                                }
                            }
                            ?>
                            <table>
                                <tr valign="top"><td style="font-size:12px;">
                                        <ul>
                                            <h5><span><?= $service['program_name'] ?></span></h5>
                                            <li><?= date('l jS \of F Y') ?></li>
                                            <li><?= $service['mon_shift_start'] ?> - <?= $service['mon_shift_end'] ?></li>
                                            <li>Service: <?= $service['service_type'] ?></li>
                                            <li>Duration: <?= $service['mon_duration'] ?></li>
                                            <li>Activity Location: <?= $service['activity_location'] ?></li>
                                            <li>Spots Left: <s>2/50</s></li>
                                            <li>Great For: <?= $service['activity_for'] ?></li>
                                            <li>Age: <?= $service['age_range'] ?></li>
                                            <li>Language: <?= $languages ?></li>
                                            <li>Skill Level: <?= $service['difficult_level'] ?></li>
                                        </ul>
                                    </td><td style="font-size:12px">
                                        <div>
                                            <label>Choose Price Option</label>
                                            <p>Price Option: <?= $pay_session ?> Session</p>
                                            <p>Participants: <?= $service['group_size'] ?></p>
                                            <p>Total: $<?= $pay_price ?></p>
                                            <form method="post" action="/addtocart">
                                            @csrf
                                            <input type="hidden" name="pid" value="<?= $service["id"]; ?>" size="2" />
                                            <input type="hidden" name="quantity" value="1" class="product-quantity" size="2" />
                                            <input type="hidden" name="price" value="<?=$pay_price?>" class="product-price" size="2" />
                                            <input type="submit" value="Add to Cart" class="btn btn-addtocart" />
                                            </form>
                                            
                                        </div>
                                    </td></tr>
                                <tr><td colspan="2"><hr/></td></tr>
                            </table>
                            <?php
                        }
                    }
                    ?>  
                </div>

                <div class="booknow-box" style="display:none">
                    <h5 style="margin-bottom:10px;"><strong>From $ 100 /person </strong></h5>

                    <div class="modal fade" id="myModal1">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Activities</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-4 ">
                                            <i class="fas fa-angle-down mr-2" style="font-size:20px"></i>Kickboxing
                                        </div>
                                        <div class="col-sm-6">Kickboxing description</div>
                                        <div class="col-sm-2">From $100 / person</div>
                                    </div>
                                </div>
                                <hr/>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-4 ">
                                            <i class="fas fa-angle-down mr-2" style="font-size:20px"></i>Kids events
                                        </div>
                                        <div class="col-sm-6">Kids events</div>
                                        <div class="col-sm-2">From $50 / person</div>
                                    </div>
                                </div>
                                <hr>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-4 ">
                                            <i class="fas fa-angle-down m-2" style="font-size:20px"></i>kids programs
                                        </div>
                                        <div class="col-sm-6">kids programs</div>
                                        <div class="col-sm-2">From $30 / person</div>
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><br/>

                <div class="right-box">
                    <div class="pr-tbl-box">
                    	<?php 
							$mon_shift_start = $mon_shift_end = $tue_shift_start = $tue_shift_end = $wed_shift_start = $wed_shift_end = $thu_shift_start = $thu_shift_end = "";
                            $fri_shift_start = $fri_shift_end = $sat_shift_start = $sat_shift_end = $sun_shift_start = $sun_shift_end = $hours_opt = "";
                            if (isset($business_spec) && !empty($business_spec)) {
                                if (isset($business_spec['hours_opt']) && !empty($business_spec['hours_opt'])) {
                                    $hours_opt = $business_spec['hours_opt'];
                                }
                                if (isset($business_spec['mon_shift_start']) && !empty($business_spec['mon_shift_start'])) {
                                    $mon_shift_start = $business_spec['mon_shift_start'];
                                }
                                if (isset($business_spec['mon_shift_end']) && !empty($business_spec['mon_shift_end'])) {
                                    $mon_shift_end = $business_spec['mon_shift_end'];
                                }
                                if (isset($business_spec['tue_shift_start']) && !empty($business_spec['tue_shift_start'])) {
                                    $tue_shift_start = $business_spec['tue_shift_start'];
                                }
                                if (isset($business_spec['tue_shift_end']) && !empty($business_spec['tue_shift_end'])) {
                                    $tue_shift_end = $business_spec['tue_shift_end'];
                                }
                                if (isset($business_spec['wed_shift_start']) && !empty($business_spec['wed_shift_start'])) {
                                    $wed_shift_start = $business_spec['wed_shift_start'];
                                }
                                if (isset($business_spec['wed_shift_end']) && !empty($business_spec['wed_shift_end'])) {
                                    $wed_shift_end = $business_spec['wed_shift_end'];
                                }
                                if (isset($business_spec['thu_shift_start']) && !empty($business_spec['thu_shift_start'])) {
                                    $thu_shift_start = $business_spec['thu_shift_start'];
                                }
                                if (isset($business_spec['thu_shift_end']) && !empty($business_spec['thu_shift_end'])) {
                                    $thu_shift_end = $business_spec['thu_shift_end'];
                                }
                                if (isset($business_spec['fri_shift_start']) && !empty($business_spec['fri_shift_start'])) {
                                    $fri_shift_start = $business_spec['fri_shift_start'];
                                }
                                if (isset($business_spec['fri_shift_end']) && !empty($business_spec['fri_shift_end'])) {
                                    $fri_shift_end = $business_spec['fri_shift_end'];
                                }
                                if (isset($business_spec['sat_shift_start']) && !empty($business_spec['sat_shift_start'])) {
                                    $sat_shift_start = $business_spec['sat_shift_start'];
                                }
                                if (isset($business_spec['sat_shift_end']) && !empty($business_spec['sat_shift_end'])) {
                                    $sat_shift_end = $business_spec['sat_shift_end'];
                                }
                                if (isset($business_spec['sun_shift_start']) && !empty($business_spec['sun_shift_start'])) {
                                    $sun_shift_start = $business_spec['sun_shift_start'];
                                }
                                if (isset($business_spec['sun_shift_end']) && !empty($business_spec['sun_shift_end'])) {
                                    $sun_shift_end = $business_spec['sun_shift_end'];
                                }
                            }
						
						if( !empty($hours_opt) ) { ?>
                            <div class="pr-table-hd">
                                <?php
                                if($hours_opt == 'Always open') {
                                    echo "<h5>Open 24 Hours</h5>";
                                } elseif($hours_opt == 'Open on selected hours') {
                                    echo "<h5>Hours</h5>";
                                } else {
                                    echo "<h5>".$hours_opt."</h5>";
                                }                                
                                ?>
                            </div>
                       	<?php } ?>
                        <?php if ($hours_opt == 'Open on selected hours') { ?>
                            <div class="pr-table-box">
                                <table class="table opening-day-table">
                                    <tbody>
                                        <tr>
                                            <td style="<?= (date('D') == 'Mon') ? 'color:red' : '' ?>">Monday</td>
                                            <td></td>
                                            <td class="time-table">{{ $mon_shift_start }} - {{ $mon_shift_end }}</td>
                                        </tr>
                                        <tr>
                                            <td style="<?= (date('D') == 'Tue') ? 'color:red' : '' ?>">Tuesday</td>
                                            <td></td>
                                            <td class="time-table">{{ $tue_shift_start }} - {{ $tue_shift_end }}</td>
                                        </tr>
                                        <tr>
                                            <td style="<?= (date('D') == 'Wed') ? 'color:red' : '' ?>">Wednesday</td>
                                            <td></td>
                                            <td class="time-table">{{ $wed_shift_start }} - {{ $wed_shift_end }}</td>
                                        </tr>
                                        <tr>
                                            <td style="<?= (date('D') == 'Thu') ? 'color:red' : '' ?>">Thursday</td>
                                            <td></td>
                                            <td class="time-table">{{ $thu_shift_start }} - {{ $thu_shift_end }}</td>
                                        </tr>
                                        <tr>
                                            <td style="<?= (date('D') == 'Fri') ? 'color:red' : '' ?>">Friday</td>
                                            <td></td>
                                            <td class="time-table">{{ $fri_shift_start }} - {{ $fri_shift_end }}</td>
                                        </tr>
                                        <tr>
                                            <td style="<?= (date('D') == 'Sat') ? 'color:red' : '' ?>">Saturday</td>
                                            <td></td>
                                            <td class="time-table">{{ $sat_shift_start }} - {{ $sat_shift_end }}</td>
                                        </tr>
                                        <tr>
                                            <td style="<?= (date('D') == 'Sun') ? 'color:red' : '' ?>">Sunday</td>
                                            <td></td>
                                            <td class="time-table">{{ $sun_shift_start }} - {{ $sun_shift_end }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="pr-business-info">
                        <div class="row no-gutters">
                            <div class="col-lg-6"><div class="pr-busininfo"> Business Info </div></div>
                            <div class="col-lg-6"><div class="pr-busin-dire"><i class="far fa-hand-point-right mr-2"></i>Get Directions </div></div>
                            <div class="col-lg-12">
                                <iframe src="{{'https://www.google.com/maps/embed/v1/place?key='.Config::get('constants.MAP_KEY').'&q='.$company->latitude.','.$company->longitude}}" width="100%" height="200px" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                            <div class="col-lg-12">
                                <div class="pr-loacation-add">
                                    <ul>
                                    	@if( $company->address!='' )
                                        <li><a href=""><i class="fas fa-map-marker-alt mr-2"></i> {{$company->address}}</a></li>
                                        @endif
                                        @if( $company->contact_number!='' )
                                        <li><a href=""><i class="fas fa-phone-alt mr-2"></i> {{$company->contact_number}} </a></li>
                                        @endif
                                        @if( $company->email!='' )
                                        <li><a href=""><i class="far fa-envelope mr-2"></i> {{$company->email}} </a></li>
                                        @endif
                                        @if( $company->website!='' )
                                        <li><a href=""><i class="fas fa-map-marker-alt mr-2"></i> {{$company->website}} </a></li>
                                    	@endif
                                    </ul>
                                    <h6>Own this business? <span><a href="/claim-your-business"> Claim Now </a></span></h6>
                                    <h6>Want to report this business? <span><a href="#">Report Now</a></span></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pr-verification">
                        <h1> Verification</h1>
                        <div class="veri-icon-new">
                            <span>
                                <a href="{{'tel:'.$company->contact_number}}" title="phone" class="cophone"><i class="fa fa-phone" aria-hidden="true"></i></a>
                            </span>
                            <span >
                                <a href="{{'mailto:'.$company->email}}" title="email"  class="coemail"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                            </span>
                            <span >
                                <a href="{{'http://maps.google.com/?q='.$company->address}}" title="address" class="coaddress" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
                            </span>
                            <span>
                                <?php if (@$approve[0]['status'] == 1) { ?>
                                    <a href="javascript:void();" title="check"><i class="fa fa-check" aria-hidden="true"></i></a>
                                <?php } else { ?>
                                    <a  href="javascript:void();"><i class="fa fa-times" aria-hidden="true"></i> </a>
                                <? } ?>
							</span>
                        </div>
					</div>
                        <div class="static hide">
                            <h5><i class="far fa-bookmark mr-2"></i> Statistic </h5>
                            <div class="static-soc">

                                <ul>
                                    <li><a href="#"><i class="far fa-eye mr-2"></i> 14344 Views </a></li>
                                    <li><a href="#"><i class="far fa-star mr-2"></i> 8 Ratings </a></li>
                                    <li><a href="#"><i class="far fa-heart mr-2"></i> 36 Favorites</a></li>
                                    <li><a href="#"><i class="fas fa-share mr-2"></i> 28 Shares </a></li>
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
    </section>

    <div class="modal fade services-modal" id="ServicesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <!-- <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" > -->
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <h1 class="modal-title">Services</h1>
            <p class="modal-subtitle">Select from one of the service categories offered by <?=$companyname?> below</p>
            <div class="services-type-tab">

              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#individual" aria-controls="home" role="tab" data-toggle="tab">Individual</a></li>
                <li role="presentation"><a href="#classes" aria-controls="profile" role="tab" data-toggle="tab">Classes</a></li>
                <li role="presentation"><a href="#experiences" aria-controls="messages" role="tab" data-toggle="tab">Experiences</a></li>
              </ul>
              
              <!-- Tab panes -->
              <div class="tab-content">
                  
                <div class="row">
                    <p class="week-type">This week</p>
                    <div class="col-sm-12 day-slider">
                      <div class="owl-carousel owl-theme">
                        <?php
                        for($i=0; $i<30; $i++) {
                        ?>
                        <div class="item">
                          <div class="single-item <?=($i==0)?'active':''?>">
                            <p class="day"><?=date("M", strtotime("+$i days"))?></p>
                            <p class="date"><?=date("d-m", strtotime("+$i days"))?></p>
                          </div>
                        </div>
                        <?php } ?>
                    </div>
                    </div>
                    <div class="col-sm-6">
                        <select class="services-filter">
                          <option value="volvo">Any class</option>
                          <option value="saab">a</option>
                          <option value="mercedes">b</option>
                          <option value="audi">c</option>
                        </select>
                      </div>
                </div>
                  
                <div role="tabpanel" class="tab-pane active" id="individual">
                    <div class="row">
                      <div class="col-sm-12 data-table">
                        <table>
                          <tr>
                            <th>Time</th>
                            <th>Class</th>
                            <th>Participant #</th>
                            <th>Location</th>
                            <th>Instructor</th>
                            <th></th>
                          </tr>
                          <?php
                            if (isset($serviceData)) {
                            foreach ($serviceData as $key => $service) {
                            if($service['service_type']=='individual') {
                            ?>
                          <tr>
                            <td><?=$service['mon_shift_start']?> - <?=$service['mon_shift_end']?></td>
                            <td><?=$service['program_name']?></td>
                            <td><?=$service['group_size']?></td>
                            <td><?=$service['activity_location']?></td>
                            <td><?=$service['instructor_habit']?></td>
                            <td> <button>More Details</button> </td>
                          </tr>
                            <?php }}} ?>
                        </table>
                      </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="classes">
                    <div class="row">
                    <div class="col-sm-12 data-table">
                        <table>
                          <tr>
                            <th>Time</th>
                            <th>Class</th>
                            <th>Participant #</th>
                            <th>Location</th>
                            <th>Instructor</th>
                            <th></th>
                          </tr>
                          <?php
                            if (isset($serviceData)) {
                            foreach ($serviceData as $key => $service) {
                            if($service['service_type']=='classes') {
                            ?>
                          <tr>
                            <td><?=$service['mon_shift_start']?> - <?=$service['mon_shift_end']?></td>
                            <td><?=$service['program_name']?></td>
                            <td><?=$service['group_size']?></td>
                            <td><?=$service['activity_location']?></td>
                            <td><?=$service['instructor_habit']?></td>
                            <td> <button>More Details</button> </td>
                          </tr>
                            <?php }}} ?>
                        </table>
                      </div>
                    </div>
                </div>
                
                <div role="tabpanel" class="tab-pane" id="experiences">
                    <div class="row">
                    <div class="col-sm-12 data-table">
                        <table>
                          <tr>
                            <th>Time</th>
                            <th>Class</th>
                            <th>Participant #</th>
                            <th>Location</th>
                            <th>Instructor</th>
                            <th></th>
                          </tr>
                          <?php
                            if (isset($serviceData)) {
                            foreach ($serviceData as $key => $service) {
                            if($service['service_type']=='experience') {
                            ?>
                          <tr>
                            <td><?=$service['mon_shift_start']?> - <?=$service['mon_shift_end']?></td>
                            <td><?=$service['program_name']?></td>
                            <td><?=$service['group_size']?></td>
                            <td><?=$service['activity_location']?></td>
                            <td><?=$service['instructor_habit']?></td>
                            <td> <button>More Details</button> </td>
                          </tr>
                            <?php }}} ?>
                        </table>
                      </div>
                    </div>
                </div>
                
                
              </div>
            
            </div>
        </div>
      </div>
    </div>
  </div>

    @include('layouts.footer')

    <script src="<?php echo Config::get('constants.FRONT_JS'); ?>jquery.1.11.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="/public/js/owl.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).on('click', '.reviewbtn', function () {
            //alert("hii");
        });
    </script>
    <script src="<?php echo Config::get('constants.FRONT_JS'); ?>ratings.js"></script>

    <script>
        $(document).ready(function () {
            $(".btn-addtocart").click(function () {
                $(".mykickboxing").modal('hide');
            });

            window.onload = gallery;
            //when we load your gallery in browser then gallery function is loaded
            function gallery() {
                // gallery is the name of function
                var allimages = document.images;
                //now we create a variable allimages
                //and we store all images in this allimages variable
                for (var i = 0; i < allimages.length; i++) {
                    //now we create a for loop
                    //if(allimages[i].id.indexOf("small") > -1){
                    allimages[i].onclick = imgChanger;
                    //in above line we are adding a listener to all the thumbs stored inside the allimages array on onclick event.
                    //}
                }
            }
            //declaring the imgChanger function
            function imgChanger() {
                //changing the src attribute value of the large image.
                document.getElementById('myPicture').src = this.id;
            }

            $('.delPhoto').click(function () {
                var txt;
                var r = confirm("Are you sure, you want to delete?");
                if (r == true) {
                    $.ajax({
                        url: "{{url('/delete-image-gallery?delId=')}}" + $(this).attr('delId'),
                        type: 'get',
                        beforeSend: function () {
                            $('.loader').show();
                        },
                        complete: function () {
                            $('.loader').hide();
                        },
                        success: function (response) {
                            //if(response.status ==200){
                            window.location.reload()
                            $(this).parent().remove();
                            //}
                        }
                    });
                }
            });

            /*
             $('body').click(function () {
             $('.act-name').hide();
             return false;
             });
             
             $('#actdate').click(function () {
             $('#actdatepicker').show();
             return false;
             });
             
             $('.del-cal').click(function () {
             $('#actdatepicker').hide();
             return false;
             });
             
             $('body').click(function () {
             $('.act-name1').hide();
             return false;
             });
             
             $('.act-fld-name').click(function () {
             $('.act-name').show();
             return false;
             });
             
             $('.act-fld-name1').click(function () {
             $('.act-name1').show();
             return false;
             });
             */
    <?php for ($i = 1; $i < 20; $i++) { ?>
        $('#act-val<?= $i ?>').click(function () {
            var act_name = $('#act-val<?= $i ?>').text();
            $(".act_name").val(act_name);
        });
    <?php } ?>

    <?php for ($i = 1; $i < 5; $i++) { ?>
        $('#dur-val<?= $i ?>').click(function () {
            var act_name = $('#dur-val<?= $i ?>').text();
            $(".dur_name").val(act_name);
        });
    <?php } ?>

        });

    </script>
    <script>
        function increaseValue() {
            var value = parseInt(document.getElementById('number').value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            document.getElementById('number').value = value;
        }

        function decreaseValue() {
            var value = parseInt(document.getElementById('number').value, 10);
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;
            document.getElementById('number').value = value;
        }
    </script>
    <script>

        $(document).on('click', '.number-spinner button', function () {
            var btn = $(this),
            oldValue = btn.closest('.number-spinner').find('input').val().trim(),
            newVal = 0;
            newVal = (btn.attr('data-dir') === 'up') ? parseInt(oldValue) + 1 : (oldValue > 1) ? parseInt(oldValue) - 1 : 0;
            btn.closest('.number-spinner').find('input').val(newVal);
        });

        $(document).ready(function () {
            var str = window.location.href;
            if (str.indexOf('pcompany') !== -1) {
                $('#imagedropbox').show();
                $('#mycamera').show();
                $('#delimgbox').show();
            } else if (str.indexOf('directhire/viewprofile') !== -1) {
                $('#bookCompany').show();
            } else {
                console.log("outer block");
            }

            /*
             var bigimage = $("#big");
             var thumbs = $("#thumbs");
             var totalslides = 10;
             var syncedSecondary = true;
             
             bigimage
             .owlCarousel({
             items: 1,
             slideSpeed: 2000,
             nav: true,
             autoplay: true,
             dots: false,
             loop: true,
             responsiveRefreshRate: 200,
             navText: [
             '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
             '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
             ]
             })
             .on("changed.owl.carousel", syncPosition);
             
             thumbs
             .on("initialized.owl.carousel", function () {
             thumbs
             .find(".owl-item")
             .eq(0)
             .addClass("current");
             })
             .owlCarousel({
             items: 6,
             dots: true,
             nav: true,
             navText: [
             '<i class="fa fa-arrow-left" aria-hidden="true"></i>',
             '<i class="fa fa-arrow-right" aria-hidden="true"></i>'
             ],
             smartSpeed: 200,
             slideSpeed: 500,
             slideBy: 4,
             responsiveRefreshRate: 100
             })
             .on("changed.owl.carousel", syncPosition2);
             */
            function syncPosition(el) {
                //if loop is set to false, then you have to uncomment the next line
                //var current = el.item.index;
                //to disable loop, comment this block
                var count = el.item.count - 1;
                var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

                if (current < 0) {
                    current = count;
                }
                if (current > count) {
                    current = 0;
                }
                //to this
                thumbs
                        .find(".owl-item")
                        .removeClass("current")
                        .eq(current)
                        .addClass("current");
                var onscreen = thumbs.find(".owl-item.active").length - 1;
                var start = thumbs
                        .find(".owl-item.active")
                        .first()
                        .index();
                var end = thumbs
                        .find(".owl-item.active")
                        .last()
                        .index();

                if (current > end) {
                    thumbs.data("owl.carousel").to(current, 100, true);
                }
                if (current < start) {
                    thumbs.data("owl.carousel").to(current - onscreen, 100, true);
                }
            }

            function syncPosition2(el) {
                if (syncedSecondary) {
                    var number = el.item.index;
                    bigimage.data("owl.carousel").to(number, 100, true);
                }
            }

            thumbs.on("click", ".owl-item", function (e) {
                e.preventDefault();
                var number = $(this).index();
                console.log("number")
                console.log(number)
                console.log("number")
                bigimage.data("owl.carousel").to(number, 300, true);
            });

            var sync1 = $("#sync1");

            function syncPosition(el) {
                //if you set loop to false, you have to restore this next line
                //var current = el.item.index;
                //if you disable loop you have to comment this block
                var count = el.item.count - 1;
                var current = Math.round(el.item.index - (el.item.count / 2) - .5);

                if (current < 0) {
                    current = count;
                }
                if (current > count) {
                    current = 0;
                }
                //end block
            }

            $('.delimg').click(function () {
                $.ajax({
                    url: "{{url('/delete-image-company?myindex=')}}" + $(this).attr('myindex') + '&company_id=' + $(this).attr('company_id'),
                    type: 'get',
                    beforeSend: function () {
                        $('.loader').show();
                    },
                    complete: function () {
                        $('.loader').hide();
                    },
                    success: function (response) {
                        //if(response.status ==200){
                        window.location.reload()
                        $(this).parent().remove();
                        //}
                    }
                })
            })

        var images = [<?php echo '"' . @implode('","', $company->company_images) . '"' ?>];
        var imageUrl = images.length != 0 && images[0] != "" ? "<?php echo Config::get('constants.USER_IMAGE_THUMB'); ?>" : "{{url('/public/images')}}/"
        var logo = (images.length != 0 && images[0] != "") ? images[0] : "claim-bg.jpeg"
        imageUrl = "https://fitnessity.co/" + imageUrl + logo
        if (images.length != 0 && images[0] != "") {
            setTimeout(function () {
                $(".banner img").attr("src", imageUrl)
            }, 20)
        } else {

        }

        $('#imagedropbox').click(function () {
            $('#Modal').modal('show');
        });

        var form = document.querySelector('form');

        // edit profile picture
        $('#frmeditProfile_side').submit(function (e) {
            e.preventDefault();
            $('#frmeditProfile_side').validate({
                rules: {
                    profile_pic: {
                        required: true,
                        accept: "image/*"
                    },
                },
                messages: {
                    profile_pic: {
                        required: "Upload a Company logo ",
                        accept: "Please upload an image"
                    },
                }
            });

            if (!$('#frmeditProfile_side').valid()) {
                return false;
            }

            var inputData = new FormData($(this)[0]);
            inputData.append('company_id', "{{$company->id}}")
            $.ajax({
                url: '/profile/editCompanyPicture',
                type: 'POST',
                dataType: 'json',
                data: inputData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    $('#submit_profilepic').prop('disabled', true);
                },
                complete: function () {
                    $('#submit_profilepic').prop('disabled', false);
                },
                success: function (response) {
                    if (response.type == 'success') {
                        window.location.reload()
                        // $("#display_user_profile_pic").attr("src", response.returndata.profile_pic);
                        // $("#display_user_profile_pic_view_profile").attr("src", response.returndata.profile_pic);
                        // $(".display_user_profile_pic_view_profile").attr("src", response.returndata.profile_pic);
                        // $(".display_user_profile_pic_view_profile1").each(function(){
                        $('.comp-mark img').attr("src", response.returndata.profile_pic);
                        // });

                        $('#editServicePic').modal('hide');
                    } else {
                        showSystemMessages('#systemMessage', response.type, response.msg);
                    }
                }
            });
        });
    });

</script>

<!-- Favourite , follow, following-->
<script>
    // Favourite script
    $(".fav-fun").click(function () {
        var _token = $("input[name='_token']").val();
        var cid = '{{request()->company_id}}';
        $.ajax({
            type: 'POST',
            url: '{{route("favourite")}}',
            data: {
                _token: _token,
                cid: cid
            },
            success: function (data) {
                window.location.reload();
            }
        });
    });


    // Follow script
    $(".follow-fun").click(function () {
        var _token = $("input[name='_token']").val();
        var cid = '{{request()->company_id}}';
        $.ajax({
            type: 'POST',
            url: '{{route("follow_company")}}',
            data: {
                _token: _token,
                cid: cid
            },
            success: function (data) {
                //window.location.reload();
            }
        });
    });    
</script>
<script>
    $('.day-slider .owl-carousel').owlCarousel({
      loop:false,
      nav:true,
      items:7,
      slideBy: 7,
      navText: ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
    });
  </script>
  <script type="text/javascript">
       jQuery(document).ready(function()
    {
        $("#frmReview").submit(function(e) {

          var msg = '';
          var returnVal;
          returnVal = true;
          if(jQuery("#reviewDescription").val().length < 30 )
          {
            msg += '<br>Reveiw at least 30 words required';
            returnVal = false;
          }
          if(!returnVal) {
              showSystemMessages('#systemMessage_review', 'danger', msg);
              return false;
          }
          // var inputData = new FormData($(this)[0]);
          var formData = $("#frmReview").serialize();
          $.ajax({
              url:'/reviews/save',
              type:'POST',
              dataType: 'json',
              data:formData,
              beforeSend: function () {
                $('#saveBtn').attr('disabled', true);
                $("#frmReview").css('opacity', '0.5');
                // showSystemMessages('#systemMessage_review', 'info', 'Please wait while we save your quote.');
              },
              complete: function () {
                $('#saveBtn').attr('disabled', false);
                $("#frmReview").css('opacity', '1');
              },
              success: function (response) {
                  showSystemMessages('#systemMessage_review', response.type, response.msg);
                  setTimeout(
                  function() 
                  {
                    location.reload();
                  }, 1000);                
              }
          });
      });
});
  </script>
@endsection