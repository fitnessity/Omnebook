<?php

namespace App;

use App\AddrStates;
use Illuminate\Database\Eloquent\Model;

class Fit_background_check_faq extends Model
{
	protected $table = 'background_check_faq';
	protected $fillable = ['answer','qustion'];
}