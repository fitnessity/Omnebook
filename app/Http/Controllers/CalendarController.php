<?php
<<<<<<< HEAD
namespace App\Http\Controllers;
=======

namespace App\Http\Controllers;

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
use Illuminate\Http\Request;
use App\{Services\CheckoutCalendarCartService,User,BusinessServices,Customer,BookingCheckinDetails,CompanyInformation,Transaction,Recurring,SGMailService,BusinessStaff,UserBookingStatus,UserBookingDetail};
use Auth;
use DB;
use DateTime;
use Config;
use Carbon\Carbon;
use App\Http\Controllers\Business\OrderController;
use App\Repositories\BookingRepository;
<<<<<<< HEAD
class CalendarController extends Controller
{
    protected $booking_repo;
=======

class CalendarController extends Controller
{
    protected $booking_repo;

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
    public function __construct(BookingRepository $booking_repo)
    {  
        $this->booking_repo = $booking_repo;
    }
<<<<<<< HEAD
    public function calendar(Request $request) {
        $user = User::where('id', Auth::user()->id)->first();
        $UserProfileDetail['firstname'] = $user->firstname;
=======

    public function calendar(Request $request) {
         
        $user = User::where('id', Auth::user()->id)->first();
        $UserProfileDetail['firstname'] = $user->firstname;

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
        $data = UserBookingStatus::selectRaw('chkdetails.id, ser.program_name as title, ser_sche.shift_start, ser_sche.shift_end, ser_sche.set_duration,chkdetails.checkin_date as start,bdetails.user_id')
                ->join("user_booking_details as bdetails", DB::raw('bdetails.booking_id'), '=', 'user_booking_status.id')
                ->join("booking_checkin_details as chkdetails", DB::raw('chkdetails.booking_detail_id'), '=', 'bdetails.id')
                ->join("business_services as ser", DB::raw('ser.id'), '=', 'bdetails.sport')
                ->join("business_activity_scheduler as ser_sche", DB::raw('ser_sche.id'), '=', 'bdetails.act_schedule_id')
                ->where('user_booking_status.user_id', Auth::user()->id)
                ->get();
<<<<<<< HEAD
        $fullary= [];
=======
       // echo "<pre>";print_r($data);exit;
        $fullary= [];

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
        foreach($data as $dt){
            $full_name = "N/A";
            if(@$dt->user_id != ''){
                $customerdata = Customer::where('id',$dt->user_id)->first();
                if($customerdata != ''){
                    $full_name = $customerdata->full_name;
                }
                $full_name = ucwords($full_name);
            }
            if(@$dt->set_duration != ''){
                $tm = explode(' ',$dt->set_duration);
                $hr=''; $min=''; $sec='';
                if($tm[0]!=0){ $hr=$tm[0].' hr '; }
                if($tm[2]!=0){ $min=$tm[2].' min '; }
                if($tm[4]!=0){ $sec=$tm[4].' sec'; }
                if($hr!='' || $min!='' || $sec!='')
                { $time =  $hr.$min.$sec; } 
            }
            $title = $dt['title'];
            $shift_start = $dt['shift_start'];
            $shift_end = $dt['shift_end'];
<<<<<<< HEAD
=======
           
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
            $id = $dt['id'];
            $start =  date('Y-m-d').'T'.$dt['shift_start'];
            $end =  date('Y-m-d').'T'.$dt['shift_end'];
            $fullary[] =array(
                "id"=>$id,
                "title"=>$title,
                "shift_start"=>$shift_start,
                "shift_end"=>$shift_end,
                "time"=>$time,
                "start"=>$dt['start'],
                "full_name"=>$full_name);
        }
<<<<<<< HEAD
        return view('calendar.index', ['UserProfileDetail' => $UserProfileDetail,'fullary'=>$fullary ] );
    }
=======

        //print_r($fullary);exit;

        return view('calendar.index', ['UserProfileDetail' => $UserProfileDetail,'fullary'=>$fullary ] );
    }

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
    public function eventmodelboxdata(Request $request){
        $html = ''; 
        $chkdetail = BookingCheckinDetails::find($request->id);
        if( $chkdetail != ''){
            $booking_detail = $chkdetail->UserBookingDetail;
            $ser_data = $booking_detail->business_services;
            $time = "N/A";
            if( $booking_detail->act_schedule_id != ''){
                $time = $booking_detail->business_activity_scheduler->activity_time().' ('. $booking_detail->business_activity_scheduler->get_clean_duration().')';
            }
            $participate = $booking_detail->decodeparticipate();
            if($ser_data != ''){
                $html = view('personal.calendar.modal_data',compact('ser_data','time','participate','booking_detail'))->render();
            }
<<<<<<< HEAD
        }
        return $html;
    }
    public function provider_calendar(Request $request,$business_id) {
=======
            
        }   
        return $html;
    }

    public function provider_calendar(Request $request,$business_id) {
        
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
         $data = UserBookingStatus::selectRaw('chkdetails.id, ser.program_name as title, ser_sche.shift_start, ser_sche.shift_end, ser_sche.set_duration,chkdetails.checkin_date as start,bdetails.user_id')
                ->join("user_booking_details as bdetails", DB::raw('bdetails.booking_id'), '=', 'user_booking_status.id')
                ->join("booking_checkin_details as chkdetails", DB::raw('chkdetails.booking_detail_id'), '=', 'bdetails.id')
                ->join("business_services as ser", DB::raw('ser.id'), '=', 'bdetails.sport')
                ->join("business_activity_scheduler as ser_sche", DB::raw('ser_sche.id'), '=', 'bdetails.act_schedule_id')
                ->where('ser.cid', Auth::user()->cid)
                ->get();
<<<<<<< HEAD
=======
       
        /*echo "<pre>";print_r($data);exit;*/
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
        $fullary= [];
        foreach($data as $dt){
            $full_name = "N/A";
            if(@$dt->user_id != ''){
                $customerdata = Customer::where('id',$dt->user_id)->first();
                if($customerdata != ''){
                    $full_name = $customerdata->full_name;
                }
<<<<<<< HEAD
=======
                
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
                $full_name = ucwords($full_name);
            }
            if(@$dt->set_duration != ''){
                $tm = explode(' ',$dt->set_duration);
                $hr=''; $min=''; $sec='';
                if($tm[0]!=0){ $hr=$tm[0].' hr '; }
                if($tm[2]!=0){ $min=$tm[2].' min '; }
                if($tm[4]!=0){ $sec=$tm[4].' sec'; }
                if($hr!='' || $min!='' || $sec!='')
                { $time =  $hr.$min.$sec; } 
            }
            $title = $dt['title'];
            $shift_start = $dt['shift_start'];
            $shift_end = $dt['shift_end'];
<<<<<<< HEAD
=======
           
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
            $id = $dt['id'];
            $start =  date('Y-m-d').'T'.$dt['shift_start'];
            $end =  date('Y-m-d').'T'.$dt['shift_end'];
            $fullary[] =array(
<<<<<<< HEAD
                "id"=>$id, "title"=>$title, "shift_start"=>$shift_start,
                "shift_end"=>$shift_end, "time"=>$time,
                "start"=>$dt['start'], "full_name"=>$full_name);
        }
        $program_list = BusinessServices::where(['is_active'=>1, 'userid'=>Auth::user()->id, 'cid'=>Auth::user()->cid])->get();
        $staffData = BusinessStaff::where('business_id',Auth::user()->cid)->get();
=======
                "id"=>$id,
                "title"=>$title,
                "shift_start"=>$shift_start,
                "shift_end"=>$shift_end,
                "time"=>$time,
                "start"=>$dt['start'],
                "full_name"=>$full_name);
        }

        $program_list = BusinessServices::where(['is_active'=>1, 'userid'=>Auth::user()->id, 'cid'=>Auth::user()->cid])->get();
        $staffData = BusinessStaff::where('business_id',Auth::user()->cid)->get();
       
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
        $modelchk = 0;
        $modeldata = '';
        $ordermodelary = array();
        $ordermodelary = session()->get('ordermodelary');
        if(!empty($ordermodelary)){
            $modelchk = 1;
            $orderController = new OrderController($this->booking_repo);
            $modeldata = $orderController->getmultipleodermodel($ordermodelary);
            session()->forget('ordermodelary');
        }
<<<<<<< HEAD
        $companyId = $business_id;
        return view('calendar.provider_calender', compact('fullary','program_list','companyId','modeldata','modelchk','staffData') );
    }
    public function chkStaffAssignedOrder(Request $request){ }
=======

        $companyId = $business_id;
        return view('calendar.provider_calender', compact('fullary','program_list','companyId','modeldata','modelchk','staffData') );
    }

    public function chkStaffAssignedOrder(Request $request){
        
    }

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
    public function paymentModal(Request $request, $business_id, $customerID){
        $intent = null;
        $customer = Customer::find($customerID);
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $intent = $stripe->setupIntents->create([
<<<<<<< HEAD
            'payment_method_types' => ['card'], 'customer' => $customer->stripe_customer_id,
        ]);
        $calendarCart = [];
        $cartdata  =  $request->session()->get('cart_item', []);
        if(!empty($cartdata ) && count($cartdata) >0 ) {
            foreach($cartdata['cart_item'] as $key=>$dt){
                if($dt['chk'] == 'calendar_activity_purchase' ){ $calendarCart []= $dt; }
=======
            'payment_method_types' => ['card'],
            'customer' => $customer->stripe_customer_id,
        ]);

        $calendarCart = [];
        $cartdata  =  $request->session()->get('cart_item', []);
     
        if(!empty($cartdata ) && count($cartdata) >0 ) {
            foreach($cartdata['cart_item'] as $key=>$dt){
                if($dt['chk'] == 'calendar_activity_purchase' ){
                    $calendarCart []= $dt;
                }
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
            }
        }
        return view('calendar.payment_modal',compact('intent','customer','calendarCart','business_id'));
    }
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
    public function store(Request $request){
        $companyId = Auth::user()->cid;
        $bookidarray = [];
        $company = CompanyInformation::where('id',$companyId)->first();
        $customer = $company->customers()->findOrFail($request->user_id);
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
        $user = Auth::User();
        $isCash = ($request->cash_amt > 0);
        $isCheck = ($request->check_amt > 0);
        $isCardOnFile = ($request->cc_amt > 0);
        $isNewCard = ($request->cc_new_card_amt > 0);
        $isComp = ($request->cardinfo == 'comp');
        $transactions = [];
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
        $CheckoutCalendarCartService = new CheckoutCalendarCartService();
        if($isComp){
            $transactions[] = [
                'channel' =>'comp',
                'kind' => 'comp',
                'transaction_id' => "COS_" . Carbon::now()->format('YmdHmsv'),
                'amount' => $CheckoutCalendarCartService->total($user),
                'qty' =>'1',
                'status' =>'complete',
                'refund_amount' => 0,
            ];
        }else{
            if($isCardOnFile){
                $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
                $onFileTotal = $request->cc_amt;
                $onFilePaymentMethodId = $request->card_id;
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
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
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
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
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
            if($isNewCard){
                $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
                $newCardTotal = $request->cc_new_card_amt;
                $newCardPaymentMethodId = $request->new_card_payment_method_id;
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
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
<<<<<<< HEAD
                    if(!$request->has('save_card')){
                        $stripePaymentMethod = \App\StripePaymentMethod::where('payment_id', $newCardPaymentMethodId)->firstOrFail();
                        $stripePaymentMethod->delete();
                    }
=======

                    if(!$request->has('save_card')){
                        $stripePaymentMethod = \App\StripePaymentMethod::where('payment_id', $newCardPaymentMethodId)->firstOrFail();

                        $stripePaymentMethod->delete();
                    }

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
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
<<<<<<< HEAD
            if($isCash){
                $transactions[] = [
                    'channel' =>'cash','kind' => 'cash',
                    'transaction_id' => "CS_" . Carbon::now()->format('YmdHmsv'),
                    'amount' => $request->cash_amt,
                    'qty' =>'1','status' =>'complete','refund_amount' => 0,
                ];
            }
            if($isCheck){
                $transactions[] = [
                    'channel' =>'check', 'kind' => 'check',
                    'transaction_id' => "CK_" . Carbon::now()->format('YmdHmsv'),
                    'amount' => $request->cash_amt,
                    'qty' =>'1', 'status' =>'complete', 'refund_amount' => 0,
                ];
            }
        }
        $userBookingStatus = UserBookingStatus::create([
            'user_id' => Auth::user()->id,
            'customer_id' => $request->user_id,
            'user_type' => 'customer','status' => 'active','currency_code' => 'usd',
=======

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
            'customer_id' => $request->user_id,
            'user_type' => 'customer',
            'status' => 'active',
            'currency_code' => 'usd',
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
            'amount' => $request->cash_amt + $request->cc_new_card_amt + $request->check_amt + $request->cc_amt,
            'order_type' => 'checkout_register',
            'bookedtime' => Carbon::now()->format('Y-m-d'),
        ]);
<<<<<<< HEAD
        foreach($transactions as $transaction){
=======

        foreach($transactions as $transaction){
            
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
            $tran_data = Transaction::create(array_merge($transaction, [ 
                'user_type' => 'Customer',
                'user_id' => $customer->id,
                'item_type' =>'UserBookingStatus',
                'item_id' => $userBookingStatus->id,
            ]));
        }
<<<<<<< HEAD
        foreach($CheckoutCalendarCartService->items() as $item){
=======

        foreach($CheckoutCalendarCartService->items() as $item){

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
            $now = new DateTime();
            $contact_date = $now->format('Y-m-d');
            $now->modify('+'. $item['actscheduleid']);
            $expired_at = $now;
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
                'price' => json_encode($CheckoutCalendarCartService->getQtyPriceByItem($item)['price']),
                'qty' => json_encode($CheckoutCalendarCartService->getQtyPriceByItem($item)['qty']),
                'priceid' => $item['priceid'],
                'pay_session' => $item['p_session'],
                'expired_at' => $expired_at,
                'contract_date' => Carbon::now()->format('Y-m-d'),
                'subtotal' => $CheckoutCalendarCartService->getSubTotalByItem($item, $user),
                'fitnessity_fee' => $CheckoutCalendarCartService->getRecurringFeeByItem($item, $user),
                'tax' => $item['tax'],
                'tip' => $item['tip'],
                'discount' => $item['discount'],
                'expired_duration' => $item['actscheduleid'],
                'participate' => '['.json_encode($item['participate_from_checkout_regi']).']',
                'user_type'=> 'customer',
                'user_id'=> $cUid,
                'transfer_provider_status' =>'unpaid',
                'payment_number' => '{}',
                'note'=>@$item['notes'],
                'repeateTimeType'=>@$item['repeateTimeType'],
                'everyWeeks'=>@$item['everyWeeks'],
                'monthDays'=>@$item['monthDays'],
                'enddate'=>@$item['enddate'],
                'activity_days'=>@$item['activity_days'],
                'order_from' => "Calendar Order"
            ]);
            $bookidarray [] = $booking_detail->id;
<<<<<<< HEAD
            $qty_c = $CheckoutCalendarCartService->getQtyPriceByItem($item)['qty'];
            $price_detail = $CheckoutCalendarCartService->getPriceDetail($item['priceid']);
=======

            $qty_c = $CheckoutCalendarCartService->getQtyPriceByItem($item)['qty'];
            $price_detail = $CheckoutCalendarCartService->getPriceDetail($item['priceid']);

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
            foreach($qty_c as $key=> $qty){
                $re_i = 0;
                $date = new Carbon;
                $stripeId = $stripeChargedAmount = $paymentMethod= '';
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
                if($key == 'adult'){
                    if($qty != '' && $qty != 0){
                        $amount = $qty * $price_detail->recurring_first_pmt_adult;
                        $re_i = $price_detail->recurring_nuberofautopays_adult; 
                        $reCharge  = $price_detail->recurring_customer_chage_by_adult;
                    }
                }
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
                if($key == 'child'){
                    if($qty != '' && $qty != 0){
                        $amount = $qty * $price_detail->recurring_first_pmt_child;
                        $re_i = $price_detail->recurring_nuberofautopays_child; 
                        $reCharge  = $price_detail->recurring_customer_chage_by_child;
                    }
                }
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
                if($key == 'infant'){
                    if($qty != '' && $qty != 0){
                        $amount =  $qty * $price_detail->recurring_first_pmt_infant;
                        $re_i = $price_detail->recurring_nuberofautopays_infant;
                        $reCharge  = $price_detail->recurring_customer_chage_by_infant;
                    }
                }
                $categoryData = $CheckoutCalendarCartService->getCategory($item['priceid']);
                $duesTax = $categoryData->dues_tax;
                $salesTax = $categoryData->sales_tax;
                if($duesTax == '' || $duesTax == null){
                    $duesTax = 0;
                }
<<<<<<< HEAD
                if($salesTax == '' || $salesTax == null){ $salesTax = 0; }
=======

                if($salesTax == '' || $salesTax == null){
                    $salesTax = 0;
                }

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
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
                                $addTime  = $afterHowmanytime * ($num - 1);
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
                                if($timeChk == 'Month'){
                                    $paymentDate = (Carbon::now()->addMonths($addTime))->format('Y-m-d');
                                }else if($timeChk == 'Week'){
                                    $paymentDate = (Carbon::now()->addWeeks($addTime))->format('Y-m-d');
                                }else if($timeChk == 'Year'){
                                    $paymentDate = (Carbon::now()->addYears($addTime))->format('Y-m-d');
                                }
                                $status = 'Scheduled';
                            } 
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
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
                'customer_id' => $customer->id,
                'booking_detail_id' => $booking_detail->id,
                'checkin_date' => NULL,
                'use_session_amount' => 0,
                'source_type' => 'in_person',
            ]);
<<<<<<< HEAD
=======

>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
            $businessService = $CheckoutCalendarCartService->getbusinessService($item['code']); 
            $email_detail = array(
                "email" => @$CheckoutCalendarCartService->getCompany(Auth::user()->cid)->business_email, 
                "CustomerName" => @$CheckoutCalendarCartService->getCompany(Auth::user()->cid)->full_name, 
                "Url" => env('APP_URL').'/personal/orders?business_id='.Auth::user()->cid, 
                "BusinessName"=> @$CheckoutCalendarCartService->getCompany(Auth::user()->cid)->dba_business_name,
                "BookedPerson"=> $CheckoutCalendarCartService->getbookedPerson($request->user_id),
                "ParticipantsName"=> $participateName,
                "date"=> "N/A",
                "time"=>  "N/A",
                "duration"=>  "N/A",
                "ActivitiyType"=> $businessService->service_type,
                "ProgramName"=> $businessService->program_name,
                "CategoryName"=> @$categoryData->category_title);

            SGMailService::confirmationMail($email_detail);
        }
<<<<<<< HEAD
        session()->forget('cart_item');
        session()->put('ordermodelary', $bookidarray);
        return redirect()->route('provider_calendar', ['business_id'=>Auth::user()->cid]);
    }
}
=======

        session()->forget('cart_item');
        session()->put('ordermodelary', $bookidarray);
        
        return redirect()->route('provider_calendar', ['business_id'=>Auth::user()->cid]);
    }

}
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394
