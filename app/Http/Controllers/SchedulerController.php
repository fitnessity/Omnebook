<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\{User,BusinessCompanyDetail,CompanyInformation,BusinessServices,UserBookingStatus,BusinessActivityScheduler,BusinessPriceDetailsAges,BusinessPriceDetails,StaffMembers,UserBookingDetail,ActivityCancel,UserFamilyDetail,BusinessSubscriptionPlan,Customer,BookingActivityCancel,BookingCheckinDetails,BookingPostorder,SGMailService,MailService};
use Auth;
use DB;
use Carbon\Carbon;
use DateTime;
use Config;
use DateInterval;
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
               $getreceipemailtbody = $this->booking_repo->getreceipemailtbody($detail['booking_id'], $detail['oid']);
               $email_detail = array(
                'getreceipemailtbody' => $getreceipemailtbody,
                'email' => $request->email);
                $status  = SGMailService::sendBookingReceipt($email_detail);
          }
     }
     public function getdropdowndata(Request $request){
          $output = '';
          $html = '';
          if($request->chk == 'program'){
               $catelist = BusinessPriceDetailsAges::select('id','category_title')->where('serviceid',$request->sid)->get();
               $output = '<option value="">Select Category</option>';
               foreach($catelist as $cl){
                    $output .= '<option value="'.$cl->id.'">'.$cl->category_title.'</option>';
               }
          }else if($request->chk == 'category'){
               $catedata = BusinessPriceDetailsAges::where('id',$request->sid)->first();
               $pricelist = BusinessPriceDetails::where('category_id',$request->sid)->get();
               $output = '<option value="">Select Price Title</option>';
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
               //$membershiplist = BusinessPriceDetails::where('id',$request->sid)->get();
               $membershiplist = BusinessPriceDetails::where('id',$request->sid)->first();
               /*$output = '<option value="">Select Membership Type</option>';
               foreach($membershiplist as $pl){
                    $output .= '<option value="'.$pl->id.'">'.$pl->membership_type.'</option>';
               }*/

               //print_r( $membershiplist);exit;
               $output = $membershiplist->membership_type;
               $total_price_val_adult =  @$membershiplist['adult_cus_weekly_price'];
               $total_price_val_child =  @$membershiplist['child_cus_weekly_price'];
               $total_price_val_infant =  @$membershiplist['infant_cus_weekly_price']; 

               if($total_price_val_adult == 0 &&  $total_price_val_adult == '' ){
                    $total_price_val_adult =  @$membershiplist['adult_weekend_price_diff'];
               }

               if($total_price_val_child == 0 &&  $total_price_val_child == '' ){
                    $total_price_val_child =  @$membershiplist['child_weekend_price_diff'];
               }

               if($total_price_val_infant == 0 &&  $total_price_val_infant == '' ){
                    $total_price_val_infant =  @$membershiplist['infant_weekend_price_diff'];
               }
               $aduid = "adultprice";
               $childtid = "childprice";
               $infantid = "infantprice";
               $session_val = "session_val";
               if($request->type == 'ajax'){
                    $aduid = "adultpriceajax";
                    $childtid = "childpriceajax";
                    $infantid = "infantpriceajax";
                    $session_val = "session_valajax";
               }


               if($total_price_val_adult != 0 &&  $total_price_val_adult != '' ){
                    $html .='<div class="col-md-12 col-sm-12 col-xs-12">
                                   <div class="row">
                                        <div class="col-md-8 col-sm-8 col-xs-6">
                                             <div class="counter-titles">
                                                  <p class="counter-age-heading">Adults</p>
                                                  <p>Ages 13 & Up</p>
                                             </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                             <div class="qty mt-5 counter-txt">
                                                  <span class="minus bg-darkbtn adultminus"><i class="fa fa-minus"></i></span>
                                                  <input type="text" class="count" name="adultcnt" id="adultcnt" min="0" value="0" readonly>
                                                  <span class="plus bg-darkbtn adultplus"><i class="fa fa-plus"></i></span>
                                             </div>
                                        </div>
                                   </div>
                              </div>';
               }

               if($total_price_val_child != 0 &&  $total_price_val_child != '' ){
                    $html .='<div class="col-md-12 col-sm-12 col-xs-12">
                                   <div class="row">
                                        <div class="col-md-8 col-sm-8 col-xs-6">
                                             <div class="counter-titles">
                                                  <p class="counter-age-heading">Children</p>
                                                  <p>Ages 2-12</p>
                                             </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                             <div class="qty mt-5 counter-txt">
                                                  <span class="minus bg-darkbtn childminus"><i class="fa fa-minus"></i></span>
                                                  <input type="text" class="count" name="childcnt" id="childcnt" min="0" value="0" readonly>
                                                  <span class="plus bg-darkbtn childplus"><i class="fa fa-plus"></i></span>
                                             </div>
                                        </div>
                                   </div>
                              </div>';
               }

               if($total_price_val_infant != 0 &&  $total_price_val_infant != '' ){
                    $html .='<div class="col-md-12 col-sm-12 col-xs-12">
                                   <div class="row">
                                        <div class="col-md-8 col-sm-8 col-xs-6">
                                             <div class="counter-titles">
                                                  <p class="counter-age-heading">Infants</p>
                                                  <p>Under 2</p>
                                             </div>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                             <div class="qty mt-5 counter-txt">
                                                  <span class="minus bg-darkbtn infantminus"><i class="fa fa-minus"></i></span>
                                                  <input type="text" class="count" name="infantcnt" id="infantcnt" value="0" min="0" readonly>
                                                  <span class="plus bg-darkbtn infantplus"><i class="fa fa-plus"></i>
                                             </span>
                                             </div>
                                        </div>
                                   </div>
                              </div>';
               }
               
               $html .='<input type="hidden" name="session_val" id="'.$session_val.'" value="'.@$membershiplist['pay_session'].'" >
                         <input type="hidden" name="adultprice" id="'.$aduid.'" value="'.$total_price_val_adult.'" >
                         <input type="hidden" name="childprice" id="'.$childtid.'" value="'.$total_price_val_child.'" >
                         <input type="hidden" name="infantprice" id="'.$infantid.'" value="'.$total_price_val_infant.'" >^^'.$membershiplist['pay_setnum'].'!!'.$membershiplist['pay_setduration']; 
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

     public function editcartmodel(Request $request){
          $cart_item = [];
          if (session()->has('cart_item')) {
               $cart_item = session()->get('cart_item');
          }
          $html = '';
          $salestaxajax = 0;
          $duestaxajax = 0;
          $result = '';
          $cart = [];
          if(in_array($request->priceid, array_keys($cart_item["cart_item"]))) {
               $cart = $cart_item["cart_item"][$request->priceid];
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
                                                       <div class="col-md-2 col-sm-4 col-xs-12">
                                                            <div class="select0service pricedollar">
                                                                 <label>Price </label>
													<div class="set-price">
														<i class="fas fa-dollar-sign"></i>
													</div>
                                                                 <input type="text" class="form-control valid" id="priceajax" placeholder="$0.00" value="'.$cart["totalprice"].'">
                                                            </div>
                                                       </div>
                                                       <div class="col-md-2 col-sm-4 col-xs-12">
                                                            <div class="select0service pricedollar">
                                                                 <label>Session</label>
                                                                 <input type="text" class="form-control valid" id="p_sessionajax" name="pay_session" placeholder="1"  value="'.$cart["p_session"].'" >
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
                         document.getElementById("priceajax").onkeyup = function() {
                              var price = parseFloat($(this).val());
                              $("#pricetotalajax").val(price);
                              var chkadu = chkchild = chkinfant = 0;
                              var qty = uniqueprice = 0;
                              if($("#adupricequantityajax").val() != "" && $("#adupricequantityajax").val() != 0 && $("#adultpriceajax").val() != ""){
                                   qty += parseInt($("#adupricequantityajax").val());
                                   chkadu = 1;
                              }if($("#childpricequantityajax").val() != "" && $("#childpricequantityajax").val() != 0 && $("#childpriceajax").val() != ""){
                                   qty += parseInt($("#childpricequantityajax").val());
                                   chkchild = 1;
                              }if($("#infantpricequantityajax").val() != "" && $("#infantpricequantityajax").val() != 0 && $("#infantprice").val() != ""){
                                   qty += parseInt($("#infantpricequantityajax").val());
                                   chkinfant = 1;
                              }
                              if(qty != 0 && price != 0 && price != "undefined"){
                                   uniqueprice = parseFloat(price/parseFloat(qty));
                              }
                              if(chkadu == 1  && $("#adultpriceajax").val() != ""){
                                   $("#cartadupriceajax").val(uniqueprice);
                              }
                              if(chkchild == 1 && $("#childpriceajax").val() != ""){
                                   $("#cartchildpriceajax").val(uniqueprice);
                              }
                              if(chkinfant == 1 && $("#infantpriceajax").val() != ""){
                                   $("#cartinfantpriceajax").val(uniqueprice);
                              }
                              get_total_ajax();
                         };
                    </script>';

               $result .= '<div class="row">
                              <div class="col-lg-12">
                                   <h4 class="modal-title partcipate-model">Select The Number of Participants</h4>
                              </div>';

               if($aduprice != '' &&  $aduprice != '0'){
                    $result .= '<div class="col-md-12 col-sm-12 col-xs-12">
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
                              </div>';
               }
               if($childprice != '' &&  $childprice != '0'){
                    $result .= '<div class="col-md-12 col-sm-12 col-xs-12">
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
                              </div>';
               }
               if($infantprice != '' &&  $infantprice != '0'){
                    $result .= ' <div class="col-md-12 col-sm-12 col-xs-12">
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
                              </div>';
               }
                    $result .= '<div id="pricedivajax">
                                   <input type="hidden" name="session_val" id="session_valajax" value="'.@$cart["p_session"].'" >
                                   <input type="hidden" name="adultprice" id="adultpriceajax" value="'.$aduprice.'" >
                                   <input type="hidden" name="childprice" id="childpriceajax" value="'.$childprice.'" >
                                   <input type="hidden" name="infantprice" id="infantpriceajax" value="'.$infantprice.'" > 
                              </div>
                         </div>';
          }
          return $html.'~~'.$result;
     }
}
