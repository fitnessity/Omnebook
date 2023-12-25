<?php

namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\{BookingCheckinDetails,StripePaymentMethod,CompanyInformation,Recurring};
use File;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;
use Auth;

use Illuminate\Support\Str;

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
                //$model->create_stripe_customer_id();
            }
        });

        self::updated(function($model){
            if(!$model->stripe_customer_id){
                $model->create_stripe_customer_id();
            }
        });

        self::updating(function($model){
            
            $fitnessity_user = User::where(['email' => $model->email,'firstname' => $model->fname ,'lastname' => $model->lname])->first();
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
        'business_id','fname','lname', 'email','birthdate', 'phone_number','relationship','profile_pic','password','username','gender','address','city','state','country','zipcode','status','notes','parent_cus_id','card_stripe_id','card_token_id','stripe_customer_id','terms_covid','terms_liability','terms_contract', 'user_id','emergency_contact','emergency_relation','emergency_email','emergency_name','primary_account','terms_sign_path','contract_sign_path','liability_sign_path','covid_sign_path','refund_sign_path',
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

    protected $appends = ['age', 'profile_pic_url', 'full_name', 'first_letter' ,'company_name'];


    public function stripePaymentMethods(){
        return StripePaymentMethod::whereRaw('((user_type = "User" and user_id = ?) or (user_type = "Customer" and user_id = ?))', [$this->user_id, $this->id]);
    }

    public function getProfilePicUrlAttribute()
    {
        $profile_pic = '';
        if(Storage::disk('s3')->exists($this->profile_pic)){
            $profile_pic = Storage::url($this->profile_pic);
        }
        return $profile_pic;
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
        return $this->fname . ' ' . $this->lname;
    }

    public function getCompanyNameAttribute(){
        return $this->company_information->company_name ?? 'N/A';
    }

    public function getFirstLetterAttribute(){
        $fname = $this->fname != '' ? $this->fname[0] : '';
        $lname = $this->lname != '' ? $this->lname[0] : '';
        return $fname . '' . $lname;
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

    public function recurringDetail(){
        return $this->hasMany(recurring::class,'user_id');
    }

    public function bookingStatus()
    {
        return UserBookingStatus::whereRaw('((user_type = "user" and user_id = ?) or (user_type = "customer" and customer_id = ?))', [$this->user_id, $this->id]);
    }

    public function Transaction()
    {
        return $this->hasMany(Transaction::class,'user_id')->where('user_type','customer');
    }

    public function BookingCheckinDetails()
    {
        return $this->hasMany(BookingCheckinDetails::class,'customer_id');
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
        $familes = [];
        if($this->parent_cus_id){
            $parent = Customer::where('id',$this->parent_cus_id)->first();
            if ($parent != '') {
                $familes = Customer::where('parent_cus_id', $parent->id)->where('id', '<>', $this->id)->get();
                $familes = $familes->merge(Customer::where('id',$this->parent_cus_id)->where('id', '<>', $this->id)->get());
                $familes = $familes->merge(Customer::where('parent_cus_id',$this->id)->get());
            }
            
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
        $result = UserBookingDetail::where('business_id', $company->id)/*->whereIn('booking_id', function($query) use ($customer){
            $query->select('id')
                  ->from('user_booking_status')
                  */->where(['user_type'=>'customer','user_id'=> $customer->id]);
       /* });*/
        return $result->count();
    }

    public function active_memberships($sport = null,$expireDate= null){
        $expireDate = $expireDate ??  Carbon::now()->format('Y-m-d');
        $used_user_booking_detail_ids = $this->BookingCheckinDetails()->whereRaw('booking_detail_id is not null')->where('after_use_session_amount', 0)->pluck('booking_detail_id')->toArray();

        $results = $this->bookingDetail()->where('order_type','membership')->where('status', 'active')->whereRaw('(user_booking_details.expired_at > ? or user_booking_details.expired_at is null)', $expireDate)
                                         ->whereNotIn('user_booking_details.id', $used_user_booking_detail_ids);
 
        return $results; 
    }

    public function expired_soon(){
        $company = $this->company_information;
        $now = Carbon::now();
        $from = (Carbon::now()->subDays(7))->format('Y-m-d');
        $to = (Carbon::now()->addDays(7))->format('Y-m-d');

        $result = UserBookingDetail::where('business_id', $company->id)->where(['user_type'=>'customer','user_id'=>$this->id])->where('user_booking_details.order_type', 'Membership')->whereDate('expired_at', '>',  $now)->whereBetween('expired_at',  [$from, $to]);

        return $result->count();
    }

    function create_stripe_customer_id(){
	   if( !empty($this->email) && $this->email != 'N/A' && $this->email != '-' &&  $this->stripe_customer_id == ''){
            $FndCustomer = Customer::where(['fname' => $this->fname, 'lname' => $this->lname,'email' => $this->email])->whereNotNull('stripe_customer_id')->where('id', '!=', $this->id)->first();
            if($FndCustomer == ''){
                try {
                    \Stripe\Stripe::setApiKey(config('constants.STRIPE_KEY'));
                    $customer = \Stripe\Customer::create([
                        'name' => $this->fname . ' '. $this->lname,
                        'email'=> $this->email,
                    ]);
                    $this->stripe_customer_id = $customer->id;
                    $this->save();
            
                    return $customer->id;
                    
                } catch (Exception $e) {
                    return '';
                }
            }else{
                $this->stripe_customer_id = $FndCustomer->stripe_customer_id;
                $this->save();
                return $this->id;
            }
            
	   }
	   
    }
    public function purchase_history(){
        return $this->transaction()->where('user_type','customer')->whereIn('status',['complete', 'requires_capture', 'refund_complete']);
    }

    public function total_spend(){
        $purchase_history = $this->transaction()->where('user_type','customer')->where('status','complete')->get();
        $sum = 0;
        foreach($purchase_history as $item){
            $sum += $item->amount;
        }
        return $sum;
    }

    public function complete_booking_details(){
        $booking_details = $this->bookingDetail()->where('order_type','membership')->whereNotIn('id', $this->active_memberships()->pluck('id')->toArray());

        return $booking_details;
    }

    public function visits(){
        $user = $this->user;
        $customer = $this;
        $company = $this->company_information;
        $user_id = $user ? $user->id : "no_user_id";

        $booking_details = UserBookingDetail::where('business_id', $company->id)->where(['user_type'=>'customer','user_id'=>$this->id])->where('user_booking_details.order_type', 'Membership');

        /*$booking_details = UserBookingDetail::where('business_id', $company->id)->whereIn('booking_id', function($query) use ($customer, $user_id){
            $query->select('id')
                  ->from('user_booking_status')
                  ->whereRaw('((user_type = "user" and user_id = ?) or (user_type = "customer" and customer_id = ?))', [$user_id, $customer->id]);
        });*/
        $booking_detail_ids = $booking_details->get()->map(function($item){
            return $item->id;
        });

        return BookingCheckinDetails::whereIn('booking_detail_id', $booking_detail_ids)->orderBy('checkin_date', 'desc');
    }

    public function visits_count(){
        return $this->visits()->where('checked_at',"!=",NULL)->count();
    }

    public function get_last_seen(){
        $checkin = $this->visits()->where('checked_at',"!=",NULL)->orderby('checkin_date','desc')->first();
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

    public function charge($amount, $kind){
        $payment_method = $this->StripePaymentMethods()->get()->last();

        if($payment_method){
            $stripe = new \Stripe\StripeClient(config('constants.STRIPE_KEY'));

            $paymentIntent = $stripe->paymentIntents->create([
                'amount' =>  round($amount *100),
                'currency' => 'usd',
                'customer' => $this->stripe_customer_id,
                'payment_method' => $payment_method->payment_id,
                'off_session' => true,
                'confirm' => true,
                'metadata' => []
            ]);

            if($paymentIntent->status == 'succeeded'){

                $this->Transaction()->create([
                    'user_type' => 'Customer',
                    'user_id' => $this->id,
                    'item_type'=> 'Customer',
                    'item_id'=> $this->id,
                    'channel'=> 'stripe',
                    'kind'=> $kind,
                    'transaction_id'=> $paymentIntent->id,
                    'stripe_payment_method_id'=> $payment_method->payment_id,
                    'amount'=> $amount,
                    'qty'=> 1,
                    'status'=> 'complete',
                    'payload'=> json_encode($paymentIntent)
                ]);
                return true;
            }else{
                return false;
            }

        }else{
            return false;
        }
    }

    public function is_active(){
        $checkindetail = BookingCheckinDetails::where('customer_id', $this->id)->orderby('checkin_date','desc');
        $chk = $checkindetail->get();
        if($chk->isNotEmpty()){
            $detail = $checkindetail->whereDate("checkin_date",">=",Carbon::now()->subMonths(3))->first();
            return $detail != '' ? 'Active' : 'InActive';
        }else{
           return $this->created_at >= Carbon::now()->subMonths(3) ? 'Prospect' : 'InActive';
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

    public function sendemail($customer){
        
    }

    public function chkSignedTerms(){
        $termsChk = $this->terms_covid != '' && $this->terms_liability != '' && $this->terms_contract != '' ? "" : "Terms not signed. <br>";
        return $termsChk;
    }

    public function chkBirthday(){
        $currentDate = date('m-d');
        $birthdate = date('m-d' , strtotime($this->birthdate));

        return $birthdate == $currentDate ?  "<br>Today is your birthday.<br>" : '';  
    }

    public function findExpiredCC(){
        $cards = '';
        $cardDetails = $this->stripePaymentMethods()->get();
       // print_r($cardDetails);
        foreach($cardDetails as $card){
            if($card->exp_year <= date('Y') && $card->exp_month <= date('n')){
                $cards .=  $card->brand."  **** ".$card->last4."<br>";
            }
        }

        return $cards != '' ? "<br><h6>Expired CC List</h6>".$cards : '';
    }

    public function chkRecurringPayment($bookId){
        $currentMonth = date('m');
        $bookingData  = UserBookingDetail::find($bookId);
        $data = $bookingData != '' ? @$bookingData->Recurring()->where(['booking_detail_id' =>$bookId])->whereMonth('payment_date', '=' , $currentMonth)->first() : '';
        if(@$data->status == 'Completed'){
            return "<br>Default payment done";
        }else if(@$data->status == 'Retry'){
            return "<br>Default payment failed";
        }
    } 

    public function getCheckInId($bookingId,$date){
        $checkInDetail = $this->BookingCheckinDetails()->where('booking_detail_id',$bookingId)->whereDate('checkin_date' ,$date)->first();
        return @$checkInDetail->id;
    }

    public function get_Inactive($type,$startDate, $endDate){
        $checkindetail = BookingCheckinDetails::where('customer_id', $this->id)->orderby('checkin_date','desc');
        $chk = $checkindetail->get();
        if($chk->isNotEmpty()){
            $detail = $checkindetail->whereDate("checkin_date",">=",Carbon::parse($startDate)->subMonths(3))->whereDate("checkin_date","<=",Carbon::parse($endDate)->subMonths(3))->first();
            return $detail != '' ? 1 : 0;
        }else{
           return $this->created_at >= Carbon::parse($startDate)->subMonths(3) ? 1 : 0;
        }
    }
    
}
   