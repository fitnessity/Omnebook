<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Stripes\StripePay;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\BookingRepository;
use App\Repositories\SportsRepository;
use Illuminate\Support\Facades\Log;
use Auth;
use File;
use Config;
use App\Jobpostquestions;
use Redirect;
use App\Miscellaneous;
use App\Quote;
use View;
use DB;
use Response;
use Validator;
use App\UserBookingStatus;
use App\User;
use App\Evidents;
use App\UserProfessionalDetail;
use App\UserService;
use App\CompanyInformation;
use App\BusinessServices;
use App\BusinessService;
use App\BusinessPriceDetails;
use App\UserBookingDetail;
use App\BusinessCompanyDetail;
use App\Fit_Cart;
use App\Sports;
use App\Payment;
use App\UserFamilyDetail;
use App\MailService;
use App\Zip_code;
use Illuminate\Pagination\LengthAwarePaginator;
use App\UserFavourite;
use App\BusinessServicesFavorite;
use App\BusinessServiceReview;
use App\BusinessActivityScheduler;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DateTime;
use DateTimeZone;
use App\BusinessPriceDetailsAges;

class LessonController extends Controller {

    protected $sports;

    public function __construct(UserRepository $users, BookingRepository $bookings, Request $request, SportsRepository $sports) {
        //$this->middleware('auth');

        $this->users = $users;
        $this->bookings = $bookings;
        $this->sports = $sports;
        /*
          if (! Gate::allows('booking_access')) {
          $request->session()->flash('alert-danger', 'Access Restricted');
          return redirect('/');
          } */
    }

    public function jsModallesson($modelName, $sportId = 0) {
        $s = Sports::where('id', $sportId)->first();
        // print_r($sportId);die;
        if ($s) {
            $booking_option = $s->booking_option;
        } else {
            $booking_option = '';
        }
        // print_r($booking_option);die;
        $sportsListRaw = $this->sports->getAlphabetsWiseSportsNames();
        $sportsList = array();
        $totalSports = 0;
        if ($sportsListRaw) {
            foreach ($sportsListRaw as $key => $value) {
                foreach ($value as $key1 => $value1) {
                    $totalSports+=(count($value1->child) + 1);
                    $sportsList[] = $value1;
                }
            }
        }
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
        return view('lessons.' . $modelName, [
            'booking_option' => $booking_option,
            'sports_list' => $sportsList,
            'totalSports' => $totalSports,
            'selectedSportId' => $sportId,
            'programType' => $programType,
            'programFor' => $programFor,
            'numberOfPeople' => $numberOfPeople,
            'ageRange' => $ageRange,
            'expLevel' => $expLevel,
            'serviceLocation' => $serviceLocation,
            'pFocuses' => $pFocuses,
            'duration' => $duration,
            'servicePriceOption' => $servicePriceOption,
            'specialDeals' => $specialDeals,
            'activity' => $activity,
            'teaching' => $teaching,
            'languages' => $languages,
            'timeSlots' => $timeSlots
        ]);
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    /* public function index(Request $request)
      {
      return view('tasks.index', [
      'tasks' => $this->tasks->forUser($request->user()),
      ]);
      } */

    /**
     * Create a new task.
     *
     * @param  Request  $request
     * @return Response
     */
    /* public function store(Request $request)
      {
      $this->validate($request, [
      'name' => 'required|max:255',
      ]);

      $request->user()->tasks()->create([
      'name' => $request->name,
      ]);

      return redirect('/tasks');
      } */

    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    /* public function destroy(Request $request, Task $task)
      {
      $this->authorize('destroy', $task);

      $task->delete();

      return redirect('/tasks');
      } */

    /* public function testTwilio(Request $request)
      {
      require asset('/twilio/sdk/Services/Twilio.php');
      //        require asset('/css/material-charts.css');die;
      // Create an authenticated client for the Twilio API
      $client = new Services_Twilio($_ENV['TWILIO_ACCOUNT_SID'], $_ENV['TWILIO_AUTH_TOKEN']);

      // Use the Twilio REST API client to send a text message
      $m = $client->account->messages->sendMessage(
      $_ENV['TWILIO_NUMBER'], // the text will be sent from your Twilio number
      $number, // the phone number the text will be sent to
      $message // the body of the text message
      );

      // Return the message object to the browser as JSON
      return $m;
      } */

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function PostQuotes(Request $request) {
        // print_r("sad");die;
        //$postArr = Input::all();
        $postArr = $request->all();

        if (isset($postArr) && !empty($postArr)) {
            $data = array();
            $data['user_id'] = Auth::User()->id;
            $other = "Others";
            if (isset($postArr['sport']) && $postArr['sport'] === 'true') {
                $data['sport'] = $postArr['othersports'];
            } else {
                $data['sport'] = $postArr['sport'];
            }
            $Sports = Sports::where('id', $postArr['sport'])->get();
            $postArr['question']['sport']['answer'] = $Sports[0]['sport_name'];
            $data['booking_type'] = "quick";
            $data['zipcode'] = isset($postArr['zipcode']) ? $postArr['zipcode'] : '';
            $data['quote_by_text'] = ($postArr['notificationby'] === 'email_text') ? 1 : 0;
            $data['quote_by_email'] = ($postArr['notificationby'] === 'email') ? 1 : 0;
            $data['question'] = $postArr['question'];
            $data['status'] = "requested";

            $status = $this->bookings->saveBookingStatus($data);
            $msgType = (isset($status['alert-type'])) ? $status['alert-type'] : $status['type'];
            $request->session()->flash($msgType, $status['msg']);
            // print_r("hell");die;
            return Redirect::to('/mybooking')->with('message', $status['msg']);
        }
    }

    public function PostSubmitQuote() {
        //$inputObj = Input::all();
        $inputObj = $request->all();
        $userId = Auth::User()->id;
        if (isset($userId) && !empty($userId)) {
            if (!isset($inputObj['submitquotes']) || empty($inputObj['submitquotes'])) {
                return redirect::back()->withError(['error' => 'Please Provide Proper Quote']);
            } else {
                if (isset($inputObj['jobid']) && isset($userId)) {
                    $qutObj = Quote::SELECT('*')->WHERE('job_id', '=', $inputObj['jobid'])->Where('user_id', '=', $userId)->first();
                    if ($qutObj) {
                        $qutObj->job_id = $inputObj['jobid'];
                        $qutObj->user_id = $userId;
                        $qutObj->quote = $inputObj['submitquotes'];
                        $qutObj->save();
                    } else {
                        $qutObj = new Quote();
                        $qutObj->job_id = $inputObj['jobid'];
                        $qutObj->user_id = $userId;
                        $qutObj->quote = $inputObj['submitquotes'];
                        $qutObj->save();
                    }
                }
                if ($qutObj) {
                    return redirect::to('/jobposts')->with('message', 'Quote submitted successfully');
                }
            }
        } else {
            return redirect::to('/')->withError(['error' => 'Please Login into the system']);
        }
    }

    public function GetjobsSubmit($id) {
        if (isset($id) && !empty($id)) {
            $quoteObj = Quote::SELECT('job_id', 'quote', 'user_id')->where('job_id', '=', $id)->first();
            $qutObj = array();
            $userQut = "";
            if ($quoteObj) {
                $userQut = $quoteObj['quote'];
            }
            $qutObj['jobid'] = $id;
            $qutObj['quote'] = $userQut;
        }
        return view::make('jobpost.submitQuote')->with('qutObj', $qutObj);
    }

    /* sam filter start */
   /* public function samfilter(Request $r) { 
        $output = '';
        $page = $r->page ? $r->page : 1;
        $offset = ($page * 9) - 9; 
       // parse_str($r->data, $output);
        $output = ($r->data);
        
        $filter['professional_type'] = (isset($output['professional_type']) && ($output['professional_type'] !== "")) ? $output['professional_type'] : null;
        $filter['service_typetwo'] = (isset($output['service_typetwo']) && ($output['service_typetwo'] !== "")) ? $output['service_typetwo'] : null;
        $filter['service_type'] = (isset($output['service_type']) && ($output['service_type'] !== "")) ? $output['service_type'] : null;
        $filter['program_type'] = (isset($output['program_type']) && ($output['program_type'] !== "")) ? $output['program_type'] : null;
        $filter['activity_location'] = (isset($output['activity_location']) && ($output['activity_location'] !== "")) ? $output['activity_location'] : null;
        $filter['location'] = (isset($output['location']) && ($output['location'] !== "")) ? $output['location'] : null;
        $filter['activity_type'] = (isset($output['activity_type']) && ($output['activity_type'] !== "")) ? $output['activity_type'] : null;
        $filter['age_range'] = (isset($output['age_range']) && ($output['age_range'] !== "")) ? $output['age_range'] : null;
        $filter['cnumber_people'] = (isset($output['cnumber_people']) && ($output['cnumber_people'] !== "")) ? $output['cnumber_people'] : null;
        $filter['duration'] = (isset($output['duration']) && ($output['duration'] !== "")) ? $output['duration'] : null;
        $filter['difficulty_level'] = (isset($output['difficulty_level']) && ($output['difficulty_level'] !== "")) ? $output['difficulty_level'] : null;
        $filter['gender'] = (isset($output['gender']) && ($output['gender'] !== "")) ? $output['gender'] : null;
        $filter['language'] = (isset($output['language']) && ($output['language'] !== "")) ? $output['language'] : null;
        $filter['activity_exp'] = (isset($output['activity_exp']) && ($output['activity_exp'] !== "")) ? $output['activity_exp'] : null;
        $filter['personality_habit'] = (isset($output['personality_habit']) && ($output['personality_habit'] !== "")) ? $output['personality_habit'] : null;
        //$filter['selected_sport'] = (isset($output['selected_sport']) && ($output['selected_sport'] !== "")) ? $output['selected_sport'] : null;
        //$filter['activity_for'] = (isset($output['activity_for']) && ($output['activity_for'] !== "")) ? $output['activity_for'] : null;
        //$filter['fitness_goal'] = (isset($output['fitness_goal']) && ($output['fitness_goal'] !== "")) ? $output['fitness_goal'] : null;
       
        $filter['activity_Member'] = (isset($output['activity_Member']) && ($output['activity_Member'] !== "")) ? $output['activity_Member'] : null;    
        $filmember=$filter['activity_Member'];
       
        $serviceData = $this->filter($r, $filter);
        //print_r($serviceData);exit;
        //echo "<pre>";print_r( $AllProfessionals);die;
        $serviceData = new LengthAwarePaginator(
        array_slice($serviceData, $offset, 5, true), count($serviceData), 9, $page, ['path' => $r->url(), 'query' => $r->query()]
        );
        $sport_names = $this->sports->getAllSportsNames();
        return view('jobpost.search', compact('serviceData', 'sport_names','filmember'));
    }*/

    public function filter($request, $filter) {
        $companys = [];
        //$query = CompanyInformation::get();
        //DB::enableQueryLog();
        /* comment by purvi
        $searchDatas = BusinessServices::where('instant_booking', 1)
            ->where('is_active', 1);*/
        
        $searchDatas = BusinessServices::where('is_active', 1); 
        //$searchDatas = DB::table('business_services AS bs')->where('bs.is_active', 1);
                
            //->where('program_name', 'LIKE', $keyword . '%')->groupBy('id')->get();
            //  ->where('sport_activity', 'LIKE', $keyword . '%')->groupBy('id')->get();    
            /*->where(function($query) use ($keyword){
                        $query->where('program_name', 'LIKE', $keyword . '%');
                        //->orWhere('sport_activity', 'LIKE', $keyword . '%');
                    })->groupBy('id')->get();*/
        
        //print_r($filter['service_type']); exit;
        //Service Type
        if ($filter['service_typetwo'] != null) {
            $company_ids = [];
            $search = $filter['service_typetwo'];
            $searchDatas->where(function($q) use ($search) {
                foreach ($search as $data) {
                    $q->orWhere('select_service_type', 'LIKE', '%'. $data . '%');
                }
            });
        }
        
        if ($filter['service_type'] != null) {
            $company_ids = [];
            $search = $filter['service_type'];
            $searchDatas->where(function($q) use ($search) {
                foreach ($search as $data) {
                    $q->orWhere('service_type', 'LIKE', '%'. $data . '%');
                }
            });
        }
        
        //Program Type - Activity of services
        /* Comment by purvi
        if ($filter['program_type'] != null) {
            $company_ids = [];
            $search = $filter['program_type'];
            $searchDatas->where(function($q) use ($search) {
                if(!in_array("any", $search)){
                    foreach ($search as $data) {
                        if(strpos($data,'_')!= ''){
                            $data = ucwords(str_replace('_',' ', $data));
                        }
                        else{
                            $data = ucwords($data);
                        }
                        $q->orWhere('sport_activity', 'LIKE', '%'. $data . '%');
                    }
                }
            });
        }*/
        
        if ($filter['program_type'] != null) {
            $company_ids = [];
            $search = $filter['program_type'];
            $searchDatas->where(function($q) use ($search) {
                //foreach ($search as $data) {
                    if(strpos($search,'_')!= ''){
                        $str = ucwords(str_replace('_',' ', $search));
                    }
                    else{
                        $str = ucwords($search);
                    }
                    $q->orWhere('sport_activity', 'LIKE', '%'. $str . '%');
                //}
            });
        }
        
        
        if ($filter['professional_type'] != null) {
            $search = $filter['professional_type'];
            $q->orWhere('sport_activity', 'LIKE', '%'. $search . '%');
        }
        
        //Activity Location
        if ($filter['activity_location'] != null) {
            $company_ids = [];
            $search = $filter['activity_location'];
            $searchDatas->where(function($q) use ($search) {
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
        
        //location
        if ($filter['location'] != null) {
            $company_ids = [];
            $search = $filter['location'];
            $searchDatas->where(function($q) use ($search) {
                $q->orWhere('exp_city', 'LIKE', '%'. $search . '%')->orWhere('exp_state', 'LIKE', '%'. $search . '%')->orWhere('exp_zip', 'LIKE', '%'. $search . '%');
            });
        }
        
        //Activity Type
        if ($filter['activity_type'] != null) {
            $company_ids = [];
            $search = $filter['activity_type'];
            $searchDatas->where(function($q) use ($search) {
                if(!in_array("any", $search)){
                    foreach ($search as $data) {
                        $data = ucwords($data);
                        $q->orWhere('activity_for', 'LIKE', '%'. $data . '%');
                    }
                }
            });
        }
        
        //Activity Range
        if ($filter['age_range'] != null) {
            $company_ids = [];
            $search = $filter['age_range'];
            $searchDatas->where(function($q) use ($search) {
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
        
        // Duration
        if ($filter['duration'] != null) {
            $company_ids = [];
            $search = $filter['duration'];
            $searchDatas->where(function($q) use ($search) {
                foreach ($search as $data) {
                    $q->orWhere('mon_duration', 'LIKE', '%'. $data . '%')->orWhere('tue_duration', 'LIKE', '%'. $data . '%')->orWhere('wed_duration', 'LIKE', '%'. $data . '%')->orWhere('thu_duration', 'LIKE', '%'. $data . '%')->orWhere('fri_duration', 'LIKE', '%'. $data . '%')->orWhere('sat_duration', 'LIKE', '%'. $data . '%')->orWhere('sun_duration', 'LIKE', '%'. $data . '%');
                }
            });
        }
        
        
        //Group Size
        if ($filter['cnumber_people'] != null) {
            $company_ids = [];
            $search = $filter['cnumber_people'];
            $searchDatas->where(function($q) use ($search) {
                $q->orWhere('group_size', '=', $search);
            });
        }
        
        //Difficulty Type
        if ($filter['difficulty_level'] != null) {
            $company_ids = [];
            $search = $filter['difficulty_level'];
            $searchDatas->where(function($q) use ($search) {
                if(!in_array("any", $search)){
                    foreach ($search as $data) {
                        $data = ucwords($data);
                        $q->orWhere('difficult_level', 'LIKE', '%'. $data . '%');
                    }
                }
            });
        }
        
        //Activity Type
        if ($filter['activity_type'] != null) {
            $company_ids = [];
            $search = $filter['activity_type'];
            $searchDatas->where(function($q) use ($search) {
                if(!in_array("any", $search)){
                    foreach ($search as $data) {
                        $data = ucwords($data);
                        $q->orWhere('activity_for', 'LIKE', '%'. $data . '%');
                    }
                }
            });
        }
        
        //Activity Location
        if ($filter['activity_exp'] != null) {
            $company_ids = [];
            $search = $filter['activity_exp'];
            $searchDatas->where(function($q) use ($search) {
                foreach ($search as $data) {
                    if(strpos($data,'_')!= ''){
                        $data = ucwords(str_replace('_',' ', $data));
                    }
                    else{
                        $data = ucwords($data);
                    }
                    $q->orWhere('activity_experience', 'LIKE', '%'. $data . '%');
                }
            });
        }
        
        //Personality Habit
        if ($filter['personality_habit'] != null) {
            $company_ids = [];
            $search = $filter['personality_habit'];
            $searchDatas->where(function($q) use ($search) {
                foreach ($search as $data) {
                    if(strpos($data, '_')!= ''){
                        $data = ucwords(str_replace('_',' ', $data));
                    }
                    else{
                        $data = ucwords($data);
                    }
                    $q->orWhere('instructor_habit', 'LIKE', '%'. $data . '%');
                }
            });
        }
        // Membership Type
        if ($filter['activity_Member'] != null) {
            $company_ids = [];
            $search = $filter['activity_Member'];
        }
        
        
        
        /*if ($filter['language'] != null) {
            $company_ids = [];
            $search = $filter['language'];
            $searchDatas->where(function($q) use ($search) {
                foreach ($search as $data) {
                    $q->orWhere('languages', 'LIKE', '%'. $data . '%');
                }
            });
            
        }*/
        
        /*
        Comment by purvi
        if ($filter['language'] != null) {
            $company_ids = [];
            foreach ($filter['language'] as $data) { 
                $str =  $data;
                $my_service_data = BusinessService::where('cid', '>', '0')->where('languages', 'LIKE', '%' . $str . '%')->get(['cid']);
                foreach ($my_service_data as $value2) {
                    array_push($company_ids, $value2->cid);
                }
            }
            
            if(count($company_ids) > 0){
                $searchDatas->whereIn('cid', $company_ids);
            }
            
        }*/
        
        //Gender
        /*if ($filter['gender'] != null) {
            $company_ids = [];
            $search = $filter['gender'];
            $searchDatas->where(function($q) use ($search) {
                if(!in_array("any", $search)){
                    foreach ($search as $data) {
                        $data = ucwords($data);
                        $q->orWhere('gender', 'LIKE', '%'. $data . '%');
                    }
                }
            });
        }*/
        //$query = str_replace(array('?'), array('\'%s\''), $searchDatas->toSql());
        //$query = vsprintf($query, $searchDatas->getBindings());
        //dump($query);die;
        
        /*$searchDatas->get();
        dd(\DB::getQueryLog());*/
        
        $companys = $searchDatas->get()->toArray();
        
        if ($filter['professional_type'] != null) {
            $company_ids = [];
            foreach ($filter['professional_type'] as $data) {
                $str = ':"' . $data; 
                $my_service_data = UserService::where('company_id', '!=', null)->where('servicetype', 'LIKE', '%' . $str . '%')->get();
                foreach ($my_service_data as $value2) {
                    array_push($company_ids, $value2['company_id']);
                }
            }
            $company = CompanyInformation::whereIn('id', $company_ids)->get()->toArray();
            if (count($company) != 0) {
                $companys = array_merge($companys, $company);
            }
        }
        /*if ($filter['selected_sport'] != null) {
            $company_ids = [];
            $my_service_data = UserService::where('company_id', '!=', null)->where('sport', $filter['selected_sport'])->get();
            foreach ($my_service_data as $value2) {
                array_push($company_ids, $value2['company_id']);
            }
            $company = CompanyInformation::whereIn('id', $company_ids)->get()->toArray();
            if (count($company) != 0) {
                $companys = array_merge($companys, $company);
            }
        }*/
        /*if ($filter['activity_for'] != null) {
            $company_ids = [];
            foreach ($filter['activity_for'] as $data) {
                $str = ':"' . $data;
                $my_service_data = UserService::where('company_id', '!=', null)->where('activitydesignsfor', 'LIKE', '%' . $str . '%')->get();
                foreach ($my_service_data as $value2) {
                    array_push($company_ids, $value2['company_id']);
                }
            }
            $company = CompanyInformation::whereIn('id', $company_ids)->get()->toArray();
            if (count($company) != 0) {
                $companys = array_merge($companys, $company);
            }
        }*/
        if ($filter['activity_type'] != null) {
            $company_ids = [];
            foreach ($filter['activity_type'] as $data) {
                $str = ':"' . $data;

                $my_service_data = UserService::where('company_id', '!=', null)->where('activitytype', 'LIKE', '%' . $str . '%')->get();
                foreach ($my_service_data as $value2) {
                    array_push($company_ids, $value2['company_id']);
                }
            }
            $company = CompanyInformation::whereIn('id', $company_ids)->get()->toArray();
            if (count($company) != 0) {
                $companys = array_merge($companys, $company);
            }
        }
        if ($filter['age_range'] != null) {
            $company_ids = [];
            foreach ($filter['age_range'] as $data) {
               $str = ':"' . $data;
               $my_service_data = UserService::where('company_id', '!=', null)->where('agerange', 'LIKE', '%' . $str . '%')->get();
              
                foreach ($my_service_data as $value2) {
                    array_push($company_ids, $value2['company_id']);
                }
            }
            
            $company = CompanyInformation::whereIn('id', $company_ids)->get()->toArray();
            if (count($company) != 0) {
                $companys = array_merge($companys, $company);
            }
        }
        
        if (@$filter['location'] != null) {
            $company = CompanyInformation::where('city', 'LIKE', $filter['location'] . '%')->get()->toArray();
            if (count($company) != 0) {
                $companys = array_merge($companys, $company);
            }
        }
        if ($filter['activity_exp'] != null) {
            $company_ids = [];
            foreach ($filter['activity_exp'] as $data) {
                $str = ':"' . $data;
                $my_service_data = UserProfessionalDetail::where('company_id', '!=', null)->where('experience_level', 'LIKE', '%' . $str . '%')->get();
                foreach ($my_service_data as $value2) {
                    array_push($company_ids, $value2['company_id']);
                }
            }
            $company = CompanyInformation::whereIn('id', $company_ids)->get()->toArray();
            if (count($company) != 0) {
                $companys = array_merge($companys, $company);
            }
        }
        if ($filter['personality_habit'] != null) {
            $company_ids = [];
            foreach ($filter['personality_habit'] as $data) {
                $str = ':"' . $data;
                $my_service_data = UserProfessionalDetail::where('company_id', '!=', null)->where('personality', 'LIKE', '%' . $str . '%')->get();
                foreach ($my_service_data as $value2) {
                    array_push($company_ids, $value2['company_id']);
                }
            }
            $company = CompanyInformation::whereIn('id', $company_ids)->get()->toArray();
            if (count($company) != 0) {
                $companys = array_merge($companys, $company);
            }
        }
        /*if ($filter['fitness_goal'] != null) {
            foreach ($filter['fitness_goal'] as $value) {
                $query->where('details.goals_option', 'like', '%' . $value . '%');
            }
        }*/
        if ($filter['activity_location'] != null) {
            $company_ids = [];
            if(isset($request->activity_location)) {
            foreach ($request->activity_location as $data) {
                $str = ':"' . $data;
                $my_service_data = UserProfessionalDetail::where('company_id', '!=', null)->where('work_locations', 'LIKE', '%' . $str . '%')->get();
                foreach ($my_service_data as $value2) {
                    array_push($company_ids, $value2['company_id']);
                }
            }
            }
            $company = CompanyInformation::whereIn('id', $company_ids)->get()->toArray();
            if (count($company) != 0) {
                //array_push($companys,$company);
                $companys = array_merge($companys, $company);
            }
        }

        //   $resultnew =  new LengthAwarePaginator(
        //              array_slice($result, $offset, $perPage, true),  
        //              count($result), 
        //              $perPage, 
        //              $page, 
        //              ['path' => $request->url(), 'query' => $request->query()]  
        //          );
        /*$searchDatas->get();
        dd(\DB::getQueryLog());*/
        //print_r($companys); exit;
        return $companys;
        //return $query->groupBy('users.id')->paginate(9);
    }

    public function filter1($filter) {
        $query = User::select('users.*', 'users.id AS professional_id', DB::raw('group_concat(distinct(CONCAT(UCASE(LEFT(service.sport, 1))))) as user_sports'), 'reviews.avg_rating', 'users_favourite.favourite_user_id as fav_user_id')
                ->leftjoin("user_services as service", DB::raw('service.user_id'), '=', 'users.id')
                ->leftjoin("user_professional_details as details", DB::raw('details.user_id'), '=', 'users.id')
                ->with('states')
                ->leftjoin('users_favourite', function ($join) {
                    $join->on('users_favourite.favourite_user_id', '=', 'users.id');
                    $join->where('users_favourite.user_id', '=', Auth::user()->id);
                })
                ->leftjoin(DB::raw('(select reviewfor_userid,round(avg(rating),2) as avg_rating from reviews group by reviewfor_userid) as reviews '), DB::raw('reviews.reviewfor_userid'), '=', 'users.id')
                ->where('users.is_deleted', '0')
                ->where('users.role', 'business')
                ->where('users.activated', 1);

        // echo $filter['professional_type'];die;
        if ($filter['professional_type'] != null) {
            foreach ($filter['professional_type'] as $value) {
                $query->where('service.servicetype', 'like', '%' . $value . '%');
            }
        }
        if ($filter['selected_sport'] != null) {
            $query->where("service.sport", $filter['selected_sport']);
        }
        if ($filter['activity_for'] != null) {
            foreach ($filter['activity_for'] as $value) {
                $query->where('service.activitydesignsfor', 'like', '%' . $value . '%');
            }
        }
        if ($filter['activity_type'] != null) {

            foreach ($filter['activity_type'] as $value) {
                $query->where('service.activitytype', 'like', '%' . $value . '%');
            }
        }
        if ($filter['age_range'] != null) {
            foreach ($filter['age_range'] as $value) {
                $query->where('service.agerange', 'like', '%' . $value . '%');
            }
        }
        if ($filter['language'] != null) {
            foreach ($filter['language'] as $value) {
                $query->where('details.languages', 'like', '%' . $value . '%');
            }
        }
        if (@$filter['location'] != null) {
            if (is_numeric($filter['location'])) {
                $query->where('users.zipcode', 'like', '%' . @$filter['location'] . '%');
            } else {
                $query->where('users.address', 'like', '%' . @$filter['location'] . '%');
            }
        }
        if ($filter['activity_exp'] != null) {
            
        }
        if ($filter['personality_habit'] != null) {

            foreach ($filter['personality_habit'] as $value) {
                $query->where('details.personality', 'like', '%' . $value . '%');
            }
        }
        if ($filter['fitness_goal'] != null) {
            foreach ($filter['fitness_goal'] as $value) {
                $query->where('details.goals_option', 'like', '%' . $value . '%');
            }
        }
        if ($filter['activity_location'] != null) {

            foreach ($filter['activity_location'] as $value) {
                $query->where('service.servicelocation', 'like', '%' . $value . '%');
            }
        }
        return $query->groupBy('users.id')->paginate(9);
    }

    /* sam filter end */

    public function getDirecthire(Request $request) {
        if (isset($request->selected_sport)) {
            $request->session()->put('selected_sport', $request->selected_sport);
        } else {
            $request->session()->forget('selected_sport');
        }

        if (isset($request->level_of_experience)) {
            $request->session()->put('level_of_experience', $request->level_of_experience);
        } else {
            $request->session()->forget('level_of_experience');
        }

        if (isset($request->who_is_training)) {
            $request->session()->put('who_is_training', $request->who_is_training);
        } else {
            $request->session()->forget('who_is_training');
        }

        if (isset($request->gender)) {
            $request->session()->put('gender', $request->gender);
        } else {
            $request->session()->forget('gender');
        }

        if (isset($request->personality)) {
            $request->session()->put('personality', $request->personality);
        } else {
            $request->session()->forget('personality');
        }

        if (isset($request->availability_days)) {
            $request->session()->put('availability_days', $request->availability_days);
        } else {
            $request->session()->forget('availability_days');
        }

        if (isset($request->selected_location)) {
            $request->session()->put('selected_location', $request->selected_location);
            if ($request->selected_location == '') {
                //If selected_location is not set -> unset miles_radius_filter  
                $request->session()->forget('miles_radius_filter');
            } else {
                //If selected_location and miles_radius_filter both are set  
                if (isset($request->miles_radius_filter)) {
                    $request->session()->put('miles_radius_filter', $request->miles_radius_filter);
                } else {
                    $request->session()->forget('miles_radius_filter');
                }
            }
        } else {
            $request->session()->forget('selected_location');
            //If selected_location is not set -> unset miles_radius_filter  
            $request->session()->forget('miles_radius_filter');
        }

        if (isset($request->selected_location_lat)) {
            $request->session()->put('selected_location_lat', $request->selected_location_lat);
        } else {
            $request->session()->forget('selected_location_lat');
        }

        if (isset($request->selected_location_lng)) {
            $request->session()->put('selected_location_lng', $request->selected_location_lng);
        } else {
            $request->session()->forget('selected_location_lng');
        }

        if (isset($request->professional_type)) {
            $request->session()->put('professional_type', $request->professional_type);
        } else {
            $request->session()->forget('professional_type');
        }

        if (isset($request->filter_review_star)) {
            $request->session()->put('filter_review_star', $request->filter_review_star);
        } else {
            $request->session()->forget('filter_review_star');
        }

        $selectedSpot = $request->session()->get('selected_sport') ? $request->session()->get('selected_sport') : null;
        $levelOfExp = $request->session()->get('level_of_experience') ? $request->session()->get('level_of_experience') : null;
        $whoIsTraining = $request->session()->get('who_is_training') ? $request->session()->get('who_is_training') : null;
        $gender = $request->session()->get('gender') ? $request->session()->get('gender') : null;
        $personality = $request->session()->get('personality') ? $request->session()->get('personality') : null;
        $availability_days = $request->session()->get('availability_days') ? $request->session()->get('availability_days') : null;
        $selected_location = $request->session()->get('selected_location') ? $request->session()->get('selected_location') : null;
        $selected_location_lat = $request->session()->get('selected_location_lat') ? $request->session()->get('selected_location_lat') : null;
        $selected_location_lng = $request->session()->get('selected_location_lng') ? $request->session()->get('selected_location_lng') : null;
        $miles_radius_filter = $request->session()->get('miles_radius_filter') ? $request->session()->get('miles_radius_filter') : 0;
        $professional_type = $request->session()->get('professional_type') ? $request->session()->get('professional_type') : '1';
        $filter_review_star = $request->session()->get('filter_review_star') ? $request->session()->get('filter_review_star') : null;

        $sports = $this->sports->getAlphabetsWiseSportsNames();
        $sport_names = $this->sports->getAllSportsNames();
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
        $sports_select = '';
        if ($sports) {
            $sports_select .= "<option value=''>Choose Activity</option>";
            foreach ($sports as $key => $value) {
                foreach ($value as $key1 => $value1) {
                    if (count($value1->child)) {
                        $sports_select .= "<optgroup label='" . $value1->title . "'>";
                        foreach ($value1->child as $key2 => $value2) {
                            $selected = null; // ($service==$key2)?"selected":"";
                            $sports_select .= "<option value='" . $key2 . "' " . $selected . " >" . $value2 . "</option>";
                        }
                        $sports_select .= "</optgroup>";
                    } else {
                        $selected = null; //($service==$value1->value)?"selected":"";
                        $sports_select .= "<option value='" . $value1->value . "' " . $selected . ">" . $value1->title . "</option>";
                    }
                }
            }
        }

        $all = CompanyInformation::paginate(20);

        return view('jobpost.directhire', [
            'AllProfessionals' => $all,
            'sports' => $sports,
            'sport_names' => $sport_names,
            'businessType' => $businessType,
            'pageTitle' => "DIRECT HIRE",
            'activity' => $activity,
            'programType' => $programType,
            'ageRange' => $ageRange,
            'alllanguages' => $languages,
            'pFocuses' => $pFocuses,
            'serviceLocation' => $serviceLocation,
            'sports_select' => $sports_select,
        ]);
    }
    
    public function getInstanthireSearch(Request $request) {
        $newSearch = array();
        $newSearchActivity = array();
        $profilename = array();
        if ($request->has('keyword') && $request->input('keyword')!='') {
            $keyword = $request->input('keyword');              
            $searchDatas = BusinessServices::where('instant_booking', 1)
                ->where('is_active', 1)
                ->where('program_name', 'LIKE', $keyword . '%')->groupBy('id')->get();
            $searchDatasActivity = BusinessServices::where('instant_booking', 1)
                ->where('is_active', 1)
                ->where('sport_activity', 'LIKE', $keyword . '%')->groupBy('id')->get();
            $searchDatasprofile = User::where('username', 'LIKE', $keyword . '%')->get();
            /*->where(function($query) use ($keyword){
                        $query->where('program_name', 'LIKE', $keyword . '%');
                        //->orWhere('sport_activity', 'LIKE', $keyword . '%');
                    })->groupBy('id')->get();*/
                    
            foreach ($searchDatas as $k => $searchData) {
                $newSearch['business'] = $searchData->program_name;
            }
            foreach ($searchDatasActivity as $k => $search) {
                $newSearchActivity['Activity'] = $search->sport_activity;
            }
            foreach ($searchDatasprofile as $k => $searchpro) {
                $profilename['profile'] = $searchpro->username;
            }
            $setArray = array_unique(array_merge($newSearch,$newSearchActivity,$profilename));
        
            if(!empty($setArray)){
                return response()->json($setArray, 200);
            }
            return response()->json(['No'], 200);
        }else{
            return response()->json(['No'], 200);
        }
    }
    
    
    public function getInstanthire(Request $request) {
       /* if(!empty($request->all())){
            print_r($request->all());exit;
        }*/
       
        if(isset($_GET['action']) && !empty($_GET["action"])) 
        {
            $request->session()->put('selected_location_lng', $request->selected_location_lng);
            switch($_GET["action"]) 
            {
                case "add":
                    if(!empty($_POST["quantity"])) {
                        $pid = $_GET["pid"];
                        $price = isset($_POST["price"]) ? $_POST["price"] : 0;
                        $result = DB::select('select * from business_services where id = "'.$pid.'"');
                        if (count($result) > 0) {
                            foreach ($result as $item) {
                                $itemArray = array($item->serviceid=>array('type'=>$item->service_type, 'name'=>$item->program_name, 'code'=>$item->serviceid, 'quantity'=>$_POST["quantity"], 'price'=>$price, 'image'=>$item->profile_pic));
                                if(!empty($_SESSION["cart_item"])) {
                                    if(in_array($item->serviceid, array_keys($_SESSION["cart_item"]))) {
                                        foreach($_SESSION["cart_item"] as $k => $v) {
                                            if($item->serviceid == $k) {
                                                if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                                }
                                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                                            }
                                        }
                                    }else {
                                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                                    }
                                }else {
                                    $_SESSION["cart_item"] = $itemArray;
                                }
                            }
                        }
                    }
                    break;
                    // code for removing product from cart
                case "remove":
                    if(!empty($_SESSION["cart_item"])) {
                        foreach($_SESSION["cart_item"] as $k => $v) {
                            if($_GET["code"] == $k)
                            unset($_SESSION["cart_item"][$k]);                
                            if(empty($_SESSION["cart_item"]))
                            unset($_SESSION["cart_item"]);
                        }
                    }
                    break;
                    // code for if cart is empty
                case "empty":
                    unset($_SESSION["cart_item"]);
                break;  
            }
        }
        if (isset($request->selected_sport)) {
            $request->session()->put('selected_sport', $request->selected_sport);
        } else {
            $request->session()->forget('selected_sport');
        }
        
        if (isset($request->level_of_experience)) {
          $request->session()->put('level_of_experience', $request->level_of_experience);
        } else {
            $request->session()->forget('level_of_experience');
        }

        if (isset($request->who_is_training)) {
            $request->session()->put('who_is_training', $request->who_is_training);
        } else {
            $request->session()->forget('who_is_training');
        }

        if (isset($request->gender)) {
            $request->session()->put('gender', $request->gender);
        } else {
            $request->session()->forget('gender');
        }

        if (isset($request->personality)) {
            $request->session()->put('personality', $request->personality);
        } else {
            $request->session()->forget('personality');
        }

        if (isset($request->availability_days)) {
            $request->session()->put('availability_days', $request->availability_days);
        } else {
            $request->session()->forget('availability_days');
        } 

        if (isset($request->program_type)) {
           /* print_r($request->program_type);exit;*/
            $program_type = implode(',', $request->program_type);
            $request->session()->put('program_type', $program_type);
        } else {
            $request->session()->forget('program_type');
        } 

        if (isset($request->service_type)) {
             $service_type = implode(',', $request->service_type);
            $request->session()->put('service_type', $service_type);
        } else {
            $request->session()->forget('service_type');
        }

        if (isset($request->service_type_two)) {
             $service_type_two = implode(',', $request->service_type_two);
            $request->session()->put('service_type_two', $service_type_two);
        } else {
            $request->session()->forget('service_type_two');
        }

        if (isset($request->activity_type)) {
          /*   print_r($request->activity_type);exit;*/
            $activity_for = implode(',', $request->activity_type);
            $request->session()->put('activity_type', $activity_for);
        } else {
            $request->session()->forget('activity_type');
        }
               
        $myloc = $request->location;
        $language = $request->language;
        $select_language = $request->language;
        $select_label = $request->label;
        $select_zipcode = $request->zipcode;

        if (isset($request->selected_location)) {
            $request->session()->put('selected_location', $request->selected_location);
            if ($request->selected_location == '') {
                //If selected_location is not set -> unset miles_radius_filter  
                $request->session()->forget('miles_radius_filter');
            } else {
                //If selected_location and miles_radius_filter both are set  
                if (isset($request->miles_radius_filter)) {
                    $request->session()->put('miles_radius_filter', $request->miles_radius_filter);
                } else {
                    $request->session()->forget('miles_radius_filter');
                }
            }
        } else {
            $request->session()->forget('selected_location');
            //If selected_location is not set -> unset miles_radius_filter  
            $request->session()->forget('miles_radius_filter');
        }

        if (isset($request->selected_location_lat)) {
            $request->session()->put('selected_location_lat', $request->selected_location_lat);
        } else {
            $request->session()->forget('selected_location_lat');
        }

        if (isset($request->selected_location_lng)) {
            $request->session()->put('selected_location_lng', $request->selected_location_lng);
        } else {
            $request->session()->forget('selected_location_lng');
        }

        if (isset($request->professional_type)) {
            $request->session()->put('professional_type', $request->professional_type);
        } else {
            $request->session()->forget('professional_type');
        }

        if (isset($request->filter_review_star)) {
            $request->session()->put('filter_review_star', $request->filter_review_star);
        } else {
            $request->session()->forget('filter_review_star');
        }

        $selectedSpot = $request->session()->get('selected_sport') ? $request->session()->get('selected_sport') : null;
        $levelOfExp = $request->session()->get('level_of_experience') ? $request->session()->get('level_of_experience') : null;
        $whoIsTraining = $request->session()->get('who_is_training') ? $request->session()->get('who_is_training') : null;
        $gender = $request->session()->get('gender') ? $request->session()->get('gender') : null;
        $personality = $request->session()->get('personality') ? $request->session()->get('personality') : null;
        $availability_days = $request->session()->get('availability_days') ? $request->session()->get('availability_days') : null;
        $selected_location = $request->session()->get('selected_location') ? $request->session()->get('selected_location') : null;
        $selected_location_lat = $request->session()->get('selected_location_lat') ? $request->session()->get('selected_location_lat') : null;
        $selected_location_lng = $request->session()->get('selected_location_lng') ? $request->session()->get('selected_location_lng') : null;
        $miles_radius_filter = $request->session()->get('miles_radius_filter') ? $request->session()->get('miles_radius_filter') : 0;
        $professional_type = $request->session()->get('professional_type') ? $request->session()->get('professional_type') : '1';
        $filter_review_star = $request->session()->get('filter_review_star') ? $request->session()->get('filter_review_star') : null;
        /*$program_type = $request->session()->get('program_type') ? $request->session()->get('program_type') : null;
        $service_type = $request->session()->get('service_type') ? $request->session()->get('service_type') : null;
        $service_type_two = $request->session()->get('service_type_two') ? $request->session()->get('service_type_two') : null;
        $activity_for = $request->session()->get('activity_for') ? $request->session()->get('activity_for') : null;
*/
        $sports = $this->sports->getAlphabetsWiseSportsNames();
        $sport_names = $this->sports->getAllSportsNames();
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
        $sports_select = '';
        if ($sports) {
            $sports_select .= "<option value=''>Choose Activity</option>";
            foreach ($sports as $key => $value) {
                foreach ($value as $key1 => $value1) {
                    if (count($value1->child)) {
                        $sports_select .= "<optgroup label='" . $value1->title . "'>";
                        foreach ($value1->child as $key2 => $value2) {
                            $selected = null; // ($service==$key2)?"selected":"";
                            $sports_select .= "<option value='" . $key2 . "' " . $selected . " >" . $value2 . "</option>";
                        }
                        $sports_select .= "</optgroup>";
                    }else {
                        $selected = null; //($service==$value1->value)?"selected":"";
                        $sports_select .= "<option value='" . $value1->value . "' " . $selected . ">" . $value1->title . "</option>";
                    }
                }
            }
        }
        $myloc = $request->location;
        //$language = $request->language;
        //$select_language = $request->language;
        $select_label = $request->label;
        $select_zipcode = $request->zipcode;
        $site_search = $request->site_search;
        $companyData = $servicePrice = $businessSpec = [];
        /*if(!empty($request->all())){
            DB::enableQueryLog();
        }*/
        /*  Comment by purvi
        $searchData = BusinessServices::where('instant_booking', 1)->where('is_active', 1);*/
        
        $searchData = BusinessServices::where('business_services.is_active', 1);

        //print_r( $searchData);die;
        $searchDataProfile=array();
        $searchDatauserProfile = '';
        $searchDatabusiness = '';
        if ($select_label != null && $select_label != 'undefined') {
           /* echo "$select_label";die;*/
            //$searchData->where('sport_activity', 'LIKE', $select_label . '%');
            $searchData->where(function ($query) use ($select_label) {
                $query->where('sport_activity', 'LIKE', '%'. $select_label . '%');       
                   /* ->orWhere('program_name', 'LIKE',  '%'.$select_label . '%')*/;
            });
            $searchDatauserProfile = User::where('username', 'LIKE', '%'.$select_label.'%')->first();
            $searchDatabusiness = CompanyInformation::where('company_name','LIKE', '%'.$select_label.'%')->first();
        }

        if ($select_zipcode != null && $select_zipcode != 'undefined') {
            $searchData->where('exp_zip', 'LIKE', '%'.$select_zipcode . '%');
        }
        if ($site_search != null && $site_search != 'undefined') {
            $searchData->where('sport_activity', 'LIKE', '%'.$site_search . '%');
        }

        if ($myloc != null && $myloc != 'undefined') {
            $search = $myloc;
            if(!empty($search) ||$search[0]!= ''){
                $searchData->join('company_informations', 'business_services.userid', '=', 'company_informations.user_id')->select('business_services.*','company_informations.*')->groupby('business_services.id')->where(function ($query) use ($search){
                            $query->Where('company_informations.city', 'LIKE', '%'. $search . '%')->orwhere('company_informations.state', 'LIKE', '%'. $search . '%')->orWhere('company_informations.zip_code', 'LIKE', '%'. $search . '%')->orWhere('company_informations.country', 'LIKE', '%'. $search . '%');
                        });
                /*orwhere('company_informations.state', 'LIKE', '%'. $search . '%') ->orWhere('company_informations.city', 'LIKE', '%'. $search . '%')->orWhere('company_informations.zip_code', 'LIKE', '%'. $search . '%');*/
            }
            //$searchData->where('exp_city', 'LIKE', '%'. $myloc . '%')->orWhere('exp_state', 'LIKE', '%'. $myloc . '%');
            /*$searchData->where(function ($query) use ($myloc) {
                $query->where('state', 'LIKE', '%'. $myloc . '%')        
                ->orWhere('city', 'LIKE', '%'. $myloc . '%');
                ->orWhere('zip_code', 'LIKE', '%'. $myloc . '%');
            });*/
        }

        if($request->program_type  != null) {
            $search = $request->program_type;
            if(!empty($search)){
                $searchData->where(function($q) use ($search) {
                    foreach ($search as $data) {
                        $data = ucwords($data);
                        $q->orWhere('sport_activity', 'LIKE', '%'. $data . '%');
                    }
                });
            }
        }

        if($request->activity_Member  != null) {
            $search = $request->activity_Member;
            if(!empty($search) ||$search[0]!= ''){
                $searchData->join('business_price_details', 'business_services.id', '=', 'business_price_details.serviceid')->select('business_services.*','business_price_details.membership_type')->groupby('business_services.id')->where(function($q) use ($search) {
                    foreach ($search as $data) {
                        $data = ucwords($data);
                        $q->orWhere('membership_type', 'LIKE', '%'. $data . '%');
                    }
                });
            }
        }

        if($request->activity_for  != null) {
            $search = $request->activity_for;
            if(!empty($search) ||$search[0]!= ''){
                $searchData->join('business_price_details', 'business_services.id', '=', 'business_price_details.serviceid')->select('business_services.*','business_price_details.membership_type')->groupby('business_services.id')->where(function($q) use ($search) {
                    foreach ($search as $data) {
                        $data = ucwords($data);
                        $q->orwhereRaw('FIND_IN_SET("'.$data.'",activity_for)');
                    }
                });
            }
        }

        if($request->activity_location != null  ){
            $search = $request->activity_location;
            if(!empty($search) ||$search[0]!= ''){
                $searchData->where(function($q) use ($search) {
                    if(!in_array("any", $search)){
                        foreach ($search as $data) {
                            /*if(strpos($data,'_')!= ''){
                                $data = ucwords(str_replace('_',' ', $data));
                            }
                            else{*/
                                $data = ucwords($data);
                           /* }*/
                            $q->orwhereRaw('FIND_IN_SET("'.$data.'",activity_location)');
                        }
                    }
                });
            }
        }

        if($request->frm_cnumberofpeople  != null) {
            $search = $request->frm_cnumberofpeople;
            if(!empty($search[0]) ||$search[0]!= ''){
                $searchData->join('business_activity_scheduler', 'business_services.id', '=', 'business_activity_scheduler.serviceid')->select('business_services.*','business_activity_scheduler.spots_available')->Where('business_activity_scheduler.spots_available', '>=', $request->frm_cnumberofpeople)->distinct()->groupBy('business_services.id');
            }
        }

        if($request->age_range != null ) {
            $search = $request->age_range;
            if(!empty($search)){
                $searchData->where(function($q) use ($search) {
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
        }

        if ($request->duration != null ) {
            $search = $request->duration;
            if(!empty($search)){
                $searchData->where(function($q) use ($search) {
                    foreach ($search as $data) {
                        $q->orWhere('mon_duration', 'LIKE', '%'. $data . '%')->orWhere('tue_duration', 'LIKE', '%'. $data . '%')->orWhere('wed_duration', 'LIKE', '%'. $data . '%')->orWhere('thu_duration', 'LIKE', '%'. $data . '%')->orWhere('fri_duration', 'LIKE', '%'. $data . '%')->orWhere('sat_duration', 'LIKE', '%'. $data . '%')->orWhere('sun_duration', 'LIKE', '%'. $data . '%')->where('business_services.is_active',1);
                    }
                });
            }
        }

        if($request->service_type != null ) {
            $search = $request->service_type;
            if(!empty($search)){
                $searchData->where(function($q) use ($search) {
                    foreach ($search as $data) {
                        $q->orWhere('service_type', 'LIKE', '%'. $data . '%');
                    }
                });
            }
        }

        if ($request->difficulty_level != null ) {
            $search = $request->difficulty_level;
            if(!empty($search)){
                $searchData->where(function($q) use ($search) {
                    if(!in_array("any", $search)){
                        foreach ($search as $data) {
                            $data = ucwords($data);
                            $q->orWhere('difficult_level', 'LIKE', '%'. $data . '%');
                        }
                    }
                });
            }
        }

        if ($request->activity_exp != null) {
            $search = $request->activity_exp;
            if(!empty($search)){
                $searchData->where(function($q) use ($search) {
                    foreach ($search as $data) {
                        if(strpos($data,'_')!= ''){
                            $data = ucwords(str_replace('_',' ', $data));
                        }
                        else{
                            $data = ucwords($data);
                        }
                        $q->orWhere('activity_experience', 'LIKE', '%'. $data . '%');
                    }
                });
            }
        }
        
        //Personality Habit
        if ($request->personality_habit != null ) {
            $search = $request->personality_habit;
            if(!empty($search)){
                $searchData->where(function($q) use ($search) {
                    foreach ($search as $data) {
                        if(strpos($data, '_')!= ''){
                            $data = ucwords(str_replace('_',' ', $data));
                        }
                        else{
                            $data = ucwords($data);
                        }
                        $q->orWhere('instructor_habit', 'LIKE', '%'. $data . '%');
                    }
                });
            }
        }

        if($request->service_type_two != null ) {
            $search = $request->service_type_two;
            if(!empty($search)){
                $searchData->where(function($q) use ($search) {
                    foreach ($search as $data) {
                        $q->orWhere('select_service_type', 'LIKE', '%'. $data . '%');
                    }
                });
            }
        }

        if ($request->activity_type != null ) {
            $search = $request->activity_type;
            if(!empty($search)){
                $searchData->where(function($q) use ($search) {
                    if(!in_array("any", $search)){
                        foreach ($search as $data) {
                            $data = ucwords($data);
                            $q->orWhere('activity_for', 'LIKE', '%'. $data . '%');
                        }
                    }
                });
            }
        }
         
        $serviceData = $searchData->where('business_services.is_active',1)->get();
        /*if(!empty($request->all())){
            dd(DB::getQueryLog());
        }*/
       /* if(!empty($request->all())){
            echo "<pre>";print_r($serviceData);die;
        }*/
        /*if ($myloc != null && $myloc != 'undefined') {
            if ($select_zipcode != null && $select_zipcode != 'undefined') {
              $company = CompanyInformation::where('sport_activity', 'LIKE', $select_label . '%')->where('program_name', 'LIKE', $select_label . '%')->where('city', 'LIKE', $myloc . '%')->where('zip_code', 'LIKE', $select_zipcode . '%')->get();
            }else {
              $company = CompanyInformation::where('city', 'LIKE', $myloc . '%')->get();
            }
        } else {
            $company = CompanyInformation::where('sport_activity', 'LIKE', $select_label . '%')->orWhere('program_name', 'LIKE', $select_label . '%')->where->get();
        }*/
        if (isset($serviceData)) {
            foreach ($serviceData as $service) {
                $company = CompanyInformation::where('id', $service['cid'])->get();
                $company = isset($company[0]) ? $company[0] : [];
                if(!empty($company)) {
                    $companyData[$company['id']][] = $company;
                }
                //$price = BusinessPriceDetails::where('cid', $service['cid'])->get();
                $price = BusinessPriceDetails::where('serviceid', $service['id'])->get();
                $price = isset($price[0]) ? $price[0] : [];
                if(!empty($company)) {
                    $servicePrice[$company['id']][] = $price;
                }
                $business_spec = BusinessService::where('cid', $service['cid'])->get();
                $business_spec = isset($business_spec[0]) ? $business_spec[0] : [];
                if(!empty($company)) {
                    $businessSpec[$company['id']][] = $business_spec;
                }
            }
        }
        
        /*$aid = $request->aid;
        $data='';
        $reviews_count = BusinessServiceReview::where('service_id', $aid)->count();
        $reviews_sum = BusinessServiceReview::where('service_id', $aid)->sum('rating');
        $reviews_avg=0;
        if($reviews_count>0)
        { $reviews_avg= round($reviews_sum/$reviews_count,2); }
        $reviews = BusinessServiceReview::where('service_id', $aid)->get();
        $reviews_people = BusinessServiceReview::where('service_id',$aid)->orderBy('id','desc')->limit(6)->get(); */
        
        $locations = [];
        foreach($companyData as $company) {
            foreach($company as $value) {
                //review calculation
                $aid = $value['serviceid'];
                $data='';
                $reviews_count = BusinessServiceReview::where('service_id', $aid)->count();
                $reviews_sum = BusinessServiceReview::where('service_id', $aid)->sum('rating');
                $reviews_avg=0;
                if($reviews_count>0)
                { 
                    $reviews_avg= round($reviews_sum/$reviews_count,2);
                }
                $reviews = BusinessServiceReview::where('service_id', $aid)->get();
                $reviews_people = BusinessServiceReview::where('service_id',$aid)->orderBy('id','desc')->limit(6)->get();
                //end for review calculation  
                $found = 0;
                foreach ($locations as $key2 => $value2) {
                    if (($value2[1] == $value['latitude']) && ($value2[2] == $value['longitude'])) {
                        $found = $found + 1;
                    }
                }
                if ($found != 0) {
                    $lat = $value['latitude'] + ((floatVal('0.' . rand(1, 9)) * $found) / 10000);
                    $long = $value['longitude'] + ((floatVal('0.' . rand(1, 9)) * $found) / 10000);
                    $a = [$value['company_name'], $lat, $long, $value['id'], $value['logo'],$reviews_avg,$reviews_count];
                }else {
                    $a = [$value['company_name'], $value['latitude'], $value['longitude'], $value['id'], $value['logo'],$reviews_avg,$reviews_count];
                }
                array_push($locations, $a);
            }
            //break;
        }
        //$servicesData = isset($servicesData[0]) ? $servicesData[0] : [];
        //dd($locations);
        
        $cart = [];
        $cart = $request->session()->get('cart_item') ? $request->session()->get('cart_item') : [];
        $result=array();
        $search_data2 = $serviceData;
        if(!empty($serviceData))
            $result = $serviceData->toArray();
        $page = $request->page ? $request->page : 1;
        $perPage = $request->page_size ? $request->page_size : 10;
        $offset = ($page * $perPage) - $perPage;

        $resultnew = new LengthAwarePaginator(
        array_slice($result, $offset, $perPage, true), count($result), $perPage, $page, ['path' => $request->url(), 'query' => $request->query()]
        );
        /*if(!empty($request->all())){
           print_r($request->query());
            echo $page;
            echo $perPage;
            echo $offset;

         echo "<pre>";print_r($resultnew);die;
        }*/

        if($searchDatauserProfile != ''){
            return Redirect::to('/userprofile/'.$searchDatauserProfile->username);
        }else if($searchDatabusiness !=''){
            return Redirect::to('businessprofile/'.$searchDatabusiness->company_name.'/'.$searchDatabusiness->id);
        }else{
            return view('jobpost.instanthire', [
                'cart' => $cart,
                'serviceData' => $resultnew,
                //'serviceData' => $serviceData,
                'companyData' => $companyData,
                'servicePrice' => $servicePrice,
                'businessSpec' => $businessSpec,
                'sports' => $sports,
                'sport_names' => $sport_names,
                'businessType' => $businessType,
                'pageTitle' => "DIRECT HIRE",
                'activity' => $activity,
                'programType' => $programType,
                'ageRange' => $ageRange,
                'alllanguages' => $languages,
                'pFocuses' => $pFocuses,
                'serviceLocation' => $serviceLocation,
                'sports_select' => $sports_select,
                'locations' => $locations,
                'searchDataProfile' => $searchDataProfile,
            ]);
        }
        
    }

    public function getBookingServiceData(Request $request) {
        $search_string = "%" . $request->date . "%";
        $data = UserService::where('user_id', $request->user_id)->where('available_dates', 'LIKE', $search_string)->get();
        // return resposne()->json(['status'=>200,'data'=>$data]);
        foreach ($data as $value) {
            $value['serve_time_slot'] = json_decode($value['serve_time_slot']);
            $numberofpeople = json_decode($value['numberofpeople'], true);
            $people = $numberofpeople[0];
            $booking = UserBookingStatus::where('business_id', $request->user_id)->where('service_id', $value['id'])->where('status', 'confirmed')->get();
            $pp = 0;
            foreach ($booking as $value2) {
                $det = UserBookingDetail::where('booking_id', $value2['id'])->first();
                $d = json_decode($det->booking_detail, true);
                $pp = $pp + $d['numberofpersons'];
            }
            $value['available_seats'] = $people - $pp;
        }
        return response()->json(['status' => 200, 'data' => $data]);
    }

    public function directhireBookProfile($user_id) {
        if ($user_id == Auth::User()->id) {
            return redirect('/')->with('alert-info', "You are not able to view this profile at this time");
        }

        // $sports = Miscellaneous::getMiscellaneous('sports', 'title', true);
        $sports = $this->sports->getAlphabetsWiseSportsNames();
        $sports_names = $this->sports->getAllSportsNames();
        $sports_child_parent = $this->sports->getSportsChildParentWise();

        $UserProfileDetail = $this->users->getUserProfileDetail1($user_id);

        $userSpotPrice = $userSport = array();

        if (count($UserProfileDetail['service']) > 0) {
            foreach ($UserProfileDetail['service'] as $service) {

                if (@$sports_child_parent[$service['sport']] > 0) {
                    if (isset($sports_names[$service['sport']])) {
                        $userSport[@$sports_names[@$sports_child_parent[$service['sport']]]]['child'][$service['sport']] = @$sports_names[$service['sport']];
                        $userSpotPrice[$service['sport']] = $service['price'];
                    }
                } else {
                    if (isset($sports_names[$service['sport']])) {
                        $userSport[@$sports_names[$service['sport']]]['self'][$service['sport']] = @$sports_names[$service['sport']];
                        $userSpotPrice[$service['sport']] = $service['price'];
                    }
                }
            }
        }
        $sports_select = '';
        if ($sports) {
            $sports_select .= "<option value=''>Choose Activity</option>";
            foreach ($sports as $key => $value) {
                foreach ($value as $key1 => $value1) {
                    if (count($value1->child)) {
                        $sports_select .= "<optgroup label='" . $value1->title . "'>";
                        foreach ($value1->child as $key2 => $value2) {
                            $selected = null; // ($service==$key2)?"selected":"";
                            $sports_select .= "<option value='" . $key2 . "' " . $selected . " >" . $value2 . "</option>";
                        }
                        $sports_select .= "</optgroup>";
                    } else {
                        $selected = null; //($service==$value1->value)?"selected":"";
                        $sports_select .= "<option value='" . $value1->value . "' " . $selected . ">" . $value1->title . "</option>";
                    }
                }
            }
        }

        $aval = UserService::where('company_id', $user_id)->get();
        $final_available = [];
        $current = date("Y-m-d");
        foreach ($aval as $value) {
            $dates = json_decode($value['available_dates']);
            foreach ($dates as $value2) {
                $time = strtotime($value2);
                $d2 = date("d m Y", $time);
                if ($time >= strtotime($current)) {
                    array_push($final_available, $d2);
                }
            }
        }
        if (count($final_available) == 0)
            return redirect('/')->with('alert-info', "Booking dates not available");
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
        $family = UserFamilyDetail::where('user_id', Auth::user()->id)->get();
        //print_r($final_available);die;
        return view('jobpost.directhire-businessprofile-book', [
            'UserProfileDetail' => $UserProfileDetail,
            'userSport' => $userSport,
            'userSpotPrice' => $userSpotPrice,
            'sports' => $sports,
            'sports_names' => $sports_names,
            'user_id' => $aval[0]->user_id,
            'businessType' => $businessType,
            'pageTitle' => "DIRECT HIRE",
            'family' => $family,
            'activity' => $activity,
            'programType' => $programType,
            'ageRange' => $ageRange,
            'alllanguages' => $languages,
            'pFocuses' => $pFocuses,
            'serviceLocation' => $serviceLocation,
            'sports_select' => $sports_select,
            'final_available' => $final_available,
        ]);
    }
    
    public function isJson($string) {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
    
    public function getCompareProfessionalDetail($id) {
		
        $professional_id = array();
        if (isset($id) && $id != "") {
            $professional_id = explode(",", $id);
        }
        $profiledetail = $this->users->getUserProfileDetail2($professional_id, array('professional_detail', 'certification', 'service'));
        
        $return = array();
        if (count($professional_id) == 0) {
            $return['status'] = false;
            return json_encode($return);
        }

        // print_r(count($profiledetail));die;
        $sports_names = $this->sports->getAllSportsNames();
        $data = array();
		
        foreach ($profiledetail as $profile) {
            // print_r($profile);die;
            $c_names = '';
            // foreach($profile->company as $x => $co) {
            //     //if($x == 0)
            //         $c_names = $c_names.$co->company_name;
            //     if($x+1 != count($profile->company)){
            //         $c_names = $c_names.', ';
            //     }
            // }

            $data["profile_" . $profile->id] = array();
            $data["profile_" . $profile->id]['company_names'] = $profile->company_name;
            
            $data["profile_" . $profile->id]['explevel'] = '-';
            $getExpLavel = '';
            if(isset($profile->ProfessionalDetail->experience_level) && $profile->ProfessionalDetail->experience_level != ""){
                $getExpLavel = Miscellaneous::getBusinessProfileAnswers($profile->ProfessionalDetail->experience_level);
                if($this->isJson($getExpLavel)){
                    $data["profile_" . $profile->id]['explevel'] = json_decode(Miscellaneous::getBusinessProfileAnswers($profile->ProfessionalDetail->experience_level));
                }
                else{
                    $data["profile_" . $profile->id]['explevel'] = Miscellaneous::getBusinessProfileAnswers($profile->ProfessionalDetail->experience_level);
                }
            }
            
            $data["profile_" . $profile->id]['train_to'] = '';
            if (isset($profile->ProfessionalDetail->train_to) &&  $profile->ProfessionalDetail->train_t!== "") {
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
                    if($this->isJson($train_concat)){
                        $data["profile_" . $profile->id]['train_to'] = json_decode($train_concat);
                    }
                    else{
                        $data["profile_" . $profile->id]['train_to'] = $train_concat;
                    }
                }
            }

            $data["profile_" . $profile->id]['personality'] = '';
            
            if (isset($profile->ProfessionalDetail->personality) && $profile->ProfessionalDetail->personality!== "") {
                if(is_object($profile->ProfessionalDetail->personality)){
                    $personality = explode(',', $profile->ProfessionalDetail->personality);
                    if (count($personality) > 0) {
                        $personality_concat = "";
                        foreach ($personality as $val) {
                            if ($personality_concat === "") {
                                $personality_concat = Miscellaneous::getAnswers($val);
                            } else {
                                $personality_concat .= ', ' . Miscellaneous::getAnswers($val);
                            }
                        }
                        if($this->isJson($personality_concat)){
                            $data["profile_" . $profile->id]['personality'] = json_decode($personality_concat);
                        }
                        else{
                            $data["profile_" . $profile->id]['personality'] = $personality_concat;
                        }
                    }
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

           /* if ($profile->ProfessionalDetail->availability != "") {
                $profile->ProfessionalDetail->availability = json_decode($profile->ProfessionalDetail->availability);
                if (gettype($profile->ProfessionalDetail->availability) != 'object') {
                    $profile->ProfessionalDetail->availability = json_decode($profile->ProfessionalDetail->availability);
                }
                // $profile->ProfessionalDetail->availability = json_encode($profile->ProfessionalDetail->availability);
            }*/
            
            $data["profile_" . $profile->id]['professional_type'] = ($profile->ProfessionalDetail->professional_type != "") ? ucfirst($profile->ProfessionalDetail->professional_type) : "-";
            $data["profile_" . $profile->id]['willing_to_travel'] = ($profile->ProfessionalDetail->willing_to_travel != "") ? str_replace(",", ", ", ucfirst($profile->ProfessionalDetail->willing_to_travel)) : "-";
            $data["profile_" . $profile->id]['travel_miles'] = ($profile->ProfessionalDetail->travel_miles != "") ? str_replace(",", ", ", $profile->ProfessionalDetail->travel_miles) : "-";

            $data["profile_" . $profile->id]['certification'] = "-";
            $data["profile_" . $profile->id]['service'] = "-";
            $data["profile_" . $profile->id]['sport'] = "-";

            if (count($profile->certification) > 0) {
                $certification = array();
                foreach ($profile->certification as $certi) {
                    $certification[] = $certi->title;
                }
                $data["profile_" . $profile->id]['certification'] = implode(", ", $certification);
            }
            if (count($profile->service) > 0) {
                $userservice = array();
                $sport = array();
                foreach ($profile->service as $service) {
                    if (isset($sports_names[$service->sport])) {
                        $userservice[] = ucfirst($service->title);
                        $sport[] = ucfirst($sports_names[$service->sport]);
                    }
                }

                $data["profile_" . $profile->id]['service'] = implode(", ", $userservice);
                $data["profile_" . $profile->id]['sport'] = implode(", ", array_unique($sport));

                if ($data["profile_" . $profile->id]['service'] == '')
                    $data["profile_" . $profile->id]['service'] = '-';
                if ($data["profile_" . $profile->id]['sport'] == '')
                    $data["profile_" . $profile->id]['sport'] = '-';
            }
        }

        $return['status'] = true;
        $return['data'] = $data;
        return json_encode($return);
    }

//     public function directhireViewProfile($user_id) {  
//       // $sports = Miscellaneous::getMiscellaneous('sports', 'title', true);
//       $sports = $this->sports->getAlphabetsWiseSportsNames();
//       $sports_names = $this->sports->getAllSportsNames();
//       $UserProfileDetail = $this->users->getUserProfileDetail1($user_id);
//      // $UserProfileDetail = $this->users->getUserProfileDetail($user_id, array('professional_detail','history','company','education','certification','service'));
//      //// print_r($UserProfileDetail);die;
// //dd($UserProfileDetail['ProfessionalDetail']);
//     //   if(isset($UserProfileDetail['ProfessionalDetail']) && @count($UserProfileDetail['ProfessionalDetail']) > 0){
//     //       $UserProfileDetail['ProfessionalDetail'] = UserProfessionalDetail::getFormedProfile($UserProfileDetail['ProfessionalDetail']);
//     //   }
//       $userSpotPrice = $userSport = array();
//       $userSport[""] = "Select Sport";
//       if(@count(@$UserProfileDetail['service']) > 0) {
//         foreach($UserProfileDetail['service'] as $service) {
//           if(isset($sports_names[$service['sport']]))
//           {
//             $userSport[$service['sport']] = $service['sport'];
//             $userSpotPrice[$service['sport']] = $service['price'];
//           }
//         }
//       }
//       $sports_select = '';
//       if($sports){
//         $sports_select .= "<option value=''>Choose Activity</option>";
//         foreach ($sports as $key => $value) {
//             foreach ($value as $key1 => $value1) {
//                 if(count($value1->child)){
//                     $sports_select .= "<optgroup label='".$value1->title."'>";
//                     foreach ($value1->child as $key2 => $value2) {
//                         $selected =null;// ($service==$key2)?"selected":"";
//                         $sports_select .= "<option value='".$key2."' ".$selected." >".$value2."</option>";
//                     }
//                     $sports_select .= "</optgroup>";
//                 } else {
//                     $selected = null;//($service==$value1->value)?"selected":"";
//                     $sports_select .= "<option value='".$value1->value."' ".$selected.">".$value1->title."</option>";
//                 }
//             }
//         }
//     }
//       $businessType = Miscellaneous::businessType();
//       $programType = Miscellaneous::programType();
//       $programFor = Miscellaneous::programFor();
//       $numberOfPeople = Miscellaneous::numberOfPeople();
//       $ageRange = Miscellaneous::ageRange();
//       $expLevel = Miscellaneous::expLevel();
//       $serviceLocation = Miscellaneous::serviceLocation();
//       $pFocuses = Miscellaneous::pFocuses();
//       $duration = Miscellaneous::duration();
//       $servicePriceOption = Miscellaneous::servicePriceOption();
//       $specialDeals = Miscellaneous::specialDeals();
//       $activity = Miscellaneous::activity();
//       $teaching = Miscellaneous::teaching();
//       $languages = Miscellaneous::getLanguages();
//       $timeSlots = Miscellaneous::getTimeSlot();
//       $approve = Evidents::where('user_id',$user_id)->get();
//       return view('jobpost.directhire_businessprofile', [
//             'UserProfileDetail' => $UserProfileDetail,
//             'userSport' => $userSport,
//             'userSpotPrice' => $userSpotPrice,
//             'sports' => $sports,
//             'sports_names' => $sports_names,
//             'businessType' => $businessType,
//             'programType' => $programType,
//             'programFor' => $programFor,
//             'numberOfPeople' => $numberOfPeople,
//             'ageRange' => $ageRange,
//             'expLevel' => $expLevel,
//             'serviceLocation' => $serviceLocation,
//             'pFocuses' => $pFocuses,
//             'duration'=> $duration,
//             'specialDeals' => $specialDeals,
//             'servicePriceOption' => $servicePriceOption,
//             'pageTitle' => "DIRECT HIRE",
//             'approve'=>$approve,
//             'activity'=>$activity,
//             'alllanguages' => $languages,
//             'sports_select' => $sports_select,
//       ]);
//     }

    public function directhireViewProfile($user_id) {
        $company = CompanyInformation::with('employmenthistory', 'education', 'users', 'certification', 'service', 'skill', 'ProfessionalDetail')->where('id', $user_id)->first();
        $company['company_images'] = $company['company_images'] == null ? [] : json_decode($company['company_images']);
        $max_price = UserService::where('company_id', $company['id'])->max('price');
        $min_price = UserService::where('company_id', $company['id'])->min('price');
        //    print_r($company['company_images']);die;
        $user_professional_detail = UserProfessionalDetail::where('company_id', $user_id)->first();
        $user_professional_detail->availability = $user_professional_detail->availability != null ? json_decode(json_decode($user_professional_detail->availability)) : null;
        // return $user_professional_detail->availability->sunday_start;
        // $service = '';
        $services = UserService::where('company_id', $company['id'])->get();
        foreach ($services as $key2 => $value2) {
            $sport = Sports::where('id', $value2['sport'])->first();
            $value2['amenties'] = $sport['sport_name'];
        }
        return view('home.individual-page-new', compact('company', 'user_professional_detail', 'services', 'max_price', 'min_price'));
    }

    public function viewbusinessprofile($user_id) {
        $UserProfileDetail = $this->users->getUserProfileDetail($user_id);

        if (isset($UserProfileDetail['ProfessionalDetail']) && count($UserProfileDetail['ProfessionalDetail']) > 0) {
            $UserProfileDetail['ProfessionalDetail'] = UserProfessionalDetail::getFormedProfile($UserProfileDetail['ProfessionalDetail']);
        }

        $sports_names = $this->sports->getAllSportsNames();
        return view('jobpost.viewbusinessprofile', [
            'UserProfileDetail' => $UserProfileDetail,
            'sports_names' => $sports_names
        ]);
    }

    public function postSearchProfile($selected_sport) {
        $ProfessionalsDetail = $this->users->getAllProfessionals($selected_sport);
        return json_encode($ProfessionalsDetail);
    }

    public function postSaveDirecthireRequest(Request $request) {
        $loggedinUser = Auth::user();
        $data = array();

        $who = [];

        foreach ($request->whoistraining as $value) {
            if ($value == 'me') {
                array_push($who, $value);
            } else {
                $d = UserFamilyDetail::where('id', $value)->first();
                if ($d->email != null) {
                    array_push($who, $d->email);
                }
            }
        }


        $data = [
            'booking_type' => 'direct',
            'user_id' => getLoggedInUserId(),
            'business_id' => $request->business_id,
            'sport' => $request->selectcatagory,
            'status' => 'requested',
            'booking_detail' => json_encode(array('activitytype' => $request->activitytype,
                'numberofpersons' => $request->numberofpersons,
                'activitylocation' => $request->activitylocation,
                'whoistraining' => $who)),
            'schedule' => json_encode($request->hours),
            'price' => $request->price,
            'service_id' => $request->service_id
        ];

        $cart = array('user_id' => getLoggedInUserId(), 'price' => str_replace("$", "", $request->price), 'numberofpersons' => $request->numberofpersons, 'service_choice' => $request->selectcatagory,
            'salestaxpercentage' => $request->salestaxpercentage,
            'duestaxpercentage' => $request->duestaxpercentage);

        $status = $this->bookings->saveBookingStatus($data, $cart, "no");
        //  print_r($status);die;
        $request->session()->flash($status['type'], $status['msg']);
        $response = array(
            'type' => $status['type'],
            'msg' => $status['msg'],
            'bookid' => $status['bookid']
        );
        return Response::json($response);
        exit();
    }

    public function postBookProfessional(Request $request) {
        $status = $this->bookings->bookprofessional($request);
        $request->session()->flash($status['type'], $status['msg']);
        $response = array(
            'type' => $status['type'],
            'msg' => $status['msg']
        );
        return Response::json($response);
        exit();
    }

    public function GetBookingList($status = null) {
        $loggedinUser = Auth::user();
        $sportsList = $this->sports->getAllSportsNames(1);

        if (Auth::user()->role == "business") {
            if ($status == null)
                $status = 'confirmed';
            $jobpostobj = $this->bookings->getBookingList($postedUserId = null, $loggedinUser['id'], $paginate = 5, $status);
            $view = 'jobpost.professional.mybooking';
        }else {
            $jobpostobj = $this->bookings->getBookingList($loggedinUser['id'], $hiredUserId = null, $paginate = 5, $status);
            $view = 'jobpost.customer.mybooking';
        }
        return view($view, [
            'jobpostobj' => $jobpostobj,
            'sportsList' => $sportsList,
            'pageTitle' => "MY BOOKINGS"
        ]);
    }

    public function Getjobmatchingskill(Request $request) {
        if (!Gate::allows('matching_job_access')) {
            $request->session()->flash('alert-danger', 'Access Restricted');
            return redirect('/');
        }
        $loggedinUser = Auth::user();
        $joblist = $this->bookings->getJoblistMatchingSkill($loggedinUser['id'], $paginate = 5);
        $sportsList = $this->sports->getAllSportsNames(1);
        return view('jobpost.professional.mymatchingjobs', [
            'joblist' => $joblist,
            'sportsList' => $sportsList,
            'pageTitle' => "JOB MATCHING MY SKILLS"
        ]);
    }

    public function Getjobs($id) {

        if (Auth::check()) {
            if (isset($id) && is_numeric($id)) {

                $jobsObj = Jobpostquestions::WHERE('jobid', $id)->get()->toArray();

                // $qutObj = Quote::SELECT('quote')->WHERE('job_id',$id)->first();
                $qutObj = array();
                $qutObj['quote'] = array();

                $userQut = ($qutObj['quote']) ? $qutObj['quote'] : '';

                $questions = Miscellaneous::getQuestions();

                foreach ($jobsObj as $key => $value) {
                    //$answers = Miscellaneous::getAnswers();
                    $jobsObj[$key]['question'] = $questions[$value['question_id']];


                    $goalstr = "";
                    if ($value['question_id'] !== 'qoutes' && $value['question_id'] !== 'days_available' && $value['question_id'] !== 'time_available' && $value['question_id'] !== 'travel_upto' && $value['question_id'] !== 'goal' && $value['question_id'] !== 'train_location') {

                        $jobsObj[$key]['full_answer'] = Miscellaneous::getAnswers($value['answer']);
                    } else if ($value['question_id'] === 'days_available' || $value['question_id'] === 'time_available') {

                        if (strpos($value['answer'], '|') !== false) {
                            $replace = strtoupper(str_replace('|', ',', $value['answer']));

                            if (strpos($replace, '_') !== false) {
                                $replace = strtoupper(str_replace('_', ' ', $replace));
                            }
                        } else {
                            $replace = ucfirst($value['answer']);
                        }

                        $jobsObj[$key]['full_answer'] = $replace;
                    } else if ($value['question_id'] === 'goal') {
                        if (strpos($value['answer'], '|') !== false) {
                            $goal = str_replace('|', ',', $value['answer']);
                            $goal = explode(',', $goal);
                            if (is_array($goal)) {
                                foreach ($goal as $val) {
                                    $goalstr .= Miscellaneous::getAnswers($val) . ',';
                                }
                            }

                            $jobsObj[$key]['full_answer'] = $goalstr;
                        } else {

                            $jobsObj[$key]['full_answer'] = Miscellaneous::getAnswers($value['answer']);
                        }
                    } else {
                        $jobsObj[$key]['full_answer'] = "";
                    }
                }

                $data = array();
                $data['jobid'] = $id;
                $data['quote'] = $userQut;
                $data['jobsObj'] = $jobsObj;

                if ($data) {
                    return view::make('jobpost.jobs')->with('data', $data);
                }
            } else {
                return redirect::to('/')->withError(['error' => 'Invalid request']);
            }
        } else {
            return redirect::to('/');
        }
    }

    public function viewBooking($id) {
        // echo "in"; die();
        if (isset($id) && is_numeric($id)) {
            $bookingObj = $this->bookings->getBookingDetail($id);
            $sportsList = $this->sports->getAllSportsNames(1);

            $quote_user_id = null;
            if (Auth::user()->role == "business")
                $quote_user_id = Auth::user()->id;

            $bookingQuotes = $this->bookings->getQuoteList($booking_id = $id, $quote_user_id, $id = null, $paginate = 5);
            $bookingObj['bookingQuotes'] = $bookingQuotes;

            $jobsObj = Miscellaneous::getBookingQuestionObject($bookingObj['jobpostquestions']);

            $bookingObj['jobpostquestions'] = $jobsObj;
            $bookingObj['awardedQuote'] = array();

            if (Auth::user()->role == "business") {

                $view = 'jobpost.professional.viewbooking';
            } else {
                $view = 'jobpost.customer.viewbooking';
                // find out awarded quote if any
                if ($bookingObj['business_id'] > 0) {
                    foreach ($bookingQuotes as $bookingQuote) {
                        if ($bookingQuote->user_id == $bookingObj['business_id']) {
                            $awardedQuote = $bookingQuote;
                            $bookingObj['awardedQuote'] = $awardedQuote;
                        }
                    }
                }
            }
            $data = array();
            $data['jobid'] = $id;
            $data['jobsObj'] = $bookingObj;
            // echo '<pre>'; print_r($data['jobsObj']['user_id']); die();
            $fuser_id = $data['jobsObj']['user_id'];
            $followdetail = User::where('id', $data['jobsObj']['user_id'])
                    ->select('id')
                    ->with(['follows' => function ($q) use($fuser_id) {
                            $q->where('user_id', '=', Auth::User()->id);
                            $q->where('follower_id', '=', $fuser_id);
                        }])
                    ->with(['favourites' => function ($q) use($fuser_id) {
                            $q->where('user_id', '=', Auth::User()->id);
                            $q->where('favourite_user_id', '=', $fuser_id);
                        }])
                    ->first();

            return view($view, [
                'data' => $data,
                'booking_id' => $booking_id,
                'followdetail' => $followdetail,
                'sportsList' => $sportsList,
                'pageTitle' => "MY BOOKINGS"
            ]);
        } else {
            return redirect::to('/mybooking')->withError(['error' => 'Invalid request']);
        }
    }

    public function confirmBooking(Request $request) {

        $status = $this->bookings->confirmBooking($request->booking_id);

        $request->session()->flash($status['type'], $status['msg']);
        $response = array(
            'type' => $status['type'],
            'msg' => $status['msg']
        );
        return Response::json($response);
        exit();
    }

    public function rejectBooking(Request $request) {

        $status = $this->bookings->rejectBooking($request->booking_id, $request->reject_reason);

        $request->session()->flash($status['type'], $status['msg']);
        $response = array(
            'type' => $status['type'],
            'msg' => $status['msg']
        );
        return Response::json($response);
        exit();
    }

    public function PostQuote($booking_id) {
        $bookingObj = $this->bookings->getBookingDetail($booking_id);
        $jobsObj = Miscellaneous::getBookingQuestionObject($bookingObj['jobpostquestions']);
        $sportsList = $this->sports->getAllSportsNames(1);
        $bookingQuote = $this->bookings->getQuoteList($booking_id, Auth::User()->id);

        $bookingQuote = $bookingQuote->toArray();
        $userQuote = array();
        if (count($bookingQuote) > 0)
            $userQuote = $bookingQuote[0];

        //get maximum allowed quote count
        $totalAndMaxQuotesForBooking = $this->bookings->getTotalAndMaxQuotesForBooking($booking_id);

        $bookingObj['jobpostquestions'] = $jobsObj;
        $data = [
            'jobid' => $booking_id,
            'jobsObj' => $bookingObj
        ];

        return view('jobpost.professional.postquote', [
            'data' => $data,
            'userQuote' => $userQuote,
            'totalAndMaxQuotesForBooking' => $totalAndMaxQuotesForBooking,
            'sportsList' => $sportsList,
            'pageTitle' => "MY BOOKINGS"
        ]);
    }

    public function SavePostQuote(Request $request) {
        $validator = Validator::make($request->all(), [ 'quote_price' => 'required', 'rate_type' => 'required', 'quote_desc' => 'required'], [ 'required' => 'The :attribute is required.']);
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
        }

        if (!isset($request->quote_id) && $request->quote_id == 0) {
            $totalAndMaxQuotesForBooking = $this->bookings->getTotalAndMaxQuotesForBooking($request->booking_id);

            if (@$totalAndMaxQuotesForBooking['total_quotes'] >= @$totalAndMaxQuotesForBooking['max_quotes']) {
                $response = array(
                    'type' => 'danger',
                    'msg' => 'Max quote limit reached for this booking.',
                );
                return Response::json($response);
            }
        }

        $data = array();
        $data['id'] = $request->quote_id;
        $data['user_id'] = Auth::User()->id;
        $data['booking_id'] = $request->booking_id;
        $data['quote_price'] = $request->quote_price;
        $data['rate_type'] = $request->rate_type;
        $data['quote'] = $request->quote_desc;
        $response = $this->bookings->saveBookingQuote($data, $totalAndMaxQuotesForBooking);
        return Response::json($response);
    }

    public function DeletePostQuote(Request $request) {
        $response = $this->bookings->deleteBookingQuote($request->id);
        return Response::json($response);
    }

    public function GetUserQuoteList() {
        if (Auth::User()->role == "business") {
            $joblist = $this->bookings->getUserBookingListHavingQuotes(Auth::User()->id, null, $paginate = 5);
            $view = 'jobpost.professional.myquote';
        } else {
            $joblist = $this->bookings->getUserBookingListHavingQuotes(null, Auth::User()->id, $paginate = 5);
            $view = 'jobpost.customer.myquote';
        }

        $sportsList = $this->sports->getAllSportsNames(1);
        return view($view, [
            'joblist' => $joblist,
            'sportsList' => $sportsList,
            'pageTitle' => "MY QUOTES"
        ]);
    }

    public function test() {
        $booking_id = 36;
        $booking = UserBookingStatus::with('UserBookingDetail')->with('Jobpostquestions')->findOrFail($booking_id);
        $user = User::findOrFail($booking->user_id);
        $professional = array();
        if ($booking->booking_type == "direct") {
            $professional = User::findOrFail($booking->business_id);
        }

        return view('jobpost.testmail', [
            'user' => $user,
            'booking' => $booking,
            'professional' => $professional,
            'pageTitle' => "MY BOOKINGS"
        ]);
    }

    /* sam code */

    public function times($u, $t) {
        $UserService = UserService::where(['user_id' => $u, 'sport' => $t])->get();
        $time = $UserService[0]['serv_time_slot'];
        return view('jobpost.time', ['time' => $time]);
    }

    public function savetime(Request $r) {
        if (empty($r->hours)) {
            return response()->json(['status' => 0, 'msg' => "Please choose time slot"]);
        }

        $s = UserBookingDetail::where(['booking_id' => $r->bookid])->update(['schedule' => json_encode($r->hours)]);

        return response()->json(['status' => 1]);
    }

    public function getactivity(Request $request, $userid, $ser_id) {
        //   print_r($userid);die;
        $UserService = UserService::where(['user_id' => $userid, 'sport' => $ser_id])->get();
        $s = json_decode($UserService[0]['activitytype']);
        $location = json_decode($UserService[0]['servicelocation']);
        $data = '';
        if (!empty($s)) {
            $data .= '<option value="">Choose Activity Type</option>';
            foreach ($s as $op) {
                $op1 = str_replace('_', ' ', strtoupper($op));
                $data .= '<option value="' . $op . '">' . $op1 . '</option>';
            }
        } else {
            $data .="<option value='' disabled>Option not avilable</option>";
        }
        $locations = '';
        if (!empty($location)) {
            $locations .= '<option value="">Choose Location</option>';
            foreach ($location as $op) {
                $op1 = str_replace('_', ' ', strtoupper($op));
                $locations .= '<option value="' . $op . '">' . $op1 . '</option>';
            }
        } else {
            $locations .="<option value='' disabled>Option not avilable</option>";
        }
        $numberofpeople = json_decode($UserService[0]['numberofpeople'], true);

        $duestaxpercentage = $UserService[0]['duestaxpercentage'];
        $salestaxpercentage = $UserService[0]['salestaxpercentage'];
        $people = $numberofpeople[0];
        $s = $this->bookings->getBookingList($postedUserId = null, $userid, $paginate = 100, 'confirmed', 'time');
        $m = array();
        foreach ($s as $p) {
            $m[] = $p['id'];
        }
        //    $pp = UserBookingDetail::where('sport',$ser_id)->whereIn('booking_id',$m)->count();
        // foreach($data as $value){
        $ser = UserService::where('id', $request->service_id)->first();
        $nn = json_decode($ser->numberofpeople, true);
        $people = $nn[0];
        $booking = UserBookingStatus::where('business_id', $request->userid)->where('service_id', $ser->id)->where('status', 'confirmed')->get();
        $pp = 0;
        foreach ($booking as $value2) {
            $det = UserBookingDetail::where('booking_id', $value2['id'])->first();
            $d = json_decode($det->booking_detail, true);
            $pp = $pp + $d['numberofpersons'];
        }
        //$value['available_seats'] = $people-$pp;
        //  }

        return response()->json(['status' => true, 'price' => $UserService[0]['price'], 'available' => $people - $pp, 'option' => $data, 'location' => $locations, "duestaxpercentage" => $duestaxpercentage, "salestaxpercentage" => $salestaxpercentage]);
    }

    public function cart($data) {
        return (Fit_Cart::create($data)) ? true : false;
    }

    public function getcart(Request $request) {

      //$cartitems = Fit_Cart::where('user_id',getLoggedInUserId())->where('booking_id',$request->booking_id)->get();
        $cartitems = Fit_Cart::where('user_id', getLoggedInUserId())->get();
        if (count($cartitems) != 0) {
            foreach ($cartitems as $item) {
                $sport = Sports::where('id', $item['service_choice'])->get();
                $item['sport'] = $sport[0]->sport_name;
                $items[] = $item;
            }
        } else {
            $items = [];
        }

        return view('jobpost.cart', compact('items'));
    }

    public function deletecart($id, $bid) {
        $delete = Fit_Cart::where(['user_id' => getLoggedInUserId(), 'id' => $id])->delete();
        UserBookingDetail::where(['booking_id' => $bid])->delete();
        UserBookingStatus::where(['id' => $bid])->delete();
        if ($delete) {
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function addnote($b, $n) {

        UserBookingDetail::where(['booking_id' => $b])->update(['note' => $n]);
        return response()->json(['status' => 1]);
    }

    public function pay(Request $request) {
        $items = Fit_Cart::where('user_id', getLoggedInUserId())->count();
        if ($items == 0) {

            return response()->json(['status' => 0, "msg" => "Not able to go Next Please add Booking in cart"]);
        }
        $user = User::where('id', $request->user_id)->first();
        $user_service = UserService::where('id', $request->service_id)->first();
        if ($user_service->terms_conditions != 'undefined')
            $terms_conditions = $user_service->terms_conditions;
        else
            $terms_conditions = "";
        $name = $user->firstname . ' ' . $user->lastname;
        return view('pay', compact('name', 'terms_conditions'));
    }

    public function editcart($bkid, $cid, $user_id) {
        $sports = $this->sports->getAlphabetsWiseSportsNames();
        $sports_names = $this->sports->getAllSportsNames();
        $sports_child_parent = $this->sports->getSportsChildParentWise();
        $UserProfileDetail = $this->users->getUserProfileDetail($user_id, array('professional_detail'));
        $userSpotPrice = $userSport = array();
        $family = UserFamilyDetail::where('user_id', Auth::user()->id)->get();
        if (count($UserProfileDetail['service']) > 0) {
            foreach ($UserProfileDetail['service'] as $service) {

                if (@$sports_child_parent[$service['sport']] > 0) {
                    if (isset($sports_names[$service['sport']])) {
                        $userSport[@$sports_names[@$sports_child_parent[$service['sport']]]]['child'][$service['sport']] = @$sports_names[$service['sport']];
                        $userSpotPrice[$service['sport']] = $service['price'];
                    }
                } else {
                    if (isset($sports_names[$service['sport']])) {
                        $userSport[@$sports_names[$service['sport']]]['self'][$service['sport']] = @$sports_names[$service['sport']];
                        $userSpotPrice[$service['sport']] = $service['price'];
                    }
                }
            }
        }

        $businessType = Miscellaneous::businessType();
        $cartitems = Fit_Cart::where('id', $cid)->get();
        $UserService = UserService::where(['user_id' => $user_id, 'sport' => @$cartitems[0]['service_choice']])->get();
        $s = json_decode(@$UserService[0]['activitytype']);
        $location = json_decode(@$UserService[0]['servicelocation']);
        $note = UserBookingDetail::where(['booking_id' => $bkid])->get();
        return view('jobpost.edit', [
            'UserProfileDetail' => $UserProfileDetail,
            'userSport' => $userSport,
            'userSpotPrice' => $userSpotPrice,
            'sports' => $sports,
            'sports_names' => $sports_names,
            'user_id' => $user_id,
            'businessType' => $businessType,
            'bookid' => $bkid,
            'cid' => $cid,
            'user_id' => $user_id,
            'cartinfo' => $cartitems,
            'note' => $note,
            'location' => $location,
            'time' => @$UserService[0]['serv_time_slot'],
            'family' => $family,
        ]);
    }

    public function updatecart(Request $r) {

        $cart = array(
            'price' => str_replace('$', '', $r->price),
            'numberofpersons' => $r->numberofpersons,
            'service_choice' => $r->selectcatagory,
            'salestaxpercentage' => $r->salestaxpercentage,
            'duestaxpercentage' => $r->duestaxpercentage
        );
        $bookstatus = array(
            'sport' => $r->selectcatagory,
            'booking_detail' => json_encode(array('activitytype' => $r->activitytype,
                'numberofpersons' => $r->numberofpersons,
                'activitylocation' => $r->activitylocation,
                'whoistraining' => $r->whoistraining,
                'username', $r->username,
                'lastname', $r->username,
                'phone', $r->username,
                'email' => $r->email)),
            'schedule' => json_encode($r->hours),
            'price' => $r->price,
            'note' => $r->comment,
            'schedule' => json_encode($r->hours),
        );
        $details = UserBookingDetail::where(['booking_id' => $r->bookid])->update($bookstatus);
        $cartitems = Fit_Cart::where('id', $r->cid)->update($cart);
        if ($details && $cartitems) {

            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0]);
        }
    }

    public function cartpayment(Request $request) {
        return view('jobpost.cart-payment');
    }

    public function confirmpayment(Request $request) {
        return view('jobpost.confirm-payment');
    }
    
    public function cartpaymentinstant(Request $request) {
        $cart = [];
         $cardInfo = [];
        if(Auth::user()){
             $user = User::where('id', Auth::user()->id)->first();
             \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $savedEvents = $stripe->customers->allSources(
                $user->stripe_customer_id,
                ['object' => 'card' ,'limit' => 30]
            );

        $savedEvents  = json_decode( json_encode( $savedEvents),true);
            
       $cardInfo = $savedEvents['data'];
           /* $savedEvents = DB::select('select * from users_payment_info where user_id = ?', [Auth::user()->id]);
            if (count($savedEvents) > 0) {
                foreach ($savedEvents as $event) {
                    $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
                    $carddetails = $stripe->customers->retrieveSource(
                        $user->stripe_customer_id,
                        $event->card_stripe_id,
                        []
                    );
                    $cardInfo[] = $carddetails;
                }
            }*/
        }else{
            $cardInfo = [];
        }
       
        $cart = $request->session()->get('cart_item') ? $request->session()->get('cart_item') : [];
        return view('jobpost.cart-payment-instant',[
                'cart' => $cart,
                'cardInfo' => $cardInfo,
        ]);
    }

    public function payment($token) {
        $payment = new StripePay;
        $paydata['email'] = Auth::user()->email;
        $paydata['amount'] = '';
        $paydata['token'] = $token;
        $paydata['currency_code'] = 'USD';
        $items = Fit_Cart::where('user_id', getLoggedInUserId())->get();
        $description = '';
        $amount = 0;
        foreach ($items as $item) {
            $times = json_decode($item->time['schedule'], true);
            $bookdays = count($times);
            $sport = Sports::where('id', $item['service_choice'])->get();
            $description .= $sport[0]->sport_name . ', ';
            $id[] = $item['booking_id'];
            $nameofitems[] = array('bookid' => $item['booking_id'], 'number of persons' => $item['numberofpersons'], 'sport name' => $sport[0]->sport_name);
            $booking_id = $item['booking_id'];
            $amount += ($item['price'] * $item['numberofpersons'] * $bookdays) + (($item['price'] * $item['numberofpersons'] * $bookdays) * ($item['duestaxpercentage'] + $item['salestaxpercentage']) / 100);
        }
        $name = UserBookingStatus::where('id', $booking_id)->get();
        $username = User::where('id', $name[0]->business_id)->get();

        $paydata['amount'] = $amount;
        $paydata['item_name'] = rtrim($description, ", ");
        $paydata['nameofitems'] = json_encode($nameofitems);
        $stripeResponse = $payment->chargeAmountFromCard($paydata);
        $amount = $stripeResponse["amount"] / 100;

        $param_type = 'ssdssss';
        $param_value_array = array(
            $amount,
            $stripeResponse["currency"],
            $stripeResponse["balance_transaction"],
            $stripeResponse["status"],
            json_encode($stripeResponse)
        );
        $paymentdata = array(
            'email' => Auth::user()->email,
            'item_number' => $paydata['nameofitems'],
            'amount' => $amount,
            'currency_code' => $stripeResponse["currency"],
            'txn_id' => $stripeResponse["balance_transaction"],
            'payment_status' => $stripeResponse["status"],
            'payment_response' => json_encode($stripeResponse)
        );
        $status = Payment::create($paymentdata);

        if ($status && ($stripeResponse["status"] == 'succeeded')) {

            $username = $username[0]->firstname . ' ' . $username[0]->lastname;
            UserBookingStatus::whereIn('id', $id)->update(['status' => 'confirmed']);
            $items = Fit_Cart::where('user_id', getLoggedInUserId())->delete();

            foreach ($id as $i) {
                // MailService::sendEmailBooking($i);
                $BookingDetail = $this->bookings->getBookingDetail($i);
                MailService::sendEmailBookingConfirm($BookingDetail);
            }
            return response()->json(['status' => true, 'msg' => 'succeeded', 'name' => $username]);
        } else {
            return response()->json(['status' => false, 'msg' => $stripeResponse["status"], 'msg2' => 'Your Payment is failed']);
        }
    }
    
    public function service_fav(Request $request) {


        $ser_id = $request->ser_id;
        $loggedId = Auth::user()->id;
        $status='';
        $favData = BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$ser_id)->first();
        if(!empty($favData)){
            BusinessServicesFavorite::find($favData->id)->delete();
            $status='unlike';
        }
        else
        {
            $data=array(
                "user_id" => Auth::user()->id,
                "service_id" => $ser_id,
            );
            BusinessServicesFavorite::create($data);
            $status='like';
        }
        return response()->json(array("success"=>'success','status'=>$status));
        
        
    }
    public function save_business_service_reviews(Request $request)
    {
        $sid = $request->sid;
        $rating = $request->rating;
        $review = $request->review;
        $title = $request->rtitle;
        
        $ip=$request->ip();
        $loggedId = Auth::user()->id;
        
        if($sid!='' && $rating!='' && $review !='')
        { 
            $chk=BusinessServiceReview::where('user_id',Auth::user()->id)->where('service_id',$sid)->first();
            if(empty($chk))
            {
                $images=array(); $imgpost='';
                if($request->TotalFiles > 0)
                {
                    for ($x = 0; $x < $request->TotalFiles; $x++) 
                    {
                        if ($request->hasFile('rimg'.$x)) 
                        {
                            $file = $request->file('rimg'.$x);
                            $name = date('His').$file->getClientOriginalName();
                            $file->move(public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'review'.DIRECTORY_SEPARATOR,$name);
                            if( !empty($name) ){
                                $images[]=$name;
                            }
                        }
                    }
                    $imgpost = implode("|",$images);
                }
                
                
                $data=array(
                    "rating"=>$rating,
                    "title"=>$title,
                    "review"=>$review,
                    "images"=>$imgpost,
                    "user_id" => Auth::user()->id,
                    "service_id" => $sid,
                    "ip" => $ip,
                );
                BusinessServiceReview::create($data);
                echo 'submitted';
                exit;
            }
            else
            {
                echo 'already';
                exit;
            }
        }
        else
        {
            echo 'addreview';
            exit;
        }
    }
    public function viewActreview(Request $request) {
        $aid = $request->aid;
        $data='';
        $reviews_count = BusinessServiceReview::where('service_id', $aid)->count();
        $reviews_sum = BusinessServiceReview::where('service_id', $aid)->sum('rating');
        $reviews_avg=0;
        if($reviews_count>0)
        { $reviews_avg = round($reviews_sum/$reviews_count,2); }
        $reviews = BusinessServiceReview::where('service_id', $aid)->get();
        $reviews_people = BusinessServiceReview::where('service_id',$aid)->orderBy('id','desc')->limit(6)->get(); 
        
        $data .='<div class="row">
                    <div class="col-md-8"> 
                        <h3 class="subtitle"> 
                            <div class="row">
                                <div class="col-md-3"> Reviews: </div>
                                <div class="col-md-9">
                                    <p> <a class="activered font-bold"> By Everyone  </a>
                                        <a class="font-bold"> | By People I know </a>
                                    </p>
                                </div>
                            </div>
                        </h3>
                        <div class="service-review-desc">
                            <p> '.$reviews_count.' Reviews </p> 
                            <div class="rattxt activered"><i class="fa fa-star" aria-hidden="true"></i> '.$reviews_avg.' </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                            <div class="rev-follow">
                                <a class="rev-follow-txt">'.$reviews_count.' People Reviewed This</a>
                                <div class="users-thumb-list">';
                                if(!empty($reviews_people)){
                                    foreach($reviews_people as $people){
                                        $userinfo = User::find($people->user_id);
                                        $data .='<a href="'.config('app.url').'/userprofile/'.@$userinfo->username.'" target="_blank" title="'.$userinfo->firstname.' '.$userinfo->lastname.'" data-toggle="tooltip">';
                                        
                                        if(File::exists(public_path("/uploads/profile_pic/thumb/".$userinfo->profile_pic)))
                                        {
                                            $data .='<img src="/public/uploads/profile_pic/thumb/'.$userinfo->profile_pic.'" alt="'.$userinfo->firstname.''.$userinfo->lastname.'">';
                                        }
                                        else
                                        {
                                            $pf=substr($userinfo->firstname, 0, 1).substr($userinfo->lastname, 0, 1);
                                            $data .='<div class="admin-img-text"><p>'.$pf.'</p></div>';
                                        }
                                        $data .='</a>';
                                    }
                                }
                                $data .='</div>
                            </div>
                    </div>'; 
                    
                    
                    $data .='<div class="col-md-12"> 
                        <div class="ser-review-list" id="user_ratings_div">';
                        if(!empty($reviews)) {
                            foreach($reviews as $review) {
                                 $userinfo = User::find($review->user_id);
                                 if($userinfo->profile_pic!='')
                                 {
                                     $pic="/public/uploads/profile_pic/thumb/".$userinfo->profile_pic;
                                 }
                                 
                                 $data .='<div class="ser-rev-user">
                                            <div class="row">
                                                <div class="col-md-2">';
                                                if(File::exists(public_path("/uploads/profile_pic/thumb/".$userinfo->profile_pic)))
                                                {
                                                    $data .='<img class="rev-img" src="'.$pic.'" 
                                                    alt="'.$userinfo->firstname.' '.$userinfo->lastname.'">';
                                                }
                                                else
                                                {
                                                    $pf=substr($userinfo->firstname, 0, 1).substr($userinfo->lastname, 0, 1);
                                                    $data .='<div class="reviewlist-img-text"><p>'.$pf.'</p></div>';
                                                }
                                                $data .='</div>
                                                        <div class="col-md-10">
                                                            <h4>'.$userinfo->firstname.' '.$userinfo->lastname.'
                                                            <div class="rattxt activered"><i class="fa fa-star" aria-hidden="true"></i> '.$review->rating.' </div> </h4> 
                                                            <p class="rev-time">'.date('d M-Y',strtotime($review->created_at)).'</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="rev-dt">
                                                    <p class="mb-15">'.$review->title.'</p>
                                                    <p>'.$review->review.'</p>';
                                                    if( !empty($review->images) ){
                                                        $rimg=explode('|',$review->images);
                                                        $data .='<div class="listrimage">';
                                                        foreach($rimg as $img)
                                                        {
                                                            $dimg=url('/public/uploads/review/'.$img);
                                                            $data .='<a data-fancybox="group" data-caption="'.$review->title.'"
                                                            href="'.$dimg.'" >
                                                            <img src="/public/uploads/review/'.$img.'" alt="Fitnessity" />
                                                            </a>';
                                               
                                                        }
                                                        $data .='</div>';
                                                    }
                                                $data .='</div>';
                            }
                        }
                        $data .='</div>
                    </div>
                </div>'; 
        
        echo $data;
        exit;
    }
    public function submitreview(){
        return view('jobpost.submit_review');
    }

    /*public function act_detail_filter(Request $request){
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
        
        //DB::enableQueryLog();
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
        if( !empty($actfilparticipant) )
        {
            $searchData->join('business_activity_scheduler', 'business_services.id', '=', 'business_activity_scheduler.serviceid')->
            select('business_services.*','business_activity_scheduler.spots_available')->
            Where('business_activity_scheduler.spots_available', '>=', $actfilparticipant)->distinct()->groupBy('business_services.id');
           
            //$searchData->Where('group_size', $actfilparticipant);
            //$searchData->Where('business_services.group_size', '>=', $actfilparticipant);

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
            
            $enddt = date('Y-m-d', strtotime("+1 year", strtotime($actdate)) );
            
            //Where('business_activity_scheduler.starting', $dt);
            $searchData->join('business_activity_scheduler', 'business_services.id', '=', 'business_activity_scheduler.serviceid')->select('business_services.*','business_activity_scheduler.starting')->Where('business_activity_scheduler.starting', '<=', $enddt)->distinct();
        }
        if( !empty($actfilsType) )
        {
            $searchData->whereRaw('FIND_IN_SET("'.$actfilsType.'",select_service_type)');
        }
        //DB::enableQueryLog();
        $activity1 = $searchData->distinct()->get()->toArray();
        //dd(\DB::getQueryLog());
        
        $activity = json_decode(json_encode($activity1), true);
        $actbox='';
        //dd(\DB::getQueryLog());
        
        if (!empty($activity)) { 
            foreach ($activity as  $act) {
                //echo $act['id'].'--'.$act['program_name'].'<br>';
                //DB::enableQueryLog();
                $servicePrice = BusinessPriceDetails::where('serviceid', $act['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
                //dd(\DB::getQueryLog());
                //print_r($servicePrice);
                $pay_session1=''; $pay_price1=''; $pay_id1='';
                if( !empty($servicePrice) )
                {
                    if(@$servicePrice[0]['pay_session']!=''){
                        $pay_session1 = @$servicePrice[0]['pay_session'];
                    }
                    if(@$servicePrice[0]['adult_cus_weekly_price']!=''){
                        $pay_price1 = @$servicePrice[0]['adult_cus_weekly_price'];
                    }
                    if(@$servicePrice[0]['id']!=''){
                        $pay_id1 = @$servicePrice[0]['id'];
                    }
                }
                $reviews_count = BusinessServiceReview::where('service_id', $act['id'])->count();
                $reviews_sum = BusinessServiceReview::where('service_id', $act['id'])->sum('rating');
                $reviews_avg=0;
                if($reviews_count>0)
                { $reviews_avg = round($reviews_sum/$reviews_count,2); }
                
                
                $servicePrfirst = BusinessPriceDetails::where('serviceid', $act['id'])->orderBy('id', 'ASC')->first();
                $sercate = BusinessPriceDetailsAges::where('serviceid', $act['id'])->orderBy('id', 'ASC')->get()->toArray();
                $sercatefirst = BusinessPriceDetailsAges::where('serviceid', $act['id'])->orderBy('id', 'ASC')->get()->first();
                $servicePr = BusinessPriceDetails::where('serviceid', $act['id'])->orderBy('id', 'ASC')->where('category_id',$sercatefirst['id'])->get()->toArray();
                $todayday = date("l");
                if( !empty( $actdate) ){
                    $todaydate =  date('m/d/Y',strtotime($actdate));
                }else{
                    $todaydate = date('m/d/Y');
                }
                $bus_schedule = BusinessActivityScheduler::where('category_id',$sercatefirst['id'])->whereRaw('FIND_IN_SET("'.$todayday.'",activity_days)')->where('starting','<=',$todaydate )->get();
                $start =$end= $time= '';$timedata = '';$Totalspot= $spot_avil = 0;  $SpotsLeft =0;
                if(!empty($bus_schedule)){
                    foreach($bus_schedule as $data){
                        if($data['scheduled_day_or_week'] == 'Days'){
                            $daynum = '+'.$data['scheduled_day_or_week_num'].' days';
                            $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
                        }else if($data['scheduled_day_or_week'] == 'Months'){
                            $daynum = '+'.$data['scheduled_day_or_week_num'].' month';
                            $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
                        }else if($data['scheduled_day_or_week'] == 'Years'){
                            $daynum = '+'.$data['scheduled_day_or_week_num'].' years';
                            $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
                        }else{
                            $daynum = '+'.$data['scheduled_day_or_week_num'].' week';
                            $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
                        }  
                        
                        if($todaydate <=$expdate){
                            if(@$data['shift_start']!=''){
                                $start = date('h:i a', strtotime( $data['shift_start'] ));
                                $timedata .= $start;
                            }
                            if(@$data['shift_end']!=''){
                                $end = date('h:i a', strtotime( $data['shift_end'] ));
                                 $timedata .= ' - '.$end;
                            } 
                            if(@$data['set_duration']!=''){
                                $tm=explode(' ',$data['set_duration']);
                                $hr=''; $min=''; $sec='';
                                if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
                                if($tm[2]!=0){ $min=$tm[2].'min. '; }
                                if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
                                if($hr!='' || $min!='' || $sec!='')
                                { $time = $hr.$min.$sec; 
                                    $timedata .= ' / '.$time;} 
                            }
                        }

                        $today = date('Y-m-d');
                        if( !empty( $actdate) ){ $today = date('Y-m-d', strtotime($actdate)); }
                        $SpotsLeft = UserBookingDetail::where('sport', @$service['id'] )->whereDate('created_at', '=', $today)->sum('qty');
                        $SpotsLeftdis=0;
                        if( !empty($data['spots_available']) ){
                            $spot_avil=$data['spots_available'];
                            $SpotsLeftdis = $data['spots_available']-$SpotsLeft;
                            $Totalspot = $SpotsLeftdis.'/'.@$data['spots_available'];
                        }
                    }
                }
                                    
                if(date('l') == 'Saturday' || date('l') == 'Sunday'){
                    $total_price_val =  $servicePrfirst['adult_weekend_price_diff'];
                    $selectval = '';$priceid = '';$i=1;
                    foreach ($servicePr as  $pr) {
                        if($i==1){ 
                            $priceid =$pr['id'];
                            $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_weekend_price_diff'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Select Price Option</option>'; }
                        if($pr['adult_weekend_price_diff'] != ''){
                            $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_weekend_price_diff'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Adult - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['adult_weekend_price_diff'].'</option>';}
                        if($pr['child_cus_weekly_price'] != ''){
                            $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['child_weekend_price_diff'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Child - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['child_weekend_price_diff'].'</option>';
                        }
                        if($pr['infant_cus_weekly_price'] != ''){
                            $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['infant_weekend_price_diff'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Infant - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['infant_weekend_price_diff'].'</option>';
                        }$i++;
                    }
                }else{
                    $total_price_val =  $servicePrfirst['adult_cus_weekly_price'];
                    $selectval = '';$priceid = '';$i=1;
                    foreach ($servicePr as  $pr) {
                        if($i==1){ 
                            $priceid =$pr['id'];
                            $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_cus_weekly_price'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Select Price Option</option>'; }
                        if($pr['adult_cus_weekly_price'] != ''){
                            $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_cus_weekly_price'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Adult - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['adult_cus_weekly_price'].'</option>';}
                        if($pr['child_cus_weekly_price'] != ''){
                            $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['child_cus_weekly_price'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Child - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['child_cus_weekly_price'].'</option>';
                        }
                        if($pr['infant_cus_weekly_price'] != ''){
                            $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['infant_cus_weekly_price'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Infant - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['infant_cus_weekly_price'].'</option>';
                        }$i++;
                    }
                }

                $stype='';
                if($act['service_type']=='individual'){ $stype = 'Personal Training'; }
                else { $stype = @$act['service_type']; }
                $qty=1;
                if( !empty($actfilparticipant) )
                {
                    $qty=$actfilparticipant;
                    $pay_price1 = (float)$pay_price1*(int)$qty;
                }

                $fun_para="'".$act['id']."',this.value,'".$qty."','bookajax','".$serviceid."'";
                $cng_sess="'".$serviceid."','".$act['id']."',this.value,'bookajax'";
                $bookscheduler = BusinessActivityScheduler::where('serviceid', $act['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
                $ser_mem = BusinessPriceDetails::where('serviceid', $act['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
                if( !empty( $actdate) ){
                    $p=$act['schedule_until'];
                    $enddt = date('Y-m-d', strtotime("+".$p, strtotime($act['starting'])) );
                    $flterdt = date('Y-m-d',strtotime($actdate) );
                    if( $flterdt <= $enddt ){
                        $actbox .= '<div class="kickshow-block">
                                    <div class="topkick" id="kickboxing'.$serviceid.$act['id'].'">
                                        <h5>'. @$act['program_name'].'
                                        <p>'.$reviews_count.' Reviews <span> <i class="fa fa-star" aria-hidden="true"></i>
                                           '.$reviews_avg.'</span></p>
                                        </h5>
                                        <div class="lefthalf">
                                            <div class="divdesc">
                                                <p class="actsubtitle"> Details: </p>
                                                <ul>
                                                    <li>'; 
                                                        if(@$bookscheduler[0]['starting']!=''){
                                                            //$actbox .= date('l jS \of F Y',strtotime($bookscheduler[0]['starting'])); 
                                                            $actbox .= date('l, F jS,  Y', strtotime($actdate) );
                                                        } 
                                                        
                                                    $actbox .= '</li>
                                                    
                                                    <li>Service Type: '.@$act['select_service_type'].'</li>
                                                    <li>Activity: '.@$act['sport_activity'].'</li>
                                                    <li>Activity Location: '.@$act['activity_location'].'</li>
                                                    <li>Great For: '.@$act['activity_for'].'</li>
                                                    <li>Age: '.@$act['age_range'].'</li>
                                                    <li>Language: '.@$languages.'</li>
                                                    <li>Skill Level: '.@$act['difficult_level'].'</li>';
                                                    if(@$ser_mem[0]['membership_type']!=''){
                                                        $actbox .= '<li>Membership Type : '.@$ser_mem[0]['membership_type'].'</li>';
                                                    }
                                                    $actbox .= '<li>Business Type: '.$stype.'</li>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="righthalf">
                                            <select id="selcatpr'.$act['id'].'" name="selcatpr'.$act['id'].'" class="price-select-control" onchange="changeactsession('.$cng_sess.')">';
                                            if (!empty($sercate)) {$c=1;   
                                                foreach ($sercate as  $sc) {
                                                    $actbox .= '<option value="'.$sc['id'].'">'.$sc['category_title'].'</option>';
                                                    $c++;
                                                }
                                            }
                                            $actbox .= '</select>
                                            <div id="pricechng'.@$serviceid.@$act["id"].'">
                                                <select id="selprice'.$act['id'].'" name="selprice'.$act['id'].'" class="price-select-control" onchange="changeactpr('.$fun_para.')">'.$selectval.'</select>
                                            </div>
                                            <label>Booking Details: </label>
                                            <div id="bookajax'.@$serviceid.@$act["id"].'">';
                                                if(@$sercatefirst['category_title'] != ''){
                                                    $actbox .= '<p>Category: '.@$sercatefirst['category_title'].'</p>';
                                                }
                                                $actbox .= '<p>'.$timedata.'</p>
                                                <p>Spots Left: '.$Totalspot.'</p><br>';
                                                if(@$servicePrfirst['price_title'] != ''){
                                                    $actbox .= '<p>Price Title:  '.@$servicePrfirst['price_title'].'</p>';
                                                }
                                                if($timedata == 0){
                                                    $timedata = '';
                                                }
                                                $actbox .= '<p>Price Option: '.$servicePrfirst['pay_session'] .' Session</p>
                                                <p>Participants: '.$qty.'</p>
                                                <p>Total: $'. $total_price_val.'/person</p>
                                            </div>
                                            <input type="hidden" name="price_title_hidden" id="price_title_hidden'.$serviceid.$act['id'].'" value="'.@$servicePrfirst['price_title'].'">

                                            <input type="hidden" name="time_hidden" id="time_hidden'.$serviceid.$act['id'].'" value="'.$timedata.'">

                                            <input type="hidden" name="sportsleft_hidden" id="sportsleft_hidden'.$Totalspot.'">

                                            <form method="post" action="/addtocart">
                                                <input name="_token" type="hidden" value="'.csrf_token().'">
                                                <input type="hidden" name="pid" value="'.@$act["id"].'" size="2" />
                                                <input type="hidden" name="quantity" id="pricequantity'.$serviceid.$act["id"].'" value="'.$qty.'" class="product-quantity" />
                                                <input type="hidden" name="price" id="pricebookajax'.$serviceid.$act['id'].'" value="'.$pay_price1.'" class="product-price" />
                                                <input type="hidden" name="session" id="session'.$serviceid.$act["id"].'" value="'.$pay_session1.'" />
                                                <input type="hidden" name="priceid" value="'.$pay_id1.'" id="priceid'.$serviceid.$act["id"].'" />
                                                <input type="hidden" name="sesdate" value="'.date('Y-m-d', strtotime($actdate) ).'" id="sesdate'.$serviceid.$act["id"].'" />
                                                <input type="hidden" name="cate_title" value="'.@$sercatefirst['category_title'].'" id="cate_title'.$serviceid.''.$act['id'].'" />';
                                                if($SpotsLeft >= $spot_avil)
                                                {
                                                    $actbox .= '<a href="javascript:void(0)" class="btn btn-addtocart mt-10" style="pointer-events: none;">Sold Out</a>';
                                                }
                                                else
                                                {
                                                    if($pay_price1!='' && $timedata!=''){
                                                        $actbox .= '<input type="submit" value="Add to Cart" onclick="changeqnt('.$act["id"].')" class="btn btn-addtocart mt-10" />';
                                                    }
                                                }
                                            $actbox .= '</form>
                                        </div>
                                    </div>
                                    <div class="bottomkick">
                                        <div class="viewmore_links">
                                            <a id="viewmore'.$serviceid.$act['id'].'" style="display:block">View More <img src="public/img/arrow-down.png" alt=""></a>
                                            <a id="viewless'.$serviceid.$act['id'].'" style="display:none">View Less <img src="public/img/arrow-down.png" alt=""></a>
                                        </div>
                                    </div>
                                </div>';
                                $actbox .='<script>
                                $("#viewmore'.$serviceid.$act['id'].'").click(function () {
                                    $("#kickboxing'.$serviceid.$act['id'].'").addClass("intro");
                                    $("#viewless'.$serviceid.$act['id'].'").show();
                                    $("#viewmore'.$serviceid.$act['id'].'").hide();
                                });
                                $("#viewless'.$serviceid.$act['id'].'").click(function () {
                                    $("#kickboxing'.$serviceid.$act['id'].'").removeClass("intro");
                                    $("#viewless'.$serviceid.$act['id'].'").hide();
                                    $("#viewmore'.$serviceid.$act['id'].'").show();
                                });
                                </script>';
                    }
                }else{
                    $actbox .= '<div class="kickshow-block">
                                <div class="topkick" id="kickboxing'.$serviceid.$act['id'].'">
                                    <h5>'. @$act['program_name'].'
                                    <p>'.$reviews_count.' Reviews <span> <i class="fa fa-star" aria-hidden="true"></i>
                                       '.$reviews_avg.'</span></p>
                                    </h5>
                                    <div class="lefthalf">
                                        <div class="divdesc">
                                            <p class="actsubtitle"> Details: </p>
                                            <ul>
                                                <li>'; 
                                                    if(@$bookscheduler[0]['starting']!=''){
                                                        //$actbox .= date('l jS \of F Y',strtotime($bookscheduler[0]['starting'])); 
                                                        $actbox .= date('l, F jS,  Y' );
                                                    } 
                                                
                                                $actbox .= '</li>
                                            
                                                <li>Service Type: '.@$act['select_service_type'].'</li>
                                                <li>Activity: '.@$act['sport_activity'].'</li>
                                                <li>Activity Location: '.@$act['activity_location'].'</li>
                                                <li>Great For: '.@$act['activity_for'].'</li>
                                                <li>Age: '.@$act['age_range'].'</li>
                                                <li>Language: '.@$languages.'</li>
                                                <li>Skill Level: '.@$act['difficult_level'].'</li>';
                                                if(@$ser_mem[0]['membership_type']!=''){
                                                    $actbox .= '<li>Membership Type: '.@$ser_mem[0]['membership_type'].'</li>';
                                                }
                                                $actbox .= '<li>Business Type: '.$stype.'</li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="righthalf">
                                        <select id="selcatpr'.$act['id'].'" name="selcatpr'.$act['id'].'" class="price-select-control" onchange="changeactsession('.$cng_sess.')">';
                                            if (!empty($sercate)) {$c=1;   
                                                foreach ($sercate as  $sc) {
                                                   
                                                    $actbox .= '<option value="'.$sc['id'].'">'.$sc['category_title'].'</option>';
                                                    $c++;
                                                }
                                            }
                                            $actbox .= '</select>
                                            <div id="pricechng'.@$serviceid.@$act["id"].'">
                                               <select id="selprice'.$act['id'].'" name="selprice'.$act['id'].'" class="price-select-control" onchange="changeactpr('.$fun_para.')"> '.$selectval.'</select>
                                        </div>
                                        <label>Booking Details: </label>
                                        <div id="bookajax'.@$serviceid.@$act["id"].'">';
                                            $start = $end =$time ='';
                                            if(@$sercatefirst['category_title'] != ''){
                                                $actbox .= '<p>Category: '.@$sercatefirst['category_title'].'</p>';
                                            }
                                            
                                            $actbox .= '<p>'.$timedata.'</p>
                                            <p>Spots Left: '.$Totalspot.'</p><br>';
                                            if(@$servicePrfirst['price_title'] != ''){
                                                $actbox .= '<p>Price Title:  '.@$servicePrfirst['price_title'].'</p>';
                                            }
                                            if($timedata == 0){
                                                $timedata = '';
                                            }
                                            $actbox .= '<p>Price Option: '.$servicePrfirst['pay_session'] .' Session</p>
                                            <p>Participants: '.$qty.'</p>
                                            <p>Total: $'. $total_price_val.'/person</p>
                                        </div>
                                        <input type="hidden" name="price_title_hidden" id="price_title_hidden'.$serviceid.$act['id'].'" value="'.@$servicePrfirst['price_title'].'">

                                        <input type="hidden" name="time_hidden" id="time_hidden'.$serviceid.$act['id'].'" value="'.$timedata.'" >

                                        <input type="hidden" name="sportsleft_hidden" id="sportsleft_hidden'.$serviceid.$act['id'].'" value="'.$Totalspot.'">

                                        <form method="post" action="/addtocart">
                                            <input name="_token" type="hidden" value="'.csrf_token().'">
                                            <input type="hidden" name="pid" value="'.@$act["id"].'" />
                                            <input type="hidden" name="quantity" id="pricequantity'.$serviceid.$act["id"].'" value="'.$qty.'" class="product-quantity"  />
                                            <input type="hidden" name="price" id="pricebookajax'.$serviceid.$act['id'].'" value="'.$pay_price1.'" class="product-price" />
                                            <input type="hidden" name="session" id="session'.$serviceid.$act["id"].'" value="'.$pay_session1.'" />
                                            <input type="hidden" name="priceid" value="'.$pay_id1.'" id="priceid'.$serviceid.$act["id"].'"  />
                                            <input type="hidden" name="sesdate" value="'.date('Y-m-d').'" id="sesdate'.$serviceid.$act["id"].'" />
                                            <input type="hidden" name="cate_title" value="'.@$sercatefirst['category_title'].'" id="cate_title'.$serviceid.''.$act['id'].'" />';
                                            if($SpotsLeft >= $spot_avil)
                                            {
                                                $actbox .= '<a href="javascript:void(0)" class="btn btn-addtocart mt-10" style="pointer-events: none;">Sold Out</a>';
                                            }
                                            else
                                            {
                                                if($pay_price1!='' && $timedata!=''){
                                                    $actbox .= '<input type="submit" value="Add to Cart" onclick="changeqnt('.$act["id"].')" class="btn btn-addtocart mt-10" />';
                                                }
                                            }
                                        $actbox .= '</form>
                                    </div>
                                </div>
                                <div class="bottomkick">
                                    <div class="viewmore_links">
                                        <a id="viewmore'.$serviceid.$act['id'].'" style="display:block">View More <img src="public/img/arrow-down.png" alt=""></a>
                                        <a id="viewless'.$serviceid.$act['id'].'" style="display:none">View Less <img src="public/img/arrow-down.png" alt=""></a>
                                    </div>
                                </div>
                            </div>';
                            $actbox .='<script>
                            $("#viewmore'.$serviceid.$act['id'].'").click(function () {
                                $("#kickboxing'.$serviceid.$act['id'].'").addClass("intro");
                                $("#viewless'.$serviceid.$act['id'].'").show();
                                $("#viewmore'.$serviceid.$act['id'].'").hide();
                            });
                            $("#viewless'.$serviceid.$act['id'].'").click(function () {
                                $("#kickboxing'.$serviceid.$act['id'].'").removeClass("intro");
                                $("#viewless'.$serviceid.$act['id'].'").hide();
                                $("#viewmore'.$serviceid.$act['id'].'").show();
                            });
                            </script>';
                }
            }
        }
        $stactivity = BusinessServices::where('id', $serviceid)->where('is_active', 1)->get()->toArray();
        $stactbox ='';
        if (!empty($stactivity)) { 
            foreach ($stactivity as $stact) {
                //echo $act['id'].'--'.$act['program_name'].'<br>';
                //DB::enableQueryLog();
                $servicePrice = BusinessPriceDetails::where('serviceid', $stact['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
                $pay_session1=''; $pay_price1=''; $pay_id1='';
                if( !empty($servicePrice) )
                {
                    if(@$servicePrice[0]['pay_session']!=''){
                        $pay_session1 = @$servicePrice[0]['pay_session'];
                    }
                    if(@$servicePrice[0]['adult_cus_weekly_price']!=''){
                        $pay_price1 = @$servicePrice[0]['adult_cus_weekly_price'];
                    }
                    if(@$servicePrice[0]['id']!=''){
                        $pay_id1 = @$servicePrice[0]['id'];
                    }
                }
                $reviews_count = BusinessServiceReview::where('service_id', $stact['id'])->count();
                $reviews_sum = BusinessServiceReview::where('service_id', $stact['id'])->sum('rating');
                $reviews_avg=0;
                if($reviews_count>0)
                { $reviews_avg = round($reviews_sum/$reviews_count,2); }
                
                //$SpotsLeft = UserBookingDetail::where('sport', @$stact['id'] )->sum('qty');
                
                $bookscheduler = BusinessActivityScheduler::where('serviceid', $stact['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray(); 
                $ser_mem = BusinessPriceDetails::where('serviceid', $stact['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
                $stype='';
                if($stact['service_type']=='individual'){ $stype = 'Personal Training'; }
                else { $stype = @$stact['service_type']; }
                $qty=1;
                if( !empty($actfilparticipant) )
                {
                    $qty=$actfilparticipant;
                    $pay_price1 = $pay_price1*$qty;
                }

                
                $servicePrfirst = BusinessPriceDetails::where('serviceid', $stact['id'])->orderBy('id', 'ASC')->first();
                $sercate = BusinessPriceDetailsAges::where('serviceid', $stact['id'])->orderBy('id', 'ASC')->get()->toArray();
                $sercatefirst = BusinessPriceDetailsAges::where('serviceid', $stact['id'])->orderBy('id', 'ASC')->get()->first();
                $servicePr = BusinessPriceDetails::where('serviceid', $stact['id'])->orderBy('id', 'ASC')->where('category_id',$sercatefirst['id'])->get()->toArray();
                $todayday = date("l");
                $todaydate = date('m/d/Y');
                $bus_schedule = BusinessActivityScheduler::where('category_id',$sercatefirst['id'])->whereRaw('FIND_IN_SET("'.$todayday.'",activity_days)')->where('starting','<=',$todaydate )->get();
                $start =$end= $time= '';$timedata ='';$Totalspot= $spot_avil =0; $SpotsLeft =0;
                if(!empty($bus_schedule)){
                    foreach($bus_schedule as $data){
                        if($data['scheduled_day_or_week'] == 'Days'){
                            $daynum = '+'.$data['scheduled_day_or_week_num'].' days';
                            $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
                        }else if($data['scheduled_day_or_week'] == 'Months'){
                            $daynum = '+'.$data['scheduled_day_or_week_num'].' month';
                            $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
                        }else if($data['scheduled_day_or_week'] == 'Years'){
                            $daynum = '+'.$data['scheduled_day_or_week_num'].' years';
                            $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
                        }else{
                            $daynum = '+'.$data['scheduled_day_or_week_num'].' week';
                            $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
                        }  
                        
                        if($todaydate <=$expdate){
                            if(@$data['shift_start']!=''){
                                $start = date('h:i a', strtotime( $data['shift_start'] ));
                                $timedata .= $start;
                            }
                            if(@$data['shift_end']!=''){
                                $end = date('h:i a', strtotime( $data['shift_end'] ));
                                 $timedata .= ' - '.$end;
                            } 
                            if(@$data['set_duration']!=''){
                                $tm=explode(' ',$data['set_duration']);
                                $hr=''; $min=''; $sec='';
                                if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
                                if($tm[2]!=0){ $min=$tm[2].'min. '; }
                                if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
                                if($hr!='' || $min!='' || $sec!='')
                                { $time = $hr.$min.$sec; 
                                    $timedata .= ' / '.$time;} 
                            }
                        }

                        $today = date('Y-m-d');
                        if( !empty( $actdate) ){ $today = date('Y-m-d', strtotime($actdate)); }
                        $SpotsLeft = UserBookingDetail::where('sport', @$service['id'] )->whereDate('created_at', '=', $today)->sum('qty');
                        $SpotsLeftdis=0;
                        if(!empty($data['spots_available']) ){
                            $spot_avil=$data['spots_available'];
                            $SpotsLeftdis = $data['spots_available']-$SpotsLeft;
                            $Totalspot = $SpotsLeftdis.'/'.@$data['spots_available'];
                        }
                    }
                }

                if(date('l') == 'Saturday' || date('l') == 'Sunday'){
                    $total_price_val =  $servicePrfirst['adult_weekend_price_diff'];
                    $selectval = '';$priceid = '';$i=1;
                    foreach ($servicePr as  $pr) {
                        if($i==1){ 
                            $priceid =$pr['id'];
                            $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_weekend_price_diff'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Select Price Option</option>'; }
                        if($pr['adult_weekend_price_diff'] != ''){
                            $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_weekend_price_diff'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Adult - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['adult_weekend_price_diff'].'</option>';}
                        if($pr['child_cus_weekly_price'] != ''){
                            $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['child_weekend_price_diff'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Child - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['child_weekend_price_diff'].'</option>';
                        }
                        if($pr['infant_cus_weekly_price'] != ''){
                            $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['infant_weekend_price_diff'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Infant - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['infant_weekend_price_diff'].'</option>';
                        }$i++;
                    }
                }else{
                    $total_price_val =  $servicePrfirst['adult_cus_weekly_price'];
                    $selectval = '';$priceid = '';$i=1;
                    foreach ($servicePr as  $pr) {
                        if($i==1){ 
                            $priceid =$pr['id'];
                            $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_cus_weekly_price'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Select Price Option</option>'; }
                        if($pr['adult_cus_weekly_price'] != ''){
                            $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_cus_weekly_price'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Adult - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['adult_cus_weekly_price'].'</option>';}
                        if($pr['child_cus_weekly_price'] != ''){
                            $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['child_cus_weekly_price'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Child - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['child_cus_weekly_price'].'</option>';
                        }
                        if($pr['infant_cus_weekly_price'] != ''){
                            $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['infant_cus_weekly_price'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Infant - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['infant_cus_weekly_price'].'</option>';
                        }$i++;
                    }
                }

                $fun_para="'".$stact['id']."',this.value,'".$qty."','book','".$serviceid."'";
                $cng_sess="'".$serviceid."','".$stact['id']."',this.value,'book'";
                if ((File::exists(public_path("/uploads/profile_pic/thumb/" . @$stact['profile_pic']))) && ($stact['profile_pic'] != '')) {
                   
                    $profilePic = url('/public/uploads/profile_pic/thumb/' . @$stact['profile_pic']);
                } else {
                    
                    $profilePic = '/public/images/service-nofound.jpg';
                }
                $p=$stact['schedule_until'];
                $enddt = date('Y-m-d', strtotime("+".$p, strtotime($stact['starting'])) );
                $flterdt = date('Y-m-d',strtotime($actdate) );
                if( $flterdt <= $enddt ){
                
                    $stactbox .= '<div class="topkick intro" id="kickboxing'.$stact['id'].'"><h5>'.$stact['program_name'].' 
                        <p>'.$reviews_count.' Reviews <span> <i class="fa fa-star" aria-hidden="true"></i>'.$reviews_avg.'
                        </span> </p></h5>
                        <div class="lefthalf">
                            <div class="divdesc">
                                <div class="divleftserdes">
                                    <img src="'.$profilePic.'" />
                                </div>
                                <div class="divrightserdes">
                                    <p> <b> Description </b> </p>
                                    <p>'.Str::limit($stact['program_desc'], 80, $end='...').'</p>
                                </div>
                            </div>
                            <div class="divdesc">
                                <p class="actsubtitle"> Details: </p>
                                <ul>
                                    <li>'; 
                                        if(@$bookscheduler[0]['starting']!=''){
                                            if( !empty( $actdate ) ){
                                                $stactbox .= date('l, F jS,  Y', strtotime($actdate) );
                                            }
                                            else { $stactbox .= date('l, F jS,  Y' ); }
                                        } 
                                        $stactbox .= '</li>
                                    <li>Service Type: '.@$stact['select_service_type'].'</li>
                                    <li>Activity: '.@$stact['sport_activity'].'</li>
                                    <li>Activity Location: '.@$stact['activity_location'].'</li>
                                    <li>Great For: '.@$stact['activity_for'].'</li>
                                    <li>Age: '.@$stact['age_range'].'</li>
                                    <li>Language: '.@$languages.'</li>
                                    <li>Skill Level: '.@$stact['difficult_level'].'</li>';
                                    if(@$ser_mem[0]['membership_type']!=''){
                                        $stactbox .= '<li>Membership Type: '.@$ser_mem[0]['membership_type'].'</li>';
                                    }
                                    $stactbox .= '<li>Business Type: '.$stype.'</li>
                                </ul>
                            </div>
                        </div>
                        <div class="righthalf">
                            <select id="selcatpr'.$stact['id'].'" name="selcatpr'.$stact['id'].'" class="price-select-control" onchange="changeactsession('.$cng_sess.')">';
                                    if (!empty($sercate)) { 
                                         $c=1; 
                                        foreach ($sercate as  $sc) {
                                           
                                            $stactbox .= '<option value="'.$sc['id'].'">'.$sc['category_title'].'</option>';
                                            $c++;
                                        }
                                    }
                                    
                            $stactbox .= '</select>
                            <div class="priceoption" id="pricechng'.@$serviceid.$stact['id'].'">
                                <select id="selprice'.$stact['id'].'" name="selprice'.$stact['id'].'" class="price-select-control" onchange="changeactpr('.$fun_para.')">
                                    '.$selectval.'</select>
                            </div>
                            <label>Booking Details: </label>
                            <div id="book'.@$serviceid.@$stact["id"].'">';
                                if(@$sercatefirst['category_title'] != ''){
                                    $stactbox .= '<p>Category: '.@$sercatefirst['category_title'].'</p>';
                                }
                                $stactbox .= '<p>'.$timedata.'</p>
                                <p>Spots Left: '.$Totalspot.'</p><br>';
                                if(@$servicePrfirst['price_title'] != ''){
                                    $stactbox .= '<p>Price Title:  '.@$servicePrfirst['price_title'].'</p>';
                                }
                                if($timedata == 0){
                                    $timedata = '';
                                }
                                $stactbox .= '<p>Price Option: '.$servicePrfirst['pay_session'] .' Session</p>
                                <p>Participants: '.$qty.'</p>
                                <p>Total: $'. $total_price_val.'/person</p>
                            </div>
                            <input type="hidden" name="price_title_hidden" id="price_title_hidden'.$serviceid.$stact['id'].'" value="'.@$servicePrfirst['price_title'].'">

                            <input type="hidden" name="time_hidden" id="time_hidden'.$serviceid.$stact['id'].'" value="'.$timedata.'" >

                            <input type="hidden" name="sportsleft_hidden" id="sportsleft_hidden'.$serviceid.$stact['id'].'" value="'.$Totalspot.'">

                            <form method="post" action="/addtocart">
                                <input name="_token" type="hidden" value="'.csrf_token().'">
                                <input type="hidden" name="pid" value="'.@$stact["id"].'" />
                                <input type="hidden" name="quantity" id="pricequantity'.$serviceid.$stact["id"].'" value="'.$qty.'" class="product-quantity" />
                                <input type="hidden" name="price" id="price'.$serviceid.$stact['id'].'" value="'.$pay_price1.'" class="product-price" />
                                <input type="hidden" name="session" id="session'.$serviceid.$stact["id"].'" value="'.$pay_session1.'" />
                                <input type="hidden" name="priceid" value="'.$pay_id1.'" id="priceid'.$serviceid.$stact["id"].'" size="2" />
                                <input type="hidden" name="sesdate" value="'.date('Y-m-d').'" id="sesdate'.$serviceid.$stact["id"].'" />
                                <input type="hidden" name="cate_title" value="'.@$sercatefirst['category_title'].'" id="cate_title'.$serviceid.''.$stact['id'].'" />';
                                    
                                if($SpotsLeft >= $spot_avil)
                                {
                                    $stactbox .= '<a href="javascript:void(0)" class="btn btn-addtocart mt-10" style="pointer-events: none;" >Sold Out</a>';
                                }
                                else
                                {
                                    if($pay_price1!='' && $timedata!=''){
                                        $stactbox .= '<input type="submit" value="Add to Cart" onclick="changeqnt('.$stact["id"].')" class="btn btn-addtocart mt-10" />';
                                    }
                                }
                            $stactbox .= '</form>
                            </div>
                        </div>
                        <div class="bottomkick">
                            <div class="viewmore_links">
                                <a id="viewmore'.$stact['id'].'" style="display:none">View More <img src="public/img/arrow-down.png" alt=""></a>
                                <a id="viewless'.$stact['id'].'" style="display:block">View Less <img src="public/img/arrow-down.png" alt=""></a>
                            </div>
                        </div>
                    </div>';
                    $stactbox .='<script>
                        $("#viewmore'.$stact['id'].'").click(function () {
                            $("#kickboxing'.$stact['id'].'").addClass("intro");
                            $("#viewless'.$stact['id'].'").show();
                            $("#viewmore'.$stact['id'].'").hide();
                        });
                        $("#viewless'.$stact['id'].'").click(function () {
                            $("#kickboxing'.$stact['id'].'").removeClass("intro");
                            $("#viewless'.$stact['id'].'").hide();
                            $("#viewmore'.$stact['id'].'").show();
                        });
                    </script>';             
                }
            }
        }
        
        echo $actbox.'~~~~~~'.$stactbox;
        exit;  
    }*/
    
    
    public function createTest(Request $request){
        //echo 'call'; exit;
        return view('profiles.createTest');
    }
    public function getServiceData(Request $request) {
        echo 'success'; exit;
    }

    public function act_detail_filter_business_pages(Request $request){
      $actoffer = $request->actoffer;
      $actloc = $request->actloc;
      $actfilmtype = $request->actfilmtype;
      $actfilgreatfor = $request->actfilgreatfor;
      $actfilparticipant=$request->actfilparticipant;
      $btype = $request->btype;
      $actdate = $request->actdate;
      $actfilsType = $request->actfilsType;
      $serviceid = $request->serviceid;
      $companyid = $request->companyid;
        
        //DB::enableQueryLog();
      $searchData = DB::table('business_services')->where('business_services.cid', $companyid)->where('business_services.is_active', 1)->where('business_services.id', '!=' , $serviceid)->groupby('business_services.id');
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
      if( !empty($actfilparticipant) )
      {
            $searchData->join('business_activity_scheduler', 'business_services.id', '=', 'business_activity_scheduler.serviceid')->select('business_services.*','business_activity_scheduler.spots_available')->Where('business_activity_scheduler.spots_available', '>=', $actfilparticipant)->distinct();
        /*$searchData->Where('business_services.group_size', '>=', $actfilparticipant);*/
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
        $enddt = date('Y-m-d', strtotime("+1 year", strtotime($actdate)) );
        $searchData->join('business_activity_scheduler', 'business_services.id', '=', 'business_activity_scheduler.serviceid')->select('business_services.*','business_activity_scheduler.starting')->Where('business_activity_scheduler.starting', '<=', $enddt);
      }
      if( !empty($actfilsType) )
      {
        $searchData->whereRaw('FIND_IN_SET("'.$actfilsType.'",select_service_type)');
      }
      $activity1 = $searchData->get();
      //dd(\DB::getQueryLog());
      /*$activity1 = $searchData->groupby('business_services.id')->get()->toArray();*/
      $activity = json_decode(json_encode($activity1), true);
     /* print_r($activity);exit();*/
      $actbox='';
      
        if (!empty($activity)) { 
            foreach ($activity as  $act) {
              $servicePrice = BusinessPriceDetails::where('serviceid', $act['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
              $pay_session1=''; $pay_price1=''; $priceid1='';
              if( !empty($servicePrice) )
              {
                if(@$servicePrice[0]['pay_session']!=''){
                  $pay_session1 = @$servicePrice[0]['pay_session'];
                }
                if(@$servicePrice[0]['adult_cus_weekly_price']!=''){
                    $pay_price1 = @$servicePrice[0]['adult_cus_weekly_price'];
                }
                if(@$servicePrice[0]['id']!=''){
                  $priceid1 = @$servicePrice[0]['id'];
                }
              }
              $reviews_count = BusinessServiceReview::where('service_id', $act['id'])->count();
              $reviews_sum = BusinessServiceReview::where('service_id', $act['id'])->sum('rating');
              $reviews_avg=0;
              if($reviews_count>0)
              { $reviews_avg = round($reviews_sum/$reviews_count,2); }
              
              $today = date('Y-m-d');
              if( !empty( $actdate) ){ 
                $today = date('Y-m-d', strtotime($actdate)); 
              }
              $SpotsLeft = UserBookingDetail::where('sport', @$act['id'] )->whereDate('created_at', '=', $today)->sum('qty');
              if( !empty($act['group_size']) )
                $SpotsLeftdis = $act['group_size']-$SpotsLeft;
              $servicePr = BusinessPriceDetails::where('serviceid', $act['id'])->orderBy('id', 'ASC')->get()->toArray();
              
              $stype='';
              if($act['service_type']=='individual'){ $stype = 'Personal Training'; }
              else { $stype = @$act['service_type']; }
              $qty=1;
              if( !empty($actfilparticipant) )
              {
                $qty=$actfilparticipant;
                $pay_price1 = $pay_price1*$qty;
              }
              
              $fun_para="'".$act['id']."',this.value,'".$qty."','bookajax','".$act['id']."'";
              $cng_sess="'".$act['id']."','".$act['id']."',this.value,'bookajax'";
              $bookscheduler = BusinessActivityScheduler::where('serviceid', $act['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
              $ser_mem = BusinessPriceDetails::where('serviceid', $act['id'])->limit(1)->orderBy('id', 'ASC')->get()->toArray();
              
                $reviews_count = BusinessServiceReview::where('service_id', $act['id'])->count();
                $reviews_sum = BusinessServiceReview::where('service_id', $act['id'])->sum('rating');
                $reviews_avg=0;
                if($reviews_count>0)
                { 
                  $reviews_avg= round($reviews_sum/$reviews_count,2); 
                }
                if($act['profile_pic']!="") {
                  if(File::exists(public_path("/uploads/profile_pic/thumb/" . $act['profile_pic']))) {
                    $profilePic = url('/public/uploads/profile_pic/thumb/'.$act['profile_pic']);
                  } else {
                    $profilePic = '/public/images/service-nofound.jpg';
                  }
                }else{ 
                  $profilePic = '/public/images/service-nofound.jpg'; 
                }
                $companyid = $companyname = $companycity = $companycountry = $pay_price  =$starting = $shift_start = $shift_end = "";
                $companyData = CompanyInformation::where('id',$act['cid'])->first();
                if (isset($companyData)) {
                  $companyid = $companyData['id'];
                  $companyname = $companyData['company_name'];
                  $companycity = $companyData['city'];
                  $companycountry = $companyData['country'];     
                }
                $redlink = str_replace(" ","-",$companyname)."/".$act['id'];
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

                if(@$bookscheduler[0]['starting']!=''){
                   $starting = date('l jS \of F Y', strtotime( $bookscheduler[0]['starting'] )); 
                } 
                if(@$bookscheduler[0]['shift_start']!=''){
                    $shift_start = '<br>'.$bookscheduler[0]['shift_start'];
                }
                if(@$bookscheduler[0]['shift_end']!=''){
                    $shift_end =  ' - '.$bookscheduler[0]['shift_end'];
                }                                     


                $service_type='';
                if($act['service_type']!=''){
                  if( $act['service_type']=='individual' ) $service_type = 'Personal Training'; 
                  else if( $act['service_type']=='classes' )  $service_type = 'Group Classe'; 
                  else if( $act['service_type']=='experience' ) $service_type = 'Experience'; 
                }

                $pricearr = [];
                $price_all = '';
                $price_allarray = BusinessPriceDetails::where('serviceid', $act['id'])->get();
                if(!empty($price_allarray)){
                  foreach ($price_allarray as $key => $value) {
                    $pricearr[] = $value->pay_price;
                  }
                }
                if(!empty($pricearr)){
                  $price_all = min($pricearr);
                }

                $servicePrfirst = BusinessPriceDetails::where('serviceid', $act['id'])->orderBy('id', 'ASC')->first();
                $sercate = BusinessPriceDetailsAges::where('serviceid', $act['id'])->orderBy('id', 'ASC')->get()->toArray();
                $sercatefirst = BusinessPriceDetailsAges::where('serviceid', $act['id'])->orderBy('id', 'ASC')->get()->first();
                $servicePr = BusinessPriceDetails::where('serviceid', $act['id'])->orderBy('id', 'ASC')->where('category_id',@$sercatefirst['id'])->get()->toArray();
              
                $todayday = date("l");
                $todaydate = date('m/d/Y');
                $bus_schedule = BusinessActivityScheduler::where('category_id',@$sercatefirst['id'])->whereRaw('FIND_IN_SET("'.$todayday.'",activity_days)')->where('starting','<=',$todaydate )->get();
                $start =$end= $time= '';$timedata = $SpotsLeft = 0; $Totalspot = $spot_avil= 0; 
                if(!empty($bus_schedule)){
                    foreach($bus_schedule as $data){
                        if($data['scheduled_day_or_week'] == 'Days'){
                            $daynum = '+'.$data['scheduled_day_or_week_num'].' days';
                            $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
                        }else if($data['scheduled_day_or_week'] == 'Months'){
                            $daynum = '+'.$data['scheduled_day_or_week_num'].' month';
                            $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
                        }else if($data['scheduled_day_or_week'] == 'Years'){
                            $daynum = '+'.$data['scheduled_day_or_week_num'].' years';
                            $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
                        }else{
                            $daynum = '+'.$data['scheduled_day_or_week_num'].' week';
                            $expdate  = date('m/d/Y', strtotime($data['starting']. $daynum ));
                        }  
                        
                        if($todaydate <=$expdate){
                             $timedata ='';
                            if(@$data['shift_start']!=''){
                                $start = date('h:i a', strtotime( $data['shift_start'] ));

                                $timedata .= $start;
                            }
                            if(@$data['shift_end']!=''){
                                $end = date('h:i a', strtotime( $data['shift_end'] ));
                                 $timedata .= ' - '.$end;
                            } 
                            if(@$data['set_duration']!=''){
                                $tm=explode(' ',$data['set_duration']);
                                $hr=''; $min=''; $sec='';
                                if($tm[0]!=0){ $hr=$tm[0].'hr. '; }
                                if($tm[2]!=0){ $min=$tm[2].'min. '; }
                                if($tm[4]!=0){ $sec=$tm[4].'sec.'; }
                                if($hr!='' || $min!='' || $sec!='')
                                { $time = $hr.$min.$sec; 
                                    $timedata .= ' / '.$time;} 
                            }
                        }
                        $today = date('Y-m-d');
                        $SpotsLeft = UserBookingDetail::where('sport', @$act['id'] )->whereDate('created_at', '=', $today)->sum('qty');
                        $SpotsLeftdis=0;
                        if( !empty($data['spots_available']) ){
                            $spot_avil=$data['spots_available'];
                            $SpotsLeftdis = $data['spots_available']-$SpotsLeft;
                            $Totalspot = $SpotsLeftdis.'/'.@$data['spots_available'];
                        }
                    }
                }

                if(date('l') == 'Saturday' || date('l') == 'Sunday'){
                    $total_price_val =  @$servicePrfirst['adult_weekend_price_diff'];
                    $selectval = '';$priceid = '';$i=1;
                    if(!empty(@$servicePr)){
                        foreach ($servicePr as  $pr) {
                            if($i==1){ 
                                $priceid =$pr['id'];
                                $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_weekend_price_diff'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Select Price Option</option>'; }
                            if($pr['adult_weekend_price_diff'] != ''){
                                $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_weekend_price_diff'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Adult - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['adult_weekend_price_diff'].'</option>';}
                            if($pr['child_cus_weekly_price'] != ''){
                                $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['child_weekend_price_diff'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Child - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['child_weekend_price_diff'].'</option>';
                            }
                            if($pr['infant_cus_weekly_price'] != ''){
                                $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['infant_weekend_price_diff'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Infant - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['infant_weekend_price_diff'].'</option>';
                            }$i++;
                        }
                    }
                }else{
                    $total_price_val =  @$servicePrfirst['adult_cus_weekly_price'];
                    $selectval = '';$priceid = '';$i=1;
                    if(!empty(@$servicePr)){
                        foreach ($servicePr as  $pr) {
                            if($i==1){ 
                                $priceid =$pr['id'];
                                $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_cus_weekly_price'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Select Price Option</option>'; }
                            if($pr['adult_cus_weekly_price'] != ''){
                                $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['adult_cus_weekly_price'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Adult - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['adult_cus_weekly_price'].'</option>';}
                            if($pr['child_cus_weekly_price'] != ''){
                                $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['child_cus_weekly_price'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Child - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['child_cus_weekly_price'].'</option>';
                            }
                            if($pr['infant_cus_weekly_price'] != ''){
                                $selectval .='<option value="'.$pr['pay_session'].'~~'.$pr['infant_cus_weekly_price'].'~~'.$pr['id'].'^'.$pr['price_title'].'">Infant - '.$pr['price_title'].' - '.$pr['pay_session'].' Sessions - $'.$pr['infant_cus_weekly_price'].'</option>';
                            }$i++;
                        }
                    }
                }

                $activity_sche =  BusinessActivityScheduler::where('category_id',@$sercatefirst['id'])->first(); 
                $p=@$activity_sche['scheduled_day_or_week_num'].' '.@$activity_sche['scheduled_day_or_week'];
                
                $enddt = date('m/d/Y', strtotime("+".$p, strtotime(@$servicePrfirst['starting'])) );
                /*     echo $enddt;exit;*/
                $flterdt = date('m/d/Y',strtotime($actdate) );
                if($actdate != ''){
                    if( $flterdt <= $enddt ){
                        $actbox .= '<div class="kickshow-block">
                                    <div class="topkick" id="kickboxing'.$act['id'].'">
                                        <h5>'.$act['program_name'].'
                                            <p>'.$reviews_count.' Reviews <span> <i class="fa fa-star" aria-hidden="true"></i>
                                            '.$reviews_avg.' </span></p>
                                        </h5> 
                                        <div class="lefthalf">
                                            <div class="divdesc">
                                                <div class="divleftserdes">
                                                    <img src="'.$profilePic.'" />
                                                </div>
                                                <div class="divrightserdes">
                                                    <p> <b> Description </b> </p>
                                                    <p>';

                                                    $testval = Str::limit($act['program_desc'], 80, $end='...');
                                                    $actbox .= ''.$testval.'</p>
                                                </div>
                                            </div>
                                            <div class="divdesc">
                                                <p class="actsubtitle"> Details: </p>
                                                <ul>
                                                    <li>'.$starting.'</li>
                                                    <li>Service Type: '.@$act['select_service_type'].'</li>
                                                    <li>Activity: '.@$act['sport_activity'].'</li>
                                                    <li>Activity Location: '.@$act['activity_location'].'</li>
                                                    <li>Great For: '.@$act['activity_for'].'</li>
                                                    <li>Age: '.@$act['age_range'] .'</li>
                                                    <li>Language: '.@$languages.'</li>
                                                    <li>Skill Level: '.@$act['difficult_level'].'</li>';
                                                    if(@$ser_mem[0]['membership_type']!=''){ 
                                                        $actbox .= '<li>Membership Type:  '.@$ser_mem[0]['membership_type'].'</li>';
                                                    }
                                                    $actbox .= '<li>Business Type:';
                                                            if($act['service_type']=='individual'){
                                                                $actbox .= 'Personal Training'; 
                                                            }
                                                            else { 
                                                                $actbox .= @$act['service_type']; 
                                                            } 
                                                    $actbox .='</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="righthalf">
                                            <select id="selcatpr'.$act['id'].'" name="selcatpr'.$act['id'].'" class="price-select-control" onchange="changeactsession('.$cng_sess.')">';
                                                $c=1;  
                                                if (!empty($sercate)) { 
                                                    foreach ($sercate as  $sc) {
                                                        $actbox .='<option value="'.$sc['id'].'">'.$sc['category_title'].'</option>';
                                                        $c++;
                                                    }
                                                }
                                              
                                            $actbox .='</select>
                                            <div id="pricechng'.$act['id'].'">
                                                <select id="selprice'.$act['id'].'" name="selprice'.$act['id'].'" class="price-select-control" onchange="changeactpr('.$fun_para.')">
                                            '.$selectval.'</select>
                                            </div>
                                            <label>Booking Details</label>
                                            <div id="bookajax'.$act["id"].'">';
                                                if(@$sercatefirst['category_title'] != ''){
                                                    $actbox .= '<p>Category: '.@$sercatefirst['category_title'].'</p>';
                                                }
                                                if($timedata != ''){
                                                    $actbox .= '<p>'.$timedata.'</p>';
                                                }
                                                $actbox .= '<p>Spots Left: '.$Totalspot.'</p><br>';
                                                if(@$servicePrfirst['price_title'] != ''){
                                                    $actbox .= '<p>Price Title:  '.@$servicePrfirst['price_title'].'</p>';
                                                }
                                                
                                                $actbox .= '<p>Price Option: '.@$servicePrfirst['pay_session'] .' Session</p>
                                                <p>Participants: '.$qty.'</p>
                                                <p>Total: $'. $total_price_val.'/person</p>
                                            </div>
                                            <input type="hidden" name="price_title_hidden" id="price_title_hidden'.$act['id'].$act['id'].'" value="'.@$servicePrfirst['price_title'].'">
                                            <input type="hidden" name="time_hidden" id="time_hidden'.$act['id'].$act['id'].'" value="'.$timedata.'">
                                            <input type="hidden" name="sportsleft_hidden" id="sportsleft_hidden'.$act['id'].$act['id'].'" value="'.$Totalspot.'">


                                            <form method="post" action="/addtocart" id="frmcart'.$act["id"].'>
                                                <input name="_token" type="hidden" value="'.csrf_token().'">
                                                <input type="hidden" name="pid" value="'.@$act["id"].'" size="2" />
                                                <input type="hidden" name="quantity" id="pricequantity'.$act["id"].$act["id"].'" value="'.$qty.'" class="product-quantity" />
                                                <input type="hidden" name="price" id="pricebookajax'.$act["id"].$act['id'].'" value="'.$pay_price1.'" class="product-price" />
                                                <input type="hidden" name="session" id="session'.$act["id"].$act["id"].'" value="'.$pay_session1.'" />
                                                <input type="hidden" name="priceid" value="'.$priceid1.'" id="priceid'.$act["id"].$act["id"].'" />
                                                <input type="hidden" name="sesdate" value="'.date('Y-m-d', strtotime($actdate) ).'" id="sesdate'.$act["id"].$act["id"].'" />
                                                <input type="hidden" name="cate_title" value="'.@$sercatefirst['category_title'].'" id="cate_title'.$act["id"].''.$act['id'].'" />';
                                                if($SpotsLeft >= $spot_avil && $spot_avil != 0){
                                                    $actbox .= '<a href="javascript:void(0)" class="btn btn-addtocart mt-10" style="pointer-events: none;">Sold Out</a>';
                                                }
                                                else if($pay_price1 !='' && $timedata !=''){
                                                    $actbox .= '<input type="submit" value="Add to Cart" onclick="changeqnt('.$act['id'].')" class="btn btn-addtocart mt-10" id="addtocart'.$act['id'].'"/>';
                                                }
                                            $actbox .= '</form>
                                        </div>
                                    </div>
                                    <div class="bottomkick">
                                        <div class="viewmore_links">
                                            <a id="viewmore'.$act['id'].'" style="display:block">View More <img src=" public/img/arrow-down.png" alt=""></a>
                                            <a id="viewless'.$act['id'].'" style="display:none">View Less <img src="public/img/arrow-down.png" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $("#viewmore'.$act['id'].'").click(function () {
                                        $("#kickboxing'.$act['id'].'").addClass("intro");
                                        $("#viewless'.$act['id'].'").show();
                                        $("#viewmore'.$act['id'].'").hide();
                                    });
                                    $("#viewless'.$act['id'].'").click(function () {
                                        $("#kickboxing'.$act['id'].'").removeClass("intro");
                                        $("#viewless'.$act['id'].'").hide();
                                        $("#viewmore'.$act['id'].'").show();
                                    });
                                </script>
                                    ';
                    }
                }else{
                    $actbox .= '<div class="kickshow-block">
                                    <div class="topkick" id="kickboxing'.$act['id'].'">
                                        <h5>'.$act['program_name'].'
                                            <p>'.$reviews_count.' Reviews <span> <i class="fa fa-star" aria-hidden="true"></i>
                                            '.$reviews_avg.' </span></p>
                                        </h5> 
                                        <div class="lefthalf">
                                            <div class="divdesc">
                                                <div class="divleftserdes">
                                                    <img src="'.$profilePic.'" />
                                                </div>
                                                <div class="divrightserdes">
                                                    <p> <b> Description </b> </p>
                                                    <p>';

                                                    $testval = Str::limit($act['program_desc'], 80, $end='...');
                                                    $actbox .= ''.$testval.'</p>
                                                </div>
                                            </div>
                                            <div class="divdesc">
                                                <p class="actsubtitle"> Details: </p>
                                                <ul>
                                                    <li>'.$starting.'</li>
                                                    <li>Service Type: '.@$act['select_service_type'].'</li>
                                                    <li>Activity: '.@$act['sport_activity'].'</li>
                                                    <li>Activity Location: '.@$act['activity_location'].'</li>
                                                    <li>Great For: '.@$act['activity_for'].'</li>
                                                    <li>Age: '.@$act['age_range'] .'</li>
                                                    <li>Language: '.@$languages.'</li>
                                                    <li>Skill Level: '.@$act['difficult_level'].'</li>';
                                                    if(@$ser_mem[0]['membership_type']!=''){ 
                                                        $actbox .= '<li>Membership Type:  '.@$ser_mem[0]['membership_type'].'</li>';
                                                    }
                                                    $actbox .= '<li>Business Type:';
                                                            if($act['service_type']=='individual'){
                                                                $actbox .= 'Personal Training'; 
                                                            }
                                                            else { 
                                                                $actbox .= @$act['service_type']; 
                                                            } 
                                                    $actbox .='</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="righthalf">
                                            <select id="selcatpr'.$act['id'].'" name="selcatpr'.$act['id'].'" class="price-select-control" onchange="changeactsession('.$cng_sess.')">';
                                                $c=1;  
                                                if (!empty($sercate)) { 
                                                    foreach ($sercate as  $sc) {
                                                        $actbox .='<option value="'.$sc['id'].'">'.$sc['category_title'].'</option>';
                                                        $c++;
                                                    }
                                                }
                                              
                                            $actbox .='</select>
                                            <div id="pricechng'.$act['id'].'">
                                                <select id="selprice'.$act['id'].'" name="selprice'.$act['id'].'" class="price-select-control" onchange="changeactpr('.$fun_para.')">
                                            '.$selectval.'</select>
                                            </div>
                                            <label>Booking Details</label>
                                            <div id="bookajax'.$act["id"].'">';
                                                if(@$sercatefirst['category_title'] != ''){
                                                    $actbox .= '<p>Category: '.@$sercatefirst['category_title'].'</p>';
                                                }
                                                if($timedata != ''){
                                                    $actbox .= '<p>'.$timedata.'</p>';
                                                }
                                                $actbox .= '<p>Spots Left: '.$Totalspot.'</p><br>';
                                                if(@$servicePrfirst['price_title'] != ''){
                                                    $actbox .= '<p>Price Title:  '.@$servicePrfirst['price_title'].'</p>';
                                                }
                                                
                                                $actbox .= '<p>Price Option: '.@$servicePrfirst['pay_session'] .' Session</p>
                                                <p>Participants: '.$qty.'</p>
                                                <p>Total: $'. $total_price_val.'/person</p>
                                            </div>
                                            <input type="hidden" name="price_title_hidden" id="price_title_hidden'.$act['id'].$act['id'].'" value="'.@$servicePrfirst['price_title'].'">
                                            <input type="hidden" name="time_hidden" id="time_hidden'.$act['id'].$act['id'].'" value="'.$timedata.'">
                                            <input type="hidden" name="sportsleft_hidden" id="sportsleft_hidden'.$act['id'].$act['id'].'" value="'.$Totalspot.'">


                                            <form method="post" action="/addtocart" id="frmcart'.$act["id"].'>
                                                <input name="_token" type="hidden" value="'.csrf_token().'">
                                                <input type="hidden" name="pid" value="'.@$act["id"].'" size="2" />
                                                <input type="hidden" name="quantity" id="pricequantity'.$act["id"].$act["id"].'" value="'.$qty.'" class="product-quantity" />
                                                <input type="hidden" name="price" id="pricebookajax'.$act["id"].$act['id'].'" value="'.$pay_price1.'" class="product-price" />
                                                <input type="hidden" name="session" id="session'.$act["id"].$act["id"].'" value="'.$pay_session1.'" />
                                                <input type="hidden" name="priceid" value="'.$priceid1.'" id="priceid'.$act["id"].$act["id"].'" />
                                                <input type="hidden" name="sesdate" value="'.date('Y-m-d', strtotime($actdate) ).'" id="sesdate'.$act["id"].$act["id"].'" />
                                                <input type="hidden" name="cate_title" value="'.@$sercatefirst['category_title'].'" id="cate_title'.$act["id"].''.$act['id'].'" />';
                                                if($SpotsLeft >= $spot_avil && $spot_avil != 0){
                                                    $actbox .= '<a href="javascript:void(0)" class="btn btn-addtocart mt-10" style="pointer-events: none;">Sold Out</a>';
                                                }
                                                else if($pay_price1 !='' && $timedata !=''){
                                                    $actbox .= '<input type="submit" value="Add to Cart" onclick="changeqnt('.$act['id'].')" class="btn btn-addtocart mt-10" id="addtocart'.$act['id'].'"/>';
                                                }
                                            $actbox .= '</form>
                                        </div>
                                    </div>
                                    <div class="bottomkick">
                                        <div class="viewmore_links">
                                            <a id="viewmore'.$act['id'].'" style="display:block">View More <img src=" public/img/arrow-down.png" alt=""></a>
                                            <a id="viewless'.$act['id'].'" style="display:none">View Less <img src="public/img/arrow-down.png" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $("#viewmore'.$act['id'].'").click(function () {
                                        $("#kickboxing'.$act['id'].'").addClass("intro");
                                        $("#viewless'.$act['id'].'").show();
                                        $("#viewmore'.$act['id'].'").hide();
                                    });
                                    $("#viewless'.$act['id'].'").click(function () {
                                        $("#kickboxing'.$act['id'].'").removeClass("intro");
                                        $("#viewless'.$act['id'].'").hide();
                                        $("#viewmore'.$act['id'].'").show();
                                    });
                                </script>
                                    ';
                }
            }
        }
    
      echo $actbox;
      exit; 
    }
    
    public function instant_hire_search_filter(Request $request) {
     /* print_r($request->all());exit();*/
      $filter_serchdata  = [];
      $searchDatas = BusinessServices::where('is_active', 1); 

      if($request->programservices  != null) {
        $search = $request->programservices;
        $searchDatas->where(function($q) use ($search) {
          foreach ($search as $data) {
            $data = ucwords($data);
            $q->orWhere('sport_activity', 'LIKE', '%'. $data . '%');
          }
        });
      }

      if($request->service_type != null) {
        $search = $request->service_type;
        $searchDatas->where(function($q) use ($search) {
          foreach ($search as $data) {
            $q->orWhere('service_type', 'LIKE', '%'. $data . '%');
          }
        });
      } 

      if($request->service_type_two != null) {
        $search = $request->service_type_two;
        $searchDatas->where(function($q) use ($search) {
          foreach ($search as $data) {
            $q->orWhere('select_service_type', 'LIKE', '%'. $data . '%');
          }
        });
      }

      if ($request->activity_for != null) {
        $search = $request->activity_for;
        $searchDatas->where(function($q) use ($search) {
          if(!in_array("any", $search)){
            foreach ($search as $data) {
              $data = ucwords($data);
              $q->orWhere('activity_for', 'LIKE', '%'. $data . '%');
            }
          }
        });
      }

        $result = $searchDatas->get()->toArray();
        $page = $request->page ? $request->page : 1;
        $perPage = $request->page_size ? $request->page_size : 10;
        $offset = ($page * $perPage) - $perPage;

        $resultnew = new LengthAwarePaginator(
        array_slice($result, $offset, $perPage, true), count($result), $perPage, $page, ['path' => $request->url(), 'query' => $request->query()]
        );

       $filter_serchdata =  $resultnew;
      /*print_r($filter_serchdata);*/
      $actbox = '';

      if (!empty($filter_serchdata) && count($filter_serchdata)>0) { 
        $actbox = '<div class="row">';
        foreach ($filter_serchdata as  $act) {
          if($act['profile_pic']!="") {
            if(File::exists(public_path("/uploads/profile_pic/thumb/" . $act['profile_pic']))) {
              $profilePic = url('/public/uploads/profile_pic/thumb/'.$act['profile_pic']);
            } else {
              $profilePic = '/public/images/service-nofound.jpg';
            }
          }else{ 
            $profilePic = '/public/images/service-nofound.jpg'; 
          }

          $companyid = $companylat = $companylon = $companyname  = $latitude = $longitude = $serviceid = $companylogo = $companycity = $companycountry = $pay_price  = $bookscheduler = $time='';

          $company = CompanyInformation::where('id',$act['cid'])->first();
          $companyid = $company->id;
          $companyname = $company->company_name;
          $companycity = $company->city;
          $companycountry = $company->country;
          $companylogo = $company->logo;
          $companylat = $company->latitude;
          $companylon = $company->longitude;

          $redlink = str_replace(" ","-",$companyname)."/".$act['cid'];
          $service_type='';
          if($act['service_type'] !=''){
            if( $act['service_type']=='individual' ) $service_type = 'Personal Training'; 
            else if( $act['service_type']=='classes' )  $service_type = 'Group Classe'; 
            else if( $act['service_type']=='experience' ) $service_type = 'Experience'; 
          }

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

          $pricearr = [];
          $price_all = '';
          $price_allarray = BusinessPriceDetails::where('serviceid', $act['id'])->get();
          if(!empty($price_allarray)){
            foreach ($price_allarray as $key => $value) {
              $pricearr[] = $value->pay_price;
            }
          }
          if(!empty($pricearr)){
            $price_all = min($pricearr);
          }

          $actbox .= '
            <div class="col-md-4 col-sm-4 col-map-show">
              <div class="kickboxing-block">';
            if(Auth::check()){
              $loggedId = Auth::user()->id;
              $favData = BusinessServicesFavorite::where('user_id',$loggedId)->where('service_id',$act['id'])->first(); 
            $actbox .='<div class="kickboxing-topimg-content" ser_id="'.$act['id'].'" >
                      <img src="'.$profilePic.'" class="productImg">
                      <div class="serv_fav1" ser_id="'.$act['id'].'">
                        <a class="fav-fun-2" id="serfav'.$act['id'].'">';
                        if( !empty($favData)){
                          $actbox .='<i class="fas fa-heart"></i>';
                        }else{
                          $actbox .='<i class="far fa-heart"></i></a>';
                        }
            $actbox .='</div>';
                  if($price_all != ''){
            $actbox .='<span>From $'.$price_all.'/Person</span>';
                  }
            $actbox .='</div>';
                }else {
            $actbox .='<div class="kickboxing-topimg-content">
                    <img src="'.$profilePic.'" class="productImg">
                      <a class="fav-fun-2" href="'.Config::get('constants.SITE_URL').'/userlogin" ><i class="far fa-heart"></i></a>';
                  if($price_all != '') {
               $actbox .='<span>From $'.$price_all.'/Person</span>';
                  }
            $actbox .='</div>';
                }

            $reviews_count = BusinessServiceReview::where('service_id', $act['id'])->count();
            $reviews_sum = BusinessServiceReview::where('service_id', $act['id'])->sum('rating');
            $reviews_avg=0;
            if($reviews_count>0)
            { 
              $reviews_avg= round($reviews_sum/$reviews_count,2); 
            }

            $actbox .='<div class="bottom-content">
                <div class="class-info">
                  <div class="row">
                    <div class="col-md-7 ratingtime">
                      <div class="activity-inner-data">
                        <i class="fas fa-star"></i>
                        <span>'.$reviews_avg.' ('.$reviews_count.')</span>
                      </div>';
                      if($time != ''){
                $actbox .='<div class="activity-hours">
                          <span>'.$time.'</span>
                        </div>';
                      }
            $actbox .='</div>
                    <div class="col-md-5 country-instant">
                      <div class="activity-city">
                        <span>'.$companycity.', '.$companycountry.'</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="activity-information">
                  <span><a';  
                  if (Auth::check()) { 
                    $actbox .='href="'.Config::get('constants.SITE_URL').'/businessprofile/'.$redlink.'"'; 
                  } else { 
                    $actbox .='href="'.Config::get('constants.SITE_URL').'/userlogin"'; 
                  }

                  $actbox .='target="_blank">'.$act["program_name"].'</a></span>
                    <p>'.$service_type.' | '.$act["sport_activity"] .'</p>
                </div>
                <hr>
                <div class="all-details">
                  <a class="showall-btn" href="/activity-details/'.$act['id'].'">More Details</a>
                    <p class="addToCompare" id="compid1" title="Add to Compare">COMPARE SIMILAR +</p>
                  </div>
                </div>
              </div>
            </div>';
        }
        $actbox .='</div><div class="col-md-12 col-xs-12">'.$filter_serchdata->links().'</div>';
      }
      return $actbox;
     /* print_r($filter_serchdata);exit();*/
    }
}
