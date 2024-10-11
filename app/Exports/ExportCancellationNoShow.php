<?php

namespace App\Exports;

use App\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;
use Auth;
class ExportCancellationNoShow implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $noShow;
    protected $cancel;

    function __construct($noShow,$cancel) {
        $this->noShow = $noShow;
        $this->cancel = $cancel;
    }

    public function collection()
    {   
        $formattedData = [
            ['','Cancellation',''],
            [''],
            [ 'Name', 'Membership Name', 'Check In Date' ,'Total Cancellation','Cancellation Action'],
            $this->transformData($this->cancel,'cancel') ?? "No Memberships To Display",
            [''],
            [''],
            ['','No-Show',''],
            [''],
             [ 'Name', 'Membership Name', 'Check In Date' ,'Total No Show' ,''],
            $this->transformData($this->noShow,''),
        ];

        return collect($formattedData);
    }

    public function headings(): array
    {
        return [];
    }


    private function transformData($data,$type)
    {
        return $data->map(function($item, $key) use ($type) {
            return [
                $item->customer->full_name,
                $item->UserBookingDetail->business_services->program_name.' - '.$item->UserBookingDetail->business_price_detail->price_title,
                $item->checkin_date ? date('m/d/Y', strtotime($item->checkin_date)) : '',
                $type == 'cancel' ?   $item->cancel_count : $item->noshow_count,
                $type == 'cancel' ?  $item->cancel_term().' '.($item->no_show_action == 'charge_fee') ? ' Charge Fee '.$item->no_show_charged : ''  : '',
            ];
        })->toArray();
    }
}
