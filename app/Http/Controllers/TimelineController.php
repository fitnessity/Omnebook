<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Response;
use App\Repositories\UserRepository;
use App\Repositories\TimelineRepository;
use App\Repositories\TimelineLikeRepository;
use App\Repositories\TimelineCommentRepository;
use App\Repositories\ReviewRepository;
use App\Repositories\TimelineMediaFavoriteRepository;
use DB;
use App\Repositories\NetworkRepository;
use App\Repositories\SportsRepository;
use App\Miscellaneous;
    
class TimelineController extends Controller
{
    /**
     * The Timeline repository instance.
     *
     * @var TimelineRepository
     */
    protected $repository;

    /**
     * The TimelineLike repository instance.
     *
     * @var TimelineLikeRepository
     */
    protected $repositoryTimeLike;

     /**
     * The TimelineComment repository instance.
     *
     * @var TimelineLikeRepository
     */
    protected $repositoryTimeLineComment;

    /**
     * review Repository
     *
     * @var review Object
     */
    protected $review;

    /*
     * The TimelineReplyComment repository instance.
     *
     
     */
    protected $repositoryTimeLineReplyComment;


    /*
     * The Timeline Favorite Media repository instance.
     *
     
     */
    protected $favoriteMediarepo;

    /*
     * The Network repository instance.
     *
     
     */
    protected $network;
    /**
     * sports Repository
     *
     * @var sports Object
     */
    protected $sports;
    /**
     * Create a new controller instance.
     *
     * @param  TTimelineRepository  $timeline
     * @return void
     */
    public function __construct(TimelineRepository $repository, UserRepository $users, TimelineLikeRepository $repositoryTimeLike, TimelineCommentRepository $repositoryTimeLineComment, ReviewRepository $review, TimelineMediaFavoriteRepository $favoriteMediarepo,NetworkRepository $network, SportsRepository $sports)
    {
        $this->middleware('auth', ['except' => 'getFeed']);
        
        $this->repositoryTimeLike           = $repositoryTimeLike;
        $this->repositoryTimeLineComment    = $repositoryTimeLineComment;
        $this->repository                   = $repository;
        $this->users                        = $users;
        $this->review                       = $review;
        $this->favoriteMediarepo            = $favoriteMediarepo;
        $this->network                      = $network;
        $this->sports                       = $sports;
    }

    /**
     * Display a list of all of the user's page.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index()
    {
        $loggedinUser = Auth::user();
        $userFollowers = $this->network->getUserFollowers(Auth::user()->id);
        $userFollowers = count($userFollowers);

        return view('timeline.index', [
            'user'              => getLoggedInUser(),
            'userCurrentwork'   => $this->users->getCurrentworkDetail(getLoggedInUserId()),
            'repository'        => $this->repository,
            'pageTitle'         => "Timeline",
            'userFollowers'     => $userFollowers
        ]);
    }

    public function getMytimeline()
    {
        $loggedinUser = Auth::user();
        
        $followersCount = $this->network->getUserFollowers(Auth::user()->id);

        return view('timeline.mytimeline', [
            'repository'        => $this->repository,
            'UserProfileDetail' => $this->users->getUserProfileDetail($loggedinUser['id'],array('ProfessionalDetail')),
            'pageTitle'         => "My Timeline",
            'followersCount' => count($followersCount)
        ]);
    }

    /**
     * Add Feed Content
     *
     * @param Request $request
     */
    public function addFeedContent(Request $request)
    {
        $input  = $request->all();

        
        $input  = array_merge($input, ['feed_type' => 'content', 'user_id' => Auth::user()->id]);
        
        $feed = $this->repository->create($input);

        if($feed)
        {
            if(isset($input['myfeed']) && $input['myfeed'] == 1)
            {
                $html = getUserFeedHtmlByType($feed);
            }
            else
            {
                $html = getFeedHtmlByType($feed);
            }
            

            echo json_encode(array(
                'status'    => true,
                'html'      => $html,
                'message'   => 'New Feed Added'
            ));
            die;
        }
        
        echo json_encode(array(
            'status'    => false,
            'message'   => 'Unable to Create New Feed'
        ));
        die;
    }

    /**
     * Add Timeline Like Feed
     * @param Request $request
     */
    public function addLikeFeed(Request $request)
    {

        if($this->repository->isReportedFeed($request->get("feed_id")) ) {
             echo json_encode(array(
            'status'    => false,
            'message'   => 'Unable to Like Feed'
            ));
            die;
        }

        $status = $this->repositoryTimeLike->addLikeFeed($request->all());
        if($status)
        {
            return json_encode(array(
                'status'    => true,
                'message'   => 'User Liked Feed'
            ));

        }
        
        return json_encode(array(
            'status'    => false,
            'message'   => 'Unable to Like Feed'
        ));
    }

    /**
     * Remove Timeline Like Feed
     * @param Request $request
     */
    public function removeLikeFeed(Request $request)
    {
        if($this->repository->isReportedFeed($request->get("feed_id")) ) {
             echo json_encode(array(
            'status'    => false,
            'message'   => 'Unable to Un-Like Feed'
            ));
            die;
        }
        $deletedid = DB::table('timeline_feeds_likes')
                       ->select('id')
                       ->where(['user_id' => $request['user_id'], 'feed_id' => $request['feed_id']])
                       ->first();

        if(count($deletedid) > 0)
        {
        }

        $status = $this->repositoryTimeLike->removeLikeFeed($request->all());

        if($status)
        {
            echo json_encode(array(
                'status'    => true,
                'message'   => 'User Unliked Feed'
            ));
            die;
        }
        
        echo json_encode(array(
            'status'    => false,
            'message'   => 'Unable to Un-Like Feed'
        ));
        die;
    }

    /**
     * Share Timeline Like Feed
     *
     * @param Request $request
     */
    public function shareTimeLineFeed(Request $request)
    {
        if($this->repository->isReportedFeed($request->get("feed_id")) ) {
             echo json_encode(array(
            'status'    => false,
            'message'   => 'Unable to Share Feed'
            ));
            die;
        }
       
        $input  = $request->all();
        $feedId     = $request->get('feed_id');
        $content    = $request->get('content');

        $validator = $this->reportFeedValidator($request->all());
         if ($validator->fails()) {
             $this->throwValidationException(
                 $request, $validator
             );
         }
        //$input  = array_merge($input, ['feed_type' => 'content', 'user_id' => Auth::user()->id]);
        // $data = array('user_id' => Auth::user()->id, 'original_post_id' => $input['feed_id'],'feed_type'=>'content', 'content'=>$input['content'], 'is_shared'=>'0');
        // $feed = $this->repository->create($data);
        $feed = $this->repository->shareFeed($request->all(), Auth::user()->id);

        // if($feed){
        //     $status['status'] = true;
        //     $status['type'] = 'success';
        //     $status['alert-type'] = 'alert-success';
        //     $status['msg']  = "Thank you for submitting your response with us!";
        // } else {
        //     $status['status'] = false;
        //     $status['type'] = 'danger';
        //     $status['alert-type'] = 'alert-danger';
        //     $status['msg']  = "Some error has occured while saving the feed.";
        // }

        
        // $request->session()->flash($status['type'], $status['msg']);
        // $response = array(
        //     'type' => $status['type'],
        //     'msg' => $status['msg']
        //  );
        //  return Response::json($response);
        //  exit();
        if($feed)
        {
            $html = getFeedHtmlByType($feed); 

            $shareduser = DB::table('timeline_feeds')->select('user_id')->where('id',$request->get("feed_id"))->first();
            $user =  $shareduser->user_id;
            // echo '<pre>'; print_r($shareduser->user_id); die();
            if(count($shareduser) > 0 && $user != Auth::user()->id)
            {
                
            } 
            
            echo json_encode(array(
                'status'    => true,
                'html'      => $html,
                'message'   => 'Feed Shared Successfully'
            ));
            die;
        }
    
        echo json_encode(array(
            'status'    => false,
            'message'   => 'Unable to Share Feed'
        ));
        die;  
             
    }
    
    /**
     * Upload Video Feed
     *
     * @param Request $request
     */
    public function uploadVideoFeed(Request $request)
    {
        $feed = $this->repository->createVideoFeedPost($request);
        if($feed)
        {
            if(isset($request->myfeed) && $request->myfeed == 1)
            {
                $html = getUserFeedHtmlByType($feed);
            }
            else
            {
                $html = getFeedHtmlByType($feed);
            }

            echo json_encode(array(
                'status'    => true,
                'html'      => $html,
                'message'   => 'New Feed Added'
            ));
            die;
        }
        
        echo json_encode(array(
            'status'    => false,
            'message'   => 'Unable to Create New Feed'
        ));
        die;
    }   

    /**
     * Upload Gallery Feed
     *
     * @param Request $request
     */
    public function uploadGalleryFeed(Request $request)
    {
        $feed = $this->repository->createGalleryFeedPost($request);
                
        if($feed['success'])
        {
            if(isset($request->myfeed) && $request->myfeed == 1)
            {
                $html = getUserFeedHtmlByType($feed['feedObject']);
            }
            else
            {
                $html = getFeedHtmlByType($feed['feedObject']);
            }

             

            echo json_encode(array(
                'feed_id'   => $feed['feedObject']->id,
                'status'    => true,
                'html'      => $html,
                'message'   => 'New Feed Added',
                'success'   => true
            ));
            die;
        }
        
        echo json_encode($feed);
        die;
    }

    /**
     * Post New Commnet
     *
     * @param Request $request
     */
    public function postComment(Request $request)
    {
        $input      = $request->all();
        
        if(isset($input['parent_id'])) 
        {
            if($this->repository->isReportedFeed($input['feed_id']) || $this->repository->isReportedComment($input['feed_id'],$input['parent_id']) ) {
                 echo json_encode(array(
                    'status' => false,
                    'message'   => 'Unable to Create New Reply'
                ));
                 die;
            }
        } else {
            if($this->repository->isReportedFeed($input['feed_id']) ) {
                 echo json_encode(array(
                    'status' => false,
                    'message'   => 'Unable to Create New Comment'
                ));
                die;
            }
        }
        //$feedObject = $this->repository->find($input['feed_id']);
        $comment    = $this->repositoryTimeLineComment->addFeedComment($input);
        $user       = getUserById($comment->user_id);
        
        if($comment)
        {
            $html = '';
            if(isset($input['parent_id']))
            {
                $html = getSingleReplyCommentHTML($comment);
                echo json_encode(array(
                    'status'    => true,
                    'html'      => $html,
                    'message'   => 'New Reply Added'
                ));

                die;
            }
            else
            {
                $html = getSingleCommentHTML($comment);
                echo json_encode(array(
                    'status'    => true,
                    'html'      => $html,
                    'message'   => 'New Comment Added'
                ));                
                die;
            }
        }

        if(isset($input['parent_id']))
        {
            echo json_encode(array(
                'status'    => false,
                'message'   => 'Unable to Create New Reply'
            ));
        }
        else
        {
             echo json_encode(array(
                'status'    => false,
                'message'   => 'Unable to Create New Comment'
            ));
        }
        die;

    }

    /**
     * Edit Comment
     *
     * @param Request $request
     */
    public function postEditComment(Request $request)
    {
        $input      = $request->all();
        //$feedObject = $this->repository->find($input['feed_id']);

        if(isset($input['reply_id']) && $input['reply_id']>0){
            if($this->repository->isReportedFeed($input['feed_id']) || $this->repository->isReportedComment($input['feed_id'],$input['reply_id']) || $this->repository->isReportedComment($input['feed_id'],$input['comment_id']) ) {
                 echo json_encode(array(
                    'status' => false,
                    'message'   => 'Unable to Edit Reply'
                ));
                 die;
            }

            $comment    = $this->repositoryTimeLineComment->updateFeedComment($input['reply_id'], $input['comment_text']);

            if($comment)
            {
                //$user = getUserById($comment->user_id);
                $html = getSingleReplyCommentInnerHTML($comment, []);

                echo json_encode(array(
                    'status'    => true,
                    'html'      => $html,
                    'message'   => 'Reply Updated'
                ));
                die;
            }
 
            echo json_encode(array(
                'status'    => false,
                'message'   => 'Unable to Edit Reply'
            ));
            die;
        } 
        else
        {

            if($this->repository->isReportedFeed($input['feed_id']) || $this->repository->isReportedComment($input['feed_id'],$input['comment_id']) ) {
                 echo json_encode(array(
                    'status' => false,
                    'message'   => 'Unable to Edit Comment'
                ));
                 die;
            }


            $comment    = $this->repositoryTimeLineComment->updateFeedComment($input['comment_id'], $input['comment_text']);

            if($comment)
            {
                $user = getUserById($comment->user_id);
                $commentWithReply = $this->repositoryTimeLineComment->findCommentWithReply($comment->id, $input['feed_id']);
                $commentWithReply = getCommentsReply($commentWithReply);
                $html = getSingleCommentInnerHTML($commentWithReply[0]);

                echo json_encode(array(
                    'status'    => true,
                    'html'      => $html,
                    'message'   => 'Comment Updated'
                ));
                die;
            }

            echo json_encode(array(
                'status'    => false,
                'message'   => 'Unable to Edit Comment'
            ));
            die;
        }
    }

    /**
     * Delete Comment
     *
     * @param Request $request
     */
    public function deleteComment(Request $request)
    {
        $input      = $request->all();

        if(isset($input['reply_id']) && $input['reply_id']>0){
            if($this->repository->isReportedFeed($input['feed_id']) || $this->repository->isReportedComment($input['feed_id'],$input['reply_id'])  || $this->repository->isReportedComment($input['feed_id'],$input['comment_id'])) {
                 echo json_encode(array(
                    'status' => false,
                    'message'   => 'Unable to Delete Reply'
                ));
                 die;
            }

            $comment    = $this->repositoryTimeLineComment->removeFeedComment($input['reply_id']);

            if($comment)
            {
                echo json_encode(array(
                    'status'    => true,
                    'message'   => 'Reply Deleted'
                ));
                die;
            }

            echo json_encode(array(
                'status'    => false,
                'message'   => 'Unable to Delete Reply'
            ));

        } else {
            if($this->repository->isReportedFeed($input['feed_id']) || $this->repository->isReportedComment($input['feed_id'],$input['comment_id']) ) {
                 echo json_encode(array(
                    'status' => false,
                    'message'   => 'Unable to Delete Comment'
                ));
                 die;
            }

            //delete all reply and its associated report
            $comment    = $this->repositoryTimeLineComment->removeFeedComment($input['comment_id']);

            if($comment)
            {
                echo json_encode(array(
                    'status'    => true,
                    'message'   => 'Comment Deleted'
                ));
                die;
            }

            echo json_encode(array(
                'status'    => false,
                'message'   => 'Unable to Delete Comment'
            ));
        }
        die;
    }

    /**
     * Feed Show All Comments
     *
     * @param Request $request
     */
    public function showAllComments(Request $request)
    {
        $input      = $request->all();
        $feed       = $this->repository->getSingleFeedPost($input);
        
        if($feed)
        {
            if(isset($input['close']) && $input['close'] == 'true')
            {
                $html = getCloserComments($feed);
            }
            else
            {
                $html = getUserFeedHtmlByType($feed, true);
            }
           
            echo json_encode(array(
               'status'    => true,
               'html'      => $html,
               'message'   => 'Get All Comments'
            ));
           die;
       }
       
       echo json_encode(array(
           'status'    => false,
           'message'   => 'Unable to Get Feed & Comments'
       ));
       die;
    }

    public function getOurprogram()
    {
        $loggedinUser = Auth::user();
        $sports_names = $this->sports->getAllSportsNames();
        // $serviceType = Miscellaneous::businessType();
        $programType = Miscellaneous::programType();
        // $programFor = Miscellaneous::programFor();
        $numberOfPeople = Miscellaneous::numberOfPeople();
        $ageRange = Miscellaneous::ageRange();
        // $expLevel = Miscellaneous::expLevel();
        $serviceLocation = Miscellaneous::serviceLocation();
        $pFocuses = Miscellaneous::pFocuses();
        $duration = Miscellaneous::duration();
        // $servicePriceOption = Miscellaneous::servicePriceOption();
        // $specialDeals = Miscellaneous::specialDeals();

        return view('timeline.ourprogram', [
            'UserProfileDetail' => $this->users->getUserProfileDetail($loggedinUser['id'], array('service')),
            'sports_names' => $sports_names,
            // 'serviceType' => $serviceType,
            'programType' => $programType,
            // 'programFor' => $programFor,
            'numberOfPeople' => $numberOfPeople,
            'ageRange' => $ageRange,
            // 'expLevel' => $expLevel,
            'serviceLocation' => $serviceLocation,
            'pFocuses' => $pFocuses,
            'duration'=> $duration,
            'pageTitle' => "My Timeline"
        ]);
    }

    public function getSingleProfileFeedPostById(Request $request)
    {
        if($request->get('feed_id'))
        {   
            $feed = $this->repository->find($request->get('feed_id'));
            $html = getFeedHtmlByType($feed);
            
            echo json_encode(array(
                'status'    => true,
                'html'      => $html
            ));
            die;
        }

        echo json_encode(array(
                'status'    => true,
                'html'      => ''
            ));
            die;
    }

    public function getSinglePersonalProfileFeedPostById(Request $request)
    {
        if($request->get('feed_id'))
        {   
            $feed = $this->repository->find($request->get('feed_id'));
            $html = getUserFeedHtmlByType($feed);
            
            echo json_encode(array(
                'status'    => true,
                'html'      => $html
            ));
            die;
        }

        echo json_encode(array(
                'status'    => true,
                'html'      => ''
            ));
            die;
    }

    /**
     * Get Feed By Feed Id
     * 
     * @param Request $request
     * @return string
     */
    public function getFeedByFeedId(Request $request)
    {
        if($request->get('feed_id'))
        {
            $feed = $this->repository->find($request->get('feed_id'));

            switch ($feed->feed_type) 
            {
                case 'content':
                    $html = $feed->content;
                    break;
                
                case 'gallery':
                    $html = getGalleryEditableHtml($feed);
                    break;

                default:
                    $html = getVideoEditableHtml($feed);
                    break;
            }
            
            echo json_encode(array(
                'status'    => true,
                'title'     => $feed->content,
                'feedType'  => $feed->feed_type,
                'html'      => $html,
            ));

            die;
        }

        echo json_encode(array(
            'status'    => false,
            'html'      => '',
        ));
            die;
    }

    public function removeMediaItemGallery(Request $request)
    {
        if($request->get('media_id'))
        {
            $status = $this->repository->removeMediaItemGallery($request->get('media_id'));

            if($status)
            {
                echo json_encode(array(
                    'status'    => true
                ));
                die;
            }
        }

        echo json_encode(array(
            'status'    => false
        ));
        die;
    }

    public function editUploadGalleryFeed(Request $request)
    {
        $status = $this->repository->uploadSingleGalleryItem($request->get('feed_id'), $request->all());
        
        if($status)
        {
            echo json_encode(array(
                'status'    => true
            ));
            die;
        }

        echo json_encode(array(
            'status'    => false
        ));
        die;
    }

    public function updateFeedGalleryTitle(Request $request)
    {
        $feedId     = $request->get('feed_id');
        $content    = $request->get('content');

        if($this->repository->isReportedFeed($feedId) ) {
             echo json_encode(array(
                'status' => false
            ));
            die;
        }
        $refresh = $this->repository->isOriginalPost($request->get('feed_id'));
        $status = $this->repository->updateGalleryFeedTitle($feedId, $content);

        if($status)
        {
            echo json_encode(array(
                'status' => true,
                'refresh'=> $refresh
            ));
            die;
        }

        echo json_encode(array(
            'status' => false,
            'refresh'=> $refresh
        ));
        die;
    }

    public function updateFeedVideoFile(Request $request)
    {
        if($request->get('feed_id') && $request->file('file'))
        {
            $refresh = $this->repository->isOriginalPost($request->get('feed_id'));
            $status = $this->repository->updateVideoFeedFile($request->get('feed_id'), $request->file('file'));    

            if($status)
            {
                echo json_encode(array(
                    'status' => true,
                    'refresh'=> $refresh
                ));
                die;               
            }
        }
    
        echo json_encode(array(
            'status' => false,
            'refresh'=> $refresh
        ));
        die;
    }
    
    public function deleteFeedById(Request $request)
    {
        if($request->get('feed_id'))
        {
            if($this->repository->isReportedFeed($request->get('feed_id')) ) {
                 echo json_encode(array(
                    'status' => false
                ));
                die;
            }
            $refresh = $this->repository->isOriginalPost($request->get('feed_id'));

            $status = $this->repository->deletedPostandItsSharedFeed($request->get('feed_id'));    

            if($status)
            {


                echo json_encode(array(
                    'status' => true,
                    'refresh'=> $refresh
                ));
                die;               
            }   
        }

         echo json_encode(array(
            'status' => false,
            'refresh'=> $refresh
        ));
        die;
    }

    public function getFeed(Request $request, $id){
        if($id)
        {
            $feed = $this->repository->getFeed($id);
        }
        if($feed) {

        $loggedinUser = Auth::user();

        

        if(!$loggedinUser){
            
            return view('timeline.timeline-feed', [
                'feed'        => $feed,
                'pageTitle'         => "Timeline",

                'fbshare_url' => "http://".$_SERVER['HTTP_HOST']."/".$request->path(),
                'fbshare_type' => 'website',
                'fbshare_title' => $feed->content,
                // 'fbshare_desc' => 'this is test desc from here',
               // 'fbshare_image' => ($feed->feed_type == "gallery" && file_exists(public_path().'/uploads/post-gallery'.'/'.$feed->user_id.'/'.$feed->timelineMedia[0]->media_path)) ? asset('/uploads/post-gallery').'/'.$feed->user_id.'/'.$feed->timelineMedia[0]->media_path : asset('images')."/logo.png",
                'fbshare_image' => ($feed->feed_type == "gallery" && file_exists(public_path().'/uploads/post-gallery'.'/'.$feed->user_id.'/'.$feed->timelineMedia[0]->media_path)) 
                    ? asset('/uploads/post-gallery').'/'.$feed->user_id.'/'.$feed->timelineMedia[0]->media_path 
                    : asset('images')."/banner1.jpg",
            ]);
        } else {
            
            $followersCount = $this->network->getUserFollowers(Auth::user()->id);
             return view('timeline.sharedtimeline', [
            'feed'        => $feed,
            'pageTitle'         => "Timeline",

            'fbshare_url' => "http://".$_SERVER['HTTP_HOST']."/".$request->path(),
            'fbshare_type' => 'website',
            'fbshare_title' => $feed->content,
            'repository'        => $this->repository,
            'UserProfileDetail' => $this->users->getUserProfileDetail($loggedinUser['id']),
            'fbshare_image' => ($feed->feed_type == "gallery" && file_exists(public_path().'/uploads/post-gallery'.'/'.$feed->user_id.'/'.$feed->timelineMedia[0]->media_path)) 
                ? asset('/uploads/post-gallery').'/'.$feed->user_id.'/'.$feed->timelineMedia[0]->media_path 
                : asset('images')."/banner1.jpg",
            'followersCount' => count($followersCount)
        ]);
        }
        } else {
            return view('timeline.timeline-feed', [
                'feed'        => '',
                'pageTitle'         => "Timeline",

                'fbshare_url' => "http://".$_SERVER['HTTP_HOST']."/".$request->path(),
                'fbshare_type' => 'website',
                'fbshare_title' => '',
                'fbshare_image' =>  asset('images')."/banner1.jpg",
                ]);
        }
    }

    public function reportFeed(Request $request)
    {
        $feedId     = $request->get('feed_id');
        $content    = $request->get('content');
        $commentId  = $request->get('comment_id');

        $validator = $this->reportFeedValidator($request->all());
         if ($validator->fails()) {
             $this->throwValidationException(
                 $request, $validator
             );
         }
        $refresh = $this->repository->isOriginalPost($request->get('feed_id')); 
        $status = $this->repository->reportPost($feedId,$content,$commentId);

        $request->session()->flash($status['type'], $status['msg']);
                 $response = array(
                    'type' => $status['type'],
                    'msg' => $status['msg'],
                    'refresh'=> $refresh
         );
         return Response::json($response);
         exit();
        // if($status)
        // {
        //     echo json_encode(array(
        //         'status' => true,
        //         'msg' => 'Your report request has been sent.'
        //     ));
        //     die;
        // }

        // echo json_encode(array(
        //     'status' => false
        // ));
        // die;
    }

    protected function reportFeedValidator($data)
     {
         return Validator::make($data, [
                     'content' => 'required' 
                 ],
                 [
                     'required' => 'Report notes is required.',
                 ]);
     }


     protected function shareFeedValidator($data)
     {
         return Validator::make($data, [
                     'content' => 'required' 
                 ],
                 [
                     'required' => 'Description is required.',
                 ]);
     }


     /*Reply Comment Section */

    /**
     * Feed Show All Comments
     *
     * @param Request $request
     */

     public function showAllReplies(Request $request)
    {
        $input      = $request->all();
        $commentsReplyObject = $this->repositoryTimeLineComment->findCommentReplies($input['comment_id'], $input['feed_id'], $input['offset']);

        if(isset($commentsReplyObject))
        {
            $html = getAllReplyCommentsHTML($commentsReplyObject, true);

            echo json_encode(array(
               'status'    => true,
               'html'      => $html,
               'offset' => count($commentsReplyObject),
               'message'   => 'Get All Replies'
            ));
           die;
       } else {
            echo json_encode(array(
               'status'    => true,
               'html'      => '',
               'offset' => 0,
               'message'   => 'Get All Replies'
            ));
            die;
       }

       echo json_encode(array(
           'status'    => false,
           'message'   => 'Unable to Get Replies'
       ));
       die;
    }

    public function getMyTimelineImages()
    {
        $loggedinUser = Auth::user();
        $offset = 0;
        $limit = 20;
        $mediaType = 1;
        $total = $this->repository->getAllMediaCount($mediaType);
        $mediaObject = $this->repository->getAllMedia($mediaType, $offset, $limit);
        $responseObj = $this->repository->getAllMediaHtml($mediaObject, $mediaType);

        return view('timeline.mytimelinemedia', [
            'responseObj'        => $responseObj,
            'offset' => $offset + $limit,
            'limit' => $limit,
            'mediaType' => $mediaType,
            'mediaTotalCount' => $total,
            'UserProfileDetail' => $this->users->getUserProfileDetail($loggedinUser['id']),
            'pageTitle' => "My Images"
        ]);
    }

    public function getMyTimelineVideos()
    {
        $offset = 0;
        $limit = 10;
        $mediaType = 0;
        $loggedinUser = Auth::user();
        $total = $this->repository->getAllMediaCount($mediaType);
        $mediaObject = $this->repository->getAllMedia($mediaType, $offset, $limit);
        $responseObj = $this->repository->getAllMediaHtml($mediaObject, $mediaType);
        return view('timeline.mytimelinemedia', [
            'responseObj'        => $responseObj,
            'offset' => $offset + $limit,
            'limit' => $limit,
            'mediaType' => $mediaType,
            'mediaTotalCount' => $total,
            'UserProfileDetail' => $this->users->getUserProfileDetail($loggedinUser['id']),
            'pageTitle' => "My Videos"
        ]);
    }

    public function viewMoreMedia(Request $request)
    {
        $input  = $request->all();
        $offset = $input['mediaOffset'];
        $limit = $input['mediaSize'];
        $mediaType = $input['mediaType'];
        $loggedinUser = Auth::user();
        $mediaObject = $this->repository->getAllMedia($mediaType, $offset, $limit);
        $responseObj = $this->repository->getAllMediaHtml($mediaObject, $mediaType);

        echo json_encode(array(
            'status'    => true,
            'html'      => $responseObj,
            'count' => count($mediaObject),
            'message'   => 'Media Loaded Successfully'
        ));
        die;
    }

     public function getUserFeeds(Request $request)
     {

        $req_var = $request->all();
        $req_var['offset'] = $req_var['offset']?$req_var['offset']:0;

        $all_feeds = $this->repository->getAllFeeds($req_var['user_id'],$req_var['offset']);
        $output = '';
        foreach($all_feeds as $feed){
            $output .= getFeedHtmlByType($feed);
        } 

        return $output;
     }

     public function getMyFeeds(Request $request)
     {
        $req_var = $request->all();
        $req_var['offset'] = $req_var['offset']?$req_var['offset']:0;

        $my_feeds = $this->repository->getMyFeeds(NULL,$req_var['offset']);
        $output = '';
        foreach($my_feeds as $feed){
            $output .= getUserFeedHtmlByType($feed);
        } 

        return $output;
     }


    /**
     * Add favorite media to user profile
     * @param Request $request
    */

    public function addToFavoriteUserMedia(Request $request)
    {
       $user_id = Auth::user()->id;
       $input = $request->all();

        if(isset($user_id) && isset($input) && !empty($input)) {
           $count = $this->favoriteMediarepo->favariteCount($user_id);
         
            if($count >= 15){

                echo json_encode(array(
                    'status' => false,
                    'message' => "You have reached maximum number of favorite"
                ));
                die;

            } else {
                $result = $this->favoriteMediarepo->addToFavorite($user_id, $input);
                echo json_encode($result);
                die;
            }
        } else {
            echo json_encode(array(
                'status' => false,
                'message' => "Something went wrong"
            ));
            die;
        }
    }

    public function removeToFavoriteUserMedia(Request $request)
    {
       $user_id = Auth::user()->id;
       $input = $request->all();

        if(isset($user_id) && isset($input) && !empty($input)) {

            $result = $this->favoriteMediarepo->removeToFavorite($user_id, $input);
            echo json_encode($result);
            die;

        } else {
            echo json_encode(array(
                'status' => false,
                'message' => "Something went wrong"
            ));
            die;
        }
    }

}

