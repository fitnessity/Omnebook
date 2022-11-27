<?php

namespace App;



use App\User;

use Illuminate\Database\Eloquent\Model;



class UserBookingDetail extends Model

{

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    public $timestamps = false;
    protected $table = 'user_booking_details';
	protected $fillable = [
        'booking_id', 'sport', 'booking_detail','zipcode','quote_by_text','quote_by_email','note','schedule','act_schedule_id','priceid',
		'price','qty', 'bookedtime','payment_number','participate','provider_amount','provider_transaction_id','provider_transaction_id'
    ];


    /**

     * Get the user that owns the education.

     */

    public function UserBookingStatus()

    {

     	//return $this->belongsTo(UserBookingStatus::class, 'booking_id');
		return $this->belongsToMany(UserBookingStatus::class, 'booking_id'); ///nnn 22-10-2022
    }


    public function booking(){

        return $this->belongsTo(UserBookingStatus::class, 'booking_id');

    }

    public function business_services(){

        return $this->belongsTo(BusinessServices::class, 'sport');

    }

    public function provider_get_total(){
        return $this->total() - $this->platform_total();
    }

    public function total(){
        $total = 0.0;
        $price = json_decode($this->price);
        $qty = json_decode($this->qty);
        foreach(['adult', 'child', 'infant'] as $key){
            $total += ($price->$key * $qty->$key);
        }

        return $total;
    }

    public function platform_total(){
        $fitnessity_fee = BusinessSubscriptionPlan::where('id',1)->first()->fitnessity_fee;


        return round(($this->total() * $fitnessity_fee)/100, 2);
    }

    public function transfer_to_provider(){
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));

        $company_information = $this->business_services->company_information;

        try {
            $transfer_amount = $this->provider_get_total();
            $stripe_account  = $stripe->accounts->retrieveCapability(
                $company_information->stripe_connect_id,
                'transfers',
                []
            );

            $payment_intent = $stripe->paymentIntents->retrieve(
                $this->booking->stripe_id,
                []
            );

            if($stripe_account['status'] == 'active'){
                    
                $transfer = $stripe->transfers->create([
                    'amount' => $transfer_amount * 100,
                    'currency' => 'usd',
                    'source_transaction' => $payment_intent->charges->data[0]->id,
                    'destination' => $company_information->stripe_connect_id,
                ]);

                if($transfer->id){
                    $this->update(['transfer_provider_status'=>'paid', 
                                   'provider_amount' => $transfer_amount ,
                                   'provider_transaction_id' => $transfer->id]);
                }

            }
            

        } catch(Exception $e) {
        }    
    }

}

