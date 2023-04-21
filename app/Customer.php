<?php

namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\CompanyInformation;
use App\BookingCheckinDetails;
use File;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;
use App\StripePaymentMethod;

class Customer extends Authenticatable
{

    public static function boot(){
        parent::boot();

        self::creating(function($model){
            $fitnessity_user = User::where('email', $model->email)->first();
            if($fitnessity_user){
                $model->user_id = $fitnessity_user->id;
            }
        });

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

        self::updating(function($model){
            
            $fitnessity_user = User::where('email', $model->email)->first();
            if($fitnessity_user){
                $model->user_id = $fitnessity_user->id;
            }
        });
    }

	use  Notifiable;

	protected $table = 'customers';
	/**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'business_id','fname','lname', 'email','birthdate', 'phone_number','relationship','profile_pic','password','username','gender','address','city','state','country','zipcode','status','notes','parent_cus_id','card_stripe_id','card_token_id','stripe_customer_id','terms_covid','terms_liability','terms_contract', 'user_id'
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

    protected $appends = ['age', 'profile_pic_url', 'full_name', 'first_letter'];


    public function stripePaymentMethods(){
        return StripePaymentMethod::where('user_type', 'Customer')->where('user_id', $this->id);
    }
    public function getProfilePicUrlAttribute()
    {
        if($this->profile_pic){
            return Storage::url($this->profile_pic);
        }
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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bookingDetail(){
        return $this->hasMany(UserBookingDetail::class,'user_id');
    }

    public function bookingStatus()
    {
        return UserBookingStatus::whereRaw('((user_type = "user" and user_id = ?) or (user_type = "customer" and customer_id = ?))', [$this->user_id, $this->id]);
    }

    public function Transaction()
    {
        return $this->hasMany(Transaction::class,'user_id');
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


    public function get_stripe_payment_methods(){
        $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));

        $paymentMethods = $stripe->paymentMethods->all(['customer' => $this->stripe_customer_id, 'type' => 'card']);
        return $paymentMethods;

    }

    public function getFullNameAttribute(){
        return $this->fname . ' ' . $this->lname;
    }

    public function getFirstLetterAttribute(){
        return $this->fname[0] . ' ' . $this->lname[0];
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

    public function memberships(){
        $customer = $this;
        $company = $this->company_information;
        $result = UserBookingDetail::where('business_id', $company->id)->whereIn('booking_id', function($query) use ($customer){
            $query->select('id')
                  ->from('user_booking_status')
                  ->where(['user_type'=>'customer','user_id'=> $customer->id]);
        });
        return $result->count();
    }

    public function active_memberships(){
        $company = $this->company_information;
        $now = Carbon::now();
        //$result = UserBookingDetail::where('user_booking_details.business_id', $company->id)->where(['user_booking_details.user_type'=>'customer','user_booking_details.user_id'=>$this->id])->whereDate('user_booking_details.expired_at', '>', $now)->whereRaw('user_booking_details.pay_session > 0');

        $results = UserBookingDetail::select('user_booking_details.*', DB::raw('COUNT(booking_checkin_details.use_session_amount) as checkin_count') )->where('user_booking_details.business_id', $company->id)
            ->where(['user_booking_details.user_type' => 'customer','user_booking_details.user_id' => $this->id])
            ->join('booking_checkin_details', 'user_booking_details.id', '=', 'booking_checkin_details.booking_detail_id')
            ->groupBy('user_booking_details.id')
            ->havingRaw('COUNT(booking_checkin_details.use_session_amount) > 0')
            ->whereDate('user_booking_details.expired_at', '>', $now);
        return $results; 
    }

    public function expired_soon(){
        $company = $this->company_information;
        $now = Carbon::now();
        $from = (Carbon::now()->subDays(7))->format('Y-m-d');
        $to = (Carbon::now()->addDays(7))->format('Y-m-d');

        $result = UserBookingDetail::where('business_id', $company->id)->where(['user_type'=>'customer','user_id'=>$this->id])->whereDate('expired_at', '>',  $now)->whereBetween('expired_at',  [$from, $to]);

        return $result->count();
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

    public function total_spend(){
        $purchase_history = $this->transaction()->where('user_type','customer')->get();
        $sum = 0;
        foreach($purchase_history as $item){
            $sum += $item->amount;
        }
        return $sum;
    }

    public function complete_booking_details(){
        $company = $this->company_information;
        $booking_details = UserBookingDetail::where('business_id', $company->id)->where(['user_type'=>'customer','user_id'=>$this->id])->whereRaw('((pay_session <= 0 or pay_session is null) or expired_at < now())');

        return $booking_details;
    }

    public function visits(){
        $user = $this->user;
        $customer = $this;
        $company = $this->company_information;
        $user_id = $user ? $user->id : "no_user_id";

        $booking_details = UserBookingDetail::where('business_id', $company->id)->whereIn('booking_id', function($query) use ($customer, $user_id){
            $query->select('id')
                  ->from('user_booking_status')
                  ->whereRaw('((user_type = "user" and user_id = ?) or (user_type = "customer" and customer_id = ?))', [$user_id, $customer->id]);
        });
        $booking_detail_ids = $booking_details->get()->map(function($item){
            return $item->id;
        });


        return BookingCheckinDetails::whereIn('booking_detail_id', $booking_detail_ids)->orderBy('checkin_date', 'desc');
    }

    public function visits_count(){
        return $this->visits()->where('checked_at',"!=",NULL)->count();
    }

    public function get_last_seen(){
        $checkin = $this->visits()->orderby('checkin_date','desc')->first();
        if($checkin){
            return $checkin->checkin_date;
        }
    }

    public function get_current_membership(){
        $checkin = $this->get_last_seen();
        if($checkin){
           return $checkin->order_detail->business_services->program_name." ".$checkin->order_detail->business_price_detail->price_title;
        }
    }

    public function charge($amount){
        // charge on default card
        // add charge history(id amount strip_transaction_id credit_card_number status charge_class charge_id created_at updated_at)
    }

    public function is_active(){
        $checkindetail = BookingCheckinDetails::where('customer_id', $this->id)->whereDate("checkin_date",">=", Carbon::now()->subMonths(3))->orderby('checkin_date','desc')->first();
        if( $checkindetail != ''){
            return true;
        }else{
            return false;
        }
    }

    public function refund(){
        //refund to customer
    }

    public function recurring($booking_detail_id ,$type){
        return  Recurring::where(['booking_detail_id' => $booking_detail_id , 'user_id' => $this->id,'user_type' =>'customer','status' => $type]);
    }

    public function getFullUserBookingStatus($business_id){
        return UserBookingStatus::whereRaw('((user_type = "user" and user_id = ?) or (user_type = "customer" and customer_id in ('.$this->id.')))', [$this->user_id]); 
    }

    
}
   