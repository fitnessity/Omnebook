<?php

namespace App;

use App\Customer;
use Illuminate\Database\Eloquent\Model;

class CustomerFamilyDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'customers_family_details';
    //public $timestamps = false;

    /**
     * Get the user that owns the task.
     */
	 protected $fillable = [
       'cus_id', 'first_name', 'last_name','email', 'mobile','emergency_contact','emergency_contact_name','relationship','gender','birthday',
    ];

    public function customer()
    {
        return $this->belongsToMany(Customer::class,'cus_id');
    }
}
