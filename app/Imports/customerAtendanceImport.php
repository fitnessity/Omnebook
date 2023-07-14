<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\{Customer,BusinessPriceDetails,BusinessPriceDetailsAges,UserBookingStatus,Transaction,UserBookingDetail,BookingCheckinDetails};

class customerAtendanceImport implements ToCollection
{
    /**
    * @param Collection $collection
    */

    public function  __construct($business_id)
    {
        $this->business_id= $business_id;
    }

    public function collection(Collection $rows)
    {
        $rows = $rows->toArray();
        foreach ($rows as $key=>$row) {
            $customerData = $string = $content = $content1 = '';$nameary = [];
            $string = htmlentities($row[3], null, 'utf-8');
            $content1 = str_replace("&nbsp;", "", $string);
            $content1 = str_replace(" ", "", $content1);
            $content = html_entity_decode($content1);
            $name = explode(',',$content);
           
            $customerData = Customer::where(['fname'=> @$name[1] , 'lname'=> @$name[0], 'business_id' => $this->business_id])->first();
            if($customerData != ''){
                $priceDetail = '';
                $priceDetailsData = BusinessPriceDetails::where('cid',$this->business_id)->get();
                $title = htmlentities($row[7], null, 'utf-8');
                $price_title = str_replace("&nbsp;", "", $title);
                $price_title = html_entity_decode($price_title);

                foreach($priceDetailsData as $pd){
                    $price_title = str_replace(" ", "", $price_title);
                    $price_titleDb = str_replace(" ", "", $pd->price_title);
                   
                    if($price_titleDb == $price_title){
                        $priceDetail = $pd;
                    }
                }
               
                if($priceDetail != ''){
                    $exDate = explode('/',$row[8]);
                    $checkinDate = explode('/',$row[0]);
                    $expired_at = @$exDate[2].'-'.@$exDate[0].'-'.@$exDate[1]; 
                    $chkDate = @$checkinDate[2].'-'.@$checkinDate[0].'-'.@$checkinDate[1]; 
                    $bookingDetail = UserBookingDetail::where(['user_id' => $customerData->id ,'priceid' => $priceDetail->id])->whereDate('expired_at','=',$expired_at)->first();
                    //echo $bookingDetail;
                    if($bookingDetail != ''){
                        $scheduleInfo = '';
                        $schedules = $priceDetail->business_price_details_ages->BusinessActivityScheduler;
                        foreach($schedules as $schedule){
                            $time = date('g:i a', strtotime($row[2]));
                            if(str_replace(" ", "", $time) == str_replace(" ", "", $row[2])){
                                $scheduleInfo = $schedule;
                            }
                        }
                        $chkInDetail = BookingCheckinDetails::where(['customer_id'=> $customerData->id,'booking_detail_id'=>$bookingDetail->id])->whereDate('checked_at','=',$chkDate)->first();
                        $ary = array(
                            'business_activity_scheduler_id' => @$scheduleInfo->id,
                            'customer_id' => $customerData->id,
                            'booking_detail_id' => $bookingDetail->id,
                            'checkin_date' => $chkDate,
                            'checked_at' => $chkDate,
                            'use_session_amount' => 1,
                            'after_use_session_amount' =>$row[9],
                            'source_type' => 'in_person',
                        );
                        if($bookingDetail->act_schedule_id == ''){
                            $bookingDetail->update(['bookedtime'=>$chkDate ,'act_schedule_id'=>@$scheduleInfo->id]);
                        }
                        
                        if($chkInDetail == ''){
                            BookingCheckinDetails::create($ary);
                        }else {
                            BookingCheckinDetails::where('id',$chkInDetail->id)->update($ary);
                        }
                    }
                }
            }
        }
        return;
    }
}
