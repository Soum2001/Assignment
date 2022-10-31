<?php
    session_start();
    require 'vendor/autoload.php'; 
    use PHPMailer\PHPMailer\PHPMailer;
    $mail = new PHPMailer; 
    error_log($_SESSION['otp_email']);
    $otp=rand(100000,999999);
    
    // $mail->SMTPDebug = true;
    $mail->Mailer = 'smtp';
    $mail->Host       = 'smtp.zoho.in';                                           //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                                       //Enable SMTP authentication
    $mail->Username   = '2018ssamantaray@zohomail.in';                     //SMTP username
    $mail->Password   = '2018@Soumya';                                                   //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                                        //Enable implicit TLS encryption
    $mail->Port       = 465;

    // $mail->From     =  "soumya.samataray@mindfiresolutions.com"; 
    // $mail->FromName =  "soumya samantaray"; //To address and name 
    // $mail->Password =  'Mindfire@12'; 

    $mail->setFrom('2018ssamantaray@zohomail.in', 'Mailer');
    $mail->addAddress($_SESSION['otp_email']);//Recipient name is optional
    //$mail->addAddress("recepient1@example.com"); //Address to which recipient will reply 
    // $mail->addReplyTo("reply@yourdomain.com", "Reply"); //CC and BCC 
    // $mail->addCC("cc@example.com"); 
    // $mail->addBCC("bcc@example.com"); //Send HTML or Plain Text email 
    $mail->isHTML(true); 
    $mail->Subject = "verify-otp";
    $mail->Body = "<i>Verification otp :-</i>".$otp; 
    
    if(!$mail->send()) 
    {
    echo "Mailer Error: " . $mail->ErrorInfo; 
    } 
    else { 
        $_SESSION['otp']=$otp;
        header('Location:otp_front.php');
        echo "Message has been sent successfully"; 
    }
?>