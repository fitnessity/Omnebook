<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BusinessServiceReview extends Model
{
    //
	protected $table = 'business_service_review';

    public $timestamps = true;
	protected $fillable = [
        'service_id',
        'user_id',
        'rating',
        'name',
        'review',
		'title',
		'images',
        'cleanliness',
        'accuracy',
        'checkin',
        'communication',
        'customer_service',
        'location',
        'value',
        'message',
    ];

    protected $appends = ['business_id' ,'date' ,'all_over_review'];


    public function getAllOverReviewAttribute(){
        $reCnt = 0;
        $reviewTypes = ['cleanliness','accuracy','checkin','communication','customer_service','location','value'];

        foreach ($reviewTypes as $type) {
            $reCnt += $this->$type;
        }
        
        if($reCnt > 0){
            return round($reCnt / 7 ,1);
        }
        return 0;
    }

    public function getBusinessIdAttribute(){
        return ($this->business_services_with_trashed ? $this->business_services_with_trashed->cid: '');
    }

    public function getDateAttribute(){
       $date = Carbon::parse($this->created_at);
       return $date->format('F Y');
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
