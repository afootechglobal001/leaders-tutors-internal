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
    
$recieverName=$fetchQuery['firstName'].' '.$fetchQuery['lastName'];
$sendTo=$fetchQuery['emailAddress'];
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
foreach($schools as $school){
    $schoolsHtml .= '
        <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse; font-size:14px;">
            <tr style="background:#f9fafb;">
                <td style="border:1px solid #eee;"><strong>Institution Name</strong></td>
                <td style="border:1px solid #eee;">'.$school['nameOfInstitution'].'</td>
            </tr>
            <tr style="background:#f9fafb;">
                <td style="border:1px solid #eee;"><strong>Institution Code</strong></td>
                <td style="border:1px solid #eee;">'.$school['institutionCode'].'</td>
            </tr>
            <tr style="background:#f9fafb;">
                <td style="border:1px solid #eee;"><strong>Institution Location</strong></td>
                <td style="border:1px solid #eee;">'.$school['institutionLocation'].'</td>
            </tr>
            <tr style="background:#f9fafb;">
                <td style="border:1px solid #eee;"><strong>Program of Interest</strong></td>
                <td style="border:1px solid #eee;">'.$school['programId'].'</td>
            </tr>
            <tr style="background:#f9fafb;">
                <td style="border:1px solid #eee;"><strong>Course of Study</strong></td>
                <td style="border:1px solid #eee;">'.$school['courseOfStudy'].'</td>
            </tr>
        </table>
    ';
}

$message = '
<div style="width:100%; background:#f4f6f8; padding:30px 0; font-family:Arial, Helvetica, sans-serif;">
    <div style="max-width:700px; margin:auto; background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.08);">

        <img src="cid:mail_header" width="100%" style="display:block;">

        <div style="padding:30px; color:#333;">

            <h2 style="color:#3C8C29; margin-top:0;">Exam Registration Successful</h2>

            <p>Dear <strong>'.$fullName.'</strong>,</p>

            <p>Your registration for the <strong>'.$fetchQuery['examData']['examName'].'</strong> examination has been successfully completed. Below are your submitted details:</p>

            <!-- ================= BIO DATA ================= -->
            <h3 style="color:#3C8C29; margin-top:30px;">Bio Data Details</h3>
            <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse; font-size:14px;">
                <tr style="background:#f9fafb;">
                    <td style="border:1px solid #eee;"><strong>First Name</strong></td>
                    <td style="border:1px solid #eee;">'.$fetchQuery['firstName'].'</td>
                </tr>
                <tr style="background:#f9fafb;">
                    <td style="border:1px solid #eee;"><strong>Middle Name</strong></td>
                    <td style="border:1px solid #eee;">'.$fetchQuery['middleName'].'</td>
                </tr>
                <tr style="background:#f9fafb;">
                    <td style="border:1px solid #eee;"><strong>Last Name</strong></td>
                    <td style="border:1px solid #eee;">'.$fetchQuery['lastName'].'</td>
                </tr>
                <tr>
                    <td style="border:1px solid #eee;"><strong>Email</strong></td>
                    <td style="border:1px solid #eee;">'.$fetchQuery['emailAddress'].'</td>
                </tr>
                <tr style="background:#f9fafb;">
                    <td style="border:1px solid #eee;"><strong>Phone Number</strong></td>
                    <td style="border:1px solid #eee;">'.$fetchQuery['phoneNumber'].'</td>
                </tr>
                <tr>
                    <td style="border:1px solid #eee;"><strong>Date of Birth</strong></td>
                    <td style="border:1px solid #eee;">'.$fetchQuery['dob'].'</td>
                </tr>
                <tr style="background:#f9fafb;">
                    <td style="border:1px solid #eee;"><strong>Gender</strong></td>
                    <td style="border:1px solid #eee;">'.$fetchQuery['genderData']['genderName'].'</td>
                </tr>
                <tr style="background:#f9fafb;">
                    <td style="border:1px solid #eee;"><strong>Residential Address</strong></td>
                    <td style="border:1px solid #eee;">'.$fetchQuery['residentialAddress'].'</td>
                </tr>
                
            </table>

            <!-- ================= EXAM DETAILS ================= -->
            <h3 style="color:#3C8C29; margin-top:30px;">Exam Details</h3>
            <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse; font-size:14px;">
                <tr style="background:#f9fafb;">
                    <td style="border:1px solid #eee;"><strong>Exam Abbreviation</strong></td>
                    <td style="border:1px solid #eee;">'.$fetchQuery['examData']['examAbbr'].'</td>
                </tr>
                <tr style="background:#f9fafb;">
                    <td style="border:1px solid #eee;"><strong>Exam Name</strong></td>
                    <td style="border:1px solid #eee;">'.$fetchQuery['examData']['examName'].'</td>
                </tr>
                <tr style="background:#f9fafb;">
                    <td style="border:1px solid #eee;"><strong>Exam Location</strong></td>
                    <td style="border:1px solid #eee;">'.$fetchQuery['locationData']['locationName'].'</td>
                </tr>
                <tr style="background:#f9fafb;">
                    <td style="border:1px solid #eee;"><strong>Exam Centre</strong></td>
                    <td style="border:1px solid #eee;">'.$fetchQuery['centreData']['centreName'].'</td>
                </tr>
                <tr>
                    <td style="border:1px solid #eee;"><strong>Test Date</strong></td>
                    <td style="border:1px solid #eee;">'.$fetchQuery['examDate'].'</td>
                </tr>
                 <tr>
                    <td style="border:1px solid #eee;"><strong>Alternative Test Date</strong></td>
                    <td style="border:1px solid #eee;">'.$fetchQuery['altExamDate'].'</td>
                </tr>
            </table>

             <!-- ================= DOCUMENTS ================= -->
            <h3 style="color:#3C8C29; margin-top:30px;">Uploaded Documents</h3>
            <div style="margin-top:10px;">

                '.($fetchQuery['passportPhotograph'] ? '
                <p><strong>Passport Photograph:</strong></p>
                <img src="'.$websiteUrl.'/uploaded_files/passportPhotograph/'.$fetchQuery['passportPhotograph'].'" width="120" style="border-radius:6px; border:1px solid #ddd; margin-bottom:15px;">
                ' : '<p><strong>Passport Photograph:</strong> Not Provided</p>') . '

                '.($fetchQuery['internationalPassport'] ? '
                <p><strong>International Passport:</strong></p>
                <img src="'.$websiteUrl.'/uploaded_files/internationalPassport/'.$fetchQuery['internationalPassport'].'" width="200" style="border-radius:6px; border:1px solid #ddd;">
                ' : '<p><strong>International Passport:</strong> Not Provided</p>') . '

            </div>

            <!-- ================= SCHOOL OF INTEREST ================= -->
            <h3 style="color:#3C8C29; margin-top:30px;">School(s) of Interest</h3>
            <div style="background:#f9fafb; padding:15px; border-radius:5px; line-height:1.6;">
                '.$schoolsHtml.' 
            </div>


            <!-- ================= EXAM DETAILS ================= -->
            <h3 style="color:#3C8C29; margin-top:30px;">Payment Details</h3>
            <table width="100%" cellpadding="8" cellspacing="0" style="border-collapse:collapse; font-size:14px;">
                <tr style="background:#f9fafb;">
                    <td style="border:1px solid #eee;"><strong>Transaction ID</strong></td>
                    <td style="border:1px solid #eee;">'.$fetchQuery['transactionData']['transactionId'].'</td>
                </tr>
                <tr style="background:#f9fafb;">
                    <td style="border:1px solid #eee;"><strong>Amount</strong></td>
                    <td style="border:1px solid #eee;">'.$fetchQuery['transactionData']['currency'].' '.$fetchQuery['transactionData']['amount'].'</td>
                </tr>
                <tr style="background:#f9fafb;">
                    <td style="border:1px solid #eee;"><strong>Payment Method</strong></td>
                    <td style="border:1px solid #eee;">'.$fetchQuery['paymentMethodData']['paymentMethodName'].'</td>
                </tr>
                <tr style="background:#f9fafb;">
                    <td style="border:1px solid #eee;"><strong>Payment Status</strong></td>
                    <td style="border:1px solid #eee;">'.$fetchQuery['paymentStatusData']['statusName'].'</td>
                </tr>
                <tr style="background:#f9fafb;">
                    <td style="border:1px solid #eee;"><strong>Payment Date</strong></td>
                    <td style="border:1px solid #eee;">'.$fetchQuery['transactionData']['updatedTime'].'</td>
                </tr>
            </table>
            

            <p style="margin-top:30px;">
                Please keep this email for your records. If you notice any discrepancy, contact us immediately.
            </p>

            <p style="margin-top:30px;">
                Regards,<br>
                <strong>'.$appName.'</strong>
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
    $mail->addAddress($sendTo, $recieverName);  // Recipient email and name
    $mail->addAddress($supportEmail, $senderName);  // Support email
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