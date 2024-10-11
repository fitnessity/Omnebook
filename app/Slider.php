<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'slider';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'image',
        'title',
        'heading',
        'stext',
        'link'
    ];

     
}