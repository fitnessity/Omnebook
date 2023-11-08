<?php

namespace App\Exports;

use App\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
use Auth;
class ExportMembership implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $endDate;
    protected $startDate;

    function __construct($endDate,$startDate) {
        $this->endDate = $endDate;
        $this->startDate = $startDate;
    }

    public function collection()
    {   

        $business = Auth::user()->current_company;
        $booking = $business->UserBookingDetails();
        $todayData = $thirtyDaysData = [];
        if($this->startDate && $this->endDate){
            $data =  $business->UserBookingDetails()->whereBetween('expired_at', [$this->startDate, $this->endDate])->orderby('expired_at','desc')->get();

            $data  = $data->filter(function ($item) {
                return $item->Customer && $item->business_price_detail;
            });

            $formattedData = [
                ['',' Expiration Membership',''],
                [''],
                [ 'Name', 'Membership Type', 'Started on', 'Expires On'],
                $this->transformData($data),
                [''],
            ];

            return collect($formattedData);

        }else{
            $thirtyDaysLater = Carbon::now()->addDays(30)->format('Y-m-d');;
            $thirtyDaysDt =  $business->UserBookingDetails()->whereBetween('expired_at', [date('Y-m-d'), $thirtyDaysLater])->orderby('expired_at','desc')->get();
            $todayDt = $business->UserBookingDetails()->whereDate('expired_at', '=', date('Y-m-d'))->orderby('expired_at','desc')->get();

            $todayData = $todayDt->filter(function ($item) {
                return $item->Customer && $item->business_price_detail;
            });

            $thirtyDaysData  = $thirtyDaysDt->filter(function ($item) {
                return $item->Customer && $item->business_price_detail;
            });

            $formattedData = [
                ['','Today\'s Expiration',''],
                [''],
                [ 'Name', 'Membership Type', 'Started on', 'Expires On'],
                $this->transformData($todayData),
                [''],
                [''],
                ['','30-day Expirations',''],
                [''],
                [ 'Name', 'Membership Type', 'Started on', 'Expires On'],
                $this->transformData($thirtyDaysData),
            ];

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
        return $data->map(function($item, $key) {
            return [
                $item->Customer->full_name,
                $item->business_price_detail->price_title,
                $item->contract_date ? date('m/d/Y', strtotime($item->contract_date)) : '',
                $item->expired_at ? date('m/d/Y', strtotime($item->expired_at)) : '',
            ];
        })->toArray();
    }
}
