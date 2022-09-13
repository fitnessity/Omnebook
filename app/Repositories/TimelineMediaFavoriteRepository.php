<?php
namespace App\Repositories;

use App\User;
use App\Task;
use App\TimelineMedia;


class TimelineMediaFavoriteRepository
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
        $this->model = new TimelineMedia();
    }


    /**
     * Count favorite user media
     *
     * @param array $user_id
     * @return array
     * Created on 09/05/18 by Rk
     */
    public function favariteCount($user_id)
    {
        return $this->model->where(['user_id' => $user_id, 'media_type' => 1, 'favorite' => 1])->count();
    }


     /**
     * add favorite media to user
     *
     * @param array $user_id, $mediaObj
     * @return array
     * Created on 09/05/18 by Rk
     */

    public function addToFavorite($user_id, $mediaObj)
    {
        
        
        if(isset($mediaObj) && isset($mediaObj['media_id'])) {

            $result = $this->model->where(['user_id' => $user_id, 'id' => $mediaObj['media_id']])->get();

            if(count($result) > 0){
                $userMedia = $result[0];

                $userMedia->favorite = 1;
                $userMedia->update();
                
                if($userMedia){
                    return [
                        'status' => true,
                        'message' => "Successfully added to my favorite"
                    ];
                }
            } else {
                return [
                    'status' => false,
                    'message' => "Something went wrong"
                ];
            }

        } else {
            return [
                'status' => false,
                'message' => "Something went wrong"
            ];
        }
    }

     public function removeToFavorite($user_id, $mediaObj)
    {
        
        
        if(isset($mediaObj) && isset($mediaObj['media_id'])) {

            $result = $this->model->where(['user_id' => $user_id, 'id' => $mediaObj['media_id']])->get();

            if(count($result) > 0){
                $userMedia = $result[0];

                $userMedia->favorite = 0;
                $userMedia->update();
                
                if($userMedia){
                    return [
                        'status' => true,
                        'message' => "Successfully remove from my favorite"
                    ];
                }
            } else {
                return [
                    'status' => false,
                    'message' => "Something went wrong"
                ];
            }

        } else {
            return [
                'status' => false,
                'message' => "Something went wrong"
            ];
        }
    }

    
}
