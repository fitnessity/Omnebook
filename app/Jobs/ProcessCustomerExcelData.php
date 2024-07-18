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
    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $business_id;
    // protected $file_name;
    protected $company;
    protected $chunk;
    protected $email;

    // public function __construct($business_id,$file_name,array $chunk)
    // {
    //     $this->company = CompanyInformation::findOrFail($business_id);
    //     $this->business_id = $business_id;
    //     $this->file_name = $file_name;
    //     $this->chunk = $chunk;
    // }

    public function __construct($business_id, array $chunk,$email)
    {
        $this->company = CompanyInformation::findOrFail($business_id);
        $this->business_id = $business_id;
        $this->chunk = $chunk;
        $this->email = $email;

    }
    /**
     * Execute the job.
     *
     * @return void
     */
    // public function handle()
    // {
        //     $data = Storage::disk('s3')->get($this->file_name);

            // $skip = "";
            // $fail = "";
            // $stream = fopen('php://memory', 'r+');
            // fwrite($stream, $data);
            // rewind($stream);

            // $header = [];
            // $rows = [];

        //     while ($row = fgetcsv($stream)) {
        //         if (empty($header)) {
        //             $header = $row;
        //         } else {
        //             if($this->company->customers()->whereRaw('LOWER(lname) = ? AND LOWER(fname) = ? AND email = ?', [strtolower($row[0]), strtolower($row[1]), $row[12]])->exists()){
        //                 $skip .= implode(",", $row)."\n";
        //             }else{
        //                 $createdata = new Customer;
        //                 $createdata->business_id =  $this->business_id;
        //                 $createdata->lname =  $row[0];
        //                 $createdata->fname =  $row[1];
        //                 $createdata->address = $row[4];
        //                 $createdata->city =  $row[5];
        //                 $createdata->state =  $row[6];
        //                 $createdata->zipcode = $row[7];
        //                 $createdata->country = $row[8] == 'US' ? 'United Status' : $row[8];
        //                 $createdata->phone_number =  $row[9];
        //                 $createdata->email = $row[12];
        //                 $createdata->status = 0;
        //                 if(!$createdata->save()){
        //                     $fail .= implode(",", $row)."\n";
        //                 } 
        //             }
                        

        //         }
        //     }

        //     fclose($stream);
            
        //     $skip_file = 'import_logs/'.Str::uuid();
        //     $fail_file = 'import_logs/'.Str::uuid();
        //     $this->company->update(['customer_uploading' => 0, 
        //                             'client_skip_logs_url' => $skip_file,
        //                             'client_fail_logs_url' => $fail_file,
        //                             'client_imported_at' => now()]);



        //     Storage::disk('s3')->put('import_logs/'.Str::uuid(), $skip);
        //     Storage::disk('s3')->put('import_logs/'.Str::uuid(), $fail);
        
    // }
    // public function handle()
    // {
    //     ini_set('max_execution_time', 300);
    //     $data = Excel::toArray([], $this->file_name);
    //     $totalRows = count($data[0]);
    //     $uploadFile = BusinessCustomerUploadFiles::where('file', $this->file_name)->first();
    //     if ($uploadFile) {
    //         $uploadFile->num_records = $totalRows;
    //         $uploadFile->save();
    //     }
    //     $skippedRows = 0;
    //     $failedRows = 0;
    //     $successfulRows = 0;
    
    //     for ($i = 1; $i < $totalRows; $i++) {
    //         $row = $data[0][$i];
    
    //         // if ($this->company->customers()->whereRaw('LOWER(lname) = ? AND LOWER(fname) = ? AND email = ?', [strtolower($row[0]), strtolower($row[1]), $row[12]])->exists()) {
    //         //     $skippedRows++;
    //         //     continue;
    //         // }

    //         $customerExists = $this->company->customers()
    //         ->where(function ($query) use ($row) {
    //             $query->whereRaw('(LOWER(lname) = ? OR (lname IS NULL AND ? IS NULL)) AND (LOWER(fname) = ? OR (fname IS NULL AND ? IS NULL)) AND (email = ? OR (email IS NULL AND ? IS NULL))', [
    //                 strtolower($row[0]) ?: null,
    //                 is_null($row[0]) ? null : '',
    //                 strtolower($row[1]) ?: null,
    //                 is_null($row[1]) ? null : '',
    //                 $row[12] ?: null,
    //                 is_null($row[12]) ? null : '',
    //             ]);
    //         })
    //         ->exists();
            
    //         if($customerExists)
    //         {
    //             $skippedRows++;
    //             continue;
    //         }
    //         else{
    //             try {
    //                 $createdata = new Customer;
    //                 $createdata->business_id = $this->business_id;
    //                 $createdata->lname = $row[0];
    //                 $createdata->fname = $row[1];
    //                 $createdata->address = $row[4];
    //                 $createdata->city = $row[5];
    //                 $createdata->state = $row[6];
    //                 $createdata->zipcode = $row[7];
    //                 $createdata->country = $row[8] == 'US' ? 'United States' : $row[8];
    //                 $createdata->phone_number = $row[9];
    //                 $createdata->email = $row[12];
    //                 $createdata->status = 0;
                    
                 
    //                 if ($createdata->save()) {
    //                     $successfulRows++;
    //                 } else {
    //                     $failedRows++;
    //                 }
    //             } catch (\Exception $e) {
    //                 $failedRows++;
    //             }
    //         }
    //     }
    //     $user = auth()->user();
    //     \Mail::to($user->email)->send(new \App\Mail.ImportStatisticsMail($totalRows, $successfulRows, $skippedRows, $failedRows));
    //     // You can log or return the statistics if needed
    //     \Log::info("Excel import statistics: Total Rows: $totalRows, Successful Rows: $successfulRows, Skipped Rows: $skippedRows, Failed Rows: $failedRows");
    // }

    // public function handle()
    // {
    //     ini_set('max_execution_time', 300);

    //     try {
    //         $data = Excel::toArray([], $this->file_name);
    //         $totalRows = count($data[0]);
    //         $uploadFile = BusinessCustomerUploadFiles::where('file', $this->file_name)->first();
    //         if ($uploadFile) {
    //             $uploadFile->num_records = $totalRows;
    //             $uploadFile->save();
    //         }
    //         $skippedRows = 0;
    //         $failedRows = 0;
    //         $successfulRows = 0;

    //         for ($i = 1; $i < $totalRows; $i++) {
    //             $row = $data[0][$i];

    //             $customerExists = $this->company->customers()
    //                 ->where(function ($query) use ($row) {
    //                     $query->whereRaw('(LOWER(lname) = ? OR (lname IS NULL AND ? IS NULL)) AND (LOWER(fname) = ? OR (fname IS NULL AND ? IS NULL)) AND (email = ? OR (email IS NULL AND ? IS NULL))', [
    //                         strtolower($row[0]) ?: null,
    //                         is_null($row[0]) ? null : '',
    //                         strtolower($row[1]) ?: null,
    //                         is_null($row[1]) ? null : '',
    //                         $row[12] ?: null,
    //                         is_null($row[12]) ? null : '',
    //                     ]);
    //                 })
    //                 ->exists();

    //             if ($customerExists) {
    //                 $skippedRows++;
    //                 continue;
    //             } else {
    //                 try {
    //                     $createdata = new Customer;
    //                     $createdata->business_id = $this->business_id;
    //                     $createdata->lname = $row[0];
    //                     $createdata->fname = $row[1];
    //                     $createdata->address = $row[4];
    //                     $createdata->city = $row[5];
    //                     $createdata->state = $row[6];
    //                     $createdata->zipcode = $row[7];
    //                     $createdata->country = $row[8] == 'US' ? 'United States' : $row[8];
    //                     $createdata->phone_number = $row[9];
    //                     $createdata->email = $row[12];
    //                     $createdata->status = 0;

    //                     if ($createdata->save()) {
    //                         $successfulRows++;
    //                     } else {
    //                         $failedRows++;
    //                     }
    //                 } catch (\Exception $e) {
    //                     $failedRows++;
    //                     \Log::error("Failed to save customer: " . $e->getMessage());
    //                 }
    //             }
    //         }

    //         $user = auth()->user();
    //         Mail::to($user->email)->send(new ImportStatisticsMail($totalRows, $successfulRows, $skippedRows, $failedRows));

    //         \Log::info("Excel import statistics: Total Rows: $totalRows, Successful Rows: $successfulRows, Skipped Rows: $skippedRows, Failed Rows: $failedRows");

    //     } catch (\Exception $e) {
    //         \Log::error("An error occurred during the import process: " . $e->getMessage());
    //         // $user = auth()->user();
    //         // \Mail::to($user->email)->send(new \App\Mail.ImportErrorMail($e->getMessage()));
    //     }
    // }


    // public function handle()
    // {
    //     ini_set('max_execution_time', 300);

    //     try {
    //         // Parse Excel file
    //         $data = Excel::toArray([], $this->file_name);
    //         $totalRows = count($data[0])-1;
            
    //         // Log total rows for verification
    //         // \Log::info("Total rows parsed: $totalRows");

    //         // Update upload file record
    //         $uploadFile = BusinessCustomerUploadFiles::where('file', $this->file_name)->first();
    //         if ($uploadFile) {
    //             $uploadFile->num_records = $totalRows;
    //             $uploadFile->save();
    //         }

    //         // Initialize counters
    //         $skippedRows = 0;
    //         $failedRows = 0;
    //         $successfulRows = 0;

    //         // Loop through each row
    //         for ($i = 1; $i <= $totalRows; $i++) {
    //             $row = $data[0][$i];

    //             // Log the current row being processed
    //             // \Log::info("Processing row $i: " . json_encode($row));

    //             // Check if customer already exists
    //             // $customerExists = $this->company->customers()
    //             //     ->where(function ($query) use ($row) {
    //             //         $query->whereRaw('(LOWER(lname) = ? OR (lname IS NULL AND ? IS NULL)) AND (LOWER(fname) = ? OR (fname IS NULL AND ? IS NULL)) AND (email = ? OR (email IS NULL AND ? IS NULL))', [
    //             //             strtolower($row[0]) ?: null,
    //             //             is_null($row[0]) ? null : '',
    //             //             strtolower($row[1]) ?: null,
    //             //             is_null($row[1]) ? null : '',
    //             //             $row[12] ?: null,
    //             //             is_null($row[12]) ? null : '',
    //             //         ]);
    //             //     })
    //             //     ->exists();
    //             $customerExists = $this->company->customers()
    //             ->where(function ($query) use ($row) {
    //                 $query->where(function ($query) use ($row) {
    //                     $query->whereRaw('LOWER(lname) = ?', [strtolower($row[0])])
    //                           ->orWhereNull('lname');
    //                 })
    //                 ->where(function ($query) use ($row) {
    //                     $query->whereRaw('LOWER(fname) = ?', [strtolower($row[1])])
    //                           ->orWhereNull('fname');
    //                 })
    //                 ->where(function ($query) use ($row) {
    //                     $query->where('email', $row[12])
    //                           ->orWhereNull('email');
    //                 });
    //             })
    //             ->exists();
    //             if ($customerExists) {
    //                 $skippedRows++;
    //                 continue;
    //             } else {
    //                 try {
    //                     // Create new customer
    //                     $createdata = new Customer;
    //                     $createdata->business_id = $this->business_id;
    //                     $createdata->lname = $row[0];
    //                     $createdata->fname = $row[1];
    //                     $createdata->address = $row[4];
    //                     $createdata->city = $row[5];
    //                     $createdata->state = $row[6];
    //                     $createdata->zipcode = $row[7];
    //                     $createdata->country = $row[8] == 'US' ? 'United States' : $row[8];
    //                     $createdata->phone_number = $row[9];
    //                     $createdata->email = $row[12];
    //                     $createdata->status = 0;

    //                     // Attempt to save the customer
    //                     if ($createdata->save()) {
    //                         $successfulRows++;
    //                     } else {
    //                         $failedRows++;
    //                         // \Log::warning("Failed to save customer: " . json_encode($row));
    //                     }
    //                 } catch (\Exception $e) {
    //                     $failedRows++;
    //                     // \Log::error("Exception while saving customer: " . $e->getMessage() . " for row: " . json_encode($row));
    //                 }
    //             }
    //         }

    //         // Log final statistics
    //         // \Log::info("Excel import statistics: Total Rows: $totalRows, Successful Rows: $successfulRows, Skipped Rows: $skippedRows, Failed Rows: $failedRows");

    //         // Send import statistics email
    //         $user = auth()->user();
    //         Mail::to($user->email)->send(new ImportStatisticsMail($totalRows, $successfulRows, $skippedRows, $failedRows));

    //     } catch (\Exception $e) {
    //         \Log::error("An error occurred during the import process: " . $e->getMessage());
    //         // $user = auth()->user();
    //         // \Mail::to($user->email)->send(new \App\Mail.ImportErrorMail($e->getMessage()));
    //     }
    // }


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
