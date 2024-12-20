<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\SoftDeletes;

class UserBookingStatus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // public $timestamps = false;
     use SoftDeletes;
    protected $table = 'user_booking_status';
	protected $fillable = [
        'booking_type', 'user_id', 'customer_id', 'business_id','status','service_id','rejected_reason','stripe_id','stripe_status','currency_code','amount', 'order_id', 'bookedtime','user_type','pmt_method','pmt_json','retrun_cash','order_type'
    ];

    protected $appends = ['full_name'];

    public static function boot(){
        parent::boot();

        self::creating(function($model){
            $date = Carbon::now();
            $digits = 3;
            $rand = rand(pow(10, $digits-1), pow(10, $digits)-1); 

            $model->order_id = 'FS_'.$date->format('YmdHis').$rand;
        });

    }

    /**
     * Get the user that owns the task.
     */

    function getFullNameAttribute() {
        if($this->user_type == 'user'){
            return $this->user->firstname;
        }else{
            return $this->customer ? $this->customer->fname : '';
        }
    }

    public function BookingActivityCancel(){
        return $this->hasMany(BookingActivityCancel::class,'booking_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function Transaction()
    {
        return $this->hasMany(Transaction::class,'item_id')->where('item_type','UserBookingStatus');
    }

    public function SingleTransaction()
    {
        return $this->hasOne(Transaction::class,'item_id');
    }

    public function businessuser()
    {
        return $this->belongsTo(User::class, 'business_id');
    }

    public function UserBookingDetail()
    {
        return $this->hasMany(UserBookingDetail::class, 'booking_id')->orderBy('created_at', 'desc');
    }

    public function Jobpostquestions()
    {
        return $this->hasMany(Jobpostquestions::class, 'jobid');
    }

    public function UserBookingQuote()
    {
        return $this->hasMany(UserBookingQuote::class, 'booking_id');
    }

    public function Jobpostbidding()
    {
        return $this->hasMany(Jobpostbidding::class, 'jobid');
    }
    
    public function getPaymentDetail(){
        $transaction = Transaction::where('item_type', 'UserBookingStatus')->where('item_id', $this->id)->first();

        if($transaction){
            return $transaction->getPmtMethod();
        }else{
            return "N/A";
        }
    }

    public function getstripecard(){
        return 'TBD';
        // $stripe = new \Stripe\StripeClient(
        //     config('constants.STRIPE_KEY')
        // );

        // $last4 = '';
        // $card_id = '—';
        // $stripe_id = $this->stripe_id;
        // if($stripe_id != ''){
        //     $payment_intent = $stripe->paymentIntents->retrieve(
        //         $stripe_id,
        //         []
        //     );
        //     $last4 = $payment_intent['charges']['data'][0]['payment_method_details']['card']['last4'];
        // }

        // if($last4 != ''){
        //     $card_id =  'XXXX'.$last4;
        // }

        // return $card_id;
    }

    public function getBookedFirstName(){
        if($this->user_type == 'user'){
            return $this->user->firstname;
        }

        if($this->user_type == 'customer'){
            $fname = '';
            if( $this->customer ){
                $fname = $this->customer->fname;
            }
            return $fname;
        }
    }

    public function getBookedLastName(){
        if($this->user_type == 'user'){
            return $this->user->lastname;
        }

        if($this->user_type == 'customer'){
            $lname = '';
            if( $this->customer ){
                $lname = $this->customer->lname;
            }
            return $lname;
        }
    }
}