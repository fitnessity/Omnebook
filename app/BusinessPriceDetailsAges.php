<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessPriceDetailsAges extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'business_price_details_ages';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'category_title',
        'userid',
        'cid',
        'serviceid',
    ];
    
    public function BusinessActivityScheduler()
    {
        return $this->hasMany(BusinessActivityScheduler::class ,'category_id');
    }
}