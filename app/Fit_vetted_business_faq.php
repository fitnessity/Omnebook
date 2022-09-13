<?php

namespace App;

use App\AddrStates;
use Illuminate\Database\Eloquent\Model;

class Fit_vetted_business_faq extends Model
{
	protected $table = 'vetted_business_faq';
	protected $fillable = ['answer','qustion'];
}