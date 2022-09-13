<?php

	function DoEmail($Addresses,$Subject,$Body,$Attachment,$From,$FromName)
	{ 
		require_once("class.phpmailer.php"); 
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->Host = 'mail.fitnessity.co';
		$mail->SMTPAuth = false;
		$mail->Username = 'noreply@fitnessity.co';
		$mail->Password = 'NBERRdk&Vb*n';
		$mail->Port = '25';
		$mail->From = $From;
		$mail->FromName = $FromName;
		$Addresses=explode(",",$Addresses);
		foreach($Addresses as $nm=>$val)
			$mail->AddAddress(trim($val),'');
		$mail->Subject = $Subject;
		if($Attachment!='')
			$mail->AddAttachment($Attachment['tmp_name'],$Attachment['name']);
		$mail->Body = $Body;
		$mail->IsHTML(true);
		return $mail->Send();

	}
?>