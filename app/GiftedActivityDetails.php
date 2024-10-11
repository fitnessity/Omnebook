<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use DateTime;

class GiftedActivityDetails extends Model
{
	 /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'gifted_activity_details';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'userid','priceid','odid','schedual_date','email','price_show_chk','gift_from','comment'
    ];

}