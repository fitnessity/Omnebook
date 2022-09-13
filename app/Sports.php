<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SportsCategories;
use App\UserService;
class Sports extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sports';
    protected $append = 'has_child';

    public $timestamps = false;
   
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sport_name',
        'parent_sport_id',
        'category_id',
        'booking_option',
        'image',
        'description',
        'is_deleted'
    ];
    function GetHasChildAtrribute()
    {
        if(count($this->subSport) > 0) return 1;
        else return 0;
    }

    public function subSport()
    {
        return $this->hasMany(Sports::class, 'parent_sport_id');
    }
    
}