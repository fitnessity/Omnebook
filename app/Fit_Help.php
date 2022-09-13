<?php

namespace App;

use App\AddrStates;
use Illuminate\Database\Eloquent\Model;

class Fit_Help extends Model
{
    protected $table = 'fit_help';
    protected $fillable = ['answer','qustion','cat_name'];
}