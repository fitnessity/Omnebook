<?php

namespace App\Imports;

use App\{Customer,cISessions};
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class CustomerImport implements ToCollection, WithStartRow, WithChunkReading, WithHeadingRow
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
    public function collection(Collection $rows)
    {

        $rows = $rows->toArray();
        $count = count($rows);
        foreach ($rows as $key=>$row) {
           
            if( $key != ($count-1) && (Customer::where(['email'=>@$row['email']])->first()) == ''){
                $coun = @$row['country'] == 'US' ? 'United Status' : $row['country'];
                $createdata = new Customer;
                $createdata->business_id =  $this->business_id;
                $createdata->lname = @$row['last_name'];
                $createdata->fname = @$row['first_name'];
                $createdata->address =  @$row['address'];
                $createdata->city = @$row['city'];
                $createdata->state =  @$row['state'];
                $createdata->zipcode = @$row['postal_code'];
                $createdata->country = $coun;
                $createdata->phone_number = @$row['mobile_phone'];
                $createdata->email = @$row['email'];
                $createdata->status = 0;
                $createdata->save(); 
            }
        }

        return;
    }

    public function chunkSize(): int
    {
        return 1000; // Set an appropriate chunk size based on your requirements
    }
}
