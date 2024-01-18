<?php

namespace App\Repositories;
use DB;
use Auth;
use config;
use App\{MailService,Fit_Cart,UserBookingStatus,UserBookingDetail,Jobpostquestions,UserBookingQuote,BusinessServices,BusinessService,CompanyInformation,User,Customer,BusinessActivityScheduler,BusinessPriceDetails,BookingCheckinDetails};
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class BookingRepository
{
    public function __construct()
    {        
    }

    public function findById($id)
    {
        return UserBookingStatus::where('id', $id)->first();
    }

    public function getbooking_data_by_bid($bid){
        return UserBookingDetail::where('booking_id',$bid)->get();
    }

    /*public function getcurrenttabdata($type,$cid, $customer){
        $bookingDetails = [];
        $user = Auth::User();
        $company = CompanyInformation::findOrFail($cid);
        if($customer == ''){
            $customer = Customer::where(['business_id'=>$cid,'user_id'=>$user->id])->first();
            $bookingStatus = $customer->getFullUserBookingStatus($cid)->pluck('id')->toArray();
            $company_booking = $company->UserBookingDetails->whereIn('booking_id', $bookingStatus);
        }else{
            $customer = Customer::where(['id'=>$customer])->first();
            $company_booking = $company->UserBookingDetails->where('user_id',$customer->id); 
        }
        
        $current_date = new DateTime();
        foreach($company_booking as $bd){
            if(new DateTime($bd->expired_at) > $current_date && $bd->expired_at != ''){
                if($type == null){
                    $bookingDetails [] = $bd; 
                }else{
                    if($bd->business_services_with_trashed != '' && $bd->business_services_with_trashed->service_type == $type){
                        $bookingDetails [] = $bd; 
                    }
                }
            }
        }
        return $bookingDetails;
    }*/

    /*public function getCurrentUserBookingDetails($serviceType, $business_id, $customer){
        $user = Auth::user();
        $BookingDetail = [];
         $company = CompanyInformation::findOrFail($business_id);
        if($customer == ''){
            $customer = Customer::where(['business_id'=>$business_id,'user_id'=>$user->id])->first();
            $bookingStatus = $customer->getFullUserBookingStatus($business_id)->pluck('id')->toArray();
            $company_booking = $company->UserBookingDetails->whereIn('booking_id', $bookingStatus); 
        }else{
            $customer = Customer::where(['id'=>$customer])->first();
            $company_booking = $company->UserBookingDetails->where('user_id',$customer->id); 
        }
        
        foreach ($company_booking as $key => $bookValue) {
            $business_services = $bookValue->business_services_with_trashed;
            if(@$business_services->service_type == $serviceType){
                $BookingDetail [] = $bookValue; 
            }else if($serviceType == null || $serviceType == 'all'){
                $BookingDetail [] = $bookValue; 
            }
        }
        return $BookingDetail;
    }*/

    public function getdeepdetailoforder($BookingDetail,$chkVal){
        $full_ary = [];
        foreach($BookingDetail as $book_details){
            $chk = $chkVal;

            if(@$book_details['bookedtime'] != '' && @$book_details['expired_at'] != '' ){
                if(date("Y-m-d", strtotime($book_details['bookedtime'])) < date('Y-m-d') && date("Y-m-d", strtotime($book_details['expired_at'])) > date('Y-m-d')){
                        $chk = 'not';
                }
            }
           
            if(@$book_details['bookedtime'] == '' ){
                $sc_date = date("m-d-Y", strtotime($book_details['expired_at']));
            }else{
                $sc_date = date("m-d-Y", strtotime($book_details['bookedtime']));
            }

            $sc_date = str_replace('-', '/', $sc_date);  
            $datechk = 0;
            if(date('Y-m-d',strtotime($sc_date)) == date('Y-m-d') && $chk == 'today'){
                $datechk = 1;
                $dateforchk = date('Y-m-d');
            }

            if(date('Y-m-d',strtotime($sc_date)) > date('Y-m-d') && $chk == 'upcoming'){
                $datechk = 1;
                $dateforchk = date('Y-m-d',strtotime($sc_date));
            }

            if(date('Y-m-d',strtotime($sc_date)) < date('Y-m-d') && $chk == 'past'){
                $datechk = 1;
                $dateforchk = date('Y-m-d',strtotime($sc_date));
            }

            if($datechk == 1){
                $full_ary[] =  $book_details;
            }   
        }
        return $full_ary;
    }

    public function currentTab($serviceType, $business_id,$customer){
        $bookingDetail = [];
        $now = Carbon::now();
        if($customer){
            if($serviceType== null || $serviceType == 'all'){
                $bookingDetail = @$customer->active_memberships()->get();
            }else{
                $bookingDetail = @$customer->active_memberships()->join('business_services', 'user_booking_details.sport', '=', 'business_services.id')->where('business_services.service_type',$serviceType)->get();
            }
        }
        //print_r($bookingDetail);exit();
        return $bookingDetail;
    } 

    public function otherTab($serviceType,$business_id,$customer){
        $checkInDetail = BookingCheckinDetails::where('customer_id',@$customer->id)
        //->orWhere('booked_by_customer_id',@$customer->id)
        ->get();
        return $checkInDetail;
    }

    public function searchFilterData($checkInDetail,$chkVal,$serviceType ,$date){
        $bookingDetail= [];
        $now = Carbon::now();
        foreach($checkInDetail as $chkInDetail) { 
            if($serviceType== null || $serviceType == 'all'){
                $userBookinDetail = UserBookingDetail::where('id',$chkInDetail->booking_detail_id);
            }else{
                $userBookinDetail = UserBookingDetail::join('business_services', 'user_booking_details.sport', '=', 'business_services.id')->where('business_services.service_type',$serviceType)->where('user_booking_details.id',$chkInDetail->booking_detail_id);
            }

            if($chkVal == 'past'){
                $userBookinDetail = $userBookinDetail->whereRaw('((user_booking_details.pay_session <= 0 or user_booking_details.pay_session is null) or user_booking_details.expired_at < now())');
            }
            if($chkVal == 'current'){
                $userBookinDetail = $userBookinDetail->select('user_booking_details.*', DB::raw('COUNT(booking_checkin_details.use_session_amount) as checkin_count') )->join('booking_checkin_details', 'user_booking_details.id', '=', 'booking_checkin_details.booking_detail_id')->groupBy('user_booking_details.id')
                ->havingRaw('(user_booking_details.pay_session - checkin_count) > 0')
                ->whereDate('user_booking_details.expired_at', '>', $now);
            }

            $userBookinDetail = $userBookinDetail->first();
            if(!empty($userBookinDetail) ){
                $bookingDetail [] = $userBookinDetail;
            }
        }
        $bookingDetail = array_unique($bookingDetail);
        //print_r($bookingDetail);exit;
        return $bookingDetail;
    }

    public function tabFilterData($checkInDetail,$chkVal,$serviceType ,$date){
        $full_ary = $bookingDetail= [];
        $now = Carbon::now();
       
        foreach($checkInDetail as $chkD){
            $datechk = 0;
            $chk = $chkVal;
            if(date('Y-m-d',strtotime($chkD->checkin_date)) == $date && $chk == 'today'){
                $datechk = 1;
            }
            if(date('Y-m-d',strtotime($chkD->checkin_date)) >  $date && $chk == 'upcoming'){
                $datechk = 1;
            }if(date('Y-m-d',strtotime($chkD->checkin_date)) < $date && $chk == 'past'){
                $datechk = 1;
            }
            if($datechk == 1){
                $full_ary[] =  $chkD;
            }
        }
        //print_r($full_ary);
        foreach($full_ary as $chkInDetail) { 
            if($serviceType== null || $serviceType == 'all'){
                $userBookinDetail = UserBookingDetail::where('id',$chkInDetail->booking_detail_id);
                if($chkVal == 'past'){
                    $userBookinDetail = $userBookinDetail->whereRaw('(expired_at < now())');
                }
            }else{
                $userBookinDetail =  UserBookingDetail::where('user_booking_details.user_id' ,'!=' , '')->join('business_services as bs', 'user_booking_details.sport', '=', 'bs.id')->where('bs.service_type',$serviceType)->where('user_booking_details.id',$chkInDetail->booking_detail_id)->select('user_booking_details.*','bs.id as activity_id','bs.service_type');
                if($chkVal == 'past'){
                    $userBookinDetail = $userBookinDetail->whereRaw('(user_booking_details.expired_at < now())');
                }
            }
            
            $userBookinDetail = $userBookinDetail->first();
            if(!empty($userBookinDetail) ){
                $bookingDetail [] = $userBookinDetail;
            }
        }

        $bookingDetail = array_unique($bookingDetail);
        return $bookingDetail;
    }

    public function getdeepdetailofcurrentorder($BookingDetail){
        $full_ary = [];
        foreach($BookingDetail as $book_details){
            $checkindetailscnt = BookingCheckinDetails::where(['booking_detail_id'=> $book_details['user_booking_detail']['id']]);
            $reserve_date = $checkindetailscnt->select('checkin_date')->orderBy('checkin_date')->first();
            $remaining =  $book_details['user_booking_detail']['pay_session'] - $checkindetailscnt->whereNotNull('checked_at')->count();;
            $BusinessPriceDetails = BusinessPriceDetails::where(['id'=>@$book_details['user_booking_detail']['priceid'],'serviceid' =>@$book_details['user_booking_detail']['sport']])->first();
            if(@$book_details['businessservices']['service_type']=='individual')
            { 
                $b_type = 'Personal Training'; 
            }else { 
                $b_type =ucfirst($book_details['businessservices']['service_type']); 
            }

            $pro_pic = url('/public/images/service-nofound.jpg');
            if ($book_details['businessservices']['profile_pic']!="") {
                $pictures = explode(',',$book_details['businessservices']['profile_pic']);
                if(!empty($pictures)){
                    if (file_exists( public_path() . '/uploads/profile_pic/' . $pictures[0])) {
                       $pro_pic = url('/public/uploads/profile_pic/'.$pictures[0]);
                    }
                }
            }

            $extra_fees = json_decode(@$book_details['user_booking_detail']['extra_fees'],true);
            $tax = $tip = $discount = $service_fee= 0;
            if(!empty($extra_fees)){
                $tax = @$extra_fees['tax'];
                $tip = @$extra_fees['tip'];
                $discount = @$extra_fees['discount'];
                $service_fee = @$extra_fees['service_fee'];
            }
            $bookingdetail = UserBookingDetail::where('id',@$book_details['user_booking_detail']['id'])->first();
            $totprice_for_this = @$bookingdetail->total();
            $name = $book_details['customer']['fname'].' '. $book_details['customer']['lname'];
            $acc_url = config('app.url').'/business/'.$book_details['customer']['business_id'].'/customers/'.$book_details['customer']['id'];
            $main_total =   number_format(($totprice_for_this   + $tax + $tip - $discount + (($totprice_for_this * $service_fee )/100)) ,2);

            $pmt_json = json_decode(@$book_details['pmt_json'],true);
            if($pmt_json['pmt_by_comp'] != 0){
                $totprice_for_this = 0;
                $main_total = 0;
            }

            $re_date = $re_time = $check_in_time ="—";
            if($reserve_date != ''){
                $start = date('h:ia', strtotime(@$reserve_date->scheduler->shift_start));
                $end = date('h:ia', strtotime(@$reserve_date->scheduler->shift_end));
                $re_date = date('m-d-Y',strtotime($reserve_date->checkin_date));
                $check_in_time = date('m-d-Y',strtotime($reserve_date->checked_at));
                $re_time = $start .' to '.$end;
            }

            $one_array = array (
                    "pro_pic" => $pro_pic,
                    "orderid" => $book_details["id"],
                    "date_booked" => date('m-d-Y',strtotime($book_details['created_at'])),
                    "orderdetailid" => $book_details['user_booking_detail']['id'],
                    "confirm_id" => $book_details["order_id"],
                    "expired_at" => date('m-d-Y',strtotime($book_details['user_booking_detail']["expired_at"])),
                    "reserve_date" => $re_date,
                    "reserve_time" => $re_time,
                    "check_in_time" => $check_in_time,
                    "price_title" => @$BusinessPriceDetails['price_title'],
                    "pay_session" => @$book_details['user_booking_detail']['pay_session'],
                    "remaing_session" => $remaining,
                    "spots_available" => @$serviceactdata['spots_available'],
                    "sc_date" => @$sc_date,
                    "shift_start" => @$serviceactdata['shift_start'],
                    "shift_end" => @$serviceactdata['shift_end'],
                    "main_total" => @$main_total,
                    "name" => $name,
                    "participate" => $book_details['user_booking_detail']['qty'],
                    "participate_name" => $book_details['user_booking_detail']['participate'],
                    "membership_type" => @$BusinessPriceDetails['membership_type'],
                    "b_type" => $b_type,
                    "company_name" =>  $book_details['businessuser']['dba_business_name'] ,
                    "company_id" =>  $book_details['businessuser']['id'] ,
                    "businessservices" =>  $book_details['businessservices'],
                    "acc_url" =>  $acc_url,
                );

                $full_ary []=$one_array;
        }
        $arayy =array_values(array_unique($full_ary, SORT_REGULAR));
        return $arayy;
    }

    public function getorderdetailsfromodid($oid,$orderdetailid){

        $booking_status = UserBookingStatus::where('id',$oid)->first();
        $booking_details = UserBookingDetail::where('id',$orderdetailid)->first();
        $business_services = $booking_details->business_services_with_trashed;
        $businessuser= @$booking_details->business_services_with_trashed->company_information;
        $BusinessPriceDetails = @$booking_details->business_price_detail_with_trashed;
        $categoty_name = @$BusinessPriceDetails->business_price_details_ages_with_trashed->category_title;
        $schedulerdata = @$booking_details->business_activity_scheduler;
        $remaining = @$booking_details->getremainingsession();
        if(@$businessuser->logo != "") {
            if (file_exists( public_path() . '/uploads/profile_pic/thumb/' . @$businessuser->logo)) {
               $com_pic = url('/public/uploads/profile_pic/thumb/' . @$businessuser->logo);
            }else {
               $com_pic = url('/public/images/service-nofound.jpg');
            }

        }else{ $com_pic = '/public/images/service-nofound.jpg'; }

        $SpotsLeftdis = 0;
           
        $totalquantity = $this->gettotalbooking(@$booking_details->act_schedule_id,@$booking_details->bookedtime);
        if( @$schedulerdata['spots_available'] != ''){
            $SpotsLeftdis =  @$schedulerdata['spots_available'] - $totalquantity;
        }

        $time= $expdate = '';
        
        if(@$schedulerdata->set_duration != ''){
            $time = $schedulerdata->get_clean_duration();
        }

        if($time == ''){
            $expdate  = $booking_details->expired_at;
            $time = $booking_details->expired_duration;
        }
        
        $sub_totprice = $tot_amount_cart = 0;

        $booking_details_for_sub_total = UserBookingDetail::where('booking_id',$booking_status->id)->get();
        foreach( $booking_details_for_sub_total as $bds){
            $sub_totprice += $bds->total();
        }

        $tot_amount_cart = @$booking_status->amount ?? 0;
        
        $qty = $booking_details->getparticipate() ?? 'N/A';
        $discount =  $service_fee = $tax_for_this = $tip =0;
        $totprice_for_this = $booking_details->total();
        if(@$booking_status->user_type == 'user'){
            $taxval = $tot_amount_cart - $sub_totprice; 
            $tax_for_this = $taxval / count(@$booking_details_for_sub_total);
            $main_total =  number_format(($tax_for_this + $totprice_for_this),2);
            $nameofbookedby = Auth::user()->firstname.' '.Auth::user()->lastname;
        }else{  
            /*$extra_fees = json_decode(@$booking_details->extra_fees,true); 
            $tax_for_this = @$extra_fees['tax'];
            $tip = @$extra_fees['tip'];
            $discount = @$extra_fees['discount'];
            $service_fee = @$extra_fees['service_fee'];*/
            $tax_for_this = @$booking_details->tax;
            $tip = @$booking_details->tip;
            $discount = @$booking_details->discount;
            $service_fee = @$booking_details->$service_fee;
            //$service_fee = ($totprice_for_this * $service_fee )/100;

            $main_total = number_format($booking_details->subtotal,2);
            $nameofbookedby = $booking_status->customer->fname.' '.$booking_status->customer->lname;
        }

        $parti_data = '';

        $parti_data = $booking_details->decodeparticipate();
        $to_rem = 0;
        $created_at = $order_id = $end_activity_date = $bookedtime = $sport_activity = $select_service_type = $activity_for = $activity_location = $price_opt = $shift_start = "—"; 
        if(@$booking_status->order_id != ''){
            $order_id = @$booking_status->order_id;
        }

        if(@$schedulerdata->spots_available != ''){
            $to_rem = $remaining.' / '.@$booking_details->pay_session;
        }
        
        $program_name = @$business_services->program_name;
        
        if(@$schedulerdata->end_activity_date != ''){
            $end_activity_date = date('d-m-Y', strtotime(@$schedulerdata->end_activity_date));
        }

        if($end_activity_date == '—'){
            $end_activity_date = date('d-m-Y', strtotime(@$booking_details->expired_at));
        }
         
        if(@$booking_details->created_at != ''){
            $created_at = date('d-m-Y', strtotime(@$booking_details->created_at));
        }

        if(@$booking_details->bookedtime != ''){
            $bookedtime = date('d-m-Y', strtotime(@$booking_details->bookedtime));
        }

        
        $sport_activity = @$business_services->sport_activity;
        $select_service_type = @$business_services->select_service_type;
        $activity_for = @$business_services->activity_for;
        $activity_location = @$business_services->activity_location;
        

        if(@$BusinessPriceDetails->price_title != ''){
            $price_opt = @$BusinessPriceDetails->price_title.' - '.@$BusinessPriceDetails->pay_session.' Sessions';
        }

        if(@$schedulerdata->shift_start != ''){
            $shift_start = date('h:i a', strtotime( @$schedulerdata->shift_start ));
        }

        $addOnServicesId = $booking_details->addOnservice_ids;
        $addOnServicesQty = $booking_details->addOnservice_qty;
        $addOnPrice= $booking_details->addOnservice_total ?? 0;

        $productIds = $booking_details->productIds;
        $productQtys = $booking_details->productQtys;
        $productTypes= $booking_details->productTypes;
        $productPrice= $booking_details->productTotalPrices ?? 0;

        $pmt_type = $booking_status->getPaymentDetail();
        //var_dump($pmt_type);
        $last4 = $pmt_type;

        $one_array = array (
            "com_pic" => $com_pic,
            'program_name' =>$program_name ?? 'N/A',
            'sport_activity' =>$sport_activity ?? 'N/A',
            'select_service_type' =>$select_service_type ?? 'N/A',
            'activity_location' =>$activity_location ?? 'N/A',
            'end_activity_date' =>$end_activity_date ?? 'N/A',
            'created_at' =>$created_at,
            'bookedtime' =>$bookedtime,
            "confirm_id" => $order_id,
            "time" => $time,
            "activity_for" => $activity_for ?? 'N/A',
            "qty" => $qty ?? 'N/A',
            "parti_data" => $parti_data ?? 'N/A',
            "last4" => $last4,
            "pmt_type" => $pmt_type,
            "shift_start" => $shift_start,
            "main_total" => @$main_total,
            "tax_for_this" => @$tax_for_this,
            "price_opt" => @$price_opt ,
            "BusinessPriceDetails" => $BusinessPriceDetails,
            "pay_session" => $booking_details['pay_session'] ? $booking_details['pay_session'].' Session' : 'N/A',
            "to_rem" => @$to_rem ,
            "totprice_for_this" => $totprice_for_this,
            "nameofbookedby" => $nameofbookedby,
            "company_name" =>  @$businessuser->dba_business_name ?? 'N/A',
            "amount" =>   $booking_status->amount,
            "discount" =>  $discount ,
            "tip" =>  $tip,
            "service_fee" =>  $service_fee,
            "categoty_name" =>   $categoty_name ?? 'N/A',
            "booking_id" =>   $oid,
            "order_id" => $orderdetailid,
            "addOnServicesId" => $addOnServicesId,
            "addOnServicesQty" => $addOnServicesQty,
            "addOnPrice" => $addOnPrice,
            "productPrice" => $productPrice,
            "productIds" => $productIds,
            "productQtys" => $productQtys,
            "productTypes" => $productTypes,
        );
       /*$arayy =array_values(array_unique($one_array, SORT_REGULAR));*/
        return $one_array;
    }

    public function getreceipemailtbody($oid,$orderdetailid){
        $booking_status = UserBookingStatus::where('id',$oid)->first();
        $booking_details = UserBookingDetail::where('id',$orderdetailid)->first();
        $business_services = $booking_details->business_services;
        $businessuser = @$booking_details->company_information;
        $BusinessPriceDetails = $booking_details->business_price_detail;
        $qty = $booking_details->getparticipate();
        

        $companyImage = $businessuser->getCompanyImage();

        $participate = $booking_details->decodeparticipate();
        $price = $booking_details->total();
        $total = ($price + $booking_details->getperoderprice());
        $discount = $booking_details->getextrafees('discount');
        $expiretime = $booking_details->getexpiretime($booking_details->expired_duration,$booking_details->contract_date);
        if($expiretime != ''){
            $expiretime =  date('m-d-Y',strtotime($expiretime));
        }else{
            $expiretime =  'N/A';
        }

        $contract_date ='N/A';
        if($booking_details->contract_date != NULL || $booking_details->contract_date != ''){
           $contract_date = date('m-d-Y',strtotime($booking_details->contract_date));
        }

        if($booking_status->user_type == 'user'){
            $email = $booking_status->user->email; 
        }

        if($booking_status->user_type == 'customer'){
            $email = $booking_status->customer->email;
        }

        $bookingUrl = '';
        if($booking_status->order_type  == 'checkout_register'){
            if($expiretime > date('m-d-Y') && $expiretime != 'N/A'){
                $tab = '';
            }else{
                $tab = 'past';
            }
        }else{
            if($booking_details->bookedtime > date('Y-m-d')){
                $tab = 'upcoming';
            }else if($booking_details->bookedtime == date('Y-m-d')){
                $tab = 'today';
            }else {
                $tab = 'past';
            }
        }
        //$bookingUrl = "{{route('personal.orders.index', ['business_id' =>".$businessuser->id.",serviceType'=>'experience','tab'=>".$tab."])}}";

        if($tab != ''){
            $bookingUrl = env('APP_URL')."/personal/orders?business_id=".$businessuser->id."&serviceType=".@$business_services->service_type."&tab=".$tab;
        }else{
            $bookingUrl = env('APP_URL')."/personal/orders?business_id=".$businessuser->id."&serviceType=".@$business_services->service_type;
        }

        $one_array =[];
        $one_array = array (
            "provider_Name" => $businessuser->dba_business_name,  
            "booking_ID" => $booking_status->order_id,  
            "program_Name" => @$business_services->program_name,   
            "category" => @$BusinessPriceDetails->business_price_details_ages->category_title,   
            "price_Option" => @$BusinessPriceDetails->price_title,  
            "sessions" => $booking_details->pay_session,  
            "membership" => @$BusinessPriceDetails->membership_type,  
            "quantity" => $qty ,  
            "participate" => $participate,  
            "activity_Type" => @$business_services->sport_activity,  
            "service_Type" => @$business_services->service_type,  
            "membership_Duration" => $booking_details->expired_duration,  
            "purchase_Date" => date('m-d-Y',strtotime($booking_details->created_at)),  
            "membership_Activation_Date" =>  $contract_date,   
            "membership_Expiration" => $expiretime,  
            "price" => $price,  
            "discount" => $discount,  
            "total" => $total,
            "email" => $email,
            "bookingUrl" => $bookingUrl,
            "companyImage" => $companyImage,
            "notes" => 'Thank you for doing business with us!',
        );

        //return json_encode($one_array); 
        return $one_array; 
    }

    public function saveBookingStatus($data,$cart=null,$n=null)
    {
        Log::info("save booking run");
        $status = true;
        $return = array();
        if(isset($data['business_id']) && $data['business_id'] > 0) {
            $professional_detail = User::where('id', $data['business_id'])->first();
            if(!$professional_detail) {
                $return['type'] = 'alert-danger';
                $return['msg']  = "No business found to book.";
                return $return;
            }
        }        
            
        // check for professional availability
        // *** pending ***
        DB::beginTransaction();

        $bookingObj = New UserBookingStatus();        
        $bookingObj->booking_type = $data['booking_type'];
        $bookingObj->user_id = $data['user_id'];
        $bookingObj->business_id = isset($data['business_id']) ? $data['business_id'] : null;
        $bookingObj->status = $data['status'] ;
        // $bookingObj->service_id = $data['service_id'] ;
        // print_r($data);
        //         die;
        if(!$bookingObj->save()) {
            $status = false;
        }        
        //save booking details
        $data['booking_id'] = $bookingObj->id;
        if($cart!=null){$cart['booking_id'] = $bookingObj->id;
        Log::info($cart);
            Fit_Cart::create($cart);}
        
        $status = $this->saveBookingDetail($data);

        if(!$status) {
            DB::rollBack();
            $return['type'] = 'danger';
            $return['alert-type'] = 'alert-danger';
            $return['msg']  = "Some error has occured while booking.";
        }else {
            DB::commit();
            try {
                if($n="no"){
                }else{
                    MailService::sendEmailBooking($bookingObj->id);
                }
            }catch (Exception $e) {
                throw new Exception("Error While sending email", 1);                
            }

            if($data['booking_type'] == "quick") {                 
                MailService::sendEmailBooking($bookingObj->id);
            }
             
            MailService::sendEmailBooking($bookingObj->id);
            $return['type'] = 'success';
            $return['alert-type'] = 'alert-success';
            $return['msg']  = "Your booking request has been sent to Business. You will get an email once booking is  confirmed by business.";
            $return['bookid'] = $bookingObj->id;
        }
        return $return;
    }

    public function saveBookingDetail($data)
    {
        $status = true;
        $detailObj = new UserBookingDetail();
        $detailObj->booking_id = $data['booking_id'];
        $detailObj->sport = $data['sport'];
        
        if($data['booking_type'] == "direct") {
            $detailObj->booking_detail = $data['booking_detail'];
            $detailObj->schedule = $data['schedule'];
            $detailObj->price = $data['price'];
        }else {
            $detailObj->zipcode = $data['zipcode'];
            $detailObj->quote_by_text = $data['quote_by_text'];
            $detailObj->quote_by_email = $data['quote_by_email'];
        }
        
        if(!$detailObj->save()) {
            $status = false;
        }
        
        //save booking questions
        if($data['booking_type'] == "quick") {
            $status = $this->saveBookingQuestion($data);
        }
        return $status;
    }

    public function saveBookingQuestion($data)
    {
        $question_record = array();
        $question_index  = 0;
        foreach ($data['question'] as $key => $value)
         {                        
            if(isset($value['answer']) && is_array($value['answer'])){
                $Ans = implode('|',$value['answer']);
            }else if(isset($value['answer']) && !is_array($value['answer'])){
                $Ans = ($value['answer']) ? $value['answer'] : '';
            }
            if(isset($value['answer']) && ($value['answer'] === 'true' || $value['answer'] === 'true' || $value['answer'] == 'Other') ){
                $optionAns = (isset($value['otheranswer']) ? $value['otheranswer'] : '');
            }else {
                $optionAns = '';
            }
            if(isset($value['answer']) && is_array($value['answer']) && in_array('true',$value['answer'])){
                $optionAns = (isset($value['otheranswer']) ? $value['otheranswer'] : '');    
            }

            $questionid = $key;
            $question_record[$question_index]['jobid'] = $data['booking_id'];
            $question_record[$question_index]['question_id'] = $questionid;
            $question_record[$question_index]['answer'] = $Ans;
            $question_record[$question_index]['other'] = $optionAns;
            $question_index ++;
        }
        if(count($question_record) > 0) {
            if(!Jobpostquestions::insert($question_record)) {
                return false;
            }
        }
        return true;
    }
    
    public function bookprofessional($data)
    {
        $booking = UserBookingStatus::find($data->booking_id);
        if(count($booking) == 0 || $booking->status != "requested") {
            $return['type'] = 'danger';
            $return['alert-type'] = 'alert-danger';
            $return['msg']  = "Invalid booking request.";
            return $return;
        }
        else if($booking->user_id != Auth::user()->id) {
            $return['type'] = 'danger';
            $return['alert-type'] = 'alert-danger';
            $return['msg']  = "This booking request is not linked with you.";
            return $return;
        }
        $booking->business_id = $data->business_id;
        if(!$booking->save()) {
            $return['type'] = 'danger';
            $return['alert-type'] = 'alert-danger';
            $return['msg']  = "Some error occured while saving request. Please try again later.";
            return $return;
        }
        try {
            MailService::sendEmailBookingAwarded($data->booking_id);
        }
        catch (Exception $e) {
            throw new Exception("Error While sending email", 1);                
        }
        $return['type'] = 'success';
        $return['alert-type'] = 'alert-success';
        $return['msg']  = "You have booked this Professional.";
        return $return;
    }

    public function confirmBooking($booking_id)
    {
        $return = array();
        $booking = UserBookingStatus::find($booking_id);
         if(@count(@$booking) == 0 || $booking->status != "requested") {
             $return['type'] = 'danger';
             $return['alert-type'] = 'alert-danger';
             $return['msg']  = "Invalid booking request.";
             return $return;
         }
         else if($booking->business_id != Auth::user()->id) {
             $return['type'] = 'danger';
             $return['alert-type'] = 'alert-danger';
             $return['msg']  = "This booking request is not linked with you.";
             return $return;
         }

        $booking->status = 'confirmed';
        if(!$booking->save()) {
            $return['type'] = 'danger';
            $return['alert-type'] = 'alert-danger';
            $return['msg']  = "Some error occured while saving request. Please try again later.";
            return $return;
        }
        try {
            $BookingDetail = $this->getBookingDetail($booking->id);
            MailService::sendEmailBookingConfirm($BookingDetail);
        }
        catch (Exception $e) {
            throw new Exception("Error While sending email", 1);                
        }
        $return['type'] = 'success';
        $return['alert-type'] = 'alert-success';
        $return['msg']  = "You have successfully confirmed your booking.";
        return $return;
    }

    public function rejectBooking($booking_id, $reject_reason)
    {
        $return = array();
        $booking = UserBookingStatus::find($booking_id);
         if(count($booking) == 0 || $booking->status != "requested") {
             $return['type'] = 'danger';
             $return['alert-type'] = 'alert-danger';
             $return['msg']  = "Invalid booking request.";
             return $return;
         }
         else if($booking->business_id != Auth::user()->id) {
             $return['type'] = 'danger';
             $return['alert-type'] = 'alert-danger';
             $return['msg']  = "This booking request is not linked with you.";
             return $return;
         }

        $booking->status = 'rejected';
        $booking->rejected_reason = $reject_reason;
        if(!$booking->save()) {
            $return['type'] = 'danger';
            $return['alert-type'] = 'alert-danger';
            $return['msg']  = "Some error occured while saving request. Please try again later.";
            return $return;
        }
        try {
            $BookingDetail = $this->getBookingDetail($booking->id);
            MailService::sendEmailBookingReject($BookingDetail);
        }
        catch (Exception $e) {
            throw new Exception("Error While sending email", 1);                
        }
        $return['type'] = 'success';
        $return['alert-type'] = 'alert-success';
        $return['msg']  = "Booking request rejected.";
        return $return;
    }

    public function getBookingList($postedUserId = null, $hiredUserId = null, $paginate = null, $status = null,$ti=null)
    {
        $query = UserBookingStatus::with('UserBookingDetail')
                    ->with('Jobpostquestions')
                    ->with('user')
                    ->with('businessuser')
                    ->orderby('user_booking_status.id', 'DESC');

        if(isset($postedUserId) && $postedUserId != null)
            $query->where('user_id', $postedUserId);

        if(isset($hiredUserId) && $hiredUserId != null && $hiredUserId > 0)
            $query->where('business_id', $hiredUserId);
        
        if(isset($status) && $status != null) {
            if(Auth::user()->role == 'customer' && $status == 'requested') {
                $query->where('booking_type', 'direct');
            }
            $query->where('status', $status);
        }  
        if(isset($ti) && $ti != null)
            $query->where('created_at', '<=' ,date('Y-m-d h:i:s',strtotime(" -1 days")));
                  
        //2019-08-09 17:22:58
        if(isset($paginate) && $paginate != null)
            return $query->paginate($paginate);

        return $query->get();
    }

    public function getBookingDetail($id)
    {
        return $query =  UserBookingStatus::select('*', 'user_booking_status.id as booking_id')
                                    ->with('UserBookingDetail')
                                    ->with('Jobpostquestions')
                                    ->with('user')
                                    ->with('businessuser')
                                //  ->with('UserBookingQuote.BookingQuoteUser')
                                    ->where('id', $id)
                                    ->first()
                                    ->toArray();
    }
    
    public function getBookingDetailnew($id)
    {
        /*\DB::enableQueryLog();*/
        return $query =  UserBookingStatus::select('*', 'user_booking_status.id as booking_id')
                                    ->with('UserBookingDetail')
                                    ->with('user')
                                    ->where('id', $id)
                                    ->first()
                                    ->toArray();
       /* dd(\DB::getQueryLog());*/
    }

    public function getBookingDetailnewdata($id,$bdid)
    {
		/*\DB::enableQueryLog();
		dd(\DB::getQueryLog());*/
        return $query =  UserBookingStatus::select('*', 'user_booking_status.id as booking_id')
                                    ->with('UserBookingDetail')
                                    ->with('user')
                                    ->where('id', $id)
                                    ->first()
                                    ->toArray();
    }

    public function getJoblistMatchingSkill($user_id, $paginate = null)
    {
        $userData = User::where('id', $user_id)
                            ->with('ProfessionalDetail')
                            ->with('service')
                            ->first()
                            ->toArray();
        $userSport = array();
        if(count($userData['service']) > 0) {
            foreach($userData['service'] as $service) {
                $userSport[] = "'".$service['sport']."'";
            }
        }
        $userSport = implode(",", $userSport);
        $userTrain_to = $userData['professional_detail']['train_to'];
        $userPersonality = $userData['professional_detail']['personality'];
        $userAvailability = explode(",", $userData['professional_detail']['availability']);
        $availability_query = '';
        if(count($userAvailability) > 0) {
            $subquery = array(); 
            foreach($userAvailability as $availability) {
                $subquery[] = " FIND_IN_SET('".$availability."', replace(question.answer, '|', ','))";                            
            }
            $subquery = implode(" OR ", $subquery);
            $availability_query = " sum(if(question.question_id = 'days_available' AND (".$subquery."), 1, 0)) as match_availability ";
        }
        $query = "SELECT booking.id as booking_id, ".
                         "sum(if(question.question_id = 'gender' AND (question.answer = '".$userData['gender']."' OR question.answer = 'no_preference'), 1, 0)) as match_gender, ".
                         "sum(if(question.question_id = 'train_wants' AND FIND_IN_SET(question.answer,'".$userTrain_to."'), 1, 0)) as match_train_to, ".
                         "sum(if(question.question_id = 'best_work' AND FIND_IN_SET(question.answer,'".$userPersonality."'), 1, 0)) as match_personality, ".
                         $availability_query.
                    "FROM user_booking_status as booking ".
                    "JOIN user_booking_details as detail ".
                        "ON detail.booking_id = booking.id ".
                        "AND detail.sport IN (".$userSport.") ".
                    "JOIN jobpostquestions as question ".
                        "ON question.jobid = booking.id ".
                    "WHERE booking_type = 'quick' ".
                    "AND booking.status != 'confirmed' ".
                    "AND booking.business_id IS NULL ".
                    "GROUP BY booking.id ".
                    "HAVING  match_gender >= 1 AND match_train_to >= 1 AND match_personality >= 1 ";
        $results = DB::select( DB::raw( $query ) );
        $booking_ids = array();
        if(!count($results)) {
            return array();
        }
        foreach($results as $result) {
            $booking_ids[] =$result->booking_id;
        }
        $query = UserBookingStatus::with('UserBookingDetail')
                    ->with('Jobpostquestions')
                    ->with('user')
                    ->with('businessuser')
                    ->whereIN('id', $booking_ids)
                    ->orderby('user_booking_status.id', 'DESC');
        
        if(isset($paginate) && $paginate != null)
            return $query->paginate($paginate);

        return $query->get();
        // $query = "SELECT booking.id as booking_id, booking.booking_type, booking.user_id, booking.status as booking_status, ".
        //                  "detail.sport, detail. booking_detail, detail.zipcode, detail.quote_by_text, detail.quote_by_email, ".
        //                  "question.*,  ".
        //                  "sum(if(question.question_id = 'gender' AND (question.answer = '".$userData['gender']."' OR question.answer = 'no_preference'), 1, 0)) as match_gender, ".
        //                  "sum(if(question.question_id = 'train_wants' AND FIND_IN_SET(question.answer,'".$userTrain_to."'), 1, 0)) as match_train_to, ".
        //                  "sum(if(question.question_id = 'best_work' AND FIND_IN_SET(question.answer,'".$userPersonality."'), 1, 0)) as match_personality, ".
        //                  $availability_query.
        //             "FROM user_booking_status as booking ".
        //             "JOIN user_booking_details as detail ".
        //                 "ON detail.booking_id = booking.id ".
        //                 "AND detail.sport IN (".$userSport.") ".
        //             "JOIN jobpostquestions as question ".
        //                 "ON question.jobid = booking.id ".
        //             "JOIN users ON users.id = booking.user_id ".
        //             "WHERE booking_type = 'quick' ".
        //             "AND booking.status != 'confirmed' ".
        //             "GROUP BY booking.id ".
        //             "HAVING  match_gender >= 1 AND match_train_to >= 1 AND match_personality >= 1 ".
        //             "ORDER BY booking.id DESC";

        // $query = UserBookingStatus::select('user_booking_status.*', 'user_booking_status.id as booking_id')
                    /*DB::raw( 
                    "sum(if(FIND_IN_SET(detail.sport,'".$userSport."'), 1, 0)) as match_sport,
                     sum(if(question.question_id = 'gender' AND question.answer = '".$userData['gender']."', 1, 0)) as match_gender,
                     sum(if(question.question_id = 'train_wants' AND FIND_IN_SET(question.answer,'".$userTrain_to."'), 1, 0)) as match_train_to, 
                     sum(if(question.question_id = 'best_work' AND FIND_IN_SET(question.answer,'".$userPersonality."'), 1, 0)) as match_personality,"
                     .$availability_query))*/
                    // ->join("user_booking_details as detail", 'detail.booking_id', '=', 'user_booking_status.id')
                    // ->join('user_booking_details as detail', function($join) use ($userSport)
                    //     {
                    //          $join->on('detail.booking_id', '=', 'user_booking_status.id')
                    //               ->whereIN('detail.sport', $userSport);
                    //     })
                    // ->join('jobpostquestions as gender_question', function($join)
                    //     {
                    //          $join->on('gender_question.jobid', '=', 'user_booking_status.id');
                    //          $join->on('gender_question.question_id', '=', 'gender');
                    //          $join->on('gender_question.answer', '=', $userData['gender']);
                    //     })
                    // ->join('jobpostquestions as train_question', function($join)
                    //     {
                    //          $join->on('train_question.jobid', '=', 'user_booking_status.id');
                    //          $join->on('train_question.question_id', '=', 'train_wants');
                    //          $join->on(DB::raw("FIND_IN_SET(question.answer,'".$userTrain_to."')"));
                    //     })
                    // ->join('jobpostquestions as personality_question', function($join)
                    //     {
                    //          $join->on('personality_question.jobid', '=', 'user_booking_status.id');
                    //          $join->on('personality_question.question_id', '=', 'best_work');
                    //          $join->on(DB::raw("FIND_IN_SET(question.answer,'".$userPersonality."')"));
                    //     })
                    // ->join('jobpostquestions as availability_question', function($join)
                    //     {
                    //          $join->on('availability_question.jobid', '=', 'user_booking_status.id');
                    //          $join->on('availability_question.question_id', '=', 'days_available');
                    //          $join->on(DB::raw(" (".$subquery.") "));
                    //     })
                    // ->with('user')
                    // ->where('booking_type', "'quick'")
                    // ->where('status', '!=' ,"'confirmed'")
                    // ->whereIN('question.question_id', '("gender", "train_wants", "best_work", "availability")')
                    // ->havingRaw("match_sport >= 1")
                    // ->havingRaw("match_gender >= 1")
                    // ->havingRaw("match_train_to >= 1")
                    // ->havingRaw("match_personality >= 1")
                    // ->havingRaw("match_availability >= 1")
                    // ->groupby('user_booking_status.id')
                    // ->orderby('user_booking_status.id', 'DESC');

        // if(isset($paginate) && $paginate != null)
            // return $query->paginate($paginate);
        //return $query->get();
        
        return $results = DB::select( DB::raw( $query ) );
    }

    public function saveBookingQuote($data,$q)
    {
        $return = array();
        if($data['id'] > 0) {
            $bookingObj = UserBookingQuote::find($data['id']);
        }else {
            $bookingObj = New UserBookingQuote();
        }        
        $bookingObj->user_id = $data['user_id'];
        $bookingObj->booking_id = $data['booking_id'];
        $bookingObj->quote_price = $data['quote_price'];
        $bookingObj->rate_type = $data['rate_type'];
        $bookingObj->quote = $data['quote'] ;
        if(!$bookingObj->save()) {
            $return['type'] = 'danger';
            $return['alert-type'] = 'alert-danger';
            $return['msg']  = "Some error has occured while posting a quote.";
        }else {
            try {
                MailService::sendEmailBookingQuote($bookingObj,$q);
            }
            catch (Exception $e) {
                throw new Exception("Error While sending email", 1);                
            }
                
            $return['type'] = 'success';
            $return['alert-type'] = 'alert-success';
            $return['msg']  = "Quote posted successfully.";
        }
        return $return;
    }
    
    public function deleteBookingQuote($id)
    {
        $return = array();
        $status = UserBookingQuote::where('id', $id)->delete();
        if(!$status){
            $return['type'] = 'danger';
            $return['alert-type'] = 'alert-danger';
            $return['msg']  = "Some error has occured while deleting a quote.";
        }else {
            $return['type'] = 'success';
            $return['alert-type'] = 'alert-success';
            $return['msg']  = "Quote deleted successfully.";
        }
        return $return;
    }
    
    public function getQuoteList($booking_id = null, $quote_user_id = null, $id = null, $paginate = null)
    {
        if(isset($id) && $id != null) {
            return UserBookingQuote::find($id)->toArray();
        }
        $query = UserBookingQuote::with('BookingQuoteUser');
        if(isset($booking_id) && $booking_id != null) {
            $query->where("booking_id", $booking_id);
        }
        if(isset($quote_user_id) && $quote_user_id != null) {
            $query->where("user_id", $quote_user_id);
        }
        if(isset($paginate) && $paginate != null)
            return $query->paginate($paginate);

        return $query->get();
    }
    
    public function getUserBookingListHavingQuotes($quote_user_id = null, $booking_user_id = null , $paginate = null)
    {
        $query = UserBookingStatus::select('user_booking_status.*', 'quote.quote_price','quote.rate_type', 'quote.quote', 'quote.created_at as quote_created_at', DB::raw('count(quote.id) as quote_count'))
                    ->join("user_booking_quotes as quote", DB::raw('quote.booking_id'), '=', 'user_booking_status.id')
                    ->with('UserBookingDetail')
                    ->with('Jobpostquestions')
                    ->with('user')
                    ->with('businessuser')
                    ->orderby('user_booking_status.id', 'DESC');

        if(isset($quote_user_id) && $quote_user_id != null) {
            $query->where("quote.user_id", $quote_user_id);
        }
        if(isset($booking_user_id) && $booking_user_id != null) {
            $query->where("user_booking_status.user_id", $booking_user_id);
        }
        $query->groupby('user_booking_status.id');

        if(isset($paginate) && $paginate != null)
            return $query->paginate($paginate);

        return $query->get();
    }

    public function getBookingCount($status = NULL)
    {   
        if(isset($status) && $status != '')
            return UserBookingStatus::where("status",'confirmed')->count();
        else
            return UserBookingStatus::count();
    }

    public function getTotalBookedProfessional()
    {
        return UserBookingStatus::distinct()
                ->where("business_id",'>','0')
                ->where("status",'confirmed')
                ->count(['business_id']);
    }

    public function getTotalAndMaxQuotesForBooking($booking_id)
    {
        $return['total_quotes'] = 0;
        $return['max_quotes'] = 0;

        if(isset($booking_id) && $booking_id && $booking_id > 0){
            $return['max_quotes'] = Jobpostquestions::where('jobid', $booking_id)->where('question_id', 'qoutes')->value('answer');
            $return['total_quotes'] = UserBookingQuote::where('booking_id', $booking_id)->count('id');
        }

        return $return;
    }
    
    public function getbusinessbookingsdata($sid,$date,$type,$categoryId){
        $currentDate = Carbon::now(); 
        switch ($type) {
            case 'date':
                $date = $date;
                break;

            case 'week':
                $date = $currentDate->startOfWeek()->format('Y-m-d');
                break;

            case 'month':
                $date = $currentDate->format('Y-m');
                break;
        }

        $userBookingDetail = [];
        $checkInDetail = BookingCheckinDetails::where(function ($query) use ($date, $type, $sid) {
                $query->when($type === 'week', function ($q) use ($date) {
                    $weekStart = Carbon::parse($date)->startOfWeek();
                    $weekEnd = Carbon::parse($date)->endOfWeek();
                    $q->whereBetween('checkin_date', [$weekStart, $weekEnd]);
                })
                ->when($type === 'month', function ($q) use ($date) {
                    $q->where('checkin_date', 'LIKE', $date . '%');
                })
                ->when($type === 'date', function ($q) use ($date) {
                    $q->where('checkin_date', $date);
                });
                $query->orderBy('checkin_date', 'desc');
            })->orderBy('checkin_date', 'desc')
            ->join('user_booking_details as bd','booking_checkin_details.booking_detail_id' ,'=' , 'bd.id')
            ->where('bd.sport',$sid)
            ->select('booking_checkin_details.*', 'bd.id as bdid', 'bd.sport')->orderBy('bd.bookedtime', 'desc')
            ->get();

        return $checkInDetail;
    }

    public function getbookingbyUserid($userid){
        $book_cnt = 0;
        $status = UserBookingStatus::where('user_id',$userid)->get();
        if(!empty($status) && count($status)>0){
            foreach($status as $st){
                $book_cnt += UserBookingDetail::where('booking_id',$st->id)->count();
            }
        }
        return  $book_cnt;
    }

    public function lastbookingbyUserid($userid,$customer_id){
        $data = '';
        $purchasefor = '';
        $price_title = '';
        $status = UserBookingStatus::whereRaw('((user_type = "user" and user_id = ?) or (user_type = "customer" and customer_id = ?))', [$userid, $customer_id])->orderby('created_at','Desc')->first();
        if($status != ''){
            $price  =  $status->amount;
            $book_data = UserBookingDetail::where('booking_id',$status->id)->orderby('created_at','desc')->first();
            if($book_data != ''){
                $programname = @$book_data->business_services->program_name;
                $price_title = @$book_data->business_price_detail->price_title;
                $purchasefor =  $programname.' $'.$price;
            }
        }
        return  $purchasefor.'~~'.$price_title;
    }

    public function gettotalbooking($sid,$date){
        /*$SpotsLeft = UserBookingDetail::where('act_schedule_id',$sid)->whereDate('bookedtime', '=', date('Y-m-d',strtotime($date)))->get();
        $totalquantity = 0;
        if(!empty($SpotsLeft) && count($SpotsLeft)>0){
            foreach($SpotsLeft as $data){
                $item = json_decode($data['qty'],true);
                if($item['adult'] != '')
                    $totalquantity += $item['adult'];
                if($item['child'] != '')
                    $totalquantity += $item['child'];
                if($item['infant'] != '')
                    $totalquantity += $item['infant'];
            }
        }*/
        $SpotsLeft = BookingCheckinDetails::where('business_activity_scheduler_id',$sid)->whereDate('checkin_date', '=', date('Y-m-d',strtotime($date)))->count();
        return $SpotsLeft;
    }


    public function getcheckincount($sid,$date){
        $count = BookingCheckinDetails::where('business_activity_scheduler_id',$sid)->whereDate('checkin_date','=',date('Y-m-d',strtotime($date)))->count();
        return $count;
    }

    public function getCheckinDetail($sid,$date,$user_booking_detail_id,$customer_id){
        $checkinData = BookingCheckinDetails::where(['business_activity_scheduler_id'=>$sid,'customer_id' =>$customer_id , 'booking_detail_id' =>$user_booking_detail_id])->whereDate('checkin_date','=',date('Y-m-d',strtotime($date)))->first();
        return $checkinData;
    }

    public function getOrderDetail($businessId,$st){
        $order = \app\UserBookingStatus::where(['order_type'=>'checkout_register'])->get();
        $orderdata1 = [];
        foreach($order as $odt){
            $orderdetaildata = \app\UserBookingDetail::where(['booking_id'=>$odt->id,'business_id'=>$businessId])->get();
            foreach($orderdetaildata as $odetail){
                if($st != 'all'){
                    if($odetail->business_services()->exists()){
                        if($odetail->business_services->service_type ==   $st ){
                            $orderdata1 []= $odetail;
                        }
                    }
                }else{
                    $orderdata1 []= $odetail;
                } 
            }
        }
        return $orderdata1;
    }
}