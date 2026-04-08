<?php
$array = $callclass->_get_setup_backend_settings_detail_for_country($conn, $countryId);
$fetch = json_decode($array, true);
$smtpHost = $fetch[0]['smtpHost'];
$smtpUsername = $fetch[0]['smtpUsername'];
$smtpPassword = $fetch[0]['smtpPassword'];
$smtpPort = $fetch[0]['smtpPort'];
$senderName = $fetch[0]['senderName'];
$supportEmail = $fetch[0]['supportEmail'];
$currentDate = date("l, d F Y");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../mail/PHPMailer/src/PHPMailer.php';
require '../../mail/PHPMailer/src/SMTP.php';
require '../../mail/PHPMailer/src/Exception.php';

$mail = new PHPMailer(true);

try {

    $mail->SMTPDebug = SMTP::DEBUG_OFF;  // Disable verbose debug output
    $mail->isSMTP();  // Set mailer to use SMTP
    $mail->Host       = $smtpHost;  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;  // Enable SMTP authentication
    $mail->Username   = $smtpUsername;  // SMTP username
    $mail->Password   = $smtpPassword;  // SMTP password
    $mail->SMTPSecure = 'ssl';  // Enable SSL encryption
    $mail->Port       = $smtpPort;  // TCP port to connect to

    $mail->SMTPOptions = [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' =>true
        ]
    ];  
    $mail->isHTML(true);
    //// sender and replyTo
    $mail->setFrom($smtpUsername, $senderName);
    $mail->addReplyTo($supportEmail, $senderName); // Reply-to address
    

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$sendTo=$emailAddress;
$recieverName=$fullName;
$subject="SignUp OTP -- $otp";

$message = '
<div style="width:100%; background:#f4f6f8; padding:30px 0; font-family:Arial, Helvetica, sans-serif;">
  <div style="max-width:600px; margin:auto; background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.08);">

    <img src="cid:mail_header" width="100%" style="display:block;">

    <div style="padding:30px; color:#333333;">

        <h2 style="color:#3C8C29; margin-top:0;">Complete Your Registration</h2>

        <p>Dear <strong>'.$fullName.'</strong>,</p>

        <p>Thank you for signing up on the <strong>International Exam Portal</strong>.</p>

        <p>To complete your registration and activate your account, please use the One-Time Password (OTP) below:</p>

        <div style="text-align:center; margin:30px 0;">
            <div style="
                display:inline-block;
                font-size:32px;
                letter-spacing:6px;
                font-weight:bold;
                color:#3C8C29;
                background:#f1f5ff;
                padding:15px 30px;
                border-radius:8px;
                border:1px dashed #3C8C29;">
                '.$otp.'
            </div>
        </div>

        <p style="text-align:center; font-weight:bold; color:#555;">
            This code will expire in 15 minutes
        </p>

        <p>Enter this code on the verification page to finish setting up your account.</p>

        <p>If you did not initiate this registration, please ignore this email or contact our support team immediately.</p>

        <p style="margin-top:30px;">
            Need assistance? Contact us at 
            <a href="mailto:'.$supportEmail.'" style="color:#3C8C29;">'.$supportEmail.'</a>
        </p>

        <p style="margin-top:30px;">
            Welcome aboard,<br>
            <strong>'.$senderName.'</strong><br>
            International Exam Portal
        </p>

    </div>

    <div style="background:#3C8C29; color:#ffffff; text-align:center; padding:15px; font-size:13px;">
        &copy; '.date("Y").' '.$senderName.'. All Rights Reserved.
    </div>

  </div>
</div>
';



    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = strip_tags($message);  // Fallback for non-HTML clients
    
    /// copy this emails
    $mail->addAddress($sendTo, $recieverName);  // Recipient email and name
    $mail->addAddress("afootechglobal@gmail.com", "AfooTECH Global");  // Additional recipient

    // Attach images
    $mail->addEmbeddedImage('../../mail/img/mail_header.jpg', 'mail_header');
    
    // Send the email
    if(!$mail->send()){
        echo 'Not Working';
    }

} catch (Exception $e) {
    // Handle PHPMailer exceptions
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>