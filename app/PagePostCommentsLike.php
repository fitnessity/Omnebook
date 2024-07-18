<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagePostCommentsLike extends Model
{
    protected $table = 'page_postcomments_like';
    protected $fillable = [
        'user_id','post_id','comment_id'     
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
