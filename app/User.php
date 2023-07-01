<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','new_password_key','username','is_deleted','isguestuser','fitnessity_fee','firstname','lastname','birthdate'
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

    protected $appends = ['about_me','network_count','about_business', 'full_name','age','first_letter'];

    public $timestamps = false;
    
    
    public static function boot(){
        parent::boot();

        self::created(function($model){
            if(!$model->stripe_customer_id){
                $model->create_stripe_customer_id();
            }
        });

        self::updated(function($model){
            if(!$model->stripe_customer_id){
                $model->create_stripe_customer_id();
            }
        });
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
        return $this->firstname[0] . '' . $this->firstname[0];
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
        $customer = \Stripe\Customer::create([
            'name' => $this->firstname . ' '. $this->lastname,
            'email'=> $this->email,
        ]);
        $this->stripe_customer_id = $customer->id;
        $this->save();

        return $customer->id;
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

}
