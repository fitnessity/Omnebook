<?php
namespace App;
use Mail;
use App\User;
use App\Customer;
use App\Miscellaneous;
use App\Newsletter;
use App\UserFamilyDetail;
use App\UserBookingStatus;
use App\Repositories\BookingRepository;
use App\Repositories\UserRepository;
use App\Repositories\SportsRepository;
use Illuminate\Support\Facades\Log;

class MailService
{
    /**
     * Send an e-mail reminder to the user.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public static function sendEmaildummy($id){
      // return mail('contact@valormmany.com','Testing mail','hello');
       
        $user = User::findOrFail($id);
        Mail::send('emails.dummytestmail', ['user' => $user], function ($m) use ($user) {
            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
            $m->to('contact@valormmanyc.com')->subject('Welcome!');
        });

        if(Mail::failures()){
            return 'fail';
        }else{
            return 'success';
        }
    }

    public static function sendEmailReminder($id)
    {
       $user = User::findOrFail($id);
       Mail::send('emails.welcome', ['user' => $user], function ($m) use ($user) {
            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
            $m->to($user->email, $user->firstname.' '.$user->lastname)->subject('Welcome!');
        });
    }
    public static function sendEmailReportedFeed($data,$report_notes, $is_post_reported, $id)
    {
        $user = User::findOrFail(getLoggedInUserId());
        $user_name = $user->firstname.' '.$user->lastname;
        //send mail to user
        Mail::send('emails.report-feed', ['data' => $data, 'report_notes' =>$report_notes, 'reported_user_name' => $user_name, 'report_user_email'=>$user->email, 'is_post_reported'=>$is_post_reported, 'user' => $user], function ($m) use ($data, $user) {
            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
            $m->to($user->email, $user->firstname.' '.$user->lastname)->subject('Fitnessity: Thank you for your feedback !');
        });
        $admin = User::where('role', 'admin')->first();
        //send mail to admin
        Mail::send('emails.report-feed-admin', ['admin' => $admin, 'data' => $data, 'report_notes'=>$report_notes,'reported_user_name' => $user_name, 'report_user_email'=>$user->email, 'is_post_reported'=>$is_post_reported, 'id'=>$id], function ($m) use ($admin) {
            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
            $m->to($admin['email'], $admin['name'])->subject('Fitnessity: Someone has reported a post');
        });
    }
    public static function sendEmailBooking($booking_id)
    {
        Log::info("hbhhjhg");
        $bookingRepo = new BookingRepository;
        $booking = $bookingRepo->getBookingDetail($booking_id);
        $jobsObj = Miscellaneous::getBookingQuestionObject($booking['jobpostquestions']);
        $sportsRepo = new SportsRepository;
        $sportsList = $sportsRepo->getAllSportsNames(1);
        $user = $booking['user'];
        $professional = $booking['businessuser'];
        //customer detail

        $customer_detail = User::find($user['id']);
        $user['customer_detail']['cities'] = $customer_detail['cities']['city_name'];
        $user['customer_detail']['states'] = $customer_detail['states']['state_name'];
        //FAMILY DETAIL
        $family = json_decode($booking['user_booking_detail']['booking_detail']);
        // Log::info(json_decode($booking['user_booking_detail']['booking_detail']));

         //professional detail

        $professional_detail = User::find($professional['id']);

        $professional['professional_detail']['cities'] = $professional_detail['cities']['city_name'];

        $professional['professional_detail']['states'] = $professional_detail['states']['state_name'];
        $booking['jobpostquestions'] = $jobsObj;
        if($booking['booking_type'] == "direct") {

            // send mail to customer
            $f = $family->whoistraining;
            foreach($f as $value){
            if($value != 'me'){
             $u = UserFamilyDetail::where('user_id',$user['id'])->where('email',$value)->first();
            }
            else{
                $u = User::where('id',$user['id'])->first();
                $u['first_name'] = $u['firstname'];
                $u['last_name'] = $u['lastname'];
            }

            Mail::send('emails.booking-request', ['user' => $u, 'booking'=> $booking, 'professional' => $professional, 'sportsList' => $sportsList], function ($m) use ($user, $booking, $professional,$u,$value) {
                
                $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
                $m->to($u->email, $u->first_name.' '.$u->last_name)->subject('Fitnessity: You have new booking request!');
                //}
                
            });

        }

            // send mail to professional if it is direct hire

            Mail::send('emails.booking-request-business', ['user' => $user, 'booking'=> $booking, 'professional' => $professional, 'sportsList' => $sportsList], function ($m) use ($user, $booking, $professional) {
                $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
                $m->to($professional['email'], $professional['firstname'].' '.$professional['lastname'])->subject('Fitnessity: You have new booking request!');

            });

        }   

        else if($booking['booking_type'] == "quick") {

            //send mail to customer

         $selected_sport = $booking['user_booking_detail']['sport'];

            Mail::send('emails.booking-request-quick', ['user' => $user, 'booking'=> $booking,'sportsList' => $sportsList], function ($m) use ($user, $booking) {

                $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
                $m->to($user['email'], $user['firstname'])->subject('Instant Match Request Received');

            });

            $gender = Miscellaneous::arraysearchcustom($booking['jobpostquestions'], 'question_id', 'gender');

            // $experience_level = Miscellaneous::arraysearchcustom($booking['jobpostquestions'], 'question_id', 'best_work');

            $train_to = Miscellaneous::arraysearchcustom($booking['jobpostquestions'], 'question_id', 'train_wants');

            $personality = Miscellaneous::arraysearchcustom($booking['jobpostquestions'], 'question_id', 'best_work');

            $availability_arr = Miscellaneous::arraysearchcustom($booking['jobpostquestions'], 'question_id', 'days_available');

            $availability = explode("|", $availability_arr['answer']);

            $zipcode = @$booking['user_booking_detail']['zipcode']?$booking['user_booking_detail']['zipcode']:null;
			//Search professionals within 30 miles radius 
            $search_miles = 30;
            // Get lat and long from zip code
            $user_search_latitude = null;
            $user_search_longitude = null;
            if($zipcode != null && $zipcode){

                $latlog = Miscellaneous::getLatLong($zipcode);
                
                $lat = $latlog['lat'];
                $long = $latlog['long'];
               
                $latitudes  = [floor($lat)-1, ceil($lat)+1];
               $longitudes = [ceil($long)+1,floor($long)-1];
               $locations  = Zip_code::whereBetween('latitude', $latitudes)->whereBetween('longitude', $longitudes)->get();
              
               $zips       = []; 
               
               foreach ($locations as $location) {
                   $theta = $long - $location->longitude;
                   $dist = sin(deg2rad($lat)) * sin(deg2rad($location->latitude)) +  cos(deg2rad($lat)) * cos(deg2rad($location->latitude)) * cos(deg2rad($theta));
                   $dist = acos($dist);
                   $dist = rad2deg($dist);
                   $miles = $dist * 60 * 1.1515;
                $usermiles = ($booking['jobpostquestions'][18]==null)?100: $booking['jobpostquestions'][18]['answer'];
                   
                   if ($miles <= $usermiles){
                       $zips[] = $location->zip;
                   }
               }
            
               $professional_users= User::where(['role'=>'business'])->whereIn('zipcode',$zips)->get();
              //print_r($professional_users);die;
               
            }
            
            // find matching professionals

            $userRepo = new UserRepository;

            $professionals = $userRepo->getAllFilteredProfessionals($selected_sport, $gender['answer'], $experience_level=null, $train_to['answer'], $personality['answer'], $availability,null,null,null,$search_miles,$user_search_latitude,$user_search_longitude);

            if(!empty($professional_users) > 0) {
                foreach($professional_users as $p){
                   $tomail = $p['email'];
                    Mail::send(['html' => 'emails.booking-request-business-quick'], ['user' => $user, 'booking'=> $booking, 'professional_email' => $tomail, 'sportsList' => $sportsList], function ($m) use ($user, $booking, $tomail) {

                        $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
    
                        // $m->to($professional_email)->subject('Fitnessity: We have a new job request that matches to your skills!');
    
                        $m->to($tomail)->subject('Fitnessity: Instant Match Booking Request from '. $user['firstname'] .' '. $user['lastname'] .' in '.$user['customer_detail']['cities']);
                        
                    });
    
                  } 


            }

        }

    }

    public static function sendEmailclaimvarification($details){
        // echo $details['email'];exit();
        Mail::send('emails.business-claim-varification', ['details' => $details], function ($m) use ($details) {
            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
            $m->to($details['email'])->subject('Fitnessity: Verification code for claiming business');
        });
    }

	public static function sendEmailBookingConfirmnew($BookingDetail)
    {
        $sportsRepo = new SportsRepository;
        $sportsList = $sportsRepo->getAllSportsNames(1);
        foreach($BookingDetail as $bd1){
            $username = $bd1['user']['firstname'].' '.$bd1['user']['lastname'];
            $useremail  = $bd1['user']['email'];
            $bususeremail  = $bd1['businessuser']['business_email'];
            $bususername = $bd1['businessuser']['first_name'].' '.$bd1['businessuser']['last_name'];
        }
        Mail::send('emails.booking-confirm', ['BookingDetail' => $BookingDetail,'sportsList' => $sportsList,'useremail'=>  $useremail,'username' => $username ,'bususeremail'=>  $bususeremail,'bususername' => $bususername], function ($m) use ($BookingDetail,$sportsList,$useremail,$username,$bususeremail,$bususername) {
            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
            $m->to($useremail, $username)->subject('Fitnessity: Booking request is confirmed!');
        });

        Mail::send('emails.booking-confirm-business', ['BookingDetail' => $BookingDetail,'sportsList' => $sportsList,'bususeremail'=>  $bususeremail,'bususername' => $bususername,'useremail'=>  $useremail,'username' => $username ], function ($m) use ($BookingDetail,$sportsList,$bususeremail,$bususername,$useremail,$username) {

            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
            $m->to( $bususeremail,  $bususername)->subject('Fitnessity: YOU HAVE A NEW  BOOKING!');
        });
    }

    public static function sendEmailforchedulechange($userdata , $businessdata ,$companydata,$time,$date,$usertype,$mail_type)
    {

        if($mail_type == 'cancel'){
            $send = "emails.activity-schedule-cancel";
            $msg = 'Fitnessity: Activity Has Been Cancelled!';
        }else{
            $send = "emails.activity-reschedule";
            $msg = 'Fitnessity: Activity Has Been Rescheduled!';
        }

        Mail::send($send, ['userdata' => $userdata, 'businessdata' => $businessdata , 'companydata' => $companydata ,'time' =>$time ,'date' =>$date ,'usertype' =>$usertype,'msg'=>$msg], function ($m) use ($userdata,$businessdata,$companydata,$time,$date,$usertype,$msg) {
            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
            $m->to($userdata->email)->subject($msg);
        });

        if(Mail::failures()){
            return 'fail';
        }else{
            return 'success';
        }
    }

    public static function sendEmailtoInstructorforschedulechange($insdata , $businessdata ,$companydata,$time,$date,$mail_type)
    {

        if($mail_type == 'cancel'){
            $send = "emails.activity-schedule-cancel-instructor";
            $msg = 'Fitnessity: Activity Has Been Cancelled!';
        }else{
            $send = "emails.activity-reschedule-instructor";
            $msg = 'Fitnessity: Activity Has Been Rescheduled!';
        }

        Mail::send($send, ['insdata' => $insdata, 'businessdata' => $businessdata , 'companydata' => $companydata ,'time' =>$time ,'date' =>$date ,'msg'=>$msg], function ($m) use ($insdata,$businessdata,$companydata,$time,$date,$msg) {
            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
            $m->to($insdata->email)->subject($msg);
        });

        if(Mail::failures()){
            return 'fail';
        }else{
            return 'success';
        }
    }

    public static function sendEmailBookingConfirm($BookingDetail)
    {   
        $sportsRepo = new SportsRepository;
        $sportsList = $sportsRepo->getAllSportsNames(1);
        Mail::send('emails.booking-confirm', ['BookingDetail' => $BookingDetail,'sportsList' => $sportsList], function ($m) use ($BookingDetail) {

            $m->from( env('MAIL_FROM_ADDRESS') , 'Fitnessity');
            $m->to($BookingDetail['user']['email'], $BookingDetail['user']['firstname'].' '.$BookingDetail['user']['lastname'])->subject('Fitnessity: Booking request is confirmed!');
        });

        //send mail to professional
        Mail::send('emails.booking-confirm-business', ['BookingDetail' => $BookingDetail,'sportsList' => $sportsList], function ($m) use ($BookingDetail) {

            $m->from( env('MAIL_FROM_ADDRESS') , 'Fitnessity');
            $m->to($BookingDetail['businessuser']['business_email'], $BookingDetail['businessuser']['firstname'].' '.$BookingDetail['businessuser']['lastname'])->subject('Fitnessity: Booking request is confirmed!');

        });
    }

    public static function sendEmailReceipt($email_detail){
        Mail::send('emails.email-order-receipt', ['email_detail' => $email_detail], function ($m) use ($email_detail) {
            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
            $m->to($email_detail['email'],'')->subject('Booking Receipt');
        });
        if(Mail::failures()){
            return 'fail';
        }else{
            return 'success';
        }
    }

    public static function sendEmailBusinesslist($AllDetail){
        
        //send mail to Business email address
        Mail::send('emails.business-listed-message-business', ['AllDetail' => $AllDetail], function ($m) use ($AllDetail) {
            $comname = 'Fitnessity: '.@$AllDetail["company_data"]["company_name"].' Congratulations! Your business is now live on Fitnessity';
            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
            $m->to($AllDetail['company_data']['business_email'],'')->subject($comname);
        });

        //send mail to customer email address

        Mail::send('emails.business-listed-message', ['AllDetail' => $AllDetail], function ($m) use ($AllDetail) {
            $comname = 'Fitnessity: '.strtoupper(@$AllDetail["company_data"]["company_name"]).' IS NOW LIVE ON FITNESSITY';
            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
            $m->to($AllDetail['company_data']['business_email'], $AllDetail['company_data']['first_name'])->subject($comname);
        });
    }


    public static function sendEmailafterclaimed($AllDetail){
        Mail::send('emails.Welcome_email_for_business_afer_claim', ['AllDetail' => $AllDetail], function ($m) use ($AllDetail) {
            $first_name = 'Fitnessity';
            if(@$AllDetail['company_data']['first_name'] != ''){
                $first_name = @$AllDetail['company_data']['first_name'];
            }
            $comname = 'Welcome to Fitnessity for Business';
            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
            $m->to($AllDetail['company_data']['business_email'],  $first_name)->subject($comname);
        });
    }

    public static function sendEmailfromadmin($AllDetail){
        Mail::send('emails.business-unclaim-to-claim-success', ['AllDetail' => $AllDetail], function ($m) use ($AllDetail) {
            $comname = 'Fitnessity: CONGRATULATIONS '.strtoupper(@$AllDetail["company_data"]["company_name"]).' YOU ARE NOW LIVE ON FITNESSITY';
            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
            $m->to($AllDetail['company_data']['business_email'], $AllDetail['company_data']['first_name'])->subject($comname);
        });
        if(Mail::failures()){
            return 'fail';
        }else{
            return 'success';
        }
    }


    public static function sendEmailFeedback($data)
    {
        //send mail to user
        Mail::send('emails.fitnessity-feedback', ['data' => $data], function ($m) use ($data) {

            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
            $m->to($data['email'], $data['name'])->subject('Fitnessity: Thank you for your feedback !');

        });

        $admin = User::where('role', 'admin')->first();
        //send mail to admin

        Mail::send('emails.fitnessity-feedback-admin', ['admin' => $admin, 'data' => $data], function ($m) use ($admin) {

            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
            $m->to($admin['email'], $admin['name'])->subject('Fitnessity: New feedback');

        });

    }

    public static function sendEmailNewsletter($data)
    {
        $subject = $data['title'];
        $newsletters = Newsletter::all();
        foreach($newsletters as $newsletter)
        {
            $email[] = $newsletter->email;
        }
        Mail::send('emails.admin-newsletter', ['data' => $data], function ($m) use ($email,$subject) {
            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
            $m->to($email)->subject($subject);
        });
    }
    public static function sendEmailBookingQuote($bookingQuote,$q=null)
    {
        $bookingRepo = new BookingRepository;
        $booking = $bookingRepo->getBookingDetail($bookingQuote->booking_id);
        $booking_user = $booking['user'];
        $sportsRepo = new SportsRepository;
        $sportsList = $sportsRepo->getAllSportsNames(1);
        $quote_user = User::findOrFail($bookingQuote->user_id);    
        $quote_user['total_quotes'] = $q['total_quotes'];
        $quote_user['max_quotes'] = $q['max_quotes'];
        $UserBookingDetail = $booking['user_booking_detail'];
        //send mail to customer

        Mail::send('emails.booking-got-newquote',

                ['bookingQuote' => $bookingQuote, 'booking_user' => $booking_user, 'quote_user' => $quote_user, 'UserBookingDetail' => $UserBookingDetail, 'sportsList' => $sportsList],

                function ($m) use ($bookingQuote, $booking_user, $quote_user, $UserBookingDetail) {

                  $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
                  $m->to($booking_user['email'], $booking_user['firstname'].' '.$booking_user['lastname'])->subject('Fitnessity: Good News! A quote has been submitted to your request!');
        });
        //send mail to professional

        Mail::send('emails.booking-sent-newquote', 

                ['bookingQuote' => $bookingQuote, 'booking_user' => $booking_user, 'quote_user' => $quote_user, 'UserBookingDetail' => $UserBookingDetail, 'sportsList' => $sportsList],

                function ($m) use ($bookingQuote, $booking_user, $quote_user, $UserBookingDetail) {

                   $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
                   $m->to($quote_user['email'], $quote_user['firstname'].' '.$quote_user['lastname'])->subject('Fitnessity: Good News! Your quotes were posted successfully');

        });
       
    }

    public static function sendEmailBookingAwarded($booking_id)
    {

        $bookingRepo = new BookingRepository;

        $booking = $bookingRepo->getBookingDetail($booking_id);

        $user = $booking['user'];

        $professional = $booking['businessuser'];

        $sportsRepo = new SportsRepository;

        $sportsList = $sportsRepo->getAllSportsNames(1);

        // send mail to customer

        Mail::send('emails.booking-awarded', ['user' => $user, 'booking'=> $booking, 'professional' => $professional, 'sportsList' => $sportsList], function ($m) use ($user, $booking, $professional) {

            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');



            $m->to($user['email'], $user['firstname'].' '.$user['lastname'])->subject('Fitnessity: You have new booking request!');

        });



        // send mail to professional if it is direct hire

        Mail::send('emails.booking-awarded-business', ['user' => $user, 'booking'=> $booking, 'professional' => $professional, 'sportsList' => $sportsList], function ($m) use ($user, $booking, $professional) {

            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');



            $m->to($professional['email'], $professional['firstname'].' '.$professional['lastname'])->subject('Fitnessity: You have new booking request!');

        });

    }



    public static function sendEmailBookingReject($BookingDetail)

    {

        $sportsRepo = new SportsRepository;

        $sportsList = $sportsRepo->getAllSportsNames(1);

        //send mail to customer

        Mail::send('emails.booking-reject', ['BookingDetail' => $BookingDetail,'sportsList' => $sportsList], function ($m) use ($BookingDetail) {

            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');



            $m->to($BookingDetail['user']['email'], $BookingDetail['user']['firstname'].' '.$BookingDetail['user']['lastname'])->subject('Fitnessity: Booking request is rejected');

        });



        //send mail to professional

        Mail::send('emails.booking-reject-business', ['BookingDetail' => $BookingDetail,'sportsList' => $sportsList], function ($m) use ($BookingDetail) {

            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');



            $m->to($BookingDetail['businessuser']['business_email'], $BookingDetail['businessuser']['firstname'].' '.$BookingDetail['businessuser']['lastname'])->subject('Fitnessity: Booking request is rejected');

        });

    }



    public static function sendEmailUserProfileForReview($mail_data)

    {

        //send mail to admin

        Mail::send('emails.profile-for-review-admin', ['mailData' => $mail_data], function ($m) use ($mail_data) {

            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');



            $m->to($mail_data['adminDetails']->email, $mail_data['adminDetails']->firstname.' '.$mail_data['adminDetails']->lastname)->subject('Fitnessity: User profile to review');

        });



        //send mail to professional

        Mail::send('emails.profile-for-review-business', ['mailData' => $mail_data], function ($m) use ($mail_data) {

            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');



            $m->to($mail_data['professionalDetails']->email, $mail_data['professionalDetails']->firstname.' '.$mail_data['professionalDetails']->lastname)->subject('Fitnessity: Your profile is under Fitnessity Review Process');

        });

    }



    public static function sendEmailProfileApproved($professional_detail)

    {

        //send mail to professional

        Mail::send('emails.profile-approved-business', ['ProfessionalDetail' => $professional_detail], function ($m) use ($professional_detail) {

            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');



            $m->to($professional_detail['email'], $professional_detail['firstname'].' '.$professional_detail['lastname'])->subject('Fitnessity: Your Profile is Approved !');

        });

    }



    public static function sendEmailProfileRejected($mail_data)

    {

        //send mail to professional

        Mail::send('emails.profile-rejected-business', ['mailData' => $mail_data], function ($m) use ($mail_data) {

            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');



            $m->to($mail_data['professionalDetail']['email'], $mail_data['professionalDetail']['firstname'].' '.$mail_data['professionalDetail']['lastname'])->subject('Fitnessity: Your profile is rejected for some reason');

        });

    }



    public static function sendInvitation($emails, $inviteeUser)

    {   



        Mail::send('emails.invite', ['inviteeUser' => $inviteeUser], function($m) use ($emails, $inviteeUser)

        {    

            $m->from($inviteeUser->email, ucfirst($inviteeUser->firstname).' '.ucfirst($inviteeUser->lastname));



            // $m->to($emails)->subject(ucfirst($inviteeUser->firstname).' '.ucfirst($inviteeUser->lastname).' has invited you to join Fitnessity');

            $m->to($inviteeUser->email);

            $m->bcc($emails);

            $m->subject(ucfirst($inviteeUser->firstname).' '.ucfirst($inviteeUser->lastname).' has invited you to join Fitnessity');

        });

    }



    public static function sendContactUs($mail_data)

    { 
        // $admin = User::where('role', 'admin')->first();

        //send mail to admin
        // Mail::send('emails.contact-us', ['name' => $mail_data['name'], 'email' => $mail_data['email'], 'post_message' => nl2br($mail_data['message'])],

        //     function ($m) use ($mail_data, $admin) {

        //         $m->from($mail_data['email'], $mail_data['name']);

        //         $m->to($admin['email'], $admin['firstname'].' '.$admin['lastname'])->subject('Fitnessity: '.$mail_data['name'].' has contacted you');

        // });

        Mail::send('emails.contact-us', ['name' => $mail_data['name'], 'email' => $mail_data['email'], 'post_message' => nl2br($mail_data['message'])], function ($m) use ($mail_data) {
                $m->from(env('MAIL_FROM_ADDRESS'), $mail_data['name']);
                $m->to(env('CONTACT_EMAIL'))->subject('Fitnessity: '.$mail_data['name'].' has contacted you');
        });
    }



    public static function sendEmailSignupVerification($id)

    {

        $user = User::findOrFail($id);

        Mail::send('emails.signup-verification', ['user' => $user], function ($m) use ($user) {

            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');



            $m->to($user->email, $user->firstname.' '.$user->lastname)->subject('Email Verification');

        });

    }
    
    public static function sendEmailVerifiedAcknowledgement($id)

    {

        $user = User::findOrFail($id);

        Mail::send('emails.email-verified-acknowledgement', ['user' => $user], function ($m) use ($user) {

            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');



            $m->to($user->email, $user->firstname.' '.$user->lastname)->subject('Welcome To Fitnessity');

        });

    } 

    public static function sendEmailVerifiedAcknowledgementcustomer($id,$business_id)
    {
        $user = Customer::findOrFail($id);
        $businessdata = CompanyInformation::findOrFail($business_id);
        Mail::send('emails.email-verified-acknowledgement-customer-from-provider', ['user' => $user,'businessdata'=>$businessdata], function ($m) use ($user,$businessdata) {
            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
            $m->to($user->email, @$user->fname.' '.@$user->lname)->subject('Welcome To Fitnessity');
        });
        Mail::send('emails.email-verified-acknowledgement-customer-from-fitnessity', ['user' => $user,'businessdata'=>$businessdata], function ($m) use ($user,$businessdata) {
            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
            $m->to($user->email, @$user->fname.' '.@$user->lname)->subject('Welcome To Fitnessity');
        });

        if(Mail::failures()){
            return 'fail';
        }else{
            return 'success';
        }
    }

    public static function sendEmailSportCategoryChange($mailObj){
        Mail::send('emails.alert-sport-change', ['mailObj' => $mailObj], function ($m) use ($mailObj) {
            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
            $m->to($mailObj['email'], $mailObj['firstname'].' '.$mailObj['lastname'])->subject('New courses for '.$mailObj['main_sport']);
       });

    }
    public static function resendEmailVerificationCode($user)
    {
        Mail::send('emails.signup-verification', ['user' => $user], function ($m) use ($user) {
            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
            $m->to($user->email, $user->firstname.' '.$user->lastname)->subject('Email Verification');
        });
    }

    public static function sendEmailForMessage($mail_data)

    {

        //send mail to touser

        Mail::send('emails.emailmessage', ['mail_data' => $mail_data], function ($m) use ($mail_data) {

            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');



            $m->to($mail_data['touser']['email'], $mail_data['touser']['firstname'].' '.$mail_data['touser']['lastname'])->subject('Fitnessity:  New messages from '.$mail_data['fromuser']['firstname']);

        });

    }

    public static function sendSGEmailReceipt($email_detail){
        Mail::send('emails.email-order-receipt', ['email_detail' => $email_detail], function ($m) use ($email_detail) {
            $m->from(env('MAIL_FROM_ADDRESS'), 'Fitnessity');
            $m->to($email_detail['email'],'')->subject('Booking Receipt');
        });
        if(Mail::failures()){
            return 'fail';
        }else{
            return 'success';
        }
    }

}