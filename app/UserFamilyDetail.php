<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Storage;

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
       'user_id', 'first_name', 'last_name','email', 'mobile','emergency_contact','emergency_contact_name','relationship','gender','birthday','profile_pic'
    ];

    protected $appends = ['full_name','age', 'first_letter','profile_pic_url'];

    public function getAgeAttribute()
    {
        if($this->birthday != null){
            return Carbon::parse($this->birthday)->age;
        }else{
            return null;
        }
    }

    public function getProfilePicUrlAttribute()
    {
        $profile_pic = '';
        if(Storage::disk('s3')->exists($this->profile_pic)){
            $profile_pic = Storage::url($this->profile_pic);
        }

        return $profile_pic;
    }
    
    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getFirstLetterAttribute(){
        return $this->first_name[0] . '' . $this->last_name[0];
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
