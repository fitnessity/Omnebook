<?php

namespace App\Exports;

use App\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
use Auth;
class ExportRecurringDetails implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $upcoming;
    protected $sucessfull; 
    protected $failed;
    protected $all;
    protected $reminingMoney;

    function __construct($upcoming,$sucessfull,$failed,$all,$reminingMoney) {
        $this->upcoming = $upcoming;
        $this->sucessfull = $sucessfull;
        $this->failed = $failed;
        $this->all = $all;
        $this->reminingMoney = $reminingMoney;
    }

    public function collection()
    {   
        $formattedData = [
            ['','Upcoming Autopay Payments',''],
            [''],
            [ 'Name', 'Membership Type', 'Started on', 'Expires On','Status'],
            $this->transformData($this->upcoming),
            [''],
            [''],
            ['','Processed Payments',''],
            [''],
            [ 'Name', 'Membership Name', 'Purchase Date', 'Payment Date' ,'Status'],
            $this->transformData($this->sucessfull), 
            [''],
            [''],
            ['','Failed Autopay Payments',''],
            [''],
            [ 'Name', 'Membership Name', 'Purchase Date', 'Payment Date' ,'Status'],
            $this->transformData($this->failed), 
            [''],
            [''],
            ['','Autopay History',''],
            [''],
            [ 'Name', 'Membership Name', 'Purchase Date', 'Payment Date' ,'Status'],
            $this->transformData($this->all),
            [''],
            [''],
            ['','Customers who owe money',''],
            [''],
            [ 'Name', 'Membership Name', 'Purchase Date', 'Payment Date' ,'Status'],
            $this->transformData($this->reminingMoney),
        ];

        return collect($formattedData);
        
    }

    public function headings(): array
    {
        return [];
    }


    private function transformData($data)
    {
        return $data->map(function($item, $key) {
            return [
                $item->customer_name,
                $item->membership_name,
                $item->UserBookingDetail->created_at ? date('m/d/Y', strtotime($item->UserBookingDetail->created_at)) : '',
                $item->payment_date ? date('m/d/Y', strtotime($item->payment_date)) : '',
                $item->status == 'Retry' ? 'Failed': $item->status,
            ];
        })->toArray();
    }
}
