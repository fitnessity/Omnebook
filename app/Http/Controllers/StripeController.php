<?php

namespace App\Http\Controllers;

// use App\Task;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Auth;
use Response;
use Redirect;
use Validator;
use Input;
use Image;
use File;
use DB;
use App\{User,CompanyInformation};
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class StripeController extends Controller
{
	protected $users;
	
    public function __construct(UserRepository $users)
    {
		$this->users = $users;
    }


	public function dashboard(Request $request) {
		$stripe_client = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
		$current_user = Auth::user(); 
		$company = CompanyInformation::where('id', $current_user->cid)->first();
		if(!@$company->stripe_connect_id){
			return redirect()->back();
		}
		
		try{
			$stripe_account = $stripe_client->accounts->retrieve(
			  $company->stripe_connect_id,
			  []
	  		);

			  Log::info('Stripe Account Status:', [
				'id' => $stripe_account->id,
				'status' => $stripe_account->requirements['disabled_reason'] ?? 'none',
				'charges_enabled' => $stripe_account->charges_enabled,
			]);
	  	}catch(\Stripe\Exception\PermissionException $e){
			$stripe_account = $stripe_client->accounts->create([
				'type' => 'express', 
				'email' => $current_user->email,
			]);
			$company->stripe_connect_id = $stripe_account->id;
			$company->save();
	  	}
  		
		if($stripe_account->charges_enabled){
	  		$company->charges_enabled = 1;
	  		$company->save();
	  		\Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
	  		$login_link = \Stripe\Account::createLoginLink($stripe_account->id);
	  		$url = $login_link["url"];
  		}else{
	  		$link = $stripe_client->accountLinks->create(
			  [
			    'account' => $stripe_account->id,
			    'refresh_url' => env('APP_URL').'/dashboard',
			    'return_url' => env('APP_URL').'/dashboard',
			    'type' => 'account_onboarding',
			  ]
			);
			$url = $link['url'];
  		}		

		
		return redirect($url);
    }


}