<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileSave extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string     */

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profile_id','user_id'      
    ];

     
}