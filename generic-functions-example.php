<?php
function notifyAdminViaMail($mailSubject,$emailBody)
{
	$mailUsername = "Kiran Paul V.J.";
	$toEmail = "xxx@gmail.com";
	//error_reporting(E_STRICT);
	date_default_timezone_set('America/Toronto');
	
	require_once('slibs/mail/class.phpmailer.php');
	//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
	
	$mail             = new PHPMailer();
	
	//$body             = file_get_contents('contents.html');
	//$body             = eregi_replace("[\]",'',$body);
	
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host       = "mail.yourdomain.com"; // SMTP server
	$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
											   // 1 = errors and messages
											   // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
	$mail->Username   = "xxx@gmail.com";  // GMAIL username
	$mail->Password   = "xxx";            // GMAIL password
	
	$mail->SetFrom('xxx@gmail.com', 'GetSpriteXY - No Reply');
	
	$mail->AddReplyTo('xxx@gmail.com', 'GetSpriteXY - No Reply');
	
	$mail->Subject    = $mailSubject;
	
	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	
	$mail->MsgHTML($emailBody);
	
	$address = $toEmail;
	$mail->AddAddress($address, $mailUsername);
	
	//$mail->AddAttachment("images/phpmailer.gif");      // attachment
	//$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
	$mail->Send();
	/*if(!$mail->Send()) {
	  echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
	  echo "Message sent!";
	}*/
}?>