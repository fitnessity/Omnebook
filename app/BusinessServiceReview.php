<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessServiceReview extends Model
{
    //
	protected $table = 'business_service_review';

    public $timestamps = true;
	protected $fillable = [
        'service_id',
        'user_id',
        'rating',
        'review',
		'title',
		'images',
        'ip',
    ];
    
}
