<?php
namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;

    /**
     * Get the user that owns the education.
     */
    public function reviewfor()
    {
        return $this->belongsTo(User::class, 'reviewfor_userid');
    }

    /**
     * Get the user that owns the education.
     */
    public function reviewby()
    {
        return $this->belongsTo(User::class, 'reviewby_userid');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rating',
        'title',
        'review',
        'reviewby_userid',
        'reviewfor_userid'
    ];
}
