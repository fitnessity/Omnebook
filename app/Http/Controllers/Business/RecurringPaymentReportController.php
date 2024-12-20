<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use Response,Auth,DB,DateTime;
use App\{StripePaymentMethod,Recurring,Exports\ExportRecurringDetails};
use PDF;
use Excel;

class RecurringPaymentReportController extends BusinessBaseController
{

    public function __construct()
    {  
        $this->endDate = date("Y-m-t");
        $this->firstDate = date('Y-m-01');
        $this->currentDate = date('Y-m-d');
    }

	public function index(Request $request,$business_id)
    {
    	$today = new DateTime();
    	return view('business.reports.recurring.index',compact('today'));
    }

    public function membership($type,$endDate,$startDate,$business_id,$status,$columns){
        return Recurring::where('business_id',$business_id)->where('payment_number',NULL)->whereDate($columns,'>=', $startDate)->whereDate($columns,'<=', $endDate)
            ->when($status,function($query) use($status){
                $query->whereIn('status',$status);
            });
    }

    public function getDetail($type,$endDate,$startDate,$business_id){
        if($type == 'Upcoming'){
            if(($endDate == '' && $startDate == '') ||  ($endDate == $this->currentDate && $startDate == $this->currentDate) ){
                $endDate = $this->endDate;
                $startDate = $this->currentDate;
            }
            $data = $this->membership($type,$endDate,$startDate,$business_id,['Scheduled'],'payment_date');
        }elseif ($type == 'onToday') {
            $column = 'payment_on';
            if($endDate == '' && $startDate == ''){
                $endDate = $startDate  = $this->currentDate;
                $column = 'payment_date';
            }
            $data = $this->membership($type,$endDate,$startDate,$business_id,['Completed'],$column);
        }elseif ($type == 'FailedPayment') {
            if($endDate == '' && $startDate == ''){
                $endDate = $startDate  = $this->currentDate;
            }
            $data = $this->membership($type,$endDate,$startDate,$business_id,['Retry','Failed'],'payment_date');
        }elseif ($type == 'All') {
            if($endDate == '' && $startDate == ''){
                $endDate = $startDate  = $this->currentDate;
            }

            $dataRemaing = $this->membership($type,$endDate,$startDate,$business_id,['Retry','Scheduled','Failed'],'payment_date');
            $dataComp = $this->membership($type,$endDate,$startDate,$business_id,['Completed'],'payment_on');
            $data = $dataRemaing->union($dataComp);

        }else {
            if(($endDate == '' && $startDate == '') ||  ($endDate == $this->currentDate && $startDate == $this->currentDate)){
                $endDate = $this->endDate;
                $startDate = $this->firstDate;
            }
            $data = $this->membership($type,$endDate,$startDate,$business_id,['Retry','Failed'],'payment_date')->join('booking_checkin_details as cid','cid.booking_detail_id' ,'=','recurring.booking_detail_id')->whereDate('cid.checkin_date','>=' ,$startDate)->whereDate('cid.checkin_date','<=' ,$endDate)->whereNotNull('cid.checked_at');
        }
        $data =$data->orderBy('payment_date' ,'desc')->get()->filter(function ($item) {
            return $item->customer_name;
        });
        return $data;

    }

    public function getMemberships(Request $request,$business_id){
        $type = $request->type;
        $data = $this->getDetail($type,$request->endDate,$request->startDate,$business_id);
        if($request->limit == ''){
            $data = $data->take(10);
        }
        return view('business.reports.recurring.table_data',compact('data','type','business_id'));
    }

    public function getMoreMemberships(Request $request,$business_id)
    {
        $type = $request->type;
        $data = $this->getDetail($type,$request->endDate,$request->startDate,$business_id);
        $offset = $request->get('offset', 0);
        $limit = 10; 
        $data = $data->take($offset);
        return view('business.reports.recurring.table_data',compact('data','type'));
    }

    public function export(Request $request ,$business_id){
        $type = $request->type;

        $upcoming = $this->getDetail('Upcoming',$request->endDate,$request->startDate,$business_id);
        $sucessfull = $this->getDetail('onToday',$request->endDate,$request->startDate,$business_id);
        $failed = $this->getDetail('FailedPayment',$request->endDate,$request->startDate,$business_id);
        $all = $this->getDetail('All',$request->endDate,$request->startDate,$business_id);
        $reminingMoney = $this->getDetail('',$request->endDate,$request->startDate,$business_id);

        if($type == 'excel'){
            return Excel::download(new ExportRecurringDetails($upcoming,$sucessfull,$failed,$all,$reminingMoney),'RecurrinPaymentDetails.xlsx');
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
                'title' => 'Membership Details',
                'dates' => $dates,
                'upcoming' => $upcoming ,
                'sucessfull' => $sucessfull,
                'failed' =>$failed ,
                'all' => $all,
                'reminingMoney' =>$reminingMoney,
                'business_id' =>$business_id,
            ];
            $pdf = PDF::loadView('business.reports.recurring.pdf_view', $data);
            return $pdf->download('RecurrinPaymentDetails.pdf');
        }
    
    }
}