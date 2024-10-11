<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use Storage;
use DB;
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
   
    protected $guarded = [];  
    protected $appends = ['full_name', 'first_letter','public_company_name','cname_first_letter','business_review_avg' ,'years_of_exp','owner_country'];

    public function getBusinessReviewAvgAttribute(){

        if($this->businessReview()->count() > 0)
        { 
            return round($this->businessReview()->sum('rating')/$this->businessReview()->count(),2); 
        }

        return 0;
    }

    public function getOwnerCountryAttribute(){
        if($this->addressCountry){
            return $this->addressCountry->country_name;
        }
        return '';
    }

    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getYearsOfExpAttribute(){
        $startDate = new \DateTime($this->created_at);
        $endDate = new \DateTime();
        $totalDays = $startDate->diff($endDate)->days;

        $totalYears = $totalDays / 365.25;
        return number_format($totalYears, 1);
    }

    public function getFirstLetterAttribute(){
        if($this->first_name && $this->last_name){
            return $this->first_name[0] . ' ' . $this->last_name[0];    
        }
    }

    public function getPublicCompanyNameAttribute(){
        return  $company_name = $this->dba_business_name  != '' ? $this->dba_business_name :$this->company_name;
    }

    public function getCnameFirstLetterAttribute(){
        $company_name = $this->dba_business_name  != '' ? $this->dba_business_name :$this->company_name;
        return $cp = substr($company_name, 0, 1);
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

    public function Recurring() {
        return $this->hasMany(Recurring::class, 'business_id');
    }

    public function businessReview() {
        return $this->hasMany(BusinessReview::class, 'page_id');
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

    public function CustomerNotes() {
        return $this->hasMany(CustomerNotes::class, 'business_id');
    }

    public function products() {
        return $this->hasMany(Products::class, 'business_id');
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


    public function addressCountry() {
        return $this->belongsTo(AddressCountry::class, 'born');
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
         if($this->zip_code != ''){
            $comp_address .= $this->zip_code.', ';
        }
        if($this->country != ''){
            $comp_address .= $this->country;
        }
       

        return $comp_address;
    }

    public function business_activity_schedulers() {
        return $this->hasMany(BusinessActivityScheduler::class, 'cid');
    }

    public function visits_count_by_user_id($customerId = null){
        if($customerId == ''){
            $customer = Auth::user()->customers()->where('business_id', $this->id)->first();
        }else{
            $customer = Customer::where(['business_id'=> $this->id,'id'=> $customerId])->first();
        }
        $customerId = @$customer->id;
        
        $booking_details = UserBookingDetail::where(['user_booking_details.user_type'=>'customer','user_booking_details.user_id'=>$customerId])->join('user_booking_status','user_booking_details.booking_id', '=', 'user_booking_status.id');
        /*if(@$customer->user_id == Auth::user()->id){
            $booking_details = $booking_details->orwhere(['user_booking_status.user_id' => Auth::user()->id]);
        }*/
        $booking_details = $booking_details->where('user_booking_details.business_id', $this->id)
        ;
        $booking_detail_ids = $booking_details->get()->map(function($item){
            return $item->id;
        });

        return BookingCheckinDetails::whereIn('booking_detail_id', $booking_detail_ids)->orderBy('checkin_date', 'desc')->where('checked_at',"!=",NULL)->count();
    }

    public function notes_count_by_user_id($customerId){

        $notesCnt = CustomerNotes::where(['customer_id'=> $customerId ,'display_chk' => 1])->orderby('due_date','desc')->whereDate('due_date', '=', now())->whereTime('time', '<=', now()->format('H:i'))
                ->orWhere(function ($query) use($customerId) {
                    $query->whereDate('due_date', '<=', now())->where('customer_id', $customerId )->where('display_chk' ,1);
                })->where('business_id', $this->id)->count();
        $expiredCards = StripePaymentMethod::where(['user_id'=> $customerId, 'user_type' => 'Customer'])->where('exp_year','<=', date('Y'))->where('exp_month','<', date('m'))->count();
                $missedPayments = Recurring::where(['user_id'=> $customerId, 'user_type' => 'Customer'])->where('status' ,'!=','Completed')->whereDate('payment_date' ,'<' ,date('Y-m-d'))->count();
        $notesCnt += $expiredCards;
        $notesCnt += $missedPayments;
        return $notesCnt;
    }

    public static function use_user_details(){
        return UserBookingDetail::select('user_booking_details.*', DB::raw('SUM(booking_checkin_details.use_session_amount) as checkin_count') )->join('booking_checkin_details', 'user_booking_details.id', '=', 'booking_checkin_details.booking_detail_id')->groupBy('user_booking_details.id');
    }

    public function active_memberships_count_by_user_id($customerId = null){
        //echo $customerId;
        if($customerId == ''){
            $customer = Auth::user()->customers()->where('business_id', $this->id)->first();
        }else{
            $customer = Customer::where(['business_id'=> $this->id,'id'=> $customerId])->first();
        }
    
        $customerId = @$customer->id;
       
        $now = Carbon::now();
        $result = CompanyInformation::use_user_details()->havingRaw('(user_booking_details.pay_session - checkin_count) > 0')
            ->where(['user_booking_details.user_type' => 'customer','user_booking_details.user_id' => $customerId]);
        /*
        ->join('user_booking_status','user_booking_details.booking_id', '=', 'user_booking_status.id')
        if(@$customer->user_id == Auth::user()->id){
            $result = $result->orwhere(['user_booking_status.user_id' => Auth::user()->id]);
        }*/
        $result = $result->where('user_booking_details.business_id', $this->id)->groupBy('user_booking_details.id')
            ->whereDate('user_booking_details.expired_at', '>', $now)->get();
        //print_r($result);
        return  count($result);
    }

    public function completed_memberships_count_by_user_id($customerId = null){
        if($customerId == ''){
            $customer = Auth::user()->customers()->where('business_id', $this->id)->first();
            $customerId = @$customer->id;
        }else{
            $customer = Customer::where(['business_id'=> $this->id,'id'=> $customerId])->first();
        }
        $customerId = @$customer->id;
        $now = Carbon::now();
        $result = CompanyInformation::use_user_details()->where(['user_booking_details.user_type' => 'customer','user_booking_details.user_id' => $customerId])->whereDate('user_booking_details.expired_at', '<=', $now)->where('user_booking_details.business_id', $this->id)->get();
        return  count($result);
        
        /*->join('user_booking_status','user_booking_details.booking_id', '=', 'user_booking_status.id')
        if(@$customer->user_id == Auth::user()->id){
            $result = $result->orwhere(['user_booking_status.user_id' => Auth::user()->id]);
        }
        $result = $result->where('user_booking_details.business_id', $this->id)->whereDate('user_booking_details.expired_at', '<', $now)
            ->havingRaw('(user_booking_details.pay_session - checkin_count) = 0')->get();*/
        //echo $result;
    }

    public function expired_soon_memberships_count_by_user_id($customerId = null){
        if($customerId == ''){
            $customer = Auth::user()->customers()->where('business_id', $this->id)->first();
            $customerId = @$customer->id;
        }else{
            $customer = Customer::where(['business_id'=> $this->id,'id'=> $customerId])->first();
        }
        $now = Carbon::now();
        $from = (Carbon::now()->subDays(7))->format('Y-m-d');
        $to = (Carbon::now()->addDays(7))->format('Y-m-d');
        $result = CompanyInformation::use_user_details()->havingRaw('(user_booking_details.pay_session - checkin_count) > 0') ->where(['user_booking_details.user_type' => 'customer','user_booking_details.user_id' => $customerId]);
        /*
        ->join('user_booking_status','user_booking_details.booking_id', '=', 'user_booking_status.id')
        if(@$customer->user_id == Auth::user()->id){
            $result = $result->orwhere(['user_booking_status.user_id' => Auth::user()->id]);
        }*/
        $result = $result->where('user_booking_details.business_id', $this->id)->whereDate('user_booking_details.expired_at', '>',  $now)->whereBetween('user_booking_details.expired_at',  [$from, $to])->get();
        return  count($result);
        //return $result->count(); 
    }

    public function company_booking(){
        $customer = Auth::user()->customers()->where('business_id', $this->id)->first();
        $customerId = @$customer->id;
        $booking_details = UserBookingDetail::where(['business_id'=>$this->id,'user_type'=>'customer','user_id'=>$customerId]);
        return $booking_details->orderBy('created_at','desc')->get();
    }

    public function getCompanyImage(){
        $profile_pic = '';
        if(Storage::disk('s3')->exists($this->logo)){
            $profile_pic = Storage::url($this->logo);
        }

        return $profile_pic;
    }

}
