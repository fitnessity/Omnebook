<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessClassPriceDetails extends Model
{

	/**
     * The database table used by the model.
     *
     * @var string
     */
    use SoftDeletes;
    protected $table = 'business_class_price_option';

    public $timestamps = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array


    */
    protected $guarded = [];


    public function companyInformation(){
        return $this->belongsTo(CompanyInformation::class, 'business_id'); 
    }

    public function businessServices(){
        return $this->belongsTo(BusinessServices::class, 'serviceid'); 
    }

     public function businessPriceDetails(){
        return $this->belongsTo(BusinessPriceDetails::class, 'price_id');
    }

}