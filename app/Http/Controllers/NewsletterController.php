<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Newsletter;
use App\Repositories\NewsletterRepository;
use Validator;
use Redirect;
use Response;

class NewsletterController extends Controller
{
    protected $newsletter;

    public function __construct(NewsletterRepository $newsletter)
    {
        $this->newsletter = $newsletter;    
    }
    /**
     * Display a list of all of the user's page.
     *
     * @param  Request  $request
     * @return Response
     */
    public function saveNewsletter(Request $request)
    {
        $input = $request->all();

        $validator = $this->validator($input);
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        if($input['name'] != "" && $input['email'] != "")
        {
            $data = $this->newsletter->getByEmail($input['email']);
            
            if(!empty($data))
            {
                echo '1';
            }
            else
            {
                $status = $this->newsletter->create($request->all());
                echo '2';
            }
        }
        else
        {
            echo "Error";
        }
    }

    protected function validator($data)
    {
        return Validator::make($data, [            
            'name' => 'required|max:255|regex:/^[a-zA-Z ]*$/',
            'email' => 'required|string|email|max:255',
        ]);
    }    

    protected function emailvalidator($data)
    {
        return Validator::make($data, [            
            'email' => 'required|string|email|max:255',
        ]);
    }
    public function addnewsletter(Request $request)
    {        
       $getData = Newsletter::where('email',$request->email)->first();
       if(!empty($getData)){   
        return response()->json(['success'=>'false']);    
    }else{      
        $data = array(
            "name" => $request->name,
            "email" => $request->email,
        );
        Newsletter::create($data);
        return response()->json(['success'=>'success']);  
    }
        /* $request->session()->flash('alert-success', 'Subscribe Succesfully !');
         return redirect('/');*/
    }

    public function getUnsubscribe()
    {
        return view('unsubscribe');
    }

    public function unsubscribe(Request $request)
    {
        $input = $request->all();

        $validator = $this->emailvalidator($input);
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        if($input['email'] != "")
        {
            $data = $this->newsletter->getByEmail($input['email']);
            
            if(!empty($data))
            {
                $status = $this->newsletter->deleteNewsletter($data->id);
                if($status)
                {
                    $request->session()->flash('alert-success', 'Unsubscribe Succesfully !');
                    $response = array(
                        'type' => 'success',
                        'msg' => 'Unsubscribe Succesfully !',
                    );
                    return Response::json($response);
                    exit();
                }
            }
            else
            {
                $response = array(
                    'type' => 'danger',
                    'msg' => 'we can not find this Subscriber',
                );
                    
                return Response::json($response);
            }
        }        
    }
}