<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;
class Plan extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'membership_plans';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function getPic(){
        $plan_pic = '';
        if(Storage::disk('s3')->exists($this->image)){
            $plan_pic = Storage::url($this->image);
        }
        return $plan_pic;
    }
}