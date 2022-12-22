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
        'business_id','fname','lname', 'email','birthdate', 'phone_number','profile_pic','password','username','gender','address','city','state','country','zipcode','status','notes','parent_cus_id','card_stripe_id','card_token_id','stripe_customer_id','terms_covid','terms_liability','terms_contract'
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

    protected $appends = ['age'];


    public function getAgeAttribute()
    {
        if($this->birthdate != null){
            return Carbon::parse($this->birthdate)->age;
        }else{
            return null;
        }
    }

    public function company_information()
    {
        return $this->belongsTo(CompanyInformation::class, 'business_id');
    }

    public function BookingStatus()
    {
        return $this->hasMany(UserBookingStatus::class,'user_id');
    }

    public static function getcustomerofthiscompany($companyId){
        return Customer::where('business_id', $companyId)->orderBy('fname', 'ASC')->get();
    }
    
    public function getimage(){
        if(File::exists(public_path("/customers/profile_pic/".$this->profile_pic)) && !empty($this->profile_pic) ){
            $html = '<img src="'.$this->profile_pic.'" class="imgboxes" alt="">';
        }else{
            $pf=substr($this->fname, 0, 1);
            $html = '<div class="company-list-text"><p>'.$pf.'</p></div>';
        }
        return $html;
    }

    public function getimageforviewpage(){
        if(File::exists(public_path("/customers/profile_pic/".$this->profile_pic)) && !empty($this->profile_pic) ){
            $html = '<img src="'.$this->profile_pic.'" class="imgboxes" alt="">';
        }else{
            $pf=substr($this->fname, 0, 1);
            $html = '<div class="company-list-text viewcustomelatterrimg"><p>'.$pf.'</p></div>';
        }
        return $html;
    }

    public function CustomerFamilyDetail()
    {
        return $this->hasMany(Customer::class, 'parent_cus_id');
    }

    public function get_families()
    {
        if($this->parent_cus_id){
            $parent = Customer::where('id',$this->parent_cus_id)->first();
            $familes = Customer::where('parent_cus_id', $parent->id)->where('id', '<>', $this->id)->get();
            $familes = $familes->merge(Customer::where('id',$this->parent_cus_id)->where('id', '<>', $this->id)->get());
            return $familes;
        }else{
            return Customer::where('parent_cus_id',$this->id)->get();
        }
    }
    
}
   