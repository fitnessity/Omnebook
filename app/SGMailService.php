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

	public static function sendWelcomeMailToCustomer($id,$business_id,$password){
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
			"Customer_Name" => @$customer->fname.' '.@$customer->lname,  
			"Customer_Email" => $customer->email,  
			"temppassword" => $password,  
			"Company_Name" => $businessdata->company_name,  
		    "ContactPerson" => $businessdata->first_name.' '.$businessdata->last_name,  
		    "address" => $businessdata->company_address(),   
		    "PhoneNumber" => $businessdata->business_phone,   
		    "Email" => $businessdata->business_email,  
		    "website" => $businessdata->business_website,
		    "ProviderBusinessLogo" => $ImageUrl,
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

	public static function requestAccessMail($customer){
		$email = new Mail();
		$email->setFrom(getenv('MAIL_FROM_ADDRESS'), "Fitnessity Support");
		
		$email->addTo(
		    $customer['email'],
		);

		$substitutions = [
			"ProviderName" => $customer['pName'],  
			"CustomerName" => $customer['cName'],  
			"Url" => $customer['url'],
		];

		$email->addDynamicTemplateDatas($substitutions);

		$email->setTemplateId("d-6530330f52e8409ca171d446fbc8c248");
		$sendgrid = new \SendGrid(getenv('MAIL_PASSWORD'));
		try {
		    $sendgrid->send($email);
		    $response = "success"; 
		} catch (Exception $e) {
			$response = 'fail';
		}
		return $response;
	}

	public static function sendresetemail($email_detail){

		$email = new Mail();
		$email->setFrom(getenv('MAIL_FROM_ADDRESS'), "Fitnessity Support");
		
		$email->addTo(
		    $email_detail['email'],
		);

		$index = strpos($email_detail['email'], '@');
		$substitutions = [
			"customername" => $email_detail['customerName'], 
			"Url" => $email_detail['link'], 
			"Email"=> substr($email_detail['email'], 0, 1).'***********@'.substr($email_detail['email'], $index + strlen('@'))
		];

		$email->addDynamicTemplateDatas($substitutions);

		$email->setTemplateId("d-78e53ff00cab476b9fd398c5ac88c8f3");
		$sendgrid = new \SendGrid(getenv('MAIL_PASSWORD'));
		try {
		    $sendgrid->send($email);
		    $response = "success"; 
		} catch (Exception $e) {
			$response = 'fail';
		}
		return $response;
	}

	public static function confirmationMail($email_detail){
		$email = new Mail();
		$email->setFrom(getenv('MAIL_FROM_ADDRESS'), "Fitnessity Support");
		
		$email->addTo(
		    $email_detail['email'],
		);

		$substitutions = [
			"CustomerName" => $email_detail['CustomerName'], 
			"Url" => $email_detail['Url'], 
			"BusinessName"=> $email_detail['BusinessName'],
			"BookedPerson"=> $email_detail['BookedPerson'],
			"ParticipantsName"=> $email_detail['ParticipantsName'],
			"date"=> $email_detail['date'],
			"time"=> $email_detail['time'],
			"duration"=> $email_detail['duration'],
			"ActivitiyType"=> $email_detail['ActivitiyType'],
			"ProgramName"=> $email_detail['ProgramName'],
			"CategoryName"=> $email_detail['CategoryName'],
		];

		$email->addDynamicTemplateDatas($substitutions);

		$email->setTemplateId("d-7a39c17eac4a45f5b2bbf030c5c82f4f");
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