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

    public function getSoldProducts(){
        $totalQty = 0;
        $details = UserBookingDetail::whereRaw("FIND_IN_SET(?, productIds)", [$this->id])->get();
        foreach ($details as  $value) {
            $products = explode(',', $value->productIds);
            $qtyList = explode(',', $value->productQtys);

            $key = array_search((string) $this->id, $products);
            if ($key !== false) {
                $totalQty += $qtyList[$key];
            }
        } 

        $reminingQty = $this->quantity - $totalQty;
        $reminingQty =  $reminingQty > 0 ? $reminingQty : 0;

        return $reminingQty;  
    }
}
