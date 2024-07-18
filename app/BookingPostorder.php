<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Customer;

class BookingPostorder extends Model
{
    protected $fillable = [
        'business_activity_scheduler_id', 'customer_id', 'booked_at'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
