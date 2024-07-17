<?php
// app/Listeners/NotifyUserOfFailure.php
namespace App\Listeners;

use App\Events\MembershipProcessingFailed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\BusinessCustomerUploadFiles;

class NotifyUserOfFailure implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(MembershipProcessingFailed $event)
    {
        $data = BusinessCustomerUploadFiles::where('business_id', $event->businessId)->first();
        $data->is_error = '1'; // Update is_error to indicate failure
        $data->save();
    }
}
?>