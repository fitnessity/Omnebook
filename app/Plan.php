<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'membership_plans';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'price_per_month',
        'quote_per_month',
        'is_deleted'
    ];

     
}