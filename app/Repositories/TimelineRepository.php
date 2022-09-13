<?php
namespace App\Repositories;

use File;
use App\User;
use App\Task;
use App\Timeline;
use App\TimelineShareFeed;
use App\TimelineMedia;
use App\TimelineReportedFeed;
use App\MailService;
use App\TimelineComment;
use App\TimelineLike;
use DB;
use Auth;
use Image;
use App\Miscellaneous;

class TimelineRepository
{
    /**
     * Timeline
     *
     * @var object
     */
    protected $model;

    /**
     * Timeline Feed Share
     *
     * @var object
     */
    protected $feedShare;

    /**
     * Timeline Media Object
     *
     * @var object
     */
    protected $timelineMedia;
    
    /**
     * Video Upload Path
     * @var string
     */
    protected $videoUploadPath;

    /**
     * Gallery Upload Path
     * @var string
     */
    protected $galleryUploadPath;

    /**
     * Timeline Report Feed Object
     *
     * @var object
     */
    protected $timelineReportedFeed;

    /**
     * Timeline Comment Object
     *
     * @var object
     */
    protected $timelineComment;

     /**
     * Timeline like Object
     *
     * @var object
     */
    protected $timelineLike;

    protected $thumbPath;

    public $imgSize;

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model            = new Timeline();
        $this->timelineMedia    = new TimelineMedia();
        $this->feedShare        = new TimelineShareFeed();
        $this->timelineReportFeed = new TimelineReportedFeed();
        $this->timelineComment = new TimelineComment();
        $this->timelineLike = new TimelineLike();

        $this->videoUploadPath  =  public_path(). DIRECTORY_SEPARATOR .'uploads'. DIRECTORY_SEPARATOR .'post-videos' . DIRECTORY_SEPARATOR . getLoggedInUserId();

        $this->galleryUploadPath = public_path(). DIRECTORY_SEPARATOR .'uploads'. DIRECTORY_SEPARATOR .'post-gallery' . DIRECTORY_SEPARATOR . getLoggedInUserId().DIRECTORY_SEPARATOR;

        $this->thumbPath = public_path(). DIRECTORY_SEPARATOR .'uploads'. DIRECTORY_SEPARATOR .'post-gallery' . DIRECTORY_SEPARATOR . getLoggedInUserId(). DIRECTORY_SEPARATOR .'thumb'.DIRECTORY_SEPARATOR;

        $this->imgSize = 350;

    }

    /**
     * Create New Feed
     *
     * @param int $userId
     * @return array
     */
    public function create($input)
    {
        return $this->model->create($input);
    }

    /**
     * Get All Feeds
     *
     * @param int $userId
     * @return array
     */
    public function getAllFeeds($userId = null,$offset = 0)
    {
        return $this->model->with(['timelineMedia', 'timelineComments','timelineReportFeed'])
            ->leftjoin('user_networks', function($join){
                $join->on('timeline_feeds.user_id', '=', 'user_networks.friend_id');
                $join->orOn('timeline_feeds.user_id', '=', 'user_networks.user_id');
                $join->Where(function($q) {
                    $q->orWhere('user_networks.user_id', '=', Auth::user()->id)
                      ->orWhere('user_networks.friend_id', '=', Auth::user()->id);
                });
            })
            ->join('users', function($join){
                $join->on('users.id', '=', 'timeline_feeds.user_id')->Where('users.is_deleted','=', '0');
            })
            ->select('timeline_feeds.id as id', 'timeline_feeds.user_id as user_id', 'timeline_feeds.feed_type as feed_type', 'timeline_feeds.content as content', 'timeline_feeds.is_shared as is_shared', 'timeline_feeds.original_post_id as original_post_id', 'timeline_feeds.description as description', 'timeline_feeds.created_at as created_at', 'timeline_feeds.updated_at as updated_at')
            ->distinct()
            ->Where('users.id', '=', Auth::user()->id)
            ->orWhere(function($q) {
                $q->orWhere('user_networks.user_id', '=', Auth::user()->id)
                  ->orWhere('user_networks.friend_id', '=', Auth::user()->id);
            })
            ->orderBy('id', 'desc')
            ->offset($offset)
            ->limit(10)
            ->get();


        /*return $this->model->with(['shareFeeds', 'timelineMedia', 'timelineComments','timelineReportFeed'])->orderBy('id', 'db2_escape_string(string_literal)')
            ->get();*/
    }

    /**
     * Get All Feeds
     *
     * @param int $userId
     * @return array
     */
    public function getMyFeeds($userId = null,$offset = 0)
    {
        return $this->model->with(['timelineMedia', 'timelineComments','timelineReportFeed'])
            ->where(['user_id' => getLoggedInUserId()])
            ->orderBy('id','desc')
            ->offset($offset)
            ->limit(10)
            ->get();
    }

        /**
     * Get Feed
     *
     * @param int $feed
     * @return array
     */
    public  function getFeed($feedId = null)
    {
        return $this->model->with(['timelineMedia', 'timelineComments','timelineReportFeed'])
            ->where(['id' => $feedId])
            ->first();
    }
    
    /**
     * Share Feed
     *
     * @param array $input
     * @return array
     */
    public function shareFeed($input, $user_id)
    {

        //  $data = array('user_id' => Auth::user()->id, 'original_post_id' => $input['feed_id'],'feed_type'=>'content', 'content'=>$input['content'], 'is_shared'=>'0');
        // $feed = $this->repository->create($data);
     

        $feed = $this->model->find($input['feed_id']);
        $newFeed = $feed->replicate();
        $newFeed->user_id = $user_id;
        $newFeed->original_post_id = $input['feed_id'];
        $newFeed->feed_type = 'content';
        $newFeed->content = $input['content'];
        $newFeed->is_shared = 0;
        $newFeed->save();
        return $this->getFeed($newFeed->id);
    }
    /*
    public function shareFeed($input)
    {
        $feed = $this->model->with(['shareFeeds', 'timelineMedia', 'timelineComments'])->find($input['feed_id']);
        $newFeed = $feed->replicate();
        $newFeed->user_id = $input['user_id'];
        $newFeed->is_shared = 1;
        $newFeed->save();

        $feedShareData = [
            'user_id'           => $input['user_id'],
            'feed_id'           => $newFeed->id,
            'feed_owner_id'     => $feed->user_id,
            'original_feed_id'  => $feed->shareFeeds->original_feed_id
        ];
        $this->feedShare->create($feedShareData);

        if($feed->feed_type == 'video')
        {
            $this->createShareMedia($input['feed_id'], $feed, $newFeed);
        }
        if($feed->feed_type == 'gallery')
        {
            $this->createGalleryShareMedia($input['feed_id'], $feed, $newFeed);
        }
        return $this->model->with(['shareFeeds', 'timelineMedia', 'timelineComments'])->find($newFeed->id);
    } */

    /**
     * Create Media For Share feed
     *
     * @param int $referenceId
     * @param object $feedObject
     */
    public function createShareMedia($referenceId, $refFeed, $feedObject)
    {
        foreach($feedObject->timelineMedia as $data)
        {
            $referenceFeed = $this->timelineMedia->find($data->id);

            $newShareMedia              = $referenceFeed->replicate();        
            $newShareMedia->feed_id     = $feedObject->id;
            $newShareMedia->user_id     = $feedObject->user_id;
            $newShareMedia->media_path  = $this->copyMediaFile($refFeed, $newShareMedia->media_path);
            $newShareMedia->save();
        }
        
        return true;
    }

    /**
     * Create Media For Share feed
     *
     * @param int $referenceId
     * @param object $feedObject
     */
    public function createGalleryShareMedia($referenceId, $refFeed, $feedObject)
    {
        $referenceFeeds = $feedObject->timelineMedia;
        foreach($referenceFeeds as $referenceFeed)
        {
            $newShareMedia              = $referenceFeed->replicate();        
            $newShareMedia->feed_id     = $feedObject->id;
            $newShareMedia->user_id     = $feedObject->user_id;
            if(isset($newShareMedia->media_path) && !empty($newShareMedia->media_path))
            {
                $mediaPath = $this->copyGalleryMediaFile($feedObject, $refFeed, $newShareMedia->media_path);
                $newShareMedia->media_path  = $mediaPath ? $mediaPath : '';
                $newShareMedia->save();        
            } 
        }
        
        return true;
    }

    /**
     * Copy Media File
     *
     * @param Request $request
     */
    public function copyMediaFile($feedObject, $fileName)
    {
        $filePath = public_path(). DIRECTORY_SEPARATOR .'uploads'. DIRECTORY_SEPARATOR .'post-videos' . DIRECTORY_SEPARATOR . $feedObject->user_id;
        $file = $filePath. DIRECTORY_SEPARATOR . $fileName;

        if(file_exists($file))
        {
            $originalFileName = explode('-', $fileName);
            $newFileName = rand(11111,99999). '-' .$originalFileName[1];
            $status = File::copy($file, $this->videoUploadPath . DIRECTORY_SEPARATOR . $newFileName);

            return $newFileName;
        }
    }

    /**
     * Copy Gallery Media File
     *
     * @param object $feedObject
     * @param string $fileName
     */
    public function copyGalleryMediaFile($feedObject, $refFeed, $fileName)
    {
        $file = public_path(). DIRECTORY_SEPARATOR .'uploads'. DIRECTORY_SEPARATOR .'post-gallery' . DIRECTORY_SEPARATOR  . $refFeed->user_id. DIRECTORY_SEPARATOR . $fileName;
        if(file_exists($file))
        {
            $originalFileName = explode('-', $fileName);
            $newFileName = rand(11111,99999). '-' .$originalFileName[1];

            $newFilePath = public_path(). DIRECTORY_SEPARATOR .'uploads'. DIRECTORY_SEPARATOR .'post-gallery' . DIRECTORY_SEPARATOR  . $feedObject->user_id. DIRECTORY_SEPARATOR . $newFileName;
            $status = File::copy($file, $newFilePath);

            return $newFileName;
        }
        
        return false;
    }
    
    /**
     * Create Video Type Feed Post
     *
     * @param Request $request
     */
    public function createVideoFeedPost($request)
    {
        $videoUploadPath    = $this->checkAndMakeDir($this->videoUploadPath);
        $fileName           = $this->uploadMedia($request->file('file'), $videoUploadPath);

        if($fileName)
        {
            $feedData = [
                'user_id'   => getLoggedInUserId(),
                'feed_type' => 'video',
                'content'   => $request->get('video_content_post_title') ? $request->get('video_content_post_title') : "My Video File"
            ];

            $feedObject = $this->model->create($feedData);

            $feedMediaData = [
                'user_id'       => getLoggedInUserId(),
                'feed_id'       => $feedObject->id,
                'media_type'    => 0,
                'media_path'    => $fileName
            ];

            $feedMediaObject = $this->timelineMedia->create($feedMediaData);

            return $feedObject;
        }
    
        return false;
    }

     /**
     * Check and Make Directory
     *
     * @param string $dirPath
     */
    public function checkAndMakeDir($dirPath = null)
    {

        if(is_dir($dirPath))
        {
            return $dirPath;
        }

        mkdir($dirPath, 0775, true);

        return $dirPath;
    }

    /** 
     * Upload Media
     *
     * @param Request $request
     */
    public function uploadMedia($file, $path = null)
    {

        $extension = $file->getClientOriginalExtension();
        $fileName = rand(11111,99999). '-' .$file->getClientOriginalName();
        
        if($file->move($path, $fileName))
        {
           return $fileName;
        }

       return false;
    }

    /**
     * Create Gallery Feed Post
     *
     * @param object $request
     */    
    public function createGalleryFeedPost($request)
    {
        $input = $request->all();

        $feedData = [
            'user_id'   => getLoggedInUserId(),
            'feed_type' => 'gallery',
            'content'   => $request->get('image_content_post_title') ? $request->get('image_content_post_title') : "My Gallery"
        ];
        

        $feedObject = $this->model->create($feedData);

        foreach($input['file'] as $fileObject)
        {
            $response = Miscellaneous::savePostImageAndThumbnail($fileObject, $this->galleryUploadPath, 1, $this->thumbPath, $this->imgSize, $this->imgSize);

            $uploadedFile = "";

            if(@$response['success'] && @$response['success'] != ''){
                
                $uploadedFile = @$response['filename'];

            }else {

                return $response;
            }

            $mediaFiles[] = [
                'user_id'       => getLoggedInUserId(),
                'feed_id'       => $feedObject->id,
                'media_type'    => 1,
                'media_path'    => $uploadedFile
            ];
        }

        $this->timelineMedia->insert($mediaFiles);

        return array( 'success' => true, 'feedObject' => $feedObject );
    }

    /**
     * Upload Single Gallery Item
     * 
     * @param int $feedId
     * @param array $input
     * @return bool
     */
    public function uploadSingleGalleryItem($feedId, $input)
    {
        $feed = $this->model->find($feedId);
        // $galleryUploadPath  = $this->checkAndMakeDir($this->galleryUploadPath);

        foreach($input['file'] as $fileObject)
        {
            // $fileName = $this->uploadMedia($fileObject, $galleryUploadPath);

            $fileName = Miscellaneous::savePostImageAndThumbnail($fileObject, $this->galleryUploadPath, 1, $this->thumbPath, $this->imgSize, $this->imgSize);

            $uploadedFile = "";

            if(@$fileName['success'] && @$fileName['success'] != ''){
                $uploadedFile = @$fileName['filename'];
            }


            $mediaFiles[] = [
                'user_id'       => $feed->user_id,
                'feed_id'       => $feed->id,
                'media_type'    => 1,
                'media_path'    => $uploadedFile
            ];
        }

        return $this->timelineMedia->insert($mediaFiles);
    }

    public function find($id = null)
    {
        if($id)        
        {
            return $this->model->find($id);
        }

        return false;
    }

    /**
     * Get Single Feed Post
     * 
     * @param array $input
     * @return object
     */
    public function getSingleFeedPost($input)
    {
        //return $this->model->find($input['feed_id']);
        return $this->model->with(['timelineMedia', 'timelineComments','timelineReportFeed'])
            ->where(['id' => $input['feed_id']])
            ->first();
    }

    public function removeMediaItemGallery($mediaId)
    {
        $media = $this->timelineMedia->find($mediaId);

        if($media)
        {
            $status = $this->removeMediaFile($media);
            if($status)
            {
                return $media->delete();
            }
        }

        return false;
    }

    public function removeMediaFile($media)
    {
        if(isset($media)) {

            $thumbPath = "";

            if($media->media_type == 0)
            {
                $filePath = public_path(). DIRECTORY_SEPARATOR .'uploads'. DIRECTORY_SEPARATOR .'post-videos' .DIRECTORY_SEPARATOR . $media->user_id . DIRECTORY_SEPARATOR. $media->media_path;
            }
            else
            {
                $filePath = public_path(). DIRECTORY_SEPARATOR .'uploads'. DIRECTORY_SEPARATOR .'post-gallery' .DIRECTORY_SEPARATOR . $media->user_id . DIRECTORY_SEPARATOR. $media->media_path;

                $thumbPath = $this->thumbPath . DIRECTORY_SEPARATOR. $media->media_path;    
            }

            
            if(file_exists($thumbPath))
            {
                File::delete($thumbPath);
            }

            if(file_exists($filePath))
            {
                return File::delete($filePath);
            }
        }

        return true;
    }

    /**
     * Update Gallery Feed Title
     * 
     * @param int $feedId
     * @param string $content
     * @return bool
     */
    public function updateGalleryFeedTitle($feedId = null, $content = '')
    {
        if($feedId && strlen($content) > 1 )
        {
            $feed =  $this->model->find($feedId);

            if($feed)
            {
                $feed->content = $content;

                return $feed->save();
            }    
        }
       
        return false;
    }

    public function updateVideoFeedFile($feedId, $file)
    {
        $feed               = $this->model->find($feedId);
        $mediaId            = $feed->timelineMedia;

        $videoUploadPath    = $this->checkAndMakeDir($this->videoUploadPath);
        $fileName           = $this->uploadMedia($file, $videoUploadPath);
        $timelineMedia      = $this->timelineMedia->find($mediaId[0]->id);
        $oldMediaPath       = $timelineMedia->media_path;

        $timelineMedia->media_path = $fileName;
        $status =  $timelineMedia->save();

        if($status)
        {
            $vidoefile = public_path(). DIRECTORY_SEPARATOR .'uploads'. DIRECTORY_SEPARATOR .'post-videos' . DIRECTORY_SEPARATOR . $feed->user_id . DIRECTORY_SEPARATOR . $oldMediaPath;

            if(file_exists($vidoefile))
            {
                File::delete($vidoefile);
            }
        }

        return true;
    }

    /**
     * Ddelete Feed By Id
     * 
     * @param int $feedId
     * @return bool
     */
    public function deleteFeedById($feedId = null)
    {
        if($feedId)
        {
            $feed = $this->model->find($feedId);
            if($feed){
                $this->removeCommentsByFeedId($feedId);
                $this->removeLikeByFeedId($feedId);

                if($feed->feed_type == 'gallery')
                {
                    //remove files from path
                    $media = $this->timelineMedia->where(['feed_id' => $feedId])->first();
                    $this->removeMediaFile($media);

                    $this->removeMediaByFeedId($feedId);
                    $galleryStatus  = $this->removeFeedMediaItems($feed);
                    
                    return $this->removeTextFeed($feed);
                }
                else if($feed->feed_type == 'video')
                {
                    //remove files from path
                    $media = $this->timelineMedia->where(['feed_id' => $feedId])->first();
                    $this->removeMediaFile($media);
                    
                    $this->removeMediaByFeedId($feedId);
                    $videoStatus  = $this->removeFeedMediaItems($feed);

                    return  $this->removeTextFeed($feed);
                }
                else
                {
                    return $this->removeTextFeed($feed);
                }                
            }
        }
            
        return false;
    }

    /**
     * RremoveText Feed
     * 
     * @param object $feed
     * @return bool
     */
    public function removeTextFeed($feed = null)
    {
        if($feed)
        {

            //$this->deletedPostandItsSharedFeed($feed->id) ; 
            return $feed->delete();  
        }
        
        return false;
    }

    /**
     * Rremove Feed Media Items
     * 
     * @param object $feed
     * @return bool
     */
    public function removeFeedMediaItems($feed = null)
    {
        if($feed)
        {
            foreach($feed->timelineMedia as $media)
            {
                $mediaStatus = $this->removeMediaFile($media);
            }
            
            return true;    
        }
        
        return false;
    }

     /**
     * Report a post
     *
     * @param int $feedId
     * @param string $content
     * @param int $commentId
     * @return bool
     */
    public function reportPost(
        $feedId = null, $content = '', $commentId = null)
    {
        if($feedId)
        {
             //Set commentId to null in case post is reported
            if(!$commentId) {
                $commentId = null;
                $is_post_reported = true;
            } else {
                $is_post_reported = false;
            }

            //Get feed with its comment if any match with commentId
            $feed = $this->model->with(['User','timelineComments' =>
                function($query) use ($commentId)  {
                    $query->with(['user'])->where('id', '=',$commentId);
                }])
            ->where(['id' => $feedId])
            ->first();

            $comment_owner_id = null;
            if (count($feed->timelineComments) > 0){
                 $comment_owner_id =$feed->timelineComments[0]->user_id;
            }

           $reportPost =  [
                'user_id' => getLoggedInUserId(),
                'feed_id' => $feedId,
                'comment_id' => $commentId,
                'feed_owner_id'=> $feed->user_id,
                'comment_owner_id'=> $comment_owner_id,
                'report_notes'=> $content
            ];

            $values[] = $reportPost;
            $instance = TimelineReportedFeed::firstOrNew($reportPost);

            if(!$instance->fill($values)->save()){
                $return['status'] = false;
                $return['type'] = 'danger';
                $return['alert-type'] = 'alert-danger';
                $return['msg']  = "Some error has occured while saving report to the feed.";
            } else {
               try {
                   MailService::sendEmailReportedFeed($feed, $content, $is_post_reported,$instance->id);
                }
                catch (Exception $e) {
                    throw new Exception("Error While sending email", 1);
                    return false;
                }
                $return['status'] = true;
                $return['type'] = 'success';
                $return['alert-type'] = 'alert-success';
                $return['msg']  = "Thank you for submitting your response with us!";                
            }
            return $return;

        } else {
            $return['status'] = false;
            $return['type'] = 'danger';
            $return['alert-type'] = 'alert-danger';
            $return['msg']  = "Some error has occured while saving report to the feed.";
            return $return;
        }
    }

    /**
     * Check for reported Feed
     *
     * @param int $feedId
     * @return boolean
     */
    public function isReportedFeed($feedId)
    {
        $feedObject =  $this->model->with(['timelineReportFeed'])
            ->where('id',$feedId)
            ->first();
            return $this->isReported($feedObject,$feedId);
    }

    /**
     * Check for reported Comment
     *
     * @param int $feedId
     * @return boolean
     */
    public function isReportedComment($feedId, $commentId)
    {
        $feedObject =  $this->model->with(['timelineComments','timelineReportFeed'])
            ->where('id',$feedId)
            ->first();
            return $this->isReported($feedObject,$commentId, 'C');
    }

    function isReported($feedObject, $id,  $type='F'){
        if(isset($feedObject->timelineReportFeed) && count($feedObject->timelineReportFeed)>0){
            foreach($feedObject->timelineReportFeed as $obj)
            {
                if($type == 'C') {
                    if($obj->comment_id != null && $obj->comment_id == $id && $obj->feed_id ==$feedObject->id ){
                        return true;
                    }
                } else {
                    if($obj->comment_id == null && $obj->feed_id == $feedObject->id ){
                        return true;
                    }
                }
            }
            return false;
        } else {
            return false;
        }
    }

    public function removeCommentsByFeedId($feedId)
    {
        $this->timelineReportFeed->where(['feed_id' => $feedId])->delete();
        return $this->timelineComment->where(['feed_id' => $feedId])->delete();
    }

    // This function will search all child post of that id and delete it's all child post, and then delete that post id
    /*public function deletedPostandItsSharedFeed($feedId){
        $shareFeedIds = $this->feedShare->where('original_feed_id','=',$feedId)->lists('feed_id');
        foreach($shareFeedIds as $shareFeedId)
        {
            $this->deleteFeedById($shareFeedId);
        }
        return $this->deleteFeedById($feedId);
    }*/


    public function findOrginalPostId($feedId) {
        return $this->feedShare->where('feed_id','=',$feedId)->pluck('original_feed_id');
    } 

    public function deletedPostandItsSharedFeed($feedId){
        $shareFeedIds = $this->model->where('original_post_id','=',$feedId)->lists('id');
        
        foreach($shareFeedIds as $shareFeedId)
        {
            $this->deleteFeedById($shareFeedId);
        }
        return $this->deleteFeedById($feedId);
    }


    public function removeLikeByFeedId($feedId)
    {
        return  $this->timelineLike->where(['feed_id' => $feedId])->delete();
    }
    public function removeMediaByFeedId($feedId)
    {
        return  $this->timelineMedia->where(['feed_id' => $feedId])->delete();
    }

    public function isOriginalPost($feedId) {
        if($feedId){
            return $this->model->where('original_post_id','=',$feedId)->pluck('original_post_id') != ""?true:false;
        } else {
            return false;
        }
        
    }


    public function getAllMedia($media_type=1, $offset=0, $limit=10)
    {
      return  $this->timelineMedia->select('timeline_feeds_media.*')->where(['timeline_feeds_media.user_id' => getLoggedInUserId(), 'timeline_feeds_media.media_type' => $media_type])->whereNotIn('timeline_feeds_media.feed_id', getReportedFeedsId())->orderBy('timeline_feeds_media.id', 'desc')
            ->offset($offset)
            ->limit($limit)
            ->get();
    }

    public function getAllMediaHtml($mediaObject, $mediaType)
    {
        if(count($mediaObject)){
            if($mediaType == 1) {
                return  getMyGalleryMedia($mediaObject);
            } else {
                return  getMyVideoMedia($mediaObject);
            }
        } else {
            return '';
        }
    }

    public function getAllMediaCount($media_type=1)
    {
       $res = $this->timelineMedia->select(DB::raw('count(timeline_feeds_media.id) as count'))->where(['timeline_feeds_media.user_id' => getLoggedInUserId(), 'timeline_feeds_media.media_type' => $media_type])->whereNotIn('timeline_feeds_media.feed_id', getReportedFeedsId())->orderBy('timeline_feeds_media.id', 'desc')
            ->get();

        if($res) {
            return $res[0]->count;
        } else {
            return 0;
        }
    }

}
