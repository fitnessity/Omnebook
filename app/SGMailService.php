<?php
namespace App;

use SendGrid\Mail\Mail;
use Illuminate\Database\Eloquent\Model;

class SGMailService{

	public static function sendBookingReceipt($booking_id){

		$email = new Mail();
		$email->setFrom(getenv('MAIL_FROM_ADDRESS'), "Fitnessity Support");


		$booking = UserBookingStatus::findOrFail($booking_id);
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
		);

		$email->setTemplateId("d-9ad5e9cbc94b4ccb8bab4ccecf915b51");
		$sendgrid = new \SendGrid(getenv('MAIL_PASSWORD'));
		try {
		    $response = $sendgrid->send($email);
		} catch (Exception $e) {
		}
	}
}