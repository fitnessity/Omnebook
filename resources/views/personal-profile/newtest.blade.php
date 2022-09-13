<?php 
use App\UserFollow;
use App\CompanyInformation;

//SELECT * FROM `company_informations` WHERE `user_id`= 492
//get login user company id 

//echo Auth::user()->id;

$q1 = CompanyInformation::select("id")
->where("user_id",Auth::user()->id)
->get();

//echo $q1;
//echo "<br/>";
$c1 = $q1->count();

for($i=0; $i<$c1; $i++){
    //SELECT * FROM `users_follow` WHERE user_id != 492 and `follow_id` = 1 or `follow_id` = 4 
    // get follower list who follow us that id come from above code 

  	$q2 = UserFollow::select("user_id","follow_id")
  	->where("user_id","!=",Auth::user()->id)
  	->where("follow_id",$q1[$i]->id)
  	->get();
      
    //echo $q2;
    //echo "<br/>";

    foreach ($q2 as $row) {

        //SELECT * FROM `users_follow` WHERE `user_id` != 492 and user_id != 501 
        // don't show follow link if we already follow our follower 
        echo $row['user_id'];
        

        $q3 = UserFollow::select("user_id","follower_id")
        ->where("user_id",Auth::user()->id)
        ->where("follower_id","!=",0)
        ->where("user_id","!=",$row['user_id'])
        ->get()
        ->toArray();

        //echo $q3;
        //echo "<pre>"; print_r($q3); echo "<pre>";

        

        
		if(array_search($row['user_id'], array_column($q3, 'follower_id')) !== false) {
			echo "";
		}
        else{
            echo "follow";
        }
        
        echo "<br/>";

    }

}

?>