<?php

namespace App\Exports;

use App\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
use Auth;
class ExportReview implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $serviceAry;

    function __construct($serviceAry) {
        $this->serviceAry = $serviceAry;
    }

    public function collection()
    {   
        $formattedData = [
            ['','Online Review',''],
            [''],
            [ 'Activity Name', 'Ratings', 'Review Date','Review By'],
            $this->transformData($this->serviceAry),
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
                $item->business_services_with_trashed->program_name,
                $item->rating,
                $item->created_at ? date('m/d/Y', strtotime($item->created_at)) : '',
                $item->User->full_name,
            ];
        })->toArray();
    }
}
