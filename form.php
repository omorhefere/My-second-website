<?php

$name = $comment = $number = $email = "";
$me = 'efeimoloame1@gmail.com';

 if (isset($_POST['name']))
   $name = fix_string($_POST['name']);
 if (isset($_POST['comment']))
   $comment  = fix_string($_POST['comment']);
 if (isset($_POST['number']))
   $number    = fix_string($_POST['number']);
 if (isset($_POST['email']))
   $email    = fix_string($_POST['email']);

 if (isset($_POST['submit'])){
  date_default_timezone_set('Etc/UTC');

  require '/Applications/XAMPP/xamppfiles/lib/php/PHPMailerAutoload.php';

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

  $mail->SMTPOptions = array(
      'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
      )
  );

  //Username to use for SMTP authentication - use full email address for gmail
  $mail->Username = $me;

  //Password to use for SMTP authentication
  $mail->Password = "imoloame";

  //Set who the message is to be sent from
  $mail->setFrom($me, 'Omorhefere Imoloame');

  //Set an alternative reply-to address
  $mail->addReplyTo($me, 'Omorhefere Imoloame');

  //Set who the message is to be sent to
  $mail->addAddress($email, $name);
  $mail->addAddress('efeimoloame@icloud.com', 'me');

  //Set the subject line
  $mail->Subject = 'Form Sent Confirmation';

  //Read an HTML message body from an external file, convert referenced images to embedded,
  //convert HTML into a basic plain-text alternative body
  $mail->Body = nl2br("Name: {$name} \n Phone Number: {$number} \n E-mail: {$email} \n Comments: {$comment}")  ;

  //Replace the plain text body with one created manually
  $mail->AltBody = 'New Form Filled';

  //Attach an image file
  //$mail->addAttachment('images/phpmailer_mini.png');

  //send the message, check for errors
  if (!$mail->send()) {
      echo "Mailer Error: " . $mail->ErrorInfo;
  } else {
      header('Location: ThankYou.html');
  }

    // You can also use header('Location: thank_you.php'); to redirect to another
}

 $fail  = validate_name($name);
 $fail .= validate_comment($comment);
 $fail .= validate_number($number);
 $fail .= validate_email($email);



 if ($fail == "")
 {
   echo "</head><body>Form data successfully validated:
     $name, $comment,  $number, $email.</body></html>";

   // This is where you would enter the posted fields into a database,
   // preferably using hash encryption for the password.

   exit;
 }


 function validate_name($field)
 {
     return ($field == "") ? "No Name was entered<br>": "";
 }

 function validate_comment($field)
 {
     return($field == "") ? "No comment was entered<br>" : "";
 }

   function validate_number($field)
   {
     if ($field == "") return "No phone number  was entered<br>";
     else if (strlen($field)<11 || strlen($field)>11)
       return "Phone number should be 11 digits <br>";
     return "";
   }

   function validate_email($field)
   {
     if ($field == "") return "No Email was entered<br>";
       else if (!((strpos($field, ".") > 0) &&
                  (strpos($field, "@") > 0)) ||
                   preg_match("/[^a-zA-Z0-9.@_-]/", $field))
         return "The Email address is invalid<br>";
     return "";
   }

   function fix_string($string)
   {
     if (get_magic_quotes_gpc()) $string = stripslashes($string);
     return htmlentities ($string);
   }
?>
