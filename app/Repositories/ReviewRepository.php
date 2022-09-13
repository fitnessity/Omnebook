<?php

namespace App\Repositories;

use App\Review;
use DB;
use Auth;

class ReviewRepository
{
    /**
     * Review
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
        $this->model = new Review();
    }

    public function findById($id)
    {
        return Review::where('id', $id)->first();
    }

    public function getUserReview($reviewfor_userid)
    {
        return Review::with('reviewfor')
                    ->with('reviewby')
                    ->where('reviewfor_userid', '=', $reviewfor_userid)
                    ->paginate(5);
    }

    /**
     * Get Own Reviews
     * 
     * @param int $userId
     * @return array
     */
    public function getOwnReviews($userId)
    {
        return Review::with('reviewfor')
                        ->with('reviewby')
                        ->where(array('reviewby_userid' => $userId))
                        ->orderBy('id', 'DESC')
                        ->paginate(5);
    }

     /**
     * Update Review
     * 
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateReview($id = null, $data = array())
    {
        if($id)
        {
            $review = $this->model->find($id);
            if($review)
            {
                return $review->update($data);
            }
        }
        return false;
    }

    public function saveReview($data)
    {
       
        $return = array();
        $reviewObj = New Review();
        $reviewObj->reviewfor_userid = $data['reviewfor_userid'];
        $reviewObj->rating = $data['rating'];
        $reviewObj->title = $data['title'];
        $reviewObj->review = $data['review'];
        $reviewObj->reviewby_userid = Auth::user()->id;
        if(!$reviewObj->save()) {
            $return['type'] = 'danger';
            $return['alert-type'] = 'alert-danger';
            $return['msg']  = "Some error has occured while saving review.";
        }else {                
            $return['type'] = 'success';
            $return['alert-type'] = 'alert-success';
            $return['msg']  = "Review saved successfully!";
        }
        return $return;
    }

    /**
     * Delete Review
     * @param int $reviewId
     * @return bool
     */
    public function deleteReview($reviewId = null)
    {
        if($reviewId)
        {
            $review = $this->model->find($reviewId);    

            return $review->delete();
        }
        
        return false;
    }

    public function getAvgUserReview($userid)
    {
        $userReviews = DB::table('reviews')
                     ->select(DB::raw('count(id) as ratingCount'), 'rating')
                     ->where('reviewfor_userid', $userid)
                     ->groupby('rating')
                     ->get();
        
        $data = array_fill(1, 5, 0);
        $return = array();
        for($i=1; $i<=5; $i++) {
            $return['ratings'][$i]['ratingPercentage'] = 0;
            $return['ratings'][$i]['ratingUserCount'] = 0;
        }
        $return['totalRatingsUserCount'] = 0;
        $return['totalAvg'] = 0;

        if(count($userReviews) > 0) {
            foreach($userReviews as $value) {
                $data[$value->rating] = $value->ratingCount;
            }
            $totalRatingsUserCount = array_sum($data);
            $ratingCount = array();
            foreach($data as $key => $value) {
                $data[$key] = array();
                $ratingCount[] =  $key * $value;
                $ratingPercentage = round(($value * 100) / $totalRatingsUserCount, 2);
                $data[$key]['ratingPercentage'] = $ratingPercentage;
                $data[$key]['ratingUserCount'] = $value;
            }
            $totalAvg = round(array_sum($ratingCount) / $totalRatingsUserCount, 1);

            $return['ratings'] = $data;
            $return['totalRatingsUserCount'] = $totalRatingsUserCount;
            $return['totalAvg'] = $totalAvg;
        }
        
        $return['ratings'] = array_reverse($return['ratings'], true);
        return $return;
    }
}