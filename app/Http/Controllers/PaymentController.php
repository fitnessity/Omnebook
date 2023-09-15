<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Libraries\Stripes\StripePay;
use App\Http\Controllers\Controller;
use App\Repositories\{BookingRepository};
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
use App\{UserBookingStatus,User,BusinessServices,BusinessService,UserBookingDetail,Customer,BookingCheckinDetails,BusinessActivityScheduler,BusinessSubscriptionPlan,Transaction,SGMailService,Recurring,StripePaymentMethod};
use Carbon\Carbon;
use Illuminate\Support\Str;
use DateTime;
use DateTimeZone;
use App\Services\CartService;

class PaymentController extends Controller {

    public function __construct(BookingRepository $bookings) {
        
        $this->middleware('auth', ['except' => ['getBladeDetail1','profileDetail', 'SendVerificationlinkCall', 'SendVerificationlinkMsg', 'makeCall', 'generateVoiceMessage', 'sendCustomMessage', 'getBladeDetail', 'newFUn', 'getBusinessClaim', 'getStateList', 'getCityList', 'familyProfileUpdate', 'submitFamilyForm', 'submitFamilyFormWithSkip', 'check', 'deleteCompany', 'submitFamilyForm1', 'skipFamilyForm1', 'getBusinessClaimDetaill', 'businessClaim', 'getLocationBusinessClaimDetaill', 'VerifySendVerificationlink', 'searchResultLocation', 'searchResultLocation1','profileView','sendmail','mailtemplate','about','postDetail']]);

        $this->bookings = $bookings;
        $this->arr = [];        
    }

    public function createCheckoutSession(Request $request) {
        //print_r($request->all());exit;
        $loggedinUser = Auth::user();
        $customer='';

        $cartService = new CartService();

        $fees = BusinessSubscriptionPlan::where('id',1)->first();
        if($request->grand_total == 0){
            $orderdata = array(
                'user_id' => $loggedinUser->id,
                'status' => 'active',
                'currency_code' => 'usd',
                'amount' => $request->grand_total,
                'order_type' => 'simpleorder',
                'bookedtime' => Carbon::now()->format('Y-m-d'),
            );
            $userBookingStatus = UserBookingStatus::create($orderdata);

            $transactiondata = array( 
                'user_type' => 'user',
                'user_id' => $loggedinUser->id,
                'item_type' =>'UserBookingStatus',
                'item_id' => $userBookingStatus->id,
                'channel' =>'',
                'kind' => 'comp',
                'transaction_id' => '',
                'stripe_payment_method_id' => '',
                'amount' => $request->grand_total,
                'qty' =>'1',
                'status' =>'processing',
                'refund_amount' =>0,
                'payload' =>'',
            );

            $transactionstatus = Transaction::create($transactiondata);
            $lastid = $userBookingStatus->id; 

            foreach($cartService->items() as $item){
                $activityScheduler = BusinessActivityScheduler::find($item['actscheduleid']);
                $businessServices = BusinessServices::find($item['code']);
                $user = $businessServices->users;
                $price_detail = $cartService->getPriceDetail($item['priceid']);
                
                $customer = Customer::where(['business_id' => $businessServices->cid, 'email' => Auth::user()->email, 'user_id' => Auth::user()->id])->first();

                if(!$customer){
                    $customer = Customer::create([
                        'business_id' => $businessServices->cid,
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

                $participateLoop =  $cartService->participateLoop($item,$businessServices->cid);
                foreach($participateLoop as $d){
                    $participateAry = [];
                    $qtyAry = [];
                    $qtyPrice = [];
                    foreach(['adult', 'child', 'infant'] as $role){
                        if($d['type'] == $role){
                            $qtyAry[$role] = 1;
                            $qtyPrice[$role] = $d['price'];
                        }else{
                            $qtyAry[$role] = 0;
                            $qtyPrice[$role] = 0;
                        }
                    }
                    $participateAry['from'] ='customer';
                    $participateAry['id'] = $d['id'];

                    $addOnServicePrice = @$item['addOnServicesTotalPrice'] ?? 0 ;
                    
                    $booking_detail = UserBookingDetail::create([                 
                        'booking_id' => $userBookingStatus->id,
                        'user_id'=> $d['id'],
                        'user_type'=> 'customer',
                        'sport' => $item['code'],
                        'bookedtime' => $item['sesdate'],
                        'business_id'=> $businessServices->cid,
                        'price' => json_encode($qtyPrice),
                        'qty' => json_encode($qtyAry),
                        'priceid' => $item['priceid'],
                       // 'pay_session' => $paySessionQty * $price_detail->pay_session,
                        'pay_session' => $price_detail->pay_session,
                        'act_schedule_id' => $activityScheduler->id,
                        'expired_at' => $activityScheduler->end_activity_date,
                        'contract_date' => Carbon::now()->format('Y-m-d'),
                        'subtotal' => $cartService->getSubTotal($item['priceid'],$d['type'],$d['price'],$addOnServicePrice),
                        'discount' => 0,
                        'tax' =>  0,
                        'fitnessity_fee' => 0,
                        'service_fee' => 0,
                        'tip' => 0,
                        'participate' => '['.json_encode($participateAry).']',
                        'transfer_provider_status' =>'unpaid',
                        'payment_number' => '{}',
                        'order_from' => "Instant Hire",
                        'addOnservice_ids' =>@$item['addOnServicesId'],
                        'addOnservice_qty' => @$item['addOnServicesQty'],
                        'addOnservice_total' => $addOnServicePrice,
                    ]);

                    $booking_detail->transfer_to_provider();

                    $price_detail = $cartService->getPriceDetail($item['priceid']);

                    $re_i = 0;
                    $date = new Carbon;
                    $stripe_id = $stripe_charged_amount = $payment_method= '';
                    $amount = $re_i = $reCharge = ''; 
                    if($d['type'] == 'adult'){
                        $amount = 1 * $price_detail->recurring_first_pmt_adult;
                        $re_i = $price_detail->recurring_nuberofautopays_adult; 
                        $reCharge  = $price_detail->recurring_customer_chage_by_adult;
                    }else if($d['type'] == 'child'){
                        $amount =  1 * $price_detail->recurring_first_pmt_child;
                        $re_i = $price_detail->recurring_nuberofautopays_child; 
                        $reCharge  = $price_detail->recurring_customer_chage_by_child;
                    }else if($d['type'] == 'infant'){
                        $amount =  1 * $price_detail->recurring_first_pmt_infant;
                        $re_i = $price_detail->recurring_nuberofautopays_infant;
                        $reCharge  = $price_detail->recurring_customer_chage_by_infant;
                    }

                    if($re_i != '' && $re_i != 0 && $amount != ''){
                        $tax_recurring = number_format((($amount * $fees->service_fee)/100)  + (($amount * $fees->site_tax)/100),2);
                        for ($num = $re_i; $num >0 ; $num--) { 
                            $payment_method = $transactionstatus->stripe_payment_method_id;
                            if($num==1){
                                $stripe_id =  $transactionstatus->transaction_id;
                                $stripe_charged_amount = number_format($transactionstatus->amount,2);
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
                                "user_id" => $d['id'],
                                "user_type" => 'customer',
                                "business_id" => $booking_detail->business_id ,
                                "payment_date" => $paymentDate,
                                "amount" => $amount,
                                'charged_amount'=> $stripe_charged_amount,
                                'payment_method'=> $payment_method,
                                'stripe_payment_id'=> $stripe_id,
                                "tax" => $tax_recurring ,
                                "status" => $status,
                            );
                            Recurring::create($recurring);
                        }
                    }

                    BookingCheckinDetails::create([
                        'business_activity_scheduler_id' => $activityScheduler->id,
                        'customer_id' => $d['id'],
                        'booking_detail_id' => $booking_detail->id,
                        'checkin_date' => date('Y-m-d',strtotime($item['sesdate'])),
                        'use_session_amount' => 0,
                        'source_type' => 'marketplace',
                    ]);

                    $getreceipemailtbody = $this->bookings->getreceipemailtbody($booking_detail->booking_id, $booking_detail->id);
                    $email_detail = array(
                        'getreceipemailtbody' => $getreceipemailtbody,
                        'email' => Auth::user()->email);
                    SGMailService::sendBookingReceipt($email_detail);

                    $email_detail2 = $this->generateEmailDetails(
                        @$businessServices->company_information->business_email,
                        $businessServices,
                        $cartService,
                        $participateAry,
                        $item,
                        $activityScheduler,
                        $price_detail
                    );

                    SGMailService::confirmationMail($email_detail2);
                    $company = @$cartService->getCompany($businessServices->cid);
                    $businessTerms = @$company->businessterms; 
                    $email_detail1 = array(
                        "CompanyName" =>  @$company->company_name, 
                        "RepName" =>  @$company->full_name, 
                        "CompanyAddress" => @$company->company_address(), 
                        "phone" => @$company->business_phone, 
                        "email" => @$company->business_email, 
                        "website" => @$company->business_website, 
                        "MapImage" => 'https://maps.googleapis.com/maps/api/staticmap?center='.@$company->latitude.','.@$company->longitude.'&zoom=15&size=600x300&maptype=roadmap&markers=color:red|'.@$company->latitude.','.@$company->longitude.'&key=AIzaSyBHm1RdzTbNsr9qm-AEfdreOWihD-oHN9A', 
                        "thingsToKnow" => @$businessTerms->houserules, 
                        "CancellationText" => @$businessTerms->cancelation, 
                        "RefundText" => @$businessTerms->refundpolicytext
                    );

                    SGMailService::confirmationMailForCustomer(array_merge($email_detail2,$email_detail1));
                }
            }

            $updatedCartitems = $cartService->updatedCartitems();
            session()->put('cart_item', $updatedCartitems);
            return view('jobpost.confirm-payment-instant');
        }else{
            \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
            $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));

            if($loggedinUser->stripe_customer_id != '') {
                $stripe_customer_id = $loggedinUser->stripe_customer_id;
            }else{
                $stripe_customer_id = $loggedinUser->create_stripe_customer_id();
            }

            $totalprice =  $priceWithDiscount = 0;
            $totalprice = $request->grand_total;

            if($request->has('cardinfo')){
                $onFilePaymentMethodId = $request->cardinfo;

                try {
                    $onFilePaymentIntent = $stripe->paymentIntents->create([
                        'amount' =>  round($totalprice *100),
                        'currency' => 'usd',
                        'customer' => $stripe_customer_id,
                        'payment_method' => $onFilePaymentMethodId ,
                        'off_session' => true,
                        'confirm' => true,
                        'metadata' => [],
                    ]);

                    if($onFilePaymentIntent['status']=='succeeded'){

                        $orderdata = array(
                            'user_id' => Auth::user()->id,
                            'status' => 'active',
                            'currency_code' => 'usd',
                            'amount' => $totalprice,
                            'bookedtime' =>Carbon::now()->format('Y-m-d'),
                        ); 
                        $userBookingStatus = UserBookingStatus::create($orderdata);

                        $transactiondata = array( 
                            'user_type' => 'user',
                            'user_id' => $loggedinUser->id,
                            'item_type' =>'UserBookingStatus',
                            'item_id' => $userBookingStatus->id,
                            'channel' =>'stripe',
                            'kind' => 'card',
                            'transaction_id' => $onFilePaymentIntent["id"],
                            'stripe_payment_method_id' => $onFilePaymentMethodId,
                            'amount' => $totalprice,
                            'qty' =>'1',
                            'status' =>'complete',
                            'refund_amount' =>0,
                            'payload' =>json_encode($onFilePaymentIntent,true),
                        );

                        $transactionstatus = Transaction::create($transactiondata);
                    }
                }catch(\Stripe\Exception\CardException $e) {
                    $errormsg = $e->getError()->message;
                    return redirect('/carts')->with('stripeErrorMsg', $errormsg);
                }catch (Exception $e) {
                    $errormsg = $e->getError()->message;
                    return redirect('/carts')->with('stripeErrorMsg', $errormsg);
                }
            }else{
               // echo $request->new_card_payment_method_id;
                $newCardPaymentMethodId = $request->new_card_payment_method_id;
              //  echo  $newCardPaymentMethodId;exit;
                try {
                    $newCardPaymentIntent = $stripe->paymentIntents->create([
                        'amount' =>  round($totalprice *100),
                        'currency' => 'usd',
                        'customer' => $stripe_customer_id,
                        'payment_method' => $newCardPaymentMethodId,
                        'off_session' => true,
                        'confirm' => true,
                        'metadata' => [],
                    ]);
                    if(!$request->has('save_card')){
                        $stripePaymentMethod = \App\StripePaymentMethod::where('payment_id', $newCardPaymentMethodId)->firstOrFail();
                        $stripePaymentMethod->delete();
                    }

                    if($newCardPaymentIntent['status'] == 'succeeded'){
                        $orderdata = array(
                            'user_id' => Auth::user()->id,
                            'status' => 'active',
                            'currency_code' => 'usd',
                            'amount' => $totalprice,
                            'bookedtime' => Carbon::now()->format('Y-m-d'),
                        ); 
                        $userBookingStatus = UserBookingStatus::create($orderdata);

                        $transactiondata = array( 
                            'user_type' => 'user',
                            'user_id' => $loggedinUser->id,
                            'item_type' =>'UserBookingStatus',
                            'item_id' => $userBookingStatus->id,
                            'channel' =>'stripe',
                            'kind' => 'card',
                            'transaction_id' => $newCardPaymentIntent["id"],
                            'stripe_payment_method_id' => $newCardPaymentMethodId,
                            'amount' => $totalprice,
                            'qty' =>'1',
                            'status' =>'complete',
                            'refund_amount' =>0,
                            'payload' =>json_encode($newCardPaymentIntent,true),
                        );

                        $transactionstatus = Transaction::create($transactiondata);
                    }
                }catch(\Stripe\Exception\CardException $e) {
                    $errormsg = $e->getError()->message;
                    return redirect('/carts')->with('stripeErrorMsg', $errormsg);
                }catch (Exception $e) {
                    $errormsg = $e->getError()->message;
                    return redirect('/carts')->with('stripeErrorMsg', $errormsg);
                }
            }

            $bspdata = BusinessSubscriptionPlan::where('id',1)->first();
            $tax = $bspdata->site_tax;

            foreach($cartService->items() as $item){

                $activityScheduler = BusinessActivityScheduler::find($item['actscheduleid']);
                $businessServices = BusinessServices::find($item['code']);
                $user = $businessServices->user;
                $price_detail = $cartService->getPriceDetail($item['priceid']);

                $customer = Customer::where(['business_id' => $businessServices->cid, 'email' => Auth::user()->email, 'user_id' => Auth::user()->id])->first();

                if(!$customer){
                    $customer = Customer::create([
                        'business_id' => $businessServices->cid,
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

                $participateLoop =  $cartService->participateLoop($item,$businessServices->cid);
                //print_r($participateLoop);exit();
                foreach($participateLoop as $d){
                    $participateAry = [];
                    $qtyAry = [];
                    $qtyPrice = [];
                    foreach(['adult', 'child', 'infant'] as $role){
                        if($d['type'] == $role){
                            $qtyAry[$role] = 1;
                            $qtyPrice[$role] = $d['price'];
                        }else{
                            $qtyAry[$role] = 0;
                            $qtyPrice[$role] = 0;
                        }
                    }
                    $participateAry['from'] ='customer';
                    $participateAry['id'] = $d['id'];

                    $discount = $cartService->getDiscount($item['priceid'],$d['type'],$d['price']);

                    $addOnServicePrice = @$item['addOnServicesTotalPrice'] ?? 0 ;
                    $priceWithDiscount = $d['price'] - $discount + $addOnServicePrice;

                    $booking_detail = UserBookingDetail::create([                 
                        'booking_id' => $userBookingStatus->id,
                        'user_id'=> $d['id'],
                        'user_type'=> 'customer',
                        'sport' => $item['code'],
                        'bookedtime' => $item['sesdate'],
                        'business_id'=> $businessServices->cid,
                        'price' => json_encode($qtyPrice),
                        'qty' => json_encode($qtyAry),
                        'priceid' => $item['priceid'],
                       // 'pay_session' => $paySessionQty * $price_detail->pay_session,
                        'pay_session' => $price_detail->pay_session,
                        'act_schedule_id' => $activityScheduler->id,
                        'expired_at' => $activityScheduler->end_activity_date,
                        'contract_date' => Carbon::now()->format('Y-m-d'),
                        'subtotal' => $cartService->getSubTotal($item['priceid'],$d['type'],$d['price'], $addOnServicePrice),
                        'discount' => $discount,
                        'tax' =>  $cartService->getTax($priceWithDiscount),
                        'fitnessity_fee' => $cartService->getFitnessFee($priceWithDiscount, $user),
                        'service_fee' => $cartService->getServiceFee($priceWithDiscount),
                        'tip' => 0,
                        'participate' =>'['.json_encode($participateAry).']',
                        'transfer_provider_status' =>'unpaid',
                        'payment_number' => '{}',
                        'order_from' => "Instant Hire",
                        'addOnservice_ids' =>@$item['addOnServicesId'],
                        'addOnservice_qty' => @$item['addOnServicesQty'],
                        'addOnservice_total' =>  $addOnServicePrice,
                    ]);

                    $booking_detail->transfer_to_provider();

                    $price_detail = $cartService->getPriceDetail($item['priceid']);

                    $re_i = 0;
                    $date = new Carbon;
                    $stripe_id = $stripe_charged_amount = $payment_method= '';
                    $amount = $re_i = $reCharge = ''; 
                    if($d['type'] == 'adult'){
                        $amount = 1 * $price_detail->recurring_first_pmt_adult;
                        $re_i = $price_detail->recurring_nuberofautopays_adult; 
                        $reCharge  = $price_detail->recurring_customer_chage_by_adult;
                    }else if($d['type'] == 'child'){
                        $amount =  1 * $price_detail->recurring_first_pmt_child;
                        $re_i = $price_detail->recurring_nuberofautopays_child; 
                        $reCharge  = $price_detail->recurring_customer_chage_by_child;
                    }else if($d['type'] == 'infant'){
                        $amount =  1 * $price_detail->recurring_first_pmt_infant;
                        $re_i = $price_detail->recurring_nuberofautopays_infant;
                        $reCharge  = $price_detail->recurring_customer_chage_by_infant;
                    }

                    if($re_i != '' && $re_i != 0 && $amount != ''){
                        $tax_recurring = number_format((($amount * $fees->service_fee)/100)  + (($amount * $fees->site_tax)/100),2);
                        for ($num = $re_i; $num >0 ; $num--) { 
                            $payment_method = $transactionstatus->stripe_payment_method_id;
                            if($num==1){
                                $stripe_id =  $transactionstatus->transaction_id;
                                $stripe_charged_amount = number_format($transactionstatus->amount,2);
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
                                "user_id" =>  $d['id'],
                                "user_type" => 'customer',
                                "business_id" => $booking_detail->business_id ,
                                "payment_date" => $paymentDate,
                                "amount" => $amount,
                                'charged_amount'=> $stripe_charged_amount,
                                'payment_method'=> $payment_method,
                                'stripe_payment_id'=> $stripe_id,
                                "tax" => $tax_recurring ,
                                "status" => $status,
                            );
                            Recurring::create($recurring);
                        }
                    }

                    BookingCheckinDetails::create([
                        'business_activity_scheduler_id' => $activityScheduler->id,
                        'customer_id' => $d['id'],
                        'booking_detail_id' => $booking_detail->id,
                        'checkin_date' => date('Y-m-d',strtotime($item['sesdate'])),
                        'use_session_amount' => 0,
                        'source_type' => 'marketplace',
                    ]);

                    $getreceipemailtbody = $this->bookings->getreceipemailtbody($booking_detail->booking_id, $booking_detail->id);
                    $email_detail = array(
                        'getreceipemailtbody' => $getreceipemailtbody,
                        'email' => Auth::user()->email);
                    SGMailService::sendBookingReceipt($email_detail);
                    
                    $email_detail2 = $this->generateEmailDetails(
                        @$businessServices->company_information->business_email,
                        $businessServices,
                        $cartService,
                        $participateAry,
                        $item,
                        $activityScheduler,
                        $price_detail
                    );

                    SGMailService::confirmationMail($email_detail2);
                    $company = @$cartService->getCompany($businessServices->cid);
                    $businessTerms = @$company->businessterms; 
                    $email_detail1 = array(
                        "CompanyName" =>  @$company->company_name, 
                        "RepName" =>  @$company->full_name, 
                        "CompanyAddress" => @$company->company_address(), 
                        "phone" => @$company->business_phone, 
                        "email" => @$company->business_email, 
                        "website" => @$company->business_website, 
                        "MapImage" => 'https://maps.googleapis.com/maps/api/staticmap?center='.@$company->latitude.','.@$company->longitude.'&zoom=15&size=600x300&maptype=roadmap&markers=color:red|'.@$company->latitude.','.@$company->longitude.'&key=AIzaSyBHm1RdzTbNsr9qm-AEfdreOWihD-oHN9A',
                        "thingsToKnow" => @$businessTerms->houserules, 
                        "CancellationText" => @$businessTerms->cancelation, 
                        "RefundText" => @$businessTerms->refundpolicytext);

                    SGMailService::confirmationMailForCustomer(array_merge($email_detail2,$email_detail1));
                }
            }

            $updatedCartitems = $cartService->updatedCartitems();
            session()->put('cart_item', $updatedCartitems);
            return redirect('/instant-hire/confirm-payment');
        }
    }

    public function generateEmailDetails($email, $businessServices, $cartService, $participateAry, $item, $activityScheduler, $price_detail){
        return array(
            "email" => $email, 
            "CustomerName" => @$cartService->getCompany($businessServices->cid)->full_name, 
            "Url" => env('APP_URL').'/personal/orders?business_id='.$businessServices->cid, 
            "BusinessName"=> @$cartService->getCompany($businessServices->cid)->dba_business_name,
            "BookedPerson"=> Auth::user()->full_name,
            "ParticipantsName"=> @$cartService->getParticipateByComa( json_encode($participateAry)),
            "date"=> Carbon::parse($item['sesdate'])->format('m/d/Y'),
            "time"=> $activityScheduler->activity_time(),
            "duration"=> $activityScheduler->get_clean_duration(),
            "ActivitiyType"=> $businessServices->service_type,
            "ProgramName"=> $businessServices->program_name,
            "CategoryName"=> $price_detail->business_price_details_ages_with_trashed->category_title
        );
    }


    public function confirmpaymentinstant(Request $request) {
        return view('jobpost.confirm-payment-instant');
    }

    public function form_participate(Request $request){
        //print_r($request->all());exit;
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
                    }else if($request->type == 'family'){
                        $cart_item["cart_item"][$k]["participate"][$request->counter]['id'] = $request->familyid;
                        $cart_item["cart_item"][$k]["participate"][$request->counter]['from'] = 'family';
                    }else{
                        $cart_item["cart_item"][$k]["participate"][$request->counter]['id'] = $request->familyid;
                        $cart_item["cart_item"][$k]["participate"][$request->counter]['from'] = 'customer';
                    }
                }
            }
        }
        $request->session()->put('cart_item', $cart_item);
    } 


    public function refresh_payment_methods(Request $request){
        $user = User::findOrFail($request->user_id);
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
        $payment_methods = $stripe->paymentMethods->all(['customer' => $user->stripe_customer_id, 'type' => 'card']);
        $fingerprints = [];
        foreach($payment_methods as $payment_method){
            $fingerprint = $payment_method['card']['fingerprint'];
            if (in_array($fingerprint, $fingerprints, true)) {
                $deletePaymentMethod = StripePaymentMethod::where('payment_id', $payment_method['id'])->firstOrFail();
                $deletePaymentMethod->delete();
            } else {
                $fingerprints[] = $fingerprint;
                $stripePaymentMethod = StripePaymentMethod::firstOrNew([
                    'payment_id' => $payment_method['id'],
                    'user_type' => 'User',
                    'user_id' => $user->id,
                ]);

                $stripePaymentMethod->pay_type = $payment_method['type'];
                $stripePaymentMethod->brand = $payment_method['card']['brand'];
                $stripePaymentMethod->exp_month = $payment_method['card']['exp_month'];
                $stripePaymentMethod->exp_year = $payment_method['card']['exp_year'];
                $stripePaymentMethod->last4 = $payment_method['card']['last4'];
                $stripePaymentMethod->save();
            }
        }
        if($request->return_url)
            return redirect($request->return_url);
    }
    
}
