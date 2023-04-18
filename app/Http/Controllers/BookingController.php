<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use App\Services\TwilioService;
use Twilio\TwiML\VoiceResponse;
use Validator;
use Redirect;
use Input;
use Response;
use Auth;
use Hash;
use Image;
use File;
use DB;
use Session;
use View;
use Mail;
use Config;
use Carbon\Carbon;
use App\Repositories\{BookingRepository,BusinessServiceRepository,UserRepository,SportsRepository};
use App\{Languages,UserFavourite,BusinessExperience,BusinessInformation,BusinessService,BusinessServices,BusinessPriceDetails,CompanyInformation,BusinessActivityScheduler,UserBookingStatus,UserBookingDetailFit_background_check_faq,Fit_vetted_business_faq,MailService,SGMailService,Evident,Evidents,Sports,ProfileSave,InstantForms,User,UserFamilyDetail,UserCustomerDetail,AddrStates,AddrCities,Miscellaneous,UserBookingDetail,BookingCheckinDetails};

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
        $serviceType = $request->serviceType;
        $customer= Auth::user()->customers()->where('business_id' ,$request->businessId)->first();
        $BookingDetail = [];
        $now = Carbon::now();
        if($request->type == 'current'){
            if($serviceType== null || $serviceType == 'all'){
                $booking_details = UserBookingDetail::where('user_id',$customer->id)->whereDate('expired_at', '>', $now)->whereRaw('pay_session > 0');
                if($request->date != ''){
                    $booking_details->whereDate('bookedtime', '=', date('Y-m-d',strtotime($request->date)));
                }
                $booking_details = $booking_details->get();
            }else{
                $booking_details = UserBookingDetail::join('business_services', 'user_booking_details.sport', '=', 'business_services.id')->where(['business_services.service_type'=>$serviceType ,'user_booking_details.user_id'=>$customer->id ]);
                if($request->date != ''){
                    $booking_details->whereDate('user_booking_details.bookedtime', '=', date('Y-m-d',strtotime($request->date)));
                }
                $booking_details = $booking_details->get();
            }

            if(!empty($booking_details)){
                foreach($booking_details  as $details){
                    $BookingDetail [] = $details;
                }
            }
        }else{
            $checkIndetail = []; $booking_details = [];
            $current =  date('Y-m-d');
            if($request->date != ''){
                $date = date('Y-m-d',strtotime($request->date)); 
                if($date < $current){
                    $chktab = "past";
                }
                if ($date > $current) {
                    $chktab = "upcoming";
                }
                if ($date == $current) {
                    $chktab = "today";
                }

                if($chktab == $request->type){
                    $checkIndetail = BookingCheckinDetails::where(['checkin_date'=>$date,'customer_id'=>$customer->id])->get();
                    $BookingDetail = $this->bookings->searchFilterData($checkIndetail,$request->type,$request->serviceType,$date);
                }
            }else{
                $checkIndetail = BookingCheckinDetails::where(['customer_id'=>$customer->id])->get();
                $BookingDetail = $this->bookings->tabFilterData($checkIndetail,$request->type,$request->serviceType,date('Y-m-d'));
            }
        }
        
        $html = '';
        if(!empty($BookingDetail)){
            foreach($BookingDetail as $keyvalue=>$book_details){
                $pic = url('/public/uploads/profile_pic');                 
                $pic =  url('/public/uploads/profile_pic/'.$book_details->business_services()->withTrashed()->first()->first_profile_pic());
                
                $html.='<div class="col-md-4 col-sm-6 ">
                            <div class="boxes_arts">
                                <div class="headboxes">
                                    <img src="'.$pic.'" class="imgboxes" alt="">
                                    <h4 class="fontsize">'.$book_details->business_services()->withTrashed()->first()->program_name.'</h4>

                                    <a class="openreceiptmodel" data-behavior="ajax_html_modal" data-url="'.route("getreceiptmodel",["orderid"=>$book_details->booking_id , "orderdetailid"=>$book_details->id]).'" data-modal-width="900px">
                                        <i class="fas fa-file-alt file-booking-receipt" aria-hidden="true"></i>
                                    </a><div class="highlighted_box">Confirmed</div>
                                </div>
                                <div class="middleboxes middletoday" id="'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'">
                                    <p>
                                        <span>BOOKING CONFIRMATION #</span>
                                        <span>'.$book_details->booking->order_id.'</span>
                                    </p>
                                    <p>
                                        <span>TOTAL PRICE:</span>
                                        <span>';
                                        if($book_details->booking->getPaymentDetail() != 'Comp'){
                                            $html.= $book_details->getperoderprice() + $book_details->total();
                                        }else{
                                            $html.='0';
                                        }
                                        $html.='</span>
                                    </p>
                                    <p>
                                        <span>PRICE OPTION:</span>
                                        <span>'.@$book_details->business_price_detail_with_trashed->price_title.' - '.@$book_details['pay_session'].' Sessions
                                        </span>
                                    </p>
                                    <p>
                                        <span>PAYMENT TYPE:</span>
                                        <span> '.@$book_details['pay_session'].' Sessions</span>
                                    </p>

                                    <p>
                                        <span>TOTAL REMAINING:</span>
                                        <span>'.@$book_details->getremainingsession().'/'.@$book_details['pay_session'].'</span>
                                    </p>
                                    <p>
                                        <span>PROGRAM NAME:</span>
                                        <span>'.$book_details->business_services()->withTrashed()->first()->program_name.'</span>
                                    </p>
                                    <p>
                                        <span>EXPIRATION DATE:</span>
                                        <span>'.date('m-d-Y',strtotime($book_details->expired_at)).'</span>
                                    </p>
                                    <p>
                                        <span>DATE BOOKED:</span>
                                        <span>'.date('m-d-Y',strtotime($book_details['created_at'])).'</span>
                                    </p>
                                    <p>
                                        <span>RESERVED DATE:</span>
                                        <span>'.@$book_details->getReserveData('reserve_date').'</span>
                                    </p>
                                
                                    <p>
                                        <span>BOOKED BY:</span>
                                        <span>'.$book_details->booking->getBookedFirstName().' '.$book_details->booking->getBookedLastName().' </span>
                                    </p>

                                    <p>
                                        <span>CHECK IN DATE:</span>
                                        <span>'.@$book_details->getReserveData('reserve_date').'</span>
                                    </p> 
                                    <p>
                                        <span>CHECK IN TIME:</span>
                                        <span>'.@$book_details->getReserveData('check_in_time').'</span>
                                    </p>

                                    <p>
                                        <span>ACTIVITY TYPE:</span>
                                        <span>'.$book_details->business_services()->withTrashed()->first()->sport_activity.'</span>
                                    </p>
                                    <p>
                                        <span>SERVICE TYPE:</span>
                                        <span>';

                                        if($book_details->business_services()->withTrashed()->first()->select_service_type != '') {
                                            $html.= $book_details->business_services()->withTrashed()->first()->select_service_type;
                                        }else {
                                            $html.='—';
                                        }
                                        $html.='</span>
                                    </p>
                                    
                                    <p>
                                        <span>ACTIVITY LOCATION:</span>
                                        <span>'.$book_details->business_services()->withTrashed()->first()->activity_location.'</span>
                                    </p> 

                                    <p>
                                        <span>ACTIVITY DURATION:</span>
                                        <span>'.@$book_details->getReserveData('reserve_time').'</span>
                                    </p>

                                    <p>
                                        <span>GREAT FOR:</span>
                                        <span>'.$book_details->business_services()->withTrashed()->first()->activity_for.'</span>
                                    </p>
                                   
                                    <p>
                                        <span>PARTICIPANTS:</span>
                                        <span>'.nl2br($book_details->getparticipate()).'</span>
                                    </p>
                                    <p>
                                        <span>WHO IS PARTICIPATING?</span>
                                        <span>'.nl2br($book_details->decodeparticipate()).'</span>
                                    </p>
                                </div>
                                <div class="foterboxes">
                                    <div class="threebtn_fboxes">';
                                        if($request->type == 'current' || $request->type == 'upcoming' ||  $book_details->pay_session >0 ){
                                            $html.='<a href="'.route('business_activity_schedulers',['business_id' => $book_details['business_id'] ,'business_service_id'=>$book_details['sport'] ,'stype'=>$book_details->business_services()->withTrashed()->first()->service_type ] ).'" target="_blank">Schedule</a>';
                                        }
                                        if($request->type == 'past' && $book_details->pay_session == 0){
                                            $html.='<a href="'.route('activities_show',['serviceid' => $book_details->business_services()->withTrashed()->first()->id ]).'" target="_blank">Rebook</a>';
                                        }

                                    $html.='</div>
                                    <div class="threebtn_fboxes" id="anothertwobtn'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'" style="display:none;">
                                        <a href="'.config('app.url').'/businessprofile/'.strtolower(str_replace(' ', '', $book_details->company_information->company_name)).'/'.$book_details->company_information->id.' target="_blank">View Provider</a>
                                    </div>
                                    <div class="viewmore_links">
                                        <a id="viewmore_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'" style="display:block">View More <img src="'. url('public/img/arrow-down.png') .'" alt=""></a>
                                        <a id="viewless_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'" style="display:none">View Less <img src="'. url('public/img/arrow-down.png') .'" alt=""></a>
                                    </div>
                                    <script>
                                        $("#viewmore_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").click(function () {
                                            $("#'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").addClass("intro");
                                            $("#viewless_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").show();
                                            $("#viewmore_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").hide();
                                            $("#anothertwobtn'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").show();
                                        });
                                        $("#viewless_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").click(function () {
                                            $("#'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").removeClass("intro");
                                            $("#viewless_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").hide();
                                            $("#viewmore_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").show();
                                            $("#anothertwobtn'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").hide();
                                        });
                                    </script>
                                </div>
                            </div>
                </div>';
            }
        }
        return $html;
    }

    public function searchfilteractivty(Request $request){
        $serviceType = $request->serviceType;
        if(!$request->customerId){
            $customerID = Auth::user()->customers()->where('business_id' ,$request->businessId)->first()->id;
        }else{
            $customerID = $request->customerId;
        }

        $now = Carbon::now();
        if($request->type == 'current'){
            if($serviceType== null || $serviceType == 'all'){
                $booking_details = UserBookingDetail::where('user_id',$customerID)->whereDate('expired_at', '>', $now)->whereRaw('pay_session > 0')->get();
            }else{
                $booking_details = UserBookingDetail::join('business_services', 'user_booking_details.sport', '=', 'business_services.id')->where(['business_services.service_type'=>$serviceType ,'user_booking_details.user_id'=>$customerID ])->whereDate('user_booking_details.expired_at', '>', $now)->whereRaw('user_booking_details.pay_session > 0')->get();
            }

            if(!empty($booking_details)){
                foreach($booking_details  as $details){
                    $BookingDetail [] = $details;
                }
            }
        }else{
            $checkIndetail = []; $booking_details = [];
            $checkIndetail = BookingCheckinDetails::where(['customer_id'=>$customerID])->get();
            $BookingDetail = $this->bookings->tabFilterData($checkIndetail,$request->type,$request->serviceType,date('Y-m-d'));
        }

        $html = '';
        if(!empty($BookingDetail)){
            foreach($BookingDetail as $keyvalue=>$book_details){
                if($request->text != ''){
                    $activity = BusinessServices::where('id',$book_details->sport)->where('program_name', 'like', '%'.$request->text.'%')->withTrashed()->first();
                }else{
                    $activity = BusinessServices::where('id',$book_details->sport)->withTrashed()->first();
                }
                if($activity != ''){
                    $pic = url('/public/uploads/profile_pic');                 
                    $pic =  url('/public/uploads/profile_pic/'.$book_details->business_services()->withTrashed()->first()->first_profile_pic());
                    
                    $html.='<div class="col-md-4 col-sm-6 ">
                                <div class="boxes_arts">
                                    <div class="headboxes">
                                        <img src="'.$pic.'" class="imgboxes" alt="">
                                        <h4 class="fontsize">'.$book_details->business_services()->withTrashed()->first()->program_name.'</h4>

                                        <a class="openreceiptmodel" data-behavior="ajax_html_modal" data-url="'.route("getreceiptmodel",["orderid"=>$book_details->booking_id , "orderdetailid"=>$book_details->id]).'" data-modal-width="900px">
                                            <i class="fas fa-file-alt file-booking-receipt" aria-hidden="true"></i>
                                        </a><div class="highlighted_box">Confirmed</div>
                                    </div>
                                    <div class="middleboxes middletoday" id="'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'">
                                        <p>
                                            <span>BOOKING CONFIRMATION #</span>
                                            <span>'.$book_details->booking->order_id.'</span>
                                        </p>
                                        <p>
                                            <span>TOTAL PRICE:</span>
                                            <span>';
                                            if($book_details->booking->getPaymentDetail() != 'Comp'){
                                                $html.= $book_details->getperoderprice() + $book_details->total();
                                            }else{
                                                $html.='0';
                                            }
                                            $html.='</span>
                                        </p>
                                        <p>
                                            <span>PRICE OPTION:</span>
                                            <span>'.@$book_details->business_price_detail_with_trashed->price_title.' - '.@$book_details['pay_session'].' Sessions
                                            </span>
                                        </p>
                                        <p>
                                            <span>PAYMENT TYPE:</span>
                                            <span> '.@$book_details['pay_session'].' Sessions</span>
                                        </p>

                                        <p>
                                            <span>TOTAL REMAINING:</span>
                                            <span>'.@$book_details->getremainingsession().'/'.@$book_details['pay_session'].'</span>
                                        </p>
                                        <p>
                                            <span>PROGRAM NAME:</span>
                                            <span>'.$book_details->business_services()->withTrashed()->first()->program_name.'</span>
                                        </p>
                                        <p>
                                            <span>EXPIRATION DATE:</span>
                                            <span>'.date('m-d-Y',strtotime($book_details->expired_at)).'</span>
                                        </p>
                                        <p>
                                            <span>DATE BOOKED:</span>
                                            <span>'.date('m-d-Y',strtotime($book_details['created_at'])).'</span>
                                        </p>
                                        <p>
                                            <span>RESERVED DATE:</span>
                                            <span>'.@$book_details->getReserveData('reserve_date').'</span>
                                        </p>
                                    
                                        <p>
                                            <span>BOOKED BY:</span>
                                            <span>'.$book_details->booking->getBookedFirstName().' '.$book_details->booking->getBookedLastName().' </span>
                                        </p>

                                        <p>
                                            <span>CHECK IN DATE:</span>
                                            <span>'.@$book_details->getReserveData('reserve_date').'</span>
                                        </p> 
                                        <p>
                                            <span>CHECK IN TIME:</span>
                                            <span>'.@$book_details->getReserveData('check_in_time').'</span>
                                        </p>

                                        <p>
                                            <span>ACTIVITY TYPE:</span>
                                            <span>'.$book_details->business_services()->withTrashed()->first()->sport_activity.'</span>
                                        </p>
                                        <p>
                                            <span>SERVICE TYPE:</span>
                                            <span>';

                                            if($book_details->business_services()->withTrashed()->first()->select_service_type != '') {
                                                $html.= $book_details->business_services()->withTrashed()->first()->select_service_type;
                                            }else {
                                                $html.='—';
                                            }
                                            $html.='</span>
                                        </p>
                                        
                                        <p>
                                            <span>ACTIVITY LOCATION:</span>
                                            <span>'.$book_details->business_services()->withTrashed()->first()->activity_location.'</span>
                                        </p> 

                                        <p>
                                            <span>ACTIVITY DURATION:</span>
                                            <span>'.@$book_details->getReserveData('reserve_time').'</span>
                                        </p>

                                        <p>
                                            <span>GREAT FOR:</span>
                                            <span>'.$book_details->business_services()->withTrashed()->first()->activity_for.'</span>
                                        </p>
                                       
                                        <p>
                                            <span>PARTICIPANTS:</span>
                                            <span>'.nl2br($book_details->getparticipate()).'</span>
                                        </p>
                                        <p>
                                            <span>WHO IS PARTICIPATING?</span>
                                            <span>'.nl2br($book_details->decodeparticipate()).'</span>
                                        </p>
                                    </div>
                                    <div class="foterboxes">
                                        <div class="threebtn_fboxes">';
                                            if($request->type == 'current' || $request->type == 'upcoming' ||  $book_details->pay_session >0 ){
                                                $html.='<a href="'.route('business_activity_schedulers',['business_id' => $book_details['business_id'] ,'business_service_id'=>$book_details['sport'] ,'stype'=>$book_details->business_services()->withTrashed()->first()->service_type ] ).'" target="_blank">Schedule</a>';
                                            }
                                            if($request->type == 'past' && $book_details->pay_session == 0){
                                                $html.='<a href="'.route('activities_show',['serviceid' => $book_details->business_services()->withTrashed()->first()->id ]).'" target="_blank">Rebook</a>';
                                            }

                                        $html.='</div>
                                        <div class="threebtn_fboxes" id="anothertwobtn'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'" style="display:none;">
                                            <a href="'.config('app.url').'/businessprofile/'.strtolower(str_replace(' ', '', $book_details->company_information->company_name)).'/'.$book_details->company_information->id.' target="_blank">View Provider</a>
                                        </div>
                                        <div class="viewmore_links">
                                            <a id="viewmore_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'" style="display:block">View More <img src="'. url('public/img/arrow-down.png') .'" alt=""></a>
                                            <a id="viewless_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'" style="display:none">View Less <img src="'. url('public/img/arrow-down.png') .'" alt=""></a>
                                        </div>
                                        <script>
                                            $("#viewmore_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").click(function () {
                                                $("#'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").addClass("intro");
                                                $("#viewless_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").show();
                                                $("#viewmore_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").hide();
                                                $("#anothertwobtn'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").show();
                                            });
                                            $("#viewless_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").click(function () {
                                                $("#'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").removeClass("intro");
                                                $("#viewless_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").hide();
                                                $("#viewmore_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").show();
                                                $("#anothertwobtn'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").hide();
                                            });
                                        </script>
                                    </div>
                                </div>
                    </div>';
                }
            }
        }
        return $html;

    }

    public function searchfilterdata(Request $request){
        $serviceType = $request->serviceType;
        $customer= Auth::user()->customers()->where('business_id' ,$request->businessId)->first();
        if(!$request->text){
            $bookingstatus = UserBookingStatus::where(['user_id' => Auth::user()->id])->get();
        }else{
            $bookingstatus = UserBookingStatus::where(['user_id' => Auth::user()->id, 'order_id'=>$request->text])->get();
        }
        $now = Carbon::now();
        $BookingDetail = [];

        if($request->type == 'current'){
            if(!empty($bookingstatus)){
                foreach($bookingstatus as $Bstatus){
                    if($serviceType== null || $serviceType == 'all'){
                        $booking_details = UserBookingDetail::where(['booking_id'=>$Bstatus->id,'user_id'=>$customer->id ])->whereDate('expired_at', '>', $now)->whereRaw('pay_session > 0')->get();
                    }else{
                        $booking_details = UserBookingDetail::join('business_services', 'user_booking_details.sport', '=', 'business_services.id')->where('business_services.service_type',$serviceType)->where('user_booking_details.booking_id',$Bstatus->id)->where('user_booking_details.user_id',$customer->id)->whereDate('user_booking_details.expired_at', '>', $now)->whereRaw('user_booking_details.pay_session > 0')->get();
                    }

                    if(!empty($booking_details)){
                        foreach($booking_details  as $details){
                            $BookingDetail [] =$details;
                        }
                    }
                }
            }
        }else{
            $checkIndetail = []; $booking_details = [];
            if(!empty($bookingstatus)){
                foreach($bookingstatus as $Bstatus){
                    $booking_details  = UserBookingDetail::where(['booking_id'=>$Bstatus->id ,'user_id'=>$customer->id])->get();
                    foreach($booking_details  as $details){
                        $Booking_checked_inetail = BookingCheckinDetails::where('booking_detail_id',$details->id)->get();
                        if(!empty($Booking_checked_inetail )){
                            foreach($Booking_checked_inetail  as $chkDetail){
                                $checkIndetail []= $chkDetail;
                            }
                        }
                    }
                }
            }
            $checkIndetail = array_unique($checkIndetail);
            $BookingDetail = $this->bookings->tabFilterData($checkIndetail,$request->type, $serviceType,date('Y-m-d'));
        }

        $html = '';
        if(!empty($BookingDetail)){
            foreach($BookingDetail as $keyvalue=>$book_details){
                $pic = url('/public/uploads/profile_pic');                 
                $pic =  url('/public/uploads/profile_pic/'.$book_details->business_services()->withTrashed()->first()->first_profile_pic());
                
                $html.='<div class="col-md-4 col-sm-6 ">
                            <div class="boxes_arts">
                                <div class="headboxes">
                                    <img src="'.$pic.'" class="imgboxes" alt="">
                                    <h4 class="fontsize">'.$book_details->business_services()->withTrashed()->first()->program_name.'</h4>

                                    <a class="openreceiptmodel" data-behavior="ajax_html_modal" data-url="'.route("getreceiptmodel",["orderid"=>$book_details->booking_id , "orderdetailid"=>$book_details->id]).'" data-modal-width="900px">
                                        <i class="fas fa-file-alt file-booking-receipt" aria-hidden="true"></i>
                                    </a><div class="highlighted_box">Confirmed</div>
                                </div>
                                <div class="middleboxes middletoday" id="'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'">
                                    <p>
                                        <span>BOOKING CONFIRMATION #</span>
                                        <span>'.$book_details->booking->order_id.'</span>
                                    </p>
                                    <p>
                                        <span>TOTAL PRICE:</span>
                                        <span>';
                                        if($book_details->booking->getPaymentDetail() != 'Comp'){
                                            $html.= $book_details->getperoderprice() + $book_details->total();
                                        }else{
                                            $html.='0';
                                        }
                                        $html.='</span>
                                    </p>
                                    <p>
                                        <span>PRICE OPTION:</span>
                                        <span>'.@$book_details->business_price_detail_with_trashed->price_title.' - '.@$book_details['pay_session'].' Sessions
                                        </span>
                                    </p>
                                    <p>
                                        <span>PAYMENT TYPE:</span>
                                        <span> '.@$book_details['pay_session'].' Sessions</span>
                                    </p>

                                    <p>
                                        <span>TOTAL REMAINING:</span>
                                        <span>'.@$book_details->getremainingsession().'/'.@$book_details['pay_session'].'</span>
                                    </p>
                                    <p>
                                        <span>PROGRAM NAME:</span>
                                        <span>'.$book_details->business_services()->withTrashed()->first()->program_name.'</span>
                                    </p>
                                    <p>
                                        <span>EXPIRATION DATE:</span>
                                        <span>'.date('m-d-Y',strtotime($book_details->expired_at)).'</span>
                                    </p>
                                    <p>
                                        <span>DATE BOOKED:</span>
                                        <span>'.date('m-d-Y',strtotime($book_details['created_at'])).'</span>
                                    </p>
                                    <p>
                                        <span>RESERVED DATE:</span>
                                        <span>'.@$book_details->getReserveData('reserve_date').'</span>
                                    </p>
                                
                                    <p>
                                        <span>BOOKED BY:</span>
                                        <span>'.$book_details->booking->getBookedFirstName().' '.$book_details->booking->getBookedLastName().' </span>
                                    </p>

                                    <p>
                                        <span>CHECK IN DATE:</span>
                                        <span>'.@$book_details->getReserveData('reserve_date').'</span>
                                    </p> 
                                    <p>
                                        <span>CHECK IN TIME:</span>
                                        <span>'.@$book_details->getReserveData('check_in_time').'</span>
                                    </p>

                                    <p>
                                        <span>ACTIVITY TYPE:</span>
                                        <span>'.$book_details->business_services()->withTrashed()->first()->sport_activity.'</span>
                                    </p>
                                    <p>
                                        <span>SERVICE TYPE:</span>
                                        <span>';

                                        if($book_details->business_services()->withTrashed()->first()->select_service_type != '') {
                                            $html.= $book_details->business_services()->withTrashed()->first()->select_service_type;
                                        }else {
                                            $html.='—';
                                        }
                                        $html.='</span>
                                    </p>
                                    
                                    <p>
                                        <span>ACTIVITY LOCATION:</span>
                                        <span>'.$book_details->business_services()->withTrashed()->first()->activity_location.'</span>
                                    </p> 

                                    <p>
                                        <span>ACTIVITY DURATION:</span>
                                        <span>'.@$book_details->getReserveData('reserve_time').'</span>
                                    </p>

                                    <p>
                                        <span>GREAT FOR:</span>
                                        <span>'.$book_details->business_services()->withTrashed()->first()->activity_for.'</span>
                                    </p>
                                   
                                    <p>
                                        <span>PARTICIPANTS:</span>
                                        <span>'.nl2br($book_details->getparticipate()).'</span>
                                    </p>
                                    <p>
                                        <span>WHO IS PARTICIPATING?</span>
                                        <span>'.nl2br($book_details->decodeparticipate()).'</span>
                                    </p>
                                </div>
                                <div class="foterboxes">
                                    <div class="threebtn_fboxes">';
                                        if($request->type == 'current' || $request->type == 'upcoming' ||  $book_details->pay_session >0 ){
                                            $html.='<a href="'.route('business_activity_schedulers',['business_id' => $book_details['business_id'] ,'business_service_id'=>$book_details['sport'] ,'stype'=>$book_details->business_services()->withTrashed()->first()->service_type ] ).'" target="_blank">Schedule</a>';
                                        }
                                        if($request->type == 'past' && $book_details->pay_session == 0){
                                            $html.='<a href="'.route('activities_show',['serviceid' => $book_details->business_services()->withTrashed()->first()->id ]).'" target="_blank">Rebook</a>';
                                        }

                                    $html.='</div>
                                    <div class="threebtn_fboxes" id="anothertwobtn'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'" style="display:none;">
                                        <a href="'.config('app.url').'/businessprofile/'.strtolower(str_replace(' ', '', $book_details->company_information->company_name)).'/'.$book_details->company_information->id.' target="_blank">View Provider</a>
                                    </div>
                                    <div class="viewmore_links">
                                        <a id="viewmore_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'" style="display:block">View More <img src="'. url('public/img/arrow-down.png') .'" alt=""></a>
                                        <a id="viewless_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'" style="display:none">View Less <img src="'. url('public/img/arrow-down.png') .'" alt=""></a>
                                    </div>
                                    <script>
                                        $("#viewmore_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").click(function () {
                                            $("#'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").addClass("intro");
                                            $("#viewless_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").show();
                                            $("#viewmore_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").hide();
                                            $("#anothertwobtn'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").show();
                                        });
                                        $("#viewless_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").click(function () {
                                            $("#'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").removeClass("intro");
                                            $("#viewless_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").hide();
                                            $("#viewmore_'.$request->type.'_'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").show();
                                            $("#anothertwobtn'.$keyvalue.'_'.$book_details->business_services()->withTrashed()->first()->id.'").hide();
                                        });
                                    </script>
                                </div>
                            </div>
                </div>';
            }
        }
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