<?php

namespace App;

use App\AddrStates;
use Illuminate\Database\Eloquent\Model;

class AddrCities extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;

    public function state()
    {
        return $this->belongsTo(AddrStates::class);
    }
}