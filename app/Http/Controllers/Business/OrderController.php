<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
use DateTime;
use Config;
use DateInterval;
use DateTimeZone;
use App\{MailService,CompanyInformation,BusinessSubscriptionPlan,UserBookingDetail,BusinessServices,Customer,UserBookingStatus,BusinessPriceDetails,user,Transaction};
use App\Repositories\{BusinessServiceRepository,BookingRepository,CustomerRepository,UserRepository};


class OrderController extends BusinessBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


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

    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request ,$business_id)
    {    
        $cart_item = [];
        if (session()->has('cart_item')) {
            $cart_item = session()->get('cart_item');
        }

        //print_r($cart_item);exit;
        $cardInfo = $userfamilydata= [];
        $book_cnt = $activated =0;
        $book_data =  $address = $username = $age = $purchasefor = $price_title = $status=  $user_data = $tax = $user_type = '';

        $companyId = $request->current_company->id;
        
        $tax = BusinessSubscriptionPlan::where('id',1)->first();
        $userfamilydata = [];
        $username = $address = $current_membership =''; 
        $pageid  = $visits = 0;
        $user_data = '';
        if($request->book_id != ''){
            $book_data = UserBookingDetail::getbyid($request->book_id);
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
                $visits = @$user_data->visits_count();
                $book_cnt = @$user_data->memberships();
                $current_membership = @$user_data->get_current_membership();
            }else if(@$book_data->booking->user_type == 'customer'){
                $username  = $book_data->booking->customer->fname.' '.$book_data->booking->customer->lname;
                $age = Carbon::parse($book_data->booking->customer->birthdate)->age; 
                $user_data = $book_data->booking->customer;
                $activated = $book_data->booking->customer->is_active();
                $userfamilydata = Customer::where('parent_cus_id',$book_data->booking->customer->id)->get();
                $cardInfo = $book_data->booking->customer->get_stripe_card_info();
                $address = $user_data->full_address();
                $pageid =  $book_data->booking->customer->id;
                $visits = @$user_data->visits_count();
                $book_cnt = @$user_data->memberships();
                $current_membership = @$user_data->get_current_membership();
           } 
            $last_membership = '';
            $last_book_data = $this->booking_repo->lastbookingbyUserid(@$user_data->id);
            $last_book = explode("~~", $last_book_data);
            $purchasefor  = @$last_book[0];
            $price_title  = @$last_book[1];  
        }else if($request->cus_id != ''){
           $user_type = 'customer';
           $customerdata = $request->current_company->customers->find($request->cus_id);
           $book_data = @$customerdata->getlastbooking();
           $username  =  @$customerdata->fname.' '. @$customerdata->lname;
           $age = Carbon::parse( @$customerdata->birthdate)->age; 
           $user_data =  @$customerdata;
           $visits = $customerdata->visits_count();
           $activated = @$customerdata->is_active();
           $userfamilydata = Customer::where('parent_cus_id',@$customerdata->id)->get();
           $cardInfo = @$customerdata->get_stripe_card_info();
           $address = @$customerdata->full_address();
           $book_id = @$customerdata->id;
           $book_cnt =@$customerdata->memberships();
           $current_membership = @$customerdata->get_current_membership();
           $last_book_data = $this->booking_repo->lastbookingbyUserid(@$user_data->id);
           $last_book = explode("~~", $last_book_data);
           $purchasefor  = @$last_book[0];
           $price_title  = @$last_book[1];
           $pageid = $request->cus_id;
           $last_membership = '';
        }

        if($activated == 0){
           $status = "InActive";
        }else{
           $status = "Active";
        }
          
        $program_list = BusinessServices::where(['is_active'=>1, 'userid'=>Auth::user()->id, 'cid'=>$companyId])->get();

        $modelchk = 0;
        $modeldata = '';
        $ordermodelary = session()->get('ordermodelary');
        if(!empty($ordermodelary)){
            $modelchk = 1;
            $modeldata = $this->getmultipleodermodel($ordermodelary);
            session()->forget('ordermodelary');
        }
        
        return view('business.orders.create', [
           'companyId' => $companyId,
           'book_id' => $request->book_id,
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
           'visits' => $visits,
           'last_membership' => $last_membership,
           'current_membership' => $current_membership,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bookidarray = [];
        $fitnessity_fee= 0;
        $bspdata = BusinessSubscriptionPlan::where('id',1)->first();
        //$fitnessity_fee = $bspdata->fitnessity_fee;
        $service_fee = $bspdata->service_fee;
        $tax = $bspdata->site_tax;
        if($request->user_type == 'user'){
            $user_id = $request->user_id;
            $customerid = '';
        }else{
            $customerid = $request->user_id;
            $user_id = Null;
        }

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
                        $payment_method = $customer_source->id;
                    }catch(\Stripe\Exception\CardException $e) {
                        $errormsg = $e->getError()->message;
                        $url = '/business/'.Auth::user()->cid.'/orders/create?cus_id='.$request->user_id;
                        return redirect($url)->with('stripeErrorMsg', $errormsg);
                    }catch (Exception $e) {
                        $errormsg = "There Is An Error While Proccessing Your Payment...Please Check Your Details Again.. ";
                        $url = '/business/'.Auth::user()->cid.'/orders/create?cus_id='.$request->user_id;
                        return redirect($url)->with('stripeErrorMsg', $errormsg);
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
                        $url = '/business/'.Auth::user()->cid.'/orders/create?cus_id='.$request->user_id;
                        return redirect($url)->with('stripeErrorMsg', $errormsg);
                    }catch (Exception $e) {
                        $errormsg = "There Is An Error While Proccessing Your Payment...Please Check Your Details Again.. ";
                        $url = '/business/'.Auth::user()->cid.'/orders/create?cus_id='.$request->user_id;
                        return redirect($url)->with('stripeErrorMsg', $errormsg);
                    }
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
            try {
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

                if($data['status']=='succeeded')
                {
                    $orderdata = array(
                         'user_id' =>  $user_id ,
                         'customer_id' =>  $customerid ,
                         'user_type' => $request->user_type,
                         'status' => 'active',
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

                    $transactiondata = array( 
                        'user_type' => $request->user_type,
                        'user_id' => $request->user_id,
                        'item_type' =>'UserBookingStatus',
                        'item_id' =>'checkout_register '.$status->id,
                        'channel' =>'stripe',
                        'kind' => 'card',
                        'transaction_id' => $data["id"],
                        'amount' => $amount1,
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
                              $cartnew[$cnt]['p_session']= $c['p_session'];
                              $cnt++;
                              unset($cart['cart_item'][$key]);
                         }
                    }   
                
                    $metadatapro = json_decode($data['metadata']['pro_id']);
                    $metadatalistItems = json_decode($data['metadata']['listItems']);
                
                    for($i=0;$i<count($metadatapro);$i++){
                         $priceid=0; $sesdate= $encodeqty ='' ;
                         $aduqnt = $childqnt = $infantqnt =0; 
                         $aduprice = $childprice = $infantprice = $fitnessity_fee = 0;
                         if ($metadatapro[$i] == $cartnew[$i]['code'])
                         {   
                              $taxval =$cartnew[$i]['tax'];
                              $priceid = $cartnew[$i]['priceid'];
                              $sesdate = $cartnew[$i]['sesdate'];
                              $pidval = $cartnew[$i]['code'];
                              $tip = $cartnew[$i]['tip'];
                              $p_session = $cartnew[$i]['p_session'];
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
                         $fitnessity_fee = $activitylocation->user->fitnessity_fee;
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
                              'pay_session' => $p_session,
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
            }catch(\Stripe\Exception\CardException $e) {
                $errormsg = $e->getError()->message;
                $url = '/business/'.Auth::user()->cid.'/orders/create?cus_id='.$request->user_id;
                return redirect($url)->with('stripeErrorMsg', $errormsg);
            }catch (Exception $e) {
                $errormsg = $e->getError()->message;
                $url = '/business/'.Auth::user()->cid.'/orders/create?cus_id='.$request->user_id;
                return redirect($url)->with('stripeErrorMsg', $errormsg);
            }
        }else{
            $retrun_cash = 0;
            $cash_amt_tender = 0;
            $pmt_by_check = 0;
            $pmt_by_comp = 0;
            $checknumber = '';
            $grandtotal = $request->grand_total;
            if($request->cardinfo == 'check'){
                $pay_type = 'check';
                $pmt_by_check = $request->check_amt;
                $checknumber  = $request->check_number;
            }else if($request->cardinfo  == 'cash'){
                $pay_type = 'cash';
                if($request->cash_amt_tender > $request->cash_amt ){
                     $retrun_cash = $request->cash_change;
                }
                $cash_amt_tender = $request->cash_amt_tender;
            }else{
                $pay_type = 'comp';
                $pmt_by_comp = $grandtotal;
                $grandtotal = 0;
            }
            $date = new DateTime("now", new DateTimeZone('America/New_York') );
            $oid = $date->format('YmdHis');
            $digits = 3;
            $rand = rand(pow(10, $digits-1), pow(10, $digits)-1);   //24 06 2022 50 9 59
            $orderid= 'FS_'.$oid.$rand;

            $orderdata = array(
                'user_id' =>  $user_id ,
                'customer_id' =>  $customerid ,
                'user_type' => $request->user_type,
                'status' => 'active',
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

            $transactiondata = array( 
                'user_type' => $request->user_type,
                'user_id' => $request->user_id,
                'item_type' =>'UserBookingStatus',
                'item_id' =>'checkout_register '.$status->id,
                'channel' =>'',
                'kind' => $pay_type,
                'transaction_id' => '',
                'amount' => $grandtotal,
                'qty' =>'1',
                'status' =>'processing',
                'refund_amount' =>0,
                'payload' => '',
            );
            $transactionstatus = Transaction::create($transactiondata);

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
                     $cartnew[$cnt]['p_session']= $c['p_session'];
                     $cnt++;
                     unset($cart['cart_item'][$key]);
                }
            } 

            foreach($cartnew as $crt){
                $aduprice = $childprice = $infantprice = 0;
                $aduqnt = $childqnt = $infantqnt = $fitnessity_fee = 0;
                $taxval = $crt['tax'];
                $activitylocation = BusinessServices::where('id',$crt['code'])->first();
                $fitnessity_fee = $activitylocation->user->fitnessity_fee;
                $price_detail = BusinessPriceDetails::find($crt['priceid']);
                $p_session = $crt['p_session'];
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
                    'pay_session' => $p_session,
                    'expired_at' => $expired_at,
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
        
        return redirect()->route('business.orders.create', ['business_id'=>Auth::user()->cid,'cus_id' => $request->user_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
            $html .= '
                    <div class="row">
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
                                <span>'.@$odt['pay_session'].' Session</span>
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
                        </div>

                        <div class="col-md-6 col-xs-6">
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

        // print_r($odt);exit;
        $html .= '     
                    <input type="hidden" name="booking_id" id="booking_id" value="'.$order_detail->booking_id.'"> 
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
                    </div>
                    <div class="row border-xx">
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

}
