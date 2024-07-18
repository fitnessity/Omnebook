<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Repositories\{SportsCategoriesRepository,SportsRepository,ProfessionalRepository,UserRepository};
use DB;
use Session;
use App\{AddrStates,AddrCities,AddrCountries,CompanyInformation,BusinessServices,BusinessClaim,Miscellaneous,Languages,MailService,SGMailService,Sports,User,Customer,Transaction,StripePaymentMethod,UserFamilyDetail};

use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    protected $sports_cat;
    public function __construct(SportsCategoriesRepository $sports_cat,SportsRepository $sports, ProfessionalRepository $professional){
        $this->sports_cat = $sports_cat;
        $this->sports = $sports;
        $this->professional = $professional;
    }
    /**
     * Display a list of all of the user's home.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $all_categories = $this->sports_cat->getAllSportsCategories();
        $most_searched_sports = $this->sports->getSportsFromCatId(1);
        $flag = 'topprof';
        $sport_names = $this->sports->getAllSportsNames();
        if($flag){
            $professionals_list = $this->professional->getTopBookedProfessionals($flag);
        }
        if(@$professionals_list)
        {
            $flag = 'topprof';
        } else {
         $professionals_list=array();
        }
        //die;
        //$professionals_list = $this->professional->getTopBookedProfessionals('topprof');
        //print_r($sport_names); die;
		//print_r($popup);die;
		// if($request->popup == 'login'){
		//     return view('home.index', [
		//             'product_categories' => $all_categories,
		//             'most_searched_sports' => $most_searched_sports,
		//             'professionals_list' => $professionals_list,
		//             'sport_names' => $sport_names,
		//             'popup' => 'login'
		//         ]);
		// }
		//for book activity model
		$activity = Miscellaneous::activity();
		$all_categories = $this->sports_cat->getAllSportsCategories();
		//$sports_list = $this->sports->getSportsFromCatId('all');
		$return = Sports::select(DB::raw('sports.*'),DB::raw('sports_categories.category_name'),DB::raw('IF((select count(*) from sports as sports1 where sports1.is_deleted = "0" AND sports1.parent_sport_id = sports.id ) > 0,1,0) as has_child'))
       ->leftjoin("sports_categories", DB::raw('sports.category_id'), '=', 'sports_categories.id');
        $return->where('sports.is_deleted','0');
        $return->where('sports.parent_sport_id',NULL);
        $return->groupBy('sports.id');
        $return->orderBy('sports.sport_name');
        $sports_list  = $return->get();
		$expLevel = Miscellaneous::expLevel();
		$dayactivity = Miscellaneous::dayactivity();
		$participateActivity = Miscellaneous::participateActivity();
		$expProfessional = Miscellaneous::expProfessional();
		$teaching = Miscellaneous::teaching();
		$gender = Miscellaneous::gender();
		$activeLevel = Miscellaneous::activeLevel();
		$expActivity = Miscellaneous::expActivity();
		$ageRange = Miscellaneous::ageRange();
		$getTimeSlot = Miscellaneous::getTimeSlot();
		$trainingLocation = Miscellaneous::trainingLocation();
		$serviceLocation = Miscellaneous::serviceLocation();
		$StartActivity = Miscellaneous::StartActivity();
		$travelUpto = Miscellaneous::travelUpto();
		$language = Languages::get();
		return view('home.index', [
            'product_categories' => $all_categories,
            'getTimeSlot' => $getTimeSlot,
            'most_searched_sports' => $most_searched_sports,
            'professionals_list' => $professionals_list,
            'sport_names' => $sport_names,
			'activity' => $activity,
			'sports_list' => $sports_list,
			'expLevel' => $expLevel,
			'ageRange' => $ageRange,
			'language' => $language,
			'expActivity' => $expActivity,
			'expProfessional' => $expProfessional,
			'activeLevel' => $activeLevel,
			'serviceLocation' => $serviceLocation,
			'teaching' => $teaching,
			'gender' => $gender,
			'participateActivity' => $participateActivity,
			'dayactivity' => $dayactivity,
			'trainingLocation' => $trainingLocation,
			'StartActivity' => $StartActivity,
			'travelUpto' => $travelUpto,
        ]);
    }
    public function allSports(Request $request){
        $all_categories = $this->sports_cat->getAllSportsCategories();
        $all_sports = $this->sports->getSportsFromCatId('all');
        return view('home.viewAllSports', [
            'product_categories' => $all_categories,
            'all_sports' => $all_sports
        ]);
    }
    public function jsModalChildSports($id){
        $child_sports = $this->sports->getChildSportsList($id);
        $parent_sport = $this->sports->getSportDetail($id);
        return view('home.viewChildSports', [
            'child_sports' => $child_sports,
            'parent_sport_name' => @$parent_sport[0]['sport_name']
        ]);
    }
    public function getFilter(UserRepository $users, Request $request)
    {
        if($request->label == '' && $request->zipcode == ''){
            return redirect('/search-result-location?location='.$request->location.'&page=1&page_size=10');
        }
        $this->users = $users;
        $selected_label = isset($request->label) ? $request->label: NULL;
        $selected_location = isset($request->location) ? $request->location: NULL;
        $selected_zipcode = isset($request->zipcode) ? $request->zipcode: NULL;

        if(isset($request->top))
        {
           $result = $this->users->getTopFilter($selected_label);
        }
        else
        {
            $result = $this->users->getFilter($selected_label, $selected_location, $selected_zipcode);
        }
        foreach($result as $key1=> $value)
        {
            $str = '';
            if(count($value['service']) != 0)
            {
                foreach($value['service'] as $key2=>$value2){
                   $sport_id = Sports::where('id',$value2['sport'])->first();
                   if(!empty($sport_id)){
                         $str = $str.$sport_id['sport_name'];
                         if((($key2+1) != count($value['service']))){
                             $str=$str.', ';
                         }
                   }
                }
                $result[$key1]['user_sports']=$str;
            }
            else{
                $result[$key1]['user_sports']=$str;
            }
        }
        return view('home.searchresult', [
            'result' => $result,
            'selected_label' => $selected_label,
            'selected_location' => $selected_location,
            'selected_zipcode' => $selected_zipcode,
            'pageTitle' => "Search"
      ]);
    }

	public function searchaction(Request $request)
	{
		if($request->get('query'))
		{
			$array_data=array();
			$query = $request->get('query');
			//$query = $request->get('query');
		  	$data_city = Sports::where('sport_name', 'LIKE', "%{$query}%")->get();
			foreach($data_city as $city)
			{
				$array_data[]=$city->sport_name;
			}
			$comd = CompanyInformation::where('dba_business_name' ,'=' , null)->get();
			if(!empty($comd)){
				foreach($comd as $det){
					CompanyInformation::where('id', $det->id)->update(["dba_business_name" => $det->company_name]);
				}
			}

			$data_state = CompanyInformation::where('dba_business_name', 'LIKE', "%{$query}%")->get();
			foreach($data_state as $state)
			{
				$array_data[]=$state->dba_business_name."~~business_profile"."~~".str_replace(" ","-",$state->dba_business_name)."/".$state->id;
			}
			
			$searchValues = preg_split('/\s+/', $query, -1, PREG_SPLIT_NO_EMPTY);
			$data_user = User::where(function ($q) use ($searchValues) {
            	$serch1 = @$searchValues[0] != '' ? strtolower(@$searchValues[0]) : '';
                $serch2 = @$searchValues[1] != '' ? strtolower(@$searchValues[1]) : '';
                $q->orderBy('created_at');
                if($serch1 != '' && $serch2 != ''){
                    $q->where(function($q) use ($serch1, $serch2) {
                        $q->where(DB::raw('LOWER(firstname)'), 'like', "%{$serch1}%")
                          ->where(DB::raw('LOWER(lastname)'), 'like', "%{$serch2}%");
                    })
                    ->orWhere(function($q) use ($serch1, $serch2) {
                        $q->where(DB::raw('LOWER(firstname)'), 'like', "%{$serch2}%")
                          ->where(DB::raw('LOWER(lastname)'), 'like', "%{$serch1}%");
                    });
                }else{
                    $q->orWhere(DB::raw('LOWER(firstname)'), 'like', "%{$serch1}%")
                    ->orWhere(DB::raw('LOWER(lastname)'), 'like', "%{$serch1}%")->orWhere(DB::raw('LOWER(username)'), 'LIKE', "%{$serch1}%");
                } 
            })->get();

			//$data_user = User::where('firstname', 'LIKE', "%{$query}%")->orWhere('lastname', 'LIKE', "%{$query}%")->orWhere('username', 'LIKE', "%{$query}%")->get();


			foreach($data_user as $user_data)
			{
				$array_data[]=$user_data->full_name."(".$user_data->username.")"."~~personal_profile"."~~".$user_data->username;
			}

			$data_activity = BusinessServices::where('program_name', 'LIKE', '%'.$query.'%')->get();
			foreach($data_activity as $name)
			{
				$array_data[]=$name->program_name."~~activity_page"."~~".$name->id;
			}

			sort($array_data);
			$output = '<ul id="country-list">';
			if(!empty($array_data)){
				foreach($array_data as $row)
				{
					$exp=explode("~~",$row);
					if(@$exp[1]=='personal_profile')
						$url= "/userprofile/".$exp[2];
					else if(@$exp[1]=='business_profile')
						$url= "/businessprofile/".$exp[2];
					else if(@$exp[1]=='activity_page')
						$url= "/activity-details/".$exp[2];	
					else
						$url= "/activities/activity_type=".$row;
					$output .= '<li class="searchclick" onClick="selectSearch(\''.$url.'\');" data-num="'.trim($exp[0]).'">'.$exp[0].'</li>';
				}
			}else{
				$output .= '<li> Result not found </li>';
			}
			$output .= '</ul>';
		  	echo $output;
		}
	}
	public function searchactioncity(Request $request)
	{
		if($request->get('query'))	
		{
			$array_data=array();
			$query = $request->get('query');
			//$query = $request->get('query');
		  	$data_city = AddrCities::where('city_name', 'LIKE', "%{$query}%")->get();
			foreach($data_city as $city)
			{
				$array_data[]=$city->city_name;
			}
			$data_state = CompanyInformation::where('dba_business_name', 'LIKE', "%{$query}%")->get();
			foreach($data_state as $state)
			{
				$array_data[]=$state->dba_business_name;
			}
			sort($array_data);
			$output = '<ul id="country-list">';
		  	foreach($array_data as $row)
		  	{
		   		$output .= '<li class="searchclickcity" data-num="'.trim($row).'">'.$row.'</li>';
		  	}
		  	$output .= '</ul>';
		  	echo $output;
		 }
	}
	public function searchactionactivity(Request $request)
	{
		if($request->get('query'))
		{
			if($request->get('query'))
			{
				$array_data=array();
				$query = $request->get('query');
				$query = $request->get('query');
				$data_city = Sports::where('sport_name', 'LIKE', "%{$query}%")->get();
				foreach($data_city as $city)
				{
					$array_data[]=$city->sport_name;
				}
				$data_state = CompanyInformation::where('dba_business_name', 'LIKE', "%{$query}%")->get();
				foreach($data_state as $state)
				{
					$array_data[]=$state->dba_business_name;
				}
				$user_name = User::where('username', 'LIKE', '%'.$query.'%')->get();
				foreach($user_name as $name)
				{
					$array_data[]=$name->username;
				}

				$data_activity = BusinessServices::where('program_name', 'LIKE', '%'.$query.'%')->get();
				foreach($data_activity as $name)
				{
					$array_data[]=$name->program_name;
				}
				sort($array_data);
				$output = '<ul id="country-list">';
				foreach($array_data as $row)
				{
					$output .= '<li class="searchclickactivity" data-num="'.trim($row).'">'.$row.'</li>';
				}
				$output .= '</ul>';
				echo $output;
		 	}
		 }
	}

	function searchactionlocation(Request $request)
	{
		if($request->get('query'))
		{
			$query = $request->get('query');
		  	$data_city = AddrCities::where('city_name', 'LIKE', "%{$query}%")->get();
			$array_data=array();
			foreach($data_city as $city)
			{
				$array_data[]=$city->city_name;
			}
			$data_state = AddrStates::where('state_name', 'LIKE', "%{$query}%")->get();
			foreach($data_state as $state)
			{
				$array_data[]=$state->state_name;
			}
			sort($array_data);
			$output = '<ul id="country-list">';
		  	foreach($array_data as $row)
		  	{
		   		$output .= '<li class="searchclicklocation" data-num="'.trim($row).'">'.$row.'</li>';
		  	}
		  	$output .= '</ul>';
		  	echo $output;
		}
	}

	
	public function searchbussinessaction(Request $request) {
        if($request->get('query'))
        {
            $array_data=array();
            /*$array_data1=array();
            $array_data2=array();*/
            $query = $request->get('query');
            //$query = $request->get('query');
          
            $data_bus = CompanyInformation::where('dba_business_name', 'LIKE', "%{$query}%")->orWhere('company_name', 'LIKE', "%{$query}%")->get();
           /* $data_bus1 =BusinessClaim::where('business_name', 'LIKE', "%{$query}%")->where('is_verified',0)->get();*/
            foreach($data_bus as $buss)
            {	
            	$address = '';
            	if($buss->address != ''){
            		$address = $buss->address.', ';
            	}
            	if($buss->city != ''){
            		$address .= $buss->city.', ';
            	}
            	if($buss->state != ''){
            		$address .= $buss->state.', ';
            	}
            	if($buss->country != ''){
            		$address .= $buss->country.', ';
            	}
            	if($buss->zip_code != ''){
            		$address .= $buss->zip_code;
            	}

                $array_data [] = array(
	                "cname"=>$buss->public_company_name, 
	                "cid"=>$buss->id,
	                "claim_business_status"=> $buss->is_verified,
	                "image" => $buss->logo,
	                "address" => $address);
            }

           /* foreach($data_bus1 as $buss)
            {
            	if($buss->address == 'null'){
            		$address = '';
            	}else{
            		$address =  $buss->address;
            	}
                $array_data2[]= array(
                    "cname"=>$buss->business_name, 
                    "cid"=>$buss->id,
                    "claim_business_status"=>$buss->is_verified,
                    "image" => '',
                    "address" => $address);
            }
            $array_data = array_merge($array_data1,$array_data2);*/
                    
            sort($array_data);
            /*print_r($array_data);*/
            $output = '<ul id="bussiness-list">';
            if(!empty($array_data)){
                foreach($array_data as $row)
                {
                    $output .= '<li class="searchclick" onClick="searchclick('.$row['claim_business_status'].','.$row['cid'].')">
						<div class="container">
                        <div class="row rowclass-controller">
                            <div class="col-md-2">';
                            if($row['image'] != ''){
                            	$output .='<img src="'.asset('/public/uploads/profile_pic/thumb/'.$row['image']).'">';
                            }else{
                            	$output .='<div class="company-profile-img-controller">';
										$pf=substr($row['cname'], 0, 1);
								$output .='<p class="img-controller">'.$pf.'</p></div>';
                            }

                            $output .='</div>
                            <div class="col-md-10 div-controller">
                                <p class="pstyle">'.$row['cname'].'</p>
                                <p class="pstyle liaddress">'.$row['address'].'</p>
                            </div>
                            <input type="hidden" name="claim_business_status" id="claim_business_status" value="'.$row['claim_business_status'].'">
                            <input type="hidden" name="cid" id="cid" value="'.$row['cid'].'">
                        </div></div></li>';
                }
            }
            else
            {
                $output .= '<li class="liimage"> <img style="width: 70px; height: 70px;" src ="'.asset('/public/img/shopicon.jpg').'">';
                $output .= "Looks like there's no business with that name listed on Fitnessity You can add it for free by clicking <b>Create Business </b>from your personal profile dashboard or click on the button below.</li>";
            }
            $output .= "</ul><div class='addbusiness-block'><p> Didn't find your business? Add it Fitnessity for Free</p><button type='button' onclick='redirect_to_detail()'>Add Business</button></div>";
            echo $output;
        }
    }

    public function set_session_for_claim($cid ,$status) {
    	Session::put('claim_business_page', 'claim'); 
    	Session::put('claim_cid', $cid); 
    	Session::put('claim_status', $status); 
    }

    public function set_unset_session_business_welcome($check) {
    	if($check == 'not'){
    		Session::put('business_welcome', 'welcome'); 	
    	}
    }

    public function set_session() {
    	Session::put('manage_company', 'company'); 	
    }

    public function addcheckoutsession() {
    	Session::put('checkoutsession', 'checkoutsession'); 	
      	return redirect('/userlogin');
    }

    public function already_claim_business() {
    	return view('home.already-claim-business');
    }

    public function senddummymail(){
    	$id = Auth::user()->id;
    	$status = MailService::sendEmaildummy($id);
    	echo $status;exit;
    }

    public function searchuser(Request $request) {
    	$user = User::orderby('created_at','desc');
    	if($request->term){
    		$searchValues = preg_split('/\s+/', $request->term, -1, PREG_SPLIT_NO_EMPTY);
            $user = $user->where(function ($q) use ($searchValues) {
            	$serch1 = @$searchValues[0] != '' ? strtolower(@$searchValues[0]) : '';
                $serch2 = @$searchValues[1] != '' ? strtolower(@$searchValues[1]) : '';
                $q->orderBy('created_at');
                if($serch1 != '' && $serch2 != ''){
                    $q->where(function($q) use ($serch1, $serch2) {
                        $q->where(DB::raw('LOWER(firstname)'), 'like', "%{$serch1}%")
                          ->where(DB::raw('LOWER(lastname)'), 'like', "%{$serch2}%");
                    })
                    ->orWhere(function($q) use ($serch1, $serch2) {
                        $q->where(DB::raw('LOWER(firstname)'), 'like', "%{$serch2}%")
                          ->where(DB::raw('LOWER(lastname)'), 'like', "%{$serch1}%");
                    });
                }else{
                    $q->orWhere(DB::raw('LOWER(firstname)'), 'like', "%{$serch1}%")
                    ->orWhere(DB::raw('LOWER(lastname)'), 'like', "%{$serch1}%");
                } 
            });
            	//->whereRaw('LOWER(`firstname`) LIKE ?', [ '%'. strtolower($request->term) .'%' ]);
        }
        $user = $user->get();
    	return response()->json($user);
    }

    public function sendGrantAccessMail(Request $request){
    	$user = User::where('id',$request->id)->first();
    	$company = CompanyInformation::findOrFail($request->business_id);
    	$customer = Customer::where([ 'business_id'=>$company->id, 'fname'=>$user->firstname, 'lname'=>$user->lastname ,'email'=> $user->email, 'user_id' => $user->id])->first();
    	if($customer){
    		$customer->update(['profile_pic'=> $user->profile_pic,'request_status'=> 1]);
    		$familyMember = UserFamilyDetail::where(['user_id' => $user->id])->get();
            foreach($familyMember as $member){
                $chk = Customer::where(['fname' =>$member->first_name ,'lname' =>$member->last_name, 'business_id'=>$company->id])->first();
                if($chk == ''){
                    Customer::create([
                        'business_id' => $request->business_id,
                        'fname' => $member->first_name,
                        'lname' => ($member->last_name) ? $member->last_name : '',
                        'username' => $member->first_name.' '.$member->last_name,
                        'email' => $member->email,
                        'country' => 'US',
                        'status' => 0,
                        'phone_number' => $member->mobile,
                        'birthdate' => $member->birthday,
                        'gender' => $member->gender,
                        'user_id' => NULL, //this is null bcz of user is not created at 
                        'parent_cus_id'=> $customer->id ,
                        'relationship' =>$member->relationship,
                        'request_status' =>1
                    ]);
                }
            }

            //$cardData = StripePaymentMethod::where(['user_id' => $user->id , 'user_type' => 'User' ])->get();

            /*foreach($cardData as $data){
                $stripData = StripePaymentMethod::where(['user_id' =>$customer->id ,'payment_id'=> $data->payment_id ,'exp_year' => $data->exp_year ,'last4' =>$data->last4])->first();
                if($stripData == ''){
                    StripePaymentMethod::create([
                        'payment_id' => $data->payment_id,
                        'user_type' => 'Customer',
                        'user_id' => $customer->id,
                        'pay_type'=> $data->pay_type,
                        'brand'=> $data->brand,
                        'exp_month'=> $data->exp_month,
                        'exp_year'=> $data->exp_year,
                        'last4'=> $data->last4,
                    ]);
                }
            }*/

            /*$paymentHistory = Transaction::where('user_type', 'User')
            ->where('user_id', $user->id)
            ->orWhere(function($subquery) use ($customer) {
                $subquery->where('user_type', 'Customer')
                    ->where('user_id', $customer->id);
            })->get();

            foreach($paymentHistory as $data){
                $history = Transaction::where(['user_id' =>$customer->id ,'user_type'=>'Customer'])->first();
                if($history == ''){
                    Transaction::create([
                        'item_id' => $data->item_id,
                        'user_type' => 'Customer',
                        'user_id' => $customer->id,
                        'item_type'=> $data->item_type,
                        'channel'=> $data->channel,
                        'kind'=> $data->kind,
                        'transaction_id'=> $data->transaction_id,
                        'stripe_payment_method_id'=> $data->stripe_payment_method_id,
                        'amount'=> $data->amount,
                        'qty'=> $data->qty,
                        'status'=> $data->status,
                        'refund_amount'=> $data->refund_amount,
                        'payload'=> $data->payload
                    ]);
                }
            }*/
    		return "already";
    	}else{
    		$data = array(
    			"email"=> @$user->email,
    			"cName"=>$user->full_name ,
    			"pName"=>$company->dba_business_name,
    			"url"=> env('APP_URL').'/grant_access/'.Crypt::encryptString($user->id).'/'.Crypt::encryptString($request->business_id)
    		);
    		$status = SGMailService::requestAccessMail($data);
    		return $status;
    	}
    }

    public function login_as(Request $request){
        $user = User::find($request->id);
        Auth::guard('web')->login($user, true);
        return redirect('/');
    }

}