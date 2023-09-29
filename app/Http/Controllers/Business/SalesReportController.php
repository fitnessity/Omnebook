<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use Auth;
use DateTime;
use App\Transaction;
use Carbon\Carbon;

class SalesReportController extends BusinessBaseController
{

     public function index(Request $request ,$business_id)
     {
          /*echo "hii";exit;*/
          $date= '';
          //print_r($request->all());exit;
         	$today = date('m/d/Y');
         //	$date = $today->format('l, F j, Y');
          $filterStartDate = $request->startDate != '' ? Carbon::parse($request->startDate) : Carbon::parse($today);
          $filterEndDate = $request->endDate !=  '' ? Carbon::parse($request->endDate) : Carbon::parse($today);

          $compareStartDt = $request->startDate != '' ? Carbon::parse($filterStartDate) : Carbon::parse($today);
          $dates = $reportData = [];


          while ($compareStartDt <= $filterEndDate) {
              $dates[] = $compareStartDt->copy(); 
              $compareStartDt->addDay();
          }

          $sortedDates = array_reverse($dates);

          $cardReport = Transaction::select('transaction.*')
              ->where('kind', 'card')
              ->where('item_type', 'UserBookingStatus')
              ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
              ->join('user_booking_details as ubd', function($join) use ($business_id) {
                  $join->on('ubd.booking_id', '=', 'ubs.id')
                      ->where('ubd.business_id', '=', $business_id);
              })
              ->whereDate('transaction.created_at', '>=', $filterStartDate)
              ->whereDate('transaction.created_at', '<=', $filterEndDate)
              ->orderBy('transaction.created_at', 'Desc')
              ->union
              (
                  Transaction::select('transaction.*')
                      ->where('kind', 'card')
                      ->where('item_type', 'Recurring')
                      ->join('recurring as rec', 'rec.id', '=', 'transaction.item_id')
                      ->where('rec.business_id', '=', $business_id)
                      ->whereDate('transaction.created_at', '>=', $filterStartDate)
                      ->whereDate('transaction.created_at', '<=', $filterEndDate)
              );

    	     /*$cardDataStatusTable = Transaction::select('transaction.*')
               ->where('kind', 'card')->where('item_type', 'UserBookingStatus')
               ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
               ->join('user_booking_details as ubd', function($join) use ($business_id) {
                    $join->on('ubd.booking_id', '=', 'ubs.id')
                         ->where('ubd.business_id', '=', $business_id);
               })->orderBy('transaction.created_at','Desc')->whereDate('transaction.created_at','>=', $filterStartDate)->whereDate('transaction.created_at','<=', $filterEndDate)->get();

          $cardDataRecurringTable = Transaction::select('transaction.*')
               ->where('kind', 'card')->where('item_type', 'Recurring')
               ->join('recurring as rec', 'rec.id', '=', 'transaction.item_id')->where('rec.business_id', '=', $business_id)->orderBy('transaction.created_at','Desc')->whereDate('transaction.created_at','>=', $filterStartDate)->whereDate('transaction.created_at','<=', $filterEndDate)->get();*/

          //$mergedCardData = $cardDataStatusTable->merge($cardDataRecurringTable);

          /*$cardReport = [];
          foreach ($mergedCardData as $key => $data) {
               $stripeResponse = json_decode($data->payload,true);
               $card = $stripeResponse['charges']['data'][0]['payment_method_details']['card']['brand'];
               $cardReport[$card][] = $data;
          }*/

          $cashReport = Transaction::select('ubs.id as user_booking_status_id', 'transaction.*')
               ->where('kind', 'cash')
               ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
               ->join('user_booking_details as ubd', function($join) use ($business_id) {
                    $join->on('ubd.booking_id', '=', 'ubs.id')
                         ->where('ubd.business_id', '=', $business_id);
               });
               //->whereDate('transaction.created_at','>=', $filterStartDate)->whereDate('transaction.created_at','<=', $filterEndDate)->orderBy('transaction.created_at','Desc')->get();


          $compReport = Transaction::select('ubs.id as user_booking_status_id', 'transaction.*')
               ->where('kind', 'comp')
               ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
               ->join('user_booking_details as ubd', function($join) use ($business_id) {
                    $join->on('ubd.booking_id', '=', 'ubs.id')
                         ->where('ubd.business_id', '=', $business_id);
               });
               //->whereDate('transaction.created_at','>=', $filterStartDate)->whereDate('transaction.created_at','<=', $filterEndDate)->orderBy('transaction.created_at','Desc')->get();

          $checkReport = Transaction::select('ubs.id as user_booking_status_id', 'transaction.*')
               ->where('kind', 'check')
               ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
               ->join('user_booking_details as ubd', function($join) use ($business_id) {
                    $join->on('ubd.booking_id', '=', 'ubs.id')
                         ->where('ubd.business_id', '=', $business_id);
               });
               //->whereDate('transaction.created_at','>=', $filterStartDate)->whereDate('transaction.created_at','<=', $filterEndDate)->orderBy('transaction.created_at','Desc')->get();
        
              // / print_r($sortedDates);exit;
    	     return view('business.sales_report.index',compact('date','cardReport','cashReport','business_id','compReport','checkReport','filterStartDate','filterEndDate','sortedDates'));
     }
}