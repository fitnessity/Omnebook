<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CustomCientList extends Model
{
	protected $table='custom_client_list';
	protected $guarded = []; 

	public function Customer(){
		return $this->belongsTo(Customer::class ,'customer_id');
	}

	public function customList(){
		return $this->belongsTo(CustomList::class ,'custom_list_id');
	}
}

?>