<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class BusinessPostViews extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'business_post_views';

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