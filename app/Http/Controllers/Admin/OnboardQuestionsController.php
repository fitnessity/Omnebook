<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\{OnboardQuestionsRepository};
use Auth;
use Redirect;

class OnboardQuestionsController extends Controller
{
	protected $on_board;
    public function __construct(OnboardQuestionsRepository $on_board)
    {
        $this->middleware('admin');
        $this->on_board = $on_board;
    }

    public function index(){
        $questions = $this->on_board->getAllOnboardQuestions();
        return view('admin.on_board.index', [
            'questions' => $questions,
            'pageTitle' => 'Manage On Board FAQ\'s'
        ]);
    }

    public function create(){
        return view('admin.on_board.create', [       
            'pageTitle' => 'Add New On Board FAQ\'s'
        ]);
    }

    public function edit($id){
        $questions = $this->on_board->getById($id);
        if($questions){
            return view('admin.on_board.edit', [
                'pageTitle' => 'Edit On Board FAQ\'s',
                'questions' => $questions,
            ]);
        }
        return redirect()->route('on_board_questions.index');   
    }

    public function store(Request $request)
    {
        $questions = $this->on_board->create([
            'title' => $request->title,
            'content' => $request->content,
           ]);

        if($questions){
            session(['key' => 'success']);
            session(['msg' => 'FAQ\'s Created Succesfully !']);    
        }

        return redirect()->route('on_board_questions.index');
    }

    public function update($id, Request $request)
    {
        $status = $this->on_board->update($id,[
           	'title' => $request->title,
            'content' => $request->content,]);

        if($status) {
            session(['key' => 'success']);
            session(['msg' => 'FAQ\'s Updated Succesfully !']);    
        }
        return redirect()->route('on_board_questions.index');
    }

    public function delete($id){
    	$status = $this->on_board->delete($id);
    	if($status) {
            session(['key' => 'success']);
            session(['msg' => 'FAQ\'s Deleted Succesfully !']);    
        }
        return redirect()->route('on_board_questions.index');
    }
}

