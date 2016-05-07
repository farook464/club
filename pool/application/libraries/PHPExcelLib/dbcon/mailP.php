<?php 
require_once($_SERVER['DOCUMENT_ROOT'].'/pay/easypayconfig.php');
require epEMAILPATH.'/PHPMailerAutoload.php';

function mailsetupreset(){

$mail = new PHPMailer;

$mail->isSMTP();                                   // Set mailer to use SMTP
$mail->Host = 'mail.findmyfare.com';  // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'finance@findmyfare.com';                            // SMTP username
$mail->Password = 'Dream737';                           // SMTP password
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted

$mail->From = 'finance@findmyfare.com';
$mail->FromName = 'Findmyfare';
$mail->WordWrap = 50;  

$mail->isHTML(true); 

$mail->addBCC('easypaymail@findmyfare.com');

return ($mail);
}


function sendpasswordmail($payFID, $emailadd)
{

$mail = mailsetupreset();

$mail->addAddress($emailadd, $emailadd);  // Add a recipient

//$mail->addBCC('suren@findmyfare.com','suren');
$mail->addReplyTo('suren@findmyfare.com', 'suren'); 

$msg='Dear '.$emailadd.',<br><br>
Please kindly use the following link to reset your password <a href="https://pay.findmyfare.com/pay/resetstep2.php?id='.$payFID.'">click here</a><br>
(if your unable to click on the link please copy the following url into your browser and proceed. https://pay.findmyfare.com/pay/resetstep2.php?id='.$payFID.'  
             )';




$mail->Subject = 'Easypay Password Reset';
$mail->Body    = $msg;
$mail->MsgHTML($msg);

$messReturn='No Value';

	if(!$mail->send()) {
	   $messReturn= ' Email could not be sent.<br><br>Mailer Error: ' . $mail->ErrorInfo;
	}
	else
	{
		$messReturn= '<br> Email has been sent';
	}
	
	return $messReturn;
}


function sendpasswordchanged($emailadd)
{

$mail = mailsetupreset();

$mail->addAddress($emailadd, $emailadd);  // Add a recipient

$mail->addBCC('suren@findmyfare.com','suren');
$mail->addReplyTo('suren@findmyfare.com', 'suren'); 

$msg='Dear '.$emailadd.',<br><br>
This is to let you know that your password has been reset successfully, if you did not make this change please inform IT Department Immediately.<br>
your account has been set inactive, soon as we verify the changes , we will make it active again. ';




$mail->Subject = 'Easypay Password Changed';
$mail->Body    = $msg;
$mail->MsgHTML($msg);

$messReturn='No Value';

	if(!$mail->send()) {
	   $messReturn= ' Email could not be sent.<br><br>Mailer Error: ' . $mail->ErrorInfo;
	}
	else
	{
		$messReturn= '<br> Email has been sent';
	}
	
	return $messReturn;
}


?>