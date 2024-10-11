<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SocialAccountService;
use Socialite;
use App\User;
use App\Repositories\UserRepository;
use Auth;
use Validator;
use Redirect;
use Response;
use Input;


class SocialAuthController extends Controller
{
    public function socialLogin($provider, Request $request)
    {
        //echo "hi";
        //exit;

        $request->session()->put('auth_type', 'login');
        return Socialite::driver($provider)->redirect();
    }

    public function socialRegister($provider, $usertype, Request $request)
    {
        $request->session()->put('auth_type', 'register');
        $request->session()->put('user_type', $usertype);
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallbackLogin(SocialAccountService $service, $provider, Request $request)
    {
        //check if any error
        if(isset($request->error) || isset($request->denied)) {
            $request->session()->flash('alert-danger', 'Some error occured. Please try again later.');
            return redirect('/');
        }
        $auth_type = $request->session()->get('auth_type');
        $user_type = $request->session()->get('user_type');

        if($auth_type == "login") {
            $user = $service->getUser(Socialite::driver($provider));
            //$user = Auth::user();
            if(!$user) {
                $request->session()->flash('alert-danger', 'You are not registered to Fitnessity using these details. Please signup first.');
                return redirect('/');
            }

            auth()->login($user);
            $request->session()->flash('alert-success', 'You are loggedin successfully!');
        }
        else if($auth_type == "register") {
            $user = $service->createUser(Socialite::driver($provider), $user_type);
            if(!$user) {
                $request->session()->flash('alert-danger', 'Error while registering user. Please try again later.');
                return redirect('/');
            }

            auth()->login($user);
            $request->session()->flash('alert-success', 'You are registered successfully!');
            if($user_type == "business") {
                return redirect('/profile/editProfileHistory');
            }
        }

        return redirect('/');
    }
}

// class SocialAuthController extends Controller
// {
    /**
     * The user repository instance.
     *
     * @var UserRepository
     */
    // protected $users;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    // public function __construct(UserRepository $users)
    // {
    //     $this->middleware('guest', ['except' => 'getLogout']);
    //     $this->users = $users;
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    /*protected function validator(array $data)
    {
        return Validator::make($data, [
            'social_id' => 'required',
        ]);
    }

    public function postLogin(){
        
        $postArr = Input::all();
        $validator = $this->validator($postArr);

        if($validator->fails()) {
          $errMsg = array();
            foreach($validator->messages()->getMessages() as $field_name => $messages) {
                $errMsg = $messages;
            }
            $response = array('type' => 'danger','msg' => $errMsg);
            return Response::json($response);
        } else {

            //check if user already exists
            $existingUser = $this->users->checkUserSocialLogin($postArr['social_id'], $postArr['social_provider']);
            if(count($existingUser) == 0) {
                $response = array(
                        'type' => 'danger',
                        'msg' => 'You are not registered to Fitnessity using these details. Please signup first',
                );
                return Response::json($response);
                exit();
            }
            else {
                Auth::login($existingUser);
                $response = array(
                        'type' => 'success',
                        'msg' => 'You are logged in successfully',
                        'redirecturl' => '/'
                );
                return Response::json($response);
            }
        }
    }

    public function PostRegister(){

        $postArr = Input::all();        
        $validator = $this->validator($postArr);

        if($validator->fails()) {
            $errMsg = array();
            foreach($validator->messages()->getMessages() as $field_name => $messages) {
                $errMsg = $messages;
            }
            $response = array('type' => 'danger','msg' => $errMsg);
            return Response::json($response);
        } else {

            // make an entry for user
            $postArr['role'] = 'customer';
            $result = $this->users->registerSocialUser($postArr);
            if(!$result){
                $response = array(
                   'type' => 'danger',
                   'msg' => 'Some wrror occured while registering. Please try again later.',
                );
                return Response::json($response);
            }else {
                $response = array(
                    'type' => 'success',
                    'msg' => 'You are registered successfully. Please login to system.',
                    'redirecturl' => '/',
                );
                return Response::json($response);
            }
        }
    }
    
}*/