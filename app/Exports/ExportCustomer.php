<?php

namespace App\Exports;

use App\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportCustomer implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $id;

    function __construct($id,$chk) {
        $this->id = $id;
        $this->chk = $chk;
    }

    public function collection()
    {   /*echo   $this->chk;exit;*/
        if($this->chk == "empty"){
            return Customer::select('lname', 'fname', 'address','city','state', 'zipcode','country', 'phone_number', 'email')->where('business_id',$this->id)->get();
        }else{
            return Customer::select('lname', 'fname', 'address','city','state','zipcode','country', 'phone_number', 'email' )->where('fname', 'LIKE', "%{$this->id}%")->get();
        }
    }

    public function headings(): array
    {
        return [
          'Last name' ,'First name','Address','City','State','Postal code','Country', 'Phone number' , 'Email'
        ];
    }
}
