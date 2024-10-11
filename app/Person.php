<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'person';

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