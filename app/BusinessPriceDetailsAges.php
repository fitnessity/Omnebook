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
        'service_name',
        'service_price',
        'service_description',
        'visibility_to_public',
        'class_type',
        'desc',
    ];

    public static function boot(){
        parent::boot();
        static::deleting(function($class) {
            $class->businessClassPriceDetails->each(function($price) {
                $price->delete();
            });

            $class->BusinessActivityScheduler->each(function($schedule) {
                $schedule->delete();
            });
        });
    }
    
    
    public function BusinessActivityScheduler()
    {
        return $this->hasMany(BusinessActivityScheduler::class ,'category_id')->orderBy('shift_start');
    }

    public function BusinessActivitySchedulerWithThresould()
    {
        return $this->hasMany(BusinessActivityScheduler::class ,'category_id')->withTrashed()->orderBy('shift_start');
    }

    public function BusinessServices()
    {
        return $this->belongsTo(BusinessServices::class ,'serviceid');
    }

    public function BusinessPriceDetails(){
        return $this->hasMany(BusinessPriceDetails::class, 'category_id');
    }

    public function AddOnService(){
        return $this->hasMany(AddOnService::class, 'category_id');
    }

    public function businessClassPriceDetails(){
        return $this->hasMany(BusinessClassPriceDetails::class, 'class_id');
    }


    public function bPriceDetails()
    {
        return $this->hasManyThrough(
            BusinessPriceDetails::class,
            BusinessClassPriceDetails::class,
            'class_id', // Foreign key on BusinessClassPriceDetails table...
            'id', // Foreign key on BusinessPriceDetails table...
            'id', // Local key on BusinessPriceDetailsAges table...
            'price_id' // Local key on BusinessClassPriceDetails table...
        );
    }
}