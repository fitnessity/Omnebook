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
     protected $data;
     protected $fileName;
    public function __construct($data,$fileName)
    {
        $this->data = $data;
        $this->fileName = $fileName;
    }
    public function handle()
    {
        $this->data->chunk(100, function ($chunk) {
            try {
                $pdf = PDF::loadView('business.reports.client.pdf_view_new_client', ['data' => $chunk ,'title' => 'InActive Clients Report','clientType'=>'inactive']); 
                /*Storage::disk('pdf')->put('filename.pdf','');*/
                $pdf->save('pdf/'.$this->fileName);
            } catch (\Exception $e) {
                \Log::error('PDF generation error: ' . $e->getMessage());
            }
        });
    }
}
