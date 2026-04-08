<?php
require_once '../../config/connection.php';

try {
    if (!$checkBasicSecurity) {
        throw new ForbiddenException("Unauthorized access! Please log in and try again.");
    }
    //////////////////declaration of variables//////////////////////////////////////
    $fullName = trim($data['fullName']);
    $emailAddress = trim($data['emailAddress']);
    $phoneNumber = trim($data['phoneNumber']);
    $departmentId = trim($data['departmentId']);
    $examId = trim($data['examId']);
    $password = trim($data['password']);
    $confirmPassword = trim($data['confirmPassword']);

    //////////////////check for empty fields//////////////////////////////////////
    validateEmptyField($fullName, 'FULL NAME');
    validateEmptyField($emailAddress, 'EMAIL');
    validateEmptyField($phoneNumber, 'PHONE NUMBER');
    validateEmptyField($departmentId, 'DEPARTMENT');
    validateEmptyField($examId, 'EXAM');
    validateEmptyField($password, 'PASSWORD');
    validateEmptyField($confirmPassword, 'CONFIRM PASSWORD');

    //////////////////validate email format//////////////////////////////////////
    validateEmailField($emailAddress, 'EMAIL');


    //////////////////validate password match//////////////////////////////////////
    if ($password !== $confirmPassword) {
        throw new BadRequestException("PASSWORDS DO NOT MATCH! Kindly check the password and try again.");
    }
    //////////////////check if email already exists//////////////////////////////////////
    $selectQuery = "SELECT * FROM USERS_TAB WHERE emailAddress = ?";
    $params = [$emailAddress];
    $userData = selectQuery($conn, $selectQuery, "s", $params)[0];
    if (!empty($userData)) {
        throw new BadRequestException("EMAIL ALREADY EXISTS! Kindly use a different email address or log in if you already have an account.");
    }

    //////////////////hash password//////////////////////////////////////
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    ////////////////// Generate userId //////////////////
    $sequence = _get_sequence_count($conn, 'USER');
    $no = $sequence['no'];
    $userId = 'USER' . $no . date("Ymdhis");
    $accessKey = md5($userId);

    //////////////////insert user data into database//////////////////////////////////////
    $statusId = 1; // active status
    $insertQuery = "INSERT INTO `USERS_TAB`
    (`userId`, `accessKey`, `fullName`, `emailAddress`, `phoneNumber`, `departmentId`, `examId`, `password`, `statusId`, `lastLoginTime`, `createdTime`) VALUES  
    (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())";
    $params = [$userId, $accessKey, $fullName, $emailAddress, $phoneNumber, $departmentId, $examId, $passwordHash, $statusId];
    $types = "sssssissi";
    insertQuery($conn, $insertQuery, $types, $params);

    include_once 'loginUserDetails.php';

    require_once('../../mail/user/signup-success.php');
    $response = [
        'response' => 200,
        'success' => true,
        'message' => "USER SIGNED UP SUCCESSFULLY",
        'data' => $userData,
    ];
} catch (Throwable $e) {
    ErrorHandler::handle($e);
}
//////////////////////////////////////////////////////////////////////////////////////////////
http_response_code($response['response']);
echo json_encode($response);