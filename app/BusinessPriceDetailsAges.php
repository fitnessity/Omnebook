<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessPriceDetailsAges extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    use SoftDeletes;
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
        'dues_tax',
        'sales_tax',
    ];
    
    public function BusinessActivityScheduler()
    {
        return $this->hasMany(BusinessActivityScheduler::class ,'category_id');
    }
}