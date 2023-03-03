<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Libraries\Stripes\StripePay;
use App\Http\Controllers\Controller;
use App\Repositories\{UserRepository,PlanRepository,ProfessionalRepository,BookingRepository,SportsRepository};
use Illuminate\Support\Facades\Log;
use Auth;
use Session;
use File;
use Config;
use Redirect;
use View;
use DB;
use Response;
use Validator;
use App\{UserBookingStatus,User,Evidents,UserProfessionalDetail,UserService,CompanyInformation,BusinessServices,BusinessService,BusinessPriceDetails,UserBookingDetail,BusinessCompanyDetail,Fit_Cart,Sports,Customer,Payment,Miscellaneous,Jobpostquestions,UserFamilyDetail,MailService,Zip_code,BookingCheckinDetails,UserFavourite,BusinessServicesFavorite,Quote,BusinessServiceReview,BusinessActivityScheduler,BusinessSubscriptionPlan,Transaction,BusinessPriceDetailsAges,SGMailService,Recurring};
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DateTime;
use DateTimeZone;

class PaymentController extends Controller {
	protected $sports;

    public function __construct(UserRepository $users, PlanRepository $planRepository, ProfessionalRepository $professionals, SportsRepository $sports, BookingRepository $bookings) {
        
        $this->middleware('auth', ['except' => ['getBladeDetail1','profileDetail', 'SendVerificationlinkCall', 'SendVerificationlinkMsg', 'makeCall', 'generateVoiceMessage', 'sendCustomMessage', 'getBladeDetail', 'newFUn', 'getBusinessClaim', 'getStateList', 'getCityList', 'familyProfileUpdate', 'submitFamilyForm', 'submitFamilyFormWithSkip', 'check', 'deleteCompany', 'submitFamilyForm1', 'skipFamilyForm1', 'getBusinessClaimDetaill', 'businessClaim', 'getLocationBusinessClaimDetaill', 'VerifySendVerificationlink', 'searchResultLocation', 'searchResultLocation1','profileView','sendmail','mailtemplate','about','postDetail']]);

        $this->bookings = $bookings;
        $this->planRepository = $planRepository;
        $this->users = $users;
        $this->professionals = $professionals;
        $this->sports = $sports;
        $this->arr = [];        
    }

    public function createCheckoutSession(Request $request) {
      /* $cart = session()->get('cart_item');
        print_r($cart);exit();*/
        $loggedinUser = Auth::user();
        $customer='';
        $userdata = User::where('id',$loggedinUser->id)->first();

        if($request->grand_total == 0){
            $date = new DateTime("now", new DateTimeZone('America/New_York') );
            $oid = $date->format('YmdHis');
            $digits = 3;
            $rand = rand(pow(10, $digits-1), pow(10, $digits)-1);   //24 06 2022 50 9 59
            $orderid= 'FS_'.$oid.$rand;
            $orderdata = array(
                'user_id' => $loggedinUser->id,
                'status' => 'active',
                'currency_code' => 'usd',
                'stripe_id' => '',
                'stripe_status' => '',
                'amount' => $request->grand_total,
                'order_id' => $orderid,
                'order_type' => 'simpleorder',
                'bookedtime' =>$date->format('Y-m-d'),
            );
            $status = UserBookingStatus::create($orderdata);

            $transactiondata = array( 
                'user_type' => 'user',
                'user_id' => $loggedinUser->id,
                'item_type' =>'UserBookingStatus',
                'item_id' => $status->id,
                'channel' =>'',
                'kind' => 'comp',
                'transaction_id' => '',
                'amount' => $request->grand_total,
                'qty' =>'1',
                'status' =>'processing',
                'refund_amount' =>0,
                'payload' =>'',
            );

            $transactionstatus = Transaction::create($transactiondata);

            $lastid=$status->id; 

            $businessuser =[];
            $cart = session()->get('cart_item');
            $cartnew = [];
            $cnt=0;
            foreach($cart['cart_item'] as $key=>$c)
            {    
                if($c['chk'] != 'activity_purchase') {
                    $cartnew[$cnt]['name']= $c['name'];
                    $cartnew[$cnt]['code']= $c['code'];
                    $cartnew[$cnt]['priceid']= $c['priceid'];
                    $cartnew[$cnt]['sesdate']= $c['sesdate'];
                    $cartnew[$cnt]['adult']= $c['adult'];
                    $cartnew[$cnt]['child']= $c['child'];
                    $cartnew[$cnt]['infant']= $c['infant'];
                    $cartnew[$cnt]['actscheduleid']= $c['actscheduleid'];
                    $cartnew[$cnt]['participate']= $c['participate'];
                    $cnt++;
                    unset($cart['cart_item'][$key]);
                }
           } 
           $qty_c = $price_c= [];
           foreach($cartnew as $crt){
                $encodeqty ='' ; $aduqnt = $childqnt = $infantqnt = 0;
                  $aduprice = $childprice = $infantprice = 0;
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

                $participate = [];
                if(!empty($crt['participate'])){
                    $participate = $crt['participate'];
                }
                
                $qty_c= array( 'adult'=>$aduqnt ,'child' =>$childqnt,
                    'infant'=>$infantqnt); 
                $price_c = array( 'adult'=>$aduprice ,'child' =>$childprice,
                    'infant'=>$infantprice);
                $adupmt_num = $childpmt_num = $infantpmt_num = 0;
                
                $payment_number_c = array();
                $encodeqty = json_encode($qty_c);
                $encodeprice = json_encode($price_c);
                $encodepayment_number = json_encode($payment_number_c);
                $encodeparticipate = json_encode($participate);
                $activitylocation = BusinessServices::where('id',$crt['code'])->first();
                $business_id = $activitylocation->cid;
                $act = array(
                     'booking_id' => $lastid,
                     'sport' => $crt['code'],
                     'business_id' => $business_id ,
                     'price' => 0,
                     'qty' => $encodeqty  ,
                     'priceid' => $crt['priceid'],
                     'bookedtime' =>date('Y-m-d',strtotime($crt['sesdate'])),
                     'contract_date' =>date('Y-m-d',strtotime($crt['sesdate'])),
                     'booking_detail' => json_encode(array(
                          'activitytype' => @$activitylocation->service_type,
                          'numberofpersons' => 1,
                          'activitylocation' => @$activitylocation->activity_location,
                          'whoistraining' => 'me',
                          'sessiondate' => $crt['sesdate'],
                     )),
                     'extra_fees' => json_encode(array(
                         'service_fee' => 0,
                         'fitnessity_fee' =>0,
                         'tax' => 0,
                     )),
                     'act_schedule_id' =>$crt['actscheduleid'],
                     'participate' =>$encodeparticipate,
                     'transfer_provider_status' =>'unpaid',
                     'payment_number'=>$encodepayment_number,
                );

                $statusdetail = UserBookingDetail::create($act);

                $getreceipemailtbody = $this->bookings->getreceipemailtbody($status->id, $statusdetail->id);
                $email_detail = array(
                    'getreceipemailtbody' => $getreceipemailtbody,
                    'email' => Auth::user()->email);
                SGMailService::sendBookingReceipt($email_detail);
           }

           session()->forget('stripepayid');
           session()->forget('stripechargeid');
           session()->put('cart_item', $cart);
           return view('jobpost.confirm-payment-instant');
        }else{
            \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
            $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
            //print_r($request->all());exit();

            if(empty($userdata['stripe_customer_id'])) {
                $customer = \Stripe\Customer::create(
                [
                    'name' => $userdata['firstname'].' '.$userdata['lastname'],
                    'email'=> $userdata['email'],
                ]);
                $stripe_customer_id = $customer->id;
                if(!empty($customer)){
                    User::where(['id' => $loggedinUser->id])->update(['stripe_customer_id' => $customer->id]);
                }
            }else{
                $stripe_customer_id = $userdata['stripe_customer_id'];
            }

            $listItems = []; 
            $proid = []; 
            $totalprice = 0;
            /*for($i=0;$i<count($request->itemprice);$i++){
                $totalprice += $request->itemprice[$i];
            }*/
            $totalprice = ($request->grand_total) *100;
     
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

            if($request->has('cardinfo')){
                $carddetails = $stripe->customers->retrieveSource(
                    $stripe_customer_id,
                    $request->cardinfo,
                    []
                );

                try {
                    $pmtintent = \Stripe\PaymentIntent::create([
                        'amount' =>  $totalprice,
                        'currency' => 'usd',
                        'customer' => $stripe_customer_id,
                        'payment_method' => $carddetails->id,
                        'off_session' => true,
                        'confirm' => true,
                        'metadata' => [
                            "pro_id" => $prodata,
                            "listItems" =>$listItems,
                        ],
                    ]);
                }catch(\Stripe\Exception\CardException $e) {
                    $errormsg = $e->getError()->message;
                    return redirect('/carts')->with('stripeErrorMsg', $errormsg);
                }catch (Exception $e) {
                    $errormsg = "There Is An Error While Proccessing Your Payment...Please Check Your Details Again.. ";
                    return redirect('/carts')->with('stripeErrorMsg', $errormsg);
                }
            }else{

                if($request->save_card == 1){
                    try {
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
                        DB::insert('insert into users_payment_info (user_id,card_stripe_id,card_token_id) values (?, ?, ?)', [$loggedinUser->id, $carddetails['card']->id, $carddetails->id]);
            
                        $payment_method = $customer_source->id;
                    }catch(\Stripe\Exception\CardException $e) {
                        $errormsg = $e->getError()->message;
                        return redirect('/carts')->with('stripeErrorMsg', $errormsg);
                    }catch (Exception $e) {
                        $errormsg = "There Is An Error While Proccessing Your Payment...Please Check Your Details Again.. ";
                        return redirect('/carts')->with('stripeErrorMsg', $errormsg);
                    }
                }else{
                    try {
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
                    }catch(\Stripe\Exception\CardException $e) {
                        $errormsg = $e->getError()->message;
                        return redirect('/carts')->with('stripeErrorMsg', $errormsg);
                    }catch (Exception $e) {
                        $errormsg = "There Is An Error While Proccessing Your Payment...Please Check Your Details Again.. ";
                        return redirect('/carts')->with('stripeErrorMsg', $errormsg);
                    }
                }
                
                try {
                    $pmtintent = \Stripe\PaymentIntent::create([
                        'amount' => round($totalprice),
                        'currency' => 'usd',
                        'payment_method' => $payment_method,
                        'customer' => $stripe_customer_id,
                        'off_session' => true,
                        'confirm' => true,
                        'metadata' => [
                            "pro_id" => $prodata,
                            "listItems" =>$listItems,
                        ],
                    ]);
                }catch(\Stripe\Exception\CardException $e) {
                    $errormsg = $e->getError()->message;
                    return redirect('/carts')->with('stripeErrorMsg', $errormsg);
                }catch (Exception $e) {
                    $errormsg = "There Is An Error While Proccessing Your Payment...Please Check Your Details Again.. ";
                    return redirect('/carts')->with('stripeErrorMsg', $errormsg);
                }
            }

            $request->session()->put('stripepayid', $pmtintent->id);
            return redirect('/instant-hire/confirm-payment');
        }
    }

    public function confirmpaymentinstant(Request $request) {
       /* print_r($request->all());*/
        $payid=$request->session()->get('stripepayid');
        $charge_id=$request->session()->get('stripechargeid');
        \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
    
        $stripe = new \Stripe\StripeClient(
            config('constants.STRIPE_KEY')
        );

        $fitnessity_fee= 0;
        $bspdata = BusinessSubscriptionPlan::where('id',1)->first();
        $service_fee = $bspdata->service_fee;
        $tax = $bspdata->site_tax;


        $payment_intent = $stripe->paymentIntents->retrieve(
            $payid,
            []
        );

        $data = json_decode( json_encode( $payment_intent),true);
        $amount= ($data["amount"]/100);
        $date = new DateTime("now", new DateTimeZone('America/New_York') );
        $oid = $date->format('YmdHis');
        $digits = 3;
        $rand = rand(pow(10, $digits-1), pow(10, $digits)-1);   //24 06 2022 50 9 59
        $orderid= 'FS_'.$oid.$rand;
    
        $lastid='';
        if($data['status']=='succeeded')
        {
            $orderdata = array(
                'user_id' => Auth::user()->id,
                'status' => 'active',
                'currency_code' => $data["currency"],
                'stripe_id' => $data["id"],
                'stripe_status' => $data["status"],
                'amount' => $amount,
                'order_id' => $orderid,
                'bookedtime' =>$date->format('Y-m-d'),
            ); 
            $status = UserBookingStatus::create($orderdata);

            $transactiondata = array( 
                'user_type' => 'user',
                'user_id' => Auth::user()->id,
                'item_type' =>'UserBookingStatus',
                'item_id' => $status->id,
                'channel' =>'stripe',
                'kind' => 'card',
                'transaction_id' => $data["id"],
                'amount' => $amount,
                'qty' =>'1',
                'status' =>'processing',
                'refund_amount' =>0,
                'payload' =>json_encode( $payment_intent,true),
            );
            $transactionstatus = Transaction::create($transactiondata);

            $lastid=$status->id;
            $businessuser =[];
            $cart = session()->get('cart_item');
            $cartnew = [];
                
            $cnt=0;
            foreach($cart['cart_item'] as $key=>$c)
            {
                if($c['chk'] != 'activity_purchase') {
                    $cartnew[$cnt]['name']= $c['name'];
                    $cartnew[$cnt]['code']= $c['code'];
                    $cartnew[$cnt]['priceid']= $c['priceid'];
                    $cartnew[$cnt]['sesdate']= $c['sesdate'];
                    $cartnew[$cnt]['adult']= $c['adult'];
                    $cartnew[$cnt]['child']= $c['child'];
                    $cartnew[$cnt]['infant']= $c['infant'];
                    $cartnew[$cnt]['actscheduleid']= $c['actscheduleid'];
                    $cartnew[$cnt]['participate']= $c['participate'];
                    $cnt++;
                    unset($cart['cart_item'][$key]);
                }
            }   
           
            $metadatapro = json_decode($data['metadata']['pro_id']);
            $metadatalistItems = json_decode($data['metadata']['listItems']);
            $aduprice = $childprice = $infantprice = 0;
            $aduqnt = $childqnt = $infantqnt = 0;
            //print_r($cartnew);
            $fit_acc_amt = 0;
            for($i=0;$i<count($metadatapro);$i++)
            {
                $tax_person = $priceid=0; $sesdate= $encodeqty ='' ;
                $aduqnt = $childqnt = $infantqnt =0; 
                $fitnessity_fee = 0;
                if ($metadatapro[$i] == $cartnew[$i]['code'])
                {   
                    $transfer_amt_to_bususer = 0;
                    $tot_pri = 0;
                    $per_act_trns_amt_to_admin =0;
                    $tot_fee_adu =0;
                    $tot_fee_child =0;
                    $tot_fee_infant =0;
                    $discount =0;
                    $priceid = $cartnew[$i]['priceid'];
                    $sesdate = $cartnew[$i]['sesdate'];
                    $pidval = $cartnew[$i]['code'];
                    $price_detail = BusinessPriceDetails::find($priceid);
                    $activitylocation = BusinessServices::where('id',$pidval)->first();
                    $business_id = $activitylocation->cid;
                    $fitnessity_fee = $activitylocation->user->fitnessity_fee;
                    $act_schedule_id = $cartnew[$i]['actscheduleid'];
                    if(!empty($cartnew[$i]['adult'])){
                        $aduqnt = $cartnew[$i]['adult']['quantity'];
                        $aduprice = $cartnew[$i]['adult']['price'];
                        $tot_fee_adu =  ($aduprice * $fitnessity_fee) / 100;
                        $discount +=  ($aduprice * $price_detail->adult_discount) / 100;
                        $per_act_trns_amt_to_admin +=   $tot_fee_adu * $aduqnt ;
                        $tot_pri +=   $aduqnt * $aduprice ;
                    }
                    if(!empty($cartnew[$i]['child'])){
                        $childqnt = $cartnew[$i]['child']['quantity'];
                        $childprice= $cartnew[$i]['child']['price'];
                        $discount +=  ($childprice * $price_detail->child_discount) / 100;
                        $tot_fee_child =  ($childprice * $fitnessity_fee) / 100;
                        $per_act_trns_amt_to_admin  += $tot_fee_child * $childqnt ;
                        $tot_pri +=   $childqnt * $childprice ;
                    }
                    if(!empty($cartnew[$i]['infant'])){
                        $infantqnt = $cartnew[$i]['infant']['quantity'];
                        $infantprice = $cartnew[$i]['infant']['price'];
                        $tot_fee_infant =   ($infantprice * $fitnessity_fee) / 100;
                        $discount +=  ($infantprice * $price_detail->infant_discount) / 100;
                        $per_act_trns_amt_to_admin  += $tot_fee_infant * $infantqnt ;
                        $tot_pri +=   $infantqnt * $infantprice ;
                    }

                    $transfer_amt_to_bususer = $tot_pri - $per_act_trns_amt_to_admin ;
                    $fit_acc_amt += $per_act_trns_amt_to_admin ;

                    $participate = [];
                    if(!empty($cartnew[$i]['participate'])){
                        $participate = $cartnew[$i]['participate'];
                    }
                    
                    $qty_c= array( 'adult'=>$aduqnt ,'child' =>$childqnt,
                        'infant'=>$infantqnt); 
                    $price_c = array( 'adult'=>$aduprice ,'child' =>$childprice,
                        'infant'=>$infantprice);
                    $adupmt_num = $childpmt_num = $infantpmt_num = 0;
                    if($aduqnt != 0){
                        $adupmt_num = 1;
                    }
                    if($childqnt != 0){
                        $childpmt_num = 1;
                    }
                    if($infantqnt != 0){
                        $infantpmt_num = 1;
                    }
                    $payment_number_c = array( 'adult'=>$adupmt_num ,'child' => $childpmt_num,
                        'infant'=> $infantpmt_num);
                    $encodeqty = json_encode($qty_c);
                    $encodeprice = json_encode($price_c);
                    $encodepayment_number = json_encode($payment_number_c);
                    $encodeparticipate = json_encode($participate);
                }

                $activity_scheduler = BusinessActivityScheduler::find($act_schedule_id);
                $act = array(
                    'booking_id' => $lastid,
                    'sport' => $pidval,
                    'business_id' => $business_id ,
                    'price' => $encodeprice,
                    'qty' =>$encodeqty ,
                    'priceid' => $priceid,
                    'pay_session' => $price_detail->pay_session,
                    'expired_at' => $activity_scheduler->end_activity_date,
                    'bookedtime' =>date('Y-m-d',strtotime($sesdate)),
                    'contract_date' =>date('Y-m-d',strtotime($sesdate)),
                    'booking_detail' => json_encode(array(
                            'activitytype' => $activitylocation->service_type,
                            'numberofpersons' => 1,
                            'activitylocation' => $activitylocation->activity_location,
                            'whoistraining' => 'me',
                            'sessiondate' => $sesdate,
                    )),
                    'extra_fees' => json_encode(array(
                        'service_fee' => $service_fee,
                        'fitnessity_fee' => $fitnessity_fee,
                        'tax' => $tax,
                    )),
                    'act_schedule_id' =>$act_schedule_id,
                    'payment_number' =>$encodepayment_number,
                    'participate' =>$encodeparticipate,
                    'transfer_provider_status' =>'unpaid',
                    'subtotal'=>$tot_pri,
                    'tax' =>$tax,
                    'tip' =>0,
                    'discount' =>$discount,
                    'fitnessity_fee' =>Auth::user()->fitnessity_fee,
                );
                $statusdetail = UserBookingDetail::create($act);
                if($aduqnt != 0){
                    $tax_person++;
                }if($childqnt != 0){
                    $tax_person++;
                }if($infantqnt != 0){
                    $tax_person++;
                }
                foreach($qty_c as $key=> $qty){
                    $date = new Carbon;
                    $stripe_id = $stripe_charged_amount = $payment_method= '';
                    $re_i = $tax_person = 0; 
                    if($key == 'adult'){
                        if($qty != '' && $qty != 0){
                            $amount = $price_detail->recurring_first_pmt_adult;
                            $re_i = $price_detail->recurring_nuberofautopays_adult;
                        }
                    }

                    if($key == 'child'){
                        if($qty != '' && $qty != 0){
                            $amount = $price_detail->recurring_first_pmt_child;
                            $re_i = $price_detail->recurring_nuberofautopays_child;
                        }
                    }

                    if($key == 'infant'){
                        if($qty != '' && $qty != 0){
                            $amount = $price_detail->recurring_first_pmt_infant;
                            $re_i = $price_detail->recurring_nuberofautopays_infant;
                        }
                    }

                    $per_person_tax = $tax / $tax_person; 
                    if($qty != '' && $qty != 0){
                        if($re_i != '' && $re_i != 0 && $amount != ''){
                            for ($num = $re_i; $num >0 ; $num--) { 
                                if($num==1){
                                    $stripe_id =  $status->stripe_id;
                                    $stripe_charged_amount = $status->amount;
                                    $payment_method = $transactionstatus['kind'];
                                    $payment_date = $date->format('Y-m-d');
                                    $status = 'Completed';
                                }else{
                                    $month = $num - 1;
                                    $payment_date = (Carbon::now()->addMonth($month))->format('Y-m-d');
                                    $status = 'Scheduled';
                                } 

                                $recurring = array(
                                    "booking_detail_id" => $statusdetail->id,
                                    "user_id" => Auth::user()->id,
                                    "user_type" => 'user',
                                    "business_id" => $business_id ,
                                    "payment_date" => $payment_date,
                                    "amount" => $amount,
                                    'charged_amount'=> $stripe_charged_amount,
                                    'payment_method'=> $payment_method,
                                    'stripe_payment_id'=> $stripe_id,
                                    "tax" => $tax,
                                    "status" => $status,
                                );
                                Recurring::create($recurring);
                            }
                        }
                    }

                }
                

                $customer = Customer::where(['business_id' => $activitylocation->cid, 'email' => Auth::user()->email, 'user_id' => Auth::user()->id])->first();

                if(!$customer){
                    $customer = Customer::create([
                        'business_id' => $activitylocation->cid,
                        'fname' => Auth::user()->firstname,
                        'lname' => (Auth::user()->lastname) ? Auth::user()->lastname : '',
                        'username' => Auth::user()->username,
                        'email' => Auth::user()->email,
                        'country' => 'US',
                        'status' => 0,
                        'phone_number' => Auth::user()->phone_number,
                        'birthdate' => Auth::user()->birthdate,
                        'user_id' => Auth::user()->id
                    ]);

                    $customer->create_stripe_customer_id();
                }

                BookingCheckinDetails::create([
                    'business_activity_scheduler_id' => $act_schedule_id,
                    'customer_id' => $customer->id,
                    'booking_detail_id' => $statusdetail->id,
                    'checkin_date' => date('Y-m-d',strtotime($sesdate)),
                    'use_session_amount' => 0,
                    'source_type' => 'marketplace',
                ]);

                $getreceipemailtbody = $this->bookings->getreceipemailtbody($status->id, $statusdetail->id);
                $email_detail = array(
                    'getreceipemailtbody' => $getreceipemailtbody,
                    'email' => Auth::user()->email);
                SGMailService::sendBookingReceipt($email_detail);
                $statusdetail->transfer_to_provider();
            }

            session()->put('cart_item', $cart);
            session()->forget('stripepayid');
            session()->forget('stripechargeid');
        }
        return view('jobpost.confirm-payment-instant');
    }

    public function form_participate(Request $request){
     /*   print_r($request->all());exit;*/
        $cart_item = [];
        if ($request->session()->has('cart_item')) {
            $cart_item = $request->session()->get('cart_item');
        }
        if(in_array($request->act, array_keys($cart_item["cart_item"]))) {
            foreach($cart_item["cart_item"] as $k => $v) {
                if($request->act == $k) {
                    if($request->type == 'user'){
                        $cart_item["cart_item"][$k]["participate"][$request->counter]['id'] = Auth::user()->id;
                        $cart_item["cart_item"][$k]["participate"][$request->counter]['from'] = 'user';
                    }else{
                        $cart_item["cart_item"][$k]["participate"][$request->counter]['id'] = $request->familyid;
                        $cart_item["cart_item"][$k]["participate"][$request->counter]['from'] = 'family';
                    }
                }
            }
        }
        $request->session()->put('cart_item', $cart_item);
    }  

    
}
