<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyInformation extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'company_informations';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'contact_number',
        'logo',
        'company_name',
        'city',
        'state',
        'zip_code',
        'address',
        'country',
        'ein_number',
        'establishment_year',
        'business_user_tag',
        'about_company',
        'short_description',
        'latitude',
        'longitude',
        'website',
        'dba_business_name',
        'additional_address',
        'neighborhood',
        'business_phone',
        'business_email',
        'business_website',
        "stripe_connect_id",
        "charges_enabled",
        "business_added_by_cust_name",
        "is_verified",
    ];

    public function employmenthistory() {
        return $this->hasMany(UserEmploymentHistory::class, 'company_id');
    }

    public function education() {
        return $this->hasMany(UserEducation::class, 'company_id');
    }

    public function users() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function certification() {
        return $this->hasMany(UserCertification::class, 'company_id');
    }

    /*public function service() {
        return $this->hasMany(UserService::class, 'company_id');
    }*/
	public function service() {
        return $this->hasMany(BusinessServices::class, 'cid');
    }

    public function skill() {
        return $this->hasMany(UserSkillAward::class, 'company_id');
    }

    public function ProfessionalDetail() {
        return $this->hasOne(UserProfessionalDetail::class, 'company_id');
    }

    public function customers(){
        return $this->hasMany(Customer::class, 'business_id');
    }

    public function business_services(){
        return $this->hasMany(BusinessServices::class, 'cid');
    }

    public function BusinessTerms() {
        return $this->belongsTo(BusinessTerms::class, 'cid');
    }

}
