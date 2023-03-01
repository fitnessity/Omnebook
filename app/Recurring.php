<?php

namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use File;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;

use Illuminate\Database\Eloquent\SoftDeletes;

class Recurring extends Authenticatable
{

	 //use SoftDeletes;
    protected $table = 'recurring';

    public $timestamps = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'booking_detail_id', 'user_id', 'user_type', 'business_id', 'payment_date', 'amount', 'tax', 'charged_amount', 'payment_method', 'stripe_payment_id', 'status'];


    public function company_information(){
        return $this->belongsTo(CompanyInformation::class, 'business_id');
    }

    public function UserBookingDetail(){
        return $this->belongsTo(UserBookingDetails::class, 'business_id');
    }

    public static function autoPayRemaining($totalCount,$id){
        $paymentDoneCount = Recurring::where('booking_detail_id',$id)->where('stripe_payment_id' ,'!=' , '')->where('user_type','customer')->count();
        $remaining = $totalCount - $paymentDoneCount;
        return $remaining;
    }


    public function getStripeCard(){
        $stripe = new \Stripe\StripeClient(
            config('constants.STRIPE_KEY')
        );

        $last4 = '';
        $card_id = '';
        $brand = '';
        $stripe_id = $this->stripe_payment_id;
        $payment_method = $this->payment_method;
        if($stripe_id != '' && $payment_method == 'card'){
            try{
                $payment_intent = $stripe->paymentIntents->retrieve(
                    $stripe_id,
                    []
                );
                $last4 = $payment_intent['charges']['data'][0]['payment_method_details']['card']['last4'];
                $brand = $payment_intent['charges']['data'][0]['payment_method_details']['card']['brand'];

                $card_id =  $brand.'  XXXX'.$last4;
                  echo $card_id;exit;
            }catch(\Stripe\Exception\CardException $e) {
            }catch(Exception $e){
            }
        }

        return $card_id;
    }


    public function createRecurringPayment(){
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));

        if($this->user_type == 'user'){
            $customer = User::findOrFail($this->user_id);
            $stripe_customer_id = $user->stripe_customer_id;
            $carddetails = DB::table('users_payment_info')->where('user_id', $customer->id)->latest()->first();
            $card_id = $carddetails->card_stripe_id;
        }else{
            $customer = Customer::findOrFail($this->user_id); 
            $stripe_customer_id = $customer->stripe_customer_id;  
        }

        if($stripe_customer_id != '') {
            $stripe_customer_id = $customer->create_stripe_customer_id();
        }

        if($this->user_type == 'customer'){
            $carddetails = $stripe->customers->retrieveSource(
                $stripe_customer_id,
                $request->cardinfo,
                []
            );
            $card_id = $carddetails->id;
        }

        try {
            $totalprice = $this->amount + $this->tax;
            $pmtintent = \Stripe\PaymentIntent::create([
                'amount' =>  $totalprice *100,
                'currency' => 'usd',
                'customer' => $$stripe_customer_id,
                'payment_method' => $card_id,
                'off_session' => true,
                'confirm' => true,
            ]);

            $this->stripe_payment_id = $pmtintent->id;
            $this->charged_amount = $totalprice;
            $this->payment_method = 'card';
            $this->status = 'Completed';
            $this->save();
        }catch(\Stripe\Exception\CardException $e) {
        }catch (Exception $e) {
        }
    }

}