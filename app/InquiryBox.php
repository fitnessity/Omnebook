<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InquiryBox extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inquiry_box';

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'name', 'email', 'message'
    ];
}