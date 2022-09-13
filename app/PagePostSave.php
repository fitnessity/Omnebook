<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagePostSave extends Model
{
    protected $table = 'page_post_save';
    protected $fillable = ['page_id','post_id','user_id']; 
}
