@extends('layouts.app')

@section('content')

@include('includes.search_banner')

<link href="<?php echo Config::get('constants.FRONT_CSS'); ?>dropzone.css" rel="stylesheet">
<link href="<?php echo Config::get('constants.FRONT_CSS'); ?>feedpost/jquery.lightbox-0.5.css" rel="stylesheet">
<link href="<?php echo Config::get('constants.FRONT_CSS'); ?>lightbox2.min.css" rel="stylesheet">
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>lightbox-plus-jquery.min.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>lightbox.js"></script>
<div class="profile-div">

  <div class="container">
    <!-- profile detail starts -->
    <div class="profile-con">
    <div class="nw-dtl-edit"><div id='systemMessage_timeline'></div></div>
      <!-- profile detail left starts -->
            <div class="profilecon-left">
                <span class="today-title">Today</span>
                <div class="profile-div-padding">
                  <div class="profile-list-main" id="profileListMain">
                      {{-- Load Feeds with Like --}}
                      @if ($feed) 
                      {!! getFeedHtmlByType($feed) !!} 
                       @else 
                        No record found.
                      @endif
                      
                  </div>
                </div>
            </div>
                <!-- profile detail left ends -->
        </div>
    <!-- profile details ends -->

  </div>

</div>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>dropzone.js"></script>
<script type="text/javascript">

      $(document).ready(function(){
        $('html, body').animate({
          scrollTop: $('.profile-div').offset().top}, 'slow');
        });

      $.noConflict();

      Dropzone.autoDiscover = false;

      var galleryDropZone = new Dropzone("#myImageUploadZone", 
      {
          url:                "{!! route('timeline.upload-gallery-feed') !!}",
          maxFiles:           10,
          dictDefaultMessage: "Drop Files here or Click Here to Upload Images",
          addRemoveLinks:     true,
          uploadMultiple:     true,
          parallelUploads:    10,
          acceptedFiles:      ".jpg, .jpeg, .png, .gif",
          addRemoveLinks:     false,
          autoProcessQueue:   false,
          success: function(file, response) 
          {
            var jsonResponse = jQuery.parseJSON(response);

            if( typeof jQuery("#profileId-"+jsonResponse.feed_id) == "undefined" ||  jQuery("#profileId-"+jsonResponse.feed_id).length < 1)
            {
              ProfileFeed.ProfileFeedList.successContentFeedEvent(jsonResponse);
              jQuery("#imagecontentPostTitle").val("My Gallery Title");
              file.previewElement.classList.add("dz-success");  
            }
            console.log(jsonResponse);
            
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
          addRemoveLinks:     false,
          autoProcessQueue:   false,
          success: function(file, response) 
          {
              var jsonResponse = jQuery.parseJSON(response);
              ProfileFeed.ProfileFeedList.successContentFeedEvent(jsonResponse);
              jQuery("#videocontentPostTitle").val("My Video Title");
              file.previewElement.classList.add("dz-success");
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
      
    });    
</script>
@endsection
