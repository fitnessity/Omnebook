<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagePost extends Model
{
	protected $table = 'page_posts';
    protected $fillable = [
        'page_id','user_id','post_text','images','video','music'        
    ];

    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }
}
