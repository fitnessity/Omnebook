<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use Auth;
use DateTime;
use App\Transaction;

class SalesReportController extends BusinessBaseController
{

	public function index(Request $request ,$business_id)
    {
    	$today = new DateTime();
    	$date = $today->format('l, F j, Y');
    	$reportData = [];
    	//$reportData = Transaction::where('item_type' = 'Recurring')->join('recurring as re', 're.id', '=', 'transactions.item_id')->get();
    	return view('business.sales_report.index',compact('date','reportData'));
    }
}