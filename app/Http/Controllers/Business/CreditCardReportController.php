<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use Response,Auth,DB,DateTime,\PDF,Excel;
use App\{StripePaymentMethod,Exports\ExportCreditCards};

class CreditCardReportController extends BusinessBaseController
{
	public function index(Request $request ,$business_id)
    {
    	$today = new DateTime();
    	return view('business.reports.credit_cards.index',compact('today'));
    }

    public function getCards(Request $request ,$business_id){
    	$type = $request->days;
    	$expiringCards = $this->cards($type,$request->endDate,$request->startDate,$business_id);

    	$expiringCards = $expiringCards->orderby('exp_year','desc')->get();

    	if($request->limit == ''){
            $cards = $expiringCards->take(10);
        }
        return view('business.reports.credit_cards.table_data',compact('cards','type','business_id'));
    }

    public function cards($days,$edate,$sDate,$business_id){
    	$cardsDetails = StripePaymentMethod::select('stripe_payment_methods.*')->join('customers','stripe_payment_methods.user_id' ,'=', 'customers.id')->where('customers.business_id',$business_id);
    	
    	if($days == 'today'){
            if($edate != '' && $edate == date('Y-m-d')){
            	$formattedDate = date('Y-m', strtotime($edate));
            }else{
                $enddate = date('Y-m-d');
                $formattedDate = date('Y-m', strtotime($enddate));
            }
            $cardsquery = $cardsDetails->where(DB::raw("CONCAT(exp_year, '-', LPAD(exp_month, 2, '0'))"), $formattedDate);
        }else{
            if($edate != ''){
            	$formattedDate = date('Y-m', strtotime($edate));
            }else{
                $enddate = date('Y-m-d', strtotime("+".$days." days"));
                $formattedDate = date('Y-m', strtotime($enddate));
            }
          	
            $cardsquery = $cardsDetails->where(DB::raw("CONCAT(exp_year, '-', LPAD(exp_month, 2, '0'))"), '<=', $formattedDate);
    	}
    	
        if($sDate != ''){
        	$formattedDate = date('Y-m', strtotime($sDate));
     	}else{
            $formattedDate = date('Y-m', strtotime(date('Y-m-d')));
        }

        $cardsquery = $cardsDetails->where(DB::raw("CONCAT(exp_year, '-', LPAD(exp_month, 2, '0'))"), '>=', $formattedDate); 
	    return  $cardsquery;
    }

    public function getMoreCards(Request $request,$business_id){
    	$type = $request->days;
		$expiringcards = $this->cards($type,$request->endDate,$request->startDate,$business_id);
        $offset = $request->get('offset', 0); // Offset for pagination, passed from the frontend
        $limit = 10; // Number of records to load per request
      
        $expiringcards = $expiringcards->orderby('exp_year','desc')->get();
        $cards = $expiringcards->take($offset);
    	return view('business.reports.credit_cards.table_data',compact('cards','type','business_id'));
    }

    public function export(Request $request,$business_id){
        $expiringCards = $this->cards('all',$request->endDate,$request->startDate,$business_id)->orderby('exp_year','desc')->get();
        if($request->type == 'excel'){
            return Excel::download(new ExportCreditCards($expiringCards), 'Credit-Card.xlsx');
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
                'expiringCards'=>$expiringCards,
                'dates'=>$dates
            ];
            $pdf = PDF::loadView('business.reports.credit_cards.pdf_view', $data);
            return $pdf->download('Credit-Card.pdf');
        }
    }
}