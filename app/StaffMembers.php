<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffMembers extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'staff_members';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'image',
        'description',
    ];

    

    public static function getinstructorname($id)
    {
        $name = '—';
        $staff =  StaffMembers::select('name')->where('id', $id)->first();
        if($staff != ''){
            $name = $staff->name;
        }
        return $name;
    }
}
