<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Timeline;

class TimelineShareFeed extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'timeline_feeds_share';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'feed_id',
        'original_feed_id',
        'feed_owner_id'
    ];

     /**
     * User Relation 
     *
     */
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Timline Feed Relation 
     *
     */
    public function timelineFeed()
    {
        return $this->belongsTo(Timeline::class, 'feed_id');
    }
}
