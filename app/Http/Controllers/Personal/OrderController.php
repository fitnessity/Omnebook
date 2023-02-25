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


        if($request->business_id){
            $bookingDetail = [];


            $bookingDetail =  $this->booking_repo->getCurrentUserBookingDetails($request->serviceType, $request->business_id);


            $currentbookingstatus =[];
            $currentbookingstatus = $this->booking_repo->getcurrenttabdata($request->serviceType,$request->business_id);


            return view('personal.orders.index', [
                'bookingDetail' => $bookingDetail ,
                'currentbookingstatus'=>$currentbookingstatus, 
                'business'=>[]]);
        }else{
            $bookingStatus = $user->bookingStatus;
            foreach($bookingStatus as $bs){
                foreach($bs->UserBookingDetail as $bd)
                $company_information []= $bd->company_information;
            }
            $business = array_unique($company_information, SORT_REGULAR);

        }
        


        return view('personal.orders.index',[ 
            'business'=>$business, 
            'bookingDetail' => []]);
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
