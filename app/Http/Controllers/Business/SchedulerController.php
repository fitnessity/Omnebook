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
    $filter_date = Carbon::parse($request->date);
    $business_schedulers = BusinessActivityScheduler::alldayschedule($filter_date,$request->activity_type)->where('cid', $request->current_company->id)->get();

    return view('business.scheduler.index', [
         'todaydate'=>$filter_date->format('l, F j , Y'),
         'business_schedulers' => $business_schedulers, 
         'filter_date' => $filter_date,
    ]);
  }
  public function destroy(Request $request){
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
       return redirect($request->return_url);
  }

  public function delete_modal(Request $request){
    $cancel_date = Carbon::parse($request->date);
    $business_scheduler = BusinessActivityScheduler::alldayschedule($cancel_date,'')
                                                      ->where('cid', $request->current_company->id)
                                                      ->findOrFail($request->business_scheduler_id);

    
    $activity_cancel = ActivityCancel::where('cancel_date', $cancel_date->format("Y-m-d"))->where('schedule_id',$business_scheduler->id)->first();

       $output = '';
       $output .='<form method="post" action="'.route("business.schedulers.destroy", ['scheduler' => $business_scheduler->id]).'">
                 <input type="hidden" name="_method" value="delete">
                 <input type="hidden" name="_token" value="'.csrf_token().'">
                 <input type ="hidden" name="can_id" value="'.@$activity_cancel->id.'">
                 <input type="hidden" name="return_url" value="'.$request->return_url.'">
                 <input type="hidden" name="schedule_id" value="'.$business_scheduler->id.'">
                 <input type="hidden" name="cancel_date" value="'.$cancel_date->format("Y-m-d").'">
                 <div class="row">
                      <div class="col-md-12">
                           <div class="">
                                <input type="checkbox" id="cancel_date_chk" name="cancel_date_chk" value="1"';
                                if(@$activity_cancel->cancel_date_chk == 1){
                                     $output .='checked';
                                }
                                $output .='>
                                <label for="vehicle1"> Cancel this activity for today only</label><br>
                                <input type="checkbox" id="show_cancel_on_schedule" name="show_cancel_on_schedule" value="1"';
                                if(@$activity_cancel->show_cancel_on_schedule == 1){
                                     $output .='checked';
                                }
                                $output .='>
                                <label for="vehicle2">Show cancellation on schedule</label><br>
                                <input type="checkbox" id="hide_cancel_on_schedule" name="hide_cancel_on_schedule" value="1"';
                                if(@$activity_cancel->hide_cancel_on_schedule == 1){
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
                                if(@$activity_cancel->email_Instructor == 1){
                                     $output .='checked';
                                }
                                $output .='>
                                <label for="vehicle1">Email Instructor ('.$request->insname.')</label><br>
                                <input type="checkbox" id="email_clients" name="email_clients" value="1"';
                                if(@$activity_cancel->email_clients == 1){
                                     $output .='checked';
                                }
                                $output .='>
                                <label for="vehicle2">You have '.$business_scheduler->spots_reserved($cancel_date).' clients registered </label><br>
                                <label class="alert-label"> Alert registed clients with an email</label><br>
                           </div>
                           <button type="submit" class="btn-nxt manage-cus-btn cancel-modal">Submit</a>
                      </div>
                 </div>
            </form>';
       return $output;
  }
}
