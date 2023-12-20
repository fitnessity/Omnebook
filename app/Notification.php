<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notification';
    /*protected $fillable = [
        'user_id','sender_id','type','notification_type','status','created_at','updated_at'   
    ];*/

    protected $guarded = [];  

    public function CustomerNotes(){
        return $this->belongsTo(CustomerNotes::class,'table_id');
    }

    public function CustomersDocuments(){
        return $this->belongsTo(CustomersDocuments::class,'table_id');
    }

    public function Customer(){
        return $this->belongsTo(Customer::class,'table_id');
    }

    public function CustomerDocumentsRequested(){
        return $this->belongsTo(CustomerDocumentsRequested::class,'table_id');
    }
}
