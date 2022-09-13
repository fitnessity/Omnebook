<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessTerms extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'business_terms';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cid',
        'userid',
        'houserules',
        'cancelation',
        'cleaning',
        'termcondfaq',
        'termcondfaqtext',
        'contractterms',
        'contracttermstext',
        'refundpolicy',
        'refundpolicytext',
        'liability',
        'liabilitytext',
        'covid',
        'covidtext'
    ];
}