<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use Auth,DateTime,Carbon\Carbon;
use App\{Exports\ExportTodayBooking,UserBookingDetail };
use Maatwebsite\Excel\HeadingRowImport;
use Excel, Response,\PDF;

class BookingReportController extends BusinessBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request,$business_id)
    {
        $today = new DateTime();
        
        $filterStartDate = $request->startDate != '' ? Carbon::parse($request->startDate) : Carbon::parse($today);
        $filterEndDate = $request->endDate !=  '' ? Carbon::parse($request->endDate) : Carbon::parse($today);

        $compareStartDt = $request->startDate != '' ? Carbon::parse($filterStartDate) : Carbon::parse($today);
        $dates = $reportData = [];

        while ($compareStartDt <= $filterEndDate) {
            $dates[] = $compareStartDt->copy(); 
            $compareStartDt->addDay();
        }

        $sortedDates = array_reverse($dates);
        $bookings = UserBookingDetail::where(['business_id'=> $business_id,'order_type'=>'Membership'])->orderBy('created_at','desc')->whereDate('created_at', '>=', $filterStartDate)->whereDate('created_at', '<=', $filterEndDate);
        $displayChk = 1;
    	return view('business.reports.booking.index',compact('bookings','filterStartDate','filterEndDate','sortedDates','displayChk'));
    }


    public function booking_category(Request $request,$business_id)
    {
        $today = new DateTime();
        $filterStartDate = $request->startDate != '' ? Carbon::parse($request->startDate) : Carbon::parse($today);
        $filterEndDate = $request->endDate !=  '' ? Carbon::parse($request->endDate) : Carbon::parse($today);

        $compareStartDt = $request->startDate != '' ? Carbon::parse($filterStartDate) : Carbon::parse($today);
        $dates = $reportData = [];

        while ($compareStartDt <= $filterEndDate) {
            $dates[] = $compareStartDt->copy(); 
            $compareStartDt->addDay();
        }

        $sortedDates = array_reverse($dates);
        $bookings = UserBookingDetail::where(['business_id'=> $business_id,'order_type'=>'Membership'])->orderBy('created_at','desc')->whereDate('created_at', '>=', $filterStartDate)->whereDate('created_at', '<=', $filterEndDate);
        $displayChk = 1;
        return view('business.reports.booking.booking_category',compact('bookings','filterStartDate','filterEndDate','sortedDates','displayChk'));
    }

    public function booking_history(Request $request,$business_id){
        $today = date("Y-m-t");
        $firstDate = date('Y-m-01');
        $filterStartDate = $request->startDate != '' ? Carbon::parse($request->startDate) : Carbon::parse($firstDate);
        $filterEndDate = $request->endDate !=  '' ? Carbon::parse($request->endDate) : Carbon::parse($today);

        $compareStartDt = $request->startDate != '' ? Carbon::parse($filterStartDate) : Carbon::parse($firstDate);
        $dates = $reportData = [];

        while ($compareStartDt <= $filterEndDate) {
            $dates[] = $compareStartDt->copy(); 
            $compareStartDt->addDay();
        }

        $sortedDates = array_reverse($dates);
          
        $bookings = UserBookingDetail::where(['business_id'=> $business_id,'order_type'=>'Membership'])->orderBy('created_at','desc')->whereDate('created_at', '>=', $filterStartDate)->whereDate('created_at', '<=', $filterEndDate);
        $displayChk = 1;
        return view('business.reports.booking.booking_history',compact('bookings','filterStartDate','filterEndDate','sortedDates','displayChk')); 
    }

    public function export(Request $request,$business_id){

        $bookings = UserBookingDetail::where(['business_id'=> $business_id,'order_type'=>'Membership'])->orderBy('created_at','desc')->whereDate('created_at', '>=', $request->startDate)->whereDate('created_at', '<=', $request->endDate)->get();

        $type = $request->type;
        if($type == 'excel'){
            return Excel::download(new ExportTodayBooking($bookings), 'bookingtoday.xlsx');
        }elseif($type == 'pdf'){
            /*$data = [
                'title' => 'Membership Details',
                'dates' => $dates,
                'expiringMembershipTdy' => $filteredMembershipTdy,
                'expiringMembershipAll' => $filteredMembershipsAll,
                'expiringMembershipThd' => $filteredMembershipsThd,
                'expiringMembershipNid' => $filteredMembershipsNid,
                'startDate'=>$request->startDate,
                'endDate'=>$request->endDate,
            ];
            $pdf = PDF::loadView('business.reports.member_expirations.pdf_view', $data);
            return $pdf->download('Membership.pdf');*/
        }
    }
}