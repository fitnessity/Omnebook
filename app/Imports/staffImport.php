<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\BusinessStaff;

use Illuminate\Support\Facades\Hash;

class staffImport implements ToCollection
{
    /**
    * @param Collection $collection
    */

    public function  __construct($business_id)
    {
        $this->business_id= $business_id;
    }

    public function collection(Collection $rows)
    {
        $rows = $rows->toArray();
        foreach ($rows as $key=>$row) {
            $name = explode(" ", $row[0]);
            $staffData = BusinessStaff::where(['first_name'=> @$name[0] , 'last_name'=> @$name[1], 'business_id' => $this->business_id])->first();
            if($staffData == ''){
                $create = new BusinessStaff;
                $create->business_id =  $this->business_id;
                $create->first_name = @$name[0];
                $create->last_name = @$name[1] != '' ? @$name[1] : 'null';
                $create->address =  $row[6];
                $create->city = $row[7];
                $create->state =  $row[8];
                $create->postcode = $row[9];
                $create->phone = @$name[4] != '' ? $row[4] : '(012) 345-6789';
                $create->email = @$name[5] != '' ? $row[5] : 'abc@gmail.com';
                $create->buddy_key = '12345678';
                $create->password = hash::make("12345678");
                $create->status = 'active';
                $create->position = 'Instructure';
                $create->save();
            }
        }
        return;
    }
}
