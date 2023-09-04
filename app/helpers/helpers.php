<?php

    use Carbon\Carbon;
    use App\Repositories\{ReviewRepository,UserRepository,NetworkRepository};
    use App\{UserFollower,UserBookingStatus,AddOnService,Customer,StripePaymentMethod,UserFamilyDetail,Transaction};

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
        if($company != ''){
            $businessCustomer = $company->customers()->where('user_id', $user->id)->pluck('id')->toArray();
            //print_r($businessCustomer);exit;
            foreach($businessCustomer as $c){
                if(!empty($c)){
                    $cus = Customer::where('parent_cus_id', $c)->get();
                    foreach($cus as $c1){
                        $customers [] = array(
                            "fname" => $c1->fname,
                            "lname" => $c1->lname,
                            "id" => $c1->id,
                            "type" => 'customer',
                        );
                    }
                }
                
            }
        }else{
            $family = $user->user_family_details;
            foreach($family as $fm){
                $customers [] = array(
                    "fname" => $fm->first_name,
                    "lname" => $fm->last_name,
                    "id" => $fm->id,
                    "type" => 'family',
                );
            }
        }
        //print_r($customers);exit;
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

    function profileSyncToBusiness($businessId ,$detail){
        $customer = Customer::create([
            'business_id' => $businessId,
            'fname' => $detail->firstname,
            'lname' => ($detail->lastname) ? $detail->lastname : '',
            'username' => $detail->username,
            'email' => $detail->email,
            'country' => 'US',
            'status' => 0,
            'phone_number' => $detail->phone_number,
            'birthdate' => $detail->birthdate,
            'user_id' => $detail->id
        ]);

        $familyMember = UserFamilyDetail::where(['user_id' => $detail->id])->get();

        foreach($familyMember as $member){
            Customer::create([
                'business_id' => $businessId,
                'fname' => $member->first_name,
                'lname' => ($member->last_name) ? $member->last_name : '',
                'username' => $member->first_name.' '.$member->last_name,
                'email' => $member->email,
                'country' => 'US',
                'status' => 0,
                'phone_number' => $member->mobile,
                'birthdate' => $member->birthday,
                'gender' => $member->gender,
                'user_id' => NULL, //this is null bcz of user is not created at 
                'parent_cus_id'=> $customer->id ,
                'relationship' =>$member->relationship
            ]);
        }

        $cardData = StripePaymentMethod::where(['user_id' => $detail->id , 'user_type' => 'User' ])->get();

        foreach($cardData as $data){
            StripePaymentMethod::create([
                'payment_id' => $data->payment_id,
                'user_type' => 'Customer',
                'user_id' => $customer->id,
                'pay_type'=> $data->pay_type,
                'brand'=> $data->brand,
                'exp_month'=> $data->exp_month,
                'exp_year'=> $data->exp_year,
                'last4'=> $data->last4,
            ]);
        }

        $paymentHistory = Transaction::where('user_type', 'User')
            ->where('user_id', $detail->id)
            ->orWhere(function($subquery) use ($customer) {
                $subquery->where('user_type', 'Customer')
                    ->where('user_id', $customer->id);
            })->get();

        foreach($paymentHistory as $data){
            /*if($data->user_type == 'Customer'){
                $userId = $customer->id;
            }else{
                $userId = $detail->id;
            }*/

            Transaction::create([
                'item_id' => $data->item_id,
                'user_type' => 'Customer',
                'user_id' => $customer->id,
                'item_type'=> $data->item_type,
                'channel'=> $data->channel,
                'kind'=> $data->kind,
                'transaction_id'=> $data->transaction_id,
                'stripe_payment_method_id'=> $data->stripe_payment_method_id,
                'amount'=> $data->amount,
                'qty'=> $data->qty,
                'status'=> $data->status,
                'refund_amount'=> $data->refund_amount,
                'payload'=> $data->payload
            ]);
        }
    }

?>