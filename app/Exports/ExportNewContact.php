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
                [ 'Name', 'Member ID', 'Email', 'Address', 'City','State','Zip','Phone Number','Customer Type','Status'],
                $this->transformData($this->clients,$this->listType),
            ];
        }else{
            $formattedData = [
                ['',$this->heading,''],
                [''],
                [ 'Name', 'Member ID', 'Email', 'Phone Number','Customer Type','Status'],
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
                @$item->is_active(),
            ];

            if ($type == 'mailing-list') {
                array_splice($transformedItem, 3, 0, [@$item->address ?? 'N/A']);
                array_splice($transformedItem, 4, 0, [@$item->city ?? 'N/A']);
                array_splice($transformedItem, 5, 0, [@$item->state ?? 'N/A']);
                array_splice($transformedItem, 6, 0, [@$item->zipcode ?? 'N/A']);
            }

            return $transformedItem;
        })->toArray();
    }
}
