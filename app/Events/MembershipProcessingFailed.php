<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MembershipProcessingFailed
{
    use Dispatchable, SerializesModels;

    public $businessId;
    public $userEmail;

    public function __construct($businessId, $userEmail)
    {
        $this->businessId = $businessId;
        $this->userEmail = $userEmail;
    }
}
?>