<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessCompanyDetail extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'business_companydetail';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cid',
        'userid',
        'Companyname',
        'Address',
        'City',
        'State',
        'ZipCode',
        'Country',
        'EINnumber',
        'Establishmentyear',
        'Businessusername',
        'Profilepic',
        'Firstnameb',
        'Lastnameb',
        'Emailb',
        'Phonenumber',
        'Aboutcompany',
        'Shortdescription',
        'showstep'
    ];

     
}