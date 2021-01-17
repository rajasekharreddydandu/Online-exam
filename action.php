<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'phpmailer/vendor/autoload.php';

if(isset($_POST['email_data'])){

	
$output ='';
  foreach($_POST['email_data'] as $row)
    {
		$mail = new PHPMailer(true);

		//$mail->SMTPDebug = 3;                                 // Enable verbose debug output
		//$mail->CharSet="UTF-8";                               // Put right encoding here  
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp.gmail.com';  					  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'rajasekharreddy9581@gmail.com';                  // SMTP username
		$mail->Password = 'SP9581raj@';                // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to
		$mail->isHTML(true); 								  // Set email format to HTML

		
		$mail->setFrom('rajasekharreddy9581@gmail.com', 'PhpMailer');
		$mail->addReplyTo('rajasekharreddy9581@gmail.com', 'Information');
		$mail->addAddress($row['email'],$row['name']);     // Add a recipient
		// $mail->addAddress('ellen@example.com');               // Name is optional
		 
		// $mail->addCC('cc@example.com');
		// $mail->addBCC('bcc@example.com');
		$mail->WordWrap   = 50; // set word wrap
		//Attachments
		//$filename1='test1.pdf';
		//$mail->addAttachment('C:\Users\sivareddy\Downloads\image123.jpg');         // Add attachments
		
		//$mail->addAttachment("uploads/1 (1).jpg");    // Optional name
        
		$mail->addAttachment("uploads/1.jpg","Pink Rose");
		$mail->addAttachment("uploads/2.jpg","Rose");
		
		// Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = 'Here is the subject';
		$mail->Body    = '<h2 style="color:skyblue">This is the HTML message body <b>in bold!</b></h2>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		$result = $mail->send();
		if($result['code']== '400')
		{
			$output = html_entity_decode($result['full_error']);
		}
    }
    if($output == '')
	{
		echo 'ok';
	}
	else
	{
		echo $output;
	}

}


?>