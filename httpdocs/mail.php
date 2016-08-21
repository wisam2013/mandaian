<?php

function sendmail($attachment) {
  ini_set('display_errors', 1); error_reporting(E_ALL); 
  /**
  * This example shows settings to use when sending via Google's Gmail servers.
  */
  //SMTP needs accurate times, and the PHP time zone MUST be set
  //This should be done in your php.ini, but this is how to do it if you don't have access to that
  date_default_timezone_set('Etc/UTC');
  require 'lib/PHPMailer/PHPMailerAutoload.php';
  //Create a new PHPMailer instance
  $mail = new PHPMailer;
  //Tell PHPMailer to use SMTP
  $mail->isSMTP();
  //Enable SMTP debugging
  // 0 = off (for production use)
  // 1 = client messages
  // 2 = client and server messages
  $mail->SMTPDebug = 2;
  //Ask for HTML-friendly debug output
  $mail->Debugoutput = 'html';
  //Set the hostname of the mail server
  $mail->Host = 'smtp.gmail.com';
  // use
  // $mail->Host = gethostbyname('smtp.gmail.com');
  // if your network does not support SMTP over IPv6
  //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
  $mail->Port = 587;
  //Set the encryption system to use - ssl (deprecated) or tls
  $mail->SMTPSecure = 'tls';
  //Whether to use SMTP authentication
  $mail->SMTPAuth = true;
  //Username to use for SMTP authentication - use full email address for gmail
  $mail->Username = "phub4reu@gmail.com";
  //Password to use for SMTP authentication
  $mail->Password = "Ple12345";
  //Set who the message is to be sent from
  $mail->setFrom('phub4reu@gmail.com', 'phub4reu');
  //Set an alternative reply-to address
  $mail->addReplyTo('phub4reu@gmail.com', 'phub4reu');
  //Set who the message is to be sent to
  $mail->addAddress('michiel.pleijte@gmail.com', 'Michiel Pleijte');
  //Set the subject line
  $mail->Subject = 'PHPMailer GMail SMTP test';
  //Read an HTML message body from an external file, convert referenced images to embedded,
  //convert HTML into a basic plain-text alternative body
  $mail->msgHTML(file_get_contents('lib/PHPMailer/examples/contents.html'), dirname(__FILE__));
  //Replace the plain text body with one created manually
  $mail->AltBody = 'This is a plain-text message body';

  $text = "SOME;TEXT;INDEED";

  //Attach an image file
  //$mail->addAttachment('PHPMailer/examples/images/phpmailer_mini.png');
  $mail->AddStringAttachment($attachment,'justAFilename','base64', 'text/csv');
  $mail->addAttachment($text);
  //send the message, check for errors
  if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
  } else {
    echo "Message sent!";
  }
}

?>