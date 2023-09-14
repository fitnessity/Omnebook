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
use App\{CompanyInformation,BusinessSubscriptionPlan,UserBookingDetail,BusinessServices,Customer,UserBookingStatus,BusinessPriceDetails,user,Transaction,Recurring,BusinessPriceDetailsAges,SGMailService,BookingCheckinDetails};
use App\Repositories\BookingRepository;
use App\Services\CheckoutRegisterCartService;

class OrderController extends BusinessBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $booking_repo;

    public function __construct(BookingRepository $booking_repo)
    {  
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
    {    //print_r($request->all());
        $cart_item = [];
        if (session()->has('cart_item')) {
            $cart_item = session()->get('cart_item');
        }

        //print_r($cart_item);exit;
        $cardInfo = $userfamilydata= [];
        $book_cnt = $activated =0;
        $book_data =  $address = $username = $age = $purchasefor = $price_title = $status=  $user_data = $tax = $user_type = $last_membership = '';

        $companyId = $request->current_company->id;
        
        $tax = BusinessSubscriptionPlan::where('id',1)->first();
        $userfamilydata = [];
        $username = $address = $current_membership = $user_data = $participateName = $email = '';
        $pageid  = $visits = 0;
    
        $intent = $customer = null;
        if($request->book_id){
            var_dump('no this cases');
            exit();
        }else if($request->cus_id != ''){

            $user_type = 'customer';
            $customer = $customerdata = $request->current_company->customers->find($request->cus_id);
            $customer->create_stripe_customer_id();
            if($customer->parent_cus_id){
                return redirect(route('business.orders.create', ['cus_id' => $customer->parent_cus_id, 'participate_id' => $request->cus_id]));
            }

            $username  =  @$customerdata->fname.' '. @$customerdata->lname;
            if($request->participate_id != ''){
                $cusData = $request->current_company->customers->find($request->participate_id);
                $age = Carbon::parse($cusData->birthdate)->age;
                $participateName  =  @$cusData->fname.' '. @$cusData->lname  .' ('.$age .' yrs) '.$cusData->relationship .' (Paid For by '.$username.')';
                $cusData->create_stripe_customer_id();;
            }

            $book_data = @$customerdata->getlastbooking();
            $age = Carbon::parse( @$customerdata->birthdate)->age; 
            $user_data =  @$customerdata;
            $visits = $customerdata->visits_count();
            $activated = @$customerdata->is_active();
            $userfamilydata = Customer::where('parent_cus_id',@$customerdata->id)->get();
            $address = @$customerdata->full_address();
            $book_id = @$customerdata->id;
            $book_cnt =@$customerdata->memberships();
            $current_membership = @$customerdata->get_current_membership();
            $last_book_data = $this->booking_repo->lastbookingbyUserid(@$user_data->user_id,@$user_data->id);
            $last_book = explode("~~", $last_book_data);
            $purchasefor  = @$last_book[0];
            $price_title  = @$last_book[1];
            $pageid = $request->cus_id;
            $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
            $intent = $stripe->setupIntents->create([
                'payment_method_types' => ['card'],
                'customer' => $customerdata->stripe_customer_id,
            ]);
            $email = @$customerdata->email;
        }

        if($request->cus_id == ''){
            if(!empty($cart_item)){
                foreach($cart_item['cart_item'] as $key=>$item){
                    if($item['chk'] == 'activity_purchase'){
                        unset($cart_item['cart_item'][$key]);
                    }
                }
                session()->put('cart_item',$cart_item);
            }
        }
        if($activated == 0){
            $status = "InActive";
        }else{
            $status = "Active";
        }
          
        $program_list = BusinessServices::where(['is_active'=>1, 'userid'=>Auth::user()->id, 'cid'=>$companyId])->get();

        $modelchk = 0;
        $modeldata = '';
        $ordermodelary = array();
        $ordermodelary = session()->get('ordermodelary');
        if(!empty($ordermodelary)){
            $modelchk = 1;
            $modeldata = $this->getmultipleodermodel($ordermodelary,$email);
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
           'user_type' => $user_type,
           'modelchk' => $modelchk,
           'modeldata' => $modeldata,
           'pageid' => $pageid,
           'visits' => $visits,
           'last_membership' => $last_membership,
           'current_membership' => $current_membership,
           'intent' => $intent, 
           'customer' => $customer,
           'participateName' => $participateName,
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
        //print_r($request->all());exit;
        $bookidarray = [];
        $company = $request->current_company;
        $customer = $company->customers()->findOrFail($request->user_id);
        //echo $customer;exit;
        $user = Auth::User();
        $fitnessity_recurring_fee = $user->recurring_fee / 100;
        $isCash = ($request->cash_amt > 0);
        $isCheck = ($request->check_amt > 0);
        $isCardOnFile = ($request->cc_amt > 0);
        $isNewCard = ($request->cc_new_card_amt > 0);
        $isComp = ($request->cardinfo == 'comp');
        $transactions = [];

        $checkoutRegisterCartService = new CheckoutRegisterCartService();
        //print_r($checkoutRegisterCartService->items());
        if($isComp){
            $transactions[] = [
                'channel' =>'comp',
                'kind' => 'comp',
                'transaction_id' => "COS_" . Carbon::now()->format('YmdHmsv'),
                'amount' => $checkoutRegisterCartService->total($user),
                'qty' =>'1',
                'status' =>'complete',
                'refund_amount' => 0,
            ];
        }else{
            if($isCardOnFile){
                $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
                $onFileTotal = $request->cc_amt;
                $onFilePaymentMethodId = $request->card_id;

                try {
                    $onFilePaymentIntent = $stripe->paymentIntents->create([
                        'amount' =>  round($onFileTotal *100),
                        'currency' => 'usd',
                        'customer' => $customer->stripe_customer_id,
                        'payment_method' => $onFilePaymentMethodId ,
                        'off_session' => true,
                        'confirm' => true,
                        'metadata' => [],
                    ]);

                    if($onFilePaymentIntent['status']=='succeeded'){
                        $transactions[] = [
                            'channel' =>'stripe',
                            'kind' => 'card',
                            'transaction_id' => $onFilePaymentIntent["id"],
                            'stripe_payment_method_id' => $onFilePaymentMethodId ,
                            'amount' => $onFileTotal,
                            'qty' =>'1',
                            'status' =>'complete',
                            'refund_amount' => 0,
                            'payload' =>json_encode($onFilePaymentIntent,true),
                        ];
                    }
                }catch(\Stripe\Exception\CardException $e) {
                    $errormsg = $e->getError()->message;
                    return redirect(route('business.orders.create', ['cus_id' => $customer->id]))->with('stripeErrorMsg', $errormsg);
                }catch (Exception $e) {
                    $errormsg = $e->getError()->message;
                    return redirect(route('business.orders.create', ['cus_id' => $customer->id]))->with('stripeErrorMsg', $errormsg);
                }
            }

            if($isNewCard){
                $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
                $newCardTotal = $request->cc_new_card_amt;
                $newCardPaymentMethodId = $request->new_card_payment_method_id;

                try {
                    $newCardPaymentIntent = $stripe->paymentIntents->create([
                        'amount' =>  round($newCardTotal *100),
                        'currency' => 'usd',
                        'customer' => $customer->stripe_customer_id,
                        'payment_method' => $newCardPaymentMethodId,
                        'off_session' => true,
                        'confirm' => true,
                        'metadata' => [],
                    ]);

                    if(!$request->has('save_card')){
                        $stripePaymentMethod = \App\StripePaymentMethod::where('payment_id', $newCardPaymentMethodId)->firstOrFail();

                        $stripePaymentMethod->delete();
                    }

                    if($newCardPaymentIntent['status']=='succeeded'){
                        $transactions[] = [
                            'channel' =>'stripe',
                            'kind' => 'card',
                            'transaction_id' => $newCardPaymentIntent["id"],
                            'stripe_payment_method_id' => $newCardPaymentMethodId,
                            'amount' => $newCardTotal,
                            'qty' =>'1',
                            'status' =>'complete',
                            'refund_amount' => 0,
                            'payload' =>json_encode($newCardPaymentIntent,true),
                        ];
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
            }

            if($isCash){

                $transactions[] = [
                    'channel' =>'cash',
                    'kind' => 'cash',
                    'transaction_id' => "CS_" . Carbon::now()->format('YmdHmsv'),
                    'amount' => $request->cash_amt,
                    'qty' =>'1',
                    'status' =>'complete',
                    'refund_amount' => 0,
                ];
            }

            if($isCheck){

                $transactions[] = [
                    'channel' =>'check',
                    'kind' => 'check',
                    'transaction_id' => "CK_" . Carbon::now()->format('YmdHmsv'),
                    'amount' => $request->cash_amt,
                    'qty' =>'1',
                    'status' =>'complete',
                    'refund_amount' => 0,
                ];
            }
        }

        $userBookingStatus = UserBookingStatus::create([
            'user_id' => Auth::user()->id,
            //'customer_id' =>  $checkoutRegisterCartService->items()[0]['participate_from_checkout_regi']['id'] ,
            'customer_id' => $request->user_id,
            'user_type' => 'customer',
            'status' => 'active',
            'currency_code' => 'usd',
            'amount' => $request->cash_amt + $request->cc_new_card_amt + $request->check_amt + $request->cc_amt,
            'order_type' => 'checkout_register',
            'bookedtime' => Carbon::now()->format('Y-m-d'),
        ]);

        foreach($transactions as $transaction){
            
            $tran_data = Transaction::create(array_merge($transaction, [ 
                'user_type' => 'Customer',
                'user_id' => $customer->id,
                'item_type' =>'UserBookingStatus',
                'item_id' => $userBookingStatus->id,
            ]));
        }

        foreach($checkoutRegisterCartService->items() as $item){

            $now = new DateTime();
            /*$contractDate = $now->format('Y-m-d');
            $now->modify('+'. $item['actscheduleid']);
            $expired_at = $now;*/
            $date = new DateTime($item['sesdate']);
            $contractDate = $date->format('Y-m-d');
            $date->modify('+'. $item['actscheduleid']);
            $expired_at = $date;
            $cUid = NULL;
            $participateName = NULL;
            if(@$item['participate_from_checkout_regi']['id'] != ''){
                $cUid = $item['participate_from_checkout_regi']['id'];
                $cUid = $item['participate_from_checkout_regi']['id'];
                $participateName =  trim($item['participate_from_checkout_regi']['pc_name'],"(me)");
            }
            $booking_detail = UserBookingDetail::create([                 
                'booking_id' => $userBookingStatus->id,
                'sport' => $item['code'],
                'business_id'=> Auth::user()->cid,
                'price' => json_encode($checkoutRegisterCartService->getQtyPriceByItem($item)['price']),
                'qty' => json_encode($checkoutRegisterCartService->getQtyPriceByItem($item)['qty']),
                'priceid' => $item['priceid'],
                'pay_session' => $item['p_session'],
                'expired_at' => $expired_at,
                'contract_date' => $contractDate,
                'subtotal' => $checkoutRegisterCartService->getSubTotalByItem($item, $user),
                'fitnessity_fee' => $checkoutRegisterCartService->getRecurringFeeByItem($item, $user),
                'tax' => $item['tax'],
                'tip' => $item['tip'],
                'discount' => $item['discount'],
                'expired_duration' => $item['actscheduleid'],
                'participate' => '['.json_encode($item['participate_from_checkout_regi']).']',
                'user_type'=> 'customer',
                'user_id'=> $cUid,
                'transfer_provider_status' =>'unpaid',
                'payment_number' => '{}',
                'order_from' => "Checkout Register"
            ]);
            $booking_detail->transfer_to_provider();
            $bookidarray [] = $booking_detail->id;

            $qty_c = $checkoutRegisterCartService->getQtyPriceByItem($item)['qty'];
            $price_detail = $checkoutRegisterCartService->getPriceDetail($item['priceid']);

            foreach($qty_c as $key=> $qty){
                $re_i = 0;
                $date = new Carbon;
                $stripeId = $stripeChargedAmount = $paymentMethod= '';

                if($key == 'adult'){
                    if($qty != '' && $qty != 0){
                        $amount = $qty * $price_detail->recurring_first_pmt_adult;
                        $re_i = $price_detail->recurring_nuberofautopays_adult; 
                        $reCharge  = $price_detail->recurring_customer_chage_by_adult;
                    }
                }

                if($key == 'child'){
                    if($qty != '' && $qty != 0){
                        $amount = $qty * $price_detail->recurring_first_pmt_child;
                        $re_i = $price_detail->recurring_nuberofautopays_child; 
                        $reCharge  = $price_detail->recurring_customer_chage_by_child;
                    }
                }

                if($key == 'infant'){
                    if($qty != '' && $qty != 0){
                        $amount =  $qty * $price_detail->recurring_first_pmt_infant;
                        $re_i = $price_detail->recurring_nuberofautopays_infant;
                        $reCharge  = $price_detail->recurring_customer_chage_by_infant;
                    }
                }
                $categoryData = $checkoutRegisterCartService->getCategory($item['priceid']);
                $duesTax = @$categoryData->dues_tax;
                $salesTax = @$categoryData->sales_tax;
                if($duesTax == '' || $duesTax == null){
                    $duesTax = 0;
                }

                if($salesTax == '' || $salesTax == null){
                    $salesTax = 0;
                }

                if($qty != '' && $qty != 0){
                    $tax_recurring = number_format((($amount * $duesTax)/100)  + (($amount * $salesTax)/100),2);
                    $paymentMethod = $tran_data['stripe_payment_method_id'];
                    if($re_i != '' && $re_i != 0 && $amount != ''){
                        for ($num = $re_i; $num >0 ; $num--) { 
                            if($num==1){
                                $stripeId =  $tran_data['transaction_id'];
                                $stripeChargedAmount = number_format($tran_data['amount'],2);
                                $paymentDate = $date->format('Y-m-d');
                                $status = 'Completed';
                            }else{
                                $Chk = explode(" ",$reCharge);
                                $timeChk = @$Chk[1];
                                $afterHowmanytime = @$Chk[0];
                                $addTime  = is_numeric($afterHowmanytime) ? $afterHowmanytime * ($num - 1) : 0;

                                if($timeChk == 'Month'){
                                    $paymentDate = (Carbon::now()->addMonths($addTime))->format('Y-m-d');
                                }else if($timeChk == 'Week'){
                                    $paymentDate = (Carbon::now()->addWeeks($addTime))->format('Y-m-d');
                                }else if($timeChk == 'Year'){
                                    $paymentDate = (Carbon::now()->addYears($addTime))->format('Y-m-d');
                                }else{
                                    $paymentDate = (Carbon::now()->addDays($addTime))->format('Y-m-d');
                                }
                                $status = 'Scheduled';
                            } 

                            $recurring = array(
                                "booking_detail_id" => $booking_detail->id,
                                "user_id" => $customer->id,
                                "user_type" => 'customer',
                                "business_id" => $booking_detail->business_id ,
                                "payment_date" => $paymentDate,
                                "amount" => $amount,
                                'charged_amount'=> $stripeChargedAmount,
                                'payment_method'=> $paymentMethod,
                                'stripe_payment_id'=> $stripeId,
                                "tax" => $tax_recurring,
                                "status" => $status,
                            );
                            Recurring::create($recurring);
                        }
                    }
                }
            }

            BookingCheckinDetails::create([
                'business_activity_scheduler_id' => 0,
                'customer_id' => $cUid,
                'booking_detail_id' => $booking_detail->id,
                'checkin_date' => NULL,
                'use_session_amount' => 0,
                'source_type' => 'in_person',
            ]);
            /*$businessService = $checkoutRegisterCartService->getbusinessService($item['code']); 
            $email_detail = array(
                "email" => @$checkoutRegisterCartService->getCompany(Auth::user()->cid)->business_email, 
                "CustomerName" => @$checkoutRegisterCartService->getCompany(Auth::user()->cid)->full_name, 
                "Url" => env('APP_URL').'/personal/orders?business_id='.Auth::user()->cid, 
                "BusinessName"=> @$checkoutRegisterCartService->getCompany(Auth::user()->cid)->dba_business_name,
                "BookedPerson"=> $checkoutRegisterCartService->getbookedPerson($request->user_id),
                "ParticipantsName"=> $participateName,
                "date"=> "N/A",
                "time"=>  "N/A",
                "duration"=>  "N/A",
                "ActivitiyType"=> $businessService->service_type,
                "ProgramName"=> $businessService->program_name,
                "CategoryName"=> @$categoryData->category_title);

            SGMailService::confirmationMail($email_detail);*/
        }

        session()->forget('cart_item');
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

    public function getmultipleodermodel($array,$email)
    {    
        $html = $idarry = '';
        $totaltax =  $subtotaltax = $tot_dis = $tot_tip = $service_fee = 0;

        $html .= '<div class="row"> 
                <div class="col-lg-4 bg-sidebar">
                    <div class="your-booking-page side-part">
                        <div class="booking-page-meta">
                            <a href="#" title="" class="underline"></a>
                        </div>
                        <div class="box-subtitle">
                            <h4>Transaction Complete</h4>
                            <div class="modal-inner-box">
                                <h3>Email Receipt</h3>
                                <div class="form-group">
                                    <input type="text" name="email" id="receipt_email"  placeholder="youremail@abc.com" class="form-control" value="'.$email.'">
                                </div>
                                <button class="btn btn-red mt-10 width-100 mb-25" onclick="sendemail();">Send Email Receipt</button>
                                <div class="reviewerro" id="reviewerro"></div>

                                <h3>Notes</h3>
                                <div class="form-group">
                                    <textarea id="notes" name="notes" rows="4" cols="50" class="form-control">Thank you for doing business with us</textarea>
                                </div>
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
                    <div class="modal-booking-info">';
    
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
                            <div class="text-left">
                                <label>BOOKING#</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>'. $odt['confirm_id'].'</span>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-6">
                            <div class="text-left">
                                <label>PROVIDER COMPANY NAME:</label>
                        </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>'. $odt['company_name'].'</span>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-6">
                            <div class="text-left">
                                <label>PROGRAM NAME:</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>'. $odt['program_name'].'</span>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-6">
                            <div class="text-left">
                                <label>CATEGORY:</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>'. $odt['categoty_name'].'</span>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-6">
                            <div class="text-left">
                                <label>PRICE OPTION:</label>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>'.@$odt['BusinessPriceDetails']['price_title'].'</span>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-6">
                        <div class="text-left">
                                <label>NUMBER OF SESSIONS:</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>'.@$odt['pay_session'].' Session</span>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-6">
                            <div class="text-left">
                                <label>MEMBERSHIP OPTION:</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>'.$odt['BusinessPriceDetails']['membership_type'].'</span>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-6">
                            <div class="text-left">
                                <label>PARTICIPANT QUANTITY:</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>'. $odt['qty'].'</span>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-6">
                            <div class="text-left">
                                <label>WHO IS PRATICIPATING?</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>'. $odt['parti_data'].'</span>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-6">
                            <div class="text-left">
                                <label>ACTIVITY TYPE:</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>'. $odt['sport_activity'].'</span>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-6">
                            <div class="text-left">
                                <label>SERVICE TYPE:</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>'. $odt['select_service_type'].'</span>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-6">
                            <div class="text-left">
                                <label>MEMBERSHIP DURATION:</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>'.$order_detail->expired_duration.'</span>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-6">
                            <div class="text-left">
                                <label>PURCHASE DATE:</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>'.$odt['created_at'].'</span>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-6">
                            <div class="text-left">
                                    <label>MEMBERSHIP ACTIVATION DATE:</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>'.date('d-m-Y',strtotime($order_detail->contract_date)).'</span>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-6">
                            <div class="text-left">
                                <label>MEMBERSHIP EXPIRATION:</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>'.date('d-m-Y',strtotime($order_detail->expired_at)).'</span>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-6">
                            <div class="text-left">
                                <label>PRICE:</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>$'.$odt['totprice_for_this'].'</span>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-6">
                            <div class="text-left">
                                <label>DISCOUNT:</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>$'.$odt['discount'].'</span>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-6">
                            <div class="text-left">
                                <label>TOTAL:</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>$'.$per_total.'</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="main-separator mb-10"></div>
                    </div>';
        }

        $idarry = rtrim($idarry,',');

        // print_r($odt);exit;
        $html .= '     
                    <input type="hidden" name="booking_id" id="booking_id" value="'.$order_detail->booking_id.'"> 
                    <input type="hidden" name="orderdetalidary[]" id="orderdetalidary" value="'.$idarry.'"> 
                    <div class="row border-xx mg-tp">
                        <div class="col-md-6 col-xs-6">
                           <div class="text-left">
                                <label>PAYMENT METHOD</label>
                           </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>'. $odt['pmt_type'].'</span>
                            </div>
                        </div>
                    </div>

                    <div class="row border-xx">
                        <div class="col-md-6 col-xs-6">
                            <div class="text-left">
                                <label>TIP AMOUNT</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>$'.$tot_tip.'</span>
                            </div>
                        </div>
                    </div>

                    <div class="row border-xx">
                        <div class="col-md-6 col-xs-6">
                           <div class="text-left">
                                <label>DISCOUNT</label>
                           </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                           <div class="float-end text-right">
                                <span>$'.$tot_dis.'</span>
                           </div>
                        </div>
                    </div>

                    <div class="row border-xx">
                        <div class="col-md-6 col-xs-6">
                            <div class="text-left">
                                <label>TAXES AND FEES</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>$'. ($totaltax +  $service_fee ).'</span>
                            </div>
                        </div>
                    </div>
                    <div class="row border-xx">
                        <div class="col-md-6 col-xs-6">
                            <div class="text-left">
                                <label>TOTAL AMOUNT PAID</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>$'.$odt['amount'].'</span>
                            </div>
                        </div>
                    </div>
                </div>
               </div>
          </div>';

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
                                                                  <button type="button" class="btn btn-red" data-bs-toggle="modal" data-bs-target="#addpartcipateajax">Participant Quantity </button>
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
                                                                  <input type="text"  name="actfildate"  id="contractajax" placeholder="Search By Date" class="form-control border-0 dash-filter-picker flatpickr-range flatpiker-with-border flatpickr-input active" value="'.date("m/d/Y",strtotime($cart['sesdate'])).'" onchange="changedate('.$dtval.');">
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
                            <button type="submit" class="btn btn-red" >Submit</a>
                        </div>
                    </div>
                    <script type="text/javascript">
                        flatpickr(".flatpickr-input", {
                            dateFormat: "m/d/Y",
                            maxDate: "01/01/2050",
                        });
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
                                                 <div class="qty counter-txt">
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
                                                 <div class="qty counter-txt">
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
                                                 <div class="qty counter-txt">
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
                           <input type="hidden" name="infantprice" id="infantpriceajax" value="'.$infantprice.'"> 
                        </div>
                    </div>';
        }
        return $html.'~~'.$result;
    }
}
