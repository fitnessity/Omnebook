<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Http\Request;
use Config;
use App\User;
use App\UserBookingDetail;
use App\BusinessPriceDetails;
use App\UserBookingStatus;
use App\BusinessSubscriptionPlan;
use App\BusinessServices;

class ProviderTransferCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'providertransfer:cron';

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
        $fitnessity_fee= 0;
        $bspdata = BusinessSubscriptionPlan::where('id',1)->first();
        $fitnessity_fee = $bspdata->fitnessity_fee;
        \Stripe\Stripe::setApiKey($stripekey);
       
        $bookdetails = UserBookingDetail::where('transfer_provider_status','unpaid')->get();
        //print_r($bookdetails);exit;
        if(!empty($bookdetails)){
            foreach($bookdetails as $details){
                $stripe = new \Stripe\StripeClient($stripekey);
                $transfer_amt_to_bususer = 0;
                $tot_pri = 0;
                $per_act_trns_amt_to_admin =0;
                $tot_fee_adu =0;
                $tot_fee_child =0;
                $tot_fee_infant =0;
                $a = json_decode($details['qty']);
                $price = json_decode($details['price']);
                if( !empty($a->adult) ){
                    $aduqnt = $a->adult;
                    $aduprice =  $price->adult;
                    $tot_fee_adu =  ($aduprice * $fitnessity_fee) / 100;
                    $per_act_trns_amt_to_admin +=  $tot_fee_adu * $aduqnt ;
                    $tot_pri +=   $aduqnt * $aduprice ;
                }

                if( !empty($a->child) ){
                    $childqnt = $a->child;
                    $childprice =  $price->child;
                    $tot_fee_child =  ($childprice * $fitnessity_fee) / 100;
                    $per_act_trns_amt_to_admin +=  $tot_fee_child * $childqnt ;
                    $tot_pri +=   $childqnt * $childprice ;
                }
                if( !empty($a->infant) ){
                    $infantqnt = $a->infant;
                    $infantprice =  $price->infant;
                    $tot_fee_infant =  ($infantprice * $fitnessity_fee) / 100;
                    $per_act_trns_amt_to_admin +=  $tot_fee_infant * $infantqnt ;
                    $tot_pri +=   $infantqnt * $infantprice ;
                }

                $transfer_amt_to_bususer = $tot_pri - $per_act_trns_amt_to_admin ;

                $bookstatusdata = UserBookingStatus::where('id',$details->booking_id)->orderBy('id' ,'desc')->first();
                $bus_service = BusinessServices::where('id',$details['sport'])->first();
                $bus_user = User::where('id', $bus_service->userid)->first();
                if($bus_user->stripe_connect_id != ''){
                    $accountcap  = $stripe->accounts->retrieveCapability(
                        $bus_user->stripe_connect_id,
                        'transfers',
                        []
                    );
                    if($accountcap['status'] == 'active'){
                        // Create a Transfer to a connected account (later):
                        try {

                            $transfer =  $stripe->transfers->create([
                                'amount' => $transfer_amt_to_bususer * 100,
                                'currency' => 'usd',
                                'source_transaction' => $payment_intent->charges->data[0]->id,
                                'destination' => $bus_user->stripe_connect_id,
                            ]);

                            if(@$transfer->id != '')
                            {  
                                UserBookingDetail::where('id',$status->id)->update(['transfer_provider_status'=>'paid', 'provider_amount' => $transfer_amt_to_bususer ,'provider_transaction_id' =>$transfer->id ]);
                            }
                        } catch (\Stripe\Exception\CardException $e) {
                            UserBookingDetail::where('id',$status->id)->update(['transfer_provider_status'=>'unpaid']);
                        }    
                    }else{
                        $update =  $stripe->accounts->update(
                            $bus_user->stripe_connect_id,
                            [
                                'capabilities' => [
                                  'card_payments' => ['requested' => true],
                                  'transfers' => ['requested' => true],
                                ],
                            ]
                        );
                    }
                }
            }
        }
    }
}
