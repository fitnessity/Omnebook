<?php

    use Carbon\Carbon;
    use App\Repositories\{ReviewRepository,UserRepository,NetworkRepository};
    use App\{UserFollower,UserBookingStatus,AddOnService,Customer};

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
                $text .= $qty[$key].' x '.$aOService->service_name.' = $'. $price.'<br>';
            }
        }else{
            $text = "—";
        }
        return $text;
    }


    function createBusinessCustomer($user ,$passwords,$businessId){
        $createCustomerForBusiness = Customer::create([
            'business_id' => $businessId,
            'password' => $passwords,
            'fname' => $user->firstname,
            'lname' => $user->lastname,
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'emergency_contact' => $user->emergency_contact,
            'relationship' => $user->relationship,
            'profile_pic' => $user->profile_pic,
            'user_id' => $user->id,
            'gender' => $user->gender,
            'birthdate' => $user->birthdate,
        ]);

        return $createCustomerForBusiness;
    }

    function getFamilyMember(){
        $user = Auth::user();
        $businessCustomer = $customers = [];
        /*$company = $user->company;
        foreach($company as $key=>$c){
            $businessCustomer[] = $c->customers()->where('user_id', $user->id)->pluck('id')->toArray();
        }*/
        $company = $user->current_company;
        $businessCustomer = $company->customers()->where('user_id', $user->id)->pluck('id')->toArray();
        //print_r($businessCustomer);exit;
        foreach($businessCustomer as $c){
            if(!empty($c)){
                $cus = Customer::where('parent_cus_id', $c)->get();
                foreach($cus as $c1){
                    $customers [] = $c1;
                }
            }
            
        }
        return $customers;
    }

    function getCustomerByname($businessId ,$customerName ){
        $name =  explode(' ', @$customerName);
        $customer = '';
        if(@$name[0] != '' || @$name[1] != ''){
            $customer = Customer::where(['business_id'=>$businessId , 'fname' => @$name[0], 'lname' => @$name[1]])->first();
        }
        return $customer;
    }

?>