<?php

namespace App;
use App\User;
use Auth;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class BusinessStaff extends Model
{
    //

    public $timestamps = false;
    protected $table = 'business_staff';
    protected $fillable = [
       'id','business_id','first_name','last_name','phone','email','position'
    ];
}
