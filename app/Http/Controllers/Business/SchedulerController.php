<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use App\User;
use App\BusinessCompanyDetail;
use App\CompanyInformation;
use App\BusinessServices;
use App\UserBookingStatus;
use App\BusinessActivityScheduler;
use App\BusinessPriceDetailsAges;
use App\BusinessPriceDetails;
use App\StaffMembers;
use App\UserBookingDetail;
use App\ActivityCancel;
use App\UserFamilyDetail;
use App\BusinessSubscriptionPlan;
use App\Customer;
use App\BookingActivityCancel;
use App\BookingCheckinDetails;
use App\BookingPostorder;
use Auth;
use DB;
use Carbon\Carbon;
use DateTime;
use Config;
use DateInterval;
use App\MailService;
use App\Repositories\BusinessServiceRepository;
use App\Repositories\BookingRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\UserRepository;
use DateTimeZone;

class SchedulerController extends BusinessBaseController
{    
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

     public function index(Request $request)
     {



        $filter_date = Carbon::parse($request->date);

        

        $business_schedulers = $bookschedulers = BusinessActivityScheduler::alldayschedule($filter_date,'')->where('cid', $request->current_company->id)->get();

        return view('business.scheduler.index', [
             'todaydate'=>$filter_date->format('l, F j , Y'),
             'business_schedulers' => $business_schedulers, 
             'bookschedulers' => $bookschedulers,
             'filter_date' => $filter_date,
        ]);
     }

}
