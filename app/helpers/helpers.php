<?php

    use Carbon\Carbon;
    use App\Repositories\ReviewRepository;
    use App\Repositories\UserRepository;
    use App\Repositories\NetworkRepository;
    use App\UserFollower;
    use App\UserBookingStatus;
    use App\AddOnService;

    function getUserRatings($user_id)
    {
      	$review = new ReviewRepository();
      	return $review->getAvgUserReview($user_id);
    }

    function getAboutMe()
    {
      	if(Auth::user()->role == "business") {
      		$users = new UserRepository();
      		$about_me =  $users->getAboutMe(Auth::user()->id);
      		if(!empty($about_me)) echo nl2br($about_me);	
      	}	
    }

    function getUserFollowerCount($user_id)
    {
        $network = new NetworkRepository();
        $followers = $network->getUserFollowers($user_id);
        return count($followers);
    }

    function getAddonService($ids,$qtys)
    {
        $text = '';
        if($ids!= '') {
            $ids = explode(',', $ids);
            $qty = explode(',', $qtys);
            foreach ($ids as $key => $id) {
                $aOService = AddOnService::find($id);
                $price =  $aOService->service_price * $qty[$key];
                $text .= $qty[$key].' X '.$aOService->service_name.' = $'. $price.'<br>';
            }
        }else{
            $text = "—";
        }
        return $text;
    }
?>