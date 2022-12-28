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
        'booking_type', 'user_id', 'business_id','status','service_id','rejected_reason','stripe_id','stripe_status',
		'currency_code','amount', 'order_id', 'bookedtime','user_type','pmt_method','pmt_json','retrun_cash','order_type'
    ];

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class,'user_id');
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
}