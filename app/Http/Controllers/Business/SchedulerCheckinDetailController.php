<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{BusinessCompanyDetail,BusinessActivityScheduler,UserBookingDetail,BookingPostorder, BusinessServices, BookingCheckinDetails};
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


    $filter_date = Carbon::now();




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
         'use_session_amount' => 0,
         'before_use_session_amount' => 0,
         'after_use_session_amount' => 0]));
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
    //print_r($request->all());exit;
    $company = $request->current_company;
    $business_activity_scheduler = $company->business_activity_schedulers()->findOrFail($scheduler_id);
    $business_checkin_detail = BookingCheckinDetails::findOrFail($id);
    $business_checkin_detail->update($request->only(['checked_at', 'booking_detail_id']));
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
}
