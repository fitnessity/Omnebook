<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class AddressCountry extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'addr_countries';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


}
