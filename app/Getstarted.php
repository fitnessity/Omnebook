<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Getstarted extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'getstarted';

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