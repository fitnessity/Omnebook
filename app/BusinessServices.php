<?php
namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;

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
        'cover_photo',
        'video',
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
        'can_book_after_activity_starts',
        'aftertime',
        'aftertimeint',
        'cancellation_policy',
    ];


    protected $appends = ['days_title_arry','days_desc_arry','days_img_arry' ,'id_proof' ,'id_vaccine' ,'id_covid' ,'included_items_ary','not_included_items_ary','all_over_review'];

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

            $service->UserBookingDetails->each(function($detail) {
                $detail->terminated_at = date('Y-m-d');
                $detail->terminate_reason = 'We would like to inform you that this activity has been closed by company.';
                $detail->terminate_comment = 'If you have any questions or need additional assistance, please don\'t hesitate to reach out to our support team.';
                $detail->status = 'terminate';
                $detail->update();
            });
        });
    }


    public function getAllOverReviewAttribute(){
        $reCnt = 0;
        $reCnt += getBusinessServiecReviewSum($this->id,'cleanliness');
        $reCnt += getBusinessServiecReviewSum($this->id,'accuracy');
        $reCnt += getBusinessServiecReviewSum($this->id,'checkin');
        $reCnt += getBusinessServiecReviewSum($this->id,'communication');
        $reCnt += getBusinessServiecReviewSum($this->id,'customer_service');
        $reCnt += getBusinessServiecReviewSum($this->id,'location');
        $reCnt += getBusinessServiecReviewSum($this->id,'value');
        
        if($reCnt > 0){
             return round($reCnt / ($this->reviews()->count() * 7),2);
        }
        return 0;
    }

    public function getDaysTitleArryAttribute(){
        if ($this->days_plan_title === null || $this->days_plan_title === '' || $this->days_plan_title === '[null]') {
            return [];
        }
    
        return json_decode($this->days_plan_title, true);
    } 

    public function getDaysDescArryAttribute(){
        return $this->days_plan_desc != ''  || $this->days_plan_desc != '[null]'  ? json_decode($this->days_plan_desc, true) : [];
    }

    public function getDaysImgArryAttribute(){
        return $this->days_plan_img != ''  ? explode(",",$this->days_plan_img) : [];
    }

    public function getIncludedItemsAryAttribute(){
        return $this->included_items != ''  ? explode(",",$this->included_items) : [];
    } 

    public function getNotIncludedItemsAryAttribute(){
        return $this->notincluded_items != ''  ? explode(",",$this->notincluded_items) : [];
    } 

    public function getIdProofAttribute(){
        $reqSafety = explode(',',$this->req_safety);
        return empty($reqSafety) ? 0 : (in_array("id_proof", $reqSafety) ? 1 : 0);
    }

    public function getIdVaccineAttribute(){
        $reqSafety = explode(',',$this->req_safety);
        return empty($reqSafety) ? 0 : (in_array("id_vaccine", $reqSafety) ? 1 : 0);
    }

    public function getIdCovidAttribute(){
        $reqSafety = explode(',',$this->req_safety);
        return empty($reqSafety) ? 0 : (in_array("id_covid", $reqSafety) ? 1 : 0);
    }
    
    public function BusinessStaff(){
        return $this->belongsTo(BusinessStaff::class, 'instructor_id');
    }

    public function businessServicesFaq(){
        return $this->hasMany(BusinessServicesFaq::class, 'service_id');
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
        return $this->hasMany(UserBookingDetail::class, 'sport');
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

    // public function first_profile_pic_home(){
    //     $pictures = explode(',',$this->profile_pic);
    //     return Storage::disk('s3')->exists( $pictures[0]) ? Storage::URL( $pictures[0]) : '/public/images/service-nofound.jpg';
    // }
    public function first_profile_pic(){
        $pictures = explode(',',$this->profile_pic);
        // return Storage::disk('s3')->exists( $pictures[0]) ? Storage::URL( $pictures[0]) : '/public/images/service-nofound.jpg';
        $picture_url = 'https://d2r3bve520mp70.cloudfront.net/' . $pictures[0];
        return $picture_url;

    }
    

    public function getConverPhotoUrl()
    {  
        //  return Storage::disk('s3')->exists($this->cover_photo) ? Storage::url($this->cover_photo) : '/public/images/service-nofound.jpg';
        if(Storage::disk('s3')->exists($this->cover_photo))
        {

            $cover_photo_url = 'https://d2r3bve520mp70.cloudfront.net/' . $this->cover_photo;
        }
        else{
            $cover_photo_url ='/public/images/service-nofound.jpg';
        }
        // if($cover_photo_url=='')
        // {
        //     $cover_photo_url = '/public/images/service-nofound.jpg';
         // }
        return $cover_photo_url;
    }
    
    // public function getConverPhotoUrl_img()
    // {  
    //     //  return Storage::disk('s3')->exists($this->cover_photo) ? Storage::url($this->cover_photo) : '/public/images/service-nofound.jpg';
    //     return $this->cover_photo;
    // }
    public function getConverPhotoUrl_img()
    {
        if($this->cover_photo!='')
        {
            return $this->cover_photo;
        }
        else{
            return '/public/images/service-nofound.jpg';

        }
        // if (!empty($this->cover_photo)) {
        //     return $this->cover_photo;
        // } else {
            // return '/public/images/service-nofound.jpg';
        // }
    }
    public function min_price(){
        $pricearr =$discountPriceArr= [];
        $priceVal = '';
        $priceAllArray = $this->price_details;
        if(!empty($priceAllArray)){
            foreach ($priceAllArray as $key => $value) {
                $price = 0;
    
                if($value->adult_weekend_price_diff != ''){
                    $priceWEnd = $value->adult_weekend_price_diff;
                    $discountWEnd = $value->adult_discount;
                }else if($value->child_weekend_price_diff != ''){
                    $priceWEnd = $value->child_weekend_price_diff;
                    $discountWEnd = $value->child_discount;
                }else{
                    $priceWEnd = $value->infant_weekend_price_diff;
                    $discountWEnd = $value->infant_discount;
                }
              
                if($value->adult_cus_weekly_price != ''){
                    $priceWDay = $value->adult_cus_weekly_price;
                    $discountWDay = $value->adult_discount;
                }else if($value->child_cus_weekly_price != ''){
                    $priceWDay = $value->child_cus_weekly_price;
                    $discountWDay = $value->child_discount;
                }else{
                    $priceWDay = $value->infant_cus_weekly_price;
                    $discountWDay = $value->infant_discount;
                }

                if(date('l') == 'Saturday' || date('l') == 'Sunday'){
                    $price = $priceWEnd ?: $priceWDay ?: 0;
                    $discountVal = $discountWEnd ?: $discountWDay ?: 0;
                }else{
                    $price = $priceWDay ?: $priceWEnd ?: 0;
                    $discountVal = $discountWDay ?: $discountWEnd ?: 0;
                }

                if($price != 0){
                    $pricearr[] =  $price;
                } 

                $dis = ($price != 0 && $discountVal != 0) ? $price - ($price * $discountVal / 100) : ($discountVal == 0 ? $price : 0);

                if($dis != 0){
                    $discountPriceArr[] =  $dis;
                }
            }
        }
        
        $priceAll = !empty($pricearr) ? min($pricearr) : '';
        $discountPrice = !empty($discountPriceArr) ? min($discountPriceArr) : '';
        if($priceAll != $discountPrice){
            $priceVal = ' <strike> $'.$priceAll.'</strike> $'.$discountPrice;
        }else if($priceAll != 0){
            $priceVal = ' $'.$priceAll;
        }
        return $priceVal ?? '';
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
            $chkDetailCnt += BookingCheckinDetails::where('booking_detail_id', $usd->id)->where('checkin_date',">=", date('Y-m-d', strtotime("this week")))->where('checkin_date',"<=", date('Y-m-d', strtotime("saturday 0 week")))->count();
        }
        return  $chkDetailCnt;
    }

    // In BusinessService.php model
    public function priceDetailsAges()
    {
        return $this->hasMany(BusinessPriceDetailsAges::class, 'serviceid', 'id');
    }


}
