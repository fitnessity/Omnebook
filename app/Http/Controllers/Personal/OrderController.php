<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Personal\PersonalBaseController;
use Illuminate\Http\Request;
use Auth;
use App\{MailService,user};
use App\Repositories\{BusinessServiceRepository,BookingRepository,CustomerRepository,UserRepository};

class OrderController extends PersonalBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
        $user = User::where('id', Auth::user()->id)->first();
        $UserProfileDetail['firstname'] = $user->firstname;
        
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }
        
        $BookingDetail = [];
        $BookingDetail =  $this->booking_repo->getalldata('individual');
        $currentbookingstatus =[];
        $currentbookingstatus = $this->booking_repo->getcurrenttabdata('individual');
        $tabval = '';
        if($request->has('tabval')){
            $tabval = $request->tabval;
        }
        
        return view('personal.orders.index', [ 'Booking_Detail' => $BookingDetail ,'UserProfileDetail' => $UserProfileDetail, 'cart' => $cart,'tabvalue'=>$tabval,'currentbooking_status'=>$currentbookingstatus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function gym_studio_page(Request $request ,$tabval  = null){
        $user = User::where('id', Auth::user()->id)->first();
        $UserProfileDetail['firstname'] = $user->firstname;
    
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }

        $BookingDetail = [];
        $BookingDetail =  $this->booking_repo->getalldata('classes');

        $currentbookingstatus =[];
        $currentbookingstatus = $this->booking_repo->getcurrenttabdata('classes');
       
       /* print_r($BookingDetail);exit;*/
        return view('personal.orders.booking_gym_studio', ['Booking_Detail' => $BookingDetail ,'UserProfileDetail' => $UserProfileDetail, 'cart' => $cart,'tabvalue'=>$tabval,'currentbooking_status'=>$currentbookingstatus]);
    }

    public function experience_page(Request $request ,$tabval  = null){
        $user = User::where('id', Auth::user()->id)->first();
       
        $UserProfileDetail['firstname'] = $user->firstname;
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }

        $BookingDetail = [];
        $BookingDetail =  $this->booking_repo->getalldata('experience');

        $currentbookingstatus =[];
        $currentbookingstatus = $this->booking_repo->getcurrenttabdata('experience');
       
        //print_r($currentbookingstatus);exit;
        /*print_r($BookingDetail);exit;*/
       return view('personal.orders.booking_experience', ['Booking_Detail' => $BookingDetail ,'UserProfileDetail' => $UserProfileDetail, 'cart' => $cart ,'tabvalue'=>$tabval,'currentbooking_status'=>$currentbookingstatus]);
    }

    public function events_page(Request $request,$tabval  = null){
        $user = User::where('id', Auth::user()->id)->first();
        $UserProfileDetail['firstname'] = $user->firstname;
        
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }

        $BookingDetail = [];
        $BookingDetail =  $this->booking_repo->getalldata('events');
    
        $currentbookingstatus =[];
        $currentbookingstatus = $this->booking_repo->getcurrenttabdata('events');
        /*print_r($BookingDetail);exit;*/
       return view('personal.orders.booking_events', ['Booking_Detail' => $BookingDetail ,'UserProfileDetail' => $UserProfileDetail, 'cart' => $cart,'tabvalue'=>$tabval,'currentbooking_status'=>$currentbookingstatus]);
    }

}
