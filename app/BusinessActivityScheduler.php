<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessActivityScheduler extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'business_activity_scheduler';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userid',
        'cid',
        'serviceid',
        'category_id',
        'activity_meets',
        'scheduled_day_or_week_num',
        'scheduled_day_or_week',
        'spots_available',
        'starting',
        'schedule_until',
        'sales_tax',
        'sales_tax_percent',
        'dues_tax',
        'dues_tax_percent',
        'activity_days',
        'shift_start',
        'shift_end',
        'set_duration',
        'is_active',
        'end_activity_date'
    ];
    
    public function business_service()
    {
        return $this->belongsTo(BusinessServices::class, 'serviceid');
    }

    public function get_clean_duration() {
        $string = "";
        $duration = date_parse(" +".$this->set_duration);

        if($duration['relative']){
            foreach($duration['relative'] as $key => $value){
                if($value > 0){
                    $string .= " ".$value." ".$key;
                }
            }
        }

        return trim($string);
    }

    public function price_detail() {
        $price_details = BusinessPriceDetails::where('serviceid', $this->serviceid)
                            ->where('category_id', $this->category_id)
                            ->where('cid', $this->cid)->first();

        if($price_details){
            if(date('l') == 'Saturday' || date('l') == 'Sunday'){
                return $price_details['adult_weekend_price_diff'];
            }else{
                return $price_details['adult_cus_weekly_price'];
            }
        }        
            

    }
}