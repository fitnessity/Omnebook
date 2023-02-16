<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{UserBookingDetail,UserBookingStatus};

class UserBookingDetailController extends Controller
{
    //
	
	public function index()
    {
    }
	
	/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $business_id)
    {
        $expired_at = UserBookingDetail::getexpiretime($request->expire_duration,$request->membershipactivationdate);
        UserBookingDetail::where('id',$request->booking_detail_id)->update(["pay_session" => $request->session,"expired_duration" => $request->expire_duration ,'contract_date' =>date('Y-m-d',strtotime($request->membershipactivationdate)) ,"expired_at" =>$expired_at]);
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($business_id, $id)
    {
        UserBookingStatus::where('id',$id)->update(["status" => 'void']);
    }


    public function refund(Request $request, $business_id){
        //
    } 

    public function suspend(Request $request, $business_id){
        UserBookingDetail::where('id',$request->booking_detail_id)->update(["status" => 'suspend' ,'suspend_reason' => $request->suspension_reason,'suspend_started' => date('Y-m-d',strtotime($request->suspensionstartdate)),'suspend_ended' =>date('Y-m-d',strtotime($request->suspensionenddate)) ,'suspend_fee' => $request->suspension_fee,'suspend_comment' =>$request->suspension_comment]);
    } 

    public function terminate(Request $request, $business_id){
        UserBookingDetail::where('id',$request->booking_detail_id)->update(["status" => 'cancel' ,'terminate_reason' => $request->terminate_reason,'terminated_at' => date('Y-m-d',strtotime($request->terminatestartdate)),'terminate_fee' => $request->terminate_fee,'terminate_comment' =>$request->terminate_comment]);
    }
}
