<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Timeline;
use App\TimelineComment;

class TimelineReportedFeed extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'timeline_feeds_report';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'feed_id',
        'comment_id',      
        'feed_owner_id',
        'comment_owner_id',
        'report_notes'
    ];

     /**
     * User Relation 
     *
     */
    public function reportedBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Timline Feed Relation 
     *
     */
    public function reportedFeed()
    {
        return $this->belongsTo(Timeline::class, 'feed_id');
    }

  
    public function feedOwner()
    {
        return $this->belongsTo(User::class, 'feed_owner_id');
    }


    /**
     * Timline Feed Comment Relation 
     *
     */
    public function reportedComment()
    {

        return $this->belongsTo(TimelineComment::class, 'comment_id');
    }


    public function commentOwner()
    {
        return $this->belongsTo(User::class, 'comment_owner_id');
    }
}
