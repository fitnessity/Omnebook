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
    	//$reportData = Transaction::where('item_type' , 'Recurring')->join('recurring as re', 're.id', '=', 'transactions.item_id')->get();

        $cashReport = Transaction::select('ubs.id as user_booking_status_id', 'transaction.*')
            ->where('kind', 'cash')
            ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
           ->join('user_booking_details as ubd', function($join) use ($business_id) {
                $join->on('ubd.booking_id', '=', 'ubs.id')
                     ->where('ubd.business_id', '=', $business_id);
            })->get();
           //->whereDate('transaction.created_at' ,$today->format('Y-m-d'))->get();


        $compReport = Transaction::select('ubs.id as user_booking_status_id', 'transaction.*')
            ->where('kind', 'comp')
            ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
           ->join('user_booking_details as ubd', function($join) use ($business_id) {
                $join->on('ubd.booking_id', '=', 'ubs.id')
                     ->where('ubd.business_id', '=', $business_id);
            })->get();
          // ->whereDate('transaction.created_at' ,$today->format('Y-m-d'))

        $checkReport = Transaction::select('ubs.id as user_booking_status_id', 'transaction.*')
            ->where('kind', 'check')
            ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
           ->join('user_booking_details as ubd', function($join) use ($business_id) {
                $join->on('ubd.booking_id', '=', 'ubs.id')
                     ->where('ubd.business_id', '=', $business_id);
            })->whereDate('transaction.created_at' ,$today->format('Y-m-d'))->get();

        /*$cashReport = Transaction::select('user_booking_status.id as user_booking_status_id', 'transaction.*')->where('kind', 'cash')->where('kind' ,'cash')->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')->join('user_booking_details as ubd' ,'ubd.id', '=', 'ubs.id')->where('ubd.business_id',$business_id)->get();*/
        
    	return view('business.sales_report.index',compact('date','reportData','cashReport','business_id','compReport','checkReport'));
    }
}