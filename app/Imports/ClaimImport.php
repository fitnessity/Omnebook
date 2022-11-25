<?php

namespace App\Imports;

use App\BusinessClaim;
use App\CompanyInformation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;


class ClaimImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function startRow(): int
    {
        
        return 2;
    }
    public function model(array $row)
    {
        //print_r($row[0]);die;
        $data = [];
        $not_data = [];
        if($row[0] != null){
        if((BusinessClaim::where('website',$row[3])->count()) == 0 && (CompanyInformation::where('website',$row[3])->count()) == 0){
           // print_r(BusinessClaim::where('business_name',$row[0])->count());
            return new BusinessClaim([
               'business_name'     => $row[0],
               'activity'    => $row[1],
               'location' => $row[2],
               'website' => $row[3],
               'business_phone' => $row[4],
               'address' => $row[5],
            ]);
        }
        else{
            if((CompanyInformation::where('website',$row[3])->count()) != 0){
                \Session::push('notuser', $row);
                //return "hell";
             array_push($not_data,$row);
            }
            else{
                \Session::push('user', $row);

             array_push($data,$row);
            }
            
            
            
            
            // print_r($data);
        }
        }
      
        return;
    }
}
