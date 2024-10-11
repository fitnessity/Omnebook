<?php

namespace App\Exports;

use App\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
use Auth;
class ExportClient implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $clients; 
    protected $thirtydays;
    protected $ninetydays;
    protected $today;


    function __construct($clients,$thirtydays,$ninetydays,$today) {
        $this->clients = $clients;
        $this->thirtydays = $thirtydays;
        $this->ninetydays = $ninetydays;
        $this->today = $today;
    }

    public function collection()
    {   

        $formattedData = [
            ['','Today\'s Inactive Cleints',''],
            [''],
            [ 'Company Name', 'Client Name', 'Email', 'Birth Date','Last Attended','Member Since'],
            $this->transformData($today),
            [''],
            [''],
            ['','Inactive Cleints In 30-days',''],
            [''],
            [ 'Company Name', 'Client Name', 'Email', 'Birth Date','Last Attended','Member Since'],
            $this->transformData($thirtydays),
            [''],
            [''],
            ['','Inactive Cleints In 90-days',''],
            [''],
            [ 'Company Name', 'Client Name', 'Email', 'Birth Date','Last Attended','Member Since'],
            $this->transformData($ninetydays),
            [''],
            [''],
            ['','All Inactive Cleints',''],
            [''],
            [ 'Company Name', 'Client Name', 'Email', 'Birth Date','Last Attended','Member Since'],
            $this->transformData($clients),
        ];
        
        return collect($formattedData);
    }

    public function headings(): array
    {
        return [];
    }


    private function transformData($data,$type)
    {
        return collect($data)->map(function($item, $key){
            return [
                @$item->company_name,
                @$item->full_name,
                @$item->email,
                date('m/d/Y',strtotime(@$item->birthdate)),
                @$item->last_attend_date != 'N/A' ? date('m/d/Y',strtotime($item->last_attend_date)): 'N/A',
                date('m/d/Y',strtotime(@$item->created_at)),
            ];
        })->toArray();
    }
}
