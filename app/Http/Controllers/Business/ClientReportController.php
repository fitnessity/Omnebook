<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use Auth,DateTime,Carbon\Carbon;
use App\{Exports\ExportCancellationNoShow,Exports\ExportClient,Customer,BookingCheckinDetails};
use Maatwebsite\Excel\HeadingRowImport;
use Excel, Response,\PDF;
use App\Jobs\GeneratePdf;

class ClientReportController extends BusinessBaseController
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
        $date = new DateTime();
        $filterStartDate = $request->startDate != '' ? Carbon::parse($request->startDate) : Carbon::parse(date('Y-m-01'));
        $filterEndDate = $request->endDate !=  '' ? Carbon::parse($request->endDate) : Carbon::parse(date('Y-m-d'));
        $sortedDates = $this->getDatesArray($request->startDate , $filterStartDate, $filterEndDate);
        $clients = Customer::where(['business_id'=> $business_id])->get();
        return view('business.reports.client.index',compact('clients','filterStartDate','filterEndDate','sortedDates','date'));
    }

    public function client($type,$startDate,$endDate,$business_id){
        $endDate = Carbon::parse($endDate)->subMonths(3);
        $startDate = Carbon::parse($startDate)->subMonths(3);
        $expiringclients = Customer::where('business_id', $business_id)->leftJoin('booking_checkin_details', 'customers.id', '=', 'booking_checkin_details.customer_id');
        if($type == 'all'){
            $clients = $expiringclients->where(function ($query) use ($endDate, $startDate) {
                    $query->where(function ($subquery) use ($endDate, $startDate) {
                        $subquery->where('booking_checkin_details.checked_at', '>', $startDate)
                            ->where('booking_checkin_details.checked_at', '<', $endDate);
                    })->orWhereNull('booking_checkin_details.checked_at');
                })->orWhereNotExists(function ($query) {
                    $query->select(\DB::raw(1))
                        ->from('user_booking_details')
                        ->whereColumn('customers.id', 'user_booking_details.user_id');
                })->select('customers.*')->distinct()->get();

                $clients = $clients->filter(function ($item) use($endDate,$startDate){
                    return $item->last_attend_date != $startDate->format('Y-m-d') &&  $item->last_attend_date != $endDate->format('Y-m-d');
                });
        }else if($type == '30'){
            $endDate = $endDate->addMonth(1);
            $clients = $expiringclients->where(function ($query) use ($endDate, $startDate) {
                    $query->where(function ($subquery) use ($endDate, $startDate) {
                        $subquery->where('booking_checkin_details.checked_at', '>=', $startDate)
                            ->where('booking_checkin_details.checked_at', '<=', $endDate);
                    })->orWhereNull('booking_checkin_details.checked_at');
                })->orWhereNotExists(function ($query) {
                    $query->select(\DB::raw(1))
                        ->from('user_booking_details')
                        ->whereColumn('customers.id', 'user_booking_details.user_id');
                })->select('customers.*')->distinct()->get();
                $clients = $clients->filter(function ($item) use($endDate,$startDate){
                    return  $item->last_attend_date != 'N/A'  &&  $item->last_attend_date >= $startDate &&  $item->last_attend_date <= $endDate;
                });
        }else if($type == '90'){
            $endDate = $endDate->addMonth(3);
            $clients = $expiringclients->where(function ($query) use ($endDate, $startDate) {
                    $query->where(function ($subquery) use ($endDate, $startDate) {
                        $subquery->where('booking_checkin_details.checked_at', '>=', $startDate)
                            ->where('booking_checkin_details.checked_at', '<=', $endDate);
                    })->orWhereNull('booking_checkin_details.checked_at');
                })->orWhereNotExists(function ($query) {
                    $query->select(\DB::raw(1))
                        ->from('user_booking_details')
                        ->whereColumn('customers.id', 'user_booking_details.user_id');
                })->select('customers.*')->distinct()->get();

                $clients = $clients->filter(function ($item) use($endDate,$startDate){
                    return  $item->last_attend_date != 'N/A' &&  $item->last_attend_date >= $startDate &&  $item->last_attend_date <= $endDate ;
                });
        }else{
            $clients = $expiringclients->where(function ($query) use ($endDate, $startDate) {
                    $query->where(function ($subquery) use ($endDate, $startDate) {
                        $subquery->where('booking_checkin_details.checked_at', '=', $startDate);
                    })->orWhereNull('booking_checkin_details.checked_at');
                })->orWhereNotExists(function ($query) {
                    $query->select(\DB::raw(1))
                        ->from('user_booking_details')
                        ->whereColumn('customers.id', 'user_booking_details.user_id');
                })->select('customers.*')->distinct()->get();

            $clients = $clients->filter(function ($item) use($endDate,$startDate){
                return  $item->last_attend_date != 'N/A' &&  $item->last_attend_date >= $startDate &&  $item->last_attend_date <= $endDate;
            });        
        }

        return $clients;
    }

    public function getInactiveClients(Request $request , $business_id){
        //print_r($request->all());exit;
        $type = $request->days;
        
        $clients = $this->client($request->days,$request->startDate,$request->endDate,$business_id);
        if($request->limit == ''){
            $clients = $clients->take(10);
        }
        return view('business.reports.client.table_data',compact('clients','type'));
    }

    public function getMoreInactiveClients(Request $request , $business_id)
    {
        $type = $request->days;
        $offset = $request->get('offset', 0); 
        $limit = 10; 
        $clients = $this->client($request->days,$request->startDate,$request->endDate,$business_id);
        $clients = $clients->take($offset);
        return view('business.reports.client.table_data',compact('clients','type'));
    }


    public function inactiveCleintExport(Request $request , $business_id){
        $clients = $this->client('all',$request->startDate,$request->endDate,$business_id);
        $thirtydays = $this->client('30',$request->startDate,$request->endDate,$business_id);
        $ninetydays = $this->client('90',$request->startDate,$request->endDate,$business_id);
        $today = $this->client('today',$request->startDate,$request->endDate,$business_id);
        if($request->type == 'excel'){
            return Excel::download(new ExportClient($clients,$thirtydays,$ninetydays,$today), 'InActiveClients.xlsx');
        }elseif($request->type == 'pdf'){
            ini_set('memory_limit', '-1');
            ini_set("max_execution_time", "3600");

            GeneratePdf::dispatch($clients);

            /*$data = [
                'title' => 'InActive Clients Report',
                'clients'=>$clients,
                'clientType'=>'inactive',
            ];
            $pdf = PDF::loadView('business.reports.client.pdf_view_new_client', $data);*/

            /*$chunkSize = 100; // Adjust based on your needs
            $pdf = PDF::loadView('business.reports.client.pdf_view_new_client');
            $pdf->setPaper('A4', 'landscape'); 
            $clients->chunk($chunkSize, function ($clients) use ($pdf) {
                print_r($clients);exit;
                // Pass the current chunk of records to the view
                $data = [
                        'title' => 'InActive Clients Report',
                        'clientType'=>'inactive',
                        'clients' => $records,
                    ];

                // Append a new page with the current chunk of records to the PDF
                $pdf->getDomPDF()->getCanvas()->page_script(function ($pageNumber, $pageCount, $pdf) use ($data) {
                    view()->share($data);
                });

                $pdf->addPage();
            });

            // Save or output the final PDF
            $filename = "InActiveClients.pdf";
            $pdf->save(storage_path('app/'.$filename));*/

            //return $pdf->download('InActiveClients.pdf');
             //return response()->download(storage_path('pdf/filename.pdf'));
            return redirect()->route('business.check-pdf-status');
        }
    }
    
    public function checkPdfStatus($business_id)
    {
        $pdfFilePath = storage_path('app/public/pdf/filename.pdf');

        if (file_exists($pdfFilePath)) {
            return response()->download($pdfFilePath);
        } else {
            return "PDF is still being generated. Please wait.";
        }
    }

    public function newClient(Request $request,$business_id){
        $filterStartDate = $request->startDate != '' ? Carbon::parse($request->startDate) : Carbon::parse($this->firstDate);
        $filterEndDate = $request->endDate !=  '' ? Carbon::parse($request->endDate) : Carbon::parse($this->endDate);

        $clients = Customer::where(['business_id'=> $business_id])->orderBy('created_at','desc')->whereDate('created_at', '>=', $filterStartDate)->whereDate('created_at', '<=', $filterEndDate);
         $sortedDates = $this->getDatesArray($request->startDate , $filterStartDate, $filterEndDate);
        return view('business.reports.client.new_client',compact('clients','filterStartDate','filterEndDate','sortedDates'));
    }

    public function clientbirthday(Request $request,$business_id){
        $filterStartDate = $request->startDate != '' ? Carbon::parse($request->startDate) : Carbon::parse($this->firstDate);
        $filterEndDate = $request->endDate !=  '' ? Carbon::parse($request->endDate) : Carbon::parse($this->endDate);

        $starMonth = $filterStartDate->month;
        $endMonth = $filterStartDate->month;

        $clients = Customer::where(['business_id'=> $business_id])->orderBy('created_at','desc')->whereMonth('birthdate', '>=', $starMonth)->whereMonth('birthdate', '<=', $endMonth);

        $sortedDates = $this->getDatesArray($request->startDate , $filterStartDate, $filterEndDate);
        return view('business.reports.client.client_birthday',compact('clients','filterStartDate','filterEndDate','sortedDates'));
    }   

    public function cancellationNoShow(Request $request,$business_id){
        $endDate = new DateTime(date("Y-m-d"));
        $firstDate = new DateTime(date('Y-m-01'));
        return view('business.reports.client.cancellations_no_show',compact('endDate','firstDate'));
    }   

    public function getData($type,$business_id,$endDate,$startDate){
        if($type == 'NoShow'){
            $bookings = BookingCheckinDetails::join('user_booking_details as ubd','booking_checkin_details.booking_detail_id','=', 'ubd.id')->where('ubd.business_id' ,$business_id)->whereDate('booking_checkin_details.checkin_date', '>=', $startDate)->whereDate('booking_checkin_details.checkin_date', '<', $endDate)->orderBy('booking_checkin_details.checkin_date','desc')->select('booking_checkin_details.*');
        }else{
            $bookings = BookingCheckinDetails::join('user_booking_details as ubd','booking_checkin_details.booking_detail_id','=', 'ubd.id')->where('ubd.business_id' ,$business_id)->whereDate('booking_checkin_details.checkin_date', '>=', $startDate)->whereDate('booking_checkin_details.checkin_date', '<', $endDate)->orderBy('booking_checkin_details.checkin_date','desc')->whereNotNull('no_show_action')->select('booking_checkin_details.*');
        }
        return $bookings;
    }

    public function getCancellationNoShowData(Request $request,$business_id){
        $type = $request->type;
        $bookings = $this->getData($type,$business_id,$request->endDate,$request->startDate)->get();
        if($request->limit == ''){
            $bookings = $bookings->take(10);
        }
        //print_r($bookings);exit;
        return view('business.reports.client.cancellation_table_data',compact('bookings','type','business_id'));
    }

    public function getMoreCancellationNoShowData(Request $request,$business_id)
    {
        $type = $request->type;
        $bookings = $this->getData($type,$business_id,$request->endDate,$request->startDate)->get();
        $offset = $request->get('offset', 0); 
        $limit = 10; 
        $bookings = $bookings->take($offset);
        return view('business.reports.client.cancellation_table_data',compact('bookings','type','business_id'));
    }

    public function cancellationExport(Request $request,$business_id){
        $noShow = $this->getData('NoShow',$business_id,$request->endDate,$request->startDate)->get();
        $cancel = $this->getData('Cancellation',$business_id,$request->endDate,$request->startDate)->get();
        if($request->type == 'excel'){
            return Excel::download(new ExportCancellationNoShow($noShow ,$cancel), 'Cancellation-NoShow.xlsx');
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
                'noShow'=>$noShow,
                'dates' => $dates,
                'cancel'=>$cancel,
            ];
            $pdf = PDF::loadView('business.reports.client.cancellation_pdf_view', $data);
            return $pdf->download('Cancellation-NoShow.pdf');
        }
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