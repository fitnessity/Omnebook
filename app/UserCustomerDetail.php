<?php

namespace App;

use App\UserCustomerDetail;
use Illuminate\Database\Eloquent\Model;

class UserCustomerDetail extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps = false;
    protected $table = 'user_customer_details';
    protected $fillable = ['user_id','banner_image','about_me','intro'];


    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
