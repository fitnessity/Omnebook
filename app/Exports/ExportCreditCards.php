<?php

namespace App\Exports;

use App\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
use Auth;
class ExportCreditCards implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $expiringCards;

    function __construct($expiringCards) {
        $this->expiringCards = $expiringCards;
    }

    public function collection()
    {   
        $formattedData = [
            [''],
            ['','Credit Card Expirations',''],
            [''],
            [ 'Name', 'Expire Month', 'Expire Year'],
            $this->transformData($this->expiringCards),
            [''],
        ];

        return collect($formattedData);
    }

    public function headings(): array
    {
        return [];
    }


    private function transformData($data)
    {
        return collect($data)->map(function($item, $key){
            return [
                @$item->Customer->full_name,
                $item->exp_month,
                $item->exp_year 
            ];
        })->toArray();
    }
}
