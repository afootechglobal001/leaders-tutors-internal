<?php
require_once '../../config/connection.php';
try {
    if (!$checkBasicSecurity) {
        throw new ForbiddenException("Unauthorized access! Please log in and try again.");
    }

    // ////// get all input parameters
   	$username = trim($_POST['username']);
	$password = $_POST['password'];

    //// validate input parameters
	validateEmptyField($username, "USERNAME");
	validateEmptyField($password, "PASSWORD");
	validateEmailField($username, "USERNAME");

	/* Secure SELECT using prepared statement */
	$query="SELECT * FROM staff_tab WHERE email = ?";
    $params=[$username];
    $result = selectQuery($conn, $query, 's', $params);
	$user = $result[0];
	$staff_id = $user['staff_id'];
	$status_id = $user['status_id'];
	$passwordHash = $user['password'];

	if (empty($result)) {
		throw new BadRequestException("INVALID USERNAME! Kindly check the username and try again.");
	}
	if (!password_verify($password, $user['password'])) {
		throw new BadRequestException("INVALID PASSWORD! Kindly check the password and try again.");
	}
	if ($status_id === 2) {
        throw new ForbiddenException("ACCOUNT SUSPENDED! Contact the administrator for more info.");
    }
    if ($status_id !== 1) {
        throw new ForbiddenException("ACCOUNT UNDER REVIEW! Contact the administrator for more info.");
    }
	////generate access key and update database
	$access_key=trim(md5($staff_id.date("Ymdhis")));
	$query="UPDATE staff_tab SET access_key = ?,  last_login_time = NOW() WHERE staff_id = ?";
	$params=[$access_key, $staff_id];
	updateQuery($conn, $query, 'ss', $params);

	///// fetch staff view
	$query="SELECT * FROM STAFF_VIEW WHERE staff_id = ?";
	$params=[$staff_id];
	$result = selectQuery($conn, $query, 's', $params);
	$staff = $result[0];
	$staff['documentStoragePath'] = "$documentStoragePath/staff-pix";
	$response = [
		'response' => 200,
		'success' => true,
		'message' => "LOGIN SUCCESSFUL!",
		'staff' => $staff
	];
	
 }catch (Throwable $e) {
    ErrorHandler::handle($e);
}
http_response_code($response['response']); // sets HTTP status
echo json_encode($response);
?>