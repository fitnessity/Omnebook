<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class PostReport extends Model
{
    protected $fillable = ['user_id','post_id','report_post'];   
}
