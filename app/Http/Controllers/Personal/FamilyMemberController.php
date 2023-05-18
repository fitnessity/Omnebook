<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\{MailService,user,Customer};
use App\Repositories\{BookingRepository,CustomerRepository};

class FamilyMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    protected $customers;
    protected $booking_repo;

    public function __construct(CustomerRepository $customers,BookingRepository $booking_repo)
    {        
        $this->customers = $customers;
        $this->booking_repo = $booking_repo;
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $customer = Customer::where(['id'=>$request->customerId])->first();
        if($request->business_id){
            $bookingDetail = [];
            $bookingDetail =  $this->booking_repo->otherTab($request->serviceType, $request->business_id,$customer);
            //print_r($bookingDetail);exit;
            $currentbookingstatus =[];
            $currentbookingstatus = $this->booking_repo->currentTab($request->serviceType,$request->business_id,$customer);
            //print_r($currentbookingstatus );exit;
            $tabval = $request->tab; 

            return view('personal.family_member.index', [
                'bookingDetails' => $bookingDetail ,
                'currentbookingstatus'=>$currentbookingstatus, 
                'tabval'=>$tabval, 
                'customer'=>$customer, 
                'business'=>[]]);
        }else{
            $company_information = [];
            $company_information [] = $customer->company_information;
        
            $business = array_unique($company_information, SORT_REGULAR);
            return view('personal.family_member.index',[ 
                'business'=>$business, 
                'tabval'=>'', 
                'bookingDetail' => [],
                'customer' => $customer]);
        } 
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
}
