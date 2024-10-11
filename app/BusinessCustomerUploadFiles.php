<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class BusinessCustomerUploadFiles extends Model
{
  
	
	protected $table='business_customer_upload_files';
	protected $guarded = []; 
	protected $fillable = [
        'user_id',
        'business_id',
        'file',
		'status',
		'num_records',
		'is_error',
		'chunks_processed',
		'total_chunks',
    ];
}
?>