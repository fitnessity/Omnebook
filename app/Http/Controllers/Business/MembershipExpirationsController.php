<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use Auth;
use DateTime;
use App\Exports\ExportMembership;
use Maatwebsite\Excel\HeadingRowImport;
use Excel;
use Response;
use \PDF;

class MembershipExpirationsController extends BusinessBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $today = new DateTime();
    	return view('business.reports.member_expirations.index',compact('today'));
    }

    public function membership($days,$edate,$sDate){
    	$business = Auth::user()->current_company;
    	$booking = $business->UserBookingDetails();

    	if($days == 'all') {
            if($edate != '' && $edate < date('Y-m-d')){
                $enddate = $edate;
            }else{
                $enddate = date('Y-m-d');
            }
            $membership = $booking->whereDate('expired_at', '<',$enddate);
    	}else if($days == 'today'){
            if($edate != '' && $edate == date('Y-m-d')){
                $enddate = $edate;
            }else{
                $enddate = date('Y-m-d');
            }
            $membership = $booking->whereDate('expired_at', '=',$enddate);
        }else{
            if($edate != '' && $edate != date('Y-m-d')){
                $enddate = $edate;
            }else{
                $enddate = date('Y-m-d', strtotime("+".$days." days"));
            }
            $membership = $booking->whereDate('expired_at', '<=',$enddate);
    	}
    	
        if($sDate != '' && $sDate != date('Y-m-01')){
            $membership = $membership->whereDate('expired_at', '>=', $sDate);
        }elseif($days != 'all'){
            $membership = $membership->whereDate('expired_at', '>=', date('Y-m-d'));
        }
	    
	    return  $membership;
    }

    public function getMemberships(Request $request){
    	$type = $request->days;
    	$expiringMembership = $this->membership($type,$request->endDate,$request->startDate);
	    $expiringMembership = $expiringMembership->orderby('expired_at','desc')->get();
        $memberships = $expiringMembership->filter(function ($item) {
            return $item->Customer && $item->business_price_detail;
        });
        if($request->limit == ''){
            $memberships = $memberships->take(10);
        }
    	return view('business.reports.member_expirations.table_data',compact('memberships','type'));
    }

    public function getMoreMemberships(Request $request)
    {
  		$type = $request->days;
		$expiringMembership = $this->membership($type,$request->endDate,$request->startDate);
        $offset = $request->get('offset', 0); 
        $limit = 10;
      
        $expiringMembership = $expiringMembership->orderby('expired_at','desc')->get();
        $memberships = $expiringMembership->filter(function ($item) {
            return $item->Customer && $item->business_price_detail;
        });
        $memberships = $memberships->take($offset);
    	return view('business.reports.member_expirations.table_data',compact('memberships','type'));
    }

    public function export(Request $request){
        $type = $request->type;
        if($type == 'excel'){
            return Excel::download(new ExportMembership($request->endDate,$request->startDate), 'membership.xlsx');
        }elseif($type == 'pdf'){
            $expiringMembershipAll = $this->membership('all',$request->endDate,$request->startDate)->orderby('expired_at','desc')->get();

            $expiringMembershipThd = $this->membership('30',$request->endDate,$request->startDate)->orderby('expired_at','desc')->get();

            $expiringMembershipNid = $this->membership('90',$request->endDate,$request->startDate)->orderby('expired_at','desc')->get();

            $expiringMembershipTdy = $this->membership('today',$request->endDate,$request->startDate)->orderby('expired_at','desc')->get();

            $filteredMembershipTdy = $this->filterMemberships($expiringMembershipTdy);
            $filteredMembershipsAll = $this->filterMemberships($expiringMembershipAll);
            $filteredMembershipsThd = $this->filterMemberships($expiringMembershipThd);
            $filteredMembershipsNid = $this->filterMemberships($expiringMembershipNid);

            if($request->endDate && $request->startDate){
                $ed = new DateTime($request->endDate);
                $sd = new DateTime($request->startDate);
                $dates = $sd->format('l, F j, Y').' to '.$ed->format('l, F j, Y');
            }else{
                $ed = new DateTime();
                $dates = $ed->format('l, F j, Y');                
            }   

            $data = [
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
            return $pdf->download('Membership.pdf');
        }
    }

    private function filterMemberships($collection) {
        return $collection->filter(function ($item) {
            return $item->Customer && $item->business_price_detail;
        });
    }
}