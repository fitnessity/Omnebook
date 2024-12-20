<?php
namespace App\Http\Controllers;
use Redirect;
use App\User;
use App\UserEmploymentHistory;
use App\BusinessInformation;
use App\UserEducation;
use App\UserCertification;
use App\UserService;
use App\UserSecurityQuestion;
use App\UserMembership;
use App\UserProfessionalDetail;
use App\UserSkillAward;
use App\UserFamilyDetail;
use App\UserCustomerDetail;
use App\AddrStates;
use App\AddrCities;
use App\Event;
use App\Repositories\PlanRepository;
use App\Repositories\ProfessionalRepository;
use Validator;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Input;
use Response;
use Auth;
use Hash;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Miscellaneous;
use Image;
use File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator; 
use DB;
use App\Fit_background_check_faq;
use App\Fit_vetted_business_faq;
use App\MailService;
use App\Evident;
use App\Evidents;
use App\Sports;
use App\InstantForms;
use App\CompanyInformation;
use Session;
use App\Repositories\SportsRepository;
use View;
use App\BusinessClaim;
use Mail;
use App\Mail\BusinessVerifyMail;
use Twilio\Rest\Client;
use App\Services\TwilioService;
use Twilio\TwiML\VoiceResponse;
use App\Languages;
use App\UserFavourite;
use App\UserFollow;
use App\UserFollower;
use App\Review;
use App\BusinessCompanyDetail;
use App\BusinessExperience;
use App\BusinessService;
use App\BusinessTerms;

class ProfileController extends Controller
{
    protected $users;
    protected $planRepository;
    protected $professionals;
    protected $sports;
    public function __construct(UserRepository $users, PlanRepository $planRepository, ProfessionalRepository $professionals, SportsRepository $sports)
    {
        $this->middleware('auth', ['except' => ['getBladeDetail1','SendVerificationlinkCall','SendVerificationlinkMsg','makeCall','generateVoiceMessage','sendCustomMessage','getBladeDetail','newFUn','getBusinessClaim','getStateList', 'getCityList','familyProfileUpdate','submitFamilyForm','submitFamilyFormWithSkip','check','deleteCompany','submitFamilyForm1','skipFamilyForm1','getBusinessClaimDetaill','businessClaim','getLocationBusinessClaimDetaill','VerifySendVerificationlink','searchResultLocation','searchResultLocation1']]);
        $this->planRepository = $planRepository;
        $this->users = $users;
        $this->professionals = $professionals;
        $this->sports = $sports;
        $this->arr = [];
        if(Auth::check()){ }
    }
    public function manojTest(Request $request) { die('createNewBusinessProfile'); }
    public function createNewBusinessProfile(Request $request)
    {
      if(! Gate::allows('profile_view_access')) 
      {
        $request->session()->flash('alert-danger', 'Access Restricted'); return redirect('/');
      }
      $loggedinUser = Auth::user();
      $UserProfileDetail = $this->users->getUserProfileDetail($loggedinUser['id'],array('professional_detail','history','education','certification','service'));
      if(isset($UserProfileDetail['ProfessionalDetail']) && @count($UserProfileDetail['ProfessionalDetail']) > 0)
      {
        $UserProfileDetail['ProfessionalDetail'] = UserProfessionalDetail::getFormedProfile($UserProfileDetail['ProfessionalDetail']);
      }
      $sports_names = $this->sports->getAllSportsNames();
      $approve = Evidents::where('user_id',$loggedinUser['id'])->get();
      $serviceType = Miscellaneous::businessType();
      $programType = Miscellaneous::programType();
      $programFor = Miscellaneous::programFor();
      $numberOfPeople = Miscellaneous::numberOfPeople();
      $ageRange = Miscellaneous::ageRange();
      $expLevel = Miscellaneous::expLevel();
      $serviceLocation = Miscellaneous::serviceLocation();
      $pFocuses = Miscellaneous::pFocuses();
      $duration = Miscellaneous::duration();
      $servicePriceOption = Miscellaneous::servicePriceOption();
      $specialDeals = Miscellaneous::specialDeals();
      if($loggedinUser['role']=='business' || $loggedinUser['role']=='professional' || $loggedinUser['role']=='admin')
      { $view='profiles.viewProfile'; }
      elseif($loggedinUser['role']=='customer')
      { $view='profiles.viewProfileCustomer'; }
      $family = UserFamilyDetail::where('user_id',Auth::user()->id)->get();
      $business_details = BusinessInformation::where('user_id',Auth::user()->id)->get();
      $user = User::where('id',Auth::user()->id)->first();
      $city = AddrCities::where('id',$user->city)->first();
      if(empty($city)){  $UserProfileDetail['city'] = $user->city; }
      else{ $UserProfileDetail['city'] = $city->city_name; }
      $state = AddrStates::where('id',$user->state)->first();
      if(empty($state))
      { $UserProfileDetail['state'] = $user->state;;}
      else
      { $UserProfileDetail['state'] = $state->state_name;  }
      $UserProfileDetail['country'] = $user->country;
      $firstCompany = CompanyInformation::where('user_id',Auth::user()->id)->first();
      $companies = CompanyInformation::where('user_id',Auth::user()->id)->get();
	$view='profiles.createNewBusinessProfile';
      return view($view, [
            'UserProfileDetail' => $UserProfileDetail,
            'firstCompany' => $firstCompany,
            'countries' => $this->users->getCountriesList(),
            'states' => $this->users->getStateList($UserProfileDetail['country']),
            'cities' => $this->users->getCityList($UserProfileDetail['state']),
            'phonecode' => Miscellaneous::getPhoneCode(),
            'sports_names' => $sports_names,
            'serviceType' => $serviceType,
            'programType' => $programType,
            'programFor' => $programFor,
            'numberOfPeople' => $numberOfPeople,
            'ageRange' => $ageRange,
            'expLevel' => $expLevel,
            'serviceLocation' => $serviceLocation,
            'pFocuses' => $pFocuses,
            'duration'=> $duration,
            'specialDeals' => $specialDeals,
            'servicePriceOption' => $servicePriceOption,
            'pageTitle' => "PROFILE",
            'approve'=>$approve,
            'family'=>$family,
            'business_details'=>$business_details,
            'companies'=>$companies,
        ]);
    }

    public function addbstep(Request $request)
    {
        User::where('id', Auth::user()->id)->update(['bstep' => 1]);
        return view('profiles.createNewBusinessProfile');
    }
    public function addbusinesscompanydetail(Request $request)
    {
      $this->validate($request, [
        'Companyname' => 'required',
        'Address' => 'required',
        'City' => 'required',
        'State' => 'required',
        'ZipCode' => 'required',
        'Country' => 'required',
        'Establishmentyear' => 'required',
        'Businessusername' => 'required',
        'Firstnameb' => 'required',
        'Lastnameb' => 'required',
        'Emailb' => 'required',
        'Phonenumber' => 'required',
        'Aboutcompany' => 'required',
        'Shortdescription' => 'required',
        'userid' => 'required',
      ]);
      BusinessCompanyDetail::create($request->all());
      User::where('id', Auth::user()->id)->update(['bstep' => 2]);
      return view('profiles.createNewBusinessProfile');
    }
    public function addbusinessexperience(Request $request)
    {
      BusinessExperience::create($request->all());
      User::where('id', Auth::user()->id)->update(['bstep' => 3]);
      return view('profiles.createNewBusinessProfile');
    }
    public function addbusiness_service(Request $request)
    {
      $input =array();
      foreach ($request->languages as $key => $row1) 
      {$input[] = $row1; }
      $languages = implode(",",$input);
      $input1 =array();
      foreach ($request->serBusinessoff1 as $key => $row2) 
      { $input1[] = $row2; }
      $serBusinessoff1 = implode(",",$input1);
      $data = [
        [
          'userid'=>$request->userid, 
          'languages'=>$languages, 
          'medical_states'=>$request->medical_states,
          'fitness_goals'=>$request->fitness_goals,
          'hours_opt'=>$request->hours_opt,
          'serTimeZone'=>$request->serTimeZone,
          'special_days_off'=> $request->special_days_off,
          'serBusinessoff1'=> $serBusinessoff1
        ]
      ];
      BusinessService::insert($data); 
      return view('profiles.createNewBusinessProfile');
    }
    public function addbusinessterms(Request $request)
    {
      BusinessTerms::create($request->all());
      return view('profiles.createNewBusinessProfile');
    }
    public function addFamily(Request $request)
	{ 
		if (! Gate::allows('profile_view_access')) {
            $request->session()->flash('alert-danger', 'Access Restricted');
            return redirect('/');
        }
        $loggedinUser = Auth::user();
        $UserProfileDetail = $this->users->getUserProfileDetail($loggedinUser['id'],array('professional_detail','history','education','certification','service'));
        if(isset($UserProfileDetail['ProfessionalDetail']) && @count($UserProfileDetail['ProfessionalDetail']) > 0){
            $UserProfileDetail['ProfessionalDetail'] = UserProfessionalDetail::getFormedProfile($UserProfileDetail['ProfessionalDetail']);
        }
       $UserFamilyDetails = UserFamilyDetail::where('user_id',$loggedinUser['id'])->get();
        $sports_names = $this->sports->getAllSportsNames();
        $approve = Evidents::where('user_id',$loggedinUser['id'])->get();
        $serviceType = Miscellaneous::businessType();
        $programType = Miscellaneous::programType();
        $programFor = Miscellaneous::programFor();
        $numberOfPeople = Miscellaneous::numberOfPeople();
        $ageRange = Miscellaneous::ageRange();
        $expLevel = Miscellaneous::expLevel();
        $serviceLocation = Miscellaneous::serviceLocation();
        $pFocuses = Miscellaneous::pFocuses();
        $duration = Miscellaneous::duration();
        $servicePriceOption = Miscellaneous::servicePriceOption();
        $specialDeals = Miscellaneous::specialDeals();
        if($loggedinUser['role']=='business' || $loggedinUser['role']=='professional' || $loggedinUser['role']=='admin'){
            $view='profiles.viewProfile';
        }
        elseif($loggedinUser['role']=='customer'){
            $view='profiles.viewProfileCustomer';
        }
        $family = UserFamilyDetail::where('user_id',Auth::user()->id)->get();
        $business_details = BusinessInformation::where('user_id',Auth::user()->id)->get();
        $user = User::where('id',Auth::user()->id)->first();
       $city = AddrCities::where('id',$user->city)->first();
       if(empty($city)){  $UserProfileDetail['city'] = $user->city; }
       else{ $UserProfileDetail['city'] = $city->city_name; }
       $state = AddrStates::where('id',$user->state)->first();
       if(empty($state)){ $UserProfileDetail['state'] = $user->state; }
       else{ $UserProfileDetail['state'] = $state->state_name; }
       $UserProfileDetail['country'] = $user->country;
       $firstCompany = CompanyInformation::where('user_id',Auth::user()->id)->first();
       $companies = CompanyInformation::where('user_id',Auth::user()->id)->get();
        $view='personal-profile.add-family';
        return view($view, [
            'UserProfileDetail' => $UserProfileDetail,
            'firstCompany' => $firstCompany,
            'countries' => $this->users->getCountriesList(),
            'states' => $this->users->getStateList($UserProfileDetail['country']),
            'cities' => $this->users->getCityList($UserProfileDetail['state']),
            'phonecode' => Miscellaneous::getPhoneCode(),
            'sports_names' => $sports_names,
            'serviceType' => $serviceType,
            'programType' => $programType,
            'programFor' => $programFor,
            'numberOfPeople' => $numberOfPeople,
            'ageRange' => $ageRange,
            'expLevel' => $expLevel,
            'serviceLocation' => $serviceLocation,
            'pFocuses' => $pFocuses,
            'duration'=> $duration,
            'specialDeals' => $specialDeals,
            'servicePriceOption' => $servicePriceOption,
            'pageTitle' => "PROFILE",
            'approve'=>$approve,
            'family'=>$family,
            'business_details'=>$business_details,
            'companies'=>$companies,
			'UserFamilyDetails'=>$UserFamilyDetails,
        ]);
	}
    public function makeCall(Request $request, TwilioService $twilioService)
    {
        $sid = getenv("TWILIO_SID");
		$token = getenv("TWILIO_AUTH_TOKEN");
    	$twilio_number = getenv("TWILIO_NUMBER");
		$twilio = new Client($sid, $token);
		$call = $twilio->calls
              ->create("+918854862050", 
                        $twilio_number,
                        [
                            "twiml" => "<Response><Say voice='woman' language='en-IN'>Your one time password is 123456</Say></Response>"
                        ]
              );
    }
    public function generateVoiceMessage(Request $request, $otpCode, TwilioService $twilioService)
    {
        $twimlResponse = $twilioService->generateTwimlForVoiceCall($otpCode);
    }
	
    public function deleteImageCompany(Request $request)
    {
        $company = CompanyInformation::where('id',$request->company_id)->first();
        $image = json_decode($company->company_images);
       array_splice($image, $request->myindex,1);
        $company->company_images = count($image) == 0 ? null :json_encode($image);
        $company->save();
        return 200;
    }
    public function deleteImageCompany1(Request $request)
    {
        $company = User::where('id',Auth::user()->id)->first();
        $image = json_decode($company->company_images);
       array_splice($image, $request->myindex,1);
        $company->company_images = count($image) == 0 ? null :json_encode($image);
        $company->save();
        return 200;
    }
    public function getBladeDetail($company_id, Request $request)
    {
        $company = CompanyInformation::with('employmenthistory','education','users','certification','service','skill','ProfessionalDetail')->where('id',$company_id)->first();
        $company['company_images'] = $company['company_images'] == null ? [] : json_decode($company['company_images']);
        $max_price = UserService::where('company_id',$company['id'])->max('price');
        $min_price = UserService::where('company_id',$company['id'])->min('price');
        $user_professional_detail = UserProfessionalDetail::where('company_id',$company_id)->first();
        $user_professional_detail->availability = $user_professional_detail->availability != null ? json_decode(json_decode($user_professional_detail->availability)) : null;
        $services = UserService::where('company_id',$company['id'])->get();
               foreach($services as $key2=>$value2){
                   $sport =Sports::where('id',$value2['sport'])->first();
                   $value2['amenties'] = $sport['sport_name'];
               }
        return view('home.individual-page',compact('company','user_professional_detail','services','max_price','min_price'));
    }
    public function getBladeDetail1($company_id, Request $request)
    {
        $company = CompanyInformation::with('employmenthistory','education','users','certification','service','skill','ProfessionalDetail')->where('id',$company_id)->first();
        $company['company_images'] = $company['company_images'] == null ? [] : json_decode($company['company_images']);
        $max_price = UserService::where('company_id',$company['id'])->max('price');
        $min_price = UserService::where('company_id',$company['id'])->min('price');
        $user_professional_detail = UserProfessionalDetail::where('company_id',$company_id)->first();
        $user_professional_detail->availability = $user_professional_detail->availability != null ? json_decode(json_decode($user_professional_detail->availability)) : null;
        $services = UserService::where('company_id',$company['id'])->get();
               foreach($services as $key2=>$value2){
                   $sport =Sports::where('id',$value2['sport'])->first();
                   $value2['amenties'] = $sport['sport_name'];
               }
        return view('home.individual-page-new',compact('company','user_professional_detail','services','max_price','min_price'));
    }
    public function newFUn(Request $request)
    {
         return redirect('/search-result-location?location='.$request->location.'&page=1&page_size=10');
    }
    public function searchResultLocation(Request $request)
    {
       	$company_ids = [];
       	$myloc = $request->location;
       	$language = $request->language;
       	$select_language = $request->language;
		$select_label = $request->label;
		$select_zipcode = $request->zipcode;
		$company=array();
			if($myloc != null && $myloc != 'undefined')
			{
				if($select_zipcode != null && $select_zipcode != 'undefined')
				{
					$company = CompanyInformation::where('company_name','LIKE',$select_label.'%')->where('city','LIKE',$myloc.'%')->where('zip_code','LIKE',$select_zipcode.'%')->get(); 
				}
				else
				{
					$company = CompanyInformation::where('city','LIKE',$myloc.'%')->get(); 
				}
			}
			else
			{
				$company = CompanyInformation::where('company_name','LIKE',$select_label.'%')->get(); 
			}
        $sports = $this->sports->getAlphabetsWiseSportsNames();
      	$sports_names = $this->sports->getAllSportsNames();
      	$sports_child_parent = $this->sports->getSportsChildParentWise();
      	$userSpotPrice = $userSport = array();
		$sports_select = '';
      	if($sports){
        	$sports_select .= "<option value=''>Choose Activity</option>";
        	foreach ($sports as $key => $value) {
            	foreach ($value as $key1 => $value1) {
                	if(count($value1->child)){
                    	$sports_select .= "<optgroup label='".$value1->title."'>";
                    	foreach ($value1->child as $key2 => $value2) {
                      	 	$selected = $request->selected_sport && $request->selected_sport == $key2 ? "selected" :"";
                        	$sports_select .= "<option value='".$key2."' ".$selected." >".$value2."</option>";
                    	}
                    	$sports_select .= "</optgroup>";
                	} 
					else {
                    	$selected = $request->selected_sport && $request->selected_sport == $value1->value ? "selected" :"";
                    	$sports_select .= "<option  value='".$value1->value."' ".$selected.">".$value1->title."</option>";
                	}
            	}
        	}
    	}
   		$businessType = Miscellaneous::businessType();
      	$programType = Miscellaneous::programType();
      	$programFor = Miscellaneous::programFor();
      	$numberOfPeople = Miscellaneous::numberOfPeople();
      	$ageRange = Miscellaneous::ageRange();
      	$expLevel = Miscellaneous::expLevel();
      	$serviceLocation = Miscellaneous::serviceLocation();
      	$pFocuses = Miscellaneous::pFocuses();
      	$duration = Miscellaneous::duration();
      	$servicePriceOption = Miscellaneous::servicePriceOption();
      	$specialDeals = Miscellaneous::specialDeals();
      	$activity = Miscellaneous::activity();
      	$teaching = Miscellaneous::teaching();
      	$alllanguages = Miscellaneous::getLanguages();
      	$timeSlots = Miscellaneous::getTimeSlot();
       	$locations = array();
       	foreach($company as $key=>$value){
       		$value['company_images'] = $value['company_images'] == null ? [] : json_decode($value['company_images']); 
            $max_price = UserService::where('company_id',$value['id'])->max('price');
            $min_price = UserService::where('company_id',$value['id'])->min('price');
            $str = '';
            $services = UserService::where('company_id',$value['id'])->get();
           	foreach($services as $key2=>$value2){
            	$sport =Sports::where('id',$value2['sport'])->first();
                $str = $str.$sport['sport_name'];
                if(($key2+1) != count($services)){
                	$str = $str.', ';
            	}
         	}
           	$user_logo = User::where('id',$value['user_id'])->first();
            $user_logo1 = $user_logo['profile_pic'];
            $value['business_name'] = $value['company_name'];
            $value['activity'] = "";
            $value['website'] = "";
            $value['location'] = $value['city'];
            $value['address'] = $value['address'];
            $value['phone'] = $value['contact_number'];
            $value['type'] = "claimed";
            $value['type'] = "claimed";
            $value['max_price'] = $max_price;
            $value['min_price'] = $min_price;
           	$value['service_name'] = $str;
            $value['user_logo'] = $user_logo1;
     	}
        $search_data2 = $company;
        $result = $company->toArray();
        $page = $request->page ? $request->page :1;  
    	$perPage = $request->page_size ? $request->page_size :10; 
    	$offset = ($page * $perPage) - $perPage;
        $request_location = $request->location;
        $select_activity_location = $request->activity_location;
        $select_personality = $request->personality_habit;
        $select_experience = $request->activity_exp;
        $select_age = $request->age_range;
        $select_activity_for = $request->activity_for;
        $select_activity_type = $request->activity_type;
        $select_professional_type = $request->professional_type;
    		$resultnew =  new LengthAwarePaginator(
    			array_slice($result, $offset, $perPage, true),  
    			count($result), 
    			$perPage, 
    			$page, 
    			['path' => $request->url(), 'query' => $request->query()]  
    		);
    		foreach($resultnew as $value){
    		    if($value['type'] == 'claimed'){
    		        $found = 0;
    		        foreach($locations as $key2=>$value2){
    		            if(($value2[1] == $value['latitude']) && ($value2[2] == $value['longitude']) ){
    		                $found = $found + 1;
    		            }
    		        }
    		        if($found != 0){
    		          $lat = $value['latitude'] + ((floatVal('0.'.rand(1, 9)) *$found) / 10000);
    		            $long = $value['longitude'] + ((floatVal('0.'.rand(1, 9)) *$found) / 10000);
    		            $a = [$value['company_name'],$lat,$long,$value['id'],$value['logo']];
                    }
    		        else{
    		          $a = [$value['company_name'],$value['latitude'],$value['longitude'],$value['id'],$value['logo']];
                    }
    		        array_push($locations,$a);
    		    }
    		}    	  
        $return = Sports::select(DB::raw('sports.*'),DB::raw('sports_categories.category_name'),DB::raw('IF((select count(*) from sports as sports1 where sports1.is_deleted = "0" AND sports1.parent_sport_id = sports.id ) > 0,1,0) as has_child'))->leftjoin("sports_categories", DB::raw('sports.category_id'), '=', 'sports_categories.id');
        $return->where('sports.is_deleted','0');
        $return->where('sports.parent_sport_id',NULL);
        $return->groupBy('sports.id');
        $return->orderBy('sports.sport_name');
        $sports_list  = $return->get();
        $teaching = Miscellaneous::teaching();
        $gender = Miscellaneous::gender();
        $participateActivity = Miscellaneous::participateActivity();
        $dayactivity = Miscellaneous::dayactivity();
        $trainingLocation = Miscellaneous::trainingLocation();
        $StartActivity = Miscellaneous::StartActivity();
        $travelUpto = Miscellaneous::travelUpto();
        $language = Languages::get();
        $activeLevel = Miscellaneous::activeLevel();
        $expProfessional = Miscellaneous::expProfessional();
        $expActivity = Miscellaneous::expActivity();
        $expLevel = Miscellaneous::expLevel();
        $getTimeSlot = Miscellaneous::getTimeSlot();
           return view('home.searchLocationResult',compact('resultnew','businessType','select_professional_type','select_professional_type','sports_select','sports','request_location','activity','select_activity_for','select_activity_type','programType','ageRange','select_age','alllanguages','select_language','pFocuses','select_experience','select_personality','serviceLocation','sports_list','select_activity_location','locations','language','travelUpto','StartActivity','trainingLocation','dayactivity','participateActivity','gender','teaching','activeLevel','expProfessional','expActivity','expLevel','getTimeSlot'));
    }
    public function searchResultLocation1(Request $request)
    {
        $company_ids = [];
        $myloc = $request->location;
        $language = $request->language;
        $select_language = $request->language;
		$select_label = $request->label;
		$select_zipcode = $request->zipcode;
       if($request->selected_sport != null && $request->selected_sport != 'undefined')
        {
            $my_service_data = UserService::where('company_id','!=',null)->where('sport',$request->selected_sport)->get();
            foreach($my_service_data as $value2){
                array_push($company_ids,$value2['company_id']);
            }
            $company = CompanyInformation::whereIn('id',$company_ids)->where('city','LIKE',$myloc.'%')->get();
        }
        if($request->age_range != null && $request->age_range != 'undefined')
        {
            foreach($request->age_range as $data){
                $str = ':"'.$data;
                $my_service_data = UserService::where('company_id','!=',null)->where('agerange','LIKE','%'.$str.'%')->get();
                    foreach($my_service_data as $value2){
                        array_push($company_ids,$value2['company_id']);
                    }
            }
            $company = CompanyInformation::whereIn('id',$company_ids)->where('city','LIKE',$myloc.'%')->get();
        } 
        if($request->activity_for != null && $request->activity_for != 'undefined')
        {
            foreach($request->activity_for as $data){
                $str = ':"'.$data;
                $my_service_data = UserService::where('company_id','!=',null)->where('activitydesignsfor','LIKE','%'.$str.'%')->get();
                    foreach($my_service_data as $value2){
                        array_push($company_ids,$value2['company_id']);
                    }
            }
            $company = CompanyInformation::whereIn('id',$company_ids)->where('city','LIKE',$myloc.'%')->get();
        }
        if($request->activity_type != null && $request->activity_type != 'undefined')
        {
            foreach($request->activity_type as $data){
                $str = ':"'.$data;
                $my_service_data = UserService::where('company_id','!=',null)->where('activitytype','LIKE','%'.$str.'%')->get();
                    foreach($my_service_data as $value2){
                        array_push($company_ids,$value2['company_id']);
                    }
            }
            $company = CompanyInformation::whereIn('id',$company_ids)->where('city','LIKE',$myloc.'%')->get();
        }
        if($request->language != null && $request->language != 'undefined')

        {

            foreach($request->language as $data){

                $str = ':"'.$data;

            

                $my_service_data = UserProfessionalDetail::where('company_id','!=',null)->where('languages','LIKE','%'.$str.'%')->get();

                    foreach($my_service_data as $value2){

                        array_push($company_ids,$value2['company_id']);

                    }

            }

           $company = CompanyInformation::whereIn('id',$company_ids)->where('city','LIKE',$myloc.'%')->get();

         }

         

        if($request->professional_type != null && $request->professional_type != 'undefined')

        {

            foreach($request->professional_type as $data){

                $str = ':"'.$data;

                $my_service_data = UserService::where('company_id','!=',null)->where('servicetype','LIKE','%'.$str.'%')->get();

                    foreach($my_service_data as $value2){

                        array_push($company_ids,$value2['company_id']);

                    }

            }

           $company = CompanyInformation::whereIn('id',$company_ids)->where('city','LIKE',$myloc.'%')->get();

         }

        

        if($request->activity_location != null && $request->activity_location != 'undefined')

        {

            foreach($request->activity_location as $data){

                 $str = ':"'.$data;

                $my_service_data = UserProfessionalDetail::where('company_id','!=',null)->where('work_locations','LIKE','%'.$str.'%')->get();

                    foreach($my_service_data as $value2){

                        array_push($company_ids,$value2['company_id']);

                    }

            }

            

            $company = CompanyInformation::whereIn('id',$company_ids)->where('city','LIKE',$myloc.'%')->get();

        }

        

        if($request->personality_habit != null && $request->personality_habit != 'undefined')

        {

            foreach($request->personality_habit as $data){

                $str = ':"'.$data;

                $my_service_data = UserProfessionalDetail::where('company_id','!=',null)->where('personality','LIKE','%'.$str.'%')->get();

                    foreach($my_service_data as $value2){

                        array_push($company_ids,$value2['company_id']);

                    }

            }

            $company = CompanyInformation::whereIn('id',$company_ids)->where('city','LIKE',$myloc.'%')->get();

        }

        

        if($request->activity_exp != null && $request->activity_exp != 'undefined')

        {

            foreach($request->activity_exp as $data){

                $str = ':"'.$data;

                $my_service_data = UserProfessionalDetail::where('company_id','!=',null)->where('experience_level','LIKE','%'.$str.'%')->get();

                    foreach($my_service_data as $value2){

                        array_push($company_ids,$value2['company_id']);

                    }

            }

            $company = CompanyInformation::whereIn('id',$company_ids)->where('city','LIKE',$myloc.'%')->get();

        }

        

        

      

        $data = BusinessClaim::where('location','LIKE',$myloc.'%')->where('is_verified',0)->get();

                   

                    

        if(!($request->selected_sport != null && $request->selected_sport != 'undefined') && 

        !($request->language != null && $request->language != 'undefined')&& 

        !($request->activity_location != null && $request->activity_location != 'undefined')&&

        !($request->age_range != null && $request->age_range != 'undefined') && 

        !($request->activity_for != null && $request->activity_for != 'undefined')&& 

        !($request->activity_type != null && $request->activity_type != 'undefined')&&

        !($request->personality_habit != null && $request->personality_habit != 'undefined') && 

        !($request->professional_type != null && $request->professional_type != 'undefined') && 

        !($request->activity_exp != null && $request->activity_exp != 'undefined')

        

        )

         $company = CompanyInformation::where('city','LIKE',$myloc.'%')->get();

       $locations = array();

           foreach($company as $key=>$value){

               $value['company_images'] = $value['company_images'] == null ? [] : json_decode($value['company_images']); 

               $max_price = UserService::where('company_id',$value['id'])->max('price');

               $min_price = UserService::where('company_id',$value['id'])->min('price');

               $str = '';

               $services = UserService::where('company_id',$value['id'])->get();

               foreach($services as $key2=>$value2){

                   $sport =Sports::where('id',$value2['sport'])->first();

                   $str = $str.$sport['sport_name'];

                   if(($key2+1) != count($services)){

                       $str = $str.', ';

                   }

               }

               

               $user_logo = User::where('id',$value['user_id'])->first();

               $user_logo1 = $user_logo->profile_pic;

               

               $value['business_name'] = $value['company_name'];

               $value['activity'] = "";

               $value['website'] = "";

               $value['location'] = $value['city'];

               $value['address'] = $value['address'];

               $value['phone'] = $value['contact_number'];

               $value['type'] = "claimed";

               $value['type'] = "claimed";

               $value['max_price'] = $max_price;

               $value['min_price'] = $min_price;

               $value['service_name'] = $str;

               $value['user_logo'] = $user_logo1;

           }

           foreach($data as $key=>$value){

              $value['type'] = "unclaimed";

           }

           $search_data = $data;

           $search_data2 = $company;

           

            $result = array_merge($company->toArray(), $data->toArray());

            

            $page = $request->page ? $request->page :1;  

    		$perPage = $request->page_size ? $request->page_size :10; 

    		$offset = ($page * $perPage) - $perPage;

            $request_location = $request->location;

            $select_activity_location = $request->activity_location;

            $select_personality = $request->personality_habit;

            $select_experience = $request->activity_exp;

            $select_age = $request->age_range;

            $select_activity_for = $request->activity_for;

            $select_activity_type = $request->activity_type;

            $select_professional_type = $request->professional_type;

    		$resultnew =  new LengthAwarePaginator(

    			array_slice($result, $offset, $perPage, true),  

    			count($result), 

    			$perPage, 

    			$page, 

    			['path' => $request->url(), 'query' => $request->query()]  

    		);

    		

    		foreach($resultnew as $value){

    		    if($value['type'] == 'claimed'){

    		        $a = [$value['company_name'],$value['latitude'],$value['longitude'],$value['id'],$value['logo']];

                    array_push($locations,$a);

    		    }

    		}

    	

           return view('home.search-location',compact('select_professional_type','select_activity_type','select_activity_for','select_age','select_experience','select_personality','select_activity_location','select_language','request_location','resultnew','locations'

            ));


    }

    

    public function SendVerificationlink(Request $request)

    {

        $business = BusinessClaim::where('id',$request->business_id)->first();

        $code= $this->generateRandomString();

        $business->token = $code;

        $business->user_id = Auth::user()->id;

        $business->save();

        $email = $request->business_email.'@'.$business->website;

        Mail::to($email)->send(new BusinessVerifyMail($business,$code));


     return redirect('/get-business-detail/'.$request->business_id.'?mail_sent=1&email='.$request->business_email);


    }

    

    public function SendVerificationlinkMsg(Request $request)
    {
        $business = BusinessClaim::where('id',$request->business_id)->first();

        $code= rand( 1000 , 9999 );

        $business->token = $code;

        $business->user_id = Auth::user()->id;

        $business->save();

        

        $account_sid = getenv("TWILIO_SID");

        $auth_token = getenv("TWILIO_AUTH_TOKEN");

        $twilio_number = getenv("TWILIO_NUMBER");

        $client = new Client($account_sid, $auth_token);

        try{

            $message = $client->messages

                  ->create($business->phone, 

                           [

                               "body" => "Your business verification code is: ".$code,

                               "from" => $twilio_number

                           ]

                  );

            return redirect('/get-business-detail/'.$request->business_id.'?msg_sent=1&phone='.$business->phone);

        }

        catch(\Exception $e){

             return redirect()->back()->with('msg', $e->getMessage());

        }

    

       

    }

    

    public function SendVerificationlinkCall(Request $request)

    {

        $business = BusinessClaim::where('id',$request->business_id)->first();

         $code= rand( 1000 , 9999 );

        $business->token = $code;

        $business->user_id = Auth::user()->id;

        $business->save();

       try{

           $sid = getenv("TWILIO_SID");

           $token = getenv("TWILIO_AUTH_TOKEN");

           $twilio_number = getenv("TWILIO_NUMBER");

           $twilio = new Client($sid, $token);

           $call = $twilio->calls

              ->create($business->phone, 

                        $twilio_number, 

                        [

                            "twiml" => "<Response><Say voice='woman' language='en-IN'>Your one time password is ".$code."</Say></Response>"

                        ]

              );

              return redirect('/get-business-detail/'.$request->business_id.'?call_sent=1&phone='.$business->phone);

       }

       catch(\Exception $e){

             return redirect()->back()->with('msg', $e->getMessage());

       }

    }

    

    public function makeOTPMsg(Request $request)

    {

        $code = $request->otp;

        $business = BusinessClaim::where('id',$request->business_id)->first();

        if(empty($business)){

            return redirect()->back()->with('msg', 'Invalid link');

        }

        if($business->token == $code){

           Auth::loginUsingId($business['user_id'],true);

            $request->session()->put('company_name', $business['business_name']);

            $request->session()->put('phone', $business['phone']);

            $user = User::where('id',$business['user_id'])->first();

            Auth::login($user);

            Auth::loginUsingId($user->id, true);

         return redirect('/profile/viewProfile?companyCreate=1')->with(['phone'=>$business['phone'],'company_name'=>$business['business_name'],'business_id'=>$business['id'],'city'=>$business['location']]);

        }

        else{

            return redirect()->back()->with('msg', 'Invalid OTP');

        }

    }

    

    public function VerifySendVerificationlink(Request $request)

    {

        $code = $request->code;

        $business = BusinessClaim::where('token',$request->code)->first();

        if(empty($business)){

            return response()->json(['status'=>500,'message'=>'Invalid link']);

        }

        Auth::loginUsingId($business['user_id'],true);

        $request->session()->put('company_name', $business['business_name']);

        $request->session()->put('phone', $business['phone']);

        $user = User::where('id',$business['user_id'])->first();

         Auth::login($user);
        Auth::loginUsingId($user->id, true);

        return redirect('/profile/viewProfile?companyCreate=1')->with(['phone'=>$business['phone'],'company_name'=>$business['business_name'],'business_id'=>$business['id'],'city'=>$business['location']]);

    }

    

    public function generateRandomString($length = 10) {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $charactersLength = strlen($characters);

        $randomString = '';

        for ($i = 0; $i < $length; $i++) {

            $randomString .= $characters[rand(0, $charactersLength - 1)];

        }

        return $randomString;

    }

        

    public function businessClaim(Request $request)

    {

        return view('home.business-claim');

    }

	public function showbusinessClaimDetail(Request $request)

    {

        return view('home.business-claim-info-details');

    }

    

     public function getBusinessClaim($myloc)
    {

       $data = BusinessClaim::where('location','LIKE',$myloc.'%')->where('is_verified',0)->get();

       $company = CompanyInformation::where('city','LIKE',$myloc.'%')->get();

       foreach($company as $key=>$value){

           $value['business_name'] = $value['company_name'];

           $value['activity'] = "";

           $value['website'] = "";

           $value['location'] = $value['city'];

           $value['address'] = $value['address'];

           $value['phone'] = $value['contact_number'];

       }

       return response()->json(['status'=>200,'search_data'=>$data,'search_data2'=>$company]);

    }

    

    public function getLocationBusinessClaimDetaill(Request $request)
    {

       $data = BusinessClaim::where('business_name','LIKE',$request->business_name.'%')->where('location',$request->location)->where('is_verified',0)->get();

       $company = CompanyInformation::where('city',$request->location)->where('company_name','LIKE',$request->business_name.'%')->get();

       

       foreach($company as $key=>$value){

           $value['business_name'] = $value['company_name'];

           $value['activity'] = "";

           $value['website'] = "";

           $value['location'] = $value['city'];

           $value['address'] = $value['address'];

           $value['phone'] = $value['contact_number'];

       }

       return response()->json(['status'=>200,'search_data'=>$data,'search_data2'=>$company]);

    }

    

    public function getBusinessClaimDetaill($valueid,Request $request)
    {


       $data = BusinessClaim::where('id',$valueid)->first();

       if($request->mail_sent){

        return view('home.business-claim-detail', [

            'data'=>$data,

            'mail_sent'=>1,

            'email'=>$request->email

            ]);

       }

       elseif($request->msg_sent){

           return view('home.business-claim-detail', [

            'data'=>$data,

            'msg_sent'=>1

            ]);

       }

       elseif($request->call_sent){

           return view('home.business-claim-detail', [

            'data'=>$data,

            'call_sent'=>1

            ]);

       }

       else{

           return view('home.business-claim-detail', [

            'data'=>$data,

            'mail_sent'=>0

            ]);

       }

    }

    

    public function viewPCompany($company_id){
        
        $company = CompanyInformation::with('employmenthistory','education','users','certification','service','skill','ProfessionalDetail')->where('id',$company_id)->first();

        $company['company_images'] = $company['company_images'] == null ? [] : json_decode($company['company_images']);

        $max_price = UserService::where('company_id',$company['id'])->max('price');

        $min_price = UserService::where('company_id',$company['id'])->min('price');

        $user_professional_detail = UserProfessionalDetail::where('company_id',$company_id)->first();

        if(!empty($user_professional_detail))

            $user_professional_detail->availability = $user_professional_detail->availability != null ? json_decode(json_decode($user_professional_detail->availability)) : null;

               $services = UserService::where('company_id',$company['id'])->get();

               foreach($services as $key2 => $value2){

                   $sport =Sports::where('id',$value2['sport'])->first();

                   $value2['amenties'] = $sport['sport_name'];

        }

        return view('home.individual-page-new',compact('company','user_professional_detail','services','max_price','min_price'));

    }

    public function newtest(Request $request)
    {

      return view('personal-profile.newtest');

    }

    public function Pfavourite(Request $request)
    {

      $fav_id = $request->cid;
      $loggedId = Auth::user()->id;

      $status = UserFavourite::create([
        'user_id' => $loggedId,
        'favourite_user_id' => $fav_id
      ]);

    }

    public function Pfollow(Request $request)
    {

      $followid = $request->cid;
      $followerid = $request->fid;
      $loggedId = Auth::user()->id;

      $follower_id =0; 

      if($followid == ''){
        $follow_id = 0;
      }
      else{
        $follow_id = $followid;
      }

      if($followerid == ''){
        $follower_id = 0;
      }
      else{
        $follower_id = $followerid;
      }

      $followerdata = UserFollow::create([
          'user_id' => $loggedId,
          'follow_id' => $follow_id,
          'follower_id' => $follower_id
        ]);
      
    }

    public function removefollower(Request $request)
    {

      $remove_id = $request->fid;
      //echo $remove_id;
     
      DB::update('update users_follow set follow_id = "0" where  user_id = "'.$remove_id.'"');
    }

    public function Punfollow_company(Request $request){

      $unfollow_id = $request->fid;
      $loggedId = Auth::user()->id;
     
      DB::update('update users_follow set follow_id = "0" where follow_id = "'.$unfollow_id.'" and user_id = "'.$loggedId.'"');

    }

    public function Pfollow_back(Request $request)
    {
      $follow_id = $request->id;
      $user_id = $request->userid;

      $followback = UserFollow::create([
          'user_id' => Auth::user()->id,
          'follow_id' => $follow_id,
          'follower_id' => $user_id
      ]);

    }

    public function getMyService1(Request $request)

    {

        $arr_service = json_decode($request->arr_service);

        $data = [];

        foreach($arr_service as $value)

        {

            $v = UserService::where('id',$value)->first();

            $d = Sports::where('id',$v->sport)->get();

            $v['sport_name'] = $d[0]['sport_name'];

            array_push($data,$v);

        }

        return response()->json(['data'=>$data]) ;

    }

    

    public function get_createcompanyform()

    {

        $loggedinUser = Auth::user();

        $sports = $this->sports->getAlphabetsWiseSportsNames();

        $sports_names = $this->sports->getAllSportsNames(1);



        $sport_dd = array();

        $sports_select = '';

        $sport_dd[""] = "Choose a Sport/Activity1111";

        $UserProfileDetail =  $this->users->getUserProfileDetail($loggedinUser['id'], array('professional_detail','history', 'education', 'certification', 'service','skill'));

        $service = $UserProfileDetail['service'];

          $service = @$service[0]['sport'];

        if($sports){

            $sports_select .= "<option value=''>Choose a Sport/Activity</option>";

            foreach ($sports as $key => $value) {

                foreach ($value as $key1 => $value1) {

                    if(count($value1->child)){

                        $sports_select .= "<optgroup label='".$value1->title."'>";

                        foreach ($value1->child as $key2 => $value2) {

                            $selected =null;

                            $sports_select .= "<option value='".$key2."' ".$selected." >".$value2."</option>";

                        }

                        $sports_select .= "</optgroup>";

                    } else {

                        $selected = null;

                        $sports_select .= "<option value='".$value1->value."' ".$selected.">".$value1->title."</option>";

                    }

                }

            }

        }
        

        $businessType = Miscellaneous::businessType();

        $programType = Miscellaneous::programType();

        $programFor = Miscellaneous::programFor();

        $numberOfPeople = Miscellaneous::numberOfPeople();

        $ageRange = Miscellaneous::ageRange();

        $expLevel = Miscellaneous::expLevel();

        $serviceLocation = Miscellaneous::serviceLocation();

        $pFocuses = Miscellaneous::pFocuses();

        $duration = Miscellaneous::duration();

        $servicePriceOption = Miscellaneous::servicePriceOption();

        $specialDeals = Miscellaneous::specialDeals();

        $activity = Miscellaneous::activity();

        $teaching = Miscellaneous::teaching();

        $languages = Miscellaneous::getLanguages();

        $timeSlots = Miscellaneous::getTimeSlot();

    

        if(UserProfessionalDetail::where('user_id',$loggedinUser['id'])->first() == null){

            $ProfessionalDetail = UserProfessionalDetail::orderBy('id','DESC')->first();

        }

        else{

            $ProfessionalDetail = UserProfessionalDetail::where('user_id',$loggedinUser['id'])->first();

        }

            

         return view('profiles.createCompany', [

            'languages'=>$languages,

            'UserProfileDetail' =>$UserProfileDetail,

            'ProfessionalDetail' =>$ProfessionalDetail,

            'sports_select' => $sports_select,

            'sport_dd' => $sport_dd + $sports_names,

            'businessType' => $businessType,

            'activity'=>$activity,

            'programType' => $programType,

            'programFor' => $programFor,

            'teaching' => $teaching,

            'numberOfPeople' => $numberOfPeople,

            'ageRange' => $ageRange,

            'expLevel' => $expLevel,

            'serviceLocation' => $serviceLocation,

            'pFocuses' => $pFocuses,

            'duration'=> $duration,

            'specialDeals' => $specialDeals,

            'servicePriceOption' => $servicePriceOption,

            'pageTitle' => "COMPLETE PROFILE",

            'allLanguages' => $languages,

            'timeSlots' => $timeSlots,

            'mydetails' =>User::find($loggedinUser['id'])

            ]); 

    }

    

    public function mybusinessusertag(Request $request)

    {

        $count = CompanyInformation::where('business_user_tag',$request->email)->count();

        return response()->json(['status'=>200,'count'=>$count]);

    }

    

    public function manageCompany()

    {

        $company = CompanyInformation::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();

        $user= User::where('id',Auth::user()->id)->first();

        $user->role = 'business';

        $user->save();

       $firstCompany = CompanyInformation::where('user_id',Auth::user()->id)->orderBy('id','ASC')->first();

        return view('profiles.manageCompany',compact('company','firstCompany'));

    }

    

    public function deleteCompany(Request $request){

        UserEducation::where('company_id',$request->company_id)->where('user_id',Auth::user()->id)->delete();

        UserEmploymentHistory::where('company_id',$request->company_id)->where('user_id',Auth::user()->id)->delete();

        UserCertification::where('company_id',$request->company_id)->where('user_id',Auth::user()->id)->delete();

        UserSkillAward::where('company_id',$request->company_id)->where('user_id',Auth::user()->id)->delete();

        UserProfessionalDetail::where('company_id',$request->company_id)->where('user_id',Auth::user()->id)->delete();

        UserService::where('company_id',$request->company_id)->where('user_id',Auth::user()->id)->delete();

        CompanyInformation::where('id',$request->company_id)->where('user_id',Auth::user()->id)->delete();

        return response()->json(['type'=>'success','msg'=>'Company delete successfully','redirecturl'=>'']);

    }

    

    public function editCompany(Request $request){

         if (! Gate::allows('profile_edit_access')) {

            return redirect('/profile/viewProfile');

        }

        

        if((CompanyInformation::where('id',$request->company_id)->where('user_id',Auth::user()->id)->count()) == 0 ){

            $request->session()->flash('alert-danger', 'Access Restricted');

            return redirect('/profile/viewProfile');

        }

        

        $loggedinUser = Auth::user();

        $sports = $this->sports->getAlphabetsWiseSportsNames();

        $sports_names = $this->sports->getAllSportsNames(1);



        $sport_dd = array();

        $sports_select = '';

        $sport_dd[""] = "Choose a Sport/Activity";

        $UserProfileDetail =  $this->users->getUserProfileDetail($loggedinUser['id'], array('professional_detail','history', 'education', 'certification', 'service','skill'));

        $service1 = UserService::where('company_id',$request->company_id)->where('user_id',Auth::user()->id)->get();

        $UserProfileDetail['service'] = $service1;

        $service = $UserProfileDetail['service'];

          $service = @$service[0]['sport'];

        if($sports){

            $sports_select .= "<option value=''>Choose a Sport/Activity</option>";

            foreach ($sports as $key => $value) {

                foreach ($value as $key1 => $value1) {

                    if(count($value1->child)){

                        $sports_select .= "<optgroup label='".$value1->title."'>";

                        foreach ($value1->child as $key2 => $value2) {

                            $selected =null;
                            
                            $sports_select .= "<option value='".$key2."' ".$selected." >".$value2."</option>";

                        }

                        $sports_select .= "</optgroup>";

                    } else {

                        $selected = null;
                        
                        $sports_select .= "<option value='".$value1->value."' ".$selected.">".$value1->title."</option>";

                    }

                }

            }

        }

        $education1 = UserEducation::where('company_id',$request->company_id)->where('user_id',Auth::user()->id)->get();

        $UserProfileDetail['education'] = $education1;

        

        $certification1 = UserCertification::where('company_id',$request->company_id)->where('user_id',Auth::user()->id)->get();

        $UserProfileDetail['certification'] = $certification1;

        

        $history1 = UserEmploymentHistory::where('company_id',$request->company_id)->where('user_id',Auth::user()->id)->get();

        $UserProfileDetail['employmenthistory'] = $history1;

        

        $skill1 = UserSkillAward::where('company_id',$request->company_id)->where('user_id',Auth::user()->id)->get();

        $UserProfileDetail['skill'] = $skill1;

        

        $professional_detail1 = UserSkillAward::where('company_id',$request->company_id)->where('user_id',Auth::user()->id)->get();

        $ProfessionalDetail1 = UserProfessionalDetail::where('company_id',$request->company_id)->where('user_id',Auth::user()->id)->first();

        $UserProfileDetail['professional_detail'] = $professional_detail1;

        $UserProfileDetail['ProfessionalDetail'] = $ProfessionalDetail1;

        $businessType = Miscellaneous::businessType();

        $programType = Miscellaneous::programType();

        $programFor = Miscellaneous::programFor();

        $numberOfPeople = Miscellaneous::numberOfPeople();

        $ageRange = Miscellaneous::ageRange();

        $expLevel = Miscellaneous::expLevel();

        $serviceLocation = Miscellaneous::serviceLocation();

        $pFocuses = Miscellaneous::pFocuses();

        $duration = Miscellaneous::duration();

        $servicePriceOption = Miscellaneous::servicePriceOption();

        $specialDeals = Miscellaneous::specialDeals();

        $activity = Miscellaneous::activity();

        $teaching = Miscellaneous::teaching();

        $languages = Miscellaneous::getLanguages();

        $timeSlots = Miscellaneous::getTimeSlot();



        return view('profiles.editCompany', [

            'company_id'=>$request->company_id,

            'UserProfileDetail' =>$UserProfileDetail,

            'sports_select' => $sports_select,

            'sport_dd' => $sport_dd + $sports_names,

            'businessType' => $businessType,

            'activity'=>$activity,

            'programType' => $programType,

            'programFor' => $programFor,

            'teaching' => $teaching,

            'numberOfPeople' => $numberOfPeople,

            'ageRange' => $ageRange,

            'expLevel' => $expLevel,

            'serviceLocation' => $serviceLocation,

            'pFocuses' => $pFocuses,

            'duration'=> $duration,

            'specialDeals' => $specialDeals,

            'servicePriceOption' => $servicePriceOption,

            'pageTitle' => "COMPLETE PROFILE",

            'allLanguages' => $languages,

            'timeSlots' => $timeSlots,

            'mydetails' =>CompanyInformation::where('id',$request->company_id)->where('user_id',Auth::user()->id)->first()    

        ]);

    }

    

    public function uploadPic(Request $request){

        

        if($request->hasFile('frm_profile_pic'))

            {

                $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'service_profile_pic'.DIRECTORY_SEPARATOR;

    

                $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'service_profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

    

                $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('frm_profile_pic'),$file_upload_path,1,$thumb_upload_path,'247','266');

    

                $image_name = $image_upload['filename'];

        }

        else

        {

            $image_name = $request->old_profile_pic;

        } 

        

    }

    public function createNewService(Request $request)

    {

                    if($request->hasFile('frm_profile_pic'))

            {

                $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'service_profile_pic'.DIRECTORY_SEPARATOR;

    

                $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'service_profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

    

                $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('frm_profile_pic'),$file_upload_path,1,$thumb_upload_path,'247','266');

    

                $image_name = $image_upload['filename'];

            }

            else

            {

                $image_name = $request->old_profile_pic;

            } 

            $available_dates = [];

            $dateee = \DateTime::createFromFormat("m-d-Y" , $request->starting_date);

            $request->starting_date = $dateee->format('Y-m-d');

            if($request->class_meets == 'Weekly'){

                $this->arr = [];

                $day_arr = json_decode($request->serv_time_slot);

                foreach($day_arr as $value){

                if($value->sunday_start != ''){

                   $sdate = date('Y-m-d', strtotime('next Sunday', strtotime($request->starting_date)));

                   $this->mydate($sdate,$request->end_date);

                }

                if($value->monday_start != ''){

                   $sdate = date('Y-m-d', strtotime('next Monday', strtotime($request->starting_date)));

                   $this->mydate($sdate,$request->end_date);

                }

                if($value->tuesday_start != ''){

                   $sdate = date('Y-m-d', strtotime('next Tuesday', strtotime($request->starting_date)));

                   $this->mydate($sdate,$request->end_date);

                }

                if($value->wednesday_start != ''){

                   $sdate = date('Y-m-d', strtotime('next Wednesday', strtotime($request->starting_date)));

                   $this->mydate($sdate,$request->end_date);

                }

                if($value->thrusday_start != ''){

                   $sdate = date('Y-m-d', strtotime('next Thrusday', strtotime($request->starting_date)));

                   $this->mydate($sdate,$request->end_date);

                }

                if($value->friday_start != ''){

                   $sdate = date('Y-m-d', strtotime('next Friday', strtotime($request->starting_date)));

                   $this->mydate($sdate,$request->end_date);

                }

                if($value->saturday_start != ''){

                   $sdate = date('Y-m-d', strtotime('next Saturday', strtotime($request->starting_date)));

                   $this->mydate($sdate,$request->end_date);

                }

                }

                Log::info("called");

                

               

               $available_dates = $this->arr; 

                Log::info($available_dates);

            }

            else{

                $this->arr = [$request->starting_date];

                $available_dates = $this->arr;

            }


             $inserted = array(

            'user_id' => Auth::user()->id,

            'image'=> $image_name,

            'sport' => $request->frm_servicesport,

            'title' => $request->frm_servicetitle,

            'price' => $request->frm_serviceprice,

            'timeslot_from' => $request->frm_servicetimeslotfrom,

            'timeslot_to' => $request->frm_servicetimeslotto,

            'servicedesc' => $request->frm_servicedesc,

            'servicetype' => json_encode(json_decode($request->frm_servicetype),JSON_FORCE_OBJECT),

            'programtype' => $request->frm_programtype,

            'agerange' => json_encode(json_decode($request->frm_agerange),JSON_FORCE_OBJECT),

            'programfor' => json_encode(json_decode($request->frm_programfor),JSON_FORCE_OBJECT),

            'numberofpeople' => json_encode(json_decode($request->frm_numberofpeople),JSON_FORCE_OBJECT),

            'experience_level' => json_encode(json_decode($request->frm_experience_level),JSON_FORCE_OBJECT),

            'servicelocation' => json_encode(json_decode($request->frm_servicelocation),JSON_FORCE_OBJECT),

            'focuses' => json_encode(json_decode($request->frm_servicefocuses),JSON_FORCE_OBJECT),

            'specialdeals' => json_encode(json_decode($request->frm_specialdeals),JSON_FORCE_OBJECT),

            'servicepriceoption' => json_encode(json_decode($request->frm_servicepriceoption),JSON_FORCE_OBJECT),

            'duration' => $request->frm_serviceduration,

            'terms_conditions' => $request->termcondfaqtext,

            "expire_days"=>$request->expire_days,

            "expire_in_option"=>$request->expire_in_option1,

            "expire_in_option2"=>$request->expire_in_option2,

            "sessions"=>$request->sessions,

            "multiple_count"=>$request->multiple_count,

            "recurring_pay"=>$request->recurring_pay,

            "introoffer"=>$request->introoffer,

            "runautopay"=>$request->runautopay,

            "often"=>$request->often,

            "often_every_op1"=>$request->often_every_op1,

            "often_every_op2"=>$request->often_every_op2,

            "numberofpays"=>$request->numberofpays,

            "chargeclients"=>$request->chargeclients,

            "termcondfaq"=>$request->termcondfaq,

            'terms_conditions' => $request->termcondfaqtext,

            "contractterms"=>$request->contractterms,

            "contracttermstext"=>$request->contracttermstext,

            "liability"=>$request->liability,

            "liabilitytext"=>$request->liabilitytext,

            "covid"=>1,

            "covidtext"=>$request->covidtext,

            "setupprice"=>$request->setupprice,

            "offerpro_states"=>$request->offerpro_states,

            "activitydesignsfor"=>json_encode(json_decode($request->activitydesignsfor),JSON_FORCE_OBJECT),

            "activitytype"=>json_encode(json_decode($request->activitytype),JSON_FORCE_OBJECT),

            "frm_teachingstyle"=>json_encode(json_decode($request->frm_teachingstyle),JSON_FORCE_OBJECT),

            "salestax"=>$request->salestax,

            "after_drop"=>$request->after_drop,

            "salestaxpercentage"=>$request->salestaxpercentage,

            "duestax"=>$request->duestax,

            "duestaxpercentage"=>$request->duestaxpercentage,

            'serv_time_slot'=>$request->serv_time_slot,

            'class_meets'=>$request->class_meets,

            'starting_date'=>$request->starting_date,

            'end_date'=>$request->end_date,

            'available_dates'=>json_encode($available_dates),

            'schedule_until'=>$request->schedule_until

        );

       

            $serviceObj = DB::table('user_services')

                            ->insert($inserted);

            $data = UserService::orderBy('id','DESC')->first();


            return response()->JSON(['status'=>200,'message'=>$data]);

    }

    

    public function deleteNewService(Request $request)

    {

        UserService::where('id',$request->service_id)->delete();

        return response()->json(['status'=>200]);

    }

    

    public function companyImageUpload(Request $request)

    {

        $company = CompanyInformation::where('id',$request->company_id)->first();

        if($company->company_images != null){

            $file_arr = json_decode($company->company_images);

        }

        else{

             $file_arr = [];

        }

        $images = $request->file('images');

        if ($request->hasFile('images')){

            foreach ($images as $item){

                $file = $item;

                $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR;

                $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

                $image_upload = Miscellaneous::saveFileAndThumbnail1($item,$file_upload_path,1,$thumb_upload_path);

                array_push($file_arr,$image_upload['filename']);

                if (!file_exists(public_path('uploads/profile_pic/thumb150'))) {

                        mkdir(public_path('uploads/profile_pic/thumb150'), 0755, true);

                }

                $thumb_upload_path150 = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR;

                Image::make($item)->save($thumb_upload_path150 . $image_upload['filename']);

            }

        }

        $company->company_images=json_encode($file_arr);

        $company->save();

        return redirect()->back();

    }

    

    public function userImageUpload(Request $request)

    {

        $company = User::where('id',Auth::user()->id)->first();

        if($company->company_images != null){

            $file_arr = json_decode($company->company_images);

        }

        else{

             $file_arr = [];

        }

        $images = $request->file('images');

        if ($request->hasFile('images')){

            foreach ($images as $item){

                

                $file = $item;

                $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR;

                $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

                $image_upload = Miscellaneous::saveFileAndThumbnail1($item,$file_upload_path,1,$thumb_upload_path);

                array_push($file_arr,$image_upload['filename']);

                if (!file_exists(public_path('uploads/profile_pic/thumb150'))) {

                        mkdir(public_path('uploads/profile_pic/thumb150'), 0755, true);

                }

                $thumb_upload_path150 = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR;

                Image::make($item)->save($thumb_upload_path150 . $image_upload['filename']);

            }

        }

        $company->company_images=json_encode($file_arr);

        $company->save();

        return redirect()->back();

    }

    

    public function createCompany(Request $request)
    {

        $image = new Image();

        $request->profile_pic = '';

        if($request->hasFile('profile_pic')) {

            $file = Input::file('profile_pic');

            $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR;

            $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;

            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('profile_pic'),$file_upload_path,1,$thumb_upload_path,'415','354');

            $request->profile_pic =$image_upload['filename'];

            if (!file_exists(public_path('uploads/profile_pic/thumb150'))) {

                    mkdir(public_path('uploads/profile_pic/thumb150'), 0755, true);

            }

            $thumb_upload_path150 = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR;

            Image::make($request->file('profile_pic'))->resize(150, 150)->save($thumb_upload_path150 . $image_upload['filename']);

        }

        if($request->mybusinessid && $request->mybusinessid != '0' && $request->mybusinessid != 0)

        {

            $business  = BusinessClaim::where('id',$request->mybusinessid)->first();

            $website = $business->website;

        }

        

        $data = $request->all();

        $company_data = new CompanyInformation();

        $company_data->user_id = Auth::user()->id;

        $company_data->first_name = $data['company_representative_first_name'];

        $company_data->last_name = $data['company_representative_last_name'];

        $company_data->company_name = $data['company_name'];

        $company_data->address = $data['address'];

        $company_data->email = $data['email'];

        $company_data->city = $data['city'];

        $company_data->state = $data['state'];

        $company_data->zip_code = $data['zipcode'];

        $company_data->latitude = $data['latitude'];

        $company_data->longitude = $data['longitude'];

        $company_data->country = $data['country'];

        $company_data->contact_number = $data['contact_number'];

        $company_data->ein_number = $data['ein_number'];

        $company_data->establishment_year = $data['establishment_year'];

        $company_data->business_user_tag = $data['business_user_tag'];

        $company_data->about_company = $data['about_company'];

        $company_data->short_description = $data['short_description'];

        $company_data->website = $request->mybusinessid && $request->mybusinessid != '0' && $request->mybusinessid != 0 ? $website : NULL;

        

        if(isset($request->profile_pic) && $request->profile_pic != '') {

            $company_data->logo = $request->profile_pic;

        }

        if(!$company_data->save()) {

            return response()->json(['type'=>'danger','msg'=>'Some error has occured while registering company!','redirecturl'=>'']);

        }else {

            if($request->course != '' || $request->university != '' || $request->passing_year != '' ){

            $education = new UserEducation();

            $education->user_id = Auth::user()->id;

            $education->course = $request->course;

            $education->university = $request->university;

            if($request->passing_year != ''){

            $education->passing_year = $request->passing_year;

            }

            $education->company_id = $company_data->id;

            $education->save();

            }

            if($request->organization != '' && $request->position != '' && $request->service_start != '' ){

            $education = new UserEmploymentHistory();

            $education->user_id = Auth::user()->id;

            $education->organization = $request->organization;

            $education->position = $request->position;

            $education->company_id = $company_data->id;

             $dates = \DateTime::createFromFormat("m-d-Y" , $request->service_start);

            $education->service_start = $dates->format('Y-m-d');

            if($request->is_present == ''){

                $education->is_present = 0;

                }

                else{

                     $education->is_present = $request->is_present;

                     if($request->service_end != 'Till Date'){

                      $datee = \DateTime::createFromFormat("m-d-Y" , $request->service_end);

                      $education->service_end = $datee->format('Y-m-d');

                     }

                }

            $education->save();

            }

            

            if($request->title != '' && $request->completion_date != '' ){

            $certificate = new UserCertification();

            $certificate->user_id = Auth::user()->id;

            $certificate->title = $request->title;

            $datee = \DateTime::createFromFormat("m-d-Y" , $request->completion_date);

            $certificate->completion_date = $datee->format('Y-m-d');

            $certificate->company_id = $company_data->id;

            $certificate->save();

            }

            

            if($request->type != '' && $request->skill_completion_date != '' ){

            $skil_award = new UserSkillAward();

            $skil_award->user_id = Auth::user()->id;

            $skil_award->type = $request->type;

            $datee = \DateTime::createFromFormat("m-d-Y" , $request->skill_completion_date);

            $skil_award->completion_date = $datee->format('Y-m-d');

            $skil_award->skill_detail = $request->skill_detail;

            $skil_award->company_id = $company_data->id;

            $skil_award->save();

            }

            

            $update = array(

            'experience_level'=>json_encode(json_decode($request->experience_level),JSON_FORCE_OBJECT),

            'train_to'=>json_encode(json_decode($request->train_to),JSON_FORCE_OBJECT),

            'personality'=>json_encode(json_decode($request->personality),JSON_FORCE_OBJECT),

            'availability'=>json_encode($request->availability),

            'languages'=>json_encode(json_decode($request->languages),JSON_FORCE_OBJECT),

            'skill_lavel'=>json_encode(json_decode($request->skill_lavel),JSON_FORCE_OBJECT),

            'medical_states'=>$request->medical_states,

            'medical_type'=>json_encode(json_decode($request->medical_type),JSON_FORCE_OBJECT),

            'work_locations'=>json_encode(json_decode($request->work_locations),JSON_FORCE_OBJECT),

            'goals_states'=>$request->goals_states,

            'goals_option'=>json_encode(json_decode($request->goals_option),JSON_FORCE_OBJECT),

            'hours'=>$request->hours_opt != 'undefined' ?$request->hours_opt:null ,

            'timezone'=>$request->timezone,

            'special_days_off'=>$request->special_days_off,

            'notice_each_book'=>'{"'.$request->notice_each_book_day.'":"'.$request->notice_each_book_ans.'"}',

            'advance_book'=>'{"'.$request->advance_book_day.'":"'.$request->advance_book_ans.'"}',

            'willing_to_travel'=>$request->willing_to_travel,

            'travel_miles'=>$request->travel_miles,

            'travel_times'=>NULL,

            'user_id'=>Auth::user()->id,

            'company_id'=>$company_data->id,

            

            );

            $id = DB::table('user_professional_details')->insertGetId($update);

            

            foreach(json_decode($request->arr_service) as $value){

                $us = UserService::where('id',$value)->first();

                $us->company_id = $company_data->id;

                $us->save();

            }

            

            if($request->mybusinessid && $request->mybusinessid != '0' && $request->mybusinessid != 0){

                $business  = BusinessClaim::where('id',$request->mybusinessid)->first();

                $business->is_verified = 1;

                $business->save();

            }


            if($id){

                $u = User::where('id',Auth::user()->id)->first();

                $u->role = 'business';

                $u->is_upgrade = 1;

                $u->save();

                return response()->json(['type'=>'success','msg'=>'Create Company successfully','redirecturl'=>'']);

            }

        }

    }

    

    public function mydate($date,$end_date){

        Log::info("date ".$date);

        array_push($this->arr,$date);

        $date = strtotime($date);

        $date = strtotime("+7 day", $date);

        if((date('Y-m-d',$date)) <= (date('Y-m-d',strtotime($end_date))) ){

            $this->mydate(date('Y-m-d',$date),$end_date);

        }

        else{

            Log::info($this->arr);

            return $this->arr;

        }

    }

    

    

    

    public function switchAccount(Request $request){

        $user = User::where('id',Auth::user()->id)->first();

        if($user->is_upgrade == 1){

            

            if($request->manage_company){

                $user->role = 'business';

            } else {

            if($user->role == 'customer')

                $user->role = 'business';

                 else

                $user->role = 'customer';

            }

            $user->save();

            

            $response = array(

                    'type' => 'success',

                    'msg' => 'Successfully switch account',

            );

            

        }

        else{

            $response = array(

                    'type' => 'error',

                    'msg' => 'Error switch account',

            );

        }

         return Response::json($response);

    }

    

    public function createBusinessProfile(Request $request)

    {

        $userObj = new BusinessInformation();

        $s = AddrStates::where('state_name',$request->state)->get();

        $c = AddrCities::where('city_name',$request->city)->get();

        $userObj->user_id = Auth::user()->id;

        $userObj->company_name = $request->company_name;

        $userObj->address = $request->address;

                $userObj->city = @$c[0]->id;

                $userObj->state = @$s[0]->id;

                $userObj->country = strtoupper($request->country);

                $userObj->zip_code = $request->zipcode;

                $userObj->ein_number = $request->b_EINnumber;

        $userObj->establishment_year = $request->b_Establishmentyear;

        // get lat long

        $latlongdata = Miscellaneous::getLatLong($request->zipcode);

        $userObj->latitude = $latlongdata['lat'];

        $userObj->longitude= $latlongdata['long'];

         $userObj->save();

         $response = array(

                    'type' => 'success',

                    'msg' => 'Successfully created business',

            );

            return Response::json($response);

    }

    

    public function upgradeBusinessProfile(Request $request)

    {

        $userObj = User::where('id',Auth::user()->id)->first();

        $s = AddrStates::where('state_name',$request->state)->get();

        $c = AddrCities::where('city_name',$request->city)->get();

        $userObj->company_name = $request->company_name;

        $userObj->address = $request->address;

                $userObj->city = @$c[0]->id;

                $userObj->state = @$s[0]->id;

                $userObj->country = strtoupper($request->country);

                $userObj->zipcode = $request->zipcode;

                $userObj->ein_number = $request->b_EINnumber;

        $userObj->establishment_year = $request->b_Establishmentyear;

        $userObj->role = 'business';

        $userObj->is_upgrade = 1;

        $latlongdata = Miscellaneous::getLatLong($request->zipcode);

        $userObj->latitude = $latlongdata['lat'];

        $userObj->longitude= $latlongdata['long'];

         $userObj->save();

        if($request->course != '' && $request->university != '' && $request->passing_year != '' ){

            $education = new UserEducation();

            $education->user_id = Auth::user()->id;

            $education->course = $request->course;

            $education->university = $request->university;

            $education->passing_year = $request->passing_year;

            $education->save();

            }

            if($request->organization != '' && $request->position != '' && $request->service_start != '' ){

            $education = new UserEmploymentHistory();

            $education->user_id = Auth::user()->id;

            $education->organization = $request->organization;

            $education->position = $request->position;

            $education->service_start = $request->service_start;

            if($request->is_present == ''){

                $education->is_present = 0;

                }

                else{

                     $education->is_present = $request->is_present;

                      $education->service_end = date('Y-m-d', strtotime($request->service_end)) ;

                }

            $education->save();

            }

            

            if($request->title != '' && $request->completion_date != '' ){

            $certificate = new UserCertification();

            $certificate->user_id = Auth::user()->id;

            $certificate->title = $request->title;

            $certificate->completion_date = $request->completion_date;

            $certificate->save();

            }

            

            if($request->type != '' && $request->skill_completion_date != '' ){

            $skil_award = new UserSkillAward();

            $skil_award->user_id = Auth::user()->id;

            $skil_award->type = $request->type;

            $skil_award->completion_date = $request->skill_completion_date;

            $skil_award->skill_detail = $request->skill_detail;

            $skil_award->save();

            }

            $response = array(

                    'type' => 'success',

                    'msg' => 'Successfully upgraded profile',

            );

            return Response::json($response);

    }    

    public function postChangePassword(Request $request)

    {

        $postArr = $request->all();

        $rules = [

            'current_password' => 'required',

            'password' => 'required|same:password_confirmation|min:8',

            'password_confirmation' => 'required|same:password|min:8',

        ];

        $validator = Validator::make($postArr,$rules);

        if($validator->fails()) {  

            return redirect('profile/change-password')->withErrors($validator)->withInput();

        }

        else{

            $user = User::where('id',Auth::user()->id)->first();

            if (Hash::check($postArr['current_password'], $user->password)) {

                 $user->password = bcrypt($postArr['password']);

                $user->save();

                 $request->session()->flash('success', 'Password changed successfully !');

                return redirect('profile/viewProfile');

                

            }

            else{

               $request->session()->flash('alert-danger', 'Current password not match');

               return redirect('/profile/change-password');

            }

        }

    }

    

    public function viewChangePassword()

    {

        return view('profiles/changePassword');

    }

    

    public function check()

    {

        if(!(Auth::check())){

            Auth::loginUsingId(230, true);

        }

        else{

            print_r("called");die;

        }

    }

    

    public function submitFamilyForm()

    {

        $postArr = Input::all();

        $rules = [

            'first_name' => 'required',
            'last_name' => 'required',
            'mobile' => 'required'

        ];

        $validator = Validator::make($postArr,$rules);

        if($validator->fails()) {            

            $errMsg = array();

            foreach($validator->messages()->getMessages() as $field_name => $messages) {                

                $errMsg = $messages;                

            }

            $response = array(

                    'type' => 'danger',

                    'msg' => 'Validation fails',

            );

            return Response::json($response);

        }

        else{

            if((UserFamilyDetail::where('user_id',Input::get('user_id'))->count()) == 0)

                $family = new UserFamilyDetail();

            else

                $family = UserFamilyDetail::where('user_id',Input::get('user_id'))->first();

                

                $family->user_id = Input::get('user_id');

                $family->first_name = Input::get('first_name');

                $family->last_name = Input::get('last_name');

                $family->email = Input::get('email');

                $family->mobile = Input::get('mobile');

                $family->gender = Input::get('gender');

                $family->relationship = Input::get('relationship');

                $family->emergency_contact = Input::get('emergency_contact');

                $family->birthday = Input::get('birthday');

                $family->save();

                Auth::loginUsingId(Input::get('user_id'), true);

                $url = '/profile/viewProfile';

                $response = array(

                    'type' => 'success',

                    'msg' => 'Successfully added family member',

                    'redirecturl' => $url,

            );

            return Response::json($response);

        }

    }

    public function submitFamilyForm1(Request $request)

    {

    

             $family = new UserFamilyDetail();

           

                $family->user_id = Auth::user()->id;

                $family->first_name = $request->first_name;

                $family->last_name = $request->last_name;

                $family->email = $request->email;

                $family->mobile = $request->mobile_number;

                $family->gender = $request->gender;

                $family->relationship = $request->relationship;

                $family->emergency_contact = $request->emergency_phone;

                $family->birthday =  $request->birthday;

                $family->save();

                Auth::loginUsingId(Input::get('user_id'), true);

                $url = '/profile/viewProfile';

                $response = array(

                    'type' => 'success',

                    'msg' => 'Successfully added family member',

                    'redirecturl' => $url,

            );

            return Response::json($response);

    }

    

    public function skipFamilyForm1(Request $request)

    {

        Auth::loginUsingId(Auth::user()->id, true);

        $url = '/profile/viewProfile';

        $response = array(

            'type' => 'success',

            'msg' => 'Successfully logged in',

            'redirecturl' => $url,

        );

        return Response::json($response);   

    }

    

    public function submitFamilyFormWithSkip(Request $request)

    {

            Auth::loginUsingId($request->user_id, true);

            $url = '/profile/viewProfile';

            $response = array(

                'type' => 'success',

                'msg' => 'Successfully logged in',

                'redirecturl' => $url,

            );

            return Response::json($response);

        

    }

    

    public function familyProfileUpdate(Request $request)

    {

        $user = User::where('confirmation_code',$request->user_id)->count();

        if($user != 0)

        {

             

            $data = User::where('confirmation_code',$request->user_id)->first();

            return view('auth.family')->with('user_id',$data->id);

        }

        else{

            

            return view('auth.family')->with('error_msg','Invalid Request');

        }    

    }

    public function historyValidator()

    {

        $data = Input::all();

        $validator =  Validator::make($data, [            
                    'organization' => 'required|max:255',
                ],
                [
                    'required' => 'The :attribute is required.',

                ]);

         if($validator->fails()) {            
            $response = array(
                    'type' => 'danger',
                    'msg' => 'Validation fails',
            );
            return Response::json($response);
        }

        else{
            $history_id = Input::get('history_id');
                if($history_id != '' && $history_id != null && $history_id != 'undefined'){
                $education = UserEmploymentHistory::where('id',$history_id)->first();
                $msg = 'updated';
            }
            else{
                $msg = 'added';
            $education = new UserEmploymentHistory();
            }
            if(Input::get('company_id')){
                $education->company_id = Input::get('company_id');
            }
            $education->user_id = Auth::user()->id;
            $education->organization = Input::get('organization');
            $education->position = Input::get('position');
            if(Input::get('is_present') == ''){
            $education->is_present = 0;
            }
            else
            {
                 $education->is_present = Input::get('is_present');
                 if(Input::get('service_end') != 'Till Date')
                 {
                    $dateee = \DateTime::createFromFormat("m-d-Y" , Input::get('service_end'));
                    $education->service_end = $dateee->format('Y-m-d') ;
                 }

            }
            $dateee = \DateTime::createFromFormat("m-d-Y" , Input::get('service_start'));
            $education->service_start = $dateee->format('Y-m-d') ;
            $education->save();
            $response = array(
                    'type' => 'success',
                    'msg' => 'Successfully '.$msg. ' user employee history details',
                    'id' =>$education->id
                );
            return Response::json($response);
        }
    }
    public function EducationValidator()
    {
        $data = Input::all();
        $validator =  Validator::make($data, [            
                      'course' => 'required|max:255',
                      'university' => 'required|max:255',
                     ],
                [
                    'required' => 'The :attribute is required.',
                ]);
         if($validator->fails()) {            
            $response = array(
                    'type' => 'danger',
                    'msg' => 'Validation fails',
               );
            return Response::json($response);
        }
        else{
             $history_id = Input::get('education_id');
             if($history_id != '' && $history_id != null && $history_id != 'undefined'){
                $education = UserEducation::where('id',$history_id)->first();
                $msg = 'updated';
            }
            else{
            $education = new UserEducation();
            $msg = 'added';
            }
            if(Input::get('company_id')){
                $education->company_id = Input::get('company_id');
            }
            $education->user_id = Auth::user()->id;
            $education->course = Input::get('course');
            $education->university = Input::get('university');
            $dateee = \DateTime::createFromFormat("Y" , Input::get('passing_year'));
            $education->passing_year = $dateee->format('Y-m-d') ;
            $education->save();
            $response = array(
                    'type' => 'success',
                    'msg' => 'Successfully '.$msg. ' education details',
                    'id' =>$education->id
                );
            return Response::json($response);
        }
    }


    public function deleteData(Request $request)
    {
        $data = $request->all();
        if($data['selection_data'] == 'education_id'){
            UserEducation::where('id',$data['id'])->delete();
            $response = array(
                    'type' => 'success',
                    'msg' => 'Successfully deleted education detail',
               );
            return Response::json($response);
        }
        else if($data['selection_data'] == 'certificate_id'){
            UserCertification::where('id',$data['id'])->delete();
            $response = array(
                    'type' => 'success',
                    'msg' => 'Successfully deleted certificate data',
            );
            return Response::json($response);
        }
        else if($data['selection_data'] == 'skillaward_id'){
            UserSkillAward::where('id',$data['id'])->delete();
            $response = array(
                    'type' => 'success',
                    'msg' => 'Successfully deleted skill data',
                );
            return Response::json($response);
        }

        else{
            UserEmploymentHistory::where('id',$data['id'])->delete();
            $response = array(
                    'type' => 'success',
                    'msg' => 'Successfully deleted emplyee history data',
                );
            return Response::json($response);
        }
    }

    public function CertificationValidator()
    {
        $data = Input::all();
        $validator =  Validator::make($data, [            
                    'title' => 'required|max:255',
                    ],
                [
                    'required' => 'The :attribute is required.',
                ]);
         if($validator->fails()) {            
            $response = array(
                    'type' => 'danger',
                    'msg' => 'Validation fails',
            );
            return Response::json($response);
        }
        else{
             $history_id = Input::get('certificate_id');
            if($history_id != '' && $history_id != null && $history_id != 'undefined'){
                $education = UserCertification::where('id',$history_id)->first();
                $msg = 'updated';
            }
            else{
                $msg = 'added';
                $education = new UserCertification();
            }
            if(Input::get('company_id')){
                $education->company_id = Input::get('company_id');
            }
            $education->user_id = Auth::user()->id;
            $education->title = Input::get('title');
            $education->completion_date = date('Y-m-d', strtotime(Input::get('completion_date')));
            $education->save();
            $response = array(
                    'type' => 'success',
                    'msg' => 'Successfully '. $msg .' certification details',
                    'id' =>$education->id
                );
            return Response::json($response);
       }
    }

    public function skillAwardValidator()
    {
        $data = Input::all();
        $validator =  Validator::make($data, [            
                    'type' => 'required|max:255',
                ],
                [
                    'required' => 'The :attribute is required.',
                ]);

         if($validator->fails()) {            
            $response = array(
                    'type' => 'danger',
                    'msg' => 'Validation fails',
            );
            return Response::json($response);
        }

        else{
             $history_id = Input::get('skill_award_id');
            if($history_id != '' && $history_id != null && $history_id != 'undefined'){
                $education = UserSkillAward::where('id',$history_id)->first();
                $msg = 'updated';
            }
            else{
                $msg = 'added';
                $education = new UserSkillAward();
            }
            if(Input::get('company_id')){
                $education->company_id = Input::get('company_id');
            }
            $education->user_id = Auth::user()->id;
            $education->type = Input::get('type');
            $education->skill_detail = Input::get('skill_detail');
            $dateee = \DateTime::createFromFormat("m-d-Y" , Input::get('completion_date'));
            $education->completion_date = $dateee->format('Y-m-d') ;
            $education->save();
            $response = array(
                    'type' => 'success',
                    'msg' => 'Successfully '.$msg. ' skill award details',
                    'id' =>$education->id
            );
            return Response::json($response);
       }

    }

    

    protected function securityValidator($data)
    {
        return Validator::make($data, [            
                    'question1' => 'required',
                    'question2' => 'required',
                    'question3' => 'required',
                    'answer1' => 'required|max:255',
                    'answer2' => 'required|max:255',
                    'answer3' => 'required|max:255',
                ],
                [
                    'question1.required' => 'Select security question',
                    'question2.required' => 'Select security question',
                    'question3.required' => 'Select security question',
                    'answer1.required'  => 'Answer is required',
                    'answer2.required'  => 'Answer is required',
                    'answer3.required'  => 'Answer is required',
                ]);

    }



    protected function detailValidator($data)
    {
        return Validator::make($data, [            
                    'company_name' => 'required|max:255',
                    'firstname' => 'required|max:255',
                    'lastname' => 'required|max:255',
                    'gender' => 'required',
                    'phone_number' => 'regex:/^\(?([1-9]{1}[0-9]{2})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/',
                    'address' => 'required|max:255',
                    'city' => 'required|max:10',
                    'state' => 'required|max:10',
                    'zipcode' => 'required|integer',
                ],
                [
                    'company_name.required' => 'Provide a company name',
                    'firstname.required' => 'Provide a first name',
                    'lastname.required' => 'Provide a last name',
                    'gender.required' => 'Select a gender',
                    'address.required'  => 'Provide an address',
                    'city.required'  => 'Provide a city',
                    'state.required'  => 'Provide a state',
                    'zipcode.required'  => 'Provide a zipcode',
                    'zipcode.integer' => 'Zipcode must be a number.',
                    'phone_number.regex' => 'Phone number format is invalid',
                ]);
    }

    

    protected function detailValidatorForCustomer($data)
    {
        return Validator::make($data, [            
                    'firstname' => 'required|max:255',
                    'lastname' => 'required|max:255',
                    'gender' => 'required',
                    'phone_number' => 'regex:/^\(?([1-9]{1}[0-9]{2})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/',
                    'address' => 'required|max:255',
                    'city' => 'required|max:10',
                    'state' => 'required|max:10',
                    'zipcode' => 'required|integer',
                    'about_me' => 'required'
                ],
                [
                    'firstname.required' => 'Provide a first name',
                    'lastname.required' => 'Provide a last name',
                    'gender.required' => 'Select a gender',
                    'address.required'  => 'Provide an address',
                    'city.required'  => 'Provide a city',
                    'state.required'  => 'Provide a state',
                    'zipcode.required'  => 'Provide a zipcode',
                    'zipcode.integer' => 'Zipcode must be a number.',
                    'phone_number' => 'Phone number format is invalid.',
                    'about_me.required' => 'Provide about me'
                ]);

    }

    



    /**

     * Display a list of all of the user's page.

     *

     * @param  Request  $request

     * @return Response

     */

    public function index($userid)

    {

        return view('profiles.profile', [

            'pageTitle' => "PROFILE"

        ]);

    }



    public function createProfile()

    {

      

        $sports = $this->sports->getAlphabetsWiseSportsNames();

        $sports_names = $this->sports->getAllSportsNames();



        $sport_dd = array();

        $sports_select = '';

        $sport_dd[""] = "Select Sport";



        if($sports){

            $sports_select .= "<option value=''>Select Sport</option>";

            foreach ($sports as $key => $value) {

                foreach ($value as $key1 => $value1) {

                    if(count($value1->child)){

                        $sports_select .= "<optgroup label='".$value1->title."'>";

                        foreach ($value1->child as $key2 => $value2) {

                            $sports_select .= "<option value='".$key2."'>".$value2."</option>";

                        }

                        $sports_select .= "</optgroup>";

                    } else {

                        $sports_select .= "<option value='".$value1->value."'>".$value1->title."</option>";

                    }

                }

            }

        }

        

        $loggedinUser = Auth::user();

        return view('profiles.createBusinessProfile', [

            'users' => $this->users->findById($loggedinUser['id']),

            'sports_select' => $sports_select,

            'sport_dd' => $sport_dd + $sports_names,

            'pageTitle' => "PROFILE"

        ]);

    }



    public function saveProfileHistory(Request $request)

    {

        ini_set('max_execution_time', 300);

        $loggedinUser = Auth::user();

     
        $professionalObj = New UserProfessionalDetail();

        $professionalObj->user_id = $loggedinUser['id'];

        $professionalObj->experience_level = $request->selected_experience_level;

        $professionalObj->professional_type = $request->professional_type;

        $professionalObj->about_me = $request->about_me;

        $professionalObj->train_to = ($request->train_to) ? implode(",", $request->train_to) : '';

        $professionalObj->personality = ($request->personality) ? implode(",", $request->personality) : '';

        $professionalObj->availability = ($request->availability) ? implode(",", $request->availability) : '';



        $professionalObj->willing_to_travel = $request->willing_to_travel;

        if(isset($request->willing_to_travel) && $request->willing_to_travel == 'yes'){

            $professionalObj->travel_miles = $request->travel_miles;

        } else {

            $professionalObj->travel_miles = NULL;

        }



        if(!$professionalObj->save()) {

            $request->session()->flash('alert-danger', 'Some error has occured while saving profile.');

            return redirect('/profile/editProfileHistory');

        }

        $history_record = array();

        $history_index  = 0;

        $i = 0;

        while($i < count($request->organization)) {

            

            if($request->organization[$i] == "" || $request->position[$i] == "" || $request->servicestart[$i] == "" || $request->serviceend[$i] == "") {

                continue;

            }

            $history_record[$history_index]['user_id'] = $loggedinUser['id'];

            $history_record[$history_index]['organization'] = $request->organization[$i];

            $history_record[$history_index]['position'] = $request->position[$i];            

            if($request->ispresent[$i] == 1) {

                $history_record[$history_index]['is_present'] = 1;

                $history_record[$history_index]['service_end'] = "0000-00-00";

            }

            else {

                $history_record[$history_index]['is_present'] = '0';                

                $history_record[$history_index]['service_end'] = date("Y-m-d", strtotime($request->serviceend[$i]));

            }            

            $history_record[$history_index]['service_start'] = date("Y-m-d", strtotime($request->servicestart[$i]));            

            $history_index++;



            $i++;

        }

        if(count($history_record) > 0) {

            if(!UserEmploymentHistory::insert($history_record)) {

                $request->session()->flash('alert-danger', 'Some error has occured while saving profile.');

                return redirect('/profile/editProfileHistory');

            }

        }



        $education_record = array();

        $education_index  = 0;

        $i = 0;

        while($i < count($request->course)) {

            

            if($request->course[$i] == "" || $request->university[$i] == "" || $request->passingyear[$i] == "") {

                continue;

            }

            $education_record[$education_index]['user_id'] = $loggedinUser['id'];

            $education_record[$education_index]['course'] = $request->course[$i];

            $education_record[$education_index]['university'] = $request->university[$i];

            $education_record[$education_index]['passing_year'] = date("Y-m-d", strtotime($request->passingyear[$i]));

            $education_index++;



            $i++;

        }

        if(count($education_record) > 0) {

            if(!UserEducation::insert($education_record)) {

                $request->session()->flash('alert-danger', 'Some error has occured while saving profile.');

                return redirect('/profile/editProfileHistory');

            }

        }


        $certificate_record = array();

        $certificate_index  = 0;

        $i = 0;

        while($i < count($request->certificatetitle)) {

            

            if($request->certificatetitle[$i] == "" || $request->certificatecompletion[$i] == "") {

                continue;

            }

            $certificate_record[$certificate_index]['user_id'] = $loggedinUser['id'];

            $certificate_record[$certificate_index]['title'] = $request->certificatetitle[$i];

            $certificate_record[$certificate_index]['completion_date'] = date("Y-m-d", strtotime($request->certificatecompletion[$i]));

            $certificate_index++;



            $i++;

        }

        if(count($certificate_record) > 0) {

            if(!UserCertification::insert($certificate_record)) {

                $request->session()->flash('alert-danger', 'Some error has occured while saving profile.');

                return redirect('/profile/editProfileHistory');

            }

        }


        $service_record = array();

        $service_index  = 0;

        $i = 0;

        while($i < count($request->servicetitle)) {

            

            if($request->servicetitle[$i] == "" || $request->servicedesc[$i] == "" || $request->servicesport[$i] == "") {

                continue;

            }

            $service_record[$service_index]['user_id'] = $loggedinUser['id'];

            $service_record[$service_index]['sport'] = $request->servicesport[$i];

            $service_record[$service_index]['title'] = $request->servicetitle[$i];

            $service_record[$service_index]['price'] = $request->serviceprice[$i];

            $service_record[$service_index]['servicedesc'] = $request->servicedesc[$i];

            $service_index++;



            $i++;

        }

        if(count($service_record) > 0) {

            if(!UserService::insert($service_record)) {

                $request->session()->flash('alert-danger', 'Some error has occured while saving profile.');

                return redirect('/profile/editProfileHistory');

            }

        }



        $request->session()->flash('alert-success', 'Profile saved successfully!');

        return redirect('/profile/editProfileHistorySecurity');

    }



    public function createProfileSecurity()

    {  

        $loggedinUser = Auth::user();

         

        

        if(UserSecurityQuestion::where('user_id',$loggedinUser['id'])->count() == 0){

        return view('profiles.createBusinessProfile_security', [

            'users' => $this->users->findById($loggedinUser['id']),

            'question' => Miscellaneous::getSecurityQuestions(),

            'pageTitle' => "PROFILE"

        ]);

        }

        else{

            return redirect('/profile/editProfileSecurity');

        }

    }



    public function getQuestions()

    {

      

        return Response::json(Miscellaneous::getSecurityQuestions());

        exit();

    }

    

    public function getBackgroundCheckFAQ()

    {

        $data = Fit_background_check_faq::all();

        return view('faq.background_check_faq', compact('data'));

    }

    

    public function getVettedBussinessFAQ()

    {

        $data = Fit_vetted_business_faq::all();

        return view('faq.vetted_business_faq', compact('data'));

    }

    public function editProfileSecurity()

    {

        if (! Gate::allows('profile_edit_access')) {

            return redirect('/profile/viewProfile');

        }



        $loggedinUser = Auth::user();



        return view('profiles.editBusinessProfile_security', [

            'UserProfileDetail' => $this->users->getUserProfileDetail($loggedinUser['id'], array('security')),

            'question' => Miscellaneous::getSecurityQuestions(),

            'pageTitle' => "EDIT PROFILE"

        ]);

    }



    public function saveProfileSecurity(Request $request)

    {

        $validator = $this->securityValidator($request->all());

        if ($validator->fails()) {

            $this->throwValidationException(

                $request, $validator

            );

        }

        $status = true;

        if(isset($request->action) && $request->action =="edit" && ($request->id1 > 0)) {

            $UserSecurityQuestion = UserSecurityQuestion::find($request->id1);

            $UserSecurityQuestion->question = $request->question1;

            $UserSecurityQuestion->answer = $request->answer1;

            if(!$UserSecurityQuestion->save())

                $status = false;



            $UserSecurityQuestion = UserSecurityQuestion::find($request->id2);

            $UserSecurityQuestion->question = $request->question2;

            $UserSecurityQuestion->answer = $request->answer2;

            if(!$UserSecurityQuestion->save())

                $status = false;



            $UserSecurityQuestion = UserSecurityQuestion::find($request->id3);

            $UserSecurityQuestion->question = $request->question3;

            $UserSecurityQuestion->answer = $request->answer3;

            if(!$UserSecurityQuestion->save())

                $status = false;



        }else {

            $loggedinUser = Auth::user();



            $data = array(

                array('user_id'=>$loggedinUser['id'], 'question'=>$request->question1, 'answer'=>$request->answer1),

                array('user_id'=>$loggedinUser['id'], 'question'=>$request->question2, 'answer'=>$request->answer2),

                array('user_id'=>$loggedinUser['id'], 'question'=>$request->question3, 'answer'=>$request->answer3),

            );



            if(!UserSecurityQuestion::insert($data)) {

                $status = false;

            }

        }



        if(!$status) {

            $request->session()->flash('alert-danger', 'Some error has occured while saving profile.');

            return redirect('/profile/editProfileHistorySecurity');

        }else {

            $request->session()->flash('alert-success', 'Profile saved successfully!');

            if(isset($request->action) && $request->action =="edit") {

                return redirect('/profile/viewProfile');

            }else {

                return redirect('/profile/viewProfile');

            }            

        }        

    }



    public function createProfileMembership()

    {

        $loggedinUser = Auth::user();

        return view('profiles.createBusinessProfile_membership', [

            'users' => $this->users->findById($loggedinUser['id']),

            'pageTitle' => "PROFILE",

            'plans'     => $this->planRepository->getAllPlans()

        ]);

    }



    public function editProfileMembership()

    {

        if (! Gate::allows('profile_edit_access')) {
            return redirect('/profile/viewProfile');

        }

        

        $loggedinUser = Auth::user();

        return view('profiles.editBusinessProfile_membership', [

            'UserProfileDetail' => $this->users->getUserProfileDetail($loggedinUser['id'], array('membership')),

            'users' => $this->users->findById($loggedinUser['id']),

            'pageTitle' => "PROFILE",

            'plans'     => $this->planRepository->getAllPlans()

        ]);

    }



    public function saveProfileMembership(Request $request)

    {

        $loggedinUser = Auth::user();

        

        if($request->selected_plans == "") {

            $response = array(

                        'type' => 'danger',

                        'msg' => 'Please select any plan.',

                    );

            return Response::json($response);

        }



        $plans = explode(",", $request->selected_plans);

        if(isset($request->action) && $request->action =="edit") {

            $previous_plans = explode(",", $request->previous_plans);

            $deleted_plan = array_diff($previous_plans, $plans);

            if(count($deleted_plan) > 0) {

               UserMembership::whereIn('membership_plan_id', $deleted_plan)->delete();

            }

        }

        

        $data  = array();

        foreach ($plans as $plan) {

            $data[] = array('user_id'=>$loggedinUser['id'], 'membership_plan_id'=>$plan);

        }



        if(!UserMembership::insert($data)) {

            $response = array(

                        'type' => 'danger',

                        'msg' => 'Some error has occured while saving profile.',

                        );

            return Response::json($response);

        }



        $response = array(

                        'type' => 'success',

                        'msg' => 'Profile saved successfully!',

                    );

        return Response::json($response);

    }



    public function sendProfileToReview($status, Request $request)

    {

        $loggedinUser = Auth::user();



        switch($status) {

            case 'submit_review': $db_status = 'review_pending';

                                  $msg_error = 'Some error has occured while submitting to review.';

                                  $msg_success = 'Profile submitted to review successfully!';

                                  break;

            case 'save_draft': $db_status = 'draft';

                                  $msg_error = 'Some error has occured while saving profile to draft.';

                                  $msg_success = 'Profile saved in draft successfully!';

                                  break;

        }



        $user = User::find($loggedinUser['id']);

        $user->status = $db_status;

        if(!$user->save()) {

            $response = array(

                        'type' => 'danger',

                        'msg'  => $msg_error,

                        );

            return Response::json($response);

        }

        

        if($status == 'submit_review'){



            $mail_data = array();

            $mail_data['adminDetails'] = $this->users->getAdminUser();

            $mail_data['professionalDetails'] = $this->professionals->getById($loggedinUser['id']);

            

            if(isset($mail_data['adminDetails']) && $mail_data['adminDetails'] !=''){

                MailService::sendEmailUserProfileForReview($mail_data);

            }

        }



        if($request->ajax()){

            $response = array(

                        'type' => 'success',

                        'msg'  => $msg_success,

                    );

            return Response::json($response);

        }else {

            $request->session()->flash('alert-success', $msg_success);

            return redirect('/profile/viewProfile');

        }

    }

    

    public function addFamilyDetail()

    {

        $postArr = Input::all();

        $rules = [

            'first_name'=> 'required',
            'last_name'=> 'required',
            'mobile' => 'required'

        ];

        $validator = Validator::make($postArr,$rules);

        if($validator->fails()) {            

            $errMsg = array();

            foreach($validator->messages()->getMessages() as $field_name => $messages) {                

                $errMsg = $messages;                

            }

            $response = array(

                    'type' => 'danger',

                    'msg' => 'Validation fails',

            );

            return Response::json($response);

        }

        else{

            if(Input::get('family_id') == 0){

                $family = new UserFamilyDetail();

                    

                }

                else{

                 $family = UserFamilyDetail::where('id',Input::get('family_id'))->first();



                }

                $date = \DateTime::createFromFormat("m-d-Y" , Input::get('birthday'));

               

                $family->user_id = Auth::user()->id;

                $family->first_name = Input::get('first_name');

                $family->last_name = Input::get('last_name');

                $family->email = Input::get('email');

                $family->mobile = Input::get('mobile');

                $family->gender = Input::get('gender');

                $family->emergency_contact = Input::get('emergency_contact');

                $family->relationship = Input::get('relationship');

                $family->birthday = $date->format('Y-m-d');

                $family->save();

                if(Input::get('family_id') == 0)

                $msg= 'Successfully added family members';

                else

                $msg='Successfully updated family members';


                $response = array(

                    'type' => 'success',

                    'msg' => $msg,

            );

            return Response::json($response);

        }

    }

    

    public function deleteFamily($family_id)

    {

        $count = UserFamilyDetail::where('user_id',Auth::user()->id)->where('id',$family_id)->count();

        if($count == 0){

            $response = array(

            'type' => 'danger',

            'msg'  => 'Made an invalid request',

            );

            return Response::json($response);

        }

        else{

            UserFamilyDetail::where('user_id',Auth::user()->id)->where('id',$family_id)->delete();

            $response = array(

                        'type' => 'success',

                        'msg'  => 'Family member deleted successfully',

                    );

            return Response::json($response);

        }

    }

    public function businessDelete($business_id)

    {

        $count = BusinessInformation::where('user_id',Auth::user()->id)->where('id',$business_id)->count();

        if($count == 0){

            $response = array(

            'type' => 'danger',

            'msg'  => 'Made an invalid request',

            );

            return Response::json($response);

        }

        else{

            BusinessInformation::where('user_id',Auth::user()->id)->where('id',$business_id)->delete();

            $response = array(

                        'type' => 'success',

                        'msg'  => 'Business detail deleted successfully',

                    );

            return Response::json($response);

        }

    }


	
    public function viewProfile(Request $request)
    {

        if (! Gate::allows('profile_view_access')) {
            $request->session()->flash('alert-danger', 'Access Restricted');
            return redirect('/');
        }

        $loggedinUser = Auth::user();



        $UserProfileDetail = $this->users->getUserProfileDetail($loggedinUser['id'],array('professional_detail','history','education','certification','service'));

        

        if(isset($UserProfileDetail['ProfessionalDetail']) && @count($UserProfileDetail['ProfessionalDetail']) > 0){

            $UserProfileDetail['ProfessionalDetail'] = UserProfessionalDetail::getFormedProfile($UserProfileDetail['ProfessionalDetail']);

        }

       

        $sports_names = $this->sports->getAllSportsNames();

        $approve = Evidents::where('user_id',$loggedinUser['id'])->get();

        $serviceType = Miscellaneous::businessType();

        $programType = Miscellaneous::programType();

        $programFor = Miscellaneous::programFor();

        $numberOfPeople = Miscellaneous::numberOfPeople();

        $ageRange = Miscellaneous::ageRange();

        $expLevel = Miscellaneous::expLevel();

        $serviceLocation = Miscellaneous::serviceLocation();

        $pFocuses = Miscellaneous::pFocuses();

        $duration = Miscellaneous::duration();

        $servicePriceOption = Miscellaneous::servicePriceOption();

        $specialDeals = Miscellaneous::specialDeals();


        if($loggedinUser['role']=='business' || $loggedinUser['role']=='professional' || $loggedinUser['role']=='admin'){

            $view='profiles.viewProfile';

        }

        elseif($loggedinUser['role']=='customer'){

            

            $view='profiles.viewProfileCustomer';

        }

        

        $family = UserFamilyDetail::where('user_id',Auth::user()->id)->get();

        $business_details = BusinessInformation::where('user_id',Auth::user()->id)->get();
       

        $user = User::where('id',Auth::user()->id)->first();

       

       $city = AddrCities::where('id',$user->city)->first();

       if(empty($city)){

           $UserProfileDetail['city'] = $user->city;;

       }

       else{

           $UserProfileDetail['city'] = $city->city_name;

       }

       $state = AddrStates::where('id',$user->state)->first();

       if(empty($state)){

           $UserProfileDetail['state'] = $user->state;;

       }

       else{

           $UserProfileDetail['state'] = $state->state_name;

       }

       $UserProfileDetail['country'] = $user->country;

       $firstCompany = CompanyInformation::where('user_id',Auth::user()->id)->first();

       $companies = CompanyInformation::where('user_id',Auth::user()->id)->get();

        return view($view, [

            'UserProfileDetail' => $UserProfileDetail,

            'firstCompany' => $firstCompany,

            'countries' => $this->users->getCountriesList(),

            'states' => $this->users->getStateList($UserProfileDetail['country']),

            'cities' => $this->users->getCityList($UserProfileDetail['state']),

            'phonecode' => Miscellaneous::getPhoneCode(),

            'sports_names' => $sports_names,

            'serviceType' => $serviceType,

            'programType' => $programType,

            'programFor' => $programFor,

            'numberOfPeople' => $numberOfPeople,

            'ageRange' => $ageRange,

            'expLevel' => $expLevel,

            'serviceLocation' => $serviceLocation,

            'pFocuses' => $pFocuses,

            'duration'=> $duration,

            'specialDeals' => $specialDeals,

            'servicePriceOption' => $servicePriceOption,

            'pageTitle' => "PROFILE",

            'approve'=>$approve,

            'family'=>$family,

            'business_details'=>$business_details,

            'companies'=>$companies

        ]);

    }

    

    public function companyDetail(Request $request){

        if($request->type){
            $type = $request->type;
        }

        else{
            $type=1;
        }

        if($request->type == 1){

            $data = BusinessInformation::where('user_id',Auth::user()->id)->where('company_name',$request->company_name)->first();

        }

        else{

            $data = User::where('id',Auth::user()->id)->where('company_name',$request->company_name)->first();

            $data['zip_code'] = $data['zipcode'];

        }

        if($data){

            $UserProfileDetail = $this->users->getUserProfileDetail($loggedinUser['id'],array('professional_detail','history','education','certification','service'));

        

                if(isset($UserProfileDetail['ProfessionalDetail']) && @count($UserProfileDetail['ProfessionalDetail']) > 0){

                    $UserProfileDetail['ProfessionalDetail'] = UserProfessionalDetail::getFormedProfile($UserProfileDetail['ProfessionalDetail']);

                }

               

                $sports_names = $this->sports->getAllSportsNames();

                $approve = Evidents::where('user_id',$loggedinUser['id'])->get();

                $serviceType = Miscellaneous::businessType();

                $programType = Miscellaneous::programType();

                $programFor = Miscellaneous::programFor();

                $numberOfPeople = Miscellaneous::numberOfPeople();

                $ageRange = Miscellaneous::ageRange();

                $expLevel = Miscellaneous::expLevel();

                $serviceLocation = Miscellaneous::serviceLocation();

                $pFocuses = Miscellaneous::pFocuses();

                $duration = Miscellaneous::duration();

                $servicePriceOption = Miscellaneous::servicePriceOption();

                $specialDeals = Miscellaneous::specialDeals();

            return view('profiles.companyView',[

                'data' => $data,

                'UserProfileDetail' => $UserProfileDetail,

            'countries' => $this->users->getCountriesList(),

            'states' => $this->users->getStateList($UserProfileDetail['country']),

            'cities' => $this->users->getCityList($UserProfileDetail['state']),

            'phonecode' => Miscellaneous::getPhoneCode(),

            'sports_names' => $sports_names,

            'serviceType' => $serviceType,

            'programType' => $programType,

            'programFor' => $programFor,

            'numberOfPeople' => $numberOfPeople,

            'ageRange' => $ageRange,

            'expLevel' => $expLevel,

            'serviceLocation' => $serviceLocation,

            'pFocuses' => $pFocuses,

            'duration'=> $duration,

            'specialDeals' => $specialDeals,

            'servicePriceOption' => $servicePriceOption,

            'approve'=>$approve,

            ]);

        }

        else

            return view('profiles.companyView')->with('error_msg','Invalid Request');

    }



    public function editProfilePicture(Request $request)

    {

        $validator =  Validator::make($request->all(),

                        [ 'profile_pic' => '|required|image|mimes:jpeg,jpg,png' ],

                        [ 'required' => 'The :attribute is required.' ]);



        if ($validator->fails()) {

            $errMsg = array();



            foreach($validator->messages()->getMessages() as $field_name => $messages) {                

                $errMsg = $messages;                

            }

            $response = array(

                    'type' => 'danger',

                    'msg' => $errMsg,

            );

            return Response::json($response);

        }

        $image = new Image();



        $request->profile_pic = '';

        if(!$request->hasFile('profile_pic')) {

            $response = array(

                'type' => 'danger',

                'msg'  => 'No image found to upload',

            );

        return Response::json($response);

        }



        $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR;



        $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;



        $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('profile_pic'),$file_upload_path,1,$thumb_upload_path,'415','354');



        if (!file_exists(public_path('uploads/profile_pic/thumb150'))) {

                mkdir(public_path('uploads/profile_pic/thumb150'), 0755, true);

        }

        $thumb_upload_path150 = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR;

        

        Image::make($request->file('profile_pic'))->resize(150, 150)->save($thumb_upload_path150 . $image_upload['filename']);



        $loggedinUser = Auth::user();

        $userObj = User::find($loggedinUser['id']); 

        

        if(isset($userObj->profile_pic))

        {

            @unlink(public_path('uploads/profile_pic/thumb150'). DIRECTORY_SEPARATOR . $userObj->profile_pic);

            @unlink(public_path('uploads/profile_pic/thumb'). DIRECTORY_SEPARATOR . $userObj->profile_pic);

            @unlink(public_path('uploads/profile_pic'). DIRECTORY_SEPARATOR . $userObj->profile_pic);

        }



        $userObj->profile_pic = $image_upload['filename'];

        if(!$userObj->save()) {

            $response = array(

                    'type' => 'danger',

                    'msg' => 'Some error while updating profile picture.',

            );

            return Response::json($response);

        }else {

            $image_path = asset('/images').'/'.'user.png';

            if($userObj->profile_pic != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.$userObj->profile_pic)) {

                $image_path = secure_asset('/public/uploads/profile_pic/thumb').'/'.$userObj->profile_pic;

            }

            $response = array(

                    'type' => 'success',

                    'msg' => 'Profile picture updated succesfully!',

                    'returndata' => array(

                        'profile_pic' => $image_path

                    )

            );

            return redirect()->back();

        }

    }



 public function editCompanyPicture(Request $request)

    {

        $validator =  Validator::make($request->all(),

                        [ 'profile_pic' => '|required|image|mimes:jpeg,jpg,png' ],

                        [ 'required' => 'The :attribute is required.' ]);



        if ($validator->fails()) {

            $errMsg = array();



            foreach($validator->messages()->getMessages() as $field_name => $messages) {                

                $errMsg = $messages;                

            }

            $response = array(

                    'type' => 'danger',

                    'msg' => $errMsg,

            );

            return Response::json($response);

        }

        $image = new Image();



        $request->profile_pic = '';

        if(!$request->hasFile('profile_pic')) {

            $response = array(

                'type' => 'danger',

                'msg'  => 'No image found to upload',

            );

        return Response::json($response);

        }

        

        



        $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR;



        $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;



        $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('profile_pic'),$file_upload_path,1,$thumb_upload_path,'415','354');



        if (!file_exists(public_path('uploads/profile_pic/thumb150'))) {

                mkdir(public_path('uploads/profile_pic/thumb150'), 0755, true);

        }

        $thumb_upload_path150 = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb150'.DIRECTORY_SEPARATOR;

        

        Image::make($request->file('profile_pic'))->resize(150, 150)->save($thumb_upload_path150 . $image_upload['filename']);



        $loggedinUser = Auth::user();

        $userObj = CompanyInformation::where('id',$request->company_id)->first(); 

        

        if(isset($userObj->logo))

        {

            @unlink(public_path('uploads/profile_pic/thumb150'). DIRECTORY_SEPARATOR . $userObj->logo);

            @unlink(public_path('uploads/profile_pic/thumb'). DIRECTORY_SEPARATOR . $userObj->logo);

            @unlink(public_path('uploads/profile_pic'). DIRECTORY_SEPARATOR . $userObj->logo);

        }



        $userObj->logo = $image_upload['filename'];

        if(!$userObj->save()) {

            $response = array(

                    'type' => 'danger',

                    'msg' => 'Some error while updating compay logo.',

            );

            return Response::json($response);

        }else {

            $image_path = asset('/images').'/'.'user.png';

            if($userObj->logo != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.$userObj->logo)) {

                $image_path = asset('/uploads/profile_pic/thumb').'/'.$userObj->logo;

            }

            $response = array(

                    'type' => 'success',

                    'msg' => 'Company updated succesfully!',

                    'returndata' => array(

                        'profile_pic' => $thumb_upload_path

                    )

            );

            return Response::json($response);

        }

    }



    public function editBannerPicture(Request $request)

    {

        $validator =  Validator::make($request->all(),

                        [ 'banner_image' => 'required|image|mimes:jpeg,jpg,png' ],

                        [ 'required' => 'The :attribute is required.' ]);

        if ($validator->fails()) {

            $errMsg = array();

            foreach($validator->messages()->getMessages() as $field_name => $messages) {                

                $errMsg = $messages;                

            }

            $response = array(

                    'type' => 'danger',

                    'msg' => $errMsg,

            );

            return Response::json($response);

        }


        $image = new Image();

        $request->banner_image = '';

        if(!$request->hasFile('banner_image')) {

            $response = array(

                'type' => 'danger',

                'msg'  => 'No image found to upload',

            );

        return Response::json($response);

        }



        $file = Input::file('banner_image');



        if (!file_exists(public_path('uploads/banner_image/thumb'))) {

                    mkdir(public_path('uploads/banner_image/thumb'), 0755, true);

        }



        $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'banner_image'.DIRECTORY_SEPARATOR;



        $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'banner_image'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;



        $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('banner_image'),$file_upload_path,1,$thumb_upload_path,'379','2000');

      

        $loggedinUser = Auth::user();

        if($loggedinUser['role'] == "customer")

        {

            $userObj = UserCustomerDetail::where('user_id',$loggedinUser['id'])->first();

        }

        if($loggedinUser['role'] == "business" || $loggedinUser['role'] == "professional")

        {

            $userObj = UserProfessionalDetail::where('user_id',$loggedinUser['id'])->first();

        }



        if(count($userObj) > 0)       

        {

            if($userObj->banner_image != '')

            {

                $bannerImage = public_path("/uploads/banner_image/{$userObj->banner_image}");

                $bannerThumbImage = public_path("/uploads/banner_image/thumb/{$userObj->banner_image}");

                if (File::exists($bannerImage) && File::exists($bannerThumbImage)) 

                {

                    unlink($bannerImage);

                    unlink($bannerThumbImage);

                }

            }



            $userObj->banner_image = $image_upload['filename'];

            $userObj->save();

        }

        else

        {

            if($loggedinUser['role'] == "customer")

            {

                $userObj = UserCustomerDetail::create([

                    'user_id' => $loggedinUser['id'],

                    'banner_image' => $image_upload['filename']

                ]);

            }

            if($loggedinUser['role'] == "business" || $loggedinUser['role'] == "professional")

            {

                $userObj = UserProfessionalDetail::create([

                    'user_id' => $loggedinUser['id'],

                    'banner_image' => $image_upload['filename']

                ]);

            }

        }

        if(!$userObj->save()) {

            $response = array(

                    'type' => 'danger',

                    'msg' => 'Some error while updating profile picture.',

            );

            return Response::json($response);

        }else {

            $image_path = asset('/images').'/'.'profile-banner.jpg';

            if($userObj->banner_image != '' && file_exists(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'banner_image'.DIRECTORY_SEPARATOR.$userObj->banner_image)) {

                $image_path = asset('/uploads/banner_image').'/'.$userObj->banner_image;

            }

            $response = array(

                    'type' => 'success',

                    'msg' => 'Banner image updated Succesfully!',

                    'returndata' => array(

                        'banner_image' => $image_path

                    )

            );

            return Response::json($response);

        }

    }



    public function editProfileDetail(Request $request)

    {

        if(Auth::user()->role == "business" || Auth::user()->role == "professional")

            { 

            $validator = $this->detailValidator($request->all());

            }

        else if(Auth::user()->role == "customer")

            {

            $validator = $this->detailValidatorForCustomer($request->all());

            }

        

        $nstate = AddrStates::where('state_name',$request->state)->first();

        $ncity = AddrCities::where('city_name',$request->city)->first();



        $loggedinUser = Auth::user();

        $userObj = User::find($loggedinUser['id']);        

        $userObj->company_name = $request->company_name;

        $userObj->firstname = $request->firstname;

        $userObj->lastname = $request->lastname;

         $userObj->username =  $request->username;

        $userObj->position = $request->position;

        $userObj->gender = $request->gender;

        $userObj->phone_number = $request->phone_number;

        $userObj->address = $request->address;

        $userObj->city = empty($ncity) ? 42687 : $ncity->id;

        $userObj->state = empty($nstate) ? 3920 : $nstate->id;

        $userObj->country = $request->country_dd;

        $userObj->zipcode = $request->zipcode;

        $userObj->intro = $request->intro;


        $latlongdata = Miscellaneous::getLatLong($request->zipcode);

        $userObj->latitude = $latlongdata['lat'];

        $userObj->longitude= $latlongdata['long'];

        if(!$userObj->save()) {

            $response = array(

                    'type' => 'danger',

                    'msg' => 'Some error while updating profile.',

            );

            return Response::json($response);

        }

        else 

        {

            if(isset($request->about_me) && ($loggedinUser['role'] == "business" || $loggedinUser['role'] == "professional"))

            {

                $professional_detail = UserProfessionalDetail::where('user_id', $loggedinUser['id'])->first();



                $professional_detail->about_me = $request->about_me;

                $professional_detail->about_business = $request->about_business;

                 $professional_detail->save();

            }

            if(isset($request->about_me) && $loggedinUser['role'] == "customer")

            {

                $customer_detail = UserCustomerDetail::where('user_id', $loggedinUser['id'])->first();

                if($customer_detail != [] &&  $customer_detail != '')       

                {

                    $customer_detail->about_me = $request->about_me;

                    $customer_detail->intro = $request->intro;

                    $customer_detail->save();

                }

                else

                {

                    $customer_detail = UserCustomerDetail::create([

                        'user_id' => $loggedinUser['id'],

                        'about_me' => $request->about_me

                    ]);

                }

            }


            $response = array(

                'type' => 'success',

                'msg' => 'Profile updated succesfully!'

            );

            return Response::json($response);

        }

    }



    public function editProfileHistory()

    {

        if (! Gate::allows('profile_edit_access')) {

            return redirect('/profile/viewProfile');

        }

        

        $loggedinUser = Auth::user();

        $sports = $this->sports->getAlphabetsWiseSportsNames();

        $sports_names = $this->sports->getAllSportsNames(1);



        $sport_dd = array();

        $sports_select = '';

        $sport_dd[""] = "Choose a Sport/Activity";

        $UserProfileDetail =  $this->users->getUserProfileDetail($loggedinUser['id'], array('professional_detail','history', 'education', 'certification', 'service','skill'));

        $service = $UserProfileDetail['service'];

          $service = @$service[0]['sport'];

        if($sports){

            $sports_select .= "<option value=''>Choose a Sport/Activity</option>";

            foreach ($sports as $key => $value) {

                foreach ($value as $key1 => $value1) {

                    if(count($value1->child)){

                        $sports_select .= "<optgroup label='".$value1->title."'>";

                        foreach ($value1->child as $key2 => $value2) {

                            $selected =null;
                        
                            $sports_select .= "<option value='".$key2."' ".$selected." >".$value2."</option>";

                        }

                        $sports_select .= "</optgroup>";

                    } else {

                        $selected = null;

                        $sports_select .= "<option value='".$value1->value."' ".$selected.">".$value1->title."</option>";

                    }

                }

            }

        }



        $businessType = Miscellaneous::businessType();

        $programType = Miscellaneous::programType();

        $programFor = Miscellaneous::programFor();

        $numberOfPeople = Miscellaneous::numberOfPeople();

        $ageRange = Miscellaneous::ageRange();

        $expLevel = Miscellaneous::expLevel();

        $serviceLocation = Miscellaneous::serviceLocation();

        $pFocuses = Miscellaneous::pFocuses();

        $duration = Miscellaneous::duration();

        $servicePriceOption = Miscellaneous::servicePriceOption();

        $specialDeals = Miscellaneous::specialDeals();

        $activity = Miscellaneous::activity();

        $teaching = Miscellaneous::teaching();

        $languages = Miscellaneous::getLanguages();

        $timeSlots = Miscellaneous::getTimeSlot();



        return view('profiles.editBusinessProfile', [

            'UserProfileDetail' =>$UserProfileDetail,

            'sports_select' => $sports_select,

            'sport_dd' => $sport_dd + $sports_names,

            'businessType' => $businessType,

            'activity'=>$activity,

            'programType' => $programType,

            'programFor' => $programFor,

            'teaching' => $teaching,

            'numberOfPeople' => $numberOfPeople,

            'ageRange' => $ageRange,

            'expLevel' => $expLevel,

            'serviceLocation' => $serviceLocation,

            'pFocuses' => $pFocuses,

            'duration'=> $duration,

            'specialDeals' => $specialDeals,

            'servicePriceOption' => $servicePriceOption,

            'pageTitle' => "COMPLETE PROFILE",

            'allLanguages' => $languages,

            'timeSlots' => $timeSlots,

            'mydetails' =>User::find($loggedinUser['id'])     

        ]);

    }

    public function getlanguage(Request $r){

        

        $languages = DB::table('languages')->where('name','like','%'.$r->lang.'%')->get();

        

        return response()->json($languages);

        

    }

    public function saveEditedProfileHistory(Request $request)
    {
    
        $loggedinUser = Auth::user();
        $update = array(

            'experience_level'=>json_encode($request->experience_level,JSON_FORCE_OBJECT),

            'train_to'=>json_encode($request->train_to,JSON_FORCE_OBJECT),

            'personality'=>json_encode($request->personality,JSON_FORCE_OBJECT),

            'availability'=>json_encode(json_encode($request->availability)),

            'languages'=>json_encode($request->languages,JSON_FORCE_OBJECT),

            'skill_lavel'=>json_encode($request->skill_lavel,JSON_FORCE_OBJECT),

            'medical_states'=>$request->medical_states,

            'medical_type'=>json_encode($request->medical_type,JSON_FORCE_OBJECT),

            'work_locations'=>json_encode($request->work_locations,JSON_FORCE_OBJECT),

            'goals_states'=>$request->fitness_goals,

            'goals_option'=>json_encode($request->goals_option,JSON_FORCE_OBJECT),

            'hours'=>$request->hours_opt,

            'timezone'=>$request->timezone,

            'special_days_off'=>$request->special_days_off,

            'notice_each_book'=>'{"'.$request->notice_each_book_day.'":"'.$request->notice_each_book_ans.'"}',

            'advance_book'=>'{"'.$request->advance_book_day.'":"'.$request->advance_book_ans.'"}',

            'willing_to_travel'=>$request->willing_to_travel,

            'travel_miles'=>$request->travel_miles,

            'travel_times'=>NULL

            );

        $g = UserProfessionalDetail::where('company_id',$request->company_id)->where('user_id',Auth::user()->id)->first();

           $db =  DB::table('user_professional_details')

            ->where('id',$g->id)

            ->update($update);

            

        $co = CompanyInformation::where('id',$request->company_id)->first();

        $co->email = $request->emailb;

        $co->first_name = $request->firstnameb;

        $co->last_name = $request->lastnameb;

        $co->contact_number = $request->phone_number;

        $co->company_name = $request->Companyname;

        $co->ein_number = $request->b_EINnumber;

        $co->establishment_year = $request->b_Establishmentyear;

        $co->about_company = $request->about_company;

        $co->short_description = $request->b_shortDescription;

        $co->address = $request->address;

        $co->city = $request->city;

        $co->state = $request->state;

        $co->country = $request->country;

        $co->zip_code = $request->zip_code;

        $co->latitude = $request->latitude;

        $co->longitude = $request->longitude;

        $co->save();


        $request->session()->flash('alert-success', 'Profile saved successfully!');

         return redirect('manage/company');

    }

    public function getStateList(Request $request)

    {

        $states = $this->users->getStateList($request->country_code);

        return response()->json($states);

    }

    public function getCityList(Request $request)

    {

        $cities = $this->users->getCityList($request->state_id);

        return response()->json($cities);

    }



    

    public function showSportAlertbox()

    {

        return view('profiles.sportAlertbox');

    }


    public function regenerateImages(){

      $dir = public_path('uploads/profile_pic');

      $thumbsDir = public_path('uploads/profile_pic/thumb150');

      

        if($this->users->thumbResize($dir, $thumbsDir)){

          return redirect('/')->with('alert-success', 'Images resize successfully');

        }

    }



    public function editservicedetail(Request $request)

    {

        $input = $request->hours;


        if($request->hasFile('frm_profile_pic'))

        {

            $file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'service_profile_pic'.DIRECTORY_SEPARATOR;



            $thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'service_profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;



            $image_upload = Miscellaneous::saveFileAndThumbnail($request->file('frm_profile_pic'),$file_upload_path,1,$thumb_upload_path,'247','266');



            $image_name = $image_upload['filename'];

        }

        else

        {

            $image_name = $request->old_profile_pic;

        } 


            $loggedinUser = Auth::user();

        

            $available_dates = [];

            $dateee = \DateTime::createFromFormat("m-d-Y" , $request->starting_date);

            $request->starting_date = $dateee->format('Y-m-d');

            if($request->class_meets == 'Weekly'){                

                $this->arr = [];

                $day_arr = json_decode($request->serv_time_slot);

                foreach($day_arr as $value){

                if($value->sunday_start != ''){

                   $sdate = date('Y-m-d', strtotime('next Sunday', strtotime($request->starting_date)));

                   $this->mydate($sdate,$request->end_date);

                }

                if($value->monday_start != ''){

                   $sdate = date('Y-m-d', strtotime('next Monday', strtotime($request->starting_date)));

                   $this->mydate($sdate,$request->end_date);

                }

                if($value->tuesday_start != ''){

                   $sdate = date('Y-m-d', strtotime('next Tuesday', strtotime($request->starting_date)));

                   $this->mydate($sdate,$request->end_date);

                }

                if($value->wednesday_start != ''){

                   $sdate = date('Y-m-d', strtotime('next Wednesday', strtotime($request->starting_date)));

                   $this->mydate($sdate,$request->end_date);

                }

                if($value->thrusday_start != ''){

                   $sdate = date('Y-m-d', strtotime('next Thrusday', strtotime($request->starting_date)));

                   $this->mydate($sdate,$request->end_date);

                }

                if($value->friday_start != ''){

                   $sdate = date('Y-m-d', strtotime('next Friday', strtotime($request->starting_date)));

                   $this->mydate($sdate,$request->end_date);

                }

                if($value->saturday_start != ''){

                   $sdate = date('Y-m-d', strtotime('next Saturday', strtotime($request->starting_date)));

                   $this->mydate($sdate,$request->end_date);

                }

                }

                

               

               $available_dates = $this->arr; 

                Log::info($available_dates);

            }

            else{

                $this->arr = [$request->starting_date];

                $available_dates = $this->arr;

            }



        $inserted = array(

            'user_id' => $loggedinUser['id'],

            'image'=> $image_name,

            'sport' => $request->frm_servicesport,

            'title' => $request->frm_servicetitle,

            'price' => $request->frm_serviceprice,

            'timeslot_from' => $request->frm_servicetimeslotfrom,

            'timeslot_to' => $request->frm_servicetimeslotto,

            'servicedesc' => $request->frm_servicedesc,

            'servicetype' => json_encode($request->frm_servicetype,JSON_FORCE_OBJECT),

            'programtype' => $request->frm_programtype,

            'agerange' => json_encode($request->frm_agerange,JSON_FORCE_OBJECT),

            'programfor' => json_encode($request->frm_programfor,JSON_FORCE_OBJECT),

            'numberofpeople' => json_encode($request->frm_numberofpeople,JSON_FORCE_OBJECT),

            'experience_level' => json_encode($request->frm_experience_level,JSON_FORCE_OBJECT),

            'servicelocation' => json_encode($request->frm_servicelocation,JSON_FORCE_OBJECT),

            'focuses' => json_encode($request->frm_servicefocuses,JSON_FORCE_OBJECT),

            'specialdeals' => json_encode($request->frm_specialdeals,JSON_FORCE_OBJECT),

            'servicepriceoption' => json_encode($request->frm_servicepriceoption,JSON_FORCE_OBJECT),

            'duration' => $request->frm_serviceduration,

            'terms_conditions' => $request->termcondfaqtext,

            "expire_days"=>$request->expire_days,

            "expire_in_option"=>$request->expire_in_option1,

            "expire_in_option2"=>$request->expire_in_option2,

            "sessions"=>$request->sessions,

            "multiple_count"=>$request->multiple_count,

            "recurring_pay"=>$request->recurring_pay,

            "introoffer"=>$request->introoffer,

            "runautopay"=>$request->runautopay,

            "often"=>$request->often,

            "often_every_op1"=>$request->often_every_op1,

            "often_every_op2"=>$request->often_every_op2,

            "numberofpays"=>$request->numberofpays,

            "chargeclients"=>$request->chargeclients,

            "termcondfaq"=>$request->termcondfaq,

            'terms_conditions' => $request->termcondfaqtext,

            "contractterms"=>$request->contractterms,

            "contracttermstext"=>$request->contracttermstext,

            "liability"=>$request->liability,

            "liabilitytext"=>$request->liabilitytext,

            "setupprice"=>$request->setupprice,

            "offerpro_states"=>$request->offerpro_states,

            "activitydesignsfor"=>json_encode($request->activitydesignsfor,JSON_FORCE_OBJECT),

            "activitytype"=>json_encode($request->activitytype,JSON_FORCE_OBJECT),

            "frm_teachingstyle"=>json_encode($request->frm_teachingstyle,JSON_FORCE_OBJECT),

            "salestax"=>$request->salestax,

            "after_drop"=>$request->after_drop,

            "salestaxpercentage"=>$request->salestaxpercentage,

            "duestax"=>$request->duestax,

            "duestaxpercentage"=>$request->duestaxpercentage,

            'serv_time_slot'=>$request->serv_time_slot,

            'class_meets'=>$request->class_meets,

            'starting_date'=>$request->starting_date,

            'end_date'=>$request->end_date,

            'available_dates'=>json_encode($available_dates),

            'schedule_until'=>$request->schedule_until,

            "covid"=>1,

            "covidtext"=>$request->covidtext,

        );

        

        if($request->company_id){

            $new_array = array('company_id'=>$request->company_id);
            $inserted=array_merge($inserted, $new_array);

        }

       

        if($request->editservice_id > 0)
        {

            $serviceObj = DB::table('user_services')

                            ->where('id',$request->editservice_id)

                            ->update($inserted);

            $msg = "Service Updated successfully!";

        }

        else

        {

            $serviceObj = DB::table('user_services')

                            ->insert($inserted);

            $msg = "Service saved successfully!";

        }

       return $response = array(

                'type' => 'success',

                'msg'  => $msg,

                'image_name' => $image_name

            );
    }



    protected function validator($data,$check)

    { 

        $rules = [            

            "user_id"=> "required", "sport"=> "required", "title"=> "required", "price"=> "required", "servicedesc"=> "required", "servicetype"=> "required", "programtype"=> "required", "agerange"=> "required", "programfor"=> "required", "numberofpeople"=> "required", "experience_level"=> "required", "servicelocation"=> "required", "focuses"=> "required", "specialdeals"=> "required", "servicepriceoption"=> "required", "duration"=> "required", "terms_conditions"=> "required", "expire_days"=> "required", "expire_in_option"=> "required", "expire_in_option2"=> "required", "sessions"=> "required", "multiple_count"=> "required", "recurring_pay"=> "required", "introoffer"=> "required", "runautopay"=> "required", "often"=> "required", "often_every_op1"=> "required", "often_every_op2"=> "required", "numberofpays"=> "required", "chargeclients"=> "required", "termcondfaq"=> "required", "contractterms"=> "required", "contracttermstext"=> "required", "liability"=> "required", "liabilitytext"=> "required", "setupprice"=> "required", "offerpro_states"=> "required", "activitydesignsfor"=> "required", "activitytype"=> "required", "frm_teachingstyle"=> "required"

        ];



        $message = [

            'frm_servicesport.required' => 'Sport is required',

            'frm_servicetitle.required' => 'Title is required',

            'frm_serviceprice.required' => 'Price is required',

            'frm_servicedesc.required' => 'Description is required',

            'frm_servicetype.required' => 'Service Type is required',

            'frm_programtype.required' => 'Program Type is required',

            'frm_agerange.required' => 'Age-Range is required',

            'frm_programfor.required' => 'Program is required',

            'frm_numberofpeople.required' => 'Number of People is required',

            'frm_experience_level.required' => 'Experience Level is required',

            'frm_servicelocation.required' => 'Place is required',

            'frm_servicefocuses.required' => 'Focuses is required',

            'frm_specialdeals.required' => 'Special Deals is required',

            'frm_servicepriceoption.required' => 'Price Options is required',

            'frm_serviceduration.required' => 'Duration is required',

            'frm_tcdesc.required' => 'Terms and Conditions is required',

            'frm_profile_pic.required' =>'Service pic is required'

        ];



        if($check == 'true')

        {

            $rules['frm_profile_pic'] = 'required|image|mimes:jpeg,jpg,bmp,png|max:750';

        }

        return Validator::make($data, $rules,$message);

    } 



    public function get_serviceform($id=null){

        $loggedinUser = Auth::user();

        $sports = $this->sports->getAlphabetsWiseSportsNames();

        $sports_names = $this->sports->getAllSportsNames(1);



        $sport_dd = array();

        $sports_select = '';

        $sport_dd[""] = "Choose a Sport/Activity";

        $UserProfileDetail =  $this->users->getUserProfileDetail($loggedinUser['id'], array('professional_detail','history', 'education', 'certification', 'service'));

        $service = UserService::where('id',$id)->get();

    if(count($service) != 0){

          $service_c = @$service[0]['sport'];

          $image = $service[0]['image'];

    }

    else{

        $service_c = '';

        $image = null;

    }

        if($sports){

            $sports_select .= "<option value=''>Choose a Sport/Activity</option>";

            foreach ($sports as $key => $value) {

                foreach ($value as $key1 => $value1) {

                    if(count($value1->child)){

                        $sports_select .= "<optgroup label='".$value1->title."'>";

                        foreach ($value1->child as $key2 => $value2) {

                            $selected =($service_c==$key2)?"selected":"";

                            $sports_select .= "<option value='".$key2."' ".$selected." >".$value2."</option>";

                        }

                        $sports_select .= "</optgroup>";

                    } else {

                        $selected = ($service_c==$value1->value)?"selected":"";

                        $sports_select .= "<option value='".$value1->value."' ".$selected.">".$value1->title."</option>";

                    }

                }

            }

        }

        

        $businessType = Miscellaneous::businessType();

        $programType = Miscellaneous::programType();

        $programFor = Miscellaneous::programFor();

        $numberOfPeople = Miscellaneous::numberOfPeople();

        $ageRange = Miscellaneous::ageRange();

        $expLevel = Miscellaneous::expLevel();

        $serviceLocation = Miscellaneous::serviceLocation();

        $pFocuses = Miscellaneous::pFocuses();

        $duration = Miscellaneous::duration();

        $servicePriceOption = Miscellaneous::servicePriceOption();

        $specialDeals = Miscellaneous::specialDeals();

        $activity = Miscellaneous::activity();

        $teaching = Miscellaneous::teaching();

        $languages = Miscellaneous::getLanguages();

        $timeSlots = Miscellaneous::getTimeSlot();



        return view('profiles.servicepopup', [

            'service'=>$service,

            'image'=>$image,

            'UserProfileDetail' =>$UserProfileDetail,

            'sports_select' => $sports_select,

            'sport_dd' => $sport_dd + $sports_names,

            'businessType' => $businessType,

            'activity'=>$activity,

            'programType' => $programType,

            'programFor' => $programFor,

            'teaching' => $teaching,

            'numberOfPeople' => $numberOfPeople,

            'ageRange' => $ageRange,

            'expLevel' => $expLevel,

            'serviceLocation' => $serviceLocation,

            'pFocuses' => $pFocuses,

            'duration'=> $duration,

            'specialDeals' => $specialDeals,

            'servicePriceOption' => $servicePriceOption,

            'pageTitle' => "COMPLETE PROFILE",

            'allLanguages' => $languages,

            'timeSlots' => $timeSlots,

            'mydetails' =>User::find($loggedinUser['id'])]);  

    }

    

    public function get_serviceform2($id=null){

        $loggedinUser = Auth::user();

        $sports = $this->sports->getAlphabetsWiseSportsNames();

        $sports_names = $this->sports->getAllSportsNames(1);



        $sport_dd = array();

        $sports_select = '';

        $sport_dd[""] = "Choose a Sport/Activity";

        $UserProfileDetail =  $this->users->getUserProfileDetail($loggedinUser['id'], array('professional_detail','history', 'education', 'certification', 'service'));

        $service = UserService::where('id',$id)->get();


    if(count($service) != 0){

          $service_c = @$service[0]['sport'];

          $image = $service[0]['image'];

    }

    else{

        $service_c = '';

        $image = null;

    }

        if($sports){

            $sports_select .= "<option value=''>Choose a Sport/Activity</option>";

            foreach ($sports as $key => $value) {

                foreach ($value as $key1 => $value1) {

                    if(count($value1->child)){

                        $sports_select .= "<optgroup label='".$value1->title."'>";

                        foreach ($value1->child as $key2 => $value2) {

                            $selected =($service_c==$key2)?"selected":"";

                            $sports_select .= "<option value='".$key2."' ".$selected." >".$value2."</option>";

                        }

                        $sports_select .= "</optgroup>";

                    } else {

                        $selected = ($service_c==$value1->value)?"selected":"";

                        $sports_select .= "<option value='".$value1->value."' ".$selected.">".$value1->title."</option>";

                    }

                }

            }

        }

        

        $businessType = Miscellaneous::businessType();

        $programType = Miscellaneous::programType();

        $programFor = Miscellaneous::programFor();

        $numberOfPeople = Miscellaneous::numberOfPeople();

        $ageRange = Miscellaneous::ageRange();

        $expLevel = Miscellaneous::expLevel();

        $serviceLocation = Miscellaneous::serviceLocation();

        $pFocuses = Miscellaneous::pFocuses();

        $duration = Miscellaneous::duration();

        $servicePriceOption = Miscellaneous::servicePriceOption();

        $specialDeals = Miscellaneous::specialDeals();

        $activity = Miscellaneous::activity();

        $teaching = Miscellaneous::teaching();

        $languages = Miscellaneous::getLanguages();

        $timeSlots = Miscellaneous::getTimeSlot();



        return view('profiles.newservicepopup', [

            'service'=>$service,

            'image'=>$image,

            'UserProfileDetail' =>$UserProfileDetail,

            'sports_select' => $sports_select,

            'sport_dd' => $sport_dd + $sports_names,

            'businessType' => $businessType,

            'activity'=>$activity,

            'programType' => $programType,

            'programFor' => $programFor,

            'teaching' => $teaching,

            'numberOfPeople' => $numberOfPeople,

            'ageRange' => $ageRange,

            'expLevel' => $expLevel,

            'serviceLocation' => $serviceLocation,

            'pFocuses' => $pFocuses,

            'duration'=> $duration,

            'specialDeals' => $specialDeals,

            'servicePriceOption' => $servicePriceOption,

            'pageTitle' => "COMPLETE PROFILE",

            'allLanguages' => $languages,

            'timeSlots' => $timeSlots,

            'mydetails' =>User::find($loggedinUser['id'])]);  

    }

    

     public function get_serviceform1($id=null){

        $loggedinUser = Auth::user();

        $sports = $this->sports->getAlphabetsWiseSportsNames();

        $sports_names = $this->sports->getAllSportsNames(1);



        $sport_dd = array();

        $sports_select = '';

        $sport_dd[""] = "Choose a Sport/Activity";

        $UserProfileDetail =  $this->users->getUserProfileDetail($loggedinUser['id'], array('professional_detail','history', 'education', 'certification', 'service'));

        $service = UserService::where('id',$id)->get();

    if(count($service) != 0){

          $service_c = @$service[0]['sport'];

          $image = $service[0]['image'];

    }

    else{

        $service_c = '';

        $image = null;

    }

        if($sports){

            $sports_select .= "<option value=''>Choose a Sport/Activity</option>";

            foreach ($sports as $key => $value) {

                foreach ($value as $key1 => $value1) {

                    if(count($value1->child)){

                        $sports_select .= "<optgroup label='".$value1->title."'>";

                        foreach ($value1->child as $key2 => $value2) {

                            $selected =($service_c==$key2)?"selected":"";

                            $sports_select .= "<option value='".$key2."' ".$selected." >".$value2."</option>";

                        }

                        $sports_select .= "</optgroup>";

                    } else {

                        $selected = ($service_c==$value1->value)?"selected":"";

                        $sports_select .= "<option value='".$value1->value."' ".$selected.">".$value1->title."</option>";

                    }

                }

            }

        }

        

        $businessType = Miscellaneous::businessType();

        $programType = Miscellaneous::programType();

        $programFor = Miscellaneous::programFor();

        $numberOfPeople = Miscellaneous::numberOfPeople();

        $ageRange = Miscellaneous::ageRange();

        $expLevel = Miscellaneous::expLevel();

        $serviceLocation = Miscellaneous::serviceLocation();

        $pFocuses = Miscellaneous::pFocuses();

        $duration = Miscellaneous::duration();

        $servicePriceOption = Miscellaneous::servicePriceOption();

        $specialDeals = Miscellaneous::specialDeals();

        $activity = Miscellaneous::activity();

        $teaching = Miscellaneous::teaching();

        $languages = Miscellaneous::getLanguages();

        $timeSlots = Miscellaneous::getTimeSlot();



        return view('profiles.create_service', [

            'service'=>$service,

            'image'=>$image,

            'UserProfileDetail' =>$UserProfileDetail,

            'sports_select' => $sports_select,

            'sport_dd' => $sport_dd + $sports_names,

            'businessType' => $businessType,

            'activity'=>$activity,

            'programType' => $programType,

            'programFor' => $programFor,

            'teaching' => $teaching,

            'numberOfPeople' => $numberOfPeople,

            'ageRange' => $ageRange,

            'expLevel' => $expLevel,

            'serviceLocation' => $serviceLocation,

            'pFocuses' => $pFocuses,

            'duration'=> $duration,

            'specialDeals' => $specialDeals,

            'servicePriceOption' => $servicePriceOption,

            'pageTitle' => "COMPLETE PROFILE",

            'allLanguages' => $languages,

            'timeSlots' => $timeSlots,

            'mydetails' =>User::find($loggedinUser['id'])]);  

    }

    

    public function getmyservices(Request $request){

        

        $login_id = Auth::user();

        $sports = $this->sports->getAlphabetsWiseSportsNames();

        $sports_names = $this->sports->getAllSportsNames(1);

        $sport_dd = array();

        $sports_select = '';

        $sport_dd[""] = "Choose a Sport/Activity";

        if($request->company_id){

            $service = UserService::where('user_id',$login_id['id'])->where('company_id',$request->company_id)->get();

        }

        else{

            $service = UserService::where('user_id',$login_id['id'])->get();

        }

        

        return view('profiles.myservices', [

            'myservice'=>$service,

            'sport_dd' => $sport_dd + $sports_names

        ]

        );  

    }



    public function evident(){

        $loggedinUser = Auth::user();

        $dd = DB::select('select * from user_evident where user_id = "'.$loggedinUser["id"].'"');

        $check = false;

        $d='';

        if(@$dd[0]->status==1){

            $d = "Your request is Approve";

            $check = true;

        }

        if(count($dd)>0){

            $evidentstatus = json_decode(Evident::request_id($dd[0]->evident_id));

          

             if($evidentstatus->attributes[0]->status=='pending'){

                $d = 'Your request is under processing';

                

            }else{

                Evidents::where('id',$dd[0]->id)->update(['status'=>1]);

                $d = 'Your request is Approve';

                $check = true;

            }

        

        }

        

        return view('profiles.evident',compact('d','check'));

    }

    public function evidentdata(Request $r){

        $input = $r->all();

          $verifydata= array(

            "email"=> Auth::user()['email'],

            "summary"=> "Basic Background Check Test",

            "description"=> "This is a test of the Evident ID API. The description goes into the email body",

            "userAuthenticationType"=> "blindtrust",

            "attributesRequested"=>[array("attributeType"=>"background.criminal.profile.standard_basic")]

        );

        $submitdata = array(

            "inputs"=>

            [array(

                "type"=>"core.ssn",

                "value"=>$r->ssn

            ),

            array(

                "type"=> "core.dateofbirth",

                "value"=>array (

                  "objectType"=> "date",

                  "year"=> date('Y',strtotime($r->dateofbirth)),

                  "day"=> date('d',strtotime($r->dateofbirth)),

                  "month"=> date('m',strtotime($r->dateofbirth))

                )

            ),

            array(

                "type"=> "core.fullname",

                "value"=> array(

                "objectType"=> "Name",

                "prefix"=> null,

                "first"=> $r->name,

                "middle"=> null,

                "last"=> $r->lastname,

                "suffix"=> null

                )

                ),

                array(

                    "type"=> "consent.fcra.reviewed_disclosure",

                    "value"=> true

                ),

                array(

                    "type"=> "consent.fcra.authorized",

                    "value"=> true

                ),

                array(

                    "type"=> "consent.fcra.requested_free_copy_state",

                    "value"=> true

                )

            ]);

            

            

            

            $s= Evident::curl_verify(json_encode($verifydata));

            $s = json_decode($s,JSON_OBJECT_AS_ARRAY);



            $login_id = Auth::user();

            $savedata = array(

                'user_id'=>$login_id['id'],

                'userIdentityToken'=>$s['userIdentityToken'],

                'idOwnerId'=>$s['idOwnerId'],

                'evident_id'=>$s['id'],

                'other_data'=>json_encode($submitdata),

                'business_email'=>Auth::user()['email']

            );

            $save = Evidents::create($savedata);

            if($save){

                echo Evident::curl_submit(json_encode($submitdata));

            }

            

    }

    

	public function bookinginfo()

	{
		$user = User::where('id',Auth::user()->id)->first();
	  	$city = AddrCities::where('id',$user->city)->first();
       	$UserProfileDetail['firstname'] = $user->firstname;
		$UserProfileDetail['lastname'] = $user->lastname;
		$UserProfileDetail['gender'] = $user->gender;
		$UserProfileDetail['username'] = $user->username;
		$UserProfileDetail['phone_number'] = $user->phone_number;
		$UserProfileDetail['address'] = $user->address;
		$UserProfileDetail['quick_intro'] = $user->quick_intro;
		$UserProfileDetail['birthdate'] = date('m d,Y',strtotime($user->birthdate));
		$UserProfileDetail['email'] = $user->email;
		$UserProfileDetail['favorit_activity'] = $user->favorit_activity;
		$UserProfileDetail['email'] = $user->email;
		
		$UserProfileDetail['cover_photo'] =$user->cover_photo;
       if(empty($city)){
           $UserProfileDetail['city'] = $user->city;;
       }
       else{
           $UserProfileDetail['city'] = $city->city_name;
       }
       $state = AddrStates::where('id',$user->state)->first();
       if(empty($state)){
           $UserProfileDetail['state'] = $user->state;;
       }
       else{
           $UserProfileDetail['state'] = $state->state_name;
       }
       $UserProfileDetail['country'] = $user->country;

		return view('personal-profile.booking-info', ['UserProfileDetail' => $UserProfileDetail]);

	}

	public function calendar(Request $request)

	{
    $user = User::where('id',Auth::user()->id)->first();
      $city = AddrCities::where('id',$user->city)->first();
        $UserProfileDetail['firstname'] = $user->firstname;
    $UserProfileDetail['lastname'] = $user->lastname;
    $UserProfileDetail['gender'] = $user->gender;
    $UserProfileDetail['username'] = $user->username;
    $UserProfileDetail['phone_number'] = $user->phone_number;
    $UserProfileDetail['address'] = $user->address;
    $UserProfileDetail['quick_intro'] = $user->quick_intro;
    $UserProfileDetail['birthdate'] = date('m d,Y',strtotime($user->birthdate));
    $UserProfileDetail['email'] = $user->email;
    $UserProfileDetail['favorit_activity'] = $user->favorit_activity;
    $UserProfileDetail['email'] = $user->email;
    
    $UserProfileDetail['cover_photo'] =$user->cover_photo;
       if(empty($city)){
           $UserProfileDetail['city'] = $user->city;;
       }
       else{
           $UserProfileDetail['city'] = $city->city_name;
       }
       $state = AddrStates::where('id',$user->state)->first();
       if(empty($state)){
           $UserProfileDetail['state'] = $user->state;;
       }
       else{
           $UserProfileDetail['state'] = $state->state_name;
       }
       $UserProfileDetail['country'] = $user->country;

		if($request->ajax()) 
    {
      $data = Event::whereDate('start', '>=', $request->start)
      ->whereDate('end','<=',$request->end)
      ->get(['id', 'title', 'start', 'end']);
      return response()->json($data);
    }
    return view('personal-profile.calendar', ['UserProfileDetail' => $UserProfileDetail]);
	}
  public function cajax(Request $request)
  {
    switch ($request->type) {
      case 'add':
      $event = Event::create([
        'title' => $request->title,
        'start' => $request->start,
        'end' => $request->end,

      ]);
      return response()->json($event);
      break;

      case 'update':
      $event = Event::find($request->id)->update([
        'title' => $request->title,
        'start' => $request->start,
        'end' => $request->end,
      ]);
      return response()->json($event);
      break;

      case 'delete':
      $event = Event::find($request->id)->delete();
      return response()->json($event);
      break;
      
      default:
      break;
    }
  }

	public function favorite()

	{

		$user = User::where('id',Auth::user()->id)->first();
	  	$city = AddrCities::where('id',$user->city)->first();
       	$UserProfileDetail['firstname'] = $user->firstname;
		$UserProfileDetail['lastname'] = $user->lastname;
		$UserProfileDetail['gender'] = $user->gender;
		$UserProfileDetail['username'] = $user->username;
		$UserProfileDetail['phone_number'] = $user->phone_number;
		$UserProfileDetail['address'] = $user->address;
		$UserProfileDetail['quick_intro'] = $user->quick_intro;
		$UserProfileDetail['birthdate'] = date('m d,Y',strtotime($user->birthdate));
		$UserProfileDetail['email'] = $user->email;
		$UserProfileDetail['favorit_activity'] = $user->favorit_activity;
		$UserProfileDetail['email'] = $user->email;
		
		$UserProfileDetail['cover_photo'] =$user->cover_photo;
       if(empty($city)){
           $UserProfileDetail['city'] = $user->city;;
       }
       else{
           $UserProfileDetail['city'] = $city->city_name;
       }
       $state = AddrStates::where('id',$user->state)->first();
       if(empty($state)){
           $UserProfileDetail['state'] = $user->state;;
       }
       else{
           $UserProfileDetail['state'] = $state->state_name;
       }
       $UserProfileDetail['country'] = $user->country;

      $follow = UserFavourite::select("company_informations.company_name", "company_informations.first_name", "company_informations.last_name", "company_informations.id","company_informations.logo","company_informations.address","company_informations.contact_number","users_favourite.favourite_user_id","users_favourite.user_id","company_informations.user_id")
      ->join("company_informations", "users_favourite.favourite_user_id", "=", "company_informations.id")
      ->where("users_favourite.user_id", Auth::user()->id)
      ->get();


      $FavDetail = $follow;
	   return view('personal-profile.favorite', ['UserProfileDetail' => $UserProfileDetail, 'FavDetail' => $FavDetail]);

	}

	public function followers()

	{
		$user = User::where('id',Auth::user()->id)->first();
	  	$city = AddrCities::where('id',$user->city)->first();
       	$UserProfileDetail['firstname'] = $user->firstname;
		$UserProfileDetail['lastname'] = $user->lastname;
		$UserProfileDetail['gender'] = $user->gender;
		$UserProfileDetail['username'] = $user->username;
		$UserProfileDetail['phone_number'] = $user->phone_number;
		$UserProfileDetail['address'] = $user->address;
		$UserProfileDetail['quick_intro'] = $user->quick_intro;
		$UserProfileDetail['birthdate'] = date('m d,Y',strtotime($user->birthdate));
		$UserProfileDetail['email'] = $user->email;
		$UserProfileDetail['favorit_activity'] = $user->favorit_activity;
		$UserProfileDetail['email'] = $user->email;
		
		$UserProfileDetail['cover_photo'] =$user->cover_photo;
       if(empty($city)){
           $UserProfileDetail['city'] = $user->city;;
       }
       else{
           $UserProfileDetail['city'] = $city->city_name;
       }
       $state = AddrStates::where('id',$user->state)->first();
       if(empty($state)){
           $UserProfileDetail['state'] = $user->state;;
       }
       else{
           $UserProfileDetail['state'] = $state->state_name;
       }
       $UserProfileDetail['country'] = $user->country;


     $fdata = UserFollow::select("user_id","follow_id","follower_id")
     ->where("user_id","!=",Auth::user()->id)
     ->orwhere("follow_id","=",4)
     ->where("follow_id","=",1)
     ->get();

      $testdata ='';

      foreach ($fdata as $data) { 

        $query = CompanyInformation::select("first_name","last_name","logo","user_id","id")
        ->where("user_id",$data['user_id'])
        ->first();

        $testdata .='
        <div class="followers-block">

              <div class="followers-content">
                  <div class="admin-img">
                      <img src="/public/uploads/profile_pic/thumb/'.$query["logo"] .'" alt="">
                  </div>
                  <div class="followers-right-content">
                      <h5> '.$query["first_name"].' '.$query["last_name"].' </h5>
                      <ul>
                          <li><span>Follower</span> 1</li>
                          <li><span>Comments</span> 5</li>
                          <li><span>Following</span> 2</li>
                          <li><span>Member Since</span> March 2019</li>
                          <li><span>Listings</span> 9</li>
                      </ul>

                  </div> ';

                  if($data["user_id"] == Auth::user()->id && $data["follower_id"] == $data["user_id"]){
                    echo "n";
                  }
                  else{
                    $testdata .=' <a class="followback" id="'.$query["id"].'" data-user="'.$query["user_id"].'">Follow</a> ';
                  }
                
            
             $testdata .=' </div>

              <div class="followers-button">

                  <a class="following-btn follow-btn remove-btn" id="'.$query["user_id"].'">Remove</a>
                 
              </div>
          
          </div>
        ';
      }


	   return view('personal-profile.followers', ['UserProfileDetail' => $UserProfileDetail,'testdata' =>$testdata]);

	}

	public function following()

	{

		$user = User::where('id',Auth::user()->id)->first();
	  	$city = AddrCities::where('id',$user->city)->first();
       	$UserProfileDetail['firstname'] = $user->firstname;
		$UserProfileDetail['lastname'] = $user->lastname;
		$UserProfileDetail['gender'] = $user->gender;
		$UserProfileDetail['username'] = $user->username;
		$UserProfileDetail['phone_number'] = $user->phone_number;
		$UserProfileDetail['address'] = $user->address;
		$UserProfileDetail['quick_intro'] = $user->quick_intro;
		$UserProfileDetail['birthdate'] = date('m d,Y',strtotime($user->birthdate));
		$UserProfileDetail['email'] = $user->email;
		$UserProfileDetail['favorit_activity'] = $user->favorit_activity;
		$UserProfileDetail['email'] = $user->email;
		
		$UserProfileDetail['cover_photo'] =$user->cover_photo;
       if(empty($city)){
           $UserProfileDetail['city'] = $user->city;;
       }
       else{
           $UserProfileDetail['city'] = $city->city_name;
       }
       $state = AddrStates::where('id',$user->state)->first();
       if(empty($state)){
           $UserProfileDetail['state'] = $user->state;;
       }
       else{
           $UserProfileDetail['state'] = $state->state_name;
       }
       $UserProfileDetail['country'] = $user->country;

       $follow = UserFollow::select("company_informations.company_name", "company_informations.first_name", "company_informations.last_name", "company_informations.id", "company_informations.logo")
      ->join("company_informations", "users_follow.follow_id", "=", "company_informations.id")
      ->where("users_follow.user_id", "=", Auth::user()->id)
      ->get();

      $FollowDetail = $follow;


	   return view('personal-profile.following', ['UserProfileDetail' => $UserProfileDetail, 'FollowDetail' => $FollowDetail]);

	}

	public function paymentinfo()

	{

		$user = User::where('id',Auth::user()->id)->first();
	  	$city = AddrCities::where('id',$user->city)->first();
       	$UserProfileDetail['firstname'] = $user->firstname;
		$UserProfileDetail['lastname'] = $user->lastname;
		$UserProfileDetail['gender'] = $user->gender;
		$UserProfileDetail['username'] = $user->username;
		$UserProfileDetail['phone_number'] = $user->phone_number;
		$UserProfileDetail['address'] = $user->address;
		$UserProfileDetail['quick_intro'] = $user->quick_intro;
		$UserProfileDetail['birthdate'] = date('m d,Y',strtotime($user->birthdate));
		$UserProfileDetail['email'] = $user->email;
		$UserProfileDetail['favorit_activity'] = $user->favorit_activity;
		$UserProfileDetail['email'] = $user->email;
		
		$UserProfileDetail['cover_photo'] =$user->cover_photo;
       if(empty($city)){
           $UserProfileDetail['city'] = $user->city;;
       }
       else{
           $UserProfileDetail['city'] = $city->city_name;
       }
       $state = AddrStates::where('id',$user->state)->first();
       if(empty($state)){
           $UserProfileDetail['state'] = $user->state;;
       }
       else{
           $UserProfileDetail['state'] = $state->state_name;
       }
       $UserProfileDetail['country'] = $user->country;
	   
		return view('personal-profile.payment-info', ['UserProfileDetail' => $UserProfileDetail]);

	}

	public function review()

	{

		$user = User::where('id',Auth::user()->id)->first();
	  	$city = AddrCities::where('id',$user->city)->first();
       	$UserProfileDetail['firstname'] = $user->firstname;
		$UserProfileDetail['lastname'] = $user->lastname;
		$UserProfileDetail['gender'] = $user->gender;
		$UserProfileDetail['username'] = $user->username;
		$UserProfileDetail['phone_number'] = $user->phone_number;
		$UserProfileDetail['address'] = $user->address;
		$UserProfileDetail['quick_intro'] = $user->quick_intro;
		$UserProfileDetail['birthdate'] = date('m d,Y',strtotime($user->birthdate));
		$UserProfileDetail['email'] = $user->email;
		$UserProfileDetail['favorit_activity'] = $user->favorit_activity;
		$UserProfileDetail['profile_pic '] = $user->profile_pic ;
		
		$UserProfileDetail['cover_photo'] =$user->cover_photo;
       if(empty($city)){
           $UserProfileDetail['city'] = $user->city;;
       }
       else{
           $UserProfileDetail['city'] = $city->city_name;
       }
       $state = AddrStates::where('id',$user->state)->first();
       if(empty($state)){
           $UserProfileDetail['state'] = $user->state;;
       }
       else{
           $UserProfileDetail['state'] = $state->state_name;
       }
       $UserProfileDetail['country'] = $user->country;

    $reviewdata = Review::select("review","rating","title","created_at")
    ->where("reviewfor_userid",Auth::user()->id)
    ->get();

    $RevData = $reviewdata;
	   
		return view('personal-profile.review', ['UserProfileDetail' => $UserProfileDetail, 'RevData' =>$RevData]);

	}

	public function userprofile()
	{

		if (! Gate::allows('profile_view_access')) {
			$request->session()->flash('alert-danger', 'Access Restricted');
			return redirect('/');
    }
    $loggedinUser = Auth::user();
    $UserProfileDetail = $this->users->getUserProfileDetail($loggedinUser['id'],array('professional_detail','history','education','certification','service'));
    if(isset($UserProfileDetail['ProfessionalDetail']) && @count($UserProfileDetail['ProfessionalDetail']) > 0){
      $UserProfileDetail['ProfessionalDetail'] = UserProfessionalDetail::getFormedProfile($UserProfileDetail['ProfessionalDetail']);
    }
    $sports_names = $this->sports->getAllSportsNames();
    $approve = Evidents::where('user_id',$loggedinUser['id'])->get();
    $serviceType = Miscellaneous::businessType();
    $programType = Miscellaneous::programType();
    $programFor = Miscellaneous::programFor();
    $numberOfPeople = Miscellaneous::numberOfPeople();
    $ageRange = Miscellaneous::ageRange();
    $expLevel = Miscellaneous::expLevel();
    $serviceLocation = Miscellaneous::serviceLocation();
    $pFocuses = Miscellaneous::pFocuses();
    $duration = Miscellaneous::duration();
    $servicePriceOption = Miscellaneous::servicePriceOption();
    $specialDeals = Miscellaneous::specialDeals();
		$view='personal-profile.user-profile';
        $family = UserFamilyDetail::where('user_id',Auth::user()->id)->get();
        $business_details = BusinessInformation::where('user_id',Auth::user()->id)->get();
        $user = User::where('id',Auth::user()->id)->first();
	  	$city = AddrCities::where('id',$user->city)->first();
       	$UserProfileDetail['firstname'] = $user->firstname;
		$UserProfileDetail['lastname'] = $user->lastname;
		$UserProfileDetail['gender'] = $user->gender;
		$UserProfileDetail['username'] = $user->username;
		$UserProfileDetail['phone_number'] = $user->phone_number;
		$UserProfileDetail['address'] = $user->address;
		$UserProfileDetail['quick_intro'] = $user->quick_intro;
		$UserProfileDetail['birthdate'] = date('m d,Y',strtotime($user->birthdate));
		$UserProfileDetail['email'] = $user->email;
		$UserProfileDetail['favorit_activity'] = $user->favorit_activity;
		
		$UserProfileDetail['profile_pic'] =$user->profile_pic;
		$UserProfileDetail['cover_photo'] =$user->cover_photo;
    if(empty($city)){
      $UserProfileDetail['city'] = $user->city;;
    }
    else{
      $UserProfileDetail['city'] = $city->city_name;
    }
       $state = AddrStates::where('id',$user->state)->first();
       if(empty($state)){
           $UserProfileDetail['state'] = $user->state;;
       }
       else{
           $UserProfileDetail['state'] = $state->state_name;
       }
       $UserProfileDetail['country'] = $user->country;
       $firstCompany = CompanyInformation::where('user_id',Auth::user()->id)->first();
       $companies = CompanyInformation::where('user_id',Auth::user()->id)->get();
        return view($view, [
            'UserProfileDetail' => $UserProfileDetail,
            'firstCompany' => $firstCompany,
            'countries' => $this->users->getCountriesList(),
            'states' => $this->users->getStateList($UserProfileDetail['country']),
            'cities' => $this->users->getCityList($UserProfileDetail['state']),
            'phonecode' => Miscellaneous::getPhoneCode(),
            'sports_names' => $sports_names,
            'serviceType' => $serviceType,
            'programType' => $programType,
            'programFor' => $programFor,
            'numberOfPeople' => $numberOfPeople,
            'ageRange' => $ageRange,
            'expLevel' => $expLevel,
            'serviceLocation' => $serviceLocation,
			'pFocuses' => $pFocuses,
            'duration'=> $duration,
            'specialDeals' => $specialDeals,
            'servicePriceOption' => $servicePriceOption,
            'pageTitle' => "PROFILE",
            'approve'=>$approve,
            'family'=>$family,
            'business_details'=>$business_details,
            'companies'=>$companies
        ]);

	}
	public function updateuserprofile(Request $request)
	{
		if (! Gate::allows('profile_view_access')) {
			$request->session()->flash('alert-danger', 'Access Restricted');
			return redirect('/');
        }
        $loggedinUser = Auth::user();
		$user = User::where('id',Auth::user()->id)->first();
		
		$this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
        ]);
        
		$imageName='';
		
		if($request->hasFile('frm_profile_pic'))
		{
			$file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR;
			$thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'profile_pic'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;
			$image_upload = Miscellaneous::saveFileAndThumbnail($request->file('frm_profile_pic'),$file_upload_path,1,$thumb_upload_path,'247','266');
			$imageName = $image_upload['filename'];
		}
		else
		{
			$image_name = $request->old_profile_pic;
		} 
		
        
       	$cat = User::find($loggedinUser['id']);
        $cat->firstname = $request->firstname;
        $cat->lastname = $request->lastname;
        $cat->gender = $request->gender;
        $cat->phone_number = $request->phone_number;
		$cat->address = $request->address;
		$cat->birthdate = date('Y-m-d',strtotime($request['birthdate']));
		$cat->quick_intro = $request->quick_intro;
		$cat->favorit_activity = $request->favorit_activity;
		$cat->business_info = $request->business_info;
		$cat->profile_pic = $imageName;
		$affected=$cat->update();
		
        if($affected)
            return Redirect::back()->with('success', 'Profile updated successfully.');
        else
            return Redirect::back()->with('error', 'Problem in profile update.');
	}

  public function addinstantHire(Request $request)
  {
     

     $activity = $request->sport;
     $qoutes = $request->qoutes;
     $activity_for='';
     $language='';
     $expLevel='';
     $expActivity='';
     $expProfessional='';
     $do_activity='';
     $which_personality='';
     $days='';
     $time_available='';

     if($request->activity_for != ''){
      $activity_for = implode(',', $request->activity_for); 
    }

    if($request->language != ''){
     $language = implode(',', $request->language);
    }

     if($request->expLevel != ''){
      $expLevel = implode(',', $request->expLevel); 
    }

    if($request->expActivity != ''){
     $expActivity = implode(',', $request->expActivity);
    }

    if($request->expProfessional != ''){
     $expProfessional = implode(',', $request->expProfessional);  
    }  

     $gear = $request->gear;
     $gearYes = $request->gearYes;

     $activeLevel = $request->activeLevel;

    if($request->do_activity != ''){
       $do_activity = implode(',', $request->do_activity);
    }

    if($request->which_personality != ''){
     $which_personality = implode(',', $request->which_personality);
    }

     $gender = $request->gender;
     $ageRange = $request->ageRange;
     $participateActivity = $request->participateActivity;

     if($request->days != ''){
      $days = implode(',', $request->days);
     }
     if($request->time_available != ''){
      $time_available = implode(',', $request->time_available);
    }
     $medicalIssue = $request->medicalIssue;
     $medicalYes = $request->medicalYes;
     $trainingLocation = $request->trainingLocation;
     $StartActivity = $request->StartActivity;
     $travelUpto = $request->travelUpto;
     $zipcode = $request->zipcode;
      $savedata = array(

                'activity'=>$activity,

                'qoutes'=>$qoutes,

                'activity_for'=>$activity_for,

                'expLevel'=>$expLevel,

                'expActivity'=>$expActivity,
                'expProfessional' => $expProfessional,
                'gear' => $gear,
                'gearYes' => $gearYes,
                'activeLevel' => $activeLevel,
                'do_activity' => $do_activity,
                'which_personality' => $which_personality,
                'gender' => $gender,
                'ageRange' => $ageRange,
                'participateActivity' => $participateActivity,
                'days'=> $days,
                'time_available' => $time_available,
                'medicalIssue'=> $medicalIssue,
                'medicalYes'=> $medicalYes,
                'trainingLocation'=> $trainingLocation,
                'StartActivity' => $StartActivity,
                'travelUpto' => $travelUpto,
                'zipcode' => $zipcode

            );

            $save = InstantForms::create($savedata);
            return view('home.instant_success');

  }
	public function savemycoverphoto(Request $request)
	{
		if (! Gate::allows('profile_view_access')) {
			$request->session()->flash('alert-danger', 'Access Restricted');
			return redirect('/');
        }
        $loggedinUser = Auth::user();
		$cat = User::find($loggedinUser['id']);
		$user = User::where('id',Auth::user()->id)->first();
		$this->validate($request, [
            'coverphoto' => 'required',
        ]);
        
        $imageName=''; 
        if ($request->hasFile('coverphoto')) {
           
		   	
		   
		   	$file_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'cover-photo'.DIRECTORY_SEPARATOR;
			$thumb_upload_path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'cover-photo'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR;
			$image_upload = Miscellaneous::saveFileAndThumbnail($request->file('coverphoto'),$file_upload_path,1,$thumb_upload_path,'247','266');
			$imageName = $image_upload['filename'];
		}
        
       	$cat = User::find($loggedinUser['id']);
        $cat->cover_photo = $imageName;
        $affected=$cat->update();
		
        if($affected)
            return Redirect::back()->with('success', 'Cover photo updated successfully.');
        else
            return Redirect::back()->with('error', 'Problem in updating cover photo.');
	}
    
	public function removeusercoverphoto(Request $request)
	{
		if (! Gate::allows('profile_view_access')) {
			$request->session()->flash('alert-danger', 'Access Restricted');
			return redirect('/');
        }
        $loggedinUser = Auth::user();
		$cat = User::find($loggedinUser['id']);
		$imageName=''; 
        if($cat->cover_photo != ''){
        	@unlink(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'cover-photo'.DIRECTORY_SEPARATOR.$cat->cover_photo);
			@unlink(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'cover-photo'.DIRECTORY_SEPARATOR.'thumb'.DIRECTORY_SEPARATOR.$cat->cover_photo);
        }
		$cat = User::find($loggedinUser['id']);
        $cat->cover_photo = $imageName;
        $affected=$cat->update();
		
        if($affected)
            echo "success";
        else
            echo "fail";
			exit;
	}
	public function updatechangepassword(Request $request)
	{
		if (! Gate::allows('profile_view_access')) {
			$request->session()->flash('alert-danger', 'Access Restricted');
			return redirect('/');
        }
        $loggedinUser = Auth::user();
		$user = User::where('id',Auth::user()->id)->first();
		
		$this->validate($request, [
            'currpassword' => 'required',
            'newpassword' => 'min:6|required_with:retypepassword|same:retypepassword',
            'retypepassword' => 'required|min:6',
        ]);
        $affected="";
        $current_password = Auth::User()->password;           
      	if(Hash::check($request->newpassword, $current_password))
      	{
			$cat = User::find($loggedinUser['id']);
			$cat->password = Hash::make($request->newpassword);
			$affected=$cat->save(); 
			//$affected=$cat->update();
		}
        if($affected)
            return Redirect::back()->with('success', 'Password has been changed successfully.');
        else
            return Redirect::back()->with('error', 'Problem in password change.');
	}
	public function addFamilyMember(Request $request)
	{
		if (! Gate::allows('profile_view_access')) {
			$request->session()->flash('alert-danger', 'Access Restricted');
			return redirect('/');
        }
		$prev=$request['previous_family_count'];
		echo $request['family_count']."---".'----'.$prev;
		echo $request['family_count']-$prev;
		
		$loggedinUser = Auth::user();
		$user = User::where('id',Auth::user()->id)->first();
		$data='';
		
		if($prev==$request['family_count'] && $request['family_count']==0)
		{
			if($request['removed_family'][0]!='delete')
				{
					$data = UserFamilyDetail::create([
					 'user_id' => Auth::user()->id,
					 'first_name' => $request['fname'][0],
					 'last_name' => $request['lname'][0],
					 'email' => $request['email'][0],
					 'mobile' => $request['mobile'][0],
					 'emergency_contact' => $request['emergency_contact'][0],
					 'relationship' => $request['relationship'][0],
					 'gender' => $request['gender'][0],
					 'birthday' => date('Y-m-d',strtotime($request['birthdate'][0])),
					 'emergency_contact_name' =>$request['emergency_name'][0],
					]);
				}
		}
		else
		{
			for($i=0;$i<$prev;$i++)
			{
				if($request['removed_family'][$i]!='delete')
				{
					$cat = UserFamilyDetail::find($request['fid'][$i]);
					$cat->first_name = $request['fname'][$i];
					$cat->last_name = $request['lname'][$i];
					$cat->email = $request['email'][$i];
					$cat->mobile = $request['mobile'][$i];
					$cat->emergency_contact = $request['emergency_contact'][$i];
					$cat->relationship = $request['relationship'][$i];
					$cat->gender = $request['gender'][$i];
					$cat->birthday =date('Y-m-d',strtotime($request['birthdate'][$i]));
					$cat->emergency_contact_name = $request['emergency_name'][$i];
					$data=$cat->update();
				}
				else
				{
					$data=UserFamilyDetail::where('id', $request['fid'][$i])->delete();
				}
			}
			for($j=$prev;$j<$request['family_count'];$j++)
			{
				if($request['removed_family'][$j]!='delete')
				{
					$data = UserFamilyDetail::create([
					 'user_id' => Auth::user()->id,
					 'first_name' => $request['fname'][$j],
					 'last_name' => $request['lname'][$j],
					 'email' => $request['email'][$j],
					 'mobile' => $request['mobile'][$j],
					 'emergency_contact' => $request['emergency_contact'][$j],
					 'relationship' => $request['relationship'][$j],
					 'gender' => $request['gender'][$j],
					 'birthday' => date('Y-m-d',strtotime($request['birthdate'][$j])),
					 'emergency_contact_name' =>$request['emergency_name'][$j],
					]);
				}
			}
		}
		if($data)
            return Redirect::back()->with('success', 'Family details has been updated successfully.');
        else
            return Redirect::back()->with('error', 'Problem in updating family details.');
	}

  public function removefamily(Request $request){

    DB::delete('DELETE FROM  user_family_details WHERE id = "'.$request->rm.'"');
    return Redirect::back()->with('success', 'Family Member Delete.');

  }
	
}



