<?php

namespace App\Listeners;

use App\Events\MembershipProcessingCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\BusinessCustomerUploadFiles;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class NotifyUserOfCompletion implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(MembershipProcessingCompleted $event)
    {
        Log::info('Handling MembershipProcessingCompleted event. Business ID: ' . $event->businessId . ', Email: ' . $event->userEmail);
        $data = BusinessCustomerUploadFiles::where('business_id', $event->businessId)->first();
        if ($data) {
            $data->isseen = '0';
            $data->status = '0'; 
            $data->save();

            Log::info('BusinessCustomerUploadFiles updated successfully. ID: ' . $data->id);
        } else {
            Log::warning('BusinessCustomerUploadFiles not found for Business ID: ' . $event->businessId);
        }
    }
}
?>