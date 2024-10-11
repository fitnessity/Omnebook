@extends('layouts.profile')

@section('content')
<link href="{{url('public/css/dropzone.css')}}" rel="stylesheet">
<link href="{{url('public/feedpost/jquery.lightbox-0.5.css')}}" rel="stylesheet">
<link href="{{url('public/lightbox2.min.css')}}" rel="stylesheet">
<script src="{{url('public/js/lightbox-plus-jquery.min.js')}}"></script>
<script src="{{url('public/js/lightbox.js')}}"></script>
<div class="profile-div">

	<div class="container">

	<!-- user detail section starts -->
		<div class="user-detail">
			<div class="user-left">
				<div class="avtar">
				<?php
        // echo '<pre>'; print_r($useradsplans); die();
				      if($user['profile_pic'] != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR.$user['profile_pic'])) {
				        echo '<img src="'.Config::get('constants.USER_IMAGE_THUMB150').$user['profile_pic'].'" height="135" width="135" />';
				      }
				      else {
				        echo '<img src="'.Config::get('constants.FRONT_IMAGE').'user.png" height="135" width="135" />';
				      }
			     ?>
                </div>
                <div class="user-name">
                   	<h4>{{ $user['firstname'] }} {{ $user['lastname'] }}</h4>{{ $user['email']}}</br>
                   	</br>
                    <p>{{ Auth::user()->about_me }}</p>
                   	<a href="/profile/viewProfile"><span><i class="fa fa-pencil"></i></span> Edit Profile</a>
                </div>
			</div>
			<div class="user-right">
                <table>
                   	<tr>
                   		<!-- <td>Designation :</td> -->
                      <td>Profession :
                   		<td>{{ $userCurrentwork['position'] }}</td>
                   	</tr>
                   	<tr>
                   		<!-- <td>Connection:</td> -->
                      <td>Network :</td>
                   		<td>{{ Auth::user()->network_count }}</td>
	                </tr>
                   	<tr>                   		
                      <td>Followers :
                   		<td>{{ $userFollowers }}</td>
                   	</tr>
                    <tr>
                      <td>Location :
                      <td>{{ $user['states']['state_name'] }} ,
                          {{ $user['countries']['country_name'] }}
                      </td>
                    </tr>
                </table>
                <p><span>13</span></br>
                People viewed your profile this week</p>
             </div>
		</div>
		<!-- user detail section ends -->

		<!-- profile tab section starts -->

		<div class="profile-tab">
  			<ul class="nav nav-tabs">
    			<li class="active">
    				<a data-toggle="tab" href="#home">
    					<i class="fa fa-commenting" aria-hidden="true"></i>
					</a>
				</li>
    			<li>
    				<a data-toggle="tab" href="#menu1">
    					<i class="fa fa-picture-o" aria-hidden="true"></i>
					</a>
				</li>
    			<li>
    				<a data-toggle="tab" href="#menu2">
    					<i class="fa fa-file-video-o" aria-hidden="true"></i>
					</a>
				</li>
    			<li>
    				<a data-toggle="tab" href="#menu3">
    					<i class="fa fa-map-marker" aria-hidden="true"></i>
					</a>
				</li>
  			</ul>
  			<div class="tab-content">
    			<div id="home" class="tab-pane fade in active">
          <div id="homesuccessdiv">&nbsp;</div>
      				<form class="tabone-form">
      					<input type="text" id="contentPostTitle" name="content_post_title" placeholder="What's on your mind?" />
      					<button type="button" class="content-post-btn"> POST</button>
      				</form>
    			</div>
    			<div id="menu1" class="tab-pane fade">
              <div class="image_upload_div">
                <div id="menu1msgdiv"></div>
                <div id="menu1successdiv">&nbsp;</div>
                <form action="upload.php" class="tabone-form dropzone" id="myImageUploadZone">
                    <input type="text" id="imagecontentPostTitle" placeholder="My Gallery Title" name="image_content_post_title" style="width: 86%"; />
                    <button type="button" class="gallery-post-btn"> POST</button>
                    <div class="clearfix"></div>
                </form>
              </div> 
    			</div>
    			<div id="menu2" class="tab-pane fade">
              <div class="video_upload_div">
                <div id="menu2msgdiv"></div>
                <div id="menu2successdiv">&nbsp;</div>
                <form action="upload.php" class="tabone-form dropzone" id="myAwesomeDropzone">
                    <input type="text" id="videocontentPostTitle" placeholder="My Video Title" name="video_content_post_title" style="width: 86%"; />
                    <button type="button" class="video-post-btn"> POST</button>
                    <div class="clearfix"></div>
                </form>
              </div> 
    			</div>
    			<div id="menu3" class="tab-pane fade">
     				<form class="tabone-form">
      					<input type="text" placeholder="Enter Location"/>
      					<button type="button"> POST</button>
      				</form>
    			</div>
  			</div>
        </div>
		<!-- profile tab section ends -->

		<!-- profile detail starts -->
		<div class="profile-con">
    <div class="nw-dtl-edit"><div id='systemMessage_timeline'></div></div>
			<!-- profile detail left starts -->
            <div class="profilecon-left timeline-scrollbar infinite-scroll">
                <span class="today-title">Today</span>
                <div class="profile-div-padding">
                  <div class="profile-list-main" id="profileListMain">
                      {{-- Load Feeds with Like --}}
 							        @include('timeline.timeline-feeds')
                  </div>
                </div>
            </div>
                <!-- profile detail left ends -->

                <!-- profile detail sidebar starts -->
                <div class="profile-sidebar">
                  
                    <div class="get-start">
                      <img src="<?php echo Config::get('constants.FRONT_IMAGE');?>get-start-img.jpg" height="308"  width="333" />
                      <p>Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante pellentesque habitant morbi tristique</p>
                      <a href="#">Get Started</a>
                    </div>                      
                  
                    <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>sidebarimg-2.jpg" height="461" width="322" />
                  
                      <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>sidebarimg-3.jpg" height="226" width="322" />
                </div>
                <!-- profile detail sidebar ends -->
        </div>
		<!-- profile details ends -->

	</div>

</div>
<div class="modal fade" id="share-feed-responsediv" role="dialog">
    <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body login-pad" style="margin-left: 25% !important;">
                <div id="share-feed-response-message"></div>
                <div class="signleft"></div>
            </div>            
          </div>
    </div>
</div> 
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>dropzone.js"></script>
<script type="text/javascript">

      // $.noConflict();

      Dropzone.autoDiscover = false;

      var galleryDropZone = new Dropzone("#myImageUploadZone", 
      {
          url:                "{!! route('timeline.upload-gallery-feed') !!}",
          maxFiles:           20,
          dictDefaultMessage: "Drop Files here or Click Here to Upload Images",
          addRemoveLinks:     true,
          uploadMultiple:     true,
          parallelUploads:    20,
          acceptedFiles:      ".jpg, .jpeg, .png, .gif",
          autoProcessQueue:   false,
          init: function() {
            this.on("maxfilesexceeded", function(file){
                $("#menu1msgdiv").addClass("booking-rejected-text");
                $("#menu1msgdiv").html("Maximum 20 files can be uploaded");
                this.removeFile(file);
            });
          },
          removedfile: function(file) {
              var name = file.name;   
              if(this.getQueuedFiles().length < 20) {
                $("#menu1msgdiv").html("");
              }
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;        
          },
          success: function(file, response) 
          {


            var jsonResponse = jQuery.parseJSON(response);

            if( typeof jQuery("#profileId-"+jsonResponse.feed_id) == "undefined" ||  jQuery("#profileId-"+jsonResponse.feed_id).length < 1  && jsonResponse.success == true)
            {
              ProfileFeed.ProfileFeedList.successContentFeedEvent(jsonResponse);
              jQuery("#imagecontentPostTitle").val("My Gallery Title");
              file.previewElement.classList.add("dz-success");

              $("#menu1successdiv").addClass("booking-booked-text");
              // $("#menu1successdiv").html("Successfully Posted!");
              showSystemMessages("", "success", "Successfully Posted!", "");
              setTimeout(
                function() 
                {
                  $("#menu1successdiv").html("&nbsp;");
                }, 1000);
            }else{
              showSystemMessages("", "danger", jsonResponse.message, "");
            }
          },
          error: function (file, response) 
          {
              file.previewElement.classList.add("dz-error");
          },
          complete: function()
          {
            if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
            {
                var _this = this;
                _this.removeAllFiles();
            }
          }
      });

      var myDropzone = new Dropzone("#myAwesomeDropzone", {
          url:                "{!! route('timeline.upload-video-feed') !!}",
          maxFiles:           1,
          dictDefaultMessage: "Drop Video (Mp4) here or Click Here to Upload Video ( mp4 only )",
          acceptedFiles:      ".mp4",
          addRemoveLinks:     true,
          autoProcessQueue:   false,
          init: function() {
            this.on("maxfilesexceeded", function(file){
                $("#menu2msgdiv").addClass("booking-rejected-text");
                $("#menu2msgdiv").html("Maximum 1 video file can be uploaded");
                this.removeFile(file);
            });
          },
          removedfile: function(file) {
              var name = file.name;   
              if(this.getQueuedFiles().length < 1) {
                $("#menu2msgdiv").html("");
              }
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;        
          },
          success: function(file, response) 
          {
              var jsonResponse = jQuery.parseJSON(response);
              ProfileFeed.ProfileFeedList.successContentFeedEvent(jsonResponse);
              jQuery("#videocontentPostTitle").val("My Video Title");
              file.previewElement.classList.add("dz-success");

              $("#menu2successdiv").addClass("booking-booked-text");
              // $("#menu2successdiv").html("Successfully Posted!");
              showSystemMessages("", "success", "Successfully Posted!", "");
              setTimeout(
                function() 
                {
                  $("#menu2successdiv").html("&nbsp;");
                }, 1000);
          },
          error: function (file, response) 
          {
              file.previewElement.classList.add("dz-error");
          },
          complete: function()
          {
            if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
            {
                var _this = this;
                _this.removeAllFiles();
            }
          }
      });

    jQuery(document).ready(function()
    {
      ProfileFeed.FeedPost.init();

      var loader = 0;
      var offset = 10;
      var all_feeds_loaded = 0;

      $('.infinite-scroll').on('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
            
            if(loader == 0 && all_feeds_loaded == 0){

              loader = 1;

              $('.infinite-scroll > .profile-div-padding > .profile-list-main').append('<center class="timeline_loader"><i class="fa fa-spinner fa-spin fa-3x fa-fw margin-bottom" aria-hidden="true"></i><br><br></center>');  
              
              var posturl = '/timeline-get-all-feed';

              $.ajax({
                url:posturl,
                type:'POST',
                dataType: 'json',
                data: { '_token': "{{ csrf_token() }}", 'user_id': "{{ $user['id'] }}", 'offset':offset },
                complete: function (response) {
                  
                  loader = 0;
                  $( ".timeline_loader" ).remove();

                  if(response.responseText){
                  
                    $('.infinite-scroll > .profile-div-padding > .profile-list-main').append(response.responseText);
                  
                  } else {

                      all_feeds_loaded = 1;
                      $('.infinite-scroll > .profile-div-padding > .profile-list-main').append("<center>You've reached the bottom of the page.</center>"); 
                  }

                  offset = offset + 10;
                }
              });

              // loader = 0;
            }
        }
      })

    });
</script>
@endsection