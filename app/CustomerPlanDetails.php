<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CustomerPlanDetails extends Model
{
  
	
	protected $table='customer_plan_details';  
	protected $guarded = [];  

    public static function boot(){
        parent::boot();

        self::creating(function($model){
            $dateTimeComponents = Carbon::now()->format('ymdHisu');
            $model->invoice_no ="#FT".$dateTimeComponents;
        });

    }

	public function company() {
        return $this->belongsTo(CompanyInformation::class, 'business_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function plan() {
        return $this->belongsTo(Plan::class, 'plan_id');
    }

    public function autoPayment(){
        $plan = Plan::where('price_per_month',0)->first();
        $eDate = Carbon::now()->addMonth()->format('Y-m-d');
        $sDate = Carbon::now()->format('Y-m-d');
        CustomerPlanDetails::create([
            'user_id' => $this->user_id,
            'plan_id' => $plan->id,
            'amount' => 0,
            'starting_date' => $sDate,
            'expire_date' => $eDate,
            'payment_for' => 'month',
            'price' => 0,
            'discount' =>  0,
        ]);
    }
}
