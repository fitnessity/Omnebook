<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessServicesMap extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'business_services_map';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cid',
        'userid'
    ];

}