<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCommentLike extends Model
{
	protected $table = 'post_comments_like';
    protected $fillable = ['user_id','post_id','comment_id']; 
}
