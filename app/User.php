<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Storage;
use App\StripePaymentMethod;
use Auth;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',  'password','new_password_key','is_deleted','isguestuser','fitnessity_fee','recurring_fee','firstname','lastname','birthdate','cid','bstep','serviceid','servicetype','stripe_connect_id','stripe_customer_id','username','gender','email','phone_number','profile_pic','address','city','state','country','zipcode','activated','show_step','dobstatus','buddy_key','primary_account','default_card','quick_intro', 'favorit_activity' ,'business_info','cover_photo','website','twitter','insta','facebook','unique_user_id','unique_code'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['about_me','network_count','about_business', 'full_name','age','first_letter','profile_pic_url'];

    public $timestamps = false;
    
    public static function boot(){
        parent::boot();

        self::created(function($model){
            if(!$model->stripe_customer_id){
                $model->create_stripe_customer_id();
            }
            if(!$model->unique_code){
                $model->create_unique_code();
            }
        });

        self::creating(function($model){
            if(!$model->unique_user_id){
                $model->create_unique_id();
            }
        });

        self::updated(function($model){
            if(!$model->stripe_customer_id){
                $model->create_stripe_customer_id();
            }
        });
    }


    public function create_unique_id(){
        $lastUser = User::whereNotNull('unique_user_id')->orderBy('id','desc')->first();
        if(!$lastUser){
            $uniqueId = 100000000;
        }else{
            $uniqueId = $lastUser->unique_user_id + 1;
        }

        $this->unique_user_id = $uniqueId;
    }

    public function create_unique_code(){
        $uniqueCode = $this->generateUniqueCode();
        while ($this->isCodeExists($uniqueCode)) {
            $uniqueCode = $this->generateUniqueCode();
        }
        $this->unique_code = $uniqueCode;
    }


    private function generateUniqueCode()
    {
        return str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
    }

    private function isCodeExists($code)
    {
        return DB::table('users')->where('unique_code', $code)->exists();
    }



    public function getAgeAttribute()
    {
        if($this->birthdate != null){
            return Carbon::parse($this->birthdate)->age;
        }else{
            return null;
        }
    }
    
    public function getFullNameAttribute(){
        return $this->firstname . ' ' . $this->lastname;
    }
    

    public function getFirstLetterAttribute(){
        if($this->firstname != '' && $this->lastname != '' ){
            return $this->firstname[0] . '' . $this->lastname[0];
        }else if($this->firstname != ''){
           return $this->firstname[0];
        }else{
            return 'F';
        }
    }

    public function getProfilePicUrlAttribute()
    {
        $profile_pic = '';
        if (Storage::disk('s3')->exists($this->profile_pic)) {
            $profile_pic = Storage::url($this->profile_pic);
        }

        return $profile_pic; 
    }

    public function getPic(){
       $profile_pic = '';
        if(Storage::disk('s3')->exists($this->profile_pic)){
            $profile_pic = Storage::url($this->profile_pic);
        }

        return $profile_pic;
    }

    public function getCoverPic(){
       $cover_photo = '';
        if(Storage::disk('s3')->exists($this->cover_photo)){
            $cover_photo = Storage::url($this->cover_photo);
        }

        return $cover_photo;
    }

    public function getaddress(){
        $address = '';
        if($this->address != ''){
            $address .= $this->address.', ';
        }
        if($this->city != ''){
            $address .= $this->city.', ';
        }
        if($this->state != ''){
            $address .= $this->state.', ';
        }
        if($this->country != ''){
            $address .= $this->country.', ';
        }
        if($this->zipcode != ''){
            $address .= $this->zipcode;
        }
        return $address;
    }
    
    function getAboutMeAttribute() {

        $about_me = "";

        if($this->role == "customer"){
            if(isset($this['customerDetail']['about_me']) && !empty($this['customerDetail']['about_me'])) {
                $about_me = $this['customerDetail']['about_me'];
            }
            return $about_me;
        }

        if($this->role == "business"){
            if(isset($this['ProfessionalDetail']['about_me']) && !empty($this['ProfessionalDetail']['about_me'])) {
                $about_me = $this['ProfessionalDetail']['about_me'];
            }
            return $about_me;

        }
    }
    
    function getAboutBusinessAttribute() {
        if($this->role == "business"){
            return $this['ProfessionalDetail']['about_business'];
        }
    }

    function getNetworkCountAttribute() {
        return UserNetwork::where('status','accepted')
                 ->where(function($q) {
                        $q->where('user_id', $this->id)
                          ->orWhere('friend_id', $this->id);
                    })
                 ->count();
    }

    function create_stripe_customer_id(){
        \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
        try{
             $customer = \Stripe\Customer::create([
                'name' => $this->firstname . ' '. $this->lastname,
                'email'=> $this->email,
            ]);
            $this->stripe_customer_id = $customer->id;
            $this->save();

            return $customer->id;
        }catch(Exception | \Stripe\Exception\InvalidRequestException $e){
            return "";
        }
       
    }

    public function get_stripe_card_info(){
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));

        if($this->stripe_customer_id != ''){
            $savedEvents = $stripe->customers->allSources(
                $this->stripe_customer_id,
                ['object' => 'card' ,'limit' => 30]
            );
            $savedEvents  = json_decode( json_encode( $savedEvents),true);
            return $savedEvents['data'];
        }
        return [];
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

  //  protected $hidden = ['password'];

    /**
     * Get all of the tasks for the user.
     */

    // public function tasks()
    // {
    //     return $this->hasMany(Task::class);
    // }


    public function customers()
    {
        return $this->hasMany(Customer::class,'user_id');
    }

    public function BusinessPriceDetailsAges()
    {
        return $this->hasMany(BusinessPriceDetailsAges::class,'userid');
    } 

    public function CustomersDocuments()
    {
        return $this->hasMany(CustomersDocuments::class,'user_id');
    

    }

    public function BusinessServices()
    {
        return $this->hasMany(BusinessServices::class,'userid');
    } 

    public function Products()
    {
        return $this->hasMany(Products::class,'user_id');
    }

    public function AddOnService()
    {
        return $this->hasMany(AddOnService::class,'user_id');
    }

    public function BusinessPriceDetails()
    {
        return $this->hasMany(BusinessPriceDetails::class,'userid');
    }

    public function employmenthistory()
    {
        return $this->hasMany(UserEmploymentHistory::class)->orderBy('is_present', 'desc')->orderBy('service_start', 'desc');
    }

    public function Transaction()
    {
        return $this->hasMany(Transaction::class,'user_id');
    }

    public function company()
    {
        return $this->hasMany(CompanyInformation::class);
    }

    public function current_company()
    {
        return $this->belongsTo(CompanyInformation::class,'cid');
    }

    public function education()
    {
        return $this->hasMany(UserEducation::class);

    }

    public function certification()
    {
        return $this->hasMany(UserCertification::class);
    }

    public function CustomerPlanDetails()
    {
        return $this->hasMany(CustomerPlanDetails::class ,'user_id');
    }

    public function service()
    {
        return $this->hasMany(UserService::class);
    }
    
    public function skill()
    {
        return $this->hasMany(UserSkillAward::class);
    }


    public function UserSecurityQuestion()
    {
        return $this->hasMany(UserSecurityQuestion::class);
    }

    public function UserMembership()
    {
        return $this->hasMany(UserMembership::class);
    }


    public function ProfessionalDetail()
    {
        return $this->hasOne(UserProfessionalDetail::class);
    }

    public function SocialAccount()
    {
        return $this->hasOne(SocialAccount::class);
    }


    public function BookingStatus()
    {
         return $this->hasMany(UserBookingStatus::class)->orderBy('created_at', 'desc');
    }

    public function orders(){
        return $this->hasMany(UserBookingStatus::class, 'user_id')->where('user_type', 'user');   
    }

    public function Review()
    {
        return $this->hasMany(Review::class);
    }

    public function countries()
    {
        return $this->belongsTo(AddrCountries::class, 'country', 'country_code');
    }

    public function states()
    {
        return $this->belongsTo(AddrStates::class, 'state', 'id');
    }

    public function cities()
    {
        return $this->belongsTo(AddrCities::class, 'city', 'id');
    }

    public function networks()
    {
        return $this->hasMany(UserNetwork::class);
    }

    public function customerDetail()
    {
        return $this->hasOne(UserCustomerDetail::class);
    }

    public function user_family_details()
    {
        return $this->hasMany(UserFamilyDetail::class,'user_id', 'id');
    } 

    public function favourites()
    {
        return $this->hasMany(UserFavourite::class,'favourite_user_id', 'id');
    }



    public function follows()
    {
        return $this->hasMany(UserFollower::class, 'follower_id', 'id');
    }

  
    public function getcustage(){
        if($this->birthdate != null){
            return Carbon::parse($this->birthdate)->age;
        }else{
            return "—";
        }
    }

    public function businesses(){
        return $this->hasMany(CompanyInformation::class, 'user_id');
    }

    public function getFullUserBookingStatus($business_id){

        //$customer_ids = Customer::where('user_id', $this->id)->pluck('id')->toArray();
        $customer_ids = Customer::where('business_id', $business_id)->pluck('id')->toArray();
        $customer_ids = implode(',',$customer_ids);
        //return UserBookingStatus::whereRaw('((user_type = "user" and user_id = ?) or (user_type = "customer" and customer_id in (?)))', [$this->id,$customer_ids]); 
        return UserBookingStatus::whereRaw('((user_type = "user" and user_id = ?) or (user_type = "customer" and customer_id in ('.$customer_ids.')))', [$this->id]); 
    }


    public function stripePaymentMethods(){
        return StripePaymentMethod::where('user_type', 'User')->where('user_id', $this->id);
    }

    public function currentPlan(){
        return $this->CustomerPlanDetails()->latest()->first();
    }

    public function chkDaysLeft(){
        //$data = $this->CustomerPlanDetails()->whereDate('expire_date','>=',date('Y-m-d'))->latest()->first();
        $data = $this->currentPlan();
        if($data){
            if(@$data->expire_date > date('Y-m-d')){
                $expireDate = \Carbon\Carbon::parse(@$data->expire_date);
                $remining = now()->diffInDays($expireDate) + 1 ;
            }
        }
        return $remining ?? 0;
    } 
    public function planDateDiffrence(){
        $data = $this->currentPlan();
        if($data){
            if(@$data->expire_date > date('Y-m-d')){
                $startDate = \Carbon\Carbon::parse(@$data->starting_date);
                $expireDate = \Carbon\Carbon::parse(@$data->expire_date);
                $diffrence = $startDate->diffInDays($expireDate) + 1 ;
            }
        }
        return $diffrence ?? 0;
    }

    public function freeTrial(){
        $data = $this->currentPlan();
        if(@$data->amount == 0){
            if(Auth::user()->planDateDiffrence() <= 15){
                return 'free';
            }
        }
        return '';
    }
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
