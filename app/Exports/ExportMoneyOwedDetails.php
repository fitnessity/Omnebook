<?php

namespace App\Exports;

use App\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
use Auth;
class ExportMoneyOwedDetails implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $business_id;
    protected $all;
    protected $reminingMoney;

    function __construct($business_id,$all,$reminingMoney) {
        $this->business_id = $business_id;
        $this->all = $all;
        $this->reminingMoney = $reminingMoney;
    }

    public function collection()
    {   
        $formattedData = [
            ['','Missed Credit Card Payments',''],
            [''],
            [ 'Purchase Date', 'Customer Name', 'Membership Type', 'Card Being charged' ,'Amount','Status'],
            $this->transformData($this->all,$this->business_id),
            [''],
            [''],
            ['','Customers who owe money',''],
            [''],
            [ 'Purchase Date', 'Customer Name', 'Membership Type', 'Card Being charged' ,'Amount','Status'],
            $this->transformData($this->reminingMoney,$this->business_id),
        ];

        return collect($formattedData);
        
    }

    public function headings(): array
    {
        return [];
    }


    private function transformData($data,$business_id)
    {
        return $data->map(function($item, $key) use($business_id){
            return [
                date('m/d/Y', strtotime($item->created_at)),
                $item->getCustomer($business_id)->full_name,
                $item->item_description($business_id)['itemDescription'],
                $item->getPmtMethod(),
                $item->amount,
                $item->status == 'requires_capture' ? 'Payment Need to Capture': $item->status,
            ];
        })->toArray();
    }
}
