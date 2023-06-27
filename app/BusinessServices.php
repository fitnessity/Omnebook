<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessServices extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
     use SoftDeletes;
    protected $table = 'business_services';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cid',
        'userid',
        'serviceid',
        'service_type',
        'sport_activity',
        'program_name',
        'program_desc',
        'profile_pic',
        'instant_booking',
        'request_booking',
        'frm_min_participate',
        'beforetimeint',
        'beforetime',
        'notice_value',
        'notice_key',
        'advance_value',
        'advance_key',
        'activity_value',
        'activity_key',
        'cancel_value',
        'cancel_key',
        'willing_to_travel',
        'miles',
		'area',
        'select_service_type',
        'activity_location',
        'activity_for',
        'age_range',
        'group_size',
        'difficult_level',
        'activity_experience',
        'instructor_habit',
        'activity_meets',
        'starting',
        'schedule_until',
        'sales_tax',
		'sales_tax_percent',
        'dues_tax',
		'dues_tax_percent',
		'mon_shift_start',
		'mon_shift_end',
		'tue_shift_start',
		'tue_shift_end',
		'wed_shift_start',
		'wed_shift_end',
		'thu_shift_start',
		'thu_shift_end',
		'fri_shift_start',
		'fri_shift_end',
		'sat_shift_start',
		'sat_shift_end',
		'sun_shift_start',
		'sun_shift_end',
		'mon_duration',
		'tue_duration',
		'wed_duration',
		'thu_duration',
		'fri_duration',
		'sat_duration',
		'sun_duration',
		'frm_servicedesc',
		'exp_country',
		'exp_address',
		'exp_building',
		'exp_city',
		'exp_state',
		'exp_zip',
		'is_late_fee',
		'late_fee',
		'included_items',
		'notincluded_items',
		'bring_wear',
		'req_safety',
		'days_plan_title',
		'days_plan_desc',
		'days_plan_img',
		'is_active',
		'instructor_id',
        'exp_highlight',
        'addi_info',
        'accessibility',
        'addi_info_help',
        'desc_location',
        'exp_lng',
        'exp_lat',
        'cancelbefore',
        'cancelbeforeint',
        'know_before_you_go',
    ];

     public static function boot(){
        parent::boot();

        static::deleting(function($service) {
            $service->price_details->each(function($price) {
                $price->delete();
            });

            $service->BusinessPriceDetailsAges->each(function($category) {
                $category->delete();
            });

            $service->schedulers->each(function($schedule) {
                $schedule->delete();
            });

            $service->reviews->each(function($review) {
                $reviews->delete();
            });

            $service->favourites->each(function($favourite) {
                $favourite->delete();
            });
        });
    }
    
    public function BusinessStaff(){
        return $this->belongsTo(BusinessStaff::class, 'instructor_id');
    }

    public function businesscompanydetail() {
        return $this->hasMany(BusinessCompanyDetail::class, 'cid');
    }

    public function BusinessPriceDetailsAges() {
        return $this->hasMany(BusinessPriceDetailsAges::class, 'serviceid');
    }

	public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    public function company_information(){
        return $this->belongsTo(CompanyInformation::class, 'cid');
    }

    public function reviews()
    {
        return $this->hasMany(BusinessServiceReview::class, 'service_id');
    }

    public function favourites(){
        return $this->hasMany(BusinessServicesFavorite::class, 'service_id');   
    }

    public function is_liked_by($user_id){
        return $this->favourites()->where('service_id', $this->id)->where('user_id', $user_id)->exists();
    }

    public function price_details(){
    	return $this->hasMany(BusinessPriceDetails::class, 'serviceid');
    }

    public function schedulers(){
        return $this->hasMany(BusinessActivityScheduler::class, 'serviceid');
    }

    public function UserBookingDetails(){
        return $this->hasMany(UserBookingDetails::class, 'sport');
    }

    public function reviews_score()
    {
    	$reviews_count = $this->reviews()->count();
    	$reviews_sum = $this->reviews()->sum('rating');

    	if($reviews_count > 0){	
    		return round($reviews_sum/$reviews_count,2); 
    	}else{
    		return 0;
    	}
    }

    public function first_profile_pic(){
        $pictures = explode(',',$this->profile_pic);
        return $pictures[0];
    }

    public function min_price(){
        $pricearr =$discountPriceArr= [];
        $priceAllArray = $this->price_details;
        if(!empty($priceAllArray)){
            foreach ($priceAllArray as $key => $value) {
                $price = 0;
                if(date('l') == 'Saturday' || date('l') == 'Sunday'){
                    if($value->adult_weekend_price_diff != ''){
                        $price = $value->adult_weekend_price_diff;
                        $discount = $value->adult_discount;
                    }else if($value->child_weekend_price_diff != ''){
                        $price = $value->child_weekend_price_diff;
                        $discount = $value->child_discount;
                    }else{
                        $price = $value->infant_weekend_price_diff;
                        $discount = $value->infant_discount;
                    }
                }else{
                    if($value->adult_cus_weekly_price != ''){
                        $price = $value->adult_cus_weekly_price;
                        $discount = $value->adult_discount;
                    }else if($value->child_cus_weekly_price != ''){
                        $price = $value->child_cus_weekly_price;
                        $discount = $value->child_discount;
                    }else{
                        $price = $value->infant_cus_weekly_price;
                        $discount = $value->infant_discount;
                    }
                }

                $discountPriceArr[] = $price - ($price * $discount/100); 
                $pricearr[] = $price != '' ? $price : 0;
            }
        }
        $priceAll = !empty($pricearr) ? min($pricearr) : '';
        $discountPrice = !empty($discountPriceArr) ? min($discountPriceArr) : '';

        if($priceAll != $discountPrice){
            $price = ' <strike> $'.$priceAll.'</strike> $'.$discountPrice;
        }else{
            $price = ' $'.$priceAll;
        }
        return $price;
    }

    public function profile_pictures(){
        return explode(',',$this->profile_pic);
    }

    public function formal_service_types(){
		if( $this->service_type =='individual' ) return 'Personal Training'; 
		else if( $this->service_type =='classes' )	return 'Classes'; 
		else if( $this->service_type =='experience' ) return 'Experience'; 
        else if( $this->service_type =='events' ) return 'Events'; 
    }

    public function fullAdressForMap(){
        $full_address = '';
        $full_address .= $this->exp_address != '' ? $this->exp_address.','  : ''; 
        $full_address .= $this->exp_city != ''  ?  $this->exp_city.',' : ''; 
        $full_address .= $this->exp_state != ''  ?  $this->exp_state.',': ''; 
        $full_address .= $this->exp_country != ''  ?  $this->exp_country.',' : ''; 
        return $full_address;
    }

    public function get_expired_time(){
        $sc_details = $this->schedulers;
        $ex_date = 'N/A';
        $dates = [];
        if(!empty($sc_details) && count($sc_details)>0){
            foreach($sc_details as $sd){
                $dates[] = $sd['end_activity_date'];
            }
            $ex_date = date('m/d/Y',strtotime(max($dates)));
        }
       
        return $ex_date;
    }
    public function get_scheduled_categories($catdata){
        $dataarray = [];
        if(!empty($catdata)){
            foreach($catdata as $data){
                $businessschedule =  $data->BusinessActivityScheduler;
                if(!empty($businessschedule)){
                    foreach($businessschedule as $scdata){
                        $dataarray[]= $scdata['category_id'];
                    }
                }
            }
            $dataarray =array_unique($dataarray);
        }

        return count($dataarray);
    }


    public function this_week_booking(){
        //$UserBookingDetailcount = UserBookingDetail::where('sport',$this->id)->where('bookedtime',">=", date('Y-m-d', strtotime("this week")))->count();
        $chkDetailCnt = 0;
        $userbookingDetail =  UserBookingDetail::where('sport',$this->id)->get();
        foreach($userbookingDetail as $usd){
            $chkDetailCnt += BookingCheckinDetails::where('booking_detail_id', $usd->id)->where('checkin_date',">=", date('Y-m-d', strtotime("this week")))->count();
        }
        return  $chkDetailCnt;
    }


}
