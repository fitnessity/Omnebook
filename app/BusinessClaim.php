<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessClaim extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'business_claims';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_name',
        'phone',
        'activity',
        'location',
        'address',
        'website',
    ];

     
}