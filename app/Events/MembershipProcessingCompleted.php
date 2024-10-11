<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
class MembershipProcessingCompleted
{
    use Dispatchable, SerializesModels;

    public $businessId;
    public $userEmail;

    public function __construct($businessId, $userEmail)
    {
        Log::info('MembershipProcessingCompleted event construct');
        $this->businessId = $businessId;
        $this->userEmail = $userEmail;
    }
}
?>