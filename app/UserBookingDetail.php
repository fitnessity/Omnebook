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
		'price','qty', 'bookedtime','payment_number','participate'
    ];


    /**

     * Get the user that owns the education.

     */

    public function UserBookingStatus()

    {

        return $this->belongsTo(UserBookingStatus::class, 'booking_id');

    }

    public function BookingSport()

    {

        return $this->belongsTo(Sports::class, 'sport');

    }

}

