<?php

namespace App;



use App\User;

use Illuminate\Database\Eloquent\Model;



class UserBookingDetail extends Model

{

    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    public $timestamps = false;
    protected $table = 'user_booking_details';
	protected $fillable = [
        'booking_id', 'sport', 'booking_detail','zipcode','quote_by_text','quote_by_email','note','schedule','act_schedule_id','priceid',
		'price','qty', 'bookedtime','payment_number','participate','provider_amount','provider_transaction_id','provider_transaction_id'
    ];


    /**

     * Get the user that owns the education.

     */

    public function UserBookingStatus()

    {

     	//return $this->belongsTo(UserBookingStatus::class, 'booking_id');
		return $this->belongsToMany(UserBookingStatus::class, 'booking_id'); ///nnn 22-10-2022
    }

    public function BookingSport()

    {

        return $this->belongsTo(Sports::class, 'sport');

    }

}

