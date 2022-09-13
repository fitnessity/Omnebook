<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class BusinessServices extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
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
        'reserved_booking',
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
    ];
    
    public function businesscompanydetail() {
        return $this->hasMany(BusinessCompanyDetail::class, 'cid');
    }
	public function user()
    {
        return $this->belongsTo(User::class);
    }
}