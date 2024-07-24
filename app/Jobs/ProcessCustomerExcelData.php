<?php

namespace App\Jobs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Customer;
use App\CompanyInformation;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\BusinessCustomerUploadFiles;
use Maatwebsite\Excel\Facades\Excel; // Add this line
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ImportStatisticsMail;
use App\Mail\ImportErrorMail;

class ProcessCustomerExcelData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $shouldOverlap = false;

    public $tries = 5; // Number of attempts
    public $timeout = 600; // Timeout in seconds
    protected $business_id;
    // protected $file_name;
    protected $company;
    protected $chunk;
    protected $email;

    public function __construct($business_id, array $chunk,$email)
    {
        $this->company = CompanyInformation::findOrFail($business_id);
        $this->business_id = $business_id;
        $this->chunk = $chunk;
        $this->email = $email;
    }
    public function handle()
    {
        ini_set('max_execution_time', -1);
        $totalRows = count($this->chunk);
        $skippedRows = 0;
        $failedRows = 0;
        $successfulRows = 0;
        foreach ($this->chunk as $row) {
            $customerExists = Customer::where('business_id', $this->business_id)
                ->where(function ($query) use ($row) {
                    $query->where(function ($query) use ($row) {
                        $query->whereRaw('LOWER(lname) = ?', [strtolower($row[0])])
                              ->orWhereNull('lname');
                    })
                    ->where(function ($query) use ($row) {
                        $query->whereRaw('LOWER(fname) = ?', [strtolower($row[1])])
                              ->orWhereNull('fname');
                    })
                    ->where(function ($query) use ($row) {
                        $query->where('email', $row[12])
                              ->orWhereNull('email');
                    });
                })
                ->exists();
            if ($customerExists) {
                $skippedRows++;
                continue;
            } else {
                try {
                    $createdata = new Customer;
                    $createdata->business_id = $this->business_id;
                    $createdata->lname = $row[0];
                    $createdata->fname = $row[1];
                    $createdata->address = $row[4];
                    $createdata->city = $row[5];
                    $createdata->state = $row[6];
                    $createdata->zipcode = $row[7];
                    $createdata->country = $row[8] == 'US' ? 'United States' : $row[8];
                    $createdata->phone_number = $row[9];
                    $createdata->email = $row[12];
                    $createdata->status = 0;
                    if ($createdata->save()) {
                        $successfulRows++;
                    } else {
                        $failedRows++;
                    }
                } catch (\Exception $e) {
                    $failedRows++;
                }
            }
        }
        Log::info("Using email: $this->email");
        Mail::to($this->email)->send(new ImportStatisticsMail($totalRows, $successfulRows, $skippedRows, $failedRows));
        Log::info("Mail sent to " . $this->email);
    }
}
