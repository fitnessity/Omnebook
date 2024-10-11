<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class AddOnService extends Model
{
	/**
	    * The database table used by the model.
	    *
	    * @var string
    */
    use SoftDeletes;
    protected $table = 'add_on_service';

    public $timestamps = false;
    
    /**
     	* The attributes that are mass assignable.
     	*
     	* @var array
    */

    protected $fillable = [
        'user_id',
        'cid',
        'serviceid',
        'category_id',
        'service_price',
        'service_description',
		'service_name',
    ];
    
    public function BusinessPriceDetailsAges()
    {
        return $this->belongsTo(BusinessPriceDetailsAges::class ,'category_id');
    }
}