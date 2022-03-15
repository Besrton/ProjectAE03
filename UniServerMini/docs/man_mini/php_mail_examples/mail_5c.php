<?php
// Email config (change data below)
$to      = "somebody@example.com";     // Rceipent address
$from    = "webmaster@example.com";    // Your email address
$subject = "Send email with text and image file attachments";
$message = "<p>Please see the attachment. Test mail_5c.</p>";

$separator  = md5(time());    // A random hash is necessary to send mixed content
$eol        = PHP_EOL;                          // Use a PHP end of line constant
$filename1  = "test_mail_5.png";                          // Attachment file name
$filename2  = "test_mail_5.txt";                          // Attachment file name

// Read and encode data 1
$userfile1 = "./$filename1";                             // Set full path to file
$fp1 = fopen($userfile1, "r");                           // Open file for read
$attachment1 = fread($fp1, filesize($userfile1));        // Read file
$attachment1 = chunk_split(base64_encode($attachment1)); // Encode

// Read and encode data 2
$userfile2= "./$filename2";                               // Set full path to file
$fp2 = fopen($userfile2, "r");                            // Open file for read
$attachment2 = fread($fp2, filesize($userfile2));         // Read file
$attachment2 = chunk_split(base64_encode($attachment2));  // Encode

// Main header (multipart mandatory)
$headers = "From: ".$from.$eol;
$headers .= "MIME-Version: 1.0".$eol;
$headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"".$eol.$eol;
$headers .= "Content-Transfer-Encoding: 7bit".$eol;
$headers .= "This is a MIME encoded message.".$eol.$eol;

// Message
$headers .= "--".$separator.$eol;
$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
$headers .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
$headers .= $message.$eol.$eol;

// Attachment 1
$headers .= "--".$separator.$eol;
$headers .= "Content-Type: application/octet-stream; name=\"".$filename1."\"".$eol;
$headers .= "Content-Transfer-Encoding: base64".$eol;
$headers .= "Content-Disposition: attachment".$eol.$eol;
$headers .= $attachment1.$eol.$eol;

// Attachment 2
$headers .= "--".$separator.$eol;
$headers .= "Content-Type: application/octet-stream; name=\"".$filename2."\"".$eol;
$headers .= "Content-Transfer-Encoding: base64".$eol;
$headers .= "Content-Disposition: attachment".$eol.$eol;
$headers .= $attachment2.$eol.$eol;
$headers .= "--".$separator."--";

// Send message
mail($to, $subject, "", $headers);
echo "Mail Sent.";
?>

