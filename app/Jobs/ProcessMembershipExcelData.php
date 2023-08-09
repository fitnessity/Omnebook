<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\{Customer,BusinessPriceDetails,UserBookingDetail,UserBookingStatus,Transaction,BookingCheckinDetails};
use Carbon\Carbon;
use Auth;
class ProcessMembershipExcelData implements ShouldQueue
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
        for ($i=1; $i < count($this->data); $i++){
            if($this->data[$i][0] != ''  && is_numeric($this->data[$i][3])){
                $member_from = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($this->data[$i][3]));

                $member_to = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($this->data[$i][4]));

                $customerData = $string = $content = $content1 = '';$nameary = [];
                $string = htmlentities($this->data[$i][0], null, 'utf-8');
                $content1 = str_replace("&nbsp;", "", $string);
                $content1 = str_replace(" ", "", $content1);
                $content = html_entity_decode($content1);
                $nameary = explode(',',$content);
                $customerData = Customer::where(['fname'=> @$nameary[1] , 'lname'=> @$nameary[0], 'business_id' => $this->business_id])->first();
                if($customerData != ''){

                    $priceDetailsData = BusinessPriceDetails::where('cid', $this->business_id)->get();
                    $title = str_replace("&nbsp;", "", htmlentities($this->data[$i][1], null, 'utf-8'));
                    $title = html_entity_decode($title);
                    $priceDetail = $priceDetailsData->first(function ($pd) use ($title) {
                        return str_replace(" ", "", $pd->price_title) === str_replace(" ", "", $title);
                    });

                    if($priceDetail != ''){ 
                        /*$exDate = explode('/',$member_from);
                        $conDate = explode('/',$);
                        $expired_at = @$exDate[2].'-'.@$exDate[0].'-'.@$exDate[1];
                        $contract_date = @$conDate[2].'-'.@$conDate[0].'-'.@$conDate[1];*/
                        $BookingDetail = UserBookingDetail::where(['user_id' => $customerData->id ,'priceid' => $priceDetail->id])->whereDate('expired_at','=',$member_to)->whereDate('contract_date','=',$member_from)->first();
                       
                        if($BookingDetail == ''){
                            $adultPrice = $priceDetail->adult_cus_weekly_price;
                            $childPrice = $priceDetail->child_cus_weekly_price;
                            $infantPrice = $priceDetail->infant_cus_weekly_price;

                            $adultWEPrice = $priceDetail->adult_weekend_price_diff;
                            $childWEPrice = $priceDetail->child_weekend_price_diff;
                            $infantWEPrice = $priceDetail->infant_weekend_price_diff;

                            $price =  $customerData->age > 18 ||  $customerData->age  == '' ? ( $adultPrice != '' ? $adultPrice : ( $adultWEPrice != '' ? $adultWEPrice : 0 ) ) : 0;
                            $qtychild = $qtyadult= $qtyinfant = $priadult= $prichild = $priinfant = 0;
                            if($price == 0){
                                $price =  $childPrice != '' ?  $childPrice : ( $childWEPrice != '' ? $childWEPrice : 0 );

                                if($price == 0){
                                    $price = $infantPrice != '' ? $infantPrice : ( $infantWEPrice != '' ? $infantWEPrice : 0 );
                                    $qtyinfant = $price == 0 ? 0 : 1;
                                    $priinfant = $price == 0 ? 0 : $price;
                                }else{
                                    $qtychild = $price == 0 ? 0 : 1;
                                    $prichild = $price == 0 ? 0 : $price;
                                }
                            }else{
                                $qtyadult = $price == 0 ? 0 : 1;
                                $priadult = $price == 0 ? 0 : $price;
                            }
                        
                            $qtyarray  = [ 'adult'=> $qtyadult, 'child'=> $qtychild, 'infant'=> $qtyinfant]; 
                            $pricearray = [ 'adult'=> $priadult, 'child'=> $prichild, 'infant'=>$priinfant];
                    
                            $orderdata = array(
                                'user_id' => Auth::user()->id,
                                'customer_id' => $customerData->id,
                                'user_type' => 'customer',
                                'status' => 'active',
                                'currency_code' => 'usd',
                                'amount' =>$price,
                                'order_type' => 'Excel Order',
                                'bookedtime' => Carbon::now()->format('Y-m-d')
                            );
                            $userBookingStatus = UserBookingStatus::create($orderdata);

                            $transactiondata = array( 
                                'user_type' => 'Customer',
                                'user_id' => $customerData->id,
                                'item_type' =>'UserBookingStatus',
                                'item_id' => $userBookingStatus->id,
                                'channel' =>'cash',
                                'kind' => 'Cash',
                                'transaction_id' => "CS_" . Carbon::now()->format('YmdHmsv'),
                                'stripe_payment_method_id' => '',
                                'amount' => $price,
                                'qty' =>'1',
                                'status' =>'processing',
                                'refund_amount' =>0,
                                'payload' =>'',
                            );

                            $transactionstatus = Transaction::create($transactiondata);

                            $booking_detail = UserBookingDetail::create([                 
                                'booking_id' => $userBookingStatus->id,
                                'sport' =>$priceDetail->BusinessServices->id,
                                'business_id'=> $this->business_id,
                                'price' => json_encode($pricearray),
                                'qty' => json_encode($qtyarray),
                                'priceid' => $priceDetail->id,
                                'pay_session' => $priceDetail->pay_session,
                                'expired_at' => $member_to,
                                'contract_date' =>$member_from,
                                'subtotal' => $price,
                                'fitnessity_fee' => 0,
                                'tax' => 0,
                                'tip' => 0,
                                'discount' => 0,
                                'participate' => '[{"id":"'.$customerData->id.'","from":"customer","pc_name":"'.$customerData->full_name.'"}]',
                                'user_type'=> 'customer',
                                'user_id'=> $customerData->id,
                                'transfer_provider_status' =>'paid',
                                'payment_number' => '{}',
                                'order_from' => "Excel Order"
                            ]);

                            BookingCheckinDetails::create([
                                'business_activity_scheduler_id' => 0,
                                'customer_id' => $customerData->id,
                                'booking_detail_id' => $booking_detail->id,
                                'checkin_date' => NULL,
                                'use_session_amount' => 0,
                                'source_type' => 'in_person',
                            ]);
                        }
                    }
                }
            }
        }
    }
}
