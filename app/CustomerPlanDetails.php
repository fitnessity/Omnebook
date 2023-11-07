<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerPlanDetails extends Model
{
  
	
	protected $table='customer_plan_details';  
	protected $guarded = [];  

	public function company() {
        return $this->belongsTo(CompanyInformation::class, 'business_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
