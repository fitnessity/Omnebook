<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsiteIntegration extends Model
{
    //
    protected $table = 'website_integrations'; 
<<<<<<< HEAD
    protected $fillable = ['user_id','business_id','log_textcolor','log_bg_color','logo','background_img','reg_bg_color','reg_textcolor','default_country','default_state'];
=======
    protected $fillable = ['textcolor','bg_color','logo','background_img','default_country','default_state'];
>>>>>>> ce3ab0fefd0bf653e3a91b71d818121ea9ec8394

}
