<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessInformation extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'business_informations';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cid',
        'user_id',
        'company_name',
        'city',
        'state',
        'zip_code',
        'address',
        'country',
        'ein_number',
        'establishment_year',
        'latitude',
        'longitude'
    ];

     
}