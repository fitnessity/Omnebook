<?php
namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use App\{BusinessStaff,BusinessActivityScheduler,BusinessPriceDetailsAges,ActivityCancel,BookingCheckinDetails,SGMailService};
use Auth;
use DB;
use Carbon\Carbon;
use DateTime;
use Config;
use DateInterval;
use DateTimeZone;
use Illuminate\Support\Facades\Session;
use App\BusinessServices;
class SchedulerController extends BusinessBaseController
{  
     public function __construct(){ 
     }

     public function index(Request $request){
          $filterDate = Carbon::parse($request->date);
          // \DB::enableQueryLog(); 
          // $schedules = BusinessActivityScheduler::alldayschedule($filterDate,$request->activity_type)->where('cid', $request->current_company->id)->get();
          // dd(\DB::getQueryLog()); 

          $services = BusinessServices::where('cid', $request->current_company->id)->where('is_active','1')->get();
          $categoryIds = [];

          foreach ($services as $service) {
               $priceDetails = BusinessPriceDetailsAges::where('serviceid', $service->id)
                                   ->where('class_type', $service->service_type)->where('stype','1')
                                   ->get();
               
               foreach ($priceDetails as $priceDetail) {
                    $categoryIds[] = $priceDetail->id;
               }
          }

          $schedules = BusinessActivityScheduler::alldayschedule($filterDate, $request->activity_type)
                         ->where('cid', $request->current_company->id)
                         ->whereIn('category_id', $categoryIds)
                         ->get();

          return view('business.scheduler.index', [
              'schedules' => $schedules, 
              'filterDate' => $filterDate,
          ]);
     }

     public function create(Request $request , $business_id, $categoryId= null){
          if($request->session){
               Session::put('scheduleEdit', $request->session);
          }
          $category =  BusinessPriceDetailsAges::where('id',$request->categoryId)->first();
          $staffData = BusinessStaff::where('business_id',$business_id)->get();
          $staffDataHTml = '<input type="hidden" name="instructure[0]" value=""><select name="instructure[0][]" id="instructure0" multiple>';
          foreach($staffData as $data){
               $selected ='';
               if(@$service->instructor_id == $data->id) {
                    $selected = "selected" ;
               }
               $staffDataHTml .= '<option value="'.$data->id.'" '.$selected.'>'.$data->first_name.' '.$data->last_name.'</option>';
          }
          $staffDataHTml .= '</select>';
          $businessActivity = BusinessActivityScheduler::where('cid', $category->cid)->where('serviceid', $category->serviceid)->where('category_id',$category->id)->get();
          return view('business.scheduler.create',compact('category','businessActivity','staffData','staffDataHTml'));
     }

     public function store(Request $request){
          //print_r($request->all());exit;
          $shift_start = $request->duration_cnt;
          if($shift_start >= 0) {
               $idary = BusinessActivityScheduler::where('cid', $request->cId)->where('userid', Auth::user()->id)->where('serviceid',  $request->serviceId)->where('category_id',$request->categoryId)->pluck('id')->toArray();
     
               $idary1 = array();
               for($i=0; $i<=$shift_start; $i++) { 
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
                             "instructure_ids" => $request->instructure[$i] != ''  ? implode(',' , $request->instructure[$i]) :  '',
                             "is_active" => 1,
                         ];

                         $data = BusinessActivityScheduler::updateOrCreate(['id' => $request->id[$i]], $activitySchedulerData);
                         if($request->instructure[$i] != ''){
                              BookingCheckinDetails::where('business_activity_scheduler_id',$data->id)->whereDate('checkin_date','>=',date('Y-m-d'))->update(['instructor_id'=>implode(',' , $request->instructure[$i])]);
                         }
                    }
               }
        
               $differenceArray1 = array_diff($idary, $idary1);
               foreach($differenceArray1 as $deletdata){
                    BusinessActivityScheduler::where('id',$deletdata)->delete();
               }
          }

          /*$category = BusinessPriceDetailsAges::where('id' , $request->categoryId)->whereNotNull('class_type')->first();
          if($category){
              $service = $category->BusinessServices;
              return redirect()->to('business/'.$request->cId.'/services/create?serviceType='.$service->service_type.'&serviceId='.$request->serviceId.'#stepFour');
          }else{*/
              /*return redirect()->route('business.schedulers.create', ["business_id"=>$request->cId,"categoryId"=>$request->categoryId]);*/
          /*}*/

          if($request->has('returnUrl')){
              $category = BusinessPriceDetailsAges::where('id' , $request->categoryId)->whereNotNull('class_type')->first();
              $service = $category->BusinessServices;
              $url = '/business/'.$request->cId.'/services/create?serviceType='.$service->service_type.'&serviceId='.$service->id.'#stepFour';
              return redirect($url);

              //return redirect()->to($request->returnUrl);
          }else{
              return redirect()->route('business.schedulers.create', ["business_id"=>$request->cId,"categoryId"=>$request->categoryId]);
          }
     }

     public function destroy(Request $request){
          //print_r($request->all());exit;
          $mail_type = $request->has('cancel_date_chk') ? 'cancel' : 'reschedule';
          $cancel_date_chk = $request->has('cancel_date_chk') ? 1:0 ;
          $act_cancel_chk = $request->has('cancel_date_chk') ? 1:0;
          $showSchedule = $request->chk_cancel_on_schedule == 1 ? 1: 0;
          $hideSchedule = $request->chk_cancel_on_schedule == 1 ? 0: 1;
          $email_Instructor = $request->has('email_Instructor') ? 1: 0;
          $email_clients = $request->has('email_clients') ? 1: 0;
          $cancelDate = $request->cancel_date;
          $ac_data = [
              "show_cancel_on_schedule" => $showSchedule,
              "hide_cancel_on_schedule" => $hideSchedule,
              "email_Instructor" => $email_Instructor,
              "email_clients" => $email_clients,
              "act_cancel_chk" => $act_cancel_chk ,
              "cancel_date_chk" => $cancel_date_chk,
              "schedule_id" => $request->schedule_id,
              "cancel_date" => $cancelDate,
          ];

          ActivityCancel::updateOrCreate(['id' => $request->can_id], $ac_data);

          if($request->has('email_clients')){
               $checkInDetails = BookingCheckinDetails::where('business_activity_scheduler_id', $request->schedule_id)->where('checkin_date' ,$cancelDate)->get();
               foreach($checkInDetails as $cid){
                    $userdata = $cid->customer;
                    $businessdata = $cid->order_detail->business_services;
                    $companydata = $cid->order_detail->business_services->company_information;
                    $time = date('h:i a',strtotime($cid->scheduler->shift_start));
                    $date = date('m-d-Y', strtotime($request->cancel_date));
                    $emailDetail = [
                         "userdata"=>$userdata,
                         "pName"=>$businessdata->program_name,
                         "companydata"=>$companydata,
                         "time"=>$time,
                         "date"=>$date,
                         "mail_type"=>$mail_type,
                         "email"=>$userdata->email,
                    ];
                    $status = SGMailService::bookingCancellationToCustomer($emailDetail);
               } 
          }

          if($request->has('email_Instructor')){
               $checkInDetails = BookingCheckinDetails::where('business_activity_scheduler_id', $request->schedule_id)->where('checkin_date' ,$cancelDate)->groupBy('instructor_id')->get();

               foreach($checkInDetails as $cid){
                    $insIdsArray = explode(',', $cid->instructor_id);
                    $businessdata = $cid->order_detail->business_services;
                    $companydata = $cid->order_detail->business_services->company_information;
                    $time = date('h:i a',strtotime($cid->scheduler->shift_start));
                    $date = date('m-d-Y', strtotime($request->cancel_date));
                    if(!empty($insIdsArray)){
                         foreach($insIdsArray as $ins){
                              $insdata = BusinessStaff::find($ins);
                              if(@$insdata->email != ''){
                                  $emailDetail = [
                                        "insdata"=>$insdata,
                                        "pName"=>$businessdata->program_name,
                                        "companydata"=>$companydata,
                                        "time"=>$time,
                                        "date"=>$date,
                                        "email"=>$insdata->email,
                                        "mail_type"=>$mail_type,
                                   ];
                                   $status = SGMailService::bookingCancellationToTrainer($emailDetail);
                              }
                         }
                    }
               }
          }

          return redirect($request->return_url);
     }

     public function delete_modal(Request $request){
          $scheduleIds = $request->schedulerId;
          $cancelDate = Carbon::parse($request->date);
          $schedule = BusinessActivityScheduler::alldayschedule($cancelDate,'')->where('cid', $request->current_company->id)->findOrFail($request->schedulerId);

          $activityCancel = ActivityCancel::where('cancel_date', $cancelDate->format("Y-m-d"))->where('schedule_id',$schedule->id)->first();
          $cancelDateChk = @$activityCancel->cancel_date_chk == 1 ? 'checked': '' ;
          $showCancelOnSchedule = @$activityCancel->show_cancel_on_schedule == 1 ? 'checked': '' ;
          $hideCancelOnSchedule = @$activityCancel->hide_cancel_on_schedule == 1 ? 'checked': '' ;
          $emailInstructor = @$activityCancel->email_Instructor == 1 ? 'checked': '' ;
          $emailClients = @$activityCancel->email_clients == 1 ? 'checked': '' ;
          $return_url = $request->return_url;
          return view('business.scheduler.cancel',compact('cancelDateChk','showCancelOnSchedule','hideCancelOnSchedule','emailInstructor','emailClients','return_url','schedule','cancelDate','activityCancel','scheduleIds'));        
     }

     public function cancel_all(Request $request , $business_id){
          $scheduleIds = $request->schedulerId;
          $scheduleIdsArray = explode(',', $scheduleIds);
          $cancelDate = Carbon::parse($request->date);
          $schedule = BusinessActivityScheduler::alldayschedule($cancelDate,'')->where('cid', $business_id)->get();
          $activityCancel = ActivityCancel::where('cancel_date', $cancelDate->format("Y-m-d"))->whereIn('schedule_id',$scheduleIdsArray)->get();

          $cancelDateChk = $activityCancel->count() == $schedule->count() && @$activityCancel->first()->cancel_date_chk == 1 ? 'checked': '' ;
          $showCancelOnSchedule = $activityCancel->count() == $schedule->count() && @$activityCancel->first()->show_cancel_on_schedule == 1 ? 'checked': '' ;
          $hideCancelOnSchedule = $activityCancel->count() == $schedule->count() && @$activityCancel->first()->hide_cancel_on_schedule == 1 ? 'checked': '' ;
          $emailInstructor = $activityCancel->count() == $schedule->count() && @$activityCancel->first()->email_Instructor == 1 ? 'checked': '' ;
          $emailClients = $activityCancel->count() == $schedule->count() && @$activityCancel->first()->email_clients == 1 ? 'checked': '' ;
          $return_url = $request->return_url;
          $checkInDetails = BookingCheckinDetails::whereIn('business_activity_scheduler_id', $scheduleIdsArray)->where('checkin_date' ,$cancelDate->format("Y-m-d"))->get();
          $totalRegisteredClient = $checkInDetails->count();
          return view('business.scheduler.cancel_all',compact('cancelDateChk','showCancelOnSchedule','hideCancelOnSchedule','emailInstructor','emailClients','return_url','schedule','cancelDate','activityCancel','scheduleIds','totalRegisteredClient'));        
     }

     public function cancel_all_store(Request $request,$business_id){
          //print_r($request->all());exit;
          $mail_type = $request->has('un_cancel_date_chk') ? 'reschedule' : 'cancel';
          $chk_uncancel_btn =  $request->has('un_cancel_date_chk') ? 1: 0; 
          $cancel_date_chk = $chk_uncancel_btn == 0 ? 1 : 0;
          $act_cancel_chk =  $chk_uncancel_btn == 0 ? 1:0;
          $showSchedule = $request->chk_cancel_on_schedule == 1 ? 1: 0;
          $hideSchedule = $request->chk_cancel_on_schedule == 1 ? 0: 1;
          $email_Instructor = $request->has('email_Instructor') ? 1: 0;
          $email_clients = $request->has('email_clients') ? 1: 0;
          $cancelDate = date('Y-m-d',strtotime($request->cancel_date));
          $ac_data = [
              "show_cancel_on_schedule" => $showSchedule,
              "hide_cancel_on_schedule" => $hideSchedule,
              "email_Instructor" => $email_Instructor,
              "email_clients" => $email_clients,
              "act_cancel_chk" => $act_cancel_chk ,
              "cancel_date_chk" => $cancel_date_chk,
              "schedule_id" => '',
              "cancel_date" => $cancelDate,
          ];

          $scheduleIdsArray  = explode(',', $request->schedule_id);
          foreach ($scheduleIdsArray  as $sid) {
               $ac_data['schedule_id'] = $sid;
               $cancelAct = ActivityCancel::updateOrCreate(
                   ['schedule_id' => $sid, 'cancel_date' => $cancelDate],
                   $ac_data
               );
          }

          if($request->has('email_clients')){
               $checkInDetails = BookingCheckinDetails::whereIn('business_activity_scheduler_id', $scheduleIdsArray)->where('checkin_date' ,$cancelDate)->get();
               foreach($checkInDetails as $cid){
                    $userdata = $cid->customer; 
                    $businessdata = $cid->order_detail->business_services;
                    $companydata = $cid->order_detail->business_services->company_information;
                    $time = date('h:i a',strtotime($cid->scheduler->shift_start));
                    $date = date('m-d-Y', strtotime($request->cancel_date));
                    $emailDetail = [
                         "userdata"=>$userdata,
                         "pName"=>$businessdata->program_name,
                         "companydata"=>$companydata,
                         "time"=>$time,
                         "date"=>$date,
                         "mail_type"=>$mail_type,
                         "email"=>$userdata->email,
                    ];
                    $status = SGMailService::bookingCancellationToCustomer($emailDetail);
               } 
          }

          if($request->has('email_Instructor')){
               $checkInDetails = BookingCheckinDetails::whereIn('business_activity_scheduler_id',$scheduleIdsArray)->where('checkin_date' ,$cancelDate)->groupBy('instructor_id')->get();
          
               foreach($checkInDetails as $cid){
                    $insIdsArray = explode(',', $cid->instructor_id);
                    $businessdata = $cid->order_detail->business_services;
                    $companydata = $cid->order_detail->business_services->company_information;
                    $time = date('h:i a',strtotime($cid->scheduler->shift_start));
                    $date = date('m-d-Y', strtotime($request->cancel_date));
                    if(!empty($insIdsArray)){
                         foreach($insIdsArray as $ins){
                              $insdata = BusinessStaff::find($ins);
                              if(@$insdata->email != ''){
                                   $emailDetail = [
                                        "insdata"=>$insdata,
                                        "pName"=>$businessdata->program_name,
                                        "companydata"=>$companydata,
                                        "time"=>$time,
                                        "date"=>$date,
                                        "email"=>$insdata->email,
                                        "mail_type"=>$mail_type,
                                   ];
                                   $status = SGMailService::bookingCancellationToTrainer($emailDetail);
                              }
                         }
                    }
               }
          }

          return redirect($request->return_url);
     }

     public function cancel_all_by_date(Request $request , $business_id){
          return view('business.scheduler.cancel_all_by_date');        
     }

     public function cancel_all_by_date_store(Request $request,$business_id){
          print_r($request->all());
          $mail_type = $request->has('cancelStatus') ? 'cancel' : 'reschedule';
          $cancel_date_chk = $request->cancelStatus;
          $act_cancel_chk =  $request->cancelStatus;
          $showSchedule = $request->chk_cancel_on_schedule == 1 ? 1: 0;
          $hideSchedule = $request->chk_cancel_on_schedule == 1 ? 0: 1;
          $email_Instructor = $request->has('email_Instructor') ? 1: 0;
          $email_clients = $request->has('email_clients') ? 1: 0;
          
          $ac_data = [
              "show_cancel_on_schedule" => $showSchedule,
              "hide_cancel_on_schedule" => $hideSchedule,
              "email_Instructor" => $email_Instructor,
              "email_clients" => $email_clients,
              "act_cancel_chk" => $act_cancel_chk ,
              "cancel_date_chk" => $cancel_date_chk,
              "schedule_id" => '',
          ];

          $dates = explode(', ', $request->dates);
          foreach($dates as $d){
               $date = Carbon::parse($d);
               $scheduleIdsArray = BusinessActivityScheduler::alldayschedule($date,$request->activity_type)->where('cid', $business_id)->pluck('id')->toArray();
               foreach ($scheduleIdsArray  as $sid) {
                    $ac_data['cancel_date'] = $d;
                    $ac_data['schedule_id'] = $sid;
                    $cancelAct = ActivityCancel::updateOrCreate(
                        ['schedule_id' => $sid, 'cancel_date' => $d],
                        $ac_data
                    );
               }

               if($request->has('email_clients')){
                    $checkInDetails = BookingCheckinDetails::whereIn('business_activity_scheduler_id', $scheduleIdsArray)->where('checkin_date' ,$d)->get();
                    foreach($checkInDetails as $cid){
                         $emailDetail = [
                              "userdata"=> $cid->customer,
                              "pName"=> $cid->order_detail->business_services,
                              "companydata"=> $cid->order_detail->business_services->company_information,
                              "time"=> date('h:i a',strtotime($cid->scheduler->shift_start)),
                              "date"=> date('m-d-Y', strtotime($d)),
                              "mail_type"=>$mail_type,
                              "email"=> $cid->customer->email,
                         ];
                         $status = SGMailService::bookingCancellationToCustomer($emailDetail);
                    } 
               }

               if($request->has('email_Instructor')){
                    $checkInDetails = BookingCheckinDetails::whereIn('business_activity_scheduler_id',$scheduleIdsArray)->where('checkin_date' ,$d)->groupBy('instructor_id')->get();
               
                    foreach($checkInDetails as $cid){
                         $insIdsArray = explode(',', $cid->instructor_id);
                         if(!empty($insIdsArray)){
                              foreach($insIdsArray as $ins){
                                   $insdata = BusinessStaff::find($ins);
                                   if(@$insdata->email != ''){
                                        $emailDetail = [
                                             "insdata"=>$insdata,
                                             "pName"=> $cid->order_detail->business_services,
                                             "companydata"=> $cid->order_detail->business_services->company_information,
                                             "time"=>date('h:i a',strtotime($cid->scheduler->shift_start)),
                                             "date"=>date('m-d-Y', strtotime($d)),
                                             "email"=>$insdata->email,
                                             "mail_type"=>$mail_type,
                                        ];
                                        $status = SGMailService::bookingCancellationToTrainer($emailDetail);
                                   }
                              }
                         }
                    }
               }
          }

          return redirect()->route('business.schedulers.index');
     }
}
