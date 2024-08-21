<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Imports\customerAtendanceImport;
use Maatwebsite\Excel\Facades\Excel;
use App\{Customer,BusinessPriceDetails,BusinessPriceDetailsAges,UserBookingStatus,Transaction,UserBookingDetail,BookingCheckinDetails};
use Carbon\Carbon;

class ProcessAttendanceExcelData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $business_id;
    protected $data;
    public function __construct($business_id,$data)
    {
        $this->business_id = $business_id;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //print_r($this->data);exit;
        for ($i=1; $i < count($this->data); $i++){
           
            $customerData = $string = $content = $content1 = '';$nameary = [];
            $string = htmlentities($this->data[$i]['client'], null, 'utf-8');
            $content1 = str_replace("&nbsp;", "", $string);
            $content1 = str_replace(" ", "", $content1);
            $content = html_entity_decode($content1);
            $name = explode(',',$content);

            $customerData = Customer::whereRaw('LOWER(lname) = ? AND LOWER(fname) = ? AND business_id= ? ', [strtolower(@$name[0]), strtolower(@$name[1]),$this->business_id])->first();
            //echo $customerData;
            if($customerData != ''){

                $priceDetailsData = BusinessPriceDetails::where('cid', $this->business_id)->get();
                $title = str_replace("&nbsp;", "", htmlentities($this->data[$i]['pricing_option'], null, 'utf-8'));
                $title = html_entity_decode($title);
                $priceDetail = $priceDetailsData->first(function ($pd) use ($title) {
                    return str_replace(" ", "", $pd->price_title) === str_replace(" ", "", $title);
                });

                //echo $priceDetail;
                if($priceDetail != ''  && $this->data[$i]['exp_date'] != '' && $this->data[$i]['date'] != ''){

                    //$expired_at = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($this->data[$i]['exp_date']));

                    //$chkDate = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($this->data[$i]['date']));

                    $exDate = explode('/',$this->data[$i]['exp_date']);
                    $checkinDate = explode('/',$this->data[$i]['date']);

                    $expired_at = @$exDate[2].'-'.@$exDate[0].'-'.@$exDate[1]; 
                    $chkDate = @$checkinDate[2].'-'.@$checkinDate[0].'-'.@$checkinDate[1]; 

                    $bookingDetail = UserBookingDetail::where([
                            'user_id' => $customerData->id ,
                            'priceid' => $priceDetail->id,
                        ])->whereDate('expired_at','=',$expired_at)->first();

                    if($bookingDetail != ''){
                        $exceltime = date('H:i', strtotime($this->data[$i]['time']));
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
                            'after_use_session_amount' =>$this->data[$i]['visits_rem'],
                            'source_type' => 'in_person',
                        );
                        if($bookingDetail->act_schedule_id == ''){
                            $bookingDetail->update(['bookedtime'=>$chkDate ,'act_schedule_id'=>@$scheduleInfo->id]);
                        }
                        
                        BookingCheckinDetails::updateOrCreate(['id' => @$chkInDetail->id], $ary);
                    }
                }
            }
            
        }
       /* Excel::import(new customerAtendanceImport($this->business_id),  $this->filename);*/
    }
}
