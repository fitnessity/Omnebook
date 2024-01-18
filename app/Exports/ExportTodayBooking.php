<?php

namespace App\Exports;

use App\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
use Auth;
class ExportTodayBooking implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $bookDetails;
    protected $page;

    function __construct($bookDetails,$page) {
        $this->bookDetails = $bookDetails;
        $this->page = $page;
    }

    public function collection()
    {   
        $formattedData = [
            [''],
            ['','','','','','','','Booking Information',''],
            [''],
            [ 'Client', 'Purchase Date', 'Expiration date', 'Purchase Amount','Status',(($this->page =='not_used') ?'Last Attended':'')],
            $this->transformData($this->bookDetails,$this->page),
            [''],
        ];

        return collect($formattedData);
    }

    public function headings(): array
    {
        return [];
    }


    private function transformData($data,$page)
    {
        return collect($data)->map(function($item, $key) use ($page){
            return [
                @$item->Customer->full_name,
                date('m/d/Y',strtotime(@$item->contract_date)),
                date('m/d/Y',strtotime(@$item->expired_at)),
                $item->subtotal,
                $item->status,
                $page == 'not_used' ? $item->last_attended : '',
            ];
        })->toArray();
    }
}
