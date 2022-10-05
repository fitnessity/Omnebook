<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Auth;
use File;
use Config;
use Redirect;
use View;
use DB;
use Response;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\BusinessServices;
use App\BusinessActivityScheduler;

class ActivityController extends Controller {

	public function activity($filtervalue = null)
	{
		/*if($filtervalue != ''){
			echo $filtervalue;
		}*/

		$all_activities = BusinessServices::where('business_services.is_active', 1);

		$this_nthactivity = BusinessServices::where('business_services.is_active', 1)->whereMonth('CREATED_AT', date('m'));

		$most_popularactivity = BusinessServices::where('business_services.is_active', 1)->join('user_booking_details', 'business_services.id', '=', 'user_booking_details.sport')->select('business_services.*','user_booking_details.sport')->groupby('business_services.id')->orderby('user_booking_details.created_at','desc');

		$Trainers_coaches_acitvity = BusinessServices::where(['business_services.is_active'=> 1,'service_type'=>'individual']);

		$Fun_Activities = BusinessServices::where(['business_services.is_active'=> 1,'service_type'=>'experience']);

		$Ways_To_Work_out = BusinessServices::where(['business_services.is_active'=> 1,'service_type'=>'classes']);

		if($filtervalue != ''){
			if(str_contains($filtervalue, 'btype')){
			$service_type = substr($filtervalue, strpos($filtervalue, "btype=") +6);
			/*$search = $service_type;
            if(!empty($search)){
                $searchData->where(function($q) use ($search) {
                    foreach ($search as $data) {
                        $q->orWhere('service_type', 'LIKE', '%'. $data . '%');
                    }
                });
            }*/
		}
		}
		

		$allactivities = $all_activities->limit(10)->get();
		$thismonthactivity = $this_nthactivity->limit(10)->get();
		$mostpopularactivity = $most_popularactivity->limit(10)->get();
		$Trainers_coachesacitvity  = $Trainers_coaches_acitvity->limit(10)->get();
		$Fun_Activities  = $Fun_Activities->limit(10)->get();
		$Ways_To_Workout = $Ways_To_Work_out->limit(10)->get();

		$todayservicedata = [];

		if (isset($allactivities)) {
        	foreach ($allactivities as $service) {
        		$bookscheduler = BusinessActivityScheduler::where('serviceid', $service['id'])->get();
        		if(!empty($bookscheduler)) {
        			foreach ($bookscheduler  as $key => $value) {
        				
		            	if($value['end_activity_date'] >= date('Y-m-d') &&  date("H:i:s") < $value['shift_start'] ){
		              		$todayservicedata[] = $service; 
		            	}
		            }
          		}
          	}
          	$todayservicedata = array_unique($todayservicedata);
        }



		/*print_r($mostpopularactivity);exit;*/
		return view('activity.activites',[
			'allactivities'=>$allactivities,
			'thismonthactivity'=>$thismonthactivity,
			'mostpopularactivity'=>$mostpopularactivity,
			'Fun_Activities'=>$Fun_Activities,
			'Ways_To_Workout'=>$Ways_To_Workout,
			'Trainers_coachesacitvity'=>$Trainers_coachesacitvity,
			'todayservicedata'=>$todayservicedata,
		]);
	}
}