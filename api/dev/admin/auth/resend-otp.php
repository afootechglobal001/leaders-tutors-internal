<?php
require_once '../../config/connection.php';
try {
    if (!$checkBasicSecurity) {
        throw new ForbiddenException("Unauthorized access! Please log in and try again.");
    }

    // ////// get all input parameters
   $staff_id = trim($_POST['staff_id']);

    //// validate input parameters
    validateEmptyField($staff_id, "STAFF ID");
    
    /* Check staff status*/
    $query="SELECT staff_id, fullname, email, status_id FROM staff_tab WHERE staff_id = ?";
    $params=[$staff_id];
    $result = selectQuery($conn, $query, 's', $params);
    /// Extract variables safely
    $fetchQuery = $result[0] ?? null;
    $staff_id = $fetchQuery['staff_id'] ?? null;
    $status_id = $fetchQuery['status_id'] ?? null;
    $fullname = $fetchQuery['fullname'] ?? null;
    $email = $fetchQuery['email'] ?? null;
    
    if (empty($fetchQuery)) {
        throw new ForbiddenException("INVALID STAFF ID! Start the process all over.");
    }
    if ($status_id === 2) {
        throw new ForbiddenException("ACCOUNT SUSPENDED! Contact the administrator for more info.");
    }
    if ($status_id !== 1) {
        throw new ForbiddenException("ACCOUNT UNDER REVIEW! Contact the administrator for more info.");
    }

    /* Generate secure OTP */
    $otp = random_int(100000, 999999);

    /// update OTP in database using prepared statement
    $query="UPDATE staff_tab SET otp = ? WHERE staff_id = ?";
    $params=[$otp, $staff_id];
    $result = updateQuery($conn, $query, 'is', $params);
    /* Send OTP email */
    require_once('../../config/mail/admin/reset-password.php');
    $response = [
        'response' => 200,
        'success' => true,
        'message' => "OTP SENT! An OTP has been sent to your email address. Use it to reset your password.",
        'staff_id' => $staff_id,
        'fullname' => $fullname, 
        'email' => $email, 
    ];

 }catch (Throwable $e) {
    ErrorHandler::handle($e);
}
 http_response_code($response['response']); // sets HTTP status
echo json_encode($response);
?>