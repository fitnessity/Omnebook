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
        if(isset($request->error) || isset($request->denied)) {
            $request->session()->flash('alert-danger', 'Some error occured. Please try again later.');
            return redirect('/');
        }
        $auth_type = $request->session()->get('auth_type');
        $user_type = $request->session()->get('user_type');

        if($auth_type == "login") {
            $user = $service->getUser(Socialite::driver($provider));
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
