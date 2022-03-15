<?php
$eol  = PHP_EOL;                    // Use a PHP end of line constant

$txt  = '';                         // Clear text string
$txt .= "PHP mail_2.php test".$eol; // Note use of line constant
$txt .= "Second line of text".$eol; // Second line

$to = "somebody@example.com";             // Send mail to address
$subject = "Subject PHP mail_2.php test"; // Subject text

$headers  = '';                                    // Clear text string
$headers .= "From: webmaster@example.com" . $eol;  // From header
$headers .= "CC: SomeOneElse@example.com";         // Carbon copy header

mail($to,$subject,$txt,$headers);
?> 

