<?php

namespace App\Repositories;

use App\UserBookingStatus;
use App\UserBookingDetail;
use App\Jobpostquestions;
use App\UserBookingQuote;
use App\BusinessServices;
use App\BusinessService;
use App\CompanyInformation;
use App\User;
use App\Customer;
use App\BusinessActivityScheduler;
use App\BusinessPriceDetails;
use DB;
use Auth;
use config;
use App\MailService;
use App\Fit_Cart;
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

    public function getcurrenttabdata($type){
        $BookingDetail = [];
        $bookingstatus = UserBookingStatus::where(['user_id' => Auth::user()->id,'order_type'=>'checkout_register','user_type'=>'customer'])->orderBy('created_at','desc')->get();
        foreach ($bookingstatus as $key => $value) {
            $customer = Customer::where('id',$value['customer_id'])->first();
            $booking_details = UserBookingDetail::where('booking_id',$value->id)->orderBy('created_at','desc')->get(); 
            foreach ($booking_details as $key => $book_value) {
                $business_services = BusinessServices::where('id',$book_value->sport)->first();
                if(@$business_services != '' && $book_value['act_schedule_id'] == ''){
                    if($business_services->service_type == $type){
                        $BookingDetail_1 = $this->getBookingDetailnew($value->id);
                        $businessuser['businessuser'] = CompanyInformation::where('id', $business_services->cid)->first();
                        $BusinessServices['businessservices'] = BusinessServices::where('id',$book_value->sport)->first();
                        $customers['customer'] = $customer;
                        $customers = json_decode(json_encode($customers), true);
                        $businessuser = json_decode(json_encode($businessuser), true);
                        $BusinessServices = json_decode(json_encode($BusinessServices), true);
                        foreach($BookingDetail_1['user_booking_detail'] as  $key => $details){
                            if($details['sport'] == $book_value->sport){
                                if($BookingDetail_1['user_booking_detail'][$key]['booking_id'] = $value->id){
                                    $BookingDetail_1['user_booking_detail'] = $details;
                                }
                                $BookingDetail[] = array_merge($BookingDetail_1,$businessuser,$BusinessServices,$customers);
                            }
                        }    
                    }
                }
            }
        }

        //print_r($BookingDetail);exit;
        return $BookingDetail;
    }

    public function getalldata($type){
        $BookingDetail = [];
        $bookingstatus = UserBookingStatus::where(['user_id'=>Auth::user()->id])->orderBy('created_at','desc')->get();
        foreach ($bookingstatus as $key => $value) {
            if($value['user_type'] == 'user' ){
                $customer = User::where('id',$value['user_id'])->first();
                $customers['user'] = $customer;
            }else{
                $customer = Customer::where('id',$value['customer_id'])->first();
                $customers['customer'] = $customer;
            }
               
            $booking_details = UserBookingDetail::where('booking_id',$value->id)->orderBy('created_at','desc')->get(); 
           // print_r( $booking_details);
            foreach ($booking_details as $key => $book_value) {
               // echo "jii<br>";
                $business_services = BusinessServices::where('id',$book_value->sport)->first();
                if(@$business_services != '' && $book_value['act_schedule_id'] != ''){
                    if(@$business_services->service_type == $type){
                        $BookingDetail_1 = $this->getBookingDetailnew($value->id);
                        $businessuser['businessuser'] = CompanyInformation::where('id', $business_services->cid)->first();
                        $BusinessServices['businessservices'] = BusinessServices::where('id',$book_value->sport)->first();

                        $customers = json_decode(json_encode($customers), true);
                        $businessuser = json_decode(json_encode($businessuser), true);
                        $BusinessServices = json_decode(json_encode($BusinessServices), true);
                        foreach($BookingDetail_1['user_booking_detail'] as  $key => $details){
                            if($details['sport'] == $book_value->sport){
                                if($BookingDetail_1['user_booking_detail'][$key]['booking_id'] = $value->id){
                                    $BookingDetail_1['user_booking_detail'] = $details;
                                }
                                $BookingDetail[] = array_merge($BookingDetail_1,$businessuser,$BusinessServices,$customers);
                            }
                        }    
                    }
                }
            }
        }

        //print_r($BookingDetail);exit;
        return $BookingDetail;
    }

    public function getdeepdetailoforder($BookingDetail,$chk){
        $full_ary = [];
        foreach($BookingDetail as $book_details){
            $one_array = [];
            $data = UserBookingStatus::where('id',$book_details['user_booking_detail']['booking_id'])->first();
            $scheduleddata = json_decode(@$book_details['user_booking_detail']['booking_detail'],true);
            $sc_date = date("m-d-Y", strtotime($scheduleddata['sessiondate']));
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
                
                $serviceactdata = BusinessActivityScheduler::findById($book_details['user_booking_detail']['act_schedule_id']);
                $BusinessPriceDetails = BusinessPriceDetails::where(['id'=>@$book_details['user_booking_detail']['priceid'],'serviceid' =>@$book_details['user_booking_detail']['sport']])->first();

                if(@$book_details['businessservices']['service_type']=='individual'){ 
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

                $SpotsLeftdis = 0;

                $SpotsLeft = UserBookingDetail::where(['act_schedule_id' => $book_details['user_booking_detail']['act_schedule_id']])->whereDate('bookedtime', '=', $dateforchk)->get()->toArray();

                $totalquantity = 0;
                foreach($SpotsLeft as $data1){
                    $item = json_decode($data1['qty'],true);
                    if($item['adult'] != '')
                        $totalquantity += $item['adult'];
                    if($item['child'] != '')
                        $totalquantity += $item['child'];
                    if($item['infant'] != '')
                        $totalquantity += $item['infant'];
                }
                if( @$serviceactdata['spots_available'] != ''){
                    $SpotsLeftdis = $serviceactdata['spots_available'] - $totalquantity;
                }

                $language_name = BusinessService::where('cid',@$book_details['businessservices']['cid'])->first(); 
                $language = @$language_name->languages;

                $booking_details_for_sub_total = UserBookingDetail::where('booking_id',$book_details['user_booking_detail']['booking_id'])->get();
                $sub_totprice = 0;
                foreach( $booking_details_for_sub_total as $bds){
                    $aprice = json_decode($bds->price,true); 
                    $sub_price_adu = $sub_price_chi = $sub_price_inf = 0;
                    if( !empty($aprice['adult']) ){ 
                        $sub_price_adu = $aprice['adult']; 
                    }
                    if( !empty($aprice['child']) ){
                        $sub_price_chi = $aprice['child']; 
                    }
                    if( !empty($aprice['infant']) ){
                        $sub_price_inf = $aprice['infant']; 
                    }

                    $a = json_decode($bds->qty,true);
                    if( !empty($a['adult']) ){  
                        $sub_totprice += $sub_price_adu * $a['adult'];
                    }
                    if( !empty($a['child']) ){
                        $sub_totprice += $sub_price_chi * $a['child'];
                    }
                    if( !empty($a['infant']) ){ 
                        $sub_totprice += $sub_price_inf * $a['infant'];
                    }
                }

                $tot_amount_cart = 0;
                if(@$book_details['amount'] != ''){
                    $tot_amount_cart = @$book_details['amount'];
                }
                
                $taxval = 0;
                $totprice_for_this = 0;

                $aprice = json_decode(@$book_details['user_booking_detail']['price'],true); 
                $aprice_adu = $aprice_chi = $aprice_inf = 0;
                if( !empty($aprice['adult']) ){ 
                    $aprice_adu = $aprice['adult']; 
                }
                if( !empty($aprice['child']) ){
                    $aprice_chi = $aprice['child']; 
                }
                if( !empty($aprice['infant']) ){
                    $aprice_inf = $aprice['infant']; 
                }

                $a = json_decode(@$book_details['user_booking_detail']['qty'],true);
                if( !empty($a['adult']) ){ 
                    $totprice_for_this += $aprice_adu * $a['adult'];
                }
                if( !empty($a['child']) ){
                    $totprice_for_this += $aprice_chi * $a['child'];
                }
                if( !empty($a['infant']) ){
                    $totprice_for_this += $aprice_inf * $a['infant'];
                }

                if(@$book_details['user_type'] == 'user'){
                    $userdata = User::where('id',$data->user_id)->first();
                    $acc_url = config('app.url').'/userprofile/'.$userdata->username;
                    $taxval = $tot_amount_cart - $sub_totprice; 
                    $tax_for_this = $taxval / count(@$booking_details_for_sub_total);
                    $main_total =  $tax_for_this + $totprice_for_this;

                    $name =  @$book_details['user']['firstname'].' '.@$book_details['user']['lastname'];
                }else{  
                    $userdata = Customer::where('id',$data->customer_id)->first();
                    $acc_url = config('app.url').'/business/'.$userdata->business_id.'/customers/'.$userdata->id;
                    $extra_fees = json_decode(@$book_details['user_booking_detail']['extra_fees'],true); 
                    $tax = $extra_fees['tax'];
                    $tip = $extra_fees['tip'];
                    $discount = $extra_fees['discount'];
                    $service_fee = $extra_fees['service_fee'];
                    $service_fee = ($totprice_for_this * $service_fee )/100;
                    $main_total = $tip + $tax + $totprice_for_this - $discount + $service_fee;
                    $name =  @$book_details['customer']['fname'].' '.@$book_details['customer']['lname'];
                }

                $one_array = array (
                    "pro_pic" => $pro_pic,
                    "program_name" => $book_details['businessservices']['program_name'],
                    "orderid" => $book_details["id"],
                    "orderdetailid" => $book_details['user_booking_detail']['id'],
                    "confirm_id" => $book_details["order_id"],
                    "price_title" => @$BusinessPriceDetails['price_title'],
                    "pay_session" => @$BusinessPriceDetails['pay_session'],
                    "SpotsLeftdis" => $SpotsLeftdis,
                    "spots_available" => @$serviceactdata['spots_available'],
                    "sc_date" => @$sc_date,
                    "shift_start" => @$serviceactdata['shift_start'],
                    "shift_end" => @$serviceactdata['shift_end'],
                    "main_total" => @$main_total,
                    "name" => $name,
                    "language" => $language,
                    "participate" => $book_details['user_booking_detail']['qty'],
                    "participate_name" => $book_details['user_booking_detail']['participate'],
                    "membership_type" => $BusinessPriceDetails['membership_type'],
                    "b_type" => $b_type,
                    "company_name" =>  $book_details['businessuser']['company_name'] ,
                    "company_id" =>  $book_details['businessuser']['id'] ,
                    "businessservices" =>  $book_details['businessservices'],
                    "acc_url" =>  $acc_url,
                );

                $full_ary []= $one_array;
            }   
        }
        $arayy =array_values(array_unique($full_ary, SORT_REGULAR));
        return $arayy;
       // print_r($full_ary);                            
        //exit;
    }

    public function getdeepdetailofcurrentorder($BookingDetail){
        $full_ary = [];
        foreach($BookingDetail as $book_details){
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
                $tax = $extra_fees['tax'];
                $tip = $extra_fees['tip'];
                $discount = $extra_fees['discount'];
                $service_fee = $extra_fees['service_fee'];
            }
            $bookingdetail = UserBookingDetail::where('id',@$book_details['user_booking_detail']['id'])->first();
            $totprice_for_this = @$bookingdetail->total();
            $name = $book_details['customer']['fname'].' '. $book_details['customer']['lname'];
            $acc_url = config('app.url').'/business/'.$book_details['customer']['business_id'].'/customers/'.$book_details['customer']['id'];
            $main_total =  $totprice_for_this   + $tax + $tip - $discount + (($totprice_for_this * $service_fee )/100);

            $pmt_json = json_decode(@$book_details['pmt_json'],true);
            if($pmt_json['pmt_by_comp'] != 0){
                $totprice_for_this = 0;
                $main_total = 0;
            }

            $one_array = array (
                    "pro_pic" => $pro_pic,
                    "orderid" => $book_details["id"],
                    "date_booked" => date('m-d-Y',strtotime($book_details['created_at'])),
                    "orderdetailid" => $book_details['user_booking_detail']['id'],
                    "confirm_id" => $book_details["order_id"],
                    "price_title" => @$BusinessPriceDetails['price_title'],
                    "pay_session" => @$BusinessPriceDetails['pay_session'],
                    "spots_available" => @$serviceactdata['spots_available'],
                    "sc_date" => @$sc_date,
                    "shift_start" => @$serviceactdata['shift_start'],
                    "shift_end" => @$serviceactdata['shift_end'],
                    "main_total" => @$main_total,
                    "name" => $name,
                    "participate" => $book_details['user_booking_detail']['qty'],
                    "participate_name" => $book_details['user_booking_detail']['participate'],
                    "membership_type" => $BusinessPriceDetails['membership_type'],
                    "b_type" => $b_type,
                    "company_name" =>  $book_details['businessuser']['company_name'] ,
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
        $business_services = $booking_details->business_services;
        $businessuser= $booking_details->business_services->company_information;
        $BusinessPriceDetails = $booking_details->business_price_details;
        $categoty_name = $BusinessPriceDetails->business_price_details_ages->category_title;
        $schedulerdata = $booking_details->business_activity_scheduler;

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

        $time='';
        if(@$schedulerdata->set_duration != ''){
            $time = $schedulerdata->get_clean_duration();
        }
        $expdate = '';
        if($time == ''){
            $expdate  = $booking_details->expired_at;
            $time = $booking_details->expired_duration;
        }


        $booking_details_for_sub_total = UserBookingDetail::where('booking_id',$booking_status->id)->get();
        $sub_totprice = 0;
        foreach( $booking_details_for_sub_total as $bds){
            $sub_totprice += $bds->total();
        }

        $tot_amount_cart = 0;
        if(@$booking_status->amount != ''){
            $tot_amount_cart = @$booking_status->amount;
        }
        
        $qty = $booking_details->getparticipate();
        $discount =  $service_fee = $tax_for_this = $tip =0;
        $totprice_for_this = $booking_details->total();
        if(@$booking_status->user_type == 'user'){
            $taxval = $tot_amount_cart - $sub_totprice; 
            $tax_for_this = $taxval / count(@$booking_details_for_sub_total);
            $main_total =  $tax_for_this + $totprice_for_this;
            $nameofbookedby = Auth::user()->firstname.' '.Auth::user()->lastname;
        }else{  
            $extra_fees = json_decode(@$booking_details->extra_fees,true); 
            $tax_for_this = $extra_fees['tax'];
            $tip = $extra_fees['tip'];
            $discount = $extra_fees['discount'];
            $service_fee = $extra_fees['service_fee'];
            $service_fee = ($totprice_for_this * $service_fee )/100;
            $main_total = $tip + $tax_for_this + $totprice_for_this - $discount + $service_fee;
            $nameofbookedby = $booking_status->customer->fname.' '.$booking_status->customer->lname;
        }

        $parti_data = '';

        if($qty == ''){
            $qty = "—";
        }

        $parti_data = $booking_details->decodeparticipate();
        $to_rem = 0;
        $created_at = $order_id =  $program_name = $end_activity_date = $bookedtime = $sport_activity = $select_service_type = $activity_for = $activity_location = $price_opt = $shift_start = "—"; 
        if(@$booking_status->order_id != ''){
            $order_id = @$booking_status->order_id;
        }

        if(@$schedulerdata->spots_available != ''){
            $to_rem = $SpotsLeftdis.' / '.@$schedulerdata->spots_available;
        }
        
        if(@$business_services->program_name != ''){
            $program_name = @$business_services->program_name;
        }

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

        if(@$business_services->sport_activity != ''){
            $sport_activity = $business_services->sport_activity;
        }

        if(@$business_services->select_service_type != ''){
            $select_service_type = $business_services->select_service_type;
        }

        if(@$business_services->activity_for != ''){
            $activity_for = $business_services->activity_for;
        }

        if(@$business_services->activity_location != ''){
            $activity_location = $business_services->activity_location;
        }

        if(@$BusinessPriceDetails->price_title != ''){
            $price_opt = @$BusinessPriceDetails->price_title.' - '.@$BusinessPriceDetails->pay_session.' Sessions';
        }

        if(@$schedulerdata->shift_start != ''){
            $shift_start = date('h:i a', strtotime( @$schedulerdata->shift_start ));
        }

        $pmt_type = $booking_status->getstripedata();
        $last4 = $pmt_type;

        $one_array = array (
            "com_pic" => $com_pic,
            'program_name' =>$program_name,
            'sport_activity' =>$sport_activity,
            'select_service_type' =>$select_service_type,
            'activity_location' =>$activity_location,
            'end_activity_date' =>$end_activity_date,
            'created_at' =>$created_at,
            'bookedtime' =>$bookedtime,
            "confirm_id" => $order_id,
            "time" => $time,
            "activity_for" => $activity_for,
            "qty" => $qty,
            "parti_data" => $parti_data,
            "last4" => $last4,
            "pmt_type" => $pmt_type,
            "shift_start" => $shift_start,
            "main_total" => @$main_total,
            "tax_for_this" => @$tax_for_this,
            "price_opt" => @$price_opt ,
            "BusinessPriceDetails" => $BusinessPriceDetails,
            "to_rem" => @$to_rem ,
            "totprice_for_this" => $totprice_for_this,
            "nameofbookedby" => $nameofbookedby,
            "company_name" =>  @$businessuser->company_name,
            "amount" =>   $booking_status->amount,
            "discount" =>  $discount ,
            "tip" =>  $tip,
            "service_fee" =>  $service_fee,
            "categoty_name" =>   $categoty_name,
        );
       /*$arayy =array_values(array_unique($one_array, SORT_REGULAR));*/
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
    
    public function getbusinessbookingsdata($sid,$date){
        // disable date filter for temporary used;
        return UserBookingDetail::select('id','bookedtime','participate','priceid')->where(['sport'=>$sid])->orderBy('bookedtime', 'desc')->get();
       // return UserBookingDetail::select('id','bookedtime','participate','priceid')->where(['sport'=>$sid,'bookedtime'=> date('Y-m-d',strtotime($date))])->get();
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

    public function lastbookingbyUserid($userid){
        $data = '';
        $purchasefor = '';
        $price_title = '';
        $status = UserBookingStatus::where('user_id',$userid)->orderby('created_at','Desc')->first();
        if($status != ''){
            $price  =  $status->amount;
            $book_data = UserBookingDetail::where('booking_id',$status->id)->orderby('created_at','Desc')->first();
            $programname = $book_data->business_services->program_name;
            $price_title = $book_data->business_price_details->price_title;
            $purchasefor =  $programname.' $'.$price;
        }
        return  $purchasefor.'~~'.$price_title;
    }

    public function gettotalbooking($sid,$date){
        $SpotsLeft = UserBookingDetail::where('act_schedule_id',$sid)->whereDate('bookedtime', '=', date('Y-m-d',strtotime($date)))->get();
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
        }
        return $totalquantity;
    }
}