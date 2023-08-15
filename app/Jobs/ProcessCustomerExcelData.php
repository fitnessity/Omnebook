<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Customer;
class ProcessCustomerExcelData implements ShouldQueue
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
        $count = count($this->data) - 1;
        for ($i=1; $i < $count; $i++){
            if( Customer::where(['email'=> $this->data[$i]['email']])->first() == ''){
                $createdata = new Customer;
                $createdata->business_id =  $this->business_id;
                $createdata->lname =  $this->data[$i]['last_name'];
                $createdata->fname =  $this->data[$i]['first_name'];
                $createdata->address =   $this->data[$i]['address'];
                $createdata->city =  $this->data[$i]['city'];
                $createdata->state =   $this->data[$i]['state'];
                $createdata->zipcode =  $this->data[$i]['postal_code'];
                $createdata->country =  $this->data[$i]['country'] == 'US' ? 'United Status' : $this->data[$i]['country'] ;
                $createdata->phone_number =  $this->data[$i]['mobile_phone'];
                $createdata->email =  $this->data[$i]['email'];
                $createdata->status = 0;
                $createdata->save(); 
            }
        }
    }
}
