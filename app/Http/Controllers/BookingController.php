<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Validator,Redirect,Input,Response,Auth,Hash,Image,File,DB,Session,View,Mail,Config;
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
        $book_details = UserBookingDetail::withTrashed()->find($request->orderdetailid);
        $odt = $this->bookings->getorderdetailsfromodid($request->orderid,$request->orderdetailid);
        return view('personal.orders._receipt_model',['odt'=> $odt ,'book_details'=>$book_details]);
    }

    public function sendemailofreceipt(Request $request){
        $getreceipemailtbody = $this->bookings->getreceipemailtbody($request->oid, $request->odetailid);
        $email_detail = array(
            'getreceipemailtbody' => $getreceipemailtbody,
            'email' => $request->email);
        $status  = SGMailService::sendBookingReceipt($email_detail);
        return $status;
    }

    public function cancelbooking(Request $request){   
    }

    public function getbookingmodeldata(Request $request){
        $activity = $this->businessservice->findById($request->sid);
        $programName = $activity->program_name;
        $date = date('m-d-Y',strtotime($request->date));
        $data = $this->bookings->getbusinessbookingsdata($request->sid,date('Y-m-d',strtotime($request->date)) ,$request->type );
        $sid = $request->sid;
        $type = $request->type;
        $categoryList  = [];
        $categoryList = $activity->BusinessPriceDetailsAges;
        return view('business.services.view_bookings_of_service', compact('data', 'date', 'programName', 'sid' ,'type','categoryList'));
    }

    public function getRescheduleModel(Request $request){
         return view('personal.orders._reschedule_modal',['business_id'=> $request->business_id,'reservedDate'=> $request->reservedDate ,'reserveTime'=>$request->reserveTime,'business_service_id'=> $request->business_service_id ,'stype'=> $request->stype ,'priceid'=> $request->priceid ,'customer_id'=> $request->customer_id]);
    }
}