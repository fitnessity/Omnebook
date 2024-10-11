<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessSubscriptionPlan extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'business_subscription_plan';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'item',
        'qty',
        'price',
        'service_fee',
        'grand_total'
    ];
    
}