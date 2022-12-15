<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\BusinessCompanyDetail;
use App\BusinessServices;
use App\UserBookingStatus;
use App\BusinessActivityScheduler;
use App\StaffMembers;
use Auth;
use DB;
use Carbon\Carbon;
use DateTime;
use Config;
use DateInterval;
use App\Repositories\BusinessServiceRepository;

class SchedulerController extends Controller
{    
     protected $business_service_repo;
     public function __construct(BusinessServiceRepository $business_service_repo)
     {        
          $this->business_service_repo = $business_service_repo;
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
               $new_filter_date = new DateTime($date);
               if( $request->chk == 'previous'){
                    $new_filter_date  = $new_filter_date->sub(new DateInterval('P1D'));
               }elseif($request->chk == 'next'){
                    $new_filter_date  = $new_filter_date->add(new DateInterval('P1D'));
               }
               
               $is_today = 'notoday';
               if($filter_date->format('l, F j , Y') == $new_filter_date->format('l, F j , Y')){
                   $is_today = 'today';
               }
               $sc_date = $new_filter_date->format('l, F j , Y');
               $html = '';
               $total_reservations = 0;
               $bookschedulers = BusinessActivityScheduler::alldayschedule($new_filter_date)->whereIn('serviceid', $companyservice->pluck('id'))->get();
               /*echo count( $bookschedulers);
               print_r( $bookschedulers);exit;*/
               if(!empty($bookschedulers) && count($bookschedulers)>0){
                    foreach ($bookschedulers as $cs => $bookscheduler){
                         $total_reservations += $bookscheduler->spots_reserved($new_filter_date);
                         $date1 = date('H:i',strtotime($bookscheduler['shift_end']));
                         if($is_today == 'today'){
                              $date2 = date('H:i');
                         }else{
                              $date2 = date('H:i',strtotime($date));
                         }
                        
                        /* echo $date1;
                         echo $date2;
                         exit;*/
                         if($date1 < $date2){
                              $html .= '<div class="overlay-activity">
                              <label class="overlay-activity-label">Activity Completed</label>';
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
                                                  <button type="submit" class="btn-edit btn-sp">Edit</button>
                                                  <a class="btn-edit"  data-toggle="modal" data-target="#bookingcancel">Cancel</a>
                                             </div>
                                        </form>
                                   </div>
                              </div>
                         </div>';
                         if($date1 < $date2){
                              $html .= '</div>';
                         }
                    }
               }

               echo $html.'^'.count($bookschedulers).'^^'.$total_reservations.'~'.$sc_date.'$!^'.$is_today;exit;
          }

          $bookschedulers = BusinessActivityScheduler::alldayschedule($filter_date)->whereIn('serviceid', $companyservice->pluck('id'))->get();
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
          return view('scheduler.scheduler_checkin', [
               'business_details' => $business_details,
               'companyId' => $companyId,
               'schedule_data' =>$schedule_data,
               'servicedata' =>$servicedata,
               'filter_date' => $filter_date,
               'todaydate'=>$filter_date->format('l, F j , Y'),
          ]);
     }

     public function booking_request(){
          return view('scheduler.booking_request');
     }
}
