<?php

use Carbon\Carbon;
use App\Repositories\TimelineRepository;

/**
 * Get Feed by Feed Type
 */
function getUserFeedHtmlByType($feedObject, $all = false)
{
	
	$repository = new TimelineRepository();
	$reportedComment = array();
	if($feedObject->original_post_id){
		if($repository->isReportedFeed($feedObject->original_post_id)){
			return '';
		}
		$sharedObject = $feedObject;
		$feedObject = $repository->getFeed($feedObject->original_post_id);

		if($feedObject){
			$feedObject->sharedObject = $sharedObject;
		} else {
			$feedObject = $sharedObject;
		}
	}

	if($feedObject->sharedObject) {
		$timelineReportedFeed = $feedObject->sharedObject->timelineReportFeed;
		$timelineComments = $feedObject->sharedObject->timelineComments; 
	} else {
		$timelineReportedFeed = $feedObject->timelineReportFeed;
		$timelineComments = $feedObject->timelineComments; 
	}
	
	foreach($timelineReportedFeed as $obj)
	{
		if($obj->comment_id == null and $obj->feed_id == $feedObject->id)
		{
			return '';
		} else {
			array_push($reportedComment,$obj->comment_id);
		}
	}
	
	//create array of comment with it replies
	$commentWithReplyObject = getCommentsReply($timelineComments, $reportedComment);

	if($feedObject->sharedObject) {
		$feedObject->sharedObject->timelineComments = $commentWithReplyObject;
		$feedObject->sharedObject->reportedComment = $reportedComment;
	} else {
		$feedObject->timelineComments = $commentWithReplyObject;
		$feedObject->reportedComment = $reportedComment;
	}

	switch($feedObject->feed_type)
	{
		case 'content':
			return getUserContentFeedPost($feedObject, $all);
			break;

		case 'gallery':
			return getUserGalleryFeedPost($feedObject, $all);
			break;

		case 'video':
			return getUserVideoFeedPost($feedObject, $all);
			break;
		
		default: 
			return '';
	}
}


/**
 * Get User Content type Feed
 *
 * @param object $feedObject
 */
function getUserContentFeedPost($feedObject, $all = false)
{
	$shareDetails = '';

	$carbon = new Carbon;

	// if($feedObject->is_shared == 1 )
	// {
	// 	$postOwner 		= getUserById($feedObject->shareFeeds->feed_owner_id);
	// 	$shareDetails 	= " shared ". $postOwner->firstname ."'s Post";
	// }
	$userId = $feedObject->user_id;
	$feedId = $feedObject->id;
	if($feedObject->sharedObject)
	{
		$postOwner 		= getUserById($feedObject->user_id);
		$shareDetails 	= " shared ". $postOwner->firstname ."'s Post";
		$feedId = $feedObject->sharedObject->id;
		$userId = $feedObject->sharedObject->user_id;

	}

	$user = getUserById($userId);
	$html = '';
	$html .= '<div class="uni-forum-list" id="profileId-'. $feedId .'">';
	$html .= getUserFeedHeader($feedObject);
	$sharedContent = '';
	if($feedObject->sharedObject)
	{
		$sharedContent = ' <p>' .$feedObject->sharedObject->content. '</p>';
		
	}
    $html .= '<div class="uni-forum-detail">
    		<h4><strong>' .$user->firstname. '</strong>&nbsp;' .$user->lastname. '&nbsp;' .$shareDetails. '</h4>
        	<h3><span class="profile-hrs"><i class="fa fa-clock-o" aria-hidden="true"></i>' .date('j<\s\up>S</\s\up> M Y', strtotime($feedObject->created_at)). '</span></h3>'
        	. $sharedContent.
	        '<p>' .$feedObject->content. '</p>';
	    $html .= getUserFeedCommentSection($feedObject, $all);
    $html .= '</div></div>';

   return $html;
}

/**
 * General Feed Header
 *
 */
function getUserFeedHeader($feedObject)
{
	$carbon = new Carbon;
	$userId = $feedObject->user_id;
	if($feedObject->sharedObject)
	{
		$userId = $feedObject->sharedObject->user_id;
	}
	
	return '<div class="uni-forum-img"><span>
    		'.getUserProfilePictureByUserId($userId, $feedObject->title, ['height' => 81, 'width' => 81]).'
  			</span></div>';
}

/**
 * Get Feed Comments & Like Section
 * 
 * @param object $feedObject
 * @return string
 */
function getUserFeedCommentSection($feedObjectO, $all = false)
{
	//for shared post logic
	if($feedObjectO->sharedObject){
		$originalContent = $feedObjectO->content;
		$feedObject = $feedObjectO->sharedObject;
		$feedId = $feedObject->original_post_id;
	} else {
		$feedObject = $feedObjectO;
		$originalContent = $feedObject->content;
		$feedId = $feedObject->id;
	}
	$feedLikeStatus = getUserLikeFlag($feedObject);
	$feedLikeCount 	= getFeedLikeCount($feedObject);
	$feedLike 		= 'Like';
	$feedLikeValue 	= 1;
	$feedShareCount = getFeedShareCount($feedObject->id);
	$commentsCount  = getFeedCommentsCount($feedObject->id);
	$allHtml 		= '';
	$addCommentHtml	= '';
	
	if($feedLikeStatus)
	{
		$feedLike 		= 'Unlike';
		$feedLikeValue 	= 0;
	}	
	
	if(! $all)
	{
		$addCommentHtml = '<div class="comment-box last-box">
					<div class="cooment-avatar">
						'.getUserProfilePictureByUserId($feedObject->user_id, $feedObject->title, ['height' => 70, 'width' => 70]).'
					</div>
					<div class="comment-con">
						<input type="text" id="commentText-'. $feedObject->id .'" placeholder="Write a comment..." />
						<button class="postComment" data-feed-id="'. $feedObject->id .'"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
					</div>
				</div>';

		if($commentsCount > 2)
		{
			$allHtml = '<div class="text-right">
				<a href="javascript:void(0);" class="view-more-comments" data-feed-id="' . $feedObject->id. '">
					View All Comments
				</a>
			</div>';	
		}
	}

	$editFeedHTML = '';

	if($feedObject->user_id == getLoggedInUserId())
	{
			$editFeedHTML = '<li><i class="fa fa-circle" aria-hidden="true"></i></li>
		    			 <li><a class="edit-feed"  data-feed-type="'. $feedObject->feed_type .'"  data-feed-id="'. $feedObject->id .'"  data-user-id="' .getLoggedInUserId(). '" href="javascript:void(0);">Edit</a></li>
		    			 <li><i class="fa fa-circle" aria-hidden="true"></i></li>
		    			 <li><a class="delete-feed"  data-feed-type="'. $feedObject->feed_type .'"  data-feed-id="'. $feedObject->id .'"  data-user-id="' .getLoggedInUserId(). '" href="javascript:void(0);">Delete</a></li>';
	}
	$url = urldecode("http://".$_SERVER['HTTP_HOST']."/timeline/feed/".$feedId. "&title=".$originalContent);
	$likeLink = '';
	$shareLink = '';
	if(getLoggedInUserId()){

		$likeLink = '<li><a class="profile-feed-like" href="javascript:void(0);" data-feed-id="'. $feedObject->id .'" data-like-status="'.$feedLikeValue.'" data-user-id="' .getLoggedInUserId(). '">' .$feedLike. '</a></li>
		      <li>';
		$shareLink = '<li> <i class="fa fa-circle" aria-hidden="true"></i></li>
				<li> <a class="profile-feed-like share-with-text" href="javascript:void(0);">Share With</a>
          			<div class="social-buttons">

	          			<a class="share-feed-social fb-share" data-feed-id="'. $feedId .'"  data-user-id="' .getLoggedInUserId(). '"  href="https://www.facebook.com/sharer/sharer.php?u='.$url.'" target="_blank" title="Share on Facebook">
					       <i class="fa fa-facebook"></i>
					    </a>
					    <a class="share-feed-social tw-share" data-feed-id="'. $feedId .'"  data-user-id="' .getLoggedInUserId(). '"  href="https://twitter.com/intent/tweet?url='.$url.'" target="_blank" title="Share on Twitter">
					       <i class="fa fa-twitter"></i>
					    </a>
					    <a class="share-feed-social ln-share" data-feed-id="'. $feedId .'"  data-user-id="' .getLoggedInUserId(). '"  href="https://www.linkedin.com/cws/share?url='.$url.'" target="_blank" title="Share on Linkedin">
					       <i class="fa fa-linkedin"></i>
					    </a>
					</div>
				</li>';
	}

	$statistics = '<div class="like-comm">
				      <a id="likeCount-'. $feedObject->id .'" href="javascript:void(0);"><i class="fa fa-thumbs-up" aria-hidden="true"></i> ' .$feedLikeCount. '</a>
				      <a href="javascript:void(0);" id="commentsCount-' .$feedObject->id. '"><i class="fa fa-commenting" aria-hidden="true"></i> 
				        '. $commentsCount .'
				      </a>
				      <a id="shareCount-'. $feedObject->id .'" href="javascript:void(0);"><i class="fa fa-share-alt" aria-hidden="true"></i> '. $feedShareCount .'
				      </a>
				  </div>';

	return ' <div class="like-div"> '
		    .$statistics
		    .' <ul> '
		    . $likeLink
		    . $editFeedHTML
		    . $shareLink		    
		    .' </ul>		  
		</div>
		<div class="div-commentmain" id="commentsContainer-' .$feedObject->id. '">   
			' .getAllCommentsHTML($feedObject, $all). '
			' .$addCommentHtml. '
			' .$allHtml. '
		</div>';
}



/**
 * Get Gallery Feed Post
 *
 * @param object $feedObject
 */
function getUserGalleryFeedPost($feedObject, $all = false)
{
	$carbon 		= new Carbon;
	$shareDetails 	= '';

	$feedId = $feedObject->id;
	$userId = $feedObject->user_id;

	if($feedObject->sharedObject)
	{
		$postOwner 		= getUserById($feedObject->user_id);
		$shareDetails 	= " shared ". $postOwner->firstname ."'s Post";
		$feedId = $feedObject->sharedObject->id;
		$userId = $feedObject->sharedObject->user_id;

	}

	$galleryMedia = getGalleryMedia($feedObject);

	$user = getUserById($userId);
	$html = '';
	$html .= '<div class="uni-forum-list" id="profileId-'. $feedId .'">';
	$html .= getUserFeedHeader($feedObject);
	$sharedContent = '';
	if($feedObject->sharedObject)
	{
		$sharedContent = ' <p>' .$feedObject->sharedObject->content. '</p>';
		
	}
    $html .= '<div class="uni-forum-detail">
        	<h4><strong>' .$user->firstname. '</strong>&nbsp;' .$user->lastname. '&nbsp;' .$shareDetails. '</h4>
        	<h3><span class="profile-hrs"><i class="fa fa-clock-o" aria-hidden="true"></i>' .date('j<\s\up>S</\s\up> M Y', strtotime($feedObject->created_at)). '</span></h3>'
        	. $sharedContent.
	        '<p>' .$feedObject->content. '</p>
	        <p>' .$galleryMedia. '</p>';
	
    $html .= getUserFeedCommentSection($feedObject, $all);
    $html .= '</div></div>';

   return $html;
}


/**
 * Video type Feed
 */
function getUserVideoFeedPost($feedObject, $all = false)
{
	$carbon 		= new Carbon;
	$shareDetails 	= '';
	
	$feedId = $feedObject->id;
	$userId = $feedObject->user_id;
	if($feedObject->sharedObject)
	{
		$postOwner 		= getUserById($feedObject->user_id);
		$shareDetails 	= " shared ". $postOwner->firstname ."'s Post";
		$feedId = $feedObject->sharedObject->id;
		$userId = $feedObject->sharedObject->user_id;

	}

	$videoFileUrl = false;
	if(isset($feedObject->timelineMedia[0])) {
		$videoFileUrl 	= getVideoFileFullPath($feedObject, $feedObject->timelineMedia[0]->media_path);
	}
	//$videoFileUrl 	= getVideoFileFullPath($feedObject, $feedObject->timelineMedia[0]->media_path);
	$videoEmbeed 	= getVideoPlay($videoFileUrl);
	$user = getUserById($userId);
	$html = '';
	$html .= '<div class="uni-forum-list" id="profileId-'. $feedId .'">';
	$html .= getUserFeedHeader($feedObject);
	$sharedContent = '';
	if($feedObject->sharedObject)
	{
		$sharedContent = ' <p>' .$feedObject->sharedObject->content. '</p>';
		
	}
    $html .= '<div class="uni-forum-detail">
        	<h4><strong>' .$user->firstname. '</strong>&nbsp;' .$user->lastname. '&nbsp;' .$shareDetails. '</h4>
        	<h3><span class="profile-hrs"><i class="fa fa-clock-o" aria-hidden="true"></i>' .date('j<\s\up>S</\s\up> M Y', strtotime($feedObject->created_at)). '</span></h3>'
        	. $sharedContent.
	        '<p>' .$feedObject->content. '</p>
	        <p>' . $videoEmbeed . '</p>';
	
    $html .= getUserFeedCommentSection($feedObject, $all);
    $html .= '</div></div>';

   return $html;
}


/*My Timeline images/ video section*/


function getMyGalleryMedia($mediaObject)
{
	$html = '<div class="editpostdiv">';

	foreach($mediaObject as $media)
	{
		$imgpath = URL::to('uploads/post-gallery/' . $media->user_id . '/thumb/' .$media->media_path);

		$html .= '<span id="mediaId-'.$media->id.'">';
		
		if($media->favorite == 1){
			$html .= '<a href="javascript:void(0);" data-id="'.$media->id.'" title="Remove Favorite" class="unfav-icon favoriteIcon" data-media-type="1"><i class="fa fa-heart" aria-hidden="true" style="color:red"></i></a>';	
		}else {
			$html .= '<a href="javascript:void(0);" data-id="'.$media->id.'" title="Add Favorite" class="fav-icon favoriteIcon" data-media-type="1"><i class="fa fa-heart-o" aria-hidden="true" style="color:red"></i></a>';
		}
			

		$html .='<a href="javascript:void(0);" data-id="'.$media->id.'" title="Remove Image" data-media-type="1" class="editpostdivanchor delete-media-file delete-icon">X</a>
			<a data-lightbox="example-set" data-title="" class="example-image-link" href="'.$imgpath.'">'
			. HTML::image('uploads/post-gallery/' . $media->user_id . '/thumb/' .$media->media_path, 'Gallery Feed Post',  ['height' => 300, 'width' => 300])
			.'</a></span>';
	}
	$html .= '</div>';

	

	return $html;
}

function getMyVideoMedia($mediaObject)
{
	$html = '<div class="editpostdiv">';

	foreach($mediaObject as $media)
	{
		$videoFileUrl 	= getMyVideoFileFullPath($media);

		$html .= '<span id="mediaId-'.$media->id.'">'
			.'<a href="javascript:void(0);" data-id="'.$media->id.'" data-media-type="0" class="delete-media-file delete-icon">X</a>'
			. getVideoPlay($videoFileUrl)
			.'</span>';
	}
	$html .= "</div>";

	return $html;
}

/**
 * get Video Full Path
 *
 * @param string $media object
 */
function getMyVideoFileFullPath($media)
{
	$path = public_path(). DIRECTORY_SEPARATOR .'uploads'. DIRECTORY_SEPARATOR .'post-videos'. DIRECTORY_SEPARATOR. $media->user_id . DIRECTORY_SEPARATOR . $media->media_path;
	
	if(file_exists($path))
	{
		return asset('uploads/post-videos/'. $media->user_id . DIRECTORY_SEPARATOR  .$media->media_path);
	}

	return false;
}

