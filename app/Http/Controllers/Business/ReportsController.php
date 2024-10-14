<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use Auth;
use DateTime;

class ReportsController extends BusinessBaseController
{
    public function index(Request $request ,$business_id)
    {
    	return view('business.reports.index');
    }
}