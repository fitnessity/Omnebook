<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use Auth,DateTime,Carbon\Carbon;
use App\{Exports\ExportTodayBooking,UserBookingDetail };
use Maatwebsite\Excel\HeadingRowImport;
use Excel, Response,\PDF;

class ActiveMembershipController extends BusinessBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {  
        $this->endDate = date("Y-m-t");
        $this->firstDate = date('Y-m-d');
    }

    public function RawQueryFunction($business_id , $filterStartDate , $filterEndDate){
        return UserBookingDetail::where(['business_id'=> $business_id,'order_type'=>'Membership'])->orderBy('expired_at','desc')->whereDate('expired_at', '>=', $filterStartDate)->whereDate('expired_at', '<=', $filterEndDate);
    }

    public function getDatesArray($startDate, $filterStartDate, $filterEndDate ){
        $compareStartDt = $startDate != '' ? Carbon::parse($filterStartDate) : Carbon::parse($this->firstDate);
        $dates =  [];

        while ($compareStartDt <= $filterEndDate) {
            $dates[] = $compareStartDt->copy(); 
            $compareStartDt->addDay();
        }
        return array_reverse($dates);
    }

    public function index(Request $request,$business_id)
    {
        $displayChk = 1;
        $filterStartDate = $request->startDate != '' ? Carbon::parse($request->startDate) : Carbon::parse($this->firstDate);
        $filterEndDate = $request->endDate !=  '' ? Carbon::parse($request->endDate) : Carbon::parse($this->endDate);
        $sortedDates = $this->getDatesArray($request->startDate , $filterStartDate, $filterEndDate);
        $bookings = $this->RawQueryFunction($business_id , $filterStartDate , $filterEndDate);
    	return view('business.reports.membership.index',compact('bookings','filterStartDate','filterEndDate','sortedDates','displayChk'));
    }

    public function activeMembershipNotUsed(Request $request,$business_id)
    {
        $displayChk = 1;
        $filterStartDate = $request->startDate != '' ? Carbon::parse($request->startDate) : Carbon::parse($this->firstDate);
        $filterEndDate = $request->endDate !=  '' ? Carbon::parse($request->endDate) : Carbon::parse($this->endDate);
        $sortedDates = $this->getDatesArray($request->startDate , $filterStartDate, $filterEndDate);
        $bookings = $this->RawQueryFunction($business_id , $filterStartDate , $filterEndDate)->join('booking_checkin_details as bcd' ,'bcd.booking_detail_id', '=' ,'user_booking_details.id')->select('user_booking_details.*');

        return view('business.reports.membership.active_activity_not_used',compact('bookings','filterStartDate','filterEndDate','sortedDates','displayChk'));
    }

    public function membershipPaused(Request $request,$business_id){
        $displayChk = 1;
        $filterStartDate = $request->startDate != '' ? Carbon::parse($request->startDate) : Carbon::parse($this->firstDate);
        $filterEndDate = $request->endDate !=  '' ? Carbon::parse($request->endDate) : Carbon::parse($this->endDate);
        $sortedDates = $this->getDatesArray($request->startDate , $filterStartDate, $filterEndDate);
        $bookings = UserBookingDetail::where(['business_id'=> $business_id,'order_type'=>'Membership'])->orderBy('suspend_started','desc')->whereDate('suspend_started', '>=', $filterStartDate)->whereDate('suspend_started', '<=', $filterEndDate)->where('status','suspend');

        return view('business.reports.membership.membership_paused',compact('bookings','filterStartDate','filterEndDate','sortedDates','displayChk'));
    }


    public function membershipTerminated(Request $request,$business_id){
        $displayChk = 1;
        $filterStartDate = $request->startDate != '' ? Carbon::parse($request->startDate) : Carbon::parse($this->firstDate);
        $filterEndDate = $request->endDate !=  '' ? Carbon::parse($request->endDate) : Carbon::parse($this->endDate);
        $sortedDates = $this->getDatesArray($request->startDate , $filterStartDate, $filterEndDate);
        $bookings = UserBookingDetail::where(['business_id'=> $business_id,'order_type'=>'Membership'])->orderBy('terminated_at','desc')->whereDate('terminated_at', '>=', $filterStartDate)->whereDate('terminated_at', '<=', $filterEndDate)->where('status','terminate');

        return view('business.reports.membership.membership_terminated',compact('bookings','filterStartDate','filterEndDate','sortedDates','displayChk'));
    }

    public function membershipPopular(Request $request,$business_id){
        $displayChk = 1;
        $filterStartDate = $request->startDate != '' ? Carbon::parse($request->startDate) : Carbon::parse($this->firstDate);
        $filterEndDate = $request->endDate !=  '' ? Carbon::parse($request->endDate) : Carbon::parse($this->endDate);
        $sortedDates = $this->getDatesArray($request->startDate , $filterStartDate, $filterEndDate);
        $bookings = UserBookingDetail::where(['business_id'=> $business_id,'order_type'=>'Membership'])->orderBy('terminated_at','desc')->whereDate('terminated_at', '>=', $filterStartDate)->whereDate('terminated_at', '<=', $filterEndDate)->where('status','terminate');

        return view('business.reports.membership.membership_popular',compact('bookings','filterStartDate','filterEndDate','sortedDates','displayChk'));
    }

    public function export(Request $request,$business_id){
        $bookings = $this->RawQueryFunction($business_id , $request->startDate , $request->endDate);

        if($request->page){
            $oneMonthAgo = Carbon::parse($request->startDate)->subDays(30)->format('Y-m-d');
            $bookings = $bookings->join('booking_checkin_details as bcd' ,'bcd.booking_detail_id', '=' ,'user_booking_details.id')->select('user_booking_details.*')->where('bcd.checked_at', '<', $oneMonthAgo)->whereNotNull('bcd.checkin_date');
        }

        $bookings = $bookings->get();
        $type = $request->type;
        if($type == 'excel'){
            return Excel::download(new ExportTodayBooking($bookings), 'Membership.xlsx');
        }elseif($type == 'pdf'){
            $data = [
                'bookings'=>$bookings,
            ];
            $pdf = PDF::loadView('business.reports.booking.pdf_view_booking', $data);
            return $pdf->download('Membership.pdf');
        }
    }
}