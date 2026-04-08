<?php
require_once '../../config/connection.php';
require_once '../../config/staff-session-check.php';

try {

    if (!$checkBasicSecurity) {
        throw new ForbiddenException("Unauthorized access! Please log in.");
    }

    if (!$checkSession) {
        throw new UnauthorizedException("SESSION EXPIRED! Please LogIn Again.");
    }

    ////////////////// Variables //////////////////

    $firstName     = strtoupper(trim($data['firstName'] ?? ''));
    $middleName    = strtoupper(trim($data['middleName'] ?? ''));
    $lastName      = strtoupper(trim($data['lastName'] ?? ''));
    $emailAddress  = trim($data['emailAddress'] ?? '');
    $mobileNumber  = trim($data['mobileNumber'] ?? '');
    $genderId      = trim($data['genderId'] ?? '');
    $dateOfBirth   = trim($data['dateOfBirth'] ?? '');
    $stateId       = trim($data['stateId'] ?? '');
    $lgaId         = trim($data['lgaId'] ?? '');
    $address       = strtoupper(trim($data['address'] ?? ''));
    $branchId      = trim($data['branchId'] ?? '');
    $roleId        = trim($data['roleId'] ?? '');
    $statusId      = trim($data['statusId'] ?? '');

    ////////////////// Validation //////////////////

    validateEmptyField($firstName, 'FIRST NAME');
    validateEmptyField($middleName, 'MIDDLE NAME');
    validateEmptyField($lastName, 'LAST NAME');
    validateEmptyField($emailAddress, 'EMAIL');
    validateEmptyField($mobileNumber, 'PHONE NUMBER');
    validateEmptyField($genderId, 'STAFF GENDER');
    validateEmptyField($dateOfBirth, 'DATE OF BIRTH');
    validateEmptyField($stateId, 'STATE OF ORIGIN');
    validateEmptyField($lgaId, 'LOCAL GOVT AREA');
    validateEmptyField($address, 'ADDRESS');
    validateEmptyField($branchId, 'BRANCH');
    validateEmptyField($roleId, 'STAFF ROLE');
    validateEmptyField($statusId, 'STATUS');

    /////// other validation ///////
    validateEmailField($emailAddress, 'EMAIL');

    ////////////////// Check Existing Email //////////////////

    $checkEmailQuery = "SELECT staffId FROM STAFF_TAB WHERE emailAddress = ?";
    $existingStaff = selectQuery($conn, $checkEmailQuery, "s", [$emailAddress]);

    if (!empty($existingStaff)) {
        throw new ConflictException("ACCOUNT EXIST! Account already exists with this email.");
    }

    ////////////////// Generate Staff ID //////////////////
    $sequence = _get_sequence_count($conn, 'GFSS');
    $array = json_decode($sequence, true);
    $no = $array[0]['no'];
    $staffId = 'GFSS' . $no . date("YmdHis");

    ////////////////// Secure Password //////////////////

    $password = password_hash($staffId, PASSWORD_DEFAULT);

    ////////////////// Insert Staff //////////////////

    $insertQuery = "
        INSERT INTO STAFF_TAB (
            staffId,
            firstName,
            middleName,
            lastName,
            emailAddress,
            mobileNumber,
            genderId,
            dateOfBirth,
            stateId,
            lgaId,
            address,
            branchId,
            roleId,
            statusId,
            password,
            createdBy,
            createdTime
        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,NOW())
    ";
    $insertParams = [
        $staffId,
        $firstName,
        $middleName,
        $lastName,
        $emailAddress,
        $mobileNumber,
        $genderId,
        $dateOfBirth,
        $stateId,
        $lgaId,
        $address,
        $branchId,
        $roleId,
        $statusId,
        $password,
        $loginStaffId
    ];
    insertQuery($conn, $insertQuery, "ssssssssssssssss", $insertParams);

    ////////////////// Fetch Created Staff //////////////////

    $staffQuery = "SELECT * FROM STAFF_VIEW WHERE staffId = ?";
    $staffData = selectQuery($conn, $staffQuery, "s", [$staffId]);

    foreach ($staffData as &$staff) {

        $createdBy = $staff['createdBy'];
        $updatedBy = $staff['updatedBy'];

    ////////////////// Created By //////////////////
        $staff['createdBy'] = _action_performed_by($conn, $createdBy) ?? null;
    ////////////////// Updated By //////////////////
        $staff['updatedBy'] = _action_performed_by($conn, $updatedBy) ?? null;
    }

    ////////////////// Response //////////////////

    $response = [
        'response' => 200,
        'success' => true,
        'message' => "STAFF CREATED SUCCESSFULLY!",
        'data' => $staffData
    ];

} catch (Throwable $e) {
    ErrorHandler::handle($e);
}

http_response_code($response['response'] ?? 500);
echo json_encode($response);
?>