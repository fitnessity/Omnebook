<?php

namespace App;
use App\User;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class BusinessStaff extends Model
{
    //
    use SoftDeletes;
    public $timestamps = false;
    protected $table = 'business_staff';
    protected $fillable = [
       'id','business_id','first_name','last_name','phone','email','position','password','address','city','state','postcode','birthdate','bio','status','gender','profile_pic','buddy_key','unique_code'
    ];
    protected $appends = ['profile_pic_url','full_name'];

    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
    }

     public function getProfilePicUrlAttribute()
    {
        if(Storage::disk('s3')->exists($this->profile_pic)){
            return Storage::url($this->profile_pic);
        }
    }

    public static function getinstructorname($id)
    {
        $name = '—';
        $staff =  BusinessStaff::select('first_name','last_name')->where('id', $id)->first();
        if($staff != ''){
            $name = $staff->first_name.' '.$staff->last_name;
        }
        return $name;
    }

    public function BusinessServices(){
        return $this->hasMany(BusinessServices::class,'instructor_id');
    }

    public function CompanyInformation(){
        return $this->belongsTo(CompanyInformation::class , 'business_id');
    }
}
