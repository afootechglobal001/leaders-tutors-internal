<?php
$fetchSmtp = _get_setup_backend_settings_detail($conn, 'BK_ID001');
$smtpHost = $fetchSmtp['smtpHost'];
$smtpUsername = $fetchSmtp['smtpUsername'];
$smtpPassword = $fetchSmtp['smtpPassword'];
$smtpPort = $fetchSmtp['smtpPort'];
$senderName = $fetchSmtp['senderName'];
$supportEmail = $fetchSmtp['supportEmail'];
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
    $mail->Host = $smtpHost;  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;  // Enable SMTP authentication
    $mail->Username = $smtpUsername;  // SMTP username
    $mail->Password = $smtpPassword;  // SMTP password
    $mail->SMTPSecure = 'ssl';  // Enable SSL encryption
    $mail->Port = $smtpPort;  // TCP port to connect to

    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ]
    ];
    $mail->isHTML(true);
    //// sender and replyTo
    $mail->setFrom($smtpUsername, $senderName);
    $mail->addReplyTo($supportEmail, $senderName); // Reply-to address


    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $sendTo = $emailAddress;
    $recieverName = $fullName;
    $subject = "User Signup Success -- $fullName";

    $message = '
<div style="width:100%; background:#f4f6f8; padding:30px 0; font-family:Arial, Helvetica, sans-serif;">
  <div style="max-width:600px; margin:auto; background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.08);">
    
    <img src="cid:mail_header" width="100%" style="display:block;">

    <div style="padding:30px; color:#333333;">

        <h2 style="color:#01328E; margin-top:0;">Welcome, ' . $fullName . ' 🎉</h2>

        <p>We are pleased to inform you that your registration on the <strong>Leaders Tutors External Exam Portal</strong> was successful.</p>

        <p style="margin-top:25px; font-weight:bold;">Your Account Details:</p>

        <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse; font-size:14px;">
            <tr style="background:#f9fafb;">
                <td style="border:1px solid #eee;"><strong>Full Name</strong></td>
                <td style="border:1px solid #eee;">' . $fullName . '</td>
            </tr>
            <tr>
                <td style="border:1px solid #eee;"><strong>Email Address</strong></td>
                <td style="border:1px solid #eee;">' . $emailAddress . '</td>
            </tr>
            <tr style="background:#f9fafb;">
                <td style="border:1px solid #eee;"><strong>Phone Number</strong></td>
                <td style="border:1px solid #eee;">' . $phoneNumber . '</td>
            </tr>
            <tr>
                <td style="border:1px solid #eee;"><strong>Registration Date</strong></td>
                <td style="border:1px solid #eee;">' . $currentDate . '</td>
            </tr>
        </table>

        <p style="margin-top:25px;">
            You can now log in to your dashboard and begin your application process.
        </p>

        <div style="text-align:center; margin:30px 0;">
            <a href="' . $websiteUrl . '/" 
               style="background:#01328E; color:#ffffff; padding:14px 25px; 
               text-decoration:none; border-radius:5px; font-weight:bold; display:inline-block;">
               Login to Your Dashboard
            </a>
        </div>

        <p>If you did not create this account, please contact our support team immediately at 
        <a href="mailto:' . $supportEmail . '" style="color:#01328E;">' . $supportEmail . '</a>.</p>

        <p>We look forward to supporting you throughout your exam journey.</p>

        <p style="margin-top:30px;">
            Best Regards,<br>
            <strong>' . $senderName . '</strong><br>
            External Exam Portal
        </p>

    </div>

    <div style="background:#01328E; color:#ffffff; text-align:center; padding:15px; font-size:13px;">
        &copy; ' . date("Y") . ' ' . $senderName . '. All Rights Reserved.
    </div>

  </div>
</div>
';



    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AltBody = strip_tags($message);  // Fallback for non-HTML clients

    /// copy this emails
    $mail->addAddress($sendTo, $recieverName);  // Recipient email and name
    $mail->addAddress($supportEmail, $senderName);  // Support email
    $mail->addAddress("afootechglobal@gmail.com", "AfooTECH Global");  // Additional recipient

    // Attach images
    $mail->addEmbeddedImage('../../mail/img/mail_header.jpg', 'mail_header');

    // Send the email
    if (!$mail->send()) {
        echo 'Not Working';
    }

} catch (Exception $e) {
    // Handle PHPMailer exceptions
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>