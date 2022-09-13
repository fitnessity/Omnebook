<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notification';
    protected $fillable = [
        'user_id','sender_id','type','notification_type','status','created_at','updated_at'   
    ];
}
