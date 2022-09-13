<?php
namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserBookingQuote extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    public $timestamps = false;

    /**
     * Get the user that owns the education.
     */
    public function UserBookingStatus()
    {
        return $this->belongsTo(UserBookingStatus::class, 'booking_id');
    }
    
    public function BookingQuoteUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
