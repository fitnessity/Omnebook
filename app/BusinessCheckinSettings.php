<?php

namespace App;
use Carbon\Carbon;
use Storage;
use Illuminate\Database\Eloquent\Model;

class BusinessCheckinSettings extends Model
{
  
	
	protected $table='business_checkin_settings';
	protected $guarded = []; 

	protected $appends = ['welcome_cover', 'passcode_cover', 'alerts_photo_cover' , 'logo_image' ];


	public function getWelcomeCoverAttribute()
    {
        $pic = '';
        if(Storage::disk('s3')->exists($this->welcome_cover_photo) && $this->welcome_cover_photo){
            $pic = Storage::url($this->welcome_cover_photo);
        }else{
        	$pic = url('/dashboard-design/images/check-in-bg.jpg');
        }
        return $pic;
    }

    public function getPasscodeCoverAttribute()
    {
        $pic = '';
        if(Storage::disk('s3')->exists($this->passcode_cover_photo) && $this->passcode_cover_photo){
            $pic = Storage::url($this->passcode_cover_photo);
        }else{
        	$pic = url('/dashboard-design/images/u-login.png');
        }
        return $pic;
    }

    public function getAlertsPhotoCoverAttribute()
    {
        $pic = '';
        if(Storage::disk('s3')->exists($this->alerts_photo) && $this->alerts_photo){
            $pic = Storage::url($this->alerts_photo);
        }else{
        	$pic = url('/uploads/discover/thumb/1649648221-snow ski.jpg');
        }
        return $pic;
    }

    public function getLogoImageAttribute()
    {
        $pic = '';
        if(Storage::disk('s3')->exists($this->logo) && $this->logo){
            $pic = Storage::url($this->logo);
        }else{
            $pic = url('/images/fitnessity_logo1_black.png');
        }
        return $pic;
    }
}

?>