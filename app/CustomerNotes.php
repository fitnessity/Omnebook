<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CustomerNotes extends Model
{
	protected $table='customer_notes'; 
	protected $guarded = [];  

    protected $appends = ['limit_note_character'];

    public function getLimitNoteCharacterAttribute(){
        return Str::limit($this->note, 60, '...');
    }

	public function company() {
        return $this->belongsTo(CompanyInformation::class, 'business_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function User(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function timeAgo(){
        $date = Carbon::parse($this->created_at);
        $minutesDifference = $date->diffInMinutes(now());

        if ($minutesDifference < 60) {
            return $minutesDifference . ' minutes ago';
        }elseif ($minutesDifference < 1440) { // 1440 minutes in a day (24 hours)
            $hours = floor($minutesDifference / 60);
            return $hours . ' hours ago';
        }elseif ($minutesDifference < 43200) { // 43200 minutes in a month (30 days)
            $days = floor($minutesDifference / 1440);
            return $days . ' days ago';
        }elseif ($minutesDifference < 525600) { // 525600 minutes in a year (365 days)
            $months = floor($minutesDifference / 43200);
            return $months . ' months ago';
        }else {
            $years = floor($minutesDifference / 525600);
            return $years . ' years ago';
        }
    }

}
