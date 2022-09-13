<?php
namespace App;
use App\User;

class Api{

        public static function create_users($test){

            $t1est = array(
                'role'=>$test['role'],
                'user_email'=>$test['email'],
                'buddy_key'=>$test['buddy_key'],
                'user_login'=>substr($test['email'], 0, strpos($test['email'], "@"))
            );
          
           // $request_url = "https://fitnessity.co/api.php";
		    $request_url = "https://fitnessity.co/api.php";
            $ch = curl_init();
            $curlConfig = array(
                CURLOPT_URL            => $request_url,
                CURLOPT_POST           => true,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS     => $t1est
            );
            curl_setopt_array($ch, $curlConfig);
            $result = curl_exec($ch);
            curl_close($ch);
        }



}

?>