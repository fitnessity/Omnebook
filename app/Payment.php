<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $timestamps = false;
    protected $table = 'tbl_payment';
    protected $fillable = ['email','item_number','amount','currency_code','txn_id','payment_status','payment_response','create_at'];
}