<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartWidget extends Model
{
    //
    protected $fillable = ['user_id','business_service_id','type','name','code','image','adult','child','infant','actscheduleid','session_date','total_price','priceid','participate','tax','discount','tip','notes','participate_from_checkout_regi','chk','categoryid','p_session','repeateTimeType','everyWeeks','monthDays','enddate','activity_days','addOnServicesId','addOnServicesQty','addOnServicesTotalPrice'];
    protected $table = 'cart_widgets';
}
