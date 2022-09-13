<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SportsCategories extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sports_categories';

    public $timestamps = false;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = ['content'];
     
}