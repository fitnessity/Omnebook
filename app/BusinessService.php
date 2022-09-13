<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessService extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'business_service';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cid',
        'userid',
        'languages',
        'medical_states',
        'fitness_goals ',
        'hours_opt',
        'serTimeZone',
        'special_days_off',
        'serBusinessoff1'
    ];
}