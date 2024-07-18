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

    public function RawQueryFunction($business_id , $filterStartDate , $filterEndDate ,$columnName){
        return UserBookingDetail::where(['business_id'=> $business_id,'order_type'=>'Membership'])->orderBy($columnName,'desc')->whereDate($columnName, '>=', $filterStartDate)->whereDate($columnName, '<=', $filterEndDate);
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
        $bookings = $this->RawQueryFunction($business_id , $filterStartDate , $filterEndDate ,'expired_at')->where('status' ,'Active');
    	return view('business.reports.membership.index',compact('bookings','filterStartDate','filterEndDate','sortedDates','displayChk'));
    }

    public function activeMembershipNotUsed(Request $request,$business_id)
    {
        $displayChk = 1;
        $filterStartDate = $request->startDate != '' ? Carbon::parse($request->startDate) : Carbon::parse($this->firstDate);
        $filterEndDate = $request->endDate !=  '' ? Carbon::parse($request->endDate) : Carbon::parse($this->endDate);
        $sortedDates = $this->getDatesArray($request->startDate , $filterStartDate, $filterEndDate);
        $bookings = $this->RawQueryFunction($business_id , $filterStartDate , $filterEndDate,'expired_at')->join('booking_checkin_details as bcd' ,'bcd.booking_detail_id', '=' ,'user_booking_details.id')->select('user_booking_details.*');

        return view('business.reports.membership.active_activity_not_used',compact('bookings','filterStartDate','filterEndDate','sortedDates','displayChk'));
    }

    public function membershipPaused(Request $request,$business_id){
        $displayChk = 1;
        $filterStartDate = $request->startDate != '' ? Carbon::parse($request->startDate) : Carbon::parse($this->firstDate);
        $filterEndDate = $request->endDate !=  '' ? Carbon::parse($request->endDate) : Carbon::parse($this->endDate);
        $sortedDates = $this->getDatesArray($request->startDate , $filterStartDate, $filterEndDate);

        $bookings = $this->RawQueryFunction($business_id , $filterStartDate , $filterEndDate ,'suspend_started')->where('status','suspend');
        return view('business.reports.membership.membership_paused',compact('bookings','filterStartDate','filterEndDate','sortedDates','displayChk'));
    }

    public function membershipTerminated(Request $request,$business_id){
        $displayChk = 1;
        $filterStartDate = $request->startDate != '' ? Carbon::parse($request->startDate) : Carbon::parse($this->firstDate);
        $filterEndDate = $request->endDate !=  '' ? Carbon::parse($request->endDate) : Carbon::parse($this->endDate);
        $sortedDates = $this->getDatesArray($request->startDate , $filterStartDate, $filterEndDate);
        $bookings = $this->RawQueryFunction($business_id , $filterStartDate , $filterEndDate ,'terminated_at')->where('status','terminate'); 
        return view('business.reports.membership.membership_terminated',compact('bookings','filterStartDate','filterEndDate','sortedDates','displayChk'));
    }

    public function membershipPopular(Request $request,$business_id){
        $displayChk = 1;
        $filterStartDate = $request->startDate != '' ? Carbon::parse($request->startDate) : Carbon::parse(date('Y-m-01'));
        $filterEndDate = $request->endDate !=  '' ? Carbon::parse($request->endDate) : Carbon::parse($this->endDate);
        $bookings = $this->RawQueryFunction($business_id , $filterStartDate , $filterEndDate ,'created_at')->get();
        return view('business.reports.membership.membership_popular',compact('bookings','filterStartDate','filterEndDate','displayChk'));
    }

    public function export(Request $request,$business_id){
        $bookings = $this->RawQueryFunction($business_id , $request->startDate , $request->endDate,'expired_at');

        if($request->page == 'not_used'){
            $oneMonthAgo = Carbon::parse($request->startDate)->subDays(30)->format('Y-m-d');
            $bookings = $bookings->join('booking_checkin_details as bcd' ,'bcd.booking_detail_id', '=' ,'user_booking_details.id')->select('user_booking_details.*')->where('bcd.checked_at', '<', $oneMonthAgo)->whereNotNull('bcd.checkin_date')->groupBy('id');
            $fileName = 'Not-Used-Membership';
            $title = 'Not Used Membership Report';
        }elseif($request->page == 'terminate'){
            $bookings = $this->RawQueryFunction($business_id , $request->startDate , $request->endDate ,'terminated_at')->where('status','terminate');
            $fileName = 'Terminate-Membership';
            $title = 'Terminate Membership Report';
        }elseif($request->page == 'paused'){
            $bookings = $this->RawQueryFunction($business_id , $request->startDate , $request->endDate ,'suspend_started')->where('status','suspend');
            $fileName = 'Paused-Membership';
            $title = 'Paused Membership Report';
        }elseif($request->page == 'popular'){
            $bookings = $this->RawQueryFunction($business_id , $request->startDate , $request->endDate ,'created_at');
            $fileName = 'Popular-Membership';
            $title = 'Popular Membership Report';
        }else{
            $bookings = $bookings->where('status' ,'Active');
            $fileName = 'Active-Membership';
            $title = 'Active Membership Report';
        }

        $bookings = $bookings->groupBy('id')->get()->filter(function($item){
            return $item->Customer;
        });
        $type = $request->type;
        if($type == 'excel'){
            return Excel::download(new ExportTodayBooking($bookings,$request->page), $fileName.'.xlsx');
        }elseif($type == 'pdf'){

            if($request->endDate && $request->startDate){
                $ed = new DateTime($request->endDate);
                $sd = new DateTime($request->startDate);
                $dates = $sd->format('l, F j, Y').' to '.$ed->format('l, F j, Y');
            }else{
                $ed = new DateTime();
                $dates = $ed->format('l, F j, Y');                
            } 

            $data = [
                'bookings'=>$bookings,
                'page'=>$request->page,
                'title'=>$title,
                'dates'=>$dates,
                'business_id'=>$business_id,
            ];
            $pdf = PDF::loadView('business.reports.membership.pdf_view', $data);
            return $pdf->download($fileName.'.pdf');
        }
    }
}