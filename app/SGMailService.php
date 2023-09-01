<?php
namespace App;

use SendGrid\Mail\Mail;
use Illuminate\Database\Eloquent\Model;
use Storage;

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

	public static function sendBookingReceipt($emailDetail){
		$notes = @$emailDetail['getreceipemailtbody']['notes'];
		if($notes == ''){
			$notes = "Thank you for doing business with us!";
		}
		$substitutions = [
			"provider_Name" => $emailDetail['getreceipemailtbody']['provider_Name'],  
		    "booking_ID" =>$emailDetail['getreceipemailtbody']['booking_ID'],  
		    "program_Name" => $emailDetail['getreceipemailtbody']['program_Name'],   
		    "category" => $emailDetail['getreceipemailtbody']['category'],   
		    "price_Option" => $emailDetail['getreceipemailtbody']['price_Option'],  
		    "Sessions" => $emailDetail['getreceipemailtbody']['sessions'],  
		    "membership" => $emailDetail['getreceipemailtbody']['membership'],  
		    "quantity" => $emailDetail['getreceipemailtbody']['quantity'],  
		    "participants" => $emailDetail['getreceipemailtbody']['participate'],  
		    "activity_Type" => $emailDetail['getreceipemailtbody']['activity_Type'],  
		    "Service_Type" => $emailDetail['getreceipemailtbody']['service_Type'],  
		    "membership_Duration" => $emailDetail['getreceipemailtbody']['membership_Duration'],  
		    "purchase_Date" => $emailDetail['getreceipemailtbody']['purchase_Date'],  
		    "membership_Activation_Date" => $emailDetail['getreceipemailtbody']['membership_Activation_Date'],  
		    "membership_Expiration" => $emailDetail['getreceipemailtbody']['membership_Expiration'],  
		    "price" => $emailDetail['getreceipemailtbody']['price'],  
		    "discount" => $emailDetail['getreceipemailtbody']['discount'],  
		    "total" => $emailDetail['getreceipemailtbody']['total'],
		    "bookingUrl" => $emailDetail['getreceipemailtbody']['bookingUrl'],
		    "companyImage" => @$emailDetail['getreceipemailtbody']['companyImage'],
		    "message" => $notes,
		];

		return SGMailService::MailDetail($emailDetail['email'],$substitutions,'d-22008cb39c6a409791acb17f3064abd3');	
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
        	$ImageUrl = Storage::URL($businessimg);
        }

		$substitutions = [
			"providerName" => $businessdata->dba_business_name,  
			"Customer_Name" => @$customer->full_name,  
			"Customer_Email" => $customer->email,  
			"temppassword" => $password,  
			"Company_Name" => $businessdata->dba_business_name,  
		    "ContactPerson" => $businessdata->first_name.' '.$businessdata->last_name,  
		    "address" => $businessdata->company_address(),   
		    "PhoneNumber" => $businessdata->business_phone,   
		    "Email" => $businessdata->business_email,  
		    "website" => $businessdata->business_website,
		    "Company_Image" => $ImageUrl,
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

	public static function sendresetemail($emailDetail){

		$index = strpos($emailDetail['email'], '@');
		$substitutions = [
			"customername" => $emailDetail['customerName'], 
			"Url" => $emailDetail['link'], 
			"Email"=> substr($emailDetail['email'], 0, 1).'***********@'.substr($emailDetail['email'], $index + strlen('@'))
		];

		return SGMailService::MailDetail($emailDetail['email'],$substitutions,'d-78e53ff00cab476b9fd398c5ac88c8f3');
	}

	public static function confirmationMail($emailDetail){
		$substitutions = [
			"CustomerName" => $emailDetail['CustomerName'], 
			"Url" => $emailDetail['Url'], 
			"BusinessName"=> $emailDetail['BusinessName'],
			"BookedPerson"=> $emailDetail['BookedPerson'],
			"ParticipantsName"=> $emailDetail['ParticipantsName'],
			"date"=> $emailDetail['date'],
			"time"=> $emailDetail['time'],
			"duration"=> $emailDetail['duration'],
			"ActivitiyType"=> $emailDetail['ActivitiyType'],
			"ProgramName"=> $emailDetail['ProgramName'],
			"CategoryName"=> $emailDetail['CategoryName'],
		];

		return SGMailService::MailDetail($emailDetail['email'],$substitutions,'d-7a39c17eac4a45f5b2bbf030c5c82f4f');
	}

	public static function sendReminderOfSessionExpireToCustomer($emailDetail){

		$substitutions = [
			"CustomerName" => $emailDetail['CustomerName'], 
            "ProviderName"=> $emailDetail['ProviderName'],
            "CategoryName"=> $emailDetail['CategoryName'],
            "PriceOptionName"=> $emailDetail['PriceOptionName'],
			"ReNewUrl" => $emailDetail['ReNewUrl'],
			"ProfileUrl" => $emailDetail['ProfileUrl'],
			"CompleteDate" => $emailDetail['CompleteDate'],
			"ExpirationDate" => $emailDetail['ExpirationDate'],
			"ProviderPhoneNumber" => $emailDetail['ProviderPhoneNumber'],
			"ProviderEmail" => $emailDetail['ProviderEmail'],
			"ProviderAddress" => $emailDetail['ProviderAddress'],
		];

		return SGMailService::MailDetail($emailDetail['email'],$substitutions,'d-3500159ca821409e8f8e68c4cd39e2ab');		
	}

	public static function sendReminderOfSessionExpireToProvider($emailDetail){

		$substitutions = [
            "CustomerName" => $emailDetail['CustomerName'], 
            "ProviderName"=> $emailDetail['ProviderName'],
            "CategoryName"=> $emailDetail['CategoryName'],
            "PriceOptionName"=> $emailDetail['PriceOptionName'],
		];
		return SGMailService::MailDetail($emailDetail['email'],$substitutions,'d-23e938e2491c4d128d78d704787b3809');		
	}

	public static function sendReminderOfSessionOrMembershipAboutToExpireToCustomer($emailDetail){
		$substitutions = [
			"CustomerName" => $emailDetail['CustomerName'], 
            "ProviderName"=> $emailDetail['ProviderName'],
            "ProgramName"=> $emailDetail['ProgramName'],
            "CategoryName"=> $emailDetail['CategoryName'],
            "PriceOptionName"=> $emailDetail['PriceOptionName'],
			"ReNewUrl" => $emailDetail['ReNewUrl'],
			"ProfileUrl" => $emailDetail['ProfileUrl'],
			"ExpirationDate" => $emailDetail['ExpirationDate'],
			"ProviderPhoneNumber" => $emailDetail['ProviderPhoneNumber'],
			"ProviderEmail" => $emailDetail['ProviderEmail'],
			"ProviderAddress" => $emailDetail['ProviderAddress'],
		];

		if($emailDetail['for'] == 'membership'){
			$TemplateId = "d-40dc2e0d871b4a21b18e4b7e715c1ecb";
		}else{
			$TemplateId = "d-9fd81ddcd60b4ebea9406c5d523bed8a";
		}

		return SGMailService::MailDetail($emailDetail['email'],$substitutions,$TemplateId);
	}

	public static function sendReminderOfMembershipExpireToProvider($emailDetail){
		
		$substitutions = [
			"CustomerName" => $emailDetail['CustomerName'], 
            "ProviderName"=> $emailDetail['ProviderName'],
            "ProgramName"=> $emailDetail['ProgramName'],
            "CategoryName"=> $emailDetail['CategoryName'],
            "PriceOptionName"=> $emailDetail['PriceOptionName'],
			"ExpirationDate" => $emailDetail['ExpirationDate'],
		];
		return SGMailService::MailDetail($emailDetail['email'],$substitutions,'d-db32cc27830244998a1467f4984a0b20');
	}

	public static function sendReminderOfMembershipExpireToCustomer($emailDetail){
		$substitutions = [
			"CustomerName" => $emailDetail['CustomerName'], 
            "ProviderName"=> $emailDetail['ProviderName'],
            "ProgramName"=> $emailDetail['ProgramName'],
            "CategoryName"=> $emailDetail['CategoryName'],
            "PriceOptionName"=> $emailDetail['PriceOptionName'],
			"ReNewUrl" => $emailDetail['ReNewUrl'],
			"ProfileUrl" => $emailDetail['ProfileUrl'],
			"ExpirationDate" => $emailDetail['ExpirationDate'],
			"ProviderPhoneNumber" => $emailDetail['ProviderPhoneNumber'],
			"ProviderEmail" => $emailDetail['ProviderEmail'],
			"ProviderAddress" => $emailDetail['ProviderAddress'],
		];

		return SGMailService::MailDetail($emailDetail['email'],$substitutions,'d-b67277aa0c784091ab87ddd2ab5bc9ea');
	}

	public static function sendTermsMail($emailDetail){
		$substitutions = [
			"companyImage" => $emailDetail['companyImage'], 
            "companyName"=> $emailDetail['companyName'],
            "companyAddress"=> $emailDetail['companyAddress'],
            "companyEmail"=> $emailDetail['companyEmail'],
            "companyPhone"=> $emailDetail['companyPhone'],
			"termsName" => $emailDetail['termsName'],
			"termsText" => $emailDetail['termsText'],
		];

		return SGMailService::MailDetail($emailDetail['email'],$substitutions,'d-b57b5ad44f744f688265cb0d078a9398');
	}
}