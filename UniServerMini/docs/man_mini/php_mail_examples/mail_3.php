<?php
$eol  = PHP_EOL;                    // Use a PHP end of line constant

$to = "somebody@example.com";       // Send mail to address
$subject = "HTML email example";    // Subject text

$headers  = '';                                    // Clear text string
$headers .= "From: webmaster@example.com" . $eol;  // From header
$headers .= "Reply-To: me@example.com".$eol;       // Header Option
$headers .= "Return-Path: me2@example.com".$eol;   // Header Option

// Always set MIME version and content-type when sending HTML email
$headers .= "MIME-Version: 1.0".$eol;                           
$headers .= "Content-Type: text/html; charset=ISO-8859-1".$eol; 

$message = '';
$message = "<html><body>";
$message .= "<h1> An email with HTML tags</h1>";
$message .= "<h1> Script mail_3.php</h1>";
$message .= "</body></html>";

if ( mail($to,$subject,$message,$headers) ) {
   echo "The email has been sent!";
   } else {
   echo "The email has failed!";
   }
?> 
