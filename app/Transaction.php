<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // public $timestamps = false;
    protected $table = 'transaction';
    
    public $timestamps = true;
	
	protected $fillable = [
        'user_type', 'user_id', 'item_type','item_id', 'channel','kind','transaction_id','amount','qty','status','refund_amount',
		'payload'
    ];

    /**
     * Get the user that owns the task.
     */

    public function UserBookingStatus(){
        return $this->belongsTo(UserBookingStatus::class,'item_id');
    }

    public function Recurring(){
        return $this->belongsTo(Recurring::class,'item_id');
    }

    public function getPmtMethod(){
        $pmt_by = $this->kind;
        if($pmt_by == 'card'){
            $data = json_decode($this->payload);
            $cardData = $data->charges->data[0]->payment_method_details->card;
            $last4 =  $cardData->last4;
            $brand = $cardData->brand;
            return $brand.' ****'.$last4;
        }else{
            return $pmt_by;
        }
    }

    public function item_type_terms(){
        if($this->item_type == 'UserBookingStatus'){
            return 'Membership';
        }if($this->item_type == 'Recurring'){
            return 'Auto Pay';
        }else{
            return 'Product';
        }
    }


    public function item_description(){
        $itemDescription = '';
        if($this->item_type == 'UserBookingStatus'){
            $bookingData = $this->userBookingStatus->UserBookingDetail;
            if(!empty($bookingData)){
                foreach($bookingData as $bd){
                    $activityName = $bd->business_services->program_name;
                    $categoryName = $bd->business_price_detail->business_price_details_ages->category_title;
                    $priceOption = $bd->business_price_detail->price_title;
                    $itemDescription .= $activityName.' ('.$categoryName.') ,'.$priceOption.'<br>';
                }
            }
            //echo $booking_data;exit();
        }else if ($this->item_type == 'Recurring') {
            $bookingData = $this->Recurring->UserBookingDetail;
            if($bookingData != ''){
                $activityName = $bookingData->business_services->program_name;
                $categoryName = $bookingData->business_price_detail->business_price_details_ages->category_title;
                $priceOption = $bookingData->business_price_detail->price_title;
                $itemDescription = $activityName.' ('.$categoryName.') ,'.$priceOption;
            }
        }
        return $itemDescription;
    }
}