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
    protected $clientsType;
    protected $heading;

    function __construct($clients,$heading,$clientsType) {
        $this->clients = $clients;
        $this->clientsType = $clientsType;
        $this->heading = $heading;
    }

    public function collection()
    {   
        $formattedData = [
            ['',$this->heading,''],
            [''],
            [ 'Company Name', 'Client Name', 'Email', 'Birth Date','Phone Number','Member Since' , ($this->clientsType == 'new' ? 'Status' :'')],
            $this->transformData($this->clients,$this->clientsType),
            [''],
        ];

        return collect($formattedData);
    }

    public function headings(): array
    {
        return [];
    }


    private function transformData($data,$type)
    {
        return collect($data)->map(function($item, $key) use($type){
            return [
                @$item->company_name,
                @$item->full_name,
                @$item->email,
                date('m/d/Y',strtotime(@$item->birthdate)),
                @$item->phone_number ?? "N/A",
                date('m/d/Y',strtotime(@$item->created_at)),
                $type == 'new' ? ($item->is_active() == 'Active' ? 'Member' : $item->is_active): '',
            ];
        })->toArray();
    }
}
