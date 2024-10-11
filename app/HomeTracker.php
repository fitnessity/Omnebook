<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeTracker extends Model
{
    //
	protected $table = 'home_tracker';
	 protected $fillable = [
        'trainers',
        'locations',
        'activities',
        'businesses',
        'bookings',
    ];
}
