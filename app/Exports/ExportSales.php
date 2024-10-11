<?php

namespace App\Exports;

use App\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
use Auth;
class ExportSales implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $endDate;
    protected $startDate;
    protected $business_id;

    function __construct($endDate,$startDate,$business_id) {
        $this->endDate = $endDate;
        $this->startDate = $startDate;
        $this->business_id = $business_id;
    }

    public function collection()
    {   
        $business = Auth::user()->current_company;
        $booking = $business->UserBookingDetails();
        $todayData = $thirtyDaysData = [];
        if($this->startDate && $this->endDate){
            $cid = $this->business_id;
            $cashReport = Transaction::select('ubs.id as user_booking_status_id', 'transaction.*')
               ->where('kind', 'cash')
               ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
               ->join('user_booking_details as ubd', function($join) use ($cid ) {
                    $join->on('ubd.booking_id', '=', 'ubs.id')
                         ->where('ubd.business_id', '=', $cid );
               })->whereDate('transaction.created_at','>=', $this->startDate )->whereDate('transaction.created_at','<=', $this->endDate )->orderBy('transaction.created_at', 'Desc')->get();
            $compReport = Transaction::select('ubs.id as user_booking_status_id', 'transaction.*')
               ->where('kind', 'comp')
               ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
               ->join('user_booking_details as ubd', function($join) use ($cid ) {
                    $join->on('ubd.booking_id', '=', 'ubs.id')
                         ->where('ubd.business_id', '=', $cid );
               })->whereDate('transaction.created_at','>=', $this->startDate )->whereDate('transaction.created_at','<=', $this->endDate )->orderBy('transaction.created_at', 'Desc')->get();

            $checkReport = Transaction::select('ubs.id as user_booking_status_id', 'transaction.*')
               ->where('kind', 'check')
               ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
               ->join('user_booking_details as ubd', function($join) use ($cid ) {
                    $join->on('ubd.booking_id', '=', 'ubs.id')
                         ->where('ubd.business_id', '=', $cid );
               })->whereDate('transaction.created_at','>=', $this->startDate )->whereDate('transaction.created_at','<=', $this->endDate )->orderBy('transaction.created_at', 'Desc')->get();

            $cardReportubs = Transaction::select('transaction.*')
              ->where('kind', 'card')
              ->where('item_type', 'UserBookingStatus')
              ->join('user_booking_status as ubs', 'ubs.id', '=', 'transaction.item_id')
              ->join('user_booking_details as ubd', function($join) use ($cid) {
                  $join->on('ubd.booking_id', '=', 'ubs.id')
                      ->where('ubd.business_id', '=', $cid);
              })
              ->whereDate('transaction.created_at', '>=', $this->startDate)
              ->whereDate('transaction.created_at', '<=', $this->endDate)
              ->orderBy('transaction.created_at', 'Desc');

            $cardReportrec =  Transaction::select('transaction.*')
               ->where('kind', 'card')
               ->where('item_type', 'Recurring')
               ->join('recurring as rec', 'rec.id', '=', 'transaction.item_id')
               ->where('rec.business_id', '=', $cid)
               ->whereDate('transaction.created_at', '>=', $this->startDate)
               ->whereDate('transaction.created_at', '<=', $this->endDate)->orderBy('transaction.created_at', 'Desc');

            $mergedArray = $cardReportubs->get()->merge($cardReportrec->get());
           
            $cardReport = $mergedArray->filter(function($item) {
                $userBookingDetailCount = @$item->userBookingStatus->UserBookingDetail != '' ? count(@$item->userBookingStatus->UserBookingDetail) : 0 ;
                return $userBookingDetailCount > 0 ;
            });

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

            $formattedData = [];
            
            if (count($cardReport) > 0 ) {
                $formattedData = array_merge($formattedData, [
                    ['Card'],
                    [''],
                ]);
            }

            $cardData = [];
            foreach ($cardReport as $key => $data1)  {
                $tr = Transaction::find($data1->id);
                $stripeResponse = json_decode($data1->payload,true);
                $card = $stripeResponse['charges']['data'][0]['payment_method_details']['card']['brand'];
                $cardData[$card][] = $tr;
            }

            if(count($cardData) > 0 ){
                foreach($cardData as $i=>$data){
                    $heading = strtoupper($i).'-Keyed'; // Set your dynamic heading here

                    $formattedData = array_merge($formattedData, [
                        [$heading],
                        [''],
                        ['Sale Date', 'Client', 'Item name', 'Location', 'Notes', 'Item Price', 'Qty', 'Subtotal', 'Discount Amount', 'Tax', 'Item Total', 'Total Paid/Payment Method'],
                    ]);

                    $formattedData = array_merge($formattedData, $this->transformData(collect($data)));
                    $formattedData[] = [''];
                }
            }


            if (count($cashReport) > 0 ) {
                $formattedData = array_merge($formattedData, [
                    ['Cash'],
                    [''],
                    [ 'Sale Date', 'Client', 'Item name', 'Location', 'Notes' ,'Item Price','Qty', 'Subtotal', 'Discount Amount', 'Tax' ,'Item Total' , 'Total Paid/Payment Method'],
                    $this->transformData($cashReport),
                    [''],
                ]);
            }

            if (count($compReport) > 0 ) {
                $formattedData = array_merge($formattedData, [
                    ['Comp'],
                    [''],
                    [ 'Sale Date', 'Client', 'Item name', 'Location', 'Notes' ,'Item Price','Qty', 'Subtotal', 'Discount Amount', 'Tax' ,'Item Total' , 'Total Paid/Payment Method'],
                    $this->transformData($compReport),
                    [''],
                ]);
            }

            if (count($checkReport) > 0 ) {
                $formattedData = array_merge($formattedData, [
                    ['Check'],
                    [''],
                    [ 'Sale Date', 'Client', 'Item name', 'Location', 'Notes' ,'Item Price','Qty', 'Subtotal', 'Discount Amount', 'Tax' ,'Item Total' , 'Total Paid/Payment Method'],
                    $this->transformData($checkReport),
                    [''],
                ]);
            }
            
            return collect($formattedData);

        }
    }

    public function headings(): array
    {
        return [];
        //return ['Name', 'Membership Type', 'Started on', 'Expires On'];
    }


    private function transformData($data)
    {
        // /print_r($data);exit;
        return $data->map(function($item, $key) {
            return [
                date('m-d-Y',strtotime($item->created_at)),
                @$item->Customer != '' ? @$item->Customer->full_name : 'N/A',
                rtrim($this->replaceBrWithComma(@$item->item_description($this->business_id)['itemDescription']),','),
                rtrim($this->replaceBrWithComma(@$item->item_description($this->business_id)['location']),','),
                rtrim($this->replaceBrWithComma(@$item->item_description($this->business_id)['notes']),','),
                rtrim($this->replaceBrWithComma(@$item->item_description($this->business_id)['itemPrice']),','),
                rtrim($this->replaceBrWithComma(@$item->item_description($this->business_id)['qty']),','),
                rtrim($this->replaceBrWithComma(@$item->item_description($this->business_id)['itemPrice']),','),
                rtrim($this->replaceBrWithComma(@$item->item_description($this->business_id)['itemDis']),','),
                rtrim($this->replaceBrWithComma(@$item->item_description($this->business_id)['itemTax']),','),
                rtrim($this->replaceBrWithComma(@$item->item_description($this->business_id)['itemSubTotal']),','),
                rtrim($this->replaceBrWithComma(@$item->item_description($this->business_id)['itemSubTotal']),','),
            ];
        })->toArray();
    }

    private function replaceBrWithComma($string) {
        return str_replace('<br>', ',', $string);
    }
}
