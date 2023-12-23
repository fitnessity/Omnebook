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

    function __construct($bookDetails) {
        $this->bookDetails = $bookDetails;
    }

    public function collection()
    {   
        $formattedData = [
            ['',' Today\s bookings',''],
            [''],
            [ 'BOOKING CONFIRMATION #', 'TOTAL PRICE', 'PRICE OPTION', 'PAYMENT TYPE','TOTAL REMAINING','PROGRAM NAME','EXPIRATION DATE','DATE BOOKED','RESERVED DATE','BOOKED BY','ACTIVITY TYPE','SERVICE TYPE','ACTIVITY LOCATION','ACTIVITY DURATION','GREAT FOR','PARTICIPANTS','WHO IS PARTICIPATING?','ADD-ON SERVICES'],
            $this->transformData($this->bookDetails),
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
        return collect($data)->map(function($item, $key) {
            return [
                @$item->booking->order_id,
                @$item->booking->getPaymentDetail() != 'Comp' ? @$item->subtotal : 0,
                @$item->business_price_detail_with_trashed->price_title.'-'.@$item->pay_session.' Sessions',
                @$item->pay_session.' Sessions',
                @$item->getremainingsession().'/'.@$item->pay_session,
                @$item->business_services_with_trashed->program_name,
                date('m/d/Y',strtotime(@$item->expired_at)),
                date('m/d/Y',strtotime(@$item->created_at)),
                @$item->getReserveData('reserve_date'),
                @$item->booking->full_name,
                @$item->business_services_with_trashed->sport_activity,
                @$item->business_services_with_trashed->select_service_type ?? "N/A" ,
                @$item->business_services_with_trashed->activity_location,
                @$item->getReserveData('reserve_time'),
                @$item->business_services_with_trashed->activity_for,
                @$item->getparticipate(),
                @$item->decodeparticipate(),
                getAddonService(@$item->addOnservice_ids,@$item->addOnservice_qty),
            ];
        })->toArray();
    }
}
