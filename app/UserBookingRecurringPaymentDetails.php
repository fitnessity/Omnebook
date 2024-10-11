<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class UserBookingRecurringPaymentDetails extends Model

{

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    public $timestamps = false;
    protected $table = 'user_booking_recurring_payment_details';
	protected $fillable = [
        'user_id', 'pmt_number', 'Amount','stripe_intent_id','user_order_details_id','status','person_type'
    ];


    /**

     * Get the user that owns the education.

     */
}

