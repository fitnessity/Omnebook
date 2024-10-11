<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use Illuminate\Http\Request;
use Auth,DateTime,Carbon\Carbon,Excel,Response,\PDF;
use App\{UserBookingDetail,BusinessPriceDetails,Products};
use App\Exports\ExportMembershipRevenue;
use Maatwebsite\Excel\HeadingRowImport;


class MembershipRevenueReportController extends BusinessBaseController
{

     public function products($sDate,$eDate,$business_id){
          return  Products::join('user_booking_details as bd', function($join) {
              $join->on(\DB::raw('FIND_IN_SET(products.id, bd.productIds)'), '>', \DB::raw('0'));
          })->where('bd.business_id', $business_id)->whereDate('bd.created_at', '>=', $sDate)->whereDate('bd.created_at', '<=', $eDate)->groupBy('products.id')->select('products.*')->get();
     }

     public function memberships($sDate,$eDate,$business_id){
          return BusinessPriceDetails::join('user_booking_details as bd' ,'bd.priceid' ,'=','business_price_details.id')->where('bd.business_id',$business_id)->whereDate('bd.created_at','>=',$sDate)->whereDate('bd.created_at','<=',$eDate)->orderBy('bd.membership_for')->groupBy('business_price_details.id')->select('business_price_details.*')->get();
     }

     public function recurringMemberships($sDate,$eDate,$business_id){
          $recurringBooking = UserBookingDetail::join('recurring as re' ,'re.booking_detail_id' ,'=','user_booking_details.id')->where('user_booking_details.business_id',$business_id)->where('re.payment_number',NULL)->where('re.status','Completed')->whereDate('re.payment_on','>=',$sDate)->whereDate('re.payment_on','<=',$eDate)->orderBy('user_booking_details.membership_for')->groupBy('user_booking_details.priceid')->pluck('user_booking_details.priceid')->toArray();

          return BusinessPriceDetails::whereIn('id', $recurringBooking)->get(); 

     }

     public function index(Request $request ,$business_id)
     {
          //print_r($request->all());exit;
          $singlePmt = $adultRevenue = $childRevenue = $infantRevenue = $grandTotal = $recurring = $productRevenue = $recurringPmt= 0;
          $filterOptions = $request->filterOptions;
          $filterStartDate = $request->startDate != '' ? Carbon::parse($request->startDate) : Carbon::parse(date('Y-m-01'));
          $filterEndDate = $request->endDate !=  '' ? Carbon::parse($request->endDate) : Carbon::parse(date('Y-m-d'));

          $compareStartDt = $request->startDate != '' ? Carbon::parse($filterStartDate) : Carbon::parse(date('Y-m-01'));
          $dates = $reportData = [];

          while ($compareStartDt <= $filterEndDate) {
              $dates[] = $compareStartDt->copy(); 
              $compareStartDt->addDay();
          }

          $sortedDates = array_reverse($dates);

          $memberships = $this->memberships($filterStartDate,$filterEndDate,$business_id);
          $recurringMemberships = $this->recurringMemberships($filterStartDate,$filterEndDate,$business_id);
          $products = $this->products($filterStartDate,$filterEndDate,$business_id);

          //$memberships = $memberships->union($recurringMemberships)->get();

    	     return view('business.reports.membership_revenue.index',compact('business_id','filterStartDate','filterEndDate','sortedDates','filterOptions','memberships','products','singlePmt','adultRevenue','childRevenue','infantRevenue','grandTotal','recurring','productRevenue','recurringMemberships','recurringPmt'));
     }

     public function export($business_id,Request $request){
          $type = $request->type;
          $memberships = $this->memberships($request->startDate,$request->endDate,$business_id);
          $recurringMemberships = $this->recurringMemberships($request->startDate,$request->endDate,$business_id);
          $products = $this->products($request->startDate,$request->endDate,$business_id);

          if($type == 'excel'){
               return Excel::download(new ExportMembershipRevenue($memberships, $recurringMemberships,$products,$business_id,$request->startDate,$request->endDate), 'Membership-Revenue.xlsx');
          }elseif($type == 'pdf'){
               if($request->endDate != $request->startDate){
                    $ed = new DateTime($request->endDate);
                    $sd = new DateTime($request->startDate);
                    $dates = $sd->format('l, F j, Y').' to '.$ed->format('l, F j, Y');
               }else{
                    $ed = new DateTime();
                    $dates = $ed->format('l, F j, Y');                
               }   
               $data = [
                    'title' => 'Sales Report',
                    'dates' => $dates,
                    'memberships' => $memberships,
                    'recurringMemberships' => $recurringMemberships,
                    'products' => $products,
                    'business_id' => $business_id,
                    'filterStartDate' => $request->startDate,
                    'filterEndDate' => $request->endDate,
               ];
               $pdf = PDF::loadView('business.reports.membership_revenue.pdf_view', $data);
               return $pdf->download('Membership-Revenue.pdf');
          }
     }
}