<?php
/*// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
if(mail("nipavadhavana@gmail.com","testmail",$msg))
	echo 'send';
else
	echo 'fail';
exit;*/
?> 
<?php
echo 'Email:';
include('fun.php');

$mail_subject ='Contact Mail for Fitnessity';
$mail_to = 'nipavadhavana@gmail.com';
$mail_from = 'noreply@fitnessity.co';
$mail_body='<div style="background:#ED3237; border:1px solid #000;width:630px">
	<div style="color:#fff; font:bold 16px Arial, Helvetica, sans-serif; padding:10px 0 10px 8px">Contact Mail for Fitnessity</div>
		<div style="background:#FFFFFF; border:1px solid #000; margin:0 5px 5px; padding:15px 10px 5px;">
			sdkldsk lkfdkljfkl klfkljfd
		</div>	
	</div>';
	if(DoEmail($mail_to,$mail_subject,trim($mail_body),"",$mail_from,'Contact Mail for Fitnessity'))
		echo "Success";
	else
	{
		echo "Fail";
	}
?>