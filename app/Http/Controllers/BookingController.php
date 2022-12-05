<?php
namespace App\Http\Controllers;

use Redirect;
use App\User;
use App\UserFamilyDetail;
use App\UserCustomerDetail;
use App\AddrStates;
use App\AddrCities;;
use App\Repositories\BookingRepository;
use Validator;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Input;
use Response;
use Auth;
use Hash;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Miscellaneous;
use Image;
use File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;
use DB;
use App\Fit_background_check_faq;
use App\Fit_vetted_business_faq;
use App\MailService;
use App\Evident;
use App\Evidents;
use App\Sports;
use App\ProfileSave;
use App\InstantForms;
use Session;
use App\Repositories\SportsRepository;
use View;
use Mail;
use Twilio\Rest\Client;
use App\Services\TwilioService;
use Twilio\TwiML\VoiceResponse;
use App\Languages;
use App\UserFavourite;
use App\BusinessExperience;
use App\BusinessInformation;
use App\BusinessService;
use App\BusinessServices;
use App\BusinessPriceDetails;
use App\CompanyInformation;
use App\BusinessActivityScheduler;
use App\UserBookingStatus;
use App\UserBookingDetail;
use Carbon\Carbon;

use Request as resAll;

class BookingController extends Controller {

	protected $sports;
    public function __construct(UserRepository $users, BookingRepository $bookings, Request $request, SportsRepository $sports) {
        $this->users = $users;
        $this->bookings = $bookings;
        $this->sports = $sports;
    }

    public function bookinginfo(Request $request) {
        $user = User::where('id', Auth::user()->id)->first();
        $city = AddrCities::where('id', $user->city)->first();
        $UserProfileDetail['firstname'] = $user->firstname;
        $UserProfileDetail['lastname'] = $user->lastname;
        $UserProfileDetail['gender'] = $user->gender;
        $UserProfileDetail['username'] = $user->username;
        $UserProfileDetail['phone_number'] = $user->phone_number;
        $UserProfileDetail['address'] = $user->address;
        $UserProfileDetail['quick_intro'] = $user->quick_intro;
        $UserProfileDetail['birthdate'] = date('m d,Y', strtotime($user->birthdate));
        $UserProfileDetail['email'] = $user->email;
        $UserProfileDetail['favorit_activity'] = $user->favorit_activity;
        $UserProfileDetail['email'] = $user->email;

        $UserProfileDetail['cover_photo'] = $user->cover_photo;
        if (empty($city)) {
            $UserProfileDetail['city'] = $user->city;
        } else {
            $UserProfileDetail['city'] = $city->city_name;
        }
        $state = AddrStates::where('id', $user->state)->first();
        if (empty($state)) {
            $UserProfileDetail['state'] = $user->state;
        } else {
            $UserProfileDetail['state'] = $state->state_name;
        }
        $UserProfileDetail['country'] = $user->country;
        
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        
        $BookingDetail = [];
        $bookingstatus = UserBookingStatus::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        foreach ($bookingstatus as $key => $value) {
            $booking_details = UserBookingDetail::where('booking_id',$value->id)->orderBy('created_at','desc')->get(); 
            foreach ($booking_details as $key => $book_value) {
                $business_services = BusinessServices::where('id',$book_value->sport)->first();
                if($business_services != ''){
                    if($business_services->service_type == 'individual'){
                        $BookingDetail_1 = $this->bookings->getBookingDetailnew($value->id);
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
     /*   print_r($BookingDetail);exit;*/
        return view('personal-profile.booking-info', [ 'BookingDetail' => $BookingDetail ,'UserProfileDetail' => $UserProfileDetail, 'cart' => $cart]);
    }

     public function gym_studio_page(Request $request){
        $user = User::where('id', Auth::user()->id)->first();
        $city = AddrCities::where('id', $user->city)->first();
        $UserProfileDetail['firstname'] = $user->firstname;
        $UserProfileDetail['lastname'] = $user->lastname;
        $UserProfileDetail['gender'] = $user->gender;
        $UserProfileDetail['username'] = $user->username;
        $UserProfileDetail['phone_number'] = $user->phone_number;
        $UserProfileDetail['address'] = $user->address;
        $UserProfileDetail['quick_intro'] = $user->quick_intro;
        $UserProfileDetail['birthdate'] = date('m d,Y', strtotime($user->birthdate));
        $UserProfileDetail['email'] = $user->email;
        $UserProfileDetail['favorit_activity'] = $user->favorit_activity;
        $UserProfileDetail['email'] = $user->email;

        $UserProfileDetail['cover_photo'] = $user->cover_photo;
        if (empty($city)) {
            $UserProfileDetail['city'] = $user->city;
            ;
        } else {
            $UserProfileDetail['city'] = $city->city_name;
        }
        $state = AddrStates::where('id', $user->state)->first();
        if (empty($state)) {
            $UserProfileDetail['state'] = $user->state;
            ;
        } else {
            $UserProfileDetail['state'] = $state->state_name;
        }
        $UserProfileDetail['country'] = $user->country;
        
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }

        $BookingDetail = [];
        $bookingstatus = UserBookingStatus::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        foreach ($bookingstatus as $key => $value) {
            $booking_details = UserBookingDetail::where('booking_id',$value->id)->get(); 
            foreach ($booking_details as $key => $book_value) {
                $business_services = BusinessServices::where('id',$book_value->sport)->orderBy('created_at','desc')->first();
                if($business_services != ''){
                    if($business_services->service_type == 'classes'){
                        $BookingDetail_1 = $this->bookings->getBookingDetailnew($value->id,$book_value->id);
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
       
       /* print_r($BookingDetail);exit;*/
        return view('personal-profile.booking_gym_studio', ['BookingDetail' => $BookingDetail ,'UserProfileDetail' => $UserProfileDetail, 'cart' => $cart]);
    }

    public function experience_page(Request $request){
        $user = User::where('id', Auth::user()->id)->first();
        $city = AddrCities::where('id', $user->city)->first();
        $UserProfileDetail['firstname'] = $user->firstname;
        $UserProfileDetail['lastname'] = $user->lastname;
        $UserProfileDetail['gender'] = $user->gender;
        $UserProfileDetail['username'] = $user->username;
        $UserProfileDetail['phone_number'] = $user->phone_number;
        $UserProfileDetail['address'] = $user->address;
        $UserProfileDetail['quick_intro'] = $user->quick_intro;
        $UserProfileDetail['birthdate'] = date('m d,Y', strtotime($user->birthdate));
        $UserProfileDetail['email'] = $user->email;
        $UserProfileDetail['favorit_activity'] = $user->favorit_activity;
        $UserProfileDetail['email'] = $user->email;

        $UserProfileDetail['cover_photo'] = $user->cover_photo;
        if (empty($city)) {
            $UserProfileDetail['city'] = $user->city;
            ;
        } else {
            $UserProfileDetail['city'] = $city->city_name;
        }
        $state = AddrStates::where('id', $user->state)->first();
        if (empty($state)) {
            $UserProfileDetail['state'] = $user->state;
            ;
        } else {
            $UserProfileDetail['state'] = $state->state_name;
        }
        $UserProfileDetail['country'] = $user->country;
        
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }

        $BookingDetail = [];
        $bookingstatus = UserBookingStatus::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        foreach ($bookingstatus as $key => $value) {
            $booking_details = UserBookingDetail::where('booking_id',$value->id)->get(); 
            foreach ($booking_details as $key => $book_value) {
                $business_services = BusinessServices::where('id',$book_value->sport)->orderBy('created_at','desc')->first();
                if($business_services != ''){
                    if($business_services->service_type == 'experience'){
                        $BookingDetail_1 = $this->bookings->getBookingDetailnew($value->id);
                        $businessuser['businessuser'] = CompanyInformation::where('id', $business_services->cid)->first();
                        $BusinessServices['businessservices'] = BusinessServices::where('id',$book_value->sport)->first();
                        $businessuser = json_decode(json_encode($businessuser), true);
                        $BusinessServices = json_decode(json_encode($BusinessServices), true);
                        foreach($BookingDetail_1['user_booking_detail'] as  $key => $details){
                            if($details['sport'] == $book_value->sport){
                                if($BookingDetail_1['user_booking_detail'][$key]['booking_id'] = $book_value->sport){
                                    $BookingDetail_1['user_booking_detail'] = $details;
                                }
                                $BookingDetail[] = array_merge($BookingDetail_1,$businessuser,$BusinessServices);
                            }
                        }
                    } 
                }
            }
        }
        /*print_r($BookingDetail);exit;*/
       return view('personal-profile.booking_experience', ['BookingDetail' => $BookingDetail ,'UserProfileDetail' => $UserProfileDetail, 'cart' => $cart]);
    }


    public function events_page(Request $request){
        $user = User::where('id', Auth::user()->id)->first();
        $city = AddrCities::where('id', $user->city)->first();
        $UserProfileDetail['firstname'] = $user->firstname;
        $UserProfileDetail['lastname'] = $user->lastname;
        $UserProfileDetail['gender'] = $user->gender;
        $UserProfileDetail['username'] = $user->username;
        $UserProfileDetail['phone_number'] = $user->phone_number;
        $UserProfileDetail['address'] = $user->address;
        $UserProfileDetail['quick_intro'] = $user->quick_intro;
        $UserProfileDetail['birthdate'] = date('m d,Y', strtotime($user->birthdate));
        $UserProfileDetail['email'] = $user->email;
        $UserProfileDetail['favorit_activity'] = $user->favorit_activity;
        $UserProfileDetail['email'] = $user->email;

        $UserProfileDetail['cover_photo'] = $user->cover_photo;
        if (empty($city)) {
            $UserProfileDetail['city'] = $user->city;
            ;
        } else {
            $UserProfileDetail['city'] = $city->city_name;
        }
        $state = AddrStates::where('id', $user->state)->first();
        if (empty($state)) {
            $UserProfileDetail['state'] = $user->state;
            ;
        } else {
            $UserProfileDetail['state'] = $state->state_name;
        }
        $UserProfileDetail['country'] = $user->country;
        
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }

        $BookingDetail = [];
        $bookingstatus = UserBookingStatus::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        foreach ($bookingstatus as $key => $value) {
            $booking_details = UserBookingDetail::where('booking_id',$value->id)->get(); 
            foreach ($booking_details as $key => $book_value) {
                $business_services = BusinessServices::where('id',$book_value->sport)->orderBy('created_at','desc')->first();
                if($business_services != ''){
                    if($business_services->service_type == 'events'){
                        $BookingDetail_1 = $this->bookings->getBookingDetailnew($value->id);
                        $businessuser['businessuser'] = CompanyInformation::where('id', $business_services->cid)->first();
                        $BusinessServices['businessservices'] = BusinessServices::where('id',$book_value->sport)->first();
                        $businessuser = json_decode(json_encode($businessuser), true);
                        $BusinessServices = json_decode(json_encode($BusinessServices), true);
                        foreach($BookingDetail_1['user_booking_detail'] as  $key => $details){
                            if($details['sport'] == $book_value->sport){
                                if($BookingDetail_1['user_booking_detail'][$key]['booking_id'] = $book_value->sport){
                                    $BookingDetail_1['user_booking_detail'] = $details;
                                }
                                $BookingDetail[] = array_merge($BookingDetail_1,$businessuser,$BusinessServices);
                            }
                        }
                    } 
                }
            }
        }
        /*print_r($BookingDetail);exit;*/
       return view('personal-profile.booking_events', ['BookingDetail' => $BookingDetail ,'UserProfileDetail' => $UserProfileDetail, 'cart' => $cart]);
    }

    public function getreceiptmodel(Request $request) {
        $booking_status = UserBookingStatus::where('id',$request->orderid)->first();
        $booking_details = UserBookingDetail::where('id',$request->orderdetailid)->first();
        $business_services = BusinessServices::where('id',@$booking_details->sport)->first();
        $businessuser= CompanyInformation::where('id', @$business_services->cid)->first();
        $BusinessPriceDetails = BusinessPriceDetails::where(['id'=>@$booking_details->priceid,'serviceid' =>@$booking_details->sport])->first();
        $schedulerdata = BusinessActivityScheduler::where(['serviceid' => @$booking_details->sport ,'id' =>@$booking_details->act_schedule_id ])->first();

        if(@$businessuser->logo != "") {
            if (file_exists( public_path() . '/uploads/profile_pic/thumb/' . @$businessuser->logo)) {
               $com_pic = url('/public/uploads/profile_pic/thumb/' . @$businessuser->logo);
            }else {
               $com_pic = url('/public/images/service-nofound.jpg');
            }

        }else{ $com_pic = '/public/images/service-nofound.jpg'; }

        $SpotsLeftdis = 0;
        $SpotsLeft = [];
        $SpotsLeft = UserBookingDetail::where('act_schedule_id' ,@$booking_details->act_schedule_id)->whereDate('bookedtime', '=', @$booking_details->bookedtime)->get()->toArray();
        
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
        if( @$schedulerdata['spots_available'] != ''){
            $SpotsLeftdis =  @$schedulerdata['spots_available'] - $totalquantity;
        }

        $time='';
        if(@$schedulerdata->set_duration != ''){
            $tm = explode(' ',$schedulerdata->set_duration);
            $hr=''; $min=''; $sec='';
            if($tm[0]!=0){ $hr=$tm[0].' hour '; }
            if($tm[2]!=0){ $min=$tm[2].' minutes '; }
            if($tm[4]!=0){ $sec=$tm[4].' seconds'; }
            if($hr!='' || $min!='' || $sec!='')
            { $time =  $hr.$min.$sec; } 
        }


        $booking_details_for_sub_total = UserBookingDetail::where('booking_id',$request->orderid)->get();
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
        if(@$booking_status->amount != ''){
            $tot_amount_cart = @$booking_status->amount;
        }
        
        $taxval = 0;
        $taxval = $tot_amount_cart - $sub_totprice; 
        
        $tax_for_this = $taxval / count(@$booking_details_for_sub_total);

        $aprice = json_decode(@$booking_details->price,true); 
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

        $qty = '';
        $totprice_for_this = 0;
        $a = json_decode(@$booking_details->qty,true);
        if( !empty($a['adult']) ){ 
            $qty .= 'Adult: '.$a['adult']; 
            $totprice_for_this += $aprice_adu * $a['adult'];
        }
        if( !empty($a['child']) ){
            $qty .= '<br> Child: '.$a['child']; 
            $totprice_for_this += $aprice_chi * $a['child'];
        }
        if( !empty($a['infant']) ){
            $qty .= '<br>Infant: '.$a['infant']; 
            $totprice_for_this += $aprice_inf * $a['infant'];
        }

        $main_total =  $tax_for_this + $totprice_for_this;

        $parti_data = '';
        $ap = json_decode(@$booking_details->participate,true); 
        if(!empty($ap)){
            foreach($ap as $data){
                if($data['from'] == 'family'){
                    $family = UserFamilyDetail::where('id',$data['id'])->first();
                    $parti_data .= @$family->first_name.' '.@$family->last_name.'<br>';
                }else{ 
                    $parti_data .= Auth::user()->firstname.' '.Auth::user()->lastname.'<br>'; 
                } 
            } 
        }


        if(@$booking_status->order_id != ''){
            $order_id = @$booking_status->order_id;
        }else{ 
           $order_id =  "—"; 
        }

        if(@$schedulerdata->spots_available != ''){
            $to_rem = $SpotsLeftdis.' / '.@$schedulerdata->spots_available;
        }else{ 
            $to_rem = "—"; 
        }

        if(@$business_services->program_name != ''){
            $program_name = @$business_services->program_name;
        }else{
            $program_name = "—"; 
        }

        if(@$schedulerdata->end_activity_date != ''){
            $end_activity_date = date('d-m-Y', strtotime(@$schedulerdata->end_activity_date));
        }else{ 
            $end_activity_date = "—"; 
        }

        if(@$booking_details->created_at != ''){
            $created_at = date('d-m-Y', strtotime(@$booking_details->created_at));
        }else{ 
            $created_at = "—"; 
        }

        if(@$booking_details->bookedtime != ''){
            $bookedtime = date('d-m-Y', strtotime(@$booking_details->bookedtime));
        }else{ 
            $bookedtime = "—"; 
        }

        if(Auth::user()->firstname != '' && Auth::user()->lastname != ''){
            $nameofbookedby = Auth::user()->firstname.' '.Auth::user()->lastname;
        }else{ 
            $nameofbookedby = "—"; 
        }

        if(@$business_services->sport_activity != ''){
            $sport_activity = $business_services->sport_activity;
        }else{ 
            $sport_activity=  "—"; 
        } 

        if(@$business_services->select_service_type != ''){
            $select_service_type = $business_services->select_service_type;
        }else{ 
            $select_service_type=  "—"; 
        }
        if(@$business_services->activity_for != ''){
            $activity_for = $business_services->activity_for;
        }else{ 
            $activity_for=  "—"; 
        }
        if(@$business_services->activity_location != ''){
            $activity_location = $business_services->activity_location;
        }else{ 
            $activity_location=  "—"; 
        }

        if(@$business_services->activity_location != ''){
            $price_opt = @$BusinessPriceDetails->price_title.' - '.@$BusinessPriceDetails->pay_session.' Sessions';
        }else{ 
            $price_opt=  "—"; 
        }

        if(@$schedulerdata->shift_start != ''){
            $shift_start = date('h:i a', strtotime( @$schedulerdata->shift_start ));
        }else{
            $shift_start=  "—"; 
        }

        $stripe = new \Stripe\StripeClient(
            config('constants.STRIPE_KEY')
        );

        if(@$booking_status->stripe_id != ''){
            $payment_intent = $stripe->paymentIntents->retrieve(
                $booking_status->stripe_id,
                []
            );
        }

        $last4 = $payment_intent['charges']['data'][0]['payment_method_details']['card']['last4'];
        

        $html = '';
        $html .= '<div class="row"> 
                    <div class="col-lg-4 bg-sidebar">
                       <div class="your-booking-page side-part">
                            <figure>
                                <img src="'.$com_pic.'" alt="Fitnessity">
                            </figure>
                            <div class="booking-page-meta">
                                <a href="#" title="" class="underline">'.@$businessuser->company_name.'</a>
                            </div>
                            <div class="box-subtitle">
                                <h4>Transaction Complete</h4>
                                <div class="modal-inner-box">
                                    <label>'.$nameofbookedby.'</label>
                                    <h3>Email Receipt</h3>
                                    <div class="form-group">
                                        <input type="text" name="email" id="email"  placeholder="youremail@abc.com" class="form-control">
                                    </div>
                                    <button class="submit-btn btn-modal-booking" 
                                    onclick="sendemail('.$request->orderdetailid.' , '.$request->orderid.');">Send Email Receipt</button>
                                    <div class="reviewerro" id="reviewerro"></div>
                                </div>
                            </div>
                            <div class="powered-img">
                                <label>Powered By</label>
                                <div class="booking-modal-logo">
                                    <img src="'.url("/public/images/fitnessity_logo1.png").'">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="modal-booking-info">
                            <h3>Booking Receipt</h3>
                            <div class="row">
                                <div class="">
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <label>BOOKING#</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <span>'. $order_id.'</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="">
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <label>TOTAL PRICE:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <span>$'. $totprice_for_this.'</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <label>PRICE OPTION:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <span>'. $price_opt.'</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <label>TOTAL REMAINNIG:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <span>'. $to_rem.'</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <label>PROGRAM NAME:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <span>'. $program_name.'</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <label>EXPIRATION DATE:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <span>'. $end_activity_date.'</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <label>DATE BOOKED:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <span>'. $created_at.'</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <label>RESERVED DATE:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <span>'. $bookedtime.'</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <label>BOOKED BY:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <span>'. $nameofbookedby.'</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <label>CHECK IN DATE:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <span>'. $bookedtime.'</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <label>CHECK IN TIME:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <span>'. $shift_start.'</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <label>ACTIVITY TYPE:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <span>'. $sport_activity.'</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <label>SERVICE TYPE:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <span>'. $select_service_type.'</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <label>ACTIVITY LOCATION:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <span>'. $activity_location.'</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <label>ACTIVITY DURATION:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <span>'. $time.'</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <label>GREAT FOR:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <span>'. $activity_for.'</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <label>PARTICIPANTS#</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <span>'. $qty.'</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <label>WHO IS PRATICIPATING?</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-6">
                                        <div class="booking-page-meta-info">
                                            <span>'. $parti_data.'</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row border-xx mg-tp">
                                <div class="col-md-6 col-xs-6">
                                    <div class="total-titles">
                                        <label>Payment Type</label>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <div class="total-titles">
                                        <span>CC ending in ********'.$last4.'</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row border-xx">
                                <div class="col-md-6 col-xs-6">
                                    <div class="total-titles">
                                        <label>Sub-total</label>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <div class="total-titles">
                                        <span>$'.$totprice_for_this.'</span>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row border-xx">
                                <div class="col-md-6 col-xs-6">
                                    <div class="total-titles">
                                        <label>Taxes & Service Fees</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <div class="total-titles">
                                        <span>$'.$tax_for_this.'</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row border-xx">
                                <div class="col-md-6 col-xs-6">
                                    <div class="total-titles">
                                        <label>Grand Total</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    <div class="total-titles">
                                        <span>$'.$main_total.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
        return $html;
    }

    public function sendemailofreceipt(Request $request){
        $email_detail = array(
            'odetailid' => $request->odetailid,
            'oid' => $request->oid,
            'email' => $request->email);
        $status = MailService::sendEmailReceipt($email_detail);
        return $status;
    }

    public function datefilterdata(Request $request){
        if($request->page == 'personal'){
            $pagename_type = 'individual';
        }else if($request->page == 'experience'){
            $pagename_type = 'experience';
        }else if($request->page == 'gym-studio'){
            $pagename_type = 'classes';
        }else{
             $pagename_type = 'events';
        }
        $BookingDetail = [];
        $bookingstatus = UserBookingStatus::where('user_id',Auth::user()->id)->get();
        foreach ($bookingstatus as $key => $value) {
            $booking_details = UserBookingDetail::where('booking_id',$value->id)->get(); 
            foreach ($booking_details as $key => $book_value) {
                $business_services = BusinessServices::where('id',$book_value->sport)->first();
                if($business_services != ''){
                    if($business_services->service_type ==  $pagename_type){
                        $BookingDetail_1 = $this->bookings->getBookingDetailnew($value->id);
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
        
        $html = '';
        $html.='<div class="row" id="searchbydate_'.$request->type.'">';
        $i=1;
        if(!empty($BookingDetail)){
            
            foreach($BookingDetail as $book_details){
                $data = UserBookingStatus::where('id',$book_details['user_booking_detail']['booking_id'])->first();
                $scheduleddata = json_decode($book_details['user_booking_detail']['booking_detail'],true);
                $sc_date = date("m-d-Y", strtotime($scheduleddata['sessiondate']));
                $sc_date = str_replace('-', '/', $sc_date);  
        
                $chk = 0;
                if($request->type == 'past'){
                    if(date('Y-m-d',strtotime($sc_date)) < date('Y-m-d')){
                        $chk = 1;
                    }
                }else if($request->type == 'today'){
                    if(date('Y-m-d',strtotime($sc_date)) == date('Y-m-d')){
                        $chk = 1;
                    }
                }else{
                    if(date('Y-m-d',strtotime($sc_date)) > date('Y-m-d')){
                        $chk = 1;
                    }
                }

                if($sc_date == $request->date || ($request->date == '' && $chk==1)) {
                    $servicedata = BusinessActivityScheduler::where(['serviceid' => @$book_details['user_booking_detail']['sport'],'id' => $book_details['user_booking_detail']['act_schedule_id']])->first();
                 
                    $BusinessPriceDetails = BusinessPriceDetails::where(['id'=>@$book_details['user_booking_detail']['priceid'],'serviceid' =>@$book_details['user_booking_detail']['sport']])->first();

                    if(@$book_details['businessservices']['service_type']=='individual'){ 
                        $b_type = 'Personal Training'; 
                    }else { 
                        $b_type =ucfirst($book_details['businessservices']['service_type']); 
                    }

                    if ($book_details['businessservices']['profile_pic']!="") {
                        if(str_contains($book_details['businessservices']['profile_pic'], ',')){
                            $pic_image = explode(',', $book_details['businessservices']['profile_pic']);
                            if( $pic_image[0] == ''){
                               $p_image  = $pic_image[1];
                            }else{
                                $p_image  = $pic_image[0];
                            }
                        }else{
                            $p_image = $book_details['businessservices']['profile_pic'];
                        }

                        if (file_exists( public_path() . '/uploads/profile_pic/' . $p_image)) {
                           $pro_pic = url('/public/uploads/profile_pic/' . $p_image);
                        }else {
                           $pro_pic = url('/public/images/service-nofound.jpg');
                        }

                    }else{ $pro_pic = '/public/images/service-nofound.jpg'; }

                    $today = date('Y-m-d');
                    $SpotsLeftdis = 0;
                    $SpotsLeft = UserBookingDetail::where(['act_schedule_id' => $book_details['user_booking_detail']['act_schedule_id']])->whereDate('bookedtime', '=', date("Y-m-d", strtotime($sc_date) ) )->get()->toArray();                    
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
                    if( @$servicedata['spots_available'] != ''){
                        $SpotsLeftdis = $servicedata['spots_available'] - $totalquantity;
                    }

                    $language_name = BusinessService::where('cid',@$book_details['businessservices']['cid'])->first(); 
                    $language = $language_name->languages;
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
                    $taxval = $tot_amount_cart - $sub_totprice; 
                    
                    $tax_for_this = $taxval / count(@$booking_details_for_sub_total);

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

                    $qty = '';
                    $totprice_for_this = 0;
                    $a = json_decode(@$book_details['user_booking_detail']['qty'],true);
                    if( !empty($a['adult']) ){ 
                        $qty .= 'Adult: '.$a['adult']; 
                        $totprice_for_this += $aprice_adu * $a['adult'];
                    }
                    if( !empty($a['child']) ){
                        $qty .= '<br> Child: '.$a['child']; 
                        $totprice_for_this += $aprice_chi * $a['child'];
                    }
                    if( !empty($a['infant']) ){
                        $qty .= '<br>Infant: '.$a['infant']; 
                        $totprice_for_this += $aprice_inf * $a['infant'];
                    }

                    $main_total =  $tax_for_this + $totprice_for_this;
                                

                    $html.='<div class="col-md-4 col-sm-6 ">
                                <div class="boxes_arts">
                                    <div class="headboxes">
                                        <img src="'. $pro_pic  .'" class="imgboxes" alt="">
                                        <h4 class="fontsize">'.$book_details['businessservices']['program_name'].'</h4>
                                        <a class="openreceiptmodel" orderid = '.$book_details["id"].' orderdetailid="'.$book_details['user_booking_detail']['id'].'">
                                            <i class="fas fa-file-alt file-booking-receipt" aria-hidden="true"></i>
                                        </a>
                                        <div class="highlighted_box">Confirmed</div>
                                    </div>
                                    <div class="middleboxes middletoday" id="today_'.$i.'_'.$book_details['businessservices']['id'].'">
                                        <p>
                                            <span>BOOKING CONFIRMATION #</span>
                                            <span>'.$data->order_id.'</span>
                                        </p>
                                        <p>
                                            <span>PRICE OPTION:</span>
                                            <span>'.@$BusinessPriceDetails['price_title'].' - '.@$BusinessPriceDetails['pay_session'].' Sessions</span>
                                        </p>
                                        <p>
                                            <span>TOTAL REMAINING:</span>
                                            <span>'.$SpotsLeftdis.' / '. @$servicedata['spots_available'] .'</span>
                                        </p>
                                        <p>
                                            <span>DATE SCHEDULED:</span>
                                            <span>'.@$sc_date.'</span>
                                        </p>
                                        <p>
                                            <span>RESERVED TIMED:</span>
                                            <span>';
                                            if(@$servicedata['shift_start']!=''){
                                                $html.= date('h:ia', strtotime( @$servicedata['shift_start'] )); 
                                            }
                                            if(@$servicedata['shift_end']!=''){
                                                $html .= 'to'.date('h:ia', strtotime( @$servicedata['shift_end'] )); 
                                            }
                                            $html .= '</span>
                                        </p>
                                        <p>
                                            <span>TOTAL PRICE</span>
                                            <span>$'.@$main_total.' </span>
                                        </p>
                                        
                                        <p>
                                            <span>BOOKED BY:</span>
                                            <span>'.$book_details['user']['firstname'] .' '. $book_details['user']['lastname'] .'</span>
                                        </p>
                                        <p>
                                            <span>ACTIVITY TYPE:</span>
                                            <span>'.$book_details['businessservices']['sport_activity'].'</span>
                                        </p>
                                        <p>
                                            <span>SERVICE TYPE:</span>
                                            <span>';
                                            if($book_details['businessservices']['select_service_type'] != '') 
                                                $html .= $book_details['businessservices']['select_service_type'];
                                            else{ 
                                                $html .= '—'; 
                                            }
                                            $html .= '</span>
                                        </p>
                                        <p>
                                            <span>PROGRAM NAME:</span>
                                            <span>'.$book_details['businessservices']['program_name'].'</span>
                                        </p>
                                        <p>
                                            <span>ACTIVITY LOCATION:</span>
                                            <span>'.$book_details['businessservices']['activity_location'].'</span>
                                        </p>
                                        <p>
                                            <span>GREAT FOR:</span>
                                            <span>'.$book_details['businessservices']['activity_for'].'</span>
                                        </p>
                                        <p>
                                            <span>LANGUAGE:</span>
                                            <span>'.@$language.'</span>
                                        </p>
                                        <p>
                                            <span>PARTICIPANTS:</span>
                                            <span>';
                                            $a = json_decode($book_details['user_booking_detail']['qty']);
                                                if( !empty($a->adult) ){ 
                                                    $html .= 'Adult: '.$a->adult; 
                                                }
                                                if( !empty($a->child) ){ 
                                                    $html .= '<br> Child: '.$a->child; 
                                                }
                                                if( !empty($a->infant) ){ 
                                                    $html .= '<br>Infant: '.$a->infant; 
                                                }
                                            $html .= '</span>
                                        </p>
                                        <p>
                                            <span>SKILL LEVEL:</span>
                                            <span> '.$book_details['businessservices']['difficult_level'].'</span>
                                        </p>
                                        <p>
                                            <span>MEMBERSHIP TYPE:</span>
                                            <span>'.$BusinessPriceDetails['membership_type'].'</span>
                                        </p>
                                        <p>
                                            <span>BUSINESS TYPE:</span>
                                            <span>'.@$b_type.'</span>
                                        </p>
                                        <p>
                                            <span>WHO IS PARTICIPATING?</span>
                                            <span>';
                                                $a = json_decode($book_details['user_booking_detail']['participate'],true); 
                                                if(!empty($a)){
                                                    foreach($a as $data){
                                                        if($data['from'] == 'family'){
                                                            $family = UserFamilyDetail::where('id',$data['id'])->first();
                                                            $html .= @$family->first_name.' '.@$family->last_name."<br>";
                                                        }else{ 
                                                            $html .=  $book_details['user']['firstname'] .' '. $book_details['user']['lastname'];
                                                            $html .= "<br>"; 
                                                        } 
                                                    } 
                                                }
                                                
                                            $html .= '</span>
                                        </p>
                                        <p>
                                            <span>COMPANY:</span>
                                            <span>'. $book_details['businessuser']['company_name'] .'</span>
                                        </p>
                                    </div>
                                    <div class="foterboxes">
                                        <div class="threebtn_fboxes">
                                            
                                        </div>
                                        <div class="viewmore_links">
                                            <a id="viewmore'.$i.'_'.$book_details['businessservices']['id'].'" style="display:block">View More <img src="'. url('public/img/arrow-down.png') .'" alt=""></a>
                                            <a id="viewless'.$i.'_'.$book_details['businessservices']['id'].'" style="display:none">View Less <img src="'. url('public/img/arrow-down.png') .'" alt=""></a>
                                        </div>
                                        <script>
                                            $("#viewmore'.$i.'_'.$book_details['businessservices']['id'].'").click(function () {
                                                $("#today_'.$i.'_'.$book_details['businessservices']['id'].'").addClass("intro");
                                                $("#viewless'.$i.'_'.$book_details['businessservices']['id'].'").show();
                                                $("#viewmore'.$i.'_'.$book_details['businessservices']['id'].'").hide();
                                            });
                                            $("#viewless'.$i.'_'.$book_details['businessservices']['id'].'").click(function () {
                                                $("#today_'.$i.'_'.$book_details['businessservices']['id'].'").removeClass("intro");
                                                $("#viewless'.$i.'_'.$book_details['businessservices']['id'].'").hide();
                                                $("#viewmore'.$i.'_'.$book_details['businessservices']['id'].'").show();
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>';
                }
                $i++;
            }
        }
        $html.='</div>';
        return $html;
    }

    public function searchfilterdata(Request $request){
        if($request->page == 'personal'){
            $pagename_type = 'individual';
        }else if($request->page == 'experience'){
            $pagename_type = 'experience';
        }else if($request->page == 'gym-studio'){
            $pagename_type = 'classes';
        }else{
             $pagename_type = 'events';
        }
        $BookingDetail = [];
        $business_data = CompanyInformation::where('company_name', 'like', '%'. $request->text.'%')->get();
        if(!empty($business_data) && count($business_data) > 0){
            $bookingstatus = UserBookingStatus::where('user_id',Auth::user()->id)->get();
        }else{
            $bookingstatus = UserBookingStatus::where(['user_id' => Auth::user()->id, 'order_id'=>$request->text])->get();
        }

        
        foreach ($bookingstatus as $key => $value) {
            $booking_details = UserBookingDetail::where('booking_id',$value->id)->get(); 
            foreach ($booking_details as $key => $book_value) {
                $business_services = BusinessServices::where('id',$book_value->sport)->first();
               /* echo $business_services;*/
                if(!empty($business_data) && count($business_data) > 0){
                    foreach($business_data as $databus){
                        if($business_services != ''){
                            if($databus['id'] == $business_services->cid){
                           
                                if($business_services->service_type == $pagename_type){
                                    $BookingDetail_1 = $this->bookings->getBookingDetailnew($value->id);
                                    $businessuser['businessuser'] = CompanyInformation::where('id', $business_services->cid)->first();
                                    $BusinessServices['businessservices'] = BusinessServices::where('id',$book_value->sport)->first();
                                    $businessuser = json_decode(json_encode($businessuser), true);
                                    $BusinessServices = json_decode(json_encode($BusinessServices), true);
                                    foreach($BookingDetail_1['user_booking_detail'] as  $key => $details){
                                        if($details['sport'] == $book_value->sport){
                                            if($BookingDetail_1['user_booking_detail'][$key]['booking_id'] = $book_value->sport){
                                                $BookingDetail_1['user_booking_detail'] = $details;
                                            }
                                            $BookingDetail[] = array_merge($BookingDetail_1,$businessuser,$BusinessServices);
                                        }
                                    }
                                }
                            } 
                        }
                    }
                }else{
                    if($business_services != ''){
                        if($business_services->service_type == $pagename_type){
                            $BookingDetail_1 = $this->bookings->getBookingDetailnew($value->id);
                            $businessuser['businessuser'] = CompanyInformation::where('id', $business_services->cid)->first();
                            $BusinessServices['businessservices'] = BusinessServices::where('id',$book_value->sport)->first();
                            $businessuser = json_decode(json_encode($businessuser), true);
                            $BusinessServices = json_decode(json_encode($BusinessServices), true);
                            foreach($BookingDetail_1['user_booking_detail'] as  $key => $details){
                                if($details['sport'] == $book_value->sport){
                                    if($BookingDetail_1['user_booking_detail'][$key]['booking_id'] = $book_value->sport){
                                        $BookingDetail_1['user_booking_detail'] = $details;
                                    }
                                    $BookingDetail[] = array_merge($BookingDetail_1,$businessuser,$BusinessServices);
                                }
                            }
                        }
                    } 
                }

                
            }
        }
        $html = '';
        $html.='<div class="row" id="searchbydate_'.$request->type.'">';
        $i=1;
        if(!empty($BookingDetail)){
            foreach($BookingDetail as $book_details){
                $data = UserBookingStatus::where('id',$book_details['user_booking_detail']['booking_id'])->first();
                $scheduleddata = json_decode($book_details['user_booking_detail']['booking_detail'],true);
                $sc_date = date("m-d-Y", strtotime($scheduleddata['sessiondate']));
                $sc_date = str_replace('-', '/', $sc_date);  

                $chk = 0;
                if($request->type == 'past'){
                    if(date('Y-m-d',strtotime($sc_date)) < date('Y-m-d')){
                        $chk = 1;
                    }
                }else if($request->type == 'today'){
                    if(date('Y-m-d',strtotime($sc_date)) == date('Y-m-d')){
                        $chk = 1;
                    }
                }else{
                    if(date('Y-m-d',strtotime($sc_date)) > date('Y-m-d')){
                        $chk = 1;
                    }
                }
                
                $bussiness_name = $book_details['businessuser']['company_name'];
                $oid_num =  $data->order_id;
                $data1 = $date2 = '';
                if($chk == 1)
                {
                    $servicedata = BusinessActivityScheduler::where(['serviceid' => @$book_details['user_booking_detail']['sport'],'id' => $book_details['user_booking_detail']['act_schedule_id']])->first();

                    $BusinessPriceDetails = BusinessPriceDetails::where(['id'=>@$book_details['user_booking_detail']['priceid'],'serviceid' =>@$book_details['user_booking_detail']['sport']])->first();

                    if(@$book_details['businessservices']['service_type']=='individual'){ 
                        $b_type = 'Personal Training'; 
                    }else { 
                        $b_type =ucfirst($book_details['businessservices']['service_type']); 
                    }

                    if ($book_details['businessservices']['profile_pic']!="") {
                        if(str_contains($book_details['businessservices']['profile_pic'], ',')){
                            $pic_image = explode(',', $book_details['businessservices']['profile_pic']);
                            if( $pic_image[0] == ''){
                               $p_image  = $pic_image[1];
                            }else{
                                $p_image  = $pic_image[0];
                            }
                        }else{
                            $p_image = $book_details['businessservices']['profile_pic'];
                        }

                        if (file_exists( public_path() . '/uploads/profile_pic/' . $p_image)) {
                           $pro_pic = url('/public/uploads/profile_pic/' . $p_image);
                        }else {
                           $pro_pic = url('/public/images/service-nofound.jpg');
                        }

                    }else{ $pro_pic = '/public/images/service-nofound.jpg'; }

                    $SpotsLeft = [];
                    $today = date('Y-m-d');
                    $SpotsLeftdis = 0;
                    $SpotsLeft = UserBookingDetail::where(['act_schedule_id' => $book_details['user_booking_detail']['act_schedule_id']])->whereDate('bookedtime', '=',date("Y-m-d", strtotime($sc_date) ) )->get()->toArray();
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
                    if( @$servicedata['spots_available'] != ''){
                        $SpotsLeftdis = $servicedata['spots_available'] - $totalquantity;
                    }
                    $tot_spot =  @$servicedata['spots_available'];
                    $language_name = BusinessService::where('cid',@$book_details['businessservices']['cid'])->first(); 
                    $language = $language_name->languages;
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
                    $taxval = $tot_amount_cart - $sub_totprice; 
                    
                    $tax_for_this = $taxval / count(@$booking_details_for_sub_total);

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

                    $qty = '';
                    $totprice_for_this = 0;
                    $a = json_decode(@$book_details['user_booking_detail']['qty'],true);
                    if( !empty($a['adult']) ){ 
                        $qty .= 'Adult: '.$a['adult']; 
                        $totprice_for_this += $aprice_adu * $a['adult'];
                    }
                    if( !empty($a['child']) ){
                        $qty .= '<br> Child: '.$a['child']; 
                        $totprice_for_this += $aprice_chi * $a['child'];
                    }
                    if( !empty($a['infant']) ){
                        $qty .= '<br>Infant: '.$a['infant']; 
                        $totprice_for_this += $aprice_inf * $a['infant'];
                    }

                    $main_total =  $tax_for_this + $totprice_for_this;

                    $html.='<div class="col-md-4 col-sm-6">
                                    <div class="boxes_arts">
                                        <div class="headboxes">
                                            <img src="'. $pro_pic .'" class="imgboxes" alt="">
                                            <h4>'.$book_details['businessservices']['program_name'].'</h4>
                                            <a class="openreceiptmodel" orderid = '.$book_details["id"].' orderdetailid="'.$book_details['user_booking_detail']['id'].'">
                                                <i class="fas fa-file-alt file-booking-receipt" aria-hidden="true"></i>
                                            </a>
                                            <div class="highlighted_box">Confirmed</div>
                                        </div>
                                        <div class="middleboxes middletoday" id="'.$request->type.'_'.$i.'_'.$book_details['businessservices']['id'].'">
                                            <p>
                                                <span>BOOKING CONFIRMATION #</span>
                                                <span>'.$data->order_id.'</span>
                                            </p>
                                            <p>
                                                <span>PRICE OPTION:</span>
                                                <span>'.@$BusinessPriceDetails['pay_session'].' Sessions</span>
                                            </p>
                                            <p>
                                                <span>TOTAL REMAINING:</span>
                                                <span>'.$SpotsLeftdis.' / '.  $tot_spot.'</span>
                                            </p>
                                            <p>
                                                <span>DATE SCHEDULED:</span>
                                                <span>'.@$sc_date.'</span>
                                            </p>
                                            <p>
                                                <span>RESERVED TIMED:</span>
                                                <span>';
                                            if(@$servicedata['shift_start']!=''){
                                                $data1 = date('h:ia', strtotime( @$servicedata['shift_start'] )); 
                                            }
                                            if(@$servicedata['shift_end']!=''){
                                               $date2 = ' to '.date('h:ia', strtotime( @$servicedata['shift_end'] )); 
                                            }
                                            $html.=''. $data1.''.$date2.'</span>
                                            </p>
                                            <p>
                                                <span>TOTAL PRICE</span>
                                                <span>$'.@$main_total.'</span>
                                            </p>
                                            
                                            <p>
                                                <span>BOOKED BY:</span>
                                                <span>'.$book_details['user']['firstname'] .' '. $book_details['user']['lastname'] .'</span>
                                            </p>
                                            <p>
                                                <span>ACTIVITY TYPE:</span>
                                                <span>'.$book_details['businessservices']['sport_activity'].'</span>
                                            </p>
                                            <p>
                                                <span>SERVICE TYPE:</span>
                                                <span>';
                                                    if($book_details['businessservices']['select_service_type'] != '') 
                                                        $html .= $book_details['businessservices']['select_service_type'];
                                                    else{ 
                                                        $html .= '—'; 
                                                    }
                                                    $html .= '</span>
                                            </p>
                                            <p>
                                                <span>PROGRAM NAME:</span>
                                                <span>'.$book_details['businessservices']['program_name'].'</span>
                                            </p>
                                            <p>
                                                <span>ACTIVITY LOCATION:</span>
                                                <span>'.$book_details['businessservices']['activity_location'].'</span>
                                            </p>
                                            <p>
                                                <span>GREAT FOR:</span>
                                                <span>'.$book_details['businessservices']['activity_for'].'</span>
                                            </p>
                                            <p>
                                                <span>LANGUAGE:</span>
                                                <span>'.@$language.'</span>
                                            </p>
                                            <p>
                                                <span>PARTICIPANTS:</span>
                                                <span>';
                                                    $a = json_decode($book_details['user_booking_detail']['qty']);
                                                        if( !empty($a->adult) ){ 
                                                            $html .= 'Adult: '.$a->adult; 
                                                        }
                                                        if( !empty($a->child) ){ 
                                                            $html .= '<br> Child: '.$a->child; 
                                                        }
                                                        if( !empty($a->infant) ){ 
                                                            $html .= '<br>Infant: '.$a->infant; 
                                                        }
                                                    $html .= '</span>
                                            </p>
                                            <p>
                                                <span>SKILL LEVEL:</span>
                                                <span> '.$book_details['businessservices']['difficult_level'].'</span>
                                            </p>
                                            <p>
                                                <span>MEMBERSHIP TYPE:</span>
                                                <span>'.@$BusinessPriceDetails['membership_type'].'</span>
                                            </p>
                                            <p>
                                                <span>BUSINESS TYPE:</span>
                                                <span>'.@$b_type.'</span>
                                            </p>
                                            <p>
                                                <span>WHO IS PARTICIPATING?</span>
                                                <span>';
                                                    $a = json_decode($book_details['user_booking_detail']['participate'],true); 
                                                    if(!empty($a)){
                                                        foreach($a as $data){
                                                            if($data['from'] == 'family'){
                                                                $family = UserFamilyDetail::where('id',$data['id'])->first();
                                                                $html .= @$family->first_name.' '.@$family->last_name."<br>";
                                                            }else{ 
                                                                $html .=  $book_details['user']['firstname'] .' '. $book_details['user']['lastname'];
                                                                $html .= "<br>"; 
                                                            } 
                                                        } 
                                                    }
                                                    
                                                $html .= '</span>
                                            </p>
                                            <p>
                                                <span>COMPANY:</span>
                                                <span>'. $book_details['businessuser']['company_name'] .'</span>
                                            </p>
                                        </div>
                                        <div class="foterboxes">
                                            <div class="threebtn_fboxes">
                                                
                                            </div>
                                            <div class="viewmore_links">
                                                <a id="viewmore'.$i.'_'.$book_details['businessservices']['id'].'" style="display:block">View More <img src="'. url('public/img/arrow-down.png').'" alt=""></a>
                                                <a id="viewless'.$i.'_'.$book_details['businessservices']['id'].'" style="display:none">View Less <img src="'. url('public/img/arrow-down.png').'" alt=""></a>
                                            </div>
                                            <script>
                                                $("#viewmore'.$i.'_'.$book_details['businessservices']['id'].'").click(function () {
                                                    $("#'.$request->type.'_'.$i.'_'.$book_details['businessservices']['id'].'").addClass("intro");
                                                    $("#viewless'.$i.'_'.$book_details['businessservices']['id'].'").show();
                                                    $("#viewmore'.$i.'_'.$book_details['businessservices']['id'].'").hide();
                                                });
                                                $("#viewless'.$i.'_'.$book_details['businessservices']['id'].'").click(function () {
                                                    $("#'.$request->type.'_'.$i.'_'.$book_details['businessservices']['id'].'").removeClass("intro");
                                                    $("#viewless'.$i.'_'.$book_details['businessservices']['id'].'").hide();
                                                    $("#viewmore'.$i.'_'.$book_details['businessservices']['id'].'").show();
                                                });
                                            </script>
                                        </div>
                                    </div>
                    </div>';
                }
                $i++;
            }
        }
        $html.='</div>';
        return $html;
    }

    public function cancelbooking(Request $request){
       
    }


}