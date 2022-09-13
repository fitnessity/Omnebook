<?php
namespace App\Repositories;

use App\User;
use App\Task;
use App\TimelineComment;
use App\TimelineReportedFeed;

class TimelineCommentRepository
{
    /**
     * Timeline
     *
     * @var object
     */
    protected $model;

    /**
     * Construct
     *
     */
    public function __construct()
    {
        $this->model = new TimelineComment();
        $this->timelineReportedFeed = new TimelineReportedFeed();
    }

    /**
     * Add Feed Comment
     *
     * @param array $input
     * @return array
     */
    public function addFeedComment($input)
    {
        $input = array_merge($input, ['user_id' => getLoggedInUserId()]);

        return $this->model->create($input);
    }

    /**
     * Add Feed Comment
     *
     * @param array $input
     * @return array
     */
    public function updateFeedComment($id, $content)
    {
        $commentObject = $this->model->find($id);

        $commentObject->content = $content;

        if($commentObject->save())
        {
            return $commentObject;
        }
        
        return false;
    }

    /**
     * Remove Feed Comment with its reply if any
     *
     * @param array $input
     * @return array
     */
    public function removeFeedComment($id)
    {
        $this->timelineReportedFeed->whereIn('comment_id',$this->findAllReplyIds($id))->delete();
        return $this->model->where(['id' => $id])->orWhere(['parent_id'=>$id])->delete();
    }

    public function find($id = null)
    {
        if($id)
        {
            return $this->model->find($id);
        }

        return false;
    }

    /* Return comment with its reply */
    public function findCommentWithReply($id = null, $feedId)
    {
        if($id)
        {
            return $this->model->with('user')->where(['timeline_feeds_comments.id' => $id])->orWhere(['timeline_feeds_comments.parent_id'=>$id])->whereNotIn('id', getReportedComment($feedId))->get();
        }

        return false;
    }

    public function findAllReplyIds($commentId)
    {
        return $this->model->where(['parent_id' => $commentId])->lists('id');
    }

     /* Return comment replies */
    public function findCommentReplies($id = null, $feedId, $offset=0, $limit=5)
    {
        if($id)
        {
             return $this->model->with('user')->where(['timeline_feeds_comments.parent_id'=>$id])->whereNotIn('id', getReportedComment($feedId))->offset($offset)->limit($limit)->orderby('timeline_feeds_comments.id', 'DESC')->get();
        }

        return false;
    }
}
