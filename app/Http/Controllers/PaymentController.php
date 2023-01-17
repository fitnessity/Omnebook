<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Libraries\Stripes\StripePay;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\PlanRepository;
use App\Repositories\ProfessionalRepository;
use App\Repositories\BookingRepository;
use App\Repositories\SportsRepository;
use Illuminate\Support\Facades\Log;
use Auth;
use Session;
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
use App\Customer;
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
use App\BusinessSubscriptionPlan;

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
        $fitnessity_fee = $bspdata->fitnessity_fee;
        $service_fee = $bspdata->service_fee;
        $tax = $bspdata->site_tax;


        $payment_intent = $stripe->paymentIntents->retrieve(
          	$payid,
          	[]
        );

        // print_r($payment_intent);exit;
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
                'status' => 'confirmed',
                'currency_code' => $data["currency"],
                'stripe_id' => $data["id"],
                'stripe_status' => $data["status"],
                'amount' => $amount,
                'order_id' => $orderid,
                'bookedtime' =>$date->format('Y-m-d'),
            ); 
            $status = UserBookingStatus::create($orderdata);

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
                $priceid=0; $sesdate= $encodeqty ='' ;
                $aduqnt = $childqnt = $infantqnt =0; 
                
                if ($metadatapro[$i] == $cartnew[$i]['code'])
                {   
                    $transfer_amt_to_bususer = 0;
                    $tot_pri = 0;
                    $per_act_trns_amt_to_admin =0;
                    $tot_fee_adu =0;
                    $tot_fee_child =0;
                    $tot_fee_infant =0;
                    $priceid = $cartnew[$i]['priceid'];
                    $sesdate = $cartnew[$i]['sesdate'];
                    $pidval = $cartnew[$i]['code'];
                    $qty = $cartnew[$i]['code'];
                    $act_schedule_id = $cartnew[$i]['actscheduleid'];
                    if(!empty($cartnew[$i]['adult'])){
                        $aduqnt = $cartnew[$i]['adult']['quantity'];
                        $aduprice = $cartnew[$i]['adult']['price'];
                        $tot_fee_adu =  ($aduprice * $fitnessity_fee) / 100;
                        $per_act_trns_amt_to_admin +=   $tot_fee_adu * $aduqnt ;
                        $tot_pri +=   $aduqnt * $aduprice ;
                    }
                    if(!empty($cartnew[$i]['child'])){
                        $childqnt = $cartnew[$i]['child']['quantity'];
                        $childprice= $cartnew[$i]['child']['price'];
                        $tot_fee_child =  ($childprice * $fitnessity_fee) / 100;
                        $per_act_trns_amt_to_admin  += $tot_fee_child * $childqnt ;
                        $tot_pri +=   $childqnt * $childprice ;
                    }
                    if(!empty($cartnew[$i]['infant'])){
                        $infantqnt = $cartnew[$i]['infant']['quantity'];
                        $infantprice = $cartnew[$i]['infant']['price'];
                        $tot_fee_infant =   ($infantprice * $fitnessity_fee) / 100;
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

                $activitylocation = BusinessServices::where('id',$pidval)->first();
                $price_detail = BusinessPriceDetails::find($priceid);
                $activity_scheduler = BusinessActivityScheduler::find($act_schedule_id);
                $act = array(
                    'booking_id' => $lastid,
                    'sport' => $pidval,
                    'price' => $encodeprice,
                    'qty' =>$encodeqty ,
                    'priceid' => $priceid,
                    'pay_session' => $price_detail->pay_session,
                    'expired_at' => $activity_scheduler->end_activity_date,
                    'bookedtime' =>date('Y-m-d',strtotime($sesdate)),
                    'booking_detail' => json_encode(array(
                            'activitytype' => $activitylocation->service_type,
                            'numberofpersons' => 1,
                            'activitylocation' => $activitylocation->activity_location,
                            'whoistraining' => 'me',
                            'sessiondate' => $sesdate,
                    )),
                    'extra_fees' => json_encode(array(
                        'service_fee' => $service_fee,
                        'fitnessity_fee' => $tax,
                    )),
                    'act_schedule_id' =>$act_schedule_id,
                    'payment_number' =>$encodepayment_number,
                    'participate' =>$encodeparticipate,
                    'transfer_provider_status' =>'unpaid',
                );
                $status = UserBookingDetail::create($act);

                $customer = Customer::where(['business_id' => Auth::user()->email, 'user_id' => Auth::user()->id])->first();

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
                    ]);

                    $customer->create_stripe_customer_id();
                }


                $BookingDetail_1 = $this->bookings->getBookingDetailnew($lastid);
                $businessuser['businessuser'] = CompanyInformation::where('id', $activitylocation->cid)->first();
                $businessuser = json_decode(json_encode($businessuser), true); 
                $BusinessServices['businessservices'] = BusinessServices::where('id',$activitylocation->id)->first();
                $BusinessServices = json_decode(json_encode($BusinessServices), true);
                $BookingDetail_1 = $this->bookings->getBookingDetailnew($lastid);
                foreach($BookingDetail_1['user_booking_detail'] as  $key => $details){
                    if($details['sport'] == $pidval){
                        if($BookingDetail_1['user_booking_detail'][$key]['booking_id'] = $lastid){
                            $BookingDetail_1['user_booking_detail'] = $details;
                        }
                        $BookingDetail[] = array_merge($BookingDetail_1,$businessuser,$BusinessServices);
                    }
                }

                $status->transfer_to_provider();

                

                MailService::sendEmailBookingConfirmnew($BookingDetail);
            }


            
            // $transfer_amt_to_fit_acc = 0;
            // $transfer_amt_to_fit_acc = $fit_acc_amt + $fitness_acc_cust_fee_trans_amt;
            
            // Create a second Transfer to another connected account (later):
            // $admin_stripeid = User::where(['id'=>1, 'role'=>'admin'])->first();
            // if(@$admin_stripeid->stripe_connect_id != ''){
            //     \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
            //     $transfer_admin = \Stripe\Transfer::create([
            //         'amount' => $transfer_amt_to_fit_acc * 100,
            //         'currency' => 'usd',
            //         'destination' => $admin_stripeid->stripe_connect_id,
            //     ]);
            // }

            session()->put('cart_item', $cart);
            session()->forget('stripepayid');
            session()->forget('stripechargeid');
            //session()->forget('cart_item');
        }

            
        // Create a second Transfer to another connected account (later):
		/* $transfer = \Stripe\Transfer::create([
		          'amount' => 15,
		          'currency' => 'usd',
		          'destination' => 'acct_1LPvWR2RDRHCydET',
		          'transfer_group' => 'test_order_10',
		        ]);
		*/
        //print_r($data);
        //echo '<br>';
        //echo '<br>'.$data['amount_subtotal'];
        //print_r($customer_array); exit;
        //print_r($customer_array);
        //print_r($line_items->data[0]->toArray());
        //echo $line_items->data[0]->id;
        //print_r($request->session()->get('checkout_session')); exit;
      	return view('jobpost.confirm-payment-instant');
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
                'status' => 'confirmed',
                'currency_code' => 'usd',
                'stripe_id' => '',
                'stripe_status' => '',
                'amount' => $request->grand_total,
                'order_id' => $orderid,
                'order_type' => 'simpleorder',
                'bookedtime' =>$date->format('Y-m-d'),
            );
            $status = UserBookingStatus::create($orderdata);
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
                
                $act = array(
                     'booking_id' => $lastid,
                     'sport' => $crt['code'],
                     'price' => 0,
                     'qty' => $encodeqty  ,
                     'priceid' => $crt['priceid'],
                     'bookedtime' =>date('Y-m-d',strtotime($crt['sesdate'])),
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
                $status = UserBookingDetail::create($act);
                $BookingDetail_1 = $this->bookings->getBookingDetailnew($lastid);
                $businessuser['businessuser'] = CompanyInformation::where('id', $activitylocation->cid)->first();
                $businessuser = json_decode(json_encode($businessuser), true); 
                $BusinessServices['businessservices'] = BusinessServices::where('id',$activitylocation->id)->first();
                $BusinessServices = json_decode(json_encode($BusinessServices), true);
                $BookingDetail_1 = $this->bookings->getBookingDetailnew($lastid);
                foreach($BookingDetail_1['user_booking_detail'] as  $key => $details){
                    if($details['sport'] == $crt['code']){
                        if($BookingDetail_1['user_booking_detail'][$key]['booking_id'] = $lastid){
                            $BookingDetail_1['user_booking_detail'] = $details;
                        }
                        $BookingDetail[] = array_merge($BookingDetail_1,$businessuser,$BusinessServices);
                    }
                }
           }

           session()->forget('stripepayid');
           session()->forget('stripechargeid');
           session()->put('cart_item', $cart);
           //session()->forget('cart_item');
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
                    /*'address' =>[
                            "city": $userdata['city'],
                            "country": $userdata['country'],
                            "line1": $userdata['address'],
                            "line2": $userdata['country'],
                            "postal_code": $userdata['zipcode'],
                            "state": $userdata['state'],
                        ],
                    'shipping' =>[
                        'address' =>[
                            "city": $userdata['city'],
                            "country": $userdata['country'],
                            "line1": $userdata['address'],
                            "line2": $userdata['country'],
                            "postal_code": $userdata['zipcode'],
                            "state": $userdata['state'],
                        ],
                      ]*/
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
            for($i=0;$i<count($request->itemprice);$i++){
                $totalprice += $request->itemprice[$i];
            }
     
            if(isset($request->itemname)) {
                $itemcount = count($request->itemname);
                $pr=''; $total=0;
                for($i=0; $i < $itemcount; $i++) {
                    $pr=$request->itemprice[$i] / $request->itemqty[$i];
                    $total = $total + $pr;
                    if(isset($request->itemname[$i])) {
                        $product = \Stripe\Product::create([
                            // 'id' => $request->itemid[$i],
                            'name' => $request->itemname[$i],
                            'description' => $request->itemname[$i],
                         // 'description' => $request->itemtype[$i],
                        ]);

                        // echo $request->itempriceid[$i];
                        $price = \Stripe\Price::create([
                          'product' => $product->id,
                          'unit_amount' => $request->itemprice[$i] / $request->itemqty[$i],
                          'currency' => 'usd',
                        ]);   
                        //print_r($price);
                        $listItem['price'] = $price->id;
                        $listItem['quantity'] = $request->itemqty[$i];
                        $listItems[] = $listItem;
                        
                        //echo $request->itemid[$i];
                        //print_r($product);
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

                $pmtintent = \Stripe\PaymentIntent::create([
                    'amount' =>  round($totalprice),
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
            }else{

                if($request->save_card == 1){
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
                
               /* print_r($payment_method);*/
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
            }

            $request->session()->put('stripepayid', $pmtintent->id);
            return redirect('/instant-hire/confirm-payment');
        }
    }

    public function form_participate(Request $request){
      /*  print_r($request->all());*/
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
