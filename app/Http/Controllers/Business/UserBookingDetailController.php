<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
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

        $company = $request->current_company->findOrFail($business_id);
        $customer = $company->customers()->findOrFail($request->customer_id);
        $booking_status = $customer->bookingStatus()->findOrFail($request->booking_id);
        $booking_detail = $booking_status->UserBookingDetail()->findOrFail($request->booking_detail_id);

        $overwrite = [];
        if($request->expired_at){
            $overwrite['expired_at'] = date('Y-m-d',strtotime($request->expired_at));

        }

        if($request->contract_date){
            $overwrite['contract_date'] = date('Y-m-d',strtotime($request->contract_date));
        }


        $booking_detail->update(array_merge($request->only([
            'pay_session', 
            'contract_date', 
            'expired_at'
        ]), $overwrite));
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $business_id,$id)
    {
        $company = $request->current_company->findOrFail($business_id);
        $customer = $company->customers()->findOrFail($request->customer_id);
        $booking_status = $customer->bookingStatus()->findOrFail($id);
        $booking_detail = $booking_status->UserBookingDetail()->findOrFail($request->booking_detail_id);
        $booking_detail->update(["status" => 'void']);
    }
 
    public function refund(Request $request, $business_id){
        $company = $request->current_company->findOrFail($business_id);
        $customer = $company->customers()->findOrFail($request->customer_id);
        $booking_status = $customer->bookingStatus()->findOrFail($request->booking_id);
        $booking_detail = $booking_status->UserBookingDetail()->findOrFail($request->booking_detail_id);
        $booking_detail->update(["status" => 'refund' ,'refund_reason' => $request->refund_reason,'refund_date' => date('Y-m-d',strtotime($request->refunddate)),'refund_amount' => $request->refund_amount,'refund_method' =>$request->refund_method ]);
        $customer->refund();
    } 

    public function suspend(Request $request, $business_id){
        $company = $request->current_company->findOrFail($business_id);
        $customer = $company->customers()->findOrFail($request->customer_id);
        $booking_status = $customer->bookingStatus()->findOrFail($request->booking_id);
        $booking_detail = $booking_status->UserBookingDetail()->findOrFail($request->booking_detail_id);
        $booking_detail->update(["status" => 'suspend' ,'suspend_reason' => $request->suspension_reason,'suspend_started' => date('Y-m-d',strtotime($request->suspensionstartdate)),'suspend_ended' =>date('Y-m-d',strtotime($request->suspensionenddate)) ,'suspend_fee' => $request->suspension_fee,'suspend_comment' =>$request->suspension_comment]);
    } 

    public function terminate(Request $request, $business_id){
        $company = $request->current_company->findOrFail($business_id);
        $customer = $company->customers()->findOrFail($request->customer_id);
        $booking_status = $customer->bookingStatus()->findOrFail($request->booking_id);
        $booking_detail = $booking_status->UserBookingDetail()->findOrFail($request->booking_detail_id);
        $booking_detail->update(["status" => 'cancel' ,'terminate_reason' => $request->terminate_reason,'terminated_at' => date('Y-m-d',strtotime($request->terminated_at)),'terminate_fee' => $request->terminate_fee,'terminate_comment' =>$request->terminate_comment]);
    }
}
