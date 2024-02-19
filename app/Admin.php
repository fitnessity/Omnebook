<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon;
use Storage;
use App\StripePaymentMethod;
use Auth;

class Admin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table='admin';

    protected $guarded = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
  
    public $timestamps = false;
    

    public function getFullNameAttribute(){
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getFirstLetterAttribute(){
        if($this->firstname != '' && $this->lastname != '' ){
            return $this->firstname[0] . '' . $this->lastname[0];
        }else if($this->firstname != ''){
           return $this->firstname[0];
        }else{
            return 'F';
        }
    }

    public function getPic(){
       $profile_pic = '';
        if(Storage::disk('s3')->exists($this->profile_pic)){
            $profile_pic = Storage::url($this->profile_pic);
        }

        return $profile_pic;
    }

    public function getaddress(){
        $address = '';
        if($this->address != ''){
            $address .= $this->address.', ';
        }
        if($this->city != ''){
            $address .= $this->city.', ';
        }
        if($this->state != ''){
            $address .= $this->state.', ';
        }
        if($this->country != ''){
            $address .= $this->country.', ';
        }
        if($this->zipcode != ''){
            $address .= $this->zipcode;
        }
        return $address;
    }
}
