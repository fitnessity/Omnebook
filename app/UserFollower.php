<?php

namespace App;

use App\User;
use App\Sports;
use Illuminate\Database\Eloquent\Model;
use DB;

class UserFollower extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_follower';

    // public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'follower_id'
    ];


    public function followed()
    {
        return $this->belongsTo(User::class);
    }

    public function followers(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function followings(){
        return $this->hasOne(User::class, 'id', 'follower_id');
    }

    public static function checkUserFollow($user_id, $follower_id)
    {
        $user = UserFollower::SELECT('*')->WHERE('user_id', $user_id)->WHERE('follower_id', $follower_id)->first();

        return $user;
    }

	public static function AddUserFollow($user_id, $follower_id)
    {
        $user = new UserFollower();
        $user->user_id = $user_id;
        $user->follower_id = $follower_id;
        if($user->save()){

        	$res = array(
                'type' => 'success',
                'msg' => 'Followed successfully',
                'title' => 'Unfollow',
                'followid' => $user->id
            );
        } else {
        	$res = array(
                'type' => 'danger',
                'msg' => 'Selected user not found',
                'title' => 'Follow'
            );
        }
        return $res;
    }    

    public static function unFollowUser($user_id, $follower_id)
    {
        // $user = UserFollower::where('user_id', $user_id)->where('follower_id', $follower_id)->first();
        $user = DB::table('user_follower')->select('id')->where('user_id', $user_id)->where('follower_id', $follower_id)->first();

        $status = 0;

        if(isset($user) && count($user) > 0 ){
            $status = UserFollower::where('user_id', $user_id)->where('follower_id', $follower_id)->delete();
			// $status = $user->delete();        	
        }

        if($status){
        	$res = array(
                'type' => 'success',
                'msg' => 'Unfollowed successfully',
                'title' => 'Follow',
                'followid' => $user->id
            );
        }else {
        	$res = array(
                'type' => 'danger',
                'msg' => 'Selected user not found',
                'title' => 'Unfollow'
            );
        }
        return $res;
    }

    public static function getFollowersId($user_id){
        $user = UserFollower::SELECT('id')->WHERE('user_id', $user_id)->get();
        return $user;
    }
}
