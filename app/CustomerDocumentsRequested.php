<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;

class CustomerDocumentsRequested extends Model
{
  
	
	protected $table='customer_documents_requested';
	protected $guarded = [];  

	public function company() {
        return $this->belongsTo(CompanyInformation::class, 'business_id');
    }

    public function CustomersDocuments() {
        return $this->belongsTo(CustomersDocuments::class, 'doc_id');
    }
}
