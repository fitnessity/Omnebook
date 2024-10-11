<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChkAttendance extends Model
{
	protected $table = 'chk_attendance';
  	public $timestamps = false;
	protected $fillable = [
        'you_mean_the','time','customer', 'price_option'
    ];
}

?>