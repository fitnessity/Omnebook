<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class CompanyRevenueGoalTracker extends Model
{
	
	protected $table='company_revenue_goal_tracker';
	protected $guarded = [];  

	public function company() {
        return $this->belongsTo(CompanyInformation::class, 'business_id');
    }

}
