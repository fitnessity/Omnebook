<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Repositories\{UserRepository,SportsRepository};
use Illuminate\Support\Facades\Auth;
use File;
use Config;
use Redirect;
use View;
use DB;
use Response;
use Validator;
use App\{BusinessServices,BusinessActivityScheduler,Miscellaneous,BusinessPriceDetails,BusinessServiceReview,CompanyInformation,BusinessPriceDetailsAges,UserBookingDetail,ActivtyGetStartedFast,BusinessServicesFavorite,BusinessService,User,AddOnService,MailService};
use DateTime;
use Hash;


class ActivityController extends Controller {

	protected $sports;

    public function __construct(UserRepository $users,  Request $request, SportsRepository $sports) {
        $this->users = $users;
        $this->sports = $sports;
    }

    public function ways_to_workout(Request $request){
    	$activity_get_start_fast =  ActivtyGetStartedFast::find(2);

		$activities = BusinessServices::where('business_services.is_active', 1)->where('business_services.service_type', 'classes')->with(['company_information']);
		$name = 'Personal Training';
        $current_date = new DateTime();
        $bookschedulers = BusinessActivityScheduler::next_8_hours($current_date)->whereIn('serviceid', $activities->pluck('id'))->limit(3)->get();


		return view('activity.get_started',[
			'activity_get_start_fast'=>$activity_get_start_fast,
			'bookschedulers' => $bookschedulers,
			'current_date' => $current_date,
			'allactivities'=>$activities,
			'activities'=>$activities->get(),
			'name' => $name,
		]);	
    }

    public function personal_trainer(Request $request){
    	$activity_get_start_fast =  ActivtyGetStartedFast::find(1);

		$activities = BusinessServices::where('business_services.is_active', 1)->where('business_services.service_type', 'individual')->with(['company_information']);

		$name = 'Personal Training';
		


        $current_date = new DateTime();
        $bookschedulers = BusinessActivityScheduler::next_8_hours($current_date)->whereIn('serviceid', $activities->pluck('id'))->limit(3)->get();


		return view('activity.get_started',[
			'activity_get_start_fast'=>$activity_get_start_fast,
			'bookschedulers' => $bookschedulers,
			'current_date' => $current_date,
			'allactivities'=>$activities,
			'activities'=>$activities->get(),
			'name' => $name,
		]);	
    }

    public function experiences(Request $request){
    	$activity_get_start_fast =  ActivtyGetStartedFast::find(3);
		$activities = BusinessServices::where('business_services.is_active', 1)->where('business_services.service_type', 'experience')->with(['company_information']);
		$name = 'Experience';
	
        $current_date = new DateTime();
        $bookschedulers = BusinessActivityScheduler::next_8_hours($current_date)->whereIn('serviceid', $activities->pluck('id'))->limit(3)->get();

		return view('activity.get_started',[
			'activity_get_start_fast'=>$activity_get_start_fast,
			'bookschedulers' => $bookschedulers,
			'current_date' => $current_date,
			'allactivities'=>$activities,
			'activities'=>$activities->get(),
			'name'=>$name,
		]);	
    } 

    public function events(Request $request){
    	$activity_get_start_fast =  ActivtyGetStartedFast::find(4);

		$activities = BusinessServices::where('business_services.is_active', 1)->where('business_services.service_type', 'events')->with(['company_information']);
		$name = 'Events';
		
        $current_date = new DateTime();
        $bookschedulers = BusinessActivityScheduler::next_8_hours($current_date)->whereIn('serviceid', $activities->pluck('id'))->limit(3)->get();

		return view('activity.get_started',[
			'activity_get_start_fast'=>$activity_get_start_fast,
			'bookschedulers' => $bookschedulers,
			'current_date' => $current_date,
			'allactivities'=>$activities,
			'activities'=>$activities->get(),
			'name'=>$name,
		]);	
    }

    public function next_8_hours(Request $request){

    	$business_services = BusinessServices::where('business_services.is_active', 1);

    	if($request->sport_activity){
    		$business_services = $business_services->whereRaw('LOWER(`sport_activity`) LIKE ? ',['%'.trim(strtolower($request->sport_activity)).'%']);	
    	}

    	$filter_date = new DateTime();
    	$shift = 1;
    	if($request->date && (new DateTime($request->date)) > $filter_date){
    		$filter_date = new DateTime($request->date);	
    		$shift = 0;
    	}

		$days = [];
		$days[] = new DateTime(date('Y-m-d'));

		for($i = 0; $i<=4; $i++){
			$d = clone($filter_date);
			$days[] = $d->modify('+'.($i+$shift).' day');
		}

    	$start_date = $filter_date;
    	$end_date = clone($start_date);
    	$end_date = $end_date->modify("23:59:59");
    	$business_services;
    	$bookschedulers = BusinessActivityScheduler::allday($filter_date)->whereIn('serviceid', $business_services->pluck('id'))->orderBy('end_activity_date', 'desc')->get();

    	return view('activity.next_8_hours',[
    		'bookschedulers' => $bookschedulers,
    		'filter_date' => $filter_date,
    		'days' => $days,
    	]);
    }

	public function index(Request $request,$filtervalue = null)
	{
		if($filtervalue == 'classes' || $filtervalue == 'personal_trainer' || $filtervalue == 'experience' || $filtervalue == 'all' || $filtervalue == 'thismonth' || $filtervalue == 'most_popular' || $filtervalue == 'trainers_coaches' || $filtervalue == 'ways_to_workout'|| $filtervalue == 'active_wth_fun_things_to_do' || $filtervalue == 'events_in_your_area' )
		{

			$getstarteddata = '';
			$all_activities = BusinessServices::where('business_services.is_active', 1);
			$todayservicedata = [];
			$nxtact = BusinessServices::where('business_services.is_active', 1);

			if($filtervalue == 'classes' ){
				$name = 'Gym/Studio';
				$getstarteddata =  ActivtyGetStartedFast::where('id',2)->first();
				$all_activities->where('business_services.service_type',$filtervalue);
				$nxtact->where('business_services.service_type',$filtervalue);
			}else if($filtervalue == 'personal_trainer' ){
				$name = 'Personal Training';
				$filtervalue = 'individual';
				$getstarteddata =  ActivtyGetStartedFast::where('id',1)->first();
				$all_activities->where('business_services.service_type',$filtervalue);
				$nxtact->where('business_services.service_type',$filtervalue);
			}else if($filtervalue == 'experience'){
				$name = 'Experience';
				$getstarteddata =  ActivtyGetStartedFast::where('id',3)->first();
				$all_activities->where('business_services.service_type',$filtervalue);
				$nxtact->where('business_services.service_type',$filtervalue);
			}else if($filtervalue == 'all'){
				$name = 'All';			
			}else if($filtervalue == 'thismonth'){
				$name = 'This Month';
				$all_activities->whereMonth('business_services.CREATED_AT', date('m'));		
				$nxtact->whereMonth('business_services.CREATED_AT', date('m'));		
			}else if($filtervalue == 'most_popular'){
				$name = 'Most Popular';	
				$all_activities->join('user_booking_details', 'business_services.id', '=', 'user_booking_details.sport')->select('business_services.*','user_booking_details.sport')->groupby('business_services.id')->orderby('user_booking_details.created_at','desc');
				$nxtact->join('user_booking_details', 'business_services.id', '=', 'user_booking_details.sport')->select('business_services.*','user_booking_details.sport')->groupby('business_services.id')->orderby('user_booking_details.created_at','desc');	
			}else if($filtervalue == 'trainers_coaches'){
				$name = 'Trainers & Coaches';
				$all_activities->where('service_type','individual');
				$nxtact->where('service_type','individual');
			}else if($filtervalue == 'ways_to_workout'){
				$name = 'Ways To Workout';
				$all_activities->where('service_type','classes');
				$nxtact->where('service_type','classes');
			}else if ($filtervalue == 'events_in_your_area'){
				$name = 'Events In Your Area';
				$all_activities->where('service_type','events');
				$nxtact->where('service_type','events');
			}else {
				$name = 'Active With Fun Things To Do';
				$all_activities->where('service_type','experience');
				$nxtact->where('service_type','experience');
			}

	        $nxtacty = $nxtact->get();

	        if (isset($nxtacty)) {
	        	foreach ($nxtacty as $service) {
	        		$bookscheduler = BusinessActivityScheduler::where('serviceid', $service['id'])->get();
	        		if(!empty($bookscheduler)) {
	        			foreach ($bookscheduler  as $key => $value) {
			            	$curr = date("H:i");
	        				$time1 = strtotime($curr);
							$time2 = strtotime($value['shift_start']);
							$difference = abs($time2 - $time1) / 3600;

			            	if(str_contains($value['activity_days'], date('l', strtotime($curr))) && $value['end_activity_date'] >= date('Y-m-d') &&  $difference< 8 &&  $difference > 0){
			              		$todayservicedata[] = $service; 
			            	}
			            }
	          		}
	          	}
	          	$todayservicedata = array_unique($todayservicedata);
	        }
	        $current_date = new DateTime();
	        $bookschedulers = BusinessActivityScheduler::next_8_hours($current_date)->whereIn('serviceid', $nxtacty->pluck('id'))->limit(3)->get();
			
			$allactivities = $all_activities->get();
			/*print_r($allactivities);exit();*/
			$serviceLocation = Miscellaneous::serviceLocation();

			/*print_r($todayservicedata);exit;*/
			return view('activity.getstartedfast',[
				'allactivities'=>$allactivities,
				'bookschedulers'=>$bookschedulers,
				'current_date'=>$current_date,
				'serviceLocation'=>$serviceLocation,
				'name'=>$name,
				'getstarteddata'=>$getstarteddata,
			]);    
		}else{
			$all_activities = BusinessServices::where('business_services.is_active', 1);

			$this_nthactivity = BusinessServices::where('business_services.is_active', 1)->whereMonth('business_services.CREATED_AT', date('Y-m'));

			$most_popularactivity = BusinessServices::where('business_services.is_active', 1)->join('user_booking_details', 'business_services.id', '=', 'user_booking_details.sport')->select('business_services.*','user_booking_details.sport')->groupby('business_services.id')->orderby('user_booking_details.created_at','desc');

			$Trainers_coaches_acitvity = BusinessServices::where(['business_services.is_active'=> 1,'service_type'=>'individual']);

			$Fun_Activities = BusinessServices::where(['business_services.is_active'=> 1,'service_type'=>'experience']);

			$Ways_To_Work_out = BusinessServices::where(['business_services.is_active'=> 1,'service_type'=>'classes']);

			$events_activity = BusinessServices::where(['business_services.is_active'=> 1,'service_type'=>'events']);

			$todayservicedata = [];

			$nxtact = BusinessServices::where('business_services.is_active', 1);
			$searchDataProfile=array();
	        $searchDatauserProfile = $searchDatabusiness = $searchDataacivity = '';

	        if($request->label != ''){
				$all_activities = $all_activities->where('sport_activity', 'LIKE', '%'. $request->label . '%')->orWhere('program_name', 'LIKE', '%'. $request->label . '%');  
				$this_nthactivity = $this_nthactivity->where('sport_activity', 'LIKE', '%'. $request->label . '%')->orWhere('program_name', 'LIKE', '%'. $request->label . '%');  
				$most_popularactivity = $most_popularactivity->where('sport_activity', 'LIKE', '%'. $request->label . '%')->orWhere('program_name', 'LIKE', '%'. $request->label . '%');  
				$Trainers_coaches_acitvity = $Trainers_coaches_acitvity->where('sport_activity', 'LIKE', '%'. $request->label . '%')->orWhere('program_name', 'LIKE', '%'. $request->label . '%');  
				$Fun_Activities = $Fun_Activities->where('sport_activity', 'LIKE', '%'. $request->label . '%')->orWhere('program_name', 'LIKE', '%'. $request->label . '%');  
				$Ways_To_Work_out = $Ways_To_Work_out->where('sport_activity', 'LIKE', '%'. $request->label . '%')->orWhere('program_name', 'LIKE', '%'. $request->label . '%');  
				$events_activity = $events_activity->where('sport_activity', 'LIKE', '%'. $request->label . '%')->orWhere('program_name', 'LIKE', '%'. $request->label . '%');  
				$nxtact = $nxtact->where('sport_activity', 'LIKE', '%'. $request->label . '%')->orWhere('program_name', 'LIKE', '%'. $request->label . '%');  

				$searchDatauserProfile = User::where('username', $request->label)->first();
	            $searchDatabusiness = CompanyInformation::where('dba_business_name',$request->label)->first();
	            $searchDataacivity = BusinessServices::where('program_name',$request->label)->first();

				/*$searchDatauserProfile = User::where('username', 'LIKE', '%'.$request->label.'%')->first();
	            $searchDatabusiness = CompanyInformation::where('dba_business_name','LIKE', '%'.$request->label.'%')->first();
	            $searchDataacivity = BusinessServices::where('program_name','LIKE', '%'.$request->label.'%')->first();*/
            }

            if($request->address){

            	if (is_numeric($request->address)){
					$all_activities = $this->buildQuery($all_activities,'zip_code',$request->address);
					$this_nthactivity = $this->buildQuery($this_nthactivity,'zip_code',$request->address);
					$most_popularactivity = $this->buildQuery($most_popularactivity,'zip_code',$request->address);
					$Trainers_coaches_acitvity = $this->buildQuery($Trainers_coaches_acitvity,'zip_code',$request->address);
					$Fun_Activities = $this->buildQuery($Fun_Activities,'zip_code',$request->address);
					$Ways_To_Work_out = $this->buildQuery($Ways_To_Work_out,'zip_code',$request->address);
					$events_activity = $this->buildQuery($events_activity,'zip_code',$request->address);
					$nxtact = $this->buildQuery($nxtact,'zip_code',$request->address);
				}
            }

			if($request->country){
            	$all_activities = $this->buildQuery($all_activities,'country',$request->country);
				$this_nthactivity = $this->buildQuery($this_nthactivity,'country',$request->country);
				$most_popularactivity = $this->buildQuery($most_popularactivity,'country',$request->country);
				$Trainers_coaches_acitvity = $this->buildQuery($Trainers_coaches_acitvity,'country',$request->country);
				$Fun_Activities = $this->buildQuery($Fun_Activities,'country',$request->country);
				$Ways_To_Work_out = $this->buildQuery($Ways_To_Work_out,'country',$request->country);
				$events_activity = $this->buildQuery($events_activity,'country',$request->country);
				$nxtact = $this->buildQuery($nxtact,'country',$request->country);
            }

			if($request->city){
				$all_activities = $this->buildQuery($all_activities,'city',$request->city);
				$this_nthactivity = $this->buildQuery($this_nthactivity,'city',$request->city);
				$most_popularactivity = $this->buildQuery($most_popularactivity,'city',$request->city);
				$Trainers_coaches_acitvity = $this->buildQuery($Trainers_coaches_acitvity,'city',$request->city);
				$Fun_Activities = $this->buildQuery($Fun_Activities,'city',$request->city);
				$Ways_To_Work_out = $this->buildQuery($Ways_To_Work_out,'city',$request->city);
				$events_activity = $this->buildQuery($events_activity,'city',$request->city);
				$nxtact = $this->buildQuery($nxtact,'city',$request->city);
            }

            if($request->state){
            	$all_activities = $this->buildQuery($all_activities,'state',$request->state);
				$this_nthactivity = $this->buildQuery($this_nthactivity,'state',$request->state);
				$most_popularactivity = $this->buildQuery($most_popularactivity,'state',$request->state);
				$Trainers_coaches_acitvity = $this->buildQuery($Trainers_coaches_acitvity,'state',$request->state);
				$Fun_Activities = $this->buildQuery($Fun_Activities,'state',$request->state);
				$Ways_To_Work_out = $this->buildQuery($Ways_To_Work_out,'state',$request->state);
				$events_activity = $this->buildQuery($events_activity,'state',$request->state);
				$nxtact = $this->buildQuery($nxtact,'state',$request->state);
            }

            if($request->zip_code){
            	$all_activities = $this->buildQuery($all_activities,'zip_code',$request->zip_code);
				$this_nthactivity = $this->buildQuery($this_nthactivity,'zip_code',$request->zip_code);
				$most_popularactivity = $this->buildQuery($most_popularactivity,'zip_code',$request->zip_code);
				$Trainers_coaches_acitvity = $this->buildQuery($Trainers_coaches_acitvity,'zip_code',$request->zip_code);
				$Fun_Activities = $this->buildQuery($Fun_Activities,'zip_code',$request->zip_code);
				$Ways_To_Work_out = $this->buildQuery($Ways_To_Work_out,'zip_code',$request->zip_code);
				$events_activity = $this->buildQuery($events_activity,'zip_code',$request->zip_code);
				$nxtact = $this->buildQuery($nxtact,'zip_code',$request->zip_code);
            }
   
			if($filtervalue){
				if(str_contains($filtervalue, 'activity_type')){
					$activity = substr($filtervalue, strpos($filtervalue, "activity_type=") +14);
					$activity = explode('~',$activity );
					$search = $activity[0];
		            if(!empty($search)){
		                $all_activities = $all_activities->where('sport_activity', 'LIKE', '%'. $search . '%');   
		                $this_nthactivity = $this_nthactivity->where('sport_activity', 'LIKE', '%'. $search . '%');   
		                $most_popularactivity = $most_popularactivity->where('sport_activity', 'LIKE', '%'. $search . '%');   
		                $Trainers_coaches_acitvity = $Trainers_coaches_acitvity->where('sport_activity', 'LIKE', '%'. $search . '%');   
		                $Fun_Activities = $Fun_Activities->where('sport_activity', 'LIKE', '%'. $search . '%');   
		                $Ways_To_Work_out = $Ways_To_Work_out->where('sport_activity', 'LIKE', '%'. $search . '%');   
		                $events_activity = $events_activity->where('sport_activity', 'LIKE', '%'. $search . '%');  
		                $nxtact = $events_activity->where('sport_activity', 'LIKE', '%'. $search . '%');   
		            }
				}

				if(str_contains($filtervalue, 'btype')){
					$service_type = substr($filtervalue, strpos($filtervalue, "btype=") +6);
					$service_type = explode('~',$service_type );
					$request->session()->put('service_type', $service_type[0]);
					$search = explode(",",$service_type[0]);
		            if(!empty($search)){
		                $all_activities->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $q->orWhere('service_type', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $nxtact->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $q->orWhere('service_type', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $this_nthactivity ->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $q->orWhere('service_type', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $most_popularactivity ->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $q->orWhere('service_type', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $Trainers_coaches_acitvity ->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $q->orWhere('service_type', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $Fun_Activities ->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $q->orWhere('service_type', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $Ways_To_Work_out ->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $q->orWhere('service_type', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $events_activity ->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $q->orWhere('service_type', 'LIKE', '%'. $data . '%');
		                    }
		                });
		            }
				}else {
	            	$request->session()->forget('service_type');
	        	}

	        	if(str_contains($filtervalue, 'ptype')){
					$program_type = substr($filtervalue, strpos($filtervalue, "ptype=") +6);
					$program_type = explode('~',$program_type );
					$request->session()->put('program_type', $program_type[0]);
					$search = explode(",",$program_type[0]);
		            if(!empty($search)){
		                $all_activities->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $data = ucwords($data);
		                        $q->orWhere('sport_activity', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $nxtact->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $data = ucwords($data);
		                        $q->orWhere('sport_activity', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $this_nthactivity->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $data = ucwords($data);
		                        $q->orWhere('sport_activity', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $most_popularactivity->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $data = ucwords($data);
		                        $q->orWhere('sport_activity', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $Trainers_coaches_acitvity->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $data = ucwords($data);
		                        $q->orWhere('sport_activity', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $Fun_Activities->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $data = ucwords($data);
		                        $q->orWhere('sport_activity', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $Ways_To_Work_out->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $data = ucwords($data);
		                        $q->orWhere('sport_activity', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $events_activity->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $data = ucwords($data);
		                        $q->orWhere('sport_activity', 'LIKE', '%'. $data . '%');
		                    }
		                });
		            }
				}else {
	            	$request->session()->forget('program_type');
	        	}

	        	if(str_contains($filtervalue, 'stype')){
					$service_type_two = substr($filtervalue, strpos($filtervalue, "stype=") +6);
					$service_type_two = explode('~',$service_type_two );
					$request->session()->put('service_type_two', $service_type_two[0]);
					$search = explode(",",$service_type_two[0]);
		            if(!empty($search)){
		                $all_activities->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $q->orWhere('select_service_type', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $nxtact->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $q->orWhere('select_service_type', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $this_nthactivity ->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $q->orWhere('select_service_type', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $most_popularactivity ->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $q->orWhere('select_service_type', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $Trainers_coaches_acitvity ->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $q->orWhere('select_service_type', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $Fun_Activities ->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $q->orWhere('select_service_type', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $Ways_To_Work_out ->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $q->orWhere('select_service_type', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $events_activity ->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $q->orWhere('select_service_type', 'LIKE', '%'. $data . '%');
		                    }
		                });
		            }
				}else {
	            	$request->session()->forget('service_type_two');
	        	}

	        	if(str_contains($filtervalue, 'gfor')){
					$Great_for = substr($filtervalue, strpos($filtervalue, "gfor=") +5);
					$Great_for = explode('~',$Great_for );
					$request->session()->put('activity_type', $Great_for[0]);
					$search = explode(",",$Great_for[0]);
		            if(!empty($search)){
		                $all_activities->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        $data = ucwords($data);
			                        $q->orWhere('activity_for', 'LIKE', '%'. $data . '%');
			                    }
			                }
			            });
		                $nxtact->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        $data = ucwords($data);
			                        $q->orWhere('activity_for', 'LIKE', '%'. $data . '%');
			                    }
			                }
			            });
		                $this_nthactivity ->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        $data = ucwords($data);
			                        $q->orWhere('activity_for', 'LIKE', '%'. $data . '%');
			                    }
			                }
			            });
		                $most_popularactivity ->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        $data = ucwords($data);
			                        $q->orWhere('activity_for', 'LIKE', '%'. $data . '%');
			                    }
			                }
			            });
		                $Trainers_coaches_acitvity ->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        $data = ucwords($data);
			                        $q->orWhere('activity_for', 'LIKE', '%'. $data . '%');
			                    }
			                }
			            });
		                $Fun_Activities ->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        $data = ucwords($data);
			                        $q->orWhere('activity_for', 'LIKE', '%'. $data . '%');
			                    }
			                }
			            });
		                $Ways_To_Work_out ->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        $data = ucwords($data);
			                        $q->orWhere('activity_for', 'LIKE', '%'. $data . '%');
			                    }
			                }
			            });

			            $events_activity ->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        $data = ucwords($data);
			                        $q->orWhere('activity_for', 'LIKE', '%'. $data . '%');
			                    }
			                }
			            });
		            }
				}else {
	            	$request->session()->forget('activity_type');
	        	}

	        	if(str_contains($filtervalue, 'memtype')){
					$memtype = substr($filtervalue, strpos($filtervalue, "memtype=") +8);
					$memtype = explode('~',$memtype );
					$request->session()->put('membership_type', $memtype[0]);
					$search = explode(",",$memtype[0]);
		            if(!empty($search)){
		                $all_activities->join('business_price_details', 'business_services.id', '=', 'business_price_details.serviceid')->select('business_services.*','business_price_details.membership_type')->groupby('business_services.id')->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $data = ucwords($data);
		                        $q->orWhere('membership_type', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $nxtact->join('business_price_details', 'business_services.id', '=', 'business_price_details.serviceid')->select('business_services.*','business_price_details.membership_type')->groupby('business_services.id')->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $data = ucwords($data);
		                        $q->orWhere('membership_type', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $this_nthactivity->join('business_price_details', 'business_services.id', '=', 'business_price_details.serviceid')->select('business_services.*','business_price_details.membership_type')->groupby('business_services.id')->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $data = ucwords($data);
		                        $q->orWhere('membership_type', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $most_popularactivity->join('business_price_details', 'business_services.id', '=', 'business_price_details.serviceid')->select('business_services.*','business_price_details.membership_type')->groupby('business_services.id')->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $data = ucwords($data);
		                        $q->orWhere('membership_type', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $Trainers_coaches_acitvity->join('business_price_details', 'business_services.id', '=', 'business_price_details.serviceid')->select('business_services.*','business_price_details.membership_type')->groupby('business_services.id')->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $data = ucwords($data);
		                        $q->orWhere('membership_type', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $Fun_Activities->join('business_price_details', 'business_services.id', '=', 'business_price_details.serviceid')->select('business_services.*','business_price_details.membership_type')->groupby('business_services.id')->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $data = ucwords($data);
		                        $q->orWhere('membership_type', 'LIKE', '%'. $data . '%');
		                    }
		                });
		                $Ways_To_Work_out->join('business_price_details', 'business_services.id', '=', 'business_price_details.serviceid')->select('business_services.*','business_price_details.membership_type')->groupby('business_services.id')->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $data = ucwords($data);
		                        $q->orWhere('membership_type', 'LIKE', '%'. $data . '%');
		                    }
		                });

		                $events_activity->join('business_price_details', 'business_services.id', '=', 'business_price_details.serviceid')->select('business_services.*','business_price_details.membership_type')->groupby('business_services.id')->where(function($q) use ($search) {
		                    foreach ($search as $data) {
		                        $data = ucwords($data);
		                        $q->orWhere('membership_type', 'LIKE', '%'. $data . '%');
		                    }
		                });
		            }
				}else {
	            	$request->session()->forget('membership_type');
	        	}

	        	if(str_contains($filtervalue, 'actloctype')){
					$actloctype = substr($filtervalue, strpos($filtervalue, "actloctype=") +11);
					$actloctype = explode('~',$actloctype );
					$request->session()->put('activity_location', $actloctype[0]);
					$search = explode(",",$actloctype[0]);
		            if(!empty($search)){
		                $all_activities->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        if(strpos($data,'_')!= ''){
			                            $data = ucwords(str_replace('_',' ', $data));
			                        }
			                        else{
			                            $data = ucwords($data);
			                        }
			                        $q->orWhere('activity_location', 'LIKE', '%'. $data . '%');
			                    }
			                }
		                });
		                $nxtact->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        if(strpos($data,'_')!= ''){
			                            $data = ucwords(str_replace('_',' ', $data));
			                        }
			                        else{
			                            $data = ucwords($data);
			                        }
			                        $q->orWhere('activity_location', 'LIKE', '%'. $data . '%');
			                    }
			                }
		                });
		                $this_nthactivity->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        if(strpos($data,'_')!= ''){
			                            $data = ucwords(str_replace('_',' ', $data));
			                        }
			                        else{
			                            $data = ucwords($data);
			                        }
			                        $q->orWhere('activity_location', 'LIKE', '%'. $data . '%');
			                    }
			                }
		                });
		                $most_popularactivity->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        if(strpos($data,'_')!= ''){
			                            $data = ucwords(str_replace('_',' ', $data));
			                        }
			                        else{
			                            $data = ucwords($data);
			                        }
			                        $q->orWhere('activity_location', 'LIKE', '%'. $data . '%');
			                    }
			                }
		                });
		                $Trainers_coaches_acitvity->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        if(strpos($data,'_')!= ''){
			                            $data = ucwords(str_replace('_',' ', $data));
			                        }
			                        else{
			                            $data = ucwords($data);
			                        }
			                        $q->orWhere('activity_location', 'LIKE', '%'. $data . '%');
			                    }
			                }
		                });
		                $Fun_Activities->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        if(strpos($data,'_')!= ''){
			                            $data = ucwords(str_replace('_',' ', $data));
			                        }
			                        else{
			                            $data = ucwords($data);
			                        }
			                        $q->orWhere('activity_location', 'LIKE', '%'. $data . '%');
			                    }
			                }
		                });
		                $Ways_To_Work_out->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        if(strpos($data,'_')!= ''){
			                            $data = ucwords(str_replace('_',' ', $data));
			                        }
			                        else{
			                            $data = ucwords($data);
			                        }
			                        $q->orWhere('activity_location', 'LIKE', '%'. $data . '%');
			                    }
			                }
		                });

		                $events_activity->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        if(strpos($data,'_')!= ''){
			                            $data = ucwords(str_replace('_',' ', $data));
			                        }
			                        else{
			                            $data = ucwords($data);
			                        }
			                        $q->orWhere('activity_location', 'LIKE', '%'. $data . '%');
			                    }
			                }
		                });
		            }
				}else {
	            	$request->session()->forget('activity_location');
	        	}

	        	if(str_contains($filtervalue, 'agerange')){
					$age_range = substr($filtervalue, strpos($filtervalue, "agerange=") +9);
					$age_range = explode('~',$age_range );
					$request->session()->put('age_range', $age_range[0]);
					$search = explode(",",$age_range[0]);
		            if(!empty($search)){
		                $all_activities->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        if(strpos($data,'_')!= ''){
			                            $data = ucwords(str_replace('_',' ', $data));
			                        }
			                        else{
			                            $data = ucwords($data);
			                        }
			                        $q->orWhere('age_range', 'LIKE', '%'. $data . '%');
			                    }
			                }
		                });
		                $nxtact->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        if(strpos($data,'_')!= ''){
			                            $data = ucwords(str_replace('_',' ', $data));
			                        }
			                        else{
			                            $data = ucwords($data);
			                        }
			                        $q->orWhere('age_range', 'LIKE', '%'. $data . '%');
			                    }
			                }
		                });
		                $this_nthactivity->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        if(strpos($data,'_')!= ''){
			                            $data = ucwords(str_replace('_',' ', $data));
			                        }
			                        else{
			                            $data = ucwords($data);
			                        }
			                        $q->orWhere('age_range', 'LIKE', '%'. $data . '%');
			                    }
			                }
		                });
		                $most_popularactivity->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        if(strpos($data,'_')!= ''){
			                            $data = ucwords(str_replace('_',' ', $data));
			                        }
			                        else{
			                            $data = ucwords($data);
			                        }
			                        $q->orWhere('age_range', 'LIKE', '%'. $data . '%');
			                    }
			                }
		                });
		                $Trainers_coaches_acitvity->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        if(strpos($data,'_')!= ''){
			                            $data = ucwords(str_replace('_',' ', $data));
			                        }
			                        else{
			                            $data = ucwords($data);
			                        }
			                        $q->orWhere('age_range', 'LIKE', '%'. $data . '%');
			                    }
			                }
		                });
		                $Fun_Activities->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        if(strpos($data,'_')!= ''){
			                            $data = ucwords(str_replace('_',' ', $data));
			                        }
			                        else{
			                            $data = ucwords($data);
			                        }
			                        $q->orWhere('age_range', 'LIKE', '%'. $data . '%');
			                    }
			                }
		                });
		                $Ways_To_Work_out->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        if(strpos($data,'_')!= ''){
			                            $data = ucwords(str_replace('_',' ', $data));
			                        }
			                        else{
			                            $data = ucwords($data);
			                        }
			                        $q->orWhere('age_range', 'LIKE', '%'. $data . '%');
			                    }
			                }
		                }); 

		                $events_activity->where(function($q) use ($search) {
			                if(!in_array("any", $search)){
			                    foreach ($search as $data) {
			                        if(strpos($data,'_')!= ''){
			                            $data = ucwords(str_replace('_',' ', $data));
			                        }
			                        else{
			                            $data = ucwords($data);
			                        }
			                        $q->orWhere('age_range', 'LIKE', '%'. $data . '%');
			                    }
			                }
		                });
		            }
				}else {
	            	$request->session()->forget('age_range');
	        	}

				if(str_contains($filtervalue, 'country') ){
					$country = substr($filtervalue, strpos($filtervalue, "country=") +8);
					$country = explode('~',$country);
					$request->session()->put('country', $country[0]);
					$search = $country[0];

					$all_activities = $this->buildQuery($all_activities,'country',$search);
					$this_nthactivity = $this->buildQuery($this_nthactivity,'country',$search);
					$most_popularactivity = $this->buildQuery($most_popularactivity,'country',$search);
					$Trainers_coaches_acitvity = $this->buildQuery($Trainers_coaches_acitvity,'country',$search);
					$Fun_Activities = $this->buildQuery($Fun_Activities,'country',$search);
					$Ways_To_Work_out = $this->buildQuery($Ways_To_Work_out,'country',$search);
					$events_activity = $this->buildQuery($events_activity,'country',$search);
					$nxtact = $this->buildQuery($nxtact,'country',$search);
	            }else {
	            	$request->session()->forget('country');
	        	}
	        	

	        	if(str_contains($filtervalue, 'state') ){
					$state = substr($filtervalue, strpos($filtervalue, "state=") +6);
					$state = explode('~',$state);
					$request->session()->put('state', $state[0]);
					$search = $state[0];
					$all_activities = $this->buildQuery($all_activities,'state',$search);
					$this_nthactivity = $this->buildQuery($this_nthactivity,'state',$search);
					$most_popularactivity = $this->buildQuery($most_popularactivity,'state',$search);
					$Trainers_coaches_acitvity = $this->buildQuery($Trainers_coaches_acitvity,'state',$search);
					$Fun_Activities = $this->buildQuery($Fun_Activities,'state',$search);
					$Ways_To_Work_out = $this->buildQuery($Ways_To_Work_out,'state',$search);
					$events_activity = $this->buildQuery($events_activity,'state',$search);
					$nxtact = $this->buildQuery($nxtact,'state',$search);
	            }else {
	            	$request->session()->forget('state');
	        	}

	        	if(str_contains($filtervalue, 'zip_code') ){
					$zip_code = substr($filtervalue, strpos($filtervalue, "zip_code=") +9);
					$zip_code = explode('~',$zip_code);
					$request->session()->put('zip_code', $zip_code[0]);
					$search = $zip_code[0];
					$all_activities = $this->buildQuery($all_activities,'zip_code',$search);
					$this_nthactivity = $this->buildQuery($this_nthactivity,'zip_code',$search);
					$most_popularactivity = $this->buildQuery($most_popularactivity,'zip_code',$search);
					$Trainers_coaches_acitvity = $this->buildQuery($Trainers_coaches_acitvity,'zip_code',$search);
					$Fun_Activities = $this->buildQuery($Fun_Activities,'zip_code',$search);
					$Ways_To_Work_out = $this->buildQuery($Ways_To_Work_out,'zip_code',$search);
					$events_activity = $this->buildQuery($events_activity,'zip_code',$search);
					$nxtact = $this->buildQuery($nxtact,'zip_code',$search);
	            }else {
	            	$request->session()->forget('zip_code');
	        	}

	        	if(str_contains($filtervalue, 'city') ){
					$city = substr($filtervalue, strpos($filtervalue, "city=") +5);
					$city = explode('~',$city);
					$request->session()->put('city', $city[0]);
					$search = $city[0];
					$all_activities = $this->buildQuery($all_activities,'city',$search);
					$this_nthactivity = $this->buildQuery($this_nthactivity,'city',$search);
					$most_popularactivity = $this->buildQuery($most_popularactivity,'city',$search);
					$Trainers_coaches_acitvity = $this->buildQuery($Trainers_coaches_acitvity,'city',$search);
					$Fun_Activities = $this->buildQuery($Fun_Activities,'city',$search);
					$Ways_To_Work_out = $this->buildQuery($Ways_To_Work_out,'city',$search);
					$events_activity = $this->buildQuery($events_activity,'city',$search);
					$nxtact = $this->buildQuery($nxtact,'city',$search);
	            }else {
	            	$request->session()->forget('city');
	        	}

	        	if(str_contains($filtervalue, 'address')){
	        		$address = substr($filtervalue, strpos($filtervalue, "address=") +8);
					$address = explode('~',$address);
					$request->session()->put('address', $address[0]);
	        	}else {
	            	$request->session()->forget('address');
	        	}
				/*$allactivities = $all_activities->get();
	        	dd(DB::getQueryLog());*/
	        	/*exit;*/
			}else {
	            $request->session()->forget('service_type');
	            $request->session()->forget('program_type');
	            $request->session()->forget('service_type_two');
	            $request->session()->forget('activity_type');
	            $request->session()->forget('membership_type');
	            $request->session()->forget('activity_location');
	            $request->session()->forget('age_range');
	            $request->session()->forget('state');
	            $request->session()->forget('country');
	            $request->session()->forget('zip_code');
	            $request->session()->forget('city');
	            $request->session()->forget('address');
	        }	

	        $nxtacty = $nxtact->get();
	        $current_date = new DateTime();
	        $bookschedulers = BusinessActivityScheduler::next_8_hours($current_date)->whereIn('serviceid', $nxtacty->pluck('id'))->limit(3)->get();
	       
			$allactivities = $all_activities->limit(10)->get();
			
			$thismonthactivity = $this_nthactivity->limit(10)->get();
			$mostpopularactivity = $most_popularactivity->limit(10)->get();
			$Trainers_coachesacitvity  = $Trainers_coaches_acitvity->limit(10)->get();
			$Fun_Activities  = $Fun_Activities->limit(10)->get();
			$Ways_To_Workout = $Ways_To_Work_out->limit(10)->get();
			$events_activity = $events_activity->limit(10)->get();

			$serviceLocation = Miscellaneous::serviceLocation();
			$getstarteddata =  ActivtyGetStartedFast::orderby('id','asc')->get();


			if($searchDatauserProfile != ''){
	            return Redirect::to('/userprofile/'.$searchDatauserProfile->username);
	        }else if($searchDatabusiness !=''){
	            return Redirect::to('businessprofile/'.$searchDatabusiness->dba_business_name.'/'.$searchDatabusiness->id);
	        }else if($searchDataacivity !=''){
	            return Redirect::to('/activity-details/'.$searchDataacivity->id);
	        }else{
				return view('activity.index',[
					'allactivities'=>$allactivities,
					'thismonthactivity'=>$thismonthactivity,
					'mostpopularactivity'=>$mostpopularactivity,
					'Fun_Activities'=>$Fun_Activities,
					'Ways_To_Workout'=>$Ways_To_Workout,
					'events_activity'=>$events_activity,
					'Trainers_coachesacitvity'=>$Trainers_coachesacitvity,
					'bookschedulers' => $bookschedulers,
					'serviceLocation'=>$serviceLocation,
					'getstarteddata'=>$getstarteddata,
					 'current_date' => $current_date,
				]);
			}
		}
	}

	public function buildQuery($modal,$column,$search){
		return $modal->join("company_informations as cic{$column}", 'business_services.cid', '=', "cic{$column}.id")->where("cic{$column}.{$column}", 'LIKE', '%'. $search . '%')->select('business_services.*')->groupby('business_services.id');
	}

	public function loadMoreData(Request $request)
	{
		print_r($request->all());exit;
	}

	public function activity (Request $request)
	{
		return view('activity.activity');
	}

	public function show(Request $request ,$serviceid) {
      	$cart = [];
      	$cart = $request->session()->get('cart_item') ? $request->session()->get('cart_item') : [];
      	$service = BusinessServices::findOrFail($serviceid);
      	$activities_search = BusinessServices::where('cid', $service['cid'])
	    	->where('is_active', '1')
	    	->where('id', '!=' , $serviceid)
	    	->orderBy('id', 'DESC')
	    	->get();
       	return view('activity.show', [
        	'cart' => $cart,
        	'service' =>$service,
        	'activities_search' =>$activities_search
      	]);
    }

    public function getCompareProfessionalDetailInstant($id) {
        $professional_id = array();
        if (isset($id) && $id != "") {
            $professional_id = explode(",", $id);
        }

        $profiledetail = DB::table('business_services')->whereIn('business_services.id', $professional_id);
        $profiledetail = $profiledetail->join('company_informations', 'business_services.cid', '=', 'company_informations.id')->select('business_services.*','company_informations.first_name', 'company_informations.last_name', 'company_informations.email','company_informations.company_name', 'company_informations.address', 'company_informations.state', 'company_informations.city', 'company_informations.country', 'company_informations.zip_code' );
        $profiledetail = $profiledetail->join('business_price_details','business_services.id', '=', 'business_price_details.serviceid');
        $profiledetail = $profiledetail->get();
        
        $return = array();
        if (count($professional_id) == 0) {
            $return['status'] = false;
            return json_encode($return);
        }

        // print_r($profiledetail);die;

        $sports_names = $this->sports->getAllSportsNames();
        $data = array();
        foreach ($profiledetail as $profile) {
            $c_names = '';
            
            $servicePrice = BusinessPriceDetails::where('serviceid', $profile->id)->limit(1)->get()->toArray();
            $data["profile_" . $profile->id] = array();
            $data["profile_" . $profile->id]['business'] = BusinessServices::find($profile->id);
            $data["profile_" . $profile->id]['company_names'] =  (isset($profile->dba_business_name)?@$profile->dba_business_name:'');
            //$data["profile_" . $profile->id]['price'] = (isset($profile->service[0])?$profile->service[0]->price:'');
            $data["profile_" . $profile->id]['price'] = (isset($servicePrice[0]['pay_price'])?$servicePrice[0]['pay_price']:'');
            $data["profile_" . $profile->id]['description'] = (isset($profile->program_desc)?$profile->program_desc:'');
            $data["profile_" . $profile->id]['city'] = (isset($profile->city)?$profile->city:'');
            $data["profile_" . $profile->id]['state'] = (isset($profile->state)?$profile->state:'');
            $data["profile_" . $profile->id]['zip_code'] = (isset($profile->zip_code)?$profile->zip_code:'');
            $data["profile_" . $profile->id]['instructor_habit'] = (isset($profile->instructor_habit)?$profile->instructor_habit:'');
            $reviews_count = BusinessServiceReview::where('service_id', $profile->id)->count();
            $data["profile_" . $profile->id]['reviews'] = '<i class="fa fa-star" aria-hidden="true"></i> '.$reviews_count.'<a href="#" onclick="viewActreview('.$profile->id.')"> View </a>';
        
            
            $arrComp = CompanyInformation::find($data["profile_" . $profile->id]['business']->cid);
            
            $data["profile_" . $profile->id]['business_name'] = (isset($arrComp->dba_business_name)?@$arrComp->dba_business_name:'');
            
            if (isset($profile->ProfessionalDetail->experience_level) &&  $profile->ProfessionalDetail->experience_level!== "") { 
                if($this->isJson($profile->ProfessionalDetail->experience_level)){
                    $experienceLevel =  json_decode($profile->ProfessionalDetail->experience_level);
                    if (count((array)$experienceLevel) > 0) {
                        $experienceLevel_concat = "";
                        foreach ($experienceLevel as $val) {
                            if ($experienceLevel_concat === "") {
                                $experienceLevel_concat = Miscellaneous::getBusinessProfileAnswers($val);
                            } else {
                                $experienceLevel_concat .= ', ' . Miscellaneous::getBusinessProfileAnswers($val);
                            }
                        }
                    }
                    $data["profile_" . $profile->id]['explevel'] = $experienceLevel_concat;
                }
                else{
                    $data["profile_" . $profile->id]['explevel'] = "-";
                }
            }
            
            if (isset($profile->ProfessionalDetail->train_to) &&  $profile->ProfessionalDetail->train_to!== "") { 
                if(is_object($profile->ProfessionalDetail->train_to)){
                    $train_to = explode(',', $profile->ProfessionalDetail->train_to);
                    
                    if (count($train_to) > 0) {
                        $train_concat = "";
                        foreach ($train_to as $val) {
                            if ($train_concat === "") {
                                $train_concat = Miscellaneous::getAnswers($val);
                            } else {
                                $train_concat .= ', ' . Miscellaneous::getAnswers($val);
                            }
                        }
                    }
                     $data["profile_" . $profile->id]['train_to'] = ($profile->ProfessionalDetail->train_to != "") ? json_decode($train_concat) : "-";
                }
                else{
                     $data["profile_" . $profile->id]['train_to'] = "-";
                }
            }
    
            $data["profile_" . $profile->id]['personality'] = "-";
            if (isset($profile->ProfessionalDetail->personality) &&  $profile->ProfessionalDetail->personality!== "") { 
                if($this->isJson($profile->ProfessionalDetail->personality)){
                    $personality =  json_decode($profile->ProfessionalDetail->personality);
                    if (count((array)$personality) > 0) {
                        $personality_concat = "";
                        foreach ($personality as $val) {
                            if ($personality_concat === "") {
                                $personality_concat = Miscellaneous::getAnswers($val);
                            } else {
                                $personality_concat .= ', ' . Miscellaneous::getAnswers($val);
                            }
                        }
                    }

                    $data["profile_" . $profile->id]['personality'] = $personality_concat;
                }
            }

            $data["profile_" . $profile->id]['availability'] = '-';
            if (isset($profile->ProfessionalDetail->availability) && $profile->ProfessionalDetail->availability!== "") {
                $checkAvailability = '';
                if($this->isJson($profile->ProfessionalDetail->availability)){
                    $checkAvailability = json_decode($profile->ProfessionalDetail->availability);
                }
                else{
                    $checkAvailability = $profile->ProfessionalDetail->availability;
                }
                $data["profile_" . $profile->id]['availability'] = $checkAvailability;
            }
            
            $data["profile_" . $profile->id]['professional_type'] = (isset($profile->ProfessionalDetail->professional_type) &&  $profile->ProfessionalDetail->professional_type!= "") ? ucfirst($profile->ProfessionalDetail->professional_type) : "-";
            $data["profile_" . $profile->id]['willing_to_travel'] = (isset($profile->ProfessionalDetail->willing_to_travel) &&  $profile->ProfessionalDetail->willing_to_travel!= "") ? str_replace(",", ", ", ucfirst($profile->ProfessionalDetail->willing_to_travel)) : "-";
            $data["profile_" . $profile->id]['travel_miles'] = (isset($profile->ProfessionalDetail->travel_miles) &&  $profile->ProfessionalDetail->travel_miles != "") ? str_replace(",", ", ", $profile->ProfessionalDetail->travel_miles) : "-";

            $data["profile_" . $profile->id]['certification'] = "-";
            $data["profile_" . $profile->id]['service'] = "-";
            $data["profile_" . $profile->id]['sport'] = "-";
        }
        
        $arrItems = array();
        $setArray = array();
        
        if(count($data)>0){
            foreach($data as $k=>$val){
                
                $getId = explode('_',$k);
                $indexid = $getId[1];
                $offer='';
                if( !empty($val['business']->activity_experience) ){ $offer .= $val['business']->activity_experience;}
                if( !empty($val['business']->activity_for) ){ $offer .= ', '.$val['business']->activity_for;}
                if( !empty($val['business']->activity_location) ){ $offer .= ', '.$val['business']->activity_location;}
                
                $setArray['image_pic'][$indexid] = $indexid;
                $setArray['program_name'][$indexid] = $val['business']->program_name;
                $setArray['description'][$indexid] = (($val['description']!='')?substr($val['description'],0,30):'');
                $setArray['sport_activity'][$indexid] = $val['business']->sport_activity;
                $setArray['reviews'][$indexid] = (($val['reviews']!='')?$val['reviews']:'');
                $setArray['price'][$indexid] = (($val['price']!='')?'$'.$val['price']:'');
                $setArray['address'][$indexid] =  (($val['city']!='')?$val['city'].',':'').(($val['state']!='')?$val['state'].',':'').(($val['zip_code']!='')?$val['zip_code']:'');
                $setArray['business_name'][$indexid] = $val['business_name'];
                $setArray['business_verified'][$indexid] = '-';
                $setArray['background_checked'][$indexid] = '-';
                $setArray['offers_services_to'][$indexid] = $val['business']->activity_for;
                $setArray['other_activities_offerd'][$indexid] = $offer;
                $setArray['instructor_habit'][$indexid] = (($val['instructor_habit']!='')?$val['instructor_habit']:'');
                $setArray['type_of_service'][$indexid] = $val['business']->service_type;
                $setArray['location_of_service'][$indexid] = $val['business']->activity_location;
                $setArray['experience_of_activity'][$indexid] = $val['business']->activity_experience;
                $setArray['details_button'][$indexid] = $val['business']->cid;
            }
        }
        $data = $setArray;
        $return['status'] = true;
        $return['data'] = $data;
        return json_encode($return);
    }

    public function act_detail_filter(Request $request){
    	/*print_r($request->all());exit;*/
        $actoffer = $request->actoffer;
        $actloc = $request->actloc;
        $actfilmtype = $request->actfilmtype;
        $actfilgreatfor = $request->actfilgreatfor;
        $actfilparticipant=$request->actfilparticipant;
        $actfilsType=$request->actfilsType;
        $btype = $request->btype;
        $actdate = $request->actdate;
        $serviceid = $request->serviceid;
        $companyid = $request->companyid;
        
        // DB::enableQueryLog();
        //$searchData = BusinessServices::where('cid', $companyid)->where('is_active', 1)->where('id', '!=' , $serviceid);

        $searchData = DB::table('business_services')->where('business_services.cid', $companyid)->where('business_services.is_active', 1)->where('business_services.id', '!=' , $serviceid);
        if( !empty($actoffer) )
        {
            $searchData->Where('sport_activity', $actoffer);
        }
        if( !empty($actloc) )
        {
             $searchData->whereRaw('FIND_IN_SET("'.$actloc.'",activity_location)');
        }
        if( !empty($actfilmtype) )
        {
            $searchData->join('business_price_details', 'business_services.id', '=', 'business_price_details.serviceid')->
            select('business_services.*','business_price_details.membership_type')->
            Where('membership_type', $actfilmtype);
        }
      
        if( !empty($actfilgreatfor) )
        {
            $searchData->whereRaw('FIND_IN_SET("'.$actfilgreatfor.'",activity_for)');
        }
        if( !empty($btype) )
        {
            $searchData->Where('service_type', $btype);
        }
        if( !empty($actdate) )
        {
            $dt = date('Y-m-d',strtotime($actdate) );
            
            $enddt = date('Y-m-d',strtotime($actdate));
            
            //Where('business_activity_scheduler.starting', $dt);
            /*BusinessActivityScheduler::where('serviceid',$serviceid)->where('cid',$companyid)->where('starting','<=',date('Y-m-d',strtotime($actdate)) )->where('end_activity_date','>=',  date('Y-m-d',strtotime($actdate)) )->whereRaw('FIND_IN_SET("'.date('l',strtotime($actdate)).'",activity_days)')->get();*/

            $searchData->join('business_activity_scheduler as bas', 'business_services.id', '=', 'bas.serviceid')->select('business_services.*','bas.end_activity_date')->where('bas.end_activity_date','>=',  $dt )->whereRaw('FIND_IN_SET("'.date('l',strtotime($actdate)).'",bas.activity_days)')->groupby('business_services.id')->distinct();
        }
        if( !empty($actfilsType) )
        {
            $searchData->whereRaw('FIND_IN_SET("'.$actfilsType.'",select_service_type)');
        }
       /* DB::enableQueryLog();*/
        $activity1 = $searchData->distinct()->get()->toArray();
        // dd(\DB::getQueryLog());
        
        $activity = json_decode(json_encode($activity1), true);
        $actbox='';
        //dd(\DB::getQueryLog());
       /* print_r($activity);exit;*/
        if (!empty($activity)) { 
            $companyid = $companyname = $serviceid = $companycity = $companycountry = $pay_price  = "";
            foreach ($activity as  $act) {
                $company = $price = $businessSp = [];
                $serviceid = $act['id'];
                $sport_activity = $act['sport_activity'];
                $companyData = CompanyInformation::where('id',$act['cid'])->first();
                if (isset($companyData)) {
                    $companyid = $companyData['id'];
                    $companyname = $companyData['dba_business_name'];
                    $companycity = $companyData['city'];
                    $companycountry = $companyData['country'];    
                }
                if ($act['profile_pic']!="") {
                	if(str_contains($act['profile_pic'], ',')){
                        $pic_image = explode(',', $act['profile_pic']);
                        if( $pic_image[0] == ''){
                           $p_image  = $pic_image[1];
                        }else{
                            $p_image  = $pic_image[0];
                        }
                    }else{
                        $p_image = $act['profile_pic'];
                    }

                    if (file_exists( public_path() . '/uploads/profile_pic/' . $p_image)) {
                       $profilePic = url('/public/uploads/profile_pic/' . $p_image);
                    }else {
                       $profilePic = url('/public/images/service-nofound.jpg');
                    }

				}else{ $profilePic = '/public/images/service-nofound.jpg'; }

                $reviews_count = BusinessServiceReview::where('service_id', $act['id'])->count();
                $reviews_sum = BusinessServiceReview::where('service_id', $act['id'])->sum('rating');
                $reviews_avg=0;
                if($reviews_count>0)
                {   
                    $reviews_avg= round($reviews_sum/$reviews_count,2); 
                }
                
                $redlink = str_replace(" ","-",$companyname)."/".$act['cid'];
                $service_type='';
                if($act['service_type']!=''){
                    if( $act['service_type']=='individual' ) {$service_type = 'Personal Training'; }
                    else if( $act['service_type']=='classes' ) { $service_type = 'Group Class';} 
                    else if( $act['service_type']=='experience' ) { $service_type = 'Experience'; }
                }
                $pricearr = [];
                $price_all = '';
                $ser_date = '';

                $price_allarray = BusinessPriceDetails::where('serviceid', $act['id'])->get();
                if(!empty($price_allarray)){
                    foreach ($price_allarray as $key => $value) {
                        $pricearr[] = $value->pay_price;
                    }
                }
                if(!empty($pricearr)){
                    $price_all = min($pricearr);
                }
                
                $bookscheduler='';
                $time='';
                $bookscheduler = BusinessActivityScheduler::where('serviceid', $act['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
                if(@$bookscheduler[0]['set_duration']!=''){
                    $tm=explode(' ',$bookscheduler[0]['set_duration']);
                    $hr=''; $min=''; $sec='';
                    if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
                    if($tm[2]!=0){ $min=$tm[2].'min. '; }
                    if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
                    if($hr!='' || $min!='' || $sec!='')
                    { $time =  $hr.$min.$sec; } 
                }

                if( !empty( $actdate) ){
                   /* $p=$act['schedule_until'];*/
                    /*$enddt = date('Y-m-d', strtotime("+".$p, strtotime($act['starting'])) );*/ 
                    $enddt = $act['end_activity_date'];
                    $flterdt = date('Y-m-d',strtotime($actdate) );
                    if( $flterdt <= $enddt ){
                        $actbox .= '<div class="col-md-4 col-sm-12 col-xs-12 ">
                                        <div class="find-activity">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <div class="img-modal-left">
                                                        <img src="'.$profilePic.'" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-6 col-xs-12 activity-data">
                                                    <div class="activity-inner-data">
                                                        <i class="fas fa-star"></i>
                                                        <span> '.$reviews_avg.' ('.$reviews_count.')  </span>
                                                    </div>';
                                                    if($time != ''){
                                                        $actbox .= '<div class="activity-hours">
                                                            <span>'.$time.'</span>
                                                        </div>';
                                                    }
                                                    $actbox .= '<div class="activity-city">
                                                        <span>'.$companycity.', '.$companycountry.'</span>';
                                                    if(Auth::check()){
                                                        $loggedId = Auth::user()->id;
                                                        $favData = BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$act['id'])->first();
                                                        $actbox .= '<div class="serv_fav1" ser_id="'.$act["id"].'">
                                                            <a class="fav-fun-2" id="serfav'.$act["id"].'">';
                                                        if( !empty($favData) ){ 
                                                            $actbox .= '<i class="fas fa-heart"></i>';
                                                        }else{ 
                                                            $actbox .= '<i class="far fa-heart"></i>';
                                                        } 
                                                        $actbox .= '</a></div> '; 
                                                    }else{
                                                        $actbox .= '<a class="fav-fun-2" href="'.Config::get('constants.SITE_URL').'/userlogin" ><i class="far fa-heart"></i></a>';
                                                    }
                                                    $actbox .= '</div>
                                                        <div class="activity-information">
                                                        <span><a';
                                                        if (Auth::check()) { 
                                                            $actbox .= 'href="'.Config::get('constants.SITE_URL').'/businessprofile/'.$redlink.'"';
                                                        }else { 
                                                            $actbox .= 'href="'.Config::get('constants.SITE_URL').'/userlogin"';
                                                        }
                                                        $actbox .= 'target="_blank">'. $act['program_name'] .'</a></span>
                                                            <p>'. $service_type .' | '. $act['sport_activity'] .'</p>
                                                            <a class="showall-btn" href="/activity-details/'.$act['id'].'">Book Now</a>
                                                        </div>';
                                                        if($price_all != ''){
                                                            $actbox .= '<div>
                                                                <span class="activity-time">From $'.$price_all.'/Person</span>
                                                            </div>';
                                                        }
                                                $actbox .= '</div>
                                                </div>
                                            </div>
                                        </div>';
                    }
                }else{
                    $actbox .= '<div class="col-md-12 col-sm-8 col-xs-12 ">
                                    <div class="find-activity">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-12">
                                                <div class="img-modal-left">
                                                    <img src="'.$profilePic.'" >
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-sm-8 col-xs-12 activity-data">
                                                <div class="activity-inner-data">
                                                    <i class="fas fa-star"></i>
                                                    <span> '.$reviews_avg.' ('.$reviews_count.')  </span>
                                                </div>';
                                                if($time != ''){
                                                    $actbox .= '<div class="activity-hours">
                                                        <span>'.$time.'</span>
                                                    </div>';
                                                }
                                                $actbox .= '<div class="activity-city">
                                                    <span>'.$companycity.', '.$companycountry.'</span>';
                                                if(Auth::check()){
                                                    $loggedId = Auth::user()->id;
                                                    $favData = BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$act['id'])->first();
                                                    $actbox .= '<div class="serv_fav1" ser_id="'.$act["id"].'">
                                                        <a class="fav-fun-2" id="serfav'.$act["id"].'">';
                                                    if( !empty($favData) ){ 
                                                        $actbox .= '<i class="fas fa-heart"></i>';
                                                    }else{ 
                                                        $actbox .= '<i class="far fa-heart"></i>';
                                                    } 
                                                    $actbox .= '</a></div> '; 
                                                }else{
                                                    $actbox .= '<a class="fav-fun-2" href="'.Config::get('constants.SITE_URL').'/userlogin" ><i class="far fa-heart"></i></a>';
                                                }
                                                $actbox .= '</div>
                                                    <div class="activity-information">
                                                    <span><a';
                                                    if (Auth::check()) { 
                                                        $actbox .= 'href="'.Config::get('constants.SITE_URL').'/businessprofile/'.$redlink.'"';
                                                    }else { 
                                                        $actbox .= 'href="'.Config::get('constants.SITE_URL').'/userlogin"';
                                                    }
                                                    $actbox .= 'target="_blank">'. $act['program_name'] .'</a></span>
                                                        <p>'. $service_type .' | '. $act['sport_activity'] .'</p>
                                                        <a class="showall-btn" href="/activity-details/'.$act['id'].'">Book Now</a>
                                                    </div>';
                                                    if($price_all != ''){
                                                        $actbox .= '<div>
                                                            <span class="activity-time">From $'.$price_all.'/Person</span>
                                                        </div>';
                                                    }
                                            $actbox .= '</div>
                                            </div>
                                        </div>
                                    </div>';
                }
            }
        }
        
        
        echo $actbox;
        exit;
    }

    public function act_detail_filter_for_cart(Request $request){
    	//print_r($request->all());exit;
    	$schedule = $priceId  = $priceOption = '';

    	$activityDate = $request->actdate;
        $serviceId = $request->serviceid;
        $companyId = $request->companyid;
        $categoryId = $request->categoryId;
        $priceId = $request->priceId;
        $scheduleId = $request->scheduleId;
        $businessService = BusinessService::where('cid' ,$companyId)->first();
        $chkFound = strpos(@$service->special_days_off , date('m/d/Y',strtotime($activityDate))) !== false ?  "Found" : "Not" ;

        $service = BusinessServices::where('id' ,$serviceId)->first();
        if($activityDate != ''){
        	$schedule = BusinessActivityScheduler::where('serviceid',$serviceId)->where('cid',$companyId)->where('starting','<=',date('Y-m-d',strtotime($activityDate)) )->where('end_activity_date','>=',  date('Y-m-d',strtotime($activityDate)) )->whereRaw('FIND_IN_SET("'.date('l',strtotime($activityDate)).'",activity_days)');
	    }

	    $schedulers = $schedule != '' ? $schedule->get() : [];
	    $firstSchedule = $schedule != '' ? $schedule->first() : '';

	   	
	   	$rawcategory = $service->BusinessPriceDetailsAges()->orderBy('id', 'ASC');
        $categories = $firstSchedule != '' ? $rawcategory->where('visibility_to_public' , 1)->get() : [];
        
        $firstCategory = $firstSchedule != '' ?  $rawcategory->when($categoryId, function ($query) use ($categoryId) {
		    $query->where('id', $categoryId);
		})->where('visibility_to_public' , 1)->first() : '';
   		$categoryId = $categoryId ?? @$firstCategory->id;

        $prices = $firstCategory  != '' ? $firstCategory->BusinessPriceDetails()->orderBy('id', 'ASC')->get() : []; 

        $addOnServices = $firstCategory  != '' ?  $firstCategory->AddOnService: [];
      
       	//print_r($addOnServices);exit;
        if (!empty(@$prices)) {
        	$priceId = $priceId ?? $prices[0]['id'];
            foreach ($prices as  $pr) {
            	$select = $pr['id'] == $priceId ? 'selected' : '';
                $priceOption .='<option value="'.$pr['id'].'" '.$select.'>'.$pr['price_title'].'</option>';
            }
        }

        $BusinessActivityScheduler = BusinessActivityScheduler::where('serviceid',$serviceId)->where('category_id',@$firstCategory->id)->where('starting','<=',date('Y-m-d',strtotime($activityDate)) )->where('end_activity_date','>=',  date('Y-m-d',strtotime($activityDate)) )->whereRaw('FIND_IN_SET("'.date('l',strtotime($activityDate)).'",activity_days)');
		
		$bschedule = $BusinessActivityScheduler->get();

		$bschedulefirst = $scheduleId != '' ? $BusinessActivityScheduler->when($scheduleId, function ($query) use ($scheduleId) {
		    $query->where('id', $scheduleId);
		})->first() : '';

		$scheduleId = $scheduleId ?? '';
		$timeChk= 1;
		if(date('Y-m-d',strtotime($activityDate)) == date('Y-m-d') ){
            $start = new DateTime(@$bschedulefirst->shift_start);
            $start_time = $start->format("H:i");
            $current = new DateTime();
            $current_time =  $current->format("H:i");
            
            if($current_time > $start_time && @$bschedulefirst->shift_start != ''){
               	$timeChk= 0;
            }
        }
        
        $pricedata = BusinessPriceDetails::where('id', $priceId)->first();

        $totalquantity =0;
        $SpotsLeft = UserBookingDetail::where('act_schedule_id',@$bschedulefirst->id)->whereDate('bookedtime', '=', date('Y-m-d',strtotime($activityDate)))->get();

        foreach($SpotsLeft as $data){
            $totalquantity += $data->userBookingDetailQty();
		}

		$maxSports = @$bschedulefirst->spots_available != '' ? $bschedulefirst->spots_available - $totalquantity : 0;

		$adult_price =  $pricedata != '' && $scheduleId != ''  ? $pricedata->getCurrentPrice('adult',$request->date) : 0;
        $child_price =  $pricedata != '' && $scheduleId != '' ? $pricedata->getCurrentPrice('child',$request->date) : 0;  
        $infant_price = $pricedata != '' && $scheduleId != '' ? $pricedata->getCurrentPrice('infant',$request->date) : 0;

        $adultDiscountPrice=  $pricedata != '' && $scheduleId != '' ? $pricedata->getDiscoutPrice('adult',$request->date) : 0;
        $childDiscountPrice=  $pricedata != '' && $scheduleId != '' ? $pricedata->getDiscoutPrice('child',$request->date) : 0;  
        $infantDiscountPrice= $pricedata != '' && $scheduleId != '' ? $pricedata->getDiscoutPrice('infant',$request->date) : 0;

        $paySession = @$pricedata->pay_session;

        $date = new DateTime($activityDate);
		$formattedDate = $date->format('l, F j, Y');

    	$html = View::make('activity.activity_booking_html')->with(['activityDate' => $activityDate, 'serviceId' => $serviceId , 'companyId' => $companyId  ,'chk_found'=>$chkFound ,'categories' => $categories, 'priceOption' =>$priceOption,'bschedule' =>$bschedule , 'timeChk' => $timeChk ,'maxSports' =>  $maxSports , 'adultPrice' => $adult_price , 'childPrice' => $child_price, 'infantPrice' => $infant_price , 'addOnServices' =>$addOnServices ,'priceId' =>$priceId ,'bschedulefirst' => $bschedulefirst ,'date' =>$date,'categoryId' =>$categoryId ,'scheduleId' =>$scheduleId , 'paySession' => $paySession ,'adultDiscountPrice' => $adultDiscountPrice,'childDiscountPrice' => $childDiscountPrice,'infantDiscountPrice' => $infantDiscountPrice])->render();

 		return response()->json(['html' => $html ,'date'=>$formattedDate]);
    }

    public function getAddOnData(Request $request){
    	$aos = AddOnService::find($request->id);
    	$serviceName = $aos->service_name;
    	$description = $aos->service_description ?? 'Not available';
    	return view('activity.addOnDescription',compact('description','serviceName'));
    }

    public function getBookingSummary(Request $request){
    	$childCount  = $request->childCount;
    	$infantCount = $request->infantCount;
    	$adultCount = $request->adultCount;
    	$aosPrice = $request->aosPrice;
    	$aosId = $request->aosId;
    	$aosQty = $request->aosQty;

    	$price = BusinessPriceDetails::find($request->priceId);
    	$scheduler = BusinessActivityScheduler::find($request->schedule);
    	$category = BusinessPriceDetailsAges::find(@$scheduler->category_id);
    	
    	$adult_price =  $price != '' ? ($price->getCurrentPrice('adult',$request->date)  * $adultCount)  : 0;
        $child_price =  $price != '' ? ($price->getCurrentPrice('child',$request->date) * $childCount) : 0;  
        $infant_price = $price != '' ? ($price->getCurrentPrice('infant',$request->date) * $infantCount)  : 0;   
        
        $adultDiscount = $price != '' ? ( $price->getDiscoutPrice('adult',$request->date) * $adultCount ) : 0;  
        $childDiscount = $price != '' ? ( $price->getDiscoutPrice('child',$request->date)  * $childCount ) : 0;  
        $infantDiscount = $price != '' ? ( $price->getDiscoutPrice('infant',$request->date) * $infantCount)  : 0;  

        $total = $childDiscount + $adultDiscount + $infantDiscount + $aosPrice;
       
    	return view('activity.bookingModal',compact('price','scheduler','adultCount','childCount' , 'infantCount' ,'category' , 'childDiscount','adultDiscount','infantDiscount' ,'adult_price','child_price','infant_price','total','aosId','aosQty'));
    }

    public function getmodelbody(Request $request){
        /*print_r($request->all());*/
        $pricedata = $actscheduledata= $stactbox = $categorydata = $total_price_val= '';
        $totalquantity = 0 ; 
        $timechkfrommodel = 1;

        $dateformate = date('Y-m-d',strtotime($request->dateval));
        $pricedata = BusinessPriceDetails::where('id',$request->pricetitleid)->first();
        $actscheduledata = BusinessActivityScheduler::where('id',$request->actscheduleid)->first();
        $SpotsLeft = UserBookingDetail::where('act_schedule_id',$request->actscheduleid)->whereDate('bookedtime', '=', $dateformate)->get();
     
        if($dateformate == date('Y-m-d')){
            $start_time = (new DateTime($actscheduledata->shift_start))->format("H:i");
            $current_time = (new DateTime())->format("H:i");
            $timechkfrommodel = $current_time > $start_time ? 0 : 1 ;             
        }

		foreach($SpotsLeft as $data){
            $totalquantity += $data->userBookingDetailQty();
		}

		$SpotsLeftdis = @$actscheduledata->spots_available != '' ? $actscheduledata->spots_available - $totalquantity : 0;
       
        $total_price_val_adult = $pricedata != '' ? @$pricedata->getCurrentPrice('adult' , $dateformate) : 0;
        $total_price_val_child = $pricedata != '' ? @$pricedata->getCurrentPrice('child' , $dateformate) : 0;
        $total_price_val_infant = $pricedata != '' ? @$pricedata->getCurrentPrice('infant' , $dateformate) : 0;
        
       	$child_discount =   $pricedata != '' ? @$pricedata->getDiscoutPrice('adult' , $dateformate) : 0;
        $adult_discount = $pricedata != '' ? @$pricedata->getDiscoutPrice('child' , $dateformate) : 0;
        $infant_discount = $pricedata != '' ? @$pricedata->getDiscoutPrice('infant' , $dateformate) : 0; 
        	
        $stactbox.='<div class="row"><div class="col-lg-12">
                        <h4 class="modal-title partcipate-model">Select The Number of Participants</h4>
                    </div><div id="errordiv" class="partcipate-model-error"></div>';
                    
        if ($total_price_val_adult != '') {
            $stactbox.='<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-md-8 col-sm-8 col-xs-6">
							<div class="counter-titles">
								<p class="counter-age-heading">Adults</p>
								<p>Ages 13 & Up</p>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-6">
							<div class="qty mt-5 counter-txt">
								<span class="minus bg-darkbtn adultminus"><i class="fa fa-minus"></i></span>
								<input type="text" class="count" name="adultcnt" id="adultcnt" min="0" value="0" readonly>
								<span class="plus bg-darkbtn adultplus"><i class="fa fa-plus"></i></span>
							</div>
						</div>
					</div>
                </div>
                <input type="hidden" name="adultprice" id="adultprice" value="'.$total_price_val_adult.'" >
                <input type="hidden" name="adultdis" id="adultdis" value="'.$adult_discount.'" >';
        }
        if ($total_price_val_child!= '' ) {
            $stactbox.='
                <div class="col-md-12 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-md-8 col-sm-8 col-xs-6">
							<div class="counter-titles">
								<p class="counter-age-heading">Children</p>
								<p>Ages 2-12</p>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-6">
							<div class="qty mt-5 counter-txt">
								<span class="minus bg-darkbtn childminus"><i class="fa fa-minus"></i></span>
								<input type="text" class="count" name="childcnt" id="childcnt" min="0" value="0" readonly>
								<span class="plus bg-darkbtn childplus"><i class="fa fa-plus"></i></span>
							</div>
						</div>
					</div>
                </div>
                <input type="hidden" name="childprice" id="childprice" value="'.$total_price_val_child.'" >  <input type="hidden" name="childdis" id="childdis" value="'.$child_discount.'" >';
        }
        if($total_price_val_infant != '' ) {
            $stactbox.='
                <div class="col-md-12 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-md-8 col-sm-8 col-xs-6">
							<div class="counter-titles">
								<p class="counter-age-heading">Infants</p>
								<p>Under 2</p>
							</div>
						</div>
						<div class="col-md-4 col-sm-4 col-xs-6">
							<div class="qty mt-5 counter-txt">
								<span class="minus bg-darkbtn infantminus"><i class="fa fa-minus"></i></span>
								<input type="text" class="count" name="infantcnt" id="infantcnt" value="0" min="0" readonly>
								<span class="plus bg-darkbtn infantplus"><i class="fa fa-plus"></i>
                        </span>
							</div>
						</div>
					</div>
                </div>
                <input type="hidden" name="infantprice" id="infantprice" value="'.$total_price_val_infant.'" >
                <input type="hidden" name="infantdis" id="infantdis" value="'.$infant_discount.'" >';
        }

        $stactbox.='<input type="hidden" name="maxlengthval" id="maxlengthval" value="'.@$SpotsLeftdis.'"></div>';

        $timedata = '';
        $timedata .= $actscheduledata->activity_time();

        $time = $actscheduledata->get_duration();
        $timedata .= $time != '' ? ' / '.$time : '';

        $bookdata = '';
        $categorydata = BusinessPriceDetailsAges::where('id',$actscheduledata->category_id)->first();
        $bookdata .= @$categorydata['category_title'] != '' ? '<div class=""><label>Category:</label><span>'.@$categorydata['category_title'].'</span></div>' : '';
        
        $bookdata .= $timedata != '' ? '<div id="timeduration"><label>Duration:</label><span>'.$timedata.'</span></div>' : '';
        
        $bookdata .= @$pricedata['price_title'] != '' ? '<div><label>Price Title:</label><span>'.@$pricedata['price_title'].'</span></div>' : '';
                                         
        $bookdata .= @$pricedata['pay_session'] != '' ? ' <div><label>Price Option:</label><span>'.@$pricedata['pay_session'].' session</span></div>' : '' ;
        
        $rec = @$pricedata['is_recurring_adult'] == 1 ? '(Recurring)' : '';
        
        $bookdata .= @$pricedata['membership_type'] != '' ? '<div><label>Membership:</label><span>'.@$pricedata['membership_type'].''.$rec.' </span></div>' : '';
        
        $bookdata .='<div class="personcategory">
            <span>Adults x 0 </span>
            <span>Kids x 0</span>
            <span>Infants x 0</span>
        </div>';
        
        $bookdata .=' <div class="cartstotal mt-20">
            <label>Total </label>
            <span id="totalprice">$0 USD</span>
        </div>';
       
        echo $stactbox.'~~'.$bookdata.'^^'.$timechkfrommodel;
    }

    public function pricecategory(Request $request){
        $actid = $request->actid;
        $catid = $request->catid;
        $sid = $request->sid;
        $filtertype = $request->filtertype;
        $cid = $request->cid;
        $sesdate = date('Y-m-d',strtotime($request->sesdate));
        $bus_service = BusinessService::where('cid' , $cid)->first();

        $chk_found = $catetitle = '';

        $chk_found = strpos(@$bus_service->special_days_off,date('m/d/Y',strtotime($request->sesdate))) !== false ? "Found" : "Not";
	    
        $mem_ary = [];
        $cate_data = BusinessPriceDetailsAges::where('serviceid', $actid)->where('id', $catid)->first();
        $catetitle .=  @$cate_data['category_title'];
        $price = BusinessPriceDetails::where('serviceid', $actid)->where('category_id', $catid)->get()->toArray();
        $pricedatafirst = BusinessPriceDetails::where('serviceid', $actid)->where('category_id', $catid)->first();
        $stactbox =$mbox =$total_price_val=''; $qty=1;
        if($request->div ==  'book'){
            $fun_para="'".$sid."',this.value,'".$qty."','book','".$sid."'";
        }else if($request->div ==  'bookmore'){
            $fun_para="'".$actid."',this.value,'".$qty."','bookmore','".$sid."'";
        }else{
            $fun_para="'".$actid."',this.value,'".$qty."','bookajax','".$sid."'";
        }

        $adult_cnt =$child_cnt =$infant_cnt =0;
        $adult_price = $child_price = $infant_price = $child_discount =  $adult_discount = $infant_discount = 0;
        $dayval = date('l',strtotime($request->sesdate));
        if (!empty($price)) { 
            $stactbox .= '<select id="selprice'.$actid.'" name="selprice'.$actid.'" class="price-select-control" onchange="changeactpr('.$fun_para.')">';
            if($dayval == 'Saturday' || $dayval == 'Sunday'){

                $adult_price = @$pricedatafirst['adult_weekend_price_diff'] != '' ?  @$pricedatafirst['adult_weekend_price_diff'] : 0;
                $adult_cnt = @$pricedatafirst['adult_weekend_price_diff'] != '' ? 1 : 0 ;

                $child_price = @$pricedatafirst['child_weekend_price_diff'] != '' ?  @$pricedatafirst['child_weekend_price_diff'] : 0;
                $child_cnt = @$pricedatafirst['child_weekend_price_diff'] != '' ? 1 : 0 ;

                $infant_price = @$pricedatafirst['infant_weekend_price_diff'] != '' ?  @$pricedatafirst['infant_weekend_price_diff'] : 0;
                $infant_cnt = @$pricedatafirst['infant_weekend_price_diff'] != '' ? 1 : 0 ;
           
                $i=1;
                if (!empty(@$price)) {
                    foreach ($price as  $pr) {
                        $priceid =$pr['id'];
                        $stactbox .='<option value="'.$pr['id'].'">'.$pr['price_title'].'</option>';
                        $i++;
                    }
                }
            }else{
                if(!empty(@$price))
                {
                	$adult_price = @$pricedatafirst['adult_cus_weekly_price'] != '' ?  @$pricedatafirst['adult_cus_weekly_price'] : 0;
	                $adult_cnt = @$pricedatafirst['adult_cus_weekly_price'] != '' ? 1 : 0 ;

	                $child_price = @$pricedatafirst['child_cus_weekly_price'] != '' ?  @$pricedatafirst['child_cus_weekly_price'] : 0;
	                $child_cnt = @$pricedatafirst['child_cus_weekly_price'] != '' ? 1 : 0 ;

	                $infant_price = @$pricedatafirst['infant_cus_weekly_price'] != '' ?  @$pricedatafirst['infant_cus_weekly_price'] : 0;
	                $infant_cnt = @$pricedatafirst['infant_cus_weekly_price'] != '' ? 1 : 0 ;

                    $i=1;
                    foreach ($price as  $pr) {
                        $priceid =$pr['id'];
                        $stactbox .='<option value="'.$pr['id'].'">'.$pr['price_title'].'</option>';
                        $i++;
                    }
                }
            }
            $total_price_val = $adult_price + $child_price + $infant_price ;

            $stactbox .= '</select>';
            foreach ($price as  $pr) {
                $mem_ary [] =  $pr['membership_type'];
            }
            $mem_ary = array_unique($mem_ary);
            $mbox .='<select id="actfilmtype'.$sid.'" name="actfilmtype" class="form-control activityselect1 instant-detail-membertypre" onchange="chngemember('.$sid.');">';
                foreach ($mem_ary as  $pr) {
                    $mbox .='<option value="'.$pr.'">'.$pr.'</option>';
                }
            $mbox .='</select>';
	        
	       	$child_discount =   $pricedatafirst != '' ? @$pricedatafirst->getDiscoutPrice('adult' , $dateformate) : 0;
	        $adult_discount = $pricedatafirst != '' ? @$pricedatafirst->getDiscoutPrice('child' , $dateformate) : 0;
	        $infant_discount = $pricedatafirst != '' ? @$pricedatafirst->getDiscoutPrice('infant' , $dateformate) : 0;

        	$total_price_display =  $child_discount + $adult_discount+ $infant_discount;
        }


        $todayday = date("l" ,strtotime($sesdate));
        $todaydate = date('Y-m-d' ,strtotime($sesdate));
        $bus_schedule = BusinessActivityScheduler::where('category_id',$catid)->whereRaw('FIND_IN_SET("'.$todayday.'",activity_days)')->where('starting','<=',$todaydate )->where('end_activity_date','>=',  $todaydate )->get(); 
                                        
       $time= '';$timedata = $timedata12 = '';$Totalspot= $spot_avil =$bcnt=1 ;
        if(!empty($bus_schedule) && $chk_found =='Not'){ 
        	$i= 1;          
            foreach($bus_schedule as $data){
            	if($i == 1){
	            	$SpotsLeftdis = $SpotsLeft = 0; 
					$SpotsLeft = UserBookingDetail::where('act_schedule_id',$data['id'])->whereDate('bookedtime', '=',$todaydate)->count();
					$SpotsLeftdis = $data['spots_available'] != '' ? $data['spots_available'] - $SpotsLeft : 0 ;
						
	            	$expdate  = date('m/d/Y', strtotime($data['end_activity_date']));
		            $date_now = new DateTime();
		            $expdate = new DateTime($expdate);
	 				if($SpotsLeftdis != 0){
		                if($date_now <= $date_now){
		                    $timedata ='';
		                    $timedata .= @$data->activity_time();
		                    $time = $data->get_duration();
		                    $timedata .= $time != '' ? ' / '.$time : '';
		                    $i++;
		                }
		            }
		        }
            }
        }
        $bookdata ='';
        $bookdata .= $catetitle != '' ? '<div class="pt-20"><label>Category: </label><span> '.$catetitle.'</span></div>' : '';

        $bookdata .= $timedata != '' ? '<div id="timeduration"><label>Duration:</label><span>'.$timedata.'</span></div>' : '';
        

        $bookdata .= @$pricedatafirst['price_title'] != '' ? '<div><label>Price Title:</label><span>'.@$pricedatafirst['price_title'].'</span></div>' : '';

        $bookdata .= @$pricedatafirst['pay_session'] != '' ? '<div><label>Price Option:</label><span>'.@$pricedatafirst['pay_session'].'</span></div>' : '';
        
        if(@$pricedatafirst['membership_type'] != ''){
            $bookdata .= '<div>
                <label>Membership:</label>
                <span>'.@$pricedatafirst['membership_type'].'';
                if(@$pricedatafirst['is_recurring_adult'] == 1) {
                    $bookdata .= '(Recurring)';
                }
                $bookdata .= '</span>
            </div>';
        }

        $bookdata .= '<div class="personcategory" ><span>Adults x '.$adult_cnt.' = ';
	     
	    $bookdata .= $adult_price != $adult_discount ? '<strike style="color:red">
	        	<span style="color:black"> $'.$adult_price.'</span></strike>&nbsp; $'.$adult_discount.'</span>' : ' $'.$adult_price.'</span>';
	       
	    $bookdata .= '<span>Kids x '.$child_cnt.' = '; 
	    $bookdata .= $child_price != $child_discount ? '<strike style="color:red">
	        	<span style="color:black"> $'.$child_price.'</span></strike>&nbsp; $'.$child_discount.'</span>' : ' $'.$child_price.'</span>';

	    $bookdata .= '<span>Infants x '.$infant_cnt.' = ';
	    $bookdata .= $infant_price != $infant_discount ? '<strike style="color:red">
	        	<span style="color:black"> $'.$infant_price.'</span></strike>&nbsp; $'.$infant_discount.'</span>' : ' $'.$infant_price.'</span>';

     	$bookdata .= '</div>';
        $bookdata .=  @$total_price_val != '' ? '<div class="cartstotal mt-20"> <label>Total </label><span id="totalprice">$ '.@$total_price_display.' USD</span></div>' : '';
     
        $timedata = $timedata == '' ? 'no' : $timedata;

        $SpotsLeftdis = 0;

        $BusinessActivityScheduler =  BusinessActivityScheduler::where('category_id',$catid)->orderBy('id', 'ASC')->where('end_activity_date','>=',date('Y-m-d' ,strtotime($sesdate)) )->whereRaw('FIND_IN_SET("'.date("l" ,strtotime($sesdate) ).'",activity_days)');
        $i= 1;
        if(!empty($BusinessActivityScheduler->get()) && count($BusinessActivityScheduler->get())>0 && $chk_found =='Not'){
            foreach($BusinessActivityScheduler->get() as $bdt){
            	$SpotsLeftdis =$totalquantity = 0;

                $SpotsLeft = UserBookingDetail::where('act_schedule_id',$bdt['id'])->whereDate('bookedtime', '=', date('Y-m-d' ,strtotime($sesdate)) )->get();

				foreach($SpotsLeft as $data){
                    $totalquantity += $data->userBookingDetailQty();
				}

                $SpotsLeftdis = $bdt['spots_available'] != '' ? $bdt['spots_available'] - $totalquantity : 0 ;

                $shift_start = $bdt['shift_start'];
				$converted_date = date('Y-m-d',strtotime($sesdate));
				$st_time = date('Y-m-d H:i:s', strtotime("$converted_date $shift_start"));

				$timePassedChk = date('Y-m-d',strtotime($sesdate)) == date('Y-m-d') && $st_time <  date('Y-m-d H:i:s') ? 1 : 0;

				$timePassedChk = $SpotsLeftdis == 0 ? 2 : $timePassedChk;
				
                $timedata12 .='<div class="col-md-6">
                    <div class="donate-now">
                        <input type="radio" id="'.$bdt['id'].'" name="amount" value="'.$bdt['shift_start'].'"';

                		$timedata12 .= $timePassedChk != 2 ? 'onclick="addhiddentime('.$bdt['id'].','.$bdt['serviceid'].','.$timePassedChk.');"' : '' ;
                        if( $i==1){
                        	if($SpotsLeftdis != 0) {
                        		$timedata12 .='checked';
                        		$i++;
                        	}
                        }
                        $timedata12 .='/>
                        <label for="'.$bdt['id'].'" >'.$bdt['shift_start'].'</label>
                        <p class="end-hr">';
	                    $timedata12 .=  $SpotsLeftdis == 0 ? 'Sold Out' : $SpotsLeftdis.'/'.$bdt['spots_available'].' Spots Left.';
	                    $timedata12 .= '</p>
                    </div>
                </div>';
            }
        }else{
            $timedata12 .='<p class="notimeoption">No time option available Select category to view available times</p>';
        }
        
      /*  echo $timedata12;exit;*/
       $catdata = $bookdata.'****'.$timedata.'!!~'.$catetitle.'*^'.$timedata12.'^~^'.@$BusinessActivityScheduler->first()->id;
       $stactbox1 = $stactbox.'^^'.$mbox;
        echo $stactbox1.'~~~~~~~~'.$catdata; 
    }

    public function pricemember(Request $request){
        $sid = $request->sid;
        $mtype = $request->mtype;
        $catid = $request->catid;
        $pricedata = BusinessPriceDetails::where('serviceid', $sid)->where('category_id', $catid)->where('membership_type',$mtype)->get();
        $stactbox = '';
        
        $fun_para="'".$sid."',this.value,'0','bookajax','".$sid."'";
        
        $stactbox .= '<select id="selprice'.$sid.'" name="selprice'.$sid.'" class="price-select-control" onchange="changeactpr('.$fun_para.')">';
            if(date('l') == 'Saturday' || date('l') == 'Sunday'){
                if (!empty(@$pricedata)) {
                    foreach ($pricedata as  $pr) {
                        $stactbox .='<option value="'.$pr['id'].'">'.$pr['price_title'].'</option>';
                    }
                }
            }else{
                if(!empty(@$pricedata))
                {
                    foreach ($pricedata as  $pr) {
                        $stactbox .='<option value="'.$pr['id'].'">'.$pr['price_title'].'</option>';
                    }
                }
            }
        $stactbox .= '</select>';
        echo $stactbox; 
    }

    public function openGuestRegistration(){
    	return view('activity.guest_registration');
    }

    public function postRegistration_as_guest(Request $request) {

        $postArr = $request->all();       
        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'username' => 'unique:users'
        ];

        $validator = Validator::make($postArr, $rules);
        if ($validator->fails()) {
            $errMsg = array();
            foreach ($validator->messages()->getMessages() as $field_name => $messages) {
                $errMsg = $messages;
            }
            $response = array(
                'type' => 'danger',
                'msg' => $errMsg,
            );
            return Response::json($response);
        } else {
            if (!$this->users->validateUser($postArr['email'])) {
                $response = array(
                    'type' => 'danger',
                    'msg' => 'Email already exists. Please select different Email',
                );
                return Response::json($response);
            };
            //check for unique user name
            if (!$this->users->validateUser($postArr['username'])) {
                $response = array(
                    'type' => 'danger',
                    'msg' => 'User name already exists. Please select different Name',
                );
                return Response::json($response);
            };

            if (count($postArr) > 0) {

                \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
                $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));

                $last_name = ($postArr['lastname']) ? $postArr['lastname'] : '';
                $cus_name = $postArr['firstname'].' '.$last_name;
                $customer = \Stripe\Customer::create([
                        'name' => $cus_name,
                        'email'=> $postArr['email'],
                ]);
                $stripe_customer_id = $customer->id;

                $userObj = New User();
                $userObj->firstname = $postArr['firstname'];
                $userObj->lastname = ($postArr['lastname']) ? $postArr['lastname'] : '';
                $userObj->username = $postArr['username'];
                $userObj->password = Hash::make(str_replace(' ', '', $postArr['password']));
                $userObj->email = $postArr['email'];
                $userObj->stripe_customer_id = $stripe_customer_id;
                $userObj->role = 'customer';
                $userObj->country = 'US';
                $userObj->activated = 1;
                $userObj->phone_number = $postArr['contact'];
                $userObj->birthdate = date("Y-m-d", strtotime($postArr['dob']));
                $userObj->status = "approved";
                $userObj->buddy_key = $postArr['password'];
                $userObj->isguestuser = 1;
                //For signup confirmation 
                $userObj->confirmation_code = Str::random(25);

	            $userObj->save();
                if ($userObj) {
                 	MailService::sendEmailSignupVerification($userObj->id);
					MailService::sendEmailVerifiedAcknowledgement($userObj->id);
	                $response = array(
	                    'type' => 'success',
	                    'msg' => 'Thank you for registering with Fitnessity. Please verify your email address.',
	                );
	                Auth::login($userObj);
	                Auth::loginUsingId($userObj->id, true);

	                return Response::json($response);
	            }else {

                    $response = array(
                        'type' => 'danger',
                        'msg' => 'Some wrror occured while registering. Please try again later.',
                    );

                    return Response::json($response);
                }
				
            } else {
                $response = array(
                    'type' => 'danger',
                    'msg' => 'Invalid email or password',
                );
                return Response::json($response);
            }
        }
    }
}