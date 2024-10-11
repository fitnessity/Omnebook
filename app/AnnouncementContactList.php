<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class AnnouncementContactList extends Model
{
	protected $table='announcement_contact_list';
	protected $guarded = []; 

	public static function boot(){
        parent::boot();

        self::created(function($model){
            $model->createContactList();
        });


        self::updated(function($model){
        	$model->createContactList();
        });

        self::deleted(function($model){
        	$model->deleteContactList();
        });
    }

	public function Customer(){
		return $this->belongsTo(Customer::class ,'customer_id');
	}

	public function announcement(){
		return $this->belongsTo(Announcement::class ,'announcement_id');
	}

	public function createContactList(){
      	$customers = getCustomerList($this->list_name ,$this->value ,$this->business_id);
    	foreach ($customers as $key => $customer) {
            $existingRecord = AnnouncementContactCustomerList::where(['customer_id'=> $customer ,'announcement_id' => $this->announcement_id])->first();

            if ($existingRecord) {
            	$contactListIds = explode(',', $existingRecord->contact_list_id);

		        if (!in_array($this->id, $contactListIds)) {
		            $contactListIds[] = $this->id;
		        }

		        $contactListIds = array_unique($contactListIds);
		        $contactListString = implode(',', $contactListIds);

		        $existingRecord->update([
		            'contact_list_id' => $contactListString
		        ]);

            } else {
                AnnouncementContactCustomerList::create([
                    'announcement_id' => $this->announcement_id,
                    'business_id' => $this->business_id,
                    'contact_list_id' => $this->id,
                    'customer_id' => $customer
                ]);
            }
        }
    }

    public function deleteContactList(){
    	$recordsToUpdate = AnnouncementContactCustomerList::where('contact_list_id', 'like', "%{$this->id}%")->get();
    	foreach ($recordsToUpdate as $record) {
		    $contactListIds = explode(',', $record->contact_list_id);
		    $contactListIds = array_diff($contactListIds, [$this->id]);

		    if (empty($contactListIds)) {
		        $record->delete();
		    } else {
		        $contactListString = implode(',', $contactListIds);
		        $record->update([
		            'contact_list_id' => $contactListString
		        ]);
		    }
		}
    }
}

?>