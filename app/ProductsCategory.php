<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsCategory extends Model
{
  
	
	protected $table='products_category';
	protected $guarded = [];  

	public function getCategoryProductCount($business_id){
		
		return Products::where('business_id',$business_id)->where('category', '!=', '')->whereRaw("FIND_IN_SET(?, category)", [$this->id]);

	}
}

?>