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

}
