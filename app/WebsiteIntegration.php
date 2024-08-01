<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsiteIntegration extends Model
{
    //
    protected $table = 'website_integrations'; 
    protected $fillable = ['textcolor','bg_color','logo','background_img','default_country','default_state'];

}
