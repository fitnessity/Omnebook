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

    }
}
