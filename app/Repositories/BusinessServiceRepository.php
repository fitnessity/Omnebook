<?php

namespace App\Repositories;

use App\BusinessServices;
use App\User;
use DB;
use Auth;
use App\MailService;
use App\Fit_Cart;
use Illuminate\Support\Facades\Log;

class BusinessServiceRepository
{
    public function __construct()
    {        
    }

    public function findById($id)
    {
        return BusinessServices::where('id', $id)->first();
    }

}