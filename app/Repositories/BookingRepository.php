<?php

namespace App\Repositories;

use App\UserBookingStatus;
use App\UserBookingDetail;
use App\Jobpostquestions;
use App\UserBookingQuote;
use App\BusinessServices;
use App\CompanyInformation;
use App\User;
use DB;
use Auth;
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
        $bookingstatus = UserBookingStatus::where(['user_id'=>Auth::user()->id,'order_type'=>'checkout_register'])->orderBy('created_at','desc')->get();
        foreach ($bookingstatus as $key => $value) {
            $booking_details = UserBookingDetail::where('booking_id',$value->id)->orderBy('created_at','desc')->get(); 
            foreach ($booking_details as $key => $book_value) {
                $business_services = BusinessServices::where('id',$book_value->sport)->first();
                if($business_services != ''){
                    if($business_services->service_type == $type){
                        $BookingDetail_1 = $this->getBookingDetailnew($value->id);
                        $businessuser['businessuser'] = CompanyInformation::where('id', $business_services->cid)->first();
                        $BusinessServices['businessservices'] = BusinessServices::where('id',$book_value->sport)->first();
                        $businessuser = json_decode(json_encode($businessuser), true);
                        $BusinessServices = json_decode(json_encode($BusinessServices), true);
                        foreach($BookingDetail_1['user_booking_detail'] as  $key => $details){
                            if($details['sport'] == $book_value->sport){
                                if($BookingDetail_1['user_booking_detail'][$key]['booking_id'] = $value->id){
                                    $BookingDetail_1['user_booking_detail'] = $details;
                                }
                                $BookingDetail[] = array_merge($BookingDetail_1,$businessuser,$BusinessServices);
                            }
                        }    
                    }
                }
            }
        }

        return $BookingDetail;
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
       return UserBookingDetail::select('id','bookedtime','participate','priceid')->where(['sport'=>$sid,'bookedtime'=> date('Y-m-d',strtotime($date))])->get();
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

}