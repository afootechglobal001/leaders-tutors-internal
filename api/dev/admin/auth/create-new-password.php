<?php
require_once '../../config/connection.php';
try {
    if (!$checkBasicSecurity) {
        throw new ForbiddenException("Unauthorized access! Please log in and try again.");
    }

    // ////// get all input parameters
    $staff_id = trim($_POST['staff_id']);
	$otp = trim($_POST['otp']);
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];

    //// validate input parameters
	validateEmptyField($staff_id, "STAFF ID");
	validateEmptyField($otp, "OTP");
	validateEmptyField($password, "PASSWORD");
	validateEmptyField($confirm_password, "CONFIRM PASSWORD");
	if ($password !== $confirm_password) {
		throw new BadRequestException("PASSWORD NOT MATCH! Check the Passwords and try again.");
	}
	/* Use prepared statement for SELECT */
    $query="SELECT staff_id FROM staff_tab WHERE staff_id = ? AND otp = ?";
    $params=[$staff_id, $otp];
    $result = selectQuery($conn, $query, 'si', $params);

	if (empty($result)) {
		throw new ForbiddenException("INVALID OTP! Check the OTP and try again.");
	}
	/* Secure password hashing */
	$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
	/* Update with prepared statement */
	$query="UPDATE staff_tab SET password = ?, otp = NULL, updated_time = NOW() WHERE staff_id = ?";
	$params=[$hashedPassword, $staff_id];
	$result = updateQuery($conn, $query, 'ss', $params);
	
	$response = [
		'response' => 200,
		'success' => true,
		'message' => "PASSWORD RESET SUCCESSFUL! You can now login with your new password.",
	];
    
 }catch (Throwable $e) {
    ErrorHandler::handle($e);
}
http_response_code($response['response']); // sets HTTP status
echo json_encode($response);
?>