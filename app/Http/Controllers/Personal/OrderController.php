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
        $user = Auth::user();
        $UserProfileDetail['firstname'] = $user->firstname;
        
        $cart = [];
        if ($request->session()->has('cart_item')) {
            $cart = $request->session()->get('cart_item');
        }

        $bookingStatus = $user->bookingStatus;
        foreach($bookingStatus as $bs){
            foreach($bs->UserBookingDetail as $bd)
            $company_information []= $bd->company_information;
        }
        $business = array_unique($company_information, SORT_REGULAR);

        if($request->business_id){
            $BookingDetail = [];
            $serviceType = 'null';
            if($request->has('serviceType')){
                $serviceType = $request->serviceType;
            }
            $BookingDetail =  $this->booking_repo->getalldata($serviceType,$request->business_id);
            $currentbookingstatus =[];
            $currentbookingstatus = $this->booking_repo->getcurrenttabdata($serviceType,$request->business_id);

            $tabValue = '';
            if($request->has('tabval')){
                $tabValue = $request->tabval;
            }

            return view('personal.orders.index', [ 'Booking_Detail' => $BookingDetail ,'UserProfileDetail' => $UserProfileDetail, 'cart' => $cart,'tabValue'=>$tabValue,'currentbookingstatus'=>$currentbookingstatus, 'business'=>[] ,'companyId'=> $request->business_id,'serviceType'=>$serviceType]);
        }
        

        //print_r($business);exit;
        return view('personal.orders.index',[ 'UserProfileDetail' => $UserProfileDetail, 'cart' => $cart,'business'=>$business,'Booking_Detail' => [], 'companyId'=> '' ,'tabValue'=>'']);
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
    public function edit( $id)
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
}
