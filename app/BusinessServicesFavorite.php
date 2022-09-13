<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessServicesFavorite extends Model
{
    protected $table = 'business_services_favorite';
    protected $fillable = [
        'service_id','user_id'      
    ];
}
