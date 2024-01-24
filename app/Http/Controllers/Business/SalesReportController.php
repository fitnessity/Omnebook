<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use Auth;
use DateTime;
use App\Transaction;
use Carbon\Carbon;
use App\Exports\ExportSales;
use Maatwebsite\Excel\HeadingRowImport;
use Excel;
use Response;
use \PDF;

class SalesReportController extends BusinessBaseController
{

     public function index(Request $request ,$business_id)
     {
          //print_r($request->all());exit;
          $filterOptions = $request->filterOptions;
          $date= '';
         	$today = date('m/d/Y');
          $filterStartDate = $request->startDate != '' ? Carbon::parse($request->startDate) : Carbon::parse($today);
          $filterEndDate = $request->endDate !=  '' ? Carbon::parse($request->endDate) : Carbon::parse($today);

          $compareStartDt = $request->startDate != '' ? Carbon::parse($filterStartDate) : Carbon::parse($today);
          $dates = $reportData = [];

          while ($compareStartDt <= $filterEndDate) {
              $dates[] = $compareStartDt->copy(); 
              $compareStartDt->addDay();
          }

          $sortedDates = array_reverse($dates);

          $cardReportubs = Transaction::select('transaction.*')
              ->where('kind', 'card')
              ->where('item_type', 'UserBookingStatus')
              ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
              ->join('user_booking_details as ubd', function($join) use ($business_id) {
                  $join->on('ubd.booking_id', '=', 'ubs.id')
                      ->where('ubd.business_id', '=', $business_id);
              })
              ->whereDate('transaction.created_at', '>=', $filterStartDate)
              ->whereDate('transaction.created_at', '<=', $filterEndDate)
              ->orderBy('transaction.created_at', 'Desc');

          $cardReportrec =  Transaction::select('transaction.*')
               ->where('kind', 'card')
               ->where('item_type', 'Recurring')
               ->join('recurring as rec', 'rec.id', '=', 'transaction.item_id')
               ->where('rec.business_id', '=', $business_id)
               ->whereDate('transaction.created_at', '>=', $filterStartDate)
               ->whereDate('transaction.created_at', '<=', $filterEndDate)->orderBy('transaction.created_at', 'Desc');

          $cashReport = Transaction::select('ubs.id as user_booking_status_id', 'transaction.*')
               ->where('kind', 'cash')
               ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
               ->join('user_booking_details as ubd', function($join) use ($business_id) {
                    $join->on('ubd.booking_id', '=', 'ubs.id')
                         ->where('ubd.business_id', '=', $business_id);
               });
     
          $compReport = Transaction::select('ubs.id as user_booking_status_id', 'transaction.*')
               ->where('kind', 'comp')
               ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
               ->join('user_booking_details as ubd', function($join) use ($business_id) {
                    $join->on('ubd.booking_id', '=', 'ubs.id')
                         ->where('ubd.business_id', '=', $business_id);
               });


          $checkReport = Transaction::select('ubs.id as user_booking_status_id', 'transaction.*')
               ->where('kind', 'check')
               ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
               ->join('user_booking_details as ubd', function($join) use ($business_id) {
                    $join->on('ubd.booking_id', '=', 'ubs.id')
                         ->where('ubd.business_id', '=', $business_id);
               });

    	     return view('business.reports.sales_report.index',compact('date','cardReportubs','cardReportrec','cashReport','business_id','compReport','checkReport','filterStartDate','filterEndDate','sortedDates','filterOptions'));
     }

     public function export($business_id,Request $request){
          $type = $request->type;
          if($type == 'excel'){
               return Excel::download(new ExportSales($request->endDate,$request->startDate,$business_id), 'SalesReport.xlsx');
          }elseif($type == 'pdf'){
               if($request->endDate != $request->startDate){
                    $ed = new DateTime($request->endDate);
                    $sd = new DateTime($request->startDate);
                    $dates = $sd->format('l, F j, Y').' to '.$ed->format('l, F j, Y');
               }else{
                    $ed = new DateTime();
                    $dates = $ed->format('l, F j, Y');                
               }   

               $cashReport = Transaction::select('ubs.id as user_booking_status_id', 'transaction.*')
                    ->where('kind', 'cash')
                    ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
                    ->join('user_booking_details as ubd', function($join) use ($business_id ) {
                         $join->on('ubd.booking_id', '=', 'ubs.id')
                              ->where('ubd.business_id', '=', $business_id );
                    })->whereDate('transaction.created_at','>=', $request->startDate )->whereDate('transaction.created_at','<=', $request->endDate )->orderBy('transaction.created_at', 'Desc')->get();

               $compReport = Transaction::select('ubs.id as user_booking_status_id', 'transaction.*')
                    ->where('kind', 'comp')
                    ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
                    ->join('user_booking_details as ubd', function($join) use ($business_id ) {
                         $join->on('ubd.booking_id', '=', 'ubs.id')
                              ->where('ubd.business_id', '=', $business_id );
                    })->whereDate('transaction.created_at','>=', $request->startDate )->whereDate('transaction.created_at','<=', $request->endDate )->orderBy('transaction.created_at', 'Desc')->get();

               $checkReport = Transaction::select('ubs.id as user_booking_status_id', 'transaction.*')
                    ->where('kind', 'check')
                    ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
                    ->join('user_booking_details as ubd', function($join) use ($business_id ) {
                         $join->on('ubd.booking_id', '=', 'ubs.id')
                              ->where('ubd.business_id', '=', $business_id );
                    })->whereDate('transaction.created_at','>=', $request->startDate )->whereDate('transaction.created_at','<=', $request->endDate )->orderBy('transaction.created_at', 'Desc')->get();

               $cardReportubs = Transaction::select('transaction.*')
                   ->where('kind', 'card')
                   ->where('item_type', 'UserBookingStatus')
                   ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
                   ->join('user_booking_details as ubd', function($join) use ($business_id) {
                       $join->on('ubd.booking_id', '=', 'ubs.id')
                           ->where('ubd.business_id', '=', $business_id);
                   })
                   ->whereDate('transaction.created_at', '>=', $request->startDate)
                   ->whereDate('transaction.created_at', '<=', $request->endDate)
                   ->orderBy('transaction.created_at', 'Desc');

               $cardReportrec =  Transaction::select('transaction.*')
                    ->where('kind', 'card')
                    ->where('item_type', 'Recurring')
                    ->join('recurring as rec', 'rec.id', '=', 'transaction.item_id')
                    ->where('rec.business_id', '=', $business_id)
                    ->whereDate('transaction.created_at', '>=', $request->startDate)
                    ->whereDate('transaction.created_at', '<=', $request->endDate)->orderBy('transaction.created_at', 'Desc');

               $cardReport = $cardReportubs->get()->concat($cardReportrec->get());
     
               $cashReport  = $cashReport->filter(function ($item) {
                    $userBookingDetailCount = count($item->userBookingStatus->UserBookingDetail);
                    return $userBookingDetailCount > 0 ;
               });

               $compReport  = $compReport->filter(function ($item) {
                    $userBookingDetailCount = count($item->userBookingStatus->UserBookingDetail);
                    return $userBookingDetailCount > 0 ;
               });
            
               $checkReport  = $checkReport->filter(function ($item) {
                    $userBookingDetailCount = count($item->userBookingStatus->UserBookingDetail);
                    return $userBookingDetailCount > 0 ;
               });


               $cardData = array();
               foreach ($cardReport as $key => $data1)  {
                    $tr = Transaction::find($data1->id);
                    $stripeResponse = json_decode($data1->payload,true);
                    $card = $stripeResponse['charges']['data'][0]['payment_method_details']['card']['brand'];
                    $cardData[$card][] = $data1;
               }
               
               $data = [
                    'title' => 'Sales Report',
                    'dates' => $dates,
                    'cashReport' => $cashReport,
                    'compReport' => $compReport,
                    'checkReport' => $checkReport,
                    'cardData' => $cardData,
                    'business_id' => $business_id,
               ];
               $pdf = PDF::loadView('business.reports.sales_report.pdf_view', $data);
               return $pdf->download('SalesReport.pdf');
          }
     }
}