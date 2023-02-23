<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StripePaymentMethod extends Model
{
    
    public $timestamps = true;
    //
    protected $fillable = [
        'user_type',
        'user_id',
        'pay_type',
        'payment_id',
        'exp_month',
        'exp_year',
        'last4',
        'primary',
    ];

    public static function boot(){
        parent::boot();

        static::deleting(function($model) {
            $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));
            $stripe->paymentMethods->detach($model->payment_id,[]);
        });
    }
    
}
