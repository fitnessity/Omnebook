<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use Auth,DateTime,Carbon\Carbon;
use App\{Exports\ExportTodayBooking,UserBookingDetail };
use Maatwebsite\Excel\HeadingRowImport;
use Excel, Response,\PDF;

class RefundReportController extends BusinessBaseController
{


    public function __construct()
    {  
        $this->endDate = date("Y-m-t");
        $this->firstDate = date('Y-m-d');
    }

    public function RawQueryFunction($business_id , $filterStartDate , $filterEndDate){
        return  UserBookingDetail::where(['business_id'=> $business_id,'order_type'=>'Membership'])->orderBy('refund_date','desc')->whereDate('refund_date', '>=', $filterStartDate)->whereDate('refund_date', '<=', $filterEndDate)->where('status','refund');
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
        return view('business.reports.refund.index',compact('bookings','filterStartDate','filterEndDate','sortedDates','displayChk'));
    }

    public function export(Request $request,$business_id){
        $bookings = $this->RawQueryFunction($business_id , $request->startDate , $request->endDate)->get();
        $type = $request->type;
        if($type == 'excel'){
            return Excel::download(new ExportTodayBooking($bookings), 'Refund-Membership.xlsx');
        }elseif($type == 'pdf'){
            $data = [
                'bookings'=>$bookings,
            ];
            $pdf = PDF::loadView('business.reports.refund.pdf_view_data', $data);
            return $pdf->download('Refund-Membership.pdf');
        }
    }
}
?>
