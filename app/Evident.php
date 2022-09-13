<?php
namespace App;
use App\User;
use Auth;
use DB;
class Evident{

    protected $username = 'fitnessity';
    protected $password = 'NO3qHleTPcrt-1hkjX3ZMgNrCkvHNeG-SAhTmP9SEmg';
    protected $verifyurl = 'https://verify.api.demo.evidentid.com/api/v1/verify/requests';
    protected $submiturl = 'https://submit.api.demo.evidentid.com/api/v1/requests';
    public static function curl_verify($data){
        $username = 'fitnessity';
        $password = 'NO3qHleTPcrt-1hkjX3ZMgNrCkvHNeG-SAhTmP9SEmg';
        $verifyurl = 'https://verify.api.demo.evidentid.com/api/v1/verify/requests';
               $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://verify.api.demo.evidentid.com/api/v1/verify/requests",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>$data,
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Authorization: Basic ".base64_encode($username . ':' . $password),
  ),
));
$response = curl_exec($curl);
curl_close($curl);
return $response;
    }
    public static function curl_submit($data){
        $submiturl = 'https://submit.api.demo.evidentid.com/api/v1/requests';
        $loggedinUser = Auth::user();
        $dd = DB::select('select * from user_evident where user_id = "'.$loggedinUser["id"].'"');
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $submiturl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>$data,
            CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$dd[0]->userIdentityToken ,
            "Content-Type: application/json"
            )
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
    }

    public static function request_id($id){
        $username = 'fitnessity';
        $password = 'NO3qHleTPcrt-1hkjX3ZMgNrCkvHNeG-SAhTmP9SEmg';
        $curl = curl_init();
    curl_setopt_array($curl, array(
  CURLOPT_URL => "https://verify.api.demo.evidentid.com/api/v1/verify/requests/".$id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic ' . base64_encode($username . ':' . $password)
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return $response;
    }

}