<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
   // protected $dateFormat = 'Y-m-dTH:i:s';
    Protected $fillable = [
    'uuid',
    'meeting_id',
    'user_id',
    'host_id',
    'topic',
    'type',
    'status',
    'start_time',
    'duration',
    'mytimezone',
    'created_at',
    'start_url',
    'join_url',
    'password',
    'encrypted_password',
    'settings'
    ];
}
