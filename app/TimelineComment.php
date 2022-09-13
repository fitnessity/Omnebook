<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class TimelineComment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = true;

    /**
     * Table Name
     *
     * @var array
     */
    public $table = 'timeline_feeds_comments';

    public $fillable = [
        'user_id',
        'feed_id',
        'content',
        'parent_id'
    ];

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
