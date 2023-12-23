<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use Auth,DateTime,Carbon\Carbon;
use App\{Exports\ExportClient,Customer};
use Maatwebsite\Excel\HeadingRowImport;
use Excel, Response,\PDF;

class ClientReportController extends BusinessBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index(Request $request,$business_id)
    {
        $date = date("Y-m-d");
        $filterStartDate = $request->startDate != '' ? Carbon::parse($request->startDate) : Carbon::parse($date);
        $filterEndDate = $request->endDate !=  '' ? Carbon::parse($request->endDate) : Carbon::parse($date);

        $compareStartDt = $request->startDate != '' ? Carbon::parse($filterStartDate) : Carbon::parse($date);
        $dates = $reportData = [];

        while ($compareStartDt <= $filterEndDate) {
            $dates[] = $compareStartDt->copy(); 
            $compareStartDt->addDay();
        }

        $sortedDates = array_reverse($dates);

        $clients = Customer::where(['business_id'=> $business_id])->get();
        return view('business.reports.client.index',compact('clients','filterStartDate','filterEndDate','sortedDates'));
    }

    public function newClient(Request $request,$business_id){
        $endDate = date("Y-m-t");
        $firstDate = date('Y-m-01');
        $filterStartDate = $request->startDate != '' ? Carbon::parse($request->startDate) : Carbon::parse($firstDate);
        $filterEndDate = $request->endDate !=  '' ? Carbon::parse($request->endDate) : Carbon::parse($endDate);

        $compareStartDt = $request->startDate != '' ? Carbon::parse($filterStartDate) : Carbon::parse($firstDate);
        $dates = $reportData = [];

        while ($compareStartDt <= $filterEndDate) {
            $dates[] = $compareStartDt->copy(); 
            $compareStartDt->addDay();
        }

        $clients = Customer::where(['business_id'=> $business_id])->orderBy('created_at','desc')->whereDate('created_at', '>=', $filterStartDate)->whereDate('created_at', '<=', $filterEndDate);
        $sortedDates = array_reverse($dates);
        return view('business.reports.client.new_client',compact('clients','filterStartDate','filterEndDate','sortedDates'));
    }

    public function clientbirthday(Request $request,$business_id){
        $endDate = date("Y-m-t");
        $firstDate = date('Y-m-01');
        $filterStartDate = $request->startDate != '' ? Carbon::parse($request->startDate) : Carbon::parse($firstDate);
        $filterEndDate = $request->endDate !=  '' ? Carbon::parse($request->endDate) : Carbon::parse($endDate);

        $compareStartDt = $request->startDate != '' ? Carbon::parse($filterStartDate) : Carbon::parse($firstDate);
        $dates = $reportData = [];

        while ($compareStartDt <= $filterEndDate) {
            $dates[] = $compareStartDt->copy(); 
            $compareStartDt->addDay();
        }

        $starMonth = $filterStartDate->month;
        $endMonth = $filterStartDate->month;

        $clients = Customer::where(['business_id'=> $business_id])->orderBy('created_at','desc')->whereMonth('birthdate', '>=', $starMonth)->whereMonth('birthdate', '<=', $endMonth);

        $sortedDates = array_reverse($dates);
        return view('business.reports.client.client_birthday',compact('clients','filterStartDate','filterEndDate','sortedDates'));
    }   

    public function export(Request $request,$business_id){

        if($request->clientType == 'new'){
            $clients = Customer::where(['business_id'=> $business_id])->orderBy('created_at','desc')->whereDate('created_at', '>=', $request->startDate)->whereDate('created_at', '<=', $request->endDate)->get();
            $excelFileName = 'new-client.xlsx';
            $pdfFileName = 'new-client.pdf';
            $heading = 'New Clients Report';
        }if($request->clientType == 'inactive'){
            $clients = Customer::where(['business_id'=> $business_id])->orderBy('created_at','desc')->whereDate('created_at', '>=', $request->startDate)->whereDate('created_at', '<=', $request->endDate)->get();
            $excelFileName = 'new-client.xlsx';
            $pdfFileName = 'new-client.pdf';
            $heading = 'New Clients Report';
        }else if($request->clientType == 'birthday'){

            $startMonth =  Carbon::parse($request->startDate)->month;
            $endMonth =  Carbon::parse($request->endDate)->month;

            $startDay =  Carbon::parse($request->startDate)->day;
            $endDay =  Carbon::parse($request->endDate)->day;

            $clients = Customer::where(['business_id'=> $business_id])->orderByRaw("MONTH(birthdate), DAY(birthdate)")->whereMonth('birthdate', '>=', $startMonth)->whereMonth('birthdate', '<=', $endMonth)->whereDay('birthdate', '>=', $startDay)->whereDay('birthdate', '<=', $endDay)->get();
            $heading = 'Client\'s Birthday Report' ;
            $excelFileName = 'clients-birthday.xlsx';
            $pdfFileName = 'clients-birthday.pdf';
        }

        if($request->type == 'excel'){
            return Excel::download(new ExportClient($clients ,$heading,$request->clientType), $excelFileName);
        }elseif($request->type == 'pdf'){

            $data = [
                'title' => $heading,
                'clients'=>$clients,
                'clientType'=>$request->clientType,
            ];
            $pdf = PDF::loadView('business.reports.client.pdf_view_new_client', $data);
            return $pdf->download($pdfFileName);
        }
    }
}