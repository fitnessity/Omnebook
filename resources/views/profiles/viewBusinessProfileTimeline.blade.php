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
    <link rel="stylesheet" type="text/css" href="<?php echo Config::get('constants.FRONT_CSS'); ?>all.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Config::get('constants.FRONT_CSS'); ?>stylenew.css">
   <!--  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" type="text/css" href="{{ url('public/css/pixelarity.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('public/css/profile.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link href="{{ url('public/emoji/lib/css/emoji.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ url('public/css/comment-icons.css') }}">
    <?php /*?><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><?php */?>
	<link rel="stylesheet" type="text/css" href="{{ url('public/css/frontend/businessprofile.css') }}">
    <link rel="stylesheet" href="{{ url('public/css/frontend/jquery.fancybox.min.css') }}">
</head>
@section('content')
<?php
	use App\CompanyInformation;
	use App\Review; 
	use App\User;
	use App\PagePost;
	use App\PagePostComments;
	use App\PagePostCommentsLike;
	use App\PagePostLikes;
	use App\PagePostSave;
	use App\Http\Requests;
	use App\PageLike;
    use App\BusinessPostViews;
    
?>
<style>
    .removepost{ height: auto !important; }
</style>
<?php
$loggedinUserorignal = '';
$compinfo = CompanyInformation::where('id',request()->id)->first();
$loggedinUser = User::where('id',$compinfo->user_id)->first();
$customerName = @$loggedinUser->firstname . ' ' . @$loggedinUser->lastname;
$loggedinUserorignal = Auth::user();
$profilePicture = @$loggedinUser->profile_pic;
$coverPicture = @$loggedinUser->cover_photo;

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

<div class="banner banner-fs bannerstyle">
    <?php   $totalcount = count($viewgallery);
        $rem = 4 -$totalcount;
    ?>
    @if (!empty($viewgallery))
        @foreach (array_slice($viewgallery, 0, 4) as $pic)
            <div class="business-slider">
                <img src="/public/uploads/page-cover-photo/thumb/<?= $pic['name'] ?>" alt="images" class="img-fluid">
                @if(@$loggedinUserorignal->id == $pic['user_id'])
                    <i class="fa fa-pen editpic editpic-fs"  id="{{$pic['id']}}"  imgname="{{$pic['name']}}" data-toggle="modal" data-target="#uploadgalaryPic"></i>
                @endif
            </div>
        @endforeach
    @endif
    @for($i=0 ; $i<$rem ; $i++)
    <div class="business-slider">
        <img src="/public/images/newimage/uploadphoto.jpg" alt="images" class="img-fluid">
        <i class="fa fa-pen editpic editpic-fs" id="0" imgname="10.jpg" data-toggle="modal" data-target="#uploadCoverPic"></i>
    </div>
    @endfor
</div>


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
            <div class="col-lg-2">
                <div class="comp-mark">
                 
                    @if($compinfo->logo != '' && File::exists(public_path("/uploads/profile_pic/thumb/".$compinfo->logo)))
                        <img src="{{ url('/public/uploads/profile_pic/thumb/'.$compinfo->logo) }}" alt="images" class="img-fluid">
                    @else
                    	<?php
                    	echo '<div class="company-profile-text">';
						$pf=substr($compinfo->company_name, 0, 1);
						echo '<p>'.$pf.'</p></div>';
						?>
                    @endif
                    <a href="javascript:void(0);" class="edit-pic" data-toggle="modal" data-target="#editProfilePic" title="Click here to change picture">
                        <div id="mycamera" class="profile-cam">
                            <span class="fa fa-camera set-camera"></span>
                        </div>
                    </a>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="get_started" role="dialog">
                    {!! Form::open(array('url'=>url('/profile/inquirySubmit'),'method'=>'POST','class'=>'get_started')) !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-body login-pad">
                                <div class="pop-title employe-title">
                                    <h3>Inquiry Box </h3>
                                </div> 
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

            <div class="col-lg-6">
                <div class="bnr-information">
                    <h2 style="text-transform: capitalize;">{{$compinfo->company_name}}<!-- <i class="fa fa-pencil usernameedit" id="{{$customerName}}" style="color: #f53b49" data-toggle="modal" data-target="#editusername"></i>-->
                    <?php /*?><span>Claimed</span><?php */?>
					<!--<img src="https://upload.wikimedia.org/wikipedia/en/a/a4/Flag_of_the_United_States.svg" alt="images" width="45" height="20">-->
					</h2>
                    @if(isset($compinfo->about_company))
                    	<h6> {{$compinfo->about_company}} </h6>
                    @endif
					<div class="url-copy">	
						<div> 
							<p>
								<a href="<?php echo config('app.url'); ?>/businessprofile/<?php echo strtolower(str_replace(' ', '', $compinfo->company_name)).'/'.$compinfo->id;; ?>">
									<?php echo config('app.url'); ?>/businessprofile/<?php echo strtolower(str_replace(' ', '', $compinfo->company_name)).'/'.$compinfo->id;; ?> </a> </p>
							<!-- <button onclick="myFunction()" style="background: white;border: none; margin-left: 10px;">Copy URL</button>-->
					   </div>
					</div>
                </div>
            </div>

            <div class="col-lg-4 top-1">
                <div class="reatingbox">
                  <?php /*?><h5> <i class="fa fa-star rating-pro"></i><span>5.0 </span>(100) </h5><?php */?>
                  <ul class="profile-controls" id="profilecontrol">
                  	<?php
					$PageLike = PageLike::where('pageid',$compinfo->id)->where('follower_id',@$loggedinUserorignal->id)->first(); ?>
					<?php if($PageLike) { ?>
                    	<li> <p class="following-tag"> Following </p> </li>
                    <?php } else { ?> 
                    	<li><a href="javascript:void(0);" class="followPage" title="Follow" pageid="{{$compinfo->id}}" userid="{{@$loggedinUserorignal->id}}"><i class="fa fa-star"></i></a></li>
                    <?php } ?>
                  </ul>
							
                  <div class="social">
				
                       <!--  <ul>
                        <li>http://fitnessity.co/yournamehere 
                        <button onclick="myFunction()" style="background: white;border: none; margin-left: 10px;">Copy URL</button></li>
                        </ul>-->
						
						 <!--<ul>
                            <li><a href="javascript:void(0);">0 Favourite </a></li>
                            <li><a class="follower-fun" href="javascript:void(0);">0 Followers </a></li>
                            <!--<li><a onclick="sharediv();" href="javascript:void(0);"><img src="/public/images/newimage/share.png" alt="icon">Share</a></li> 					
                        </ul>-->	
						<!--<ul class="menu bottomLeft">
						  <li class="share right">
							<i class="fa fa-share-alt"></i>
							<ul class="submenu">
							  <li><a href="http://fitnessity.co/" class="share facebook"><i class="fa fa-facebook"></i></a></li>
							  <li><a href="http://fitnessity.co/" class="share twitter"><i class="fa fa-twitter"></i></a></li>
							  <!-- <li><a href="#" class="googlePlus"><i class="fa fa-google-plus"></i></a></li> 
							  <li><a href="http://fitnessity.co/" class="share linkedin"><i class="fa fa-linkedin"></i></a></li>
							</ul>
						  </li>
						</ul>-->
						<!--<div class="social-icon-ph">
						<ul class="mobile-social">
							 	
							  <li><a href="#" class="facebook"><img src="/public/img/fb.png"></a></li>
							  <li><a href="#" class="twitter"><img src="/public/img/google.png"></a></li>
							  <li><a href="#" class="googlePlus"><img src="/public/img/twitter-1.png"></a></li>
							  <li><a href="#" class="linkedin"><img src="/public/img/linkedin.png"></a></li>
							</ul>
						</div>-->
                      <!-- <ul>
                            <li><a href="javascript:void(0);">0 Favourite </a></li>
                            <li><a class="follower-fun" href="javascript:void(0);">0 Followers </a></li>
                            <li><a onclick="sharediv();" href="javascript:void(0);"><img src="/public/images/newimage/share.png" alt="icon">Share</a></li>                            
                        </ul>                        
                    </div>
                    <div class="shareapp" style="display: none;">
                        <a href="http://fitnessity.co/" class="share facebook btn btn-primary"><i class="fa fa-facebook"></i> Facebook</a>
                            <a href="http://fitnessity.co/" data-text="7000+ latest Free jQuery plugins with examples and tutorials for web &amp; mobile developers." class="share twitter btn btn-info"><i class="fa fa-twitter"></i> Twitter</a>
                            <a href="http://fitnessity.co/" data-text="7000+ latest Free jQuery plugins with examples and tutorials for web &amp; mobile developers." class="share linkedin btn btn-default"><i class="fa fa-linkedin"></i> LinkedIn</a>
                            <a href="http://fitnessity.co/" class="share google-plus btn btn-danger"><i class="fa fa-google-plus"></i> Google Plus</a>
                    </div>-->
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal" id="uploadCoverPic" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body login-pad">
                <div class="pop-title employe-title">
                    <h3>Change Cover Photo</h3>
                </div>
                <button type="button" class="close modal-close" data-dismiss="modal">
                    <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                </button>
                <div class="signup">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="cover-tagbox">
                                <i class="fas fa-info-circle"></i>
                                <span>Your Cover Photo will be used to customize the header of your profile.</span>
                            </div>
                            <div class="file-upload">
                                <form name="frm_cover" id="frm_cover" action="{{Route('savepagecoverphoto')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="image-upload-wrap piccrop_block" id="file1"@if(@$UserProfileDetail['cover_photo']!="" ) style="display: none;" @endif>
                                         <input class="file-upload-input" name="coverphoto" id="coverphoto" type='file' onchange="readURL(this);" accept="image/*" />

                                        <div class="drag-text">
                                            <h3>Drop your image here</h3>
                                            <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger('click')">Select Your File</button>
                                        </div>
                                        <img class="card-img-top" id="thumb-2" src="">
                                    </div>
                                    @if ($errors->has('coverphoto'))
                                    <span class="help-block" style="color:red">
                                        <strong>Upload your photo</strong>
                                    </span>
                                    @endif
                                   <!--  <div class="file-upload-content piccrop_block" id="file1"@if(@$UserProfileDetail['cover_photo']!="" ) style="display: block;" @endif>
                                         @php
                                         if(@$UserProfileDetail['cover_photo']!="")
                                         $path='public/uploads/cover-photo/'.$UserProfileDetail['cover_photo'];
                                         else
                                         $path="#"

                                         @endphp
                                         <img class="file-upload-image" src="/{{$path}}" alt="your image" height="100px" />
                                    </div>-->
                                    <div>
                                    </div>
                                    <div class="highlighted-txt-yellow">
                                        For best result, upload an image that is 800px by 450px or larger.
                                    </div>

                                   <!--  <p>If you'd like to delete your current cover photo, use the delete Cover Photo button.</p> -->

                                    <div class="image-title-wrap">
                                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                        <input type="hidden" name="page_id" value="{{request()->id}}">
                                        <button type="submit" id="submit_cover" name="submit_cover" class="remove-image">Save My Cover Photo</button>
                                        &nbsp;&nbsp;
                                        <button type="button" style="background:#000" onclick="" class="remove-image">Delete My Cover Photo</button>

                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal" id="uploadgalaryPic" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body login-pad">  
                <div class="pop-title employe-title">
                    <h3>Change Photo</h3>
                </div>
                <button type="button" class="close modal-close" data-dismiss="modal">
                    <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                </button>
                <div class="signup">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <div class="cover-tagbox">
                                <i class="fas fa-info-circle"></i>
                                <span>Your Cover Photo will be used to customize the header of your profile.</span><br>
                                <span>Required Dimensions for Your Cover Photo Is 800 X 450.</span>
                            </div>
                            <div class="file-upload">
                                <form name="frm_cover" id="frm_cover" action="{{Route('savegallarypics')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="pageid" value="{{request()->id}}">
                                    <div class="image-upload-wrap piccrop_block" id="file1">
                                        <input class="file-upload-input" name="galaryphoto" id="galaryphoto" type='file' onchange="readURL(this);" accept="image/*" />

                                        <div class="drag-text">
                                            <h3>Drop your image here</h3>
                                            <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger('click')">Select Your File</button>
                                        </div>
                                        <img class="card-img-top" id="thumb-2" src="">
                                    </div>
                                    @if ($errors->has('coverphoto'))
                                    <span class="help-block" style="color:red">
                                        <strong>Upload your photo</strong>
                                    </span>
                                    @endif
                                    <div class="" id="file1">
                                        <input type="hidden" name="imgId" id="imgId">
                                        <input type="hidden" name="imgname" id="imgname">
                                         <img class="file-upload-image srcappend" src="/{{$path}}" alt="your image" height="100px" />
                                    </div>
                                    <div>
                                    </div>
                                    &nbsp;
                                    <div class="image-title-wrap">
                                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                        <button type="submit" id="submit_cover" name="submit_cover" class="remove-image">Save My Cover Photo</button>
                                        &nbsp;&nbsp;
                                    </div>
                                    &nbsp;
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                                            <ins><a href="#" title="">{{ucfirst(@$loggedinUser->firstname)}} {{ucfirst(@$loggedinUser->lastname)}}</a> Post Album</ins>
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

<section class="desc-sec">
    <div class="container-fluid">
        <div class="row">
        	<div class="col-sm-12 col-md-3 col-lg-3">
            	@include('profiles.viewbusinessProfileLeftPanel')
            </div>
			
            <div class="col-sm-12 col-md-9 col-lg-9">
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="profile-section">
					<div class="row">
						<div class="col-sm-12 col-md-8 col-lg-8">
						<ul class="nav nav-tabs" role="tablist">
                        	
							<li class="active">
                                <a class="nav-link" data-toggle="tab" href="#timeline" role="tab">Timeline</a>
                            </li>
                           <li>
                                <a class="nav-link" data-toggle="tab" href="#photos" role="tab">Photos</a>
                            </li>
                            <li>
                                <a class="nav-link" data-toggle="tab" href="#videos" role="tab">Videos</a>
                            </li>
                            <li>
                                <a class="nav-link" data-toggle="tab" href="#saved" role="tab">
                                Saved</a>
                            </li>

                            <li>
                                @if(@$loggedinUserorignal->id == @$pic['user_id'])
                                    <a class="nav-link" href="{{url('/profile/viewbusinessProfile/'.$compinfo->id)}}" >About</a>
                                @else
                                <?php $comUrl = strtolower(str_replace(' ', '', $compinfo->company_name)).'/'.$compinfo->id; ?>
                                    <a class="nav-link" href="{{url('/businessprofile/'.$comUrl)}}">About</a>
                                @endif
                            </li>
                            
						</ul>
					</div>
					<div class="col-sm-12 col-md-4 col-lg-4">
						<ol class="folw-detail">
                        	<?php 
							$totpost = PagePost::where('user_id', $compinfo->user_id)->where('page_id', request()->id)->count(); 
							$totFollowers = PageLike::where('pageid', request()->id)->count();
							?>
							<li><span>Posts</span><ins><?php echo $totpost; ?></ins></li>
							<li><span>Followers</span><ins><?php echo $totFollowers; ?></ins></li>
						</ol>
					</div>
				</div>
			</div>
		</div>
										
		<div class="col-sm-12 col-md-8 col-lg-8">
        	<div class="tab-content">

    			<div class="tab-pane active" id="timeline" role="tabpanel">
                    <?php  if(@$loggedinUserorignal->id == $company->user_id) { ?>
                        <div class="central-meta postbox">
                            <form method="post" action="{{route('pagePost')}}" enctype="multipart/form-data" id="profilepostfrm">
                                @csrf
        						<span class="create-post">Create post </span>
        						<div class="post-img figure">
        							@if($company['logo'] != '' && File::exists(public_path("/uploads/profile_pic/thumb/".$company['logo'])))
                                    <img src="{{ url('/public/uploads/profile_pic/thumb/'.$company['logo']) }}" alt="fitnessity" class="img-fluid">
                                    @else
                                        <?php
                                        echo '<div class="company-img-text">';
                                        $pf=substr($company->company_name, 0, 1);
                                        echo '<p>'.$pf.'</p></div>';
                                        ?>
                                    @endif
        						</div>
                                
        						<div class="newpst-input">
        							<textarea rows="4" id="post_text" name="post_text" placeholder="Share some what you are thinking?" data-emojiable="true" required></textarea>
                                    <span class="error" id="err_post_sign"></span>
        						</div>
                                <div class="postImage"></div>
        						<div class="attachments">
        							<ul>
                                    	<li><span class="add-loc"><i class="fa fa-location-dot"></i></span></li>
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
                                        </li>
                                        <li class="emojili"><div class="emojilidiv"> </div></li>
        								<li class="preview-btn">
                                        	<button class="post-btn-preview preview" type="button" data-ripple="">Preview</button>
        								</li>
        							</ul>
                                    <div id="results" class="selfieresult"></div>
                                    <input type="hidden" name="selfieimg" id="selfieimg" class="image-tag">
                                    <input id="page_id" name="page_id" type="hidden" value="{{ request()->id }}"/>
                                    
        							<button class="post-btn profilepostbtn" type="button" data-ripple="">Post</button>
        						</div>
                            </form>
        				</div>
                    <?php } ?>
            		<div class="loadMore"> <?php $p=1; ?>
                        @foreach($page_posts as $page_post)
                        <?php 
                        	$PageData = CompanyInformation::where('id',$page_post->page_id)->first();
                        ?>
							<div class="central-meta item" id="listpostid<?php echo $page_post->id; ?>">
								<div class="user-post">
									<div class="friend-info">
                                    	<figure>
                                            @if($compinfo['logo'] != '' && File::exists(public_path("/uploads/profile_pic/thumb/".$compinfo['logo'])))
                                            <img src="{{ url('/public/uploads/profile_pic/thumb/'.$compinfo['logo']) }}" alt="fitnessity" class="img-fluid">
                                            @else
                                                <?php
                                                echo '<div class="company-img-text">';
                                                $pf=substr($compinfo->company_name, 0, 1);
                                                echo '<p>'.$pf.'</p></div>';
                                                ?>
                                            @endif
										</figure>
                                        @if(@$loggedinUserorignal->id == $page_post['user_id'])
										<div class="friend-name">
                                            <div class="more">
												<div class="more-post-optns"><i class="fa fa-ellipsis-h"></i>
													<ul>
														
                                                    	<li><a id="{{$page_post['id']}}" class="editpopup" href="javascript:void(0);"><i class="fa fa-pencil-square-o"></i>Edit Post</a></li>
                                                        <li><a href="javascript:void(0);" class="delpagepost" postid="{{$page_post['id']}}" posttype="post" ><i class="fa fa-trash"></i>Delete Post</a></li>
                                                        
														<!--<li class="bad-report"><i class="fa fa-flag"></i>Report Post</li>
														<li><i class="fa fa-address-card"></i>Boost This Post</li>
                                                        <li><i class="fa fa-clock-o"></i>Schedule Post</li>
                                                        <li><i class="fab fa-wpexplorer"></i>Select as featured</li>
                                                        <li><i class="fa fa-bell-slash"></i>Turn off Notifications</li>-->
													</ul>
												</div>
											</div>
											<ins><a href="#" title="">{{ucfirst($PageData->company_name)}} </a> Post Album</ins>
											<span><i class="fa fa-globe"></i> published: {{date('F, j Y H:i:s A', strtotime($page_post->created_at))}}</span>
										</div>
                                        @endif
										<div class="post-meta">
                                        <?php if( !empty($page_post->post_text) ){ ?>
                                            <input type="text" name="abc" data-emojiable="true" data-emoji-input="image" class="removepost" value="{{$page_post->post_text}}" disabled="">
                                        <?php } ?>
											<!-- <p  data-emojiable="true" data-emoji-input="image">
												{{$page_post->post_text}}
											</p> -->
                                            <?php
												$userid = $page_post->user_id;
												$count = count(explode("|",$page_post->images));
												$countimg = $count-5;
												$getimages = explode("|",$page_post->images);
                                            ?> 
											<figure>
												@if(isset($page_post->video))
													<div class="img-bunch">
														<div class="row">
															<div class="col-lg-12 col-md-12 col-sm-12">
																<figure>
																	<a href="#" title="" data-toggle="modal" data-target="#img-comt">
																	<video controls class="thumb"  style="width: 100%;"  id="vedio{{$page_post->id}}">
																		<source src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/video/{{$page_post->video}}" type="video/mp4">
																	</video>
																	</a>
																</figure>
                                                                <script type="text/javascript">
                                                                    /*const svid = '';
                                                                    svid = document.getElementById('vedio{{$page_post->id}}');*/

                                                                    ['playing'].forEach(t => 
                                                                       document.getElementById('vedio{{$page_post->id}}').addEventListener(t, e => vediopostviews('{{$page_post->id}}'))
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
																		<audio src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/music/{{$page_post->music}}" controls></audio>
																	</a>
																</figure>
															</div>
														</div>
													</div>
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
                                                                        <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$img}}" class="postfancyimg" data-fancybox="gallery{{$page_post->id}}">
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
                                                                        	<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" class="postfancyimg" data-fancybox="gallery{{$page_post->id}}">
                                                                            	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="fitnessity">
    																		</a>
    																	</figure>
    																@endif
                                                                    @if(isset($getimages[1]))
    																	<figure>
                                                                        	<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" class="postfancyimg" data-fancybox="gallery{{$page_post->id}}">
                                                                            	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="fitnessity">
    																		</a>
    																	</figure>
    																@endif
    															</div>
                                                                <div class="col-lg-6 col-md-6 col-sm-6">
    																@if(isset($getimages[2]))
    																	<figure>
                                                                        	<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" class="postfancyimg" data-fancybox="gallery{{$page_post->id}}">
                                                                            	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" alt="fitnessity">
    																		</a>
    																	</figure>
    																@endif
                                                                    @if(isset($getimages[3]))
    																	<figure>
                                                                        	<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[3]}}" class="postfancyimg" data-fancybox="gallery{{$page_post->id}}">
                                                                            	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[3]}}" alt="fitnessity">
                                                                            </a>
    																	</figure>
    																@endif
                                                                    @if(isset($getimages[4]))
    																	<figure>
                                                                        	<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[4]}}" class="postfancyimg" data-fancybox="gallery{{$page_post->id}}">
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
                                                                	<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" class="postfancyimg" data-fancybox="gallery{{$page_post->id}}">
                                                                    	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="fitnessity">
																	</a>
																</figure>
															</div>
														</div>
                                                        <div class="row">   
															<div class="col-lg-4 col-md-4 col-sm-4"> 
																<figure>
                                                                	<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" class="postfancyimg" data-fancybox="gallery{{$page_post->id}}">
                                                                    	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="fitnessity" height="170">
																	</a>
																</figure>   
															</div> 
                                                            <div class="col-lg-4 col-md-4 col-sm-4"> 
																<figure>
                                                                	<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" class="postfancyimg" data-fancybox="gallery{{$page_post->id}}">
                                                                    	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" alt="" height="170">
																	</a>
																</figure>    
															</div> 
                                                            <div class="col-lg-4 col-md-4 col-sm-4">  
																<figure>
                                                                	<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[3]}}" class="postfancyimg" data-fancybox="gallery{{$page_post->id}}">
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
																	<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" class="postfancyimg" data-fancybox="gallery{{$page_post->id}}">
                                                                    	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="fitnessity" width="100" height="335">
																	</a>
																</figure>
															</div>
															<div class="col-lg-6 col-md-6 col-sm-6">
																<figure>
																	<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" class="postfancyimg" data-fancybox="gallery{{$page_post->id}}">
                                                                    	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="fitnessity" width="100" height="165">
																	</a>
																</figure>
																<figure>
                                                                	<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" class="postfancyimg" data-fancybox="gallery{{$page_post->id}}">
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
                                                                	<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" class="postfancyimg" data-fancybox="gallery{{$page_post->id}}">
                                                                    	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="">
																	</a>
																</figure>
															</div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
																<figure>
																	<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" class="postfancyimg" data-fancybox="gallery{{$page_post->id}}">
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
																	<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" class="postfancyimg" data-fancybox="gallery{{$page_post->id}}">
                                                                    	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="fitnessity">
                                                                    </a>
																</figure>
															</div>
														</div>
													</div>
												@endif
                                                    <?php
														$page_posts_like = PagePostLikes::where('post_id',$page_post['id'])->where('is_like',1)->count();
														$likemore = $page_posts_like-2;
														$loginuser_like = PagePostLikes::where('post_id',$page_post['id'])->where('is_like',1)->where('user_id',@$loggedinUser->id)->first();
														$seconduser_like = PagePostLikes::where('post_id',$page_post['id'])->where('is_like',1)->where('user_id','!=',@$loggedinUser->id)->first();
                                                        $total_comment='';
														$total_comment = PagePostComments::where('post_id',$page_post->id)->count();$postsaved="";
														$postsaved = PagePostSave::where('post_id',$page_post['id'])->where('user_id',@$loggedinUser->id)->first();
														$activethumblike=''; $savedpost='';
														if( !empty($postsaved) ){ $savedpost='activesavedpost'; }
													?>
                                                    <ul class="like-dislike" id="ulike-dislike<?php echo $page_post->id; ?>">
                                                    <?php $loginuser_like = PagePostLikes::where('post_id',$page_post['id'])->where('is_like',1)->where('user_id',@$loggedinUser->id)->first(); ?>
                                                    	@if(!empty($loginuser_like))
															<?php $activethumblike='activethumblike'; ?>
														@endif
                                                        <li><a id="savepost{{$page_post['id']}}" class="bg-purple savepost <?php echo $savedpost; ?>" href="javascript:void(0);" title="Save to Pin Post" postid="{{$page_post['id']}}" pageid="{{ request()->id }}">
															<i class="thumbtrack fas fa-thumbtack"></i></a>
														</li>
                                                       <?php /*?> <li><a class="<?php echo $activethumblike; ?>" href="javascript:void(0);" title="Like Post"><i id="{{$page_post['id']}}" is_like="1" class="thumbup thumblike fas fa-thumbs-up"></i></a></li><?php */?>
                                                        <li><a class="thumbup thumblike <?php echo $activethumblike; ?>" href="javascript:void(0);" title="Like Post" id="like-thumb<?php echo $page_post->id; ?>" postid="{{$page_post['id']}}" is_like="1" posttype="pagepost" ><i class="fas fa-thumbs-up"></i></a></li>
                                                        <li><a class="bg-red" href="javascript:void(0);" title="dislike Post"><i id="{{$page_post['id']}}"  postid="{{$page_post['id']}}" is_like="0" class="thumpdown thumblike fas fa-thumbs-down"></i></i></a></li>
													</ul>
											</figure>
											<div class="we-video-info">
												<ul class ="postinfoul{{$page_post['id']}}">
                                                    @if(isset($page_post->video))
                                                        <?php 
                                                            $ppvcnt = BusinessPostViews::where('post_id' , $page_post->id)->count();
                                                        ?>
                                                        <li>
                                                            <span class="views" title="views">
                                                                <i class="eyeview fas fa-eye"></i>
                                                                <ins>{{$ppvcnt}}</ins>
                                                            </span>
                                                        </li>
                                                    @endif
													<li>
														<div class="likes heart" title="Like/Dislike">
                                                        	<i class="fas fa-heart"></i>
                                                        	<span id="likecount{{$page_post['id']}}">{{$page_posts_like}}</span>
                                                        </div>
													</li>
													<li>
														<span class="commentalbum{{$page_post->id}}"  title="Comments">
															<i class="commentdots fas fa-comment-dots"></i>
															<ins>{{ $total_comment}}</ins>
														</span>
													</li>
													<?php /*?><li>
														<span>
															<a class="share-pst" href="javascript:void(0);" onclick="fbPost()" title="Share">
																<i class="sharealt fas fa-share-alt"></i>
															</a>
															<ins>20</ins>
														</span>	
													</li><?php */?>
												</ul>
												<div class="users-thumb-list" id="users-thumb-list<?php echo $page_post->id; ?>">
													<?php
                                                    	$page_posts_like = PagePostLikes::where('post_id',$page_post->id)->where('is_like',1)->count(); ?>
                                                        @if($page_posts_like>0)
															@if(!empty($loginuser_like))
																<a data-toggle="tooltip" title="" href="#">
                                                                	<img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.@$loggedinUser->profile_pic) }}" height="32" width="32">  
                                                                </a>
                                                            @endif
                                                   			<?php 
																$profile_posts_all = PagePostLikes::where('post_id',$page_post->id)->where('is_like',1)->where('user_id','!=',@$loggedinUser->id)->limit(4)->get();?>
                                                                @if(isset($profile_posts_all[0]))
																	<?php $seconduser = User::find($profile_posts_all[0]->user_id); ?>
                                                                	<a data-toggle="tooltip" title="" href="#">
																		<img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$seconduser->profile_pic) }}" height="32" width="32">  
																	</a>
																@endif
                                                                @if(isset($profile_posts_all[1]))
																	<?php $thirduser = User::find($profile_posts_all[1]->user_id); ?>
                                                                    <a data-toggle="tooltip" title="" href="#">
																		<img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$thirduser->profile_pic) }}" height="32" width="32">  
																	</a>
																@endif
                                                                @if(isset($profile_posts_all[2]))
																	<?php $fourthuser = User::find($profile_posts_all[2]->user_id); ?>
                                                                    <a data-toggle="tooltip" title="" href="#">
																		<img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$fourthuser->profile_pic) }}" height="32" width="32">  
																	</a>
																@endif
                                                                @if(isset($profile_posts_all[3]))
																	<?php $fifthuser = User::find($profile_posts_all[3]->user_id); ?>
                                                                    <a data-toggle="tooltip" title="" href="#">
																		<img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$fifthuser->profile_pic) }}" height="32" width="32">  
																	</a>
																@endif
                                                                <span>
                                                                	<strong>
                                                                    	@if(!empty($loginuser_like))
                                                                        	You
																		@endif
																	</strong>
                                                                    @if(!empty($seconduser_like))
																		<?php $secondusername = User::where('id',$seconduser_like->user_id)->first(); ?>,<b>{{$secondusername->username}}</b>
                                                                    @endif
            														@if($page_posts_like>2)
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
												$comments = PagePostComments::where('post_id',$page_post->id)->limit(2)->get();
                                                $allcomments = PagePostComments::where('post_id',$page_post->id)->get();
                                                ?>
                                                @if(count($comments) > 0)
                                                	@foreach($comments as $comment)
                                                    	<?php
                                                        	$username = User::find($comment->user_id);
															$cmntlike = PagePostCommentsLike::where('comment_id', $comment->id)->count();
															$cmntUlike = PagePostCommentsLike::where('comment_id',$comment->id)->where('user_id',@$loggedinUser->id)->count();
                                                        ?>
                                                        <li class="commentappendremove">
                                                            <div class="comet-avatar">
                                                            	<?php if($username->profile_pic  != '' && File::exists(public_path("/uploads/profile_pic/thumb/".$username->profile_pic ))){ ?>
                                                                	<img src="{{ url('/public/uploads/profile_pic/thumb/'.$username->profile_pic) }}" alt="Fitnessity">
                                                                <?php }else{ 
																	$pf=substr($username->firstname, 0, 1).substr($username->lastname, 0, 1);
																	echo '<div class="admin-img-text"><p>'.$pf.'</p></div>';
																} ?>
                                                            </div>
                                                            <div class="we-comment">
                                                                <h5><a href="javascript:void(0);" title="">{{$username->firstname}} {{$username->lastname}}</a></h5>
                                                                <p>{{$comment->comment}}</p>
                                                                <div class="inline-itms">
                                                                    <span>{{$comment->created_at->diffForHumans()}}</span>
                                                                    <a href="javascript:void(0);" class="commentlike" id="{{$comment->id}}" post-id="{{$page_post->id}}" ><i class="fa fa-heart <?php if($cmntUlike>0){ echo 'commentLiked'; } ?>" id="comlikei<?php echo $comment->id; ?>"></i><span id="comlikecounter<?php echo $comment->id; ?>"><?php echo $cmntlike; ?></span></a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                	@endforeach
                                                @endif
                                                <li class="commentappend{{$page_post->id}}"></li>
                                                @if(count($allcomments) > 2)
                                                	<input type="hidden" name="commentdisplay" id="commentdisplay" value="5">
													<li>
                                                    	<a id="{{$page_post->id}}" href="javascript:void(0);" title="" class="showcomments showmore underline">more comments+</a>
                                                   	</li>
                                                @endif
												<li class="post-comment">
                                                	<div class="comet-avatar">

                                                @if(@$loggedinUserorignal->profile_pic  != '' &&  File::exists(public_path("/uploads/profile_pic/thumb/".@$loggedinUserorignal->profile_pic  )))
                                                	<img src="{{ url('/public/uploads/profile_pic/thumb/'.@$loggedinUserorignal->profile_pic ) }}" alt="fitnessity" >
                                                @else
                                                    <?php
                                                    echo '<div class="company-img-text">';
                                                    $pf=substr(@$loggedinUserorignal->firstname, 0, 1).substr(@$loggedinUserorignal->lastname, 0, 1);
                                                    echo '<p>'.$pf.'</p></div>';
                                                    ?>
                                                @endif
													</div>
                                                    <div class="post-comt-box">
                                                    	<form method="post" id="commentfrm">
															<textarea placeholder="Post your comment" name="comment" id="comment{{$page_post->id}}"></textarea>
                                                            <span class="error" id="err_comment{{$page_post->id}}"></span>
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
                                                            <button id="{{$page_post->id}}" type_comment="normal" class="postcomment theme-red-bgcolor" type="button">Post</button>
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
						<div class="content-dash" id="scroll_pagination"></div>
    				</div><!-- Timeline -->
    			</div>

                <div class="tab-pane" id="photos" role="tabpanel">
                    <div class="desc-text" id="mydesc">
                        <div class="row">
                            <?php 
                                if (!empty($images)) 
                                {
                                    $y=0;
                                    foreach($images as $data)
                                    {
                                        $img_part = explode("|",$data->images);
                                        $imgCount = count($img_part);
                                        for ($i=0; $i <$imgCount ; $i++) 
                                        { 
                                            if($y<12){?>
                                                <div class="col-sm-3 col-md-4 col-lg-4">
                                                    <div class="photo-tab-imgs">
                                                        <figure>
                                                            <a href="{{asset('public/uploads/gallery/')}}/{{$data->user_id}}/{{$img_part[$i]}}" class="postfancyimg" data-fancybox="photogallery">
                                                                <img height="170" width="170" class="bixrwtb6" src="{{asset('public/uploads/gallery/')}}/{{$data->user_id}}/{{$img_part[$i]}}">
                                                            </a>
                                                        </figure>
                                                    </div>
                                                </div>
                                            <?php }
                                            $y++;
                                        }
                                    }
                                }
                            ?>
                        </div>

                       <?php $companyUrl = strtolower(str_replace(' ', '', $compinfo->company_name)).'/'.$compinfo->id; ?>
                        <span >
                            <a href="{{url('/businessprofile/'.$companyUrl.'#photos')}}" class="show-more-photos"> Show More <i class="fas fa-caret-right"></i> </a>
                        </span> 
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
                <div class="tab-pane" id="saved" role="tabpanel">
                    <div class="loadMore">

                        @if(!empty($postsavedtab))

                        @foreach($postsavedtab as $posts_ids)
                            <?php
                                $posts_post = PagePost::where('id',$posts_ids->post_id)->first();
                                $userData = User::where('id',$posts_post['user_id'])->first();
                            ?>
                            <div class="central-meta item">
                                <div class="user-post">
                                    <div class="friend-info">
                                    <figure>
                                        <?php if(File::exists(public_path("/uploads/profile_pic/thumb/".$userData->profile_pic ))){ ?>
                                            <img src="{{ url('/public/uploads/profile_pic/thumb/'.$userData->profile_pic) }}" alt="Fitnessity">
                                        <?php }else{ 
                                            $pf=substr($userData->firstname, 0, 1).substr($userData->lastname, 0, 1);
                                                echo '<div class="admin-img-text"><p>'.$pf.'</p></div>';
                                        } ?>
                                    </figure>
                                        <div class="friend-name">
                                            <?php
                                            /*$postsave = PagePostSave::where('user_id',Auth::user()->id)->where('post_id',$posts_post->id)->get();*/
                                            $postsave = PagePostSave::where('user_id',@$loggedinUserorignal->id)->where('post_id',$posts_post->id)->get();
                                            if(!empty($loggedinUserorignal)) {
                                                if( @$loggedinUserorignal->id == $posts_post['user_id']){?>                           
                                                <div class="more">
                                                    <div class="more-post-optns"><i class="fa fa-ellipsis-h"></i>
                                                        <ul>
                                                            @if(@$loggedinUserorignal->id == @$posts_post['user_id'])
                                                            <li><a id="{{@$posts_post['id']}}" class="editpopup" href="javascript:void(0);"><i class="fa fa-pencil-square-o"></i>Edit Post</a></li>
                                                            <li><a href="{{route('delPost',@$posts_post['id'])}}"><i class="fa fa-trash"></i>Delete Post</a></li>
                                                            @endif

                                                            @if((@$loggedinUserorignal->id != $posts_post->user_id) && $postsave->count() == 0 )
                                                                <li><a href="{{route('savePost',['pid'=>@$posts_post['id'],'uid'=>@$posts_post['user_id']])}}"><i class="far fa-bookmark"></i>Save Post</a></li>
                                                            @elseif ($postsave->count() > 0)
                                                                <li><a href="{{route('RemovesavePost',['pid'=>@$posts_post->id,'uid'=>@$posts_post->user_id])}}"><i class="fas fa-bookmark"></i>Remove from saved</a></li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            <?php
                                                }
                                            } ?>

                                            <ins><a href="#" title="">{{ucfirst($userData->firstname)}} {{ucfirst($userData->lastname)}} </a> Post Album</ins>
                                            <span><i class="fa fa-globe"></i> published: {{date('F, j Y H:i:s A', strtotime($posts_post['created_at']))}}</span>
                                        </div><!-- friend-name -->
                                        <div class="post-meta">
                                            <input type="text" name="abc" data-emojiable="true" data-emoji-input="image" class="removepost" value="{{$posts_post['post_text']}}" disabled="">
                                            <?php 
                                                $userid = $posts_post['user_id'];
                                                $count = count(explode("|",$posts_post['images']));
                                                $countimg = $count-5;
                                                $getimages = explode("|",$posts_post['images']);
                                            ?> 
                                            <figure>
                                                <!-- video post -->
                                                @if(isset($posts_post['video']))
                                                    <div class="img-bunch">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <figure>
                                                                    <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                    <video controls class="thumb"  style="width: 100%;"  id="vedio{{$posts_post['id']}}">
                                                                        <source src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/video/{{$posts_post['video']}}" type="video/mp4">
                                                                    </video>
                                                                    </a>
                                                                </figure>
                                                                <script type="text/javascript">
                                                                   /* const vid ='';
                                                                    vid = document.getElementById('vedio{{$posts_post['id']}}');*/

                                                                    ['playing'].forEach(t => 
                                                                       document.getElementById('vedio{{$posts_post['id']}}').addEventListener(t, e => vediopostviews('{{$posts_post['id']}}'))
                                                                    );
                                                                </script>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @elseif(isset($posts_post['music']))   
                                                    <div class="img-bunch">
                                                        <div class="row">
                                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                                <figure>
                                                                    <a href="#" title="" data-toggle="modal" data-target="#img-comt">
                                                                    <audio src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/music/{{$posts_post['music']}}" controls></audio>
                                                                    </a>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$img}}"  class="postfancyimg" data-fancybox="gallery1{{$posts_post['id']}}">
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
                                                                        <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" class="postfancyimg" data-fancybox="gallery1{{$posts_post['id']}}">
                                                                            <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="fitnessity">
                                                                        </a>
                                                                    </figure>
                                                                @endif
                                                                @if(isset($getimages[1]))
                                                                    <figure>
                                                                        <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" class="postfancyimg" data-fancybox="gallery1{{$posts_post['id']}}">
                                                                            <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="fitnessity">
                                                                        </a>
                                                                    </figure>
                                                                @endif
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                @if(isset($getimages[2]))
                                                                    <figure>
                                                                        <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" class="postfancyimg" data-fancybox="gallery1{{$posts_post['id']}}">
                                                                            <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" alt="fitnessity">
                                                                        </a>
                                                                    </figure>
                                                                @endif
                                                                @if(isset($getimages[3]))
                                                                    <figure>
                                                                        <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[3]}}" class="postfancyimg" data-fancybox="gallery1{{$posts_post['id']}}">
                                                                            <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[3]}}" alt="fitnessity">
                                                                        </a>
                                                                    </figure>
                                                                @endif
                                                                @if(isset($getimages[4]))
                                                                    <figure>
                                                                        <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[4]}}" class="postfancyimg" data-fancybox="gallery1{{$posts_post['id']}}">
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
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" class="postfancyimg" data-fancybox="gallery{{$posts_post['id']}}">
                                                                        <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="fitnessity">
                                                                    </a>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                        <div class="row">   
                                                            <div class="col-lg-4 col-md-4 col-sm-4"> 
                                                                <figure>
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" class="postfancyimg" data-fancybox="gallery{{$posts_post['id']}}">
                                                                        <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="fitnessity" height="170">
                                                                    </a>
                                                                </figure>   
                                                            </div> 
                                                            <div class="col-lg-4 col-md-4 col-sm-4"> 
                                                                <figure>
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" class="postfancyimg" data-fancybox="gallery{{$posts_post['id']}}">
                                                                        <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" alt="" height="170">
                                                                    </a>
                                                                </figure>    
                                                            </div> 
                                                            <div class="col-lg-4 col-md-4 col-sm-4">  
                                                                <figure>
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[3]}}" class="postfancyimg" data-fancybox="gallery{{$posts_post['id']}}">
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
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" class="postfancyimg" data-fancybox="gallery{{$posts_post['id']}}">
                                                                        <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="fitnessity" width="100" height="335">
                                                                    </a>
                                                                </figure>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                <figure>
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" class="postfancyimg" data-fancybox="gallery{{$posts_post['id']}}">
                                                                        <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="fitnessity" width="100" height="165">
                                                                    </a>
                                                                </figure>
                                                                <figure>
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" class="postfancyimg" data-fancybox="gallery{{$posts_post['id']}}">
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
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" class="postfancyimg" data-fancybox="gallery{{$posts_post['id']}}">
                                                                        <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="">
                                                                    </a>
                                                                </figure>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                                <figure>
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" class="postfancyimg" data-fancybox="gallery{{$posts_post['id']}}">
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
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" class="postfancyimg" data-fancybox="gallery{{$posts_post['id']}}">
                                                                        <img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="fitnessity">
                                                                    </a>
                                                                </figure>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <?php
                                                    $profile_posts_like = PagePostLikes::where('post_id',$posts_post['id'])->where('is_like',1)->count();
                                                    $likemore = $profile_posts_like-2;
                                                    $loginuser_like = PagePostLikes::where('post_id',$posts_post['id'])->where('is_like',1)->where('user_id',@$loggedinUser->id)->first();
                                                    $seconduser_like = PagePostLikes::where('post_id',$posts_post['id'])->where('is_like',1)->where('user_id','!=',@$loggedinUser->id)->first();
                                                    $profile_posts_comment = PagePostComments::where('post_id',$posts_post['id'])->count();
                                                    $postsaved = PagePostSave::where('post_id',$posts_post->id)->where('user_id',@$loggedinUser->id)->first();
                                                    $activethumblike=''; $savedpost='';
                                                    if( !empty($postsaved) ){ $savedpost='activesavedpost'; }
                                                ?>
                                                
                                                <ul class="like-dislike" id="ulike-dislike<?php echo $posts_post->id; ?>">
                                                <?php $loginuser_like = PagePostLikes::where('post_id',$posts_post['id'])->where('is_like',1)->where('user_id',@$loggedinUser->id)->first(); ?>
                                                    @if(!empty($loginuser_like))
                                                    <?php $activethumblike='activethumblike'; ?>
                                                    @endif
                                                    <li><a class="savepost <?php echo $savedpost; ?>" href="javascript:void(0);" title="Save to Pin Post" id="savepost{{$posts_post['id']}}" postid="{{$posts_post['id']}}">
                                                        <i class="thumbtrack fas fa-thumbtack"></i>
                                                        </a>
                                                    </li> 
                                                    <li><a class="<?php echo $activethumblike; ?>" href="javascript:void(0);" title="Like Post"><i id="{{$posts_post['id']}}" is_like="1" class="thumbup thumblike fas fa-thumbs-up"></i></a></li>
                                                    <li><a class="bg-red" href="javascript:void(0);" title="dislike Post"><i id="{{@$posts_post['id']}}"  postid="{{@$page_post['id']}}" is_like="0" class="thumpdown thumblike fas fa-thumbs-down"></i></i></a></li>
                                                </ul>
                                            </figure>   
                                            <div class="we-video-info">
                                                <ul class ="postinfouls{{@$page_post['id']}}">
                                                    @if(@$page_post->video != '')
                                                        <?php 
                                                            $ppvcnts = BusinessPostViews::where('post_id' , $page_post->id)->count();
                                                        ?>
                                                        <li>
                                                            <span class="views" title="views">
                                                                <i class="eyeview fas fa-eye"></i>
                                                                <ins>{{$ppvcnts}}</ins>
                                                            </span>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <div class="likes heart" title="Like/Dislike">❤ <span id="likecount{{$posts_post['id']}}">{{$profile_posts_like}}</span></div>
                                                    </li>
                                                    <li>
                                                        <span class="comment{{$posts_post->id}}" title="Comments">
                                                            <i class="commentdots fas fa-comment-dots"></i>
                                                            <ins>{{$profile_posts_comment}}</ins>
                                                        </span>
                                                    </li>
                                                </ul>
                                                <div class="users-thumb-list" id="users-thumb-list<?php echo $posts_post->id; ?>">
                                                <?php
                                                $post_posts_like =  PagePostLikes::where('post_id',$posts_post->id)->where('is_like',1)->count(); ?>
                                                    @if($post_posts_like>0)
                                                    
                                                        @if(!empty($loginuser_like))
                                                            <a data-toggle="tooltip" title="Anderw" href="#">
                                                                <img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.@$loggedinUser->profile_pic) }}" height="32" width="32">  
                                                            </a>
                                                        @endif
                                                        <?php 
                                                        $profile_posts_all =  PagePostLikes::where('post_id',$posts_post['id'])->where('is_like',1)->where('user_id','!=',@$loggedinUser->id)->limit(4)->get();?>
                                                        @if(isset($profile_posts_all[0]))
                                                        <?php $seconduser = User::find($profile_posts_all[0]->user_id); ?>
                                                            <a data-toggle="tooltip" title="frank" href="#">
                                                                <img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$seconduser->profile_pic) }}" height="32" width="32">  
                                                            </a>
                                                        @endif
                                                        @if(isset($profile_posts_all[1]))
                                                        <?php $thirduser = User::find($profile_posts_all[1]->user_id); ?>
                                                            <a data-toggle="tooltip" title="Sara" href="#">
                                                                <img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$thirduser->profile_pic) }}" height="32" width="32">  
                                                            </a>
                                                        @endif

                                                        @if(isset($profile_posts_all[2]))
                                                        <?php $fourthuser = User::find($profile_posts_all[2]->user_id); ?>
                                                            <a data-toggle="tooltip" title="Amy" href="#">
                                                                <img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$fourthuser->profile_pic) }}" height="32" width="32">  
                                                            </a>
                                                        @endif

                                                        @if(isset($profile_posts_all[3]))
                                                        <?php $fifthuser = User::find($profile_posts_all[3]->user_id); ?>
                                                            <a data-toggle="tooltip" title="Ema" href="#">
                                                                <img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$fifthuser->profile_pic) }}" height="32" width="32">  
                                                            </a>
                                                        @endif
                                                        <span>
                                                            <strong>
                                                                @if(!empty($loginuser_like))
                                                                You
                                                                @endif
                                                            </strong>
                                                            @if(!empty($seconduser_like))
                                                                <?php   $secondusername = User::where('id',$seconduser_like->user_id)->first(); ?>,<b>{{$secondusername->username}}</b>
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
                                                    $comments =  PagePostComments::where('post_id',$posts_post['id'])->limit(2)->get();
                                                    $allcomments =  PagePostComments::where('post_id',$posts_post['id'])->get();
                                                ?>
                                                @if(count($comments) > 0)
                                                    @foreach($comments as $comment)
                                                        <?php
                                                            $username = User::find($comment->user_id); 
                                                            $cmntlike =  PagePostCommentsLike::where('comment_id', $comment->id)->count();
                                                        ?>
                                                        <li class="commentappendremove">
                                                            <div class="comet-avatar">
                                                                @if(@$username->profile_pic  != '' &&  File::exists(public_path("/uploads/profile_pic/thumb/".@$username->profile_pic  )))
                                                                    <img src="{{ url('/public/uploads/profile_pic/thumb/'.@$username->profile_pic ) }}" alt="fitnessity" >
                                                                @else
                                                                    <?php
                                                                    echo '<div class="company-img-text">';
                                                                    $pf=substr(@$username->firstname, 0, 1).substr(@$username->lastname, 0, 1);
                                                                    echo '<p>'.$pf.'</p></div>';
                                                                    ?>
                                                                @endif
                                                            </div>
                                                            <div class="we-comment">
                                                                <h5><a href="javascript:void(0);" title="">{{$username->firstname}} {{$username->lastname}}</a></h5>
                                                                <p>{{$comment->comment}}</p>
                                                                <div class="inline-itms" id="commentlikediv<?php echo $comment->id; ?>">
                                                                <?php
                                                                    $cmntUlike =  PagePostCommentsLike::where('comment_id',$comment->id)->where('user_id',@$loggedinUserorignal->id)->count();
                                                                ?>
                                                                    <span>{{$comment->created_at->diffForHumans()}}</span>
                                                                    <!--<a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>-->
                                                                    <a href="javascript:void(0);" class="commentlike" id="{{$comment->id}}" post-id="{{@$profile_post->id}}" ><i class="fa fa-heart <?php if($cmntUlike>0){ echo 'commentLiked'; } ?>" id="comlikei<?php echo $comment->id; ?>"></i><span id="comlikecounter<?php echo $comment->id; ?>"><?php echo $cmntlike; ?></span></a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                @endif
                                                <li class="commentappend{{$posts_post['id']}}"></li>
                                                @if(count($allcomments) > 2)
                                                    <input type="hidden" name="commentdisplay" id="commentdisplay" value="5">
                                                    <li>
                                                        <a id="{{$posts_post['id']}}" href="javascript:void(0);" title="" class="showcomments showmore underline">more comments+</a>
                                                    </li>
                                                @endif
                                                <li class="post-comment">
                                                    <div class="comet-avatar">
                                                        @if(@$loggedinUserorignal->profile_pic  != '' &&  File::exists(public_path("/uploads/profile_pic/thumb/".@$loggedinUserorignal->profile_pic  )))
                                                            <img src="{{ url('/public/uploads/profile_pic/thumb/'.@$loggedinUserorignal->profile_pic ) }}" alt="fitnessity" >
                                                        @else
                                                            <?php
                                                            echo '<div class="company-img-text">';
                                                            $pf=substr(@$loggedinUserorignal->firstname, 0, 1).substr(@$loggedinUserorignal->lastname, 0, 1);
                                                            echo '<p>'.$pf.'</p></div>';
                                                            ?>
                                                        @endif
                                                    </div>
                                                    <div class="post-comt-box">
                                                        <form method="post" id="commentfrm">
                                                            <textarea placeholder="Post your comment" name="comment" id="saved_comment{{$posts_post['id']}}"></textarea>
                                                            <span class="error" id="saved_err_comment{{$posts_post['id']}}"></span>
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
                                                            <button style="background-color: #ef3e46" type_comment="saved" id="{{$posts_post['id']}}" class="postcomment" type="button">Post</button>
                                                        </form> 
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- album post -->
                        @endforeach
                        @endif
                        <!-- append page scroll result -->
                        <div class="content-dash" id="scroll_pagination"></div>
                    </div>
                    <div class="desc-box-new">
                        <!-- <div class="desc-text" id="mydesc">
                            <h5>About</h5>
                            <?php $gender = array('' => 'Select Gender', 'Male' => 'Male', 'Female' => 'Female'); ?>
                            <p>@if(isset($UserProfileDetail['business_info'])) {!! nl2br(@$UserProfileDetail['business_info']) !!} @else - @endif</p>
                            <p>@if(isset($UserProfileDetail['intro'])) {!! nl2br(@$UserProfileDetail['intro']) !!} @endif</p>
                            </div> -->
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
                                                    @foreach($gallery as $key=>$pic)
                                                        @if($key==0)
                                                            <div class="active item" data-slide-number="{{ $pic['id'] }}">
                                                        @else
                                                            <div class="item"  data-slide-number="{{ $pic['id'] }}">
                                                        @endif
                                                            <img src="/public/uploads/gallery/<?= @$loggedinUser->id ?>/<?= $pic['name'] ?>" style="width:100%;">
                                                        </div>
                                                    @endforeach
                                                </div><!-- Carousel nav -->
                                            </div>
                                            <!--/Slider-->
                                            <div id="slider-thumbs">
                                                <!-- Bottom switcher of slider -->
                                                <ul class="hide-bullets">
                                                    <?php
                                                        foreach ($gallery as $pic) { ?>
                                                            <li>
                                                                <img class="short-cru-img" style="width:100%;" src="/public/uploads/gallery/<?= @$loggedinUser->id ?>/thumb/<?= $pic['name'] ?>" id="<?= $pic['id'] ?>" />
                                                            </li>
                                                    <?php } ?> 
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
                                                                    <input type="text" class="form-control" autocomplete="off" name="birthday" placeholder="MM-DD-YYYY" id="frm1_birthday" />
                                                                </div>
                                                            </div>
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
                                    {!! Form::close() !!} <!-- </form> -->
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
                                    <tbody>
                                        @if(count($family) == 0)
                                            <tr>
                                                <td colspan="8"><h3 class="nw-user-nm text-center">Family Details not added yet.</h3></td>
                                            </tr>
                                        @else
                                            @foreach($family as $value)
                                                <tr>
                                                    <td>{{$value->first_name}} {{$value->last_name}}</td>
                                                    <td>{{$value->relationship}}</td>
                                                    <td>{{$value->email}}</td>
                                                    <td>{{$value->emergency_contact}}</td>
                                                    <td>{{$value->mobile}}</td>
                                                    <td>{{$value->gender}}</td>
                                                    <td><a href="javascript: void(0);" data-toggle="modal" data-target="#addFamilyDetailModal"><i class="fa fa-pencil family_edit" user_id="{{$value}}" style="color: #f53b49"></i></a> 
                                                        <a href="javascript: void(0);" ><i class="fa fa-trash family_delete" user_id="{{$value->id}}" style="color: #f53b49"></i></a></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>                                                      @isset(Auth::user()->company_images)
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
            </div>
		</div>
		
        <div class="col-sm-12 col-md-4 col-lg-4">
        	@include('profiles.viewbusinessProfileRightPanel')
        </div><!-- col-md-4 -->
        
	</div>
	</div>
	</div>
	</div>
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
<script src="{{ url('public/js/pixelarity-face.js') }}"></script>
<script src="{{ url('public/js/jquery.shares.js') }}"></script>
<script src="{{ url('public/js/jquery.fancybox.min.js') }}"></script>

<!-- emoji -->
<script src="{{ url('public/emoji/lib/js/config.js') }}"></script>
<script src="{{ url('public/emoji/lib/js/util.js') }}"></script>
<script src="{{ url('public/emoji/lib/js/jquery.emojiarea.js') }}"></script>
<script src="{{ url('public/emoji/lib/js/emoji-picker.js') }}"></script>
<script src="{{ url('public/js/date-range-picker.js') }}"></script>
<script src="{{ url('public/js/webcam.min.js') }}"></script>

<script src="<?php echo Config::get('constants.FRONT_JS'); ?>ratings.js"></script>

<script>

</script>

<script>
$(document).ready(function() {
	$('.showphotosbusiness').on('click', function(e) {
		close: true
	});
});
</script>
<script>
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

function vediopostviews(post_id) {
        var _token = $("input[name='_token']").val();
        $.ajax({
            url: "{{url('/updatebusinesspostviewcount')}}",
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
                $(".postinfouls"+post_id).load(" .postinfouls"+post_id+" >*");
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
			url: "{{route('editpagepost')}}",
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
});

$(document).ready(function(){
	$('a.share').shares();
});
</script>
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
	function gallery() {
		var allimages = $("img.gallarychangeimg");
		for (var i = 0; i < allimages.length; i++) {
			allimages[i].onclick = imgChanger;
		}
	}
	function imgChanger() {
		document.getElementById('myPicturechange').src = this.id;
	}
	$(document).ready(function () {
		$("#profile_pic").change(function (e) {
			var img = e.target.files[0];
			if (!pixelarity.open(img, false, function (res, faces) {
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
    	}
    	var reader = new FileReader();
    	$(reader).on("load", function() {
        	$preview.append($('<img>', {src:this.result, height:100, width:100, class:'postimgarray'}));
    	});
		reader.readAsDataURL(file);
  	}
}

$('.editpic').click(function () {
   var imgname = $(this).attr('imgname');
   var id = $(this).attr('id');
   var foldernm = '<?php echo @$loggedinUser->id;  ?>';
   $('#imgId').val(id);
   $('#imgname').val(imgname);
   //$(".srcappend").attr("src","/public/uploads/gallery/"+foldernm+"/thumb/"+imgname);
   $(".srcappend").attr("src","/public/uploads/page-cover-photo/thumb/"+imgname);
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
    $('.coemail').attr('href', "{{'mailto:support@fitnessity.com'}}")
    $('.cophone').attr('href', "{{'tel:012345678'}}")
    $('.coaddress').attr('href', "{{'http://maps.google.com/?q=newyork'}}")
    $('.prfl-nme').html('')
	if (window.location.href.split('?').pop() == 'companyCreate=1') {
		$('#create_company_btn').click()
	}
	$("#resetPassword").click(function () {
        var email1='';
        if('<?php Auth::user() ?>'){
            email1 = '{{@$loggedinUserorignal->email}}';
        }
		formdata = new FormData();
		var token = '{{csrf_token()}}';
		var email = email1;
		formdata.append("_token", token);
		formdata.append("email", email);
		$.ajax({
			url: '/password/email',
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
    $('#datepicker-on-change').Zebra_DatePicker({
		default_position: 'below',
		container: $('.datepicker-position')
	});
	$('#frm1_birthday').Zebra_DatePicker({
		default_position: 'below',
		direction: -1,
		format: 'm-d-Y',
		container: $('#datepicker-position')
	});
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

$("label.present_work_btn").click(function () {
	$("#frm_ispresentcheck").attr("checked", !$("#frm_ispresentcheck").attr("checked"));
	changeDateBasedonPresent();
});

$('#imagedropbox').click(function () {
	$('#Modal').modal('show');
});
$('#uplogradProfileBtn').click(function () {
	$('#upgradeProfileForm').modal('show');
});

var form = document.querySelector('form');
// edit profile picture
$('#frmeditProfile').submit(function (e) {
	e.preventDefault();
    $('#frmeditProfile').validate({
		rules: {
			profile_pic: {
				required: true,
				accept: "image/*"
			},
		},
        messages: {
			profile_pic: {
				required: "Upload a Profile picture",
				accept: "Please upload an image"
			},
		}
	});
	if (!$('#frmeditProfile').valid()) {
		return false;
	}
	var inputData = new FormData($(this)[0]);
	$.ajax({
		url: '/profile/editPageProPic',
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
				showSystemMessages('#systemMessage', 'success', 'Profile Photo updated scuccessfully');
				$(".display_user_profile_pic_view_profile").each(function () {
					$(this).attr("src", response.returndata.profile_pic);
				});
				$('#editProfilePic').modal('hide');
			} else {
				showSystemMessages('#systemMessage', response.type, response.msg);
			}
		}
	});
});

// fill modal form with user details
var UserProfileDetail = <?php echo json_encode($UserProfileDetail); ?>;
var ProfessionalDetail = <?php echo json_encode($UserProfileDetail['ProfessionalDetail']); ?>;
$("#editProfileDetailModal").on("show.bs.modal", function () {
	$('#editProfileDetailModal').find('#frm_firstname').val(UserProfileDetail.firstname);
    $('#editProfileDetailModal').find('#frm_lastname').val(UserProfileDetail.lastname);
    $('#editProfileDetailModal').find('#frm_username').val(UserProfileDetail.username);
	$('#editProfileDetailModal').find('#frm_gender').val(UserProfileDetail.gender);
	$('#editProfileDetailModal').find('#frm_email').val(UserProfileDetail.email);
	$('#editProfileDetailModal').find('#frm_phone_number').val(UserProfileDetail.phone_number);
	$('#editProfileDetailModal').find('#frm_address').val(UserProfileDetail.address);
	if (UserProfileDetail.state != null) {
		$('#editProfileDetailModal').find('#frm_state').val(UserProfileDetail.state);
        $('#editProfileDetailModal').find('#frm_city').val(UserProfileDetail.city);
	}
    $('#editProfileDetailModal').find('#frm_country').val(UserProfileDetail.country);
    $('#editProfileDetailModal').find('#frm_zipcode').val(UserProfileDetail.zipcode);
    $('#editProfileDetailModal').find('#message_area').val(UserProfileDetail.intro);
});
$("#submit_familydetail").click(function () {
	$('#frmaddFamilyDetail').submit()
});
// validate user detail form
$('#frmeditProfileDetail').submit(function (e) {
	e.preventDefault();
    $('#frmeditProfileDetail').validate({
		rules: {
			company_name: { required: true },
			firstname: { required: true },
			lastname: { required: true },
			gender: { required: true },
			phone_number: { //phoneUS: true 
			},
			address: { required: true },
			city: { required: true },
			state: { required: true },
			zipcode: { required: true },
			intro: { required: true },
			about_me: { required: true },
		 },
		 messages: {
			company_name: { required: "Provide a company name", },
			firstname: { required: "Provide a first name", },
			lastname: { required: "Provide a last name", },
			username: { required: "Provide a last name", },
			gender: { required: "Select a Gender", },
			phone_number: { //phoneUS: "Phone number format is invalid. Please enter phone in format of (XXX) XXX XXX", 
			},
            address: { required: "Provide an adderess",},
			city: { required: "Provide a city", },
            state: { required: "Provide a state", },
            zipcode: { required: "Provide a zipcode", },
			intro: { required: "Provide a intro", },
			about_me: { required: "Provide about me", },
		},
        submitHandler: saveProfileDetail
	});
});

// validate user detail form
$('#frmaddFamilyDetail').submit(function (e) {
	e.preventDefault();
    $('#frmaddFamilyDetail').validate({
		rules: {
			first_name: { required: true },
			last_name: { required: true },
			gender: { required: true },
            // email:{ required:true },
			relationship: { required: true },
			birthday: { required: true },
			mobile: {
				required: true, maxlength: 10, minlength: 10, // phoneUS: true
			},
			emergency_contact: { maxlength: 10, minlength: 10, },
		},
		messages: {
			mobile: {
				required: "Provide a phone number",
				minlength: "Please enter a valid contact number",
				maxlength: "Please enter a valid contact number",
			},
			first_name: { required: "Provide a first name", },
			last_name: { required: "Provide a last name", },
			gender: { required: "Select a Gender", },
			relationship: { required: "Select relationship", },
			birthday: { required: "Select Birthdate", },
			// email: { required: "Email field is required", },
			emergency_contact: {
				minlength: "Please enter a valid contact number",
				maxlength: "Please enter a valid contact number",
			},
		},
		submitHandler: saveFamilyDetail
	});
});

function saveProfileDetail() {
	if ($('#frmeditProfileDetail').valid()) {
		var formData = $("#frmeditProfileDetail").serialize();
		$.ajax({
			url: '/profile/editProfileDetail',
            type: 'POST',
            dataType: 'json',
            data: formData,
            beforeSend: function () {
				$('#submit_profiledetail').prop('disabled', true);
			},
			complete: function () {
				$('#submit_profiledetail').prop('disabled', false);
			},
			success: function (response) {
				showSystemMessages('#systemMessage_detail', response.type, response.msg);
				if (response.type == 'success') {
					setTimeout(function () {
						location.reload();
					}, 1000);
				}
			}
		});
	}
}
function saveFamilyDetail() {
	if ($('#frmaddFamilyDetail').valid()) {
		var formData = $("#frmaddFamilyDetail").serialize();
		$.ajax({
			url: '/add-family-detail',
			type: 'POST',
			dataType: 'json',
			data: formData,
			beforeSend: function () {
				$('#submit_familydetail').prop('disabled', true);
			},
			complete: function () {
				$('#submit_familydetail').prop('disabled', false);
			},
			success: function (response) {
				showSystemMessages('#systemMessage_detail', response.type, response.msg);
				if (response.type == 'success') {
					setTimeout(function () {
						location.reload();
					}, 1000);
					// window.location = "/profile/viewProfile";
				}
			}
		});
	}
}
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
function removeUpload_coverphoto() {
	if (confirm("Are you sure you want to delete cover photo?")) {
		var _token = $("input[name='_token']").val();
		$.ajax({
			type: 'POST',
			url: '{{route("removeusercoverphoto")}}',
			data: {
				_token: _token
			},
			success: function (data) {
				alert("Cover photo removed successfully.");
				window.location.reload();
			}
		});
	}
}
// Follow script
/*    $(".follower-fun").click(function () {
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
    });
*/
				

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
        return false;
	}
	if(email == ''){
		$('#err_email_sign').html('Please enter email');
		$('#email').focus();
		return false;
	}
	if(message == ''){
		$('#err_message_sign').html('Please enter message');
        $('#message').focus();
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
		var selfieimg ='';
		selfieimg = $('#selfieimg').val();
		var ret = true;
		$('#err_image_sign').html('');
		$('#err_post_sign').html('');
		
		if(selfieimg.trim() == 'undefined'){ selfieimg=''; }
		if(post_text == '' && image_post == '' && video_post == '' && music_post == '' && selfieimg == '' )
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
    $(".show-more").click(function () {
        if($(".text-book").hasClass("show-more-height")) {
            $(this).text("Show Less");
        } else {
            $(this).text("Show More");
        }

        $(".text-book").toggleClass("show-more-height");
    });
</script>
<script>
    $(document).on('click', '.serv_fav1', function(){
        var ser_id = $(this).attr('ser_id');
        // var _token = $("input[name='_token']").val();
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
                    $('#serfav'+ser_id).html('<i class="fas fa-heart"></i>');
                }
                else
                {
                    $('#serfav'+ser_id).html('<i class="far fa-heart"></i>');
                }
            }
        });
    });


	$(document).on('click', '.postcomment', function () {
        var postId =$(this).attr('id');
        var type_comment =$(this).attr('type_comment');
        if(type_comment == 'saved'){
            var com_name = 'saved_comment';
            var err_comment = 'saved_err_comment';
        }else{
            var com_name = 'comment';
            var err_comment = 'err_comment';
        }
        var comment = $('#'+com_name+postId).val();     
        var ret_post = true;
        $('#'+err_comment+postId).html('');
        if(comment == ''){
            $('#'+err_comment+postId).html('Please enter comment!');
            $('#'+com_name).focus();
            return false;
        }
        if(ret_post == true){
            var _token = $("input[name='_token']").val();
                $.ajax({
                url: "{{url('/pagePostcomment')}}" + "/"+postId,
                type: 'post',
                data:{
                    _token:_token,
                    comment:comment
                },          
                success: function (data) {
                    $('.commentappend'+postId).append(data.html);
					$('#'+com_name+postId).val('');
                    $(".postinfoul"+postId).load(" .postinfoul"+postId+" >*");
                }
            });
        }       
    });
	$(document).on('click', '.showcomments', function(){
		var commentdisplay = $('#commentdisplay').val();
		var postId =$(this).attr('id');
		$('.commentappendremove').html("");
		$.ajax({
			url: "{{url('/pageshowcomments')}}" + "/"+postId,
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
	$(document).on('click', '.commentlike', function(){
		var _token = $("input[name='_token']").val();
		var comId =$(this).attr('id');
		var postId =$(this).attr('post-id');
		$.ajax({
			url: "{{url('/commentLike')}}" + "/"+comId,
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
	$(document).on('click', '.thumblike', function(){
		var _token = $("input[name='_token']").val();
		var postId =$(this).attr('postid');
		var is_like = $(this).attr('is_like');
		var posttype = $(this).attr('posttype');
		$.ajax({
			url: "{{url('/like-pagepost')}}" + "/"+postId,
			type: 'post',
			data:{
				_token:_token,
				is_like:is_like
			},
			success: function (data) {
				if(data.success=='success'){
					if(posttype=='Saved'){
						$("#users-thumb-list-saved"+postId).load(" #users-thumb-list"+postId+" > *");
						//$("#ulike-dislike-saved"+postId).load(" #ulike-dislike"+postId+" > *");
						$('#likecount-saved'+postId).html(data.count);
						if(data.saved=='1'){ $('#like-thumb-saved'+postId).addClass("activethumblike"); }
						else{ $('#like-thumb-saved'+postId).removeClass("activethumblike"); }
					}
					else {
						$("#users-thumb-list"+postId).load(" #users-thumb-list"+postId+" > *");
						//$("#ulike-dislike"+postId).load(" #ulike-dislike"+postId+" > *");
						$('#likecount'+postId).html(data.count);
						if(data.saved=='1'){ $('#like-thumb'+postId).addClass("activethumblike"); }
						else{ $('#like-thumb'+postId).removeClass("activethumblike"); }
					}
				}
			}
		});
	});
	$(document).on('click', '.savepost', function(){
		var _token = $("input[name='_token']").val();
		var postId =$(this).attr('postid');
		var pageid =$(this).attr('pageid');
		
		$.ajax({
			url: "{{url('/savePost')}}",
			type: 'post',
			data:{
				_token:_token,
				postid:postId,
				pageid:pageid,
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
	$(document).on('click', '.delpagepost', function(){
		if(confirm("Are you sure you want to delete this?")){
			var _token = $("input[name='_token']").val();
			var postId =$(this).attr('postid');
			var posttype =$(this).attr('posttype');
			$.ajax({
				url: "{{url('/DelPost')}}",
				type: 'post',
				data:{
					_token:_token,
					postid:postId,
				},
				success: function (data) {
					if(data.success=='success'){
						if(posttype=='saved') { $("#listsavepostid"+postId).remove(); }
						if(posttype=='post') { $("#listpostid"+postId).remove(); }
					}
				}
			});
		}
		else{ return false; }
	});
</script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>    
@endsection

