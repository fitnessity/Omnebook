<?php

namespace App\Imports;

use App\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class CustomerImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function  __construct($business_id)
    {
        $this->business_id= $business_id;
    }
    
    public function startRow(): int
    {
        return 2;
    }
    public function model(array $row)
    {
        if($row[0] != null){
            if((Customer::where('email',$row[8])->count()) == 0){
                if($row[8] == 'US'){
                    $row[8] = 'United Status';
                }
                $createdata = new Customer;
                $createdata->business_id =  $this->business_id;
                $createdata->lname = $row[0];
                $createdata->fname = $row[1];
                /*$createdata->username = $row[2];*/
                $createdata->address =  $row[2];
                $createdata->city = $row[3];
                $createdata->state =  $row[4];
                $createdata->zipcode = $row[5];
                $createdata->country = $row[6];
                $createdata->phone_number = $row[7];
                $createdata->email = $row[8];
                $createdata->status = 0;
                $createdata->save();
            }
        }

        return;
    }
}
