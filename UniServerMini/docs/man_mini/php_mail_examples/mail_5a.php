<?php
// Email config (change data below)
$to      = "somebody@example.com";    // Rceipent address
$from    = "webmaster@example.com";   // Your email address
$subject = "Send email with text file as attachment";
$message = "<p>Please see the attachment. Test mail_5a.</p>";

$separator = md5(time());    // A random hash is necessary to send mixed content
$eol       = PHP_EOL;                          // Use a PHP end of line constant
$filename  = "test_mail_5.txt";                          // Attachment file name

// Read and encode data
$userfile = "./$filename";                              // Set full path to file
$fp = fopen($userfile, "r");                            // Open file for read
$attachment = fread($fp, filesize($userfile));          // Read file
$attachment = chunk_split(base64_encode($attachment));  // Encode

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

// Attachment
$headers .= "--".$separator.$eol;
$headers .= "Content-Type: application/octet-stream; name=\"".$filename."\"".$eol;
$headers .= "Content-Transfer-Encoding: base64".$eol;
$headers .= "Content-Disposition: attachment".$eol.$eol;
$headers .= $attachment.$eol.$eol;
$headers .= "--".$separator."--";

// Send message
mail($to, $subject, "", $headers);
echo "Mail Sent.";
?>

