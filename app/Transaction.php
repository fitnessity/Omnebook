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
	
	protected $fillable = [
        'user_type', 'user_id', 'item_type','item_id', 'channel','kind','transaction_id','amount','qty','status','refund_amount',
		'payload'
    ];

    /**
     * Get the user that owns the task.
     */

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
}