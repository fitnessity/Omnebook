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
}
