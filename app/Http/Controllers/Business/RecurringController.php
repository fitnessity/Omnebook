<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\{Recurring};

class RecurringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $business_id)
    {
        $user = Auth::user();
        $company = $user->businesses()->findOrFail($business_id);
        $customer = $company->customers->find($request->customer_id);
        $booking_detail = $company->UserBookingDetails->find($request->booking_detail_id);
        $autopaylist = $customer->recurring($request->booking_detail_id)->orderby('created_at','desc')->get();
        $remaining = Recurring::autoPayRemaining(count($autopaylist),$request->booking_detail_id);
        //print_r($autopaylist );exit;
        return view('business.recurring.index', ['autopaylist' => $autopaylist, 'customer' => $customer,'booking_detail'=>$booking_detail,'remaining'=>$remaining ,'i'=>1 ,'business_id'=>$business_id]);
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
    public function update(Request $request, $business_id ,$id)
    {
        $rec = Recurring::where('id',$id)->first();
        $rec->update(["payment_date" =>date('Y-m-d',strtotime($request->payment_date)) ,"amount" =>$request->amount]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($business_id,$id)
    {
        $ids = explode(",",$id);
        foreach($ids as $i){
            $recurring_detail = Recurring::findOrFail($id);
            $recurring_detail->delete();
        }
    }
}
