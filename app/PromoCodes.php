<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromoCodes extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'promo_codes';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

     
}