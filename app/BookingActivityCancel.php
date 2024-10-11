<?php

namespace App;



use App\User;
use Auth;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class BookingActivityCancel extends Model

{ 
	
	/**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    public $timestamps = true;
    protected $table = 'booking_activity_cancel';
	protected $fillable = [
        'booking_id', 'order_detail_id','cancel_charge_action','cancel_charge_amt','stripe_id'
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