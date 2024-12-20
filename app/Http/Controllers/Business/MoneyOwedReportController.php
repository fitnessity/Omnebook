<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use Response,Auth,DB,DateTime,Carbon\Carbon;
use App\{StripePaymentMethod,Recurring,Exports\ExportMoneyOwedDetails,Transaction};
use PDF;
use Excel;

class MoneyOwedReportController extends BusinessBaseController
{

    public function __construct()
    {  
        $this->endDate = date("Y-m-t");
        $this->firstDate = date('Y-m-01');
        $this->currentDate = date('Y-m-d');
    }

    public function index(Request $request,$business_id)
    {
        $endDate = Carbon::parse($this->endDate);
        $firstDate =  Carbon::parse($this->firstDate);
        return view('business.reports.money_owed.index',compact('endDate','firstDate'));
    }

    public function membership($type,$endDate,$startDate){
        return Transaction::whereDate('transaction.created_at','>=', $startDate)->whereDate('transaction.created_at','<=', $endDate)->where('transaction.status','!=', 'complete');
    }


    public function getDetail($type,$endDate,$startDate,$business_id){
        if ($type == 'FailedPayment') {
            if($endDate == '' && $startDate == ''){
                $endDate = $startDate  = $this->currentDate;
            }
            $data = $this->membership($type,$endDate,$startDate)->where('item_type' ,'Recurring')->join('recurring as ubs','re.id' ,'=','transaction.item_id')->where('re.business_id',$business_id)->whereDate('re.payment_date','>=', $startDate)->whereDate('re.payment_date','<=', $endDate)->where('status','Retry')->select('transaction.*');
        }else if ($type == 'All') {
            if($endDate == '' && $startDate == ''){
                $endDate = $startDate  = $this->currentDate;
            }
            $data = $this->membership($type,$endDate,$startDate)->select('transaction.*');
        }else {
            if(($endDate == '' && $startDate == '') ||  ($endDate == $this->currentDate && $startDate == $this->currentDate)){
                $endDate = $this->endDate;
                $startDate = $this->firstDate;
            }
            $data = $this->membership($type,$endDate,$startDate)->where('item_type' ,'UserBookingStatus')->join('user_booking_status as ubs','ubs.id' ,'=','transaction.item_id')->join('user_booking_details as ubd','ubd.booking_id' ,'=','ubs.id')->where('ubd.business_id',$business_id)->join('booking_checkin_details as cid','cid.booking_detail_id' ,'=','ubd.id')->whereDate('cid.checkin_date','>=' ,$startDate)->whereDate('cid.checkin_date','<=' ,$endDate)->whereNotNull('cid.checked_at')->select('transaction.*', 'cid.checkin_date as checkin_date', 'cid.booking_detail_id as detail_id');
        }

        $data = $data->orderBy('transaction.created_at' ,'desc')->get()->filter(function ($item) use($business_id) {
            return $item->getCustomer($business_id);
        });

        return $data;
    }

    public function getMemberships(Request $request,$business_id){
        $type = $request->type;
        $data = $this->getDetail($type,$request->endDate,$request->startDate,$business_id);

        if($request->limit == ''){
            $data = $data->take(10);
        }
        return view('business.reports.money_owed.table_data',compact('data','type','business_id'));
    }

    public function getMoreMemberships(Request $request,$business_id)
    {
        $type = $request->type;
        $data = $this->getDetail($type,$request->endDate,$request->startDate,$business_id);
        $offset = $request->get('offset', 0);
        $limit = 10; 
        $data = $data->take($offset);
        return view('business.reports.money_owed.table_data',compact('data','type','business_id'));
    }

    public function export(Request $request ,$business_id){
        $type = $request->type;
        $all = $this->getDetail('All',$request->endDate,$request->startDate,$business_id);
        $reminingMoney = $this->getDetail('',$request->endDate,$request->startDate,$business_id);
    
        if($type == 'excel'){
            return Excel::download(new ExportMoneyOwedDetails($business_id,$all,$reminingMoney),'MoneyOwedDetail.xlsx');
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
                'title' => 'Money Owed Details',
                'dates' => $dates,
                'all' => $all,
                'reminingMoney' =>$reminingMoney,
                'business_id' =>$business_id,
            ];
            $pdf = PDF::loadView('business.reports.money_owed.pdf_view', $data);
            return $pdf->download('MoneyOwedDetail.pdf');
        }
    
    }
}