<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class CustomersDocuments extends Model
{
  
	
	protected $table='customers_documents';
	protected $guarded = [];  
	protected $appends = ['uploaded_by'];

	public function getUploadedByAttribute(){
		if($this->staff_id){
			return $this->BusinessStaff->full_name;
		}
        return $this->user->full_name;
    }

	public function company() {
        return $this->belongsTo(CompanyInformation::class, 'business_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function BusinessStaff(){
        return $this->belongsTo(BusinessStaff::class, 'staff_id');
    }

    public function CustomerDocumentsRequested(){
        return $this->hasMany(CustomerDocumentsRequested::class, 'doc_id');
    }

    public function checkUploadDocument(){
        $docrRequest = $this->CustomerDocumentsRequested;
        foreach ($docrRequest as $value) {
            if (empty($value->path)) {
                return false;
            }
        }
        return true;
    }
}
