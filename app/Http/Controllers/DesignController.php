<?php
namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use DB;
use Input;
use Response;
use Hash;
use Validator;
use View;
use Mail;
use Config;
use Carbon\Carbon;
use App\Http\Controllers\Personal\PersonalBaseController;
use Auth;
use App\{MailService,user,UserFamilyDetail};
use App\Repositories\{BusinessServiceRepository,BookingRepository,CustomerRepository,UserRepository};

use Request as resAll;

class DesignController extends Controller {

	 protected $business_service_repo;
    protected $customers;
    protected $users;
    protected $booking_repo;

    public function __construct(BusinessServiceRepository $business_service_repo ,CustomerRepository $customers,UserRepository $users,BookingRepository $booking_repo)
    {        
        $this->business_service_repo = $business_service_repo;
        $this->users = $users;
        $this->customers = $customers;
        $this->booking_repo = $booking_repo;
    }
	public function orders(Request $request){
		$user = User::where('id', Auth::user()->id)->first();
        $UserProfileDetail['firstname'] = $user->firstname;
        
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        $BookingDetail = [];
        $serviceType = 'individual';
        if($request->has('serviceType')){
            $serviceType = $request->serviceType;
        }
        $BookingDetail =  $this->booking_repo->getalldata($serviceType);
        $currentbookingstatus =[];
        $currentbookingstatus = $this->booking_repo->getcurrenttabdata($serviceType);
        $tabval = '';
        if($request->has('tabval')){
            $tabval = $request->tabval;
        }

        return view('design.order', [ 'Booking_Detail' => $BookingDetail ,'UserProfileDetail' => $UserProfileDetail, 'cart' => $cart,'tabvalue'=>$tabval,'currentbooking_status'=>$currentbookingstatus]);
	}


    public function add_family(Request $request){
        $loggedinUser = Auth::user();
         $UserProfileDetail['firstname'] = $loggedinUser->firstname;
        $UserFamilyDetails = UserFamilyDetail::where('user_id', $loggedinUser['id'])->get();
         $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        return view('design.add_family', [ 'UserProfileDetail' => $UserProfileDetail, 'UserFamilyDetails' => $UserFamilyDetails,'cart' => $cart]);
    }
}