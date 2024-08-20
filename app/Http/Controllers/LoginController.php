<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\SocialAccount;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Socialite;
use Exception;

class LoginController extends Controller {
    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::HOME;
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }
    public function redirectToFacebook() {
        return Socialite::driver('facebook')->redirect();
    }
<<<<<<< HEAD
    public function handleFacebookCallback() {    
        $user = Socialite::driver('facebook')->user();   
=======

    /**
     * Facebook Callback
     * @return type
     */
    public function handleFacebookCallback() {    
        $user = Socialite::driver('facebook')->user();   
        //echo  $user;exit; 
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
        $this->_registerOrLoginUser($user);
        return redirect()->route('homepage');
    }
    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback() {
        $user = Socialite::driver('google')->user();
        $this->_registerOrLoginUser($user);
        return redirect()->route('homepage');
    }
    protected function _registerOrLoginUser($data) {
        $user = User::where('email',$data->email)->first();
        if (!$user) {
            $user = new User();
            $user->username = $data->name;
            $user->email = $data->email;
            $user->role = 'customer';
            $user->firstname = substr($data->name, 0, strpos($data->name, ' '));
            $user->lastname = substr($data->name,strpos($data->name, ' ') + 1);
            $user->is_social_login = '1';
            $user->status = 'approved';
            $user->save();
        }
        Auth::login($user);
    }
}
