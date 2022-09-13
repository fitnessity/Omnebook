<?php

use Carbon\Carbon;
use App\Repositories\TimelineRepository;

/**
 * Get Logged User Object
 */
function getLoggedInUser() {
    return Auth::user();
}

/**
 * Get User Object by Id
 */
function getUserById($userId = null) {
    if ($userId) {
        return DB::table('users')->find($userId);
    }

    return false;
}

/**
 * Get User Profile Picture by User Id
 */
function getUserProfilePictureByUserId($userId = null, $title = 'Profile Picture', $params = array()) {
    if ($userId) {
        $user = getUserById($userId);
        if (isset($user->profile_pic) && file_exists(public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'profile_pic' . DIRECTORY_SEPARATOR . 'thumb150' . DIRECTORY_SEPARATOR . $user->profile_pic)) {
            return HTML::image(Config::get('constants.USER_IMAGE_THUMB150') . $user->profile_pic, $title, $params);
        }
    }

    return HTML::image('images/user.png', $title, $params);
}

/**
 * Get Logged User Id
 */
function getLoggedInUserId() {
    if (Auth::user()) {
        return Auth::user()->id;
    }
}

function getCommentsReply($comments, $reportedComment = array()) {
    $comment = array();
    $reply = array();
    $len = count($comments);
    if ($len > 0) {
        for ($i = 0; $i < $len; $i++) {
            if (inArray($comments[$i]->id, $reportedComment)) {
                continue;
            }
            if (isset($comments[$i]) && $comments[$i]->status == 1 && $comments[$i]->parent_id > 0 && isset($comment[$comments[$i]->parent_id])) {
                $obj = $comment[$comments[$i]->parent_id];
                $reply = $obj->sub;
                $reply[] = $comments[$i];
                $obj->sub = $reply;
                $comment[$comments[$i]->parent_id] = $obj;
            }
            if (isset($comments[$i]) && $comments[$i]->status == 1 && $comments[$i]->parent_id == 0) {
                $comments[$i]->sub = array();
                $comment[$comments[$i]->id] = $comments[$i];
            }
        }
    }

    $commentsObj = array();
    foreach ($comment as $obj) {
        array_push($commentsObj, $obj);
    }

    return $commentsObj;
}

/**
 * Get Feed by Feed Type
 */
function getFeedHtmlByType($feedObject, $all = false) {
    $repository = new TimelineRepository();
    $reportedComment = array();
    if ($feedObject->original_post_id) {
        if ($repository->isReportedFeed($feedObject->original_post_id)) {
            return '';
        }
        $sharedObject = $feedObject;
        $feedObject = $repository->getFeed($feedObject->original_post_id);

        if ($feedObject) {
            $feedObject->sharedObject = $sharedObject;
        } else {
            $feedObject = $sharedObject;
        }
    }

    if ($feedObject->sharedObject) {
        $timelineReportedFeed = $feedObject->sharedObject->timelineReportFeed;
        $timelineComments = $feedObject->sharedObject->timelineComments;
    } else {
        $timelineReportedFeed = $feedObject->timelineReportFeed;
        $timelineComments = $feedObject->timelineComments;
    }

    foreach ($timelineReportedFeed as $obj) {
        if ($obj->comment_id == null and $obj->feed_id == $feedObject->id) {
            return '';
        } else {
            array_push($reportedComment, $obj->comment_id);
        }
    }

    //create array of comment with it replies
    $commentWithReplyObject = getCommentsReply($timelineComments, $reportedComment);

    if ($feedObject->sharedObject) {
        $feedObject->sharedObject->timelineComments = $commentWithReplyObject;
        $feedObject->sharedObject->reportedComment = $reportedComment;
    } else {
        $feedObject->timelineComments = $commentWithReplyObject;
        $feedObject->reportedComment = $reportedComment;
    }


    switch ($feedObject->feed_type) {
        case 'content':
            return getContentFeedPost($feedObject, $all);
            break;

        case 'video':
            return getVideoFeedPost($feedObject, $all);
            break;

        case 'gallery':
            return getGalleryFeedPost($feedObject, $all);
            break;

        default:
            return '';
    }
}

/**
 * Video type Feed
 */
function getVideoFeedPost($feedObject, $all = false) {
    $shareDetails = '';
    $feedId = $feedObject->id;
    $userId = $feedObject->user_id;
    if ($feedObject->sharedObject) {
        $postOwner = getUserById($feedObject->user_id);
        $shareDetails = " shared " . $postOwner->firstname . "'s Post";
        $feedId = $feedObject->sharedObject->id;
        $userId = $feedObject->sharedObject->user_id;
    }

    /* if($feedObject->is_shared == 1 )
      {
      $postOwner 		= getUserById($feedObject->shareFeeds->feed_owner_id);
      $shareDetails 	= " shared ". $postOwner->firstname ."'s Post";
      $videoFileUrl 	= getVideoFileFullPath($feedObject, $feedObject->timelineMedia[0]->media_path);
      $videoEmbeed 	= getVideoPlay($videoFileUrl);
      }
      else
      {
      $videoFileUrl 	= getVideoFileFullPath($feedObject, $feedObject->timelineMedia[0]->media_path);
      $videoEmbeed 	= getVideoPlay($videoFileUrl);
      } */
    $videoFileUrl = false;
    if (isset($feedObject->timelineMedia[0])) {
        $videoFileUrl = getVideoFileFullPath($feedObject, $feedObject->timelineMedia[0]->media_path);
    }
    $videoEmbeed = getVideoPlay($videoFileUrl);
    $user = getUserById($userId);
    $html = '';
    $html .= '<div class="profile-list" id="profileId-' . $feedId . '">';
    $html .= getFeedHeader($feedObject);
    $sharedContent = '';
    if ($feedObject->sharedObject) {
        $sharedContent = ' <p>' . $feedObject->sharedObject->content . '</p>';
    }
    $html .= '<div class="profile-post-detail">'
            . ' <h4><strong>' . $user->firstname . '</strong>' . $user->lastname . '&nbsp;' . $shareDetails
            . ' <span class="floatright"> <i class="fa fa-clock-o" aria-hidden="true"></i>' . date('j<\s\up>S</\s\up> M Y', strtotime($feedObject->created_at)) . ' </span> '
            . '</h4>'
            . $sharedContent
            . ' <p>' . $feedObject->content . '</p>'
            . ' <p>' . $videoEmbeed . '</p>';
    // $html .= getFeedCommentSection($feedObject, $all);


    $html .= getFeedCommentSection($feedObject, $all);


    $html .= '</div></div>';

    return $html;
}

/**
 * get Video Full Path
 *
 * @param string $file
 */
function getVideoFileFullPath($feedObject, $file) {
    $path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'post-videos' . DIRECTORY_SEPARATOR . $feedObject->user_id . DIRECTORY_SEPARATOR . $file;

    if (file_exists($path)) {
        return asset('uploads/post-videos/' . $feedObject->user_id . DIRECTORY_SEPARATOR . $file);
    }

    return false;
}

/**
 * get Video Play
 *
 * @param string $videoFilePath
 */
function getVideoPlay($videoFilePath = null) {
    if ($videoFilePath) {
        return '<video src="' . $videoFilePath . '" type="video/avi" width="100%" controls></video>';
    }

    return 'Media File not Found';
}

/**
 * Get Content type Feed
 *
 * @param object $feedObject
 */
function getContentFeedPost($feedObject, $all = false) {
    $shareDetails = '';


    /* if($feedObject->is_shared == 1 )
      {
      $postOwner 		= getUserById($feedObject->shareFeeds->feed_owner_id);
      $shareDetails 	= " shared ". $postOwner->firstname ."'s Post";
      }
     */
    $feedId = $feedObject->id;
    $userId = $feedObject->user_id;
    if ($feedObject->sharedObject) {
        $postOwner = getUserById($feedObject->user_id);
        $shareDetails = " shared " . $postOwner->firstname . "'s Post";
        $feedId = $feedObject->sharedObject->id;
        $userId = $feedObject->sharedObject->user_id;
    }
    $user = getUserById($userId);
    $html = '';
    $html .= '<div class="profile-list" id="profileId-' . $feedId . '">';
    $html .= getFeedHeader($feedObject);
    $sharedContent = '';
    if ($feedObject->sharedObject) {
        $sharedContent = ' <p>' . $feedObject->sharedObject->content . '</p>';
    }
    $html .= '<div class="profile-post-detail">'
            . ' <h4><strong>' . $user->firstname . ' ' . $user->lastname . '</strong>' . '&nbsp;' . $shareDetails
            . ' <span class="floatright"> <i class="fa fa-clock-o" aria-hidden="true"></i>' . date('j<\s\up>S</\s\up> M Y', strtotime($feedObject->created_at)) . ' </span> '
            . ' </h4> '
            . $sharedContent
            . ' <p>' . $feedObject->content . '</p>';

    $html .= getFeedCommentSection($feedObject, $all);


    $html .= '</div></div>';

    return $html;
}

/**
 * Get Gallery Feed Post
 *
 * @param object $feedObject
 */
function getGalleryFeedPost($feedObject, $all = false) {
    $shareDetails = '';

    $feedId = $feedObject->id;
    $userId = $feedObject->user_id;
    if ($feedObject->sharedObject) {
        $postOwner = getUserById($feedObject->user_id);
        $shareDetails = " shared " . $postOwner->firstname . "'s Post";
        $feedId = $feedObject->sharedObject->id;
        $userId = $feedObject->sharedObject->user_id;
    }

    $galleryMedia = getGalleryMedia($feedObject);

    $user = getUserById($userId);
    $html = '';
    $html .= '<div class="profile-list" id="profileId-' . $feedId . '">';
    $html .= getFeedHeader($feedObject);
    $sharedContent = '';
    if ($feedObject->sharedObject) {
        $sharedContent = ' <p>' . $feedObject->sharedObject->content . '</p>';
    }
    $html .= '<div class="profile-post-detail"> '
            . ' <h4><strong>' . $user->firstname . '</strong>' . $user->lastname . '&nbsp;' . $shareDetails
            . ' <span class="floatright"> <i class="fa fa-clock-o" aria-hidden="true"></i>' . date('j<\s\up>S</\s\up> M Y', strtotime($feedObject->created_at)) . ' </span> '
            . '</h4>'
            . $sharedContent
            . ' <p>' . $feedObject->content . '</p>'
            . ' <p>' . $galleryMedia . '</p>';

    $html .= getFeedCommentSection($feedObject, $all);


    //$html .= getFeedCommentSection($feedObject, $all);
    $html .= '</div></div>';

    return $html;
}

/**
 * Get Gallery Media
 *
 * @param object $feedObject
 */
function getGalleryMedia($feedObject) {
    $html = '<div class="thumb-light">';
    foreach ($feedObject->timelineMedia as $media) {
        $html .= '<a data-lightbox="example-set" data-title="" class="example-image-link" href="' . url('uploads/post-gallery/' . $media->user_id . '/thumb/' . $media->media_path) . '">'
                . HTML::image('uploads/post-gallery/' . $media->user_id . '/thumb/' . $media->media_path, 'Gallery Feed Post', ['height' => 300, 'width' => 300]) .
                '</a>';
    }
    $html .= "</div>";

    return $html;
}

/**
 * General Feed Header
 *
 */
function getFeedHeader($feedObject) {
    $carbon = new Carbon;

    $userId = $feedObject->user_id;
    if ($feedObject->sharedObject) {
        $userId = $feedObject->sharedObject->user_id;
    }

    return '<span><i class="fa fa-star" aria-hidden="true"></i></span>
  			<div class="profile-left-avtar">
    		' . getUserProfilePictureByUserId($userId, $feedObject->title, ['height' => 70, 'width' => 70]) . '
  			</div>';
    // return '<span> '.date('jS M Y', strtotime($feedObject->created_at)).' <i class="fa fa-circle" aria-hidden="true"></i></span>
    //  			<div class="profile-left-avtar">
    //    		'.getUserProfilePictureByUserId($feedObject->user_id, $feedObject->title, ['height' => 70, 'width' => 70]).'
    //  			</div>';
}

/**
 * Get Feed Comments & Like Section
 * 
 * @param object $feedObject
 * @return string
 */
function getFeedCommentSection($feedObjectO, $all = false) {
    //for shared post logic
    if ($feedObjectO->sharedObject) {
        $originalContent = $feedObjectO->content;
        $feedObject = $feedObjectO->sharedObject;
        $feedId = $feedObject->original_post_id;
    } else {
        $feedObject = $feedObjectO;
        $originalContent = $feedObject->content;
        $feedId = $feedObject->id;
    }

    $feedLikeStatus = getUserLikeFlag($feedObject);
    $feedLikeCount = getFeedLikeCount($feedObject);
    $feedLike = 'Like';
    $feedLikeValue = 1;
    $feedShareCount = getFeedShareCount($feedObject->id);
    $commentsCount = getFeedCommentsCount($feedObject->id);
    $allHtml = '';
    $addCommentHtml = '';
    $reportFeedStatus = getUserReportFlag($feedObject, null);

    if ($feedLikeStatus) {
        $feedLike = 'Unlike';
        $feedLikeValue = 0;
    }

    if (!$all) {
        $addCommentHtml = '<div class="comment-box last-box">
				<div class="cooment-avatar">
					' . getUserProfilePictureByUserId(getLoggedInUserId(), $feedObject->title, ['height' => 70, 'width' => 70]) . '
				</div>
				<div class="comment-con">
					<input type="text" id="commentText-' . $feedObject->id . '" placeholder="Write a comment..." />
					<button class="postComment" data-feed-id="' . $feedObject->id . '"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
				</div>
			</div>';
        if ($commentsCount > 2) {
            $allHtml = '<div class="text-right">
				<a href="javascript:void(0);" class="view-more-comments" data-feed-id="' . $feedObject->id . '">
					View All Comments
				</a>
			</div>';
        }
    }

    $editFeedHTML = '';
    $reportFeedButton = '';

    if ($feedObject->user_id == getLoggedInUserId()) {
        $editFeedHTML = '<li><i class="fa fa-circle" aria-hidden="true"></i></li>
		    			 <li><a class="edit-feed"  data-feed-type="' . $feedObject->feed_type . '"  data-feed-id="' . $feedObject->id . '"  data-user-id="' . getLoggedInUserId() . '" href="javascript:void(0);">Edit</a></li>		    			 
		    			 <li><i class="fa fa-circle" aria-hidden="true"></i></li>
		    			 <li><a class="delete-feed"  data-feed-type="' . $feedObject->feed_type . '"  data-feed-id="' . $feedObject->id . '"  data-user-id="' . getLoggedInUserId() . '" href="javascript:void(0);">Delete</a></li>';
    }

    $url = urldecode("http://" . $_SERVER['HTTP_HOST'] . "/timeline/feed/" . $feedId . "&title=" . $originalContent);
    $likeLink = '';
    $statistics = '';
    $shareLink = '';
    $commentDiv = '';
    if (getLoggedInUserId()) {
        if ($feedObject->user_id != getLoggedInUserId()) {
            // $reportFeedButton = '<li><i class="fa fa-circle" aria-hidden="true"></i></li>
            // 				<li><a >Already reported</a></li>';
            $reportFeedButton = '<li><a >Already reported</a></li>';
            if ($reportFeedStatus == 0) {
                // $reportFeedButton  = ' <li><i class="fa fa-circle" aria-hidden="true"></i></li>
                // 		<li><a class="report-feed"  data-feed-type="'. $feedObject->feed_type .'"  data-feed-id="'. $feedObject->id .'"  data-user-id="' .getLoggedInUserId(). '" href="javascript:void(0);">Report</a></li>';
                $reportFeedButton = ' <li class="report-post"><a class="report-feed"  data-feed-type="' . $feedObject->feed_type . '"  data-feed-id="' . $feedId . '"  data-user-id="' . getLoggedInUserId() . '" href="javascript:void(0);">
					<i class="fa fa-flag" aria-hidden="true"></i>
					</a></li>';
            }
        }
        $likeLink = '<li><a class="profile-feed-like" href="javascript:void(0);" data-feed-id="' . $feedObject->id . '" data-like-status="' . $feedLikeValue . '" data-user-id="' . getLoggedInUserId() . '">' . $feedLike . '</a></li>';

        $shareLink = '<li><i class="fa fa-circle" aria-hidden="true"></i></li>
				<li> <a class="profile-feed-like share-with-text" href="javascript:void(0);">Share With</a></li>
          		<li>
          			<a class="share-feed fit-share" data-feed-id="' . $feedId . '"  data-user-id="' . getLoggedInUserId() . '" href="javascript:void(0);" title="Share to Fitnessity Tiemline"><i class="fa">Fit</i>
	          		</a>

          			<div class="social-buttons">

	          			<a class="share-feed-social fb-share" data-feed-id="' . $feedId . '"  data-user-id="' . getLoggedInUserId() . '"  href="https://www.facebook.com/sharer/sharer.php?u=' . $url . '" target="_blank" title="Share on Facebook">
					       <i class="fa fa-facebook"></i>
					    </a>
					    <a class="share-feed-social tw-share" data-feed-id="' . $feedId . '"  data-user-id="' . getLoggedInUserId() . '"  href="https://twitter.com/intent/tweet?url=' . $url . '" target="_blank" title="Share on Twitter">
					       <i class="fa fa-twitter"></i>
					    </a>
					    <a class="share-feed-social ln-share" data-feed-id="' . $feedId . '"  data-user-id="' . getLoggedInUserId() . '"  href="https://www.linkedin.com/cws/share?url=' . $url . '" target="_blank" title="Share on Linkedin">
					       <i class="fa fa-linkedin"></i>
					    </a>
					</div>
				</li>';
        $statistics = '
			<div class="like-comm">
		      <a id="likeCount-' . $feedObject->id . '" href="javascript:void(0);"><i class="fa fa-thumbs-up" aria-hidden="true"></i> ' . $feedLikeCount . '</a>
		      <a href="javascript:void(0);" id="commentsCount-' . $feedObject->id . '"><i class="fa fa-commenting" aria-hidden="true"></i> 
		        ' . $commentsCount . '
		      </a>
		      <a id="shareCount-' . $feedObject->id . '" href="javascript:void(0);"><i class="fa fa-share-alt" aria-hidden="true"></i> ' . $feedShareCount . '
		      </a>
		  </div>';

        $commentDiv = '<div class="div-commentmain" id="commentsContainer-' . $feedObject->id . '">   
					' . getAllCommentsHTML($feedObject, $all) . '
					' . $addCommentHtml . '
					' . $allHtml . '
				</div>';
    }
    return '<div class="like-div">'
            . $statistics
            . ' <ul> '
            . $likeLink
            . $editFeedHTML
            . $shareLink
            . $reportFeedButton
            . ' </ul> '
            . ' </div>'
            . $commentDiv;
}

function getCloserComments($feedObject) {
    $repository = new TimelineRepository();
    $reportedComment = array();

    if ($feedObject->original_post_id) {
        if ($repository->isReportedFeed($feedObject->original_post_id)) {
            return '';
        }
        $sharedObject = $feedObject;
        $feedObject = $repository->getFeed($feedObject->original_post_id);

        if ($feedObject) {
            $feedObject->sharedObject = $sharedObject;
        } else {
            $feedObject = $sharedObject;
        }
    }

    if ($feedObject->sharedObject) {
        $timelineReportedFeed = $feedObject->sharedObject->timelineReportFeed;
        $timelineComments = $feedObject->sharedObject->timelineComments;
    } else {
        $timelineReportedFeed = $feedObject->timelineReportFeed;
        $timelineComments = $feedObject->timelineComments;
    }

    foreach ($timelineReportedFeed as $obj) {
        if ($obj->comment_id == null and $obj->feed_id == $feedObject->id) {
            return '';
        } else {
            array_push($reportedComment, $obj->comment_id);
        }
    }

    //create array of comment with it replies
    $commentWithReplyObject = getCommentsReply($timelineComments, $reportedComment);

    if ($feedObject->sharedObject) {
        $feedObject->sharedObject->timelineComments = $commentWithReplyObject;
        $feedObject->sharedObject->reportedComment = $reportedComment;
        $feedId = $feedObject->sharedObject->id;
    } else {
        $feedObject->timelineComments = $commentWithReplyObject;
        $feedObject->reportedComment = $reportedComment;
        $feedId = $feedObject->id;
    }

    //for shared post logic
    if ($feedObject->sharedObject) {
        $feedObject = $feedObject->sharedObject;
    }
    $commentsCount = getFeedCommentsCount($feedId);

    $allHtml = '';
    $addCommentHtml = '<div class="comment-box last-box">
			<div class="cooment-avatar">
				' . getUserProfilePictureByUserId($feedObject->user_id, $feedObject->title, ['height' => 70, 'width' => 70]) . '
			</div>
			<div class="comment-con">
				<input type="text" id="commentText-' . $feedObject->id . '" placeholder="Write a comment..." />
				<button class="postComment" data-feed-id="' . $feedObject->id . '"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
			</div>
		</div>';
    if ($commentsCount > 2) {
        $allHtml = '<div class="text-right">
			<a href="javascript:void(0);" class="view-more-comments" data-feed-id="' . $feedObject->id . '">
				View All Comments
			</a>
		</div>';
    }

    return getAllCommentsHTML($feedObject) . $addCommentHtml . $allHtml;
}

/**
 * Get Feed Comments Count
 *
 * @var int $feedId
 */
function getFeedCommentsCount($feedId) {

    if ($feedId) {
        $feedComentsCount = DB::table('timeline_feeds_comments')->where(['feed_id' => $feedId, 'parent_id' => 0])->whereNotIn('id', DB::table('timeline_feeds_report')->select('timeline_feeds_report.comment_id')->where(['timeline_feeds_report.feed_id' => $feedId]))->count();

        if ($feedComentsCount) {
            return $feedComentsCount;
        }
    }

    return 0;
}

function getAllCommentsHTML($feedObject, $all = false) {
    $html = '';
    //$user 		= $feedObject->user()->first();
    $comments = ($feedObject->timelineComments);

    if (!$all) {
        $j = 0;
        for ($i = (count($comments) - 1); $i >= 0; $i--) {
            if ($j > 1) {
                break;
            }

            //if(isset($comments[$i]) && $comments[$i]->status == 1)
            if (isset($comments[$i]) && $comments[$i]->status == 1 && !in_array($comments[$i]->id, $feedObject->reportedComment) && $comments[$i]->parent_id == 0) {
                $comments[$i]->reportedComment = $feedObject->reportedComment;
                $html = getSingleCommentHTML($comments[$i]) . $html;
                $j++;
            }
        }

        return $html;
    }

    if (count($comments)) {
        foreach ($comments as $comment) {
            if (isset($comment) && $comment->status == 1 && !in_array($comment->id, $feedObject->reportedComment) && $comment->parent_id == 0) {
                $comment->reportedComment = $feedObject->reportedComment;
                $html = getSingleCommentHTML($comment) . $html;
            }
        }
    }

    return $html;
}

/**
 * Get Single Comment HTML
 *
 * @param object $user
 * @param object $feedObject
 * @param object $comment
 */
function getSingleCommentHTML($comment) {
    $html = '<div class="comment-box" id="commentContainer-' . $comment->id . '">
				' . getSingleCommentInnerHTML($comment) . '
			</div>';

    return $html;
}

/**
 * Get Single Comment Inner HTML
 *
 * @param object $user
 * @param object $feedObject
 * @param object $comment
 */
function getSingleCommentInnerHTML($comment, $all = false) {
    $user = $comment->user()->first();
    $html = '';
    if (count($user) > 0) {
        $html = '<div class="cooment-avatar">
				' . getUserProfilePictureByUserId($comment->user_id, $comment->content, ['height' => 70, 'width' => 70]) . '
				</div>
				<div class="comment-con comment-con-parent">
					<a href="javascript:void(0);" class="comment-con-parent-a"> ' . $user->firstname . " " . $user->lastname . '  </a>
					<p class="comment-con-parent-p">' . $comment->content . '</p>
					' . getCommentAdditionalDetails($user, $comment, $all) . '

				</div>';
    }


    return $html;
}

function getCommentAdditionalDetails($user, $comment, $all = false) {
    $html = '';
    $loginUserId = getLoggedInUserId();
    $carbon = new Carbon;

    // logic to allow post owner to edit/delete post's comment
    /* if($loginUserId  == $comment->user_id || $loginUserId  == $feedObject->user_id)
      {
      $reporthtml = '';
      if ($loginUserId  != $comment->user_id ){
      $reportFeedStatus = getUserReportFlag($feedObject, $comment->id);

      $reporthtml = '
      <li><i class="fa fa-circle" aria-hidden="true"></i></li>
      <li>
      <a >Already reported</a>
      </li>';
      if($reportFeedStatus == 0){
      $reporthtml = '<li><i class="fa fa-circle" aria-hidden="true"></i></li>
      <li><a class="report-feed"  data-feed-type="'. $feedObject->feed_type .'"  data-feed-id="'. $feedObject->id .'"
      data-comment-id="'.$comment->id.'"  data-user-id="' .getLoggedInUserId(). '" href="javascript:void(0);">Report
      </a>
      </li>';
      }

      }
      $html = '<div class="like-div" id="userCommentManage-'. $comment->id .'">
      <ul>
      <li><a class="profile-feed-edit-comment" href="javascript:void(0);" data-comment-text="'.$comment->content.'" data-comment-id="'.$comment->id.'" data-feed-id="'.$feedObject->id.'" data-user-id="'.$user->id.'">Edit</a></li>
      '.$reporthtml.'
      <li><i class="fa fa-circle" aria-hidden="true"></i></li>
      <li>
      <a class="profile-feed-delete-comment" href="javascript:void(0);" data-feed-id="'.$feedObject->id.'" data-comment-id="'.$comment->id.'" data-user-id="'.$user->id.'">Delete</a>
      </li>
      </ul>
      </div>';
      } else {
      $reportFeedStatus = getUserReportFlag($feedObject, $comment->id);

      $html = '<div class="like-div" id="userCommentManage-'. $comment->id .'">
      <ul>
      <li>
      <a >Already reported</a>
      </li>
      </ul>
      </div>';
      if($reportFeedStatus == 0){
      $html = '<div class="like-div" id="userCommentManage-'. $comment->id .'">
      <ul>
      <li><a class="report-feed"  data-feed-type="'. $feedObject->feed_type .'"  data-feed-id="'. $feedObject->id .'"
      data-comment-id="'.$comment->id.'"  data-user-id="' .getLoggedInUserId(). '" href="javascript:void(0);">Report
      </a>
      </li>
      </ul>
      </div>';
      }
      } */

    $replyCommentsCount = count($comment->sub);
    if ($loginUserId == $comment->user_id) {
        $html = '<div class="like-div" id="userCommentManage-' . $comment->id . '">
				<div class="like-comm">
				    <a href="javascript:void(0);" id="replyCommentsCount-' . $comment->id . '"><i class="fa fa-commenting" aria-hidden="true"></i> 
						        ' . $replyCommentsCount . '
					</a>
				</div>
				<ul>
				    <li><a class="profile-feed-edit-comment" href="javascript:void(0);" data-comment-text="' . $comment->content . '" data-comment-id="' . $comment->id . '" data-feed-id="' . $comment->feed_id . '" data-user-id="' . $user->id . '">Edit</a></li>
				    <li><i class="fa fa-circle" aria-hidden="true"></i></li>
				    <li>
				    	<a class="profile-feed-delete-comment" href="javascript:void(0);" data-feed-id="' . $comment->feed_id . '" data-comment-id="' . $comment->id . '" data-user-id="' . $user->id . '">Delete</a>
				    </li>
					<li class="commenttime">' . $carbon->diffForHumans($comment->created_at, true) . ' ago</li>
				</ul>
			</div>';
    } else if ($loginUserId && $loginUserId != $comment->user_id) {
        // $reportFeedStatus = getUserReportFlag($feedObject, $comment->id);
        // $html = '<div class="like-div" id="userCommentManage-'. $comment->id .'">
        // 		<ul>
        // 		    <li>
        // 		    	<a >Already reported</a>
        // 		    </li>
        // 		</ul>
        // 	</div>';
        //if($reportFeedStatus == 0){
        //data-feed-type="'. $feedObject->feed_type .'"
        $html = '<div class="like-div" id="userCommentManage-' . $comment->id . '">
				<div class="like-comm">
				    <a href="javascript:void(0);" id="replyCommentsCount-' . $comment->id . '"><i class="fa fa-commenting" aria-hidden="true"></i> 
						        ' . $replyCommentsCount . '
					</a>
				</div>
				<ul>
				    <li class="report-post"><a class="report-feed"   data-feed-id="' . $comment->feed_id . '"
					   data-comment-id="' . $comment->id . '"  data-user-id="' . getLoggedInUserId() . '" href="javascript:void(0);"><i aria-hidden="true" class="fa fa-flag"></i>
					   </a>
				    </li>
				    <li class="commenttime">' . $carbon->diffForHumans($comment->created_at, true) . ' ago</li>
				</ul>
			</div>';
        //}
    }

    return $html . getReplyCommentSection($comment, $all);
}

/**
 * Ger Feed Share Count
 *
 * @param int $feedId
 * @return int
 */
function getFeedShareCount($feedId = null) {
    if ($feedId) {
        $feedCount = DB::table('timeline_feeds')->where(['original_post_id' => $feedId])->count();

        if ($feedCount) {
            return $feedCount;
        }
    }

    return 0;
}

/*
  function getFeedShareCount($feedId = null)
  {
  if($feedId)
  {
  $feedCount = DB::table('timeline_feeds_share')->where(['original_feed_id' => $feedId])->count();

  if($feedCount)
  {
  return $feedCount;
  }
  }

  return 0;
  }
 */

/**
 * Ger User Like Flag by FeedObject
 *
 * @param object $feedObject
 * @return bool 
 */
function getUserLikeFlag($feedObject) {
    $feedList = $feedObject->TimelineLike->toArray();

    foreach ($feedList as $feed) {
        if (getLoggedInUserId() == $feed['user_id']) {
            return true;
            break;
        }
    }
    return false;
}

function getFeedLikeCount($feedObject) {
    return count($feedObject->TimelineLike->toArray());
}

function getGalleryEditableHtml($feedObject) {
    $html = '<div class="editpostdiv">';

    foreach ($feedObject->timelineMedia as $media) {
        $html .= '<span id="mediaId-' . $media->id . '">'
                . '<a href="javascript:void(0);" data-id="' . $media->id . '" class="delete-gallery-file delete-icon">X</a>'
                . HTML::image('uploads/post-gallery/' . $media->user_id . '/' . $media->media_path, 'Gallery Feed Post', ['height' => 300, 'width' => 300])
                . '</span>';
    }
    $html .= "</div>";

    return $html;
}

function getVideoEditableHtml($feedObject) {
    $videoFileUrl = getVideoFileFullPath($feedObject, $feedObject->timelineMedia[0]->media_path);

    return getVideoPlay($videoFileUrl);
}

function getUserReportFlag($feedObject, $commentId = null) {
    $feedList = $feedObject->TimelineReportFeed->toArray();

    foreach ($feedList as $feed) {
        if ($feed['comment_id'] == $commentId && getLoggedInUserId() == $feed['user_id']) {
            return true;
            break;
        }
    }
    return false;
}

function getReportFeedCount($feedObject) {
    return count($feedObject->TimelineReportFeed->toArray());
}

/* Reported post view Start */

/**
 * Get Reported Feed by Feed Type
 */
function getReportedFeedHtmlByType($feedObject, $reportedComment = null, $commentedBy = null) {

    switch ($feedObject->feed_type) {
        case 'content':
            return getContentReportedFeedPost($feedObject, $reportedComment, $commentedBy);
            break;

        case 'video':
            return getVideoReportedFeedPost($feedObject, $reportedComment, $commentedBy);
            break;

        case 'gallery':
            return getGalleryReportedFeedPost($feedObject, $reportedComment, $commentedBy);
            break;

        default:
            return '';
    }
}

/**
 * Video type Reported Feed
 */
function getVideoReportedFeedPost($feedObject, $reportedComment, $commentedBy) {
    $shareDetails = '';

    if ($feedObject->is_shared == 1) {
        $postOwner = getUserById($feedObject->shareFeeds->feed_owner_id);
        $shareDetails = " shared " . $postOwner->firstname . "'s Post";
        $videoFileUrl = getVideoFileFullPath($feedObject, $feedObject->timelineMedia[0]->media_path);
        $videoEmbeed = getVideoPlay($videoFileUrl);
    } else {
        $videoFileUrl = getVideoFileFullPath($feedObject, $feedObject->timelineMedia[0]->media_path);
        $videoEmbeed = getVideoPlay($videoFileUrl);
    }
    $user = getUserById($feedObject->user_id);
    $html = '<br>';
    $html .= '<div class="profile-list" id="profileId-' . $feedObject->id . '">';
    // $html .= getFeedHeader($feedObject);
    $html .= '<div class="profile-post-detail">';
    if ($reportedComment)
        $html .='<h3>Original Post Detail</h3>';

    $html .= ' <p>' . $feedObject->content . '</p>'
            . ' <p>' . $videoEmbeed . '</p>'
            . '<p><h5><i>On ' . date('j<\s\up>S</\s\up> M Y', strtotime($feedObject->created_at)) . ' by ' . $user->firstname . ' ' . $user->lastname . '</i></h5></p>';
    $html .= '</div></div>';
    $reporthtml = '';
    if ($reportedComment) {
        $reporthtml = '<br>' . getFeedReportedCommentSection($reportedComment, $commentedBy);
    }

    $finalhtml = $reporthtml . $html;
    return $finalhtml;
}

/**
 * Get Content type Reported Feed
 *
 * @param object $feedObject
 */
function getContentReportedFeedPost($feedObject, $reportedComment, $commentedBy) {
    $shareDetails = '';

    if ($feedObject->is_shared == 1) {
        $postOwner = getUserById($feedObject->shareFeeds->feed_owner_id);
        $shareDetails = " shared " . $postOwner->firstname . "'s Post";
    }
    $user = getUserById($feedObject->user_id);
    $html = '<br>';
    $html .= '<div class="profile-post-detail">';
    if ($reportedComment)
        $html .='<h3>Original Post Detail</h3>';

    $html .= ' <p>' . $feedObject->content . '</p>'
            . '<p><h5><i>on ' . date('j<\s\up>S</\s\up> M Y', strtotime($feedObject->created_at)) . ' by ' . $user->firstname . ' ' . $user->lastname . '</i></h5></p>'
            . '</div>';

    // $html .= 		' <p>' .$feedObject->content. '</p>';
    // $html .= '<div class="profile-list" id="profileId-'. $feedObject->id .'">';
    // $html .= getFeedHeader($feedObject);
    //    $html .= '<div class="profile-post-detail">'
    // 		.' <h4><strong>' .$user->firstname. ' '.$user->lastname. '</strong>'. '&nbsp;' .$shareDetails
    // 		.' <span class="floatright"> <i class="fa fa-clock-o" aria-hidden="true"></i>'. date('j<\s\up>S</\s\up> M Y', strtotime($feedObject->created_at)) .' </span> '
    // 		.' </h4> '
    // 		.' <p>' .$feedObject->content. '</p>';
    $reporthtml = '';
    if ($reportedComment) {
        $reporthtml = '<br>' . getFeedReportedCommentSection($reportedComment, $commentedBy);
    }
    //$html .= '</div></div>';

    $finalhtml = $reporthtml . $html;
    return $finalhtml;
}

/**
 * Get Gallery Reported Feed Post
 *
 * @param object $feedObject
 */
function getGalleryReportedFeedPost($feedObject, $reportedComment, $commentedBy) {
    $shareDetails = '';
    if ($feedObject->is_shared == 1) {
        $postOwner = getUserById($feedObject->shareFeeds->feed_owner_id);
        $shareDetails = " shared " . $postOwner->firstname . "'s Post";
    }
    $galleryMedia = getGalleryMedia($feedObject);
    $user = getUserById($feedObject->user_id);
    $html = '<br>';
    $html .= '<div class="profile-list" id="profileId-' . $feedObject->id . '">';
    if ($reportedComment)
        $html .='<h3>Original Post Detail</h3>';

    $html .= ' <p>' . $feedObject->content . '</p>'
            . ' <p>' . $galleryMedia . '</p>'
            . '<p><h5><i>on ' . date('j<\s\up>S</\s\up> M Y', strtotime($feedObject->created_at)) . ' by ' . $user->firstname . ' ' . $user->lastname . '</i></h5></p>'
            . '</div>';
    //$html .= getFeedHeader($feedObject);
    //  $html .= '<div class="profile-post-detail"> '
    // .' <h4><strong>' .$user->firstname. '</strong>' .$user->lastname. '&nbsp;' .$shareDetails
    // .' <span class="floatright"> <i class="fa fa-clock-o" aria-hidden="true"></i>'. date('j<\s\up>S</\s\up> M Y', strtotime($feedObject->created_at)) .' </span> '
    // . '</h4>'
    // $html = ' <p>' .$feedObject->content. '</p>'
    // .' <p>' .$galleryMedia. '</p>';
    $reporthtml = '';
    if ($reportedComment) {
        $reporthtml = '<br>' . getFeedReportedCommentSection($reportedComment, $commentedBy);
    }
    //$html .= '</div></div>';

    $finalhtml = $reporthtml . $html;
    return $finalhtml;
}

/**
 * Get Feed Reported Comments
 * 
 * @param object $feedObject
 * @return string
 */
function getFeedReportedCommentSection($comment, $commentedBy) {
    $user = getLoggedInUserId();
    $html = '';
    if (getLoggedInUserId()) {
        $commentDiv = '<div class="div-commentmain" >
			' . getSingleReportedCommentHTML($comment, $commentedBy) . '
		</div>';
    }
    return $commentDiv;
}

/**
 * Get Single Reported Comment HTML
 *
 * @param object $user
 * @param object $feedObject
 * @param object $comment
 */
function getSingleReportedCommentHTML($comment, $commentedBy) {
    $html = '<div class="comment-box" id="commentContainer-' . $comment->id . '">
			' . getSingleReportedCommentInnerHTML($comment, $commentedBy) . '
		</div>';

    return $html;
}

/**
 * Get Single Reported Comment Inner HTML
 *
 * @param object $user
 * @param object $feedObject
 * @param object $comment
 */
function getSingleReportedCommentInnerHTML($comment, $commentedBy) {
    $carbon = new Carbon;
    $html = '<div class="cooment-avatar"></div>
			<div class="comment-con comment-con-parent">
			<p class="comment-con-parent-p">' . $comment->content . '</p>
			<div class="like-coome">
				<p><h5><i>' . $carbon->diffForHumans($comment->created_at, true) . ' ago by ' . $commentedBy . ' </i></h5></p>
			</div>
		</div>';
    /* $html = '<div class="cooment-avatar">
      ' .getUserProfilePictureByUserId($comment->user_id, $comment->content, ['height' => 70, 'width' => 70]). '
      </div>
      <div class="comment-con">
      <a href="javascript:void(0);"> '. $commentedBy .'  </a>
      <p>' .$comment->content. '</p>
      <div class="like-coome">
      <p>'.$carbon->diffForHumans($comment->created_at, true).' ago</p>
      </div>
      </div>'; */

    return $html;
}

/* Reported post view end */

/**
 * Get Relpy Comments & Like Section
 * 
 * @param object $feedObject
 * @return string
 */
function getReplyCommentSection($commentObject, $all = false) {
    $commentId = $commentObject->id;

    $replyCommentObject = $commentObject->sub;
    $replyCommentsCount = count($commentObject->sub);
    $allHtml = '';
    $addReplyCommentHtml = '';
    $initilaDisplayCount = 2;

    $addReplyCommentHtml = '<div class="reply-comment-box last-box">
		    <div class="cooment-avatar">
		        ' . getUserProfilePictureByUserId(getLoggedInUserId(), $commentObject->title, ['height' => 70, 'width' => 70]) . '
		    </div>
		    <div class="comment-con">
		        <input type="text" id="replyCommentText-' . $commentObject->id . '" placeholder="Write a reply..." />
		        <button class="replyComment" data-feed-id="' . $commentObject->feed_id . '" data-comment-id="' . $commentObject->id . '"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
		    </div>
		</div>';

    if (!$all) {

        if ($replyCommentsCount > $initilaDisplayCount) {
            $allHtml = '<div class="text-right">
			    <a href="javascript:void(0);" class="view-more-reply-comments" data-feed-id="' . $commentObject->feed_id . '" data-comment-id="' . $commentObject->id . '" id="view-more-reply-comments-' . $commentObject->id . '">
					Load Previous Replies
				</a>
			</div>';
        }
    }

    $editHTML = '';

    if ($commentObject->user_id == getLoggedInUserId()) {

        // $editHTML =  '<li><i class="fa fa-circle" aria-hidden="true"></i></li>
        //     			 <li><a class="edit-comment"   data-comment-id="'. $($commentObject->id .'"  data-user-id="' .getLoggedInUserId(). '" href="javascript:void(0);">Edit</a></li>		    			 
        //     			 <li><i class="fa fa-circle" aria-hidden="true"></i></li>
        //     			 <li><a class="delete-comment"   data-comment-id="'. $$commentObject->id .'"  data-user-id="' .getLoggedInUserId(). '" href="javascript:void(0);">Delete</a></li>';
    }

    $replyCommentLink = '';
    if (getLoggedInUserId()) {
        $replyCommentLink = $allHtml . '
			<div class="div-replycommentmain" id="replyCommentsContainer-' . $commentObject->id . '">'
                . getAllReplyCommentsHTML($replyCommentObject, $all, $commentObject->reportedComment) . ' ' . $addReplyCommentHtml . '
			    <input type="hidden" id="input-replycomment-offset-' . $commentObject->id . '" name="input-replycomment-offset-' . $commentObject->id . '" value="' . $initilaDisplayCount . '" />
			</div>';
    }
    return $replyCommentLink;
}

/**
 * Get Reply Comments Count
 *
 * @var int $commentId
 */
function getReplyCommentsCount($commentId) {

    if ($commentId) {
        $replyComentsCount = DB::table('timeline_reply_comments')->where(['comment_id' => $commentId])->count();

        if ($replyComentsCount) {
            return $replyComentsCount;
        }
    }

    return 0;
}

function getAllReplyCommentsHTML($replyComments, $all = false, $reportedComments = array()) {
    $html = '';

    if (!$all) {
        $j = 0;
        for ($i = (count($replyComments) - 1); $i >= 0; $i--) {
            if ($j > 1) {
                break;
            }
            if (isset($replyComments[$i]) && $replyComments[$i]->status == 1 && !inArray($replyComments[$i]->id, $reportedComments) && $replyComments[$i]->parent_id > 0) {
                $html = getSingleReplyCommentHTML($replyComments[$i]) . $html;
                $j++;
            }
        }

        return $html;
    }

    if (count($replyComments)) {
        foreach ($replyComments as $replyComment) {
            if (isset($replyComment) && $replyComment->status == 1 && !inArray($replyComment->id, $reportedComments) && $replyComment->parent_id > 0) {
                $html = getSingleReplyCommentHTML($replyComment) . $html;
            }
        }
    }
    return $html;
}

/**
 * Get Single Reply Comment HTML
 *
 * @param object $user 
 * @param object $replyComment
 */
function getSingleReplyCommentHTML($replyComment) {
    $html = '<div class="reply-comment-box" id="replyCommentContainer-' . $replyComment->id . '">
				' . getSingleReplyCommentInnerHTML($replyComment) . '
			</div>';

    return $html;
}

/**
 * Get Single Reply Comment Inner HTML
 *
 * @param object $user
 * @param object $commentObject
 * @param object $replyComment
 */
function getSingleReplyCommentInnerHTML($replyComment) {
    $user = $replyComment->user()->first();
    $html = '<div class="cooment-avatar">
			    ' . getUserProfilePictureByUserId($replyComment->user_id, $replyComment->content, ['height' => 70, 'width' => 70]) . '
			</div>
			<div class="comment-con">
			    <a href="javascript:void(0);"> ' . $user->firstname . " " . $user->lastname . '  </a>
			    <p>' . $replyComment->content . '</p>
			    ' . getReplyCommentAdditionalDetails($user, $replyComment) . '
			</div>';

    return $html;
}

function getReplyCommentAdditionalDetails($user, $replyComment) {
    $carbon = new Carbon;
    $html = '';
    $loginUserId = getLoggedInUserId();

    if ($loginUserId && $loginUserId == $replyComment->user_id) {
        $html = '<div class="like-div" id="userReplyCommentManage-' . $replyComment->id . '">
			    <ul>
			        <li><a class="profile-feed-edit-reply" href="javascript:void(0);" data-reply-comment-text="' . $replyComment->content . '" data-reply-comment-id="' . $replyComment->id . '" data-feed-id="' . $replyComment->feed_id . '" data-comment-id="' . $replyComment->parent_id . '" data-user-id="' . $user->id . '">Edit</a>
			        </li>
			        <li><i class="fa fa-circle" aria-hidden="true"></i></li>
			        <li>
			            <a class="profile-feed-delete-comment" href="javascript:void(0);" data-feed-id="' . $replyComment->feed_id . '" data-comment-id="' . $replyComment->parent_id . '" data-reply-comment-id="' . $replyComment->id . '" data-user-id="' . $user->id . '">Delete</a>
			        </li>
			        <li><i class="fa fa-circle" aria-hidden="true"></i></li>
			        <li>
			            <a class="profile-feed-reply-btn" href="javascript:void(0);" data-comment-id="' . $replyComment->parent_id . '" data-feed-id="' . $replyComment->feed_id . '" data-comment-id="' . $replyComment->id . '" data-user-id="' . $user->id . '">Reply</a>
			        </li>
			        <li class="commenttime">' . $carbon->diffForHumans($replyComment->created_at, true) . ' ago
			        </li>
			    </ul>
			</div>';
    } else if ($loginUserId && $loginUserId != $replyComment->user_id) {
        $html = '<div class="like-div" id="userReplyCommentManage-' . $replyComment->id . '">
			    <ul>
			        <li>
			            <a class="profile-feed-reply-btn" href="javascript:void(0);" data-comment-id="' . $replyComment->parent_id . '" data-feed-id="' . $replyComment->feed_id . '" data-comment-id="' . $replyComment->id . '" data-user-id="' . $user->id . '">Reply</a>
			        </li>
			        <li>
				        <li class="report-post"><a class="report-feed"   data-feed-id="' . $replyComment->feed_id . '"
						   data-comment-id="' . $replyComment->id . '"  data-user-id="' . getLoggedInUserId() . '" href="javascript:void(0);"><i aria-hidden="true" class="fa fa-flag"></i>
						   </a>
					    </li>
			        </li>
			        <li class="commenttime">' . $carbon->diffForHumans($replyComment->created_at, true) . ' ago
			        </li>
			    </ul>
			</div>';
    }

    return $html;
}

function inArray($val, $arr) {
    if (isset($arr)) {
        return in_array($val, $arr);
    } else {
        return false;
    }
}

/**
 * Get reported comment 
 */
function getReportedComment($feedId = null) {
    if ($feedId) {
        return DB::table('timeline_feeds_report')->select('timeline_feeds_report.comment_id')->where(['timeline_feeds_report.feed_id' => $feedId]);
    }

    return false;
}

/* My Timeline gallary section */

function getReportedFeedsId() {

    return DB::table('timeline_feeds_report')->select('timeline_feeds_report.feed_id');
}
