<?php
namespace App\Repositories;

use App\User;
use App\Task;
use App\TimelineLike;

class TimelineLikeRepository
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
        $this->model = new TimelineLike();
    }

    /**
     * Add Like Feed
     *
     * @param array $input
     * @return array
     */
    public function addLikeFeed($input)
    {
        return $this->model->create($input);
    }

    /**
     * Remove Like Feed
     *
     * @param array $input
     * @return array
     */
    public function removeLikeFeed($input)
    {
        return $this->model->where(['user_id' => $input['user_id'], 'feed_id' => $input['feed_id']])->delete();
    }
}
