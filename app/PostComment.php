<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    protected $fillable = ['user_id','post_id','comment'];   
}
