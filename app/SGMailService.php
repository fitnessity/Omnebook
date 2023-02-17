<?php
namespace App;

use SendGrid\Mail\Mail;
use Illuminate\Database\Eloquent\Model;

class SGMailService{

	public static function sendBookingReceipt($email_detail){
		//echo "hii";

		$email = new Mail();
		$email->setFrom(getenv('MAIL_FROM_ADDRESS'), "Fitnessity Support");
		/*$booking = UserBookingStatus::findOrFail($booking_id);
		if($booking->user_type == 'user'){
			$user = User::find($booking->user_id);
			$receiver = $user->email;
			$full_name = $user->full_name;
			
		}

		if($booking->user_type == 'customer'){
			$customer = Customer::find($booking->customer_id);
			$receiver = $customer->email;
			$full_name = $customer->full_name;
		}

		$email->addTo(
		    $receiver,
		    $full_name,
		);*/

		$email->addTo(
		    $email_detail['email'],
		);

		$substitutions = [
			"provider_Name" => $email_detail['getreceipemailtbody']['provider_Name'],  
		    "booking_ID" =>$email_detail['getreceipemailtbody']['booking_ID'],  
		    "program_Name" => $email_detail['getreceipemailtbody']['program_Name'],   
		    "category" => $email_detail['getreceipemailtbody']['category'],   
		    "price_Option" => $email_detail['getreceipemailtbody']['price_Option'],  
		    "sessions" => $email_detail['getreceipemailtbody']['sessions'],  
		    "membership" => $email_detail['getreceipemailtbody']['membership'],  
		    "quantity" => $email_detail['getreceipemailtbody']['quantity'],  
		    "participate" => $email_detail['getreceipemailtbody']['participate'],  
		    "activity_Type" => $email_detail['getreceipemailtbody']['activity_Type'],  
		    "service_Type" => $email_detail['getreceipemailtbody']['service_Type'],  
		    "membership_Duration" => $email_detail['getreceipemailtbody']['membership_Duration'],  
		    "purchase_Date" => $email_detail['getreceipemailtbody']['purchase_Date'],  
		    "membership_Activation_Date" => $email_detail['getreceipemailtbody']['membership_Activation_Date'],  
		    "membership_Expiration" => $email_detail['getreceipemailtbody']['membership_Expiration'],  
		    "price" => $email_detail['getreceipemailtbody']['price'],  
		    "discount" => $email_detail['getreceipemailtbody']['discount'],  
		    "total" => $email_detail['getreceipemailtbody']['total'] 
		];

		$email->addDynamicTemplateDatas($substitutions);

		/*$email->addDynamicTemplateDatas( 
		  	$email_detail['getreceipemailtbody'],
		  
		);*/
		//$email->setTemplateId("d-9ad5e9cbc94b4ccb8bab4ccecf915b51");
		$email->setTemplateId("d-22008cb39c6a409791acb17f3064abd3");
		$sendgrid = new \SendGrid(getenv('MAIL_PASSWORD'));
		try {
		    $sendgrid->send($email);
		    $response = "success"; 
		} catch (Exception $e) {
			$response = 'fail';
		}
		return $response;
	}
}