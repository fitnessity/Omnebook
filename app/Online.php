<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Online extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'online';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'heading',
        'title',
        'image',
        'duration',
        'level',
        'timings',
        'price'
    ];

     
}