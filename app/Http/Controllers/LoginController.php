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

//use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller {

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct() {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Facebook Login
     * @return type
     */
    public function redirectToFacebook() {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Facebook Callback
     * @return type
     */
    public function handleFacebookCallback() {  
        echo "hii";
        $user = Socialite::driver('facebook')->user();    
        print_r($user);
        //$user = Socialite::driver('facebook')->stateless()->user();
        //$user = Socialite::driver('facebook')->redirect()->getTargetUrl();
        /*echo "<pre>";
        print_r($user);
        exit;*/
        $this->_registerOrLoginUser($user);
        /*echo "aaa";
        exit;*/
 
    }
    /**
     * Google Login
     * @return type
     */
    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Google Callback
     * @return type
     */
    public function handleGoogleCallback() {
        $user = Socialite::driver('google')->user();
        $this->_registerOrLoginUser($user);
        return redirect()->route('homepage');
    }

    protected function _registerOrLoginUser($data) {
        $user = User::where('email', '=', $data->email)->first();
        if (!$user) {
            $user = new User();
            $user->username = $data->name;
            $user->email = $data->email;
            //$user->provider_id = $data->id;
            $user->role = 'customer';
            $user->firstname = $data->name;
            $user->is_social_login = '1';
            $user->status = 'approved';
            $user->save();
        }
        Auth::login($user);
    }

}
