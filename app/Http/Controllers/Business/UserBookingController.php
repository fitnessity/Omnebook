<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\{UserBookingDetail,UserBookingStatus};

class UserBookingController extends Controller
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
    }
	
	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $business_id,$id)
    {
    }
 
    public function refund(Request $request, $business_id){

    } 

    public function sendemailofreceipt(Request $request, $business_id){

        var_dump($business_id);
        //print_r($request->all());exit;

        // $getreceipemailtbody = $this->bookings->getreceipemailtbody($request->oid, $request->odetailid);
        // $email_detail = array(
        //     'getreceipemailtbody' => $getreceipemailtbody,
        //     'email' => $request->email);
        // /*$status = MailService::sendEmailReceipt($email_detail);*/

        // //$status  = SGMailService::sendBookingReceipt($request->order_id);
        // //$status  = SGMailService::sendBookingReceipt($request->oid);
        // $status  = SGMailService::sendBookingReceipt($email_detail);
        // return $status;
    }
}
