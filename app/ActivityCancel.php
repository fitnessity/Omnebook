<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use DateTime;

class ActivityCancel extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'activity_cancel';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'schedule_id',
        'cancel_date',
        'show_cancel_on_schedule',
        'hide_cancel_on_schedule',
        'email_Instructor',
        'email_clients',
        'cancel_date_chk',
        'act_cancel_chk',
    ];


    public static function findById($id){
        return ActivityCancel::where('id',$id)->first();
    }

}

  