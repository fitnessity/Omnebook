<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookactivity extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bookactivity';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'image'
    ];

     
}