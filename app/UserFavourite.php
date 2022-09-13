<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserFavourite extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_favourite';

    // public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'favourite_user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function favouriteinfo()
    {
        return $this->belongsTo(User::class, 'favourite_user_id', 'id');
    }
}