<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserMembership extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;

    /**
     * Get the user that owns the task.
     */
    public function membershipPlan()
    {
        return $this->belongsTo(MembershipPlan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
