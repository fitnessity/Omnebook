<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessExperience extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'business_experience';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cid',
        'userid',
        'frm_organisationname',
        'frm_position',
        'frm_ispresentcheck ',
        'frm_servicestart',
        'frm_serviceend',
        'frm_course',
        'frm_university',
        'frm_passingyear',
        'certification',
        'frm_passingdate',
        'skill_type',
        'skillcompletion',
        'frm_skilldetail',
        'frm_ispresentcheck'
    ];

     
}