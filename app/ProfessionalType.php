<?php

namespace App;

use App\User;
use App\Sports;
use Illuminate\Database\Eloquent\Model;

class ProfessionalType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;

    protected $table = 'professional_type';
}
