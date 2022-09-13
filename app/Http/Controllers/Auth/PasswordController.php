<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Mail\ResetPasswordMail;
use Auth;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;
use Response;
use DB;
use Mail;
use App\Repositories\UserRepository;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;
    protected $redirectTo = '/auth/jsModalpassword';
    
    /**
     * The user repository instance.
     *
     * @var UserRepository
     */
    protected $users;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct(UserRepository $users)
    {
        $this->middleware('guest', ['except' => ['postEmail','getReset']]);
        $this->users = $users;
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postEmail(Request $request)
    {
       
//        $this->validate($request, ['email' => 'required|email']);
        if(!(Auth::check()))
        $userdata = $this->users->findByEmail($request['email']);
        else{
            $r = $request->all();
        $userdata = User::where('email',$r['email'])->get();
        }
        if(count($userdata)==0) {
            $response = array(
                'type' => 'danger',
                'msg' => 'Invalid Email Address',
            );
            return Response::json($response);
        }
        // $languages = DB::table('password_resets')->where('email',$request['email'])->first();
        // print_r($languages);die;
        // Mail::to($request['email'])->send(new ResetPasswordMail($userdata[0],$languages->token));
        // $response = array(
        //                         'type' => 'success',
        //                         'msg' => 'Reset password mail has been sent successfully',
        //                     );
        //                     return Response::json($response);
        $response = Password::sendResetLink($request->only('email'), function (Message $message) {
            $message->subject($this->getEmailSubject());
        });
       
        switch ($response) {
            
            case Password::RESET_LINK_SENT:
                            $response = array(
                                'type' => 'success',
                                'msg' => trans($response),
                            );
                            return Response::json($response);
            case Password::INVALID_USER:
                            $response = array(
                                'type' => 'danger',
                                'msg' => trans($response),
                            );
                            return Response::json($response);
        }
    }
    
    public function getReset($token = null,Request $request)
    {
        $token = $request->token;
        if (is_null($token)) {
            throw new NotFoundHttpException();
        }
        //$userdata = $this->users->findByToken($token);
        $userdata = User::where('email',$request->email)->first();
    
       // print_r($token);die;
        if($userdata['role'] == "admin"){
            $view = 'admin.reset';
        }else {
            if(!(Auth::check())){
           //    
                $view = 'auth.reset';
            }
            else
            {
                print_r("else");
                $view = 'profiles.changePassword';  
            }
          //  
        }
        // print_r($userdata);
      //   die;
        if(!($userdata)){
            return redirect("/")->withErrors(['email' => trans('Invalid Token')]);
        }else {
            return view($view)->with('token', $token);
        }
        
    }
    
    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postReset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|same:password_confirmation|min:8',
            'password_confirmation' => 'required|same:password|min:8',
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        // $response = Password::reset($credentials, function ($user, $password) {
        //     $user->password = bcrypt($password);
        //     $user->save();
        //     Auth::login($user);
        // });
        

        $userdata = $this->users->findByEmail($credentials['email']);
        
//print_r($userdata[0]['role']);die;
    $userdata = $userdata[0];
    $userdata->password = bcrypt($request->password);
    $userdata->save();
    Auth::login($userdata);
        if($userdata['role'] == "admin") {
            $request->session()->flash('success', 'Password reset successfully !');
                    return redirect('/admin/dashboard');
            // switch ($response) {
            //     case Password::PASSWORD_RESET:
            //         $request->session()->flash('success', 'Password reset successfully !');
            //         return redirect('/admin/dashboard');
            //     default:
            //         return redirect()->back()
            //                     ->withInput($request->only('email'))
            //                     ->withErrors(['email' => trans($response)]);
            // }
        }
        else {
            $request->session()->flash('success', 'Password reset successfully !');
            return redirect($this->redirectPath())->with('status', 'Password reset successfully !');
            // switch ($response) {
            //     case Password::PASSWORD_RESET:
            //         $request->session()->flash('success', 'Password reset successfully !');
            //         return redirect($this->redirectPath())->with('status', trans($response));
            //     default:                    
            //         return redirect()->back()
            //                     ->withInput($request->only('email'))
            //                     ->withErrors(['email' => trans($response)]);
            // }
        }        
    }
}