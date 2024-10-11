@extends('layouts.profile')



@section('content')

<link href="<?php echo Config::get('constants.FRONT_CSS'); ?>dropzone.css" rel="stylesheet">

<link href="<?php echo Config::get('constants.FRONT_CSS'); ?>sweet-alert/sweetalert.css" rel="stylesheet">



<script src="<?php echo Config::get('constants.FRONT_JS'); ?>sweet-alert/sweetalert.min.js"></script>

<script src="<?php echo Config::get('constants.FRONT_JS'); ?>bootstrap-select.min.js"></script> 

<link rel="stylesheet" href="<?php echo Config::get('constants.FRONT_CSS'); ?>bootstrap-select.min.css">



<!-- <link href="<?php //echo Config::get('constants.FRONT_CSS'); ?>sweet-alert/sweetalert.css" rel="stylesheet"> -->

<!--<link href="<?php //echo Config::get('constants.FRONT_CSS'); ?>feedpost/jquery.lightbox-0.5.css" rel="stylesheet">

<link href="<?php //echo Config::get('constants.FRONT_CSS'); ?>lightbox2.min.css" rel="stylesheet">

<script src="<?php //echo Config::get('constants.FRONT_JS'); ?>lightbox-plus-jquery.min.js"></script>

<script src="<?php //echo Config::get('constants.FRONT_JS'); ?>lightbox.js"></script>-->





<div class="business-offer-main">

    <?php 

       $loggedinUser = Auth::user(); 

    ?>



    @include('includes.sidebar_profile_left')



  <div class="business-middle">

    

  @include('includes.profile_tab_menu')



    <div id="content-tab">

      <div class="busines-offer-list busines-off-profile-list">

        <div class="job_block">

          <div class="profile-tab busi-profile-tab">                  

            <ul class="nav nav-tabs">

              <li class="active">

                <a data-toggle="tab" href="#home"><i class="fa fa-commenting" aria-hidden="true"></i></a>

              </li>

              <li>

                <a data-toggle="tab" href="#menu1"><i class="fa fa-picture-o" aria-hidden="true"></i></a>

              </li>

              <li>

                <a data-toggle="tab" href="#menu2"><i class="fa fa-file-video-o" aria-hidden="true"></i></a>

              </li>

              <li>

                <a data-toggle="tab" href="#menu3"><i class="fa fa-map-marker" aria-hidden="true"></i></a>

              </li>

            </ul>

            <div class="tab-content">

            <div id="home" class="tab-pane fade in active">

                <div id="homesuccessdiv">&nbsp;</div>

                <form class="tabone-form">

                  <input type="text" id="contentPostTitle" name="content_post_title" placeholder="What's on your mind?"/>

                  <button type="button" class="content-post-btn"> POST</button>

                </form>

            </div>

            <div id="menu1" class="tab-pane fade">

                <div class="image_upload_div">

                  <div id="menu1msgdiv"></div>

                  <div id="menu1successdiv">&nbsp;</div>

                  <form action="upload.php" class="tabone-form dropzone" id="myImageUploadZone">

                      <input type="text" id="imagecontentPostTitle" placeholder="My Gallery Title" name="image_content_post_title" style="width: 70%"; />

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

                      <input type="text" id="videocontentPostTitle" placeholder="My Video Title" name="video_content_post_title" style="width: 70%"; />

                      <button type="button" class="video-post-btn"> POST</button>

                      <div class="clearfix"></div>

                  </form>

                </div> 

            </div>

            <div id="menu3" class="tab-pane fade">

              <form class="tabone-form">

                  <input type="text" placeholder="Enter Location" />

                  <button type="button"> POST</button>

                </form>

            </div>

            </div>  

          </div>

        

          <div id="myTabContent" class="tab-content">   

                <?php $feeds = $repository->getMyFeeds();  ?>

                @if(is_array($feeds))

                  <div class="job_listing timeline-scrollbar infinite-scroll" id="profileListMain" style="border: 1px solid #eee;">

                  @foreach($repository->getMyFeeds() as $feed)

                      {!! getUserFeedHtmlByType($feed) !!}

                  @endforeach

                  </div>

                @else

                  <div class="job_listing" style="border: 1px solid #eee;vertical-align:middle;padding:15px;">

                    Your Timline has no post. Start posting your thoughts now...

                  </div>

                @endif

          </div>

        </div>     

      </div>

    </div>



  </div>



  @include('includes.sidebar_profile_right')



</div>





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



<input type="hidden" id="ajaxToken" name="_token" value="{{ csrf_token() }}">

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



  var loader = 0;

      var offset = 10;

      var all_feeds_loaded = 0;



      $('.infinite-scroll').on('scroll', function() {

        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {

            

            if(loader == 0 && all_feeds_loaded == 0){



              loader = 1;



              $('.infinite-scroll').append('<center class="timeline_loader"><i class="fa fa-spinner fa-spin fa-3x fa-fw margin-bottom" aria-hidden="true"></i><br><br></center>');  

              

              var posturl = '/timeline-get-my-feed';



              $.ajax({

                url:posturl,

                type:'POST',

                dataType: 'json',

                data: { '_token': "{{ csrf_token() }}", 'offset':offset },

                complete: function (response) {

                  

                  loader = 0;

                  $( ".timeline_loader" ).remove();



                  if(response.responseText){

                  

                    $('.infinite-scroll').append(response.responseText);

                  

                  } else {



                      all_feeds_loaded = 1;

                      $('.infinite-scroll').append("<center class='bottom-msg'>You've reached the bottom of the page.</center>"); 

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



            if( typeof jQuery("#profileId-"+jsonResponse.feed_id) == "undefined" ||  jQuery("#profileId-"+jsonResponse.feed_id).length < 1 && jsonResponse.success == true)

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

            }else {

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

           // e.preventDefault();

        }



    });

</script>

@endsection