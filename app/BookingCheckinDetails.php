<?php

namespace App;



use App\User;
use Auth;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class BookingCheckinDetails extends Model

{ 
	
    public static function boot(){
        parent::boot();

        self::creating(function($model){
            if($model->booking_detail_id){
                $userBookingDetail = UserBookingDetail::findOrFail($model->booking_detail_id);
                $model->before_use_session_amount = $userBookingDetail->getremainingsession();
                $model->after_use_session_amount = $model->before_use_session_amount - $model->use_session_amount;
            }
        });

        self::updating(function($model){
            // ... code here
            if($model->booking_detail_id){
                $userBookingDetail = UserBookingDetail::findOrFail($model->booking_detail_id);
                $model->before_use_session_amount = $userBookingDetail->getremainingsession();
                $model->after_use_session_amount = $model->before_use_session_amount - $model->use_session_amount;
            }
        });
    }
	/**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    public $timestamps = false;
    protected $table = 'booking_checkin_details';
	protected $fillable = [
        'business_activity_scheduler_id', 'customer_id', 'booking_detail_id', 'checkin_date', 'checked_at', 'created_at', 'updated_at', 'use_session_amount', 'before_use_session_amount', 'after_use_session_amount', 'no_show_action', 'no_show_charged',
    ];


    public function UserBookingDetail(){
        return $this->belongsTo(UserBookingDetail::class,'booking_detail_id');
    }

    public function scheduler(){
        return $this->belongsTo(BusinessActivityScheduler::class,'business_activity_scheduler_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function order_detail(){
        return $this->belongsTo(UserBookingDetail::class,'booking_detail_id');
    }

    public function status_term(){
        return $this->checked_at ? "Checked In" : "Unchecked";
    }

}