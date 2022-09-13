<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessReview extends Model
{
    protected $table = 'business_review';

    public $timestamps = true;
	protected $fillable = [
        'page_id',
        'user_id',
        'rating',
        'review',
		'title',
		'images',
        'ip',
    ];
}
