<?php

namespace App;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use File;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;

use Illuminate\Database\Eloquent\SoftDeletes;

class Recurring extends Authenticatable
{

	 use SoftDeletes;
    protected $table = 'recurring';

    public $timestamps = true;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'booking_detail_id', 'user_id', 'user_type', 'business_id', 'payment_date', 'amount', 'tax', 'charged_amount', 'payment_method', 'stripe_payment_id', 'status'];

}