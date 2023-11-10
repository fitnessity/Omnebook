<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use Response;
use Auth;
use DB;
use DateTime;
use App\StripePaymentMethod;

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
            $cardsquery = $cardsDetails->where(DB::raw("CONCAT(exp_year, '-', LPAD(exp_month, 2, '0'))"), $dynamicDate);
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
       
            $cardsquery = $cardsDetails->where(DB::raw("CONCAT(exp_year, '-', LPAD(exp_month, 2, '0'))"), '>=', $formattedDate); 
     	}
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
}