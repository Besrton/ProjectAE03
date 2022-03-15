<?php
 $separator  = md5(time()); // A random hash is necessary to send mixed content
 $eol        = PHP_EOL;     // Use a PHP end of line constant

 // Email config (change data below)
 $to      = "somebody@example.com";                   // Rceipent address
 $from    = "webmaster@example.com";                  // From 
 $subject = "Plain text and HTML example - Test 4";   // Subject text

 $text_content = "Plain text test section.";          // Plain text message
 $html_content = "<h1>HTML test section.</h1>";       // HTML message

 // Main header (multipart mandatory)
 $headers  = '';
 $headers  = "From: ".$from.$eol;
 $headers .= "MIME-Version: 1.0".$eol;
 $headers .= "Content-Type: multipart/alternative; boundary=\"".$separator."\"".$eol.$eol;
 $headers .= "Content-Transfer-Encoding: 7bit".$eol;
 $headers .= "This is a MIME encoded message.".$eol.$eol;

 # Add plain text version
 $headers .= "--".$separator.$eol;
 $headers .= "Content-Type: text/plain; charset=\"charset=us-ascii\"".$eol;
 $headers .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
 $headers .= $text_content;
 $headers .= $eol.$eol;

 # Add HTML version
 $headers .= "--".$separator.$eol;
 $headers .= "Content-Type: text/html; charset=\"UTF-8\"".$eol;
 $headers .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
 $headers .= $html_content;
 $headers .= $eol.$eol;

 # Attachments would go here

 # End email
 $headers .= "--".$separator."--";

 // Send message
 mail($to, $subject, "", $headers);
 echo "Mail Sent.";
?> 
