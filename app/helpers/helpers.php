<?php

    use Carbon\Carbon;
    use App\Repositories\{ReviewRepository,UserRepository,NetworkRepository};
    use App\{UserFollower,UserBookingStatus,AddOnService,Customer,StripePaymentMethod,UserFamilyDetail,Transaction,Products,CustomerNotes,Notification};

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
            $text = "N/A";
        }
        return $text;
    }

    function getProducts($ids,$qtys,$types)
    {
        $text = '';$price = 0;
        if($ids!= '') {
            $ids = explode(',', $ids);
            $qty = explode(',', $qtys);
            $type = explode(',', $types);
            foreach ($ids as $key => $id) {
                $product = Products::find($id);
                if($type[$key] == 'rent'){
                    $price =  $product->rental_price * $qty[$key];
                    $rentText =  '( Rental Duration is '.$product->rental_duration .' )';
                }else{
                    $price =  $product->sale_price * $qty[$key];
                    $rentText = '';
                }
                $text .= $qty[$key].' x '.$product->name.' = $'. $price.'<br>'.$rentText.'<br>';
            }
        }else{
            $text = "N/A";
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
            'primary_account' => @$user->primary_account ?? 0,
            'phone_number' => $user->phone_number,
            'emergency_contact' => $user->emergency_contact,
            'relationship' => $user->relationship,
            'profile_pic' => $user->profile_pic,
            'user_id' => $user->id,
            'gender' => $user->gender,
            'birthdate' => $user->birthdate,
            'stripe_customer_id' => $user->stripe_customer_id,
        ]);

        return $createCustomerForBusiness;
    }

    function getFamilyMember($cid = null){
        $user = Auth::user();
        $businessCustomer = $customers = [];
        /*$company = $user->company;
        foreach($company as $key=>$c){
            $businessCustomer[] = $c->customers()->where('user_id', $user->id)->pluck('id')->toArray();
        }*/
        if($cid){
            $company = $user->company()->where('id',$cid)->first();
        }else{
            $company = $user->current_company;
        }
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
            'primary_account' => @$detail->primary_account ?? 0,
            'country' => 'US',
            'status' => 0,
            'phone_number' => $detail->phone_number,
            'birthdate' => $detail->birthdate,
            'user_id' => $detail->id,
            'stripe_customer_id' => $detail->stripe_customer_id
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
                'primary_account' => 0,
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

    function getUserbookingDetail($sid,$cid)
    {
        return App\UserBookingDetail::where(['sport'=> $sid ,'user_id'=>$cid])->whereDate('expired_at' ,'>' ,date('Y-m-d'))->orderby('created_at','desc')->get();
    }

    function getGroupByPriceOption($cdt)
    {
        $cardPriceOption = [];
        if(!empty($cdt)){
            foreach ($cdt as $key => $data){
                if($data->item_type == 'UserBookingStatus'){
                    $bDetails = $data->UserBookingStatus->UserBookingDetail;
                    foreach ($bDetails as $key => $dt) 
                    {
                        $name = $dt->business_price_detail_with_trashed->price_title;
                        $cardPriceOption[$name][] = $data;
                    }
                }else{
                    $bDetails = $data->Recurring->UserBookingDetail;
                    if($bDetails != ''){
                        $name = $bDetails->business_price_detail_with_trashed->price_title;
                        $cardPriceOption[$name][] = $data;
                    }
                }
            }
        }

        return $cardPriceOption;
    }

    function getGroupByCategoty($cdt)
    {
        $cardCategoty = [];
        if(!empty($cdt)){
            foreach ($cdt as $key => $data){
                if($data->item_type == 'UserBookingStatus'){
                    $bDetails = $data->UserBookingStatus->UserBookingDetail;
                    foreach ($bDetails as $key => $dt) 
                    {
                        $name = $dt->business_price_detail_with_trashed->business_price_details_ages_with_trashed->category_title;
                        $cardCategoty[$name][] = $data;
                    }
                }else{
                    $bDetails = $data->Recurring->UserBookingDetail;
                    if($bDetails != ''){
                        $name = $bDetails->business_price_detail_with_trashed->business_price_details_ages_with_trashed->category_title;
                        $cardCategoty[$name][] = $data;
                    }
                }
            }
        }

        return $cardCategoty;
    }

    function getNotificationDashboard($type = null){
        $notifications = Notification::orderby('id','desc')->whereDate('display_date', '=', now())
            ->whereTime('display_time', '<=', now()->format('H:i'))->where([ 'business_id' => Auth::user()->cid ])->where('type','business')
            ->orWhere(function ($query) {
                $query->whereDate('display_date', '<=', now())->where([ 'business_id' => Auth::user()->cid ])->where('type','business');
            });
        if($type){
            $notifications->where('status','Alert');
        }
        return $notifications->get();
    }

    function getNotificationPersonal($type=null){
        echo "huuh";
        echo Auth::user();exit;
        $customers = Auth::user()->customers();
        if($customers != ''){
            $customersId =  @$customers->pluck('id')->toArray();
            $notifications = Notification::orderby('updated_at','desc')->whereDate('display_date', '=', now())
                ->whereTime('display_time', '<=', now()->format('H:i'))->whereIn('customer_id',$customersId )->where('type','personal')
                ->orWhere(function ($query) use($customersId) {
                    $query->whereDate('display_date', '<=', now())->whereIn('customer_id', $customersId )->where('type','personal');
                });
            if($type){
                $notifications->where('status','Alert');
            }
            return $notifications->get();
        }
       
       return '';
    }

    

    function timeAgo($created_at){
        $date = Carbon::parse($created_at);
        $minutesDifference = $date->diffInMinutes(now());

        if ($minutesDifference < 60) {
            return $minutesDifference . ' minutes ago';
        }elseif ($minutesDifference < 1440) { // 1440 minutes in a day (24 hours)
            $hours = floor($minutesDifference / 60);
            return $hours . ' hours ago';
        }elseif ($minutesDifference < 43200) { // 43200 minutes in a month (30 days)
            $days = floor($minutesDifference / 1440);
            return $days . ' days ago';
        }elseif ($minutesDifference < 525600) { // 525600 minutes in a year (365 days)
            $months = floor($minutesDifference / 43200);
            return $months . ' months ago';
        }else {
            $years = floor($minutesDifference / 525600);
            return $years . ' years ago';
        }
    }

?>