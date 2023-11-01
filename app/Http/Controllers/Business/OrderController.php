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
use App\{CompanyInformation,BusinessSubscriptionPlan,UserBookingDetail,BusinessServices,Customer,UserBookingStatus,ProductsCategory,BusinessPriceDetails,user,Transaction,Recurring,BusinessPriceDetailsAges,SGMailService,BookingCheckinDetails,Products,ProductSize,ProductColors};
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
        if (session()->has('cart_item_for_checkout')) {
            $cart_item = session()->get('cart_item_for_checkout');
            // /session()->forget('cart_item_for_checkout');
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
            @$customer->create_stripe_customer_id();
            if($customer->parent_cus_id){
                return redirect(route('business.orders.create', ['cus_id' => $customer->parent_cus_id, 'participate_id' => $request->cus_id]));
            }

            $username  =  @$customerdata->fname.' '. @$customerdata->lname;
            if($request->participate_id != ''){
                $cusData = $request->current_company->customers->find($request->participate_id);
                $age = Carbon::parse($cusData->birthdate)->age;
                $participateName  =  @$cusData->fname.' '. @$cusData->lname  .' ('.$age .' yrs) '.$cusData->relationship .' (Paid For by '.$username.')';
                @$cusData->create_stripe_customer_id();;
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
                session()->put('cart_item_for_checkout',[]);
            }
        }
        if($activated == 0){
            $status = "InActive";
        }else{
            $status = "Active";
        }
          
        $program_list = BusinessServices::where(['is_active'=>1, 'userid'=>Auth::user()->id, 'cid'=>$companyId])->get();
        $products = Products::where(['user_id'=>Auth::user()->id, 'business_id'=>$companyId])->get();

        $productCategory = ProductsCategory::orderBy('name')->get();

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
           'products' => $products,
           'productCategory' => $productCategory,
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
                }catch(\Stripe\Exception\CardException | \Stripe\Exception\InvalidRequestException $e) {
                    //$errormsg = $e->getError()->message;
                    $errormsg = "Your card is not connected with your account. Please add your card again.";
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
                }catch(\Stripe\Exception\CardException | \Stripe\Exception\InvalidRequestException $e) {
                    //$errormsg = $e->getError()->message;
                    $errormsg = "Your card is not connected with your account. Please add your card again.";
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
                'user_type' => 'customer',
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

            $price_detail = $checkoutRegisterCartService->getPriceDetail($item['priceid']);

            $booking_detail = UserBookingDetail::create([                 
                'booking_id' => $userBookingStatus->id,
                'sport' => $item['code'],
                'business_id'=> Auth::user()->cid,
                'price' => json_encode($checkoutRegisterCartService->getQtyPriceByItem($item)['price']),
                'qty' => json_encode($checkoutRegisterCartService->getQtyPriceByItem($item)['qty']),
                'priceid' => $item['priceid'],
                'pay_session' => $item['p_session'] ?? $price_detail->pay_session,
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
                'order_from' => "Checkout Register",
                'addOnservice_ids' =>@$item['addOnServicesId'],
                'addOnservice_qty' => @$item['addOnServicesQty'],
                'addOnservice_total' => @$item['addOnServicesTotalPrice'] ?? 0 ,
                'productIds' => @$item['productIds'],
                'productQtys' => @$item['productQtys'],
                'productSize' => @$item['productSize'],
                'productColor' => @$item['productColor'],
                'productTypes' => @$item['productTypes'],
                'productTotalPrices' => @$item['productTotalPrices'],
            ]);
            $booking_detail->transfer_to_provider();
            $bookidarray [] = $booking_detail->id;

            $qty_c = $checkoutRegisterCartService->getQtyPriceByItem($item)['qty'];
           

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

        session()->forget('cart_item_for_checkout');
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
            $total = ($odt['totprice_for_this'] - $odt['discount']) + $odt['productPrice'] + $odt['addOnPrice'];
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
                                <label>ADD ON SERVICE:</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>'.getAddonService(@$odt['addOnServicesId'],@$odt['addOnServicesQty']).'</span>
                            </div>
                        </div>

                        <div class="col-md-6 col-xs-6">
                            <div class="text-left">
                                <label>PRODUCTS:</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-xs-6">
                            <div class="float-end text-right">
                                <span>'.getProducts(@$odt['productIds'],@$odt['productQtys'],@$odt['productTypes']).'</span>
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
        $cart_item = $cart = [];
        if (session()->has('cart_item_for_checkout')) {
            $cart_item = session()->get('cart_item_for_checkout');
        }
        $html = $result = '';
        $salestaxajax = $duestaxajax = 0;

        if(in_array($request->customerId.'~~'.$request->priceid, array_keys($cart_item["cart_item"]))) {
            $cart = $cart_item["cart_item"][$request->customerId.'~~'.$request->priceid];
            $cartselectedpriceid = BusinessPriceDetails::where('id',$cart['priceid'])->first();
            $cartselectedcategory = BusinessPriceDetailsAges::where('id',$cart['categoryid'])->first();
            $program_list = BusinessServices::where(['is_active'=>1,'userid'=>Auth::user()->id])->get();
            $catelist = BusinessPriceDetailsAges::select('id','category_title')->where('serviceid',$cart['code'])->get(); 
            $pricelist = BusinessPriceDetails::select('id','price_title')->where('category_id',@$cart['categoryid'])->get();
            $membershiplist = BusinessPriceDetails::select('id','membership_type')->where('id',$cart['priceid'])->get();

            $aduqty = $infantqty = $childqty = 0;
            $priceType = (date('l') == 'Saturday' || date('l') == 'Sunday') ? 'weekend_price_diff' : 'cus_weekly_price';

            $aduprice = $cartselectedpriceid['adult_'.$priceType] ?? 0;
            $childprice = $cartselectedpriceid['child_'.$priceType] ?? 0;
            $infantprice = $cartselectedpriceid['infant_'.$priceType] ?? 0;

            $salestaxajax = $cartselectedcategory->sales_tax ?? '';
            $duestaxajax = $cartselectedcategory->dues_tax ?? '';

            $aduqty = !empty($cart['adult']) ? ($cart['adult']['quantity'] != 0 ? $cart['adult']['quantity'] : 0) : 0;
            $childqty = !empty($cart['child']) ? ($cart['child']['quantity'] != 0 ? $cart['child']['quantity'] : 0) : 0;
            $infantqty = !empty($cart['infant']) ? ($cart['infant']['quantity'] != 0 ? $cart['infant']['quantity'] : 0) : 0;

            $actscheduleid = explode(' ' ,$cart["actscheduleid"]);

            $participate = $cart["participate_from_checkout_regi"]['pc_name'];
            $pageid = $request->pageid;
            $p_session = $cart["p_session"];
            $indexOfAry = $request->customerId.'~~'.$request->priceid;

            $idsArray = explode(',', $cart['addOnServicesId']);
            $qtysArray = explode(',', $cart['addOnServicesQty']);
            $addOnServices = $cartselectedcategory  != '' ?  $cartselectedcategory->AddOnService: [];
            $addOnData = view('business.orders.add_on_service')->with(['addOnServices' =>$addOnServices ,'idsArray'=>$idsArray ,'qtysArray'=>$qtysArray ,'ajax'=>'ajax' ]);
            $business_id = $cartselectedpriceid->cid;
            $view1 = view('business.orders.edit_cart', compact('cart','aduprice','childprice','infantprice','salestaxajax','duestaxajax','aduqty','childqty','infantqty','actscheduleid','participate','membershiplist','cartselectedpriceid','cartselectedcategory','program_list','catelist','pricelist','pageid','indexOfAry',
                'addOnData','business_id'));

            $view2 = view('business.orders.participate_modal', compact('aduprice','childprice','infantprice','aduqty','childqty','infantqty','p_session'));

            return $view1.'~~~'.$view2;
        }
    }

    public function addToCartForCheckout(Request $request){
        //print_r($request->all());exit;
        $customerId = $request->pc_regi_id;
        $cart_item = $request->session()->has('cart_item_for_checkout') ? $request->session()->get('cart_item_for_checkout') : [];
        $tax = $request->has('value_tax') != '' ? $request->value_tax : 0;
        $tip_amt_val = $request->has('tip_amt_val') != '' ? $request->tip_amt_val : 0;
        $dis_amt_val = $request->has('dis_amt_val') != '' ? $request->dis_amt_val : 0;
        $parti_from_chkout_regi = $request->has('pc_value') != '' ? array('id'=>$customerId, 'from'=>$request->pc_user_tp, 'pc_name'=>$request->pc_value) : array();
        $categoryid = $request->has('categoryid') != '' ? $request->categoryid : '';
        $p_session = $request->has('pay_session') != '' ? $request->pay_session : '';

        $addOnServicesId = $request->has('addOnServicesId') != '' ? $request->addOnServicesId: '';
        $addOnServicesQty = $request->has('addOnServicesQty') != '' ? $request->addOnServicesQty: '';
        $addOnServicesTotalPrice = $request->has('addOnServicesTotalPrice') != '' ? $request->addOnServicesTotalPrice: 0 ;
        $aos_details = $request->has('aos_details') != '' ? $request->aos_details: '';

        $product_details = $request->has('product_details') != '' ? $request->product_details: '';
        $productIds = $request->has('productIds') != '' ? $request->productIds: '';
        $productQtys = $request->has('productQtys') != '' ? $request->productQtys: '';
        $productSize = $request->has('productSize') != '' ? $request->productSize: '';
        $productColor = $request->has('productColor') != '' ? $request->productColor: '';
        $productTypes = $request->has('productTypes') != '' ? $request->productTypes: '';
        $productTotalPrices = $request->has('productTotalPrices') != '' ? $request->productTotalPrices: 0 ;
    
        $pid = $request->pid ?? 0;
        $priceid = $request->priceid ?? 0;
        $price =  $request->price ?? 0;
        $pricetotal =$request->pricetotal ?? 0;
        $actscheduleid = $request->actscheduleid ?? 0;
        $sesdate = isset($request->sesdate) ? date('Y-m-d',strtotime($request->sesdate)) : 0;

        $service = BusinessServices::find($pid);
        $infantarray = $childarray = $adultarray= [];
        $tot_qty = 0;
        if($request->aduquantity != 0){
            $adultarray = array('quantity'=>$request->aduquantity, 'price'=>$request->cartaduprice);
            $tot_qty += $request->aduquantity;
        }
        if($request->childquantity != 0){
            $childarray = array('quantity'=>$request->childquantity, 'price'=>$request->cartchildprice);
            $tot_qty += $request->childquantity;
        }
        if($request->infantquantity != 0){
            $infantarray = array('quantity'=>$request->infantquantity, 'price'=>$request->cartinfantprice);
            $tot_qty += $request->infantquantity;
        }
        
        if($request->deletepid != $customerId.'~~'.$priceid){
            unset($cart_item["cart_item"][$request->deletepid]);
        }

        if ($service != '') {
            $itemArray = array($customerId.'~~'.$request->priceid=>array('type'=>$service->service_type, 'name'=>$service->program_name, 'code'=>$service->id,'adult'=>$adultarray,'child'=>$childarray,'infant'=>$infantarray,'actscheduleid'=>$actscheduleid, 'sesdate'=>$sesdate,'totalprice'=>$request->pricetotal,'priceid'=>$priceid,'tax'=>$tax,'discount'=>$dis_amt_val ,'tip'=>$tip_amt_val ,'participate_from_checkout_regi'=> $parti_from_chkout_regi,'categoryid'=>$categoryid ,'p_session'=>$p_session,'addOnServicesId'=> $addOnServicesId, 'addOnServicesQty' => $addOnServicesQty, 'addOnServicesTotalPrice' => $addOnServicesTotalPrice, 'aos_details' => $aos_details, 'product_details' => $product_details,'productIds' => $productIds, 'productQtys' => $productQtys, 'productSize' => $productSize, 'productColor' => $productColor, 'productTypes' =>$productTypes ,'productTotalPrices' =>$productTotalPrices, 'customerId' => $customerId ));

            if(!empty($cart_item["cart_item"])) {
                if(in_array($customerId.'~~'.$request->priceid, array_keys($cart_item["cart_item"]))) {
                    foreach($cart_item["cart_item"] as $k => $v) {
                        if($customerId.'~~'.$request->priceid == $k) {
                            $cart_item["cart_item"][$k]["actscheduleid"] = $actscheduleid;
                            $cart_item["cart_item"][$k]["tip"] = $tip_amt_val;
                            $cart_item["cart_item"][$k]["discount"] = $dis_amt_val;
                            $cart_item["cart_item"][$k]["tax"] = $tax;
                            $cart_item["cart_item"][$k]["categoryid"] = $categoryid;
                            $cart_item["cart_item"][$k]["p_session"] = $p_session;

                            $cart_item["cart_item"][$k]["participate_from_checkout_regi"] = $parti_from_chkout_regi ;
                            $cart_item["cart_item"][$k]["sesdate"] = $sesdate;
                            $cart_item["cart_item"][$k]["totalprice"] = $request->pricetotal;
                            $cart_item["cart_item"][$k]["priceid"] = $request->priceid;
                            $cart_item["cart_item"][$k]['adult']["price"] = $request->cartaduprice;
                            $cart_item["cart_item"][$k]['child']["price"] = $request->cartchildprice;
                            $cart_item["cart_item"][$k]['infant']["price"] = $request->cartinfantprice;

                            $cart_item["cart_item"][$k]['adult']["quantity"] = $request->aduquantity;

                            $cart_item["cart_item"][$k]['child']["quantity"] = $request->childquantity;

                            $cart_item["cart_item"][$k]['infant']["quantity"] = $request->infantquantity;

                            $cart_item["cart_item"][$k]["addOnServicesId"] = $addOnServicesId;
                            $cart_item["cart_item"][$k]["addOnServicesQty"] = $addOnServicesQty;
                            $cart_item["cart_item"][$k]["addOnServicesTotalPrice"] = $addOnServicesTotalPrice;
                            $cart_item["cart_item"][$k]["aos_details"] = $aos_details;

                            $cart_item["cart_item"][$k]["product_details"] = $product_details;
                            $cart_item["cart_item"][$k]["productIds"] = $productIds;
                            $cart_item["cart_item"][$k]["productQtys"] = $productQtys;
                            $cart_item["cart_item"][$k]["productSize"] = $productSize;
                            $cart_item["cart_item"][$k]["productColor"] = $productColor;
                            $cart_item["cart_item"][$k]["productTypes"] = $productTypes;
                            $cart_item["cart_item"][$k]["productTotalPrices"] = $productTotalPrices;

                            $cart_item["cart_item"][$k]["customerId"] = $customerId;
                        }
                    }
                }else{
                    $cart_item["cart_item"] = $cart_item["cart_item"] + $itemArray;;
                }
            }else {
                $cart_item["cart_item"] = $itemArray;
            }
        }
        if (isset($cart_item)) {
            $request->session()->put('cart_item_for_checkout', $cart_item);
        } else {
            $request->session()->forget('cart_item_for_checkout');
        }
        //print_r($cart_item['cart_item']);exit;
        
        return redirect()->route('business.orders.create', ['business_id'=>Auth::user()->cid,'cus_id' => $request->pageid]); 
    }

    public function removeFromCartForCheckout(Request $request){
        $cart_item = $request->session()->has('cart_item_for_checkout') ? $request->session()->get('cart_item_for_checkout') : [];
        
        if(!empty($cart_item["cart_item"])) {
            foreach($cart_item["cart_item"] as $k => $v) {
                if($request->customerID.'~~'.$_GET["priceid"] == $v['customerId'].'~~'.$v['priceid']) {
                    unset($cart_item["cart_item"][$k]);
                }
            }
        }
        if (isset($cart_item)) {
            $request->session()->put('cart_item_for_checkout', $cart_item);
        } else {
            $request->session()->forget('cart_item_for_checkout');
        }
        
        return redirect()->route('business.orders.create', ['business_id'=>Auth::user()->cid,'cus_id' => $request->pageid]);
    }

    public function productDetails(Request $request){
        $product = Products::where(['business_id' =>$request->cid ,'id'=>$request->pid])
            ->when($request->categoryId ,function($q) use($request){
                $q->where('category', '!=', '')->whereRaw("FIND_IN_SET(?, category)", [$request->categoryId]);
            })->first();

        $qty = $request->qty ?? 0;
        $psize = $request->psize ?? '';
        $pcolor = $request->pcolor ?? '';
        $chk = $request->chk ?? '';
        $sptype = $request->sptype ?? ($product->product_type == 'both' ? 'sale': $product->product_type ) ;
        if($product){
            $lowAlertQty = $product->low_quantity_alert;
            $reminingQty = $product->getSoldProducts();
            
            return view('business.orders.product_data', ['product' =>$product ,'productSize' => ProductSize::orderBy('name')->get(),'productColor' =>ProductColors::orderBy('name')->get(),'chk'=>$chk ,'qty' => $qty,'psize' => $psize,'pcolor' => $pcolor,'sptype' => $sptype ,'lowAlertQty' =>$lowAlertQty ,'reminingQty' =>$reminingQty ]);
        }
    }

    public function openProductModal(Request $request){
        $productCategory = ProductsCategory::orderBy('name')->get();
        $productData = '';
        $productQtys = explode(',',$request->productQtys);
        $productSize = explode(',',$request->productSize);
        $productColor = explode(',',$request->productColor);
        $productTypes = explode(',',$request->productTypes);
 
        if($request->ids){
            foreach(explode(',',$request->ids) as $i=>$id){
                $qty = $productQtys[$i] ?? '';
                $psize = $productSize[$i] ?? '';
                $pcolor = $productColor[$i] ?? '';
                $ptype = $productTypes[$i] ?? '';
                
                $productData .= $this->productDetails(new Request([
                    'cid' => $request->cid,  
                    'pid' => $id,
                    'chk' => $request->chk,
                    'qty' => $qty,
                    'psize' => $psize,
                    'pcolor' => $pcolor,
                    'sptype' => $ptype,
                ]));
            }
        }
        return view('business.orders.product_modal', ['productCategory' =>$productCategory,'chk'=>$request->chk,'productData'=>$productData ,'business_id' =>$request->cid]);
    }

    function getCategoryProduct(Request $request){
        $html = '';
        $chk = "'".$request->chk."'";
        $productList = Products::where('category', '!=', '')->whereRaw("FIND_IN_SET(?, category)", [$request->id])->get();
        $html .= '<div class="select0service category-search mb-15">
            <label>Select Item</label>
            <select id="categoryProList" class="form-select categoryProList" onchange="getList(this.value,'.$request->business_id.','.$chk.');">
                <option value="">Select Item</option>';
                foreach($productList as $p){
                    $html .= '<option value="'.$p->id.'">'.$p->name.'</option>';
                }
        $html .= '</select>
        </div>';

        return $html;
    }
   
}
