<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\AddrCities;
use App\AddrStates;
use App\UserBookingStatus;
use App\UserBookingDetail;
use App\{BusinessServices,Customer,BookingCheckinDetails,CompanyInformation,Transaction,Recurring,SGMailService,BusinessStaff};
use App\Services\CheckoutCalendarCartService;
use Auth;
use DB;
use DateTime;
use Config;
use Carbon\Carbon;
use App\Http\Controllers\Business\OrderController;
use App\Repositories\BookingRepository;

class CalendarController extends Controller
{
    protected $booking_repo;

    public function __construct(BookingRepository $booking_repo)
    {  
        $this->booking_repo = $booking_repo;
    }

    public function calendar(Request $request) {
         
        $user = User::where('id', Auth::user()->id)->first();
        $UserProfileDetail['firstname'] = $user->firstname;

        $data = UserBookingStatus::selectRaw('chkdetails.id, ser.program_name as title, ser_sche.shift_start, ser_sche.shift_end, ser_sche.set_duration,chkdetails.checkin_date as start,bdetails.user_id')
                ->join("user_booking_details as bdetails", DB::raw('bdetails.booking_id'), '=', 'user_booking_status.id')
                ->join("booking_checkin_details as chkdetails", DB::raw('chkdetails.booking_detail_id'), '=', 'bdetails.id')
                ->join("business_services as ser", DB::raw('ser.id'), '=', 'bdetails.sport')
                ->join("business_activity_scheduler as ser_sche", DB::raw('ser_sche.id'), '=', 'bdetails.act_schedule_id')
                ->where('user_booking_status.user_id', Auth::user()->id)
                ->get();
       // echo "<pre>";print_r($data);exit;
        $fullary= [];

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

        //print_r($fullary);exit;

        return view('calendar.index', ['UserProfileDetail' => $UserProfileDetail,'fullary'=>$fullary ] );
    }

    public function eventmodelboxdata(Request $request){
        /*$date = explode('T',$request->start);
        echo $date[0];*/
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
                if(date('Y-m-d') > date('Y-m-d',strtotime($chkdetail->checkin_date) ) ){
                    $tabval = "past";
                }else if(date('Y-m-d') == date('Y-m-d',strtotime($chkdetail->checkin_date) ) ){
                    $tabval = "today";
                }else{
                    $tabval = "upcoming";
                }
                $html .='<div class="calendar-body">
                        <h3>'.$ser_data->program_name.'</h3>
                        <p>'.$ser_data->company_information->dba_business_name.'</p>
                        <p class="calendar-address">'.$ser_data->company_information->company_address().'</p>
                       <div class="calendar-time">
                            <label>Time: </label> <span>'.$time.'</span>
                        </div>
                        <div class="calendar-time">
                            <label>Who\'s Participating: </label> <span>'.$participate.' </span>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <div class="calendar-btns">
                                   <a class="btn btn-black" href="'.route("business_activity_schedulers",['business_id' => $ser_data->cid, 'business_service_id' => $ser_data->id, 'stype' =>  $ser_data->service_type]).'" target="_blank">Reschedule</a> 
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="calendar-btns">
                                    <a class="btn btn-red float-end" href="'.route("business_customer_show", ['business_id' => $ser_data->cid,'id'=>$booking_detail->user_id]).'" target="_blank">View Booking</a> 
                                </div>
                            </div>
                        </div>
                    </div>';
            }
            
        }   
        return $html;
    }

    public function provider_calendar(Request $request,$business_id) {
        
         $data = UserBookingStatus::selectRaw('chkdetails.id, ser.program_name as title, ser_sche.shift_start, ser_sche.shift_end, ser_sche.set_duration,chkdetails.checkin_date as start,bdetails.user_id')
                ->join("user_booking_details as bdetails", DB::raw('bdetails.booking_id'), '=', 'user_booking_status.id')
                ->join("booking_checkin_details as chkdetails", DB::raw('chkdetails.booking_detail_id'), '=', 'bdetails.id')
                ->join("business_services as ser", DB::raw('ser.id'), '=', 'bdetails.sport')
                ->join("business_activity_scheduler as ser_sche", DB::raw('ser_sche.id'), '=', 'bdetails.act_schedule_id')
                ->where('ser.cid', Auth::user()->cid)
                ->get();
       
        /*echo "<pre>";print_r($data);exit;*/
        $fullary= [];
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

        $program_list = BusinessServices::where(['is_active'=>1, 'userid'=>Auth::user()->id, 'cid'=>Auth::user()->cid])->get();
        $staffData = BusinessStaff::where('business_id',Auth::user()->cid)->get();
       
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

        $companyId = $business_id;
        return view('calendar.provider_calender', compact('fullary','program_list','companyId','modeldata','modelchk','staffData') );
    }

    public function chkStaffAssignedOrder(Request $request){
        
    }

    public function paymentModal(Request $request, $business_id, $customerID){
        $intent = null;
        $customer = Customer::find($customerID);
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $intent = $stripe->setupIntents->create([
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
            }
        }
        return view('calendar.payment_modal',compact('intent','customer','calendarCart','business_id'));
    }

    public function store(Request $request){
        $companyId = Auth::user()->cid;
        $bookidarray = [];
        $company = CompanyInformation::where('id',$companyId)->first();
        $customer = $company->customers()->findOrFail($request->user_id);

        $user = Auth::User();
        $isCash = ($request->cash_amt > 0);
        $isCheck = ($request->check_amt > 0);
        $isCardOnFile = ($request->cc_amt > 0);
        $isNewCard = ($request->cc_new_card_amt > 0);
        $isComp = ($request->cardinfo == 'comp');
        $transactions = [];

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

        foreach($CheckoutCalendarCartService->items() as $item){

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

            $qty_c = $CheckoutCalendarCartService->getQtyPriceByItem($item)['qty'];
            $price_detail = $CheckoutCalendarCartService->getPriceDetail($item['priceid']);

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
                $categoryData = $CheckoutCalendarCartService->getCategory($item['priceid']);
                $duesTax = $categoryData->dues_tax;
                $salesTax = $categoryData->sales_tax;
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
                                $addTime  = $afterHowmanytime * ($num - 1);

                                if($timeChk == 'Month'){
                                    $paymentDate = (Carbon::now()->addMonths($addTime))->format('Y-m-d');
                                }else if($timeChk == 'Week'){
                                    $paymentDate = (Carbon::now()->addWeeks($addTime))->format('Y-m-d');
                                }else if($timeChk == 'Year'){
                                    $paymentDate = (Carbon::now()->addYears($addTime))->format('Y-m-d');
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
                'customer_id' => $customer->id,
                'booking_detail_id' => $booking_detail->id,
                'checkin_date' => NULL,
                'use_session_amount' => 0,
                'source_type' => 'in_person',
            ]);

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

        session()->forget('cart_item');
        session()->put('ordermodelary', $bookidarray);
        
        return redirect()->route('provider_calendar', ['business_id'=>Auth::user()->cid]);
    }

}
