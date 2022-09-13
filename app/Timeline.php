<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\TimelineLike;
use App\User;
use App\TimelineShareFeed;
use App\TimelineMedia;
use App\TimelineComment;
use App\TimelineReportedFeed;


class Timeline extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'timeline_feeds';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'content',
        'feed_type',
        'original_post_id',
        'is_shared'
    ];

    public function getFeedShareDetails()
    {

    }

    /**
     * User Relation 
     *
     */
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Timline Like Relation 
     *
     */
    public function TimelineLike()
    {
        return $this->hasMany(TimelineLike::class, 'feed_id');
    }

    /**
     * Share Feeds Relation 
     *
     */
    public function shareFeeds()
    {
        return $this->hasOne(TimelineShareFeed::class, 'feed_id');
    }

    /**
     * Share Feeds Relation 
     *
     */
    public function timelineMedia()
    {
        return $this->hasMany(TimelineMedia::class, 'feed_id');
    }

    public function getMediaFileFullPathByFeedId($feedId)
    {
        return $this->with('timelineMedia')->where(['id' => $feedId])->first();
    }

    /**
     * Share Feeds Relation 
     *
     */
    public function timelineComments()
    {
        return $this->hasMany(TimelineComment::class, 'feed_id')->orderBy('parent_id', 'asc')->orderBy('id','asc');
    }

    public function timelineReportFeed(){
        return $this->hasMany(TimelineReportedFeed::class, 'feed_id');
    }

    /**
     * Share Feeds Relation 
     *
     */
    public function sharedFeed()
    {
        return $this->hasOne(Timeline::class, 'original_post_id');
    }

}
