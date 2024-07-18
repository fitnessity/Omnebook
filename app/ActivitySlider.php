<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class ActivitySlider extends Model
{
    public $timestamps = false;
	protected $table='activity_slider';
	protected $guarded = [];  
}
