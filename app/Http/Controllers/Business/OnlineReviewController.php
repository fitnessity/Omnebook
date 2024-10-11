<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use Auth,DateTime,Carbon\Carbon;
use App\{BusinessServiceReview,Exports\ExportReview };
use Maatwebsite\Excel\HeadingRowImport;
use Excel, Response,\PDF;

class OnlineReviewController extends BusinessBaseController
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
        $filterStartDate = $request->startDate != '' ? Carbon::parse($request->startDate) : Carbon::parse($this->firstDate);
        $filterEndDate = $request->endDate !=  '' ? Carbon::parse($request->endDate) : Carbon::parse($this->endDate);
        $sortedDates = $this->getDatesArray($request->startDate , $filterStartDate, $filterEndDate);
        $serviceAry =  BusinessServiceReview::orderBy('created_at','desc')->whereDate('created_at', '>=', $filterStartDate)->whereDate('created_at', '<=', $filterEndDate);
    	return view('business.reports.review.index',compact('filterStartDate','filterEndDate','sortedDates','serviceAry','business_id'));
    }



    public function export(Request $request,$business_id){
        $serviceAry =  BusinessServiceReview::orderBy('created_at','desc')->whereDate('created_at', '>=', $request->startDate)->whereDate('created_at', '<=', $request->endDate)->get();
        if($request->type == 'excel'){
            return Excel::download(new ExportReview($serviceAry), 'Online-Review.xlsx');
        }elseif($request->type == 'pdf'){
            if($request->endDate && $request->startDate){
                $ed = new DateTime($request->endDate);
                $sd = new DateTime($request->startDate);
                $dates = $sd->format('l, F j, Y').' to '.$ed->format('l, F j, Y');
            }else{
                $ed = new DateTime();
                $dates = $ed->format('l, F j, Y');                
            } 

            $data = [
                'reviews'=>$serviceAry,
                'dates' => $dates
            ];
            $pdf = PDF::loadView('business.reports.review.pdf_view', $data);
            return $pdf->download('Online-Review.pdf');
        }
    }
}