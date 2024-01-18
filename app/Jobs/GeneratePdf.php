<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use \PDF;
use Illuminate\Support\Facades\Storage;

class GeneratePdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
     protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        $this->data->chunk(100, function ($chunk) {
            try {
                $pdf = PDF::loadView('business.reports.client.pdf_view_new_client', ['data' => $chunk]); 
                Storage::disk('pdf')->put('filename.pdf','');
                $pdf->save('../public/pdf/filename.pdf');
            } catch (\Exception $e) {
                \Log::error('PDF generation error: ' . $e->getMessage());
            }
        });
    }
}
