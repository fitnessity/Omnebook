<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserFamilyDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //public $timestamps = false;

    /**
     * Get the user that owns the task.
     */
	 protected $fillable = [
       'user_id', 'first_name', 'last_name','email', 'mobile','emergency_contact','emergency_contact_name','relationship','gender','birthday',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
