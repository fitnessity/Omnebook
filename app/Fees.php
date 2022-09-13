<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fees extends Model
{
    //
	protected $table = 'fees';
	 protected $fillable = [
        'verification_fees',
        'service_fees',
        'tax',
        
    ];
}
