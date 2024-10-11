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

			if(isset($substitutions['announcementId'])){
				$announcementId = strval($substitutions['announcementId']);
		 		$email->addCustomArg('announcementId', $announcementId);
		 	}

		 	if(isset($substitutions['customerId'])){
		 		$customerId = strval($substitutions['customerId']);
		 		$email->addCustomArg('customerId', $customerId);
		 	}
		}
		$email->setTemplateId($templateId);
		
		$email->setOpenTracking(true);
		$email->setClickTracking(true, true);



		$sendgrid = new \SendGrid(getenv('MAIL_PASSWORD'));
		
		// /*try {
        //     $response = $sendgrid->send($email);
        //     if ($response->statusCode() == 202) {
        //         $response = "success";
        //     } else {
        //         $response = "Failed to send email: " . $response->body();
        //     }
        // } catch (Exception $e) {
        //     $response =  $e->getMessage();
        // }*/


		try {
		   $response =  $sendgrid->send($email);
		   //print_r($response);exit;
		    $response = "success"; 
		} catch (Exception $e) {
			$response = 'fail';
		}
		return $response;
	}

	public static function welcomeMailOfNewBusinessToCustomer($emailDetail){
		$substitutions = [
		    "url" => env('APP_URL').'/welcome_provider?cid='.$emailDetail['cid'],
		];
		return SGMailService::MailDetail($emailDetail['email'],$substitutions,'d-63efeb6f57be45079692fcae3f63147c');
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

		return SGMailService::MailDetail($emailDetail['email'],$substitutions,'d-22008cb39c6a409791acb17f3064abd3' );	
	}

	public static function sendWelcomeMail($email_name){
		return SGMailService::MailDetail($email_name,$substitutions = [],'d-d42244ec709c4d91b23393393b2e05ef' );
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
			"ProviderName" => $businessdata->public_company_name,  
			"CustomerName" => @$customer->full_name,  
			"CustomerEmail" => $customer->email,  
			"TempPassword" => $password,  
			"CompanyName" => $businessdata->public_company_name,  
		    "ContactPerson" => $businessdata->first_name.' '.$businessdata->last_name,  
		    "Address" => $businessdata->company_address(),   
		    "PhoneNumber" => $businessdata->business_phone,   
		    "Email" => $businessdata->business_email,  
		    "Website" => $businessdata->business_website,
		    "companyImage" => $ImageUrl,
		    "PersonalProfile" => env('APP_URL').'userprofile/'.$businessdata->users->username,
		    "SiteUrl" => env('APP_URL'),
		    "AddInfo" => env('APP_URL').'addcustomerbusiness',
		    "ContactUs" => env('APP_URL').'contact-us',
		    "Activity" => env('APP_URL').'activities',
		];
		return SGMailService::MailDetail($customer->email,$substitutions,'d-70af5c145eca4a4f878ec680469036b7' );
	}

	public static function requestAccessMail($customer){
		
		$substitutions = [
			"ProviderName" => $customer['pName'],  
			"CustomerName" => $customer['cName'],  
			"Url" => $customer['url'],
		];

		return SGMailService::MailDetail($customer['email'],$substitutions,'d-6530330f52e8409ca171d446fbc8c248' );
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

	public static function confirmationMailForCustomer($emailDetail){
		$substitutions = [
			"CustomerName" => $emailDetail['CustomerName'], 
			"Url" => $emailDetail['Url'], 
			"BusinessName"=> $emailDetail['BusinessName'],
			"BookedBy"=> $emailDetail['BookedPerson'],
			"Participants"=> $emailDetail['ParticipantsName'],
			"date"=> $emailDetail['date'],
			"time"=> $emailDetail['time'],
			"duration"=> $emailDetail['duration'],
			"ActivitiyType"=> $emailDetail['ActivitiyType'],
			"ProgramName"=> $emailDetail['ProgramName'],
			"CategoryName"=> $emailDetail['CategoryName'],
			"CompanyName" => $emailDetail['CompanyName'], 
			"RepName" => $emailDetail['RepName'], 
			"CompanyAddress" => $emailDetail['CompanyAddress'], 
			"phone" => $emailDetail['phone'], 
			"email" => $emailDetail['email'], 
			"website" => $emailDetail['website'], 
			"MapImage" => $emailDetail['MapImage'], 
			"thingsToKnow" => $emailDetail['thingsToKnow'], 
			"CancellationText" => $emailDetail['CancellationText'], 
			"RefundText" => $emailDetail['RefundText'], 
		];

		return SGMailService::MailDetail($emailDetail['email'],$substitutions,'d-0afb04e69fe14a93abfacd6022818247');
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

	public static function sendAutoPayFaildAlertToProvider($emailDetail){
		$substitutions = [
			"CompanyImage" => $emailDetail['CompanyImage'], 
            "CompanyName"=> $emailDetail['CompanyName'],
            "ProviderName"=> $emailDetail['ProviderName'],
            "CustomerName"=> $emailDetail['CustomerName'],
            "PriceOption"=> $emailDetail['PriceOption'],
			"amount" => $emailDetail['amount'],
			"CategoryName" => $emailDetail['CategoryName'],
		];

		return SGMailService::MailDetail($emailDetail['email'],$substitutions,'d-b65d27b8ee91494ba9a4951108c103c1');
	}

	public static function sendAutoPayFaildAlertToCustomer($emailDetail){

		$substitutions = [
			'CompanyImage'=> $emailDetail['CompanyImage'],
            'CompanyName'=> $emailDetail['CompanyName'],
            'ProviderName'=> $emailDetail['ProviderName'],
            'address'=>$emailDetail['address'],
            'ProviderEmail'=> $emailDetail['ProviderEmail'],
            'phone'=> $emailDetail['phone'],
            'CustomerName'=> $emailDetail['CustomerName'],
            'PriceOption'=> $emailDetail['PriceOption'],
            'CategoryName'=>$emailDetail['CategoryName'],
            'amount'=> $emailDetail['amount'],
            'Website' => $emailDetail['Website'],
            'url'=> $emailDetail['url'],
		];

		return SGMailService::MailDetail($emailDetail['email'],$substitutions,'d-eeca6da4bb6240d48abb661c49489afa');
	}

	public static function bookingCancellationToCustomer($emailDetail){
		if($emailDetail['companydata']->logo == ''){
           	$ImageUrl = env('APP_URL').'/images/service-nofound.jpg';
        }else{
        	$ImageUrl = Storage::URL($emailDetail['companydata']->logo);
        }
		$substitutions = [
			'CustomerName'  => $emailDetail['userdata']->full_name,
			'ProviderName'  => $emailDetail['companydata']->full_name,
			'date'  => $emailDetail['date'],
			'time'  => $emailDetail['time'],
			'ProgramName'  => $emailDetail['pName'],
			'CompanyName'  => @$emailDetail['companydata']->public_company_name,
			'CompanyImage'  =>$ImageUrl,
			'CompanyAddress'  => @$emailDetail['companydata']->company_address(),
			'CompanyEmail'  => @$emailDetail['companydata']->business_email,
			'CompanyPhone'  => @$emailDetail['companydata']->business_phone,
			'CompanyWebsite'  => @$emailDetail['companydata']->business_website,
			'url'  => env('APP_URL').'/personal/manage-account',
		];

		if(@$emailDetail['mail_type'] == 'cancel'){
			$temId = 'd-dd435190a3b44ff98ec810294f65dbdb';
		}else{
			$temId = 'd-004ade55ee214ea6917945a6c5de0f0b';
		}
	
		return SGMailService::MailDetail($emailDetail['email'],$substitutions,$temId);
	}

	public static function bookingCancellationToTrainer($emailDetail){
		if($emailDetail['companydata']->logo == ''){
           	$ImageUrl = env('APP_URL').'/images/service-nofound.jpg';
        }else{
        	$ImageUrl = Storage::URL($emailDetail['companydata']->logo);
        }
		$substitutions = [
			'StaffName'  => $emailDetail['insdata']->full_name,
			'ProviderName'  => $emailDetail['companydata']->full_name,
			'date'  => $emailDetail['date'],
			'time'  => $emailDetail['time'],
			'ProgramName'  => $emailDetail['pName'],
			'CompanyName'  => @$emailDetail['companydata']->public_company_name,
			'CompanyImage'  =>$ImageUrl,
			'CompanyAddress'  => @$emailDetail['companydata']->company_address(),
			'CompanyEmail'  => @$emailDetail['companydata']->business_email,
			'CompanyPhone'  => @$emailDetail['companydata']->business_phone,
			'CompanyWebsite'  => @$emailDetail['companydata']->business_website,
			'url'  =>'',
		];
		
		if(@$emailDetail['mail_type'] == 'cancel'){
			$temId = 'd-f086a22e6a274b5cae7dec27ad318922';
		}else{
			$temId = 'd-2a8a34f6ffe1496eb2b09443af202749';
		}
		return SGMailService::MailDetail($emailDetail['email'],$substitutions,$temId);
	}

	public static function sendEmailCustomerforReminder($emailDetail){
		if($emailDetail['companydata']->logo == ''){
           	$ImageUrl = env('APP_URL').'/images/service-nofound.jpg';
        }else{
        	$ImageUrl = Storage::URL($emailDetail['companydata']->logo);
        }
		$substitutions = [
			'CustomerName'  => $emailDetail['userdata']->full_name,
			'ProviderName'  => $emailDetail['companydata']->full_name,
			'date'  => $emailDetail['date'],
			'time'  => $emailDetail['time'],
			'ProgramName'  => $emailDetail['pName'],
			'CompanyName'  => @$emailDetail['companydata']->public_company_name,
			'CompanyImage'  =>$ImageUrl,
			'CompanyAddress'  => @$emailDetail['companydata']->company_address(),
			'CompanyEmail'  => @$emailDetail['companydata']->business_email,
			'CompanyPhone'  => @$emailDetail['companydata']->business_phone,
			'CompanyWebsite'  => @$emailDetail['companydata']->business_website,
			'url'  => env('APP_URL').'/personal/orders',
		];
		
		return SGMailService::MailDetail($emailDetail['email'],$substitutions,'d-274e9b0ca44141349045585c87c9f988');
	}

	public static function sendEmailToCustomerforClaim($emailDetail){
		$substitutions = [
			'BusinessName'  => @$emailDetail['companydata']->public_company_name,
			'BusinessAddress'  => @$emailDetail['companydata']->company_address(),
			'BusinessEmail'  => @$emailDetail['email'],
			'BusinessPhone'  => @$emailDetail['companydata']->business_phone,
			'url'  => env('APP_URL').'/claim-your-business',
		];
		
		SGMailService::MailDetail($emailDetail['email'],$substitutions,'d-738442a2400549d99833777bdb13bee0');
		$substitutions1 = [
			'profile'  => env('APP_URL').'/personal/company/create?company='.@$emailDetail['companydata']->id,
		];

		SGMailService::MailDetail($emailDetail['email'],$substitutions,'d-63efeb6f57be45079692fcae3f63147c');
	}

	public static function creditCardExpiredORExpringToUser($emailDetail){
		$substitutions = [
			'CustomerName'  => $emailDetail['full_name'],
			'card'  => $emailDetail['card'],
			'brand'  => $emailDetail['brand'],
			'website'  => env('APP_URL'),
			'url'  => env('APP_URL').'personal/credit-cards',
		];
		SGMailService::MailDetail($emailDetail['email'],$substitutions,$emailDetail['temp_id']);
	}

	public static function creditCardExpiredToCustomer($emailDetail){
		if($emailDetail['companydata']->logo == ''){
           	$ImageUrl = env('APP_URL').'/images/service-nofound.jpg';
        }else{
        	$ImageUrl = Storage::URL($emailDetail['companydata']->logo);
        }
		$substitutions = [
			'CustomerName'  => $emailDetail['userdata']->full_name,
			'card'  => $emailDetail['card'],
			'date'  => $emailDetail['date'],
			'CompanyName'  => @$emailDetail['companydata']->public_company_name,
			'CompanyImage'  =>$ImageUrl,
			'address'  => @$emailDetail['companydata']->company_address(),
			'CompanyEmail'  => @$emailDetail['companydata']->business_email,
			'phone'  => @$emailDetail['companydata']->business_phone,
			'website'  => env('APP_URL'),
			'url'  => env('APP_URL').'personal/credit-cards',
		];
		SGMailService::MailDetail($emailDetail['email'],$substitutions,'d-29d9884b534a491f9687f67bf5f3d7b0');
	}

	public static function creditCardExpiredToProvider($emailDetail){
		
		$substitutions = [
			'CustomerName'  => $emailDetail['userdata']->full_name,
			'ProviderName'  => $emailDetail['companydata']->full_name,
			'card'  => $emailDetail['card'],
			'date'  => $emailDetail['date'],
			'CompanyName'  => @$emailDetail['companydata']->public_company_name,
			'CompanyEmail'  => @$emailDetail['companydata']->business_email,
		];

		SGMailService::MailDetail($emailDetail['email'],$substitutions,'d-cf063fc80c8c4efc92e8a59eade88ac1');
	}

	public static function creditCardExpiringToCustomer($emailDetail){
		if($emailDetail['companydata']->logo == ''){
           	$ImageUrl = env('APP_URL').'/images/service-nofound.jpg';
        }else{
        	$ImageUrl = Storage::URL($emailDetail['companydata']->logo);
        }
		$substitutions = [
			'CustomerName'  => $emailDetail['userdata']->full_name,
			'card'  => $emailDetail['card'],
			'date'  => $emailDetail['date'],
			'brand'  => $emailDetail['brand'],
			'CompanyName'  => @$emailDetail['companydata']->public_company_name,
			'CompanyImage'  =>$ImageUrl,
			'address'  => @$emailDetail['companydata']->company_address(),
			'CompanyEmail'  => @$emailDetail['companydata']->business_email,
			'phone'  => @$emailDetail['companydata']->business_phone,
			'website'  => env('APP_URL'),
			'ProviderWebsite'  =>@$emailDetail['companydata']->business_website,
			'url'  => env('APP_URL').'personal/credit-cards',
		];
		SGMailService::MailDetail($emailDetail['email'],$substitutions,'d-2219dd86d875474ebf5584b4aaf5d850');
	}

	public static function creditCardExpiringToProvider($emailDetail){
		if($emailDetail['companydata']->logo == ''){
           	$ImageUrl = env('APP_URL').'/images/service-nofound.jpg';
        }else{
        	$ImageUrl = Storage::URL($emailDetail['companydata']->logo);
        }
		$substitutions = [
			'CompanyImage'  =>$ImageUrl,
			'CustomerName'  => $emailDetail['userdata']->full_name,
			'ProviderName'  => $emailDetail['companydata']->full_name,
			'card'  => $emailDetail['card'],
			'date'  => $emailDetail['date'],
			'brand'  => $emailDetail['brand'],
			'CompanyName'  => @$emailDetail['companydata']->public_company_name,
			'CompanyEmail'  => @$emailDetail['companydata']->business_email,
		];
		SGMailService::MailDetail($emailDetail['email'],$substitutions,'d-0f5d87c2292941aab391e24c7f7a5751');
	}

	public static function leaveAReview($emailDetail){
		$substitutions = [
			'ProviderName'  => $emailDetail['companyName'],
			'ReviewUrl'  =>env('APP_URL').'businessprofile/'.strtolower(str_replace(' ', '', $emailDetail['companyName'])).'/'.$emailDetail['cid'],
			'ActivityUrl'  =>env('APP_URL').'activities',
		];
		SGMailService::MailDetail($emailDetail['email'],$substitutions,'d-1906577086e847dba0d002c1b2854ed1');
    }

    public static function sendAnnouncementEmail($emailDetail){
    	$substitutions = [
			'ProviderName'  => $emailDetail['ProviderName'],
			'Text'  => $emailDetail['Text'],
			'announcementId'  => $emailDetail['announcementId'],
			'customerId'  => $emailDetail['customerId'],
		];

		SGMailService::MailDetail($emailDetail['email'],$substitutions,'d-ffb8486a3e2343868f38b329ed48f397');
    }
}