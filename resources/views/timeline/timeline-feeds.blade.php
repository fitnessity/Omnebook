<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link href="<?php echo Config::get('constants.FRONT_CSS'); ?>sweet-alert/sweetalert.css" rel="stylesheet">

{{--  @if(count(@$repository->getAllFeeds($user->id)) <= 0)
  {!! "<h4 class='empty-timeline-msg'>No Timeline Post Yet</h4>" !!}
@endif  --}}

{{--  @foreach($repository->getAllFeeds($user->id) as $feed) 
  {!! getFeedHtmlByType($feed) !!}
@endforeach  --}}

 <!-- Modal -->
 <div class="modal fade" id="myModal" role="dialog">
   	<div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body" id="modalBoxBody"></div>
        
        <div class="modal-footer">
          
        </div>
      </div>
      
    </div>
    <input type="hidden" id="modalHelperId" name="modalHelperId">
    
  </div>

  <!-- Edit Modal box -->
 <div class="modal fade edit-modal-box-container" id="editFeedContainer" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div id="text-type" class="tab-pane fade in active">
            <form action="upload.php" class="tabone-form dropzone" id="simpleTextFeedPost">
              <input type="text" id="edit_content_txt_box" name="edit_content_txt_box" style="width: 70%" />
              <button type="button" class="content-post-update-btn"> Update</button>  
              <div class="clearfix"></div>
            </form>
        </div>

        <div id="gallery-type" class="tab-pane fade in active" style="display: none;">
              <form action="upload.php" class="tabone-form dropzone" id="dzUpdateProfileGalleryFeed">
                    <input type="text" id="edit_gallery_txt_box" name="edit_gallery_txt_box" style="width: 70%" />
                    <button type="button" class="gallery-post-update-btn"> Update</button>  
                    <div class="clearfix"></div>
              </form>
        </div>

        <div id="video-type" class="tab-pane fade in active" style="display: none;">
              <form action="upload.php" class="tabone-form dropzone" id="dzUpdateProfileVideoFeed">
                    <input type="text" id="edit_video_txt_box" name="edit_video_txt_box" style="width: 70%" />
                    <button type="button" class="video-post-update-btn"> Update</button>  
                    <div class="clearfix"></div>
              </form>
        </div>

        <div class="modal-body" id="editFeedBody"></div>
        
        <div class="modal-footer">
        </div>
      </div>
      
    </div>
    <input type="hidden" id="editModalHelperId" name="editModalHelperId">
</div>

  <!-- reportpost Modal box -->
  <div class="modal fade edit-modal-box-container" id="reportFeedContainer" role="dialog">
		<div class="modal-dialog modal-lg">
			<!-- Modal content-->
			<div class="modal-content">
        <div class="modal-body login-pad">
          <div class="pop-title employe-title">
            <h3 style="font-size:21px !important;">REPORT TO FEED/COMMENTS</h3>
          </div>
          <button type="button" class="close modal-close" data-dismiss="modal">
            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
          </button>

          <div class="signup">
            <div id='systemMessage_report'></div><br><br>
             <div class="emplouyee-form">    
              <div class="write-review-form">
                <form  class="tabone-form" id="simpleTextFeedPost">
                  <div class="rvw-overall">                  
                    <textarea id="reportnotes_txt_box" name="reportnotes_txt_box" placeholder="Help us to identify what's wrong in this"></textarea>
                  </div>
                  <div class="by-sign">
                    <button type="button" class="btn btn-primary content-post-report-btn" style="padding: 6px 12px !important;">REPORT</button>
                    <p></p>
                  </div>
                </form>
             </div>
            </div>
          </div>

        </div>

				<!-- <div class="modal-header">
				 	<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div> -->

	      <!-- <div class="modal-footer"> -->
	      </div>
      </div>
    </div>
    <input type="hidden" id="reportModalHelperId" name="reportModalHelperId">
    <input type="hidden" id="reportModalCommentId" name="reportModalCommentId">

<div class="modal fade" id="report-feed-responsediv" role="dialog">
    <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body login-pad" style="margin-left: 25% !important;">
                <div id="report-feed-response-message"></div>
                <div class="signleft"></div>
            </div>
          </div>
    </div>
</div> 

 <!-- sharepost Modal box -->
  <div class="modal fade edit-modal-box-container" id="shareFeedContainer" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body login-pad">
          <div class="pop-title employe-title">
            <h3 style="font-size:21px !important;">SHARE FEED</h3>
          </div>
          <button type="button" class="close modal-close" data-dismiss="modal">
            <img src="<?php echo Config::get('constants.FRONT_IMAGE'); ?>close.jpg" height="70" width="34"/>
          </button>

          <div class="signup">
            <div id='systemMessage_share'></div><br><br>
             <div class="emplouyee-form">    
              <div class="write-review-form">
                <form  class="tabone-form" id="simpleTextFeedPost">
                  <div class="rvw-overall">
                    <textarea id="description_txt_box" name="description_txt_box" placeholder="Description"></textarea>
                  </div>
                  <div class="by-sign">
                    <button type="button" class="btn btn-primary content-post-share-btn" style="padding: 6px 12px !important;">SHARE</button>
                    <p></p>
                  </div>
                </form>
             </div>
            </div>
          </div>

        </div>

        <!-- <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div> -->

        <!-- <div class="modal-footer"> -->
        </div>
      </div>
    </div>
    <input type="hidden" id="shareModalHelperId" name="shareModalHelperId">
    

<script src="<?php echo Config::get('constants.FRONT_JS'); ?>sweet-alert/sweetalert.min.js"></script>
<input type="hidden" id="ajaxToken" name="_token" value="{{ csrf_token() }}">
<script src="<?php echo Config::get('constants.FRONT_JS'); ?>dropzone.js"></script>
<script type="text/javascript">

var moduleConfig = {
    feedLikeUrl:    		               "{!! route('timeline.feed-like') !!}",
    feedUnlikeUrl:  		               "{!! route('timeline.feed-unlike') !!}",
    addTimeLineFeedContent:            "{!! route('timeline.add-feed-content') !!}",
    shareTimeLineFeed: 		             "{!! route('timeline.share-time-line-feed') !!}",
    timeLineFeedComment: 	             "{!! route('timeline.post-comment') !!}",
    updateCommentText:  	             "{!! route('timeline.edit-post-comment') !!}",
    deleteCommentText:  	             "{!! route('timeline.delete-comment') !!}",
    showAllComments:   		             "{!! route('timeline.feed-comments') !!}",
    getSingleProfileFeedURL:           "{!! route('timeline.get-ajax-single-profile-feed')!!}",
    getFeedURL:                        "{!! route('timeline.get-ajax-feed') !!}",
    removeMediaImageFromGalleryURL:    "{!! route('timeline.ajax-remove-media-item-gallery') !!}",
    editUploadGalleryFeedURL:          "{!! route('timeline.edit-upload-gallery-feed') !!}",
    editUploadGalleryTitleURL:         "{!! route('timeline.edit-gallery-feed-title') !!}",
    editUploadVideoFileURL:            "{!! route('timeline.edit-feed-video-file') !!}",
    removeFeedPost:                    "{!! route('timeline.delete-feed-post') !!}",
    reportFeedURL:         "{!! route('timeline.report-feed') !!}",
    timeLineReplyComment:               "{!! route('timeline.post-reply-comment') !!}",
    updateReplyCommentText:                 "{!! route('timeline.edit-post-reply-comment') !!}",
    deleteReplyCommentText:                 "{!! route('timeline.delete-reply-comment') !!}",
    showAllReplies:                   "{!! route('timeline.feed-replies') !!}",
}

jQuery(document).ready(function()
{
  ProfileFeed.ProfileFeedList.init();

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
                      jQuery('#editFeedContainer').modal('hide');
                  }
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
<script>

    var popupSize = {
        width: 780,
        height: 550
    };

    $(document).on('click', '.social-buttons > a', function(e){

        var
            verticalPos = Math.floor(($(window).width() - popupSize.width) / 2),
            horisontalPos = Math.floor(($(window).height() - popupSize.height) / 2);

        var popup = window.open($(this).prop('href'), 'social',
            'width='+popupSize.width+',height='+popupSize.height+
            ',left='+verticalPos+',top='+horisontalPos+
            ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

        if (popup) {
            popup.focus();
            e.preventDefault();
        }

    });
</script>