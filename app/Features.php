<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Features extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'features';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

     
}