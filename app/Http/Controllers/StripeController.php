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
use App\User;
use App\UserService;
use App\UserProfessionalDetail;
use App\PagePost;
use App\PagePostComments;
use App\PagePostCommentsLike;
use App\PagePostLikes;
use App\PagePostSave;
use App\CompanyInformation;
use App\Miscellaneous;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use App\PageAttachment;
use App\BusinessCompanyDetail;
use App\BusinessExperience;
use App\BusinessInformation;
use App\BusinessService;
use App\BusinessTerms;
use App\BusinessVerified;
use App\BusinessServices;
use App\BusinessServicesMap;
use App\BusinessPriceDetails;
use App\BusinessSubscriptionPlan;
use App\BusinessActivityScheduler;
use App\PageLike;
use App\Notification;
use App\Sports;
use App\BusinessReview;

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
		if(!$company->stripe_connect_id) $company->stripe_connect_id = '111111111';
		
		


		try{
			$stripe_account = $stripe_client->accounts->retrieve(
			  $company->stripe_connect_id,
			  []
	  		);
// 	  		var_dump($company);
// 			echo json_encode($stripe_account);
// 			exit();
// 	  		var_dump($persons);

	  	}catch(\Stripe\Exception\PermissionException $e){
			$stripe_account = $stripe_client->accounts->create([
				'type' => 'express', 
				'email' => $current_user->email,
/*
				'business_type' => 'individual',
				'individual' => [
					'first_name' => 'Odin',
					'last_name' => 'Lin',
					'phone' => '9293635882',
					'dob' => [
						'day' => '03',
						'month' => '11',
						'year' => '1991'
					],
					'address' => [
						'line1' => '444 Washinton street',
						'country' => 'US',
						'city' => 'Jersey City',
						'state' => 'NJ',
						'postal_code' => '07310'
					]
				],
				'business_profile' => [
					'url' => 'https://fitnessity.co/profile/viewbusinessProfile/293'
				]
*/
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
			    'refresh_url' => 'https://fitnessity.co/createNewBusinessProfile',
			    'return_url' => 'https://fitnessity.co/createNewBusinessProfile',
			    'type' => 'account_onboarding',
			  ]
			);
			$url = $link['url'];
  		}		

		return redirect($url);
    }
	
	
}