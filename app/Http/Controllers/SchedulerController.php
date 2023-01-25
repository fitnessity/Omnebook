<?php

namespace App\Http\Controllers;

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

class SchedulerController extends Controller
{    
     protected $business_service_repo;
     protected $customers;
     protected $users;
     protected $booking_repo;

     public function __construct(BusinessServiceRepository $business_service_repo ,CustomerRepository $customers,UserRepository $users,BookingRepository $booking_repo)
     {        
          $this->business_service_repo = $business_service_repo;
          $this->users = $users;
          $this->customers = $customers;
          $this->booking_repo = $booking_repo;
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

          $booking_postorders = BookingPostorder::where('business_activity_scheduler_id',$sid)->whereRaw('date(booked_at) = ?',date('Y-m-d'))->get();

          return view('scheduler.scheduler_checkin', [
               'business_details' => $business_details,
               'companyId' => $companyId,
               'schedule_data' =>$schedule_data,
               'servicedata' =>$servicedata,
               'filter_date' => $filter_date,
               'bookingdata' => $bookingdata,
               'pricrdropdown' => $pricrdropdown,
               'todaydate'=>$filter_date->format('l, F j , Y'),
               'booking_postorders' => $booking_postorders,
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
                                                       <input type="checkbox" id="vehicle2" name="vehicle2" value="Car" data-behavior="show_latecancel">
                                                       <label for="vehicle2"> Late Cancel</label><br>
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

     public function activity_purchase($book_id = null,$cus_id =null){
          /*echo  $book_id;
          echo  $cus_id;exit;*/         
          $cart_item = [];
          if (session()->has('cart_item')) {
               $cart_item = session()->get('cart_item');
          }

          //print_r($cart_item);exit;
          $cardInfo = $userfamilydata= [];
          $book_cnt = $activated =0;
          $book_data =  $address = $username = $age = $purchasefor = $price_title = $status=  $user_data = $tax = $user_type = '';

          $companyId = !empty(Auth::user()->cid) ? Auth::user()->cid : "";
          $companyservice  =[];
          $company_info = '';
		$business_details='';
          if(!empty($companyId)) {
               $company_info = CompanyInformation::where('id', $companyId)->first();
               $business_details = BusinessCompanyDetail::where('cid', $companyId)->get();
               $business_details = isset($business_details[0]) ? $business_details[0] : [];
          }
          $tax = BusinessSubscriptionPlan::where('id',1)->first();
          $userfamilydata = [];
          $username = $address = ''; 
          $pageid  =0;
          if($book_id != '' && $book_id != '0'){
               $book_data = UserBookingDetail::getbyid($book_id);
               $user_type = @$book_data->booking->user_type ;
               if(@$book_data->booking->user_type == 'user'){
                    $username = $book_data->booking->user->firstname.' '.$book_data->booking->user->lastname;
                    $age = Carbon::parse($book_data->booking->user->birthdate)->age; 
                    $user_data = $book_data->booking->user;
                    $activated = $book_data->booking->user->activated;
                    $userfamilydata = $book_data->booking->user->user_family_details;
                    $cardInfo = $book_data->booking->user->get_stripe_card_info();
                    $address = $user_data->getaddress();
                    $pageid =  $book_data->booking->user->id;
               }else if(@$book_data->booking->user_type == 'customer'){
                    $username  = $book_data->booking->customer->fname.' '.$book_data->booking->customer->lname;
                    $age = Carbon::parse($book_data->booking->customer->birthdate)->age; 
                    $user_data = $book_data->booking->customer;
                    $activated = $book_data->booking->customer->status;
                    $userfamilydata = Customer::where('parent_cus_id',$book_data->booking->customer->id)->get();
                    $cardInfo = $book_data->booking->customer->get_stripe_card_info();
                    $address = $user_data->full_address();
                    $pageid =  $book_data->booking->customer->id;
               } 

               $book_cnt = $this->booking_repo->getbookingbyUserid( $user_data->id);
               $last_book_data = $this->booking_repo->lastbookingbyUserid( $user_data->id);
               $last_book = explode("~~", $last_book_data);
               $purchasefor  = @$last_book[0];
               $price_title  = @$last_book[1];  
          }else if($cus_id != ''){
               $user_type = 'customer';
               $customerdata = $this->customers->findById($cus_id);
               $book_data = @$customerdata->getlastbooking();
               $username  =  @$customerdata->fname.' '. @$customerdata->lname;
               $age = Carbon::parse( @$customerdata->birthdate)->age; 
               $user_data =  @$customerdata;
               $activated = @$customerdata->status;
               $userfamilydata = Customer::where('parent_cus_id',@$customerdata->id)->get();
               $cardInfo = @$customerdata->get_stripe_card_info();
               $address = @$customerdata->full_address();
               $book_id = @$customerdata->id;
               $book_cnt = $this->booking_repo->getbookingbyUserid( $user_data->id);
               $last_book_data = $this->booking_repo->lastbookingbyUserid( $user_data->id);
               $last_book = explode("~~", $last_book_data);
               $purchasefor  = @$last_book[0];
               $price_title  = @$last_book[1];
               $pageid = $cus_id;
          }

          if($activated == 0){
               $status = "InActive";
          }else{
               $status = "Active";
          }
          
          //$program_list = BusinessServices::where(['is_active'=>1, 'cid'=> $companyId])->get();
          $program_list = BusinessServices::where(['is_active'=>1, 'userid'=>Auth::user()->id])->get();

          $modelchk = 0;
          $modeldata = '';
          //session()->forget('ordermodelary');
          //$ordermodelary = array("637","638");
          //$ordermodelary = array("650","651");
          $ordermodelary = session()->get('ordermodelary');
          if(!empty($ordermodelary)){
               $modelchk = 1;
               $modeldata = $this->getmultipleodermodel($ordermodelary);
               session()->forget('ordermodelary');
          }

		
          //print_r($modeldata);exit;
          return view('scheduler.activity_purchase', [
               'company_info' => $company_info,
               'business_details' => $business_details,
               'companyId' => $companyId,
               'book_id' => $book_id,
               'book_data' => $book_data,
               'book_cnt' => $book_cnt,
               'address' => $address,
               'username' => $username,
               'age' => $age,
               'purchasefor' => $purchasefor,
               'price_title' => $price_title,
               'status' => $status,
               'program_list' => $program_list,
               'cart'=> $cart_item,
               'userfamily'=> $userfamilydata,
               'user_data'=> $user_data,
               'tax'=>  $tax, 
               'cardInfo' => $cardInfo,
               'user_type' => $user_type,
               'modelchk' => $modelchk,
               'modeldata' => $modeldata,
               'pageid' => $pageid,
          ]);
     }

     public function getmultipleodermodel($array)
     {    
          $html = '';
          $totaltax = 0;
          $subtotaltax = 0;
          $tot_dis = 0;
          $tot_tip = 0;
          $service_fee = 0;

          $html .= '<div class="row"> 
                         <div class="col-lg-4 bg-sidebar">
                              <div class="your-booking-page side-part">
                                   <div class="booking-page-meta">
                                     <a href="#" title="" class="underline"></a>
                                   </div>
                                   <div class="box-subtitle">
                                     <h4>Transaction Complete</h4>
                                     <div class="modal-inner-box">
                                         <label></label>
                                         <h3>Email Receipt</h3>
                                         <div class="form-group">
                                             <input type="text" name="email" id="email"  placeholder="youremail@abc.com" class="form-control">
                                         </div>
                                         <button class="submit-btn btn-modal-booking post-btn-red" 
                                         onclick="sendemail();">Send Email Receipt</button>
                                         <div class="reviewerro" id="reviewerro"></div>
                                     </div>
                                   </div>
                                   <div class="powered-img">
                                     <label>Powered By</label>
                                     <div class="booking-modal-logo">
                                         <img src="'.url("/public/images/fitnessity_logo1.png").'">
                                     </div>
                                   </div>
                               </div>
                         </div>
                         <div class="col-lg-8">
                              <div class="modal-booking-info">
                                   <h3>Booking Receipt</h3>';
          $idarry = '';         
          foreach($array as $or){
               $order_detail = UserBookingDetail::where('id',$or)->first();
               $idarry .= $or.',';
               $odt = $this->booking_repo->getorderdetailsfromodid($order_detail->booking_id,$or);
               $totaltax += $odt['tax_for_this'];
               $tot_dis += $odt['discount'];
               $tot_tip += $odt['tip'];
               $service_fee += $odt['service_fee'];
               $total = ($odt['totprice_for_this'] - $odt['discount']);
               $subtotaltax += $total;
               $per_total = $total; 
               $html .= '<div class="row">
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <label>BOOKING#</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <span>'. $odt['confirm_id'].'</span>
                                   </div>
                              </div>

                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <label>PROVIDER COMPANY NAME:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <span>'. $odt['company_name'].'</span>
                                   </div>
                              </div>

                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <label>PROGRAM NAME:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <span>'. $odt['program_name'].'</span>
                                   </div>
                              </div>

                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <label>CATEGORY:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <span>'. $odt['categoty_name'].'</span>
                                   </div>
                              </div>

                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                        <label>PRICE OPTION:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                   <span>'.@$odt['BusinessPriceDetails']['price_title'].'</span>
                                   </div>
                              </div>

                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                        <label>NUMBER OF SESSIONS:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                   <span>'.@$odt['BusinessPriceDetails']['pay_session'].' Session</span>
                                   </div>
                              </div>

                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                        <label>MEMBERSHIP OPTION:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                   <span>'.$odt['BusinessPriceDetails']['membership_type'].'</span>
                                   </div>
                              </div>

                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <label>PARTICIPANT QUANTITY:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                   <span>'. $odt['qty'].'</span>
                                   </div>
                              </div>

                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <label>WHO IS PRATICIPATING?</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <span>'. $odt['parti_data'].'</span>
                                   </div>
                              </div>

                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <label>ACTIVITY TYPE:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <span>'. $odt['sport_activity'].'</span>
                                   </div>
                              </div>

                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <label>SERVICE TYPE:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <span>'. $odt['select_service_type'].'</span>
                                   </div>
                              </div>

                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                        <label>MEMBERSHIP DURATION:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                   <span>'.$order_detail->expired_duration.'</span>
                                   </div>
                              </div>

                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                        <label>PURCHASE DATE:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                   <span>'.$odt['created_at'].'</span>
                                   </div>
                              </div>

                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                        <label>MEMBERSHIP ACTIVATION DATE:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                   <span>'.date('d-m-Y',strtotime($order_detail->contract_date)).'</span>
                                   </div>
                              </div>

                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                        <label>MEMBERSHIP EXPIRATION:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                   <span>'.date('d-m-Y',strtotime($order_detail->expired_at)).'</span>
                                   </div>
                              </div>';

                         /*   <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <label>TOTAL REMAINNIG:</label>
                                   </div>
                               </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <span></span>
                                   </div>
                               </div>

                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <label>EXPIRATION DATE:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <span>'. $odt['expdate'].'</span>
                                   </div>
                              </div>

                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                   <label>DATE BOOKED:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <span>'. $odt['created_at'].'</span>
                                   </div>
                              </div>

                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <label>RESERVED DATE:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <span></span>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                        <label>BOOKED BY:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                        <span>'. $odt['nameofbookedby'].'</span>
                                   </div>
                              </div>'

                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                        <label>CHECK IN DATE:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                        <span></span>
                                   </div>
                              </div>

                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                        <label>CHECK IN TIME:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                        <span></span>
                                   </div>
                              </div>

                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <label>ACTIVITY LOCATION:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <span>'. $odt['activity_location'].'</span>
                                   </div>
                              </div>

                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <label>ACTIVITY DURATION:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <span>'. $odt['time'].'</span>
                                   </div>
                              </div>

                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <label>GREAT FOR:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <span>'. $odt['activity_for'].'</span>
                                   </div>
                              </div>
                         */

                              $html .='<div class="col-md-6 col-xs-6">
                                   <div class="">
                                   <label>PRICE:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <span>$'.$odt['totprice_for_this'].'</span>
                                   </div>
                              </div>

                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                   <label style="color:#fe0000">DISCOUNT:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <span>$'.$odt['discount'].'</span>
                                   </div>
                              </div>

                              <div class="col-md-6 col-xs-6">
                                   <div class="">
                                   <label>TOTAL:</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="booking-page-meta-info">
                                       <span>$'.$per_total.'</span>
                                   </div>
                              </div>
                         </div>
                         <div class="col-md-12 col-sm-12 col-xs-12">
                              <div class="black-sparetor"></div>
                         </div>';
          }

          $idarry = rtrim($idarry,',');

         /* print_r($odt);exit;*/
          $html .= '     <input type="hidden" name="booking_id" id="booking_id" value="'.$order_detail->booking_id.'"> 
                         <input type="hidden" name="orderdetalidary[]" id="orderdetalidary" value="'.$idarry.'"> 
                         <div class="row border-xx mg-tp">
                              <div class="col-md-6 col-xs-6">
                                   <div class="total-titles">
                                        <label>PAYMENT METHOD</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="total-titles">
                                        <span>'. $odt['pmt_type'].'</span>
                                   </div>
                              </div>
                         </div>

                         <div class="row border-xx">
                              <div class="col-md-6 col-xs-6">
                                   <div class="total-titles">
                                        <label>TIP AMOUNT</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="total-titles">
                                        <span>$'.$tot_tip.'</span>
                                   </div>
                              </div>
                         </div>

                         <div class="row border-xx">
                              <div class="col-md-6 col-xs-6">
                                   <div class="total-titles">
                                        <label>DISCOUNT</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="total-titles">
                                        <span>$'.$tot_dis.'</span>
                                   </div>
                              </div>
                         </div>

                         <div class="row border-xx">
                              <div class="col-md-6 col-xs-6">
                                   <div class="total-titles">
                                        <label>TAXES AND FEES</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="total-titles">
                                        <span>$'. ($totaltax +  $service_fee ).'</span>
                                   </div>
                              </div>
                         </div>';

                         /*<div class="row border-xx">
                              <div class="col-md-6 col-xs-6">
                                   <div class="total-titles">
                                        <label>FEES</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="total-titles">
                                        <span>$'.$service_fee.'</span>
                                   </div>
                              </div>
                         </div>*/
                         $html .='<div class="row border-xx">
                              <div class="col-md-6 col-xs-6">
                                   <div class="total-titles">
                                        <label>TOTAL AMOUNT PAID</label>
                                   </div>
                              </div>
                              <div class="col-md-6 col-xs-6">
                                   <div class="total-titles">
                                        <span>$'.$odt['amount'].'</span>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>';

         return $html;
     }

     public function sendreceiptfromcheckout(Request $request){
          //print_r($request->all());
          $compare_chk=[];
          //$request->orderdetalidary = '637';
          $odetail = explode("," , $request->orderdetalidary);
          foreach($odetail as $od){
               $book_data = UserBookingDetail::getbyid($od);
               $cid = $book_data->business_services->company_information->id;
               $newary = array($cid=>array("oid"=>$od,"cid"=> $cid,"booking_id"=>$request->booking_id));
               if(in_array( $cid ,array_keys($compare_chk))){
                    foreach($compare_chk  as $chk){
                         if($chk['cid'] == $cid ){
                              $oid = $compare_chk[$cid]['oid'].','.$od;
                              $compare_chk[$cid]['oid'] = $oid;
                         }
                    }
               }else{
                    $compare_chk  = $compare_chk + $newary;
               }
               
          }
          foreach($compare_chk as $detail){
               $email_detail = array(
                    'orderdetalidary' => $detail['oid'],
                    'cid' => $detail['cid'],
                    'email' => $request->email,
                    'booking_id'=>$detail['booking_id']);
               $status = MailService::sendEmailReceiptFromCheckoutRegister($email_detail);
          }
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

         //exit;
          /*print_r($databooked);exit;*/
          return redirect('manage-scheduler');
     }

     public function activity_schedule(Request $request, $odid = null){
          $orderdata = UserBookingDetail::where('id',$odid)->first();
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

          return view('scheduler.activity_schedule',[
               'days' => $days,
               'filter_date' => $filter_date,
               'orderdata' => $orderdata,
               'odid' => $odid,
          ]);
     }

     public function all_activity_schedule(Request $request){
          $order = UserBookingStatus::where(['user_id'=>Auth::user()->id,'order_type'=>'checkout_register'])->get();
          $servicetype = 'classes';
          if($request->stype){
               $servicetype = $request->stype;
          }
          $orderdata = [];
          foreach($order as $odt){
               $orderdetaildata = UserBookingDetail::where('booking_id',$odt->id)->get();
               foreach($orderdetaildata as $odetail){
                    if($odetail->business_services->service_type ==   $servicetype && $odetail->act_schedule_id == ''){
                         $orderdata []= $odetail;
                    }
               }
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
          return view('scheduler.all_activity_schedule',[
               'days' => $days,
               'filter_date' => $filter_date,
               'orderdata' => $orderdata,
               'servicetype' => $servicetype,
          ]);
     }

     public function getdropdowndata(Request $request){
          $output = '';
          $html = '';
          if($request->chk == 'program'){
               $catelist = BusinessPriceDetailsAges::select('id','category_title')->where('serviceid',$request->sid)->get();
               $output = '<option value="">Selct Category</option>';
               foreach($catelist as $cl){
                    $output .= '<option value="'.$cl->id.'">'.$cl->category_title.'</option>';
               }
          }else if($request->chk == 'category'){
               $catedata = BusinessPriceDetailsAges::where('id',$request->sid)->first();
               $pricelist = BusinessPriceDetails::where('category_id',$request->sid)->get();
               $output = '<option value="">Selct Price Title</option>';
               foreach($pricelist as $pl){
                    $output .= '<option value="'.$pl->id.'">'.$pl->price_title.'</option>';
               }
               $dues_tax = $sales_tax = 0;
               if($catedata->dues_tax != ''){
                    $dues_tax = $catedata->dues_tax;
               }

               if($catedata->sales_tax != ''){
                    $sales_tax = $catedata->sales_tax;
               }

               $html .= $catedata->dues_tax.'^^'.$catedata->sales_tax;
          }else if($request->chk == 'priceopt'){
               $membershiplist = BusinessPriceDetails::where('id',$request->sid)->get();
               $output = '<option value="">Selct Membership Type</option>';
               foreach($membershiplist as $pl){
                    $output .= '<option value="'.$pl->id.'">'.$pl->membership_type.'</option>';
               }

               //print_r( $membershiplist);exit;

               if(date('l') == 'Saturday' || date('l') == 'Sunday'){ 
                    $total_price_val_adult =  @$membershiplist[0]['adult_weekend_price_diff'];
                    $total_price_val_child =  @$membershiplist[0]['child_weekend_price_diff'];
                    $total_price_val_infant =  @$membershiplist[0]['infant_weekend_price_diff'];
               }else{
                    $total_price_val_adult =  @$membershiplist[0]['adult_cus_weekly_price'];
                    $total_price_val_child =  @$membershiplist[0]['child_cus_weekly_price'];
                    $total_price_val_infant =  @$membershiplist[0]['infant_cus_weekly_price']; 
               }
               $aduid = "adultprice";
               $childtid = "childprice";
               $infantid = "infantprice";
               if($request->type == 'ajax'){
                    $aduid = "adultpriceajax";
                    $childtid = "childpriceajax";
                    $infantid = "infantpriceajax";
               }
               
               $html .='<input type="hidden" name="adultprice" id="'.$aduid.'" value="'.$total_price_val_adult.'" >
                         <input type="hidden" name="childprice" id="'.$childtid.'" value="'.$total_price_val_child.'" >
                         <input type="hidden" name="infantprice" id="'.$infantid.'" value="'.$total_price_val_infant.'" >^^'.$membershiplist[0]['pay_setnum'].'!!'.$membershiplist[0]['pay_setduration']; 
          }else if($request->chk == 'participat'){
               $data = explode('~~',$request->sid);
               $data1 = explode('^^',$data[1]);
               if($request->user_type == 'user'){
                    if($data1[0] == 'user'){
                         $user = User::select('birthdate','firstname','lastname')->where('id',$data[0])->first();
                         $username = $user->firstname.' '. $user->lastname;
                         $relation = '';
                         $date = $user->birthdate;
                    }else{
                         $user = UserFamilyDetail::select('birthday','relationship','last_name','first_name')->where('id',$data[0])->first();
                         $username = $user->first_name.' '. $user->last_name;
                         $relation = $user->relationship;
                         $date = $user->birthday;
                    }
               }else{
                    $user = Customer::select('birthdate','relationship','lname','fname')->where('id',$data[0])->first();
                    $username = $user->fname.' '. $user->lname;
                    $relation = $user->relationship;
                    $date = $user->birthdate;
               }
               $age = Carbon::parse($date)->age;
               if($age < 18){
                    $output .= $username .' ('.$age .' yrs) '.$relation .' (Paid For by '.$data1[1].')';
               }else{
                    $output .= $username .' ('.$age .' yrs)';
               }    
          }    
          
          if($html != ''){
               return $output.'~~'.$html;
          }else{
               return $output;
          }   
     }

     public function checkout_register(Request $request){
          //print_r($request->all()); 
          $bookidarray = [];
          $fitnessity_fee= 0;
          $bspdata = BusinessSubscriptionPlan::where('id',1)->first();
          $fitnessity_fee = $bspdata->fitnessity_fee;
          $service_fee = $bspdata->service_fee;
          $tax = $bspdata->site_tax;

          if(($request->cc_new_card_amt != 0 && $request->cc_new_card_amt != '') || ($request->cc_amt != 0 && $request->cc_amt != '' )){
               \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
               $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
               $customer='';
               if($request->user_type == 'user'){
                    $loggedinUser = Auth::user();
                    $userdata = User::where('id',$loggedinUser->id)->first();
                    if(empty($userdata['stripe_customer_id'])) {
                         $stripe_customer_id =  $userdata->create_stripe_customer_id();
                    }else{
                         $stripe_customer_id = $userdata['stripe_customer_id'];
                    }
               }else{
                    $userdata = Customer::where('id',$request->user_id)->first();
                    if(empty($userdata['stripe_customer_id'])) {
                         $stripe_customer_id = $userdata->create_stripe_customer_id();
                    }else{
                         $stripe_customer_id = $userdata['stripe_customer_id'];
                    }
               }
               $listItems = []; 
               $proid = []; 
               //$totalprice = $request->grand_total;
               if(isset($request->itemname)) {
                    $itemcount = count($request->itemname);
                    $pr=''; $total=0;
                    for($i=0; $i < $itemcount; $i++) {
                         $pr=$request->itemprice[$i] / $request->itemqty[$i];
                         $total = $total + $pr;
                         if(isset($request->itemname[$i])) {
                              $product = \Stripe\Product::create([
                                  'name' => $request->itemname[$i],
                                  'description' => $request->itemname[$i],
                              ]);

                              $price = \Stripe\Price::create([
                                   'product' => $product->id,
                                   'unit_amount' => $request->itemprice[$i] / $request->itemqty[$i],
                                   'currency' => 'usd',
                              ]);

                              $listItem['price'] = $price->id;
                              $listItem['quantity'] = $request->itemqty[$i];
                              $listItems[] = $listItem;
                         }
                         if(isset($request->itemid[$i])) {
                              $proidary = $request->itemid[$i];
                              $proid[] = $proidary;
                         }

                    }
               }
               $prodata = json_encode($proid); 
               $listItems = json_encode($listItems);

               if($request->cc_new_card_amt != 0 && $request->cc_new_card_amt != ''){

                    $cc_new_card_amt = $request->cc_new_card_amt;
                    $totalprice = $cc_new_card_amt;

                    if($request->has('save_card')){
                         $carddetails = $stripe->tokens->create([
                              'card' => [
                                  'number' => $request->cardNumber,
                                  'exp_month' =>  $request->month,
                                  'exp_year' =>  $request->year,
                                  'cvc' =>  $request->cvv,
                                  'name' =>  $request->owner,
                              ],
                         ]);

                         $customer_source = $stripe->customers->createSource(
                              $stripe_customer_id ,
                              [ 'source' =>$carddetails->id]
                         );
                         $payment_method = $customer_source->id;
                    }else{
                         $paymentMethods =  $stripe->paymentMethods->create([
                              'type' => 'card',
                              'card' => [
                                  'number' => $request->cardNumber,
                                  'exp_month' => $request->month,
                                  'exp_year' => $request->year,
                                  'cvc' => $request->cvv,
                              ],
                         ]);

                         $payment_method = $paymentMethods->id;
                    }
               }else{
                    $cc_amt = $request->cc_amt;
                    $totalprice = $cc_amt;
                    $carddetails = $stripe->customers->retrieveSource(
                         $stripe_customer_id,
                         $request->card_id,
                         []
                    );

                    $payment_method = $carddetails->id;
               }

               $pmtintent = \Stripe\PaymentIntent::create([
                    'amount' =>  round($totalprice *100),
                    'currency' => 'usd',
                    'customer' => $stripe_customer_id,
                    'payment_method' =>  $payment_method ,
                    'off_session' => true,
                    'confirm' => true,
                    'metadata' => [
                         "pro_id" => $prodata,
                         "listItems" =>$listItems,
                    ],
               ]);

               $payid = $pmtintent->id;

               $payment_intent = $stripe->paymentIntents->retrieve(
                    $payid,
                    []
               );

               $data = json_decode( json_encode( $payment_intent),true);
               //$amount= ($data["amount"]/100);
               $amount1=  $request->grand_total;
               $date = new DateTime("now", new DateTimeZone('America/New_York') );
               $oid = $date->format('YmdHis');
               $digits = 3;
               $rand = rand(pow(10, $digits-1), pow(10, $digits)-1);   //24 06 2022 50 9 59
               $orderid= 'FS_'.$oid.$rand;
               $lastid='';
               $pmt_by_cash = 0;
               if($amount1 != $data["amount"]/100 ){
                    $pmt_by_cash = $amount1 - $data["amount"]/100;
               }
               if($request->user_type == 'user'){
                    $user_id = $request->user_id;
                    $customerid = '';
               }else{
                    $customerid = $request->user_id;
                    $user_id = Auth::user()->id;
               }

               if($data['status']=='succeeded')
               {
                    $orderdata = array(
                         'user_id' =>  $user_id ,
                         'customer_id' =>  $customerid ,
                         'user_type' => $request->user_type,
                         'status' => 'confirmed',
                         'currency_code' => $data["currency"],
                         'stripe_id' => $data["id"],
                         'stripe_status' => $data["status"],
                         'amount' => $amount1,
                         'order_id' => $orderid,
                         'order_type' => 'checkout_register',
                         'bookedtime' =>$date->format('Y-m-d'),
                         'pmt_json' =>json_encode(array(
                                      'pmt_by_card' => $data["amount"]/100,
                                      'pmt_by_cash' =>   $pmt_by_cash ,
                                      'pmt_by_check' => 0,
                                      'pmt_by_comp' => 0,
                              )),
                      ); 
                    $status = UserBookingStatus::create($orderdata);
                    $lastid=$status->id;
                    $businessuser =[];
                    $cart = session()->get('cart_item');
                    $cartnew = [];
                     
                    $cnt=0;
                    foreach($cart['cart_item'] as $key=>$c)
                    {    
                         if($c['chk'] == 'activity_purchase') {
                              $cartnew[$cnt]['name']= $c['name'];
                              $cartnew[$cnt]['code']= $c['code'];
                              $cartnew[$cnt]['priceid']= $c['priceid'];
                              $cartnew[$cnt]['sesdate']= $c['sesdate'];
                              $cartnew[$cnt]['tip']= $c['tip'];
                              $cartnew[$cnt]['discount']= $c['discount'];
                              $cartnew[$cnt]['tax']= $c['tax'];
                              $cartnew[$cnt]['actscheduleid']= $c['actscheduleid']; 
                              $cartnew[$cnt]['adult']= $c['adult'];
                              $cartnew[$cnt]['child']= $c['child'];
                              $cartnew[$cnt]['infant']= $c['infant'];
                              $cartnew[$cnt]['participate']= $c['participate_from_checkout_regi'];
                              $cnt++;
                              unset($cart['cart_item'][$key]);
                         }
                    }   
                
                    $metadatapro = json_decode($data['metadata']['pro_id']);
                    $metadatalistItems = json_decode($data['metadata']['listItems']);
                
                    for($i=0;$i<count($metadatapro);$i++){
                         $priceid=0; $sesdate= $encodeqty ='' ;
                         $aduqnt = $childqnt = $infantqnt =0; 
                         $aduprice = $childprice = $infantprice = 0;
                         if ($metadatapro[$i] == $cartnew[$i]['code'])
                         {   
                              $taxval =$cartnew[$i]['tax'];
                              $priceid = $cartnew[$i]['priceid'];
                              $sesdate = $cartnew[$i]['sesdate'];
                              $pidval = $cartnew[$i]['code'];
                              $tip = $cartnew[$i]['tip'];
                              $discount = $cartnew[$i]['discount'];
                              $act_schedule_id = $cartnew[$i]['actscheduleid'];
                              if(!empty($cartnew[$i]['adult'])){
                                  $aduqnt = $cartnew[$i]['adult']['quantity'];
                                  $aduprice = $cartnew[$i]['adult']['price'];
                              }
                              if(!empty($cartnew[$i]['child'])){
                                  $childqnt = $cartnew[$i]['child']['quantity'];
                                  $childprice= $cartnew[$i]['child']['price'];
                              }
                              if(!empty($cartnew[$i]['infant'])){
                                  $infantqnt = $cartnew[$i]['infant']['quantity'];
                                  $infantprice = $cartnew[$i]['infant']['price'];
                              }    

                              $qty_c= array( 'adult'=>$aduqnt ,'child' =>$childqnt,'infant'=>$infantqnt); 
                              $price_c = array( 'adult'=>$aduprice ,'child' =>$childprice,'infant'=>$infantprice);
                              $encodeparticipate = json_encode($cartnew[$i]['participate']);
                              $payment_number_c = array();
                              $encodepayment_number = json_encode($payment_number_c);
                              $encodeqty = json_encode($qty_c);
                              $encodeprice = json_encode($price_c);
                         }

                         $activitylocation = BusinessServices::where('id',$pidval)->first();
                         $price_detail = BusinessPriceDetails::find($priceid);
                         $time = $act_schedule_id;
                         $contract_date = date('Y-m-d',strtotime($sesdate));
                         $explodetime = explode(' ',$time);
                         $expired_at = '';
                         if(!empty($explodetime) && array_key_exists(1, $explodetime)){
                              if($explodetime[1] == 'Months'){
                                   $daynum = '+'.$explodetime[0].' month';
                                   $expired_at  = date('Y-m-d', strtotime($contract_date. $daynum ));
                              }else if($explodetime[1] == 'Days'){
                                   $daynum = '+'.$explodetime[0].' days';
                                   $expired_at  = date('Y-m-d', strtotime($contract_date. $daynum ));
                              }else if($explodetime[1] == 'Weeks'){
                                   $daynum = '+'.$explodetime[0].' weeks';
                                   $expired_at  = date('Y-m-d', strtotime($contract_date. $daynum ));
                              }else {
                                   $daynum = '+'.$explodetime[0].' years';
                                   $expired_at  = date('Y-m-d', strtotime($contract_date. $daynum ));
                              }
                         }
                         $act = array(
                              'booking_id' => $lastid,
                              'sport' => $pidval,
                              'price' => $encodeprice,
                              'qty' =>$encodeqty ,
                              'priceid' => $priceid,
                              'pay_session' => $price_detail->pay_session,
                              'expired_at' => $expired_at,
                              'contract_date' =>date('Y-m-d',strtotime($sesdate)),
                              'booking_detail' => json_encode(array(
                                      'activitytype' => $activitylocation->service_type,
                                      'numberofpersons' => 1,
                                      'activitylocation' => $activitylocation->activity_location,
                                      'whoistraining' => 'me',
                                      'sessiondate' => '',
                              )),
                              'extra_fees' => json_encode(array(
                                  'service_fee' => $service_fee,
                                  'fitnessity_fee' => $fitnessity_fee,
                                  'tax' => $taxval,
                                  'tip' => $tip,
                                  'discount' => $discount,

                              )),
                              'expired_duration' =>$act_schedule_id,
                              'payment_number' =>$encodepayment_number,
                              'participate' => '['.$encodeparticipate.']',
                              'transfer_provider_status' =>'unpaid',
                         );
                         $status = UserBookingDetail::create($act);
                         $bookidarray [] = $status->id;
                          //$status->transfer_to_provider();
                    }
                    //session()->forget('cart_item');
               }
          }else{
               $retrun_cash = 0;
               $cash_amt_tender = 0;
               $pmt_by_check = 0;
               $pmt_by_comp = 0;
               $checknumber = '';
               $grandtotal = $request->grand_total;
               if($request->cardinfo == 'check'){
                    $pmt_by_check = $request->check_amt;
                    $checknumber  = $request->check_number;

               }else if($request->cardinfo  == 'cash'){
                    if($request->cash_amt_tender > $request->cash_amt ){
                         $retrun_cash = $request->cash_change;
                    }
                    $cash_amt_tender = $request->cash_amt_tender;
               }else{
                    $pmt_by_comp = $grandtotal;
                    $grandtotal = 0;
               }
               
               $date = new DateTime("now", new DateTimeZone('America/New_York') );
               $oid = $date->format('YmdHis');
               $digits = 3;
               $rand = rand(pow(10, $digits-1), pow(10, $digits)-1);   //24 06 2022 50 9 59
               $orderid= 'FS_'.$oid.$rand;

               if($request->user_type == 'user'){
                    $user_id = $request->user_id;
                    $customerid = '';
               }else{
                    $customerid = $request->user_id;
                    $user_id = Auth::user()->id;
               }
               $orderdata = array(
                    'user_id' =>  $user_id ,
                    'customer_id' =>  $customerid ,
                    'user_type' => $request->user_type,
                    'status' => 'confirmed',
                    'currency_code' => 'usd',
                    'stripe_id' => '',
                    'stripe_status' => '',
                    'amount' => $grandtotal,
                    'order_id' => $orderid,
                    'order_type' => 'checkout_register',
                    'bookedtime' =>$date->format('Y-m-d'),
                    'retrun_cash' =>$retrun_cash,
                    'pmt_json' =>json_encode(array(
                         'pmt_by_card' => 0,
                         'pmt_by_cash' =>   $cash_amt_tender ,
                         'pmt_by_check' => $pmt_by_check,
                         'pmt_by_comp' => $pmt_by_comp,
                         'check_no' => $checknumber,
                    )),
               );
               $status = UserBookingStatus::create($orderdata);
               $lastid=$status->id; 

               $businessuser =[];
               $cart = session()->get('cart_item');
               $cartnew = [];
               $cnt=0;
               foreach($cart['cart_item'] as $key=>$c)
               {    
                    if($c['chk'] == 'activity_purchase') {
                         $cartnew[$cnt]['name']= $c['name'];
                         $cartnew[$cnt]['code']= $c['code'];
                         $cartnew[$cnt]['priceid']= $c['priceid'];
                         $cartnew[$cnt]['sesdate']= $c['sesdate'];
                         $cartnew[$cnt]['tip']= $c['tip'];
                         $cartnew[$cnt]['discount']= $c['discount'];
                         $cartnew[$cnt]['tax']= $c['tax'];
                         $cartnew[$cnt]['actscheduleid']= $c['actscheduleid'];
                         $cartnew[$cnt]['adult']= $c['adult'];
                         $cartnew[$cnt]['child']= $c['child'];
                         $cartnew[$cnt]['infant']= $c['infant'];
                         $cartnew[$cnt]['participate']= $c['participate_from_checkout_regi'];
                         $cnt++;
                         unset($cart['cart_item'][$key]);
                    }
               } 

               foreach($cartnew as $crt){
                    $aduprice = $childprice = $infantprice = 0;
                    $aduqnt = $childqnt = $infantqnt = 0;
                    $taxval = $crt['tax'];
                    $activitylocation = BusinessServices::where('id',$crt['code'])->first();
                    $price_detail = BusinessPriceDetails::find($crt['priceid']);
                    $payment_number_c = array( 'adult'=>0 ,'child' => 0,
                        'infant'=> 0);
                    $encodepayment_number = json_encode($payment_number_c);
                    $encodeparticipate = json_encode($crt['participate']);

                    if(!empty($crt['adult'])){
                        $aduqnt = $crt['adult']['quantity'];
                        $aduprice = $crt['adult']['price'];
                    }
                    if(!empty($crt['child'])){
                        $childqnt = $crt['child']['quantity'];
                        $childprice= $crt['child']['price'];
                    }
                    if(!empty($crt['infant'])){
                        $infantqnt = $crt['infant']['quantity'];
                        $infantprice = $crt['infant']['price'];
                    }

                    $qty_c= array( 'adult'=>$aduqnt ,'child' =>$childqnt,
                        'infant'=>$infantqnt); 
                    $price_c = array( 'adult'=>$aduprice ,'child' =>$childprice,
                        'infant'=>$infantprice);
                    $encodeqty = json_encode($qty_c);
                    $encodeprice = json_encode($price_c);
                    $time = $crt['actscheduleid'];
                    $contract_date = date('Y-m-d',strtotime($crt['sesdate']));
                    $explodetime = explode(' ',$time);
                    $expired_at = '';
                    if(!empty($explodetime) && array_key_exists(1, $explodetime)){
                         if($explodetime[1] == 'Months'){
                              $daynum = '+'.$explodetime[0].' month';
                              $expired_at  = date('Y-m-d', strtotime($contract_date. $daynum ));
                         }else if($explodetime[1] == 'Days'){
                              $daynum = '+'.$explodetime[0].' days';
                              $expired_at  = date('Y-m-d', strtotime($contract_date. $daynum ));
                         }else if($explodetime[1] == 'Weeks'){
                              $daynum = '+'.$explodetime[0].' weeks';
                              $expired_at  = date('Y-m-d', strtotime($contract_date. $daynum ));
                         }else {
                              $daynum = '+'.$explodetime[0].' years';
                              $expired_at  = date('Y-m-d', strtotime($contract_date. $daynum ));
                         }
                    }

                    $act = array(
                         'booking_id' => $lastid,
                         'sport' => $crt['code'],
                         'price' => $encodeprice,
                         'qty' =>$encodeqty ,
                         'priceid' => $crt['priceid'],
                         'pay_session' => $price_detail->pay_session,
                         'contract_date' =>date('Y-m-d',strtotime($crt['sesdate'])),
                         'booking_detail' => json_encode(array(
                              'activitytype' => @$activitylocation->service_type,
                              'numberofpersons' => 1,
                              'activitylocation' => @$activitylocation->activity_location,
                              'whoistraining' => 'me',
                              'sessiondate' => '',
                         )),
                         'extra_fees' => json_encode(array(
                             'service_fee' => $service_fee,
                             'fitnessity_fee' => $fitnessity_fee,
                             'tax' => $taxval,
                             'tip' => $crt['tip'],
                             'discount' => $crt['discount'],
                         )),
                         'expired_duration' =>$crt['actscheduleid'],
                         'participate' =>'['.$encodeparticipate.']',
                         'transfer_provider_status' =>'unpaid',
                         'payment_number'=>$encodepayment_number,
                    );
               
                    $status = UserBookingDetail::create($act);
                    $bookidarray [] = $status->id;
               }
               //session()->forget('cart_item');
          }
         
          session()->put('cart_item', $cart);
          session()->put('ordermodelary', $bookidarray);

          if($request->user_type == 'customer'){
               return redirect('activity_purchase/0/'.$request->user_id);
          }else{
               return redirect('activity_purchase/'.$request->user_id);
          }
     }

     public function booking_activity_cancel(Request $request){
          //print_r($request->all());exit;
          $stripeid = '';
          $name  = '';
          $successmsg  = '';
          $booking_data = UserBookingStatus::where('id',$request->booking_id)->first();
          /*print_r( $booking_data);exit;*/
          if($booking_data->user_type == 'customer'){
               $name = $booking_data->customers->fname.' '.$booking_data->customers->lname;
               $stripe_customer_id = $booking_data->customers->stripe_customer_id;
          }else{
               $name = $booking_data->user->firstname.' '.$booking_data->user->lastname;
               $stripe_customer_id = $booking_data->user->stripe_customer_id;
          }
          if($request->cancel_charge_action == 'charge_fee_on_card'){
               $totalprice = $request->cancel_charge_amt;

               \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
               $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
               $carddetails = $stripe->customers->retrieveSource(
                    $stripe_customer_id,
                    $request->card_idval,
                    []
               );
               $payment_method = $carddetails->id;
               $pmtintent = \Stripe\PaymentIntent::create([
                    'amount' =>  round($totalprice *100),
                    'currency' => 'usd',
                    'customer' => $stripe_customer_id,
                    'payment_method' =>  $payment_method ,
                    'off_session' => true,
                    'confirm' => true,
               ]);
               $payid = $pmtintent->id;
               $payment_intent = $stripe->paymentIntents->retrieve(
                    $payid,
                    []
               );
               $data = json_decode( json_encode( $payment_intent),true);
               if($data['status']=='succeeded')
               {
                    $stripeid = $payid;
                    $successmsg = $name.' ,You Paid Late Cancels Charge Succefully.';
               }
          }else{
               $successmsg = 'Succefully Cancel your Activity';
          }
          
          $data = array(
                    "booking_id"=> $request->booking_id,
                    "order_detail_id"=> $request->order_detail_id,
                    "cancel_charge_action"=> $request->cancel_charge_action,
                    "cancel_charge_amt"=> @$request->cancel_charge_amt,
                    "stripe_id" => $stripeid,
               );
          if($request->cancel_id != ''){
               BookingActivityCancel::where('id',request()->cancel_id)->update($data);
          }else{
               BookingActivityCancel::create($data);
          }
          
        /*  print_r($request->all());exit;*/
          return redirect('/scheduler-checkin/'.$request->pageid)->with('success', $successmsg); 
     }

     public function getbookingcancelmodel(Request $request){
          $booking_data = UserBookingStatus::where('id',$request->oid)->first();
          $bookingdetail_data = UserBookingDetail::where('id',$request->order_detail_id)->first();
          $cardInfo = [];
          if($booking_data->user_type == 'customer'){
               $cardInfo = $booking_data->customers->get_stripe_card_info();
          }else{
               $cardInfo = $booking_data->user->get_stripe_card_info();
          }
          //print_r($cardInfo);exit;
          $data = BookingActivityCancel::where(['booking_id'=> $request->oid,'order_detail_id'=> $request->order_detail_id])->first();
          $cancel_charge_amt = '';
          $html = '';
          $html .=' <input type="hidden" name="card_idval" id="card_idval" value="">
                    <input type="hidden" name="cancel_id" id="cancel_id" value="'.@$data->id.'">
                    <input type="radio" id="nothing" name="cancel_charge_action" value="nothing" ';
                    if(@$data->cancel_charge_action == 'nothing') {
                         $html .='checked';
                    }

                    $html .='>
                    <label for="nothing">Nothing</label><br>
                    
                    <input type="radio" id="fee" name="cancel_charge_action" value="charge_fee_on_card"';
                    if(@$data->cancel_charge_action == 'charge_fee_on_card') {
                         $html .='checked';
                         $cancel_charge_amt = @$data->cancel_charge_amt;
                    }

                    $html .='>
                    <label for="fee">Charge Fee on Card</label>
                    <input type="text" class="form-control feeamount" name="cancel_charge_amt" id="cancel_charge_amt" placeholder="$ Fee Amount" value="'.@$cancel_charge_amt.'">
                    <div class="row" id="cardinfodiv" style="display:none">';
                    if(!empty($cardInfo)) {
                         foreach($cardInfo as $card) {
                              $brandname = ucfirst($card['brand']);
                              $html .='<div class="col-md-4 col-sm-4 col-xs-12">
                                             <label class="pay-card" style="color:#000; background: #e9e9e9; margin-bottom: 15px;">
                                                  <input name="cardinfo" class="payment-radio" type="radio" value="cardonfile" extra-data="'.$brandname .': XXXX'.$card['last4'].'  Exp. '.$card['exp_month'].'/'.$card['exp_year'].'" card-id="'.$card['id'].'">
                                                  <span class="plan-details checkout-card">
                                                       <div class="row">
                                                            <div class="col-md-12">
                                                                 <div class="payment-method-img">
                                                                      <img src="'.asset('/public/images/cc-on-file.png').'" alt="img" class="w-100" width="100">
                                                                 </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                 <div class="cart-name checkout-cart">
                                                                      <span>CC (On File)</span>
                                                                 </div>
                                                                 <div class="cart-num checkout-cart">
                                                                      <span>'.$brandname .' XX'.$card['last4'].'</span>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </span>
                                             </label>
                                        </div>';
                         }
                    }
                                         
                    $html .='</div><br>
                    
                    <input type="radio" id="cancel_charge_action" name="cancel_charge_action" value="deduct_membership"';
                    if(@$data->cancel_charge_action == 'deduct_membership') {
                         $html .='checked';
                    }

                    $html .='>
                    <label for="javascript">Deduct from membership</label> 
                    <select class="form-control" name="membership" id="membership">
                      <option value="">Choose from membership options </option>
                      <option value="'.$bookingdetail_data->business_price_details->membership_type.'" selected>'.$bookingdetail_data->business_price_details->membership_type.'</option>
                    </select>';
          return $html;
     }

     public function check_in_activity(Request $request){
         
          $bd = BookingCheckinDetails::where(['booking_id'=>$request->oid,'order_detail_id'=>$request->order_detail_id])->whereMonth('checkin_date', date('m'))->first();
          if($bd == ''){
               $data = array(
                    "booking_id"=> $request->oid,
                    "order_detail_id"=> $request->order_detail_id,
                    "checkin"=> $request->checkin,
                    "checkin_date"=> date('Y-m-d')
               ); 
               BookingCheckinDetails::create($data); 
          }else{ BookingCheckinDetails::where(['booking_id'=>$request->oid,'order_detail_id'=>$request->order_detail_id])->update(['checkin'=>$request->checkin, "checkin_date"=> date('Y-m-d')]); 
          }   

          $booking_detail = UserBookingDetail::find($request->order_detail_id);
          if($request->checkin == '1'){
               $booking_detail->update(['pay_session' => $booking_detail->pay_session - 1]);
          }else{
               $booking_detail->update(['pay_session' => $booking_detail->pay_session + 1]);
          }

     }

     public function editcartmodel(Request $request){
          $cart_item = [];
          if (session()->has('cart_item')) {
               $cart_item = session()->get('cart_item');
          }
          //print_r( $cart_item);exit;
          $html = '';
          $salestaxajax = 0;
          $duestaxajax = 0;
          $result = '';
          $cart = [];
          if(in_array($request->priceid, array_keys($cart_item["cart_item"]))) {
               $cart = $cart_item["cart_item"][$request->priceid];
               //print_r( $cart);
               $cartselectedpriceid = BusinessPriceDetails::where('id',$cart['priceid'])->first();
               $cartselectedcategoryid = BusinessPriceDetailsAges::where('id',$cart['categoryid'])->first();
               $program_list = BusinessServices::where(['is_active'=>1,'userid'=>Auth::user()->id])->get();
               $catelist = BusinessPriceDetailsAges::select('id','category_title')->where('serviceid',$cart['code'])->get(); 
               $pricelist = BusinessPriceDetails::select('id','price_title')->where('category_id',@$cart['categoryid'])->get();
               $membershiplist = BusinessPriceDetails::select('id','membership_type')->where('id',$cart['priceid'])->get();
               $aduqty = $infantqty = $childqty = $aduprice = $childprice = $infantprice = 0;
               if(date('l') == 'Saturday' || date('l') == 'Sunday'){ 
                    $aduprice =  @$cartselectedpriceid['adult_weekend_price_diff'];
                    $childprice =  @$cartselectedpriceid['child_weekend_price_diff'];
                    $infantprice =  @$cartselectedpriceid['infant_weekend_price_diff'];
               }else{
                    $aduprice =  @$cartselectedpriceid['adult_cus_weekly_price'];
                    $childprice =  @$cartselectedpriceid['child_cus_weekly_price'];
                    $infantprice =  @$cartselectedpriceid['infant_cus_weekly_price']; 
               }

               if($cartselectedcategoryid->sales_tax != ''){
                    $salestaxajax = $cartselectedcategoryid->sales_tax ;
               }

               if($cartselectedcategoryid->dues_tax != ''){
                    $duestaxajax = $cartselectedcategoryid->dues_tax ;
               }
               if(!empty($cart['adult'])) {
                    if($cart['adult']['quantity']  != 0){
                        $aduqty  = $cart['adult']['quantity'];
                    }
               } 

               if(!empty($cart['child'])) {
                    if($cart['child']['quantity']  != 0){
                        $childqty  = $cart['child']['quantity'];
                    }
               } 

               if(!empty($cart['infant'])) {
                    if($cart['infant']['quantity']  != 0){
                        $infantqty  = $cart['infant']['quantity'];
                    }
               }

               $actscheduleid = explode(' ' ,$cart["actscheduleid"]);
               $participate = $cart["participate_from_checkout_regi"]['pc_name'];
               $html='<div class="row">
                         <form method="post" action="'.route("addtocart").'">
                              <input type="hidden" name="_token"  value="'.csrf_token().'" />
                              <div class="col-lg-12 col-xs-12 space-remover">
                                   <div class="manage-customer-modal-title">
                                        <h4>Edit Cart Item</h4>
                                   </div>
                                   <div class="manage-customer-from">
                                        <div class="row">
                                             <div class="col-md-12 col-sm-12">
                                                  <div class="check-out-steps">
                                                       <label><h2 class="color-red">Step 1: </h2> Select Service</label>
                                                  </div>
                                             <div class="check-client-info-box">
                                                  <div class="row">
                                                       <input type="hidden" name="pc_regi_id" value="'.@$cart["participate_from_checkout_regi"]["id"].'">
                                                       <input type="hidden" name="pc_user_tp" value="'.@$cart["participate_from_checkout_regi"]["pc_user_tp"].'">
                                                       <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <div class="select0service">
                                                                 <label>Who\'s Participating </label>
                                                                 <select name="pc_value" id="participate_listajax" class="form-control">
                                                                      <option value="'.@$cart["participate_from_checkout_regi"]["id"].'">'.@$participate.'</option>
                                                                 </select>
                                                            </div>
                                                       </div>';
                                                       $pdrop = "'program',this,this.value";
                                                         $cdrop = "'category',this,this.value";
                                                       $html .='<div class="col-md-4 col-sm-4 col-xs-12">
                                                            <div class="select0service">
                                                                 <label>Select Program </label>
                                                                 <select name="program_listajax" id="program_listajax" class="form-control" onchange="loaddropdownajax('.$pdrop.');">
                                                                      <option value="" >Select</option>';
                                                                      if(!empty(@$program_list)){
                                                                           foreach($program_list as $pl){
                                                                                $html .='<option value="'.$pl->id.'"';
                                                                           if($cart['code'] == $pl->id){$html .='selected'; 
                                                                           }
                                                                           $html .='>'.$pl->program_name.'</option>';
                                                                           }
                                                                      }
                                                                 $html .='</select>
                                                            </div>
                                                       </div>
                                                       <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <label>Select Catagory </label>
                                                            <select name="category_listajax" id="category_listajax" class="form-control"  onchange="loaddropdownajax('.$cdrop.');">  
                                                                 <option value="">Select Category</option>';
                                                                 if(!empty(@$catelist)){
                                                                      foreach($catelist as $cl){
                                                                           $html .='<option value="'.$cl->id.'"'; 
                                                                           if(@$cartselectedcategoryid->id == $cl->id){
                                                                                $html .='selected';
                                                                           }
                                                                           $html .='>'.$cl->category_title.'</option>';
                                                                      }
                                                                 }
                                                             $html .='</select>
                                                       </div>
                                                  </div>';
                                             
                                                  $html .='<div class="row">';
                                                       $pridrop = "'priceopt',this,this.value";
                                                       $html .='<div class="col-md-4 col-sm-4 col-xs-12">
                                                            <label>Select Price Option  </label>
                                                            <select name="priceopt_listajax" id="priceopt_listajax" class="form-control" onchange="loaddropdownajax('.$pridrop.');">
                                                                 <option value="">Select Price Title</option>';
                                                                 if(!empty(@$pricelist)){
                                                                 foreach($pricelist as $pl){
                                                                      $html .='<option value="'.$pl->id.'"';
                                                                      if(@$cartselectedpriceid->id == $pl->id){
                                                                           $html .='selected';
                                                                      }
                                                                      $html .='>'.$pl->price_title.'</option>';
                                                                      }
                                                                 }
                                                            $html .='</select>
                                                       </div>
                                                       <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <div class="select0service">
                                                                 <div class="date-activity-scheduler date-activity-check paynowset">
                                                                      <button type="button" data-toggle="modal" data-target="#addpartcipateajax">Participant Quantity </button>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <label> Membership Option</label>
                                                            <select name="membership_opt_listajax" id="membership_opt_listajax" class="form-control">
                                                                 <option value="">Select Membership Type</option>';
                                                                 if(!empty(@$membershiplist)){
                                                                 foreach($membershiplist as $mp){
                                                                      $html .='<option value="'.$mp->id.'"'; if(@$cartselectedpriceid->membership_type == $mp->membership_type){ 
                                                                                $html .='selected'; 
                                                                           }
                                                                           $html .='>'.$mp->membership_type.'
                                                                      </option>';
                                                                 }
                                                                 }
                                                            $html .='</select>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                             <div class="check-out-steps"><label><h2 class="color-red">Step 2: </h2> Check Details </label></div>
                                             <div class="check-client-info-box">
                                                  <div class="row">
                                                       <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <div class="select0service pricedollar">
                                                                 <label>Price </label>
																 <div class="set-price">
																	<i class="fas fa-dollar-sign"></i>
																 </div>
                                                                 <input type="text" class="form-control valid" id="priceajax" placeholder="$0.00" value="'.$cart["totalprice"].'" disabled>
                                                            </div>
                                                       </div>
                                                       <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <div class="select0service">
                                                                 <label>Discount</label>
                                                                 <div class="row">
                                                                      <div class="col-md-6 col-sm-6 col-xs-6 nopadding">
                                                                           <div class="choose-tip">
                                                                                <select name="dis_amt_drop" id="dis_amt_dropajax" class="form-control" onchange="getdis();"> 
                                                                                     <option value="">Choose $ or % </option>
                                                                                     <option value="$" selected>$</option>
                                                                                     <option value="%">%</option>
                                                                                </select>
                                                                           </div>
                                                                      </div>
                                                                      <div class="col-md-6 col-sm-6 col-xs-6 nopadding">
                                                                           <div class="choose-tip">
                                                                                <input type="text" class="form-control valid" id="dis_amtajax" name="dis_amtajax" placeholder="Enter Amount" value="'.$cart["discount"].'" onkeyup="getdis();">
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                       <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <div class="select0service">
                                                                 <label>Tip Amount</label>
                                                                 <div class="row">
                                                                      <div class="col-md-6 col-sm-6 col-xs-6 nopadding">
                                                                           <div class="choose-tip">
                                                                                <select name="tip_amt_dropajax" id="tip_amt_dropajax" class="form-control" onchange="getdis();" >
                                                                                     <option value="">Choose $ or % </option>
                                                                                     <option value="$" selected>$</option>
                                                                                     <option value="%">%</option>
                                                                                </select>
                                                                           </div>
                                                                      </div>
                                                                      <div class="col-md-6 col-sm-6 col-xs-6 nopadding">
                                                                           <div class="choose-tip">
                                                                                <input type="text" class="form-control valid" id="tip_amtajax" name="tip_amtajax" placeholder="Enter Amount" value="'.$cart["tip"].'" onkeyup="getdis();">
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>';
                                                  $dval = "'duration',this,this.value";
                                                  $html .='<div class="row">
                                                       <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <div class="col-md-6 col-sm-6 col-xs-6"> 
                                                                 <div class="tax-check">
                                                                      <label>Tax </label>
                                                                      <input type="checkbox" id="taxajax" name="taxajax" value="1"';
                                                                      if($cart["tax"] == 0 || $cart["tax"] == ''){
                                                                           $html .='checked';
                                                                      }
                                                                      $html .='>
                                                                      <label for="tax"> No Tax</label><br>
                                                                 </div>
                                                            </div>
                                                            <input type="hidden" name="duestax" id="duestaxajax" value="'.$duestaxajax.'">
                                                            <input type="hidden" name="salestax" id="salestaxajax" value="'.$salestaxajax.'">
                                                       </div>
                                                       <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <div class="select0service">
                                                                 <label>Duration</label>
                                                                 <div class="row">
                                                                      <div class="col-md-6 col-sm-6 col-xs-6 nopadding">
                                                                           <input type="text" class="form-control valid" id="duration_intajax" name=duration_intajax placeholder="1" value="'.@$actscheduleid[0].'" onkeyup="changeduration();">
                                                                      </div>
                                                                      
                                                                      <div class="col-md-6 col-sm-6 col-xs-6 nopadding">
                                                                           <div class="choose-tip">
                                                                                <select name="duration_dropdownajax" id="duration_dropdownajax" class="form-control" onchange="loaddropdownajax('.$dval.');">
                                                                                     <option value="Days"';
                                                                                     if(@$actscheduleid[1] == "Days"){
                                                                                      $html .='selected';
                                                                                     }
                                                                                     $html .='>Day(s) </option>
                                                                                     <option value="Weeks"';
                                                                                     if(@$actscheduleid[1] == "Weeks"){
                                                                                      $html .='selected';
                                                                                     }
                                                                                     $html .='>Week(s)</option>
                                                                                     <option value="Months"';
                                                                                     if(@$actscheduleid[1] == "Months"){
                                                                                      $html .='selected';
                                                                                     }
                                                                                     $html .='>Month(s) </option>
                                                                                     <option value="Years"';
                                                                                     if(@$actscheduleid[1] == "Years"){
                                                                                      $html .='selected';
                                                                                     }
                                                                                     $html .='>Year(s) </option>
                                                                                </select>
                                                                           </div>
                                                                      </div>
                                                                 </div>
                                                            </div>
                                                       </div>';
                                                       $dtval = "'ajax'";
                                                       $html .='<div class="col-md-4 col-sm-4 col-xs-12">
                                                            <div class="select0service">
                                                                 <label>Date This Activaties?</label>
                                                                 <div class="date-activity-scheduler date-activity-check">
                                                                      <input type="text"  name="actfildate"  id="managecalendarserviceajax" placeholder="Search By Date" class="form-control activity-scheduler-date w-80" autocomplete="off" value="'.date("m/d/Y",strtotime($cart['sesdate'])).'" onchange="changedate('.$dtval.');">
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                        </div>
                                   </div>
                              </div>
                              <input type="hidden" name="aduquantity" id="adupricequantityajax" value="'.$aduqty.'" class="product-quantity"/>
                              <input type="hidden" name="childquantity" id="childpricequantityajax" value="'.$childqty.'" class="product-quantity"/>
                              <input type="hidden" name="infantquantity" id="infantpricequantityajax" value="'.$infantqty.'" class="product-quantity"/>

                              <input type="hidden" name="cartaduprice" id="cartadupriceajax" value="'.$aduprice.'" class="product-quantity"/>
                              <input type="hidden" name="cartchildprice" id="cartchildpriceajax" value="'.$childprice.'" class="product-quantity"/>
                              <input type="hidden" name="cartinfantprice" id="cartinfantpriceajax" value="'.$infantprice.'" class="product-quantity"/>

                              <input type="hidden" name="type" value="customer">
                              <input type="hidden" name="pageid" value="'.$request->pageid.'">

                              <input type="hidden" name="priceid" value="'.$cart['priceid'].'" id="priceidajax">
                              <input type="hidden" name="actscheduleid" value="'.$cart['actscheduleid'].'" id="actscheduleidajax">
                              <input type="hidden" name="sesdate" value="'.$cart['sesdate'].'" id="sesdateajax">
                              <input type="hidden" name="pricetotal" id="pricetotalajax" value="'.$cart['totalprice'].'" class="product-price">
                              <input type="hidden" name="tip_amt_val" id="tip_amt_valajax" value="'.$cart['tip'].'" class="product-price">
                              <input type="hidden" name="dis_amt_val" id="dis_amt_valajax" value="'.$cart['discount'].'" class="product-price">
                              <input type="hidden" name="pc_regi_id" id="pc_regi_idajax" value="'.$cart['participate_from_checkout_regi']['id'].'" class="product-price">
                              <input type="hidden" name="pc_user_tp" id="pc_user_tpajax" value="'.$cart['participate_from_checkout_regi']['from'].'" class="product-price">
                              <input type="hidden" name="pc_value" id="pc_valueajax" value="'.$cart['participate_from_checkout_regi']['pc_name'].'" class="product-price">
                              <input type="hidden" name="pid" id="pidajax" value="'.$cart['code'].'">
                              <input type="hidden" name="deletepid" id="deletepid" value="'.$cart['code'].'">
                              <input type="hidden" name="categoryid" id="categoryidajax" value="'.$cart['categoryid'].'">
                              <input type="hidden" name="chk" value="activity_purchase">
                              <input type="hidden" name="value_tax" id="value_taxajax" value="'.$cart['tax'].'">
                              <button type="submit" class="btn-nxt " >Submit</a>
                         </div>
                    </div>
                    <script src="{{ url(\'public/js/jquery-ui.min.js\') }}"></script>
                    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
                    <script type="text/javascript">
                         $( function() {
                            $( "#managecalendarserviceajax" ).datepicker( { 
                              autoclose: true,
                                minDate: 0,
                                changeMonth: true,
                                changeYear: true   
                            } );
                        } );
                         $("#taxajax").click(function () {
                              get_total_ajax();
                         });
                    </script>
                    ';

               $result .= '<div class="row">
                              <div class="col-lg-12">
                                   <h4 class="modal-title partcipate-model">Select The Number of Participants</h4>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                             <div class="col-md-8 col-sm-8 col-xs-7">
                                                  <div class="counter-titles">
                                                       <p class="counter-age-heading">Adults</p>
                                                       <p>Ages 13 & Up</p>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-4 col-xs-5">
                                                  <div class="qty mt-5 counter-txt">
                                                       <span class="minus bg-darkbtn adultminus"><i class="fa fa-minus"></i></span>
                                                       <input type="text" class="count" name="adultcnt" id="adultcntajax" min="0" value="'.$aduqty.'" readonly>
                                                       <span class="plus bg-darkbtn adultplus"><i class="fa fa-plus"></i></span>
                                                  </div>
                                             </div>
                                        </div>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                             <div class="col-md-8 col-sm-8 col-xs-7">
                                                  <div class="counter-titles">
                                                       <p class="counter-age-heading">Children</p>
                                                       <p>Ages 2-12</p>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-4 col-xs-5">
                                                  <div class="qty mt-5 counter-txt">
                                                       <span class="minus bg-darkbtn childminus"><i class="fa fa-minus"></i></span>
                                                       <input type="text" class="count" name="childcnt" id="childcntajax" min="0" value="'.$childqty.'" readonly>
                                                       <span class="plus bg-darkbtn childplus"><i class="fa fa-plus"></i></span>
                                                  </div>
                                             </div>
                                        </div>
                              </div>
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                             <div class="col-md-8 col-sm-8 col-xs-7">
                                                  <div class="counter-titles">
                                                       <p class="counter-age-heading">Infants</p>
                                                       <p>Under 2</p>
                                                  </div>
                                             </div>
                                             <div class="col-md-4 col-sm-4 col-xs-5">
                                                  <div class="qty mt-5 counter-txt">
                                                       <span class="minus bg-darkbtn infantminus"><i class="fa fa-minus"></i></span>
                                                       <input type="text" class="count" name="infantcnt" id="infantcntajax" value="'.$infantqty.'" min="0" readonly>
                                                       <span class="plus bg-darkbtn infantplus"><i class="fa fa-plus"></i>
                                             </span>
                                                  </div>
                                             </div>
                                        </div>
                              </div>
                              <div id="pricedivajax">
                                   <input type="hidden" name="adultprice" id="adultpriceajax" value="'.$aduprice.'" >
                                   <input type="hidden" name="childprice" id="childpriceajax" value="'.$childprice.'" >
                                   <input type="hidden" name="infantprice" id="infantpriceajax" value="'.$infantprice.'" > 
                              </div>
                         </div>';
          }
          return $html.'~~'.$result;
     }

     public function updateorderdetails(Request $request){
          $data =  UserBookingDetail::where('id',$request->odid)->first();
          $array = json_decode($data['booking_detail'],true);
          $array['sessiondate'] = $request->date;
          UserBookingDetail::where('id',$request->odid)->update(["act_schedule_id"=>$request->timeid,"bookedtime"=>$request->date,'booking_detail'=>json_encode($array)]);
     }
}
