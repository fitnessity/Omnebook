<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\BusinessCompanyDetail;
use App\BusinessServices;
use App\UserBookingStatus;
use Auth;
use DB;


class SchedulerController extends Controller
{
    public function index()
    {
        $companyId = !empty(Auth::user()->cid) ? Auth::user()->cid : "";
        $companyservice  =[];
        if(!empty($companyId)) {
             $business_details = BusinessCompanyDetail::where('cid', $companyId)->get();
              $business_details = isset($business_details[0]) ? $business_details[0] : [];
            $companyservice = BusinessServices::where('userid', Auth::user()->id)->where('cid', $companyId)->orderBy('id', 'DESC')->get();
        }
        return view('scheduler.index', [
             'business_details' => $business_details,
            'companyservice' => $companyservice
        ]);
    }

    public function scheduler_checkin(){
        $companyId = !empty(Auth::user()->cid) ? Auth::user()->cid : "";
        $companyservice  =[];
        if(!empty($companyId)) {
             $business_details = BusinessCompanyDetail::where('cid', $companyId)->get();
              $business_details = isset($business_details[0]) ? $business_details[0] : [];
            $companyservice = BusinessServices::where('userid', Auth::user()->id)->where('cid', $companyId)->orderBy('id', 'DESC')->get();
        }
        return view('scheduler.scheduler_checkin', [
             'business_details' => $business_details,
            'companyservice' => $companyservice
        ]);
    }
}
