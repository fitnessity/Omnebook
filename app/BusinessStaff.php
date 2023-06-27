<?php

namespace App;
use App\User;
use Auth;
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
       'id','business_id','first_name','last_name','phone','email','position','password','address','city','state','postcode','birthdate','bio','status','gender','profile_pic'
    ];
    protected $appends = ['full_name'];

    public function getFullNameAttribute(){
        return $this->first_name . ' ' . $this->last_name;
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
}
