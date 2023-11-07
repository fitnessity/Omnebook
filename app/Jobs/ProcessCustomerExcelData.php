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

class ProcessCustomerExcelData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $business_id;
    protected $file_name;
    protected $company;

    public function __construct($business_id, $file_name)
    {
        $this->company = CompanyInformation::findOrFail($business_id);
        $this->business_id = $business_id;
        $this->file_name = $file_name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $data = Storage::disk('s3')->get($this->file_name);

        $skip = "";
        $fail = "";
        $stream = fopen('php://memory', 'r+');
        fwrite($stream, $data);
        rewind($stream);

        $header = [];
        $rows = [];

        while ($row = fgetcsv($stream)) {
            if (empty($header)) {
                $header = $row;
            } else {
                if($this->company->customers()->where(['email'=> $row[12]])->exists()){
                    $skip .= implode(",", $row)."\n";
                }else{
                    $createdata = new Customer;
                    $createdata->business_id =  $this->business_id;
                    $createdata->lname =  $row[0];
                    $createdata->fname =  $row[1];
                    $createdata->address =   $row[4];
                    $createdata->city =  $row[5];
                    $createdata->state =   $row[6];
                    $createdata->zipcode =  $row[7];
                    $createdata->country =  $row[8] == 'US' ? 'United Status' : $row[8];
                    $createdata->phone_number =  $row[9];
                    $createdata->email =  $row[12];
                    $createdata->status = 0;
                    if(!$createdata->save()){
                        $fail .= implode(",", $row)."\n";
                    } 
                }
                    

            }
        }

        fclose($stream);
        
        $skip_file = 'import_logs/'.Str::uuid();
        $fail_file = 'import_logs/'.Str::uuid();
        $this->company->update(['customer_uploading' => 0, 
                                'client_skip_logs_url' => $skip_file,
                                'client_fail_logs_url' => $fail_file,
                                'client_imported_at' => now()]);



        Storage::disk('s3')->put('import_logs/'.Str::uuid(), $skip);
        Storage::disk('s3')->put('import_logs/'.Str::uuid(), $fail);
        
    }
}
