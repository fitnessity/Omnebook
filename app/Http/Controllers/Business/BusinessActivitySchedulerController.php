<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CompanyInformation;

class BusinessActivitySchedulerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request , $business_id)
    {
        $company = CompanyInformation::findOrFail($business_id);
        $services = $company->service()->get();

        $order = UserBookingStatus::where(['order_type'=>'checkout_register'])->get();
        $servicetype = 'all';
        if($request->stype){
            $servicetype = $request->stype;
        }

        $orderdata = [];
        foreach($order as $odt){
            $orderdetaildata = UserBookingDetail::where(['booking_id'=>$odt->id,'business_id'=>$business_id])->get();
            foreach($orderdetaildata as $odetail){
                if($servicetype != 'all'){
                    if($odetail->business_services()->exists()){
                        if($odetail->business_services->service_type ==   $servicetype ){
                            $orderdata []= $odetail;
                        }
                    }
                }else{
                    $orderdata []= $odetail;
                } 
            }
        }
        $filter_date = new DateTime();
        $shift = 1;
        if($request->date && (new DateTime($request->date)) > $filter_date){
            $filter_date = new DateTime($request->date); 
            $shift = 0;
        }
        $days = [];
        $days[] = new DateTime(date('Y-m-d'));
        for($i = 0; $i<=100; $i++){
            $d = clone($filter_date);
            $days[] = $d->modify('+'.($i+$shift).' day');
        }

        $companyName = $companyData->company_name;
        return view('personal.scheduler.all_activity_schedule',[
            'days' => $days,
            'filter_date' => $filter_date,
            'orderdata' => $orderdata,
            'serviceType' => $servicetype,
            'companyName' => $companyName,
            'businessId' => $business_id,
        ]);
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
