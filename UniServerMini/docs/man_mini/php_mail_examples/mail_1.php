
<?php
$eol  = PHP_EOL;                    // Use a PHP end of line constant

$txt  = '';                         // Clear text string
$txt .= "PHP mail_1.php test".$eol; // Note use of line constant
$txt .= "Second line of text".$eol; // Second line

// Send email
mail("ToSomebody@example.com","My subject PHP mail_1.php test",$txt);
?>

 
