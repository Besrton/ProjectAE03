<html>
<head>
<title>Attatch file to e-mail example</title>
</head>
<body>

<?php
  $strTo      = $_POST["txtTo"];
  $strSubject = $_POST["txtSubject"];
  $strMessage = nl2br($_POST["txtDescription"]);

  //Constants
  $separator = md5(time());  // A random hash is necessary to send mixed content
  $eol       = PHP_EOL;      // Use a PHP end of line constant

  $strHeader = "";
  $strHeader .= "From: ".$_POST["txtFromName"]."<".$_POST["txtFromEmail"].">".$eol;
  $strHeader .= "Reply-To: ".$_POST["txtFromEmail"].$eol;

  // Main header (multipart mandatory)
  $strHeader .= "MIME-Version: 1.0".$eol;
  $strHeader .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"".$eol.$eol;
  $strHeader .= "This is a multi-part message in MIME Fromat.".$eol;

  //-- Message
  $strHeader .= "--".$separator.$eol;
  $strHeader .= "Content-type: text/html; charset=utf-8".$eol;
  $strHeader .= "Content-Transfer-Encoding: 7bit".$eol.$eol;
  $strHeader .= $strMessage.$eol.$eol;
	
 // Attachment
 if($_FILES["fileAttach"]["name"] != ""){
   $strFilesName = $_FILES["fileAttach"]["name"];
   $strContent = chunk_split(base64_encode(file_get_contents($_FILES["fileAttach"]["tmp_name"]))); 
   $strHeader .= "--".$separator.$eol;
   $strHeader .= "Content-Type: application/octet-stream; name=\"".$strFilesName."\"".$eol; 
   $strHeader .= "Content-Transfer-Encoding: base64".$eol;
   $strHeader .= "Content-Disposition: attachment; filename=\"".$strFilesName."\"".$eol.$eol;
   $strHeader .= $strContent.$eol.$eol;
 }
	
 // Send message
 $OK = mail($strTo,$strSubject,null,$strHeader); 

 if($OK){
   echo "Mail sent.";
 }
 else{
  echo "Unable to send mail.";
 }
?>

</body>
</html>
