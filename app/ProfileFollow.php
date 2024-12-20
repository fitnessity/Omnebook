<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\User;

class ProfileFollow extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profile_followers';

    // public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'follower_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function followinfo()
    {
        return $this->belongsTo(User::class, 'follow_id', 'id');
    }
}