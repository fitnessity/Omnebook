<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageAttachment extends Model
{
   	protected $table = 'page_attachment';
    protected $fillable = [
        'page_id','user_id','attachment_name','attachment_data','attachment_status','cover_photo','cover_order'       
    ];
}
