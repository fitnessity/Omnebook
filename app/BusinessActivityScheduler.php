<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use DateTime;

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


    public static function findById($id){
        return BusinessActivityScheduler::where('id',$id)->first();
    }

    public function next_available_date(){
        $start = new DateTime($this->starting);
        $end = new DateTime($this->end_activity_date);

        $current_date = new DateTime();
        if($current_date > $start && $current_date < $end){
            for($i = $current_date; $i <= $end; $i->modify('+1 day')){
                if(str_contains($this->activity_days, $i->format("l"))){
                    return $i;
                }
            }
        }elseif($start > $current_date){
            for($i = $start; $i <= $end; $i->modify('+1 day')){
                if(str_contains($this->activity_days, $i->format("l"))){
                    return $i;
                }
            }
        }else{
            return null;
        }
    } 

    public static function next_8_hours($datetime){
        $start_datetime = $datetime;
        $end_datetime = clone($datetime);
        $end_datetime->modify("+10 hours");
        $business_activity_schedulers = BusinessActivityScheduler::with(['business_service', 'company_information'])->orderBy('shift_start')->whereRaw(" ? between `starting` and `end_activity_date`", [$end_datetime->format("y-m-d")]);

        if($start_datetime->format("Y-m-d") == $end_datetime->format("Y-m-d")){
            return $business_activity_schedulers->whereRaw("activity_days like ? and shift_start > ? and shift_start <= ?", ['%'.$start_datetime->format('l').'%', $start_datetime->format("H:i"), $end_datetime->format("H:i")]);
        }else{
            return $business_activity_schedulers->whereRaw("(activity_days like ? and shift_start > ?) or ((activity_days like ? and shift_start <= ?))", ['%'.$start_datetime->format('l').'%', $start_datetime->format("H:i"), '%'.$end_datetime->format('l').'%', $end_datetime->format("H:i")]);
        }
                                       
    }

    public static function allday($datetime){
        return BusinessActivityScheduler::with(['business_service', 'company_information'])->orderBy('shift_start')->whereRaw("activity_days like ? and shift_start > ? ", ['%'.$datetime->format('l').'%', $datetime->format("H:i")]);                               
    }
    
    public function business_service()
    {
        return $this->belongsTo(BusinessServices::class, 'serviceid');
    }

    public function company_information(){
        return $this->belongsTo(CompanyInformation::class, 'cid');
    }

    public function booking_details()
    {
        return $this->hasMany(UserBookingDetail::class, 'act_schedule_id');
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

    public function get_duration_hours() {
        $string = "";
        $duration = date_parse(" +".$this->set_duration);
        if($duration['relative']){
            if($duration['relative']['hour'])
                return $duration['relative']['hour']." ".Str::plural('hour', $duration['relative']['hour']);

            if($duration['relative']['minute'])
                return $duration['relative']['minute']." ".Str::plural('minute', $duration['relative']['minute']);
        }
        return trim($string);
    }

    public function time_left($current_datetime){
        $datetime1 = $current_datetime;
        $datetime2 = new DateTime($current_datetime->format("Y-m-d ").$this->shift_start);
        if($datetime2 < $datetime1){
            $datetime2->modify("+1 day");
        }
        return $datetime2->diff($datetime1);
    }

    public function time_left_seconds($current_datetime){
        $datetime1 = $current_datetime;
        $datetime2 = new DateTime($current_datetime->format("Y-m-d ").$this->shift_start);
        if($datetime2 < $datetime1){
            $datetime2->modify("+1 day");
        }
        return $datetime2->getTimestamp() - $datetime1->getTimestamp();
    }

    public function is_start_in_one_hour($current_datetime) {
        if(intval($this->time_left_seconds($current_datetime)) < 3600){
            return true;
        }
        return false;
    }

    public function spots_left($current_time){
        $user_booking_details = UserBookingDetail::where('act_schedule_id', $this->id)->whereDate('bookedtime', '=', $current_time->format("Y-m-d"))->get();

        $totalquantity = 0;
        foreach($user_booking_details as $user_booking_detail){
            $item = json_decode($user_booking_detail['qty'],true);
            if($item['adult'] != '')
                $totalquantity += $item['adult'];
            if($item['child'] != '')
                $totalquantity += $item['child'];
            if($item['infant'] != '')
                $totalquantity += $item['infant'];
        }
        return intval($this->spots_available) - $totalquantity;
    }

    public function price_detail() {
        $price_detail = BusinessPriceDetails::where('serviceid', $this->serviceid)
                            ->where('category_id', $this->category_id)
                            ->where('cid', $this->cid)->first();           
        if($price_detail){
            if(date('l') == 'Saturday' || date('l') == 'Sunday'){
                if(intval($price_detail['adult_weekend_price_diff']) > 0)
                    return $price_detail['adult_weekend_price_diff'];
                if(intval($price_detail['child_cus_weekend_price']) > 0)
                    return $price_detail['child_cus_weekend_price'];
                if(intval($price_detail['infant_cus_weekend_price']) > 0)
                    return $price_detail['infant_cus_weekend_price'];
            }else{
                if(intval($price_detail['adult_cus_weekly_price']) > 0)
                    return $price_detail['adult_cus_weekly_price'];
                if(intval($price_detail['child_cus_weekly_price']) > 0)
                    return $price_detail['child_cus_weekly_price'];
                if(intval($price_detail['infant_cus_weekly_price']) > 0)
                    return $price_detail['infant_cus_weekly_price'];
            }
        }           
    }

    public static function alldayschedule($datetime){
        return BusinessActivityScheduler::with(['business_service', 'company_information'])->orderBy('shift_start')->whereDate('end_activity_date', '>=',  $datetime->format("Y-m-d") )->whereRaw("activity_days like ?", ['%'.$datetime->format('l').'%']);                                   
    }

    public function spots_reserved($current_time){
        $user_booking_details = UserBookingDetail::where('act_schedule_id', $this->id)->whereDate('bookedtime', '=', $current_time->format("Y-m-d"))->get();

        $totalquantity = 0;
        foreach($user_booking_details as $user_booking_detail){
            $item = json_decode($user_booking_detail['qty'],true);
            if($item['adult'] != '')
                $totalquantity += $item['adult'];
            if($item['child'] != '')
                $totalquantity += $item['child'];
            if($item['infant'] != '')
                $totalquantity += $item['infant'];
        }
        return $totalquantity;
    }
}