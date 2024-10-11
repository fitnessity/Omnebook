<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagePostLikes extends Model
{
	protected $table = 'page_post_likes';
    protected $fillable = ['user_id','post_id','is_like']; 

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
