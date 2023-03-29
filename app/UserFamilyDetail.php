<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    protected $appends = ['full_name','age'];

    public function getAgeAttribute()
    {
        if($this->birthday != null){
            return Carbon::parse($this->birthday)->age;
        }else{
            return null;
        }
    }
    
    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAge(){
        if($this->birthday != null){
            return Carbon::parse($this->birthday)->age;
        }else{
            return null;
        }
    }


}
