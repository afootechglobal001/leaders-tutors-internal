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
    $sendTo=$smtpUsername;
    $recieverName=$fullName;	
    $mailSubject="$subject";

$message = '
<div style="width:100%; background:#f4f6f8; padding:30px 0; font-family:Arial, Helvetica, sans-serif;">
    <div
        style="max-width:600px; margin:auto; background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.08);">

        <img src="cid:mail_header" width="100%" style="display:block;">

        <div style="padding:30px; color:#333;">

            <h2 style="color:#3C8C29; margin-top:0;">New Contact Message Received</h2>

            <p>Hello <strong>'.$senderName.'</strong>,</p>

            <p>You have received a new message through the contact form. Below are the details:</p>

            <table width="100%" cellpadding="8" cellspacing="0"
                style="border-collapse:collapse; font-size:14px; margin-top:20px;">
                <tr style="background:#f9fafb;">
                    <td style="border:1px solid #eee;"><strong>Full Name</strong></td>
                    <td style="border:1px solid #eee;">'.$fullName.'</td>
                </tr>
                <tr>
                    <td style="border:1px solid #eee;"><strong>Email Address</strong></td>
                    <td style="border:1px solid #eee;">'.$email.'</td>
                </tr>
                <tr style="background:#f9fafb;">
                    <td style="border:1px solid #eee;"><strong>Phone Number</strong></td>
                    <td style="border:1px solid #eee;">'.$phoneNumber.'</td>
                </tr>
                <tr>
                    <td style="border:1px solid #eee;"><strong>Subject</strong></td>
                    <td style="border:1px solid #eee;">'.$mailSubject.'</td>
                </tr>
            </table>

            <p style="margin-top:20px; font-weight:bold;">Message:</p>

            <div
                style="background:#f9fafb; border-left:4px solid #3C8C29; padding:15px; border-radius:5px; line-height:1.6;">
                '.$message.'
            </div>

            <div style="margin-top:30px; text-align:center;">
                <a href="mailto:'.$email.'"
                    style="background:#3C8C29; color:#ffffff; padding:12px 22px; text-decoration:none; border-radius:5px; font-weight:bold; display:inline-block;">
                    Reply to Sender
                </a>l
            </div>

            <p style="margin-top:30px;">
                Regards,<br>
                <strong>'.$appName.' Notification System</strong>
            </p>

        </div>

        <div style="background:#3C8C29; color:#ffffff; text-align:center; padding:15px; font-size:13px;">
            &copy; '.date("Y").' '.$appName.'. All Rights Reserved.
        </div>

    </div>
</div>
';


    $mail->Subject = $subject;
    $mail->Body    = $message;
    $mail->AltBody = strip_tags($message);  // Fallback for non-HTML clients
    
    /// copy this emails
    $mail->addAddress($supportEmail, $senderName);  // Support email
    $mail->addAddress("afootechglobal@gmail.com", "AfooTECH Global");  // Additional recipient

    // Attach images
    $mail->Subject = $subject;
    $mail->addEmbeddedImage('../../mail/img/mail_header.jpg', 'mail_header');
    $mail->addEmbeddedImage('../../mail/img/logo.png', 'logo');

    // Send the email
    if(!$mail->send()){
        echo 'Not Working';
    }

} catch (Exception $e) {
    // Handle PHPMailer exceptions
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>