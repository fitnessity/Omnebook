<?php

namespace App\Http\Controllers\Business;
use App\Http\Controllers\Business\BusinessBaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{BusinessCompanyDetail,BusinessActivityScheduler,UserBookingDetail,BookingPostorder, BusinessServices, BookingCheckinDetails,SGMailService,Customer};
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
       
        $booking_checkin_details = BookingCheckinDetails::where('business_activity_scheduler_id', $scheduler_id)->where('checkin_date', $date->format('Y-m-d'))->when($request->customerId != '', function($query) use ($request) {
            return $query->where('customer_id', $request->customerId);
        });

        $filter_date = $date;
        $staffMember = $company->business_staff;
        $bookingdata = UserBookingDetail::where('sport',$business_activity_scheduler->serviceid)
            ->when($request->customerId != '', function($query) use ($request) {
                return $query->where('user_id', $request->customerId);
            })->where('act_schedule_id',$scheduler_id)->where('bookedtime',date('Y-m-d'))->get();
        $today = date('Y-m-d');

        //print_r($booking_checkin_details);exit;
    
        $customers = [];
        $customerIds = $booking_checkin_details->pluck('customer_id')->unique();
        foreach ($customerIds as $id) {
          $customer = Customer::find($id);
          $customers[] = $customer != '' ? $customer : '';
        }

        $chkInId = $request->chkInId ?? '';
        $chkCusId = $request->cus_id ?? '';
     
        $instructor_id = $booking_checkin_details->first() != '' ? $booking_checkin_details->first()->instructor_id : '';
        
        if($instructor_id == ''){
             $instructor_id = $business_activity_scheduler->getInstructureIds($filter_date->format('Y-m-d'));
        }
        // print_r($customers);exit;

        if($request->chk === '1'){
            session()->flash('success', 'Check in successful');
        }
        if($request->chk === '0'){
            session()->flash('error', 'Check Out successful');
        }
    
        if($request->chkInMsg == '2'){
            session()->flash('error', "There is no spot available so you can't checkIn in this class.");
        }

        return view('business.scheduler_checkin_detail.index', [
            'booking_checkin_details' => $booking_checkin_details,
            'business_activity_scheduler' =>$business_activity_scheduler,
            'filter_date' => $filter_date,
            'today' => $today,
            'bookingdata' => $bookingdata,
            'staffMember' => $staffMember,
            'instructor_id' => $instructor_id,
            'customers' => $customers,
            'chkInId' => $chkInId,
            'chkCusId' => $chkCusId,
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
        $customer = $company->customers()->findOrFail($request->customer_id);
        $business_activity_scheduler = $company->business_activity_schedulers()->findOrFail($scheduler_id);
        $bookingDetail = UserBookingDetail::where(['user_id' =>$request->customer_id])->whereDate('expired_at','>=',date('Y-m-d'))->get();
        $firstActiveMebership = $customer->active_memberships();
        $bookingId = NULL;
        foreach ($firstActiveMebership->get() as $key => $m) {
            if ($m->getremainingsession() > 0) {
                $bookingId = $m->id;
                break;
            }
        }

        $status = BookingCheckinDetails::create([
            'customer_id' => $customer->id,
            'checkin_date' => $request->checkin_date,
            'business_activity_scheduler_id' => $business_activity_scheduler->id,
            'source_type' => 'in_person',
            'use_session_amount' => 0,
            'booking_detail_id' =>  $bookingId,
        ]);

        return 1; 
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
        $business_checkin_detail = BookingCheckinDetails::whereRaw('1=1');
        $overwrite = []; $sendmail= 0; $membershipSessionOverAlert = 0; $sessionOvermessage = '';

        if($request->checked_at){
            $customerInClass = BookingCheckinDetails::checkCustomerInClass($scheduler_id,$request->checked_at);
           /* echo $customerInClass;
            exit();*/
           
            $checkin = BookingCheckinDetails::whereNotNull('booking_detail_id')->findOrFail($id);
            if($checkin){
                $overwrite['use_session_amount'] = 1;
                $overwrite['no_show_action'] = Null;
                $overwrite['no_show_charged'] = Null;
                
                if($customerInClass  <  $business_activity_scheduler->spots_available){
                    $checkin->update(array_merge($request->only(['checked_at', 'booking_detail_id', 'use_session_amount', 'no_show_action', 'no_show_charged']), $overwrite));
                    if($checkin->UserBookingDetail){
                        $totalSession = $checkin->UserBookingDetail->pay_session;
                        if($checkin->membership_checkin_count == 1 || $checkin->membership_checkin_count == $totalSession){
                            SGMailService::leaveAReview(['companyName' =>  $company->public_company_name,'cid' => $business_id ,'email' => $checkin->customer->email]);
                        }
                    }
                    $sendmail= 1;
                }else{
                    $sendmail= 2;
                }
            }
        }else{
            //echo "hii";exit;
            $bookingDetail = UserBookingDetail::findOrFail($request->booking_detail_id);
            $chkBookedSpot = $bookingDetail->getremainingsession();
            $checkin_detail = BookingCheckinDetails::findOrFail($id);
            if($chkBookedSpot > 0 ){
                //echo "hii";exit;
                $overwrite['use_session_amount'] = 0;
                $overwrite['checked_at'] = Null;
                $checkin_detail->update(array_merge($request->only(['checked_at', 'booking_detail_id', 'use_session_amount', 'no_show_action', 'no_show_charged']), $overwrite));
            }else{
               //echo "bcvcv";exit;
                $sendmail= 0;
                /*$bookedSpot = $bookingDetail->getWithoutAttendBookedSession();
                $usedSession = $bookingDetail->getUsedSession();*/
                $membershipSessionOverAlert = 1;

                /*$sessionOvermessage .= "You have total ".$bookingDetail->pay_session." Sessions and used ".$usedSession." Session. ";
                if($bookedSpot > 0){
                    $sessionOvermessage .= "Currently you have booked ".$bookedSpot." spots (for ".$bookedSpot." Sessions)  across different dates. ";
                }*/

                $sessionOvermessage .= "All sessions have been booked.";
                
                $checkin_detail->update(['checked_at' => NULL, 'booking_detail_id' => NULL, 'use_session_amount' => 0]);
            }
        }

        if($membershipSessionOverAlert == 1){
            return $sessionOvermessage;
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

            $business_checkin_detail->update(array_merge($request->only(['checked_at', 'booking_detail_id', 'use_session_amount', 'no_show_action', 'no_show_charged']), $overwrite));
        }

        if($request->checked_at){
            if($sendmail == 1){
                $userbookingdetail = UserBookingDetail::find($business_checkin_detail->booking_detail_id);
                $customer =  $userbookingdetail->Customer;
                $business_price_detail =  $userbookingdetail->business_price_detail_with_trashed;
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
        }

        // if (!$request->ajax()) {
        //   return redirect()->route('business.schedulers.checkin_details.index',[
        //     'scheduler'=>$business_checkin_detail->business_activity_scheduler_id, 
        //     'date' =>$business_checkin_detail->checkin_date
        //   ]);
        // }

        return $sendmail;
    }

      /**
       * Remove the specified resource from storage.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
    public function destroy(Request $request, $business_id, $scheduler_id, $id)
    {
        $idsArray = explode(',', $id);
        $company = $request->current_company;
        $business_activity_scheduler = $company->business_activity_schedulers()->findOrFail($scheduler_id);
        /*$business_checkin_detail = BookingCheckinDetails::whereIn('booking_detail_id', $idsArray)->whereDate('checkin_date', $request->date)->get();*/
        BookingCheckinDetails::whereIn('id', $idsArray)->whereDate('checkin_date', $request->date)->delete();
        //$business_checkin_detail->delete();
    }

    public function latecancel_modal(Request $request, $business_id, $scheduler_id, $id){
        $company = $request->current_company;
        $business_activity_scheduler = $company->business_activity_schedulers()->findOrFail($scheduler_id);
        $booking_checkin_detail = BookingCheckinDetails::where('business_activity_scheduler_id', $business_activity_scheduler->id)->findOrFail($id);

        return view('business.scheduler_checkin_detail.latecancel_edit', compact('booking_checkin_detail'));
    }


    public function changeInstructor(Request $request , $business_id, $scheduler_id){
        BookingCheckinDetails::where(['business_activity_scheduler_id'=> $scheduler_id, 'checkin_date' =>$request->date])->update(['instructor_id' => implode(',' , $request->insID)]);
    }
}
