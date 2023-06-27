<?php

namespace App;



use App\{User,Customer};
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
                if($userBookingDetail != ''){
                    $statusData = $userBookingDetail->userBookingStatus;
                    if($statusData != ''){
                        if($statusData->user_type == 'customer'){
                            $customer = Customer::where(['business_id'=>$userBookingDetail->business_id, 'user_id'=>$statusData->user_id])->first();
                            $id = @$customer->id;
                        }else{
                            $id= $userBookingDetail->user_id;
                        }
                    }
                }
                $id = @$id != '' ? @$id : 0;
                $model->booked_by_customer_id = $id;
            }else{
                $model->before_use_session_amount = 0;
                $model->after_use_session_amount = 0;
                $model->booked_by_customer_id =0;
            }
        });

        self::updating(function($model){
            // ... code here
            if($model->booking_detail_id){
                $userBookingDetail = UserBookingDetail::findOrFail($model->booking_detail_id);
                $model->before_use_session_amount = $userBookingDetail->getremainingsession();
                $model->after_use_session_amount = $model->before_use_session_amount - $model->use_session_amount;
            }else{
                $model->before_use_session_amount = 0;
                $model->after_use_session_amount = 0;
            }
        });

        self::updated(function($model){
            if($model->no_show_action == 'charge_fee'){
                $model->customer->charge($model->no_show_charged);
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
        'business_activity_scheduler_id', 'customer_id', 'booking_detail_id', 'checkin_date', 'checked_at', 'created_at', 'updated_at', 'use_session_amount', 'before_use_session_amount', 'after_use_session_amount', 'no_show_action', 'no_show_charged', 'source_type','booked_by_customer_id',
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
        if($this->checked_at){
            return 'Checked In';
        }

        if($this->no_show_action){
            return 'No Show';
        }
    }

}