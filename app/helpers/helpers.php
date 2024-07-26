<?php

    use Carbon\Carbon;
    use Storage;
    use DateTime;
    use View;
    use App\Repositories\{ReviewRepository,UserRepository,NetworkRepository};
    use App\{UserFollower,UserBookingStatus,AddOnService,Customer,StripePaymentMethod,UserFamilyDetail,Transaction,Products,CustomerNotes,Notification,CompanyInformation,BusinessServices,UserBookingDetail,BusinessPriceDetailsAges,CustomList,BusinessServicesFavorite};
    use App\BusinessCustomerUploadFiles;        
    use App\BusinessStaff;
    use App\User;

    
    function countStarRatings($serviceId)
    {
        $service = BusinessServices::find($serviceId);
        $reviewTypes = [
            'cleanliness',
            'accuracy',
            'checkin',
            'communication',
            'customer_service',
            'location',
            'value'
        ];

        $starCountsSql = generateStarCountsSql($reviewTypes);

        $results = DB::table('business_service_review')
            ->select(DB::raw($starCountsSql))
            ->where('service_id', $serviceId)
            ->first();

        /*print_r($results);exit;*/
        $totalStars = $service->reviews()->count() * 7;


        $fiveStarValue =  $totalStars > 0 ?  round( $results->star_5 /  $totalStars * 100 ,2 ) : 0;
        $fourStarValue = $totalStars > 0 ?  round( $results->star_4 /  $totalStars * 100 ,2) : 0;
        $threeStarValue = $totalStars > 0 ?  round( $results->star_3 /  $totalStars * 100 ,2) : 0;
        $twoStarValue = $totalStars > 0 ?  round( $results->star_2 /  $totalStars * 100 ,2) : 0;
        $oneStarValue = $totalStars > 0 ?  round( $results->star_1 /  $totalStars * 100 ,2) : 0;

        return [
            'star_5' => $fiveStarValue,
            'star_4' => $fourStarValue,
            'star_3' => $threeStarValue,
            'star_2' => $twoStarValue,
            'star_1' => $oneStarValue
        ];
    }

    function generateStarCountsSql(array $reviewTypes)
    {
        $cases = [];
        foreach ([5, 4, 3, 2, 1] as $star) {
            $caseParts = [];
            foreach ($reviewTypes as $type) {
                $caseParts[] = "SUM(CASE WHEN $type = $star THEN 1 ELSE 0 END)";
            }
            $cases[] = implode(' + ', $caseParts) . " as  star_$star";
        }

        return implode(', ', $cases);
    }

    function getBusinessServiecReviewSum($sid,$type){
        $service = BusinessServices::find($sid);
        if ($service && $service->reviews() != '') 
        {
            return $service->reviews()->sum($type);
        }
        else
        { return 0; }
        
    }

    function getBusinessServiceCount($sid,$type){
        $service = BusinessServices::find($sid);
        $count = $service->reviews()->count();
        $sum = getBusinessServiecReviewSum($sid,$type);

        if($count > 0){ 
            return round($sum/$count,2); 
        }else{
            return 0;
        }
    }

    function getFavorite($userId , $sid){
       return BusinessServicesFavorite::where('user_id',$userId)->where('service_id',$sid)->first(); 
    }

    function getCode(){
        $uniqueCode = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
        while ( DB::table('users')->where('unique_code', $uniqueCode)->exists()) {
            $uniqueCode = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
        }
        return $uniqueCode;
    }

    function getSpotLeft($id,$activityDate,$spotsAvailable){
        $totalquantity = 0; 
        $SpotsLeft = UserBookingDetail::where('act_schedule_id',$id)->whereDate('bookedtime', '=',date('Y-m-d',strtotime($activityDate)))->get();
        foreach($SpotsLeft as $data1){
            $totalquantity += $data1->userBookingDetailQty();
        }
       return $spotsAvailable != '' ? $spotsAvailable - $totalquantity : 0;
    }

    function getTimePassedChk($service,$bdata){
        $start = new DateTime($bdata->shift_start);
        $current = new DateTime();
        $currentTime =  $current->format("Y-m-d H:i");
        $timePassedChk = 0;
        if($service->can_book_after_activity_starts == 'No' && $service->beforetime != '' && $service->beforetimeint != ''){
            $matchTime = $start->modify('-'.$service->beforetimeint.' '.$service->beforetime)->format("Y-m-d H:i");
            $timePassedChk =  $currentTime <  $matchTime ? 0 : 1;
        }else if($service->can_book_after_activity_starts == 'Yes' && $service->aftertime != '' && $service->aftertimeint != ''){
            $matchTime = $start->modify('+'.$service->aftertimeint.' '.$service->aftertime)->format("Y-m-d H:i");
            $timePassedChk =  $currentTime <  $matchTime ? 0: 1;
        }

        return $timePassedChk;
    }

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
                if ($aOService) {
                    $price = $aOService->service_price * $qty[$key];
                    $text .= $qty[$key] . ' x ' . $aOService->service_name . ' = $' . $price . '<br>';
                } 
                // $price =  $aOService->service_price * $qty[$key];
                // $text .= $qty[$key].' x '.$aOService->service_name.' = $'. $price.'<br>';
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
            'request_status' =>1,
        ]);

        return $createCustomerForBusiness;
    }

    function getFamilyMember($cusId,$cid = null){
        $businessCustomer = $customers = $familyDetails  = $UserFamilyDetails =[];
        if($cusId){
            $customer = Customer::find($cusId);
            foreach ($customer->get_families() as $fm){
                $familyDetails [] = $fm;
            } 

            $groupedFamilyDetails = collect($familyDetails)->groupBy(function ($item) {
                return $item->fname . ' ' . $item->lname;
            });

            $uniqueFamilyDetails = collect([]);

            foreach ($groupedFamilyDetails as $name => $group) {
                $uniqueFamilyDetails->push($group->first()); // Add the first item from each group
            }

            foreach ($uniqueFamilyDetails as $detail) {
                $UserFamilyDetails [] = $detail;
            }

            foreach($UserFamilyDetails as $c1){
                $customers [] = array(
                    "id" => $c1->id,
                    "full_name" => $c1->full_name,
                    "type" => 'customer',
                );
            }

            return $customers;
        }else{
            $user = Auth::user();
            $customer = @$user->customers()->where('business_id',$cid)->get();
            if($customer){
                foreach($customer as $cs){
                    // dd($cs);
                    foreach ($cs->get_families() as $fm){
                        $familyDetails [] = $fm;
                    }  
                }
                $groupedFamilyDetails = collect($familyDetails)->groupBy(function ($item) {
                    return $item->fname . ' ' . $item->lname;
                });
                $uniqueFamilyDetails = collect([]);
                foreach ($groupedFamilyDetails as $name => $group) {
                    $uniqueFamilyDetails->push($group->first()); // Add the first item from each group
                }
                foreach ($uniqueFamilyDetails as $detail) {
                    $UserFamilyDetails [] = $detail;
                }
                foreach($UserFamilyDetails as $c1){
                    $customers [] = array(
                        "id" => $c1->id,
                        "full_name" => $c1->full_name,
                        "type" => 'customer',
                    );
                }
            }else{
                $userfamily = $user->user_family_details;
                foreach($userfamily as $uf){
                     $customers [] = array(
                        "id" => $uf->id,
                        "full_name" => $uf->full_name,
                        "type" => 'family',
                    );
                }
            }
            // print_r($customers);exit;
            return $customers;
        }
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
            'stripe_customer_id' => $detail->stripe_customer_id,
            'profile_pic' => $detail->profile_pic,
            'stripe_customer_id' => $detail->stripe_customer_id,
            'request_status' =>1,
        ]);

        $familyMember = UserFamilyDetail::where(['user_id' => $detail->id])->get();

        foreach($familyMember as $member){
            $chk = Customer::where(['business_id' =>$businessId  ,'fname' => $member->first_name,'lname' => $member->last_name ,'email' => $member->email])->first();
            if(!$chk){
                $familyCus = Customer::create([
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
                    'relationship' =>$member->relationship,
                    'request_status' =>1,
                ]);
                $familyCus->create_stripe_customer_id();
            }
        }

        /*$cardData = StripePaymentMethod::where(['user_id' => $detail->id , 'user_type' => 'User' ])->get();

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
        }*/

        /*$paymentHistory = Transaction::where('user_type', 'User')
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
        }*/
    }

    function getUserbookingDetail($sid,$cid)
    {
        return UserBookingDetail::where(['sport'=> $sid ,'user_id'=>$cid])->whereDate('expired_at' ,'>' ,date('Y-m-d'))->orderby('created_at','desc')->get();
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
        $customersId = Customer::where('user_id' ,Auth::user()->id)->pluck('id')->toArray();
        if(!empty($customersId)){
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
       
       return $notifications = array();
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

    function cityCount($city){
        $company = CompanyInformation::where('city',$city)->pluck('id')->toArray();
        //print_r($company);
        $count =  BusinessServices::whereIn('cid',$company)->count();
        return $count;
    }

    function countryName($city){
       return CompanyInformation::where('city',$city)->pluck('country')->first(); 
    }

    function sidebarUpdatesNotification()
    {
        $viewData = '';  $todayBooking =  $services = $topBookedCategories = $notificationAry = $transaction = $businessServices = $usDetail =$topBookedPriceId= [];

        $business_id = Auth::user()->cid;
        $company = CompanyInformation::find($business_id);

        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        if($company){
            $services = $company->service()->orderby('created_at')->take(5)->get();
            $todayBooking = $company->UserBookingDetails()->whereDate('created_at', '=', date('Y-m-d'))->get();

            $formatNotification = function ($userData, $action, $type, $text) {
                $image = Storage::disk('s3')->exists(@$userData->profile_pic) ? Storage::url(@$userData->profile_pic) : '';
                $date = new DateTime($action->created_at);

                return [
                    "title" => @$userData->full_name . $text,
                    "image" => $image,
                    "type"  => $type,
                    "text"  => $type === 'comment' ? $action->comment : '',
                    "date"  => $date->format('d M, Y'),
                    "fl"    => @$userData->first_letter,
                ];
            };

            $pagepostIds = App\PagePost::where(['page_id'=>$business_id,'user_id' =>Auth::user()->id])->pluck('id');   

            $expiredMembership = App\UserBookingDetail::where(['business_id'=>$business_id])->whereDate('expired_at', '>=', $startOfWeek)->whereDate('expired_at', '<=', $endOfWeek)->get();
            $clientsBirthdayList  = App\Customer::where(['business_id'=>$business_id])->whereMonth('birthdate', '=', now()->month)->get();

            $staffsBirthdayList  = App\BusinessStaff::where(['business_id'=>$business_id])->whereMonth('birthdate', '=', now()->month)->get();

            $clientsBirthdayList  = App\Customer::where(['business_id'=>$business_id])->whereMonth('birthdate', '=', now()->month)->get();

            $staffsBirthdayList  = App\BusinessStaff::where(['business_id'=>$business_id])->whereMonth('birthdate', '=', now()->month)->get();
            
            $newClients = App\Customer::where(['business_id'=>$business_id])->whereDate('created_at', '>=', $startOfWeek)->whereDate('created_at', '<=', $endOfWeek)->get();

            $cardDetails = App\Customer::where('business_id',$business_id)->leftJoin('stripe_payment_methods as spm' , 'spm.user_id' ,'=' ,'customers.id')->where('spm.user_type','Customer')->whereYear('spm.exp_year', '=', now()->year)->whereMonth('exp_month', '=', now()->month)->get();

            $comments = App\PagePostComments::whereIn('post_id',$pagepostIds)
                        ->where('user_id','!=',Auth::user()->id)
                        ->whereDate('created_at', '>=', $startOfWeek)
                        ->whereDate('created_at', '<=', $endOfWeek)
                        ->get();

            $postlikes = App\PagePostLikes::whereIn('post_id',$pagepostIds)
                        ->where('user_id','!=',Auth::user()->id)
                        ->whereDate('created_at', '>=', $startOfWeek)
                        ->whereDate('created_at', '<=', $endOfWeek)
                        ->get();

            $commentslikes = App\PagePostCommentsLike::whereIn('post_id',$pagepostIds)
                    ->where('user_id','!=',Auth::user()->id)
                    ->whereDate('created_at', '>=', $startOfWeek)
                    ->whereDate('created_at', '<=', $endOfWeek)
                    ->get();

            $usDetail = $company->UserBookingDetails()->whereDate('created_at', '>=', $startOfWeek)
                    ->whereDate('created_at', '<=', $endOfWeek)
                   ->orderby('created_at','desc')->get();

            foreach ($newClients as $nc) {
                $notificationAry[] = $formatNotification($nc, $nc, 'client',' added as a client.');
            }

            foreach ($clientsBirthdayList as $cbl) {
                $birthdayInCurrentYear = Carbon::createFromDate(now()->year, date('m', strtotime($cbl->birthdate)),date('d', strtotime($cbl->birthdate)));
                $notificationAry[] = $formatNotification($cbl, $cbl, 'client',"'s birthday on ". $birthdayInCurrentYear->format('m/d/Y'));
            }

            foreach ($staffsBirthdayList as $sbl) {
                $birthdayInCurrentYear = Carbon::createFromDate(now()->year, date('m', strtotime($sbl->birthdate)),date('d', strtotime($sbl->birthdate)));
                $notificationAry[] = $formatNotification($sbl, $sbl, 'staff',"'s birthday on ".$birthdayInCurrentYear->format('m/d/Y'));
            }

            foreach ($comments as $com) {
                $notificationAry[] = $formatNotification($com->user, $com, 'comment',' commented on your post.');
            }

            foreach ($expiredMembership as $em) {
                $name = @$em->business_price_detail->price_title.'('.@$em->business_services->program_name.')';
                $notificationAry[] = $formatNotification($em->Customer, $em, 'booking',"'s membership of  ".$name." is expired on ". date('m/d/Y' ,strtotime($em->expired_at)));
            }

            foreach ($cardDetails as $cd) {
                $notificationAry[] = $formatNotification($em->Customer, $cd, 'card', "'s card is expired on this month");
            }

            foreach ($postlikes as $pl) {
                $notificationAry[] = $formatNotification($pl->user, $pl, 'like',' liked your post.');
            }

            foreach ($commentslikes as $cl) {
                $notificationAry[] = $formatNotification($cl->user, $cl, 'like',' liked your post comment.');
            }

            foreach ($businessServices as $bs) {
                $notificationAry[] = $formatNotification($bs->user, $bs, 'service',' added new activity "'.$bs->program_name.'".');
            }

            foreach($usDetail as $usd){
                if($usd->userBookingStatus != ''){
                    $transaction[] = $usd->userBookingStatus->Transaction()->orderby('created_at','desc')->first();
                }
            }   

            foreach ($transaction as $tr) {
                if($tr->user_type == 'user'){
                    $userData =  $tr->User;
                }else{
                    $userData = $tr->Customer;
                }
                $notificationAry[] = $formatNotification($userData, $tr, 'transaction',' made a payment of $'.$tr->amount);
            }

            $booking = $company->UserBookingDetails();
            if(!empty($booking->get())){
                foreach($booking->get() as $b){
                    if($b->business_price_detail != ''){
                        $topBookedPriceId[] = $b->business_price_detail->id;
                    }
                }
            }

            $topBookedPriceId = array_values(array_unique($topBookedPriceId));
 
            $priceDetails = App\BusinessPriceDetails::whereIn('id', $topBookedPriceId)->get();
            foreach ($priceDetails as $priceDetail) {
                $sum = 0;
                $UserBookingDetails = $priceDetail->UserBookingDetail()->whereDate('created_at', '>=',$startOfWeek->format('Y-m-d'))->whereDate('created_at', '<=',$endOfWeek->format('Y-m-d'))->get();
                foreach ($UserBookingDetails as $ubd) {
                    $sum += $ubd->subtotal + $ubd->tax + $ubd->tip - $ubd->discount + $ubd->fitnessity_fee;
                }

                if ($sum != 0) {
                    $topBooked['booked'] = count($UserBookingDetails);
                    $topBooked['name'] = $priceDetail->business_price_details_ages->category_title;
                    $topBooked['paid'] = $sum;
                    $topBookedCategories[] = $topBooked;
                }
            }

            $key_values = array_column($topBookedCategories, 'paid'); 
            array_multisort($key_values, SORT_DESC, $topBookedCategories);
        }

        return view('layouts.business.sideNotification', ['notificationAry' =>$notificationAry ,'todayBooking' => $todayBooking,'topBookedCategories' => $topBookedCategories,'services' => $services])->render();
    }

    function completeSetUpCount(){
        $counter = 0;
        $business = Auth::user()->current_company;
        if(Auth::user()->businesses()->count() > 0){
            $counter++;
        } 

        if(Auth::user()->customers()->where('business_id', Auth::user()->cid)->count() > 0){
            $counter++;
        } 

        if(Auth::user()->BusinessServices()->where('cid', Auth::user()->cid)->count() > 0){
            $counter++;
        } 

        if(Auth::user()->Products()->where('business_id', Auth::user()->cid)->count() > 0  ){
            $counter++;
        }

        if($business && @$business->business_staff()->count() > 0){
            $counter++;
        }

        if($business && @$business->UserBookingDetails()->count() > 0){
            $counter++;
        }
        
        return $counter;
    }

    function setUpPercentage(){
        $count = completeSetUpCount();
        if($count > 0){
            return number_format((($count/6) *100),2);
        }
        return 0;
    }

    function getCustomerList($type ,$value,$business_id){

        $customersIdAray = [];
        if($type == 'program'){
            $customersIdAray = UserBookingDetail::where('sport',$value)->whereNotNull('user_id')->pluck('user_id')->toArray();
        }else if($type == 'category'){
            $category = BusinessPriceDetailsAges::find($value);
            $priceIds = $category->BusinessPriceDetails()->pluck('id')->toArray();
            $customersIdAray = UserBookingDetail::whereIn('priceid',$priceIds)->pluck('user_id')->toArray();
        }elseif($type == 'custom'){
            $customList =  CustomList::find($value);
            $customersIdAray = $customList->customCientList()->pluck('customer_id')->toArray();
        }elseif($type == 'customer'){
            $customers = Customer::where('business_id',$business_id)->get();

            $customerStatus = $customers->mapToGroups(function ($customer) {
                return [$customer->is_active() => $customer];
            });

            if($value == 'Active'){
                $customersIdAray =  $customerStatus->get($value, collect())->pluck('id')->toArray();;
            }else if($value == 'InActive'){
                $customersIdAray =  $customerStatus->get($value, collect())->pluck('id')->toArray();;
            }else if($value == 'Prospect'){
                $customersIdAray =  $customerStatus->get($value, collect())->pluck('id')->toArray();;
            }else if($value == 'at-risk'){
                $customersIdAray = $customers->filter->customerAtRisk()->pluck('id')->toArray();;
            }else if($value == 'big-spenders'){
                $customersIdAray = $customers->filter->bigSpender()->pluck('id')->toArray();; 
            }
        }else if($type == 'gender'){
            $customersIdAray = Customer::where('business_id',$business_id)->where('birthdate' ,'!=' , '')->where(DB::raw('LOWER(gender)'), strtolower($value))->pluck('id')->toArray();
        }else if($type == 'age'){
            if($value == '18-29'){
                $customersIdAray =  Customer::where('business_id',$business_id)->where('birthdate' ,'!=' , '')->whereRaw("birthdate <= DATE_SUB(CURDATE(), INTERVAL 18 YEAR)")
                   ->whereRaw("birthdate >= DATE_SUB(CURDATE(), INTERVAL 29 YEAR)")->pluck('id')->toArray();
            }else if($value == '30-39'){
                $customersIdAray =  Customer::where('business_id',$business_id)->where('birthdate' ,'!=' , '')->whereRaw("birthdate <= DATE_SUB(CURDATE(), INTERVAL 30 YEAR)")
                   ->whereRaw("birthdate >= DATE_SUB(CURDATE(), INTERVAL 39 YEAR)")->pluck('id')->toArray();
            }else if($value == '40-49'){
                $customersIdAray = Customer::where('business_id',$business_id)->where('birthdate' ,'!=' , '')->whereRaw("birthdate <= DATE_SUB(CURDATE(), INTERVAL 40 YEAR)")
                   ->whereRaw("birthdate >= DATE_SUB(CURDATE(), INTERVAL 49 YEAR)")->pluck('id')->toArray();
            }else if($value == '50'){
                $customersIdAray = Customer::where('business_id',$business_id)->where('birthdate' ,'!=' , '')->whereRaw("birthdate <= DATE_SUB(CURDATE(), INTERVAL 50 YEAR)")->pluck('id')->toArray();
            }else if($value == 'kids'){
                $customersIdAray =  Customer::where('business_id',$business_id)->where('birthdate' ,'!=' , '')->whereRaw("birthdate >= DATE_SUB(CURDATE(), INTERVAL 18 YEAR)")->pluck('id')->toArray();
            }
        }else if($type == 'membership'){
            $currentDate = Carbon::now();
            if($value == 'Month'){
                $lastDateOfMonth = $currentDate->endOfMonth()->format('Y-m-d');
                $customersIdAray = UserBookingDetail::where('expired_at', '>=', $currentDate->format('Y-m-d'))->where('expired_at', '<=', $lastDateOfMonth)->whereNotNull('user_id')->pluck('user_id')->toArray();
            }else{
                $customersIdAray = UserBookingDetail::where('expired_at', '<', $currentDate)->whereNotNull('user_id')->pluck('user_id')->toArray();
            }
        }

        return $customersIdAray;
    }

    function getMemberList($cus,$value,$business_id){
        $customer = Customer::find($cus);
        $currentDate = Carbon::now();
        $lastDateOfMonth = $currentDate->endOfMonth();
        $text = '';
        if($value == 'Month'){
            $membership = $customer->bookingDetail()->whereDate('expired_at', '>=', Carbon::now()->format('Y-m-d'))->whereDate('expired_at', '<=', $lastDateOfMonth)->get();
        }else{
            $membership = $customer->bookingDetail()->whereDate('expired_at', '<', Carbon::now()->format('Y-m-d'))->get();
        }

        foreach ($membership as $key => $m) {
            $text .= ' <b>Membership Type : </b>'.$m->business_price_detail_with_trashed->price_title .'  <b>Start Date : </b>'.  date('m/d/Y' ,strtotime($m->contract_date)) .'  <b>End Date : </b>'. date('m/d/Y' ,strtotime($m->expired_at)) .'<br>';
        }

        return  $text;
    }
    // function getCustomerFilesNotifiy()
    // {
    //     return BusinessCustomerUploadFiles::where('isseen', 0)->where('status', 0)->get();
    // }
    // function getCustomerFilesNotifiy()
    // {
    //     $notifications = BusinessCustomerUploadFiles::where('isseen', 0)->where('status', 0)->get();

    //     foreach ($notifications as $notification) {
    //         $user = User::find($notification->user_id); // Assuming user_id is the column in BusinessCustomerUploadFiles that refers to the user
    //         // $notification->profile_pic = $user ? $user->profile_pic : ''; // Assuming profile_pic is the column in the users table for the profile picture
    //         if ($user && Storage::disk('s3')->exists($user->profile_pic)) {
    //             $notification->profile_pic = Storage::disk('s3')->url($user->profile_pic);            
    //         }
    //         $notification->user_name = $user->firstname . ' ' . $user->lastname;
    //     }

    //     return $notifications;
    // }
    function getCustomerFilesNotifiy()
    {
        $notifications = BusinessCustomerUploadFiles::where('isseen', 0)->where('status', 0)->get();

        foreach ($notifications as $notification) {
            $user = User::find($notification->user_id); 
            
            if ($user) {
                if (Storage::disk('s3')->exists($user->profile_pic)) {
                    $notification->profile_pic = Storage::disk('s3')->url($user->profile_pic);
                } else {
                    $notification->profile_pic = asset('default_pic.jpg'); // Path to default profile picture
                }
                $notification->user_name = $user->firstname . ' ' . $user->lastname;
            }
        }

        return $notifications;
    }
    function markNotificationsAsSeenAndProcessed($notificationIds)
    {
        BusinessCustomerUploadFiles::whereIn('id', $notificationIds)
        ->update(['isseen' => 1]);
    }

    // my function starts
    function generateUniqueCode()
    {
        do {
            $code = mt_rand(1000, 9999);
            $codeExistsInStaff = BusinessStaff::where('unique_code', $code)->exists();
            $codeExistsInUser = User::where('unique_code', $code)->exists();
        } while ($codeExistsInStaff || $codeExistsInUser);

        return $code;
    }

    // ends

?>