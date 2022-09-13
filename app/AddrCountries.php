<?php

namespace App;

use App\AddrStates;
use Illuminate\Database\Eloquent\Model;

class AddrCountries extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;

    public function State()
    {
        return $this->hasMany(AddrStates::class, 'country_code', 'country_code');
    }
}