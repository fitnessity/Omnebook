<?php

namespace App;
use App\User;
use Auth;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class BusinessStaff extends Model
{
    //

    public $timestamps = true;
    protected $table = 'business_staff';
    protected $fillable = [
       'id','business_id','first_name','last_name','phone','email','position'
    ];

    public static function getinstructorname($id)
    {
        $name = '—';
        $staff =  BusinessStaff::select('first_name','last_name')->where('id', $id)->first();
        if($staff != ''){
            $name = $staff->first_name.' '.$staff->last_name;
        }
        return $name;
    }
}
