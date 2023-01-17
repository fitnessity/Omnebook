<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserBookingStatus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // public $timestamps = false;
    protected $table = 'user_booking_status';
	
	protected $fillable = [
        'booking_type', 'user_id', 'customer_id', 'business_id','status','service_id','rejected_reason','stripe_id','stripe_status',
		'currency_code','amount', 'order_id', 'bookedtime','user_type','pmt_method','pmt_json','retrun_cash','order_type'
    ];

    /**
     * Get the user that owns the task.
     */

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

    public function businessuser()
    {
        return $this->belongsTo(User::class, 'business_id');
    }

    public function UserBookingDetail()
    {
        return $this->hasMany(UserBookingDetail::class, 'booking_id');
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

    public function getstripedata(){
        $stripe = new \Stripe\StripeClient(
            config('constants.STRIPE_KEY')
        );

        $last4 = '';
        $pmt_type = '';
        $stripe_id = $this->stripe_id;
        if($stripe_id != ''){
            $payment_intent = $stripe->paymentIntents->retrieve(
                $stripe_id,
                []
            );
            $last4 = $payment_intent['charges']['data'][0]['payment_method_details']['card']['last4'];
        }

        if($last4 == ''){
            $pmt_type_json = json_decode($this->pmt_json,true);
            if($pmt_type_json['pmt_by_check'] != 0){
                $pmt_type = 'Check No: '.$pmt_type_json['check_no'];
            }else if($pmt_type_json['pmt_by_comp'] != 0){
                $pmt_type = 'Comp';
            }else{
                $pmt_type = 'Cash';
            }
        }else{
            $pmt_type =  'CC ending in ********'.$last4;
        }

        return $pmt_type;
    }

}