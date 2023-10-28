<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class Products extends Model
{
  
	
	protected $table='products';
	//protected $fillable = ['user_id','business_id','name','description','gallery','policy_returning'];  
	protected $guarded = [];  

	public function company() {
        return $this->belongsTo(CompanyInformation::class, 'business_id');
    }

    public function getPic(){
    	$profile_pic = '';
        if(Storage::disk('s3')->exists($this->product_image)){
            $profile_pic = Storage::url($this->product_image);
        }

        return $profile_pic;
    }
}
