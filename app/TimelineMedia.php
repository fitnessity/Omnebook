<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Timeline;

class TimelineMedia extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'timeline_feeds_media';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'feed_id',
        'media_type',
        'media_path'
    ];

    /**
     * Timline Feed
     *
     */
    public function timelineFeed()
    {
        return $this->belongsTo(Timeline::class);
    }

    /**
     * get all favorite media of user
     *
     * @param array $user_id
     * @return array
     * Created on 09/05/18 by Rk
     */
    public static function getUserFavoriteMedia($user_id)
    {
        return TimelineMedia::where(['user_id' => $user_id, 'favorite' => 1, 'media_type' => 1])->pluck('media_path', 'id');
    }
}
