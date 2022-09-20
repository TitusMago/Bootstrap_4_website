<?php
if(isset($_POST['email'])) {


    $email_to = "info@moscizim.co.zw";
    $email_subject = "New mail from website";

    function died($error) {

        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please rewrite and send the corrected email.<br /><br />";
        die();
    }


    if(!isset($_POST['name']) ||
        !isset($_POST['message']) ||
        !isset($_POST['email']) ||
        !isset($_POST['surname']) ||
        !isset($_POST['address']) ||
        !isset($_POST['phone']))  {
        died('We are sorry, but there appears to be a problem with the form you submitted.');
    }



    $name = $_POST['name']; // required
    $message = $_POST['message']; // required
    $email_from = $_POST['email']; // required
    $surname = $_POST['surname']; // required
    $address = $_POST['address']; // required
    $phone = $_POST['phone']; // required


    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }

    $string_exp = "/^[A-Za-z .'-]+$/";

  if(!preg_match($string_exp,$name)) {
    $error_message .= 'The Name you entered does not appear to be valid.<br />';
  }



  if(strlen($error_message) > 0) {
    died($error_message);
  }

    $email_message = "Consultation request from website.\n\n";


    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }



    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Surname: ".clean_string($surname)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Address: ".clean_string($address)."\n";
    $email_message .= "Phone: ".clean_string($phone)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";

// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);
?>
Thank you for contacting Mosci Engineering. We will be in touch with you soon.

<?php

}
?>
