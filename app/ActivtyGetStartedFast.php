<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivtyGetStartedFast extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'activity_Get_Started_Fast';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'title',
        'small_text',
        '_token'
    ];

     
}