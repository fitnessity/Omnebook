<?php
namespace App;

use App\AddrStates;
use Illuminate\Database\Eloquent\Model;

class Evidents extends Model
{
    protected $table = 'user_evident';
    protected $fillable = ['user_id','userIdentityToken','idOwnerId','business_email','other_data','status','evident_id'];
}