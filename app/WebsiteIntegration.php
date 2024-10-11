<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsiteIntegration extends Model
{
    //
    protected $table = 'website_integrations'; 
    protected $fillable = ['user_id','business_id','schedule_label','schedule_label_color','date_color','log_textcolor','log_bg_color','logo','background_img','reg_bg_color','reg_textcolor','default_country','default_state','primary_color','secondary_color','font','button_text','button_style','filters','reg_back_color','schedule_back_color'];


}
