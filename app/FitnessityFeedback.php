<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FitnessityFeedback extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $table = 'fitnessity_feedbacks';
}
