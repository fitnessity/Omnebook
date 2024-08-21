<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Storage;
use DB;
use Carbon\Carbon;

class BusinessServicesFaq extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'business_services_faq';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
   
    protected $guarded = [];  

  
    public function businessServices() {
        return $this->belongsTo(BusinessServices::class, 'service_id');
    }

    
}
