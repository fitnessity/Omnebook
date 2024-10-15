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
        $not_data = $str_arr = [];
        $address = $city = $ZipCode = $state =  $data['lat']  = $data['lng'] = NULL;

        if($row[0] != null){

            if((CompanyInformation::where('website',$row[3])->count()) == 0){
                if($row[5] != 'null'){
                    $str_arr = explode (",", $row[5]);
                }

                if(!empty($str_arr)){
                    if(count($str_arr) == 4){
                        $address .= $str_arr[0];
                        $address .= ", ".$str_arr[1];
                        $city = $str_arr[2];
                        $state = strtok($str_arr[3], ' ');
                        $st_arr1 = explode (' ' ,$str_arr[3]);
                        if($st_arr1[0] == ''){
                            $ZipCode = $st_arr1[2];
                        }else{
                            $ZipCode = $st_arr1[1];
                        }
                    }else if(count($str_arr) == 5){
                        $address .= $str_arr[0];
                        $address .= ", ".$str_arr[1];
                        $city = $str_arr[2];
                        $state = $str_arr[3];
                        $ZipCode = $str_arr[4];
                    }else{
                        $address = $str_arr[0];
                        $city = $str_arr[1];
                        $state = strtok($str_arr[2], ' ');
                        $st_arr1 = explode (' ' ,$str_arr[2]);
                        if($st_arr1[0] == ''){
                            $ZipCode = $st_arr1[2];
                        }else{
                            $ZipCode = $st_arr1[1];
                        }
                    }
                }


                if($row[5] != 'null'){

                    $gaddress = $address.', '.$state;
            
                    $gaddress = str_replace(' ', '+', $gaddress);
                    // $gkey='AIzaSyCr7-ilmvSu8SzRjUfKJVbvaQZYiuntduw';
                    $gkey = env('MAP_KEY'); 
                    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$gaddress&key=$gkey";
                    $geocode = file_get_contents($url);
                    $json = json_decode($geocode);
                    $data['lat'] = $json->results[0]->geometry->location->lat;
                    $data['lng'] = $json->results[0]->geometry->location->lng;
                }

                $createdata = new CompanyInformation;
                $createdata->company_name = $row[0];
                $createdata->dba_business_name = $row[0];
                $createdata->business_phone = $row[4];
                $createdata->address = $address;
                $createdata->city = $city;
                $createdata->state = $state;
                $createdata->zip_code = $ZipCode;
                $createdata->website = $row[3];
                $createdata->is_verified = 0;
                $createdata->latitude = $data['lat'];
                $createdata->longitude = $data['lng'];
                $createdata->save();

                $data = CompanyInformation::where('website',$row[3])->first();
                $cid = $data->id;
                $bcdata = new BusinessCompanyDetail;
                $bcdata->cid = $cid;
                $bcdata->companyname = $row[0];
                $bcdata->Address = $address;
                $bcdata->City   = $city;
                $bcdata->State   = $state;
                $bcdata->ZipCode   = $ZipCode;
                $bcdata->Phonenumber =  $row[4];
                    $bcdata->save();
            }else{
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
