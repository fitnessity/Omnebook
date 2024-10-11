<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessVerified extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'business_verified';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cid',
        'userid',
        'card_number',
        'card_name',
        'card_expiry',
        'card_cvv',
        'firstname',
        'lastname',
        'dob',
        'ssn',
        'phone',
        'email',
        'rights_summary',
        'ack_summary',
        'authorize_detail',
        'ack_authorize',
        'signature',
        'created'
    ];
}