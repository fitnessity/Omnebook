<?php
namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use App\User;
use App\BusinessCompanyDetail;
use App\CompanyInformation;
use App\BusinessServices;
use App\UserBookingStatus;
use App\BusinessActivityScheduler;
use App\BusinessPriceDetailsAges;
use App\BusinessPriceDetails;
use App\StaffMembers;
use App\UserBookingDetail;
use App\ActivityCancel;
use App\UserFamilyDetail;
use App\BusinessSubscriptionPlan;
use App\Customer;
use App\BookingActivityCancel;
use App\BookingCheckinDetails;
use App\BookingPostorder;
use Auth;
use DB;
use Carbon\Carbon;
use DateTime;
use Config;
use DateInterval;
use App\MailService;
use App\Repositories\BusinessServiceRepository;
use App\Repositories\BookingRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\UserRepository;
use DateTimeZone;

class SchedulerController extends BusinessBaseController
{    
     protected $business_service_repo;
     protected $customers;
     protected $users;
     protected $booking_repo;

     public function __construct(BusinessServiceRepository $business_service_repo ,CustomerRepository $customers,UserRepository $users,BookingRepository $booking_repo){        
          $this->business_service_repo = $business_service_repo;
          $this->users = $users;
          $this->customers = $customers;
          $this->booking_repo = $booking_repo;   
     }

     public function index(Request $request){
          $filterDate = Carbon::parse($request->date);
          $schedules = BusinessActivityScheduler::alldayschedule($filterDate,$request->activity_type)->where('cid', $request->current_company->id)->get();

          return view('business.scheduler.index', [
              'schedules' => $schedules, 
              'filterDate' => $filterDate,
          ]);
     }

     public function create(Request $request , $business_id, $categoryId= null){
          $category =  BusinessPriceDetailsAges::where('id',$request->categoryId)->first();
          $businessActivity = BusinessActivityScheduler::where('cid', $category->cid)->where('serviceid', $category->serviceid)->where('category_id',$category->id)->get();
          return view('business.scheduler.create',compact('category','businessActivity'));
     }

     public function store(Request $request){
          //print_r($request->all());exit;
          $shift_start = $request->duration_cnt;
          if($shift_start >= 0) {
               $idary = BusinessActivityScheduler::where('cid', $request->cId)->where('userid', Auth::user()->id)->where('serviceid',  $request->serviceId)->where('category_id',$request->categoryId)->pluck('id')->toArray();
     
               $idary1 = array();

               for($i=0; $i <= $shift_start; $i++) { 
                    $idary1[] = $request->id[$i] != '' ?  $request->id[$i] : '';
                    
                    if($request->shift_start[$i] != '' && $request->shift_end[$i] != '' && $request->set_duration[$i] != '') {

                         $expdate  = date('Y-m-d', strtotime($request->starting. '+'.$request->scheduled.$request->until ));

                         $activitySchedulerData = [
                             "cid" => $request->cId,
                             "category_id" => $request->categoryId,
                             "userid" =>Auth::user()->id,
                             "serviceid" =>$request->serviceId,
                             "activity_meets" => $request->frm_class_meets,
                             "starting" => date('Y-m-d', strtotime($request->starting)),
                             "activity_days" => isset($request->activity_days[$i]) ? $request->activity_days[$i] : '',
                             "shift_start" => isset($request->shift_start[$i]) ? $request->shift_start[$i] : '',
                             "shift_end" => isset($request->shift_end[$i]) ? $request->shift_end[$i] : '',
                             "set_duration" => isset($request->set_duration[$i]) ? $request->set_duration[$i] : '',
                             "spots_available" => isset($request->sport_avail[$i]) ? $request->sport_avail[$i] : '',
                             "scheduled_day_or_week" => $request->until, 
                             "scheduled_day_or_week_num" => $request->scheduled,
                             "end_activity_date" => $expdate,
                             "is_active" => 1,
                         ];
                         if($request->id[$i] != ''){
                              BusinessActivityScheduler::where('id', $request->id[$i])->update($activitySchedulerData);
                         }else{
                              BusinessActivityScheduler::create($activitySchedulerData);
                         }
                    }
               }
        
               $differenceArray1 = array_diff($idary, $idary1);
               foreach($differenceArray1 as $deletdata){
                    BusinessActivityScheduler::where('id',$deletdata)->delete();
               }
          }
          return redirect()->route('business.schedulers.create', ["business_id"=>$request->cId,"categoryId"=>$request->categoryId]);
     }

     public function destroy(Request $request){

          $mail_type = $request->has('cancel_date_chk') ? 'cancel' : 'reschedule';
          $cancel_date_chk = $request->has('cancel_date_chk') ? 1:0 ;
          $act_cancel_chk = $request->has('cancel_date_chk') ? 1:0;

          if($request->can_id == ''){
               $data = $request->all();
               if(@$data['cancel_date'] != ''){
                    $data['cancel_date'] = date('Y-m-d',strtotime($request->cancel_date));
               }
               $position = array_search(request()->_token, $data);
               unset($data[$position]);
               ActivityCancel::create($data);
          }else{
               $show_cancel_on_schedule = $request->has('hide_cancel_on_schedule') ? 1: 0;
               $hide_cancel_on_schedule = $request->has('hide_cancel_on_schedule') ? 1: 0;
               $email_Instructor = $request->has('hide_cancel_on_schedule') ? 1: 0;
               $email_clients = $request->has('hide_cancel_on_schedule') ? 1: 0;

               $ac_data = ActivityCancel::where('id',$request->can_id)->update(['show_cancel_on_schedule'=>$show_cancel_on_schedule,'hide_cancel_on_schedule'=>$hide_cancel_on_schedule,'email_Instructor'=>$email_Instructor,'email_clients'=>$email_clients,'act_cancel_chk'=>$act_cancel_chk ,'cancel_date_chk'=>$cancel_date_chk]);
          }

          if($request->has('email_clients')){
               $databooked = UserBookingDetail::where('act_schedule_id', $request->schedule_id)->where('bookedtime' ,date('Y-m-d',strtotime($request->cancel_date)))->get();
               foreach($databooked as $db){
                    if($db->booking->user_type == 'user'){
                         $userdata = $db->booking->user;
                    }elseif($db->booking->user_type == 'customer'){
                         $userdata = $db->booking->customer;
                    }  

                    $businessdata = $db->business_services;
                    $companydata = $db->business_services->company_information;
                    $time = date('h:i a',strtotime($db->business_activity_scheduler->shift_start));
                    $date = $request->cancel_date;
                    $status = MailService::sendEmailforchedulechange($userdata , $businessdata ,$companydata,$time,$date,$db->booking->user_type,$mail_type);
               } 
          }

          if($request->has('email_Instructor')){
               $databooked = UserBookingDetail::where('act_schedule_id', $request->schedule_id)->where('bookedtime' ,date('Y-m-d',strtotime($request->cancel_date)))->first();
               //print_r($databooked);
            
               $insdata = $databooked->business_services->StaffMembers;
               if($insdata != ''){
                    $businessdata = $databooked->business_services;
                    $companydata = $databooked->business_services->company_information;
                    $time = date('h:i a',strtotime($databooked->business_activity_scheduler->shift_start));
                    $date = $request->cancel_date;
                    if($insdata->email != ''){
                         $status = MailService::sendEmailtoInstructorforschedulechange($insdata , $businessdata ,$companydata,$time,$date,$mail_type);
                    }
               }
          }
          return redirect($request->return_url);
     }

     public function delete_modal(Request $request){
          $cancelDate = Carbon::parse($request->date);
          $schedule = BusinessActivityScheduler::alldayschedule($cancelDate,'')->where('cid', $request->current_company->id)->findOrFail($request->schedulerId);

          $activityCancel = ActivityCancel::where('cancel_date', $cancelDate->format("Y-m-d"))->where('schedule_id',$schedule->id)->first();
          $cancelDateChk = @$activityCancel->cancel_date_chk == 1 ? 'checked': '' ;
          $showCancelOnSchedule = @$activityCancel->show_cancel_on_schedule == 1 ? 'checked': '' ;
          $hideCancelOnSchedule = @$activityCancel->hide_cancel_on_schedule == 1 ? 'checked': '' ;
          $emailInstructor = @$activityCancel->email_Instructor == 1 ? 'checked': '' ;
          $emailClients = @$activityCancel->email_clients == 1 ? 'checked': '' ;
                                
          $output = '';
          $output .='<h5 class="modal-title mb-10" id="myModalLabel">Cancel Activity</h5><form method="post" action="'.route("business.schedulers.destroy", ['scheduler' => $schedule->id]).'">
                 <input type="hidden" name="_method" value="delete">
                 <input type="hidden" name="_token" value="'.csrf_token().'">
                 <input type ="hidden" name="can_id" value="'.@$activityCancel->id.'">
                 <input type="hidden" name="return_url" value="'.$request->return_url.'">
                 <input type="hidden" name="schedule_id" value="'.$schedule->id.'">
                 <input type="hidden" name="cancel_date" value="'.$cancelDate->format("Y-m-d").'">
                 <div class="row">
                      <div class="col-md-12">
                           <div class="">
                                <input type="checkbox" id="cancel_date_chk" name="cancel_date_chk" value="1" '.$cancelDateChk.'>
                                <label for="cancel_date_chk"> Cancel this activity for today only</label><br>
                                <input type="checkbox" id="show_cancel_on_schedule" name="show_cancel_on_schedule" value="1"'.$showCancelOnSchedule.'>
                                <label for="show_cancel_on_schedule">Show cancellation on schedule</label><br>
                                <input type="checkbox" id="hide_cancel_on_schedule" name="hide_cancel_on_schedule" value="1"'.$hideCancelOnSchedule.'>
                                <label for="hide_cancel_on_schedule">Hide cancellation on schedule</label><br>
                           </div>
                      </div>
                 </div>
                 <hr style="border: 1px solid #efefef; width: 107%; margin-left: -15px; margin-top: 15px;">
                 <div class="row">
                      <div class="col-md-12">
                            <h5 class="modal-title mb-10">Alert others of the cancellations</h5> 
                           <div class="">
                                <input type="checkbox" id="email_Instructor" name="email_Instructor" value="1"'.$emailInstructor.'>
                                <label for="email_Instructor">Email Instructor</label><br>
                                <input type="checkbox" id="email_clients" name="email_clients" value="1"'.$emailClients.'>
                                <label for="email_clients">You have '.$schedule->spots_reserved($cancelDate).' clients registered </label><br>
                                <label class="alert-label"> Alert registed clients with an email</label><br>
                           </div>
                           <button type="submit" class="btn btn-red float-right">Submit</a>
                      </div>
                 </div>
            </form>';
          return $output;
     }
}
