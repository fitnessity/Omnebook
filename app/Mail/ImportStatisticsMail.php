<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ImportStatisticsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $totalRows;
    public $successfulRows;
    public $skippedRows;
    public $failedRows;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($totalRows, $successfulRows, $skippedRows, $failedRows)
    {
        $this->totalRows = $totalRows;
        $this->successfulRows = $successfulRows;
        $this->skippedRows = $skippedRows;
        $this->failedRows = $failedRows;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.import_statistics')
        ->subject('Fitness - Client Migration')
        ->with(['totalRows' => $this->totalRows,
                'successfulRows' => $this->successfulRows,
                'skippedRows' => $this->skippedRows,
                'failedRows' => $this->failedRows,
             ]);
    }
}