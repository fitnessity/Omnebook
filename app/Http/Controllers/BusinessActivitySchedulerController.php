<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{CompanyInformation,UserBookingStatus,UserBookingDetail,BusinessActivityScheduler,Customer};
use DateTime;
use Auth;

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
        $business_services = $company->service()->where('is_active',1)->orderBy('created_at','desc');
        $servicetype = 'all';
        if($request->stype && $request->business_service_id == ''){
            $servicetype = $request->stype;
            if($request->stype != 'all'){
                $business_services = $company->service()->where(['is_active'=>1, 'service_type' => $servicetype])->orderBy('created_at','desc');
            }else{
                $business_services = $company->service()->where('is_active',1)->orderBy('created_at','desc');
            }
        }

        $full_name = '';
        if($request->customer_id){
            $customer = Customer::where('id',$request->customer_id)->first();
        }else{
            $user= Auth::user();
            $customer = Customer::where(['user_id'=>@$user->id, 'business_id'=>$business_id])->first();
        }

        if($request->business_service_id){
            $servicetype = $request->stype;
            $business_services = $company->service()->where(['id'=>$request->business_service_id,'is_active'=>1, 'service_type' => $servicetype]);
            //print_r($business_services);exit;
            
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

        $companyName = $company->dba_business_name;
        $bookschedulers = BusinessActivityScheduler::getallscheduler($filter_date)->whereIn('serviceid', $business_services->pluck('id'))->orderBy('end_activity_date', 'desc')->get();
        $services = [];

        //print_r($bookschedulers);exit;
        foreach($bookschedulers as $bs){
            $services []= $bs->business_service;
        }
        $services = array_unique($services);
        // /print_r( $services);exit;
        return view('business-activity-schedular.index',[
            'days' => $days,
            'filter_date' => $filter_date,
            /*'orderdata' => $orderdata,*/
            'serviceType' => $servicetype,
            'services' => $services,
            'companyName' => $companyName,
            'businessId' => $business_id,
            'priceid' => $request->priceid,
            'customer' => $customer,
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
