<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use Auth;


class MembershipExpirationsController extends BusinessBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
    	return view('business.member_expirations.index');
    }

    public function membership($days){
    	$business = Auth::user()->current_company;
    	$booking = $business->UserBookingDetails();
    	if($days == 'all') {
    		$enddate = date('Y-m-d');
    	}else{
    		$enddate = date('Y-m-d', strtotime("+".$days." days"));
    	}

    	$membership = $booking->whereDate('expired_at', '<=',$enddate);
    	if($days != 'all') {
	        $membership = $membership->whereDate('expired_at', '>=', date('Y-m-d'));
	    }
	    return  $membership;
    }

    public function getMemberships(Request $request){
    	$type = $request->days;
    	$expiringMembership = $this->membership($type);
	    $expiringMembership = $expiringMembership->orderby('expired_at','desc')->limit(10)->get();
    	return view('business.member_expirations.table_data',compact('expiringMembership','type'));
    }

    public function getMoreMemberships(Request $request)
    {
  		$type = $request->days;
		$expiringMembership = $this->membership($type);
        $offset = $request->get('offset', 0); // Offset for pagination, passed from the frontend
        $limit = 10; // Number of records to load per request
      
        $expiringMembership = $expiringMembership->orderby('expired_at','desc')->take($offset)->get();
    	return view('business.member_expirations.table_data',compact('expiringMembership','type'));
    }
}