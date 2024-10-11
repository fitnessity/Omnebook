<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportMembershipRevenue implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $memberships;
    protected $recurringMemberships;
    protected $products;
    protected $business_id;
    protected $sDate;
    protected $eDate;

    function __construct($memberships,$recurringMemberships,$products,$business_id,$sDate,$eDate) {
        $this->memberships = $memberships;
        $this->recurringMemberships = $recurringMemberships;
        $this->products = $products;
        $this->business_id = $business_id;
        $this->sDate = $sDate;
        $this->eDate = $eDate;
    }

    public function collection()
    {   
        $formattedData = [
            ['','Revenue Breakdown',''],
            [''],
            [''],
            ['','Single Payment Membership',''],
            [''],
            [ 'Program Name', 'Membership Type', 'Membership For','Price' ,'Qty','Revenue'],
            $this->transformData($this->memberships,$this->business_id,$this->sDate,$this->eDate),
            [''],
            [''],
            ['','Recurring Memberships',''],
            [''],
            [ 'Program Name', 'Membership Type', 'Membership For' ,'Price' ,'Qty','Revenue'],
            $this->transformData($this->recurringMemberships,$this->business_id,$this->sDate,$this->eDate),
            [''],
            [''],
            ['','Products Shop',''],
            [''],
            [ 'Product Name','Price','Qty','Revenue'],
            $this->transformDataProduct($this->products,$this->business_id,$this->sDate,$this->eDate),
        ];

        return collect($formattedData);
    }

    public function headings(): array
    {
        return [];
        //return ['Name', 'Membership Type', 'Started on', 'Expires On'];
    }

    private function transformDataProduct($data,$business_id,$sDate,$eDate)
    {
        return $data->map(function($item, $key) use ($business_id,$sDate,$eDate) {
            return [
                $item->name,
                $item->getProductPrice($sDate,$eDate,$business_id),
                $item->getProductQty($sDate,$eDate,$business_id),
                '$'.$item->getProductRevenue($sDate,$eDate,$business_id),
            ];
        })->toArray();
    } 

    private function transformData($data,$business_id,$sDate,$eDate)
    {
        return $data->map(function($item, $key) use ($business_id,$sDate,$eDate) {
            return [
                $item->BusinessServices->program_name.' - '.$item->price_title,
                $item->BusinessServices->formal_service_types(),
                $item->getMembershipFor($sDate,$eDate,$business_id),
                $item->getMembershipPrice($sDate,$eDate,$business_id),
                $item->getMembershipQty($sDate,$eDate,$business_id),
                '$'.$item->getMembershipRevenue($sDate, $eDate,$business_id),
            ];
        })->toArray();
    }
}
