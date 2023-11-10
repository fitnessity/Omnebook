<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cISessions extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ci_sessions';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip_address',
        'user_agent',
        'last_activity',
        'user_data',
        'business_id',
        'lname',
        'fname',
        'address',
        'city',
        'state',
        'zipcode',
        'country',
        'phone_number',
        'email',
        'status',
    ];

     
}