<?php

namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\CompanyInformation;
use File;

use Carbon\Carbon;

class Customer extends Authenticatable
{

	use  Notifiable;

	protected $table = 'customers';
	/**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'business_id','fname','lname', 'email','birthdate', 'phone_number','profile_pic','password','username','gender','address','city','state','country','zipcode','status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function company_information()
    {
        return $this->belongsTo(CompanyInformation::class, 'business_id');
    }

    public static function getcustomerofthiscompany($companyId){
        return Customer::where('business_id', $companyId)->orderBy('fname', 'ASC')->get();
    }
    
    public function getimage(){
        if(File::exists(public_path("/customers/images/".$this->profile_pic)) && !empty($this->profile_pic) ){
            $html = '<img src="'.$this->profile_pic.'" class="imgboxes" alt="">';
        }else{
            $pf=substr($this->fname, 0, 1);
            $html = '<div class="company-list-text"><p>'.$pf.'</p></div>';
        }
        return $html;
    }

    public function getcustage(){
        return Carbon::parse($this->birthdate)->age;
    }

    public function CustomerFamilyDetail()
    {
        return $this->hasMany(CustomerFamilyDetail::class, 'cus_id');
    }
    
}
   