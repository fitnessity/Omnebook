<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\{Customer,BusinessPriceDetails,BusinessPriceDetailsAges,UserBookingStatus,Transaction,UserBookingDetail,BookingCheckinDetails,ChkAttendance};

class customerAtendanceImport implements ToModel,ToCollection, WithChunkReading, WithHeadingRow
{
    /**
    * @param Collection $collection
    */

    /*public function  __construct($business_id)
    {
        $this->business_id= $business_id;
    }*/


    public function collection(Collection $rows)
    {
        /*$rows = $rows->toArray();
        foreach ($rows as $key=>$row) {

            $customerData = $string = $content = $content1 = '';$nameary = [];
            $string = htmlentities(@$row['client'], null, 'utf-8');
            $content1 = str_replace("&nbsp;", "", $string);
            $content1 = str_replace(" ", "", $content1);
            $content = html_entity_decode($content1);
            $name = explode(',',$content);
           
            $customerData = Customer::where(['fname'=> @$name[1] , 'lname'=> @$name[0], 'business_id' => $this->business_id])->first();
            //echo $customerData;
            if($customerData != ''){

                $priceDetailsData = BusinessPriceDetails::where('cid', $this->business_id)->get();
                $title = str_replace("&nbsp;", "", htmlentities($row['pricing_option'], null, 'utf-8'));
                $title = html_entity_decode($title);
                $priceDetail = $priceDetailsData->first(function ($pd) use ($title) {
                    return str_replace(" ", "", $pd->price_title) === str_replace(" ", "", $title);
                });

                //echo $priceDetail;
                if($priceDetail != ''){
                    $exDate = explode('/',$row['exp_date']);
                    $checkinDate = explode('/',$row['date']);
                    $expired_at = @$exDate[2].'-'.@$exDate[0].'-'.@$exDate[1]; 
                    $chkDate = @$checkinDate[2].'-'.@$checkinDate[0].'-'.@$checkinDate[1]; 
                    $bookingDetail = UserBookingDetail::where([
                            'user_id' => $customerData->id ,
                            'priceid' => $priceDetail->id,
                        ])->whereDate('expired_at','=',$expired_at)->first();

                    if($bookingDetail != ''){
                        $exceltime = date('H:i', strtotime($row['time']));
                        $scheduleInfo = $priceDetail->business_price_details_ages->BusinessActivityScheduler->first(function ($schedule) use ($exceltime){
                            return $exceltime == $schedule['shift_start'];
                        });

                        $chkInDetail = BookingCheckinDetails::where(['customer_id'=> $customerData->id,'booking_detail_id'=>$bookingDetail->id])->whereDate('checked_at','=',$chkDate)->first();
                        $schedule_id  = @$scheduleInfo->id ?? 0;
                        $ary = array(
                            'business_activity_scheduler_id' =>$schedule_id,
                            'customer_id' => $customerData->id,
                            'booking_detail_id' => $bookingDetail->id,
                            'checkin_date' => $chkDate,
                            'checked_at' => $chkDate,
                            'use_session_amount' => 1,
                            'after_use_session_amount' =>$row['visits_rem'],
                            'source_type' => 'in_person',
                        );
                        if($bookingDetail->act_schedule_id == ''){
                            $bookingDetail->update(['bookedtime'=>$chkDate ,'act_schedule_id'=>@$scheduleInfo->id]);
                        }
                        
                        BookingCheckinDetails::updateOrCreate(['id' => @$chkInDetail->id], $ary);
                    }
                }
            }
        }*/
        return;
    }

    public function model(array $row){
        return [
            'date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0])->format('Y-m-d'),
            'time' => $row[2],
            'client' => $row[4],
            'pricing_option' => $row[8],
            'exp_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[9])->format('Y-m-d'),
            'visits_rem' => $row[10],
        ];
    }

    public function chunkSize(): int
    {
        return 1000; // Set an appropriate chunk size based on your requirements
    }
}
