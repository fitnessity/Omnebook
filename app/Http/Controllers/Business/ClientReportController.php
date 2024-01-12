<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use Auth,DateTime,Carbon\Carbon;
use App\{Exports\ExportCancellationNoShow,Customer,BookingCheckinDetails};
use Maatwebsite\Excel\HeadingRowImport;
use Excel, Response,\PDF;

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
        $filterStartDate = $request->startDate != '' ? Carbon::parse($request->startDate) : Carbon::parse($date);
        $filterEndDate = $request->endDate !=  '' ? Carbon::parse($request->endDate) : Carbon::parse($date);
        $sortedDates = $this->getDatesArray($request->startDate , $filterStartDate, $filterEndDate);
        $clients = Customer::where(['business_id'=> $business_id])->get();
        return view('business.reports.client.index',compact('clients','filterStartDate','filterEndDate','sortedDates','date'));
    }

    public function clients($days,$edate,$sDate, $business_id){

        $booking = Customer::where(['business_id'=> $business_id])->get();

        if($days == 'all') {
            if($edate != '' && $edate < date('Y-m-d')){
                $enddate = $edate;
            }else{
                $enddate = date('Y-m-d');
            }
            $clients = $booking->whereDate('expired_at', '<',$enddate);
        }

        /*else if($days == 'today'){
            if($edate != '' && $edate == date('Y-m-d')){
                $enddate = $edate;
            }else{
                $enddate = date('Y-m-d');
            }
            $clients = $booking->whereDate('expired_at', '=',$enddate);
        }else{
            if($edate != ''){
                $enddate = $edate;
            }else{
                $enddate = date('Y-m-d', strtotime("+".$days." days"));
            }
            $clients = $booking->whereDate('expired_at', '<=',$enddate);
        }
        
        if($sDate != ''){
            $clients = $clients->whereDate('expired_at', '>=', $sDate);
        }elseif($days != 'all'){
            $clients = $clients->whereDate('expired_at', '>=', date('Y-m-d'));
        }*/
        
        return  $clients;
    }


    public function getInactiveClients(Request $request , $business_id){
        //print_r($request->all());exit;
        $type = $request->days;

        $expiringclients = Customer::where(['business_id'=> $business_id])->get();
        $clients = $expiringclients->filter(function ($item) use($request){
            return $item->is_active($request->type,$request->startDate, $request->endDate) == 0;
        });
        if($request->limit == ''){
            $clients = $clients->take(10);
        }
        return view('business.reports.client.table_data',compact('clients','type'));
    }

    public function getMoreInactiveClients(Request $request , $business_id)
    {
        $type = $request->days;
        $expiringclients = Customer::where(['business_id'=> $business_id])->get();
        $offset = $request->get('offset', 0); // Offset for pagination, passed from the frontend
        $limit = 10; // Number of records to load per request
      
        $clients = $expiringclients->filter(function ($item) use($request){
            return $item->is_active($request->type,$request->startDate, $request->endDate) == 0;
        });
        $clients = $clients->take($offset);
        return view('business.reports.client.table_data',compact('clients','type'));
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
            $bookings = BookingCheckinDetails::join('user_booking_details as ubd','booking_checkin_details.booking_detail_id','=', 'ubd.id')->where('ubd.business_id' ,$business_id)->whereDate('booking_checkin_details.checkin_date', '>=', $startDate)->whereDate('booking_checkin_details.checkin_date', '<', $endDate)->orderBy('booking_checkin_details.checkin_date','desc');
        }else{
            $bookings = BookingCheckinDetails::join('user_booking_details as ubd','booking_checkin_details.booking_detail_id','=', 'ubd.id')->where('ubd.business_id' ,$business_id)->whereDate('booking_checkin_details.checkin_date', '>=', $startDate)->whereDate('booking_checkin_details.checkin_date', '<', $endDate)->orderBy('booking_checkin_details.checkin_date','desc')->whereNotNull('no_show_action');
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