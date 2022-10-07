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
use App\Miscellaneous;

class ActivityController extends Controller {

	public function activity(Request $request,$filtervalue = null)
	{
		/*if($filtervalue != ''){
			echo $filtervalue; exit;
		}*/

		$all_activities = BusinessServices::where('business_services.is_active', 1);

		$this_nthactivity = BusinessServices::where('business_services.is_active', 1)->whereMonth('business_services.CREATED_AT', date('m'));

		$most_popularactivity = BusinessServices::where('business_services.is_active', 1)->join('user_booking_details', 'business_services.id', '=', 'user_booking_details.sport')->select('business_services.*','user_booking_details.sport')->groupby('business_services.id')->orderby('user_booking_details.created_at','desc');

		$Trainers_coaches_acitvity = BusinessServices::where(['business_services.is_active'=> 1,'service_type'=>'individual']);

		$Fun_Activities = BusinessServices::where(['business_services.is_active'=> 1,'service_type'=>'experience']);

		$Ways_To_Work_out = BusinessServices::where(['business_services.is_active'=> 1,'service_type'=>'classes']);

		$todayservicedata = [];

		$nxtact = BusinessServices::where('business_services.is_active', 1);
		
		if($filtervalue != ''){
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
	              /*  $nxtact->where(function($q) use ($search) {
	                    foreach ($search as $data) {
	                        $data = ucwords($data);
	                        $q->orWhere('sport_activity', 'LIKE', '%'. $data . '%');
	                    }
	                });*/
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
	            }
			}else {
            	$request->session()->forget('activity_type');
        	}

        	if(str_contains($filtervalue, 'memtype')){
				$memtype = substr($filtervalue, strpos($filtervalue, "memtype=") +8);
				$memtype = explode('~',$memtype );
				$request->session()->put('activity_type', $memtype[0]);
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
	            }
			}else {
            	$request->session()->forget('membership_type');
        	}

        	/*exit;*/
		}else {
            $request->session()->forget('service_type');
            $request->session()->forget('program_type');
            $request->session()->forget('service_type_two');
            $request->session()->forget('activity_type');
            $request->session()->forget('membership_type');
        }	

        $nxtacty = $nxtact->get();
        if (isset($nxtacty)) {
        	foreach ($nxtacty as $service) {
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
		

		$allactivities = $all_activities->limit(10)->get();
		/*print_r($allactivities);exit();*/
		$thismonthactivity = $this_nthactivity->limit(10)->get();
		$mostpopularactivity = $most_popularactivity->limit(10)->get();
		$Trainers_coachesacitvity  = $Trainers_coaches_acitvity->limit(10)->get();
		$Fun_Activities  = $Fun_Activities->limit(10)->get();
		$Ways_To_Workout = $Ways_To_Work_out->limit(10)->get();

		$serviceLocation = Miscellaneous::serviceLocation();

		/*print_r($todayservicedata);exit;*/
		return view('activity.activites',[
			'allactivities'=>$allactivities,
			'thismonthactivity'=>$thismonthactivity,
			'mostpopularactivity'=>$mostpopularactivity,
			'Fun_Activities'=>$Fun_Activities,
			'Ways_To_Workout'=>$Ways_To_Workout,
			'Trainers_coachesacitvity'=>$Trainers_coachesacitvity,
			'todayservicedata'=>$todayservicedata,
			'serviceLocation'=>$serviceLocation,
		]);
	}
}