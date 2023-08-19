<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagePostComments extends Model
{
    protected $table = 'page_postcomments';
    protected $fillable = [
        'user_id','post_id','comment'     
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
