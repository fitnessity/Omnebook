<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\BookingRepository;
use App\Repositories\UserRepository;
use App\Repositories\SportsRepository;
use App\User;
use Auth;
use Redirect;
use Response;
use DB;
use Input;
use App\Miscellaneous;

class BookingController extends Controller
{   
    /**
     * The user repository instance.
     *
     * @var BookingRepository
     */
    protected $booking;
    protected $sports;
    
    public function __construct(BookingRepository $booking,UserRepository $users,SportsRepository $sports)
    {
        $this->middleware('admin');
        $this->booking = $booking;
        $this->users = $users;
        $this->sports = $sports;
    }

    public function index()
    { 
        $allBookings = $this->booking->getBookingList();
        $sportsList = $this->sports->getAllSportsNames(1);

        return view('admin.booking.index', [
            'bookings' => $allBookings,
            'sportsList' => $sportsList,
            'pageTitle' => 'View Bookings'
        ]);
    }

    public function directHireDetails($id)
    { 
        $bookingDetails = $this->booking->getBookingDetail($id);
        $customer_details = $this->users->getCustomers(@$bookingDetails['user']['id']);
        $sportsList = $this->sports->getAllSportsNames(1);
        
        if(@$bookingDetails['businessuser']['id'] > 0){
            $businessuser_details = $this->users->getProfessional(@$bookingDetails['businessuser']['id']);
        }

        return view('admin.booking.viewDirectHireDetails', [
            'bookingDetails' => @$bookingDetails,
            'pageTitle' => 'View Booking Details',
            'customerDetails' => $customer_details,
            'businessuserDetails' => @$businessuser_details,
            'sportsList' => @$sportsList,
            'allDays' => array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun')
        ]);
    }

    public function quickHireDetails($id)
    { 
        $bookingDetails = $this->booking->getBookingDetail($id);
        $customer_details = $this->users->getCustomers(@$bookingDetails['user_id']);
        $sportsList = $this->sports->getAllSportsNames(1);
        if(@$bookingDetails['businessuser']['id'] > 0){
            $businessuser_details = $this->users->getProfessional(@$bookingDetails['businessuser']['id']);
        }

        $bookingQuoteList = $this->booking->getQuoteList($id, NULL, NULL, $paginate = 5);
        $questions = Miscellaneous::getQuestions();

        $jobsObj = Miscellaneous::getBookingQuestionObject($bookingDetails['jobpostquestions']);

        return view('admin.booking.viewQuickHireDetails', [
            'bookingDetails' => @$bookingDetails,
            'pageTitle' => 'View Booking Details',
            'customerDetails' => $customer_details,
            'businessuserDetails' => @$businessuser_details,
            'questions' => $questions,
            'sportsList' => $sportsList,
            'bookingQuoteList' => $bookingQuoteList,
            'jobsObj' => $jobsObj
        ]);
    }

}
