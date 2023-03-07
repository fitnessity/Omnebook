<?php
namespace App\Http\Controllers;

use Redirect;
use App\User;
use App\UserFamilyDetail;
use App\UserCustomerDetail;
use App\AddrStates;
use App\AddrCities;;
use App\Repositories\BookingRepository;
use App\Repositories\BusinessServiceRepository;
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
use App\SGMailService;
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
use Config;

use Request as resAll;

class BookingController extends Controller {

	protected $sports;
    public function __construct(UserRepository $users, BookingRepository $bookings, BusinessServiceRepository $businessservice, Request $request, SportsRepository $sports) {
        $this->users = $users;
        $this->bookings = $bookings;
        $this->sports = $sports;
        $this->businessservice = $businessservice;
    }

    public function getreceiptmodel(Request $request) {
        $odt = $this->bookings->getorderdetailsfromodid($request->orderid,$request->orderdetailid);
        return view('personal.orders._receipt_model',['odt'=> $odt]);
    }

    public function sendemailofreceipt(Request $request){
        $getreceipemailtbody = $this->bookings->getreceipemailtbody($request->oid, $request->odetailid);
        $email_detail = array(
            'getreceipemailtbody' => $getreceipemailtbody,
            'email' => $request->email);
        $status  = SGMailService::sendBookingReceipt($email_detail);
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
        $bookingstatus = UserBookingStatus::where(['user_id'=>Auth::user()->id,'order_type'=>'simpleorder'])->get();
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
            $bookingstatus = UserBookingStatus::where(['user_id'=>Auth::user()->id,'order_type'=>'simpleorder'])->get();
        }else{
            $bookingstatus = UserBookingStatus::where(['user_id' => Auth::user()->id, 'order_id'=>$request->text,'order_type'=>'simpleorder'])->get();
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

    public function getbookingmodeldata(Request $request){
        $p_name = $this->businessservice->findById($request->sid)->program_name;
        $data = $this->bookings->getbusinessbookingsdata($request->sid,$request->date);
        $html = '' ;$link ='#';
        $ajax = "'ajax'";
        $html.= '<div class="col-lg-12">
                    <div class="schedule-modal-title modal-mb">
                        <h4 class="modal-title">View Your bookings for '.$p_name.'</h4>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-12">
                    <div class="modal-inner-txt">
                        <div class="row">
                            <div class="col-md-3 col-sm-4">
                                <div class="date-activity-scheduler">
                                    <label for="">Date:</label>
                                    <div class="activityselect3 special-date">
                                        <div class="activityselect3 special-date">
                                            <input type="text" name="actfildate" id="managecalendarservice" placeholder="Date" class="form-control" onchange="getbookingmodel('.$request->sid.','.$ajax.');" autocomplete="off" value="'.date('m/d/Y',strtotime($request->date)).'">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-xs-12 col-sm-4">
                                <div class="date-info">
                                    <label>Today Date:</label><span> '.date('m/d/Y',strtotime($request->date)).'</span>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-12 col-sm-4">
                                <div class="date-info">
                                    <label>Total Bookings:</label><span>'.count($data).'</span>
                                </div>
                            </div>
                        </div>  
                    </div>
                    <div class="modal-inner-txt modal-custom-header">
                        <div class="row">
                            <div class="col-md-2">
                                <label> Name </label>
                            </div>
                            <div class="col-md-2">
                                <label> Date Booked </label>
                            </div>
                            <div class="col-md-3">
                                <label>  Whos Participating  </label>
                            </div>
                            <div class="col-md-2"> 
                                <label> Category Name  </label>
                            </div>
                            <div class="col-md-3"> 
                                <label>   Price Option  </label>
                            </div>
                        </div>
                    </div>
                    <div class="main-component">';
        if(!empty($data) && count($data)>0){
            $count = 1;
            foreach($data as $dt){
                $participate =  $dt->decodeparticipate();
                $price_title = $dt->business_price_detail->price_title;
                $catename = $dt->business_price_detail->business_price_details_ages->category_title;

                if($dt->booking->user_type == 'user'){
                    $name = $dt->booking->user->firstname.' '.$dt->booking->user->lastname;
                }else{
                    $name = $dt->booking->customer->fname.' '.$dt->booking->customer->lname;
                    $link = Config::get('constants.SITE_URL')."/business/".$dt->booking->customer->business_id."/customers/".$dt->booking->customer->id;
                }

                $html .='<div class="modal-inner-txt modal-table-data'; 
                    if(count($data) == $count){ 
                        $html.= ' nthchildlast';
                    }
                    $dateval = 'N/A';
                    if($dt->bookedtime != ''){
                        $dateval = date('m/d/Y',strtotime($dt->bookedtime));
                    }
                    $html.= '">
                            <div class="row">
                                <div class="col-md-2">
                                    <label class="manage-service-display">Name: </label><span> '.$count.'. <a href="'.$link.'">'.$name.'</a> </span>
                                </div>
                                <div class="col-md-2">
                                    <label class="manage-service-display">Date Booked: </label><span> '.$dateval.'</span>
                                </div>
                                <div class="col-md-3">
                                    <label class="manage-service-display">Whos Participating: </label><span> '. nl2br($participate).'</span>
                                </div>
                                <div class="col-md-2"> 
                                    <label class="manage-service-display">Category Name: </label><span> '.$catename.'  </span>
                                </div>
                                <div class="col-md-3"> 
                                    <label class="manage-service-display">Price Option: </label><span> '.$price_title .'  </span>
                                </div>
                            </div>
                        </div>';
                $count++;
            }
        }else{
            $html .='<p class="no-bookings">There Are No Bookings For This Activity Today</p>';
        }

        $html .= '</div>
                <script>
                    $( function() {
                        $( "#managecalendarservice" ).datepicker( { 
                            minDate: 0,
                            changeMonth: true,
                            changeYear: true   
                        } );
                    } );
                </script></div>';
        return $html;
    }
}