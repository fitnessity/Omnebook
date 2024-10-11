<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\{Customer,BusinessPriceDetails,UserBookingDetail,UserBookingStatus,Transaction,BookingCheckinDetails,BusinessCustomerUploadFiles,BusinessPriceDetailsAges,BusinessServices};
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ImportMembershipMail;
use App\ChunkProcessTracker;

class MembershipRun implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $business_id;
    protected $data;
    protected $email;
    protected $upid;
    protected $tracker_id;
    protected $userid;
    public function __construct($business_id,$data,$email,$upid,$tracker_id,$userid)
    {
        $this->business_id = $business_id;
        $this->data = $data;
        $this->email = $email;
        $this->upid=$upid;
        $this->tracker_id = $tracker_id;
        $this->userid = $userid;
    }
    public function handle()
    {
        ini_set('memory_limit', '-1'); 
        ini_set('max_execution_time', -1);
        $date = Carbon::now();
        $rand = rand(pow(10, $digits-1), pow(10, $digits)-1); 
        $totalRows = 0;
        $successfulRows = 0;
        $skippedRows = 0;
        $failedRows = 0;
        try {
            foreach ($this->data as $i => $rowData) {
                $totalRows++;
                Log::info("Processed row data: ".json_encode($rowData));
                Log::info('Checking row ' . $i .':'.json_encode($rowData));
                Log::info('Column 1 '.$rowData[0]);
                Log::info('Column 4'.$rowData[3]);
                Log::info('Column 3 '.$rowData[2]);
                Log::info('Column 5 '.$rowData[4]);
                if (!empty($rowData[0]) && !empty($rowData[3]) && !empty($rowData[4]) && $rowData[2] != 'Declined') {
                    Log::info('main if part:');
                    $string = htmlentities($rowData[0], null, 'utf-8');
                    $content = str_replace("&nbsp;", "", $string);
                    $content = html_entity_decode($content);
                    $nameary = explode(',', $content);
                    $customerData = Customer::where(['fname' => @$nameary[1], 'lname' => @$nameary[0], 'business_id' => $this->business_id])->first();
                    if (!$customerData) {
                        $customerData = Customer::create([
                            'fname' => @$nameary[1],
                            'lname' => @$nameary[0],
                            'business_id' => $this->business_id
                        ]);
                        Log::info('customer not found if: ');
                        $successfulRows++; 
                    }
                    if ($customerData) {
                        $priceDetailsData = BusinessPriceDetailsAges::where('cid', $this->business_id)->get();
                        $title = str_replace("&nbsp;", "", htmlentities($rowData[1], null, 'utf-8'));
                        $title = html_entity_decode($title);
                        $priceDetail = $priceDetailsData->first(function ($pd) use ($title) {
                            return str_replace(" ", "", $pd->category_title) === str_replace(" ", "", $title);
                        });
                      
                            $conDate = explode('/', $rowData[3]);
                            $exDate = explode('/', $rowData[4]);
                            $member_to = @$exDate[2] . '-' . @$exDate[0] . '-' . @$exDate[1];
                            $member_from = @$conDate[2] . '-' . @$conDate[0] . '-' . @$conDate[1];
                            Log::info('customerid : '.$customerData->id);
                            Log::info('price id :'.$priceDetail->id);
                            $BookingDetail = UserBookingDetail::where([
                                'user_id' => $customerData->id,
                                'priceid' => $priceDetail->id
                            ])->whereDate('expired_at', '=', $member_to)->whereDate('contract_date', '=', $member_from)->first();
                            
                            if (!$BookingDetail) {
                                Log::info('booking detail :'.$priceDetail->id);

                                $adultPrice = $priceDetail->adult_cus_weekly_price;
                                $childPrice = $priceDetail->child_cus_weekly_price;
                                $infantPrice = $priceDetail->infant_cus_weekly_price;
                                $adultWEPrice = $priceDetail->adult_weekend_price_diff;
                                $childWEPrice = $priceDetail->child_weekend_price_diff;
                                $infantWEPrice = $priceDetail->infant_weekend_price_diff;
                                $price = $customerData->age > 18 || $customerData->age == '' ?
                                    ($adultPrice ?: ($adultWEPrice ?: 0)) : 0;
                                if ($price == 0) {
                                    $price = $childPrice ?: ($childWEPrice ?: 0);
                                    if ($price == 0) {
                                        $price = $infantPrice ?: ($infantWEPrice ?: 0);
                                    }
                                }
                                $qtyarray = [
                                    'adult' => ($price == $adultPrice || $price == $adultWEPrice) ? 1 : 0,
                                    'child' => ($price == $childPrice || $price == $childWEPrice) ? 1 : 0,
                                    'infant' => ($price == $infantPrice || $price == $infantWEPrice) ? 1 : 0
                                ];
                                $pricearray = [
                                    'adult' => $price == $adultPrice ? $adultPrice : ($price == $adultWEPrice ? $adultWEPrice : 0),
                                    'child' => $price == $childPrice ? $childPrice : ($price == $childWEPrice ? $childWEPrice : 0),
                                    'infant' => $price == $infantPrice ? $infantPrice : ($price == $infantWEPrice ? $infantWEPrice : 0)
                                ];
                                // Create booking status
                                $orderdata = [
                                    'order_id'=> 'FS_'.$date->format('YmdHis').$rand,
                                    'user_id' =>  $this->userid,
                                    'customer_id' => $customerData->id,
                                    'user_type' => 'customer',
                                    'status' => 'active',
                                    'currency_code' => 'usd',
                                    'amount' => $price,
                                    'order_type' => 'membership',
                                    'bookedtime' => Carbon::now()->format('Y-m-d')
                                ];
                                $userBookingStatus = UserBookingStatus::create($orderdata);
                        
                               $bussiness_services= BusinessServices::create([
                                    'cid'=>$this->business_id,
                                    'user_id'=>$this->userid,
                                    'program_name'=>'memberhsip',

                               ]);
                               $business_service->update([
                                    'serviceid' => $business_service->id,
                                ]);

                                $booking_detail = UserBookingDetail::create([
                                    'booking_id' => $userBookingStatus->id,
                                    'sport' => $business_service->id,
                                    'business_id' => $this->business_id,
                                    'expired_at' => $member_to,
                                    'contract_date' => $member_from,
                                    'subtotal' => 0,
                                    'fitnessity_fee' => 0,
                                    'tax' => 0,
                                    'tip' => 0,
                                    'discount' => 0,
                                    'participate' => '[{"id":"' . $customerData->id . '","from":"customer","pc_name":"' . $customerData->full_name . '"}]',
                                    'user_type' => 'customer',
                                    'user_id' => $customerData->id,
                                    'payment_number' => '{}',
                                    'order_from' => "Membership Order",
                                    'status' => 'active',
                                    'order_type' => 'Membership',
                                ]);
                                BookingCheckinDetails::create([
                                    'business_activity_scheduler_id' => 0,
                                    'customer_id' => $customerData->id,
                                    'booking_detail_id' => $booking_detail->id,
                                    'checkin_date' => NULL,
                                    'use_session_amount' => 0,
                                    'source_type' => 'in_person',
                                ]);
                               
                                Log::info('BookingDetail not found if: ');

                                if (!$priceDetail) 
                                {
                                    Log::info('pricedetail if: ');
                                    BusinessPriceDetailsAges::create([
                                        'user_id'=> $this->userid,
                                        'cid'=>$this->business_id,
                                        'serviceid'=>$business_service->id,
                                        'category_title'=> $title,
                                        'visibility_to_public'=>0,
                                        'stype'=>1,
                                    ]);   
                                }
                                $successfulRows++; 
                            } 
                            else {
                                Log::info('BookingDetail found if: ');
                                $skippedRows++;
                            }
                    } else {
                        Log::info('no customer else part: ');
                        $failedRows++;
                    }
                } else {
                    Log::info('main if else part: ');
                    $skippedRows++;
                }
            }

            try {   
                $tracker = ChunkProcessTracker::find($this->tracker_id);
                Log::info('test: '.$this->tracker_id);
                if ($tracker) {
                    Log::info('inside if: '.$this->tracker_id);
                    $tracker->processed_chunks += 1;
                    $tracker->save();
                    if ($tracker->processed_chunks >= $tracker->total_chunks && $tracker->email_sent==0) {
                        try {
                            Log::info('another if: '.$this->tracker_id);
                            Log::info('ProcessMembership. Total Rows: '.$totalRows.', Successful Rows: '.$successfulRows.', Skipped Rows: '.$skippedRows.', Failed Rows: '.$failedRows);
                            Mail::to($this->email)->send(new ImportMembershipMail($totalRows, $successfulRows, $skippedRows, $failedRows));
                            Log::info('Email sent successfully');
                            $tracker->email_sent = 1;
                            $tracker->save();
                            $uploadFile = BusinessCustomerUploadFiles::find($this->upid);
                            Log::info('upid'.$this->upid);
                            if($uploadFile)
                            {
                                Log::info('upload file');
                                $uploadFile->isseen='0';
                                $uploadFile->status='0';
                                $uploadFile->save();
                            }
                        } catch (\Exception $e) {
                            Log::error('Failed to send email inside tracker: ' . $e->getMessage());
                        }
                    }
                }      
                else{
                    Log::error('error: '.$this->tracker_id);
                }
            } catch (\Exception $e) {
                Log::error('Failed to send emails: ' . $e->getMessage(), ['exception' => $e]);            
            }            
        } 
        catch (\Exception $e) {
            Log::error('Error processing membership excel data at line ' . $e->getLine() . ': ' . $e->getMessage());
        }
        
    }
}