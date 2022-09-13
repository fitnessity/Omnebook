<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discover extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'discover';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'title',
        'description'

    ];

     
}