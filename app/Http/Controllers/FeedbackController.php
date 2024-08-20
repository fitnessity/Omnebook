<?php
namespace App\Http\Controllers;
use Validator;
use App\Http\Controllers\Controller;
use App\Repositories\FeedbackRepository;
use Input;
use Response;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    protected $feedback;
    public function __construct(FeedbackRepository $feedback)
    {
        $this->feedback = $feedback;
    }
    protected function feedbackValidator($data)
    {
        return Validator::make($data, [            
                    'rating' => 'required',
                    'comment' => 'required',
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|', 
                ],
                [
                    'required' => 'The :attribute is required.',
                ]);
    }
    public function feedback()
    {
        return view('feedback.send_feedback');
    }
    public function jsModalfeedback()
    {
        return view('feedback.feedback');
    }
    public function saveFeedback(Request $request) {
        $this->validate($request, [
            'rating' => 'required','suggestion' => 'required',
            ]);
        $status = $this->feedback->saveFeedback($request);
        $request->session()->flash($status['type'], $status['msg']);
        $response = array(
            'type' => $status['type'], 'msg' => $status['msg']
        );
       return redirect()->route('feedback')->with('message','Thank you for submitting your feedback with us!');
    }
}