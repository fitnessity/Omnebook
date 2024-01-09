<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnnouncementCategory extends Model
{
  
	
	protected $table='announcement_category';
	protected $guarded = []; 

	public static function boot(){
        parent::boot();
        static::deleting(function($category) {
            $category->Announcement->each(function($announcement) {
                $announcement->delete();
            });   
        });
    }

	public function Announcement(){
        return $this->hasMany(Announcement::class,'category_id');
    } 

    public function announcementCount(){
    	return $this->Announcement->count();
    }
}

?>