@inject('request', 'Illuminate\Http\Request')
@extends('layouts.business.header')

<head>
    <title> Fitnessity </title>
    <meta charset="utf-8">
    <meta name="description" content="Looking for a place to grow your career. There are many good reasons to consider the great insurance jobs available through Legends United.">
    <meta name="keywords" content="Great Insurance Jobs">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://dev.fitnessity.co/public/css/frontend/general.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{url('/public/css/all.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('/public/css/stylenew.css')}}">
   <!--  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" type="text/css" href="{{ url('public/css/pixelarity.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('public/css/profile.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <link href="{{ url('public/emoji/lib/css/emoji.css') }}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ url('public/css/comment-icons.css') }}">
    <?php /*?><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"><?php */?>
	<link rel="stylesheet" type="text/css" href="{{ url('public/css/frontend/businessprofile.css') }}">
    <link rel="stylesheet" href="{{ url('public/css/frontend/jquery.fancybox.min.css') }}">
	<link href="https://dev.fitnessity.co/public/css/frontend/custom.css" rel="stylesheet" type="text/css" />
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
	use App\BusinessExperience;
	use App\BusinessService;
	use App\BusinessReview;
    use App\BusinessPostViews;
    use App\UserFollow;
?>
<style>
	.removepost{ height: auto !important; }
	.viewdisplay{ display: inline-block !important; }
	.colorshade{ color: #FF1493 !important; }
	.colorshade p{ font-weight: 800 !important; }
	body {	background: #fff;font-size: 14px;}
</style>
<?php
$compinfo = CompanyInformation::where('id',request()->id)->first();
$loggedinUser = '';
$loggedinUser = User::where('id',$compinfo->user_id)->first();
$loggedinUserorignal = Auth::user();
$loggedinUserId=$customerfname =$customerlname=''; $customerName =''; $profilePicture =''; $coverPicture ='';
if($loggedinUser != ''){
	$loggedinUserId=@$loggedinUser->id;
    $customerfname=@$loggedinUser->firstname;
    $customerlname=@$loggedinUser->lastname;
	$customerName = @$loggedinUser->firstname . ' ' . @$loggedinUser->lastname;
    $profilePicture = @$loggedinUser->profile_pic;
    $coverPicture = @$loggedinUser->cover_photo;
}

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
                <!-- <i class="fa fa-pen editpic editpic-fs"  id="{{$pic['id']}}"  imgname="{{$pic['name']}}" data-toggle="modal" data-target="#uploadgalaryPic"></i> -->
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
                <?php
                	foreach (array_slice($viewgallery, 0, 4) as $pic) {
                ?>
                		<!-- <div class="one" style="width:{{$width}}%">
							<img style="padding:0; margin:0;"  width="{{$width}}%" height="300" src="/public/uploads/page-cover-photo/thumb/<?= $pic['name'] ?>" /> --> <!--<i class="fa fa-trash" aria-hidden="true"></i>-->
                            <!-- <i class="fa fa-pen editpic editpic-fs" id="{{$pic['id']}}"  imgname="{{$pic['name']}}" data-toggle="modal" data-target="#uploadgalaryPic"></i> 
						</div>-->
                <?php } ?>
                 <!-- </div>
            </div> -->
        <?php /*} else {*/ ?> 
            <!-- <a href="javascript:void(0);" data-toggle="modal" data-target="#uploadCoverPic">
                @if(!empty($coverPicture))
                <img src="{{ url('/public/uploads/cover-photo/') }}" alt="images" class="img-fluid">
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
            <div class="col-lg-2 col-sm-2">
                <div class="comp-mark">
                
                    @if(File::exists(public_path("/uploads/profile_pic/thumb/".$compinfo->logo)) && $company['logo']!='')
                    <img src="{{ url('/public/uploads/profile_pic/thumb/'.$compinfo->logo) }}" alt="images" class="img-fluid">
                    @else
                    	<?php
                    	echo '<div class="company-profile-text">';
						$pf=substr($compinfo->dba_business_name, 0, 1);
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

            <div class="col-lg-6 col-sm-6">
                <div class="bnr-information">
                    <div class="viewdisplay">
                    
                        <h2 style="text-transform: capitalize;">{{$compinfo->dba_business_name}}<?php /*?> <i class="fa fa-pencil usernameedit" id="{{$customerName}}" style="color: #f53b49" data-toggle="modal" data-target="#editusername"></i><?php */?>
                    <?php /*?><span>Claimed</span><?php */?>
					<!--<img src="https://upload.wikimedia.org/wikipedia/en/a/a4/Flag_of_the_United_States.svg" alt="images" width="45" height="20">-->
					</h2></div>
                    <div class="viewdisplay colorshade"><p>@if($compinfo->is_verified == 0) Unclaimed @else Claimed @endif</p></div>
                    @if(isset($compinfo->about_company))
                    	<h6> {{$compinfo->about_company}} </h6>
                    @endif
					<div class="url-copy">	
						<div> 
							<p>
								<a href="<?php echo config('app.url'); ?>/businessprofile/<?php echo strtolower(str_replace(' ', '', $compinfo->dba_business_name)).'/'.$compinfo->id;; ?>">
									<?php echo config('app.url'); ?>/businessprofile/<?php echo strtolower(str_replace(' ', '', $compinfo->dba_business_name)).'/'.$compinfo->id;; ?> </a> </p>
							<!-- <button onclick="myFunction()" style="background: white;border: none; margin-left: 10px;">Copy URL</button>-->
					   </div>
					</div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-4 top-1">
                <div class="reatingbox">
                  <?php
					$reviews_count = BusinessReview::where('page_id', request()->id)->count();
					$reviews_sum = BusinessReview::where('page_id', request()->id)->sum('rating');
					$reviews_avg=0;
					if($reviews_count>0)
					{ $reviews_avg = round($reviews_sum/$reviews_count,2); 
				?>
                		<h5><i class="fa fa-star rating-pro"></i>
                        	<span><?php echo number_format($reviews_avg,1); ?> </span>({{$reviews_count}}) </h5> 
                <?php } ?>
                  <ul class="profile-controls" id="profilecontrol">
                  	<?php
					$PageLike = PageLike::where('pageid',$compinfo->id)->where('follower_id',$compinfo->user_id)->first(); ?>
					<?php if($PageLike) { ?>
                    	<li> <p class="following-tag"> Following </p> </li>
                    <?php } else { ?> 
                    	<li><a href="javascript:void(0);" class="followPage" title="Follow" pageid="{{$compinfo->id}}" userid="{{$compinfo->user_id}}"><i class="fa fa-star"></i></a></li>
                    <?php } ?>
                  </ul>
					<?php /*?><div>
					
                      <ul class="profile-controls">
						<!--	<li>
								<div class="">
									<i class="fa fa-star"></i>
								</div>
							</li>-->
							<li><a href="#" title="Add friend" data-toggle="tooltip"><i class="fa fa-user-plus"></i></a></li>
							<li><a href="#" title="Follow" data-toggle="tooltip"><i class="fa fa-star"></i></a></li>
							<li><a class="send-mesg" href="#" title="Send Message" data-toggle="tooltip"><i class="fa fa-comment"></i></a></li>
							<!--<li>
								<div class="edit-seting" title="Edit Profile image"><i class="fa fa-sliders"></i>
										<ul class="more-dropdown">
										<li><a href="../../index.html" title="">Update Profile Photo</a></li>
										<li><a href="../../index.html" title="">Update Header Photo</a></li>
										<li><a href="../../index.html" title="">Account Settings</a></li>
										<li><a href="../../index.html" title="">Find Support</a></li>
										<li><a class="bad-report" href="#" title="">Report Profile</a></li>
										<li><a href="#" title="">Block Profile</a></li>
									</ul>
								</div>
							</li>-->
							<!--<li class="shareicons"><i class="fa fa-share-alt"></i> Share</li>-->
						</ul>
						<!--<a><img src="/public/images/newimage/share.png" alt="icon">Share</a>-->
					</div><?php */?>
							
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
							<div class="row flex-column-reverse flex-md-row">
								<div class="col-sm-12 col-md-12 col-lg-10">
									<ul class="nav nav-tabs" role="tablist">
										<li class="nav-item">
											<a class="nav-link" href="#about">About</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#amenities">Amenities</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#photos">Photos</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#video">Videos</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#timeline">Timeline</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#experience">Experience</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#things">Things to Know</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#reviews">Reviews</a>
										</li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('business_activity_schedulers',['business_id' =>$compinfo['id']])}}">Schedule</a>
                                        </li>
									</ul>
								</div>
								<div class="col-sm-12 col-md-12 col-lg-2 followdiv">
									<ol class="folw-detail">
										<?php 
										$totpost = PagePost::where('user_id', $compinfo->user_id)->where('page_id', request()->id)->count(); 
										$totFollowers = PageLike::where('pageid', request()->id)->count();
										$totFollowings = PageLike::where('follower_id', $loggedinUserId)->count();
										?>
										<li><span>Posts</span><ins><?php echo $totpost; ?></ins></li>
										<li><span>Followers</span><ins>{{$totFollowers}}</ins></li>
										<li><span>Following</span><ins>{{$totFollowings}}</ins></li>
									</ol>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-sm-12 col-md-8 col-lg-8">
						<div class="" id="about">
							<div class="desc-text" id="mydesc">
								<div id="main_area" style="padding:0">
									<div class="row">
										<div class="col-xs-12" id="slider">
											<span class="create-post">About</span>
											@if(isset($compinfo->short_description))
												<p> {{$compinfo->short_description}} </p>
											@endif
										</div>
									</div>
								</div>
							</div>
						</div><!-- about -->
						
						<div class="" id="amenities">
							<div class="desc-text" id="mydesc">
								<div id="main_area" style="padding:0">
									<div class="row">
										<div class="col-xs-12" id="slider">
											<span class="create-post">Listing Amenities</span>
											<?php
												$amenities = BusinessService::where('cid', $compinfo['id'])->get();
												if( !empty( $amenities) )
												{ 
													foreach($amenities as $ame)
													{
														$dis= explode(',', $ame['serBusinessoff1']); ?>
														<div class="row">
															<?php
															foreach($dis as $data)
															{ ?>
																<div class="col-sm-12 col-md-4"><p><?php echo $data; ?></p></div>
															<?php } ?>
														</div>
											<?php  }} ?>
										</div>
									</div>
								</div>
							</div>
						</div><!-- amenities -->
						<div class="" id="photos">
							<div class="desc-text" id="mydesc">
								<div id="main_area" style="padding:0">
									<div class="row">
										<div class="col-xs-12" id="slider">
											<span class="create-post">Photos</span>
											<div class="" id="carousel-bounding-box">
												<div class="carousel slide round5px" id="myCarousel" data-ride="carousel">
													<div class="carousel-inner">
													<?php
														if (!empty($photos)) 
														{ $j=0;
															foreach($photos as $key=>$data)
															{
																$img_part = explode("|",$data->images);
																$imgCount = count($img_part);
																for ($i=0; $i <$imgCount ; $i++) 
																{
																	if($j==0) { $j++; ?>
																		<div class="active item" data-slide-number="{{ $data['id'] }}">
																	<?php } else { ?>
																		<div class="item" data-slide-number="{{ $data['id'] }}">
																	<?php } ?>
																		<img src="{{asset('public/uploads/gallery/')}}/{{$data->user_id}}/{{$img_part[$i]}}" style="width:100%;">
																	</div><?php }
																$j++;
															}
														} ?>
														</div>
													</div><!--/Slider-->
													<div id="slider-thumbs">
														<ul class="hide-bullets">
															<?php
																foreach($photos as $data) { 
																	$img_part = explode("|",$data->images);
																	$imgCount = count($img_part);
																	for ($i=0; $i <$imgCount ; $i++) 
																	{ ?>
																		<li>
																			<img class="short-cru-img" src="/public/uploads/gallery/{{$data->user_id}}/{{$img_part[$i]}}" id="<?= $data['id'] ?>" />
																		</li>
																	<?php } 
																} ?> 
														</ul>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="" id="video">
								<div class="desc-text" id="mydesc">
									<div id="main_area" style="padding:0">
										<div class="row">
											<div class="col-xs-12" id="slider">
												<span class="create-post">Videos</span>
												@if($compinfo->embed_video != '')
                                                    <?php 

                                                        function getYoutubeEmbedUrl($url){
                                                            $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
                                                            $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))(\w+)/i';
                                                            if (preg_match($longUrlRegex, $url, $matches)) {
                                                                $youtube_id = $matches[count($matches) - 1];
                                                            }
                                                            if (preg_match($shortUrlRegex, $url, $matches)) {
                                                                $youtube_id = $matches[count($matches) - 1];
                                                            }
                                                            return 'https://www.youtube.com/embed/' . $youtube_id ;
                                                        }
                                                        $embeded_url = getYoutubeEmbedUrl($compinfo->embed_video);
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                                            <div class="video-tab-iframe">
                                                                <iframe width="100%" height="400px" src="{{$embeded_url}}" >
                                                                </iframe>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
												<?php 
													if (!empty($videos)) 
													{
														foreach($videos as $data)
														{ ?>
															<!-- <div class="row">
																<div class="col-sm-12 col-md-12 col-lg-12">
																	<div class="video-tab-iframe">
																		<video width="100%" height="400px" controls>
																		  <source src="{{asset('public/uploads/gallery/')}}/{{$data->user_id}}/video/{{$data->video}}" type="video/mp4">
																		  <source src="movie.ogg" type="video/ogg">
																		  Your browser does not support the video tag.
																		</video>
																	</div>
																</div>
															</div> -->
															<?php 
														}
                                                    }
												?>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="" id="timeline" >
								<div class="desc-text" id="mydesc">
									<span class="create-post">Timeline
										
										<a href="<?php echo config('app.url'); ?>/businessprofile/timeline/<?php echo strtolower(str_replace(' ', '', $compinfo->dba_business_name)).'/'.$compinfo->id; ?>" class="showmore"> Show More <i class="fas fa-caret-right"></i> </a>
									 
									</span>
									 @if($page_posts->count() == 0 ) 
									<div class="central-meta item">
										<div class="user-post">
											<div class="friend-info">
												<figure>
													@if($compinfo['logo'] != '')
													<img src="{{ url('/public/uploads/profile_pic/thumb/'.$compinfo['logo']) }}" alt="fitnessity" class="img-fluid">
													@else
													<?php
														echo '<div class="company-img-text">';
														$pf=substr($compinfo->dba_business_name, 0, 1);
														echo '<p>'.$pf.'</p></div>';
													?>
													@endif
												</figure>
												<div class="friend-name">
													<ins><a href="#" title="">{{ucfirst($customerfname)}} {{ucfirst($customerlname)}}</a> Post Album</ins>
												</div>
												<div class="post-meta">
												   <p class="postText"></p>
													<figure>
														<div class="img-bunch" id="add_image">
															<div class="row" >
																<div class="col-lg-12 col-md-12 col-sm-12">
																	<div class="default-img-profile">
																		<img src="{{url('/public/images/newimage/fitness-img-1.jpg')}}">
																		<label> Joined </label>
																		<label class="lstyle">  Fitnessity for Business </label>
																	   <span class="spanstyle"><?php 
																		$date=date_create($compinfo->created_at); echo date_format($date,"d/m/Y"); ?></span>
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
								<div class="loadMore"> <?php $p=1; ?>
									@foreach($page_posts as $page_post)
									<?php
										$PageData = CompanyInformation::where('id',$page_post->page_id)->first();
									?>
										<div class="central-meta item" id="listpostid<?php echo $page_post['id']; ?>">
											<div class="user-post">
												<?php if($p==1){ ?>
													
												<?php } ?>
												<div class="friend-info">
													<figure>
														@if($compinfo['logo'] != '' && File::exists(public_path("/uploads/profile_pic/thumb/".$compinfo['logo'])))
														<img src="{{ url('/public/uploads/profile_pic/thumb/'.$compinfo['logo']) }}" alt="fitnessity" class="img-fluid">
														@else
															<?php
															echo '<div class="company-img-text">';
															$pf=substr($compinfo->dba_business_name, 0, 1);
															echo '<p>'.$pf.'</p></div>';
															?>
														@endif
													</figure>
													<div class="friend-name">
														<?php /*?><div class="more">
															<div class="more-post-optns"><i class="fa fa-ellipsis-h"></i>
																<ul>
																	@if($loggedinUserId == $page_post['user_id'])
																		<li><a id="{{$page_post['id']}}" class="editpopup" href="javascript:void(0);"><i class="fa fa-pencil-square-o"></i>Edit Post</a></li>
																		<li><a href="javascript:void(0);" class="delpagepost" postid="{{$page_post['id']}}" posttype="post" ><i class="fa fa-trash"></i>Delete Post</a></li>
																	@endif
																	
																	<!--<li class="bad-report"><i class="fa fa-flag"></i>Report Post</li>
																	<li><i class="fa fa-address-card"></i>Boost This Post</li>
																	<li><i class="fa fa-clock-o"></i>Schedule Post</li>
																	<li><i class="fab fa-wpexplorer"></i>Select as featured</li>
																	<li><i class="fa fa-bell-slash"></i>Turn off Notifications</li>-->
																</ul>
															</div>
														</div><?php */?>
														<ins><a href="#" title="">{{ucfirst($PageData->dba_business_name)}} </a> Post Album</ins>
														<span><i class="fa fa-globe"></i> published: {{date('F, j Y H:i:s A', strtotime($page_post->created_at))}}</span>
													</div>
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
																				<video controls class="thumb"  style="width: 100%;"   id="vedio{{$page_post->id}}">
																					<source src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/video/{{$page_post->video}}" type="video/mp4">
																				</video>
																				</a>
																			</figure>
                                                                            <script type="text/javascript">
                                                                               /* const vid = document.getElementById('vedio{{$page_post->id}}');*/

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
                                                                    <a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$img}}" data-fancybox="gallery">
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
																					<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" data-fancybox="gallery">
																						<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="fitnessity">
																					</a>
																				</figure>
																			@endif
																			@if(isset($getimages[1]))
																				<figure>
																					<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" data-fancybox="gallery">
																						<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="fitnessity">
																					</a>
																				</figure>
																			@endif
																		</div>
																		<div class="col-lg-6 col-md-6 col-sm-6">
																			@if(isset($getimages[2]))
																				<figure>
																					<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" data-fancybox="gallery">
																						<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" alt="fitnessity">
																					</a>
																				</figure>
																			@endif
																			@if(isset($getimages[3]))
																				<figure>
																					<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[3]}}" data-fancybox="gallery">
																						<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[3]}}" alt="fitnessity">
																					</a>
																				</figure>
																			@endif
																			@if(isset($getimages[4]))
																				<figure>
																					<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[4]}}" data-fancybox="gallery">
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
																					<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" data-fancybox="gallery">
																						<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="fitnessity">
																					</a>
																				</figure>
																			</div>
																		</div>
																		<div class="row">   
																			<div class="col-lg-4 col-md-4 col-sm-4"> 
																				<figure>
																					<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" data-fancybox="gallery">
																						<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="fitnessity" height="170">
																					</a>
																				</figure>   
																			</div> 
																			<div class="col-lg-4 col-md-4 col-sm-4"> 
																				<figure>
																					<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" data-fancybox="gallery">
																						<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" alt="fitnessity" height="170">
																					</a>
																				</figure>    
																			</div> 
																			<div class="col-lg-4 col-md-4 col-sm-4">  
																				<figure>
																					<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[3]}}" data-fancybox="gallery">
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
																					<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" data-fancybox="gallery">
																						<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="fitnessity" width="100" height="335">
																					</a>
																				</figure>
																			</div>
																			<div class="col-lg-6 col-md-6 col-sm-6">
																				<figure>
																					<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" data-fancybox="gallery">
																						<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" alt="fitnessity" width="100" height="165">
																					</a>
																				</figure>
																				<figure>
																					<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[2]}}" data-fancybox="gallery">
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
																					<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" data-fancybox="groupimg1">
																						<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="fitnessity">
																					</a>
																				</figure>
																			</div>
																			<div class="col-lg-6 col-md-6 col-sm-6">
																				<figure>
																					<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" data-fancybox="groupimg1">
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
																					<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" data-fancybox="gallery">
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
																	//echo $loggedinUserorignal->id.'---'; exit;
																	
																	$loginuser_like = PagePostLikes::where('post_id',$page_post['id'])->where('is_like',1)->where('user_id',$loggedinUserId)->first();
																															
																	$seconduser_like = PagePostLikes::where('post_id',$page_post['id'])->where('is_like',1)->where('user_id','!=',$loggedinUserId)->first();
																	$total_comment='';
																	$total_comment = PagePostComments::where('post_id',$page_post['id'])->count();$postsaved="";
																	
																	$postsaved = PagePostSave::where('post_id',$page_post['id'])->where('user_id',$loggedinUserId)->first();
																	$activethumblike=''; $savedpost='';
																	if( !empty($postsaved) ){ $savedpost='activesavedpost'; }
																?>
																<ul class="like-dislike" id="ulike-dislike<?php echo $page_post['id']; ?>">
																<?php $loginuser_like = PagePostLikes::where('post_id',$page_post['id'])->where('is_like',1)->where('user_id',$loggedinUserId)->first(); ?>
																	@if(!empty($loginuser_like))
																		<?php $activethumblike='activethumblike'; ?>
																	@endif
																	<li><a id="savepost{{$page_post['id']}}" class="bg-purple savepost <?php echo $savedpost; ?>" href="javascript:void(0);" title="Save to Pin Post" postid="{{$page_post['id']}}" pageid="{{ request()->page_id }}">
																		<i class="thumbtrack fas fa-thumbtack"></i></a>
																	</li>
																   <?php /*?> <li><a class="<?php echo $activethumblike; ?>" href="javascript:void(0);" title="Like Post"><i id="{{$page_post['id']}}" is_like="1" class="thumbup thumblike fas fa-thumbs-up"></i></a></li><?php */?>
																	<li><a class="thumbup thumblike <?php echo $activethumblike; ?>" href="javascript:void(0);" title="Like Post" id="like-thumb<?php echo $page_post['id']; ?>" postid="{{$page_post['id']}}" is_like="1" posttype="pagepost" ><i class="fas fa-thumbs-up"></i></a></li>
																	<li><a class="bg-red" href="javascript:void(0);" title="dislike Post"><i id="{{$page_post['id']}}" postid="{{$page_post['id']}}" is_like="0" class="thumpdown thumblike fas fa-thumbs-down"></i></i></a></li>
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
																	<span class="comment{{$page_post->id}}" title="Comments">
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
															<div class="users-thumb-list" id="users-thumb-list<?php echo $page_post['id']; ?>">
																<?php
																	$page_posts_like = PagePostLikes::where('post_id',$page_post['id'])->where('is_like',1)->count(); ?>
																	@if($page_posts_like>0)
																		@if(!empty($loginuser_like))
																			<a data-toggle="tooltip" title="" href="#">
																				<img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$profilePicture) }}" height="32" width="32">  
																			</a>
																		@endif
																		<?php 
																			$profile_posts_all = PagePostLikes::where('post_id',$page_post['id'])->where('is_like',1)->where('user_id','!=',$loggedinUserId)->limit(4)->get();?>
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
															$comments = PagePostComments::where('post_id',$page_post['id'])->limit(2)->get();
															$allcomments = PagePostComments::where('post_id',$page_post['id'])->get();
															?>
															@if(count($comments) > 0)
																@foreach($comments as $comment)
																	<?php
																		$username = User::find($comment->user_id);
																		$cmntlike = PagePostCommentsLike::where('comment_id', $comment->id)->count();
																		$cmntUlike = PagePostCommentsLike::where('comment_id',$comment->id)->where('user_id',$loggedinUserId)->count();
																	?>
																	<li class="commentappendremove">
																		<div class="comet-avatar">
																			<?php if(File::exists(public_path("/uploads/profile_pic/thumb/".$username->profile_pic ))){ ?>
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
																				<a href="javascript:void(0);" class="commentlike" id="{{$comment->id}}" post-id="{{$page_post['id']}}" ><i class="fa fa-heart <?php if($cmntUlike>0){ echo 'commentLiked'; } ?>" id="comlikei<?php echo $comment->id; ?>"></i><span id="comlikecounter<?php echo $comment->id; ?>"><?php echo $cmntlike; ?></span></a>
																			</div>
																		</div>
																	</li>
																@endforeach
															@endif
															<li class="commentappend{{$page_post['id']}}"></li>
															@if(count($allcomments) > 2)
																<input type="hidden" name="commentdisplay" id="commentdisplay" value="5">
																<li>
																	<a id="{{$page_post['id']}}" href="javascript:void(0);" title="" class="showcomments showmore underline">more comments+</a>
																</li>
															@endif
															<li class="post-comment">
																<div class="comet-avatar">

															@if(File::exists(public_path("/uploads/profile_pic/thumb/".$compinfo->user_id )))
																<img src="{{ url('/public/uploads/profile_pic/thumb/'.$compinfo->user_id) }}" alt="fitnessity" >
															@else
																<?php
																echo '<div class="company-img-text">';
																$pf=substr($customerfname, 0, 1).substr($customerlname, 0, 1);
																echo '<p>'.$pf.'</p></div>';
																?>
															@endif
																</div>
																<div class="post-comt-box">
																	<form method="post" id="commentfrm">
																		<textarea placeholder="Post your comment" name="comment" id="comment{{$page_post['id']}}"></textarea>
																		<span class="error" id="err_comment{{$page_post['id']}}"></span>
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
																		<button id="{{$page_post['id']}}" class="postcomment theme-red-bgcolor" type="button">Post</button>
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
								</div>
								</div><!-- Timeline -->
							</div>
							
							<div class="profileexp" id="experience">
								<div class="desc-text" id="mydesc">
									<div id="main_area" style="padding:0">
										<div class="row">
											<div class="col-xs-12" id="slider">
												<span class="create-post">Experience</span>
												<ul class="nav nav-tabs" id="expTab" role="tablist">
													<li class="nav-item active">
														<a class="nav-link " id="emp_history-tab" data-toggle="tab" href="#emp_history" role="tab" aria-controls="emp_history" aria-selected="true">Employment History</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" id="edu-tab" data-toggle="tab" href="#edu" role="tab" aria-controls="edu" aria-selected="false">Education</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" id="certi-tab" data-toggle="tab" href="#certi" role="tab" aria-controls="certi" aria-selected="false">Certifications</a>
													</li>
													<li class="nav-item">
														<a class="nav-link" id="skills-tab" data-toggle="tab" href="#skills" role="tab" aria-controls="skills" aria-selected="false">Skills, Acheivement, Awards</a>
													</li>
													<?php /*?><li class="nav-item">
														<a class="nav-link" id="details-tab" data-toggle="tab" href="#detailstab" role="tab" aria-controls="detailstab" aria-selected="false">Details</a>
													</li><?php */?>
												</ul>
												<div class="tab-content" id="expTabContent">
													<div class="tab-pane fade active in" id="emp_history" role="tabpanel" aria-labelledby="emp_history-tab">
													<?php
													 $business_exp = BusinessExperience::where('cid', $compinfo['id'])->get();
													if( !empty( $business_exp) )
													{ $i=1;
														foreach($business_exp as $bexp)
														{ 
															$business_name=json_decode($bexp['frm_organisationname']);
															$position=json_decode($bexp['frm_position']);
															$servicestart=json_decode($bexp['frm_servicestart']);
															$serviceend=json_decode($bexp['frm_serviceend']);
														?>
														<?php for($i=0; $i<count($business_name); $i++){ ?>
															<div class="row border-bottom">
																<div class="col-md-7">
																	<ul>
																		<li>
																			<p> <?php echo $business_name[$i]; ?></p>
																			<p> <?php echo $position[$i]; ?> </p>
																		</li>
																	</ul>
																</div>
																<div class="col-md-5 exp_date">
																	<p> <?php 
																		echo date("F jS, Y", strtotime($servicestart[$i])); 
																		if($serviceend[$i]!=null){
																			echo date("F jS, Y", strtotime($serviceend[$i])); 
																		}
																	?>
																	</p>
																</div>
															</div>
														<?php } ?>
														<?php $i++; }
													}
													?>
													
													</div>
													<div class="tab-pane fade" id="edu" role="tabpanel" aria-labelledby="edu-tab">
													<?php
														if( !empty( $business_exp) )
														{
															foreach($business_exp as $bexp)
															{
																$course=json_decode($bexp['frm_course']);
																$university=json_decode($bexp['frm_university']);
																$passing_year=json_decode($bexp['frm_passingyear']);
																
															?>
															<?php for($i=0; $i<count($course); $i++){ ?>
															<ul>
																<li> <b> Degree - Course : </b> <?php echo $course[$i]?> </li>
																<li> <b> University - School : </b> <?php echo $university[$i]; ?> </li>
																<li> <b> Year Graduated : </b> <?php echo $passing_year[$i]; ?> </li>
															</ul><br>
														<?php } } }
													?>
													</div>
													<div class="tab-pane fade" id="certi" role="tabpanel" aria-labelledby="certi-tab">
													<?php
														if( !empty( $business_exp) )
														{
															foreach($business_exp as $bexp)
															{
																$certification=json_decode($bexp['certification']);
																$passing_date=json_decode($bexp['frm_passingdate']);
															?>
															<?php for($i=0; $i<count($certification); $i++){ ?>
															<ul>
																<li> <b> Name of Certification : </b> <?php echo $certification[$i]; ?> </li>
																<li> <b> Completion Date : </b> <?php echo $passing_date[$i]; ?> </li>
															</ul><br>
														<?php } } }
													?>
													</div>
													<div class="tab-pane fade" id="skills" role="tabpanel" aria-labelledby="skills-tab">
													<?php
														if( !empty( $business_exp) )
														{
															foreach($business_exp as $bexp)
															{
																$skill=json_decode($bexp['skill_type']);
																$skill_completion=json_decode($bexp['skillcompletion']);
																$skilldetail=json_decode($bexp['frm_skilldetail']);
															?>
															<?php for($i=0; $i<count($skill); $i++){ ?>
															<ul>
																<li> <b> Skill Type : </b> <?php echo $skill[$i];?> </li>
																<li> <b> Completion Date : </b> <?php echo $skill_completion[$i]; ?> </li>
																<li> <b> Skill Detail : </b> <?php echo $skilldetail[$i]; ?> </li>
															</ul><br>

														<?php } } }
													?>
													</div>
													<?php /*?><div class="tab-pane fade" id="detailstab" role="tabpanel" aria-labelledby="details-tab">
													<?php
														if( !empty( $business_exp) )
														{
															foreach($business_exp as $bexp)
															{
															?>
																<p> <?php echo $bexp->frm_skilldetail; ?> </p>
														<?php } }
													?>
													</div><?php */?>
												</div>
												
												
											</div>
										</div>
									</div>
								</div>
							</div>
							
							<div class="thingstoknow" id="things">
								<div class="desc-text" id="mydesc">
									<div id="main_area" style="padding:0">
										<div class="row">
											<div class="col-xs-12" id="slider">
												<span class="create-post">Things To Know</span>
												@if( !empty($business_term['houserules']) )
													<h3> House Rules </h3>
													<p>{{ $business_term['houserules'] }}</p>
												@endif
												@if( !empty($business_term['cancelation']) )
													<h3> Cancelation Policy </h3>
													<p>{{ $business_term['cancelation'] }}</p>
												@endif
												@if( !empty($business_term['cleaning']) )
													<h3> Safety and Cleaning Procedures </h3>
													<p>{{ $business_term['cleaning'] }}</p>
												@endif
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="busreview" id="reviews">
								<div class="desc-text" id="mydesc">
									<div id="main_area" style="padding:0">
										<div class="row">
											<div class="col-xs-12" id="slider">
												<span class="create-post">Reviews</span>
												<div class="row">
													<div class="col-sm-12 col-md-12 col-lg-8"> 
														<h3 class="subtitle"> 
															<div class="row">
																<div class="col-md-12 col-lg-2"> Reviews: </div>
																<div class="col-md-12 col-lg-10">
																	<p> <a class="activered f-16 font-bold"> By Everyone  </a>
																		<a class="f-16 font-bold"> | By People I know </a>
																	</p>
																</div>
															</div>
														</h3>
														<div class="service-review-desc">
															<?php
															$reviews_count = BusinessReview::where('page_id', request()->id)->count();
															$reviews_sum = BusinessReview::where('page_id', request()->id)->sum('rating');
															
															$reviews_avg=0;
															if($reviews_count>0)
															{ $reviews_avg = round($reviews_sum/$reviews_count,2); }
															?>                  
															<p> {{$reviews_count}} Reviews </p> 
															<div class="rattxt activered">
																<i class="fa fa-star" aria-hidden="true"></i> {{$reviews_avg}}
															</div>
														</div>
													</div>
													<div class="col-md-6 col-lg-4"> 
														<a class="btn submit-rev mt-10" data-toggle="modal" data-target="#busireview"> Submit Review </a>
														<div class="rev-follow">
														<?php
															$reviews_people = BusinessReview::where('page_id', request()->id)->orderBy('id','desc')->limit(6)->get(); 
														?>
															<!--<a href="#" class="rev-follow-txt">100 Followers Reviewed This</a>-->
															<a href="#" class="rev-follow-txt">{{$reviews_count}} People Reviewed This</a>
															<div class="users-thumb-list">
																@if(!empty($reviews_people))
																	@foreach($reviews_people as $people)
																		<?php $userinfo = User::find($people->user_id); ?>
																		<a href="<?php echo config('app.url'); ?>/userprofile/{{@$userinfo->username}}" target="_blank" title="{{@$userinfo->firstname}} {{@$userinfo->lastname}}" target="_blank" title="Purvi Patel" data-toggle="tooltip">
																			@if(File::exists(public_path("/uploads/profile_pic/thumb/".@$userinfo->profile_pic)) && @$userinfo->profile_pic != '')
																		<img src="{{ url('/public/uploads/profile_pic/thumb/'.@$userinfo->profile_pic) }}" alt="{{@$userinfo->firstname}} {{@$userinfo->lastname}}">
																		@else
																			<?php
																			$pf=substr(@$userinfo->firstname, 0, 1).substr(@$userinfo->lastname, 0, 1);
																			echo '<div class="admin-img-text"><p>'.$pf.'</p></div>'; ?>
																		@endif
																		</a>
																	@endforeach
																@endif               
															</div>
														</div>
													</div>
												</div><!--row-->
												<div class="ser-review-list">
													<div id="user_ratings_div">
														<?php
															$reviews = BusinessReview::where('page_id', request()->id)->get(); ?>
														@if(!empty($reviews))
															@foreach($reviews as $review)
																<?php $userinfo = User::find($review->user_id); ?>
																<div class="ser-rev-user">
																	<div class="row">
																		<div class="col-md-2 pr-0">
																			@if(File::exists(public_path("/uploads/profile_pic/thumb/".@$userinfo->profile_pic)) && @$userinfo->profile_pic != '')
																			<img class="rev-img" src="{{ url('/public/uploads/profile_pic/thumb/'.$userinfo->profile_pic) }}" alt="{{@$userinfo->firstname}} {{@$userinfo->lastname}}">
																			@else
																				<?php
																				$pf=substr(@$userinfo->firstname, 0, 1).substr(@$userinfo->lastname, 0, 1);
																				echo '<div class="reviewlist-img-text"><p>'.$pf.'</p></div>'; ?>
																			@endif
																		</div>
																		<div class="col-md-10 pl-0">
																			<h4> {{@$userinfo->firstname}} {{@$userinfo->lastname}}
																				<div class="rattxt activered"><i class="fa fa-star" aria-hidden="true"></i> {{$review->rating}} </div> </h4> 
																			<p class="rev-time"> {{date('d M-Y',strtotime($review->created_at))}} </p>
																		</div>
																	</div>
																</div>
																<div class="rev-dt">
																	<p class="mb-15"> {{$review->title}} </p>
																	<p> {{$review->review}} </p>
																	<?php
																		if( !empty($review->images) ){
																			$rimg=explode('|',$review->images);
																			echo '<div class="listrimage">';
																			foreach($rimg as $img)
																			{ ?>
																				<a href="{{ url('/public/uploads/review/'.$img) }}" data-fancybox="group" data-caption="{{$review->title}}">
																				<img src="{{ url('/public/uploads/review/'.$img) }}" alt="Fitnessity" />
																				</a>
																				<?php
																			}
																			echo '</div>';
																		}
																	?>
																</div>
															@endforeach
														@endif
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
	</div>
</section>

<div id="busireview" class="modal modalbusireview" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="padding:10px 40px 10px 10px; text-align: right;min-height: 30px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
			</div>
            <div class="modal-body">
            	<div class="rev-post-box">
                	<form method="post" enctype="multipart/form-data" name="sreview" id="sreview" >
                    @csrf
					<div class="clearfix"></div>
					<input type="hidden" name="page_id" id="page_id" value="{{request()->id}}">
					<input type="hidden" name="rating" id="rating" value="0">
                    <div class="rvw-overall-rate rvw-ex-mrgn">
						<span>Rating</span>
						<div id="stars" data-service="" class="starrr" style="font-size:22px"></div>
					</div>
					<input type="text" name="rtitle" id="rtitle" placeholder="Review Title" class="inputs" />
					<textarea placeholder="Write your review" name="review" id="review"></textarea>
                    <input type="file" name="rimg[]" id="rimg" class="inputs" multiple="multiple" />
                    <div class="reviewerro" id="reviewerro"> </div>
						<input type="button" onclick="submit_busi_rating('{{request()->id}}')" value="Submit" class="btn rev-submit-btn mt-10">
                        <script>
							$('#stars').on('starrr:change', function(e, value){
								$('#rating').val(value);
							});
						</script>
					</form>
				</div>
            </div> <!--body-->
		</div>
	</div>
</div>

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

<div class="modal" id="uploadgalaryPic" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body login-pad">  
                <div class="pop-title employe-title">
                    <h3>Change Photohh</h3>
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
                                         <img class="file-upload-image srcappend" src="" alt="your image" height="100px" />
                                    </div>
                                    <div>
                                    </div>

                                    <div class="image-title-wrap">
                                        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                        <button type="submit" id="submit_cover" name="submit_cover" class="remove-image">Save My Cover Photo</button>
                                        &nbsp;&nbsp;
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

@include('layouts.business.footer')
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
<!-- emoji -->
<script src="{{ url('public/emoji/lib/js/config.js') }}"></script>
<script src="{{ url('public/emoji/lib/js/util.js') }}"></script>
<script src="{{ url('public/emoji/lib/js/jquery.emojiarea.js') }}"></script>
<script src="{{ url('public/emoji/lib/js/emoji-picker.js') }}"></script>
<script src="{{ url('public/js/date-range-picker.js') }}"></script>
<script src="{{ url('public/js/webcam.min.js') }}"></script>
<script src="{{ url('public/js/jquery.fancybox.min.js') }}"></script>
<script src="{{url('/public/js/ratings.js')}}"></script>
<script>
function submit_busi_rating(cid)
{
	@if(Auth::check())
		var formData = new FormData();
		var rating=$('#rating').val();
		var review=$('#review').val();
		var rtitle=$('#rtitle').val();
		var _token = $("input[name='_token']").val();
		TotalFiles = $('#rimg')[0].files.length;
		
		let rimg = $('#rimg')[0];
		for (let i = 0; i < TotalFiles; i++) {
			formData.append('rimg' + i, rimg.files[i]);
		}
		formData.append('TotalFiles', TotalFiles);
		formData.append('rtitle', rtitle);
		formData.append('review', review);
		formData.append('rating', rating);
		formData.append('page_id', cid);
		formData.append('_token', _token);
		
		if(rating!='' && review!='')
		{ 
			$.ajax({
				url: "{{route('save_business_reviews')}}",
                xhrFields: {
                    withCredentials: true
                },
				type: 'POST',
				contentType: 'multipart/form-data',
				cache: false,
				contentType: false,
				processData: false,
				data: formData,
				success: function (response) {
					if(response=='submitted')
					{
						$('#reviewerro').show(); $('#reviewerro').html('Review submitted');
						$("#user_ratings_div").load(location.href+" #user_ratings_div>*","");
						$('#rating').val(' ');
						$('#review').val(' '); $('#rtitle').val(' ');
						$("#busireview").modal('hide'); 
					}
					else if(response=='already')
					{ $('#reviewerro').show(); 
						$('#reviewerro').html('You have already submitted your review for this activity.'); }
					else if(response=='addreview')
					{ $('#reviewerro').show(); $('#reviewerro').html('Add your review and select rating for activity');  }
					
				}
			});
		}
		else
		{
			$('#reviewerro').show(); 
			$('#reviewerro').html('Please add your reivew and select rating'); 
			$('#rating').val(' ');
			$('#review').val(' ');
			return false;
		}
	@else
		$('#reviewerro').show(); 
		$('#reviewerro').html('Please login in your account to review this activity');
		$('#rating').val(' ');
		$('#review').val(' ');
		return false;
	@endif
	
}
</script>

<script>
$(document).ready(function(){ 
/* page load scroll*/
	var page =0;
	var cnfload = true;
	
	//for mobile and web scroll
	var addition_constant = 0;
	$(document.body).on('touchmove', onScroll); // for mobile
	$(window).on('scroll', onScroll);
	
	function onScroll() { /*alert('scroll');*/
		var addition = ($(window).scrollTop() + window.innerHeight);
	  	//var footerHeight = $('#footer').height();
	  	var scrollHeight = (document.body.scrollHeight - 1);
	  	//scrollHeight = scrollHeight-footerHeight;
	  	if (addition > scrollHeight && addition_constant < addition) {
			addition_constant = addition;
			cnfload = false;
			page++;
			load_data(page);
	  	}
	}
	
	function load_data(page){ /*alert(page);*/
		$('.loader').show();
		var userid = '<?php echo $loggedinUserId; ?>';
        var pageid = '{{request()->id}}';
		$.ajax({
			url: "{{url('/loadmorepagepostview')}}",
            xhrFields: {
                    withCredentials: true
                },
			type: 'get',
			data:{
				page:page,
				userid:userid,
				pageid:pageid,
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
});	
$(document).ready(function(){ 
/*    $("#actfiloffer").empty();
    $("#actfillocation").empty();
    $("#actfilmtype").empty();
    $("#actfilgreatfor").empty();
    $("#actfilbtype").empty();
    $("#actfilsType").empty();*/
	/*$("#actfiloffer option[value='']").attr('selected', true);
    $("#actfillocation option[value='']").attr('selected', true);
    $("#actfilmtype option[value='']").attr('selected', true);
    $("#actfilgreatfor option[value='']").attr('selected', true);
    $("#actfilbtype option[value='']").attr('selected', true);
    $("#actfilsType option[value='']").attr('selected', true);*/
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
	
});

$(document).ready(function(){
	$('a.share').shares();
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
                $(".postinfoulajax"+post_id).load(" .postinfoulajax"+post_id+" >*");
            }
        });
    }

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


$('.editpic').click(function () {
   var imgname = $(this).attr('imgname');
   var id = $(this).attr('id');
   var foldernm = '<?php echo $loggedinUserId;  ?>';
   $('#imgId').val(id);
   $('#imgname').val(imgname);
   $(".srcappend").attr("src","/public/uploads/page-cover-photo/thumb/"+imgname);
});

$("#coverphoto").change(function() {
    readURLCOVER(this);
});

</script>

<script>
$(document).ready(function () { 
	
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
	<?php if(Auth::check()) { ?>
	$("#resetPassword").click(function () {
		formdata = new FormData();
		var token = '{{csrf_token()}}';
		var email = '{{Auth::user()->email}}';
		formdata.append("_token", token);
		formdata.append("email", email);
		$.ajax({
			url: '/password/email',
			type: 'POST',
            xhrFields: {
                    withCredentials: true
                },
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
	<?php } ?>
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
                url: "{{url('/pagePostcomment')}}" + "/"+postId,
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
	$(document).on('click', '.showcomments', function(){
		var commentdisplay = $('#commentdisplay').val();
		var postId =$(this).attr('id');
		$('.commentappendremove').html("");
		$.ajax({
			url: "{{url('/pageshowcomments')}}" + "/"+postId,
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
	$(document).on('click', '.commentlike', function(){
		var _token = $("input[name='_token']").val();
		var comId =$(this).attr('id');
		var postId =$(this).attr('post-id');
		$.ajax({
			url: "{{url('/commentLike')}}" + "/"+comId,
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
	$(document).on('click', '.thumblike', function(){
		var _token = $("input[name='_token']").val();
		var postId =$(this).attr('postid');
		var is_like = $(this).attr('is_like');
		var posttype = $(this).attr('posttype');
		$.ajax({
			url: "{{url('/like-pagepost')}}" + "/"+postId,
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
            xhrFields: {
                    withCredentials: true
                },
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
						if(posttype=='saved') { $("#listsavepostid"+postId).remove(); }
						if(posttype=='post') { $("#listpostid"+postId).remove(); }
					}
				}
			});
		}
		else{ return false; }
	});
	$(".followPage").click(function(){
		var _token = $("input[name='_token']").val();
		var pageid = $(this).attr('pageid');
		var userid = $(this).attr('userid');
		
		$.ajax({
			type: 'POST',
			url: '{{route("followPage")}}',
            xhrFields: {
                    withCredentials: true
                },
			data: {
			  _token: _token,
			  pageid:pageid,
			  userid:userid
			},
			success: function(data) {
				if(data.type=='success'){ 
                    $("#profilecontrol").load(" #profilecontrol > *"); 
                    $(".followdiv").load(" .followdiv > *"); 
                }
			}
		});
	});
		
</script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>    
@endsection


