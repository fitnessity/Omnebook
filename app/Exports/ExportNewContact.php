<?php

namespace App\Exports;

use App\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
use Auth;
class ExportNewContact implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $clients; 
    protected $heading;
    protected $listType;


    function __construct($clients,$heading,$listType) {
        $this->clients = $clients;
        $this->heading = $heading;
        $this->listType = $listType;
    }

    public function collection()
    {               
        if($this->listType == 'mailing-list'){
            $formattedData = [
                ['',$this->heading,''],
                [''],
                [ 'Name', 'Member ID', 'Email', 'Address','Phone Number','Customer Type'],
                $this->transformData($this->clients,$this->listType),
            ];
        }else{
            $formattedData = [
                ['',$this->heading,''],
                [''],
                [ 'Name', 'Member ID', 'Email', 'Phone Number','Customer Type'],
                $this->transformData($this->clients,$this->listType),
            ];
        }                              
        
        
        return collect($formattedData);
    }

    public function headings(): array
    {
        return [];
    }


    private function transformData($data,$type)
    {

        return collect($data)->map(function ($item, $key) use ($type) {
            $transformedItem = [
                @$item->full_name,
                @$item->member_id,
                @$item->email,
                @$item->phone_number,
                @$item->customer_type,
            ];

            if ($type == 'mailing-list') {
                array_splice($transformedItem, 3, 0, [@$item->full_address()]);
            }

            return $transformedItem;
        })->toArray();
    }
}
