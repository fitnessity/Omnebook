<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\UserBookingDetail;
class Fit_Cart extends Model
{
    public $timestamps = false;
    protected $table = 'fit_carts';
    protected $fillable = ['user_id','duestaxpercentage','salestaxpercentage','price','fit_date','numberofpersons','fit_time','service_choice','booking_id'];

    public function time(){
        return $this->belongsTo('App\UserBookingDetail','booking_id','booking_id');
    }
}