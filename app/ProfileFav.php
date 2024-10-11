<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use App\User;

class ProfileFav extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profile_favs';

    // public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'fav_user_id',
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