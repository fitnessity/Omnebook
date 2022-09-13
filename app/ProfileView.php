<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileView extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profile_views';

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'user_id', 'ip',
    ];
}