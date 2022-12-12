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
            return Customer::select('fname','lname', 'birthdate', 'gender', 'email','phone_number' ,'address','city','state','country','zipcode')->where('business_id',$this->id)->get();
        }else{
            return Customer::select('fname','lname', 'birthdate', 'gender', 'email','phone_number' ,'address','city','state','country','zipcode')->where('fname', 'LIKE', "%{$this->id}%")->get();
        }
    }

    public function headings(): array
    {
        return [
          'fname','lname', 'birthdate', 'gender', 'email','phone_number' ,'address','city','state','country','zipcode'
        ];
    }
}
