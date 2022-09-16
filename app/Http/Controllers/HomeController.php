<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Auth;
use App\Sports;
use App\Repositories\SportsCategoriesRepository;
use App\Repositories\SportsRepository;
use App\Repositories\ProfessionalRepository;
use App\AddrStates;
use App\AddrCities;
use App\AddrCountries;
use App\CompanyInformation;
use App\BusinessClaim;
use App\Miscellaneous;
use App\Languages;
use DB;
use App\User;
use Session;

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
			$data_state = CompanyInformation::where('company_name', 'LIKE', "%{$query}%")->get();
			foreach($data_state as $state)
			{
				$array_data[]=$state->company_name."~~business_profile"."~~".str_replace(" ","-",$state->company_name)."/".$state->id;
			}
			
			$data_user = User::where('firstname', 'LIKE', "%{$query}%")->orWhere('lastname', 'LIKE', "%{$query}%")->orWhere('username', 'LIKE', "%{$query}%")->get();
			foreach($data_user as $user_data)
			{
				$array_data[]=$user_data->firstname." ".$user_data->lastname."(".$user_data->username.")"."~~personal_profile"."~~".$user_data->username;
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
					else
						$url= "/instant-hire?site_search=".$row;
					$output .= '<li class="searchclick" onClick="selectSearch(\''.$url.'\');" data-num="'.trim($exp[0]).'">'.$exp[0].'</li>';
				}
			}
			else
			{
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
			$data_state = CompanyInformation::where('company_name', 'LIKE', "%{$query}%")->get();
			foreach($data_state as $state)
			{
				$array_data[]=$state->company_name;
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
				$data_state = CompanyInformation::where('company_name', 'LIKE', "%{$query}%")->get();
				foreach($data_state as $state)
				{
					$array_data[]=$state->company_name;
				}
				$user_name = User::where('username', 'LIKE', '%'.$query.'%')->get();
				foreach($user_name as $name)
				{
					$array_data[]=$name->username;
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
          
            $data_bus = CompanyInformation::where('company_name', 'LIKE', "%{$query}%")->get();
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
	                "cname"=>$buss->company_name, 
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
                        </div></li>';
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

    public function already_claim_business() {
    	return view('home.already-claim-business');
    }

}