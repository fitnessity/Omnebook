<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Mail\ResetPasswordMail;
use Auth;
use App\{User,SGMailService};
use App\Http\Requests;
use Illuminate\Http\Request;
use Response;
use DB;
use Mail;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Crypt;

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
        $this->middleware('guest', ['except' => ['postEmail','getReset','reset-password']]);
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
        /*print_r($request->all());exit;*/
        if(!(Auth::check()))
            $userdata = $this->users->findByEmail($request['email']);
        else{
            $r = $request->all();
            $userdata = User::where('email',$r['email'])->first();
        }
        if($userdata == '') {
            $response = array(
                'type' => 'danger',
                'msg' => 'Invalid Email Address',
            );
            return Response::json($response);
        }

        $link = env('APP_URL');
        $email_data = array(
            "customerName"=> $userdata->firstname.' '.$userdata->lastname,
            "link" => $link.'/reset-password/'.Crypt::encryptString($userdata->id),
           // "email"=> $request['email']
             "email"=> 'arya.developers.2017@gmail.com'
        );
        $status = SGMailService::sendresetemail($email_data);
        
        return $status;
    

    }
    
    public function getReset($token = null,Request $request)
    {
        $token = $request->token;
        if (is_null($token)) {
            throw new NotFoundHttpException();
        }

        $userdata = User::where('email',$request->email)->first();
        
        if($userdata['role'] == "admin"){
            $view = 'admin.reset';
        }else {
            if(!(Auth::check())){
                $view = 'auth.reset';
            }else {
                print_r("else");
                $view = 'profiles.changePassword';  
            }  
        }
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

        $userdata = $this->users->findByEmail($credentials['email']);
        $userdata = $userdata[0];
        $userdata->password = bcrypt($request->password);
        $userdata->buddy_key = $request->password;
        $userdata->save();
        Auth::login($userdata);
        if($userdata['role'] == "admin") {
            $request->session()->flash('success', 'Password reset successfully !');
            return redirect('/admin/dashboard');
        }else {
            $request->session()->flash('success', 'Password reset successfully !');
            return redirect($this->redirectPath())->with('status', 'Password reset successfully !');
        }        
    }

    public function ResetPassword($id)
    {
        $user_id = Crypt::decryptString($id);
        //$user_id = $id;
        return view('auth.reset_password',compact('user_id'));
    }

    public function postResetPassword(Request $request){
        $this->validate($request, [
            'password' => 'required|same:password_confirmation|min:8',
            'password_confirmation' => 'required|same:password|min:8',
        ]);

        $userdata = $this->users->findById($request->user_id);
        $userdata->password = bcrypt($request->password);
        $userdata->buddy_key = $request->password;
        $userdata->save();

        $request->session()->flash('success', 'Password reset successfully !');
        return redirect('/userlogin');
    }
}