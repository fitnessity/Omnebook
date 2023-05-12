<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{BusinessCompanyDetail,BusinessActivityScheduler,UserBookingDetail,BookingPostorder, BusinessServices, BookingCheckinDetails,SGMailService};
use Auth;
use Carbon\Carbon;

class SchedulerCheckinDetailController extends BusinessBaseController
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request, $business_id, $scheduler_id)
  {
    $company = $request->current_company;
    $date = Carbon::parse($request->date);
    $business_activity_scheduler = $company->business_activity_schedulers()->findOrFail($scheduler_id);
    $booking_checkin_details = BookingCheckinDetails::where('business_activity_scheduler_id', $scheduler_id)->where('checkin_date', $date->format('Y-m-d'))->get();

    $filter_date = $date;

    $pricrdropdown = BusinessServices::find($business_activity_scheduler->serviceid)->price_details;
    $bookingdata = UserBookingDetail::where('sport',$business_activity_scheduler->serviceid)->where('act_schedule_id',$scheduler_id)->where('bookedtime',date('Y-m-d'))->get();
    
    return view('business.scheduler_checkin_detail.index', [
        'booking_checkin_details' => $booking_checkin_details,
        'business_activity_scheduler' =>$business_activity_scheduler,
        'filter_date' => $filter_date,
        'bookingdata' => $bookingdata,
        'pricrdropdown' => $pricrdropdown,
    ]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request, $business_id, $scheduler_id)
  {
      $company = $request->current_company;
      $business_activity_scheduler = $company->business_activity_schedulers()->findOrFail($scheduler_id);
    
      BookingCheckinDetails::create(array_merge(
        $request->only(['customer_id', 'business_activity_scheduler_id', 'checkin_date']), 
        ['business_activity_scheduler_id' => $business_activity_scheduler->id,
         'use_session_amount' => 0, 'source_type' => 'in_person',]));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $business_id, $scheduler_id, $id)
  {
    $company = $request->current_company;
    $business_activity_scheduler = $company->business_activity_schedulers()->findOrFail($scheduler_id);
    $business_checkin_detail = BookingCheckinDetails::whereRaw('1=1');
    $overwrite = [];
    if($request->checked_at){
      $business_checkin_detail = $business_checkin_detail->whereNotNull('booking_detail_id');
      $overwrite['use_session_amount'] = 1;
      $overwrite['no_show_action'] = Null;
      $overwrite['no_show_charged'] = Null;
    }else{
      $overwrite['use_session_amount'] = 0;
    }
    $business_checkin_detail = $business_checkin_detail->findOrFail($id);


    if($request->no_show_action){
      $overwrite['no_show_charged'] = Null;
      $overwrite['use_session_amount'] = 0;
      $overwrite['booking_detail_id'] = $business_checkin_detail->booking_detail_id;
      $overwrite['checked_at'] = Null;
      
      switch ($request->no_show_action) {
          case 'nothing':
            break;
          case 'charge_fee':
            $overwrite['no_show_charged'] = $request->no_show_charged;
            break;
          case 'deduct':
            $overwrite['use_session_amount'] = 1;
            $overwrite['booking_detail_id'] = $request->booking_detail_id;
            break;
      }
    }

    $business_checkin_detail->update(array_merge($request->only(['checked_at', 'booking_detail_id', 'use_session_amount', 'no_show_action', 'no_show_charged']), $overwrite));

    if($request->checked_at){
        $userbookingdetail = UserBookingDetail::find($business_checkin_detail->booking_detail_id);
        $customer =  $userbookingdetail->Customer;
        $business_price_detail =  $userbookingdetail->business_price_detail;
        $business_price_details_ages =  $business_price_detail->business_price_details_ages;
        $reminingSession = $userbookingdetail->getremainingsession();
        if($reminingSession == 0){
            $email_detail_customer = array(
                "email" =>$customer->email, 
                "CustomerName" => $customer->full_name, 
                "ReNewUrl" => env('APP_URL').'/activity-details/'.$userbookingdetail->sport, 
                "ProfileUrl" => env('APP_URL').'/profile/viewProfile', 
                "ProviderName"=> $company->dba_business_name,
                "CategoryName"=> $business_price_details_ages->category_title,
                "PriceOptionName"=> @$business_price_detail->price_title,
                "CompleteDate"=> date('m-d-Y'),
                "ExpirationDate"=> date('m-d-Y' ,strtotime($userbookingdetail->expired_at)),
                "ProviderPhoneNumber"=> $company->business_phone,
                "ProviderEmail"=> $company->business_email,
                "ProviderAddress"=> $company->company_address());

            $email_detail_provider = array(
                "email" => $company->business_email, 
                "CustomerName" => $customer->full_name, 
                "ProviderName"=> $company->dba_business_name,
                "CategoryName"=> $business_price_details_ages->category_title,
                "PriceOptionName"=> @$business_price_detail->price_title );

            SGMailService::sendReminderOfSessionExpireToCustomer($email_detail_customer);
            SGMailService::sendReminderOfSessionExpireToProvider($email_detail_provider);
        }
    }

    if (!$request->ajax()) {
      return redirect()->route('business.schedulers.checkin_details.index',[
        'scheduler'=>$business_checkin_detail->business_activity_scheduler_id, 
        'date' =>$business_checkin_detail->checkin_date
      ]);
    }
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request, $business_id, $scheduler_id, $id)
  {
    $company = $request->current_company;
    $business_activity_scheduler = $company->business_activity_schedulers()->findOrFail($scheduler_id);
    $business_checkin_detail = BookingCheckinDetails::findOrFail($id);
    $business_checkin_detail->delete();
  }

  public function latecancel_modal(Request $request, $business_id, $scheduler_id, $id){
    $company = $request->current_company;
    $business_activity_scheduler = $company->business_activity_schedulers()->findOrFail($scheduler_id);
    $booking_checkin_detail = BookingCheckinDetails::where('business_activity_scheduler_id', $business_activity_scheduler->id)->findOrFail($id);

    return view('business.scheduler_checkin_detail.latecancel_edit', compact('booking_checkin_detail'));
  }
}
