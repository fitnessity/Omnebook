<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

use Twilio\Rest\Client;
use App\Services\TwilioService;
use Twilio\TwiML\VoiceResponse;
use Illuminate\Support\Facades\DOMDocument;

class Announcement extends Model
{
  
	
	protected $table='announcement';
	protected $guarded = []; 
	protected $appends = ['category_name','announcement_status' ,'opened_cus_per' ,'unsubcribed_cus_per' ,'bounced_email'];

	

    public function getCategoryNameAttribute(){
        return $this->AnnouncementCategory ? $this->AnnouncementCategory->name : 'N/A';
    }

    public function getAnnouncementStatusAttribute(){
        $announcementDateTime =  Carbon::parse($this->announcement_date . ' ' . $this->announcement_time);
		$currentDateTime = Carbon::now();
		if($announcementDateTime->lessThan($currentDateTime)) {
			return 'Sent' ;
		}else{
		 	return 'Scheduled';
		}
    }

    public function getBouncedEmailAttribute(){
       $cnt = $this->announcementContactCustomerList()->sum('is_sent_email');
       $totalMail = $this->announcementContactCustomerList()->count();
       return   $totalMail -  $cnt;
    }

    public function getOpenedCusPerAttribute(){
       $openCnt = $this->announcementContactCustomerList()->sum('is_opened_email');
       $totalMail = $this->announcementContactCustomerList()->count();
       return  number_format(($openCnt  / $totalMail) * 100,2);
    }

    public function getUnsubcribedCusPerAttribute(){
       $cnt = $this->announcementContactCustomerList()->sum('is_unsubscribed_email');
       $totalMail = $this->announcementContactCustomerList()->count();
       return  number_format(( $cnt / $totalMail) * 100 , 2);
    }

    public function AnnouncementCategory(){
        return $this->belongsTo(AnnouncementCategory::class,'category_id');
    } 

    public function companyInformation(){
        return $this->belongsTo(CompanyInformation::class,'business_id');
    } 

    public function announcementContactList(){
    	return $this->hasMany(AnnouncementContactList::class,'announcement_id');
    }

    public function announcementContactCustomerList(){
    	return $this->hasMany(AnnouncementContactCustomerList::class,'announcement_id');
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

	function sendAnnouncementMail(){
		$customers = $this->announcementContactCustomerList()->get();
		foreach ($customers as $key => $c) {
			$customer = Customer::find($c->customer_id);
			if($customer && $this->announcement &&  $customer->email){
				if($this->delivery_method_email == 1){
					$emailData = array(
			            'ProviderName'=> $this->companyInformation->company_name,
			            'Text'=> $this->generateHtmlContent( $this->announcement),
			            'email'=> $customer->email,
			            'announcementId'=> $this->id,
			            'customerId'=> $customer->id
			        );
	
					//echo  $this->generateHtmlContent( $this->announcement);exit();
					$status = SGMailService::sendAnnouncementEmail($emailData);
					$this->announcementContactCustomerList()->where('customer_id' ,$customer->id)->update(['is_sent_email' => 1]);
				}

				/*if($this->delivery_method_sms == 1 && $customer->phone_number && $this->sms_text){
					$account_sid = getenv("TWILIO_SID");
			        $auth_token = getenv("TWILIO_AUTH_TOKEN");
			        $twilio_number = getenv("TWILIO_NUMBER");

			        $phoneNumber = str_replace([' ','(',')','-'],'',$customer->phone_number);
            		$phoneNumber = '+1'.$phoneNumber;

			        $recipients = $phoneNumber;

			        $client = new Client($account_sid, $auth_token);
			        try{
			            $client->messages->create($recipients, [ "body" => $this->sms_text, 'from' => $twilio_number]);
			            $msg = 'Success';
			        }catch(\Exception $e) {
			            $msg =  $e;
			        }
			       echo $msg ;
				}*/
			}
			
		}
	}


	protected function generateHtmlContent($text) {

	    $htmlContent = "
	        <!DOCTYPE html>
	        <html>
	        <head>
	            <style>
	                body {
	                    width: 100% !important;
	                    margin: 0;
	                    padding: 0;
	                    -webkit-text-size-adjust: 100%;
	                    -ms-text-size-adjust: 100%;
	                }
	                table {
	                    border-collapse: collapse !important;
	                }
	                .content {
	                    max-width: 600px;
	                    margin: 0 auto;
	                    width: 100%;
	                }
	                img.dynamic-img {
	                    width: 100%;
	                    height: auto;
	                }
	            </style>
	        </head>
	        <body style='width: 100%; margin: 0; padding: 0;'>
	            <table border='0' cellpadding='0' cellspacing='0' width='100%'>
	                <tr>
	                    <td>
	                        <table class='content' border='0' cellpadding='0' cellspacing='0' width='600' align='center'>
	                            <tr>
	                                <td>
	                                    {$text}
	                                </td>
	                            </tr>
	                        </table>
	                    </td>
	                </tr>
	            </table>
	        </body>
	        </html>
	    ";

	    // Apply dynamic CSS to images
	    $htmlContent = $this->applyDynamicCssToImages($htmlContent);

	    return $htmlContent;
	}

	protected function applyDynamicCssToImages($htmlContent) {
	    $dom = new \DOMDocument();
	    libxml_use_internal_errors(true);
	    $dom->loadHTML($htmlContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

	    $images = $dom->getElementsByTagName('img');

	    foreach ($images as $image) {
	        $image->removeAttribute('height');
	        $image->removeAttribute('width');
	        $classAttr = $dom->createAttribute('class');
	        $classAttr->value = 'dynamic-img';
	        $image->setAttributeNode($classAttr);
	    }

	    $modifiedHtmlContent = $dom->saveHTML();
	    libxml_clear_errors();
	    return $modifiedHtmlContent;
	}

    
}

?>