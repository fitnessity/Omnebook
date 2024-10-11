<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;
class JobFailedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //
        if ($event->job->resolveName() == 'App\Jobs\ProcessCustomerExcelData') {
            $business_id = $event->job->payload()['data']['command']['business_id'];
            Cache::put('job_status_' . $business_id, 'failed', 600);
            Cache::forget('processed_jobs_' . $business_id);
            Cache::forget('total_jobs_' . $business_id);
        }
    }
}
