<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserNetwork extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // public $timestamps = false;

    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function friendinfo()
    {
        return $this->belongsTo(User::class, 'friend_id', 'id');
    }

}
