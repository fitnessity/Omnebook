@inject('request', 'Illuminate\Http\Request')
@extends('layouts.header')
<head>
    <title> Fitnessity </title>
    <meta charset="utf-8">
    <meta name="description" content="Looking for a place to grow your career. There are many good reasons to consider the great insurance jobs available through Legends United.">
    <meta name="keywords" content="Great Insurance Jobs">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" type="text/css" href="{{url('/public/css/stylenew.css')}}">
    <!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" type="text/css" href="{{ url('public/css/pixelarity.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('public/css/profile.css') }}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
    <link href="{{ url('public/emoji/lib/css/emoji.css') }}" rel="stylesheet">
    <?php /*?><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><?php */?>
    <link rel="stylesheet" type="text/css" href="{{ url('public/css/comment-icons.css') }}">
    <link rel="stylesheet" href="{{ url('public/css/jquery-ui.css') }}">
   <!--  <link rel="stylesheet" href="{{ url('public/css/date-range-picker.css') }}"> -->
    <link href="{{ url('public/css/frontend/userprofile.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ url('public/css/frontend/jquery.fancybox.min.css') }}">
</head>

@section('content')

<?php
use App\CompanyInformation;
use App\Review; 
use App\User; 
use App\PostLike;
use App\PostReport;
use App\PostComment;
use App\ProfileSave;
use App\ProfilePost;
use App\UserFollow;
use App\PostCommentLike;
use App\ProfilePostViews;
?>

<?php
$loggedinUser = User::where('username',request()->user_name)->first();
$customerName = $loggedinUser->firstname . ' ' . $loggedinUser->lastname;
$profilePicture = $loggedinUser->profile_pic;
    
$totFollowing = UserFollow::where('user_id', $loggedinUser->id)->count();
$totFollowers = UserFollow::where('follower_id', $loggedinUser->id)->count();
                                    
$loggedinUserorignal = Auth::user();

$coverPicture = $loggedinUser->cover_photo;
if (isset($_GET['cover']) && $_GET['cover'] == 1) {
    ?>
    <script type="text/javascript">
        alert("Cover photo updated successfully.");
        var uri = window.location.href.toString();
        if (uri.indexOf("?") > 0) {
            var clean_uri = uri.substring(0, uri.indexOf("?"));
            window.history.replaceState({}, document.title, clean_uri);
        }
    </script>
    <?php
}
?>
<style>
.removepost {
  height: auto !important;
}
.removepost{
	padding: 0px !important;
}


</style>

<div class="banner banner-fs bannerstyle">

    <?php /* print_r($viewgallery);exit(); */ 
        $totalcount = count($viewgallery);
        $rem = 4 -$totalcount;
        /*echo $totalcount;
        echo $rem;*/
    ?>
    @if (!empty($viewgallery))
        @foreach (array_slice($viewgallery, 0, 4) as $pic)
            <div class="business-slider">
              <!--   <img src="/public/uploads/gallery/<?= $loggedinUser->id ?>/thumb/<?= $pic['name'] ?>" /> -->
              <img src="{{Storage::url($pic['name'])}}" />
               <!--  <i class="fa fa-pen editpic editpic-fs"  id="{{$pic['id']}}"  imgname="{{$pic['name']}}" data-toggle="modal" data-target="#uploadgalaryPic"></i> -->
            </div>
        @endforeach
    @endif
    @for($i=0 ; $i<$rem ; $i++)
    <div class="business-slider">
        <img src="/public/images/newimage/uploadphoto.jpg" alt="images" class="img-fluid">
        <!-- <i class="fa fa-pen editpic editpic-fs" id="0" imgname="10.jpg" data-toggle="modal" data-target="#uploadCoverPic"></i> -->
    </div>
    @endfor
</div>
<!-- <div class="banner banner-fs">
    <a href="javascript:void(0);"> -->
        <?php        
        if (!empty($viewgallery)) {
            $totalwid = count($viewgallery);
            $width = 100/$totalwid;
            ?>
            <!-- <div class="4img-slider">
                <div class="con-width"> -->
                <?php foreach (array_slice($viewgallery, 0, 4) as $pic) { ?>
                    <!-- <div class="one" style="width:{{$width}}%">
                        <img style="padding:0; margin:0;"  width="{{$width}}%" height="300" src="/public/uploads/gallery/<?= $loggedinUser->id ?>/thumb/<?= $pic['name'] ?>" />
                    </div>   -->  
                <?php } ?>
                <!--  </div>
            </div> -->
        <?php /*} else {*/ ?> 
            <!-- <a href="javascript:void(0);" data-toggle="modal" data-target="#uploadCoverPic">
                @if(!empty($coverPicture))
                <img src="{{ url('/public/uploads/cover-photo/'.$UserProfileDetail['cover_photo']) }}" alt="images" class="img-fluid">
                @else
                <img src="/public/images/newimage/banner.jpg" alt="images" class="img-fluid">
                @endif
            </a> -->
        <?php } ?>
    <!-- </a>
</div> -->
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session()->has('success'))
    <div class="alert alert-success fade in alert-dismissible show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:23px">
            <span aria-hidden="true" style="font-size:20px">×</span>
        </button> {{ session()->get('success') }}
    </div>
@elseif(session()->has('error'))
    <div class="alert alert-danger fade in alert-dismissible show">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="line-height:23px">
            <span aria-hidden="true" style="font-size:20px">×</span>
        </button> {{ session()->get('error') }}
    </div>
@endif
<section class="banner-below-sec">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-2 col-md-3">
                <div class="comp-mark">
                    @if(File::exists(public_path("/uploads/profile_pic/thumb/".$UserProfileDetail['profile_pic'])))
                    <img src="{{ url('/public/uploads/profile_pic/thumb/'.$UserProfileDetail['profile_pic']) }}" alt="images" class="img-fluid">
                    @else
                        <?php
                        $pf=substr($loggedinUser->firstname, 0, 1).substr($loggedinUser->lastname, 0, 1);
                        echo '<div class="profile-pic-text"><p>'.$pf.'</p></div>'; ?>
                    @endif
                    
                </div>
                <!-- Modal -->
                <div class="modal fade" id="get_started" role="dialog">
                    {!! Form::open(array('url'=>url('/profile/inquirySubmit'),'method'=>'POST','class'=>'get_started')) !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-body login-pad">
                                <div class="pop-title employe-title"><h3>Inquiry Box </h3></div> 
                                <button type="button" class="close modal-close" data-dismiss="modal">
                                    <img src="/public/images/close.jpg" height="70" width="34">
                                </button>                              
                                <div class="signup">
                                    <div class="emplouyee-form">
                                        <input class="" type="text" name="name" id="name" class="form-control" placeholder="Name">
                                        <span class="error" id="err_name_sign"></span>

                                        <input class="" type="text" name="email" id="email" class="form-control" placeholder="Email">
                                        <span class="error" id="err_email_sign"></span>

                                        <input class="" type="text" name="message" id="message" class="form-control" placeholder="Message">
                                        <span class="error" id="err_message_sign"></span>
                                     
                                        <button type="button" class="inquiryfrm">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- Modal Ends -->
               
            </div>

            <div class="col-lg-6 col-md-7">
                <div class="bnr-information">
                    <h2 style="text-transform: capitalize;">{{$customerName}}</h2>
                    <h6>@if(isset($UserProfileDetail['quick_intro'])) {!! nl2br(@$UserProfileDetail['quick_intro']) !!} @else  @endif</h6>
                    <div class="url-copy">  
                        <div>
                            <p>
                                <a class="colorgrey" href="<?php echo config('app.url'); ?>/userprofile/{{$loggedinUser->username}}">
                                    <?php echo config('app.url'); ?>/userprofile/{{$loggedinUser->username}} </a> </p>
                            <!-- <button onclick="myFunction()" style="background: white;border: none; margin-left: 10px;">Copy URL</button>-->
                       </div>
                       
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-2 top-1">
                <div class="reatingbox"><!-- <h5><i class="fa fa-star rating-pro"></i><span>5.0 </span>(100) </h5> --> <div>
                
                <ul class="profile-controls" id="profileControls">
                    <?php
                        $userfollowing = UserFollow::where('user_id',$loggedinUserorignal->id)->where('follower_id',$loggedinUser->id)->first(); ?>
                    <!-- <li><div class=""><i class="fa fa-star"></i></div></li>
                    <li><a href="#" title="Add friend" data-toggle="tooltip"><i class="fa fa-user-plus"></i></a></li>-->
                    <?php if($userfollowing) { ?>
                        <li> <p class="following-tag"> Following </p> </li>
                    <?php } else { ?>    
                    <li><a href="javascript:void(0);" class="followProfile" title="Follow" profileid="{{$loggedinUser->id}}" userid="{{$loggedinUserorignal->id}}" ><i class="fa fa-star"></i></a></li>
                    <?php } ?>
                    <!--<li><a class="send-mesg" href="#" title="Send Message" data-toggle="tooltip"><i class="fa fa-comment"></i></a></li>-->
                    <?php /*?><li class="shareicons ">
                        <!--<i class="fa fa-share-alt"></i>Share-->
                        <div class="middle-1">
                          <div class="sm-container">
                            <span class="show-btn">
                                <i class="fa fa-share-alt"></i>
                                <label>Share</label>
                            </span>
                            <div class="sm-menu">
                              <a href="#"><i class="fab fa-facebook-f fa-color"></i></a>
                              <a href="#"><i class="fab fa-twitter fa-color"></i></a>
                            </div>
                          </div>
                        </div>  
                    </li><?php */?>
                </ul>
                <!--<a><img src="/public/images/newimage/share.png" alt="icon">Share</a>-->
            </div>
            <div class="social">
            </div>
        </div>

    </div>
</section>

<!-- preview Modal -->
<div class="modal" id="previewmodel" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body login-pad">  
                <div class="pop-title employe-title"><h3>Preview Post</h3></div>
                <button type="button" class="close modal-close" data-dismiss="modal">
                    <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                </button>
                <div>                  
                    <div class="loadMore">
                        <!-- foreach -->
                        <div class="central-meta item">
                                <div class="user-post">
                                    <div class="friend-info">
                                        <figure><img src="/public/images/newimage/nearly1.jpg" alt=""></figure>
                                        <div class="friend-name">
                                            <ins><a href="#" title="">{{ucfirst($loggedinUser->firstname)}} {{ucfirst($loggedinUser->lastname)}}</a> Post Album</ins>
                                        </div>
                                        <div class="post-meta">
                                           <p class="postText"></p>
                                            <figure>
                                                <div class="img-bunch" id="add_image">
                                                    <div class="row" >
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <figure>
                                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                </a>
                                                            </figure>
                                                            <figure>
                                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                </a>
                                                            </figure>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <figure>
                                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                </a>
                                                            </figure>
                                                            <figure>
                                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                </a>
                                                            </figure>
                                                            <figure>
                                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                </a>
                                                                <div class="more-photos"><span>+12</span></div>
                                                            </figure>
                                                        </div>
                                                    </div> <!-- row -->
                                                </div><!-- img-bunch -->
                                            </figure>  
                                        </div>
                                    </div><!-- friend-info -->
                                </div>
                            </div>
                        <!-- end foreach -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- edit Modal -->
<div class="modal" id="edit_post" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body login-pad">  
                <div class="pop-title employe-title"><h3>Edit Post</h3></div>
                <button type="button" class="close modal-close" data-dismiss="modal">
                    <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                </button>
                <div>                  
                    <div class="loadMore">
                        <!-- foreach -->
                        <div class="central-meta item">
                                <div class="user-post">
                                    <div class="friend-info">
                                        <form method="post" action="{{route('profilePostupdate')}}" enctype="multipart/form-data" >
                                            @csrf

                                            <figure><img src="/public/images/newimage/nearly1.jpg" alt=""></figure>
                                            <div class="friend-name">
                                                <ins><a href="#" title="">{{ucfirst($loggedinUser->firstname)}} {{ucfirst($loggedinUser->lastname)}}</a> Post Album</ins>
                                            </div>
                                            <input type="text" class="post_textemoji" id="post_textemoji"  name="post_text_upd" data-emojiable="true" >     
                                            <div class="post-meta" id="edit_image"></div>
                                            <button class="post-btn " type="submit" data-ripple="">Update Post</button>
                                        </form>
                                    </div>
                                </div>
                            </div> <!-- central-meta -->
                        <!-- end foreach -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section class="desc-sec">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <div class="widget">            
                    <h4 class="widget-title">Profile Intro</h4>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="wid-sp">
                                <h4 class="widget-dt">Details</h4>
                            </div>
                            &nbsp;
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="wid-sp">
                                <b> Username: </b>
                                @if(isset($UserProfileDetail['username'])) {{ "@".$UserProfileDetail['username']}}
                                @else - @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="wid-sp">
                                <div class="pro-intro">
                                    <b> Member Since: </b> &nbsp; <p> <?php echo date('m/y', strtotime($UserProfileDetail['created_at']) ); ?></p>
                                </div>
                                <div class="pro-intro">
                                    <b> Gender: </b> <p> &nbsp; {{ $UserProfileDetail['gender'] }}</p>
                                </div>
                                @if( $UserProfileDetail['dobstatus'] == 0)
                                <div class="pro-intro">
                                    <b> Birthday:  </b> &nbsp; <p> <?php echo date('F d, Y', strtotime($UserProfileDetail['birthdate']) ); ?></p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <?php 
                                $country = '';
                                if($UserProfileDetail['country'] == 'usa' || $UserProfileDetail['country']  == 'USA' || $UserProfileDetail['country'] == 'United States'){
                                $country = 'United States'; 
                            } ?>
                            @if($UserProfileDetail['country'] != '')
                            <div class="wid-sp img-bot">
                                <img src="https://upload.wikimedia.org/wikipedia/en/a/a4/Flag_of_the_United_States.svg" alt="images" class="img-fluid" width="25" height="15">
                                {{ $country }}
                            </div>
                            @endif
                            <div class="border-wid-sp"><div class="border-wid"></div></div>
                            @if( $UserProfileDetail['favorit_activity'] != '')
                            <div class="wid-sp">
                                <h4 class="widget-dt">Favorite Activities To Do</h4> &nbsp;
                                <p>{{ $UserProfileDetail['favorit_activity'] }} </p>
                            </div>
                            <div class="border-wid-sp"><div class="border-wid"></div></div>
                            @endif
                            <?php /*?><div class="wid-sp">
                                <h4 class="widget-dt">Favorite Workout Music</h4> &nbsp;
                                <div class="spoti-dis">
                                    <img src="/images/newimage/spotify.png" alt="images" class="img-fluid" width="20" height="12">
                                    <p>Spotify Play List</p>
                                    <label>View List</label>
                                </div>
                            </div><?php */?>
                        </div>
                    </div>  
                </div>  
                <!-- calender-->
                <?php /*?>
                <div class="widget-calender">
                    <h4 class="widget-title">BOOKING REMINDER
                        <a class="post-btn-booking text-center" href="{{ Config::get('constants.SITE_URL') }}/personal-profile/booking-info">View Bookings</a>    
                    </h4>
                    <div class="calender-sp"><div id="myDate" name="myDate"></div></div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item active">
                            <a class="nav-link" data-toggle="tab" href="#tabs-11" role="tab">Todays Activities: 3</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-22" role="tab">Upcoming Activities: 10</a>
                        </li>
                    </ul>
                    
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-11" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-lg-6 ">
                                    <div class="calendar-tab-content">
                                        <h5>Kickboxing For Adults</h5>
                                        <p>Valor Mixed Martial Arts</p><p>New York, United States</p>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <div class="calendar-tab-content-right">
                                        <h5>Nov. 11,2021</h5>
                                        <p>9:00am - 10:00am(1h)</p><p>Spots(4/20)<a href="#">Invite Friend</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="calendar-content-border"></div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="calendar-tab-content">
                                            <h5>Mini Ninjas MArtial Arts</h5>
                                            <p>Adams Fitness Center</p><p>New York, United States</p>
                                        </div>
                                    </div>                              
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="calendar-tab-content-right">
                                            <h5>Nov. 11,2021</h5>
                                            <p>11:00am - 11:30am(30m)</p><p>Spots(10/20)<a href="#">Invite Friend</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="calendar-content-border"></div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="calendar-tab-content">
                                            <h5>Vinyasa Yoga</h5>
                                            <p>Yoga Works</p><p>New York, United States</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6">
                                        <div class="calendar-tab-content-right">
                                            <h5>Nov. 11,2021</h5>
                                            <p>2:00pm - 3:00am(1h)</p><p>Spots(15/20)<a href="#">Invite Friend</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-22" role="tabpanel">
                                <p>Second Panel</p>
                            </div>
                        </div>
                    </div><!-- calender end --><?php */?>
            
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="box-red">
                                <h1 class="red-box-font">VERIFICATION</h1>
                                <div class="veri-icon-new-1">
                                    <span>
                                        <a href="{{'tel:'.$UserProfileDetail['phone_number']}}" title="phone" class="cophone"><i class="fa fa-phone" aria-hidden="true"></i></a>
                                    </span>
                                    <span>
                                        <a href="{{'mailto:'.$UserProfileDetail['email']}}" title="email"  class="coemail"><i class="fa fa-envelope" aria-hidden="true"></i></a>
                                    </span>
                                    <?php /*?> <span>
                                        <a href="#" title="link"  class=""><i class="fa fa-link" aria-hidden="true"></i></a>
                                    </span>  
                                     <span>
                                        <a href="{{'http://maps.google.com/?q='.$UserProfileDetail['address']}}" title="address" class="coaddress" target="_blank"><i class="fa fa-map-marker" aria-hidden="true"></i></a>
                                    </span> <?php */?>
                                </div>
                                <!--<img src="/public/img/verification.png" />-->
                            </div>
                        </div>
                    </div>
            
                    <?php /*?><div class="widget">
                        <h4 class="widget-title">User Badges <a class="see-all" href="#" title="">See All</a></h4>
                        <ul class="badgez-widget">
                            <li>
                                <a href="#" title="Male User" data-toggle="tooltip">
                                <img src="/images/badges/badge2.png" alt="fitnessity"></a>
                            </li>
                            <li>
                                <a href="#" title="Earned $5000+" data-toggle="tooltip">
                                <img src="/images/badges/badge12.png" alt="fitnessity"></a>
                            </li>
                            <li>
                                <a href="#" title="10 Years old User" data-toggle="tooltip">
                                <img src="/images/badges/year10.png" alt="fitnessity"></a>
                            </li>
                            <li>
                                <a href="#" title="Page Admin" data-toggle="tooltip">
                                <img src="/images/badges/badge1.png" alt="fitnessity"></a>
                            </li>
                            <li>
                                <a href="#" title="100+ Refferal" data-toggle="tooltip">
                                <img src="/images/badges/badge8.png" alt="fitnessity"></a>
                            </li>
                            <li>
                                <a href="#" title="Tranding Posts" data-toggle="tooltip">
                                <img src="/images/badges/badge21.png" alt="fitnessity"></a>
                            </li>
                            <li>
                                <a href="#" title="1000+ Subscribers" data-toggle="tooltip">
                                <img src="/images/badges/badge3.png" alt="fitnessity"></a>
                            </li>
                            <li>
                                <a href="#" title="fitness Shirt winner" data-toggle="tooltip">
                                <img src="/images/badges/badge20.png" alt="fitnessity"></a>
                            </li>
                            <li>
                                <a href="#" title="500+ Followers" data-toggle="tooltip">
                                <img src="/images/badges/badge10.png" alt="fitnessity"></a>
                            </li>
                        </ul>
                    </div><?php */?>
                </div>
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="profile-section">
                                <div class="row flex-column-reverse flex-md-row">
                                    <div class="col-sm-12 col-md-12 col-lg-9">
                                        <ul class="nav nav-tabs" role="">
                                            <li class="active">
                                                <a class="nav-link" data-toggle="tab" href="#timeline" role="tab">Timeline</a>
                                            </li>
                                            <li>
                                                <a class="nav-link" data-toggle="tab" href="#about" role="tab">About</a>
                                            </li>
                                            <li>
                                                <a class="nav-link" data-toggle="tab" href="#photos" role="tab">Photos</a>
                                            </li>
                                            <li>
                                                <a class="nav-link" data-toggle="tab" href="#videos" role="tab">Videos</a>
                                            </li>
                                            
                                            <?php /*?>
                                            <li>
                                                <a class="nav-link" href="#about" role="tab">About</a>
                                            </li>
                                            <li>
                                                <a class="nav-link" href="#photos" role="tab">Photos</a>
                                            </li>
                                            <li>
                                                <a class="nav-link" href="#videos" role="tab">Videos</a>
                                            </li>
                                            <li>
                                                <a class="nav-link" href="#timeline">Timeline</a>
                                            </li>
                                            
                                            <li>
                                                <a class="nav-link" data-toggle="tab" href="#tabs-5" role="tab">Saved</a>
                                            </li><?php */?>
                                        </ul>
                                    </div>
                                    <div class="col-sm-12 col-md-12 col-lg-3 followdiv">
                                   
                                        <ol class="folw-detail">
                                            <!-- <li><span>Posts</span><ins>101</ins></li> -->
                                            <li><span>Followers</span><ins><?php echo $totFollowers; ?></ins></li>
                                            <li><span>Following</span><ins><?php echo $totFollowing; ?></ins></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-8 col-lg-8">
                            <div class="tab-content">
                                <div class="tab-pane active" id="timeline" role="tabpanel">
                                    <?php /*?><div class="central-meta postbox">
                                        <form method="post" action="{{route('profilePost')}}" enctype="multipart/form-data" id="profilepostfrm">
                                            @csrf
                                            <span class="create-post">Post Your Experiences</span>
                                            <div class="post-img figure">
                                                <?php if(File::exists(public_path("/uploads/profile_pic/thumb/".$loggedinUser->profile_pic ))){ ?>
                                                <img src="{{ url('/public/uploads/profile_pic/thumb/'.$loggedinUser->profile_pic) }}" alt="Fitnessity">
                                                <?php }else{ 
                                                $pf=substr($loggedinUser->firstname, 0, 1).substr($loggedinUser->lastname, 0, 1);
                                                    echo '<div class="admin-img-text"><p>'.$pf.'</p></div>';
                                                ?>
                                                
                                                <?php } ?>
                                            </div>
                                            <div class="newpst-input">
                                                <textarea rows="4" id="post_text" name="post_text" placeholder="Share some of your experiences with activites you booked!" data-emojiable="true" ></textarea>
                                                <span class="error" id="err_post_sign"></span>
                                            </div>
                                            <div class="postImage"></div>
                                            <div class="attachments">
                                                <ul>
                                                    <li>
                                                        <span class="add-loc"><i class="fa fa-location-dot"></i></span>
                                                    </li>
                                                    <li>
                                                        <label for="music_post"><i class="fa fa-music"></i> </label>
                                                        <input id="music_post" name="music_post" type="file"/>
                                                    </li>
                                                    <li>
                                                        <label for="image_post"><i class="fa fa-image"></i></label>
                                                        <input id="image_post" type="file" name="image_post[]" multiple />
                                                        <span class="error" id="err_image_sign"></span>
                                                    </li>
                                                    <li>
                                                        <label for="video"><i class="fas fa-video"></i></label>
                                                        <input id="video" name="video" type="file"/>
                                                    </li>
                                                    <li class="checkwebcam">
                                                        <label for="file-input" onclick="return showWebCam()" id="webCamButton"><i class="fa fa-camera"></i></label>
                                                        <!-- <input id="file-input" type="file" onclick="return showWebCam()" id="webCamButton"/> -->
                                                    </li>
                                                    <li class="emojili"><div class="emojilidiv"> </div></li>
                                                    <li class="preview-btn">
                                                        <button class="post-btn-preview preview" type="button" data-ripple="">Preview</button>
                                                    </li>
                                                </ul>
                                                <div id="results" class="selfieresult"></div>
                                                <input type="hidden" name="selfieimg" id="selfieimg" class="image-tag">
                                                <button class="post-btn profilepostbtn" type="button" data-ripple="">Post</button>
                                            </div>
                                        </form>
                                        </div>
                                        <div id="cameradiv" style="display:none" class="central-meta postbox">
                                            <div class="col-md-12 login_wrapper">
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-12" style="display: contents;">
                                                        <div id="my_camera"></div>
                                                        <button type="button" class="btn theme-red-bgcolor theme-round-btn" value="Click" onClick="take_snapshot()">Capture</button>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div><?php */
                                    ?>
                                    
                                    @if(count($profile_posts) == 0 && $totFollowing == 0)
                                        <div class="central-meta item">
                                            <div class="user-post">
                                                <div class="friend-info">
                                                    <div class="post-img figure">
                                                        <?php if(File::exists(public_path("/uploads/profile_pic/thumb/".$loggedinUser->profile_pic ))){ ?>
                                                        <img src="{{ url('/public/uploads/profile_pic/thumb/'.$loggedinUser->profile_pic) }}" alt="Fitnessity">
                                                        <?php }else{ 
                                                        $pf=substr($loggedinUser->firstname, 0, 1).substr($loggedinUser->lastname, 0, 1);
                                                            echo '<div class="admin-img-text"><p>'.$pf.'</p></div>';
                                                        ?>
                                                        
                                                        <?php } ?>
                                                    </div>
                                                    <div class="friend-name">
                                                        <ins><a href="#" title="">{{ucfirst($UserProfileDetail['firstname'])}} {{ucfirst($UserProfileDetail['lastname'])}}</a> Post Album</ins>
                                                    </div>
                                                    <div class="post-meta">
                                                       <p class="postText"></p>
                                                        <figure>
                                                            <div class="img-bunch" id="add_image">
                                                                <div class="row" >
                                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                                        <div class="default-img-profile">
                                                                            <img  src="{{ url('public/images/newimage/fitness-img-1.jpg') }}">
                                                                            <label> Joined Fitnessity on </label>
                                                                            <span class="spanstyle"><?php 
                                                                                $date=date_create($UserProfileDetail->created_at); echo date_format($date,"m/d/Y"); ?>
                                                                                    
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div> <!-- row -->
                                                            </div><!-- img-bunch -->
                                                        </figure>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <div class="loadMore">
                                        <?php $p=1; ?>
                                        @foreach($profile_posts as $profile_post)
                                            <?php $userData = User::where('id',$profile_post->user_id)->first(); ?>
                                            <div class="central-meta item">
                                                <div class="user-post">
                                                    <?php if($p==1){ ?>
                                                        
                                                    <?php } ?>
                                                    <div class="friend-info">
                                                    <?php
                                                        if(File::exists(public_path("/uploads/profile_pic/thumb/".$userData->profile_pic )))
                                                        { ?>
                                                        <figure>
                                                            <img src="{{ url('/public/uploads/profile_pic/thumb/'.$userData->profile_pic) }}" alt="pic">
                                                        </figure>
                                                    <?php } else { 
                                                        $pf=substr($userData->firstname, 0, 1).substr($userData->lastname, 0, 1);
                                                    ?>
                                                            <figure><div class="admin-img-text">
                                                            <?php echo '<p>'.$pf.'</p>'; ?>
                                                            </div>
                                                            </figure>
                                                    <?php } ?>
                                                        <div class="friend-name">
                                                        <?php
                                                            $postreport = PostReport::where('user_id',Auth::user()->id)->where('post_id',$profile_post->id)->first(); 
                                                            $postsave = ProfileSave::where('user_id',Auth::user()->id)->where('profile_id',$profile_post->id)->get();
                                                            $postsaveCount = $postsave->count();
                                                        ?>
                                                        <?php /*?><div class="more">
                                                            <div class="more-post-optns">
                                                                <i class="fa fa-ellipsis-h"></i>
                                                                <ul>
                                                                    @if($loggedinUser->id == $profile_post->user_id)
                                                                        <li><a id="{{$profile_post->id}}" class="editpopup" href="javascript:void(0);"><i class="fa fa-pencil-square-o"></i>Edit Post</a></li>
                                                                        <li><a href="{{route('delPost',$profile_post->id)}}"><i class="fa fa-trash"></i>Delete Post</a></li>
                                                                    @endif
                                                                    @if(($loggedinUser->id != $profile_post->user_id) && $postsave->count() == 0 )
                                                                        <li><a href="{{route('savePost',['pid'=>$profile_post->id,'uid'=>$profile_post->user_id])}}"><i class="far fa-bookmark"></i>Save Post</a></li>
                                                                    @elseif ($postsave->count() > 0)
                                                                        <li><a href="{{route('RemovesavePost',['pid'=>$profile_post->id,'uid'=>$profile_post->user_id])}}"><i class="fas fa-bookmark"></i>Remove from saved</a></li>
                                                                    @endif
                                                                    @if(empty($postreport))
                                                                        <li class="bad-report"><a is_report="1" id="{{$profile_post->id}}" href="javascript:void(0);" class="reportPost"><i class="fa fa-flag"></i>Report Post</a></li>
                                                                    @elseif($postreport->report_post==1)
                                                                        <li class="bad-report"><a is_report="0" id="{{$profile_post->id}}" href="javascript:void(0);" class="reportPost"><i class="fa fa-flag"></i>Un Report Post</a></li>
                                                                    @elseif($postreport->report_post==0)
                                                                        <li class="bad-report"><a is_report="1" id="{{$profile_post->id}}" href="javascript:void(0);" class="reportPost"><i class="fa fa-flag"></i>Report Post</a></li>
                                                                    @endif
                                                                    
                                                                </ul>
                                                            </div><!-- more-post-optns -->
                                                        </div><?php */?>
                                                        <ins><a href="#" title="">{{ucfirst($userData->firstname)}} {{ucfirst($userData->lastname)}} </a> Post Album</ins>
                                                        <span><i class="fa fa-globe"></i> published: {{date('F, j Y H:i:s A', strtotime($profile_post->created_at))}}</span>
                                                    </div><!-- friend-info -->
                                                    <div class="post-meta">
                                                        <input type="text" name="abc" data-emojiable="true" data-emoji-input="image" class="removepost" value="{{$profile_post->post_text}}" disabled="">
                                                        <?php 
                                                            $userid = $profile_post->user_id;
                                                            $count = count(explode("|",$profile_post->images));
                                                            $countimg = $count-5;
                                                            $getimages = explode("|",$profile_post->images);
                                                        ?> 
                                                        <figure>
                                                            <!-- video post -->
                                                            @if(isset($profile_post->video))
                                                                <div class="img-bunch">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                                            <figure>
                                                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                    <video controls class="thumb"  style="width: 100%;"  id="vedio{{$profile_post->id}}">
                                                                                        <source src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/video/{{$profile_post->video}}" type="video/mp4">
                                                                                    </video>
                                                                                </a>
                                                                            </figure>
                                                                            <script type="text/javascript">
                                                                                /*const vid = document.getElementById('vedio{{$profile_post->id}}');*/

                                                                                ['playing'].forEach(t => 
                                                                                   document.getElementById('vedio{{$profile_post->id}}').addEventListener(t, e => vediopostviews('{{$profile_post->id}}'))
                                                                                );
                                                                            </script>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @elseif(isset($profile_post->music))   
                                                                <div class="img-bunch">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                                            <figure>
                                                                                <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                                    <audio src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/music/{{$profile_post->music}}" controls></audio>
                                                                                </a>
                                                                            </figure>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- more than 4 images -->
                                                                      <!-- more than 4 images -->
                                                        @elseif(isset($getimages[4]) && !empty($getimages[4]))
                                                <?php
                                                    $i=0;
                                                    foreach($getimages as $img){
                                                        if(!empty($img) && File::exists(public_path("/uploads/gallery/".$userid."/".$img))){ 
                                                            if($i>4){
                                                ?>
                                                    <div class="img-bunch" style="display:none">
                                                        <div class="row">                   
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <figure>
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$img}}" class="firstfancyimg" data-fancybox="gallery{{$profile_post->id}}">
                                                                    <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$img}}" alt="fitnessity">
                                                                    </a>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php    }
                                                        }
                                                    $i++;
                                                    }                                              
                                                ?>
                                                    <div class="img-bunch">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                @if(isset($getimages[0]))
                                                                    <figure>
                                                                        <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" class="firstfancyimg" data-fancybox="gallery{{$profile_post->id}}">
                                                                            <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="fitnessity">
                                                                        </a>
                                                                    </figure>
                                                                @endif
                                                                @if(isset($getimages[1]))
                                                                    <figure>
                                                                        <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" class="firstfancyimg" data-fancybox="gallery{{$profile_post->id}}">
                                                                            <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="fitnessity">
                                                                        </a>
                                                                    </figure>
                                                                @endif
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                @if(isset($getimages[2]))
                                                                    <figure>
                                                                        <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" class="firstfancyimg" data-fancybox="gallery{{$profile_post->id}}">
                                                                            <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" alt="fitnessity">
                                                                        </a>
                                                                    </figure>
                                                                @endif
                                                                @if(isset($getimages[3]))
                                                                    <figure>
                                                                        <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[3]}}" class="firstfancyimg" data-fancybox="gallery{{$profile_post->id}}">
                                                                            <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[3]}}" alt="">
                                                                        </a>
                                                                    </figure>
                                                                @endif
                                                                @if(isset($getimages[4]))
                                                                    <figure>
                                                                        <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[4]}}" class="firstfancyimg" data-fancybox="gallery{{$profile_post->id}}">
                                                                            <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[4]}}" alt="fitnessity">
                                                                        </a>
                                                                        <div class="more-photos">
                                                                            <span>+{{$countimg}}</span>
                                                                        </div>
                                                                    </figure>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- 4 images -->
                                                @elseif(isset($getimages[3]) && !empty($getimages[3]))
                                                    <div class="img-bunch">
                                                        <div class="row">                   
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <figure>
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" class="firstfancyimg" data-fancybox="gallery{{$profile_post->id}}">
                                                                        <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="fitnessity">
                                                                    </a>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <div class="row">   
                                                            <div class="col-lg-4 col-md-4 col-sm-4"> 
                                                                <figure>
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" class="firstfancyimg" data-fancybox="gallery{{$profile_post->id}}">
                                                                        <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="fitnessity" height="170">
                                                                    </a>
                                                                </figure>   
                                                            </div> 
                                                            <div class="col-lg-4 col-md-4 col-sm-4"> 
                                                                <figure>
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" class="firstfancyimg" data-fancybox="gallery{{$profile_post->id}}">
                                                                        <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" alt="fitnessity" height="170">
                                                                    </a>
                                                                </figure>    
                                                            </div> 
                                                            <div class="col-lg-4 col-md-4 col-sm-4">  
                                                                <figure>
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[3]}}" class="firstfancyimg" data-fancybox="gallery{{$profile_post->id}}">
                                                                        <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[3]}}" alt="fitnessity" height="170">
                                                                    </a>
                                                                </figure>   
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <!-- 3 images -->
                                                @elseif(isset($getimages[2]) && !empty($getimages[2]))
                                                    <div class="img-bunch">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                <figure>
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" class="firstfancyimg" data-fancybox="gallery{{$profile_post->id}}">
                                                                        <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="fitnessity" width="100" height="335">
                                                                    </a>
                                                                </figure>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                <figure>
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" class="firstfancyimg" data-fancybox="gallery{{$profile_post->id}}">
                                                                        <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="fitnessity" width="100" height="165">
                                                                    </a>
                                                                </figure>
                                                                <figure>
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" class="firstfancyimg" data-fancybox="gallery{{$profile_post->id}}">
                                                                        <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" alt="fitnessity" width="100" height="165">
                                                                    </a>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif(isset($getimages[1]) && !empty($getimages[1]))
                                                    <div class="img-bunch-two">
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                <figure>
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" class="firstfancyimg" data-fancybox="gallery{{$profile_post->id}}">
                                                                        <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="fitnessity">
                                                                    </a>
                                                                </figure>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                <figure>
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" class="firstfancyimg" data-fancybox="gallery{{$profile_post->id}}">
                                                                        <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="fitnessity">
                                                                    </a>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <!-- 1 images -->
                                                @elseif(isset($getimages[0]) && !empty($getimages[0]))
                                                    <div class="img-bunch">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <figure>
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" class="firstfancyimg" data-fancybox="gallery{{$profile_post->id}}">
                                                                        <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="fitnessity">
                                                                    </a>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                                   
                                                                    <?php
                                                                        $profile_posts_like = PostLike::where('post_id',$profile_post->id)->where('is_like',1)->count();
                                                                        $likemore = $profile_posts_like-2;
                                                                        $loginuser_like = PostLike::where('post_id',$profile_post->id)->where('is_like',1)->where('user_id',$loggedinUserorignal->id)->first();
                                                                        $seconduser_like = PostLike::where('post_id',$profile_post->id)->where('is_like',1)->where('user_id','!=',$loggedinUser->id)->first();
                        
                                                                        $profile_posts_comment = PostComment::where('post_id',$profile_post->id)->count();
                                                                        $postsaved = ProfileSave::where('profile_id',$profile_post->id)->where('user_id',$loggedinUser->id)->first();
                                                                        $activethumblike=''; $savedpost='';
                                                                        if( !empty($postsaved) ){ $savedpost='activesavedpost'; }                                                                       
                                                                    ?>
                                                                    <ul class="like-dislike" id="ulike-dislike<?php echo $profile_post->id; ?>">
                                                                        <li><a class="savepost <?php echo $savedpost; ?>" href="javascript:void(0);" title="Save to Pin Post" id="savepost{{$profile_post['id']}}" postid="{{$profile_post['id']}}">
                                                                            <i class="thumbtrack fas fa-thumbtack"></i>
                                                                            </a>
                                                                        </li>                                                                         
                                                                        @if(!empty($loginuser_like))
                                                                            <?php $activethumblike='activethumblike'; ?>
                                                                        @endif
                                                                        <li><a href="javascript:void(0);" title="Like Post" class="<?php echo $activethumblike; ?>"><i id="{{$profile_post->id}}" is_like="1" class="thumbup thumblike fas fa-thumbs-up"></i></a></li>
                                                                        <li><a href="javascript:void(0);" title="dislike Post"><i id="{{$profile_post->id}}" is_like="0" class="thumpdown thumblike fas fa-thumbs-down"></i></i></a></li>
                                                                    </ul>
                                                                </figure>   
                                                                <div class="we-video-info">
                                                                    <ul class ="postinfoul{{$profile_post['id']}}">
                                                                        @if(isset($profile_post->video))
                                                                        <?php 

                                                                            $ppvcnt = ProfilePostViews::where('post_id' , $profile_post->id)->count();
                                                                        ?>
                                                                        <li>
                                                                            <span class="views" title="views">
                                                                                <i class="eyeview fas fa-eye"></i>
                                                                                <ins>{{$ppvcnt}}</ins>
                                                                            </span>
                                                                        </li>
                                                                        @endif
                                                                        <li>
                                                                            <div class="likes heart" title="Like/Dislike">❤ <span id="likecount{{$profile_post->id}}">{{$profile_posts_like}}</span></div>
                                                                        </li>
                                                                        <li>
                                                                            <span class="comment{{$profile_post->id}}" title="Comments">
                                                                                <i class="commentdots fas fa-comment-dots"></i>
                                                                                <ins>{{$profile_posts_comment}}</ins>
                                                                            </span>
                                                                        </li>
                                                                        
                                                                    </ul>
                                                                    <div class="users-thumb-list" id="users-thumb-list<?php echo $profile_post->id; ?>">
                                                                    <?php
                                                                    $profile_posts_like = PostLike::where('post_id',$profile_post->id)->where('is_like',1)->count(); ?>
                                                                        @if($profile_posts_like>0)
                                                                            @if(!empty($loginuser_like))
                                                                                <a data-toggle="tooltip" title="" href="#">
                                                                                <?php if(File::exists(public_path("/uploads/profile_pic/thumb/".$loggedinUserorignal->profile_pic ))){ ?>
                                                                                    <img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$loggedinUserorignal->profile_pic) }}" height="32" width="32">
                                                                                <?php }else{ 
                                                                                        $pf=substr($loggedinUserorignal->firstname, 0, 1).substr($loggedinUserorignal->lastname, 0, 1);
                                                                                        echo '<div class="admin-img-text"><p>'.$pf.'</p></div>';
                                                                                    } ?> 
                                                                                </a>
                                                                            @endif
                                                                            <?php 
                                                                                $profile_posts_all = PostLike::where('post_id',$profile_post->id)->where('is_like',1)->where('user_id','!=',$loggedinUser->id)->limit(4)->get(); ?>
                                                                                @if(isset($profile_posts_all[0]) && $profile_posts_all[0]->user_id != $loggedinUserorignal->id)
                                                                                    <?php $seconduser = User::find($profile_posts_all[0]->user_id); ?>
                                                                                    <a data-toggle="tooltip" title="" href="#">
                                                                                    <?php if(File::exists(public_path("/uploads/profile_pic/thumb/".$seconduser->profile_pic ))){ ?>
                                                                                        <img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$seconduser->profile_pic) }}" height="32" width="32">  
                                                                                    <?php }else{ 
                                                                                        $pf=substr($seconduser->firstname, 0, 1).substr($seconduser->lastname, 0, 1);
                                                                                        echo '<div class="admin-img-text"><p>'.$pf.'</p></div>';
                                                                                    } ?> 
                                                                                    </a>
                                                                                @endif
                                                                                @if(isset($profile_posts_all[1]))
                                                                                    <?php $thirduser = User::find($profile_posts_all[1]->user_id); ?>
                                                                                    <a data-toggle="tooltip" title="" href="#">
                                                                                        <?php if(File::exists(public_path("/uploads/profile_pic/thumb/".$thirduser->profile_pic ))){ ?>
                                                                                        <img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$thirduser->profile_pic) }}" height="32" width="32"> 
                                                                                     <?php }else{ 
                                                                                        $pf=substr($thirduser->firstname, 0, 1).substr($thirduser->lastname, 0, 1);
                                                                                        echo '<div class="admin-img-text"><p>'.$pf.'</p></div>';
                                                                                    } ?>  
                                                                                    </a>
                                                                                @endif
                                                                                @if(isset($profile_posts_all[2]))
                                                                                    <?php $fourthuser = User::find($profile_posts_all[2]->user_id); ?>
                                                                                    <a data-toggle="tooltip" title="" href="#">
                                                                                        <?php if(File::exists(public_path("/uploads/profile_pic/thumb/".$fourthuser->profile_pic ))){ ?>
                                                                                            <img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$fourthuser->profile_pic) }}" height="32" width="32">  
                                                                                        <?php }else{ 
                                                                                            $pf=substr($fourthuser->firstname, 0, 1).substr($fourthuser->lastname, 0, 1);
                                                                                            echo '<div class="admin-img-text"><p>'.$pf.'</p></div>';
                                                                                        } ?> 
                                                                                    </a>
                                                                                @endif
                                                                                @if(isset($profile_posts_all[3]))
                                                                                    <?php $fifthuser = User::find($profile_posts_all[3]->user_id); ?>
                                                                                    <a data-toggle="tooltip" title="" href="#">
                                                                                    <?php if(File::exists(public_path("/uploads/profile_pic/thumb/".$fifthuser->profile_pic ))){ ?>
                                                                                        <img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$fifthuser->profile_pic) }}" height="32" width="32"> 
                                                                                    <?php }else{ 
                                                                                            $pf=substr($fifthuser->firstname, 0, 1).substr($fifthuser->lastname, 0, 1);
                                                                                            echo '<div class="admin-img-text"><p>'.$pf.'</p></div>';
                                                                                        } ?> 
                                                                                    </a>
                                                                                @endif
                                                                                <span>
                                                                                    <strong>
                                                                                        @if(!empty($loginuser_like))
                                                                                            You,
                                                                                        @endif
                                                                                    </strong>
                                                                                    @if(!empty($seconduser_like))
                                                                                        <?php $secondusername = User::where('id',$seconduser_like->user_id)->first(); ?><b>{{$secondusername->username}}</b>
                                                                                    @endif
            
                                                                                    @if($profile_posts_like>2)
                                                                                        And <a href="#" title="">{{$likemore}}+ More</a> 
                                                                                    @endif
                                                                                    Liked
                                                                                </span>
                                                                            
                                                                        @endif
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="coment-area" style="display: block;">
                                                                    <ul class="we-comet">
                                                                        <?php 
                                                                        $comments = PostComment::where('post_id',$profile_post->id)->limit(2)->get();
                                                                        $allcomments = PostComment::where('post_id',$profile_post->id)->get();
                                                                        ?>
                                                                        @if(count($comments) > 0)
                                                                            @foreach($comments as $comment)
                                                                                <?php
                                                                                //print_r($comment);
                                                                                $username = User::find($comment->user_id);
                                                                                $cmntlike = PostCommentLike::where('comment_id', $comment->id)->count();
                                                                                ?>
                                                                                <li class="commentappendremove">
                                                                                    <div class="comet-avatar">
                                                                                    
                                                                                    <?php if(File::exists(public_path("/uploads/profile_pic/thumb/".$username->profile_pic ))){ ?>
                                                                                        <img src="{{ url('/public/uploads/profile_pic/thumb/'.$username->profile_pic) }}" alt="pic">
                                                                                    <?php }else{ 
                                                                                        $pf=substr($username->firstname, 0, 1).substr($username->lastname, 0, 1);
                                                                                        echo '<div class="admin-img-text"><p>'.$pf.'</p></div>';
                                                                                    } ?>
                                                                                </div>
                                                                                    <div class="we-comment">
                                                                                        <h5><a href="javascript:void(0);" title="">{{$username->firstname}} {{$username->lastname}}</a></h5>
                                                                                        <p>{{$comment->comment}}</p>
                                                                                        <div class="inline-itms" id="commentlikediv<?php echo $comment->id; ?>">
                                                                                        <?php
                                                                                            $cmntUlike = PostCommentLike::where('comment_id',$comment->id)->where('user_id',Auth::user()->id)->count();
                                                                                            
                                                                                        ?>
                                                                                            <span>{{$comment->created_at->diffForHumans()}}</span>
                                                                                            <?php /*?><a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a><?php */?>
                                                                                            <a href="javascript:void(0);" class="commentlike" id="{{$comment->id}}" post-id="{{$profile_post->id}}" ><i class="fa fa-heart <?php if($cmntUlike>0){ echo 'commentLiked'; } ?>" id="comlikei<?php echo $comment->id; ?>"></i><span id="comlikecounter<?php echo $comment->id; ?>"><?php echo $cmntlike; ?></span></a>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            @endforeach
                                                                        @endif
                                                                        <li class="commentappend{{$profile_post->id}}"></li>
                                                                        @if(count($allcomments) > 2)
                                                                            <input type="hidden" name="commentdisplay" id="commentdisplay" value="5">
                                                                            <li>
                                                                                <a id="{{$profile_post->id}}" href="javascript:void(0);" title="" class="showcomments showmore underline">more comments+</a>
                                                                            </li>
                                                                        @endif
                                                                        <li class="post-comment">
                                                                            <div class="comet-avatar 11">
                                                                                <?php if(File::exists(public_path("/uploads/profile_pic/thumb/".$loggedinUserorignal->profile_pic ))){ ?>
                                                                                    <img src="{{ url('/public/uploads/profile_pic/thumb/'.$loggedinUserorignal->profile_pic) }}" alt="pic">
                                                                                <?php }else{ 
                                                                                    $pf=substr($loggedinUserorignal->firstname, 0, 1).substr($loggedinUserorignal->lastname, 0, 1);
                                                                                    echo '<div class="admin-img-text"><p>'.$pf.'</p></div>';
                                                                                } ?>
                                                                            </div>
                                                                            <div class="post-comt-box">
                                                                                <form method="post" id="commentfrm">
                                                                                    <textarea placeholder="Post your comment" name="comment" id="comment{{$profile_post->id}}"></textarea>
                                                                                    <span class="error" id="err_comment{{$profile_post->id}}"></span>
                                                                                    <div class="add-smiles">
                                                                                        
                                                                                        <span class="em em-expressionless" title="add icon"></span>
                                                                                        <div class="smiles-bunch">
                                                                                            <i class="em em---1"></i>
                                                                                            <i class="em em-smiley"></i>
                                                                                            <i class="em em-anguished"></i>
                                                                                            <i class="em em-laughing"></i>
                                                                                            <i class="em em-angry"></i>
                                                                                            <i class="em em-astonished"></i>
                                                                                            <i class="em em-blush"></i>
                                                                                            <i class="em em-disappointed"></i>
                                                                                            <i class="em em-worried"></i>
                                                                                            <i class="em em-kissing_heart"></i>
                                                                                            <i class="em em-rage"></i>
                                                                                            <i class="em em-stuck_out_tongue"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                    <button id="{{$profile_post->id}}" class="postcomment theme-red-bgcolor" type="button">Post</button>
                                                                                </form> 
                                                                            </div>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- album post -->
                                                    <?php $p++; ?>
                                                @endforeach
                                                <!-- append page scroll result -->
                                                <div class="content-dash" id="scroll_pagination"></div>
                                            </div>
                                            
                                </div><!-- timeline tab -->
                                <div class="tab-pane" id="about" role="tabpanel">
                                    <div class="desc-text" id="mydesc">
                                        <?php $gender = array('' => 'Select Gender', 'Male' => 'Male', 'Female' => 'Female'); ?>
                                            <p>@if(isset($UserProfileDetail['business_info'])) {!! nl2br(@$UserProfileDetail['business_info']) !!} @else - @endif</p>
                                            <p>@if(isset($UserProfileDetail['intro'])) {!! nl2br(@$UserProfileDetail['intro']) !!} @endif</p>
                                    </div>
                                </div>
                                <div class="tab-pane" id="photos" role="tabpanel">
                                    <div class="desc-text" id="mydesc">
                                        <?php 
                                            if (!empty($images)) 
                                            {
                                                foreach($images as $data)
                                                {
                                                    $img_part = explode("|",$data->images);
                                                    $imgCount = count($img_part);
                                                    for ($i=0; $i <$imgCount ; $i++) 
                                                    { ?>
                                                        <div class="col-sm-3 col-md-4 col-lg-4">
                                                            <div class="photo-tab-imgs">
                                                                <figure>
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$data->user_id}}/{{$img_part[$i]}}" data-fancybox="gallery_photo{{$i}}" class="firstfancyimg">
                                                                        <img height="170" width="170" lass="bixrwtb6" src="{{ URL::to('public/uploads/gallery')}}/{{$data->user_id}}/{{$img_part[$i]}}" alt="fitnessity">
                                                                    </a>
                                                                </figure>
                                                                <!-- <img height="170" width="170" class="bixrwtb6" src="{{asset('public/uploads/gallery/')}}/{{$data->user_id}}/{{$img_part[$i]}}"> -->
                                                            </div>
                                                        </div>
                                                    <?php 
                                                    }
                                                }
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="tab-pane" id="videos" role="tabpanel">
                                    <div class="video-box">
                                        <div class="row">
                                            <?php 
                                                if (!empty($videos)) 
                                                {
                                                    foreach($videos as $data)
                                                    { ?>
                                                        <div class="col-sm-4 col-md-6 col-lg-6">
                                                            <div class="video-tab-iframe">
                                                                <iframe src="{{asset('public/uploads/gallery/')}}/{{$data->user_id}}/video/{{$data->video}}" frameborder="0" allowfullscreen></iframe>
                                                            </div>
                                                        </div>
                                                    <?php 
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                
                            </div> <!-- tab content -->
                            </div><!-- col-md-8 -->
                            <div class="col-sm-12 col-md-4 col-lg-4">
                                @include('profiles.userProfileViewRightpanel')
                            </div>
                            
                        </div>
                    </div>
                <!--</div>--> <!-- comment by nnn -->
            </section>




@include('layouts.footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" />
<link href="https://cdn.jsdelivr.net/npm/zebra_datepicker@latest/dist/css/default/zebra_datepicker.min.css" />
<!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Zebra_datepicker/1.9.15/zebra_datepicker.src.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<!-- <script src="{{ url('public/js/pixelarity-face.js') }}"></script> -->
<script src="{{ url('public/js/jquery.shares.js') }}"></script>
<script src="{{ url('public/js/jquery.fancybox.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<!-- emoji -->
<script src="{{ url('public/emoji/lib/js/config.js') }}"></script>
<script src="{{ url('public/emoji/lib/js/util.js') }}"></script>
<script src="{{ url('public/emoji/lib/js/jquery.emojiarea.js') }}"></script>
<script src="{{ url('public/emoji/lib/js/emoji-picker.js') }}"></script>
<!-- <script src="{{ url('public/js/date-range-picker.js') }}"></script> -->
<script src="{{ url('public/js/webcam.min.js') }}"></script>


<script type="text/javascript"> 
    
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/><button style="margin-top:2%;; background-color:white; color:#bd2025;" onclick="myFunction()"> Click to verify </p>';
        } );
    }
    function showWebCam() 
    {
        //$("#webCamButton").hide();
        $("#cameradiv").show();
        Webcam.set({
             width: 650,
             height: 400,
             image_format: 'jpeg',
             jpeg_quality: 90
         });
         Webcam.attach( '#my_camera' );
    }
    function myFunction() {
        alert("Image verified!");
    }

    function vediopostviews(post_id) {
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: "{{url('/updateprofilepostviewcount')}}",
            xhrFields: {
                withCredentials: true
            },
            type: 'post',
            data:{
                post_id:post_id,
                 _token: _token
            },  
            success: function (data){
                $(".postinfoul"+post_id).load(" .postinfoul"+post_id+" >*");
                $(".postinfoulajax"+post_id).load(" .postinfoulajax"+post_id+" >*");
            }
        });
    }

    $(document).ready(function(){ 
        function detectWebcam(callback) {
            let md = navigator.mediaDevices;
            if (!md || !md.enumerateDevices) return callback(false);
                md.enumerateDevices().then(devices => {
                    callback(devices.some(device => 'videoinput' === device.kind));
                })
            }
            detectWebcam(function(hasWebcam) {
                var checkwebcam = (hasWebcam ? 'yes' : 'no');
                if(checkwebcam == 'no'){
                    //$('.checkwebcam').css("display","none");
                }
            }) 
            $(document).on('click', '.sharefb', function(){ 
                var id = $(this).attr("id");
                $.ajax({
                    url: "{{route('postDetail')}}",
                     xhrFields: {
                            withCredentials: true
                        },
                    type: 'get',
                    data:{
                        id:id,
                    },
                    success: function (response) {
                    }
                });
            });
            $(document).on('click', '.editpopup', function(){
                var id = $(this).attr("id");
                $.ajax({
                    url: "{{route('editpost')}}",
                     xhrFields: {
                            withCredentials: true
                        },
                    type: 'get',
                    data:{
                        id:id,
                    },
                    success: function (response) {
                        $('#edit_image').html(response.html);
                        $('.post_textemoji').html(response.data_textarea);
                        $('#someid').attr('name', 'value'); 
                        $('#edit_post').modal('show');
                    }
                });
            });
        });
        
        $('.preview').click(function () {
            //var imgsrc = $('.').attr('src');
            //$('.postText').text($('#post_text').val());
            $('.postText').html($('.newpst-input .emoji-wysiwyg-editor').html());
            var img_array = [];
            var video = $('#videourl').val();
            var music = $('#musicurl').val();
            var sources = $(".postimgarray").map(function() {
                img_array.push(this.src);
            }).get();  
            var imgcount = img_array.length-5;
            var totimgcount = img_array.length;
            var html = '<div class="row" ><div class="col-lg-6 col-md-6 col-sm-6">';
            /* video preview */                
            if(String(video) != 'undefined'){
                html += '<figure><a href="#" title="" data-toggle="modal" data-target="#img-comt"><video width="320" height="240" src='+video+' controls>Your browser does not support the video tag.</video></a></figure>';
            }
            /* music preview*/
            if(String(music) != 'undefined'){
                html += '<figure><a href="#" title="" data-toggle="modal" data-target="#img-comt"><audio src="'+music+'" controls></audio></a></figure>';
            }
            /* Image preview */
            if(String(img_array[0]) != 'undefined'){
                html += '<figure><a href="#" title="" data-toggle="modal" data-target="#img-comt"><img src='+img_array[0]+' alt="" width="100" height ="210"></a></figure>'
            }
            if(String(img_array[1]) != 'undefined'){
                html += '<figure><a href="#" title="" data-toggle="modal" data-target="#img-comt"><img src='+img_array[1]+' alt="" width="100" height ="210"></a></figure>'
            }
            html += '</div>';
            html += '<div class="col-lg-6 col-md-6 col-sm-6">';
            if(String(img_array[2]) != 'undefined'){
                html += '<figure><a href="#" title="" data-toggle="modal" data-target="#img-comt"><img src='+img_array[2]+' alt="" width="100" height ="140"></a></figure>'
            }
            if(String(img_array[3]) != 'undefined'){
                html += '<figure><a href="#" title="" data-toggle="modal" data-target="#img-comt"><img src='+img_array[3]+' alt="" width="100" height ="140"></a></figure>'
            }
            if(String(img_array[4]) != 'undefined'){
                html += '<figure><a href="#" title="" data-toggle="modal" data-target="#img-comt"><img src='+img_array[4]+' alt="" width="100" height ="140"></a><div class="more-photos"><span>+ '+imgcount+'</span></div></figure>'
            }
            html += '</div>';
            html += '</div>';
            $('#add_image').html(html);
                $('#previewmodel').modal('show');
            });
</script>

<!-- <script>
    $(document).ready(function(){
        $('a.share').shares();
    });

</script> -->
<script>
    $(function() {
        // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
            emojiable_selector: '[data-emojiable=true]',
            assetsPath: '../public/emoji/lib/img/',
            popupButtonClasses: 'fas fa-smile'
        });
        // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
        // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
        // It can be called as many times as necessary; previously converted input fields will not be converted again
        window.emojiPicker.discover();
    });
</script>
<script>
    // Google Analytics
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-49610253-3', 'auto');
    ga('send', 'pageview');
</script>
<!--  <script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-36251023-1']);
    _gaq.push(['_setDomainName', 'axc']);
    _gaq.push(['_trackPageview']);
    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
</script> -->

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.blah').attr('src', e.target.result);
                var html = '<img src="' + e.target.result + '">';
                $('.uploadedpic').html(html);
            };
            profile_pic_var = input.files[0];
            reader.readAsDataURL(input.files[0]);
        }
    }
    //window.onload = gallery;
    //when we load your gallery in browser then gallery function is loaded
    function gallery() {
        // gallery is the name of function
        //var allimages = document.images;
        var allimages = $("img.gallarychangeimg");
        for (var i = 0; i < allimages.length; i++) {
            //if(allimages[i].id.indexOf("small") > -1){
            allimages[i].onclick = imgChanger;
            //in above line we are adding a listener to all the thumbs stored inside the allimages array on onclick event.
            //}
        }
    }
    //declaring the imgChanger function
    function imgChanger() {
        //changing the src attribute value of the large image.
        document.getElementById('myPicturechange').src = this.id;
    }
    $(document).ready(function () {
        $("#profile_pic").change(function (e) {
            var img = e.target.files[0];
            if (!pixelarity.open(img, false, function (res, faces) {
                //console.log(faces);
                $("#result").attr("src", res);
                $("#croped_img").val(res);
                $(".face").remove();
                for (var i = 0; i < faces.length; i++) {
                    $("body").append("<div class='face' style='height: " + faces[i].height + "px; width: " + faces[i].width + "px; top: " + ($("#result").offset().top + faces[i].y) + "px; left: " + ($("#result").offset().left + faces[i].x) + "px;'>");
                }
            }, "jpg", 0.7, true)) {
                alert("Whoops! That is not an image!");
            }
        });
    });

</script>
<script>
    function initialize1(q) {
        console.log(q.value);
        var input = q;
        console.log(input.value);
        var s = input.value;
        // var streetaddress= input.substr(0, input.indexOf(',')); 
        var autocomplete = new google.maps.places.Autocomplete(input);
        //  if(s != ''){
            //     var streetaddress= s.substr(0, s.indexOf(','));
            //     input.value = streetaddress
        // }
        $('.pac-container').css('z-index', '999999999');
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                lat = place.geometry.location.lat();
                long = place.geometry.location.lng();
                for (var i = 0; i < place.address_components.length; i++) {
                    for (var j = 0; j < place.address_components[i].types.length; j++) {
                        if (place.address_components[i].types[j] == "postal_code") {
                            $('#frm_zipcode').val(place.address_components[i].long_name);
                        }
                        if (place.address_components[i].types[j] == "locality") {
                            $('#frm_city').val(place.address_components[i].long_name);
                            // document.getElementById('b_address').value = place.address_components[i].short_name;
                            //document.getElementById('b_city').value = place.address_components[i].short_name;
                        }
                        if (place.address_components[i].types[j] == "country") {
                            $('#frm_country_dd').val(place.address_components[i].short_name);
                        }
                        if (place.address_components[i].types[j] == "administrative_area_level_1") {
                            $('#frm_state').val(place.address_components[i].long_name);
                        }
                    }
                }
            });
        }
</script>
<script>
    function readURLCOVER(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
            $('#thumb-2').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]); //  convert to base64 string
        }
    }

    /* page load scroll*/
    var page =0;
    var cnfload = true;
    
    //for mobile and web scroll
    var addition_constant = 0;
    $(document.body).on('touchmove', onScroll); // for mobile
    $(window).on('scroll', onScroll);
    
    function onScroll() {
      var addition = ($(window).scrollTop() + window.innerHeight);
      //var footerHeight = $('#footer').height();
      var scrollHeight = (document.body.scrollHeight - 1);
      //scrollHeight = scrollHeight-footerHeight;
      if (addition > scrollHeight && addition_constant < addition) {
    
        addition_constant = addition;
    
        cnfload = false;
        page++;
        //alert(page);
        load_data(page);
      }
    }
    
    function load_data(page){
        $('.loader').show();
        var userid = '<?php echo $loggedinUser->id; ?>';
        $.ajax({
            url: "{{url('/loadmorepost')}}",
             xhrFields: {
                            withCredentials: true
                        },
            type: 'get',
            data:{
                page:page,
                userid:userid,
            },  
            success: function (data) {
                if(data.success=='success'){
                    $('#scroll_pagination').append(data.html);
                    cnfload = true;
                }
            }
        });
    }
    //load_data(page);

    $('#image_post').on("change", previewImages);
    $('#video').on("change", previewVideo);
    
    function previewVideo(){
        var $preview = $('.postImage').empty(); 
        $preview.append('<input type="hidden" id="videourl"></span><video width="320" height="240" controls>Your browser does not support the video tag.</video>');
        let file = event.target.files[0];
        let blobURL = URL.createObjectURL(file);
        document.querySelector("video").src = blobURL;
        $('#videourl').val(blobURL);
    }
   
    $('#music_post').on("change", previewMusic);
    function previewMusic(){
        var $preview = $('.postImage').empty(); 
        $preview.append('<input type="hidden" id="musicurl"></span><video width="320" height="240" controls>Your browser does not support the video tag.</video>');
        let file = event.target.files[0];
        let blobURL = URL.createObjectURL(file);
        document.querySelector("video").src = blobURL;
        $('#musicurl').val(blobURL);
    }

    function previewImages() {
        var $preview = $('.postImage').empty(); 
        if (this.files) $.each(this.files, readAndPreview);
        function readAndPreview(i, file) {
            if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
                return alert(file.name +" is not an image");
            } // else...
            var reader = new FileReader();
            $(reader).on("load", function() {
                $preview.append($('<img>', {src:this.result, height:100, width:100, class:'postimgarray'}));
            });
            reader.readAsDataURL(file);
        }
    }

    $(document).on('click', '.editpic', function(){
        //$('.editpic').click(function () {
        var imgname = $(this).attr('imgname');
        var id = $(this).attr('id');
        var foldernm = '<?php echo $loggedinUser->id;  ?>';
        $('#imgId').val(id);
        $('#imgname').val(imgname);
        $(".srcappend").attr("src","/public/uploads/gallery/"+foldernm+"/thumb/"+imgname);
    });

    $(document).on('click', '.reportPost', function(){
        //$('.reportPost').click(function () {
        var _token = $("input[name='_token']").val();
        var postId =$(this).attr('id');
        var is_report = $(this).attr('is_report');
        $.ajax({
            url: "{{url('/reportPost')}}" + "/"+postId,
             xhrFields: {
                                withCredentials: true
                            },
            type: 'post',
            data:{
                _token:_token,
                is_report:is_report
            },
            success: function (data) {
                if(data.success=='success'){
                    $('#likecount'+postId).html(data.count);
                }
            }
        }); 
    });

    $(document).on('click', '.showcomments', function(){
        var commentdisplay = $('#commentdisplay').val();
        var postId =$(this).attr('id');
        $('.commentappendremove').html("");
        $.ajax({
            url: "{{url('/showcomments')}}" + "/"+postId,
             xhrFields: {
                                withCredentials: true
                            },
            type: 'get',
            data:{
                commentdisplay:commentdisplay
            },
            success: function (data) {
                if(data.success=='success'){
                    //$('#likecount'+postId).html(data.count);
                    $('.commentappend'+postId).html(data.html);
                    var commentsum = parseInt(commentdisplay)+parseInt(5);
                    $('#commentdisplay').val(commentsum);
                }
            }
        }); 
    });

    $(document).on('click', '.thumblike', function(){
        //$('html, body').stop();
        var _token = $("input[name='_token']").val();
        var postId =$(this).attr('id');
        var is_like = $(this).attr('is_like');
        $.ajax({
            url: "{{url('/like-post')}}" + "/"+postId,
             xhrFields: {
                withCredentials: true
            },
            type: 'post',
            data:{
                _token:_token,
                is_like:is_like
            },
            success: function (data) {
                if(data.success=='success'){
                    $("#users-thumb-list"+postId).load(" #users-thumb-list"+postId+" > *");
                    $("#ulike-dislike"+postId).load(" #ulike-dislike"+postId+" > *");
                    $('#likecount'+postId).html(data.count);
                }
            }
        });
    });

    $(document).on('click', '.commentlike', function(){
        var _token = $("input[name='_token']").val();
        var comId =$(this).attr('id');
        var postId =$(this).attr('post-id');
        alert(comId);
        $.ajax({
            url: "{{url('/like-comment')}}" + "/"+comId,
             xhrFields: {
                withCredentials: true
            },
            type: 'post',
            data:{
                _token:_token,
                postId:postId
            },
            success: function (data) {
                if(data.success=='success'){
                    $('#comlikecounter'+comId).html(data.count);
                    if(data.status=='like')
                    { $('#comlikei'+comId).css("color", "#f91942"); }
                    if(data.status=='unlike')
                    { $('#comlikei'+comId).css("color", "#000000"); $('#comlikei'+comId).removeClass("commentLiked"); }
                }
            }
        });
    });

    $("#coverphoto").change(function() {
        readURLCOVER(this);
    });


</script>
<script>

    $(document).ready(function () {

        $('.delimg').click(function () {
            $.ajax({
                url: "{{url('/delete-image-user?myindex=')}}" + $(this).attr('myindex'),
                 xhrFields: {
                    withCredentials: true
                },
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
        });

        $('.delPhoto').click(function () {
            var txt;
            var r = confirm("Are you sure, you want to delete?");
            if (r == true) {
                $.ajax({
                    url: "{{url('/delete-image-gallery?delId=')}}" + $(this).attr('delId'),
                     xhrFields: {
                        withCredentials: true
                    },
                    type: 'get',
                    beforeSend: function () { $('.loader').show(); },
                    complete: function () { $('.loader').hide(); },
                    success: function (response) {
                        //if(response.status ==200){
                        window.location.reload();
                        $(this).parent().remove();
                        //}
                    }
                });
            }
        });

        $('.selectPhoto').click(function () {
            var txt;
            var r = confirm("Are you sure, you want to set cover photo?");
            if (r == true) {
                $.ajax({
                    url: "{{url('/set-cover-photo?selectId=')}}" + $(this).attr('selectId'),
                     xhrFields: {
                        withCredentials: true
                    },
                    type: 'get',
                    beforeSend: function () { $('.loader').show(); },
                    complete: function () { $('.loader').hide(); },
                    success: function (response) {
                        //if(response.status ==200){
                        window.location.reload();
                        $(this).parent().remove();
                        //}
                    }
                });
            }
        });
                        
        $('.unselectPhoto').click(function () {
            var txt;
            var r = confirm("Are you sure, you want to unset cover photo?");
            if (r == true) {
                $.ajax({
                    url: "{{url('/unset-cover-photo?selectId=')}}" + $(this).attr('selectId'),
                    xhrFields: {
                        withCredentials: true
                    },
                    type: 'get',
                    beforeSend: function () { $('.loader').show(); },
                    complete: function () { $('.loader').hide(); },
                    success: function (response) {
                        //if(response.status ==200){
                        window.location.reload();
                        $(this).parent().remove();
                        //}
                    }
                });
            }
        });

        //Loads the html to each slider. Write in the "div id="slide-content-x" what you want to show in each slide
        $('#carousel-text').html($('#slide-content-0').html());
        //Handles the carousel thumbnails
        $('[id^=carousel-selector-]').click(function () {
            var id = this.id.substr(this.id.lastIndexOf("-") + 1);
            var id = parseInt(id);
            $('#myCarousel').carousel(id);
        });
        // When the carousel slides, auto update the text
        $('#myCarousel').on('slid.bs.carousel', function (e) {
            var id = $('.item.active').data('slide-number');
            $('#carousel-text').html($('#slide-content-' + id).html());
        });

        $('.coemail').attr('href', "{{'mailto:'.$UserProfileDetail['email']}}");
        $('.cophone').attr('href', "{{'tel:'.$UserProfileDetail['phone_number']}}");
        $('.coaddress').attr('href', "{{'http://maps.google.com/?q='.$UserProfileDetail['address']}}");
        $('.prfl-nme').html('');
        if (window.location.href.split('?').pop() == 'companyCreate=1') {
            $('#create_company_btn').click()
        }

        $("#resetPassword").click(function () {
            formdata = new FormData();
            var token = '{{csrf_token()}}';
            var email = '{{Auth::user()->email}}';
            formdata.append("_token", token);
            formdata.append("email", email);
            $.ajax({
                url: '/password/email',
                 xhrFields: {
                    withCredentials: true
                },
                type: 'POST',
                dataType: 'json',
                data: formdata,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    // $('#submit_profiledetail').prop('disabled', true);
                },
                complete: function () {
                    // $('#submit_profiledetail').prop('disabled', false);
                },
                success: function (response) {
                    showSystemMessages('#systemMessage_detail', response.type, response.msg);
                }
            });
        });
        /*$('#datepicker-on-change').Zebra_DatePicker({
            default_position: 'below',
            container: $('.datepicker-position')
        });
        $('#frm1_birthday').Zebra_DatePicker({
            default_position: 'below',
            direction: -1,
            format: 'm-d-Y',
            container: $('#datepicker-position')
        });*/
    });

    $(function () {
        $("#my_date_picker").datepicker({
            format: 'yy/mm/dd',
        });
    });

    $(document).on('click', '.delete', function () {
        var j = $(this).attr('num')
        var hell = $('.add-more-div').toArray();
        hell[j].remove();
        console.log($(this).attr('num'))
    });

    $('.add-more').click(function () {
        var lastcount = $('.delete').length + 1;
        var html = '<div class="row add-more-div"><hr />'
                + '<div class="col-sm-6">'
                + '<div class="row col-sm-12 text-left">'
                + '<label>Company Name<span class="color-red">*</span></label>'
                + ' </div>'
                + '<input type="text" name="Companyname" id="b_companyname" size="30" maxlength="80" placeholder="Company Name">'
                + ' <span class="error" id="b_cmpo"></span>'
                + '<div class="row col-sm-12 text-left">'
                + '<label>City<span class="color-red">*</span></label>'
                + '</div>'
                + '<input type="text" name="City" id="b_city" size="30" placeholder="City" size="30" maxlength="80"> '
                + '<span class="error" id="b_ct"></span>'
                + '<div class="row col-sm-12 text-left">'
                + '<label>Zip Code<span class="color-red">*</span></label>'
                + '</div>'
                + '<input type="number" name="Zip Code" id="b_zipcode" size="30" placeholder="Zip Code">'
                + '<span class="error" id="b_zip"></span>'
                + '<div class="row col-sm-12 text-left">'
                + '<label>EIN Number<span class="color-red">*</span></label>'
                + '</div>'
                + '<input type="text" name="b_EINnumber" maxlength="10" id="b_EINnumber" maxlength="10"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" placeholder="EIN Number">'
                + '<span class="error" id="b_ein"></span>'
                + '</div>'

                + '<div class="col-sm-6">'
                + '<div class="row col-sm-12 text-left">'
                + ' <label>Address<span class="color-red">*</span></label>'
                + ' </div>'
                + ' <input type="text" name="Address" id="b_address" placeholder="Address">'
                + ' <span class="error" id="b_addr"></span>'
                + ' <div class="row col-sm-12 text-left">'
                + ' <label>State<span class="color-red">*</span></label>'
                + ' </div>'
                + '<input type="text" name="State" id="b_state" size="30" placeholder="State" size="30" maxlength="80">'
                + '<span class="error" id="b_sta"></span>'

                + '<div class="row col-sm-12 text-left">'
                + '<label>Country<span class="color-red">*</span></label>'
                + '</div>'
                + '<input type="text" name="Country" value="" id="b_country" size="30" placeholder="Country">'

                + '<span class="error" id="b_cont"></span>'
                + '<div class="row col-sm-12 text-left">'
                + '<label>Establishment Year<span class="color-red">*</span></label>'
                + '</div>'
                + '<input type="number" name="b_Establishmentyear" id="b_Establishmentyear" size="30" maxlength="4" placeholder="Establishment Year" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">'
                + '<span class="error" id="b_estb"></span>'
                + '</div>'
                + '<div class="text-right">'
                + '<button type="button" class="btn btn-secondary delete" num="' + lastcount + '">Delete</button>'
                + '</div>'
                + '</div>'
        $("div.add-more-div:last").after(html);
        lastcout = lastcount + 1;
    })

    $('#b_v_2').click(function () {
        $(".error").empty();
        if ($("#frm_organisationname").val() != '') {
            if ($("#frm_position").val() != '') {
                if ($("#dp1").val() != '') {
                    if ($("#dp2").val() != '') {
                        if ($("#frm_course").val() != '') {
                            if ($("#frm_university").val() != '') {
                                if ($("#passingyear").val() != '') {
                                    if ($("#certification").val() != '') {
                                        if ($("#completionyear").val() != '') {
                                            if ($("#skiils_achievments_awards").val() != '') {
                                                if ($("#skillcompletionpicker").val() != '') {
                                                    $('#fitnessity_for_business_step2').hide();
                                                    $('#fitnessity_for_business_step3').show();
                                                } else {
                                                    $("#b_skillyear").text("Please Enter the skill completion date");
                                                }
                                            } else {
                                                $("#b_skilltype").text("Please select skill type");
                                            }
                                        } else {
                                            $("#b_certificateyear").text("Please Enter the Certication completion date");
                                        }
                                    } else {
                                        $("#b_certification").text("Please Enter the certification");
                                    }
                                } else {
                                    $("#b_year").text("Please select passing year ");
                                }

                            } else {
                                $("#b_university").text("Please Enter the university ");
                            }
                        } else {
                            $("#b_degree").text("Please enter the course ");
                        }
                    } else {
                        $("#b_employmentto").text("Please enter the to date ");
                    }
                } else {
                    $("#b_employmentfrom").text("Please enter the from date ");
                }
            } else {
                $("#b_position").text("Please enter the position ");
            }
        } else {
            $("#b_organisationname").text("Please enter the organisation name ");
        }

    });
    $("label.present_work_btn").click(function () {
        $("#frm_ispresentcheck").attr("checked", !$("#frm_ispresentcheck").attr("checked"));
        changeDateBasedonPresent();
    });

    function changeDateBasedonPresent()
    {
        if ($("#frm_ispresentcheck").attr("checked")) {
            $("#frm_ispresent").val("1");
            $("#dp2").val("Till Date");
            $("#dp2").attr("disabled", true);
        } else {
            $("#frm_ispresent").val("0");
            $("#dp2").val("");
            $("#dp2").attr("disabled", false);
        }
    }

    //     $('#passingyear').Zebra_DatePicker({
    //          view: 'years',
    //          format: 'Y',
    //         default_position: 'below',
    //         container : $('#passingpicker-position')      
    // });
    $('#dp1').Zebra_DatePicker({
        default_position: 'below',
        container: $('#dp1-position')
    });
    $('#dp2').Zebra_DatePicker({
        default_position: 'below',
        container: $('#dp2-position')
    });
    $('#completionyear').Zebra_DatePicker({
        default_position: 'below',
        container: $('#completionpicker-position')
    });
    $('#skillcompletionpicker').Zebra_DatePicker({
        default_position: 'below',
        container: $('#skillcompletionpicker-position')
    });

    $('#imagedropbox').click(function () {
        console.log("Photo Upload");
        $('#Modal').modal('show');
    });

    $('textarea#message_area').on('keyup', function () {
        var maxlen = $(this).attr('maxlength');

        var length = $(this).val().length;
        if (length > (maxlen - 10)) {
            $('#textarea_message').text('max length ' + maxlen + ' characters only!')
        } else
        {
            $('#textarea_message').text('');
        }
    });

    $('textarea#about_msg').on('keyup', function () {
        var maxlen = $(this).attr('maxlength');
        var length = $(this).val().length;
        if (length > (maxlen - 10)) {
            $('#aboutarea_message').text('max length ' + maxlen + ' characters only!')
        } else
        {
            $('#aboutarea_message').text('');
        }
    });

                   // Follow script
    /*$(".follower-fun").click(function () {
        var _token = $("input[name='_token']").val();
       
        $.ajax({
            type: 'POST',
            url: '{{route("follow_profile")}}',
            data: {
                _token: _token,
            },
            success: function (data) {
                //window.location.reload();
            }
        });
    });*/
                

    $('.usernameedit').click(function () {
       var edituser = $(this).attr('id');
       $('#username').val(edituser);
    });

     $(document).on('click', '.inquiryfrm', function () {
            
            var name = $('#name').val();
            var email = $('#email').val();
            var message = $('#message').val();

            var ret = true;
            
            $('#err_name_sign').html('');
            $('#err_email_sign').html('');
            $('#err_message_sign').html('');
            
            if(name == ''){
                $('#err_name_sign').html('Please enter name');
                $('#name').focus();
                //return false;
                return false;
            }
            if(email == ''){
                $('#err_email_sign').html('Please enter email');
                $('#email').focus();
                //return false;
                return false;
            }
            if(message == ''){
                $('#err_message_sign').html('Please enter message');
                $('#message').focus();
                //return false;
                return false;
            }
            
            if(ret == true){
            $('.get_started').submit();

        }
    });

    function sharediv(){
        $(".shareapp").css("display", "block");
    }

    $( document ).ready(function() {
          $('.removepost').removeClass('emoji-wysiwyg-editor');
          $('.removepost').removeAttr("data-id");
          $('.removepost').removeAttr("data-type");
          $('.removepost').removeAttr("contenteditable");
          $('.removepost').closest('.clickable').removeClass('grown').addClass('spot');
          $(".post-meta").find('i').removeClass("emoji-picker emoji-picker-icon fa fas fa-smile");

            var ret = true;
            $(document).on('click', '.profilepostbtn', function () {
            
                var post_text = $('#post_text').val();
                var image_post = $('#image_post').val();
                var video_post = $('#video').val();
                var music_post = $('#music_post').val();
                var selfieimg = $('#selfieimg').val();
                
                var ret = true;
                $('#err_image_sign').html('');
                $('#err_post_sign').html('');
                 
                if(post_text == '' && image_post == '' && video_post == '' && music_post == '' && selfieimg=="")
                {
                    $('#err_post_sign').html('Please add your post data!!!');
                    $('#post_text').focus();
                    ret=false;
                    return false;   
                }
                if(ret == true){
                    $('#profilepostfrm').submit();
                }       
            });

        $(document).on('click', '.postcomment', function () {
            var postId =$(this).attr('id');
            var comment = $('#comment'+postId).val();     
            var ret_post = true;
            $('#err_comment'+postId).html('');
            if(comment == ''){
                $('#err_comment'+postId).html('Please enter comment!');
                $('#comment').focus();
                return false;
            }
            if(ret_post == true){
                var _token = $("input[name='_token']").val();
                    $.ajax({
                    url: "{{url('/postcomment')}}" + "/"+postId,
                     xhrFields: {
                            withCredentials: true
                        },
                    type: 'post',
                    data:{
                        _token:_token,
                        comment:comment
                    },          
                    success: function (data) {
                        $('.commentappend'+postId).append(data.html);
                        $('#comment'+postId).val('');
                         $(".comment"+postId).load(" .comment"+postId+" > *");
                    }
                });
            }       
        });      
    });

    $(".followback").click(function(){
        var _token = $("input[name='_token']").val();
        var id = $(this).attr('id');
        var userid = $(this).attr('data-user');
        
        $.ajax({
            type: 'POST',
            url: '{{route("follow_back")}}',
             xhrFields: {
                withCredentials: true
            },
            data: {
              _token: _token,
              id:id,
              userid:userid
            },
            success: function(data) {
                if(data.type=='success'){ $("#myfollowers").load(" #myfollowers > *"); 
                    $(".followdiv").load(" .followdiv > *");
                }
            }
        });
    });

    $(document).on('click', '.savepost', function(){ 
        var _token = $("input[name='_token']").val();
        var postId =$(this).attr('postid');
        $.ajax({
            url: "{{url('/profilesavePost')}}",
             xhrFields: {
                withCredentials: true
            },
            type: 'post',
            data:{
                _token:_token,
                postid:postId,
            },
            success: function (data) {
                if(data.success=='success'){ 
                    $('#savepost'+postId).addClass("activesavedpost");
                }
                else if(data.success=='delsave'){ 
                    $('#savepost'+postId).removeClass("activesavedpost");
                }
            }
        });
    });

    $(".followProfile").click(function(){
        var _token = $("input[name='_token']").val();
        var profileid = $(this).attr('profileid');
        var userid = $(this).attr('userid');
        
        $.ajax({
            type: 'POST',
            url: '{{route("followProfile")}}',
             xhrFields: {
                withCredentials: true
            },
            data: {
              _token: _token,
              profileid:profileid,
              userid:userid
            },
            success: function(data) { 
                if(data.type=='success'){ 
                    $("#profileControls").load(" #profileControls > *"); 
                    $(".followdiv").load(" .followdiv > *"); 
                    $("#myfollowers").load(" #myfollowers > *"); 
                    $("#timeline").load(" #timeline > *"); 
                }
            }
        });
    });

</script>

<script>
    function fbPost(){
      window.fbAsyncInit = function() {
        FB.init({
          appId            : '320348730100999',
          autoLogAppEvents : true,
          xfbml            : true,
          version          : 'v12.0'
        });
      };
    }
</script>

<script>
    $("#myDate").datepicker({ 
    // OPTIONS HERE
    });
</script>

<script>
    $("#myDate").datepicker({ 
       // an array of excluded dates
        disableddates: [new Date("04/24/2015"), new Date("04/21/2015")],
        // an array of pre-selected dates
        daterange: [new Date("3/1/2014"),new Date("3/2/2014"),new Date("3/3/2014")],
        // appearance options
        showButtonPanel:true,  
        showWeek: true,
        firstDay: 1
    });
</script>

<script>
    var r = $("#myDate").datepicker({ 
    // OPTIONS HERE
    });
    r.getDateRange()
</script>

<!-- <script>
    document.querySelector('.show-btn').addEventListener('click', function() {
      document.querySelector('.sm-menu').classList.toggle('active');
    });
</script> -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>




@endsection
            
