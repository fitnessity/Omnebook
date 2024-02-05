<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\MailService;
use App\BusinessClaim;
use App\CompanyInformation;
use DB;
use App\User;
use App\Repositories\UserRepository;
use App\Repositories\ReviewRepository;
use View;
use Validator;
use Session;
use Response;

class LoginController extends Controller {

    public function index(Request $request) {
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }

        $onboardCid = $request->cid;
    	return view('home.login',[
            'cart' => $cart,
            'onboardCid' => $onboardCid
        ]);
    }
	
    public function postLogin(Request $request) {
        $postArr = $request->input();
    	//dd($postArr);
    	$rules = [
            'email' => 'required',
            'password' => 'required',
        ];
        $validator = Validator::make($postArr, $rules);
        if($validator->fails()) {
          $errMsg = array();
            foreach($validator->messages()->getMessages() as $field_name => $messages) {
                $errMsg = $messages;
            }
            $response = array(
                'type' => 'danger',
                'msg' => $errMsg,
            );
            return view('home.login',compact('response'));
            /*   return Response::json($response);*/
        } else {            
            if (Auth::attempt(['email' => $postArr['email'], 'password' => $postArr['password'], 'activated' => 1])) {
                session_start();
              
				$user = Auth::user();
				User::whereId($user->id)->update(['last_login' => date('Y-m-d H:i:s'),'last_ip'=>$request->ip()]);
                $_SESSION["myses"] = $request->user();
                $claim = 'not set';
                $claim_cid = $claim_status = $claim_cname = $claim_welcome = $checkoutsession  = $schedule =$onboard = '';
                if(session()->has('claim_business_page')) {
                	$claim = 'set';
                    $claim_cid = session()->get('claim_cid');
                    $data = CompanyInformation::where('id',$claim_cid)->first();
                 
                    if($data != ''){
                        $claim_cname = $data->company_name;
                    }
                    $claim_status = session()->get('claim_status');
                }
                if(session()->has('business_welcome')) {
                    $claim_welcome = session()->get('business_welcome');
                }
                if(session()->has('checkoutsession')) {
                    $checkoutsession = session()->get('checkoutsession');
                }

                if(session()->has('schedule')) {
                    $schedule = session()->get('schedule');
                }
                if(session()->has('redirectToOnboard')){
                    $onboard = session()->get('redirectToOnboard');
                }

                if($onboard != ''){
                    return redirect($onboard);
                }

                if($request->redirect){
                    return redirect($request->redirect);
                }
                if($claim  == 'set'){
                    return redirect('/claim/reminder/'.$claim_cname."/".$claim_cid); 
                }/*else if($claim_welcome != ''){
                    return redirect('/business-welcome');
                }*/else if($checkoutsession != ''){
                    return redirect('/carts');
                }else if($schedule != ''){
                    return redirect('/business_activity_schedulers/'.$schedule);
                }else{
                    return redirect()->route('homepage');
                }
               /* return Response::json($response);*/
            } else {
                $response = array(
                    'type' => 'not_exists',
                    'msg' => 'User details not verified in our database.',
                );
                return view('home.login',compact('response'));
            }
        }
    }
    
    public function logout(Request $request) {
        Auth::logout();
        if(Session('StaffLogin')){
            session()->forget('StaffLogin');
        }
        return redirect('/');
    }
       
}