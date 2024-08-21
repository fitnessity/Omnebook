<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsiteIntegration extends Model
{
    //
    protected $table = 'website_integrations'; 
    protected $fillable = ['user_id','business_id','log_textcolor','log_bg_color','logo','background_img','reg_bg_color','reg_textcolor','default_country','default_state'];


}
