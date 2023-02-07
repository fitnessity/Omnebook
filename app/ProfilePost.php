<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfilePost extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string     */

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_text','images','user_id','video','music'        
    ];

    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }
}