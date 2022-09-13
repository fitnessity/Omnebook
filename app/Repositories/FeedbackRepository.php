<?php

namespace App\Repositories;

use DB;
use Auth;
use App\FitnessityFeedback;
use App\MailService;

class FeedbackRepository
{
    public function findById($id)
    {
        return FitnessityFeedback::where('id', $id)->first();
    }

    public function saveFeedback($data)
    {
        $return = array();
        $Obj = New FitnessityFeedback();
        if(Auth::user()) {
            $Obj->user_id = Auth::user()->id;
        }else {
            $Obj->name = $data['name'];
            $Obj->email = $data['email'];
        }        
        $Obj->rating = $data['rating'];
        $Obj->comment = $data['comment'];
        $Obj->suggestion = $data['suggestion'];
        if(!$Obj->save()) {
            $return['type'] = 'danger';
            $return['alert-type'] = 'alert-danger';
            $return['msg']  = "Some error has occured while saving feedback.";
        }else {

             try {
                MailService::sendEmailFeedback($data);
            }
            catch (Exception $e) {
                throw new Exception("Error While sending email", 1);                
            }

            $return['type'] = 'success';
            $return['alert-type'] = 'alert-success';
            $return['msg']  = "Thank you for submitting your feedback with us!";
        }
        return $return;
    }

    public function getAllFeedbacks($id = NULL)
    {
        $query = FitnessityFeedback::select(DB::raw('fitnessity_feedbacks.*'),DB::raw('CONCAT(users.firstname, " ", users.firstname) as user_full_name'), DB::raw('users.email as user_email'))
            ->leftjoin("users", DB::raw('user_id'), '=', 'users.id');
        
        if(isset($id) && $id > 0)
            $query->where('fitnessity_feedbacks.id',$id);
            
            $query->orderBy('fitnessity_feedbacks.id','DESC');

        return $query->get();
    }
}