<?php // @extends('layouts.profile') ?>

<?php // @section('content') ?>

<?php // <div class="business-offer-main"> ?>

    <?php // @include('includes.sidebar_profile_left') ?>

  <?php // <div class="business-middle"> ?>

  <?php // @include('includes.profile_tab_menu')     ?>



      <div class="busines-offer-list busines-off-profile-list">
        <div class="job_block">
           <div id="myTabContent" class="tab-content"> 
              <div id="reponseMessage"></div>
              <div class="job_listing" id="mediaListMain">
                  @if ($responseObj) 
                  {!! $responseObj !!}
                  @else
                   <span>No record found</span>
                  @endif
              </div>
            </div>
             <div>
            @if ($responseObj && $offset < $mediaTotalCount) 
            <a href="javascript:void(0);" data-id="'.$media->id.'"  class="media-view-more">View More</a> 
             @endif 
            </div>
        </div>
      </div>
     
  <?php // </div>  ?>  


  <?php // @include('includes.sidebar_profile_right') ?>

<?php // </div> ?>
<?php /*
<input type="hidden" id="ajaxToken" name="_token" value="{{ csrf_token() }}">
<input type="hidden" id="mediaOffset" name="mediaOffset" value="{{ $offset }}">
<input type="hidden" id="mediaSize" name="mediaSize" value="{{ $limit }}">
<input type="hidden" id="mediaType" name="mediaType" value="{{ $mediaType }}">
<input type="hidden" id="mediaTotalCount" name="mediaTotalCount" value="{{ $mediaTotalCount }}">
<script type="text/javascript">

  var moduleConfig = {
      feedLikeUrl:                       "{!! route('timeline.feed-like') !!}",
      feedUnlikeUrl:                     "{!! route('timeline.feed-unlike') !!}",
      addTimeLineFeedContent:            "{!! route('timeline.add-feed-content', ['myfeed' => true]) !!}",
      shareTimeLineFeed:                 "{!! route('timeline.share-time-line-feed') !!}",
      timeLineFeedComment:               "{!! route('timeline.post-comment') !!}",
      updateCommentText:                 "{!! route('timeline.edit-post-comment') !!}",
      deleteCommentText:                 "{!! route('timeline.delete-comment') !!}",
      showAllComments:                   "{!! route('timeline.feed-comments') !!}",
      getSingleProfileFeedURL:           "{!! route('timeline.get-ajax-single-personal-feed')!!}",
      getFeedURL:                        "{!! route('timeline.get-ajax-feed') !!}",
      removeMediaImageFromGalleryURL:    "{!! route('timeline.ajax-remove-media-item-gallery') !!}",
      editUploadGalleryFeedURL:          "{!! route('timeline.edit-upload-gallery-feed') !!}",
      editUploadGalleryTitleURL:         "{!! route('timeline.edit-gallery-feed-title') !!}",
      editUploadVideoFileURL:            "{!! route('timeline.edit-feed-video-file') !!}",
      removeFeedPost:                    "{!! route('timeline.delete-feed-post') !!}",
      reportFeedURL:         "{!! route('timeline.report-feed') !!}",
      showAllReplies:                   "{!! route('timeline.feed-replies') !!}",
      viewMoreMedia:            "{!! route('timeline.view-more-media', ['myfeed' => true]) !!}",
      addToFavoriteMedia:                    "{!! route('timeline.ajax-add-favorite-media') !!}",
      removeToFavoriteMedia:                    "{!! route('timeline.ajax-remove-favorite-media') !!}"
  }

  jQuery(document).ready(function()
  {
    ProfileFeed.ProfileFeedList.init();
    ProfileFeed.FeedPost.init();
  });
</script>

<script src="<?php echo Config::get('constants.FRONT_JS'); ?>sweet-alert/sweetalert.min.js"></script>
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>dropzone.js"></script>
<script type="text/javascript">

      Dropzone.autoDiscover = false;

      var galleryDropZone = new Dropzone("#myImageUploadZone", 
      {
          url:                "{!! route('timeline.upload-gallery-feed', ['myfeed' => true]) !!}",
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
              $("#menu1successdiv").html("Successfully Posted!");
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
          url:                "{!! route('timeline.upload-video-feed', ['myfeed' => true]) !!}",
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
              $("#menu2successdiv").html("Successfully Posted!");
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

      var updateGalleryDropZone = new Dropzone("#dzUpdateProfileGalleryFeed", 
            {
                url:                moduleConfig.editUploadGalleryFeedURL,
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
                  jQuery('#editFeedContainer').modal('hide'); 
                }
            });

    var updateVideoDropZone = new Dropzone("#dzUpdateProfileVideoFeed", {
        url:                moduleConfig.editUploadVideoFileURL,
        maxFiles:           1,
        dictDefaultMessage: "Drop video here or Click here to Replace this video ( mp4 only )",
        acceptedFiles:      ".mp4",
        addRemoveLinks:     false,
        autoProcessQueue:   false,
        success: function(file, response) 
        {
            var jsonResponse = jQuery.parseJSON(response);
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
          jQuery('#editFeedContainer').modal('hide'); 
        }
    });
</script>
*/?>

<?php // @endsection ?>