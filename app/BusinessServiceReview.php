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

    protected $appends = ['business_id'];

    public function getBusinessIdAttribute(){
        return ($this->business_services_with_trashed ? $this->business_services_with_trashed->cid: '');
    }

    public function business_services(){
        return $this->belongsTo(BusinessServices::class, 'service_id');
    }

    public function business_services_with_trashed(){
        return $this->belongsTo(BusinessServices::class, 'service_id')->withTrashed();
    }

    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }

}
