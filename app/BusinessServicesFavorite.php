<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessServicesFavorite extends Model
{
    protected $table = 'business_services_favorite';
    protected $fillable = [
        'service_id','user_id'      
    ];

    protected $appends = ['reviews_avg'];

    public function getReviewsAvgAttribute(){
        $reviewsCount = BusinessServiceReview::where('service_id', $this->id)->count();
        $reviewsSum = BusinessServiceReview::where('service_id', $this->id)->sum('rating');
        return $reviewsCount > 0 ? round($reviewsSum/$reviewsCount,2) : 0;
    }
    public function BusinessServices(){
        return $this->belongsTo(BusinessServices::class, 'service_id');
    }
}
