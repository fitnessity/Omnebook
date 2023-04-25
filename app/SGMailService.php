<?php
namespace App;

use SendGrid\Mail\Mail;
use Illuminate\Database\Eloquent\Model;

class SGMailService{

	public static function MailDetail($sendemail,$substitutions,$templateId){
		$email = new Mail();
		$email->setFrom(getenv('MAIL_FROM_ADDRESS'), "Fitnessity Support");
		
		$email->addTo(
		    $sendemail,
		);
		if(!empty($substitutions)){
			$email->addDynamicTemplateDatas($substitutions);
		}
		$email->setTemplateId($templateId);
		
		$sendgrid = new \SendGrid(getenv('MAIL_PASSWORD'));
		try {
		    $sendgrid->send($email);
		    $response = "success"; 
		} catch (Exception $e) {
			$response = 'fail';
		}
		return $response;
	}

	public static function sendBookingReceipt($email_detail){

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

		return SGMailService::MailDetail($email_detail['email'],$substitutions,'d-22008cb39c6a409791acb17f3064abd3');	
	}

	public static function sendWelcomeMail($email_name){
		return SGMailService::MailDetail($email_name,$substitutions = [],'d-d42244ec709c4d91b23393393b2e05ef');
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
		return SGMailService::MailDetail($customer->email,$substitutions,'d-70af5c145eca4a4f878ec680469036b7');
	}

	public static function requestAccessMail($customer){
		
		$substitutions = [
			"ProviderName" => $customer['pName'],  
			"CustomerName" => $customer['cName'],  
			"Url" => $customer['url'],
		];

		return SGMailService::MailDetail($customer['email'],$substitutions,'d-6530330f52e8409ca171d446fbc8c248');
	}

	public static function sendresetemail($email_detail){

		$index = strpos($email_detail['email'], '@');
		$substitutions = [
			"customername" => $email_detail['customerName'], 
			"Url" => $email_detail['link'], 
			"Email"=> substr($email_detail['email'], 0, 1).'***********@'.substr($email_detail['email'], $index + strlen('@'))
		];

		return SGMailService::MailDetail($email_detail['email'],$substitutions,'d-78e53ff00cab476b9fd398c5ac88c8f3');
	}

	public static function confirmationMail($email_detail){
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

		return SGMailService::MailDetail($email_detail['email'],$substitutions,'d-7a39c17eac4a45f5b2bbf030c5c82f4f');
	}

	public static function sendReminderOfSessionExpireToCustomer($email_detail){

		$substitutions = [
			"CustomerName" => $email_detail['CustomerName'], 
            "ProviderName"=> $email_detail['ProviderName'],
            "CategoryName"=> $email_detail['CategoryName'],
            "PriceOptionName"=> $email_detail['PriceOptionName'],
			"ReNewUrl" => $email_detail['ReNewUrl'],
			"ProfileUrl" => $email_detail['ProfileUrl'],
			"CompleteDate" => $email_detail['CompleteDate'],
			"ExpirationDate" => $email_detail['ExpirationDate'],
			"ProviderPhoneNumber" => $email_detail['ProviderPhoneNumber'],
			"ProviderEmail" => $email_detail['ProviderEmail'],
			"ProviderAddress" => $email_detail['ProviderAddress'],
		];

		return SGMailService::MailDetail($email_detail['email'],$substitutions,'d-3500159ca821409e8f8e68c4cd39e2ab');		
	}

	public static function sendReminderOfSessionExpireToProvider($email_detail){

		$substitutions = [
            "CustomerName" => $email_detail['CustomerName'], 
            "ProviderName"=> $email_detail['ProviderName'],
            "CategoryName"=> $email_detail['CategoryName'],
            "PriceOptionName"=> $email_detail['PriceOptionName'],
		];
		return SGMailService::MailDetail($email_detail['email'],$substitutions,'d-23e938e2491c4d128d78d704787b3809');		
	}

	public static function sendReminderOfSessionOrMembershipAboutToExpireToCustomer($email_detail){
		$substitutions = [
			"CustomerName" => $email_detail['CustomerName'], 
            "ProviderName"=> $email_detail['ProviderName'],
            "ProgramName"=> $email_detail['ProgramName'],
            "CategoryName"=> $email_detail['CategoryName'],
            "PriceOptionName"=> $email_detail['PriceOptionName'],
			"ReNewUrl" => $email_detail['ReNewUrl'],
			"ProfileUrl" => $email_detail['ProfileUrl'],
			"ExpirationDate" => $email_detail['ExpirationDate'],
			"ProviderPhoneNumber" => $email_detail['ProviderPhoneNumber'],
			"ProviderEmail" => $email_detail['ProviderEmail'],
			"ProviderAddress" => $email_detail['ProviderAddress'],
		];

		if($email_detail['for'] == 'membership'){
			$TemplateId = "d-40dc2e0d871b4a21b18e4b7e715c1ecb";
		}else{
			$TemplateId = "d-9fd81ddcd60b4ebea9406c5d523bed8a";
		}

		return SGMailService::MailDetail($email_detail['email'],$substitutions,$TemplateId);
	}

	public static function sendReminderOfMembershipExpireToProvider($email_detail){
		
		$substitutions = [
			"CustomerName" => $email_detail['CustomerName'], 
            "ProviderName"=> $email_detail['ProviderName'],
            "ProgramName"=> $email_detail['ProgramName'],
            "CategoryName"=> $email_detail['CategoryName'],
            "PriceOptionName"=> $email_detail['PriceOptionName'],
			"ExpirationDate" => $email_detail['ExpirationDate'],
		];
		return SGMailService::MailDetail($email_detail['email'],$substitutions,'d-db32cc27830244998a1467f4984a0b20');
	}

	public static function sendReminderOfMembershipExpireToCustomer($email_detail){
		$substitutions = [
			"CustomerName" => $email_detail['CustomerName'], 
            "ProviderName"=> $email_detail['ProviderName'],
            "ProgramName"=> $email_detail['ProgramName'],
            "CategoryName"=> $email_detail['CategoryName'],
            "PriceOptionName"=> $email_detail['PriceOptionName'],
			"ReNewUrl" => $email_detail['ReNewUrl'],
			"ProfileUrl" => $email_detail['ProfileUrl'],
			"ExpirationDate" => $email_detail['ExpirationDate'],
			"ProviderPhoneNumber" => $email_detail['ProviderPhoneNumber'],
			"ProviderEmail" => $email_detail['ProviderEmail'],
			"ProviderAddress" => $email_detail['ProviderAddress'],
		];

		return SGMailService::MailDetail($email_detail['email'],$substitutions,'d-b67277aa0c784091ab87ddd2ab5bc9ea');
	}
}