<?php

namespace App;
use App\{User,Customer,SGMailService};
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
                            if($customer == ''){
                                $user = User::where('id', $statusData->user_id)->first();
                                $customer = Customer::create(['business_id'=>$userBookingDetail->business_id, 'user_id'=>$statusData->user_id ,'fname'=>$user->firstname,'lname'=>$user->lastname, 'username'=>$user->username ,'email'=>$user->email,'stripe_customer_id'=>$user->stripe_customer_id,]);
                            }
                            $id = @$customer->id;
                        }else{
                            $id= $userBookingDetail->user_id;
                        }
                    }
                    $model->instructor_id = @$userBookingDetail->business_services->instructor_id;
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
        'business_activity_scheduler_id', 'customer_id', 'booking_detail_id', 'checkin_date', 'checked_at', 'created_at', 'updated_at', 'use_session_amount', 'before_use_session_amount', 'after_use_session_amount', 'no_show_action', 'no_show_charged', 'source_type','booked_by_customer_id','instructor_id'
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

    public function instructor(){
        return $this->belongsTo(BusinessStaff::class,'instructor_id');
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

    public static function checkCustomerInClass($scheduleId,$date){
        $pos = strpos($date, ' ');
        $result = substr($date, 0, $pos);
        $checkInDetails = BookingCheckinDetails::where("business_activity_scheduler_id" , $scheduleId)->whereDate('checkin_date',date('Y-m-d',strtotime($date)))->whereNotNull('checked_at')->count();

        return $checkInDetails;
    }

    public function reminderaboutReservation(){
        $customer =  $this->Customer;
        if($customer){
            $company = $customer->company_information;
            $businessdata = $this->order_detail->business_services;
            $time = date('h:i a',strtotime($this->scheduler->shift_start));
            $date = date('m-d-Y', strtotime($this->checkin_date));
            $emailDetail = [
                "userdata"=>$customer,
                "pName"=>$businessdata->program_name,
                "companydata"=>$company,
                "time"=>$time,
                "date"=>$date,
                "email"=>$customer->email,
            ];
            SGMailService::sendEmailCustomerforReminder($emailDetail);
        }
    }

}