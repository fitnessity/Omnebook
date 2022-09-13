<?php

namespace App;

use App\AddrCountries;
use App\AddrCitites;
use Illuminate\Database\Eloquent\Model;

class AddrStates extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;

    public function Country()
    {
        return $this->belongsTo(AddrCountries::class, 'country_code', 'country_code');
    }

    public function City()
    {
        return $this->hasMany(AddrCities::class);
    }
}