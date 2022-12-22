<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\BusinessCompanyDetail;
use App\BusinessServices;
use App\UserBookingStatus;
use App\BusinessActivityScheduler;
use App\StaffMembers;
use App\UserBookingDetail;
use App\ActivityCancel;
use Auth;
use DB;
use Carbon\Carbon;
use DateTime;
use Config;
use DateInterval;
use App\MailService;
use App\Repositories\BusinessServiceRepository;

use App\Repositories\CustomerRepository;
use App\Repositories\UserRepository;

class SchedulerController extends Controller
{    
     protected $business_service_repo;
     protected $customers;
     protected $users;
     public function __construct(BusinessServiceRepository $business_service_repo ,CustomerRepository $customers,UserRepository $users)
     {        
          $this->business_service_repo = $business_service_repo;
          $this->users = $users;
          $this->customers = $customers;
     }

     public function index(Request $request)
     {
          $companyId = !empty(Auth::user()->cid) ? Auth::user()->cid : "";
          $companyservice  =[];
          if(!empty($companyId)) {
               $business_details = BusinessCompanyDetail::where('cid', $companyId)->get();
               $business_details = isset($business_details[0]) ? $business_details[0] : [];
               $companyservice = BusinessServices::where('userid', Auth::user()->id)->where('cid', $companyId)->orderBy('id', 'DESC')->get();
          }

          $filter_date = new DateTime();
          if($request->ajax()){
               $date = $request->date;
               $fdate = 'notodaydate';
               $new_filter_date = new DateTime($date);
               if( $request->chk == 'previous'){
                    if(date('m/d/Y') == $date){
                         $fdate = "today";
                    }
                    $new_filter_date  = $new_filter_date->sub(new DateInterval('P1D'));
               }elseif($request->chk == 'next'){
                    if(date('m/d/Y') == $date){
                         $fdate = "today";
                    }
                    $new_filter_date  = $new_filter_date->add(new DateInterval('P1D'));
               }
               
               $is_today = 'notoday';
               if($filter_date->format('l, F j , Y') == $new_filter_date->format('l, F j , Y')){
                   $is_today = 'today';
               }
               $sc_date = $new_filter_date->format('l, F j , Y');
               $html = '';
               $total_reservations = 0;

               if($request->dropval == 'individual' || $request->dropval == 'events' || $request->dropval =='experience' || $request->dropval== 'classes'){
                    $chkval = $request->dropval ;

                    $bookschedulers = BusinessActivityScheduler::alldayschedule($new_filter_date,$chkval )->whereIn('serviceid', $companyservice->pluck('id'))->get();
               }else{
                    $bookschedulers = BusinessActivityScheduler::alldayschedule($new_filter_date,'')->whereIn('serviceid', $companyservice->pluck('id'))->get();
               }

               if(!empty($bookschedulers) && count($bookschedulers)>0){
                    foreach ($bookschedulers as $cs => $bookscheduler){

                         $total_reservations += $bookscheduler->spots_reserved($new_filter_date);
                         $date1 = date('H:i',strtotime($bookscheduler['shift_end']));
                         if($is_today == 'today'){
                              $date2 = date('H:i');
                         }else{
                              $date2 = date('H:i',strtotime($date));
                         }
                         $cancel_chk = $bookscheduler->getcanceldata($new_filter_date, $bookscheduler->id);
                        /* echo $date1;
                         echo $date2;
                         exit;*/
                         if($date1 < $date2){
                              $html .= '<div class="overlay-activity">
                              <label class="overlay-activity-label">Activity Completed</label>';
                         }elseif($cancel_chk == 1){
                              $html .= '<div class="overlay-activity">
                              <label class="overlay-activity-label red-fonts">Activity Cancelled</label>';
                         }

                         $html .= '<div class="scheduler-info-box">
                              <div class="row">
                                   <div class="col-md-1 col-xs-12 col-sm-4">
                                        <div class="timeline">
                                             <label class="scheduler-titles">Time: </label> <span> '.date('h:i A', strtotime($bookscheduler['shift_start'])).' </span>
                                             <span>'.date('h:i A', strtotime($bookscheduler['shift_end'])).'</span>
                                        </div>
                                   </div>
                                   <div class="col-md-1 col-xs-12 col-sm-4">    
                                        <a href="'.Config::get('constants.SITE_URL').'/scheduler-checkin/'.$bookscheduler->id.'" class="scheduler-qty">
                                             <label class="scheduler-titles">QTY: </label> <span> '.$bookscheduler->spots_left($new_filter_date).'/'.$bookscheduler->spots_available.' </span>
                                        </a>
                                   </div>
                                   <div class="col-md-1 col-xs-12 col-sm-4">
                                        <div class="scheduled-activity-info">
                                             <label class="scheduler-titles"> Duration: </label> <span>'.$bookscheduler->get_clean_duration().' </span>
                                        </div>
                                   </div>
                                   <div class="col-md-3 col-xs-12 col-sm-4">
                                        <div class="scheduled-activity-info">
                                             <label class="scheduler-titles"> Scheduled Activity: </label> <span> '.$bookscheduler->business_service->program_name.'</span>
                                        </div>
                                   </div>
                                   <div class="col-md-2 col-xs-12 col-sm-4">
                                        <div class="scheduled-location">
                                             <label class="scheduler-titles"> Location: </label> <span> '.$bookscheduler->business_service->activity_location.'</span>
                                        </div>
                                   </div>
                                   <div class="col-md-2 col-xs-12 col-sm-4">
                                        <div class="scheduled-location">
                                             <label class="scheduler-titles"> Instructor: </label><span> '.StaffMembers::getinstructorname($bookscheduler->business_service->instructor_id).'</span>
                                        </div>
                                   </div>
                                   <div class="col-md-2 col-xs-12 col-sm-12">
                                        <form id="frmCompany<?=$cs?>" name="frmCompany<?=$cs?>" method="post" action="'.route('editBusinessService').'">
                                             <input name="_token" type="hidden" value="'.csrf_token().'">
                                             <div class="scheduled-btns">
                                                  <input type="hidden" class="btn btn-black" name="btnedit" id="btnedit" value="Edit" />
                                                  <input type="hidden" name="cid" value="'. $bookscheduler->business_service->cid .'" style="width:50px" />
                                                  <input type="hidden" name="serviceid" value="'. $bookscheduler->business_service->serviceid .'" style="width:50px" />
                                                  <button type="submit" class="btn-edit btn-sp">Edit</button>';
                                                  if($date1 < $date2){
                                                       $html .= '<button type="button" class="btn-edit" disabled>Cancel</button>';
                                                  }else{
                                                       $stffname = StaffMembers::getinstructorname($bookscheduler->business_service->instructor_id);
                                                       $spottotal = $bookscheduler->spots_reserved($filter_date);
                                                       $ajaxval = $bookscheduler->id.",'".$stffname."','".$stffname."'";
                                                       $html .= '<a class="btn-edit" onclick="getcancellationdata('.$ajaxval.');">Cancel</a>';
                                                  }
                                             $html .= '</div>
                                        </form>
                                   </div>
                              </div>
                         </div>';
                         if($date1 < $date2){
                              $html .= '</div>';
                         }elseif($cancel_chk == 1){
                              $html .= '</div>';
                         }
                    }
               }

               echo $html.'^'.count($bookschedulers).'^^'.$total_reservations.'~'.$sc_date.'$!^'.$fdate;exit;
          }

          $bookschedulers = BusinessActivityScheduler::alldayschedule($filter_date,'')->whereIn('serviceid', $companyservice->pluck('id'))->get();
          /*print_r($bookschedulers);exit;*/
          return view('scheduler.index', [
               'companyId' => $companyId,
               'business_details' => $business_details,
               'companyservice' => $companyservice,
               'todaydate'=>$filter_date->format('l, F j , Y'),
               'bookschedulers' => $bookschedulers,
               'filter_date' => $filter_date,
          ]);
     }

     public function scheduler_checkin($sid){
          $companyId = !empty(Auth::user()->cid) ? Auth::user()->cid : "";
          $companyservice  =[];
          if(!empty($companyId)) {
               $business_details = BusinessCompanyDetail::where('cid', $companyId)->get();
               $business_details = isset($business_details[0]) ? $business_details[0] : [];
          }
          $filter_date = new DateTime();
          $schedule_data = BusinessActivityScheduler::findById($sid);
          $servicedata = $this->business_service_repo->findById(@$schedule_data->serviceid);
     
          $pricrdropdown = BusinessServices::find(@$schedule_data->serviceid)->price_details;
          $bookingdata = UserBookingDetail::where('sport',@$schedule_data->serviceid)->where('act_schedule_id',$sid)->where('bookedtime',date('Y-m-d'))->get();
          return view('scheduler.scheduler_checkin', [
               'business_details' => $business_details,
               'companyId' => $companyId,
               'schedule_data' =>$schedule_data,
               'servicedata' =>$servicedata,
               'filter_date' => $filter_date,
               'bookingdata' => $bookingdata,
               'pricrdropdown' => $pricrdropdown,
               'todaydate'=>$filter_date->format('l, F j , Y'),
          ]);
     }

     public function searchcustomerbooking(Request $request) {
          $filter_date = new DateTime();
          if($request->get('query'))
          {
               $array_data=array();
               $query = $request->get('query');
          
               $data_cus = $this->customers->findByfname($query); 

               $data_user = $this->users->findByfname($query); 
               
               foreach($data_cus as $cuss)
               {  
                    $array_data [] = $cuss->id;
               }

               foreach($data_user as $user)
               {  
                    $array_data [] = $user->id;
               }

               sort($array_data);
          }

          $schedule_data = BusinessActivityScheduler::findById($request->sid);
          $servicedata = $this->business_service_repo->findById(@$schedule_data->serviceid);

          $pricrdropdown = BusinessServices::find(@$schedule_data->serviceid)->price_details;
          $bookingdata = UserBookingDetail::where('sport',@$schedule_data->serviceid)->where('act_schedule_id',$request->sid)->where('bookedtime',date('Y-m-d'))->get();
          $output = '';

          if(!empty($bookingdata) && count($bookingdata) > 0){
               foreach($bookingdata as $bd){
                    if($request->get('query') != ''){
                         if(in_array($bd->booking->user->id ,$array_data)){
                              $output .='<div class="scheduler-info-box">
                                   <div class="row">
                                        <div class="col-md-2 col-xs-12 col-sm-4">
                                             <div class="scheduler-border scheduler-label">
                                                  <a><i class="fas fa-times"></i></a>
                                                  <div class="checkbox-check">
                                                       <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                                       <label for="vehicle1"> Check In</label><br>
                                                       <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
                                                       <label for="vehicle2"> Late Cancel</label><br>
                                                       <a class="btn-edit" data-toggle="modal" data-target="#latecancel">Modal</a>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="col-md-1 col-xs-3 col-sm-4">     
                                             <div class="scheduler-qty">
                                                  <span> '.$bd->booking->user->firstname[0].''.$bd->booking->user->lastname[0].'</span>
                                             </div>
                                        </div>
                                        <div class="col-md-2 col-xs-9 col-sm-4">
                                             <div class="scheduled-activity-info">
                                                  <label class="scheduler-titles">Client Name: </label> <span>'.$bd->booking->user->firstname.' '.$bd->booking->user->lastname.'</span>
                                             </div>
                                        </div>
                                        <div class="col-md-2 col-xs-12 col-sm-4">
                                             <div class="scheduled-activity-info">
                                                  <div class="price-mobileview">
                                                       <label class="scheduler-titles">Price Title:</label>
                                                       <select name="frm_servicesport" id="frm-servicesport" class="form-control valid price-info">';
                                                            foreach($pricrdropdown as $bp){
                                                                 $output .='<option value="'.$bp["id"].'"';
                                                                 if($bd->priceid == $bp["id"]){
                                                                      $output .='selected';
                                                                 } 
                                                                 $output .='>'.$bp["price_title"].'</option>';
                                                            }
                                                       $output .='</select>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="col-md-2 col-xs-12 col-sm-4">
                                             <div class="scheduled-location">
                                                  <label class="scheduler-titles">Remaining: </label> <span>'.$schedule_data->spots_left($filter_date).'/'.$schedule_data->spots_available.'</span>
                                             </div>
                                        </div>
                                        <div class="col-md-1 col-xs-12 col-sm-4">
                                             <div class="scheduled-location">
                                                  <label class="scheduler-titles">Expiration: </label><span> '.date('m/d/Y',strtotime($schedule_data->end_activity_date)).' </span>
                                             </div>
                                        </div>
                                        <div class="col-md-2 col-xs-12 col-sm-12">
                                             <div class="scheduled-btns">
                                                  <a href="'.route('activity_purchase').'" class="btn-edit btn-sp">Purchase</a>
                                                  <button type="button" class="btn-edit">View Account</button>
                                             </div>
                                        </div>
                                   </div>
                              </div>';
                         }
                    }else{
                         $output .='<div class="scheduler-info-box">
                                   <div class="row">
                                        <div class="col-md-2 col-xs-12 col-sm-4">
                                             <div class="scheduler-border scheduler-label">
                                                  <a><i class="fas fa-times"></i></a>
                                                  <div class="checkbox-check">
                                                       <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
                                                       <label for="vehicle1"> Check In</label><br>
                                                       <input type="checkbox" id="vehicle2" name="vehicle2" value="Car">
                                                       <label for="vehicle2"> Late Cancel</label><br>
                                                       <a class="btn-edit" data-toggle="modal" data-target="#latecancel">Modal</a>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="col-md-1 col-xs-3 col-sm-4">     
                                             <div class="scheduler-qty">
                                                  <span> '.$bd->booking->user->firstname[0].''.$bd->booking->user->lastname[0].'</span>
                                             </div>
                                        </div>
                                        <div class="col-md-2 col-xs-9 col-sm-4">
                                             <div class="scheduled-activity-info">
                                                  <label class="scheduler-titles">Client Name: </label> <span>'.$bd->booking->user->firstname.' '.$bd->booking->user->lastname.'</span>
                                             </div>
                                        </div>
                                        <div class="col-md-2 col-xs-12 col-sm-4">
                                             <div class="scheduled-activity-info">
                                                  <div class="price-mobileview">
                                                       <label class="scheduler-titles">Price Title:</label>
                                                       <select name="frm_servicesport" id="frm-servicesport" class="form-control valid price-info">';
                                                            foreach($pricrdropdown as $bp){
                                                                 $output .='<option value="'.$bp["id"].'"';
                                                                 if($bd->priceid == $bp["id"]){
                                                                      $output .='selected';
                                                                 } 
                                                                 $output .='>'.$bp["price_title"].'</option>';
                                                            }
                                                       $output .='</select>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class="col-md-2 col-xs-12 col-sm-4">
                                             <div class="scheduled-location">
                                                  <label class="scheduler-titles">Remaining: </label> <span>'.$schedule_data->spots_left($filter_date).'/'.$schedule_data->spots_available.'</span>
                                             </div>
                                        </div>
                                        <div class="col-md-1 col-xs-12 col-sm-4">
                                             <div class="scheduled-location">
                                                  <label class="scheduler-titles">Expiration: </label><span> '.date('m/d/Y',strtotime($schedule_data->end_activity_date)).' </span>
                                             </div>
                                        </div>
                                        <div class="col-md-2 col-xs-12 col-sm-12">
                                             <div class="scheduled-btns">
                                                  <a href="'.route('activity_purchase').'" class="btn-edit btn-sp">Purchase</a>
                                                  <button type="button" class="btn-edit">View Account</button>
                                             </div>
                                        </div>
                                   </div>
                              </div>';
                    }
                    
               }
          }
          return $output;
     }

     public function booking_request(){
          return view('scheduler.booking_request');
     }

     public function activity_purchase(){
          return view('scheduler.activity_purchase');
     }


     public function cancelbookingmodel(Request $request){
          $ac_data = ActivityCancel::where('cancel_date',date('y-m-d' , strtotime($request->date)))->where('schedule_id',$request->sid)->first();
          $output = '';
          $output .='<form method="post" action="'.route("submitcancelbooking").'">
                    <input type="hidden" name="_token" value="'.csrf_token().'">
                    <input type ="hidden" name="can_id" value="'.@$ac_data->id.'">
                    <input type="hidden" name="schedule_id" value="'.$request->sid.'">
                    <input type="hidden" name="cancel_date" value="'.$request->date.'">
                    <div class="row">
                         <div class="col-md-12">
                              <div class="">
                                   <input type="checkbox" id="cancel_date_chk" name="cancel_date_chk" value="1"';
                                   if(@$ac_data->cancel_date_chk == 1){
                                        $output .='checked';
                                   }
                                   $output .='>
                                   <label for="vehicle1"> Cancel this activity for today only</label><br>
                                   <input type="checkbox" id="show_cancel_on_schedule" name="show_cancel_on_schedule" value="1"';
                                   if(@$ac_data->show_cancel_on_schedule == 1){
                                        $output .='checked';
                                   }
                                   $output .='>
                                   <label for="vehicle2">Show cancellation on schedule</label><br>
                                   <input type="checkbox" id="hide_cancel_on_schedule" name="hide_cancel_on_schedule" value="1"';
                                   if(@$ac_data->hide_cancel_on_schedule == 1){
                                        $output .='checked';
                                   }
                                   $output .='>
                                   <label for="vehicle3">Hide cancellation on schedule</label><br>
                              </div>
                         </div>
                    </div>
                    <hr style="border: 1px solid #efefef; width: 107%; margin-left: -15px; margin-top: 15px;">
                    <div class="row">
                         <div class="col-md-12">
                               <h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 500; font-size: 15px; margin-bottom: 15px">Alert others of the cancellations</h4> 
                              <div class="">
                                   <input type="checkbox" id="email_Instructor" name="email_Instructor" value="1"';
                                   if(@$ac_data->email_Instructor == 1){
                                        $output .='checked';
                                   }
                                   $output .='>
                                   <label for="vehicle1">Email '.$request->insname.'</label><br>
                                   <input type="checkbox" id="email_clients" name="email_clients" value="1"';
                                   if(@$ac_data->email_clients == 1){
                                        $output .='checked';
                                   }
                                   $output .='>
                                   <label for="vehicle2">You have '.$request->clientcnt.' clients registered </label><br>
                                   <label class="alert-label"> Alert registed clients with an email</label><br>
                              </div>
                              <button type="submit" class="btn-nxt manage-cus-btn cancel-modal">Submit</a>
                         </div>
                    </div>
               </form>';
          return $output;
     }

     public function submitcancelbooking(Request $request){
          if($request->has('cancel_date_chk')){
               $mail_type = 'cancel';
               $cancel_date_chk = 1;
               $act_cancel_chk = 1;
          }else{
               $mail_type = 'reschedule';
               $cancel_date_chk = 0;
               $act_cancel_chk = 0;
          }

          if($request->can_id == ''){
               $data = $request->all();
               if(@$data['cancel_date'] != ''){
                    $data['cancel_date'] = date('Y-m-d',strtotime($request->cancel_date));
               }
               $position = array_search(request()->_token, $data);
               unset($data[$position]);

               ActivityCancel::create($data);

          }else{
               echo "else";
               if($request->has('show_cancel_on_schedule')){
                    $show_cancel_on_schedule = 1;
               }else{
                    $show_cancel_on_schedule = 0;
               }

               if($request->has('hide_cancel_on_schedule')){
                    $hide_cancel_on_schedule = 1;
               }else{
                    $hide_cancel_on_schedule = 0;
               }

               if($request->has('email_Instructor')){
                    $email_Instructor = 1;
               }else{
                    $email_Instructor = 0;
               }

               if($request->has('email_clients')){
                    $email_clients = 1;
               }else{
                    $email_clients = 0;
               }

               $ac_data = ActivityCancel::where('id',$request->can_id)->update(['show_cancel_on_schedule'=>$show_cancel_on_schedule,'hide_cancel_on_schedule'=>$hide_cancel_on_schedule,'email_Instructor'=>$email_Instructor,'email_clients'=>$email_clients,'act_cancel_chk'=>$act_cancel_chk ,'cancel_date_chk'=>$cancel_date_chk]);
          }

          if($request->has('email_clients')){
              $databooked = UserBookingDetail::where('act_schedule_id', $request->schedule_id)->where('bookedtime' ,date('Y-m-d',strtotime($request->cancel_date)))->get();
               foreach($databooked as $db){
                    $data = [];
                    if($db->booking->user_type == 'user'){
                         $userdata = $db->booking->user;
                    }elseif($db->booking->user_type == 'customer'){
                         $userdata = $db->booking->customer;
                    }  

                    $businessdata = $db->business_services;
                    $companydata = $db->business_services->company_information;
                    $time = date('h:i a',strtotime($db->business_activity_scheduler->shift_start));
                    $date = $request->cancel_date;
                    $status = MailService::sendEmailforcancelschedule($userdata , $businessdata ,$companydata,$time,$date,$db->booking->user_type,$mail_type);
               } 
          }

         
          /*print_r($databooked);exit;*/
          return redirect('manage-scheduler');
     }

     /*public function email(){
          @$data['cancel_date'] = '12/21/2022';
          $databooked = UserBookingDetail::where('act_schedule_id', 1109)->where('bookedtime' ,date('Y-m-d',strtotime(@$data['cancel_date'])))->get();
               foreach($databooked as $db){
                    $data = [];
                    if($db->booking->user_type == 'user'){
                         $userdata = $db->booking->user;
                    }elseif($db->booking->user_type == 'customer'){
                         $userdata = $db->booking->customer;
                    }  

                    $businessdata = $db->business_services;
                    $companydata = $db->business_services->company_information;
                    $time = date('h:i a',strtotime($db->business_activity_scheduler->shift_start));
                    $date = '12/21/2022';
                    $usertype = $db->booking->user_type;
                    //$status = MailService::sendEmailforcancelschedule($userdata , $businessdata ,$companydata,$time,$date,$db->booking->user_type);
               } 
          return view('emails.schedule-cancel',compact('businessdata','companydata','time','date','userdata','usertype'));
     }*/
}
