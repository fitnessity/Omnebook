<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use Response,Auth,DB,DateTime;
use App\StripePaymentMethod;

class RecurringPaymentReportController extends BusinessBaseController
{
	public function index(Request $request ,$business_id)
    {
    	$today = new DateTime();
    	return view('business.reports.recurring.index',compact('today'));
    }
}