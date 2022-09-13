<?php

namespace App\Repositories;

use App\TimelineReportedFeed;
use App\Timeline;
use DB;
use Auth;

use App\Repositories\TimelineRepository;
use App\TimelineComment;

class TimelineReportedFeedRepository
{   
    /**
     * TimelineReportedFeed Model
     * 
     * @var object
     */
    public $model;

    /**
     * Timeline Object
     *
     * @var object
     */
    protected $timeline;

     /**
     * timelineRepository Object
     *
     * @var object
     */

    protected $timelineRepository;

      /**
     * timelineCommentRepository Object
     *
     * @var object
     */

    protected $timelineCommentRepository;

    


    /**
     * Construct
     * 
     */
    public function __construct(TimelineRepository $timelineRepository,TimelineCommentRepository $timelineCommentRepository)
    {
        $this->model = new TimelineReportedFeed();
        $this->timeline = new Timeline();
        $this->timelineRepository = $timelineRepository;
        $this->timelineCommentRepository = $timelineCommentRepository;

    }

    /**
     * Get All TimelineReportedFeeds
     * @return array
     */
    public function getAllTimelineReportedFeeds()
    {   
        return $this->model->with(['reportedBy', 'reportedFeed','feedOwner',
            'reportedComment', 'commentOwner'])->orderby('timeline_feeds_report.created_at', 'DESC')->get();
    }


    /**
     * Get By Id
     * @param int $id
     * @return bool
     */
    public function getById($id = null)
    {
        if($id)
        {
           
            return $this->model->with(['reportedBy', 'reportedFeed','feedOwner',
            'reportedComment', 'commentOwner'])->find($id);
        }

        return false;
    }


    /**
     * DeleteItem
     * @param int $id
     * @return bool
     */
    public function deleteItem($id = null)
    {
        if($id)
        {
            $model = $this->model->find($id);

            if($model)
            {
                if($model->comment_id){
                    TimelineComment::where(['id' => $model->comment_id])->delete();
                    return $model->delete();
                } else {
                   //$this->timelineRepository->deleteFeedById($model->feed_id);
                    $success = $this->timelineRepository->deletedPostandItsSharedFeed($model->feed_id);
                    // $parentPostId = $this->timelineRepository->findOrginalPostId($model->feed_id);
                    // if($parentPostId) {
                    //     $success = $this->timelineRepository->deletedPostandItsSharedFeed($parentPostId);
                    // }
                    
                    return $this->model->where('feed_id', '=',$model->feed_id)->delete();
                }
            }
        }

        return false;
    }

    public function deleteMultipleTimelineReportedFeeds($reportedFeedIds = array())
    {
        // $update = TimelineReportedFeed::whereIn('id', $reportedFeedIds)
        //              ->forceDelete();

            $update = '';
            foreach($reportedFeedIds as $feed_id)
            {
               $update = $this->deleteItem($feed_id);

            }


            if(!$update) {
               return $response = array(
                        'danger' => 'Some error while deleting Reported Posts.',
                );
            } else {
               return $response = array(
                    'success' =>  'Reported Posts successfully deleted.',
                ); 
            }
    }


     /**
     * allowFeed
     * @param int $id
     * @return bool
     */
    public function allowFeed($id = null)
    {
        if($id)
        {
            $model = $this->model->find($id);

            if($model)
            {
                return $model->delete();
            }
        }

        return false;
    }

    public function allowFeeds($reportedFeedIds = array())
    {
        $update = TimelineReportedFeed::whereIn('id', $reportedFeedIds)
                     ->forceDelete();
            if(!$update) {
               return $response = array(
                        'danger' => 'Some error while allowing Reported Posts.',
                );
            } else {
               return $response = array(
                    'success' =>  'Reported Posts successfully allowed.',
                );
            }
    }
}