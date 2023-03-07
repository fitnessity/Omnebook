<?php
namespace App;

use SendGrid\Mail\Mail;
use Illuminate\Database\Eloquent\Model;

class SGMailService{

	public static function sendBookingReceipt($email_detail){
		$email = new Mail();
		$email->setFrom(getenv('MAIL_FROM_ADDRESS'), "Fitnessity Support");
		
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
		    "total" => $email_detail['getreceipemailtbody']['total'],
		    "bookingUrl" => $email_detail['getreceipemailtbody']['bookingUrl'],
		];

		$email->addDynamicTemplateDatas($substitutions);

		/*$email->addDynamicTemplateDatas( 
		  	$email_detail['getreceipemailtbody'],
		  
		);*/
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


	public static function sendWelcomeMail($email_name){
		$email = new Mail();
		$email->setFrom(getenv('MAIL_FROM_ADDRESS'), "Fitnessity Support");
		
		$email->addTo(
		    $email_name,
		);
		$email->setTemplateId("d-d42244ec709c4d91b23393393b2e05ef");
		$sendgrid = new \SendGrid(getenv('MAIL_PASSWORD'));
		try {
		    $sendgrid->send($email);
		     $response = "success"; 
		} catch (Exception $e) {
			$response = 'fail';
		}
		return $response;
	}


	public static function sendWelcomeMailToCustomer($id,$business_id){
		$customer = Customer::findOrFail($id);
		$businessdata = CompanyInformation::findOrFail($business_id);

		$businessimg = $businessdata->logo;
		if( $businessimg == ''){
           	$ImageUrl = env('APP_URL').'/images/service-nofound.jpg';
        }else{
        	$ImageUrl = env('APP_URL').'/uploads/profile_pic/thumb/'.$businessimg;
        }

		$email = new Mail();
		$email->setFrom(getenv('MAIL_FROM_ADDRESS'), "Fitnessity Support");
		
		$email->addTo(
		    $customer->email,
		);

		$substitutions = [
			"providerName" => $businessdata->company_name,  
			"CustomerName" => @$customer->fname.' '.@$customer->lname,  
			"CompanyName" => $businessdata->company_name,  
		    "ContactPerson" => $businessdata->first_name.' '.$businessdata->last_name,  
		    "address" => $businessdata->company_address(),   
		    "PhoneNumber" => $businessdata->business_phone,   
		    "Email" => $businessdata->business_email,  
		    "website" => $businessdata->business_website,
		    "ImageUrl" => $ImageUrl,
		    "url" => $businessdata->users->username
		];

		$email->addDynamicTemplateDatas($substitutions);
		$email->setTemplateId("d-70af5c145eca4a4f878ec680469036b7");
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