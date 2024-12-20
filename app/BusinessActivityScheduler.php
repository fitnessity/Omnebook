<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use DateTime;

use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessActivityScheduler extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
     use SoftDeletes;
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
        'activity_days',
        'shift_start',
        'shift_end',
        'set_duration',
        'is_active',
        'end_activity_date',
        'instructure_ids',
    ];

    public function businessPriceDetailsAges(){
        return $this->belongsTo(BusinessPriceDetailsAges::class, 'category_id');
    }
    public function businessPriceDetailsAges_Cat(){
        return $this->belongsTo(BusinessPriceDetailsAges::class, 'category_id')
                    ->where('stype', 1);
    }
    

    public static function findById($id){
        return BusinessActivityScheduler::where('id',$id)->first();
    }

    public static function getallscheduler($datetime){
        return BusinessActivityScheduler::with(['business_service', 'company_information'])->orderBy('shift_start')->whereRaw("activity_days like ?", ['%'.$datetime->format('l').'%'])->whereDate('end_activity_date' ,'>=', $datetime->format("Y-m-d"));                               
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
         
        // echo $i;
    } 

    public static function next_8_hours($datetime){
        $start_datetime = $datetime;
        $end_datetime = clone($datetime);
        $end_datetime->modify("+10 hours");
        $business_activity_schedulers = BusinessActivityScheduler::with(['business_service', 'company_information'])->orderBy('shift_start')->whereRaw(" ? between `starting` and `end_activity_date`", [$end_datetime->format("y-m-d")]);

        if($start_datetime->format("Y-m-d") == $end_datetime->format("Y-m-d")){
            return $business_activity_schedulers->whereRaw("activity_days like ? and shift_start > ? and shift_start <= ?", ['%'.$start_datetime->format('l').'%', $start_datetime->format("H:i"), $end_datetime->format("H:i")]);
        }else{
            return $business_activity_schedulers->whereRaw("((activity_days like ? and shift_start > ?) or ((activity_days like ? and shift_start <= ?)))", ['%'.$start_datetime->format('l').'%', $start_datetime->format("H:i"), '%'.$end_datetime->format('l').'%', $end_datetime->format("H:i")]);
        }                                   
    }

    public static function allday($datetime){
        return BusinessActivityScheduler::with(['business_service', 'company_information'])->orderBy('shift_start')->whereRaw("activity_days like ? and shift_start > ? ", ['%'.$datetime->format('l').'%', $datetime->format("H:i")])->whereDate('end_activity_date' ,'>=', $datetime->format("Y-m-d"));                               
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

    public function activity_cancel()
    {
        return $this->hasMany(ActivityCancel::class, 'schedule_id');
    }

    public function activity_time(){
        $from = date("g:i A", strtotime($this->shift_start));
        $to = date("g:i A", strtotime($this->shift_end));
        return $from.' to '.$to;
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
        return intval($this->spots_available) - BookingCheckinDetails::where('business_activity_scheduler_id', $this->id)->whereDate('checkin_date', $current_time->format("Y-m-d"))->count();
    }


    public function chkReservedToday($date){
        return BookingCheckinDetails::where('business_activity_scheduler_id', $this->id)->whereDate('checkin_date', $date)->count();
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

    public static function alldayschedule($datetime,$chkval){
        if($chkval != ''){
            return BusinessActivityScheduler::with([ 'company_information'])
                        ->whereHas('business_service', function ($query) use ($chkval) {
                              $query->where('service_type',$chkval);
                        })->orderBy('shift_start')->whereDate('end_activity_date', '>=',  $datetime->format("Y-m-d") )->whereRaw("activity_days like ?", ['%'.$datetime->format('l').'%']);
        }else{
            return BusinessActivityScheduler::with(['business_service','company_information'])->orderBy('shift_start')->whereDate('starting', '<=',  $datetime->format("Y-m-d") )->whereDate('end_activity_date', '>=',  $datetime->format("Y-m-d") )->whereRaw("activity_days like ?", ['%'.$datetime->format('l').'%']);
        }
                                           
    }

    public function spots_reserved($current_time){
        return BookingCheckinDetails::where(['business_activity_scheduler_id' => $this->id ])->whereDate('checkin_date', '=', $current_time->format("Y-m-d"))->count();
    }
    public function businessPriceDetailsAges_n()
    {
        return $this->hasMany(BusinessPriceDetailsAges::class, 'cid', 'cid');
    }
    public function bookingCheckinDetails()
    {
        return $this->hasMany(BookingCheckinDetails::class, 'business_activity_scheduler_id', 'id');
    }
  
    public function spots_reserved_cat($current_time)
    {
        $query = BookingCheckinDetails::where('business_activity_scheduler_id', $this->id)
            ->whereDate('checkin_date', '=', $current_time->format("Y-m-d"))
            ->whereHas('businessActivityScheduler', function($query) {
                $query->whereHas('businessPriceDetailsAges_n', function($query) {
                    $query->where('stype', 1);
                });
            });

        return $query->count();
    }

    public function getcanceldata($date,$sid){
        $activity_cancel = ActivityCancel::where('cancel_date', $date->format("Y-m-d"))->where('schedule_id',$sid)->first();

        return @$activity_cancel->act_cancel_chk;
    }

    public function get_duration() {
        $string = "";
        $duration = date_parse(" +".$this->set_duration);
        if($duration['relative']){
            foreach($duration['relative'] as $key => $value){
                if($value > 0){
                    if($key == 'hour'){
                        $key = 'hr';
                    }

                    if($key == 'minute'){
                        $key = 'Min';
                    }

                    if($key == 'second'){
                        $key = 'Sec';
                    }
                    $string .= " ".$value." ".$key;
                }
            }
        }

        return trim($string);
    }

    public function getInstructure($date){
        $name = '';
        $checkInData = BookingCheckinDetails::where('business_activity_scheduler_id' ,$this->id)->whereDate('checkin_date',$date)->first();
        $ids = @$checkInData->instructor_id ?? $this->instructure_ids;
        if($ids){
            foreach(explode(',',$ids) as $id){
                $staff = BusinessStaff::find($id);
                if($staff){
                    $name .= $staff->full_name.', ';
                }
            }
        }

        $name = rtrim($name, ', ');
        return $name;
    }

    public function getInstructureIds($date){
        $name = '';
        $checkInData = BookingCheckinDetails::where('business_activity_scheduler_id' ,$this->id)->whereDate('checkin_date',$date)->first();
        return @$checkInData->instructor_id ?? $this->instructure_ids;
    }


    public function getInsdata(){
        $staffData = [];
        if($this->instructure_ids){
            foreach(explode(',',$this->instructure_ids) as $id){
                $staff = BusinessStaff::find($id);
                if($staff){
                    $staffData [] = $staff;
                }
            }
        }

        return $staffData;
    }


}