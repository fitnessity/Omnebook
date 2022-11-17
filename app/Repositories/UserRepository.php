<?php

namespace App\Repositories;

use App\User;
use App\Sports;
use App\SocialAccount;
use DB;
use Auth;
use App\UserEmploymentHistory;
use App\UserProfessionalDetail;
use App\CompanyInformation;
use ReCaptcha\ReCaptcha;
use App\Miscellaneous;
use Intervention\Image\Facades\Image;

class UserRepository
{
    public function findById($id)
    {
        return User::where('id', $id)->first();
    }
    
    public function findByEmail($email)
    {
        return User::where('email', $email)->get();
    }
    
    public function findByToken($token)
    {
       return User::select('users.*')
                    ->join("password_resets", DB::raw('password_resets.email'), '=', 'users.email')
                    ->where('password_resets.token', $token)->first();
    }

    public function validateUser($email, $id = 0)
    {
        $query = User::where('email', $email);

        if(isset($id) && $id > 0)
            $query->where('id', '!=', $request->id);
        $existing_user = $query->first();
        if(@count($existing_user) > 0) {
            return false;
        }
        return true;
    }

    public function getUserProfileDetail($id, $module = array())
    {
        $userid = 0;
        if(Auth::User()){
            $userid = Auth::User()->id;
        }
        
        $query = User::with('countries')
                    ->with('states')
                    ->with('cities')
                    ->with('customerDetail')
                    ->with(['follows' => function ($q) use($id,$userid) {
                        $q->where('user_id', '=', $userid);
                        $q->where('follower_id', '=', $id);
                    }])
                    ->with(['favourites' => function ($q) use($id,$userid) {
                        $q->where('user_id', '=', $userid);
                        $q->where('favourite_user_id', '=', $id);
                    }]);

        if(isset($module) && count($module) > 0) {

            if(in_array('professional_detail', $module)){
                $query->with('ProfessionalDetail');
            }
            if(in_array('history', $module)){
                $query->with('employmenthistory');
            }
            if(in_array('company', $module)){
                $query->with('company');
            }
            if(in_array('education', $module)){
                $query->with('education');
            }
            if(in_array('certification', $module)){
                $query->with('certification');
            }
            if(in_array('service', $module)){
                $query->with('service');
            }
            if(in_array('security', $module)){
                $query->with('UserSecurityQuestion');
            }
            if(in_array('membership', $module)){
                $query->with('UserMembership');
            }            
        }
        else {
            $query->with('ProfessionalDetail')
                     ->with('employmenthistory')
                     ->with('education')
                     ->with('certification')
                     ->with('service')
                     ->with('UserSecurityQuestion')
                     ->with('UserMembership');
        }
        if(is_array($id)) {

            $query->whereIn('id', $id);
            return $query->get();
        }
        else {
            $query->where('id', $id);
            return $query->first();    
        }        
    }
    
    public function getUserProfileDetail1($id, $module = array())
    {
      // print_r($id);die;
        $query = CompanyInformation::with('ProfessionalDetail')
                     ->with('employmenthistory')
                     ->with('education')
                     ->with('certification')
                     ->with('service')->where('id',$id);
        return $query->first();    
    }
    
    public function getUserProfileDetail2($id, $module = array())
    {
       
        /*$query = CompanyInformation::with('ProfessionalDetail')
                     ->with('employmenthistory')
                     ->with('education')
                     ->with('certification')
                     ->with('service')->whereIn('id', $id);
		return $query->get();*/
					 
		/*DB::enableQueryLog();
		$query = CompanyInformation::with('service')->whereIn('cid', $id);
        $query->get();
		dd(\DB::getQueryLog());*/
    }

    public function getAllProfessionals($selected_sport = null)
    {
        $query = User::select('*', 'users.id AS professional_id')
                     ->with('countries')
                     ->with('states')
                     ->with('cities')
                     ->with('employmenthistory')
                     ->with('education')
                     ->with('certification');
                     
                     // ->with('service')
                     // ->with('sport')
                     //->where('role', 'business');                     
                     // ->where('status', 'approved');
        if(isset($selected_sport) && $selected_sport != null) {
            $query->join("user_services as service", DB::raw('service.user_id'), '=', 'users.id')
                  ->where("service.sport", $selected_sport);
        }

        if(Auth::user()->role == 'business') {
            $query->where('users.id', '!=', Auth::user()->id);
        }
        return $query->get();
    }

    /*public function getAllFilteredProfessionalsProfiles($selected_sport=null, $experience_level=null, $train_to=null, $gender=null)
    {
        $query = User::select('users.*', 'users.id AS professional_id',
                      DB::raw('group_concat(distinct(CONCAT(UCASE(LEFT(service.sport, 1)), SUBSTRING(service.sport, 2)))) as user_sports'))
                     ->join("user_professional_details as professionaldetail", DB::raw('professionaldetail.user_id'), '=', 'users.id')
                     ->leftjoin("user_services as service", DB::raw('service.user_id'), '=', 'users.id')
                     // ->with('countries')
                     // ->with('states')
                     // ->with('cities')
                     // ->with('employmenthistory')
                     // ->with('education')
                     // ->with('certification')
                     ->where('role', 'business')
                     ->where('activated', 1);

        if(isset($selected_sport) && $selected_sport != null) {
            $query->where("service.sport", $selected_sport);
        }
        if(isset($gender) && $gender != null && $gender != 'no_preference') {
            $query->whereIn("users.gender", $gender);
        }
        if(isset($experience_level) && $experience_level != null) {
            $query->whereIn("professionaldetail.experience_level", $experience_level);
        }
        if(isset($train_to) && $train_to != null) {
            // $query->where("professionaldetail.train_to", $train_to);
            $query->whereRaw('FIND_IN_SET("'.$train_to.'",professionaldetail.train_to)');
        }
        
        if(Auth::user()->role == 'business') {
            $query->where('users.id', '!=', Auth::user()->id);
        }
        $query->groupBy('users.id');
        return $query->get();
    }*/

    public function getAllFilteredProfessionals($selected_sport=null, $gender=null, $experience_level=null, $train_to=null, $personality=null, $availability=null,$selected_location=null,$professional_type=null,$filter_review_star=null,$miles_radius_filter=0,$selected_location_lat=null,$selected_location_lng=null)
    {

        $query = User::select('users.*', 'users.id AS professional_id', 
                        DB::raw('group_concat(distinct(CONCAT(UCASE(LEFT(service.sport, 1)), SUBSTRING(service.sport, 2)))) as user_sports'),'reviews.avg_rating','users_favourite.favourite_user_id as fav_user_id')
                     ->join("user_professional_details as professionaldetail", DB::raw('professionaldetail.user_id'), '=', 'users.id')
                     ->leftjoin("user_services as service", DB::raw('service.user_id'), '=', 'users.id')
                     ->leftjoin('users_favourite',function ($join){
                            $join->on('users_favourite.favourite_user_id','=','users.id');
                            $join->where('users_favourite.user_id','=',Auth::user()->id);
                        })
                     ->leftjoin(DB::raw('(select reviewfor_userid,round(avg(rating),2) as avg_rating from reviews group by reviewfor_userid) as reviews '), DB::raw('reviews.reviewfor_userid'), '=', 'users.id')
                     // ->with('countries')
                     ->with('states')
                     // ->with('cities')
                     // ->with('employmenthistory')
                     // ->with('education')
                     // ->with('certification')
                     ->where('is_deleted', '0')
                    // ->where('role', 'business')
                     ->where('activated', 1);
        // sports filter
        if(isset($selected_sport) && $selected_sport != null) {
            $query->where("service.sport", $selected_sport);
        }
        // gender filter

        if(isset($gender) && $gender != null && $gender != 'no_preference') {
            $query->where("users.gender", $gender);
        }
        // experience level filter
        if(isset($experience_level) && $experience_level != null) {
            
            $experience_level = is_array($experience_level) ? $experience_level : array($experience_level);
            $query->whereIn("professionaldetail.experience_level", $experience_level);
        }
        
        // provides training filter
        // if(isset($train_to) && $train_to != null) {
            // $query->where("professionaldetail.train_to", $train_to);
        //     $query->whereRaw('FIND_IN_SET("'.$train_to.'",professionaldetail.train_to)');
        // }

        if(isset($train_to) && $train_to != null) {

            $traintoArr = explode('|', $train_to);

            if(count($traintoArr) > 0) {
                $setTrainquery = "";
                foreach ($traintoArr as $key => $value) {

                    if($setTrainquery == '')
                        $setTrainquery .=  '(FIND_IN_SET("'.$value.'",professionaldetail.train_to)';
                    else
                        $setTrainquery .=  ' OR FIND_IN_SET("'.$value.'",professionaldetail.train_to)';
                }
                $setTrainquery .= ')';
            }

            $query->whereRaw($setTrainquery);
        }

        // personality filter
        // if(isset($personality) && $personality != null) {
        //     // $query->where("professionaldetail.personality", $personality);
        //     $query->whereRaw('FIND_IN_SET("'.$personality.'",professionaldetail.personality)');
        // }

        if(isset($personality) && $personality != null) {

            $personalityArr = explode('|', $personality);

            if(count($personalityArr) > 0) {
                $setPerquery = "";
                foreach ($personalityArr as $key => $value) {

                    if($setPerquery == '')
                        $setPerquery .=  '(FIND_IN_SET("'.$value.'",professionaldetail.personality)';
                    else
                        $setPerquery .=  ' OR FIND_IN_SET("'.$value.'",professionaldetail.personality)';
                }
                $setPerquery .= ')';
            }
            $query->whereRaw($setPerquery);
        }

        // professional type filter
        if(isset($professional_type) && $professional_type != null) {
            $query->where("professionaldetail.professional_type_id", $professional_type);
        }


        // review stars filter
        if(isset($filter_review_star) && $filter_review_star != null) {
            $query->where("reviews.avg_rating", '>=', $filter_review_star);
        }
        // location filter
        if(isset($selected_location) && $selected_location != NULL) {
            $location = explode(",", $selected_location);
            $city = trim($location[0]);
            $state = trim($location[1]);

            // apply miles filter if selecetd
            if((isset($miles_radius_filter) && $miles_radius_filter != NULL && $miles_radius_filter > 0) 
                && (isset($selected_location_lat) && $selected_location_lat != NULL && isset($selected_location_lng) && $selected_location_lng != NULL)){

                if($miles_radius_filter == 1){
                    $filter_miles = 1;
                } else if($miles_radius_filter == 2){
                    $filter_miles = 3;
                } else if($miles_radius_filter == 3){
                    $filter_miles = 5;
                } else if($miles_radius_filter == 4){
                    $filter_miles = 10;
                } else {
                    $filter_miles = 0;
                }       

                $query->join('addr_cities as city', function($join) use ($city,$filter_miles,$selected_location_lat,$selected_location_lng)
                {
                    $join->on('city.id', '=', 'users.city')
                         ->where(DB::raw('lower(city.city_name)'), '=', strtolower($city))
                         ->orWhere(DB::raw("( 3959 * acos( cos( radians($selected_location_lat) ) * cos( radians( users.latitude ) ) * cos( radians( users.longitude ) - radians($selected_location_lng) ) + sin( radians($selected_location_lat) ) * sin( radians( users.latitude ) ) ) )"), '<=', $filter_miles);
                });
                
            } else {
                $query->join('addr_cities as city', function($join) use ($city)
                {
                    $join->on('city.id', '=', 'users.city')
                         ->where(DB::raw('lower(city.city_name)'), '=', strtolower($city));
                });
            }

        } else {

            // For quick hire booking email

            if((isset($miles_radius_filter) && $miles_radius_filter != NULL && $miles_radius_filter > 0) 
                && (isset($selected_location_lat) && $selected_location_lat != NULL && isset($selected_location_lng) && $selected_location_lng != NULL)){

                $query->where(DB::raw("( 3959 * acos( cos( radians($selected_location_lat) ) * cos( radians( users.latitude ) ) * cos( radians( users.longitude ) - radians($selected_location_lng) ) + sin( radians($selected_location_lat) ) * sin( radians( users.latitude ) ) ) )"), '<=', $miles_radius_filter);
                
            }

        }
        // availability filter


        if(isset($availability) && $availability != null) {
            if (count($availability) >0 ) {
                $setquery = '';
                foreach ($availability as $value) {
                    if($setquery == '')
                        $setquery .=  '(FIND_IN_SET("'.$value.'",professionaldetail.availability)';
                    else
                        $setquery .=  ' OR FIND_IN_SET("'.$value.'",professionaldetail.availability)';
                }
                $setquery .= ')';
            }else {
                $setquery =  'OR FIND_IN_SET("'.$availability.'",professionaldetail.availability)';
            }
            $query->whereRaw($setquery);
        }

        if(Auth::user()->role == 'business') {
            $query->where('users.id', '!=', Auth::user()->id);
        }
        $query->where('users.id', '!=', Auth::user()->id);
        $query->groupBy('users.id');
        
        return $query->paginate(9);
    }

    public function checkUserSocialLogin($social_id, $social_provider)
    {
        $query = User::join('social_accounts', 'users.id', '=', 'social_accounts.user_id')
                     ->where('is_social_login', '1')
                     ->where('social_accounts.provider_user_id', $social_id)
                     ->where('social_accounts.provider', $social_provider);

        return $query->first();
    }

    public function registerSocialUser($data)
    {
        $userObj = New User();
        $userObj->role = $data['role'];
        $userObj->firstname = $data['social_name'];
        $userObj->email = $data['social_email'] ;
        $userObj->is_social_login = '1';
        // $userObj->social_id = $data['social_id'];
        // $userObj->provider = $data['social_provider'];
        $userObj->save();

        $user_id = $userObj->id;

        $SocialAccountObj = New SocialAccount();
        $SocialAccountObj->user_id = $userObj->id;
        $SocialAccountObj->provider_user_id = $data['social_id'];
        $SocialAccountObj->provider = $data['social_provider'];
        $SocialAccountObj->save();        
    }

    public function getCurrentworkDetail($userid)
    {
        return UserEmploymentHistory::where('user_id', $userid)
                            -> where('is_present', '1')
                            -> first();
    }

    public function getCountriesList()
    {
        return DB::table("addr_countries")->pluck("country_name","country_code");
    }

    public function getStateList($country_code)
    {
        // $st = DB::table("addr_countries")
        //             ->where("country_name",$country_code)
        //             ->pluck("country_code");
                    
       // print_r($st[0]);die;
        return DB::table("addr_states")
                    ->where("country_code",$country_code)
                    ->pluck("state_name","id");
    }
    public function getCityList($state_id)
    {
        return DB::table("addr_cities")
                    ->where("state_id",$state_id)
                    ->pluck("city_name","id");
    }

    //Get total user count
    public function getUserCount($user_type = '')
    {
        $total_users =  DB::table("users");
        switch ($user_type) {
            //Social Media Users
            case 'social_media_users': 
                $total_users -> where("is_social_login",1);
                $total_users -> whereIn("role",['customer','business']);
                break;
            //Total Business Users
            case 'business_users': 
                $total_users -> where("role",'business');
                break;
            //Total Personal Users
            case 'personal_users': 
                $total_users -> where("role",'customer');
                break;
            //Total Users 
            default: 
                $total_users -> whereIn("role",['customer','business']);
                break; 
        }
        $total_users -> where("is_deleted",0);
        return $total_users->count();
    }

    public function getUserCountByStatus($status = '')
    {
        $total_users =  DB::table("users");
        switch ($status) {
            //Approved Profiles
            case 'approved': 
                $total_users -> where("status",'approved');
                break;
            //Pending Profiles
            case 'pending': 
                $total_users -> where("status",'review_pending');
                break;
            //Rejected Profiles
            case 'rejected': 
                $total_users -> where("status",'rejected');
                break;
            //Active Profiles
            case 'active': 
                //Nothing to do
                break;
                
        }

        $total_users -> where("is_deleted",0);
        $total_users -> whereIn("role",['customer','business']);
        return $total_users->count();
    }

    public function getCustomers($id = NULL)
    {       
        $customers =  User::with('countries')
                        ->with('states')
                        ->with('cities')
                        ->where("role",'customer')
                        ->where("is_deleted",'0');
                     
        if(isset($id)) {
            $customers -> where("id",$id);
            return $customers->first();
        }
        $data = $customers->get(); 
        return $customers->get();
    }

    public function getLatestUsers($user_type = 'customer')
    {   
        if($user_type == NULL || $user_type == '') 
            $user_type = 'customer';

        $customers =  DB::table("users")
                        ->where("role",$user_type)
                        ->where("is_deleted",0)
                        ->orderBy('id', 'desc')
                        ->limit(10);
                     
        return $customers->get();
    }

    public function getProfessional($id = NULL)
    {
        $customers =  User::with('countries')
                        ->with('states')
                        ->with('cities')
                        ->with(['ProfessionalDetail'])
                        ->where("role",'business')
                        ->where("is_deleted",0);
                     
        if(isset($id)) {
            $customers -> where("id",$id);
            return $customers->first();
        }

        return $customers->get();
    }

    public function getAdminUser()
    {   
        $customers =  DB::table("users")
                        ->where("role",'admin')
                        ->where("is_deleted",0)
                        ->limit(1);
                     
        return $customers->first();
    }

    public function captchaCheck($response)
    {
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $secret   = env('RE_CAP_SECRET');

        $recaptcha = new ReCaptcha($secret);
        $resp = $recaptcha->verify($response, $remoteip);
        if ($resp->isSuccess()) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getFilter($selected_label = NULL, $selected_location = NULL, $selected_zipcode = NULL)
    {
        // $user_id = "";
        // if(Auth::User()){
        //     $user_id = Auth::User()->id;
        // }

        // $query = User::select('users.*', 'users.id AS professional_id', 
        //                 DB::raw('group_concat(distinct(CONCAT(UCASE(LEFT(sports.sport_name, 1)), SUBSTRING(sports.sport_name, 2)))) as user_sports'))
        //              ->join("user_professional_details as professionaldetail", DB::raw('professionaldetail.user_id'), '=', 'users.id')
        //              ->leftjoin("user_services as service", DB::raw('service.user_id'), '=', 'users.id')
        //              ->leftjoin("sports as sports", DB::raw('service.sport'), '=', 'sports.id')
        //              ->with('states')
        //              //->where("users.is_deleted",0);
        //              //->where('role', 'business')
        //              ->where('activated', 1)
        //              ->where('status', 'approved');
        //               if(isset($selected_zipcode) && $selected_zipcode != NULL) {
                          
        //     $query->where('zipcode', $selected_zipcode);
        // }
                     //->where('users.id', '!=', $user_id);
                  
        $query = CompanyInformation::with('employmenthistory',
'education',
'users',
'certification',
'service',
'skill',
'ProfessionalDetail');

if(isset($selected_zipcode) && $selected_zipcode != NULL) {
    $query->where('zip_code',$selected_zipcode);
}

if(isset($selected_label) && $selected_label != NULL) {
    $sport_id = Sports::where('sport_name',$selected_label)->first();
    if(!empty($sport_id)){
        $query->whereHas('service', function ($query2 )  use ($sport_id) {
            $query2->where('sport',$sport_id->id);
        });
    }
}

if(isset($selected_location) && $selected_location != NULL) {
    $query->where('city',$selected_location);
}
               
             
      // dd($query->get()->toArray());die;
       
       
        // if($selected_label != NULL) {
        //     $label_array = explode(" ",$selected_label);
        //     $condition = array();
        //     $sportscondition = array();
        //     foreach($label_array as $label) {
        //         $label = trim($label);
        //         $condition[] = "(lower(users.firstname) like '%".strtolower($label)."%' ) ";
        //         $condition[] = "(lower(users.lastname) like '%".strtolower($label)."%' ) ";
        //         $condition[] = "(lower(users.email) like '%".strtolower($label)."%' ) ";
        //         $condition[] = "(lower(users.company_name) like '%".strtolower($label)."%' ) ";

        //         $sportscondition[] = "(lower(REPLACE(sports.sport_name, ' ', '')) like '%".strtolower($label)."%' )";
        //     }

        //     //match label for sports name and its sub sports
        //     $sportscondition_string = " ( ".implode(" OR ", $sportscondition). " ) ";
        //     $matchingSports = Sports::select('sports.id', 'subsports.id as subsportid')
        //                     ->leftjoin("sports as subsports", DB::raw('subsports.parent_sport_id'), '=', 'sports.id')
        //                     ->whereRaw($sportscondition_string)->get()->toArray();
                            
                         

        //     if(count($matchingSports) > 0) {
        //         $matchingSportsId = array();
        //         foreach($matchingSports as $matchingSport) {
        //             if($matchingSport['id'] > 0)
        //                 $matchingSportsId[] = $matchingSport['id'];
        //             if($matchingSport['subsportid'] > 0)
        //             $matchingSportsId[] = $matchingSport['subsportid'];
        //         }
        //         $matchingSportsId = array_unique($matchingSportsId);

        //         // apply filter of sports id in main query
        //         $condition[] = "(service.sport IN (".implode(",", $matchingSportsId).")) ";
        //     }
               

        //     $condition_string = " ( ".implode(" OR ", $condition). " ) ";
        //     $query->whereRaw($condition_string);
        // }
    

        // if(isset($selected_location) && $selected_location != NULL) {
        //     $location = explode(",", $selected_location);
        //     $city = trim($location[0]);
        //   // $state = trim($location[1]);
        //     $query->join('addr_cities as city', function($join) use ($city)
        //             {
        //                 $join->on('city.id', '=', 'users.city')
        //                      ->where(DB::raw('lower(city.city_name)'), '=', strtolower($city));
        //             });
        // }

       

        // $query->groupBy('users.id');

        //print_r($query->toSql());
        //die;
        $return = $query->get()->toArray();
        
        
       
        // foreach($return as $key=>$value){
        //     $use = DB::table('user_professional_details')
        //       ->where('user_id',$value['id'])
        //       ->first();
        
        //     if(!empty($use)) {
        //         $company_id = $use->company_id;
        //     }else{
        //         $company_id = 0;
        //     }
            
            
        //     $return[$key]['company_id'] = $company_id;
        // }
      //  dd($return);die;
         
         
        return $return;
    }

    public function getTopFilter($selected_label)
    {
        $query = User::select('users.*', 'users.id AS professional_id', 
                        DB::raw('group_concat(distinct(CONCAT(UCASE(LEFT(sports.sport_name, 1)), SUBSTRING(sports.sport_name, 2)))) as user_sports'))
                     ->join("user_professional_details as professionaldetail", DB::raw('professionaldetail.user_id'), '=', 'users.id')
                     ->leftjoin("user_services as service", DB::raw('service.user_id'), '=', 'users.id')
                     ->leftjoin('addr_cities as city','city.id', '=', 'users.city')
                     ->leftjoin('addr_states as state','city.state_id', '=', 'state.id')
                     ->leftjoin('addr_countries as country','country.country_code', '=', 'state.country_code')
                     ->leftjoin("sports as sports", DB::raw('service.sport'), '=', 'sports.id')
                     ->with('states')
                     ->where("users.is_deleted",0)
                     ->where('role', 'business')
                     ->where('activated', 1)
                     ->where('status', 'approved');

       
        if($selected_label != NULL) {
            $label_array = explode(" ",$selected_label);
            $condition = array();
            $sportscondition = array();
            foreach($label_array as $label) {
                $label = trim($label);
                $condition[] = "(lower(users.firstname) like '%".strtolower($label)."%' ) ";
                $condition[] = "(lower(users.lastname) like '%".strtolower($label)."%' ) ";
                $condition[] = "(lower(users.email) like '%".strtolower($label)."%' ) ";
                $condition[] = "(lower(users.company_name) like '%".strtolower($label)."%' ) ";
                $condition[] = "(users.zipcode = '".$label."' ) ";

                //start for location search
                $condition[] = "(lower(state.state_name) like '%".strtolower($label)."%' ) ";
                $condition[] = "(lower(country.country_name) like '%".strtolower($label)."%' ) ";
                $condition[] = "(lower(city.city_name) like '%".strtolower($label)."%' ) ";
                //end for location search

                $sportscondition[] = "(lower(REPLACE(sports.sport_name, ' ', '')) like '%".strtolower($label)."%' )";
            }

            //match label for sports name and its sub sports
            $sportscondition_string = " ( ".implode(" OR ", $sportscondition). " ) ";
            $matchingSports = Sports::select('sports.id', 'subsports.id as subsportid')
                            ->leftjoin("sports as subsports", DB::raw('subsports.parent_sport_id'), '=', 'sports.id')
                            ->whereRaw($sportscondition_string)->get()->toArray();

            if(count($matchingSports) > 0) {
                $matchingSportsId = array();
                foreach($matchingSports as $matchingSport) {
                    if($matchingSport['id'] > 0)
                        $matchingSportsId[] = $matchingSport['id'];
                    if($matchingSport['subsportid'] > 0)
                    $matchingSportsId[] = $matchingSport['subsportid'];
                }
                $matchingSportsId = array_unique($matchingSportsId);

                // apply filter of sports id in main query
                $condition[] = "(service.sport IN (".implode(",", $matchingSportsId).")) ";
            }

            $condition_string = " ( ".implode(" OR ", $condition). " ) ";
            $query->whereRaw($condition_string);
        }
        $query = 
        $query->groupBy('users.id');
        // print_r($query->toSql());
        $return = $query->get()->toArray();
        return $return;
    }
    
    public function updatelatlong()
    {
        $users = User::select('*')->get()->toArray();
        if(count($users) > 0) {
            foreach($users as $user) {
                if(!empty($user['zipcode']) && $user['zipcode']>0) {
                    $latlongdata = Miscellaneous::getLatLong($user['zipcode']);

                    $userObj = User::find($user['id']);
                    $userObj->latitude = $latlongdata['lat'];
                    $userObj->longitude= $latlongdata['long'];
                    $userObj->save();
                }                
            }
        }
    }

    public function getAboutMe($id = null)
    {
        $query = UserProfessionalDetail::select('about_me')->where('user_id', $id)->first();
        if(!empty($query))
            return $query->about_me;
        else return '';
   }

   // for resize images
   public function thumbResize($dir, $thumbsDir){
      return $this->resizeImages($dir, $thumbsDir);
    }

    function resizeImages($dir, $thumbsDir){
        if (is_dir($dir)) {
            $objects = preg_grep('~\.(jpeg|jpg|png|PNG|GIF|gif)$~', scandir($dir));

            if(!is_dir($thumbsDir)){
               mkdir($thumbsDir , 0775);
            } else {
                rename($thumbsDir, $thumbsDir.date('Ymdhi').'bkp');
                mkdir($thumbsDir , 0775);
            }

            foreach ($objects as $key => $images) {
                $file = $dir.DIRECTORY_SEPARATOR.$images;
                Image::make($file)->resize(150, 150)->save($thumbsDir.DIRECTORY_SEPARATOR.$images);
            }
            return true;
        }
    }
	
}