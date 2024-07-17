<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Bus\Batchable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Imports\customerAtendanceImport;
use Maatwebsite\Excel\Facades\Excel;
use App\{Customer,BusinessPriceDetails,BusinessPriceDetailsAges,UserBookingStatus,Transaction,UserBookingDetail,BookingCheckinDetails};
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ImportAttendanceMail;

class ProcessAttendance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $tries = 5; // Number of attempts
    public $timeout = 600; // Timeout in seconds
    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $business_id;
    protected $data;
    protected $email;
    public function __construct($business_id,$data,$email)
    {
        $this->business_id = $business_id;
        $this->data = $data;
        $this->email = $email;

    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', '1000');

        $totalRows = 0;
        $successfulRows = 0;
        $skippedRows = 0;
        $failedRows = 0;
        $processedEntries = [];

        foreach ($this->data as $i => $rowData) {
            if ($i === 0) {
                // Skip header row if present
                continue;
            }
            $totalRows++;

            try {
                $entryKey = $this->generateEntryKey($rowData);
                if (isset($processedEntries[$entryKey])) {
                    $skippedRows++;
                    continue;
                }
                $processedEntries[$entryKey] = true;

                $string = htmlentities($rowData[4], null, 'utf-8');
                $content1 = str_replace("&nbsp;", "", $string);
                $content1 = str_replace(" ", "", $content1);
                $content = html_entity_decode($content1);
                $name = explode(',', $content);

                $customerData = Customer::whereRaw('LOWER(lname) = ? AND LOWER(fname) = ? AND business_id = ?', [strtolower(@$name[0]), strtolower(@$name[1]), $this->business_id])->first();
                
                if (!$customerData) {
                    $customerData = Customer::create([
                        'fname' => @$name[1],
                        'lname' => @$name[0],
                        'business_id' => $this->business_id
                    ]);
                    $successfulRows++;
                }

                if ($customerData) {
                    $priceDetailsData = BusinessPriceDetails::where('cid', $this->business_id)->get();
                    $title = str_replace("&nbsp;", "", htmlentities($rowData[8], null, 'utf-8'));
                    $title = html_entity_decode($title);
                    $priceDetail = $priceDetailsData->first(function ($pd) use ($title) {
                        return str_replace(" ", "", $pd->price_title) === str_replace(" ", "", $title);
                    });

                    if ($priceDetail && $rowData[9] && $rowData[3]) {
                        $exDate = explode('/', $rowData[9]);
                        $checkinDate = explode('/', $rowData[3]);
                        $expired_at = @$exDate[2] . '-' . @$exDate[0] . '-' . @$exDate[1];
                        $chkDate = @$checkinDate[2] . '-' . @$checkinDate[0] . '-' . @$checkinDate[1];
                        $bookingDetail = UserBookingDetail::where([
                            'user_id' => $customerData->id,
                            'priceid' => $priceDetail->id,
                        ])->whereDate('expired_at', '=', $expired_at)->first();

                        if ($bookingDetail) {
                            $exceltime = date('H:i', strtotime($rowData[2]));
                            $scheduleInfo = $priceDetail->business_price_details_ages->BusinessActivityScheduler->first(function ($schedule) use ($exceltime) {
                                return $exceltime == $schedule['shift_start'];
                            });
                            $chkInDetail = BookingCheckinDetails::where(['customer_id' => $customerData->id, 'booking_detail_id' => $bookingDetail->id])->whereDate('checked_at', '=', $chkDate)->first();
                            $schedule_id = @$scheduleInfo->id ?? 0;
                            $ary = [
                                'business_activity_scheduler_id' => $schedule_id,
                                'customer_id' => $customerData->id,
                                'booking_detail_id' => $bookingDetail->id,
                                'checkin_date' => $chkDate,
                                'checked_at' => $chkDate,
                                'use_session_amount' => 1,
                                'after_use_session_amount' => $rowData[10],
                                'source_type' => 'in_person',
                            ];

                            if (!$bookingDetail->act_schedule_id) {
                                $bookingDetail->update(['bookedtime' => $chkDate, 'act_schedule_id' => @$scheduleInfo->id]);
                            }
                            BookingCheckinDetails::updateOrCreate(['id' => @$chkInDetail->id], $ary);
                        }
                    }
                }
                $user = Auth::user();
                Mail::to($this->email)->send(new ImportAttendanceMail($totalRows, $successfulRows, $skippedRows, $failedRows));

            } catch (\Exception $e) {
                Log::error('Failed processing row:', ['row' => $rowData, 'error' => $e->getMessage()]);
                $failedRows++;
                continue;
            }
        }

        Log::info('Processing complete:', [
            'total_rows' => $totalRows,
            'successful_rows' => $successfulRows,
            'skipped_rows' => $skippedRows,
            'failed_rows' => $failedRows,
        ]);
    }

    private function generateEntryKey($entry)
    {
        // Assuming these indexes correspond to client name, date, and time
        $clientName = $entry[4] ?? '';
        $date = $entry[3] ?? '';
        $time = $entry[2] ?? '';
        
        // Create a more specific key
        return md5($clientName . $date . $time);
    }
}
