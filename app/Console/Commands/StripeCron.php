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
        $pmtdata = UserBookingStatus::where('pmt_type',1)->get();
        /*print_r($pmtdata);exit();*/
        if(!empty($pmtdata)){
            foreach($pmtdata as $data){
            /* echo $data['user_id'];*/
                $userdata = User::where('id',$data['user_id'])->first();
                /*echo $userdata;exit();*/
                if($userdata != ''){
                    $customer_id  = $userdata->stripe_customer_id;
                    \Stripe\Stripe::setApiKey('sk_test_51GXC9CCr65ASmcsqbvTge3Hdt6KPsivcPrxGR2jnZVVWRGz2CJgPJoQnHQcZb2k5c7fHZOD29xrla42CPpEmVRvn00V4id4eab');
                    $stripe = new \Stripe\StripeClient('sk_test_51GXC9CCr65ASmcsqbvTge3Hdt6KPsivcPrxGR2jnZVVWRGz2CJgPJoQnHQcZb2k5c7fHZOD29xrla42CPpEmVRvn00V4id4eab');
                    $carddetails = $stripe->customers->createSource(
                         $customer_id,
                        ['source' => 'tok_visa']
                    );
                    $bookdetails = UserBookingDetail::where('booking_id',$data['id'])->get();
                    foreach($bookdetails as $details){
                        $pricedetails =  BusinessPriceDetails::where('id',$details['priceid'])->first();
                        $service_fee= ($pricedetails->recurring_recurring_pmt_adult * 7)/100;
                        $tax= ($pricedetails->recurring_recurring_pmt_adult * 8.875)/100;
                        $total_amount =($pricedetails->recurring_recurring_pmt_adult + $service_fee + $tax)*100;
                        if( $details['payment_number'] < $pricedetails->recurring_nuberofautopays_adult){
                            $today =date('Y-m-d');
                            if( $details['payment_number'] == 1){
                                $month =date('Y-m-d', strtotime($data['created_at']. '+1 month' ));
                            }else{
                                $recudata = UserBookingRecurringPaymentDetails::where('user_order_details_id',$details['id'])->orderBy('created_at', 'desc')->first(); 
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
                                    $pmt_num = $details['payment_number'] + 1;
                                    UserBookingDetail::where('id',$details['id'])->update(['payment_number'=>$pmt_num]);
                                } catch (\Stripe\Exception\CardException $e) {
                                         // Error code will be authentication_required if authentication is needed
                                        /* 'Error code is:' . $e->getError()->code;*/
                                        $payment_intent_id = $e->getError()->payment_intent->id;
                                        $pmt_num = $details['payment_number']; 
                                        $status = 'Fail';
                                }

                                $rec_pmt_data = [];
                                $rec_pmt_data =[
                                    "user_id" => $data['user_id'],
                                    "pmt_number" =>  $pmt_num,
                                    "Amount" => $total_amount,
                                    "stripe_intent_id" => $payment_intent_id,
                                    "user_order_details_id" => $details['id'],
                                    "status" => $status,
                                ];
                                UserBookingRecurringPaymentDetails::create($rec_pmt_data); 
                            } 
                        }                      
                    }
                }
            }
        }

        $this->info('Successfully Payment done.');
    }
}
