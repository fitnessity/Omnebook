<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsCategory extends Model
{
  
	
	protected $table='products_category';
	protected $guarded = [];  

	public function getCategoryProductCount(){
		
		return Products::where('category', '!=', '')->whereRaw("FIND_IN_SET(?, category)", [$this->id]);

	}
}

?>