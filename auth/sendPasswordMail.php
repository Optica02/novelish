<?php

// Email Verification
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function sendPasswordMail($email,$generatedPassword)
  {
    require 'PHPmailer/PHPMailer.php';
    require 'PHPmailer/SMTP.php';
    require 'PHPmailer/Exception.php';

    $mail = new PHPMailer(true);

    try {
      //Server settings
      $mail->isSMTP();                                            //Send using SMTP
      $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
      $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
      $mail->Username   = 'novelish.nv@gmail.com';                     //SMTP username
      $mail->Password   = 'ocwc kxdw suoo lmls';                              //SMTP password
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
      $mail->Port       = 465;                                  //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

      $mail->setFrom('novelish.nv@gmail.com', 'Novelish');
      $mail->addAddress($email);     //Add a recipient
  
      $mail->isHTML(true);                                  //Set email format to HTML
      $mail->Subject = 'Password Reset';
      $mail->Body    = "Your new Password is 
      '".$generatedPassword."'";
      $mail->send();
      return true;
  } catch (Exception $e) {
      return false;
  }
  }

?>