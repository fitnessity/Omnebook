<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\{Customer,BusinessPriceDetails,UserBookingDetail,UserBookingStatus,Transaction,BookingCheckinDetails,BusinessCustomerUploadFiles};
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\ImportMembershipMail;
use App\ChunkProcessTracker;
class ProcessMembership implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $business_id;
    protected $data;
    protected $email;
    protected $upid;
    protected $tracker_id;
    public function __construct($business_id,$data,$email,$upid,$tracker_id)
    {
        $this->business_id = $business_id;
        $this->data = $data;
        $this->email = $email;
        $this->upid=$upid;
        $this->tracker_id = $tracker_id;
    }
    public function handle()
    {
        $totalRows = 0;
        $successfulRows = 0;
        $skippedRows = 0;
        $failedRows = 0;
        try {
            foreach ($this->data as $i => $rowData) {
                $totalRows++;
                if (!empty($rowData[0]) && !empty($rowData[3]) && !empty($rowData[4]) && $rowData[2] != 'Declined') {
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
                        $successfulRows++; 
                    }
                    if ($customerData) {
                        $priceDetailsData = BusinessPriceDetails::where('cid', $this->business_id)->get();
                        $title = str_replace("&nbsp;", "", htmlentities($rowData[1], null, 'utf-8'));
                        $title = html_entity_decode($title);
                        $priceDetail = $priceDetailsData->first(function ($pd) use ($title) {
                            return str_replace(" ", "", $pd->price_title) === str_replace(" ", "", $title);
                        });
                        if ($priceDetail) {
                            $conDate = explode('/', $rowData[3]);
                            $exDate = explode('/', $rowData[4]);
                            $member_to = @$exDate[2] . '-' . @$exDate[0] . '-' . @$exDate[1];
                            $member_from = @$conDate[2] . '-' . @$conDate[0] . '-' . @$conDate[1];
                            $BookingDetail = UserBookingDetail::where([
                                'user_id' => $customerData->id,
                                'priceid' => $priceDetail->id
                            ])->whereDate('expired_at', '=', $member_to)->whereDate('contract_date', '=', $member_from)->first();
                            if (!$BookingDetail) {
                                // Calculate prices and quantities
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
                                    'user_id' => Auth::user()->id,
                                    'customer_id' => $customerData->id,
                                    'user_type' => 'customer',
                                    'status' => 'active',
                                    'currency_code' => 'usd',
                                    'amount' => $price,
                                    'order_type' => 'Excel Order',
                                    'bookedtime' => Carbon::now()->format('Y-m-d')
                                ];
                                $userBookingStatus = UserBookingStatus::create($orderdata);
                                // Create transaction
                                $transactiondata = [
                                    'user_type' => 'Customer',
                                    'user_id' => $customerData->id,
                                    'item_type' => 'UserBookingStatus',
                                    'item_id' => $userBookingStatus->id,
                                    'channel' => 'cash',
                                    'kind' => 'Cash',
                                    'transaction_id' => "CS_" . Carbon::now()->format('YmdHmsv'),
                                    'stripe_payment_method_id' => '',
                                    'amount' => $price,
                                    'qty' => '1',
                                    'status' => 'processing',
                                    'refund_amount' => 0,
                                    'payload' => ''
                                ];
                                $transactionstatus = Transaction::create($transactiondata);
                                $status = strtolower($this->data[$i][3]);
                                if ($status === 'terminated') {
                                    $status = 'cancel';
                                } elseif ($status === 'suspended') {
                                    $status = 'suspend';
                                } elseif ($status === 'expired') {
                                    $status = 'complete';
                                }
                                $booking_detail = UserBookingDetail::create([
                                    'booking_id' => $userBookingStatus->id,
                                    'sport' => $priceDetail->BusinessServices->id,
                                    'business_id' => $this->business_id,
                                    'price' => json_encode($pricearray),
                                    'qty' => json_encode($qtyarray),
                                    'priceid' => $priceDetail->id,
                                    'pay_session' => $priceDetail->pay_session,
                                    'expired_at' => $member_to,
                                    'contract_date' => $member_from,
                                    'subtotal' => $price,
                                    'fitnessity_fee' => 0,
                                    'tax' => 0,
                                    'tip' => 0,
                                    'discount' => 0,
                                    'participate' => '[{"id":"' . $customerData->id . '","from":"customer","pc_name":"' . $customerData->full_name . '"}]',
                                    'user_type' => 'customer',
                                    'user_id' => $customerData->id,
                                    'transfer_provider_status' => 'paid',
                                    'payment_number' => '{}',
                                    'order_from' => "Excel Order",
                                    'status' => $status,
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
                                $successfulRows++; 
                            } else {
                                $skippedRows++;
                            }
                        }
                    } else {
                        $failedRows++;
                    }
                } else {
                    $skippedRows++;
                }
            }

            try {
                Mail::to($this->email)->send(new ImportMembershipMail($totalRows, $successfulRows, $skippedRows, $failedRows));
                $uploadFile = BusinessCustomerUploadFiles::find($this->data);
                if($uploadFile)
                {
                    $uploadFile->isseen='0';
                    $uploadFile->status='0';
                }   
                $tracker = ChunkProcessTracker::find($this->tracker_id);
                if ($tracker) {
                    $tracker->processed_chunks+1;
                    $tracker->save();
                    if ($tracker->processed_chunks >= $tracker->total_chunks && !$tracker->email_sent) {
                        try {
                            Log::info('ProcessMembership. Total Rows: '.$totalRows.', Successful Rows: '.$successfulRows.', Skipped Rows: '.$skippedRows.', Failed Rows: '.$failedRows);
    
                            Mail::to($this->email)->send(new ImportMembershipMail($totalRows, $successfulRows, $skippedRows, $failedRows));
                            Log::info('Email sent successfully');
                            $tracker->email_sent = true;
                            $tracker->save();
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
        } catch (\Exception $e) {
            Log::error('Error processing membership excel data:  '. __LINE__ . $e->getMessage());
        }
    }
}