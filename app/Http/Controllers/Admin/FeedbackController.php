<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\FeedbackRepository;
use App\User;
use App\FitnessityFeedback;
use Auth;
use Redirect;
use Response;
use DB;
use Input;

class FeedbackController extends Controller
{   
    /**
     * The user repository instance.
     *
     * @var FeedbackRepository
     */
    protected $feedback;
    
    public function __construct(FeedbackRepository $feedback)
    {
        $this->feedback = $feedback;
    }

    public function index()
    { 
        $allFeedbacks = $this->feedback->getAllFeedbacks();      
        return view('admin.feedback.index', [
            'feedbacks' => $allFeedbacks,
            'pageTitle' => 'Manage Feedbacks'
        ]);
    }

    public function viewFeedback($id)
    { 
        if(isset($id) && $id > 0){
            $allFeedbacks = $this->feedback->getAllFeedbacks($id);

            if(@count($allFeedbacks->first()) > 0){
                return view('admin.feedback.view', [
                    'feedback_detail' => $allFeedbacks->first(),
                    'pageTitle' => 'View Feedback'
                ]);    

            } else {

                $response = array(
                    'danger' =>  'Feedback not found.',
                );
                return Redirect::to('/admin/feedbacks')->with('status',$response);
            }

        } else {
            $response = array(
                    'danger' =>  'Feedback not found.',
            );
            return Redirect::to('/admin/feedbacks')->with('status',$response);
        }        
    }

    public function deleteFeedback($id)
    { 
        if(isset($id) && $id > 0){
            $allFeedbacks = FitnessityFeedback::where('id',$id)->delete();
            $response = array(
                'success' =>  'Feedback Succesfully Deleted.',
            );
        } else {
            $response = array(
                    'danger' =>  'Finding Error While Deleting Feedback.',
            );
        } 
        return Redirect::to('/admin/feedbacks')->with('status',$response);       
    }

}