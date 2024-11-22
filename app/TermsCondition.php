<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TermsCondition extends Model
{
    //
    protected $fillable = ['user_id','cid','title','description'];

    protected $table = 'terms_conditions';

}
