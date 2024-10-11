<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AnnouncementContactCustomerList extends Model
{
	protected $table='announcement_contact_customer_list';
	protected $guarded = []; 

	public function Customer(){
		return $this->belongsTo(Customer::class ,'customer_id');
	}

	public function announcement(){
		return $this->belongsTo(Announcement::class ,'announcement_id');
	}
}

?>