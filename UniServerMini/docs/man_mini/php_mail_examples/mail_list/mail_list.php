<?php
// Read list of emails from file.
$email_list = file("elist.txt");

// Count how many emails in list.
$total_emails = count($email_list);

// Iterate through list and remoove newline character.
for ($counter=0; $counter<$total_emails; $counter++) {
   $email_list[$counter] = trim($email_list[$counter]);
   }

// Implode list to give a single variable, insert commas.
// Assign to $to variable.
$to = implode(",",$email_list);

$subject = "My email test.";
$message = "Hello, A list test?";

if ( mail($to,$subject,$message) ) {
   echo "Email sent!";
   } else {
   echo "Email failed!";
   }
?> 