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
        /*$data = [];
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
        }*/

        $not_data = [];
        $address = NULL;
        $city = NULL;
        $ZipCode = NULL;
        $state = NULL;
        $data['lat']  = NULL;
        $data['lng']  = NULL;
        $str_arr = array();
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
                    $gkey='AIzaSyCr7-ilmvSu8SzRjUfKJVbvaQZYiuntduw';
                    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$gaddress&key=$gkey";
                    $geocode = file_get_contents($url);
                    $json = json_decode($geocode);
                    $data['lat'] = $json->results[0]->geometry->location->lat;
                    $data['lng'] = $json->results[0]->geometry->location->lng;
                }

                $createdata = new CompanyInformation;
                $createdata->company_name = $row[0];
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
