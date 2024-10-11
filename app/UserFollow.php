<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserFollow extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_follow';

    // public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'follow_id',
        'follower_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function followinfo()
    {
        return $this->belongsTo(User::class, 'follow_id', 'id');
    }

    public function followerinfo()
    {
        return $this->belongsTo(User::class, 'follower_id', 'id');
    }

    public function getUser(){
       return  User::where('id',$this->user_id)->first();
    }     

    public function isfollow(){
        return count(UserFollow::where("follower_id",$this->user_id)->get());
    }
}