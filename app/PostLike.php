<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PostLike extends Model
{
    protected $fillable = ['user_id','post_id','is_like'];   
}
