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
        'stype',
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
    

    public static function getCategoriesByServiceAndType($serviceId, $serviceType)
    {
        return self::where('serviceid', $serviceId)
                ->where('class_type', $serviceType)
                ->get();
    }
    public function BusinessActivityScheduler()
    {
        return $this->hasMany(BusinessActivityScheduler::class ,'category_id') ->whereNull('deleted_at')->orderBy('shift_start');
    }
    public function BusinessClassNPriceDetails()
    {
        return $this->hasMany(BusinessClassPriceDetails::class ,'class_id')->whereNull('deleted_at');
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
        return $this->hasMany(BusinessPriceDetails::class, 'category_id')->whereNull('deleted_at');
    }
    
    public function BusinessPriceDetailsData(){
        return $this->hasMany(BusinessPriceDetails::class, 'category_id')->whereNull('deleted_at');
    }
    

    public function AddOnService(){
        return $this->hasMany(AddOnService::class, 'category_id');
    }

    public function businessClassPriceDetails(){
        return $this->hasMany(BusinessClassPriceDetails::class, 'class_id')->whereNull('deleted_at');
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

    public function class_detail() {
        $class = BusinessClassPriceDetails::where('class_id', $this->id)->whereNull('deleted_at')->first();    
        if (!$class) {
            return 0; 
        }
    
        $price_detail = BusinessPriceDetails::where('serviceid', $this->serviceid)
                            ->where('id', $class->price_id)
                            ->where('cid', $this->cid)->whereNull('deleted_at')->first();
            if ($price_detail) {
            if (date('l') == 'Saturday' || date('l') == 'Sunday') {
                if (intval($price_detail['adult_weekend_price_diff']) > 0)
                    return $price_detail['adult_weekend_price_diff'];
                if (intval($price_detail['child_cus_weekend_price']) > 0)
                    return $price_detail['child_cus_weekend_price'];
                if (intval($price_detail['infant_cus_weekend_price']) > 0)
                    return $price_detail['infant_cus_weekend_price'];
            } else {
                if (intval($price_detail['adult_cus_weekly_price']) > 0)
                    return $price_detail['adult_cus_weekly_price'];
                if (intval($price_detail['child_cus_weekly_price']) > 0)
                    return $price_detail['child_cus_weekly_price'];
                if (intval($price_detail['infant_cus_weekly_price']) > 0)
                    return $price_detail['infant_cus_weekly_price'];
            }
        } 
    }
    public function getClassNames()
    {
        $instructorIds = explode(',', $this->id);
        $instructors = BusinessPriceDetailsAges::whereIn('id', $instructorIds)
            ->get()
            ->map(function($instructor) {
                return $instructor->class_type;
            })
            ->toArray();
            
        return implode(', ', $instructors);
    }

}