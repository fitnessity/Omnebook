<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Config;
use App\UserBookingStatus;
use App\UserBookingDetail;
use App\BusinessPriceDetails;
use App\User;
use App\UserBookingRecurringPaymentDetails;
use App\BusinessSubscriptionPlan;

class StripeCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stripe:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Suceesful';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        $stripekey = env('STRIPE_KEY');
        \Stripe\Stripe::setApiKey($stripekey);
        $fees = BusinessSubscriptionPlan::where('id',1)->first();
        $pmtdata = UserBookingStatus::orderBy('id' ,'desc')->get();
       /* print_r($pmtdata);*//*exit();*/
        if(!empty($pmtdata)){
            foreach($pmtdata as $data){
                $userdata = User::where('id',$data['user_id'])->first();
                /*echo $userdata;exit();*/
                if($userdata != ''){
                    $customer_id  = $userdata->stripe_customer_id;
                    if($customer_id != ''){
                        $stripe = new \Stripe\StripeClient($stripekey);
                        $carddetails = $stripe->customers->createSource(
                             $customer_id,
                            ['source' => 'tok_visa']
                        );
                        $bookdetails = UserBookingDetail::where('booking_id',$data['id'])->get();
                        /*print_r($bookdetails);exit();*/
                        foreach($bookdetails as $details){
                            $pricedetails =  BusinessPriceDetails::where('id',$details['priceid'])->first();
                            $a = json_decode($details['qty']);
                            $extra_fees = json_decode($details['extra_fees']);
                            $pmt_num_person = json_decode($details['payment_number']);
                            $service_fee1 = 0;
                            $site_tax = 0;
                            if( !empty($extra_fees->service_fee) ){
                                $service_fee1 = @$fees->service_fee;
                            }

                            if( !empty($extra_fees->site_tax) ){
                                $site_tax = @$fees->site_tax;
                            }
                            if( !empty($a->adult) ){
                                $tot_price = 0;
                                $service_fee = 0;
                                $tax = 0;
                                $total_amount = 0;
                                $tot_price = $a->adult * @$pricedetails->recurring_recurring_pmt_adult;
                                $service_fee= ($tot_price * @$service_fee1)/100;
                                $tax= ($tot_price * @$site_tax)/100;
                                $total_amount =($tot_price + $service_fee + $tax)*100;
                                if( $pmt_num_person->adult < @$pricedetails->recurring_nuberofautopays_adult){
                                    $today =date('Y-m-d');
                                    if(  $pmt_num_person->adult  == 1){
                                        $month =date('Y-m-d', strtotime($data['created_at']. '+1 month' ));
                                    }else{
                                        $recudata = UserBookingRecurringPaymentDetails::where(['user_order_details_id'=>$details['id'],'person_type'=>'Adult'])->orderBy('created_at', 'desc')->first(); 
                                        $month =date('Y-m-d', strtotime($recudata['created_at']. '+1 month' ));
                                    }
                                    if($today == $month){
                                        try {
                                            $pmtintent = \Stripe\PaymentIntent::create([
                                                'amount' =>  round($total_amount),
                                                'currency' => 'usd',
                                                'customer' => $customer_id,
                                                'payment_method' => $carddetails->id,
                                                'off_session' => true,
                                                'confirm' => true,
                                            ]);
                                            $status = 'success';
                                            $payment_intent_id = $pmtintent->id;
                                            $pmt_num = $pmt_num_person->adult + 1;
                                            $pmt_data = array( 'adult' =>  $pmt_num ,'child' => $pmt_num_person->child ,'infant' => $pmt_num_person->infant);
                                            $pmt_data = json_encode($pmt_data);
                                            UserBookingDetail::where('id',$details['id'])->update(['payment_number'=>$pmt_data ]);
                                        } catch (\Stripe\Exception\CardException $e) {
                                                 // Error code will be authentication_required if authentication is needed
                                                 // 'Error code is:' . $e->getError()->code;
                                                $payment_intent_id = $e->getError()->payment_intent->id;
                                                $pmt_num = $pmt_num_person->child; 
                                                $status = 'Fail';
                                        }

                                        $rec_pmt_data = [];
                                        $rec_pmt_data =[
                                            "user_id" => $data['user_id'],
                                            "pmt_number" =>  $pmt_num,
                                            "Amount" => $total_amount/100,
                                            "stripe_intent_id" => $payment_intent_id,
                                            "user_order_details_id" => $details['id'],
                                            "status" => $status,
                                            "person_type" => 'Adult',
                                        ];
                                        UserBookingRecurringPaymentDetails::create($rec_pmt_data); 
                                    } 
                                }  
                            } 

                            if( !empty($a->child) ){
                                $tot_price = 0;
                                $service_fee = 0;
                                $tax = 0;
                                $total_amount = 0;
                                $tot_price = $a->adult * @$pricedetails->recurring_recurring_pmt_child;
                                $service_fee= ($tot_price * @$service_fee1)/100;
                                $tax= ($tot_price * @$site_tax)/100;
                                $total_amount =(  $tot_price + $service_fee + $tax)*100;
                                if( $pmt_num_person->child < @$pricedetails->recurring_nuberofautopays_child){
                                    $today =date('Y-m-d');
                                    if($pmt_num_person->child == 1){
                                        $month =date('Y-m-d', strtotime($data['created_at']. '+1 month' ));
                                    }else{
                                        $recudata = UserBookingRecurringPaymentDetails::where(['user_order_details_id'=>$details['id'],'person_type'=>'Child'])->orderBy('created_at', 'desc')->first(); 
                                        $month =date('Y-m-d', strtotime($recudata['created_at']. '+1 month' ));
                                    }
                                  
                                    if($today == $month){
                                        try {
                                            $pmtintent = \Stripe\PaymentIntent::create([
                                                'amount' =>  round($total_amount),
                                                'currency' => 'usd',
                                                'customer' => $customer_id,
                                                'payment_method' => $carddetails->id,
                                                'off_session' => true,
                                                'confirm' => true,
                                            ]);
                                            $status = 'success';
                                            $payment_intent_id = $pmtintent->id;
                                            $pmt_num = $pmt_num_person->child + 1;
                                            $pmt_data = array( 'adult' =>  $pmt_num_person->adult ,'child' => $pmt_num ,'infant' => $pmt_num_person->infant);
                                            $pmt_data = json_encode($pmt_data);
                                            UserBookingDetail::where('id',$details['id'])->update(['payment_number'=>$pmt_data ]);
                                        } catch (\Stripe\Exception\CardException $e) {
                                                 // Error code will be authentication_required if authentication is needed
                                                 // 'Error code is:' . $e->getError()->code;
                                                $payment_intent_id = $e->getError()->payment_intent->id;
                                                $pmt_num = $details['payment_number']; 
                                                $status = 'Fail';
                                        }

                                        $rec_pmt_data = [];
                                        $rec_pmt_data =[
                                            "user_id" => $data['user_id'],
                                            "pmt_number" =>  $pmt_num,
                                            "Amount" => $total_amount/100,
                                            "stripe_intent_id" => $payment_intent_id,
                                            "user_order_details_id" => $details['id'],
                                            "status" => $status,
                                            "person_type" => 'Child',
                                        ];
                                        UserBookingRecurringPaymentDetails::create($rec_pmt_data); 
                                    } 
                                }  
                            }

                            if( !empty($a->infant) ){
                                $tot_price = 0;
                                $service_fee = 0;
                                $tax = 0;
                                $total_amount = 0;
                                $tot_price = $a->adult * @$pricedetails->recurring_recurring_pmt_infant;
                                $service_fee= ($tot_price * @$service_fee1)/100;
                                $tax= ($tot_price * @$site_tax)/100;
                                $total_amount =($tot_price + $service_fee + $tax)*100;
                                if( $pmt_num_person->infant < @$pricedetails->recurring_nuberofautopays_infant){
                                    $today =date('Y-m-d');
                                    if($pmt_num_person->infant == 1){
                                        $month =date('Y-m-d', strtotime($data['created_at']. '+1 month' ));
                                    }else{
                                        $recudata = UserBookingRecurringPaymentDetails::where(['user_order_details_id'=>$details['id'],'person_type'=>'Infant'])->orderBy('created_at', 'desc')->first(); 
                                        $month =date('Y-m-d', strtotime($recudata['created_at']. '+1 month' ));
                                    }
                                
                                    if($today == $month){
                                        try {
                                            $pmtintent = \Stripe\PaymentIntent::create([
                                                'amount' =>  round($total_amount),
                                                'currency' => 'usd',
                                                'customer' => $customer_id,
                                                'payment_method' => $carddetails->id,
                                                'off_session' => true,
                                                'confirm' => true,
                                            ]);
                                            $status = 'success';
                                            $payment_intent_id = $pmtintent->id;
                                            $pmt_num =$pmt_num_person->infant+ 1;
                                            $pmt_data = array( 'adult' =>   $pmt_num_person->adult ,'child' => $pmt_num_person->child ,'infant' =>$pmt_num);
                                            $pmt_data = json_encode($pmt_data);
                                            UserBookingDetail::where('id',$details['id'])->update(['payment_number'=>$pmt_data ]);
                                        } catch (\Stripe\Exception\CardException $e) {
                                                 // Error code will be authentication_required if authentication is needed
                                                 // 'Error code is:' . $e->getError()->code;
                                                $payment_intent_id = $e->getError()->payment_intent->id;
                                                $pmt_num = $details['payment_number']; 
                                                $status = 'Fail';
                                        }

                                        $rec_pmt_data = [];
                                        $rec_pmt_data =[
                                            "user_id" => $data['user_id'],
                                            "pmt_number" =>  $pmt_num,
                                            "Amount" => $total_amount/100,
                                            "stripe_intent_id" => $payment_intent_id,
                                            "user_order_details_id" => $details['id'],
                                            "status" => $status,
                                            "person_type" => 'Infant',
                                        ];
                                        UserBookingRecurringPaymentDetails::create($rec_pmt_data); 
                                    } 
                                }  
                            }  
                                        
                        }
                    }
                }
            }
        }

        $this->info('Successfully Payment done.');
    }
}
