<?php

namespace App;
use App\User;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class BusinessPositions extends Model
{
    //use SoftDeletes;
    public $timestamps = true;
    protected $table = 'business_positions';
    protected $fillable = [
       'id','user_id','business_id','name'
    ];
   
    
    public function CompanyInformation(){
        return $this->belongsTo(CompanyInformation::class,'business_id');
    }
}
