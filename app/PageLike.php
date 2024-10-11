<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageLike extends Model
{
    protected $table = 'page_like';
    protected $fillable = [
        'pageid','follower_id'      
    ];
}
