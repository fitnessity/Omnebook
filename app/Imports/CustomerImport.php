<?php

namespace App\Imports;

use App\{Customer,cISessions};
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class CustomerImport implements ToModel,ToCollection, WithStartRow, WithChunkReading, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    /*public function  __construct($business_id)
    {
        $this->business_id= $business_id;
    }*/
    
    public function startRow(): int
    {
        return 2;
    }
    public function collection(Collection $rows)
    {

        /*$rows = $rows->toArray();
        $count = count($rows);
        foreach ($rows as $key=>$row) {
           
            if( $key != ($count-1) && (Customer::where(['email'=>@$row['email']])->first()) == ''){
                $coun = (@$row['country'] == 'US' ? 'United Status' : $row['country']);
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
				
				//echo 'email---'.$row['email'].'<br>';
				//exit;
            }
        }*/

        return;
    }

    public function model(array $row){

        if(Customer::where(['email'=>$row[12]])->first() == ''){
            return new Customer([
                'lname' => $row[0],
                'fname' => $row[1],
                'address' => $row[4],
                'city' => $row[5],
                'state' => $row[6],
                'zipcode' => $row[7],
                'country' => $row[8],
                'email' => $row[12],
                'phone_number' => $row[9],
            ]);
        }
    }

    public function chunkSize(): int
    {
        return 1000; // Set an appropriate chunk size based on your requirements
    }
}
