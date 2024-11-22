<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\{User,BusinessServices,UserBookingStatus,BusinessActivityScheduler,BusinessPriceDetailsAges,BusinessPriceDetails,UserBookingDetail,ActivityCancel,UserFamilyDetail,Customer,BookingActivityCancel,SGMailService};
use Auth;
use DB;
use Carbon\Carbon;
use DateTime;
use Config;
use View;
use App\Repositories\{BusinessServiceRepository,BookingRepository,CustomerRepository,UserRepository};
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

     public function sendreceiptfromcheckout(Request $request){
          //print_r($request->all());exit;
          $compare_chk=[];
          
          $odetail = explode("," , $request->orderdetalidary);
          foreach($odetail as $od){
               $book_data = UserBookingDetail::getbyid($od);
               $cid = @$book_data->business_id;
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
          //print_r($compare_chk);exit;
          foreach($compare_chk as $detail){
               $orderId = explode("," , $detail['oid']);
               foreach($orderId as $oid){
                    $getreceipemailtbody = $this->booking_repo->getreceipemailtbody($detail['booking_id'], $oid);

                    if($request->notes != ''){
                         $getreceipemailtbody['notes'] = $request->notes;
                    } 
                    $email_detail = array(
                         'getreceipemailtbody' => $getreceipemailtbody,
                         'email' => $request->email);
                    $status  = SGMailService::sendBookingReceipt($email_detail);
               }
          }
     }
     // public function getdropdowndata(Request $request){
     //      $output = $html = $circleSize = $textSize = $inputSize = '';
     //      $textSize = 'counter-age-heading';

     //      if($request->page == 'calendar'){
     //           $circleSize = 'calendar-plus';
     //           $textSize = 'calendar-counter-age';
     //           $inputSize = 'calendar-count';
     //      }

     //      if($request->chk == 'program'){
     //           $catelist = BusinessPriceDetailsAges::select('id','category_title')->where('serviceid',$request->sid)->get();
     //           $output = '<option value="">Select Category</option>';
     //           foreach($catelist as $cl){
     //                $output .= '<option value="'.$cl->id.'">'.$cl->category_title.'</option>';
     //           }
     //      }else if($request->chk == 'category'){
     //           $catedata = BusinessPriceDetailsAges::where('id',$request->sid)->first();

     //           if($catedata->class_type){
     //                $pricelist = $catedata->bPriceDetails()->get(); 
     //           }else{
     //                $pricelist = BusinessPriceDetails::where('category_id',$request->sid)->get();
     //           }


               
     //           $output = '<option value="">Select Price Title</option>';
     //           foreach($pricelist as $pl){
     //                $output .= '<option value="'.$pl->id.'">'.$pl->price_title.'</option>';
     //           }

     //           $addOnServices = $catedata  != '' ?  $catedata->AddOnService: [];
     //           $addOnData = View::make('business.orders.add_on_service')->with(['addOnServices' =>$addOnServices,'ajax'=>'','idsArray'=>[] ,'qtysArray'=>[]])->render();
               
     //           $html .= $catedata->dues_tax.'^^'.$catedata->sales_tax.'^!^'.$addOnData;
     //      }else if($request->chk == 'priceopt'){
     //           $membershiplist = BusinessPriceDetails::where('id',$request->sid)->first();

     //           $output = $membershiplist->membership_type;

     //           $total_price_val_adult = @$membershiplist['adult_cus_weekly_price'] == 0 &&  @$membershiplist['adult_cus_weekly_price'] == '' ? @$membershiplist['adult_weekend_price_diff'] : @$membershiplist['adult_cus_weekly_price'];

     //           $total_price_val_child = @$membershiplist['child_cus_weekly_price'] == 0 &&  @$membershiplist['child_cus_weekly_price'] == '' ? @$membershiplist['child_weekend_price_diff'] : @$membershiplist['child_cus_weekly_price'];

     //           $total_price_val_infant = @$membershiplist['infant_cus_weekly_price'] == 0 &&  @$membershiplist['infant_cus_weekly_price'] == '' ? @$membershiplist['infant_weekend_price_diff'] : @$membershiplist['infant_cus_weekly_price'];
             
     //           $aduid = $request->type == 'ajax' ? "adultpriceajax" : "adultprice";
     //           $childtid = $request->type == 'ajax' ? "childpriceajax" : "childprice";
     //           $infantid = $request->type == 'ajax' ? "infantpriceajax" : "infantprice";
     //           $session_val = $request->type == 'ajax' ? "session_valajax" : "session_val";

     //           $adultcnt = $request->type == 'ajax' ? "adultcntajax" : "adultcnt";
     //           $childcnt = $request->type == 'ajax' ? "childcntajax" : "childcnt";
     //           $infantcnt = $request->type == 'ajax' ? "infantcntajax" : "infantcnt";

     //           $isRecurringChild = $request->type == 'ajax' ? "isRecurringChildajax" : "isRecurringChild";
     //           $isRecurringAdult = $request->type == 'ajax' ? "isRecurringAdultajax" : "isRecurringAdult";
     //           $isRecurringInfant = $request->type == 'ajax' ? "isRecurringInfantajax" : "isRecurringInfant";

     //           $total_price_val_adult = $total_price_val_adult ?? 0;
     //           $total_price_val_child = $total_price_val_child ?? 0;
     //           $total_price_val_infant = $total_price_val_infant ?? 0;

     //           $isRecurringChildVal = $membershiplist->is_recurring_child  ?? 0;
     //           $isRecurringAdultVal = $membershiplist->is_recurring_adult ?? 0;
     //           $isRecurringInfantVal = $membershiplist->is_recurring_infant ?? 0;


     //           if(($total_price_val_adult == 0 && $membershiplist->dispaly_section == 'freeprice') || ($total_price_val_adult != 0 && $membershiplist->dispaly_section != 'freeprice') ){
     //                $html .='<div class="col-md-12 col-sm-12 col-xs-12">
     //                               <div class="row">
     //                                    <div class="col-md-8 col-sm-8 col-xs-6 col-6">
     //                                         <div class="counter-titles">
     //                                              <p class="'.$textSize.'">Adults</p>
     //                                              <p>Ages 13 & Up</p>
     //                                         </div>
     //                                    </div>
     //                                    <div class="col-md-4 col-sm-4 col-xs-6 col-6">
     //                                         <div class="qty counter-txt">
     //                                              <span class="minus bg-darkbtn adultminus '.$circleSize.'"><i class="fa fa-minus"></i></span>
     //                                              <input type="text" class="count '. $inputSize.'" name="adultcnt" id="'.$adultcnt.'" min="0" value="0" readonly>
     //                                              <span class="plus bg-darkbtn adultplus '.$circleSize.'"><i class="fa fa-plus"></i></span>
     //                                         </div>
     //                                    </div>
     //                               </div>
     //                          </div>';
     //           }

     //           if(($total_price_val_child == 0 && $membershiplist->dispaly_section == 'freeprice') || ($total_price_val_child != 0 && $membershiplist->dispaly_section != 'freeprice') ){
     //                $html .='<div class="col-md-12 col-sm-12 col-xs-12">
     //                               <div class="row">
     //                                    <div class="col-md-8 col-sm-8 col-xs-6 col-6">
     //                                         <div class="counter-titles">
     //                                              <p class="'.$textSize.'">Children</p>
     //                                              <p>Ages 2-12</p>
     //                                         </div>
     //                                    </div>
     //                                    <div class="col-md-4 col-sm-4 col-xs-6 col-6">
     //                                         <div class="qty counter-txt">
     //                                              <span class="minus bg-darkbtn childminus '.$circleSize.'"><i class="fa fa-minus"></i></span>
     //                                              <input type="text" class="count '. $inputSize.'" name="childcnt" id="'.$childcnt.'" min="0" value="0" readonly>
     //                                              <span class="plus bg-darkbtn childplus '.$circleSize.'"><i class="fa fa-plus"></i></span>
     //                                         </div>
     //                                    </div>
     //                               </div>
     //                          </div>';
     //           }

     //           if(($total_price_val_infant == 0 && $membershiplist->dispaly_section == 'freeprice') || ($total_price_val_infant != 0 && $membershiplist->dispaly_section != 'freeprice') ){
     //                $html .='<div class="col-md-12 col-sm-12 col-xs-12">
     //                               <div class="row">
     //                                    <div class="col-md-8 col-sm-8 col-xs-6 col-6">
     //                                         <div class="counter-titles">
     //                                              <p class="'.$textSize.'">Infants</p>
     //                                              <p>Under 2</p>
     //                                         </div>
     //                                    </div>
     //                                    <div class="col-md-4 col-sm-4 col-xs-6 col-6">
     //                                         <div class="qty counter-txt">
     //                                              <span class="minus bg-darkbtn infantminus '.$circleSize.'"><i class="fa fa-minus"></i></span>
     //                                              <input type="text" class="count '. $inputSize.'" name="infantcnt" id="'.$infantcnt.'" value="0" min="0" readonly>
     //                                              <span class="plus bg-darkbtn infantplus '.$circleSize.'"><i class="fa fa-plus"></i>
     //                                         </span>
     //                                         </div>
     //                                    </div>
     //                               </div>
     //                          </div>';
     //           }
               
     //           $html .='<input type="hidden" name="session_val" id="'.$session_val.'" value="'.@$membershiplist['pay_session'].'" >
     //                     <input type="hidden" name="adultprice" id="'.$aduid.'" value="'.$total_price_val_adult.'" >
     //                     <input type="hidden" name="childprice" id="'.$childtid.'" value="'.$total_price_val_child.'" >
     //                     <input type="hidden" name="infantprice" id="'.$infantid.'" value="'.$total_price_val_infant.'" >
     //                     <input type="hidden" name="isRecurringChild" id="'.$isRecurringChild.'" value="'.$isRecurringChildVal.'" >
     //                     <input type="hidden" name="isRecurringAdult" id="'.$isRecurringAdult.'" value="'.$isRecurringAdultVal.'" >
     //                     <input type="hidden" name="isRecurringInfant" id="'.$isRecurringInfant.'" value="'.$isRecurringInfantVal.'" >^^'.$membershiplist['pay_setnum'].'!!'.$membershiplist['pay_setduration']; 
     //      }else if($request->chk == 'participat'){
     //           $data = explode('~~',$request->sid);
     //           $data1 = explode('^^',$data[1]);
     //           if($request->user_type == 'user'){
     //                if($data1[0] == 'user'){
     //                     $user = User::select('birthdate','firstname','lastname')->where('id',$data[0])->first();
     //                     $username = $user->firstname.' '. $user->lastname;
     //                     $relation = '';
     //                     $date = $user->birthdate;
     //                }else{
     //                     $user = UserFamilyDetail::select('birthday','relationship','last_name','first_name')->where('id',$data[0])->first();
     //                     $username = $user->first_name.' '. $user->last_name;
     //                     $relation = $user->relationship;
     //                     $date = $user->birthday;
     //                }
     //           }else{
     //                $user = Customer::select('birthdate','relationship','lname','fname')->where('id',$data[0])->first();
     //                $username = $user->fname.' '. $user->lname;
     //                $relation = $user->relationship;
     //                $date = $user->birthdate;
     //           }
     //           $age = Carbon::parse($date)->age;
     //           $output .=  $age < 18 ? $username .' ('.$age .' yrs) '.$relation .' (Paid For by '.$data1[1].')': $username .' ('.$age .' yrs)';   
     //      }    
       
     //      return ($html != '' ? $output.'~~'.$html : $output);
         
     // }
     public function getdropdowndata(Request $request){
          $output = $html = $circleSize = $textSize = $inputSize = '';
          $textSize = 'counter-age-heading';

          if($request->page == 'calendar'){
               $circleSize = 'calendar-plus';
               $textSize = 'calendar-counter-age';
               $inputSize = 'calendar-count';
          }


          if ($request->chk == 'program') {
               $customer = Customer::where('id', $request->userid)->first();
               $birthdate = Carbon::parse($customer->birthdate);
               $age = $birthdate->age;
           
               // $output = '<option value="">Select Category</option>';
           
               if ($age >= 3 && $age <= 17) {
                   $pricelist = BusinessPriceDetails::where('serviceid', $request->sid)
                       ->where('is_recurring_child', '1')->distinct('category_id')
                       ->get();
              
                    if ($pricelist->isEmpty()) {
                         $output .= '<option value="">No price added</option>';
                    } else 
                         {
                              $output = '<option value="">Select Category</option>';

                              foreach ($pricelist as $price) {
                                   $category_id = $price->category_id;
                                   // $catelist = BusinessPriceDetailsAges::select('id', 'category_title')
                                   // ->where('serviceid', $request->sid)
                                   // ->where('id', $category_id)
                                   // ->get();
                                   $catelist = BusinessPriceDetailsAges::select('id', 'category_title')
                                   ->where('serviceid', $request->sid)
                                   ->whereIn('id', $pricelist->pluck('category_id'))
                                   ->get();
                         
                                   foreach ($catelist as $cl) {
                                        $output .= '<option value="' . $cl->id . '">' . $cl->category_title . '</option>';
                                   }
                              }
                         }
               }           

               else if ($age <= 2) {
                   $pricelist = BusinessPriceDetails::where('serviceid', $request->sid)
                       ->where('is_recurring_infant', '1')->distinct('category_id')
                       ->get();
               
                    if ($pricelist->isEmpty()) {
                         $output .= '<option value="">No price added</option>';
                    } else {
                         $output = '<option value="">Select Category</option>';

                         foreach ($pricelist as $price) {
                         $category_id = $price->category_id;
                         // $catelist = BusinessPriceDetailsAges::select('id', 'category_title')
                         //      ->where('serviceid', $request->sid)
                         //      ->where('id', $category_id)
                         //      ->get();
                         $catelist = BusinessPriceDetailsAges::select('id', 'category_title')
                         ->where('serviceid', $request->sid)
                         ->whereIn('id', $pricelist->pluck('category_id'))
                         ->get();
                    
                         foreach ($catelist as $cl) {
                              $output .= '<option value="' . $cl->id . '">' . $cl->category_title . '</option>';
                         }
                         }
                    }
               }
           
             else if($age >= 18) {
                   $pricelist = BusinessPriceDetails::where('serviceid', $request->sid)
                       ->where('is_recurring_adult', '1')
                       ->get();
                       

                    if ($pricelist->isEmpty()) {
                         $output .= '<option value="">No price added</option>';
                     } else {
                         $output = '<option value="">Select Category</option>';

                         foreach ($pricelist as $price) {
                             $category_id = $price->category_id;
                         //     $catelist = BusinessPriceDetailsAges::select('id', 'category_title')
                         //         ->where('serviceid', $request->sid)
                         //         ->where('id', $category_id)
                         //         ->get();
                         $catelist = BusinessPriceDetailsAges::select('id', 'category_title')
                         ->where('serviceid', $request->sid)
                         ->whereIn('id', $pricelist->pluck('category_id'))
                         ->get();
                     
                             foreach ($catelist as $cl) {
                                 $output .= '<option value="' . $cl->id . '">' . $cl->category_title . '</option>';
                             }
                         }
                     }
               }
                      
           }
           
          else if($request->chk == 'category'){
               $catedata = BusinessPriceDetailsAges::where('id',$request->sid)->first();

               if($catedata->class_type){
                    $pricelist = $catedata->bPriceDetails()->get(); 
               }else{
                    $pricelist = BusinessPriceDetails::where('category_id',$request->sid)->get();
               }


               
               $output = '<option value="">Select Price Title</option>';
               foreach($pricelist as $pl){
                    $output .= '<option value="'.$pl->id.'">'.$pl->price_title.'</option>';
               }

               $addOnServices = $catedata  != '' ?  $catedata->AddOnService: [];
               $addOnData = View::make('business.orders.add_on_service')->with(['addOnServices' =>$addOnServices,'ajax'=>'','idsArray'=>[] ,'qtysArray'=>[]])->render();
               
               $html .= $catedata->dues_tax.'^^'.$catedata->sales_tax.'^!^'.$addOnData;
          }else if($request->chk == 'priceopt'){
               // dd($request->all());
               $customer = Customer::where('id', $request->userid)->first();
               $birthdate = Carbon::parse($customer->birthdate);
               $age = $birthdate->age;
               
               $membershiplist = BusinessPriceDetails::where('id',$request->sid)->first();

               $output = $membershiplist->membership_type;

               $total_price_val_adult = @$membershiplist['adult_cus_weekly_price'] == 0 &&  @$membershiplist['adult_cus_weekly_price'] == '' ? @$membershiplist['adult_weekend_price_diff'] : @$membershiplist['adult_cus_weekly_price'];

               $total_price_val_child = @$membershiplist['child_cus_weekly_price'] == 0 &&  @$membershiplist['child_cus_weekly_price'] == '' ? @$membershiplist['child_weekend_price_diff'] : @$membershiplist['child_cus_weekly_price'];

               $total_price_val_infant = @$membershiplist['infant_cus_weekly_price'] == 0 &&  @$membershiplist['infant_cus_weekly_price'] == '' ? @$membershiplist['infant_weekend_price_diff'] : @$membershiplist['infant_cus_weekly_price'];
             
               $aduid = $request->type == 'ajax' ? "adultpriceajax" : "adultprice";
               $childtid = $request->type == 'ajax' ? "childpriceajax" : "childprice";
               $infantid = $request->type == 'ajax' ? "infantpriceajax" : "infantprice";
               $session_val = $request->type == 'ajax' ? "session_valajax" : "session_val";

               $adultcnt = $request->type == 'ajax' ? "adultcntajax" : "adultcnt";
               $childcnt = $request->type == 'ajax' ? "childcntajax" : "childcnt";
               $infantcnt = $request->type == 'ajax' ? "infantcntajax" : "infantcnt";

               $isRecurringChild = $request->type == 'ajax' ? "isRecurringChildajax" : "isRecurringChild";
               $isRecurringAdult = $request->type == 'ajax' ? "isRecurringAdultajax" : "isRecurringAdult";
               $isRecurringInfant = $request->type == 'ajax' ? "isRecurringInfantajax" : "isRecurringInfant";

               $total_price_val_adult = $total_price_val_adult ?? 0;
               $total_price_val_child = $total_price_val_child ?? 0;
               $total_price_val_infant = $total_price_val_infant ?? 0;

               $isRecurringChildVal = $membershiplist->is_recurring_child  ?? 0;
               $isRecurringAdultVal = $membershiplist->is_recurring_adult ?? 0;
               $isRecurringInfantVal = $membershiplist->is_recurring_infant ?? 0;


               if(($total_price_val_adult == 0 && $membershiplist->dispaly_section == 'freeprice') || ($total_price_val_adult != 0 && $membershiplist->dispaly_section != 'freeprice') ){
                    $html .='<div class="col-md-12 col-sm-12 col-xs-12">
                                   <div class="row">
                                        <div class="col-md-8 col-sm-8 col-xs-6 col-6">
                                             <div class="counter-titles">
                                                  <p class="'.$textSize.'">Adults</p>
                                                  <p>Ages 13 & Up</p>
                                             </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-6 col-6">
                                             <div class="qty counter-txt">
                                                  <span class="minus bg-darkbtn adultminus '.$circleSize.'"><i class="fa fa-minus"></i></span>
                                                  <input type="text" class="count '. $inputSize.'" name="adultcnt" id="'.$adultcnt.'" min="0" value="0" readonly>
                                                  <span class="plus bg-darkbtn adultplus '.$circleSize.'"><i class="fa fa-plus"></i></span>
                                             </div>
                                        </div>
                                   </div>
                              </div>';
               }

               if(($total_price_val_child == 0 && $membershiplist->dispaly_section == 'freeprice') || ($total_price_val_child != 0 && $membershiplist->dispaly_section != 'freeprice') ){
                    $html .='<div class="col-md-12 col-sm-12 col-xs-12">
                                   <div class="row">
                                        <div class="col-md-8 col-sm-8 col-xs-6 col-6">
                                             <div class="counter-titles">
                                                  <p class="'.$textSize.'">Children</p>
                                                  <p>Ages 2-12</p>
                                             </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-6 col-6">
                                             <div class="qty counter-txt">
                                                  <span class="minus bg-darkbtn childminus '.$circleSize.'"><i class="fa fa-minus"></i></span>
                                                  <input type="text" class="count '. $inputSize.'" name="childcnt" id="'.$childcnt.'" min="0" value="0" readonly>
                                                  <span class="plus bg-darkbtn childplus '.$circleSize.'"><i class="fa fa-plus"></i></span>
                                             </div>
                                        </div>
                                   </div>
                              </div>';
               }

               if(($total_price_val_infant == 0 && $membershiplist->dispaly_section == 'freeprice') || ($total_price_val_infant != 0 && $membershiplist->dispaly_section != 'freeprice') ){
                    $html .='<div class="col-md-12 col-sm-12 col-xs-12">
                                   <div class="row">
                                        <div class="col-md-8 col-sm-8 col-xs-6 col-6">
                                             <div class="counter-titles">
                                                  <p class="'.$textSize.'">Infants</p>
                                                  <p>Under 2</p>
                                             </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-6 col-6">
                                             <div class="qty counter-txt">
                                                  <span class="minus bg-darkbtn infantminus '.$circleSize.'"><i class="fa fa-minus"></i></span>
                                                  <input type="text" class="count '. $inputSize.'" name="infantcnt" id="'.$infantcnt.'" value="0" min="0" readonly>
                                                  <span class="plus bg-darkbtn infantplus '.$circleSize.'"><i class="fa fa-plus"></i>
                                             </span>
                                             </div>
                                        </div>
                                   </div>
                              </div>';
               }
               
               $html .='<input type="hidden" name="session_val" id="'.$session_val.'" value="'.@$membershiplist['pay_session'].'" >
                         <input type="hidden" name="adultprice" id="'.$aduid.'" value="'.$total_price_val_adult.'" >
                         <input type="hidden" name="childprice" id="'.$childtid.'" value="'.$total_price_val_child.'" >
                         <input type="hidden" name="infantprice" id="'.$infantid.'" value="'.$total_price_val_infant.'" >
                         <input type="hidden" name="isRecurringChild" id="'.$isRecurringChild.'" value="'.$isRecurringChildVal.'" >
                         <input type="hidden" name="isRecurringAdult" id="'.$isRecurringAdult.'" value="'.$isRecurringAdultVal.'" >
                         <input type="hidden" name="isRecurringAdult" id="age" value="'.$age.'" >
                         <input type="hidden" name="isRecurringInfant" id="'.$isRecurringInfant.'" value="'.$isRecurringInfantVal.'" >^^'.$membershiplist['pay_setnum'].'!!'.$membershiplist['pay_setduration']; 
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
               $output .=  $age < 18 ? $username .' ('.$age .' yrs) '.$relation .' (Paid For by '.$data1[1].')': $username .' ('.$age .' yrs)';   
          }    
       
          return ($html != '' ? $output.'~~'.$html : $output);
         
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
          $bookingdetail_data = UserBookingDetail::where('id',$request->order_detail_id)->first();
          $booking_data = $bookingdetail_data->booking;
          $cardInfo = [];
          if($booking_data->user_type == 'customer'){
               $cardInfo = $booking_data->customer->get_stripe_card_info();
          }else{
               $cardInfo = $booking_data->user->get_stripe_card_info();
          }
          //print_r($cardInfo);exit;
          $data = BookingActivityCancel::where(['booking_id'=> $request->oid,'order_detail_id'=> $request->order_detail_id])->first();
          $cancel_charge_amt = '';
          $html = '';
          $html .='<div class="row"> <div class="col-lg-12"><h4 class="modal-title" style="text-align: center; color: #000; line-height: inherit; font-weight: 600; margin-top: 9px;margin-bottom: 10px;">What happens if a customer late cancels or no show? </h4></div></div>';
          $html .='<div class="row">';
          $html .= '<form method="post" action="'. route('booking_activity_cancel') .'">';
          $html .= '<input type="hidden" name="_token"  value="'.csrf_token().'" />';

          $html .= '<input type="hidden" name="booking_id" id="booking_id" value="' . $booking_data->id. '">';
          $html .= '<input type="hidden" name="pageid" id="pageid" value="'.$request->business_activity_scheduler_id.'">';
          $html .= '<input type="hidden" name="order_detail_id" id="order_detail_id" value="'.$bookingdetail_data->id.'">';
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
                      <option value="'.$bookingdetail_data->business_price_detail->membership_type.'" selected>'.$bookingdetail_data->business_price_detail->membership_type.'</option>
                    </select>';
          $html .= '<button type="submit" class="btn-nxt manage-cus-btn cancel-modal">Submit</button>';
          $html .= '</form>';
          $html .= '</div>';
          return $html;
     }

}
