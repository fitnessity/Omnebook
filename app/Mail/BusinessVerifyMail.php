<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BusinessVerifyMail extends Mailable
{
    use Queueable, SerializesModels;
    public $business,$code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($business,$code)
    {
        $this->business = $business;
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))->subject('Business Verification Link')->view('emails.business-verify');
    }
}
