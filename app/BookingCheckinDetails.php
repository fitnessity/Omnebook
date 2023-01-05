<?php

namespace App;



use App\User;
use Auth;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class BookingCheckinDetails extends Model

{ 
	
	/**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    public $timestamps = false;
    protected $table = 'booking_checkin_details';
	protected $fillable = [
        'booking_id', 'order_detail_id','checkin','checkin_date'
    ];

     /**

     * Get the user that owns the education.

     */
    public function UserBookingStatus(){
        return $this->belongsTo(UserBookingStatus::class,'booking_id');
    }

    public function UserBookingDetail(){
        return $this->belongsTo(UserBookingDetail::class,'order_detail_id');
    }

}