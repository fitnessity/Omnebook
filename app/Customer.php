<?php

namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\CompanyInformation;
use File;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Customer extends Authenticatable
{

	use  Notifiable;

	protected $table = 'customers';
	/**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'business_id','fname','lname', 'email','birthdate', 'phone_number','profile_pic','password','username','gender','address','city','state','country','zipcode','status','notes','parent_cus_id','card_stripe_id','card_token_id','stripe_customer_id','terms_covid','terms_liability','terms_contract'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ['age', 'profile_pic_url'];


    public function getProfilePicUrlAttribute()
    {
        if($this->profile_pic){
            return Storage::url($this->profile_pic);
        }
        // return Storage::url($this->profile_pic);
    }

    public function getAgeAttribute()
    {
        if($this->birthdate != null){
            return Carbon::parse($this->birthdate)->age;
        }else{
            return null;
        }
    }

    public function company_information()
    {
        return $this->belongsTo(CompanyInformation::class, 'business_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'email', 'email');
    }

    public function BookingStatus()
    {
        return $this->hasMany(UserBookingStatus::class,'user_id');
    }

    public static function getcustomerofthiscompany($companyId){
        return Customer::where('business_id', $companyId)->orderBy('fname', 'ASC')->get();
    }

    public function CustomerFamilyDetail()
    {
        return $this->hasMany(Customer::class, 'parent_cus_id');
    }

    public function get_families()
    {
        if($this->parent_cus_id){
            $parent = Customer::where('id',$this->parent_cus_id)->first();
            $familes = Customer::where('parent_cus_id', $parent->id)->where('id', '<>', $this->id)->get();
            $familes = $familes->merge(Customer::where('id',$this->parent_cus_id)->where('id', '<>', $this->id)->get());
            return $familes;
        }else{
            return Customer::where('parent_cus_id',$this->id)->get();
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

    public function full_address(){
        $location = '';
        $address = '';
        if($this->address != ''){
            $address .= $this->address.', ';
        }
        if($this->city != ''){
            $address .= $this->city.', ';
        }
        if($this->state != ''){
            $address .= $this->state.' '.$this->zipcode.', ';
            $location .= $this->state.', ';
        }
        if($this->country != ''){
            $address .= $this->country;
            $location .= $this->country;
        }

        if($address == ''){
            $address = '—';
        }else if($address == 'US'){
            $address = 'United States';
        }

        if($location == ''){
           $location = '—'; 
        }else if($location == 'US'){
            $location = 'United States';
        }
        return $address;
    }

    public function getlastbooking(){
        $bddata = '';
        $status = UserBookingStatus::where('user_id',$this->id)->orderby('created_at','desc')->first();
        if($status != ''){
           $bddata =  UserBookingDetail::where('booking_id',$status->id)->orderby('created_at','desc')->first();
        }
        return  $bddata ;
    }

    public function active_memberships(){
        $user = $this->user;
        $customer = $this;
        $company = $this->company_information;
        if($user){
            $result = UserBookingDetail::whereIn('sport', function($query) use ($company){
                $query->select('id')
                      ->from('business_services')
                      ->where('cid', $company->id);
            })->whereIn('booking_id', function($query) use ($customer, $user){
                $query->select('id')
                      ->from('user_booking_status')
                      ->whereRaw('(user_type = "user" and user_id = ?) or (user_type = "customer" and user_id = ?)', [$user->id, $customer->id]);
            });
            return $result->get();
            // return 'yes';    

            // UserBookingDetail::where('booking_id')
        }

        
    }

    function create_stripe_customer_id(){
        \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
        $customer = \Stripe\Customer::create([
            'name' => $this->fname . ' '. $this->lname,
            'email'=> $this->email,
        ]);
        $this->stripe_customer_id = $customer->id;
        $this->save();

        return $customer->id;
    }

    public function get_last_seen(){
        return $this->user;
    }
    
}
   