<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use View;
use Validator;
use App\User;
use Hash;
use Redirect;
use Response;
use Auth;

class AdminAuthBkpController extends Controller
{
    protected $loginPath = '/admin';
    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'PostLogin', 'GetRegister', 'PostRegister', 'GetForgotpassword']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('admin.login');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function PostLogin(Request $request)
    {
        $postArr = Input::all();
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];        
        $validator = Validator::make($postArr,$rules);

        if($validator->fails()) {
            $errMsg = array();
            foreach($validator->messages()->getMessages() as $field_name => $messages) {                
                $errMsg[] = $messages;
            }
            $response = array(
                'type' => 'danger',
                'msg' => $errMsg,
            );
            return Response::json($response);
            // return View::make('admin.login')->with('message',"Something went Wrong");        
        } else {

            if (Auth::attempt(['email' => $postArr['email'], 'password' => $postArr['password']])) {
                if(Auth::user()->role != "admin") {
                    $response = array(
                        'type' => 'danger',
                        'msg' => 'Invalid access',
                    );
                    return Response::json($response);
                    exit();
                }
                // The user is being remembered...
                $request->session()->flash('alert-success', 'Welcome '.$postArr['email']);
                $response = array(
                    'type' => 'success',
                    'msg' => 'You are logged in successfully',
                    'redirecturl' => '/'
                );
                return Response::json($response);
            }
            else {
                $response = array(
                        'type' => 'danger',
                        'msg' => 'Incorrect Email or Password',
                    );

                    return Response::json($response);
                    exit();
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function GetRegister()
    {
         return View::make('admin.register');

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function PostRegister()
    {
        $postArr = Input::all();

        $rules = [
            'company' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required|same:password_confirm',
            'password_confirm' => 'required|same:password',
        ];

        
         $validator = Validator::make($postArr,$rules);

        if($validator->fails()) {
            echo "Error found in the validation";         }
        else {

            $userObj = new User();
            $userObj->username = $postArr['username'];
            $userObj->company = $postArr['company'];
            $userObj->email = $postArr['email'];
            $userObj->password = Hash::make($postArr['password']);
            $userObj->save();

            if($userObj){
                return Redirect::to('/admin');
            }
            
        }

    }
    
    
    public function GetForgotpassword()
    {
        return View::make('admin.forgotpassword');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
