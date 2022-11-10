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
    use App\PageLike;
	use App\PagePostComments;
	use App\PagePostCommentsLike;
	use App\PagePostLikes;
	use App\PagePostSave;
	use App\BusinessService;
	use App\BusinessExperience;
	use App\BusinessReview;
    use App\BusinessPostViews;
	
?>
<style>
.removepost{ height: auto !important; }
.viewdisplay{display: inline-block !important;}
.colorshade{color: #FF1493 !important;}
.colorshade p{font-weight: 800 !important;}
</style>
<?php 
$loggedinUser = ''; $customerName ='';$compinfo =''; $profilePicture =''; $coverPicture ='';

	$loggedinUser = Auth::user();
	$customerName = $loggedinUser->firstname . ' ' . $loggedinUser->lastname;
	//$compinfo = CompanyInformation::where('user_id',Auth::user()->id)->first();
	$compinfo = CompanyInformation::where('id',request()->page_id)->first();
	$profilePicture = $loggedinUser->profile_pic;
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
<div class="banner banner-fs bannerstyle">
    <?php   $totalcount = count($viewgallery);
        $rem = 4 -$totalcount;
    ?>
    @if (!empty($viewgallery))
        @foreach (array_slice($viewgallery, 0, 4) as $pic)
            <div class="business-slider">
                <img src="/public/uploads/page-cover-photo/thumb/<?= $pic['name'] ?>" alt="images" class="img-fluid">
                <i class="fa fa-pen editpic editpic-fs"  id="{{$pic['id']}}"  imgname="{{$pic['name']}}" data-toggle="modal" data-target="#uploadgalaryPic"></i>
            </div>
        @endforeach
    @endif
    @for($i=0 ; $i<$rem ; $i++)
	<div class="business-slider">
		<img src="/public/images/newimage/uploadphoto.jpg" alt="images" class="img-fluid">
		<i class="fa fa-pen editpic editpic-fs" id="0" imgname="10.jpg" data-toggle="modal" data-target="#uploadCoverPic"></i>
	</div>
    @endfor
	<!-- <div class="business-slider">
		<img src="/public/images/newimage/black-bg-logo.jpg" alt="images" class="img-fluid">
        <i class="fa fa-pen editpic editpic-fs" id="0" imgname="10.jpg" data-toggle="modal" data-target="#uploadCoverPic"></i>
	</div>
	<div class="business-slider">
		<img src="/public/images/newimage/black-bg-logo.jpg" alt="images" class="img-fluid"><i class="fa fa-pen editpic editpic-fs" id="0" imgname="10.jpg" data-toggle="modal" data-target="#uploadCoverPic"></i>
	</div>
	<div class="business-slider">
		<img src="/public/images/newimage/black-bg-logo.jpg" alt="images" class="img-fluid">
        <i class="fa fa-pen editpic editpic-fs" id="0" imgname="10.jpg" data-toggle="modal" data-target="#uploadCoverPic"></i> 
	</div>-->
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
            <div class="col-lg-2 col-sm-2">
                <div class="comp-mark">
                        @if(File::exists(public_path("/uploads/profile_pic/thumb/".$company['logo'])) && $company['logo']!='' )
                        <img src="{{ url('/public/uploads/profile_pic/thumb/'.$company['logo']) }}" alt="images" class="img-fluid">
                        @else
                            <?php
                            echo '<div class="company-profile-text">';
                            $pf=substr($company->company_name, 0, 1);
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

                <!-- Modal -->
                <div class="modal fade" id="editProfilePic" role="dialog">
                    {!! Form::open(array('url'=>url('/profile/editPageProPic'),'method'=>'POST','files' => true , 'enctype' => 'multipart/form-data', 'id' => 'frmeditProfile_side')) !!}
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
                                        <input type="hidden" name="page_id" value="{{request()->page_id}}">
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

                <!-- Modal -->
                <div class="modal fade" id="editusername" role="dialog">
                    {!! Form::open(array('url'=>url('editUsername'),'method'=>'POST')) !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-dialog modal-lg">
                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-body login-pad">
                                <div class="pop-title employe-title">
                                    <h3>EDIT USERNAME</h3>
                                </div>                               
                                <div class="signup">
                                    <div class="emplouyee-form">
                                        <input class="" type="text" name="username" id="username" class="form-control">
                                       
                                        <button type="submit">Submit</button>
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
                        <h2 style="text-transform: capitalize;">@if($company->dba_business_name != '') {{$company->dba_business_name}} @else {{$company->company_name}} @endif <!-- <i class="fa fa-pencil usernameedit" id="{{$customerName}}" style="color: #f53b49" data-toggle="modal" data-target="#editusername"></i>-->
                    <?php /*?><span>Claimed</span><?php */?>
					<!--<img src="https://upload.wikimedia.org/wikipedia/en/a/a4/Flag_of_the_United_States.svg" alt="images" width="45" height="20">-->
					   </h2></div>
                    <div class="viewdisplay colorshade"><p>{{$claim}}</p></div>
                    @if(isset($company->about_company))
                    	<h6> {{$company->about_company}} </h6>
                    @endif
					<div class="url-copy">	
						<div> 
							<p>
								<a class="colorgrey" href="<?php echo config('app.url'); ?>/businessprofile/<?php echo strtolower(str_replace(' ', '-', $company->company_name)).'/'.$company->id; ?> ">
							<?php echo config('app.url'); ?>/businessprofile/<?php echo strtolower(str_replace(' ', '-', $company->company_name)).'/'.$company->id; ?> </a> </p>
							<!-- <button onclick="myFunction()" style="background: white;border: none; margin-left: 10px;">Copy URL</button>-->
					   </div>
					  		
					</div>
					
                </div>
            </div>

            <div class="col-lg-4 col-sm-4 top-1">
                <div class="reatingbox">
                <?php
					$reviews_count = BusinessReview::where('page_id', request()->page_id)->count();
					$reviews_sum = BusinessReview::where('page_id', request()->page_id)->sum('rating');
					$reviews_avg=0;
					if($reviews_count>0)
					{ $reviews_avg = round($reviews_sum/$reviews_count,2); 
				?>
                		<h5><i class="fa fa-star rating-pro"></i>
                        	<span><?php echo number_format($reviews_avg,1); ?> </span>({{$reviews_count}}) </h5> 
                <?php } ?>
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
							  <li><a href="http://fitnessity.co/{{$UserProfileDetail->username}}" class="share facebook"><i class="fa fa-facebook"></i></a></li>
							  <li><a href="http://fitnessity.co/{{$UserProfileDetail->username}}" class="share twitter"><i class="fa fa-twitter"></i></a></li>
							  <!-- <li><a href="#" class="googlePlus"><i class="fa fa-google-plus"></i></a></li> 
							  <li><a href="http://fitnessity.co/{{$UserProfileDetail->username}}" class="share linkedin"><i class="fa fa-linkedin"></i></a></li>
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
                        <a href="http://fitnessity.co/{{$UserProfileDetail->username}}" class="share facebook btn btn-primary"><i class="fa fa-facebook"></i> Facebook</a>
                            <a href="http://fitnessity.co/{{$UserProfileDetail->username}}" data-text="7000+ latest Free jQuery plugins with examples and tutorials for web &amp; mobile developers." class="share twitter btn btn-info"><i class="fa fa-twitter"></i> Twitter</a>
                            <a href="http://fitnessity.co/{{$UserProfileDetail->username}}" data-text="7000+ latest Free jQuery plugins with examples and tutorials for web &amp; mobile developers." class="share linkedin btn btn-default"><i class="fa fa-linkedin"></i> LinkedIn</a>
                            <a href="http://fitnessity.co/{{$UserProfileDetail->username}}" class="share google-plus btn btn-danger"><i class="fa fa-google-plus"></i> Google Plus</a>
                    </div>-->
                </div>
            </div>

        </div>
    </div>
</section>

<!--<section class="sticky-top">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-4">
                <div class="name-div border-0">
                    <!--<span><a href="#mydesc" style="color:#ffffffb3"> About </a></span>
                    <span><a href="#photo" style="color:#ffffffb3"> Photos </a></span>
                    <span><a href="#video-box" style="color:#ffffffb3"> Videos </a></span>
                    <span><a href="#family-id" style="color:#ffffffb3"> Family </a></span>
                </div>
            </div>
            <div class="col-lg-8">
               <!-- <div class="row clamwithblack">
                    <a href="{{route('user-profile')}}" style="float: right"><div class="claim-business"> Edit Profile </div></a>
                    @if(isset($companies) && !empty($companies[0]))
                    <a href="{{route('manageCompany')}}" style="float: right"><div class="claim-business"> Manage Business </div></a>
                    @else
                    <a href="#" style="float: right"><div class="claim-business"> Create Business </div></a>
                    @endif
                    {{-- <a href="javascript::void(0);" style="float: right" data-toggle="modal" data-target="#editProfileDetailModal"><div class="claim-business"> Edit Profile </div></a>
                    <a href="{{url('/profile/createProfileSecurity')}}" style="float: right" ><div class="claim-business"> Add/Edit Security Questions </div></a>
                    <a href="{{url('/profile/change-password')}}" style="float: right" ><div class="claim-business"> Change Password</div></a> --}}
                </div>
            </div>
        </div>
    </div>
</section>-->

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
                                        <input type="hidden" name="page_id" value="{{request()->page_id}}">
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
                                    <input type="hidden" name="pageid" value="{{request()->page_id}}">
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
                                	<form method="post" action="{{route('pagePostupdate')}}" enctype="multipart/form-data" >
                                            @csrf
                                    	<div class="friend-info">
                                        	<figure>
                                        	<?php if(File::exists(public_path("/uploads/profile_pic/thumb/".$loggedinUser->profile_pic ))){ ?>
                                            	<img src="{{ url('/public/uploads/profile_pic/thumb/'.$loggedinUser->profile_pic) }}" alt="Fitnessity">
                                            <?php }else{ 
												$pf=substr($loggedinUser->firstname, 0, 1).substr($loggedinUser->lastname, 0, 1);
                                                echo '<div class="admin-img-text"><p>'.$pf.'</p></div>';
                                            } ?>
                                            </figure>
                                            <div class="friend-name">
                                                <ins><a href="#" title="">{{ucfirst($loggedinUser->firstname)}} {{ucfirst($loggedinUser->lastname)}}</a></ins>
                                            </div>
                                            <input type="text" class="post_textemoji" id="post_textemoji"  name="post_text_upd" data-emojiable="true" >     
                                            <div class="post-meta" id="edit_image"></div>
                                            <button class="post-btn " type="submit" data-ripple="">Update Post</button>
                                    	</div>
                                 	</form>
                                </div>
                            </div> <!-- central-meta -->
                        <!-- end foreach -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="editProfileDetailModal" role="dialog">
    <!-- <form  id="frmeditProfileDetail" method="post"> -->
    {!! Form::open(array('id' => 'frmeditProfileDetail')) !!}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body login-pad">
                <div class="pop-title employe-title">
                    <h3>EDIT Personal Info</h3>
                </div>
                <button type="button" class="close modal-close" data-dismiss="modal">
                    <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
                </button>
                <div class="signup">
                    <div id='systemMessage_detail'></div>
                    <div class="emplouyee-form">
                        <input type="text" name="firstname" id="frm_firstname" placeholder="First Name" value="{{ old('firstname',$UserProfileDetail['firstname']) }}">
                        <input type="text" name="lastname" id="frm_lastname" placeholder="Last Name" value="{{ old('lastname',$UserProfileDetail['lastname']) }}">
                        <input type="text" name="username" id="frm_username" placeholder="User Name" value="{{ old('username',$UserProfileDetail['username']) }}">
                        <?php $gender = array('' => 'Select Gender', 'Male' => 'Male', 'Female' => 'Female'); ?>
                        <div class="select-style review-select2">
                            <!--{!! Form::select('gender', $gender, $UserProfileDetail['gender'], ['class' => 'selectpicker', 'id' => 'frm_gender']) !!}-->
                            <select name="gender" class="form-control" id="frm_gender">
                                <option hidden>Select Gender</option>
                                <option value="male" {{ (old('gender',$UserProfileDetail['gender'])=='male')?'selected':'' }}>Male</option>
                                <option value="female" {{ (old('gender',$UserProfileDetail['gender'])=='female')?'selected':'' }}>Female</option>
                            </select>
                        </div>
                        <input type="text" name="email" id="frm_email" placeholder="Email" readonly class="disable-input" value="{{ old('email',$UserProfileDetail['email']) }}">
                            <!-- <input type="text" name="phone_number" id="frm_phone_number" placeholder="(XXX) XXX XXX" value=""> -->
                        <input type="text" name="phone_number" required placeholder="(xxx)xxx-xxxx" class="form-control" data-inputmask='"mask": "(999)999-9999"' data-mask value="{{ old('phone_number',$UserProfileDetail['phone_number']) }}">
                            <!--<input type="text" name="address" id="frm_address" placeholder="Address" maxlength="255">-->
                        <input autocomplete="nope" type="text" name="address" id="frm_address" oninput="initialize1(this)" placeholder="Address" value="{{ old('address',$UserProfileDetail['address']) }}">
                        <input type="text" name="city" id="frm_city" placeholder="City" value="{{ old('city',$UserProfileDetail['city']) }}">
                        <input type="text" name="state" id="frm_state" placeholder="State" value="{{ old('state',$UserProfileDetail['state']) }}">
                        <input type="text" name="country" id="frm_country" placeholder="Country" value="{{ old('country',$UserProfileDetail['country']) }}">
                        <input type="text" name="zipcode" id="frm_zipcode" placeholder="Zipcode" maxlength="6" value="{{ old('zipcode',$UserProfileDetail['zipcode']) }}">
                        <textarea placeholder="Intro ..." name="intro" id="message_area" rows="7" maxlength="120" required>@if(isset($UserProfileDetail['intro'])){!! $UserProfileDetail['intro'] !!}@endif</textarea>
                        <p>
                            <span class="hint" style="color:red" id="textarea_message">
                        </p>
                        <textarea placeholder="Tell Us Somthing About You..." name="about_me" id="about_msg" rows="7" maxlength="300" required>@if(isset($UserProfileDetail['about_me'])){!! $UserProfileDetail['about_me'] !!}@endif</textarea>
                        <p>
                            <span class="hint" style="color:red" id="aboutarea_message">
                        </p>
                        <button type="button" id="submit_profiledetail" onclick="$('#frmeditProfileDetail').submit();">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

<section class="desc-sec">
    <div class="container-fluid">
        <div class="row">
        	<div class="col-sm-12 col-md-3 col-lg-3">
            	@include('profiles.businessProfileLeftPanel')
            </div>
			
            <div class="col-sm-12 col-md-9 col-lg-9">
			
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12">
					<div class="profile-section">
					<div class="row flex-column-reverse flex-md-row">
						<div class="col-sm-12 col-md-12 col-lg-9 tabs-business-view">
						<!--<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">First Panel</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Second Panel</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Third Panel</a>
								</li>
							</ul>
							<!--<div class="tab-content">
								<div class="tab-pane active" id="tabs-1" role="tabpanel">
									<p>First Panel</p>
								</div>
								<div class="tab-pane" id="tabs-2" role="tabpanel">
									<p>Second Panel</p>
								</div>
								<div class="tab-pane" id="tabs-3" role="tabpanel">
									<p>Third Panel</p>
								</div>
							</div>-->
						
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
								<a class="nav-link" href="#videos">Videos</a>
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
							
                            <?php /*if($loggedinUser->id == $company->user_id) { ?>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#tabs-5" role="tab">Saved</a>
							</li>
							<?php }*/ ?>
							
						</ul>
					</div>
							<div class="col-sm-12 col-md-12 col-lg-3">
								<ol class="folw-detail">
                                	<?php $totpost = PagePost::where('user_id', $company->user_id)->where('page_id', request()->page_id)->count(); 
                                    $totFollowers = PageLike::where('pageid', request()->page_id)->count();
                                    $totFollowings = PageLike::where('follower_id', Auth::user()->id)->count();?>
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
            <div class="" id="videos">
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
									/*if (!empty($videos)) 
									{
										foreach($videos as $data)
										{*/ ?>
                                           	<!-- <div class="row">
												<div class="col-sm-12 col-md-12 col-lg-12">
													<div class="video-tab-iframe">
                                                    	<video width="100%" height="400px" controls>
                                                          <source src="{{asset('public/uploads/gallery/')}}/$data->user_id/video/$data->video" type="video/mp4">
                                                          <source src="movie.ogg" type="video/ogg">
                                                          Your browser does not support the video tag.
                                                        </video>
													</div>
												</div>
											</div> -->
                                          <?php 
										/*}
									}*/
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
    		<div class="" id="timeline">
            	<div class="desc-text" id="mydesc">
					<span class="create-post">Timeline
                        <a href="<?php echo config('app.url'); ?>/businessprofile/timeline/<?php echo strtolower(str_replace(' ', '', $compinfo->company_name)).'/'.$compinfo->id; ?>" class="showmore"> Show More <i class="fas fa-caret-right"></i> </a>
                    </span>
                    @if($page_posts->count() == 0 ) 
                        <div class="central-meta item">
                            <div class="user-post">
                                <div class="friend-info">
                                    <figure> @if($compinfo['logo'] != '')
                                            <img src="{{ url('/public/uploads/profile_pic/thumb/'.$compinfo['logo']) }}" alt="fitnessity" class="img-fluid">
                                            @else
                                                <?php
                                                echo '<div class="company-img-text">';
                                                $pf=substr($compinfo->company_name, 0, 1);
                                                echo '<p>'.$pf.'</p></div>';
                                                ?>
                                            @endif</figure>
                                    <div class="friend-name">
                                        <ins><a href="#" title="">{{ucfirst($loggedinUser->firstname)}} {{ucfirst($loggedinUser->lastname)}}</a> Post Album</ins>
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
            	    <div class="loadMore"> <?php $p=1; 
						foreach($page_posts as $page_post){
                        	$PageData = CompanyInformation::where('id',$page_post->page_id)->first();
                        ?>
						  <div class="central-meta item no-border" id="listpostid<?php echo $page_post->id; ?>">
								<div class="user-post">
                                	<?php if($p==1){ ?>
									<?php } ?>
									<div class="friend-info">
                                    	<figure>
                                            @if(File::exists(public_path("/uploads/profile_pic/thumb/".$company['logo'])))
                                            <img src="{{ url('/public/uploads/profile_pic/thumb/'.$company['logo']) }}" alt="fitnessity" class="img-fluid">
                                            @else
                                                <?php
                                                echo '<div class="company-img-text">';
                                                $pf=substr($company->company_name, 0, 1);
                                                echo '<p>'.$pf.'</p></div>';
                                                ?>
                                            @endif
										</figure>
										<div class="friend-name">
											<div class="more">
												<div class="more-post-optns"><i class="fa fa-ellipsis-h"></i>
													<ul>
														@if($loggedinUser->id == $page_post['user_id'])
                                                        	<li><a id="{{$page_post['id']}}" class="editpopup" href="javascript:void(0);"><i class="fa fa-pencil-square-o"></i>Edit Post</a></li>
                                                            <?php /*?><li><a href="{{route('delPost',$page_post['id'])}}"><i class="fa fa-trash"></i>Delete Post</a></li><?php */?>
                                                            <li><a href="javascript:void(0);" class="delpagepost" postid="{{$page_post['id']}}" posttype="post" ><i class="fa fa-trash"></i>Delete Post</a></li>
                                                        @endif
                                                        
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
										<div class="post-meta">
                                            <input type="text" name="abc" data-emojiable="true" data-emoji-input="image" class="removepost" value="{{$page_post->post_text}}" disabled="">
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
                                                                   /* const vid = document.getElementById('vedio{{$page_post->id}}');*/

                                                                    ['playing'].forEach(t => 
                                                                       document.getElementById('vedio{{$page_post->id}}').addEventListener(t, e => vediopostviews('{{$page_post->id}}'))
                                                                    );
                                                                </script>
															</div>
														</div>
													</div>
												@elseif(isset($page_post->music))   
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
                                                                        	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[3]}}" alt="">
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
                                                                   	<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" data-fancybox="gallery">
                                                                       	<img src="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[0]}}" alt="fitnessity">
																	</a>
																</figure>
															</div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6">
																<figure>
																	<a href="{{ URL::to('public/uploads/gallery')}}/{{$userid}}/{{$getimages[1]}}" data-fancybox="gallery">
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
													$loginuser_like = PagePostLikes::where('post_id',$page_post['id'])->where('is_like',1)->where('user_id',$loggedinUser->id)->first();
													$seconduser_like = PagePostLikes::where('post_id',$page_post['id'])->where('is_like',1)->where('user_id','!=',$loggedinUser->id)->first();
                                                    $total_comment='';
													$total_comment = PagePostComments::where('post_id',$page_post->id)->count();$postsaved="";
													$postsaved = PagePostSave::where('post_id',$page_post['id'])->where('user_id',$loggedinUser->id)->first();
													$activethumblike=''; $savedpost='';
													if( !empty($postsaved) ){ $savedpost='activesavedpost'; }
												?>
                                                <ul class="like-dislike" id="ulike-dislike<?php echo $page_post->id; ?>">
                                                    <?php $loginuser_like = PagePostLikes::where('post_id',$page_post['id'])->where('is_like',1)->where('user_id',$loggedinUser->id)->first(); ?>
                                                   	@if(!empty($loginuser_like))
														<?php $activethumblike='activethumblike'; ?>
													@endif
                                                    <li><a id="savepost{{$page_post['id']}}" class="bg-purple savepost <?php echo $savedpost; ?>" href="javascript:void(0);" title="Save to Pin Post" postid="{{$page_post['id']}}" pageid="{{ request()->page_id }}">
														<i class="thumbtrack fas fa-thumbtack"></i></a>
													</li>
                                                    <li><a class="thumbup thumblike <?php echo $activethumblike; ?>" href="javascript:void(0);" title="Like Post" id="like-thumb<?php echo $page_post->id; ?>" postid="{{$page_post['id']}}" is_like="1" posttype="pagepost" ><i class="fas fa-thumbs-up"></i></a></li>
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
												<div class="users-thumb-list" id="users-thumb-list<?php echo $page_post->id; ?>">
													<?php
                                                    	$page_posts_like = PagePostLikes::where('post_id',$page_post->id)->where('is_like',1)->count(); ?>
                                                        @if($page_posts_like>0)
															@if(!empty($loginuser_like))
																<a data-toggle="tooltip" title="" href="#">
                                                                	<img alt="" src="{{ url('/public/uploads/profile_pic/thumb/'.$loggedinUser->profile_pic) }}" height="32" width="32">  
                                                                </a>
                                                            @endif
                                                   			<?php 
																$profile_posts_all = PagePostLikes::where('post_id',$page_post->id)->where('is_like',1)->where('user_id','!=',$loggedinUser->id)->limit(4)->get();?>
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
															$cmntUlike = PagePostCommentsLike::where('comment_id',$comment->id)->where('user_id',Auth::user()->id)->count();
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

                                                @if(File::exists(public_path("/uploads/profile_pic/thumb/".$company['logo'])))
                                                	<img src="{{ url('/public/uploads/profile_pic/thumb/'.$company['logo']) }}" alt="fitnessity" >
                                                @else
                                                    <?php
                                                    echo '<div class="company-img-text">';
                                                    $pf=substr($company->company_name, 0, 1);
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
                                                            <button id="{{$page_post->id}}" class="postcomment theme-red-bgcolor" type="button">Post</button>
														</form> 
													</div>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div><!-- album post -->
    					<?php $p++; 
    					} ?>
                    </div>
            	</div>
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
                                                //$business_name=explode(',', $bexp['frm_organisationname']);
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
                            				<!-- <a class="btn submit-rev mt-10" data-toggle="modal" data-target="#busireview"> Submit Review </a> -->
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
                                                            <a href="<?php echo config('app.url'); ?>/userprofile/{{@$userinfo->username}}" target="_blank" title="{{$userinfo->firstname}} {{$userinfo->lastname}}" target="_blank" title="Purvi Patel" data-toggle="tooltip">
                                                                @if(File::exists(public_path("/uploads/profile_pic/thumb/".$userinfo->profile_pic)))
                                                            <img src="{{ url('/public/uploads/profile_pic/thumb/'.$userinfo->profile_pic) }}" alt="{{$userinfo->firstname}} {{$userinfo->lastname}}">
                                                            @else
                                                                <?php
                                                                $pf=substr($userinfo->firstname, 0, 1).substr($userinfo->lastname, 0, 1);
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
                                                                @if(File::exists(public_path("/uploads/profile_pic/thumb/".$userinfo->profile_pic)))
                                                                <img class="rev-img" src="{{ url('/public/uploads/profile_pic/thumb/'.$userinfo->profile_pic) }}" alt="{{$userinfo->firstname}} {{$userinfo->lastname}}">
                                                                @else
                                                                    <?php
                                                                    $pf=substr($userinfo->firstname, 0, 1).substr($userinfo->lastname, 0, 1);
                                                                    echo '<div class="reviewlist-img-text"><p>'.$pf.'</p></div>'; ?>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-10 pl-0">
                                                            	<h4> {{$userinfo->firstname}} {{$userinfo->lastname}}
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
        	@include('profiles.businessProfileRightPanel')
        </div><!-- col-md-4 -->
        
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
							<input type="hidden" name="page_id" id="page_id" value="{{request()->page_id}}">
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
							</div>
					</form>
				</div>
            </div> <!--body-->
		</div>
	</div>
</div>


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
<!-- emoji -->
<script src="{{ url('public/emoji/lib/js/config.js') }}"></script>
<script src="{{ url('public/emoji/lib/js/util.js') }}"></script>
<script src="{{ url('public/emoji/lib/js/jquery.emojiarea.js') }}"></script>
<script src="{{ url('public/emoji/lib/js/emoji-picker.js') }}"></script>
<script src="{{ url('public/js/date-range-picker.js') }}"></script>
<script src="{{ url('public/js/webcam.min.js') }}"></script>
<script src="{{ url('public/js/jquery.fancybox.min.js') }}"></script>
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
                $(".postinfoulajax"+post_id).load(" .postinfoulajax"+post_id+" >*");
            }
        });
    }

$(document).ready(function(){ 
    $("#actfiloffer option[value='']").attr('selected', true);
    $("#actfillocation option[value='']").attr('selected', true);
    $("#actfilmtype option[value='']").attr('selected', true);
    $("#actfilgreatfor option[value='']").attr('selected', true);
    $("#actfilbtype option[value='']").attr('selected', true);
    $("#actfilsType option[value='']").attr('selected', true);
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
			url: "{{route('editpagepost')}}",
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
   var foldernm = '<?php echo $loggedinUser->id;  ?>';
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
    $('.coemail').attr('href', "{{'mailto:support@fitnessity.com'}}")
    $('.cophone').attr('href', "{{'tel:012345678'}}")
    $('.coaddress').attr('href', "{{'http://maps.google.com/?q=newyork'}}")
    $('.prfl-nme').html('')
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
        xhrFields: {
            withCredentials: true
        },
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
            xhrFields: {
                    withCredentials: true
                },
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
            xhrFields: {
                    withCredentials: true
                },
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
            xhrFields: {
                    withCredentials: true
                },
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
	
</script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>    
@endsection


