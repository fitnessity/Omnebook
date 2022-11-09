<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ProfilePostViews extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profile_post_views';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'user_id',
    ];
    
}