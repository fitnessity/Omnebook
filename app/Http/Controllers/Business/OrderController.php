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
use App\{MailService,CompanyInformation,BusinessSubscriptionPlan,UserBookingDetail,BusinessServices,Customer,UserBookingStatus,BusinessPriceDetails,user,Transaction,Recurring};
use App\Repositories\{BusinessServiceRepository,BookingRepository,CustomerRepository,UserRepository};
use App\Services\CheckoutRegisterCartService;

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
        $book_data =  $address = $username = $age = $purchasefor = $price_title = $status=  $user_data = $tax = $user_type = $last_membership = '';

        $companyId = $request->current_company->id;
        
        $tax = BusinessSubscriptionPlan::where('id',1)->first();
        $userfamilydata = [];
        $username = $address = $current_membership =''; 
        $pageid  = $visits = 0;
        $user_data = '';
        $intent = null;
        $customer = null;
        if($request->book_id){
            var_dump('no this cases');
            exit();
           //  $book_data = UserBookingDetail::getbyid($request->book_id);
           //  $user_type = @$book_data->booking->user_type ;
           //  if(@$book_data->booking->user_type == 'user'){
           //      $username = $book_data->booking->user->firstname.' '.$book_data->booking->user->lastname;
           //      $age = Carbon::parse($book_data->booking->user->birthdate)->age; 
           //      $user_data = $book_data->booking->user;
           //      $activated = $book_data->booking->user->activated;
           //      $userfamilydata = $book_data->booking->user->user_family_details;
           //      $cardInfo = $book_data->booking->user->get_stripe_card_info();
           //      $address = $user_data->getaddress();
           //      $pageid =  $book_data->booking->user->id;
           //      $visits = @$user_data->visits_count();
           //      $book_cnt = @$user_data->memberships();
           //      $current_membership = @$user_data->get_current_membership();
           //  }else if(@$book_data->booking->user_type == 'customer'){
           //      $username  = $book_data->booking->customer->fname.' '.$book_data->booking->customer->lname;
           //      $age = Carbon::parse($book_data->booking->customer->birthdate)->age; 
           //      $user_data = $book_data->booking->customer;
           //      $activated = $book_data->booking->customer->is_active();
           //      $userfamilydata = Customer::where('parent_cus_id',$book_data->booking->customer->id)->get();
           //      $cardInfo = $book_data->booking->customer->get_stripe_card_info();
           //      $address = $user_data->full_address();
           //      $pageid =  $book_data->booking->customer->id;
           //      $visits = @$user_data->visits_count();
           //      $book_cnt = @$user_data->memberships();
           //      $current_membership = @$user_data->get_current_membership();
           // } 
           //  $last_membership = '';
           //  $last_book_data = $this->booking_repo->lastbookingbyUserid(@$user_data->id);
           //  $last_book = explode("~~", $last_book_data);
           //  $purchasefor  = @$last_book[0];
           //  $price_title  = @$last_book[1];  
        }else if($request->cus_id != ''){

           $user_type = 'customer';
           $customer = $customerdata = $request->current_company->customers->find($request->cus_id);
           $book_data = @$customerdata->getlastbooking();
           $username  =  @$customerdata->fname.' '. @$customerdata->lname;
           $age = Carbon::parse( @$customerdata->birthdate)->age; 
           $user_data =  @$customerdata;
           $visits = $customerdata->visits_count();
           $activated = @$customerdata->is_active();
           $userfamilydata = Customer::where('parent_cus_id',@$customerdata->id)->get();
           $address = @$customerdata->full_address();
           $book_id = @$customerdata->id;
           $book_cnt =@$customerdata->memberships();
           $current_membership = @$customerdata->get_current_membership();
           $last_book_data = $this->booking_repo->lastbookingbyUserid(@$user_data->id);
           $last_book = explode("~~", $last_book_data);
           $purchasefor  = @$last_book[0];
           $price_title  = @$last_book[1];
           $pageid = $request->cus_id;
           $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
           $intent = $stripe->setupIntents->create([
             'payment_method_types' => ['card'],
             'customer' => $customerdata->stripe_customer_id,
           ]);
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
           'user_type' => $user_type,
           'modelchk' => $modelchk,
           'modeldata' => $modeldata,
           'pageid' => $pageid,
           'visits' => $visits,
           'last_membership' => $last_membership,
           'current_membership' => $current_membership,
           'intent' => $intent, 
           'customer' => $customer,
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
        $company = $request->current_company;
        $customer = $company->customers()->findOrFail($request->user_id);

        $user = Auth::User();
        $fitnessity_recurring_fee = $user->recurring_fee / 100;
        $isCash = ($request->cash_amt > 0);
        $isCheck = ($request->check_amt > 0);
        $isCardOnFile = ($request->cc_amt > 0);
        $isNewCard = ($request->cc_new_card_amt > 0);
        $isComp = ($request->cardinfo == 'comp');
        $transactions = [];

        $checkoutRegisterCartService = new CheckoutRegisterCartService();

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
            'customer_id' =>  $customer->id ,
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
            $contact_date = $now->format('Y-m-d');
            $now->modify('+'. $item['actscheduleid']);
            $expired_at = $now;
            
            $booking_detail = UserBookingDetail::create([                 
                'booking_id' => $userBookingStatus->id,
                'sport' => $item['code'],
                'business_id'=> Auth::user()->cid,
                'price' => json_encode($checkoutRegisterCartService->getQtyPriceByItem($item)['price']),
                'qty' => json_encode($checkoutRegisterCartService->getQtyPriceByItem($item)['qty']),
                'priceid' => $item['priceid'],
                'pay_session' => $item['p_session'],
                'expired_at' => $expired_at,
                'contract_date' => Carbon::now()->format('Y-m-d'),
                'subtotal' => $checkoutRegisterCartService->getSubTotalByItem($item, $user),
                'fitnessity_fee' => $checkoutRegisterCartService->getRecurringFeeByItem($item, $user),
                'tax' => $item['tax'],
                'tip' => $item['tip'],
                'discount' => $item['discount'],
                'expired_duration' => $item['actscheduleid'],
                'participate' => '['.json_encode($item['participate_from_checkout_regi']).']',
                'transfer_provider_status' =>'unpaid',
                'payment_number' => '{}',
            ]);
            $bookidarray [] = $booking_detail->id;

            $qty_c = $checkoutRegisterCartService->getQtyPriceByItem($item)['qty'];
            $price_detail = $checkoutRegisterCartService->getPriceDetail($item['priceid']);

            $tax_person = 0;
            if($qty_c['adult'] != 0){
                $tax_person++;
            }if($qty_c['child']!= 0){
                $tax_person++;
            }if($qty_c['infant'] != 0){
                $tax_person++;
            }

            $per_person_tax = $item['tax'] / $tax_person; 
            foreach($qty_c as $key=> $qty){
                $re_i = 0;
                $date = new Carbon;
                $stripe_id = $stripe_charged_amount = $payment_method= '';

                if($key == 'adult'){
                    if($qty != '' && $qty != 0){
                        $amount = $qty * $price_detail->recurring_first_pmt_adult;
                        $re_i = $price_detail->recurring_nuberofautopays_adult; 
                    }
                }

                if($key == 'child'){
                    if($qty != '' && $qty != 0){
                        $amount = $qty * $price_detail->recurring_first_pmt_child;
                        $re_i = $price_detail->recurring_nuberofautopays_child; 
                    }
                }

                if($key == 'infant'){
                    if($qty != '' && $qty != 0){
                        $amount =  $qty * $price_detail->recurring_first_pmt_infant;
                        $re_i = $price_detail->recurring_nuberofautopays_infant;
                    }
                }

                if($qty != '' && $qty != 0){
                    if($re_i != '' && $re_i != 0 && $amount != ''){
                        for ($num = $re_i; $num >0 ; $num--) { 
                            if($num==1){
                                $stripe_id =  $tran_data['transaction_id'];
                                $stripe_charged_amount = $tran_data['amount'];
                                $payment_method = $tran_data['kind'];
                                $payment_date = $date->format('Y-m-d');
                                $status = 'Completed';
                            }else{
                                $month = $num - 1;
                                $payment_date = (Carbon::now()->addMonth($month))->format('Y-m-d');
                                $status = 'Scheduled';
                            } 

                            $recurring = array(
                                "booking_detail_id" => $booking_detail->id,
                                "user_id" => $customer->id,
                                "user_type" => 'customer',
                                "business_id" => $booking_detail->business_id ,
                                "payment_date" => $payment_date,
                                "amount" => $amount,
                                'charged_amount'=> $stripe_charged_amount,
                                'payment_method'=> $payment_method,
                                'stripe_payment_id'=> $stripe_id,
                                "tax" => $per_person_tax,
                                "status" => $status,
                            );
                            Recurring::create($recurring);
                        }
                    }
                }
            }
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
