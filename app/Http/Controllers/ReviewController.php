<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Validator;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;
use Response;
use App\Repositories\ReviewRepository;
use App\Repositories\UserRepository;

class ReviewController extends Controller
{
    /**
     * The review repository instance.
     *
     * @var ReviewRepository
     */

    /**
     * Create a new controller instance.
     *
     * @param  ReviewRepository  $reviews
     * @return void
     */
    public function __construct(ReviewRepository $reviews, UserRepository $users)
    {
        $this->middleware('auth');
        $this->reviews = $reviews;
        $this->users   = $users;
    }

    public function jsModallesson($modelName) {
        return view('lessons.'.$modelName);
    }

    protected function ReviewValidator($data)
    {
        return Validator::make($data, [            
                    'title' => 'required|max:255',
                    'review' => 'required',
                ],
                [
                    'required' => 'The :attribute is required.',
                ]);
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    { 

      $view = 'reviews.review';
      //$view = 'reviews.index';

      if($request->ajax()){
        $view = 'reviews.index';
      }

      return view($view, [
          'reviews' => $this->reviews->getUserReview(Auth::user()->id),
          'pageTitle' => "REVIEWS"
      ]);
    }

    public function getAdd()
    {
        $professionals = $this->users->getAllProfessionals();
        $dd_professional = array();
        if(count($professionals) > 0){
          foreach($professionals as $professional) {
            $dd_professional[$professional['professional_id']] = $professional['firstname'].' '.$professional['lastname'];
          }
        }
      return view('reviews.writereview', [
            'professional' => $dd_professional,
            'ownreviews'  => $this->reviews->getOwnReviews(getLoggedInUserId()),
            'pageTitle' => "REVIEWS"
        ]);
    }

    public function postSave(Request $request)
    {
        
        $validator = $this->ReviewValidator($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $response = $this->reviews->saveReview($request->all());

        return Response::json($response);
    }

    /**
     * Review Update
     * @param  Request $request
     * @return string
     */
    public function reviewUpdate(Request $request)
    {
      $status = $this->reviews->updateReview($request->get('id'), $request->all());
      
      if($status)
      {
        echo json_encode(array(
            'status' => true
        ));
        
        die; 
      }

        echo json_encode(array(
            'status' => false
        ));
        die;
    }

    public function reviewDelete(Request $request)
    {
        $status = $this->reviews->deleteReview($request->get('id'));
        
        if($status)
        {
          echo json_encode(array(
              'status' => true
          ));
          
          die; 
        }

          echo json_encode(array(
              'status' => false
          ));
          die;
    }
}