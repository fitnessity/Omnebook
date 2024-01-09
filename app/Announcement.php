<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
  
	
	protected $table='announcement';
	protected $guarded = []; 
	protected $appends = ['category_name'];

	public function AnnouncementCategory(){
        return $this->belongsTo(AnnouncementCategory::class,'category_id');
    } 

    public function getCategoryNameAttribute(){
        return $this->AnnouncementCategory ? $this->AnnouncementCategory->name : 'N/A';
    }

    function formatDateTime($dateTime)
	{
	    $givenDate = Carbon::parse($dateTime)->format('Y-m-d');
	    $currentDate = Carbon::now()->format('Y-m-d');

	    if ($givenDate == $currentDate) {
	        return 'Today ' . Carbon::parse($dateTime)->format('H:i');
	    } else {
	        return Carbon::parse($dateTime)->format('M d Y');
	    }
	}

    
}

?>