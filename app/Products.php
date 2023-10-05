<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
  
	
	protected $table='products';
	//protected $fillable = ['user_id','business_id','name','description','gallery','policy_returning'];  
	protected $guarded = [];  

	public function company() {
        return $this->belongsTo(CompanyInformation::class, 'business_id');
    }
}
