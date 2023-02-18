<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // public $timestamps = false;
    protected $table = 'transaction';
	
	protected $fillable = [
        'user_type', 'user_id', 'item_type','item_id', 'channel','kind','transaction_id','amount','qty','status','refund_amount',
		'payload'
    ];

    /**
     * Get the user that owns the task.
     */

    public function getPmtMethod(){
        $pmt_by = $this->kind;
        if($pmt_by == 'card'){
            $stripe = new \Stripe\StripeClient(
                config('constants.STRIPE_KEY')
            );

            $last4 = '';
            $pmt_type = '';
            $stripe_id = $this->transaction_id;
            $payment_intent = $stripe->paymentIntents->retrieve(
                $stripe_id,
                []
            );

            $cardData = $payment_intent['charges']['data'][0]['payment_method_details']['card'];
            $last4 =  $cardData['last4'];
            $brand = $cardData['brand'];
            return $brand.' ****'.$last4;
        }else{
            return $pmt_by;
        }
    }
}