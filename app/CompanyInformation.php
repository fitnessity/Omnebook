<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use Carbon\Carbon;

class CompanyInformation extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
     use SoftDeletes;
    protected $table = 'company_informations';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'contact_number',
        'logo',
        'company_name',
        'city',
        'state',
        'zip_code',
        'address',
        'country',
        'ein_number',
        'establishment_year',
        'business_user_tag',
        'about_company',
        'short_description',
        'latitude',
        'longitude',
        'website',
        'dba_business_name',
        'additional_address',
        'neighborhood',
        'business_phone',
        'business_email',
        'business_website',
        "stripe_connect_id",
        "charges_enabled",
        "business_added_by_cust_name",
        "is_verified",
    ];

    protected $appends = ['full_name', 'first_letter'];

    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getFirstLetterAttribute(){
        if($this->first_name && $this->last_name){
            return $this->first_name[0] . ' ' . $this->last_name[0];    
        }
        
    }
    
    public function employmenthistory() {
        return $this->hasMany(UserEmploymentHistory::class, 'company_id');
    }

    public function education() {
        return $this->hasMany(UserEducation::class, 'company_id');
    }

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function business_staff() {
        return $this->hasMany(BusinessStaff::class, 'business_id');
    }

    public function certification() {
        return $this->hasMany(UserCertification::class, 'company_id');
    }

    /*public function service() {
        return $this->hasMany(UserService::class, 'company_id');
    }*/

    public function business_service() {
        return $this->belongsTo(BusinessService::class, 'id');
    }

    public function UserBookingDetails(){
        return $this->hasMany(UserBookingDetail::class, 'business_id');
    }

	public function service() {
        return $this->hasMany(BusinessServices::class, 'cid');
    }

    public function skill() {
        return $this->hasMany(UserSkillAward::class, 'company_id');
    }

    public function ProfessionalDetail() {
        return $this->hasOne(UserProfessionalDetail::class, 'company_id');
    }

    public function customers(){
        return $this->hasMany(Customer::class, 'business_id');
    }

    public function business_services(){
        return $this->hasMany(BusinessServices::class, 'cid');
    }
    
    public function business_services_with_trashed(){
        return $this->hasMany(BusinessServices::class, 'cid')->withTrashed();
    }

    public function businessterms() {
        return $this->hasOne(BusinessTerms::class, 'cid');
    }

    public function business_terms() {
        return $this->hasMany(BusinessTerms::class, 'cid');
    }

    public function company_address(){
        $comp_address = '';
        if($this->address != ''){
            $comp_address = $this->address.', ';
        }
        if($this->city != ''){
            $comp_address .= $this->city.', ';
        }
        if($this->state != ''){
            $comp_address .= $this->state.', ';
        }
        if($this->country != ''){
            $comp_address .= $this->country.', ';
        }
        if($this->zip_code != ''){
            $comp_address .= $this->zip_code;
        }

        return $comp_address;
    }

    public function business_activity_schedulers() {
        return $this->hasMany(BusinessActivityScheduler::class, 'cid');
    }

    public function visits_count_by_user_id(){
        $customer = Auth::user()->customers()->where('business_id', $this->id)->first();
        $customerId = @$customer->id;
        $booking_details = UserBookingDetail::where(['business_id'=>$this->id,'user_type'=>'customer','user_id'=>$customerId]);
        $booking_detail_ids = $booking_details->get()->map(function($item){
            return $item->id;
        });

        return BookingCheckinDetails::whereIn('booking_detail_id', $booking_detail_ids)->orderBy('checkin_date', 'desc')->where('checked_at',"!=",NULL)->count();
    }

    /*public function active_memberships_count(){
        $company = $this;
        $user_id = Auth::user()->id;
        $now = Carbon::now();
        //\DB::enableQueryLog();
        $result = UserBookingDetail::whereIn('sport', function($query) use ($company){
            $query->select('id')
                  ->from('business_services')
                  ->where('cid', $this->id);
        })->whereIn('booking_id', function($query) use ($user_id){
            $query->select('id')
                  ->from('user_booking_status')
                  ->where('user_id',$user_id );
        })->whereDate('expired_at', '>=',  $now)->where('pay_session', ">" ,0);
        $result->count();
        //dd(\DB::getQueryLog());
       return $result->count(); 
    }*/

    public function active_memberships_count_by_user_id(){
        $customer = Auth::user()->customers()->where('business_id', $this->id)->first();
        $customerId = @$customer->id;
        $now = Carbon::now();
        $result = UserBookingDetail::where(['business_id'=>$this->id,'user_type'=>'customer','user_id'=>$customerId])->whereDate('expired_at', '>=',  $now)->where('pay_session', ">" ,0);
        return $result->count(); 
    }

    public function completed_memberships_count_by_user_id(){

        $customer = Auth::user()->customers()->where('business_id', $this->id)->first();
        $customerId = @$customer->id;
        $now = Carbon::now();
        $result = UserBookingDetail::where(['business_id'=>$this->id,'user_type'=>'customer','user_id'=>$customerId])->whereDate('expired_at', '<',  $now)->where('pay_session', ">" ,0);
        return $result->count(); 
    }

    public function expired_soon_memberships_count_by_user_id(){
        $customer = Auth::user()->customers()->where('business_id', $this->id)->first();
        $customerId = @$customer->id;
        $now = Carbon::now();
        $from = (Carbon::now()->subDays(7))->format('Y-m-d');
        $to = (Carbon::now()->addDays(7))->format('Y-m-d');
        $result = UserBookingDetail::where(['business_id'=>$this->id,'user_type'=>'customer','user_id'=>$customerId])->whereDate('expired_at', '>',  $now)->whereBetween('expired_at',  [$from, $to]);
        return $result->count(); 
    }

    public function company_booking(){
        $customer = Auth::user()->customers()->where('business_id', $this->id)->first();
        $customerId = @$customer->id;
        $booking_details = UserBookingDetail::where(['business_id'=>$this->id,'user_type'=>'customer','user_id'=>$customerId]);
        return $booking_details->orderBy('created_at','desc')->get();
    }
}
