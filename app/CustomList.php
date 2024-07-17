<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CustomList extends Model
{
  
	
	protected $table='custom_list';
	protected $guarded = []; 

	public static function boot(){
        parent::boot();

        static::deleting(function($list) {
            $list->customCientList->each(function($customer) {
                $customer->delete();
            });
        });
    }

	public function customCientList(){
		return $this->hasMany(CustomCientList::class ,'custom_list_id');
	}
}

?>