<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class ChunkProcessTracker extends Model
{
    //
    protected $fillable = ['business_id ','total_chunks','processed_chunks','email_sent'];
    protected $table = 'chunk_processes_trackers';
}
